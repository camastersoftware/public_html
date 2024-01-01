<?php namespace App\Controllers\Remote;
use \App\Controllers\BaseController;

class Staff extends BaseController
{
    public function __construct()
    {
        $this->Mquery = new \App\Models\Mquery();
        $this->Muser = new \App\Models\Muser();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->user_tbl=$tableArr['user_tbl'];
    }

    public function mark_old_user()
    {
        $userId=$this->request->getPost('userId');
        $userLeftReason=$this->request->getPost('userLeftReason');

	    $dataArray = [
            'userId' => $userId,
            'userLeftReason' => $userLeftReason,
            'isOldUser' => 1,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Muser->save($dataArray)){
            
            $insertLogArr['section']="User";
            $insertLogArr['message']="User Mark Old";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="User has been mark as left successfully :)";
            $responseArr['userdata']=array();
        }else{
            $responseArr['status']=FALSE;
            $responseArr['message']="User has not mark left :(";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }
    
    public function restore_user()
    {
        $userId=$this->request->getPost('userId');

	    $dataArray = [
            'userId' => $userId,
            'userLeftReason' => "",
            'isOldUser' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Muser->save($dataArray)){
            
            $insertLogArr['section']="User";
            $insertLogArr['message']="User Restored";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="User has been restore successfully :)";
            $responseArr['userdata']=array();
        }else{
            $responseArr['status']=FALSE;
            $responseArr['message']="User has not restored :(";
            $responseArr['userdata']=array();
        }

        echo json_encode($responseArr);
    }
}
?>