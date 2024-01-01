<?php

namespace App\Models;

use CodeIgniter\Model;

class MgstPortalList extends Model
{
    protected $table = 'gst_portal_list_tbl';
    protected $primaryKey = 'gst_portal_list_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['gst_portal_list_name', 'gst_portal_list_link', 'gst_portal_list_notes', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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