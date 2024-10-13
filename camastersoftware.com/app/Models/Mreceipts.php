<?php

namespace App\Models;

use CodeIgniter\Model;

class Mreceipts extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'receipts_tbl';
    protected $primaryKey = 'receiptId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkBillId',
                                'fkClientId',
                                'receiptNo',
                                'receiptDate',
                                'receiptMode',
                                'receiptChequeNo',
                                'receiptDated',
                                'receiptDrawnOn',
                                'receiptAmt',
                                'receiptGst',
                                'receiptTotal',
                                'receiptTds',
                                'receiptNet',
                                'receiptDepositedToAcc',
                                'receiptRemarks',
                                'receiptCreatedBy',
                                'receiptUpdatedBy',
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