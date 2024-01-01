<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class MpaymentOption extends Model
    {
        protected $table      = 'payment_option_tbl';
        protected $primaryKey = 'payment_option_id';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['payment_option_name', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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