<?php

namespace App\Models;

use CodeIgniter\Model;

class MNonRegularDueDates extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'non_regular_due_date_tbl';
    protected $primaryKey = 'non_rglr_due_date_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'non_rglr_due_act',
        'non_rglr_due_date_for',
        'non_rglr_periodicity',
        'non_rglr_due_notes',
        'non_rglr_daily_date',
        'non_rglr_period_month',
        'non_rglr_period_year',
        'non_rglr_f_period_month',
        'non_rglr_f_period_year',
        'non_rglr_t_period_month',
        'non_rglr_t_period_year',
        'non_rglr_finYear',
        'non_rglr_due_date',
        'non_rglr_doc_file',
        'fk_client_id',
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