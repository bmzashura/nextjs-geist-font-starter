<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'visitors';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'full_name',
        'institution',
        'department',
        'datetime_in',
        'datetime_out',
        'signature'
    ];
    protected $useTimestamps = true;

    public function getVisitors($filters = [])
    {
        $builder = $this->builder();

        if (!empty($filters['full_name'])) {
            $builder->like('full_name', $filters['full_name']);
        }
        if (!empty($filters['institution'])) {
            $builder->like('institution', $filters['institution']);
        }
        if (!empty($filters['department'])) {
            $builder->like('department', $filters['department']);
        }
        if (!empty($filters['datetime_in_start'])) {
            $builder->where('datetime_in >=', $filters['datetime_in_start']);
        }
        if (!empty($filters['datetime_in_end'])) {
            $builder->where('datetime_in <=', $filters['datetime_in_end']);
        }
        if (!empty($filters['datetime_out_start'])) {
            $builder->where('datetime_out >=', $filters['datetime_out_start']);
        }
        if (!empty($filters['datetime_out_end'])) {
            $builder->where('datetime_out <=', $filters['datetime_out_end']);
        }

        return $builder->get()->getResultArray();
    }
}
