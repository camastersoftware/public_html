<?php

namespace App\Models;

use CodeIgniter\Model;

class McmpyIssuePaidCap extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'cmpy_issue_paid_cap_tbl';
    protected $primaryKey = 'cmpyIssuePaidCapId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkClientId', 
                                'issueType', 
                                'allotmentDate', 
                                'totalNoOfShares',
                                'amount',
                                'cumulativeTotal',
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