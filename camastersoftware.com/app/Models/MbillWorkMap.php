<?php

namespace App\Models;

use CodeIgniter\Model;

class MbillWorkMap extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'bill_work_map_tbl';
    protected $primaryKey = 'bill_work_map_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fkBillId', 'fkWorkId', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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