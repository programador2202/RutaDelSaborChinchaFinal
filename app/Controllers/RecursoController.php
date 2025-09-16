<?php

namespace App\Controllers;

use App\Models\Recrusos;

class RecursoController extends BaseController
{
    public function index()
    {
        $recursoModel = new Recrusos();

        // Trae todos los registros de la tabla recursos
        $datos['header'] = view('admin/dashboard');
        $datos['recursos'] = $recursoModel->findAll();

        return view('admin/recursos/Recursos', $datos);
    }
}
