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
      // Cargar modelo
        $comentarioModel = new Comentario();

// Usar método personalizado para obtener comentarios con datos de usuario
        $comentariosConUsuarios = $comentarioModel->select('comentarios.*, usuarios_login.nombre, usuarios_login.apellido')
            ->join('usuarios_login', 'usuarios_login.id = comentarios.tokenusuario')
            ->join('locales', 'locales.idlocales = comentarios.idlocales')
            ->where('locales.idnegocio', $idnegocio)
            ->orderBy('comentarios.fechahora', 'DESC')
            ->paginate(5); // 🔹 5 por página

        $pager = $comentarioModel->pager;

        // Calcular promedio de valoraciones
        $promedio = 0;
        if (!empty($comentariosConUsuarios)) {
            $suma = 0;
            foreach ($comentariosConUsuarios as $comentario) {
                $suma += (int)$comentario['valoracion'];
            }
            $promedio = $suma / count($comentariosConUsuarios);
        }

        // Datos a enviar a la vista
        $data = [
            'negocio'     => $negocio,
            'comentarios' => $comentariosConUsuarios,
            'pager'       => $pager,
            'promedio'    => $promedio,
            'header'      => view('Layouts/header'),
            'footer'      => view('Layouts/footer'),
            'carrito'    => view('Layouts/carrito'),
        ];

        return view('PaginaPrincipal/Recursos', $data);

         }
    }
