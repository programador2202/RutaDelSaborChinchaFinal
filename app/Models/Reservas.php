<?php

namespace App\Models;

use CodeIgniter\Model;

class Reservas extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'idreserva';

    protected $allowedFields = [
        'idhorario',
        'idlocales',
        'fechahora',
        'cantidadpersonas',
        'confirmacion',
        'idusuariovalida',
        'idpersonasolicitud'
    ];

    protected $useTimestamps = false;

    // Obtener reservas con datos de usuario y local
    public function obtenerReservasConDetalles()
    {
        return $this->select('
                    reservas.*, 
                    locales.nombre AS nombre_local,
                    solicitante.nombre AS solicitante_nombre, 
                    solicitante.apellido AS solicitante_apellido, 
                    validador.nombre AS validador_nombre, 
                    validador.apellido AS validador_apellido
                ')
                ->join('usuarios_login AS solicitante', 'reservas.idpersonasolicitud = solicitante.id')
                ->join('usuarios_login AS validador', 'reservas.idusuariovalida = validador.id', 'left')
                ->join('locales', 'reservas.idlocales = locales.idlocales')
                ->orderBy('reservas.fechahora', 'DESC')
                ->findAll();
    }
}
