<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdemand extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'demand_tbl';
    protected $primaryKey = 'demandId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkWorkId', 
                                'demandPrincipalAmt', 
                                'demandInterestAmt', 
                                'demandTotalAmt', 
                                'whetherPayable', 
                                'demandDecision', 
                                'demandPrincipalAmt1', 
                                'demandPrincipalAmt2', 
                                'demandPrincipalAmt3', 
                                'demandPrincipalAmt4', 
                                'demandPrincipalAmt5', 
                                'demandInterestAmt1', 
                                'demandInterestAmt2', 
                                'demandInterestAmt3', 
                                'demandInterestAmt4', 
                                'demandInterestAmt5', 
                                'demandAmtDate1', 
                                'demandAmtDate2', 
                                'demandAmtDate3', 
                                'demandAmtDate4', 
                                'demandAmtDate5', 
                                'totalDemandAmt1', 
                                'totalDemandAmt2', 
                                'totalDemandAmt3', 
                                'totalDemandAmt4', 
                                'totalDemandAmt5', 
                                'totalDemandPrincipalAmt',
                                'totalDemandInterestAmt',
                                'totalDemandPaidAmt',
                                'balancePayable',
                                'demandRemark',
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