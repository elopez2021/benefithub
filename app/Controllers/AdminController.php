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
}
