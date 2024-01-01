<?php

namespace App\Models;

use CodeIgniter\Model;

class Mcontact extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'contact_tbl';
    protected $primaryKey = 'contactId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['contGroupId', 'contSubGroupId', 'contFullName', 'contOrgName', 'contMob1', 'contMob2', 'contEmail', 'contResiAddress', 'contResiNum', 'contOfficeAddress', 'contOfficeNum', 'contRegOffice', 'contRegOfficeNum', 'contFactOffice', 'contFactNum', 'contRefId', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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