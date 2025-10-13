<?php

namespace App\Controllers;

use App\Models\Locales;
use CodeIgniter\Controller;
use App\Models\Negocio;

class MapController extends Controller
{
   
    public function restaurantes()
    {
        $cat = trim($this->request->getGet('cat'));
        $localModel = new Locales();

        $query = $localModel
            ->select('
                locales.latitud AS lat,
                locales.longitud AS lng,
                locales.direccion,
                negocios.nombre AS negocio,
                categorias.categoria AS categoria
            ')
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


  
    public function buscar()
    {
        $q = trim($this->request->getGet('q') ?? '');
        $negocioModel = new Negocio();

        if (empty($q)) {
            return $this->response->setJSON([]);
        }

        $resultados = $negocioModel
            ->select('
                negocios.idnegocio,
                negocios.nombre AS negocio,
                locales.direccion,
                locales.latitud,
                locales.longitud,
                cartas.nombreplato AS plato,
                cartas.precio,
                cartas.foto
            ')
            ->join('locales', 'locales.idnegocio = negocios.idnegocio')
            ->join('cartas', 'cartas.idlocales = locales.idlocales', 'left')
            ->groupStart()
                ->like('negocios.nombre', $q)
                ->orLike('cartas.nombreplato', $q)
            ->groupEnd()
            ->findAll();

        return $this->response->setJSON($resultados);
    }
}
