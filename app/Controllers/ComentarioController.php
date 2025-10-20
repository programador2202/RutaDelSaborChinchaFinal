<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Comentario;

class ComentarioController extends BaseController
{
  public function index()
{
    $comentarioModel = new Comentario();
    $nivel     = session()->get('nivelacceso');
    $idpersona = session()->get('idpersona'); 

    if ($nivel === 'representante') {
        $comentarios = $comentarioModel->obtenerComentariosConUsuario($idpersona);
    } else {
        $comentarios = $comentarioModel->obtenerComentariosConUsuario();
    }

    $data = [
        'comentarios' => $comentarios,
        'header'      => view('admin/dashboard')
    ];

    return view('admin/recursos/Comentarios', $data);
}


   public function guardar()
{
    $session = session();

    // Validar sesión (usamos 'logged_in' y 'user_id', igual que en login)
    if (!$session->get('logged_in') || !$session->has('user_id')) {
        // Puedes guardar la URL actual para redirigir después del login (opcional)
        $session->set('redirect_url', current_url());
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para comentar.');
    }

    $comentarioModel = new Comentario();

    // Obtener datos del formulario
    $idLocal = $this->request->getPost('idlocales');
    $comentarioTexto = $this->request->getPost('comentario');
    $valoracion = $this->request->getPost('valoracion');
    $usuarioId = $session->get('user_id');

    // Validación simple
    if (empty($comentarioTexto) || empty($valoracion) || empty($idLocal)) {
        return redirect()->back()->with('error', 'Por favor, completa todos los campos.');
    }

    $data = [
        'idlocales'    => $idLocal,
        'tokenusuario' => $usuarioId,
        'comentario'   => $comentarioTexto,
        'valoracion'   => $valoracion,
    ];

    if ($comentarioModel->insert($data)) {
        return redirect()->back()->with('success', 'Tu comentario fue publicado correctamente.');
    } else {
        return redirect()->back()->with('error', 'Ocurrió un error al guardar tu comentario.');
    }
}

}
