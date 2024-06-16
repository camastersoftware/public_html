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
        $this->MreminderUser = new \App\Models\MreminderUser();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->reminder_tbl=$tableArr['reminder_tbl'];
        $this->reminder_user_map_tbl=$tableArr['reminder_user_map_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        
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

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Reminder";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $reminderQuery = $this->Mreminder->join($this->reminder_user_map_tbl, 'reminder_user_map_tbl.fkReminderId = '.$this->reminder_tbl.'.reminderId', 'left');
                    
        // $reminderQuery->where('status', 1)
        //             ->where('reminderAddedBy', $this->adminId)
        //             ->orderBy('reminderDate', "DESC")
        //             ->orderBy('reminderFrom', "DESC");

        $reminderQuery->where('reminder_tbl.status', 1);
        
        $reminderQuery->groupStart();
            $reminderQuery->where('reminder_tbl.isGroupReminder', 2);
            $reminderQuery->where('reminder_tbl.reminderAddedBy', $this->adminId);
            $reminderQuery->orGroupStart();
                $reminderQuery->where('reminder_tbl.isGroupReminder', 1);
                $reminderQuery->where('reminder_user_map_tbl.fkUserId', $this->adminId);
            $reminderQuery->groupEnd();
        $reminderQuery->groupEnd();

        $reminderQuery->orderBy('reminderDate', "DESC")->orderBy('reminderFrom', "DESC");

        $reminderArr = $reminderQuery->findAll();

        $this->data['reminderArr']=$reminderArr;

        $remindUsrCondtn = array(
            "status"        => 1
        );

        $reminderUserArr = $this->MreminderUser->where($remindUsrCondtn)
                                        ->findAll();
        
        $reminderUsers = array();
        if(!empty($reminderUserArr))
        {
            foreach($reminderUserArr AS $e_rmd_usr)
            {
                $reminderUsers[$e_rmd_usr["fkReminderId"]][$e_rmd_usr["fkUserId"]]=$e_rmd_usr["fkUserId"];
            }
        }

        $this->data['reminderUsers']=$reminderUsers;

        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userFullName']="ASC";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userFullName, user_tbl.userShortName", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        return view('firm_panel/reminder/list', $this->data);
	}
	
	public function add()
	{
        $this->db->transBegin();

	    $reminderDate=$this->request->getPost('reminderDate');
	    $reminderFor=$this->request->getPost('reminderFor');
	    $reminderColor=$this->request->getPost('reminderColor');
	    $reminderFrom = $this->request->getPost('reminderFrom');
	    $reminderTo = $this->request->getPost('reminderTo');
	    $reminderToUsers = $this->request->getPost('reminderToUsers');

        $isGroupReminder = (!empty($reminderToUsers)) ? 1:2;
	    
	    $insertArr=[
            'reminderDate'=>$reminderDate,
            'reminderFor'=>$reminderFor,
            'reminderColor'=>$reminderColor,
            'reminderFrom'=>$reminderFrom,
            'reminderTo'=>$reminderTo,
            'reminderAddedBy'=>$this->adminId,
            'isGroupReminder'=>$isGroupReminder,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        $this->Mreminder->save($insertArr);

        if(!empty($reminderToUsers))
        {
            array_push($reminderToUsers, $this->adminId);

            $reminderId=$this->Mreminder->getInsertID();

            foreach($reminderToUsers AS $e_usr)
            {
                $remindUserInsertArr=[
                    'fkReminderId'=>$reminderId,
                    'fkUserId'=>$e_usr,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];

                $this->MreminderUser->save($remindUserInsertArr);
            }
        }
	    
	    if($this->db->transStatus() === FALSE)
	    {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', $this->section." has not added :(");
	    }
	    else
	    {
            $this->db->transCommit();

	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', $this->section." has been added successfully :)");
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
        $reminderToUsers = $this->request->getPost('reminderToUsers');

        $isGroupReminder = (!empty($reminderToUsers)) ? 1:2;
        
        $insertArr=[
            'reminderId'=>$reminderId,
            'reminderDate'=>$reminderDate,
            'reminderFor'=>$reminderFor,
            'reminderColor'=>$reminderColor,
            'reminderFrom'=>$reminderFrom,
            'reminderTo'=>$reminderTo,
            'isGroupReminder'=>$isGroupReminder,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
        
        $this->Mreminder->save($insertArr);

        $remindUsrCondtn = array(
            "fkReminderId"  => $reminderId,
            "status"        => 1
        );

        $reminderUserArr = $this->MreminderUser->where($remindUsrCondtn)
                                        ->findAll();

        $oldUserIDArr = array();
        $removedUserIDArr = array();

        if(!empty($reminderUserArr))
        {
            $oldUserIDArr = array_column($reminderUserArr, 'fkUserId');

            $removedUserIDArr = array_diff($oldUserIDArr, $reminderToUsers);
        }

        if(!empty($removedUserIDArr))
        {
            foreach($removedUserIDArr AS $e_rmvd_usr)
            {
                $rmvdUserUpdateCondtn = array(
                    'fkReminderId'  =>  $reminderId,
                    'fkUserId'      =>  $e_rmvd_usr,
                    'status'        =>  1
                );
            
                $updateRmvdUserArr=array(
                    'status' => 2, 
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                );

                $query = $this->MreminderUser->where($rmvdUserUpdateCondtn)
                                        ->set($updateRmvdUserArr)
                                        ->update();
            }
        }

        if(!empty($reminderToUsers))
        {
            foreach($reminderToUsers AS $e_usr)
            {
                if(!in_array($e_usr, $oldUserIDArr))
                {
                    $remindUserInsertArr=[
                        'fkReminderId'=>$reminderId,
                        'fkUserId'=>$e_usr,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    ];

                    $this->MreminderUser->save($remindUserInsertArr);
                }
            }
        }
	    
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