<?php

namespace App\Models;

use CodeIgniter\Model;

class MRectificationHearing extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'rectification_hearing_tbl';
    protected $primaryKey = 'rectificationHearingId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'fkWorkId', 
        'fkRectificationId',
        'hearingDate', 
        'attendedDate', 
        'hearingProgress', 
        'proceedingDetails', 
        'attendedBy', 
        'nextHearingDate',
        'hearingRemark',
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