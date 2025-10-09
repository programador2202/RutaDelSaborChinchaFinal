<?= $header ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
  }
  .btn-action {
    border-radius: 50px;
    padding: 6px 10px;
    margin: 0 2px;
    font-size: 14px;
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
      <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Comentarios de Usuarios</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>local</th>
              <th>tokenusuario</th>
              <th>Comentario</th>
              <th>Valoracion</th>  
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($comentarios)): ?>
              <?php foreach($comentarios as $c): ?>
                <tr>
                  <td class="text-center"><?= $c['idcomentario'] ?></td>
                  <td class="text-center"><?= $c['idlocales'] ?></td>
                  <td class="text-center"><?= $c['tokenusuario'] ?></td>
                  <td class="text-center" title="<?= $c['comentario'] ?>"><?= $c['comentario'] ?></td>
                  <td class="text-center"><?= $c['valoracion'] ?></td>
                </tr>
              <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center">No hay comentarios disponibles.</td></tr>
                  <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
