<?= $header ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  body { background-color: #f8f9fa; }
  .card-custom { border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.08); }
  .bg-usuarios { background-color: #0d6efd; color: #fff; }
  .bg-negocios { background-color: #198754; color: #fff; }
  .bg-locales { background-color: #ffc107; color: #000; }
  .bg-comentarios { background-color: #dc3545; color: #fff; }
  .col-texto { max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
</style>

<div class="flex-grow-1 p-4">
    <h3><?= esc($titulo) ?></h3>

    <!-- Tarjetas de estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card card-custom bg-usuarios p-3 text-center">
                <h5>Total Usuarios</h5>
                <h2><?= $total_usuarios ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-custom bg-negocios p-3 text-center">
                <h5>Total Negocios</h5>
                <h2><?= $total_negocios ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-custom bg-locales p-3 text-center">
                <h5>Total Locales</h5>
                <h2><?= $total_locales ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-custom bg-comentarios p-3 text-center">
                <h5>Total Comentarios</h5>
                <h2><?= $total_comentarios ?></h2>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card card-custom p-3 mb-4">
        <h5>Filtrar Comentarios</h5>
        <form method="get" class="row g-3">
            <div class="col-md-4">
                <select class="form-select" name="negocio">
                    <option value="">Seleccionar negocio</option>
                    <?php foreach($negocios as $n): ?>
                        <option value="<?= $n['idnegocio'] ?>" <?= ($filtroNegocio == $n['idnegocio']) ? 'selected' : '' ?>>
                            <?= esc($n['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select" name="local">
                    <option value="">Seleccionar local</option>
                    <?php foreach($locales as $l): ?>
                        <option value="<?= $l['idlocales'] ?>" <?= ($filtroLocal == $l['idlocales']) ? 'selected' : '' ?>>
                            <?= esc($l['nombre_local'] ?? $l['idlocales']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select" name="usuario">
                    <option value="">Seleccionar usuario</option>
                    <?php foreach($usuarios as $u): ?>
                        <option value="<?= $u['id'] ?>" <?= ($filtroUsuario == $u['id']) ? 'selected' : '' ?>>
                            <?= esc($u['nombre'].' '.$u['apellido']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Aplicar filtros</button>
            </div>
        </form>
    </div>

    <!-- Gráficos -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card card-custom p-3">
                <h5>Comentarios por Local</h5>
                <canvas id="comentariosChart" height="100"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-custom p-3">
                <h5>Cartas por Local</h5>
                <canvas id="cartasChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- Tabla de últimos comentarios -->
    <div class="card card-custom p-3 mb-4">
        <h5>Últimos Comentarios</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Local</th>
                        <th>Usuario</th>
                        <th>Comentario</th>
                        <th>Valoración</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($comentarios)): ?>
                        <?php foreach ($comentarios as $c): ?>
                            <tr>
                                <td><?= esc($c['idcomentario']) ?></td>
                                <td><?= esc($c['nombre_local']) ?></td>
                                <td><?= esc($c['nombre_usuario'].' '.$c['apellido']) ?></td>
                                <td class="col-texto" title="<?= esc($c['comentario']) ?>"><?= esc($c['comentario']) ?></td>
                                <td>
                                    <?php for ($i=1; $i<=5; $i++): ?>
                                        <i class="bi <?= $i <= $c['valoracion'] ? 'bi-star-fill text-warning':'bi-star text-secondary' ?>"></i>
                                    <?php endfor; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No hay comentarios</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    // Gráfico comentarios
    const ctx = document.getElementById('comentariosChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php foreach($cartasPorLocal as $c){ echo "'".esc($c['nombre_local'])."',";} ?>],
            datasets: [{
                label: 'Cantidad de Comentarios',
                data: [<?php foreach($cartasPorLocal as $c){ echo esc($c['total_cartas']).","; } ?>],
                backgroundColor: 'rgba(13,110,253,0.5)',
                borderColor: 'rgba(13,110,253,1)',
                borderWidth:1
            }]
        },
        options: { responsive:true, scales:{ y:{ beginAtZero:true } } }
    });

    // Gráfico cartas
    const ctx2 = document.getElementById('cartasChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: [<?php foreach($cartasPorLocal as $c){ echo "'".esc($c['nombre_local'])."',";} ?>],
            datasets: [{
                label: 'Cantidad de Platos',
                data: [<?php foreach($cartasPorLocal as $c){ echo esc($c['total_cartas']).","; } ?>],
                backgroundColor: 'rgba(40,167,69,0.5)',
                borderColor: 'rgba(40,167,69,1)',
                borderWidth:1
            }]
        },
        options: { responsive:true, scales:{ y:{ beginAtZero:true } } }
    });
</script>
