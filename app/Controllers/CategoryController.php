<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;
use App\Models\ScheduleModel;
use App\Models\RestaurantModel;

class CategoryController extends BaseController
{
    public function index()
    {
        //
    }

    public function create()
    {
        $categoriaModel = new CategoryModel();
        $scheduleModel = new ScheduleModel();

        $userId = session()->get('user_id');



        
        $data = $this->request->getJSON(true);

        $name = $data['name'] ?? null;
        $description = $data['description'] ?? null;
        $start_time = $data['start_time'] ?? null;
        $end_time = $data['end_time'] ?? null;
        $days = $data['days'] ?? [];

        if (!$name || !$start_time || !$end_time || empty($days)) {
            return $this->response->setStatusCode(400)->setJSON(['errors' => 'Datos incompletos.']);
        }

        try{

            $restaurantModel = new RestaurantModel();
            
            $restaurant = $restaurantModel
            ->where('user_id', $userId)
            ->first();
            
            // Save category
            $categoriaId = $categoriaModel->insert([
                'name' => $name,
                'description' => $description,
                'restaurant_id' => $restaurant['id'],
                'active' => 1,
            ]);

            if (!$categoriaId) {
                return $this->response->setStatusCode(500)->setJSON([
                    'error' => 'No se pudo guardar la categoría',
                    'db_error' => $categoriaModel->errors()
                ]);
            }
            

            // Save schedules for each selected day
            foreach ($days as $day) {
                $scheduleModel->insert([
                    'category_id' => $categoriaId,
                    'day_of_week' => $day,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                ]);
            }

            return $this->response->setStatusCode(200)->setJSON(['status' => 'success', 'category_id' => $categoriaId]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Error al guardar la categoría.', 'errors' => $e->getMessage(), 'db_error' => $categoriaModel->errors()]);
        }

        
    }
}

