<?php
namespace App\Controllers;

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
        $this->Mrefund = new \App\Models\Mrefund();
        $this->Mdemand = new \App\Models\Mdemand();
        $this->MRectification = new \App\Models\MRectification();
        $this->MVerificationMode = new \App\Models\MVerificationMode();
        $this->Mscrutiny = new \App\Models\Mscrutiny();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->act_tbl=$tableArr['act_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->client_document_tbl=$tableArr['client_document_tbl'];
        $this->group_category_tbl=$tableArr['group_category_tbl'];
        $this->salutation_tbl=$tableArr['salutation_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
        $this->client_act_map_tbl=$tableArr['client_act_map_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->work_junior_map_tbl=$tableArr['work_junior_map_tbl'];
        $this->hearing_tbl=$tableArr['hearing_tbl'];
        $this->level_tbl=$tableArr['level_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->rectification_tbl=$tableArr['rectification_tbl'];
        $this->refund_tbl=$tableArr['refund_tbl'];
        $this->demand_tbl=$tableArr['demand_tbl'];
        $this->notice_under_section_tbl=$tableArr['notice_under_section_tbl'];
        $this->scrutiny_tbl=$tableArr['scrutiny_tbl'];
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }

	public function work_form()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $workId=$uri->getSegment(3);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Details of Income Tax Work";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";

        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        
        $columnNames = "
                    work_tbl.workId,
                    work_tbl.workCode,
                    work_tbl.juniors,
                    work_tbl.isDocRecvd,
                    work_tbl.docRecvdDate,
                    work_tbl.seniorId,
                    work_tbl.workDone,
                    work_tbl.isUrgentWork,
                    work_tbl.eFillingDate,
                    work_tbl.verificationDoneBy,
                    work_tbl.verificationMode,
                    work_tbl.acknowledgmentNo,
                    work_tbl.verificationDate,
                    work_tbl.set_prepared_by,
                    work_tbl.ackUploadFile,
                    work_tbl.refundDue,
                    work_tbl.isDefectiveReturn,
                    work_tbl.defectiveReturnComment,
                    work_tbl.isDefectiveRectified,
                    work_tbl.defectiveRectifiedComment,
                    work_tbl.turnOver,
                    work_tbl.isScrutiny,
                    work_tbl.grossTotalIncome,
                    work_tbl.totalIncome,
                    work_tbl.selfAssessmentTax,
                    work_tbl.refundDueVal,
                    work_tbl.refundAmtRecvd,
                    work_tbl.refundDate,
                    work_tbl.refundRemark,
                    work_tbl.fkClientId,
                    work_tbl.intiTotalIncome,
                    work_tbl.intiRefundApproved,
                    work_tbl.intiAddtnlTax,
                    work_tbl.intiRemark,
                    work_tbl.intiIsRectification,
                    work_tbl.intiIsScrutiny,
                    work_tbl.isRectComplete,
                    work_tbl.isApplyAppeal,
                    work_tbl.isBillingDone,
                    work_tbl.isReceiptDone,
                    work_tbl.billNo,
                    work_tbl.billDate,
                    work_tbl.billAmt,
                    work_tbl.receiptDate,
                    work_tbl.receiptAmt,
                    work_tbl.billingComment,
                    work_tbl.receiptComment,
                    work_tbl.workPriority,
                    work_tbl.workPriorityColor,
                    client_tbl.clientName,
                    client_tbl.clientBussOrganisation,
                    client_tbl.clientBussOrganisationType,
                    client_tbl.clientPanNumber,
                    client_tbl.clientDob,
                    client_tbl.clientBussIncorporationDate,
                    user_tbl.userFullName,
                    refund_tbl.refundId,
                    refund_tbl.totalIncome,
                    refund_tbl.refundClaimed,
                    due_date_master_tbl.finYear
                ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        $this->data['workArr']=$workArr;
        
        $clientPanNo="N/A";
        $asmtYear="N/A";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            
            // if($clientBussOrgType==8)
            //     $workClientName=$workArr['clientName']." (".$workArr['clientBussOrganisation'].")";
                
            if(in_array($clientBussOrgType, INDIVIDUAL_ARRAY))
            {
                $workClientName=(!empty($workArr['clientName'])) ? $workArr['clientName']:"";
                $clientDobDoi=(check_valid_date($workArr['clientDob'])) ? date("d-m-Y", strtotime($workArr['clientDob'])):"";
            }
            else
            {
                $workClientName=(!empty($workArr['clientBussOrganisation'])) ? $workArr['clientBussOrganisation']:"";
                $clientDobDoi=(check_valid_date($workArr['clientBussIncorporationDate'])) ? date("d-m-Y", strtotime($workArr['clientBussIncorporationDate'])):"";
            }
            
            if(!empty($workArr['clientPanNumber']))
                $clientPanNo=$workArr['clientPanNumber'];
                
            if(!empty($workArr['finYear']))
            {
                $asmtYearVal=$workArr['finYear'];
                
                $asmtYearArr = explode('-', $asmtYearVal);
                
                $fY=(int)$asmtYearArr[0]+1;
                $lY=(int)$asmtYearArr[1]+1;
                
                $asmtYear=$fY."-".$lY;
            }
        }
        
        $workClientName = (!empty($workClientName)) ? $workClientName : "N/A";
        $clientDobDoi = (!empty($clientDobDoi)) ? $clientDobDoi : "N/A";
        
        $this->data['workClientName']=$workClientName;
        $this->data['clientPanNo']=$clientPanNo;
        $this->data['clientDobDoi']=$clientDobDoi;
        $this->data['asmtYear']=$asmtYear;

        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userStaffType", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        $jnrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
        $jnrCondtnArr['work_junior_map_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_junior_map_tbl, $colNames="work_junior_map_tbl.fkWorkId, work_junior_map_tbl.fkUserId", $jnrCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $jnrList=$query['userData'];

        $this->data['jnrList']=$jnrList;
        
        $rctftnCondtnArr['rectification_tbl.fkWorkId']=$workId;
        $rctftnCondtnArr['rectification_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->rectification_tbl, $colNames="rectification_tbl.rectificationId, rectification_tbl.rectLetterNo, rectification_tbl.rectDate, rectification_tbl.rectFiledDate, rectification_tbl.rectRemark", $rctftnCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $rectftnArr=$query['userData'];

        $this->data['rectftnArr']=$rectftnArr;
        
        $verificationModeCondtn = array(
            'fkActId' => 1,
            'status' => 1
        );
        
        $verificationModeData = $this->MVerificationMode->where($verificationModeCondtn)->findAll();
        
        $this->data['verificationModeData']=$verificationModeData;

        $validationRulesArr['isDocRecvd']=['label' => 'Document Received', 'rules' => 'trim'];
        $validationRulesArr['docRecvdDate']=['label' => 'Document Received Date', 'rules' => 'trim'];
        $validationRulesArr['workDone']=['label' => '% Work Done', 'rules' => 'trim'];
        $validationRulesArr['seniorId']=['label' => 'Senior Allocation', 'rules' => 'trim'];
        $validationRulesArr['isUrgentWork']=['label' => 'Urgent Work', 'rules' => 'trim'];
        $validationRulesArr['eFillingDate']=['label' => 'E-Filling Date', 'rules' => 'trim'];
        $validationRulesArr['acknowledgmentNo']=['label' => 'Acknowledgment No', 'rules' => 'trim'];
        $validationRulesArr['refundDue']=['label' => 'Refund Due', 'rules' => 'trim'];
        $validationRulesArr['isDefectiveReturn']=['label' => 'Defective Return', 'rules' => 'trim'];
        $validationRulesArr['defectiveReturnComment']=['label' => 'Comment', 'rules' => 'trim'];
        $validationRulesArr['verificationDoneBy']=['label' => 'Verification Done By', 'rules' => 'trim'];
        $validationRulesArr['verificationMode']=['label' => 'Verification Mode', 'rules' => 'trim'];
        $validationRulesArr['verificationDate']=['label' => 'Verification Date', 'rules' => 'trim'];
        $validationRulesArr['setPreparedBy']=['label' => 'Set Prepared By', 'rules' => 'trim'];
        $validationRulesArr['isDefectiveRectified']=['label' => 'Defective Rectified', 'rules' => 'trim'];
        $validationRulesArr['defectiveRectifiedComment']=['label' => 'Comment', 'rules' => 'trim'];
        $validationRulesArr['turnOver']=['label' => 'Turn over', 'rules' => 'trim'];
        $validationRulesArr['grossTotalIncome']=['label' => 'Gross Total Income', 'rules' => 'trim'];
        $validationRulesArr['totalIncome']=['label' => 'Total Income', 'rules' => 'trim'];
        $validationRulesArr['selfAssessmentTax']=['label' => 'Self Assessment TAX', 'rules' => 'trim'];

        $isDocRecvdErr="";
        $docRecvdDateErr="";
        $workDoneErr="";
        $seniorIdErr="";
        $isUrgentWorkErr="";
        $eFillingDateErr="";
        $acknowledgmentNoErr="";
        $refundDueErr="";
        $isDefectiveReturnErr="";
        $defectiveReturnCommentErr="";
        $verificationDoneByErr="";
        $verificationModeErr="";
        $verificationDateErr="";
        $setPreparedByErr="";
        $isDefectiveRectifiedErr="";
        $defectiveRectifiedCommentErr="";
        $turnOverErr="";
        $grossTotalIncomeErr="";
        $totalIncomeErr="";
        $selfAssessmentTaxErr="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $isDocRecvdErr=$this->validation->getError('isDocRecvd');
                $docRecvdDateErr=$this->validation->getError('docRecvdDate');
                $workDoneErr=$this->validation->getError('workDone');
                $seniorIdErr=$this->validation->getError('seniorId');
                $isUrgentWorkErr=$this->validation->getError('isUrgentWork');
                $eFillingDateErr=$this->validation->getError('eFillingDate');
                $acknowledgmentNoErr=$this->validation->getError('acknowledgmentNo');
                $refundDueErr=$this->validation->getError('refundDue');
                $isDefectiveReturnErr=$this->validation->getError('isDefectiveReturn');
                $defectiveReturnCommentErr=$this->validation->getError('defectiveReturnComment');
                $verificationDoneByErr=$this->validation->getError('verificationDoneBy');
                $verificationModeErr=$this->validation->getError('verificationMode');
                $verificationDateErr=$this->validation->getError('verificationDate');
                $setPreparedByErr=$this->validation->getError('setPreparedBy');
                $isDefectiveRectifiedErr=$this->validation->getError('isDefectiveRectified');
                $defectiveRectifiedCommentErr=$this->validation->getError('defectiveRectifiedComment');
                $turnOverErr=$this->validation->getError('turnOver');
                $grossTotalIncomeErr=$this->validation->getError('grossTotalIncome');
                $totalIncomeErr=$this->validation->getError('totalIncome');
                $selfAssessmentTaxErr=$this->validation->getError('selfAssessmentTax');
            }
            else
            {
                $this->db->transBegin();
                
                $workId=$this->request->getPost('workId');
                $fkClientId=$this->request->getPost('fkClientId');
                $refundId=$this->request->getPost('refundId');
                $asmtYear=$this->request->getPost('asmtYear');
                $stepData=$this->request->getPost('stepData');
                $isDocRecvd=$this->request->getPost('isDocRecvd');
                $docRecvdDate=$this->request->getPost('docRecvdDate');
                $workDone=$this->request->getPost('workDone');
                $juniorIdArr=$this->request->getPost('juniorId');
                $juniors=$this->request->getPost('juniors');
                $juniorIds=$this->request->getPost('juniorIds');
                $seniorId=$this->request->getPost('seniorId');
                $isUrgentWork=$this->request->getPost('isUrgentWork');
                $eFillingDate=$this->request->getPost('eFillingDate');
                $acknowledgmentNo=$this->request->getPost('acknowledgmentNo');
                $refundDue=$this->request->getPost('refundDue');
                $isDefectiveReturn=$this->request->getPost('isDefectiveReturn');
                $defectiveReturnComment=$this->request->getPost('defectiveReturnComment');
                $verificationDoneBy=$this->request->getPost('verificationDoneBy');
                $verificationMode=$this->request->getPost('verificationMode');
                $verificationDate=$this->request->getPost('verificationDate');
                $setPreparedBy=$this->request->getPost('setPreparedBy');
                $isDefectiveRectified=$this->request->getPost('isDefectiveRectified');
                $defectiveRectifiedComment=$this->request->getPost('defectiveRectifiedComment');
                $turnOver=$this->request->getPost('turnOver');
                $grossTotalIncome=$this->request->getPost('grossTotalIncome');
                $totalIncome=$this->request->getPost('totalIncome');
                $selfAssessmentTax=$this->request->getPost('selfAssessmentTax');
                $rectLetterNo=$this->request->getPost('rectLetterNo');
                $rectDate=$this->request->getPost('rectDate');
                $rectFiledDate=$this->request->getPost('rectFiledDate');
                $rectRemark=$this->request->getPost('rectRemark');
                $isRectComplete=$this->request->getPost('isRectComplete');
                $isApplyAppeal=$this->request->getPost('isApplyAppeal');
                $isBillingDone=$this->request->getPost('isBillingDone'); 
                $billNo=$this->request->getPost('billNo'); 
                $billDate=$this->request->getPost('billDate');
                $billAmt=$this->request->getPost('billAmt');
                $billingComment=$this->request->getPost('billingComment');
                $isReceiptDone=$this->request->getPost('isReceiptDone');
                $receiptDate=$this->request->getPost('receiptDate');
                $receiptAmt=$this->request->getPost('receiptAmt');
                $receiptComment=$this->request->getPost('receiptComment');
                $workPriorityColor=$this->request->getPost('workPriorityColor');
                $workPriority=$this->request->getPost('workPriority');
                $isScrutiny=$this->request->getPost('isScrutiny');
                $ackUploadFile=$this->request->getFile('ackUploadFile');
                $ackUploadFileHidden=$this->request->getPost('ackUploadFileHidden');
        
                $ack_upload_file="";
                if(!empty($ackUploadFile->getTempName()))
                {
                    if($ackUploadFile->isValid() && ! $ackUploadFile->hasMoved())
                    {
                        $ext=$ackUploadFile->guessExtension();
                        
                        if($ext=="pdf")
                        {
                            $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                            if(!is_dir($uploadPath))
                                mkdir($uploadPath, 0777, TRUE);

                            $uploadPath1=$uploadPath.'/compliance';

                            if(!is_dir($uploadPath1))
                                mkdir($uploadPath1, 0777, TRUE);
                                
                            $uploadPath2=$uploadPath1.'/income_tax';

                            if(!is_dir($uploadPath2))
                                mkdir($uploadPath2, 0777, TRUE);
            
                            $ack_upload_file = $ackUploadFile->getRandomName();
                            $ackUploadFile->move($uploadPath2, $ack_upload_file);
                            
                            if(!empty($ackUploadFileHidden))
                            {
                                $delUploadFilePath=$uploadPath2."/".$ackUploadFileHidden;
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
                    $ack_upload_file = $ackUploadFileHidden;
                }
                
                if(empty($isScrutiny))
                {
                    $isScrutiny=0;
                }
                
                if($isDocRecvd==1)
                    $docRecvdDateVal=$docRecvdDate;
                else
                    $docRecvdDateVal="";
                    
                if($isDefectiveRectified==1)
                    $defectiveRectifiedCommentVal=$defectiveRectifiedComment;
                else
                    $defectiveRectifiedCommentVal="";
                    
                if($isBillingDone!=1)
                {
                    $billNo=""; 
                    $billDate=""; 
                    $billAmt="";
                    $billingComment=""; 
                }
                
                if($isReceiptDone!=1)
                {
                    $receiptDate=""; 
                    $receiptAmt=""; 
                    $receiptComment="";
                }
                
                if(!empty($eFillingDate))
                {
                    $workDone=100;
                }

                $wkUpdateArr = [
                    'isDocRecvd'=>$isDocRecvd,
                    'docRecvdDate'=>$docRecvdDateVal,
                    'workDone'=>$workDone,
                    'juniors'=>$juniors,
                    'seniorId'=>$seniorId,
                    'isUrgentWork'=>$isUrgentWork,
                    'eFillingDate'=>$eFillingDate,
                    'acknowledgmentNo'=>$acknowledgmentNo,
                    'refundDue'=>$refundDue,
                    'isDefectiveReturn'=>$isDefectiveReturn,
                    'defectiveReturnComment'=>$defectiveReturnComment,
                    'verificationDoneBy'=>$verificationDoneBy,
                    'verificationMode'=>$verificationMode,
                    'verificationDate'=>$verificationDate,
                    'set_prepared_by'=>$setPreparedBy,
                    'ackUploadFile'=>$ack_upload_file,
                    'isDefectiveRectified'=>$isDefectiveRectified,
                    'defectiveRectifiedComment'=>$defectiveRectifiedCommentVal,
                    'turnOver'=>$turnOver,
                    'grossTotalIncome'=>$grossTotalIncome,
                    'totalIncome'=>$totalIncome,
                    'selfAssessmentTax'=>$selfAssessmentTax,
                    'isRectComplete'=>$isRectComplete,
                    'isApplyAppeal'=>$isApplyAppeal,
                    'isBillingDone'=>$isBillingDone,
                    'billNo'=>$billNo,
                    'billDate'=>$billDate,
                    'billAmt'=>$billAmt,
                    'billingComment'=>$billingComment,
                    'isReceiptDone'=>$isReceiptDone,
                    'receiptDate'=>$receiptDate,
                    'receiptAmt'=>$receiptAmt,
                    'receiptComment'=>$receiptComment,
                    'workPriorityColor'=>$workPriorityColor,
                    'workPriority'=>$workPriority,
                    'isScrutiny'=>$isScrutiny,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
    
                $wkCondtnArr['work_tbl.workId']=$workId;
    
                $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                $junrUpdateArr = [
                    'status'=>2,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
    
                $junrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
    
                $query=$this->Mcommon->updateData($tableName=$this->work_junior_map_tbl, $junrUpdateArr, $junrCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                $junrInsertArr=array();

                if(!empty($juniorIds))
                {
                    $juniorIdsData=explode(", ", $juniorIds);
                    foreach($juniorIdsData AS $e_jnr)
                    {
                        $junrInsertArr[] = [
                            'fkWorkId'=>$workId,
                            'fkUserId'=>$e_jnr,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        ];
                    }

                    $this->Mcommon->insert($tableName=$this->work_junior_map_tbl, $junrInsertArr, $returnType="");
                }
                
                /*
                $rectUpdateArr = [
                    'status'=>2,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
    
                $rectCondtnArr['rectification_tbl.fkWorkId']=$workId;
    
                $query=$this->Mcommon->updateData($tableName=$this->rectification_tbl, $rectUpdateArr, $rectCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                $rectInsertArr=array();

                if(!empty($rectLetterNo))
                {
                    foreach($rectLetterNo AS $k_rect=>$e_rect)
                    {
                        $rectInsertArr[] = [
                            'fkWorkId'=>$workId,
                            'rectLetterNo'=>$e_rect,
                            'rectDate'=>$rectDate[$k_rect],
                            'rectFiledDate'=>$rectFiledDate[$k_rect],
                            'rectRemark'=>$rectRemark[$k_rect],
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        ];
                    }

                    $this->Mcommon->insert($tableName=$this->rectification_tbl, $rectInsertArr, $returnType="");
                }
                */
                
                if(empty($refundId)){
                    $insertIntiArr[]=array(
                        'refundId'          =>  $refundId, 
                        'fkWorkId'          =>  $workId,
                        'refundClaimed'     =>  $refundDue,
                        'totalIncome'       =>  $totalIncome,
                        'status'            =>  1,
                        'createdBy'         =>  $this->adminId,
                        'createdDatetime'   =>  $this->currTimeStamp,
                    );
                    
                    $this->Mcommon->insert($tableName=$this->refund_tbl, $insertIntiArr, $returnType="");
                }else{
                    // $updateIntiArr=array(
                    //     'refundId'          =>  $refundId, 
                    //     'fkWorkId'          =>  $workId,
                    //     'refundClaimed'     =>  $refundDue,
                    //     'totalIncome'       =>  $totalIncome,
                    //     'status'            =>  1,
                    //     'createdBy'         =>  $this->adminId,
                    //     'createdDatetime'   =>  $this->currTimeStamp,
                    //     'updatedBy'         =>  $this->adminId,
                    //     'updatedDatetime'   =>  $this->currTimeStamp
                    // );
                    
                    // $this->Mrefund->save($updateIntiArr);
                    
                    $updateIntiArr=array(
                        'refundClaimed'     =>  $refundDue,
                        'totalIncome'       =>  $totalIncome,
                        'updatedBy'         =>  $this->adminId,
                        'updatedDatetime'   =>  $this->currTimeStamp
                    );
        
                    $refundCondtnArr['refund_tbl.refundId']=$refundId;
                    $refundCondtnArr['refund_tbl.fkWorkId']=$workId;
        
                    $query=$this->Mcommon->updateData($tableName=$this->refund_tbl, $updateIntiArr, $refundCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }

                if($isScrutiny==1)
                {
                    $scrCondtn = array(
                        'fkWorkId'  => $workId,
                        'status'    => 1
                    );
                    
                    $scrDataArr=$this->Mscrutiny->where($scrCondtn)->findAll();

                    if(empty($scrDataArr))
                    {
                        $scrutinyInsertArr=array(
                            'fkWorkId'          =>  $workId,
                            'fkClientId'        =>  $fkClientId,
                            'actType'           =>  1, 
                            'finYear'           =>  $asmtYear, 
                            'acknowledgmentNo'  =>  $acknowledgmentNo, 
                            'eFillingDate'      =>  $eFillingDate, 
                            'totalIncome'       =>  $totalIncome,
                            'intiTotalIncome'   =>  0,
                            'refundClaimed'     =>  $refundDue,
                            'refundTotalAmt'    =>  0,
                            'demandTotalAmt'    =>  0,
                            'isExternal'        =>  2,
                            'status'            =>  1, 
                            'createdBy'         =>  $this->adminId,
                            'createdDatetime'   =>  $this->currTimeStamp
                        );

                        $this->Mscrutiny->save($scrutinyInsertArr);
                    }
                    else
                    {
                        $updateSrcArr=array(
                            'fkClientId'        =>  $fkClientId,
                            'actType'           =>  1, 
                            'finYear'           =>  $asmtYear, 
                            'acknowledgmentNo'  =>  $acknowledgmentNo, 
                            'eFillingDate'      =>  $eFillingDate, 
                            'totalIncome'       =>  $totalIncome,
                            'intiTotalIncome'   =>  0,
                            'refundClaimed'     =>  $refundDue,
                            'refundTotalAmt'    =>  0,
                            'demandTotalAmt'    =>  0,
                            'isExternal'        =>  2,
                            'updatedBy'         =>  $this->adminId,
                            'updatedDatetime'   =>  $this->currTimeStamp
                        );
            
                        $srcCondtnArr['scrutiny_tbl.fkWorkId']=$workId;
                        $srcCondtnArr['scrutiny_tbl.status']=1;
            
                        $this->Mcommon->updateData($tableName=$this->scrutiny_tbl, $updateSrcArr, $srcCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                    }
                }
                elseif($isScrutiny==2)
                {
                    $scrCondtn = array(
                        'fkWorkId'  => $workId,
                        'status'    => 1
                    );
                    
                    $scrDataArr=$this->Mscrutiny->where($scrCondtn)->findAll();

                    if(!empty($scrDataArr))
                    {
                        $updateSrcArr=array(
                            'status'            =>  2,
                            'updatedBy'         =>  $this->adminId,
                            'updatedDatetime'   =>  $this->currTimeStamp
                        );
            
                        $srcCondtnArr['scrutiny_tbl.fkWorkId']=$workId;
                        $srcCondtnArr['scrutiny_tbl.status']=1;
            
                        $this->Mcommon->updateData($tableName=$this->scrutiny_tbl, $updateSrcArr, $srcCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                    }
                }
                
                if($this->db->transStatus() === FALSE)
                {
                    $this->db->transRollback();

                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Work Information not updated :(");
                    
                    // return redirect()->to(base_url('admin/income_tax/work_form/'.$workId));
                }
                else
                {
                    $this->db->transCommit();

                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']="Work Information updated";
                    $insertLogArr['ip']=$this->IPAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mquery->insertLog($insertLogArr);

                    $this->session->setFlashdata('successMsg', "Work Information updated successfully :)");
                    
                    // return redirect()->to(base_url('admin/admin/inc_tax_returns'));
                }
                
                return redirect()->back();

                // return redirect()->route('admin/income_tax/work_form/'.$workId);
            }
        }

        $this->data['isDocRecvdErr']=$isDocRecvdErr;
        $this->data['docRecvdDateErr']=$docRecvdDateErr;
        $this->data['workDoneErr']=$workDoneErr;
        $this->data['seniorIdErr']=$seniorIdErr;
        $this->data['isUrgentWorkErr']=$isUrgentWorkErr;
        $this->data['eFillingDateErr']=$eFillingDateErr;
        $this->data['acknowledgmentNoErr']=$acknowledgmentNoErr;
        $this->data['refundDueErr']=$refundDueErr;
        $this->data['isDefectiveReturnErr']=$isDefectiveReturnErr;
        $this->data['defectiveReturnCommentErr']=$defectiveReturnCommentErr;
        $this->data['verificationDoneByErr']=$verificationDoneByErr;
        $this->data['verificationModeErr']=$verificationModeErr;
        $this->data['verificationDateErr']=$verificationDateErr;
        $this->data['setPreparedByErr']=$setPreparedByErr;
        $this->data['isDefectiveRectifiedErr']=$isDefectiveRectifiedErr;
        $this->data['defectiveRectifiedCommentErr']=$defectiveRectifiedCommentErr;
        $this->data['turnOverErr']=$turnOverErr;
        $this->data['grossTotalIncomeErr']=$grossTotalIncomeErr;
        $this->data['totalIncomeErr']=$totalIncomeErr;
        $this->data['selfAssessmentTaxErr']=$selfAssessmentTaxErr;

        return view('firm_panel/compliance/income_tax/work_form', $this->data);
    }
    
    public function updateIntimationOld()
	{
        $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $intiTotalIncome=$this->request->getPost('intiTotalIncome');
        $intiRefundApproved=$this->request->getPost('intiRefundApproved');
        $intiAddtnlTax=$this->request->getPost('intiAddtnlTax');
        $intiRemark=$this->request->getPost('intiRemark');
        $intiIsRectification=$this->request->getPost('intiIsRectification');
        $refundDueVal=$this->request->getPost('refundDueVal');
        $refundDate=$this->request->getPost('refundDate');
        $refundInterest=$this->request->getPost('refundInterest');
        $refundAmtRecvd=$this->request->getPost('refundAmtRecvd');
        $totalRefundRecvd=$this->request->getPost('totalRefundRecvd');
        $refundRemark=$this->request->getPost('refundRemark');

        $wkUpdateArr = [
            // 'refundDueVal'=>$refundDueVal,
            // 'refundDate'=>$refundDate,
            // 'refundInterest'=>$refundInterest,
            // 'refundAmtRecvd'=>$refundAmtRecvd,
            // 'totalRefundRecvd'=>$totalRefundRecvd,
            // 'refundRemark'=>$refundRemark,
            'intiTotalIncome'=>$intiTotalIncome,
            'intiRefundApproved'=>$intiRefundApproved,
            'intiAddtnlTax'=>$intiAddtnlTax,
            'intiRemark'=>$intiRemark,
            'intiIsRectification'=>$intiIsRectification,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['work_tbl.workId']=$workId;

        $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Intimation not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Intimation updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Intimation has been updated successfully :)");
        }
        
        return redirect()->route('processing');
    }
    
    public function work_form_bak()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $workId=$uri->getSegment(3);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Compliance";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";

        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.juniors, work_tbl.isDocRecvd, work_tbl.docRecvdDate, work_tbl.seniorId, work_tbl.workDone, work_tbl.isUrgentWork, work_tbl.eFillingDate, work_tbl.verificationDoneBy, work_tbl.acknowledgmentNo, work_tbl.verificationDate, work_tbl.set_prepared_by, work_tbl.refundDue, work_tbl.isDefectiveReturn, work_tbl.defectiveReturnComment, work_tbl.isDefectiveRectified, work_tbl.defectiveRectifiedComment, work_tbl.turnOver, work_tbl.isScrutiny, work_tbl.grossTotalIncome, work_tbl.totalIncome, work_tbl.selfAssessmentTax, work_tbl.refundDueVal, work_tbl.refundAmtRecvd, work_tbl.refundDate, work_tbl.refundRemark, work_tbl.fkClientId, work_tbl.intiTotalIncome, work_tbl.intiRefundApproved, work_tbl.intiAddtnlTax, work_tbl.intiRemark, work_tbl.intiIsRectification, work_tbl.intiIsScrutiny, work_tbl.isRectComplete, work_tbl.isApplyAppeal, work_tbl.isBillingDone, work_tbl.isReceiptDone, work_tbl.billNo, work_tbl.billDate, work_tbl.billAmt, work_tbl.receiptDate, work_tbl.receiptAmt, work_tbl.billingComment, work_tbl.receiptComment, work_tbl.workPriority, work_tbl.workPriorityColor, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType, user_tbl.userFullName", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        $this->data['workArr']=$workArr;
        
        $workClientName="";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            
            if($clientBussOrgType==8)
                $workClientName=$workArr['clientName']." (".$workArr['clientBussOrganisation'].")";
            elseif($clientBussOrgType==9)
                $workClientName=$workArr['clientName'];
            else
                $workClientName=$workArr['clientBussOrganisation'];
        }
        
        $this->data['workClientName']=$workClientName;

        $userCondtnArr['user_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userStaffType", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        $jnrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
        $jnrCondtnArr['work_junior_map_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_junior_map_tbl, $colNames="work_junior_map_tbl.fkWorkId, work_junior_map_tbl.fkUserId", $jnrCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $jnrList=$query['userData'];

        $this->data['jnrList']=$jnrList;
        
        $rctftnCondtnArr['rectification_tbl.fkWorkId']=$workId;
        $rctftnCondtnArr['rectification_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->rectification_tbl, $colNames="rectification_tbl.rectificationId, rectification_tbl.rectLetterNo, rectification_tbl.rectDate, rectification_tbl.rectFiledDate, rectification_tbl.rectRemark", $rctftnCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $rectftnArr=$query['userData'];

        $this->data['rectftnArr']=$rectftnArr;

        $validationRulesArr['isDocRecvd']=['label' => 'Document Received', 'rules' => 'trim'];
        $validationRulesArr['docRecvdDate']=['label' => 'Document Received Date', 'rules' => 'trim'];
        $validationRulesArr['workDone']=['label' => '% Work Done', 'rules' => 'trim'];
        $validationRulesArr['seniorId']=['label' => 'Senior Allocation', 'rules' => 'trim'];
        $validationRulesArr['isUrgentWork']=['label' => 'Urgent Work', 'rules' => 'trim'];
        $validationRulesArr['eFillingDate']=['label' => 'E-Filling Date', 'rules' => 'trim'];
        $validationRulesArr['acknowledgmentNo']=['label' => 'Acknowledgment No', 'rules' => 'trim'];
        $validationRulesArr['refundDue']=['label' => 'Refund Due', 'rules' => 'trim'];
        $validationRulesArr['isDefectiveReturn']=['label' => 'Defective Return', 'rules' => 'trim'];
        $validationRulesArr['defectiveReturnComment']=['label' => 'Comment', 'rules' => 'trim'];
        $validationRulesArr['verificationDoneBy']=['label' => 'Verification Done By', 'rules' => 'trim'];
        $validationRulesArr['verificationDate']=['label' => 'Verification Date', 'rules' => 'trim'];
        $validationRulesArr['setPreparedBy']=['label' => 'Set Prepared By', 'rules' => 'trim'];
        $validationRulesArr['isDefectiveRectified']=['label' => 'Defective Rectified', 'rules' => 'trim'];
        $validationRulesArr['defectiveRectifiedComment']=['label' => 'Comment', 'rules' => 'trim'];
        $validationRulesArr['turnOver']=['label' => 'Turn over', 'rules' => 'trim'];
        $validationRulesArr['grossTotalIncome']=['label' => 'Gross Total Income', 'rules' => 'trim'];
        $validationRulesArr['totalIncome']=['label' => 'Total Income', 'rules' => 'trim'];
        $validationRulesArr['selfAssessmentTax']=['label' => 'Self Assessment TAX', 'rules' => 'trim'];
        $validationRulesArr['refundDueVal']=['label' => 'Refund Due', 'rules' => 'trim'];
        $validationRulesArr['refundDate']=['label' => 'Date', 'rules' => 'trim'];
        $validationRulesArr['refundAmtRecvd']=['label' => 'Refund Amount Received', 'rules' => 'trim'];
        $validationRulesArr['refundRemark']=['label' => 'Remark', 'rules' => 'trim'];

        $isDocRecvdErr="";
        $docRecvdDateErr="";
        $workDoneErr="";
        $seniorIdErr="";
        $isUrgentWorkErr="";
        $eFillingDateErr="";
        $acknowledgmentNoErr="";
        $refundDueErr="";
        $isDefectiveReturnErr="";
        $defectiveReturnCommentErr="";
        $verificationDoneByErr="";
        $verificationDateErr="";
        $setPreparedByErr="";
        $isDefectiveRectifiedErr="";
        $defectiveRectifiedCommentErr="";
        $turnOverErr="";
        $grossTotalIncomeErr="";
        $totalIncomeErr="";
        $selfAssessmentTaxErr="";
        $refundDueValErr="";
        $refundDateErr="";
        $refundAmtRecvdErr="";
        $refundRemarkErr="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $isDocRecvdErr=$this->validation->getError('isDocRecvd');
                $docRecvdDateErr=$this->validation->getError('docRecvdDate');
                $workDoneErr=$this->validation->getError('workDone');
                $seniorIdErr=$this->validation->getError('seniorId');
                $isUrgentWorkErr=$this->validation->getError('isUrgentWork');
                $eFillingDateErr=$this->validation->getError('eFillingDate');
                $acknowledgmentNoErr=$this->validation->getError('acknowledgmentNo');
                $refundDueErr=$this->validation->getError('refundDue');
                $isDefectiveReturnErr=$this->validation->getError('isDefectiveReturn');
                $defectiveReturnCommentErr=$this->validation->getError('defectiveReturnComment');
                $verificationDoneByErr=$this->validation->getError('verificationDoneBy');
                $verificationDateErr=$this->validation->getError('verificationDate');
                $setPreparedByErr=$this->validation->getError('setPreparedBy');
                $isDefectiveRectifiedErr=$this->validation->getError('isDefectiveRectified');
                $defectiveRectifiedCommentErr=$this->validation->getError('defectiveRectifiedComment');
                $turnOverErr=$this->validation->getError('turnOver');
                $grossTotalIncomeErr=$this->validation->getError('grossTotalIncome');
                $totalIncomeErr=$this->validation->getError('totalIncome');
                $selfAssessmentTaxErr=$this->validation->getError('selfAssessmentTax');
                $refundDueValErr=$this->validation->getError('refundDueVal');
                $refundDateErr=$this->validation->getError('refundDate');
                $refundAmtRecvdErr=$this->validation->getError('refundAmtRecvd');
                $refundRemarkErr=$this->validation->getError('refundRemark');
            }
            else
            {
                $this->db->transBegin();
                
                $workId=$this->request->getPost('workId');
                $stepData=$this->request->getPost('stepData');
                $isDocRecvd=$this->request->getPost('isDocRecvd');
                $docRecvdDate=$this->request->getPost('docRecvdDate');
                $workDone=$this->request->getPost('workDone');
                $juniorIdArr=$this->request->getPost('juniorId');
                $juniors=$this->request->getPost('juniors');
                $juniorIds=$this->request->getPost('juniorIds');
                $seniorId=$this->request->getPost('seniorId');
                $isUrgentWork=$this->request->getPost('isUrgentWork');
                $eFillingDate=$this->request->getPost('eFillingDate');
                $acknowledgmentNo=$this->request->getPost('acknowledgmentNo');
                $refundDue=$this->request->getPost('refundDue');
                $isDefectiveReturn=$this->request->getPost('isDefectiveReturn');
                $defectiveReturnComment=$this->request->getPost('defectiveReturnComment');
                $verificationDoneBy=$this->request->getPost('verificationDoneBy');
                $verificationDate=$this->request->getPost('verificationDate');
                $setPreparedBy=$this->request->getPost('setPreparedBy');
                $isDefectiveRectified=$this->request->getPost('isDefectiveRectified');
                $defectiveRectifiedComment=$this->request->getPost('defectiveRectifiedComment');
                $turnOver=$this->request->getPost('turnOver');
                $grossTotalIncome=$this->request->getPost('grossTotalIncome');
                $totalIncome=$this->request->getPost('totalIncome');
                $selfAssessmentTax=$this->request->getPost('selfAssessmentTax');
                $refundDueVal=$this->request->getPost('refundDueVal');
                $refundDate=$this->request->getPost('refundDate');
                $refundAmtRecvd=$this->request->getPost('refundAmtRecvd');
                $refundRemark=$this->request->getPost('refundRemark');
                $intiTotalIncome=$this->request->getPost('intiTotalIncome');
                $intiRefundApproved=$this->request->getPost('intiRefundApproved');
                $intiAddtnlTax=$this->request->getPost('intiAddtnlTax');
                $intiRemark=$this->request->getPost('intiRemark');
                $intiIsRectification=$this->request->getPost('intiIsRectification');
                $rectLetterNo=$this->request->getPost('rectLetterNo');
                $rectDate=$this->request->getPost('rectDate');
                $rectFiledDate=$this->request->getPost('rectFiledDate');
                $rectRemark=$this->request->getPost('rectRemark');
                $isRectComplete=$this->request->getPost('isRectComplete');
                $isApplyAppeal=$this->request->getPost('isApplyAppeal');
                $isBillingDone=$this->request->getPost('isBillingDone'); 
                $billNo=$this->request->getPost('billNo'); 
                $billDate=$this->request->getPost('billDate');
                $billAmt=$this->request->getPost('billAmt');
                $billingComment=$this->request->getPost('billingComment');
                $isReceiptDone=$this->request->getPost('isReceiptDone');
                $receiptDate=$this->request->getPost('receiptDate');
                $receiptAmt=$this->request->getPost('receiptAmt');
                $receiptComment=$this->request->getPost('receiptComment');
                $workPriorityColor=$this->request->getPost('workPriorityColor');
                $workPriority=$this->request->getPost('workPriority');
                $isScrutiny=$this->request->getPost('isScrutiny');
                
                if(empty($isScrutiny))
                {
                    $isScrutiny=0;
                }
                
                // print_r($this->request->getPost());
                // die();

                // if($stepData==1)
                // {
                    if($isDocRecvd==1)
                        $docRecvdDateVal=$docRecvdDate;
                    else
                        $docRecvdDateVal="";
                        
                    if($isDefectiveRectified==1)
                        $defectiveRectifiedCommentVal=$defectiveRectifiedComment;
                    else
                        $defectiveRectifiedCommentVal="";
                        
                    if($isBillingDone!=1)
                    {
                        $billNo=""; 
                        $billDate=""; 
                        $billAmt="";
                        $billingComment=""; 
                    }
                    
                    if($isReceiptDone!=1)
                    {
                        $receiptDate=""; 
                        $receiptAmt=""; 
                        $receiptComment="";
                    }

                    $wkUpdateArr = [
                        'isDocRecvd'=>$isDocRecvd,
                        'docRecvdDate'=>$docRecvdDateVal,
                        'workDone'=>$workDone,
                        'juniors'=>$juniors,
                        'seniorId'=>$seniorId,
                        'isUrgentWork'=>$isUrgentWork,
                        'eFillingDate'=>$eFillingDate,
                        'acknowledgmentNo'=>$acknowledgmentNo,
                        'refundDue'=>$refundDue,
                        'isDefectiveReturn'=>$isDefectiveReturn,
                        'defectiveReturnComment'=>$defectiveReturnComment,
                        'verificationDoneBy'=>$verificationDoneBy,
                        'verificationDate'=>$verificationDate,
                        'set_prepared_by'=>$setPreparedBy,
                        'isDefectiveRectified'=>$isDefectiveRectified,
                        'defectiveRectifiedComment'=>$defectiveRectifiedCommentVal,
                        'turnOver'=>$turnOver,
                        'grossTotalIncome'=>$grossTotalIncome,
                        'totalIncome'=>$totalIncome,
                        'selfAssessmentTax'=>$selfAssessmentTax,
                        'refundDueVal'=>$refundDueVal,
                        'refundDate'=>$refundDate,
                        'refundAmtRecvd'=>$refundAmtRecvd,
                        'refundRemark'=>$refundRemark,
                        'intiTotalIncome'=>$intiTotalIncome,
                        'intiRefundApproved'=>$intiRefundApproved,
                        'intiAddtnlTax'=>$intiAddtnlTax,
                        'intiRemark'=>$intiRemark,
                        'intiIsRectification'=>$intiIsRectification,
                        'isRectComplete'=>$isRectComplete,
                        'isApplyAppeal'=>$isApplyAppeal,
                        'isBillingDone'=>$isBillingDone,
                        'billNo'=>$billNo,
                        'billDate'=>$billDate,
                        'billAmt'=>$billAmt,
                        'billingComment'=>$billingComment,
                        'isReceiptDone'=>$isReceiptDone,
                        'receiptDate'=>$receiptDate,
                        'receiptAmt'=>$receiptAmt,
                        'receiptComment'=>$receiptComment,
                        'workPriorityColor'=>$workPriorityColor,
                        'workPriority'=>$workPriority,
                        'isScrutiny'=>$isScrutiny,
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
        
                    $wkCondtnArr['work_tbl.workId']=$workId;
        
                    $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                    $junrUpdateArr = [
                        'status'=>2,
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
        
                    $junrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
        
                    $query=$this->Mcommon->updateData($tableName=$this->work_junior_map_tbl, $junrUpdateArr, $junrCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                    $junrInsertArr=array();

                    if(!empty($juniorIds))
                    {
                        $juniorIdsData=explode(", ", $juniorIds);
                        foreach($juniorIdsData AS $e_jnr)
                        {
                            $junrInsertArr[] = [
                                'fkWorkId'=>$workId,
                                'fkUserId'=>$e_jnr,
                                'status' => 1,
                                'createdBy' => $this->adminId,
                                'createdDatetime' => $this->currTimeStamp
                            ];
                        }

                        $this->Mcommon->insert($tableName=$this->work_junior_map_tbl, $junrInsertArr, $returnType="");
                    }
                    
                    $rectUpdateArr = [
                        'status'=>2,
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
        
                    $rectCondtnArr['rectification_tbl.fkWorkId']=$workId;
        
                    $query=$this->Mcommon->updateData($tableName=$this->rectification_tbl, $rectUpdateArr, $rectCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                    $rectInsertArr=array();

                    if(!empty($rectLetterNo))
                    {
                        foreach($rectLetterNo AS $k_rect=>$e_rect)
                        {
                            $rectInsertArr[] = [
                                'fkWorkId'=>$workId,
                                'rectLetterNo'=>$e_rect,
                                'rectDate'=>$rectDate[$k_rect],
                                'rectFiledDate'=>$rectFiledDate[$k_rect],
                                'rectRemark'=>$rectRemark[$k_rect],
                                'status' => 1,
                                'createdBy' => $this->adminId,
                                'createdDatetime' => $this->currTimeStamp
                            ];
                        }

                        $this->Mcommon->insert($tableName=$this->rectification_tbl, $rectInsertArr, $returnType="");
                    }
                // }
                // elseif($stepData==2)
                // {
                    

                    // $wkUpdateArr = [
                    //     'eFillingDate'=>$eFillingDate,
                    //     'acknowledgmentNo'=>$acknowledgmentNo,
                    //     'refundDue'=>$refundDue,
                    //     'isDefectiveReturn'=>$isDefectiveReturn,
                    //     'defectiveReturnComment'=>$defectiveReturnComment,
                    //     'verificationDoneBy'=>$verificationDoneBy,
                    //     'verificationDate'=>$verificationDate,
                    //     'isDefectiveRectified'=>$isDefectiveRectified,
                    //     'defectiveRectifiedComment'=>$defectiveRectifiedCommentVal,
                    //     'turnOver'=>$turnOver,
                    //     'grossTotalIncome'=>$grossTotalIncome,
                    //     'totalIncome'=>$totalIncome,
                    //     'selfAssessmentTax'=>$selfAssessmentTax,
                    //     'updatedBy' => $this->adminId,
                    //     'updatedDatetime' => $this->currTimeStamp
                    // ];
        
                    // $wkCondtnArr['work_tbl.workId']=$workId;
        
                    // $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                // }
                // elseif($stepData==3)
                // {
                    // $wkUpdateArr = [
                    //     'refundDueVal'=>$refundDueVal,
                    //     'refundDate'=>$refundDate,
                    //     'refundAmtRecvd'=>$refundAmtRecvd,
                    //     'refundRemark'=>$refundRemark,
                    //     'updatedBy' => $this->adminId,
                    //     'updatedDatetime' => $this->currTimeStamp
                    // ];
        
                    // $wkCondtnArr['work_tbl.workId']=$workId;
        
                    // $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                // }

                if($this->db->transStatus() === FALSE)
                {
                    $this->db->transRollback();

                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Work Information not updated :(");
                    
                    // return redirect()->to(base_url('admin/income_tax/work_form/'.$workId));
                }
                else
                {
                    $this->db->transCommit();

                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']="Work Information updated";
                    $insertLogArr['ip']=$this->IPAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mquery->insertLog($insertLogArr);

                    $this->session->setFlashdata('successMsg', "Work Information updated successfully :)");
                    
                    // return redirect()->to(base_url('admin/admin/inc_tax_returns'));
                }

                // return redirect()->route('admin/income_tax/work_form/'.$workId);
            }
        }

        $this->data['isDocRecvdErr']=$isDocRecvdErr;
        $this->data['docRecvdDateErr']=$docRecvdDateErr;
        $this->data['workDoneErr']=$workDoneErr;
        $this->data['seniorIdErr']=$seniorIdErr;
        $this->data['isUrgentWorkErr']=$isUrgentWorkErr;
        $this->data['eFillingDateErr']=$eFillingDateErr;
        $this->data['acknowledgmentNoErr']=$acknowledgmentNoErr;
        $this->data['refundDueErr']=$refundDueErr;
        $this->data['isDefectiveReturnErr']=$isDefectiveReturnErr;
        $this->data['defectiveReturnCommentErr']=$defectiveReturnCommentErr;
        $this->data['verificationDoneByErr']=$verificationDoneByErr;
        $this->data['verificationDateErr']=$verificationDateErr;
        $this->data['setPreparedByErr']=$setPreparedByErr;
        $this->data['isDefectiveRectifiedErr']=$isDefectiveRectifiedErr;
        $this->data['defectiveRectifiedCommentErr']=$defectiveRectifiedCommentErr;
        $this->data['turnOverErr']=$turnOverErr;
        $this->data['grossTotalIncomeErr']=$grossTotalIncomeErr;
        $this->data['totalIncomeErr']=$totalIncomeErr;
        $this->data['selfAssessmentTaxErr']=$selfAssessmentTaxErr;
        $this->data['refundDueValErr']=$refundDueValErr;
        $this->data['refundDateErr']=$refundDateErr;
        $this->data['refundAmtRecvdErr']=$refundAmtRecvdErr;
        $this->data['refundRemarkErr']=$refundRemarkErr;

        return view('firm_panel/compliance/income_tax/work_form', $this->data);
    }

    public function assessment()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Assessment";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/income_tax/assessment', $this->data);
    }
    
    public function processing()
	{
	    ini_set('memory_limit', '-1');
	    
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Processing";
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
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        // $workCondtnArr['work_tbl.workDone']="100";
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        // $workCondtnArr['work_tbl.isAssessment']="0";
        // $workCondtnArr['work_tbl.isScrutiny']="0";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        $workOrderByArr['client_tbl.clientName']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('act_due_month', 'due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.eFillingDate, work_tbl.isDocRecvd, work_tbl.juniors, work_tbl.isScrutiny, work_tbl.refundDue, work_tbl.refundDueVal, work_tbl.refundInterest, work_tbl.totalRefundRecvd, work_tbl.selfAssessmentTax, work_tbl.intiRefundApproved, work_tbl.intiRemark, work_tbl.intiIsRectification, work_tbl.intiIsScrutiny, work_tbl.refundAmtRecvd, work_tbl.refundDate, work_tbl.refundRemark, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, refund_tbl.totalIncome, refund_tbl.refundClaimed, refund_tbl.intiTotalIncome, refund_tbl.refundTotalAmt, refund_tbl.intiAddtnlTax", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                // $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx['act_option_name1'];
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['mthDataArr']=$mthDataArr;
        $this->data['mthDDFArr']=$mthDDFArr;
        $this->data['mthDDFDueDateArr']=$mthDDFDueDateArr;
        $this->data['mthDDFDueDateForClientArr']=$mthDDFDueDateForClientArr;

        return view('firm_panel/compliance/income_tax/processing', $this->data);
    }
    
    public function intimation()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $workId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Intimation u/s 143(1)";
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
            work_tbl.workId,
            work_tbl.isScrutiny,
            client_tbl.clientName, 
            client_tbl.clientBussOrganisation, 
            client_tbl.clientPanNumber, 
            client_tbl.clientBussOrganisationType AS orgType,
            due_date_master_tbl.finYear,
            refund_tbl.refundId, 
            refund_tbl.totalIncome, 
            refund_tbl.intiTotalIncome, 
            refund_tbl.refundClaimed, 
            refund_tbl.refundPrincipalAmt, 
            refund_tbl.refundInterestAmt, 
            refund_tbl.refundTotalAmt, 
            refund_tbl.intiRefundApproved, 
            refund_tbl.intiAddtnlTax, 
            demand_tbl.demandId, 
            demand_tbl.demandPrincipalAmt, 
            demand_tbl.demandInterestAmt, 
            demand_tbl.demandTotalAmt, 
            refund_tbl.intiRemark, 
            refund_tbl.intiIsRectification
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        return view('firm_panel/compliance/income_tax/intimation', $this->data);
    }
    
    public function updateIntimation()
    {
        $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $refundId=$this->request->getPost('refundId');
        $demandId=$this->request->getPost('demandId');
        $isScrutiny=$this->request->getPost('isScrutiny');
        $intiTotalIncome=$this->request->getPost('intiTotalIncome');
        $refundPrincipalAmt=$this->request->getPost('refundPrincipalAmt');
        $refundInterestAmt=$this->request->getPost('refundInterestAmt');
        $refundTotalAmt=$this->request->getPost('refundTotalAmt');
        $intiRefundApproved=$this->request->getPost('intiRefundApproved');
        $intiAddtnlTax=$this->request->getPost('intiAddtnlTax');
        $demandPrincipalAmt=$this->request->getPost('demandPrincipalAmt');
        $demandInterestAmt=$this->request->getPost('demandInterestAmt');
        $demandTotalAmt=$this->request->getPost('demandTotalAmt');
        $intiRemark=$this->request->getPost('intiRemark');
        $intiIsRectification=$this->request->getPost('intiIsRectification');
        
        $updateIntiArr=array(
            'refundId'=>$refundId, 
            'fkWorkId'=>$workId, 
            'intiTotalIncome'=>$intiTotalIncome, 
            'refundPrincipalAmt'=>$refundPrincipalAmt, 
            'refundInterestAmt'=>$refundInterestAmt, 
            'refundTotalAmt'=>$refundTotalAmt, 
            'intiRefundApproved'=>$intiRefundApproved,
            'intiAddtnlTax'=>$intiAddtnlTax, 
            'intiRemark'=>$intiRemark,
            'intiIsRectification'=>$intiIsRectification,
            'status' => 1, 
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        );
        
        $this->Mrefund->save($updateIntiArr);
        
        $updateDemandIntiArr=array(
            'demandId'=>$demandId,
            'fkWorkId'=>$workId,
            'demandPrincipalAmt'=>$demandPrincipalAmt,
            'demandInterestAmt'=>$demandInterestAmt,
            'demandTotalAmt'=>$demandTotalAmt,
            'status' => 1, 
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        );
        
        $this->Mdemand->save($updateDemandIntiArr);
        
        if($intiIsRectification==1)
        {
            $rectificationCondtn = array(
                'fkWorkId'              =>  $workId, 
                'fkRefundId'            =>  $refundId,
                'rectificationType'     =>  1,
                'status'                =>  2
            );
            
            $rectficationData = $this->MRectification->where($rectificationCondtn)->findAll();
            
            if(!empty($rectficationData))
            {
                $rectificationUpdateCondtn = array(
                    'fkWorkId'              =>  $workId, 
                    'rectificationType'     =>  1,
                    'fkRefundId'            =>  $refundId,
                    'status'                =>  2
                );
            
                $updateRectificationArr=array(
                    'status' => 1, 
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                );
                    
                $this->MRectification->update($rectificationUpdateCondtn, $updateRectificationArr);
            }
            else
            {
                $insertRectificationArr=array(
                    'fkWorkId'                  =>  $workId, 
                    'rectificationType'         =>  1,
                    'fkRefundId'                =>  $refundId,
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
                'fkRefundId'            =>  $refundId,
                'rectificationType'     =>  1,
                'status'                =>  1
            );
            
            $rectficationData = $this->MRectification->where($rectificationCondtn)->findAll();
            
            if(!empty($rectficationData))
            {
                $rectificationUpdateCondtn = array(
                    'fkWorkId'              =>  $workId, 
                    'fkRefundId'            =>  $refundId,
                    'rectificationType'     =>  1,
                    'status'                =>  1
                );
            
                $updateRectificationArr=array(
                    'status' => 2, 
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                );
                
                // echo "<pre>";
                // print_r($rectficationData);
                // print_r($rectificationUpdateCondtn);
                // print_r($updateRectificationArr);
                // die();
                    
                $this->MRectification->update($rectificationUpdateCondtn, $updateRectificationArr);
            }
        }

        if($isScrutiny==1)
        {
            $scrCondtn = array(
                'fkWorkId'  => $workId,
                'status'    => 1
            );
            
            $scrDataArr=$this->Mscrutiny->where($scrCondtn)->findAll();

            if(!empty($scrDataArr))
            {
                $updateSrcArr=array(
                    'intiTotalIncome'   =>  $intiTotalIncome,
                    'refundTotalAmt'    =>  $refundTotalAmt,
                    'demandTotalAmt'    =>  $demandTotalAmt,
                    'updatedBy'         =>  $this->adminId,
                    'updatedDatetime'   =>  $this->currTimeStamp
                );
    
                $srcCondtnArr['scrutiny_tbl.fkWorkId']=$workId;
                $srcCondtnArr['scrutiny_tbl.status']=1;
    
                $this->Mcommon->updateData($tableName=$this->scrutiny_tbl, $updateSrcArr, $srcCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
            }
        }
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Intimation not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Intimation updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);
            
            $this->session->setFlashdata('successMsg', "Intimation has been updated successfully :)");
        }
        
        return redirect()->route('processing');
    }
    
    public function rectification()
	{
	    die('Not use');
	    
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Rectification";
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
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.workDone']="100";
        // $workCondtnArr['work_tbl.isAssessment']="0";
        // $workCondtnArr['work_tbl.isScrutiny']="0";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        $workCondtnArr['work_tbl.isRectComplete']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workGroupByArr=array('act_due_month', 'due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>'(SELECT a.fkWorkId, a.rectFiledDate
            FROM '.$this->rectification_tbl.' a
            INNER JOIN (
                SELECT rectification_tbl.fkWorkId, MAX(rectification_tbl.rectFiledDate) AS rectFiledDate
                FROM '.$this->rectification_tbl.' WHERE rectification_tbl.status=1
                GROUP BY rectification_tbl.fkWorkId
                ORDER BY rectification_tbl.rectificationId
            ) b ON a.fkWorkId = b.fkWorkId AND a.rectFiledDate = b.rectFiledDate) AS rectTbl', "condtn"=>"rectTbl.fkWorkId=work_tbl.workId", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, work_tbl.isScrutiny, work_tbl.totalIncome, work_tbl.refundDueVal, work_tbl.selfAssessmentTax, work_tbl.intiTotalIncome, work_tbl.intiRefundApproved, work_tbl.intiAddtnlTax, work_tbl.intiRemark, work_tbl.intiIsRectification, work_tbl.intiIsScrutiny, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, rectTbl.rectFiledDate", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                // $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx['act_option_name1'];
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['mthDataArr']=$mthDataArr;
        $this->data['mthDDFArr']=$mthDDFArr;
        $this->data['mthDDFDueDateArr']=$mthDDFDueDateArr;
        $this->data['mthDDFDueDateForClientArr']=$mthDDFDueDateForClientArr;

        return view('firm_panel/compliance/income_tax/rectification', $this->data);
    }

    public function processing_bak()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Processing";
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
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.workDone']="100";
        // $workCondtnArr['work_tbl.isAssessment']="0";
        // $workCondtnArr['work_tbl.isScrutiny']="0";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $mthTaxPayArr=array();
        $mthTaxPayerArr=array();
        $mthTaxPayerClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $mthTaxPayArr[$e_tx['act_due_month']][]=$e_tx['tax_payer_id'];
                
                $mthTaxPayerArr[$e_tx['act_due_month']][$e_tx['tax_payer_id']]=$e_tx['act_option_name2'];
                
                $mthTaxPayerClientArr[$e_tx['act_due_month']][$e_tx['tax_payer_id']][]=$e_tx;
            }
        }
        
        $this->data['mthTaxPayArr']=$mthTaxPayArr;
        $this->data['mthTaxPayerArr']=$mthTaxPayerArr;
        $this->data['mthTaxPayerClientArr']=$mthTaxPayerClientArr;

        return view('firm_panel/compliance/income_tax/processing', $this->data);
    }

    public function submit_assessment()
    {
        $this->db->transBegin();

        $workId=$this->request->getPost('workId');
        $assessment=$this->request->getPost('assessment');

        $wkUpdateArr = [
            'isAssessment'=>$assessment,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['work_tbl.workId']=$workId;

        $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!! :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Work Information updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Your changes has been updated successfully :)");
        }
    }

    public function submit_scrutiny()
    {
        $this->db->transBegin();

        $workId=$this->request->getPost('workId');
        $scrutiny=$this->request->getPost('scrutiny');

        $wkUpdateArr = [
            'isScrutiny'=>$scrutiny,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['work_tbl.workId']=$workId;

        $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!! :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Work Information updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Your changes has been updated successfully :)");
        }
    }
    
    public function scrutiny_old()
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
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.workDone']="100";
        $workCondtnArr['work_tbl.isAccepted !=']="1";
        $workCondtnArr['work_tbl.isScrutiny']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workGroupByArr=array('work_tbl.workId');

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->hearing_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.inspectorName, work_tbl.inspectorContact, work_tbl.taxAssistantName, work_tbl.taxAssistantContact, work_tbl.wardNo, work_tbl.noticeUs, work_tbl.placeNo, work_tbl.orderDate, work_tbl.addtnlDemandRaised, work_tbl.isAccepted, work_tbl.filingRectDate, work_tbl.filingAppealDate, work_tbl.paymentDemandDate, work_tbl.amountPaid, work_tbl.recptOrderDate, work_tbl.scRemarks, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.inspectorName, work_tbl.inspectorContact, work_tbl.taxAssistantName, work_tbl.taxAssistantContact, work_tbl.wardNo, work_tbl.noticeUs, work_tbl.placeNo, work_tbl.orderDate, work_tbl.addtnlDemandRaised, work_tbl.isAccepted, work_tbl.filingRectDate, work_tbl.filingAppealDate, work_tbl.paymentDemandDate, work_tbl.amountPaid, work_tbl.recptOrderDate, work_tbl.scRemarks, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        return view('firm_panel/compliance/income_tax/scrutiny', $this->data);
    }
    
    public function scrutiny_case_old()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $workId=$uri->getSegment(3);

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
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.workDone']="100";
        $workCondtnArr['work_tbl.isScrutiny']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.assessingOfficer, work_tbl.assessingOfficerContact, work_tbl.inspectorName, work_tbl.inspectorContact, work_tbl.taxAssistantName, work_tbl.taxAssistantContact, work_tbl.wardNo, work_tbl.noticeUs, work_tbl.placeNo, work_tbl.orderDate, work_tbl.addtnlDemandRaised, work_tbl.isAccepted, work_tbl.filingRectDate, work_tbl.filingAppealDate, work_tbl.paymentDemandDate, work_tbl.amountPaid, work_tbl.recptOrderDate, work_tbl.scRemarks, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientTitle, client_tbl.clientMobile1, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        $hrCondtnArr['hearing_tbl.fkWorkId']=$workId;
        $hrCondtnArr['hearing_tbl.hearingFor']="1";
        $hrCondtnArr['hearing_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->hearing_tbl, $colNames="hearing_tbl.*", $hrCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $hearingArr=$query['userData'];

        $this->data['hearingArr']=$hearingArr;

        $validationRulesArr['inspectorName']=['label' => 'Remark', 'rules' => 'trim'];

        $isDocRecvdErr="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $isDocRecvdErr=$this->validation->getError('inspectorName');
            }
            else
            {
                $this->db->transBegin();

                $workId=$this->request->getPost('workId');
                $assessingOfficer=$this->request->getPost('assessingOfficer');
                $assessingOfficerContact=$this->request->getPost('assessingOfficerContact');
                $inspectorName=$this->request->getPost('inspectorName');
                $inspectorContact=$this->request->getPost('inspectorContact');
                $taxAssistantName=$this->request->getPost('taxAssistantName');
                $taxAssistantContact=$this->request->getPost('taxAssistantContact');
                $wardNo=$this->request->getPost('wardNo');
                $placeNo=$this->request->getPost('placeNo');
                $noticeUs=$this->request->getPost('noticeUs');
                $orderDate=$this->request->getPost('orderDate');
                $addtnlDemandRaised=$this->request->getPost('addtnlDemandRaised');
                $isAccepted=$this->request->getPost('isAccepted');
                $filingRectDate=$this->request->getPost('filingRectDate');
                $filingAppealDate=$this->request->getPost('filingAppealDate');
                $paymentDemandDate=$this->request->getPost('paymentDemandDate');
                $amountPaid=$this->request->getPost('amountPaid');
                $recptOrderDate=$this->request->getPost('recptOrderDate');
                $scRemarks=$this->request->getPost('scRemarks');

                $wkUpdateArr = [
                    'assessingOfficer'=>$assessingOfficer,
                    'assessingOfficerContact'=>$assessingOfficerContact,
                    'inspectorName'=>$inspectorName,
                    'inspectorContact'=>$inspectorContact,
                    'taxAssistantName'=>$taxAssistantName,
                    'taxAssistantContact'=>$taxAssistantContact,
                    'wardNo'=>$wardNo,
                    'placeNo'=>$placeNo,
                    'noticeUs'=>$noticeUs,
                    'orderDate'=>$orderDate,
                    'addtnlDemandRaised'=>$addtnlDemandRaised,
                    'isAccepted'=>$isAccepted,
                    'filingRectDate'=>$filingRectDate,
                    'filingAppealDate'=>$filingAppealDate,
                    'paymentDemandDate'=>$paymentDemandDate,
                    'amountPaid'=>$amountPaid,
                    'recptOrderDate'=>$recptOrderDate,
                    'scRemarks'=>$scRemarks,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
    
                $wkCondtnArr['work_tbl.workId']=$workId;
    
                $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                
                if($isAccepted==2)
                {
                    $levelInsertArr[] = [
                        'fkWorkId'=>$workId,
                        'levelNo' => 1,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    ];
            
                    $this->Mquery->insert($tableName=$this->level_tbl, $levelInsertArr, $returnType="");
                }

                if($this->db->transStatus() === FALSE)
                {
                    $this->db->transRollback();

                    $this->session->setFlashdata('errorMsg', "Something went wrong!!:(");
                }
                else
                {
                    $this->db->transCommit();

                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']="Scrutiny Case updated";
                    $insertLogArr['ip']=$this->IPAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mquery->insertLog($insertLogArr);

                    $this->session->setFlashdata('successMsg', "Scrutiny Case has been updated successfully :)");
                }
            }
        }

        $this->data['isDocRecvdErr']=$isDocRecvdErr;

        return view('firm_panel/compliance/income_tax/scrutiny_case', $this->data);
    }

    public function add_hearing()
    {
        $this->db->transBegin();

        $workId=$this->request->getPost('hrWorkId');
        $hearingDate=$this->request->getPost('hearingDate');
        $attendedDate=$this->request->getPost('attendedDate');
        $proceedingDetails=$this->request->getPost('proceedingDetails');
        $attendedBy=$this->request->getPost('attendedBy');
        $nextHearingDate=$this->request->getPost('nextHearingDate');

        $hrngInsertArr[] = [
            'fkWorkId'=>$workId,
            'hearingDate'=>$hearingDate,
            'attendedDate'=>$attendedDate,
            'proceedingDetails'=>$proceedingDetails,
            'attendedBy'=>$attendedBy,
            'nextHearingDate'=>$nextHearingDate,
            'hearingFor' => 1,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        $this->Mquery->insert($tableName=$this->hearing_tbl, $hrngInsertArr, $returnType="");

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!! :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Hearing updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "New Hearing date added successfully :)");
        }
    }

    public function delete_hearing_date()
    {
        $this->db->transBegin();

        $hearing_id=$this->request->getPost('hearing_id');

        $wkUpdateArr = [
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['hearing_tbl.hearing_id']=$hearing_id;

        $query=$this->Mcommon->updateData($tableName=$this->hearing_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!! :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Hearing Date deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Hearing date has been deleted successfully :)");
        }
    }

    public function appeals()
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

        return view('firm_panel/compliance/income_tax/appeals', $this->data);
    }

    public function appeals_scrutiny()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $levelNo=$uri->getSegment(3);
        
        $this->data['levelNo']=$levelNo;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Appeals Scrutiny";
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
        
        $workCondtnArr['level_tbl.status']=1;
        $workCondtnArr['level_tbl.levelNo >=']=$levelNo;
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.workDone']="100";
        $workCondtnArr['work_tbl.isAccepted']="2";
        $workCondtnArr['work_tbl.isScrutiny']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=level_tbl.fkWorkId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->level_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, level_tbl.leveId, level_tbl.levelNo, level_tbl.assessingOfficer, level_tbl.assessingOfficerContact, level_tbl.inspectorName, level_tbl.inspectorContact, level_tbl.taxAssistantName, level_tbl.taxAssistantContact, level_tbl.wardNo, level_tbl.noticeUs, level_tbl.placeNo, level_tbl.orderDate, level_tbl.addtnlDemandRaised, level_tbl.isAccepted, level_tbl.filingRectDate, level_tbl.filingAppealDate, level_tbl.paymentDemandDate, level_tbl.amountPaid, level_tbl.recptOrderDate, level_tbl.scRemarks, client_group_tbl.client_group_number, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        $this->data['workDataArr']=$workDataArr;
        
        $hrCondtnArr['level_tbl.levelNo']=$levelNo;
        $hrCondtnArr['hearing_tbl.hearingFor']="2";
        $hrCondtnArr['hearing_tbl.status']="1";
        
        $hrgJoinArr[]=array("tbl"=>$this->level_tbl, "condtn"=>"hearing_tbl.fkLevelId=level_tbl.leveId", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->hearing_tbl, $colNames="hearing_tbl.*", $hrCondtnArr, $likeCondtnArr=array(), $hrgJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $hearingArr=$query['userData'];
        
        $hrngArr=array();
        
        if(!empty($hearingArr))
        {
            foreach($hearingArr AS $e_hrg)
            {
                $hrngArr[$e_hrg['fkWorkId']]=$e_hrg;
            }
        }

        $this->data['hrngArr']=$hrngArr;

        return view('firm_panel/compliance/income_tax/appeals_scrutiny', $this->data);
    }
    
    public function appeals_scrutiny_case()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $leveId=$uri->getSegment(3);
        $workId=$uri->getSegment(4);
        
        $this->data['leveId']=$leveId;
        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Appeals Scrutiny Case";
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
        $workCondtnArr['level_tbl.status']=1;
        $workCondtnArr['level_tbl.leveId']=$leveId;
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['work_tbl.workDone']="100";
        $workCondtnArr['work_tbl.isAccepted']="2";
        $workCondtnArr['work_tbl.isScrutiny']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.workId=level_tbl.fkWorkId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->level_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, level_tbl.leveId, level_tbl.levelNo, level_tbl.assessingOfficer, level_tbl.assessingOfficerContact, level_tbl.inspectorName, level_tbl.inspectorContact, level_tbl.taxAssistantName, level_tbl.taxAssistantContact, level_tbl.wardNo, level_tbl.noticeUs, level_tbl.placeNo, level_tbl.orderDate, level_tbl.addtnlDemandRaised, level_tbl.isAccepted, level_tbl.filingRectDate, level_tbl.filingAppealDate, level_tbl.paymentDemandDate, level_tbl.amountPaid, level_tbl.recptOrderDate, level_tbl.scRemarks, client_group_tbl.client_group_number, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        $this->data['workDataArr']=$workDataArr;

        $workId=$workDataArr['workId'];

        $hrCondtnArr['hearing_tbl.fkWorkId']=$workId;
        $hrCondtnArr['hearing_tbl.hearingFor']="2";
        $hrCondtnArr['hearing_tbl.fkLevelId']=$leveId;
        $hrCondtnArr['hearing_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->hearing_tbl, $colNames="hearing_tbl.*", $hrCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $hearingArr=$query['userData'];

        $this->data['hearingArr']=$hearingArr;

        $validationRulesArr['inspectorName']=['label' => 'Remark', 'rules' => 'trim'];

        $isDocRecvdErr="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $isDocRecvdErr=$this->validation->getError('inspectorName');
            }
            else
            {
                $this->db->transBegin();

                $leveId=$this->request->getPost('leveId');
                $levelNo=$this->request->getPost('levelNo');
                $workId=$this->request->getPost('workId');
                $assessingOfficer=$this->request->getPost('assessingOfficer');
                $assessingOfficerContact=$this->request->getPost('assessingOfficerContact');
                $inspectorName=$this->request->getPost('inspectorName');
                $inspectorContact=$this->request->getPost('inspectorContact');
                $taxAssistantName=$this->request->getPost('taxAssistantName');
                $taxAssistantContact=$this->request->getPost('taxAssistantContact');
                $wardNo=$this->request->getPost('wardNo');
                $placeNo=$this->request->getPost('placeNo');
                $noticeUs=$this->request->getPost('noticeUs');
                $orderDate=$this->request->getPost('orderDate');
                $addtnlDemandRaised=$this->request->getPost('addtnlDemandRaised');
                $isAccepted=$this->request->getPost('isAccepted');
                $filingRectDate=$this->request->getPost('filingRectDate');
                $filingAppealDate=$this->request->getPost('filingAppealDate');
                $paymentDemandDate=$this->request->getPost('paymentDemandDate');
                $amountPaid=$this->request->getPost('amountPaid');
                $recptOrderDate=$this->request->getPost('recptOrderDate');
                $scRemarks=$this->request->getPost('scRemarks');

                $wkUpdateArr = [
                    'assessingOfficer'=>$assessingOfficer,
                    'assessingOfficerContact'=>$assessingOfficerContact,
                    'inspectorName'=>$inspectorName,
                    'inspectorContact'=>$inspectorContact,
                    'taxAssistantName'=>$taxAssistantName,
                    'taxAssistantContact'=>$taxAssistantContact,
                    'wardNo'=>$wardNo,
                    'placeNo'=>$placeNo,
                    'noticeUs'=>$noticeUs,
                    'orderDate'=>$orderDate,
                    'addtnlDemandRaised'=>$addtnlDemandRaised,
                    'isAccepted'=>$isAccepted,
                    'filingRectDate'=>$filingRectDate,
                    'filingAppealDate'=>$filingAppealDate,
                    'paymentDemandDate'=>$paymentDemandDate,
                    'amountPaid'=>$amountPaid,
                    'recptOrderDate'=>$recptOrderDate,
                    'scRemarks'=>$scRemarks,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
    
                $wkCondtnArr['level_tbl.leveId']=$leveId;
    
                $query=$this->Mcommon->updateData($tableName=$this->level_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                
                if($isAccepted==2)
                {
                    $wkStUpdateArr = [
                        'status'=>2,
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
        
                    $wkStCondtnArr['level_tbl.leveId']=$leveId;
        
                    $query=$this->Mcommon->updateData($tableName=$this->level_tbl, $wkStUpdateArr, $wkStCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                
                    $nextLevelNo=($levelNo+1);
                    $levelInsertArr[] = [
                        'fkWorkId'=>$workId,
                        'levelNo' => $nextLevelNo,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    ];
            
                    $this->Mquery->insert($tableName=$this->level_tbl, $levelInsertArr, $returnType="");
                }

                if($this->db->transStatus() === FALSE)
                {
                    $this->db->transRollback();

                    $this->session->setFlashdata('errorMsg', "Something went wrong!!:(");
                }
                else
                {
                    $this->db->transCommit();

                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']="Scrutiny Case updated";
                    $insertLogArr['ip']=$this->IPAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mquery->insertLog($insertLogArr);

                    $this->session->setFlashdata('successMsg', "Scrutiny Case has been updated successfully :)");
                }
            }
        }

        $this->data['isDocRecvdErr']=$isDocRecvdErr;

        return view('firm_panel/compliance/income_tax/appeals_scrutiny_case', $this->data);
    }

    public function add_appeal_hearing()
    {
        $this->db->transBegin();

        $leveId=$this->request->getPost('hrLeveId');
        $workId=$this->request->getPost('hrWorkId');
        $hearingDate=$this->request->getPost('hearingDate');
        $attendedDate=$this->request->getPost('attendedDate');
        $proceedingDetails=$this->request->getPost('proceedingDetails');
        $attendedBy=$this->request->getPost('attendedBy');
        $nextHearingDate=$this->request->getPost('nextHearingDate');

        $hrngInsertArr[] = [
            'fkWorkId'=>$workId,
            'fkLevelId'=>$leveId,
            'hearingDate'=>$hearingDate,
            'attendedDate'=>$attendedDate,
            'proceedingDetails'=>$proceedingDetails,
            'attendedBy'=>$attendedBy,
            'nextHearingDate'=>$nextHearingDate,
            'hearingFor' => 2,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        $this->Mquery->insert($tableName=$this->hearing_tbl, $hrngInsertArr, $returnType="");

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!! :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Hearing updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "New Hearing date added successfully :)");
        }
    }

    public function delete_appeal_hearing_date()
    {
        $this->db->transBegin();

        $hearing_id=$this->request->getPost('hearing_id');

        $wkUpdateArr = [
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['hearing_tbl.hearing_id']=$hearing_id;

        $query=$this->Mcommon->updateData($tableName=$this->hearing_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!! :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Hearing Date deleted";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Hearing date has been deleted successfully :)");
        }
    }
    
	public function audit_work_form()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $workId=$uri->getSegment(3);

        $this->data['workId']=$workId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Details of Income Tax Work - Tax Audit";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $workCondtnArr['work_tbl.workId']=$workId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";

        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        
        $columnNames = "
            work_tbl.workId, 
            work_tbl.workCode, 
            work_tbl.juniors, 
            work_tbl.isDocRecvd, 
            work_tbl.docRecvdDate, 
            work_tbl.seniorId, 
            work_tbl.workDone, 
            work_tbl.isUrgentWork, 
            work_tbl.eFillingDate, 
            work_tbl.verificationDoneBy, 
            work_tbl.acknowledgmentNo, 
            work_tbl.verificationDate, 
            work_tbl.refundDue, 
            work_tbl.isDefectiveReturn, 
            work_tbl.defectiveReturnComment, 
            work_tbl.isDefectiveRectified, 
            work_tbl.defectiveRectifiedComment, 
            work_tbl.turnOver, 
            work_tbl.grossTotalIncome, 
            work_tbl.totalIncome, 
            work_tbl.selfAssessmentTax, 
            work_tbl.refundDueVal, 
            work_tbl.refundAmtRecvd, 
            work_tbl.refundDate, 
            work_tbl.refundRemark, 
            work_tbl.signature_date, 
            work_tbl.auditCompletionDate, 
            work_tbl.udinDate, 
            work_tbl.udinNo, 
            work_tbl.remark, 
            work_tbl.set_prepared_by, 
            work_tbl.workPriority, 
            work_tbl.workPriorityColor, 
            work_tbl.isBillingDone, 
            work_tbl.isReceiptDone, 
            work_tbl.billNo, 
            work_tbl.billDate, 
            work_tbl.billAmt, 
            work_tbl.receiptDate, 
            work_tbl.receiptAmt, 
            work_tbl.billingComment, 
            work_tbl.receiptComment, 
            client_tbl.clientName,
            client_tbl.clientBussOrganisation,
            client_tbl.clientBussOrganisationType,
            client_tbl.clientPanNumber,
            client_tbl.clientDob,
            client_tbl.clientBussIncorporationDate,
            user_tbl.userFullName,
            due_date_master_tbl.finYear
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        $this->data['workArr']=$workArr;
        
        $workClientName="";
        $clientPanNo="N/A";
        $asmtYear="N/A";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            
            // if($clientBussOrgType==8)
            //     $workClientName=$workArr['clientName']." (".$workArr['clientBussOrganisation'].")";
                
            if(in_array($clientBussOrgType, INDIVIDUAL_ARRAY))
            {
                $workClientName=(!empty($workArr['clientName'])) ? $workArr['clientName']:"";
                $clientDobDoi=(check_valid_date($workArr['clientDob'])) ? date("d-m-Y", strtotime($workArr['clientDob'])):"";
            }
            else
            {
                $workClientName=(!empty($workArr['clientBussOrganisation'])) ? $workArr['clientBussOrganisation']:"";
                $clientDobDoi=(check_valid_date($workArr['clientBussIncorporationDate'])) ? date("d-m-Y", strtotime($workArr['clientBussIncorporationDate'])):"";
            }
            
            if(!empty($workArr['clientPanNumber']))
                $clientPanNo=$workArr['clientPanNumber'];
                
            if(!empty($workArr['finYear']))
            {
                $asmtYearVal=$workArr['finYear'];
                
                $asmtYearArr = explode('-', $asmtYearVal);
                
                $fY=(int)$asmtYearArr[0]+1;
                $lY=(int)$asmtYearArr[1]+1;
                
                $asmtYear=$fY."-".$lY;
            }
        }
        
        $workClientName = (!empty($workClientName)) ? $workClientName : "N/A";
        $clientDobDoi = (!empty($clientDobDoi)) ? $clientDobDoi : "N/A";
        
        $this->data['workClientName']=$workClientName;
        $this->data['clientPanNo']=$clientPanNo;
        $this->data['clientDobDoi']=$clientDobDoi;
        $this->data['asmtYear']=$asmtYear;

        $userCondtnArr['user_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userStaffType", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        $jnrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
        $jnrCondtnArr['work_junior_map_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_junior_map_tbl, $colNames="work_junior_map_tbl.fkWorkId, work_junior_map_tbl.fkUserId", $jnrCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $jnrList=$query['userData'];

        $this->data['jnrList']=$jnrList;

        $validationRulesArr['isDocRecvd']=['label' => 'Document Received', 'rules' => 'trim'];
        $validationRulesArr['docRecvdDate']=['label' => 'Document Received Date', 'rules' => 'trim'];
        $validationRulesArr['workDone']=['label' => '% Work Done', 'rules' => 'trim'];
        $validationRulesArr['signature_date']=['label' => 'Date Of Signature', 'rules' => 'trim'];
        $validationRulesArr['remark']=['label' => 'Remark', 'rules' => 'trim'];
        $validationRulesArr['seniorId']=['label' => 'Senior Allocation', 'rules' => 'trim'];
        $validationRulesArr['isUrgentWork']=['label' => 'Urgent Work', 'rules' => 'trim'];
        $validationRulesArr['set_prepared_by']=['label' => 'Set Prepared By', 'rules' => 'trim'];
        
        // $validationRulesArr['eFillingDate']=['label' => 'E-Filling Date', 'rules' => 'trim'];
        // $validationRulesArr['acknowledgmentNo']=['label' => 'Acknowledgment No', 'rules' => 'trim'];
        // $validationRulesArr['refundDue']=['label' => 'Refund Due', 'rules' => 'trim'];
        // $validationRulesArr['isDefectiveReturn']=['label' => 'Defective Return', 'rules' => 'trim'];
        // $validationRulesArr['defectiveReturnComment']=['label' => 'Comment', 'rules' => 'trim'];
        // $validationRulesArr['verificationDoneBy']=['label' => 'Verification Done By', 'rules' => 'trim'];
        // $validationRulesArr['verificationDate']=['label' => 'Verification Date', 'rules' => 'trim'];
        // $validationRulesArr['isDefectiveRectified']=['label' => 'Defective Rectified', 'rules' => 'trim'];
        // $validationRulesArr['defectiveRectifiedComment']=['label' => 'Comment', 'rules' => 'trim'];
        // $validationRulesArr['turnOver']=['label' => 'Turn over', 'rules' => 'trim'];
        // $validationRulesArr['grossTotalIncome']=['label' => 'Gross Total Income', 'rules' => 'trim'];
        // $validationRulesArr['totalIncome']=['label' => 'Total Income', 'rules' => 'trim'];
        // $validationRulesArr['selfAssessmentTax']=['label' => 'Self Assessment TAX', 'rules' => 'trim'];
        // $validationRulesArr['refundDueVal']=['label' => 'Refund Due', 'rules' => 'trim'];
        // $validationRulesArr['refundDate']=['label' => 'Date', 'rules' => 'trim'];
        // $validationRulesArr['refundAmtRecvd']=['label' => 'Refund Amount Received', 'rules' => 'trim'];
        // $validationRulesArr['refundRemark']=['label' => 'Remark', 'rules' => 'trim'];

        $isDocRecvdErr="";
        $docRecvdDateErr="";
        $workDoneErr="";
        $signatureDateErr="";
        $remarkErr="";
        $seniorIdErr="";
        $isUrgentWorkErr="";
        $setPreparedByErr="";
        
        // $eFillingDateErr="";
        // $acknowledgmentNoErr="";
        // $refundDueErr="";
        // $isDefectiveReturnErr="";
        // $defectiveReturnCommentErr="";
        // $verificationDoneByErr="";
        // $verificationDateErr="";
        // $isDefectiveRectifiedErr="";
        // $defectiveRectifiedCommentErr="";
        // $turnOverErr="";
        // $grossTotalIncomeErr="";
        // $totalIncomeErr="";
        // $selfAssessmentTaxErr="";
        // $refundDueValErr="";
        // $refundDateErr="";
        // $refundAmtRecvdErr="";
        // $refundRemarkErr="";


        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $isDocRecvdErr=$this->validation->getError('isDocRecvd');
                $docRecvdDateErr=$this->validation->getError('docRecvdDate');
                $workDoneErr=$this->validation->getError('workDone');
                $signatureDateErr=$this->validation->getError('signature_date');
                $remarkErr=$this->validation->getError('remark');
                $seniorIdErr=$this->validation->getError('seniorId');
                $isUrgentWorkErr=$this->validation->getError('isUrgentWork');
                $setPreparedByErr=$this->validation->getError('set_prepared_by');
                
                // $eFillingDateErr=$this->validation->getError('eFillingDate');
                // $acknowledgmentNoErr=$this->validation->getError('acknowledgmentNo');
                // $refundDueErr=$this->validation->getError('refundDue');
                // $isDefectiveReturnErr=$this->validation->getError('isDefectiveReturn');
                // $defectiveReturnCommentErr=$this->validation->getError('defectiveReturnComment');
                // $verificationDoneByErr=$this->validation->getError('verificationDoneBy');
                // $verificationDateErr=$this->validation->getError('verificationDate');
                // $isDefectiveRectifiedErr=$this->validation->getError('isDefectiveRectified');
                // $defectiveRectifiedCommentErr=$this->validation->getError('defectiveRectifiedComment');
                // $turnOverErr=$this->validation->getError('turnOver');
                // $grossTotalIncomeErr=$this->validation->getError('grossTotalIncome');
                // $totalIncomeErr=$this->validation->getError('totalIncome');
                // $selfAssessmentTaxErr=$this->validation->getError('selfAssessmentTax');
                // $refundDueValErr=$this->validation->getError('refundDueVal');
                // $refundDateErr=$this->validation->getError('refundDate');
                // $refundAmtRecvdErr=$this->validation->getError('refundAmtRecvd');
                // $refundRemarkErr=$this->validation->getError('refundRemark');
            }
            else
            {
                $this->db->transBegin();
                
                $workId=$this->request->getPost('workId');
                $stepData=$this->request->getPost('stepData');
                $isDocRecvd=$this->request->getPost('isDocRecvd');
                $docRecvdDate=$this->request->getPost('docRecvdDate');
                $workDone=$this->request->getPost('workDone');
                $signature_date=$this->request->getPost('signature_date');
                $auditCompletionDate=$this->request->getPost('auditCompletionDate');
                $udinDate=$this->request->getPost('udinDate');
                $udinNo=$this->request->getPost('udinNo');
                $remark=$this->request->getPost('remark');
                $juniorIdArr=$this->request->getPost('juniorId');
                $juniors=$this->request->getPost('juniors');
                $juniorIds=$this->request->getPost('juniorIds');
                $seniorId=$this->request->getPost('seniorId');
                $isUrgentWork=$this->request->getPost('isUrgentWork');
                $set_prepared_by=$this->request->getPost('setPreparedBy');
                $isBillingDone=$this->request->getPost('isBillingDone'); 
                $billNo=$this->request->getPost('billNo'); 
                $billDate=$this->request->getPost('billDate');
                $billAmt=$this->request->getPost('billAmt');
                $billingComment=$this->request->getPost('billingComment');
                $isReceiptDone=$this->request->getPost('isReceiptDone');
                $receiptDate=$this->request->getPost('receiptDate');
                $receiptAmt=$this->request->getPost('receiptAmt');
                $receiptComment=$this->request->getPost('receiptComment');
                $workPriority=$this->request->getPost('workPriority');
                $workPriorityColor=$this->request->getPost('workPriorityColor');

                if($isDocRecvd==1)
                    $docRecvdDateVal=$docRecvdDate;
                else
                    $docRecvdDateVal="";

                $wkUpdateArr = [
                    'isDocRecvd'=>$isDocRecvd,
                    'docRecvdDate'=>$docRecvdDateVal,
                    'workDone'=>$workDone,
                    'signature_date'=>$signature_date,
                    'auditCompletionDate'=>$auditCompletionDate,
                    'udinDate'=>$udinDate,
                    'udinNo'=>$udinNo,
                    'remark'=>$remark,
                    'juniors'=>$juniors,
                    'seniorId'=>$seniorId,
                    'isUrgentWork'=>$isUrgentWork,
                    'set_prepared_by'=>$set_prepared_by,
                    'isBillingDone'=>$isBillingDone,
                    'billNo'=>$billNo,
                    'billDate'=>$billDate,
                    'billAmt'=>$billAmt,
                    'billingComment'=>$billingComment,
                    'isReceiptDone'=>$isReceiptDone,
                    'receiptDate'=>$receiptDate,
                    'receiptAmt'=>$receiptAmt,
                    'receiptComment'=>$receiptComment,
                    'workPriority'=>$workPriority,
                    'workPriorityColor'=>$workPriorityColor,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
    
                $wkCondtnArr['work_tbl.workId']=$workId;
    
                $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                $junrUpdateArr = [
                    'status'=>2,
                    'updatedBy' => $this->adminId,
                    'updatedDatetime' => $this->currTimeStamp
                ];
    
                $junrCondtnArr['work_junior_map_tbl.fkWorkId']=$workId;
    
                $query=$this->Mcommon->updateData($tableName=$this->work_junior_map_tbl, $junrUpdateArr, $junrCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                $junrInsertArr=array();

                if(!empty($juniorIds))
                {
                    $juniorIdsData=explode(", ", $juniorIds);
                    foreach($juniorIdsData AS $e_jnr)
                    {
                        $junrInsertArr[] = [
                            'fkWorkId'=>$workId,
                            'fkUserId'=>$e_jnr,
                            'status' => 1,
                            'createdBy' => $this->adminId,
                            'createdDatetime' => $this->currTimeStamp
                        ];
                    }

                    $this->Mcommon->insert($tableName=$this->work_junior_map_tbl, $junrInsertArr, $returnType="");
                }

                if($this->db->transStatus() === FALSE)
                {
                    $this->db->transRollback();

                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Work Information not updated :(");
                }
                else
                {
                    $this->db->transCommit();

                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']="Work Information updated";
                    $insertLogArr['ip']=$this->IPAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mquery->insertLog($insertLogArr);

                    $this->session->setFlashdata('successMsg', "Work Information updated successfully :)");
                }

                // return redirect()->route('admin/income_tax/work_form/'.$workId);
            }
        }

        $this->data['isDocRecvdErr']=$isDocRecvdErr;
        $this->data['docRecvdDateErr']=$docRecvdDateErr;
        $this->data['workDoneErr']=$workDoneErr;
        // $signatureDateErr=$this->validation->getError('signature_date');
        //         $remarkErr=$this->validation->getError('remark');
        $this->data['signatureDateErr']=$signatureDateErr;
        $this->data['remarkErr']=$remarkErr;
        $this->data['seniorIdErr']=$seniorIdErr;
        $this->data['isUrgentWorkErr']=$isUrgentWorkErr;
        $this->data['setPreparedByErr']=$setPreparedByErr;
        
        // $this->data['eFillingDateErr']=$eFillingDateErr;
        // $this->data['acknowledgmentNoErr']=$acknowledgmentNoErr;
        // $this->data['refundDueErr']=$refundDueErr;
        // $this->data['isDefectiveReturnErr']=$isDefectiveReturnErr;
        // $this->data['defectiveReturnCommentErr']=$defectiveReturnCommentErr;
        // $this->data['verificationDoneByErr']=$verificationDoneByErr;
        // $this->data['verificationDateErr']=$verificationDateErr;
        // $this->data['isDefectiveRectifiedErr']=$isDefectiveRectifiedErr;
        // $this->data['defectiveRectifiedCommentErr']=$defectiveRectifiedCommentErr;
        // $this->data['turnOverErr']=$turnOverErr;
        // $this->data['grossTotalIncomeErr']=$grossTotalIncomeErr;
        // $this->data['totalIncomeErr']=$totalIncomeErr;
        // $this->data['selfAssessmentTaxErr']=$selfAssessmentTaxErr;
        // $this->data['refundDueValErr']=$refundDueValErr;
        // $this->data['refundDateErr']=$refundDateErr;
        // $this->data['refundAmtRecvdErr']=$refundAmtRecvdErr;
        // $this->data['refundRemarkErr']=$refundRemarkErr;

        return view('firm_panel/compliance/income_tax/audit_work_form', $this->data);
    }

	public function payment_work_form()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $clientId=$uri->getSegment(3);

        $this->data['clientId']=$clientId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Advance Tax Details";
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

        $workCondtnArr['client_tbl.clientId']=$clientId;
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.juniors, work_tbl.isDocRecvd, work_tbl.docRecvdDate, work_tbl.seniorId, work_tbl.workDone, work_tbl.isUrgentWork, work_tbl.eFillingDate, work_tbl.verificationDoneBy, work_tbl.acknowledgmentNo, work_tbl.verificationDate, work_tbl.refundDue, work_tbl.isDefectiveReturn, work_tbl.defectiveReturnComment, work_tbl.isDefectiveRectified, work_tbl.defectiveRectifiedComment, work_tbl.turnOver, work_tbl.grossTotalIncome, work_tbl.totalIncome, work_tbl.selfAssessmentTax, work_tbl.refundDueVal, work_tbl.refundAmtRecvd, work_tbl.refundDate, work_tbl.refundRemark, work_tbl.signature_date, work_tbl.remark, work_tbl.set_prepared_by, client_tbl.clientId, client_tbl.clientName, IF(client_tbl.clientBussOrganisationType = '9', client_tbl.clientName, client_tbl.clientBussOrganisation) as clientNameVal, user_tbl.userFullName, work_tbl.pmtAmountSuggested, work_tbl.pmtJuniorId, work_tbl.pmtApproved, work_tbl.pmtNewAmt, work_tbl.amtApproved, work_tbl.amtApprovedRemark, work_tbl.amtPaid, work_tbl.pmtDate, work_tbl.pmtType, work_tbl.pmtRemark, work_tbl.isPmtActive, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        $this->data['workArr']=$workArr;
        
        $workClientName="";
        
        if(!empty($workArr))
        {
            $clientBussOrgType=$workArr['clientBussOrganisationType'];
            
            if($clientBussOrgType==8)
                $workClientName=$workArr['clientName']." (".$workArr['clientBussOrganisation'].")";
            elseif($clientBussOrgType==9)
                $workClientName=$workArr['clientName'];
            else
                $workClientName=$workArr['clientBussOrganisation'];
        }
        
        $this->data['workClientName']=$workClientName;

        $workCondtnArr=array();
        $workOrderByArr=array();
        $workWhereInArray=array();
        $workJoinArr=array();

        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['client_tbl.clientId']=$clientId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_id');
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=array(101);
        
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.pmtJuniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName, work_tbl.workDone, work_tbl.signature_date, work_tbl.remark, work_tbl.set_prepared_by, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, ext_due_date_master_tbl.extended_date, ext_due_date_master_tbl.is_extended, work_tbl.pmtAmountSuggested, work_tbl.pmtJuniorId, work_tbl.pmtApproved, work_tbl.pmtNewAmt, work_tbl.amtApproved, work_tbl.amtPaid, work_tbl.pmtDate, work_tbl.pmtType, work_tbl.pmtRemark, work_tbl.isPmtActive", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName, work_tbl.workDone, work_tbl.signature_date, work_tbl.remark, work_tbl.set_prepared_by, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, ext_due_date_master_tbl.extended_date, ext_due_date_master_tbl.is_extended, work_tbl.pmtAmountSuggested, work_tbl.pmtJuniorId, work_tbl.pmtApproved, work_tbl.pmtNewAmt, work_tbl.amtApproved, work_tbl.amtApprovedRemark, work_tbl.amtPaid, work_tbl.pmtDate, work_tbl.pmtType, work_tbl.pmtRemark, work_tbl.isPmtActive", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $pmtActiveArr=array();

        if(!empty($workDataArr))
        {
            $pmtActiveArr=array_unique(array_column($workDataArr, 'isPmtActive'));
        }

        $this->data['pmtActiveArr']=$pmtActiveArr;

        $userCondtnArr['user_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userShortName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userStaffType", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        // $validationRulesArr['pmtAmountSuggested']=['label' => 'Amount Suggested', 'rules' => 'trim'];
        $validationRulesArr['pmtJuniorId']=['label' => 'Junior Alloction', 'rules' => 'trim'];
        // $validationRulesArr['pmtApproved']=['label' => 'Whether Approved', 'rules' => 'trim'];
        // $validationRulesArr['pmtNewAmt']=['label' => 'New Amount', 'rules' => 'trim'];

        $pmtAmountSuggestedErr="";
        $pmtJuniorIdErr="";
        $pmtApprovedErr="";
        $pmtNewAmtErr="";

        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                // $pmtAmountSuggestedErr=$this->validation->getError('pmtAmountSuggested');
                $pmtJuniorIdErr=$this->validation->getError('pmtJuniorId');
                // $pmtApprovedErr=$this->validation->getError('pmtApproved');
                // $pmtNewAmtErr=$this->validation->getError('pmtNewAmt');
            }
            else
            {
                $this->db->transBegin();

                $clientId=$this->request->getPost('clientId');
                $pmtAmountSuggested=$this->request->getPost('pmtAmountSuggested');
                $pmtJuniorId=$this->request->getPost('pmtJuniorId');
                $pmtApproved=$this->request->getPost('pmtApproved');
                $pmtNewAmt=$this->request->getPost('pmtNewAmt');

                if($pmtApproved==1)
                    $pmtApproved=$pmtAmountSuggested;

                $fin_year_arr=explode("-", $this->sessDueDateYear);

                $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
                $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
                $clWkCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
                $clWkCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
                $clWkCondtnArr['work_tbl.fkClientId']=$clientId;
                $clWkCondtnArr['work_tbl.status']="1";
                $clWkCondtnArr['due_date_master_tbl.status']=1;
                $clWkCondtnArr['due_date_for_tbl.status']=1;
                
                $clWkWhereInArray['due_date_for_tbl.act_option_map_id']=array(101);
                
                $clWkJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
                $clWkJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
                $clWkJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
                
                $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.fk_due_date_id", $clWkCondtnArr, $likeCondtnArr=array(), $clWkJoinArr, $singleRow=FALSE, $workOrderByArr=array(), $groupByArr=array(), $clWkWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
                
                $clWkDataArr=$query['userData'];

                if(!empty($clWkDataArr))
                {
                    $clientDueDateArr=array_unique(array_column($clWkDataArr, 'fk_due_date_id'));

                    $wkUpdateArr = [
                        'pmtAmountSuggested'=>$pmtAmountSuggested,
                        'pmtJuniorId'=>$pmtJuniorId,
                        'pmtApproved'=>$pmtApproved,
                        'pmtNewAmt'=>$pmtNewAmt,
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
        
                    $wkCondtnArr['work_tbl.fkClientId']=$clientId;
                    $wkWhereInArray['work_tbl.fk_due_date_id']=$clientDueDateArr;
        
                    $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $wkWhereInArray);
                }

                if($this->db->transStatus() === FALSE)
                {
                    $this->db->transRollback();

                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Work Information not updated :(");
                }
                else
                {
                    $this->db->transCommit();

                    $insertLogArr['section']=$this->section;
                    $insertLogArr['message']="Work Information updated";
                    $insertLogArr['ip']=$this->IPAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;

                    $this->Mquery->insertLog($insertLogArr);

                    $this->session->setFlashdata('successMsg', "Work Information updated successfully :)");
                }
            }
        }

        $this->data['pmtAmountSuggestedErr']=$pmtAmountSuggestedErr;
        $this->data['pmtJuniorIdErr']=$pmtJuniorIdErr;
        $this->data['pmtApprovedErr']=$pmtApprovedErr;
        $this->data['pmtNewAmtErr']=$pmtNewAmtErr;

        return view('firm_panel/compliance/income_tax/payment_work_form', $this->data);
    }

    public function add_payable_amt()
    {
        $this->db->transBegin();
        
        $workId=$this->request->getPost('pmtPayableWorkId');
        $clientId=$this->request->getPost('pmtPayableClientId');
        $amtApproved=$this->request->getPost('amtApproved');
        $amtApprovedRemark=$this->request->getPost('amtApprovedRemark');

        $wkUpdateArr = [
            'amtApproved'=>$amtApproved,
            'amtApprovedRemark'=>$amtApprovedRemark,
            'isPmtActive'=>1,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['work_tbl.workId']=$workId;
        $wkCondtnArr['work_tbl.fkClientId']=$clientId;

        $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Payment not done :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Payable Amount Saved - Income Tax";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Payable Amount has been saved successfully :)");
        }
    }
    
    public function add_payment()
    {
        $this->db->transBegin();
        
        $workId=$this->request->getPost('pmtWorkId');
        $clientId=$this->request->getPost('pmtClientId');
        $amtPaid=$this->request->getPost('amtPaid');
        $pmtDate=$this->request->getPost('pmtDate');
        $pmtType=$this->request->getPost('pmtType');
        $pmtRemark=$this->request->getPost('pmtRemark');

        $wkUpdateArr = [
            'amtPaid'=>$amtPaid,
            'pmtDate'=>$pmtDate,
            'pmtType'=>$pmtType,
            'pmtRemark'=>$pmtRemark,
            'isPmtActive'=>1,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['work_tbl.workId']=$workId;
        $wkCondtnArr['work_tbl.fkClientId']=$clientId;

        $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Payment not done :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Payment Done - Income Tax";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Payment has been done successfully :)");
        }
    }
    
    public function update_payment()
    {
        $this->db->transBegin();
        
        $workId=$this->request->getPost('pmtWorkId');
        $clientId=$this->request->getPost('pmtClientId');
        $amtPaid=$this->request->getPost('amtPaid');
        $pmtDate=$this->request->getPost('pmtDate');
        $pmtType=$this->request->getPost('pmtType');
        $pmtRemark=$this->request->getPost('pmtRemark');

        $wkUpdateArr = [
            'amtPaid'=>$amtPaid,
            'pmtDate'=>$pmtDate,
            'pmtType'=>$pmtType,
            'pmtRemark'=>$pmtRemark,
            'isPmtActive'=>1,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['work_tbl.workId']=$workId;
        $wkCondtnArr['work_tbl.fkClientId']=$clientId;

        $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Payment information not update :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Payment Done - Income Tax";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Payment information has been updated successfully :)");
        }
        
        return redirect()->to(base_url('income_tax/payment_work_form/'.$clientId));
    }

    public function delete_payment()
    {
        $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $clientId=$this->request->getPost('clientId');

        $wkUpdateArr = [
            'amtPaid'=>0,
            'isPmtActive'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $wkCondtnArr['work_tbl.workId']=$workId;
        $wkCondtnArr['work_tbl.fkClientId']=$clientId;

        $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Payment not deleted :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Payment Deleted - Income Tax";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Payment has been deleted successfully :)");
        }
    }
    
    public function inc_tax_register_section()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Registers";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/income_tax/inc_tax_register_section', $this->data);
    }
    
    public function return_filed_register()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Returns Register";
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
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        // $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['work_tbl.eFillingDate']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, work_tbl.isScrutiny, work_tbl.refundDueVal, work_tbl.selfAssessmentTax, work_tbl.intiTotalIncome, work_tbl.intiRefundApproved, work_tbl.intiAddtnlTax, work_tbl.intiRemark, work_tbl.intiIsRectification, work_tbl.intiIsScrutiny, user_tbl.userFullName AS seniorName, work_tbl.workDone, work_tbl.eFillingDate, work_tbl.acknowledgmentNo, work_tbl.refundDate, work_tbl.totalIncome, work_tbl.selfAssessmentTax, work_tbl.refundDueVal, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, due_date_for_tbl.act_option_map_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_tbl.clientPanNumber, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, refund_tbl.totalIncome, refund_tbl.refundClaimed", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $ddfRetRegIdArr = array();
        $ddfReturnsRegArr = array();
        
        if(!empty($workDataArr))
        {
            $ddfRetRegIdArr = array_unique(array_column($workDataArr, 'act_option_map_id'));
            
            foreach($workDataArr AS $e_work)
            {
                $ddfReturnsRegArr[$e_work['act_option_map_id']][]=$e_work;
            }
        }
        
        $this->data['ddfReturnsRegArr']=$ddfReturnsRegArr;
        
        $dueDateForList=array();
        
        if(!empty($ddfRetRegIdArr))
        {
            $ddfCondtnArr['act_option_map_tbl.status']="1";
            $ddfCondtnArr['act_option_map_tbl.option_type']="1";
            $ddfCondtnArr['act_option_map_tbl.fk_act_id']="1";
            $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
            
            $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=$ddfRetRegIdArr;
            
            $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
            
            $dueDateForList=$query['userData'];
        }

        $this->data['dueDateForList']=$dueDateForList;

        return view('firm_panel/compliance/income_tax/return_filed_register', $this->data);
    }
    
    public function return_filed_register_filing_wise()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Returns Register";
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
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        // $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['work_tbl.eFillingDate']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, work_tbl.isScrutiny, work_tbl.refundDueVal, work_tbl.selfAssessmentTax, work_tbl.intiTotalIncome, work_tbl.intiRefundApproved, work_tbl.intiAddtnlTax, work_tbl.intiRemark, work_tbl.intiIsRectification, work_tbl.intiIsScrutiny, user_tbl.userFullName AS seniorName, work_tbl.workDone, work_tbl.eFillingDate, work_tbl.acknowledgmentNo, work_tbl.refundDate, work_tbl.totalIncome, work_tbl.selfAssessmentTax, work_tbl.refundDueVal, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, due_date_for_tbl.act_option_map_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_tbl.clientPanNumber, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, refund_tbl.totalIncome, refund_tbl.refundClaimed", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        return view('firm_panel/compliance/income_tax/return_filed_register_filing_wise', $this->data);
    }
    
    public function refunds()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Refunds";
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
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        // $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        $workOrderByArr['client_tbl.clientName']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workGroupByArr=array('due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="
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
                    refund_tbl.refundClaimed, 
                    refund_tbl.intiTotalRefundAmt, 
                    refund_tbl.intiTotalInterestAmt, 
                    refund_tbl.intiTotalRefund, 
                    refund_tbl.intiRefundDate1, 
                    refund_tbl.intiRefundDate2, 
                    refund_tbl.intiRefundDate3, 
                    refund_tbl.intiRefundDate4
                ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        return view('firm_panel/compliance/income_tax/refunds', $this->data);
    }
    
    public function refund_details()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $workId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Refund Details";
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
        
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $columnNames="work_tbl.workId,
            work_tbl.eFillingDate, 
            work_tbl.acknowledgmentNo, 
            client_tbl.clientName, 
            client_tbl.clientBussOrganisation, 
            client_tbl.clientPanNumber, 
            client_tbl.clientDob, 
            client_tbl.clientBussIncorporationDate, 
            client_tbl.clientBussOrganisationType AS orgType,
            due_date_master_tbl.finYear,
            refund_tbl.refundId, 
            refund_tbl.totalIncome, 
            refund_tbl.intiTotalIncome, 
            refund_tbl.refundClaimed, 
            refund_tbl.refundPrincipalAmt, 
            refund_tbl.refundInterestAmt, 
            refund_tbl.refundTotalAmt, 
            refund_tbl.intiRefundApproved, 
            refund_tbl.intiAddtnlTax, 
            refund_tbl.intiRemark, 
            refund_tbl.intiRefundApproved1, 
            refund_tbl.intiRefundApproved2, 
            refund_tbl.intiRefundApproved3, 
            refund_tbl.intiRefundApproved4, 
            refund_tbl.intiRefundApproved5, 
            refund_tbl.intiTotalRefundApproved, 
            refund_tbl.intiRefundAmt1, 
            refund_tbl.intiRefundAmt2, 
            refund_tbl.intiRefundAmt3, 
            refund_tbl.intiRefundAmt4, 
            refund_tbl.intiRefundAmt5, 
            refund_tbl.intiTotalRefundAmt, 
            refund_tbl.intiInterestAmt1, 
            refund_tbl.intiInterestAmt2, 
            refund_tbl.intiInterestAmt3, 
            refund_tbl.intiInterestAmt4, 
            refund_tbl.intiInterestAmt5, 
            refund_tbl.intiTotalInterestAmt, 
            refund_tbl.intiTotalRefund1, 
            refund_tbl.intiTotalRefund2, 
            refund_tbl.intiTotalRefund3, 
            refund_tbl.intiTotalRefund4, 
            refund_tbl.intiTotalRefund5, 
            refund_tbl.intiTotalRefund, 
            refund_tbl.intiRefundDate1, 
            refund_tbl.intiRefundDate2, 
            refund_tbl.intiRefundDate3, 
            refund_tbl.intiRefundDate4, 
            refund_tbl.intiRefundDate5, 
            refund_tbl.intiBalRefundRecvd, 
            refund_tbl.intiRefundRemark, 
            refund_tbl.intiIsRectification";
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=$columnNames, $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=TRUE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        return view('firm_panel/compliance/income_tax/refund_details', $this->data);
    }
    
    public function update_refund_details()
    {
        $this->db->transBegin();
        
        $workId=$this->request->getPost('workId');
        $refundId=$this->request->getPost('refundId');
        $intiRefundAmt1=$this->request->getPost('intiRefundAmt1');
        $intiRefundAmt2=$this->request->getPost('intiRefundAmt2');
        $intiRefundAmt3=$this->request->getPost('intiRefundAmt3');
        $intiRefundAmt4=$this->request->getPost('intiRefundAmt4');
        $intiRefundAmt5=$this->request->getPost('intiRefundAmt5');
        $intiTotalRefundAmt=$this->request->getPost('intiTotalRefundAmt');
        $intiInterestAmt1=$this->request->getPost('intiInterestAmt1');
        $intiInterestAmt2=$this->request->getPost('intiInterestAmt2');
        $intiInterestAmt3=$this->request->getPost('intiInterestAmt3');
        $intiInterestAmt4=$this->request->getPost('intiInterestAmt4');
        $intiInterestAmt5=$this->request->getPost('intiInterestAmt5');
        $intiTotalInterestAmt=$this->request->getPost('intiTotalInterestAmt');
        $intiTotalRefund1=$this->request->getPost('intiTotalRefund1');
        $intiTotalRefund2=$this->request->getPost('intiTotalRefund2');
        $intiTotalRefund3=$this->request->getPost('intiTotalRefund3');
        $intiTotalRefund4=$this->request->getPost('intiTotalRefund4');
        $intiTotalRefund5=$this->request->getPost('intiTotalRefund5');
        $intiTotalRefund=$this->request->getPost('intiTotalRefund');
        $intiRefundDate1=$this->request->getPost('intiRefundDate1');
        $intiRefundDate2=$this->request->getPost('intiRefundDate2');
        $intiRefundDate3=$this->request->getPost('intiRefundDate3');
        $intiRefundDate4=$this->request->getPost('intiRefundDate4');
        $intiRefundDate5=$this->request->getPost('intiRefundDate5');
        $intiBalRefundRecvd=$this->request->getPost('intiBalRefundRecvd');
        $intiRefundRemark=$this->request->getPost('intiRefundRemark');

        $updateIntiArr=array(
            'refundId'=>$refundId, 
            'fkWorkId'=>$workId,
            'intiRefundAmt1'=>$intiRefundAmt1, 
            'intiRefundAmt2'=>$intiRefundAmt2, 
            'intiRefundAmt3'=>$intiRefundAmt3, 
            'intiRefundAmt4'=>$intiRefundAmt4, 
            'intiRefundAmt5'=>$intiRefundAmt5, 
            'intiTotalRefundAmt'=>$intiTotalRefundAmt, 
            'intiInterestAmt1'=>$intiInterestAmt1, 
            'intiInterestAmt2'=>$intiInterestAmt2, 
            'intiInterestAmt3'=>$intiInterestAmt3, 
            'intiInterestAmt4'=>$intiInterestAmt4, 
            'intiInterestAmt5'=>$intiInterestAmt5, 
            'intiTotalInterestAmt'=>$intiTotalInterestAmt, 
            'intiTotalRefund1'=>$intiTotalRefund1, 
            'intiTotalRefund2'=>$intiTotalRefund2, 
            'intiTotalRefund3'=>$intiTotalRefund3, 
            'intiTotalRefund4'=>$intiTotalRefund4, 
            'intiTotalRefund5'=>$intiTotalRefund5, 
            'intiTotalRefund'=>$intiTotalRefund, 
            'intiRefundDate1'=>$intiRefundDate1, 
            'intiRefundDate2'=>$intiRefundDate2, 
            'intiRefundDate3'=>$intiRefundDate3, 
            'intiRefundDate4'=>$intiRefundDate4, 
            'intiRefundDate5'=>$intiRefundDate5, 
            'intiBalRefundRecvd'=>$intiBalRefundRecvd, 
            'intiRefundRemark'=>$intiRefundRemark, 
            'status' => 1, 
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        );
        
        $this->Mrefund->save($updateIntiArr);
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Refund Details not updated :(");
        }
        else
        {
            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Refund Details updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Refund Details has been updated successfully :)");
        }
        
        return redirect()->route('income_tax_refunds');
    }
    
    public function inc_tax_assessee_ledger()
	{
	    ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Income Tax - Assessee Ledger";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_act_map_tbl.fkActId']=1;
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientGroupByArr=array("client_tbl.clientId");
        
        $clientJoinArr[]=array("tbl"=>$this->client_act_map_tbl, "condtn"=>"client_act_map_tbl.fkClientId=client_tbl.clientId", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=client_group_tbl.client_group_cost", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name, organisation_type_tbl.shortName, user_tbl.userShortName", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $clientGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;

        return view('firm_panel/compliance/income_tax/inc_tax_assessee_ledger', $this->data);
	}
	
	public function inc_tax_assessee_ledger_client()
	{
	    ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $this->data['clientId']=$clientId=$uri->getSegment(2);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Income Tax - Assessee Ledger";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $clientCondtnArr['client_tbl.clientId']=$clientId;
        $clientCondtnArr['client_tbl.status']="1";
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType, client_tbl.clientPanNumber, client_tbl.clientDob, client_tbl.clientBussIncorporationDate", $clientCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientData=$query['userData'];
        
        $this->data['clientData']=$clientData;
        
        // $fin_year_arr=explode("-", $this->sessDueDateYear);

        // $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        // $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        // $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        // $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        $workCondtnArr['client_tbl.clientId']=$clientId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        // $workCondtnArr['work_tbl.workDone']="100";
        // $workCondtnArr['work_tbl.eFillingDate != ']="";
        // $workCondtnArr['work_tbl.eFillingDate !=  ']="0000-00-00";
        // $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        // $workOrderByArr['act_tbl.act_name']="ASC";
        // $workOrderByArr['work_tbl.eFillingDate']="ASC";
        // $workOrderByArr['client_tbl.clientId']="ASC";
        $workOrderByArr['due_date_master_tbl.finYear']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['due_date_master_tbl.due_date_id']="ASC";
        
        $workGroupByArr=array('work_tbl.workId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id AND tax_payer_due_date_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->refund_tbl, "condtn"=>"refund_tbl.fkWorkId=work_tbl.workId AND refund_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, work_tbl.isScrutiny, work_tbl.refundDueVal, work_tbl.selfAssessmentTax, work_tbl.intiTotalIncome, work_tbl.intiRefundApproved, work_tbl.intiAddtnlTax, work_tbl.intiRemark, work_tbl.intiIsRectification, work_tbl.intiIsScrutiny, user_tbl.userFullName AS seniorName, work_tbl.workDone, work_tbl.eFillingDate, work_tbl.acknowledgmentNo, work_tbl.refundDate, work_tbl.totalIncome, work_tbl.selfAssessmentTax, work_tbl.refundDueVal, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, due_date_for_tbl.shortName AS ddfShortName, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate, client_tbl.clientPanNumber, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, refund_tbl.totalIncome, refund_tbl.refundClaimed", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;

        return view('firm_panel/compliance/income_tax/inc_tax_assessee_ledger_client', $this->data);
	}
}
?>