<?php namespace App\Controllers\Accounts;
use \App\Controllers\BaseController;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\HTTP\ResponseInterface;

class Receipts extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Receipts";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mact = new \App\Models\Mact();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->Mbill = new \App\Models\Mbill();
        $this->MbillWorkMap = new \App\Models\MbillWorkMap();
        $this->MbillDescription = new \App\Models\MbillDescription();
        $this->Mconfig = new \App\Models\Mconfig();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->MpaymentModes = new \App\Models\MpaymentModes();
        $this->Mreceipts = new \App\Models\Mreceipts();
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
        $this->bill_description_tbl=$tableArr['bill_description_tbl'];
        $this->receipts_tbl=$tableArr['receipts_tbl'];
        
        $currMth=date('n');
        $this->currentMth=date('n');
        $this->currentYear=date('Y');
        
        $this->data['currMth']=$currMth;
    }

    public function create_receipt()
    {
        ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $qBillId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'wysihtml5');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Create Receipt";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $billCondtnArr['bill_tbl.billId']=$qBillId;
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
            bill_tbl.billNo,
            bill_tbl.billDate,
            bill_tbl.totalAmt,
            bill_tbl.taxType,
            bill_tbl.cgstAmt,
            bill_tbl.sgstAmt,
            bill_tbl.igstAmt,
            bill_tbl.totalBillAmt,
            work_tbl.workId,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.finYear,
            due_date_for_tbl.act_option_name AS due_date_for_name,
            act_tbl.act_name,
            periodicity_tbl.periodicity_name,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->bill_tbl, $colNames=$columnNames, $billCondtnArr, $likeCondtnArr=array(), $billJoinArr, $singleRow=TRUE, $billOrderByArr, $billGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $billDataArr=$query['userData'];
    
        $this->data['billDataArr']=$billDataArr;
        
        $billId="";
        $clientId="";
        $workClientName="N/A";
        $DDFName="";
        $billNoVal="N/A";
        $billDateVal="N/A";
        $billPeriod = "N/A";
        $billAmtVal = "N/A";
        $billGstVal = "N/A";
        $billTotalAmtVal="N/A";
        
        if(!empty($billDataArr))
        {
            $billId=$billDataArr['billId'];
            $billNo=$billDataArr['billNo'];
            $billDate=$billDataArr['billDate'];
            $totalAmt=$billDataArr['totalAmt'];
            $taxType=$billDataArr['taxType'];
            $cgstAmt=(float)$billDataArr['cgstAmt'];
            $sgstAmt=(float)$billDataArr['sgstAmt'];
            $igstAmt=(float)$billDataArr['igstAmt'];
            $totalBillAmt=$billDataArr['totalBillAmt'];
            $clientId=$billDataArr['clientId'];
            $clientBussOrgType=$billDataArr['orgType'];
            $due_date_for_name=$billDataArr['due_date_for_name'];

            if(in_array($clientBussOrgType, INDIVIDUAL_ARRAY))
                $workClientName=(!empty($billDataArr['clientName'])) ? $billDataArr['clientName']:"";
            else
                $workClientName=(!empty($billDataArr['clientBussOrganisation'])) ? $billDataArr['clientBussOrganisation']:"";
            
            if(!empty($due_date_for_name))
                $DDFName=$due_date_for_name;

            if(!empty($billNo))
                $billNoVal=$billNo;

            if(check_valid_date($billDate))
                $billDateVal=date('d-m-Y', strtotime($billDate));

            if(!empty($billDataArr['periodicity']))
            {
                $periodicity=$billDataArr['periodicity'];

                if($periodicity==1)
                {
                    $billPeriod = date("d-M-Y", strtotime($billDataArr["daily_date"]));
                }
                elseif($periodicity==2)
                {
                    $billPeriod = date("M", strtotime("2021-".$billDataArr["period_month"]."-01"))."-".$billDataArr["period_year"];
                }
                elseif($periodicity>=3)
                {
                    $billPeriod = date("M", strtotime("2021-".$billDataArr["f_period_month"]."-01"))."-".$billDataArr["f_period_year"]." - ".date("M", strtotime("2021-".$billDataArr["t_period_month"]."-01"))."-".$billDataArr["t_period_year"];
                }
            }

            if(!empty($totalAmt))
                $billAmtVal=amount_format($totalAmt);

            if($taxType == 1){
                $billGstVal = $cgstAmt+$sgstAmt;
            }elseif($taxType == 2){
                $billGstVal = $igstAmt;
            }

            if(!empty($totalBillAmt))
                $billTotalAmtVal=amount_format($totalBillAmt);
        }
        
        $this->data['billId']=$billId;
        $this->data['clientId']=$clientId;
        $this->data['workClientName']=$workClientName;
        $this->data['DDFName']=$DDFName;
        $this->data['billNoVal']=$billNoVal;
        $this->data['billDateVal']=$billDateVal;
        $this->data['billPeriod']=$billPeriod;
        $this->data['billAmtVal']=$billAmtVal;
        $this->data['billGstVal']=$billGstVal;
        $this->data['billTotalAmtVal']=$billTotalAmtVal;

        $pmtModes=$this->MpaymentModes->where('status', 1)
                        ->findAll();

        $this->data['pmtModes']=$pmtModes;

        return view('firm_panel/accounts/receipts/create', $this->data);
    }

    public function generate_receipt()
	{
	    $this->db->transBegin();
	    
	    $billId=$this->request->getPost('billId');
	    $clientId=$this->request->getPost('clientId');
	    $receiptNo = $this->request->getPost('receiptNo');
	    $receiptDate = $this->request->getPost('receiptDate');
	    $receiptMode = $this->request->getPost('receiptMode');
        $receiptChequeNo = $this->request->getPost('receiptChequeNo');
	    $receiptDated = $this->request->getPost('receiptDated');
	    $receiptDrawnOn = $this->request->getPost('receiptDrawnOn');
	    $receiptAmt = $this->request->getPost('receiptAmt');
	    $receiptGst = $this->request->getPost('receiptGst');
	    $receiptTotal = $this->request->getPost('receiptTotal');
	    $receiptTds = $this->request->getPost('receiptTds');
	    $receiptNet = $this->request->getPost('receiptNet');
	    $receiptDepositedToAcc = $this->request->getPost('receiptDepositedToAcc');
	    $receiptRemarks = $this->request->getPost('receiptRemarks');

        if($receiptMode!=4){
            $receiptChequeNo = "";
            $receiptDated = "";
            $receiptDrawnOn = "";
        }

	    $receiptInsertArr=[
            'fkBillId'              =>  $billId,
            'fkClientId'            =>  $clientId,
            'receiptNo'             =>  $receiptNo,
            'receiptDate'           =>  $receiptDate,
            'receiptMode'           =>  $receiptMode,
            'receiptChequeNo'       =>  $receiptChequeNo,
            'receiptDated'          =>  $receiptDated,
            'receiptDrawnOn'        =>  $receiptDrawnOn,
            'receiptAmt'            =>  $receiptAmt,
            'receiptGst'            =>  $receiptGst,
            'receiptTotal'          =>  $receiptTotal,
            'receiptTds'            =>  $receiptTds,
            'receiptNet'            =>  $receiptNet,
            'receiptDepositedToAcc' =>  $receiptDepositedToAcc,
            'receiptRemarks'        =>  $receiptRemarks,
            'receiptCreatedBy'      =>  $this->adminId,
            'status'                =>  1,
            'createdBy'             =>  $this->adminId,
            'createdDatetime'       =>  $this->currTimeStamp
        ];
        
        $this->Mreceipts->save($receiptInsertArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Receipt has not created :(");
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
            
	        $this->session->setFlashdata('successMsg', "Receipt has been created successfully :)");
	    }
	    
	    return redirect()->to("bill-register");
	}

    public function edit_receipt()
    {
        ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $qReceiptId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'wysihtml5');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Edit Receipt";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $billCondtnArr['receipts_tbl.receiptId']=$qReceiptId;
        $billCondtnArr['receipts_tbl.status']="1";
        $billCondtnArr['bill_tbl.status']="1";
        
        $billJoinArr[]=array("tbl"=>$this->bill_tbl, "condtn"=>"bill_tbl.billId=receipts_tbl.fkBillId AND receipts_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->bill_work_map_tbl, "condtn"=>"bill_work_map_tbl.fkBillId=bill_tbl.billId AND bill_work_map_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=bill_work_map_tbl.fkWorkId AND work_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
            receipts_tbl.receiptId,
            receipts_tbl.receiptNo,
            receipts_tbl.receiptDate,
            receipts_tbl.receiptMode,
            receipts_tbl.receiptChequeNo,
            receipts_tbl.receiptDated,
            receipts_tbl.receiptDrawnOn,
            receipts_tbl.receiptAmt,
            receipts_tbl.receiptGst,
            receipts_tbl.receiptTotal,
            receipts_tbl.receiptTds,
            receipts_tbl.receiptNet,
            receipts_tbl.receiptDepositedToAcc,
            receipts_tbl.receiptRemarks,
            bill_tbl.billId,
            bill_tbl.billNo,
            bill_tbl.billDate,
            bill_tbl.totalAmt,
            bill_tbl.taxType,
            bill_tbl.cgstAmt,
            bill_tbl.sgstAmt,
            bill_tbl.igstAmt,
            bill_tbl.totalBillAmt,
            work_tbl.workId,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.finYear,
            due_date_for_tbl.act_option_name AS due_date_for_name,
            act_tbl.act_name,
            periodicity_tbl.periodicity_name,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->receipts_tbl, $colNames=$columnNames, $billCondtnArr, $likeCondtnArr=array(), $billJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $billDataArr=$query['userData'];
    
        $this->data['billDataArr']=$billDataArr;
        
        $billId="";
        $clientId="";
        $workClientName="N/A";
        $DDFName="";
        $billNoVal="N/A";
        $billDateVal="N/A";
        $billPeriod = "N/A";
        $billAmtVal = "N/A";
        $billGstVal = "N/A";
        $billTotalAmtVal="N/A";
        
        if(!empty($billDataArr))
        {
            $billId=$billDataArr['billId'];
            $billNo=$billDataArr['billNo'];
            $billDate=$billDataArr['billDate'];
            $totalAmt=$billDataArr['totalAmt'];
            $taxType=$billDataArr['taxType'];
            $cgstAmt=(float)$billDataArr['cgstAmt'];
            $sgstAmt=(float)$billDataArr['sgstAmt'];
            $igstAmt=(float)$billDataArr['igstAmt'];
            $totalBillAmt=$billDataArr['totalBillAmt'];
            $clientId=$billDataArr['clientId'];
            $clientBussOrgType=$billDataArr['orgType'];
            $due_date_for_name=$billDataArr['due_date_for_name'];

            if(in_array($clientBussOrgType, INDIVIDUAL_ARRAY))
                $workClientName=(!empty($billDataArr['clientName'])) ? $billDataArr['clientName']:"";
            else
                $workClientName=(!empty($billDataArr['clientBussOrganisation'])) ? $billDataArr['clientBussOrganisation']:"";
            
            if(!empty($due_date_for_name))
                $DDFName=$due_date_for_name;

            if(!empty($billNo))
                $billNoVal=$billNo;

            if(check_valid_date($billDate))
                $billDateVal=date('d-m-Y', strtotime($billDate));

            if(!empty($billDataArr['periodicity']))
            {
                $periodicity=$billDataArr['periodicity'];

                if($periodicity==1)
                {
                    $billPeriod = date("d-M-Y", strtotime($billDataArr["daily_date"]));
                }
                elseif($periodicity==2)
                {
                    $billPeriod = date("M", strtotime("2021-".$billDataArr["period_month"]."-01"))."-".$billDataArr["period_year"];
                }
                elseif($periodicity>=3)
                {
                    $billPeriod = date("M", strtotime("2021-".$billDataArr["f_period_month"]."-01"))."-".$billDataArr["f_period_year"]." - ".date("M", strtotime("2021-".$billDataArr["t_period_month"]."-01"))."-".$billDataArr["t_period_year"];
                }
            }

            if(!empty($totalAmt))
                $billAmtVal=amount_format($totalAmt);

            if($taxType == 1){
                $billGstVal = $cgstAmt+$sgstAmt;
            }elseif($taxType == 2){
                $billGstVal = $igstAmt;
            }

            if(!empty($totalBillAmt))
                $billTotalAmtVal=amount_format($totalBillAmt);
        }
        
        $this->data['billId']=$billId;
        $this->data['clientId']=$clientId;
        $this->data['workClientName']=$workClientName;
        $this->data['DDFName']=$DDFName;
        $this->data['billNoVal']=$billNoVal;
        $this->data['billDateVal']=$billDateVal;
        $this->data['billPeriod']=$billPeriod;
        $this->data['billAmtVal']=$billAmtVal;
        $this->data['billGstVal']=$billGstVal;
        $this->data['billTotalAmtVal']=$billTotalAmtVal;

        $pmtModes=$this->MpaymentModes->where('status', 1)
                        ->findAll();

        $this->data['pmtModes']=$pmtModes;

        return view('firm_panel/accounts/receipts/edit', $this->data);
    }

    public function update_receipt()
	{
	    $this->db->transBegin();
	    
	    $receiptId = $this->request->getPost('receiptId');
	    $receiptNo = $this->request->getPost('receiptNo');
	    $receiptDate = $this->request->getPost('receiptDate');
	    $receiptMode = $this->request->getPost('receiptMode');
	    $receiptChequeNo = $this->request->getPost('receiptChequeNo');
	    $receiptDated = $this->request->getPost('receiptDated');
	    $receiptDrawnOn = $this->request->getPost('receiptDrawnOn');
	    $receiptAmt = $this->request->getPost('receiptAmt');
	    $receiptGst = $this->request->getPost('receiptGst');
	    $receiptTotal = $this->request->getPost('receiptTotal');
	    $receiptTds = $this->request->getPost('receiptTds');
	    $receiptNet = $this->request->getPost('receiptNet');
	    $receiptDepositedToAcc = $this->request->getPost('receiptDepositedToAcc');
	    $receiptRemarks = $this->request->getPost('receiptRemarks');

        if($receiptMode!=4){
            $receiptChequeNo = "";
            $receiptDated = "";
            $receiptDrawnOn = "";
        }
	    
	    $receiptUpdateArr=[
            'receiptId'             =>  $receiptId,
            'receiptNo'             =>  $receiptNo,
            'receiptDate'           =>  $receiptDate,
            'receiptMode'           =>  $receiptMode,
            'receiptChequeNo'       =>  $receiptChequeNo,
            'receiptDated'          =>  $receiptDated,
            'receiptDrawnOn'        =>  $receiptDrawnOn,
            'receiptAmt'            =>  $receiptAmt,
            'receiptGst'            =>  $receiptGst,
            'receiptTotal'          =>  $receiptTotal,
            'receiptTds'            =>  $receiptTds,
            'receiptNet'            =>  $receiptNet,
            'receiptDepositedToAcc' =>  $receiptDepositedToAcc,
            'receiptRemarks'        =>  $receiptRemarks,
            'receiptUpdatedBy'      =>  $this->adminId,
            'updatedBy'             =>  $this->adminId,
            'updatedDatetime'       =>  $this->currTimeStamp
        ];
        
        $this->Mreceipts->save($receiptUpdateArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Receipt has not updated :(");
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
            
	        $this->session->setFlashdata('successMsg', "Receipt has been updated successfully :)");
	    }
	    
	    // $secondLastURL = session()->get('second_last_url');
        // return redirect()->to($secondLastURL);
        return redirect()->back();
	}

    public function delete_receipt()
	{
	    $this->db->transBegin();
	    
	    $receiptId=$this->request->getPost('receiptId');

        $receiptUpdateArr=[
            'receiptId'             =>  $receiptId,
            'status'                =>  2,
            'updatedBy'             =>  $this->adminId,
            'updatedDatetime'       =>  $this->currTimeStamp
        ];
        
        $this->Mreceipts->save($receiptUpdateArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', "Receipt has not deleted :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Receipt has been deleted successfully :)");
	    }
	}

    public function view_receipt_pdf($receiptId)
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
        
        $billCondtnArr['receipts_tbl.receiptId']=$receiptId;
        $billCondtnArr['receipts_tbl.status']="1";
        $billCondtnArr['bill_tbl.status']="1";
        
        $billJoinArr[]=array("tbl"=>$this->bill_tbl, "condtn"=>"bill_tbl.billId=receipts_tbl.fkBillId AND receipts_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->bill_work_map_tbl, "condtn"=>"bill_work_map_tbl.fkBillId=bill_tbl.billId AND bill_work_map_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=bill_work_map_tbl.fkWorkId AND work_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->periodicity_tbl, "condtn"=>"periodicity_tbl.periodicity_id=due_date_master_tbl.periodicity AND periodicity_tbl.status=1", "type"=>"left");
        $billJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
            receipts_tbl.receiptId,
            receipts_tbl.receiptNo,
            receipts_tbl.receiptDate,
            receipts_tbl.receiptMode,
            receipts_tbl.receiptChequeNo,
            receipts_tbl.receiptDated,
            receipts_tbl.receiptDrawnOn,
            receipts_tbl.receiptAmt,
            receipts_tbl.receiptGst,
            receipts_tbl.receiptTotal,
            receipts_tbl.receiptTds,
            receipts_tbl.receiptNet,
            receipts_tbl.receiptDepositedToAcc,
            receipts_tbl.receiptRemarks,
            bill_tbl.billId,
            bill_tbl.billNo,
            bill_tbl.billDate,
            bill_tbl.totalAmt,
            bill_tbl.taxType,
            bill_tbl.cgstAmt,
            bill_tbl.sgstAmt,
            bill_tbl.igstAmt,
            bill_tbl.totalBillAmt,
            work_tbl.workId,
            due_date_master_tbl.periodicity,
            due_date_master_tbl.daily_date,
            due_date_master_tbl.period_month,
            due_date_master_tbl.period_year,
            due_date_master_tbl.f_period_month,
            due_date_master_tbl.f_period_year,
            due_date_master_tbl.t_period_month,
            due_date_master_tbl.t_period_year,
            due_date_master_tbl.finYear,
            due_date_for_tbl.act_option_name AS due_date_for_name,
            act_tbl.act_name,
            periodicity_tbl.periodicity_name,
            client_tbl.clientId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->receipts_tbl, $colNames=$columnNames, $billCondtnArr, $likeCondtnArr=array(), $billJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $billDataArr=$query['userData'];
    
        $this->data['billDataArr']=$billDataArr;
        
        $workClientName="";
        $billNoVal="N/A";
        $billDateVal="N/A";
        
        if(!empty($billDataArr))
        {
            $billNo=$billDataArr['billNo'];
            $billDate=$billDataArr['billDate'];
            $clientBussOrgType=$billDataArr['orgType'];

            if(in_array($clientBussOrgType, INDIVIDUAL_ARRAY))
                $workClientName=(!empty($billDataArr['clientName'])) ? $billDataArr['clientName']:"";
            else
                $workClientName=(!empty($billDataArr['clientBussOrganisation'])) ? $billDataArr['clientBussOrganisation']:"";
            
            if(!empty($billNo))
                $billNoVal=$billNo;

            if(check_valid_date($billDate))
                $billDateVal=date('d-m-Y', strtotime($billDate));
        }
        
        $this->data['workClientName']=$workClientName;
        $this->data['billNoVal']=$billNoVal;
        $this->data['billDateVal']=$billDateVal;

        $pmtModes=$this->MpaymentModes->where('status', 1)
                        ->findAll();

        $pmtModesArr = array();

        if(!empty($pmtModes)){
            foreach($pmtModes AS $e_pmt){
                $pmtModesArr[$e_pmt["id"]]=$e_pmt["name"];
            }
        }

        $this->data['pmtModesArr']=$pmtModesArr;
        
        // Create an instance of Dompdf with options
        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        
        // Load your HTML content
        $html = view('firm_panel/accounts/receipts/receipt_template', $this->data);
        
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
        
        $dompdf->setPaper('A6', 'landscape');
        
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