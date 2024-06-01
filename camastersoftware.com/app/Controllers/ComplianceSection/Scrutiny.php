<?php namespace App\Controllers\ComplianceSection;
use \App\Controllers\BaseController;

class Scrutiny extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Scrutiny";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->MNoticeUnderSection = new \App\Models\MNoticeUnderSection();
        $this->MscrutinyNotice = new \App\Models\MscrutinyNotice();
        $this->MscrutinyNoticeReply = new \App\Models\MscrutinyNoticeReply();
        $this->Mappeal = new \App\Models\Mappeal();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->client_tbl=$tableArr['client_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->notice_under_section_tbl=$tableArr['notice_under_section_tbl'];
        $this->scrutiny_notice_tbl=$tableArr['scrutiny_notice_tbl'];
        $this->scrutiny_notice_reply_tbl=$tableArr['scrutiny_notice_reply_tbl'];
        $this->level_tbl=$tableArr['level_tbl'];
        $this->appeal_tbl=$tableArr['appeal_tbl'];
        $this->scrutiny_tbl=$tableArr['scrutiny_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }
	
	public function it_scrutiny()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Asst-Scrutiny";

        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['scrutiny_tbl.status']="1";
        $workCondtnArr['scrutiny_tbl.actType']=1;
        
        $workOrderByArr['scrutiny_tbl.scrutinyId']="ASC";
        
        $workGroupByArr=array('scrutiny_tbl.scrutinyId');
        
        $workJoinArr[]=array(
                                "tbl"=>"
                                        (
                                            SELECT MAX(scrutiny_notice_tbl.scrNoticeId) AS maxScrNoticeId, scrutiny_notice_tbl.fkScrutinyId
                                            FROM ".$this->scrutiny_notice_tbl." 
                                            WHERE scrutiny_notice_tbl.status=1
                                            GROUP BY scrutiny_notice_tbl.fkScrutinyId
                                        ) AS scr_notice_tbl
                                ", 
                                "condtn"=>"scr_notice_tbl.fkScrutinyId=scrutiny_tbl.scrutinyId",
                                "type"=>"left"
                            );
                            
        $workJoinArr[]=array(
                                "tbl"=>"
                                        (
                                            SELECT MAX(scrutiny_notice_reply_tbl.scrNoticeReplyId) AS maxScrNoticeRplyId, scrutiny_notice_reply_tbl.fkScrutinyId
                                            FROM ".$this->scrutiny_notice_reply_tbl." 
                                            WHERE scrutiny_notice_reply_tbl.status=1
                                            GROUP BY scrutiny_notice_reply_tbl.fkScrutinyId
                                        ) AS scr_notice_rply_tbl
                                ", 
                                "condtn"=>"scr_notice_rply_tbl.fkScrutinyId=scrutiny_tbl.scrutinyId",
                                "type"=>"left"
                            );
                            
        $workJoinArr[]=array("tbl"=>$this->scrutiny_notice_tbl, "condtn"=>"scrutiny_notice_tbl.scrNoticeId=scr_notice_tbl.maxScrNoticeId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->notice_under_section_tbl, "condtn"=>"notice_under_section_tbl.noticeUnderSectionId=scrutiny_notice_tbl.fkNoticeUSId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->scrutiny_notice_reply_tbl, "condtn"=>"scrutiny_notice_reply_tbl.scrNoticeReplyId=scr_notice_rply_tbl.maxScrNoticeRplyId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=scrutiny_tbl.fkClientId", "type"=>"left");
        
        $columnNames = "
            scrutiny_tbl.scrutinyId,
            scrutiny_tbl.assessingOfficer,
            scrutiny_tbl.wardNo,
            scrutiny_tbl.recptFinalOrderDate,
            scrutiny_tbl.recptOrderDate,
            scrutiny_tbl.finYear,
            scrutiny_tbl.fkWorkId,
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType,
            scrutiny_notice_tbl.noticeDueDate,
            notice_under_section_tbl.noticeUnderSectionTitle,
            scrutiny_notice_reply_tbl.attendedOn,
            scrutiny_notice_reply_tbl.attendedBy,
            scrutiny_notice_reply_tbl.nextDate
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->scrutiny_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        return view('firm_panel/compliance/income_tax/scrutiny', $this->data);
    }

    public function add_scrutiny_case()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $scrutinyId=$uri->getSegment(2);

        $this->data['scrutinyId']=$scrutinyId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Add Scrutiny Case";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;

        $workCondtnArr['scrutiny_tbl.scrutinyId']=$scrutinyId;
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['scrutiny_tbl.status']="1";
        $workCondtnArr['scrutiny_tbl.actType']=1;
        
        $workOrderByArr['scrutiny_tbl.scrutinyId']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=scrutiny_tbl.fkClientId", "type"=>"left");
        
        $columnNames = "
            scrutiny_tbl.scrutinyId,
            scrutiny_tbl.acknowledgmentNo,
            scrutiny_tbl.eFillingDate,
            scrutiny_tbl.assessingOfficer,
            scrutiny_tbl.inspectorName,
            scrutiny_tbl.taxAssistantName,
            scrutiny_tbl.wardNo,
            scrutiny_tbl.noticeUs,
            scrutiny_tbl.placeNo,
            scrutiny_tbl.scRemarks,
            scrutiny_tbl.recptFinalOrderDate,
            scrutiny_tbl.recptOrderDate,
            scrutiny_tbl.isAccepted,
            scrutiny_tbl.isFileAppeal,
            scrutiny_tbl.amountPaid,
            scrutiny_tbl.paymentDemandDate,
            scrutiny_tbl.finalRefundAmt,
            scrutiny_tbl.refundReceiptDate,
            scrutiny_tbl.scFinalRemark,
            scrutiny_tbl.finYear,
            scrutiny_tbl.totalIncome,
            scrutiny_tbl.intiTotalIncome,
            scrutiny_tbl.refundClaimed,
            scrutiny_tbl.refundTotalAmt,
            scrutiny_tbl.demandTotalAmt,
            client_tbl.clientName,
            client_tbl.clientPanNumber,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->scrutiny_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $noticeUSArr=$this->MNoticeUnderSection->where('status', 1)->findAll();

        $this->data['noticeUSArr']=$noticeUSArr;
                        
        $scrNoticeCondtnArr = array(
            'scrutiny_notice_tbl.fkScrutinyId'  => $scrutinyId,
            'scrutiny_notice_tbl.status'    => 1
        );
        
        $scrNoticeJoinArr[]=array("tbl"=>$this->notice_under_section_tbl, "condtn"=>"notice_under_section_tbl.noticeUnderSectionId=scrutiny_notice_tbl.fkNoticeUSId", "type"=>"left");
        
        $scrNoticeColNames = "
            scrutiny_notice_tbl.scrNoticeId,
            scrutiny_notice_tbl.fkScrutinyId,
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
            'fkScrutinyId'  => $scrutinyId,
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

        return view('firm_panel/compliance/income_tax/add_scrutiny_case', $this->data);
	}

    public function insert_scrutiny_case()
	{
        $this->db->transBegin();
        
        $fkClientId=$this->request->getPost('fkClientId');
        $finYear=$this->request->getPost('finYear');
        $acknowledgmentNo=$this->request->getPost('acknowledgmentNo');
        $eFillingDate=$this->request->getPost('eFillingDate');
        $totalIncome=$this->request->getPost('totalIncome');
        $intiTotalIncome=$this->request->getPost('intiTotalIncome');
        $refundClaimed=$this->request->getPost('refundClaimed');
        $refundTotalAmt=$this->request->getPost('refundTotalAmt');
        $demandTotalAmt=$this->request->getPost('demandTotalAmt');
        $assessingOfficer=$this->request->getPost('assessingOfficer');
        $inspectorName=$this->request->getPost('inspectorName');
        $wardNo=$this->request->getPost('wardNo');
        $placeNo=$this->request->getPost('placeNo');
        $scRemarks=$this->request->getPost('scRemarks');

        $scrutinyInsertArr[]=array(
            'fkClientId'        =>  $fkClientId,
            'actType'           =>  1, 
            'finYear'           =>  $finYear, 
            'acknowledgmentNo'  =>  $acknowledgmentNo, 
            'eFillingDate'      =>  $eFillingDate, 
            'totalIncome'       =>  $totalIncome,
            'intiTotalIncome'   =>  $intiTotalIncome,
            'refundClaimed'     =>  $refundClaimed,
            'refundTotalAmt'    =>  $refundTotalAmt,
            'demandTotalAmt'    =>  $demandTotalAmt,
            'assessingOfficer'  =>  $assessingOfficer,
            'inspectorName'     =>  $inspectorName,
            'wardNo'            =>  $wardNo,
            'placeNo'           =>  $placeNo,
            'scRemarks'         =>  $scRemarks,
            'isExternal'        =>  1,
            'status'            =>  1, 
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        );
        
        $query=$this->Mquery->insert($tableName=$this->scrutiny_tbl, $scrutinyInsertArr, $returnType="");
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Scrutiny not added :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Scrutiny added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Scrutiny has been added successfully :)");
        }
        
        return redirect()->route("it-scrutiny");
	}
	
	public function scrutiny_case()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $scrutinyId=$uri->getSegment(2);

        $this->data['scrutinyId']=$scrutinyId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Scrutiny Case";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $workCondtnArr['scrutiny_tbl.scrutinyId']=$scrutinyId;
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['scrutiny_tbl.status']="1";
        $workCondtnArr['scrutiny_tbl.actType']=1;
        
        $workOrderByArr['scrutiny_tbl.scrutinyId']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=scrutiny_tbl.fkClientId", "type"=>"left");
        
        $columnNames = "
            scrutiny_tbl.scrutinyId,
            scrutiny_tbl.acknowledgmentNo,
            scrutiny_tbl.eFillingDate,
            scrutiny_tbl.assessingOfficer,
            scrutiny_tbl.inspectorName,
            scrutiny_tbl.taxAssistantName,
            scrutiny_tbl.wardNo,
            scrutiny_tbl.noticeUs,
            scrutiny_tbl.placeNo,
            scrutiny_tbl.scRemarks,
            scrutiny_tbl.recptFinalOrderDate,
            scrutiny_tbl.recptOrderDate,
            scrutiny_tbl.isAccepted,
            scrutiny_tbl.isFileRectification,
            scrutiny_tbl.isFileAppeal,
            scrutiny_tbl.amountPaid,
            scrutiny_tbl.paymentDemandDate,
            scrutiny_tbl.finalRefundAmt,
            scrutiny_tbl.refundReceiptDate,
            scrutiny_tbl.scFinalRemark,
            scrutiny_tbl.finYear,
            scrutiny_tbl.totalIncome,
            scrutiny_tbl.intiTotalIncome,
            scrutiny_tbl.refundClaimed,
            scrutiny_tbl.refundTotalAmt,
            scrutiny_tbl.demandTotalAmt,
            scrutiny_tbl.isExternal,
            scrutiny_tbl.fkWorkId,
            scrutiny_tbl.fkClientId,
            client_tbl.clientName,
            client_tbl.clientPanNumber,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType AS orgType
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->scrutiny_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;
        
        $noticeUSArr=$this->MNoticeUnderSection->where('status', 1)->findAll();

        $this->data['noticeUSArr']=$noticeUSArr;
                        
        $scrNoticeCondtnArr = array(
            'scrutiny_notice_tbl.fkScrutinyId'  => $scrutinyId,
            'scrutiny_notice_tbl.status'    => 1
        );
        
        $scrNoticeJoinArr[]=array("tbl"=>$this->notice_under_section_tbl, "condtn"=>"notice_under_section_tbl.noticeUnderSectionId=scrutiny_notice_tbl.fkNoticeUSId", "type"=>"left");
        
        $scrNoticeColNames = "
            scrutiny_notice_tbl.scrNoticeId,
            scrutiny_notice_tbl.fkScrutinyId,
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
            'fkScrutinyId'  => $scrutinyId,
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
	
	public function update_scrutiny_basic_details()
	{
        $this->db->transBegin();
        
        $scrutinyId=$this->request->getPost('scrutinyId');
        $fkClientId=$this->request->getPost('fkClientId');
        $finYear=$this->request->getPost('finYear');
        $acknowledgmentNo=$this->request->getPost('acknowledgmentNo');
        $eFillingDate=$this->request->getPost('eFillingDate');
        $totalIncome=$this->request->getPost('totalIncome');
        $refundClaimed=$this->request->getPost('refundClaimed');
        $intiTotalIncome=$this->request->getPost('intiTotalIncome');
        $refundTotalAmt=$this->request->getPost('refundTotalAmt');
        $demandTotalAmt=$this->request->getPost('demandTotalAmt');

        $wkUpdateArr = [
            'fkClientId'=>$fkClientId,
            'finYear'=>$finYear,
            'acknowledgmentNo'=>$acknowledgmentNo,
            'eFillingDate'=>$eFillingDate,
            'totalIncome'=>$totalIncome,
            'refundClaimed'=>$refundClaimed,
            'intiTotalIncome'=>$intiTotalIncome,
            'refundTotalAmt'=>$refundTotalAmt,
            'demandTotalAmt'=>$demandTotalAmt,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['scrutiny_tbl.scrutinyId']=$scrutinyId;

        $query=$this->Mcommon->updateData($tableName=$this->scrutiny_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Scrutiny Basic Details not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Scrutiny Basic Details updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Scrutiny Basic Details has been updated successfully :)");
        }
        
        return redirect()->back();
	}
	
	public function update_scrutiny_notice_details()
	{
        $this->db->transBegin();
        
        $scrutinyId=$this->request->getPost('scrutinyId');
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

        $wkCondtnArr['scrutiny_tbl.scrutinyId']=$scrutinyId;

        $query=$this->Mcommon->updateData($tableName=$this->scrutiny_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
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
        
        $scrutinyId=$this->request->getPost('scrutinyId');
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

        $wkCondtnArr['scrutiny_tbl.scrutinyId']=$scrutinyId;

        $query=$this->Mcommon->updateData($tableName=$this->scrutiny_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        if($fileRectification==1)
        {
            $rectificationCondtn = array(
                'fkWorkId'              =>  $workId,
                'rectificationType'     =>  2,
                'fkScrutinyId'          =>  $scrutinyId,
                'status'                =>  1
            );
            
            $rectficationData = $this->MRectification->where($rectificationCondtn)->findAll();
            
            if(empty($rectficationData))
            {
                $insertRectificationArr=array(
                    'fkWorkId'                  =>  $workId, 
                    'rectificationType'         =>  2,
                    'fkScrutinyId'              =>  $scrutinyId,
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
                'fkScrutinyId'          =>  $scrutinyId,
                'rectificationType'     =>  2,
                'status'                =>  1
            );
            
            $rectficationData = $this->MRectification->where($rectificationCondtn)->findAll();
            
            if(!empty($rectficationData))
            {
                $rectificationUpdateCondtn = array(
                    'fkWorkId'              =>  $workId, 
                    'fkScrutinyId'          =>  $scrutinyId,
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
                'fkScrutinyId'  =>  $scrutinyId,
                'levelNo'       =>  1,
                'status'        =>  1
            );
            
            $appealData = $this->Mappeal->where($appealCondtn)->findAll();
            
            if(empty($appealData))
            {
                $insertAppealArr=array(
                    'fkScrutinyId'              =>  $scrutinyId,
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
                'fkScrutinyId'  =>  $scrutinyId,
                'levelNo'       =>  1,
                'status'        =>  1
            );
            
            $appealData = $this->Mappeal->where($appealCondtn)->findAll();
            
            if(!empty($appealData))
            {
                $appealUpdateCondtn = array(
                    'fkScrutinyId'  =>  $scrutinyId,
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
        
        $scrutinyId=$this->request->getPost('scrutinyId');
        $fkNoticeUSId=$this->request->getPost('fkNoticeUSId');
        $noticeDate=$this->request->getPost('noticeDate');
        $noticeDueDate=$this->request->getPost('noticeDueDate');
        $noticeSubject=$this->request->getPost('noticeSubject');
        $noticeRemark=$this->request->getPost('noticeRemark');

        $scrutinyNoticeArr=array(
            'fkScrutinyId'      =>  $scrutinyId,
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
        $scrutinyId=$this->request->getPost('scrutinyId');
        $fkNoticeUSId=$this->request->getPost('fkNoticeUSId');
        $noticeDate=$this->request->getPost('noticeDate');
        $noticeDueDate=$this->request->getPost('noticeDueDate');
        $noticeSubject=$this->request->getPost('noticeSubject');
        $noticeRemark=$this->request->getPost('noticeRemark');
        
        $scrutinyNoticeCondtn = array(
            'scrNoticeId'   =>  $scrNoticeId, 
            'fkScrutinyId'      =>  $scrutinyId
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
        $scrutinyId=$this->request->getPost('scrutinyId');
        
        $scrutinyNoticeCondtn = array(
            'scrNoticeId'   =>  $scrNoticeId, 
            'fkScrutinyId'  =>  $scrutinyId,
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
        $scrutinyId=$this->request->getPost('scrutinyId');
        $letterRefNo=$this->request->getPost('letterRefNo');
        $datedOn=$this->request->getPost('datedOn');
        $repliedOn=$this->request->getPost('repliedOn');
        $attendedBy=$this->request->getPost('attendedBy');
        $attendedOn=$this->request->getPost('attendedOn');
        $nextDate=$this->request->getPost('nextDate');
        $replyRemark=$this->request->getPost('replyRemark');

        $scrutinyNoticeArr=array(
            'fkScrNoticeId'     =>  $scrNoticeId, 
            'fkScrutinyId'      =>  $scrutinyId,
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
        $scrutinyId=$this->request->getPost('scrutinyId');
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
            'fkScrutinyId'      =>  $scrutinyId
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
        $scrutinyId=$this->request->getPost('scrutinyId');
        
        $scrNoticeReplyCondtn = array(
            'scrNoticeReplyId'  =>  $scrNoticeReplyId, 
            'fkScrNoticeId'     =>  $scrNoticeId, 
            'fkScrutinyId'          =>  $scrutinyId,
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
}
?>