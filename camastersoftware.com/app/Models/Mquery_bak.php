<?php

namespace App\Models;

use CodeIgniter\Model;

class Mquery extends Model
{
    public function __construct()
    {
        $this->session = \Config\Services::session();

        $this->userLoginName=$this->session->get('userLoginName');
        $this->sessCaFirmId=$this->session->get('caFirmId');

        // 'username' => 'camaster_firm_user',
        // 'password' => 'n8XF!.kIs0Wg',
        // 'database' => 'camaster_ca_firm_'.$this->sessCaFirmId,

        if(empty($this->userLoginName))
        {
            if($_SERVER['SERVER_ADDR']=='127.0.0.1')
            {
                $ca_firm_db_user="root";
                $ca_firm_db_pass="";
                $ca_firm_db_name=PROJ_PREFIX.'_ca_firm_'.$this->sessCaFirmId;
            }
            else
            {
                $ca_firm_db_user=FIRM_DB_USERNAME;
                $ca_firm_db_pass=FIRM_DB_PASSWORD;
                $ca_firm_db_name=PROJ_PREFIX.'_ca_firm_'.$this->sessCaFirmId;
            }

            $this->adminDB = [
                'DSN'      => '',
                'hostname' => 'localhost',
                'username' => $ca_firm_db_user,
    	        'password' => $ca_firm_db_pass,
                'database' => $ca_firm_db_name,
                'DBDriver' => 'MySQLi',
                'DBPrefix' => '',
                'pConnect' => false,
                'DBDebug'  => (ENVIRONMENT !== 'production'),
                'charset'  => 'utf8',
                'DBCollat' => 'utf8_general_ci',
                'swapPre'  => '',
                'encrypt'  => false,
                'compress' => false,
                'strictOn' => false,
                'failover' => [],
                'port'     => 3306,
            ];
    
            $this->adminDB = \Config\Database::connect($this->adminDB);
        }
        else
        {
            $this->adminDB = \Config\Database::connect('adminDB');
        }
    }

    public function getRecords($tableName="", $colNames="", $condtnArr=array(), $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array())
    {
        $builder=$this->adminDB->table($tableName);
        $builder->select($colNames);

        if(!empty($joinArr))
        {
            foreach($joinArr AS $eachJoin)
            {
                $joinTable=$eachJoin['tbl'];
                $joinCondtn=$eachJoin['condtn'];
                $joinType=$eachJoin['type'];

                $builder->join($joinTable, $joinCondtn, $joinType);
            }
        }

        if(!empty($condtnArr))
        {
            foreach($condtnArr AS $w_col=>$w_val)
            {
                $builder->where($w_col, $w_val);
            }
        }

        if(!empty($customWhereArray))
        {
            foreach($customWhereArray AS $cust_wh_val)
            {
                $builder->where($cust_wh_val);
            }
        }

        if(!empty($orWhereArray))
        {
            foreach($orWhereArray AS $or_w_col=>$or_w_val)
            {
                $builder->orWhere($or_w_col, $or_w_val);
            }
        }

        if(!empty($likeCondtnArr))
        {
            foreach($likeCondtnArr AS $l_col=>$l_val)
            {
                $builder->like($l_col, $l_val);
            }
        }

        if(!empty($whereInArray))
        {
            foreach($whereInArray AS $wh_col=>$wh_val)
            {
                $builder->whereIn($wh_col, $wh_val);
            }
        }

        if(!empty($orWhereDataArr))
        {
            foreach($orWhereDataArr AS $or_wh_val)
            {
                $builder->orWhere($or_wh_val);
            }
        }

        if(!empty($orderByArr))
        {
            foreach($orderByArr AS $orderByCol=>$orderByType)
            {
                $builder->orderBy($orderByCol, $orderByType);
            }
        }

        if(!empty($groupByArr))
        {
            $builder->groupBy($groupByArr);
        }

        $query=$builder->get();

        $res=array();
        $res['query']=$lastQuery=$this->adminDB->getLastQuery();

        if (!$this->adminDB->simpleQuery($lastQuery)){
            $res['status']=FALSE;
            $res['error']=$this->adminDB->error();
            $res['userData']=array();
            $res['message']="Error Occured :(";
        }else{
            $res['status']=TRUE;
            $res['error']=$this->adminDB->error();

            if($singleRow)
                $responseArr=$query->getRowArray();
            else
                $responseArr=$query->getResultArray();

            $res['userData']=$responseArr;

            $res['message']="Query run successfully :)";
        }

        return $res;
    }

    public function insert($tableName="", $insertArr=array(), $returnType="")
    {
        $builder=$this->adminDB->table($tableName);
        $builder->insertBatch($insertArr);

        $res=array();
        $res['query']=$lastQuery=$this->adminDB->getLastQuery();

        if (empty($this->adminDB->insertID())){
            $res['status']=FALSE;
            $res['error']=$this->adminDB->error();
            $res['userData']=array();
            $res['message']="Unable to insert :(";
            $res['lastID']="";
        }else{
            $res['status']=TRUE;
            $res['error']=$this->adminDB->error();
            $res['userData']=array();
            $res['message']="Data inserted successfully :)";
            $res['lastID']=$this->adminDB->insertID();
        }

        return $res;
    }

    public function updateBatch($tableName="", $updateArr=array(), $updateKey="", $condtnArr=array(), $likeCondtnArr=array(), $whereInArray=array())
    {
        $builder=$this->adminDB->table($tableName);

        if(!empty($condtnArr))
        {
            foreach($condtnArr AS $w_col=>$w_val)
            {
                $builder->where($w_col, $w_val);
            }
        }

        if(!empty($likeCondtnArr))
        {
            foreach($likeCondtnArr AS $l_col=>$l_val)
            {
                $builder->like($l_col, $l_val);
            }
        }

        if(!empty($whereInArray))
        {
            foreach($whereInArray AS $wh_col=>$wh_val)
            {
                $builder->whereIn($wh_col, $wh_val);
            }
        }

        $builder->updateBatch($updateArr, $updateKey);

        $res=array();
        $res['query']=$lastQuery=$this->adminDB->getLastQuery();

        if (!$this->adminDB->simpleQuery($lastQuery)){
            $res['status']=FALSE;
            $res['error']=$this->adminDB->error();
            $res['message']="Unable to update :(";
        }else{
            $res['status']=TRUE;
            $res['error']=$this->adminDB->error();
            $res['message']="Data updated successfully :)";
        }

        return $res;
    }

    public function updateData($tableName="", $updateArr=array(), $condtnArr=array(), $likeCondtnArr=array(), $whereInArray=array())
    {
        $builder=$this->adminDB->table($tableName);

        if(!empty($condtnArr))
        {
            foreach($condtnArr AS $w_col=>$w_val)
            {
                $builder->where($w_col, $w_val);
            }
        }

        if(!empty($likeCondtnArr))
        {
            foreach($likeCondtnArr AS $l_col=>$l_val)
            {
                $builder->like($l_col, $l_val);
            }
        }

        if(!empty($whereInArray))
        {
            foreach($whereInArray AS $wh_col=>$wh_val)
            {
                $builder->whereIn($wh_col, $wh_val);
            }
        }

        $builder->update($updateArr);

        $res=array();
        $res['query']=$lastQuery=$this->adminDB->getLastQuery();

        if (!$this->adminDB->simpleQuery($lastQuery)){
            $res['status']=FALSE;
            $res['error']=$this->adminDB->error();
            $res['message']="Unable to update :(";
        }else{
            $res['status']=TRUE;
            $res['error']=$this->adminDB->error();
            $res['message']="Data updated successfully :)";
        }

        return $res;
    }

    public function insertLog($insertLogArr)
    {
        $builder=$this->adminDB->table('log_tbl');
        $builder->insert($insertLogArr);

        $res=array();
        $res['query']=$lastQuery=$this->adminDB->getLastQuery();

        if (empty($this->adminDB->insertID())){
            $res['status']=FALSE;
            $res['error']=$this->adminDB->error();
            $res['userData']=array();
            $res['message']="Unable to insert :(";
            $res['lastID']="";
        }else{
            $res['status']=TRUE;
            $res['error']=$this->adminDB->error();
            $res['userData']=array();
            $res['message']="Data inserted successfully :)";
            $res['lastID']=$this->adminDB->insertID();
        }

        return $res;
    }
}

?>