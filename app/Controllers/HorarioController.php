<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Horario;

class HorarioController extends BaseController
{
public function index()
{
    $model = new Horario();

    $data['horarios'] = $model
        ->select('horarios.*, locales.direccion, locales.telefono, negocios.nombre AS negocio')
        ->join('locales', 'locales.idlocales = horarios.idlocales')
        ->join('negocios', 'negocios.idnegocio = locales.idnegocio') 
        ->orderBy('horarios.diasemana', 'ASC')
        ->findAll();

    $data['header'] = view('admin/dashboard'); 
    return view('admin/recursos/Horario', $data);
}


    public function crear()
    {
        return view('admin/horarios/Crear');
    }

    public function guardar()
    {
        $model = new Horario();

        $data = [
            'idlocales' => $this->request->getPost('idlocales'),
            'diasemana' => $this->request->getPost('diasemana'),
            'inicio'    => $this->request->getPost('inicio'),
            'fin'       => $this->request->getPost('fin'),
        ];

        $model->insert($data);

        return redirect()->to(base_url('horarios'));
    }

    public function editar($id)
    {
        $model = new Horario();
        $data['horario'] = $model->find($id);

        return view('admin/horarios/Editar', $data);
    }

    public function actualizar()
    {
        $model = new Horario();

        $id = $this->request->getPost('idhorario');

        $data = [
            'idlocales' => $this->request->getPost('idlocales'),
            'diasemana' => $this->request->getPost('diasemana'),
            'inicio'    => $this->request->getPost('inicio'),
            'fin'       => $this->request->getPost('fin'),
        ];

        $model->update($id, $data);

        return redirect()->to(base_url('horarios'));
    }

    public function eliminar($id)
    {
        $model = new Horario();
        $model->delete($id);

        return redirect()->to(base_url('horarios'));
    }
}
