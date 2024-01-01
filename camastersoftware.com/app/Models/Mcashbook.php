<?php

namespace App\Models;

use CodeIgniter\Model;

class Mcashbook extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'cashbook_tbl';
    protected $primaryKey = 'cbId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['cbDate', 'cbType', 'cbFromTo', 'cbFor', 'cbAmt', 'cbRemark', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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