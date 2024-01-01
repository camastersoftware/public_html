<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class ProfessionTypes extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Profession Types";
        
        $this->MprofessionTypes = new \App\Models\MprofessionTypes();
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Type List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Profession Type List";

        $this->data['navArr']=$navArr;

        $resultArr = $this->MprofessionTypes->where('status', 1)
                    ->findAll();

        $this->data['resultArr']=$resultArr;

        return view('super_admin/profession_types', $this->data);
	}
	
	public function add_profession()
	{
	    $profession_type_name=$this->request->getPost('profession_type_name');
	    
	    $dataArray = [
            'profession_type_name' => $profession_type_name,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MprofessionTypes->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Profession Type Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Profession Type has been added successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "Profession Type has not added :(");
        }
        
        return redirect()->route('superadmin/profession_types');
	}
	
	public function edit_profession()
	{
	    $profession_type_id=$this->request->getPost('profession_type_id');
	    $profession_type_name=$this->request->getPost('profession_type_name');
	    
	    $dataArray = [
            'profession_type_id' => $profession_type_id,
            'profession_type_name' => $profession_type_name,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MprofessionTypes->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Profession Type Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Profession Type has been updated successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "Profession Type has not updated :(");
        }
        
        return redirect()->route('superadmin/profession_types');
	}
	
	public function delete_profession()
	{
        $profession_type_id=$this->request->getPost('profession_type_id');

	    $dataArray = [
            'profession_type_id' => $profession_type_id,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MprofessionTypes->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Profession Type Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Profession Type has been deleted successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "Profession Type has not deleted :(");
        }
        
        return redirect()->route('superadmin/profession_types');
	}
}
