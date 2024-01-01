<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class StaffType extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Staff Type";

        $this->data['pageSection']=$this->section;
        
        $this->MstaffTypes = new \App\Models\MstaffTypes();
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Staff Type List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $resultArr = $this->MstaffTypes->where('status', 1)
                    ->findAll();

        $this->data['resultArr']=$resultArr;

        return view('super_admin/masters/staff_types', $this->data);
	}
	
	public function add()
	{
	    $staff_type_name=$this->request->getPost('staff_type_name');
	    
	    $dataArray = [
            'staff_type_name' => $staff_type_name,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MstaffTypes->save($dataArray)){
            
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
        
        return redirect()->route('superadmin/staff_types');
	}
	
	public function edit()
	{
	    $staff_type_id=$this->request->getPost('staff_type_id');
	    $staff_type_name=$this->request->getPost('staff_type_name');
	    
	    $dataArray = [
            'staff_type_id' => $staff_type_id,
            'staff_type_name' => $staff_type_name,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MstaffTypes->save($dataArray)){
            
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
        
        return redirect()->route('superadmin/staff_types');
	}
	
	public function delete()
	{
        $staff_type_id=$this->request->getPost('staff_type_id');

	    $dataArray = [
            'staff_type_id' => $staff_type_id,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MstaffTypes->save($dataArray)){
            
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
