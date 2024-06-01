<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>

    .tabcontent-border {
        border: none;
        border-top: 0px;
    }
    
    .due-month{
        background:#F99D27;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }
    
    .due-month label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .heading-act {
        background:#00669d;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
        color:#fff;
    }
    
    .heading-act label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .table.dataTable-act {
        margin-top: 0px !important; 
        font-size: 12px !important;
        clear: both;
        margin-bottom: 6px !important;
        max-width: none !important;
        border-collapse: separate !important;
    }
    
    .tablepress thead tr, .tablepress thead th {
        border: 1px solid #ddd;
        color: #fff;
        font-size: 14px !important;
    }
    
    .tablepress tbody {
        font-size: 14px !important;
    }
    
    td.column-1 {
        text-align: center;
        font-weight: normal;
        font-size: 16px;
    }
    
    .tablepress tbody tr:first-child td {
        background: none;
    }
    
    .tablepress tbody tr:nth-child(4) td.column-1 {
        background: none;
    }
    
    .tablepress tbody td, .tablepress tfoot th {
      border: 1px solid #015aacab !important;
      color: #000;
    }
    
    .box-body {
        padding: 0.1rem 0.1rem;
        /* -ms-flex: 1 1 auto; */
        flex: 1 1 auto;
        border-radius: 10px;
    }
    
    .modal-header {
        
        border-bottom-color: #d5dfea;
        background-color: #F99D27;
        padding: 8px 8px;
    }
    
    .theme-primary .btn-success1 {
        background-color: #1e613b !important;
        border-color: #1e613b !important;
        color: #ffffff !important;
        width: 100px;
        font-size: 13px;
    }
    
    .theme-primary a:hover, .theme-primary a:focus {
        color: #303030 !important;
    }
    
    a {
        color: #303030;
    }

    .sub_btn{
        width: 80px !important;
    }
    
    .theme-primary .btnPrimClr {
        margin-top: 0px !important;
        height: 25px !important;
        margin-bottom: 0px !important;   
    }
    
    .actionText{
        font-size: 11px !important;
    }
    
    .proj_modal_bg{
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }
    
    .bg_prjt_format {
      padding: 1.1rem 1.1rem;
      flex: 1 1 auto;
      border-radius: 10px;
      border: 1px solid #015aacab !important;
      background: #96c7f242 !important;
    }
    
    .main_cont_section span, .main_cont_section label, .main_cont_section div, .main_cont_section th, .main_cont_section td{
        font-size: 16px !important;
    }
    
    .tablepress {
        background: #eff8ff !important;
    }
    
    .noticeDivLine{
        border-top-style: double !important;
        border-top-color: #005495 !important;
    }
</style>
<?php 
    if(in_array($workDataArr['orgType'], INDIVIDUAL_ARRAY))
        $clientNameVar=$workDataArr['clientName'];
    else
        $clientNameVar=$workDataArr['clientBussOrganisation']; 
        
    $asmtYear="N/A";
    if(!empty($workDataArr['finYear']))
    {
        $asmtYearVal=$workDataArr['finYear'];
        
        $asmtYearArr = explode('-', $asmtYearVal);
        
        $fY=(int)$asmtYearArr[0]+1;
        $lY=(int)$asmtYearArr[1]+1;
        
        $asmtYear=$fY."-".$lY;
    }
    
    $isExternal=$workDataArr['isExternal'];
    $refundTotalAmt=$workDataArr['refundTotalAmt'];
    $demandTotalAmt=$workDataArr['demandTotalAmt'];
?>
<!-- Main content -->
<section class="content mt-35 main_cont_section">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?= base_url('it-scrutiny'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="row mt-10 m-30">
                        <div class="col-md-12">
                            <div class="row bg_prjt_format">
                                <div class="col-md-12">
                                    <div class="row form-group">
                                        <div class="col-md-12 col-lg-12 text-center mb-3">
                                            <span class="font-weight-bold" >
                                                <?= $clientNameVar; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-3 col-lg-3 text-center">
                                            <span class="font-weight-bold">PAN :&nbsp;</span>
                                            <span>
                                                <?= $workDataArr['clientPanNumber']; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-2 col-lg-2 text-center">
                                            <span class="font-weight-bold">A.Y :&nbsp;</span>
                                            <span>
                                                <?= $asmtYear; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-4 col-lg-4 text-center">
                                            <span class="font-weight-bold">Ack No :&nbsp;</span>
                                            <span>
                                                <?= (!empty($workDataArr['acknowledgmentNo'])) ? $workDataArr['acknowledgmentNo'] : "-"; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-3 col-lg-3 text-center">
                                            <span class="font-weight-bold">Date of Filing :&nbsp;</span>
                                            <span>
                                                <?= (check_valid_date($workDataArr['eFillingDate'])) ? date('d-m-Y', strtotime($workDataArr['eFillingDate'])) : "-" ?>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <?php if($isExternal==1): ?>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label class="text-white">Basic Details</label>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#editBasicDetailsModal">
                                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-success float-right mr-2">
                                                        <i class="fa fa-pencil"></i>&nbsp;Edit
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <?php endif; ?>
                                <div class="offset-lg-4 col-md-4">
                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                            <thead>
                                                <tr class="row-1">
                                                    <th class="column-2" nowrap >Particulars (As per)</th>
                                                    <th class="column-3" nowrap >Return of Income</th>
                                                    <th class="column-4" nowrap >Intimation</th>
                                                </tr>
                                            </thead>
                                            <tbody class="row-hover">
                                                <tr class="row-1">
                                                    <td class="column-2">Total Income</td>
                                                    <td class="column-2 text-right"><?= (!empty($workDataArr['totalIncome'])) ? amount_format($workDataArr['totalIncome']) : 0; ?></td>
                                                    <td class="column-2 text-right"><?= (!empty($workDataArr['intiTotalIncome'])) ? amount_format($workDataArr['intiTotalIncome']) : 0; ?></td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-2">Refund</td>
                                                    <td class="column-2 text-right"><?= (!empty($workDataArr['refundClaimed'])) ? amount_format($workDataArr['refundClaimed']) : 0; ?></td>
                                                    <td class="column-2 text-right"><?= (!empty($refundTotalAmt)) ? amount_format($refundTotalAmt) : 0; ?></td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-2">Demand</td>
                                                    <td class="column-2 text-right">-</td>
                                                    <td class="column-2 text-right"><?= (!empty($demandTotalAmt)) ? amount_format($demandTotalAmt) : 0; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label class="text-white">Details of Notice</label>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#editNoticeDetailsModal">
                                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-success float-right mr-2">
                                                        <i class="fa fa-pencil"></i>&nbsp;Edit
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Name of the Assessing Officer : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (!empty($workDataArr['assessingOfficer'])) ? $workDataArr['assessingOfficer'] : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Ward No & Location : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (!empty($workDataArr['wardNo'])) ? $workDataArr['wardNo'] : "-" ?>
                                                    <?= (!empty($workDataArr['placeNo'])) ? $workDataArr['placeNo'] : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Name of the Inspector : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (!empty($workDataArr['inspectorName'])) ? $workDataArr['inspectorName'] : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Name of the Tax Assistant : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (!empty($workDataArr['taxAssistantName'])) ? $workDataArr['taxAssistantName'] : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label class="text-white">Details of Hearing/Follow-Up</label>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#addNoticeHearingModal">
                                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-success float-right mr-2">
                                                        <i class="fa fa-plus"></i>&nbsp;Add Notice
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                    <thead>
                                                        <tr class="row-1">
                                                            <th class="column-2" nowrap width="5%">SN</th>
                                                            <th class="column-3" nowrap width="5%">Notice U/S</th>
                                                            <th class="column-4" nowrap width="5%">Dated</th>
                                                            <th class="column-4" nowrap width="5%">Due Date</th>
                                                            <th class="column-4" nowrap width="5%">Replied On</th>
                                                            <th class="column-4" nowrap width="5%">Letter Ref No</th>
                                                            <th class="column-4" nowrap width="5%">Attended On</th>
                                                            <th class="column-6" nowrap width="5%">Attended By</th>
                                                            <th class="column-7" nowrap width="5%">Next Hearing Date</th>
                                                            <th class="column-1" nowrap width="5%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                    <?php if(!empty($scrNoticeArr)): ?>
                                                        <?php foreach($scrNoticeArr AS $k_noc => $e_noc): ?>
                                                            <?php $scrNoticeId = $e_noc['scrNoticeId']; ?>
                                                            
                                                            <?php $noticeReplyArr = $firstNoticeReplyArr = $remainNoticeReplyArr = array(); ?>
                                                            <?php if(isset($scrNoticeReplyArray[$scrNoticeId])): ?>
                                                                <?php $noticeReplyArr = $scrNoticeReplyArray[$scrNoticeId]; ?>
                                                                <?php $firstNoticeReplyArr = array_shift($noticeReplyArr); ?>
                                                                <?php $remainNoticeReplyArr = $noticeReplyArr; ?>
                                                             <?php endif; ?>
                                                            
                                                            <tr class="row-1 <?php if($k_noc>0): ?> noticeDivLine <?php endif; ?>">
                                                                <td class="column-2 text-center"><?= ($k_noc+1); ?></td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_noc['noticeUnderSectionTitle'])) ? $e_noc['noticeUnderSectionTitle'] : "-" ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?= (check_valid_date($e_noc['noticeDate'])) ? date('d-m-Y', strtotime($e_noc['noticeDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?= (check_valid_date($e_noc['noticeDueDate'])) ? date('d-m-Y', strtotime($e_noc['noticeDueDate'])) : "-" ?>
                                                                </td>
                                                                <?php if(!empty($firstNoticeReplyArr)): ?>
                                                                    <td class="column-5 text-center">
                                                                        <?= (check_valid_date($firstNoticeReplyArr['repliedOn'])) ? date('d-m-Y', strtotime($firstNoticeReplyArr['repliedOn'])) : "-" ?>
                                                                    </td>	
                                                                    <td class="column-5 text-center">
                                                                        <?= (!empty($firstNoticeReplyArr['letterRefNo'])) ? $firstNoticeReplyArr['letterRefNo'] : "-" ?>
                                                                    </td>	
                                                                    <td class="column-5 text-center">
                                                                        <?= (check_valid_date($firstNoticeReplyArr['attendedOn'])) ? date('d-m-Y', strtotime($firstNoticeReplyArr['attendedOn'])) : "-" ?>
                                                                    </td>	
                                                                    <td class="column-5 text-center">
                                                                        <?= (!empty($firstNoticeReplyArr['attendedBy'])) ? $firstNoticeReplyArr['attendedBy'] : "-" ?>
                                                                    </td>	
                                                                    <td class="column-5 text-center">
                                                                        <?= (check_valid_date($firstNoticeReplyArr['nextDate'])) ? date('d-m-Y', strtotime($firstNoticeReplyArr['nextDate'])) : "-" ?>
                                                                    </td>
                                                                    <td class="column-1">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#addNoticeReplyModal<?= $scrNoticeId; ?>">
                                                                                    <i class="fa fa-reply"></i>&nbsp;Reply Notice
                                                                                </a>
                                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editNoticeHearingModal<?= $scrNoticeId; ?>">
                                                                                    <i class="fa fa-pencil"></i>&nbsp;Edit Notice
                                                                                </a>
                                                                                <a class="dropdown-item delScrNotice" href="javascript:void(0);" data-id="<?= $scrNoticeId; ?>">
                                                                                    <i class="fa fa-trash"></i>&nbsp;Delete Notice
                                                                                </a>
                                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editNoticeReplyModal<?= $firstNoticeReplyArr['scrNoticeReplyId']; ?>">
                                                                                    <i class="fa fa-pencil"></i>&nbsp;Edit Reply
                                                                                </a>
                                                                                <a class="dropdown-item delScrNoticeReply" href="javascript:void(0);" data-id="<?= $firstNoticeReplyArr['scrNoticeReplyId']; ?>" data-notice_id="<?= $firstNoticeReplyArr['fkScrNoticeId']; ?>">
                                                                                    <i class="fa fa-trash"></i>&nbsp;Delete Reply
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                <?php else: ?>
                                                                    <td class="column-5 text-center">-</td>	
                                                                    <td class="column-5 text-center">-</td>	
                                                                    <td class="column-5 text-center">-</td>	
                                                                    <td class="column-5 text-center">-</td>	
                                                                    <td class="column-5 text-center">-</td>	
                                                                    <td class="column-1">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#addNoticeReplyModal<?= $scrNoticeId; ?>">
                                                                                    <i class="fa fa-reply"></i>&nbsp;Reply Notice
                                                                                </a>
                                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editNoticeHearingModal<?= $scrNoticeId; ?>">
                                                                                    <i class="fa fa-pencil"></i>&nbsp;Edit Notice
                                                                                </a>
                                                                                <a class="dropdown-item delScrNotice" href="javascript:void(0);" data-id="<?= $scrNoticeId; ?>">
                                                                                    <i class="fa fa-trash"></i>&nbsp;Delete Notice
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                <?php endif; ?>
                                                            </tr>
                                                                
                                                            <?php if(!empty($noticeReplyArr)): ?>
                                                                <?php foreach($noticeReplyArr AS $e_reply): ?>
                                                                    <tr class="row-1">
                                                                        <td class="column-2 text-center"></td>
                                                                        <td class="column-3 text-center"></td>
                                                                        <td class="column-4 text-center"></td>
                                                                        <td class="column-4 text-center"></td>
                                                                        <td class="column-5 text-center">
                                                                            <?= (check_valid_date($e_reply['repliedOn'])) ? date('d-m-Y', strtotime($e_reply['repliedOn'])) : "-" ?>
                                                                        </td>	
                                                                        <td class="column-5 text-center">
                                                                            <?= (!empty($e_reply['letterRefNo'])) ? $e_reply['letterRefNo'] : "-" ?>
                                                                        </td>	
                                                                        <td class="column-5 text-center">
                                                                            <?= (check_valid_date($e_reply['attendedOn'])) ? date('d-m-Y', strtotime($e_reply['attendedOn'])) : "-" ?>
                                                                        </td>	
                                                                        <td class="column-5 text-center">
                                                                            <?= (!empty($e_reply['attendedBy'])) ? $e_reply['attendedBy'] : "-" ?>
                                                                        </td>	
                                                                        <td class="column-5 text-center">
                                                                            <?= (check_valid_date($e_reply['nextDate'])) ? date('d-m-Y', strtotime($e_reply['nextDate'])) : "-" ?>
                                                                        </td>
                                                                        <td class="column-1">
                                                                            <div class="btn-group">
                                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editNoticeReplyModal<?= $e_reply['scrNoticeReplyId']; ?>">
                                                                                        <i class="fa fa-pencil"></i>&nbsp;Edit Reply
                                                                                    </a>
                                                                                    <a class="dropdown-item delScrNoticeReply" href="javascript:void(0);" data-id="<?= $e_reply['scrNoticeReplyId']; ?>" data-notice_id="<?= $e_reply['fkScrNoticeId']; ?>">
                                                                                        <i class="fa fa-trash"></i>&nbsp;Delete Reply
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                            
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr class="row-1">
                                                        <td class="column-2" colspan="10">
                                                            <center>No records found :(</center>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label class="text-white">Final Outcome/Decision</label>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#editFinalOutcomeModal">
                                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-success float-right mr-2">
                                                        <i class="fa fa-pencil"></i>&nbsp;Edit
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Date of Final Order : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (check_valid_date($workDataArr['recptFinalOrderDate'])) ? date('d-m-Y', strtotime($workDataArr['recptFinalOrderDate'])) : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Date of Receipt of Order : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (check_valid_date($workDataArr['recptOrderDate'])) ? date('d-m-Y', strtotime($workDataArr['recptOrderDate'])) : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Whether Acceptable : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php 
                                                        $whetherAcceptable = "-";
                                                        if(!empty($workDataArr['isAccepted']))
                                                        {
                                                            if($workDataArr['isAccepted']==1)
                                                            {
                                                                $whetherAcceptable = "Yes";
                                                            }
                                                            elseif($workDataArr['isAccepted']==2)
                                                            {
                                                                $whetherAcceptable = "No";
                                                            }
                                                        }
                                                        
                                                        echo $whetherAcceptable;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Whether to File Rectification/Appeal : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php 
                                                        // $whetherFileAppeal = "-";
                                                        // if(!empty($workDataArr['whetherFileAppeal']))
                                                        // {
                                                        //     if($workDataArr['whetherFileAppeal']==1)
                                                        //     {
                                                        //         $whetherFileAppeal = "Yes";
                                                        //     }
                                                        //     elseif($workDataArr['whetherFileAppeal']==2)
                                                        //     {
                                                        //         $whetherFileAppeal = "No";
                                                        //     }
                                                        // }
                                                        
                                                        // echo $whetherFileAppeal;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Final Amount to be Paid : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (!empty($workDataArr['amountPaid'])) ? amount_format($workDataArr['amountPaid']) : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Date Of Payment Of Demand : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (check_valid_date($workDataArr['paymentDemandDate'])) ? date('d-m-Y', strtotime($workDataArr['paymentDemandDate'])) : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Final Amount of Refund : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (!empty($workDataArr['finalRefundAmt'])) ? amount_format($workDataArr['finalRefundAmt']) : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Date Of Receipt Of Refund : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (check_valid_date($workDataArr['refundReceiptDate'])) ? date('d-m-Y', strtotime($workDataArr['refundReceiptDate'])) : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 text-center">
                                    <input type="hidden" id="hiddenScrutinyId" value="<?= $workDataArr['scrutinyId']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    <!-- /.col -->
	</div>
</section>
<!-- /.content -->


<!-- -------------------------------------------------------------------- Edit Basic Details Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="editBasicDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('update-scrutiny-basic-details'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Baisc Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="font-weight-bold" >
                                Name of the Client : 
                            </span>
                        </div>
                        <div class="col-md-9">
                            <?= $clientNameVar; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Client Name:</label>
                                <select class="custom-select form-control" name="fkClientId" id="scrClientId" >
                                    <option value="">Select Client</option>
                                    <?php if(!empty($getClientList)): ?>
                                        <?php foreach($getClientList AS $e_clnt): ?>
                                            <?php
                                                if(in_array($e_clnt['orgType'], INDIVIDUAL_ARRAY))
                                                    $clientNameVar=$e_clnt['clientName'];
                                                else
                                                    $clientNameVar=$e_clnt['clientBussOrganisation']; 
                                            ?>
                                            <option value="<?php echo $e_clnt['clientId']; ?>" data-pan="<?= $e_clnt["clientPanNumber"]; ?>" <?= $workDataArr['fkClientId']==$e_clnt['clientId'] ? "selected" : "" ?> ><?php echo $clientNameVar; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="scrClientPan">PAN :</label>
                                <input type="text" class="form-control" name="scrClientPan" id="scrClientPan" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="finYear">A.Y :</label>
                                <select class="custom-select form-control" name="finYear" id="finYear">
                                    <option value="">Select Year</option>
                                    <?php for($d=date("Y"); $d>=2000; $d--): ?>
                                        <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                        <option value="<?php echo $dueYr; ?>" <?= $workDataArr['finYear']==$dueYr ? "selected" : "" ?> ><?php echo $dueYr; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="acknowledgmentNo">Acknowledgment :</label>
                                <input type="text" class="form-control" name="acknowledgmentNo" id="acknowledgmentNo" value="<?= $workDataArr['acknowledgmentNo'] ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php $eFillingDate = (check_valid_date($workDataArr['eFillingDate'])) ? date('Y-m-d', strtotime($workDataArr['eFillingDate'])) : "" ?>
                                <label for="eFillingDate">E-Filling Date :</label>
                                <input type="date" class="form-control" name="eFillingDate" id="eFillingDate" value="<?= $eFillingDate ?>">
                            </div>
                        </div>
                    </div>
                    <hr class="m-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="font-weight-bold" >
                                Return of Income : 
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="totalIncome">Total Income :</label>
                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="<?= $workDataArr['totalIncome'] ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="refundClaimed">Refund :</label>
                                <input type="text" class="form-control" name="refundClaimed" id="refundClaimed" value="<?= $workDataArr['refundClaimed'] ?>">
                            </div>
                        </div>
                    </div>
                    <hr class="m-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="font-weight-bold" >
                                Intimation : 
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="intiTotalIncome">Total Income :</label>
                                <input type="text" class="form-control" name="intiTotalIncome" id="intiTotalIncome" value="<?= $workDataArr['intiTotalIncome'] ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="refundTotalAmt">Refund :</label>
                                <input type="text" class="form-control" name="refundTotalAmt" id="refundTotalAmt" value="<?= $workDataArr['refundTotalAmt'] ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="demandTotalAmt">Demand :</label>
                                <input type="text" class="form-control" name="demandTotalAmt" id="demandTotalAmt" value="<?= $workDataArr['demandTotalAmt'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="scrutinyId" value="<?= $workDataArr['scrutinyId']; ?>">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- -------------------------------------------------------------------- Edit Basic Details Modal - Ends --------------------------------------------------------------------- -->


<!-- -------------------------------------------------------------------- Edit Notice Details Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="editNoticeDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('update-scrutiny-notice-details'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Notice Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="font-weight-bold" >
                                Name of the Client : 
                            </span>
                        </div>
                        <div class="col-md-9">
                            <?= $clientNameVar; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Name of the Assessing Officer : </label>
                                <input type="text" name="assessingOfficer" class="form-control" value="<?= $workDataArr['assessingOfficer']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Ward No : </label>
                                <input type="text" name="wardNo" class="form-control" value="<?= $workDataArr['wardNo']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Location : </label>
                                <input type="text" name="placeNo" class="form-control" value="<?= $workDataArr['placeNo']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Name of the Inspector : </label>
                                <input type="text" name="inspectorName" class="form-control" value="<?= $workDataArr['inspectorName']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Name of the Tax Assistant : </label>
                                <input type="text" name="taxAssistantName" class="form-control" value="<?= $workDataArr['taxAssistantName']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remark : </label>
                                <textarea name="scRemarks" class="form-control"><?= $workDataArr['scRemarks']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="scrutinyId" value="<?= $workDataArr['scrutinyId']; ?>">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- -------------------------------------------------------------------- Edit Notice Details Modal - Ends --------------------------------------------------------------------- -->


<!-- -------------------------------------------------------------------- Add Notice Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="addNoticeHearingModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('add-scrutiny-notice'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Notice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="font-weight-bold" >
                                Name of the Client : 
                            </span>
                        </div>
                        <div class="col-md-9">
                            <?= $clientNameVar; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Notice U/S : </label>
                                <select name="fkNoticeUSId" class="form-control">
                                    <option value="">Select</option>
                                    <?php if(!empty($noticeUSArr)): ?>
                                        <?php foreach($noticeUSArr AS $e_notice): ?>
                                            <option value="<?= $e_notice['noticeUnderSectionId']; ?>" ><?= $e_notice['noticeUnderSectionTitle']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Dated : </label>
                                <input type="date" name="noticeDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Due Date : </label>
                                <input type="date" name="noticeDueDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Subject : </label>
                                <input type="text" name="noticeSubject" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remark : </label>
                                <textarea name="noticeRemark" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="scrutinyId" value="<?= $workDataArr['scrutinyId']; ?>">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- -------------------------------------------------------------------- Add Notice Modal - Ends --------------------------------------------------------------------- -->


<!-- -------------------------------------------------------------------- Notice Modals - Starts --------------------------------------------------------------------- -->

<?php if(!empty($scrNoticeArr)): ?>
    <?php foreach($scrNoticeArr AS $k_noc => $e_noc): ?>
    
        <!-- -------------------------------------------------------------------- Edit Notice Modal - Starts --------------------------------------------------------------------- -->
        <!-- Modal -->
        <div id="editNoticeHearingModal<?= $e_noc['scrNoticeId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('edit-scrutiny-notice'); ?>" method="POST" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Notice</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <span class="font-weight-bold" >
                                        Name of the Client : 
                                    </span>
                                </div>
                                <div class="col-md-9">
                                    <?= $clientNameVar; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Notice U/S : </label>
                                        <select name="fkNoticeUSId" class="form-control">
                                            <option value="">Select</option>
                                            <?php if(!empty($noticeUSArr)): ?>
                                                <?php foreach($noticeUSArr AS $e_notice): ?>
                                                    <option value="<?= $e_notice['noticeUnderSectionId']; ?>" <?php if($e_notice['noticeUnderSectionId']==$e_noc['fkNoticeUSId']): ?> selected <?php endif; ?> ><?= $e_notice['noticeUnderSectionTitle']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <?php $noticeDate = (check_valid_date($e_noc['noticeDate'])) ? date('Y-m-d', strtotime($e_noc['noticeDate'])) : "" ?>
                                        <label>Dated : </label>
                                        <input type="date" name="noticeDate" class="form-control" value="<?= $noticeDate; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <?php $noticeDueDate = (check_valid_date($e_noc['noticeDueDate'])) ? date('Y-m-d', strtotime($e_noc['noticeDueDate'])) : "" ?>
                                        <label>Due Date : </label>
                                        <input type="date" name="noticeDueDate" class="form-control" value="<?= $noticeDueDate; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Subject : </label>
                                        <input type="text" name="noticeSubject" class="form-control" value="<?= $e_noc['noticeSubject']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Remark : </label>
                                        <textarea name="noticeRemark" class="form-control"><?= $e_noc['noticeRemark']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="scrutinyId" value="<?= $workDataArr['scrutinyId']; ?>">
                            <input type="hidden" name="scrNoticeId" value="<?= $e_noc['scrNoticeId']; ?>">
                            <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- -------------------------------------------------------------------- Edit Notice Modal - Ends --------------------------------------------------------------------- -->
    
        <!-- -------------------------------------------------------------------- Add Notice Reply Modal - Starts --------------------------------------------------------------------- -->
        
        <!-- Modal -->
        <div id="addNoticeReplyModal<?= $e_noc['scrNoticeId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('add-scrutiny-notice-reply'); ?>" method="POST" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Reply Notice</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <span class="font-weight-bold" >
                                        Name of the Client : 
                                    </span>
                                </div>
                                <div class="col-md-9">
                                    <?= $clientNameVar; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Letter Ref No : </label>
                                        <input type="text" name="letterRefNo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Dated : </label>
                                        <input type="date" name="datedOn" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Replied On : </label>
                                        <input type="date" name="repliedOn" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Attended By : </label>
                                        <input type="text" name="attendedBy" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Attended On : </label>
                                        <input type="date" name="attendedOn" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Next Hearing Date : </label>
                                        <input type="date" name="nextDate" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Remark : </label>
                                        <textarea name="replyRemark" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="scrutinyId" value="<?= $workDataArr['scrutinyId']; ?>">
                            <input type="hidden" name="scrNoticeId" value="<?= $e_noc['scrNoticeId']; ?>">
                            <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
        <!-- -------------------------------------------------------------------- Add Notice Reply Modal - Ends --------------------------------------------------------------------- -->
        
        
    <?php endforeach; ?>
<?php endif; ?>
<!-- -------------------------------------------------------------------- Notice Modals - Ends --------------------------------------------------------------------- -->


<!-- -------------------------------------------------------------------- Edit Notice Reply Modals - Starts --------------------------------------------------------------------- -->

<?php if(!empty($scrNoticeRplyArr)): ?>
    <?php foreach($scrNoticeRplyArr AS $eh_rpy): ?>
        
        <!-- Modal -->
        <div id="editNoticeReplyModal<?= $eh_rpy['scrNoticeReplyId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('edit-scrutiny-notice-reply'); ?>" method="POST" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Reply</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <span class="font-weight-bold" >
                                        Name of the Client : 
                                    </span>
                                </div>
                                <div class="col-md-9">
                                    <?= $clientNameVar; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Letter Ref No : </label>
                                        <input type="text" name="letterRefNo" class="form-control" value="<?= $eh_rpy['letterRefNo']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <?php $datedOn = (check_valid_date($eh_rpy['datedOn'])) ? date('Y-m-d', strtotime($eh_rpy['datedOn'])) : "" ?>
                                        <label>Dated : </label>
                                        <input type="date" name="datedOn" class="form-control" value="<?= $datedOn; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <?php $repliedOn = (check_valid_date($eh_rpy['repliedOn'])) ? date('Y-m-d', strtotime($eh_rpy['repliedOn'])) : "" ?>
                                        <label>Replied On : </label>
                                        <input type="date" name="repliedOn" class="form-control" value="<?= $repliedOn; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Attended By : </label>
                                        <input type="text" name="attendedBy" class="form-control" value="<?= $eh_rpy['attendedBy']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <?php $attendedOn = (check_valid_date($eh_rpy['attendedOn'])) ? date('Y-m-d', strtotime($eh_rpy['attendedOn'])) : "" ?>
                                        <label>Attended On : </label>
                                        <input type="date" name="attendedOn" class="form-control" value="<?= $attendedOn; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <?php $nextDate = (check_valid_date($eh_rpy['nextDate'])) ? date('Y-m-d', strtotime($eh_rpy['nextDate'])) : "" ?>
                                        <label>Next Hearing Date : </label>
                                        <input type="date" name="nextDate" class="form-control" value="<?= $nextDate; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Remark : </label>
                                        <textarea name="replyRemark" class="form-control"><?= $eh_rpy['replyRemark']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="scrutinyId" value="<?= $workDataArr['scrutinyId']; ?>">
                            <input type="hidden" name="scrNoticeId" value="<?= $eh_rpy['fkScrNoticeId']; ?>">
                            <input type="hidden" name="scrNoticeReplyId" value="<?= $eh_rpy['scrNoticeReplyId']; ?>">
                            <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
    <?php endforeach; ?>
<?php endif; ?>

<!-- -------------------------------------------------------------------- Edit Notice Reply Modals - Ends --------------------------------------------------------------------- -->



<!-- -------------------------------------------------------------------- Edit Final Outcome Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="editFinalOutcomeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('edit-scrutiny-final-outcome'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Final Outcome/Decision</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="font-weight-bold" >
                                Name of the Client : 
                            </span>
                        </div>
                        <div class="col-md-9">
                            <?= $clientNameVar; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Final Order : </label>
                                <?php $recptFinalOrderDate=(check_valid_date($workDataArr['recptFinalOrderDate'])) ? date('Y-m-d', strtotime($workDataArr['recptFinalOrderDate'])) : ""; ?>
                                <input type="date" name="recptFinalOrderDate" class="form-control" value="<?= $recptFinalOrderDate; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Receipt of Order : </label>
                                <?php $recptOrderDate=(check_valid_date($workDataArr['recptOrderDate'])) ? date('Y-m-d', strtotime($workDataArr['recptOrderDate'])) : ""; ?>
                                <input type="date" name="recptOrderDate" class="form-control" value="<?= $recptOrderDate; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Whether Order Acceptable :</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="isAccepted" id="whetherAcceptableYes" class="radio-col-success" value="1" <?php if($workDataArr['isAccepted']=="1"): ?>checked<?php endif; ?> />
                                <label for="whetherAcceptableYes">Yes</label>
                                <input type="radio" name="isAccepted" id="whetherAcceptableNo" class="radio-col-danger" value="2" <?php if($workDataArr['isAccepted']=="2"): ?>checked<?php endif; ?> />
                                <label for="whetherAcceptableNo">No</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group applRectField">
                                <label>Whether to File Rectification/Appeal :</label>
                            </div>
                            <div class="form-group applRectField">
                                <input type="checkbox" name="fileRectification" id="fileRectification" class="radio-col-success" value="1" <?php if($workDataArr['isFileRectification']=="1"): ?>checked<?php endif; ?> />
                                <label for="fileRectification">Rectification</label>
                                <input type="checkbox" name="fileAppeal" id="fileAppeal" class="radio-col-success" value="1" <?php if($workDataArr['isFileAppeal']=="1"): ?>checked<?php endif; ?> />
                                <label for="fileAppeal">Appeal</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Final Amount to be Paid : </label>
                                <input type="text" name="amountPaid" class="form-control" value="<?= $workDataArr['amountPaid']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date Of Payment Of Demand : </label>
                                <?php $paymentDemandDate=(check_valid_date($workDataArr['paymentDemandDate'])) ? date('Y-m-d', strtotime($workDataArr['paymentDemandDate'])) : ""; ?>
                                <input type="date" name="paymentDemandDate" class="form-control" value="<?= $paymentDemandDate; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Final Amount of Refund : </label>
                                <input type="text" name="finalRefundAmt" class="form-control" value="<?= $workDataArr['finalRefundAmt']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date Of Receipt Of Refund : </label>
                                <?php $refundReceiptDate=(check_valid_date($workDataArr['refundReceiptDate'])) ? date('Y-m-d', strtotime($workDataArr['refundReceiptDate'])) : ""; ?>
                                <input type="date" name="refundReceiptDate" class="form-control" value="<?= $refundReceiptDate; ?>" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remark : </label>
                                <textarea name="scFinalRemark" class="form-control" ><?= $workDataArr['scFinalRemark']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="workId" value="<?= $workDataArr['fkWorkId']; ?>">
                    <input type="hidden" name="scrutinyId" value="<?= $workDataArr['scrutinyId']; ?>">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- -------------------------------------------------------------------- Edit Final Outcome Modal - Ends --------------------------------------------------------------------- -->


<script>
    $(document).ready(function(){

        $("#scrClientId").on("change", function(){

            var selectedPan = $('#scrClientId option:selected').data('pan');
            if(selectedPan)
                $("#scrClientPan").val(selectedPan);
            else
                $("#scrClientPan").val("");
        });

        $("#scrClientId").trigger("change");

    });
</script>

<script type="text/javascript">
            
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";
        
        $('.applRectField').hide();

        $('input:radio[name="isAccepted"]').on('click', function(){
            
            var isAccepted = $(this).val();
            
            if(isAccepted==1)
            {
                $('.applRectField').hide();
            }
            else if(isAccepted==2)
            {
                $('.applRectField').show();
            }
        });
        
        $('.delScrNotice').on('click', function(e){

            e.preventDefault();

            var scrNoticeId = $(this).data('id');
            var scrutinyId = $('#hiddenScrutinyId').val();

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this notice ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/delete-scrutiny-notice',
                        type : 'POST',
                        data : {
                            'scrNoticeId':scrNoticeId,
                            'scrutinyId':scrutinyId,
                        },
                        dataType: 'text',
                        success : function(response) {
                            var refreshUrl = base_url+'/scrutiny-case/'+scrutinyId;
                            window.location.href=refreshUrl;
                        },
                        error : function(request, error)
                        {
                            console.log("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        
        $('.delScrNoticeReply').on('click', function(e){

            e.preventDefault();

            var scrNoticeReplyId = $(this).data('id');
            var scrNoticeId = $(this).data('notice_id');
            var scrutinyId = $('#hiddenScrutinyId').val();

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this reply ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/delete-scrutiny-notice-reply',
                        type : 'POST',
                        data : {
                            'scrNoticeReplyId':scrNoticeReplyId,
                            'scrNoticeId':scrNoticeId,
                            'scrutinyId':scrutinyId,
                        },
                        dataType: 'text',
                        success : function(response) {
                            var refreshUrl = base_url+'/scrutiny-case/'+scrutinyId;
                            window.location.href=refreshUrl;
                        },
                        error : function(request, error)
                        {
                            console.log("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        $('input:radio[name="isAccepted"]:checked').trigger('click');

    });

</script>

<?= $this->endSection(); ?>