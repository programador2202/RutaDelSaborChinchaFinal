<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

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
  .table td {
    vertical-align: middle;
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
  .foto-img {
    width: 70px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  }
  .col-local {
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

</style>

<div class="container mt-4">
  <div class="card card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i> Gestión de Cartas</h5>
      <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-plus-circle"></i> Nueva Carta
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Plato</th>
              <th>Negocio</th>
              <th>Local</th>
              <th>Sección</th>
              <th>Precio</th>
              <th>Foto</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($cartas)): ?>
              <?php foreach ($cartas as $c): ?>
                <tr id="row<?= $c['idcarta'] ?>">
                  <td class="text-center"><span class="badge bg-secondary"><?= $c['idcarta'] ?></span></td>
                  <td><?= esc($c['nombreplato']) ?></td>
                  <td><?= esc($c['nombre_negocio']) ?></td>
                  <td class="col-local"><?= esc($c['direccion_local']) ?></td>
                  <td><span class="badge bg-info text-dark"><?= esc($c['nombre_seccion']) ?></span></td>
                  <td>S/ <?= number_format($c['precio'], 2) ?></td>
                  <td class="text-center">
                    <?php if (!empty($c['foto'])): ?>
                      <img src="<?= base_url($c['foto']) ?>" class="foto-img">
                    <?php else: ?>
                      <span class="badge bg-light text-dark">Sin foto</span>
                    <?php endif; ?>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-warning btn-sm btn-action btn-editar"
                    data-id="<?= $c['idcarta'] ?>"
                    data-idlocales="<?= $c['idlocales'] ?>"
                    data-idseccion="<?= $c['idseccion'] ?>"
                    data-nombreplato="<?= esc($c['nombreplato']) ?>"
                    data-precio="<?= $c['precio'] ?>"
                    data-foto="<?= basename($c['foto'] ?? '') ?>">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                    <button class="btn btn-danger btn-sm btn-action btn-eliminar"
                      data-id="<?= $c['idcarta'] ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8" class="text-center">
                  <div class="alert alert-info mb-0">No hay cartas registradas</div>
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
<div class="modal fade" id="modalRegistrar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formRegistrarCarta" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="registrar">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Registrar Carta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Local</label>
                    <select class="form-select mb-2" name="idlocales" required>
                        <option value="">Seleccione un local</option>
                        <?php foreach($locales as $local): ?>
                        <option value="<?= $local['idlocales'] ?>">
                            <?= esc($local['nombre_negocio']) ?> - <?= esc($local['direccion']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Sección</label>
                    <select class="form-select mb-2" name="idseccion" required>
                        <option value="">Seleccione una sección</option>
                        <?php foreach($secciones as $s): ?>
                        <option value="<?= $s['idseccion'] ?>"><?= esc($s['seccion']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Plato</label>
                    <input type="text" class="form-control mb-2" name="nombreplato" required>

                    <label>Precio</label>
                    <input type="number" step="0.01" class="form-control mb-2" name="precio" required>

                    <label>Foto</label>
                    <input type="file" class="form-control" name="foto" accept="image/*">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditarCarta" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="actualizar">
                <input type="hidden" name="idcarta" id="editId">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">Editar Carta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Local</label>
                    <select class="form-select mb-2" name="idlocales" id="editLocal" required>
                        <option value="">Seleccione un local</option>
                        <?php foreach($locales as $local): ?>
                        <option value="<?= $local['idlocales'] ?>"><?= esc($local['nombre_negocio']) ?> - <?= esc($local['direccion']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Sección</label>
                    <select class="form-select mb-2" name="idseccion" id="editSeccion" required>
                        <option value="">Seleccione una sección</option>
                        <?php foreach($secciones as $s): ?>
                        <option value="<?= $s['idseccion'] ?>"><?= esc($s['seccion']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Plato</label>
                    <input type="text" class="form-control mb-2" name="nombreplato" id="editNombreplato" required>

                    <label>Precio</label>
                    <input type="number" step="0.01" class="form-control mb-2" name="precio" id="editPrecio" required>

                    <label>Foto (opcional)</label>
                    <input type="file" class="form-control mb-2" name="foto" accept="image/*">
                    <div id="previewFoto" class="mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const AJAX_URL = "<?= base_url('cartas/ajax') ?>"; 

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

  // Registrar carta
  document.getElementById('formRegistrarCarta')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    formData.append('accion', 'registrar');

    Swal.fire({ title: 'Registrando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    const data = await sendRequest(formData);
    Swal.close();

    if (!data) return;
    showAlert(data.status === 'success' ? 'success' : 'error', data.message)
      .then(() => { if (data.status === 'success') location.reload(); });
  });

  // Editar carta (abrir modal con datos)
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.btn-editar');
    if (!btn) return;
    const data = btn.dataset;

    document.getElementById('editId').value = data.id;
    document.getElementById('editLocal').value = data.idlocales;
    document.getElementById('editSeccion').value = data.idseccion;
    document.getElementById('editNombreplato').value = data.nombreplato;
    document.getElementById('editPrecio').value = data.precio;

    if (data.foto) {
      document.getElementById('previewFoto').innerHTML =
        `<img src="<?= base_url('uploads/cartas') ?>/${data.foto}" width="80" class="rounded">`;
    } else {
      document.getElementById('previewFoto').innerHTML = '<span class="text-muted">Sin foto</span>';
    }

    new bootstrap.Modal(document.getElementById('modalEditar')).show();
  });

  // Actualizar carta
  document.getElementById('formEditarCarta')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    formData.append('accion', 'actualizar');

    Swal.fire({ title: 'Actualizando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    const data = await sendRequest(formData);
    Swal.close();

    if (!data) return;
    showAlert(data.status === 'success' ? 'success' : 'error', data.message)
      .then(() => { if (data.status === 'success') location.reload(); });
  });

  // Eliminar carta
  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.btn-eliminar');
    if (!btn) return;

    const confirm = await Swal.fire({
      title: '¿Está seguro de eliminar esta carta?',
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
    fd.append('idcarta', btn.dataset.id);

    Swal.fire({ title: 'Eliminando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    const data = await sendRequest(fd);
    Swal.close();

    if (!data) return;
    showAlert(data.status === 'success' ? 'success' : 'error', data.message)
      .then(() => { if (data.status === 'success') location.reload(); });
  });

});
</script>

