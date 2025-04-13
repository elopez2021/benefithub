<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmployeeModel;
use App\Models\RestaurantModel;
use App\Models\BusinessModel;
use App\Models\ProductsModel;
use App\Models\CategoryModel;
use App\Models\ProductCategoryModel;
use App\Models\ScheduleModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\UserModel;

class EmployeeController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->where('user_id', $userId)->first();

        $restaurantModel = new RestaurantModel();
        $restaurants = $restaurantModel->where('active', true)->findAll();
        
        return view('dashboard/employee/index', [
            'employee' => $employee,
            'restaurants' => $restaurants
        ]);

    
    }

    public function showMenu($restaurantId)
    {

        $userId = session()->get('user_id'); 
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->where('user_id', $userId)->first();

        // Set Santo Domingo timezone
        date_default_timezone_set('America/Santo_Domingo');

        // Get current time and day
        $currentTime = date('H:i:s');
        $currentDay = strtolower(date('l'));
        $currentDay = match ($currentDay) {
            'monday' => 'lunes',
            'tuesday' => 'martes',
            'wednesday' => 'miércoles',
            'thursday' => 'jueves',
            'friday' => 'viernes',
            'saturday' => 'sábado',
            'sunday' => 'domingo',
        };

        // Load models
        $restaurantModel = new RestaurantModel();
        $categoryModel = new CategoryModel();
        $productModel = new ProductsModel();
        $scheduleModel = new ScheduleModel();
        $productCategoryModel = new ProductCategoryModel();

        // Get restaurant data
        $restaurant = $restaurantModel->find($restaurantId);
        if (!$restaurant) {
            return redirect()->back()->with('error', 'Restaurante no encontrado');
        }

        // Get available schedules for current day and time
        $availableSchedules = $scheduleModel
            ->where('day_of_week', $currentDay)
            ->where('start_time <=', $currentTime)
            ->where('end_time >=', $currentTime)
            ->findAll();

        $availableCategoryIds = array_column($availableSchedules, 'category_id');
        $categorySchedules = array_column($availableSchedules, null, 'category_id');

        // Get available categories (only if there are valid category IDs)
        $categories = [];
        if (!empty($availableCategoryIds)) {
            $categories = $categoryModel
                ->where('restaurant_id', $restaurantId)
                ->whereIn('id', $availableCategoryIds)
                ->findAll();
        }

        // Get all active products for this restaurant
        $products = $productModel
            ->where('restaurant_id', $restaurantId)
            ->where('active', 1)
            ->findAll();

        // Prepare products with their available categories
        $productsWithCategories = [];
        foreach ($products as $product) {
            $productCategories = [];

            if (!empty($availableCategoryIds)) {
                $productCategories = $productCategoryModel
                    ->select('restaurant_categories.*')
                    ->join('restaurant_categories', 'restaurant_categories.id = product_category.category_id')
                    ->where('product_category.product_id', $product['id'])
                    ->whereIn('restaurant_categories.id', $availableCategoryIds)
                    ->findAll();
            }

            if (!empty($productCategories)) {
                $productsWithCategories[] = [
                    'product' => $product,
                    'categories' => $productCategories
                ];
            }
        }

        // Group products by their first category for display
        $groupedProducts = [];
        foreach ($productsWithCategories as $productData) {
            $firstCategory = $productData['categories'][0]['name'] ?? 'General';
            if (!isset($groupedProducts[$firstCategory])) {
                $groupedProducts[$firstCategory] = [];
            }
            $groupedProducts[$firstCategory][] = $productData;
        }

        return view('dashboard/employee/menu', [
            'restaurant' => $restaurant,
            'categories' => $categories,
            'groupedProducts' => $groupedProducts,
            'subsidy_left_today' => $employee['subsidy_left_today'] ?? 0,
            'categorySchedules' => $categorySchedules,
            'currentTime' => $currentTime,
            'currentDay' => $currentDay,
            'restaurantId' => $restaurantId
        ]);

    }
        
    public function create()
    {
        $model = new \App\Models\EmployeeModel();
        $request = service('request');
        $data = $request->getJSON(true);

        $user_id = session()->get('user_id'); 


        $businessModel = new BusinessModel();

        $business = $businessModel->where('user_id', $user_id)->first();

        $business_subsidy = $business['daily_subsidy'] ?? null;
        
        $data['subsidy_left_today'] = $business_subsidy;

        try{
            if ($model->insert($data)) {
                return $this->response->setStatusCode(200)->setJSON(['message' => 'Empleado creado con éxito.', 'status' => true]);
            } else {
                return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)->setJSON(['message' => 'Error al crear el empleado.', 'errors' => $model->errors(), 'data' => $data]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)->setJSON(['message' => 'Error interno del servidor.', 'error' => $e->getMessage(), 'data' => $data]);
        }        
    }




    public function place_order()
    {
        $request = service('request');
        $data = $request->getJSON(true);

        $userId = session()->get('user_id'); 
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->where('user_id', $userId)->first();

        if (!$employee) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setJSON(['message' => 'Empleado no encontrado.']);
        }

        

        $orderModel = new OrderModel();
        $orderDetailModel = new OrderItemModel();
        $productModel = new ProductsModel();

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            
            $orderData = [
                'employee_id'   => $employee['id'],
                'restaurant_id' => $data['restaurant_id'],
                'subtotal'      => 0, // Se calcula abajo
                'total'         => $data['total'],
                'status'        => 'processing',
            ];


            $orderModel->insert($orderData);
            $orderId = $orderModel->getInsertID();

            $subtotal = 0;
            

            foreach ($data['items'] as $productId => $item) {
                $product = $productModel->find($productId);
            
                if (!$product) {
                    throw new \Exception("Producto con ID {$productId} no encontrado.");
                }
            
                $price = $product['price'];
                $qty = $item['quantity'];
                $itemSubtotal = $price * $qty;
                $subtotal += $itemSubtotal;
            
                $orderDetailModel->insert([
                    'order_id'   => $orderId,
                    'product_id' => $productId,
                    'quantity'   => $qty,
                    'price'      => $price,
                    'subtotal'   => $itemSubtotal
                ]);
            }
            

         
            $orderModel->update($orderId, ['subtotal' => $subtotal]);

            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON(['message' => 'Error al procesar la transacción.']);
            }

            // Actualizar el subsidio del empleado
            $employeeModel->update($employee['id'], [
                'subsidy_left_today' => max($employee['subsidy_left_today'] - $data['subtotal'], 0)
            ]);



            
            $db->transCommit();
            return $this->response->setStatusCode(200)
                ->setJSON(['message' => 'Orden creada con éxito.', 'status' => true]);

        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON([
                    'message' => 'Error interno del servidor.',
                    'error' => $e->getMessage()
                ]);
        }
    }


    public function profile()
    {
        $userId = session()->get('user_id');
        $username = session()->get('username');
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->where('user_id', $userId)->first();

        return view('dashboard/employee/profile', [
            'employee' => $employee,
            'username' => $username
        ]);
    }

    public function updateProfile()
    {

        $request = service('request');
        $data = $request->getJSON(true);

        try{
            // Get the user ID from the session
            $userId = session()->get('user_id');

            // Load the Employee model and fetch the employee data by the user ID
            $employeeModel = new EmployeeModel();
            $employee = $employeeModel->where('user_id', $userId)->first();

            // Check if the employee exists
            if (!$employee) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                    ->setJSON(['message' => 'Empleado no encontrado.']);
            }

               

            // Ensure the username is part of the input data and exists in the users table
            if (isset($data['username'])) {
                // Validate if the username already exists in the 'users' table
                $userModel = new UserModel();
                $existingUser = $userModel->where('username', $data['username'])->first();

                if ($existingUser && $existingUser['id'] != $employee['user_id']) {
                    return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                        ->setJSON(['message' => 'El nombre de usuario ya está en uso.']);
                }
            }

            // Update the employee information
            if ($employeeModel->update($employee['id'], $data)) {
                // If the employee data is updated successfully, update the username in the 'users' table as well
                if (isset($data['username'])) {
                    $userModel = new UserModel();
                    $userData = [
                        'username' => $data['username']
                    ];
                    $userModel->update($employee['user_id'], $userData);
                }

                return $this->response->setStatusCode(200)
                    ->setJSON(['message' => 'Perfil actualizado con éxito.', 'status' => true]);
            } else {
                return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                    ->setJSON(['message' => 'Error al actualizar el perfil.', 'errors' => $employeeModel->errors()]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['message' => 'Error interno del servidor.', 'error' => $e->getMessage(), 'data' => $data]);	
        }
        
    }

    public function changePassword()
    {
        $userId = session()->get('user_id');
        $request = service('request');
        $userModel = new UserModel(); // Assuming you have a UserModel for managing user data
        $user = $userModel->find($userId);

        if (!$user) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setJSON(['message' => 'Usuario no encontrado.']);
        }

        // Get the data from the request
        $data = $request->getJSON(true);

        // Validate the current password
        if (!password_verify($data['current_password'], $user['password'])) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                ->setJSON(['message' => 'La contraseña actual es incorrecta.']);
        }

        
        // Hash the new password
        $newPasswordHash = password_hash($data['new_password'], PASSWORD_BCRYPT);

        // Update the password in the database
        $userModel->update($userId, ['password' => $newPasswordHash]);

        return $this->response->setStatusCode(200)
            ->setJSON(['message' => 'Contraseña cambiada con éxito.', 'status' => true]);
    }

    public function orders()
    {
        $userId = session()->get('user_id');
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->where('user_id', $userId)->first();

        if (!$employee) {
            return redirect()->back()->with('error', 'Empleado no encontrado');
        }

        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $restaurantModel = new RestaurantModel();

        
        $orders = $orderModel->select('orders.*, restaurants.commercial_name as restaurant_name')
                            ->join('restaurants', 'restaurants.id = orders.restaurant_id')
                            ->where('employee_id', $employee['id'])
                            ->orderBy('created_at', 'DESC')
                            ->findAll();

        
                            
        foreach ($orders as &$order) {
            $order['items'] = $orderItemModel->select('order_items.*, products.name as product_name')
                                        ->join('products', 'products.id = order_items.product_id')
                                        ->where('order_id', $order['id'])
                                        ->findAll();
            
          
            $order['formatted_date'] = date('d/m/Y', strtotime($order['created_at']));
            $order['formatted_time'] = date('h:i A', strtotime($order['created_at']));
        }

        return view('dashboard/employee/orders', [
            'orders' => $orders
        ]);
    }

}
