<?php

namespace App\Models;

use CodeIgniter\Model;

class Cartas extends Model
{
    protected $table      = 'cartas';
    protected $primaryKey = 'idcarta';

    protected $allowedFields = [
        'idlocales',
        'idseccion',
        'nombreplato',
        'precio',
        'foto'
    ];
}
