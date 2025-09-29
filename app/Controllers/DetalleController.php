<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Negocio;
use App\Models\Categorias;
use App\Models\Cartas;
use App\Models\Personas;
class DetalleController extends BaseController
{

    public function detalle($idnegocio)
{
    $negocioModel = new Negocio();
    $cartasModel  = new Cartas();

    $negocio = $negocioModel
        ->select('negocios.*, categorias.categoria, personas.nombres, personas.apellidos, locales.direccion, locales.telefono, locales.latitud, locales.longitud')
        ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
        ->join('personas', 'personas.idpersona = negocios.idrepresentante')
        ->join('locales', 'locales.idnegocio = negocios.idnegocio') // Trae info del local
        ->where('negocios.idnegocio', $idnegocio)
        ->first();

    if (!$negocio) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Negocio no encontrado');
    }

    $negocio['cartas'] = $cartasModel->where('idlocales', $idnegocio)
                                     ->orderBy('nombreplato', 'ASC')
                                     ->findAll();

    $data = [
        'negocio' => $negocio,
        'header'  => view('Layouts/header'),
        'footer'  => view('Layouts/footer')
    ];

    return view('PaginaPrincipal/Recursos', $data);
}

}