<?php

namespace App\Models;

use CodeIgniter\Model;

class MemployeeAttendance extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'employee_attendance_tbl';
    protected $primaryKey = 'employeeAttendanceId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkEmployeeId',
                                'attendanceDate',
                                'attendanceStatus',
                                'inTime',
                                'outTime',
                                'totalHours',
                                'workPlace',
                                'remarks',
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