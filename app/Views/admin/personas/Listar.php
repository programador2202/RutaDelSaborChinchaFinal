<?= $header; ?>

<div class="container mt-4">
  <div class="my-5 d-flex justify-content-between align-items-center">
    <h4>Lista de Personas</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
      Registrar
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>ID</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          <th>Tipo Doc</th>
          <th>N° Documento</th>
          <th>Teléfono</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($personas as $persona): ?>
        <tr class="text-center">
          <td><?= $persona['idpersona'] ?></td>
          <td><?= $persona['apellidos'] ?></td>
          <td><?= $persona['nombres'] ?></td>
          <td><?= $persona['tipodoc'] ?></td>
          <td><?= $persona['numerodoc'] ?></td>
          <td><?= $persona['telefono'] ?></td>

          <td>
            <button class="btn btn-sm btn-info" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalEditar"
                    data-id="<?= $persona['idpersona'] ?>"
                    data-apellidos="<?= $persona['apellidos'] ?>"
                    data-nombres="<?= $persona['nombres'] ?>"
                    data-tipodoc="<?= $persona['tipodoc'] ?>"
                    data-numerodoc="<?= $persona['numerodoc'] ?>"
                    data-telefono="<?= $persona['telefono'] ?>">
              Editar
            </button>

            <button class="btn btn-sm btn-danger btnEliminar" 
                    data-id="<?= $persona['idpersona'] ?>">
              Eliminar
            </button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!--  MODAL REGISTRAR -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('personas/registrar') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Registrar Persona</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Nombres</label>
            <input type="text" class="form-control" name="nombres" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Tipo Documento</label>
            <select name="tipodoc" class="form-select" required>
              <option value="">Seleccione...</option>
              <option value="DNI">DNI</option>
              <option value="CEX">CEX</option>
              <option value="PASAPORTE">PASAPORTE</option>
              <option value="RUC">RUC</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">N° Documento</label>
            <input type="text" class="form-control" name="numerodoc" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!--  MODAL EDITAR  -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('personas/actualizar') ?>" method="post">
      <input type="hidden" name="idpersona" id="editId">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Editar Persona</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" id="editApellidos" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Nombres</label>
            <input type="text" class="form-control" name="nombres" id="editNombres" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Tipo Documento</label>
            <select name="tipodoc" class="form-select" id="editTipodoc" required>
              <option value="DNI">DNI</option>
              <option value="CEX">CEX</option>
              <option value="PASAPORTE">PASAPORTE</option>
              <option value="RUC">RUC</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">N° Documento</label>
            <input type="text" class="form-control" name="numerodoc" id="editNumerodoc" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="editTelefono" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-info">Actualizar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!--  SCRIPTS  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Pasar datos al modal editar
  var modalEditar = document.getElementById('modalEditar');
  modalEditar.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    var apellidos = button.getAttribute('data-apellidos');
    var nombres = button.getAttribute('data-nombres');
    var tipodoc = button.getAttribute('data-tipodoc');
    var numerodoc = button.getAttribute('data-numerodoc');
    var telefono = button.getAttribute('data-telefono');

    modalEditar.querySelector('#editId').value = id;
    modalEditar.querySelector('#editApellidos').value = apellidos;
    modalEditar.querySelector('#editNombres').value = nombres;
    modalEditar.querySelector('#editTipodoc').value = tipodoc;
    modalEditar.querySelector('#editNumerodoc').value = numerodoc;
    modalEditar.querySelector('#editTelefono').value = telefono;
  });

  // Confirmación antes de eliminar
  document.querySelectorAll('.btnEliminar').forEach(btn => {
    btn.addEventListener('click', function () {
      let id = this.getAttribute('data-id');

      Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "<?= base_url('personas/borrar/') ?>" + id;
        }
      });
    });
  });

  // Mensajes flashdata desde el controller
  <?php if(session()->getFlashdata('mensaje') == 'registrado'): ?>
    Swal.fire("¡Registrado!","La persona fue creada correctamente","success");
  <?php endif; ?>

  <?php if(session()->getFlashdata('mensaje') == 'editado'): ?>
    Swal.fire("¡Actualizado!","La persona fue editada correctamente","success");
  <?php endif; ?>

  <?php if(session()->getFlashdata('mensaje') == 'eliminado'): ?>
    Swal.fire("¡Eliminado!","La persona fue eliminada correctamente","success");
  <?php endif; ?>

  <?php if(session()->getFlashdata('mensaje') == 'no_existe'): ?>
    Swal.fire("Error","La persona no existe","error");
  <?php endif; ?>
</script>
