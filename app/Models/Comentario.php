<?php

namespace App\Models;

use CodeIgniter\Model;

class Comentario extends Model
{
    protected $table            = 'comentarios';
    protected $primaryKey       = 'idcomentario';
    protected $allowedFields    = ['idlocales', 'tokenusuario', 'comentario', 'valoracion'];
    protected $useTimestamps    = false;
}
