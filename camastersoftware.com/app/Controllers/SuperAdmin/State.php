<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class State extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="State";
        
        $this->Mstate = new \App\Models\Mstate();
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="State List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="State List";

        $this->data['navArr']=$navArr;

        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        return view('super_admin/stateList', $this->data);
	}
	
	public function add()
	{
	    $stateName=$this->request->getPost('stateName');
	    
	    $dataArray = [
            'stateName' => $stateName,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mstate->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="State Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "State has been added successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "State has not added :(");
        }
        
        return redirect()->route('superadmin/states');
	}
	
	public function edit()
	{
	    $stateId=$this->request->getPost('stateId');
	    $stateName=$this->request->getPost('stateName');
	    
	    $dataArray = [
            'stateId' => $stateId,
            'stateName' => $stateName,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mstate->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="State Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "State has been updated successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "State has not updated :(");
        }
        
        return redirect()->route('superadmin/states');
	}
	
	public function delete()
	{
        $stateId=$this->request->getPost('stateId');

	    $dataArray = [
            'stateId' => $stateId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mstate->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="State Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "State has been deleted successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "State has not deleted :(");
        }
	}
}
