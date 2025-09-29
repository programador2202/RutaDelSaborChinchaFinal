<?php

namespace App\Controllers;

use App\Models\Negocio;

class BuscarController extends BaseController
{
public function index()
{
    $q = $this->request->getGet('q') ?? '';

    $negocioModel = new Negocio();

    $resultados = [];
    $recomendaciones = [];

    if (!empty($q)) {
        
        $resultados = $negocioModel
            ->select('
                negocios.idnegocio,
                negocios.nombre AS negocio,
                negocios.logo,
                cartas.nombreplato AS plato,
                cartas.precio,
                cartas.foto,
                locales.direccion
            ')
            ->join('locales', 'locales.idnegocio = negocios.idnegocio')
            ->join('cartas', 'cartas.idlocales = locales.idlocales', 'left')
            ->groupStart()
                ->like('negocios.nombre', $q)
                ->orLike('cartas.nombreplato', $q)
            ->groupEnd()
            ->findAll();

      
        if (empty($resultados)) {
            $recomendaciones = $negocioModel
                ->select('
                    negocios.idnegocio,
                    negocios.nombre AS negocio,
                    negocios.logo,
                    cartas.nombreplato AS plato,
                    cartas.precio,
                    cartas.foto,
                    locales.direccion
                ')
                ->join('locales', 'locales.idnegocio = negocios.idnegocio')
                ->join('cartas', 'cartas.idlocales = locales.idlocales', 'inner')
                ->orderBy('RAND()')      
                ->limit(3)              
                ->findAll();
        }
    }

    return view('PaginaPrincipal/Busqueda', [
        'q'                => $q,
        'resultados'       => $resultados,
        'recomendaciones'  => $recomendaciones
    ]);
}


}
