<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Comentario;
use App\Models\Reservas;
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

    // Validar sesión
    if (!$session->get('logged_in') || !$session->has('user_id')) {
        $session->set('redirect_url', current_url());
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para comentar.');
    }

    $comentarioModel = new Comentario();
    $reservaModel    = new Reservas();

    // Obtener datos del formulario
    $idLocal         = $this->request->getPost('idlocales');
    $comentarioTexto = $this->request->getPost('comentario');
    $valoracion      = $this->request->getPost('valoracion');
    $usuarioId       = $session->get('user_id');

    // Validación simple
    if (empty($comentarioTexto) || empty($valoracion) || empty($idLocal)) {
        return redirect()->back()->with('error', 'Por favor, completa todos los campos.');
    }

    // Verificar si el usuario tiene una reserva en este local (confirmada o pendiente)
    $reserva = $reservaModel
        ->where('idpersonasolicitud', $usuarioId)
        ->where('idlocales', $idLocal)
        ->whereIn('confirmacion', ['confirmado', 'pendiente'])
        ->first();

    if (!$reserva) {
        return redirect()->back()->with('error', 'Solo puedes comentar si has realizado una reserva en este local.');
    }

    // ⚠️ (Opcional) Verificar si ya comentó este local
    $yaComento = $comentarioModel
        ->where('tokenusuario', $usuarioId)
        ->where('idlocales', $idLocal)
        ->first();

    if ($yaComento) {
        return redirect()->back()->with('error', 'Ya has comentado este local.');
    }

    // Guardar comentario
    $data = [
        'idlocales'    => $idLocal,
        'tokenusuario' => $usuarioId,
        'comentario'   => $comentarioTexto,
        'valoracion'   => $valoracion,
        'fechahora'    => date('Y-m-d H:i:s') 
    ];

    if ($comentarioModel->insert($data)) {

        // (Opcional) marcar la reserva como "comentada" si tienes ese campo
        // $reservaModel->update($reserva['idreserva'], ['comentado' => 1]);

        return redirect()->back()->with('success', 'Tu comentario fue publicado correctamente.');
    } else {
        return redirect()->back()->with('error', 'Ocurrió un error al guardar tu comentario.');
    }
}


}
