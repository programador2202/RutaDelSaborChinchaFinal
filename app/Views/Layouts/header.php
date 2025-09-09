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
  <!----MENU PRINCIPAL--->
  <header>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-2">
      <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/RutaDelSaborChincha123/index.php">
        <img src="<?= base_url('public/img/inicio_logo.png') ?>" alt="Logo Ruta del Sabor">
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
            <li class="nav-item mx-2">
              <a class="nav-link" href="/RutaDelSaborChincha123/index.php"><i class="fas fa-home me-1"></i>Inicio</a>
            </li>
            <li class="nav-item  mx-2">
              <a class="nav-link" href="#categoria">
                <i class="fas fa-utensils me-1"></i> Categorías
              </a>

              <li class="nav-item mx-2">
              <a class="nav-link" href="/RutaDelSaborChincha123/views/nosotros.php"><i class="fas fa-users me-1"></i>Nosotros</a>
            </li>
            </li>
            <li class="nav-item mx-2"><a class="nav-link" href="/RutaDelSaborChincha123/views/categorias/Vitinicolas.php"><i class="fas fa-wine-bottle me-1"></i> Vitinícolas</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#"><i class="fas fa-blog me-1"></i> Blog</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#"><i class="fab fa-facebook fa-lg"></i></a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#"><i class="fab fa-whatsapp fa-lg"></i></a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#"><i class="fab fa-tiktok fa-lg"></i></a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="http://localhost/RutaDelSaborChincha123/views/admin/datos.php"><i class="fas fa-user-circle fa-lg"></i></a></li>

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
