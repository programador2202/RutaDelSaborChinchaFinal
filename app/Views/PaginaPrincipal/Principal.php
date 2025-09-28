<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ruta del Sabor Chincha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>

  <?= $header; ?>
  <main>
    <!-- Buscador -->
   <div class="container my-5">
      <h3 class="text-center mb-3"><b>Encuentra tu restaurante favorito</b></h3>
      <div class="input-group shadow position-relative">
        <input type="text" class="form-control" placeholder="Buscar por nombre o plato..." id="buscador" autocomplete="off">
        <button class="btn btn-danger" id="btnBuscar"><i class="fas fa-search"></i></button>
        <div id="sugerencias" class="list-group position-absolute w-100" style="z-index:1000; top:100%;"></div>
      </div>
      <div class="mt-4" id="resultados"></div>
    </div>

  <!-- Mapa y Categorías -->
<section id="explora" class="py-5 bg-light">
  <div class="container">
    <div class="row">
      <!-- Mapa -->
      <div class="col-md-8 mb-4">
        <div id="map" style="height: 600px; border-radius: 12px; overflow: hidden;"></div>
      </div>

     
   <!-- Categorías -->
<div class="col-md-4">
  <h3 class="text-center mb-4"><b>Explora por Categorías</b></h3>
  <div class="list-group shadow-sm">
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarCategoria('oriental')">
      <i class="fas fa-utensils me-2"></i> Comida Oriental
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarCategoria('hamburguesa')">
      <i class="fas fa-hamburger me-2"></i> Hamburguesas
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarCategoria('marisco')">
      <i class="fas fa-fish me-2"></i> Mariscos
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarCategoria('polleria')">
      <i class="fas fa-drumstick-bite me-2"></i> Pollerías
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarCategoria('pizza')">
      <i class="fas fa-pizza-slice me-2"></i> Pizzerías
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarCategoria('cafe')">
      <i class="fas fa-coffee me-2"></i> Cafeterías y Pastelerías
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarCategoria('parrilla')">
      <i class="fas fa-fire me-2"></i> Parrillas
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarCategoria('vino')">
      <i class="fas fa-wine-glass-alt me-2"></i> Vitivinícolas
    </button>
  </div>
</div>
</section>


    <!-- Destacados -->
    <section class="py-5 bg-white">
      <div class="container">
        <h2 class="text-center mb-4 text-black"><b>Destacado Del Mes</b></h2>
        <div class="scroll-wrapper">
          <button class="scroll-btn left" onclick="scrollRestaurantes(-1)">&#10094;</button>
          <button class="scroll-btn right" onclick="scrollRestaurantes(1)">&#10095;</button>
          <div class="scroll-container" id="restaurantesScroll">
            <!-- Card ejemplo -->
            <div class="card scroll-card">
              <img src="<?= base_url('img/causa_agresiva (2).jpg') ?>" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>El Punto Marino</b></h5>
                <p class="card-text">¡Explora el Encanto del Mar en el Punto Marino!</p>
                <a href="<?= base_url('views/restaurantes/ElPuntoMarino.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

             <div class="card scroll-card">
              <img src="<?= base_url('img/Chijaukay.jpg') ?>" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>Mister Wok</b></h5>
                <p class="card-text">¿Antojo de comida china? Descubre el auténtico sabor del chifa en Mister Wok</p>
                <a href="<?= base_url('views/restaurantes/ElPuntoMarino.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>
             <div class="card scroll-card">
              <img src="<?= base_url('img/el_gran_combo restaurante_chincha_c (3).jpg') ?>" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>El Gran Combo</b></h5>
                <p class="card-text">Somos el lugar ideal para disfrutar de una experiencia gastronómica que celebra las ricas tradiciones culinarias.</p>
                <a href="<?= base_url('views/restaurantes/ElPuntoMarino.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>
             <div class="card scroll-card">
              <img src="<?= base_url('img/3.jpg') ?>" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>¡Daddy’s Truck’s Burger!</b></h5>
                <p class="card-text">Daddy’s Trucks Burger es un restaurante único en Chincha que se distingue por ofrecer una experiencia de comida rápida diferente</p>
                <a href="<?= base_url('views/restaurantes/ElPuntoMarino.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>
             <div class="card scroll-card">
              <img src="<?= base_url('img/daito (5).jpg') ?>" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>DAITO</b></h5>
                <p class="card-text">En Daito, nos enorgullecemos de ser un restaurante dedicado a presentar la exquisita cocina Nikkei,
                  mezcla de sabores que refleja la rica herencia cultural de Perú y Japón.</p>
                <a href="<?= base_url('views/restaurantes/ElPuntoMarino.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>
            <div class="card scroll-card">
              <img src="<?= base_url('img/vitivinicola_chincha_san_carlos (1).jpg') ?>" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>Viñedos San Carlos</b></h5>
                <p class="card-text">Somos una bodega ubicada en el pintoresco valle de Sunampe, Chincha, Perú. 
                Viñedos San Carlos se destaca por su dedicación a la calidad, la innovación y el respeto por el medio ambiente.</p>
                <a href="<?= base_url('views/restaurantes/ElPuntoMarino.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Formulario -->
    <section class="py-5 bg-light text-dark text-center">
      <h3><b>¿Tienes un restaurante en Chincha?</b></h3>
      <p>Únete a <b>Ruta del Sabor Chincha</b> y haz que tu negocio aparezca en nuestra plataforma.</p>
      <form class="row g-2 justify-content-center mt-3" style="max-width: 900px; margin: auto;">
        <div class="col-md-5"><input type="text" class="form-control" placeholder="Nombre del negocio" required></div>
        <div class="col-md-5"><input type="email" class="form-control" placeholder="Correo de contacto" required></div>
        <div class="col-md-5"><input type="tel" class="form-control" placeholder="Número de celular" maxlength="9" required></div>
        <div class="col-md-5"><input type="text" class="form-control" placeholder="¿De qué trata tu negocio?" required></div>
        <div class="col-12"><button class="btn btn-danger px-4 mt-2"><b>Quiero unirme</b></button></div>
      </form>
    </section>
  </main>

  <!-- CHAT -->
  <a href="#" id="chatbot-fab" title="Chat inteligente"><i class="fas fa-robot"></i></a>
  <div id="chatbot-window" style="display:none; position:fixed; bottom:100px; right:32px; width:320px; background:#fff; border-radius:16px; box-shadow:0 4px 16px rgba(0,0,0,0.2); z-index:10000; overflow:hidden;">
    <div style="background:#007baf; color:#fff; padding:12px; font-weight:bold;">
      Chat Inteligente
      <span style="float:right; cursor:pointer;" onclick="document.getElementById('chatbot-window').style.display='none'">&times;</span>
    </div>
    <div style="text-align:center; color:#888; font-size:0.9rem;">¡Hola! ¿En qué puedo ayudarte?</div>
    <div id="chatbot-messages" style="height:260px; overflow-y:auto; padding:10px; font-size:1rem;"></div>
    <form id="chatbot-form" style="display:flex; border-top:1px solid #eee;">
      <input type="text" id="chatbot-input" autocomplete="off" placeholder="Escribe tu consulta..." style="flex:1; border:none; padding:10px;">
      <button type="submit" style="background:#007baf; color:#fff; border:none; padding:0 16px;">Enviar</button>
    </form>
  </div>

  <!-- FOOTER -->
  <?= $footer; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <!-- Buscador y Autocomplete -->
  <script>
    const buscador = document.getElementById("buscador");
    const btnBuscar = document.getElementById("btnBuscar");
    const sugerenciasDiv = document.getElementById("sugerencias");
    const resultadosDiv = document.getElementById("resultados");

    // Buscar
    btnBuscar.addEventListener("click", function() {
      const query = buscador.value.trim();
      if (!query) return;
      fetch("<?= base_url('/buscar') ?>?q=" + encodeURIComponent(query))
        .then(res => res.text())
        .then(html => {
          resultadosDiv.innerHTML = html;
          sugerenciasDiv.innerHTML = "";
        })
        .catch(err => console.error("Error en búsqueda:", err));
    });

    // Autocomplete
    buscador.addEventListener("input", function() {
      const query = buscador.value.trim();
      if (query.length < 3) {
        sugerenciasDiv.innerHTML = "";
        return;
      }
      fetch("<?= base_url('/buscar/sugerencias') ?>?q=" + encodeURIComponent(query))
        .then(res => res.json())
        .then(data => {
          sugerenciasDiv.innerHTML = "";
          if (data.length === 0) {
            sugerenciasDiv.innerHTML = "<div class='list-group-item'>Sin resultados</div>";
            return;
          }
          data.forEach(item => {
            const option = document.createElement("button");
            option.type = "button";
            option.className = "list-group-item list-group-item-action";
            option.textContent = item.texto;
            option.addEventListener("click", function() {
              buscador.value = item.texto;
              sugerenciasDiv.innerHTML = "";
              btnBuscar.click();
            });
            sugerenciasDiv.appendChild(option);
          });
        })
        .catch(err => console.error("Error en sugerencias:", err));
    });
  </script>

 <script>
  // Inicializamos el mapa centrado en Perú
  var map = L.map('map').setView([-13.4096, -76.1325], 13);

  // Capa base OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
  }).addTo(map);

  // Datos de ejemplo (con campo categoria)
  var restaurantes = [
    {id: 1, nombre: "DAITO", categoria:"oriental", distrito: "Sunampe", direccion: "Av. Principal 388 - Carr. de Sunampe", telefono: "940790534", lat: -13.4163, lng: -76.1580},
    {id: 2, nombre: "Mister Wok", categoria:"oriental", distrito: "Pueblo Nuevo", direccion: "Av. Óscar R. Benavides 598 - Plaza de Armas de Pueblo Nuevo", telefono: "924817518", lat: -13.4054, lng: -76.1302},
    {id: 3, nombre: "Sacha Nikkei", categoria:"oriental", distrito: "Chincha Alta", direccion: "Los Ángeles 153, Chincha Alta", telefono: "924826030", lat: -13.4168, lng: -76.1345},
    {id: 4, nombre: "El Gran Combo", categoria:"hamburguesa", distrito: "Chincha Alta", direccion: "Calle Grau N°427 - Chincha Alta - Perú", telefono: "995420277", lat: -13.4204, lng: -76.1327},
    {id: 5, nombre: "¡Daddy’s Truck’s Burger!", categoria:"hamburguesa", distrito: "Chincha Alta", direccion: "Prolongación Lima, Urb Bancarios E4, Chincha Alta", telefono: "934617457", lat: -13.4279, lng: -76.1411},
    {id: 6, nombre: "El Punto Marino", categoria:"marisco", distrito: "Chincha Alta", direccion: "Jr. Sebastián Barranca 551 Pueblo Nuevo, Chincha Alta, Peru", telefono: "978085372", lat: -13.4025, lng: -76.1324},
    {id: 7, nombre: "Viñedos San Carlos", categoria:"vino", distrito: "Sunampe", direccion: "Av. Alfonso Ugarte 300 cercado Sunampe", telefono: "956351703", lat: -13.4283, lng: -76.1624},
    {id: 8, nombre: "Viñedos Grimaldi", categoria:"vino", distrito: "Sunampe", direccion: "Av. Benavides 1412 Sunampe", telefono: "908913572", lat: -13.4136, lng: -76.1534},
    {id: 9, nombre: "El Copete", categoria:"vino", distrito: "Chincha Alta", direccion: "Urb. Olivar del Sur Mz. C – Lt. 04", telefono: "964998037", lat: -13.4220, lng: -76.1380} 
  ];

  var markers = [];
  var userMarker = null;

  // Función para pintar marcadores
  function mostrarRestaurantes(lista) {
    // Limpiar anteriores
    markers.forEach(m => map.removeLayer(m));
    markers = [];

    lista.forEach(r => {
      if (r.lat && r.lng) {
        let marker = L.marker([r.lat, r.lng]).addTo(map)
          .bindPopup(`
            <b>${r.nombre}</b><br>
            ${r.distrito}<br>
            ${r.direccion}<br>
            📞 ${r.telefono}
          `);
        markers.push(marker);
      }
    });

    // Ajustar el mapa a los restaurantes visibles
    if (lista.length > 0) {
      var bounds = L.latLngBounds(lista.map(r => [r.lat, r.lng]));
      map.fitBounds(bounds, { padding: [50, 50] });
    }
  }

  // Mostrar todos al inicio
  mostrarRestaurantes(restaurantes);

  // Geolocalización del usuario
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function(position) {
        const userLat = position.coords.latitude;
        const userLng = position.coords.longitude;

        if (userMarker) map.removeLayer(userMarker);

        userMarker = L.marker([userLat, userLng], {
          icon: L.icon({
            iconUrl: "https://cdn-icons-png.flaticon.com/512/684/684908.png",
            iconSize: [32, 32]
          })
        }).addTo(map).bindPopup("<b>Estás aquí</b>").openPopup();

      },
      function(error) {
        console.warn("Error obteniendo ubicación:", error.message);
      }
    );
  }

  // Filtro por categoría
  function filtrarCategoria(cat) {
    const filtrados = restaurantes.filter(r => r.categoria === cat);
    mostrarRestaurantes(filtrados);

    // Centrar también en usuario si existe
    if (userMarker) {
      const userPos = userMarker.getLatLng();
      const bounds = L.latLngBounds(filtrados.map(r => [r.lat, r.lng]).concat([[userPos.lat, userPos.lng]]));
      map.fitBounds(bounds, { padding: [50, 50] });
    }
  }
</script>


  <!-- Scroll tarjetas -->
  <script>
    function scrollRestaurantes(direction) {
      const container = document.getElementById('restaurantesScroll');
      const cardWidth = container.querySelector('.scroll-card').offsetWidth + 16;
      container.scrollBy({ left: direction * cardWidth, behavior: 'smooth' });
    }
  </script>

  <!-- Chat -->
  <script>
    document.getElementById('chatbot-fab').onclick = function(e) {
      e.preventDefault();
      var win = document.getElementById('chatbot-window');
      win.style.display = win.style.display === 'none' ? 'block' : 'none';
    };
    document.getElementById('chatbot-form').onsubmit = async function(e) {
      e.preventDefault();
      const input = document.getElementById('chatbot-input');
      const msg = input.value.trim();
      if (!msg) return;
      addMessage('Tú', msg);
      input.value = '';
      const res = await fetch('<?= base_url('controllers/chatbot.php') ?>', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'msg=' + encodeURIComponent(msg)
      });
      const data = await res.text();
      addMessage('Bot', data);
    };
    function addMessage(sender, text) {
      const box = document.getElementById('chatbot-messages');
      box.innerHTML += `<div><b>${sender}:</b> ${text}</div>`;
      box.scrollTop = box.scrollHeight;
    }
  </script>
</body>
</html>
