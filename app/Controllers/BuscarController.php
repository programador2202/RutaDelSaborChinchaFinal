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
                locales.idlocales, 
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
                    locales.idlocales, 
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
    $query = trim($this->request->getGet('q') ?? '');
    $negocioModel = new Negocio();

    $negocioModel
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
        ->join('cartas', 'cartas.idlocales = locales.idlocales');

    if (!empty($query)) {
        $negocioModel->groupStart()
            ->like('cartas.nombreplato', $query)
            ->orLike('negocios.nombre', $query)
        ->groupEnd();
    }

    $resultados = $negocioModel->findAll();

    return $this->response->setJSON($resultados);
}

public function sugerencias()
{
    $q = trim($this->request->getGet('q') ?? '');

    if (strlen($q) < 3) {
        return $this->response->setJSON([]);
    }

    $db = \Config\Database::connect();

    $sql = "
        SELECT texto, latitud, longitud FROM (
          SELECT 
            negocios.nombre AS texto,
            locales.latitud,
            locales.longitud
          FROM negocios
          JOIN locales ON locales.idnegocio = negocios.idnegocio
          WHERE negocios.nombre LIKE ?
          GROUP BY negocios.nombre, locales.latitud, locales.longitud

          UNION

          SELECT 
            cartas.nombreplato AS texto,
            locales.latitud,
            locales.longitud
          FROM negocios
          JOIN locales ON locales.idnegocio = negocios.idnegocio
          JOIN cartas ON cartas.idlocales = locales.idlocales
          WHERE cartas.nombreplato LIKE ?
          GROUP BY cartas.nombreplato, locales.latitud, locales.longitud
        ) AS sugerencias_combinadas
        LIMIT 10
    ";

    $likeQuery = '%' . $q . '%';

    $query = $db->query($sql, [$likeQuery, $likeQuery]);
    $resultados = $query->getResultArray();

    return $this->response->setJSON($resultados);
}






    }
