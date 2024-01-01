<?php

namespace App\Models;

use CodeIgniter\Model;

class Mtrademark extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'trade_mark_tbl';
    protected $primaryKey = 'tmId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'fkClientId', 
        'tradeMark',
        'tmClass', 
        'tmNo', 
        'tmDate', 
        'tmApprovedOn', 
        'tmAdvertisedOn', 
        'tmRegisteredOn',
        'tmValidUpto',
        'tmRemarks',
        'isDiscontinued',
        'isReject',
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