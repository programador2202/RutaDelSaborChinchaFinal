<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

class AdminLogin extends BaseController
{
    public function index()
    {
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        return view('admin/LoginAdmin', $datos);
    }

   public function loginPost()
{
    $usuarioModel = new Usuario();

    $nombreusuario = $this->request->getPost('nombreusuario');
    $claveacceso = $this->request->getPost('claveacceso');

    if (empty($nombreusuario) || empty($claveacceso)) {
        return redirect()->back()->with('error', 'Debe completar todos los campos');
    }

    // Usamos join para traer también nombres y apellidos desde personas
    $usuario = $usuarioModel
        ->select('usuarios.*, personas.nombres, personas.apellidos')
        ->join('personas', 'personas.idpersona = usuarios.idpersona')
        ->where('usuarios.nombreusuario', $nombreusuario)
        ->first();

    if (!$usuario) {
        return redirect()->back()->with('error', 'Usuario no existe');
    }

    if ($usuario['claveacceso'] !== $claveacceso) {
        return redirect()->back()->with('error', 'Contraseña incorrecta');
    }

    // Guardamos también el nombre completo en sesión
    session()->set([
        'idusuario' => $usuario['idusuario'],
        'nombreusuario' => $usuario['nombreusuario'],
        'nivelacceso' => $usuario['nivelacceso'],
        'idpersona' => $usuario['idpersona'],
        'nombre_completo' => $usuario['nombres'] . ' ' . $usuario['apellidos'],
        'isLoggedIn' => true,
    ]);

    return redirect()->to('/datos/dashboard')->with('success', 'Bienvenido ' . $usuario['nombres']);
}


}
