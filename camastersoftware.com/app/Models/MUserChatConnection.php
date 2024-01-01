<?php

namespace App\Models;

use CodeIgniter\Model;

class MUserChatConnection extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'user_chat_connection_tbl';
    protected $primaryKey = 'userChatConnectionId ';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fkUser1', 'fkUser2', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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