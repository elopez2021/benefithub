<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RestaurantModel;

use App\Models\CategoryModel;
use App\Models\ScheduleModel;



class RestaurantController extends BaseController
{
    public function index()
    {
        $productoModel = new \App\Models\ProductsModel();
        $userId = session()->get('user_id');

        $restaurant = (new \App\Models\RestaurantModel())
            ->where('user_id', $userId)
            ->first();

        if (!$restaurant) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Restaurante no encontrado.']);
        }

        $productos = $productoModel
            ->select('products.*, 
                GROUP_CONCAT(restaurant_categories.id) AS category_ids, 
                GROUP_CONCAT(restaurant_categories.name) AS category_names, 
                GROUP_CONCAT(restaurant_categories.description) AS category_descriptions')
            ->join('product_category', 'product_category.product_id = products.id')
            ->join('restaurant_categories', 'restaurant_categories.id = product_category.category_id')
            ->where('products.restaurant_id', $restaurant['id'])
            ->groupBy('products.id')
            ->orderBy('products.created_at', 'DESC')
            ->findAll();

        

        
        $categories = (new CategoryModel())
            ->where('restaurant_id', $restaurant['id'])
            ->findAll();

        return view('dashboard/restaurants/index', ['productos' => $productos, 'categories' => $categories]);
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
   
    public function categories()
    {
        $user_id = session()->get('user_id'); 


        $categoryModel = new CategoryModel();
        $restaurantModel = new \App\Models\RestaurantModel();

        $restaurant = $restaurantModel->where('user_id', $user_id)->first();

        $restaurantId = $restaurant['id']; 
       
        // Obtener las categorías del restaurante
        $categories = $categoryModel->select('restaurant_categories.*')
        ->join('restaurants', 'restaurants.id = restaurant_categories.restaurant_id', 'inner')
        ->where('restaurant_categories.restaurant_id', $restaurantId)
        ->orderBy('restaurant_categories.created_at', 'DESC')
        ->findAll(); // ¡Esto faltaba!

        $validCategories = [];

        foreach ($categories as $category) {
            if (is_array($category) && isset($category['id'])) {
                $schedules = $categoryModel->getSchedules($category['id']); // Método que tú definiste
                $category['schedules'] = empty($schedules) ? [] : $schedules;
                $validCategories[] = $category;
            }
        }

        $data = [
        'categories' => $validCategories
        ];

        return view('dashboard/restaurants/category', $data);
    }
    public function schedule()
    {
        $user_id = session()->get('user_id'); 


        $model = new ScheduleModel();

       
        $categories = $model->select('restaurant_categories.*, restaurants.name AS restaurant_name')
                            ->join('restaurants', 'restaurants.id = restaurant_categories.restaurant_id', 'inner')
                            ->where('restaurant_categories.restaurant_id', $user_id) // Filter by restaurant_id
                            ->orderBy('restaurant_categories.created_at', 'DESC');
        return view('dashboard/restaurants/schedule');
    }
}
