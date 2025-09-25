<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<div class="container mt-4">
    <h3>Gestión de Cartas</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-plus-circle"></i> Nueva Carta
    </button>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Negocio</th>
                <th>Local</th>
                <th>Sección</th>
                <th>Plato</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($cartas)): ?>
                <?php foreach($cartas as $carta): ?>
                <tr id="fila-<?= $carta['idcarta'] ?>">
                    <td><?= $carta['idcarta'] ?></td>
                    <td><?= esc($carta['nombre_negocio']) ?></td>
                    <td><?= esc($carta['direccion_local']) ?></td>
                    <td><?= esc($carta['nombre_seccion']) ?></td>
                    <td><?= esc($carta['nombreplato']) ?></td>
                    <td>S/ <?= number_format($carta['precio'],2) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-editar" 
                            data-id="<?= $carta['idcarta'] ?>"
                            data-idlocales="<?= $carta['idlocales'] ?>"
                            data-idseccion="<?= $carta['idseccion'] ?>"
                            data-nombreplato="<?= esc($carta['nombreplato']) ?>"
                            data-descripcion="<?= esc($carta['descripcion'] ?? '') ?>"
                            data-precio="<?= $carta['precio'] ?>">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <button class="btn btn-danger btn-sm btn-eliminar" data-id="<?= $carta['idcarta'] ?>">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">No hay cartas registradas</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formRegistrarCarta">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Registrar Carta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Local</label>
                    <select class="form-select mb-2" name="idlocales" required>
                        <option value="">Seleccione un local</option>
                        <?php foreach($locales as $local): ?>
                        <option value="<?= $local['idlocales'] ?>">
                            <?= esc($local['nombre_negocio']) ?> - <?= esc($local['direccion']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Sección</label>
                    <select class="form-select mb-2" name="idseccion" required>
                        <option value="">Seleccione una sección</option>
                        <?php foreach($secciones as $s): ?>
                        <option value="<?= $s['idseccion'] ?>"><?= esc($s['seccion']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Plato</label>
                    <input type="text" class="form-control mb-2" name="nombreplato" required>

                    <label>Descripción</label>
                    <textarea class="form-control mb-2" name="descripcion"></textarea>

                    <label>Precio</label>
                    <input type="number" step="0.01" class="form-control" name="precio" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditarCarta">
                <input type="hidden" name="idcarta" id="editId">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">Editar Carta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Local</label>
                    <select class="form-select mb-2" name="idlocales" id="editLocal" required>
                        <option value="">Seleccione un local</option>
                        <?php foreach($locales as $local): ?>
                        <option value="<?= $local['idlocales'] ?>"><?= esc($local['nombre_negocio']) ?> - <?= esc($local['direccion']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Sección</label>
                    <select class="form-select mb-2" name="idseccion" id="editSeccion" required>
                        <option value="">Seleccione una sección</option>
                        <?php foreach($secciones as $s): ?>
                        <option value="<?= $s['idseccion'] ?>"><?= esc($s['seccion']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Plato</label>
                    <input type="text" class="form-control mb-2" name="nombreplato" id="editNombreplato" required>

                    <label>Descripción</label>
                    <textarea class="form-control mb-2" name="descripcion" id="editDescripcion"></textarea>

                    <label>Precio</label>
                    <input type="number" step="0.01" class="form-control" name="precio" id="editPrecio" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Registrar carta
    document.getElementById('formRegistrarCarta').addEventListener('submit', function(e){
        e.preventDefault();
        fetch("<?= base_url('cartas/ajax') ?>", {
            method: 'POST',
            body: new FormData(this)
        }).then(res => res.json())
          .then(data => {
              Swal.fire({
                  icon: data.status==='success'?'success':'error',
                  title: data.message,
                  timer: 1500,
                  showConfirmButton:false
              }).then(()=>{ if(data.status==='success') location.reload(); });
          });
    });

    // Editar carta (abrir modal con datos)
    document.querySelectorAll('.btn-editar').forEach(btn=>{
        btn.addEventListener('click', function(){
            const data = btn.dataset;
            document.getElementById('editId').value = data.id;
            document.getElementById('editLocal').value = data.idlocales;
            document.getElementById('editSeccion').value = data.idseccion;
            document.getElementById('editNombreplato').value = data.nombreplato;
            document.getElementById('editDescripcion').value = data.descripcion;
            document.getElementById('editPrecio').value = data.precio;
            new bootstrap.Modal(document.getElementById('modalEditar')).show();
        });
    });

    // Actualizar carta
    document.getElementById('formEditarCarta').addEventListener('submit', function(e){
        e.preventDefault();
        fetch("<?= base_url('cartas/ajax') ?>", {
            method:'POST',
            body: new FormData(this)
        }).then(res=>res.json())
          .then(data=>{
              Swal.fire({
                  icon: data.status==='success'?'success':'error',
                  title: data.message,
                  timer:1500,
                  showConfirmButton:false
              }).then(()=>{ if(data.status==='success') location.reload(); });
          });
    });

    // Eliminar carta
    document.querySelectorAll('.btn-eliminar').forEach(btn=>{
        btn.addEventListener('click', function(){
            Swal.fire({
                title: '¿Está seguro de eliminar esta carta?',
                icon:'warning',
                showCancelButton:true,
                confirmButtonColor:'#d33',
                cancelButtonColor:'#3085d6',
                confirmButtonText:'Sí, eliminar',
                cancelButtonText:'Cancelar'
            }).then(result=>{
                if(result.isConfirmed){
                    let formData = new FormData();
                    formData.append('accion','eliminar');
                    formData.append('idcarta', btn.dataset.id);
                    fetch("<?= base_url('cartas/ajax') ?>", { method:'POST', body:formData })
                        .then(res=>res.json())
                        .then(data=>{
                            Swal.fire({
                                icon:data.status==='success'?'success':'error',
                                title:data.message,
                                timer:1500,
                                showConfirmButton:false
                            }).then(()=>{ if(data.status==='success') location.reload(); });
                        });
                }
            });
        });
    });

});
</script>
