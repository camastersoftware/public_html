<?php

namespace App\Models;

use CodeIgniter\Model;

class Mrefund extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'refund_tbl';
    protected $primaryKey = 'refundId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkWorkId', 
                                'totalIncome', 
                                'intiTotalIncome', 
                                'refundClaimed',
                                'refundPrincipalAmt',
                                'refundInterestAmt',
                                'refundTotalAmt',
                                'intiRefundApproved', 
                                'intiAddtnlTax', 
                                'intiRemark', 
                                'intiRefundApproved1', 
                                'intiRefundApproved2', 
                                'intiRefundApproved3', 
                                'intiRefundApproved4', 
                                'intiRefundApproved5', 
                                'intiTotalRefundApproved', 
                                'intiRefundAmt1', 
                                'intiRefundAmt2', 
                                'intiRefundAmt3', 
                                'intiRefundAmt4', 
                                'intiRefundAmt5', 
                                'intiTotalRefundAmt', 
                                'intiInterestAmt1', 
                                'intiInterestAmt2', 
                                'intiInterestAmt3', 
                                'intiInterestAmt4', 
                                'intiInterestAmt5', 
                                'intiTotalInterestAmt', 
                                'intiTotalRefund1', 
                                'intiTotalRefund2', 
                                'intiTotalRefund3', 
                                'intiTotalRefund4', 
                                'intiTotalRefund5', 
                                'intiTotalRefund', 
                                'intiRefundDate1', 
                                'intiRefundDate2', 
                                'intiRefundDate3', 
                                'intiRefundDate4', 
                                'intiRefundDate5', 
                                'intiBalRefundRecvd', 
                                'intiRefundRemark', 
                                'intiIsRectification', 
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