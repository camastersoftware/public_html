<?php

namespace App\Models;

use CodeIgniter\Model;

class MTestCron extends Model
{
    protected $table = 'test_cron_tbl';
    protected $primaryKey = 'testId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['testDesc', 'createdAt'];

    protected $useTimestamps = true;
    protected $createdField  = 'createdAt';
    protected $updatedField  = '';
//        protected $deletedField  = 'deleted_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}

?>