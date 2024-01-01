<?php

namespace App\Models;

use CodeIgniter\Model;

class MorderAnalysisTax extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'order_analysis_tax_tbl';
    protected $primaryKey = 'ordAnlyTaxId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkOrdAnlyId',
                                'taxAnalysisType',
                                'interestAmt',
                                'penaltyAmt',
                                'TDSAmt',
                                'advTaxAmt',
                                'selfAssmtTaxAmt',
                                'paidAtAppealAmt',
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