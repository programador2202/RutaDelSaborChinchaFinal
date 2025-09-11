<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Negocios;

class NegociosController extends BaseController
{
    public function index(): string
    {
        $negocioModel = new Negocios();

       $datos['negocios'] = $negocioModel
            ->select("negocios.*, categorias.categoria AS nombre_categoria, 
                      CONCAT(personas.apellidos, ' ', personas.nombres) AS representante")
            ->join("categorias", "categorias.idcategoria = negocios.idcategoria")
            ->join("personas",   "personas.idpersona = negocios.idrepresentante")
            ->orderBy("negocios.idnegocio", "ASC")
            ->findAll();
        $datos['header'] = view('admin/dashboard');
        return view('admin/negocios/Listar', $datos);
    }



    public function registrar()
    {
        $negocioModel = new Negocios();

        $data = [
            'idcategoria'       => $this->request->getPost('idcategoria'),
            'idseccion'         => $this->request->getPost('idseccion'),
            'idpersona'         => $this->request->getPost('idpersona'),
            'nombre'            => $this->request->getPost('nombre'),
            'nombre_comercial'  => $this->request->getPost('nombre_comercial'),
            'slogan'            => $this->request->getPost('slogan'),
            'ruc'               => $this->request->getPost('ruc'),
        ];

        $negocioModel->insert($data);
        return redirect()->to(base_url('negocios'))->with('mensaje', 'registrado');
    }

    public function actualizar()
    {
        $negocioModel = new Negocios();

        $id = $this->request->getPost('idnegocio');

        $data = [
            'idcategoria'       => $this->request->getPost('idcategoria'),
            'idseccion'         => $this->request->getPost('idseccion'),
            'idpersona'         => $this->request->getPost('idpersona'),
            'nombre'            => $this->request->getPost('nombre'),
            'nombre_comercial'  => $this->request->getPost('nombre_comercial'),
            'slogan'            => $this->request->getPost('slogan'),
            'ruc'               => $this->request->getPost('ruc'),
        ];

        $negocioModel->update($id, $data);
        return redirect()->to(base_url('negocios'))->with('mensaje', 'editado');
    }

    public function borrar($id = null)
    {
        $negocioModel = new Negocios();

        if ($negocioModel->find($id)) {
            $negocioModel->delete($id);
            return redirect()->to(base_url('negocios'))->with('mensaje', 'eliminado');
        } else {
            return redirect()->to(base_url('negocios'))->with('mensaje', 'no_existe');
        }
    }
}
