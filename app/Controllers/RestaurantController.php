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
}
