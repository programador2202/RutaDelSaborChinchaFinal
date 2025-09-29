<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Negocio;
use App\Models\Categorias;
use App\Models\Personas;
use CodeIgniter\Exceptions\PageNotFoundException;

class NegociosController extends BaseController
{
    public function index(): string
    {
        $negocioModel   = new Negocio();
        $categoriaModel = new Categorias();
        $personaModel   = new Personas();

        $datos['negocios'] = $negocioModel
        ->select('negocios.*, categorias.categoria, personas.nombres, personas.apellidos')
        ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
        ->join('personas', 'personas.idpersona = negocios.idrepresentante')
        ->orderBy('categorias.categoria', 'ASC') 
        ->orderBy('negocios.idnegocio', 'ASC')
        ->findAll();


        $datos['categorias'] = $categoriaModel
            ->select('idcategoria, categoria')
            ->orderBy('categoria', 'ASC')
            ->findAll();

        $datos['personas'] = $personaModel
            ->select('idpersona, nombres, apellidos')
            ->orderBy('apellidos', 'ASC')
            ->findAll();

        $datos['header'] = view('admin/dashboard');

        return view('admin/recursos/Negocios', $datos);
    }

    public function ajax()
    {
        $negocioModel = new Negocio();
        $accion       = $this->request->getVar('accion');
        $respuesta    = ['status' => 'error', 'mensaje' => 'Acción no definida'];

        // Carpeta de imágenes
        $carpetaLogo = FCPATH . 'uploads/negocios/logo/';
        if (!is_dir($carpetaLogo)) mkdir($carpetaLogo, 0777, true);

        try {
            if ($accion === 'registrar') {

                // Logo
                $logo = $this->request->getFile('logo');
                $rutaLogo = $logo && $logo->isValid() && !$logo->hasMoved()
                    ? 'uploads/negocios/logo/' . $logo->getRandomName()
                    : null;

                if ($rutaLogo) {
                    $logo->move($carpetaLogo, basename($rutaLogo));
                }

                $registro = [
                    'idcategoria'      => $this->request->getVar('idcategoria'),
                    'idrepresentante'  => $this->request->getVar('idrepresentante'),
                    'nombre'           => $this->request->getVar('nombre'),
                    'nombrecomercial'  => $this->request->getVar('nombrecomercial'),
                    'slogan'           => $this->request->getVar('slogan'),
                    'ruc'              => $this->request->getVar('ruc'),
                    'logo'             => $rutaLogo
                ];

                $id = $negocioModel->insert($registro);
                $respuesta = [
                    'status'  => 'success',
                    'mensaje' => 'Negocio registrado',
                    'data'    => $negocioModel->find($id)
                ];

            } elseif ($accion === 'actualizar') {
                $id = $this->request->getVar('idnegocio');
                $negocio = $negocioModel->find($id);

                if (!$negocio) {
                    throw PageNotFoundException::forPageNotFound("Negocio no existe");
                }

                $logo = $this->request->getFile('logo');

                if ($logo && $logo->isValid() && !$logo->hasMoved()) {
                    if (!empty($negocio['logo']) && file_exists(FCPATH . $negocio['logo'])) {
                        unlink(FCPATH . $negocio['logo']);
                    }
                    $rutaLogo = 'uploads/negocios/logo/' . $logo->getRandomName();
                    $logo->move($carpetaLogo, basename($rutaLogo));
                } else {
                    $rutaLogo = $negocio['logo']; // conservar logo anterior
                }

                $datos = [
                    'idcategoria'      => $this->request->getVar('idcategoria'),
                    'idrepresentante'  => $this->request->getVar('idrepresentante'),
                    'nombre'           => $this->request->getVar('nombre'),
                    'nombrecomercial'  => $this->request->getVar('nombrecomercial'),
                    'slogan'           => $this->request->getVar('slogan'),
                    'ruc'              => $this->request->getVar('ruc'),
                    'logo'             => $rutaLogo
                ];

                $negocioModel->update($id, $datos);
                $respuesta = [
                    'status'  => 'success',
                    'mensaje' => 'Negocio actualizado',
                    'data'    => $negocioModel->find($id)
                ];

            } elseif ($accion === 'borrar') {
                $id = $this->request->getVar('idnegocio');
                $negocio = $negocioModel->find($id);

                if ($negocio) {
                    try {
                        if (!empty($negocio['logo']) && file_exists(FCPATH . $negocio['logo'])) {
                            unlink(FCPATH . $negocio['logo']);
                        }
                        $negocioModel->delete($id);
                        $respuesta = ['status' => 'success', 'mensaje' => 'Negocio eliminado'];
                    } catch (\Exception $e) {
                        if (strpos($e->getMessage(), '1451') !== false) {
                            $respuesta = [
                                'status'  => 'error',
                                'mensaje' => 'No se puede eliminar el negocio porque está relacionado con otros registros'
                            ];
                        } else {
                            $respuesta = [
                                'status'  => 'error',
                                'mensaje' => 'Error al eliminar el negocio'
                            ];
                        }
                    }
                } else {
                    $respuesta = ['status' => 'error', 'mensaje' => 'Negocio no encontrado'];
                }
            }
        } catch (\Throwable $e) {
            $respuesta = ['status' => 'error', 'mensaje' => $e->getMessage()];
        }

        return $this->response->setJSON($respuesta);
    }

    
}