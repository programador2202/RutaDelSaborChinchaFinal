<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 🔹 Fundamental para el diseño responsive -->
  <title>Registro de usuario</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
      font-family: "Segoe UI", sans-serif;
      padding: 1rem;
    }

    .card {
      border-radius: 15px;
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.92);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 420px; /* 🔹 Máximo ancho ideal en pantallas grandes */
      animation: fadeIn 0.8s ease-in-out;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn {
      border-radius: 10px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* 🔹 Ajustes específicos para pantallas pequeñas */
    @media (max-width: 576px) {
      h3 {
        font-size: 1.5rem;
      }
      .card {
        padding: 1.5rem;
      }
      .btn {
        font-size: 0.95rem;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="card shadow p-4 mx-auto">
      <h3 class="text-center mb-4 text-success">Registro</h3>

      <form method="post" action="<?= base_url('registerPost') ?>">
        <div class="mb-3">
          <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" placeholder="Tu nombre" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Apellido</label>
          <input type="text" name="apellido" class="form-control" placeholder="Tu apellido">
        </div>

        <div class="mb-3">
          <label class="form-label">Correo electrónico</label>
          <input type="email" name="email" class="form-control" placeholder="ejemplo@gmail.com" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Teléfono</label>
          <input type="text" name="telefono" class="form-control" placeholder="Tu número de teléfono" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Contraseña</label>
          <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Registrarse</button>

        <p class="text-center mt-3 mb-0">
          ¿Ya tienes cuenta?
          <a href="<?= base_url('login') ?>" class="text-decoration-none fw-semibold">Inicia sesión</a>
        </p>
      </form>
    </div>
  </div>

  <!-- ✅ Mensajes con SweetAlert2 -->
  <?php if (session()->getFlashdata('success')): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: '¡Registro exitoso!',
      text: '<?= session()->getFlashdata('success') ?>',
      confirmButtonColor: '#28a745'
    });
  </script>
  <?php endif; ?>

  <?php if (session()->getFlashdata('error')): ?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '<?= session()->getFlashdata('error') ?>',
      confirmButtonColor: '#dc3545'
    });
  </script>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
