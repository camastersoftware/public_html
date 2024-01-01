<?php namespace App\Libraries;

class DueDueLib
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        
        $this->sessDueDateYear=$this->session->get('dueDateYear');
        
        $this->Mdue_date = new \App\Models\Mdue_date();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new TableLib();
        
        $tableArr=$this->TableLib->get_tables();
        
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
    }
    
	public function getPeriod($dueDateId)
	{
	    $ddfCondtn = array(
	        'due_date_id'   => $dueDateId,
	        'status'        => 1
	    );
	    
        $dataArr = $this->Mdue_date->where($ddfCondtn)->first();
        
        $ddfPeriod = "";
        
        if(!empty($dataArr))
        {
            if($dataArr['periodicity']=="1")
            {
                if(check_valid_date($dataArr["daily_date"]))
                    $ddfPeriod = date("d-M-Y", strtotime($dataArr["daily_date"]));
            }
            elseif($dataArr['periodicity']=="2")
            {
                $ddfPeriod = date("M", strtotime("2021-".$dataArr["period_month"]."-01"))."-".$dataArr["period_year"];
            }
            elseif($dataArr['periodicity']>="3")
            {
                $ddfPeriod = date("M", strtotime("2021-".$dataArr["f_period_month"]."-01"))."-".$dataArr["f_period_year"]." - ".date("M", strtotime("2021-".$dataArr["t_period_month"]."-01"))."-".$dataArr["t_period_year"];
            }
            else
            {
                $ddfPeriod = "";
            }
        }
        
        return $ddfPeriod;
	}
	
	public function getDueDateData($actId, $ddType="", $type="ddType")
	{
        $fin_year_arr=explode("-", $this->sessDueDateYear);
    
        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $ddWhereInArray=array();
    
        $ddCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $ddCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $ddCondtnArr['work_tbl.status']="1";
        $ddCondtnArr['due_date_master_tbl.status']=1;
        $ddCondtnArr['due_date_for_tbl.status']=1;
        
        if(!is_array($actId))
            $ddCondtnArr['due_date_master_tbl.due_act']=$actId;
        else
            $ddWhereInArray['due_date_master_tbl.due_act']=$actId;
            
        if(!empty($ddType))
            $ddCondtnArr['due_date_for_tbl.due_date_type']=$ddType;
        
        $ddGroupByArr=array('due_date_master_tbl.due_date_for', 'due_date_for_tbl.due_date_type');
        
        $ddJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $ddJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $ddJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
            due_date_for_tbl.due_date_type,
            due_date_master_tbl.due_date_for
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $ddCondtnArr, $likeCondtnArr=array(), $ddJoinArr, $singleRow=FALSE, $orderByArr=array(), $ddGroupByArr, $ddWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $ddDataArr=$query['userData'];
        
        $responseArr = array();
        
        if(!empty($ddDataArr))
        {
            if($type=="ddType")
                $responseArr = array_unique(array_column($ddDataArr, 'due_date_type'));
            elseif($type=="ddFor")
                $responseArr = array_unique(array_column($ddDataArr, 'due_date_for'));
        }
        
        return $responseArr;
	}
}
?>