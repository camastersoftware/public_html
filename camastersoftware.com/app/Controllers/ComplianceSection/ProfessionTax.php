<?php namespace App\Controllers\ComplianceSection;
use \App\Controllers\BaseController;

class ProfessionTax extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Profession Tax";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Muser = new \App\Models\Muser();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->MpaymentModes = new \App\Models\MpaymentModes();
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
        $this->payment_mode_tbl=$tableArr['payment_mode_tbl'];
        $this->refund_tbl=$tableArr['refund_tbl'];
        $this->rectification_tbl=$tableArr['rectification_tbl'];
        $this->periodicity_tbl=$tableArr['periodicity_tbl'];
        
        $currMth=date('n');
        $this->currentMth=date('n');
        $this->currentYear=date('Y');
        
        $this->data['currMth']=$currMth;
    }
    
    public function enrol_payments()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Enrolment - Payments";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=PT_ENROL_PMT_DDF_ARRAY;
        
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
        $workCondtnArr['act_tbl.act_id']=7;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->payment_mode_tbl, "condtn"=>"payment_mode_tbl.id=work_tbl.pt_enrol_pmt_mode", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=6 AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.workCode,
            work_tbl.juniors,
            user_tbl.userShortName AS seniorName,
            work_tbl.pt_enrol_from,
            work_tbl.pt_enrol_to,
            work_tbl.pt_enrol_prof_tax_pmt,
            work_tbl.pt_enrol_amt_paid,
            work_tbl.pt_enrol_paid_on,
            payment_mode_tbl.name AS pt_enrol_pmt_mode,
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
            client_group_tbl.client_group_number,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            client_document_map_tbl.client_document_number
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        $this->data['workDataArr']=$workDataArr;

        $pt_enrol_prof_tax_pmt_col = array();

        if(!empty($workDataArr)){
            $pt_enrol_prof_tax_pmt_col = array_unique(array_column($workDataArr, "pt_enrol_prof_tax_pmt"));
        }

        $this->data['pt_enrol_prof_tax_pmt_col']=$pt_enrol_prof_tax_pmt_col;
        
        return view('firm_panel/compliance/profession_tax/enrol_payments', $this->data);
    }
    
    public function reg_payments()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Registration - Payments";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=PT_REG_PMT_DDF_ARRAY;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=7;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workGroupByArr=array('act_due_month', 'due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->payment_mode_tbl, "condtn"=>"payment_mode_tbl.id=work_tbl.pt_enrol_pmt_mode", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=7 AND client_document_map_tbl.status=1", "type"=>"left");
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
            work_tbl.workCode,
            work_tbl.fk_due_date_id,
            work_tbl.isDocRecvd,
            work_tbl.isUrgentWork,
            work_tbl.juniors,
            work_tbl.isBillingDone,
            work_tbl.isReceiptDone,
            work_tbl.billNo,
            work_tbl.eFillingDate,
            work_tbl.billDate,
            work_tbl.billAmt,
            work_tbl.receiptDate,
            work_tbl.receiptAmt,
            work_tbl.billingComment,
            work_tbl.receiptComment,
            work_tbl.workDone,
            work_tbl.verificationDate,
            work_tbl.set_prepared_by,
            work_tbl.workPriority,
            work_tbl.workPriorityColor,
            work_tbl.signature_date,
            work_tbl.auditCompletionDate,
            work_tbl.udinDate,
            work_tbl.pt_enrol_amt_paid,
            work_tbl.pt_enrol_paid_on,
            payment_mode_tbl.name AS pt_enrol_pmt_mode,
            user_tbl.userShortName AS seniorName,
            prepared_user_tbl.userShortName AS setPreparedShortName,
            due_date_master_tbl.*,
            due_date_master_tbl.due_date_id,
            due_date_master_tbl.due_act,
            due_date_for_tbl.act_option_name AS act_option_name1,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            ext_due_date_master_tbl.extended_date,
            act_tbl.act_name,
            organisation_type_tbl.organisation_type_id AS tax_payer_id,
            organisation_type_tbl.organisation_type_name AS act_option_name2,
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientTitle,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            org_type_tbl.organisation_type_id AS client_org_id,
            org_type_tbl.organisation_type_name AS client_org_name,
            org_type_tbl.shortName AS client_org_short_name,
            client_document_map_tbl.client_document_number
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
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
        
        $ddfCondtnArr['act_option_map_tbl.status']="1";
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="7";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=PT_REG_PMT_DDF_ARRAY;
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        return view('firm_panel/compliance/profession_tax/reg_payments', $this->data);
    }
    
    public function manage_enrol_payments($workId)
    {
        // dd($workId);
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Manage Profession Tax - Enrolment - Payments";
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
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.juniors,
            work_tbl.seniorId,
            work_tbl.pt_enrol_prof_tax_pmt,
            work_tbl.pt_enrol_prof_tax_pmt_from,
            work_tbl.pt_enrol_prof_tax_pmt_to,
            work_tbl.pt_enrol_amt_paid,
            work_tbl.pt_enrol_paid_on,
            work_tbl.pt_enrol_pmt_mode,
            work_tbl.workRemark,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        $this->data['workArr']=$workArr;
        
        $workClientName="";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            
            if($clientBussOrgType==8)
                $workClientName=$workArr['clientName']." (".$workArr['clientBussOrganisation'].")";
            elseif($clientBussOrgType==9 || $clientBussOrgType==22 || $clientBussOrgType==23)
                $workClientName=$workArr['clientName'];
            else
                $workClientName=$workArr['clientBussOrganisation'];
        }
        
        $this->data['workClientName']=$workClientName;

        $userCondtnArr['user_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userStaffType", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        $jnrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
        $jnrCondtnArr['work_junior_map_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_junior_map_tbl, $colNames="work_junior_map_tbl.fkWorkId, work_junior_map_tbl.fkUserId", $jnrCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $jnrList=$query['userData'];

        $this->data['jnrList']=$jnrList;
        
        $pmtModes=$this->MpaymentModes->where('status', 1)
                        ->findAll();

        $this->data['pmtModes']=$pmtModes;
        
        return view('firm_panel/compliance/profession_tax/manage_enrol_payments', $this->data);
    }
    
    public function update_enrol_payments()
    {
        $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $juniorIdArr=$this->request->getPost('juniorId');
        $juniors=$this->request->getPost('juniors');
        $juniorIds=$this->request->getPost('juniorIds');
        $seniorId=$this->request->getPost('seniorId');
        $pt_enrol_prof_tax_pmt=$this->request->getPost('pt_enrol_prof_tax_pmt');
        $pt_enrol_prof_tax_pmt_from=$this->request->getPost('pt_enrol_prof_tax_pmt_from');
        $pt_enrol_prof_tax_pmt_to=$this->request->getPost('pt_enrol_prof_tax_pmt_to');
        $pt_enrol_amt_paid=$this->request->getPost('pt_enrol_amt_paid');
        $pt_enrol_paid_on=$this->request->getPost('pt_enrol_paid_on');
        $pt_enrol_pmt_mode=$this->request->getPost('pt_enrol_pmt_mode');
        $workRemark=$this->request->getPost('workRemark');
        
        $wkUpdateArr = [
            'juniors'=>$juniors,
            'seniorId'=>$seniorId,
            'pt_enrol_prof_tax_pmt'=>$pt_enrol_prof_tax_pmt,
            'pt_enrol_prof_tax_pmt_from'=>$pt_enrol_prof_tax_pmt_from,
            'pt_enrol_prof_tax_pmt_to'=>$pt_enrol_prof_tax_pmt_to,
            'pt_enrol_amt_paid'=>$pt_enrol_amt_paid,
            'pt_enrol_paid_on'=>$pt_enrol_paid_on,
            'pt_enrol_pmt_mode'=>$pt_enrol_pmt_mode,
            'workRemark'=>$workRemark,
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

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Profession Tax Enrolment not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Profession Tax Enrolment updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Profession Tax Enrolment updated successfully :)");
        }
        
        return redirect()->route('pt-enrol-payments');
    }
    
    public function enrol_ledger()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Enrolment - Ledger";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=PT_ENROL_PMT_DDF_ARRAY;
        
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
        $workCondtnArr['act_tbl.act_id']=7;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->payment_mode_tbl, "condtn"=>"payment_mode_tbl.id=work_tbl.pt_enrol_pmt_mode", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=6 AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.workCode,
            work_tbl.juniors,
            user_tbl.userShortName AS seniorName,
            work_tbl.pt_enrol_from,
            work_tbl.pt_enrol_to,
            work_tbl.pt_enrol_amt_paid,
            work_tbl.pt_enrol_paid_on,
            payment_mode_tbl.name AS pt_enrol_pmt_mode,
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
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            client_document_map_tbl.client_document_number
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDataArr=$query['userData'];
        
        $this->data['clientDataArr']=$clientDataArr;
        
        return view('firm_panel/compliance/profession_tax/enrol_ledger', $this->data);
    }
    
    public function enrol_ledger_client($clientId)
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Enrolment - Ledger";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']="1";
        
        $clientJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=6 AND client_document_map_tbl.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, organisation_type_tbl.shortName AS client_org_short_name, client_document_map_tbl.client_document_number", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $this->data['clientData']=$clientData;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=PT_ENROL_PMT_DDF_ARRAY;
        
        // $fin_year_arr=explode("-", $this->sessDueDateYear);

        // $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        // $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        // $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        // $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['client_tbl.clientId']=$clientId;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=7;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('work_tbl.workId');
        
        $workJoinArr[]=array("tbl"=>$this->payment_mode_tbl, "condtn"=>"payment_mode_tbl.id=work_tbl.pt_enrol_pmt_mode", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=6 AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.pt_enrol_from,
            work_tbl.pt_enrol_to,
            work_tbl.pt_enrol_amt_paid,
            work_tbl.pt_enrol_paid_on,
            work_tbl.workRemark,
            payment_mode_tbl.name AS pt_enrol_pmt_mode,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            ext_due_date_master_tbl.extended_date,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            client_document_map_tbl.client_document_number
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDataArr=$query['userData'];
        
        $this->data['clientDataArr']=$clientDataArr;
        
        return view('firm_panel/compliance/profession_tax/enrol_ledger_client', $this->data);
    }
    
    public function reg_returns()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Registration - Returns";
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
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=PT_REG_RET_DDF_ARRAY;
            
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
        $workCondtnArr['act_tbl.act_id']=7;
        
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
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="7";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=PT_REG_RET_DDF_ARRAY;
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        return view('firm_panel/compliance/profession_tax/reg_returns', $this->data);
    }
    
    public function reg_work_form($workId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Registration - Work Details";
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
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType,
            client_tbl.clientPanNumber,
            client_tbl.clientDob,
            client_tbl.clientBussIncorporationDate,
            user_tbl.userFullName,
            refund_tbl.refundId,
            refund_tbl.totalIncome,
            refund_tbl.refundClaimed,
            work_tbl.pt_enrol_amt_paid,
            work_tbl.pt_enrol_paid_on,
            work_tbl.pt_enrol_pmt_mode,
            work_tbl.workRemark,
            due_date_master_tbl.finYear
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        $this->data['workArr']=$workArr;
        
        $clientPanNo="N/A";
        $asmtYear="N/A";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            
            // if($clientBussOrgType==8)
            //     $workClientName=$workArr['clientName']." (".$workArr['clientBussOrganisation'].")";
                
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
        
        $pmtModes=$this->MpaymentModes->where('status', 1)
                        ->findAll();

        $this->data['pmtModes']=$pmtModes;

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
                $workRemark=$this->request->getPost('workRemark');
                
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
                    'workRemark'=>$workRemark,
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
                
                /*
                $rectUpdateArr = [
                    'status'=>2,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
    
                $rectCondtnArr['rectification_tbl.fkWorkId']=$workId;
    
                $query=$this->Mcommon->updateData($tableName=$this->rectification_tbl, $rectUpdateArr, $rectCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                $rectInsertArr=array();

                if(!empty($rectLetterNo))
                {
                    foreach($rectLetterNo AS $k_rect=>$e_rect)
                    {
                        $rectInsertArr[] = [
                            'fkWorkId'=>$workId,
                            'rectLetterNo'=>$e_rect,
                            'rectDate'=>$rectDate[$k_rect],
                            'rectFiledDate'=>$rectFiledDate[$k_rect],
                            'rectRemark'=>$rectRemark[$k_rect],
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        ];
                    }

                    $this->Mcommon->insert($tableName=$this->rectification_tbl, $rectInsertArr, $returnType="");
                }
                */
                
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
                    // $updateIntiArr=array(
                    //     'refundId'          =>  $refundId, 
                    //     'fkWorkId'          =>  $workId,
                    //     'refundClaimed'     =>  $refundDue,
                    //     'totalIncome'       =>  $totalIncome,
                    //     'status'            =>  1,
                    //     'createdBy'         =>  $this->adminId,
                    //     'createdDatetime'   =>  $this->currTimeStamp,
                    //     'updatedBy'         =>  $this->adminId,
                    //     'updatedDatetime'   =>  $this->currTimeStamp
                    // );
                    
                    // $this->Mrefund->save($updateIntiArr);
                    
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
                    
                    // return redirect()->to(base_url('admin/income_tax/work_form/'.$workId));
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
                    
                    // return redirect()->to(base_url('admin/admin/inc_tax_returns'));
                }

                // return redirect()->route('admin/income_tax/work_form/'.$workId);
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

        return view('firm_panel/compliance/profession_tax/reg_work_form', $this->data);
    }
    
    public function reg_payments_old()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Registration - Payments";
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
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=PT_REG_PMT_DDF_ARRAY;
            
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
        $workCondtnArr['act_tbl.act_id']=7;
        
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
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="7";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=PT_REG_PMT_DDF_ARRAY;
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;
        
        return view('firm_panel/compliance/profession_tax/reg_payments', $this->data);
    }
    
    public function manage_reg_payments($workId)
    {
        // dd($workId);
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Manage Profession Tax - Registration - Payments";
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
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.juniors,
            work_tbl.seniorId,
            work_tbl.pt_enrol_amt_paid,
            work_tbl.pt_enrol_paid_on,
            work_tbl.pt_enrol_pmt_mode,
            work_tbl.workRemark,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        $this->data['workArr']=$workArr;
        
        $workClientName="";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            
            if($clientBussOrgType==8)
                $workClientName=$workArr['clientName']." (".$workArr['clientBussOrganisation'].")";
            elseif($clientBussOrgType==9 || $clientBussOrgType==22 || $clientBussOrgType==23)
                $workClientName=$workArr['clientName'];
            else
                $workClientName=$workArr['clientBussOrganisation'];
        }
        
        $this->data['workClientName']=$workClientName;

        $userCondtnArr['user_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userStaffType", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        $jnrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
        $jnrCondtnArr['work_junior_map_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_junior_map_tbl, $colNames="work_junior_map_tbl.fkWorkId, work_junior_map_tbl.fkUserId", $jnrCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $jnrList=$query['userData'];

        $this->data['jnrList']=$jnrList;
        
        $pmtModes=$this->MpaymentModes->where('status', 1)
                        ->findAll();

        $this->data['pmtModes']=$pmtModes;
        
        return view('firm_panel/compliance/profession_tax/manage_reg_payments', $this->data);
    }
    
    public function update_reg_payments()
    {
        $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $juniorIdArr=$this->request->getPost('juniorId');
        $juniors=$this->request->getPost('juniors');
        $juniorIds=$this->request->getPost('juniorIds');
        $seniorId=$this->request->getPost('seniorId');
        $pt_enrol_amt_paid=$this->request->getPost('pt_enrol_amt_paid');
        $pt_enrol_paid_on=$this->request->getPost('pt_enrol_paid_on');
        $pt_enrol_pmt_mode=$this->request->getPost('pt_enrol_pmt_mode');
        $workRemark=$this->request->getPost('workRemark');
        
        $wkUpdateArr = [
            'juniors'=>$juniors,
            'seniorId'=>$seniorId,
            'pt_enrol_amt_paid'=>$pt_enrol_amt_paid,
            'pt_enrol_paid_on'=>$pt_enrol_paid_on,
            'pt_enrol_pmt_mode'=>$pt_enrol_pmt_mode,
            'workRemark'=>$workRemark,
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

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Profession Tax Payment details not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Profession Tax Payment details";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Profession Tax Payment details updated successfully :)");
        }
        
        return redirect()->route('pt-reg-tax-payments');
    }
    
    public function reg_register_menu()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Registration - Registers";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        return view('firm_panel/compliance/profession_tax/reg_register_menu', $this->data);
    }
    
    public function reg_register()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Registration - Registers";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $returnsDDFs = PT_REG_RET_DDF_ARRAY;
        $paymentsDDFs = PT_REG_PMT_DDF_ARRAY;
        
        $ddfArr = array_merge($returnsDDFs, $paymentsDDFs);
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=$ddfArr;
        
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
        $workCondtnArr['act_tbl.act_id']=7;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->payment_mode_tbl, "condtn"=>"payment_mode_tbl.id=work_tbl.pt_enrol_pmt_mode", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=6 AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.workCode,
            work_tbl.juniors,
            user_tbl.userShortName AS seniorName,
            work_tbl.pt_enrol_amt_paid,
            work_tbl.pt_enrol_paid_on,
            work_tbl.eFillingDate,
            work_tbl.workRemark,
            payment_mode_tbl.name AS pt_enrol_pmt_mode,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.finYear,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.applicable_form,
            ext_due_date_master_tbl.extended_date,
            due_date_for_tbl.act_option_name AS act_option_name1,
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            client_document_map_tbl.client_document_number,
            applicable_form_tbl.act_option_name AS applicable_form_name
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDataArr=$query['userData'];
        
        $this->data['clientDataArr']=$clientDataArr;
        
        return view('firm_panel/compliance/profession_tax/reg_register', $this->data);
    }
    
    public function reg_ledger()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Registration - Assessee Ledger";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $returnsDDFs = PT_REG_RET_DDF_ARRAY;
        $paymentsDDFs = PT_REG_PMT_DDF_ARRAY;
        
        $ddfArr = array_merge($returnsDDFs, $paymentsDDFs);
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=$ddfArr;
        
        // $fin_year_arr=explode("-", $this->sessDueDateYear);

        // $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        // $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        // $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        // $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=7;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->payment_mode_tbl, "condtn"=>"payment_mode_tbl.id=work_tbl.pt_enrol_pmt_mode", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=6 AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.workCode,
            work_tbl.juniors,
            user_tbl.userShortName AS seniorName,
            work_tbl.pt_enrol_amt_paid,
            work_tbl.pt_enrol_paid_on,
            payment_mode_tbl.name AS pt_enrol_pmt_mode,
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
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            client_document_map_tbl.client_document_number
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDataArr=$query['userData'];
        
        $this->data['clientDataArr']=$clientDataArr;
        
        return view('firm_panel/compliance/profession_tax/reg_ledger', $this->data);
    }
    
    public function reg_ledger_client($clientId)
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Registration - Assessee Ledger";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']="1";
        
        $clientJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=6 AND client_document_map_tbl.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, organisation_type_tbl.shortName AS client_org_short_name, client_document_map_tbl.client_document_number", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $this->data['clientData']=$clientData;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $returnsDDFs = PT_REG_RET_DDF_ARRAY;
        $paymentsDDFs = PT_REG_PMT_DDF_ARRAY;
        
        $ddfArr = array_merge($returnsDDFs, $paymentsDDFs);
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=$ddfArr;
        
        $workCondtnArr['client_tbl.clientId']=$clientId;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=7;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('work_tbl.workId');
        
        $workJoinArr[]=array("tbl"=>$this->payment_mode_tbl, "condtn"=>"payment_mode_tbl.id=work_tbl.pt_enrol_pmt_mode", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id AND client_document_map_tbl.fk_client_document_id=6 AND client_document_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.pt_enrol_amt_paid,
            work_tbl.pt_enrol_paid_on,
            work_tbl.workRemark,
            work_tbl.eFillingDate,
            payment_mode_tbl.name AS pt_enrol_pmt_mode,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.applicable_form,
            ext_due_date_master_tbl.extended_date,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            client_document_map_tbl.client_document_number,
            applicable_form_tbl.act_option_name AS applicable_form_name
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDataArr=$query['userData'];
        
        $this->data['clientDataArr']=$clientDataArr;
        
        return view('firm_panel/compliance/profession_tax/reg_ledger_client', $this->data);
    }
    
    public function reg_mis_report()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Profession Tax - MIS Report";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        $ddYrVal = $this->sessDueDateYear;
        $actVal = 7;
        
        $ddYrArr=explode("-", $ddYrVal);

        $fromDueDate=date("Y-m-d", strtotime($ddYrArr[0]."-04-01"));
        $toDueDate=date("Y-m-d", strtotime("20".$ddYrArr[1]."-03-31"));
        
        $ddCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDueDate;
        $ddCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDueDate;
        
        $ddWhereInArray['due_date_for_tbl.act_option_map_id']=PT_REG_RET_DDF_ARRAY;
        
        $ddCondtnArr['due_date_master_tbl.due_state']=12;
        $ddCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $ddCondtnArr['due_date_master_tbl.status']=1;

        $ddGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');
        
        $ddJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $ddJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            due_date_master_tbl.periodicity,
            ext_due_date_master_tbl.extended_date,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $ddCondtnArr, $likeCondtnArr=array(), $ddJoinArr, $singleRow=FALSE, $ddOrderByArr=array(), $ddGroupByArr, $ddWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $mthDueDateArr=array();
        
        if(!empty($dueDatesArr))
        {
            foreach($dueDatesArr AS $e_dd)
            {
                $prdCityId=$e_dd['periodicity'];
                $mthDueDateArr[$e_dd['act_due_month']][$e_dd['extended_date']."_".$prdCityId]=$e_dd['extended_date'];
            }
        }
        
        $this->data['mthDueDateArr']=$mthDueDateArr;

        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDueDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDueDate;
        
        $taxWhereInArray['due_date_for_tbl.act_option_map_id']=PT_REG_RET_DDF_ARRAY;
        
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['client_tbl.status']="1";
        $taxCondtnArr['work_tbl.status']="1";

        $taxOrderByArr['client_tbl.clientName']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id', 'client_tbl.clientId');
        
        $taxJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            periodicity_tbl.periodicity_id,
            periodicity_tbl.periodcity_short_name,
            due_date_master_tbl.*,
            due_date_master_tbl.due_date_for,
            ext_due_date_master_tbl.extended_date,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            due_date_for_tbl.act_option_name AS due_date_for_name,
            due_date_for_tbl.sortBy AS due_date_for_sort,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            work_tbl.eFillingDate
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $taxWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientFileArr=$query['userData'];
        
        $clientDataArr=array();
        $clientFilingDate=array();
        
        if(!empty($clientFileArr))
        {
            foreach($clientFileArr AS $e_cli)
            {
                $clientDataArr[$e_cli['clientId']]=$e_cli;
                $clientFilingDate[$e_cli['act_due_month']][$e_cli['clientId']]=$e_cli['eFillingDate'];
            }
        }
        
        $this->data['clientDataArr']=$clientDataArr;
        $this->data['clientFilingDate']=$clientFilingDate;

        return view('firm_panel/compliance/profession_tax/reg_mis_report', $this->data);
	}
}