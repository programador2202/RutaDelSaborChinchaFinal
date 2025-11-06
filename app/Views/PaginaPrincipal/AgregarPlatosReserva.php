<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

body {
  background-color: #f9fafb;
  font-family: 'Poppins', sans-serif;
  padding: clamp(0.5rem, 2vw, 1rem);
}

.card-plato {
  border: none;
  border-radius: 1rem;
  overflow: hidden;
  background: #fff;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.card-plato:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
}

.card-img-top {
  width: 100%;
  aspect-ratio: 1 / 1;
  object-fit: cover;
  border-bottom: 1px solid #eee;
}

.card-body {
  display: flex;
  flex-direction: column;
  padding: clamp(0.8rem, 2vw, 1rem);
}

.card-title {
  font-size: clamp(1rem, 2vw, 1.25rem);
  margin-bottom: 0.5rem;
}


.precio-badge {
  font-size: clamp(0.7rem, 1.5vw, 0.9rem);
  padding: clamp(0.3rem, 0.8vw, 0.5rem) clamp(0.6rem, 1.5vw, 0.8rem);
  position: absolute;
  top: 0.5rem;
  right: 0.5rem;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  background-color: #b80000ff;
  border-radius: 0.5rem;
}

/* ==============================
   🔘 Botones
============================== */
.btn-lg {
  width: 100%;
  font-size: clamp(0.9rem, 2vw, 1.1rem);
  padding: clamp(0.6rem, 1.5vw, 0.8rem);
  border-radius: 2rem;
}

/* ==============================
   🖥 Columnas y filas adaptables
============================== */
.row-cols-1, .row-cols-sm-2, .row-cols-md-3 {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}

.col {
  flex: 1 1 calc(33.333% - 1rem); /* hasta 3 columnas */
  max-width: 100%;
}

@media (max-width: 992px) {
  .col {
    flex: 1 1 calc(50% - 1rem); /* 2 columnas tablet */
  }
}

@media (max-width: 576px) {
  .col {
    flex: 1 1 100%; /* 1 columna móvil */
  }
}

/* ==============================
   📱 Responsive Ajustes
============================== */
@media (max-width: 768px) {
  body {
    padding: clamp(0.5rem, 2vw, 0.8rem);
  }

  .card-title {
    font-size: clamp(0.95rem, 2vw, 1.15rem);
  }
}

@media (max-width: 480px) {
  .card-body {
    padding: clamp(0.6rem, 2vw, 0.8rem);
  }

  .row {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .card-plato {
    width: 100%;
  }

  .card-img-top {
    height: auto;
  }
}


</style>


<div class="container py-4">
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

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php if (!empty($platos)): ?>
        <?php foreach ($platos as $plato): ?>
          <div class="col">
            <div class="card card-plato">
              <div class="position-relative">
                <img src="<?= !empty($plato['foto']) ? base_url($plato['foto']) : base_url('assets/img/sin-imagen.png'); ?>" 
                     alt="<?= esc($plato['nombreplato']); ?>" class="card-img-top">
                <span class="badge precio-badge position-absolute top-0 end-0 m-2 px-3 py-2 shadow">
                  S/ <?= number_format($plato['precio'], 2); ?>
                </span>
              </div>

              <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-2"><?= esc($plato['nombreplato']); ?></h5>

                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" name="platos[]" value="<?= esc($plato['idcarta']); ?>" id="plato<?= esc($plato['idcarta']); ?>">
                  <label class="form-check-label" for="plato<?= esc($plato['idcarta']); ?>">Agregar a mi pedido</label>
                </div>

                <div class="input-group input-group-sm mb-2">
                  <span class="input-group-text bg-light">Cantidad</span>
                  <input type="number" name="cantidades[]" class="form-control" min="1" max="50" value="1">
                </div>

                <textarea name="observaciones[]" class="form-control form-control-sm mb-2" placeholder="Observación (opcional)" rows="1"></textarea>
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

    <div class="text-center mt-4">
      <button type="submit" class="btn btn-primary btn-lg shadow-sm">
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= base_url("/") ?>';
                    }
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
