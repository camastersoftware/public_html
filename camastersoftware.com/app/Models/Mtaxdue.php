<?php

namespace App\Models;

use CodeIgniter\Model;

class Mtaxdue extends Model
{
    protected $table = 'tax_payer_due_date_map_tbl';
    protected $primaryKey = 'tax_payer_due_date_map_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fk_due_date_id', 'fk_org_type_id', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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