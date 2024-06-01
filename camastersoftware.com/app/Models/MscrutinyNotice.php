<?php

namespace App\Models;

use CodeIgniter\Model;

class MscrutinyNotice extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'scrutiny_notice_tbl';
    protected $primaryKey = 'scrNoticeId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fkScrutinyId', 'fkWorkId', 'fkNoticeUSId', 'noticeDate', 'noticeDueDate', 'noticeSubject', 'noticeRemark', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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