<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

class AdminLogin extends BaseController
{
    public function index()
    {
        // Solo admin y representante pueden acceder al login/dashboard
        $rol = session()->get('nivelacceso');

        if ($rol && $rol !== 'admin' && $rol !== 'representante') {
            return redirect()->to('/datos/dashboard')->with('error', 'No tienes permisos para acceder');
        }

        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        return view('admin/LoginAdmin', $datos);
    }

    public function loginPost()
    {
        $usuarioModel = new Usuario();

        $nombreusuario = $this->request->getPost('nombreusuario');
        $claveacceso   = $this->request->getPost('claveacceso');

        if (empty($nombreusuario) || empty($claveacceso)) {
            return redirect()->back()->with('error', 'Debe completar todos los campos');
        }

        // Traer usuario y persona
       $usuario = $usuarioModel
        ->select('usuarios.idusuario, usuarios.nombreusuario, usuarios.claveacceso, usuarios.nivelacceso, usuarios.idpersona, personas.nombres, personas.apellidos')
        ->join('personas', 'personas.idpersona = usuarios.idpersona')
        ->where('usuarios.nombreusuario', $nombreusuario)
        ->first();


        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no existe');
        }

        // Verificar contraseña
        if (!password_verify($claveacceso, $usuario['claveacceso'])) {
            return redirect()->back()->with('error', 'Contraseña incorrecta');
        }

     
        // Guardar datos de sesión
        session()->set([
            'idusuario'       => $usuario['idusuario'],
            'nombreusuario'   => $usuario['nombreusuario'],
            'nivelacceso'     => $usuario['nivelacceso'], 
            'idpersona'       => $usuario['idpersona'],
            'nombre_completo' => $usuario['nombres'] . ' ' . $usuario['apellidos'],
            'isLoggedIn'      => true,
        ]);

        return redirect()->to('/datos/dashboard')->with('success', 'Bienvenido ' . $usuario['nombres']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/index')->with('success', 'Sesión cerrada correctamente.');
    }
}
