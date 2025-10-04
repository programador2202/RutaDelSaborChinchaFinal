<?php if (!empty($resultados)): ?>
    <ul class="list-group">
        <?php foreach ($resultados as $row): ?>
            <li class="list-group-item d-flex align-items-stretch mb-2">

                <div class="me-3" style="width: 100px; height: 100px; flex-shrink: 0;">
                    <img src="<?= !empty($row['foto']) ? base_url($row['foto']) : base_url('uploads/cartas/default.png'); ?>" 
                         alt="<?= esc($row['plato'] ?? $row['negocio']); ?>" 
                         class="rounded w-100 h-100" style="object-fit: cover;">
                </div>

                <div class="d-flex flex-column justify-content-between">
                    <div>
                        <b class="fs-5"><?= esc($row['negocio']); ?></b><br>
                        <?php if (!empty($row['plato'])): ?>
                            <span class="text-dark fw-semibold"><?= esc($row['plato']); ?></span><br>
                            <span class="text-success fw-bold">S/ <?= number_format($row['precio'], 2); ?></span><br>
                        <?php else: ?>
                            <span class="text-muted">Sin platos registrados</span><br>
                        <?php endif; ?>
                        <small class="text-secondary">📍 <?= esc($row['direccion']); ?></small><br>
                    </div>
                    

                    <!-- Botón correcto -->
                    <button class="btn btn-sm btn-success mt-2 align-self-start"
                        onclick='agregarAlCarrito({
                            nombre: "<?= esc($row['plato'] ?? $row['negocio']); ?>",
                            precio: <?= esc($row['precio'] ?? 0); ?>,
                            cantidad: 1
                        })'>
                        <i class="fas fa-cart-plus"></i> Reservar
                    </button>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No se encontraron resultados para <b><?= esc($q); ?></b></p>

    <?php if (!empty($recomendaciones)): ?>
        <div class="alert alert-info">Te recomendamos estos platos de otros restaurantes:</div>
        <ul class="list-group">
            <?php foreach ($recomendaciones as $rec): ?>
                <li class="list-group-item d-flex align-items-stretch mb-2">
                    <div class="me-3" style="width: 100px; height: 100px; flex-shrink: 0;">
                        <img src="<?= !empty($rec['foto']) ? base_url($rec['foto']) : base_url('uploads/cartas/default.png'); ?>" 
                             alt="<?= esc($rec['plato'] ?? $rec['negocio']); ?>" 
                             class="rounded w-100 h-100" style="object-fit: cover;">
                    </div>
                    <div class="d-flex flex-column justify-content-between">
                        <div>
                            <b class="fs-5"><?= esc($rec['plato'] ?? $rec['negocio']); ?></b><br>
                            <small class="text-muted"><?= esc($rec['negocio']); ?></small><br>
                            <span class="text-success">S/ <?= number_format($rec['precio'], 2); ?></span>
                        </div>
                        <button class="btn btn-sm btn-success mt-2 align-self-start"
                            onclick='agregarAlCarrito({
                                nombre: "<?= esc($rec['plato'] ?? $rec['negocio']); ?>",
                                precio: <?= esc($rec['precio'] ?? 0); ?>,
                                cantidad: 1
                            })'>
                            <i class="fas fa-cart-plus"></i> Reservar
                        </button>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endif; ?>
