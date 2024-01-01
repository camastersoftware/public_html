<?php

namespace App\Models;

use CodeIgniter\Model;

class MUserMessage extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'user_message_tbl';
    protected $primaryKey = 'userMessageId';
 
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fkUserChatConnectionId', 'userMessage', 'fromUserId', 'toUserId', 'isRead', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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