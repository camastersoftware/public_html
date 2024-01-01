<?php

namespace App\Models;

use CodeIgniter\Model;

class Mvisitor extends Model
{
    protected $table = 'visitors_tbl';
    protected $primaryKey = 'visitorId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['visitorIP', 'visitorUserAgent', 'visitorPlatform', 'createdDatetime', 'updatedDatetime'];

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