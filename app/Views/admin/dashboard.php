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
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="datos.php">
          <img src="img/inicio_logo.png" alt="" 
               width="130" height="55" class="me-2">
        </a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item mx-2"><a class="nav-link" href="datos.php"></i>Inicio</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="<?= base_url('/Listacategorias') ?>"></i>Categorías</a>
          </li>
          <li class="nav-item mx-2"><li class="nav-item mx-2"><a class="nav-link" href="<?= base_url('/Listasecciones') ?>"> Secciones</a></li>
          <li class="nav-item mx-2"><li class="nav-item mx-2"><a class="nav-link" href="<?= base_url('/Listapersonas') ?>"> Personas</a></li>
          <li class="nav-item mx-2"><li class="nav-item mx-2"><a class="nav-link" href="<?= base_url('/ListarNegocios') ?>">Negocios</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="">Locales</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="">Horario</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="">Carta</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="">Recurso</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="">Usuarios</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="">Contratos</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="">Comentarios</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="">Reservas</a></li>

          </ul>
        </div>
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
