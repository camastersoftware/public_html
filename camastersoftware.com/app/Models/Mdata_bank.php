<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdata_bank extends Model
{
    protected $table = 'data_bank_tbl';
    protected $primaryKey = 'data_bank_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['data_bank_name', 'data_bank_profession', 'data_bank_location', 'data_bank_contact', 'data_bank_email', 'data_bank_source', 'data_bank_license', 'data_bank_contacted_on', 'data_bank_follow_up_on', 'data_bank_remark', 'data_bank_demo_req_on', 'isDemo', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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