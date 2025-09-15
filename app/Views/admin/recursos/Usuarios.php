<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2>Gestión de Usuarios</h2>
    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-person-plus"></i> Nuevo Usuario
    </a>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre Usuario</th>
                <th>Clave Acceso</th>
                <th>Nivel Acceso</th>
                <th>Persona</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuarios as $u): ?>
            <tr>
                <td><?= $u['idusuario'] ?></td>
                <td><?= $u['nombreusuario'] ?></td>
                <td><?= $u['claveacceso'] ?></td>
                <td><?= $u['nivelacceso'] ?></td>
                <td><?= $u['nombres'] . ' ' . $u['apellidos'] ?></td>
                <td class="text-center">
                    <!-- Botón editar -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $u['idusuario'] ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- Botón eliminar -->
                    <a href="<?= base_url('admin/usuarios/'.$u['idusuario']) ?>" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm('¿Seguro de eliminar este usuario?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>

            <!-- Modal editar usuario -->
            <div class="modal fade" id="modalEditar<?= $u['idusuario'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                  <form action="<?= base_url('admin/usuarios/actualizar') ?>" method="post" class="modal-content">
                    <input type="hidden" name="idusuario" value="<?= $u['idusuario'] ?>">
                    <div class="modal-header bg-warning text-dark">
                      <h5 class="modal-title">Editar Usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <label>Nombre Usuario:</label>
                      <input type="text" name="nombreusuario" class="form-control mb-2" value="<?= $u['nombreusuario'] ?>" required>

                      <label>Clave Acceso:</label>
                      <input type="password" name="claveacceso" class="form-control mb-2" value="<?= $u['claveacceso'] ?>" required>

                      <label>Nivel Acceso:</label>
                      <select name="nivelacceso" class="form-control mb-2">
                        <option value="admin" <?= $u['nivelacceso']=='admin'?'selected':'' ?>>Admin</option>
                        <option value="usuario" <?= $u['nivelacceso']=='usuario'?'selected':'' ?>>Usuario</option>
                      </select>

                      <label>ID Persona:</label>
                      <input type="text" name="idpersona" class="form-control mb-2" value="<?= $u['idpersona'] ?>">
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

<!-- Modal Registrar usuario -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="<?= base_url('admin/usuarios') ?>" method="post" class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nuevo Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label>Nombre Usuario:</label>
          <input type="text" name="nombreusuario" class="form-control mb-2" placeholder="Nombre Usuario" required>

          <label>Clave Acceso:</label>
          <input type="password" name="claveacceso" class="form-control mb-2" placeholder="Clave Acceso" required>

          <label>Nivel Acceso:</label>
          <select name="nivelacceso" class="form-control mb-2">
            <option value="admin">Admin</option>
            <option value="usuario">Usuario</option>
          </select>

          <label>ID Persona:</label>
          <input type="text" name="idpersona" class="form-control mb-2" placeholder="ID Persona">
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
