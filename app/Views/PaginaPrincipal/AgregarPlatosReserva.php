<!-- ==============================
     Librerías principales
================================= -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f9fafb;
        font-family: 'Poppins', sans-serif;
    }

    .card-plato {
        border: none;
        border-radius: 1rem;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        overflow: hidden;
    }

    .card-plato:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }

    .precio-badge {
        font-weight: 600;
        background: linear-gradient(135deg, #28a745, #20c997);
        font-size: 0.95rem;
    }

    .card-title {
        font-weight: 600;
        color: #212529;
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0069d9);
        border: none;
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0069d9, #0056b3);
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .input-group-text {
        font-weight: 500;
    }

    textarea::placeholder {
        font-style: italic;
        color: #aaa;
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary"><i class="fa-solid fa-utensils me-2"></i>Selecciona tus Platos</h2>
        <p class="text-muted mb-0">Elige los platos que deseas incluir en tu reserva y ajusta la cantidad si es necesario.</p>
    </div>

    <form id="formSeleccionPlatos" action="<?= base_url('reservas-platos/guardar'); ?>" method="POST">
        <input type="hidden" name="idreserva" value="<?= esc($idreserva); ?>">
        <input type="hidden" name="idlocal" value="<?= esc($idlocal); ?>">

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (!empty($platos)): ?>
                <?php foreach ($platos as $plato): ?>
                    <div class="col">
                        <div class="card card-plato h-100">
                            <div class="position-relative">
                                <img 
                                    src="<?= !empty($plato['foto']) ? base_url($plato['foto']) : base_url('assets/img/sin-imagen.png'); ?>" 
                                    alt="<?= esc($plato['nombreplato']); ?>"
                                    class="card-img-top"
                                    style="height: 220px; object-fit: cover;"
                                >
                                <span class="badge precio-badge position-absolute top-0 end-0 m-2 px-3 py-2 shadow">
                                    S/ <?= number_format($plato['precio'], 2); ?>
                                </span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2"><?= esc($plato['nombreplato']); ?></h5>

                                <div class="form-check mb-3">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="platos[]" 
                                        value="<?= esc($plato['idcarta']); ?>" 
                                        id="plato<?= esc($plato['idcarta']); ?>"
                                    >
                                    <label class="form-check-label" for="plato<?= esc($plato['idcarta']); ?>">
                                        Agregar a mi pedido
                                    </label>
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text bg-light">Cantidad</span>
                                    <input 
                                        type="number" 
                                        name="cantidades[]" 
                                        class="form-control" 
                                        min="1" 
                                        max="50" 
                                        value="1"
                                    >
                                </div>

                                <textarea 
                                    name="observaciones[]" 
                                    class="form-control form-control-sm mb-3" 
                                    placeholder="Observación (opcional)" 
                                    rows="1"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <div class="alert alert-warning shadow-sm">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>
                        No hay platos registrados para este local.
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                <i class="fa-solid fa-check-circle me-2"></i> Confirmar Selección
            </button>
        </div>
    </form>
</div>

<!-- ==============================
     Librerías JS
================================= -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$('#formSeleccionPlatos').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: '<?= base_url("reservas-platos/guardar") ?>',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Pedido registrado',
                    text: response.mensaje,
                    confirmButtonText: 'Aceptar'
                });
                $('#formSeleccionPlatos')[0].reset();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: response.mensaje
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un problema al procesar tu pedido.'
            });
        }
    });
});
</script>
