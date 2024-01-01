<?php

namespace App\Models;

use CodeIgniter\Model;

class MclientDocumentMap extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'client_document_map_tbl';
    protected $primaryKey = 'client_document_map_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fk_client_document_id', 'fk_client_id', 'client_document_number', 'client_document_issue_date', 'client_document_effective_date', 'client_document_file', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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