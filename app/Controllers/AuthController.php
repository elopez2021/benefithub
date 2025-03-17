<?php

namespace App\Controllers;
use App\Models\UserModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

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

        // Generate token (simple example)
        $token = bin2hex(random_bytes(32));
        $model->update($user['id'], ['token' => $token]);

        // Return success response
        return $this->respond([
            'success' => true,
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => [
                'id'       => $user['id'],
                'username' => $user['username'],
                'role_id'  => $user['role_id'],
            ],
        ]);
    }


    public function logout()
    {
        // Destroy the session (if using session-based authentication)
        session()->destroy();

        // If using token-based authentication, invalidate the token
        $userId = session()->get('user_id'); // Or get the user ID from the token
        if ($userId) {
            $model = new \App\Models\UserModel();
            $model->update($userId, ['token' => null]); // Invalidate the token
        }

        // Redirect to the login page or home page
        return redirect()->to(site_url('login'))->with('message', 'Has cerrado sesión correctamente.');
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