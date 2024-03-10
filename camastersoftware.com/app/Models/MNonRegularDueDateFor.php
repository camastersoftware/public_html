<?php

namespace App\Models;

use CodeIgniter\Model;

class MNonRegularDueDateFor extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'non_regular_due_date_for_tbl';
    protected $primaryKey = 'non_regular_due_date_for_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'non_regular_due_date_for_name',
        'fkActId',
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