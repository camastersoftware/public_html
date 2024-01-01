<?php

namespace App\Models;

use CodeIgniter\Model;

class MFirmReferncer extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'referncer_tbl';
    protected $primaryKey = 'referncerId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['refGroupId', 'refSubGroupId', 'referncerHeading', 'referncerYear', 'referncerAuthor', 'referncerFile', 'referncerUploadDate', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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