<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmployeeModel;
use App\Models\RestaurantModel;

class EmployeeController extends BaseController
{
    public function index()
    {
        return view('dashboard/employee/index');
    }
    
    public function create()
    {
        $model = new \App\Models\EmployeeModel();
        $request = service('request');
        $data = $request->getJSON(true);

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
}
