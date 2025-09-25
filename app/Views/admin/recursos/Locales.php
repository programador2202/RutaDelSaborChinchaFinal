<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <h3>Gestión de Locales</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-plus-circle"></i> Nuevo Local
    </button>

    <table class="table table-bordered table-striped" id="tablaLocales">
        <thead class="table-dark">
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
                <td><?= $l['idlocales'] ?></td>
                <td><?= $l['negocio'] ?></td>
                <td><?= $l['distrito'] ?></td>
                <td><?= $l['direccion'] ?></td>
                <td><?= $l['telefono'] ?></td>
                <td><?= $l['latitud'] ?></td>
                <td><?= $l['longitud'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm btn-editar"
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
                    <button class="btn btn-danger btn-sm btn-borrar" data-id="<?= $l['idlocales'] ?>">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formRegistrar">
        <input type="hidden" name="accion" value="registrar">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Registrar Local</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-2">
              <label>Negocio</label>
              <select name="idnegocio" class="form-select" required>
                <?php foreach ($negocios as $n): ?>
                  <option value="<?= $n['idnegocio'] ?>"><?= $n['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-2">
              <label>Departamento</label>
              <select id="selectDepartamento" name="iddepartamento" class="form-select" required>
                <option value="">Seleccione Departamento</option>
                <?php foreach ($departamentos as $dep): ?>
                  <option value="<?= $dep['iddepartamento'] ?>"><?= $dep['departamento'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-2">
              <label>Provincia</label>
              <select id="selectProvincia" name="idprovincia" class="form-select" required>
                <option value="">Seleccione Provincia</option>
              </select>
            </div>
            <div class="mb-2">
              <label>Distrito</label>
              <select id="selectDistrito" name="iddistrito" class="form-select" required>
                <option value="">Seleccione Distrito</option>
              </select>
            </div>
            <div class="mb-2">
              <label>Dirección</label>
              <input type="text" name="direccion" class="form-control" required>
            </div>
            <div class="mb-2">
              <label>Teléfono</label>
              <input type="text" name="telefono" class="form-control">
            </div>
            <div class="mb-2">
              <label>Latitud</label>
              <input type="number" step="any" name="latitud" class="form-control" required>
            </div>
            <div class="mb-2">
              <label>Longitud</label>
              <input type="number" step="any" name="longitud" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditar">
        <input type="hidden" name="accion" value="actualizar">
        <input type="hidden" name="idlocales" id="editId">
        <div class="modal-header bg-warning text-dark">
            <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Editar Local</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-2">
              <label>Negocio</label>
              <select name="idnegocio" id="editNegocio" class="form-select" required>
                <?php foreach ($negocios as $n): ?>
                  <option value="<?= $n['idnegocio'] ?>"><?= $n['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-2">
              <label>Departamento</label>
              <select id="editDepartamento" class="form-select" required></select>
            </div>
            <div class="mb-2">
              <label>Provincia</label>
              <select id="editProvincia" class="form-select" required></select>
            </div>
            <div class="mb-2">
              <label>Distrito</label>
              <select name="iddistrito" id="editDistrito" class="form-select" required></select>
            </div>
            <div class="mb-2">
              <label>Dirección</label>
              <input type="text" name="direccion" id="editDireccion" class="form-control" required>
            </div>
            <div class="mb-2">
              <label>Teléfono</label>
              <input type="text" name="telefono" id="editTelefono" class="form-control">
            </div>
            <div class="mb-2">
              <label>Latitud</label>
              <input type="number" step="any" name="latitud" id="editLatitud" class="form-control" required>
            </div>
            <div class="mb-2">
              <label>Longitud</label>
              <input type="number" step="any" name="longitud" id="editLongitud" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
const provincias = <?= json_encode($provincias) ?>;
const distritos = <?= json_encode($distritos) ?>;

const modalRegistrar = document.getElementById('modalRegistrar');
const modalEditar = document.getElementById('modalEditar');

// ====== FUNCIONES REUTILIZABLES ======
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

// ====== REGISTRAR ======
const selectDepartamento = document.getElementById('selectDepartamento');
const selectProvincia = document.getElementById('selectProvincia');
const selectDistrito = document.getElementById('selectDistrito');

selectDepartamento.addEventListener('change', () => {
    llenarProvincias(selectDepartamento.value, selectProvincia);
    selectDistrito.innerHTML = '<option value="">Seleccione Distrito</option>';
});
selectProvincia.addEventListener('change', () => {
    llenarDistritos(selectProvincia.value, selectDistrito);
});

// ====== EDITAR ======
document.querySelectorAll('.btn-editar').forEach(btn => {
    btn.addEventListener('click', () => {
        const depId = btn.getAttribute('data-iddepartamento') || '';
        const provId = btn.getAttribute('data-idprovincia') || '';
        const distId = btn.getAttribute('data-iddistrito') || '';

        document.getElementById('editId').value = btn.getAttribute('data-id');
        document.getElementById('editNegocio').value = btn.getAttribute('data-idnegocio');
        document.getElementById('editDireccion').value = btn.getAttribute('data-direccion');
        document.getElementById('editTelefono').value = btn.getAttribute('data-telefono');
        document.getElementById('editLatitud').value = btn.getAttribute('data-latitud');
        document.getElementById('editLongitud').value = btn.getAttribute('data-longitud');

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

        new bootstrap.Modal(modalEditar).show();
    });
});

// ====== FUNCION AJAX ======
function enviarFormulario(form) {
    const formData = new FormData(form);
    fetch('locales/ajax', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            Swal.fire('Éxito', data.message, 'success');
            // Cerrar modal
            const modal = bootstrap.Modal.getInstance(form.closest('.modal'));
            modal.hide();
            // Recargar tabla (puedes optimizar para agregar solo la fila)
            setTimeout(()=> location.reload(), 500);
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire('Error', 'Ocurrió un error al procesar la solicitud.', 'error');
    });
}

document.getElementById('formRegistrar').addEventListener('submit', e => {
    e.preventDefault();
    enviarFormulario(e.target);
});
document.getElementById('formEditar').addEventListener('submit', e => {
    e.preventDefault();
    enviarFormulario(e.target);
});

// ====== BORRAR ======
document.querySelectorAll('.btn-borrar').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
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
                fetch('locales/ajax', { method:'POST', body: formData })
                .then(res=>res.json())
                .then(data=>{
                    if(data.status==='success'){
                        Swal.fire('Eliminado', data.message, 'success');
                        document.querySelector(`tr[data-id="${id}"]`).remove();
                    } else Swal.fire('Error', data.message, 'error');
                });
            }
        });
    });
});
</script>
