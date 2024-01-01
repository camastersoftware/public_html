<?php

namespace App\Models;

use CodeIgniter\Model;

class MclientsCredetialsAdministration extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'clients_credetials_administration_tbl';
    protected $primaryKey = 'clients_credetials_administration_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['client_administration_model_id', 'org_type_id', 'client_id', 'type_of_account_id', 'portal_id', 'digital_certificate_class_master_id', 'login_username', 'password', 'e_way_bill_login', 'e_way_bill_password', 'purchase_from', 'start_date', 'end_date', 'dcs_token_with', 'dcs_token_date', 'notes', 'isDiscontinued', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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