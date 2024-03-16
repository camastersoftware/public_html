<?php

namespace App\Models;

use CodeIgniter\Model;

class MArticleshipLeaveCal extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'articleship_leave_tbl';
    protected $primaryKey = 'art_lev_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'art_lev_start_date',
        'art_lev_completion_date',
        'art_lev_tot_no_days',
        'art_lev_tot_lev_taken',
        'art_lev_ca_exam_leave',
        'art_lev_gmcs_course',
        'art_lev_itt_training',
        'art_lev_seminar',
        'art_lev_other_leave',
        'art_lev_tot_eligible_leave',
        'art_lev_weekends',
        'art_lev_holidays',
        'art_lev_tot_extra_leaves',
        'art_lev_net_leave_taken',
        'art_lev_days_actually_served',
        'art_lev_one_sixth_allowable',
        'art_lev_allowable_excess_leave',
        'fkUserId',
        'status',
        'createdBy',
        'createdDatetime',
        'updatedBy',
        'updatedDatetime'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'createdDatetime';
    protected $updatedField  = 'updatedDatetime';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}
