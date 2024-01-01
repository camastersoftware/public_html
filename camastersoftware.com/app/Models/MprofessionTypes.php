<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class MprofessionTypes extends Model
    {
        protected $table      = 'profession_type_tbl';
        protected $primaryKey = 'profession_type_id';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['profession_type_name', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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