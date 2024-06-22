<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class Mclient extends Model
    {
        protected $DBGroup = 'adminDB';
        protected $table      = 'client_tbl';
        protected $primaryKey = 'clientId';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['clientName', 'clientBussOrganisation', 'clientBussOrganisationType', 'clientGroup', 'isOldClient', 'clientLeftReason', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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