<?= $header ?? '' ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container mt-4">
    <h3></i> Gestión de Horarios</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="fa fa-plus"></i> Nuevo Horario
    </button>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Negocio</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Día</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($horarios as $h): ?>
            <tr>
               <td><?= $h['negocio'] ?></td>
            <td><?= $h['direccion'] ?></td>
            <td><?= $h['telefono'] ?></td>
            <td><?= $h['diasemana'] ?></td>
            <td><?= $h['inicio'] ?></td>
            <td><?= $h['fin'] ?></td>
                <td>
                    <a href="<?= base_url('horarios/editar/'.$h['idhorario']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="<?= base_url('horarios/eliminar/'.$h['idhorario']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este horario?')"> <i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
