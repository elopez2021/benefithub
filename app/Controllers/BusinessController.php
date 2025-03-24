<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BusinessModel;
use CodeIgniter\HTTP\ResponseInterface;

class BusinessController extends BaseController
{
    public function index()
    {
        
        $model = new BusinessModel();
        
        $data = $model->getAllBusinesses();

        return view('dashboard/business/index', ['businesses' => $data]);
    }

    public function create()
    {
        $businessModel = new BusinessModel();

        $request = service('request');

        $json = $request->getJSON();

        // Collect raw POST data without validation
        $data = [
            'legal_name' => $json->legal_name ?? null,
            'rnc'        => $json->rnc ?? null,
            'phone'      => $json->phone ?? null,
            'daily_subsidy'    => $json->daily_subsidy ?? null,
            'province'   => $json->province ?? null,
            'address'    => $json->address ?? null,
            'user_id'    => $json->user_id ?? null,
            'email'      => $json->email ?? null,
            'status'     => 1
        ];

        try {

            $businessId = $businessModel->insert($data);

            if ($businessId) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'      => 'success',
                        'business_id' => $businessId,
                        'message'     => 'Empresa guardada satisfactoriamente' // Optional
                    ]);
            } else {
                // Handle insert failure (e.g., database error)
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'Database insert failed',
                        'data'   => $data, // The data that was attempted to be inserted
                        'error'  => $businessModel->errors() // Any DB-level errors
                    ]);
            }

        } catch (\Exception $e) {
            // Minimal error response
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Empresa creation crashed',
                    'error'   => $e->getMessage() // No stack trace for production
                ]);
        }
    }

    // Method to update business
    public function updateBusiness($id)
    {
        $businessModel = new BusinessModel();

        // Collect post data
        $data = [
            'legal_name' => $this->request->getPost('legal_name'),
            'rnc' => $this->request->getPost('rnc'),
            'phone' => $this->request->getPost('phone'),
            'subsidy' => $this->request->getPost('subsidy'),
            'province' => $this->request->getPost('province'),
            'address' => $this->request->getPost('address'),
        ];

        // Validate and update business
        $validationResult = $businessModel->updateBusiness($id, $data);
        if ($validationResult === true) {
            return redirect()->to('/business');
        } else {
            // If validation fails, pass the error messages to the view
            return view('business/edit', ['validation' => $validationResult]);
        }
    }

    // Method to update business status
    public function updateBusinessStatus($id, $status)
    {
        $businessModel = new BusinessModel();

        // Ensure status is valid (1 or 0)
        if ($status != 1 && $status != 0) {
            return redirect()->back()->with('error', 'Invalid status');
        }

        // Update the status
        $businessModel->updateBusinessStatus($id, $status);
        return redirect()->to('/business');
    }
    
}
