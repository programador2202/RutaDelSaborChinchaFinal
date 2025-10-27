<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReservasPlatos;
use App\Models\Cartas;
use App\Models\Reservas;

class ReservasPlatosController extends BaseController
{
    /**
     * Lista los platos confirmados (solo lectura)
     */
    public function index(): string
    {
        $reservasPlatosModel = new ReservasPlatos();

        $datos['platos_confirmados'] = $reservasPlatosModel->obtenerPlatosConfirmados();
        $datos['header'] = view('admin/dashboard');

        return view('admin/recursos/PlatosReservados', $datos);
    }

    /**
     * Muestra la vista para agregar platos a una reserva
     */
    public function agregar($idreserva = null, $idlocal = null)
    {
        if (!$idreserva || !$idlocal) {
            return redirect()->to('/')->with('error', 'Datos incompletos para agregar platos.');
        }

        $cartasModel   = new Cartas();
        $reservaModel  = new Reservas();

        // Obtener datos de la reserva
        $reserva = $reservaModel->find($idreserva);
        if (!$reserva) {
            return redirect()->to('/')->with('error', 'La reserva no existe.');
        }

        // Obtener todos los platos disponibles del local
       $platos = $cartasModel
            ->where('idlocales', $idlocal)
            ->findAll();

        $datos = [
            'reserva'   => $reserva,
            'platos'    => $platos,
            'idreserva' => $idreserva,
            'idlocal'   => $idlocal,
        ];

        return view('PaginaPrincipal/AgregarPlatosReserva', $datos);
    }

    /**
     * Guarda los platos seleccionados para una reserva
     */
 public function guardar()
{
    $reservasPlatosModel = new ReservasPlatos();

    $idreserva     = $this->request->getVar('idreserva');
    $platos        = $this->request->getVar('platos'); // array de idcarta
    $cantidades    = $this->request->getVar('cantidades'); // array con cantidades
    $observaciones = $this->request->getVar('observaciones'); // array opcional

    // ✅ Validar que exista una reserva y al menos un plato
    if (empty($idreserva) || !is_array($platos) || count($platos) === 0) {
        return $this->response->setJSON([
            'status'  => 'error',
            'mensaje' => 'Debe seleccionar al menos un plato para registrar el pedido.'
        ]);
    }

    try {
        // 🔄 Guardar los platos seleccionados
        foreach ($platos as $index => $idcarta) {
            $data = [
                'idreserva'   => $idreserva,
                'idcarta'     => $idcarta,
                'cantidad'    => isset($cantidades[$index]) ? (int)$cantidades[$index] : 1,
                'observacion' => $observaciones[$index] ?? '',
            ];
            $reservasPlatosModel->insert($data);
        }

        // ✅ Respuesta tipo JSON para mostrar mensaje sin redirección
        return $this->response->setJSON([
            'status'  => 'success',
            'mensaje' => '✅ Pedido registrado. En un momento se comunicarán para confirmar su pedido. ¡Gracias por su comprensión!'
        ]);

    } catch (\Exception $e) {
        // ⚠️ En caso de error inesperado
        return $this->response->setJSON([
            'status'  => 'error',
            'mensaje' => 'Ocurrió un error al registrar el pedido: ' . $e->getMessage(),
        ]);
    }
}

}