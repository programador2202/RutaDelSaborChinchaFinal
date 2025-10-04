<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

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
    padding: 15px 20px;
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
</style>

<div class="container mt-4">
  <div class="card card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-person-gear me-2"></i> Gestión de Usuarios</h5>
      <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-person-plus"></i> Nuevo Usuario
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Usuario</th>
              <th>Clave</th>
              <th>Nivel</th>
              <th>Persona</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($usuarios as $u): ?>
            <tr>
              <td class="text-center"><span class="badge bg-secondary"><?= $u['idusuario'] ?></span></td>
              <td><?= $u['nombreusuario'] ?></td>
              <td class="text-center"><span class="badge bg-dark">••••••</span></td>
              <td class="text-center">
                <?php if($u['nivelacceso'] == 'admin'): ?>
                  <span class="badge bg-danger">Administrador</span>
                <?php else: ?>
                  <span class="badge bg-success">Usuario</span>
                <?php endif; ?>
              </td>
              <td><?= $u['nombres'] . ' ' . $u['apellidos'] ?></td>
              <td class="text-center">
                <button class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $u['idusuario'] ?>">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm btn-action btn-borrar" data-id="<?= $u['idusuario'] ?>">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>

            <!-- Modal editar usuario -->
            <div class="modal fade" id="modalEditar<?= $u['idusuario'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form class="form-usuario" enctype="multipart/form-data">
                    <input type="hidden" name="accion" value="actualizar">
                    <input type="hidden" name="idusuario" value="<?= $u['idusuario'] ?>">

                    <div class="modal-header bg-warning text-dark">
                      <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Editar Usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <label>Nombre Usuario:</label>
                      <input type="text" name="nombreusuario" class="form-control mb-2" value="<?= $u['nombreusuario'] ?>" required>

                      <label>Clave Acceso:</label>
                      <div class="input-group mb-2">
                        <input type="password" name="claveacceso" class="form-control" value="<?= $u['claveacceso'] ?>" id="clave<?= $u['idusuario'] ?>" required>
                        <button class="btn btn-outline-secondary toggle-pass" type="button" data-target="clave<?= $u['idusuario'] ?>">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>

                      <label>Nivel Acceso:</label>
                      <select name="nivelacceso" class="form-select mb-2">
                        <option value="admin" <?= $u['nivelacceso']=='admin'?'selected':'' ?>>Admin</option>
                        <option value="usuario" <?= $u['nivelacceso']=='usuario'?'selected':'' ?>>Usuario</option>
                      </select>

                      <label>Persona:</label>
                      <select name="idpersona" class="form-select mb-2" required>
                        <?php foreach ($personas as $p): ?>
                          <option value="<?= $p['idpersona'] ?>" <?= $u['idpersona'] == $p['idpersona'] ? 'selected' : '' ?>>
                            <?= $p['apellidos'] . " " . $p['nombres'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
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
    </div>
  </div>
</div>


<!-- Modal Registrar usuario -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form class="form-usuario" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="registrar">

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

          <label>Persona:</label>
          <select name="idpersona" class="form-control mb-2" required>
            <option value="">Seleccione persona...</option>
            <?php foreach ($personas as $p): ?>
              <option value="<?= $p['idpersona'] ?>">
                <?= $p['apellidos'] . " " . $p['nombres'] ?>
              </option>
            <?php endforeach; ?>
          </select>
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

<!-- Bootstrap JS y SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bootstrap JS y SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bootstrap JS y SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Mostrar/ocultar contraseñas
  document.querySelectorAll(".toggle-pass").forEach(btn => {
    btn.addEventListener("click", () => {
      const input = document.getElementById(btn.dataset.target);
      const icon = btn.querySelector("i");
      if(input.type === "password"){
        input.type = "text";
        icon.classList.replace("bi-eye", "bi-eye-slash");
      } else {
        input.type = "password";
        icon.classList.replace("bi-eye-slash", "bi-eye");
      }
    });
  });
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {

  // 🔹 Función genérica para mostrar alertas
  const showAlert = (icon, title, timer = 1500) => {
    return Swal.fire({
      icon,
      title,
      timer,
      showConfirmButton: false,
      timerProgressBar: true
    });
  };

  // Función helper para peticiones fetch con SweetAlert
  const enviarPeticion = async (url, formData, successCallback = null) => {
    try {
      const res = await fetch(url, { method: "POST", body: formData });
      const data = await res.json();

      showAlert(data.status === "success" ? "success" : "error", data.mensaje)
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

  // Manejo de registrar / actualizar usuario
  document.querySelectorAll(".form-usuario").forEach(form => {
    form.addEventListener("submit", e => {
      e.preventDefault();
      const formData = new FormData(form);
      
            // Mostrar loading mientras se procesa
            Swal.fire({
                title: "Procesando...",
                text: "Por favor espera",
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
            
      enviarPeticion("<?= base_url('usuarios/ajax') ?>", formData, () => location.reload());
    });
  });

  //Manejo de borrar usuario
  document.querySelectorAll(".btn-borrar").forEach(btn => {
    btn.addEventListener("click", () => {
      Swal.fire({
        title: "¿Seguro de eliminar este usuario?",
        text: "Esta acción no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
      }).then(result => {
        if (result.isConfirmed) {
          const formData = new FormData();
          formData.append("accion", "borrar");
          formData.append("idusuario", btn.dataset.id);

          enviarPeticion("<?= base_url('usuarios/ajax') ?>", formData, () => location.reload());
        }
      });
    });
  });

});
</script>
