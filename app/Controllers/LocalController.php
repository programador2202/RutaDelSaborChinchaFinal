<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Locales;
use App\Models\Negocio;
use App\Models\Distritos;
use App\Models\Departamentos;
use App\Models\Provincias;

class LocalController extends BaseController
{
public function index(): string
{
    $localModel       = new Locales();
    $negocioModel     = new Negocio();
    $distritoModel    = new Distritos();
    $departamentoModel = new Departamentos();
    $provinciaModel   = new Provincias();

    $nivel     = session()->get('nivelacceso');
    $idpersona = session()->get('idpersona'); // idpersona del representante

    // Traer locales con información de provincia y departamento
    $localesQuery = $localModel
        ->select('locales.*, negocios.nombre AS negocio, distritos.distrito AS distrito, 
                  provincias.provincia AS provincia, departamentos.departamento AS departamento, 
                  provincias.idprovincia, departamentos.iddepartamento')
        ->join('negocios', 'negocios.idnegocio = locales.idnegocio')
        ->join('distritos', 'distritos.iddistrito = locales.iddistrito')
        ->join('provincias', 'provincias.idprovincia = distritos.idprovincia')
        ->join('departamentos', 'departamentos.iddepartamento = provincias.iddepartamento')
        ->orderBy('locales.idlocales', 'ASC');

    if ($nivel === 'representante') {
        // Solo los locales de los negocios que pertenecen a este representante
        $localesQuery->where('negocios.idrepresentante', $idpersona);
    }

    $datos['locales'] = $localesQuery->findAll();

    // Negocios filtrados según el nivel
    if ($nivel === 'representante') {
        $datos['negocios'] = $negocioModel
            ->where('idrepresentante', $idpersona)
            ->findAll();
    } else {
        $datos['negocios'] = $negocioModel->findAll();
    }

    // Para el resto de datos, los puede ver completo
    $datos['distritos']     = $distritoModel->findAll();
    $datos['provincias']    = $provinciaModel->findAll();
    $datos['departamentos'] = $departamentoModel->findAll();
    $datos['header']        = view('admin/dashboard');

    return view('admin/recursos/Locales', $datos);
}


    public function ajax()
    {
        
        $localModel = new Locales();
        $accion     = $this->request->getVar('accion');

        $respuesta = ['status' => 'error', 'message' => 'Acción no definida'];

        if (in_array($accion, ['registrar', 'actualizar'])) {

            // Validación básica
            $validationRules = [
                'idnegocio'  => 'required|integer',
                'iddistrito' => 'required|integer',
                'direccion'  => 'required|min_length[3]|max_length[255]',
                'telefono'   => 'permit_empty|numeric|max_length[15]',
                'latitud'    => 'required|decimal',
                'longitud'   => 'required|decimal',
            ];

            if (!$this->validate($validationRules)) {
                $respuesta = [
                    'status' => 'error',
                    'message' => $this->validator->listErrors()
                ];
                return $this->response->setJSON($respuesta);
            }
                $lat = str_replace(',', '.', trim($this->request->getVar('latitud')));
                $lng = str_replace(',', '.', trim($this->request->getVar('longitud')));

                $datos = [
                'idnegocio'  => $this->request->getVar('idnegocio'),
                'iddistrito' => $this->request->getVar('iddistrito'),
                'direccion'  => $this->request->getVar('direccion'),
                'telefono'   => $this->request->getVar('telefono'),
                'latitud'  => $lat !== '' ? floatval($lat) : null,
                'longitud' => $lng !== '' ? floatval($lng) : null,
            ];

            if ($accion === 'registrar') {
                $localModel->insert($datos);
                $respuesta = ['status' => 'success', 'message' => 'Local registrado correctamente'];
            } else {
                $id = $this->request->getVar('idlocales');
                if ($localModel->find($id)) {
                    $localModel->update($id, $datos);
                    $respuesta = ['status' => 'success', 'message' => 'Local actualizado correctamente'];
                } else {
                    $respuesta = ['status' => 'error', 'message' => 'Local no existe'];
                }
            }

        } else if ($accion === 'borrar') {
            $id = $this->request->getVar('idlocales');
            if ($localModel->find($id)) {
                try {
                    $localModel->delete($id);
                    $respuesta = ['status' => 'success', 'message' => 'Local eliminado correctamente'];
                } catch (\Exception $e) {
                    $respuesta = ['status' => 'error', 'message' => 'No se puede eliminar el local porque está en uso'];
                }
            } else {
                $respuesta = ['status' => 'error', 'message' => 'Local no existe'];
            }
        }

        return $this->response->setJSON($respuesta);
    }
}
