<?php

namespace App\Models;

use CodeIgniter\Model;

class MemployeeSalaryDivision extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'employee_salary_division_tbl';
    protected $primaryKey = 'empSalDivisionId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkUserId', 
                                'fkSalaryParameterId', 
                                'empSalDivisionMthAmt', 
                                'empSalDivisionYrAmt',
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