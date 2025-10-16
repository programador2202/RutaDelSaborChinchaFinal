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
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
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
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarTexto('Comida Oriental')">
      <i class="fas fa-utensils me-2"></i> Comida Oriental
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarTexto('Hamburgueserias')">
      <i class="fas fa-hamburger me-2"></i> Hamburguesas
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarTexto('Mariscos')">
      <i class="fas fa-fish me-2"></i> Mariscos
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarTexto('Pollerías')">
      <i class="fas fa-drumstick-bite me-2"></i> Pollerías
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarTexto('Pizzerías')">
      <i class="fas fa-pizza-slice me-2"></i> Pizzerías
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarTexto('Cafeterías y Pastelerías')">
      <i class="fas fa-coffee me-2"></i> Cafeterías y Pastelerías
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarTexto('Parrillas')">
      <i class="fas fa-fire me-2"></i> Parrillas
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarTexto('Vitinicolas')">
      <i class="fas fa-wine-glass-alt me-2"></i> Vitivinícolas
    </button>
    <button class="list-group-item list-group-item-action d-flex align-items-center" onclick="filtrarTexto('Gourmet')">
  <i class="fas fa-cheese me-2"></i> Gourmet
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

  
<?= $dinamica; ?>
  <!-- FOOTER -->
  <?= $footer; ?>
  
</body>
</html>

<script>
  window.isLoggedIn = <?= session()->get('logged_in') ? 'true' : 'false' ?>;
  window.loginUrl = "<?= base_url('login') ?>";  // Guarda la URL del login para usar en JS
</script>

  <script src="<?= base_url('assets/js/global.js') ?>"></script>
  <!-- Scripts -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/js/Map.js') ?>"></script>
  
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
    .then(res => {
      if (!res.ok) throw new Error('Respuesta no OK: ' + res.status);
      return res.text();
    })
    .then(html => {
      resultadosDiv.innerHTML = html;
      sugerenciasDiv.innerHTML = "";
      // actualizar mapa con la búsqueda
      if (window.cargarRestaurantesPorPlato) {
        window.cargarRestaurantesPorPlato(query);
      }
    })
    .catch(err => console.error("Error en búsqueda:", err));
});

// Autocomplete
buscador.addEventListener("input", function() {
  const query = buscador.value.trim();
  if (query.length < 3) {
    sugerenciasDiv.innerHTML = "";
    limpiarMarcadores(); // Limpia el mapa si la búsqueda es muy corta
    return;
  }
  fetch("<?= base_url('/buscar/sugerencias') ?>?q=" + encodeURIComponent(query))
    .then(res => res.json())
    .then(data => {
      sugerenciasDiv.innerHTML = "";
      if (data.length === 0) {
        sugerenciasDiv.innerHTML = "<div class='list-group-item'>Sin resultados</div>";
        limpiarMarcadores();
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

          // Cargar en el mapa los restaurantes/platos según la sugerencia
          cargarRestaurantesPorPlato(item.texto);

          // Si tienes un botón buscar para enviar formulario o recargar resultados, también puedes activarlo:
          // btnBuscar.click();
        });
        sugerenciasDiv.appendChild(option);
      });
    })
    .catch(err => console.error("Error en sugerencias:", err));
});



window.cargarRestaurantesPorPlato = function(plato = '') {
    let url = "<?= base_url('/buscar/mapaBusquedaPorPlato') ?>";
    if (plato) {
        url += '?q=' + encodeURIComponent(plato);
    } else {
        limpiarMarcadores();
        return;
    }

    fetch(url)
        .then(res => {
            if (!res.ok) throw new Error("Error en la respuesta del servidor");
            return res.json();
        })
        .then(data => {
            mostrarRestaurantes(data);
        })
        .catch(err => console.error("Error cargando restaurantes por plato:", err));
};


</script>
