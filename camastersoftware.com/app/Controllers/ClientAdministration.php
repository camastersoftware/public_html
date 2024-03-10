<?php
namespace App\Controllers;

class ClientAdministration extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mcommon = new \App\Models\Mcommon();
        $this->MclientDocumentMap = new \App\Models\MclientDocumentMap();
        $this->MdigitalCertificateClassMaster = new \App\Models\MdigitalCertificateClassMaster();
        $this->MclientsCredetialsAdministration = new \App\Models\MclientsCredetialsAdministration();
        $this->Mact = new \App\Models\Mact();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->Mstate = new \App\Models\Mstate();
        $this->MorganisationType = new \App\Models\MorganisationType();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
        $this->clients_credetials_administration_tbl=$tableArr['clients_credetials_administration_tbl'];
        $this->digital_certificate_class_master_tbl=$tableArr['digital_certificate_class_master_tbl'];
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Client Administration";
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Client Management";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/client_administration/home', $this->data);
	}
	
	public function din_dsc_client_list()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Digital Signature Certificates (DSC)";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $digitalCertificateClassMaster = $this->MdigitalCertificateClassMaster->where('status', 1)->findAll();

        $this->data['digitalCertificateClassMaster']=$digitalCertificateClassMaster;
        
        $digiClientCondition = array(
            'status'                => 1
        );
        
        $digitalCertificateClientData = $this->MclientsCredetialsAdministration->select('client_id')->where($digiClientCondition)->findAll();
        
        $digiCertClientIdArr=array();
        
        if(!empty($digitalCertificateClientData)){
            $digiCertClientIdArr = array_column($digitalCertificateClientData, 'client_id');
        }
        
        $this->data['digiCertClientIdArr']=$digiCertClientIdArr;
        
        $getClientList=array();
        
        $clientDinCondtnArr['client_tbl.status']=1;
        $clientDinCondtnArr['client_tbl.isOldClient']=2;
        
        $clientDinWhereInArray['client_tbl.clientBussOrganisationType']=INDIVIDUAL_ARRAY;
        
        $clientDinOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientDinOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientDinJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientDinJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientName, client_tbl.clientBussOrganisationType AS orgType", $clientDinCondtnArr, $likeCondtnArr=array(), $clientDinJoinArr, $singleRow=FALSE, $clientDinOrderByArr, $groupByArr=array(), $clientDinWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientList=$query['userData'];
        
        $this->data['clientList']=$clientList;
        
        $clientWhereInArray=array();
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['ccat.client_id !=']='';
        $clientCondtnArr['ccat.client_administration_model_id']='2';
        // $clientWhereInArray['client_tbl.clientId']=$digitalCertificateClientIdArr;
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"ccat.client_id=client_tbl.clientId AND ccat.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_group_tbl.client_group_cost", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_document_map_tbl.fk_client_id=client_tbl.clientId AND client_document_map_tbl.fk_client_document_id=4 AND client_document_map_tbl.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->digital_certificate_class_master_tbl." AS dccmt", "condtn"=>"dccmt.digital_certificate_class_master_id=ccat.digital_certificate_class_master_id", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->clients_credetials_administration_tbl." AS ccat", $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_tbl.isOldClient, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, user_tbl.userShortName, ccat.clients_credetials_administration_id, ccat.digital_certificate_class_master_id, ccat.password, ccat.purchase_from, ccat.start_date, ccat.end_date, ccat.dcs_token_with, ccat.dcs_token_date, ccat.notes, ccat.isDiscontinued, client_document_map_tbl.client_document_number AS din_dsc_no, dccmt.digital_certificate_class_master_name", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $clientWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $currentDate = date('Y-m-d');
        
        $this->data['currentDate']=$currentDate;

        return view('firm_panel/client_administration/din_dsc_client_list', $this->data);
	}
	
	public function add_client_din_dsc()
	{
	    $client_administration_model_id=2;
	    $client_id=$this->request->getPost('client_id');
	    $digital_certificate_class_master_id=$this->request->getPost('digital_certificate_class_master_id');
	    $login_password=$this->request->getPost('login_password');
	    $purchase_from = $this->request->getPost('purchase_from');
	    $start_date = $this->request->getPost('start_date');
	    $end_date = $this->request->getPost('end_date');
	    $dcs_token_with = $this->request->getPost('dcs_token_with');
	    $dcs_token_date = $this->request->getPost('dcs_token_date');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'client_administration_model_id'        =>  2,
            'client_id'                             =>  $client_id,
            'digital_certificate_class_master_id'   =>  $digital_certificate_class_master_id,
            'password'                              =>  $login_password,
            'purchase_from'                         =>  $purchase_from,
            'start_date'                            =>  $start_date,
            'end_date'                              =>  $end_date,
            'dcs_token_with'                        =>  $dcs_token_with,
            'dcs_token_date'                        =>  $dcs_token_date,
            'notes'                                 =>  $notes,
            'status'                                =>  1,
            'createdBy'                             =>  $this->adminId,
            'createdDatetime'                       =>  $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Dsc of Client has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Dsc of Client has not added :(");
	    }
	    
	    return redirect()->route('din-dsc-client-list');
	}
	
	public function edit_client_din_dsc()
	{
	    $client_administration_model_id=2;
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    $client_id=$this->request->getPost('client_id');
	    $digital_certificate_class_master_id=$this->request->getPost('digital_certificate_class_master_id');
	    $login_password=$this->request->getPost('login_password');
	    $purchase_from = $this->request->getPost('purchase_from');
	    $start_date = $this->request->getPost('start_date');
	    $end_date = $this->request->getPost('end_date');
	    $dcs_token_with = $this->request->getPost('dcs_token_with');
	    $dcs_token_date = $this->request->getPost('dcs_token_date');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'client_id'                             => $client_id,
            'digital_certificate_class_master_id'   => $digital_certificate_class_master_id,
            'password'                              => $login_password,
            'purchase_from'                         => $purchase_from,
            'start_date'                            => $start_date,
            'end_date'                              => $end_date,
            'dcs_token_with'                        => $dcs_token_with,
            'dcs_token_date'                        => $dcs_token_date,
            'notes'                                 => $notes,
            'isDiscontinued'                        => 2,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Dsc of Client has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Dsc of Client has not updated :(");
	    }
    	    
	    return redirect()->route('din-dsc-client-list');
	}
	
	public function discontinue_client_din_dsc()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'isDiscontinued'                        => 1,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Discontinued";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Dsc of Client has been discontinued successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Dsc of Client has not discontinue :(");
	    }
	    
	    return redirect()->route('din-dsc-client-list');
	}
	
	public function continue_client_din_dsc()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'isDiscontinued'                        => 2,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Continued";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Dsc of Client has been continued successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Dsc of Client has not continue :(");
	    }
	    
	    return redirect()->route('din-dsc-client-list');
	}
	
	public function delete_client_din_dsc()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'status'                                => 2,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Dsc of Client has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Dsc of Client has not deleted :(");
	    }
	    
	    return redirect()->route('din-dsc-client-list');
	}
	
	public function password_mgmt()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Password Management";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/client_administration/password_mgmt', $this->data);
	}
	
	public function it_password()
	{
	    ini_set('memory_limit', '-1');
	    
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Password Management - Income Tax";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $getClientList=array();
        
        $clientDinCondtnArr['client_tbl.status']=1;
        $clientDinCondtnArr['client_tbl.isOldClient']=2;
        
        $clientDinWhereInArray['client_tbl.clientBussOrganisationType']=INDIVIDUAL_ARRAY;
        
        $clientDinOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientDinOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientDinJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientDinJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientName, client_tbl.clientBussOrganisationType AS orgType", $clientDinCondtnArr, $likeCondtnArr=array(), $clientDinJoinArr, $singleRow=FALSE, $clientDinOrderByArr, $groupByArr=array(), $clientDinWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientList=$query['userData'];
        
        $this->data['clientList']=$clientList;
        
        $clientWhereInArray=array();
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_document_map_tbl.client_document_number !=']="";
        // $clientCondtnArr['ccat.client_id !=']='';
        // $clientCondtnArr['ccat.client_administration_model_id']='3';
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientGroupByArr=array('client_tbl.clientId');
        
        $clientJoinArr[]=array("tbl"=>$this->clients_credetials_administration_tbl." AS ccat", "condtn"=>"ccat.client_id=client_tbl.clientId AND ccat.client_administration_model_id=3 AND ccat.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_document_map_tbl.fk_client_id=client_tbl.clientId AND client_document_map_tbl.fk_client_document_id=1 AND client_document_map_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, ccat.clients_credetials_administration_id, ccat.password, ccat.notes, client_document_map_tbl.client_document_number AS panNo", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $clientGroupByArr, $clientWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $currentDate = date('Y-m-d');
        
        $this->data['currentDate']=$currentDate;

        return view('firm_panel/client_administration/income_tax', $this->data);
	}
	
	public function add_it_password()
	{
	    $client_id=$this->request->getPost('client_id');
	    $login_password=$this->request->getPost('login_password');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'client_administration_model_id'        =>  3,
            'client_id'                             =>  $client_id,
            'password'                              =>  $login_password,
            'notes'                                 =>  $notes,
            'status'                                =>  1,
            'createdBy'                             =>  $this->adminId,
            'createdDatetime'                       =>  $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Income Tax Password of Client has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Income Tax Password of Client has not added :(");
	    }
	    
	    return redirect()->route('it-password');
	}
	
	public function edit_it_password()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    $client_id=$this->request->getPost('client_id');
	    $login_password=$this->request->getPost('login_password');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'client_administration_model_id'        => 3,
            'client_id'                             => $client_id,
            'password'                              => $login_password,
            'notes'                                 => $notes,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Income Tax Password of Client has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Income Tax Password of Client has not updated :(");
	    }
    	    
	    return redirect()->route('it-password');
	}
	
	public function delete_it_password()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'status'                                => 2,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Income Tax Password of Client has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Income Tax Password of Client has not deleted :(");
	    }
	    
	    return redirect()->route('it-password');
	}
	
	public function gst_password()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Password Management - GST";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_document_map_tbl.client_document_number !=']="";
        // $clientCondtnArr['ccat.client_id !=']='';
        // $clientCondtnArr['ccat.client_administration_model_id']='4';
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->clients_credetials_administration_tbl." AS ccat", "condtn"=>"ccat.client_id=client_tbl.clientId AND ccat.client_administration_model_id=4 AND ccat.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_document_map_tbl.fk_client_id=client_tbl.clientId AND client_document_map_tbl.fk_client_document_id=5 AND client_document_map_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, ccat.clients_credetials_administration_id, ccat.login_username, ccat.password, ccat.e_way_bill_login, ccat.e_way_bill_password, ccat.notes, client_document_map_tbl.client_document_number AS gstNo", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $clientWhereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $currentDate = date('Y-m-d');
        
        $this->data['currentDate']=$currentDate;

        return view('firm_panel/client_administration/gst', $this->data);
	}
	
	public function add_gst_password()
	{
	    $client_id=$this->request->getPost('client_id');
	    $login_username=$this->request->getPost('login_username');
	    $login_password=$this->request->getPost('login_password');
	    $e_way_bill_login=$this->request->getPost('e_way_bill_login');
	    $e_way_bill_password=$this->request->getPost('e_way_bill_password');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'client_administration_model_id'        =>  4,
            'client_id'                             =>  $client_id,
            'login_username'                        =>  $login_username,
            'password'                              =>  $login_password,
            'e_way_bill_login'                      =>  $e_way_bill_login,
            'e_way_bill_password'                   =>  $e_way_bill_password,
            'notes'                                 =>  $notes,
            'status'                                =>  1,
            'createdBy'                             =>  $this->adminId,
            'createdDatetime'                       =>  $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "GST Password of Client has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "GST Password of Client has not added :(");
	    }
	    
	    return redirect()->route('gst-password');
	}
	
	public function edit_gst_password()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    $client_id=$this->request->getPost('client_id');
	    $login_username=$this->request->getPost('login_username');
	    $login_password=$this->request->getPost('login_password');
	    $e_way_bill_login=$this->request->getPost('e_way_bill_login');
	    $e_way_bill_password=$this->request->getPost('e_way_bill_password');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'client_administration_model_id'        => 4,
            'client_id'                             => $client_id,
            'login_username'                        => $login_username,
            'password'                              => $login_password,
            'e_way_bill_login'                      => $e_way_bill_login,
            'e_way_bill_password'                   => $e_way_bill_password,
            'notes'                                 => $notes,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "GST Password of Client has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "GST Password of Client has not updated :(");
	    }
    	    
	    return redirect()->route('gst-password');
	}
	
	public function delete_gst_password()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'status'                                => 2,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "GST Password of Client has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "GST Password of Client has not deleted :(");
	    }
	    
	    return redirect()->route('gst-password');
	}
	
	public function pt_password()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Password Management - Profession Tax";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_document_map_tbl.client_document_number !=']="";
        // $clientCondtnArr['ccat.client_id !=']='';
        // $clientCondtnArr['ccat.client_administration_model_id']='4';
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->clients_credetials_administration_tbl." AS ccat", "condtn"=>"ccat.client_id=client_tbl.clientId AND ccat.client_administration_model_id=7 AND ccat.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_document_map_tbl.fk_client_id=client_tbl.clientId AND client_document_map_tbl.fk_client_document_id=7 AND client_document_map_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, ccat.clients_credetials_administration_id, ccat.login_username, ccat.password, ccat.notes, client_document_map_tbl.client_document_number AS regNo", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $clientWhereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $currentDate = date('Y-m-d');
        
        $this->data['currentDate']=$currentDate;

        return view('firm_panel/client_administration/profession_tax', $this->data);
	}
	
	public function edit_pt_password()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    $client_id=$this->request->getPost('client_id');
	    $login_password=$this->request->getPost('login_password');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'client_administration_model_id'        => 7,
            'client_id'                             => $client_id,
            'password'                              => $login_password,
            'notes'                                 => $notes,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Profession Tax Password of Client has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Profession Tax Password of Client has not updated :(");
	    }
    	    
	    return redirect()->route('pt-password');
	}
	
	public function company_password()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Password Management - Companies Act";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_tbl.clientBussOrganisationType']="1";
        // $clientCondtnArr['ccat.client_id !=']='';
        // $clientCondtnArr['ccat.client_administration_model_id']='4';
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->clients_credetials_administration_tbl." AS ccat", "condtn"=>"ccat.client_id=client_tbl.clientId AND ccat.client_administration_model_id=8 AND ccat.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientRegDocument, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, ccat.clients_credetials_administration_id, ccat.login_username, ccat.password, ccat.notes", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $clientWhereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $currentDate = date('Y-m-d');
        
        $this->data['currentDate']=$currentDate;

        return view('firm_panel/client_administration/company', $this->data);
	}
	
	public function edit_company_password()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    $client_id=$this->request->getPost('client_id');
	    $login_username=$this->request->getPost('login_username');
	    $login_password=$this->request->getPost('login_password');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'client_administration_model_id'        => 8,
            'client_id'                             => $client_id,
            'login_username'                        => $login_username,
            'password'                              => $login_password,
            'notes'                                 => $notes,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Company Credentials of Client has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Company Credentials of Client has not updated :(");
	    }
    	    
	    return redirect()->route('company-password');
	}
	
	public function llp_password()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Password Management - LLP";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_tbl.clientBussOrganisationType']="2";
        // $clientCondtnArr['ccat.client_id !=']='';
        // $clientCondtnArr['ccat.client_administration_model_id']='4';
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->clients_credetials_administration_tbl." AS ccat", "condtn"=>"ccat.client_id=client_tbl.clientId AND ccat.client_administration_model_id=9 AND ccat.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientRegDocument, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, ccat.clients_credetials_administration_id, ccat.login_username, ccat.password, ccat.notes", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $clientWhereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $currentDate = date('Y-m-d');
        
        $this->data['currentDate']=$currentDate;

        return view('firm_panel/client_administration/llp', $this->data);
	}
	
	public function edit_llp_password()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    $client_id=$this->request->getPost('client_id');
	    $login_username=$this->request->getPost('login_username');
	    $login_password=$this->request->getPost('login_password');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'client_administration_model_id'        => 9,
            'client_id'                             => $client_id,
            'login_username'                        => $login_username,
            'password'                              => $login_password,
            'notes'                                 => $notes,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "LLP Credentials of Client has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "LLP Credentials of Client has not updated :(");
	    }
    	    
	    return redirect()->route('llp-password');
	}
	
	public function se_password()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Password Management - Shops & Establishment";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_document_map_tbl.client_document_number !=']="";
        // $clientCondtnArr['ccat.client_id !=']='';
        // $clientCondtnArr['ccat.client_administration_model_id']='4';
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->clients_credetials_administration_tbl." AS ccat", "condtn"=>"ccat.client_id=client_tbl.clientId AND ccat.client_administration_model_id=10 AND ccat.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_document_map_tbl, "condtn"=>"client_document_map_tbl.fk_client_id=client_tbl.clientId AND client_document_map_tbl.fk_client_document_id=10 AND client_document_map_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, ccat.clients_credetials_administration_id, ccat.login_username, ccat.password, ccat.notes, client_document_map_tbl.client_document_number AS regNo", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $clientWhereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $currentDate = date('Y-m-d');
        
        $this->data['currentDate']=$currentDate;

        return view('firm_panel/client_administration/shops_and_est', $this->data);
	}
	
	public function edit_se_password()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    $client_id=$this->request->getPost('client_id');
	    $login_username=$this->request->getPost('login_username');
	    $login_password=$this->request->getPost('login_password');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'client_administration_model_id'        => 10,
            'client_id'                             => $client_id,
            'login_username'                        => $login_username,
            'password'                              => $login_password,
            'notes'                                 => $notes,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Shops & Establishment Credentials of Client has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Shops & Establishment Credentials of Client has not updated :(");
	    }
    	    
	    return redirect()->route('se-password');
	}
	
	public function partnership_password()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Password Management - Partnership";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_tbl.clientBussOrganisationType']="4";
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->clients_credetials_administration_tbl." AS ccat", "condtn"=>"ccat.client_id=client_tbl.clientId AND ccat.client_administration_model_id=11 AND ccat.status=1", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientRegDocument, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, ccat.clients_credetials_administration_id, ccat.login_username, ccat.password, ccat.notes", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $clientWhereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $currentDate = date('Y-m-d');
        
        $this->data['currentDate']=$currentDate;

        return view('firm_panel/client_administration/partnership', $this->data);
	}
	
	public function edit_partnership_password()
	{
	    $clients_credetials_administration_id=$this->request->getPost('clients_credetials_administration_id');
	    $client_id=$this->request->getPost('client_id');
	    $login_username=$this->request->getPost('login_username');
	    $login_password=$this->request->getPost('login_password');
	    $notes = $this->request->getPost('notes');
	    
	    $insertArr=[
            'clients_credetials_administration_id'  => $clients_credetials_administration_id,
            'client_administration_model_id'        => 11,
            'client_id'                             => $client_id,
            'login_username'                        => $login_username,
            'password'                              => $login_password,
            'notes'                                 => $notes,
            'updatedBy'                             => $this->adminId,
            'updatedDatetime'                       => $this->currTimeStamp
        ];
	    
	    if($this->MclientsCredetialsAdministration->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Partnership Credentials of Client has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Partnership Credentials of Client has not updated :(");
	    }
    	    
	    return redirect()->route('partnership-password');
	}

    public function custom_due_dates()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'ckeditor');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Custom Due Dates";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $clientDinCondtnArr['client_tbl.status']=1;
        $clientDinCondtnArr['client_tbl.isOldClient']=2;
        
        $clientDinWhereInArray['client_tbl.clientBussOrganisationType']=INDIVIDUAL_ARRAY;
        
        $clientDinOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientDinOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientDinJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientDinJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientName, client_tbl.clientBussOrganisationType AS orgType", $clientDinCondtnArr, $likeCondtnArr=array(), $clientDinJoinArr, $singleRow=FALSE, $clientDinOrderByArr, $groupByArr=array(), $clientDinWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientList=$query['userData'];
        
        $this->data['clientList']=$clientList;
        
        $actArr = $this->Mact->where('status', 1)
                    ->findAll();

        $this->data['actArr']=$actArr;

        $periodArr = $this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;
        
        $organisationTypes=$this->MorganisationType->where('organisation_type_tbl.status', 1)
                        ->findAll();

        $this->data['organisationTypes']=$organisationTypes;

        return view('firm_panel/client_administration/custom_due_dates', $this->data);
	}
}
?>