<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Negocio;
use App\Models\Categorias;
use App\Models\Cartas;
use App\Models\Secciones;

class MostrarController extends BaseController
{
    public function index()
    {
        $negocioModel   = new Negocio();
        $categoriaModel = new Categorias();
        $cartaModel     = new Cartas();
        $seccionModel   = new Secciones();

        // Negocios con categoría y representante (para la portada)
        $data['negocios'] = $negocioModel
            ->select('negocios.*, categorias.categoria')
            ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
            ->orderBy('categorias.categoria', 'ASC')
            ->orderBy('negocios.nombre', 'ASC')
            ->findAll();


        // Todas las categorías
        $data['categorias'] = $categoriaModel->orderBy('categoria', 'ASC')->findAll();

        // Ejemplo: últimas 6 cartas (platos) destacadas
        $data['cartas'] = $cartaModel
            ->select('cartas.*, secciones.seccion, locales.direccion')
            ->join('secciones', 'secciones.idseccion = cartas.idseccion')
            ->join('locales', 'locales.idlocales = cartas.idlocales')
            ->orderBy('cartas.idcarta', 'DESC')
            ->limit(6)
            ->find();

        // Header opcional (puede ser diferente del admin)
        $data['header'] = view('layouts/header');
        $data['footer'] = view('layouts/footer');

        return view('PaginaPrincipal/Categorias', $data);
    }
}
