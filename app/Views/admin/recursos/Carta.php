<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container mt-4">
    <h3></i> Gestión de Cartas</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="fa fa-plus"></i> Nueva Carta
    </button>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Local</th>
                <th>Ubicacion</th>
                <th>Sección</th>
                <th>Plato</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cartas)) : ?>
                <?php foreach ($cartas as $carta): ?>
                    <tr>
                        <td><?= $carta['idcarta'] ?></td>
                        <td><?= esc($carta['negocio']) ?></td>
                        <td><?= esc($carta['local']) ?></td>
                        <td><?= $carta['seccion'] ?></td>
                        <td><?= $carta['nombreplato'] ?></td>
                        <td>S/ <?= number_format($carta['precio'], 2) ?></td>
                        <td>
                    <!-- Botón editar -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $carta['idcarta'] ?>"><i class="bi bi-pencil-square"></i></button>

                    <!-- Eliminar -->
                    <a href="<?= base_url('negocios/eliminar/'.$carta['idcarta']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar negocio?')"> <i class="bi bi-trash"></i></a>
                </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No hay platos en la carta</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
