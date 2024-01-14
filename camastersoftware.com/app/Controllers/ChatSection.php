<?php

namespace App\Controllers;

class ChatSection extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath'] = "template/includes/css";
        $this->data['navPath'] = "template/includes/nav";
        $this->data['footerPath'] = "template/includes/footer";
        $this->data['scriptPath'] = "template/includes/scripts";
        $this->data['layoutPath'] = "template/layouts/main_layout";

        $this->section = "Chats";

        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->Mcashbook = new \App\Models\Mcashbook();
        $this->Muser = new \App\Models\Muser();
        $this->MUserChatConnection = new \App\Models\MUserChatConnection();
        $this->MUserMessage = new \App\Models\MUserMessage();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->session = \Config\Services::session();

        $tableArr = $this->TableLib->get_tables();

        $this->user_tbl = $tableArr['user_tbl'];
        $this->user_chat_connection_tbl = $tableArr['user_chat_connection_tbl'];
        $this->user_message_tbl = $tableArr['user_message_tbl'];

        $currYear = date('Y');

        $this->dueYear = $currYear . "-" . (substr($currYear + 1, 2));

        $this->data['dueYear'] = $this->dueYear;

        $currMth = date('n');

        $this->data['currMth'] = $currMth;

        $getSeessionAll = session()->get();
        // print_r($getSeessionAll);die();
    }

    public function index($receiverId)
    {
        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Chat Section";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $this->data['receiverId'] = $receiverId;

        $getReceiverDetails = [];

        if (!empty($receiverId)) {
            $uReadMsgUpdateArr = array(
                "isRead" => 1,
                "updatedDatetime" => $this->currTimeStamp,
                "updatedBy" => $this->adminId
            );

            $uReadMsgCondtnArr['user_message_tbl.isRead'] = 0;
            $uReadMsgCondtnArr['user_message_tbl.fromUserId'] = $receiverId;
            $uReadMsgCondtnArr['user_message_tbl.toUserId'] = $this->sessUserId;

            $uReadMsgQuery = $this->Mcommon->updateData($tableName = $this->user_message_tbl, $uReadMsgUpdateArr, $uReadMsgCondtnArr, $likeCondtnArr = array(), $whereInArray = array());
            $userStatus = $uReadMsgQuery['status'];

            $receiverCondtnArr['user_tbl.status'] = "1";
            $receiverCondtnArr['user_tbl.isOldUser'] = 2;
            $receiverCondtnArr['user_tbl.userId'] = $receiverId;

            $receiverOrderByArr['user_tbl.userStaffType'] = "ASC";
            $receiverOrderByArr['user_tbl.userDesgn'] = "ASC";

            $queryReceiver = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan, user_tbl.userImg", $receiverCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = TRUE, $receiverOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $getReceiverDetails = $queryReceiver['userData'];
        }

        $this->data['getReceiverDetails'] = $getReceiverDetails;

        $userUnreadMsgArr = $this->MUserMessage->select('user_message_tbl.fromUserId, COUNT(user_message_tbl.fromUserId) as msgCount')
            ->where("user_message_tbl.status", '1')
            ->where("user_message_tbl.toUserId", $this->sessUserId)
            ->where("user_message_tbl.isRead",  '0')
            ->groupBy("user_message_tbl.fromUserId")
            ->findAll();
        // dd($userUnreadMsgArr);
        $userUnreadMsgCountArr = [];

        if (!empty($userUnreadMsgArr)) {
            foreach ($userUnreadMsgArr as $e_uCount) {
                $userUnreadMsgCountArr[$e_uCount['fromUserId']] = $e_uCount['msgCount'];
            }
        }


        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userCondtnArr['user_tbl.userId !='] = $this->sessUserId;

        $userOrderByArr['tbl1.createdDatetime'] = "DESC";
        $userOrderByArr['user_tbl.userId'] = "ASC";
        // $userOrderByArr['user_tbl.userDesgn']="ASC";

        $userGroupByArr = ['user_tbl.userId'];

        // $userJoinArr[]=array("tbl"=>$this->user_message_tbl, "condtn"=>"user_message_tbl.toUserId=user_tbl.userId", "type"=>"left");
        $userJoinArr[] = array("tbl" => '(SELECT a.fromUserId, a.userMessage, a.createdDatetime
            FROM ' . $this->user_message_tbl . ' a
            INNER JOIN (
                SELECT user_message_tbl.fromUserId, user_message_tbl.userMessage, MAX(user_message_tbl.createdDatetime) AS createdDatetime
                FROM ' . $this->user_message_tbl . '
                WHERE user_message_tbl.toUserId=' . $this->sessUserId . ' AND user_message_tbl.status=1 
                GROUP BY user_message_tbl.fromUserId
            ) b ON a.fromUserId = b.fromUserId AND a.createdDatetime = b.createdDatetime) AS tbl1', "condtn" => "tbl1.fromUserId=user_tbl.userId", "type" => "left");

        $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan, user_tbl.userImg, tbl1.userMessage", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr, $singleRow = FALSE, $userOrderByArr, $userGroupByArr, $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserList = $query['userData'];
        // echo $query['query'];die();

        $userListArr = [];

        if (!empty($getUserList)) {
            foreach ($getUserList as $k_user => $e_user) {
                $userId = $e_user['userId'];
                $userMsgCount = 0;
                if (isset($userUnreadMsgCountArr[$userId])) {
                    $userMsgCount = $userUnreadMsgCountArr[$userId];
                }
                $userListArr[$k_user] = $e_user;
                $userListArr[$k_user]['unReadMsgCount'] = $userMsgCount;
            }
        }
        // dd($userListArr);

        $this->data['userListArr'] = $userListArr;

        $userMsgConnCustomWhereArray[] = "(user_chat_connection_tbl.fkUser1=" . $this->sessUserId . " AND user_chat_connection_tbl.fkUser2=" . $receiverId . ") OR (user_chat_connection_tbl.fkUser1=" . $receiverId . " AND user_chat_connection_tbl.fkUser2=" . $this->sessUserId . ")";
        $userMsgConnCondtnArr['user_chat_connection_tbl.status'] = "1";

        $userMsgConnColumnNames = "user_chat_connection_tbl.userChatConnectionId, user_chat_connection_tbl.fkUser1, user_chat_connection_tbl.fkUser2";

        $userMsgConnQuery = $this->Mcommon->getRecords($tableName = $this->user_chat_connection_tbl, $colNames = $userMsgConnColumnNames, $userMsgConnCondtnArr, $likeCondtnArr = array(), $joinArr = array(), $singleRow = TRUE, $orderByArr = array(), $groupByArr = array(), $whereInArray = array(), $userMsgConnCustomWhereArray, $orWhereArray = array(), $orWhereDataArr = array());

        $getUserMsgConn = $userMsgConnQuery['userData'];

        $getAllUserMsg = [];

        if (!empty($getUserMsgConn)) {

            $userMsgCondtnArr['user_message_tbl.fkUserChatConnectionId'] = $getUserMsgConn['userChatConnectionId'];
            $userMsgCondtnArr['user_message_tbl.status'] = "1";

            $userMsgColumnNames = "user_message_tbl.userMessage, user_message_tbl.fromUserId, user_message_tbl.toUserId, user_message_tbl.createdDatetime";

            $userMsgQuery = $this->Mcommon->getRecords($tableName = $this->user_message_tbl, $colNames = $userMsgColumnNames, $userMsgCondtnArr, $likeCondtnArr = array(), $joinArr = array(), $singleRow = false, $orderByArr = array(), $groupByArr = array(), $whereInArray = array(), $userMsgConnCustomWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $getAllUserMsg = $userMsgQuery['userData'];
        }
        // Initialize an empty result array
        $resultArray = array();
        // Loop through the messages
        foreach ($getAllUserMsg as $message) {
            // Extract date from the 'createdDatetime'
            $date = date('d-m-Y', strtotime($message['createdDatetime']));

            // Check if the date already exists in the result array
            if (!isset($resultArray[$date])) {
                // If not, create a new entry with an empty 'msg' array
                $resultArray[$date] = array('id' => $date, 'msg' => array());
            }

            // Add the current message to the 'msg' array for that date
            $resultArray[$date]['msg'][] = $message;
        }

        // Convert the result array to indexed array
        $resultArray = array_values($resultArray);

        // Now $resultArray has the desired structure
        // print_r($resultArray);

        $this->data['getAllUserMsg'] = $resultArray;

        return view('firm_panel/chat/home', $this->data);
    }

    public function getUserList()
    {
        $user_name = $this->request->getPost('user_name');
        
        if (!empty($user_name)) {

            $userCondtnArr['user_tbl.status'] = "1";
            $userCondtnArr['user_tbl.isOldUser'] = 2;
            $userCondtnArr['user_tbl.userId !='] = $this->sessUserId;
            $likeCondtnArr['user_tbl.userFullName'] = $user_name;

            $userOrderByArr['user_tbl.userId'] = "ASC";
            $userOrderByArr['user_tbl.userDesgn'] = "ASC";

            $userGroupByArr = ['user_tbl.userId'];

            $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan, user_tbl.userImg", $userCondtnArr, $likeCondtnArr, $joinArr = array(), $singleRow = FALSE, $userOrderByArr, $userGroupByArr, $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $getUserList = $query['userData'];
            // echo $query['query'];die();

            if (!empty($getUserList)) {
                $responseData['userData'] = $getUserList;
                $responseData['message'] = "User List Fetched Successfully";
                $responseData['status'] = true;
            } else {
                $responseData['userData'] = [];
                $responseData['message'] = "User List Not Found!";
                $responseData['status'] = true;
            }
        } else {
            $userCondtnArr['user_tbl.status'] = "1";
            $userCondtnArr['user_tbl.isOldUser'] = 2;
            $userCondtnArr['user_tbl.userId !='] = $this->sessUserId;
            $likeCondtnArr['user_tbl.userFullName'] = $user_name;

            $userOrderByArr['user_tbl.userId'] = "ASC";
            $userOrderByArr['user_tbl.userDesgn'] = "ASC";

            $userGroupByArr = ['user_tbl.userId'];

            $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan, user_tbl.userImg", $userCondtnArr, $likeCondtnArr, $joinArr = array(), $singleRow = FALSE, $userOrderByArr, $userGroupByArr, $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $getUserList = $query['userData'];
            $responseData['userData'] = $getUserList;
            $responseData['message'] = "User List Not Found!";
            $responseData['status'] = true;
        }
        echo json_encode($responseData);
    }
    public function sendMsg()
    {
        $this->db->transBegin();

        $receiverId = $this->request->getPost('user_id');
        $receiverName = $this->request->getPost('user_name');
        $receiverMsg = $this->request->getPost('message');

        if (empty($receiverMsg) || empty($receiverId)) {
            $this->session->setFlashdata('errorMsg', "Something went wrong!!");
            return false;
        }

        $userMsgConnCustomWhereArray[] = "(user_chat_connection_tbl.fkUser1=" . $this->sessUserId . " AND user_chat_connection_tbl.fkUser2=" . $receiverId . ") OR (user_chat_connection_tbl.fkUser1=" . $receiverId . " AND user_chat_connection_tbl.fkUser2=" . $this->sessUserId . ")";
        $userMsgConnCondtnArr['user_chat_connection_tbl.status'] = "1";

        $userMsgConnColumnNames = "user_chat_connection_tbl.userChatConnectionId, user_chat_connection_tbl.fkUser1, user_chat_connection_tbl.fkUser2";

        $userMsgConnQuery = $this->Mcommon->getRecords($tableName = $this->user_chat_connection_tbl, $colNames = $userMsgConnColumnNames, $userMsgConnCondtnArr, $likeCondtnArr = array(), $joinArr = array(), $singleRow = TRUE, $orderByArr = array(), $groupByArr = array(), $whereInArray = array(), $userMsgConnCustomWhereArray, $orWhereArray = array(), $orWhereDataArr = array());

        $getUserMsgConn = $userMsgConnQuery['userData'];
        $connection_id = 0;

        if (empty($getUserMsgConn)) {

            $userConnInsertArr = [
                'fkUser1' => $receiverId,
                'fkUser2' => $this->sessUserId,
                'status' => 1,
                'createdBy' => $this->sessUserId,
                'createdDatetime' => $this->currTimeStamp
            ];

            $this->MUserChatConnection->save($userConnInsertArr);

            $user_conn_id = $this->MUserChatConnection->getInsertID();
            $connection_id = $user_conn_id;
        } else {
            if (!empty($getUserMsgConn['userChatConnectionId']))
                $connection_id = $getUserMsgConn['userChatConnectionId'];
        }

        if ($connection_id > 0) {

            $userMsgInsertArr = [
                'fromUserId' => $this->sessUserId,
                'toUserId' => $receiverId,
                'userMessage' => $receiverMsg,
                'fkUserChatConnectionId' => $connection_id,
                'status' => 1,
                'createdBy' => $this->sessUserId,
                'createdDatetime' => $this->currTimeStamp
            ];

            $this->MUserMessage->save($userMsgInsertArr);
            $msg_id = $this->MUserMessage->getInsertID();
        }

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Message Not Sent");

            return false;
        } else {
            $this->db->transCommit();

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = "User Message Sent SuccessFully";
            $insertLogArr['ip'] = $this->IPAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            // $this->session->setFlashdata('successMsg', "Message Sent SuccessFully :)");

            return true;
        }
    }

    public function getMsg()
    {
        $responseData = [];

        $receiverId = $this->request->getPost('user_id');
        $receiverName = $this->request->getPost('user_name');

        if (empty($receiverId)) {
            $responseData['userData'] = [];
            $responseData['message'] = "Sorry User Not Found!";
            $responseData['status'] = true;
            echo json_encode($responseData);
            return false;
        }

        $userMsgConnCustomWhereArray[] = "(user_chat_connection_tbl.fkUser1=" . $this->sessUserId . " AND user_chat_connection_tbl.fkUser2=" . $receiverId . ") OR (user_chat_connection_tbl.fkUser1=" . $receiverId . " AND user_chat_connection_tbl.fkUser2=" . $this->sessUserId . ")";
        $userMsgConnCondtnArr['user_chat_connection_tbl.status'] = "1";

        $userMsgConnColumnNames = "user_chat_connection_tbl.userChatConnectionId, user_chat_connection_tbl.fkUser1, user_chat_connection_tbl.fkUser2";

        $userMsgConnQuery = $this->Mcommon->getRecords($tableName = $this->user_chat_connection_tbl, $colNames = $userMsgConnColumnNames, $userMsgConnCondtnArr, $likeCondtnArr = array(), $joinArr = array(), $singleRow = TRUE, $orderByArr = array(), $groupByArr = array(), $whereInArray = array(), $userMsgConnCustomWhereArray, $orWhereArray = array(), $orWhereDataArr = array());

        $getUserMsgConn = $userMsgConnQuery['userData'];


        if (!empty($getUserMsgConn)) {

            $userMsgCondtnArr['user_message_tbl.fkUserChatConnectionId'] = $getUserMsgConn['userChatConnectionId'];
            $userMsgCondtnArr['user_message_tbl.status'] = "1";

            $userMsgColumnNames = "user_message_tbl.*";

            $userMsgQuery = $this->Mcommon->getRecords($tableName = $this->user_message_tbl, $colNames = $userMsgColumnNames, $userMsgCondtnArr, $likeCondtnArr = array(), $joinArr = array(), $singleRow = false, $orderByArr = array(), $groupByArr = array(), $whereInArray = array(), $userMsgConnCustomWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $getAllUserMsg = $userMsgQuery['userData'];

            $responseData['userData'] = $getAllUserMsg;
            $responseData['message'] = "User Messages Fetched Successfully";
            $responseData['status'] = true;
        } else {
            $responseData['userData'] = [];
            $responseData['message'] = "User Messages Not Found!";
            $responseData['status'] = true;
        }
        echo json_encode($responseData);
    }
}
