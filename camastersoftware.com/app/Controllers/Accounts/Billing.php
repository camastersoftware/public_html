<?php namespace App\Controllers\Accounts;
use \App\Controllers\BaseController;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\HTTP\ResponseInterface;

class Billing extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Billing";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mact = new \App\Models\Mact();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->Mbill = new \App\Models\Mbill();
        $this->MbillWorkMap = new \App\Models\MbillWorkMap();
        $this->MbillDescription = new \App\Models\MbillDescription();
        $this->Mconfig = new \App\Models\Mconfig();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->act_tbl=$tableArr['act_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->work_junior_map_tbl=$tableArr['work_junior_map_tbl'];
        $this->periodicity_tbl=$tableArr['periodicity_tbl'];
        $this->time_sheet_tbl=$tableArr['time_sheet_tbl'];
        $this->bill_work_map_tbl=$tableArr['bill_work_map_tbl'];
        $this->bill_tbl=$tableArr['bill_tbl'];
        
        $currMth=date('n');
        $this->currentMth=date('n');
        $this->currentYear=date('Y');
        
        $this->data['currMth']=$currMth;
    }

	public function index()
	{
        ini_set('memory_limit', '-1');

	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');

        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Create Bills";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $actId = $this->request->getGet('actId');

        $this->data['actId']=$actId;
        
        $ddfDataArr=$this->Mact_option->where('fk_act_id', $actId)
                    ->where('status', 1)
                    ->orderBy('sortBy', 'ASC')
                    ->findAll();
    
        $this->data['ddfDataArr']=$ddfDataArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
    
        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
    
        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=$actId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";

        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId', 'work_tbl.workId');
        
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->time_sheet_tbl, "condtn"=>"time_sheet_tbl.fkWorkId=work_tbl.workId AND time_sheet_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->bill_work_map_tbl, "condtn"=>"bill_work_map_tbl.fkWorkId=work_tbl.workId AND bill_work_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->bill_tbl, "condtn"=>"bill_tbl.billId=bill_work_map_tbl.fkBillId AND bill_tbl.status=1", "type"=>"left");
        
        $columnNames="
            work_tbl.workId,
            work_tbl.workCode,
            work_tbl.juniors,
            work_tbl.eFillingDate,
            user_tbl.userShortName AS seniorName,
            due_date_master_tbl.due_date_id,
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.finYear,
            ext_due_date_master_tbl.extended_date,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            due_date_for_tbl.act_option_name AS act_option_name1,
            periodicity_tbl.periodicity_name,
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientTitle,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            SUM(time_sheet_tbl.tsTotalCost) AS workTotalCost,
            bill_tbl.billId,
            bill_tbl.billDate,
            bill_tbl.billNo,
            bill_tbl.totalBillAmt
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
    
        $this->data['workDataArr']=$workDataArr;
        
        $DDFDueDateArr=array();
        $DDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $DDFDueDateArr[$e_tx['due_date_id']]=$e_tx;
                
                $DDFDueDateForClientArr[$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['DDFDueDateArr']=$DDFDueDateArr;
        $this->data['DDFDueDateForClientArr']=$DDFDueDateForClientArr;

        $actArr = $this->Mact->where('status', 1)
                    ->findAll();

        $this->data['actArr']=$actArr;
        
	    return view('firm_panel/accounts/billing/list', $this->data);
	}

    public function create_single_ddf()
    {
        ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $qWorkId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'wysihtml5');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Create Bill";
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
        
        $workCondtnArr['work_tbl.workId']=$qWorkId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";

        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId', 'work_tbl.workId');
        
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->time_sheet_tbl, "condtn"=>"time_sheet_tbl.fkWorkId=work_tbl.workId AND time_sheet_tbl.status=1", "type"=>"left");
        
        $columnNames="
            work_tbl.workId,
            work_tbl.workCode,
            work_tbl.juniors,
            work_tbl.eFillingDate,
            user_tbl.userShortName AS seniorName,
            due_date_master_tbl.due_date_id,
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.finYear,
            ext_due_date_master_tbl.extended_date,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            due_date_for_tbl.act_option_name AS due_date_for_name,
            periodicity_tbl.periodicity_name,
            act_tbl.act_id,
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientTitle,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            SUM(time_sheet_tbl.tsTotalCost) AS workTotalCost
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $workGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
    
        $this->data['workDataArr']=$workDataArr;

        $actId="";
        $clientId="";
        $workId="";
        $workClientName="N/A";
        $DDFName="";
        $DDdate="N/A";
        $DDPeriodcity="N/A";
        $DDPeriod="N/A";
        $asmtYear="N/A";
        
        if(!empty($workDataArr))
        {
            $actId=$workDataArr['act_id'];
            $clientId=$workDataArr['clientId'];
            $workId=$workDataArr['workId'];
            $clientBussOrgType=$workDataArr['orgType'];
            $due_date_for_name=$workDataArr['due_date_for_name'];
            $due_date=$workDataArr['extended_date'];
            $periodicity_name=$workDataArr['periodicity_name'];
            $periodicity=$workDataArr['periodicity'];
            
            if(in_array($clientBussOrgType, INDIVIDUAL_ARRAY))
                $workClientName=(!empty($workDataArr['clientName'])) ? $workDataArr['clientName']:"";
            else
                $workClientName=(!empty($workDataArr['clientBussOrganisation'])) ? $workDataArr['clientBussOrganisation']:"";
            
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
                    $DDPeriod = date("d-M-Y", strtotime($workDataArr["daily_date"]));
                }
                elseif($periodicity==2)
                {
                    $DDPeriod = date("M", strtotime("2021-".$workDataArr["period_month"]."-01"))."-".$workDataArr["period_year"];
                }
                elseif($periodicity>=3)
                {
                    $DDPeriod = date("M", strtotime("2021-".$workDataArr["f_period_month"]."-01"))."-".$workDataArr["f_period_year"]." - ".date("M", strtotime("2021-".$workDataArr["t_period_month"]."-01"))."-".$workDataArr["t_period_year"];
                }
            }
                
            if(!empty($workDataArr['finYear']))
            {
                $asmtYearVal=$workDataArr['finYear'];
                
                $asmtYearArr = explode('-', $asmtYearVal);
                
                $fY=(int)$asmtYearArr[0]+1;
                $lY=(int)$asmtYearArr[1]+1;
                
                $asmtYear=$fY."-".$lY;
            }
        }
        
        $this->data['actId']=$actId;
        $this->data['clientId']=$clientId;
        $this->data['workId']=$workId;
        $this->data['workClientName']=$workClientName;
        $this->data['DDFName']=$DDFName;
        $this->data['DDdate']=$DDdate;
        $this->data['DDPeriodcity']=$DDPeriodcity;
        $this->data['DDPeriod']=$DDPeriod;
        $this->data['asmtYear']=$asmtYear;

        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;

        $backUrl = "billing?actId=".$actId;
        $this->data['backUrl']=$backUrl;

        return view('firm_panel/accounts/billing/create_single_ddf', $this->data);
    }

    public function generate_single_ddf()
	{
	    $this->db->transBegin();
	    
	    $billNo=$this->request->getPost('billNo');
	    $billDate=$this->request->getPost('billDate');
	    $billServiceAccCode = $this->request->getPost('billServiceAccCode');
	    $descriptionArr = $this->request->getPost('description');
	    $amountArr = $this->request->getPost('amount');
	    $isLumpsum = $this->request->getPost('isLumpsum');
	    $lumpsumAmt = $this->request->getPost('lumpsumAmt');
	    $totalAmt = $this->request->getPost('totalAmt');
	    $taxType = $this->request->getPost('taxType');
	    $cgst = $this->request->getPost('cgst');
	    $cgstAmt = $this->request->getPost('cgstAmt');
	    $sgst = $this->request->getPost('sgst');
	    $sgstAmt = $this->request->getPost('sgstAmt');
	    $igst = $this->request->getPost('igst');
	    $igstAmt = $this->request->getPost('igstAmt');
	    $totalBillAmt = $this->request->getPost('totalBillAmt');
	    $billNote = $this->request->getPost('billNote');
        $billNoteVal = (!empty($billNote)) ? htmlspecialchars(htmlentities($billNote)) : "";
	    $configId = $this->request->getPost('configId');
        $actId = $this->request->getPost('actId');
        $clientId=$this->request->getPost('clientId');
	    $workId = $this->request->getPost('workId');
	    
	    $billInsertArr=[
            'fkClientId'        =>  $clientId,
            'billNo'            =>  $billNo,
            'billDate'          =>  $billDate,
            'billServiceAccCode'=>  $billServiceAccCode,
            'isLumpsum'         =>  $isLumpsum,
            'lumpsumAmt'        =>  $lumpsumAmt,
            'totalAmt'          =>  $totalAmt,
            'taxType'           =>  $taxType,
            'cgst'              =>  $cgst,
            'sgst'              =>  $sgst,
            'igst'              =>  $igst,
            'cgstAmt'           =>  $cgstAmt,
            'sgstAmt'           =>  $sgstAmt,
            'igstAmt'           =>  $igstAmt,
            'totalBillAmt'      =>  $totalBillAmt,
            'billNote'          =>  $billNote,
            'status'            =>  1,
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        ];
        
        $this->Mbill->save($billInsertArr);
        
        $billId=$this->Mbill->insertID();
        
        if(!empty($billId))
        {
            $billWorkMapInsertArr=[
                'fkBillId'          =>  $billId,
                'fkWorkId'          =>  $workId,
                'status'            =>  1,
                'createdBy'         =>  $this->adminId,
                'createdDatetime'   =>  $this->currTimeStamp
            ];
            
            $this->MbillWorkMap->save($billWorkMapInsertArr);

            if(!empty($descriptionArr))
            {
                foreach($descriptionArr AS $k_row => $e_row)
                {
                    $description = $e_row;
                    $amount = $amountArr[$k_row];
                    
                    $billDescInsertArr=[
                        'fkBillId'          =>  $billId,
                        'description'       =>  $description,
                        'amount'            =>  $amount,
                        'status'            =>  1,
                        'createdBy'         =>  $this->adminId,
                        'createdDatetime'   =>  $this->currTimeStamp
                    ];
                    
                    $this->MbillDescription->save($billDescInsertArr);
                }
            }
        }
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Bill has not created :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Created";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "New Bill has been created successfully :)");
	    }

        $backUrl = base_url("billing?actId=".$actId);
	    
	    return redirect()->to($backUrl);
	}

    public function edit_single_ddf()
    {
        ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $qBillId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'wysihtml5');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Edit Bill";
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
        
        $workCondtnArr['bill_tbl.billId']=$qBillId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['bill_work_map_tbl.status']="1";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";

        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId', 'work_tbl.workId');
        
        $workJoinArr[]=array("tbl"=>$this->bill_work_map_tbl, "condtn"=>"bill_work_map_tbl.fkBillId=bill_tbl.billId AND bill_work_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=bill_work_map_tbl.fkWorkId AND work_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->time_sheet_tbl, "condtn"=>"time_sheet_tbl.fkWorkId=work_tbl.workId AND time_sheet_tbl.status=1", "type"=>"left");
        
        $columnNames="
            work_tbl.workId,
            work_tbl.workCode,
            work_tbl.juniors,
            work_tbl.eFillingDate,
            user_tbl.userShortName AS seniorName,
            due_date_master_tbl.due_date_id,
            due_date_master_tbl.due_date_for,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.finYear,
            ext_due_date_master_tbl.extended_date,
            DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month,
            due_date_for_tbl.act_option_name AS due_date_for_name,
            periodicity_tbl.periodicity_name,
            act_tbl.act_id,
            client_group_tbl.client_group_number,
            client_tbl.clientId,
            client_tbl.clientTitle,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            organisation_type_tbl.shortName AS client_org_short_name,
            SUM(time_sheet_tbl.tsTotalCost) AS workTotalCost,
            bill_work_map_tbl.bill_work_map_id,
            bill_tbl.billId,
            bill_tbl.billDate,
            bill_tbl.billNo,
            bill_tbl.billServiceAccCode,
            bill_tbl.isLumpsum,
            bill_tbl.lumpsumAmt,
            bill_tbl.totalAmt,
            bill_tbl.taxType,
            bill_tbl.cgst,
            bill_tbl.sgst,
            bill_tbl.igst,
            bill_tbl.cgstAmt,
            bill_tbl.sgstAmt,
            bill_tbl.igstAmt,
            bill_tbl.totalBillAmt,
            bill_tbl.billNote
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->bill_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $workGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
    
        $this->data['workDataArr']=$workDataArr;

        $actId="";
        $clientId="";
        $workId="";
        $workClientName="N/A";
        $DDFName="";
        $DDdate="N/A";
        $DDPeriodcity="N/A";
        $DDPeriod="N/A";
        $asmtYear="N/A";
        
        if(!empty($workDataArr))
        {
            $actId=$workDataArr['act_id'];
            $clientId=$workDataArr['clientId'];
            $workId=$workDataArr['workId'];
            $clientBussOrgType=$workDataArr['orgType'];
            $due_date_for_name=$workDataArr['due_date_for_name'];
            $due_date=$workDataArr['extended_date'];
            $periodicity_name=$workDataArr['periodicity_name'];
            $periodicity=$workDataArr['periodicity'];
            
            if(in_array($clientBussOrgType, INDIVIDUAL_ARRAY))
                $workClientName=(!empty($workDataArr['clientName'])) ? $workDataArr['clientName']:"";
            else
                $workClientName=(!empty($workDataArr['clientBussOrganisation'])) ? $workDataArr['clientBussOrganisation']:"";
            
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
                    $DDPeriod = date("d-M-Y", strtotime($workDataArr["daily_date"]));
                }
                elseif($periodicity==2)
                {
                    $DDPeriod = date("M", strtotime("2021-".$workDataArr["period_month"]."-01"))."-".$workDataArr["period_year"];
                }
                elseif($periodicity>=3)
                {
                    $DDPeriod = date("M", strtotime("2021-".$workDataArr["f_period_month"]."-01"))."-".$workDataArr["f_period_year"]." - ".date("M", strtotime("2021-".$workDataArr["t_period_month"]."-01"))."-".$workDataArr["t_period_year"];
                }
            }
                
            if(!empty($workDataArr['finYear']))
            {
                $asmtYearVal=$workDataArr['finYear'];
                
                $asmtYearArr = explode('-', $asmtYearVal);
                
                $fY=(int)$asmtYearArr[0]+1;
                $lY=(int)$asmtYearArr[1]+1;
                
                $asmtYear=$fY."-".$lY;
            }
        }
        
        $this->data['actId']=$actId;
        $this->data['clientId']=$clientId;
        $this->data['workId']=$workId;
        $this->data['workClientName']=$workClientName;
        $this->data['DDFName']=$DDFName;
        $this->data['DDdate']=$DDdate;
        $this->data['DDPeriodcity']=$DDPeriodcity;
        $this->data['DDPeriod']=$DDPeriod;
        $this->data['asmtYear']=$asmtYear;

        $billDescCondtn = array(
            'fkBillId' => $qBillId,    
            'status' => 1    
        );
        
        $billDescArr = $this->MbillDescription->where($billDescCondtn)->findAll();
        
        $this->data['billDescArr']=$billDescArr;

        $backUrl = "billing?actId=".$actId;
        $this->data['backUrl']=$backUrl;

        return view('firm_panel/accounts/billing/edit_single_ddf', $this->data);
    }

    public function update_single_ddf()
	{
	    $this->db->transBegin();
	    
	    $billId=$this->request->getPost('billId');
	    $bill_work_map_id=$this->request->getPost('bill_work_map_id');
	    $billNo=$this->request->getPost('billNo');
	    $billDate=$this->request->getPost('billDate');
	    $billServiceAccCode = $this->request->getPost('billServiceAccCode');
        $billDescptionIdArr = $this->request->getPost('billDescptionId');
	    $descriptionArr = $this->request->getPost('description');
	    $amountArr = $this->request->getPost('amount');
	    $isLumpsum = $this->request->getPost('isLumpsum');
	    $lumpsumAmt = $this->request->getPost('lumpsumAmt');
	    $totalAmt = $this->request->getPost('totalAmt');
	    $taxType = $this->request->getPost('taxType');
	    $cgst = $this->request->getPost('cgst');
	    $cgstAmt = $this->request->getPost('cgstAmt');
	    $sgst = $this->request->getPost('sgst');
	    $sgstAmt = $this->request->getPost('sgstAmt');
	    $igst = $this->request->getPost('igst');
	    $igstAmt = $this->request->getPost('igstAmt');
	    $totalBillAmt = $this->request->getPost('totalBillAmt');
	    $billNote = $this->request->getPost('billNote');
        $billNoteVal = (!empty($billNote)) ? htmlspecialchars(htmlentities($billNote)) : "";
        $actId = $this->request->getPost('actId');
        $clientId=$this->request->getPost('clientId');
	    $workId = $this->request->getPost('workId');
	    
	    $billInsertArr=[
            'billId'            =>  $billId,
            'fkClientId'        =>  $clientId,
            'billNo'            =>  $billNo,
            'billDate'          =>  $billDate,
            'billServiceAccCode'=>  $billServiceAccCode,
            'isLumpsum'         =>  $isLumpsum,
            'lumpsumAmt'        =>  $lumpsumAmt,
            'totalAmt'          =>  $totalAmt,
            'taxType'           =>  $taxType,
            'cgst'              =>  $cgst,
            'sgst'              =>  $sgst,
            'igst'              =>  $igst,
            'cgstAmt'           =>  $cgstAmt,
            'sgstAmt'           =>  $sgstAmt,
            'igstAmt'           =>  $igstAmt,
            'totalBillAmt'      =>  $totalBillAmt,
            'billNote'          =>  $billNote,
            'updatedBy'         =>  $this->adminId,
            'updatedDatetime'   =>  $this->currTimeStamp
        ];
        
        $this->Mbill->save($billInsertArr);

        $billWorkMapInsertArr = [
            'bill_work_map_id'      =>  $bill_work_map_id,
            'fkBillId'              =>  $billId,
            'fkWorkId'              =>  $workId,
            'updatedBy'             =>  $this->adminId,
            'updatedDatetime'       =>  $this->currTimeStamp
        ];
        
        $this->MbillWorkMap->save($billWorkMapInsertArr);

        // print_r($billDescptionIdArr);
        // die();

        if(!empty($billDescptionIdArr))
        {
            foreach($billDescptionIdArr AS $k_row => $e_row)
            {
                $billDescptionId = $e_row;
                $description = $descriptionArr[$k_row];
                $amount = $amountArr[$k_row];
                
                if(!empty($billDescptionId))
                {
                    $billDescInsertArr=[
                        'billDescptionId'   =>  $billDescptionId,
                        'fkBillId'          =>  $billId,
                        'description'       =>  $description,
                        'amount'            =>  $amount,
                        'updatedBy'         =>  $this->adminId,
                        'updatedDatetime'   =>  $this->currTimeStamp
                    ];
                }
                else
                {
                    $billDescInsertArr=[
                        'fkBillId'          =>  $billId,
                        'description'       =>  $description,
                        'amount'            =>  $amount,
                        'status'            =>  1,
                        'createdBy'         =>  $this->adminId,
                        'createdDatetime'   =>  $this->currTimeStamp
                    ];
                }
                
                $this->MbillDescription->save($billDescInsertArr);
            }
        }

        $billDescCondtn = array(
            'fkBillId' => $billId,
            'status' => 1
        );

        $billDescArr = $this->MbillDescription->where($billDescCondtn)->findAll();

        if(!empty($billDescArr)){
            $billDescIdArr = array_column($billDescArr, "billDescptionId");

            $delBillDescIdArr = array_diff($billDescIdArr, $billDescptionIdArr);

            if(!empty($delBillDescIdArr))
            {
                foreach($delBillDescIdArr AS $k_row => $e_row)
                {
                    $delBillDescUpdateArr=[
                        'billDescptionId'   =>  $e_row,
                        'status'            =>  2,
                        'createdBy'         =>  $this->adminId,
                        'createdDatetime'   =>  $this->currTimeStamp
                    ];
                    
                    $this->MbillDescription->save($delBillDescUpdateArr);
                }
            }
        }
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Bill has not updated :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Bill has been updated successfully :)");
	    }

        $backUrl = base_url("billing?actId=".$actId);
	    
	    return redirect()->to($backUrl);
	}

    public function view_single_ddf($billId)
	{
	    setlocale(LC_MONETARY, 'en_IN');
	    ini_set('memory_limit', '-1');
        
        $viewPage=$this->request->getGet('viewPage');
        
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
        
        $billCondtn = array(
            'billId' => $billId,    
            'status' => 1    
        );
        
        $billDataArr = $this->Mbill->where($billCondtn)->get()->getRowArray();
        
        $this->data['billDataArr']=$billDataArr;
        
        $clientId=$billDataArr['fkClientId'];
        
        $billDescCondtn = array(
            'fkBillId' => $billId,    
            'status' => 1    
        );
        
        $billDescArr = $this->MbillDescription->where($billDescCondtn)->findAll();
        
        $this->data['billDescArr']=$billDescArr;
        
        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        $clientCondtnArr['client_tbl.clientName !=']="";
        
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientName, client_tbl.clientBussEmail1, client_tbl.clientBussOfficeAddress, client_tbl.clientResidentialAddress, client_tbl.clientBussOfficePhone1, client_tbl.clientBussResidencePhone", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=TRUE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $this->data['clientData']=$clientData;
        
        $settingsArr = $this->Mconfig->where('status', 1)->get()->getRowArray();
        
        $this->data['settingsArr']=$settingsArr;
        
        // Create an instance of Dompdf with options
        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        
        // Load your HTML content
        $html = view('firm_panel/accounts/bill/bill_template', $this->data);
        
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        
        $contxt = stream_context_create([ 
            'ssl' => [ 
                'verify_peer' => FALSE, 
                'verify_peer_name' => FALSE,
                'allow_self_signed'=> TRUE
            ] 
        ]);
        
        $dompdf->setHttpContext($contxt);
        
        if($viewPage==1)
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

	public function register()
	{
        ini_set('memory_limit', '-1');

	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');

        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Bill Register";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $mth = $this->request->getGet("mth");

        if (empty($mth))
            $mth = date('n');

        $this->data['mth'] = $mth;
        
        $selMth = sprintf("%02d", $mth);

        $fin_year_arr = explode("-", $this->sessDueDateYear);

        $fromYr = $fin_year_arr[0];
        $toYr = "20" . $fin_year_arr[1];

        $this->data['fromYr'] = $fromYr;
        $this->data['toYr'] = $toYr;

        // if ($mth <= 3)
        //     $selYr = $toYr;
        // else
        //     $selYr = $fromYr;

        // $this->data['selYr'] = $selYr;

        // $fromDate = date("Y-m-d", strtotime($selYr . "-" . $selMth . "-01"));
        // $toDate = date("Y-m-d", strtotime($selYr . "-" . $selMth . "-31"));
    
        // $workCondtnArr['bill_tbl.billDate >=']=$fromDate;
        // $workCondtnArr['bill_tbl.billDate <=']=$toDate;
        
        $billCondtnArr['bill_tbl.status']="1";
        $billCondtnArr['bill_tbl.billDate != ']="";
        $billCondtnArr['bill_tbl.billDate !=  ']="0000-00-00";
        $billCondtnArr['bill_tbl.billDate !=']="1970-01-01";

        $billOrderByArr['bill_tbl.billDate']="ASC";
        $billOrderByArr['bill_tbl.billId']="ASC";
        
        $billGroupByArr=array('bill_tbl.billId');
        
        $billJoinArr[]=array("tbl"=>$this->bill_work_map_tbl, "condtn"=>"bill_work_map_tbl.fkBillId=bill_tbl.billId AND bill_work_map_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=bill_work_map_tbl.fkWorkId AND work_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
            bill_tbl.billId,
            bill_tbl.billDate,
            bill_tbl.billNo,
            bill_tbl.totalAmt,
            bill_tbl.cgstAmt,
            bill_tbl.sgstAmt,
            bill_tbl.igstAmt,
            bill_tbl.totalBillAmt,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            act_tbl.act_name,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->bill_tbl, $colNames=$columnNames, $billCondtnArr, $likeCondtnArr=array(), $billJoinArr, $singleRow=FALSE, $billOrderByArr, $billGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $billDataArr=$query['userData'];
    
        $this->data['billDataArr']=$billDataArr;
        
	    return view('firm_panel/accounts/billing/register', $this->data);
	}
}