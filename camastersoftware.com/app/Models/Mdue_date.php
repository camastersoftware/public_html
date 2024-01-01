<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdue_date extends Model
{
    protected $table = 'due_date_master_tbl';
    protected $primaryKey = 'due_date_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'due_state',
        'due_act',
        'due_date_for',
        'tax_payer',
        'is_all_tax_payer',
        'under_section',
        'audit_app',
        'audit',
        'applicable_form',
        'condtn',
        'orgTypes',
        'periodicity',
        'daily_date',
        'period_month',
        'period_year',
        'f_period_month',
        'f_period_year',
        't_period_month',
        't_period_year',
        'finYear',
        'due_date',
        'isExt',
        'ext_due_date',
        'doc_file',
        'due_notes',
        'status',
        'createdBy',
        'createdDatetime',
        'updatedBy',
        'updatedDatetime'
    ];

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