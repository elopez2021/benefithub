<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BusinessModel;

class AdminController extends BaseController
{
    public function index()
    {    
        
        $model = new BusinessModel();
        
        $data = $model->getAllBusinesses();
        $totalBusinesses = $model->countAll();
        
        return view('dashboard/admin/index', ['businesses' => $data, 'totalBusinesses' => $totalBusinesses]);
    }
    
    public function showBusiness()
    {
        $model = new BusinessModel();
    
        // Configurar paginación (10 registros por página)
        $data = [
            'businesses' => $model->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $model->pager
        ];
        
        return view('dashboard/admin/business', $data);
    }
}
