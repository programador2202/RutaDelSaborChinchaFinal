<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar sesión</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
      font-family: "Poppins", "Segoe UI", sans-serif;
      padding: 1rem;
    }

    .card {
      width: 100%;
      max-width: 400px;
      border-radius: 15px;
      background: rgba(255, 255, 255, 0.95);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.8s ease-in-out;
      border: none;
    }

    .card h3 {
      font-weight: 600;
      color: #0d6efd;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px;
      font-size: 0.95rem;
    }

    .btn {
      border-radius: 10px;
      padding: 12px;
      font-weight: 500;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 576px) {
      .card {
        padding: 1.5rem;
      }
      h3 {
        font-size: 1.4rem;
      }
    }
  </style>
</head>

<body>
  <div class="card p-4">
    <h3 class="text-center mb-4">Iniciar sesión</h3>

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

    <form method="post" action="<?= base_url('admin/loginPost') ?>">
      <div class="mb-3">
        <label class="form-label">Usuario</label>
        <input type="text" name="nombreusuario" class="form-control" placeholder="Nombre de usuario" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="claveacceso" class="form-control" placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
