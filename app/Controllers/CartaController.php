<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cartas;
use App\Models\Locales;
use App\Models\Secciones;

class CartaController extends BaseController
{
    public function index(): string
{
    $cartaModel   = new Cartas();
    $localModel   = new Locales();
    $seccionModel = new Secciones();

    // Obtener todas las cartas con los nombres de negocio, local y sección
    $datos['cartas'] = $cartaModel
        ->select('
            cartas.idcarta,
            cartas.idlocales,
            cartas.idseccion,
            cartas.nombreplato,
            cartas.precio,
            locales.direccion AS direccion_local,
            negocios.nombre AS nombre_negocio,
            secciones.seccion AS nombre_seccion
        ')
        ->join('locales', 'locales.idlocales = cartas.idlocales')
        ->join('negocios', 'negocios.idnegocio = locales.idnegocio')
        ->join('secciones', 'secciones.idseccion = cartas.idseccion')
        ->orderBy('cartas.idcarta', 'ASC')
        ->findAll();

    // Obtener locales y secciones para los select del formulario
  $datos['locales'] = $localModel
    ->select('locales.*, negocios.nombre AS nombre_negocio')
    ->join('negocios', 'negocios.idnegocio = locales.idnegocio')
    ->findAll();

    $datos['secciones'] = $seccionModel->findAll();

    // Header o layout
    $datos['header'] = view('admin/dashboard');

    return view('admin/recursos/Carta', $datos);
}
   public function ajax()
{
    $cartaModel = new Cartas();
    $accion = $this->request->getVar('accion');

    $respuesta = ['status' => 'error', 'message' => 'Acción no definida'];

    if(in_array($accion, ['registrar', 'actualizar'])) {

        $validationRules = [
            'idlocales'   => 'required|integer',
            'idseccion'   => 'required|integer',
            'nombreplato' => 'required|min_length[3]|max_length[255]',
            'precio'      => 'required|decimal',
        ];

        if (!$this->validate($validationRules)) {
            $respuesta = ['status' => 'error', 'message' => $this->validator->listErrors()];
            return $this->response->setJSON($respuesta);
        }

        $datos = [
            'idlocales'   => $this->request->getVar('idlocales'),
            'idseccion'   => $this->request->getVar('idseccion'),
            'nombreplato' => $this->request->getVar('nombreplato'),
            'precio'      => floatval($this->request->getVar('precio')),
        ];

        if ($accion === 'registrar') {
            $respuesta = $cartaModel->insert($datos)
                         ? ['status' => 'success', 'message' => 'Carta registrada exitosamente']
                         : ['status' => 'error', 'message' => 'Error al registrar la carta'];
        } elseif ($accion === 'actualizar') {
            $idcarta = $this->request->getVar('idcarta');
            $respuesta = $cartaModel->update($idcarta, $datos)
                         ? ['status' => 'success', 'message' => 'Carta actualizada exitosamente']
                         : ['status' => 'error', 'message' => 'Error al actualizar la carta'];
        }

    } elseif ($accion === 'eliminar') {
        $idcarta = $this->request->getVar('idcarta');
        $respuesta = $cartaModel->delete($idcarta)
                     ? ['status' => 'success', 'message' => 'Carta eliminada exitosamente']
                     : ['status' => 'error', 'message' => 'Error al eliminar la carta'];
    }

    return $this->response->setJSON($respuesta);
}
}
