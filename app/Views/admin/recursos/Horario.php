<?= $header ?? '' ?>
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
      <h5 class="mb-0"><i class="bi bi-calendar-week me-2"></i> Gestión de Horarios</h5>
      <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-plus-circle"></i> Nuevo Horario
      </button>
    </div>
    
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>Negocio</th>
              <th>Dirección</th>
              <th>Teléfono</th>
              <th>Día</th>
              <th>Inicio</th>
              <th>Fin</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($horarios)): ?>
              <?php foreach ($horarios as $h): ?>
                <tr id="row<?= $h['idhorario'] ?>">
                  <td><?= esc($h['negocio']) ?></td>
                  <td class="col-texto"><?= esc($h['direccion']) ?></td>
                  <td><?= esc($h['telefono']) ?></td>
                  <td><span class="badge bg-info text-dark"><?= esc($h['diasemana']) ?></span></td>
                  <td><?= esc($h['inicio']) ?></td>
                  <td><?= esc($h['fin']) ?></td>
                  <td class="text-center">
                    <button class="btn btn-warning btn-sm btn-action btn-editar" 
                       data-id="<?= $h['idhorario'] ?>"
                       data-dia="<?= $h['diasemana'] ?>"
                       data-inicio="<?= $h['inicio'] ?>"
                       data-fin="<?= $h['fin'] ?>"
                       data-local="<?= $h['idlocales'] ?>">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger btn-sm btn-action btn-eliminar"
                       data-id="<?= $h['idhorario'] ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center">
                  <div class="alert alert-info mb-0">No hay horarios registrados</div>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-title" id="modalRegistrarLabel">Registrar Nuevo Horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formRegistrar" method="post">
                    <input type="hidden" name="accion" value="registrar">
                    <div class="mb-3">
                        <label for="diasemana" class="form-label">Día de la Semana</label>
                        <select class="form-select" id="diasemana" name="diasemana" required>
                            <option value="">Seleccione un día</option>
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="miercoles">Miércoles</option>
                            <option value="jueves">Jueves</option>
                            <option value="viernes">Viernes</option>
                            <option value="sabado">Sábado</option>
                            <option value="domingo">Domingo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inicio" class="form-label">Hora de Inicio</label>
                        <input type="time" class="form-control" id="inicio" name="inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="fin" class="form-label">Hora de Fin</label>
                        <input type="time" class="form-control" id="fin" name="fin" required>
                    </div>
                    <div class="mb-3">
                        <label for="idlocales" class="form-label">Local</label>
                        <select class="form-select" id="idlocales" name="idlocales" required>
                            <option value="">Seleccione un local</option>
                            <?php foreach ($locales as $local): ?>
                                <option value="<?= $local['idlocales'] ?>"><?= $local['negocio'] ?> - <?= $local['direccion'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="modalEditarLabel"><i class="bi bi-pencil-square"></i>Editar Horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditar" method="post">
                    <input type="hidden" name="accion" value="actualizar">
                    <input type="hidden" id="idhorario" name="idhorario">
                    <div class="mb-3">
                        <label for="diasemana_editar" class="form-label">Día de la Semana</label>
                        <select class="form-select" id="diasemana_editar" name="diasemana" required>
                            <option value="">Seleccione un día</option>
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="miercoles">Miércoles</option>
                            <option value="jueves">Jueves</option>
                            <option value="viernes">Viernes</option>
                            <option value="sabado">Sábado</option>
                            <option value="domingo">Domingo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inicio_editar" class="form-label">Hora de Inicio</label>
                        <input type="time" class="form-control" id="inicio_editar" name="inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="fin_editar" class="form-label">Hora de Fin</label>
                        <input type="time" class="form-control" id="fin_editar" name="fin" required>
                    </div>
                    <div class="mb-3">
                        <label for="idlocales_editar" class="form-label">Local</label>
                        <select class="form-select" id="idlocales_editar" name="idlocales" required>
                            <option value="">Seleccione un local</option>
                            <?php foreach ($locales as $local): ?>
                                <option value="<?= $local['idlocales'] ?>"><?= $local['negocio'] ?> - <?= $local['direccion'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const AJAX_URL = "<?= base_url('Horario/ajax') ?>";

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

  // Formularios: registrar y actualizar
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

  // Editar horario
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.btn-editar');
    if (!btn) return;

    document.getElementById('idhorario').value = btn.getAttribute('data-id');
    document.getElementById('diasemana_editar').value = btn.getAttribute('data-dia');
    document.getElementById('inicio_editar').value = btn.getAttribute('data-inicio');
    document.getElementById('fin_editar').value = btn.getAttribute('data-fin');
    document.getElementById('idlocales_editar').value = btn.getAttribute('data-local');

    new bootstrap.Modal(document.getElementById('modalEditar')).show();
  });

  // Eliminar horario
  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.btn-eliminar');
    if (!btn) return;

    const idhorario = btn.getAttribute('data-id');
    const confirm = await Swal.fire({
      title: '¿Eliminar este horario?',
      text: "Esta acción no se puede deshacer",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#d33'
    });

    if (!confirm.isConfirmed) return;

    const fd = new FormData();
    fd.append('accion', 'eliminar');
    fd.append('idhorario', idhorario);

    Swal.fire({ title: 'Eliminando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    const data = await sendRequest(fd);
    Swal.close();

    if (!data) return;
    showAlert(data.status === 'success' ? 'success' : 'error', data.mensaje)
      .then(() => { if (data.status === 'success') location.reload(); });
  });

});
</script>
