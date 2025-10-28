<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ruta del Sabor Chincha - Dashboard</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f6fa;
      margin: 0;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      min-height: 100vh;
      width: 250px;
      background: #343a40;
      color: #fff;
      transition: all 0.3s;
      z-index: 1030;
      padding-top: 20px;
    }

    .sidebar .nav-link {
      color: #adb5bd;
      transition: 0.3s;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      color: #fff;
      background: #495057;
      border-radius: 8px;
    }
    .sidebar .nav-link i {
      width: 20px;
    }

    /* Contenido principal */
    .content {
      margin-left: 250px; /* mismo ancho del sidebar */
      padding: 20px;
      transition: margin-left 0.3s;
    }

    .navbar {
      background: #fff;
      border-bottom: 1px solid #dee2e6;
    }

    /* Responsive */
    @media (max-width: 992px) {
      .sidebar {
        left: -250px;
      }
      .sidebar.active {
        left: 0;
      }
      .content {
        margin-left: 0; /* en móvil no deja espacio */
      }
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div id="sidebar" class="sidebar d-flex flex-column p-3">

  
    
    <h4 class="mb-4 text-center">Ruta del Sabor Chincha</h4>
    <ul class="nav nav-pills flex-column mb-auto">
      <ul class="nav nav-pills flex-column mb-auto px-2">
   <li>

  <a class="nav-link <?= uri_string() === 'datos/dashboard' ? 'active' : '' ?>" href="<?= base_url('/datos/dashboard') ?>">
    <i class="fas fa-home me-2"></i>Inicio
  </a>
</li>


    <?php if(session()->get('nivelacceso') === 'admin'): ?>
        <li><a class="nav-link" href="<?= base_url('/ListaPersona') ?>"><i class="fas fa-user-friends me-2"></i>Personas</a></li>
        <li><a class="nav-link" href="<?= base_url('/ListaUsuarios') ?>"><i class="fas fa-users-cog me-2"></i>Usuarios</a></li>
        <li><a class="nav-link" href="<?= base_url('/usuarios') ?>"><i class="fas fa-users me-2"></i>Clientes</a></li>
        <li><a class="nav-link" href="<?= base_url('negocios') ?>"><i class="fas fa-store me-2"></i>Negocios</a></li>
        <li><a class="nav-link" href="<?= base_url('/locales') ?>"><i class="fas fa-map-marker-alt me-2"></i>Locales</a></li>
        <li><a class="nav-link" href="<?= base_url('/cartas') ?>"><i class="fas fa-utensils me-2"></i>Cartas</a></li>
        <li><a class="nav-link" href="<?= base_url('/horarios') ?>"><i class="fas fa-clock me-2"></i>Horario</a></li>
        <li><a class="nav-link" href="<?= base_url('/contratos') ?>"><i class="fas fa-file-contract me-2"></i>Contratos</a></li>
        <li><a class="nav-link" href="<?= base_url('comentarios') ?>"><i class="fas fa-comments me-2"></i>Comentarios</a></li>
        <li><a class="nav-link" href="<?= base_url('/reservas')?>"><i class="fas fa-calendar-check me-2"></i>Reservas</a></li>
        <li><a class="nav-link" href="<?= base_url('/reservasplatos')?>"><i class="bi bi-hourglass-split"></i>Pedidos</a></li>
        <li><a class="nav-link" href="<?= base_url('/') ?>"><i class="bi bi-arrow-left me-2"></i> Volver</a></li>



    <?php elseif(session()->get('nivelacceso') === 'representante'): ?>
  
        <li><a class="nav-link" href="<?= base_url('negocios') ?>"><i class="fas fa-store me-2"></i>Mis Negocios</a></li>
        <li><a class="nav-link" href="<?= base_url('/locales') ?>"><i class="fas fa-map-marker-alt me-2"></i>Locales</a></li>
        <li><a class="nav-link" href="<?= base_url('/cartas') ?>"><i class="fas fa-utensils me-2"></i>Cartas</a></li>
        <li><a class="nav-link" href="<?= base_url('/horarios') ?>"><i class="fas fa-clock me-2"></i>Horario</a></li>
        <li><a class="nav-link" href="<?= base_url('comentarios') ?>"><i class="fas fa-comments me-2"></i>Comentarios</a></li>
        <li><a class="nav-link" href="<?= base_url('/reservas')?>"><i class="fas fa-calendar-check me-2"></i>Reservas</a></li>
        <li><a class="nav-link" href="<?= base_url('/reservasplatos')?>"><i class="bi bi-hourglass-split"></i>Pedidos</a></li>
        <li><a class="nav-link" href="<?= base_url('/') ?>"><i class="bi bi-arrow-left me-2"></i> Volver</a></li>

  
    <?php endif; ?>
</ul>

    <hr>
  </div>

  <!-- Contenido -->
<div class="content">
  <!-- Navbar superior -->
  <nav class="navbar navbar-expand-lg px-3">
    <button class="btn btn-outline-dark d-lg-none" id="toggleSidebar">
      <i class="fas fa-bars"></i>
    </button>
    <div class="ms-auto d-flex align-items-center">
      <span class="me-3"><b>Bienvenido</b>, <?= esc(session()->get('nombre_completo')) ?></span>
      <a href="<?= base_url('admin/logout') ?>" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
    </div>
  </nav>

 


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Toggle sidebar en móviles
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
    });
  </script>
</body>
</html>
