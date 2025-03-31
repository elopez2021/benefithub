<?php

namespace App\Models;
use CodeIgniter\Model;

class BusinessModel extends Model
{
    protected $table      = 'businesses';  // Table name
    protected $primaryKey = 'id';  // The primary key of the table
    protected $allowedFields = ['user_id', 'email', 'legal_name', 'rnc', 'phone', 'daily_subsidy', 'province', 'address', 'status'];  // Fields
    
    // To automatically use timestamps
    protected $useTimestamps = true;
    
    // Validation rules
    protected $validationRules = [
        'legal_name' => 'required|min_length[3]|max_length[255]',
        'rnc' => 'required|regex_match[/^\d{9}$/]',  // 9 digits without dashes
        'phone' => 'required|regex_match[(809|829|849)\d{7}]',  // +1-(809|829|849)xxx-xxxx
        'daily_subsidy' => 'required|greater_than[-1]',
        'province' => 'required',
        'address' => 'required|min_length[5]',
    ];

    // Validation error messages
    protected $validationMessages = [
        'legal_name' => [
            'required' => 'The legal name is required.',
            'min_length' => 'The legal name must be at least 3 characters long.',
            'max_length' => 'The legal name cannot exceed 255 characters.'
        ],
        'rnc' => [
            'required' => 'The RNC is required.',
            'regex_match' => 'The RNC must be exactly 9 digits without dashes.'
        ],
        'phone' => [
            'required' => 'The phone number is required.',
            'regex_match' => 'The phone number must match the pattern: +1-(809|829|849)xxx-xxxx.'
        ],
        'daily_subsidy' => [
            'required' => 'The daily_subsidy is required.',
            'greater_than' => 'The daily_subsidy must be greater than -1.'
        ],
        'province' => [
            'required' => 'The province is required.',
        ],
        'address' => [
            'required' => 'The address is required.',
            'min_length' => 'The address must be at least 5 characters long.'
        ]
    ];

    public function getAllBusinesses()
    {
        return $this->select('businesses.*, users.username')
                    ->join('users', 'users.id = businesses.user_id', 'inner')
                    ->findAll();
    }

    // Function to validate business data
    public function validateBusinessData($data)
    {
        // Validate the input data against the rules
        if (!$this->validate($data)) {
            return $this->errors();  // Return the validation errors
        }
        return true;  // If validation passes, return true
    }

    // Function to insert a new business
    public function addBusiness($data)
    {
        // First validate the data
        $validationResult = $this->validateBusinessData($data);
        if ($validationResult !== true) {
            return $validationResult;  // Return the errors if validation fails
        }
        return $this->insert($data);  // If validation passes, insert the data
    }

    // Function to update business data
    public function updateBusiness($id, $data)
    {
        // First validate the data
        $validationResult = $this->validateBusinessData($data);
        if ($validationResult !== true) {
            return $validationResult;  // Return the errors if validation fails
        }
        return $this->update($id, $data);  // If validation passes, update the data
    }

    // Function to mark business as active (1) or inactive (0)
    public function updateBusinessStatus($id, $status)
    {
        // Ensure that status is either 1 (active) or 0 (inactive)
        if ($status != 1 && $status != 0) {
            return false;  // Invalid status value
        }
        
        return $this->update($id, ['status' => $status]);  // Update the 'status' field
    }
}
