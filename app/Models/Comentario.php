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
                    ->select('comentarios.*, usuarios_login.nombre AS nombre_usuario, usuarios_login.apellido, negocios.nombre AS nombre_local')
                    ->join('usuarios_login', 'usuarios_login.id = comentarios.tokenusuario')
                    ->join('locales', 'locales.idlocales = comentarios.idlocales')
                    ->join('negocios', 'negocios.idnegocio = locales.idnegocio')
                    ->get()
                    ->getResultArray();
    }
}
