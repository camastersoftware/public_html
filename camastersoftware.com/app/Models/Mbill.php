<?php

namespace App\Models;

use CodeIgniter\Model;

class Mbill extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'bill_tbl';
    protected $primaryKey = 'billId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fkClientId', 'billNo', 'billDate', 'billServiceAccCode', 'isLumpsum', 'lumpsumAmt', 'totalAmt', 'taxType', 'cgst', 'sgst', 'igst', 'cgstAmt', 'sgstAmt', 'igstAmt', 'totalBillAmt', 'billNote', 'billCreatedBy', 'billUpdatedBy', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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