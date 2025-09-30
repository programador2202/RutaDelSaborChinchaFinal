<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Negocio;
use App\Models\Cartas;

class DetalleController extends BaseController
{
    public function detalle($idnegocio)
    {
        $negocioModel = new Negocio();
        $cartasModel  = new Cartas();

        // Traer datos del negocio con joins
        $negocio = $negocioModel
            ->select('
                negocios.*,
                categorias.categoria,
                personas.nombres,
                personas.apellidos,
                locales.direccion,
                locales.telefono,
                locales.latitud,
                locales.longitud
            ')
            ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
            ->join('personas', 'personas.idpersona = negocios.idrepresentante')
            ->join('locales', 'locales.idnegocio = negocios.idnegocio')
            ->where('negocios.idnegocio', $idnegocio)
            ->first();

     
        $negocio['cartas'] = $cartasModel
            ->select('cartas.*, secciones.seccion AS nombre_seccion, locales.direccion AS direccion_local')
            ->join('secciones', 'secciones.idseccion = cartas.idseccion')
            ->join('locales', 'locales.idlocales = cartas.idlocales')
            ->where('locales.idnegocio', $idnegocio)
            ->orderBy('cartas.nombreplato', 'ASC')
            ->findAll();

        $data = [
            'negocio' => $negocio,
            'header'  => view('Layouts/header'),
            'footer'  => view('Layouts/footer')
        ];

        return view('PaginaPrincipal/Recursos', $data);
    }
}
