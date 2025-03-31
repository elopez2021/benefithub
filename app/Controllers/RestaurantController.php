<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RestaurantModel;


class RestaurantController extends BaseController
{
    public function index()
    {
        //
    }

    public function create()
    {
        $model = new RestaurantModel();

        $request = service('request');
        
        $data = $request->getJSON(true);



        try {

            $restaurantId = $model->insert($data);

            if ($restaurantId) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'      => 'success',
                        'restaurant_id' => $restaurantId,
                        'message'     => 'Restaurante guardado satisfactoriamente'
                    ]);
            } else {

                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'Database insert failed',
                        'data'   => $data, // The data that was attempted to be inserted
                        'error'  => $model->errors() // Any DB-level errors
                    ]);
            }

        } catch (\Exception $e) {
            // Minimal error response
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Restaurant creation crashed',
                    'error'   => $e->getMessage() // No stack trace for production
                ]);
        }
    }
    
    public function update($id = null)
    {
        $restaurantModel = new RestaurantModel();
        
        // Get the input data
        $data = $this->request->getJSON(true);
        
        // Attempt update (model will handle validation)
        try {
            if ($restaurantModel->update($id, $data)) {
                
                // Update user credentials if provided
                if (isset($data['username']) || isset($data['password'])) {
                    $this->updateUserCredentials($restaurantModel->find($id)['user_id'], $data);
                }

                return $this->response
                ->setJSON([
                    'status' => 'success',
                    'message' => 'Restaurante actualizado satisfactoriamente',
                ]);
            }

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Database insert failed',
                    'error'   => $restaurantModel->errors()
                ]);
        
                           
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Restaurante update crashed',
                    'error'   => $e->getMessage() // No stack trace for production
                ]);

        }
    }

    protected function updateUserCredentials($userId, $data)
    {
        $userModel = new \App\Models\UserModel();
        $userData = [];
        
        if (isset($data['username'])) {
            $userData['username'] = $data['username'];
        }
        
        if (isset($data['password'])) {
            $userData['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        
        if (!empty($userData)) {
            $userModel->update($userId, $userData);
        }
    }
}
