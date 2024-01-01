<?php
namespace App\Controllers;

class MainPage extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Muser = new \App\Models\Muser();
        $this->Msalutation = new \App\Models\Msalutation();
        $this->MorganisationType = new \App\Models\MorganisationType();
        $this->Mdocument = new \App\Models\Mdocument();
        $this->Mstate = new \App\Models\Mstate();
        $this->Mact = new \App\Models\Mact();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->Mdue_date = new \App\Models\Mdue_date();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->DueDueLib = new \App\Libraries\DueDueLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->act_tbl=$tableArr['act_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->client_act_map_tbl=$tableArr['client_act_map_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->client_partner_tbl=$tableArr['client_partner_tbl'];
        $this->periodicity_tbl=$tableArr['periodicity_tbl'];
        
        $currMth=date('n');
        
        $this->currMth=$currMth;
        $this->data['currMth']=$currMth;
        
        if($currMth<=3)
            $currYear=date('Y')+1;
        else
            $currYear=date('Y');
            
        $this->currYear=$currYear;
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
    }

    public function master_data()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle=" Masters & Tax Calendar";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

        return view('firm_panel/mainpage/master_data', $this->data);
	}
	
    public function tax_calendar_menu()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle=" Tax Calendar";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

        return view('firm_panel/mainpage/tax_calendar_menu', $this->data);
	}
	
    public function act_wise_tax_calendar_old()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Act Wise Tax Calendar";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

        return view('firm_panel/mainpage/act_wise_tax_calendar_old', $this->data);
	}
	
    public function act_wise_tax_calendar()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Tax Calendar : Chart View - Financial Year-Wise";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        // Monthly
        $periodicityVal = $this->request->getPost('periodicityVal');
        
        $finYearVal = $this->request->getPost('finYearVal');
        $actVal = $this->request->getPost('actVal');
        
        if(empty($periodicityVal))
        {
            $periodicityVal=2;
        }
        
        if(empty($finYearVal))
        {
            $finYearVal=$this->sessDueDateYear;
        }
        
        $this->data['periodicityVal']=$periodicityVal;
        $this->data['finYearVal']=$finYearVal;
        $this->data['actVal']=$actVal;
        
        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;
        
        $actArr = $this->Mact->where('status', 1)
                    ->orderBy('act_name', 'asc')
                    ->findAll();

        $this->data['actArr']=$actArr;
        
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.finYear']=$finYearVal;
        // $taxCondtnArr['due_date_master_tbl.periodicity']=$periodicityVal;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;

        $taxOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');
        
        $taxJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.period_month,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.periodicity,
            periodicity_tbl.periodcity_short_name,
            ext_due_date_master_tbl.extended_date,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section
        ";
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $ddfIDArr=array();
        $dueDateForDataArr=array();
        $dueDateForWiseArr=array();
        
        if(!empty($dueDatesArr))
        {
            $ddfIDArr=array_unique(array_column($dueDatesArr, 'due_date_for'));
            foreach($dueDatesArr AS $e_dd)
            {
                $dueDateForDataArr[$e_dd['due_date_for']]=array(
                    'due_date_form' => $e_dd['due_date_form'],
                    'due_date_section' => $e_dd['due_date_section'],
                    'periodicity' => $e_dd['periodicity'],
                    'periodcity_short_name' => $e_dd['periodcity_short_name']
                );
                
                $periodicityVal=$e_dd['periodicity'];
                
                if($periodicityVal==2)
                    $period_month = $e_dd['period_month'];
                else
                    $period_month = $e_dd['f_period_month'];
                
                $dueDateForWiseArr[$e_dd['due_date_for']][$period_month]=array(
                    'extended_date' => $e_dd['extended_date']
                );
            }
        }
        
        $this->data['ddfIDArr']=$ddfIDArr;
        $this->data['dueDateForDataArr']=$dueDateForDataArr;
        $this->data['dueDateForWiseArr']=$dueDateForWiseArr;
        
        $dueDateForArr=array();
        
        if(!empty($ddfIDArr))
        {
            $dueDateForCondtn = array(
                'fk_act_id'     =>  $actVal,
                'option_type'   =>  1,
                'status'        =>  1,
            );
            
            $dueDateForArr = $this->Mact_option->where($dueDateForCondtn)
                        ->whereIn('act_option_map_id', $ddfIDArr)
                        ->orderBy('sortBy', 'ASC')
                        ->findAll();
        }
        

        $this->data['dueDateForArr']=$dueDateForArr;

        return view('firm_panel/mainpage/act_wise_tax_calendar', $this->data);
	}
	
	public function act_wise_mth_tax_calendar()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Act Wise Tax Calendar - Monthly";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        // Monthly
        $periodicityVal = $this->request->getPost('periodicityVal');
        
        $finYearVal = $this->request->getPost('finYearVal');
        $actVal = $this->request->getPost('actVal');
        
        if(empty($periodicityVal))
        {
            $periodicityVal=2;
        }
        
        if(empty($finYearVal))
        {
            $finYearVal=$this->currentFinancialYear;
        }
        
        $this->data['periodicityVal']=$periodicityVal;
        $this->data['finYearVal']=$finYearVal;
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
        
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.finYear']=$finYearVal;
        $taxCondtnArr['due_date_master_tbl.periodicity']=$periodicityVal;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;

        $taxOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.period_month,
            ext_due_date_master_tbl.extended_date,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section
        ";
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $ddfIDArr=array();
        $dueDateForDataArr=array();
        $dueDateForMthWiseArr=array();
        
        if(!empty($dueDatesArr))
        {
            $ddfIDArr=array_unique(array_column($dueDatesArr, 'due_date_for'));
            foreach($dueDatesArr AS $e_dd)
            {
                $dueDateForDataArr[$e_dd['due_date_for']]=array(
                    'due_date_form' => $e_dd['due_date_form'],
                    'due_date_section' => $e_dd['due_date_section']
                );
                
                $dueDateForMthWiseArr[$e_dd['due_date_for']][$e_dd['period_month']]=array(
                    'extended_date' => $e_dd['extended_date']
                );
            }
        }
        
        $this->data['ddfIDArr']=$ddfIDArr;
        $this->data['dueDateForDataArr']=$dueDateForDataArr;
        $this->data['dueDateForMthWiseArr']=$dueDateForMthWiseArr;

        return view('firm_panel/mainpage/act_wise_mth_tax_calendar', $this->data);
	}
	
	public function act_wise_quarter_tax_calendar()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Act Wise Tax Calendar - Quarterly";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        // Quarterly
        $periodicityVal = $this->request->getPost('periodicityVal');
        
        $finYearVal = $this->request->getPost('finYearVal');
        $actVal = $this->request->getPost('actVal');
        
        if(empty($periodicityVal))
        {
            $periodicityVal=3;
        }
        
        if(empty($finYearVal))
        {
            $finYearVal=$this->currentFinancialYear;
        }
        
        $this->data['periodicityVal']=$periodicityVal;
        $this->data['finYearVal']=$finYearVal;
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
        
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.finYear']=$finYearVal;
        $taxCondtnArr['due_date_master_tbl.periodicity']=$periodicityVal;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;

        $taxOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        
        $queryColNames = " 
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.f_period_month,
            ext_due_date_master_tbl.extended_date,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section
        ";
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $ddfIDArr=array();
        $dueDateForDataArr=array();
        $dueDateForQtrWiseArr=array();
        
        if(!empty($dueDatesArr))
        {
            $ddfIDArr=array_unique(array_column($dueDatesArr, 'due_date_for'));
            
            foreach($dueDatesArr AS $e_dd)
            {
                $dueDateForDataArr[$e_dd['due_date_for']]=array(
                    'due_date_form' => $e_dd['due_date_form'],
                    'due_date_section' => $e_dd['due_date_section']
                );
                
                $dueDateForQtrWiseArr[$e_dd['due_date_for']][$e_dd['f_period_month']]=array(
                    'extended_date' => $e_dd['extended_date']
                );
            }
        }
        
        $this->data['ddfIDArr']=$ddfIDArr;
        $this->data['dueDateForDataArr']=$dueDateForDataArr;
        $this->data['dueDateForQtrWiseArr']=$dueDateForQtrWiseArr;
        
        return view('firm_panel/mainpage/act_wise_quarter_tax_calendar', $this->data);
	}
	
	public function act_wise_half_tax_calendar()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Act Wise Tax Calendar - Half Yearly";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        // Half Yearly
        $periodicityVal = $this->request->getPost('periodicityVal');
        
        $finYearVal = $this->request->getPost('finYearVal');
        $actVal = $this->request->getPost('actVal');
        
        if(empty($periodicityVal))
        {
            $periodicityVal=4;
        }
        
        if(empty($finYearVal))
        {
            $finYearVal=$this->currentFinancialYear;
        }
        
        $this->data['periodicityVal']=$periodicityVal;
        $this->data['finYearVal']=$finYearVal;
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
        
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.finYear']=$finYearVal;
        $taxCondtnArr['due_date_master_tbl.periodicity']=$periodicityVal;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;

        $taxOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        
        $queryColNames = " 
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.f_period_month,
            ext_due_date_master_tbl.extended_date,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section
        ";
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $ddfIDArr=array();
        $dueDateForDataArr=array();
        $dueDateForHalfWiseArr=array();
        
        if(!empty($dueDatesArr))
        {
            $ddfIDArr=array_unique(array_column($dueDatesArr, 'due_date_for'));
            
            foreach($dueDatesArr AS $e_dd)
            {
                $dueDateForDataArr[$e_dd['due_date_for']]=array(
                    'due_date_form' => $e_dd['due_date_form'],
                    'due_date_section' => $e_dd['due_date_section']
                );
                
                $dueDateForHalfWiseArr[$e_dd['due_date_for']][$e_dd['f_period_month']]=array(
                    'extended_date' => $e_dd['extended_date']
                );
            }
        }
        
        $this->data['ddfIDArr']=$ddfIDArr;
        $this->data['dueDateForDataArr']=$dueDateForDataArr;
        $this->data['dueDateForHalfWiseArr']=$dueDateForHalfWiseArr;
        
        return view('firm_panel/mainpage/act_wise_half_tax_calendar', $this->data);
	}
	
	public function act_wise_year_tax_calendar()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Act Wise Tax Calendar - Yearly";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        // Yearly
        $periodicityVal = $this->request->getPost('periodicityVal');; 
        
        $finYearVal = $this->request->getPost('finYearVal');
        $actVal = $this->request->getPost('actVal');
        
        if(empty($periodicityVal))
        {
            $periodicityVal=5;
        }
        
        if(empty($finYearVal))
        {
            $finYearVal=$this->currentFinancialYear;
        }
        
        $this->data['periodicityVal']=$periodicityVal;
        $this->data['finYearVal']=$finYearVal;
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
                    ->orderBy('act_option_name', "ASC")
                    ->findAll();

        $this->data['dueDateForArr']=$dueDateForArr;

        $actArr = $this->Mact->where('status', 1)
                    ->orderBy('act_name', 'asc')
                    ->findAll();

        $this->data['actArr']=$actArr;
        
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.finYear']=$finYearVal;
        $taxCondtnArr['due_date_master_tbl.periodicity']=$periodicityVal;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;

        $taxOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        
        $queryColNames = " 
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.f_period_month,
            ext_due_date_master_tbl.extended_date,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section
        ";
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $ddfIDArr=array();
        $dueDateForDataArr=array();
        $dueDateForHalfWiseArr=array();
        
        if(!empty($dueDatesArr))
        {
            $ddfIDArr=array_unique(array_column($dueDatesArr, 'due_date_for'));
            
            foreach($dueDatesArr AS $e_dd)
            {
                $dueDateForDataArr[$e_dd['due_date_for']]=array(
                    'due_date_form' => $e_dd['due_date_form'],
                    'due_date_section' => $e_dd['due_date_section']
                );
                
                $dueDateForHalfWiseArr[$e_dd['due_date_for']][$e_dd['f_period_month']]=array(
                    'extended_date' => $e_dd['extended_date']
                );
            }
        }
        
        $this->data['ddfIDArr']=$ddfIDArr;
        $this->data['dueDateForDataArr']=$dueDateForDataArr;
        $this->data['dueDateForHalfWiseArr']=$dueDateForHalfWiseArr;
        
        return view('firm_panel/mainpage/act_wise_year_tax_calendar', $this->data);
	}
	
	function sortByOrder($a, $b) {
        if ($a['due_date_for_sort'] > $b['due_date_for_sort']) {
            return 1;
        } elseif ($a['due_date_for_sort'] < $b['due_date_for_sort']) {
            return -1;
        }
        return 0;
    }
	
	public function due_date_yr_summary_tax_calendar()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Tax Calendar : Chart View - Due Date Year-Wise";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

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
        $taxCondtnArr['due_date_master_tbl.status']=1;

        $taxOrderByArr['due_date_for_tbl.act_option_name']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            periodicity_tbl.periodicity_id,
            periodicity_tbl.periodcity_short_name,
            due_date_master_tbl.*,
            due_date_master_tbl.due_date_for,
            ext_due_date_master_tbl.extended_date,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            due_date_for_tbl.act_option_name AS due_date_for_name,
            due_date_for_tbl.sortBy AS due_date_for_sort,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section
        ";
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $ddfIDArr=array();
        $ddfPeriodcityWiseArr=array();
        $dueDateForDataArr=array();
        $dueDateForMthWiseArr=array();
        
        if(!empty($dueDatesArr))
        {
            $ddfIDArr=array_unique(array_column($dueDatesArr, 'due_date_for'));
            foreach($dueDatesArr AS $e_dd)
            {
                $getPeriod = $this->DueDueLib->getPeriod($e_dd['due_date_id']);
                
                $due_date_for_sort = (int)($e_dd['due_date_for_sort'].$e_dd['periodicity_id']);
                
                $dpf=$e_dd['due_date_for']."-".$e_dd['periodicity_id']."-".$e_dd['due_date_form'];
                
                $ddfPeriodcityWiseArr[$dpf]=array(
                    'due_date_for_id' => $e_dd['due_date_for'],
                    'due_date_for_name' => $e_dd['due_date_for_name'],
                    'due_date_for_sort' => $due_date_for_sort,
                    'periodicity_id' => $e_dd['periodicity_id'],
                    'periodicity_name' => $e_dd['periodcity_short_name'],
                    'dpf' => $dpf
                );
                
                $dueDateForDataArr[$dpf]=array(
                    'due_date_form' => $e_dd['due_date_form'],
                    'due_date_section' => $e_dd['due_date_section']
                );
                
                $dueDateForMthWiseArr[$e_dd['due_date_for']][$e_dd['periodicity_id']][$e_dd['act_due_month']]=array(
                    'extended_date' => $e_dd['extended_date'],
                    'ddPeriod' => $getPeriod
                );
            }
        }
        
        if($actVal==8) // if act is GST
            usort($ddfPeriodcityWiseArr, [$this,'sortByOrder']);
        
        $this->data['ddfIDArr']=$ddfIDArr;
        $this->data['ddfPeriodcityWiseArr']=$ddfPeriodcityWiseArr;
        $this->data['dueDateForDataArr']=$dueDateForDataArr;
        $this->data['dueDateForMthWiseArr']=$dueDateForMthWiseArr;

        return view('firm_panel/mainpage/due_date_yr_summary_tax_calendar', $this->data);
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

        $taxCalIsAdminCookie=get_cookie("taxCalIsAdminCookie");

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

		if(!empty(get_cookie("taxCalPeriodicityAdminCookie")))
            $taxCalPeriodicityAdminCookie=get_cookie("taxCalPeriodicityAdminCookie");
        else
            $taxCalPeriodicityAdminCookie="";

		if(!empty(get_cookie("taxCalActAdminCookie")))
            $taxCalActAdminCookie=get_cookie("taxCalActAdminCookie");
        else
            $taxCalActAdminCookie="";

		if(!empty(get_cookie("taxCalDDFAdminCookie")))
            $taxCalDDFAdminCookie=get_cookie("taxCalDDFAdminCookie");
        else
            $taxCalDDFAdminCookie="";

		if(!empty(get_cookie("taxCalFormAdminCookie")))
            $taxCalFormAdminCookie=get_cookie("taxCalFormAdminCookie");
        else
            $taxCalFormAdminCookie="";

		if(!empty(get_cookie("taxCalSectionAdminCookie")))
            $taxCalSectionAdminCookie=get_cookie("taxCalSectionAdminCookie");
        else
            $taxCalSectionAdminCookie="";

		if(!empty(get_cookie("taxCalDailyAdminCookie")))
            $taxCalDailyAdminCookie=get_cookie("taxCalDailyAdminCookie");
        else
            $taxCalDailyAdminCookie="";

		if(!empty(get_cookie("taxCalPrdMthAdminCookie")))
            $taxCalPrdMthAdminCookie=get_cookie("taxCalPrdMthAdminCookie");
        else
            $taxCalPrdMthAdminCookie="";

		if(!empty(get_cookie("taxCalPrdYrAdminCookie")))
            $taxCalPrdYrAdminCookie=get_cookie("taxCalPrdYrAdminCookie");
        else
            $taxCalPrdYrAdminCookie="";

		if(!empty(get_cookie("taxCalFPrdMthAdminCookie")))
            $taxCalFPrdMthAdminCookie=get_cookie("taxCalFPrdMthAdminCookie");
        else
            $taxCalFPrdMthAdminCookie="";

		if(!empty(get_cookie("taxCalFPrdYrAdminCookie")))
            $taxCalFPrdYrAdminCookie=get_cookie("taxCalFPrdYrAdminCookie");
        else
            $taxCalFPrdYrAdminCookie="";

		if(!empty(get_cookie("taxCalTPrdMthAdminCookie")))
            $taxCalTPrdMthAdminCookie=get_cookie("taxCalTPrdMthAdminCookie");
        else
            $taxCalTPrdMthAdminCookie="";
            
        $monthNoVar=$this->request->getGet('monthNo');

        $taxCalSelActVal=$this->request->getGet('due_act_sel');
        
        $taxCalStateAdminCookie=$this->request->getPost('due_state');
	    $taxCalFinYearAdminCookie=$this->request->getPost('finYear');
	    $taxCalFinYearValAdminCookie=$this->request->getPost('finYearVal');
	    
	   // if(empty($monthNoVar))
	        $taxCalTypeAdminCookie=$this->request->getPost('calenderType');
	   // else
	   //     $taxCalTypeAdminCookie=2;
	        
	    $taxCalPeriodicityAdminCookie=$this->request->getPost('periodicity');
	    
	    if(!empty($taxCalSelActVal))
	        $taxCalActAdminCookie=$taxCalSelActVal;
	    else
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
            $taxCalFinYearAdminCookie=$this->sessDueDateYear;
            
		if(!empty($taxCalTypeAdminCookie))
            $taxCalTypeAdminCookie=$taxCalTypeAdminCookie;
        else
            $taxCalTypeAdminCookie="1";
        
        $this->data['monthNoVar']=$monthNoVar;
        $this->data['taxCalSelActVal']=$taxCalSelActVal;
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
        
        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        if(!empty($taxCalStateAdminCookie))
            $taxCondtnArr['due_date_master_tbl.due_state']=$taxCalStateAdminCookie;

        if(!empty($taxCalFinYearAdminCookie))
        {
            // $taxCondtnArr['due_date_master_tbl.finYear']=$taxCalFinYearAdminCookie;
            
            $taxYearArr=explode('-', $taxCalFinYearAdminCookie);
            
            // if(!empty($monthNoVar))
            // {
            //     if($monthNoVar>3)
            //         $mthYrVarName = $taxYearArr[0];
            //     else
            //         $mthYrVarName = "20".$taxYearArr[1];
                    
            //     $taxFromYear=date('Y-m-d', strtotime("01-".$monthNoVar."-".$mthYrVarName));
            //     $taxToYear=date('Y-m-t', strtotime("01-".$monthNoVar."-".$mthYrVarName));
            // }
            // else
            // {
                $taxFromYear=date('Y-m-d', strtotime("01-04-".$taxYearArr[0]));
                $taxToYear=date('Y-m-d', strtotime("31-03-20".$taxYearArr[1]));
            // }
            
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
        $taxJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_tbl', "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames="due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, act_tbl.act_short_name, due_date_for_tbl.act_option_name AS act_option_name1, GROUP_CONCAT(DISTINCT(organisation_type_tbl.organisation_type_name)) AS tax_payers, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, ext_due_date_master_tbl.extended_date, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_date_month, ext_due_date_master_tbl.extended_date_notes, ext_due_date_master_tbl.ext_doc_file, ext_due_date_master_tbl.is_extended, ext_due_date_master_tbl.isFirst, ext_due_date_master_tbl.next_extended_date", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];

        $this->data['dueDatesArr']=$dueDatesArr;

        // print_r($dueDatesArr);
        // echo $this->db->getLastQuery();
        // die();

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
        
        // // print_r($dueDatesArr);
        // // print_r($extDueDateArr);
        // // die();

        // $this->data['extDueDateArr']=$extDueDateArr;

        return view('firm_panel/mainpage/tax_calendar', $this->data);
	}
	
	public function mth_tax_calendar()
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
        
        $getCurrMth=$this->request->getGet('getCurrMth');
        
        if(!empty($getCurrMth))
            $this->currMth=$getCurrMth;
        else
            $this->currMth=$this->currMth;
            
        $this->data['currMth']=$this->currMth;
        
        $taxCalIsAdminCookie=get_cookie("taxCalIsAdminCookie");

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

		if(!empty(get_cookie("taxCalPeriodicityAdminCookie")))
            $taxCalPeriodicityAdminCookie=get_cookie("taxCalPeriodicityAdminCookie");
        else
            $taxCalPeriodicityAdminCookie="";

		if(!empty(get_cookie("taxCalActAdminCookie")))
            $taxCalActAdminCookie=get_cookie("taxCalActAdminCookie");
        else
            $taxCalActAdminCookie="";

		if(!empty(get_cookie("taxCalDDFAdminCookie")))
            $taxCalDDFAdminCookie=get_cookie("taxCalDDFAdminCookie");
        else
            $taxCalDDFAdminCookie="";

		if(!empty(get_cookie("taxCalFormAdminCookie")))
            $taxCalFormAdminCookie=get_cookie("taxCalFormAdminCookie");
        else
            $taxCalFormAdminCookie="";

		if(!empty(get_cookie("taxCalSectionAdminCookie")))
            $taxCalSectionAdminCookie=get_cookie("taxCalSectionAdminCookie");
        else
            $taxCalSectionAdminCookie="";

		if(!empty(get_cookie("taxCalDailyAdminCookie")))
            $taxCalDailyAdminCookie=get_cookie("taxCalDailyAdminCookie");
        else
            $taxCalDailyAdminCookie="";

		if(!empty(get_cookie("taxCalPrdMthAdminCookie")))
            $taxCalPrdMthAdminCookie=get_cookie("taxCalPrdMthAdminCookie");
        else
            $taxCalPrdMthAdminCookie="";

		if(!empty(get_cookie("taxCalPrdYrAdminCookie")))
            $taxCalPrdYrAdminCookie=get_cookie("taxCalPrdYrAdminCookie");
        else
            $taxCalPrdYrAdminCookie="";

		if(!empty(get_cookie("taxCalFPrdMthAdminCookie")))
            $taxCalFPrdMthAdminCookie=get_cookie("taxCalFPrdMthAdminCookie");
        else
            $taxCalFPrdMthAdminCookie="";

		if(!empty(get_cookie("taxCalFPrdYrAdminCookie")))
            $taxCalFPrdYrAdminCookie=get_cookie("taxCalFPrdYrAdminCookie");
        else
            $taxCalFPrdYrAdminCookie="";

		if(!empty(get_cookie("taxCalTPrdMthAdminCookie")))
            $taxCalTPrdMthAdminCookie=get_cookie("taxCalTPrdMthAdminCookie");
        else
            $taxCalTPrdMthAdminCookie="";
            
        $monthNoVar=$this->request->getGet('monthNo');

        $taxCalSelActVal=$this->request->getGet('due_act_sel');
        
        $taxCalStateAdminCookie=$this->request->getPost('due_state');
	    $taxCalFinYearAdminCookie=$this->request->getPost('finYear');
	    $taxCalFinYearValAdminCookie=$this->request->getPost('finYearVal');
	    
	   // if(empty($monthNoVar))
	        $taxCalTypeAdminCookie=$this->request->getPost('calenderType');
	   // else
	   //     $taxCalTypeAdminCookie=2;
	        
	    $taxCalPeriodicityAdminCookie=$this->request->getPost('periodicity');
	    
	    if(!empty($taxCalSelActVal))
	        $taxCalActAdminCookie=$taxCalSelActVal;
	    else
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
            $taxCalFinYearAdminCookie=$this->sessDueDateYear;
            
        $this->data['dueYear']=$taxCalFinYearAdminCookie;
            
		if(!empty($taxCalTypeAdminCookie))
            $taxCalTypeAdminCookie=$taxCalTypeAdminCookie;
        else
            $taxCalTypeAdminCookie="1";
        
        $this->data['monthNoVar']=$monthNoVar;
        $this->data['taxCalSelActVal']=$taxCalSelActVal;
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
        
        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        if(!empty($taxCalStateAdminCookie))
            $taxCondtnArr['due_date_master_tbl.due_state']=$taxCalStateAdminCookie;

        if(!empty($taxCalFinYearAdminCookie))
        {
            // $taxCondtnArr['due_date_master_tbl.finYear']=$taxCalFinYearAdminCookie;
            
            $taxYearArr=explode('-', $taxCalFinYearAdminCookie);
            
            // if(!empty($monthNoVar))
            // {
            //     if($monthNoVar>3)
            //         $mthYrVarName = $taxYearArr[0];
            //     else
            //         $mthYrVarName = "20".$taxYearArr[1];
                    
            //     $taxFromYear=date('Y-m-d', strtotime("01-".$monthNoVar."-".$mthYrVarName));
            //     $taxToYear=date('Y-m-t', strtotime("01-".$monthNoVar."-".$mthYrVarName));
            // }
            // else
            // {
                $taxFromYear=date('Y-m-d', strtotime("01-04-".$taxYearArr[0]));
                $taxToYear=date('Y-m-d', strtotime("31-03-20".$taxYearArr[1]));
            // }
            
            // $taxCondtnArr['due_date_master_tbl.due_date >=']=$taxFromYear;
            // $taxCondtnArr['due_date_master_tbl.due_date <=']=$taxToYear;
            
            $nextYr='20'.$taxYearArr[1];
            
            if($this->currMth<=3)
                $currYear=$nextYr;
            else
                $currYear=$taxYearArr[0];
            
            $this->currYear=$currYear;
        }
        
        $ddFrom=date('Y-m-d', strtotime("01-".$this->currMth."-".$this->currYear));
        $ddTo=date('Y-m-t', strtotime("01-".$this->currMth."-".$this->currYear));
        
        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$ddFrom;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$ddTo;
        
        // print_r($ddFrom);
        // echo "---";
        // print_r($ddTo);
        // die();
        
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
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames="due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, GROUP_CONCAT(DISTINCT(organisation_type_tbl.organisation_type_name)) AS tax_payers, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, ext_due_date_master_tbl.extended_date, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_date_month, ext_due_date_master_tbl.extended_date_notes, ext_due_date_master_tbl.ext_doc_file, ext_due_date_master_tbl.is_extended, ext_due_date_master_tbl.isFirst, ext_due_date_master_tbl.next_extended_date", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
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
        
        // // print_r($dueDatesArr);
        // // print_r($extDueDateArr);
        // // die();

        // $this->data['extDueDateArr']=$extDueDateArr;

        return view('firm_panel/mainpage/mth_tax_calendar', $this->data);
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
	    $periodicity=$this->request->getPost('periodicity');
	    $due_act=$this->request->getPost('due_act');
	    $due_date_for=$this->request->getPost('due_date_for');
	    $applicable_form=$this->request->getPost('applicable_form');
	    $under_section=$this->request->getPost('under_section');

	    $daily_date=$this->request->getPost('daily_date');
	    $period_month=$this->request->getPost('period_month');
	    $period_year=$this->request->getPost('period_year');
	    $f_period_month=$this->request->getPost('f_period_month');
	    $f_period_year=$this->request->getPost('f_period_year');
	    $t_period_month=$this->request->getPost('t_period_month');
	    $t_period_year=$this->request->getPost('t_period_year');

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

        if(empty($periodicity))
            set_cookie("taxCalPeriodicityAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalPeriodicityAdminCookie", $periodicity, $expirationTime);

        if(empty($due_act))
            set_cookie("taxCalActAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalActAdminCookie", $due_act, $expirationTime);
            
        if(empty($due_date_for))
            set_cookie("taxCalDDFAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalDDFAdminCookie", $due_date_for, $expirationTime);

        if(empty($applicable_form))
            set_cookie("taxCalFormAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalFormAdminCookie", $applicable_form, $expirationTime);

        if(empty($under_section))
            set_cookie("taxCalSectionAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalSectionAdminCookie", $under_section, $expirationTime);

        if(empty($daily_date))
            set_cookie("taxCalDailyAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalDailyAdminCookie", $daily_date, $expirationTime);

        if(empty($period_month))
            set_cookie("taxCalPrdMthAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalPrdMthAdminCookie", $period_month, $expirationTime);

        if(empty($period_year))
            set_cookie("taxCalPrdYrAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalPrdYrAdminCookie", $period_year, $expirationTime);

        if(empty($f_period_month))
            set_cookie("taxCalFPrdMthAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalFPrdMthAdminCookie", $f_period_month, $expirationTime);

        if(empty($f_period_year))
            set_cookie("taxCalFPrdYrAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalFPrdYrAdminCookie", $f_period_year, $expirationTime);

        if(empty($t_period_month))
            set_cookie("taxCalTPrdMthAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalTPrdMthAdminCookie", $t_period_month, $expirationTime);

        if(empty($t_period_year))
            set_cookie("taxCalTPrdYrAdminCookie", "", $expirationTime);
        else
            set_cookie("taxCalTPrdYrAdminCookie", $t_period_year, $expirationTime);

        set_cookie("taxCalIsAdminCookie", "1", $expirationTime);
        
        // if($type==1)
        //     return redirect()->route('tax_calendar');
        // else
        //     return redirect()->route('date_wise_tax_calendar');
        
        // if($type==1)
            header('Location: '.base_url('tax_calendar'));
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
        set_cookie("taxCalFinYearValAdminCookie", "", $expirationTime);
        set_cookie("taxCalTypeAdminCookie", "1", $expirationTime);
        set_cookie("taxCalPeriodicityAdminCookie", "", $expirationTime);
        set_cookie("taxCalActAdminCookie", "", $expirationTime);
        set_cookie("taxCalDDFAdminCookie", "", $expirationTime);
        set_cookie("taxCalFormAdminCookie", "", $expirationTime);
        set_cookie("taxCalSectionAdminCookie", "", $expirationTime);
        set_cookie("taxCalDailyAdminCookie", "", $expirationTime);
        set_cookie("taxCalPrdMthAdminCookie", "", $expirationTime);
        set_cookie("taxCalPrdYrAdminCookie", "", $expirationTime);
        set_cookie("taxCalFPrdMthAdminCookie", "", $expirationTime);
        set_cookie("taxCalFPrdYrAdminCookie", "", $expirationTime);
        set_cookie("taxCalTPrdMthAdminCookie", "", $expirationTime);
        set_cookie("taxCalTPrdYrAdminCookie", "", $expirationTime);

        set_cookie("taxCalIsAdminCookie", "", $expirationTime);
        
        // if($type==1)
            header('Location: '.base_url('tax_calendar'));
        // else
        //     header('Location: '.base_url('admin/date_wise_tax_calendar'));
        // die();
	}
	
	function sortByOrderClientGroup($a, $b) {
        if ($a['client_group_number'] > $b['client_group_number']) {
            return 1;
        } elseif ($a['client_group_number'] < $b['client_group_number']) {
            return -1;
        }
        return 0;
    }

    public function getMasterClientData()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Master List-Clients";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

        $selActValue=$this->request->getGet('selAct');

        if(!empty($selActValue))
            $selActVal=$selActValue;
        else
            $selActVal=1;

        $this->data['selActVal']=$selActVal;

        $clientMasterData=array();
        
        $clientMasterData[1]['id']=1;
        $clientMasterData[1]['name']="Companies";
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
        $clientMasterData[9]['name']="Profession Tax";
        $clientMasterData[9]['type']="act";

        // $clientMasterData[10]['id']=10;
        // $clientMasterData[10]['name']="Profession Tax-Registration";
        // $clientMasterData[10]['type']="act";

        $clientMasterData[11]['id']=11;
        $clientMasterData[11]['name']="Shops & Establishment";
        $clientMasterData[11]['type']="act";

        $this->data['clientMasterData']=$clientMasterData;

        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        // $clientCondtnArr['client_tbl.clientRegDocument !=']="";
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.*, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_id AS orgType, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientDataArr=$query['userData'];
        
        $clientActCondtnArr['client_tbl.status']=1;
        $clientActCondtnArr['client_tbl.isOldClient']=2;
        $clientActCondtnArr['client_document_map_tbl.status']=1;
        $clientActCondtnArr['client_document_map_tbl.client_document_number !=']="";
        $clientActOrderByArr['client_group_tbl.client_group_number']="ASC";

        $clientActJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=client_document_map_tbl.fk_client_id", "type"=>"left");
        $clientActJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientActJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_document_map_tbl, $colNames="client_document_map_tbl.fk_client_document_id, client_tbl.*, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_id AS orgType, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, client_document_map_tbl.client_document_number", $clientActCondtnArr, $likeCondtnArr=array(), $clientActJoinArr, $singleRow=FALSE, $clientActOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
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
        
        if(isset($clientDocArr[6]))
            $ptEnrolArr=$clientDocArr[6];
        else
            $ptEnrolArr=array();

        if(isset($clientDocArr[7]))
            $ptRegArr=$clientDocArr[7];
        else
            $ptRegArr=array();
            
        $ptResultArr=array_merge($ptEnrolArr, $ptRegArr);
        
        usort($ptResultArr, [$this,'sortByOrderClientGroup']);

        $this->data['clientOrgArr']=$clientOrgArr;
        $this->data['clientDocArr']=$clientDocArr; 
        $this->data['ptResultArr']=$ptResultArr; 

        return view('firm_panel/mainpage/getMasterClientData', $this->data);
    }
    
    public function getMasterOldClientData()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Master List - Clients Left";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        ini_set('memory_limit', '-1');
	    
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=1;
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_group_tbl.client_group_cost", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_tbl.isOldClient, client_tbl.clientLeftReason, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, user_tbl.userShortName", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $clientActCondtnArr['client_document_map_tbl.status']=1;
        $clientActCondtnArr['client_document_map_tbl.client_document_number !=']="";
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_document_map_tbl, $colNames="client_document_map_tbl.fk_client_document_id, client_document_map_tbl.fk_client_id, client_document_map_tbl.client_document_number", $clientActCondtnArr, $likeCondtnArr=array(), $clientActJoinArr=array(), $singleRow=FALSE, $clientActOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientActDataArr=$query['userData'];
        
        $clientDocArr=array();

        if(!empty($clientActDataArr))
        {
            foreach($clientActDataArr AS $e_cl_act)
            {
                $clientDocArr[$e_cl_act['fk_client_id']][$e_cl_act['fk_client_document_id']]=$e_cl_act['client_document_number'];
            }
        }

        $this->data['clientDocArr']=$clientDocArr; 

        return view('firm_panel/mainpage/getMasterOldClientData', $this->data);
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
	
	public function getMasterStaffData()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Master List-Staff";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        // $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']="2";
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.*", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userDataArr=$query['userData'];

        $this->data['userDataArr']=$userDataArr;
        
	    return view('firm_panel/mainpage/getMasterStaffData', $this->data);
	}
	
	public function getMasterOldStaffData()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Master List-Old Staff";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        // $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']="1";
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.*", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userDataArr=$query['userData'];

        $this->data['userDataArr']=$userDataArr;
        
	    return view('firm_panel/mainpage/getMasterOldStaffData', $this->data);
	}
	
	public function accountFinance()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Accounts & Finance";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

        return view('firm_panel/mainpage/accountFinance', $this->data);
	}
	
	public function getClientReport()
	{
	    ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Client Report";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_group_tbl.client_group_cost", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, user_tbl.userShortName", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;

        return view('firm_panel/mainpage/getClientReport', $this->data);
	}
	
	public function getClientMonthWiseReport()
	{
	    ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $this->data['clientId']=$clientId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Work Position";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.*, client_tbl.clientPanNumber, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $clientBussOrganisationType="";
        
        if(!empty($clientData))
            $clientBussOrganisationType=$clientData['clientBussOrganisationType'];
            
        if($clientData['clientBussOrganisationType']==8)
            $clientNameVar=$clientData['clientName']." (".$clientData['clientBussOrganisation'].")";
        elseif($clientData['clientBussOrganisationType']==9)
            $clientNameVar=$clientData['clientName'];
        else
            $clientNameVar=$clientData['clientBussOrganisation']; 
            
        $this->data['clientNameVar']=$clientNameVar;
            
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $finStartYr=$fin_year_arr[0];
        $finEndYr="20".$fin_year_arr[1];

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.fkClientId']=$clientId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.fk_org_type_id']=$clientBussOrganisationType;
        
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS audit_tbl', "condtn"=>"audit_tbl.act_option_map_id=due_date_master_tbl.audit", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.eFillingDate, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, act_tbl.act_name, act_tbl.act_short_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_name AS act_option_name2, under_section_tbl.act_option_name AS act_option_name3, audit_tbl.act_option_name AS act_option_name4, applicable_form_tbl.act_option_name AS act_option_name5, due_date_master_tbl.due_act, ext_due_date_master_tbl.extended_date, organisation_type_tbl.organisation_type_name AS tax_payer_val", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        $workMthArr=array();
        $workListArr=array();

        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_work)
            {
                // $workMthArr[$e_work['act_due_month']]=date("F", strtotime("01-".$e_work['act_due_month']."-2022"))."-".date("Y", strtotime($e_work['extended_date']));
                $workListArr[$e_work['act_due_month']][]=$e_work;
            }
        }
        
        for($m_no=1;$m_no<13;$m_no++)
        {
            if($m_no<=9)
            {
                $m=$m_no+3;
                $mthVar=date("F-Y", strtotime("01-".$m."-".$finStartYr));
            }
            else
            {
                $m=$m_no-9;
                $mthVar=date("F-Y", strtotime("01-".$m."-".$finEndYr));
            }
                
            $workMthArr[$m]=$mthVar;
        }

        $this->data['workMthArr']=$workMthArr;
        $this->data['workListArr']=$workListArr;

        return view('firm_panel/mainpage/getClientMonthWiseReport', $this->data);
	}
}
