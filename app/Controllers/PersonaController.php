<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Personas;

class PersonaController extends BaseController
{
    public function index(): string
    {
        $personaModel = new Personas();

        $datos['personas'] = $personaModel->orderBy('idpersona', 'ASC')->findAll();
        $datos['header']   = view('admin/dashboard');

        return view('admin/recursos/Personas', $datos);
    }

    // Método para AJAX
    public function ajax()
    {
        $personaModel = new Personas();
        $accion       = $this->request->getVar('accion');
        $respuesta    = ['status' => 'error', 'mensaje' => 'Acción no definida'];

        if ($accion === 'registrar') {
            $registro = [
                'apellidos' => $this->request->getVar('apellidos'),
                'nombres'   => $this->request->getVar('nombres'),
                'tipodoc'   => $this->request->getVar('tipodoc'),
                'numerodoc' => $this->request->getVar('numerodoc'),
                'telefono'  => $this->request->getVar('telefono'),
            ];

            $personaModel->insert($registro);
            $respuesta = ['status' => 'success', 'mensaje' => 'Persona registrada correctamente'];

        } elseif ($accion === 'actualizar') {
            $id = $this->request->getVar('idpersona');
            $persona = $personaModel->find($id);

            if (!$persona) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'mensaje' => 'Persona no existe'
                ]);
            }

            $datos = [
                'apellidos' => $this->request->getVar('apellidos'),
                'nombres'   => $this->request->getVar('nombres'),
                'tipodoc'   => $this->request->getVar('tipodoc'),
                'numerodoc' => $this->request->getVar('numerodoc'),
                'telefono'  => $this->request->getVar('telefono'),
            ];

            $personaModel->update($id, $datos);
            $respuesta = ['status' => 'success', 'mensaje' => 'Persona actualizada correctamente'];

        } elseif ($accion === 'borrar') {
            $id = $this->request->getVar('idpersona');
            $persona = $personaModel->find($id);

            if ($persona) {
                try {
                    $personaModel->delete($id);
                    $respuesta = [
                        'status'  => 'success',
                        'mensaje' => 'Persona eliminada correctamente'
                    ];
                } catch (\Exception $e) {
                    if (strpos($e->getMessage(), '1451') !== false) {
                        $respuesta = [
                            'status'  => 'error',
                            'mensaje' => 'No se puede eliminar la persona porque está relacionada con otros registros'
                        ];
                    } else {
                        $respuesta = [
                            'status'  => 'error',
                            'mensaje' => 'Ocurrió un error al intentar eliminar la persona'
                        ];
                    }
                }
            } else {
                $respuesta = ['status' => 'error', 'mensaje' => 'Persona no existe'];
            }
        }

        return $this->response->setJSON($respuesta);
    }
}
