<?php

namespace App\Models;

use CodeIgniter\Model;

class Horario extends Model
{
    protected $table      = 'horarios';
    protected $primaryKey = 'idhorario';

    protected $allowedFields = [
        'idlocales',
        'diasemana',
        'inicio',
        'fin'
    ];
}
