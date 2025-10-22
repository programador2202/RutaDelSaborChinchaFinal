<?= $header ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

<style>
.card-custom {
  border: none;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.08);
}
.card-header {
  background: linear-gradient(45deg, #0d6efd, #0a58ca);
  color: #fff;
  border-radius: 12px 12px 0 0;
  padding: 15px 20px;
}
.table thead th {
  background: #f1f3f5;
  text-align: center;
  font-weight: 600;
}
.table-hover tbody tr:hover { background-color: #f8f9fa; }
.badge-pendiente { background-color: #ffc107; color: #000; }
.badge-confirmado { background-color: #28a745; }
.badge-cancelado { background-color: #dc3545; }
.btn-action { border-radius: 50px; padding: 6px 10px; margin: 0 2px; font-size: 14px; }
</style>

<div class="container mt-4">
  <div class="card card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-calendar2-check me-2"></i> Gestión de Reservas</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Solicitante</th>
              <th>Local</th>
              <th>Horario</th>
              <th>Fecha</th>
              <th>Telefono</th>
              <th>Personas</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($reservas)): ?>
              <?php foreach ($reservas as $r): ?>
                <tr>
                  <td><?= esc($r['idreserva']) ?></td>
                  <td><?= esc($r['solicitante']) ?></td>
                  <td><?= esc($r['nombre_local']) ?></td>
                  <td><?= esc($r['telefono_solicitante']) ?></td>
                  <td><?= esc($r['horario']) ?></td>
                  <td><?= date('d/m/Y H:i', strtotime($r['fechahora'])) ?></td>
                  <td><?= esc($r['cantidadpersonas']) ?></td>
                  <td>
                    <span class="badge 
                      <?= $r['confirmacion'] === 'pendiente' ? 'badge-pendiente' :
                          ($r['confirmacion'] === 'confirmado' ? 'badge-confirmado' : 'badge-cancelado') ?>">
                      <?= ucfirst($r['confirmacion']) ?>
                    </span>
                  </td>
                  <td>
                    <?php if ($r['confirmacion'] === 'pendiente'): ?>
                      <button class="btn btn-success btn-sm btn-action btn-estado" 
                              data-id="<?= $r['idreserva'] ?>" 
                              data-estado="confirmado" title="Confirmar">
                        <i class="bi bi-check2-circle"></i>
                      </button>
                      <button class="btn btn-danger btn-sm btn-action btn-estado" 
                              data-id="<?= $r['idreserva'] ?>" 
                              data-estado="cancelado" title="Cancelar">
                        <i class="bi bi-x-circle"></i>
                      </button>
                    <?php elseif ($r['confirmacion'] === 'confirmado'): ?>
                      <button class="btn btn-danger btn-sm btn-action btn-estado" 
                              data-id="<?= $r['idreserva'] ?>" 
                              data-estado="cancelado" title="Cancelar">
                        <i class="bi bi-x-circle"></i>
                      </button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8" class="text-muted text-center">No hay reservas registradas.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const AJAX_URL = "<?= base_url('ajax') ?>";

  const showAlert = (icon, title, timer = 1500) =>
    Swal.fire({ icon, title, timer, showConfirmButton: false, timerProgressBar: true });

  const sendRequest = async (formData) => {
    try {
      const res = await fetch(AJAX_URL, { method: 'POST', body: formData });
      return await res.json();
    } catch (err) {
      console.error('Error:', err);
      showAlert('error', 'Error de conexión');
      return null;
    }
  };

  // Cambiar estado (confirmar o cancelar)
  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.btn-estado');
    if (!btn) return;

    const estado = btn.dataset.estado;
    const id = btn.dataset.id;

    const confirm = await Swal.fire({
      title: `¿Desea marcar esta reserva como "${estado}"?`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí, cambiar',
      cancelButtonText: 'Cancelar'
    });

    if (!confirm.isConfirmed) return;

    const fd = new FormData();
    fd.append('accion', 'cambiar_estado');
    fd.append('idreserva', id);
    fd.append('estado', estado);

    Swal.fire({ title: 'Actualizando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    const data = await sendRequest(fd);
    Swal.close();

    if (data) {
      showAlert(data.status === 'success' ? 'success' : 'error', data.mensaje)
        .then(() => { if (data.status === 'success') location.reload(); });
    }
  });
});
</script>


