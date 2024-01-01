<?php

namespace App\Models;

use CodeIgniter\Model;

class Mcontsubgroup extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'cont_sub_group_tbl';
    protected $primaryKey = 'cont_sub_group_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['cont_sub_group_name', 'fk_cont_group_id', 'refId', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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