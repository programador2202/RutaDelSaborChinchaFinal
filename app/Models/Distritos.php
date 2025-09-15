<?php

namespace App\Models;

use CodeIgniter\Model;

class Distritos extends Model
{
    protected $table            = 'distritos';
    protected $primaryKey       = 'iddistrito';
    protected $allowedFields    = ['distrito', 'idprovincia'];
}
