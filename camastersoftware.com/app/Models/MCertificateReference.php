<?php

namespace App\Models;

use CodeIgniter\Model;

class MCertificateReference extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'certificate_reference_tbl';
    protected $primaryKey = 'certificate_reference_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['certificate_reference_no', 'certificate_reference_date', 'certificate_reference_client', 'certificate_reference_subject', 'certificate_reference_fin_year', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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