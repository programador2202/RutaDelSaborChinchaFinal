// ----------------- Carrito -----------------
let carrito = [];
const carritoFab = document.getElementById('carrito-fab');
const carritoWindow = document.getElementById('carrito-window');
const carritoBadge = document.getElementById('carrito-badge');

carritoFab.addEventListener('click', toggleCarrito);

function toggleCarrito() {
    carritoWindow.style.display = carritoWindow.style.display === 'flex' ? 'none' : 'flex';
}

function mostrarNotificacion(texto) {
    const cont = document.getElementById('carrito-notificaciones');
    const div = document.createElement('div');
    div.style.background = '#28a745';
    div.style.color = '#fff';
    div.style.padding = '6px 12px';
    div.style.marginTop = '4px';
    div.style.borderRadius = '8px';
    div.style.transition = 'all 0.3s ease';
    div.textContent = texto;
    cont.appendChild(div);
    setTimeout(() => div.remove(), 2000);
}

function actualizarBadge() {
    const total = carrito.reduce((sum, p) => sum + p.cantidad, 0);
    carritoBadge.textContent = total;
}

function agregarAlCarrito(plato) {
    let existente = carrito.find(p => p.nombre === plato.nombre);
    if (existente) {
        existente.cantidad += plato.cantidad || 1;
    } else {
        carrito.push({...plato, cantidad: plato.cantidad || 1});
    }
    renderCarrito();
    mostrarNotificacion(`${plato.nombre} agregado al carrito`);
}

function renderCarrito() {
    const cont = document.getElementById('carrito-items');
    cont.innerHTML = '';
    let total = 0;

    carrito.forEach((p, index) => {
        total += p.precio * p.cantidad;
        const div = document.createElement('div');
        div.className = 'carrito-item';
        div.innerHTML = `
            <span>${p.nombre}</span>
            <div style="display:flex; align-items:center; gap:5px;">
                <input type="number" min="1" value="${p.cantidad}" onchange="cambiarCantidad(${index}, this.value)">
                <span>S/ ${(p.precio*p.cantidad).toFixed(2)}</span>
                <button onclick="eliminarPlato(${index})">X</button>
            </div>
        `;
        cont.appendChild(div);
    });

    // Total
    const totalDiv = document.createElement('div');
    totalDiv.textContent = `Total: S/ ${total.toFixed(2)}`;
    cont.appendChild(totalDiv);

    actualizarBadge();
}

function cambiarCantidad(index, cantidad) {
    cantidad = parseInt(cantidad);
    if (isNaN(cantidad) || cantidad < 1) cantidad = 1;
    carrito[index].cantidad = cantidad;
    renderCarrito();
}

function eliminarPlato(index) {
    carrito.splice(index, 1);
    renderCarrito();
}

// WhatsApp
document.getElementById('enviarWhatsApp').addEventListener('click', function() {
    if (carrito.length === 0) return alert("El carrito está vacío");
    let mensaje = "¡Hola! Quiero hacer el siguiente pedido:%0A";
    carrito.forEach(p => {
        mensaje += `- ${p.nombre} x${p.cantidad} = S/ ${(p.precio*p.cantidad).toFixed(2)}%0A`;
    });
    mensaje += "Gracias.";
    const numeroWhatsApp = "51955365019";
    window.open(`https://wa.me/${numeroWhatsApp}?text=${mensaje}`, "_blank");
});

// ----------------- Chat -----------------
const chatbotFab = document.getElementById('chatbot-fab');
const chatbotWindow = document.getElementById('chatbot-window');
chatbotFab.addEventListener('click', toggleChatbot);

function toggleChatbot() {
    chatbotWindow.style.display = chatbotWindow.style.display === 'flex' ? 'none' : 'flex';
}

document.getElementById('chatbot-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const input = document.getElementById('chatbot-input');
    const msg = input.value.trim();
    if (!msg) return;
    const cont = document.getElementById('chatbot-messages');

    // Mostrar mensaje usuario
    const divUser = document.createElement('div');
    divUser.className = 'chat-msg chat-user';
    divUser.textContent = msg;
    cont.appendChild(divUser);

    input.value = '';
    cont.scrollTop = cont.scrollHeight;

    // Respuesta bot (ejemplo)
    setTimeout(() => {
        const divBot = document.createElement('div');
        divBot.className = 'chat-msg chat-bot';
        divBot.textContent = "Hola! Gracias por tu mensaje, pronto te responderemos.";
        cont.appendChild(divBot);
        cont.scrollTop = cont.scrollHeight;
    }, 500);
});
