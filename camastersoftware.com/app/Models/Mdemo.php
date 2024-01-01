<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdemo extends Model
{
    protected $table = 'demo_requests_tbl';
    protected $primaryKey = 'demoReqId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['demoReqName', 'demoReqMobile', 'demoReqEmail', 'demoReqDateTime', 'demoReqStatus', 'demoDate', 'demoBy', 'demoRemark', 'demoLicense', 'isReplied', 'reply', 'replyDateTime', 'ipAddress', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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