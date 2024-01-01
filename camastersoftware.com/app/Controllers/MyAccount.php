<?php
namespace App\Controllers;

class MyAccount extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Maccount = new \App\Models\Maccount();
        $this->MstaffTypes = new \App\Models\MstaffTypes();
        $this->Mmenu = new \App\Models\Mmenu();
        $this->Msubmenu = new \App\Models\Msubmenu();
        $this->MmenuAccess = new \App\Models\MmenuAccess();
        $this->MsubmenuAccess = new \App\Models\MsubmenuAccess();
        $this->Mdue_date = new \App\Models\Mdue_date();
        $this->Mfeedback = new \App\Models\Mfeedback();
        $this->Mfirm = new \App\Models\Mfirm();
        $this->Mconfig = new \App\Models\Mconfig();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->feedback_tbl=$tableArr['feedback_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->announcement_tbl=$tableArr['announcement_tbl'];
        $this->staff_types=$tableArr['staff_types'];
        
        $this->section="My Account";
    }

	public function feedback_report()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Feedback Report";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        return view('firm_panel/feedback_report/form', $this->data);
	}

	public function submitFeedBack()
	{
        $isUseful=$this->request->getPost('isUseful');
        $isReliable=$this->request->getPost('isReliable');
        $isUse=$this->request->getPost('isUse');
        
        if($isUse==3)
            $notUseReason=$this->request->getPost('notUseReason');
        else
            $notUseReason="";
        
        $improvementReqd=$this->request->getPost('improvementReqd');
        $recmdToOther=$this->request->getPost('recmdToOther');
        
        if($recmdToOther==1)
        {
            $otherName=$this->request->getPost('otherName');
            $otherProfession=$this->request->getPost('otherProfession');
            $otherLocation=$this->request->getPost('otherLocation');
            $otherContactNo=$this->request->getPost('otherContactNo');
            $otherEmailAddress=$this->request->getPost('otherEmailAddress');
        }
        else
        {
            $otherName="";
            $otherProfession="";
            $otherLocation="";
            $otherContactNo="";
            $otherEmailAddress="";
        }
        
        $ratingVal=$this->request->getPost('ratingVal');

        $fdkInsertArr[] = [
            'feedbackDate'=>date('Y-m-d'),
            'staffName'=>$this->sessUserFullName,
            'fkFirmId'=>$this->sessCaFirmId,
            'isUseful'=>$isUseful,
            'isReliable'=>$isReliable,
            'isUse'=>$isUse,
            'notUseReason'=>$notUseReason,
            'improvementReqd'=>$improvementReqd,
            'recmdToOther'=>$recmdToOther,
            'otherName'=>$otherName,
            'otherProfession'=>$otherProfession,
            'otherLocation'=>$otherLocation,
            'otherContactNo'=>$otherContactNo,
            'otherEmailAddress'=>$otherEmailAddress,
            'ratingVal'=>$ratingVal,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        $query=$this->Mcommon->insert($tableName=$this->feedback_tbl, $fdkInsertArr, $returnType="");

        if($query['status']==FALSE)
        {
            $this->session->setFlashdata('flashErrorMsg', "Feedback Report has not submitted :(");

            return redirect()->route('feedback_report');
        }
        else
        {
            $insertLogArr['section']="Feedback Report";
            $insertLogArr['message']="Feedback Report submitted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Feedback Report has been submitted successfully :)");

            return redirect()->route('feedback_report');
        }
	}
	
	public function details()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="My Company Profile";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
        
        $firmDetails=$this->Mfirm->select('ca_firm_tbl.*, profession_type_tbl.profession_type_name, states.stateName, cities.cityName')
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

        $this->data['firmDetails']=$firmDetails;

        return view('firm_panel/my_account/details', $this->data);
	}
	
	public function loginDetails()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="User/Staff Logins";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $userJoinArr[]=array("tbl"=>$this->staff_types, "condtn"=>'staff_types.staff_type_id=user_tbl.userStaffType', "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userLoginName, user_tbl.userStaffType, staff_types.staff_type_name", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr, $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userDataArr=$query['userData'];

        $this->data['userDataArr']=$userDataArr;

        return view('firm_panel/my_account/loginDetails', $this->data);
	}
	
	public function caMasterDetails()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array();
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="CA-Master Details";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
        
        $caMasterData=$this->Maccount->where('status', 1)->get()->getRowArray();

        $this->data['caMasterData']=$caMasterData;

        return view('firm_panel/my_account/caMasterDetails', $this->data);
	}
	
	public function manageSettings()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Manage Settings";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
        
        $firmDetails=$this->Mfirm->select('ca_firm_tbl.*')
            ->where('ca_firm_tbl.status', 1)
            ->where('ca_firm_tbl.caFirmStatus', 1)
            ->where('ca_firm_tbl.isVerified', 1)
            ->where('ca_firm_tbl.isTermsAgree', 1)
            ->where('ca_firm_tbl.caFirmCompanyKey !=', "")
            ->where('ca_firm_tbl.caFirmId', $this->sessCaFirmId)
            ->get()
            ->getRowArray();

        $this->data['firmDetails']=$firmDetails;
        
        $ancCondtnArr['announcement_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->announcement_tbl, $colNames="announcement_tbl.*", $ancCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ancOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $ancDataArr=$query['userData'];

        $this->data['ancDataArr']=$ancDataArr;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        return view('firm_panel/my_account/manageSettings', $this->data);
	}
	
	public function updateSettings()
	{
	    $configId=$this->request->getPost('configId');
	    $showClientBirthday=$this->request->getPost('showClientBirthday');
	    $showStaffBirthday=$this->request->getPost('showStaffBirthday');
	    $clientType=$this->request->getPost('clientType');
	    $staffType=$this->request->getPost('staffType');
	    $showHolidays=$this->request->getPost('showHolidays');
	    
	    if(empty($showClientBirthday))
	        $showClientBirthday=2;
	        
	    if(empty($showStaffBirthday))
	        $showStaffBirthday=2;	   
	   
	    if($showClientBirthday==1)
	    {
    	    if(empty($clientType))
    	        $clientType=2;
	    }
	    else
	    {
	        $clientType=2;
	    }
	    
	    if($showStaffBirthday==1)
	    {
	        if(empty($staffType))
	            $staffType=2;	   
	    }
	    else
	    {
	        $staffType=2;	   
	    }
	    
	        
	    if(empty($showHolidays))
	        $showHolidays=2;
	    
	    $insertArr=[
            'configId'=>$configId,
            'showClientBirthday'=>$showClientBirthday,
            'showStaffBirthday'=>$showStaffBirthday,
            'clientType'=>$clientType,
            'staffType'=>$staffType,
            'showHolidays'=>$showHolidays,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mconfig->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Settings Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Settings has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Settings has not update :(");
	    }
	    
	    return redirect()->route('manageSettings');
	}
	
	public function announcement_settings()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Manage Announcement Settings";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
        
        $firmDetails=$this->Mfirm->select('ca_firm_tbl.*')
            ->where('ca_firm_tbl.status', 1)
            ->where('ca_firm_tbl.caFirmStatus', 1)
            ->where('ca_firm_tbl.isVerified', 1)
            ->where('ca_firm_tbl.isTermsAgree', 1)
            ->where('ca_firm_tbl.caFirmCompanyKey !=', "")
            ->where('ca_firm_tbl.caFirmId', $this->sessCaFirmId)
            ->get()
            ->getRowArray();

        $this->data['firmDetails']=$firmDetails;
        
        $ancCondtnArr['announcement_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->announcement_tbl, $colNames="announcement_tbl.*", $ancCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ancOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $ancDataArr=$query['userData'];

        $this->data['ancDataArr']=$ancDataArr;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        return view('firm_panel/my_account/settings/announcement', $this->data);
	}
	
	public function update_announcement_settings()
	{
	    $configId=$this->request->getPost('configId');
	    $showClientBirthday=$this->request->getPost('showClientBirthday');
	    $showStaffBirthday=$this->request->getPost('showStaffBirthday');
	    $clientType=$this->request->getPost('clientType');
	    $staffType=$this->request->getPost('staffType');
	    $showHolidays=$this->request->getPost('showHolidays');
	    
	    if(empty($showClientBirthday))
	        $showClientBirthday=2;
	        
	    if(empty($showStaffBirthday))
	        $showStaffBirthday=2;	   
	   
	    if($showClientBirthday==1)
	    {
    	    if(empty($clientType))
    	        $clientType=2;
	    }
	    else
	    {
	        $clientType=2;
	    }
	    
	    if($showStaffBirthday==1)
	    {
	        if(empty($staffType))
	            $staffType=2;	   
	    }
	    else
	    {
	        $staffType=2;	   
	    }
	    
	        
	    if(empty($showHolidays))
	        $showHolidays=2;
	    
	    $insertArr=[
            'configId'=>$configId,
            'showClientBirthday'=>$showClientBirthday,
            'showStaffBirthday'=>$showStaffBirthday,
            'clientType'=>$clientType,
            'staffType'=>$staffType,
            'showHolidays'=>$showHolidays,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mconfig->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Announcement Settings Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Announcement Settings has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Announcement Settings has not update :(");
	    }
	    
	    return redirect()->route('announcement-settings');
	}
	
	public function hr_settings()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('sweetalert.min', 'timepicker');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Manage HR Settings";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
        
        $firmDetails=$this->Mfirm->select('ca_firm_tbl.*')
            ->where('ca_firm_tbl.status', 1)
            ->where('ca_firm_tbl.caFirmStatus', 1)
            ->where('ca_firm_tbl.isVerified', 1)
            ->where('ca_firm_tbl.isTermsAgree', 1)
            ->where('ca_firm_tbl.caFirmCompanyKey !=', "")
            ->where('ca_firm_tbl.caFirmId', $this->sessCaFirmId)
            ->get()
            ->getRowArray();

        $this->data['firmDetails']=$firmDetails;
        
        $ancCondtnArr['announcement_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->announcement_tbl, $colNames="announcement_tbl.*", $ancCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ancOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $ancDataArr=$query['userData'];

        $this->data['ancDataArr']=$ancDataArr;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        return view('firm_panel/my_account/settings/hr', $this->data);
	}
	
	public function update_hr_settings()
	{
	    $configId=$this->request->getPost('configId');
	    $officeStartTime=$this->request->getPost('officeStartTime');
	    $officeEndTime=$this->request->getPost('officeEndTime');
	    $halfDayStartTime=$this->request->getPost('halfDayStartTime');
	    $halfDayEndTime=$this->request->getPost('halfDayEndTime');
	    
	    $insertArr=[
            'configId'          =>  $configId,
            'officeStartTime'   =>  $officeStartTime,
            'officeEndTime'     =>  $officeEndTime,
            'halfDayStartTime'  =>  $halfDayStartTime,
            'halfDayEndTime'    =>  $halfDayEndTime,
            'updatedBy'         =>  $this->adminId,
            'updatedDatetime'   =>  $this->currTimeStamp
        ];
	    
	    if($this->Mconfig->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="HR Settings Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "HR Settings has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "HR Settings has not update :(");
	    }
	    
	    return redirect()->route('hr-settings');
	}
	
	public function scheduleNotes()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Notes";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        return view('firm_panel/my_account/scheduleNotes', $this->data);
	}
	
	public function updateScheduleNotes()
	{
	    $configId=$this->request->getPost('configId');
	    $scheduleNotes=$this->request->getPost('scheduleNotes');
	    
	    $insertArr=[
            'configId'=>$configId,
            'scheduleNotes'=>$scheduleNotes,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mconfig->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Notes Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Notes has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Notes has not update :(");
	    }
	    
	    return redirect()->route('scheduleNotes');
	}
	
	public function menuAccess()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="My Details";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
        
        $this->data['staffTypesArr']=$staffTypesArr=$this->MstaffTypes->where('status', 1)->findAll();
        
        $this->data['menuNameArr']=$menuNameArr=$this->Mmenu->where('status', 1)->findAll();
        
        $this->data['subMenuNameArr']=$subMenuNameArr=$this->Msubmenu->where('status', 1)->findAll();
        
        $this->data['menuAccessArr']=$menuAccessArr=$this->MmenuAccess->where('status', 1)->findAll();
        
        $this->data['submenuAccessArr']=$submenuAccessArr=$this->MsubmenuAccess->where('status', 1)->findAll();
        
        $menuAccessArray=array();
        if(!empty($menuAccessArr))
        {
            foreach($menuAccessArr AS $e_mu_acc)
            {
                $menuAccessArray[$e_mu_acc['fkStaffTypeId']][$e_mu_acc['fkMenuId']]['accessPref']=$e_mu_acc['accessPref'];
                $menuAccessArray[$e_mu_acc['fkStaffTypeId']][$e_mu_acc['fkMenuId']]['user_menu_access_id']=$e_mu_acc['user_menu_access_id'];
            }
        }
        
        $this->data['menuAccessArray']=$menuAccessArray;
        
        $submenuAccessArray=array();
        if(!empty($submenuAccessArr))
        {
            foreach($submenuAccessArr AS $e_sbmu_acc)
            {
                $submenuAccessArray[$e_sbmu_acc['fkStaffTypeId']][$e_sbmu_acc['fkMenuId']][$e_sbmu_acc['fkSubMenuId']]['accessPref']=$e_sbmu_acc['accessPref'];
                $submenuAccessArray[$e_sbmu_acc['fkStaffTypeId']][$e_sbmu_acc['fkMenuId']][$e_sbmu_acc['fkSubMenuId']]['user_submenu_access_id']=$e_sbmu_acc['user_submenu_access_id'];
            }
        }
        
        $this->data['submenuAccessArray']=$submenuAccessArray;
        
        return view('firm_panel/my_account/menuAccess', $this->data);
	}
	
	public function updateMenuAccess()
	{
        $menuPref=$this->request->getPost('menuPref');
        $menuStaffId=$this->request->getPost('menuStaffId');
        $menuId=$this->request->getPost('menuId');
        $submenuPref=$this->request->getPost('submenuPref');
        $submenuStaffId=$this->request->getPost('submenuStaffId');
        
        // $this->MmenuAccess
        
        // $this->MmenuAccess = new \App\Models\MmenuAccess();
        // $this->MsubmenuAccess = new \App\Models\MsubmenuAccess();
        
        $user_menu_access_arr = array();
        
        if(!empty($menuPref))
        {
            foreach($menuPref AS $k_mn=>$e_mn)
            {
                $user_menu_access_arr[$k_mn]['fkMenuId']=$e_mn;
                $user_menu_access_arr[$k_mn]['fkStaffTypeId']=$menuStaffId[$k_mn];
                $user_menu_access_arr[$k_mn]['accessPref']=1;
                $user_menu_access_arr[$k_mn]['status']=1;
                $user_menu_access_arr[$k_mn]['createdBy']=$this->adminId;
                $user_menu_access_arr[$k_mn]['createdDatetime']=$this->currTimeStamp;
            }
        }
        
        $user_submenu_access_arr = array();
        
        if(!empty($submenuPref))
        {
            foreach($submenuPref AS $k_sb_mn=>$e_sb_mn)
            {
                $user_submenu_access_arr[$k_sb_mn]['fkSubMenuId']=$e_sb_mn;
                $user_submenu_access_arr[$k_sb_mn]['fkMenuId']=$menuId[$k_sb_mn];
                $user_submenu_access_arr[$k_sb_mn]['fkStaffTypeId']=$submenuStaffId[$k_sb_mn];
                $user_submenu_access_arr[$k_sb_mn]['accessPref']=1;
                $user_submenu_access_arr[$k_sb_mn]['status']=1;
                $user_submenu_access_arr[$k_sb_mn]['createdBy']=$this->adminId;
                $user_submenu_access_arr[$k_sb_mn]['createdDatetime']=$this->currTimeStamp;
            }
        }
	}
}
