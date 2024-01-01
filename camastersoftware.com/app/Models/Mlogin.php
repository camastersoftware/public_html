<?php

namespace App\Models;

use CodeIgniter\Model;

class Mlogin extends Model
{
    protected $table      = 'admin_tbl';
    protected $primaryKey = 'adminId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['userName', 'password', 'status'];

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