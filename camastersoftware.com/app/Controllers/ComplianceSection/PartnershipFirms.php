<?php namespace App\Controllers\ComplianceSection;
use \App\Controllers\BaseController;

class PartnershipFirms extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Partnership Firms";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mclient = new \App\Models\Mclient();
        $this->Mdeedtype = new \App\Models\Mdeedtype();
        $this->Mformnumber = new \App\Models\Mformnumber();
        $this->MfirmDeed = new \App\Models\MfirmDeed();
        $this->MfirmPartner = new \App\Models\MfirmPartner();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->firm_deed_tbl=$tableArr['firm_deed_tbl'];
        $this->firm_partner_tbl=$tableArr['firm_partner_tbl'];
        $this->deed_type_tbl=$tableArr['deed_type_tbl'];
        $this->form_number_tbl=$tableArr['form_number_tbl'];
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Partnership Firms";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_tbl.clientBussOrganisationType']=4;
        
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType, client_tbl.clientRegDocument, client_group_tbl.client_group, client_group_tbl.client_group_number", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientList=$query['userData'];
        
        $this->data['clientList']=$clientList;
        
        $ptFirmDeedCondtn['firm_deed_tbl.status']=1;
        
        $ptFirmDeedArr = $this->MfirmDeed->where($ptFirmDeedCondtn)->findAll();
        
        $ptFirmDeedData = array();
        
        if(!empty($ptFirmDeedArr))
        {
            foreach($ptFirmDeedArr AS $e_pt_firm)
            {
                $ptFirmDeedData[$e_pt_firm['fkClientId']][$e_pt_firm['deedType']]=$e_pt_firm;
            }
        }
        
        $this->data['ptFirmDeedData']=$ptFirmDeedData;

        return view('firm_panel/compliance/partnership_firms/list', $this->data);
    }
    
	public function deeds($clientId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Partnership Deeds";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['clientId']=$clientId;
        
        $clientCondtn['client_tbl.clientId']=$clientId;
        $clientCondtn['client_tbl.status']=1;
        $clientCondtn['client_tbl.isOldClient']=2;
        $clientCondtn['client_tbl.clientBussOrganisationType']=4;
        
        $clientDataArr = $this->Mclient->where($clientCondtn)->first();
        
        $this->data['clientDataArr']=$clientDataArr;
        
        $deedCondtnArr['firm_deed_tbl.actType']=1;
        $deedCondtnArr['firm_deed_tbl.fkClientId']=$clientId;
        $deedCondtnArr['firm_deed_tbl.status']=1;
        
        $deedOrderByArr['firm_deed_tbl.firmDeedId']="ASC";
        
        $deedJoinArr[]=array("tbl"=>$this->deed_type_tbl, "condtn"=>"deed_type_tbl.deedTypeId=firm_deed_tbl.deedType", "type"=>"left");
        $deedJoinArr[]=array("tbl"=>$this->form_number_tbl, "condtn"=>"form_number_tbl.formNumberId=firm_deed_tbl.formNumber", "type"=>"left");
        
        $columnNames="
            firm_deed_tbl.firmDeedId,
            firm_deed_tbl.executionDate,
            firm_deed_tbl.effectiveDate,
            deed_type_tbl.deedTypeName
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->firm_deed_tbl, $colNames=$columnNames, $deedCondtnArr, $likeCondtnArr=array(), $deedJoinArr, $singleRow=FALSE, $deedOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $deedList=$query['userData'];
        
        $this->data['deedList']=$deedList;

        return view('firm_panel/compliance/partnership_firms/deeds', $this->data);
    }
    
	public function add_deed($clientId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Partnership Deeds - Add Deed";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['clientId']=$clientId;
        
        $clientCondtn['client_tbl.clientId']=$clientId;
        $clientCondtn['client_tbl.status']=1;
        $clientCondtn['client_tbl.isOldClient']=2;
        $clientCondtn['client_tbl.clientBussOrganisationType']=4;
        
        $clientDataArr = $this->Mclient->where($clientCondtn)->first();
        
        $this->data['clientDataArr']=$clientDataArr;
        
        $deedTypeCondtn['deed_type_tbl.status']=1;
        
        $deedTypeArr = $this->Mdeedtype->where($deedTypeCondtn)->findAll();
        
        $this->data['deedTypeArr']=$deedTypeArr;
        
        $formNoCondtn['form_number_tbl.status']=1;
        $formNoCondtn['form_number_tbl.type']=1;
        
        $formNoArr = $this->Mformnumber->where($formNoCondtn)->findAll();
        
        $this->data['formNoArr']=$formNoArr;
        
        $ptFirmDeedCondtn['firm_deed_tbl.status']=1;
        $ptFirmDeedCondtn['firm_deed_tbl.actType']=1;
        $ptFirmDeedCondtn['firm_deed_tbl.fkClientId']=$clientId;
        
        $ptFirmDeedArr = $this->MfirmDeed->where($ptFirmDeedCondtn)->orderBy("firm_deed_tbl.firmDeedId", "DESC")->first();
        
        $this->data['ptFirmDeedArr']=$ptFirmDeedArr;
        
        $firmPtArr=array();
        
        if(!empty($ptFirmDeedArr))
        {
            $firmDeedId = $ptFirmDeedArr['firmDeedId'];
            
            $firmPtCondtn['firm_partner_tbl.status']=1;
            $firmPtCondtn['firm_partner_tbl.fkFirmDeedId']=$firmDeedId;
            
            $firmPtArr = $this->MfirmPartner->where($firmPtCondtn)->findAll();
        }
        $this->data['firmPtArr']=$firmPtArr;
        
        return view('firm_panel/compliance/partnership_firms/add_deed', $this->data);
    }
    
    public function create_deed()
	{
	    $this->db->transBegin();
	    
	    $fkClientId=$this->request->getPost('fkClientId');
	    $deedNumber=$this->request->getPost('deedNumber');
	    $deedType=$this->request->getPost('deedType');
	    $executionDate=$this->request->getPost('executionDate');
	    $effectiveDate=$this->request->getPost('effectiveDate');
	    $formNumber=$this->request->getPost('formNumber');
	    $formFiledOn=$this->request->getPost('formFiledOn');
	    $amountPaid=$this->request->getPost('amountPaid');
	    $extractRecvdOn=$this->request->getPost('extractRecvdOn');
	    $registrationNumber=$this->request->getPost('registrationNumber');
	    $registrationOn=$this->request->getPost('registrationOn');
	    $registeredAddress=$this->request->getPost('registeredAddress');
	    $adminOfficeAddress=$this->request->getPost('adminOfficeAddress');
	    $factoryAddress=$this->request->getPost('factoryAddress');
	    $remarks=$this->request->getPost('remarks');
	    
	    $firmPartnerName=$this->request->getPost('firmPartnerName');
	    $isWorking=$this->request->getPost('isWorking');
	    $admissionDate=$this->request->getPost('admissionDate');
	    $retirementDate=$this->request->getPost('retirementDate');
	    $salaryPercentage=$this->request->getPost('salaryPercentage');
	    $interestPercentage=$this->request->getPost('interestPercentage');
	    $profitPercentage=$this->request->getPost('profitPercentage');
	    $lossPercentage=$this->request->getPost('lossPercentage');
	    
	    $firmDeedInsertArr=[
            'actType'               =>  1,
            'fkClientId'            =>  $fkClientId,
            'deedNumber'            =>  $deedNumber,
            'deedType'              =>  $deedType,
            'executionDate'         =>  $executionDate,
            'effectiveDate'         =>  $effectiveDate,
            'formNumber'            =>  $formNumber,
            'formFiledOn'           =>  $formFiledOn,
            'amountPaid'            =>  $amountPaid,
            'extractRecvdOn'        =>  $extractRecvdOn,
            'registrationNumber'    =>  $registrationNumber,
            'registrationOn'        =>  $registrationOn,
            'registeredAddress'     =>  $registeredAddress,
            'adminOfficeAddress'    =>  $adminOfficeAddress,
            'factoryAddress'        =>  $factoryAddress,
            'remarks'               =>  $remarks,
            'status'                =>  1,
            'createdBy'             =>  $this->adminId,
            'createdDatetime'       =>  $this->currTimeStamp
        ];
	    
	    $this->MfirmDeed->save($firmDeedInsertArr);
	    
	    $firmDeedId = $this->MfirmDeed->insertID();
	    
	    $firmPartnerInsertArr=array();
	    
	    if(!empty($firmPartnerName))
	    {
	        foreach($firmPartnerName AS $k_prtnr => $e_prtnr)
	        {
	            $firmPartnerInsertArr=[
                    'fkFirmDeedId'   =>  $firmDeedId,
                    'firmPartnerName'       =>  $e_prtnr,
                    'isWorking'             =>  $isWorking[$k_prtnr],
                    'admissionDate'         =>  $admissionDate[$k_prtnr],
                    'retirementDate'        =>  $retirementDate[$k_prtnr],
                    'salaryPercentage'      =>  $salaryPercentage[$k_prtnr],
                    'interestPercentage'    =>  $interestPercentage[$k_prtnr],
                    'profitPercentage'      =>  $profitPercentage[$k_prtnr],
                    'lossPercentage'        =>  $lossPercentage[$k_prtnr],
                    'status'                =>  1,
                    'createdBy'             =>  $this->adminId,
                    'createdDatetime'       =>  $this->currTimeStamp
                ];
                
                $this->MfirmPartner->save($firmPartnerInsertArr);
	        }
	    }
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Partnership Deed not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Partnership Deed added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Partnership Deed has been added successfully :)");
        }
        
        return redirect()->to('partnership-firm-deeds/'.$fkClientId);
	}
	
	public function edit_deed($clientId, $firmDeedId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Partnership Deeds - Edit Deed";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['clientId']=$clientId;
        
        $clientCondtn['client_tbl.clientId']=$clientId;
        $clientCondtn['client_tbl.status']=1;
        $clientCondtn['client_tbl.isOldClient']=2;
        $clientCondtn['client_tbl.clientBussOrganisationType']=4;
        
        $clientDataArr = $this->Mclient->where($clientCondtn)->first();
        
        $this->data['clientDataArr']=$clientDataArr;
        
        $deedTypeCondtn['deed_type_tbl.status']=1;
        
        $deedTypeArr = $this->Mdeedtype->where($deedTypeCondtn)->findAll();
        
        $this->data['deedTypeArr']=$deedTypeArr;
        
        $formNoCondtn['form_number_tbl.status']=1;
        $formNoCondtn['form_number_tbl.type']=1;
        
        $formNoArr = $this->Mformnumber->where($formNoCondtn)->findAll();
        
        $this->data['formNoArr']=$formNoArr;
        
        $ptFirmDeedCondtn['firm_deed_tbl.status']=1;
        $ptFirmDeedCondtn['firm_deed_tbl.actType']=1;
        $ptFirmDeedCondtn['firm_deed_tbl.firmDeedId']=$firmDeedId;
        $ptFirmDeedCondtn['firm_deed_tbl.fkClientId']=$clientId;
        
        $ptFirmDeedArr = $this->MfirmDeed->where($ptFirmDeedCondtn)->first();
        
        $this->data['ptFirmDeedArr']=$ptFirmDeedArr;
        
        $firmPtCondtn['firm_partner_tbl.status']=1;
        $firmPtCondtn['firm_partner_tbl.fkFirmDeedId']=$firmDeedId;
        
        $firmPtArr = $this->MfirmPartner->where($firmPtCondtn)->findAll();
        
        $this->data['firmPtArr']=$firmPtArr;

        return view('firm_panel/compliance/partnership_firms/edit_deed', $this->data);
    }
    
    public function update_deed()
	{
	    $this->db->transBegin();
	    
	    $firmDeedId=$this->request->getPost('firmDeedId');
	    $fkClientId=$this->request->getPost('fkClientId');
	    $deedNumber=$this->request->getPost('deedNumber');
	    $deedType=$this->request->getPost('deedType');
	    $executionDate=$this->request->getPost('executionDate');
	    $effectiveDate=$this->request->getPost('effectiveDate');
	    $formNumber=$this->request->getPost('formNumber');
	    $formFiledOn=$this->request->getPost('formFiledOn');
	    $amountPaid=$this->request->getPost('amountPaid');
	    $extractRecvdOn=$this->request->getPost('extractRecvdOn');
	    $registrationNumber=$this->request->getPost('registrationNumber');
	    $registrationOn=$this->request->getPost('registrationOn');
	    $registeredAddress=$this->request->getPost('registeredAddress');
	    $adminOfficeAddress=$this->request->getPost('adminOfficeAddress');
	    $factoryAddress=$this->request->getPost('factoryAddress');
	    $remarks=$this->request->getPost('remarks');
	    
	    $firmPartnerId=$this->request->getPost('firmPartnerId');
	    $firmPartnerName=$this->request->getPost('firmPartnerName');
	    $isWorking=$this->request->getPost('isWorking');
	    $admissionDate=$this->request->getPost('admissionDate');
	    $retirementDate=$this->request->getPost('retirementDate');
	    $salaryPercentage=$this->request->getPost('salaryPercentage');
	    $interestPercentage=$this->request->getPost('interestPercentage');
	    $profitPercentage=$this->request->getPost('profitPercentage');
	    $lossPercentage=$this->request->getPost('lossPercentage');
	    
	    $firmDeedUpdateArr=[
            'firmDeedId'            =>  $firmDeedId,
            'fkClientId'            =>  $fkClientId,
            'deedNumber'            =>  $deedNumber,
            'deedType'              =>  $deedType,
            'executionDate'         =>  $executionDate,
            'effectiveDate'         =>  $effectiveDate,
            'formNumber'            =>  $formNumber,
            'formFiledOn'           =>  $formFiledOn,
            'amountPaid'            =>  $amountPaid,
            'extractRecvdOn'        =>  $extractRecvdOn,
            'registrationNumber'    =>  $registrationNumber,
            'registrationOn'        =>  $registrationOn,
            'registeredAddress'     =>  $registeredAddress,
            'adminOfficeAddress'    =>  $adminOfficeAddress,
            'factoryAddress'        =>  $factoryAddress,
            'remarks'               =>  $remarks,
            'status'                =>  1,
            'createdBy'             =>  $this->adminId,
            'createdDatetime'       =>  $this->currTimeStamp
        ];
	    
	    $this->MfirmDeed->save($firmDeedUpdateArr);
	    
	    $firmPtCondtn['firm_partner_tbl.status']=1;
        $firmPtCondtn['firm_partner_tbl.fkFirmDeedId']=$firmDeedId;
        
        $firmPtArr = $this->MfirmPartner->where($firmPtCondtn)->findAll();
        
        if(!empty($firmPtArr) && !empty($firmPartnerId))
        {
            $firmPartnerIdArr = array_column($firmPtArr, 'firmPartnerId');
            
            foreach($firmPartnerIdArr AS $e_firm_prtnr_id)
            {
                if(!in_array($e_firm_prtnr_id, $firmPartnerId))
                {
                    $firmPartnerUpdateArr=[
                        'firmPartnerId'     => $e_firm_prtnr_id,
                        'status'            => 2,
                        'updatedBy'         => $this->adminId,
                        'updatedDatetime'   => $this->currTimeStamp
                    ];
                    
                    $this->MfirmPartner->save($firmPartnerUpdateArr);
                }
            }
        }
	    
	    if(!empty($firmPartnerName))
	    {
	        foreach($firmPartnerName AS $k_prtnr => $e_prtnr)
	        {
	            $firmPartnerUpdateArr=[
                    'firmPartnerId'         =>  $firmPartnerId[$k_prtnr],
                    'fkFirmDeedId'          =>  $firmDeedId,
                    'firmPartnerName'       =>  $e_prtnr,
                    'isWorking'             =>  $isWorking[$k_prtnr],
                    'admissionDate'         =>  $admissionDate[$k_prtnr],
                    'retirementDate'        =>  $retirementDate[$k_prtnr],
                    'salaryPercentage'      =>  $salaryPercentage[$k_prtnr],
                    'interestPercentage'    =>  $interestPercentage[$k_prtnr],
                    'profitPercentage'      =>  $profitPercentage[$k_prtnr],
                    'lossPercentage'        =>  $lossPercentage[$k_prtnr],
                    'status'                =>  1,
                    'createdBy'             =>  $this->adminId,
                    'createdDatetime'       =>  $this->currTimeStamp
                ];
                
                $this->MfirmPartner->save($firmPartnerUpdateArr);
	        }
	    }
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Partnership Deed not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Partnership Deed updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Partnership Deed has been updated successfully :)");
        }
        
        return redirect()->to('/partnership-firm-deeds/'.$fkClientId);
	}
	
	public function view_deed($clientId, $firmDeedId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Partnership Deeds - View Deed";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['clientId']=$clientId;
        
        $clientCondtn['client_tbl.clientId']=$clientId;
        $clientCondtn['client_tbl.status']=1;
        $clientCondtn['client_tbl.isOldClient']=2;
        $clientCondtn['client_tbl.clientBussOrganisationType']=4;
        
        $clientDataArr = $this->Mclient->where($clientCondtn)->first();
        
        $this->data['clientDataArr']=$clientDataArr;
        
        $deedTypeCondtn['deed_type_tbl.status']=1;
        
        $deedTypeArr = $this->Mdeedtype->where($deedTypeCondtn)->findAll();
        
        $this->data['deedTypeArr']=$deedTypeArr;
        
        $formNoCondtn['form_number_tbl.status']=1;
        $formNoCondtn['form_number_tbl.type']=1;
        
        $formNoArr = $this->Mformnumber->where($formNoCondtn)->findAll();
        
        $this->data['formNoArr']=$formNoArr;
        
        $firmPtCondtn['firm_partner_tbl.status']=1;
        $firmPtCondtn['firm_partner_tbl.fkFirmDeedId']=$firmDeedId;
        
        $firmPtArr = $this->MfirmPartner->where($firmPtCondtn)->findAll();
        
        $this->data['firmPtArr']=$firmPtArr;
        
        $ptFirmDeedCondtn['firm_deed_tbl.status']=1;
        $ptFirmDeedCondtn['firm_deed_tbl.actType']=1;
        $ptFirmDeedCondtn['firm_deed_tbl.firmDeedId']=$firmDeedId;
        $ptFirmDeedCondtn['firm_deed_tbl.fkClientId']=$clientId;
        
        $ptFirmDeedJoinArr[]=array("tbl"=>$this->deed_type_tbl, "condtn"=>"deed_type_tbl.deedTypeId=firm_deed_tbl.deedType", "type"=>"left");
        $ptFirmDeedJoinArr[]=array("tbl"=>$this->form_number_tbl, "condtn"=>"form_number_tbl.formNumberId=firm_deed_tbl.formNumber", "type"=>"left");
        
        $columnNames="
            firm_deed_tbl.firmDeedId,
            firm_deed_tbl.deedType,
            firm_deed_tbl.executionDate,
            firm_deed_tbl.effectiveDate,
            firm_deed_tbl.formNumber,
            firm_deed_tbl.formFiledOn,
            firm_deed_tbl.amountPaid,
            firm_deed_tbl.registrationNumber,
            firm_deed_tbl.registrationOn,
            firm_deed_tbl.extractRecvdOn,
            firm_deed_tbl.registeredAddress,
            firm_deed_tbl.adminOfficeAddress,
            firm_deed_tbl.factoryAddress,
            firm_deed_tbl.remarks,
            deed_type_tbl.deedTypeName,
            form_number_tbl.formNumber
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->firm_deed_tbl, $colNames=$columnNames, $ptFirmDeedCondtn, $likeCondtnArr=array(), $ptFirmDeedJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $ptFirmDeedArr=$query['userData'];
        
        $this->data['ptFirmDeedArr']=$ptFirmDeedArr;

        return view('firm_panel/compliance/partnership_firms/view_deed', $this->data);
    }
	
	public function delete_deed()
	{
	    $firmDeedId=$this->request->getPost('firmDeedId');
	    
	    $insertArr=[
            'firmDeedId'        => $firmDeedId,
            'status'            => 2,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    if($this->MfirmDeed->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Partnership Deed has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Partnership Deed has not deleted :(");
	    }
	}
}
?>