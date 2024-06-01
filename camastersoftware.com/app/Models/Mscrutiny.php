<?php

namespace App\Models;

use CodeIgniter\Model;

class Mscrutiny extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'scrutiny_tbl';
    protected $primaryKey = 'scrutinyId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
            'fkClientId', 
            'fkWorkId', 
            'actType', 
            'finYear',
            'acknowledgmentNo',
            'eFillingDate',
            'assessingOfficer',
            'inspectorName',
            'taxAssistantName',
            'wardNo',
            'noticeUs',
            'placeNo',
            'scRemarks',
            'recptFinalOrderDate',
            'recptOrderDate',
            'isAccepted',
            'isFileRectification',
            'isFileAppeal',
            'amountPaid',
            'paymentDemandDate',
            'finalRefundAmt',
            'refundReceiptDate',
            'scFinalRemark',
            'totalIncome',
            'intiTotalIncome',
            'refundClaimed',
            'refundTotalAmt',
            'demandTotalAmt',
            'isExternal',
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