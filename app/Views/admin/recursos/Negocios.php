<?= $header ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h3></i> Gestión de Negocios</h3>
    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-plus-circle"></i> Nuevo Negocio
    </a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Nombre Comercial</th>
                <th>Slogan</th>
                <th>RUC</th>
                <th>Categoría</th>
                <th>Representante</th>
                <th>Logo</th>
                <th>Banner</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($negocios as $n): ?>
            <tr>
                <td><?= $n['idnegocio'] ?></td>
                <td><?= $n['nombre'] ?></td>
                <td><?= $n['nombrecomercial'] ?></td>
                <td><?= $n['slogan'] ?></td>
                <td><?= $n['ruc'] ?></td>
                <td><?= $n['categoria'] ?></td>
                <td><?= $n['apellidos'] . ', ' . $n['nombres'] ?></td>
                <td><?= $n['logo'] ?></td>
                <td><?= $n['banner'] ?></td>
                <td>
                    <!-- Botón editar -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $n['idnegocio'] ?>"><i class="bi bi-pencil-square"></i></button>

                    <!-- Eliminar -->
                    <a href="<?= base_url('negocios/eliminar/'.$n['idnegocio']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar negocio?')"> <i class="bi bi-trash"></i></a>
                </td>
            </tr>

            <!-- Modal Editar -->
            <div class="modal fade" id="modalEditar<?= $n['idnegocio'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form action="<?= base_url('negocios/actualizar') ?>" method="post">
                    <input type="hidden" name="idnegocio" value="<?= $n['idnegocio'] ?>">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title"><i class="fa fa-edit"></i> Editar Negocio</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <label>Nombre:</label>
                      <input type="text" name="nombre" class="form-control mb-2" value="<?= $n['nombre'] ?>" required>

                      <label>Nombre Comercial:</label>
                      <input type="text" name="nombrecomercial" class="form-control mb-2" value="<?= $n['nombrecomercial'] ?>">

                      <label>Slogan:</label>
                      <input type="text" name="slogan" class="form-control mb-2" value="<?= $n['slogan'] ?>">

                      <label>RUC:</label>
                      <input type="text" name="ruc" class="form-control mb-2" value="<?= $n['ruc'] ?>">

                      <label>Categoría:</label>
                      <select name="idcategoria" class="form-control mb-2">
                        <?php foreach ($categorias as $c): ?>
                          <option value="<?= $c['idcategoria'] ?>" <?= $n['idcategoria']==$c['idcategoria']?'selected':'' ?>>
                            <?= $c['categoria'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>

                      <label>Representante:</label>
                      <select name="idrepresentante" class="form-control mb-2">
                        <?php foreach ($personas as $p): ?>
                          <option value="<?= $p['idpersona'] ?>" <?= $n['idrepresentante']==$p['idpersona']?'selected':'' ?>>
                            <?= $p['apellidos'] . ', ' . $p['nombres'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-warning">
                         <i class="bi bi-save"></i> Actualizar</button>
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
      <form action="<?= base_url('negocios') ?>" method="post">
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
          <select name="idcategoria" class="form-control mb-2">
            <?php foreach ($categorias as $c): ?>
              <option value="<?= $c['idcategoria'] ?>"><?= $c['categoria'] ?></option>
            <?php endforeach; ?>
          </select>

          <label>Representante:</label>
          <select name="idrepresentante" class="form-control mb-2">
            <?php foreach ($personas as $p): ?>
              <option value="<?= $p['idpersona'] ?>"><?= $p['apellidos'] . ', ' . $p['nombres'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
