<?php namespace App\Controllers\ComplianceSection;
use \App\Controllers\BaseController;

class TdsTcs extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="TDS-TCS - Income Tax";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Muser = new \App\Models\Muser();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->MDueDateType = new \App\Models\MDueDateType();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->DueDueLib = new \App\Libraries\DueDueLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->act_tbl=$tableArr['act_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->client_document_tbl=$tableArr['client_document_tbl'];
        $this->group_category_tbl=$tableArr['group_category_tbl'];
        $this->salutation_tbl=$tableArr['salutation_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
        $this->client_act_map_tbl=$tableArr['client_act_map_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->work_junior_map_tbl=$tableArr['work_junior_map_tbl'];
        $this->refund_tbl=$tableArr['refund_tbl'];
        $this->rectification_tbl=$tableArr['rectification_tbl'];
        $this->periodicity_tbl=$tableArr['periodicity_tbl'];
        
        $this->actIdVal = 3;
        $this->pmtDocId = 2;
        $this->pmtDocName="TAN";
        
        $currMth=date('n');
        $this->currentMth=date('n');
        $this->currentYear=date('Y');
        
        $this->data['currMth']=$currMth;
        
        // Work Form Route
        $this->workFormRoute[1]="tds-tcs-work-form/"; // Returns
        $this->workFormRoute[2]=""; // Payments
        $this->workFormRoute[3]=""; // Audits
        $this->workFormRoute[4]=""; // Certificates
        $this->workFormRoute[5]=""; // Stmt cum Challan
        $this->workFormRoute[6]=""; // Forms
        $this->workFormRoute[7]=""; // Other
        
        $this->secPrefixUrl="tds-tcs"; // Section Prefix URL
        $this->cookiekPref="tds_tcs"; // Cookie Prefix
    }
    
    function setMyCookie($name,$value,$time,$params = array()){
        
        $cookieName = $this->cookiekPref."_".$name;
        
        if (empty($params)){
            $config = config('App');
    
            $params = array(
                'expires'   => $time,
                'path'      => $config->cookiePath,
                'domain'    => $config->cookieDomain,
                'secure'    => $config->cookieSecure,
                'httponly'  => $config->cookieHTTPOnly,
                'samesite'  => $config->cookieSameSite,
            );
        }
    
        setcookie($cookieName,$value,$params);
    }
    
    function getMyCookie($name){
        
        $cookieName = $this->cookiekPref."_".$name;
        
        $cookieValue = (!empty(get_cookie($cookieName))) ? get_cookie($cookieName) : "";
    
        return $cookieValue;
    }
    
    public function menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS : Work Programme";
        $this->data['pageTitle']=$pageTitle;
        
        $availDDTypesArr=$this->DueDueLib->getDueDateData($this->actIdVal);

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['secPrefixUrl']=$this->secPrefixUrl;
        
        if(!empty($availDDTypesArr))
        {
            $ddTypeArr = $this->MDueDateType->whereIn('dueDateTypeId', $availDDTypesArr)
                                    // ->where('dueDateTypeId !=', 4)
                                    ->where('status', 1)
                                    ->findAll();
        }
        else
        {
            $ddTypeArr=array();
        }
    
        $this->data['ddTypeArr']=$ddTypeArr;

        return view('firm_panel/compliance/tds_tcs/menus', $this->data);
    }
    
    public function due_date_for($ddType)
    {
        ini_set('memory_limit', '-1');
        
        $ddTypeDataArr = $this->MDueDateType->where('dueDateTypeId', $ddType)
                                ->where('status', 1)
                                ->first();
        
        $due_date_type = (!empty($ddTypeDataArr['dueDateTypeName'])) ? $ddTypeDataArr['dueDateTypeName']: "";
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - ".$due_date_type;
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['secPrefixUrl']=$this->secPrefixUrl;
        
        $availDDForArr=$this->DueDueLib->getDueDateData($this->actIdVal, $ddType, "ddFor");
        
        if(!empty($availDDForArr))
        {
            $ddfArr = $this->Mact_option->where('act_option_map_tbl.status', 1)
                            ->whereIn('act_option_map_tbl.act_option_map_id', $availDDForArr)
                            ->where('act_option_map_tbl.fk_act_id', $this->actIdVal)
                            ->where('act_option_map_tbl.option_type', 1)
                            ->where('act_option_map_tbl.due_date_type', $ddType)
                            ->orderBy('act_option_map_tbl.sortBy', "ASC")
                            ->findAll();
        }
        else
        {
            $ddfArr = array();
        }
    
        $this->data['ddfArr']=$ddfArr;
        
        if($ddType==2)
            $viewPage = "due_date_for_payment";
        else
            $viewPage = "due_date_for";

        return view('firm_panel/compliance/tds_tcs/'.$viewPage, $this->data);
    }
    
    public function pending($ddfId)
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        
        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['secPrefixUrl']=$this->secPrefixUrl;
        
        $this->data['ddfId']=$ddfId;
        
        $ddfDataArr=$this->Mact_option->where('act_option_map_id', $ddfId)
                    ->where('fk_act_id', $this->actIdVal)
                    ->where('status', 1)
                    ->first();
    
        $this->data['ddfDataArr']=$ddfDataArr;
        
        $due_date_type = (!empty($ddfDataArr['due_date_type'])) ? $ddfDataArr['due_date_type']: "";
        
        $this->data['due_date_type']=$due_date_type;
        
        $workFormUrl="";
        
        if(isset($this->workFormRoute[$due_date_type]))
        {
            $workFormUrl = (!empty($this->workFormRoute[$due_date_type])) ? $this->workFormRoute[$due_date_type] : "";
        }
        
        $this->data['workFormUrl']=$workFormUrl;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $ftr_clientgrp = $this->getMyCookie($ddfId."_clientgrp_cookie");
        $ftr_client = $this->getMyCookie($ddfId."_client_cookie");
        $ftr_junior = $this->getMyCookie($ddfId."_junior_cookie");
        $ftr_staff = $this->getMyCookie($ddfId."_staff_cookie");
        $ftr_e_verify = $this->getMyCookie($ddfId."_e_verify_cookie");
        $ftr_set_by = $this->getMyCookie($ddfId."_set_by_cookie");
        $ftr_billing = $this->getMyCookie($ddfId."_billing_cookie");
        $ftr_receipt = $this->getMyCookie($ddfId."_receipt_cookie");
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_junior))
            $workCondtnArr['work_junior_map_tbl.fkUserId']=$ftr_junior;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_junior']=$ftr_junior;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_e_verify']=$ftr_e_verify;
        $this->data['ftr_set_by']=$ftr_set_by;
        $this->data['ftr_billing']=$ftr_billing;
        $this->data['ftr_receipt']=$ftr_receipt;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
    
        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
    
        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.due_date_for']=$ddfId;
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=$this->actIdVal;
        $workCondtnArr['act_tbl.status']="1";
        
        $workCustomWhereArray[]=" (work_tbl.eFillingDate IS NULL OR work_tbl.eFillingDate='' OR work_tbl.eFillingDate='0000-00-00' OR work_tbl.eFillingDate='1970-01-01')";
        
        if($ftr_e_verify==1)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate!='' AND work_tbl.verificationDate!='0000-00-00' AND work_tbl.verificationDate!='1970-01-01'";
        }
        elseif($ftr_e_verify==2)
        {
            $workCustomWhereArray[]=" (work_tbl.verificationDate='' OR work_tbl.verificationDate='0000-00-00' OR work_tbl.verificationDate='1970-01-01')";
        }
        
        if($ftr_set_by==1)
        {
            $workCondtnArr['work_tbl.set_prepared_by !=']='';
        }
        elseif($ftr_set_by==2)
        {
            $workCustomWhereArray[]="work_tbl.set_prepared_by=''";
        }
        
        if($ftr_billing==1)
        {
            $workCondtnArr['work_tbl.isBillingDone']='1';
        }
        elseif($ftr_billing==2)
        {
            $workCustomWhereArray[]=" (work_tbl.isBillingDone='' OR work_tbl.isBillingDone IS NULL OR work_tbl.isBillingDone='2')";
        }
        
        if($ftr_receipt==1)
        {
            $workCondtnArr['work_tbl.isReceiptDone']='1';
        }
        elseif($ftr_receipt==2)
        {
            $workCustomWhereArray[]=" (work_tbl.isReceiptDone='' OR work_tbl.isReceiptDone IS NULL OR work_tbl.isReceiptDone='2')";
        }
        
        if($ftr_e_verify==2 || $ftr_set_by==2 || $ftr_billing==2 || $ftr_receipt==2)
        {
            $workCustomWhereArray[]="work_tbl.eFillingDate!='' AND work_tbl.eFillingDate!='0000-00-00' AND work_tbl.eFillingDate!='1970-01-01'";
        }
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl." AS prepared_user_tbl", "condtn"=>"prepared_user_tbl.userId=work_tbl.set_prepared_by AND prepared_user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
            work_tbl.workId,
            work_tbl.workCode,
            work_tbl.isDocRecvd,
            work_tbl.isUrgentWork,
            work_tbl.juniors,
            work_tbl.isBillingDone,
            work_tbl.isReceiptDone,
            work_tbl.eFillingDate,
            work_tbl.workDone,
            work_tbl.verificationDate,
            work_tbl.set_prepared_by,
            work_tbl.workPriorityColor,
            user_tbl.userShortName AS seniorName,
            prepared_user_tbl.userShortName AS setPreparedShortName,
            due_date_master_tbl.due_date_id,
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.finYear,
            ext_due_date_master_tbl.extended_date,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            due_date_for_tbl.act_option_name AS act_option_name1,
            due_date_for_tbl.due_date_type,
            periodicity_tbl.periodicity_name,
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientTitle,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
    
        $this->data['workDataArr']=$workDataArr;
        
        $retMthArr=array();
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            $retMthArr = array_unique(array_column($workDataArr, 'act_due_month'));
            
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['retMthArr']=$retMthArr;
        $this->data['mthDataArr']=$mthDataArr;
        $this->data['mthDDFArr']=$mthDDFArr;
        $this->data['mthDDFDueDateArr']=$mthDDFDueDateArr;
        $this->data['mthDDFDueDateForClientArr']=$mthDDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->findAll();

        $this->data['groupList']=$groupList;
        
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;
        
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userFullName']="ASC";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        return view('firm_panel/compliance/tds_tcs/pending', $this->data);
    }
    
    public function filed($ddfId)
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        
        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - Returns - Filed";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['secPrefixUrl']=$this->secPrefixUrl;
        
        $this->data['ddfId']=$ddfId;
        
        $this->data['workFormRoute']=$this->workFormRoute;
        
        $ddfDataArr=$this->Mact_option->where('act_option_map_id', $ddfId)
                    ->where('fk_act_id', $this->actIdVal)
                    ->where('status', 1)
                    ->first();
    
        $this->data['ddfDataArr']=$ddfDataArr;
        
        $due_date_type = (!empty($ddfDataArr['due_date_type'])) ? $ddfDataArr['due_date_type']: "";
        
        $this->data['due_date_type']=$due_date_type;
        
        $workFormUrl="";
        
        if(isset($this->workFormRoute[$due_date_type]))
        {
            $workFormUrl = (!empty($this->workFormRoute[$due_date_type])) ? $this->workFormRoute[$due_date_type] : "";
        }
        
        $this->data['workFormUrl']=$workFormUrl;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $ftr_clientgrp = $this->getMyCookie($ddfId."_clientgrp_cookie");
        $ftr_client = $this->getMyCookie($ddfId."_client_cookie");
        $ftr_junior = $this->getMyCookie($ddfId."_junior_cookie");
        $ftr_staff = $this->getMyCookie($ddfId."_staff_cookie");
        $ftr_e_verify = $this->getMyCookie($ddfId."_e_verify_cookie");
        $ftr_set_by = $this->getMyCookie($ddfId."_set_by_cookie");
        $ftr_billing = $this->getMyCookie($ddfId."_billing_cookie");
        $ftr_receipt = $this->getMyCookie($ddfId."_receipt_cookie");
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_junior))
            $workCondtnArr['work_junior_map_tbl.fkUserId']=$ftr_junior;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_junior']=$ftr_junior;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_e_verify']=$ftr_e_verify;
        $this->data['ftr_set_by']=$ftr_set_by;
        $this->data['ftr_billing']=$ftr_billing;
        $this->data['ftr_receipt']=$ftr_receipt;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
    
        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
    
        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.due_date_for']=$ddfId;
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=$this->actIdVal;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        
        if($ftr_e_verify==1)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate!='' AND work_tbl.verificationDate!='0000-00-00' AND work_tbl.verificationDate!='1970-01-01'";
        }
        elseif($ftr_e_verify==2)
        {
            $workCustomWhereArray[]=" (work_tbl.verificationDate='' OR work_tbl.verificationDate='0000-00-00' OR work_tbl.verificationDate='1970-01-01')";
        }
        
        if($ftr_set_by==1)
        {
            $workCondtnArr['work_tbl.set_prepared_by !=']='';
        }
        elseif($ftr_set_by==2)
        {
            $workCustomWhereArray[]="work_tbl.set_prepared_by=''";
        }
        
        if($ftr_billing==1)
        {
            $workCondtnArr['work_tbl.isBillingDone']='1';
        }
        elseif($ftr_billing==2)
        {
            $workCustomWhereArray[]=" (work_tbl.isBillingDone='' OR work_tbl.isBillingDone IS NULL OR work_tbl.isBillingDone='2')";
        }
        
        if($ftr_receipt==1)
        {
            $workCondtnArr['work_tbl.isReceiptDone']='1';
        }
        elseif($ftr_receipt==2)
        {
            $workCustomWhereArray[]=" (work_tbl.isReceiptDone='' OR work_tbl.isReceiptDone IS NULL OR work_tbl.isReceiptDone='2')";
        }
        
        if($ftr_e_verify==2 || $ftr_set_by==2 || $ftr_billing==2 || $ftr_receipt==2)
        {
            $workCustomWhereArray[]="work_tbl.eFillingDate!='' AND work_tbl.eFillingDate!='0000-00-00' AND work_tbl.eFillingDate!='1970-01-01'";
        }
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl." AS prepared_user_tbl", "condtn"=>"prepared_user_tbl.userId=work_tbl.set_prepared_by AND prepared_user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
            work_tbl.workId,
            work_tbl.workCode,
            work_tbl.isDocRecvd,
            work_tbl.isUrgentWork,
            work_tbl.juniors,
            work_tbl.isBillingDone,
            work_tbl.isReceiptDone,
            work_tbl.eFillingDate,
            work_tbl.workDone,
            work_tbl.verificationDate,
            work_tbl.set_prepared_by,
            work_tbl.workPriorityColor,
            user_tbl.userShortName AS seniorName,
            prepared_user_tbl.userShortName AS setPreparedShortName,
            due_date_master_tbl.due_date_id,
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.finYear,
            ext_due_date_master_tbl.extended_date,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            due_date_for_tbl.act_option_name AS act_option_name1,
            due_date_for_tbl.due_date_type,
            periodicity_tbl.periodicity_name,
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientTitle,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
    
        $this->data['workDataArr']=$workDataArr;
        
        $retMthArr=array();
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            $retMthArr = array_unique(array_column($workDataArr, 'act_due_month'));
            
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['retMthArr']=$retMthArr;
        $this->data['mthDataArr']=$mthDataArr;
        $this->data['mthDDFArr']=$mthDDFArr;
        $this->data['mthDDFDueDateArr']=$mthDDFDueDateArr;
        $this->data['mthDDFDueDateForClientArr']=$mthDDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->findAll();

        $this->data['groupList']=$groupList;
        
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;
        
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userFullName']="ASC";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        return view('firm_panel/compliance/tds_tcs/filed', $this->data);
    }
    
    public function payments($ddfId)
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        
        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - Payments";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['secPrefixUrl']=$this->secPrefixUrl;
        
        $this->data['ddfId']=$ddfId;
        
        $this->data['pmtDocName']=$this->pmtDocName;
        
        $ddfDataArr=$this->Mact_option->where('act_option_map_id', $ddfId)
                    ->where('fk_act_id', $this->actIdVal)
                    ->where('status', 1)
                    ->first();
    
        $this->data['ddfDataArr']=$ddfDataArr;
        
        $due_date_type = (!empty($ddfDataArr['due_date_type'])) ? $ddfDataArr['due_date_type']: "";
        
        $this->data['due_date_type']=$due_date_type;
        
        $workFormUrl="";
        
        if(isset($this->workFormRoute[$due_date_type]))
        {
            $workFormUrl = (!empty($this->workFormRoute[$due_date_type])) ? $this->workFormRoute[$due_date_type] : "";
        }
        
        $this->data['workFormUrl']=$workFormUrl;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $ftr_clientgrp = $this->getMyCookie($ddfId."_clientgrp_cookie");
        $ftr_client = $this->getMyCookie($ddfId."_client_cookie");
        $ftr_junior = $this->getMyCookie($ddfId."_junior_cookie");
        $ftr_staff = $this->getMyCookie($ddfId."_staff_cookie");
        $ftr_e_verify = $this->getMyCookie($ddfId."_e_verify_cookie");
        $ftr_set_by = $this->getMyCookie($ddfId."_set_by_cookie");
        $ftr_billing = $this->getMyCookie($ddfId."_billing_cookie");
        $ftr_receipt = $this->getMyCookie($ddfId."_receipt_cookie");
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_junior))
            $workCondtnArr['work_junior_map_tbl.fkUserId']=$ftr_junior;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_junior']=$ftr_junior;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_e_verify']=$ftr_e_verify;
        $this->data['ftr_set_by']=$ftr_set_by;
        $this->data['ftr_billing']=$ftr_billing;
        $this->data['ftr_receipt']=$ftr_receipt;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
    
        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
    
        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.due_date_for']=$ddfId;
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=$this->actIdVal;
        $workCondtnArr['act_tbl.status']="1";
        
        $workCustomWhereArray[]=" (work_tbl.eFillingDate IS NULL OR work_tbl.eFillingDate='' OR work_tbl.eFillingDate='0000-00-00' OR work_tbl.eFillingDate='1970-01-01')";
        
        if($ftr_e_verify==1)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate!='' AND work_tbl.verificationDate!='0000-00-00' AND work_tbl.verificationDate!='1970-01-01'";
        }
        elseif($ftr_e_verify==2)
        {
            $workCustomWhereArray[]=" (work_tbl.verificationDate='' OR work_tbl.verificationDate='0000-00-00' OR work_tbl.verificationDate='1970-01-01')";
        }
        
        if($ftr_set_by==1)
        {
            $workCondtnArr['work_tbl.set_prepared_by !=']='';
        }
        elseif($ftr_set_by==2)
        {
            $workCustomWhereArray[]="work_tbl.set_prepared_by=''";
        }
        
        if($ftr_billing==1)
        {
            $workCondtnArr['work_tbl.isBillingDone']='1';
        }
        elseif($ftr_billing==2)
        {
            $workCustomWhereArray[]=" (work_tbl.isBillingDone='' OR work_tbl.isBillingDone IS NULL OR work_tbl.isBillingDone='2')";
        }
        
        if($ftr_receipt==1)
        {
            $workCondtnArr['work_tbl.isReceiptDone']='1';
        }
        elseif($ftr_receipt==2)
        {
            $workCustomWhereArray[]=" (work_tbl.isReceiptDone='' OR work_tbl.isReceiptDone IS NULL OR work_tbl.isReceiptDone='2')";
        }
        
        if($ftr_e_verify==2 || $ftr_set_by==2 || $ftr_billing==2 || $ftr_receipt==2)
        {
            $workCustomWhereArray[]="work_tbl.eFillingDate!='' AND work_tbl.eFillingDate!='0000-00-00' AND work_tbl.eFillingDate!='1970-01-01'";
        }
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_document_map_tbl.fk_client_id=work_tbl.fkClientId AND client_document_map_tbl.fk_client_document_id=".$this->pmtDocId." AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl." AS prepared_user_tbl", "condtn"=>"prepared_user_tbl.userId=work_tbl.set_prepared_by AND prepared_user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
            work_tbl.workId,
            work_tbl.workCode,
            work_tbl.isDocRecvd,
            work_tbl.isUrgentWork,
            work_tbl.juniors,
            work_tbl.isBillingDone,
            work_tbl.isReceiptDone,
            work_tbl.eFillingDate,
            work_tbl.workDone,
            work_tbl.verificationDate,
            work_tbl.set_prepared_by,
            work_tbl.workPriorityColor,
            user_tbl.userShortName AS seniorName,
            prepared_user_tbl.userShortName AS setPreparedShortName,
            due_date_master_tbl.due_date_id,
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.finYear,
            ext_due_date_master_tbl.extended_date,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            due_date_for_tbl.act_option_name AS act_option_name1,
            due_date_for_tbl.due_date_type,
            periodicity_tbl.periodicity_name,
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientTitle,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            client_document_map_tbl.client_document_number
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
    
        $this->data['workDataArr']=$workDataArr;
        
        $retMthArr=array();
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            $retMthArr = array_unique(array_column($workDataArr, 'act_due_month'));
            
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['retMthArr']=$retMthArr;
        $this->data['mthDataArr']=$mthDataArr;
        $this->data['mthDDFArr']=$mthDDFArr;
        $this->data['mthDDFDueDateArr']=$mthDDFDueDateArr;
        $this->data['mthDDFDueDateForClientArr']=$mthDDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->findAll();

        $this->data['groupList']=$groupList;
        
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;
        
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userFullName']="ASC";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        return view('firm_panel/compliance/tds_tcs/payments', $this->data);
    }
    
    public function search_filter()
    {
        $ftr_type=$this->request->getPost("ftr_type");
        $ddfId=$this->request->getPost("ddfId");
        $ftr_clientgrp=$this->request->getPost("ftr_clientgrp");
        $ftr_client=$this->request->getPost("ftr_client");
        $ftr_junior=$this->request->getPost("ftr_junior");
        $ftr_staff=$this->request->getPost("ftr_staff");
        $ftr_e_verify=$this->request->getPost("ftr_e_verify");
        $ftr_set_by=$this->request->getPost("ftr_set_by");
        $ftr_billing=$this->request->getPost("ftr_billing");
        $ftr_receipt=$this->request->getPost("ftr_receipt");
        
        $cookieExpirationTime = time()+3600;
            
        if(!empty($ftr_clientgrp))
            $this->setMyCookie($ddfId."_clientgrp_cookie", $ftr_clientgrp, $cookieExpirationTime);
        else
            $this->setMyCookie($ddfId."_clientgrp_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_client))
            $this->setMyCookie($ddfId."_client_cookie", $ftr_client, $cookieExpirationTime);
        else
            $this->setMyCookie($ddfId."_client_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_junior))
            $this->setMyCookie($ddfId."_junior_cookie", $ftr_junior, $cookieExpirationTime);
        else
            $this->setMyCookie($ddfId."_junior_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_staff))
            $this->setMyCookie($ddfId."_staff_cookie", $ftr_staff, $cookieExpirationTime);
        else
            $this->setMyCookie($ddfId."_staff_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_e_verify))
            $this->setMyCookie($ddfId."_e_verify_cookie", $ftr_e_verify, $cookieExpirationTime);
        else
            $this->setMyCookie($ddfId."_e_verify_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_set_by))
            $this->setMyCookie($ddfId."_set_by_cookie", $ftr_set_by, $cookieExpirationTime);
        else
            $this->setMyCookie($ddfId."_set_by_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_billing))
            $this->setMyCookie($ddfId."_billing_cookie", $ftr_billing, $cookieExpirationTime);
        else
            $this->setMyCookie($ddfId."_billing_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_receipt))
            $this->setMyCookie($ddfId."_receipt_cookie", $ftr_receipt, $cookieExpirationTime);
        else
            $this->setMyCookie($ddfId."_receipt_cookie", "", $cookieExpirationTime);
            
        if($ftr_type==1)
            return redirect()->to(base_url($this->secPrefixUrl."-ddf-pending/".$ddfId));
        elseif($ftr_type==2)
            return redirect()->to(base_url($this->secPrefixUrl."-ddf-filed/".$ddfId));
        elseif($ftr_type==3)
            return redirect()->to(base_url($this->secPrefixUrl."-ddf-payments/".$ddfId));
    }
    
    public function reset_filter()
    {
        $cookieExpirationTime = time()+3600;
        
        $ftr_type=$this->request->getGet('ftr_type');
        $ddfId=$this->request->getGet('ddfId');
        
        $this->setMyCookie($ddfId."_clientgrp_cookie", '', $cookieExpirationTime);
        $this->setMyCookie($ddfId."_client_cookie", '', $cookieExpirationTime);
        $this->setMyCookie($ddfId."_junior_cookie", '', $cookieExpirationTime);
        $this->setMyCookie($ddfId."_staff_cookie", '', $cookieExpirationTime);
        $this->setMyCookie($ddfId."_e_verify_cookie", '', $cookieExpirationTime);
        $this->setMyCookie($ddfId."_set_by_cookie", '', $cookieExpirationTime);
        $this->setMyCookie($ddfId."_billing_cookie", '', $cookieExpirationTime);
        $this->setMyCookie($ddfId."_receipt_cookie", '', $cookieExpirationTime);
        
        if($ftr_type==1)
            return redirect()->to(base_url($this->secPrefixUrl."-ddf-pending/".$ddfId));
        elseif($ftr_type==2)
            return redirect()->to(base_url($this->secPrefixUrl."-ddf-filed/".$ddfId));
        elseif($ftr_type==3)
            return redirect()->to(base_url($this->secPrefixUrl."-ddf-payments/".$ddfId));
    }
    
    public function work_form()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $workId=$uri->getSegment(2);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Details of TDS-TCS Work";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";

        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=2 AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        
        $columnNames = "
                    work_tbl.workId,
                    work_tbl.workCode,
                    work_tbl.juniors,
                    work_tbl.isDocRecvd,
                    work_tbl.docRecvdDate,
                    work_tbl.seniorId,
                    work_tbl.workDone,
                    work_tbl.isUrgentWork,
                    work_tbl.eFillingDate,
                    work_tbl.verificationDoneBy,
                    work_tbl.acknowledgmentNo,
                    work_tbl.verificationDate,
                    work_tbl.set_prepared_by,
                    work_tbl.ackUploadFile,
                    work_tbl.refundDue,
                    work_tbl.isDefectiveReturn,
                    work_tbl.defectiveReturnComment,
                    work_tbl.isDefectiveRectified,
                    work_tbl.defectiveRectifiedComment,
                    work_tbl.turnOver,
                    work_tbl.isScrutiny,
                    work_tbl.grossTotalIncome,
                    work_tbl.totalIncome,
                    work_tbl.selfAssessmentTax,
                    work_tbl.refundDueVal,
                    work_tbl.refundAmtRecvd,
                    work_tbl.refundDate,
                    work_tbl.refundRemark,
                    work_tbl.fkClientId,
                    work_tbl.intiTotalIncome,
                    work_tbl.intiRefundApproved,
                    work_tbl.intiAddtnlTax,
                    work_tbl.intiRemark,
                    work_tbl.intiIsRectification,
                    work_tbl.intiIsScrutiny,
                    work_tbl.isRectComplete,
                    work_tbl.isApplyAppeal,
                    work_tbl.isBillingDone,
                    work_tbl.isReceiptDone,
                    work_tbl.billNo,
                    work_tbl.billDate,
                    work_tbl.billAmt,
                    work_tbl.receiptDate,
                    work_tbl.receiptAmt,
                    work_tbl.billingComment,
                    work_tbl.receiptComment,
                    work_tbl.workPriority,
                    work_tbl.workPriorityColor,
                    work_tbl.tdsTcsAmtPaid,
                    work_tbl.taxDeductedCollected,
                    client_tbl.clientName,
                    client_tbl.clientBussOrganisation,
                    client_tbl.clientBussOrganisationType,
                    client_tbl.clientPanNumber,
                    client_tbl.clientDob,
                    client_tbl.clientBussIncorporationDate,
                    client_document_map_tbl.client_document_number AS tanNo,
                    user_tbl.userFullName,
                    refund_tbl.refundId,
                    refund_tbl.totalIncome,
                    refund_tbl.refundClaimed,
                    due_date_master_tbl.finYear
                ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        $this->data['workArr']=$workArr;
        
        $clientPanNo="N/A";
        $clientTanNo="N/A";
        $asmtYear="N/A";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
                
            if(in_array($clientBussOrgType, INDIVIDUAL_ARRAY))
            {
                $workClientName=(!empty($workArr['clientName'])) ? $workArr['clientName']:"";
                $clientDobDoi=(check_valid_date($workArr['clientDob'])) ? date("d-m-Y", strtotime($workArr['clientDob'])):"";
            }
            else
            {
                $workClientName=(!empty($workArr['clientBussOrganisation'])) ? $workArr['clientBussOrganisation']:"";
                $clientDobDoi=(check_valid_date($workArr['clientBussIncorporationDate'])) ? date("d-m-Y", strtotime($workArr['clientBussIncorporationDate'])):"";
            }
            
            if(!empty($workArr['clientPanNumber']))
                $clientPanNo=$workArr['clientPanNumber'];
                
            if(!empty($workArr['tanNo']))
                $clientTanNo=$workArr['tanNo'];
                
            if(!empty($workArr['finYear']))
            {
                $asmtYearVal=$workArr['finYear'];
                
                $asmtYearArr = explode('-', $asmtYearVal);
                
                $fY=(int)$asmtYearArr[0]+1;
                $lY=(int)$asmtYearArr[1]+1;
                
                $asmtYear=$fY."-".$lY;
            }
        }
        
        $workClientName = (!empty($workClientName)) ? $workClientName : "N/A";
        $clientDobDoi = (!empty($clientDobDoi)) ? $clientDobDoi : "N/A";
        
        $this->data['workClientName']=$workClientName;
        $this->data['clientPanNo']=$clientPanNo;
        $this->data['clientTanNo']=$clientTanNo;
        $this->data['clientDobDoi']=$clientDobDoi;
        $this->data['asmtYear']=$asmtYear;

        $userCondtnArr['user_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userStaffType", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        $jnrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
        $jnrCondtnArr['work_junior_map_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_junior_map_tbl, $colNames="work_junior_map_tbl.fkWorkId, work_junior_map_tbl.fkUserId", $jnrCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $jnrList=$query['userData'];

        $this->data['jnrList']=$jnrList;
        
        $rctftnCondtnArr['rectification_tbl.fkWorkId']=$workId;
        $rctftnCondtnArr['rectification_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->rectification_tbl, $colNames="rectification_tbl.rectificationId, rectification_tbl.rectLetterNo, rectification_tbl.rectDate, rectification_tbl.rectFiledDate, rectification_tbl.rectRemark", $rctftnCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $rectftnArr=$query['userData'];

        $this->data['rectftnArr']=$rectftnArr;

        $validationRulesArr['isDocRecvd']=['label' => 'Document Received', 'rules' => 'trim'];
        $validationRulesArr['docRecvdDate']=['label' => 'Document Received Date', 'rules' => 'trim'];
        $validationRulesArr['workDone']=['label' => '% Work Done', 'rules' => 'trim'];
        $validationRulesArr['seniorId']=['label' => 'Senior Allocation', 'rules' => 'trim'];
        $validationRulesArr['isUrgentWork']=['label' => 'Urgent Work', 'rules' => 'trim'];
        $validationRulesArr['eFillingDate']=['label' => 'E-Filling Date', 'rules' => 'trim'];
        $validationRulesArr['acknowledgmentNo']=['label' => 'Acknowledgment No', 'rules' => 'trim'];
        $validationRulesArr['refundDue']=['label' => 'Refund Due', 'rules' => 'trim'];
        $validationRulesArr['isDefectiveReturn']=['label' => 'Defective Return', 'rules' => 'trim'];
        $validationRulesArr['defectiveReturnComment']=['label' => 'Comment', 'rules' => 'trim'];
        $validationRulesArr['verificationDoneBy']=['label' => 'Verification Done By', 'rules' => 'trim'];
        $validationRulesArr['verificationDate']=['label' => 'Verification Date', 'rules' => 'trim'];
        $validationRulesArr['setPreparedBy']=['label' => 'Set Prepared By', 'rules' => 'trim'];
        $validationRulesArr['isDefectiveRectified']=['label' => 'Defective Rectified', 'rules' => 'trim'];
        $validationRulesArr['defectiveRectifiedComment']=['label' => 'Comment', 'rules' => 'trim'];
        $validationRulesArr['turnOver']=['label' => 'Turn over', 'rules' => 'trim'];
        $validationRulesArr['grossTotalIncome']=['label' => 'Gross Total Income', 'rules' => 'trim'];
        $validationRulesArr['totalIncome']=['label' => 'Total Income', 'rules' => 'trim'];
        $validationRulesArr['selfAssessmentTax']=['label' => 'Self Assessment TAX', 'rules' => 'trim'];

        $isDocRecvdErr="";
        $docRecvdDateErr="";
        $workDoneErr="";
        $seniorIdErr="";
        $isUrgentWorkErr="";
        $eFillingDateErr="";
        $acknowledgmentNoErr="";
        $refundDueErr="";
        $isDefectiveReturnErr="";
        $defectiveReturnCommentErr="";
        $verificationDoneByErr="";
        $verificationDateErr="";
        $setPreparedByErr="";
        $isDefectiveRectifiedErr="";
        $defectiveRectifiedCommentErr="";
        $totalIncomeErr="";
        $selfAssessmentTaxErr="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $isDocRecvdErr=$this->validation->getError('isDocRecvd');
                $docRecvdDateErr=$this->validation->getError('docRecvdDate');
                $workDoneErr=$this->validation->getError('workDone');
                $seniorIdErr=$this->validation->getError('seniorId');
                $isUrgentWorkErr=$this->validation->getError('isUrgentWork');
                $eFillingDateErr=$this->validation->getError('eFillingDate');
                $acknowledgmentNoErr=$this->validation->getError('acknowledgmentNo');
                $refundDueErr=$this->validation->getError('refundDue');
                $isDefectiveReturnErr=$this->validation->getError('isDefectiveReturn');
                $defectiveReturnCommentErr=$this->validation->getError('defectiveReturnComment');
                $verificationDoneByErr=$this->validation->getError('verificationDoneBy');
                $verificationDateErr=$this->validation->getError('verificationDate');
                $setPreparedByErr=$this->validation->getError('setPreparedBy');
                $isDefectiveRectifiedErr=$this->validation->getError('isDefectiveRectified');
                $defectiveRectifiedCommentErr=$this->validation->getError('defectiveRectifiedComment');
                $totalIncomeErr=$this->validation->getError('totalIncome');
                $selfAssessmentTaxErr=$this->validation->getError('selfAssessmentTax');
            }
            else
            {
                $this->db->transBegin();
                
                $workId=$this->request->getPost('workId');
                $refundId=$this->request->getPost('refundId');
                $stepData=$this->request->getPost('stepData');
                $isDocRecvd=$this->request->getPost('isDocRecvd');
                $docRecvdDate=$this->request->getPost('docRecvdDate');
                $workDone=$this->request->getPost('workDone');
                $juniorIdArr=$this->request->getPost('juniorId');
                $juniors=$this->request->getPost('juniors');
                $juniorIds=$this->request->getPost('juniorIds');
                $seniorId=$this->request->getPost('seniorId');
                $isUrgentWork=$this->request->getPost('isUrgentWork');
                $eFillingDate=$this->request->getPost('eFillingDate');
                $acknowledgmentNo=$this->request->getPost('acknowledgmentNo');
                $refundDue=$this->request->getPost('refundDue');
                $isDefectiveReturn=$this->request->getPost('isDefectiveReturn');
                $defectiveReturnComment=$this->request->getPost('defectiveReturnComment');
                $verificationDoneBy=$this->request->getPost('verificationDoneBy');
                $verificationDate=$this->request->getPost('verificationDate');
                $setPreparedBy=$this->request->getPost('setPreparedBy');
                $isDefectiveRectified=$this->request->getPost('isDefectiveRectified');
                $defectiveRectifiedComment=$this->request->getPost('defectiveRectifiedComment');
                $totalIncome=$this->request->getPost('totalIncome');
                $selfAssessmentTax=$this->request->getPost('selfAssessmentTax');
                $tdsTcsAmtPaid=$this->request->getPost('tdsTcsAmtPaid');
                $taxDeductedCollected=$this->request->getPost('taxDeductedCollected');
                $rectLetterNo=$this->request->getPost('rectLetterNo');
                $rectDate=$this->request->getPost('rectDate');
                $rectFiledDate=$this->request->getPost('rectFiledDate');
                $rectRemark=$this->request->getPost('rectRemark');
                $isRectComplete=$this->request->getPost('isRectComplete');
                $isApplyAppeal=$this->request->getPost('isApplyAppeal');
                $isBillingDone=$this->request->getPost('isBillingDone'); 
                $billNo=$this->request->getPost('billNo'); 
                $billDate=$this->request->getPost('billDate');
                $billAmt=$this->request->getPost('billAmt');
                $billingComment=$this->request->getPost('billingComment');
                $isReceiptDone=$this->request->getPost('isReceiptDone');
                $receiptDate=$this->request->getPost('receiptDate');
                $receiptAmt=$this->request->getPost('receiptAmt');
                $receiptComment=$this->request->getPost('receiptComment');
                $workPriorityColor=$this->request->getPost('workPriorityColor');
                $workPriority=$this->request->getPost('workPriority');
                $isScrutiny=$this->request->getPost('isScrutiny');
                $ackUploadFile=$this->request->getFile('ackUploadFile');
                $ackUploadFileHidden=$this->request->getPost('ackUploadFileHidden');
        
                $ack_upload_file="";
                if(!empty($ackUploadFile->getTempName()))
                {
                    if($ackUploadFile->isValid() && ! $ackUploadFile->hasMoved())
                    {
                        $ext=$ackUploadFile->guessExtension();
                        
                        if($ext=="pdf")
                        {
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);

                            $uploadPath1=$uploadPath.'/compliance';

                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
                                
                            $uploadPath2=$uploadPath1.'/tds_tcs';

                            if(!is_dir($uploadPath2))
                                mkdir($uploadPath2, 0777, TRUE);
            
                            $ack_upload_file = $ackUploadFile->getRandomName();
                            $ackUploadFile->move($uploadPath2, $ack_upload_file);
                        }
                        else
                        {
                            $this->session->setFlashdata('errorMsg', "Only pdf document is accepted");
                            return redirect()->back();
                        }
                    }
                    else
                    {
                        $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                        return redirect()->back();
                    }
                }
                else
                {
                    $ack_upload_file = $ackUploadFileHidden;
                }
                
                if(empty($isScrutiny))
                {
                    $isScrutiny=0;
                }
                
                if($isDocRecvd==1)
                    $docRecvdDateVal=$docRecvdDate;
                else
                    $docRecvdDateVal="";
                    
                if($isDefectiveRectified==1)
                    $defectiveRectifiedCommentVal=$defectiveRectifiedComment;
                else
                    $defectiveRectifiedCommentVal="";
                    
                if($isBillingDone!=1)
                {
                    $billNo=""; 
                    $billDate=""; 
                    $billAmt="";
                    $billingComment=""; 
                }
                
                if($isReceiptDone!=1)
                {
                    $receiptDate=""; 
                    $receiptAmt=""; 
                    $receiptComment="";
                }
                
                if(!empty($eFillingDate))
                {
                    $workDone=100;
                }

                $wkUpdateArr = [
                    'isDocRecvd'=>$isDocRecvd,
                    'docRecvdDate'=>$docRecvdDateVal,
                    'workDone'=>$workDone,
                    'juniors'=>$juniors,
                    'seniorId'=>$seniorId,
                    'isUrgentWork'=>$isUrgentWork,
                    'eFillingDate'=>$eFillingDate,
                    'acknowledgmentNo'=>$acknowledgmentNo,
                    'refundDue'=>$refundDue,
                    'isDefectiveReturn'=>$isDefectiveReturn,
                    'defectiveReturnComment'=>$defectiveReturnComment,
                    'verificationDoneBy'=>$verificationDoneBy,
                    'verificationDate'=>$verificationDate,
                    'set_prepared_by'=>$setPreparedBy,
                    'ackUploadFile'=>$ack_upload_file,
                    'isDefectiveRectified'=>$isDefectiveRectified,
                    'defectiveRectifiedComment'=>$defectiveRectifiedCommentVal,
                    'totalIncome'=>$totalIncome,
                    'selfAssessmentTax'=>$selfAssessmentTax,
                    'tdsTcsAmtPaid'=>$tdsTcsAmtPaid,
                    'taxDeductedCollected'=>$taxDeductedCollected,
                    'isRectComplete'=>$isRectComplete,
                    'isApplyAppeal'=>$isApplyAppeal,
                    'isBillingDone'=>$isBillingDone,
                    'billNo'=>$billNo,
                    'billDate'=>$billDate,
                    'billAmt'=>$billAmt,
                    'billingComment'=>$billingComment,
                    'isReceiptDone'=>$isReceiptDone,
                    'receiptDate'=>$receiptDate,
                    'receiptAmt'=>$receiptAmt,
                    'receiptComment'=>$receiptComment,
                    'workPriorityColor'=>$workPriorityColor,
                    'workPriority'=>$workPriority,
                    'isScrutiny'=>$isScrutiny,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
    
                $wkCondtnArr['work_tbl.workId']=$workId;
    
                $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                $junrUpdateArr = [
                    'status'=>2,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
    
                $junrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
    
                $query=$this->Mcommon->updateData($tableName=$this->work_junior_map_tbl, $junrUpdateArr, $junrCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                $junrInsertArr=array();

                if(!empty($juniorIds))
                {
                    $juniorIdsData=explode(", ", $juniorIds);
                    foreach($juniorIdsData AS $e_jnr)
                    {
                        $junrInsertArr[] = [
                            'fkWorkId'=>$workId,
                            'fkUserId'=>$e_jnr,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        ];
                    }

                    $this->Mcommon->insert($tableName=$this->work_junior_map_tbl, $junrInsertArr, $returnType="");
                }
                
                if(empty($refundId)){
                    $insertIntiArr[]=array(
                        'refundId'          =>  $refundId, 
                        'fkWorkId'          =>  $workId,
                        'refundClaimed'     =>  $refundDue,
                        'totalIncome'       =>  $totalIncome,
                        'status'            =>  1,
                        'createdBy'         =>  $this->adminId,
                        'createdDatetime'   =>  $this->currTimeStamp,
                    );
                    
                    $this->Mcommon->insert($tableName=$this->refund_tbl, $insertIntiArr, $returnType="");
                }else{

                    $updateIntiArr=array(
                        'refundClaimed'     =>  $refundDue,
                        'totalIncome'       =>  $totalIncome,
                        'updatedBy'         =>  $this->adminId,
                        'updatedDatetime'   =>  $this->currTimeStamp
                    );
        
                    $refundCondtnArr['refund_tbl.refundId']=$refundId;
                    $refundCondtnArr['refund_tbl.fkWorkId']=$workId;
        
                    $query=$this->Mcommon->updateData($tableName=$this->refund_tbl, $updateIntiArr, $refundCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }
                
                if($this->db->transStatus() === FALSE)
                {
                    $this->db->transRollback();

                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Work Information not updated :(");
                }
                else
                {
                    $this->db->transCommit();

                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']="Work Information updated";
                    $insertLogArr['ip']=$this->IPAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mquery->insertLog($insertLogArr);

                    $this->session->setFlashdata('successMsg', "Work Information updated successfully :)");
                }
                
                return redirect()->back();
            }
        }

        $this->data['isDocRecvdErr']=$isDocRecvdErr;
        $this->data['docRecvdDateErr']=$docRecvdDateErr;
        $this->data['workDoneErr']=$workDoneErr;
        $this->data['seniorIdErr']=$seniorIdErr;
        $this->data['isUrgentWorkErr']=$isUrgentWorkErr;
        $this->data['eFillingDateErr']=$eFillingDateErr;
        $this->data['acknowledgmentNoErr']=$acknowledgmentNoErr;
        $this->data['refundDueErr']=$refundDueErr;
        $this->data['isDefectiveReturnErr']=$isDefectiveReturnErr;
        $this->data['defectiveReturnCommentErr']=$defectiveReturnCommentErr;
        $this->data['verificationDoneByErr']=$verificationDoneByErr;
        $this->data['verificationDateErr']=$verificationDateErr;
        $this->data['setPreparedByErr']=$setPreparedByErr;
        $this->data['isDefectiveRectifiedErr']=$isDefectiveRectifiedErr;
        $this->data['defectiveRectifiedCommentErr']=$defectiveRectifiedCommentErr;
        $this->data['totalIncomeErr']=$totalIncomeErr;
        $this->data['selfAssessmentTaxErr']=$selfAssessmentTaxErr;

        return view('firm_panel/compliance/tds_tcs/work_form', $this->data);
    }
    
    public function register_section()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - Registers";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/tds_tcs/register_section', $this->data);
    }
    
    public function registers()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - Returns Register";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $asmtYear="N/A";
        if(!empty($fin_year_arr))
        {
            $asmtYearVal=$this->sessDueDateYear;
            
            $asmtYearArr=explode('-', $asmtYearVal);
            
            $fY=(int)$asmtYearArr[0]+1;
            $lY=(int)$asmtYearArr[1]+1;
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workWhereInArray['act_tbl.act_id']=array(3, 16);
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        
        $workOrderByArr['work_tbl.eFillingDate']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=2 AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        
        $columnNames="
            work_tbl.workId,
            work_tbl.eFillingDate,
            work_tbl.acknowledgmentNo,
            work_tbl.selfAssessmentTax,
            client_tbl.clientBussOrganisationType AS orgType,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientDob,
            client_tbl.clientBussIncorporationDate,
            client_tbl.clientPanNumber,
            client_document_map_tbl.client_document_number AS tanNo,
            due_date_master_tbl.finYear,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_for_tbl.act_option_map_id,
            work_tbl.tdsTcsAmtPaid,
            work_tbl.taxDeductedCollected,
            refund_tbl.refundClaimed
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $ddfRetRegIdArr = array();
        $ddfReturnsRegArr = array();
        
        if(!empty($workDataArr))
        {
            $ddfRetRegIdArr = array_unique(array_column($workDataArr, 'act_option_map_id'));
            
            foreach($workDataArr AS $e_work)
            {
                $ddfReturnsRegArr[$e_work['act_option_map_id']][]=$e_work;
            }
        }
        
        $this->data['ddfReturnsRegArr']=$ddfReturnsRegArr;
        
        $dueDateForList=array();
        
        if(!empty($ddfRetRegIdArr))
        {
            $ddfCondtnArr['act_option_map_tbl.status']="1";
            $ddfCondtnArr['act_option_map_tbl.option_type']="1";
            $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
            
            $ddfWhereInArray['act_option_map_tbl.fk_act_id']=array(3, 16);
            $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=$ddfRetRegIdArr;
            
            $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
            
            $dueDateForList=$query['userData'];
        }

        $this->data['dueDateForList']=$dueDateForList;

        return view('firm_panel/compliance/tds_tcs/registers', $this->data);
    }
    
    public function filing_date_wise_registers()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - Returns Register";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $asmtYear="N/A";
        if(!empty($fin_year_arr))
        {
            $asmtYearVal=$this->sessDueDateYear;
            
            $asmtYearArr=explode('-', $asmtYearVal);
            
            $fY=(int)$asmtYearArr[0]+1;
            $lY=(int)$asmtYearArr[1]+1;
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workWhereInArray['act_tbl.act_id']=array(3, 16);
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        
        $workOrderByArr['work_tbl.eFillingDate']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=2 AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        
        $columnNames="
            work_tbl.workId,
            work_tbl.eFillingDate,
            work_tbl.acknowledgmentNo,
            work_tbl.selfAssessmentTax,
            client_tbl.clientBussOrganisationType AS orgType,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientDob,
            client_tbl.clientBussIncorporationDate,
            client_tbl.clientPanNumber,
            client_document_map_tbl.client_document_number AS tanNo,
            due_date_master_tbl.finYear,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_for_tbl.act_option_map_id,
            work_tbl.tdsTcsAmtPaid,
            work_tbl.taxDeductedCollected,
            refund_tbl.refundClaimed
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        return view('firm_panel/compliance/tds_tcs/filing_date_wise_registers', $this->data);
    }
    
    public function assessee_ledger()
	{
	    ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="TDS-TCS - Assessee Ledger";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_act_map_tbl.status']=1;
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientWhereInArray["client_act_map_tbl.fkActId"] = array(3, 16);
        
        $clientGroupByArr=array("client_tbl.clientId");
        
        $clientJoinArr[]=array("tbl"=>$this->client_act_map_tbl, "condtn"=>"client_act_map_tbl.fkClientId=client_tbl.clientId", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_group_tbl.client_group_cost", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, user_tbl.userShortName", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $clientGroupByArr, $clientWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;

        return view('firm_panel/compliance/tds_tcs/assessee_ledger', $this->data);
	}
	
	public function assessee_ledger_client()
	{
	    ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $this->data['clientId']=$clientId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="TDS-TCS - Assessee Ledger";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']="1";
        
        $clientJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=2 AND client_document_map_tbl.status=1", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType, client_tbl.clientPanNumber, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_document_map_tbl.client_document_number AS tanNo", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $this->data['clientData']=$clientData;
        
        $workCondtnArr['client_tbl.clientId']=$clientId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workWhereInArray['act_tbl.act_id']=array(3, 16);
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        
        $workOrderByArr['due_date_master_tbl.finYear']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['due_date_master_tbl.due_date_id']="ASC";
        
        $workGroupByArr=array('work_tbl.workId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.eFillingDate,
            work_tbl.acknowledgmentNo,
            work_tbl.selfAssessmentTax,
            due_date_master_tbl.finYear,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            ext_due_date_master_tbl.extended_date,
            work_tbl.tdsTcsAmtPaid,
            work_tbl.taxDeductedCollected,
            refund_tbl.refundClaimed
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        return view('firm_panel/compliance/tds_tcs/assessee_ledger_client', $this->data);
	}
	
	public function mis_report_menu()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - MIS";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/tds_tcs/mis_report_menu', $this->data);
    }
    
    public function position_of_returns()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        ini_set('memory_limit', '-1');

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - MIS Report - Position of Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $asmtYear="N/A";
        if($this->currentMth>3)
        {
            $fY=$this->currentYear;
            $lY=substr($this->currentYear+1, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        else
        {
            $fY=$this->currentYear-1;
            $lY=substr($this->currentYear, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        $workWhereInArray['act_tbl.act_id']=array(3, 16);

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        // $workCondtnArr['act_tbl.act_id']=1;
        $workCondtnArr['work_tbl.workId !=']='';
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['group_category_tbl.group_category_id']="ASC";
        $workOrderByArr['client_group_tbl.client_group_id']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>"group_category_tbl.group_category_id=client_group_tbl.client_group_category", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.eFillingDate, group_category_tbl.group_category_id, client_group_tbl.client_group_id, client_group_tbl.client_group_number, client_group_tbl.client_group, due_date_for_tbl.act_option_map_id, due_date_for_tbl.act_option_name, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $dueDateForArr=array();
        $incRetDDFArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $dueDateForArr[$e_tx['act_option_map_id']]=$e_tx['act_option_name'];
                $cliDueDateForArr[$e_tx['act_option_map_id']][$e_tx['client_group_id']]=$e_tx;
                $incRetDDFArr[$e_tx['act_due_month']][$e_tx['act_option_map_id']][$e_tx['client_group_id']][$e_tx['workId']]=$e_tx;
            }
        }
        
        $this->data['dueDateForArr']=$dueDateForArr;
        $this->data['cliDueDateForArr']=$cliDueDateForArr;
        $this->data['incRetDDFArr']=$incRetDDFArr;
        
        $misAssignArr=array();
        $misFiledArr=array();
        
        if(!empty($workDataArr))
        {
            $cliDDFArr=array_unique(array_column($workDataArr, 'act_option_map_id'));
            $cliGrpWorkAssignArr=array_unique(array_column($workDataArr, 'client_group_id'));
            
            if(!empty($cliDDFArr))
            {
                foreach($cliDDFArr AS $e_wrk_asgn)
                {
                    for($m_no=1;$m_no<13;$m_no++)
                    {
                        if(isset($incRetDDFArr[$m_no][$e_wrk_asgn]))
                        {
                            if(!empty($cliGrpWorkAssignArr))
                            {
                                foreach($cliGrpWorkAssignArr AS $e_wrk_asgn_grp)
                                {
                                    if(isset($incRetDDFArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp]))
                                    {
                                        $incRetDDFArray=$incRetDDFArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp];
                                        
                                        if(!empty($incRetDDFArray))
                                        {
                                            $misAssignArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp]=count($incRetDDFArray);
                                            
                                            foreach($incRetDDFArray AS $e_wrk_file)
                                            {
                                                $eFillingDate=$e_wrk_file['eFillingDate'];
                                                
                                                if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                                {
                                                    $misFiledArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp][]=$eFillingDate;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $this->data['misAssignArr']=$misAssignArr;
        $this->data['misFiledArr']=$misFiledArr;
        
        $allotedCondtnArr['client_group_tbl.status']=1;
        $allotedCondtnArr['client_tbl.status']=1;
        $allotedCondtnArr['work_tbl.status']=1;
        $allotedCondtnArr['work_junior_map_tbl.status']=1;
        
        $allotedJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientGroup=client_group_tbl.client_group_id AND client_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fkClientId=client_tbl.clientId AND work_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->user_tbl." AS jnr_user_tbl", "condtn"=>"jnr_user_tbl.userId=work_junior_map_tbl.fkUserId AND jnr_user_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_group_tbl, $colNames='client_group_tbl.client_group_id, client_tbl.clientId, work_tbl.seniorId, work_junior_map_tbl.fkUserId, user_tbl.userShortName AS seniorName, jnr_user_tbl.userShortName AS juniorName', $allotedCondtnArr, $likeCondtnArr=array(), $allotedJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $allotedList=$query['userData'];
        
        $clientJnrArray=array();
        $clientSnrArray=array();
        
        if(!empty($allotedList))
        {
            foreach($allotedList AS $e_allot)
            {
                if(!empty($e_allot['juniorName']))
                    $clientJnrArray[$e_allot['client_group_id']][$e_allot['fkUserId']]=$e_allot['juniorName'];
                    
                if(!empty($e_allot['seniorName']))
                    $clientSnrArray[$e_allot['client_group_id']][$e_allot['seniorId']]=$e_allot['seniorName'];
            }
        }
        
        $this->data['clientJnrArray']=$clientJnrArray;
        $this->data['clientSnrArray']=$clientSnrArray;
        
        return view('firm_panel/compliance/tds_tcs/position_of_returns', $this->data);
    }
    
    public function position_of_returns_client()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        ini_set('memory_limit', '-1');
        
        $clientGroupId=$uri->getSegment(2);
        $ddfId=$uri->getSegment(3);
        $mth_nm_tab=$uri->getSegment(4);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - MIS Report - Position of Returns(Client-Wise)";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        $this->data['mth_nm_tab']=$mth_nm_tab;
        
        $workWhereInArray=array();
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $asmtYear="N/A";
        if($this->currentMth>3)
        {
            $fY=$this->currentYear;
            $lY=substr($this->currentYear+1, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        else
        {
            $fY=$this->currentYear-1;
            $lY=substr($this->currentYear, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        $workWhereInArray['act_tbl.act_id']=array(3, 16);

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['client_group_tbl.client_group_id']=$clientGroupId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['group_category_tbl.group_category_id']="ASC";
        $workOrderByArr['client_group_tbl.client_group_id']="ASC";
        
        // $workGroupByArr=array('client_group_tbl.client_group_category', 'client_tbl.clientGroup');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.act_option_map_id=".$ddfId, "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>"group_category_tbl.group_category_id=client_group_tbl.client_group_category", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.eFillingDate, group_category_tbl.group_category_id, client_group_tbl.client_group_id, client_tbl.clientId, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $incRetDDFArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $incRetDDFArr[$e_tx['act_due_month']][$e_tx['clientId']][$e_tx['workId']]=$e_tx;
            }
        }
        
        $this->data['incRetDDFArr']=$incRetDDFArr;
        
        $misAssignArr=array();
        $misFiledArr=array();
        
        if(!empty($workDataArr))
        {
            $cliWorkAssignArr=array_unique(array_column($workDataArr, 'clientId'));
            
            if(!empty($cliWorkAssignArr))
            {
                foreach($cliWorkAssignArr AS $e_wrk_asgn)
                {
                    for($m_no=1;$m_no<13;$m_no++)
                    {
                        if(isset($incRetDDFArr[$m_no][$e_wrk_asgn]))
                        {
                            $incRetDDFArray=$incRetDDFArr[$m_no][$e_wrk_asgn];
                            
                            if(!empty($incRetDDFArray))
                            {
                                $misAssignArr[$m_no][$e_wrk_asgn]=count($incRetDDFArray);
                                
                                foreach($incRetDDFArray AS $e_wrk_file)
                                {
                                    $eFillingDate=$e_wrk_file['eFillingDate'];
                                    
                                    if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                    {
                                        $misFiledArr[$m_no][$e_wrk_asgn][]=$eFillingDate;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $this->data['misAssignArr']=$misAssignArr;
        $this->data['misFiledArr']=$misFiledArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.clientGroup']=$clientGroupId;

        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr=array(), $singleRow=FALSE, $clientOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $ctr=0;
        $clientReturnsArr=array();
        
        if(!empty($getClientList))
        {
            foreach($getClientList AS $k_client=>$e_client)
            {
                for($m_no=1;$m_no<13;$m_no++)
                {
                    if($e_client['orgType']==8)
                    {
                        if(!empty($e_client['clientBussOrganisation']))
                            $clientName=$e_client['clientName']." (".$e_client['clientBussOrganisation'].")";
                        else
                            $clientName=$e_client['clientName'];
                    }
                    elseif($e_client['orgType']==9)
                        $clientName=$e_client['clientName'];
                    else
                        $clientName=$e_client['clientBussOrganisation'];
                        
                    $clientId=$e_client['clientId'];
                    
                    $assignCount=0;
                    if(isset($misAssignArr[$m_no][$clientId]))
                        $assignCount=$misAssignArr[$m_no][$clientId];
                    else
                        $assignCount=0;
                    
                    $filedCount=0;
                    if(isset($misFiledArr[$m_no][$clientId]))
                    {
                        $misFiledArray=$misFiledArr[$m_no][$clientId];
                        
                        if(!empty($misFiledArray))
                            $filedCount=count($misFiledArray);
                        else
                            $filedCount=0;
                    }
                    
                    $pendingCount=$assignCount-$filedCount;
                    
                    if($assignCount==0 && $assignCount==0 && $pendingCount==0)
                    {
                        continue;
                    }
                    else
                    {
                        $ctr++;
                        $clientReturnsArr[$m_no][$k_client]['sr']=$ctr;
                        $clientReturnsArr[$m_no][$k_client]['clientId']=$clientId;
                        $clientReturnsArr[$m_no][$k_client]['clientName']=$clientName;
                        $clientReturnsArr[$m_no][$k_client]['assignCount']=$assignCount;
                        $clientReturnsArr[$m_no][$k_client]['filedCount']=$filedCount;
                        $clientReturnsArr[$m_no][$k_client]['pendingCount']=$pendingCount;
                    }
                }
            }
        }
        
        // $clientReturnsArray=array();
        
        // if(!empty($clientReturnsArr))
        // {
        //     $clientReturnsArray = array_column($clientReturnsArr, 'clientName');

        //     array_multisort($clientReturnsArray, SORT_ASC, $clientReturnsArr);
        // }
        
        // print_r($clientReturnsArray);
        // die();
        
        $this->data['clientReturnsArr']=$clientReturnsArr;
        
        $allotedCondtnArr['client_group_tbl.client_group_id']=$clientGroupId;
        $allotedCondtnArr['client_group_tbl.status']=1;
        $allotedCondtnArr['client_tbl.status']=1;
        $allotedCondtnArr['work_tbl.status']=1;
        $allotedCondtnArr['work_junior_map_tbl.status']=1;
        
        $allotedJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientGroup=client_group_tbl.client_group_id AND client_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fkClientId=client_tbl.clientId AND work_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->user_tbl." AS jnr_user_tbl", "condtn"=>"jnr_user_tbl.userId=work_junior_map_tbl.fkUserId AND jnr_user_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_group_tbl, $colNames='client_group_tbl.client_group_id, client_tbl.clientId, work_tbl.seniorId, work_junior_map_tbl.fkUserId, user_tbl.userShortName AS seniorName, jnr_user_tbl.userShortName AS juniorName', $allotedCondtnArr, $likeCondtnArr=array(), $allotedJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $allotedList=$query['userData'];
        
        $clientJnrArray=array();
        $clientSnrArray=array();
        
        if(!empty($allotedList))
        {
            foreach($allotedList AS $e_allot)
            {
                if(!empty($e_allot['juniorName']))
                    $clientJnrArray[$e_allot['clientId']][$e_allot['fkUserId']]=$e_allot['juniorName'];
                    
                if(!empty($e_allot['seniorName']))
                    $clientSnrArray[$e_allot['clientId']][$e_allot['seniorId']]=$e_allot['seniorName'];
            }
        }
        
        $this->data['clientJnrArray']=$clientJnrArray;
        $this->data['clientSnrArray']=$clientSnrArray;
        
        $ddfCond["act_option_map_id"]=$ddfId;
        $ddfCond["status"]=1;
        
        $dueDateForData=$this->Mact_option->where($ddfCond)->first();

        $this->data['dueDateForData']=$dueDateForData;
        
        return view('firm_panel/compliance/tds_tcs/position_of_returns_client', $this->data);
    }
    
    public function staff_wise_position()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        ini_set('memory_limit', '-1');

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - MIS Report - Staff-wise Position";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $asmtYear="N/A";
        if($this->currentMth>3)
        {
            $fY=$this->currentYear;
            $lY=substr($this->currentYear+1, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        else
        {
            $fY=$this->currentYear-1;
            $lY=substr($this->currentYear, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        $workWhereInArray['act_tbl.act_id']=array(3, 16); // TDS-TCS

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['work_tbl.workId !=']='';
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['group_category_tbl.group_category_id']="ASC";
        $workOrderByArr['client_group_tbl.client_group_id']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>"group_category_tbl.group_category_id=client_group_tbl.client_group_category", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.eFillingDate, group_category_tbl.group_category_id, client_group_tbl.client_group_id, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, work_tbl.seniorId, work_junior_map_tbl.fkUserId AS juniorId, user_tbl.userFullName, user_tbl.userShortName", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $incRetSeniorArr=array();
        $incRetJuniorArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                // $incRetSeniorArr[$e_tx['act_due_month']][$e_tx['seniorId']][$e_tx['workId']]=$e_tx;
                $incRetJuniorArr[$e_tx['act_due_month']][$e_tx['juniorId']][$e_tx['workId']]=$e_tx;
            }
        }
        
        $this->data['incRetSeniorArr']=$incRetSeniorArr;
        $this->data['incRetJuniorArr']=$incRetJuniorArr;
        
        $misSeniorAssignArr=array();
        $misSeniorFiledArr=array();
        
        $misJuniorAssignArr=array();
        $misJuniorFiledArr=array();
        
        $misAssignArray=array();
        $misFiledArray=array();
        
        if(!empty($workDataArr))
        {
            // $seniorWorkAssignArr=array_unique(array_column($workDataArr, 'seniorId'));
            $juniorWorkAssignArr=array_unique(array_column($workDataArr, 'juniorId'));
            
            $userWorkAssignArr=array();
            
            if(!empty($seniorWorkAssignArr) && !empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = array_unique(array_merge($seniorWorkAssignArr, $juniorWorkAssignArr));
            }
            elseif(!empty($seniorWorkAssignArr) && empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = $seniorWorkAssignArr;
            }
            elseif(empty($seniorWorkAssignArr) && !empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = $juniorWorkAssignArr;
            }
            
            for($m_no=1;$m_no<13;$m_no++)
            {
                if(!empty($seniorWorkAssignArr))
                {
                    foreach($seniorWorkAssignArr AS $e_snr)
                    {
                        if(isset($incRetSeniorArr[$m_no][$e_snr]))
                        {
                            $incRetSeniorArray=$incRetSeniorArr[$m_no][$e_snr];
                            
                            if(!empty($incRetSeniorArray))
                            {
                                $misSeniorAssignArr[$m_no][$e_snr]=count($incRetSeniorArray);
                                
                                foreach($incRetSeniorArray AS $e_wrk_file)
                                {
                                    $eFillingDate=$e_wrk_file['eFillingDate'];
                                    
                                    if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                    {
                                        $misSeniorFiledArr[$m_no][$e_snr][]=$eFillingDate;
                                    }
                                }
                            }
                        }
                    }
                }
                
                if(!empty($juniorWorkAssignArr))
                {
                    foreach($juniorWorkAssignArr AS $e_jnr)
                    {
                        if(isset($incRetJuniorArr[$m_no][$e_jnr]))
                        {
                            $incRetJuniorArray=$incRetJuniorArr[$m_no][$e_jnr];
                            
                            if(!empty($incRetJuniorArray))
                            {
                                $misJuniorAssignArr[$m_no][$e_jnr]=count($incRetJuniorArray);
                                
                                foreach($incRetJuniorArray AS $e_wrk_file)
                                {
                                    $eFillingDate=$e_wrk_file['eFillingDate'];
                                    
                                    if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                    {
                                        $misJuniorFiledArr[$m_no][$e_jnr][]=$eFillingDate;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        for($m_no=1;$m_no<13;$m_no++)
        {
            if(!empty($userWorkAssignArr))
            {
                foreach($userWorkAssignArr AS $e_usr)
                {
                    $misSeniorAssignArray=array();
                    $misJuniorAssignArray=array();
                    
                    if(isset($misSeniorAssignArr[$m_no][$e_usr]))
                    {
                        $misSeniorAssignArray=$misSeniorAssignArr[$m_no][$e_usr];
                    }
                    
                    if(isset($misJuniorAssignArr[$m_no][$e_usr]))
                    {
                        $misJuniorAssignArray=$misJuniorAssignArr[$m_no][$e_usr];
                    }
                    
                    if(!empty($misSeniorAssignArray) && !empty($misJuniorAssignArray))
                    {
                        $misAssignArray[$m_no][$e_usr] = $misSeniorAssignArray + $misJuniorAssignArray;
                    }
                    elseif(!empty($misSeniorAssignArray) && empty($misJuniorAssignArray))
                    {
                        $misAssignArray[$m_no][$e_usr] = $misSeniorAssignArray;
                    }
                    elseif(empty($misSeniorAssignArray) && !empty($misJuniorAssignArray))
                    {
                        $misAssignArray[$m_no][$e_usr] = $misJuniorAssignArray;
                    }
                    
                    $misSeniorFiledArray=array();
                    $misJuniorFiledArray=array();
                    
                    if(isset($misSeniorFiledArr[$m_no][$e_usr]))
                    {
                        $misSeniorFiledArray=count($misSeniorFiledArr[$m_no][$e_usr]);
                    }
                    
                    if(isset($misJuniorFiledArr[$m_no][$e_usr]))
                    {
                        $misJuniorFiledArray=count($misJuniorFiledArr[$m_no][$e_usr]);
                    }
                    
                    if(!empty($misSeniorFiledArray) && !empty($misJuniorFiledArray))
                    {
                        $misFiledArray[$m_no][$e_usr] = $misSeniorFiledArray + $misJuniorFiledArray;
                    }
                    elseif(!empty($misSeniorFiledArray) && empty($misJuniorFiledArray))
                    {
                        $misFiledArray[$m_no][$e_usr] = $misSeniorFiledArray;
                    }
                    elseif(empty($misSeniorFiledArray) && !empty($misJuniorFiledArray))
                    {
                        $misFiledArray[$m_no][$e_usr] = $misJuniorFiledArray;
                    }
                }
            }
        }
        
        $this->data['userWorkAssignArr']=$userWorkAssignArr;
        $this->data['misAssignArray']=$misAssignArray;
        $this->data['misFiledArray']=$misFiledArray;
        
        $userCondtnArr['user_tbl.status']=1;
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames='user_tbl.userId, user_tbl.userFullName, user_tbl.userShortName', $userCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userList=$query['userData'];
        
        $this->data['userList']=$userList;

        return view('firm_panel/compliance/tds_tcs/staff_wise_position', $this->data);
    }
    
    public function staff_wise_position_client_wise()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $retUserId=$uri->getSegment(2);
        $mth_nm_tab=$uri->getSegment(3);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - MIS Report - Staff-wise Position(Client-wise)";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        $this->data['mth_nm_tab']=$mth_nm_tab;
        
        $workWhereInArray=array();
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $asmtYear="N/A";
        if($this->currentMth>3)
        {
            $fY=$this->currentYear;
            $lY=substr($this->currentYear+1, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        else
        {
            $fY=$this->currentYear-1;
            $lY=substr($this->currentYear, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        $workWhereInArray['act_tbl.act_id']=array(3, 16); // TDS-TCS

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        // $workCondtnArr['act_tbl.act_id']=1;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['group_category_tbl.group_category_id']="ASC";
        $workOrderByArr['client_group_tbl.client_group_id']="ASC";
        
        $workCustomWhereArray[]="(work_tbl.seniorId='".$retUserId."' || work_junior_map_tbl.fkUserId='".$retUserId."')";
        
        // $workGroupByArr=array('client_group_tbl.client_group_category', 'client_tbl.clientGroup');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>"group_category_tbl.group_category_id=client_group_tbl.client_group_category", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1 AND work_junior_map_tbl.fkUserId='".$retUserId."'", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.eFillingDate, group_category_tbl.group_category_id, client_group_tbl.client_group_id, client_tbl.clientId, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, work_tbl.seniorId, work_junior_map_tbl.fkUserId AS juniorId, user_tbl.userFullName, user_tbl.userShortName", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr=array(), $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $incRetClientArr=array();
        $incRetSeniorArr=array();
        $incRetJuniorArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $incRetClientArr[$e_tx['clientId']]=$e_tx['clientId'];
                // $incRetSeniorArr[$e_tx['act_due_month']][$e_tx['seniorId']][$e_tx['clientId']][$e_tx['workId']]=$e_tx;
                
                if(!empty($e_tx['juniorId']))
                    $incRetJuniorArr[$e_tx['act_due_month']][$e_tx['juniorId']][$e_tx['clientId']][$e_tx['workId']]=$e_tx;
            }
        }
        
        $this->data['incRetSeniorArr']=$incRetSeniorArr;
        $this->data['incRetJuniorArr']=$incRetJuniorArr;
        
        $misSeniorAssignArr=array();
        $misSeniorFiledArr=array();
        
        $misJuniorAssignArr=array();
        $misJuniorFiledArr=array();
        
        $misAssignArray=array();
        $misFiledArray=array();
        
        if(!empty($workDataArr))
        {
            // $seniorWorkAssignArr=array_unique(array_column($workDataArr, 'seniorId'));
            $juniorWorkAssignArr=array_unique(array_column($workDataArr, 'juniorId'));
            
            $userWorkAssignArr=array();
            
            if(!empty($seniorWorkAssignArr) && !empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = array_unique(array_merge($seniorWorkAssignArr, $juniorWorkAssignArr));
            }
            elseif(!empty($seniorWorkAssignArr) && empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = $seniorWorkAssignArr;
            }
            elseif(empty($seniorWorkAssignArr) && !empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = $juniorWorkAssignArr;
            }
            
            for($m_no=1;$m_no<13;$m_no++)
            {
                if(!empty($seniorWorkAssignArr))
                {
                    foreach($seniorWorkAssignArr AS $e_snr)
                    {
                        if(!empty($incRetClientArr))
                        {
                            foreach($incRetClientArr AS $e_cli)
                            {
                                if(isset($incRetSeniorArr[$m_no][$e_snr][$e_cli]))
                                {
                                    $incRetSeniorArray=$incRetSeniorArr[$m_no][$e_snr][$e_cli];
                                    
                                    if(!empty($incRetSeniorArray))
                                    {
                                        $misSeniorAssignArr[$m_no][$e_snr][$e_cli]=count($incRetSeniorArray);
                                        
                                        foreach($incRetSeniorArray AS $e_wrk_file)
                                        {
                                            $eFillingDate=$e_wrk_file['eFillingDate'];
                                            
                                            if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                            {
                                                $misSeniorFiledArr[$m_no][$e_snr][$e_cli][]=$eFillingDate;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                
                if(!empty($juniorWorkAssignArr))
                {
                    foreach($juniorWorkAssignArr AS $e_jnr)
                    {
                        if(!empty($incRetClientArr))
                        {
                            foreach($incRetClientArr AS $e_cli)
                            {
                                if(isset($incRetJuniorArr[$m_no][$e_jnr][$e_cli]))
                                {
                                    $incRetJuniorArray=$incRetJuniorArr[$m_no][$e_jnr][$e_cli];
                                    
                                    if(!empty($incRetJuniorArray))
                                    {
                                        $misJuniorAssignArr[$m_no][$e_jnr][$e_cli]=count($incRetJuniorArray);
                                        
                                        foreach($incRetJuniorArray AS $e_wrk_file)
                                        {
                                            $eFillingDate=$e_wrk_file['eFillingDate'];
                                            
                                            if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                            {
                                                $misJuniorFiledArr[$m_no][$e_jnr][$e_cli][]=$eFillingDate;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        for($m_no=1;$m_no<13;$m_no++)
        {
            if(!empty($userWorkAssignArr))
            {
                foreach($userWorkAssignArr AS $e_usr)
                {
                    if(!empty($incRetClientArr))
                    {
                        foreach($incRetClientArr AS $e_cli)
                        {
                            $misSeniorAssignArray=array();
                            $misJuniorAssignArray=array();
                            
                            if(isset($misSeniorAssignArr[$m_no][$e_usr][$e_cli]))
                            {
                                $misSeniorAssignArray=$misSeniorAssignArr[$m_no][$e_usr][$e_cli];
                            }
                            
                            if(isset($misJuniorAssignArr[$m_no][$e_usr][$e_cli]))
                            {
                                $misJuniorAssignArray=$misJuniorAssignArr[$m_no][$e_usr][$e_cli];
                            }
                            
                            if(!empty($misSeniorAssignArray) && !empty($misJuniorAssignArray))
                            {
                                $misAssignArray[$m_no][$e_cli] = $misSeniorAssignArray + $misJuniorAssignArray;
                            }
                            elseif(!empty($misSeniorAssignArray) && empty($misJuniorAssignArray))
                            {
                                $misAssignArray[$m_no][$e_cli] = $misSeniorAssignArray;
                            }
                            elseif(empty($misSeniorAssignArray) && !empty($misJuniorAssignArray))
                            {
                                $misAssignArray[$m_no][$e_cli] = $misJuniorAssignArray;
                            }
                            
                            $misSeniorFiledArray=array();
                            $misJuniorFiledArray=array();
                            
                            if(isset($misSeniorFiledArr[$m_no][$e_usr][$e_cli]))
                            {
                                $misSeniorFiledArray=count($misSeniorFiledArr[$m_no][$e_usr][$e_cli]);
                            }
                            
                            if(isset($misJuniorFiledArr[$m_no][$e_usr][$e_cli]))
                            {
                                $misJuniorFiledArray=count($misJuniorFiledArr[$m_no][$e_usr][$e_cli]);
                            }
                            
                            if(!empty($misSeniorFiledArray) && !empty($misJuniorFiledArray))
                            {
                                $misFiledArray[$m_no][$e_cli] = $misSeniorFiledArray + $misJuniorFiledArray;
                            }
                            elseif(!empty($misSeniorFiledArray) && empty($misJuniorFiledArray))
                            {
                                $misFiledArray[$m_no][$e_cli] = $misSeniorFiledArray;
                            }
                            elseif(empty($misSeniorFiledArray) && !empty($misJuniorFiledArray))
                            {
                                $misFiledArray[$m_no][$e_cli] = $misJuniorFiledArray;
                            }
                        }
                    }
                }
            }
        }
        
        $this->data['misAssignArray']=$misAssignArray;
        $this->data['misFiledArray']=$misFiledArray;
        
        $getClientList=array();
        
        if(!empty($incRetClientArr))
        {
            $clientCondtnArr['client_tbl.status']=1;
            $clientWhereInArray['client_tbl.clientId']=$incRetClientArr;
            
            $clientOrderByArr['client_group_tbl.client_group_number']='ASC';
            $clientOrderByArr['client_tbl.clientId']='ASC';
            
            $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_tbl.clientGroup=client_group_tbl.client_group_id AND client_tbl.status=1", "type"=>"left");
    
            $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group_number", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $clientWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
            
            $getClientList=$query['userData'];
        }
        
        $this->data['getClientList']=$getClientList;
        
        $clientReturnsArr=array();
        
        if(!empty($getClientList))
        {
            foreach($getClientList AS $k_client=>$e_client)
            {
                for($m_no=1;$m_no<13;$m_no++)
                {
                    if($e_client['orgType']==8)
                        $clientName=$e_client['clientName']." (".$e_client['clientBussOrganisation'].")";
                    elseif($e_client['orgType']==9 || $e_client['orgType']==22 || $e_client['orgType']==23)
                        $clientName=$e_client['clientName'];
                    else
                        $clientName=$e_client['clientBussOrganisation'];
                        
                    $clientId=$e_client['clientId'];
                    $client_group_number=$e_client['client_group_number'];
                    
                    $assignCount=0;
                    if(isset($misAssignArray[$m_no][$clientId]))
                        $assignCount=$misAssignArray[$m_no][$clientId];
                    else
                        $assignCount=0;
                    
                    $filedCount=0;
                    if(isset($misFiledArray[$m_no][$clientId]))
                        $filedCount=$misFiledArray[$m_no][$clientId];
                    else
                        $filedCount=0;
                    
                    $pendingCount=$assignCount-$filedCount;
                    
                    $clientReturnsArr[$m_no][$k_client]['sr']=$k_client+1;
                    $clientReturnsArr[$m_no][$k_client]['clientId']=$clientId;
                    $clientReturnsArr[$m_no][$k_client]['client_group_number']=$client_group_number;
                    $clientReturnsArr[$m_no][$k_client]['clientName']=$clientName;
                    $clientReturnsArr[$m_no][$k_client]['assignCount']=$assignCount;
                    $clientReturnsArr[$m_no][$k_client]['filedCount']=$filedCount;
                    $clientReturnsArr[$m_no][$k_client]['pendingCount']=$pendingCount;
                }
            }
        }
        
        $this->data['clientReturnsArr']=$clientReturnsArr;
        
        $userCondtnArr['user_tbl.status']=1;
        $userCondtnArr['user_tbl.userId']=$retUserId;
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames='user_tbl.userId, user_tbl.userFullName, user_tbl.userShortName', $userCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userDataArr=$query['userData'];
        
        $this->data['userDataArr']=$userDataArr;
        
        return view('firm_panel/compliance/tds_tcs/staff_wise_position_client_wise', $this->data);
    }
    
	public function summary_of_returns()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="TDS-TCS - MIS Report - Summary of Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $actVal = array(3, 16); // TDS-TCS
        
        $dueDateForCondtn = array(
            'option_type'   =>  1,
            'status'        =>  1,
        );
        
        $dueDateForArr = $this->Mact_option->where($dueDateForCondtn)
                    ->whereIn("fk_act_id", $actVal)
                    ->orderBy('sortBy', 'ASC')
                    ->findAll();

        $this->data['dueDateForArr']=$dueDateForArr;
        
        $taxWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        $taxWhereInArray['due_date_master_tbl.due_act']=$actVal;

        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $taxCondtnArr['work_tbl.workId !=']='';
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['client_tbl.status']="1";

        $taxOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND work_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId AND client_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            due_date_master_tbl.due_date_for,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section,
            COUNT(work_tbl.workId) AS totalWorkCount
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $taxWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $ddfIDArr=array();
        $dueDateForDataArr=array();
        $totalReturnsCountArr=array();
        $filedReturnsCountArr=array();
        
        if(!empty($dueDatesArr))
        {
            $ddfIDArr=array_unique(array_column($dueDatesArr, 'due_date_for'));
            foreach($dueDatesArr AS $e_dd)
            {
                $dueDateForDataArr[$e_dd['due_date_for']]=array(
                    'due_date_form' => $e_dd['due_date_form'],
                    'due_date_section' => $e_dd['due_date_section']
                );
                
                $totalReturnsCountArr[$e_dd['due_date_for']][$e_dd['act_due_month']]=array(
                    'totalWorkCount' => $e_dd['totalWorkCount']
                );
            }
        }
        
        $this->data['ddfIDArr']=$ddfIDArr;
        $this->data['dueDateForDataArr']=$dueDateForDataArr;
        $this->data['totalReturnsCountArr']=$totalReturnsCountArr;
        
        $taxWhereInArray=$taxCondtnArr=$taxOrderByArr=$taxGroupByArr=$taxJoinArr=array();
        
        $taxWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        $taxWhereInArray['due_date_master_tbl.due_act']=$actVal;

        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $taxCondtnArr['work_tbl.workId !=']='';
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        // $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['client_tbl.status']="1";

        $taxOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND work_tbl.status=1 AND work_tbl.eFillingDate!='' AND work_tbl.eFillingDate!='0000-00-00' AND work_tbl.eFillingDate!='1970-01-01'", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId AND client_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            due_date_master_tbl.due_date_for,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section,
            COUNT(work_tbl.workId) AS filedWorkCount
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $taxWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $filedReturnsCountArr=array();
        
        if(!empty($dueDatesArr))
        {
            $ddfIDArr=array_unique(array_column($dueDatesArr, 'due_date_for'));
            foreach($dueDatesArr AS $e_dd)
            {
                $filedReturnsCountArr[$e_dd['due_date_for']][$e_dd['act_due_month']]=array(
                    'filedWorkCount' => $e_dd['filedWorkCount']
                );
            }
        }
        
        $this->data['filedReturnsCountArr']=$filedReturnsCountArr;

        return view('firm_panel/compliance/tds_tcs/summary_of_returns', $this->data);
    }
    
    public function staff_wise_summary()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="TDS-TCS - MIS Report - Staff-wise Summary";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $actVal = array(3, 16); // TDS-TCS
        
        $dueDateForCondtn = array(
            'option_type'   =>  1,
            'status'        =>  1,
        );
        
        $dueDateForArr = $this->Mact_option->where($dueDateForCondtn)
                    ->whereIn("fk_act_id", $actVal)
                    ->orderBy('sortBy', 'ASC')
                    ->findAll();

        $this->data['dueDateForArr']=$dueDateForArr;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userFullName", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        $taxWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        $taxWhereInArray['due_date_master_tbl.due_act']=$actVal;

        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $taxCondtnArr['work_tbl.workId !=']='';
        $taxCondtnArr['work_tbl.status']="1";
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['due_date_for_tbl.status']=1;
        $taxCondtnArr['client_tbl.status']="1";

        $taxOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";
        $taxgroupByArr=array("work_junior_map_tbl.fkUserId", "DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')");

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND work_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId AND client_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            due_date_master_tbl.due_date_for,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            COUNT(work_tbl.workId) AS totalWorkCount,
            work_junior_map_tbl.fkUserId AS juniorId
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxgroupByArr, $taxWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $staffIDArr=array();
        $totalReturnsCountArr=array();
        $filedReturnsCountArr=array();
        
        if(!empty($dueDatesArr))
        {
            $staffIDArr=array_unique(array_column($dueDatesArr, 'juniorId'));
            foreach($dueDatesArr AS $e_dd)
            {
                $totalReturnsCountArr[$e_dd['juniorId']][$e_dd['act_due_month']]=array(
                    'totalWorkCount' => $e_dd['totalWorkCount']
                );
            }
        }
        
        $this->data['staffIDArr']=$staffIDArr;
        $this->data['totalReturnsCountArr']=$totalReturnsCountArr;
        
        $taxWhereInArray=$taxCondtnArr=$taxOrderByArr=$taxGroupByArr=$taxJoinArr=array();
        
        $taxWhereInArray['due_date_for_tbl.act_option_map_id']=TDS_TCS_INC_RET_DDF_ARRAY;
        $taxWhereInArray['due_date_master_tbl.due_act']=$actVal;

        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $taxCondtnArr['work_tbl.workId !=']='';
        $taxCondtnArr['work_tbl.status']="1";
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['due_date_for_tbl.status']=1;
        $taxCondtnArr['client_tbl.status']="1";

        $taxOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";
        $taxgroupByArr=array("work_junior_map_tbl.fkUserId", "DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')");

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND work_tbl.status=1 AND work_tbl.eFillingDate!='' AND work_tbl.eFillingDate!='0000-00-00' AND work_tbl.eFillingDate!='1970-01-01'", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId AND client_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            COUNT(work_tbl.workId) AS filedWorkCount,
            work_junior_map_tbl.fkUserId AS juniorId
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxgroupByArr, $taxWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $filedReturnsCountArr=array();
        
        if(!empty($dueDatesArr))
        {
            foreach($dueDatesArr AS $e_dd)
            {
                $filedReturnsCountArr[$e_dd['juniorId']][$e_dd['act_due_month']]=array(
                    'filedWorkCount' => $e_dd['filedWorkCount']
                );
            }
        }
        
        $this->data['filedReturnsCountArr']=$filedReturnsCountArr;

        return view('firm_panel/compliance/tds_tcs/staff_wise_summary', $this->data);
    }
}