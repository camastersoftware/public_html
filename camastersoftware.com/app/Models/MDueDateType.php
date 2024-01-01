<?php

namespace App\Models;

use CodeIgniter\Model;

class MDueDateType extends Model
{
    protected $table = 'due_date_type_tbl';
    protected $primaryKey = 'dueDateTypeId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['dueDateTypeName', 'dueDateTypeShortName', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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