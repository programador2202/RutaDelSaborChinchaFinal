<?php

namespace App\Controllers;

use App\Models\Comentario;
use App\Models\Login;
use App\Models\Negocio;
use App\Models\Locales;
use App\Models\Cartas;
use App\Models\Contrato;

class DashboardController extends BaseController
{
 public function index()
{
    // Modelos
    $comentarioModel = new Comentario();
    $usuarioModel    = new Login();
    $negocioModel    = new Negocio();
    $localModel      = new Locales();
    $cartasModel     = new Cartas();
    $contratoModel   = new Contrato();

    // Datos de sesión
    $nivel     = session()->get('nivelacceso');
    $idpersona = session()->get('idpersona'); // id del representante

    // Filtros GET
    $filtroLocal   = $this->request->getGet('local') ?? '';
    $filtroNegocio = $this->request->getGet('negocio') ?? '';
    $filtroUsuario = $this->request->getGet('usuario') ?? '';

    // ----------------------------------------
    // Comentarios con filtros
    // ----------------------------------------
    $comentariosQuery = $comentarioModel->db->table('comentarios c')
        ->select('c.*, u.nombre AS nombre_usuario, u.apellido, n.nombre AS nombre_local, l.idlocales')
        ->join('usuarios_login u', 'u.id = c.tokenusuario')
        ->join('locales l', 'l.idlocales = c.idlocales')
        ->join('negocios n', 'n.idnegocio = l.idnegocio');

    if ($nivel === 'representante') {
        $comentariosQuery->where('n.idrepresentante', $idpersona);
    }
    if ($filtroLocal) {
        $comentariosQuery->where('l.idlocales', $filtroLocal);
    }
    if ($filtroNegocio) {
        $comentariosQuery->where('n.idnegocio', $filtroNegocio);
    }
    if ($filtroUsuario) {
        $comentariosQuery->where('u.id', $filtroUsuario);
    }

    $comentarios = $comentariosQuery->get()->getResultArray();

    // ----------------------------------------
    // Contratos próximos a vencer (30 días)
    // ----------------------------------------
    $contratosQuery = $contratoModel->orderBy('fechafin', 'ASC');
    if ($nivel === 'representante') {
        // Solo contratos de sus negocios
        $contratosQuery->whereIn('idnegocio', function($builder) use ($idpersona) {
            $builder->select('idnegocio')
                    ->from('negocios')
                    ->where('idrepresentante', $idpersona);
        });
    }
    $contratosProximos = $contratosQuery
        ->where('fechafin <=', date('Y-m-d', strtotime('+30 days')))
        ->findAll();

    // ----------------------------------------
    // Estadísticas de cartas por local
    // ----------------------------------------
    $cartasQuery = $cartasModel->db->table('cartas c')
        ->select('l.idlocales, n.nombre AS nombre_local, COUNT(c.idcarta) AS total_cartas')
        ->join('locales l', 'l.idlocales = c.idlocales')
        ->join('negocios n', 'n.idnegocio = l.idnegocio');

    if ($nivel === 'representante') {
        $cartasQuery->where('n.idrepresentante', $idpersona);
    }

    $cartasPorLocal = $cartasQuery
        ->groupBy('l.idlocales')
        ->get()
        ->getResultArray();

    // ----------------------------------------
    // Locales y negocios filtrados según nivel
    // ----------------------------------------
    if ($nivel === 'representante') {
        $datosNegocios = $negocioModel->where('idrepresentante', $idpersona)->findAll();
        $negociosIds   = array_column($datosNegocios, 'idnegocio');

        $datosLocales = $localModel->whereIn('idnegocio', $negociosIds)->findAll();

        // Contar totales filtrados
        $totalNegocios    = count($datosNegocios);
        $totalLocales     = count($datosLocales);
        $totalComentarios = count($comentarios);

        $datosUsuarios    = $usuarioModel->findAll(); // usuarios se pueden ver completos

    } else {
        $datosNegocios    = $negocioModel->findAll();
        $datosLocales     = $localModel->findAll();
        $datosUsuarios    = $usuarioModel->findAll();
        $totalNegocios    = $negocioModel->countAll();
        $totalLocales     = $localModel->countAll();
        $totalComentarios = $comentarioModel->countAll();
    }

    // ----------------------------------------
    // Preparar datos para la vista
    // ----------------------------------------
    $data = [
        'header'            => view('admin/dashboard'),
        'titulo'            => 'Panel de Control',
        'total_usuarios'    => count($datosUsuarios),
        'total_negocios'    => $totalNegocios,
        'total_locales'     => $totalLocales,
        'total_comentarios' => $totalComentarios,
        'comentarios'       => $comentarios,
        'contratosProximos' => $contratosProximos,
        'cartasPorLocal'    => $cartasPorLocal,
        'locales'           => $datosLocales,
        'negocios'          => $datosNegocios,
        'usuarios'          => $datosUsuarios,
        'filtroNegocio'     => $filtroNegocio,
        'filtroLocal'       => $filtroLocal,
        'filtroUsuario'     => $filtroUsuario
    ];

    return view('admin/recursos/dashboard', $data);
    }
}