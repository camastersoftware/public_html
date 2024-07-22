<?php

namespace App\Models;

use CodeIgniter\Model;

class MtimeSheet extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'time_sheet_tbl';
    protected $primaryKey = 'timeSheetId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkWorkId',
                                'fkUserId',
                                'tsWorkingDate',
                                'tsAddHrs',
                                'tsStartTime',
                                'tsEndTime',
                                'tsTotalHours',
                                'tsWorkPlace',
                                'tsRemarks',
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