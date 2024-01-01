<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class Act extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Act";

        $this->data['pageSection'] = $this->section;
        
        $this->Mact = new \App\Models\Mact();
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Act List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $resultArr = $this->Mact->where('status', 1)
                    ->findAll();

        $this->data['resultArr']=$resultArr;

        return view('super_admin/masters/acts', $this->data);
	}
	
	public function add()
	{
	    $act_name=$this->request->getPost('act_name');
	    
	    $dataArray = [
            'act_name' => $act_name,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mact->save($dataArray)){
            
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
        
        return redirect()->route('superadmin/acts');
	}
	
	public function edit()
	{
	    $act_id=$this->request->getPost('act_id');
	    $act_name=$this->request->getPost('act_name');
	    
	    $dataArray = [
            'act_id' => $act_id,
            'act_name' => $act_name,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mact->save($dataArray)){
            
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
        
        return redirect()->route('superadmin/acts');
	}
	
	public function delete()
	{
        $act_id=$this->request->getPost('act_id');

	    $dataArray = [
            'act_id' => $act_id,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mact->save($dataArray)){
            
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

    public function view_options($actId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Act Options";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        $this->data['actId']=$actId;

        $actArr = $this->Mact->where('act_id', $actId)
                    ->where('status', 1)
                    ->get()
                    ->getRowArray();

        $this->data['actArr']=$actArr;

        return view('super_admin/masters/view_options', $this->data);
	}
}
