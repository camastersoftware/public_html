<?php

namespace App\Models;

use CodeIgniter\Model;

class Mmembership extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'membership_tbl';
    protected $primaryKey = 'membershipId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['membershipNo', 'partyName', 'nameOf', 'category', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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