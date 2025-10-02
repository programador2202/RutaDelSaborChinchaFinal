<?php

namespace App\Controllers;

use App\Models\Locales;
use CodeIgniter\Controller;

class MapController extends Controller
{
    public function restaurantes()
    {
        $cat = trim($this->request->getGet('cat')); 
        $localModel = new Locales();

        $query = $localModel
            ->select('locales.latitud as lat, locales.longitud as lng, locales.direccion, negocios.nombre as negocio, categorias.categoria as categoria')
            ->join('negocios', 'negocios.idnegocio = locales.idnegocio')
            ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
            ->where('locales.latitud IS NOT NULL')
            ->where('locales.longitud IS NOT NULL');

        if ($cat) {
            $query->like('categorias.categoria', $cat);
        }

        $result = $query->findAll();
        return $this->response->setJSON($result);
    }
}
