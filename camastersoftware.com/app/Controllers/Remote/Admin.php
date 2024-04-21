<?php namespace App\Controllers\Remote;
use \App\Controllers\BaseController;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->Mquery = new \App\Models\Mquery();
        $this->Mfirm = new \App\Models\Mfirm();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Muser = new \App\Models\Muser();
        $this->Mclient = new \App\Models\Mclient();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->Msalutation = new \App\Models\Msalutation();
        $this->MorganisationType = new \App\Models\MorganisationType();
        $this->Mdocument = new \App\Models\Mdocument();
        $this->Mact = new \App\Models\Mact();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->Mdue_date = new \App\Models\Mdue_date();
        $this->Mcontsubgroup = new \App\Models\Mcontsubgroup();
        $this->Mcontact = new \App\Models\Mcontact();
        $this->MArticleshipStaff = new \App\Models\MArticleshipStaff();
        $this->MCharterAccountant = new \App\Models\MCharterAccountant();
        $this->MNonRegularDueDates = new \App\Models\MNonRegularDueDates();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->group_category_tbl=$tableArr['group_category_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->client_act_map_tbl=$tableArr['client_act_map_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
        $this->client_document_tbl=$tableArr['client_document_tbl'];
        $this->salutation_tbl=$tableArr['salutation_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->client_partner_tbl=$tableArr['client_partner_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->act_tbl=$tableArr['act_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->rectification_tbl=$tableArr['rectification_tbl'];
        $this->tax_payment_tbl=$tableArr['tax_payment_tbl'];
        $this->client_act_map_tbl=$tableArr['client_act_map_tbl'];
        $this->articleship_staff_tbl = $tableArr['articleship_staff_tbl'];
        $this->chartered_accuntant_tbl = $tableArr['chartered_accuntant_tbl'];
        $this->non_regular_due_date_tbl = $tableArr['non_regular_due_date_tbl'];
    }

    public function getGroups()
    {
        $client_group=$this->request->getPost('client_group');

        $groupList=$this->Mgroup->select('client_group_tbl.*, user_tbl.userFullName, group_category_tbl.group_category_name')
            ->join('user_tbl', 'user_tbl.userId=client_group_tbl.client_group_cost', 'left')
            ->join($this->group_category_tbl, 'group_category_tbl.group_category_id=client_group_tbl.client_group_category AND group_category_tbl.status=1', 'left')
            ->like('client_group_tbl.client_group', $client_group)
            ->where('client_group_tbl.status', 1)
            ->findAll();

        $this->data['groupList']=$groupList;

        $groupCatList=$this->Mgroup_cat->where('group_category_tbl.status', 1)
            ->findAll();

        $this->data['groupCatList']=$groupCatList;

        $userList=$this->Muser->where('user_tbl.isCostCenter', 1)
            ->where('user_tbl.status', 1)
            ->findAll();

        $this->data['userList']=$userList;

        return view('remote/admin/getGroups', $this->data);
    }

    public function add_client_group()
    {
        $this->db->transBegin();

        $validationRulesArr['client_group']=['label' => 'Client Group Name', 'rules' => 'required|trim'];
        $validationRulesArr['client_group_number']=['label' => 'Group Number', 'rules' => 'required|trim'];
        // $validationRulesArr['client_group_cost']=['label' => 'Cost Center', 'rules' => 'required|trim'];
        // $validationRulesArr['client_group_category']=['label' => 'Category', 'rules' => 'required|trim'];

        $errorArr=array();

        if(!$this->validate($validationRulesArr))
        {
            $errorArr=$this->validation->getErrors();
        }
        else
        {
            $client_group=$this->request->getPost('client_group');
            $client_group_number=$this->request->getPost('client_group_number');
            $client_group_cost=$this->request->getPost('client_group_cost');
            $client_group_category=$this->request->getPost('client_group_category');

            $clientGrpInsertArr = [
                'client_group'=>$client_group,
                'client_group_number'=>$client_group_number,
                'client_group_cost'=>$client_group_cost,
                'client_group_category'=>$client_group_category,
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];

            $this->Mgroup->save($clientGrpInsertArr);
            
            $client_group_id=$this->Mgroup->getInsertID();
            
            $contactSubGrpInsertArr=[
                'cont_sub_group_name'=>$client_group,
                'fk_cont_group_id'=>1,
                'refId'=>$client_group_id,
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];
            
            $this->Mcontsubgroup->save($contactSubGrpInsertArr);
        }

        if($this->db->transStatus() === FALSE || !empty($errorArr)){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="Client group has not added :(";
            $responseArr['userdata']=$errorArr;

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="Client group";
            $insertLogArr['message']="Client group added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client group has been added successfully :)";
            $responseArr['userdata']=$errorArr;

            $this->session->setFlashdata('successMsg', "Client group has been added successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function edit_client_group()
    {
        $this->db->transBegin();

        $validationRulesArr['client_group']=['label' => 'Client Group Name', 'rules' => 'required|trim'];
        $validationRulesArr['client_group_number']=['label' => 'Group Number', 'rules' => 'required|trim'];
        // $validationRulesArr['client_group_cost']=['label' => 'Cost Center', 'rules' => 'required|trim'];
        // $validationRulesArr['client_group_category']=['label' => 'Category', 'rules' => 'required|trim'];

        $errorArr=array();

        if(!$this->validate($validationRulesArr))
        {
            $errorArr=$this->validation->getErrors();
        }
        else
        {
            $client_group_id=$this->request->getPost('client_group_id');
            $client_group=$this->request->getPost('client_group');
            $client_group_number=$this->request->getPost('client_group_number');
            $client_group_cost=$this->request->getPost('client_group_cost');
            $client_group_category=$this->request->getPost('client_group_category');

            $clientGrpInsertArr = [
                'client_group_id'=>$client_group_id,
                'client_group'=>$client_group,
                'client_group_number'=>$client_group_number,
                'client_group_cost'=>$client_group_cost,
                'client_group_category'=>$client_group_category,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];
            
            $this->Mgroup->save($clientGrpInsertArr);
            
            $contSubGrpArr = $this->Mcontsubgroup->where('fk_cont_group_id', 1)->where('refId', $client_group_id)->where('status', 1)->get()->getRowArray();

            $contactSubGrpUpdateArr=[
                'cont_sub_group_id'=>$contSubGrpArr['cont_sub_group_id'],
                'cont_sub_group_name'=>$client_group,
                'fk_cont_group_id'=>1,
                'refId'=>$client_group_id,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];
            
            $this->Mcontsubgroup->save($contactSubGrpUpdateArr);
        }

        if($this->db->transStatus() === FALSE || !empty($errorArr)){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="Client group has not added :(";
            $responseArr['userdata']=$errorArr;

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="Client group";
            $insertLogArr['message']="Client group added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client group has been added successfully :)";
            $responseArr['userdata']=$errorArr;

            $this->session->setFlashdata('successMsg', "Client group has been added successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function delete_client_group()
    {
        $client_group_id=$this->request->getPost('client_group_id');

	    $dataArray = [
            'client_group_id' => $client_group_id,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mgroup->save($dataArray)){
            
            $contSubGrpArr = $this->Mcontsubgroup->where('fk_cont_group_id', 1)->where('refId', $client_group_id)->where('status', 1)->get()->getRowArray();

            $contactSubGrpUpdateArr=[
                'cont_sub_group_id'=>$contSubGrpArr['cont_sub_group_id'],
                'status' => 2,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];
            
            $this->Mcontsubgroup->save($contactSubGrpUpdateArr);
            
            $insertLogArr['section']="Client group";
            $insertLogArr['message']="Client group deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client group has been deleted successfully :)";
            $responseArr['userdata']=array();
        }else{
            $responseArr['status']=FALSE;
            $responseArr['message']="Client group has not delete :(";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }

    public function getClients()
    {
        $client_name=$this->request->getPost('client_name');

        // $clientLikeCondtnArr['client_tbl.clientName']=$client_name;
        $clientCustomWhereArray[]="(client_tbl.clientName LIKE '%".$client_name."%' OR client_tbl.clientBussOrganisation LIKE '%".$client_name."%')";
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_tbl.clientCostCenter", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_group_tbl.client_group, user_tbl.userShortName", $clientCondtnArr, $clientLikeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $clientCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;

        return view('remote/admin/getClients', $this->data);
    }

    public function add_client()
    {
        $this->db->transBegin();

        $validationRulesArr['clientTitle']=['label' => 'Client Title', 'rules' => 'trim'];
        $validationRulesArr['clientName']=['label' => 'Client Name', 'rules' => 'trim'];
        $validationRulesArr['clientFatherName']=['label' => 'Father Name', 'rules' => 'trim'];
        $validationRulesArr['clientSpouseName']=['label' => 'Spouse Name', 'rules' => 'trim'];
        $validationRulesArr['clientDob']=['label' => 'Date of Birth', 'rules' => 'trim'];
        $validationRulesArr['clientPassport']=['label' => 'Passport', 'rules' => 'trim'];
        $validationRulesArr['clientBussOrganisationEmp']=['label' => 'Organisation Name (Employed With)', 'rules' => 'trim'];
        $validationRulesArr['clientQualification']=['label' => 'Qualification', 'rules' => 'trim'];
        $validationRulesArr['clientOccupation']=['label' => 'Occupation', 'rules' => 'trim'];
        $validationRulesArr['clientResidentialAddress']=['label' => 'Residential Address', 'rules' => 'trim'];

        if(isset($_FILES['clientProfileImg']['name']) && !empty($_FILES['clientProfileImg']['name']))
            $validationRulesArr['clientProfileImg']=['label' => 'Profile Img', 'rules' => 'uploaded[clientProfileImg]|max_size[clientProfileImg,10000]|ext_in[clientProfileImg,png,jpg,jpeg]'];

        $validationRulesArr['clientContactPerson']=['label' => 'Contact Person Name', 'rules' => 'trim'];
        $validationRulesArr['clientMobile1']=['label' => 'Mobile 1', 'rules' => 'trim'];
        $validationRulesArr['clientMobile2']=['label' => 'Mobile 2', 'rules' => 'trim'];
        $validationRulesArr['clientWhatsApp']=['label' => 'Mobile (WhatsApp)', 'rules' => 'trim'];
        $validationRulesArr['clientResidencePhone']=['label' => 'Residence Phone', 'rules' => 'trim'];
        $validationRulesArr['clientOfficePhone1']=['label' => 'Office Phone 1', 'rules' => 'trim'];
        $validationRulesArr['clientOfficePhone2']=['label' => 'Office Phone 2', 'rules' => 'trim'];
        $validationRulesArr['clientFactoryPhone']=['label' => 'Factory Phone', 'rules' => 'trim'];
        $validationRulesArr['clientEmail1']=['label' => 'Email 1', 'rules' => 'trim'];
        $validationRulesArr['clientEmail2']=['label' => 'Email 2', 'rules' => 'trim'];
        $validationRulesArr['clientGroup']=['label' => 'Client Group', 'rules' => 'trim'];
        $validationRulesArr['clientCostCenter']=['label' => 'Cost Center', 'rules' => 'trim'];
        $validationRulesArr['clientCategory']=['label' => 'Category', 'rules' => 'trim'];
        $validationRulesArr['clientBussOrganisation']=['label' => 'Organisation Name', 'rules' => 'trim'];
        $validationRulesArr['clientBussOrganisationType']=['label' => 'Type of Organisation', 'rules' => 'required|trim'];
        $validationRulesArr['clientBussIncorporationDate']=['label' => 'Date of Incorporation', 'rules' => 'trim'];
        $validationRulesArr['clientBussNature']=['label' => 'Nature of Business', 'rules' => 'trim'];
        $validationRulesArr['clientBussRegisteredAddress']=['label' => 'Registered Address', 'rules' => 'trim'];
        $validationRulesArr['clientBussOfficeAddress']=['label' => 'Office Address', 'rules' => 'trim'];
        $validationRulesArr['clientBussFactoryAddress']=['label' => 'Factory Address', 'rules' => 'trim'];
        $validationRulesArr['clientBussWebsite']=['label' => 'Website URL', 'rules' => 'trim'];
        $validationRulesArr['clientBussMobile1']=['label' => 'Bussiness Mobile 1', 'rules' => 'trim'];
        $validationRulesArr['clientBussMobile2']=['label' => 'Bussiness Mobile 2', 'rules' => 'trim'];
        $validationRulesArr['clientBussWhatsApp']=['label' => 'Bussiness Mobile (WhatsApp)', 'rules' => 'trim'];
        $validationRulesArr['clientBussResidencePhone']=['label' => 'Bussiness Residence Phone', 'rules' => 'trim'];
        $validationRulesArr['clientBussOfficePhone1']=['label' => 'Bussiness Office Phone 1', 'rules' => 'trim'];
        $validationRulesArr['clientBussOfficePhone2']=['label' => 'Bussiness Office Phone 2', 'rules' => 'trim'];
        $validationRulesArr['clientBussFactoryPhone']=['label' => 'Bussiness Factory Phone', 'rules' => 'trim'];
        $validationRulesArr['clientBussEmail1']=['label' => 'Bussiness Email 1', 'rules' => 'trim'];
        $validationRulesArr['clientBussEmail2']=['label' => 'Bussiness Email 2', 'rules' => 'trim'];
        $validationRulesArr['clientRegDocument']=['label' => 'Document Registration Number', 'rules' => 'trim'];
        $validationRulesArr['clientRegDocumentIssueDate']=['label' => 'Registration Issue Date', 'rules' => 'trim'];
        $validationRulesArr['clientRegDocumentEffectiveDate']=['label' => 'Registration Effective Date', 'rules' => 'trim'];
        $validationRulesArr['clientRegDocumentFile']=['label' => 'Registration Document File', 'rules' => 'trim'];
        $validationRulesArr['clientRegDocumentMobile']=['label' => 'Registration Document Mobile', 'rules' => 'trim'];
        $validationRulesArr['clientRegDocumentEmail']=['label' => 'Registration Document Email', 'rules' => 'trim'];
        $validationRulesArr['clientRegDocumentAddress']=['label' => 'Registration Document Address', 'rules' => 'trim'];
        $validationRulesArr['clientRegDocumentRemark']=['label' => 'Registration Document Remark', 'rules' => 'trim'];
        $validationRulesArr['client_document_number[]']=['label' => 'Document Number', 'rules' => 'trim'];
        $validationRulesArr['client_document_issue_date[]']=['label' => 'Document Issue Date', 'rules' => 'trim'];
        $validationRulesArr['client_document_effective_date[]']=['label' => 'Document Effective Date', 'rules' => 'trim'];
        $validationRulesArr['client_document_file[]']=['label' => 'Document File', 'rules' => 'trim'];
        $validationRulesArr['client_document_mobile[]']=['label' => 'Document Mobile No', 'rules' => 'trim'];
        $validationRulesArr['client_document_email[]']=['label' => 'Document Email Address', 'rules' => 'trim'];
        $validationRulesArr['client_document_address[]']=['label' => 'Document Address', 'rules' => 'trim'];
        $validationRulesArr['client_document_remark[]']=['label' => 'Document Remark', 'rules' => 'trim'];
        $validationRulesArr['actId[]']=['label' => 'Act', 'rules' => 'trim'];
        $validationRulesArr['clientPersonalRemark']=['label' => 'Remark', 'rules' => 'trim'];
        $validationRulesArr['clientBussRemark']=['label' => 'Remark', 'rules' => 'trim'];
        $validationRulesArr['clientContactRemark']=['label' => 'Remark', 'rules' => 'trim'];
        $validationRulesArr['clientContactDesgtn']=['label' => 'Contact Person Designation', 'rules' => 'trim'];

        $errorArr=array();

        if(!$this->validate($validationRulesArr))
        {
            $errorArr=$this->validation->getErrors();
        }
        else
        {
            $clientTitle=$this->request->getPost('clientTitle');
            $clientName=$this->request->getPost('clientName');
            $clientFatherName=$this->request->getPost('clientFatherName');
            $clientSpouseName=$this->request->getPost('clientSpouseName');
            $clientDob=$this->request->getPost('clientDob');
            $clientPassport=$this->request->getPost('clientPassport');
            $clientBussOrganisationEmp=$this->request->getPost('clientBussOrganisationEmp');
            $clientQualification=$this->request->getPost('clientQualification');
            $clientOccupation=$this->request->getPost('clientOccupation');
            $clientResidentialAddress=$this->request->getPost('clientResidentialAddress');
            $clientProfileImg=$this->request->getFile('clientProfileImg');
            $clientMobile1=$this->request->getPost('clientMobile1');
            $clientMobile2=$this->request->getPost('clientMobile2');
            $clientWhatsApp=$this->request->getPost('clientWhatsApp');
            $clientResidencePhone=$this->request->getPost('clientResidencePhone');
            $clientOfficePhone1=$this->request->getPost('clientOfficePhone1');
            $clientOfficePhone2=$this->request->getPost('clientOfficePhone2');
            $clientFactoryPhone=$this->request->getPost('clientFactoryPhone');
            $clientEmail1=$this->request->getPost('clientEmail1');
            $clientEmail2=$this->request->getPost('clientEmail2');
            
            // if($this->request->getPost('clientBussOrganisationType')==9)
            //     $clientGroup=$this->request->getPost('clientGroupInd');
            // else
                // $clientGroup=$this->request->getPost('clientGroup');
            
            $clientGroup=$this->request->getPost('clientGroup');
            $clientCostCenter=$this->request->getPost('clientCostCenter');
            $clientCategory=$this->request->getPost('clientCategory');
            $clientBussOrganisation=$this->request->getPost('clientBussOrganisation');
            $clientBussOrganisationType=$this->request->getPost('clientBussOrganisationType');
            $clientBussIncorporationDate=$this->request->getPost('clientBussIncorporationDate');
            $clientBussNature=$this->request->getPost('clientBussNature');
            $clientBussRegisteredAddress=$this->request->getPost('clientBussRegisteredAddress');
            $clientBussOfficeAddress=$this->request->getPost('clientBussOfficeAddress');
            $clientBussFactoryAddress=$this->request->getPost('clientBussFactoryAddress');
            $clientBussWebsite=$this->request->getPost('clientBussWebsite');
            $clientContactPerson=$this->request->getPost('clientContactPerson');
            $clientBussMobile1=$this->request->getPost('clientBussMobile1');
            $clientBussMobile2=$this->request->getPost('clientBussMobile2');
            $clientBussWhatsApp=$this->request->getPost('clientBussWhatsApp');
            $clientBussResidencePhone=$this->request->getPost('clientBussResidencePhone');
            $clientBussOfficePhone1=$this->request->getPost('clientBussOfficePhone1');
            $clientBussOfficePhone2=$this->request->getPost('clientBussOfficePhone2');
            $clientBussFactoryPhone=$this->request->getPost('clientBussFactoryPhone');
            $clientBussEmail1=$this->request->getPost('clientBussEmail1');
            $clientBussEmail2=$this->request->getPost('clientBussEmail2');
            $clientRegDocument=$this->request->getPost('clientRegDocument');
            $clientRegDocumentIssueDate=$this->request->getPost('clientRegDocumentIssueDate');
            $clientRegDocumentEffectiveDate=$this->request->getPost('clientRegDocumentEffectiveDate');
            $clientRegDocumentFile=$this->request->getFile('clientRegDocumentFile');
            $clientRegDocumentMobile=$this->request->getPost('clientRegDocumentMobile');
            $clientRegDocumentEmail=$this->request->getPost('clientRegDocumentEmail');
            $clientRegDocumentAddress=$this->request->getPost('clientRegDocumentAddress');
            $clientRegDocumentRemark=$this->request->getPost('clientRegDocumentRemark');
            $client_document_number=$this->request->getPost('client_document_number[]');
            $client_document_issue_date=$this->request->getPost('client_document_issue_date[]');
            $client_document_effective_date=$this->request->getPost('client_document_effective_date[]');
            $client_document_mobile=$this->request->getPost('client_document_mobile[]');
            $client_document_email=$this->request->getPost('client_document_email[]');
            $client_document_address=$this->request->getPost('client_document_address[]');
            $client_document_remark=$this->request->getPost('client_document_remark[]');
            // $client_document_file=$this->request->getFile('client_document_file[]');
            $client_document_id=$this->request->getPost('client_document_id[]');
            $actId=$this->request->getPost('actId[]');
            $actIdArr=$this->request->getPost('actIdValue[]');
            $due_date_for_arr=$this->request->getPost('due_date_for[]');
            $due_date_id_arr=$this->request->getPost('due_date_id[]');
            $actFMthArr=$this->request->getPost('actFMth[]');
            $actFYrArr=$this->request->getPost('actFYr[]');
            $actTMthArr=$this->request->getPost('actTMth[]');
            $actTYrArr=$this->request->getPost('actTYr[]');
            $client_partner_name=$this->request->getPost('client_partner_name[]');
            $client_partner_text=$this->request->getPost('client_partner_text[]');
            $client_partner_pan=$this->request->getPost('client_partner_pan[]');
            $client_partner_aadhar=$this->request->getPost('client_partner_aadhar[]');
            $client_partner_date=$this->request->getPost('client_partner_date[]');
            $client_partner_appt_date=$this->request->getPost('client_partner_appt_date[]');
            $clientPersonalRemark=$this->request->getPost('clientPersonalRemark');
            $clientBussRemark=$this->request->getPost('clientBussRemark');
            $clientContactRemark=$this->request->getPost('clientContactRemark');
            $clientContactDesgtn=$this->request->getPost('clientContactDesgtn');

            $cust_actId_arr=$this->request->getPost('cust_actId[]');
            $non_rglr_due_state_arr=$this->request->getPost('non_rglr_due_state[]');
            $non_rglr_due_act_arr=$this->request->getPost('non_rglr_due_act[]');
            $non_rglr_due_date_for_arr=$this->request->getPost('non_rglr_due_date_for[]');
            $non_rglr_applicable_form_arr=$this->request->getPost('non_rglr_applicable_form[]');
            $non_rglr_under_section_arr=$this->request->getPost('non_rglr_under_section[]');
            $non_rglr_periodicity_arr=$this->request->getPost('non_rglr_periodicity[]');
            $non_rglr_daily_date_arr=$this->request->getPost('non_rglr_daily_date[]');
            $non_rglr_period_month_arr=$this->request->getPost('non_rglr_period_month[]');
            $non_rglr_period_year_arr=$this->request->getPost('non_rglr_period_year[]');
            $non_rglr_f_period_month_arr=$this->request->getPost('non_rglr_f_period_month[]');
            $non_rglr_f_period_year_arr=$this->request->getPost('non_rglr_f_period_year[]');
            $non_rglr_t_period_month_arr=$this->request->getPost('non_rglr_t_period_month[]');
            $non_rglr_t_period_year_arr=$this->request->getPost('non_rglr_t_period_year[]');
            $non_rglr_finYear_arr=$this->request->getPost('non_rglr_finYear[]');
            $non_rglr_due_date_arr=$this->request->getPost('non_rglr_due_date[]');
            $non_rglr_event_date_arr=$this->request->getPost('non_rglr_event_date[]');
            $non_rglr_due_notes_arr=$this->request->getPost('non_rglr_due_notes[]');

            $documentFileArr=array();
            
            if(!empty($client_document_id))
            {
                foreach($client_document_id AS $k_file=>$e_file)
                {
                    $file=$this->request->getFile('client_document_file_'.$e_file);
                    
                    $newName="";
                    if(!empty($file->getTempName()))
                    {
                        if($file->isValid() && ! $file->hasMoved())
                        {
                            $ext=$file->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);

                            $uploadPath1=$uploadPath.'/documents';

                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);

                            $newName = $file->getRandomName();
                            $file->move($uploadPath1, $newName);

                            $documentFileArr[$k_file]=$newName;
                        }
                    }
                }
            }

            $clientProfileImgPath="";
            // if(!empty($clientProfileImg->getTempName()))
            // {
            //     if($clientProfileImg->isValid() && ! $clientProfileImg->hasMoved())
            //     {
            //         $ext=$clientProfileImg->guessExtension();
            //         $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

            //         if(!is_dir($uploadPath))
            //             mkdir($uploadPath, 0777, TRUE);

            //         $uploadPath1=$uploadPath.'/documents';

            //         if(!is_dir($uploadPath1))
            //             mkdir($uploadPath1, 0777, TRUE);

            //         $newName = $clientProfileImg->getRandomName();
            //         $clientProfileImg->move($uploadPath1, $newName);

            //         $clientProfileImgPath=$newName;
            //     }
            // }

            $clientRegDocumentFilePath="";
            if(!empty($clientRegDocumentFile->getTempName()))
            {
                if($clientRegDocumentFile->isValid() && ! $clientRegDocumentFile->hasMoved())
                {
                    $ext=$clientRegDocumentFile->guessExtension();
                    $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                    if(!is_dir($uploadPath))
                        mkdir($uploadPath, 0777, TRUE);

                    $uploadPath1=$uploadPath.'/documents';

                    if(!is_dir($uploadPath1))
                        mkdir($uploadPath1, 0777, TRUE);

                    $newName = $clientRegDocumentFile->getRandomName();
                    $clientRegDocumentFile->move($uploadPath1, $newName);

                    $clientRegDocumentFilePath=$newName;
                }
            }

            $clientInsertArr[] = [
                'clientTitle'=>$clientTitle,
                'clientName'=>$clientName,
                'clientFatherName'=>$clientFatherName,
                'clientSpouseName'=>$clientSpouseName,
                'clientDob'=>$clientDob,
                'clientPassport'=>$clientPassport,
                'clientBussOrganisationEmp'=>$clientBussOrganisationEmp,
                'clientQualification'=>$clientQualification,
                'clientOccupation'=>$clientOccupation,
                'clientResidentialAddress'=>$clientResidentialAddress,
                'clientProfileImg'=>$clientProfileImgPath,
                'clientMobile1'=>$clientMobile1,
                'clientMobile2'=>$clientMobile2,
                'clientWhatsApp'=>$clientWhatsApp,
                'clientResidencePhone'=>$clientResidencePhone,
                'clientOfficePhone1'=>$clientOfficePhone1,
                'clientOfficePhone2'=>$clientOfficePhone2,
                'clientFactoryPhone'=>$clientFactoryPhone,
                'clientEmail1'=>$clientEmail1,
                'clientEmail2'=>$clientEmail2,
                'clientGroup'=>$clientGroup,
                'clientCostCenter'=>$clientCostCenter,
                'clientCategory'=>$clientCategory,
                'clientBussOrganisation'=>$clientBussOrganisation,
                'clientBussOrganisationType'=>$clientBussOrganisationType,
                'clientBussIncorporationDate'=>$clientBussIncorporationDate,
                'clientBussNature'=>$clientBussNature,
                'clientBussRegisteredAddress'=>$clientBussRegisteredAddress,
                'clientBussOfficeAddress'=>$clientBussOfficeAddress,
                'clientBussFactoryAddress'=>$clientBussFactoryAddress,
                'clientBussWebsite'=>$clientBussWebsite,
                'clientContactPerson'=>$clientContactPerson,
                'clientBussMobile1'=>$clientBussMobile1,
                'clientBussMobile2'=>$clientBussMobile2,
                'clientBussWhatsApp'=>$clientBussWhatsApp,
                'clientBussResidencePhone'=>$clientBussResidencePhone,
                'clientBussOfficePhone1'=>$clientBussOfficePhone1,
                'clientBussOfficePhone2'=>$clientBussOfficePhone2,
                'clientBussFactoryPhone'=>$clientBussFactoryPhone,
                'clientBussEmail1'=>$clientBussEmail1,
                'clientBussEmail2'=>$clientBussEmail2,
                'clientRegDocument'=>$clientRegDocument,
                'clientRegDocumentIssueDate'=>$clientRegDocumentIssueDate,
                'clientRegDocumentEffectiveDate'=>$clientRegDocumentEffectiveDate,
                'clientRegDocumentFile'=>$clientRegDocumentFilePath,
                'clientRegDocumentMobile'=>$clientRegDocumentMobile,
                'clientRegDocumentEmail'=>$clientRegDocumentEmail,
                'clientRegDocumentAddress'=>$clientRegDocumentAddress,
                'clientRegDocumentRemark'=>$clientRegDocumentRemark,
                'clientPersonalRemark'=>$clientPersonalRemark,
                'clientContactDesgtn'=>$clientContactDesgtn,
                'clientStatus'=>2,
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];

            $query=$this->Mquery->insert($tableName=$this->client_tbl, $clientInsertArr, $returnType="");
        
            $clientId=$query['lastID'];
            
            $resClientId="";
            
            if(!empty($clientId))
                $resClientId=$clientId;

            $clientPanNumber="";
            $documentInsertArr=array();
            if(!empty($client_document_id))
            {
                foreach($client_document_id AS $k_doc=>$e_doc)
                {
                    if(!empty($client_document_number[$k_doc]))
                    {
                        if(isset($client_document_number[$k_doc]))
                            $client_document_number_val=$client_document_number[$k_doc];
                        else
                            $client_document_number_val="";

                        if(isset($client_document_issue_date[$k_doc]))
                            $client_document_issue_date_val=$client_document_issue_date[$k_doc];
                        else
                            $client_document_issue_date_val="";

                        if(isset($client_document_effective_date[$k_doc]))
                            $client_document_effective_date_val=$client_document_effective_date[$k_doc];
                        else
                            $client_document_effective_date_val="";

                        if(isset($documentFileArr[$k_doc]))
                            $documentFileNameVal=$documentFileArr[$k_doc];
                        else
                            $documentFileNameVal="";
                            
                        if(isset($client_document_mobile[$k_doc]))
                            $client_document_mobile_val=$client_document_mobile[$k_doc];
                        else
                            $client_document_mobile_val="";
                            
                        if(isset($client_document_email[$k_doc]))
                            $client_document_email_val=$client_document_email[$k_doc];
                        else
                            $client_document_email_val="";
                            
                        if(isset($client_document_address[$k_doc]))
                            $client_document_address_val=$client_document_address[$k_doc];
                        else
                            $client_document_address_val="";
                            
                        if(isset($client_document_remark[$k_doc]))
                            $client_document_remark_val=$client_document_remark[$k_doc];
                        else
                            $client_document_remark_val="";

                        if($e_doc==1)
                        {
                            $clientPanNumber=$client_document_number_val;
                        }

                        $documentInsertArr[]=array(
                            'fk_client_document_id'=>$e_doc,
                            'client_document_number'=>$client_document_number_val,
                            'client_document_issue_date'=>$client_document_issue_date_val,
                            'client_document_effective_date'=>$client_document_effective_date_val,
                            'client_document_file'=>$documentFileNameVal,
                            'client_document_mobile'=>$client_document_mobile_val,
                            'client_document_email'=>$client_document_email_val,
                            'client_document_address'=>$client_document_address_val,
                            'client_document_remark'=>$client_document_remark_val,
                            'fk_client_id'=>$clientId,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        );
                    }
                }
            }

            if(!empty($documentInsertArr))
            {
                $this->Mquery->insert($tableName=$this->client_document_map_tbl, $documentInsertArr, $returnType="");

                $clientDtUpdateArr = [
                    'clientPanNumber'=>$clientPanNumber,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];

                $clientUpCondtnArr['client_tbl.clientId']=$clientId;

                $query=$this->Mquery->updateData($tableName=$this->client_tbl, $clientDtUpdateArr, $clientUpCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
            }

            $actInsertArr=array();
            if(!empty($actId))
            {
                foreach($actId AS $e_act)
                {
                    $actInsertArr[]=array(
                        'fkActId'=>$e_act,
                        'fkClientId'=>$clientId,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    );
                }
            }

            if(!empty($actInsertArr))
                $this->Mquery->insert($tableName=$this->client_act_map_tbl, $actInsertArr, $returnType="");

            if(!empty($due_date_id_arr))
            {
                foreach($due_date_id_arr AS $e_dd_id)
                {
                    $uniqueId=strtoupper(substr(str_shuffle(uniqid()), 0, 4));

                    $workCode="WORKID_".$uniqueId;

                    $workInsertArr[] = [
                        'workCode'=>$workCode,
                        'fk_due_date_id'=>$e_dd_id,
                        'fkClientId'=>$clientId,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    ];
                }
                
                if(!empty($workInsertArr))
                {
                    $this->Mquery->insert($tableName=$this->work_tbl, $workInsertArr, $returnType="");

                    $clientStUpdateArr = [
                        'clientStatus'=>1,
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
        
                    $clientStCondtnArr['client_tbl.clientId']=$clientId;
        
                    $query=$this->Mquery->updateData($tableName=$this->client_tbl, $clientStUpdateArr, $clientStCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }
            }
            
            $taxPaymentInsertArr=array();
            
            if(!empty($due_date_for_arr))
            {
                foreach($due_date_for_arr AS $k_ddf=>$e_ddf)
                {
                    $taxActId=$actIdArr[$k_ddf];
                    $taxDueDateId=$due_date_id_arr[$k_ddf];
                    
                    $retMthFrom=$actFMthArr[$k_ddf];
                    $retYrFrom=$actFYrArr[$k_ddf];
                    $retMthTo=$actTMthArr[$k_ddf];
                    $retYrTo=$actTYrArr[$k_ddf];
                    
                    if($e_ddf==75 || $e_ddf==76 || $e_ddf==148 || $e_ddf==149 || $e_ddf==151 || $e_ddf==152 || $e_ddf==154 || $e_ddf==155 || $e_ddf==156 || $e_ddf==260)
                    {
                        $taxPaymentInsertArr[] = [
                            'fkActId'=>$taxActId,
                            'fkDueDateId'=>$taxDueDateId,
                            'fkClientId'=>$clientId,
                            'retMthFrom'=>$retMthFrom,
                            'retYrFrom'=>$retYrFrom,
                            'retMthTo'=>$retMthTo,
                            'retYrTo'=>$retYrTo,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        ];
                    }
                }
                
                if(!empty($taxPaymentInsertArr))
                    $this->Mquery->insert($tableName=$this->tax_payment_tbl, $taxPaymentInsertArr, $returnType="");
            }

            $cliPartInsertArr=array();
            if(!empty($client_partner_name))
            {
                foreach($client_partner_name AS $k_cli_pt=>$e_cli_pt)
                {
                    if(!empty($client_partner_name[$k_cli_pt]))
                    {
                        if(isset($client_partner_name[$k_cli_pt]))
                            $client_partner_name_val=$client_partner_name[$k_cli_pt];
                        else
                            $client_partner_name_val="";

                        if(isset($client_partner_text[$k_cli_pt]))
                            $client_partner_text_val=$client_partner_text[$k_cli_pt];
                        else
                            $client_partner_text_val="";

                        if(isset($client_partner_pan[$k_cli_pt]))
                            $client_partner_pan_val=$client_partner_pan[$k_cli_pt];
                        else
                            $client_partner_pan_val="";
                            
                        if(isset($client_partner_aadhar[$k_cli_pt]))
                            $client_partner_aadhar_val=$client_partner_aadhar[$k_cli_pt];
                        else
                            $client_partner_aadhar_val="";

                        if(isset($client_partner_date[$k_cli_pt]))
                            $client_partner_date_val=date('Y-m-d', strtotime($client_partner_date[$k_cli_pt]));
                        else
                            $client_partner_date_val="";

                        if(isset($client_partner_appt_date[$k_cli_pt]))
                            $client_partner_appt_date_val=date('Y-m-d', strtotime($client_partner_appt_date[$k_cli_pt]));
                        else
                            $client_partner_appt_date_val="";

                        $cliPartInsertArr[]=array(
                            'client_partner_name'=>$client_partner_name_val,
                            'client_partner_text'=>$client_partner_text_val,
                            'client_partner_pan'=>$client_partner_pan_val,
                            'client_partner_aadhar'=>$client_partner_aadhar_val,
                            'client_partner_date'=>$client_partner_date_val,
                            'client_partner_appt_date'=>$client_partner_appt_date_val,
                            'fkClientId'=>$clientId,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        );
                    }
                }
            }

            if(!empty($cliPartInsertArr))
                $this->Mquery->insert($tableName=$this->client_partner_tbl, $cliPartInsertArr, $returnType="");
                
            $sbGrpArr=$this->Mcontsubgroup->where('fk_cont_group_id', 1)->findAll();
	    
    	    $sbGrpArray=array();
    	    
    	    if(!empty($sbGrpArr))
    	    {
    	        foreach($sbGrpArr AS $e_row)
    	        {
    	            $sbGrpArray[$e_row['refId']]=$e_row['cont_sub_group_id'];
    	        }
    	    }
    	    
    	    $clientDataArr=$this->Mclient->where('clientId', $clientId)->where('status', 1)->get()->getRowArray();
    	    
    	    if(!empty($clientDataArr))
    	    {
    	        $contGroupId=1;
	            
	            if(!empty($sbGrpArray[$clientDataArr['clientGroup']]))
                    $contSubGroupId=$sbGrpArray[$clientDataArr['clientGroup']];
                else
                    $contSubGroupId="";
                
                if($clientDataArr['clientBussOrganisationType']==9) // Individual
                {
                    $contFullName=$clientDataArr['clientName'];
                    $contOrgName="";
                    $contMob1=$clientDataArr['clientBussMobile1'];
                    $contMob2=$clientDataArr['clientBussMobile2'];
                    $contEmail=$clientDataArr['clientBussEmail1'];
                    $contResiAddress=$clientDataArr['clientResidentialAddress'];
                    $contResiNum=$clientDataArr['clientBussResidencePhone'];
                    $contOfficeAddress=$clientDataArr['clientBussOfficeAddress'];
                    $contOfficeNum=$clientDataArr['clientBussOfficePhone1'];
                    $contRegOffice=$clientDataArr['clientBussRegisteredAddress'];
                    $contRegOfficeNum=$clientDataArr['clientBussOfficePhone2'];
                    $contFactOffice=$clientDataArr['clientBussFactoryAddress'];
                    $contFactNum=$clientDataArr['clientBussFactoryPhone'];
                    $contRefId=$clientDataArr['clientId'];
                }
                elseif($clientDataArr['clientBussOrganisationType']==8 || $clientDataArr['clientBussOrganisationType']==3) // Proprietory, OPC
                {
                    $contFullName=$clientDataArr['clientName'];
                    $contOrgName=$clientDataArr['clientBussOrganisation'];
                    $contMob1=$clientDataArr['clientBussMobile1'];
                    $contMob2=$clientDataArr['clientBussMobile2'];
                    $contEmail=$clientDataArr['clientBussEmail1'];
                    $contResiAddress=$clientDataArr['clientResidentialAddress'];
                    $contResiNum=$clientDataArr['clientBussResidencePhone'];
                    $contOfficeAddress=$clientDataArr['clientBussOfficeAddress'];
                    $contOfficeNum=$clientDataArr['clientBussOfficePhone1'];
                    $contRegOffice=$clientDataArr['clientBussRegisteredAddress'];
                    $contRegOfficeNum=$clientDataArr['clientBussOfficePhone2'];
                    $contFactOffice=$clientDataArr['clientBussFactoryAddress'];
                    $contFactNum=$clientDataArr['clientBussFactoryPhone'];
                    $contRefId=$clientDataArr['clientId'];
                }
                elseif($clientDataArr['clientBussOrganisationType']!=9 && $clientDataArr['clientBussOrganisationType']!=8 && $clientDataArr['clientBussOrganisationType']!=3) // Other Than Individual
                {
                    $contFullName=$clientDataArr['clientContactPerson'];
                    $contOrgName=$clientDataArr['clientBussOrganisation'];
                    $contMob1=$clientDataArr['clientBussMobile1'];
                    $contMob2=$clientDataArr['clientBussMobile2'];
                    $contEmail=$clientDataArr['clientBussEmail1'];
                    $contResiAddress=$clientDataArr['clientResidentialAddress'];
                    $contResiNum=$clientDataArr['clientBussResidencePhone'];
                    $contOfficeAddress=$clientDataArr['clientBussOfficeAddress'];
                    $contOfficeNum=$clientDataArr['clientBussOfficePhone1'];
                    $contRegOffice=$clientDataArr['clientBussRegisteredAddress'];
                    $contRegOfficeNum=$clientDataArr['clientBussOfficePhone2'];
                    $contFactOffice=$clientDataArr['clientBussFactoryAddress'];
                    $contFactNum=$clientDataArr['clientBussFactoryPhone'];
                    $contRefId=$clientDataArr['clientId'];
                }
                
                $contactInsertArr=[
                    'contGroupId'=>$contGroupId,
                    'contSubGroupId'=>$contSubGroupId,
                    'contFullName'=>$contFullName,
                    'contOrgName'=>$contOrgName,
                    'contMob1'=>$contMob1,
                    'contMob2'=>$contMob2,
                    'contEmail'=>$contEmail,
                    'contResiAddress'=>$contResiAddress,
                    'contResiNum'=>$contResiNum,
                    'contOfficeAddress'=>$contOfficeAddress,
                    'contOfficeNum'=>$contOfficeNum,
                    'contRegOffice'=>$contRegOffice,
                    'contRegOfficeNum'=>$contRegOfficeNum,
                    'contFactOffice'=>$contFactOffice,
                    'contFactNum'=>$contFactNum,
                    'contRefId'=>$contRefId,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];
        	    
        	    $this->Mcontact->save($contactInsertArr);
    	    }

            $non_rglr_due_date_insert_array=array();

            if(!empty($cust_actId_arr))
            {
                foreach($cust_actId_arr AS $k_cust_act=>$e_cust_act)
                {
                    $non_rglr_due_state=(isset($non_rglr_due_state_arr[$k_cust_act])) ? $non_rglr_due_state_arr[$k_cust_act] : "";
                    $non_rglr_due_act=(isset($non_rglr_due_act_arr[$k_cust_act])) ? $non_rglr_due_act_arr[$k_cust_act] : "";
                    $non_rglr_due_date_for=(isset($non_rglr_due_date_for_arr[$k_cust_act])) ? $non_rglr_due_date_for_arr[$k_cust_act] : "";
                    $non_rglr_applicable_form=(isset($non_rglr_applicable_form_arr[$k_cust_act])) ? $non_rglr_applicable_form_arr[$k_cust_act] : "";
                    $non_rglr_under_section=(isset($non_rglr_under_section_arr[$k_cust_act])) ? $non_rglr_under_section_arr[$k_cust_act] : "";
                    $non_rglr_periodicity=(isset($non_rglr_periodicity_arr[$k_cust_act])) ? $non_rglr_periodicity_arr[$k_cust_act] : "";
                    $non_rglr_daily_date=(isset($non_rglr_daily_date_arr[$k_cust_act])) ? $non_rglr_daily_date_arr[$k_cust_act] : "";
                    $non_rglr_period_month=(isset($non_rglr_period_month_arr[$k_cust_act])) ? $non_rglr_period_month_arr[$k_cust_act] : "";
                    $non_rglr_period_year=(isset($non_rglr_period_year_arr[$k_cust_act])) ? $non_rglr_period_year_arr[$k_cust_act] : "";
                    $non_rglr_f_period_month=(isset($non_rglr_f_period_month_arr[$k_cust_act])) ? $non_rglr_f_period_month_arr[$k_cust_act] : "";
                    $non_rglr_f_period_year=(isset($non_rglr_f_period_year_arr[$k_cust_act])) ? $non_rglr_f_period_year_arr[$k_cust_act] : "";
                    $non_rglr_t_period_month=(isset($non_rglr_t_period_month_arr[$k_cust_act])) ? $non_rglr_t_period_month_arr[$k_cust_act] : "";
                    $non_rglr_t_period_year=(isset($non_rglr_t_period_year_arr[$k_cust_act])) ? $non_rglr_t_period_year_arr[$k_cust_act] : "";
                    $non_rglr_finYear=(isset($non_rglr_finYear_arr[$k_cust_act])) ? $non_rglr_finYear_arr[$k_cust_act] : "";
                    $non_rglr_due_date=(isset($non_rglr_due_date_arr[$k_cust_act])) ? $non_rglr_due_date_arr[$k_cust_act] : "";
                    $non_rglr_event_date=(isset($non_rglr_event_date_arr[$k_cust_act])) ? $non_rglr_event_date_arr[$k_cust_act] : "";
                    $non_rglr_due_notes=(isset($non_rglr_due_notes_arr[$k_cust_act])) ? $non_rglr_due_notes_arr[$k_cust_act] : "";

                    $non_rglr_due_date_insert_array[]=array(
                        "non_rglr_due_state" => $non_rglr_due_state,
                        "non_rglr_due_act" => $non_rglr_due_act,
                        "non_rglr_due_date_for" => $non_rglr_due_date_for,
                        "non_rglr_applicable_form" => $non_rglr_applicable_form,
                        "non_rglr_under_section" => $non_rglr_under_section,
                        "non_rglr_periodicity" => $non_rglr_periodicity,
                        "non_rglr_daily_date" => $non_rglr_daily_date,
                        "non_rglr_period_month" => $non_rglr_period_month,
                        "non_rglr_period_year" => $non_rglr_period_year,
                        "non_rglr_f_period_month" => $non_rglr_f_period_month,
                        "non_rglr_f_period_year" => $non_rglr_f_period_year,
                        "non_rglr_t_period_month" => $non_rglr_t_period_month,
                        "non_rglr_t_period_year" => $non_rglr_t_period_year,
                        "non_rglr_finYear" => $non_rglr_finYear,
                        "non_rglr_due_date" => $non_rglr_due_date,
                        "non_rglr_event_date" => $non_rglr_event_date,
                        "non_rglr_due_notes" => $non_rglr_due_notes,
                        'fkClientId'=>$clientId,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    );
                }
            }

            if(!empty($non_rglr_due_date_insert_array)){
                $this->Mquery->insert($tableName=$this->non_regular_due_date_tbl, $non_rglr_due_date_insert_array, $returnType="");
            }
        }

        if($this->db->transStatus() === FALSE || !empty($errorArr)){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="Client has not added :(";
            $responseArr['userdata']=$errorArr;
            $responseArr['clientId']="";

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client has been added successfully :)";
            $responseArr['userdata']=$errorArr;
            $responseArr['clientId']=$resClientId;

            $this->session->setFlashdata('successMsg', "Client has been added successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function update_client()
    {
        $this->db->transBegin();

        $validationRulesArr['edit_clientTitle']=['label' => 'Client Title', 'rules' => 'trim'];
        $validationRulesArr['edit_clientName']=['label' => 'Client Name', 'rules' => 'trim'];
        $validationRulesArr['edit_clientFatherName']=['label' => 'Father Name', 'rules' => 'trim'];
        $validationRulesArr['edit_clientSpouseName']=['label' => 'Spouse Name', 'rules' => 'trim'];
        $validationRulesArr['edit_clientDob']=['label' => 'Date of Birth', 'rules' => 'trim'];
        $validationRulesArr['edit_clientPassport']=['label' => 'Passport', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussOrganisationEmp']=['label' => 'Organisation Name (Employed With)', 'rules' => 'trim'];
        $validationRulesArr['edit_clientQualification']=['label' => 'Qualification', 'rules' => 'trim'];
        $validationRulesArr['edit_clientOccupation']=['label' => 'Occupation', 'rules' => 'trim'];
        $validationRulesArr['edit_clientResidentialAddress']=['label' => 'Residential Address', 'rules' => 'trim'];

        if(isset($_FILES['edit_clientProfileImg']['name']) && !empty($_FILES['edit_clientProfileImg']['name']))
            $validationRulesArr['edit_clientProfileImg']=['label' => 'Profile Img', 'rules' => 'uploaded[edit_clientProfileImg]|max_size[edit_clientProfileImg,10000]|ext_in[edit_clientProfileImg,png,jpg,jpeg]'];

        $validationRulesArr['edit_clientMobile1']=['label' => 'Mobile 1', 'rules' => 'trim'];
        $validationRulesArr['edit_clientMobile2']=['label' => 'Mobile 2', 'rules' => 'trim'];
        $validationRulesArr['edit_clientWhatsApp']=['label' => 'Mobile (WhatsApp)', 'rules' => 'trim'];
        $validationRulesArr['edit_clientResidencePhone']=['label' => 'Residence Phone', 'rules' => 'trim'];
        $validationRulesArr['edit_clientOfficePhone1']=['label' => 'Office Phone 1', 'rules' => 'trim'];
        $validationRulesArr['edit_clientOfficePhone2']=['label' => 'Office Phone 2', 'rules' => 'trim'];
        $validationRulesArr['edit_clientFactoryPhone']=['label' => 'Factory Phone', 'rules' => 'trim'];
        $validationRulesArr['edit_clientEmail1']=['label' => 'Email 1', 'rules' => 'trim'];
        $validationRulesArr['edit_clientEmail2']=['label' => 'Email 2', 'rules' => 'trim'];
        $validationRulesArr['edit_clientGroup']=['label' => 'Client Group', 'rules' => 'trim'];
        $validationRulesArr['edit_clientCostCenter']=['label' => 'Cost Center', 'rules' => 'trim'];
        $validationRulesArr['edit_clientCategory']=['label' => 'Category', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussOrganisation']=['label' => 'Organisation Name', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussOrganisationType']=['label' => 'Type of Organisation', 'rules' => 'required|trim'];
        $validationRulesArr['edit_clientBussIncorporationDate']=['label' => 'Date of Incorporation', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussNature']=['label' => 'Nature of Business', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussRegisteredAddress']=['label' => 'Registered Address', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussOfficeAddress']=['label' => 'Office Address', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussFactoryAddress']=['label' => 'Factory Address', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussWebsite']=['label' => 'Website URL', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussMobile1']=['label' => 'Bussiness Mobile 1', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussMobile2']=['label' => 'Bussiness Mobile 2', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussWhatsApp']=['label' => 'Bussiness Mobile (WhatsApp)', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussResidencePhone']=['label' => 'Bussiness Residence Phone', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussOfficePhone1']=['label' => 'Bussiness Office Phone 1', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussOfficePhone2']=['label' => 'Bussiness Office Phone 2', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussFactoryPhone']=['label' => 'Bussiness Factory Phone', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussEmail1']=['label' => 'Bussiness Email 1', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussEmail2']=['label' => 'Bussiness Email 2', 'rules' => 'trim'];
        $validationRulesArr['edit_clientRegDocument']=['label' => 'Document Registration Number', 'rules' => 'trim'];
        $validationRulesArr['edit_clientRegDocumentIssueDate']=['label' => 'Registration Issue Date', 'rules' => 'trim'];
        $validationRulesArr['edit_clientRegDocumentEffectiveDate']=['label' => 'Registration Effective Date', 'rules' => 'trim'];
        $validationRulesArr['edit_clientRegDocumentFile']=['label' => 'Registration Document File', 'rules' => 'trim'];
        $validationRulesArr['edit_clientRegDocumentMobile']=['label' => 'Registration Document Mobile', 'rules' => 'trim'];
        $validationRulesArr['edit_clientRegDocumentEmail']=['label' => 'Registration Document Email', 'rules' => 'trim'];
        $validationRulesArr['edit_clientRegDocumentAddress']=['label' => 'Registration Document Address', 'rules' => 'trim'];
        $validationRulesArr['edit_clientRegDocumentRemark']=['label' => 'Registration Document Remark', 'rules' => 'trim'];
        $validationRulesArr['edit_client_document_number[]']=['label' => 'Document Number', 'rules' => 'trim'];
        $validationRulesArr['edit_client_document_issue_date[]']=['label' => 'Document Issue Date', 'rules' => 'trim'];
        $validationRulesArr['edit_client_document_effective_date[]']=['label' => 'Document Effective Date', 'rules' => 'trim'];
        $validationRulesArr['edit_client_document_file[]']=['label' => 'Document File', 'rules' => 'trim'];
        $validationRulesArr['edit_client_document_mobile[]']=['label' => 'Document Mobile No', 'rules' => 'trim'];
        $validationRulesArr['edit_client_document_email[]']=['label' => 'Document Email Address', 'rules' => 'trim'];
        $validationRulesArr['edit_client_document_address[]']=['label' => 'Document Address', 'rules' => 'trim'];
        $validationRulesArr['edit_client_document_remark[]']=['label' => 'Document Remark', 'rules' => 'trim'];
        $validationRulesArr['edit_actId[]']=['label' => 'Act', 'rules' => 'trim'];
        $validationRulesArr['edit_clientPersonalRemark']=['label' => 'Remark', 'rules' => 'trim'];
        $validationRulesArr['edit_clientBussRemark']=['label' => 'Remark', 'rules' => 'trim'];
        $validationRulesArr['edit_clientContactRemark']=['label' => 'Remark', 'rules' => 'trim'];
        $validationRulesArr['edit_clientContactDesgtn']=['label' => 'Contact Person Designation', 'rules' => 'trim'];

        $errorArr=array();

        if(!$this->validate($validationRulesArr))
        {
            $errorArr=$this->validation->getErrors();
        }
        else
        {
            $clientId=$this->request->getPost('clientId');
            $clientTitle=$this->request->getPost('edit_clientTitle');
            $clientName=$this->request->getPost('edit_clientName');
            $clientFatherName=$this->request->getPost('edit_clientFatherName');
            $clientSpouseName=$this->request->getPost('edit_clientSpouseName');
            $clientDob=$this->request->getPost('edit_clientDob');
            $clientPassport=$this->request->getPost('edit_clientPassport');
            $clientBussOrganisationEmp=$this->request->getPost('edit_clientBussOrganisationEmp');
            $clientQualification=$this->request->getPost('edit_clientQualification');
            $clientOccupation=$this->request->getPost('edit_clientOccupation');
            $clientResidentialAddress=$this->request->getPost('edit_clientResidentialAddress');
            $clientProfileImg=$this->request->getFile('edit_clientProfileImg');
            $clientProfileOldImg=$this->request->getPost('edit_clientProfileOldImg');
            $clientMobile1=$this->request->getPost('edit_clientMobile1');
            $clientMobile2=$this->request->getPost('edit_clientMobile2');
            $clientWhatsApp=$this->request->getPost('edit_clientWhatsApp');
            $clientResidencePhone=$this->request->getPost('edit_clientResidencePhone');
            $clientOfficePhone1=$this->request->getPost('edit_clientOfficePhone1');
            $clientOfficePhone2=$this->request->getPost('edit_clientOfficePhone2');
            $clientFactoryPhone=$this->request->getPost('edit_clientFactoryPhone');
            $clientEmail1=$this->request->getPost('edit_clientEmail1');
            $clientEmail2=$this->request->getPost('edit_clientEmail2');
            // $clientGroup=$this->request->getPost('edit_clientGroup');
            
            // if($this->request->getPost('edit_clientBussOrganisationType')==9)
            //     $clientGroup=$this->request->getPost('edit_clientGroupInd');
            // else
            //     $clientGroup=$this->request->getPost('edit_clientGroup');
            
            $clientGroup=$this->request->getPost('edit_clientGroup');
            $clientCostCenter=$this->request->getPost('edit_clientCostCenter');
            $clientCategory=$this->request->getPost('edit_clientCategory');
            $clientBussOrganisation=$this->request->getPost('edit_clientBussOrganisation');
            $clientBussOrganisationType=$this->request->getPost('edit_clientBussOrganisationType');
            $clientBussIncorporationDate=$this->request->getPost('edit_clientBussIncorporationDate');
            $clientBussNature=$this->request->getPost('edit_clientBussNature');
            $clientBussRegisteredAddress=$this->request->getPost('edit_clientBussRegisteredAddress');
            $clientBussOfficeAddress=$this->request->getPost('edit_clientBussOfficeAddress');
            $clientBussFactoryAddress=$this->request->getPost('edit_clientBussFactoryAddress');
            $clientBussWebsite=$this->request->getPost('edit_clientBussWebsite');
            $clientContactPerson=$this->request->getPost('clientContactPerson');
            $clientBussMobile1=$this->request->getPost('edit_clientBussMobile1');
            $clientBussMobile2=$this->request->getPost('edit_clientBussMobile2');
            $clientBussWhatsApp=$this->request->getPost('edit_clientBussWhatsApp');
            $clientBussResidencePhone=$this->request->getPost('edit_clientBussResidencePhone');
            $clientBussOfficePhone1=$this->request->getPost('edit_clientBussOfficePhone1');
            $clientBussOfficePhone2=$this->request->getPost('edit_clientBussOfficePhone2');
            $clientBussFactoryPhone=$this->request->getPost('edit_clientBussFactoryPhone');
            $clientBussEmail1=$this->request->getPost('edit_clientBussEmail1');
            $clientBussEmail2=$this->request->getPost('edit_clientBussEmail2');
            $clientRegDocument=$this->request->getPost('edit_clientRegDocument');
            $clientRegDocumentIssueDate=$this->request->getPost('edit_clientRegDocumentIssueDate');
            $clientRegDocumentEffectiveDate=$this->request->getPost('edit_clientRegDocumentEffectiveDate');
            $clientRegDocumentFile=$this->request->getFile('edit_clientRegDocumentFile');
            $clientRegDocumentOldFile=$this->request->getPost('edit_clientRegDocumentOldFile');
            $clientRegDocumentMobile=$this->request->getPost('edit_clientRegDocumentMobile');
            $clientRegDocumentEmail=$this->request->getPost('edit_clientRegDocumentEmail');
            $clientRegDocumentAddress=$this->request->getPost('edit_clientRegDocumentAddress');
            $clientRegDocumentRemark=$this->request->getPost('edit_clientRegDocumentRemark');
            $client_document_number=$this->request->getPost('edit_client_document_number[]');
            $client_document_issue_date=$this->request->getPost('edit_client_document_issue_date[]');
            $client_document_effective_date=$this->request->getPost('edit_client_document_effective_date[]');
            $client_document_mobile=$this->request->getPost('edit_client_document_mobile[]');
            $client_document_email=$this->request->getPost('edit_client_document_email[]');
            $client_document_address=$this->request->getPost('edit_client_document_address[]');
            $client_document_remark=$this->request->getPost('edit_client_document_remark[]');
            // $client_document_file=$this->request->getFile('edit_client_document_file[]');
            // $edit_client_document_old_file=$this->request->getPost('edit_client_document_old_file[]');
            $client_document_id=$this->request->getPost('edit_client_document_id[]');
            $actId=$this->request->getPost('edit_actId[]');
            $actIdArr=$this->request->getPost('actIdValue[]');
            $due_date_for_arr=$this->request->getPost('due_date_for[]');
            $due_date_id_arr=$this->request->getPost('due_date_id[]');
            $actFMthArr=$this->request->getPost('actFMth[]');
            $actFYrArr=$this->request->getPost('actFYr[]');
            $actTMthArr=$this->request->getPost('actTMth[]');
            $actTYrArr=$this->request->getPost('actTYr[]');
            $edit_client_partner_id=$this->request->getPost('client_partner_id[]');
            $edit_client_partner_name=$this->request->getPost('edit_client_partner_name[]');
            $edit_client_partner_text=$this->request->getPost('edit_client_partner_text[]');
            $edit_client_partner_pan=$this->request->getPost('edit_client_partner_pan[]');
            $edit_client_partner_aadhar=$this->request->getPost('edit_client_partner_aadhar[]');
            $edit_client_partner_date=$this->request->getPost('edit_client_partner_date[]');
            $edit_client_partner_appt_date=$this->request->getPost('edit_client_partner_appt_date[]');
            
            $client_partner_name=$this->request->getPost('client_partner_name[]');
            $client_partner_text=$this->request->getPost('client_partner_text[]');
            $client_partner_pan=$this->request->getPost('client_partner_pan[]');
            $client_partner_aadhar=$this->request->getPost('client_partner_aadhar[]');
            $client_partner_date=$this->request->getPost('client_partner_date[]');
            $client_partner_appt_date=$this->request->getPost('client_partner_appt_date[]');
            
            $clientPersonalRemark=$this->request->getPost('edit_clientPersonalRemark');
            $clientBussRemark=$this->request->getPost('edit_clientBussRemark');
            $clientContactRemark=$this->request->getPost('edit_clientContactRemark');
            $clientContactDesgtn=$this->request->getPost('edit_clientContactDesgtn');

            $non_rglr_due_date_id_arr=$this->request->getPost('non_rglr_due_date_id[]');
            $cust_actId_arr=$this->request->getPost('cust_actId[]');
            $non_rglr_due_state_arr=$this->request->getPost('non_rglr_due_state[]');
            $non_rglr_due_act_arr=$this->request->getPost('non_rglr_due_act[]');
            $non_rglr_due_date_for_arr=$this->request->getPost('non_rglr_due_date_for[]');
            $non_rglr_applicable_form_arr=$this->request->getPost('non_rglr_applicable_form[]');
            $non_rglr_under_section_arr=$this->request->getPost('non_rglr_under_section[]');
            $non_rglr_periodicity_arr=$this->request->getPost('non_rglr_periodicity[]');
            $non_rglr_daily_date_arr=$this->request->getPost('non_rglr_daily_date[]');
            $non_rglr_period_month_arr=$this->request->getPost('non_rglr_period_month[]');
            $non_rglr_period_year_arr=$this->request->getPost('non_rglr_period_year[]');
            $non_rglr_f_period_month_arr=$this->request->getPost('non_rglr_f_period_month[]');
            $non_rglr_f_period_year_arr=$this->request->getPost('non_rglr_f_period_year[]');
            $non_rglr_t_period_month_arr=$this->request->getPost('non_rglr_t_period_month[]');
            $non_rglr_t_period_year_arr=$this->request->getPost('non_rglr_t_period_year[]');
            $non_rglr_finYear_arr=$this->request->getPost('non_rglr_finYear[]');
            $non_rglr_due_date_arr=$this->request->getPost('non_rglr_due_date[]');
            $non_rglr_event_date_arr=$this->request->getPost('non_rglr_event_date[]');
            $non_rglr_due_notes_arr=$this->request->getPost('non_rglr_due_notes[]');

            // print_r($clientRegDocumentFile);
            // print_r($client_document_file);
            // print_r($edit_client_document_old_file);
            // die();
            
            $documentFileArr=array();

            if(!empty($client_document_id))
            {
                foreach($client_document_id AS $k_file=>$e_file)
                {
                    $file=$this->request->getFile('edit_client_document_file_'.$e_file);
                    
                    $newName="";
                    if(!empty($file->getTempName()))
                    {
                        if($file->isValid() && ! $file->hasMoved())
                        {
                            $ext=$file->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);

                            $uploadPath1=$uploadPath.'/documents';

                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);

                            $newName = $file->getRandomName();
                            $file->move($uploadPath1, $newName);

                            $documentFileArr[$k_file]=$newName;
                        }
                    }
                }
            }

            $clientProfileImgPath="";
            // if(!empty($clientProfileImg->getTempName()))
            // {
            //     if($clientProfileImg->isValid() && ! $clientProfileImg->hasMoved())
            //     {
            //         $ext=$clientProfileImg->guessExtension();
            //         if($ext=="jpg" || $ext=="jpeg" || $ext=="png")
            //         {
            //             $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

            //             if(!is_dir($uploadPath))
            //                 mkdir($uploadPath, 0777, TRUE);

            //             $uploadPath1=$uploadPath.'/documents';

            //             if(!is_dir($uploadPath1))
            //                 mkdir($uploadPath1, 0777, TRUE);

            //             $newName = $clientProfileImg->getRandomName();
            //             $clientProfileImg->move($uploadPath1, $newName);

            //             $clientProfileImgPath=$newName;
            //         }
            //     }
            // }

            if(empty($clientProfileImgPath))
                $clientProfileImgPath=$clientProfileOldImg;

            $clientRegDocumentFilePath="";
            if(!empty($clientRegDocumentFile->getTempName()))
            {
                if($clientRegDocumentFile->isValid() && ! $clientRegDocumentFile->hasMoved())
                {
                    $ext=$clientRegDocumentFile->guessExtension();
                    $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                    if(!is_dir($uploadPath))
                        mkdir($uploadPath, 0777, TRUE);

                    $uploadPath1=$uploadPath.'/documents';

                    if(!is_dir($uploadPath1))
                        mkdir($uploadPath1, 0777, TRUE);

                    $newName = $clientRegDocumentFile->getRandomName();
                    $clientRegDocumentFile->move($uploadPath1, $newName);

                    $clientRegDocumentFilePath=$newName;
                }
            }

            if(empty($clientRegDocumentFilePath))
                $clientRegDocumentFilePath=$clientRegDocumentOldFile;

            $clientUpdateArr = [
                'clientTitle'=>$clientTitle,
                'clientName'=>$clientName,
                'clientFatherName'=>$clientFatherName,
                'clientSpouseName'=>$clientSpouseName,
                'clientDob'=>$clientDob,
                'clientPassport'=>$clientPassport,
                'clientBussOrganisationEmp'=>$clientBussOrganisationEmp,
                'clientQualification'=>$clientQualification,
                'clientOccupation'=>$clientOccupation,
                'clientResidentialAddress'=>$clientResidentialAddress,
                'clientProfileImg'=>$clientProfileImgPath,
                'clientMobile1'=>$clientMobile1,
                'clientMobile2'=>$clientMobile2,
                'clientWhatsApp'=>$clientWhatsApp,
                'clientResidencePhone'=>$clientResidencePhone,
                'clientOfficePhone1'=>$clientOfficePhone1,
                'clientOfficePhone2'=>$clientOfficePhone2,
                'clientFactoryPhone'=>$clientFactoryPhone,
                'clientEmail1'=>$clientEmail1,
                'clientEmail2'=>$clientEmail2,
                'clientGroup'=>$clientGroup,
                'clientCostCenter'=>$clientCostCenter,
                'clientCategory'=>$clientCategory,
                'clientBussOrganisation'=>$clientBussOrganisation,
                'clientBussOrganisationType'=>$clientBussOrganisationType,
                'clientBussIncorporationDate'=>$clientBussIncorporationDate,
                'clientBussNature'=>$clientBussNature,
                'clientBussRegisteredAddress'=>$clientBussRegisteredAddress,
                'clientBussOfficeAddress'=>$clientBussOfficeAddress,
                'clientBussFactoryAddress'=>$clientBussFactoryAddress,
                'clientBussWebsite'=>$clientBussWebsite,
                'clientContactPerson'=>$clientContactPerson,
                'clientBussMobile1'=>$clientBussMobile1,
                'clientBussMobile2'=>$clientBussMobile2,
                'clientBussWhatsApp'=>$clientBussWhatsApp,
                'clientBussResidencePhone'=>$clientBussResidencePhone,
                'clientBussOfficePhone1'=>$clientBussOfficePhone1,
                'clientBussOfficePhone2'=>$clientBussOfficePhone2,
                'clientBussFactoryPhone'=>$clientBussFactoryPhone,
                'clientBussEmail1'=>$clientBussEmail1,
                'clientBussEmail2'=>$clientBussEmail2,
                'clientRegDocument'=>$clientRegDocument,
                'clientRegDocumentIssueDate'=>$clientRegDocumentIssueDate,
                'clientRegDocumentEffectiveDate'=>$clientRegDocumentEffectiveDate,
                'clientRegDocumentFile'=>$clientRegDocumentFilePath,
                'clientRegDocumentMobile'=>$clientRegDocumentMobile,
                'clientRegDocumentEmail'=>$clientRegDocumentEmail,
                'clientRegDocumentAddress'=>$clientRegDocumentAddress,
                'clientRegDocumentRemark'=>$clientRegDocumentRemark,
                'clientPersonalRemark'=>$clientPersonalRemark,
                'clientBussRemark'=>$clientBussRemark,
                'clientContactRemark'=>$clientContactRemark,
                'clientContactDesgtn'=>$clientContactDesgtn,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];

            $clientCondtnArr['client_tbl.clientId']=$clientId;

            $query=$this->Mquery->updateData($tableName=$this->client_tbl, $clientUpdateArr, $clientCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

            $documentInsertArr=array();
            $clientPanNumber="";

            if(!empty($client_document_id))
            {
                $clientDocUpdateArr = [
                    'status' => 2,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];

                $clientDocCondtnArr['client_document_map_tbl.fk_client_id']=$clientId;

                $query=$this->Mquery->updateData($tableName=$this->client_document_map_tbl, $clientDocUpdateArr, $clientDocCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
            
                foreach($client_document_id AS $k_doc=>$e_doc)
                {
                    if(!empty($client_document_number[$k_doc]))
                    {
                        if(isset($client_document_number[$k_doc]))
                            $client_document_number_val=$client_document_number[$k_doc];
                        else
                            $client_document_number_val="";

                        if(isset($client_document_issue_date[$k_doc]))
                            $client_document_issue_date_val=$client_document_issue_date[$k_doc];
                        else
                            $client_document_issue_date_val="";

                        if(isset($client_document_effective_date[$k_doc]))
                            $client_document_effective_date_val=$client_document_effective_date[$k_doc];
                        else
                            $client_document_effective_date_val="";

                        if(isset($documentFileArr[$k_doc]) && !empty($documentFileArr[$k_doc]))
                        {
                            $documentFileNameVal=$documentFileArr[$k_doc];
                        }
                        else
                        {
                            $edit_client_document_old_file=$this->request->getPost('edit_client_document_old_file_'.$k_doc);

                            if(isset($edit_client_document_old_file))
                                $documentFileNameVal=$edit_client_document_old_file;
                            else
                                $documentFileNameVal="";
                        }
                        
                        if(isset($client_document_mobile[$k_doc]))
                            $client_document_mobile_val=$client_document_mobile[$k_doc];
                        else
                            $client_document_mobile_val="";
                            
                        if(isset($client_document_email[$k_doc]))
                            $client_document_email_val=$client_document_email[$k_doc];
                        else
                            $client_document_email_val="";
                            
                        if(isset($client_document_address[$k_doc]))
                            $client_document_address_val=$client_document_address[$k_doc];
                        else
                            $client_document_address_val="";
                            
                        if(isset($client_document_remark[$k_doc]))
                            $client_document_remark_val=$client_document_remark[$k_doc];
                        else
                            $client_document_remark_val="";

                        if($e_doc==1)
                        {
                            $clientPanNumber=$client_document_number_val;
                        }

                        $documentInsertArr[]=array(
                            'fk_client_document_id'=>$e_doc,
                            'client_document_number'=>$client_document_number_val,
                            'client_document_issue_date'=>$client_document_issue_date_val,
                            'client_document_effective_date'=>$client_document_effective_date_val,
                            'client_document_file'=>$documentFileNameVal,
                            'client_document_mobile'=>$client_document_mobile_val,
                            'client_document_email'=>$client_document_email_val,
                            'client_document_address'=>$client_document_address_val,
                            'client_document_remark'=>$client_document_remark_val,
                            'fk_client_id'=>$clientId,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        );
                    }
                }
            }

            if(!empty($documentInsertArr))
            {
                $this->Mquery->insert($tableName=$this->client_document_map_tbl, $documentInsertArr, $returnType="");

                $clientDtUpdateArr = [
                    'clientPanNumber'=>$clientPanNumber,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];

                $clientUpCondtnArr['client_tbl.clientId']=$clientId;

                $query=$this->Mquery->updateData($tableName=$this->client_tbl, $clientDtUpdateArr, $clientUpCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
            }

            $actInsertArr=array();
            if(!empty($actId))
            {
                $clientActUpdateArr = [
                    'status' => 2,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];

                $clientActCondtnArr['client_act_map_tbl.fkClientId']=$clientId;

                $query=$this->Mquery->updateData($tableName=$this->client_act_map_tbl, $clientActUpdateArr, $clientActCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                foreach($actId AS $e_act)
                {
                    $actInsertArr[]=array(
                        'fkActId'=>$e_act,
                        'fkClientId'=>$clientId,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    );
                }
            }

            if(!empty($actInsertArr))
                $this->Mquery->insert($tableName=$this->client_act_map_tbl, $actInsertArr, $returnType="");

            $workCondtnArr['work_tbl.fkClientId']=$clientId;
            $workCondtnArr['work_tbl.status']="1";

            $query=$this->Mquery->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.fk_due_date_id", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr=array(), $singleRow=FALSE, $workOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
            
            $workActDataArr=$query['userData'];

            $clientDDArr=array();

            if(!empty($workActDataArr))
                $clientDDArr=array_column($workActDataArr, 'fk_due_date_id');

            if(!empty($due_date_id_arr))
            {
                foreach($due_date_id_arr AS $e_dd_id)
                {
                    if(!in_array($e_dd_id, $clientDDArr))
                    {
                        $uniqueId=strtoupper(substr(str_shuffle(uniqid()), 0, 4));

                        $workCode="WORKID_".$uniqueId;

                        $workInsertArr[] = [
                            'workCode'=>$workCode,
                            'fk_due_date_id'=>$e_dd_id,
                            'fkClientId'=>$clientId,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        ];
                    }
                }
                
                if(!empty($workInsertArr))
                {
                    $this->Mquery->insert($tableName=$this->work_tbl, $workInsertArr, $returnType="");

                    $clientStUpdateArr = [
                        'clientStatus'=>1,
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
        
                    $clientStCondtnArr['client_tbl.clientId']=$clientId;
        
                    $query=$this->Mquery->updateData($tableName=$this->client_tbl, $clientStUpdateArr, $clientStCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }
            }
            
            $taxPmtCondtnArr['tax_payment_tbl.fkClientId']=$clientId;
            $taxPmtCondtnArr['tax_payment_tbl.status']="1";

            $query=$this->Mquery->getRecords($tableName=$this->tax_payment_tbl, $colNames="tax_payment_tbl.fkDueDateId", $taxPmtCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
            
            $taxPmtActDataArr=$query['userData'];

            $clientTaxPmtDDArr=array();

            if(!empty($taxPmtActDataArr))
                $clientTaxPmtDDArr=array_column($taxPmtActDataArr, 'fkDueDateId');
            
            $taxPaymentInsertArr=array();
            
            if(!empty($due_date_for_arr))
            {
                foreach($due_date_for_arr AS $k_ddf=>$e_ddf)
                {
                    $taxDueDateId=$due_date_id_arr[$k_ddf];
                    
                    if(!in_array($taxDueDateId, $clientTaxPmtDDArr))
                    {
                        $taxActId=$actIdArr[$k_ddf];
                        $retMthFrom=$actFMthArr[$k_ddf];
                        $retYrFrom=$actFYrArr[$k_ddf];
                        $retMthTo=$actTMthArr[$k_ddf];
                        $retYrTo=$actTYrArr[$k_ddf];
                        
                        if($e_ddf==75 || $e_ddf==76 || $e_ddf==148 || $e_ddf==149 || $e_ddf==151 || $e_ddf==152 || $e_ddf==154 || $e_ddf==155 || $e_ddf==156 || $e_ddf==260)
                        {
                            $taxPaymentInsertArr[] = [
                                'fkActId'=>$taxActId,
                                'fkDueDateId'=>$taxDueDateId,
                                'fkClientId'=>$clientId,
                                'retMthFrom'=>$retMthFrom,
                                'retYrFrom'=>$retYrFrom,
                                'retMthTo'=>$retMthTo,
                                'retYrTo'=>$retYrTo,
                                'status' => 1,
                                'createdBy' => $this->adminId,
                                'createdDatetime' => $this->currTimeStamp
                            ];
                        }
                    }
                }
                
                if(!empty($taxPaymentInsertArr))
                    $this->Mquery->insert($tableName=$this->tax_payment_tbl, $taxPaymentInsertArr, $returnType="");
            }
            
            $cliPartInsertArr=array();
            if(!empty($client_partner_name))
            {
                foreach($client_partner_name AS $k_cli_pt=>$e_cli_pt)
                {
                    if(!empty($client_partner_name[$k_cli_pt]))
                    {
                        if(isset($client_partner_name[$k_cli_pt]))
                            $client_partner_name_val=$client_partner_name[$k_cli_pt];
                        else
                            $client_partner_name_val="";

                        if(isset($client_partner_text[$k_cli_pt]))
                            $client_partner_text_val=$client_partner_text[$k_cli_pt];
                        else
                            $client_partner_text_val="";

                        if(isset($client_partner_pan[$k_cli_pt]))
                            $client_partner_pan_val=$client_partner_pan[$k_cli_pt];
                        else
                            $client_partner_pan_val="";
                            
                        if(isset($client_partner_aadhar[$k_cli_pt]))
                            $client_partner_aadhar_val=$client_partner_aadhar[$k_cli_pt];
                        else
                            $client_partner_aadhar_val="";

                        if(isset($client_partner_date[$k_cli_pt]))
                            $client_partner_date_val=date('Y-m-d', strtotime($client_partner_date[$k_cli_pt]));
                        else
                            $client_partner_date_val="";

                        if(isset($client_partner_appt_date[$k_cli_pt]))
                            $client_partner_appt_date_val=date('Y-m-d', strtotime($client_partner_appt_date[$k_cli_pt]));
                        else
                            $client_partner_appt_date_val="";

                        $cliPartInsertArr[]=array(
                            'client_partner_name'=>$client_partner_name_val,
                            'client_partner_text'=>$client_partner_text_val,
                            'client_partner_pan'=>$client_partner_pan_val,
                            'client_partner_aadhar'=>$client_partner_aadhar_val,
                            'client_partner_date'=>$client_partner_date_val,
                            'client_partner_appt_date'=>$client_partner_appt_date_val,
                            'fkClientId'=>$clientId,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        );
                    }
                }
            }

            if(!empty($cliPartInsertArr))
                $this->Mquery->insert($tableName=$this->client_partner_tbl, $cliPartInsertArr, $returnType="");
                
            $cliPartUpdateArr=array();
            if(!empty($edit_client_partner_id))
            {
                foreach($edit_client_partner_id AS $k_e_cli_pt=>$e_e_cli_pt)
                {
                    if(!empty($edit_client_partner_id[$k_cli_pt]))
                    {
                        if(isset($edit_client_partner_id[$k_e_cli_pt]))
                            $edit_client_partner_id_val=$edit_client_partner_id[$k_e_cli_pt];
                        else
                            $edit_client_partner_id_val="";
                            
                        if(isset($edit_client_partner_name[$k_e_cli_pt]))
                            $edit_client_partner_name_val=$edit_client_partner_name[$k_e_cli_pt];
                        else
                            $edit_client_partner_name_val="";

                        if(isset($edit_client_partner_text[$k_e_cli_pt]))
                            $edit_client_partner_text_val=$edit_client_partner_text[$k_e_cli_pt];
                        else
                            $edit_client_partner_text_val="";

                        if(isset($edit_client_partner_pan[$k_e_cli_pt]))
                            $edit_client_partner_pan_val=$edit_client_partner_pan[$k_e_cli_pt];
                        else
                            $edit_client_partner_pan_val="";
                            
                        if(isset($edit_client_partner_aadhar[$k_e_cli_pt]))
                            $edit_client_partner_aadhar_val=$edit_client_partner_aadhar[$k_e_cli_pt];
                        else
                            $edit_client_partner_aadhar_val="";

                        if(isset($edit_client_partner_date[$k_e_cli_pt]))
                            $edit_client_partner_date_val=date('Y-m-d', strtotime($edit_client_partner_date[$k_e_cli_pt]));
                        else
                            $edit_client_partner_date_val="";

                        if(isset($edit_client_partner_appt_date[$k_e_cli_pt]))
                            $edit_client_partner_appt_date_val=date('Y-m-d', strtotime($edit_client_partner_appt_date[$k_e_cli_pt]));
                        else
                            $edit_client_partner_appt_date_val="";

                        $cliPartUpdateArr[]=array(
                            'client_partner_id'=>$edit_client_partner_id_val,
                            'client_partner_name'=>$edit_client_partner_name_val,
                            'client_partner_text'=>$edit_client_partner_text_val,
                            'client_partner_pan'=>$edit_client_partner_pan_val,
                            'client_partner_aadhar'=>$edit_client_partner_aadhar_val,
                            'client_partner_date'=>$edit_client_partner_date_val,
                            'client_partner_appt_date'=>$edit_client_partner_appt_date_val,
                            'updatedBy' => $this->adminId,
                            'updatedDatetime' => $this->currTimeStamp
                        );
                    }
                }
            }

            if(!empty($cliPartUpdateArr))
            {
                $cliPartCondtnArr['client_partner_tbl.fkClientId']=$clientId;
                
                $this->Mquery->updateBatch($tableName=$this->client_partner_tbl, $cliPartUpdateArr, $updateKey="client_partner_id", $cliPartCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
            }
            
            $sbGrpArr=$this->Mcontsubgroup->where('fk_cont_group_id', 1)->findAll();
	    
    	    $sbGrpArray=array();
    	    
    	    if(!empty($sbGrpArr))
    	    {
    	        foreach($sbGrpArr AS $e_row)
    	        {
    	            $sbGrpArray[$e_row['refId']]=$e_row['cont_sub_group_id'];
    	        }
    	    }
    	    
    	    $clientContactDataArr=$this->Mcontact->where('contGroupId', 1)->where('contRefId', $clientId)->where('status', 1)->get()->getRowArray();
    	    $clientDataArr=$this->Mclient->where('clientId', $clientId)->where('status', 1)->get()->getRowArray();
    	    
    	    if(!empty($clientDataArr))
    	    {
    	        $contGroupId=1;
	            
	            if(!empty($sbGrpArray[$clientDataArr['clientGroup']]))
                    $contSubGroupId=$sbGrpArray[$clientDataArr['clientGroup']];
                else
                    $contSubGroupId="";
                
                if($clientDataArr['clientBussOrganisationType']==9) // Individual
                {
                    $contFullName=$clientDataArr['clientName'];
                    $contOrgName="";
                    $contMob1=$clientDataArr['clientBussMobile1'];
                    $contMob2=$clientDataArr['clientBussMobile2'];
                    $contEmail=$clientDataArr['clientBussEmail1'];
                    $contResiAddress=$clientDataArr['clientResidentialAddress'];
                    $contResiNum=$clientDataArr['clientBussResidencePhone'];
                    $contOfficeAddress=$clientDataArr['clientBussOfficeAddress'];
                    $contOfficeNum=$clientDataArr['clientBussOfficePhone1'];
                    $contRegOffice=$clientDataArr['clientBussRegisteredAddress'];
                    $contRegOfficeNum=$clientDataArr['clientBussOfficePhone2'];
                    $contFactOffice=$clientDataArr['clientBussFactoryAddress'];
                    $contFactNum=$clientDataArr['clientBussFactoryPhone'];
                    $contRefId=$clientDataArr['clientId'];
                }
                elseif($clientDataArr['clientBussOrganisationType']==8 || $clientDataArr['clientBussOrganisationType']==3) // Proprietory, OPC
                {
                    $contFullName=$clientDataArr['clientName'];
                    $contOrgName=$clientDataArr['clientBussOrganisation'];
                    $contMob1=$clientDataArr['clientBussMobile1'];
                    $contMob2=$clientDataArr['clientBussMobile2'];
                    $contEmail=$clientDataArr['clientBussEmail1'];
                    $contResiAddress=$clientDataArr['clientResidentialAddress'];
                    $contResiNum=$clientDataArr['clientBussResidencePhone'];
                    $contOfficeAddress=$clientDataArr['clientBussOfficeAddress'];
                    $contOfficeNum=$clientDataArr['clientBussOfficePhone1'];
                    $contRegOffice=$clientDataArr['clientBussRegisteredAddress'];
                    $contRegOfficeNum=$clientDataArr['clientBussOfficePhone2'];
                    $contFactOffice=$clientDataArr['clientBussFactoryAddress'];
                    $contFactNum=$clientDataArr['clientBussFactoryPhone'];
                    $contRefId=$clientDataArr['clientId'];
                }
                elseif($clientDataArr['clientBussOrganisationType']!=9 && $clientDataArr['clientBussOrganisationType']!=8 && $clientDataArr['clientBussOrganisationType']!=3) // Other Than Individual
                {
                    $contFullName=$clientDataArr['clientContactPerson'];
                    $contOrgName=$clientDataArr['clientBussOrganisation'];
                    $contMob1=$clientDataArr['clientBussMobile1'];
                    $contMob2=$clientDataArr['clientBussMobile2'];
                    $contEmail=$clientDataArr['clientBussEmail1'];
                    $contResiAddress=$clientDataArr['clientResidentialAddress'];
                    $contResiNum=$clientDataArr['clientBussResidencePhone'];
                    $contOfficeAddress=$clientDataArr['clientBussOfficeAddress'];
                    $contOfficeNum=$clientDataArr['clientBussOfficePhone1'];
                    $contRegOffice=$clientDataArr['clientBussRegisteredAddress'];
                    $contRegOfficeNum=$clientDataArr['clientBussOfficePhone2'];
                    $contFactOffice=$clientDataArr['clientBussFactoryAddress'];
                    $contFactNum=$clientDataArr['clientBussFactoryPhone'];
                    $contRefId=$clientDataArr['clientId'];
                }
                
                $contactUpdateArr=[
                    'contactId'=>$clientContactDataArr['contactId'],
                    'contGroupId'=>$contGroupId,
                    'contSubGroupId'=>$contSubGroupId,
                    'contFullName'=>$contFullName,
                    'contOrgName'=>$contOrgName,
                    'contMob1'=>$contMob1,
                    'contMob2'=>$contMob2,
                    'contEmail'=>$contEmail,
                    'contResiAddress'=>$contResiAddress,
                    'contResiNum'=>$contResiNum,
                    'contOfficeAddress'=>$contOfficeAddress,
                    'contOfficeNum'=>$contOfficeNum,
                    'contRegOffice'=>$contRegOffice,
                    'contRegOfficeNum'=>$contRegOfficeNum,
                    'contFactOffice'=>$contFactOffice,
                    'contFactNum'=>$contFactNum,
                    'contRefId'=>$contRefId,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
        	    
        	    $this->Mcontact->save($contactUpdateArr);
    	    }

            $prevEvtDDCondtnArr['non_regular_due_date_tbl.fkClientId']=$clientId;
            $prevEvtDDCondtnArr['non_regular_due_date_tbl.status']="1";

            $query=$this->Mquery->getRecords($tableName=$this->non_regular_due_date_tbl, $colNames="non_regular_due_date_tbl.non_rglr_due_date_id", $prevEvtDDCondtnArr, $likeCondtnArr=array(), $workJoinArr=array(), $singleRow=FALSE, $workOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
            
            $prevEvtDDArr=$query['userData'];

            $clientEvtDDArr=array();

            if(!empty($prevEvtDDArr))
                $clientEvtDDArr=array_column($prevEvtDDArr, 'non_rglr_due_date_id');

            $non_rglr_due_date_insert_array=array();

            if(!empty($cust_actId_arr))
            {
                foreach($cust_actId_arr AS $k_cust_act=>$e_cust_act)
                {
                    $non_rglr_due_date_id_val=(isset($non_rglr_due_date_id_arr[$k_cust_act])) ? $non_rglr_due_date_id_arr[$k_cust_act] : "";

                    if(!in_array($non_rglr_due_date_id_val, $clientEvtDDArr))
                    {
                        $non_rglr_due_state=(isset($non_rglr_due_state_arr[$k_cust_act])) ? $non_rglr_due_state_arr[$k_cust_act] : "";
                        $non_rglr_due_act=(isset($non_rglr_due_act_arr[$k_cust_act])) ? $non_rglr_due_act_arr[$k_cust_act] : "";
                        $non_rglr_due_date_for=(isset($non_rglr_due_date_for_arr[$k_cust_act])) ? $non_rglr_due_date_for_arr[$k_cust_act] : "";
                        $non_rglr_applicable_form=(isset($non_rglr_applicable_form_arr[$k_cust_act])) ? $non_rglr_applicable_form_arr[$k_cust_act] : "";
                        $non_rglr_under_section=(isset($non_rglr_under_section_arr[$k_cust_act])) ? $non_rglr_under_section_arr[$k_cust_act] : "";
                        $non_rglr_periodicity=(isset($non_rglr_periodicity_arr[$k_cust_act])) ? $non_rglr_periodicity_arr[$k_cust_act] : "";
                        $non_rglr_daily_date=(isset($non_rglr_daily_date_arr[$k_cust_act])) ? $non_rglr_daily_date_arr[$k_cust_act] : "";
                        $non_rglr_period_month=(isset($non_rglr_period_month_arr[$k_cust_act])) ? $non_rglr_period_month_arr[$k_cust_act] : "";
                        $non_rglr_period_year=(isset($non_rglr_period_year_arr[$k_cust_act])) ? $non_rglr_period_year_arr[$k_cust_act] : "";
                        $non_rglr_f_period_month=(isset($non_rglr_f_period_month_arr[$k_cust_act])) ? $non_rglr_f_period_month_arr[$k_cust_act] : "";
                        $non_rglr_f_period_year=(isset($non_rglr_f_period_year_arr[$k_cust_act])) ? $non_rglr_f_period_year_arr[$k_cust_act] : "";
                        $non_rglr_t_period_month=(isset($non_rglr_t_period_month_arr[$k_cust_act])) ? $non_rglr_t_period_month_arr[$k_cust_act] : "";
                        $non_rglr_t_period_year=(isset($non_rglr_t_period_year_arr[$k_cust_act])) ? $non_rglr_t_period_year_arr[$k_cust_act] : "";
                        $non_rglr_finYear=(isset($non_rglr_finYear_arr[$k_cust_act])) ? $non_rglr_finYear_arr[$k_cust_act] : "";
                        $non_rglr_due_date=(isset($non_rglr_due_date_arr[$k_cust_act])) ? $non_rglr_due_date_arr[$k_cust_act] : "";
                        $non_rglr_event_date=(isset($non_rglr_event_date_arr[$k_cust_act])) ? $non_rglr_event_date_arr[$k_cust_act] : "";
                        $non_rglr_due_notes=(isset($non_rglr_due_notes_arr[$k_cust_act])) ? $non_rglr_due_notes_arr[$k_cust_act] : "";

                        $non_rglr_due_date_insert_array[]=array(
                            "non_rglr_due_state" => $non_rglr_due_state,
                            "non_rglr_due_act" => $non_rglr_due_act,
                            "non_rglr_due_date_for" => $non_rglr_due_date_for,
                            "non_rglr_applicable_form" => $non_rglr_applicable_form,
                            "non_rglr_under_section" => $non_rglr_under_section,
                            "non_rglr_periodicity" => $non_rglr_periodicity,
                            "non_rglr_daily_date" => $non_rglr_daily_date,
                            "non_rglr_period_month" => $non_rglr_period_month,
                            "non_rglr_period_year" => $non_rglr_period_year,
                            "non_rglr_f_period_month" => $non_rglr_f_period_month,
                            "non_rglr_f_period_year" => $non_rglr_f_period_year,
                            "non_rglr_t_period_month" => $non_rglr_t_period_month,
                            "non_rglr_t_period_year" => $non_rglr_t_period_year,
                            "non_rglr_finYear" => $non_rglr_finYear,
                            "non_rglr_due_date" => $non_rglr_due_date,
                            "non_rglr_event_date" => $non_rglr_event_date,
                            "non_rglr_due_notes" => $non_rglr_due_notes,
                            'fkClientId'=>$clientId,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        );
                    }
                }
            }

            if(!empty($non_rglr_due_date_insert_array)){
                $this->Mquery->insert($tableName=$this->non_regular_due_date_tbl, $non_rglr_due_date_insert_array, $returnType="");
            }
        }

        if($this->db->transStatus() === FALSE || !empty($errorArr)){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="Client has not updated :(";
            $responseArr['userdata']=$errorArr;

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client has been updated successfully :)";
            $responseArr['userdata']=$errorArr;

            // $this->session->setFlashdata('successMsg', "Client has been updated successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function getClientGroups()
    {
        $client_group=$this->request->getPost('client_group');

        // $groupList=$this->Mgroup->select('client_group_tbl.*, user_tbl.userFullName, group_category_tbl.group_category_name')
        //     ->join('user_tbl', 'user_tbl.userId=client_group_tbl.client_group_cost', 'left')
        //     ->join($this->group_category_tbl, 'group_category_tbl.group_category_id=client_group_tbl.client_group_category', 'left')
        //     ->where('client_group_tbl.client_group_id', $client_group)
        //     ->where('client_group_tbl.status', 1)
        //     ->get()
        //     ->getRowArray();
            
        $taxCondtnArr['client_group_tbl.status']=1;
        $taxCondtnArr['client_group_tbl.client_group_id']=$client_group;

        $taxJoinArr[]=array("tbl"=>$this->user_tbl , "condtn"=>'user_tbl.userId=client_group_tbl.client_group_cost', "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>'group_category_tbl.group_category_id=client_group_tbl.client_group_category', "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_group_tbl, $colNames='client_group_tbl.*, user_tbl.userFullName, group_category_tbl.group_category_name', $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=TRUE, $taxOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $groupList=$query['userData'];
        
        $this->data['groupList']=$groupList;

        $responseArr=array();

        if(!empty($groupList))
        {
            $costCenter=$groupList['userFullName'];
            $categoryName=$groupList['group_category_name'];

            $responseArr['costCenter']=$costCenter;
            $responseArr['categoryName']=$categoryName;

            $responseArr['status']=TRUE;
            $responseArr['message']="";
            $responseArr['userdata']=$responseArr;
        }
        else
        {
            $responseArr['status']=FALSE;
            $responseArr['message']="Not Found";
            $responseArr['userdata']=$responseArr;
        }

        echo json_encode($responseArr);
    }

    public function delete_client()
    {
        $clientId=$this->request->getPost('clientId');

	    $dataArray = [
            'clientId' => $clientId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mclient->save($dataArray)){
            
            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client has been deleted successfully :)";
            $responseArr['userdata']=array();
        }else{
            $responseArr['status']=FALSE;
            $responseArr['message']="Client has not delete :(";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }
    
    public function mark_old_client()
    {
        $clientId=$this->request->getPost('clientId');
        $clientLeftReason=$this->request->getPost('clientLeftReason');

	    $dataArray = [
            'clientId' => $clientId,
            'clientLeftReason' => $clientLeftReason,
            'isOldClient' => 1,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mclient->save($dataArray)){
            
            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client Mark Old";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client has been mark as left successfully :)";
            $responseArr['userdata']=array();
        }else{
            $responseArr['status']=FALSE;
            $responseArr['message']="Client has not mark left :(";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }
    
    public function restoreClient()
    {
        $clientId=$this->request->getPost('clientId');

	    $dataArray = [
            'clientId' => $clientId,
            'clientLeftReason' => "",
            'isOldClient' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mclient->save($dataArray)){
            
            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client Restored";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client has been restore successfully :)";
            $responseArr['userdata']=array();
        }else{
            $responseArr['status']=FALSE;
            $responseArr['message']="Client has not restored :(";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }

    public function getUsers()
    {
        $user_name=$this->request->getPost('user_name');

        $userCondtnArr['user_tbl.status']="1";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        return view('remote/admin/getUsers', $this->data);
    }

    public function add_user()
    {
        $this->db->transBegin();
        
        $isExceedLimit=false;
        
        $validationRulesArr['userFullName']=['label' => 'Employee Full Name', 'rules' => 'required|trim'];

        if(isset($_FILES['userImg']['name']) && !empty($_FILES['userImg']['name']))
            $validationRulesArr['userImg']=['label' => 'User Profile', 'rules' => 'uploaded[userImg]|max_size[userImg,10000]|ext_in[userImg,png,jpg,jpeg]'];

        $validationRulesArr['userTitle']=['label' => 'Title', 'rules' => 'required|trim'];
        $validationRulesArr['userShortName']=['label' => 'Short Name', 'rules' => 'required|trim'];
        $validationRulesArr['userDob']=['label' => 'Date of Birth', 'rules' => 'trim'];
        $validationRulesArr['userQualification']=['label' => 'Qualification', 'rules' => 'trim'];
        $validationRulesArr['userRegNo']=['label' => 'Registration Number', 'rules' => 'trim'];
        $validationRulesArr['userRegDocument']=['label' => 'Registration Document', 'rules' => 'trim'];
        $validationRulesArr['userAadharNo']=['label' => 'Aadhar Number', 'rules' => 'trim'];
        $validationRulesArr['userAadharDoc']=['label' => 'Aadhar Document', 'rules' => 'trim'];
        $validationRulesArr['userPan']=['label' => 'PAN No', 'rules' => 'trim'];
        $validationRulesArr['userPanDoc']=['label' => 'PAN Document', 'rules' => 'trim'];
        $validationRulesArr['userPassportNo']=['label' => 'Passport No', 'rules' => 'trim'];
        $validationRulesArr['userPassportDoc']=['label' => 'Passport Document', 'rules' => 'trim'];
        $validationRulesArr['userMobile1']=['label' => 'Mobile 1', 'rules' => 'trim'];
        $validationRulesArr['userMobileWhatsApp']=['label' => 'Mobile 2', 'rules' => 'trim'];
        $validationRulesArr['userResidencePhone']=['label' => 'Residence Phone', 'rules' => 'trim'];
        $validationRulesArr['userOfficePhone']=['label' => 'Office Phone', 'rules' => 'trim'];
        $validationRulesArr['userEmail1']=['label' => 'Email 1', 'rules' => 'trim'];
        $validationRulesArr['userEmail2']=['label' => 'Email 2', 'rules' => 'trim'];
        $validationRulesArr['userResidenceAddress']=['label' => 'Residence Address', 'rules' => 'trim'];
        $validationRulesArr['userReference']=['label' => 'Reference (Introduced by)', 'rules' => 'trim'];
        $validationRulesArr['userRemark']=['label' => 'Remark/Notes', 'rules' => 'trim'];
        $validationRulesArr['userCV']=['label' => 'CV', 'rules' => 'trim'];
        $validationRulesArr['isCostCenter']=['label' => 'Cost Centre', 'rules' => 'trim'];
        $validationRulesArr['userStaffType']=['label' => 'Employee Type', 'rules' => 'required|trim'];
        $validationRulesArr['fkUserCatId']=['label' => 'User Type', 'rules' => 'required|trim'];
        $validationRulesArr['userDesgn']=['label' => 'Designation', 'rules' => 'trim'];
        $validationRulesArr['userEmpNo']=['label' => 'Employee No', 'rules' => 'trim'];
        $validationRulesArr['userDOJ']=['label' => 'Date of Joining', 'rules' => 'trim'];
        $validationRulesArr['userLoginName']=['label' => 'Login Name', 'rules' => 'trim'];
        $validationRulesArr['userPassword']=['label' => 'Login Password', 'rules' => 'trim'];
        $validationRulesArr['userDOL']=['label' => 'Date of Leaving', 'rules' => 'trim'];
        $validationRulesArr['userArtRegNo']=['label' => 'Articleship Registration No', 'rules' => 'trim'];
        $validationRulesArr['userArtStartDate']=['label' => 'Date of Start of Articleship', 'rules' => 'trim'];
        $validationRulesArr['userArtEndDate']=['label' => 'Date of End of Articleship', 'rules' => 'trim'];
    
        $validationRulesArr['userICAICommDate']=['label' => 'Intimation to ICAI-Commencemene', 'rules' => 'trim'];
        $validationRulesArr['userICAIComplDate']=['label' => 'Intimation to ICAI-Completion', 'rules' => 'trim'];
        $validationRulesArr['userCAMemNo']=['label' => 'CA Membership No', 'rules' => 'trim'];
        $validationRulesArr['userCADOJ']=['label' => 'Date of Joining (CA)', 'rules' => 'trim'];
        $validationRulesArr['userCADOL']=['label' => 'Date of Leaving (CA)', 'rules' => 'trim'];
        $validationRulesArr['userICAIJoin']=['label' => 'Intimation to ICAI-Joining', 'rules' => 'trim'];
        $validationRulesArr['userICAILeave']=['label' => 'Intimation to ICAI-Leaving', 'rules' => 'trim'];
        $validationRulesArr['userPersonalRemark']=['label' => 'Remarks', 'rules' => 'trim'];
        $validationRulesArr['userContactRemark']=['label' => 'Remarks', 'rules' => 'trim'];
        $validationRulesArr['userOffAlloctRemark']=['label' => 'Remarks', 'rules' => 'trim'];
        $validationRulesArr['userArticleAsstRemark']=['label' => 'Remarks', 'rules' => 'trim'];
        $validationRulesArr['userCARemark']=['label' => 'Remarks', 'rules' => 'trim'];

        $errorArr=array();

        if(!$this->validate($validationRulesArr))
        {
            $errorArr=$this->validation->getErrors();
        }
        else
        {
            $userStaffType=$this->request->getPost('userStaffType');
            
            $staffCount=$this->Muser->where('userStaffType !=', 6)->where('status', 1)->countAllResults();
            
            $getAccountData = $this->Mfirm->select('ca_firm_tbl.caFirmUsers')
                            ->where('ca_firm_tbl.caFirmId', $this->sessCaFirmId)
                            ->where('ca_firm_tbl.status', 1)
                            ->get()
                            ->getRowArray();
            
            if(!empty($getAccountData))
            {
                $caFirmUsers=$getAccountData['caFirmUsers'];
                
                if(($staffCount >= $caFirmUsers) && ($userStaffType!=6))
                {
                    $isExceedLimit=true;
                }
                else
                {
                    $userFullName=$this->request->getPost('userFullName');
                    $userImg=$this->request->getFile('userImg');
                    $userTitle=$this->request->getPost('userTitle');
                    $userShortName=$this->request->getPost('userShortName');
                    $userDob=$this->request->getPost('userDob');
                    $userQualification=$this->request->getPost('userQualification');
                    // $userRegNo=$this->request->getPost('userRegNo');
                    // $userRegDocument=$this->request->getFile('userRegDocument');
                    $userAadharNo=$this->request->getPost('userAadharNo');
                    $userAadharDoc=$this->request->getFile('userAadharDoc');
                    $userPan=$this->request->getPost('userPan');
                    $userPanDoc=$this->request->getFile('userPanDoc');
                    $userPassportNo=$this->request->getPost('userPassportNo');
                    $userPassportDoc=$this->request->getFile('userPassportDoc');
                    $userMobile1=$this->request->getPost('userMobile1');
                    $userMobileWhatsApp=$this->request->getPost('userMobileWhatsApp');
                    $userResidencePhone=$this->request->getPost('userResidencePhone');
                    $userOfficePhone=$this->request->getPost('userOfficePhone');
                    $userEmail1=$this->request->getPost('userEmail1');
                    $userEmail2=$this->request->getPost('userEmail2');
                    $userResidenceAddress=$this->request->getPost('userResidenceAddress');
                    $userReference=$this->request->getPost('userReference');
                    $userRemark=$this->request->getPost('userRemark');
                    $userCV=$this->request->getFile('userCV');
                    $isCostCenter=$this->request->getPost('isCostCenter');
                    $userStaffType=$this->request->getPost('userStaffType');
                    $fkUserCatId=$this->request->getPost('fkUserCatId');
                    $userDesgn=$this->request->getPost('userDesgn');
                    $userEmpNo=$this->request->getPost('userEmpNo');
                    $userDOJ=$this->request->getPost('userDOJ');
                    $userLoginName=$this->request->getPost('userLoginName');
                    $userPassword=$this->request->getPost('userPassword');
                    $userDOL=$this->request->getPost('userDOL');
                    $userArtRegNo=$this->request->getPost('userArtRegNo');
                    $userArtStartDate=$this->request->getPost('userArtStartDate');
                    $userArtEndDate=$this->request->getPost('userArtEndDate');
                    $userICAICommDate=$this->request->getPost('userICAICommDate');
                    $userICAIComplDate=$this->request->getPost('userICAIComplDate');
                    $userCAMemNo=$this->request->getPost('userCAMemNo');
                    $userCADOJ=$this->request->getPost('userCADOJ');
                    $userCADOL=$this->request->getPost('userCADOL');
                    $userICAIJoin=$this->request->getPost('userICAIJoin');
                    $userICAILeave=$this->request->getPost('userICAILeave');
                    $userPersonalRemark=$this->request->getPost('userPersonalRemark');
                    $userContactRemark=$this->request->getPost('userContactRemark');
                    $userOffAlloctRemark=$this->request->getPost('userOffAlloctRemark');
                    $userArticleAsstRemark=$this->request->getPost('userArticleAsstRemark');
                    $userCARemark=$this->request->getPost('userCARemark');
        
                    if(!empty($userPassword))
                        $userPassword=md5($userPassword);
        
                    $userImgPath="";
                    if($userImg !== null && !empty($userImg->getTempName()))
                    {
                        if($userImg->isValid() && ! $userImg->hasMoved())
                        {
                            $ext=$userImg->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userImg->getRandomName();
                            $userImg->move($uploadPath1, $newName);
        
                            $userImgPath=$newName;
                        }
                    }
        
                    $userRegDocumentPath="";
                    /*
                    if(!empty($userRegDocument->getTempName()))
                    {
                        if($userRegDocument->isValid() && ! $userRegDocument->hasMoved())
                        {
                            $ext=$userRegDocument->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userRegDocument->getRandomName();
                            $userRegDocument->move($uploadPath1, $newName);
        
                            $userRegDocumentPath=$newName;
                        }
                    }
                    */
        
                    $userAadharDocPath="";
                    if(!empty($userAadharDoc->getTempName()))
                    {
                        if($userAadharDoc->isValid() && ! $userAadharDoc->hasMoved())
                        {
                            $ext=$userAadharDoc->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userAadharDoc->getRandomName();
                            $userAadharDoc->move($uploadPath1, $newName);
        
                            $userAadharDocPath=$newName;
                        }
                    }
                    
                    $userPanDocPath="";
                    if(!empty($userPanDoc->getTempName()))
                    {
                        if($userPanDoc->isValid() && ! $userPanDoc->hasMoved())
                        {
                            $ext=$userPanDoc->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userPanDoc->getRandomName();
                            $userPanDoc->move($uploadPath1, $newName);
        
                            $userPanDocPath=$newName;
                        }
                    }
                    
                    $userPassportDocPath="";
                    if(!empty($userPassportDoc->getTempName()))
                    {
                        if($userPassportDoc->isValid() && ! $userPassportDoc->hasMoved())
                        {
                            $ext=$userPassportDoc->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userPassportDoc->getRandomName();
                            $userPassportDoc->move($uploadPath1, $newName);
        
                            $userPassportDocPath=$newName;
                        }
                    }
        
                    $userCVPath="";
                    if(!empty($userCV->getTempName()))
                    {
                        if($userCV->isValid() && ! $userCV->hasMoved())
                        {
                            $ext=$userCV->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userCV->getRandomName();
                            $userCV->move($uploadPath1, $newName);
        
                            $userCVPath=$newName;
                        }
                    }
        
                    $userInsertArr[] = [
                        'userFullName'=>$userFullName,
                        'userImg'=>$userImgPath,
                        'userTitle'=>$userTitle,
                        'userShortName'=>$userShortName,
                        'userDob'=>$userDob,
                        'userQualification'=>$userQualification,
                        // 'userRegNo'=>$userRegNo,
                        // 'userRegDocument'=>$userRegDocumentPath,
                        'userAadharNo'=>$userAadharNo,
                        'userAadharDoc'=>$userAadharDocPath,
                        'userPan'=>$userPan,
                        'userPanDoc'=>$userPanDocPath,
                        'userPassportNo'=>$userPassportNo,
                        'userPassportDoc'=>$userPassportDocPath,
                        'userMobile1'=>$userMobile1,
                        'userMobileWhatsApp'=>$userMobileWhatsApp,
                        'userResidencePhone'=>$userResidencePhone,
                        'userOfficePhone'=>$userOfficePhone,
                        'userEmail1'=>$userEmail1,
                        'userEmail2'=>$userEmail2,
                        'userResidenceAddress'=>$userResidenceAddress,
                        'userReference'=>$userReference,
                        'userRemark'=>$userRemark,
                        'userCV'=>$userCVPath,
                        'isCostCenter'=>$isCostCenter,
                        'userStaffType'=>$userStaffType,
                        'fkUserCatId'=>$fkUserCatId,
                        'userDesgn'=>$userDesgn,
                        'userEmpNo'=>$userEmpNo,
                        'userDOJ'=>$userDOJ,
                        'userLoginName'=>$userLoginName,
                        'userPassword'=>$userPassword,
                        'userDOL'=>$userDOL,
                        'userArtRegNo'=>$userArtRegNo,
                        'userArtStartDate'=>$userArtStartDate,
                        'userArtEndDate'=>$userArtEndDate,
                        'userICAICommDate'=>$userICAICommDate,
                        'userICAIComplDate'=>$userICAIComplDate,
                        'userCAMemNo'=>$userCAMemNo,
                        'userCADOJ'=>$userCADOJ,
                        'userCADOL'=>$userCADOL,
                        'userICAIJoin'=>$userICAIJoin,
                        'userICAILeave'=>$userICAILeave,
                        'userPersonalRemark'=>$userPersonalRemark,
                        'userContactRemark'=>$userContactRemark,
                        'userOffAlloctRemark'=>$userOffAlloctRemark,
                        'userArticleAsstRemark'=>$userArticleAsstRemark,
                        'userCARemark'=>$userCARemark,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    ];
        
                    $query=$this->Mquery->insert($tableName=$this->user_tbl, $userInsertArr, $returnType="");
                
                    $userId=$query['lastID'];
                    
                    $sbGrpArr=$this->Mcontsubgroup->where('fk_cont_group_id', 2)->findAll();
        	    
            	    $sbGrpArray=array();
            	    
            	    if(!empty($sbGrpArr))
            	    {
            	        foreach($sbGrpArr AS $e_row)
            	        {
            	            $sbGrpArray[$e_row['refId']]=$e_row['cont_sub_group_id'];
            	        }
            	    }
            	    
            	    $staffDataArr=$this->Muser->where('userId', $userId)->where('status', 1)->get()->getRowArray();
            	    
            	    if(!empty($staffDataArr))
        	        {
        	            $contGroupId=2;
        	            
        	            if(!empty($sbGrpArray[$staffDataArr['userStaffType']]))
                            $contSubGroupId=$sbGrpArray[$staffDataArr['userStaffType']];
                        else
                            $contSubGroupId="";
                        
                        $contFullName=$staffDataArr['userFullName'];
                        $contOrgName=$this->sessCaFirmName;
                        $contMob1=$staffDataArr['userMobile1'];
                        $contMob2=$staffDataArr['userMobileWhatsApp'];
                        $contEmail=$staffDataArr['userEmail1'];
                        $contResiAddress=$staffDataArr['userResidenceAddress'];
                        $contResiNum=$staffDataArr['userResidencePhone'];
                        $contOfficeAddress="";
                        $contOfficeNum=$staffDataArr['userOfficePhone'];
                        $contRegOffice="";
                        $contRegOfficeNum="";
                        $contFactOffice="";
                        $contFactNum="";
                        $contRefId=$staffDataArr['userId'];
                        
                        $contactInsertArr=[
                            'contGroupId'=>$contGroupId,
                            'contSubGroupId'=>$contSubGroupId,
                            'contFullName'=>$contFullName,
                            'contOrgName'=>$contOrgName,
                            'contMob1'=>$contMob1,
                            'contMob2'=>$contMob2,
                            'contEmail'=>$contEmail,
                            'contResiAddress'=>$contResiAddress,
                            'contResiNum'=>$contResiNum,
                            'contOfficeAddress'=>$contOfficeAddress,
                            'contOfficeNum'=>$contOfficeNum,
                            'contRegOffice'=>$contRegOffice,
                            'contRegOfficeNum'=>$contRegOfficeNum,
                            'contFactOffice'=>$contFactOffice,
                            'contFactNum'=>$contFactNum,
                            'contRefId'=>$contRefId,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        ];
                	    
                	    $this->Mcontact->save($contactInsertArr);
        	        }
                }
            }
        }

        if($this->db->transStatus() === FALSE || !empty($errorArr) || $isExceedLimit==true){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="User has not added :(";
            $responseArr['userdata']=$errorArr;
            
            if($isExceedLimit)
            {
                $responseArr['isExceedLimit']="true";
            }

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="User";
            $insertLogArr['message']="User added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="User has been added successfully :)";
            $responseArr['userdata']=$errorArr;
            $responseArr['isExceedLimit']="";

            $this->session->setFlashdata('successMsg', "User has been added successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function update_user()
    {
        $this->db->transBegin();
        
        $isExceedLimit=false;
        
        $validationRulesArr['userFullName']=['label' => 'Employee Full Name', 'rules' => 'required|trim'];

        if(isset($_FILES['userImg']['name']) && !empty($_FILES['userImg']['name']))
            $validationRulesArr['userImg']=['label' => 'User Profile', 'rules' => 'uploaded[userImg]|max_size[userImg,10000]|ext_in[userImg,png,jpg,jpeg]'];
        
        $validationRulesArr['userTitle']=['label' => 'Title', 'rules' => 'required|trim'];
        $validationRulesArr['userShortName']=['label' => 'User Short Name', 'rules' => 'required|trim'];
        $validationRulesArr['userDob']=['label' => 'Date of Birth', 'rules' => 'trim'];
        $validationRulesArr['userQualification']=['label' => 'Qualification', 'rules' => 'trim'];
        $validationRulesArr['userRegNo']=['label' => 'Registration Number', 'rules' => 'trim'];
        $validationRulesArr['userRegDocument']=['label' => 'Registration Document', 'rules' => 'trim'];
        $validationRulesArr['userAadharNo']=['label' => 'Aadhar Number', 'rules' => 'trim'];
        $validationRulesArr['userAadharDoc']=['label' => 'Aadhar Document', 'rules' => 'trim'];
        $validationRulesArr['userPan']=['label' => 'PAN No', 'rules' => 'trim'];
        $validationRulesArr['userPanDoc']=['label' => 'PAN Document', 'rules' => 'trim'];
        $validationRulesArr['userPassportNo']=['label' => 'Passport No', 'rules' => 'trim'];
        $validationRulesArr['userPassportDoc']=['label' => 'Passport Document', 'rules' => 'trim'];
        $validationRulesArr['userMobile1']=['label' => 'Mobile 1', 'rules' => 'trim'];
        $validationRulesArr['userMobileWhatsApp']=['label' => 'Mobile (WhatsApp)', 'rules' => 'trim'];
        $validationRulesArr['userResidencePhone']=['label' => 'Residence Phone', 'rules' => 'trim'];
        $validationRulesArr['userOfficePhone']=['label' => 'Office Phone', 'rules' => 'trim'];
        $validationRulesArr['userEmail1']=['label' => 'Email 1', 'rules' => 'trim'];
        $validationRulesArr['userEmail2']=['label' => 'Email 2', 'rules' => 'trim'];
        $validationRulesArr['userResidenceAddress']=['label' => 'Residence Address', 'rules' => 'trim'];
        $validationRulesArr['userReference']=['label' => 'Reference (Introduced by)', 'rules' => 'trim'];
        $validationRulesArr['userRemark']=['label' => 'Remark/Notes', 'rules' => 'trim'];
        $validationRulesArr['userCV']=['label' => 'CV', 'rules' => 'trim'];
        $validationRulesArr['isCostCenter']=['label' => 'Cost Centre', 'rules' => 'trim'];
        $validationRulesArr['userStaffType']=['label' => 'Employee Type', 'rules' => 'required|trim'];
        $validationRulesArr['fkUserCatId']=['label' => 'User Type', 'rules' => 'required|trim'];
        $validationRulesArr['userDesgn']=['label' => 'Designation', 'rules' => 'trim'];
        $validationRulesArr['userEmpNo']=['label' => 'Employee No', 'rules' => 'trim'];
        $validationRulesArr['userDOJ']=['label' => 'Date of Joining', 'rules' => 'trim'];
        $validationRulesArr['userLoginName']=['label' => 'Login Name', 'rules' => 'trim'];
        $validationRulesArr['userPassword']=['label' => 'Login Password', 'rules' => 'trim'];
        $validationRulesArr['userDOL']=['label' => 'Date of Leaving', 'rules' => 'trim'];
        $validationRulesArr['userArtRegNo']=['label' => 'Articleship Registration No', 'rules' => 'trim'];
        $validationRulesArr['userArtStartDate']=['label' => 'Date of Start of Articleship', 'rules' => 'trim'];
        $validationRulesArr['userArtEndDate']=['label' => 'Date of End of Articleship', 'rules' => 'trim'];
        $validationRulesArr['userArtEndDate']=['label' => 'Date of End of Articleship', 'rules' => 'trim'];
        $validationRulesArr['userICAICommDate']=['label' => 'Intimation to ICAI-Commencemene', 'rules' => 'trim'];
        $validationRulesArr['userArtComplTerminationDate']=['label' => 'Actual Date of Completion/Termination', 'rules' => 'trim'];
        $validationRulesArr['isArticleShipContinue']=['label' => 'Articleship Continue', 'rules' => 'trim'];

        $validationRulesArr['art_staff_name_of_principle']=['label' => 'Name Of the Principal', 'rules' => 'trim'];
        $validationRulesArr['art_staff_membership_no']=['label' => 'Membership Number', 'rules' => 'trim'];
        $validationRulesArr['art_staff_date_suppl_art_icai']=['label' => 'Date Of Supplementary Intimation to ICAI', 'rules' => 'trim'];
        $validationRulesArr['art_staff_date_suppl_art']=['label' => 'Date Of Supplementary Of Articleship', 'rules' => 'trim'];
        $validationRulesArr['art_staff_year_completion_inter_ca']=['label' => 'Year Of Completion Of Inter CA', 'rules' => 'trim'];
        $validationRulesArr['art_staff_year_completion_final_ca']=['label' => 'Year Of Completion Of Final CA', 'rules' => 'trim'];

        $validationRulesArr['userCAMemNo']=['label' => 'CA Membership No', 'rules' => 'trim'];
        $validationRulesArr['userCADOJ']=['label' => 'Date of Joining (CA)', 'rules' => 'trim'];
        $validationRulesArr['userCADOL']=['label' => 'Date of Leaving (CA)', 'rules' => 'trim'];
        $validationRulesArr['userICAIJoin']=['label' => 'Intimation to ICAI-Joining', 'rules' => 'trim'];
        $validationRulesArr['userICAILeave']=['label' => 'Intimation to ICAI-Leaving', 'rules' => 'trim'];
        $validationRulesArr['userPersonalRemark']=['label' => 'Remarks', 'rules' => 'trim'];
        $validationRulesArr['userContactRemark']=['label' => 'Remarks', 'rules' => 'trim'];
        $validationRulesArr['userOffAlloctRemark']=['label' => 'Remarks', 'rules' => 'trim'];
        $validationRulesArr['userArticleAsstRemark']=['label' => 'Remarks', 'rules' => 'trim'];
        $validationRulesArr['userCARemark']=['label' => 'Remarks', 'rules' => 'trim'];

        $errorArr=array();

        if(!$this->validate($validationRulesArr))
        {
            $errorArr=$this->validation->getErrors();
        }
        else
        {
            $userId=$this->request->getPost('userId');
            $userStaffType=$this->request->getPost('userStaffType');
            
            $staffCount=$this->Muser->where('userStaffType !=', 6)->where('status', 1)->countAllResults();
            
            $getAccountData = $this->Mfirm->select('ca_firm_tbl.caFirmUsers')
                            ->where('ca_firm_tbl.caFirmId', $this->sessCaFirmId)
                            ->where('ca_firm_tbl.status', 1)
                            ->get()
                            ->getRowArray();
                             
            if(!empty($getAccountData))
            {
                $caFirmUsers=$getAccountData['caFirmUsers'];
                
                // print_r('<br> staffCount : '.$staffCount);
                // print_r('<br> caFirmUsers : '.$caFirmUsers);
                // print_r('<br> userStaffType : '.$userStaffType);
                // die();
                
                if(($staffCount >= $caFirmUsers) && ($userStaffType!=6))
                {   
                    $isExceedLimit=true;
                }
                else
                {
                    $userId=$this->request->getPost('userId');
                    $userFullName=$this->request->getPost('userFullName');
                    $userImg=$this->request->getFile('userImg');
                    $userOldImg=$this->request->getPost('userOldImg');
                    $userTitle=$this->request->getPost('userTitle');
                    $userShortName=$this->request->getPost('userShortName');
                    $userDob=$this->request->getPost('userDob');
                    $userQualification=$this->request->getPost('userQualification');
                    $userRegNo=$this->request->getPost('userRegNo');
                    $userRegDocument=$this->request->getFile('userRegDocument');
                    $userRegOldDocument=$this->request->getPost('userRegOldDocument');
                    $userAadharNo=$this->request->getPost('userAadharNo');
                    $userAadharDoc=$this->request->getFile('userAadharDoc');
                    $userAadharOldDoc=$this->request->getPost('userAadharOldDoc');
                    $userPan=$this->request->getPost('userPan');
                    $userPanDoc=$this->request->getFile('userPanDoc');
                    $userPanOldDoc=$this->request->getPost('userPanOldDoc');
                    $userPassportNo=$this->request->getPost('userPassportNo');
                    $userPassportDoc=$this->request->getFile('userPassportDoc');
                    $userPassportOldDoc=$this->request->getPost('userPassportOldDoc');
                    $userMobile1=$this->request->getPost('userMobile1');
                    $userMobileWhatsApp=$this->request->getPost('userMobileWhatsApp');
                    $userResidencePhone=$this->request->getPost('userResidencePhone');
                    $userOfficePhone=$this->request->getPost('userOfficePhone');
                    $userEmail1=$this->request->getPost('userEmail1');
                    $userEmail2=$this->request->getPost('userEmail2');
                    $userResidenceAddress=$this->request->getPost('userResidenceAddress');
                    $userReference=$this->request->getPost('userReference');
                    $userRemark=$this->request->getPost('userRemark');
                    $userCV=$this->request->getFile('userCV');
                    $userOldCV=$this->request->getPost('userOldCV');
                    $isCostCenter=$this->request->getPost('isCostCenter');
                    $userStaffType=$this->request->getPost('userStaffType');
                    $fkUserCatId=$this->request->getPost('fkUserCatId');
                    $userDesgn=$this->request->getPost('userDesgn');
                    $userEmpNo=$this->request->getPost('userEmpNo');
                    $userDOJ=$this->request->getPost('userDOJ');
                    $userLoginName=$this->request->getPost('userLoginName');
                    $userPassword=$this->request->getPost('userPassword');
                    $userDOL=$this->request->getPost('userDOL');
                    $userArtRegNo=$this->request->getPost('userArtRegNo');
                    $userArtStartDate=$this->request->getPost('userArtStartDate');
                    $userArtEndDate=$this->request->getPost('userArtEndDate');
                    $userICAICommDate=$this->request->getPost('userICAICommDate');
                    $userArtComplTerminationDate=$this->request->getPost('userArtComplTerminationDate');
                    $isArticleShipContinue=$this->request->getPost('isArticleShipContinue');
                    $art_staff_name_of_principle=$this->request->getPost('art_staff_name_of_principle');
                    $art_staff_membership_no=$this->request->getPost('art_staff_membership_no');
                    $art_staff_date_suppl_art_icai=$this->request->getPost('art_staff_date_suppl_art_icai');
                    $art_staff_date_suppl_art=$this->request->getPost('art_staff_date_suppl_art');
                    $art_staff_year_completion_inter_ca=$this->request->getPost('art_staff_year_completion_inter_ca');
                    $art_staff_year_completion_final_ca=$this->request->getPost('art_staff_year_completion_final_ca');

                    $userICAIComplDate=$this->request->getPost('userICAIComplDate');
                    $userCAMemNo=$this->request->getPost('userCAMemNo');
                    $userCADOJ=$this->request->getPost('userCADOJ');
                    $userCADOL=$this->request->getPost('userCADOL');
                    $userICAIJoin=$this->request->getPost('userICAIJoin');
                    $userICAILeave=$this->request->getPost('userICAILeave');
                    $userPersonalRemark=$this->request->getPost('userPersonalRemark');
                    $userContactRemark=$this->request->getPost('userContactRemark');
                    $userOffAlloctRemark=$this->request->getPost('userOffAlloctRemark');
                    $userArticleAsstRemark=$this->request->getPost('userArticleAsstRemark');
                    $userCARemark=$this->request->getPost('userCARemark');
        
                    $userImgPath="";
                    if(!empty($userImg->getTempName()))
                    {
                        if($userImg->isValid() && !$userImg->hasMoved())
                        {
                            $ext=$userImg->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userImg->getRandomName();
                            $userImg->move($uploadPath1, $newName);
        
                            $userImgPath=$newName;
                            
                            if(!empty($userOldImg))
                            {
                                $delUploadFilePath=$uploadPath1."/".$userOldImg;
                                unlink($delUploadFilePath);
                            }
                        }
                    }
        
                    if(empty($userImgPath))
                        $userImgPath=$userOldImg;
        
                    $userRegDocumentPath="";
                    /*
                    if(!empty($userRegDocument->getTempName()))
                    {
                        if($userRegDocument->isValid() && ! $userRegDocument->hasMoved())
                        {
                            $ext=$userRegDocument->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userRegDocument->getRandomName();
                            $userRegDocument->move($uploadPath1, $newName);
        
                            $userRegDocumentPath=$newName;
                        }
                    }
                    
        
                    if(empty($userRegDocumentPath))
                        $userRegDocumentPath=$userRegOldDocument;
                    */
        
                    $userAadharDocPath="";
                    if(!empty($userAadharDoc->getTempName()))
                    {
                        if($userAadharDoc->isValid() && ! $userAadharDoc->hasMoved())
                        {
                            $ext=$userAadharDoc->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userAadharDoc->getRandomName();
                            $userAadharDoc->move($uploadPath1, $newName);
        
                            $userAadharDocPath=$newName;
                            
                            if(!empty($userAadharOldDoc))
                            {
                                $delUploadFilePath=$uploadPath1."/".$userAadharOldDoc;
                                unlink($delUploadFilePath);
                            }
                        }
                    }
        
                    if(empty($userAadharDocPath))
                        $userAadharDocPath=$userAadharOldDoc;
                        
                    $userPanDocPath="";
                    if(!empty($userPanDoc->getTempName()))
                    {
                        if($userPanDoc->isValid() && ! $userPanDoc->hasMoved())
                        {
                            $ext=$userPanDoc->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userPanDoc->getRandomName();
                            $userPanDoc->move($uploadPath1, $newName);
        
                            $userPanDocPath=$newName;
                            
                            if(!empty($userPanOldDoc))
                            {
                                $delUploadFilePath=$uploadPath1."/".$userPanOldDoc;
                                unlink($delUploadFilePath);
                            }
                        }
                    }
                    
                    if(empty($userPanDocPath))
                        $userPanDocPath=$userPanOldDoc;
                    
                    $userPassportDocPath="";
                    if(!empty($userPassportDoc->getTempName()))
                    {
                        if($userPassportDoc->isValid() && ! $userPassportDoc->hasMoved())
                        {
                            $ext=$userPassportDoc->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userPassportDoc->getRandomName();
                            $userPassportDoc->move($uploadPath1, $newName);
        
                            $userPassportDocPath=$newName;
                            
                            if(!empty($userPassportOldDoc))
                            {
                                $delUploadFilePath=$uploadPath1."/".$userPassportOldDoc;
                                unlink($delUploadFilePath);
                            }
                        }
                    }
                    
                    if(empty($userPassportDocPath))
                        $userPassportDocPath=$userPassportOldDoc;
        
                    $userCVPath="";
                    if(!empty($userCV->getTempName()))
                    {
                        if($userCV->isValid() && ! $userCV->hasMoved())
                        {
                            $ext=$userCV->guessExtension();
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;
        
                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);
        
                            $uploadPath1=$uploadPath.'/documents';
        
                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
        
                            $newName = $userCV->getRandomName();
                            $userCV->move($uploadPath1, $newName);
        
                            $userCVPath=$newName;
                            
                            if(!empty($userOldCV))
                            {
                                $delUploadFilePath=$uploadPath1."/".$userOldCV;
                                unlink($delUploadFilePath);
                            }
                        }
                    }
        
                    if(empty($userCVPath))
                        $userCVPath=$userOldCV;
        
                    $userUpdateArr = [
                        'userFullName'=>$userFullName,
                        'userImg'=>$userImgPath,
                        'userTitle'=>$userTitle,
                        'userShortName'=>$userShortName,
                        'userDob'=>$userDob,
                        'userQualification'=>$userQualification,
                        // 'userRegNo'=>$userRegNo,
                        // 'userRegDocument'=>$userRegDocumentPath,
                        'userAadharNo'=>$userAadharNo,
                        'userAadharDoc'=>$userAadharDocPath,
                        'userPan'=>$userPan,
                        'userPanDoc'=>$userPanDocPath,
                        'userPassportNo'=>$userPassportNo,
                        'userPassportDoc'=>$userPassportDocPath,
                        'userMobile1'=>$userMobile1,
                        'userMobileWhatsApp'=>$userMobileWhatsApp,
                        'userResidencePhone'=>$userResidencePhone,
                        'userOfficePhone'=>$userOfficePhone,
                        'userEmail1'=>$userEmail1,
                        'userEmail2'=>$userEmail2,
                        'userResidenceAddress'=>$userResidenceAddress,
                        'userReference'=>$userReference,
                        'userRemark'=>$userRemark,
                        'userCV'=>$userCVPath,
                        'isCostCenter'=>$isCostCenter,
                        'userStaffType'=>$userStaffType,
                        'fkUserCatId'=>$fkUserCatId,
                        'userDesgn'=>$userDesgn,
                        'userEmpNo'=>$userEmpNo,
                        'userDOJ'=>$userDOJ,
                        'userLoginName'=>$userLoginName,
                        // 'userPassword'=>$userPassword,
                        'userDOL'=>$userDOL,
                        'userArtRegNo'=>$userArtRegNo,
                        'userArtStartDate'=>$userArtStartDate,
                        'userArtEndDate'=>$userArtEndDate,
                        'userArtComplTerminationDate'=>$userArtComplTerminationDate,
                        'isArticleShipContinue'=>$isArticleShipContinue,
                        
                        'art_staff_year_completion_inter_ca'=>$art_staff_year_completion_inter_ca,
                        'art_staff_year_completion_final_ca'=>$art_staff_year_completion_final_ca,
                        'art_staff_name_of_principle'=>$art_staff_name_of_principle,
                        'art_staff_membership_no'=>$art_staff_membership_no,
                        'art_staff_date_suppl_art_icai'=>$art_staff_date_suppl_art_icai,
                        'art_staff_date_suppl_art'=>$art_staff_date_suppl_art,

                        'userICAICommDate'=>$userICAICommDate,
                        'userICAIComplDate'=>$userICAIComplDate,
                        'userCAMemNo'=>$userCAMemNo,
                        'userCADOJ'=>$userCADOJ,
                        'userCADOL'=>$userCADOL,
                        'userICAIJoin'=>$userICAIJoin,
                        'userICAILeave'=>$userICAILeave,
                        'userPersonalRemark'=>$userPersonalRemark,
                        'userContactRemark'=>$userContactRemark,
                        'userOffAlloctRemark'=>$userOffAlloctRemark,
                        'userArticleAsstRemark'=>$userArticleAsstRemark,
                        'userCARemark'=>$userCARemark,
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
                    
                    if(!empty($userPassword))
                    {
                        $userPassword=md5($userPassword);
                        
                        $userUpdateArr['userPassword']=$userPassword;
                    }
        
                    $userCondtnArr['user_tbl.userId']=$userId;

                    // Articleship Code Start
                    if($isArticleShipContinue==2 || $isArticleShipContinue==1){
                        $upsertArticleshipArr=[];

                        $upsertArticleshipArr=[
                            'art_staff_name'=>$userFullName,
                            'art_staff_img'=>$userImgPath,
                            'art_staff_name_of_principle'=>$art_staff_name_of_principle,
                            'art_staff_reg_no'=>$userArtRegNo,
                            'art_staff_membership_no'=>$art_staff_membership_no,
                            'art_staff_date_commencement'=>$userArtStartDate,
                            'art_staff_date_intimation_icai'=>$userICAICommDate,
                            'art_staff_date_suppl_art_icai'=>$art_staff_date_suppl_art_icai,
                            'art_staff_date_completion_art_icai'=>$userICAIComplDate,
                            'art_staff_date_suppl_art'=>$art_staff_date_suppl_art,
                            'art_staff_date_completion_art'=>$userArtEndDate,
                            'art_staff_year_completion_inter_ca'=>$art_staff_year_completion_inter_ca,
                            'art_staff_year_completion_final_ca'=>$art_staff_year_completion_final_ca,
                            'art_staff_job_status'=>"",
                            'art_staff_remark'=>"",
                            'fkUserId'=>$userId,
                            'isAddedFromUser'=>2,
                        ];

                        $articleShipCondtnArr['articleship_staff_tbl.fkUserId'] = $userId;
                        $articleShipOrderByArr['articleship_staff_tbl.art_staff_name'] = "ASC";
                
                        $articleShipQuery = $this->Mquery->getRecords($tableName = $this->articleship_staff_tbl, $colNames = "articleship_staff_tbl.*", $articleShipCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = TRUE, $articleShipOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());
                
                        $getArticleShipUserData = $articleShipQuery['userData'];
                     
                        if(!empty($getArticleShipUserData)){

                            $articleShipUpdateCondtn = array(
                                'fkUserId' =>  $userId,
                            );
                            $upsertArticleshipArr["status"]=1;
                            $upsertArticleshipArr["updatedBy"]=$this->adminId;
                            $upsertArticleshipArr["updatedDatetime"]=$this->currTimeStamp;
                                
                            $response = $this->MArticleshipStaff->set($upsertArticleshipArr)->where($articleShipUpdateCondtn)->update();
                        }else{
                           
                            $upsertArticleshipArr["status"]=1;
                            $upsertArticleshipArr["createdBy"]=$this->adminId;
                            $upsertArticleshipArr["createdDatetime"]=$this->currTimeStamp;

                            $this->MArticleshipStaff->save($upsertArticleshipArr);
                        }
                    }
                    
                    if($isArticleShipContinue==2){//Inactive User No
                        // $userUpdateArr['status']=2;
                        $upsertArticleshipArr["isOldUser"]=1;
                    }else if($isArticleShipContinue==1){
                        // $userUpdateArr['status']=1;//Continue Yes
                        $upsertArticleshipArr["isOldUser"]=2;
                    }
                    // Articleship Code End
                    // print_r($userPassword);
                    // print_r($userUpdateArr);
                    // die();
        
                    $query=$this->Mquery->updateData($tableName=$this->user_tbl, $userUpdateArr, $userCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                   
                    
                    $sbGrpArr=$this->Mcontsubgroup->where('fk_cont_group_id', 2)->findAll();
        	    
            	    $sbGrpArray=array();
            	    
            	    if(!empty($sbGrpArr))
            	    {
            	        foreach($sbGrpArr AS $e_row)
            	        {
            	            $sbGrpArray[$e_row['refId']]=$e_row['cont_sub_group_id'];
            	        }
            	    }
            	    
            	    $staffContactDataArr=$this->Mcontact->where('contGroupId', 2)->where('contRefId', $userId)->where('status', 1)->get()->getRowArray();
            	    $staffDataArr=$this->Muser->where('userId', $userId)->where('status', 1)->get()->getRowArray();
            	    
            	    if(!empty($staffDataArr))
        	        {
        	            $contGroupId=2;
        	            
        	            if(!empty($sbGrpArray[$staffDataArr['userStaffType']]))
                            $contSubGroupId=$sbGrpArray[$staffDataArr['userStaffType']];
                        else
                            $contSubGroupId="";
                        
                        $contFullName=$staffDataArr['userFullName'];
                        $contOrgName=$this->sessCaFirmName;
                        $contMob1=$staffDataArr['userMobile1'];
                        $contMob2=$staffDataArr['userMobileWhatsApp'];
                        $contEmail=$staffDataArr['userEmail1'];
                        $contResiAddress=$staffDataArr['userResidenceAddress'];
                        $contResiNum=$staffDataArr['userResidencePhone'];
                        $contOfficeAddress="";
                        $contOfficeNum=$staffDataArr['userOfficePhone'];
                        $contRegOffice="";
                        $contRegOfficeNum="";
                        $contFactOffice="";
                        $contFactNum="";
                        $contRefId=$staffDataArr['userId'];
                        
                        $insertArr=[
                            'contactId'=>$staffContactDataArr['contactId'],
                            'contGroupId'=>$contGroupId,
                            'contSubGroupId'=>$contSubGroupId,
                            'contFullName'=>$contFullName,
                            'contOrgName'=>$contOrgName,
                            'contMob1'=>$contMob1,
                            'contMob2'=>$contMob2,
                            'contEmail'=>$contEmail,
                            'contResiAddress'=>$contResiAddress,
                            'contResiNum'=>$contResiNum,
                            'contOfficeAddress'=>$contOfficeAddress,
                            'contOfficeNum'=>$contOfficeNum,
                            'contRegOffice'=>$contRegOffice,
                            'contRegOfficeNum'=>$contRegOfficeNum,
                            'contFactOffice'=>$contFactOffice,
                            'contFactNum'=>$contFactNum,
                            'contRefId'=>$contRefId,
                            'updatedBy' => $this->adminId,
                            'updatedDatetime' => $this->currTimeStamp
                        ];
                	    
                	    $this->Mcontact->save($insertArr);
        	        }
                }
            }
        }

        if($this->db->transStatus() === FALSE || !empty($errorArr) || $isExceedLimit==true){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="User has not added :(";
            $responseArr['userdata']=$errorArr;
            
            if($isExceedLimit)
            {
                $responseArr['isExceedLimit']="true";
            }

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="User";
            $insertLogArr['message']="User added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="User has been added successfully :)";
            $responseArr['userdata']=$errorArr;
            $responseArr['isExceedLimit']="";

            $this->session->setFlashdata('successMsg', "User has been added successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function delete_user()
    {
        $userId=$this->request->getPost('userId');

	    $dataArray = [
            'userId' => $userId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Muser->save($dataArray)){
            
            $insertLogArr['section']="User";
            $insertLogArr['message']="User deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="User has been deleted successfully :)";
            $responseArr['userdata']=array();
        }else{
            $responseArr['status']=FALSE;
            $responseArr['message']="User has not delete :(";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }

    public function getOptions()
    {
        $due_act=$this->request->getPost('due_act');
        $option_type=$this->request->getPost('option_type');

        $resultArr=$this->Mact_option->where('act_option_map_tbl.fk_act_id', $due_act)
            ->where('act_option_map_tbl.option_type', $option_type)
            ->where('act_option_map_tbl.status', 1)
            ->findAll();

        $this->data['resultArr']=$resultArr;

        return view('remote/admin/getOptions', $this->data);
    }

    public function add_remote_client_group()
    {
        $this->db->transBegin();

        $client_group=$this->request->getPost('mclient_group');
        $client_group_number=$this->request->getPost('mgroup_number');
        $client_group_cost=$this->request->getPost('mcost_center');
        $client_group_category=$this->request->getPost('mcategory');

        $clientGrpInsertArr[] = [
            'client_group'=>$client_group,
            'client_group_number'=>$client_group_number,
            'client_group_cost'=>$client_group_cost,
            'client_group_category'=>$client_group_category,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        // $this->Mgroup->save($clientGrpInsertArr);

        $query=$this->Mquery->insert($tableName=$this->client_group_tbl, $clientGrpInsertArr, $returnType="");
        
        $client_group_id=$query['lastID'];

        $userDataArr['client_group_id']=$client_group_id;
        $userDataArr['client_group']=$client_group;
            
        $contactSubGrpInsertArr=[
            'cont_sub_group_name'=>$client_group,
            'fk_cont_group_id'=>1,
            'refId'=>$client_group_id,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
        
        $this->Mcontsubgroup->save($contactSubGrpInsertArr);

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="Client group has not added :(";
            $responseArr['userdata']=array();

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="Client group";
            $insertLogArr['message']="Client group added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client group has been added successfully :)";
            $responseArr['userdata']=$userDataArr;

            // $this->session->setFlashdata('successMsg', "Client group has been added successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function getActForm()
    {
        $selAct=$this->request->getPost('selAct');
        $selActName=$this->request->getPost('selActName');
        $clientName=$this->request->getPost('clientName');
        $clientBussOrganisation=$this->request->getPost('clientBussOrganisation');
        $clientBussOrganisationTypeId=$this->request->getPost('clientBussOrganisationTypeId');
        $clientBussOrganisationType=$this->request->getPost('clientBussOrganisationType');
        $clientRegDocument=$this->request->getPost('clientRegDocument');
        $panNo=$this->request->getPost('panNo');
        $tanNo=$this->request->getPost('tanNo');
        $aadharNo=$this->request->getPost('aadharNo');
        $dinNo=$this->request->getPost('dinNo');
        $gstNo=$this->request->getPost('gstNo');
        $ptEnrollNo=$this->request->getPost('ptEnrollNo');
        $ptRegNo=$this->request->getPost('ptRegNo');
        $udyamNo=$this->request->getPost('udyamNo');
        $impExpNo=$this->request->getPost('impExpNo');
        $shopEstNo=$this->request->getPost('shopEstNo');
        $wardNo=$this->request->getPost('wardNo');
        $tmNo=$this->request->getPost('tmNo');
        $tcsNo=$this->request->getPost('tcsNo');

        $this->data['selAct']=$selAct;
        $this->data['selActName']=$selActName;
        $this->data['clientName']=$clientName;
        $this->data['clientBussOrganisation']=$clientBussOrganisation;
        $this->data['clientBussOrganisationTypeId']=$clientBussOrganisationTypeId;
        $this->data['clientBussOrganisationType']=$clientBussOrganisationType;
        $this->data['clientRegDocument']=$clientRegDocument;
        $this->data['panNo']=$panNo;
        $this->data['tanNo']=$tanNo;
        $this->data['aadharNo']=$aadharNo;
        $this->data['dinNo']=$dinNo;
        $this->data['gstNo']=$gstNo;
        $this->data['ptEnrollNo']=$ptEnrollNo;
        $this->data['ptRegNo']=$ptRegNo;
        $this->data['udyamNo']=$udyamNo;
        $this->data['impExpNo']=$impExpNo;
        $this->data['shopEstNo']=$shopEstNo;
        $this->data['wardNo']=$wardNo;
        $this->data['tmNo']=$tmNo;
        $this->data['tcsNo']=$tcsNo;

        $dueDateForArr=$this->Mact_option->where('act_option_map_tbl.fk_act_id', $selAct)
            ->where('act_option_map_tbl.option_type', 1)
            ->where('act_option_map_tbl.status', 1)
            ->orderBy('act_option_map_tbl.act_option_name', 'ASC')
            ->findAll();

        $this->data['dueDateForArr']=$dueDateForArr;

        $taxPayerArr=$this->Mact_option->where('act_option_map_tbl.fk_act_id', $selAct)
            ->where('act_option_map_tbl.option_type', 2)
            ->where('act_option_map_tbl.status', 1)
            ->findAll();

        $this->data['taxPayerArr']=$taxPayerArr;

        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;
        
        $conditionArr = $this->Mdue_date->select('act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name')
                    ->join('act_option_map_tbl', 'act_option_map_tbl.act_option_map_id=due_date_master_tbl.condtn AND act_option_map_tbl.option_type=6', 'left')
                    ->like('due_date_master_tbl.orgTypes', "|".$clientBussOrganisationTypeId."|")
                    ->where('due_date_master_tbl.status', 1)
                    ->where('act_option_map_tbl.status', 1)
                    ->groupBy('act_option_map_tbl.act_option_map_id')
                    ->findAll();

        $this->data['conditionArr']=$conditionArr;
        
        // print_r($clientBussOrganisationTypeId);
        // echo $this->db->getLastQuery();
        // die();

        return view('remote/admin/getActForm', $this->data);
    }

    public function search_due_date()
    {
        $actDueDateFor=$this->request->getPost('actDueDateFor');
        $actPeriodicity=$this->request->getPost('actPeriodicity');
        $actTaxPayer=$this->request->getPost('actTaxPayer');
        $actCondition=$this->request->getPost('actCondition');
        $actId=$this->request->getPost('actId');
        $actName=$this->request->getPost('actName');
        $prevActs=$this->request->getPost('prevActs');
        
        $prevActArr=array();
        
        if(!empty($prevActs))
            $prevActArr=explode(',', $prevActs);

        $this->data['actId']=$actId;
        $this->data['actName']=$actName;
        
        $isActSel="";
        
        if(in_array($actId, $prevActArr))
            $isActSel="selected";
            
        $this->data['isActSel']=$isActSel;
        
        $taxLikeCondtnArr=array();
        
        if(!empty($actDueDateFor))
            $taxCondtnArr['due_date_master_tbl.due_date_for']=$actDueDateFor;
        
        if(!empty($actPeriodicity))
            $taxCondtnArr['due_date_master_tbl.periodicity']=$actPeriodicity;

        // if(!empty($actTaxPayer))
        //     $taxCondtnArr['due_date_master_tbl.tax_payer']=$actTaxPayer;
            
        if(!empty($actTaxPayer))
            $taxCondtnArr['organisation_type_tbl.organisation_type_id']=$actTaxPayer;
            
        if(!empty($actCondition))
            $taxCondtnArr['due_date_master_tbl.condtn']=$actCondition;
            
        // if(!empty($actTaxPayer))
            // $taxLikeCondtnArr['due_date_master_tbl.orgTypes']="|".$actTaxPayer."|";
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $taxCondtnArr['due_date_master_tbl.due_date >=']=$fromDate;
        $taxCondtnArr['due_date_master_tbl.due_date <=']=$toDate;

        $taxCondtnArr['due_date_master_tbl.due_act']=$actId;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxOrderByArr['act_tbl.act_name']="ASC";
        $taxOrderByArr['due_date_master_tbl.due_date']="ASC";

        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        // $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames="due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, ext_due_date_master_tbl.extended_date, organisation_type_tbl.organisation_type_name AS tax_payer_val", $taxCondtnArr, $taxLikeCondtnArr, $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];

        $this->data['dueDatesArr']=$dueDatesArr;

        return view('remote/admin/search_due_date', $this->data);
    }

    public function set_cust_due_date()
    {
        $this->data['due_date_for']=$due_date_for=$this->request->getPost('due_date_for');
        $this->data['applicable_form']=$applicable_form=$this->request->getPost('applicable_form');
        $this->data['under_section']=$under_section=$this->request->getPost('under_section');
        $this->data['periodicity']=$periodicity=$this->request->getPost('periodicity');
        $this->data['daily_date']=$daily_date=$this->request->getPost('daily_date');
        $this->data['period_month']=$period_month=$this->request->getPost('period_month');
        $this->data['period_year']=$period_year=$this->request->getPost('period_year');
        $this->data['f_period_month']=$f_period_month=$this->request->getPost('f_period_month');
        $this->data['f_period_year']=$f_period_year=$this->request->getPost('f_period_year');
        $this->data['t_period_month']=$t_period_month=$this->request->getPost('t_period_month');
        $this->data['t_period_year']=$t_period_year=$this->request->getPost('t_period_year');
        $this->data['finYear']=$finYear=$this->request->getPost('finYear');
        $this->data['event_date']=$event_date=$this->request->getPost('event_date');
        $this->data['due_date']=$due_date=$this->request->getPost('due_date');
        $this->data['due_notes']=$due_notes=$this->request->getPost('due_notes');
        $this->data['due_act']=$due_act=$this->request->getPost('due_act');
        $this->data['due_act_name']=$due_act_name=$this->request->getPost('due_act_name');
        $this->data['due_state']=$due_state=$this->request->getPost('due_state');
        $prevCustActs=$this->request->getPost('prevCustActs');

        $prevCustActArr=array();
        
        if(!empty($prevCustActs))
            $prevCustActArr=explode(',', $prevCustActs);

        $isActSel="";
        
        if(in_array($due_act, $prevCustActArr))
            $isActSel="selected";
            
        $this->data['isActSel']=$isActSel;

        $randomId = uniqid() . mt_rand();

        $this->data['randomId']=$randomId;
        
        return view('remote/admin/set_cust_due_date', $this->data);
    }

    public function edit_cust_due_date()
    {
        $this->db->transBegin();

        $non_rglr_due_date_id=$this->request->getPost('non_rglr_due_date_id');
        $due_date_for=$this->request->getPost('non_rglr_due_date_for');
        $applicable_form=$this->request->getPost('non_rglr_applicable_form');
        $under_section=$this->request->getPost('non_rglr_under_section');
        $periodicity=$this->request->getPost('periodicity');
        $daily_date=$this->request->getPost('daily_date');
        $period_month=$this->request->getPost('period_month');
        $period_year=$this->request->getPost('period_year');
        $f_period_month=$this->request->getPost('f_period_month');
        $f_period_year=$this->request->getPost('f_period_year');
        $t_period_month=$this->request->getPost('t_period_month');
        $t_period_year=$this->request->getPost('t_period_year');
        $finYear=$this->request->getPost('non_rglr_finYear');
        $event_date=$this->request->getPost('non_rglr_event_date');
        $due_date=$this->request->getPost('non_rglr_due_date');
        $due_notes=$this->request->getPost('non_rglr_due_notes');
        $due_state=$this->request->getPost('non_rglr_due_state');

        $eventDDUpdateArr=[
            'non_rglr_due_date_id'=>$non_rglr_due_date_id,
            "non_rglr_due_state" => $due_state,
            "non_rglr_due_date_for" => $due_date_for,
            "non_rglr_applicable_form" => $applicable_form,
            "non_rglr_under_section" => $under_section,
            "non_rglr_periodicity" => $periodicity,
            "non_rglr_daily_date" => $daily_date,
            "non_rglr_period_month" => $period_month,
            "non_rglr_period_year" => $period_year,
            "non_rglr_f_period_month" => $f_period_month,
            "non_rglr_f_period_year" => $f_period_year,
            "non_rglr_t_period_month" => $t_period_month,
            "non_rglr_t_period_year" => $t_period_year,
            "non_rglr_finYear" => $finYear,
            "non_rglr_due_date" => $due_date,
            "non_rglr_event_date" => $event_date,
            "non_rglr_due_notes" => $due_notes,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
        
        $this->MNonRegularDueDates->save($eventDDUpdateArr);

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="Event Based Due Date details has not update :(";
            $responseArr['userdata']=array();

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="Event Based Due Date";
            $insertLogArr['message']="Event Based Due Date updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Event Based Due Date details has been updated successfully :)";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }

    public function delete_client_due_date()
    {
        $this->db->transBegin();
        
        $enableAct=false;
         
        $due_date_id=$this->request->getPost('due_date_id');
        $client_id=$this->request->getPost('client_id');
        $act_id=$this->request->getPost('act_id');
        $orgtype=$this->request->getPost('orgtype');
        
        $workActUpdateArr = [
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $workActCondtnArr['work_tbl.fk_due_date_id']=$due_date_id;
        $workActCondtnArr['work_tbl.fkClientId']=$client_id;

        $query=$this->Mquery->updateData($tableName=$this->work_tbl, $workActUpdateArr, $workActCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.fkClientId']=$client_id;
        $workCondtnArr['due_date_master_tbl.due_act']=$act_id;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.fk_org_type_id']=$orgtype;
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
        
        if(empty($workDataArr))
        {
            $clientActUpdateArr = [
                'status' => 2,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];
    
            $clientActCondtnArr['client_act_map_tbl.fkActId']=$act_id;
            $clientActCondtnArr['client_act_map_tbl.fkClientId']=$client_id;
    
            $query=$this->Mquery->updateData($tableName=$this->client_act_map_tbl, $clientActUpdateArr, $clientActCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
            
            $enableAct=true;
        }
        
        $taxPmtCondtnArr['tax_payment_tbl.fkDueDateId']=$due_date_id;
        $taxPmtCondtnArr['tax_payment_tbl.fkClientId']=$client_id;
        $taxPmtCondtnArr['tax_payment_tbl.status']="1";

        $query=$this->Mquery->getRecords($tableName=$this->tax_payment_tbl, $colNames="tax_payment_tbl.fkDueDateId", $taxPmtCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $taxPmtActDataArr=$query['userData'];
        
        if(!empty($taxPmtActDataArr))
        {
            $taxPmtUpdateArr = [
                'status' => 2,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];
    
            $taxPmtCondtnUpdateArr['tax_payment_tbl.fkDueDateId']=$due_date_id;
            $taxPmtCondtnUpdateArr['tax_payment_tbl.fkClientId']=$client_id;
    
            $query=$this->Mquery->updateData($tableName=$this->tax_payment_tbl, $taxPmtUpdateArr, $taxPmtCondtnUpdateArr, $likeCondtnArr=array(), $whereInArray=array());
        }
        
        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();
            
            $responseArr['enableAct']=FALSE;
            $responseArr['status']=FALSE;
            $responseArr['message']="Client due date has not delete :(";
            $responseArr['userdata']=array();
            
        }else{
            
            $this->db->transCommit();
            
            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client Due Date Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);
            
            if($enableAct)
                $responseArr['enableAct']=TRUE;
            else
                $responseArr['enableAct']=FALSE;
                
            $responseArr['status']=TRUE;
            $responseArr['message']="Client due date has been deleted successfully :)";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }

    public function delete_client_event_due_date()
    {
        $this->db->transBegin();
        
        $enableAct=false;

        $due_date_id=$this->request->getPost('due_date_id');
        $client_id=$this->request->getPost('client_id');
        $act_id=$this->request->getPost('act_id');
        
        $eventActUpdateArr = [
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $eventActCondtnArr['non_regular_due_date_tbl.non_rglr_due_date_id']=$due_date_id;
        $eventActCondtnArr['non_regular_due_date_tbl.fkClientId']=$client_id;

        $query=$this->Mquery->updateData($tableName=$this->non_regular_due_date_tbl, $eventActUpdateArr, $eventActCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $eventCondtnArr['non_regular_due_date_tbl.non_rglr_due_date >=']=$fromDate;
        $eventCondtnArr['non_regular_due_date_tbl.non_rglr_due_date <=']=$toDate;
        
        $eventCondtnArr['non_regular_due_date_tbl.fkClientId']=$client_id;
        $eventCondtnArr['non_regular_due_date_tbl.non_rglr_due_act']=$act_id;
        $eventCondtnArr['non_regular_due_date_tbl.status']="1";

        $eventJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=non_regular_due_date_tbl.non_rglr_due_act", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->non_regular_due_date_tbl, $colNames="non_regular_due_date_tbl.non_rglr_due_date_id", $eventCondtnArr, $likeCondtnArr=array(), $eventJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $eventDataArr=$query['userData'];
        
        if(empty($eventDataArr))
        {
            $enableAct=true;
        }
        
        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();
            
            $responseArr['enableAct']=FALSE;
            $responseArr['status']=FALSE;
            $responseArr['message']="Client's event due date has not delete :(";
            $responseArr['userdata']=array();
            
        }else{
            
            $this->db->transCommit();
            
            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client's Event Due Date Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);
            
            if($enableAct)
                $responseArr['enableAct']=TRUE;
            else
                $responseArr['enableAct']=FALSE;
                
            $responseArr['status']=TRUE;
            $responseArr['message']="Client's event due date has been deleted successfully :)";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }
    
    public function delete_rectification()
    {
        $rectificationId=$this->request->getPost('rectificationId');
        $workId=$this->request->getPost('workId');
        
        $rectUpdateArr = [
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $rectCondtnArr['rectification_tbl.fkWorkId']=$workId;
        $rectCondtnArr['rectification_tbl.rectificationId']=$rectificationId;

        $query=$this->Mcommon->updateData($tableName=$this->rectification_tbl, $rectUpdateArr, $rectCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
	    
        if($query['status']==true){
            
            $insertLogArr['section']="Rectification";
            $insertLogArr['message']="Rectification deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Rectification has been deleted successfully :)";
            $responseArr['userdata']=array();
        }else{
            $responseArr['status']=FALSE;
            $responseArr['message']="Rectification has not delete :(";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }
    
    public function delete_user_document_file()
	{
	    $this->db->transBegin();
        
        $userId=$this->request->getPost('userId');
        $userDocType=$this->request->getPost('userDocType');
        
        $userDocFileData = [
            1 => "userAadharDoc",
            2 => "userPanDoc",
            3 => "userPassportDoc",
            4 => "userImg",
            5 => "userCV"
        ];
        
        $userDocNameData = [
            1 => "Aadhar Document",
            2 => "PAN Document",
            3 => "Passport Document",
            4 => "Photo",
            5 => "CV"
        ];
        
        $userDocFileColumn=$userDocFileData[$userDocType];
        $userDocName=$userDocNameData[$userDocType];
        
        $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";

        $columnNames = "user_tbl.userId, user_tbl.userAadharDoc, user_tbl.userPanDoc, user_tbl.userPassportDoc, user_tbl.userImg, user_tbl.userCV";
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames=$columnNames, $userCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userDocArr=$query['userData'];
        
        if(!empty($userDocArr))
        {
            $userDocFile=$userDocArr[$userDocFileColumn];
            
            if(!empty($userDocFile))
            {
                $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId.'/documents/'.$userDocFile;
                
                if(unlink($uploadPath))
                {
                    $usrUpdateArr = [
                        $userDocFileColumn  =>  "",
                        'updatedBy'         => $this->adminId,
                        'updatedDatetime'   => $this->currTimeStamp
                    ];
        
                    $usrCondtnArr['user_tbl.userId']=$userId;
        
                    $query=$this->Mcommon->updateData($tableName=$this->user_tbl, $usrUpdateArr, $usrCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Errror while deleting User ".$userDocName." :(");
                }
            }
        }
        else
        {
            $this->session->setFlashdata('errorMsg', "Something went wrong!!, User ".$userDocName." File not deleted :(");
        }

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, User ".$userDocName." File not deleted :(");
            
            return false;
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']="User";
            $insertLogArr['message']="User ".$userDocName." File deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "User ".$userDocName." File has been deleted successfully :)");
            
            return true;
        }
	}
}

?>
