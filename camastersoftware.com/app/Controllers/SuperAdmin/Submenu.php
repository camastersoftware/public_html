<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class Submenu extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mmenu = new \App\Models\Mmenu();
        $this->Msubmenu = new \App\Models\Msubmenu();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Submenu";
    }

	public function home($menuId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $this->data['menuId']=$menuId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Submenu";
        $this->data['pageTitle']=$pageTitle;
        
        $this->data['pageSection']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $menuNameArr = $this->Mmenu->where('menuId', $menuId)->where('status', 1)->get()->getRowArray();
        
        $this->data['menuNameArr']=$menuNameArr;
        
        $resultArr = $this->Msubmenu->where('status', 1)
                    ->where('fkMenuId', $menuId)
                    ->findAll();

        $this->data['resultArr']=$resultArr;

        return view('super_admin/masters/submenus', $this->data);
	}
	
	public function add()
	{
	    $subMenuName=$this->request->getPost('subMenuName');
	    $fkMenuId=$this->request->getPost('fkMenuId');
	    
	    $insertArr=[
            'subMenuName'=>$subMenuName,
            'fkMenuId'=>$fkMenuId,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Msubmenu->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Submenu has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Submenu has not added :(");
	    }
	    
	    return redirect()->to(base_url('superadmin/submenus/'.$fkMenuId));
	}
	
	public function updateData()
	{
	    $this->db->transBegin();
	    
	    $subMenuId=$this->request->getPost('subMenuId');
	    $subMenuName=$this->request->getPost('subMenuName');
	    $fkMenuId=$this->request->getPost('fkMenuId');
	    
	    $updateArr=[
            'subMenuId'=>$subMenuId,
            'subMenuName'=>$subMenuName,
            'fkMenuId'=>$fkMenuId,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Msubmenu->save($updateArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Submenu has not updated :(");
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
            
	        $this->session->setFlashdata('successMsg', "Submenu has been updated successfully :)");
	    }
	    
	    return redirect()->to(base_url('superadmin/submenus/'.$fkMenuId));
	}
	
	public function deleteData()
	{
	    $subMenuId=$this->request->getPost('subMenuId');
	    
	    $insertArr=[
            'subMenuId'=>$subMenuId,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Msubmenu->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Submenu has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Submenu has not deleted :(");
	    }
	}
}
?>