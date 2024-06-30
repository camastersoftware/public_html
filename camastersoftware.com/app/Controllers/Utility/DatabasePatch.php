<?php namespace App\Controllers\Utility;
use \App\Controllers\BaseController;

class DatabasePatch extends BaseController
{
    public function __construct()
    {
        $this->section="Database Patch";
        $this->Mfirm = new \App\Models\Mfirm();
        $this->MorganisationType = new \App\Models\MorganisationType();
        $this->ConnectDb = new \App\Libraries\ConnectDb();
        $this->TableLib = new \App\Libraries\TableLib();
        $tableArr=$this->TableLib->get_tables();

        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];

        $currMth=date('n');
        $currYr=date('Y');

        $prevYear=$currYr-1;
        
        $this->dueYear=$prevYear."-".(substr($prevYear+1, 2));
    }

	public function updateNewDueDateOrganization()
	{
        die("Access Denied");
        echo "updateNewDueDateOrganization Started ... Time : ".date("Y-m-d H:i:s");

        $this->db->transBegin();

        log_message('error', 'Start for updateNewDueDateOrganization');

        $organisationTypes=$this->MorganisationType->where('organisation_type_tbl.status', 1)
                        ->findAll();


        $taxCondtnArr['due_date_master_tbl.status']=1;

        $taxOrderByArr['due_date_master_tbl.due_date_id']="ASC";

        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames="due_date_master_tbl.*", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr=array(), $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];

        if(!empty($dueDatesArr))
        {
            foreach($dueDatesArr AS $k_dd=>$e_dd)
            {
                $ddId=$e_dd['due_date_id'];
                $is_all_tax_payer=$e_dd['is_all_tax_payer'];

                $taxPayerCondtnArr['tax_payer_due_date_map_tbl.fk_due_date_id']=$ddId;
                $taxPayerCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        
                $query=$this->Mcommon->getRecords($tableName=$this->tax_payer_due_date_map_tbl, $colNames="tax_payer_due_date_map_tbl.*", $taxPayerCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
                
                $taxPayerArr=$query['userData'];
                
                if(!empty($taxPayerArr))
                {
                    $taxPayerInsertArr = array();

                    if($is_all_tax_payer==1)
                    {
                        $org_type_id_arr = array_column($taxPayerArr, 'fk_org_type_id');
                        if(!empty($organisationTypes))
                        {
                            foreach($organisationTypes AS $e_org_data)
                            {
                                if(!in_array($e_org_data["organisation_type_id"], $org_type_id_arr))
                                {
                                    $taxPayerInsertArr[]=array(
                                        'fk_due_date_id' => $ddId,
                                        'fk_org_type_id' => $e_org_data["organisation_type_id"],
                                        'byCron' => 1,
                                        'status' => 1,
                                        'createdBy' => $this->adminId,
                                        'createdDatetime' => $this->currTimeStamp
                                    );
                                }
                            }
                        }
                    }
                    
                    
                    if(!empty($taxPayerInsertArr))
                    {
                        // echo "organisationTypes<br><br>";
                        // echo "Count : ".count($organisationTypes)."<br>";
                        // print_r($organisationTypes);
                        // echo "<br>-----------------------------------------<br>";
                        // echo "org_type_id_arr<br><br>";
                        // echo "Count : ".count($org_type_id_arr)."<br>";
                        // print_r($org_type_id_arr);
                        // echo "<br>-----------------------------------------<br>";
                        // echo "taxPayerInsertArr<br><br>";
                        // echo "Count : ".count($taxPayerInsertArr)."<br>";
                        // print_r($taxPayerInsertArr);
                        // die('debug 101');
                        // $this->Mcommon->insert($tableName=$this->tax_payer_due_date_map_tbl, $taxPayerInsertArr, $returnType="");
                    }
                }

                $taxPayerCondtnArr=array();
                $taxPayerInsertArr=array();
            }
        }

        if($this->db->transStatus() === FALSE){

            $this->db->transRollback();
            
            log_message('error', 'New Organization for Due Date has not Added');
            
            echo "<br>";
            echo "<br>Not Run Properly...";

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="New Organization for Due Date Added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
            log_message('error', 'New Organization for Due Date has been added successfully');
            
            echo "<br>";
            echo "<br>Successfully Run... Time : ".date("Y-m-d H:i:s");
        }
	}
}