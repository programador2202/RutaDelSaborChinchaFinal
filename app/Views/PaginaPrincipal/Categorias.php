<?= $header; ?> 

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

  <h2 class="mb-4">Negocios por Categoría</h2>

  <?php 
  $categoriaActual = '';
  foreach ($negocios as $negocio): 
      if ($categoriaActual !== $negocio['categoria']): 
          // cerrar fila anterior
          if ($categoriaActual !== ''): ?>
              </div> <!-- cierre de row anterior -->
          <?php endif; ?>
          
          <h3 class="mt-4"><?= esc($negocio['categoria']) ?></h3>
          <div class="row">
          <?php $categoriaActual = $negocio['categoria']; ?>
      <?php endif; ?>

      <div class="col-md-4 mb-3">
          <div class="card shadow-sm">
              <!-- Si tienes campo imagen en BD, reemplaza "" por la ruta -->
              <img src="<?= base_url('assets/img/negocios/default.png'); ?>" 
                   class="card-img-top" 
                   alt="Imagen negocio">
              <div class="card-body">
                  <h5 class="card-title"><?= esc($negocio['nombre']) ?></h5>
                  <p class="card-text">
                      <em><?= esc($negocio['slogan'] ?? 'Sin slogan') ?></em>
                  </p>
                  <a href="<?= base_url('negocio/'.$negocio['idnegocio']) ?>" class="btn btn-primary">
                      Ver más
                  </a>
              </div>
          </div>
      </div>
  <?php endforeach; ?>
  </div> <!-- cierre de la última row -->

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?= $footer; ?>