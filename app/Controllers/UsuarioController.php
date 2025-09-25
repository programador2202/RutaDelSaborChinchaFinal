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
    $personaModel = new Personas();

    $datos['usuarios'] = $usuarioModel
        ->select('usuarios.*, personas.nombres, personas.apellidos')
        ->join('personas', 'personas.idpersona = usuarios.idpersona')
        ->orderBy('usuarios.idusuario', 'ASC')
        ->findAll();

    $datos['personas'] = $personaModel->findAll(); 
    $datos['header'] = view('admin/dashboard');

    return view('admin/recursos/Usuarios', $datos);
}



  
   public function ajax()
{
    $usuarioModel = new Usuario();
    $accion = $this->request->getVar('accion');
    $respuesta = ['status' => 'error', 'mensaje' => 'Acción no definida'];

    if ($accion === 'registrar') {
        $registro = [
            'nombreusuario' => $this->request->getVar('nombreusuario'),
            'claveacceso'   => $this->request->getVar('claveacceso'),
            'nivelacceso'   => $this->request->getVar('nivelacceso'),
            'idpersona'     => $this->request->getVar('idpersona')
        ];

        $usuarioModel->insert($registro);
        $respuesta = ['status' => 'success', 'mensaje' => 'Usuario registrado correctamente'];

    } elseif ($accion === 'actualizar') {
        $id = $this->request->getVar('idusuario');
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return $this->response->setJSON(['status'=>'error','mensaje'=>'Usuario no existe']);
        }

        $datos = [
            'nombreusuario' => $this->request->getVar('nombreusuario'),
            'claveacceso'   => $this->request->getVar('claveacceso'),
            'nivelacceso'   => $this->request->getVar('nivelacceso'),
            'idpersona'     => $this->request->getVar('idpersona')
        ];

        $usuarioModel->update($id, $datos);
        $respuesta = ['status'=>'success','mensaje'=>'Usuario actualizado correctamente'];

    } elseif ($accion === 'borrar') {
        $id = $this->request->getVar('idusuario');
        $usuario = $usuarioModel->find($id);

        if ($usuario) {
            $usuarioModel->delete($id);
            $respuesta = ['status'=>'success','mensaje'=>'Usuario eliminado correctamente'];
        } else {
            $respuesta = ['status'=>'error','mensaje'=>'Usuario no existe'];
        }
    }

    return $this->response->setJSON($respuesta);
        }

    }


