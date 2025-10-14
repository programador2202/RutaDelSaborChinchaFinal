<?php

namespace App\Controllers;

use App\Models\Login;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    public function login()
    {
        helper(['form']);
        return view('login/Login');
    }

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
                'apellido'  => $user['apellido'],
                'email'     => $user['email'],
                'logged_in' => true
            ]);

            $redirectUrl = $session->get('redirect_url');

            if ($redirectUrl) {
                $session->remove('redirect_url');
                return redirect()->to($redirectUrl);
            }

            return redirect()->to(base_url('/categorias'));
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Correo o contraseña incorrectos.');
    }

    public function register()
    {
        helper(['form']);
        return view('login/Registro');
    }

    public function registerPost()
    {
        helper(['form']);
        $model = new Login();

        $email = $this->request->getPost('email');
        $existingUser = $model->where('email', $email)->first();

        if ($existingUser) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ El correo ya está registrado.');
        }

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

    public function logout()
    {
        $session = session();
        $redirectUrl = $session->get('redirect_url');
        $session->destroy();

        if ($redirectUrl) {
            $session->remove('redirect_url');
            return redirect()->to($redirectUrl);
        }

        return redirect()->to('/');
    }
}
