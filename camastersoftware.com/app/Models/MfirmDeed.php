<?php

namespace App\Models;

use CodeIgniter\Model;

class MfirmDeed extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'firm_deed_tbl';
    protected $primaryKey = 'firmDeedId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'actType', 
                                'fkClientId', 
                                'deedNumber', 
                                'deedType', 
                                'executionDate',
                                'effectiveDate',
                                'formNumber',
                                'formFiledOn',
                                'amountPaid',
                                'registrationNumber',
                                'registrationOn',
                                'extractRecvdOn',
                                'registeredAddress',
                                'adminOfficeAddress',
                                'factoryAddress',
                                'remarks',
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