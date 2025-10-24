<?= $header; ?>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
.hover-scale:hover { transform: scale(1.02); transition: 0.3s; }
.rating { direction: rtl; display: inline-flex; }
.rating input { display: none; }
.rating label { font-size: 2rem; color: #ccc; cursor: pointer; }
.rating input:checked ~ label,
.rating label:hover,
.rating label:hover ~ label { color: gold; }

/* Estilo de comentarios (tipo Google Play) */
.list-group-item {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    background-color: #fff;
}
.list-group-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
}
.text-warning.small {
    font-size: 1.1rem;
    letter-spacing: 1px;
}


</style>

<div class="container mt-5">

    <!-- Información del negocio -->
    <div class="card shadow-lg border-0 mb-5">
        <div class="row g-0 align-items-center">
            <div class="col-md-4 text-center bg-light p-4">
                <img src="<?= !empty($negocio['logo']) ? base_url($negocio['logo']) : base_url('assets/img/negocios/default.png') ?>" 
                     class="img-fluid rounded-3 shadow-sm" 
                     alt="Logo de <?= esc($negocio['nombre']) ?>" 
                     style="max-height:220px; object-fit:contain;">
            </div>
            <div class="col-md-8 p-4">
                <h1 class="fw-bold text-danger mb-2"><?= esc($negocio['nombre']) ?></h1>
                <?php if (!empty($negocio['slogan'])): ?>
                    <p class="text-secondary fst-italic"><?= esc($negocio['slogan']) ?></p>
                <?php endif; ?>

                <div class="mt-3">
                    <p><i class="bi bi-tag-fill text-danger"></i> <strong>Categoría:</strong> <?= esc($negocio['categoria']) ?></p>
                    <?php if (!empty($negocio['direccion'])): ?>
                        <p><i class="bi bi-geo-alt-fill text-danger"></i> <strong>Dirección:</strong> <?= esc($negocio['direccion']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($negocio['telefono'])): ?>
                        <p><i class="bi bi-telephone-fill text-danger"></i>
                            <a href="tel:<?= esc($negocio['telefono']) ?>" class="text-decoration-none">
                                <?= esc($negocio['telefono']) ?>
                            </a>
                        </p>
                    <?php endif; ?>
                    <p><i class="bi bi-clock-fill text-danger"></i>
                        <strong>Estado:</strong>
                        <span class="<?= $negocio['estado'] == 'Abierto' ? 'text-success' : 'text-secondary' ?>">
                            <?= esc($negocio['estado']) ?>
                        </span>
                    </p>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Mapa -->
    <?php if (!empty($negocio['latitud']) && !empty($negocio['longitud'])): ?>
        <div class="card border-0 shadow-sm mb-5">
            <div class="card-header bg-danger text-white fw-bold">Ubicación</div>
            <div class="card-body p-0">
                <div id="map" style="width:100%; height:350px; border-radius:0 0 12px 12px;"></div>
            </div>
        </div>
    <?php endif; ?>



       <!-- CARTA AGRUPADA POR SECCIONES -->
    <h2 class="fw-bold text-danger mb-4">Nuestra Carta</h2>

    <?php if (!empty($negocio['cartas'])): ?>
        <?php
        // Agrupar platos por sección
        $cartasPorSeccion = [];
        foreach ($negocio['cartas'] as $plato) {
            $cartasPorSeccion[$plato['nombre_seccion']][] = $plato;
        }
        ?>

        <?php foreach ($cartasPorSeccion as $nombreSeccion => $platos): ?>
            <!-- Título de sección -->
            <h3 class="mt-5 mb-3 text-danger fw-bold border-bottom border-2 pb-2">
                <?= esc($nombreSeccion) ?>
            </h3>

            <!-- Grid de platos -->
            <div class="row g-4">
                <?php foreach ($platos as $plato): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="card h-100 border-0 shadow-sm hover-scale">
                            <!-- Imagen del plato -->
                            <img src="<?= !empty($plato['foto']) 
                                ? base_url($plato['foto']) 
                                : base_url('assets/img/platos/default.png') ?>" 
                                class="card-img-top rounded-top" 
                                alt="<?= esc($plato['nombreplato']) ?>" 
                                style="height: 280px; object-fit: cover;">

                            <!-- Contenido -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-dark fw-semibold mb-2">
                                    <?= esc($plato['nombreplato']) ?>
                                </h5>
                                <?php if (!empty($plato['descripcion'])): ?>
                                    <p class="card-text text-muted small mb-3">
                                        <?= esc($plato['descripcion']) ?>
                                    </p>
                                <?php endif; ?>

                                <!-- Precio y botón -->
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-danger fs-6">
                                        S/<?= number_format($plato['precio'], 2) ?>
                                    </span>
                                    <button class="btn btn-outline-success btn-sm rounded-pill px-3"
                                            onclick='agregarAlCarrito({
                                                nombre: "<?= esc($plato['nombreplato']) ?>",
                                                precio: <?= esc($plato['precio']) ?>,
                                                cantidad: 1
                                            })'>
                                        <i class="fas fa-cart-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">No hay platos disponibles</p>
    <?php endif; ?>


    <!--COMENTARIOS -->

    <hr class="my-5">
    <div class="mb-5">
        <h3 class="fw-bold text-danger mb-3">Opiniones de clientes</h3>

        <?php if (isset($promedio) && $promedio > 0): ?>
            <div class="text-center mb-4">
                <h2 class="fw-bold"><?= number_format($promedio, 1) ?>/5</h2>
                <div class="text-warning fs-4">
                    <?= str_repeat('★', round($promedio)) . str_repeat('☆', 5 - round($promedio)) ?>
                </div>
                <small class="text-muted">(<?= count($comentarios) ?> opiniones)</small>
            </div>
        <?php endif; ?>
        
        <!-- Formulario de comentario -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form id="formComentario" method="post" action="<?= base_url('comentarios/guardar') ?>">
                    <input type="hidden" name="idlocales" value="<?= $negocio['idlocales'] ?>">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tu valoración</label>
                        <div class="rating">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio" name="valoracion" value="<?= $i ?>" id="star<?= $i ?>">
                                <label for="star<?= $i ?>">★</label>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <textarea name="comentario" class="form-control rounded-3 shadow-sm" rows="3" placeholder="Escribe tu opinión..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                        <i class="fas fa-paper-plane"></i> Publicar
                    </button>
                </form>
            </div>
        </div>

        <!-- Listado de comentarios -->
        <?php if (!empty($comentarios)): ?>
            <div class="list-group">
                <?php foreach ($comentarios as $c): ?>
                    <div class="list-group-item border-0 shadow-sm mb-3 rounded-4 p-4">
                        <div class="d-flex align-items-start">
                            <img src="<?= base_url('/img/inicioSesion.png') ?>"
                                 class="rounded-circle me-3 border"
                                 width="55" height="55"
                                 alt="avatar">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="fw-bold mb-0 text-dark">
                                            <?= esc($c['nombre'] ?? 'Usuario') . ' ' . esc($c['apellido'] ?? '') ?>
                                        </h6>
                                    <small class="text-muted">
                                        <?= date('d/m/Y', strtotime($c['fechahora'])) ?>
                                    </small>
                                </div>

                                <div class="text-warning small mb-1">
                                    <?= str_repeat('★', $c['valoracion']) . str_repeat('☆', 5 - $c['valoracion']) ?>
                                </div>

                                <p class="mb-0 text-secondary" style="font-size: 0.95rem;">
                                    <?= esc($c['comentario']) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center text-muted py-4">
                <i class="bi bi-chat-left-text fs-2"></i>
                <p class="mt-2">Aún no hay opiniones. ¡Sé el primero en opinar!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Mapa con Leaflet -->
<?php if (!empty($negocio['latitud']) && !empty($negocio['longitud'])): ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([<?= esc($negocio['latitud']) ?>, <?= esc($negocio['longitud']) ?>], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        L.marker([<?= esc($negocio['latitud']) ?>, <?= esc($negocio['longitud']) ?>])
            .addTo(map)
            .bindPopup("<b><?= esc($negocio['nombre']) ?></b>")
            .openPopup();
    </script>
<?php endif; ?>

<br><br>
<?= $dinamica; ?>

<script>
  window.isLoggedIn = <?= session()->get('logged_in') ? 'true' : 'false' ?>;
  window.loginUrl = "<?= base_url('login') ?>";
</script>

<script src="<?= base_url('assets/js/global.js') ?>"></script>
<?= $footer; ?>

<!-- ✅ Agregar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '<?= esc(session()->getFlashdata('success')) ?>',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    </script>
<?php elseif (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '<?= esc(session()->getFlashdata('error')) ?>',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    </script>
<?php endif; ?>
