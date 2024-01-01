<?php

namespace App\Models;

use CodeIgniter\Model;

class MsalaryParameter extends Model
{
    protected $table = 'salary_parameters_tbl';
    protected $primaryKey = 'salaryParameterId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['salaryParameter', 'salaryParameterType', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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