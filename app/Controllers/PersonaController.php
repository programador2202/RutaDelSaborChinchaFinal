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

    public function registrar()
    {
        $personaModel = new Personas();

        $registro = [
            'apellidos'  => $this->request->getVar('apellidos'),
            'nombres'    => $this->request->getVar('nombres'),
            'tipodoc'    => $this->request->getVar('tipodoc'),
            'numerodoc'  => $this->request->getVar('numerodoc'),
            'telefono'   => $this->request->getVar('telefono'),
        ];

        $personaModel->insert($registro);

        return redirect()->to(base_url('admin/personas/'))
                         ->with('mensaje', 'registrado');
    }

    public function actualizar()
    {
        $personaModel = new Personas();

        $id = $this->request->getVar('idpersona');
        $datos = [
            'apellidos'  => $this->request->getVar('apellidos'),
            'nombres'    => $this->request->getVar('nombres'),
            'tipodoc'    => $this->request->getVar('tipodoc'),
            'numerodoc'  => $this->request->getVar('numerodoc'),
            'telefono'   => $this->request->getVar('telefono'),
        ];

        $personaModel->update($id, $datos);

        return redirect()->to(base_url('admin/personas/'))
                         ->with('mensaje', 'editado');
    }

    public function borrar($id = null)
    {
        $personaModel = new Personas();

        if ($personaModel->find($id)) {
            $personaModel->delete($id);
            return redirect()->to(base_url('admin/personas'))
                             ->with('mensaje', 'eliminado');
        }

        return redirect()->to(base_url('admin/personas'))
                         ->with('mensaje', 'no_existe');
    }
}
