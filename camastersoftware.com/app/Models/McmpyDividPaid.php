<?php

namespace App\Models;

use CodeIgniter\Model;

class McmpyDividPaid extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'cmpy_dividend_paid_tbl';
    protected $primaryKey = 'cmpyDividPaidId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkClientId', 
                                'acctYear', 
                                'agmDate', 
                                'shareCapital',
                                'rate',
                                'dividendAmt',
                                'pmtDate',
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