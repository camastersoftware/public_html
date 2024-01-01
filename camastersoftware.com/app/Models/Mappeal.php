<?php

namespace App\Models;

use CodeIgniter\Model;

class Mappeal extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'appeal_tbl';
    protected $primaryKey = 'appealId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'levelNo',
        'fkWorkId',
        'appealType',
        'fkRefundId',
        'fkScrutinyId',
        'fkAppealId',
        'applOrderType',
        'applTotalIncAmt',
        'applRefundAmt',
        'applDemandAmt',
        'disputedAmt',
        'dateOfOrder',
        'dateOfReceiptOrder',
        'assessingOfficer',
        'inspectorName',
        'taxAssistantName',
        'wardNo',
        'locationName',
        'dateOfFilingAppeal',
        'orderRemark',
        'dateOfFinalOrder',
        'dateOfFinalReceiptOrder',
        'isAccepted',
        'isFileRectification',
        'isFileAppeal',
        'finalAmtPaid',
        'dateOfPmtOfDemand',
        'finalAmtRefund',
        'dateOfReceiptOfRefund',
        'finalOutcomeRemark',
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