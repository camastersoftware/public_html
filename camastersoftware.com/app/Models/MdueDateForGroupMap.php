<?php

namespace App\Models;

use CodeIgniter\Model;

class MdueDateForGroupMap extends Model
{
    protected $table = 'due_date_for_group_map_tbl';
    protected $primaryKey = 'due_date_for_group_map_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fk_due_date_for_group_id', 'fk_ddf_id', 'fk_act_id', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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