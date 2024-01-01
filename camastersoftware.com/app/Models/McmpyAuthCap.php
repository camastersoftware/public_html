<?php

namespace App\Models;

use CodeIgniter\Model;

class McmpyAuthCap extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'cmpy_auth_cap_tbl';
    protected $primaryKey = 'cmpyAuthCapId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkClientId', 
                                'fromDate', 
                                'toDate', 
                                'amount',
                                'noOfShares',
                                'stampDuty',
                                'reslnDate',
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