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


    public function ajax()
    {
        $negocioModel = new Negocio();
        $accion = $this->request->getVar('accion');
        $respuesta = ['status' => 'error', 'mensaje' => 'Acción no definida'];

        // RUTA BASE DE IMÁGENES
        $carpetaImagenes = FCPATH . 'uploads/negocios/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes, 0777, true);
        }

        if ($accion === 'registrar') {
            $logo = $this->request->getFile('logo');
            $banner = $this->request->getFile('banner');
            $rutaLogo = null;
            $rutaBanner = null;

            if ($logo && $logo->isValid() && !$logo->hasMoved()) {
                $nuevoNombreLogo = $logo->getRandomName();
                $logo->move($carpetaImagenes, $nuevoNombreLogo);
                $rutaLogo = 'uploads/negocios/' . $nuevoNombreLogo;
            }

            if ($banner && $banner->isValid() && !$banner->hasMoved()) {
                $nuevoNombreBanner = $banner->getRandomName();
                $banner->move($carpetaImagenes, $nuevoNombreBanner);
                $rutaBanner = 'uploads/negocios/' . $nuevoNombreBanner;
            }

            $registro = [
                'idcategoria'      => $this->request->getVar('idcategoria'),
                'idseccion'        => $this->request->getVar('idseccion'),
                'idrepresentante'  => $this->request->getVar('idrepresentante'),
                'nombre'           => $this->request->getVar('nombre'),
                'nombre_comercial' => $this->request->getVar('nombre_comercial'),
                'slogan'           => $this->request->getVar('slogan'),
                'ruc'              => $this->request->getVar('ruc'),
                'logo'             => $rutaLogo,
                'banner'           => $rutaBanner
            ];

            $negocioModel->insert($registro);
            $respuesta = ['status' => 'success', 'mensaje' => 'Negocio registrado'];

        } elseif ($accion === 'actualizar') {
            $id = $this->request->getVar('idnegocio');
            $negocio = $negocioModel->find($id);
            if (!$negocio) {
                return $this->response->setJSON(['status' => 'error', 'mensaje' => 'Negocio no existe']);
            }
            $logo = $this->request->getFile('logo');
            $banner = $this->request->getFile('banner');
            
            if ($logo && $logo->isValid() && !$logo->hasMoved()) {
                // eliminar el logo anterior
                if (!empty($negocio['logo']) && file_exists(FCPATH . $negocio['logo'])) {
                    unlink(FCPATH . $negocio['logo']);
                }
                $nuevoNombreLogo = $logo->getRandomName();
                $logo->move($carpetaImagenes, $nuevoNombreLogo);
                $rutaLogo = 'uploads/negocios/' . $nuevoNombreLogo;
            } else {
                $rutaLogo = $negocio['logo']; // conservar el logo anterior
            }
            if ($banner && $banner->isValid() && !$banner->hasMoved()) {
                // eliminar el banner anterior
                if (!empty($negocio['banner']) && file_exists(FCPATH . $negocio['banner'])) {
                    unlink(FCPATH . $negocio['banner']);
                }
                $nuevoNombreBanner = $banner->getRandomName();
                $banner->move($carpetaImagenes, $nuevoNombreBanner);
                $rutaBanner = 'uploads/negocios/' . $nuevoNombreBanner;
            } else {
                $rutaBanner = $negocio['banner']; // conservar el banner anterior
            }
            $datos = [
                'idcategoria'      => $this->request->getVar('idcategoria'),
                'idseccion'        => $this->request->getVar('idseccion'),
                'idrepresentante'  => $this->request->getVar('idrepresentante'),
                'nombre'           => $this->request->getVar('nombre'),
                'nombre_comercial' => $this->request->getVar('nombre_comercial'),
                'slogan'           => $this->request->getVar('slogan'),
                'ruc'              => $this->request->getVar('ruc'),
                'logo'             => $rutaLogo,
                'banner'           => $rutaBanner
            ];
            $negocioModel->update($id, $datos);
            $respuesta = ['status' => 'success', 'mensaje' => 'Negocio actualizado'];

        } elseif ($accion === 'borrar') {
            // Lógica para borrar un negocio
            $id = $this->request->getVar('idnegocio');
            $negocio = $negocioModel->find($id);   
            if ($negocio) {
                // eliminar logo y banner
                if (!empty($negocio['logo']) && file_exists(FCPATH . $negocio['logo'])) {
                    unlink(FCPATH . $negocio['logo']);
                }
                if (!empty($negocio['banner']) && file_exists(FCPATH . $negocio['banner'])) {
                    unlink(FCPATH . $negocio['banner']);
                }
                $negocioModel->delete($id);
                $respuesta = ['status' => 'success', 'mensaje' => 'Negocio eliminado'];
            } else {
                $respuesta = ['status' => 'error', 'mensaje' => 'Negocio no encontrado'];
            }

        }
        return $this->response->setJSON($respuesta);
    }

}