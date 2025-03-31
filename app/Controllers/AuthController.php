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

    public function checkSession()
    {
        return $this->respond([
            'user_id' => session()->get('user_id'),
            'role_id' => session()->get('role_id'),
            'username' => session()->get('username'),
            'full_session' => session()->get() // Debugging full session data
        ]);
    }


    public function register()
    {
        $data = $this->request->getJSON(true); // <-- Now available in both try and catch
        
        // Validate input
        if (!isset($data['username']) || !isset($data['password']) || !isset($data['role_id'])) {
            return $this->fail('Usuario, contraseña y rol son requeridos', 400);
        }
        
        // Create user
        $userModel = new UserModel();
        
        try {
            $userData = [
                'username' => $data['username'],
                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                'role_id'  => $data['role_id']
            ];
            
            $userId = $userModel->insert($userData);
            
            return $this->respondCreated([
                'status' => 'success',
                'user_id' => $userId,
                'new_csrf_token' => csrf_hash()
            ]);
            
        } catch (\Exception $e) {
            return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'Database insert failed',
                        'data'    => $data, // Now works!
                        'error'   => $e->getMessage()
                    ]);
        }
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