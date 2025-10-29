<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f9fafb;
        font-family: 'Poppins', sans-serif;
        padding: 1rem;
        overflow-x: hidden; /* ✅ Evita desbordes horizontales */
    }

    .card-plato {
        border: none;
        border-radius: 1rem;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        overflow: hidden;
        background: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-plato:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    /* ✅ Mantiene proporción sin deformar */
    .card-img-top {
        width: 100%;
        aspect-ratio: 4 / 3; /* relación 4:3 adaptable */
        object-fit: cover;
        display: block;
        border-bottom: 1px solid #eee;
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

    /* ==============================
       🔹 Ajustes Responsive
    =============================== */
    @media (max-width: 992px) {
        .row-cols-md-3 {
            row-gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .card-img-top {
            aspect-ratio: 1 / 1; /* ✅ cuadrada en tablets */
        }
        .btn-lg {
            font-size: 1rem;
            padding: 0.75rem 2rem;
        }
    }

    @media (max-width: 576px) {
        body {
            padding: 0.5rem;
        }

        h2 {
            font-size: 1.4rem;
        }

        .text-muted {
            font-size: 0.95rem;
        }

        .row.row-cols-1.row-cols-sm-2.row-cols-md-3 {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
        }

        .col {
            width: 100%;
            max-width: 400px;
            display: flex;
            justify-content: center;
        }

        .card-plato {
            width: 100%;
            margin-bottom: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 1rem;
        }

        .btn-lg {
            width: 100%;
            font-size: 1rem;
            padding: 0.9rem;
        }
    }

    @media (max-width: 400px) {
        .card-img-top {
            aspect-ratio: 1 / 1; /* ✅ cuadrada para pantallas muy pequeñas */
        }

        .card-body {
            padding: 0.8rem;
        }

        .card-title {
            font-size: 0.9rem;
        }

        .precio-badge {
            font-size: 0.8rem;
        }

        .btn-lg {
            font-size: 0.9rem;
            padding: 0.7rem;
        }
    }
</style>


<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fa-solid fa-utensils me-2"></i>Selecciona tus Platos
        </h2>
        <p class="text-muted mb-0">
            Elige los platos que deseas incluir en tu reserva y ajusta la cantidad si es necesario.
        </p>
    </div>

    <form id="formSeleccionPlatos" action="<?= base_url('reservas-platos/guardar'); ?>" method="POST">
        <input type="hidden" name="idreserva" value="<?= esc($idreserva); ?>">
        <input type="hidden" name="idlocal" value="<?= esc($idlocal); ?>">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php if (!empty($platos)): ?>
                <?php foreach ($platos as $plato): ?>
                    <div class="col">
                        <div class="card card-plato">
                            <div class="position-relative">
                                <img 
                                    src="<?= !empty($plato['foto']) ? base_url($plato['foto']) : base_url('assets/img/sin-imagen.png'); ?>" 
                                    alt="<?= esc($plato['nombreplato']); ?>"
                                    class="card-img-top"
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
