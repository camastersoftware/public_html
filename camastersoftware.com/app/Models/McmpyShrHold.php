<?php

namespace App\Models;

use CodeIgniter\Model;

class McmpyShrHold extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'cmpy_shareholder_tbl';
    protected $primaryKey = 'cmpyShrHoldId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkClientId', 
                                'directorName', 
                                'allotmentDate', 
                                'noOfShares',
                                'amount',
                                'cumulativeAmount',
                                'filingDate',
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