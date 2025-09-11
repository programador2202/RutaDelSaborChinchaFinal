<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
         //Solicitar las secciones: HEADER+FOOTER
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('PaginaPrincipal/Principal', $datos); //HTML personalizado

    }

    public function nosotros(): string
    {
         //Solicitar las secciones: HEADER+FOOTER
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('PaginaPrincipal/Nosotros', $datos); //HTML personalizado

    }

    public function categorias(): string
    {
         //Solicitar las secciones: HEADER+FOOTER
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('PaginaPrincipal/Categorias', $datos); //HTML personalizado

    }

    public function admin(): string
    {
       
        $datos['footer'] = view('Layouts/footer');

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('admin/dashboard', $datos); //HTML personalizado
}
}