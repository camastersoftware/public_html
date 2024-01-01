<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class Firm extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Firm";
        
        $this->Mfirm = new \App\Models\Mfirm();
        $this->MprofessionTypes = new \App\Models\MprofessionTypes();
        $this->MpaymentOption = new \App\Models\MpaymentOption();
        $this->Mstate = new \App\Models\Mstate();
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Firm List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $firmList=$this->Mfirm->select('ca_firm_tbl.*, states.stateName AS caFirmState')
            ->join('states', 'states.stateId=ca_firm_tbl.caFirmStateId AND states.status=1', 'left')
            ->where('ca_firm_tbl.status', 1)
            ->findAll();

        $this->data['firmList']=$firmList;
        
        $firmLicHolders=$this->Mfirm->select('ca_firm_tbl.*, states.stateName AS caFirmState, profession_type_tbl.profession_type_name')
            ->join('states', 'states.stateId=ca_firm_tbl.caFirmStateId AND states.status=1', 'left')
            ->join('profession_type_tbl', 'profession_type_tbl.profession_type_id=ca_firm_tbl.caFirmProfession AND profession_type_tbl.status=1', 'left')
            ->where('ca_firm_tbl.status', 1)
            ->where('ca_firm_tbl.caFirmStatus', 1)
            ->where('ca_firm_tbl.isVerified', 1)
            ->where('ca_firm_tbl.isTermsAgree', 1)
            ->where('ca_firm_tbl.caFirmCompanyKey !=', "")
            ->findAll();

        $this->data['firmLicHolders']=$firmLicHolders;

        return view('super_admin/firm/firmList', $this->data);
	}
	
	public function add_firm()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $pageTitle="Firm Registration Form";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $profTypes = $this->MprofessionTypes->where('status', 1)
                    ->findAll();

        $this->data['profTypes']=$profTypes;

        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        $pmtOptions = $this->MpaymentOption->where('status', 1)
                    ->findAll();

        $this->data['pmtOptions']=$pmtOptions;

        $validationRulesArr['caFirmName']=['label' => 'Firm Name', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmProfession']=['label' => 'Type of Profession', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmType']=['label' => 'Firm Type', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmPan']=['label' => 'Firm Pan No', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmGSTIN']=['label' => 'Firm GSTIN', 'rules' => 'trim'];
        $validationRulesArr['caFirmRegNo']=['label' => 'Firm Registration Number', 'rules' => 'trim'];
        $validationRulesArr['caFirmRegDate']=['label' => 'Date of Registration', 'rules' => 'trim'];
        $validationRulesArr['caFirmContactPerson']=['label' => 'Contact Person', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmEmail']=['label' => 'Email', 'rules' => 'valid_email|required|trim'];
        $validationRulesArr['caFirmMobile']=['label' => 'Mobile', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmAddress']=['label' => 'Address', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmStateId']=['label' => 'State', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmCityId']=['label' => 'City', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmLandline']=['label' => 'Landline No', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmUsers']=['label' => 'Number of Users', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmPayment']=['label' => 'Payment Option', 'rules'=> 'required|trim'];
        $validationRulesArr['customerUserName']=['label' => 'User Name', 'rules'=> 'required|trim'];
        $validationRulesArr['customerPassword']=['label' => 'Password', 'rules'=> 'required|trim'];
        $validationRulesArr['customerConfPassword']=['label' => 'Confirm Password', 'rules'=> 'matches[customerPassword]|required|trim'];
        $validationRulesArr['customerVerify']=['label' => 'Verification Code', 'rules'=> 'required|trim'];
        $validationRulesArr['captchaCode']=['label' => 'Captcha', 'rules'=> 'trim'];
        $validationRulesArr['isTermsAgree']=['label' => 'Terms & Conditions', 'rules'=> 'required|trim'];

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
        $customerUserNameErr="";
        $customerPasswordErr="";
        $customerConfPasswordErr="";
        $customerVerifyErr="";
        $captchaCodeErr="";
        $isTermsAgreeErr="";

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
                $customerUserNameErr=$this->validation->getError('customerUserName');
                $customerPasswordErr=$this->validation->getError('customerPassword');
                $customerConfPasswordErr=$this->validation->getError('customerConfPassword');
                $customerVerifyErr=$this->validation->getError('customerVerify');
                $captchaCodeErr=$this->validation->getError('captchaCode');
                $isTermsAgreeErr=$this->validation->getError('isTermsAgree');
            }
            else
            {
                $this->db->transBegin();

                $caFirmName=$this->request->getPost('caFirmName');
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
                $customerUserName=$this->request->getPost('customerUserName');
                $customerPassword=$this->request->getPost('customerPassword');
                $isTermsAgree=$this->request->getPost('isTermsAgree');
                
                // $caFirmCompanyKey=rand(99999, 1000000);
                $caFirmCompanyKey=rand(1000, 9999);
                $randomUpperCaseAlpha=getRandomUpperCaseAlpha(2);
                $caFirmCompanyKey=$randomUpperCaseAlpha.$caFirmCompanyKey;
                
                $generatingCompanyKey=$this->getCompanyKey($caFirmCompanyKey);

                $firmInsertArr = [
                    'caFirmName'=>$caFirmName,
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
                    'customerUserName'=>$customerUserName,
                    'customerPassword'=>$customerPassword,
                    'caFirmCompanyKey'=>$generatingCompanyKey,
                    'isTermsAgree'=>$isTermsAgree,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];

                $this->Mfirm->save($firmInsertArr);

                if($this->db->transStatus() === FALSE)
                {
                    $this->db->transRollback();

                    $this->session->setFlashdata('errorMsg', "Something went wrong!! :(");
                }
                else
                {
                    $this->db->transCommit();

                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']="New CA Firm Registered";
                    $insertLogArr['ip']=$this->IPAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mcommon->insertLog($insertLogArr);

                    $this->session->setFlashdata('successMsg', "New CA Firm has been registered successfully :)");
                }

                return redirect()->route('superadmin/firmList');
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
        $this->data['customerUserNameErr']=$customerUserNameErr;
        $this->data['customerPasswordErr']=$customerPasswordErr;
        $this->data['customerConfPasswordErr']=$customerConfPasswordErr;
        $this->data['customerVerifyErr']=$customerVerifyErr;
        $this->data['captchaCodeErr']=$captchaCodeErr;
        $this->data['isTermsAgreeErr']=$isTermsAgreeErr;

        return view('super_admin/firm/addFirm', $this->data);
	}
	
	public function register_firm()
	{
        $validationRulesArr['caFirmName']=['label' => 'Firm Name', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmProfession']=['label' => 'Type of Profession', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmType']=['label' => 'Firm Type', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmPan']=['label' => 'Firm Pan No', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmGSTIN']=['label' => 'Firm GSTIN', 'rules' => 'trim'];
        $validationRulesArr['caFirmRegNo']=['label' => 'Firm Registration Number', 'rules' => 'trim'];
        $validationRulesArr['caFirmRegDate']=['label' => 'Firm Date of Registration', 'rules' => 'trim'];
        $validationRulesArr['caFirmContactPerson']=['label' => 'Contact Person', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmEmail']=['label' => 'Email', 'rules' => 'valid_email|required|trim'];
        $validationRulesArr['caFirmMobile']=['label' => 'Mobile', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmAddress']=['label' => 'Address', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmStateId']=['label' => 'State', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmCityId']=['label' => 'City', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmLandline']=['label' => 'Landline No', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmUsers']=['label' => 'Number of Users', 'rules'=> 'required|trim'];
        // $validationRulesArr['caFirmPayment']=['label' => 'Payment Option', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmPayment']=['label' => 'Payment Option', 'rules'=> 'trim'];
        $validationRulesArr['customerUserName']=['label' => 'User Name', 'rules'=> 'required|trim'];
        $validationRulesArr['customerPassword']=['label' => 'Password', 'rules'=> 'required|trim'];
        $validationRulesArr['customerConfPassword']=['label' => 'Confirm Password', 'rules'=> 'matches[customerPassword]|required|trim'];
        $validationRulesArr['customerVerify']=['label' => 'Verification Code', 'rules'=> 'trim'];
        $validationRulesArr['captchaCode']=['label' => 'Captcha', 'rules'=> 'required|trim'];
        $validationRulesArr['isTermsAgree']=['label' => 'Terms & Conditions', 'rules'=> 'required|trim'];
        
        // $sessCaptacha=$_SESSION['captcha'];
        // $captchaCode=$this->request->getPost('captchaCode');
        
        // if($captchaCode!=$sessCaptacha)
        // {
        //     $errArr['captchaCode']="Captcha does not match";
            
        //     $responseArr['status']=false;
        //     $responseArr['userdata']=$errArr." - ".$sessCaptacha." - ".$captchaCode;
        //     $responseArr['message']='Validation Error, Form not submitted';
        // }
        // else
        // {
        //     $errArr['captchaCode']="Captcha match";
            
        //     $responseArr['status']=false;
        //     $responseArr['userdata']=$errArr." - ".$sessCaptacha." - ".$captchaCode;
        //     $responseArr['message']='Validation Error, Form not submitted';
        // }
        // echo json_encode($responseArr);

        if(!$this->validate($validationRulesArr))
        {
            $errArr['caFirmName']=$this->validation->getError('caFirmName');
            $errArr['caFirmProfession']=$this->validation->getError('caFirmProfession');
            $errArr['caFirmType']=$this->validation->getError('caFirmType');
            $errArr['caFirmPan']=$this->validation->getError('caFirmPan');
            $errArr['caFirmGSTIN']=$this->validation->getError('caFirmGSTIN');
            $errArr['caFirmRegNo']=$this->validation->getError('caFirmRegNo');
            $errArr['caFirmRegDate']=$this->validation->getError('caFirmRegDate');
            $errArr['caFirmContactPerson']=$this->validation->getError('caFirmContactPerson');
            $errArr['caFirmEmail']=$this->validation->getError('caFirmEmail');
            $errArr['caFirmMobile']=$this->validation->getError('caFirmMobile');
            $errArr['caFirmAddress']=$this->validation->getError('caFirmAddress');
            $errArr['caFirmStateId']=$this->validation->getError('caFirmStateId');
            $errArr['caFirmCityId']=$this->validation->getError('caFirmCityId');
            $errArr['caFirmLandline']=$this->validation->getError('caFirmLandline');
            $errArr['caFirmUsers']=$this->validation->getError('caFirmUsers');
            $errArr['caFirmPayment']=$this->validation->getError('caFirmPayment');
            $errArr['customerUserName']=$this->validation->getError('customerUserName');
            $errArr['customerPassword']=$this->validation->getError('customerPassword');
            $errArr['customerConfPassword']=$this->validation->getError('customerConfPassword');
            $errArr['customerVerify']=$this->validation->getError('customerVerify');
            $errArr['captchaCode']=$this->validation->getError('captchaCode');
            $errArr['isTermsAgree']=$this->validation->getError('isTermsAgree');
            
            $responseArr['status']=false;
            $responseArr['userdata']=$errArr;
            $responseArr['message']='Validation Error, Form not submitted';
        }
        else
        {
            $this->db->transBegin();

            $caFirmName=$this->request->getPost('caFirmName');
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
            $customerUserName=$this->request->getPost('customerUserName');
            $customerPassword=$this->request->getPost('customerPassword');
            $captchaCode=$this->request->getPost('captchaCode');
            $isTermsAgree=$this->request->getPost('isTermsAgree');
            
            $caFirmCompanyKey=rand(1000, 9999);
            $randomUpperCaseAlpha=getRandomUpperCaseAlpha(2);
            $caFirmCompanyKey=$randomUpperCaseAlpha.$caFirmCompanyKey;
            
            $generatingCompanyKey=$this->getCompanyKey($caFirmCompanyKey);

            $firmInsertArr = [
                'caFirmName'=>$caFirmName,
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
                'customerUserName'=>$customerUserName,
                'customerPassword'=>$customerPassword,
                'caFirmCompanyKey'=>$generatingCompanyKey,
                'isTermsAgree'=>$isTermsAgree,
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];

            $this->Mfirm->save($firmInsertArr);

            if($this->db->transStatus() === FALSE)
            {
                $this->db->transRollback();
                
                $responseArr['status']=false;
                $responseArr['userdata']=array();
                $responseArr['message']='Something went wrong!!, Please try again :(';
            }
            else
            {
                $this->db->transCommit();

                $insertLogArr['section']=$this->section;
                $insertLogArr['message']="New CA Firm Registered";
                $insertLogArr['ip']=$this->IPAddress;
                $insertLogArr['createdBy']=$this->adminId;
                $insertLogArr['createdDatetime']=$this->currTimeStamp;

                $this->Mcommon->insertLog($insertLogArr);
                
                $responseArr['status']=true;
                $responseArr['userdata']=array();
                $responseArr['message']='Registration has been done successfully.';
            }
        }
        
        echo json_encode($responseArr);
	}

    public function register()
    {
        $this->data['layoutPath']="template/layouts/full_layout";
        
        $profTypes = $this->MprofessionTypes->where('status', 1)
                    ->findAll();

        $this->data['profTypes']=$profTypes;

        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        $pmtOptions = $this->MpaymentOption->where('status', 1)
                    ->findAll();

        $this->data['pmtOptions']=$pmtOptions;

        $validationRulesArr['caFirmName']=['label' => 'Firm Name', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmProfession']=['label' => 'Type of Profession', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmType']=['label' => 'Firm Type', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmPan']=['label' => 'Firm Pan No', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmContactPerson']=['label' => 'Contact Person', 'rules' => 'required|trim'];
        $validationRulesArr['caFirmEmail']=['label' => 'Email', 'rules' => 'valid_email|required|trim'];
        $validationRulesArr['caFirmMobile']=['label' => 'Mobile', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmAddress']=['label' => 'Address', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmStateId']=['label' => 'State', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmCityId']=['label' => 'City', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmLandline']=['label' => 'Landline No', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmUsers']=['label' => 'Number of Users', 'rules'=> 'required|trim'];
        $validationRulesArr['caFirmPayment']=['label' => 'Payment Option', 'rules'=> 'required|trim'];
        $validationRulesArr['customerUserName']=['label' => 'User Name', 'rules'=> 'required|trim'];
        $validationRulesArr['customerPassword']=['label' => 'Password', 'rules'=> 'required|trim'];
        $validationRulesArr['customerConfPassword']=['label' => 'Confirm Password', 'rules'=> 'matches[customerPassword]|required|trim'];
        $validationRulesArr['customerVerify']=['label' => 'Verification Code', 'rules'=> 'required|trim'];
        $validationRulesArr['captchaCode']=['label' => 'Captcha', 'rules'=> 'required|trim'];
        $validationRulesArr['isTermsAgree']=['label' => 'Terms & Conditions', 'rules'=> 'required|trim'];

        $caFirmNameErr="";
        $caFirmProfessionErr="";
        $caFirmTypeErr="";
        $caFirmPanErr="";
        $caFirmContactPersonErr="";
        $caFirmEmailErr="";
        $caFirmMobileErr="";
        $caFirmAddressErr="";
        $caFirmStateIdErr="";
        $caFirmCityIdErr="";
        $caFirmLandlineErr="";
        $caFirmUsersErr="";
        $caFirmPaymentErr="";
        $customerUserNameErr="";
        $customerPasswordErr="";
        $customerConfPasswordErr="";
        $customerVerifyErr="";
        $captchaCodeErr="";
        $isTermsAgreeErr="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $caFirmNameErr=$this->validation->getError('caFirmName');
                $caFirmProfessionErr=$this->validation->getError('caFirmProfession');
                $caFirmTypeErr=$this->validation->getError('caFirmType');
                $caFirmPanErr=$this->validation->getError('caFirmPan');
                $caFirmContactPersonErr=$this->validation->getError('caFirmContactPerson');
                $caFirmEmailErr=$this->validation->getError('caFirmEmail');
                $caFirmMobileErr=$this->validation->getError('caFirmMobile');
                $caFirmAddressErr=$this->validation->getError('caFirmAddress');
                $caFirmStateIdErr=$this->validation->getError('caFirmStateId');
                $caFirmCityIdErr=$this->validation->getError('caFirmCityId');
                $caFirmLandlineErr=$this->validation->getError('caFirmLandline');
                $caFirmUsersErr=$this->validation->getError('caFirmUsers');
                $caFirmPaymentErr=$this->validation->getError('caFirmPayment');
                $customerUserNameErr=$this->validation->getError('customerUserName');
                $customerPasswordErr=$this->validation->getError('customerPassword');
                $customerConfPasswordErr=$this->validation->getError('customerConfPassword');
                $customerVerifyErr=$this->validation->getError('customerVerify');
                $captchaCodeErr=$this->validation->getError('captchaCode');
                $isTermsAgreeErr=$this->validation->getError('isTermsAgree');
            }
            else
            {
                $this->db->transBegin();

                $caFirmName=$this->request->getPost('caFirmName');
                $caFirmType=$this->request->getPost('caFirmType');
                $caFirmPan=$this->request->getPost('caFirmPan');
                $caFirmContactPerson=$this->request->getPost('caFirmContactPerson');
                $caFirmEmail=$this->request->getPost('caFirmEmail');
                $caFirmMobile=$this->request->getPost('caFirmMobile');
                $caFirmAddress=$this->request->getPost('caFirmAddress');
                $caFirmStateId=$this->request->getPost('caFirmStateId');
                $caFirmCityId=$this->request->getPost('caFirmCityId');
                $caFirmLandline=$this->request->getPost('caFirmLandline');
                $caFirmUsers=$this->request->getPost('caFirmUsers');
                $caFirmPayment=$this->request->getPost('caFirmPayment');
                $customerUserName=$this->request->getPost('customerUserName');
                $customerPassword=$this->request->getPost('customerPassword');
                $isTermsAgree=$this->request->getPost('isTermsAgree');
                
                $caFirmCompanyKey=rand(1000, 9999);
                $randomUpperCaseAlpha=getRandomUpperCaseAlpha(2);
                $caFirmCompanyKey=$randomUpperCaseAlpha.$caFirmCompanyKey;
                
                $generatingCompanyKey=$this->getCompanyKey($caFirmCompanyKey);

                $firmInsertArr = [
                    'caFirmName'=>$caFirmName,
                    'caFirmType'=>$caFirmType,
                    'caFirmPan'=>$caFirmPan,
                    'caFirmContactPerson'=>$caFirmContactPerson,
                    'caFirmEmail'=>$caFirmEmail,
                    'caFirmMobile'=>$caFirmMobile,
                    'caFirmAddress'=>$caFirmAddress,
                    'caFirmStateId'=>$caFirmStateId,
                    'caFirmCityId'=>$caFirmCityId,
                    'caFirmLandline'=>$caFirmLandline,
                    'caFirmUsers'=>$caFirmUsers,
                    'caFirmPayment'=>$caFirmPayment,
                    'customerUserName'=>$customerUserName,
                    'customerPassword'=>$customerPassword,
                    'caFirmCompanyKey'=>$generatingCompanyKey,
                    'isTermsAgree'=>$isTermsAgree,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];

                $this->Mfirm->save($firmInsertArr);

                if($this->db->transStatus() === FALSE)
                {
                    $this->db->transRollback();

                    $this->session->setFlashdata('errorMsg', "Something went wrong!! :(");
                }
                else
                {
                    $this->db->transCommit();

                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']="New CA Firm Registered";
                    $insertLogArr['ip']=$this->IPAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mcommon->insertLog($insertLogArr);

                    $this->session->setFlashdata('successMsg', "New CA Firm has been registered successfully :)");
                }

                return redirect()->route('superadmin/register');
            }
        }

	    $this->data['caFirmNameErr']=$caFirmNameErr;
        $this->data['caFirmProfessionErr']=$caFirmProfessionErr;
        $this->data['caFirmTypeErr']=$caFirmTypeErr;
        $this->data['caFirmPanErr']=$caFirmPanErr;
        $this->data['caFirmContactPersonErr']=$caFirmContactPersonErr;
        $this->data['caFirmEmailErr']=$caFirmEmailErr;
        $this->data['caFirmMobileErr']=$caFirmMobileErr;
        $this->data['caFirmAddressErr']=$caFirmAddressErr;
        $this->data['caFirmStateIdErr']=$caFirmStateIdErr;
        $this->data['caFirmCityIdErr']=$caFirmCityIdErr;
        $this->data['caFirmLandlineErr']=$caFirmLandlineErr;
        $this->data['caFirmUsersErr']=$caFirmUsersErr;
        $this->data['caFirmPaymentErr']=$caFirmPaymentErr;
        $this->data['customerUserNameErr']=$customerUserNameErr;
        $this->data['customerPasswordErr']=$customerPasswordErr;
        $this->data['customerConfPasswordErr']=$customerConfPasswordErr;
        $this->data['customerVerifyErr']=$customerVerifyErr;
        $this->data['captchaCodeErr']=$captchaCodeErr;
        $this->data['isTermsAgreeErr']=$isTermsAgreeErr;

        return view('super_admin/firm/register', $this->data);
    }
    
    public function getCompanyKey($randomKey)
	{
		$firmData=$this->Mfirm->where('status', 1)
                    ->where('caFirmCompanyKey', $randomKey)
                    ->get()
                    ->getRowArray();

		if(!empty($firmData))
		{
			$newRandKey=rand(1000, 9999);
            $randomUpperCaseAlpha=getRandomUpperCaseAlpha(2);
            $newRandKey=$randomUpperCaseAlpha.$newRandKey;

			$this->getCompanyKey($newRandKey);
		}
		else
		{
			$newRandKey=$randomKey;
		}

		return $newRandKey;
	}
	
	public function edit_firm($caFirmId)
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $pageTitle="Edit/View Firm";
        $this->data['pageTitle']=$pageTitle;
        
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
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
        $validationRulesArr['caFirmEmail']=['label' => 'Email', 'rules' => 'valid_email|required|trim'];
        $validationRulesArr['caFirmMobile']=['label' => 'Mobile', 'rules'=> 'required|trim'];
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

                    $this->session->setFlashdata('successMsg', "CA Firm details has been updated successfully :)");
                }

                return redirect()->route('superadmin/firmList');
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

        return view('super_admin/firm/editFirm', $this->data);
	}

    public function approve_firm()
	{
        $caFirmId=$this->request->getPost('caFirmId');

	    $dataArray = [
            'caFirmId' => $caFirmId,
            'caFirmStatus' => 1,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mfirm->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="CA Firm Approved";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "CA Firm has been approved successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "CA Firm has not approved :(");
        }
	}

    public function reject_firm()
	{
        $caFirmId=$this->request->getPost('caFirmId');

	    $dataArray = [
            'caFirmId' => $caFirmId,
            'caFirmStatus' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mfirm->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="CA Firm Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "CA Firm has been rejected :)");
        }else{
            $this->session->setFlashdata('errorMsg', "CA Firm has not rejected :(");
        }
	}
	
	public function delete_firm()
	{
        $caFirmId=$this->request->getPost('caFirmId');

	    $dataArray = [
            'caFirmId' => $caFirmId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mfirm->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="CA Firm Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "CA Firm has been deleted successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "CA Firm has not deleted :(");
        }
	}
}
