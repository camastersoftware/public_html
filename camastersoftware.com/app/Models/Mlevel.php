<?php

namespace App\Models;

use CodeIgniter\Model;

class Mlevel extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'level_tbl';
    protected $primaryKey = 'leveId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'levelNo',
        'fkWorkId',
        'assessingOfficer',
        'assessingOfficerContact',
        'inspectorName',
        'inspectorContact',
        'taxAssistantName',
        'taxAssistantContact',
        'wardNo',
        'placeNo',
        'noticeUs',
        'orderDate',
        'addtnlDemandRaised',
        'isAccepted',
        'filingRectDate',
        'filingAppealDate',
        'paymentDemandDate',
        'amountPaid',
        'recptOrderDate',
        'scRemarks',
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