<?php
namespace App\Controllers;

class Referencer extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mreferncer = new \App\Models\Mreferncer();
        $this->Mrefgroup = new \App\Models\Mrefgroup();
        $this->Mrefsubgroup = new \App\Models\Mrefsubgroup();
        $this->MFirmReferncer = new \App\Models\MFirmReferncer();
        $this->Mfirmrefgroup = new \App\Models\Mfirmrefgroup();
        $this->Mfirmrefsubgroup = new \App\Models\Mfirmrefsubgroup();
        $this->Mdemo = new \App\Models\Mdemo();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->data_bank_tbl=$tableArr['data_bank_tbl'];
        $this->referencer_groups=$tableArr['referencer_groups'];
        $this->referencer_sub_groups=$tableArr['referencer_sub_groups'];
        $this->firm_referencer_groups=$tableArr['firm_referencer_groups'];
        $this->firm_referencer_sub_groups=$tableArr['firm_referencer_sub_groups'];
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Referencer";
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Referencer";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $refGrpArr = $this->Mfirmrefgroup->where('status', 1)
                    ->orderBy('refGrpName', "ASC")
                    ->orderBy('refGrpId', "ASC")
                    ->findAll();
                    
        $this->data['refGrpArr']=$refGrpArr;
        
        $refSubGrpArr = $this->Mfirmrefsubgroup->where('status', 1)
                    ->orderBy('refSubGrpName', "ASC")
                    ->orderBy('refSubGrpId', "ASC")
                    ->findAll();

        $this->data['refSubGrpArr']=$refSubGrpArr;
        
        $queryGroup=$this->request->getGet('group');
        $querySubGroup=$this->request->getGet('sub_group');
        
        $this->data['queryGroup']=$queryGroup;
        $this->data['querySubGroup']=$querySubGroup;
        
        $this->MFirmReferncer->where('status', 1);
        
        if(!empty($queryGroup))
            $this->MFirmReferncer->where('refGroupId', $queryGroup);
            
        if(!empty($querySubGroup))
            $this->MFirmReferncer->where('refSubGroupId', $querySubGroup);
        
        $referncerArr = $this->MFirmReferncer->findAll();

        $this->data['referncerArr']=$referncerArr;
        
        $docPath=$this->admUploadPath."/referncer";
        $this->data['docPath']=$docPath;
        
        $this->firmDocPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/referncer');
        
        $this->data['firmDocPath']=$this->firmDocPath;

        return view('firm_panel/referencer/list', $this->data);
	}
	
	public function admin()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Referencer";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $refGrpArr = $this->Mrefgroup->where('status', 1)
                    ->orderBy('refGrpName', "ASC")
                    ->orderBy('refGrpId', "ASC")
                    ->findAll();
                    
        $this->data['refGrpArr']=$refGrpArr;
        
        $refSubGrpArr = $this->Mrefsubgroup->where('status', 1)
                    ->orderBy('refSubGrpName', "ASC")
                    ->orderBy('refSubGrpId', "ASC")
                    ->findAll();

        $this->data['refSubGrpArr']=$refSubGrpArr;
        
        $queryGroup=$this->request->getGet('group');
        $querySubGroup=$this->request->getGet('sub_group');
        
        $this->data['queryGroup']=$queryGroup;
        $this->data['querySubGroup']=$querySubGroup;
        
        $this->Mreferncer->where('status', 1);
        
        if(!empty($queryGroup))
            $this->Mreferncer->where('refGroupId', $queryGroup);
            
        if(!empty($querySubGroup))
            $this->Mreferncer->where('refSubGroupId', $querySubGroup);
        
        $referncerArr = $this->Mreferncer->findAll();

        $this->data['referncerArr']=$referncerArr;
        
        $docPath=$this->admUploadPath."/referncer";
        $this->data['docPath']=$docPath;
        
        $this->firmDocPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/referncer');
        
        $this->data['firmDocPath']=$this->firmDocPath;

        return view('firm_panel/referencer/adminList', $this->data);
	}
	
	public function add()
	{
	    $ref_group_id=$this->request->getPost('ref_group_id');
	    $ref_sub_group_id=$this->request->getPost('ref_sub_group_id');
	    $referncerHeading=$this->request->getPost('referncerHeading');
	    $referncerYear=$this->request->getPost('referncerYear');
	    $referncerAuthor=$this->request->getPost('referncerAuthor');
	    $refImg = $this->request->getFile('referncerFile');
	    
        $referncerFile="";
        if(!empty($refImg->getTempName()))
        {
            if($refImg->isValid() && ! $refImg->hasMoved())
            {
                $ext=$refImg->guessExtension();
                $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                if(!is_dir($uploadPath))
                    mkdir($uploadPath, 0777, TRUE);

                $uploadPath1=$uploadPath.'/referncer';

                if(!is_dir($uploadPath1))
                    mkdir($uploadPath1, 0777, TRUE);

                $newName = $refImg->getRandomName();
                $refImg->move($uploadPath1, $newName);

                $referncerFile=$newName;
            }
        }
	    
	    $insertArr=[
	        'refGroupId'=>$ref_group_id,
            'refSubGroupId'=>$ref_sub_group_id,
            'referncerHeading'=>$referncerHeading,
            'referncerYear'=>$referncerYear,
            'referncerAuthor'=>$referncerAuthor,
            'referncerFile'=>$referncerFile,
            'referncerUploadDate'=>date('Y-m-d'),
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->MFirmReferncer->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Referencer has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Referencer has not added :(");
	    }
	    
	    return redirect()->route('referncer');
	}
	
	public function updateData()
	{
	    $this->db->transBegin();
	    
	    $referncerId=$this->request->getPost('referncerId');
	    $ref_group_id=$this->request->getPost('ref_group_id');
	    $ref_sub_group_id=$this->request->getPost('ref_sub_group_id');
	    $referncerHeading=$this->request->getPost('referncerHeading');
	    $referncerYear=$this->request->getPost('referncerYear');
	    $referncerAuthor=$this->request->getPost('referncerAuthor');
	    $refImg = $this->request->getFile('referncerFile');
	    $referncerOldFile=$this->request->getPost('referncerOldFile');
	    
        $referncerFile="";
        if(!empty($refImg->getTempName()))
        {
            if($refImg->isValid() && ! $refImg->hasMoved())
            {
                $ext=$refImg->guessExtension();
                $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                if(!is_dir($uploadPath))
                    mkdir($uploadPath, 0777, TRUE);

                $uploadPath1=$uploadPath.'/referncer';

                if(!is_dir($uploadPath1))
                    mkdir($uploadPath1, 0777, TRUE);

                $newName = $refImg->getRandomName();
                $refImg->move($uploadPath1, $newName);

                $referncerFile=$newName;
            }
        }
        else
        {
            $referncerFile=$referncerOldFile;
        }
	    
	    $insertArr=[
            'referncerId'=>$referncerId,
            'refGroupId'=>$ref_group_id,
            'refSubGroupId'=>$ref_sub_group_id,
            'referncerHeading'=>$referncerHeading,
            'referncerYear'=>$referncerYear,
            'referncerAuthor'=>$referncerAuthor,
            'referncerFile'=>$referncerFile,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->MFirmReferncer->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Referencer has not updated :(");
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
            
	        $this->session->setFlashdata('successMsg', "Referencer has been updated successfully :)");
	    }
	    
	    return redirect()->route('referncer');
	}
	
	public function deleteData()
	{
	    $referncerId=$this->request->getPost('referncerId');
	    
	    $insertArr=[
            'referncerId'=>$referncerId,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->MFirmReferncer->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Referencer has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Referencer has not deleted :(");
	    }
	}
	
	public function refGroups()
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
        
        $refGrpArr = $this->Mfirmrefgroup->where('status', 1)
                    ->orderBy('refGrpName', "ASC")
                    ->orderBy('refGrpId', "ASC")
                    ->findAll();

        $this->data['refGrpArr']=$refGrpArr;

        return view('firm_panel/referencer/refGroups', $this->data);
	}
	
	public function addGroup()
	{
	    $group_name=$this->request->getPost('group_name');
	    
	    $insertArr=[
            'refGrpName'=>$group_name,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mfirmrefgroup->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Group Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Group has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Group has not added :(");
	    }
	    
	    return redirect()->route('refGroups');
	}
	
	public function editGroup()
	{
	    $this->db->transBegin();
	    
	    $group_id=$this->request->getPost('group_id');
	    $group_name=$this->request->getPost('group_name');
	    
	    $insertArr=[
            'refGrpId'=>$group_id,
            'refGrpName'=>$group_name,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Mfirmrefgroup->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Group has not updated :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Group Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Group has been updated successfully :)");
	    }
	    
	    return redirect()->route('refGroups');
	}
	
	public function deleteGroup()
	{
	    $group_id=$this->request->getPost('group_id');
	    
	    $insertArr=[
            'refGrpId'=>$group_id,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mfirmrefgroup->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Group Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Group has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Group has not deleted :(");
	    }
	}
	
	public function refSubGroups()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Sub-Group Master";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $refGrpArr = $this->Mfirmrefgroup->where('status', 1)
                    ->orderBy('refGrpName', "ASC")
                    ->findAll();

        $this->data['refGrpArr']=$refGrpArr;
        
        $refSubGrpArr = $this->Mfirmrefsubgroup->join('referencer_groups', 'referencer_groups.refGrpId=referencer_sub_groups.fkRefGrpId', 'left')
                    ->where('referencer_sub_groups.status', 1)
                    ->orderBy('referencer_sub_groups.refSubGrpName', "ASC")
                    ->orderBy('referencer_sub_groups.refSubGrpId', "ASC")
                    ->findAll();

        $this->data['refSubGrpArr']=$refSubGrpArr;

        return view('firm_panel/referencer/refSubGroups', $this->data);
	}
	
	public function addSubGroup()
	{
	    $sub_group_name=$this->request->getPost('sub_group_name');
	    $fk_group_id=$this->request->getPost('fk_group_id');
	    
	    $insertArr=[
            'refSubGrpName'=>$sub_group_name,
            'fkRefGrpId'=>$fk_group_id,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mfirmrefsubgroup->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Sub Group Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Sub Group has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Sub Group has not added :(");
	    }
	    
	    return redirect()->route('refSubGroups');
	}
	
	public function editSubGroup()
	{
	    $this->db->transBegin();
	    
	    $sub_group_id=$this->request->getPost('sub_group_id');
	    $sub_group_name=$this->request->getPost('sub_group_name');
	    $fk_group_id=$this->request->getPost('fk_group_id');
	    
	    $insertArr=[
            'refSubGrpId'=>$sub_group_id,
            'refSubGrpName'=>$sub_group_name,
            'fkRefGrpId'=>$fk_group_id,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Mfirmrefsubgroup->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Sub Group has not updated :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Sub Group Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Sub Group has been updated successfully :)");
	    }
	    
	    return redirect()->route('refSubGroups');
	}
	
	public function deleteSubGroup()
	{
	    $sub_group_id=$this->request->getPost('sub_group_id');
	    
	    $insertArr=[
            'refSubGrpId'=>$sub_group_id,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mfirmrefsubgroup->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Sub Group Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Sub Group has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Sub Group has not deleted :(");
	    }
	}
}
?>