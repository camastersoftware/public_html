<?php

namespace App\Models;

use CodeIgniter\Model;

class MeverydayLab extends Model
{
    protected $table = 'everyday_lab_tbl';
    protected $primaryKey = 'everydayLabId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['everydayLabDate', 'everydayLabImage', 'everydayLabQuotes', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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