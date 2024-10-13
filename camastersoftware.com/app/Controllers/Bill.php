<?php
namespace App\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\HTTP\ResponseInterface;

class Bill extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Bill";
        
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->Mcashbook = new \App\Models\Mcashbook();
        $this->Mbill = new \App\Models\Mbill();
        $this->MbillDescription = new \App\Models\MbillDescription();
        $this->Mconfig = new \App\Models\Mconfig();
        $this->Mfirm = new \App\Models\Mfirm();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->session = \Config\Services::session();

        $tableArr=$this->TableLib->get_tables();

        $this->bill_tbl=$tableArr['bill_tbl'];
        $this->config_tbl=$tableArr['config_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];

        $this->sessCaFirmId=$this->session->get('caFirmId');

        $documentsPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/documents');

        $this->data['documentsPath']=$documentsPath;
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }

	public function index()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Create Bills - Type B";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $billArr = $this->Mbill->where('status', 1)->findAll();
        
        $this->data['billArr']=$billArr;

        return view('firm_panel/accounts/bill/list', $this->data);
	}

	public function modify_tax_notes()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Modify Tax Rates & Notes";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        return view('firm_panel/accounts/bill/modify_tax_notes', $this->data);
	}
	
	public function update_tax_notes()
	{
	    $this->db->transBegin();
	    
	    $billServiceAccCode = $this->request->getPost('billServiceAccCode');
	    $cgst = $this->request->getPost('cgst');
	    $sgst = $this->request->getPost('sgst');
	    $igst = $this->request->getPost('igst');
	    $billNote = $this->request->getPost('billNote');
        $billNoteVal = (!empty($billNote)) ? htmlspecialchars(htmlentities($billNote)) : "";
	    $configId = $this->request->getPost('configId');
        
        $configInsertArr=[
            'configId'              => $configId,
            'cgst'                  => $cgst,
            'sgst'                  => $sgst,
            'igst'                  => $igst,
            'billServiceAccCode'    => $billServiceAccCode,
            'billNote'              => $billNoteVal,
            'updatedBy'             => $this->adminId,
            'updatedDatetime'       => $this->currTimeStamp
        ];
        
        $this->Mconfig->save($configInsertArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Bill Tax Rates & Notes has not modify :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Bill Tax Rates & Notes modified";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Bill Tax Rates & Notes has been modified successfully :)");
	    }
	    
	    return redirect()->route('bills');
	}
	
	public function create()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'wysihtml5', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Create Bill";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_tbl.clientName !=']="";
        
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientName, client_tbl.clientBussOrganisationType AS orgType", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientList=$query['userData'];
        
        $this->data['clientList']=$clientList;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        return view('firm_panel/accounts/bill/create', $this->data);
	}
	
	public function generate()
	{
	    $this->db->transBegin();
	    
	    $fkClientId=$this->request->getPost('fkClientId');
	    $billNo=$this->request->getPost('billNo');
	    $billDate=$this->request->getPost('billDate');
	    $billServiceAccCode = $this->request->getPost('billServiceAccCode');
	    $descriptionArr = $this->request->getPost('description');
	    $amountArr = $this->request->getPost('amount');
	    $isLumpsum = $this->request->getPost('isLumpsum');
	    $lumpsumAmt = $this->request->getPost('lumpsumAmt');
	    $totalAmt = $this->request->getPost('totalAmt');
	    $taxType = $this->request->getPost('taxType');
	    $cgst = $this->request->getPost('cgst');
	    $cgstAmt = $this->request->getPost('cgstAmt');
	    $sgst = $this->request->getPost('sgst');
	    $sgstAmt = $this->request->getPost('sgstAmt');
	    $igst = $this->request->getPost('igst');
	    $igstAmt = $this->request->getPost('igstAmt');
	    $totalBillAmt = $this->request->getPost('totalBillAmt');
	    $billNote = $this->request->getPost('billNote');
        $billNoteVal = (!empty($billNote)) ? htmlspecialchars(htmlentities($billNote)) : "";
	    $configId = $this->request->getPost('configId');
	    
	    $billInsertArr=[
            'fkClientId'        =>  $fkClientId,
            'billNo'            =>  $billNo,
            'billDate'          =>  $billDate,
            'billServiceAccCode'=>  $billServiceAccCode,
            'isLumpsum'         =>  $isLumpsum,
            'lumpsumAmt'        =>  $lumpsumAmt,
            'totalAmt'          =>  $totalAmt,
            'taxType'           =>  $taxType,
            'cgst'              =>  $cgst,
            'sgst'              =>  $sgst,
            'igst'              =>  $igst,
            'cgstAmt'           =>  $cgstAmt,
            'sgstAmt'           =>  $sgstAmt,
            'igstAmt'           =>  $igstAmt,
            'totalBillAmt'      =>  $totalBillAmt,
            'billNote'          =>  $billNote,
            'status'            =>  1,
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        ];
        
        $this->Mbill->save($billInsertArr);
        
        $billId=$this->Mbill->insertID();
        
        if(!empty($descriptionArr))
        {
            foreach($descriptionArr AS $k_row => $e_row)
            {
                $description = $e_row;
                $amount = $amountArr[$k_row];
                
                $billDescInsertArr=[
                    'fkBillId'          =>  $billId,
                    'description'       =>  $description,
                    'amount'            =>  $amount,
                    'status'            =>  1,
                    'createdBy'         =>  $this->adminId,
                    'createdDatetime'   =>  $this->currTimeStamp
                ];
                
                $this->MbillDescription->save($billDescInsertArr);
            }
        }
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Bill has not created :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Created";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "New Bill has been created successfully :)");
	    }
	    
	    return redirect()->route('bills');
	}
	
	public function edit($billId)
	{
	    $this->data['billId']=$billId;
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'wysihtml5');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Edit Bill";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $billCondtn = array(
            'billId' => $billId,    
            'status' => 1    
        );
        
        $billDataArr = $this->Mbill->where($billCondtn)->get()->getRowArray();
        
        $this->data['billDataArr']=$billDataArr;
        
        $billDescCondtn = array(
            'fkBillId' => $billId,    
            'status' => 1    
        );
        
        $billDescArr = $this->MbillDescription->where($billDescCondtn)->findAll();
        
        $this->data['billDescArr']=$billDescArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_tbl.clientName !=']="";
        
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientName, client_tbl.clientBussOrganisationType AS orgType", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientList=$query['userData'];
        
        $this->data['clientList']=$clientList;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        return view('firm_panel/accounts/bill/edit', $this->data);
	}
	
	public function update()
	{
	    $this->db->transBegin();
	    
	    $billId=$this->request->getPost('billId');
	    $fkClientId=$this->request->getPost('fkClientId');
	    $billNo=$this->request->getPost('billNo');
	    $billDate=$this->request->getPost('billDate');
	    $billServiceAccCode = $this->request->getPost('billServiceAccCode');
	    $billDescptionIdArr = $this->request->getPost('billDescptionId');
	    $descriptionArr = $this->request->getPost('description');
	    $amountArr = $this->request->getPost('amount');
	    $isLumpsum = $this->request->getPost('isLumpsum');
	    $lumpsumAmt = $this->request->getPost('lumpsumAmt');
	    $totalAmt = $this->request->getPost('totalAmt');
	    $taxType = $this->request->getPost('taxType');
	    $cgst = $this->request->getPost('cgst');
	    $cgstAmt = $this->request->getPost('cgstAmt');
	    $sgst = $this->request->getPost('sgst');
	    $sgstAmt = $this->request->getPost('sgstAmt');
	    $igst = $this->request->getPost('igst');
	    $igstAmt = $this->request->getPost('igstAmt');
	    $totalBillAmt = $this->request->getPost('totalBillAmt');
	    $billNote = $this->request->getPost('billNote');
        $billNoteVal = (!empty($billNote)) ? htmlspecialchars(htmlentities($billNote)) : "";
	    $configId = $this->request->getPost('configId');
	    
	    $billUpdateArr=[
            'billId'            =>  $billId,
            'fkClientId'        =>  $fkClientId,
            'billNo'            =>  $billNo,
            'billDate'          =>  $billDate,
            'billServiceAccCode'=>  $billServiceAccCode,
            'isLumpsum'         =>  $isLumpsum,
            'lumpsumAmt'        =>  $lumpsumAmt,
            'totalAmt'          =>  $totalAmt,
            'taxType'           =>  $taxType,
            'cgst'              =>  $cgst,
            'sgst'              =>  $sgst,
            'igst'              =>  $igst,
            'cgstAmt'           =>  $cgstAmt,
            'sgstAmt'           =>  $sgstAmt,
            'igstAmt'           =>  $igstAmt,
            'totalBillAmt'      =>  $totalBillAmt,
            'billNote'          =>  $billNote,
            'updatedBy'         =>  $this->adminId,
            'updatedDatetime'   =>  $this->currTimeStamp
        ];
        
        $this->Mbill->save($billUpdateArr);
        
        if(!empty($descriptionArr))
        {
            foreach($descriptionArr AS $k_row => $e_row)
            {
                $description = $e_row;
                $billDescptionId = $billDescptionIdArr[$k_row];
                $amount = $amountArr[$k_row];
                
                $billDescInsertArr=[
                    'billDescptionId'   =>  $billDescptionId,
                    'fkBillId'          =>  $billId,
                    'description'       =>  $description,
                    'amount'            =>  $amount,
                    'status'            =>  1,
                    'createdBy'         =>  $this->adminId,
                    'createdDatetime'   =>  $this->currTimeStamp
                ];
                
                $this->MbillDescription->save($billDescInsertArr);
            }
        }
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Bill has not updated :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "New Bill has been updated successfully :)");
	    }
	    
	    return redirect()->route('bills');
	}
	
	public function view($billId)
	{
	    setlocale(LC_MONETARY, 'en_IN');
	    ini_set('memory_limit', '-1');
	    
	    /*
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Create New Bill";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        */
        
        $viewPage=$this->request->getGet('viewPage');
        
        $firmDetails=$this->Mfirm->select('ca_firm_tbl.*, profession_type_tbl.profession_type_name, states.stateName, cities.cityName')
            ->join('states', 'states.stateId=ca_firm_tbl.caFirmStateId AND states.status=1', 'left')
            ->join('cities', 'cities.cityId=ca_firm_tbl.caFirmCityId AND cities.status=1', 'left')
            ->join('profession_type_tbl', 'profession_type_tbl.profession_type_id=ca_firm_tbl.caFirmProfession AND profession_type_tbl.status=1', 'left')
            ->where('ca_firm_tbl.status', 1)
            ->where('ca_firm_tbl.caFirmStatus', 1)
            ->where('ca_firm_tbl.isVerified', 1)
            ->where('ca_firm_tbl.isTermsAgree', 1)
            ->where('ca_firm_tbl.caFirmCompanyKey !=', "")
            ->where('ca_firm_tbl.caFirmId', $this->sessCaFirmId)
            ->get()
            ->getRowArray();

        $this->data['firmDetails']=$firmDetails;
        
        $billCondtn = array(
            'billId' => $billId,    
            'status' => 1    
        );
        
        $billDataArr = $this->Mbill->where($billCondtn)->get()->getRowArray();
        
        $this->data['billDataArr']=$billDataArr;
        
        $clientId=$billDataArr['fkClientId'];
        
        $billDescCondtn = array(
            'fkBillId' => $billId,    
            'status' => 1    
        );
        
        $billDescArr = $this->MbillDescription->where($billDescCondtn)->findAll();
        
        $this->data['billDescArr']=$billDescArr;
        
        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_tbl.clientName !=']="";
        
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientName, client_tbl.clientBussEmail1, client_tbl.clientBussOfficeAddress, client_tbl.clientResidentialAddress, client_tbl.clientBussOfficePhone1, client_tbl.clientBussResidencePhone", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $this->data['clientData']=$clientData;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;
        
        // Create an instance of Dompdf with options
        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        
        // Load your HTML content
        $html = view('firm_panel/accounts/bill/bill_template', $this->data);
        
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        
        $contxt = stream_context_create([ 
            'ssl' => [ 
                'verify_peer' => FALSE, 
                'verify_peer_name' => FALSE,
                'allow_self_signed'=> TRUE
            ] 
        ]);
        
        $dompdf->setHttpContext($contxt);
        
        if($viewPage==1)
            return $html;
        
        // Load the HTML into Dompdf
        $dompdf->loadHtml($html);
        
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the PDF
        $dompdf->render();
        
        // Get the generated PDF content
        $output = $dompdf->output();
        
        // Create a response with PDF content
        $response = $this->response
            ->setStatusCode(200)
            ->setContentType('application/pdf')
            ->setBody($output);
        
        return $response;
	}
	
	public function delete()
	{
	    $billId=$this->request->getPost('billId');
	    
	    $insertArr=[
            'billId'        => $billId,
            'status'            => 2,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    if($this->Mbill->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Bill has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Bill has not deleted :(");
	    }
	}
}