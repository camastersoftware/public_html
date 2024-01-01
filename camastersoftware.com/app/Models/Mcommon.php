<?php

namespace App\Models;

use CodeIgniter\Model;

class Mcommon extends Model
{
    public function getRecords($tableName="", $colNames="", $condtnArr=array(), $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array())
    {
        
        $db = \Config\Database::connect();

        $builder=$db->table($tableName);
       
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
        $res['query']=$lastQuery=$db->getLastQuery();

        if (!$db->simpleQuery($lastQuery)){
            $res['status']=FALSE;
            $res['error']=$db->error();
            $res['userData']=array();
            $res['message']="Error Occured :(";
        }else{
            $res['status']=TRUE;
            $res['error']=$db->error();

            if($singleRow)
                $responseArr=$query->getRowArray();
            else
                $responseArr=$query->getResultArray();

            $res['userData']=$responseArr;

            $res['message']="Query run successfully :)";
        }

        return $res;
    }
    
    public function cronGetRecords($tableName="", $colNames="", $condtnArr=array(), $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array(), $connectionArr=array())
    {
        if(!empty($connectionArr))
            $db = \Config\Database::connect($connectionArr);
        else
            $db = \Config\Database::connect();

        $builder=$db->table($tableName);
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
        $res['query']=$lastQuery=$db->getLastQuery();

        if (!$db->simpleQuery($lastQuery)){
            $res['status']=FALSE;
            $res['error']=$db->error();
            $res['userData']=array();
            $res['message']="Error Occured :(";
        }else{
            $res['status']=TRUE;
            $res['error']=$db->error();

            if($singleRow)
                $responseArr=$query->getRowArray();
            else
                $responseArr=$query->getResultArray();

            $res['userData']=$responseArr;

            $res['message']="Query run successfully :)";
        }
        
        // $db->close();

        return $res;
    }

    public function insert($tableName="", $insertArr=array(), $returnType="")
    {
        $db = \Config\Database::connect();

        $builder=$db->table($tableName);
        $builder->insertBatch($insertArr);

        $res=array();
        $res['query']=$lastQuery=$db->getLastQuery();

        if (empty($db->insertID())){
            $res['status']=FALSE;
            $res['error']=$db->error();
            $res['userData']=array();
            $res['message']="Unable to insert :(";
            $res['lastID']="";
        }else{
            $res['status']=TRUE;
            $res['error']=$db->error();
            $res['userData']=array();
            $res['message']="Data inserted successfully :)";
            $res['lastID']=$db->insertID();
        }

        return $res;
    }
    
    public function cronInsert($tableName="", $insertArr=array(), $returnType="", $connectionArr=array())
    {
        if(!empty($connectionArr))
            $db = \Config\Database::connect($connectionArr);
        else
            $db = \Config\Database::connect();

        $builder=$db->table($tableName);
        $builder->insertBatch($insertArr);
        
        $res=array();
        $res['query']=$lastQuery=$db->getLastQuery();

        if (empty($db->insertID())){
            $res['status']=FALSE;
            $res['error']=$db->error();
            $res['userData']=array();
            $res['message']="Unable to insert :(";
            $res['lastID']="";
        }else{
            $res['status']=TRUE;
            $res['error']=$db->error();
            $res['userData']=array();
            $res['message']="Data inserted successfully :)";
            $res['lastID']=$db->insertID();
        }
        
        // $db->close();

        return $res;
    }

    public function updateBatch($tableName="", $updateArr=array(), $updateKey="", $condtnArr=array(), $likeCondtnArr=array(), $whereInArray=array())
    {
        $db = \Config\Database::connect();

        $builder=$db->table($tableName);

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
        $res['query']=$lastQuery=$db->getLastQuery();

        if (!$db->simpleQuery($lastQuery)){
            $res['status']=FALSE;
            $res['error']=$db->error();
            $res['message']="Unable to update :(";
        }else{
            $res['status']=TRUE;
            $res['error']=$db->error();
            $res['message']="Data updated successfully :)";
        }

        return $res;
    }

    public function updateData($tableName="", $updateArr=array(), $condtnArr=array(), $likeCondtnArr=array(), $whereInArray=array())
    {
        $db = \Config\Database::connect();

        $builder=$db->table($tableName);

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
        $res['query']=$lastQuery=$db->getLastQuery();

        if (!$db->simpleQuery($lastQuery)){
            $res['status']=FALSE;
            $res['error']=$db->error();
            $res['message']="Unable to update :(";
        }else{
            $res['status']=TRUE;
            $res['error']=$db->error();
            $res['message']="Data updated successfully :)";
        }

        return $res;
    }

    public function insertLog($insertLogArr)
    {
        $db = \Config\Database::connect();

        $builder=$db->table('log_tbl');
        $builder->insert($insertLogArr);

        $res=array();
        $res['query']=$lastQuery=$db->getLastQuery();

        if (empty($db->insertID())){
            $res['status']=FALSE;
            $res['error']=$db->error();
            $res['userData']=array();
            $res['message']="Unable to insert :(";
            $res['lastID']="";
        }else{
            $res['status']=TRUE;
            $res['error']=$db->error();
            $res['userData']=array();
            $res['message']="Data inserted successfully :)";
            $res['lastID']=$db->insertID();
        }

        return $res;
    }
}

?>