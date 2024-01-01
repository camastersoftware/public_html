<?php namespace App\Controllers\Admin;
use \App\Controllers\BaseController;

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

        $this->sessCaFirmId=$this->session->get('caFirmId');

        $documentsPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/documents');

        $this->data['documentsPath']=$documentsPath;
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Client List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;

        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
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
                        ->findAll();

        $this->data['organisationTypes']=$organisationTypes;

        $documentList=$this->Mdocument->where('client_document_tbl.status', 1)
                        ->findAll();

        $this->data['documentList']=$documentList;

        $actList=$this->Mact->where('act_tbl.status', 1)
                        ->findAll();

        $this->data['actList']=$actList;

        return view('firm_panel/client/clients', $this->data);
	}

    public function edit_client($clientId)
    {
        $this->data['clientId']=$clientId;

        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Client List";
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

        $clientActCondtnArr['client_act_map_tbl.fkClientId']=$clientId;
        $clientActCondtnArr['client_act_map_tbl.status']="1";
        
        $query=$this->Mquery->getRecords($tableName=$this->client_act_map_tbl, $colNames="client_act_map_tbl.fkActId, client_act_map_tbl.fkClientId", $clientActCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientActData=$query['userData'];

        $clientActArr=array();

        if(!empty($clientActData))
            $clientActArr=array_column($clientActData, 'fkActId');

        $this->data['clientActArr']=$clientActArr;

        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
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
                        ->findAll();

        $this->data['organisationTypes']=$organisationTypes;

        $documentList=$this->Mdocument->where('client_document_tbl.status', 1)
                        ->findAll();

        $this->data['documentList']=$documentList;

        $actList=$this->Mact->where('act_tbl.status', 1)
                        ->findAll();

        $this->data['actList']=$actList;
        
        $workCondtnArr['work_tbl.fkClientId']=$clientId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['due_date_master_tbl.due_date']="ASC";

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_name AS act_option_name2, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, due_date_master_tbl.due_act", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
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

        return view('firm_panel/client/edit_client', $this->data);
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
}
