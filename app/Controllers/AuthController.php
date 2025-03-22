<?php

namespace App\Controllers;
use App\Models\UserModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use \Config\Services;

class AuthController extends ResourceController
{
    public function login()
    {
        $model = new UserModel();
        $request = service('request');

        $json = $request->getJSON();

        // Validate JSON input
        if (empty($json) || !isset($json->username) || !isset($json->password)) {
            return $this->respond([
                'success' => false,
                'message' => 'Usuario y contraseña son requeridos',
            ], 400);
        }

        // Extract username and password from JSON
        $username = $json->username;
        $password = $json->password;


        // Fetch user from the database
        $user = $model->getUserByUsername($username);

        // Validate credentials
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->respond([
                'success' => false,
                'message' => 'El usuario o la contraseña son incorrectos',
            ], 401);
        }

        // Return success response
        
        session()->set('user_id', $user['id']);
        session()->set('role_id', $user['role_id']);
        session()->set('username', $user['username']);
        
        
        return $this->respond([
            'success' => true,
            'message' => 'Inicio de sesión exitoso',
            'role_id' => $user['role_id'], // Send role_id to frontend for redirection (optional)
        ]);
    }

    public function redirect()
    {
        $roleId = $this->request->getGet('role_id');

        switch ($roleId) {
            case 1:
                return redirect()->to(site_url('admin/dashboard'));
            case 2:
                return redirect()->to(site_url('employee/dashboard'));
            case 3:
                return redirect()->to(site_url('business/dashboard'));
            default:
                return redirect()->to(site_url('login'))->with('error', 'Rol de usuario desconocido.');
        }
    }



    public function logout()
    {
        // Destroy the session
        session()->destroy();
        
        // Redirect to login page
        return redirect()->to(base_url('login'));
    }



}

/*

2. Hash Password Before Storing
Modify your registration logic to hash passwords:

php
Copiar
Editar
$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

*/