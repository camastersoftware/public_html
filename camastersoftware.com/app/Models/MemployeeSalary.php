<?php

namespace App\Models;

use CodeIgniter\Model;

class MemployeeSalary extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'employee_salary_tbl';
    protected $primaryKey = 'empSalId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkUserId',
                                'grossSalaryAmtMth',
                                'grossSalaryAmtYr',
                                'dedctnSalaryAmtMth',
                                'dedctnSalaryAmtYr',
                                'totalAmtPayableMth',
                                'totalAmtPayableYr',
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