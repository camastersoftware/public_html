<?php
namespace App\Controllers;

class ShiftDueDatePreviousYearCron extends BaseController
{
    public function __construct()
    {
        $this->section="Crons";
        $this->Mfirm = new \App\Models\Mfirm();
        $this->ConnectDb = new \App\Libraries\ConnectDb();
        $this->TableLib = new \App\Libraries\TableLib();
        $tableArr=$this->TableLib->get_tables();

        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];

        $currMth=date('n');
        $prevYr=date('Y')-1;
        
        if($currMth<=3)
            $prevYear=$prevYr-1;
        else
            $prevYear=$prevYr;
        
        $this->dueYear=$prevYear."-".(substr($prevYear+1, 2));
        
        die('Access Denied');
    }

	public function index()
	{
	    die('Access Denied');
	    echo "Cron Started...";
	    
	    $this->db->transBegin();
	    
	    $setPrevYear=4; // 2017-18
	    
	    log_message('error', 'Cron Start');
	   
        $taxCalFinYearAdminCookie=$this->dueYear;
            
        $taxYearArr=explode('-', $taxCalFinYearAdminCookie);
        
        $currentYearFrom=$taxYearArr[0]-$setPrevYear;
        $currentYearTo=$taxYearArr[1]-$setPrevYear;
        
        $currentFinYear=$currentYearFrom."-".$currentYearTo;
        
        $taxFromYear=date('Y-m-d', strtotime("01-04-".$taxYearArr[0]));
        $taxToYear=date('Y-m-d', strtotime("31-03-20".$taxYearArr[1]));
        
        $taxCondtnArr['due_date_master_tbl.due_date >=']=$taxFromYear;
        $taxCondtnArr['due_date_master_tbl.due_date <=']=$taxToYear;
            
        $taxCondtnArr['due_date_master_tbl.status']=1;
            
        $taxOrderByArr['due_date_master_tbl.due_date_id']="ASC";

        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames="due_date_master_tbl.*", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr=array(), $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $nextYrDueDateArr=array();
        
        if(!empty($dueDatesArr))
        {
            foreach($dueDatesArr AS $k_dd=>$e_dd)
            {
                $ddId=$e_dd['due_date_id'];
                $periodicityVal=$e_dd['periodicity'];
                $nextDueDate=date('Y-m-d', strtotime($e_dd['due_date']." -".$setPrevYear." years"));
                
                // print_r($e_dd);
                
                if($periodicityVal==1)
                {
                    $new_daily_date=date('Y-m-d', strtotime($e_dd['daily_date']." -".$setPrevYear." years"));
                    
                    unset($e_dd['daily_date']);
                    
                     $e_dd['daily_date']=$new_daily_date;
                }
                elseif($periodicityVal==2)
                {
                    $new_period_year=(int)$e_dd['period_year']-$setPrevYear;
                    
                    unset($e_dd['period_year']);
                    
                    $e_dd['period_year']=$new_period_year;
                }
                elseif($periodicityVal==3 || $periodicityVal==4 || $periodicityVal==5)
                {
                    $new_f_period_year=(int)$e_dd['f_period_year']-$setPrevYear;
                    $new_t_period_year=(int)$e_dd['t_period_year']-$setPrevYear;
                    
                    unset($e_dd['f_period_year']);
                    unset($e_dd['t_period_year']);
                    
                    $e_dd['f_period_year']=$new_f_period_year;
                    $e_dd['t_period_year']=$new_t_period_year;
                }
            
                unset($e_dd['due_date_id']);
                unset($e_dd['finYear']);
                unset($e_dd['due_date']);
                unset($e_dd['ext_due_date']);
                unset($e_dd['byCron']);
                unset($e_dd['createdDatetime']);
                unset($e_dd['updatedBy']);
                unset($e_dd['updatedDatetime']);
                
                $e_dd['finYear']=$currentFinYear;
                $e_dd['due_date']=$nextDueDate;
                $e_dd['isExt']=2;
                $e_dd['byCron']=1;
                $e_dd['createdDatetime']=$this->currTimeStamp;
                
                $nextYrDueDateInsertArr[]=$e_dd;
                
                // print_r($nextYrDueDateInsertArr);
                // die();
                
                $query=$this->Mcommon->insert($tableName=$this->due_date_master_tbl, $nextYrDueDateInsertArr, $returnType="");
                
                if($query['status']==TRUE)
                {
                    $due_date_id=$query['lastID'];
                    $due_date=$e_dd['due_date'];
                    $due_notes=$e_dd['due_notes'];
                    
                    $extDueDateInsertArr[] = [
                        'fk_due_date_master_id'=>$due_date_id,
                        'extended_date'=>$nextDueDate,
                        'extended_date_notes'=>$due_notes,
                        'is_extended'=>2,
                        'isFirst'=>1,
                        'byCron'=>1,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    ];
            
                    $query=$this->Mcommon->insert($tableName=$this->ext_due_date_master_tbl, $extDueDateInsertArr, $returnType="");
                    
                    if($query['status']==TRUE)
                    {
                        $taxPayerCondtnArr['tax_payer_due_date_map_tbl.fk_due_date_id']=$ddId;
                        $taxPayerCondtnArr['tax_payer_due_date_map_tbl.status']=1;
                
                        $query=$this->Mcommon->getRecords($tableName=$this->tax_payer_due_date_map_tbl, $colNames="tax_payer_due_date_map_tbl.*", $taxPayerCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
                        
                        $taxPayerArr=$query['userData'];
                        
                        if(!empty($taxPayerArr))
                        {
                            foreach($taxPayerArr AS $e_tax_payer)
                            {
                                $taxPayerInsertArr[]=array(
                                    'fk_due_date_id'=>$due_date_id,
                                    'fk_org_type_id'=>$e_tax_payer['fk_org_type_id'],
                                    'byCron' => 1,
                                    'status' => 1,
                                    'createdBy' => $this->adminId,
                                    'createdDatetime' => $this->currTimeStamp
                                );
                            }
                            
                            if(!empty($taxPayerInsertArr))
                                $this->Mcommon->insert($tableName=$this->tax_payer_due_date_map_tbl, $taxPayerInsertArr, $returnType="");
                        }
                    }
                }
                
                $nextYrDueDateInsertArr=array();
                $extDueDateInsertArr=array();
                $taxPayerCondtnArr=array();
                $taxPayerInsertArr=array();
            }
        }
        
        echo "<br>";
        echo "<br>Cron Ended...";
        
        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();
            
            log_message('error', 'Due Dates has not Shifted');
            
            echo "<br>";
            echo "<br>Cron Not Run Properly...";

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Due Date Shifted to Next Financial Year : ".$currentFinYear;
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
            log_message('error', 'Due Dates has been shifted successfully');
            
            echo "<br>";
            echo "<br>Cron Successfully Run...";
        }
	}
}

?>