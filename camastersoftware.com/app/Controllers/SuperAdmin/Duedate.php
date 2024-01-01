<?php
namespace App\Controllers\SuperAdmin;
use App\Controllers\BaseController;

class Duedate extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Due Date";

        $this->data['pageSection']=$this->section;
        
        $this->session = \Config\Services::session();
        
        $this->sessDueDateYear=$this->session->get('dueDateYear');
        
        $this->Mact = new \App\Models\Mact();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->Mstate = new \App\Models\Mstate();
        $this->Mdue_date = new \App\Models\Mdue_date();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->MorganisationType = new \App\Models\MorganisationType();
        $this->Mtaxdue = new \App\Models\Mtaxdue();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->DueDueLib = new \App\Libraries\DueDueLib();

        $tableArr=$this->TableLib->get_tables();

        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->periodicity_tbl=$tableArr['periodicity_tbl'];

        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        if($currMth<=3)
            $currYear=date('Y')-1;
        else
            $currYear=date('Y');
        
        // $currYear=date('Y');
        
        // $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        $this->dueYear=$this->sessDueDateYear;
        
        $this->data['dueYear']=$this->dueYear;
    }

    public function due_dates()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Due Dates";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $taxCalIsAdminCookie=get_cookie("taxCalIsAdminCookie");

//         if(!empty(get_cookie("taxCalStateAdminCookie")))
// 		    $taxCalStateAdminCookie=get_cookie("taxCalStateAdminCookie");
//         else
// 		    $taxCalStateAdminCookie=12;
		
// 		if(!empty(get_cookie("taxCalStateAdminCookie")))
//             $taxCalFinYearAdminCookie=get_cookie("taxCalFinYearAdminCookie");
//         else
//             $taxCalFinYearAdminCookie=$this->sessDueDateYear;

// 		if(!empty(get_cookie("taxCalFinYearValAdminCookie")))
//             $taxCalFinYearValAdminCookie=get_cookie("taxCalFinYearValAdminCookie");
//         else
//             $taxCalFinYearValAdminCookie="";

// 		if(!empty(get_cookie("taxCalTypeAdminCookie")))
//             $taxCalTypeAdminCookie=get_cookie("taxCalTypeAdminCookie");
//         else
//             $taxCalTypeAdminCookie="1";

// 		if(!empty(get_cookie("taxCalPeriodicityAdminCookie")))
//             $taxCalPeriodicityAdminCookie=get_cookie("taxCalPeriodicityAdminCookie");
//         else
//             $taxCalPeriodicityAdminCookie="";

// 		if(!empty(get_cookie("taxCalActAdminCookie")))
//             $taxCalActAdminCookie=get_cookie("taxCalActAdminCookie");
//         else
//             $taxCalActAdminCookie="";

// 		if(!empty(get_cookie("taxCalDDFAdminCookie")))
//             $taxCalDDFAdminCookie=get_cookie("taxCalDDFAdminCookie");
//         else
//             $taxCalDDFAdminCookie="";

// 		if(!empty(get_cookie("taxCalFormAdminCookie")))
//             $taxCalFormAdminCookie=get_cookie("taxCalFormAdminCookie");
//         else
//             $taxCalFormAdminCookie="";

// 		if(!empty(get_cookie("taxCalSectionAdminCookie")))
//             $taxCalSectionAdminCookie=get_cookie("taxCalSectionAdminCookie");
//         else
//             $taxCalSectionAdminCookie="";

// 		if(!empty(get_cookie("taxCalDailyAdminCookie")))
//             $taxCalDailyAdminCookie=get_cookie("taxCalDailyAdminCookie");
//         else
//             $taxCalDailyAdminCookie="";

// 		if(!empty(get_cookie("taxCalPrdMthAdminCookie")))
//             $taxCalPrdMthAdminCookie=get_cookie("taxCalPrdMthAdminCookie");
//         else
//             $taxCalPrdMthAdminCookie="";

// 		if(!empty(get_cookie("taxCalPrdYrAdminCookie")))
//             $taxCalPrdYrAdminCookie=get_cookie("taxCalPrdYrAdminCookie");
//         else
//             $taxCalPrdYrAdminCookie="";

// 		if(!empty(get_cookie("taxCalFPrdMthAdminCookie")))
//             $taxCalFPrdMthAdminCookie=get_cookie("taxCalFPrdMthAdminCookie");
//         else
//             $taxCalFPrdMthAdminCookie="";

// 		if(!empty(get_cookie("taxCalFPrdYrAdminCookie")))
//             $taxCalFPrdYrAdminCookie=get_cookie("taxCalFPrdYrAdminCookie");
//         else
//             $taxCalFPrdYrAdminCookie="";

// 		if(!empty(get_cookie("taxCalTPrdMthAdminCookie")))
//             $taxCalTPrdMthAdminCookie=get_cookie("taxCalTPrdMthAdminCookie");
//         else
//             $taxCalTPrdMthAdminCookie="";

        $taxCalSelActVal=$this->request->getGet('due_act_sel');
        
        if(!empty($taxCalSelActVal))
	        $taxCalActAdminCookie=$taxCalSelActVal;
	    else
	        $taxCalActAdminCookie=$this->request->getPost('due_act');

        $taxCalStateAdminCookie=$this->request->getPost('due_state');
	    $taxCalFinYearAdminCookie=$this->request->getPost('finYear');
	    $taxCalFinYearValAdminCookie=$this->request->getPost('finYearVal');
	    $taxCalTypeAdminCookie=$this->request->getPost('calenderType');
	    $taxCalPeriodicityAdminCookie=$this->request->getPost('periodicity');
	   // $taxCalActAdminCookie=$this->request->getPost('due_act');
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
        
        $this->data['taxCalSelActVal']=$taxCalSelActVal;
        $this->data['taxCalIsAdminCookie']=$taxCalIsAdminCookie;
        $this->data['taxCalStateAdminCookie']=$taxCalStateAdminCookie;
        $this->data['taxCalFinYearAdminCookie']=$taxCalFinYearAdminCookie;
        $this->data['taxCalTypeAdminCookie']=$taxCalTypeAdminCookie;
        $this->data['taxCalFinYearValAdminCookie']=$taxCalFinYearValAdminCookie;
        $this->data['taxCalPeriodicityAdminCookie']=$taxCalPeriodicityAdminCookie;
        $this->data['taxCalActAdminCookie']=$taxCalActAdminCookie;
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
        
        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        if(!empty($taxCalStateAdminCookie))
            $taxCondtnArr['due_date_master_tbl.due_state']=$taxCalStateAdminCookie;

        if(!empty($taxCalFinYearAdminCookie))
        {
            // $taxCondtnArr['due_date_master_tbl.finYear']=$taxCalFinYearAdminCookie;
            
            $taxYearArr=explode('-', $taxCalFinYearAdminCookie);
            
            $taxFromYear=date('Y-m-d', strtotime("01-04-".$taxYearArr[0]));
            $taxToYear=date('Y-m-d', strtotime("31-03-20".$taxYearArr[1]));
            
            $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$taxFromYear;
            $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$taxToYear;
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
        $taxJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_tbl', "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames="due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, GROUP_CONCAT(DISTINCT(organisation_type_tbl.organisation_type_name)) AS tax_payers, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, ext_due_date_master_tbl.extended_date, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_date_month, ext_due_date_master_tbl.ext_due_date_master_id, ext_due_date_master_tbl.extended_date_notes, ext_due_date_master_tbl.ext_doc_file, ext_due_date_master_tbl.is_extended, ext_due_date_master_tbl.isFirst, ext_due_date_master_tbl.next_extended_date", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
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
                    ->orderBy('act_name', 'asc')
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
        
        // print_r($dueDatesArr);
        // print_r($extDueDateArr);
        // die();

        // $this->data['extDueDateArr']=$extDueDateArr;

        return view('super_admin/due_date/due_dates', $this->data);
    }
    
    public function due_dates_old()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Add Due Date";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $dueDatesArr = $this->Mdue_date->select('due_date_master_tbl.*, act_tbl.act_name')
                    ->join('act_tbl', 'act_tbl.act_id=due_date_master_tbl.due_act', 'left')
                    ->where('due_date_master_tbl.status', 1)
                    ->findAll();

        $this->data['dueDatesArr']=$dueDatesArr;

        if(!empty(get_cookie("dueDateStateCookie")))
            $dueDateStateCookie=get_cookie("dueDateStateCookie");
        else
            $dueDateStateCookie=12;
        
        if(!empty(get_cookie("dueDateFinYearCookie")))
            $dueDateFinYearCookie=get_cookie("dueDateFinYearCookie");
        else
            $dueDateFinYearCookie=$this->dueYear;

        if(!empty(get_cookie("dueDateTypeCookie")))
            $dueDateTypeCookie=get_cookie("dueDateTypeCookie");
        else
            $dueDateTypeCookie=1;
        
        $this->data['dueDateStateCookie']=$dueDateStateCookie;
        $this->data['dueDateFinYearCookie']=$dueDateFinYearCookie;
        $this->data['dueDateTypeCookie']=$dueDateTypeCookie;

        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        if(!empty($dueDateStateCookie))
            $taxCondtnArr['due_date_master_tbl.due_state']=$dueDateStateCookie;

        if(!empty($dueDateFinYearCookie))
        {
            // $taxCondtnArr['due_date_master_tbl.finYear']=$dueDateFinYearCookie;
            
            $taxYearArr=explode('-', $dueDateFinYearCookie);
            
            $taxFromYear=date('Y-m-d', strtotime("01-04-".$taxYearArr[0]));
            $taxToYear=date('Y-m-d', strtotime("31-03-20".$taxYearArr[1]));
            
            $taxCondtnArr['due_date_master_tbl.due_date >=']=$taxFromYear;
            $taxCondtnArr['due_date_master_tbl.due_date <=']=$taxToYear;
        }

        $taxCondtnArr['due_date_master_tbl.status']=1;

        if($dueDateTypeCookie==1)
            $taxOrderByArr['act_tbl.act_name']="ASC";

        // $taxOrderByArr['due_date_master_tbl.due_date']="ASC";
        $taxOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_tbl', "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.isFirst=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames="due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_name AS act_option_name2, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, ext_due_date_master_tbl.extended_date, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_date_month, ext_due_date_master_tbl.extended_date_notes, ext_due_date_master_tbl.isFirst, ext_due_date_master_tbl.is_extended", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];

        $this->data['dueDatesArr']=$dueDatesArr;

        if(!empty($dueDatesArr))
            $dueMthsArr=array_column($dueDatesArr, 'act_due_date_month');
        else
            $dueMthsArr=array();

        $this->data['dueMthsArr']=$dueMthsArr;
        
        $extDateCondtnArr['ext_due_date_master_tbl.isFirst']=2;
        $extDateCondtnArr['ext_due_date_master_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->ext_due_date_master_tbl, $colNames="ext_due_date_master_tbl.ext_due_date_master_id, ext_due_date_master_tbl.fk_due_date_master_id, ext_due_date_master_tbl.extended_date, ext_due_date_master_tbl.extended_date_notes", $extDateCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $extDateArr=$query['userData'];
        
        $extDueDateArr=array();
        
        if(!empty($extDateArr))
        {
            foreach($extDateArr AS $e_ext_date)
            {
                $extDueDateArr[$e_ext_date['fk_due_date_master_id']][$e_ext_date['ext_due_date_master_id']]['extended_date']=$e_ext_date['extended_date'];
                $extDueDateArr[$e_ext_date['fk_due_date_master_id']][$e_ext_date['ext_due_date_master_id']]['extended_date_notes']=$e_ext_date['extended_date_notes'];
            }
        }

        $this->data['extDueDateArr']=$extDueDateArr;

        return view('super_admin/due_date/due_dates', $this->data);
    }

	public function add_form()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'ckeditor');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Add Due Date";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $actArr = $this->Mact->where('status', 1)
                    ->findAll();

        $this->data['actArr']=$actArr;

        $periodArr = $this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;
        
        $organisationTypes=$this->MorganisationType->where('organisation_type_tbl.status', 1)
                        ->findAll();

        $this->data['organisationTypes']=$organisationTypes;

        return view('super_admin/due_date/add_form', $this->data);
	}

    public function insert_due_date()
    {
        $this->db->transBegin();

        $due_state=$this->request->getPost('due_state');
        $due_act=$this->request->getPost('due_act');
        $due_date_for=$this->request->getPost('due_date_for');
        $tax_payer=$this->request->getPost('tax_payer');
        $tax_payer_id_arr=$this->request->getPost('tax_payer_id');
        $is_all_tax_payer=$this->request->getPost('is_all_tax_payer');
        $under_section=$this->request->getPost('under_section');
        $audit_app=$this->request->getPost('audit_app');
        $audit=$this->request->getPost('audit');
        $applicable_form=$this->request->getPost('applicable_form');
        $periodicity=$this->request->getPost('periodicity');
        $daily_date=date('Y-m-d', strtotime($this->request->getPost('daily_date')));
        $period_month=$this->request->getPost('period_month');
        $period_year=$this->request->getPost('period_year');
        $f_period_month=$this->request->getPost('f_period_month');
        $f_period_year=$this->request->getPost('f_period_year');
        $t_period_month=$this->request->getPost('t_period_month');
        $t_period_year=$this->request->getPost('t_period_year');
        $finYear=$this->request->getPost('finYear');
        $due_date=date('Y-m-d', strtotime($this->request->getPost('due_date')));
        $due_notes=htmlentities(htmlspecialchars($this->request->getPost('due_notes')));
        $condition=$this->request->getPost('condition');
        $orgTypes=$this->request->getPost('orgTypes');
        $file=$this->request->getFile('doc_file');
        
        $doc_file="";
        if(!empty($file->getTempName()))
        {
            if($file->isValid() && ! $file->hasMoved())
            {
                $ext=$file->guessExtension();
                
                if($ext=="pdf")
                {
                    $uploadPath=FCPATH.'uploads/admin/due_date';
    
                    $doc_file = $file->getRandomName();
                    $file->move($uploadPath, $doc_file);
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Only pdf document is accepted");
                    return redirect()->back();
                }
            }
            else
            {
                $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                return redirect()->back();
            }
        }
        
        if(empty($is_all_tax_payer))
            $is_all_tax_payer=2;
        
        $orgTypesVal="";
        
        if(!empty($orgTypes))
            $orgTypesVal="|".implode("|", $orgTypes)."|";

        $insertArr[]=[
            'due_state'=>$due_state,
            'due_act'=>$due_act,
            'due_date_for'=>$due_date_for,
            'tax_payer'=>$tax_payer,
            'is_all_tax_payer'=>$is_all_tax_payer,
            'under_section'=>$under_section,
            'audit_app'=>$audit_app,
            'audit'=>$audit,
            'applicable_form'=>$applicable_form,
            'condtn'=>$condition,
            'orgTypes'=>$orgTypesVal,
            'periodicity'=>$periodicity,
            'daily_date'=>$daily_date,
            'period_month'=>$period_month,
            'period_year'=>$period_year,
            'f_period_month'=>$f_period_month,
            'f_period_year'=>$f_period_year,
            't_period_month'=>$t_period_month,
            't_period_year'=>$t_period_year,
            'finYear'=>$finYear,
            'due_date'=>$due_date,
            'doc_file'=>$doc_file,
            'due_notes'=>$due_notes,
            'isExt'=>2,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        $query=$this->Mcommon->insert($tableName="due_date_master_tbl", $insertArr, $returnType="");

        $due_date_id=$query['lastID'];

        $extDueDateInsertArr[] = [
            'fk_due_date_master_id'=>$due_date_id,
            'extended_date'=>$due_date,
            'extended_date_notes'=>$due_notes,
            'is_extended'=>2,
            'isFirst'=>1,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        $this->Mcommon->insert($tableName=$this->ext_due_date_master_tbl, $extDueDateInsertArr, $returnType="");
        
        $taxPayerInsertArr=array();
        
        if(!empty($tax_payer_id_arr))
        {
            foreach($tax_payer_id_arr AS $e_tax_payer)
            {
                $taxPayerInsertArr[]=array(
                    'fk_due_date_id'=>$due_date_id,
                    'fk_org_type_id'=>$e_tax_payer,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                );
            }
            $this->Mcommon->insert($tableName=$this->tax_payer_due_date_map_tbl, $taxPayerInsertArr, $returnType="");
        }
        

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Due Date has not added :(");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Due Date has been added successfully :)");
        }

        return redirect()->route('superadmin/due_dates');
    }

    public function extend_due_date()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $due_date_id=$uri->getSegment(4);

        $this->data['due_date_id']=$due_date_id;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Extend Due Date";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
                    
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['due_date_master_tbl.due_date_id']=$due_date_id;
        
        $taxJoinArr[]=array("tbl"=>'act_tbl', "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'states', "condtn"=>"states.stateId=due_date_master_tbl.due_state", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'periodicity_tbl', "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames="due_date_master_tbl.*, act_tbl.act_name, states.stateName, due_date_for_tbl.act_option_name AS due_date_for_name, GROUP_CONCAT(organisation_type_tbl.organisation_type_name) AS tax_payers, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, under_section_tbl.act_option_name AS under_section_name, audit_tbl.act_option_name AS audit_name, applicable_form_tbl.act_option_name AS applicable_form_name, periodicity_tbl.periodicity_name", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=TRUE, $taxOrderByArr=array(), $taxGroupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];

        $this->data['dueDatesArr']=$dueDatesArr;

        $extDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$due_date_id;
        $extDateCondtnArr['ext_due_date_master_tbl.isFirst']=2;
        $extDateCondtnArr['ext_due_date_master_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->ext_due_date_master_tbl, $colNames="ext_due_date_master_tbl.ext_due_date_master_id, ext_due_date_master_tbl.extended_date, ext_due_date_master_tbl.extended_date_notes, ext_due_date_master_tbl.ext_doc_file", $extDateCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $extDateArr=$query['userData'];

        $this->data['extDateArr']=$extDateArr;

        return view('super_admin/due_date/extend_due_date', $this->data);
    }
    
    public function edit_due_date()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $due_date_id=$uri->getSegment(4);

        $this->data['due_date_id']=$due_date_id;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'ckeditor');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Edit Due Date";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $actArr = $this->Mact->where('status', 1)
                    ->findAll();

        $this->data['actArr']=$actArr;

        $periodArr = $this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        // $dueDatesArr = $this->Mdue_date->select('due_date_master_tbl.*, act_tbl.act_name, states.stateName, due_date_for_tbl.act_option_name AS due_date_for_name, tax_payer_tbl.act_option_name AS tax_payer_name, under_section_tbl.act_option_name AS under_section_name, audit_tbl.act_option_name AS audit_name, applicable_form_tbl.act_option_name AS applicable_form_name, periodicity_tbl.periodicity_name')
        //             ->join('act_tbl', 'act_tbl.act_id=due_date_master_tbl.due_act', 'left')
        //             ->join('states', 'states.stateId=due_date_master_tbl.due_state', 'left')
        //             ->join('act_option_map_tbl AS due_date_for_tbl', 'due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for', 'left')
        //             ->join('act_option_map_tbl AS tax_payer_tbl', 'tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer', 'left')
        //             ->join('act_option_map_tbl AS under_section_tbl', 'under_section_tbl.act_option_map_id=due_date_master_tbl.under_section', 'left')
        //             ->join('act_option_map_tbl AS audit_tbl', 'audit_tbl.act_option_map_id=due_date_master_tbl.audit', 'left')
        //             ->join('act_option_map_tbl AS applicable_form_tbl', 'applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form', 'left')
        //             ->join('periodicity_tbl', 'periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity', 'left')
        //             ->where('due_date_master_tbl.due_date_id', $due_date_id)
        //             ->where('due_date_master_tbl.status', 1)
        //             ->get()
        //             ->getRowArray();
        
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['due_date_master_tbl.due_date_id']=$due_date_id;
        
        $taxJoinArr[]=array("tbl"=>'act_tbl', "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'states', "condtn"=>"states.stateId=due_date_master_tbl.due_state", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'periodicity_tbl', "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames="due_date_master_tbl.*, act_tbl.act_name, states.stateName, due_date_for_tbl.act_option_name AS due_date_for_name, GROUP_CONCAT(organisation_type_tbl.organisation_type_id) AS tax_payer_ids, organisation_type_tbl.organisation_type_name AS act_option_name2, under_section_tbl.act_option_name AS under_section_name, audit_tbl.act_option_name AS audit_name, applicable_form_tbl.act_option_name AS applicable_form_name, periodicity_tbl.periodicity_name", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=TRUE, $taxOrderByArr=array(), $taxGroupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];

        $this->data['dueDatesArr']=$dueDatesArr;
        
        $orgTypesVal=$dueDatesArr['orgTypes'];
        $tax_payer_ids=$dueDatesArr['tax_payer_ids'];
        
        $orgTypesArr=array();
        
        if(!empty($orgTypesVal))
        {
            $orgTypesArr=explode('|', $orgTypesVal);
        }
        
        $this->data['orgTypesArr']=$orgTypesArr;
        
        $taxPayerIDArr=array();
        
        if(!empty($tax_payer_ids))
        {
            $taxPayerIDArr=explode(',', $tax_payer_ids);
        }
        
        $this->data['taxPayerIDArr']=$taxPayerIDArr;
        
        $organisationTypes=$this->MorganisationType->where('organisation_type_tbl.status', 1)
                        ->findAll();

        $this->data['organisationTypes']=$organisationTypes;

        return view('super_admin/due_date/edit_due_date', $this->data);
    }
    
    public function update_due_date()
    {
        $this->db->transBegin();

        $due_date_id=$this->request->getPost('due_date_id');
        $due_state=$this->request->getPost('due_state');
        $due_act=$this->request->getPost('due_act');
        $due_date_for=$this->request->getPost('due_date_for');
        $tax_payer=$this->request->getPost('tax_payer');
        $tax_payer_id_arr=$this->request->getPost('tax_payer_id');
        $is_all_tax_payer=$this->request->getPost('is_all_tax_payer');
        $under_section=$this->request->getPost('under_section');
        $audit_app=$this->request->getPost('audit_app');
        $audit=$this->request->getPost('audit');
        $applicable_form=$this->request->getPost('applicable_form');
        $periodicity=$this->request->getPost('periodicity');
        $daily_date=date('Y-m-d', strtotime($this->request->getPost('daily_date')));
        $period_month=$this->request->getPost('period_month');
        $period_year=$this->request->getPost('period_year');
        $f_period_month=$this->request->getPost('f_period_month');
        $f_period_year=$this->request->getPost('f_period_year');
        $t_period_month=$this->request->getPost('t_period_month');
        $t_period_year=$this->request->getPost('t_period_year');
        $finYear=$this->request->getPost('finYear');
        $due_date=date('Y-m-d', strtotime($this->request->getPost('due_date')));
        $due_notes=htmlentities(htmlspecialchars($this->request->getPost('due_notes')));
        $condition=$this->request->getPost('condition');
        $orgTypes=$this->request->getPost('orgTypes');
        $file=$this->request->getFile('edit_doc_file');
        $old_doc_file=$this->request->getPost('old_doc_file');
        
        $doc_file="";
        if(!empty($file->getTempName()))
        {
            if($file->isValid() && ! $file->hasMoved())
            {
                $ext=$file->guessExtension();
                
                if($ext=="pdf")
                {
                    $uploadPath=FCPATH.'uploads/admin/due_date';
    
                    $doc_file = $file->getRandomName();
                    $file->move($uploadPath, $doc_file);
                    
                    if(!empty($old_doc_file))
                    {
                        $delUploadFilePath=$uploadPath."/".$old_doc_file;
                        unlink($delUploadFilePath);
                    }
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Only pdf document is accepted");
                    return redirect()->back();
                }
            }
            else
            {
                $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                return redirect()->back();
            }
        }
        else
        {
            $doc_file = $old_doc_file;
        }
        
        if(empty($is_all_tax_payer))
            $is_all_tax_payer=2;
        
        $orgTypesVal="";
        
        if(!empty($orgTypes))
            $orgTypesVal="|".implode("|", $orgTypes)."|";
            
        $updateArr=[
            'due_date_id'=>$due_date_id,
            'due_state'=>$due_state,
            'due_act'=>$due_act,
            'due_date_for'=>$due_date_for,
            'tax_payer'=>$tax_payer,
            'is_all_tax_payer'=>$is_all_tax_payer,
            'under_section'=>$under_section,
            'audit_app'=>$audit_app,
            'audit'=>$audit,
            'applicable_form'=>$applicable_form,
            'condtn'=>$condition,
            'orgTypes'=>$orgTypesVal,
            'periodicity'=>$periodicity,
            'daily_date'=>$daily_date,
            'period_month'=>$period_month,
            'period_year'=>$period_year,
            'f_period_month'=>$f_period_month,
            'f_period_year'=>$f_period_year,
            't_period_month'=>$t_period_month,
            't_period_year'=>$t_period_year,
            'finYear'=>$finYear,
            'due_date'=>$due_date,
            'doc_file'=>$doc_file,
            'due_notes'=>$due_notes,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $this->Mdue_date->save($updateArr);
        
        $extDueDateUpdateArr = [
            'extended_date'=>$due_date,
            'extended_date_notes'=>$due_notes,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $extDueDateCondtnArr['ext_due_date_master_tbl.isFirst']=1;
        $extDueDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$due_date_id;

        $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $extDueDateUpdateArr, $extDueDateCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        $taxPayerUpdateArr = [
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $taxPayerCondtnArr['tax_payer_due_date_map_tbl.fk_due_date_id']=$due_date_id;

        $query=$this->Mcommon->updateData($tableName=$this->tax_payer_due_date_map_tbl, $taxPayerUpdateArr, $taxPayerCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        $taxPayerInsertArr=array();
        
        if(!empty($tax_payer_id_arr))
        {
            foreach($tax_payer_id_arr AS $e_tax_payer)
            {
                $taxPayerInsertArr[]=array(
                    'fk_due_date_id'=>$due_date_id,
                    'fk_org_type_id'=>$e_tax_payer,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                );
            }
            $this->Mcommon->insert($tableName=$this->tax_payer_due_date_map_tbl, $taxPayerInsertArr, $returnType="");
        }

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Due Date has not updated :(");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Due Date has been updated successfully :)");
        }

        return redirect()->route('superadmin/due_dates');
    }
    
    public function delete_due_date_doc_file()
	{
	    $this->db->transBegin();
        
        $due_date_id=$this->request->getPost('due_date_id');
        
        $ddCondtnArr['due_date_master_tbl.due_date_id']=$due_date_id;
        $ddCondtnArr['due_date_master_tbl.status']="1";

        $columnNames = "due_date_master_tbl.due_date_id, due_date_master_tbl.doc_file";
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames=$columnNames, $ddCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateArr=$query['userData'];
        
        if(!empty($dueDateArr))
        {
            $doc_file=$dueDateArr['doc_file'];
            
            if(!empty($doc_file))
            {
                $uploadPath=FCPATH.'uploads/admin/due_date/'.$doc_file;
                
                if(unlink($uploadPath))
                {
                    $ddUpdateArr = [
                        'doc_file'          =>  "",
                        'updatedBy'         => $this->adminId,
                        'updatedDatetime'   => $this->currTimeStamp
                    ];
        
                    $ddCondtnArr['due_date_master_tbl.due_date_id']=$due_date_id;
        
                    $query=$this->Mcommon->updateData($tableName="due_date_master_tbl", $ddUpdateArr, $ddCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Errror while deleting file :(");
                }
            }
        }
        else
        {
            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Doucument not deleted :(");
        }

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Doucument not deleted :(");
            
            return false;
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Doucument file deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Doucument has been deleted successfully :)");
            
            return true;
        }
	}

    public function update_extend_due_date()
    {
        $this->db->transBegin();

        $due_date_id=$this->request->getPost('due_date_id');
        $ext_due_date=date('Y-m-d', strtotime($this->request->getPost('ext_due_date')));
        $due_notes=$this->request->getPost('due_notes');
        $file=$this->request->getFile('ext_doc_file');
        
        $ext_doc_file="";
        if(!empty($file->getTempName()))
        {
            if($file->isValid() && ! $file->hasMoved())
            {
                $ext=$file->guessExtension();
                
                if($ext=="pdf")
                {
                    $uploadPath=FCPATH.'uploads/admin/due_date';
    
                    $ext_doc_file = $file->getRandomName();
                    $file->move($uploadPath, $ext_doc_file);
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Only pdf document is accepted");
                    return redirect()->back();
                }
            }
            else
            {
                $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                return redirect()->back();
            }
        }

        $updateArr=[
            'due_date_id'=>$due_date_id,
            'isExt'=>1,
            'ext_due_date'=>$ext_due_date,
            // 'due_notes'=>$due_notes,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $this->Mdue_date->save($updateArr);

        $extDueDateUpdateArr1 = [
            'next_extended_date'=>$ext_due_date,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $extDueDateCondtnArr1['ext_due_date_master_tbl.fk_due_date_master_id']=$due_date_id;
        $extDueDateCondtnArr1['ext_due_date_master_tbl.is_extended']=2;

        $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $extDueDateUpdateArr1, $extDueDateCondtnArr1, $likeCondtnArr=array(), $whereInArray=array());

        $extDueDateUpdateArr = [
            'is_extended'=>1,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $extDueDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$due_date_id;

        $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $extDueDateUpdateArr, $extDueDateCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        $extDueDateInsertArr[] = [
            'fk_due_date_master_id'=>$due_date_id,
            'extended_date'=>$ext_due_date,
            // 'extended_date_notes'=>$due_notes,
            'ext_doc_file'=>$ext_doc_file,
            'is_extended'=>2,
            'isFirst'=>2,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        $this->Mcommon->insert($tableName=$this->ext_due_date_master_tbl, $extDueDateInsertArr, $returnType="");

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Extended Due Date has not added :(");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Extended";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Due Date has been extended successfully :)");
        }

        return redirect()->route('superadmin/due_dates');
    }
    
    public function delete_ext_due_date_doc_file()
	{
	    $this->db->transBegin();
        
        $ext_due_date_master_id=$this->request->getPost('ext_due_date_master_id');
        
        $ddCondtnArr['ext_due_date_master_tbl.ext_due_date_master_id']=$ext_due_date_master_id;
        $ddCondtnArr['ext_due_date_master_tbl.status']="1";

        $columnNames = "ext_due_date_master_tbl.ext_due_date_master_id, ext_due_date_master_tbl.ext_doc_file";
        
        $query=$this->Mcommon->getRecords($tableName=$this->ext_due_date_master_tbl, $colNames=$columnNames, $ddCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateArr=$query['userData'];
        
        if(!empty($dueDateArr))
        {
            $ext_doc_file=$dueDateArr['ext_doc_file'];
            
            if(!empty($ext_doc_file))
            {
                $uploadPath=FCPATH.'uploads/admin/due_date/'.$ext_doc_file;
                
                if(unlink($uploadPath))
                {
                    $ddUpdateArr = [
                        'ext_doc_file'      =>  "",
                        'updatedBy'         => $this->adminId,
                        'updatedDatetime'   => $this->currTimeStamp
                    ];
        
                    $ddCondtnArr['ext_due_date_master_tbl.ext_due_date_master_id']=$ext_due_date_master_id;
        
                    $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $ddUpdateArr, $ddCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Errror while deleting file :(");
                }
            }
        }
        else
        {
            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Doucument not deleted :(");
        }

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Doucument not deleted :(");
            
            return false;
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Doucument file deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Doucument has been deleted successfully :)");
            
            return true;
        }
	}

    public function delete_due_date()
    {
        $this->db->transBegin();

        $due_date_id=$this->request->getPost('due_date_id');

        $updateArr=[
            'due_date_id'=>$due_date_id,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $this->Mdue_date->save($updateArr);
        
        $extDueDateUpdateArr = [
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $extDueDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$due_date_id;

        $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $extDueDateUpdateArr, $extDueDateCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Due Date has not deleted :(");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Due Date has been deleted successfully :)");
        }
    }
    
    public function delete_ext_due_date()
    {
        $this->db->transBegin();

        $due_date_id=$this->request->getPost('due_date_id');
        $ext_due_date_master_id=$this->request->getPost('ext_due_date_master_id');
        
        // $updateArr=[
        //     'due_date_id'=>$due_date_id,
        //     'status'=>2,
        //     'updatedBy' => $this->adminId,
        //     'updatedDatetime' => $this->currTimeStamp
        // ];

        // $this->Mdue_date->save($updateArr);
        
        $extDueDateUpdateArr = [
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $extDueDateCondtnArr['ext_due_date_master_tbl.ext_due_date_master_id']=$ext_due_date_master_id;
        $extDueDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$due_date_id;

        $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $extDueDateUpdateArr, $extDueDateCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        $extDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$due_date_id;
        // $extDateCondtnArr['ext_due_date_master_tbl.isFirst']=2;
        $extDateCondtnArr['ext_due_date_master_tbl.status']="1";
        
        $extOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="DESC";
        
        $query=$this->Mcommon->getRecords($tableName=$this->ext_due_date_master_tbl, $colNames="ext_due_date_master_tbl.ext_due_date_master_id, ext_due_date_master_tbl.extended_date, ext_due_date_master_tbl.extended_date_notes, ext_due_date_master_tbl.ext_doc_file", $extDateCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $extOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $extDateArr=$query['userData'];
        
        $last_ext_due_date_id = $extDateArr['ext_due_date_master_id'];
        
        $lastExtDueDateUpdateArr = [
            'is_extended'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $lastExtDueDateCondtnArr['ext_due_date_master_tbl.ext_due_date_master_id']=$last_ext_due_date_id;
        $lastExtDueDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$due_date_id;

        $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $lastExtDueDateUpdateArr, $lastExtDueDateCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Extended Due Date has not deleted :(");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Extended Due Date has been deleted successfully :)");
        }
    }

    public function search_due_date()
	{
	    $due_state=$this->request->getPost('due_state');
	    $finYear=$this->request->getPost('finYear');
	    $type=$this->request->getPost('type');
	    
	    $expirationTime=(int)(time()+60*60*24*100);
        
        if(empty($due_state))
            set_cookie("dueDateStateCookie", 12, $expirationTime);
        else
            set_cookie("dueDateStateCookie", $due_state, $expirationTime);

        if(empty($finYear))
            set_cookie("dueDateFinYearCookie", $this->dueYear, $expirationTime);
        else
            set_cookie("dueDateFinYearCookie", $finYear, $expirationTime);

        set_cookie("dueDateTypeCookie", $type, $expirationTime);
        
        header('Location: '.base_url('due_dates'));
	}
	
	public function reset_due_date()
	{
	    $expirationTime=(int)(time()+60*60*24*100);
        
        set_cookie("dueDateStateCookie", 12, $expirationTime);
        set_cookie("dueDateFinYearCookie", $this->dueYear, $expirationTime);
        
        header('Location: '.base_url('due_dates'));
	}
	
	public function edit_extend_due_date()
	{
	    $this->db->transBegin();

        $due_date_id=$this->request->getPost('due_date_id');
        $ext_due_date_master_id=$this->request->getPost('ext_due_date_master_id');
        $ext_due_date=date('Y-m-d', strtotime($this->request->getPost('edit_ext_due_date')));
        $file=$this->request->getFile('edit_ext_doc_file');
        $old_ext_doc_file=$this->request->getPost('old_ext_doc_file');
        
        $ext_doc_file="";
        if(!empty($file->getTempName()))
        {
            if($file->isValid() && ! $file->hasMoved())
            {
                $ext=$file->guessExtension();
                
                if($ext=="pdf")
                {
                    $uploadPath=FCPATH.'uploads/admin/due_date';
    
                    $ext_doc_file = $file->getRandomName();
                    $file->move($uploadPath, $ext_doc_file);
                    
                    if(!empty($old_ext_doc_file))
                    {
                        $delUploadFilePath=$uploadPath."/".$old_ext_doc_file;
                        unlink($delUploadFilePath);
                    }
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Only pdf document is accepted");
                    return redirect()->back();
                }
            }
            else
            {
                $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                return redirect()->back();
            }
        }
        else
        {
            $ext_doc_file = $old_ext_doc_file;
        }

        $extDueDateUpdateArr = [
            'extended_date'=>$ext_due_date,
            'ext_doc_file'=>$ext_doc_file,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
        
        $extDueDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$due_date_id;
        $extDueDateCondtnArr['ext_due_date_master_tbl.ext_due_date_master_id']=$ext_due_date_master_id;

        $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $extDueDateUpdateArr, $extDueDateCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Extended Due Date has not updated :(");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Extended";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Extended Due Date has been updated successfully :)");
        }

        return redirect()->back();
	}
	
	public function edit_doc_extend_due_date()
	{
	    $this->db->transBegin();

        $due_date_id=$this->request->getPost('due_date_id');
        $ext_due_date_master_id=$this->request->getPost('ext_due_date_master_id');
        $file=$this->request->getFile('edit_ext_doc_file');
        $old_ext_doc_file=$this->request->getPost('old_ext_doc_file');
        
        $ext_doc_file="";
        if(!empty($file->getTempName()))
        {
            if($file->isValid() && ! $file->hasMoved())
            {
                $ext=$file->guessExtension();
                
                if($ext=="pdf")
                {
                    $uploadPath=FCPATH.'uploads/admin/due_date';
    
                    $ext_doc_file = $file->getRandomName();
                    $file->move($uploadPath, $ext_doc_file);
                    
                    if(!empty($old_ext_doc_file))
                    {
                        $delUploadFilePath=$uploadPath."/".$old_ext_doc_file;
                        unlink($delUploadFilePath);
                    }
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Only pdf document is accepted");
                    return redirect()->back();
                }
            }
            else
            {
                $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                return redirect()->back();
            }
        }
        else
        {
            $ext_doc_file = $old_ext_doc_file;
        }

        $extDueDateUpdateArr = [
            'ext_doc_file'=>$ext_doc_file,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
        
        $extDueDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$due_date_id;
        $extDueDateCondtnArr['ext_due_date_master_tbl.ext_due_date_master_id']=$ext_due_date_master_id;

        $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $extDueDateUpdateArr, $extDueDateCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Document of Extended Due Date has not updated :(");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Document of ".$this->section." Extended Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Document of Extended Due Date has been updated successfully :)");
        }

        return redirect()->back();
	}
	
	function sortByOrder($a, $b) {
        if ($a['due_date_for_sort'] > $b['due_date_for_sort']) {
            return 1;
        } elseif ($a['due_date_for_sort'] < $b['due_date_for_sort']) {
            return -1;
        }
        return 0;
    }
	
	public function extended_due_dates()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Extended Due Dates";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        // Monthly
        $periodicityVal = $this->request->getPost('periodicityVal');
        
        $ddYrVal = $this->request->getPost('ddYrVal');
        $actVal = $this->request->getPost('actVal');
        
        if(empty($periodicityVal))
        {
            $periodicityVal=2;
        }
        
        if(empty($ddYrVal))
        {
            $ddYrVal=$this->sessDueDateYear;
        }
        
        $this->data['periodicityVal']=$periodicityVal;
        $this->data['ddYrVal']=$ddYrVal;
        $this->data['actVal']=$actVal;
        
        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;
        
        $dueDateForCondtn = array(
            'fk_act_id'     =>  $actVal,
            'option_type'   =>  1,
            'status'        =>  1,
        );
        
        $dueDateForArr = $this->Mact_option->where($dueDateForCondtn)
                    ->orderBy('sortBy', 'ASC')
                    ->findAll();

        $this->data['dueDateForArr']=$dueDateForArr;

        $actArr = $this->Mact->where('status', 1)
                    ->orderBy('act_name', 'asc')
                    ->findAll();

        $this->data['actArr']=$actArr;
        
        $ddYrArr=explode("-", $ddYrVal);

        $fromDueDate=date("Y-m-d", strtotime($ddYrArr[0]."-04-01"));
        $toDueDate=date("Y-m-d", strtotime("20".$ddYrArr[1]."-03-31"));

        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDueDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDueDate;
        
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.isExt']=1;
        $taxCondtnArr['ext_due_date_master_tbl.is_extended']=1;
        $taxCondtnArr['due_date_master_tbl.status']=1;

        $taxOrderByArr['due_date_for_tbl.act_option_name']="ASC";
        $taxOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";
        
        $taxJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            periodicity_tbl.periodicity_id,
            periodicity_tbl.periodcity_short_name,
            due_date_master_tbl.due_date_id,
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.doc_file,
            due_date_master_tbl.due_notes,
            ext_due_date_master_tbl.extended_date,
            ext_due_date_master_tbl.next_extended_date,
            ext_due_date_master_tbl.ext_doc_file,
            ext_due_date_master_tbl.extended_date_notes,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            due_date_for_tbl.act_option_name AS due_date_for_name,
            due_date_for_tbl.sortBy AS due_date_for_sort,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section
        ";
        
        $query=$this->Mcommon->getRecords($tableName="ext_due_date_master_tbl", $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $dueDateForDataArr=array();
        $dueDateForExtDatesArr=array();
        
        if(!empty($dueDatesArr))
        {
            foreach($dueDatesArr AS $e_dd)
            {
                $getPeriod = $this->DueDueLib->getPeriod($e_dd['due_date_id']);
                
                $ddfPeriodId = url_title($e_dd['due_date_for']."-".$getPeriod);
                
                $dueDateForDataArr[$ddfPeriodId]=array(
                    'due_date_for_name'     => $e_dd['due_date_for_name'],
                    'periodcity_short_name' => $e_dd['periodcity_short_name'],
                    'period'                => $getPeriod
                );
                
                if(empty($dueDateForExtDatesArr[$ddfPeriodId]))
                {
                    $dueDateForExtDatesArr[$ddfPeriodId][]=array(
                        'file' => $e_dd['doc_file'],
                        'note' => $e_dd['due_notes'],
                        'date' => $e_dd['extended_date']
                    );
                }
                
                if(!empty($e_dd['next_extended_date']))
                {
                    $dueDateForExtDatesArr[$ddfPeriodId][]=array(
                        'file' => $e_dd['ext_doc_file'],
                        'note' => $e_dd['extended_date_notes'],
                        'date' => $e_dd['next_extended_date']
                    );
                }
            }
        }
        
        $this->data['dueDateForDataArr']=$dueDateForDataArr;
        $this->data['dueDateForExtDatesArr']=$dueDateForExtDatesArr;
        
        return view('super_admin/due_date/extended_due_dates', $this->data);
    }
}
