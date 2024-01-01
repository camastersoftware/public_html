<?php
namespace App\Controllers;

class ContGroup extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mcontgroup = new \App\Models\Mcontgroup();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Group";
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Group Master";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $contGrpArr = $this->Mcontgroup->where('status', 1)
                    ->orderBy('cont_group_name', "ASC")
                    ->findAll();

        $this->data['contGrpArr']=$contGrpArr;

        return view('firm_panel/contact/group/list', $this->data);
	}
	
	public function add()
	{
	    $cont_group_name=$this->request->getPost('cont_group_name');
	    
	    $insertArr=[
            'cont_group_name'=>$cont_group_name,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mcontgroup->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', $this->section." has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', $this->section." has not added :(");
	    }
	    
	    return redirect()->route('contGroups');
	}
	
	public function updateData()
	{
	    $this->db->transBegin();
	    
	    $cont_group_id=$this->request->getPost('cont_group_id');
	    $cont_group_name=$this->request->getPost('cont_group_name');
	    
	    $insertArr=[
            'cont_group_id'=>$cont_group_id,
            'cont_group_name'=>$cont_group_name,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Mcontgroup->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', $this->section." has not updated :(");
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
            
	        $this->session->setFlashdata('successMsg', $this->section." has been updated successfully :)");
	    }
	    
	    return redirect()->route('contGroups');
	}
	
	public function deleteData()
	{
	    $cont_group_id=$this->request->getPost('cont_group_id');
	    
	    $insertArr=[
            'cont_group_id'=>$cont_group_id,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mcontgroup->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', $this->section." has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', $this->section." has not deleted :(");
	    }
	}
}
?>