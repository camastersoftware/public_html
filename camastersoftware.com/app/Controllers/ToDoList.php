<?php
namespace App\Controllers;

class ToDoList extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="To Do List";
        
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->Mtdlist = new \App\Models\Mtdlist();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->session = \Config\Services::session();

        $tableArr=$this->TableLib->get_tables();

        $this->to_do_list_tbl=$tableArr['to_do_list_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];

        $this->sessCaFirmId=$this->session->get('caFirmId');

        $documentsPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/documents');

        $this->data['documentsPath']=$documentsPath;
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }

	public function index()
	{
	    setlocale(LC_MONETARY, 'en_IN');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="To Do List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $toMeUserId=$this->request->getGet('toMeUserId');
        $byMeUserId=$this->request->getGet('byMeUserId');
        
        $this->data['toMeUserId']=$toMeUserId;
        $this->data['byMeUserId']=$byMeUserId;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        if(!empty($toMeUserId))
            $toMeWhereArr['to_do_list_tbl.tdAllotedBy']=$toMeUserId;
            
        $toMeWhereArr['to_do_list_tbl.status']=1;
        $toMeWhereArr['to_do_list_tbl.tdAllotedTo']=$this->adminId;
        
        $listToMeArr = $this->Mtdlist->join('user_tbl', 'user_tbl.userId=to_do_list_tbl.tdAllotedBy', 'left')
                    ->where($toMeWhereArr)
                    ->orderBy('to_do_list_tbl.tdPriority', "DESC")
                    ->orderBy('to_do_list_tbl.tdTargetDate', "ASC")
                    ->orderBy('to_do_list_tbl.tdId', "ASC")
                    ->findAll();

        $this->data['listToMeArr']=$listToMeArr;
        
        if(!empty($byMeUserId))
            $byMeWhereArr['to_do_list_tbl.tdAllotedTo']=$byMeUserId;
            
        $byMeWhereArr['to_do_list_tbl.status']=1;
        $byMeWhereArr['to_do_list_tbl.tdAllotedBy']=$this->adminId;
        
        $listByMeArr = $this->Mtdlist->join('user_tbl', 'user_tbl.userId=to_do_list_tbl.tdAllotedTo', 'left')
                    ->where($byMeWhereArr)
                    ->orderBy('to_do_list_tbl.tdPriority', "DESC")
                    ->orderBy('to_do_list_tbl.tdTargetDate', "ASC")
                    ->orderBy('to_do_list_tbl.tdId', "ASC")
                    ->findAll();

        $this->data['listByMeArr']=$listByMeArr;
        
        $getByMe=$this->request->getGet('byMe');
        
        $this->data['getByMe']=$getByMe;
        
        return view('firm_panel/todolist/list', $this->data);
	}
	
	public function assignByMeList()
	{
	    setlocale(LC_MONETARY, 'en_IN');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="To Do List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $toMeUserId=$this->request->getGet('toMeUserId');
        $byMeUserId=$this->request->getGet('byMeUserId');
        
        $this->data['toMeUserId']=$toMeUserId;
        $this->data['byMeUserId']=$byMeUserId;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        if(!empty($toMeUserId))
            $toMeWhereArr['to_do_list_tbl.tdAllotedBy']=$toMeUserId;
            
        $toMeWhereArr['to_do_list_tbl.status']=1;
        $toMeWhereArr['to_do_list_tbl.tdAllotedTo']=$this->adminId;
        
        $listToMeArr = $this->Mtdlist->join('user_tbl', 'user_tbl.userId=to_do_list_tbl.tdAllotedBy', 'left')
                    ->where($toMeWhereArr)
                    ->orderBy('to_do_list_tbl.tdPriority', "DESC")
                    ->orderBy('to_do_list_tbl.tdTargetDate', "ASC")
                    ->orderBy('to_do_list_tbl.tdId', "ASC")
                    ->findAll();

        $this->data['listToMeArr']=$listToMeArr;
        
        if(!empty($byMeUserId))
            $byMeWhereArr['to_do_list_tbl.tdAllotedTo']=$byMeUserId;
            
        $byMeWhereArr['to_do_list_tbl.status']=1;
        $byMeWhereArr['to_do_list_tbl.tdAllotedBy']=$this->adminId;
        
        $listByMeArr = $this->Mtdlist->join('user_tbl', 'user_tbl.userId=to_do_list_tbl.tdAllotedTo', 'left')
                    ->where($byMeWhereArr)
                    ->orderBy('to_do_list_tbl.tdPriority', "DESC")
                    ->orderBy('to_do_list_tbl.tdTargetDate', "ASC")
                    ->orderBy('to_do_list_tbl.tdId', "ASC")
                    ->findAll();

        $this->data['listByMeArr']=$listByMeArr;
        
        $getByMe=$this->request->getGet('byMe');
        
        $this->data['getByMe']=$getByMe;
        
        return view('firm_panel/todolist/assignByMeList', $this->data);
	}

	public function add()
	{
	    $this->db->transBegin();
	    
	    $tdDate=date('Y-m-d');
	    $tdTargetDate=$this->request->getPost('tdTargetDate');
	    $tdNatureOfWork=$this->request->getPost('tdNatureOfWork');
	    $tdRemark=$this->request->getPost('tdRemark');
	    $tdAllotedTo = $this->request->getPost('tdAllotedTo');
	    $tdPriority = $this->request->getPost('tdPriority');
	    $tdPriorityColor = $this->request->getPost('tdPriorityColor');
	    $tdRedirectTo = $this->request->getPost('tdRedirectTo');
	    
	    $insertArr=[
            'tdDate'=>$tdDate,
            'tdTargetDate'=>$tdTargetDate,
            'tdNatureOfWork'=>$tdNatureOfWork,
            'tdRemark'=>$tdRemark,
            'tdAllotedTo'=>$tdAllotedTo,
            'tdPriority'=>$tdPriority,
            'tdPriorityColor'=>$tdPriorityColor,
            'tdAllotedBy'=>$this->adminId,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
        
        $this->Mtdlist->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "New record has not added :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Record Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "New record has been added successfully :)");
	    }
	    
	    if($tdRedirectTo!="assignByMe")
	        return redirect()->route('todolist');
	    else
	        return redirect()->route('assignByMeList');
	}
	
	public function updateTDListByeMe()
	{
	    $this->db->transBegin();
	    
	    $tdId=$this->request->getPost('tdId');
	   // $tdDate=$this->request->getPost('tdDate');
	    $tdTargetDate=$this->request->getPost('tdTargetDate');
	    $tdNatureOfWork=$this->request->getPost('tdNatureOfWork');
	    $tdRemark=$this->request->getPost('tdRemark');
	    $tdAllotedTo = $this->request->getPost('tdAllotedTo');
	    $tdPriority = $this->request->getPost('tdPriority');
	    $tdPriorityColor = $this->request->getPost('tdPriorityColor');
	    
	    $insertArr=[
            'tdId'=>$tdId,
            'tdTargetDate'=>$tdTargetDate,
            'tdNatureOfWork'=>$tdNatureOfWork,
            'tdRemark'=>$tdRemark,
            'tdAllotedTo'=>$tdAllotedTo,
            'tdPriority'=>$tdPriority,
            'tdPriorityColor'=>$tdPriorityColor,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Mtdlist->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Record has not updated :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Record Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Record has been updated successfully :)");
	    }
	    
	   // return redirect()->route('admin/todolist/?byMe=1');
	    return redirect()->to(base_url('assignByMeList'));
	}
	
	public function updateTDListToMe()
	{
	    $this->db->transBegin();
	    
	    $tdId=$this->request->getPost('tdId');
	    $tdComments=$this->request->getPost('tdComments');
	    $tdStatus=$this->request->getPost('tdStatus');
	    
	    $insertArr=[
            'tdId'=>$tdId,
            'tdComments'=>$tdComments,
            'tdStatus'=>$tdStatus,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Mtdlist->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Record has not updated :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Record Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Record has been updated successfully :)");
	    }
	    
	    return redirect()->route('todolist');
	}
	
	public function deleteData()
	{
	    $tdId=$this->request->getPost('tdId');
	    
	    $insertArr=[
            'tdId'=>$tdId,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mtdlist->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Record Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Record has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Record has not deleted :(");
	    }
	}
}