<?php

namespace App\Models;

use CodeIgniter\Model;

class Mfirm extends Model
{
    protected $table      = 'ca_firm_tbl';
    protected $primaryKey = 'caFirmId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['caFirmName', 'caFirmProfession', 'caFirmType', 'caFirmPan', 'caFirmGSTIN', 'caFirmRegNo', 'caFirmRegDate', 'caFirmContactPerson', 'caFirmEmail', 'caFirmMobile', 'caFirmAddress', 'caFirmStateId', 'caFirmCityId', 'caFirmLandline', 'caFirmUsers', 'caFirmPayment', 'caFirmStatus', 'customerUserName', 'customerPassword', 'caFirmCompanyKey', 'caFirmAllotmentDate', 'isVerified', 'isTermsAgree', 'isDiscontinue', 'discontinuationDate', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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