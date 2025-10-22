<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
    }
    .card {
      border-radius: 15px;
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.9);
    }
    .form-control {
      border-radius: 10px;
    }
    .btn {
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="col-md-4 mx-auto">
      <div class="card shadow p-4">
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

          <p class="text-center mt-3">
            ¿Ya tienes cuenta? <a href="<?= base_url('login') ?>">Inicia sesión</a>
          </p>
        </form>
      </div>
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
