<?= $header; ?>

<div class="container mt-5">
    <!-- Información general del restaurante -->
    <div class="row mb-4 align-items-center bg-light p-4 rounded shadow-sm">
        <div class="col-md-4 text-center mb-3 mb-md-0">
            <img src="<?= !empty($negocio['logo']) ? base_url($negocio['logo']) : base_url('assets/img/negocios/default.png') ?>" 
            class="img-fluid rounded shadow-sm bg-white" 
            alt="Logo de <?= esc($negocio['nombre']) ?>" 
            style="max-height:350px; width:100%; object-fit:contain; padding:10px;">


        </div>
        <div class="col-md-8">
            <h1 class="fw-bold text-danger"><?= esc($negocio['nombre']) ?></h1>
            <?php if(!empty($negocio['slogan'])): ?>
                <p class="text-muted fs-5"><?= esc($negocio['slogan']) ?></p>
            <?php endif; ?>
            <p><strong>Categoría:</strong> <?= esc($negocio['categoria']) ?></p>
           <!--<p><strong>Representante:</strong>' . esc($negocio['nombres'] . ' ' . $negocio['apellidos']) . '</p>';-->
            <?php if(!empty($negocio['direccion'])): ?>
                <p><strong>Dirección:</strong> <?= esc($negocio['direccion']) ?></p>
            <?php endif; ?>
            <?php if(!empty($negocio['telefono'])): ?>
                <p><strong>Teléfono:</strong> <a href="tel:<?= esc($negocio['telefono']) ?>" class="text-decoration-none"><?= esc($negocio['telefono']) ?></a></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Mapa -->
    <?php if(!empty($negocio['latitud']) && !empty($negocio['longitud'])): ?>
        <div class="my-4">
            <h4 class="text-danger mb-3">Ubicación</h4>
            <div id="map" style="width:100%; height:350px; border-radius:8px;"></div>
        </div>
    <?php endif; ?>

 <!-- Platos -->
<!-- Platos -->
<h2 class="text-danger mb-3">Platos</h2>
<?php if(!empty($negocio['cartas'])): ?>
    <div class="row g-3">
        <?php foreach($negocio['cartas'] as $plato): ?>
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm">
                    
                    <!-- Imagen dentro de un ratio fijo -->
                    <div class="ratio ratio-4x3">
                        <img src="<?= !empty($plato['foto']) ? base_url($plato['foto']) : base_url('assets/img/platos/default.png') ?>" 
                             class="w-90 h-100 rounded-top" 
                             alt="<?= esc($plato['nombreplato']) ?>" 
                             style="object-fit: cover;">
                    </div>

                    <!-- Contenido del card -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= esc($plato['nombreplato']) ?></h5>
                        <?php if(!empty($plato['descripcion'])): ?>
                            <p class="card-text text-muted small"><?= esc($plato['descripcion']) ?></p>
                        <?php endif; ?>
                        <div class="mt-auto">
                            <span class="badge bg-danger fs-6">
                                $<?= number_format($plato['precio'], 2) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="text-muted">No hay platos disponibles</p>
<?php endif; ?>


</div>

<?php if(!empty($negocio['latitud']) && !empty($negocio['longitud'])): ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([<?= esc($negocio['latitud']) ?>, <?= esc($negocio['longitud']) ?>], 16);

    // Mapa base OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Marcador del restaurante
    L.marker([<?= esc($negocio['latitud']) ?>, <?= esc($negocio['longitud']) ?>])
        .addTo(map)
        .bindPopup("<b><?= esc($negocio['nombre']) ?></b>")
        .openPopup();
</script>
<?php endif; ?>

<br>
<br>
<br>
<br>

<?= $footer; ?>
