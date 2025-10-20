<?php

namespace App\Models;

use CodeIgniter\Model;

class Negocio extends Model
{
    protected $table = 'negocios';
    protected $primaryKey = 'idnegocio';
    protected $allowedFields = [
        'idcategoria', 'idrepresentante', 'nombre', 'nombrecomercial',
        'slogan', 'ruc', 'logo', 'banner'
    ];

    /**
     * Obtener todos los negocios ordenados por promedio de valoración y cantidad de comentarios
     */
  public function getNegociosOrdenados()
{
    return $this->db->table('negocios n')
        ->select('
            n.idnegocio,
            n.nombre AS negocio,
            n.logo,
            IFNULL(AVG(c.valoracion), 0) AS promedio_valoracion,
            COUNT(c.idcomentario) AS cantidad_comentarios
        ')
        ->join('locales l', 'l.idnegocio = n.idnegocio', 'left')
        ->join('comentarios c', 'c.idlocales = l.idlocales', 'left')
        ->groupBy('n.idnegocio, n.nombre, n.logo')
        ->orderBy('promedio_valoracion', 'DESC')
        ->orderBy('cantidad_comentarios', 'DESC')
        ->get()
        ->getResultArray();
    }

}


