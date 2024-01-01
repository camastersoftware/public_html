<?php

namespace App\Models;

use CodeIgniter\Model;

class Mtdlist extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'to_do_list_tbl';
    protected $primaryKey = 'tdId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['tdDate', 'tdNatureOfWork', 'tdRemark', 'tdComments', 'tdAllotedBy', 'tdAllotedTo', 'tdPriority', 'tdPriorityColor', 'tdStatus', 'tdTargetDate', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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