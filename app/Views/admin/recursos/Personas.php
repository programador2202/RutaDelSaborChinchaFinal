<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2>Gestión de Personas</h2>
    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-person-plus"></i> Nueva Persona
    </a>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Tipo Doc</th>
                <th>Número Doc</th>
                <th>Teléfono</th>
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
                <td class="text-center">
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $p['idpersona'] ?>">
                        <i class="bi bi-pencil-square"></i> 
                    </button>
                          <a href="<?= base_url('admin/personas/'.$p['idpersona']) ?>" 
                          class="btn btn-danger btn-sm" 
                          onclick="return confirm('¿Seguro de eliminar esta persona?')">
                          <i class="bi bi-trash"></i>
                        </a>

                    </a>
                </td>
            </tr>

            <!-- Modal editar -->
            <div class="modal fade" id="modalEditar<?= $p['idpersona'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                  <form action="<?= base_url('admin/personas/actualizar') ?>" method="post" class="modal-content">
                    <input type="hidden" name="idpersona" value="<?= $p['idpersona'] ?>">
                    <div class="modal-header bg-warning text-dark">
                      <h5 class="modal-title">Editar Persona</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                      <label for="">Apellidos:</label><input type="text" name="apellidos" class="form-control mb-2" value="<?= $p['apellidos'] ?>" required>
                      <label for="">Nombres</label><input type="text" name="nombres" class="form-control mb-2" value="<?= $p['nombres'] ?>" required>
                      <label for="">Tipo de Documento:</label><input type="text" name="tipodoc" class="form-control mb-2" value="<?= $p['tipodoc'] ?>">
                      <label for="">Numero de Documento</label><input type="text" name="numerodoc" class="form-control mb-2" value="<?= $p['numerodoc'] ?>">
                      <label for="">Telefono</label><input type="text" name="telefono" class="form-control mb-2" value="<?= $p['telefono'] ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">
                          <i class="bi bi-save"></i> Guardar
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
      <form action="<?= base_url('admin/personas') ?>" method="post" class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nueva Persona</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label for="">Apellidos:</label><input type="text" name="apellidos" class="form-control mb-2" placeholder="Apellidos" required>
          <label for="">Nombres:</label><input type="text" name="nombres" class="form-control mb-2" placeholder="Nombres" required>
          <label for="">Tipo De Documento:</label><input type="text" name="tipodoc" class="form-control mb-2" placeholder="Tipo Doc">
          <label for="">Numero de Documento:</label><input type="text" name="numerodoc" class="form-control mb-2" placeholder="Número Doc">
          <label for="">Telefono:</label><input type="text" name="telefono" class="form-control mb-2" placeholder="Teléfono">
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

<!-- Bootstrap JS (bundle incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
