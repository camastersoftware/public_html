<?php

namespace App\Models;

use CodeIgniter\Model;

class MStaffCost extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'staff_cost_tbl';
    protected $primaryKey = 'staffCostId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkUserId',
                                'staffCostPerHour',
                                'changedDate',
                                'status',
                                'createdBy',
                                'createdDatetime',
                                'updatedBy',
                                'updatedDatetime'
                            ];

    protected $useTimestamps = true;
    protected $createdField  = 'createdDatetime';
    protected $updatedField  = 'updatedDatetime';
//        protected $deletedField  = 'deleted_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}

?>