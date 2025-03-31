<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BusinessModel;
use App\Models\RestaurantModel;


class AdminController extends BaseController
{
    public function index()
    {    
        
        $model = new BusinessModel();
        $rmodel = new RestaurantModel();
        
        $data = $model->getAllBusinesses();
        $totalBusinesses = $model->countAll();
        $rdata = $rmodel->getAllRestaurants();

        $totalRestaurants = $rmodel->countAll();
        
        return view('dashboard/admin/index', ['businesses' => $data,'restaurants' => $rdata, 'totalBusinesses' => $totalBusinesses, 'totalRestaurants' => $totalRestaurants]);
    }
    
    public function showBusiness()
    {
        $model = new BusinessModel();
    
        // Configurar paginación (10 registros por página)
        $data = [
            'businesses' => $model->select('businesses.*, users.username AS username')
                          ->join('users', 'users.id = businesses.user_id', 'inner')
                          ->orderBy('businesses.created_at', 'DESC')
                          ->paginate(10),
            'pager' => $model->pager
        ];
        
        return view('dashboard/admin/business', $data);
    }

    public function showRestaurants()
    {
        $model = new RestaurantModel();
      
        $data = [
            'restaurants' => $model->select('restaurants.*, users.username AS username')
                          ->join('users', 'users.id = restaurants.user_id', 'inner')
                          ->orderBy('restaurants.created_at', 'DESC')
                          ->paginate(10),
            'pager' => $model->pager
        ];
        
        return view('dashboard/admin/restaurants', $data);
    }
}
