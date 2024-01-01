<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class MorganisationType extends Model
    {
        protected $table      = 'organisation_type_tbl';
        protected $primaryKey = 'organisation_type_id';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['organisation_type_name', 'seqNo', 'sortingBy', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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