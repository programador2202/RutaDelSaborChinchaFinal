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
        $usuarioModel = new Login();
        $negocioModel = new Negocio();
        $localModel = new Locales();
        $cartasModel = new Cartas();
        $contratoModel = new Contrato();

        // Filtros GET
        $filtroLocal = $this->request->getGet('local') ?? '';
        $filtroNegocio = $this->request->getGet('negocio') ?? '';
        $filtroUsuario = $this->request->getGet('usuario') ?? '';

        // Comentarios con filtros
        $comentariosQuery = $comentarioModel->db->table('comentarios c')
            ->select('c.*, u.nombre AS nombre_usuario, u.apellido, n.nombre AS nombre_local, l.idlocales')
            ->join('usuarios_login u', 'u.id = c.tokenusuario')
            ->join('locales l', 'l.idlocales = c.idlocales')
            ->join('negocios n', 'n.idnegocio = l.idnegocio');

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

        // Contratos próximos a vencer (30 días)
        $contratosProximos = $contratoModel
            ->where('fechafin <=', date('Y-m-d', strtotime('+30 days')))
            ->findAll();

        // Estadísticas de cartas por local
        $cartasPorLocal = $cartasModel->db->table('cartas c')
            ->select('l.idlocales, n.nombre AS nombre_local, COUNT(c.idcarta) AS total_cartas')
            ->join('locales l', 'l.idlocales = c.idlocales')
            ->join('negocios n', 'n.idnegocio = l.idnegocio')
            ->groupBy('l.idlocales')
            ->get()
            ->getResultArray();

        // Array de datos para la vista
       $data = [
                'header'      => view('admin/dashboard'),
                'titulo' => 'Panel de Control',
                'total_usuarios' => $usuarioModel->countAll(),
                'total_negocios' => $negocioModel->countAll(),
                'total_locales' => $localModel->countAll(),
                'total_comentarios' => $comentarioModel->countAll(),
                'comentarios' => $comentarios,
                'contratosProximos' => $contratosProximos,
                'cartasPorLocal' => $cartasPorLocal,
                'locales' => $localModel->findAll(),
                'negocios' => $negocioModel->findAll(),
                'usuarios' => $usuarioModel->findAll(),
                'filtroNegocio' => $filtroNegocio,
                'filtroLocal' => $filtroLocal,
                'filtroUsuario' => $filtroUsuario
            ];


        return view('admin/recursos/dashboard', $data);
    }
}
