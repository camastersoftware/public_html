<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class Announcement extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mannouncements = new \App\Models\Mannouncements();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Admin Announcement";
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Announcements";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $this->data['navArr']=$navArr;
        
        $ddFromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $ddToDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $this->data['ddFromDate']=$ddFromDate;
        $this->data['ddToDate']=$ddToDate;
        
        $ancArr = $this->Mannouncements->where('status', 1)
                    ->orderBy('startDate', "DESC")
                    ->findAll();

        $this->data['ancArr']=$ancArr;

        return view('super_admin/announcement/list', $this->data);
	}
	
	public function add()
	{
	    $ancName=$this->request->getPost('ancName');
	    $startDate=$this->request->getPost('startDate');
	    $endDate=$this->request->getPost('endDate');
	    
	    $insertArr=[
            'ancName'=>$ancName,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'stopAnc'=>1,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mannouncements->save($insertArr))
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
	    
	    return redirect()->route('superadmin/announcements');
	}
	
	public function updateData()
	{
	    $this->db->transBegin();
	    
	    $ancId=$this->request->getPost('ancId');
	    $ancName=$this->request->getPost('ancName');
	    $startDate=$this->request->getPost('startDate');
	    $endDate=$this->request->getPost('endDate');
	    
	    $insertArr=[
            'ancId'=>$ancId,
            'ancName'=>$ancName,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Mannouncements->save($insertArr);
	    
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
	    
	    return redirect()->route('superadmin/announcements');
	}
	
	public function stopAnc()
	{
	    $ancId=$this->request->getPost('ancId');
	    
	    $insertArr=[
            'ancId'=>$ancId,
            'stopAnc'=>1,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mannouncements->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Stopped";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', $this->section." has been stopped successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', $this->section." has not stop :(");
	    }
	}
	
	public function deactivateAnc()
	{
	    $ancId=$this->request->getPost('ancId');
	    
	    $insertArr=[
            'ancId'=>$ancId,
            'stopAnc'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mannouncements->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Stopped";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', $this->section." has been deactivated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', $this->section." has not deactivate :(");
	    }
	}
	
	public function activateAnc()
	{
	    $ancId=$this->request->getPost('ancId');
	    
	    $insertArr=[
            'ancId'=>$ancId,
            'stopAnc'=>1,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mannouncements->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Stopped";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', $this->section." has been activated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', $this->section." has not activate :(");
	    }
	}
	
	public function deleteAnc()
	{
	    $ancId=$this->request->getPost('ancId');
	    
	    $insertArr=[
            'ancId'=>$ancId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mannouncements->save($insertArr))
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
	        $this->session->setFlashdata('errorMsg', $this->section." has not stop :(");
	    }
	}
}
?>