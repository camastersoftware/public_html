<?php

namespace App\Models;

use CodeIgniter\Model;

class MmenuAccess extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'user_menu_access_tbl';
    protected $primaryKey = 'user_menu_access_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fkStaffTypeId', 'fkMenuId', 'accessPref', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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