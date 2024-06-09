<?php
namespace App\Controllers;

class Reminder extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mreminder = new \App\Models\Mreminder();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->reminder_tbl=$tableArr['reminder_tbl'];
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Reminder";
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Reminder";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $reminderArr = $this->Mreminder->where('status', 1)
                    ->where('reminderAddedBy', $this->adminId)
                    ->orderBy('reminderDate', "DESC")
                    ->orderBy('reminderFrom', "DESC")
                    ->findAll();

        $this->data['reminderArr']=$reminderArr;

        return view('firm_panel/reminder/list', $this->data);
	}
	
	public function add()
	{
	    $reminderDate=$this->request->getPost('reminderDate');
	    $reminderFor=$this->request->getPost('reminderFor');
	    $reminderColor=$this->request->getPost('reminderColor');
	    $reminderFrom = $this->request->getPost('reminderFrom');
	    $reminderTo = $this->request->getPost('reminderTo');
	    
	    $insertArr=[
            'reminderDate'=>$reminderDate,
            'reminderFor'=>$reminderFor,
            'reminderColor'=>$reminderColor,
            'reminderFrom'=>$reminderFrom,
            'reminderTo'=>$reminderTo,
            'reminderAddedBy'=>$this->adminId,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mreminder->save($insertArr))
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
	    
	    return redirect()->route('reminder');
	}
	
	public function updateData()
	{
	    $this->db->transBegin();
	    
	    $reminderId=$this->request->getPost('reminderId');
	    $reminderDate=$this->request->getPost('reminderDate');
	    $reminderFor=$this->request->getPost('reminderFor');
	    $reminderColor=$this->request->getPost('reminderColor');
	    $reminderFrom = $this->request->getPost('reminderFrom');
	    $reminderTo = $this->request->getPost('reminderTo');
	    
	    $insertArr=[
            'reminderId'=>$reminderId,
            'reminderDate'=>$reminderDate,
            'reminderFor'=>$reminderFor,
            'reminderColor'=>$reminderColor,
            'reminderFrom'=>$reminderFrom,
            'reminderTo'=>$reminderTo,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Mreminder->save($insertArr);
	    
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
	    
	    return redirect()->route('reminder');
	}
	
	public function deleteData()
	{
	    $reminderId=$this->request->getPost('reminderId');
	    
	    $insertArr=[
            'reminderId'=>$reminderId,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mreminder->save($insertArr))
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