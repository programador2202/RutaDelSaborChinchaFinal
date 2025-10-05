<?php

namespace App\Models;

use CodeIgniter\Model;

class Contrato extends Model
{
    protected $table = 'contratos';
    protected $primaryKey = 'idcontrato';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'idusuario',
        'idnegocio',
        'fechainicio',
        'fechafin',
        'inversion'
    ];
}
