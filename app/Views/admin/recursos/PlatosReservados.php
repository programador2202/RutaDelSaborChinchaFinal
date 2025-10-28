<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

<style>
  .card-custom {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.08);
  }
  .card-header {
    background: linear-gradient(45deg, #0d6efd, #0a58ca);
    color: #fff;
    border-radius: 12px 12px 0 0;
    padding: 15px 20px;
  }
  .table thead th {
    background: #f1f3f5;
    color: #212529;
    text-align: center;
    font-weight: 600;
  }
  .table-hover tbody tr:hover {
    background-color: #f8f9fa;
  }
  .badge-status {
    font-size: 0.85rem;
    padding: 0.5em 0.75em;
  }
</style>

<div class="container mt-4">
  <div class="card card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-clipboard-check me-2"></i> Platos de Reservas Confirmadas</h5>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>Cliente</th>
              <th>Local</th>
              <th>Fecha Reserva</th>
              <th>Plato</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Total</th>
              <th>Observación</th>
            </tr>
          </thead>
          <tbody>
            
            <?php if (!empty($platos_confirmados)): ?>
              <?php $i = 1; foreach($platos_confirmados as $p): ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= esc($p['nombre_cliente']) ?></td>
                <td><?= esc($p['nombre_negocio']) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($p['fechahora'])) ?></td>
                <td><?= esc($p['nombreplato']) ?></td>
                <td><span class="badge bg-secondary"><?= esc($p['cantidad']) ?></span></td>
                <td>S/ <?= number_format($p['precio'], 2) ?></td>
                <td><strong>S/ <?= number_format($p['precio'] * $p['cantidad'], 2) ?></strong></td>
                <td><?= esc($p['observacion'] ?: '-') ?></td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9" class="text-muted py-4">
                  <i class="bi bi-info-circle"></i> No hay platos registrados en reservas confirmadas.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


