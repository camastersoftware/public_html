<?php namespace App\Controllers\ComplianceSection;
use \App\Controllers\BaseController;

class Income_tax extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Income Tax";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Muser = new \App\Models\Muser();
        $this->Mdemand = new \App\Models\Mdemand();
        $this->MRectification = new \App\Models\MRectification();
        $this->MRectificationHearing = new \App\Models\MRectificationHearing();
        $this->MNoticeUnderSection = new \App\Models\MNoticeUnderSection();
        $this->MActOrderType = new \App\Models\MActOrderType();
        $this->MscrutinyNotice = new \App\Models\MscrutinyNotice();
        $this->MscrutinyNoticeReply = new \App\Models\MscrutinyNoticeReply();
        $this->Mlevel = new \App\Models\Mlevel();
        $this->Mappeal = new \App\Models\Mappeal();
        $this->MappealNotice = new \App\Models\MappealNotice();
        $this->MappealNoticeReply = new \App\Models\MappealNoticeReply();
        $this->MorderAnalysis = new \App\Models\MorderAnalysis();
        $this->MorderAnalysisTax = new \App\Models\MorderAnalysisTax();
        $this->MorderAnalysisExpense = new \App\Models\MorderAnalysisExpense();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->act_tbl=$tableArr['act_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->refund_tbl=$tableArr['refund_tbl'];
        $this->demand_tbl=$tableArr['demand_tbl'];
        $this->rectification_tbl=$tableArr['rectification_tbl'];
        $this->rectification_hearing_tbl=$tableArr['rectification_hearing_tbl'];
        $this->notice_under_section_tbl=$tableArr['notice_under_section_tbl'];
        $this->act_order_type_master=$tableArr['act_order_type_master'];
        $this->hearing_tbl=$tableArr['hearing_tbl'];
        $this->scrutiny_notice_tbl=$tableArr['scrutiny_notice_tbl'];
        $this->scrutiny_notice_reply_tbl=$tableArr['scrutiny_notice_reply_tbl'];
        $this->level_tbl=$tableArr['level_tbl'];
        $this->appeal_tbl=$tableArr['appeal_tbl'];
        $this->appeal_notice_tbl=$tableArr['appeal_notice_tbl'];
        $this->appeal_notice_reply_tbl=$tableArr['appeal_notice_reply_tbl'];
        $this->order_analysis_tbl=$tableArr['order_analysis_tbl'];
        $this->order_analysis_tax_tbl=$tableArr['order_analysis_tax_tbl'];
        $this->order_analysis_expense_tbl=$tableArr['order_analysis_expense_tbl'];
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }

	public function income_tax_demands()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Demands";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $asmtYear="N/A";
        if(!empty($fin_year_arr))
        {
            $asmtYearVal=$this->sessDueDateYear;
            
            $asmtYearArr=explode('-', $asmtYearVal);
            
            $fY=(int)$asmtYearArr[0]+1;
            $lY=(int)$asmtYearArr[1]+1;
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['refund_tbl.intiAddtnlTax != ']="";
        $workCondtnArr['refund_tbl.intiAddtnlTax != ']="0";
        $workCondtnArr['refund_tbl.intiAddtnlTax > ']="0";
        $workCondtnArr['work_tbl.refundDue != ']="";
        $workCondtnArr['work_tbl.refundDue != ']="0";
        $workCondtnArr['work_tbl.refundDue > ']="0";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        $workOrderByArr['client_tbl.clientName']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->demand_tbl, "condtn"=>"demand_tbl.fkWorkId=work_tbl.workId AND demand_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $demandColNames="
                        work_tbl.workId, 
                        work_tbl.eFillingDate, 
                        due_date_master_tbl.finYear, 
                        client_tbl.clientId, 
                        client_tbl.clientName, 
                        client_tbl.clientBussOrganisation, 
                        client_tbl.clientBussOrganisationType AS orgType, 
                        client_tbl.clientDob, 
                        client_tbl.clientBussIncorporationDate, 
                        client_tbl.clientPanNumber, 
                        client_group_tbl.client_group_number,
                        demand_tbl.demandId,
                        demand_tbl.demandTotalAmt,
                        demand_tbl.whetherPayable,
                        demand_tbl.demandDecision,
                        demand_tbl.demandAmtDate2,
                        demand_tbl.demandAmtDate3,
                        demand_tbl.demandAmtDate4,
                        demand_tbl.totalDemandPaidAmt,
                    ";
                    
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$demandColNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        return view('firm_panel/compliance/income_tax/income_tax_demands', $this->data);
    }
    
    public function demand_details()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $workId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Demand Details";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['client_tbl.clientName']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->demand_tbl, "condtn"=>"demand_tbl.fkWorkId=work_tbl.workId AND demand_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
            demand_tbl.demandId,
            demand_tbl.demandPrincipalAmt,
            demand_tbl.demandInterestAmt,
            demand_tbl.demandTotalAmt,
            demand_tbl.whetherPayable,
            demand_tbl.demandDecision,
            demand_tbl.demandPrincipalAmt1,
            demand_tbl.demandPrincipalAmt2,
            demand_tbl.demandPrincipalAmt3,
            demand_tbl.demandPrincipalAmt4,
            demand_tbl.demandPrincipalAmt5,
            demand_tbl.demandInterestAmt1,
            demand_tbl.demandInterestAmt2,
            demand_tbl.demandInterestAmt3,
            demand_tbl.demandInterestAmt4,
            demand_tbl.demandInterestAmt5,
            demand_tbl.demandAmtDate1,
            demand_tbl.demandAmtDate2,
            demand_tbl.demandAmtDate3,
            demand_tbl.demandAmtDate4,
            demand_tbl.demandAmtDate5,
            demand_tbl.totalDemandAmt1,
            demand_tbl.totalDemandAmt2,
            demand_tbl.totalDemandAmt3,
            demand_tbl.totalDemandAmt4,
            demand_tbl.totalDemandAmt5,
            demand_tbl.totalDemandPrincipalAmt,
            demand_tbl.totalDemandInterestAmt,
            demand_tbl.totalDemandPaidAmt,
            demand_tbl.balancePayable,
            demand_tbl.demandRemark,
            work_tbl.workId,
            work_tbl.eFillingDate, 
            work_tbl.acknowledgmentNo, 
            refund_tbl.totalIncome,
            client_tbl.clientBussOrganisationType AS orgType,
            client_tbl.clientName, 
            client_tbl.clientBussOrganisation, 
            client_tbl.clientDob, 
            client_tbl.clientBussIncorporationDate, 
            client_tbl.clientPanNumber,
            due_date_master_tbl.finYear,
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        return view('firm_panel/compliance/income_tax/demand_details', $this->data);
    }
    
    public function update_demand_details()
    {
        $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $demandId=$this->request->getPost('demandId');
        
        $whetherPayable=$this->request->getPost('whetherPayable');
        $demandDecision=$this->request->getPost('demandDecision');
        
        $demandPrincipalAmt1=$this->request->getPost('demandPrincipalAmt1');
        $demandPrincipalAmt2=$this->request->getPost('demandPrincipalAmt2');
        $demandPrincipalAmt3=$this->request->getPost('demandPrincipalAmt3');
        $demandPrincipalAmt4=$this->request->getPost('demandPrincipalAmt4');
        $totalDemandPrincipalAmt=$this->request->getPost('totalDemandPrincipalAmt');
        
        $demandInterestAmt1=$this->request->getPost('demandInterestAmt1');
        $demandInterestAmt2=$this->request->getPost('demandInterestAmt2');
        $demandInterestAmt3=$this->request->getPost('demandInterestAmt3');
        $demandInterestAmt4=$this->request->getPost('demandInterestAmt4');
        $totalDemandInterestAmt=$this->request->getPost('totalDemandInterestAmt');
        
        $totalDemandAmt1=$this->request->getPost('totalDemandAmt1');
        $totalDemandAmt2=$this->request->getPost('totalDemandAmt2');
        $totalDemandAmt3=$this->request->getPost('totalDemandAmt3');
        $totalDemandAmt4=$this->request->getPost('totalDemandAmt4');
        $totalDemandPaidAmt=$this->request->getPost('totalDemandPaidAmt');
        
        $demandAmtDate2=$this->request->getPost('demandAmtDate2');
        $demandAmtDate3=$this->request->getPost('demandAmtDate3');
        $demandAmtDate4=$this->request->getPost('demandAmtDate4');
        
        $balancePayable=$this->request->getPost('balancePayable');
        
        $demandRemark=$this->request->getPost('demandRemark');

        $updateDemandArr=array(
            'demandId'                  =>  $demandId, 
            'fkWorkId'                  =>  $workId,
            'whetherPayable'            =>  $whetherPayable, 
            'demandDecision'            =>  $demandDecision, 
            'demandPrincipalAmt1'       =>  $demandPrincipalAmt1, 
            'demandPrincipalAmt2'       =>  $demandPrincipalAmt2, 
            'demandPrincipalAmt3'       =>  $demandPrincipalAmt3, 
            'demandPrincipalAmt4'       =>  $demandPrincipalAmt4, 
            'totalDemandPrincipalAmt'   =>  $totalDemandPrincipalAmt, 
            'demandInterestAmt1'        =>  $demandInterestAmt1, 
            'demandInterestAmt2'        =>  $demandInterestAmt2, 
            'demandInterestAmt3'        =>  $demandInterestAmt3, 
            'demandInterestAmt4'        =>  $demandInterestAmt4, 
            'totalDemandInterestAmt'    =>  $totalDemandInterestAmt, 
            'totalDemandAmt1'           =>  $totalDemandAmt1, 
            'totalDemandAmt2'           =>  $totalDemandAmt2, 
            'totalDemandAmt3'           =>  $totalDemandAmt3, 
            'totalDemandAmt4'           =>  $totalDemandAmt4, 
            'totalDemandPaidAmt'        =>  $totalDemandPaidAmt, 
            'demandAmtDate2'            =>  $demandAmtDate2, 
            'demandAmtDate3'            =>  $demandAmtDate3, 
            'demandAmtDate4'            =>  $demandAmtDate4, 
            'balancePayable'            =>  $balancePayable, 
            'demandRemark'              =>  $demandRemark,
            'status'                    =>  1, 
            'updatedBy'                 =>  $this->adminId,
            'updatedDatetime'           =>  $this->currTimeStamp
        );
        
        $this->Mdemand->save($updateDemandArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Demand Details not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Demand Details updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Demand Details has been updated successfully :)");
        }
        
        return redirect()->route('income-tax-demands');
    }
    
    public function rectification()
	{
	    ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Rectification";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $asmtYear="N/A";
        if(!empty($fin_year_arr))
        {
            $asmtYearVal=$this->sessDueDateYear;
            
            $asmtYearArr=explode('-', $asmtYearVal);
            
            $fY=(int)$asmtYearArr[0]+1;
            $lY=(int)$asmtYearArr[1]+1;
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        // $workCondtnArr['work_tbl.workDone']="100";
        $workCondtnArr['work_tbl.refundDue != ']="";
        $workCondtnArr['work_tbl.refundDue != ']="0";
        $workCondtnArr['work_tbl.refundDue > ']="0";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        $workCondtnArr['rectification_tbl.status']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        // $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        $workOrderByArr['client_tbl.clientName']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        // $workGroupByArr=array('due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        $workGroupByArr=array('rectification_tbl.rectificationId');
        
        $workJoinArr[]=array(
                                "tbl"=>"
                                        (
                                            SELECT MAX(rectification_hearing_tbl.rectificationHearingId) AS maxHearingId, rectification_hearing_tbl.fkRectificationId
                                            FROM ".$this->rectification_hearing_tbl." 
                                            WHERE rectification_hearing_tbl.status=1
                                            GROUP BY rectification_hearing_tbl.fkRectificationId
                                        ) AS rect_hearing_tbl
                                ", 
                                "condtn"=>"rect_hearing_tbl.fkRectificationId=rectification_tbl.rectificationId", 
                                "type"=>"left"
                            );
                            
        $workJoinArr[]=array("tbl"=>$this->rectification_hearing_tbl, "condtn"=>"rectification_hearing_tbl.rectificationHearingId=rect_hearing_tbl.maxHearingId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=rectification_tbl.fkWorkId AND work_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->demand_tbl, "condtn"=>"demand_tbl.fkWorkId=work_tbl.workId AND demand_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
                    rectification_tbl.rectificationId, 
                    rectification_tbl.rectificationFilingDate, 
                    rectification_tbl.whetherAcceptable, 
                    rectification_hearing_tbl.nextHearingDate, 
                    work_tbl.workId, 
                    work_tbl.eFillingDate, 
                    due_date_master_tbl.finYear, 
                    client_tbl.clientName, 
                    client_tbl.clientBussOrganisation, 
                    client_tbl.clientBussOrganisationType AS orgType, 
                    client_tbl.clientPanNumber, 
                    client_group_tbl.client_group_number, 
                    refund_tbl.refundTotalAmt,
                    demand_tbl.demandTotalAmt
                ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->rectification_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        return view('firm_panel/compliance/income_tax/rectification', $this->data);
	}
	
	public function rectification_details()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $rectificationId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'wysihtml5');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Rectification Details";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate != ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        $workCondtnArr['rectification_tbl.status']=1;
        $workCondtnArr['rectification_tbl.rectificationId']=$rectificationId;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['client_tbl.clientName']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->act_order_type_master, "condtn"=>"act_order_type_master.actOrderTypeId=rectification_tbl.orderType AND act_order_type_master.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=rectification_tbl.fkWorkId AND work_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->demand_tbl, "condtn"=>"demand_tbl.fkWorkId=work_tbl.workId AND demand_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
            rectification_tbl.rectificationId,
            rectification_tbl.rectificationType,
            rectification_tbl.rectTotalIncomeAmt,
            rectification_tbl.rectRefundAmt,
            rectification_tbl.rectDemandAmt,
            rectification_tbl.orderType,
            rectification_tbl.accessingOfficerName,
            rectification_tbl.accessingOfficerContactNo,
            rectification_tbl.inspectorName,
            rectification_tbl.inspectorContactNo,
            rectification_tbl.taxAssistantName,
            rectification_tbl.taxAssistantContactNo,
            rectification_tbl.officerWardNo,
            rectification_tbl.officerPlace,
            rectification_tbl.officerNotice,
            rectification_tbl.officerRemark,
            rectification_tbl.orderDate,
            rectification_tbl.additionalDemandRaised,
            rectification_tbl.whetherAcceptable,
            rectification_tbl.rectificationFilingDate,
            rectification_tbl.appealFilingDate,
            rectification_tbl.pmtOfDemandDate,
            rectification_tbl.orderAmountPaid,
            rectification_tbl.receiptOfOrderDate,
            rectification_tbl.orderRemark,
            rectification_tbl.dateOfFinalOrder,
            rectification_tbl.dateOfReceiptOrder,
            rectification_tbl.whetherFileAppeal,
            rectification_tbl.finalAmtOfRefund,
            rectification_tbl.dateOfReceiptOfRefund,
            act_order_type_master.actOrderTypeName,
            work_tbl.workId,
            work_tbl.eFillingDate,
            work_tbl.acknowledgmentNo,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientPanNumber,
            client_tbl.clientBussOrganisationType AS orgType,
            due_date_master_tbl.finYear,
            refund_tbl.totalIncome,
            refund_tbl.intiTotalIncome,
            refund_tbl.refundClaimed,
            refund_tbl.refundTotalAmt,
            demand_tbl.demandTotalAmt
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->rectification_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $rectDataArr=$query['userData'];

        $this->data['rectDataArr']=$rectDataArr;
        
        $rectHearingCondtn = array(
            'status'                => 1,
            'fkRectificationId'     => $rectificationId,
        );
        
        $rectHearingArr=$this->MRectificationHearing->where($rectHearingCondtn)->findAll();

        $this->data['rectHearingArr']=$rectHearingArr;
        
        $orderTypeArr=$this->MActOrderType->where('status', 1)->findAll();

        $this->data['orderTypeArr']=$orderTypeArr;
        
        return view('firm_panel/compliance/income_tax/rectification_details', $this->data);
	}
	
	public function update_rectification_officer_details()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $rectificationId=$this->request->getPost('rectificationId');
        
        $orderType=$this->request->getPost('orderType');
        $additionalDemandRaised=$this->request->getPost('additionalDemandRaised');
        $orderDate=$this->request->getPost('orderDate');
        $receiptOfOrderDate=$this->request->getPost('receiptOfOrderDate');
        $accessingOfficerName=$this->request->getPost('accessingOfficerName');
        $inspectorName=$this->request->getPost('inspectorName');
        $taxAssistantName=$this->request->getPost('taxAssistantName');
        $officerWardNo=$this->request->getPost('officerWardNo');
        $officerPlace=$this->request->getPost('officerPlace');
        $rectificationFilingDate=$this->request->getPost('rectificationFilingDate');
        $officerRemark=$this->request->getPost('officerRemark');
        
        $officerRemarkVal = (!empty($officerRemark)) ? htmlspecialchars(htmlentities($officerRemark)) : "";

        $updateRectOfficerArr=array(
            'rectificationId'           =>  $rectificationId, 
            'fkWorkId'                  =>  $workId,
            'orderType'                 =>  $orderType, 
            'additionalDemandRaised'    =>  $additionalDemandRaised, 
            'orderDate'                 =>  $orderDate, 
            'receiptOfOrderDate'        =>  $receiptOfOrderDate, 
            'accessingOfficerName'      =>  $accessingOfficerName, 
            'inspectorName'             =>  $inspectorName, 
            'taxAssistantName'          =>  $taxAssistantName, 
            'officerWardNo'             =>  $officerWardNo, 
            'officerPlace'              =>  $officerPlace, 
            'rectificationFilingDate'   =>  $rectificationFilingDate, 
            'officerRemark'             =>  $officerRemarkVal, 
            'status'                    =>  1, 
            'updatedBy'                 =>  $this->adminId,
            'updatedDatetime'           =>  $this->currTimeStamp
        );
        
        $this->MRectification->save($updateRectOfficerArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Rectification Officer Details not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Rectification Officer Details updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Rectification Officer Details has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function update_rectification_order_details()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $rectificationId=$this->request->getPost('rectificationId');
        
        $dateOfFinalOrder=$this->request->getPost('dateOfFinalOrder');
        $dateOfReceiptOrder=$this->request->getPost('dateOfReceiptOrder');
        $whetherAcceptable=$this->request->getPost('whetherAcceptable');
        $orderAmountPaid=$this->request->getPost('orderAmountPaid');
        $pmtOfDemandDate=$this->request->getPost('pmtOfDemandDate');
        $finalAmtOfRefund=$this->request->getPost('finalAmtOfRefund');
        $dateOfReceiptOfRefund=$this->request->getPost('dateOfReceiptOfRefund');
        $whetherFileAppeal=$this->request->getPost('whetherFileAppeal');
        
        $orderRemark=$this->request->getPost('orderRemark');
        
        $orderRemarkVal = (!empty($orderRemark)) ? htmlspecialchars(htmlentities($orderRemark)) : "";
        
        $updateRectOrderArr=array(
            'rectificationId'           =>  $rectificationId, 
            'fkWorkId'                  =>  $workId,
            'dateOfFinalOrder'          =>  $dateOfFinalOrder, 
            'dateOfReceiptOrder'        =>  $dateOfReceiptOrder, 
            'whetherAcceptable'         =>  $whetherAcceptable, 
            'orderAmountPaid'           =>  $orderAmountPaid, 
            'pmtOfDemandDate'           =>  $pmtOfDemandDate, 
            'finalAmtOfRefund'          =>  $finalAmtOfRefund, 
            'dateOfReceiptOfRefund'     =>  $dateOfReceiptOfRefund, 
            'whetherFileAppeal'         =>  $whetherFileAppeal, 
            'orderRemark'               =>  $orderRemarkVal,  
            'status'                    =>  1, 
            'updatedBy'                 =>  $this->adminId,
            'updatedDatetime'           =>  $this->currTimeStamp
        );
        
        $this->MRectification->save($updateRectOrderArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Rectification Order Details not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Rectification Officer Details updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Rectification Order Details has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function update_rectification_other_amount()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $rectificationId=$this->request->getPost('rectificationId');
        
        $orderType=$this->request->getPost('orderType');
        $rectTotalIncomeAmt=$this->request->getPost('rectTotalIncomeAmt');
        $rectRefundAmt=$this->request->getPost('rectRefundAmt');
        $rectDemandAmt=$this->request->getPost('rectDemandAmt');
        
        $updateRectOrderArr=array(
            'rectificationId'           =>  $rectificationId, 
            'fkWorkId'                  =>  $workId,
            'orderType'                 =>  $orderType, 
            'rectTotalIncomeAmt'        =>  $rectTotalIncomeAmt, 
            'rectRefundAmt'             =>  $rectRefundAmt, 
            'rectDemandAmt'             =>  $rectDemandAmt, 
            'status'                    =>  1, 
            'updatedBy'                 =>  $this->adminId,
            'updatedDatetime'           =>  $this->currTimeStamp
        );
        
        $this->MRectification->save($updateRectOrderArr);
        
        $orderTypeCondtn = array(
            'actOrderTypeId' => $orderType,
            'status' => 1
        );
        
        $orderTypeData=$this->MActOrderType->where($orderTypeCondtn)->first();
        
        $editOrderType = "Other Order";
        
        if(!empty($orderTypeData))
        {
            $editOrderType = $orderTypeData['actOrderTypeName'];
        }
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Rectification ".$editOrderType." Amounts not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Rectification ".$editOrderType." Amounts updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Rectification ".$editOrderType." Amounts has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function add_rectification_hearing_details()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $rectificationId=$this->request->getPost('rectificationId');
        
        $hearingDate=$this->request->getPost('hearingDate');
        $attendedDate=$this->request->getPost('attendedDate');
        $hearingProgress=$this->request->getPost('hearingProgress');
        $proceedingDetails=$this->request->getPost('proceedingDetails');
        $attendedBy=$this->request->getPost('attendedBy');
        $nextHearingDate=$this->request->getPost('nextHearingDate');
        $hearingRemark=$this->request->getPost('hearingRemark');
        
        $insertRectHearingArr=array(
            'fkRectificationId'         =>  $rectificationId, 
            'fkWorkId'                  =>  $workId,
            'hearingDate'               =>  $hearingDate, 
            'attendedDate'              =>  $attendedDate, 
            'hearingProgress'           =>  $hearingProgress, 
            'proceedingDetails'         =>  $proceedingDetails, 
            'attendedBy'                =>  $attendedBy, 
            'nextHearingDate'           =>  $nextHearingDate, 
            'hearingRemark'             =>  $hearingRemark, 
            'status'                    =>  1, 
            'createdBy'                 =>  $this->adminId,
            'createdDatetime'           =>  $this->currTimeStamp
        );
        
        $this->MRectificationHearing->save($insertRectHearingArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Rectification Hearing Details not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Rectification Hearing Details added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Rectification Hearing Details has been added successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function edit_rectification_hearing_details()
	{
	    $this->db->transBegin();
        
        $rectificationHearingId=$this->request->getPost('rectificationHearingId');
        $workId=$this->request->getPost('workId');
        $rectificationId=$this->request->getPost('rectificationId');
        
        $hearingDate=$this->request->getPost('hearingDate');
        $attendedDate=$this->request->getPost('attendedDate');
        $hearingProgress=$this->request->getPost('hearingProgress');
        $proceedingDetails=$this->request->getPost('proceedingDetails');
        $attendedBy=$this->request->getPost('attendedBy');
        $nextHearingDate=$this->request->getPost('nextHearingDate');
        $hearingRemark=$this->request->getPost('hearingRemark');
        
        $updateRectHearingArr=array(
            'rectificationHearingId'    =>  $rectificationHearingId, 
            'fkRectificationId'         =>  $rectificationId, 
            'fkWorkId'                  =>  $workId,
            'hearingDate'               =>  $hearingDate, 
            'attendedDate'              =>  $attendedDate, 
            'hearingProgress'           =>  $hearingProgress, 
            'proceedingDetails'         =>  $proceedingDetails, 
            'attendedBy'                =>  $attendedBy, 
            'nextHearingDate'           =>  $nextHearingDate, 
            'hearingRemark'             =>  $hearingRemark, 
            'status'                    =>  1, 
            'updatedBy'                 =>  $this->adminId,
            'updatedDatetime'           =>  $this->currTimeStamp
        );
        
        $this->MRectificationHearing->save($updateRectHearingArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Rectification Hearing Details not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Rectification Hearing Details updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Rectification Hearing Details has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function delete_rectification_hearing_details()
	{
	    $this->db->transBegin();
        
        $rectificationHearingId=$this->request->getPost('rectificationHearingId');
        $workId=$this->request->getPost('workId');
        $rectificationId=$this->request->getPost('rectificationId');
        
        $rectHearingUpdateCondtn = array(
            'rectificationHearingId'    =>  $rectificationHearingId, 
            'fkWorkId'                  =>  $workId,
            'fkRectificationId'         =>  $rectificationId,
            'status'                    =>  1
        );
    
        $updateRectHearingArr=array(
            'status' => 2, 
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        );
            
        $this->MRectificationHearing->set($updateRectHearingArr)->where($rectHearingUpdateCondtn)->update();
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Rectification Hearing Details not deleted :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Rectification Hearing Details deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Rectification Hearing Details has been deleted successfully :)");
        }
	}
	
	public function scrutiny()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Scrutiny";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate != ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['work_tbl.isScrutiny']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['work_tbl.workId']="ASC";
        
        $workGroupByArr=array('work_tbl.workId');
        
        $workJoinArr[]=array(
                                "tbl"=>"
                                        (
                                            SELECT MAX(scrutiny_notice_tbl.scrNoticeId) AS maxScrNoticeId, scrutiny_notice_tbl.fkWorkId
                                            FROM ".$this->scrutiny_notice_tbl." 
                                            WHERE scrutiny_notice_tbl.status=1
                                            GROUP BY scrutiny_notice_tbl.fkWorkId
                                        ) AS scr_notice_tbl
                                ", 
                                "condtn"=>"scr_notice_tbl.fkWorkId=work_tbl.workId", 
                                "type"=>"left"
                            );
                            
        $workJoinArr[]=array(
                                "tbl"=>"
                                        (
                                            SELECT MAX(scrutiny_notice_reply_tbl.scrNoticeReplyId) AS maxScrNoticeRplyId, scrutiny_notice_reply_tbl.fkWorkId
                                            FROM ".$this->scrutiny_notice_reply_tbl." 
                                            WHERE scrutiny_notice_reply_tbl.status=1
                                            GROUP BY scrutiny_notice_reply_tbl.fkWorkId
                                        ) AS scr_notice_rply_tbl
                                ", 
                                "condtn"=>"scr_notice_rply_tbl.fkWorkId=work_tbl.workId",
                                "type"=>"left"
                            );
                            
        $workJoinArr[]=array("tbl"=>$this->scrutiny_notice_tbl, "condtn"=>"scrutiny_notice_tbl.scrNoticeId=scr_notice_tbl.maxScrNoticeId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->notice_under_section_tbl, "condtn"=>"notice_under_section_tbl.noticeUnderSectionId=scrutiny_notice_tbl.fkNoticeUSId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->scrutiny_notice_reply_tbl, "condtn"=>"scrutiny_notice_reply_tbl.scrNoticeReplyId=scr_notice_rply_tbl.maxScrNoticeRplyId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->hearing_tbl, "condtn"=>"hearing_tbl.fkWorkId=work_tbl.workId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.assessingOfficer,
            work_tbl.wardNo,
            work_tbl.recptFinalOrderDate,
            work_tbl.recptOrderDate,
            due_date_master_tbl.finYear,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            scrutiny_notice_tbl.noticeDueDate,
            notice_under_section_tbl.noticeUnderSectionTitle,
            scrutiny_notice_reply_tbl.attendedOn,
            scrutiny_notice_reply_tbl.attendedBy,
            scrutiny_notice_reply_tbl.nextDate
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        return view('firm_panel/compliance/income_tax/scrutiny', $this->data);
    }
	
	public function scrutiny_case()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $workId=$uri->getSegment(2);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Scrutiny Case";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate != ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['work_tbl.isScrutiny']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['work_tbl.workId']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->demand_tbl, "condtn"=>"demand_tbl.fkWorkId=work_tbl.workId AND demand_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            work_tbl.acknowledgmentNo,
            work_tbl.eFillingDate,
            work_tbl.assessingOfficer,
            work_tbl.inspectorName,
            work_tbl.taxAssistantName,
            work_tbl.wardNo,
            work_tbl.noticeUs,
            work_tbl.placeNo,
            work_tbl.scRemarks,
            work_tbl.recptFinalOrderDate,
            work_tbl.recptOrderDate,
            work_tbl.isAccepted,
            work_tbl.isFileRectification,
            work_tbl.isFileAppeal,
            work_tbl.amountPaid,
            work_tbl.paymentDemandDate,
            work_tbl.finalRefundAmt,
            work_tbl.refundReceiptDate,
            work_tbl.scFinalRemark,
            due_date_master_tbl.finYear,
            client_tbl.clientName,
            client_tbl.clientPanNumber,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            refund_tbl.totalIncome,
            refund_tbl.intiTotalIncome,
            refund_tbl.refundClaimed,
            refund_tbl.refundTotalAmt,
            demand_tbl.demandTotalAmt
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $noticeUSArr=$this->MNoticeUnderSection->where('status', 1)->findAll();

        $this->data['noticeUSArr']=$noticeUSArr;
                        
        $scrNoticeCondtnArr = array(
            'scrutiny_notice_tbl.fkWorkId'  => $workId,
            'scrutiny_notice_tbl.status'    => 1
        );
        
        $scrNoticeJoinArr[]=array("tbl"=>$this->notice_under_section_tbl, "condtn"=>"notice_under_section_tbl.noticeUnderSectionId=scrutiny_notice_tbl.fkNoticeUSId", "type"=>"left");
        
        $scrNoticeColNames = "
            scrutiny_notice_tbl.scrNoticeId,
            scrutiny_notice_tbl.fkWorkId,
            scrutiny_notice_tbl.fkNoticeUSId,
            scrutiny_notice_tbl.noticeDate,
            scrutiny_notice_tbl.noticeDueDate,
            scrutiny_notice_tbl.noticeSubject,
            scrutiny_notice_tbl.noticeRemark,
            notice_under_section_tbl.noticeUnderSectionTitle
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->scrutiny_notice_tbl, $colNames=$scrNoticeColNames, $scrNoticeCondtnArr, $likeCondtnArr=array(), $scrNoticeJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $scrNoticeArr=$query['userData'];

        $this->data['scrNoticeArr']=$scrNoticeArr;
        
        $scrNoticeRplyCondtn = array(
            'fkWorkId'  => $workId,
            'status'    => 1
        );
        
        $scrNoticeRplyArr=$this->MscrutinyNoticeReply->where($scrNoticeRplyCondtn)->findAll();
        
        $this->data['scrNoticeRplyArr']=$scrNoticeRplyArr;

        $scrNoticeReplyArray = array();
        
        if(!empty($scrNoticeRplyArr))
        {
            foreach($scrNoticeRplyArr AS $e_rply)
            {
                $scrNoticeReplyArray[$e_rply['fkScrNoticeId']][]=$e_rply;
            }
        }
        
        $this->data['scrNoticeReplyArray']=$scrNoticeReplyArray;

        return view('firm_panel/compliance/income_tax/scrutiny_case', $this->data);
	}
	
	public function update_scrutiny_notice_details()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $assessingOfficer=$this->request->getPost('assessingOfficer');
        $inspectorName=$this->request->getPost('inspectorName');
        $taxAssistantName=$this->request->getPost('taxAssistantName');
        $wardNo=$this->request->getPost('wardNo');
        $placeNo=$this->request->getPost('placeNo');
        $scRemarks=$this->request->getPost('scRemarks');

        $wkUpdateArr = [
            'assessingOfficer'=>$assessingOfficer,
            'inspectorName'=>$inspectorName,
            'taxAssistantName'=>$taxAssistantName,
            'wardNo'=>$wardNo,
            'placeNo'=>$placeNo,
            'scRemarks'=>$scRemarks,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['work_tbl.workId']=$workId;

        $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Scrutiny Notice Details not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Scrutiny Notice Details updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Scrutiny Notice Details has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function edit_scrutiny_final_outcome()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $recptFinalOrderDate=$this->request->getPost('recptFinalOrderDate');
        $recptOrderDate=$this->request->getPost('recptOrderDate');
        $isAccepted=$this->request->getPost('isAccepted');
        $fileRectification=$this->request->getPost('fileRectification');
        $fileAppeal=$this->request->getPost('fileAppeal');
        $amountPaid=$this->request->getPost('amountPaid');
        $paymentDemandDate=$this->request->getPost('paymentDemandDate');
        $finalRefundAmt=$this->request->getPost('finalRefundAmt');
        $refundReceiptDate=$this->request->getPost('refundReceiptDate');
        $scFinalRemark=$this->request->getPost('scFinalRemark');

        $wkUpdateArr = [
            'recptFinalOrderDate'   =>  $recptFinalOrderDate,
            'recptOrderDate'        =>  $recptOrderDate,
            'isAccepted'            =>  $isAccepted,
            'isFileRectification'   =>  $fileRectification,
            'isFileAppeal'          =>  $fileAppeal,
            'amountPaid'            =>  $amountPaid,
            'paymentDemandDate'     =>  $paymentDemandDate,
            'finalRefundAmt'        =>  $finalRefundAmt,
            'refundReceiptDate'     =>  $refundReceiptDate,
            'scFinalRemark'         =>  $scFinalRemark,
            'updatedBy'             =>  $this->adminId,
            'updatedDatetime'       =>  $this->currTimeStamp
        ];

        $wkCondtnArr['work_tbl.workId']=$workId;

        $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        if($fileRectification==1)
        {
            $rectificationCondtn = array(
                'fkWorkId'              =>  $workId,
                'rectificationType'     =>  2,
                'fkScrutinyId'          =>  $workId,
                'status'                =>  1
            );
            
            $rectficationData = $this->MRectification->where($rectificationCondtn)->findAll();
            
            if(empty($rectficationData))
            {
                $insertRectificationArr=array(
                    'fkWorkId'                  =>  $workId, 
                    'rectificationType'         =>  2,
                    'fkScrutinyId'              =>  $workId,
                    'status'                    =>  1, 
                    'createdBy'                 =>  $this->adminId,
                    'createdDatetime'           =>  $this->currTimeStamp,
                    'updatedBy'                 =>  $this->adminId,
                    'updatedDatetime'           =>  $this->currTimeStamp
                );
                    
                $this->MRectification->save($insertRectificationArr);
            }
        }
        else
        {
            $rectificationCondtn = array(
                'fkWorkId'              =>  $workId, 
                'fkScrutinyId'          =>  $workId,
                'rectificationType'     =>  2,
                'status'                =>  1
            );
            
            $rectficationData = $this->MRectification->where($rectificationCondtn)->findAll();
            
            if(!empty($rectficationData))
            {
                $rectificationUpdateCondtn = array(
                    'fkWorkId'              =>  $workId, 
                    'fkScrutinyId'          =>  $workId,
                    'rectificationType'     =>  2,
                    'status'                =>  1
                );
            
                $updateRectificationArr=array(
                    'status' => 2, 
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                );
                    
                $this->MRectification->set($updateRectificationArr)->where($rectificationUpdateCondtn)->update();
            }
        }
        
        if($fileAppeal==1)
        {
            $appealCondtn = array(
                'fkWorkId'      =>  $workId,
                'levelNo'       =>  1,
                'status'        =>  1
            );
            
            $appealData = $this->Mappeal->where($appealCondtn)->findAll();
            
            if(empty($appealData))
            {
                $insertAppealArr=array(
                    'fkWorkId'                  =>  $workId,
                    'levelNo'                   =>  1,
                    'status'                    =>  1, 
                    'createdBy'                 =>  $this->adminId,
                    'createdDatetime'           =>  $this->currTimeStamp,
                    'updatedBy'                 =>  $this->adminId,
                    'updatedDatetime'           =>  $this->currTimeStamp
                );
                
                $this->Mappeal->save($insertAppealArr);
            }
        }
        else
        {
            $appealCondtn = array(
                'fkWorkId'      =>  $workId,
                'levelNo'       =>  1,
                'status'        =>  1
            );
            
            $appealData = $this->Mappeal->where($appealCondtn)->findAll();
            
            if(!empty($appealData))
            {
                $appealUpdateCondtn = array(
                    'fkWorkId'      =>  $workId,
                    'levelNo'       =>  1,
                    'status'        =>  1
                );
            
                $updateAppealArr=array(
                    'status' => 2, 
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                );
                    
                $this->Mappeal->set($updateAppealArr)->where($appealUpdateCondtn)->update();
            }
        }
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Scrutiny Final Outcome/Decision not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Scrutiny Final Outcome/Decision updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Scrutiny Final Outcome/Decision has been updated successfully :)");
        }
        
        return redirect()->back();
	}

	public function add_scrutiny_notice()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $fkNoticeUSId=$this->request->getPost('fkNoticeUSId');
        $noticeDate=$this->request->getPost('noticeDate');
        $noticeDueDate=$this->request->getPost('noticeDueDate');
        $noticeSubject=$this->request->getPost('noticeSubject');
        $noticeRemark=$this->request->getPost('noticeRemark');

        $scrutinyNoticeArr=array(
            'fkWorkId'          =>  $workId,
            'fkNoticeUSId'      =>  $fkNoticeUSId, 
            'noticeDate'        =>  $noticeDate, 
            'noticeDueDate'     =>  $noticeDueDate, 
            'noticeSubject'     =>  $noticeSubject, 
            'noticeRemark'      =>  $noticeRemark,
            'status'            =>  1, 
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        );
        
        $this->MscrutinyNotice->save($scrutinyNoticeArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Scrutiny Notice not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Scrutiny Notice added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Scrutiny Notice has been added successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function edit_scrutiny_notice()
	{
	    $this->db->transBegin();
        
        $scrNoticeId=$this->request->getPost('scrNoticeId');
        $workId=$this->request->getPost('workId');
        $fkNoticeUSId=$this->request->getPost('fkNoticeUSId');
        $noticeDate=$this->request->getPost('noticeDate');
        $noticeDueDate=$this->request->getPost('noticeDueDate');
        $noticeSubject=$this->request->getPost('noticeSubject');
        $noticeRemark=$this->request->getPost('noticeRemark');
        
        $scrutinyNoticeCondtn = array(
            'scrNoticeId'   =>  $scrNoticeId, 
            'fkWorkId'      =>  $workId
        );
    
        $updateScrutinyNoticeArr=array(
            'fkNoticeUSId'      =>  $fkNoticeUSId, 
            'noticeDate'        =>  $noticeDate, 
            'noticeDueDate'     =>  $noticeDueDate, 
            'noticeSubject'     =>  $noticeSubject, 
            'noticeRemark'      =>  $noticeRemark,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        );
            
        $this->MscrutinyNotice->set($updateScrutinyNoticeArr)->where($scrutinyNoticeCondtn)->update();
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Scrutiny Notice not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Scrutiny Notice updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Scrutiny Notice has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function delete_scrutiny_notice()
	{
	    $this->db->transBegin();
        
        $scrNoticeId=$this->request->getPost('scrNoticeId');
        $workId=$this->request->getPost('workId');
        
        $scrutinyNoticeCondtn = array(
            'scrNoticeId'   =>  $scrNoticeId, 
            'fkWorkId'      =>  $workId,
            'status'        =>  1
        );
    
        $updateScrutinyNoticeArr=array(
            'status' => 2, 
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        );
            
        $this->MscrutinyNotice->set($updateScrutinyNoticeArr)->where($scrutinyNoticeCondtn)->update();
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Scrutiny Notice not deleted :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Scrutiny Notice deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Scrutiny Notice has been deleted successfully :)");
        }
	}
	
	public function add_scrutiny_notice_reply()
	{
	    $this->db->transBegin();
        
        $scrNoticeId=$this->request->getPost('scrNoticeId');
        $workId=$this->request->getPost('workId');
        $letterRefNo=$this->request->getPost('letterRefNo');
        $datedOn=$this->request->getPost('datedOn');
        $repliedOn=$this->request->getPost('repliedOn');
        $attendedBy=$this->request->getPost('attendedBy');
        $attendedOn=$this->request->getPost('attendedOn');
        $nextDate=$this->request->getPost('nextDate');
        $replyRemark=$this->request->getPost('replyRemark');

        $scrutinyNoticeArr=array(
            'fkScrNoticeId'     =>  $scrNoticeId, 
            'fkWorkId'          =>  $workId,
            'letterRefNo'       =>  $letterRefNo, 
            'datedOn'           =>  $datedOn, 
            'repliedOn'         =>  $repliedOn, 
            'attendedBy'        =>  $attendedBy, 
            'attendedOn'        =>  $attendedOn,
            'nextDate'          =>  $nextDate,
            'replyRemark'       =>  $replyRemark,
            'status'            =>  1, 
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        );
        
        $this->MscrutinyNoticeReply->save($scrutinyNoticeArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Notice Reply not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Notice Reply added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Notice Reply has been added successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function edit_scrutiny_notice_reply()
	{
	    $this->db->transBegin();
        
        $scrNoticeReplyId=$this->request->getPost('scrNoticeReplyId');
        $scrNoticeId=$this->request->getPost('scrNoticeId');
        $workId=$this->request->getPost('workId');
        $letterRefNo=$this->request->getPost('letterRefNo');
        $datedOn=$this->request->getPost('datedOn');
        $repliedOn=$this->request->getPost('repliedOn');
        $attendedBy=$this->request->getPost('attendedBy');
        $attendedOn=$this->request->getPost('attendedOn');
        $nextDate=$this->request->getPost('nextDate');
        $replyRemark=$this->request->getPost('replyRemark');
        
        $scrNoticeReplyCondtn = array(
            'scrNoticeReplyId'  =>  $scrNoticeReplyId, 
            'fkScrNoticeId'     =>  $scrNoticeId, 
            'fkWorkId'          =>  $workId
        );
    
        $updateScrNoticeReplyArr=array(
            'letterRefNo'       =>  $letterRefNo, 
            'datedOn'           =>  $datedOn, 
            'repliedOn'         =>  $repliedOn, 
            'attendedBy'        =>  $attendedBy, 
            'attendedOn'        =>  $attendedOn,
            'nextDate'          =>  $nextDate,
            'replyRemark'       =>  $replyRemark,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        );
            
        $this->MscrutinyNoticeReply->set($updateScrNoticeReplyArr)->where($scrNoticeReplyCondtn)->update();
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Notice Reply not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Notice Reply updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Notice Reply has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function delete_scrutiny_notice_reply()
	{
	    $this->db->transBegin();
        
        $scrNoticeReplyId=$this->request->getPost('scrNoticeReplyId');
        $scrNoticeId=$this->request->getPost('scrNoticeId');
        $workId=$this->request->getPost('workId');
        
        $scrNoticeReplyCondtn = array(
            'scrNoticeReplyId'  =>  $scrNoticeReplyId, 
            'fkScrNoticeId'     =>  $scrNoticeId, 
            'fkWorkId'          =>  $workId,
            'status'            =>  1
        );
    
        $updateScrNoticeReplyArr=array(
            'status' => 2, 
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        );
        
        $this->MscrutinyNoticeReply->set($updateScrNoticeReplyArr)->where($scrNoticeReplyCondtn)->update();
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Notice Reply not deleted :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Notice Reply deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Notice Reply has been deleted successfully :)");
        }
	}
	
	public function appeal_menu()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Appeals";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/income_tax/appeal_menu', $this->data);
    }
    
    public function appeal_level($levelNo)
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $this->data['levelNo']=$levelNo;

        $pageTitleMain="Appeal";
        
        $appealTitle=""; 
        
        if($levelNo==1)
        {
            $appealTitle="CIT";
        }
        elseif($levelNo==2)
        {
            $appealTitle="ITAT";
        }
        elseif($levelNo==3)
        {
            $appealTitle="High Court";
        }
        elseif($levelNo==4)
        {
            $appealTitle="SC";
        }

        $pageTitle=$pageTitleMain." - ".$appealTitle;
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['appeal_tbl.levelNo']=$levelNo;
        $workCondtnArr['appeal_tbl.status']="1";
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate != ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['work_tbl.isScrutiny']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['appeal_tbl.appealId']="ASC";
        $workOrderByArr['client_tbl.clientName']="ASC";
        
        $workGroupByArr=array('appeal_tbl.appealId');
        
        // appeal_tbl, appeal_notice_tbl, appeal_notice_reply_tbl
        
        $workJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=appeal_tbl.fkWorkId", "type"=>"left");
        
        $workJoinArr[]=array(
                                "tbl"=>"
                                        (
                                            SELECT MAX(appeal_notice_tbl.applNoticeId) AS maxApplNoticeId, appeal_notice_tbl.fkAppealId
                                            FROM ".$this->appeal_notice_tbl." 
                                            WHERE appeal_notice_tbl.status=1
                                            GROUP BY appeal_notice_tbl.fkAppealId
                                        ) AS appl_notice_tbl
                                ", 
                                "condtn"=>"appl_notice_tbl.fkAppealId=appeal_tbl.appealId", 
                                "type"=>"left"
                            );
                            
        $workJoinArr[]=array(
                                "tbl"=>"
                                        (
                                            SELECT MAX(appeal_notice_reply_tbl.applNoticeReplyId) AS maxApplNoticeRplyId, appeal_notice_reply_tbl.fkAppealId
                                            FROM ".$this->appeal_notice_reply_tbl." 
                                            WHERE appeal_notice_reply_tbl.status=1
                                            GROUP BY appeal_notice_reply_tbl.fkAppealId
                                        ) AS appl_notice_rply_tbl
                                ", 
                                "condtn"=>"appl_notice_rply_tbl.fkAppealId=appeal_tbl.appealId",
                                "type"=>"left"
                            );
                            
        $workJoinArr[]=array("tbl"=>$this->appeal_notice_tbl, "condtn"=>"appeal_notice_tbl.applNoticeId=appl_notice_tbl.maxApplNoticeId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->notice_under_section_tbl, "condtn"=>"notice_under_section_tbl.noticeUnderSectionId=appeal_notice_tbl.fkNoticeUSId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->appeal_notice_reply_tbl, "condtn"=>"appeal_notice_reply_tbl.applNoticeReplyId=appl_notice_rply_tbl.maxApplNoticeRplyId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            appeal_tbl.appealId,
            appeal_tbl.dateOfFinalReceiptOrder,
            due_date_master_tbl.finYear,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            appeal_notice_tbl.noticeDueDate,
            notice_under_section_tbl.noticeUnderSectionTitle,
            appeal_notice_reply_tbl.attendedOn,
            appeal_notice_reply_tbl.attendedBy,
            appeal_notice_reply_tbl.nextDate
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->appeal_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        return view('firm_panel/compliance/income_tax/appeal_level', $this->data);
    }
    
    public function appeal_case($levelNo, $appealId)
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $this->data['levelNo']=$levelNo;
        $this->data['appealId']=$appealId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'wysihtml5');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Appeal Case";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['appeal_tbl.appealId']=$appealId;
        $workCondtnArr['appeal_tbl.levelNo']=$levelNo;
        $workCondtnArr['appeal_tbl.status']="1";
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate != ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['work_tbl.isScrutiny']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['appeal_tbl.appealId']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->act_order_type_master, "condtn"=>"act_order_type_master.actOrderTypeId=appeal_tbl.applOrderType AND act_order_type_master.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=appeal_tbl.fkWorkId AND work_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->demand_tbl, "condtn"=>"demand_tbl.fkWorkId=work_tbl.workId AND demand_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            appeal_tbl.appealId,
            appeal_tbl.levelNo,
            appeal_tbl.applOrderType,
            appeal_tbl.applTotalIncAmt,
            appeal_tbl.applRefundAmt,
            appeal_tbl.applDemandAmt,
            appeal_tbl.disputedAmt,
            appeal_tbl.dateOfOrder,
            appeal_tbl.dateOfReceiptOrder,
            appeal_tbl.assessingOfficer,
            appeal_tbl.wardNo,
            appeal_tbl.locationName,
            appeal_tbl.inspectorName,
            appeal_tbl.taxAssistantName,
            appeal_tbl.dateOfFilingAppeal,
            appeal_tbl.orderRemark,
            appeal_tbl.dateOfFinalOrder,
            appeal_tbl.dateOfFinalReceiptOrder,
            appeal_tbl.isAccepted,
            appeal_tbl.isFileRectification,
            appeal_tbl.isFileAppeal,
            appeal_tbl.finalAmtPaid,
            appeal_tbl.dateOfPmtOfDemand,
            appeal_tbl.finalAmtRefund,
            appeal_tbl.dateOfReceiptOfRefund,
            appeal_tbl.finalOutcomeRemark,
            act_order_type_master.actOrderTypeName,
            work_tbl.workId,
            work_tbl.acknowledgmentNo,
            work_tbl.eFillingDate,
            due_date_master_tbl.finYear,
            client_tbl.clientName,
            client_tbl.clientPanNumber,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            refund_tbl.totalIncome,
            refund_tbl.intiTotalIncome,
            refund_tbl.refundClaimed,
            refund_tbl.refundTotalAmt,
            demand_tbl.demandTotalAmt
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->appeal_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $orderTypeArr=$this->MActOrderType->where('status', 1)->findAll();

        $this->data['orderTypeArr']=$orderTypeArr;
        
        $noticeUSArr=$this->MNoticeUnderSection->where('status', 1)->findAll();

        $this->data['noticeUSArr']=$noticeUSArr;
                        
        $applNoticeCondtnArr = array(
            'appeal_notice_tbl.fkAppealId'  => $appealId,
            'appeal_notice_tbl.status'    => 1
        );
        
        $scrNoticeJoinArr[]=array("tbl"=>$this->notice_under_section_tbl, "condtn"=>"notice_under_section_tbl.noticeUnderSectionId=appeal_notice_tbl.fkNoticeUSId", "type"=>"left");
        
        $applNoticeColNames = "
            appeal_notice_tbl.applNoticeId,
            appeal_notice_tbl.fkAppealId,
            appeal_notice_tbl.fkNoticeUSId,
            appeal_notice_tbl.noticeDate,
            appeal_notice_tbl.noticeDueDate,
            appeal_notice_tbl.noticeSubject,
            appeal_notice_tbl.noticeRemark,
            notice_under_section_tbl.noticeUnderSectionTitle
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->appeal_notice_tbl, $colNames=$applNoticeColNames, $applNoticeCondtnArr, $likeCondtnArr=array(), $scrNoticeJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $applNoticeArr=$query['userData'];

        $this->data['applNoticeArr']=$applNoticeArr;
        
        $applNoticeRplyCondtn = array(
            'fkAppealId'  => $appealId,
            'status'    => 1
        );
        
        $applNoticeRplyArr=$this->MappealNoticeReply->where($applNoticeRplyCondtn)->findAll();
        
        $this->data['applNoticeRplyArr']=$applNoticeRplyArr;

        $applNoticeReplyArray = array();
        
        if(!empty($applNoticeRplyArr))
        {
            foreach($applNoticeRplyArr AS $e_rply)
            {
                $applNoticeReplyArray[$e_rply['fkApplNoticeId']][]=$e_rply;
            }
        }
        
        $this->data['applNoticeReplyArray']=$applNoticeReplyArray;

        return view('firm_panel/compliance/income_tax/appeal_case', $this->data);
    }
	
	public function update_appeal_other_amount()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $appealId=$this->request->getPost('appealId');
        
        $applOrderType=$this->request->getPost('applOrderType');
        $applTotalIncAmt=$this->request->getPost('applTotalIncAmt');
        $applRefundAmt=$this->request->getPost('applRefundAmt');
        $applDemandAmt=$this->request->getPost('applDemandAmt');
        
        $updateApplOrderArr=array(
            'appealId'              =>  $appealId, 
            'fkWorkId'              =>  $workId,
            'applOrderType'         =>  $applOrderType, 
            'applTotalIncAmt'       =>  $applTotalIncAmt, 
            'applRefundAmt'         =>  $applRefundAmt, 
            'applDemandAmt'         =>  $applDemandAmt, 
            'status'                =>  1, 
            'updatedBy'             =>  $this->adminId,
            'updatedDatetime'       =>  $this->currTimeStamp
        );
        
        $this->Mappeal->save($updateApplOrderArr);
        
        $orderTypeCondtn = array(
            'actOrderTypeId' => $applOrderType,
            'status' => 1
        );
        
        $orderTypeData=$this->MActOrderType->where($orderTypeCondtn)->first();
        
        $editOrderType = "Other Order";
        
        if(!empty($orderTypeData))
        {
            $editOrderType = $orderTypeData['actOrderTypeName'];
        }
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Appeal ".$editOrderType." Amounts not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Appeal ".$editOrderType." Amounts updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Appeal ".$editOrderType." Amounts has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function update_appeal_order_details()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $appealId=$this->request->getPost('appealId');
        
        $applOrderType=$this->request->getPost('applOrderType');
        $disputedAmt=$this->request->getPost('disputedAmt');
        $dateOfOrder=$this->request->getPost('dateOfOrder');
        $dateOfReceiptOrder=$this->request->getPost('dateOfReceiptOrder');
        $accessingOfficerName=$this->request->getPost('assessingOfficer');
        $inspectorName=$this->request->getPost('inspectorName');
        $taxAssistantName=$this->request->getPost('taxAssistantName');
        $wardNo=$this->request->getPost('wardNo');
        $locationName=$this->request->getPost('locationName');
        $dateOfFilingAppeal=$this->request->getPost('dateOfFilingAppeal');
        $orderRemark=$this->request->getPost('orderRemark');
        
        $orderRemarkVal = (!empty($orderRemark)) ? htmlspecialchars(htmlentities($orderRemark)) : "";

        $updateRectOfficerArr=array(
            'appealId'              =>  $appealId, 
            'fkWorkId'              =>  $workId,
            'applOrderType'         =>  $applOrderType, 
            'disputedAmt'           =>  $disputedAmt, 
            'dateOfOrder'           =>  $dateOfOrder, 
            'dateOfReceiptOrder'    =>  $dateOfReceiptOrder, 
            'assessingOfficer'      =>  $accessingOfficerName, 
            'inspectorName'         =>  $inspectorName, 
            'taxAssistantName'      =>  $taxAssistantName, 
            'wardNo'                =>  $wardNo, 
            'locationName'          =>  $locationName, 
            'dateOfFilingAppeal'    =>  $dateOfFilingAppeal, 
            'orderRemark'           =>  $orderRemarkVal, 
            'status'                =>  1, 
            'updatedBy'             =>  $this->adminId,
            'updatedDatetime'       =>  $this->currTimeStamp
        );
        
        $this->Mappeal->save($updateRectOfficerArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Appeal Order Details not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Appeal Order Details updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Appeal Order Details has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function add_appeal_notice()
	{
	    $this->db->transBegin();
        
        $appealId=$this->request->getPost('appealId');
        $fkNoticeUSId=$this->request->getPost('fkNoticeUSId');
        $noticeDate=$this->request->getPost('noticeDate');
        $noticeDueDate=$this->request->getPost('noticeDueDate');
        $noticeSubject=$this->request->getPost('noticeSubject');
        $noticeRemark=$this->request->getPost('noticeRemark');

        $appealNoticeArr=array(
            'fkAppealId'        =>  $appealId,
            'fkNoticeUSId'      =>  $fkNoticeUSId, 
            'noticeDate'        =>  $noticeDate, 
            'noticeDueDate'     =>  $noticeDueDate, 
            'noticeSubject'     =>  $noticeSubject, 
            'noticeRemark'      =>  $noticeRemark,
            'status'            =>  1, 
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        );
        
        $this->MappealNotice->save($appealNoticeArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Appeal Notice not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Appeal Notice added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Appeal Notice has been added successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function edit_appeal_notice()
	{
	    $this->db->transBegin();
        
        $applNoticeId=$this->request->getPost('applNoticeId');
        $appealId=$this->request->getPost('appealId');
        $fkNoticeUSId=$this->request->getPost('fkNoticeUSId');
        $noticeDate=$this->request->getPost('noticeDate');
        $noticeDueDate=$this->request->getPost('noticeDueDate');
        $noticeSubject=$this->request->getPost('noticeSubject');
        $noticeRemark=$this->request->getPost('noticeRemark');
        
        $appealNoticeCondtn = array(
            'applNoticeId'  =>  $applNoticeId, 
            'fkAppealId'    =>  $appealId
        );
    
        $updateAppealNoticeArr=array(
            'fkNoticeUSId'      =>  $fkNoticeUSId, 
            'noticeDate'        =>  $noticeDate, 
            'noticeDueDate'     =>  $noticeDueDate, 
            'noticeSubject'     =>  $noticeSubject, 
            'noticeRemark'      =>  $noticeRemark,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        );
        
        $this->MappealNotice->set($updateAppealNoticeArr)->where($appealNoticeCondtn)->update();
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Appeal Notice not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Appeal Notice updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Appeal Notice has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function delete_appeal_notice()
	{
	    $this->db->transBegin();
        
        $applNoticeId=$this->request->getPost('applNoticeId');
        $appealId=$this->request->getPost('appealId');
        
        $appealNoticeCondtn = array(
            'applNoticeId'  =>  $applNoticeId, 
            'fkAppealId'    =>  $appealId,
            'status'        =>  1
        );
    
        $updateAppealNoticeArr=array(
            'status' => 2, 
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        );
        
        $this->MappealNotice->set($updateAppealNoticeArr)->where($appealNoticeCondtn)->update();
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Appeal Notice not deleted :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Appeal Notice deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Appeal Notice has been deleted successfully :)");
        }
	}
	
	public function add_appeal_notice_reply()
	{
	    $this->db->transBegin();
        
        $applNoticeId=$this->request->getPost('applNoticeId');
        $appealId=$this->request->getPost('appealId');
        $letterRefNo=$this->request->getPost('letterRefNo');
        $datedOn=$this->request->getPost('datedOn');
        $repliedOn=$this->request->getPost('repliedOn');
        $attendedBy=$this->request->getPost('attendedBy');
        $attendedOn=$this->request->getPost('attendedOn');
        $nextDate=$this->request->getPost('nextDate');
        $replyRemark=$this->request->getPost('replyRemark');

        $appealNoticeReplyArr=array(
            'fkApplNoticeId'    =>  $applNoticeId, 
            'fkAppealId'        =>  $appealId,
            'letterRefNo'       =>  $letterRefNo, 
            'datedOn'           =>  $datedOn, 
            'repliedOn'         =>  $repliedOn, 
            'attendedBy'        =>  $attendedBy, 
            'attendedOn'        =>  $attendedOn,
            'nextDate'          =>  $nextDate,
            'replyRemark'       =>  $replyRemark,
            'status'            =>  1, 
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        );
        
        $this->MappealNoticeReply->save($appealNoticeReplyArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Notice Reply not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Notice Reply added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Notice Reply has been added successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function edit_appeal_notice_reply()
	{
	    $this->db->transBegin();
        
        $applNoticeReplyId=$this->request->getPost('applNoticeReplyId');
        $applNoticeId=$this->request->getPost('applNoticeId');
        $appealId=$this->request->getPost('appealId');
        $letterRefNo=$this->request->getPost('letterRefNo');
        $datedOn=$this->request->getPost('datedOn');
        $repliedOn=$this->request->getPost('repliedOn');
        $attendedBy=$this->request->getPost('attendedBy');
        $attendedOn=$this->request->getPost('attendedOn');
        $nextDate=$this->request->getPost('nextDate');
        $replyRemark=$this->request->getPost('replyRemark');
        
        $applNoticeReplyCondtn = array(
            'applNoticeReplyId'  =>  $applNoticeReplyId, 
            'fkApplNoticeId'     =>  $applNoticeId, 
            'fkAppealId'         =>  $appealId
        );
    
        $updateApplNoticeReplyArr=array(
            'letterRefNo'       =>  $letterRefNo, 
            'datedOn'           =>  $datedOn, 
            'repliedOn'         =>  $repliedOn, 
            'attendedBy'        =>  $attendedBy, 
            'attendedOn'        =>  $attendedOn,
            'nextDate'          =>  $nextDate,
            'replyRemark'       =>  $replyRemark,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        );
        
        $this->MappealNoticeReply->set($updateApplNoticeReplyArr)->where($applNoticeReplyCondtn)->update();
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Notice Reply not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Notice Reply updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Notice Reply has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function delete_appeal_notice_reply()
	{
	    $this->db->transBegin();
        
        $applNoticeReplyId=$this->request->getPost('applNoticeReplyId');
        $applNoticeId=$this->request->getPost('applNoticeId');
        $appealId=$this->request->getPost('appealId');
        
        $applNoticeReplyCondtn = array(
            'applNoticeReplyId'     =>  $applNoticeReplyId, 
            'fkApplNoticeId'        =>  $applNoticeId, 
            'fkAppealId'            =>  $appealId,
            'status'                =>  1
        );
    
        $updateApplNoticeReplyArr=array(
            'status' => 2, 
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        );
        
        $this->MappealNoticeReply->set($updateApplNoticeReplyArr)->where($applNoticeReplyCondtn)->update();
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Notice Reply not deleted :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Notice Reply deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Notice Reply has been deleted successfully :)");
        }
	}
	
	public function edit_appeal_final_outcome()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $appealId=$this->request->getPost('appealId');
        $levelNo=$this->request->getPost('levelNo');
        $dateOfFinalOrder=$this->request->getPost('dateOfFinalOrder');
        $dateOfFinalReceiptOrder=$this->request->getPost('dateOfFinalReceiptOrder');
        $recptOrderDate=$this->request->getPost('recptOrderDate');
        $isAccepted=$this->request->getPost('isAccepted');
        $fileRectification=$this->request->getPost('fileRectification');
        $fileAppeal=$this->request->getPost('fileAppeal');
        $finalAmtPaid=$this->request->getPost('finalAmtPaid');
        $dateOfPmtOfDemand=$this->request->getPost('dateOfPmtOfDemand');
        $finalAmtRefund=$this->request->getPost('finalAmtRefund');
        $dateOfReceiptOfRefund=$this->request->getPost('dateOfReceiptOfRefund');
        $finalOutcomeRemark=$this->request->getPost('finalOutcomeRemark');

        $applUpdateArr = [
            'dateOfFinalOrder'          =>  $dateOfFinalOrder,
            'dateOfFinalReceiptOrder'   =>  $dateOfFinalReceiptOrder,
            'isAccepted'                =>  $isAccepted,
            'isFileRectification'       =>  $fileRectification,
            'isFileAppeal'              =>  $fileAppeal,
            'finalAmtPaid'              =>  $finalAmtPaid,
            'dateOfPmtOfDemand'         =>  $dateOfPmtOfDemand,
            'finalAmtRefund'            =>  $finalAmtRefund,
            'dateOfReceiptOfRefund'     =>  $dateOfReceiptOfRefund,
            'finalOutcomeRemark'        =>  $finalOutcomeRemark,
            'updatedBy'                 =>  $this->adminId,
            'updatedDatetime'           =>  $this->currTimeStamp
        ];

        $applCondtnArr['appeal_tbl.appealId']=$appealId;

        $query=$this->Mcommon->updateData($tableName=$this->appeal_tbl, $applUpdateArr, $applCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        $currLevel = (int)$levelNo;
        $nextLevel = $levelNo+1;
        
        if($fileRectification==1)
        {
            $rectificationCondtn = array(
                'fkWorkId'              =>  $workId,
                'rectificationType'     =>  3,
                'fkAppealId'            =>  $appealId,
                'status'                =>  1
            );
            
            $rectficationData = $this->MRectification->where($rectificationCondtn)->findAll();
            
            if(empty($rectficationData))
            {
                $insertRectificationArr=array(
                    'fkWorkId'                  =>  $workId, 
                    'rectificationType'         =>  3,
                    'fkAppealId'                =>  $appealId,
                    'status'                    =>  1, 
                    'createdBy'                 =>  $this->adminId,
                    'createdDatetime'           =>  $this->currTimeStamp,
                    'updatedBy'                 =>  $this->adminId,
                    'updatedDatetime'           =>  $this->currTimeStamp
                );
                    
                $this->MRectification->save($insertRectificationArr);
            }
        }
        else
        {
            $rectificationCondtn = array(
                'fkWorkId'              =>  $workId, 
                'fkAppealId'            =>  $appealId,
                'rectificationType'     =>  3,
                'status'                =>  1
            );
            
            $rectficationData = $this->MRectification->where($rectificationCondtn)->findAll();
            
            if(!empty($rectficationData))
            {
                $rectificationUpdateCondtn = array(
                    'fkWorkId'              =>  $workId, 
                    'fkAppealId'            =>  $appealId,
                    'rectificationType'     =>  3,
                    'status'                =>  1
                );
            
                $updateRectificationArr=array(
                    'status' => 2, 
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                );
                    
                $this->MRectification->set($updateRectificationArr)->where($rectificationUpdateCondtn)->update();
            }
        }
        
        if($fileAppeal==1)
        {
            $appealCondtn = array(
                'fkWorkId'      =>  $workId,
                'levelNo'       =>  $nextLevel,
                'status'        =>  1
            );
            
            $appealData = $this->Mappeal->where($appealCondtn)->findAll();
            
            if(empty($appealData))
            {
                $insertAppealArr=array(
                    'fkWorkId'                  =>  $workId,
                    'levelNo'                   =>  $nextLevel,
                    'status'                    =>  1, 
                    'createdBy'                 =>  $this->adminId,
                    'createdDatetime'           =>  $this->currTimeStamp,
                    'updatedBy'                 =>  $this->adminId,
                    'updatedDatetime'           =>  $this->currTimeStamp
                );
                
                $this->Mappeal->save($insertAppealArr);
            }
        }
        else
        {
            $appealCondtn = array(
                'fkWorkId'      =>  $workId,
                'levelNo'       =>  $nextLevel,
                'status'        =>  1
            );
            
            $appealData = $this->Mappeal->where($appealCondtn)->findAll();
            
            if(!empty($appealData))
            {
                $appealUpdateCondtn = array(
                    'fkWorkId'      =>  $workId,
                    'levelNo'       =>  $nextLevel,
                    'status'        =>  1
                );
            
                $updateAppealArr=array(
                    'status' => 2, 
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                );
            
                $this->Mappeal->set($updateAppealArr)->where($appealUpdateCondtn)->update();
            }
        }
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Appeal Final Outcome/Decision not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Appeal Final Outcome/Decision updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Appeal Final Outcome/Decision has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function order_analysis()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $workId=$uri->getSegment(2);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Order Analysis";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['order_analysis_tbl.status']="1";
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate != ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['work_tbl.isScrutiny']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['work_tbl.workId']="ASC";
        $workOrderByArr['order_analysis_tbl.ordAnlyId']="ASC";
        
        $workGroupByArr=array('work_tbl.workId');
                            
        $workJoinArr[]=array("tbl"=>$this->order_analysis_tbl, "condtn"=>"order_analysis_tbl.fkWorkId=work_tbl.workId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            order_analysis_tbl.ordAnlyId,
            order_analysis_tbl.fkWorkId,
            order_analysis_tbl.scrutinyIncAmt,
            order_analysis_tbl.applCITIncAmt,
            order_analysis_tbl.applITATIncAmt,
            refund_tbl.totalIncome
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $orderAnalysisArr=$query['userData'];

        $this->data['orderAnalysisArr']=$orderAnalysisArr;
        
        // echo $query['query'];
        // print_r($orderAnalysisArr);
        // die(' debug 2736');
        
        $ordAnlyExpAddData=array();
        $ordAnlyExpDedData=array();
        $ordTaxData=array();
        
        if(!empty($orderAnalysisArr))
        {
            $ordAnlyId = $orderAnalysisArr['ordAnlyId'];
            
            $ordAnlyExpCondtn = array(
                'fkOrdAnlyId'   =>  $ordAnlyId,
                'status'        =>  1
            );
            
            $ordAnlyExpData = $this->MorderAnalysisExpense->where($ordAnlyExpCondtn)->findAll();
            
            if(!empty($ordAnlyExpData))
            {
                foreach($ordAnlyExpData AS $e_exp)
                {
                    if($e_exp['expType']==1)
                    {
                        $ordAnlyExpAddData[]=$e_exp;
                    }
                    elseif($e_exp['expType']==2)
                    {
                        $ordAnlyExpDedData[]=$e_exp;
                    }
                }
                
                $expTypeColArr = array_unique(array_column($ordAnlyExpData, 'expType'));
            }
            
            $ordAnlyTaxCondtn = array(
                'fkOrdAnlyId'   =>  $ordAnlyId,
                'status'        =>  1
            );
            
            $ordAnlyTaxData = $this->MorderAnalysisTax->where($ordAnlyTaxCondtn)->findAll();
            
            if(!empty($ordAnlyTaxData))
            {
                foreach($ordAnlyTaxData AS $e_ord_tax)
                {
                    if(!empty($e_ord_tax))
                    {
                        foreach($e_ord_tax AS $k_tax=>$e_tax)
                        {
                            $ordTaxData[$e_ord_tax['taxAnalysisType']][$k_tax] = $e_tax;
                        }
                    }
                }
            }
        }
        
        $scrAmtTotalAdd = $applCITNotAmtTotalAdd = $applCITAmtTotalAdd = $applCITAllwdAmtTotalAdd = $applCITRejAmtTotalAdd = $applITATNotAmtTotalAdd = $applITATAmtTotalAdd = $applITATAllwdAmtTotalAdd = $applITATRejAmtTotalAdd = 0;
        
        if(!empty($ordAnlyExpAddData))
        {
            $scrAmtTotalAdd = array_sum(array_column($ordAnlyExpAddData, 'scrAmt'));
            $applCITNotAmtTotalAdd = array_sum(array_column($ordAnlyExpAddData, 'applCITNotAmt'));
            $applCITAmtTotalAdd = array_sum(array_column($ordAnlyExpAddData, 'applCITAmt'));
            $applCITAllwdAmtTotalAdd = array_sum(array_column($ordAnlyExpAddData, 'applCITAllwdAmt'));
            $applCITRejAmtTotalAdd = array_sum(array_column($ordAnlyExpAddData, 'applCITRejAmt'));
            $applITATNotAmtTotalAdd = array_sum(array_column($ordAnlyExpAddData, 'applITATNotAmt'));
            $applITATAmtTotalAdd = array_sum(array_column($ordAnlyExpAddData, 'applITATAmt'));
            $applITATAllwdAmtTotalAdd = array_sum(array_column($ordAnlyExpAddData, 'applITATAllwdAmt'));
            $applITATRejAmtTotalAdd = array_sum(array_column($ordAnlyExpAddData, 'applITATRejAmt'));
        }
        
        $scrAmtTotalDed = $applCITNotAmtTotalDed = $applCITAmtTotalDed = $applCITAllwdAmtTotalDed = $applCITRejAmtTotalDed = $applITATNotAmtTotalDed = $applITATAmtTotalDed = $applITATAllwdAmtTotalDed = $applITATRejAmtTotalDed = 0;
        
        if(!empty($ordAnlyExpDedData))
        {
            $scrAmtTotalDed = array_sum(array_column($ordAnlyExpDedData, 'scrAmt'));
            $applCITNotAmtTotalDed = array_sum(array_column($ordAnlyExpDedData, 'applCITNotAmt'));
            $applCITAmtTotalDed = array_sum(array_column($ordAnlyExpDedData, 'applCITAmt'));
            $applCITAllwdAmtTotalDed = array_sum(array_column($ordAnlyExpDedData, 'applCITAllwdAmt'));
            $applCITRejAmtTotalDed = array_sum(array_column($ordAnlyExpDedData, 'applCITRejAmt'));
            $applITATNotAmtTotalDed = array_sum(array_column($ordAnlyExpDedData, 'applITATNotAmt'));
            $applITATAmtTotalDed = array_sum(array_column($ordAnlyExpDedData, 'applITATAmt'));
            $applITATAllwdAmtTotalDed = array_sum(array_column($ordAnlyExpDedData, 'applITATAllwdAmt'));
            $applITATRejAmtTotalDed = array_sum(array_column($ordAnlyExpDedData, 'applITATRejAmt'));
        }
        
        $this->data['scrAmtTotalAdd']=$scrAmtTotalAdd;
        $this->data['applCITNotAmtTotalAdd']=$applCITNotAmtTotalAdd;
        $this->data['applCITAmtTotalAdd']=$applCITAmtTotalAdd;
        $this->data['applCITAllwdAmtTotalAdd']=$applCITAllwdAmtTotalAdd;
        $this->data['applCITRejAmtTotalAdd']=$applCITRejAmtTotalAdd;
        $this->data['applITATNotAmtTotalAdd']=$applITATNotAmtTotalAdd;
        $this->data['applITATAmtTotalAdd']=$applITATAmtTotalAdd;
        $this->data['applITATAllwdAmtTotalAdd']=$applITATAllwdAmtTotalAdd;
        $this->data['applITATRejAmtTotalAdd']=$applITATRejAmtTotalAdd;
        
        $this->data['scrAmtTotalDed']=$scrAmtTotalDed;
        $this->data['applCITNotAmtTotalDed']=$applCITNotAmtTotalDed;
        $this->data['applCITAmtTotalDed']=$applCITAmtTotalDed;
        $this->data['applCITAllwdAmtTotalDed']=$applCITAllwdAmtTotalDed;
        $this->data['applCITRejAmtTotalDed']=$applCITRejAmtTotalDed;
        $this->data['applITATNotAmtTotalDed']=$applITATNotAmtTotalDed;
        $this->data['applITATAmtTotalDed']=$applITATAmtTotalDed;
        $this->data['applITATAllwdAmtTotalDed']=$applITATAllwdAmtTotalDed;
        $this->data['applITATRejAmtTotalDed']=$applITATRejAmtTotalDed;
        
        $this->data['ordAnlyExpAddData']=$ordAnlyExpAddData;
        $this->data['ordAnlyExpDedData']=$ordAnlyExpDedData;
        $this->data['ordTaxData']=$ordTaxData;
        
        return view('firm_panel/compliance/income_tax/order_analysis', $this->data);
    }
    
    public function edit_order_analysis()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $workId=$uri->getSegment(2);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Edit Order Analysis";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['order_analysis_tbl.status']="1";
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate != ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['work_tbl.isScrutiny']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['work_tbl.workId']="ASC";
        $workOrderByArr['order_analysis_tbl.ordAnlyId']="ASC";
        
        $workGroupByArr=array('work_tbl.workId');
                            
        $workJoinArr[]=array("tbl"=>$this->order_analysis_tbl, "condtn"=>"order_analysis_tbl.fkWorkId=work_tbl.workId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId,
            order_analysis_tbl.ordAnlyId,
            order_analysis_tbl.fkWorkId,
            order_analysis_tbl.scrutinyIncAmt,
            order_analysis_tbl.applCITIncAmt,
            order_analysis_tbl.applITATIncAmt,
            refund_tbl.totalIncome
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $orderAnalysisArr=$query['userData'];

        $this->data['orderAnalysisArr']=$orderAnalysisArr;
        
        // echo $query['query'];
        // print_r($orderAnalysisArr);
        // die(' debug 2736');
        
        $ordAnlyExpAddData=array();
        $ordAnlyExpDedData=array();
        $ordTaxData=array();
        
        if(!empty($orderAnalysisArr))
        {
            $ordAnlyId = $orderAnalysisArr['ordAnlyId'];
            
            $ordAnlyExpCondtn = array(
                'fkOrdAnlyId'   =>  $ordAnlyId,
                'status'        =>  1
            );
            
            $ordAnlyExpData = $this->MorderAnalysisExpense->where($ordAnlyExpCondtn)->findAll();
            
            if(!empty($ordAnlyExpData))
            {
                foreach($ordAnlyExpData AS $e_exp)
                {
                    if($e_exp['expType']==1)
                    {
                        $ordAnlyExpAddData[]=$e_exp;
                    }
                    elseif($e_exp['expType']==2)
                    {
                        $ordAnlyExpDedData[]=$e_exp;
                    }
                }
                
                $expTypeColArr = array_unique(array_column($ordAnlyExpData, 'expType'));
            }
            
            $ordAnlyTaxCondtn = array(
                'fkOrdAnlyId'   =>  $ordAnlyId,
                'status'        =>  1
            );
            
            $ordAnlyTaxData = $this->MorderAnalysisTax->where($ordAnlyTaxCondtn)->findAll();
            
            if(!empty($ordAnlyTaxData))
            {
                foreach($ordAnlyTaxData AS $e_ord_tax)
                {
                    if(!empty($e_ord_tax))
                    {
                        foreach($e_ord_tax AS $k_tax=>$e_tax)
                        {
                            $ordTaxData[$e_ord_tax['taxAnalysisType']][$k_tax] = $e_tax;
                        }
                    }
                }
            }
        }
        
        $this->data['ordAnlyExpAddData']=$ordAnlyExpAddData;
        $this->data['ordAnlyExpDedData']=$ordAnlyExpDedData;
        $this->data['ordTaxData']=$ordTaxData;
        
        return view('firm_panel/compliance/income_tax/edit_order_analysis', $this->data);
    }
    
    public function update_order_analysis()
    {
        $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $ordAnlyId=$this->request->getPost('ordAnlyId');
        
        $ordAnlyExpId=$this->request->getPost('ordAnlyExpId');
        $expType=$this->request->getPost('expType');
        $ordAnlyExpName=$this->request->getPost('ordAnlyExpName');
        $scrAmt=$this->request->getPost('scrAmt');
        $applCITNotAmt=$this->request->getPost('applCITNotAmt');
        $applCITAmt=$this->request->getPost('applCITAmt');
        $applCITAllwdAmt=$this->request->getPost('applCITAllwdAmt');
        $applCITRejAmt=$this->request->getPost('applCITRejAmt');
        $applITATNotAmt=$this->request->getPost('applITATNotAmt');
        $applITATAmt=$this->request->getPost('applITATAmt');
        $applITATAllwdAmt=$this->request->getPost('applITATAllwdAmt');
        $applITATRejAmt=$this->request->getPost('applITATRejAmt');
        
        $scrutinyIncAmt=$this->request->getPost('scrutinyIncAmt');
        $applCITIncAmt=$this->request->getPost('applCITIncAmt');
        $applITATIncAmt=$this->request->getPost('applITATIncAmt');
        
        $ordAnlyTaxId=$this->request->getPost('ordAnlyTaxId');
        $taxAnalysisType=$this->request->getPost('taxAnalysisType');
        $interestAmt=$this->request->getPost('interestAmt');
        $penaltyAmt=$this->request->getPost('penaltyAmt');
        $TDSAmt=$this->request->getPost('TDSAmt');
        $advTaxAmt=$this->request->getPost('advTaxAmt');
        $selfAssmtTaxAmt=$this->request->getPost('selfAssmtTaxAmt');
        $paidAtAppealAmt=$this->request->getPost('paidAtAppealAmt');
        
        $orderAnalysisTaxUpdateArr=array();
        $orderAnalysisTaxUpdateArray=array();
        
        if(!empty($ordAnlyExpId))
        {
            foreach($ordAnlyExpId AS $k_exp=>$e_exp)
            {
                $ordExpUpdateArr[$k_exp] = array(
                    'ordAnlyExpId'      => $e_exp,
                    'fkOrdAnlyId'       => $ordAnlyId,
                    'expType'           => $expType[$k_exp],
                    'ordAnlyExpName'    => $ordAnlyExpName[$k_exp],
                    'scrAmt'            => $scrAmt[$k_exp],
                    'applCITNotAmt'     => $applCITNotAmt[$k_exp],
                    'applCITAmt'        => $applCITAmt[$k_exp],
                    'applCITAllwdAmt'   => $applCITAllwdAmt[$k_exp],
                    'applCITRejAmt'     => $applCITRejAmt[$k_exp],
                    'applITATNotAmt'    => $applITATNotAmt[$k_exp],
                    'applITATAmt'       => $applITATAmt[$k_exp],
                    'applITATAllwdAmt'  => $applITATAllwdAmt[$k_exp],
                    'applITATRejAmt'    => $applITATRejAmt[$k_exp]
                );
                
                if(!empty($e_exp))
                {
                    $timeStampArr = array(
                        'updatedBy'         => $this->adminId,
                        'updatedDatetime'   => $this->currTimeStamp
                    );
                }
                else
                {
                    $timeStampArr = array(
                        'status'            =>  1, 
                        'createdBy'         =>  $this->adminId,
                        'createdDatetime'   =>  $this->currTimeStamp,
                    );
                }
                
                $ordExpUpdateArray = array_merge($ordExpUpdateArr[$k_exp], $timeStampArr);
                
                // print_r($ordExpUpdateArray);
                // die();
                
                $this->MorderAnalysisExpense->save($ordExpUpdateArray);
            }
        }
        
        $ordUpdateCondtn = array(
            'ordAnlyId'     =>  $ordAnlyId,
            'fkWorkId'      =>  $workId
        );
    
        $updateOrdArr=array(
            'scrutinyIncAmt'    => $scrutinyIncAmt, 
            'applCITIncAmt'     => $applCITIncAmt, 
            'applITATIncAmt'    => $applITATIncAmt, 
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        );
        
        $this->MorderAnalysis->set($updateOrdArr)->where($ordUpdateCondtn)->update();
        
        $orderAnalysisTaxUpdateArr=array();
        $orderAnalysisTaxUpdateArray=array();
        
        if(!empty($ordAnlyTaxId))
        {
            foreach($ordAnlyTaxId AS $k_tx=>$e_tx)
            {
                $orderAnalysisTaxUpdateArr[$k_tx] = array(
                    'ordAnlyTaxId'      => $e_tx,
                    'fkOrdAnlyId'       => $ordAnlyId,
                    'taxAnalysisType'   => $taxAnalysisType[$k_tx],
                    'interestAmt'       => $interestAmt[$k_tx],
                    'penaltyAmt'        => $penaltyAmt[$k_tx],
                    'TDSAmt'            => $TDSAmt[$k_tx],
                    'advTaxAmt'         => $advTaxAmt[$k_tx],
                    'selfAssmtTaxAmt'   => $selfAssmtTaxAmt[$k_tx],
                    'paidAtAppealAmt'   => $paidAtAppealAmt[$k_tx],
                    'paidAtAppealAmt'   => $paidAtAppealAmt[$k_tx],
                );
                
                if(!empty($e_tx))
                {
                    $timeStampArr = array(
                        'updatedBy'         => $this->adminId,
                        'updatedDatetime'   => $this->currTimeStamp
                    );
                }
                else
                {
                    $timeStampArr = array(
                        'status'            =>  1, 
                        'createdBy'         =>  $this->adminId,
                        'createdDatetime'   =>  $this->currTimeStamp,
                    );
                }
                
                $orderAnalysisTaxUpdateArray = array_merge($orderAnalysisTaxUpdateArr[$k_tx], $timeStampArr);
                
                $this->MorderAnalysisTax->save($orderAnalysisTaxUpdateArray);
            }
        }
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Order Analysis not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Order Analysis updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Order Analysis has been updated successfully :)");
        }
        
        return redirect()->back();
    }
    
	public function delete_inc_tax_ack_file()
	{
	    $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        
        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";

        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");

        $columnNames = "work_tbl.workId, work_tbl.ackUploadFile";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];
        
        if(!empty($workArr))
        {
            $ackUploadFile=$workArr['ackUploadFile'];
            
            if(!empty($ackUploadFile))
            {
                $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId.'/compliance/income_tax/'.$ackUploadFile;
                
                if(unlink($uploadPath))
                {
                    $wkUpdateArr = [
                        'ackUploadFile'     =>  "",
                        'updatedBy'         => $this->adminId,
                        'updatedDatetime'   => $this->currTimeStamp
                    ];
        
                    $wkCondtnArr['work_tbl.workId']=$workId;
        
                    $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Errror while deleting file :(");
                }
            }
        }
        else
        {
            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Income Tax acknowlegement file not deleted :(");
        }

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Income Tax acknowlegement file not deleted :(");
            
            return false;
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Income Tax acknowlegement file deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Income Tax acknowlegement file has been deleted successfully :)");
            
            return true;
        }
	}
}
?>