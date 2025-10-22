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
  .btn-warning {
    background-color: #ffc107;
    border: none;
  }
  .btn-warning:hover {
    background-color: #e0a800;
  }
  .btn-danger {
    background-color: #dc3545;
    border: none;
  }
  .btn-danger:hover {
    background-color: #b02a37;
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
      <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i> Lista de usuarios_login</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Email</th>
               <th>telefono</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="tablaUsuarios">
            <?php foreach ($usuarios_login as $usuario): ?>
              <tr id="fila-<?= $usuario['id'] ?>">
                <td><span class="badge bg-secondary"><?= $usuario['id'] ?></td>
                <td><?= esc($usuario['nombre']) ?></td>
                <td><?= esc($usuario['apellido']) ?></td>
                <td><?= esc($usuario['email']) ?></td>
                <td><?= esc($usuario['telefono']) ?></td>
                <td>
                  <button class="btn btn-sm btn-warning btnEditar btn-action"
                          data-id="<?= $usuario['id'] ?>"
                          data-nombre="<?= esc($usuario['nombre']) ?>"
                          data-apellido="<?= esc($usuario['apellido']) ?>"
                          data-email="<?= esc($usuario['email']) ?>"
                          data-password="<?= esc($usuario['password']) ?>"> 
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <button class="btn btn-sm btn-danger btnEliminar btn-action"
                          data-id="<?= $usuario['id'] ?>">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Modal para editar usuario -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Editar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editId">
        <div class="mb-3">
          <label class="form-label">Nombre</label>
          <input type="text" id="editNombre" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Apellido</label>
          <input type="text" id="editApellido" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" id="editEmail" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Teléfono</label>
          <input type="text" id="editTelefono" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary" id="btnGuardarCambios">
          <i class="bi bi-save"></i> Guardar Cambios
        </button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>

<script>
$(document).ready(function() {

  // Abrir modal para editar
  $('.btnEditar').on('click', function() {
    $('#editId').val($(this).data('id'));
    $('#editNombre').val($(this).data('nombre'));
    $('#editApellido').val($(this).data('apellido'));
    $('#editEmail').val($(this).data('email'));
    $('#telefono').val($(this).data('telefono'));
    $('#modalEditar').modal('show');
  });

  // Guardar cambios con AJAX
  $('#btnGuardarCambios').on('click', function() {
    $.post("<?= base_url('/usuarios/ajax') ?>", {
      accion: 'actualizar',
      id: $('#editId').val(),
      nombre: $('#editNombre').val(),
      apellido: $('#editApellido').val(),
      email: $('#editEmail').val(),
      telefono: $('#editTelefono').val()
    }, function(res) {
      if (res.status === 'success') {
        Swal.fire({
          icon: 'success',
          title: 'Actualizado',
          text: res.mensaje,
          timer: 1500,
          showConfirmButton: false
        }).then(() => location.reload());
      } else {
        Swal.fire('Error', res.mensaje, 'error');
      }
    }, 'json');
  });

  // Eliminar usuario con confirmación
  $('.btnEliminar').on('click', function() {
    const id = $(this).data('id');
    Swal.fire({
      title: '¿Eliminar usuario?',
      text: 'Esta acción no se puede deshacer',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("<?= base_url('/usuarios/ajax') ?>", {
          accion: 'borrar',
          id: id
        }, function(res) {
          if (res.status === 'success') {
            $('#fila-' + id).fadeOut(400, function() { $(this).remove(); });
            Swal.fire('Eliminado', res.mensaje, 'success');
          } else {
            Swal.fire('Error', res.mensaje, 'error');
          }
        }, 'json');
      }
    });
  });

});
</script>
