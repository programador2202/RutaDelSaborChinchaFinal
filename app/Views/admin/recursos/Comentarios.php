<?= $header ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  .card-custom {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
  }
  .card-header {
    background: linear-gradient(45deg, #0d6efd, #0a58ca);
    color: #fff;
    border-radius: 12px 12px 0 0;
    padding: 15px 30px;
  }
  .table thead th {
    background: #f1f3f5;
    color: #212529;
    text-align: center;
    font-weight: 600;
    white-space: nowrap;
  }
  .table-hover tbody tr:hover {
    background-color: #f8f9fa;
  }
  .table td, .table th {
    vertical-align: middle;
    text-align: center;
  }
  .col-texto {
    max-width: 200px;       
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>

<div class="container mt-4">
  <div class="card card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-chat-dots me-2"></i>Comentarios de Usuarios</h5>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Local</th>
              <th>Usuario</th>
              <th>Comentario</th>
              <th>Valoración</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($comentarios)): ?>
              <?php foreach ($comentarios as $c): ?>
                <tr>
                  <td><?= esc($c['idcomentario']) ?></td>
                  <td><?= esc($c['idlocales']) ?></td>
                  <td><?= esc($c['tokenusuario']) ?></td>
                  <td class="col-texto" title="<?= esc($c['comentario']) ?>">
                    <?= esc($c['comentario']) ?>
                  </td>
                  <td>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                      <i class="bi <?= $i <= $c['valoracion'] ? 'bi-star-fill text-warning' : 'bi-star text-secondary' ?>"></i>
                    <?php endfor; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center text-muted py-3">No hay comentarios disponibles.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
