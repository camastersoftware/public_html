<?php

namespace App\Models;

use CodeIgniter\Model;

class MArticleshipStaff extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'articleship_staff_tbl';
    protected $primaryKey = 'art_staff_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['art_staff_name', 'art_staff_name_of_principle', 'art_staff_reg_no', 'art_staff_membership_no', 'art_staff_img', 'art_staff_date_commencement', 'art_staff_date_intimation_icai', 'art_staff_date_suppl_art', 'art_staff_date_completion_art', 'art_staff_year_completion_inter_ca', 'art_staff_year_completion_final_ca', 'art_staff_job_status', 'status', 'createdBy', 'createdDatetime', 'updatedBy', 'updatedDatetime'];

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