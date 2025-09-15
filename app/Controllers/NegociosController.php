<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Negocio;
use App\Models\Categorias;
use App\Models\Personas;

class NegociosController extends BaseController
{
    public function index(): string
    {
        $negocioModel   = new Negocio();
        $categoriaModel = new Categorias();
        $personaModel   = new Personas();

        // Traemos los negocios con categoría y representante
        $datos['negocios'] = $negocioModel
            ->select('negocios.*, categorias.categoria, personas.nombres, personas.apellidos')
            ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
            ->join('personas', 'personas.idpersona = negocios.idrepresentante')
            ->orderBy('negocios.idnegocio', 'ASC')
            ->findAll();

        $datos['categorias']   = $categoriaModel->orderBy('categoria', 'ASC')->findAll();
        $datos['personas']     = $personaModel->orderBy('apellidos', 'ASC')->findAll();

        $datos['header'] = view('admin/dashboard');

        return view('admin/recursos/Negocios', $datos);
    }

    public function store()
    {
        $negocioModel = new Negocio();

        $data = [
            'idcategoria'      => $this->request->getPost('idcategoria'),
            'idrepresentante'  => $this->request->getPost('idrepresentante'),
            'nombre'           => $this->request->getPost('nombre'),
            'nombrecomercial'  => $this->request->getPost('nombrecomercial'),
            'slogan'           => $this->request->getPost('slogan'),
            'ruc'              => $this->request->getPost('ruc'),
        ];

        $negocioModel->insert($data);

        return redirect()->to(base_url('negocios'))->with('msg', 'Negocio creado correctamente');
    }

    public function update()
    {
        $negocioModel = new Negocio();

        $idnegocio = $this->request->getPost('idnegocio');

        $data = [
            'idcategoria'      => $this->request->getPost('idcategoria'),
            'idrepresentante'  => $this->request->getPost('idrepresentante'),
            'nombre'           => $this->request->getPost('nombre'),
            'nombrecomercial'  => $this->request->getPost('nombrecomercial'),
            'slogan'           => $this->request->getPost('slogan'),
            'ruc'              => $this->request->getPost('ruc'),
        ];

        $negocioModel->update($idnegocio, $data);

        return redirect()->to(base_url('negocios'))->with('msg', 'Negocio actualizado correctamente');
    }

    public function delete($idnegocio = null)
    {
        $negocioModel = new Negocio();
        $negocioModel->delete($idnegocio);

        return redirect()->to(base_url('negocios'))->with('msg', 'Negocio eliminado correctamente');
    }
}
