<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class Databank extends BaseController
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
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->data_bank_tbl=$tableArr['data_bank_tbl'];
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Data Bank";
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Data Bank";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $dataBankArr = $this->Mdata_bank->where('status', 1)
                    ->where('isDemo !=', 1)
                    ->orderBy('data_bank_id', 'DESC')
                    ->findAll();

        $this->data['dataBankArr']=$dataBankArr;

        return view('super_admin/databank/home', $this->data);
	}
	
	public function add()
	{
	    $data_bank_name=$this->request->getPost('data_bank_name');
	    $data_bank_email=$this->request->getPost('data_bank_email');
	    $data_bank_contact=$this->request->getPost('data_bank_contact');
	    
	    $insertArr=[
            'data_bank_name'=>$data_bank_name,
            'data_bank_email'=>$data_bank_email,
            'data_bank_contact'=>$data_bank_contact,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mdata_bank->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Data Bank has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Data Bank has not added :(");
	    }
	    
	    return redirect()->route('superadmin/dataBank');
	}
	
	public function updateData()
	{
	    $this->db->transBegin();
	    
	    $data_bank_id=$this->request->getPost('data_bank_id');
	    $data_bank_name=$this->request->getPost('data_bank_name');
	    $data_bank_email=$this->request->getPost('data_bank_email');
	    $data_bank_contact=$this->request->getPost('data_bank_contact');
	    $data_bank_contacted_on=$this->request->getPost('data_bank_contacted_on');
	    $data_bank_follow_up_on=$this->request->getPost('data_bank_follow_up_on');
	    $data_bank_remark=$this->request->getPost('data_bank_remark');
	    $data_bank_demo_req_on=$this->request->getPost('data_bank_demo_req_on');
	    $isDemo=$this->request->getPost('isDemo');
	    
	    if(empty($isDemo))
	        $isDemo=0;
	    
	    $insertArr=[
            'data_bank_id'=>$data_bank_id,
            'data_bank_name'=>$data_bank_name,
            'data_bank_email'=>$data_bank_email,
            'data_bank_contact'=>$data_bank_contact,
            'data_bank_contacted_on'=>$data_bank_contacted_on,
            'data_bank_follow_up_on'=>$data_bank_follow_up_on,
            'data_bank_remark'=>$data_bank_remark,
            'data_bank_demo_req_on'=>$data_bank_demo_req_on,
            'isDemo'=>$isDemo,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Mdata_bank->save($insertArr);
	    
	    if($isDemo==1)
	    {
    	    $demoReqName=$data_bank_name;
    	    $demoReqEmail=$data_bank_email;
    	    $demoReqMobile=$data_bank_contact;
    	    $demoDate=$data_bank_demo_req_on;
    	    
    	    $insertDemoArr=[
                'demoReqDateTime'=>date('Y-m-d H:i:s'),
                'demoReqName'=>$demoReqName,
                'demoReqEmail'=>$demoReqEmail,
                'demoReqMobile'=>$demoReqMobile,
                'demoDate'=>$demoDate,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];
    	    
    	    $this->Mdemo->save($insertDemoArr);
	    }
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Data Bank has not updated :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Data Bank has been updated successfully :)");
	    }
	    
	    return redirect()->route('superadmin/dataBank');
	}
	
	public function deleteData()
	{
	    $data_bank_id=$this->request->getPost('data_bank_id');
	    
	    $insertArr=[
            'data_bank_id'=>$data_bank_id,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mdata_bank->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Data Bank has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Data Bank has not deleted :(");
	    }
	    
	    return redirect()->route('superadmin/dataBank');
	}
}
?>