<?php

namespace App\Controllers;

use App\Models\Locales;
use App\Models\Negocio;
use CodeIgniter\Controller;

class MapController extends Controller
{
    public function index()
    {
        $localModel   = new Locales();
        $negocioModel = new Negocio();

        // Restaurantes con coordenadas
         $restaurantes = $localModel
        ->select('locales.latitud, locales.longitud, locales.direccion, negocios.nombre as negocio, categorias.categoria as categoria')
        ->join('negocios', 'negocios.idnegocio = locales.idnegocio')
        ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
        ->where('locales.latitud IS NOT NULL')
        ->where('locales.longitud IS NOT NULL')
        ->findAll();


        // Sacamos categorías únicas
        $categorias = array_unique(array_column($restaurantes, 'categoria'));

        return view('PaginaPrincipal/Principal', [
            'restaurantes' => $restaurantes,
            'categorias'   => $categorias
        ]);
    }
}
