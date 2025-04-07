<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'restaurant_categories'; // o el nombre correcto de tu tabla
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'restaurant_id',   // Foreign key referencing the restaurant table
        'name',             // Category name
        'description',      // Description of the category
        'active',           // Status if the category is active
        'created_at',       // Timestamp for creation
        'updated_at',       // Timestamp for update
    ];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'restaurant_id' => 'required|is_natural_no_zero',  // Ensure it's a valid restaurant ID
        'name'          => 'required|max_length[100]|is_unique[restaurant_categories.name,restaurant_id,{restaurant_id}]', // Unique per restaurant
        'description'   => 'permit_empty|max_length[255]',  // Optional with max length
        'active'         => 'in_list[0,1]', // Ensure boolean-like value (0 or 1)
    ];
     // Validation Messages
     protected $validationMessages = [
        'restaurant_id' => [
            'required' => 'Restaurant ID is required.',
            'is_natural_no_zero' => 'Restaurant ID must be a valid integer greater than zero.',
            'exists' => 'The specified restaurant does not exist.',
        ],
        'name' => [
            'required' => 'Category name is required.',
            'max_length' => 'Category name cannot exceed 100 characters.',
            'is_unique' => 'This category name already exists for the given restaurant.',
        ],
        'description' => [
            'max_length' => 'Description cannot exceed 255 characters.',
        ],
        'active' => [
            'in_list' => 'Active field must be either 0 or 1.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getSchedules($categoryId)
    {
        $scheduleModel = new ScheduleModel();
        return $scheduleModel->where('category_id', $categoryId)->findAll();
    }
}



