<?php

namespace App\Models;

use CodeIgniter\Model;

class Locales extends Model
{
    protected $table            = 'locales';
    protected $primaryKey       = 'idlocales';
    protected $allowedFields    = [
        'idnegocio',
        'iddistrito',
        'direccion',
        'telefono',
        'latitud',
        'longitud'
    ];
}
