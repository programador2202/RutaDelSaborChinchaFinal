<?php if (!empty($resultados)): ?>
  <ul class="list-group">
    <?php foreach ($resultados as $row): ?>
      <li class="list-group-item">
        <!-- Nombre del negocio -->
        <b><?= esc($row['negocio']); ?></b><br>

        <!-- Plato y precio -->
        <?php if (!empty($row['plato'])): ?>
          Plato: <?= esc($row['plato']); ?> (S/ <?= esc($row['precio']); ?>)<br>
        <?php else: ?>
          <span class="text-muted">Sin platos registrados</span><br>
        <?php endif; ?>

        <!-- Dirección -->
        Dirección: <?= esc($row['direccion']); ?><br>

        <!-- Botón visitar -->
        <a href="<?= base_url('negocios/ver/' . $row['idnegocio']); ?>" 
           class="btn btn-sm btn-primary mt-2">
          <i class="bi bi-box-arrow-up-right"></i> Visitar
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>No se encontraron resultados para <b><?= esc($q); ?></b></p>
<?php endif; ?>
