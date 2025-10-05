<?php

namespace App\Controllers;
use App\Models\Contrato;
use App\Models\Negocio;
use App\Models\Usuario;

class ContratoController extends BaseController
{
   public function index()
{
    $contratoModel = new Contrato();
    $usuarioModel = new Usuario();
    $negocioModel = new Negocio();

  // Obtener contratos con nombres de usuario y negocio
        $contratos = $contratoModel
    ->select('
        contratos.*, 
        CONCAT(personas.nombres, " ", personas.apellidos) AS usuario, 
        negocios.nombre AS negocio
    ')
    ->join('usuarios', 'usuarios.idusuario = contratos.idusuario', 'left')
    ->join('personas', 'personas.idpersona = usuarios.idpersona', 'left')
    ->join('negocios', 'negocios.idnegocio = contratos.idnegocio', 'left')
    ->findAll();


    $data = [
        'contratos' => $contratos,
        'usuarios' => $usuarioModel ->findAll(),
        'negocios' => $negocioModel ->findAll(),
        'header' => view('admin/dashboard')
    ];

    return view('admin/recursos/Contrato', $data);
}
    public function ajax()
    {
        $contratoModel = new Contrato();
        $accion = $this->request->getVar('accion');

        $respuesta = ['status' => 'error', 'message' => 'Acción no definida'];

        if (in_array($accion, ['registrar', 'actualizar'])) {
            // Validación
            $validationRules = [
                'idusuario'   => 'required|integer',
                'idnegocio'   => 'required|integer',
                'fechainicio' => 'required|valid_date',
                'fechafin'    => 'required|valid_date',
                'inversion'   => 'required|decimal'
            ];

            if (!$this->validate($validationRules)) {
                $respuesta = [
                    'status'  => 'error',
                    'message' => $this->validator->listErrors()
                ];
                return $this->response->setJSON($respuesta);
            }

            // Datos del contrato
            $datos = [
                'idusuario'   => $this->request->getVar('idusuario'),
                'idnegocio'   => $this->request->getVar('idnegocio'),
                'fechainicio' => $this->request->getVar('fechainicio'),
                'fechafin'    => $this->request->getVar('fechafin'),
                'inversion'   => floatval($this->request->getVar('inversion'))
            ];

            // Registrar
            if ($accion === 'registrar') {
                $respuesta = $contratoModel->insert($datos)
                    ? ['status' => 'success', 'message' => 'Contrato registrado correctamente']
                    : ['status' => 'error', 'message' => 'Error al registrar el contrato'];
            }

            // Actualizar
            if ($accion === 'actualizar') {
                $id = $this->request->getVar('idcontrato');
                $respuesta = $contratoModel->update($id, $datos)
                    ? ['status' => 'success', 'message' => 'Contrato actualizado correctamente']
                    : ['status' => 'error', 'message' => 'Error al actualizar el contrato'];
            }
        }

        // Eliminar
        elseif ($accion === 'eliminar') {
            $id = $this->request->getVar('idcontrato');
            $respuesta = $contratoModel->delete($id)
                ? ['status' => 'success', 'message' => 'Contrato eliminado correctamente']
                : ['status' => 'error', 'message' => 'Error al eliminar el contrato'];
        }

        // Obtener contrato por ID (para editar)
        elseif ($accion === 'obtener') {
            $id = $this->request->getVar('idcontrato');
            $contrato = $contratoModel->find($id);

            $respuesta = $contrato
                ? ['status' => 'success', 'data' => $contrato]
                : ['status' => 'error', 'message' => 'Contrato no encontrado'];
        }

        return $this->response->setJSON($respuesta);
    }
}


