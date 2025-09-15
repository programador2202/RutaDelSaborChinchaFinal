<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container mt-4">
    <h3></i> Gestión de Locales</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="fa fa-plus"></i> Nuevo Local
    </button>

    <table class="table table-bordered table-striped">
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
            <tr>
                <td><?= $l['idlocales'] ?></td>
                <td><?= $l['negocio'] ?></td>
                <td><?= $l['distrito'] ?></td>
                <td><?= $l['direccion'] ?></td>
                <td><?= $l['telefono'] ?></td>
                <td><?= $l['latitud'] ?></td>
                <td><?= $l['longitud'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalEditar"
                        data-id="<?= $l['idlocales'] ?>"
                        data-idnegocio="<?= $l['idnegocio'] ?>"
                        data-iddistrito="<?= $l['iddistrito'] ?>"
                        data-direccion="<?= $l['direccion'] ?>"
                        data-telefono="<?= $l['telefono'] ?>"
                        data-latitud="<?= $l['latitud'] ?>"
                        data-longitud="<?= $l['longitud'] ?>">
                        <i class="fa fa-edit"></i>
                    </button>
                    <a href="<?= base_url('admin/locales/borrar/'.$l['idlocales']) ?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/locales/registrar') ?>" method="post" class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title"><i class="fa fa-plus"></i> Registrar Local</h5>
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
            <label>Distrito</label>
            <select name="iddistrito" class="form-select" required>
                <?php foreach ($distritos as $d): ?>
                <option value="<?= $d['iddistrito'] ?>"><?= $d['distrito'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control">
        </div>
        <div class="mb-2">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>
        <div class="mb-2">
            <label>Latitud</label>
            <input type="text" name="latitud" class="form-control">
        </div>
        <div class="mb-2">
            <label>Longitud</label>
            <input type="text" name="longitud" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/locales/actualizar') ?>" method="post" class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title"><i class="fa fa-edit"></i> Editar Local</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="idlocales" id="editId">
        <div class="mb-2">
            <label>Negocio</label>
            <select name="idnegocio" id="editNegocio" class="form-select" required>
                <?php foreach ($negocios as $n): ?>
                <option value="<?= $n['idnegocio'] ?>"><?= $n['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Distrito</label>
            <select name="iddistrito" id="editDistrito" class="form-select" required>
                <?php foreach ($distritos as $d): ?>
                <option value="<?= $d['iddistrito'] ?>"><?= $d['distrito'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Dirección</label>
            <input type="text" name="direccion" id="editDireccion" class="form-control">
        </div>
        <div class="mb-2">
            <label>Teléfono</label>
            <input type="text" name="telefono" id="editTelefono" class="form-control">
        </div>
        <div class="mb-2">
            <label>Latitud</label>
            <input type="text" name="latitud" id="editLatitud" class="form-control">
        </div>
        <div class="mb-2">
            <label>Longitud</label>
            <input type="text" name="longitud" id="editLongitud" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Actualizar</button>
      </div>
    </form>
  </div>
</div>

