<?php

namespace App\Models;

use CodeIgniter\Model;

class MdigitalCertificateClassMaster extends Model
{
    protected $table = 'digital_certificate_class_master_tbl';
    protected $primaryKey = 'digital_certificate_class_master_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['digital_certificate_class_master_name', 'digital_certificate_class_master_notes', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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