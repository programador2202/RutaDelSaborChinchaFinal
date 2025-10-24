<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ruta del Sabor Chincha</title>

  <!--  Bootstrap y librerías externas -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

  <!-- Estilos propios -->
  <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
</head>
<body>

  <!--  HEADER -->
  <?= $header; ?>

  <main>
    <!--  BUSCADOR -->
    <div class="container my-5">
      <h3 class="text-center mb-3"><b>Encuentra tu restaurante favorito</b></h3>
      <div class="input-group shadow position-relative">
        <input type="text" class="form-control" placeholder="Buscar por nombre o plato..." id="buscador" autocomplete="off">
        <button class="btn btn-danger" id="btnBuscar"><i class="fas fa-search"></i></button>
        <div id="sugerencias" class="list-group position-absolute w-100" style="z-index:1000; top:100%;"></div>
      </div>
      <div class="mt-4" id="resultados"></div>
    </div>

    <!-- MAPA Y CATEGORÍAS -->
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
              <?php
              $categorias = [
                ['icon' => 'utensils', 'texto' => 'Comida Oriental'],
                ['icon' => 'hamburger', 'texto' => 'Hamburgueserías'],
                ['icon' => 'fish', 'texto' => 'Mariscos'],
                ['icon' => 'drumstick-bite', 'texto' => 'Pollerías'],
                ['icon' => 'pizza-slice', 'texto' => 'Pizzerías'],
                ['icon' => 'coffee', 'texto' => 'Cafeterías y Pastelerías'],
                ['icon' => 'fire', 'texto' => 'Parrillas'],
                ['icon' => 'wine-glass-alt', 'texto' => 'Vitinicolas'],
                ['icon' => 'cheese', 'texto' => 'Gourmet']
              ];

              foreach ($categorias as $cat): ?>
                <button class="list-group-item list-group-item-action d-flex align-items-center"
                        onclick="filtrarTexto('<?= $cat['texto'] ?>')">
                  <i class="fas fa-<?= $cat['icon'] ?> me-2"></i> <?= $cat['texto'] ?>
                </button>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- DESTACADOS -->
    <section class="py-5 bg-white">
      <div class="container">
        <h2 class="text-center mb-4 text-black"><b>Destacado del Mes</b></h2>

        <div class="scroll-wrapper position-relative">
          <button class="scroll-btn left" onclick="scrollRestaurantes(-1)">&#10094;</button>
          <button class="scroll-btn right" onclick="scrollRestaurantes(1)">&#10095;</button>

          <div class="scroll-container" id="restaurantesScroll">
            <?php if (!empty($negociosDestacados)): ?>
              <?php foreach ($negociosDestacados as $negocio): ?>
                <div class="card scroll-card">
                  <img 
                    src="<?= !empty($negocio['logo']) 
                            ? base_url($negocio['logo']) 
                            : base_url('img/default-logo.jpg') ?>" 
                    class="card-img-top"
                    alt="<?= esc($negocio['negocio']) ?>"
                  >

                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><b><?= esc($negocio['negocio']) ?></b></h5>
                    <p class="card-text mb-2">
                      Valoración: 
                      <span class="text-warning">
                        <?= number_format($negocio['promedio_valoracion'], 1) ?> ⭐
                      </span><br>
                      Comentarios: <?= $negocio['cantidad_comentarios'] ?>
                    </p>
                    <a href="<?= base_url('negocios/detalle/' . $negocio['idnegocio']) ?>" 
                       class="btn btn-warning mt-auto">
                      <b>Visitar</b>
                    </a>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-center text-muted">No hay negocios registrados aún.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- FORMULARIO DE CONTACTO -->
   <!-- <section class="py-5 bg-light text-dark text-center">
      <h3><b>¿Tienes un restaurante en Chincha?</b></h3>
      <p>Únete a <b>Ruta del Sabor Chincha</b> y haz que tu negocio aparezca en nuestra plataforma.</p>

      <form class="row g-2 justify-content-center mt-3" style="max-width: 900px; margin: auto;">
        <div class="col-md-5"><input type="text" class="form-control" placeholder="Nombre del negocio" required></div>
        <div class="col-md-5"><input type="email" class="form-control" placeholder="Correo de contacto" required></div>
        <div class="col-md-5"><input type="tel" class="form-control" placeholder="Número de celular" maxlength="9" required></div>
        <div class="col-md-5"><input type="text" class="form-control" placeholder="¿De qué trata tu negocio?" required></div>
        <div class="col-12"><button class="btn btn-danger px-4 mt-2"><b>Quiero unirme</b></button></div>
      </form>
    </section> -->
  </main>

  <!-- BLOQUES DINÁMICOS Y FOOTER -->
  <?= $dinamica;?>
  <?= $footer; ?>

  <!-- VARIABLES GLOBALES -->
  <script>
    window.isLoggedIn = <?= session()->get('logged_in') ? 'true' : 'false' ?>;
    window.loginUrl = "<?= base_url('login') ?>"; 
  </script>

  <!-- FUNCIONES JS -->
  <script>
    function scrollRestaurantes(direction) {
      const container = document.getElementById('restaurantesScroll');
      const scrollAmount = 300;
      container.scrollBy({ left: scrollAmount * direction, behavior: 'smooth' });
    }
  </script>

  <!-- SCRIPTS -->
  <script src="<?= base_url('assets/js/global.js') ?>"></script>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/js/Map.js') ?>"></script>

  <!--JS BUSCADOR -->
  <script>
    const buscador = document.getElementById("buscador");
    const btnBuscar = document.getElementById("btnBuscar");
    const sugerenciasDiv = document.getElementById("sugerencias");
    const resultadosDiv = document.getElementById("resultados");

    // 🔸 Buscar
    btnBuscar.addEventListener("click", () => {
      const query = buscador.value.trim();
      if (!query) return;
      fetch("<?= base_url('/buscar') ?>?q=" + encodeURIComponent(query))
        .then(res => res.text())
        .then(html => {
          resultadosDiv.innerHTML = html;
          sugerenciasDiv.innerHTML = "";
          if (window.cargarRestaurantesPorPlato) window.cargarRestaurantesPorPlato(query);
        })
        .catch(err => console.error("Error en búsqueda:", err));
    });

    //Autocomplete
    buscador.addEventListener("input", () => {
      const query = buscador.value.trim();
      if (query.length < 3) {
        sugerenciasDiv.innerHTML = "";
        limpiarMarcadores();
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
            option.addEventListener("click", () => {
              buscador.value = item.texto;
              sugerenciasDiv.innerHTML = "";
              cargarRestaurantesPorPlato(item.texto);
            });
            sugerenciasDiv.appendChild(option);
          });
        })
        .catch(err => console.error("Error en sugerencias:", err));
    });

    //Cargar resultados en mapa
    window.cargarRestaurantesPorPlato = function(plato = '') {
      let url = "<?= base_url('/buscar/mapaBusquedaPorPlato') ?>";
      if (plato) url += '?q=' + encodeURIComponent(plato);
      else { limpiarMarcadores(); return; }

      fetch(url)
        .then(res => res.json())
        .then(data => mostrarRestaurantes(data))
        .catch(err => console.error("Error cargando restaurantes por plato:", err));
    };
  </script>
</body>
</html>
