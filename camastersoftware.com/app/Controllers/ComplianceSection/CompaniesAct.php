<?php namespace App\Controllers\ComplianceSection;
use \App\Controllers\BaseController;

class CompaniesAct extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Companies Act";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Muser = new \App\Models\Muser();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->McmpyAuthCap = new \App\Models\McmpyAuthCap();
        $this->McmpyIssuePaidCap = new \App\Models\McmpyIssuePaidCap();
        $this->McmpyDividPaid = new \App\Models\McmpyDividPaid();
        $this->McmpyDirector = new \App\Models\McmpyDirector();
        $this->McmpyShrHold = new \App\Models\McmpyShrHold();
        $this->McmpyIssueType = new \App\Models\McmpyIssueType();
        $this->MVerificationMode = new \App\Models\MVerificationMode();
        $this->TableLib = new \App\Libraries\TableLib();

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

        $pageTitle="Companies Act : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/companies_act_menus', $this->data);
	}
	
	public function getDirThreeKycClients()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="DIR-3 KYC";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=4;
        $workCondtnArr['due_date_for_tbl.due_date_type']=6;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        $workOrderByArr['due_date_master_tbl.due_date_id']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=4 AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id AND work_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.due_date_type=6", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_tbl.dirKycAllotedTo", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.workCode,
            due_date_master_tbl.due_date_id,
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.finYear,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            ext_due_date_master_tbl.extended_date,
            due_date_for_tbl.act_option_name AS act_option_name1,
            due_date_for_tbl.due_date_type,
            act_tbl.act_id,
            periodicity_tbl.periodicity_name,
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType, 
            client_tbl.dirKycEmail, 
            client_tbl.dirKycMob, 
            client_tbl.dirKycAllotedTo, 
            client_tbl.dirKycUpdatedOn, 
            client_tbl.dirKycSrnNo, 
            client_tbl.dirKycApprovedOn,
            user_tbl.userShortName,
            organisation_type_tbl.shortName AS client_org_short_name,
            client_document_map_tbl.client_document_number
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        $this->data['workDataArr']=$workDataArr;
        
        $DDFArr=array();
        $DDFDueDateArr=array();
        $DDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $DDFArr[$e_tx['due_date_for']]=$e_tx;
                
                $DDFDueDateArr[$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $DDFDueDateForClientArr[$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }

        $this->data['DDFArr']=$DDFArr;
        $this->data['DDFDueDateArr']=$DDFDueDateArr;
        $this->data['DDFDueDateForClientArr']=$DDFDueDateForClientArr;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userStaffType", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        return view('firm_panel/compliance/companies/getDirThreeKycClients', $this->data);
    }
	
	public function getDirThreeKycClientsOld()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="DIR-3 KYC";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        ini_set('memory_limit', '-1');
	    
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_document_map_tbl.fk_client_document_id']=4;
        $clientCondtnArr['client_document_map_tbl.client_document_number !=']='';
        
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        $clientOrderByArr['client_tbl.clientId']="ASC";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_tbl.dirKycAllotedTo", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_document_map_tbl.fk_client_id=client_tbl.clientId AND client_document_map_tbl.fk_client_document_id=4 AND client_document_map_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_tbl.dirKycAllotedTo, client_tbl.dirKycUpdatedOn, client_tbl.dirKycSrnNo, client_tbl.dirKycApprovedOn, client_tbl.isOldClient, client_group_tbl.client_group, client_group_tbl.client_group_number, user_tbl.userShortName, client_document_map_tbl.client_document_number", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userStaffType", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        return view('firm_panel/compliance/companies/getDirThreeKycClients', $this->data);
    }
    
    public function updateClientDirThreeKyc()
    {
        $this->db->transBegin();
	    
	    $clientId=$this->request->getPost('clientId');
	    $dirKycEmail=$this->request->getPost('dirKycEmail');
	    $dirKycMob=$this->request->getPost('dirKycMob');
	    $dirKycAllotedTo=$this->request->getPost('dirKycAllotedTo');
	    $dirKycUpdatedOn=$this->request->getPost('dirKycUpdatedOn');
	    $dirKycSrnNo=$this->request->getPost('dirKycSrnNo');
	    $dirKycApprovedOn=$this->request->getPost('dirKycApprovedOn');
	    
	    $clientUpdateArr = [
            'dirKycEmail'       => $dirKycEmail,
            'dirKycMob'         => $dirKycMob,
            'dirKycAllotedTo'   => $dirKycAllotedTo,
            'dirKycUpdatedOn'   => $dirKycUpdatedOn,
            'dirKycSrnNo'       => $dirKycSrnNo,
            'dirKycApprovedOn'  => $dirKycApprovedOn,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];

        $clientCondtnArr['client_tbl.clientId']=$clientId;

        $query=$this->Mcommon->updateData($tableName=$this->client_tbl, $clientUpdateArr, $clientCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Client DIR-3 KYC has not updated :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Client DIR-3 KYC Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Client DIR-3 KYC has been updated successfully :)");
	    }
	    
	    return redirect()->back();
    }
    
    public function company_returns()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Companies Act - Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $selected_mth_tab=$this->request->getPost('selected_mth_tab');
        $ftr_clientgrp=$this->request->getPost('ftr_clientgrp');
        $ftr_client=$this->request->getPost('ftr_client');
        $ftr_costcenter=$this->request->getPost('ftr_costcenter');
        $ftr_junior=$this->request->getPost('ftr_junior');
        $ftr_staff=$this->request->getPost('ftr_staff');
        $ftr_ddf=$this->request->getPost('ftr_ddf');
        $ftr_period=$this->request->getPost('ftr_period');
        $ftr_ddm=$this->request->getPost('ftr_ddm');
        $ftr_e_verify=$this->request->getPost('ftr_e_verify');
        $ftr_set_by=$this->request->getPost('ftr_set_by');
        $ftr_billing=$this->request->getPost('ftr_billing');
        $ftr_receipt=$this->request->getPost('ftr_receipt');
        
        if(empty($selected_mth_tab))
        {
            $selected_mth_tab=strtolower(date('M', strtotime("2021-".$this->currentMth."-1"))).'_tab';
        }
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_costcenter))
            $workCondtnArr['user_tbl.userId']=$ftr_costcenter;
            
        if(!empty($ftr_junior))
            $workCondtnArr['work_junior_map_tbl.fkUserId']=$ftr_junior;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        if(!empty($ftr_ddf))
            $workCondtnArr['due_date_for_tbl.act_option_map_id']=$ftr_ddf;
        else
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=CMPY_RET_DDF_ARRAY;
            
        if(!empty($ftr_period))
            $workCondtnArr['due_date_master_tbl.periodicity']=$ftr_period;
            
        if(!empty($ftr_ddm))
            $workCondtnArr["DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')"]=$ftr_ddm;
            
        $this->data['selected_mth_tab']=$selected_mth_tab;
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_costcenter']=$ftr_costcenter;
        $this->data['ftr_junior']=$ftr_junior;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_ddf']=$ftr_ddf;
        $this->data['ftr_period']=$ftr_period;
        $this->data['ftr_ddm']=$ftr_ddm;
        $this->data['ftr_e_verify']=$ftr_e_verify;
        $this->data['ftr_set_by']=$ftr_set_by;
        $this->data['ftr_billing']=$ftr_billing;
        $this->data['ftr_receipt']=$ftr_receipt;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

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
        $workCondtnArr['act_tbl.act_id']=4;
        
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
            // $workCondtnArr['work_tbl.isBillingDone !=']='1';
            $workCustomWhereArray[]=" (work_tbl.isBillingDone='' OR work_tbl.isBillingDone IS NULL OR work_tbl.isBillingDone='2')";
        }
        
        if($ftr_receipt==1)
        {
            $workCondtnArr['work_tbl.isReceiptDone']='1';
        }
        elseif($ftr_receipt==2)
        {
            // $workCondtnArr['work_tbl.isReceiptDone !=']='1';
            $workCustomWhereArray[]=" (work_tbl.isReceiptDone='' OR work_tbl.isReceiptDone IS NULL OR work_tbl.isReceiptDone='2')";
        }
        
        if($ftr_e_verify==2 || $ftr_set_by==2 || $ftr_billing==2 || $ftr_receipt==2)
        {
            $workCustomWhereArray[]="work_tbl.eFillingDate!='' AND work_tbl.eFillingDate!='0000-00-00' AND work_tbl.eFillingDate!='1970-01-01'";
        }
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('act_due_month', 'due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl." AS prepared_user_tbl", "condtn"=>"prepared_user_tbl.userId=work_tbl.set_prepared_by AND prepared_user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.isUrgentWork, work_tbl.juniors, work_tbl.isBillingDone, work_tbl.isReceiptDone, work_tbl.billNo, work_tbl.eFillingDate, work_tbl.billDate, work_tbl.billAmt, work_tbl.receiptDate, work_tbl.receiptAmt, work_tbl.billingComment, work_tbl.receiptComment, user_tbl.userShortName AS seniorName, work_tbl.workDone, work_tbl.verificationDate, work_tbl.set_prepared_by, work_tbl.workPriority, work_tbl.workPriorityColor, prepared_user_tbl.userShortName AS setPreparedShortName, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, org_type_tbl.shortName AS client_org_short_name", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                // $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx['act_option_name1'];
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
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
        
        $ddfCondtnArr['act_option_map_tbl.status']="1";
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="4";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=CMPY_RET_DDF_ARRAY;
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        return view('firm_panel/compliance/companies/company_returns', $this->data);
    }
    
	public function work_form($workId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Details of Companies Act Work";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";

        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        
        $columnNames="
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
                    work_tbl.verificationMode,
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
                    work_tbl.cmpyAgmDate,
                    work_tbl.cmpyReceiptNo,
                    work_tbl.cmpyReceiptAmt,
                    work_tbl.cmpyReceiptDate,
                    client_tbl.clientName,
                    client_tbl.clientBussOrganisation,
                    client_tbl.clientBussOrganisationType,
                    client_tbl.clientPanNumber,
                    client_tbl.clientDob,
                    client_tbl.clientBussIncorporationDate,
                    client_tbl.clientRegDocument,
                    user_tbl.userFullName,
                    refund_tbl.refundId,
                    refund_tbl.totalIncome,
                    refund_tbl.refundClaimed,
                    due_date_master_tbl.finYear
                ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        $this->data['workArr']=$workArr;
        
        $workClientName="";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            
            /*
            if($clientBussOrgType==8)
                $workClientName=$workArr['clientName']." (".$workArr['clientBussOrganisation'].")";
            elseif($clientBussOrgType==9)
                $workClientName=$workArr['clientName'];
            else
                $workClientName=$workArr['clientBussOrganisation'];
            */
                
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
        }
        
        $workClientName = (!empty($workClientName)) ? $workClientName : "N/A";
        $clientDobDoi = (!empty($clientDobDoi)) ? $clientDobDoi : "N/A";
        
        $this->data['workClientName']=$workClientName;
        $this->data['clientDobDoi']=$clientDobDoi;

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
        
        $verificationModeCondtn = array(
            'fkActId' => 1,
            'status' => 1
        );
        
        $verificationModeData = $this->MVerificationMode->where($verificationModeCondtn)->findAll();
        
        $this->data['verificationModeData']=$verificationModeData;

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
        $turnOverErr="";
        $grossTotalIncomeErr="";
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
                $turnOverErr=$this->validation->getError('turnOver');
                $grossTotalIncomeErr=$this->validation->getError('grossTotalIncome');
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
                $verificationMode=$this->request->getPost('verificationMode');
                $verificationDate=$this->request->getPost('verificationDate');
                $setPreparedBy=$this->request->getPost('setPreparedBy');
                $isDefectiveRectified=$this->request->getPost('isDefectiveRectified');
                $defectiveRectifiedComment=$this->request->getPost('defectiveRectifiedComment');
                $turnOver=$this->request->getPost('turnOver');
                $grossTotalIncome=$this->request->getPost('grossTotalIncome');
                $totalIncome=$this->request->getPost('totalIncome');
                $selfAssessmentTax=$this->request->getPost('selfAssessmentTax');
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
                $cmpyAgmDate=$this->request->getPost('cmpyAgmDate');
                $cmpyReceiptNo=$this->request->getPost('cmpyReceiptNo');
                $cmpyReceiptAmt=$this->request->getPost('cmpyReceiptAmt');
                $cmpyReceiptDate=$this->request->getPost('cmpyReceiptDate');
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
                                
                            $uploadPath2=$uploadPath1.'/company';

                            if(!is_dir($uploadPath2))
                                mkdir($uploadPath2, 0777, TRUE);
            
                            $ack_upload_file = $ackUploadFile->getRandomName();
                            $ackUploadFile->move($uploadPath2, $ack_upload_file);
                            
                            if(!empty($ackUploadFileHidden))
                            {
                                $delUploadFilePath=$uploadPath2."/".$ackUploadFileHidden;
                                unlink($delUploadFilePath);
                            }
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
                    'verificationMode'=>$verificationMode,
                    'verificationDate'=>$verificationDate,
                    'set_prepared_by'=>$setPreparedBy,
                    'ackUploadFile'=>$ack_upload_file,
                    'isDefectiveRectified'=>$isDefectiveRectified,
                    'defectiveRectifiedComment'=>$defectiveRectifiedCommentVal,
                    'turnOver'=>$turnOver,
                    'grossTotalIncome'=>$grossTotalIncome,
                    'totalIncome'=>$totalIncome,
                    'selfAssessmentTax'=>$selfAssessmentTax,
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
                    'cmpyAgmDate'=>$cmpyAgmDate,
                    'cmpyReceiptNo'=>$cmpyReceiptNo,
                    'cmpyReceiptAmt'=>$cmpyReceiptAmt,
                    'cmpyReceiptDate'=>$cmpyReceiptDate,
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
                
                if(!empty($refundId)){
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
        $this->data['turnOverErr']=$turnOverErr;
        $this->data['grossTotalIncomeErr']=$grossTotalIncomeErr;
        $this->data['totalIncomeErr']=$totalIncomeErr;
        $this->data['selfAssessmentTaxErr']=$selfAssessmentTaxErr;

        return view('firm_panel/compliance/companies/work_form', $this->data);
    }
    
    public function delete_ack_file()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        
        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";

        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");

        $columnNames = "work_tbl.workId, work_tbl.ackUploadFile";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];
        
        if(!empty($workArr))
        {
            $ackUploadFile=$workArr['ackUploadFile'];
            
            if(!empty($ackUploadFile))
            {
                $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId.'/compliance/company/'.$ackUploadFile;
                
                if(unlink($uploadPath))
                {
                    $wkUpdateArr = [
                        'ackUploadFile'     =>  "",
                        'updatedBy'         => $this->adminId,
                        'updatedDatetime'   => $this->currTimeStamp
                    ];
        
                    $wkCondtnArr['work_tbl.workId']=$workId;
        
                    $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Errror while deleting file :(");
                }
            }
        }
        else
        {
            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Acknowlegement file not deleted :(");
        }

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Acknowlegement file not deleted :(");
            
            return false;
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Acknowlegement file deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Acknowlegement file has been deleted successfully :)");
            
            return true;
        }
	}
    
    public function work_form_old($workId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Details of Companies Act Work";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";

        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        
        $columnNames="
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
                    work_tbl.cmpyAgmDate,
                    work_tbl.cmpyReceiptNo,
                    work_tbl.cmpyReceiptAmt,
                    work_tbl.cmpyReceiptDate,
                    client_tbl.clientName,
                    client_tbl.clientBussOrganisation,
                    client_tbl.clientBussOrganisationType,
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
        $asmtYear="N/A";
        
        $workClientName="";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            
            /*
            if($clientBussOrgType==8)
                $workClientName=$workArr['clientName']." (".$workArr['clientBussOrganisation'].")";
            elseif($clientBussOrgType==9)
                $workClientName=$workArr['clientName'];
            else
                $workClientName=$workArr['clientBussOrganisation'];
            */
                
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
        $turnOverErr="";
        $grossTotalIncomeErr="";
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
                $turnOverErr=$this->validation->getError('turnOver');
                $grossTotalIncomeErr=$this->validation->getError('grossTotalIncome');
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
                $turnOver=$this->request->getPost('turnOver');
                $grossTotalIncome=$this->request->getPost('grossTotalIncome');
                $totalIncome=$this->request->getPost('totalIncome');
                $selfAssessmentTax=$this->request->getPost('selfAssessmentTax');
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
                $cmpyAgmDate=$this->request->getPost('cmpyAgmDate');
                $cmpyReceiptNo=$this->request->getPost('cmpyReceiptNo');
                $cmpyReceiptAmt=$this->request->getPost('cmpyReceiptAmt');
                $cmpyReceiptDate=$this->request->getPost('cmpyReceiptDate');
                
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
                    'isDefectiveRectified'=>$isDefectiveRectified,
                    'defectiveRectifiedComment'=>$defectiveRectifiedCommentVal,
                    'turnOver'=>$turnOver,
                    'grossTotalIncome'=>$grossTotalIncome,
                    'totalIncome'=>$totalIncome,
                    'selfAssessmentTax'=>$selfAssessmentTax,
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
                    'cmpyAgmDate'=>$cmpyAgmDate,
                    'cmpyReceiptNo'=>$cmpyReceiptNo,
                    'cmpyReceiptAmt'=>$cmpyReceiptAmt,
                    'cmpyReceiptDate'=>$cmpyReceiptDate,
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
                
                if(!empty($refundId)){
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
        $this->data['turnOverErr']=$turnOverErr;
        $this->data['grossTotalIncomeErr']=$grossTotalIncomeErr;
        $this->data['totalIncomeErr']=$totalIncomeErr;
        $this->data['selfAssessmentTaxErr']=$selfAssessmentTaxErr;

        return view('firm_panel/compliance/companies/work_form', $this->data);
    }
    
    public function company_audits()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Companies Act - Statutory Audits";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $selected_mth_tab=$this->request->getPost('selected_mth_tab');
        $ftr_clientgrp=$this->request->getPost('ftr_clientgrp');
        $ftr_client=$this->request->getPost('ftr_client');
        $ftr_costcenter=$this->request->getPost('ftr_costcenter');
        $ftr_junior=$this->request->getPost('ftr_junior');
        $ftr_staff=$this->request->getPost('ftr_staff');
        $ftr_ddf=$this->request->getPost('ftr_ddf');
        $ftr_period=$this->request->getPost('ftr_period');
        $ftr_ddm=$this->request->getPost('ftr_ddm');
        $ftr_e_verify=$this->request->getPost('ftr_e_verify');
        $ftr_set_by=$this->request->getPost('ftr_set_by');
        $ftr_billing=$this->request->getPost('ftr_billing');
        $ftr_receipt=$this->request->getPost('ftr_receipt');
        
        if(empty($selected_mth_tab))
        {
            $selected_mth_tab=strtolower(date('M', strtotime("2021-".$this->currentMth."-1"))).'_tab';
        }
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_costcenter))
            $workCondtnArr['user_tbl.userId']=$ftr_costcenter;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        if(!empty($ftr_ddf))
            $workCondtnArr['due_date_for_tbl.act_option_map_id']=$ftr_ddf;
        else
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=CMPY_ADT_DDF_ARRAY;
            
        if(!empty($ftr_period))
            $workCondtnArr['due_date_master_tbl.periodicity']=$ftr_period;
            
        if(!empty($ftr_ddm))
            $workCondtnArr["DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')"]=$ftr_ddm;
            
        $this->data['selected_mth_tab']=$selected_mth_tab;
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_costcenter']=$ftr_costcenter;
        $this->data['ftr_junior']=$ftr_junior;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_ddf']=$ftr_ddf;
        $this->data['ftr_period']=$ftr_period;
        $this->data['ftr_ddm']=$ftr_ddm;
        $this->data['ftr_e_verify']=$ftr_e_verify;
        $this->data['ftr_set_by']=$ftr_set_by;
        $this->data['ftr_billing']=$ftr_billing;
        $this->data['ftr_receipt']=$ftr_receipt;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

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
        $workCondtnArr['act_tbl.act_id']=4;
        
        if($ftr_e_verify==1)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate!='' AND work_tbl.verificationDate!='0000-00-00' AND work_tbl.verificationDate!='1970-01-01'";
        }
        elseif($ftr_e_verify==2)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate='' OR work_tbl.verificationDate='0000-00-00' OR work_tbl.verificationDate='1970-01-01'";
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
            $workCondtnArr['work_tbl.isBillingDone !=']='1';
        }
        
        if($ftr_receipt==1)
        {
            $workCondtnArr['work_tbl.isReceiptDone']='1';
        }
        elseif($ftr_receipt==2)
        {
            $workCondtnArr['work_tbl.isReceiptDone !=']='1';
        }
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workGroupByArr=array('act_due_month', 'due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl." AS prepared_user_tbl", "condtn"=>"prepared_user_tbl.userId=work_tbl.set_prepared_by AND prepared_user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.isUrgentWork, work_tbl.juniors, work_tbl.isBillingDone, work_tbl.isReceiptDone, work_tbl.billNo, work_tbl.eFillingDate, work_tbl.billDate, work_tbl.billAmt, work_tbl.receiptDate, work_tbl.receiptAmt, work_tbl.billingComment, work_tbl.receiptComment, user_tbl.userShortName AS seniorName, work_tbl.workDone, work_tbl.verificationDate, work_tbl.set_prepared_by, work_tbl.workPriority, work_tbl.workPriorityColor, prepared_user_tbl.userShortName AS setPreparedShortName, work_tbl.signature_date, work_tbl.auditCompletionDate, work_tbl.udinDate, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, org_type_tbl.shortName AS client_org_short_name", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                // $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx['act_option_name1'];
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
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
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        $ddfCondtnArr['act_option_map_tbl.status']="1";
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="4";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=CMPY_ADT_DDF_ARRAY;
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;
        
        return view('firm_panel/compliance/companies/company_audits', $this->data);
    }
    
	public function audit_work_form($workId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Audit Form";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";

        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
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
                    work_tbl.refundDue,
                    work_tbl.isDefectiveReturn,
                    work_tbl.defectiveReturnComment,
                    work_tbl.isDefectiveRectified,
                    work_tbl.defectiveRectifiedComment,
                    work_tbl.turnOver,
                    work_tbl.grossTotalIncome,
                    work_tbl.totalIncome,
                    work_tbl.selfAssessmentTax,
                    work_tbl.refundDueVal,
                    work_tbl.refundAmtRecvd,
                    work_tbl.refundDate,
                    work_tbl.refundRemark,
                    work_tbl.signature_date,
                    work_tbl.auditCompletionDate,
                    work_tbl.udinDate,
                    work_tbl.udinNo,
                    work_tbl.remark,
                    work_tbl.set_prepared_by,
                    work_tbl.ackUploadFile,
                    work_tbl.workPriority,
                    work_tbl.workPriorityColor,
                    work_tbl.isBillingDone,
                    work_tbl.isReceiptDone,
                    work_tbl.billNo,
                    work_tbl.billDate,
                    work_tbl.billAmt,
                    work_tbl.receiptDate,
                    work_tbl.receiptAmt,
                    work_tbl.billingComment,
                    work_tbl.receiptComment,
                    work_tbl.cmpyAuditAgmDate,
                    work_tbl.cmpyAuditorName,
                    work_tbl.cmpyAuditDate,
                    work_tbl.cmpyAuditUDIN,
                    client_tbl.clientName,
                    client_tbl.clientBussOrganisation,
                    client_tbl.clientBussOrganisationType,
                    client_tbl.clientDob,
                    client_tbl.clientBussIncorporationDate,
                    client_tbl.clientRegDocument,
                    user_tbl.userFullName,
                    due_date_master_tbl.finYear
                ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        $this->data['workArr']=$workArr;
        
        $workClientName="";
        $clientDobDoi="";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            
            /*
            if($clientBussOrgType==8)
                $workClientName=$workArr['clientName']." (".$workArr['clientBussOrganisation'].")";
            elseif($clientBussOrgType==9)
                $workClientName=$workArr['clientName'];
            else
                $workClientName=$workArr['clientBussOrganisation'];
            */
                
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
        }
        
        $workClientName = (!empty($workClientName)) ? $workClientName : "N/A";
        $clientDobDoi = (!empty($clientDobDoi)) ? $clientDobDoi : "N/A";
        
        $this->data['workClientName']=$workClientName;
        $this->data['clientDobDoi']=$clientDobDoi;

        $userCondtnArr['user_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userStaffType", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        $jnrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
        $jnrCondtnArr['work_junior_map_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_junior_map_tbl, $colNames="work_junior_map_tbl.fkWorkId, work_junior_map_tbl.fkUserId", $jnrCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $jnrList=$query['userData'];

        $this->data['jnrList']=$jnrList;

        $validationRulesArr['isDocRecvd']=['label' => 'Document Received', 'rules' => 'trim'];
        $validationRulesArr['docRecvdDate']=['label' => 'Document Received Date', 'rules' => 'trim'];
        $validationRulesArr['workDone']=['label' => '% Work Done', 'rules' => 'trim'];
        $validationRulesArr['signature_date']=['label' => 'Date Of Signature', 'rules' => 'trim'];
        $validationRulesArr['remark']=['label' => 'Remark', 'rules' => 'trim'];
        $validationRulesArr['seniorId']=['label' => 'Senior Allocation', 'rules' => 'trim'];
        $validationRulesArr['isUrgentWork']=['label' => 'Urgent Work', 'rules' => 'trim'];
        $validationRulesArr['set_prepared_by']=['label' => 'Set Prepared By', 'rules' => 'trim'];

        $isDocRecvdErr="";
        $docRecvdDateErr="";
        $workDoneErr="";
        $signatureDateErr="";
        $remarkErr="";
        $seniorIdErr="";
        $isUrgentWorkErr="";
        $setPreparedByErr="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $isDocRecvdErr=$this->validation->getError('isDocRecvd');
                $docRecvdDateErr=$this->validation->getError('docRecvdDate');
                $workDoneErr=$this->validation->getError('workDone');
                $signatureDateErr=$this->validation->getError('signature_date');
                $remarkErr=$this->validation->getError('remark');
                $seniorIdErr=$this->validation->getError('seniorId');
                $isUrgentWorkErr=$this->validation->getError('isUrgentWork');
                $setPreparedByErr=$this->validation->getError('set_prepared_by');
            }
            else
            {
                $this->db->transBegin();
                
                $workId=$this->request->getPost('workId');
                $stepData=$this->request->getPost('stepData');
                $isDocRecvd=$this->request->getPost('isDocRecvd');
                $docRecvdDate=$this->request->getPost('docRecvdDate');
                $workDone=$this->request->getPost('workDone');
                $signature_date=$this->request->getPost('signature_date');
                $auditCompletionDate=$this->request->getPost('auditCompletionDate');
                $udinDate=$this->request->getPost('udinDate');
                $udinNo=$this->request->getPost('udinNo');
                $remark=$this->request->getPost('remark');
                $juniorIdArr=$this->request->getPost('juniorId');
                $juniors=$this->request->getPost('juniors');
                $juniorIds=$this->request->getPost('juniorIds');
                $seniorId=$this->request->getPost('seniorId');
                $isUrgentWork=$this->request->getPost('isUrgentWork');
                $set_prepared_by=$this->request->getPost('setPreparedBy');
                $isBillingDone=$this->request->getPost('isBillingDone'); 
                $billNo=$this->request->getPost('billNo'); 
                $billDate=$this->request->getPost('billDate');
                $billAmt=$this->request->getPost('billAmt');
                $billingComment=$this->request->getPost('billingComment');
                $isReceiptDone=$this->request->getPost('isReceiptDone');
                $receiptDate=$this->request->getPost('receiptDate');
                $receiptAmt=$this->request->getPost('receiptAmt');
                $receiptComment=$this->request->getPost('receiptComment');
                $workPriority=$this->request->getPost('workPriority');
                $workPriorityColor=$this->request->getPost('workPriorityColor');
                $cmpyAuditAgmDate=$this->request->getPost('cmpyAuditAgmDate');
                $cmpyAuditorName=$this->request->getPost('cmpyAuditorName');
                $cmpyAuditDate=$this->request->getPost('cmpyAuditDate');
                $cmpyAuditUDIN=$this->request->getPost('cmpyAuditUDIN');
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
                                
                            $uploadPath2=$uploadPath1.'/company';

                            if(!is_dir($uploadPath2))
                                mkdir($uploadPath2, 0777, TRUE);
            
                            $ack_upload_file = $ackUploadFile->getRandomName();
                            $ackUploadFile->move($uploadPath2, $ack_upload_file);
                            
                            if(!empty($ackUploadFileHidden))
                            {
                                $delUploadFilePath=$uploadPath2."/".$ackUploadFileHidden;
                                unlink($delUploadFilePath);
                            }
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

                if($isDocRecvd==1)
                    $docRecvdDateVal=$docRecvdDate;
                else
                    $docRecvdDateVal="";

                $wkUpdateArr = [
                    'isDocRecvd'=>$isDocRecvd,
                    'docRecvdDate'=>$docRecvdDateVal,
                    'workDone'=>$workDone,
                    'signature_date'=>$signature_date,
                    'auditCompletionDate'=>$auditCompletionDate,
                    'udinDate'=>$udinDate,
                    'udinNo'=>$udinNo,
                    'remark'=>$remark,
                    'juniors'=>$juniors,
                    'seniorId'=>$seniorId,
                    'isUrgentWork'=>$isUrgentWork,
                    'set_prepared_by'=>$set_prepared_by,
                    'ackUploadFile'=>$ack_upload_file,
                    'isBillingDone'=>$isBillingDone,
                    'billNo'=>$billNo,
                    'billDate'=>$billDate,
                    'billAmt'=>$billAmt,
                    'billingComment'=>$billingComment,
                    'isReceiptDone'=>$isReceiptDone,
                    'receiptDate'=>$receiptDate,
                    'receiptAmt'=>$receiptAmt,
                    'receiptComment'=>$receiptComment,
                    'workPriority'=>$workPriority,
                    'workPriorityColor'=>$workPriorityColor,
                    'cmpyAuditAgmDate'=>$cmpyAuditAgmDate,
                    'cmpyAuditorName'=>$cmpyAuditorName,
                    'cmpyAuditDate'=>$cmpyAuditDate,
                    'cmpyAuditUDIN'=>$cmpyAuditUDIN,
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
        $this->data['signatureDateErr']=$signatureDateErr;
        $this->data['remarkErr']=$remarkErr;
        $this->data['seniorIdErr']=$seniorIdErr;
        $this->data['isUrgentWorkErr']=$isUrgentWorkErr;
        $this->data['setPreparedByErr']=$setPreparedByErr;

        return view('firm_panel/compliance/companies/audit_work_form', $this->data);
    }
    
    public function return_filed_register()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Companies Act - Returns Register";
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
        $workCondtnArr['act_tbl.act_id']=4;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=CMPY_RET_DDF_ARRAY;
        
        $workOrderByArr['work_tbl.eFillingDate']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, work_tbl.isScrutiny, work_tbl.totalIncome, work_tbl.refundDueVal, work_tbl.selfAssessmentTax, work_tbl.intiTotalIncome, work_tbl.intiRefundApproved, work_tbl.intiAddtnlTax, work_tbl.intiRemark, work_tbl.intiIsRectification, work_tbl.intiIsScrutiny, user_tbl.userFullName AS seniorName, work_tbl.workDone, work_tbl.eFillingDate, work_tbl.acknowledgmentNo, work_tbl.refundDate, work_tbl.totalIncome, work_tbl.selfAssessmentTax, work_tbl.refundDueVal, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_tbl.clientPanNumber, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        return view('firm_panel/compliance/companies/return_filed_register', $this->data);
    }
    
    public function master_details()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Company Master Details";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_tbl.clientBussOrganisationType']=1;
        
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType, client_tbl.clientRegDocument, client_tbl.clientBussIncorporationDate, client_group_tbl.client_group, client_group_tbl.client_group_number", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientList=$query['userData'];
        
        $this->data['clientList']=$clientList;

        return view('firm_panel/compliance/companies/master_details', $this->data);
    }
    
    public function edit_master_details($clientId)
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Company Master Details";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_tbl.clientBussOrganisationType']=1;
        
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType, client_tbl.clientRegDocument, client_tbl.clientBussIncorporationDate, client_tbl.clientBussRegisteredAddress, client_group_tbl.client_group, client_group_tbl.client_group_number", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $this->data['clientData']=$clientData;
        
        $cmpyAuthCapCondtn['fkClientId']=$clientId;
        $cmpyAuthCapCondtn['status']=1;
        
        $cmpyAuthCapData = $this->McmpyAuthCap->where($cmpyAuthCapCondtn)->findAll();
        
        $this->data['cmpyAuthCapData']=$cmpyAuthCapData;
        
        $cmpyIssueTypeCondtn['status']=1;
        
        $cmpyIssueType = $this->McmpyIssueType->where($cmpyIssueTypeCondtn)->findAll();
        
        $this->data['cmpyIssueType']=$cmpyIssueType;
        
        $cmpyIssueTypeArr = array();
        
        if(!empty($cmpyIssueType))
        {
            foreach($cmpyIssueType AS $e_data)
            {
                $cmpyIssueTypeArr[$e_data['cmpyIssueTypeId']]=$e_data['name'];
            }
        }
        
        $this->data['cmpyIssueTypeArr']=$cmpyIssueTypeArr;
        
        $cmpyIssuePaidCapCondtn['fkClientId']=$clientId;
        $cmpyIssuePaidCapCondtn['status']=1;
        
        $cmpyIssuePaidCapData = $this->McmpyIssuePaidCap->where($cmpyIssuePaidCapCondtn)->findAll();
        
        $this->data['cmpyIssuePaidCapData']=$cmpyIssuePaidCapData;
        
        $cmpyDirectorCondtn['fkClientId']=$clientId;
        $cmpyDirectorCondtn['status']=1;
        
        $cmpyDirectorData = $this->McmpyDirector->where($cmpyDirectorCondtn)->findAll();
        
        $this->data['cmpyDirectorData']=$cmpyDirectorData;
        
        $cmpyDividPaidCondtn['fkClientId']=$clientId;
        $cmpyDividPaidCondtn['status']=1;
        
        $cmpyDividPaidData = $this->McmpyDividPaid->where($cmpyDividPaidCondtn)->findAll();
        
        $this->data['cmpyDividPaidData']=$cmpyDividPaidData;

        // $fin_year_arr=explode("-", $this->sessDueDateYear);

        // $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        // $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        // $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        // $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.fkClientId']=$clientId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=4;
        
        $ddfIDArr = array_merge(CMPY_RET_DDF_ARRAY, CMPY_ADT_DDF_ARRAY);
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=$ddfIDArr;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('work_tbl.workId');
        
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl." AS prepared_user_tbl", "condtn"=>"prepared_user_tbl.userId=work_tbl.set_prepared_by AND prepared_user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
                    work_tbl.workId,
                    work_tbl.eFillingDate,
                    work_tbl.cmpyAgmDate,
                    work_tbl.cmpyReceiptNo,
                    work_tbl.cmpyReceiptAmt,
                    work_tbl.cmpyReceiptDate,
                    work_tbl.cmpyAuditAgmDate,
                    work_tbl.cmpyAuditorName,
                    work_tbl.cmpyAuditDate,
                    work_tbl.cmpyAuditUDIN,
                    prepared_user_tbl.userShortName AS setPreparedShortName,
                    due_date_master_tbl.due_date,
                    due_date_master_tbl.due_date_for,
                    due_date_master_tbl.finYear
                ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        $this->data['workDataArr']=$workDataArr;
        
        $cmpyDDFIDArr = array();
        
        if(!empty($workDataArr))
        {
            $cmpyDDFIDArr = array_unique(array_column($workDataArr, 'due_date_for'));
        }
        
        $this->data['cmpyDDFIDArr']=$cmpyDDFIDArr;

        return view('firm_panel/compliance/companies/edit_master_details', $this->data);
    }
    
    public function add_auth_cap()
	{
	    $this->db->transBegin();
	    
	    $fromDate=$this->request->getPost('fromDate');
	    $toDate=$this->request->getPost('toDate');
	    $amount=$this->request->getPost('amount');
	    $noOfShares=$this->request->getPost('noOfShares');
	    $stampDuty=$this->request->getPost('stampDuty');
	    $reslnDate=$this->request->getPost('reslnDate');
	    $filingDate=$this->request->getPost('filingDate');
	    $clientId=$this->request->getPost('clientId');
	    
	    $insertDataArr=[
            'fkClientId'        =>  $clientId,
            'fromDate'          =>  $fromDate,
            'toDate'            =>  $toDate,
            'amount'            =>  $amount,
            'noOfShares'        =>  $noOfShares,
            'stampDuty'         =>  $stampDuty,
            'reslnDate'         =>  $reslnDate,
            'filingDate'        =>  $filingDate,
            'status'            =>  1,
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        ];
	    
	    $this->McmpyAuthCap->save($insertDataArr);
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Authorised Capital not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Authorised Capital added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Details of Authorised Capital has been added successfully :)");
        }
        
        return redirect()->to('edit-company-master-details/'.$clientId);
	}
	
	public function edit_auth_cap()
	{
	    $this->db->transBegin();
	    
	    $cmpyAuthCapId=$this->request->getPost('cmpyAuthCapId');
	    $fromDate=$this->request->getPost('fromDate');
	    $toDate=$this->request->getPost('toDate');
	    $amount=$this->request->getPost('amount');
	    $noOfShares=$this->request->getPost('noOfShares');
	    $stampDuty=$this->request->getPost('stampDuty');
	    $reslnDate=$this->request->getPost('reslnDate');
	    $filingDate=$this->request->getPost('filingDate');
	    $clientId=$this->request->getPost('clientId');
	    
	    $insertDataArr=[
            'cmpyAuthCapId'     =>  $cmpyAuthCapId,
            'fromDate'          =>  $fromDate,
            'toDate'            =>  $toDate,
            'amount'            =>  $amount,
            'noOfShares'        =>  $noOfShares,
            'stampDuty'         =>  $stampDuty,
            'reslnDate'         =>  $reslnDate,
            'filingDate'        =>  $filingDate,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    $this->McmpyAuthCap->save($insertDataArr);
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Authorised Capital not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Authorised Capital updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Details of Authorised Capital has been updated successfully :)");
        }
        
        return redirect()->to('edit-company-master-details/'.$clientId);
	}
	
	public function delete_auth_cap()
	{
        $cmpyAuthCapId=$this->request->getPost('cmpyAuthCapId');
	    
	    $insertArr=[
            'cmpyAuthCapId'     => $cmpyAuthCapId,
            'status'            => 2,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    if($this->McmpyAuthCap->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Authorised Capital Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Details of Authorised Capital has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Authorised Capital not deleted :(");
	    }
	}
	
    public function add_issue_paid_cap()
	{
	    $this->db->transBegin();
	    
	    $issueType=$this->request->getPost('issueType');
	    $allotmentDate=$this->request->getPost('allotmentDate');
	    $totalNoOfShares=$this->request->getPost('totalNoOfShares');
	    $amount=$this->request->getPost('amount');
	    $cumulativeTotal=$this->request->getPost('cumulativeTotal');
	    $reslnDate=$this->request->getPost('reslnDate');
	    $filingDate=$this->request->getPost('filingDate');
	    $clientId=$this->request->getPost('clientId');
	    
	    $insertDataArr=[
            'fkClientId'        =>  $clientId,
            'issueType'         =>  $issueType,
            'allotmentDate'     =>  $allotmentDate,
            'totalNoOfShares'   =>  $totalNoOfShares,
            'amount'            =>  $amount,
            'cumulativeTotal'   =>  $cumulativeTotal,
            'reslnDate'         =>  $reslnDate,
            'filingDate'        =>  $filingDate,
            'status'            =>  1,
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        ];
	    
	    $this->McmpyIssuePaidCap->save($insertDataArr);
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Issued/Paid-Up Capital not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Issued/Paid-Up Capital added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Details of Issued/Paid-Up Capital has been added successfully :)");
        }
        
        return redirect()->to('edit-company-master-details/'.$clientId);
	}
	
	public function edit_issue_paid_cap()
	{
	    $this->db->transBegin();
	    
	    $cmpyIssuePaidCapId=$this->request->getPost('cmpyIssuePaidCapId');
	    $issueType=$this->request->getPost('issueType');
	    $allotmentDate=$this->request->getPost('allotmentDate');
	    $totalNoOfShares=$this->request->getPost('totalNoOfShares');
	    $amount=$this->request->getPost('amount');
	    $cumulativeTotal=$this->request->getPost('cumulativeTotal');
	    $reslnDate=$this->request->getPost('reslnDate');
	    $filingDate=$this->request->getPost('filingDate');
	    $clientId=$this->request->getPost('clientId');
	    
	    $insertDataArr=[
            'cmpyIssuePaidCapId'    =>  $cmpyIssuePaidCapId,
            'issueType'             =>  $issueType,
            'allotmentDate'         =>  $allotmentDate,
            'totalNoOfShares'       =>  $totalNoOfShares,
            'amount'                =>  $amount,
            'cumulativeTotal'       =>  $cumulativeTotal,
            'reslnDate'             =>  $reslnDate,
            'filingDate'            =>  $filingDate,
            'updatedBy'             => $this->adminId,
            'updatedDatetime'       => $this->currTimeStamp
        ];
	    
	    $this->McmpyIssuePaidCap->save($insertDataArr);
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Issued/Paid-Up Capital not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Issued/Paid-Up Capital updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Details of Issued/Paid-Up Capital has been updated successfully :)");
        }
        
        return redirect()->to('edit-company-master-details/'.$clientId);
	}
	
	public function delete_issue_paid_cap()
	{
        $cmpyIssuePaidCapId=$this->request->getPost('cmpyIssuePaidCapId');
	    
	    $insertArr=[
            'cmpyIssuePaidCapId'    => $cmpyIssuePaidCapId,
            'status'                => 2,
            'updatedBy'             => $this->adminId,
            'updatedDatetime'       => $this->currTimeStamp
        ];
	    
	    if($this->McmpyIssuePaidCap->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Issued/Paid-Up Capital Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Details of Issued/Paid-Up Capital has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Issued/Paid-Up Capital not deleted :(");
	    }
	}
	
    public function add_company_director()
	{
	    $this->db->transBegin();
	    
	    $directorName=$this->request->getPost('directorName');
	    $apptDate=$this->request->getPost('apptDate');
	    $retrmtDate=$this->request->getPost('retrmtDate');
	    $reslnDate=$this->request->getPost('reslnDate');
	    $filingDate=$this->request->getPost('filingDate');
	    $clientId=$this->request->getPost('clientId');
	    
	    $insertDataArr=[
            'fkClientId'        =>  $clientId,
            'directorName'      =>  $directorName,
            'apptDate'          =>  $apptDate,
            'retrmtDate'        =>  $retrmtDate,
            'reslnDate'         =>  $reslnDate,
            'filingDate'        =>  $filingDate,
            'status'            =>  1,
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        ];
	    
	    $this->McmpyDirector->save($insertDataArr);
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Director not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Director added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Details of Director has been added successfully :)");
        }
        
        return redirect()->to('edit-company-master-details/'.$clientId);
	}
	
	public function edit_company_director()
	{
	    $this->db->transBegin();
	    
	    $cmpyDirectorId=$this->request->getPost('cmpyDirectorId');
	    $directorName=$this->request->getPost('directorName');
	    $apptDate=$this->request->getPost('apptDate');
	    $retrmtDate=$this->request->getPost('retrmtDate');
	    $reslnDate=$this->request->getPost('reslnDate');
	    $filingDate=$this->request->getPost('filingDate');
	    $clientId=$this->request->getPost('clientId');
	    
	    $insertDataArr=[
            'cmpyDirectorId'    =>  $cmpyDirectorId,
            'directorName'      =>  $directorName,
            'apptDate'          =>  $apptDate,
            'retrmtDate'        =>  $retrmtDate,
            'reslnDate'         =>  $reslnDate,
            'filingDate'        =>  $filingDate,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    $this->McmpyDirector->save($insertDataArr);
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Director not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Director updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Details of Director has been updated successfully :)");
        }
        
        return redirect()->to('edit-company-master-details/'.$clientId);
	}
	
	public function delete_company_director()
	{
        $cmpyDirectorId=$this->request->getPost('cmpyDirectorId');
	    
	    $insertArr=[
            'cmpyDirectorId'    => $cmpyDirectorId,
            'status'            => 2,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    if($this->McmpyDirector->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Director Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Details of Director has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Director not deleted :(");
	    }
	}
	
    public function add_dividend_paid()
	{
	    $this->db->transBegin();
	    
	    $acctYear=$this->request->getPost('acctYear');
	    $apptDate=$this->request->getPost('apptDate');
	    $agmDate=$this->request->getPost('agmDate');
	    $shareCapital=$this->request->getPost('shareCapital');
	    $rate=$this->request->getPost('rate');
	    $dividendAmt=$this->request->getPost('dividendAmt');
	    $pmtDate=$this->request->getPost('pmtDate');
	    $clientId=$this->request->getPost('clientId');
	    
	    $insertDataArr=[
            'fkClientId'        =>  $clientId,
            'acctYear'          =>  $acctYear,
            'agmDate'           =>  $agmDate,
            'shareCapital'      =>  $shareCapital,
            'rate'              =>  $rate,
            'dividendAmt'       =>  $dividendAmt,
            'pmtDate'           =>  $pmtDate,
            'status'            =>  1,
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        ];
	    
	    $this->McmpyDividPaid->save($insertDataArr);
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Dividend not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Dividend added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Details of Dividend has been added successfully :)");
        }
        
        return redirect()->to('edit-company-master-details/'.$clientId);
	}
	
	public function edit_dividend_paid()
	{
	    $this->db->transBegin();
	    
	    $cmpyDividPaidId=$this->request->getPost('cmpyDividPaidId');
	    $acctYear=$this->request->getPost('acctYear');
	    $apptDate=$this->request->getPost('apptDate');
	    $agmDate=$this->request->getPost('agmDate');
	    $shareCapital=$this->request->getPost('shareCapital');
	    $rate=$this->request->getPost('rate');
	    $dividendAmt=$this->request->getPost('dividendAmt');
	    $pmtDate=$this->request->getPost('pmtDate');
	    $clientId=$this->request->getPost('clientId');
	    
	    $insertDataArr=[
            'cmpyDividPaidId'   =>  $cmpyDividPaidId,
            'acctYear'          =>  $acctYear,
            'agmDate'           =>  $agmDate,
            'shareCapital'      =>  $shareCapital,
            'rate'              =>  $rate,
            'dividendAmt'       =>  $dividendAmt,
            'pmtDate'           =>  $pmtDate,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    $this->McmpyDividPaid->save($insertDataArr);
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Dividend not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Dividend updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Details of Dividend has been updated successfully :)");
        }
        
        return redirect()->to('edit-company-master-details/'.$clientId);
	}
	
	public function delete_dividend_paid()
	{
        $cmpyDividPaidId=$this->request->getPost('cmpyDividPaidId');
	    
	    $insertArr=[
            'cmpyDividPaidId'   => $cmpyDividPaidId,
            'status'            => 2,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    if($this->McmpyDividPaid->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Details of Dividend Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Details of Dividend has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Something went wrong!!, Details of Dividend not deleted :(");
	    }
	}
}