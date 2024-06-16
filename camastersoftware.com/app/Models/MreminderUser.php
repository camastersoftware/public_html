<?php

namespace App\Models;

use CodeIgniter\Model;

class MreminderUser extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'reminder_user_map_tbl';
    protected $primaryKey = 'reminder_user_map_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fkReminderId', 'fkUserId', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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