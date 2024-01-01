<?php

namespace App\Models;

use CodeIgniter\Model;

class MgeneralPassword extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'general_password_tbl';
    protected $primaryKey = 'gen_pass_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['gen_pass_related_to', 'gen_pass_pertaining_to', 'gen_pass_login', 'gen_pass_password', 'gen_pass_remark', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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