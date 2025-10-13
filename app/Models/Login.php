<?php

namespace App\Models;

use CodeIgniter\Model;

class Login extends Model
{
    protected $table = 'usuarios_login';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'apellido',
        'email',
        'password',
        'fecha_registro'
    ];

    // No se usan timestamps automáticos porque ya tienes fecha_registro
    protected $useTimestamps = false;
}
