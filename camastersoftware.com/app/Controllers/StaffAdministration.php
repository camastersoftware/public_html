<?php
namespace App\Controllers;

class StaffAdministration extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->MsalaryParameter = new \App\Models\MsalaryParameter();
        $this->MemployeeSalary = new \App\Models\MemployeeSalary();
        $this->MemployeeSalaryDivision = new \App\Models\MemployeeSalaryDivision();
        $this->MemployeeAttendance = new \App\Models\MemployeeAttendance();
        $this->Mholiday = new \App\Models\Mholiday();
        $this->Mconfig = new \App\Models\Mconfig();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->user_tbl=$tableArr['user_tbl'];
        $this->salary_parameters_tbl=$tableArr['salary_parameters_tbl'];
        $this->employee_salary_division_tbl=$tableArr['employee_salary_division_tbl'];
        $this->employee_attendance_tbl=$tableArr['employee_attendance_tbl'];
        
        $this->section="Staff Administration";
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }
    
    public function index()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Staff Management";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

        return view('firm_panel/staff_administration/home', $this->data);
	}
	
	public function emp_attendance()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Attendance";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        return view('firm_panel/staff_administration/emp_attendance', $this->data);
	}
	
	public function employees()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Employees";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        return view('firm_panel/staff_administration/employees', $this->data);
	}
	
	public function employee_salary_payable($userId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Employees";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=TRUE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserData=$query['userData'];

        $this->data['getUserData']=$getUserData;
        
        $salaryParameterArr = $this->MsalaryParameter->where('status', 1)->findAll();
        
        $salPmtArr = array();
        
        if(!empty($salaryParameterArr))
        {
            foreach($salaryParameterArr AS $e_slpmtr)
            {
                if($e_slpmtr['salaryParameterType'] == 1)
                {
                    $salPmtArr[]=$e_slpmtr;
                }
            }
        }
        
        $salDedctnArr = array();
        
        if(!empty($salaryParameterArr))
        {
            foreach($salaryParameterArr AS $e_slpmtr)
            {
                if($e_slpmtr['salaryParameterType'] == 2)
                {
                    $salDedctnArr[]=$e_slpmtr;
                }
            }
        }
        
        $this->data['salPmtArr']=$salPmtArr;
        $this->data['salDedctnArr']=$salDedctnArr;
        
        $empSalCondtn = array(
            'status' => 1,
            'fkUserId' => $userId
        );
        
        $empSalaryArr = $this->MemployeeSalary->where($empSalCondtn)->first();
        
        $this->data['empSalaryArr']=$empSalaryArr;
        
        $empSalDivisionCondtn = array(
            'status' => 1,
            'fkUserId' => $userId
        );
        
        $empSalDivisionArr = $this->MemployeeSalaryDivision->where($empSalDivisionCondtn)->findAll();
        
        $empSalDivisionDataArr = array();
        
        if(!empty($empSalDivisionArr))
        {
            foreach($empSalDivisionArr AS $e_dev)
            {
                $empSalDivisionDataArr[$e_dev['fkSalaryParameterId']]=$e_dev;
            }
        }
        
        $this->data['empSalDivisionDataArr']=$empSalDivisionDataArr;

        return view('firm_panel/staff_administration/employee_salary_payable', $this->data);
	}
	
	public function update_employee_salary_payable()
	{
	    $this->db->transBegin();
	    
	    $salaryParameterId=$this->request->getPost('salaryParameterId');
	    $empSalDivisionId=$this->request->getPost('empSalDivisionId');
	    $empSalDivisionMthAmt=$this->request->getPost('empSalDivisionMthAmt');
	    $empSalDivisionYrAmt=$this->request->getPost('empSalDivisionYrAmt');
	    $grossSalaryAmtMth=$this->request->getPost('grossSalaryAmtMth');
	    $grossSalaryAmtYr=$this->request->getPost('grossSalaryAmtYr');
	    $dedctnSalaryAmtMth=$this->request->getPost('dedctnSalaryAmtMth');
	    $dedctnSalaryAmtYr=$this->request->getPost('dedctnSalaryAmtYr');
	    $totalAmtPayableMth=$this->request->getPost('totalAmtPayableMth');
	    $totalAmtPayableYr=$this->request->getPost('totalAmtPayableYr');
	    $empSalId=$this->request->getPost('empSalId');
	    $userId=$this->request->getPost('userId');
	    
	    $empSalUpdateArr=array(
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
	    
	    if(!empty($salaryParameterId))
	    {
	        foreach($salaryParameterId AS $e_key=>$e_id)
	        {
	            $empSalDivId = $empSalDivisionId[$e_key];
	            $empSalDivMthAmt = $empSalDivisionMthAmt[$e_key];
	            $empSalDivYrAmt = $empSalDivisionYrAmt[$e_key];
	            
	            $empSalDivisionUpdateArr=array(
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
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Employee Salary Payable Information not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Employee Salary Payable Information updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Employee Salary Payable Information has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function employee_salary_payable_details($userId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Employees";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=TRUE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserData=$query['userData'];

        $this->data['getUserData']=$getUserData;
        
        $salaryParameterArr = $this->MsalaryParameter->where('status', 1)->findAll();
        
        $salPmtArr = array();
        
        if(!empty($salaryParameterArr))
        {
            foreach($salaryParameterArr AS $e_slpmtr)
            {
                if($e_slpmtr['salaryParameterType'] == 1)
                {
                    $salPmtArr[]=$e_slpmtr;
                }
            }
        }
        
        $salDedctnArr = array();
        
        if(!empty($salaryParameterArr))
        {
            foreach($salaryParameterArr AS $e_slpmtr)
            {
                if($e_slpmtr['salaryParameterType'] == 2)
                {
                    $salDedctnArr[]=$e_slpmtr;
                }
            }
        }
        
        $this->data['salPmtArr']=$salPmtArr;
        $this->data['salDedctnArr']=$salDedctnArr;
        
        $empSalCondtn = array(
            'status' => 1,
            'fkUserId' => $userId
        );
        
        $empSalaryArr = $this->MemployeeSalary->where($empSalCondtn)->first();
        
        $this->data['empSalaryArr']=$empSalaryArr;
        
        $empSalDivisionCondtn = array(
            'status' => 1,
            'fkUserId' => $userId
        );
        
        $empSalDivisionArr = $this->MemployeeSalaryDivision->where($empSalDivisionCondtn)->findAll();
        
        $empSalDivisionDataArr = array();
        
        if(!empty($empSalDivisionArr))
        {
            foreach($empSalDivisionArr AS $e_dev)
            {
                $empSalDivisionDataArr[$e_dev['fkSalaryParameterId']]=$e_dev;
            }
        }
        
        $this->data['empSalDivisionDataArr']=$empSalDivisionDataArr;

        return view('firm_panel/staff_administration/employee_salary_payable_details', $this->data);
	}
	
	public function employee_payable_summary()
	{
	    $userId="";
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Summary of Payable";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $prmSalCondtnArr['salary_parameters_tbl.status']="1";
        $prmSalOrderByArr['salary_parameters_tbl.salaryParameterId']="ASC";
        $prmSalGroupByArr = array("employee_salary_division_tbl.fkSalaryParameterId", "employee_salary_division_tbl.fkUserId");
        
        $prmSalJoinArr[]=array("tbl"=>$this->employee_salary_division_tbl, "condtn"=>"employee_salary_division_tbl.fkSalaryParameterId=salary_parameters_tbl.salaryParameterId AND employee_salary_division_tbl.status=1", "type"=>"left");
        $prmSalJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=employee_salary_division_tbl.fkUserId AND user_tbl.status=1 AND user_tbl.isOldUser=2", "type"=>"left");
        
        $columnNames="
            employee_salary_division_tbl.fkSalaryParameterId,
            employee_salary_division_tbl.fkUserId,
            employee_salary_division_tbl.empSalDivisionMthAmt,
            user_tbl.userFullName
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->salary_parameters_tbl, $colNames=$columnNames, $prmSalCondtnArr, $likeCondtnArr=array(), $prmSalJoinArr, $singleRow=FALSE, $prmSalOrderByArr, $prmSalGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $prmSalData=$query['userData'];
        
        $paramUserArr = array();
        $paramUserAmtArr = array();
        
        if(!empty($prmSalData))
        {
            foreach($prmSalData AS $e_p_sl)
            {
                $paramUserArr[$e_p_sl['fkSalaryParameterId']][]=$e_p_sl['empSalDivisionMthAmt'];
                $paramUserAmtArr[$e_p_sl['fkSalaryParameterId']][$e_p_sl['fkUserId']]=$e_p_sl['empSalDivisionMthAmt'];
            }
        }
        
        $this->data['paramUserArr']=$paramUserArr;
        $this->data['paramUserAmtArr']=$paramUserAmtArr;
        
        $salaryParameterArr = $this->MsalaryParameter->where('status', 1)->findAll();
        
        $this->data['salaryParameterArr']=$salaryParameterArr;
        
        $salPmtArr = array();
        
        if(!empty($salaryParameterArr))
        {
            foreach($salaryParameterArr AS $e_slpmtr)
            {
                if($e_slpmtr['salaryParameterType'] == 1)
                {
                    $salPmtArr[]=$e_slpmtr;
                }
            }
        }
        
        $salDedctnArr = array();
        
        if(!empty($salaryParameterArr))
        {
            foreach($salaryParameterArr AS $e_slpmtr)
            {
                if($e_slpmtr['salaryParameterType'] == 2)
                {
                    $salDedctnArr[]=$e_slpmtr;
                }
            }
        }
        
        $this->data['salPmtArr']=$salPmtArr;
        $this->data['salDedctnArr']=$salDedctnArr;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userFullName", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userArr=$query['userData'];
        
        $this->data['userArr']=$userArr;
        
        return view('firm_panel/staff_administration/employee_payable_summary', $this->data);
	}
	
	public function employee_attendance($userId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $mth=$uri->getSegment(3);
        
        if(empty($mth))
            $mth=date('n');
        
        $this->data['mth']=$mth;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full', 'timepicker');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Attendance";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['userId']=$userId;
        
        $selMth = sprintf("%02d", $mth);
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromYr=$fin_year_arr[0];
        $toYr="20".$fin_year_arr[1];
        
        $this->data['fromYr']=$fromYr;
        $this->data['toYr']=$toYr;
        
        if($mth<=3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;
            
        $fromDate=date("Y-m-d", strtotime($selYr."-".$selMth."-01"));
        $toDate=date("Y-m-d", strtotime($selYr."-".$selMth."-31"));
        
        $generatedDateArr=array();
        
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $selMth, $d, $selYr);
            
            if (date('m', $time)==$selMth)
                $generatedDateArr[]=date('Y-m-d', $time);
        }
        
        $this->data['generatedDateArr']=$generatedDateArr;
        
        $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=TRUE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserData=$query['userData'];

        $this->data['getUserData']=$getUserData;
        
        $empAttendCondtn = array(
            'status'        => 1,
            'fkEmployeeId'  => $userId
        );
        
        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
                            ->where('attendanceDate >=', $fromDate)
                            ->where('attendanceDate <=', $toDate)
                            ->findAll();
        
        $this->data['empAttendArr']=$empAttendArr;
        
        $empAttendData = array();
        
        if(!empty($empAttendArr))
        {
            foreach($empAttendArr AS $e_attnd)
            {
                $empAttendData[$e_attnd['attendanceDate']] = $e_attnd;
            }
        }
        
        $empAttendArray=array();
        
        if(!empty($generatedDateArr))
        {
            foreach($generatedDateArr AS $e_date)
            {
                if(isset($empAttendData[$e_date]))
                {
                    $empAttendArray[$e_date] = $empAttendData[$e_date];
                }
                else
                {
                    $empAttendArray[$e_date]['attendanceDate'] = $e_date;
                }
            }
        }
        
        $this->data['empAttendArray']=$empAttendArray;
        
        $holidayArr = $this->Mholiday->where('status', 1)
                        ->where('holidayDate >=', $fromDate)
                        ->where('holidayDate <=', $toDate)
                        ->findAll();
                        
        $this->data['holidayArr']=$holidayArr;
        
        $holidayDateArr = array();
        $holidayNameArr = array();

        if(!empty($holidayArr))
        {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));
            
            foreach($holidayArr AS $e_hlday)
            {
                $holidayNameArr[$e_hlday["holidayDate"]]=$e_hlday["holidayName"];
            }
        }
        
        $this->data['holidayDateArr']=$holidayDateArr;
        $this->data['holidayNameArr']=$holidayNameArr;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        return view('firm_panel/staff_administration/employee_attendance', $this->data);
	}
	
	public function add_employee_attendance()
	{
	    $this->db->transBegin();
	    
	    $attendanceDate=$this->request->getPost('attendanceDate');
	    $attendanceStatus=$this->request->getPost('attendanceStatus');
	    $inTimeVal=$this->request->getPost('inTime');
	    $outTimeVal=$this->request->getPost('outTime');
	    $workPlace=$this->request->getPost('workPlace');
	    $remarks=$this->request->getPost('remarks');
	    $userId=$this->request->getPost('userId');
	    
	    $timeStampIn=0;
	    $inTime=0;
	    if(!empty($inTimeVal))
	    {
    	    $timeStampIn=strtotime($inTimeVal);
    	    $inTime=date('H:i:s', $timeStampIn);
	    }
	    
	    $timeStampOut=0;
	    $outTime=0;
	    if(!empty($outTimeVal))
	    {
    	    $timeStampOut=strtotime($outTimeVal);
            $outTime=date('H:i:s', $timeStampOut);
	    }
        
        $totalHours=0;
        if(!empty($inTime) && !empty($outTime))
        {
            $currentDate = date('Y-m-d');
            // $totalHoursVal=$timeStampOut-$timeStampIn;
            // $calculatedTotalHours = ($totalHoursVal/60)/60;
            // $totalHours = number_format((float)$calculatedTotalHours, 2, '.', '');
            
            $startTime = new \DateTime($currentDate.' '.$inTime);
            $endTime = new \DateTime($currentDate.' '.$outTime);
            
            $interval = $endTime->diff($startTime);
            
            $hoursDifference = $interval->h;
            $minutesDifference = sprintf("%02d", $interval->i);
            
            $totalHours = $hoursDifference.".".$minutesDifference;
        }
	    
	    $empSalUpdateArr=array(
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
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Employee Attendance not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Employee Attendance added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Employee Attendance has been added successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function edit_employee_attendance()
	{
	    $this->db->transBegin();
	    
	    $employeeAttendanceId=$this->request->getPost('employeeAttendanceId');
	    $attendanceDate=$this->request->getPost('attendanceDate');
	    $attendanceStatus=$this->request->getPost('attendanceStatus');
	    $inTimeVal=$this->request->getPost('inTime');
	    $outTimeVal=$this->request->getPost('outTime');
	    $workPlace=$this->request->getPost('workPlace');
	    $remarks=$this->request->getPost('remarks');
	    $userId=$this->request->getPost('userId');
	    
	    $timeStampIn=0;
	    $inTime=0;
	    if(!empty($inTimeVal))
	    {
    	    $timeStampIn=strtotime($inTimeVal);
    	    $inTime=date('H:i:s', $timeStampIn);
	    }
	    
	    $timeStampOut=0;
	    $outTime=0;
	    if(!empty($outTimeVal))
	    {
    	    $timeStampOut=strtotime($outTimeVal);
            $outTime=date('H:i:s', $timeStampOut);
	    }
        
        $totalHours=0;
        if(!empty($inTime) && !empty($outTime))
        {
            $currentDate = date('Y-m-d');
            // $totalHoursVal=$timeStampOut-$timeStampIn;
            // $calculatedTotalHours = ($totalHoursVal/60)/60;
            // $totalHours = number_format((float)$calculatedTotalHours, 2, '.', '');
            
            $startTime = new \DateTime($currentDate.' '.$inTime);
            $endTime = new \DateTime($currentDate.' '.$outTime);
            
            $interval = $endTime->diff($startTime);
            
            $hoursDifference = $interval->h;
            $minutesDifference = sprintf("%02d", $interval->i);
            
            $totalHours = $hoursDifference.".".$minutesDifference;
        }
	    
	    $empSalUpdateArr=array(
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
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Employee Attendance not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Employee Attendance updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Employee Attendance has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function delete_employee_attendance()
	{
	    $this->db->transBegin();
	    
	    $employeeAttendanceId=$this->request->getPost('employeeAttendanceId');
	    
	    $insertArr=[
            'employeeAttendanceId'  =>  $employeeAttendanceId,
            'status'                =>  2,
            'updatedBy'             => $this->adminId,
            'updatedDatetime'       => $this->currTimeStamp
        ];
        
        $this->MemployeeAttendance->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Employee Attendance not deleted :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Employee Attendance deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Employee Attendance has been deleted successfully :)");
        }
	}
	
	public function employee_yearly_attendance($userId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $mth=$uri->getSegment(3);
        
        if(empty($mth))
            $mth=date('n');
        
        $this->data['mth']=$mth;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Yearly Attendance";
        
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['userId']=$userId;
        
        $selMth = sprintf("%02d", $mth);
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromYr=$fin_year_arr[0];
        $toYr="20".$fin_year_arr[1];
        
        $this->data['fromYr']=$fromYr;
        $this->data['toYr']=$toYr;
        
        $fromDate=date("Y-m-d", strtotime($fromYr."-04-01"));
        $toDate=date("Y-m-d", strtotime($toYr."-03-31"));
        
        if($mth<=3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;
            
        $generatedDateArr=array();
        
        for($mt=1; $mt<=12; $mt++)
        {
            if($mt<=9)
            {
                $mth=$mt+3;
                $yr=$fromYr;
            }
            else
            {
                $mth=$mt-9;
                $yr=$toYr;
            }
            
            for($d=1; $d<=31; $d++)
            {
                $time=mktime(12, 0, 0, $mth, $d, $yr);
                
                if (date('m', $time)==$mth)
                    $generatedDateArr[]=date('Y-m-d', $time);
            }
        }
        
        $this->data['generatedDateArr']=$generatedDateArr;
        
        $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=TRUE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserData=$query['userData'];

        $this->data['getUserData']=$getUserData;
        
        $empAttendCondtn = array(
            'status'        => 1,
            'fkEmployeeId'  => $userId
        );
        
        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
                            ->where('attendanceDate >=', $fromDate)
                            ->where('attendanceDate <=', $toDate)
                            ->findAll();
        
        $this->data['empAttendArr']=$empAttendArr;
        
        $empAttendDataArr = array();
        
        if(!empty($empAttendArr))
        {
            foreach($empAttendArr AS $e_attnd)
            {
                $empAttendDataArr[$e_attnd['attendanceDate']] = $e_attnd;
            }
        }
        
        $this->data['empAttendDataArr']=$empAttendDataArr;
        
        $holidayArr = $this->Mholiday->where('status', 1)
                        ->where('holidayDate >=', $fromDate)
                        ->where('holidayDate <=', $toDate)
                        ->findAll();
        
        $holidayDateArr = array();

        if(!empty($holidayArr))
        {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));
        }
        
        $this->data['holidayDateArr']=$holidayDateArr;

        return view('firm_panel/staff_administration/employee_yearly_attendance', $this->data);
	}
	
	public function employee_yearly_attendance_hours($userId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $mth=$uri->getSegment(3);
        
        if(empty($mth))
            $mth=date('n');
        
        $this->data['mth']=$mth;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Yearly Attendance";
        
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['userId']=$userId;
        
        $selMth = sprintf("%02d", $mth);
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromYr=$fin_year_arr[0];
        $toYr="20".$fin_year_arr[1];
        
        $this->data['fromYr']=$fromYr;
        $this->data['toYr']=$toYr;
        
        $fromDate=date("Y-m-d", strtotime($fromYr."-04-01"));
        $toDate=date("Y-m-d", strtotime($toYr."-03-31"));
        
        if($mth<=3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;
            
        $generatedDateArr=array();
        
        for($mt=1; $mt<=12; $mt++)
        {
            if($mt<=9)
            {
                $mth=$mt+3;
                $yr=$fromYr;
            }
            else
            {
                $mth=$mt-9;
                $yr=$toYr;
            }
            
            for($d=1; $d<=31; $d++)
            {
                $time=mktime(12, 0, 0, $mth, $d, $yr);
                
                if (date('m', $time)==$mth)
                    $generatedDateArr[]=date('Y-m-d', $time);
            }
        }
        
        $this->data['generatedDateArr']=$generatedDateArr;
        
        $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=TRUE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserData=$query['userData'];

        $this->data['getUserData']=$getUserData;
        
        $empAttendCondtn = array(
            'status'        => 1,
            'fkEmployeeId'  => $userId
        );
        
        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
                            ->where('attendanceDate >=', $fromDate)
                            ->where('attendanceDate <=', $toDate)
                            ->findAll();
        
        $this->data['empAttendArr']=$empAttendArr;
        
        $empAttendDataArr = array();
        
        if(!empty($empAttendArr))
        {
            foreach($empAttendArr AS $e_attnd)
            {
                $empAttendDataArr[$e_attnd['attendanceDate']] = $e_attnd;
            }
        }
        
        $this->data['empAttendDataArr']=$empAttendDataArr;
        
        $holidayArr = $this->Mholiday->where('status', 1)
                        ->where('holidayDate >=', $fromDate)
                        ->where('holidayDate <=', $toDate)
                        ->findAll();
        
        $holidayDateArr = array();

        if(!empty($holidayArr))
        {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));
        }
        
        $this->data['holidayDateArr']=$holidayDateArr;

        return view('firm_panel/staff_administration/employee_yearly_attendance_hours', $this->data);
	}
	
	public function all_employees_attendance()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $mth=$uri->getSegment(2);
        
        if(empty($mth))
            $mth=date('n');
        
        $this->data['mth']=$mth;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="All Employees Attendance";
        
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $selMth = sprintf("%02d", $mth);
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromYr=$fin_year_arr[0];
        $toYr="20".$fin_year_arr[1];
        
        $this->data['fromYr']=$fromYr;
        $this->data['toYr']=$toYr;
        
        $fromDate=date("Y-m-d", strtotime($fromYr."-".$selMth."-01"));
        $toDate=date("Y-m-d", strtotime($toYr."-".$selMth."-31"));
        
        if($mth<=3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;
            
        $generatedDateArr=array();
        
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $selMth, $d, $selYr);
            
            if (date('m', $time)==$selMth)
                $generatedDateArr[]=date('Y-m-d', $time);
        }
        
        $this->data['generatedDateArr']=$generatedDateArr;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserData=$query['userData'];

        $this->data['getUserData']=$getUserData;
        
        $empAttendCondtn = array(
            'status'        => 1
        );
        
        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
                            ->where('attendanceDate >=', $fromDate)
                            ->where('attendanceDate <=', $toDate)
                            ->findAll();
        
        $this->data['empAttendArr']=$empAttendArr;
        
        $empAttendDataArr = array();
        
        if(!empty($empAttendArr))
        {
            foreach($empAttendArr AS $e_attnd)
            {
                $empAttendDataArr[$e_attnd['fkEmployeeId']][$e_attnd['attendanceDate']] = $e_attnd;
            }
        }
        
        $this->data['empAttendDataArr']=$empAttendDataArr;
        
        $holidayArr = $this->Mholiday->where('status', 1)
                        ->where('holidayDate >=', $fromDate)
                        ->where('holidayDate <=', $toDate)
                        ->findAll();
        
        $holidayDateArr = array();

        if(!empty($holidayArr))
        {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));
        }
        
        $this->data['holidayDateArr']=$holidayDateArr;

        return view('firm_panel/staff_administration/all_employees_attendance', $this->data);
	}
	
	public function all_employees_attendance_hours()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $mth=$uri->getSegment(2);
        
        if(empty($mth))
            $mth=date('n');
        
        $this->data['mth']=$mth;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="All Employees Attendance";
        
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $selMth = sprintf("%02d", $mth);
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromYr=$fin_year_arr[0];
        $toYr="20".$fin_year_arr[1];
        
        $this->data['fromYr']=$fromYr;
        $this->data['toYr']=$toYr;
        
        $fromDate=date("Y-m-d", strtotime($fromYr."-".$selMth."-01"));
        $toDate=date("Y-m-d", strtotime($toYr."-".$selMth."-31"));
        
        if($mth<=3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;
            
        $generatedDateArr=array();
        
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $selMth, $d, $selYr);
            
            if (date('m', $time)==$selMth)
                $generatedDateArr[]=date('Y-m-d', $time);
        }
        
        $this->data['generatedDateArr']=$generatedDateArr;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserData=$query['userData'];

        $this->data['getUserData']=$getUserData;
        
        $empAttendCondtn = array(
            'status'        => 1
        );
        
        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
                            ->where('attendanceDate >=', $fromDate)
                            ->where('attendanceDate <=', $toDate)
                            ->findAll();
        
        $this->data['empAttendArr']=$empAttendArr;
        
        $empAttendDataArr = array();
        
        if(!empty($empAttendArr))
        {
            foreach($empAttendArr AS $e_attnd)
            {
                $empAttendDataArr[$e_attnd['fkEmployeeId']][$e_attnd['attendanceDate']] = $e_attnd;
            }
        }
        
        $this->data['empAttendDataArr']=$empAttendDataArr;
        
        $holidayArr = $this->Mholiday->where('status', 1)
                        ->where('holidayDate >=', $fromDate)
                        ->where('holidayDate <=', $toDate)
                        ->findAll();
        
        $holidayDateArr = array();

        if(!empty($holidayArr))
        {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));
        }
        
        $this->data['holidayDateArr']=$holidayDateArr;

        return view('firm_panel/staff_administration/all_employees_attendance_hours', $this->data);
	}
	
	public function my_attendance()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $mth=$uri->getSegment(3);
        
        if(empty($mth))
            $mth=date('n');
        
        $this->data['mth']=$mth;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full', 'timepicker');
        $this->data['jsArr']=$jsArr;
        
        $userId=$this->adminId;
        
        $pageTitle="My Attendance";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $this->data['userId']=$userId;
        
        $selMth = sprintf("%02d", $mth);
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromYr=$fin_year_arr[0];
        $toYr="20".$fin_year_arr[1];
        
        $this->data['fromYr']=$fromYr;
        $this->data['toYr']=$toYr;
        
        if($mth<=3)
            $selYr = $toYr;
        else
            $selYr = $fromYr;
        
        $fromDate=date("Y-m-d", strtotime($selYr."-".$selMth."-01"));
        $toDate=date("Y-m-d", strtotime($selYr."-".$selMth."-31"));
        
        $generatedDateArr=array();
        
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $selMth, $d, $selYr);
            
            if (date('m', $time)==$selMth)
                $generatedDateArr[]=date('Y-m-d', $time);
        }
        
        $this->data['generatedDateArr']=$generatedDateArr;
        
        // dd($generatedDateArr);
        
        $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=TRUE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserData=$query['userData'];

        $this->data['getUserData']=$getUserData;
        
        $empAttendCondtn = array(
            'status'        => 1,
            'fkEmployeeId'  => $userId
        );
        
        $empAttendArr = $this->MemployeeAttendance->where($empAttendCondtn)
                            ->where('attendanceDate >=', $fromDate)
                            ->where('attendanceDate <=', $toDate)
                            ->findAll();
        
        $this->data['empAttendArr']=$empAttendArr;
        
        $empAttendData = array();
        
        if(!empty($empAttendArr))
        {
            foreach($empAttendArr AS $e_attnd)
            {
                $empAttendData[$e_attnd['attendanceDate']] = $e_attnd;
            }
        }
        
        $empAttendArray=array();
        
        if(!empty($generatedDateArr))
        {
            foreach($generatedDateArr AS $e_date)
            {
                if(isset($empAttendData[$e_date]))
                {
                    $empAttendArray[$e_date] = $empAttendData[$e_date];
                }
                else
                {
                    $empAttendArray[$e_date]['attendanceDate'] = $e_date;
                }
            }
        }
        
        $this->data['empAttendArray']=$empAttendArray;
        
        $holidayArr = $this->Mholiday->where('status', 1)
                        ->where('holidayDate >=', $fromDate)
                        ->where('holidayDate <=', $toDate)
                        ->findAll();
                        
        $holidayDateArr = array();
        $holidayNameArr = array();

        if(!empty($holidayArr))
        {
            $holidayDateArr = array_unique(array_column($holidayArr, 'holidayDate'));
            
            foreach($holidayArr AS $e_hlday)
            {
                $holidayNameArr[$e_hlday["holidayDate"]]=$e_hlday["holidayName"];
            }
        }
        
        $this->data['holidayDateArr']=$holidayDateArr;
        $this->data['holidayNameArr']=$holidayNameArr;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        return view('firm_panel/staff_administration/my_attendance', $this->data);
	}
}
?>