<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class Mgroup_cat extends Model
    {
        protected $table      = 'group_category_tbl';
        protected $primaryKey = 'group_category_id';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['group_category_name', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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