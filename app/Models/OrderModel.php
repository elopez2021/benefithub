<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'employee_id',
        'restaurant_id',
        'subtotal',
        'total',
        'status',
        'created_at',
        'updated_at'
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
        'employee_id'    => 'required|integer|is_not_unique[employees.id]',
        'restaurant_id'  => 'required|integer|is_not_unique[restaurants.id]',
        'subtotal'       => 'required|decimal',
        'total'          => 'required|decimal',
        'status'         => 'required|in_list[pending,processing,completed,cancelled]',
    ];
    
    protected $validationMessages = [
        'employee_id' => [
            'required'      => 'El campo empleado es obligatorio.',
            'integer'       => 'El campo empleado debe ser un número entero.',
            'is_not_unique' => 'El empleado seleccionado no existe.',
        ],
        'restaurant_id' => [
            'required'      => 'El campo restaurante es obligatorio.',
            'integer'       => 'El campo restaurante debe ser un número entero.',
            'is_not_unique' => 'El restaurante seleccionado no existe.',
        ],
        'subtotal' => [
            'required' => 'El subtotal es obligatorio.',
            'decimal'  => 'El subtotal debe ser un número decimal.',
        ],
        'total' => [
            'required' => 'El total es obligatorio.',
            'decimal'  => 'El total debe ser un número decimal.',
        ],
        'status' => [
            'required' => 'El estado es obligatorio.',
            'in_list'  => 'El estado debe ser uno de los siguientes: pending, processing, completed o cancelled.',
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
    
    
    public function getOrderWithItems($orderId)
    {
        return $this->db->table('orders')
            ->select('orders.*, order_items.*, products.name as product_name')
            ->join('order_items', 'order_items.order_id = orders.id')
            ->join('products', 'products.id = order_items.product_id')
            ->where('orders.id', $orderId)
            ->get()
            ->getResultArray();
    }
}
