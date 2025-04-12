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
                'status'        => 'pending',
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


}
