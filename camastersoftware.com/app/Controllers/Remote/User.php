<?php namespace App\Controllers\Remote;
use \App\Controllers\BaseController;

class User extends BaseController
{
    public function __construct()
    {
        $this->Mcommon = new \App\Models\Mcommon();
    }

    public function get_address()
    {
        $userId=$this->request->getPost('userId');

        $userCondtnArr['user_address_tbl.fkUserId']=$userId;
        $userCondtnArr['user_address_tbl.status']=1;

        $query=$this->Mcommon->getRecords($tableName="user_address_tbl", $colNames="userAddressId, longitude, latitude, fkCityId, addressLine1, addressLine2, pincode, landmark", $userCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());

        $addressArr=$query['userData'];

        $this->data['addressArr']=$addressArr;

        return view('remote/get_address', $this->data);
    }

    public function del_user()
    {
        $userId=$this->request->getPost('userId');
        $this->adminId=$this->session->get('adminId');

        $userCondtnArr['login_tbl.userId']=$userId;

        $userUpdateArr=array(
            'status' => 2,
            "updatedDatetime" => date('Y-m-d H:i:s'),
            "updatedBy" => $this->adminId
        );

        $query=$this->Mcommon->updateData($tableName="login_tbl", $userUpdateArr, $userCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        $userStatus=$query['status'];

        if($userStatus==TRUE){

            $insertLogArr['section']="User";
            $insertLogArr['message']="User Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "User has been deleted successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "User has not deleted :(");
        }

        echo json_encode($userStatus);
    }
}

?>
