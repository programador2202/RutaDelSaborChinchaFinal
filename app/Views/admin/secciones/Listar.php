<?= $header; ?>

<div class="container mt-4">
  <div class="my-5 d-flex justify-content-between align-items-center">
    <h4>Lista de Secciones</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
      Registrar
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>ID</th>
          <th>Nombre Sección</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($secciones as $seccion): ?>
        <tr class="text-center">
          <td><?= $seccion['idseccion'] ?></td>
          <td><?= $seccion['seccion'] ?></td>
          <td>
            <button class="btn btn-sm btn-info" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalEditar"
                    data-id="<?= $seccion['idseccion'] ?>"
                    data-nombre="<?= $seccion['seccion'] ?>">
              Editar
            </button>

            <button class="btn btn-sm btn-danger btnEliminar" 
                    data-id="<?= $seccion['idseccion'] ?>">
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
    <form action="<?= base_url('secciones/registrar') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Registrar Sección</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="seccion" required>
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
    <form action="<?= base_url('secciones/actualizar') ?>" method="post">
      <input type="hidden" name="idseccion" id="editId">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Editar Sección</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="seccion" id="editNombre" required>
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
    var nombre = button.getAttribute('data-nombre');

    modalEditar.querySelector('#editId').value = id;
    modalEditar.querySelector('#editNombre').value = nombre;
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
          window.location.href = "<?= base_url('secciones/borrar/') ?>" + id;
        }
      });
    });
  });

  // Mensajes flashdata desde el controller
  <?php if(session()->getFlashdata('mensaje') == 'registrado'): ?>
    Swal.fire("¡Registrado!","La sección fue creada correctamente","success");
  <?php endif; ?>

  <?php if(session()->getFlashdata('mensaje') == 'editado'): ?>
    Swal.fire("¡Actualizado!","La sección fue editada correctamente","success");
  <?php endif; ?>

  <?php if(session()->getFlashdata('mensaje') == 'eliminado'): ?>
    Swal.fire("¡Eliminado!","La sección fue eliminada correctamente","success");
  <?php endif; ?>

  <?php if(session()->getFlashdata('mensaje') == 'no_existe'): ?>
    Swal.fire("Error","La sección no existe","error");
  <?php endif; ?>
</script>
