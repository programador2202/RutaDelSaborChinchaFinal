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
</style>

<div class="container mt-4">
  <div class="card card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i> Gestión de Personas</h5>
      <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-person-plus"></i> Nueva Persona
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Apellidos</th>
              <th>Nombres</th>
              <th>Tipo Doc</th>
              <th>Número Doc</th>
              <th>Teléfono</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($personas as $p): ?>
            <tr>
              <td class="text-center"><span class="badge bg-secondary"><?= $p['idpersona'] ?></span></td>
              <td><?= $p['apellidos'] ?></td>
              <td><?= $p['nombres'] ?></td>
              <td class="text-center"><span class="badge bg-dark"><?= $p['tipodoc'] ?></span></td>
              <td><?= $p['numerodoc'] ?></td>
              <td><?= $p['telefono'] ?></td>
              <td class="text-center">
                <button class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $p['idpersona'] ?>">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm btn-action btn-borrar" data-id="<?= $p['idpersona'] ?>">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>

            <!-- Modal editar -->
            <div class="modal fade" id="modalEditar<?= $p['idpersona'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form enctype="multipart/form-data">
                    <input type="hidden" name="accion" value="actualizar">
                    <input type="hidden" name="idpersona" value="<?= $p['idpersona'] ?>">

                    <div class="modal-header bg-warning text-dark">
                      <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Editar Persona</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <label>Apellidos:</label>
                      <input type="text" name="apellidos" class="form-control mb-2" value="<?= $p['apellidos'] ?>" required>

                      <label>Nombres:</label>
                      <input type="text" name="nombres" class="form-control mb-2" value="<?= $p['nombres'] ?>" required>

                      <label>Tipo de Documento:</label>
                      <select name="tipodoc" class="form-control mb-2" required>
                        <option value="DNI" <?= $p['tipodoc'] == 'DNI' ? 'selected' : '' ?>>DNI</option>
                        <option value="CE" <?= $p['tipodoc'] == 'CE' ? 'selected' : '' ?>>Carné de Extranjería</option>
                        <option value="PASAPORTE" <?= $p['tipodoc'] == 'PASAPORTE' ? 'selected' : '' ?>>Pasaporte</option>
                        <option value="RUC" <?= $p['tipodoc'] == 'RUC' ? 'selected' : '' ?>>RUC</option>
                        <option value="OTROS" <?= $p['tipodoc'] == 'OTROS' ? 'selected' : '' ?>>Otros</option>
                      </select>

                      <label>Número de Documento:</label>
                      <input type="text" name="numerodoc" class="form-control mb-2" value="<?= $p['numerodoc'] ?>">

                      <label>Teléfono:</label>
                      <input type="text" name="telefono" class="form-control mb-2" value="<?= $p['telefono'] ?>">

                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-warning">
                          <i class="bi bi-save"></i> Actualizar
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form enctype="multipart/form-data">
        <input type="hidden" name="accion" value="registrar" >
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nueva Persona</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label>Apellidos:</label>
          <input type="text" name="apellidos" class="form-control mb-2" placeholder="Apellidos" required>

          <label>Nombres:</label>
          <input type="text" name="nombres" class="form-control mb-2" placeholder="Nombres" required>

          <label>Tipo de Documento:</label>
          <select name="tipodoc" class="form-control mb-2" required>
            <option value="">Seleccione...</option>
            <option value="DNI">DNI</option>
            <option value="CE">Carné de Extranjería</option>
            <option value="PASAPORTE">Pasaporte</option>
            <option value="RUC">RUC</option>
            <option value="OTROS">Otros</option>
          </select>

          <label>Número de Documento:</label>
          <input type="text" name="numerodoc" class="form-control mb-2" placeholder="Número Doc">

          <label>Teléfono:</label>
          <input type="text" name="telefono" class="form-control mb-2" placeholder="Teléfono">

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">
              <i class="bi bi-check-circle"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const AJAX_URL = "<?= base_url('personas/ajax') ?>";

  const showAlert = (icon, title, timer = 1500) =>
    Swal.fire({ icon, title, timer, showConfirmButton: false, timerProgressBar: true });

  const sendRequest = async (formData) => {
    try {
      const res = await fetch(AJAX_URL, { method: 'POST', body: formData });
      return await res.json();
    } catch (err) {
      console.error('Fetch error:', err);
      showAlert('error', 'Error de conexión');
      return null;
    }
  };

  // Registrar / Actualizar persona
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const formData = new FormData(form);

      Swal.fire({ title: 'Procesando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
      const data = await sendRequest(formData);
      Swal.close();

      if (!data) return;
      showAlert(data.status === 'success' ? 'success' : 'error', data.mensaje)
        .then(() => { if (data.status === 'success') location.reload(); });
    });
  });

  // Editar persona (llenar formulario modal)
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.btn-editar');
    if (!btn) return;

    const data = btn.dataset;
    document.querySelector('#formEditar [name="idpersona"]').value = data.id;
    document.querySelector('#formEditar [name="nombre"]').value = data.nombre;
    document.querySelector('#formEditar [name="apellido"]').value = data.apellido;
    document.querySelector('#formEditar [name="email"]').value = data.email;
    document.querySelector('#formEditar [name="telefono"]').value = data.telefono;

    new bootstrap.Modal(document.getElementById('modalEditar')).show();
  });

  // Eliminar persona
  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.btn-borrar');
    if (!btn) return;

    const confirm = await Swal.fire({
      title: '¿Seguro de eliminar esta persona?',
      text: 'Esta acción no se puede deshacer',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#d33'
    });

    if (!confirm.isConfirmed) return;

    const fd = new FormData();
    fd.append('accion', 'borrar');
    fd.append('idpersona', btn.dataset.id);

    Swal.fire({ title: 'Eliminando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    const data = await sendRequest(fd);
    Swal.close();

    if (!data) return;
    showAlert(data.status === 'success' ? 'success' : 'error', data.mensaje)
      .then(() => { if (data.status === 'success') location.reload(); });
  });

});
</script>

