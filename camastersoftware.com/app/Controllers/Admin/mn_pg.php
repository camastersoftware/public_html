<?php namespace App\Controllers\Admin;
use \App\Controllers\BaseController;

class MainPage extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";

        $this->Mstate = new \App\Models\Mstate();
        $this->Mdue_date = new \App\Models\Mdue_date();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_act_map_tbl=$tableArr['client_act_map_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }

    public function master_data()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Master Data";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

        return view('firm_panel/mainpage/master_data', $this->data);
	}

	public function tax_calendar()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Tax Calender";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        if(!empty(get_cookie("taxCalStateAdminCookie")))
		    $taxCalStateAdminCookie=get_cookie("taxCalStateAdminCookie");
		else
		    $taxCalStateAdminCookie=12;
		
		if(!empty(get_cookie("taxCalStateAdminCookie")))
            $taxCalFinYearAdminCookie=get_cookie("taxCalFinYearAdminCookie");
        else
            $taxCalFinYearAdminCookie=$this->sessDueDateYear;

		if(!empty(get_cookie("taxCalFinYearValAdminCookie")))
            $taxCalFinYearValAdminCookie=get_cookie("taxCalFinYearValAdminCookie");
        else
            $taxCalFinYearValAdminCookie="";

		if(!empty(get_cookie("taxCalTypeAdminCookie")))
            $taxCalTypeAdminCookie=get_cookie("taxCalTypeAdminCookie");
        else
            $taxCalTypeAdminCookie="1";
        
        $this->data['taxCalStateAdminCookie']=$taxCalStateAdminCookie;
        $this->data['taxCalFinYearAdminCookie']=$taxCalFinYearAdminCookie;
        $this->data['taxCalTypeAdminCookie']=$taxCalTypeAdminCookie;
        $this->data['taxCalFinYearValAdminCookie']=$taxCalFinYearValAdminCookie;

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
            
            $taxCondtnArr['due_date_master_tbl.due_date >=']=$taxFromYear;
            $taxCondtnArr['due_date_master_tbl.due_date <=']=$taxToYear;
        }

        $taxCondtnArr['due_date_master_tbl.status']=1;

        if($taxCalTypeAdminCookie=="1")
            $taxOrderByArr['act_tbl.act_name']="ASC";
            
        // $taxOrderByArr['due_date_master_tbl.due_date']="ASC";
        $taxOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";

        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_tbl', "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames="due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_name AS act_option_name2, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, ext_due_date_master_tbl.extended_date, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_date_month, ext_due_date_master_tbl.extended_date_notes, ext_due_date_master_tbl.is_extended, ext_due_date_master_tbl.isFirst", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];

        $this->data['dueDatesArr']=$dueDatesArr;

        // print_r($dueDatesArr);
        // die();

        if(!empty($dueDatesArr))
            $dueMthsArr=array_column($dueDatesArr, 'act_due_date_month');
        else
            $dueMthsArr=array();

        $this->data['dueMthsArr']=$dueMthsArr;    

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
        
        // // print_r($dueDatesArr);
        // // print_r($extDueDateArr);
        // // die();

        // $this->data['extDueDateArr']=$extDueDateArr;

        return view('firm_panel/mainpage/tax_calendar', $this->data);
	}
	
	public function date_wise_tax_calendar()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Tax Calender";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

		if(!empty(get_cookie("taxCalStateAdminCookie")))
		    $taxCalStateAdminCookie=get_cookie("taxCalStateAdminCookie");
		else
		    $taxCalStateAdminCookie=12;
		
		if(!empty(get_cookie("taxCalStateAdminCookie")))
            $taxCalFinYearAdminCookie=get_cookie("taxCalFinYearAdminCookie");
        else
            $taxCalFinYearAdminCookie=$this->sessDueDateYear;
        
        $this->data['taxCalStateAdminCookie']=$taxCalStateAdminCookie;
        $this->data['taxCalFinYearAdminCookie']=$taxCalFinYearAdminCookie;

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
            
            $taxCondtnArr['due_date_master_tbl.due_date >=']=$taxFromYear;
            $taxCondtnArr['due_date_master_tbl.due_date <=']=$taxToYear;
        }

        $taxCondtnArr['due_date_master_tbl.status']=1;
        // $taxOrderByArr['act_tbl.act_name']="ASC";
        // $taxOrderByArr['due_date_master_tbl.due_date']="ASC";
        $taxOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";

        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_tbl', "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.isFirst=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames="due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_name AS act_option_name2, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, ext_due_date_master_tbl.extended_date, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_date_month, ext_due_date_master_tbl.extended_date_notes, ext_due_date_master_tbl.is_extended", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
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

        return view('firm_panel/mainpage/date_wise_tax_calendar', $this->data);
	}

	public function getDateActs()
	{
		$uri = service('uri');
		$this->data['uri1']=$uri1=$uri->getSegment(1);

		$jsArr=array('jquery-ui', 'perfect-scrollbar-master', 'fullcalendar', 'calendar');
		$this->data['jsArr']=$jsArr;
		
		$pageTitle="Acts";
		$this->data['pageTitle']=$pageTitle;

		$navArr=array();

		$navArr[0]['active']=true;
		$navArr[0]['title']="Acts";

		$this->data['navArr']=$navArr;

		$actDate=date('Y-m-d', strtotime($this->request->getGet('date')));
		$actDay=date('d', strtotime($this->request->getGet('date')));

		$this->data['actDate']=$actDate;
		$this->data['actDay']=$actDay;

		$dueDatesArr = $this->Mdue_date->select('due_date_master_tbl.*, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_name AS act_option_name2, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, ext_due_date_master_tbl.extended_date')
				->join('act_option_map_tbl AS due_date_for_tbl', 'due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for', 'left')
				->join('act_option_map_tbl AS tax_payer_tbl', 'tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer', 'left')
				->join('act_option_map_tbl AS under_section_tbl', 'under_section_tbl.act_option_map_id=due_date_master_tbl.under_section', 'left')
				->join('act_option_map_tbl AS audit_tbl', 'audit_tbl.act_option_map_id=due_date_master_tbl.audit', 'left')
				->join('act_option_map_tbl AS applicable_form_tbl', 'applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form', 'left')
				->join('act_tbl', 'act_tbl.act_id=due_date_master_tbl.due_act', 'left')
				->join($this->ext_due_date_master_tbl, 'ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1', 'left')
				// ->where('due_date_master_tbl.due_date', $actDate)
				->where('ext_due_date_master_tbl.extended_date', $actDate)
				->where('ext_due_date_master_tbl.is_extended', 2)
				->where('due_date_master_tbl.status', 1)
				->where('ext_due_date_master_tbl.status', 1)
				->findAll();

		$this->data['dueDatesArr']=$dueDatesArr;

		return view('firm_panel/mainpage/getDateActs', $this->data);
	}

    public function search_tax_calendar()
	{
	    $due_state=$this->request->getPost('due_state');
	    $finYear=$this->request->getPost('finYear');
	    $finYearVal=$this->request->getPost('finYearVal');
	    $calenderType=$this->request->getPost('calenderType');
	    $type=$this->request->getPost('type');
	    
	    $expirationTime=(int)(time()+60*60*24*100);
        
        if(empty($due_state))
            set_cookie("taxCalStateAdminCookie", 12, $expirationTime);
        else
            set_cookie("taxCalStateAdminCookie", $due_state, $expirationTime);

        if(empty($finYear))
            set_cookie("taxCalFinYearAdminCookie", $this->sessDueDateYear, $expirationTime);
        else
            set_cookie("taxCalFinYearAdminCookie", $finYear, $expirationTime);

        if(empty($finYearVal))
            set_cookie("taxCalFinYearValAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalFinYearValAdminCookie", $finYearVal, $expirationTime);

        if(empty($calenderType))
            set_cookie("taxCalTypeAdminCookie", "1", $expirationTime);
        else
            set_cookie("taxCalTypeAdminCookie", $calenderType, $expirationTime);
        
        // if($type==1)
        //     return redirect()->route('tax_calendar');
        // else
        //     return redirect()->route('date_wise_tax_calendar');
        
        // if($type==1)
            header('Location: '.base_url('admin/tax_calendar'));
        // else
        //     header('Location: '.base_url('admin/date_wise_tax_calendar'));
            
        // if($type==1)
        //     echo '<script>window.location.href = "'.base_url('admin/tax_calendar').'";</script>';
        // else
        //     echo '<script>window.location.href = "'.base_url('admin/date_wise_tax_calendar').'";</script>';
        // die();
	}
	
	public function reset_tax_calendar()
	{
        $type=$this->request->getGet('type');

	    $expirationTime=(int)(time()+60*60*24*100);
        
        set_cookie("taxCalStateAdminCookie", 12, $expirationTime);
        set_cookie("taxCalFinYearAdminCookie", $this->sessDueDateYear, $expirationTime);
        
        if($type==1)
            header('Location: '.base_url('admin/tax_calendar'));
        else
            header('Location: '.base_url('admin/date_wise_tax_calendar'));
        // die();
	}

    public function getMasterClientData()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Master Data Client";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

        $clientMasterData=array();

        $clientMasterData[1]['id']=1;
        $clientMasterData[1]['name']="Company Law";
        $clientMasterData[1]['type']="org";

        $clientMasterData[2]['id']=2;
        $clientMasterData[2]['name']="Limited Liability Partnership";
        $clientMasterData[2]['type']="org";

        $clientMasterData[3]['id']=3;
        $clientMasterData[3]['name']="Partnership Firms";
        $clientMasterData[3]['type']="org";

        $clientMasterData[4]['id']=4;
        $clientMasterData[4]['name']="Co-operative Societies";
        $clientMasterData[4]['type']="org";

        $clientMasterData[5]['id']=5;
        $clientMasterData[5]['name']="Charitable Trusts/Private Trusts";
        $clientMasterData[5]['type']="org";

        $clientMasterData[6]['id']=6;
        $clientMasterData[6]['name']="Income Tax";
        $clientMasterData[6]['type']="act";

        $clientMasterData[7]['id']=7;
        $clientMasterData[7]['name']="Tax Deducted at Source";
        $clientMasterData[7]['type']="act";

        $clientMasterData[8]['id']=8;
        $clientMasterData[8]['name']="Goods and Services Tax";
        $clientMasterData[8]['type']="act";

        $clientMasterData[9]['id']=9;
        $clientMasterData[9]['name']="Profession Tax-Enrollment";
        $clientMasterData[9]['type']="act";

        $clientMasterData[10]['id']=10;
        $clientMasterData[10]['name']="Profession Tax-Registration";
        $clientMasterData[10]['type']="act";

        $clientMasterData[11]['id']=11;
        $clientMasterData[11]['name']="Shops & Establishment";
        $clientMasterData[11]['type']="act";

        $this->data['clientMasterData']=$clientMasterData;

        $clientCondtnArr['client_tbl.status']=1;
        // $clientCondtnArr['client_tbl.clientRegDocument !=']="";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.*, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDataArr=$query['userData'];

        $clientActCondtnArr['client_tbl.status']=1;
        $clientActCondtnArr['client_document_map_tbl.status']=1;
        $clientActCondtnArr['client_document_map_tbl.client_document_number !=']="";

        $clientActJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id", "type"=>"left");
        $clientActJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientActJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_document_map_tbl, $colNames="client_document_map_tbl.fk_client_document_id, client_tbl.*, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, client_document_map_tbl.client_document_number", $clientActCondtnArr, $likeCondtnArr=array(), $clientActJoinArr, $singleRow=FALSE, $clientOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientActDataArr=$query['userData'];

        $clientOrgArr=array();

        if(!empty($clientDataArr))
        {
            foreach($clientDataArr AS $e_cl)
            {
                $clientOrgArr[$e_cl['clientBussOrganisationType']][$e_cl['clientId']]=$e_cl;
            }
        }

        $clientDocArr=array();

        if(!empty($clientActDataArr))
        {
            foreach($clientActDataArr AS $e_cl_act)
            {
                $clientDocArr[$e_cl_act['fk_client_document_id']][$e_cl_act['clientId']]=$e_cl_act;
            }
        }

        $this->data['clientOrgArr']=$clientOrgArr;
        $this->data['clientDocArr']=$clientDocArr; 

        return view('firm_panel/mainpage/getMasterClientData', $this->data);
    }
}
