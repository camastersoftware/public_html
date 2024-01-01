<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class Mmenu extends Model
    {
        protected $table      = 'menu_tbl';
        protected $primaryKey = 'menuId';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['menuName', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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