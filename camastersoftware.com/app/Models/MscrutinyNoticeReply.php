<?php

namespace App\Models;

use CodeIgniter\Model;

class MscrutinyNoticeReply extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'scrutiny_notice_reply_tbl';
    protected $primaryKey = 'scrNoticeReplyId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fkScrNoticeId', 'fkScrutinyId', 'fkWorkId', 'letterRefNo', 'datedOn', 'repliedOn', 'attendedBy', 'attendedOn', 'nextDate', 'replyRemark', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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