<?php

namespace App\Models;

use CodeIgniter\Model;

class Mreminder extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'reminder_tbl';
    protected $primaryKey = 'reminderId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['reminderDate', 'reminderFor', 'reminderColor', 'reminderFrom', 'reminderTo', 'reminderAddedBy', 'isGroupReminder', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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