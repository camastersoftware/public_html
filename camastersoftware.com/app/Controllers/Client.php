<?php
namespace App\Controllers;

class Client extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Client";
        
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Muser = new \App\Models\Muser();
        $this->Msalutation = new \App\Models\Msalutation();
        $this->MorganisationType = new \App\Models\MorganisationType();
        $this->Mdocument = new \App\Models\Mdocument();
        $this->Mact = new \App\Models\Mact();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->session = \Config\Services::session();

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
        $this->client_partner_tbl=$tableArr['client_partner_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->non_regular_due_date_tbl=$tableArr['non_regular_due_date_tbl'];

        $this->sessCaFirmId=$this->session->get('caFirmId');

        $documentsPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/documents');

        $this->data['documentsPath']=$documentsPath;
    }

	public function index()
	{
	    ini_set('memory_limit', '-1');
	    
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Client List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        // $clientCondtnArr['client_tbl.status']="1";

        // $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        // $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        // $getClientList=$query['userData'];

        // $this->data['getClientList']=$getClientList;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        $clientOrderByArr['client_tbl.clientId']="ASC";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_group_tbl.client_group_cost", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_tbl.isOldClient, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, user_tbl.userShortName", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;

        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->orderBy('client_group_tbl.client_group', 'ASC')
                        ->findAll();

        $this->data['groupList']=$groupList;

        $groupCatList=$this->Mgroup_cat->where('group_category_tbl.status', 1)
                                    ->findAll();

        $this->data['groupCatList']=$groupCatList;

        $userList=$this->Muser->where('user_tbl.isCostCenter', 1)
                        ->where('user_tbl.status', 1)
                        ->findAll();

        $this->data['userList']=$userList;

        $salutationList=$this->Msalutation->where('salutation_tbl.status', 1)
                        ->findAll();

        $this->data['salutationList']=$salutationList;

        $organisationTypes=$this->MorganisationType->where('organisation_type_tbl.status', 1)
                        ->orderBy('organisation_type_tbl.seqNo', "ASC")
                        ->findAll();

        $this->data['organisationTypes']=$organisationTypes;

        $documentList=$this->Mdocument->where('client_document_tbl.status', 1)
                        ->orderBy('client_document_tbl.seqNo', "ASC")
                        ->findAll();

        $this->data['documentList']=$documentList;

        $actList=$this->Mact->where('act_tbl.status', 1)
                        ->findAll();

        $this->data['actList']=$actList;

        return view('firm_panel/client/clients', $this->data);
	}
	
	public function create_client()
	{
	    ini_set('memory_limit', '-1');
	    
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Create Client";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_group_tbl.client_group_cost", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_tbl.isOldClient, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, user_tbl.userShortName", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;

        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->orderBy('client_group_tbl.client_group', 'ASC')
                        ->findAll();

        $this->data['groupList']=$groupList;

        $groupCatList=$this->Mgroup_cat->where('group_category_tbl.status', 1)
                                    ->findAll();

        $this->data['groupCatList']=$groupCatList;

        $userList=$this->Muser->where('user_tbl.isCostCenter', 1)
                        ->where('user_tbl.status', 1)
                        ->findAll();

        $this->data['userList']=$userList;

        $salutationList=$this->Msalutation->where('salutation_tbl.status', 1)
                        ->findAll();

        $this->data['salutationList']=$salutationList;

        $organisationTypes=$this->MorganisationType->where('organisation_type_tbl.status', 1)
                        ->orderBy('organisation_type_tbl.seqNo', "ASC")
                        ->findAll();

        $this->data['organisationTypes']=$organisationTypes;

        $documentList=$this->Mdocument->where('client_document_tbl.status', 1)
                        ->orderBy('client_document_tbl.seqNo', "ASC")
                        ->findAll();

        $this->data['documentList']=$documentList;

        $actList=$this->Mact->where('act_tbl.status', 1)
                        ->orderBy('act_tbl.sortBy', "ASC")
                        ->findAll();

        $this->data['actList']=$actList;

        return view('firm_panel/client/create_client', $this->data);
	}
	
	public function edit_client($clientId)
    {
        ini_set('memory_limit', '-1');

        $this->data['clientId']=$clientId;

        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full', 'ckeditor');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Edit Client";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $backTo=$this->request->getGet('backTo');
        
        if($backTo=="oldmaster")
        {
            $backUrl=base_url('getMasterOldClientData');
        }
        else
        {
            $backUrl=base_url('clients');
        }
        
        $this->data['backUrl']=$backUrl;

        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.*, client_tbl.clientPanNumber, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $clientBussOrganisationType="";
        
        if(!empty($clientData))
            $clientBussOrganisationType=$clientData['clientBussOrganisationType'];
            
        $this->data['clientData']=$clientData;
        
        $this->data['clientBussOrganisationType']=$clientBussOrganisationType;

        $clientDocCondtnArr['client_document_map_tbl.fk_client_id']=$clientId;
        $clientDocCondtnArr['client_document_map_tbl.status']="1";
        
        $query=$this->Mquery->getRecords($tableName=$this->client_document_map_tbl, $colNames="client_document_map_tbl.fk_client_document_id, client_document_map_tbl.fk_client_id, client_document_map_tbl.client_document_number, client_document_map_tbl.client_document_issue_date, client_document_map_tbl.client_document_effective_date, client_document_map_tbl.client_document_file, client_document_map_tbl.client_document_mobile, client_document_map_tbl.client_document_email, client_document_map_tbl.client_document_address, client_document_map_tbl.client_document_remark", $clientDocCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDocData=$query['userData'];

        $clientDocDataArr=array();

        if(!empty($clientDocData))
        {
            foreach($clientDocData AS $e_doc)
            {
                $clientDocDataArr[$e_doc['fk_client_document_id']]=$e_doc;
            }
        }

        $this->data['clientDocDataArr']=$clientDocDataArr;

        $clientActCondtnArr['client_act_map_tbl.fkClientId']=$clientId;
        $clientActCondtnArr['client_act_map_tbl.status']="1";
        
        $query=$this->Mquery->getRecords($tableName=$this->client_act_map_tbl, $colNames="client_act_map_tbl.fkActId, client_act_map_tbl.fkClientId", $clientActCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientActData=$query['userData'];

        $clientActArr=array();

        if(!empty($clientActData))
            $clientActArr=array_column($clientActData, 'fkActId');

        $this->data['clientActArr']=$clientActArr;

        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->orderBy('client_group_tbl.client_group', 'ASC')
                        ->findAll();

        $this->data['groupList']=$groupList;

        $groupCatList=$this->Mgroup_cat->where('group_category_tbl.status', 1)
                                    ->findAll();

        $this->data['groupCatList']=$groupCatList;

        $userList=$this->Muser->where('user_tbl.isCostCenter', 1)
                        ->where('user_tbl.status', 1)
                        ->findAll();

        $this->data['userList']=$userList;

        $salutationList=$this->Msalutation->where('salutation_tbl.status', 1)
                        ->findAll();

        $this->data['salutationList']=$salutationList;

        $organisationTypes=$this->MorganisationType->where('organisation_type_tbl.status', 1)
                        ->orderBy('organisation_type_tbl.seqNo', "ASC")
                        ->findAll();

        $this->data['organisationTypes']=$organisationTypes;

        $documentList=$this->Mdocument->where('client_document_tbl.status', 1)
                        ->orderBy('client_document_tbl.seqNo', "ASC")
                        ->findAll();

        $this->data['documentList']=$documentList;

        $actList=$this->Mact->where('act_tbl.status', 1)
                        ->orderBy('act_tbl.sortBy', "ASC")
                        ->findAll();

        $this->data['actList']=$actList;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.fkClientId']=$clientId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.fk_org_type_id']=$clientBussOrganisationType;
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['due_date_master_tbl.due_date']="ASC";

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_name AS act_option_name2, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, due_date_master_tbl.due_act, ext_due_date_master_tbl.extended_date, organisation_type_tbl.organisation_type_name AS tax_payer_val", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        $workActs=array();
        $workActListArr=array();

        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_work)
            {
                $workActs[$e_work['due_act']]=$e_work['act_name'];
                $workActListArr[$e_work['due_act']][]=$e_work;
            }
        }

        $this->data['workActs']=$workActs;
        $this->data['workActListArr']=$workActListArr;

        $workActArr=array();

        if(!empty($workDataArr))
            $workActArr=array_unique(array_column($workDataArr, 'due_act'));

        $this->data['workActArr']=$workActArr;

        $workActList=array();

        if(!empty($workActArr))
        {
            $workActList=$this->Mact->whereIn('act_tbl.act_id', $workActArr)
                            ->where('act_tbl.status', 1)
                            ->findAll();
        }

        $this->data['workActList']=$workActList;

        // $dueDateForArr=$this->Mact_option->where('act_option_map_tbl.fk_act_id', $selAct)
        //     ->where('act_option_map_tbl.option_type', 1)
        //     ->where('act_option_map_tbl.status', 1)
        //     ->findAll();

        // $this->data['dueDateForArr']=$dueDateForArr;

        // $taxPayerArr=$this->Mact_option->where('act_option_map_tbl.fk_act_id', $selAct)
        //     ->where('act_option_map_tbl.option_type', 2)
        //     ->where('act_option_map_tbl.status', 1)
        //     ->findAll();

        // $this->data['taxPayerArr']=$taxPayerArr;

        // $periodArr=$this->Mperiodicity->where('status', 1)
        //             ->findAll();

        // $this->data['periodArr']=$periodArr;
        
        $cliPartCondtnArr['client_partner_tbl.status']="1";
        $cliPartCondtnArr['client_partner_tbl.fkClientId']=$clientId;
        
        $query=$this->Mquery->getRecords($tableName=$this->client_partner_tbl, $colNames="client_partner_tbl.client_partner_id, client_partner_tbl.client_partner_name, client_partner_tbl.client_partner_text, client_partner_tbl.client_partner_pan, client_partner_tbl.client_partner_aadhar, client_partner_tbl.client_partner_date, client_partner_tbl.client_partner_appt_date", $cliPartCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientPartnerList=$query['userData'];

        $this->data['clientPartnerList']=$clientPartnerList;

        $actArr = $this->Mact->where('status', 1)
                    ->findAll();

        $this->data['actArr']=$actArr;

        $periodArr = $this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        $taxYearArr=explode('-', $this->sessDueDateYear);
        
        $taxFromYear=date('Y-m-d', strtotime("01-04-".$taxYearArr[0]));
        $taxToYear=date('Y-m-d', strtotime("31-03-20".$taxYearArr[1]));
        
        $eventCondtnArr['non_regular_due_date_tbl.non_rglr_due_date >=']=$taxFromYear;
        $eventCondtnArr['non_regular_due_date_tbl.non_rglr_due_date <=']=$taxToYear;
        $eventCondtnArr['non_regular_due_date_tbl.status']=1;
        $eventCondtnArr['non_regular_due_date_tbl.fkClientId']=$clientId;
            
        $eventOrderByArr['non_regular_due_date_tbl.non_rglr_due_date']="ASC";
        $eventOrderByArr['non_regular_due_date_tbl.non_rglr_due_date_id']="ASC";

        $eventJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=non_regular_due_date_tbl.non_rglr_due_act", "type"=>"left");
 
        $eventColNames="
            non_regular_due_date_tbl.non_rglr_due_date_id,
            non_regular_due_date_tbl.non_rglr_due_state,
            non_regular_due_date_tbl.non_rglr_due_act,
            non_regular_due_date_tbl.non_rglr_due_date_for,
            non_regular_due_date_tbl.non_rglr_applicable_form,
            non_regular_due_date_tbl.non_rglr_under_section,
            non_regular_due_date_tbl.non_rglr_event_date,
            non_regular_due_date_tbl.non_rglr_periodicity,
            non_regular_due_date_tbl.non_rglr_daily_date,
            non_regular_due_date_tbl.non_rglr_period_month,
            non_regular_due_date_tbl.non_rglr_period_year,
            non_regular_due_date_tbl.non_rglr_f_period_month,
            non_regular_due_date_tbl.non_rglr_f_period_year,
            non_regular_due_date_tbl.non_rglr_t_period_month,
            non_regular_due_date_tbl.non_rglr_t_period_year,
            non_regular_due_date_tbl.non_rglr_finYear,
            non_regular_due_date_tbl.non_rglr_due_date,
            non_regular_due_date_tbl.non_rglr_due_notes,
            non_regular_due_date_tbl.non_rglr_doc_file,
            DATE_FORMAT(non_regular_due_date_tbl.non_rglr_due_date, '%c') AS act_due_month,
            act_tbl.act_name,
            act_tbl.act_short_name
        ";

        $query=$this->Mcommon->getRecords($tableName=$this->non_regular_due_date_tbl, $colNames=$eventColNames, $eventCondtnArr, $likeCondtnArr=array(), $eventJoinArr, $singleRow=FALSE, $eventOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $eventDueDatesArr=$query['userData'];

        $this->data['eventDueDatesArr']=$eventDueDatesArr;

        $evtDDActs=array();
        $evtDueDatesArr=array();

        if(!empty($eventDueDatesArr))
        {
            foreach($eventDueDatesArr AS $e_evt)
            {
                $evtDDActs[$e_evt['non_rglr_due_act']]=$e_evt['act_name'];
                $evtDueDatesArr[$e_evt['non_rglr_due_act']][]=$e_evt;
            }
        }

        $this->data['evtDDActs']=$evtDDActs;
        $this->data['evtDueDatesArr']=$evtDueDatesArr;

        $evtDDActArr=array();

        if(!empty($eventDueDatesArr))
            $evtDDActArr=array_unique(array_column($eventDueDatesArr, 'non_rglr_due_act'));

        $this->data['evtDDActArr']=$evtDDActArr;

        return view('firm_panel/client/edit_client', $this->data);
    }

    public function edit_client_old($clientId)
    {
        $this->data['clientId']=$clientId;

        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Client List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $backTo=$this->request->getGet('backTo');
        
        if($backTo=="oldmaster")
        {
            $backUrl=base_url('getMasterOldClientData');
        }
        else
        {
            $backUrl=base_url('clients');
        }
        
        $this->data['backUrl']=$backUrl;

        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.*, client_tbl.clientPanNumber, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $clientBussOrganisationType="";
        
        if(!empty($clientData))
            $clientBussOrganisationType=$clientData['clientBussOrganisationType'];
            
        $this->data['clientData']=$clientData;
        
        $this->data['clientBussOrganisationType']=$clientBussOrganisationType;

        $clientDocCondtnArr['client_document_map_tbl.fk_client_id']=$clientId;
        $clientDocCondtnArr['client_document_map_tbl.status']="1";
        
        $query=$this->Mquery->getRecords($tableName=$this->client_document_map_tbl, $colNames="client_document_map_tbl.fk_client_document_id, client_document_map_tbl.fk_client_id, client_document_map_tbl.client_document_number, client_document_map_tbl.client_document_issue_date, client_document_map_tbl.client_document_effective_date, client_document_map_tbl.client_document_file", $clientDocCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDocData=$query['userData'];

        $clientDocDataArr=array();

        if(!empty($clientDocData))
        {
            foreach($clientDocData AS $e_doc)
            {
                $clientDocDataArr[$e_doc['fk_client_document_id']]=$e_doc;
            }
        }

        $this->data['clientDocDataArr']=$clientDocDataArr;

        $clientActCondtnArr['client_act_map_tbl.fkClientId']=$clientId;
        $clientActCondtnArr['client_act_map_tbl.status']="1";
        
        $query=$this->Mquery->getRecords($tableName=$this->client_act_map_tbl, $colNames="client_act_map_tbl.fkActId, client_act_map_tbl.fkClientId", $clientActCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientActData=$query['userData'];

        $clientActArr=array();

        if(!empty($clientActData))
            $clientActArr=array_column($clientActData, 'fkActId');

        $this->data['clientActArr']=$clientActArr;

        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->orderBy('client_group_tbl.client_group', 'ASC')
                        ->findAll();

        $this->data['groupList']=$groupList;

        $groupCatList=$this->Mgroup_cat->where('group_category_tbl.status', 1)
                                    ->findAll();

        $this->data['groupCatList']=$groupCatList;

        $userList=$this->Muser->where('user_tbl.isCostCenter', 1)
                        ->where('user_tbl.status', 1)
                        ->findAll();

        $this->data['userList']=$userList;

        $salutationList=$this->Msalutation->where('salutation_tbl.status', 1)
                        ->findAll();

        $this->data['salutationList']=$salutationList;

        $organisationTypes=$this->MorganisationType->where('organisation_type_tbl.status', 1)
                        ->orderBy('organisation_type_tbl.seqNo', "ASC")
                        ->findAll();

        $this->data['organisationTypes']=$organisationTypes;

        $documentList=$this->Mdocument->where('client_document_tbl.status', 1)
                        ->orderBy('client_document_tbl.seqNo', "ASC")
                        ->findAll();

        $this->data['documentList']=$documentList;

        $actList=$this->Mact->where('act_tbl.status', 1)
                        ->findAll();

        $this->data['actList']=$actList;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.fkClientId']=$clientId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.fk_org_type_id']=$clientBussOrganisationType;
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['due_date_master_tbl.due_date']="ASC";

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_name AS act_option_name2, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, due_date_master_tbl.due_act, ext_due_date_master_tbl.extended_date, organisation_type_tbl.organisation_type_name AS tax_payer_val", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        $workActs=array();
        $workActListArr=array();

        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_work)
            {
                $workActs[$e_work['due_act']]=$e_work['act_name'];
                $workActListArr[$e_work['due_act']][]=$e_work;
            }
        }

        $this->data['workActs']=$workActs;
        $this->data['workActListArr']=$workActListArr;

        $workActArr=array();

        if(!empty($workDataArr))
            $workActArr=array_unique(array_column($workDataArr, 'due_act'));

        $this->data['workActArr']=$workActArr;

        $workActList=array();

        if(!empty($workActArr))
        {
            $workActList=$this->Mact->whereIn('act_tbl.act_id', $workActArr)
                            ->where('act_tbl.status', 1)
                            ->findAll();
        }

        $this->data['workActList']=$workActList;

        // $dueDateForArr=$this->Mact_option->where('act_option_map_tbl.fk_act_id', $selAct)
        //     ->where('act_option_map_tbl.option_type', 1)
        //     ->where('act_option_map_tbl.status', 1)
        //     ->findAll();

        // $this->data['dueDateForArr']=$dueDateForArr;

        // $taxPayerArr=$this->Mact_option->where('act_option_map_tbl.fk_act_id', $selAct)
        //     ->where('act_option_map_tbl.option_type', 2)
        //     ->where('act_option_map_tbl.status', 1)
        //     ->findAll();

        // $this->data['taxPayerArr']=$taxPayerArr;

        // $periodArr=$this->Mperiodicity->where('status', 1)
        //             ->findAll();

        // $this->data['periodArr']=$periodArr;
        
        $cliPartCondtnArr['client_partner_tbl.status']="1";
        $cliPartCondtnArr['client_partner_tbl.fkClientId']=$clientId;
        
        $query=$this->Mquery->getRecords($tableName=$this->client_partner_tbl, $colNames="client_partner_tbl.client_partner_id, client_partner_tbl.client_partner_name, client_partner_tbl.client_partner_text, client_partner_tbl.client_partner_pan, client_partner_tbl.client_partner_aadhar, client_partner_tbl.client_partner_date, client_partner_tbl.client_partner_appt_date", $cliPartCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientPartnerList=$query['userData'];

        $this->data['clientPartnerList']=$clientPartnerList;

        return view('firm_panel/client/edit_client_old', $this->data);
    }

    public function view_client($clientId)
    {
        $this->data['clientId']=$clientId;

        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="View Client Documents";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $backTo=$this->request->getGet('backTo');
        
        if($backTo=="oldmaster")
        {
            $backUrl=base_url('getMasterOldClientData');
        }
        else
        {
            $backUrl=base_url('clients');
        }
        
        $this->data['backUrl']=$backUrl;

        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.*, client_tbl.clientPanNumber, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];

        $this->data['clientData']=$clientData;

        $clientDocCondtnArr['client_document_map_tbl.fk_client_id']=$clientId;
        $clientDocCondtnArr['client_document_map_tbl.status']="1";
        
        $query=$this->Mquery->getRecords($tableName=$this->client_document_map_tbl, $colNames="client_document_map_tbl.fk_client_document_id, client_document_map_tbl.fk_client_id, client_document_map_tbl.client_document_number, client_document_map_tbl.client_document_issue_date, client_document_map_tbl.client_document_effective_date, client_document_map_tbl.client_document_file", $clientDocCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDocData=$query['userData'];

        $clientDocDataArr=array();

        if(!empty($clientDocData))
        {
            foreach($clientDocData AS $e_doc)
            {
                $clientDocDataArr[$e_doc['fk_client_document_id']]=$e_doc;
            }
        }

        $this->data['clientDocDataArr']=$clientDocDataArr;

        $documentList=$this->Mdocument->where('client_document_tbl.status', 1)
                        ->findAll();

        $this->data['documentList']=$documentList;

        return view('firm_panel/client/view_client', $this->data);
    }
    
    public function edit_partner()
    {
        $this->db->transBegin();
         
        $clientId=$this->request->getPost('clientId');
        $client_partner_id=$this->request->getPost('client_partner_id');
        $client_partner_name=$this->request->getPost('client_partner_name');
        $client_partner_text=$this->request->getPost('client_partner_text');
        $client_partner_pan=$this->request->getPost('client_partner_pan');
        $client_partner_aadhar=$this->request->getPost('client_partner_aadhar');
        $client_partner_date=$this->request->getPost('client_partner_date');
        $client_partner_appt_date=$this->request->getPost('client_partner_appt_date');
        
        $cliPartUpdateArr[]=array(
            'client_partner_id'=>$client_partner_id,
            'client_partner_name'=>$client_partner_name,
            'client_partner_text'=>$client_partner_text,
            'client_partner_pan'=>$client_partner_pan,
            'client_partner_aadhar'=>$client_partner_aadhar,
            'client_partner_date'=>$client_partner_date,
            'client_partner_appt_date'=>$client_partner_appt_date,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        );
        
        if(!empty($cliPartUpdateArr))
        {
            $cliPartCondtnArr['client_partner_tbl.fkClientId']=$clientId;
            
            $this->Mquery->updateBatch($tableName=$this->client_partner_tbl, $cliPartUpdateArr, $updateKey="client_partner_id", $cliPartCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        }
        
        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Client Partner has not updated :(");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client Partner updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Client Partner has been updated successfully :)");
        }
        
        return redirect()->to(base_url('client/edit_client/'.$clientId));
    }
}
