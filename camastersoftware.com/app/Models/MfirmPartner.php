<?php

namespace App\Models;

use CodeIgniter\Model;

class MfirmPartner extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'firm_partner_tbl';
    protected $primaryKey = 'firmPartnerId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkFirmDeedId', 
                                'firmPartnerName', 
                                'isWorking', 
                                'admissionDate',
                                'effectiveDate',
                                'retirementDate',
                                'salaryPercentage',
                                'interestPercentage',
                                'profitPercentage',
                                'lossPercentage',
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