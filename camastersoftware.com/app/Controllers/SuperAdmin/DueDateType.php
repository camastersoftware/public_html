<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class DueDateType extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Due Date Type";

        $this->data['pageSection']=$this->section;
        
        $this->MDueDateType = new \App\Models\MDueDateType();
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Due Date Types";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $resultArr = $this->MDueDateType->where('status', 1)->findAll();

        $this->data['resultArr']=$resultArr;

        return view('super_admin/masters/due_date_types', $this->data);
	}
	
	public function add()
	{
	    $dueDateTypeName=$this->request->getPost('dueDateTypeName');
	    $dueDateTypeShortName=$this->request->getPost('dueDateTypeShortName');
	    
	    $dataArray = [
            'dueDateTypeName' => $dueDateTypeName,
            'dueDateTypeShortName' => $dueDateTypeShortName,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MDueDateType->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', $this->section." has been added successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', $this->section." has not added :(");
        }
        
        return redirect()->to(base_url('superadmin/due-date-types'));
	}
	
	public function edit()
	{
	    $dueDateTypeId=$this->request->getPost('dueDateTypeId');
	    $dueDateTypeName=$this->request->getPost('dueDateTypeName');
	    $dueDateTypeShortName=$this->request->getPost('dueDateTypeShortName');
	    
	    $dataArray = [
            'dueDateTypeId' => $dueDateTypeId,
            'dueDateTypeName' => $dueDateTypeName,
            'dueDateTypeShortName' => $dueDateTypeShortName,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MDueDateType->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', $this->section." has been updated successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', $this->section." has not updated :(");
        }
        
        return redirect()->to(base_url('superadmin/due-date-types'));
	}
	
	public function delete()
	{
        $dueDateTypeId=$this->request->getPost('dueDateTypeId');

	    $dataArray = [
            'dueDateTypeId' => $dueDateTypeId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MDueDateType->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', $this->section." has been deleted successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', $this->section." has not deleted :(");
        }
	}
}
