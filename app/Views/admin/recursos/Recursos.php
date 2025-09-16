<?= $header ?>

<div class="container mt-4">
  <h2 class="mb-4">Listado de Recursos</h2>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>ID Carta</th>
        <th>Descripción</th>
        <th>Ruta Recurso</th>
        <th>Tipo Recurso</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($recursos) && is_array($recursos)): ?>
        <?php foreach ($recursos as $recurso): ?>
          <tr>
            <td><?= esc($recurso['idrecurso']) ?></td>
            <td><?= esc($recurso['idcarta']) ?></td>
            <td><?= esc($recurso['descripcion']) ?></td>
            <td><?= esc($recurso['rutarecurso']) ?></td>
            <td><?= esc($recurso['tiporecurso']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" class="text-center">No hay recursos registrados</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

