<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Categorias;
use App\Models\Personas;
use App\Models\Secciones;

class PersonaController extends BaseController

{    public function index(): string
    {
        $categoriaModel = new Personas();

        $datos['personas'] = $categoriaModel->orderBy('idpersona', 'ASC')->findAll();
        $datos['header'] = view('admin/dashboard');

        return view('admin/personas/Listar', $datos);
    }


    public function registrar()
    {
        $categoriaModel = new Categorias();

        $registro = [
            'categoria' => $this->request->getVar('nombre')
        ];

        $categoriaModel->insert($registro);

        return redirect()->to(base_url('admin/categorias/'))
                         ->with('mensaje', 'registrado');
    }


    public function actualizar()
    {
        $categoriaModel = new Categorias();

        $id = $this->request->getVar('idcategoria');
        $datos = [
            'categoria' => $this->request->getVar('nombre')
        ];

        $categoriaModel->update($id, $datos);

        return redirect()->to(base_url('admin/categorias/'))
                         ->with('mensaje', 'editado');
    }

 
    public function borrar($id = null)
    {
        $categoriaModel = new Categorias();

        if ($categoriaModel->find($id)) {
            $categoriaModel->delete($id);
            return redirect()->to(base_url('categorias'))
                             ->with('mensaje', 'eliminado');
        }

        return redirect()->to(base_url('categorias'))
                         ->with('mensaje', 'no_existe');
    }
}
