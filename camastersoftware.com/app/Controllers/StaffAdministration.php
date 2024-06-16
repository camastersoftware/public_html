<?php

namespace App\Controllers;

class StaffAdministration extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath'] = "template/includes/css";
        $this->data['navPath'] = "template/includes/nav";
        $this->data['sidebarPath'] = "template/includes/sidebar";
        $this->data['footerPath'] = "template/includes/footer";
        $this->data['scriptPath'] = "template/includes/scripts";
        $this->data['layoutPath'] = "template/layouts/main_layout";

        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->MsalaryParameter = new \App\Models\MsalaryParameter();
        $this->MemployeeSalary = new \App\Models\MemployeeSalary();
        $this->MemployeeSalaryDivision = new \App\Models\MemployeeSalaryDivision();
        $this->MemployeeAttendance = new \App\Models\MemployeeAttendance();
        $this->Mholiday = new \App\Models\Mholiday();
        $this->MstaffTypes = new \App\Models\MstaffTypes();
        $this->Mfirm = new \App\Models\Mfirm();
        $this->Mconfig = new \App\Models\Mconfig();
        $this->MArticleshipLeaveCal = new \App\Models\MArticleshipLeaveCal();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr = $this->TableLib->get_tables();

        $this->user_tbl = $tableArr['user_tbl'];
        $this->staff_types = $tableArr['staff_types'];
        $this->salary_parameters_tbl = $tableArr['salary_parameters_tbl'];
        $this->employee_salary_division_tbl = $tableArr['employee_salary_division_tbl'];
        $this->employee_attendance_tbl = $tableArr['employee_attendance_tbl'];
        $this->articleship_staff_tbl = $tableArr['articleship_staff_tbl'];
        $this->chartered_accuntant_tbl = $tableArr['chartered_accuntant_tbl'];
        $this->expense_voucher_tbl = $tableArr['expense_voucher_tbl'];
        $this->articleship_leave_tbl = $tableArr['articleship_leave_tbl'];

        $this->section = "Staff Administration";

        $currMth = date('n');

        $this->data['currMth'] = $currMth;
    }

    public function index()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Staff Management";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = "Home";

        $this->data['navArr'] = $navArr;

        return view('firm_panel/staff_administration/home', $this->data);
    }

    public function emp_attendance()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Attendance";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['staff_types.seqNo']="ASC";
        // $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $userJoinArr[]=array("tbl"=>$this->staff_types, "condtn"=>"staff_types.staff_type_id=user_tbl.userStaffType", "type"=>"left");

        $query = $this->Mcommon->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr, $singleRow = FALSE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());
        
        $getUserList = $query['userData'];

        $this->data['getUserList'] = $getUserList;

        return view('firm_panel/staff_administration/emp_attendance', $this->data);
    }

    public function employees()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Employees";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['staff_types.seqNo']="ASC";
        // $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $userJoinArr[]=array("tbl"=>$this->staff_types, "condtn"=>"staff_types.staff_type_id=user_tbl.userStaffType", "type"=>"left");

        $query = $this->Mcommon->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr, $singleRow = FALSE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserList = $query['userData'];

        $this->data['getUserList'] = $getUserList;

        return view('firm_panel/staff_administration/employees', $this->data);
    }

    public function employee_salary_payable($userId)
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Employees";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $userCondtnArr['user_tbl.userId'] = $userId;
        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = TRUE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserData = $query['userData'];

        $this->data['getUserData'] = $getUserData;

        $salaryParameterArr = $this->MsalaryParameter->where('status', 1)->findAll();

        $salPmtArr = array();

        if (!empty($salaryParameterArr)) {
            foreach ($salaryParameterArr as $e_slpmtr) {
                if ($e_slpmtr['salaryParameterType'] == 1) {
                    $salPmtArr[] = $e_slpmtr;
                }
            }
        }

        $salDedctnArr = array();

        if (!empty($salaryParameterArr)) {
            foreach ($salaryParameterArr as $e_slpmtr) {
                if ($e_slpmtr['salaryParameterType'] == 2) {
                    $salDedctnArr[] = $e_slpmtr;
                }
            }
        }

        $this->data['salPmtArr'] = $salPmtArr;
        $this->data['salDedctnArr'] = $salDedctnArr;

        $empSalCondtn = array(
            'status' => 1,
            'fkUserId' => $userId
        );

        $empSalaryArr = $this->MemployeeSalary->where($empSalCondtn)->first();

        $this->data['empSalaryArr'] = $empSalaryArr;

        $empSalDivisionCondtn = array(
            'status' => 1,
            'fkUserId' => $userId
        );

        $empSalDivisionArr = $this->MemployeeSalaryDivision->where($empSalDivisionCondtn)->findAll();

        $empSalDivisionDataArr = array();

        if (!empty($empSalDivisionArr)) {
            foreach ($empSalDivisionArr as $e_dev) {
                $empSalDivisionDataArr[$e_dev['fkSalaryParameterId']] = $e_dev;
            }
        }

        $this->data['empSalDivisionDataArr'] = $empSalDivisionDataArr;

        return view('firm_panel/staff_administration/employee_salary_payable', $this->data);
    }

    public function update_employee_salary_payable()
    {
        $this->db->transBegin();

        $salaryParameterId = $this->request->getPost('salaryParameterId');
        $empSalDivisionId = $this->request->getPost('empSalDivisionId');
        $empSalDivisionMthAmt = $this->request->getPost('empSalDivisionMthAmt');
        $empSalDivisionYrAmt = $this->request->getPost('empSalDivisionYrAmt');
        $grossSalaryAmtMth = $this->request->getPost('grossSalaryAmtMth');
        $grossSalaryAmtYr = $this->request->getPost('grossSalaryAmtYr');
        $dedctnSalaryAmtMth = $this->request->getPost('dedctnSalaryAmtMth');
        $dedctnSalaryAmtYr = $this->request->getPost('dedctnSalaryAmtYr');
        $totalAmtPayableMth = $this->request->getPost('totalAmtPayableMth');
        $totalAmtPayableYr = $this->request->getPost('totalAmtPayableYr');
        $empSalId = $this->request->getPost('empSalId');
        $userId = $this->request->getPost('userId');

        $empSalUpdateArr = array(
            'empSalId'              => $empSalId,
            'fkUserId'              => $userId,
            'grossSalaryAmtMth'     => $grossSalaryAmtMth,
            'grossSalaryAmtYr'      => $grossSalaryAmtYr,
            'dedctnSalaryAmtMth'    => $dedctnSalaryAmtMth,
            'dedctnSalaryAmtYr'     => $dedctnSalaryAmtYr,
            'totalAmtPayableMth'    => $totalAmtPayableMth,
            'totalAmtPayableYr'     => $totalAmtPayableYr,
            'status'                => 1,
            'createdBy'             => $this->adminId,
            'createdDatetime'       => $this->currTimeStamp,
            'updatedBy'             => $this->adminId,
            'updatedDatetime'       => $this->currTimeStamp
        );

        $this->MemployeeSalary->save($empSalUpdateArr);

        $empSalDivisionUpdateArr = array();

        if (!empty($salaryParameterId)) {
            foreach ($salaryParameterId as $e_key => $e_id) {
                $empSalDivId = $empSalDivisionId[$e_key];
                $empSalDivMthAmt = $empSalDivisionMthAmt[$e_key];
                $empSalDivYrAmt = $empSalDivisionYrAmt[$e_key];

                $empSalDivisionUpdateArr = array(
                    'empSalDivisionId'      => $empSalDivId,
                    'fkSalaryParameterId'   => $e_id,
                    'fkUserId'              => $userId,
                    'empSalDivisionMthAmt'  => $empSalDivMthAmt,
                    'empSalDivisionYrAmt'   => $empSalDivYrAmt,
                    'status'                => 1,
                    'createdBy'             => $this->adminId,
                    'createdDatetime'       => $this->currTimeStamp,
                    'updatedBy'             => $this->adminId,
                    'updatedDatetime'       => $this->currTimeStamp
                );

                $this->MemployeeSalaryDivision->save($empSalDivisionUpdateArr);
            }
        }

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Employee Salary Payable Information not updated :(");
        } else {
            $this->db->transCommit();

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = "Employee Salary Payable Information updated";
            $insertLogArr['ip'] = $this->IPAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Employee Salary Payable Information has been updated successfully :)");
        }

        return redirect()->back();
    }

    public function employee_salary_payable_details($userId)
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Employees";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $userCondtnArr['user_tbl.userId'] = $userId;
        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = TRUE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserData = $query['userData'];

        $this->data['getUserData'] = $getUserData;

        $salaryParameterArr = $this->MsalaryParameter->where('status', 1)->findAll();

        $salPmtArr = array();

        if (!empty($salaryParameterArr)) {
            foreach ($salaryParameterArr as $e_slpmtr) {
                if ($e_slpmtr['salaryParameterType'] == 1) {
                    $salPmtArr[] = $e_slpmtr;
                }
            }
        }

        $salDedctnArr = array();

        if (!empty($salaryParameterArr)) {
            foreach ($salaryParameterArr as $e_slpmtr) {
                if ($e_slpmtr['salaryParameterType'] == 2) {
                    $salDedctnArr[] = $e_slpmtr;
                }
            }
        }

        $this->data['salPmtArr'] = $salPmtArr;
        $this->data['salDedctnArr'] = $salDedctnArr;

        $empSalCondtn = array(
            'status' => 1,
            'fkUserId' => $userId
        );

        $empSalaryArr = $this->MemployeeSalary->where($empSalCondtn)->first();

        $this->data['empSalaryArr'] = $empSalaryArr;

        $empSalDivisionCondtn = array(
            'status' => 1,
            'fkUserId' => $userId
        );

        $empSalDivisionArr = $this->MemployeeSalaryDivision->where($empSalDivisionCondtn)->findAll();

        $empSalDivisionDataArr = array();

        if (!empty($empSalDivisionArr)) {
            foreach ($empSalDivisionArr as $e_dev) {
                $empSalDivisionDataArr[$e_dev['fkSalaryParameterId']] = $e_dev;
            }
        }

        $this->data['empSalDivisionDataArr'] = $empSalDivisionDataArr;

        return view('firm_panel/staff_administration/employee_salary_payable_details', $this->data);
    }

    public function employee_payable_summary()
    {
        $userId = "";
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Summary of Payable";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $prmSalCondtnArr['salary_parameters_tbl.status'] = "1";
        $prmSalOrderByArr['salary_parameters_tbl.salaryParameterId'] = "ASC";
        $prmSalGroupByArr = array("employee_salary_division_tbl.fkSalaryParameterId", "employee_salary_division_tbl.fkUserId");

        $prmSalJoinArr[] = array("tbl" => $this->employee_salary_division_tbl, "condtn" => "employee_salary_division_tbl.fkSalaryParameterId=salary_parameters_tbl.salaryParameterId AND employee_salary_division_tbl.status=1", "type" => "left");
        $prmSalJoinArr[] = array("tbl" => $this->user_tbl, "condtn" => "user_tbl.userId=employee_salary_division_tbl.fkUserId AND user_tbl.status=1 AND user_tbl.isOldUser=2", "type" => "left");

        $columnNames = "
            employee_salary_division_tbl.fkSalaryParameterId,
            employee_salary_division_tbl.fkUserId,
            employee_salary_division_tbl.empSalDivisionMthAmt,
            user_tbl.userFullName
        ";

        $query = $this->Mcommon->getRecords($tableName = $this->salary_parameters_tbl, $colNames = $columnNames, $prmSalCondtnArr, $likeCondtnArr = array(), $prmSalJoinArr, $singleRow = FALSE, $prmSalOrderByArr, $prmSalGroupByArr, $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $prmSalData = $query['userData'];

        $paramUserArr = array();
        $paramUserAmtArr = array();

        if (!empty($prmSalData)) {
            foreach ($prmSalData as $e_p_sl) {
                $paramUserArr[$e_p_sl['fkSalaryParameterId']][] = $e_p_sl['empSalDivisionMthAmt'];
                $paramUserAmtArr[$e_p_sl['fkSalaryParameterId']][$e_p_sl['fkUserId']] = $e_p_sl['empSalDivisionMthAmt'];
            }
        }

        $this->data['paramUserArr'] = $paramUserArr;
        $this->data['paramUserAmtArr'] = $paramUserAmtArr;

        $salaryParameterArr = $this->MsalaryParameter->where('status', 1)->findAll();

        $this->data['salaryParameterArr'] = $salaryParameterArr;

        $salPmtArr = array();

        if (!empty($salaryParameterArr)) {
            foreach ($salaryParameterArr as $e_slpmtr) {
                if ($e_slpmtr['salaryParameterType'] == 1) {
                    $salPmtArr[] = $e_slpmtr;
                }
            }
        }

        $salDedctnArr = array();

        if (!empty($salaryParameterArr)) {
            foreach ($salaryParameterArr as $e_slpmtr) {
                if ($e_slpmtr['salaryParameterType'] == 2) {
                    $salDedctnArr[] = $e_slpmtr;
                }
            }
        }

        $this->data['salPmtArr'] = $salPmtArr;
        $this->data['salDedctnArr'] = $salDedctnArr;

        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userFullName", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = FALSE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $userArr = $query['userData'];

        $this->data['userArr'] = $userArr;

        return view('firm_panel/staff_administration/employee_payable_summary', $this->data);
    }

    public function employee_attendance($userId)
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $mth = $uri->getSegment(3);

        if (empty($mth))
            $mth = date('n');

        $this->data['mth'] = $mth;

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full', 'timepicker');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Attendance";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $this->data['userId'] = $userId;

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

        $fromDate = date("Y-m-d", strtotime($selYr . "-" . $selMth . "-01"));
        $toDate = date("Y-m-d", strtotime($selYr . "-" . $selMth . "-31"));

        $generatedDateArr = array();

        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $selMth, $d, $selYr);

            if (date('m', $time) == $selMth)
                $generatedDateArr[] = date('Y-m-d', $time);
        }

        $this->data['generatedDateArr'] = $generatedDateArr;

        $userCondtnArr['user_tbl.userId'] = $userId;
        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = TRUE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserData = $query['userData'];

        $this->data['getUserData'] = $getUserData;

        $empAttendCondtn = array(
            'status'        => 1,
            'fkEmployeeId'  => $userId
        );

        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
            ->where('attendanceDate >=', $fromDate)
            ->where('attendanceDate <=', $toDate)
            ->findAll();

        $this->data['empAttendArr'] = $empAttendArr;

        $empAttendData = array();

        if (!empty($empAttendArr)) {
            foreach ($empAttendArr as $e_attnd) {
                $empAttendData[$e_attnd['attendanceDate']] = $e_attnd;
            }
        }

        $empAttendArray = array();

        if (!empty($generatedDateArr)) {
            foreach ($generatedDateArr as $e_date) {
                if (isset($empAttendData[$e_date])) {
                    $empAttendArray[$e_date] = $empAttendData[$e_date];
                } else {
                    $empAttendArray[$e_date]['attendanceDate'] = $e_date;
                }
            }
        }

        $this->data['empAttendArray'] = $empAttendArray;

        $holidayArr = $this->Mholiday->where('status', 1)
            ->where('holidayDate >=', $fromDate)
            ->where('holidayDate <=', $toDate)
            ->findAll();

        $this->data['holidayArr'] = $holidayArr;

        $holidayDateArr = array();
        $holidayNameArr = array();

        if (!empty($holidayArr)) {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));

            foreach ($holidayArr as $e_hlday) {
                $holidayNameArr[$e_hlday["holidayDate"]] = $e_hlday["holidayName"];
            }
        }

        $this->data['holidayDateArr'] = $holidayDateArr;
        $this->data['holidayNameArr'] = $holidayNameArr;

        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();

        $this->data['settingsArr'] = $settingsArr;

        return view('firm_panel/staff_administration/employee_attendance', $this->data);
    }

    public function add_employee_attendance()
    {
        $this->db->transBegin();

        $attendanceDate = $this->request->getPost('attendanceDate');
        $attendanceStatus = $this->request->getPost('attendanceStatus');
        $inTimeVal = $this->request->getPost('inTime');
        $outTimeVal = $this->request->getPost('outTime');
        $workPlace = $this->request->getPost('workPlace');
        $remarks = $this->request->getPost('remarks');
        $userId = $this->request->getPost('userId');

        $timeStampIn = 0;
        $inTime = 0;
        if (!empty($inTimeVal)) {
            $timeStampIn = strtotime($inTimeVal);
            $inTime = date('H:i:s', $timeStampIn);
        }

        $timeStampOut = 0;
        $outTime = 0;
        if (!empty($outTimeVal)) {
            $timeStampOut = strtotime($outTimeVal);
            $outTime = date('H:i:s', $timeStampOut);
        }

        $totalHours = 0;
        if (!empty($inTime) && !empty($outTime)) {
            $currentDate = date('Y-m-d');
            // $totalHoursVal=$timeStampOut-$timeStampIn;
            // $calculatedTotalHours = ($totalHoursVal/60)/60;
            // $totalHours = number_format((float)$calculatedTotalHours, 2, '.', '');

            $startTime = new \DateTime($currentDate . ' ' . $inTime);
            $endTime = new \DateTime($currentDate . ' ' . $outTime);

            $interval = $endTime->diff($startTime);

            $hoursDifference = $interval->h;
            $minutesDifference = sprintf("%02d", $interval->i);

            $totalHours = $hoursDifference . "." . $minutesDifference;
        }

        $empSalUpdateArr = array(
            'fkEmployeeId'      => $userId,
            'attendanceDate'    => $attendanceDate,
            'attendanceStatus'  => $attendanceStatus,
            'inTime'            => $inTime,
            'outTime'           => $outTime,
            'totalHours'        => $totalHours,
            'workPlace'         => $workPlace,
            'remarks'           => $remarks,
            'status'            => 1,
            'createdBy'         => $this->adminId,
            'createdDatetime'   => $this->currTimeStamp
        );

        $this->MemployeeAttendance->save($empSalUpdateArr);

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Employee Attendance not added :(");
        } else {
            $this->db->transCommit();

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = "Employee Attendance added";
            $insertLogArr['ip'] = $this->IPAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Employee Attendance has been added successfully :)");
        }

        return redirect()->back();
    }

    public function edit_employee_attendance()
    {
        $this->db->transBegin();

        $employeeAttendanceId = $this->request->getPost('employeeAttendanceId');
        $attendanceDate = $this->request->getPost('attendanceDate');
        $attendanceStatus = $this->request->getPost('attendanceStatus');
        $inTimeVal = $this->request->getPost('inTime');
        $outTimeVal = $this->request->getPost('outTime');
        $workPlace = $this->request->getPost('workPlace');
        $remarks = $this->request->getPost('remarks');
        $userId = $this->request->getPost('userId');

        $timeStampIn = 0;
        $inTime = 0;
        if (!empty($inTimeVal)) {
            $timeStampIn = strtotime($inTimeVal);
            $inTime = date('H:i:s', $timeStampIn);
        }

        $timeStampOut = 0;
        $outTime = 0;
        if (!empty($outTimeVal)) {
            $timeStampOut = strtotime($outTimeVal);
            $outTime = date('H:i:s', $timeStampOut);
        }

        $totalHours = 0;
        if (!empty($inTime) && !empty($outTime)) {
            $currentDate = date('Y-m-d');
            // $totalHoursVal=$timeStampOut-$timeStampIn;
            // $calculatedTotalHours = ($totalHoursVal/60)/60;
            // $totalHours = number_format((float)$calculatedTotalHours, 2, '.', '');

            $startTime = new \DateTime($currentDate . ' ' . $inTime);
            $endTime = new \DateTime($currentDate . ' ' . $outTime);

            $interval = $endTime->diff($startTime);

            $hoursDifference = $interval->h;
            $minutesDifference = sprintf("%02d", $interval->i);

            $totalHours = $hoursDifference . "." . $minutesDifference;
        }

        $empSalUpdateArr = array(
            'employeeAttendanceId'  => $employeeAttendanceId,
            'fkEmployeeId'          => $userId,
            'attendanceDate'        => $attendanceDate,
            'attendanceStatus'      => $attendanceStatus,
            'inTime'                => $inTime,
            'outTime'               => $outTime,
            'totalHours'            => $totalHours,
            'workPlace'             => $workPlace,
            'remarks'               => $remarks,
            'status'                => 1,
            'createdBy'             => $this->adminId,
            'createdDatetime'       => $this->currTimeStamp
        );

        $this->MemployeeAttendance->save($empSalUpdateArr);

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Employee Attendance not updated :(");
        } else {
            $this->db->transCommit();

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = "Employee Attendance updated";
            $insertLogArr['ip'] = $this->IPAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Employee Attendance has been updated successfully :)");
        }

        return redirect()->back();
    }

    public function delete_employee_attendance()
    {
        $this->db->transBegin();

        $employeeAttendanceId = $this->request->getPost('employeeAttendanceId');

        $insertArr = [
            'employeeAttendanceId'  =>  $employeeAttendanceId,
            'status'                =>  2,
            'updatedBy'             => $this->adminId,
            'updatedDatetime'       => $this->currTimeStamp
        ];

        $this->MemployeeAttendance->save($insertArr);

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Employee Attendance not deleted :(");
        } else {
            $this->db->transCommit();

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = "Employee Attendance deleted";
            $insertLogArr['ip'] = $this->IPAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Employee Attendance has been deleted successfully :)");
        }
    }

    public function employee_yearly_attendance($userId)
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $mth = $uri->getSegment(3);

        if (empty($mth))
            $mth = date('n');

        $this->data['mth'] = $mth;

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Yearly Attendance";

        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $this->data['userId'] = $userId;

        $selMth = sprintf("%02d", $mth);

        $fin_year_arr = explode("-", $this->sessDueDateYear);

        $fromYr = $fin_year_arr[0];
        $toYr = "20" . $fin_year_arr[1];

        $this->data['fromYr'] = $fromYr;
        $this->data['toYr'] = $toYr;

        $fromDate = date("Y-m-d", strtotime($fromYr . "-04-01"));
        $toDate = date("Y-m-d", strtotime($toYr . "-03-31"));

        if ($mth <= 3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;

        $generatedDateArr = array();

        for ($mt = 1; $mt <= 12; $mt++) {
            if ($mt <= 9) {
                $mth = $mt + 3;
                $yr = $fromYr;
            } else {
                $mth = $mt - 9;
                $yr = $toYr;
            }

            for ($d = 1; $d <= 31; $d++) {
                $time = mktime(12, 0, 0, $mth, $d, $yr);

                if (date('m', $time) == $mth)
                    $generatedDateArr[] = date('Y-m-d', $time);
            }
        }

        $this->data['generatedDateArr'] = $generatedDateArr;

        $userCondtnArr['user_tbl.userId'] = $userId;
        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = TRUE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserData = $query['userData'];

        $this->data['getUserData'] = $getUserData;

        $empAttendCondtn = array(
            'status'        => 1,
            'fkEmployeeId'  => $userId
        );

        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
            ->where('attendanceDate >=', $fromDate)
            ->where('attendanceDate <=', $toDate)
            ->findAll();

        $this->data['empAttendArr'] = $empAttendArr;

        $empAttendDataArr = array();

        if (!empty($empAttendArr)) {
            foreach ($empAttendArr as $e_attnd) {
                $empAttendDataArr[$e_attnd['attendanceDate']] = $e_attnd;
            }
        }

        $this->data['empAttendDataArr'] = $empAttendDataArr;

        $holidayArr = $this->Mholiday->where('status', 1)
            ->where('holidayDate >=', $fromDate)
            ->where('holidayDate <=', $toDate)
            ->findAll();

        $holidayDateArr = array();

        if (!empty($holidayArr)) {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));
        }

        $this->data['holidayDateArr'] = $holidayDateArr;

        return view('firm_panel/staff_administration/employee_yearly_attendance', $this->data);
    }

    public function employee_yearly_attendance_hours($userId)
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $mth = $uri->getSegment(3);

        if (empty($mth))
            $mth = date('n');

        $this->data['mth'] = $mth;

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Yearly Attendance";

        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $this->data['userId'] = $userId;

        $selMth = sprintf("%02d", $mth);

        $fin_year_arr = explode("-", $this->sessDueDateYear);

        $fromYr = $fin_year_arr[0];
        $toYr = "20" . $fin_year_arr[1];

        $this->data['fromYr'] = $fromYr;
        $this->data['toYr'] = $toYr;

        $fromDate = date("Y-m-d", strtotime($fromYr . "-04-01"));
        $toDate = date("Y-m-d", strtotime($toYr . "-03-31"));

        if ($mth <= 3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;

        $generatedDateArr = array();

        for ($mt = 1; $mt <= 12; $mt++) {
            if ($mt <= 9) {
                $mth = $mt + 3;
                $yr = $fromYr;
            } else {
                $mth = $mt - 9;
                $yr = $toYr;
            }

            for ($d = 1; $d <= 31; $d++) {
                $time = mktime(12, 0, 0, $mth, $d, $yr);

                if (date('m', $time) == $mth)
                    $generatedDateArr[] = date('Y-m-d', $time);
            }
        }

        $this->data['generatedDateArr'] = $generatedDateArr;

        $userCondtnArr['user_tbl.userId'] = $userId;
        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = TRUE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserData = $query['userData'];

        $this->data['getUserData'] = $getUserData;

        $empAttendCondtn = array(
            'status'        => 1,
            'fkEmployeeId'  => $userId
        );

        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
            ->where('attendanceDate >=', $fromDate)
            ->where('attendanceDate <=', $toDate)
            ->findAll();

        $this->data['empAttendArr'] = $empAttendArr;

        $empAttendDataArr = array();

        if (!empty($empAttendArr)) {
            foreach ($empAttendArr as $e_attnd) {
                $empAttendDataArr[$e_attnd['attendanceDate']] = $e_attnd;
            }
        }

        $this->data['empAttendDataArr'] = $empAttendDataArr;

        $holidayArr = $this->Mholiday->where('status', 1)
            ->where('holidayDate >=', $fromDate)
            ->where('holidayDate <=', $toDate)
            ->findAll();

        $holidayDateArr = array();

        if (!empty($holidayArr)) {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));
        }

        $this->data['holidayDateArr'] = $holidayDateArr;

        return view('firm_panel/staff_administration/employee_yearly_attendance_hours', $this->data);
    }

    public function all_employees_attendance()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $mth = $uri->getSegment(2);

        if (empty($mth))
            $mth = date('n');

        $this->data['mth'] = $mth;

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "All Employees Attendance";

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

        $fromDate = date("Y-m-d", strtotime($fromYr . "-" . $selMth . "-01"));
        $toDate = date("Y-m-d", strtotime($toYr . "-" . $selMth . "-31"));

        if ($mth <= 3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;

        $generatedDateArr = array();

        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $selMth, $d, $selYr);

            if (date('m', $time) == $selMth)
                $generatedDateArr[] = date('Y-m-d', $time);
        }

        $this->data['generatedDateArr'] = $generatedDateArr;

        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = FALSE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserData = $query['userData'];

        $this->data['getUserData'] = $getUserData;

        $empAttendCondtn = array(
            'status'        => 1
        );

        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
            ->where('attendanceDate >=', $fromDate)
            ->where('attendanceDate <=', $toDate)
            ->findAll();

        $this->data['empAttendArr'] = $empAttendArr;

        $empAttendDataArr = array();

        if (!empty($empAttendArr)) {
            foreach ($empAttendArr as $e_attnd) {
                $empAttendDataArr[$e_attnd['fkEmployeeId']][$e_attnd['attendanceDate']] = $e_attnd;
            }
        }

        $this->data['empAttendDataArr'] = $empAttendDataArr;

        $holidayArr = $this->Mholiday->where('status', 1)
            ->where('holidayDate >=', $fromDate)
            ->where('holidayDate <=', $toDate)
            ->findAll();

        $holidayDateArr = array();

        if (!empty($holidayArr)) {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));
        }

        $this->data['holidayDateArr'] = $holidayDateArr;

        return view('firm_panel/staff_administration/all_employees_attendance', $this->data);
    }

    public function all_employees_attendance_hours()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $mth = $uri->getSegment(2);

        if (empty($mth))
            $mth = date('n');

        $this->data['mth'] = $mth;

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "All Employees Attendance";

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

        $fromDate = date("Y-m-d", strtotime($fromYr . "-" . $selMth . "-01"));
        $toDate = date("Y-m-d", strtotime($toYr . "-" . $selMth . "-31"));

        if ($mth <= 3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;

        $generatedDateArr = array();

        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $selMth, $d, $selYr);

            if (date('m', $time) == $selMth)
                $generatedDateArr[] = date('Y-m-d', $time);
        }

        $this->data['generatedDateArr'] = $generatedDateArr;

        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = FALSE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserData = $query['userData'];

        $this->data['getUserData'] = $getUserData;

        $empAttendCondtn = array(
            'status'        => 1
        );

        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
            ->where('attendanceDate >=', $fromDate)
            ->where('attendanceDate <=', $toDate)
            ->findAll();

        $this->data['empAttendArr'] = $empAttendArr;

        $empAttendDataArr = array();

        if (!empty($empAttendArr)) {
            foreach ($empAttendArr as $e_attnd) {
                $empAttendDataArr[$e_attnd['fkEmployeeId']][$e_attnd['attendanceDate']] = $e_attnd;
            }
        }

        $this->data['empAttendDataArr'] = $empAttendDataArr;

        $holidayArr = $this->Mholiday->where('status', 1)
            ->where('holidayDate >=', $fromDate)
            ->where('holidayDate <=', $toDate)
            ->findAll();

        $holidayDateArr = array();

        if (!empty($holidayArr)) {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));
        }

        $this->data['holidayDateArr'] = $holidayDateArr;

        return view('firm_panel/staff_administration/all_employees_attendance_hours', $this->data);
    }

    public function my_attendance()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $mth = $uri->getSegment(3);

        if (empty($mth))
            $mth = date('n');

        $this->data['mth'] = $mth;

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full', 'timepicker');
        $this->data['jsArr'] = $jsArr;

        $userId = $this->adminId;

        $pageTitle = "My Attendance";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $this->data['userId'] = $userId;

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

        $fromDate = date("Y-m-d", strtotime($selYr . "-" . $selMth . "-01"));
        $toDate = date("Y-m-d", strtotime($selYr . "-" . $selMth . "-31"));

        $generatedDateArr = array();

        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $selMth, $d, $selYr);

            if (date('m', $time) == $selMth)
                $generatedDateArr[] = date('Y-m-d', $time);
        }

        $this->data['generatedDateArr'] = $generatedDateArr;

        // dd($generatedDateArr);

        $userCondtnArr['user_tbl.userId'] = $userId;
        $userCondtnArr['user_tbl.status'] = "1";
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['user_tbl.userStaffType'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";

        $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = TRUE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserData = $query['userData'];

        $this->data['getUserData'] = $getUserData;

        $empAttendCondtn = array(
            'status'        => 1,
            'fkEmployeeId'  => $userId
        );

        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
            ->where('attendanceDate >=', $fromDate)
            ->where('attendanceDate <=', $toDate)
            ->findAll();

        $this->data['empAttendArr'] = $empAttendArr;

        $empAttendData = array();

        if (!empty($empAttendArr)) {
            foreach ($empAttendArr as $e_attnd) {
                $empAttendData[$e_attnd['attendanceDate']] = $e_attnd;
            }
        }

        $empAttendArray = array();

        if (!empty($generatedDateArr)) {
            foreach ($generatedDateArr as $e_date) {
                if (isset($empAttendData[$e_date])) {
                    $empAttendArray[$e_date] = $empAttendData[$e_date];
                } else {
                    $empAttendArray[$e_date]['attendanceDate'] = $e_date;
                }
            }
        }

        $this->data['empAttendArray'] = $empAttendArray;

        $holidayArr = $this->Mholiday->where('status', 1)
            ->where('holidayDate >=', $fromDate)
            ->where('holidayDate <=', $toDate)
            ->findAll();

        $holidayDateArr = array();
        $holidayNameArr = array();

        if (!empty($holidayArr)) {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));

            foreach ($holidayArr as $e_hlday) {
                $holidayNameArr[$e_hlday["holidayDate"]] = $e_hlday["holidayName"];
            }
        }

        $this->data['holidayDateArr'] = $holidayDateArr;
        $this->data['holidayNameArr'] = $holidayNameArr;

        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();

        $this->data['settingsArr'] = $settingsArr;

        return view('firm_panel/staff_administration/my_attendance', $this->data);
    }

    public function articleship_leave_cal($userId)
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Articleship Leave Calculator";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;
        $userDataArr = [];
        $this->data['art_lev_id'] = 0;
        $leaveCalDataArr  = [];
        if ($userId > 0) {
            $this->data['userId'] = $userId;

            $userCondtnArr['user_tbl.userId'] = $userId;
            $userCondtnArr['user_tbl.status'] = "1";

            $query = $this->Mquery->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.*", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = TRUE, $orderByArr = array(), $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $userDataArr = $query['userData'];

            $leaveCalCondtnArr['articleship_leave_tbl.fkUserId'] = $userId;
            $leaveCalCondtnArr['articleship_leave_tbl.status'] = "1";

            $leaveCalquery = $this->Mquery->getRecords($tableName = $this->articleship_leave_tbl, $colNames = "articleship_leave_tbl.*", $leaveCalCondtnArr, $likeCondtnArr = array(), $userJoinArr = array(), $singleRow = TRUE, $orderByArr = array(), $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $leaveCalDataArr = $leaveCalquery['userData'];
        } else {
            $this->data['userId'] = 0;
        }

        $this->data['userData'] = $userDataArr;
        $this->data['leaveCalDataArr'] = $leaveCalDataArr;

        return view('firm_panel/staff_administration/articleship_leave_cal', $this->data);
    }

    public function hierarchy_chart()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $pageTitle = "Hierarchy Chart";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $userCondtnArr['staff_types.status'] = 1;
        $userCondtnArr['user_tbl.status'] = 1;
        $userCondtnArr['user_tbl.isOldUser'] = 2;
        $userOrderByArr['staff_types.seqNo'] = "ASC";
        $userOrderByArr['staff_types.staff_type_id'] = "ASC";
        $userOrderByArr['user_tbl.userDesgn'] = "ASC";
        $userJoinArr[] = array("tbl" => $this->user_tbl, "condtn" => 'user_tbl.userStaffType=staff_types.staff_type_id', "type" => "left");

        $query = $this->Mcommon->getRecords($tableName = $this->staff_types, $colNames = "staff_types.staff_type_name, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userStaffType, user_tbl.userDesgn", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = $userJoinArr, $singleRow = FALSE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getUserData = $query['userData'];
        $resultArray = [];
        foreach ($getUserData as $row) {
            $resultArray[$row['staff_type_name']][] = $row;
        }
        $this->data['getUserData'] = $resultArray;

        return view('firm_panel/staff_administration/hierarchy_chart', $this->data);
    }

    public function payslip($userId)
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $pageTitle = "Payslip";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;
        $viewPage = $this->request->getGet('viewPage');

        setlocale(LC_MONETARY, 'en_IN');
        ini_set('memory_limit', '-1');
        $firmDetails = $this->Mfirm->select('ca_firm_tbl.*, profession_type_tbl.profession_type_name, states.stateName, cities.cityName')
            ->join('states', 'states.stateId=ca_firm_tbl.caFirmStateId AND states.status=1', 'left')
            ->join('cities', 'cities.cityId=ca_firm_tbl.caFirmCityId AND cities.status=1', 'left')
            ->join('profession_type_tbl', 'profession_type_tbl.profession_type_id=ca_firm_tbl.caFirmProfession AND profession_type_tbl.status=1', 'left')
            ->where('ca_firm_tbl.status', 1)
            ->where('ca_firm_tbl.caFirmStatus', 1)
            ->where('ca_firm_tbl.isVerified', 1)
            ->where('ca_firm_tbl.isTermsAgree', 1)
            ->where('ca_firm_tbl.caFirmCompanyKey !=', "")
            ->where('ca_firm_tbl.caFirmId', $this->sessCaFirmId)
            ->get()
            ->getRowArray();

        $this->data['firmDetails'] = $firmDetails;

        return view('firm_panel/staff_administration/payslip', $this->data);

        // Create an instance of Dompdf with options
        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);

        // Load your HTML content
        $html = view('firm_panel/staff_administration/payslip', $this->data);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($contxt);

        if ($viewPage == 1)
            return $html;
        // Load the HTML into Dompdf
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Get the generated PDF content
        $output = $dompdf->output();
        // Create a response with PDF content
        $response = $this->response
            ->setStatusCode(200)
            ->setContentType('application/pdf')
            ->setBody($output);

        return $response;
    }

    public function all_staff()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $getCurrTab = $this->request->getGet('getCurrTab');

        if (!empty($getCurrTab))
            $tab = $getCurrTab;
        else
            $tab = 1;

        $this->data['currTab'] = $tab;
        if ($tab == 1) {
            $pageTitle = " All Staff";
        } elseif ($tab == 2) {
            $pageTitle = " Current Staff";
        } elseif ($tab == 3) {
            $pageTitle = " Articleship";
        } elseif ($tab == 4) {
            $pageTitle = " Chartered Accountants";
        }
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $this->data['tabList'] = array(
            array(
                "tabId" => "1",
                "tabName" => "All Staff",
            ),
            array(
                "tabId" => "2",
                "tabName" => "Current Staff",
            ),
            array(
                "tabId" => "3",
                "tabName" => "Articleship",
            ),
            array(
                "tabId" => "4",
                "tabName" => "Chartered Accountants",
            )
        );

        $getArticlehsipData = [];
        $getCAData = [];
        if ($tab == 1 || $tab == 2) {
            $userCondtnArr['staff_types.status'] = 1;
            $userCondtnArr['user_tbl.status'] = 1;
            $userCondtnArr['user_tbl.isOldUser'] = 2;
            // $userOrderByArr['staff_types.staff_type_id'] = "ASC";
            // $userOrderByArr['user_tbl.userDesgn'] = "ASC";
            $userOrderByArr['user_tbl.userFullName'] = "ASC";
            $userJoinArr[] = array("tbl" => $this->user_tbl, "condtn" => 'user_tbl.userStaffType=staff_types.staff_type_id', "type" => "left");
            $query = $this->Mcommon->getRecords($tableName = $this->staff_types, $colNames = "staff_types.staff_type_name, user_tbl.userId,user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userStaffType, user_tbl.userDesgn", $userCondtnArr, $likeCondtnArr = array(), $userJoinArr = $userJoinArr, $singleRow = FALSE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $getUserData = $query['userData'];
        }

        if ($tab == 1 || $tab == 3) {
            $articlehshipCondtnArr['articleship_staff_tbl.status'] = 1;

            $articlehshipOrderByArr['articleship_staff_tbl.art_staff_name'] = "ASC";

            $articlehshipQuery = $this->Mquery->getRecords($tableName = $this->articleship_staff_tbl, $colNames = "articleship_staff_tbl.art_staff_id as userId,articleship_staff_tbl.art_staff_name as userFullName, articleship_staff_tbl.art_staff_name_of_principle, articleship_staff_tbl.art_staff_reg_no, articleship_staff_tbl.art_staff_membership_no, articleship_staff_tbl.art_staff_img, articleship_staff_tbl.art_staff_date_commencement, articleship_staff_tbl.art_staff_date_intimation_icai, articleship_staff_tbl.art_staff_date_suppl_art, articleship_staff_tbl.art_staff_date_completion_art, articleship_staff_tbl.art_staff_year_completion_inter_ca, articleship_staff_tbl.art_staff_year_completion_final_ca, articleship_staff_tbl.art_staff_job_status, articleship_staff_tbl.art_staff_remark", $articlehshipCondtnArr, $likeCondtnArr = array(), $JoinArr = array(), $singleRow = FALSE, $articlehshipOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $getArticlehsipData = $articlehshipQuery['userData'];
        }

        if ($tab == 1 || $tab == 4) {
            $caCondtnArr['chartered_accuntant_tbl.status'] = 1;
            $caOrderByArr['chartered_accuntant_tbl.ca_name'] = "ASC";

            $caQuery = $this->Mquery->getRecords($tableName = $this->chartered_accuntant_tbl, $colNames = "chartered_accuntant_tbl.ca_id as userId, chartered_accuntant_tbl.ca_name as userFullName, chartered_accuntant_tbl.ca_membership_no, chartered_accuntant_tbl.ca_img, chartered_accuntant_tbl.ca_date_commencement, chartered_accuntant_tbl.ca_date_intimation_icai, chartered_accuntant_tbl.ca_date_termination, chartered_accuntant_tbl.ca_remark,chartered_accuntant_tbl.ca_date_intimation_icai_termination", $caCondtnArr, $likeCondtnArr = array(), $JoinArr = array(), $singleRow = FALSE, $caOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $getCAData = $caQuery['userData'];
        }

        $getUserList = [];
        $getArticlehsipList = [];
        $getCAList = [];

        if (!empty($getUserData)) {
            foreach ($getUserData as $row) {
                $row['Type'] = "Staff";
                $getUserList[] = $row;
            }
        }

        if (!empty($getArticlehsipData)) {
            foreach ($getArticlehsipData as $row) {
                $row['Type'] = "Articleship";
                $getArticlehsipList[] = $row;
            }
        }

        if (!empty($getCAData)) {
            foreach ($getCAData as $row) {
                $row['Type'] = "CA";
                $getCAList[] = $row;
            }
        }
        if ($tab == 1) {
            if (!empty($getUserList) && !empty($getArticlehsipList) && !empty($getCAList)) {
                $result = array_merge($getUserList, $getArticlehsipList, $getCAList);
            } elseif (!empty($getUserList) && !empty($getArticlehsipList)) {
                $result = array_merge($getUserList, $getArticlehsipList);
            } elseif (!empty($getUserList) && !empty($getCAList)) {
                $result = array_merge($getUserList, $getCAList);
            } elseif (!empty($getArticlehsipList) && !empty($getCAList)) {
                $result = array_merge($getArticlehsipList, $getCAList);
            } elseif (!empty($getUserList)) {
                $result = $getUserList;
            } elseif (!empty($getArticlehsipList)) {
                $result = $getArticlehsipList;
            } elseif (!empty($getCAList)) {
                $result = $getCAList;
            }
            $staffList = $result;
        } elseif ($tab == 2) {
            $staffList = $getUserList;
        } elseif ($tab == 3) {
            $staffList = $getArticlehsipList;
        } elseif ($tab == 4) {
            $staffList = $getCAList;
        }

        $this->data['staffList'] = $staffList;

        return view('firm_panel/staff_administration/all_staff', $this->data);
    }

    public function ca_staff()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = " Chartered Accountants";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $getCAData = [];

        $caCondtnArr['chartered_accuntant_tbl.status'] = 1;
        $caOrderByArr['chartered_accuntant_tbl.ca_date_commencement'] = "DESC";

        $caQuery = $this->Mquery->getRecords($tableName = $this->chartered_accuntant_tbl, $colNames = "chartered_accuntant_tbl.ca_id as userId, chartered_accuntant_tbl.ca_name as userFullName, chartered_accuntant_tbl.ca_membership_no, chartered_accuntant_tbl.ca_img, chartered_accuntant_tbl.ca_date_commencement, chartered_accuntant_tbl.ca_date_intimation_icai, chartered_accuntant_tbl.ca_date_termination, chartered_accuntant_tbl.ca_remark,chartered_accuntant_tbl.ca_date_intimation_icai_termination", $caCondtnArr, $likeCondtnArr = array(), $JoinArr = array(), $singleRow = FALSE, $caOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getCAData = $caQuery['userData'];
        $getCAList = [];
        if (!empty($getCAData)) {
            foreach ($getCAData as $row) {
                $row['Type'] = "CA";
                $getCAList[] = $row;
            }
        }

        $staffList = $getCAList;

        $this->data['staffList'] = $staffList;

        return view('firm_panel/staff_administration/ca_staff', $this->data);
    }

    public function articleship_staff()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = " Articleship";

        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $getArticlehsipData = [];

        $articlehshipCondtnArr['articleship_staff_tbl.status'] = 1;

        $articlehshipOrderByArr['articleship_staff_tbl.art_staff_date_commencement'] = "DESC";

        $articlehshipQuery = $this->Mquery->getRecords($tableName = $this->articleship_staff_tbl, $colNames = "articleship_staff_tbl.art_staff_id as userId,articleship_staff_tbl.art_staff_name as userFullName, articleship_staff_tbl.art_staff_name_of_principle, articleship_staff_tbl.art_staff_reg_no, articleship_staff_tbl.art_staff_membership_no, articleship_staff_tbl.art_staff_img, articleship_staff_tbl.art_staff_date_commencement, articleship_staff_tbl.art_staff_date_intimation_icai, articleship_staff_tbl.art_staff_date_suppl_art, articleship_staff_tbl.art_staff_date_completion_art, articleship_staff_tbl.art_staff_year_completion_inter_ca, articleship_staff_tbl.art_staff_year_completion_final_ca, articleship_staff_tbl.art_staff_job_status, articleship_staff_tbl.art_staff_remark", $articlehshipCondtnArr, $likeCondtnArr = array(), $JoinArr = array(), $singleRow = FALSE, $articlehshipOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getArticlehsipData = $articlehshipQuery['userData'];

        $getArticlehsipList = [];

        if (!empty($getArticlehsipData)) {
            foreach ($getArticlehsipData as $row) {
                $row['Type'] = "Articleship";
                $getArticlehsipList[] = $row;
            }
        }

        $staffList = $getArticlehsipList;

        $this->data['staffList'] = $staffList;

        return view('firm_panel/staff_administration/articleship_staff', $this->data);
    }

    public function create_chartered_accountant($user_id)
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Create Chartered Accountant";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        return view('firm_panel/staff_administration/add_chartered_accountant', $this->data);
    }

    public function create_articleship($user_id)
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Details of Articled/Audit Assistant";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        return view('firm_panel/staff_administration/add_articleship_staff', $this->data);
    }


    public function expense_list()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Expense Vouchers";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $getExpData = [];
        // print_r($this->session->get());die();

        $ExpCondtnArr['expense_voucher_tbl.status'] = 1;
        $ExpOrderByArr['expense_voucher_tbl.exp_bill_no'] = "ASC";
        $ExpOrderByArr['expense_voucher_tbl.fk_user_id'] = $this->sessUserId;

        $ExpQuery = $this->Mquery->getRecords($tableName = $this->expense_voucher_tbl, $colNames = "expense_voucher_tbl.exp_id, expense_voucher_tbl.exp_head, expense_voucher_tbl.exp_doc, expense_voucher_tbl.exp_bill_no, expense_voucher_tbl.exp_date, expense_voucher_tbl.exp_details, expense_voucher_tbl.exp_amt,expense_voucher_tbl.fk_user_id", $ExpCondtnArr, $likeCondtnArr = array(), $JoinArr = array(), $singleRow = FALSE, $ExpOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getExpData = $ExpQuery['userData'];

        $this->data['getExpData'] = $getExpData;

        return view('firm_panel/staff_administration/expense_voucher_list', $this->data);
    }

    public function expense_vouchers($exp_id)
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageAction = $exp_id > 0 ? "Update" : "Add";
        $pageTitle = $pageAction . " Expense Voucher";

        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = $pageTitle;

        $this->data['navArr'] = $navArr;

        $getExpData = [];

        if (!empty($exp_id) && $exp_id > 0) {
            $ExpCondtnArr['expense_voucher_tbl.exp_id'] = $exp_id;
            $ExpCondtnArr['expense_voucher_tbl.status'] = 1;
            $ExpOrderByArr['expense_voucher_tbl.exp_bill_no'] = "ASC";

            $ExpQuery = $this->Mquery->getRecords($tableName = $this->expense_voucher_tbl, $colNames = "expense_voucher_tbl.exp_id, expense_voucher_tbl.exp_head, expense_voucher_tbl.exp_doc, expense_voucher_tbl.exp_bill_no, expense_voucher_tbl.exp_date, expense_voucher_tbl.exp_details, expense_voucher_tbl.exp_amt,expense_voucher_tbl.fk_user_id", $ExpCondtnArr, $likeCondtnArr = array(), $JoinArr = array(), $singleRow = TRUE, $ExpOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

            $getExpData = $ExpQuery['userData'];
        }

        $this->data['getExpData'] = $getExpData;

        $this->data['exp_id'] = $exp_id;

        $userCondtnArr['user_tbl.status'] = 1;
        $userCondtnArr['user_tbl.isOldUser'] = 2;

        $userOrderByArr['user_tbl.userFullName'] = "ASC";

        $query = $this->Mcommon->getRecords($tableName = $this->user_tbl, $colNames = "user_tbl.userId,user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userStaffType, user_tbl.userDesgn", $userCondtnArr, $likeCondtnArr = array(), $joinArr = array(), $singleRow = FALSE, $userOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $userList = $query['userData'];

        $this->data['userList'] = $userList;

        return view('firm_panel/staff_administration/expense_voucher', $this->data);
    }

    public function save_articleship_leave_cal()
    {
        // dd($this->request->getPost('userId'));
        $this->db->transBegin();

        $userId = $this->request->getPost('userId');
        $art_lev_id = $this->request->getPost('art_lev_id');
        $start_date = $this->request->getPost('start_date');
        $completion_date = $this->request->getPost('completion_date');
        $tot_no_days = $this->request->getPost('tot_no_days');
        $tot_leave_taken = $this->request->getPost('tot_leave_taken');
        $ca_exam_leave = $this->request->getPost('ca_exam_leave');
        $gmcs_course = $this->request->getPost('gmcs_course');
        $itt_training = $this->request->getPost('itt_training');
        $seminar = $this->request->getPost('seminar');
        $other_leave = $this->request->getPost('other_leave');
        $final_leave_amt = $this->request->getPost('final_leave_amt');
        $weekends = $this->request->getPost('weekends');
        $holidays = $this->request->getPost('holidays');
        $netLeaveTaken = $this->request->getPost('netLeaveTaken');
        $no_days = $this->request->getPost('no_days');
        $less_net_leave_taken = $this->request->getPost('less_net_leave_taken');
        $daysActuallyServed = $this->request->getPost('daysActuallyServed');
        $allowableSix = $this->request->getPost('allowableSix');
        $net_leave_takenabove = $this->request->getPost('net_leave_takenabove');
        $allowableExcessLeaveAMT = $this->request->getPost('allowableExcessLeaveAMT');

        if ($userId > 0) {
            $updateLeaveCalArr = array(
                'art_lev_id' => $art_lev_id,
                'art_lev_start_date' => date("Y-m-d", strtotime($start_date)),
                'art_lev_completion_date' => date("Y-m-d", strtotime($completion_date)),
                'art_lev_tot_no_days' => $tot_no_days,
                'art_lev_tot_lev_taken' => $tot_leave_taken,
                'art_lev_ca_exam_leave' => $ca_exam_leave,
                'art_lev_gmcs_course' => $gmcs_course,
                'art_lev_itt_training' => $itt_training,
                'art_lev_seminar' => $seminar,
                'art_lev_other_leave' => $other_leave,
                'art_lev_tot_eligible_leave' => $final_leave_amt,
                'art_lev_weekends' => $weekends,
                'art_lev_holidays' => $holidays,
                'art_lev_tot_extra_leaves' => $netLeaveTaken,
                'art_lev_net_leave_taken' => $less_net_leave_taken,
                'art_lev_days_actually_served' => $daysActuallyServed,
                'art_lev_one_sixth_allowable' => $allowableSix,
                'art_lev_allowable_excess_leave' => $allowableExcessLeaveAMT,
                'fkUserId' => $userId,
                'status' => 1,
            );
            if ($art_lev_id > 0) {
                $updateLeaveCalArr['updatedBy'] = $this->adminId;
                $updateLeaveCalArr['updatedDatetime'] = $this->currTimeStamp;
            } else {
                $updateLeaveCalArr['createdBy'] = $this->adminId;
                $updateLeaveCalArr['createdDatetime'] = $this->currTimeStamp;
            }
            // print_r($updateLeaveCalArr);
            // die('sas');
            $this->MArticleshipLeaveCal->save($updateLeaveCalArr);
        }

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Articleship Leave calculation not updated :(");
        } else {
            $this->db->transCommit();

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = "Articleship Leave calculation updated";
            $insertLogArr['ip'] = $this->IPAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Articleship Leave calculation has been updated successfully :)");
        }
        return redirect()->to(base_url('articleship-leave-cal/' . $userId));
    }
}
