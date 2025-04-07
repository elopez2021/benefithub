<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;
use App\Models\ProductsModel;
use App\Models\ProductCategoryModel;
use App\Models\RestaurantModel;

class ProductsController extends BaseController
{
    public function index()
    {
        //
    }

    public function create() {
        try {

            $userId = session()->get('user_id');

            $restaurantModel = new RestaurantModel();
            $productModel = new ProductsModel();
            $productCategoryModel = new ProductCategoryModel();
            
            $restaurant = $restaurantModel
            ->where('user_id', $userId)
            ->first();

            // Get JSON data
            $productData = $this->request->getJSON();

            if($productData->categories == null){
                return $this->response->setStatusCode(500)->setJSON(['success' => false, 'errors' => 'No se han seleccionado categorías']);
            }
            
    
            // Save the product
            $productId = $productModel->insert([
                'name' => $productData->name,
                'descripcion' => $productData->descripcion,
                'price' => $productData->price,
                'restaurant_id' => $restaurant['id'],
            ]);
       
            // Save categories relation (many-to-many via product_category table)
            foreach ($productData->categories as $categoryId) {
                $productCategoryModel->insert([
                    'product_id' => $productId,
                    'category_id' => $categoryId
                ]);
            }
    
            // Return success response
            return $this->response->setJSON(['success' => true, 'data' => $productData]);	
    
        } catch (\Exception $e) {
            // If there's an error, return a failure response with the error message
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'errors' => 'Error en la base de datos: ' . $e->getMessage()
            
            ]);
        }
    }
    
}
