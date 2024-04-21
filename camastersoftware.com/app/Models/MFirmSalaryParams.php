<?php

namespace App\Models;

use CodeIgniter\Model;

class MFirmSalaryParams extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'firm_salary_parameters_tbl';
    protected $primaryKey = 'salaryParameterId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['salaryParameter', 'salaryParameterType', 'salaryParameterEffectBy', 'salaryParameterAmount', 'salaryParameterPercentage',  'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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