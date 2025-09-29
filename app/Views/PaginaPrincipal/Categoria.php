<?= $header; ?> 

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
<style>
  /* Card hover */

  .swiper-slide {
  display: flex;          /* hace que ocupe toda la altura */
  height: auto;           /* evita que Swiper fuerce tamaños */
}

.card-business {
  height: 100%;           /* todas las cards igual de altas */
  display: flex;
  flex-direction: column; /* cuerpo flexible */
}
.card-business .card-body {
  flex-grow: 1;           /* hace que el body se expanda */
  display: flex;
  flex-direction: column;
}
 .card-business:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
  }
  .card-business img {
    object-fit: cover;
    height: 180px;
    width: 100%;
  }
  /* Estilo del título de la categoría */
.category-title {
    display: block;
    margin: 20px 0 15px;   
    padding-bottom: 5px;   
    font-weight: bold;
    font-size: 1.5rem;
    color: #000000ff;        /* texto rojo */
    border-bottom: 3px solid #dc3545; /* línea debajo del título */
    border-radius: 2px;    /* bordes ligeramente redondeados */
}

/* Botones de navegación de Swiper */
.swiper-button-next,
.swiper-button-prev {
    color: #c80000ff;  
    display: flex;
    align-items: center;
    justify-content: center;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    color: #b80000ff;
}


</style>

<div class="container mt-4">
  <?php 
  $categoriaActual = '';
  foreach ($negocios as $negocio): 
      if ($categoriaActual !== $negocio['categoria']): 
          if ($categoriaActual !== ''): ?>
              </div> <!-- cierre swiper-wrapper -->
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div> <!-- cierre swiper-container -->
          <?php endif; ?>

          <!-- Título de categoría -->
          <h3 class="category-title"><?= esc($negocio['categoria']) ?></h3>

          <!-- Swiper container por categoría -->
          <div class="swiper mySwiper mb-5">
            <div class="swiper-wrapper">
          <?php $categoriaActual = $negocio['categoria']; ?>
      <?php endif; ?>

      <!-- Card como slide -->
      <div class="swiper-slide">
        <div class="card card-business h-100 shadow-sm">
          <img src="<?= !empty($negocio['logo']) 
                        ? base_url($negocio['logo']) 
                        : base_url('assets/img/negocios/default.png'); ?>" 
               alt="Logo de <?= esc($negocio['nombre']) ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><b><?= esc($negocio['nombre']) ?></b></h5>
            <p class="card-text text-muted small">
              <?= esc($negocio['slogan'] ?? 'Sin slogan') ?>
            </p>
           <a href="<?= base_url('negocios/detalle/'.$negocio['idnegocio']) ?>" 
      class="btn btn-warning mt-auto">Ver más</a>


          </div>
        </div>
      </div>

  <?php endforeach; ?>
  </div> <!-- cierre swiper-wrapper última categoría -->
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
</div> <!-- cierre swiper-container última categoría -->

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
  document.querySelectorAll('.mySwiper').forEach((swiperEl) => {
    new Swiper(swiperEl, {
      slidesPerView: 1,
      spaceBetween: 20,
      breakpoints: {
        576: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        1200: { slidesPerView: 4 },
      },
      navigation: {
        nextEl: swiperEl.querySelector('.swiper-button-next'),
        prevEl: swiperEl.querySelector('.swiper-button-prev'),
      },
    });
  });
</script>

<?= $footer; ?>
