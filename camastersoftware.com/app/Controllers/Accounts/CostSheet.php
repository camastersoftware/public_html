<?php namespace App\Controllers\Accounts;
use \App\Controllers\BaseController;

class CostSheet extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Cost Sheet";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mact = new \App\Models\Mact();
        $this->MtimeSheet = new \App\Models\MtimeSheet();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->user_tbl=$tableArr['user_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->act_tbl=$tableArr['act_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->time_sheet_tbl=$tableArr['time_sheet_tbl'];
        
        $currMth=date('n');
        $this->currentMth=date('n');
        $this->currentYear=date('Y');
        
        $this->data['currMth']=$currMth;
    }

	public function index()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Cost Sheet";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
	    return view('firm_panel/accounts/costsheet/home', $this->data);
	}

	public function client_wise_cost_sheet()
	{
	    ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Cost Sheet : Client-wise";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_group_tbl.client_group_cost", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, user_tbl.userShortName", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;

        return view('firm_panel/accounts/costsheet/client_wise_cost_sheet', $this->data);
	}

    public function client_wise_month_cost_sheet()
	{
	    ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $this->data['clientId']=$clientId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Cost Sheet : Client (Month-wise)";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.*, client_tbl.clientPanNumber, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $clientBussOrganisationType="";
        
        if(!empty($clientData))
            $clientBussOrganisationType=$clientData['clientBussOrganisationType'];
            
        if(in_array($clientBussOrganisationType, INDIVIDUAL_ARRAY))
            $clientNameVar=$clientData['clientName'];
        else
            $clientNameVar=$clientData['clientBussOrganisation'];
            
        $this->data['clientNameVar']=$clientNameVar;
            
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $finStartYr=$fin_year_arr[0];
        $finEndYr="20".$fin_year_arr[1];

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.fkClientId']=$clientId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.fk_org_type_id']=$clientBussOrganisationType;
        
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";

        $workGroupByArr = array('work_tbl.workId');

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->time_sheet_tbl, "condtn"=>"time_sheet_tbl.fkWorkId=work_tbl.workId AND time_sheet_tbl.status=1", "type"=>"left");

        $columnNames="
            work_tbl.workId, 
            work_tbl.workCode, 
            work_tbl.fk_due_date_id, 
            work_tbl.eFillingDate, 
            work_tbl.billAmt, 
            work_tbl.receiptAmt, 
            due_date_master_tbl.due_date_id, 
            due_date_master_tbl.periodicity, 
            due_date_master_tbl.daily_date, 
            due_date_master_tbl.period_month, 
            due_date_master_tbl.period_year, 
            due_date_master_tbl.f_period_month, 
            due_date_master_tbl.f_period_year, 
            due_date_master_tbl.t_period_month, 
            due_date_master_tbl.t_period_year,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, 
            act_tbl.act_name, 
            act_tbl.act_short_name, 
            due_date_for_tbl.act_option_name AS act_option_name1, 
            tax_payer_tbl.act_option_name AS act_option_name2, 
            audit_tbl.act_option_name AS act_option_name4, 
            applicable_form_tbl.act_option_name AS act_option_name5,
            due_date_master_tbl.due_act,
            ext_due_date_master_tbl.extended_date, 
            organisation_type_tbl.organisation_type_name AS tax_payer_val,
            SUM(time_sheet_tbl.tsTotalCost) AS workTotalCost
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        $workMthArr=array();
        $workListArr=array();
        $workIdArr = array();

        if(!empty($workDataArr))
        {
            $workIdArr = array_unique(array_column($workDataArr, "workId"));
            foreach($workDataArr AS $e_work)
            {
                $workListArr[$e_work['act_due_month']][]=$e_work;
            }
        }
        
        for($m_no=1;$m_no<13;$m_no++)
        {
            if($m_no<=9)
            {
                $m=$m_no+3;
                $mthVar=date("F-Y", strtotime("01-".$m."-".$finStartYr));
            }
            else
            {
                $m=$m_no-9;
                $mthVar=date("F-Y", strtotime("01-".$m."-".$finEndYr));
            }
                
            $workMthArr[$m]=$mthVar;
        }

        $this->data['workMthArr']=$workMthArr;
        $this->data['workListArr']=$workListArr;

        $staffCostArr = array();

        if(!empty($workIdArr))
        {
            $tsCondtn = array(
                'time_sheet_tbl.status'    => 1,
            );

            $tsGroupBy = array(
                "time_sheet_tbl.fkWorkId", 
                "time_sheet_tbl.fkUserId"
            );

            $timeSheetArr = $this->MtimeSheet->select("
                                                    SUM(time_sheet_tbl.tsTotalHours) AS tsTotalHours,
                                                    SUM(time_sheet_tbl.tsTotalCost) AS tsTotalCost,
                                                    time_sheet_tbl.fkWorkId,
                                                    time_sheet_tbl.fkUserId,
                                                    user_tbl.userFullName,
                                                    user_tbl.userShortName
                                                ")
                                                ->where($tsCondtn)
                                                ->whereIn("time_sheet_tbl.fkWorkId", $workIdArr)
                                                ->join($this->user_tbl, 'user_tbl.userId=time_sheet_tbl.fkUserId AND user_tbl.status=1', 'left')
                                                ->groupBy($tsGroupBy)
                                                ->findAll();

            if(!empty($timeSheetArr)){
                foreach($timeSheetArr AS $e_ts){
                    $staffCostArr[$e_ts["fkWorkId"]][] = $e_ts;
                }
            }
        }

        $this->data['staffCostArr'] = $staffCostArr;

        return view('firm_panel/accounts/costsheet/client_wise_month_cost_sheet', $this->data);
	}

    public function client_wise_act_cost_sheet()
	{
	    ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $this->data['clientId']=$clientId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Cost Sheet : Client (Act-wise)";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.*, client_tbl.clientPanNumber, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $clientBussOrganisationType="";
        
        if(!empty($clientData))
            $clientBussOrganisationType=$clientData['clientBussOrganisationType'];
            
        if(in_array($clientBussOrganisationType, INDIVIDUAL_ARRAY))
            $clientNameVar=$clientData['clientName'];
        else
            $clientNameVar=$clientData['clientBussOrganisation'];
            
        $this->data['clientNameVar']=$clientNameVar;

        $actArr = $this->Mact->where('status', 1)
                    ->orderBy('act_name', 'asc')
                    ->findAll();

        $this->data['actArr']=$actArr;
            
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $finStartYr=$fin_year_arr[0];
        $finEndYr="20".$fin_year_arr[1];

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.fkClientId']=$clientId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.fk_org_type_id']=$clientBussOrganisationType;
        
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";

        $workGroupByArr = array('work_tbl.workId');

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->time_sheet_tbl, "condtn"=>"time_sheet_tbl.fkWorkId=work_tbl.workId AND time_sheet_tbl.status=1", "type"=>"left");

        $columnNames="
            work_tbl.workId, 
            work_tbl.workCode, 
            work_tbl.fk_due_date_id, 
            work_tbl.eFillingDate, 
            work_tbl.billAmt, 
            work_tbl.receiptAmt, 
            due_date_master_tbl.due_date_id, 
            due_date_master_tbl.periodicity, 
            due_date_master_tbl.daily_date, 
            due_date_master_tbl.period_month, 
            due_date_master_tbl.period_year, 
            due_date_master_tbl.f_period_month, 
            due_date_master_tbl.f_period_year, 
            due_date_master_tbl.t_period_month, 
            due_date_master_tbl.t_period_year,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, 
            act_tbl.act_id,
            act_tbl.act_name,
            act_tbl.act_short_name, 
            due_date_for_tbl.act_option_name AS act_option_name1, 
            tax_payer_tbl.act_option_name AS act_option_name2, 
            audit_tbl.act_option_name AS act_option_name4, 
            applicable_form_tbl.act_option_name AS act_option_name5,
            due_date_master_tbl.due_act,
            ext_due_date_master_tbl.extended_date, 
            organisation_type_tbl.organisation_type_name AS tax_payer_val,
            SUM(time_sheet_tbl.tsTotalCost) AS workTotalCost
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        $workListArr=array();
        $workIdArr = array();

        if(!empty($workDataArr))
        {
            $workIdArr = array_unique(array_column($workDataArr, "workId"));
            foreach($workDataArr AS $e_work)
            {
                $workListArr[$e_work['act_id']][]=$e_work;
            }
        }

        $this->data['workListArr']=$workListArr;

        $staffCostArr = array();

        if(!empty($workIdArr))
        {
            $tsCondtn = array(
                'time_sheet_tbl.status'    => 1,
            );

            $timeSheetArr = $this->MtimeSheet->select("
                                                    SUM(time_sheet_tbl.tsTotalHours) AS tsTotalHours,
                                                    SUM(time_sheet_tbl.tsTotalCost) AS tsTotalCost,
                                                    time_sheet_tbl.fkWorkId,
                                                    time_sheet_tbl.fkUserId,
                                                    user_tbl.userFullName,
                                                    user_tbl.userShortName
                                                ")
                                                ->where($tsCondtn)
                                                ->whereIn("time_sheet_tbl.fkWorkId", $workIdArr)
                                                ->join($this->user_tbl, 'user_tbl.userId=time_sheet_tbl.fkUserId AND user_tbl.status=1', 'left')
                                                ->groupBy("time_sheet_tbl.fkWorkId")
                                                ->findAll();

            if(!empty($timeSheetArr)){
                foreach($timeSheetArr AS $e_ts){
                    $staffCostArr[$e_ts["fkWorkId"]][] = $e_ts;
                }
            }
        }

        $this->data['staffCostArr'] = $staffCostArr;

        return view('firm_panel/accounts/costsheet/client_wise_act_cost_sheet', $this->data);
	}
}