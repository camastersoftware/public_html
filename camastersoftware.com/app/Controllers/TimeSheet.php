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
        $this->Muser = new \App\Models\Muser();
        $this->MStaffCost = new \App\Models\MStaffCost();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->periodicity_tbl=$tableArr['periodicity_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->time_sheet_tbl=$tableArr['time_sheet_tbl'];
        $this->act_tbl=$tableArr['act_tbl'];

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

        $mth = $this->request->getGet("mth");

        if (empty($mth))
            $mth = date('n');

        $this->data['mth'] = $mth;

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full', 'timepicker');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Time Sheet";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $selMth = sprintf("%02d", $mth);

        $fin_year_arr = explode("-", $this->sessDueDateYear);

        $fromYr = $fin_year_arr[0];
        $toYr = "20" . $fin_year_arr[1];

        $this->data['fromYr'] = $fromYr;
        $this->data['toYr'] = $toYr;

        if ($mth <= 3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;

        $this->data['selYr'] = $selYr;

        $fromDate = date("Y-m-d", strtotime($selYr . "-" . $selMth . "-01"));
        $toDate = date("Y-m-d", strtotime($selYr . "-" . $selMth . "-31"));

        $userId = $this->sessUserId;

        $this->data['userId'] = $userId;

        $userCondtion = array(
            "user_tbl.isOldUser" => 2,
            "user_tbl.status" => 1,
            "user_tbl.userId" => $userId
        );

        $staffData = $this->Muser->select("user_tbl.userId, user_tbl.userFullName")
                    ->where($userCondtion)
                    ->get()
                    ->getRowArray();

        $this->data['staffData'] = $staffData;

        $workCondtnArr['time_sheet_tbl.tsWorkingDate >=']=$fromDate;
        $workCondtnArr['time_sheet_tbl.tsWorkingDate <=']=$toDate;
        $workCondtnArr['time_sheet_tbl.fkUserId']=$userId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";

        $workOrderByArr["time_sheet_tbl.tsWorkingDate"]="ASC";
        $workOrderByArr["time_sheet_tbl.timeSheetId"]="ASC";

        $workJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=time_sheet_tbl.fkWorkId AND work_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId AND client_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id AND due_date_master_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND due_date_for_tbl.option_type=5", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");

        $columnNames = "
                    work_tbl.workId,
                    time_sheet_tbl.timeSheetId,
                    time_sheet_tbl.fkWorkId,
                    time_sheet_tbl.tsWorkingDate,
                    time_sheet_tbl.tsAddHrs,
                    time_sheet_tbl.tsStartTime,
                    time_sheet_tbl.tsEndTime,
                    time_sheet_tbl.tsTotalHours,
                    time_sheet_tbl.tsWorkPlace,
                    time_sheet_tbl.tsRemarks,
                    client_tbl.clientName,
                    client_tbl.clientBussOrganisation,
                    client_tbl.clientBussOrganisationType,
                    due_date_master_tbl.finYear,
                    due_date_master_tbl.periodicity,
                    due_date_master_tbl.daily_date,
                    due_date_master_tbl.period_month,
                    due_date_master_tbl.period_year,
                    due_date_master_tbl.f_period_month,
                    due_date_master_tbl.f_period_year,
                    due_date_master_tbl.t_period_month,
                    due_date_master_tbl.t_period_year,
                    ext_due_date_master_tbl.extended_date, 
                    due_date_for_tbl.shortName AS due_date_for_name,
                    applicable_form_tbl.shortName AS applicable_form_name,
                    act_tbl.act_id,
                    act_tbl.act_short_name,
                    periodicity_tbl.periodicity_name
                ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->time_sheet_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $timeSheetArr=$query['userData'];

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

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";

        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");

        $columnNames = "
                    work_tbl.workId,
                    client_tbl.clientName,
                    client_tbl.clientBussOrganisation,
                    client_tbl.clientBussOrganisationType,
                    due_date_master_tbl.finYear,
                    due_date_master_tbl.periodicity,
                    due_date_master_tbl.daily_date,
                    due_date_master_tbl.period_month,
                    due_date_master_tbl.period_year,
                    due_date_master_tbl.f_period_month,
                    due_date_master_tbl.f_period_year,
                    due_date_master_tbl.t_period_month,
                    due_date_master_tbl.t_period_year,
                    ext_due_date_master_tbl.extended_date, 
                    due_date_for_tbl.act_option_name AS due_date_for_name,
                    periodicity_tbl.periodicity_name
                ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];
        
        $workClientName="N/A";
        $DDFName="N/A";
        $DDdate="N/A";
        $DDPeriodcity="N/A";
        $DDPeriod="N/A";
        $asmtYear="N/A";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            $due_date_for_name=$workArr['due_date_for_name'];
            $due_date=$workArr['extended_date'];
            $periodicity_name=$workArr['periodicity_name'];
            $periodicity=$workArr['periodicity'];
            
            if(in_array($clientBussOrgType, INDIVIDUAL_ARRAY))
                $workClientName=(!empty($workArr['clientName'])) ? $workArr['clientName']:"";
            else
                $workClientName=(!empty($workArr['clientBussOrganisation'])) ? $workArr['clientBussOrganisation']:"";
            
            if(!empty($due_date_for_name))
                $DDFName=$due_date_for_name;

            if(check_valid_date($due_date))
                $DDdate=date('d-m-Y', strtotime($due_date));

            if(!empty($periodicity_name))
                $DDPeriodcity=$periodicity_name;

            if(!empty($periodicity))
            {
                if($periodicity==1)
                {
                    $DDPeriod = date("d-M-Y", strtotime($workArr["daily_date"]));
                }
                elseif($periodicity==2)
                {
                    $DDPeriod = date("M", strtotime("2021-".$workArr["period_month"]."-01"))."-".$workArr["period_year"];
                }
                elseif($periodicity>=3)
                {
                    $DDPeriod = date("M", strtotime("2021-".$workArr["f_period_month"]."-01"))."-".$workArr["f_period_year"]." - ".date("M", strtotime("2021-".$workArr["t_period_month"]."-01"))."-".$workArr["t_period_year"];
                }
            }
                
            if(!empty($workArr['finYear']))
            {
                $asmtYearVal=$workArr['finYear'];
                
                $asmtYearArr = explode('-', $asmtYearVal);
                
                $fY=(int)$asmtYearArr[0]+1;
                $lY=(int)$asmtYearArr[1]+1;
                
                $asmtYear=$fY."-".$lY;
            }
        }
        
        $this->data['workClientName']=$workClientName;
        $this->data['DDFName']=$DDFName;
        $this->data['DDdate']=$DDdate;
        $this->data['DDPeriodcity']=$DDPeriodcity;
        $this->data['DDPeriod']=$DDPeriod;
        $this->data['asmtYear']=$asmtYear;

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

        $staffCondtn = array(
            "fkUserId"  => $userId,
            'status'    => 1
        );

        $staffCostData=$this->MStaffCost->where($staffCondtn)
                                        ->get()
                                        ->getRowArray();

        $tsCostPerHour = 0;
        $tsTotalCost = 0;

        if(!empty($staffCostData)){

            if(!empty($totalHours))
            {
                $tsCostPerHour = (float)$staffCostData["staffCostPerHour"];
                $tsCostPerMin = (float)number_format($tsCostPerHour/60, 2, '.', '');
                $totalHrsInMinutes = getHoursInMinutes((float)$totalHours); 
                $tsTotalCost = $totalHrsInMinutes * $tsCostPerMin;
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
            'tsCostPerHour'     => $tsCostPerHour,
            'tsTotalCost'       => $tsTotalCost,
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

        $staffCondtn = array(
            "fkUserId"  => $userId,
            'status'    => 1
        );

        $staffCostData=$this->MStaffCost->where($staffCondtn)
                                        ->get()
                                        ->getRowArray();

        $tsCostPerHour = 0;
        $tsTotalCost = 0;

        if(!empty($staffCostData)){

            if(!empty($totalHours))
            {
                $tsCostPerHour = (float)$staffCostData["staffCostPerHour"];
                $tsCostPerMin = (float)number_format($tsCostPerHour/60, 2, '.', '');
                $totalHrsInMinutes = getHoursInMinutes((float)$totalHours); 
                $tsTotalCost = $totalHrsInMinutes * $tsCostPerMin;
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
            'tsCostPerHour'     => $tsCostPerHour,
            'tsTotalCost'       => $tsTotalCost,
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
