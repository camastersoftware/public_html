<?php

namespace App\Models;

use CodeIgniter\Model;

class Mact_option extends Model
{
    protected $table = 'act_option_map_tbl';
    protected $primaryKey = 'act_option_map_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['act_option_name', 'shortName', 'due_date_type', 'fk_act_id', 'option_type', 'sortBy', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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