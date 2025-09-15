<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cartas;
use App\Models\Locales;
use App\Models\Secciones;

class CartaController extends BaseController
{
    public function index(): string
    {
        $cartaModel = new Cartas();

        // Unir con locales y secciones para mostrar los nombres
        $datos['cartas'] = $cartaModel
            ->select('cartas.*, locales.direccion AS local, secciones.seccion AS seccion')
            ->join('locales', 'locales.idlocales = cartas.idlocales')
            ->join('secciones', 'secciones.idseccion = cartas.idseccion')
            ->orderBy('cartas.idcarta', 'ASC')
            ->findAll();

        $datos['header'] = view('admin/dashboard');
        return view('admin/recursos/Carta', $datos);
    }
}
