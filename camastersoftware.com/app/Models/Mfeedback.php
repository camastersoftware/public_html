<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class Mfeedback extends Model
    {
        protected $DBGroup = '';
        protected $table      = 'feedback_tbl';
        protected $primaryKey = 'feedbackId';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['staffName', 'fkFirmId', 'isUseful', 'isReliable', 'isUse', 'notUseReason', 'improvementReqd', 'recmdToOther', 'otherName', 'otherProfession', 'otherLocation', 'otherContactNo', 'otherEmailAddress', 'ratingVal', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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