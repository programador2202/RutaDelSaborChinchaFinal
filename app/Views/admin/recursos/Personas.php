<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2>Gestión de Personas</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-person-plus"></i> Nueva Persona
    </button>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Tipo Doc</th>
                <th>Número Doc</th>
                <th>Teléfono</th>
                <th>Foto</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($personas as $p): ?>
            <tr>
                <td><?= $p['idpersona'] ?></td>
                <td><?= $p['apellidos'] ?></td>
                <td><?= $p['nombres'] ?></td>
                <td><?= $p['tipodoc'] ?></td>
                <td><?= $p['numerodoc'] ?></td>
                <td><?= $p['telefono'] ?></td>
                <td>
                <?php if (!empty($p['foto'])): ?>
                <img src="<?= base_url($p['foto']) ?>" width="50" height="50" class="rounded mx-auto d-block">

              <?php else: ?>
                <img src="<?= base_url("uploads/personas/icono.png") ?>" alt="Sin foto" width="50" height="50" class="rounded mx-auto d-block">
              <?php endif; ?>

              </td>

                <td class="text-center">
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $p['idpersona'] ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger btn-sm btn-borrar" data-id="<?= $p['idpersona'] ?>">
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

                      <label>Foto:</label>
                      <input type="file" name="foto" class="form-control mb-2">
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

<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form enctype="multipart/form-data">
        <input type="hidden" name="accion" value="registrar">
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

          <label>Foto:</label>
          <input type="file" name="foto" class="form-control mb-2">
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
document.addEventListener('DOMContentLoaded', function() {

    // Registrar / Actualizar
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("<?= base_url('admin/personas/ajax') ?>", {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire({
                    icon: data.status === 'success' ? 'success' : 'error',
                    title: data.mensaje,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    if(data.status === 'success') location.reload();
                });
            })
            .catch(err => console.error(err));
        });
    });

    // Borrar
    document.querySelectorAll('.btn-borrar').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Seguro de eliminar esta persona?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if(result.isConfirmed){
                    let id = btn.dataset.id;
                    let formData = new FormData();
                    formData.append('accion', 'borrar');
                    formData.append('idpersona', id);

                    fetch("<?= base_url('admin/personas/ajax') ?>", {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire({
                            icon: data.status === 'success' ? 'success' : 'error',
                            title: data.mensaje,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            if(data.status === 'success') location.reload();
                        });
                    });
                }
            });
        });
    });

});
</script>
