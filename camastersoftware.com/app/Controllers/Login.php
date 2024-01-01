<?php
namespace App\Controllers;
use App\Models\Mfirm;
use App\Models\Mcommon;
use App\Libraries\ConnectDb;

class Login extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/login_layout";
    
        $this->Mfirm = new Mfirm();
        $this->Mcommon = new Mcommon();
        $this->ConnectDb = new ConnectDb();
        $this->MeverydayLab = new \App\Models\MeverydayLab();
        
        if(date('n')<=3)
            $this->curr_year=date('Y')-1;
        else
            $this->curr_year=date('Y');
            
        $this->currDate=date('Y-m-d');
    }

    public function index()
    {   
        $everydayLabArr = $this->MeverydayLab->where('status', 1)
                    ->where('everydayLabDate', $this->currDate)
                    ->get()
                    ->getFirstRow("array");
                    
        $this->data['everydayLabArr']=$everydayLabArr;
                    
        $validationRules=[
            'companyKey' => ['label' => 'License Number', 'rules' => 'required'],
            'username' => ['label' => 'Username', 'rules' => 'required'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
            'dueDateYear' => ['label' => 'Due Date Year', 'rules' => 'required']
        ];
        
        $currFinYr=$this->curr_year."-".(substr($this->curr_year+1, 2));
        
        $this->data['currFinYr']=$currFinYr;

        $errorMsg="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRules))
            {
                $this->data['companyKeyErr']=$companyKeyErr=$this->validation->getError('companyKey');
                $this->data['usernameErr']=$usernameErr=$this->validation->getError('username');
                $this->data['passwordErr']=$passwordErr=$this->validation->getError('password');
                $this->data['dueDateYearErr']=$dueDateYearErr=$this->validation->getError('dueDateYear');
            }
            else
            {
                $companyKey=$this->request->getPost('companyKey');
                $username=$this->request->getPost('username');
                $password=md5($this->request->getPost('password'));
                $dueDateYear=$this->request->getPost('dueDateYear');

                $getAccount = $this->Mfirm->select('ca_firm_tbl.caFirmId, ca_firm_tbl.caFirmName, ca_firm_tbl.caFirmType, ca_firm_tbl.caFirmUsers, ca_firm_tbl.caFirmPayment, ca_firm_tbl.isDiscontinue, ca_firm_tbl.caFirmStatus, profession_type_tbl.profession_type_name')
                            ->join('profession_type_tbl', 'profession_type_tbl.profession_type_id=ca_firm_tbl.caFirmProfession', 'left')
                            ->where('ca_firm_tbl.caFirmCompanyKey', $companyKey)
                            ->where('ca_firm_tbl.status', 1)
                            ->get()
                            ->getRowArray();

                if(!empty($getAccount)){

                    if($getAccount['caFirmStatus']==1){

                        $this->session->set($getAccount);
                        
                        $referenceArr['dueDateYear']=$dueDateYear;
                        
                        $this->session->set($referenceArr);

                        $caFirmId=$getAccount['caFirmId'];

                        if($this->ConnectDb->admin($caFirmId)){
                            
                            if($getAccount['isDiscontinue']!=1){
                            
                                $this->Mquery = new \App\Models\Mquery();
    
                                $userCondtnArr['user_tbl.userLoginName']=$username;
                                $userCondtnArr['user_tbl.status']="1";
                                
                                $query=$this->Mquery->getRecords($tableName="user_tbl", $colNames="user_tbl.userLoginName", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
                                
                                $getUser=$query['userData'];
    
                                if(!empty($getUser)){
    
                                    $userDataCondtnArr['user_tbl.userLoginName']=$username;
                                    $userDataCondtnArr['user_tbl.userPassword']=$password;
                                    $userDataCondtnArr['user_tbl.status']="1";
                                    
                                    $query=$this->Mquery->getRecords($tableName="user_tbl", $colNames="user_tbl.*, user_tbl.userId AS adminId, user_tbl.userLoginName AS userName", $userDataCondtnArr, $likeCondtnArr=array(), $userDataJoinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
                                    
                                    $getUserData=$query['userData'];
    
                                    if(!empty($getUserData)){
    
                                        $this->session->set($getUserData);
    
                                        return redirect()->to(base_url('home'));
    
                                    }else{
                                        $errorMsg="Password not matched";
                                    }
                                }else{
                                    $errorMsg="User not found, Please contact support!!";
                                }
                            }else{
                                $errorMsg="Your license has been discontinued, Please contact support!!";
                            }
                        }else{
                            $errorMsg="Error while connecting database, Please contact support!!";
                        }
                    }else{
                        $errorMsg="Account has not approved, Please contact support!!";
                    }
                }else{
                    $errorMsg="Account not found, Please contact support!!";
                }
            }
        }

        $this->data['errorMsg']=$errorMsg;

        return view('firm_panel/login', $this->data);
    }
    
    public function switchDueDateYear()
    {
        $dueDateYear=$this->request->getPost('dueDateYear');
        $currentURL=$this->request->getPost('currentURL');
        
        $referenceArr['dueDateYear']=$dueDateYear;
                        
        $this->session->set($referenceArr);
        
        // return redirect()->to('home');
        return redirect()->to($currentURL);
    }
    
    public function logout()
    {
        $this->session->destroy();
        
        return redirect()->route('login');
    }
}
