<?php
namespace App\Controllers;

class Holiday extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mholiday = new \App\Models\Mholiday();
        $this->Mconfig = new \App\Models\Mconfig();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Holiday";
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Holiday List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $holidayYr=$this->request->getGet('holidayYr');
        
        if(empty($holidayYr))
            $holidayYr=date('Y');
            
        $this->data['holidayYr']=$holidayYr;
        
        $holidayArr = $this->Mholiday->where('status', 1)
                    ->where('holidayYear', $holidayYr)
                    ->orderBy('holidayDate', "ASC")
                    ->findAll();
                    
        // print_r($holidayArr);
        // die();

        $this->data['holidayArr']=$holidayArr;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        return view('firm_panel/holiday/list', $this->data);
	}
	
	public function add()
	{
	    $holidayName=$this->request->getPost('holidayName');
	    $holidayDate=$this->request->getPost('holidayDate');
	    $holidayRemark=$this->request->getPost('holidayRemark');
	    
	    $holidayYear=date('Y', strtotime($holidayDate));
	    
	    $insertArr=[
            'holidayName'=>$holidayName,
            'holidayDate'=>$holidayDate,
            'holidayRemark'=>$holidayRemark,
            'holidayYear'=>$holidayYear,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mholiday->save($insertArr))
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
	    
	    return redirect()->route('holidays');
	}
	
	public function updateData()
	{
	    $this->db->transBegin();
	    
	    $holidayId=$this->request->getPost('holidayId');
	    $holidayName=$this->request->getPost('holidayName');
	    $holidayDate=$this->request->getPost('holidayDate');
	    $holidayRemark=$this->request->getPost('holidayRemark');
	    
	    $holidayYear=date('Y', strtotime($holidayDate));
	    
	    $insertArr=[
            'holidayId'=>$holidayId,
            'holidayName'=>$holidayName,
            'holidayDate'=>$holidayDate,
            'holidayRemark'=>$holidayRemark,
            'holidayYear'=>$holidayYear,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Mholiday->save($insertArr);
	    
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
	    
	    return redirect()->route('holidays');
	}
	
	public function deleteData()
	{
	    $holidayId=$this->request->getPost('holidayId');
	    
	    $insertArr=[
            'holidayId'=>$holidayId,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mholiday->save($insertArr))
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