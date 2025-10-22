<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservas | Ruta del Sabor</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('<?= base_url('assets/img/fondo-comida.jpg') ?>') center/cover no-repeat fixed;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(4px);
      padding: 20px;
    }

    .card-reserva {
      background: rgba(255, 255, 255, 0.9);
      border: none;
      border-radius: 20px;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-reserva:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    }

    .titulo {
      color: #ff7043;
      font-weight: 700;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .btn-reserva {
      background: linear-gradient(90deg, #ff7043, #ff8a65);
      border: none;
      color: #fff;
      font-weight: 600;
      border-radius: 50px;
      transition: all 0.3s ease;
    }

    .btn-reserva:hover {
      background: linear-gradient(90deg, #ff8a65, #ff7043);
      transform: scale(1.03);
      box-shadow: 0 4px 12px rgba(255, 112, 67, 0.5);
    }

    label {
      font-weight: 500;
      color: #333;
    }

    .form-control:focus {
      border-color: #ff7043;
      box-shadow: 0 0 0 0.25rem rgba(255, 112, 67, 0.25);
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card card-reserva p-4">
          <div class="text-center mb-4">
            <h1 class="titulo mb-2">🍽️ Reserva tu Mesa</h1>
            <p class="fw-semibold text-muted">
              Disfruta una experiencia gastronómica única en <strong>Ruta del Sabor</strong>
            </p>
          </div>

          <form id="formReserva">
            <input type="hidden" name="accion" value="registrar">
            <input type="hidden" name="idpersonasolicitud" value="<?= esc($idusuario) ?>">
            <input type="hidden" name="idlocales" value="1">
            <input type="hidden" name="idhorario" value="1">

            <?php if (!empty($nombreCompleto)): ?>
              <div class="mb-3">
                <label class="form-label">👤 Nombre</label>
                <input type="text" class="form-control" value="<?= esc($nombreCompleto) ?>" readonly>
              </div>
              <div class="mb-3">
                <label class="form-label">📧 Correo</label>
                <input type="email" class="form-control" value="<?= esc($email) ?>" readonly>
              </div>
              <div class="mb-3">
                <label class="form-label">📞 Teléfono</label>
                <input type="text" class="form-control" value="<?= esc($telefono) ?>" readonly>
              </div>
            <?php endif; ?>

            <div class="mb-3">
              <label for="fechahora" class="form-label">📅 Fecha y hora</label>
              <input type="datetime-local" class="form-control" id="fechahora" name="fechahora" required>
            </div>

            <div class="mb-3">
              <label for="cantidadpersonas" class="form-label">👥 Cantidad de personas</label>
              <input type="number" class="form-control" id="cantidadpersonas" name="cantidadpersonas" min="1" required>
            </div>

            <button type="submit" class="btn btn-reserva w-100">
              <i class="bi bi-check-circle me-2"></i> Reservar
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#formReserva').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        url: '<?= base_url('ajax') ?>',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: '¡Reserva registrada!',
              text: response.mensaje || 'Tu reserva ha sido guardada correctamente.',
              confirmButtonColor: '#ff7043'
            });
            $('#formReserva')[0].reset();
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.mensaje || 'No se pudo guardar la reserva.',
              confirmButtonColor: '#ff7043'
            });
          }
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'No se pudo enviar la reserva. Intenta nuevamente.',
            confirmButtonColor: '#ff7043'
          });
        }
      });
    });
  </script>

</body>
</html>
