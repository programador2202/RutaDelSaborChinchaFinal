<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nosotros - Ruta del Sabor Chincha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-light">

  <!-- HEADER -->
  <?= $header; ?>

  <!-- Presentación principal -->
  <section class="bg-light py-5 shadow-sm">
    <div class="container text-center">
      <img src="../public/img/Quique.jpg"
           class="rounded-circle shadow mb-3"
           alt="Quique Ronceros - CEO Ruta del Sabor"
           width="200" height="200">
      <p class=" text-black">Nuestro CEO</p>
      <h4 class="fw-bold text-warning" >Quique Ronceros</h4>
      <h2 class="fw-bold mt-2 text-warning">Ruta del Sabor Chincha</h2>
      <p class="lead text-black mt-3">
       <b>En Ruta del Sabor, somos una marca comprometida con la promoción y difusión de la riqueza gastronómica y cultural de Chincha. Visibilizamos sabores auténticos que caracterizan a nuestra tierra, conectando a locales y turistas con los mejores restaurantes y viñedos de la provincia.
        </b></p>
      <p class="text-black">
        Somos la guía que necesitas para vivir una experiencia culinaria única y gratificante. Facilitamos el descubrimiento de esos lugares escondidos que merecen ser celebrados por su tradición, sabor y hospitalidad. Queremos que cada visita sea una oportunidad para saborear lo mejor de nuestra región, apoyando a emprendedores y talentos locales.
      </p>
    </div>
  </section>

  <!-- Misión y Visión -->
  <section class="container py-5">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title text-danger"><i class="fas fa-bullseye me-2"></i><b>Nuestra Misión</b></h5>
            <p class="card-text">
              “Nos dedicamos a ser la guía gastronómica definitiva de la región, brindando a turistas y locales la mejor experiencia culinaria de Chincha. A través de la difusión de contenido completo, detallado y real en plataformas dinámicas y accesibles, facilitamos el descubrimiento de sabores únicos y auténticos.”
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title text-danger"><i class="fas fa-eye me-2"></i><b>Nuestra Visión</b></h5>
            <p class="card-text">
              “Ser la referencia líder en guías gastronómicas de la región durante el presente año, como recurso indispensable para todos aquellos que desean explorar y disfrutar de las ofertas gastronómicas. Siendo reconocidos por nuestra calidad, integridad y pasión por la gastronomía, posicionando a Chincha como un destino gastronómico ideal.”
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Invitación a unirse -->
  <section class="bg-white py-5">
    <div class="container">
      <h3 class="text-center mb-4 fw-bold">¡Te invitamos a ser parte de nuestra revista digital <span class="text-danger">Ruta del Sabor</span>!</h3>
      <p class="text-center mb-5">Al unirte, disfrutarás de estos increíbles beneficios:</p>
      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 text-center shadow-sm border-0">
            <div class="card-body">
              <i class="fab fa-facebook-f fa-2x text-danger mb-3"></i>
              <h6 class="fw-bold">Alcance en redes sociales</h6>
              <p class="small">Potencia tu negocio en Facebook e Instagram.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 text-center shadow-sm border-0">
            <div class="card-body">
              <i class="fas fa-globe fa-2x text-danger mb-3"></i>
              <h6 class="fw-bold">Visibilidad en nuestra web</h6>
              <p class="small">Tendrás tu propio espacio destacado.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 text-center shadow-sm border-0">
            <div class="card-body">
              <i class="fas fa-bullhorn fa-2x text-danger mb-3"></i>
              <h6 class="fw-bold">Publicidad personalizada</h6>
              <p class="small">Contenido de apoyo hecho a tu medida.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 text-center shadow-sm border-0">
            <div class="card-body">
              <i class="fas fa-camera fa-2x text-danger mb-3"></i>
              <h6 class="fw-bold">Fotografías profesionales</h6>
              <p class="small">Imágenes de calidad para que tus productos brillen.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Información de contacto -->
  <section class="container py-5">
    <div class="row g-4 text-center">
      <div class="col-md-4">
        <i class="fas fa-phone fa-2x text-danger mb-2"></i>
        <h6 class="fw-bold">Teléfono</h6>
        <p>+51 983 488 541</p>
      </div>
      <div class="col-md-4">
        <i class="fas fa-envelope fa-2x text-danger mb-2"></i>
        <h6 class="fw-bold">Correo electrónico</h6>
        <p>rutadelsaborchincha@gmail.com</p>
      </div>
      <div class="col-md-4">
        <i class="fas fa-map-marker-alt fa-2x text-danger mb-2"></i>
        <h6 class="fw-bold">Ubicación</h6>
        <p>Av. Alva Maurtua #500, Chincha Alta</p>
      </div>
    </div>

    <div class="text-center mt-4">
      <p class="mb-1">¿Quieres aparecer en Ruta del Sabor?</p>
      <p>Escríbenos por correo o WhatsApp y consulta nuestros paquetes.</p>
    </div>
  </section>

  <!-- Llamado a la acción -->
  <section class="bg-success py-5 text-center text-white">
    <div class="container">
      <h3 class="fw-bold">Descubre tu próximo restaurante favorito 🍽️</h3>
      <p class="mb-3">Contáctanos al <strong>+51 983 488 541</strong> o por correo a <strong>quiqueronceros@gmail.com</strong></p>
    </div>
  </section>

  <!-- FOOTER -->
  <?= $footer; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
