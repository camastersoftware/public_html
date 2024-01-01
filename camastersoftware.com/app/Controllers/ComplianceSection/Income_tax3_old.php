<?php namespace App\Controllers\ComplianceSection;
use \App\Controllers\BaseController;

class Income_tax3 extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Income Tax";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->Muser = new \App\Models\Muser();
        $this->Mdemand = new \App\Models\Mdemand();
        $this->MRectification = new \App\Models\MRectification();
        $this->MRectificationHearing = new \App\Models\MRectificationHearing();
        $this->MNoticeUnderSection = new \App\Models\MNoticeUnderSection();
        $this->MActOrderType = new \App\Models\MActOrderType();
        $this->MscrutinyNotice = new \App\Models\MscrutinyNotice();
        $this->MscrutinyNoticeReply = new \App\Models\MscrutinyNoticeReply();
        $this->Mlevel = new \App\Models\Mlevel();
        $this->Mappeal = new \App\Models\Mappeal();
        $this->MappealNotice = new \App\Models\MappealNotice();
        $this->MappealNoticeReply = new \App\Models\MappealNoticeReply();
        $this->MorderAnalysis = new \App\Models\MorderAnalysis();
        $this->MorderAnalysisTax = new \App\Models\MorderAnalysisTax();
        $this->MorderAnalysisExpense = new \App\Models\MorderAnalysisExpense();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->TableLib = new \App\Libraries\TableLib();
        
        $tableArr=$this->TableLib->get_tables();

        $this->act_tbl=$tableArr['act_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->refund_tbl=$tableArr['refund_tbl'];
        $this->demand_tbl=$tableArr['demand_tbl'];
        $this->rectification_tbl=$tableArr['rectification_tbl'];
        $this->rectification_hearing_tbl=$tableArr['rectification_hearing_tbl'];
        $this->notice_under_section_tbl=$tableArr['notice_under_section_tbl'];
        $this->act_order_type_master=$tableArr['act_order_type_master'];
        $this->hearing_tbl=$tableArr['hearing_tbl'];
        $this->scrutiny_notice_tbl=$tableArr['scrutiny_notice_tbl'];
        $this->scrutiny_notice_reply_tbl=$tableArr['scrutiny_notice_reply_tbl'];
        $this->level_tbl=$tableArr['level_tbl'];
        $this->appeal_tbl=$tableArr['appeal_tbl'];
        $this->appeal_notice_tbl=$tableArr['appeal_notice_tbl'];
        $this->appeal_notice_reply_tbl=$tableArr['appeal_notice_reply_tbl'];
        $this->order_analysis_tbl=$tableArr['order_analysis_tbl'];
        $this->order_analysis_tax_tbl=$tableArr['order_analysis_tax_tbl'];
        $this->order_analysis_expense_tbl=$tableArr['order_analysis_expense_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->client_document_tbl=$tableArr['client_document_tbl'];
        $this->group_category_tbl=$tableArr['group_category_tbl'];
        $this->salutation_tbl=$tableArr['salutation_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
        $this->client_act_map_tbl=$tableArr['client_act_map_tbl'];
        $this->work_junior_map_tbl=$tableArr['work_junior_map_tbl'];
        $this->periodicity_tbl=$tableArr['periodicity_tbl'];
        
        $currMth=date('n');
        $this->currentMth=date('n');
        $this->currentYear=date('Y');
        
        $this->data['currMth']=$currMth;
        
        helper("cookie");
    }
    
    function setMyCookie($name,$value,$time,$params = array()){
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
    
        setcookie($name,$value,$params);
    }
    
    public function statements_ddf()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Statement Cum Challan";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $ddfArr = $this->Mact_option->where('act_option_map_tbl.status', 1)
                        ->where('act_option_map_tbl.fk_act_id', 1)
                        ->where('act_option_map_tbl.option_type', 1)
                        ->where('act_option_map_tbl.due_date_type', 5)
                        ->orderBy('act_option_map_tbl.sortBy', "ASC")
                        ->findAll();
    
        $this->data['ddfArr']=$ddfArr;
        
        return view('firm_panel/compliance/income_tax/statements_ddf', $this->data);
    }
    
    public function statements($ddfId)
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
    
        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        
        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;
    
        $pageTitle="Income Tax - Statement Cum Challan";
        $this->data['pageTitle']=$pageTitle;
    
        $navArr=array();
    
        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
    
        $this->data['navArr']=$navArr;
        
        $this->data['ddfId']=$ddfId;
        
        $actId=1; // Income Tax
        
        $ddfDataArr=$this->Mact_option->where('act_option_map_id', $ddfId)
                    ->where('fk_act_id', $actId)
                    ->where('status', 1)
                    ->first();
    
        $this->data['ddfDataArr']=$ddfDataArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $ftr_clientgrp = (!empty(get_cookie("inc_tax_stmt_clientgrp_cookie"))) ? get_cookie("inc_tax_stmt_clientgrp_cookie") : "";
        $ftr_client = (!empty(get_cookie("inc_tax_stmt_client_cookie"))) ? get_cookie("inc_tax_stmt_client_cookie") : "";
        $ftr_junior = (!empty(get_cookie("inc_tax_stmt_junior_cookie"))) ? get_cookie("inc_tax_stmt_junior_cookie") : "";
        $ftr_staff = (!empty(get_cookie("inc_tax_stmt_staff_cookie"))) ? get_cookie("inc_tax_stmt_staff_cookie") : "";
        $ftr_e_verify = (!empty(get_cookie("inc_tax_stmt_e_verify_cookie"))) ? get_cookie("inc_tax_stmt_e_verify_cookie") : "";
        $ftr_set_by = (!empty(get_cookie("inc_tax_stmt_set_by_cookie"))) ? get_cookie("inc_tax_stmt_set_by_cookie") : "";
        $ftr_billing = (!empty(get_cookie("inc_tax_stmt_billing_cookie"))) ? get_cookie("inc_tax_stmt_billing_cookie") : "";
        $ftr_receipt = (!empty(get_cookie("inc_tax_stmt_receipt_cookie"))) ? get_cookie("inc_tax_stmt_receipt_cookie") : "";
        
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
        $workCondtnArr['act_tbl.act_id']=$actId;
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
        
        $DDFDueDateArr=array();
        $DDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $DDFDueDateArr[$e_tx['due_date_id']]=$e_tx;
                
                $DDFDueDateForClientArr[$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['DDFDueDateArr']=$DDFDueDateArr;
        $this->data['DDFDueDateForClientArr']=$DDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->orderBy('client_group_tbl.client_group', 'ASC')
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
        
        return view('firm_panel/compliance/income_tax/statements', $this->data);
    }
    
    public function statements_filed($ddfId)
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        
        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;
    
        $pageTitle="Income Tax - Statement Cum Challan - Filed";
        $this->data['pageTitle']=$pageTitle;
    
        $navArr=array();
    
        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
    
        $this->data['navArr']=$navArr;
        
        $this->data['ddfId']=$ddfId;
        
        $actId=1; // Income Tax
        
        $ddfDataArr=$this->Mact_option->where('act_option_map_id', $ddfId)
                    ->where('fk_act_id', $actId)
                    ->where('status', 1)
                    ->first();
    
        $this->data['ddfDataArr']=$ddfDataArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $ftr_clientgrp = (!empty(get_cookie("inc_tax_stmt_clientgrp_cookie"))) ? get_cookie("inc_tax_stmt_clientgrp_cookie") : "";
        $ftr_client = (!empty(get_cookie("inc_tax_stmt_client_cookie"))) ? get_cookie("inc_tax_stmt_client_cookie") : "";
        $ftr_junior = (!empty(get_cookie("inc_tax_stmt_junior_cookie"))) ? get_cookie("inc_tax_stmt_junior_cookie") : "";
        $ftr_staff = (!empty(get_cookie("inc_tax_stmt_staff_cookie"))) ? get_cookie("inc_tax_stmt_staff_cookie") : "";
        $ftr_e_verify = (!empty(get_cookie("inc_tax_stmt_e_verify_cookie"))) ? get_cookie("inc_tax_stmt_e_verify_cookie") : "";
        $ftr_set_by = (!empty(get_cookie("inc_tax_stmt_set_by_cookie"))) ? get_cookie("inc_tax_stmt_set_by_cookie") : "";
        $ftr_billing = (!empty(get_cookie("inc_tax_stmt_billing_cookie"))) ? get_cookie("inc_tax_stmt_billing_cookie") : "";
        $ftr_receipt = (!empty(get_cookie("inc_tax_stmt_receipt_cookie"))) ? get_cookie("inc_tax_stmt_receipt_cookie") : "";
        
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
        $workCondtnArr['act_tbl.act_id']=$actId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate != ']="0000-00-00";
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
        
        $DDFDueDateArr=array();
        $DDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $DDFDueDateArr[$e_tx['due_date_id']]=$e_tx;
                
                $DDFDueDateForClientArr[$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['DDFDueDateArr']=$DDFDueDateArr;
        $this->data['DDFDueDateForClientArr']=$DDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->orderBy('client_group_tbl.client_group', 'ASC')
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
        
        return view('firm_panel/compliance/income_tax/statements_filed', $this->data);
    }
    
    public function search_statements()
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
            $this->setMyCookie("inc_tax_stmt_clientgrp_cookie", $ftr_clientgrp, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_stmt_clientgrp_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_client))
            $this->setMyCookie("inc_tax_stmt_client_cookie", $ftr_client, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_stmt_client_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_junior))
            $this->setMyCookie("inc_tax_stmt_junior_cookie", $ftr_junior, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_stmt_junior_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_staff))
            $this->setMyCookie("inc_tax_stmt_staff_cookie", $ftr_staff, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_stmt_staff_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_e_verify))
            $this->setMyCookie("inc_tax_stmt_e_verify_cookie", $ftr_e_verify, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_stmt_e_verify_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_set_by))
            $this->setMyCookie("inc_tax_stmt_set_by_cookie", $ftr_set_by, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_stmt_set_by_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_billing))
            $this->setMyCookie("inc_tax_stmt_billing_cookie", $ftr_billing, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_stmt_billing_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_receipt))
            $this->setMyCookie("inc_tax_stmt_receipt_cookie", $ftr_receipt, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_stmt_receipt_cookie", "", $cookieExpirationTime);
            
        if($ftr_type==1)
            return redirect()->to(base_url("it-statements/".$ddfId));
        elseif($ftr_type==2)
            return redirect()->to(base_url("it-statements-filed/".$ddfId));
    }
    
    public function reset_statements()
    {
        $cookieExpirationTime = time()+3600;
        
        $ftr_type=$this->request->getGet('ftr_type');
        $ddfId=$this->request->getGet('ddfId');
        
        $this->setMyCookie("inc_tax_stmt_clientgrp_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_stmt_client_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_stmt_junior_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_stmt_staff_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_stmt_e_verify_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_stmt_set_by_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_stmt_billing_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_stmt_receipt_cookie", '', $cookieExpirationTime);
        
        if($ftr_type==1)
            return redirect()->to(base_url('it-statements/'.$ddfId));
        elseif($ftr_type==2)
            return redirect()->to(base_url('it-statements-filed/'.$ddfId));
    }
    
    public function forms_ddf()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Forms";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $ddfArr = $this->Mact_option->where('act_option_map_tbl.status', 1)
                        ->where('act_option_map_tbl.fk_act_id', 1)
                        ->where('act_option_map_tbl.option_type', 1)
                        ->where('act_option_map_tbl.due_date_type', 6)
                        ->orderBy('act_option_map_tbl.sortBy', "ASC")
                        ->findAll();
    
        $this->data['ddfArr']=$ddfArr;
        
        return view('firm_panel/compliance/income_tax/forms_ddf', $this->data);
    }
    
    public function forms($ddfId)
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
    
        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        
        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;
    
        $pageTitle="Income Tax - Forms";
        $this->data['pageTitle']=$pageTitle;
    
        $navArr=array();
    
        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
    
        $this->data['navArr']=$navArr;
        
        $this->data['ddfId']=$ddfId;
        
        $actId=1; // Income Tax
        
        $ddfDataArr=$this->Mact_option->where('act_option_map_id', $ddfId)
                    ->where('fk_act_id', $actId)
                    ->where('status', 1)
                    ->first();
    
        $this->data['ddfDataArr']=$ddfDataArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $ftr_clientgrp = (!empty(get_cookie("inc_tax_form_clientgrp_cookie"))) ? get_cookie("inc_tax_form_clientgrp_cookie") : "";
        $ftr_client = (!empty(get_cookie("inc_tax_form_client_cookie"))) ? get_cookie("inc_tax_form_client_cookie") : "";
        $ftr_junior = (!empty(get_cookie("inc_tax_form_junior_cookie"))) ? get_cookie("inc_tax_form_junior_cookie") : "";
        $ftr_staff = (!empty(get_cookie("inc_tax_form_staff_cookie"))) ? get_cookie("inc_tax_form_staff_cookie") : "";
        $ftr_e_verify = (!empty(get_cookie("inc_tax_form_e_verify_cookie"))) ? get_cookie("inc_tax_form_e_verify_cookie") : "";
        $ftr_set_by = (!empty(get_cookie("inc_tax_form_set_by_cookie"))) ? get_cookie("inc_tax_form_set_by_cookie") : "";
        $ftr_billing = (!empty(get_cookie("inc_tax_form_billing_cookie"))) ? get_cookie("inc_tax_form_billing_cookie") : "";
        $ftr_receipt = (!empty(get_cookie("inc_tax_form_receipt_cookie"))) ? get_cookie("inc_tax_form_receipt_cookie") : "";
        
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
        $workCondtnArr['act_tbl.act_id']=$actId;
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
        
        $DDFDueDateArr=array();
        $DDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $DDFDueDateArr[$e_tx['due_date_id']]=$e_tx;
                
                $DDFDueDateForClientArr[$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['DDFDueDateArr']=$DDFDueDateArr;
        $this->data['DDFDueDateForClientArr']=$DDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->orderBy('client_group_tbl.client_group', 'ASC')
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
        
        return view('firm_panel/compliance/income_tax/forms', $this->data);
    }
    
    public function forms_filed($ddfId)
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        
        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;
    
        $pageTitle="Income Tax - Forms - Filed";
        $this->data['pageTitle']=$pageTitle;
    
        $navArr=array();
    
        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
    
        $this->data['navArr']=$navArr;
        
        $this->data['ddfId']=$ddfId;
        
        $actId=1; // Income Tax
        
        $ddfDataArr=$this->Mact_option->where('act_option_map_id', $ddfId)
                    ->where('fk_act_id', $actId)
                    ->where('status', 1)
                    ->first();
    
        $this->data['ddfDataArr']=$ddfDataArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $ftr_clientgrp = (!empty(get_cookie("inc_tax_form_clientgrp_cookie"))) ? get_cookie("inc_tax_form_clientgrp_cookie") : "";
        $ftr_client = (!empty(get_cookie("inc_tax_form_client_cookie"))) ? get_cookie("inc_tax_form_client_cookie") : "";
        $ftr_junior = (!empty(get_cookie("inc_tax_form_junior_cookie"))) ? get_cookie("inc_tax_form_junior_cookie") : "";
        $ftr_staff = (!empty(get_cookie("inc_tax_form_staff_cookie"))) ? get_cookie("inc_tax_form_staff_cookie") : "";
        $ftr_e_verify = (!empty(get_cookie("inc_tax_form_e_verify_cookie"))) ? get_cookie("inc_tax_form_e_verify_cookie") : "";
        $ftr_set_by = (!empty(get_cookie("inc_tax_form_set_by_cookie"))) ? get_cookie("inc_tax_form_set_by_cookie") : "";
        $ftr_billing = (!empty(get_cookie("inc_tax_form_billing_cookie"))) ? get_cookie("inc_tax_form_billing_cookie") : "";
        $ftr_receipt = (!empty(get_cookie("inc_tax_form_receipt_cookie"))) ? get_cookie("inc_tax_form_receipt_cookie") : "";
        
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
        $workCondtnArr['act_tbl.act_id']=$actId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate != ']="0000-00-00";
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
        
        $DDFDueDateArr=array();
        $DDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $DDFDueDateArr[$e_tx['due_date_id']]=$e_tx;
                
                $DDFDueDateForClientArr[$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['DDFDueDateArr']=$DDFDueDateArr;
        $this->data['DDFDueDateForClientArr']=$DDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->orderBy('client_group_tbl.client_group', 'ASC')
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
        
        return view('firm_panel/compliance/income_tax/forms_filed', $this->data);
    }
    
    public function search_forms()
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
            $this->setMyCookie("inc_tax_form_clientgrp_cookie", $ftr_clientgrp, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_form_clientgrp_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_client))
            $this->setMyCookie("inc_tax_form_client_cookie", $ftr_client, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_form_client_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_junior))
            $this->setMyCookie("inc_tax_form_junior_cookie", $ftr_junior, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_form_junior_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_staff))
            $this->setMyCookie("inc_tax_form_staff_cookie", $ftr_staff, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_form_staff_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_e_verify))
            $this->setMyCookie("inc_tax_form_e_verify_cookie", $ftr_e_verify, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_form_e_verify_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_set_by))
            $this->setMyCookie("inc_tax_form_set_by_cookie", $ftr_set_by, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_form_set_by_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_billing))
            $this->setMyCookie("inc_tax_form_billing_cookie", $ftr_billing, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_form_billing_cookie", "", $cookieExpirationTime);
            
        if(!empty($ftr_receipt))
            $this->setMyCookie("inc_tax_form_receipt_cookie", $ftr_receipt, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_form_receipt_cookie", "", $cookieExpirationTime);
            
        if($ftr_type==1)
            return redirect()->to(base_url("it-forms/".$ddfId));
        elseif($ftr_type==2)
            return redirect()->to(base_url("it-forms-filed/".$ddfId));
    }
    
    public function reset_forms()
    {
        $cookieExpirationTime = time()+3600;
        
        $ftr_type=$this->request->getGet('ftr_type');
        $ddfId=$this->request->getGet('ddfId');
        
        $this->setMyCookie("inc_tax_form_clientgrp_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_form_client_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_form_junior_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_form_staff_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_form_e_verify_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_form_set_by_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_form_billing_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_form_receipt_cookie", '', $cookieExpirationTime);
        
        if($ftr_type==1)
            return redirect()->to(base_url('it-forms/'.$ddfId));
        elseif($ftr_type==2)
            return redirect()->to(base_url('it-forms-filed/'.$ddfId));
    }
}
?>