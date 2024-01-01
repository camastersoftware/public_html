<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class Salutation extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Salutation";

        $this->data['pageSection']=$this->section;
        
        $this->Msalutation = new \App\Models\Msalutation();
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Salutation List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $resultArr = $this->Msalutation->where('status', 1)
                    ->findAll();

        $this->data['resultArr']=$resultArr;

        return view('super_admin/masters/salutation', $this->data);
	}
	
	public function add()
	{
	    $salutation_name=$this->request->getPost('salutation_name');
	    
	    $dataArray = [
            'salutation_name' => $salutation_name,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Msalutation->save($dataArray)){
            
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
        
        return redirect()->route('superadmin/salutation');
	}
	
	public function edit()
	{
	    $salutation_id=$this->request->getPost('salutation_id');
	    $salutation_name=$this->request->getPost('salutation_name');
	    
	    $dataArray = [
            'salutation_id' => $salutation_id,
            'salutation_name' => $salutation_name,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Msalutation->save($dataArray)){
            
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
        
        return redirect()->route('superadmin/salutation');
	}
	
	public function delete()
	{
        $salutation_id=$this->request->getPost('salutation_id');

	    $dataArray = [
            'salutation_id' => $salutation_id,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Msalutation->save($dataArray)){
            
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
