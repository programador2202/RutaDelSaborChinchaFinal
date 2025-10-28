<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 🔹 Clave para hacerlo responsive -->
  <title>Iniciar sesión</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
      background: rgba(255, 255, 255, 0.95);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.8s ease-in-out;
      width: 100%;
      max-width: 400px; /* 🔹 Limita el ancho máximo */
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

    /* 🔹 Ajustes visuales en pantallas pequeñas */
    @media (max-width: 576px) {
      h3 {
        font-size: 1.5rem;
      }
      .card {
        padding: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="card shadow p-4 mx-auto">
      <h3 class="text-center mb-4 text-primary">Iniciar sesión</h3>

      <!-- ⚠️ Mensaje de error -->
      <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('error') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <!-- ✅ Mensaje de éxito -->
      <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <form method="post" action="<?= base_url('loginPost') ?>">
        <div class="mb-3">
          <label class="form-label">Correo electrónico</label>
          <input type="email" name="email" class="form-control" placeholder="ejemplo@gmail.com" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Contraseña</label>
          <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
      </form>

      <p class="text-center mt-3 mb-0">
        ¿No tienes cuenta?
        <a href="<?= base_url('register') ?>" class="text-decoration-none fw-semibold">Regístrate aquí</a>
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
