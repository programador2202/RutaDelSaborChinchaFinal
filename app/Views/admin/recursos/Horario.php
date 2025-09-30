<?= $header ?? '' ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h3>Gestión de Horarios</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
        <i class="bi bi-plus"></i> Nuevo Horario
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
                    <a href="#" 
                       class="btn btn-warning btn-sm btn-editar" 
                       data-id="<?= $h['idhorario'] ?>"
                       data-dia="<?= $h['diasemana'] ?>"
                       data-inicio="<?= $h['inicio'] ?>"
                       data-fin="<?= $h['fin'] ?>"
                       data-local="<?= $h['idlocales'] ?>">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="#" 
                       class="btn btn-danger btn-sm btn-eliminar"
                       data-id="<?= $h['idhorario'] ?>">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistrarLabel">Registrar Nuevo Horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formRegistrar" method="post">
                    <input type="hidden" name="accion" value="registrar">
                    <div class="mb-3">
                        <label for="diasemana" class="form-label">Día de la Semana</label>
                        <select class="form-select" id="diasemana" name="diasemana" required>
                            <option value="">Seleccione un día</option>
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="miercoles">Miércoles</option>
                            <option value="jueves">Jueves</option>
                            <option value="viernes">Viernes</option>
                            <option value="sabado">Sábado</option>
                            <option value="domingo">Domingo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inicio" class="form-label">Hora de Inicio</label>
                        <input type="time" class="form-control" id="inicio" name="inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="fin" class="form-label">Hora de Fin</label>
                        <input type="time" class="form-control" id="fin" name="fin" required>
                    </div>
                    <div class="mb-3">
                        <label for="idlocales" class="form-label">Local</label>
                        <select class="form-select" id="idlocales" name="idlocales" required>
                            <option value="">Seleccione un local</option>
                            <?php foreach ($locales as $local): ?>
                                <option value="<?= $local['idlocales'] ?>"><?= $local['negocio'] ?> - <?= $local['direccion'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditar" method="post">
                    <input type="hidden" name="accion" value="actualizar">
                    <input type="hidden" id="idhorario" name="idhorario">
                    <div class="mb-3">
                        <label for="diasemana_editar" class="form-label">Día de la Semana</label>
                        <select class="form-select" id="diasemana_editar" name="diasemana" required>
                            <option value="">Seleccione un día</option>
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="miercoles">Miércoles</option>
                            <option value="jueves">Jueves</option>
                            <option value="viernes">Viernes</option>
                            <option value="sabado">Sábado</option>
                            <option value="domingo">Domingo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inicio_editar" class="form-label">Hora de Inicio</label>
                        <input type="time" class="form-control" id="inicio_editar" name="inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="fin_editar" class="form-label">Hora de Fin</label>
                        <input type="time" class="form-control" id="fin_editar" name="fin" required>
                    </div>
                    <div class="mb-3">
                        <label for="idlocales_editar" class="form-label">Local</label>
                        <select class="form-select" id="idlocales_editar" name="idlocales" required>
                            <option value="">Seleccione un local</option>
                            <?php foreach ($locales as $local): ?>
                                <option value="<?= $local['idlocales'] ?>"><?= $local['negocio'] ?> - <?= $local['direccion'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const enviarDatos = async (formData) => {
    try {
        const res = await fetch("<?= base_url('Horario/ajax') ?>", {
            method: 'POST',
            body: formData
        });
        return await res.json();
    } catch (err) {
        console.error('Error en la petición:', err);
        showAlert('error', 'Error de conexión');
        return null;
    }
};

const showAlert = (icon, title, timer = 1500) => {
    return Swal.fire({
        icon,
        title,
        timer,
        showConfirmButton: false,
        timerProgressBar: true
    });
};

// Formularios: registrar y actualizar
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        Swal.fire({
            title: "Procesando...",
            text: "Por favor espere",
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        const data = await enviarDatos(formData);
        if (data) {
            Swal.close();
            showAlert(data.status === 'success' ? 'success' : 'error', data.mensaje)
                .then(() => {
                    if (data.status === 'success') {
                        location.reload();
                    }
                });
        }
    });
});

// Editar botón
document.querySelectorAll('.btn-editar').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('idhorario').value = btn.getAttribute('data-id');
        document.getElementById('diasemana_editar').value = btn.getAttribute('data-dia');
        document.getElementById('inicio_editar').value = btn.getAttribute('data-inicio');
        document.getElementById('fin_editar').value = btn.getAttribute('data-fin');
        document.getElementById('idlocales_editar').value = btn.getAttribute('data-local');
        var modalEditar = new bootstrap.Modal(document.getElementById('modalEditar'));
        modalEditar.show();
    });
});

// Eliminar botón
document.querySelectorAll('.btn-eliminar').forEach(button => {
    button.addEventListener('click', async (e) => {
        e.preventDefault();
        const idhorario = button.getAttribute('data-id');

        const result = await Swal.fire({
            title: '¿Eliminar este horario?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        });

        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('accion', 'eliminar');
            formData.append('idhorario', idhorario);

            Swal.fire({
                title: "Procesando...",
                text: "Por favor espere",
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            const data = await enviarDatos(formData);
            if (data) {
                Swal.close();
                showAlert(data.status === 'success' ? 'success' : 'error', data.mensaje)
                    .then(() => {
                        if (data.status === 'success') {
                            location.reload();
                        }
                    });
            }
        }
    });
});
</script>
