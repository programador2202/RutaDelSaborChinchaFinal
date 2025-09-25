<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
         //Solicitar las secciones: HEADER+FOOTER
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('PaginaPrincipal/Principal', $datos); //HTML personalizado

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
         //Solicitar las secciones: HEADER+FOOTER
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('PaginaPrincipal/Categorias', $datos); //HTML personalizado

    }

    public function admin()
    {
       
        $datos['footer'] = view('Layouts/footer');

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('admin/dashboard', $datos); //HTML personalizado
}

    public function vitinicolas()
    {
        $datos['header']= view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        //retornamos la vista vitinicolas

        return view('PaginaPrincipal/vino',$datos);

    }
}