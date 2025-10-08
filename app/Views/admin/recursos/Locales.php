<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
  .table td.direccion-col {
  max-width: 200px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

</style>

<div class="container mt-4">
  <div class="card card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-geo-alt-fill me-2"></i> Gestión de Locales</h5>
      <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-plus-circle"></i> Nuevo Local
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Negocio</th>
              <th>Distrito</th>
              <th>Dirección</th>
              <th>Teléfono</th>
              <th>Latitud</th>
              <th>Longitud</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($locales as $l): ?>
              <tr data-id="<?= $l['idlocales'] ?>">
                <td class="text-center"><span class="badge bg-secondary"><?= $l['idlocales'] ?></span></td>
                <td><?= $l['negocio'] ?></td>
                <td><?= $l['distrito'] ?></td>
                <td class="direccion-col"><?= $l['direccion'] ?></td>
                <td><?= $l['telefono'] ?></td>
                <td><?= $l['latitud'] ?></td>
                <td><?= $l['longitud'] ?></td>
                <td class="text-center">
                  <button class="btn btn-warning btn-sm btn-action btn-editar"
                      data-id="<?= $l['idlocales'] ?>"
                      data-idnegocio="<?= $l['idnegocio'] ?>"
                      data-iddepartamento="<?= $l['iddepartamento'] ?? '' ?>"
                      data-idprovincia="<?= $l['idprovincia'] ?? '' ?>"
                      data-iddistrito="<?= $l['iddistrito'] ?>"
                      data-direccion="<?= $l['direccion'] ?>"
                      data-telefono="<?= $l['telefono'] ?>"
                      data-latitud="<?= $l['latitud'] ?>"
                      data-longitud="<?= $l['longitud'] ?>">
                      <i class="bi bi-pencil-square"></i>
                  </button>
                  <button class="btn btn-danger btn-sm btn-action btn-borrar" data-id="<?= $l['idlocales'] ?>">
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

<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formRegistrar">
        <input type="hidden" name="accion" value="registrar">

        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Registrar Local</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>Negocio</label>
            <select name="idnegocio" class="form-select" required>
              <?php foreach ($negocios as $n): ?>
                <option value="<?= $n['idnegocio'] ?>"><?= $n['nombre'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label>Departamento</label>
            <select id="selectDepartamento" name="iddepartamento" class="form-select" required>
              <option value="">Seleccione Departamento</option>
              <?php foreach ($departamentos as $dep): ?>
                <option value="<?= $dep['iddepartamento'] ?>"><?= $dep['departamento'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label>Provincia</label>
            <select id="selectProvincia" name="idprovincia" class="form-select" required>
              <option value="">Seleccione Provincia</option>
            </select>
          </div>
          <div class="col-md-6">
            <label>Distrito</label>
            <select id="selectDistrito" name="iddistrito" class="form-select" required>
              <option value="">Seleccione Distrito</option>
            </select>
          </div>
          <div class="col-md-12">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control">
          </div>
          <div class="col-md-3">
            <label>Latitud</label>
            <input type="number" step="any" name="latitud" class="form-control" required>
          </div>
          <div class="col-md-3">
            <label>Longitud</label>
            <input type="number" step="any" name="longitud" class="form-control" required>
          </div>
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

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formEditar">
        <input type="hidden" name="accion" value="actualizar">
        <input type="hidden" name="idlocales" id="editId">

        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Editar Local</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>Negocio</label>
            <select name="idnegocio" id="editNegocio" class="form-select" required>
              <?php foreach ($negocios as $n): ?>
                <option value="<?= $n['idnegocio'] ?>"><?= $n['nombre'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label>Departamento</label>
            <select id="editDepartamento" class="form-select" required></select>
          </div>
          <div class="col-md-6">
            <label>Provincia</label>
            <select id="editProvincia" class="form-select" required></select>
          </div>
          <div class="col-md-6">
            <label>Distrito</label>
            <select name="iddistrito" id="editDistrito" class="form-select" required></select>
          </div>
          <div class="col-md-12">
            <label>Dirección</label>
            <input type="text" name="direccion" id="editDireccion" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Teléfono</label>
            <input type="text" name="telefono" id="editTelefono" class="form-control">
          </div>
          <div class="col-md-3">
            <label>Latitud</label>
            <input type="number" step="any" name="latitud" id="editLatitud" class="form-control" required>
          </div>
          <div class="col-md-3">
            <label>Longitud</label>
            <input type="number" step="any" name="longitud" id="editLongitud" class="form-control" required>
          </div>
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


<script>
document.addEventListener("DOMContentLoaded", () => {

  //variables globales
  const provincias = <?= json_encode($provincias) ?>;
  const distritos = <?= json_encode($distritos) ?>;

  //funcion de espera reutilizable
  const showAlert = (icon, title, timer = 1500) => {
    return Swal.fire({
      icon,
      title,
      timer,
      showConfirmButton: false,
      timerProgressBar: true
    });
  };

  const enviarPeticion = async (url, formData, successCallback = null) => {
    try {
      const res = await fetch(url, { method: "POST", body: formData });
      const data = await res.json();

      showAlert(data.status === "success" ? "success" : "error", data.message)
        .then(() => {
          if (data.status === "success" && typeof successCallback === "function") {
            successCallback();
          }
        });

    } catch (err) {
      console.error("Error en la petición:", err);
      showAlert("error", "No se pudo procesar la solicitud");
    }
  };

  function llenarProvincias(depId, selectProv) {
    selectProv.innerHTML = '<option value="">Seleccione Provincia</option>';
    provincias.filter(p => p.iddepartamento == depId)
              .forEach(p => selectProv.append(new Option(p.provincia, p.idprovincia)));
  }

  function llenarDistritos(provId, selectDist) {
    selectDist.innerHTML = '<option value="">Seleccione Distrito</option>';
    distritos.filter(d => d.idprovincia == provId)
             .forEach(d => selectDist.append(new Option(d.distrito, d.iddistrito)));
  }

  //registrar
  const selectDepartamento = document.getElementById('selectDepartamento');
  const selectProvincia = document.getElementById('selectProvincia');
  const selectDistrito = document.getElementById('selectDistrito');

  if (selectDepartamento) {
    selectDepartamento.addEventListener('change', () => {
      llenarProvincias(selectDepartamento.value, selectProvincia);
      selectDistrito.innerHTML = '<option value="">Seleccione Distrito</option>';
    });
  }
  if (selectProvincia) {
    selectProvincia.addEventListener('change', () => {
      llenarDistritos(selectProvincia.value, selectDistrito);
    });
  }

  // llamamos lo datos a editar
  document.querySelectorAll('.btn-editar').forEach(btn => {
    btn.addEventListener('click', () => {
      const depId = btn.dataset.iddepartamento || '';
      const provId = btn.dataset.idprovincia || '';
      const distId = btn.dataset.iddistrito || '';

      document.getElementById('editId').value = btn.dataset.id;
      document.getElementById('editNegocio').value = btn.dataset.idnegocio;
      document.getElementById('editDireccion').value = btn.dataset.direccion;
      document.getElementById('editTelefono').value = btn.dataset.telefono;
      document.getElementById('editLatitud').value = btn.dataset.latitud;
      document.getElementById('editLongitud').value = btn.dataset.longitud;

      // Llenar departamentos
      const editDepartamento = document.getElementById('editDepartamento');
      editDepartamento.innerHTML = '<option value="">Seleccione Departamento</option>';
      <?php foreach ($departamentos as $dep): ?>
        editDepartamento.append(new Option("<?= $dep['departamento'] ?>","<?= $dep['iddepartamento'] ?>"));
      <?php endforeach; ?>
      editDepartamento.value = depId;

      // Llenar provincias y distritos
      const editProvincia = document.getElementById('editProvincia');
      const editDistrito = document.getElementById('editDistrito');

      if(depId) llenarProvincias(depId, editProvincia);
      if(provId) {
        editProvincia.value = provId;
        llenarDistritos(provId, editDistrito);
      }
      if(distId) editDistrito.value = distId;

      new bootstrap.Modal(document.getElementById('modalEditar')).show();
    });
  });

  // registrar e editar
  document.querySelectorAll("#formRegistrar, #formEditar").forEach(form => {
    form.addEventListener("submit", e => {
      e.preventDefault();
      const formData = new FormData(form);

      Swal.fire({
        title: "Procesando...",
        text: "Por favor espera",
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
      });

      enviarPeticion("<?= base_url('locales/ajax') ?>", formData, () => location.reload());
    });
  });

  // borrar
  document.querySelectorAll('.btn-borrar').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;

      Swal.fire({
        title: '¿Está seguro?',
        text: "¡No podrá revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
      }).then(result => {
        if(result.isConfirmed){
          const formData = new FormData();
          formData.append('accion', 'borrar');
          formData.append('idlocales', id);

          enviarPeticion("<?= base_url('locales/ajax') ?>", formData, () => {
            document.querySelector(`tr[data-id="${id}"]`).remove();
          });
        }
      });
    });
  });

});
</script>
