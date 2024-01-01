<?php

namespace App\Models;

use CodeIgniter\Model;

class Muser extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'user_tbl';
    protected $primaryKey = 'userId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['userFullName', 'userLoginName', 'userPassword', 'isCostCenter', 'isOldUser', 'userLeftReason', 'userImg', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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