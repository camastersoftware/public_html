<?php

namespace App\Models;

use CodeIgniter\Model;

class MmembershipSubscription extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'membership_subscription_tbl';
    protected $primaryKey = 'membership_subscription_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fkMembershipId', 'subscriptionFromDate', 'subscriptionToDate', 'subscriptionPmtAmt', 'subscriptionPmtChq', 'subscriptionPmtDate', 'subscriptionPmtBank', 'subscriptionPmtAccNo', 'subscriptionReceiptNo', 'subscriptionReceiptDate', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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