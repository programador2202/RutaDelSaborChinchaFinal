<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Locales;
use App\Models\Negocio;
use App\Models\Distritos;

class LocalController extends BaseController
{
    public function index(): string
    {
        $localModel = new Locales();
        $negocioModel = new Negocio();
        $distritoModel = new Distritos();

        $datos['locales'] = $localModel
            ->select('locales.*, negocios.nombre as negocio, distritos.distrito as distrito')
            ->join('negocios', 'negocios.idnegocio = locales.idnegocio')
            ->join('distritos', 'distritos.iddistrito = locales.iddistrito')
            ->orderBy('idlocales', 'ASC')
            ->findAll();

        $datos['negocios']  = $negocioModel->findAll();
        $datos['distritos'] = $distritoModel->findAll();

        $datos['header'] = view('admin/dashboard');
        return view('admin/recursos/Locales', $datos);
    }

    public function registrar()
    {
        $localModel = new Locales();

        $registro = [
            'idnegocio' => $this->request->getVar('idnegocio'),
            'iddistrito' => $this->request->getVar('iddistrito'),
            'direccion'  => $this->request->getVar('direccion'),
            'telefono'   => $this->request->getVar('telefono'),
            'latitud'    => $this->request->getVar('latitud'),
            'longitud'   => $this->request->getVar('longitud'),
        ];

        $localModel->insert($registro);

        return redirect()->to(base_url('admin/locales'))
                         ->with('mensaje', 'registrado');
    }

    public function actualizar()
    {
        $localModel = new Locales();

        $id = $this->request->getVar('idlocales');
        $datos = [
            'idnegocio' => $this->request->getVar('idnegocio'),
            'iddistrito' => $this->request->getVar('iddistrito'),
            'direccion'  => $this->request->getVar('direccion'),
            'telefono'   => $this->request->getVar('telefono'),
            'latitud'    => $this->request->getVar('latitud'),
            'longitud'   => $this->request->getVar('longitud'),
        ];

        $localModel->update($id, $datos);

        return redirect()->to(base_url('admin/locales'))
                         ->with('mensaje', 'editado');
    }

    public function borrar($id = null)
    {
        $localModel = new Locales();

        if ($localModel->find($id)) {
            $localModel->delete($id);
            return redirect()->to(base_url('admin/locales'))
                             ->with('mensaje', 'eliminado');
        }

        return redirect()->to(base_url('admin/locales'))
                         ->with('mensaje', 'no_existe');
    }
}
