<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class Demo_request extends BaseController
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
        
        $this->section="Demo Request";
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Demo Requests";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $demoReqList = $this->Mdemo->where('status', 1)
                    ->orderBy('demoReqDateTime', 'DESC')
                    ->findAll();

        $this->data['demoReqList']=$demoReqList;

        return view('super_admin/demo_request/home', $this->data);
	}
	
	public function updateData()
	{
	   // print_r($this->request->getPost());
	   // die();
	    $demoReqId=$this->request->getPost('demoReqId');
	    $demoReqDateTime=$this->request->getPost('demoReqDateTime');
	    $demoReqName=$this->request->getPost('demoReqName');
	    $demoReqEmail=$this->request->getPost('demoReqEmail');
	    $demoReqMobile=$this->request->getPost('demoReqMobile');
	    $demoDate=$this->request->getPost('demoDate');
	    $demoReqStatus=$this->request->getPost('demoReqStatus');
	    $demoBy=$this->request->getPost('demoBy');
	    $demoLicense=$this->request->getPost('demoLicense');
	    $demoRemark=$this->request->getPost('demoRemark');
	    
	    $insertArr=[
            'demoReqId'=>$demoReqId,
            'demoReqDateTime'=>date('Y-m-d H:i:s'),
            'demoReqName'=>$demoReqName,
            'demoReqEmail'=>$demoReqEmail,
            'demoReqMobile'=>$demoReqMobile,
            'demoDate'=>$demoDate,
            'demoReqStatus'=>$demoReqStatus,
            'demoBy'=>$demoBy,
            'demoLicense'=>$demoLicense,
            'demoRemark'=>$demoRemark,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
        
        // print_r($insertArr);
        // die();
	    
	    if($this->Mdemo->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Demo Request has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Demo Request has not updated :(");
	    }
	    
	    return redirect()->route('superadmin/demo_requests');
	}
	
	public function replyDemo()
	{
	    $this->db->transBegin();
	    
	    $this->section="Demo Requests";
	    
	    $demoReqId=$this->request->getPost('demoReqId');
	    
	     $insertArr=[
            'demoReqId'=>$demoReqId,
            'isReplied' => 1,
            'replyDateTime'=>date('Y-m-d H:i:s'),
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
        
        $this->Mdemo->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong, Please try again.");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Replied";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Replied Successfully :)");
        }
	}
	
	public function deleteDemo()
	{
	    $this->db->transBegin();
	    
	    $this->section="Demo Requests";
	    
	    $demoReqId=$this->request->getPost('demoReqId');
	    
	     $insertArr=[
	        'demoReqId'=>$demoReqId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
        
        $this->Mdemo->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong, Please try again.");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Replied";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Demo Request has been deleted successfully :)");
        }
	}
}
?>