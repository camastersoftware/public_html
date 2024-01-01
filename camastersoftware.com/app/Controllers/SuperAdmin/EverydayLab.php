<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class EverydayLab extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->MeverydayLab = new \App\Models\MeverydayLab();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Everyday Lab";
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Everyday Lab";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $resultArr = $this->MeverydayLab->where('status', 1)
                    ->orderBy('everydayLabDate', 'ASC')
                    ->findAll();

        $this->data['resultArr']=$resultArr;

        return view('super_admin/masters/everyday_lab', $this->data);
	}
	
	public function addData()
	{
	    $everydayLabDate=$this->request->getPost('everydayLabDate');
	    $everydayLabImage=$this->request->getFile('everydayLabImage');
	    $everydayLabQuotes=$this->request->getPost('everydayLabQuotes');
	    
	    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
	    
	    $everydayLabImageFile="";
        if(!empty($everydayLabImage->getTempName()))
        {
            if($everydayLabImage->isValid() && ! $everydayLabImage->hasMoved())
            {
                $ext=$everydayLabImage->guessExtension();
                
                if (in_array($ext, $allowedExtensions))
                {
                    $uploadPath=FCPATH.EVERYDAYLABPATH;
    
                    $everydayLabImageFile = $everydayLabImage->getRandomName();
                    $everydayLabImage->move($uploadPath, $everydayLabImageFile);
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Only image is accepted");
                    return redirect()->back();
                }
            }
            else
            {
                $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                return redirect()->back();
            }
        }
        
        $resultArr = $this->MeverydayLab->where('status', 1)
                    ->where('everydayLabDate', $everydayLabDate)
                    ->findAll();
	    
	    if(empty($resultArr))
	    {
    	    $insertArr=[
                'everydayLabDate'=>$everydayLabDate,
                'everydayLabImage'=>$everydayLabImageFile,
                'everydayLabQuotes'=>$everydayLabQuotes,
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];
    	    
    	    if($this->MeverydayLab->save($insertArr))
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
	    }
	    else
	    {
	        $everydayLabDateVal = (check_valid_date($everydayLabDate)) ? date("d-m-Y", strtotime($everydayLabDate)) : "";
	        
	        if(!empty($everydayLabDateVal))
	            $this->session->setFlashdata('errorMsg', "For this date (".$everydayLabDateVal."), already added, please select another date :(");
	    }
	    
	    return redirect()->route('superadmin/everyday_lab');
	}
	
	public function updateData()
	{
	    $this->db->transBegin();
	    
	    $everydayLabId=$this->request->getPost('everydayLabId');
	    $everydayLabDate=$this->request->getPost('everydayLabDate');
	    $everydayLabDateOld=$this->request->getPost('everydayLabDateOld');
	    $everydayLabImage=$this->request->getFile('everydayLabImage');
	    $everydayLabImageOld=$this->request->getPost('everydayLabImageOld');
	    $everydayLabQuotes=$this->request->getPost('everydayLabQuotes');
	    
	    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
	    
	    $everydayLabImageFile="";
        if(!empty($everydayLabImage->getTempName()))
        {
            if($everydayLabImage->isValid() && ! $everydayLabImage->hasMoved())
            {
                $ext=$everydayLabImage->guessExtension();
                
                if (in_array($ext, $allowedExtensions))
                {
                    $uploadPath=FCPATH.EVERYDAYLABPATH;
    
                    $everydayLabImageFile = $everydayLabImage->getRandomName();
                    $everydayLabImage->move($uploadPath, $everydayLabImageFile);
                    
                    if(!empty($everydayLabImageOld))
                    {
                        $delUploadFilePath=$uploadPath."/".$everydayLabImageOld;
                        unlink($delUploadFilePath);
                    }
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Only image is accepted");
                    return redirect()->back();
                }
            }
            else
            {
                $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                return redirect()->back();
            }
        }
        else
        {
            $everydayLabImageFile = $everydayLabImageOld;
        }
        
        $isValidDate=false;
        
        if($everydayLabDate!=$everydayLabDateOld)
        {
            $resultArr = $this->MeverydayLab->where('status', 1)
                    ->where('everydayLabDate', $everydayLabDate)
                    ->findAll();
                    
            if(!empty($resultArr))
            {
                $isValidDate=true;
            }
        }
	    
	    if(!$isValidDate)
	    {
    	    $insertArr=[
                'everydayLabId'=>$everydayLabId,
                'everydayLabDate'=>$everydayLabDate,
                'everydayLabImage'=>$everydayLabImageFile,
                'everydayLabQuotes'=>$everydayLabQuotes,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];
    	    
    	    $this->MeverydayLab->save($insertArr);
    	    
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
	    }
	    else
	    {
	        $everydayLabDateVal = (check_valid_date($everydayLabDate)) ? date("d-m-Y", strtotime($everydayLabDate)) : "";
	        
	        if(!empty($everydayLabDateVal))
	            $this->session->setFlashdata('errorMsg', "For this date (".$everydayLabDateVal."), already added, please select another date :(");
	    }
	    
	    return redirect()->route('superadmin/everyday_lab');
	}
	
	public function deleteData()
	{
	    $everydayLabId=$this->request->getPost('everydayLabId');
	    
	    $insertArr=[
            'everydayLabId'=>$everydayLabId,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->MeverydayLab->save($insertArr))
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
	    
	    return true;
	}
}
?>