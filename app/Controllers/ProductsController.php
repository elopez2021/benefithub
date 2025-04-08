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

    // app/Controllers/Products.php
    public function updateStatus()
    {    
        // Use getJSON(true) if JSON data is sent
        $data = $this->request->getJSON(true);
    
        if (empty($data['product_id'])) {
            return $this->response->setStatusCode(400)->setJSON([
                'message' => 'Missing product ID',
                'data' => $data
            ]);
        }
    
        $productModel = new ProductsModel();

    
        $updated = $productModel->update($data['product_id'], ['active' => $data['active']]);
    
        return $this->response->setJSON([
            'success' => $updated,
            'message' => $updated ? 'Status updated' : 'Update failed'
        ]);
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

    public function update($id) {
        try {
    
            $userId = session()->get('user_id');
    
            $restaurantModel = new RestaurantModel();
            $productModel = new ProductsModel();
            $productCategoryModel = new ProductCategoryModel();
            
            // Get the restaurant associated with the user
            $restaurant = $restaurantModel
            ->where('user_id', $userId)
            ->first();
    
            // Fetch the current product data
            $product = $productModel->find($id);
            if (!$product) {
                return $this->response->setStatusCode(404)->setJSON(['success' => false, 'errors' => 'Producto no encontrado']);
            }
    
            // Get JSON data (this is the updated data for the product)
            $productData = $this->request->getJSON();
    
            // Check if categories are provided
            if ($productData->categories == null) {
                return $this->response->setStatusCode(500)->setJSON(['success' => false, 'errors' => 'No se han seleccionado categorías']);
            }
    
            // Update the product details
            $productModel->update($id, [
                'name' => $productData->name,
                'descripcion' => $productData->descripcion,
                'price' => $productData->price,
                'restaurant_id' => $restaurant['id'],
            ]);
    
            // Remove existing categories for the product (if needed)
            $productCategoryModel->where('product_id', $id)->delete();
    
            // Save the updated categories
            foreach ($productData->categories as $categoryId) {
                $productCategoryModel->insert([
                    'product_id' => $id,
                    'category_id' => $categoryId
                ]);
            }
    
            // Return success response with updated product data
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
