<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ruta del Sabor Chincha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">



</head>
<body>

  <?= $header; ?>

  
  <main>

  <div class="container my-5">
  <h3 class="text-center mb-3"><b>Encuentra tu restaurante favorito</b></h3>
  <div class="input-group shadow">
    <input type="text" class="form-control" placeholder="Buscar por nombre o plato..." id="buscador">
    <button class="btn btn-danger"><i class="fas fa-search"></i></button>
  </div>
</div>

  <!-- Mapa y Categorias -->
<section id="explora" class="py-5 bg-light">
  <div class="container">
    <div class="row">
      <!-- Columna izquierda: Mapa -->
      <div class="col-md-8 mb-4">
        <div id="map" style="height: 600px;  border-radius: 12px; overflow: hidden;"></div>
      </div>

      <!-- Columna derecha: Categorías -->
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
    </div>
  </div>
</section>

    <!-- RESTAURANTES DESTACADOS -->
    <section class="py-5 bg-white">
      <div class="container">
        <h2 class="text-center mb-4 text-black"><b>Destacado Del Mes</b></h2>

        <div class="scroll-wrapper">
          <!-- Botones -->
          <button class="scroll-btn left" onclick="scrollRestaurantes(-1)">&#10094;</button>
          <button class="scroll-btn right" onclick="scrollRestaurantes(1)">&#10095;</button>

          <div class="scroll-container" id="restaurantesScroll">
            <!-- Tarjetas -->
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
                <a href="<?= base_url('views/restaurantes/MisterWok.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

            <div class="card scroll-card">
              <img src="<?= base_url('img/el_gran_combo restaurante_chincha_c (3).jpg') ?>" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>El Gran Combo</b></h5>
                <p class="card-text">Una experiencia gastronómica que celebra las ricas tradiciones culinarias.</p>
                <a href="<?= base_url('views/restaurantes/ElGranCombo.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

            <div class="card scroll-card">
              <img src="<?= base_url('img/3.jpg') ?>" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>Daddy’s Truck’s Burger!</b></h5>
                <p class="card-text">Una experiencia de comida rápida diferente en Chincha.</p>
                <a href="<?= base_url('views/restaurantes/DaddyTrick.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

            <div class="card scroll-card">
              <img src="<?= base_url('img/daito (5).jpg') ?>" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>DAITO</b></h5>
                <p class="card-text">Exquisita cocina Nikkei, mezcla de Perú y Japón.</p>
                <a href="<?= base_url('views/restaurantes/Daito.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

            <div class="card scroll-card">
              <img src="<?= base_url('img/vitivinicola_chincha_san_carlos (1).jpg') ?>" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>Viñedos San Carlos</b></h5>
                <p class="card-text">Una bodega en el pintoresco valle de Sunampe, Chincha, Perú.</p>
                <a href="<?= base_url('views/restaurantes/ViñedosSanCarlos.php') ?>" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5 bg-light text-dark text-center">
  <h3><b>¿Tienes un restaurante en Chincha?</b></h3>
  <p>Únete a <b>Ruta del Sabor Chincha</b> y haz que tu negocio aparezca en nuestra plataforma.</p>
  
  <form class="row g-2 justify-content-center mt-3" style="max-width: 900px; margin: auto;">
    <!-- Nombre del negocio -->
    <div class="col-md-5">
      <input type="text" class="form-control" placeholder="Nombre del negocio" required>
    </div>
    <!-- Correo -->
    <div class="col-md-5">
      <input type="email" class="form-control" placeholder="Correo de contacto" required>
    </div>
    <!-- Número de celular -->
    <div class="col-md-5">
      <input type="tel" class="form-control" placeholder="Número de celular" maxlength="9" required>
    </div>
    <!-- Descripción del negocio -->
    <div class="col-md-5">
      <input type="text" class="form-control" placeholder="¿De qué trata tu negocio?" required>
    </div>
    <!-- Botón -->
    <div class="col-12">
      <button class="btn btn-danger px-4 mt-2"><b>Quiero unirme</b></button>
    </div>
  </form>
</section>


  

  <!-- Chat -->
  <a href="#" id="chatbot-fab" title="Chat inteligente"><i class="fas fa-robot"></i></a>
  <div id="chatbot-window" style="display:none; position:fixed; bottom:100px; right:32px; width:320px; background:#fff; border-radius:16px; box-shadow:0 4px 16px rgba(0,0,0,0.2); z-index:10000; overflow:hidden;">
    <div style="background:#007baf; color:#fff; padding:12px; font-weight:bold;">Chat Inteligente
      <span style="float:right; cursor:pointer;" onclick="document.getElementById('chatbot-window').style.display='none'">&times;</span>
    </div>
    <div style="text-align:center; color:#888; font-size:0.9rem;">¡Hola! ¿En qué puedo ayudarte?</div>
    <div id="chatbot-messages" style="height:260px; overflow-y:auto; padding:10px; font-size:1rem;"></div>
    <form id="chatbot-form" style="display:flex; border-top:1px solid #eee;">
      <input type="text" id="chatbot-input" autocomplete="off" placeholder="Escribe tu consulta..." style="flex:1; border:none; padding:10px;">
      <button type="submit" style="background:#007baf; color:#fff; border:none; padding:0 16px;">Enviar</button>
    </form>
  </div>

  <?= $footer; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

 <!-- JS Leaflet -->
<script>
  // Inicializar mapa
  var map = L.map('map').setView([-13.4096, -76.1325], 13); // Chincha

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
  }).addTo(map);

  // Datos de ejemplo (simulación de BD)
  var restaurantes = [
    {nombre: "Sushi House", categoria: "hamburguesa", lat: -13.41, lng: -76.14},
    {nombre: "Burger King", categoria: "hamburguesa", lat: -13.42, lng: -76.13},
    {nombre: "Mariscos del Puerto", categoria: "marisco", lat: -13.40, lng: -76.12},
    {nombre: "Pollería El Sabor", categoria: "polleria", lat: -13.415, lng: -76.135},
    {nombre: "Pizza Italia", categoria: "pizza", lat: -13.418, lng: -76.138}
  ];

  var markers = [];

  function filtrarCategoria(cat) {
    // Eliminar marcadores anteriores
    markers.forEach(m => map.removeLayer(m));
    markers = [];

    // Filtrar restaurantes por categoría
    var filtrados = restaurantes.filter(r => r.categoria === cat);

    filtrados.forEach(r => {
      var marker = L.marker([r.lat, r.lng]).addTo(map)
        .bindPopup("<b>" + r.nombre + "</b>");
      markers.push(marker);
    });

    // Centrar mapa en el primer restaurante
    if (filtrados.length > 0) {
      map.setView([filtrados[0].lat, filtrados[0].lng], 15);
    }
  }
</script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const selectCategoria = document.querySelector('select[name="categoria"]');
      fetch("<?= base_url('controllers/Categoria.php?task=getAll') ?>")
        .then(response => response.json())
        .then(data => {
          data.forEach(categoria => {
            const option = document.createElement("option");
            option.value = categoria.idcategoria;
            option.textContent = categoria.nombre;
            selectCategoria.appendChild(option);
          });
        })
        .catch(error => console.error("Error al cargar categorías:", error));
    });

    function scrollRestaurantes(direction) {
      const container = document.getElementById('restaurantesScroll');
      const cardWidth = container.querySelector('.scroll-card').offsetWidth + 16; 
      container.scrollBy({ left: direction * cardWidth, behavior: 'smooth' });
    }

    // Chat flotante
    document.getElementById('chatbot-fab').onclick = function(e) {
      e.preventDefault();
      var win = document.getElementById('chatbot-window');
      win.style.display = win.style.display === 'none' ? 'block' : 'none';
    };

    document.getElementById('chatbot-form').onsubmit = async function(e) {
      e.preventDefault();
      const input = document.getElementById('chatbot-input');
      const msg = input.value.trim();
      if(!msg) return;
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
