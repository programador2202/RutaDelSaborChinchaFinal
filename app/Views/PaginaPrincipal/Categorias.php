
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías | Ruta del Sabor Chincha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/Categorias.css') ?>">
</head>
<body>

    <!-- HEADER -->
      <?= $header; ?>

    <!-- CATEGORÍAS -->
    <section class="py-5 bg-light">
      <div class="container">
        <h2 class="text-center mb-4 text-black"><b>Explora por Categorías</b></h2>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 justify-content-center">
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-utensils categoria-icono"></i><div>Comida Oriental</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-drumstick-bite categoria-icono"></i><div>Pollerías</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-pizza-slice categoria-icono"></i><div>Pizzerías</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-hamburger categoria-icono"></i><div>Hamburguesas</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-fish categoria-icono"></i><div>Mariscos</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-coffee categoria-icono"></i><div>Cafeterías</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-fire categoria-icono"></i><div>Parrillas</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-wine-glass-alt categoria-icono"></i><div>Vitivinícolas</div></div></div>
        </div>
      </div>
    </section>

    <!-- PLATOS DESTACADOS -->
    <section class="container py-5" id="platosDestacados">
  <h1 class=" mb-4"> Comida Oriental</h1>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="platosContainer">
    <!-- Los platos se cargarán dinámicamente aquí -->
  </div>
</section>

<!---FOOTER-->
 <?= $footer; ?>


<script>
  // Función para cargar los platos desde el controller
  async function cargarPlatos() {
    try {
      const response = await fetch('../controllers/Platos.php?task=getAll');
      const platos = await response.json();

      const container = document.getElementById('platosContainer');
      container.innerHTML = ''; // limpiar contenido previo

      platos.forEach(plato => {
        const col = document.createElement('div');
        col.className = 'col';

        col.innerHTML = `
          <div class="card h-100 shadow-sm plato-card">
            <img src="../public/img/platos/${plato.imagen}" class="card-img-top" alt="${plato.nom_platos}">
            <div class="card-body">
              <h5 class="card-title">${plato.nom_platos}</h5>
              <p class="card-text">${plato.descripcion}</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
              <span class="fw-bold text-success">S/ ${parseFloat(plato.precio).toFixed(2)}</span>
              <button class="btn btn-outline-primary btn-sm">⭐ Calificar</button>
            </div>
          </div>
        `;

        container.appendChild(col);
      });

    } catch (error) {
      console.error('Error al cargar los platos:', error);
    }
  }

  // Cargar los platos al cargar la página
  window.addEventListener('DOMContentLoaded', cargarPlatos);
</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>