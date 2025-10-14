<?php

namespace App\Models;

use CodeIgniter\Model;

class Comentario extends Model
{
    protected $table            = 'comentarios';
    protected $primaryKey       = 'idcomentario';
    protected $allowedFields    = ['idlocales', 'tokenusuario', 'comentario', 'valoracion'];
    protected $useTimestamps    = false;




   public function obtenerComentariosConUsuario()
    {
        return $this->db->table($this->table)
                        ->select('comentarios.*, usuarios_login.nombre, usuarios_login.apellido')
                        ->join('usuarios_login', 'usuarios_login.id = comentarios.tokenusuario')
                        ->get()
                        ->getResultArray();
    }


}
