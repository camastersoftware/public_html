<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class Mgroup extends Model
    {
        protected $DBGroup = 'adminDB';
        protected $table      = 'client_group_tbl';
        protected $primaryKey = 'client_group_id';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['client_group', 'client_group_number', 'client_group_cost', 'client_group_category', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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