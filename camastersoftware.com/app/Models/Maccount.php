<?php

namespace App\Models;

use CodeIgniter\Model;

class Maccount extends Model
{
    protected $table = 'account_details';
    protected $primaryKey = 'accountId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['companyName', 'officeAddress', 'cinNumber', 'panNumber', 'tanNumber', 'gstNumber', 'website', 'websiteCount', 'emailAddress', 'landlineNumber', 'mobileNumber', 'bankAccountName', 'bankName', 'bankBranch', 'bankAccountNumber', 'bankIFSC', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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