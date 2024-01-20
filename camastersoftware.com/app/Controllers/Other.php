<?php
namespace App\Controllers;

class Other extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        // $this->data['layoutPath']="template/layouts/main_layout";
        $this->data['layoutPath']="template/layouts/other_layout";
        
        $this->Mact = new \App\Models\Mact();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->Mstate = new \App\Models\Mstate();
        $this->Mdue_date = new \App\Models\Mdue_date();
        $this->Mdemo = new \App\Models\Mdemo();
        $this->Motp = new \App\Models\Motp();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->Sms_lib = new \App\Libraries\Sms_lib();

        $tableArr=$this->TableLib->get_tables();

        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        if($currMth<=3)
            $currYear=date('Y')-1;
        else
            $currYear=date('Y');
        
        // $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $this->section="Demo Requests";
    }

	public function tax_calendar()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Tax Calendar";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        ini_set('memory_limit', '-1');
        
        $taxCalIsAdminCookie=get_cookie("taxCalIsAdminCookie");
        
        // if(!empty(get_cookie("taxCalStateCookie")))
        //     $taxCalStateCookie=get_cookie("taxCalStateCookie");
        // else
        //     $taxCalStateCookie=12;
        
        // if(!empty(get_cookie("taxCalFinYearCookie")))
        //     $taxCalFinYearCookie=get_cookie("taxCalFinYearCookie");
        // else
        //     $taxCalFinYearCookie=$this->dueYear;
        
        // $this->data['taxCalStateCookie']=$taxCalStateCookie;
        // $this->data['taxCalFinYearCookie']=$taxCalFinYearCookie;

        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;
        
        $taxCalStateAdminCookie=$this->request->getPost('due_state');
	    $taxCalFinYearAdminCookie=$this->request->getPost('finYear');
	    $taxCalFinYearValAdminCookie=$this->request->getPost('finYearVal');
	    $taxCalTypeAdminCookie=$this->request->getPost('calenderType');
	    $taxCalPeriodicityAdminCookie=$this->request->getPost('periodicity');
	    $taxCalActAdminCookie=$this->request->getPost('due_act');
	    $taxCalDDFAdminCookie=$this->request->getPost('due_date_for');
	    $taxCalFormAdminCookie=$this->request->getPost('applicable_form');
	    $taxCalSectionAdminCookie=$this->request->getPost('under_section');

	    $taxCalDailyAdminCookie=$this->request->getPost('daily_date');
	    $taxCalPrdMthAdminCookie=$this->request->getPost('period_month');
	    $taxCalPrdYrAdminCookie=$this->request->getPost('period_year');
	    $taxCalFPrdMthAdminCookie=$this->request->getPost('f_period_month');
	    $taxCalFPrdYrAdminCookie=$this->request->getPost('f_period_year');
	    $taxCalTPrdMthAdminCookie=$this->request->getPost('t_period_month');
	    $taxCalTPrdYrAdminCookie=$this->request->getPost('t_period_year');
	    
	    if(!empty($taxCalStateAdminCookie))
		    $taxCalStateAdminCookie=$taxCalStateAdminCookie;
        else
		    $taxCalStateAdminCookie=12;
		    
		if(!empty($taxCalFinYearAdminCookie))
            $taxCalFinYearAdminCookie=$taxCalFinYearAdminCookie;
        else
            $taxCalFinYearAdminCookie=$this->dueYear;
            
		if(!empty($taxCalTypeAdminCookie))
            $taxCalTypeAdminCookie=$taxCalTypeAdminCookie;
        else
            $taxCalTypeAdminCookie="1";
            
        $this->data['taxCalIsAdminCookie']=$taxCalIsAdminCookie;
        $this->data['taxCalStateAdminCookie']=$taxCalStateAdminCookie;
        $this->data['taxCalFinYearAdminCookie']=$taxCalFinYearAdminCookie;
        $this->data['taxCalTypeAdminCookie']=$taxCalTypeAdminCookie;
        $this->data['taxCalFinYearValAdminCookie']=$taxCalFinYearValAdminCookie;
        $this->data['taxCalPeriodicityAdminCookie']=$taxCalPeriodicityAdminCookie;
        $this->data['taxCalActAdminCookie']=$taxCalActAdminCookie;
        $this->data['taxCalDDFAdminCookie']=$taxCalDDFAdminCookie;
        $this->data['taxCalFormAdminCookie']=$taxCalFormAdminCookie;
        $this->data['taxCalSectionAdminCookie']=$taxCalSectionAdminCookie;
        $this->data['taxCalDailyAdminCookie']=$taxCalDailyAdminCookie;
        $this->data['taxCalPrdMthAdminCookie']=$taxCalPrdMthAdminCookie;
        $this->data['taxCalPrdYrAdminCookie']=$taxCalPrdYrAdminCookie;
        $this->data['taxCalFPrdMthAdminCookie']=$taxCalFPrdMthAdminCookie;
        $this->data['taxCalFPrdYrAdminCookie']=$taxCalFPrdYrAdminCookie;
        $this->data['taxCalTPrdMthAdminCookie']=$taxCalTPrdMthAdminCookie;
        $this->data['taxCalTPrdYrAdminCookie']=$taxCalTPrdYrAdminCookie;     

        if(!empty($taxCalStateAdminCookie))
            $taxCondtnArr['due_date_master_tbl.due_state']=$taxCalStateAdminCookie;

        if(!empty($taxCalFinYearAdminCookie))
        {
            // $taxCondtnArr['due_date_master_tbl.finYear']=$taxCalFinYearAdminCookie;
            
            $taxYearArr=explode('-', $taxCalFinYearAdminCookie);
            
            $taxFromYear=date('Y-m-d', strtotime("01-04-".$taxYearArr[0]));
            $taxToYear=date('Y-m-d', strtotime("31-03-20".$taxYearArr[1]));
            
            $taxCondtnArr['due_date_master_tbl.due_date >=']=$taxFromYear;
            $taxCondtnArr['due_date_master_tbl.due_date <=']=$taxToYear;
        }

        if(!empty($taxCalFinYearValAdminCookie))
            $taxCondtnArr['due_date_master_tbl.finYear']=$taxCalFinYearValAdminCookie;

        if(!empty($taxCalPeriodicityAdminCookie))
            $taxCondtnArr['due_date_master_tbl.periodicity']=$taxCalPeriodicityAdminCookie;

        if(!empty($taxCalActAdminCookie))
            $taxCondtnArr['due_date_master_tbl.due_act']=$taxCalActAdminCookie;

        if(!empty($taxCalDDFAdminCookie))
            $taxCondtnArr['due_date_master_tbl.due_date_for']=$taxCalDDFAdminCookie;

        if(!empty($taxCalFormAdminCookie))
            $taxCondtnArr['due_date_master_tbl.applicable_form']=$taxCalFormAdminCookie;

        if(!empty($taxCalSectionAdminCookie))
            $taxCondtnArr['due_date_master_tbl.under_section']=$taxCalSectionAdminCookie;

        if(!empty($taxCalDailyAdminCookie))
            $taxCondtnArr['due_date_master_tbl.daily_date']=$taxCalDailyAdminCookie;

        if(!empty($taxCalPrdMthAdminCookie))
            $taxCondtnArr['due_date_master_tbl.period_month']=$taxCalPrdMthAdminCookie;

        if(!empty($taxCalPrdYrAdminCookie))
            $taxCondtnArr['due_date_master_tbl.period_year']=$taxCalPrdYrAdminCookie;

        if(!empty($taxCalFPrdMthAdminCookie))
            $taxCondtnArr['due_date_master_tbl.f_period_month >=']=$taxCalFPrdMthAdminCookie;

        if(!empty($taxCalFPrdYrAdminCookie))
            $taxCondtnArr['due_date_master_tbl.f_period_year >=']=$taxCalFPrdYrAdminCookie;

        if(!empty($taxCalTPrdMthAdminCookie))
            $taxCondtnArr['due_date_master_tbl.t_period_month <=']=$taxCalTPrdMthAdminCookie;

        if(!empty($taxCalTPrdYrAdminCookie))
            $taxCondtnArr['due_date_master_tbl.t_period_year <=']=$taxCalTPrdYrAdminCookie;

        $taxCondtnArr['due_date_master_tbl.status']=1;

        if($taxCalTypeAdminCookie=="1")
            $taxOrderByArr['act_tbl.act_name']="ASC";
            
        // $taxOrderByArr['due_date_master_tbl.due_date']="ASC";
        $taxOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        // $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_tbl', "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames="due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, , GROUP_CONCAT(DISTINCT(organisation_type_tbl.organisation_type_name)) AS tax_payers, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, ext_due_date_master_tbl.extended_date, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_date_month, ext_due_date_master_tbl.extended_date_notes, ext_due_date_master_tbl.is_extended, ext_due_date_master_tbl.isFirst, ext_due_date_master_tbl.next_extended_date", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];

        $this->data['dueDatesArr']=$dueDatesArr;

        if(!empty($dueDatesArr))
            $dueMthsArr=array_column($dueDatesArr, 'act_due_date_month');
        else
            $dueMthsArr=array();

        $this->data['dueMthsArr']=$dueMthsArr; 
        
        $periodArr = $this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        $actArr = $this->Mact->where('status', 1)
                    ->findAll();

        $this->data['actArr']=$actArr;

        // $extDateCondtnArr['ext_due_date_master_tbl.isFirst']=2;
        // $extDateCondtnArr['ext_due_date_master_tbl.status']="1";
        
        // $query=$this->Mcommon->getRecords($tableName=$this->ext_due_date_master_tbl, $colNames="ext_due_date_master_tbl.ext_due_date_master_id, ext_due_date_master_tbl.fk_due_date_master_id, ext_due_date_master_tbl.extended_date, ext_due_date_master_tbl.extended_date_notes", $extDateCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        // $extDateArr=$query['userData'];
        
        // $extDueDateArr=array();
        
        // if(!empty($extDateArr))
        // {
        //     foreach($extDateArr AS $e_ext_date)
        //     {
        //         $extDueDateArr[$e_ext_date['fk_due_date_master_id']][$e_ext_date['ext_due_date_master_id']]['extended_date']=$e_ext_date['extended_date'];
        //         $extDueDateArr[$e_ext_date['fk_due_date_master_id']][$e_ext_date['ext_due_date_master_id']]['extended_date_notes']=$e_ext_date['extended_date_notes'];
        //     }
        // }

        // $this->data['extDueDateArr']=$extDueDateArr;

        return view('other/tax_calendar', $this->data);
	}
	
	public function add_request()
	{
        $demoReqName=$this->request->getPost('demoReqName');
        $demoReqEmail=$this->request->getPost('demoReqEmail');
        $demoReqMobile=$this->request->getPost('demoReqMobile');
        $demoMobileOTP=$this->request->getPost('demoMobileOTP');
        $ipAddress=$this->request->getIPAddress();

        $updateCondtn = [
            'mobileNo' => $demoReqMobile,
            'status' => 1
        ];

        $mobOtpData = $this->Motp->where($updateCondtn)
                        ->get()
                        ->getRowArray();

        if(!empty($mobOtpData))
        {
            $mobOtp=$mobOtpData['otp'];

            if($demoMobileOTP==$mobOtp)
            {
                $updateOTPCondtn = [
                    'mobileNo' => $demoReqMobile,
                    'status' => 1
                ];
                
                $updateOTPData = [
                    'status' => 2,
                    'updatedBy' => $this->adminId,
                    'updatedDateTime' => $this->currTimeStamp
                ];
                
                $this->Motp->where($updateOTPCondtn)
                                ->set($updateOTPData)
                                ->update();

                $insertArr=[
                    'demoReqName'=>$demoReqName,
                    'demoReqEmail'=>$demoReqEmail,
                    'demoReqMobile'=>$demoReqMobile,
                    'demoReqDateTime'=>date('Y-m-d H:i:s'),
                    'isReplied' => 2,
                    'ipAddress' => $ipAddress,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];
                
                if($this->Mdemo->save($insertArr))
                {
                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']=$this->section." Added";
                    $insertLogArr['ip']=$this->IPAddress;
                    // $insertLogArr['macAddr']=$this->macAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mcommon->insertLog($insertLogArr);
                    
                    $resData['msg']="Thank you for your demo request.";
                    $resData['status']=TRUE;
                }
                else
                {
                    $resData['msg']="Demo request not added, Please try again.";
                    $resData['status']=FALSE;
                }
            }
            else
            {
                $resData['msg']="OTP not matched, Please try again.";
                $resData['status']=FALSE;
            }
        }
        else
        {
            $resData['msg']="Something went wrong, Please try again.";
            $resData['status']=FALSE;
        }
        
        echo json_encode($resData);
	}

	public function send_otp()
	{
        $demoReqMobile=$this->request->getPost('demoReqMobile');

        $updateCondtn = [
            'mobileNo' => $demoReqMobile,
            'status' => 1
        ];
        
        $updateData = [
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDateTime' => $this->currTimeStamp
        ];
        
        $this->Motp->where($updateCondtn)
                        ->set($updateData)
                        ->update();

        $otp = rand(1111,9999);

        $insertArr=[
            'mobileNo' => $demoReqMobile,
            'otp' => $otp,
            'ipAddress' => $this->IPAddress,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        if($this->Motp->save($insertArr))
        {
            $message = 'OTP to reset password on Motorpark is '.$otp.' and is valid for 10 mins. Do not share this OTP to anyone for security purposes.';

            $smsDataArr['to'] = $demoReqMobile;
            $smsDataArr['message'] = $message;

            $smsResData=$this->Sms_lib->send($smsDataArr);

            if($smsResData['status']==TRUE)
            {
                $insertLogArr['section']=$this->section;
                $insertLogArr['message']="OTP Sent";
                $insertLogArr['ip']=$this->IPAddress;
                $insertLogArr['createdBy']=$this->adminId;
                $insertLogArr['createdDatetime']=$this->currTimeStamp;

                $this->Mcommon->insertLog($insertLogArr);
                
                $resData['msg']="OTP Sent";
                $resData['status']=TRUE;
            }
            else
            {
                $resData['msg']="Gateway error, OTP not sent.";
                $resData['status']=FALSE;
            }
        }
        else
        {
            $resData['msg']="Something went wrong, OTP not sent.";
            $resData['status']=FALSE;
        }
        
        echo json_encode($resData);
	}
}
?>