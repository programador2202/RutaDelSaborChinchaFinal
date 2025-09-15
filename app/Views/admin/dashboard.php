<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ruta del Sabor Chincha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
</head>

<body>
  <header>

  

    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-2">
      <div class="container">
     

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item mx-2">
      <a class="nav-link" href="datos.php"><i class="fas fa-home me-1"></i>Inicio</a>
    </li>
    <li class="nav-item mx-2">
      <a class="nav-link" href="<?= base_url('/personas') ?>"><i class="fas fa-user-friends me-1"></i>Personas</a>
    </li>
    <li class="nav-item mx-2">
      <a class="nav-link" href="<?= base_url('/usuarios') ?>"><i class="fas fa-users-cog me-1"></i>Usuarios</a>
    </li>
    <li class="nav-item mx-2">
      <a class="nav-link" href="<?= base_url('/negocios') ?>"><i class="fas fa-store me-1"></i>Negocios</a>
    </li>
    <li class="nav-item mx-2">
      <a class="nav-link" href="<?= base_url('/locales') ?>"><i class="fas fa-map-marker-alt me-1"></i>Locales</a>
    </li>
    <li class="nav-item mx-2">
      <a class="nav-link" href="<?= base_url('/cartas') ?>"><i class="fas fa-utensils me-1"></i>Cartas</a>
    </li>
    <li class="nav-item mx-2">
      <a class="nav-link" href="#"><i class="fas fa-clock me-1"></i>Horario</a>
    </li>
    <li class="nav-item mx-2">
      <a class="nav-link" href="#"><i class="fas fa-box-open me-1"></i>Recurso</a>
    </li>
    <li class="nav-item mx-2">
      <a class="nav-link" href="#"><i class="fas fa-file-contract me-1"></i>Contratos</a>
    </li>
    <li class="nav-item mx-2">
      <a class="nav-link" href="#"><i class="fas fa-comments me-1"></i>Comentarios</a>
    </li>
    <li class="nav-item mx-2">
      <a class="nav-link" href="#"><i class="fas fa-calendar-check me-1"></i>Reservas</a>
    </li>
  </ul>
</div>

    </nav>
  </header>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  <script>
    const navLinks = document.querySelectorAll('.nav-link');
    const navCollapse = document.getElementById('navbarSupportedContent');

    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth < 992) { 
          const collapse = new bootstrap.Collapse(navCollapse, { toggle: false });
          collapse.hide();
        }
      });
    });
  </script>
</body>
</html>
