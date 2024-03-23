<?php

namespace App\Models;

use CodeIgniter\Model;

class MExpenseVoucher extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'expense_voucher_tbl';
    protected $primaryKey = 'exp_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['exp_head', 'exp_doc', 'exp_bill_no', 'exp_date', 'exp_details', 'exp_amt', 'fk_user_id', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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