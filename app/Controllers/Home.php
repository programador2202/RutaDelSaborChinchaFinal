<?php

namespace App\Controllers;
use App\Models\Negocio;
use App\Models\Categorias;
class Home extends BaseController
{
     public function index()
    {
        // Instancia del modelo
        $negocioModel = new Negocio();

        // Obtener los negocios ordenados por valoración y cantidad de comentarios
        $negociosDestacados = $negocioModel->getNegociosOrdenados();

        // Solicitar las secciones: HEADER + FOOTER + DINÁMICA
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');
        $datos['chatbox'] = view('Layouts/chatbox');

        // Pasar también los negocios a la vista principal
        $datos['negociosDestacados'] = $negociosDestacados;

        // Cargar la vista principal personalizada
        return view('PaginaPrincipal/Principal', $datos);
    }

    public function nosotros()
    {
         //Solicitar las secciones: HEADER+FOOTER
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('PaginaPrincipal/Nosotros', $datos); //HTML personalizado

    }

    public function categorias()
    {
        $negocioModel   = new Negocio();
        $categoriaModel = new Categorias();

        // Obtener todos los negocios con su categoría
        $data['negocios'] = $negocioModel
            ->select('negocios.*, categorias.categoria')
            ->join('categorias', 'categorias.idcategoria = negocios.idcategoria')
            ->orderBy('categorias.categoria', 'ASC')
            ->orderBy('negocios.nombre', 'ASC')
            ->findAll();

        // Si además quieres la lista de categorías (opcional)
        $data['categorias'] = $categoriaModel
            ->orderBy('categoria', 'ASC')
            ->findAll();

        // Header y footer
        $data['header'] = view('layouts/header');
        $data['footer'] = view('layouts/footer');

        return view('PaginaPrincipal/Categoria', $data);

    }

    public function admin()
    {
       
        $datos['footer'] = view('Layouts/footer');

        

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('admin/dashboard', $datos); //HTML personalizado
}

    


  
}