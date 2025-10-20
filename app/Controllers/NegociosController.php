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

    $nivel     = session()->get('nivelacceso');
    $idpersona = session()->get('idpersona');
    // Filtrar según el usuario
    if ($nivel === 'admin') {
        $datos['negocios'] = $negocioModel
            ->select('negocios.*, categorias.categoria, personas.nombres, personas.apellidos')
            ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
            ->join('personas', 'personas.idpersona = negocios.idrepresentante')
            ->orderBy('categorias.categoria', 'ASC') 
            ->orderBy('negocios.idnegocio', 'ASC')
            ->findAll();
    } elseif ($nivel === 'representante') {
        // Solo los negocios que pertenecen a su persona
        $datos['negocios'] = $negocioModel
            ->select('negocios.*, categorias.categoria, personas.nombres, personas.apellidos')
            ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
            ->join('personas', 'personas.idpersona = negocios.idrepresentante')
            ->where('negocios.idrepresentante', $idpersona) 
            ->orderBy('categorias.categoria', 'ASC') 
            ->orderBy('negocios.idnegocio', 'ASC')
            ->findAll();
    } else {
        $datos['negocios'] = [];
    }

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



        $idnegocio = $this->request->getVar('idnegocio');

        //validacion de datos antes de registrar o actualizar un negocio
        if (in_array($accion, ['registrar', 'actualizar'])) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'idcategoria'     => 'required|integer',
                'idrepresentante' => 'required|integer',
                'nombre'          => 'required|string|max_length[100]',
                'nombrecomercial' => 'required|string|max_length[100]',
                'slogan'          => 'permit_empty|string|max_length[150]',
                'ruc'             => 'required|regex_match[/^\d{11}$/]',
                'logo'            => 'permit_empty|is_image[logo]|max_size[logo,2048]|ext_in[logo,png,jpg,jpeg,gif]'
            ]);
           //si es registrar, se requiere que el ruc sea unico
             if ($accion === 'registrar') {
                    $validation->setRule('ruc', 'RUC', 'required|regex_match[/^\d{11}$/]|is_unique[negocios.ruc]');
                }


            // si es actualizar el ruc debe ser unico execpto el mismo negocio
           if ($accion === 'actualizar' && $idnegocio) {
                $validation->setRule('ruc', 'RUC', 'required|regex_match[/^\d{11}$/]|is_unique[negocios.ruc,idnegocio,' . $idnegocio . ']');
            }

            //recorrido de la validacion

            if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status'  => 'error',
                'mensaje' => 'El ruc debe tener 11 Digitos, revise y vuelta a Intentarlo',
                'errores' => $validation->getErrors()
            ]);
}


    }
       


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
                $ruc = $this->request->getVar('ruc');
                $id = $this->request->getVar('idnegocio');
                $negocio = $negocioModel->find($id);

                $negocioExistente = $negocioModel
                ->where('ruc', $ruc)
                ->where('idnegocio !=', $id)
                ->first();

                if ($negocioExistente) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'mensaje' => 'El RUC ya está registrado en otro negocio'
                    ]);
                }


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