<?php

namespace App\Models;

use CodeIgniter\Model;

class MRectification extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'rectification_tbl';
    protected $primaryKey = 'rectificationId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'fkWorkId', 
        'rectificationType', 
        'fkRefundId', 
        'fkScrutinyId', 
        'fkAppealId', 
        'rectLetterNo', 
        'rectDate', 
        'rectFiledDate', 
        'rectRemark', 
        'rectTotalIncomeAmt', 
        'rectRefundAmt', 
        'rectDemandAmt', 
        'orderType', 
        'accessingOfficerName', 
        'accessingOfficerContactNo', 
        'inspectorName', 
        'inspectorContactNo', 
        'taxAssistantName', 
        'taxAssistantContactNo', 
        'officerWardNo', 
        'officerPlace', 
        'officerNotice', 
        'officerRemark', 
        'orderDate', 
        'additionalDemandRaised', 
        'whetherAcceptable', 
        'rectificationFilingDate', 
        'appealFilingDate', 
        'pmtOfDemandDate', 
        'orderAmountPaid', 
        'receiptOfOrderDate', 
        'orderRemark',
        'dateOfFinalOrder',
        'dateOfReceiptOrder',
        'whetherFileAppeal',
        'finalAmtOfRefund',
        'dateOfReceiptOfRefund',
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