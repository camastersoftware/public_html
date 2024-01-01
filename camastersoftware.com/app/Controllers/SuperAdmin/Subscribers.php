<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;
use App\Libraries\ConnectDb;

class Subscribers extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mdata_bank = new \App\Models\Mdata_bank();
        $this->Mdemo = new \App\Models\Mdemo();
        $this->Mfirm = new \App\Models\Mfirm();
        $this->MprofessionTypes = new \App\Models\MprofessionTypes();
        $this->MpaymentOption = new \App\Models\MpaymentOption();
        $this->Mstate = new \App\Models\Mstate();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->ConnectDb = new ConnectDb();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->data_bank_tbl=$tableArr['data_bank_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->staff_types=$tableArr['staff_types'];
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Licensee";
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Licensee";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $firmList=$this->Mfirm->select('ca_firm_tbl.*, states.stateName AS caFirmState, profession_type_tbl.profession_type_name')
            ->join('states', 'states.stateId=ca_firm_tbl.caFirmStateId AND states.status=1', 'left')
            ->join('profession_type_tbl', 'profession_type_tbl.profession_type_id=ca_firm_tbl.caFirmProfession AND profession_type_tbl.status=1', 'left')
            ->where('ca_firm_tbl.status', 1)
            ->where('ca_firm_tbl.caFirmStatus', 1)
            ->where('ca_firm_tbl.isVerified', 1)
            ->where('ca_firm_tbl.isTermsAgree', 1)
            ->where('ca_firm_tbl.caFirmCompanyKey !=', "")
            ->findAll();

        $this->data['firmList']=$firmList;

        return view('super_admin/subscribers/home', $this->data);
	}
	
	public function editSubscriber($caFirmId)
	{
        $profTypes = $this->MprofessionTypes->where('status', 1)
                    ->findAll();

        $this->data['profTypes']=$profTypes;

        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        $pmtOptions = $this->MpaymentOption->where('status', 1)
                    ->findAll();

        $this->data['pmtOptions']=$pmtOptions;

        $firmData=$this->Mfirm->where('status', 1)
                    ->where('caFirmId', $caFirmId)
                    ->get()
                    ->getRowArray();

        $this->data['firmData']=$firmData;

	    $validationRulesArr['caFirmName']=['label' => 'Firm Name', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmProfession']=['label' => 'Type of Profession', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmType']=['label' => 'Firm Type', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmPan']=['label' => 'Firm Pan No', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmGSTIN']=['label' => 'Firm GSTIN', 'rules' => 'trim'];
        $validationRulesArr['caFirmRegNo']=['label' => 'Firm Registration Number', 'rules' => 'trim'];
        $validationRulesArr['caFirmRegDate']=['label' => 'Date of Registration', 'rules' => 'trim'];
        $validationRulesArr['caFirmContactPerson']=['label' => 'Contact Person', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmEmail']=['label' => 'Email Address', 'rules' => 'valid_email|required|trim'];
        $validationRulesArr['caFirmMobile']=['label' => 'Mobile No', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmAddress']=['label' => 'Address', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmStateId']=['label' => 'State', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmCityId']=['label' => 'City', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmLandline']=['label' => 'Landline No', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmUsers']=['label' => 'Number of Users', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmPayment']=['label' => 'Payment Option', 'rules'=> 'required|trim'];

        $caFirmNameErr="";
        $caFirmProfessionErr="";
        $caFirmTypeErr="";
        $caFirmPanErr="";
        $caFirmGSTINErr="";
        $caFirmRegNoErr="";
        $caFirmRegDateErr="";
        $caFirmContactPersonErr="";
        $caFirmEmailErr="";
        $caFirmMobileErr="";
        $caFirmAddressErr="";
        $caFirmStateIdErr="";
        $caFirmCityIdErr="";
        $caFirmLandlineErr="";
        $caFirmUsersErr="";
        $caFirmPaymentErr="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $caFirmNameErr=$this->validation->getError('caFirmName');
                $caFirmProfessionErr=$this->validation->getError('caFirmProfession');
                $caFirmTypeErr=$this->validation->getError('caFirmType');
                $caFirmPanErr=$this->validation->getError('caFirmPan');
                $caFirmGSTINErr=$this->validation->getError('caFirmGSTIN');
                $caFirmRegNoErr=$this->validation->getError('caFirmRegNo');
                $caFirmRegDateErr=$this->validation->getError('caFirmRegDate');
                $caFirmContactPersonErr=$this->validation->getError('caFirmContactPerson');
                $caFirmEmailErr=$this->validation->getError('caFirmEmail');
                $caFirmMobileErr=$this->validation->getError('caFirmMobile');
                $caFirmAddressErr=$this->validation->getError('caFirmAddress');
                $caFirmStateIdErr=$this->validation->getError('caFirmStateId');
                $caFirmCityIdErr=$this->validation->getError('caFirmCityId');
                $caFirmLandlineErr=$this->validation->getError('caFirmLandline');
                $caFirmUsersErr=$this->validation->getError('caFirmUsers');
                $caFirmPaymentErr=$this->validation->getError('caFirmPayment');
            }
            else
            {
                $this->db->transBegin();

                $caFirmId=$this->request->getPost('caFirmId');
                $caFirmName=$this->request->getPost('caFirmName');
                $caFirmProfession=$this->request->getPost('caFirmProfession');
                $caFirmType=$this->request->getPost('caFirmType');
                $caFirmPan=$this->request->getPost('caFirmPan');
                $caFirmGSTIN=$this->request->getPost('caFirmGSTIN');
                $caFirmRegNo=$this->request->getPost('caFirmRegNo');
                $caFirmRegDate=$this->request->getPost('caFirmRegDate');
                $caFirmContactPerson=$this->request->getPost('caFirmContactPerson');
                $caFirmEmail=$this->request->getPost('caFirmEmail');
                $caFirmMobile=$this->request->getPost('caFirmMobile');
                $caFirmAddress=$this->request->getPost('caFirmAddress');
                $caFirmStateId=$this->request->getPost('caFirmStateId');
                $caFirmCityId=$this->request->getPost('caFirmCityId');
                $caFirmLandline=$this->request->getPost('caFirmLandline');
                $caFirmUsers=$this->request->getPost('caFirmUsers');
                $caFirmPayment=$this->request->getPost('caFirmPayment');

                $firmUpdateArr = [
                    'caFirmId'=>$caFirmId,
                    'caFirmName'=>$caFirmName,
                    'caFirmProfession'=>$caFirmProfession,
                    'caFirmType'=>$caFirmType,
                    'caFirmPan'=>$caFirmPan,
                    'caFirmGSTIN'=>$caFirmGSTIN,
                    'caFirmRegNo'=>$caFirmRegNo,
                    'caFirmRegDate'=>$caFirmRegDate,
                    'caFirmContactPerson'=>$caFirmContactPerson,
                    'caFirmEmail'=>$caFirmEmail,
                    'caFirmMobile'=>$caFirmMobile,
                    'caFirmAddress'=>$caFirmAddress,
                    'caFirmStateId'=>$caFirmStateId,
                    'caFirmCityId'=>$caFirmCityId,
                    'caFirmLandline'=>$caFirmLandline,
                    'caFirmUsers'=>$caFirmUsers,
                    'caFirmPayment'=>$caFirmPayment,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];

                $this->Mfirm->save($firmUpdateArr);

                if($this->db->transStatus() === FALSE)
                {
                    $this->db->transRollback();

                    $this->session->setFlashdata('errorMsg', "Something went wrong!! :(");
                }
                else
                {
                    $this->db->transCommit();

                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']="CA Firm Updated";
                    $insertLogArr['ip']=$this->IPAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mcommon->insertLog($insertLogArr);

                    $this->session->setFlashdata('successMsg', $this->section." details has been updated successfully :)");
                }

                return redirect()->route('superadmin/subscribers');
            }
        }

	    $this->data['caFirmNameErr']=$caFirmNameErr;
        $this->data['caFirmProfessionErr']=$caFirmProfessionErr;
        $this->data['caFirmTypeErr']=$caFirmTypeErr;
        $this->data['caFirmPanErr']=$caFirmPanErr;
        $this->data['caFirmGSTINErr']=$caFirmGSTINErr;
        $this->data['caFirmRegNoErr']=$caFirmRegNoErr;
        $this->data['caFirmRegDateErr']=$caFirmRegDateErr;
        $this->data['caFirmContactPersonErr']=$caFirmContactPersonErr;
        $this->data['caFirmEmailErr']=$caFirmEmailErr;
        $this->data['caFirmMobileErr']=$caFirmMobileErr;
        $this->data['caFirmAddressErr']=$caFirmAddressErr;
        $this->data['caFirmStateIdErr']=$caFirmStateIdErr;
        $this->data['caFirmCityIdErr']=$caFirmCityIdErr;
        $this->data['caFirmLandlineErr']=$caFirmLandlineErr;
        $this->data['caFirmUsersErr']=$caFirmUsersErr;
        $this->data['caFirmPaymentErr']=$caFirmPaymentErr;

        return view('super_admin/subscribers/edit', $this->data);
	}
	
	public function viewSubscriber($caFirmId)
	{
	    $this->session->set('caFirmId', $caFirmId);
	    
	    $caFirmSet=$this->request->getGet('set');
	    $qryFrom=$this->request->getGet('qryFrom');
	    
	    if($qryFrom==1)
	        $backUrl="error_report/index?errType=1";
	    else
	        $backUrl="subscribers";
	    
	    $this->data['backUrl']=$backUrl;
	    $this->data['qryFrom']=$qryFrom;
	    
	    if($caFirmSet!=1)
	    {
	        if($qryFrom==1)
	            return redirect()->to(base_url('superadmin/viewSubscriber/'.$caFirmId.'?set=1&qryFrom=1'));
            else
	            return redirect()->to(base_url('superadmin/viewSubscriber/'.$caFirmId.'?set=1'));
	    }
	    
        $profTypes = $this->MprofessionTypes->where('status', 1)
                    ->findAll();

        $this->data['profTypes']=$profTypes;

        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        $pmtOptions = $this->MpaymentOption->where('status', 1)
                    ->findAll();

        $this->data['pmtOptions']=$pmtOptions;

        $firmData=$this->Mfirm->where('status', 1)
                    ->where('caFirmId', $caFirmId)
                    ->get()
                    ->getRowArray();

        $this->data['firmData']=$firmData;
        
        if($this->ConnectDb->admin($caFirmId)){
            
            $this->Mquery = new \App\Models\Mquery();
            
            $userCondtnArr['user_tbl.status']="1";
            $userOrderByArr['user_tbl.userSeq']="ASC";
            
            $userJoinArr[]=array("tbl"=>$this->staff_types, "condtn"=>"staff_types.staff_type_id=user_tbl.userStaffType", "type"=>"left");
            
            $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userLoginName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, staff_types.staff_type_name", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr, $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
            
            $getUserList=$query['userData'];
            
        }else{
            $getUserList=array();
        }
        
        $this->data['getUserList']=$getUserList;

        return view('super_admin/subscribers/view', $this->data);
	}
	
	public function deleteData()
	{
	    $caFirmId=$this->request->getPost('caFirmId');
	    
	    $insertArr=[
            'caFirmId'=>$caFirmId,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mfirm->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', $this->section." has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', $this->section." has not deleted :(");
	    }
	}
	
	public function discontinueFirm()
	{
	    $caFirmId=$this->request->getPost('caFirmId');
	    
	    $insertArr=[
            'caFirmId'=>$caFirmId,
            'isDiscontinue'=>1,
            'discontinuationDate'=>date('Y-m-d'),
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mfirm->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Discontinued";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', $this->section." has been discontinued successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', $this->section." has not discontinued :(");
	    }
	}
}
?>