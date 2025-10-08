<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Negocio;
use App\Models\Cartas;
use App\Models\Comentario;

class DetalleController extends BaseController
{
    public function detalle($idnegocio)
    {
        $negocioModel = new Negocio();
        $cartasModel  = new Cartas();
        $comentarioModel = new Comentario();

        // Día actual
        $diaSemana = date('N');

        //Obtener datos del negocio
        $negocio = $negocioModel
            ->select('
                negocios.*,
                categorias.categoria,
                personas.nombres,
                personas.apellidos,
                locales.idlocales,
                locales.direccion,
                locales.telefono,
                locales.latitud,
                locales.longitud,
                horarios.inicio,
                horarios.fin
            ')
            ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
            ->join('personas', 'personas.idpersona = negocios.idrepresentante')
            ->join('locales', 'locales.idnegocio = negocios.idnegocio')
            ->join('horarios', 'horarios.idlocales = locales.idlocales AND horarios.diasemana = ' . $diaSemana, 'left')
            ->where('negocios.idnegocio', $idnegocio)
            ->first();

        //Estado (abierto o cerrado)
        $estado = 'Cerrado';
        $horaActual = date('H:i:s');
        if (!empty($negocio['inicio']) && !empty($negocio['fin'])) {
            if ($horaActual >= $negocio['inicio'] && $horaActual <= $negocio['fin']) {
                $estado = 'Abierto';
            }
        }
        $negocio['estado'] = $estado;

        //Platos del negocio
        $negocio['cartas'] = $cartasModel
            ->select('cartas.*, secciones.seccion AS nombre_seccion, locales.direccion AS direccion_local')
            ->join('secciones', 'secciones.idseccion = cartas.idseccion')
            ->join('locales', 'locales.idlocales = cartas.idlocales')
            ->where('locales.idnegocio', $idnegocio)
            ->orderBy('cartas.nombreplato', 'ASC')
            ->findAll();

        //Comentarios del negocio
       $comentarioModel->join('locales', 'locales.idlocales = comentarios.idlocales')
        ->where('locales.idnegocio', $idnegocio)
        ->orderBy('comentarios.fechahora', 'DESC');

        $comentarios = $comentarioModel->paginate(5); // 🔹 5 por página
        $pager = $comentarioModel->pager;

        //Calcular promedio de valoraciones
        $promedio = 0;
        if (!empty($comentarios)) {
            $suma = 0;
            foreach ($comentarios as $c) {
                $suma += (int)$c['valoracion'];
            }
            $promedio = $suma / count($comentarios);
        }

        // Datos a enviar a la vista
        $data = [
            'negocio'    => $negocio,
            'comentarios'=> $comentarios,
            'pager' =>$pager,
            'promedio'   => $promedio,
            'header'     => view('Layouts/header'),
            'footer'     => view('Layouts/footer'),
            'dinamica'   => view('Layouts/dinamica'),
        ];

        return view('PaginaPrincipal/Recursos', $data);
    }
}
