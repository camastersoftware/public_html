<?php namespace App\Controllers\Accounts;
use \App\Controllers\BaseController;

class Staff extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Staff Cost Rate";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->MStaffCost = new \App\Models\MStaffCost();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->user_tbl=$tableArr['user_tbl'];
        $this->staff_types=$tableArr['staff_types'];
        $this->staff_cost_tbl=$tableArr['staff_cost_tbl'];
        
        $currMth=date('n');
        $this->currentMth=date('n');
        $this->currentYear=date('Y');
        
        $this->data['currMth']=$currMth;
    }

	public function getStaffRate()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Cost : Rate";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']="2";
        $userOrderByArr['staff_types.seqNo']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        $userOrderByArr['user_tbl.userId']="ASC";

        $userJoinArr[]=array("tbl"=>$this->staff_types, "condtn"=>"staff_types.staff_type_id=user_tbl.userStaffType", "type"=>"left");
        $userJoinArr[]=array("tbl"=>$this->staff_cost_tbl, "condtn"=>"staff_cost_tbl.fkUserId=user_tbl.userId AND staff_cost_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userFullName, user_tbl.userDesgn, staff_cost_tbl.staffCostPerHour", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr, $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userDataArr=$query['userData'];

        $this->data['userDataArr']=$userDataArr;
        
	    return view('firm_panel/accounts/staff/getStaffRate', $this->data);
	}

    public function updateStaffRate()
	{
	    $this->db->transBegin();
	    
	    $userId=$this->request->getPost('userId');
	    $staffCostPerHour=$this->request->getPost('staffCostPerHour');

        $rateUpdateCondtn = array(
            'fkUserId'      =>  $userId,
            'status'        =>  1
        );
    
        $updateRateArr=array(
            'status' => 2, 
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        );

        $this->MStaffCost->where($rateUpdateCondtn)
                                ->set($updateRateArr)
                                ->update();
	    
	    $insertArr=[
            'fkUserId'=>$userId,
            'staffCostPerHour'=>$staffCostPerHour,
            'changedDate'=>$this->currTimeStamp,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    $this->MStaffCost->save($insertArr);
	    
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
	    
	    return redirect()->route('get-staff-rate');
	}
}