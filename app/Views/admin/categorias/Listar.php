<?= $header; ?>

<div class="container mt-4">
  <div class="my-5 d-flex justify-content-between align-items-center">
    <h4>Lista de Categorías</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
      Registrar
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>ID</th>
          <th>Nombre Categoría</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($categorias as $categoria): ?>
        <tr class="text-center">
          <td><?= $categoria['idcategoria'] ?></td>
          <td><?= $categoria['categoria'] ?></td>
          <td>
            <button class="btn btn-sm btn-info" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalEditar"
                    data-id="<?= $categoria['idcategoria'] ?>"
                    data-nombre="<?= $categoria['categoria'] ?>">
              Editar
            </button>

            <button class="btn btn-sm btn-danger btnEliminar" 
                    data-id="<?= $categoria['idcategoria'] ?>">
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
    <form action="<?= base_url('categorias/registrar') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Registrar Categoría</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" required>
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
    <form action="<?= base_url('categorias/actualizar') ?>" method="post">
      <input type="hidden" name="idcategoria" id="editId">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Editar Categoría</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="editNombre" required>
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
          window.location.href = "<?= base_url('categorias/borrar/') ?>" + id;
        }
      });
    });
  });

  // Mensajes flashdata desde el controller
  <?php if(session()->getFlashdata('mensaje') == 'registrado'): ?>
    Swal.fire("¡Registrado!","La categoría fue creada correctamente","success");
  <?php endif; ?>

  <?php if(session()->getFlashdata('mensaje') == 'editado'): ?>
    Swal.fire("¡Actualizado!","La categoría fue editada correctamente","success");
  <?php endif; ?>

  <?php if(session()->getFlashdata('mensaje') == 'eliminado'): ?>
    Swal.fire("¡Eliminado!","La categoría fue eliminada correctamente","success");
  <?php endif; ?>

  <?php if(session()->getFlashdata('mensaje') == 'no_existe'): ?>
    Swal.fire("Error","La categoría no existe","error");
  <?php endif; ?>
</script>
