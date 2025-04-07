<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table            = 'schedule';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'category_id',
        'start_time',
        'end_time',
        'day_of_week',
        'created_at',
        'updated_at',
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
        'category_id' => 'required|is_natural_no_zero',
        'start_time'  => 'required',
        'end_time'    => 'required',
        'day_of_week' => 'required|max_length[20]',
    ];
    
    protected $validationMessages = [
        'category_id' => [
            'required' => 'El campo "Categoría" es obligatorio.',
            'is_natural_no_zero' => 'El campo "Categoría" debe ser un número natural y mayor que cero.',
        ],
        'start_time' => [
            'required' => 'El campo "Hora de inicio" es obligatorio.',
        ],
        'end_time' => [
            'required' => 'El campo "Hora de fin" es obligatorio.',
        ],
        'day_of_week' => [
            'required' => 'El campo "Día de la semana" es obligatorio.',
            'max_length' => 'El campo "Día de la semana" no puede tener más de 20 caracteres.',
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
}
