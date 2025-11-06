let carritos = {}; 

const carritoFab = document.getElementById('carrito-fab');
const carritoWindow = document.getElementById('carrito-window');
const carritoBadge = document.getElementById('carrito-badge');

// Mostrar/Ocultar ventana carrito
if (carritoFab) carritoFab.addEventListener('click', toggleCarrito);

function toggleCarrito(forceClose = false) {
  const isVisible = carritoWindow.style.display === 'flex' || getComputedStyle(carritoWindow).display === 'flex';
  carritoWindow.style.display = forceClose || isVisible ? 'none' : 'flex';
}


// ✅ Notificación visual animada
function mostrarNotificacion(texto) {
  const cont = document.getElementById('carrito-notificaciones');
  if (!cont) return;

  const div = document.createElement('div');
  div.style.background = '#28a745';
  div.style.color = '#fff';
  div.style.padding = '8px 16px';
  div.style.marginTop = '6px';
  div.style.borderRadius = '10px';
  div.style.boxShadow = '0 2px 6px rgba(0,0,0,0.2)';
  div.style.opacity = '0';
  div.style.transition = 'opacity 0.3s ease';
  div.textContent = texto;
  cont.appendChild(div);

  setTimeout(() => (div.style.opacity = '1'), 50);
  setTimeout(() => {
    div.style.opacity = '0';
    setTimeout(() => div.remove(), 300);
  }, 2500);
}

// 🔢 Actualizar cantidad total del badge
function actualizarBadge() {
  let total = 0;
  for (const idnegocio in carritos) {
    total += carritos[idnegocio].reduce((sum, p) => sum + p.cantidad, 0);
  }
  carritoBadge.textContent = total;
  carritoBadge.style.display = total > 0 ? 'flex' : 'none';
}

// ➕ Agregar producto al carrito
function agregarAlCarrito(plato) {
  if (!window.isLoggedIn) {
    window.location.href = window.loginUrl;
    return;
  }

  const idnegocio = plato.idnegocio || 0;
  if (!carritos[idnegocio]) carritos[idnegocio] = [];

  let existente = carritos[idnegocio].find(p => p.nombre === plato.nombre);
  if (existente) {
    existente.cantidad += plato.cantidad || 1;
  } else {
    carritos[idnegocio].push({ ...plato, cantidad: plato.cantidad || 1 });
  }

  renderCarrito();
  mostrarNotificacion(`✅ ${plato.nombre} agregado al carrito`);
}

// 🎨 Renderizar carrito completo
function renderCarrito() {
  const cont = document.getElementById('carrito-items');
  if (!cont) return;

  cont.innerHTML = '';
  let totalGeneral = 0;

  for (const idnegocio in carritos) {
    const productos = carritos[idnegocio];
    if (productos.length === 0) continue;

    // Encabezado por negocio
    const h6 = document.createElement('h6');
    h6.textContent = `Negocio #${idnegocio}`;
    h6.style.marginTop = '8px';
    cont.appendChild(h6);

    let subtotal = 0;

    productos.forEach((p, index) => {
      subtotal += p.precio * p.cantidad;
      const div = document.createElement('div');
      div.className = 'carrito-item';
      div.innerHTML = `
        <span>${p.nombre}</span>
        <div style="display:flex; align-items:center; gap:5px;">
          <input type="number" min="1" value="${p.cantidad}" onchange="cambiarCantidad(${idnegocio}, ${index}, this.value)">
          <span>S/ ${(p.precio * p.cantidad).toFixed(2)}</span>
          <button class="btn btn-sm btn-danger" onclick="eliminarPlato(${idnegocio}, ${index})">
            <i class="fa fa-trash"></i>
          </button>
        </div>
      `;
      cont.appendChild(div);
    });

    const totalDiv = document.createElement('div');
    totalDiv.className = 'mt-2 fw-bold text-end';
    totalDiv.textContent = `Subtotal negocio ${idnegocio}: S/ ${subtotal.toFixed(2)}`;
    cont.appendChild(totalDiv);

    totalGeneral += subtotal;
  }

  const totalFinal = document.createElement('div');
  totalFinal.className = 'mt-3 fw-bold text-end';
  totalFinal.textContent = `Total general: S/ ${totalGeneral.toFixed(2)}`;
  cont.appendChild(totalFinal);

  actualizarBadge();
}

// 🔁 Cambiar cantidad
function cambiarCantidad(idnegocio, index, cantidad) {
  cantidad = parseInt(cantidad);
  if (isNaN(cantidad) || cantidad < 1) cantidad = 1;
  carritos[idnegocio][index].cantidad = cantidad;
  renderCarrito();
}

// ❌ Eliminar producto
function eliminarPlato(idnegocio, index) {
  const nombre = carritos[idnegocio][index].nombre;
  carritos[idnegocio].splice(index, 1);
  renderCarrito();
  mostrarNotificacion(`❌ ${nombre} eliminado`);
}

// 📲 Enviar pedido por WhatsApp
const btnWhatsApp = document.getElementById('enviarWhatsApp');
if (btnWhatsApp) {
  btnWhatsApp.addEventListener('click', function () {
    if (Object.keys(carritos).length === 0) return alert("El carrito está vacío");

    let mensaje = "¡Hola! Quiero hacer los siguientes pedidos:%0A";

    for (const idnegocio in carritos) {
      const productos = carritos[idnegocio];
      if (productos.length === 0) continue;
      mensaje += `%0A🛍️ *Negocio #${idnegocio}*%0A`;
      productos.forEach(p => {
        mensaje += `- ${p.nombre} x${p.cantidad} = S/ ${(p.precio * p.cantidad).toFixed(2)}%0A`;
      });
    }

    mensaje += "%0AGracias 🙌";
    const numeroWhatsApp = "51955365019";
    window.open(`https://wa.me/${numeroWhatsApp}?text=${mensaje}`, "_blank");
  });
}
