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
      <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i> Gestión de Contratos</h5>
      <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-plus-circle"></i> Nuevo Contrato
      </button>
    </div>
    
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Usuario</th>
              <th>Negocio</th>
              <th>Fecha Inicio</th>
              <th>Fecha Fin</th>
              <th>Inversión (S/)</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($contratos)): ?>
              <?php foreach ($contratos as $c): ?>
                <tr id="row<?= $c['idcontrato'] ?>">
                  <td class="text-center"><span class="badge bg-secondary"><?= $c['idcontrato'] ?></td>
                  <td><?= esc($c['usuario']) ?></td>
                  <td><?= esc($c['negocio']) ?></td>
                  <td class="text-center"><?= esc($c['fechainicio']) ?></td>
                  <td class="text-center"><?= esc($c['fechafin']) ?></td>
                  <td class="text-end"><?= number_format($c['inversion'], 2, '.', ',') ?></td>
                  <td class="text-center">
                    <button class="btn btn-warning btn-action btnEditar" data-id="<?= $c['idcontrato'] ?>">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-action btnEliminar" data-id="<?= $c['idcontrato'] ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="7" class="text-center">No hay contratos registrados.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- 🔹 Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formRegistrar">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nuevo Contrato</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label fw-semibold">Usuario</label>
            <select class="form-select" name="idusuario" required>
              <option value="">Seleccione un usuario</option>
              <?php foreach($usuarios as $u): ?>
                <option value="<?= $u['idusuario'] ?>"><?= esc($u['nombreusuario']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Negocio</label>
            <select class="form-select" name="idnegocio" required>
              <option value="">Seleccione un negocio</option>
              <?php foreach($negocios as $n): ?>
                <option value="<?= $n['idnegocio'] ?>"><?= esc($n['nombre']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Fecha Inicio</label>
              <input type="date" class="form-control" name="fechainicio" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Fecha Fin</label>
              <input type="date" class="form-control" name="fechafin" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Inversión (S/)</label>
            <input type="number" step="0.01" min="0" class="form-control" name="inversion" required>
          </div>
        </div>

          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bi bi-x-circle"></i> Cancelar
        </button>
        <button type="button" id="btnRegistrar" class="btn btn-primary">
          <i class="bi bi-save"></i> Registrar
        </button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- 🔹 Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditar">
        <input type="hidden" name="idcontrato" id="edit_idcontrato">

        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Editar Contrato</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label fw-semibold">Usuario</label>
            <select class="form-select" name="idusuario" id="edit_usuario" required>
              <option value="">Seleccione un usuario</option>
              <?php foreach($usuarios as $u): ?>
                <option value="<?= $u['idusuario'] ?>"><?= esc($u['nombreusuario']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Negocio</label>
            <select class="form-select" name="idnegocio" id="edit_negocio" required>
              <option value="">Seleccione un negocio</option>
              <?php foreach($negocios as $n): ?>
                <option value="<?= $n['idnegocio'] ?>"><?= esc($n['nombre']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Fecha Inicio</label>
              <input type="date" class="form-control" id="edit_fechainicio" name="fechainicio" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Fecha Fin</label>
              <input type="date" class="form-control" id="edit_fechafin" name="fechafin" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Inversión (S/)</label>
            <input type="number" step="0.01" min="0" class="form-control" id="edit_inversion" name="inversion" required>
          </div>
        </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bi bi-x-circle"></i> Cancelar
        </button>
        <button type="button" id="btnEditar" class="btn btn-warning text-white">
          <i class="bi bi-arrow-repeat"></i> Actualizar
        </button>
      </div>
    </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Asegúrate de haber incluido SweetAlert2 y Bootstrap antes de este script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const AJAX_URL = "<?= base_url('contrato/ajax') ?>"; // usar siempre esta URL

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

  document.getElementById('btnRegistrar')?.addEventListener('click', async () => {
    const form = document.getElementById('formRegistrar');
    const formData = new FormData(form);
    formData.append('accion', 'registrar');

    Swal.fire({ title: 'Registrando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    const data = await sendRequest(formData);
    Swal.close();

    if (!data) return;
    showAlert(data.status === 'success' ? 'success' : 'error', data.message)
      .then(() => { if (data.status === 'success') location.reload(); });
  });

  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.btnEditar');
    if (!btn) return;

    const id = btn.dataset.id;
    const fd = new FormData();
    fd.append('accion', 'obtener');
    fd.append('idcontrato', id);

    Swal.fire({ title: 'Cargando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    const data = await sendRequest(fd);
    Swal.close();

    if (!data) return;
    if (data.status === 'success') {
      const c = data.data;
      document.getElementById('edit_idcontrato').value = c.idcontrato;
      document.getElementById('edit_usuario').value = c.idusuario;
      document.getElementById('edit_negocio').value = c.idnegocio;
      document.getElementById('edit_fechainicio').value = c.fechainicio;
      document.getElementById('edit_fechafin').value = c.fechafin;
      document.getElementById('edit_inversion').value = c.inversion;
      new bootstrap.Modal(document.getElementById('modalEditar')).show();
    } else {
      showAlert('error', data.message || 'No se pudo obtener el contrato');
    }
  });

  document.getElementById('btnEditar')?.addEventListener('click', async () => {
    const form = document.getElementById('formEditar');
    const formData = new FormData(form);
    formData.append('accion', 'actualizar');

    Swal.fire({ title: 'Procesando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    const data = await sendRequest(formData);
    Swal.close();

    if (!data) return;
    showAlert(data.status === 'success' ? 'success' : 'error', data.message)
      .then(() => { if (data.status === 'success') location.reload(); });
  });


  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.btnEliminar');
    if (!btn) return;

    const id = btn.dataset.id;
    const confirm = await Swal.fire({
      title: '¿Eliminar contrato?',
      text: 'Esta acción no se puede deshacer',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#d33'
    });

    if (!confirm.isConfirmed) return;

    const fd = new FormData();
    fd.append('accion', 'eliminar');
    fd.append('idcontrato', id);

    Swal.fire({ title: 'Eliminando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    const data = await sendRequest(fd);
    Swal.close();

    if (!data) return;
    showAlert(data.status === 'success' ? 'success' : 'error', data.message)
      .then(() => { if (data.status === 'success') document.getElementById(`row${id}`)?.remove(); });
  });

});
</script>

