<?php

namespace App\Models;

use CodeIgniter\Model;

class MorderAnalysis extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'order_analysis_tbl';
    protected $primaryKey = 'ordAnlyId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkWorkId',
                                'scrutinyIncAmt',
                                'applCITIncAmt',
                                'applITATIncAmt',
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