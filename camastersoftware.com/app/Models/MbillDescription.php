<?php

namespace App\Models;

use CodeIgniter\Model;

class MbillDescription extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'bill_description_tbl';
    protected $primaryKey = 'billDescptionId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fkBillId', 'description', 'amount', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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