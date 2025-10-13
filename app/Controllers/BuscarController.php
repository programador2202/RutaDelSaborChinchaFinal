<?php

namespace App\Controllers;

use App\Models\Negocio;
use CodeIgniter\Controller;

class BuscarController extends BaseController
{
    public function index()
    {
        $q = trim($this->request->getGet('q') ?? '');
        $negocioModel = new Negocio();

        $resultados = [];
        $recomendaciones = [];

        if (!empty($q)) {
            //Búsqueda principal
            $resultados = $negocioModel
                ->select('
                    negocios.idnegocio,
                    negocios.nombre AS negocio,
                    negocios.logo,
                    cartas.nombreplato AS plato,
                    cartas.precio,
                    cartas.foto,
                    locales.direccion,
                    locales.latitud,
                    locales.longitud
                ')
                ->join('locales', 'locales.idnegocio = negocios.idnegocio')
                ->join('cartas', 'cartas.idlocales = locales.idlocales', 'left')
                ->groupStart()
                    ->like('negocios.nombre', $q)
                    ->orLike('cartas.nombreplato', $q)
                ->groupEnd()
                ->findAll();

            // Si no hay resultados, mostrar recomendaciones aleatorias
            if (empty($resultados)) {
                $recomendaciones = $negocioModel
                    ->select('
                        negocios.idnegocio,
                        negocios.nombre AS negocio,
                        negocios.logo,
                        cartas.nombreplato AS plato,
                        cartas.precio,
                        cartas.foto,
                        locales.direccion,
                        locales.latitud,
                        locales.longitud
                    ')
                    ->join('locales', 'locales.idnegocio = negocios.idnegocio')
                    ->join('cartas', 'cartas.idlocales = locales.idlocales', 'inner')
                    ->orderBy('RAND()')
                    ->limit(3)
                    ->findAll();
            }
        }

        return view('PaginaPrincipal/Busqueda', [
            'q' => $q,
            'resultados' => $resultados,
            'recomendaciones' => $recomendaciones
        ]);
    }

    /**
     * Devuelve resultados en formato JSON
     * para actualizar el mapa dinámicamente (AJAX)
     */
  public function mapaBusquedaPorPlato()
{
    $plato = trim($this->request->getGet('q') ?? '');
    $negocioModel = new Negocio();

    if (empty($plato)) {
        return $this->response->setJSON([]);
    }

    // Buscar restaurantes que tengan al menos un plato que coincida
        $resultados = $negocioModel
            ->select('
                negocios.idnegocio,
                negocios.nombre AS negocio,
                negocios.logo,
                cartas.nombreplato AS plato,
                cartas.precio,
                cartas.foto,
                locales.direccion,
                locales.latitud AS lat,
                locales.longitud AS lng
            ')
            ->join('locales', 'locales.idnegocio = negocios.idnegocio')
            ->join('cartas', 'cartas.idlocales = locales.idlocales')
            ->like('cartas.nombreplato', $plato)
            ->groupBy('negocios.idnegocio')
            ->findAll();


    return $this->response->setJSON($resultados);
}

}
