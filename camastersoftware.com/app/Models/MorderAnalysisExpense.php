<?php

namespace App\Models;

use CodeIgniter\Model;

class MorderAnalysisExpense extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'order_analysis_expense_tbl';
    protected $primaryKey = 'ordAnlyExpId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkOrdAnlyId',
                                'expType',
                                'ordAnlyExpName',
                                'scrAmt',
                                'applCITNotAmt',
                                'applCITAmt',
                                'applCITAllwdAmt',
                                'applCITRejAmt',
                                'applITATNotAmt',
                                'applITATAmt',
                                'applITATAllwdAmt',
                                'applITATRejAmt',
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