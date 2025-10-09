<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Comentario;

class ComentarioController extends BaseController
{

    public function index()
    {
        $comentarioModel = new Comentario();
        $comentarios = $comentarioModel->findAll();
        

        $data = [
            'comentarios' => $comentarios,
            'header'      => view('admin/dashboard')
        ];

        return view('admin/recursos/Comentarios', $data);
    }
    public function guardar()
    {
        $comentarioModel = new Comentario();

        $data = [
            'idlocales'    => $this->request->getPost('idlocales'),
            'tokenusuario' => session()->get('tokenusuario') ?? 'Anónimo', 
            'comentario'   => $this->request->getPost('comentario'),
            'valoracion'   => $this->request->getPost('valoracion'),
        ];

        // Validación simple
        if (empty($data['comentario']) || empty($data['valoracion'])) {
            return redirect()->back()->with('error', 'Por favor, completa todos los campos.');
        }

        if ($comentarioModel->insert($data)) {
            return redirect()->back()->with('success', 'Tu comentario fue publicado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ocurrió un error al guardar tu comentario.');
        }
    }
}
