<?php

namespace App\Models;

use CodeIgniter\Model;

class McmpyDirector extends Model
{
    protected $DBGroup = 'adminDB';
    protected $table = 'cmpy_directors_tbl';
    protected $primaryKey = 'cmpyDirectorId';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'fkClientId', 
                                'directorName', 
                                'apptDate', 
                                'retrmtDate',
                                'reslnDate',
                                'filingDate',
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