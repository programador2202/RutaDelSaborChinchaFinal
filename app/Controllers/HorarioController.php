<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Horario;
use App\Models\Locales;
use Locale;

class HorarioController extends BaseController
    {
public function index()
{
    $model = new Horario();
    $modelLocales = new Locales();

    $data['horarios'] = $model
        ->select('horarios.*, locales.direccion, locales.telefono, negocios.nombre AS negocio, negocios.nombrecomercial AS nombre_local')
        ->join('locales', 'locales.idlocales = horarios.idlocales')
        ->join('negocios', 'negocios.idnegocio = locales.idnegocio')
        ->orderBy('horarios.diasemana', 'ASC')
        ->findAll();

    // Consulta todos los locales y negocios para el select
    $data['locales'] = $modelLocales
        ->select('locales.*, negocios.nombre AS negocio')
        ->join('negocios', 'negocios.idnegocio = locales.idnegocio')
        ->findAll();

    $data['header'] = view('admin/dashboard');
    return view('admin/recursos/Horario', $data);
}


public function ajax(){

    $model = new Horario();

    $accion = $this->request->getVar('accion');
    $respuesta = ['status' => 'error', 'mensaje' => 'Acción no definida'];

    if($accion ==='registrar'){
        $registro = [
            'idlocales' => $this->request->getVar('idlocales'),
            'diasemana' => $this->request->getVar('diasemana'),
            'inicio'    => $this->request->getVar('inicio'),
            'fin'       => $this->request->getVar('fin'),
        ];

        $model->insert($registro);
        $respuesta = ['status' => 'success', 'mensaje' => 'Horario registrado correctamente'];

    } elseif($accion === 'actualizar'){
        $id = $this->request->getVar('idhorario');
        $horario = $model->find($id);

        if(!$horario){
            return $this->response->setJSON([
                'status' => 'error',
                'mensaje' => 'Horario no existe'
            ]);
        }

        $actualizacion = [
            'idlocales' => $this->request->getVar('idlocales'),
            'diasemana' => $this->request->getVar('diasemana'),
            'inicio'    => $this->request->getVar('inicio'),
            'fin'       => $this->request->getVar('fin'),
        ];

        $model->update($id, $actualizacion);
        $respuesta = ['status' => 'success', 'mensaje' => 'Horario actualizado correctamente'];

    } elseif($accion === 'eliminar'){
        $id = $this->request->getVar('idhorario');
        $horario = $model->find($id);

        if(!$horario){
            return $this->response->setJSON([
                'status' => 'error',
                'mensaje' => 'Horario no existe'
            ]);
        }

        $model->delete($id);
        $respuesta = ['status' => 'success', 'mensaje' => 'Horario eliminado correctamente'];
    }
    return $this->response->setJSON($respuesta);   
    }
    
}