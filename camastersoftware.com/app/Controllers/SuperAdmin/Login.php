<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;
use App\Models\Mlogin;
use App\Models\Mcommon;

class Login extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/login_layout";

        $this->Mlogin = new Mlogin();
        $this->Mcommon = new Mcommon();
        
        if(date('n')<=3)
            $this->curr_year=date('Y')-1;
        else
            $this->curr_year=date('Y');
    }

    public function index()
    {
        // $query=$this->Mcommon->getRecords($tableName="admin_tbl", $colNames="*", $docCondtnArr=array(), $likeCondtnArr=array(), $docJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        // $doctorArr=$query['userData'];
        
        // print_r($doctorArr);
        // die();
        
        $currFinYr=$this->curr_year."-".(substr($this->curr_year+1, 2));
        
        $this->data['currFinYr']=$currFinYr;
        
        $validationRules=[
            'username' => ['label' => 'Username', 'rules' => 'required'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
            'dueDateYear' => ['label' => 'Due Date Year', 'rules' => 'required']
        ];

        $errorMsg="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRules))
            {
                $this->data['usernameErr']=$usernameErr=$this->validation->getError('username');
                $this->data['passwordErr']=$passwordErr=$this->validation->getError('password');
                $this->data['dueDateYearErr']=$dueDateYearErr=$this->validation->getError('dueDateYear');
            }
            else
            {
                $username=$this->request->getPost('username');
                $password=md5($this->request->getPost('password'));
                $dueDateYear=$this->request->getPost('dueDateYear');

                $getUser = $this->Mlogin->where('userName', $username)
                            ->where('status', 1)
                            ->findAll();

                if(!empty($getUser)){

                    $getUserData = $this->Mlogin->where('userName', $username)
                        ->where('password', $password)
                        ->where('status', 1)
                        ->findAll();

                    if(!empty($getUserData)){

                        $userDataArr=$getUserData[0];
                        
                        $this->session->set($userDataArr);
                        
                        $referenceArr['dueDateYear']=$dueDateYear;
                        
                        $this->session->set($referenceArr);

                        return redirect()->to(base_url('superadmin/home'));

                    }else{
                        $errorMsg="Password not matched";
                    }
                }else{
                    $errorMsg="User not found";
                }
            }
        }

//        $this->session->setFlashdata('errorMsg', $errorMsg);

        $this->data['errorMsg']=$errorMsg;

        return view('super_admin/login', $this->data);
    }
    
    public function switchDueDateYearSuperAdmin()
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
        $sessArr = ['adminId','userName','password','status'];

        $this->session->remove($sessArr);
        
        return redirect()->route('superadmin/login');
    }
}
