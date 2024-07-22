<?php
namespace App\Controllers;

class TimeSheet extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mconfig = new \App\Models\Mconfig();
        $this->MtimeSheet = new \App\Models\MtimeSheet();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->time_sheet_tbl=$tableArr['time_sheet_tbl'];

        $this->section = "Time Sheet";
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full', 'timepicker');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Time Sheet";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $userId = $this->sessUserId;

        $this->data['userId'] = $userId;

        $tsCondtn = array(
            'status'    => 1,
            'fkUserId'  => $userId
        );

        $timeSheetArr = $this->MtimeSheet->where($tsCondtn)
            ->findAll();

        $this->data['timeSheetArr'] = $timeSheetArr;

        return view('firm_panel/timesheet/list', $this->data);
	}

	public function work_time_sheet()
	{
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $workId = $uri->getSegment(2);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full', 'timepicker');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Time Sheet";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $userId = $this->sessUserId;

        $this->data['workId'] = $workId;
        $this->data['userId'] = $userId;

        $tsCondtn = array(
            'status'    => 1,
            'fkWorkId'  => $workId,
            'fkUserId'  => $userId
        );

        $timeSheetArr = $this->MtimeSheet->where($tsCondtn)->findAll();

        $this->data['timeSheetArr'] = $timeSheetArr;

        return view('firm_panel/timesheet/work_time_sheet', $this->data);
	}

    public function insertData()
    {
        $this->db->transBegin();

        $tsWorkingDate = $this->request->getPost('tsWorkingDate');
        $tsAddHrs = $this->request->getPost('tsAddHrs');
        $tsStartTime = $this->request->getPost('tsStartTime');
        $tsEndTime = $this->request->getPost('tsEndTime');
        $tsTotalHours = $this->request->getPost('tsTotalHours');
        $tsWorkPlace = $this->request->getPost('tsWorkPlace');
        $tsRemarks = $this->request->getPost('tsRemarks');
        $userId = $this->request->getPost('userId');
        $workId = $this->request->getPost('workId');

        $startTime = 0;
        $endTime = 0;
        $totalHours = 0;

        if($tsAddHrs!=1)
        {
            if (!empty($tsStartTime)) {
                $timeStampStart = strtotime($tsStartTime);
                $startTime = date('H:i:s', $timeStampStart);
            }

            if (!empty($tsEndTime)) {
                $timeStampEnd = strtotime($tsEndTime);
                $endTime = date('H:i:s', $timeStampEnd);
            }

            if (!empty($startTime) && !empty($endTime)) {
                $currentDate = date('Y-m-d');

                $sTime = new \DateTime($currentDate . ' ' . $startTime);
                $eTime = new \DateTime($currentDate . ' ' . $endTime);

                $interval = $eTime->diff($sTime);

                $hoursDifference = $interval->h;
                $minutesDifference = sprintf("%02d", $interval->i);

                $totalHours = $hoursDifference . "." . $minutesDifference;
            }
        }
        else
        {
            if(!empty($tsTotalHours))
            {
                $totalHours = $tsTotalHours;
            }
        }

        $tsInsertArr = array(
            'fkWorkId'          => $workId,
            'fkUserId'          => $userId,
            'tsWorkingDate'     => $tsWorkingDate,
            'tsAddHrs'          => $tsAddHrs,
            'tsStartTime'       => $startTime,
            'tsEndTime'         => $endTime,
            'tsTotalHours'      => $totalHours,
            'tsWorkPlace'       => $tsWorkPlace,
            'tsRemarks'         => $tsRemarks,
            'status'            => 1,
            'createdBy'         => $this->adminId,
            'createdDatetime'   => $this->currTimeStamp
        );

        $this->MtimeSheet->save($tsInsertArr);

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Time Sheet not added :(");
        } else {
            $this->db->transCommit();

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = "Time Sheet added";
            $insertLogArr['ip'] = $this->IPAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Time Sheet has been added successfully :)");
        }

        return redirect()->back();
    }

    public function updateData()
    {
        $this->db->transBegin();

        $timeSheetId = $this->request->getPost('timeSheetId');
        $tsAddHrs = $this->request->getPost('tsAddHrs');
        $tsStartTime = $this->request->getPost('tsStartTime');
        $tsEndTime = $this->request->getPost('tsEndTime');
        $tsTotalHours = $this->request->getPost('tsTotalHours');
        $tsWorkPlace = $this->request->getPost('tsWorkPlace');
        $tsRemarks = $this->request->getPost('tsRemarks');
        $userId = $this->request->getPost('userId');
        $workId = $this->request->getPost('workId');

        $startTime = 0;
        if (!empty($tsStartTime)) {
            $timeStampStart = strtotime($tsStartTime);
            $startTime = date('H:i:s', $timeStampStart);
        }

        $endTime = 0;
        if (!empty($tsEndTime)) {
            $timeStampEnd = strtotime($tsEndTime);
            $endTime = date('H:i:s', $timeStampEnd);
        }

        $totalHours = 0;
        if($tsAddHrs!=1)
        {
            if (!empty($startTime) && !empty($endTime)) {
                $currentDate = date('Y-m-d');

                $startTime = new \DateTime($currentDate . ' ' . $startTime);
                $endTime = new \DateTime($currentDate . ' ' . $endTime);

                $interval = $endTime->diff($startTime);

                $hoursDifference = $interval->h;
                $minutesDifference = sprintf("%02d", $interval->i);

                $totalHours = $hoursDifference . "." . $minutesDifference;
            }
        }
        else
        {
            if(!empty($tsTotalHours))
            {
                $totalHours = $tsTotalHours;
            }
        }

        $tsUpdateArr = array(
            'timeSheetId'       => $timeSheetId,
            'fkWorkId'          => $workId,
            'fkUserId'          => $userId,
            'tsWorkingDate'     => $tsWorkingDate,
            'tsAddHrs'          => $tsAddHrs,
            'tsStartTime'       => $startTime,
            'tsEndTime'         => $endTime,
            'tsTotalHours'      => $totalHours,
            'tsWorkPlace'       => $tsWorkPlace,
            'tsRemarks'         => $tsRemarks,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        );

        $this->MtimeSheet->save($tsUpdateArr);

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Time Sheet not updated :(");
        } else {
            $this->db->transCommit();

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = "Time Sheet updated";
            $insertLogArr['ip'] = $this->IPAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Time Sheet has been updated successfully :)");
        }

        return redirect()->back();
    }

    public function deleteData()
    {
        $this->db->transBegin();

        $timeSheetId = $this->request->getPost('timeSheetId');

        $insertArr = [
            'timeSheetId'       =>  $timeSheetId,
            'status'            =>  2,
            'updatedBy'         =>  $this->adminId,
            'updatedDatetime'   =>  $this->currTimeStamp
        ];

        $this->MtimeSheet->save($insertArr);

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Time Sheet not deleted :(");
        } else {
            $this->db->transCommit();

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = "Time Sheet deleted";
            $insertLogArr['ip'] = $this->IPAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Time Sheet has been deleted successfully :)");
        }
    }
}
