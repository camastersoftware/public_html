<?php

namespace App\Models;

use CodeIgniter\Model;

class MCharterAccountant extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'chartered_accuntant_tbl';
    protected $primaryKey = 'ca_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ca_name', 'ca_membership_no', 'ca_date_commencement', 'ca_date_intimation_icai', 'ca_date_termination','ca_date_intimation_icai_termination', 'ca_remark', 'ca_img', 'fkUserId','isAddedFromUser',  'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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