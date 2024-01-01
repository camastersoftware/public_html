<?php

namespace App\Models;

use CodeIgniter\Model;

class MLetterReference extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'letter_reference_tbl';
    protected $primaryKey = 'letter_reference_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['letter_reference_no', 'letter_reference_date', 'letter_reference_client', 'letter_reference_address', 'letter_reference_subject', 'letter_reference_fin_year', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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