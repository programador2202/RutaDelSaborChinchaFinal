<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Ruta del Sabor</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <!-- SweetAlert2 -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to right, #f8f9fa, #e9ecef);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      padding: 30px;
      width: 100%;
      max-width: 400px;
    }

    .login-card .form-control:focus {
      box-shadow: none;
      border-color: #0d6efd;
    }

    .login-card .btn-login {
      border-radius: 50px;
      padding: 10px;
      font-weight: bold;
    }

    .login-title {
      font-weight: bold;
      margin-bottom: 20px;
      text-align: center;
      color: #0d6efd;
    }

    .toggle-pass {
      cursor: pointer;
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
    }

    .position-relative {
      position: relative;
    }

  </style>
</head>
<body>

<div class="login-card">
  <h3 class="login-title">Ruta del Sabor</h3>
  
  <form id="formLogin">
    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="usuario@ejemplo.com" required>
    </div>

    <div class="mb-3 position-relative">
      <label for="password" class="form-label">Contraseña</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
      <span class="toggle-pass" data-target="password"><i class="bi bi-eye"></i></span>
    </div>

    <button type="submit" class="btn btn-primary w-100 btn-login">Iniciar sesión</button>
  </form>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
  // Mostrar/ocultar contraseña
  document.querySelectorAll(".toggle-pass").forEach(btn => {
    btn.addEventListener("click", () => {
      const input = document.getElementById(btn.dataset.target);
      const icon = btn.querySelector("i");
      if(input.type === "password"){
        input.type = "text";
        icon.classList.replace("bi-eye", "bi-eye-slash");
      } else {
        input.type = "password";
        icon.classList.replace("bi-eye-slash", "bi-eye");
      }
    });
  });

  // Login con fetch y SweetAlert2
  document.getElementById('formLogin').addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    Swal.fire({
      title: 'Iniciando sesión...',
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading()
    });

    try {
      const res = await fetch("<?= base_url('login/ajax') ?>", {
        method: 'POST',
        body: formData
      });
      const data = await res.json();
      Swal.close();

      Swal.fire({
        icon: data.status === 'success' ? 'success' : 'error',
        title: data.message,
        timer: 1500,
        showConfirmButton: false,
        timerProgressBar: true
      }).then(() => {
        if(data.status === 'success') window.location.href = "<?= base_url('dashboard') ?>";
      });

    } catch (err) {
      console.error(err);
      Swal.fire({
        icon: 'error',
        title: 'Error de conexión',
        timer: 1500,
        showConfirmButton: false,
        timerProgressBar: true
      });
    }
  });
</script>

</body>
</html>
