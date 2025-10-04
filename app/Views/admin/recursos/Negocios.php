<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
  .logo-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  }
  .table td, .table th {
  vertical-align: middle;
}

.col-texto {
  max-width: 200px;       
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}


  
</style>

<div class="container mt-4">
  <div class="card card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-shop-window me-2"></i> Gestión de Negocios</h5>
      <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-plus-circle"></i> Nuevo Negocio
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Nombre Comercial</th>
              <th>Slogan</th>
              <th>RUC</th>
              <th>Categoría</th>
              <th>Representante</th>
              <th>Logo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($negocios as $n): ?>
            <tr id="row<?= $n['idnegocio'] ?>">
              <td class="text-center"><span class="badge bg-secondary"><?= $n['idnegocio'] ?></span></td>
              <td><?= $n['nombre'] ?></td>
              <td><?= $n['nombrecomercial'] ?></td>
              <td class="col-texto"><?= $n['slogan'] ?></td>
              <td><?= $n['ruc'] ?></td>
              <td><span class="badge bg-info text-dark"><?= $n['categoria'] ?></span></td>
              <td class="col-texto"><?= $n['apellidos'] . ', ' . $n['nombres'] ?></td>
              <td class="text-center">
                <?php if (!empty($n['logo'])): ?>
                  <img src="<?= base_url($n['logo']) ?>" class="logo-img">
                <?php else: ?>
                  <span class="badge bg-light text-dark">Sin logo</span>
                <?php endif; ?>
              </td>
              <td class="text-center">
                <button class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $n['idnegocio'] ?>">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm btn-action btnEliminar" data-id="<?= $n['idnegocio'] ?>">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>

            <!-- Modal Editar -->
            <div class="modal fade" id="modalEditar<?= $n['idnegocio'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <form class="formEditar" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="accion" value="actualizar">
                    <input type="hidden" name="idnegocio" value="<?= $n['idnegocio'] ?>">

                    <div class="modal-header bg-warning text-dark">
                      <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Editar Negocio</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label>Nombre:</label>
                          <input type="text" name="nombre" class="form-control" value="<?= $n['nombre'] ?>" required>
                        </div>
                        <div class="col-md-6">
                          <label>Nombre Comercial:</label>
                          <input type="text" name="nombrecomercial" class="form-control" value="<?= $n['nombrecomercial'] ?>">
                        </div>
                        <div class="col-md-6">
                          <label>Slogan:</label>
                          <input type="text" name="slogan" class="form-control" value="<?= $n['slogan'] ?>">
                        </div>
                        <div class="col-md-6">
                          <label>RUC:</label>
                          <input type="text" name="ruc" class="form-control" value="<?= $n['ruc'] ?>">
                        </div>
                        <div class="col-md-6">
                          <label>Categoría:</label>
                          <select name="idcategoria" class="form-control">
                            <?php foreach ($categorias as $c): ?>
                              <option value="<?= $c['idcategoria'] ?>" <?= $n['idcategoria']==$c['idcategoria']?'selected':'' ?>>
                                <?= $c['categoria'] ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label>Representante:</label>
                          <select name="idrepresentante" class="form-control">
                            <?php foreach ($personas as $p): ?>
                              <option value="<?= $p['idpersona'] ?>" <?= $n['idrepresentante']==$p['idpersona']?'selected':'' ?>>
                                <?= $p['apellidos'] . ', ' . $p['nombres'] ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-12">
                          <label>Logo:</label>
                          <input type="file" name="logo" class="form-control">
                          <?php if (!empty($n['logo'])): ?>
                            <small class="text-muted">Logo actual:</small><br>
                            <img src="<?= base_url($n['logo']) ?>" class="logo-img mt-2">
                          <?php endif; ?>
                        </div>
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
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="formRegistrar" enctype="multipart/form-data" method="post">
        <input type="hidden" name="accion" value="registrar">

        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Nuevo Negocio</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <label>Nombre:</label>
          <input type="text" name="nombre" class="form-control mb-2" required>

          <label>Nombre Comercial:</label>
          <input type="text" name="nombrecomercial" class="form-control mb-2">

          <label>Slogan:</label>
          <input type="text" name="slogan" class="form-control mb-2">

          <label>RUC:</label>
          <input type="text" name="ruc" class="form-control mb-2">

          <label>Categoría:</label>
          <select name="idcategoria" class="form-control mb-2" required>
            <option value="">Seleccione una categoría</option>
            <?php foreach ($categorias as $c): ?>
              <option value="<?= $c['idcategoria'] ?>"><?= $c['categoria'] ?></option>
            <?php endforeach; ?>
          </select>

          <label>Representante:</label>
          <select name="idrepresentante" class="form-control mb-2" required>
            <option value="">Seleccione un representante</option>
            <?php foreach ($personas as $p): ?>
              <option value="<?= $p['idpersona'] ?>"><?= $p['apellidos'] . ', ' . $p['nombres'] ?></option>
            <?php endforeach; ?>
          </select>

          <label>Logo:</label>
          <input type="file" name="logo" class="form-control mb-2">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

  // 🔹 Función helper para peticiones fetch con SweetAlert
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

  // 🔹 Manejo de formularios (Registrar y Editar negocio)
document.querySelectorAll("#formRegistrar, .formEditar").forEach(form => {
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

    enviarPeticion("<?= base_url('negocios/ajax') ?>", formData, () => location.reload());
  });
});

  // 🔹 Manejo de borrar negocio
  document.querySelectorAll(".btnEliminar").forEach(btn => {
    btn.addEventListener("click", () => {
      Swal.fire({
        title: "¿Seguro de eliminar este negocio?",
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
          formData.append("idnegocio", btn.dataset.id);

          enviarPeticion("<?= base_url('negocios/ajax') ?>", formData, () => location.reload());
        }
      });
    });
  });

});
</script>
