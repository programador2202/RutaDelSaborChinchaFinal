<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Filtro implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Si no está logueado
        if (!$session->get('logged_in')) {
            // Redirige al login con mensaje
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
      
    }
}
