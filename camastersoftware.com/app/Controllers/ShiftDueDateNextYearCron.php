<?php
namespace App\Controllers;

class ShiftDueDateNextYearCron extends BaseController
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
        $currYr=date('Y');
        
        // if($currMth<=3)
        //     $prevYear=$currYr;
        // else
        //     $prevYear=$currYr-1;

        $prevYear=$currYr-1;
        
        $this->dueYear=$prevYear."-".(substr($prevYear+1, 2));
    }

	public function index()
	{
	    $this->MTestCron = new \App\Models\MTestCron();

        $cronRunMsg = "Cron run successfully at - ".$this->currTimeStamp;
	    
	    $testCronInsertArr=array(
            'testDesc' => $cronRunMsg
        );
        
        $this->MTestCron->save($testCronInsertArr);
        
        die($cronRunMsg);
        
        die("Access Denied");
	    echo "Cron Started for ".$this->dueYear." ...";
	    
	    $this->db->transBegin();
	    
	    log_message('error', 'Cron Start for '.$this->dueYear);
	   
        $taxCalFinYearAdminCookie=$this->dueYear;
            
        $taxYearArr=explode('-', $taxCalFinYearAdminCookie);
        
        $currentYearFrom=$taxYearArr[0]+1;
        $currentYearTo=$taxYearArr[1]+1;
        
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
                $nextDueDate=date('Y-m-d', strtotime($e_dd['due_date']." +1 years"));
                $ddFinYear=$e_dd['finYear'];
                
                $ddFinYearArr=explode('-', $ddFinYear);
        
                $currFinYearFrom=$ddFinYearArr[0]+1;
                $currFinYearTo=$ddFinYearArr[1]+1;
                
                $currFinYear=$currFinYearFrom."-".$currFinYearTo;
                
                if($periodicityVal==1)
                {
                    $new_daily_date=date('Y-m-d', strtotime($e_dd['daily_date']." +1 years"));
                    
                    unset($e_dd['daily_date']);
                    
                     $e_dd['daily_date']=$new_daily_date;
                }
                elseif($periodicityVal==2)
                {
                    $new_period_year=(int)$e_dd['period_year']+1;
                    
                    unset($e_dd['period_year']);
                    
                    $e_dd['period_year']=$new_period_year;
                }
                elseif($periodicityVal==3 || $periodicityVal==4 || $periodicityVal==5)
                {
                    $new_f_period_year=(int)$e_dd['f_period_year']+1;
                    $new_t_period_year=(int)$e_dd['t_period_year']+1;
                    
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
                
                $e_dd['finYear']=$currFinYear;
                $e_dd['due_date']=$nextDueDate;
                $e_dd['isExt']=2;
                $e_dd['byCron']=1;
                $e_dd['createdDatetime']=$this->currTimeStamp;
                
                $nextYrDueDateInsertArr[]=$e_dd;
                
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
                        
                        $firmList=$this->Mfirm->select('ca_firm_tbl.*')
                                        ->where('ca_firm_tbl.status', 1)
                                        ->where('ca_firm_tbl.caFirmStatus', 1)
                                        ->where('ca_firm_tbl.isVerified', 1)
                                        ->where('ca_firm_tbl.isTermsAgree', 1)
                                        ->where('ca_firm_tbl.caFirmCompanyKey !=', "")
                                        ->findAll();
                        
                        $caFirmIdArr=array();
                        
                        if(!empty($firmList))
                        {
                            foreach($firmList AS $k_firm=>$e_firm)
                            {
                                $caFirmId=$e_firm['caFirmId'];
                                
                                $caFirmIdArr[]=$this->createFirmClientsWork($caFirmId, $ddId, $due_date_id);
                            }
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
	
	public function createFirmClientsWork($caFirmId, $ddId, $due_date_id)
	{
	    $ca_firm_db_user=FIRM_DB_USERNAME;
        $ca_firm_db_pass=FIRM_DB_PASSWORD;
        // $ca_firm_db_name='camaster_ca_firm_'.$caFirmId;
        $ca_firm_db_name=FIRM_DB_NAME.$caFirmId;
        
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
        
        $connectionArray=$this->adminDB;
        
        $this->adminDBConn = \Config\Database::connect($this->adminDB);
        
        if($this->adminDBConn)
	    {
            $this->work_tbl=$ca_firm_db_name.".work_tbl";
            $this->work_junior_map_tbl=$ca_firm_db_name.".work_junior_map_tbl";
            
    	    $workCondtnArr['work_tbl.fk_due_date_id']=$ddId;
            $workCondtnArr['work_tbl.status']=1;
    
            // $query=$this->Mcommon->cronGetRecords($tableName=$this->work_tbl, $colNames="work_tbl.*", $workCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array(), $connectionArr=$connectionArray);
            $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.*", $workCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
            
            $clientWorkArr=$query['userData'];
            
            if(!empty($clientWorkArr))
            {
                foreach($clientWorkArr AS $e_wrk)
                {
                    $uniqueId=strtoupper(substr(str_shuffle(uniqid()), 0, 4));
    
                    $workCode="WORKID_".$uniqueId;

                    $clientWorkInsertArr=array();
    
                    $clientWorkInsertArr[] = [
                        'workCode'=>$workCode,
                        'fk_due_date_id'=>$due_date_id,
                        'fkClientId'=>$e_wrk['fkClientId'],
                        'juniors'=>$e_wrk['juniors'],
                        'seniorId'=>$e_wrk['seniorId'],
                        'byCron' => 1,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    ];

                    $query=$this->Mcommon->insert($tableName=$this->work_tbl, $clientWorkInsertArr, $returnType="");

                    if($query['status']==TRUE)
                    {
                        $workId=$query['lastID'];

                        $jnrCondtnArr=array();

                        $jnrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
                        $jnrCondtnArr['work_junior_map_tbl.status']="1";
                        
                        $query=$this->Mcommon->getRecords($tableName=$this->work_junior_map_tbl, $colNames="work_junior_map_tbl.fkWorkId, work_junior_map_tbl.fkUserId", $jnrCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
                        
                        $jnrList=$query['userData'];

                        if(!empty($jnrList))
                        {
                            $junrInsertArr=array();

                            foreach($jnrList AS $e_jnr)
                            {
                                $junrInsertArr[] = [
                                    'fkWorkId'=>$e_jnr['fkWorkId'],
                                    'fkUserId'=>$e_jnr['fkUserId'],
                                    'status' => 1,
                                    'createdBy' => $this->adminId,
                                    'createdDatetime' => $this->currTimeStamp
                                ];
                            }

                            $this->Mcommon->insert($tableName=$this->work_junior_map_tbl, $junrInsertArr, $returnType="");
                        }
                    }
                }
                
                // if(!empty($clientWorkInsertArr))
                // {
                //     // $query=$this->Mcommon->cronInsert($tableName=$this->work_tbl, $clientWorkInsertArr, $returnType="", $connectionArr=$connectionArray);
                //     // $query=$this->Mcommon->insert($tableName=$this->work_tbl, $clientWorkInsertArr, $returnType="");
                    
                //     if($query['status']==TRUE)
                //     {
                //         $caFirmMsg='Work has been shifted successfully for Firm : '.$caFirmId;
                        
                //         log_message('error', $caFirmMsg);
                        
                //         $insertLogArr['section']=$this->section;
                //         $insertLogArr['message']=$caFirmMsg;
                //         $insertLogArr['ip']=$this->IPAddress;
                //         $insertLogArr['createdBy']=$this->adminId;
                //         $insertLogArr['createdDatetime']=$this->currTimeStamp;
            
                //         $this->Mcommon->insertLog($insertLogArr);
                        
                //         echo "<br>";
                //         echo "<br>".$caFirmMsg;
                //     }
                //     else
                //     {
                //         $caFirmMsg='Work has not Shifted for Firm : '.$caFirmId;
                        
                //         log_message('error', $caFirmMsg);
                        
                //         echo "<br>";
                //         echo "<br>".$caFirmMsg;
                //     }
                // }
            }
	    }
	    
        if($this->adminDBConn->transStatus() === FALSE){
            
            $this->adminDBConn->transRollback();
            
            $caFirmMsg='Work has not Shifted for Firm : '.$caFirmId;
                        
            log_message('error', $caFirmMsg);
            
            echo "<br>";
            echo "<br>".$caFirmMsg;

        }else{

            $this->adminDBConn->transCommit();

            $caFirmMsg='Work has been shifted successfully for Firm : '.$caFirmId;
                        
            log_message('error', $caFirmMsg);
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$caFirmMsg;
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
            echo "<br>";
            echo "<br>".$caFirmMsg;
        }

	    $this->adminDBConn->close();
	    
	    $workCondtnArr=array();
        $clientWorkInsertArr=array();
        $insertLogArr=array();
	}
}

?>