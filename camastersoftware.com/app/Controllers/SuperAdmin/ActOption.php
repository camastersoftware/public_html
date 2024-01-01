<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class ActOption extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Act Option";

        $this->data['pageSection']=$this->section;
        
        $this->Mact = new \App\Models\Mact();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->MDueDateType = new \App\Models\MDueDateType();
        $this->MdueDateForGroup = new \App\Models\MdueDateForGroup();
        $this->MdueDateForGroupMap = new \App\Models\MdueDateForGroupMap();
    }

	public function options($actId, $optionId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Act Options List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        $this->data['actId']=$actId;
        $this->data['optionId']=$optionId;

        $actArr = $this->Mact->where('act_id', $actId)
                    ->where('status', 1)
                    ->get()
                    ->getRowArray();

        $this->data['actArr']=$actArr;
        
        if($optionId==1)
        {
            $dueDateTypeArr = $this->MDueDateType->where('status', 1)->findAll();

            $this->data['dueDateTypeArr']=$dueDateTypeArr;
        
            $resultArr = $this->Mact_option->where('act_option_map_tbl.status', 1)
                        ->join('due_date_type_tbl', 'due_date_type_tbl.dueDateTypeId=act_option_map_tbl.due_date_type AND due_date_type_tbl.status=1', 'left')
                        ->where('act_option_map_tbl.fk_act_id', $actId)
                        ->where('act_option_map_tbl.option_type', $optionId)
                        ->orderBy('act_option_map_tbl.sortBy', "ASC")
                        ->findAll();
    
            $this->data['resultArr']=$resultArr;
    
            return view('super_admin/masters/act_options_due_date_for', $this->data);
        }
        else
        {
            $resultArr = $this->Mact_option->where('status', 1)
                        ->where('fk_act_id', $actId)
                        ->where('option_type', $optionId)
                        ->orderBy('act_option_name', "ASC")
                        ->findAll();
    
            $this->data['resultArr']=$resultArr;
    
            return view('super_admin/masters/act_options', $this->data);
        }
	}
	
	public function add()
	{
	    $act_option_name=$this->request->getPost('act_option_name');
	    $shortName=$this->request->getPost('shortName');
	    $sortBy=$this->request->getPost('sortBy');
	    $due_date_type=$this->request->getPost('due_date_type');
	    $actId=$this->request->getPost('actId');
	    $optionId=$this->request->getPost('optionId');
	    
	    $dataArray = [
            'act_option_name' => $act_option_name,
            'shortName' => $shortName,
            'sortBy' => $sortBy,
            'due_date_type' => $due_date_type,
            'fk_act_id' => $actId,
            'option_type' => $optionId,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mact_option->save($dataArray)){
            
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
        
        return redirect()->to(base_url('superadmin/act_options-'.$actId.'-'.$optionId));
	}
	
	public function edit()
	{
	    $act_option_map_id=$this->request->getPost('act_option_map_id');
	    $act_option_name=$this->request->getPost('act_option_name');
	    $sortBy=$this->request->getPost('sortBy');
	    $shortName=$this->request->getPost('shortName');
	    $due_date_type=$this->request->getPost('due_date_type');
        $actId=$this->request->getPost('actId');
	    $optionId=$this->request->getPost('optionId');
	    
	    $dataArray = [
            'act_option_map_id' => $act_option_map_id,
            'act_option_name' => $act_option_name,
            'shortName' => $shortName,
            'sortBy' => $sortBy,
            'due_date_type' => $due_date_type,
            'fk_act_id' => $actId,
            'option_type' => $optionId,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mact_option->save($dataArray)){
            
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
        
        return redirect()->to(base_url('superadmin/act_options-'.$actId.'-'.$optionId));
	}
	
	public function delete()
	{
        $act_option_map_id=$this->request->getPost('act_option_map_id');

	    $dataArray = [
            'act_option_map_id' => $act_option_map_id,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mact_option->save($dataArray)){
            
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
	
	public function due_date_for_group($actId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Due Date For Group List";
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
        
        $ddfArr = $this->Mact_option->where('status', 1)
                    ->where('fk_act_id', $actId)
                    ->where('option_type', 1)
                    ->orderBy('act_option_name', "ASC")
                    ->findAll();

        $this->data['ddfArr']=$ddfArr;
    
        $resultArr = $this->MdueDateForGroup->select('due_date_for_group_tbl.due_date_for_group_id, due_date_for_group_tbl.due_date_for_group_name, GROUP_CONCAT(act_option_map_tbl.act_option_map_id separator ", ") as ddfIds')
                    ->join('due_date_for_group_map_tbl', 'due_date_for_group_tbl.due_date_for_group_id=due_date_for_group_map_tbl.fk_due_date_for_group_id AND due_date_for_group_map_tbl.fk_act_id="'.$actId.'" AND due_date_for_group_map_tbl.status=1', 'left')
                    ->join('act_option_map_tbl', 'due_date_for_group_map_tbl.fk_ddf_id=act_option_map_tbl.act_option_map_id AND act_option_map_tbl.option_type=1 AND act_option_map_tbl.fk_act_id="'.$actId.'" AND act_option_map_tbl.status=1', 'left')
                    ->where('due_date_for_group_tbl.fk_act_id', $actId)
                    ->where('due_date_for_group_tbl.status', 1)
                    ->groupBy('due_date_for_group_map_tbl.fk_due_date_for_group_id')
                    ->orderBy('due_date_for_group_tbl.due_date_for_group_name', 'ASC')
                    ->findAll();

        $this->data['resultArr']=$resultArr;

        return view('super_admin/masters/due_date_for_group', $this->data);
	}
	
	public function add_due_date_for_group()
	{
	    $this->db->transBegin();
	    
	    $due_date_for_group_name=$this->request->getPost('due_date_for_group_name');
	    $fk_ddf_id=$this->request->getPost('fk_ddf_id');
	    $actId=$this->request->getPost('actId');
	    
	    $dataArray = [
            'due_date_for_group_name'   => $due_date_for_group_name,
            'fk_act_id'                 => $actId,
            'status'                    => 1,
            'createdBy'                 => $this->adminId,
            'createdDatetime'           => $this->currTimeStamp
        ];
	    
	    $this->MdueDateForGroup->save($dataArray);
	    
	    $due_date_for_group_id=$this->MdueDateForGroup->insertID();
	    
	    if(!empty($fk_ddf_id))
	    {
	        foreach($fk_ddf_id AS $k_row => $e_row)
            {
                $ddfGrpMapInsertArr=[
                    'fk_due_date_for_group_id'  =>  $due_date_for_group_id,
                    'fk_ddf_id'                 =>  $e_row,
                    'fk_act_id'                 =>  $actId,
                    'status'                    =>  1,
                    'createdBy'                 =>  $this->adminId,
                    'createdDatetime'           =>  $this->currTimeStamp
                ];
                
                $this->MdueDateForGroupMap->save($ddfGrpMapInsertArr);
            }
	    }
	    
        if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Due Date For Group has not created :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Due Date For Group Created";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "New Due Date For Group has been created successfully :)");
	    }
        
        return redirect()->to(base_url('superadmin/due_date_for_group-'.$actId));
	}
	
	public function edit_due_date_for_group()
	{
	    $this->db->transBegin();
	    
	    $due_date_for_group_id=$this->request->getPost('due_date_for_group_id');
	    $due_date_for_group_name=$this->request->getPost('due_date_for_group_name');
	    $fk_ddf_id=$this->request->getPost('fk_ddf_id');
	    $actId=$this->request->getPost('actId');
	    
	    $dataArray = [
            'due_date_for_group_id'     => $due_date_for_group_id,
            'due_date_for_group_name'   => $due_date_for_group_name,
            'updatedBy'                 => $this->adminId,
            'updatedDatetime'           => $this->currTimeStamp
        ];
	    
	    $this->MdueDateForGroup->save($dataArray);
	    
	    if(!empty($fk_ddf_id))
	    {
	        $ddfGrpUpdateCondtn = array( 
                'fk_due_date_for_group_id'  =>  $due_date_for_group_id,
                'status'                    =>  1
            );
        
            $updateDDFGrpMapArr=array(
                'status'            => 2, 
                'updatedBy'         => $this->adminId,
                'updatedDatetime'   => $this->currTimeStamp
            );
                
            $this->MdueDateForGroupMap->set($updateDDFGrpMapArr)->where($ddfGrpUpdateCondtn)->update();
        
	        foreach($fk_ddf_id AS $k_row => $e_row)
            {
                $ddfGrpMapInsertArr=[
                    'fk_due_date_for_group_id'  =>  $due_date_for_group_id,
                    'fk_ddf_id'                 =>  $e_row,
                    'fk_act_id'                 =>  $actId,
                    'status'                    =>  1,
                    'createdBy'                 =>  $this->adminId,
                    'createdDatetime'           =>  $this->currTimeStamp
                ];
                
                $this->MdueDateForGroupMap->save($ddfGrpMapInsertArr);
            }
	    }
	    
        if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Due Date For Group has not updated :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Due Date For Group Updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Due Date For Group has been updated successfully :)");
	    }
        
        return redirect()->to(base_url('superadmin/due_date_for_group-'.$actId));
	}
	
	public function delete_due_date_for_group()
	{
	    $this->db->transBegin();
	    
	    $due_date_for_group_id=$this->request->getPost('due_date_for_group_id');
	    
	    $dataArray = [
            'due_date_for_group_id'     => $due_date_for_group_id,
            'status'                    => 2, 
            'updatedBy'                 => $this->adminId,
            'updatedDatetime'           => $this->currTimeStamp
        ];
	    
	    $this->MdueDateForGroup->save($dataArray);
    
        $ddfGrpUpdateCondtn = array( 
            'fk_due_date_for_group_id'  =>  $due_date_for_group_id,
            'status'                    =>  1
        );
    
        $updateDDFGrpMapArr=array(
            'status'            => 2, 
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        );
            
        $this->MdueDateForGroupMap->set($updateDDFGrpMapArr)->where($ddfGrpUpdateCondtn)->update();
	    
        if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Due Date For Group has not deleted :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Due Date For Group Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Due Date For Group has been deleted successfully :)");
	    }
	}
}
