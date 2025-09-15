<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;
use App\Models\Personas;

class UsuarioController extends BaseController
{
public function index(): string
{
    $usuarioModel = new Usuario();

    $datos['usuarios'] = $usuarioModel
        ->select('usuarios.*, personas.nombres, personas.apellidos')
        ->join('personas', 'personas.idpersona = usuarios.idpersona')
        ->orderBy('usuarios.idusuario', 'ASC')
        ->findAll();

    $datos['header'] = view('admin/dashboard');

    return view('admin/recursos/Usuarios', $datos);
}


    public function create()
    {
        $personaModel = new Personas();
        $datos['personas'] = $personaModel->findAll();

        return view('admin/usuarios/Crear', $datos);
    }

    public function store()
    {
        $usuarioModel = new Usuario();

        $data = [
            'nombreusuario' => $this->request->getPost('nombreusuario'),
            'claveacceso'   => password_hash($this->request->getPost('claveacceso'), PASSWORD_DEFAULT),
            'nivelacceso'   => $this->request->getPost('nivelacceso'),
            'idpersona'     => $this->request->getPost('idpersona'),
        ];

        $usuarioModel->insert($data);

        return redirect()->to(base_url('usuarios'))->with('msg', 'Usuario creado correctamente');
    }

    public function edit($idusuario = null)
    {
        $usuarioModel = new Usuario();
        $personaModel = new Personas();

        $datos['usuario']  = $usuarioModel->find($idusuario);
        $datos['personas'] = $personaModel->findAll();

        return view('admin/usuarios/Editar', $datos);
    }

    public function update()
    {
        $usuarioModel = new Usuario();

        $idusuario = $this->request->getPost('idusuario');

        $data = [
            'nombreusuario' => $this->request->getPost('nombreusuario'),
            'nivelacceso'   => $this->request->getPost('nivelacceso'),
            'idpersona'     => $this->request->getPost('idpersona'),
        ];

        if ($this->request->getPost('claveacceso')) {
            $data['claveacceso'] = password_hash($this->request->getPost('claveacceso'), PASSWORD_DEFAULT);
        }

        $usuarioModel->update($idusuario, $data);

        return redirect()->to(base_url('usuarios'))->with('msg', 'Usuario actualizado correctamente');
    }

    public function delete($idusuario = null)
    {
        $usuarioModel = new Usuario();
        $usuarioModel->delete($idusuario);

        return redirect()->to(base_url('usuarios'))->with('msg', 'Usuario eliminado correctamente');
    }
}
