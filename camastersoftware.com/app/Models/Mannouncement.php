<?php

namespace App\Models;

use CodeIgniter\Model;

class Mannouncement extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'announcement_tbl';
    protected $primaryKey = 'ancId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ancName', 'startDate', 'stopAnc', 'endDate', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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