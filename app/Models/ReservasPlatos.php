<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservasPlatos extends Model
{
    protected $table      = 'reservas_platos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'idreserva',
        'idcarta',
        'cantidad',
        'observacion'
    ];

    /**
     * Obtiene los platos de reservas confirmadas
     */
    public function obtenerPlatosConfirmados()
    {
        return $this->select("
                reservas_platos.id,
                reservas.idreserva,
                reservas.fechahora,
                reservas.confirmacion,
                usuarios_login.nombre AS nombre_cliente,
                usuarios_login.apellido AS apellido_cliente,
                negocios.nombre AS nombre_negocio,
                cartas.nombreplato,
                cartas.precio,
                reservas_platos.cantidad,
                reservas_platos.observacion
            ")
            ->join('reservas', 'reservas.idreserva = reservas_platos.idreserva')
            ->join('cartas', 'cartas.idcarta = reservas_platos.idcarta')
            ->join('locales', 'locales.idlocales = reservas.idlocales')
            ->join('negocios', 'negocios.idnegocio = locales.idnegocio')
            ->join('usuarios_login', 'usuarios_login.id = reservas.idpersonasolicitud')
            ->where('reservas.confirmacion', 'confirmado')
            ->orderBy('reservas.fechahora', 'DESC')
            ->findAll();
    }
}
