<?php

namespace App\Models;

use CodeIgniter\Model;

class Mfirmrefgroup extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'referencer_groups';
    protected $primaryKey = 'refGrpId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['refGrpName', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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