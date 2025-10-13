<?php

namespace App\Controllers;

use App\Models\Login;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    // 👉 Mostrar formulario de login
    public function login()
    {
        helper(['form']);
        return view('login/Login');
    }

    // 👉 Procesar inicio de sesión
    public function loginPost()
    {
        $session = session();
        $model = new Login();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id'   => $user['id'],
                'nombre'    => $user['nombre'],
                'email'     => $user['email'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Correo o contraseña incorrectos.');
        }
    }

    // 👉 Mostrar formulario de registro
    public function register()
    {
        helper(['form']);
        return view('login/Registro');
    }

    // 👉 Procesar registro
    public function registerPost()
    {
        helper(['form']);
        $model = new Login();

        $email = $this->request->getPost('email');
        $existingUser = $model->where('email', $email)->first();

        // Verificar si ya existe
        if ($existingUser) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'El correo ya está registrado.');
        }

        // Insertar nuevo usuario
        $data = [
            'nombre'    => $this->request->getPost('nombre'),
            'apellido'  => $this->request->getPost('apellido'),
            'email'     => $email,
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        if ($model->insert($data)) {
            return redirect()
                ->to('login')
                ->with('success', '✅ Registro exitoso. Ahora puedes iniciar sesión.');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Ocurrió un error al registrarte. Inténtalo nuevamente.');
        }
    }

    // 👉 Cerrar sesión
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
