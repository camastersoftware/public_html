<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class Home extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";

        $this->Mdue_date = new \App\Models\Mdue_date();
        $this->Maccount = new \App\Models\Maccount();
        $this->Mannouncements = new \App\Models\Mannouncements();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        
        ini_set('memory_limit', '-1');
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('jquery-ui', 'perfect-scrollbar-master', 'fullcalendar', 'calendar');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Home";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

        // $dueDatesArr = $this->Mdue_date->select('due_date_master_tbl.*, act_tbl.act_name')
        //             ->join('act_tbl', 'act_tbl.act_id=due_date_master_tbl.due_act', 'left')
        //             ->where('due_date_master_tbl.status', 1)
        //             ->findAll();
                    
        $dueDatesArr = $this->Mdue_date->select('due_date_master_tbl.*, act_tbl.act_name, ext_due_date_master_tbl.extended_date')
                    ->join('act_tbl', 'act_tbl.act_id=due_date_master_tbl.due_act', 'left')
                    ->join($this->ext_due_date_master_tbl, 'ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1', 'left')
                    ->where('due_date_master_tbl.status', 1)
                    ->where('ext_due_date_master_tbl.status', 1)
                    ->where('ext_due_date_master_tbl.is_extended', 2)
                    ->findAll();
                    
        $this->data['dueDatesArr']=$dueDatesArr;

        $dueDateArrCol=array();

        if(!empty($dueDatesArr))
        {
            // $dueDateArrayCol=array_column($dueDatesArr, 'due_date');
            // $extDueDateArrayCol=array_column($dueDatesArr, 'ext_due_date');
            
            // $dueDateArrCol=array_merge($dueDateArrayCol, $extDueDateArrayCol);
            
            $dueDateArrayCol=array_column($dueDatesArr, 'extended_date');

            $dueDateArrCol=$dueDateArrayCol;
        }

        $this->data['dueDateArrCol']=$dueDateArrCol;
        
        $currentDate=date('Y-m-d');
        
        $ancmntArr = $this->Mannouncements->where('status', 1)
                    ->where('stopAnc', 1)
                    ->where('startDate <=', $currentDate)
                    ->where('endDate >=', $currentDate)
                    ->findAll();
                    
        $ancmntStr="";
        
        if(!empty($ancmntArr))
        {
            $ancmntArray=array_column($ancmntArr, 'ancName');
            $ancmntStr=implode(' | ', $ancmntArray);
        }

        $this->data['ancmntStr']=$ancmntStr;
        
        return view('super_admin/home', $this->data);
	}

	public function myAccountDetails()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="CA-Master Details";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $accountDataArr = $this->Maccount->where('status', 1)->get()->getRowArray();

        $this->data['accountDataArr']=$accountDataArr;

        return view('super_admin/myAccountDetails', $this->data);
	}

	public function updateAccountDetails()
	{
        $accountId=$this->request->getPost('accountId');
        $companyName=$this->request->getPost('companyName');
        $officeAddress=$this->request->getPost('officeAddress');
        $cinNumber=$this->request->getPost('cinNumber');
        $panNumber=$this->request->getPost('panNumber');
        $tanNumber=$this->request->getPost('tanNumber');
        $gstNumber=$this->request->getPost('gstNumber');
        $website=$this->request->getPost('website');
        $emailAddress=$this->request->getPost('emailAddress');
        $landlineNumber=$this->request->getPost('landlineNumber');
        $mobileNumber=$this->request->getPost('mobileNumber');
        $bankAccountName=$this->request->getPost('bankAccountName');
        $bankName=$this->request->getPost('bankName');
        $bankBranch=$this->request->getPost('bankBranch');
        $bankAccountNumber=$this->request->getPost('bankAccountNumber');
        $bankIFSC=$this->request->getPost('bankIFSC');
	    
	    $dataArray = [
            'accountId' => $accountId,
            'companyName' => $companyName,
            'officeAddress' => $officeAddress,
            'cinNumber' => $cinNumber,
            'panNumber' => $panNumber,
            'tanNumber' => $tanNumber,
            'gstNumber' => $gstNumber,
            'website' => $website,
            'emailAddress' => $emailAddress,
            'landlineNumber' => $landlineNumber,
            'mobileNumber' => $mobileNumber,
            'bankAccountName' => $bankAccountName,
            'bankName' => $bankName,
            'bankBranch' => $bankBranch,
            'bankAccountNumber' => $bankAccountNumber,
            'bankIFSC' => $bankIFSC,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Maccount->save($dataArray)){
            
            $insertLogArr['section']="CAMaster Details";
            $insertLogArr['message']="CAMaster Details Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "CAMaster Details has been updated successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "CAMaster Details has not updated :(");
        }
        
        return redirect()->route('superadmin/myAccountDetails');
	}

    public function css_js_arr()
    {
        $cssArr=array();
        $jsArr=array();
    }
}
