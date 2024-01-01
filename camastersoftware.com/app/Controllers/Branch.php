<?php
namespace App\Controllers;

class Branch extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Branch";
        
        $this->Mbranch = new \App\Models\Mbranch();
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Branch List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Branch List";

        $this->data['navArr']=$navArr;

        $branchList = $this->Mbranch->where('status', 1)
                    ->findAll();

        $this->data['branchList']=$branchList;

        return view('branchList', $this->data);
	}
	
	public function add_branch()
	{
	    $branchName=$this->request->getPost('branchName');
	    
	    $dataArray = [
            'branchName' => $branchName,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mbranch->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Branch Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Branch has been added successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "Branch has not added :(");
        }
        
        return redirect()->route('branch');
	}
	
	public function edit_branch()
	{
	    $branchId=$this->request->getPost('branchId');
	    $branchName=$this->request->getPost('branchName');
	    
	    $dataArray = [
            'branchId' => $branchId,
            'branchName' => $branchName,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mbranch->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Branch Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Branch has been updated successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "Branch has not updated :(");
        }
        
        return redirect()->route('branch');
	}
	
	public function delete_branch($branchId)
	{
	    $dataArray = [
            'branchId' => $branchId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mbranch->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Branch Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Branch has been deleted successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "Branch has not deleted :(");
        }
        
        return redirect()->route('branch');
	}
}
