<?php

namespace App\Controllers;

use App\Models\Negocio;

class BuscarController extends BaseController
{
    public function index()
    {
        $q = $this->request->getGet('q') ?? '';

        $negocioModel = new Negocio();

        $datos = [];
        if (!empty($q)) {
            $datos = $negocioModel
                ->select('
                    negocios.idnegocio,
                    negocios.nombre AS negocio,
                    negocios.logo,
                    cartas.nombreplato AS plato,
                    cartas.precio,
                    locales.direccion
                ')
                ->join('locales', 'locales.idnegocio = negocios.idnegocio')
                ->join('cartas', 'cartas.idlocales = locales.idlocales', 'left')
                ->groupStart()
                    ->like('negocios.nombre', $q)
                    ->orLike('cartas.nombreplato', $q)
                ->groupEnd()
                ->findAll();
        }

        return view('PaginaPrincipal/Busqueda', [
            'q'          => $q,
            'resultados' => $datos
        ]);
    }

    public function sugerencias()
    {
        $q = $this->request->getGet('q') ?? '';

        if (strlen($q) < 3) {
            return $this->response->setJSON([]);
        }

        $negocioModel = new Negocio();

        $resultados = $negocioModel
            ->select('
                negocios.idnegocio,
                negocios.nombre AS negocio,
                cartas.nombreplato AS plato
            ')
            ->join('locales', 'locales.idnegocio = negocios.idnegocio')
            ->join('cartas', 'cartas.idlocales = locales.idlocales', 'left')
            ->groupStart()
                ->like('negocios.nombre', $q)
                ->orLike('cartas.nombreplato', $q)
            ->groupEnd()
            ->limit(10)
            ->findAll();

        // Mapeamos para evitar datos innecesarios
        $sugerencias = [];
        foreach ($resultados as $item) {
            if (!empty($item['plato'])) {
                $sugerencias[] = [
                    'tipo' => 'plato',
                    'texto' => $item['plato']
                ];
            }
            if (!empty($item['negocio'])) {
                $sugerencias[] = [
                    'tipo' => 'negocio',
                    'texto' => $item['negocio']
                ];
            }
        }

        // Quitamos duplicados
        $sugerencias = array_unique($sugerencias, SORT_REGULAR);

        return $this->response->setJSON($sugerencias);
    }
}
