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

    // Nuevo método para AJAX
    public function ajax()
    {
        $personaModel = new Personas();
        $accion = $this->request->getVar('accion');
        $respuesta = ['status' => 'error', 'mensaje' => 'Acción no definida'];

        if ($accion === 'registrar') {
            $foto = $this->request->getFile('foto');
            $rutaFoto = null;

            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $nuevoNombre = $foto->getRandomName();
                $foto->move('uploads/personas/', $nuevoNombre);
                $rutaFoto = 'uploads/personas/' . $nuevoNombre;
            }

            $registro = [
                'apellidos'  => $this->request->getVar('apellidos'),
                'nombres'    => $this->request->getVar('nombres'),
                'tipodoc'    => $this->request->getVar('tipodoc'),
                'numerodoc'  => $this->request->getVar('numerodoc'),
                'telefono'   => $this->request->getVar('telefono'),
                'foto'       => $rutaFoto
            ];

            $personaModel->insert($registro);
            $respuesta = ['status' => 'success', 'mensaje' => 'Persona registrada'];

        } elseif ($accion === 'actualizar') {
            $id = $this->request->getVar('idpersona');
            $persona = $personaModel->find($id);

            if (!$persona) {
                return $this->response->setJSON(['status' => 'error', 'mensaje' => 'Persona no existe']);
            }

            $foto = $this->request->getFile('foto');
            $rutaFoto = $persona['foto'];

            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                if (!empty($persona['foto']) && file_exists(FCPATH . $persona['foto'])) {
                    unlink(FCPATH . $persona['foto']);
                }

                $nuevoNombre = $foto->getRandomName();
                $foto->move('uploads/personas/', $nuevoNombre);
                $rutaFoto = 'uploads/personas/' . $nuevoNombre;
            }

            $datos = [
                'apellidos'  => $this->request->getVar('apellidos'),
                'nombres'    => $this->request->getVar('nombres'),
                'tipodoc'    => $this->request->getVar('tipodoc'),
                'numerodoc'  => $this->request->getVar('numerodoc'),
                'telefono'   => $this->request->getVar('telefono'),
                'foto'       => $rutaFoto
            ];

            $personaModel->update($id, $datos);
            $respuesta = ['status' => 'success', 'mensaje' => 'Persona actualizada'];

        } elseif ($accion === 'borrar') {
            $id = $this->request->getVar('idpersona');
            $persona = $personaModel->find($id);

            if ($persona) {
                if (!empty($persona['foto']) && file_exists(FCPATH . $persona['foto'])) {
                    unlink(FCPATH . $persona['foto']);
                }

                $personaModel->delete($id);
                $respuesta = ['status' => 'success', 'mensaje' => 'Persona eliminada'];
            } else {
                $respuesta = ['status' => 'error', 'mensaje' => 'Persona no existe'];
            }
        }

        return $this->response->setJSON($respuesta);
    }
}
