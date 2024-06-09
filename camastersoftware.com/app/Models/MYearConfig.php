<?php

namespace App\Models;

use CodeIgniter\Model;

class MYearConfig extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'calender_year_config_tbl';
    protected $primaryKey = 'calender_year_config_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
            'year',
            'scheduleNotes',
            'officeStartTime',
            'officeEndTime',
            'halfDayStartTime',
            'halfDayEndTime',
            'status',
            'createdBy',
            'createdDatetime',
            'updatedBy',
            'updatedDatetime'
        ];

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