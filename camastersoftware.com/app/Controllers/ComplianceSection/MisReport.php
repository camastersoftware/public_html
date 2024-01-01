<?php namespace App\Controllers\ComplianceSection;
use \App\Controllers\BaseController;

class MisReport extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->act_tbl=$tableArr['act_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->work_junior_map_tbl=$tableArr['work_junior_map_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        
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

	public function inc_tax_mis_summary()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="MIS Report - Summary of Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $actVal = "1"; // Income Tax
        
        $dueDateForCondtn = array(
            'fk_act_id'     =>  $actVal,
            'option_type'   =>  1,
            'status'        =>  1,
        );
        
        $dueDateForArr = $this->Mact_option->where($dueDateForCondtn)
                    ->orderBy('sortBy', 'ASC')
                    ->findAll();

        $this->data['dueDateForArr']=$dueDateForArr;
        
        $taxWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;

        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $taxCondtnArr['work_tbl.workId !=']='';
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['client_tbl.status']="1";

        $taxOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND work_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId AND client_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            due_date_master_tbl.due_date_for,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section,
            COUNT(work_tbl.workId) AS totalWorkCount
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $taxWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $ddfIDArr=array();
        $dueDateForDataArr=array();
        $totalReturnsCountArr=array();
        $filedReturnsCountArr=array();
        
        if(!empty($dueDatesArr))
        {
            $ddfIDArr=array_unique(array_column($dueDatesArr, 'due_date_for'));
            foreach($dueDatesArr AS $e_dd)
            {
                $dueDateForDataArr[$e_dd['due_date_for']]=array(
                    'due_date_form' => $e_dd['due_date_form'],
                    'due_date_section' => $e_dd['due_date_section']
                );
                
                $totalReturnsCountArr[$e_dd['due_date_for']][$e_dd['act_due_month']]=array(
                    'totalWorkCount' => $e_dd['totalWorkCount']
                );
            }
        }
        
        $this->data['ddfIDArr']=$ddfIDArr;
        $this->data['dueDateForDataArr']=$dueDateForDataArr;
        $this->data['totalReturnsCountArr']=$totalReturnsCountArr;
        
        $taxWhereInArray=$taxCondtnArr=$taxOrderByArr=$taxGroupByArr=$taxJoinArr=array();
        
        $taxWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;

        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $taxCondtnArr['work_tbl.workId !=']='';
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['client_tbl.status']="1";

        $taxOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";
        $taxGroupByArr=array('due_date_master_tbl.due_date_id', 'ext_due_date_master_tbl.ext_due_date_master_id');

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS under_section_tbl', "condtn"=>"under_section_tbl.act_option_map_id=due_date_master_tbl.under_section AND under_section_tbl.option_type=3 AND under_section_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND work_tbl.status=1 AND work_tbl.eFillingDate!='' AND work_tbl.eFillingDate!='0000-00-00' AND work_tbl.eFillingDate!='1970-01-01'", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId AND client_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            due_date_master_tbl.due_date_for,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            applicable_form_tbl.act_option_name AS due_date_form,
            under_section_tbl.act_option_name AS due_date_section,
            COUNT(work_tbl.workId) AS filedWorkCount
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $taxWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $filedReturnsCountArr=array();
        
        if(!empty($dueDatesArr))
        {
            $ddfIDArr=array_unique(array_column($dueDatesArr, 'due_date_for'));
            foreach($dueDatesArr AS $e_dd)
            {
                $filedReturnsCountArr[$e_dd['due_date_for']][$e_dd['act_due_month']]=array(
                    'filedWorkCount' => $e_dd['filedWorkCount']
                );
            }
        }
        
        $this->data['filedReturnsCountArr']=$filedReturnsCountArr;

        return view('firm_panel/compliance/income_tax/inc_tax_mis_summary', $this->data);
    }
    
    public function inc_tax_mis_staff_summary()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="MIS Report - Staff-wise Summary";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $actVal = "1"; // Income Tax
        
        $dueDateForCondtn = array(
            'fk_act_id'     =>  $actVal,
            'option_type'   =>  1,
            'status'        =>  1,
        );
        
        $dueDateForArr = $this->Mact_option->where($dueDateForCondtn)
                    ->orderBy('sortBy', 'ASC')
                    ->findAll();

        $this->data['dueDateForArr']=$dueDateForArr;
        
        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userFullName", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        $taxWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;

        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $taxCondtnArr['work_tbl.workId !=']='';
        $taxCondtnArr['work_tbl.status']="1";
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['due_date_for_tbl.status']=1;
        $taxCondtnArr['client_tbl.status']="1";

        $taxOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";
        $taxgroupByArr=array("work_junior_map_tbl.fkUserId", "DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')");

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND work_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId AND client_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            due_date_master_tbl.due_date_for,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            COUNT(work_tbl.workId) AS totalWorkCount,
            work_junior_map_tbl.fkUserId AS juniorId
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxgroupByArr, $taxWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $staffIDArr=array();
        $totalReturnsCountArr=array();
        $filedReturnsCountArr=array();
        
        if(!empty($dueDatesArr))
        {
            $staffIDArr=array_unique(array_column($dueDatesArr, 'juniorId'));
            foreach($dueDatesArr AS $e_dd)
            {
                $totalReturnsCountArr[$e_dd['juniorId']][$e_dd['act_due_month']]=array(
                    'totalWorkCount' => $e_dd['totalWorkCount']
                );
            }
        }
        
        $this->data['staffIDArr']=$staffIDArr;
        $this->data['totalReturnsCountArr']=$totalReturnsCountArr;
        
        $taxWhereInArray=$taxCondtnArr=$taxOrderByArr=$taxGroupByArr=$taxJoinArr=array();
        
        $taxWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;

        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $taxCondtnArr['work_tbl.workId !=']='';
        $taxCondtnArr['work_tbl.status']="1";
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.due_act']=$actVal;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['due_date_for_tbl.status']=1;
        $taxCondtnArr['client_tbl.status']="1";

        $taxOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";
        $taxgroupByArr=array("work_junior_map_tbl.fkUserId", "DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')");

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND work_tbl.status=1 AND work_tbl.eFillingDate!='' AND work_tbl.eFillingDate!='0000-00-00' AND work_tbl.eFillingDate!='1970-01-01'", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId AND client_tbl.status=1", "type"=>"left");
        
        $queryColNames = "
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            COUNT(work_tbl.workId) AS filedWorkCount,
            work_junior_map_tbl.fkUserId AS juniorId
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxgroupByArr, $taxWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        $filedReturnsCountArr=array();
        
        if(!empty($dueDatesArr))
        {
            foreach($dueDatesArr AS $e_dd)
            {
                $filedReturnsCountArr[$e_dd['juniorId']][$e_dd['act_due_month']]=array(
                    'filedWorkCount' => $e_dd['filedWorkCount']
                );
            }
        }
        
        $this->data['filedReturnsCountArr']=$filedReturnsCountArr;

        return view('firm_panel/compliance/income_tax/inc_tax_mis_staff_summary', $this->data);
    }
    
    public function combined_mis_report()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="MIS Report - Combimed Report";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $selActArr = array(1, 4, 6); // Income Tax, Company, LLP Act
        
        $incDDFArr = array(1, 2, 329, 4);   // Income Tax Act
        $compDDFArr = array(49, 113, 112);  // Company Act
        $llpDDFArr = array(116, 64, 117);   // LLP Act
        
        $this->data['selActArr']=$selActArr;
        $this->data['incDDFArr']=$incDDFArr;
        $this->data['compDDFArr']=$compDDFArr;
        $this->data['llpDDFArr']=$llpDDFArr;
        
        $selDDFArr = array_merge($incDDFArr, $compDDFArr, $llpDDFArr);
        
        $taxWhereInArray['due_date_master_tbl.due_act']=$selActArr;
        $taxWhereInArray['due_date_for_tbl.act_option_map_id']=$selDDFArr;
        
        $taxCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $taxCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $taxCondtnArr['work_tbl.workId !=']='';
        $taxCondtnArr['work_tbl.status']="1";
        $taxCondtnArr['due_date_master_tbl.due_state']=12;
        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['due_date_for_tbl.status']=1;
        $taxCondtnArr['client_tbl.status']="1";

        $taxOrderByArr['client_tbl.clientBussOrganisationType']="ASC";
        $taxOrderByArr['due_date_master_tbl.due_date_id']="ASC";
        $taxGroupByArr=array("due_date_master_tbl.due_date_id", "ext_due_date_master_tbl.ext_due_date_master_id", "client_tbl.clientId");

        $taxJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS applicable_form_tbl', "condtn"=>"applicable_form_tbl.act_option_map_id=due_date_master_tbl.applicable_form AND applicable_form_tbl.option_type=5 AND applicable_form_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND work_tbl.status=1", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId AND client_tbl.status=1 AND client_tbl.isOldClient=2", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $queryColNames = "
            due_date_master_tbl.due_date_id,
            due_date_master_tbl.due_act,
            ext_due_date_master_tbl.ext_due_date_master_id,
            ext_due_date_master_tbl.extended_date,
            due_date_for_tbl.act_option_map_id AS ddfId,
            due_date_for_tbl.act_option_name AS ddfName,
            due_date_for_tbl.shortName AS ddfShortName,
            applicable_form_tbl.act_option_name AS formName,
            work_tbl.workDone,
            work_tbl.isUrgentWork,
            work_tbl.eFillingDate,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->due_date_master_tbl, $colNames=$queryColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $taxWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesDataArr=$query['userData'];
        
        $clientArr = array();
        $clientDDFArr = array();
        $actDDFDataArr = array();
        $clientActDataArr = array();
        
        if(!empty($dueDatesDataArr))
        {
            foreach($dueDatesDataArr AS $e_dd)
            {
                if(in_array($e_dd['orgType'], INDIVIDUAL_ARRAY))
                    $clientName=(!empty($e_dd['clientName'])) ? $e_dd['clientName']:"";
                else
                    $clientName=(!empty($e_dd['clientBussOrganisation'])) ? $e_dd['clientBussOrganisation']:"";
                
                $clientArr[$e_dd['clientId']] = array(
                    'clientId'      => $e_dd['clientId'],
                    'clientName'    => $clientName,
                    'orgType'       => $e_dd['orgType'],
                    'shortName'     => $e_dd['shortName']
                );
                
                $clientDDFArr[$e_dd['clientId']][] = $e_dd['ddfId'];
                $actDDFDataArr[$e_dd['due_act']][$e_dd['ddfId']] = $e_dd;
                $clientActDataArr[$e_dd['clientId']][$e_dd['due_act']][$e_dd['ddfId']] = $e_dd;
            }
        }
        
        $this->data['clientArr']=$clientArr;
        $this->data['clientDDFArr']=$clientDDFArr;
        $this->data['actDDFDataArr']=$actDDFDataArr;
        $this->data['clientActDataArr']=$clientActDataArr;

        return view('firm_panel/compliance/combined_mis_report', $this->data);
    }
}
?>