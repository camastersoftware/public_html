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
</style>
<?php 
    if(in_array($rectDataArr['orgType'], INDIVIDUAL_ARRAY))
        $clientNameVar=$rectDataArr['clientName'];
    else
        $clientNameVar=$rectDataArr['clientBussOrganisation']; 
        
    $asmtYear="N/A";
    if(!empty($rectDataArr['finYear']))
    {
        $asmtYearVal=$rectDataArr['finYear'];
        
        $asmtYearArr = explode('-', $asmtYearVal);
        
        $fY=(int)$asmtYearArr[0]+1;
        $lY=(int)$asmtYearArr[1]+1;
        
        $asmtYear=$fY."-".$lY;
    }
    
    $refundTotalAmt=$rectDataArr['refundTotalAmt'];
    $demandTotalAmt=$rectDataArr['demandTotalAmt'];
    
    $rectTotalIncomeAmt=$rectDataArr['rectTotalIncomeAmt'];
    $rectRefundAmt=$rectDataArr['rectRefundAmt'];
    $rectDemandAmt=$rectDataArr['rectDemandAmt'];
    
    $actOrderTypeName = (!empty($rectDataArr['actOrderTypeName'])) ? $rectDataArr['actOrderTypeName'] : "";
    
    $otherOtherVal = (!empty($actOrderTypeName)) ? $actOrderTypeName : "Other Order";
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
                            <a href="<?= base_url('rectification'); ?>">
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
                                                <?= $rectDataArr['clientPanNumber']; ?>
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
                                                <?= (!empty($rectDataArr['acknowledgmentNo'])) ? $rectDataArr['acknowledgmentNo'] : "-"; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-3 col-lg-3 text-center">
                                            <span class="font-weight-bold">Date of Filing :&nbsp;</span>
                                            <span>
                                                <?= (check_valid_date($rectDataArr['eFillingDate'])) ? date('d-m-Y', strtotime($rectDataArr['eFillingDate'])) : "-" ?>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            <!--</div>-->
                            <!--<div class="row mt-3">-->
                                <div class="offset-lg-3 col-md-6">
                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                						<table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                            <thead>
                                                <tr class="row-1">
                                                    <th class="column-2" nowrap >Particulars (As per)</th>
                                                    <th class="column-3" nowrap >Return of Income</th>
                                                    <th class="column-4" nowrap >Intimation</th>
                                                    <th class="column-5" nowrap >
                                                        <?= $otherOtherVal; ?>
                                                        <span data-toggle="modal" data-target="#editOtherAmtModal" class="bg-warning " style="cursor:pointer;">
                                                            <code data-toggle="tooltip" data-original-title="Edit">
                                                                <i class="fa fa-pencil"></i>
                                                            </code>
                                                        </span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="row-hover">
                                                <tr class="row-1">
                                                    <td class="column-2">Total Income</td>
                                                    <td class="column-2 text-right"><?= (!empty($rectDataArr['totalIncome'])) ? amount_format($rectDataArr['totalIncome']) : 0; ?></td>
                                                    <td class="column-2 text-right"><?= (!empty($rectDataArr['intiTotalIncome'])) ? amount_format($rectDataArr['intiTotalIncome']) : 0; ?></td>
                                                    <td class="column-2 text-right"><?= (!empty($rectTotalIncomeAmt)) ? amount_format($rectTotalIncomeAmt) : 0; ?></td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-2">Refund</td>
                                                    <td class="column-2 text-right"><?= (!empty($rectDataArr['refundClaimed'])) ? amount_format($rectDataArr['refundClaimed']) : 0; ?></td>
                                                    <td class="column-2 text-right"><?= (!empty($refundTotalAmt)) ? amount_format($refundTotalAmt) : 0; ?></td>
                                                    <td class="column-2 text-right"><?= (!empty($rectRefundAmt)) ? amount_format($rectRefundAmt) : 0; ?></td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-2">Demand</td>
                                                    <td class="column-2 text-right">-</td>
                                                    <td class="column-2 text-right"><?= (!empty($demandTotalAmt)) ? amount_format($demandTotalAmt) : 0; ?></td>
                                                    <td class="column-2 text-right"><?= (!empty($rectDemandAmt)) ? amount_format($rectDemandAmt) : 0; ?></td>
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
                                                <label class="text-white">Details of Order to be Rectified</label>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#editOfficerDetailsModal">
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
                                                        Order Type : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (!empty($actOrderTypeName)) ? $actOrderTypeName : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Disputed Amount : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (!empty($rectDataArr['additionalDemandRaised'])) ? amount_format($rectDataArr['additionalDemandRaised']) : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Date Of The Order : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (check_valid_date($rectDataArr['orderDate'])) ? date('d-m-Y', strtotime($rectDataArr['orderDate'])) : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Date Of Receipt Of Order : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (check_valid_date($rectDataArr['receiptOfOrderDate'])) ? date('d-m-Y', strtotime($rectDataArr['receiptOfOrderDate'])) : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Name of the Assessing Officer : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (!empty($rectDataArr['accessingOfficerName'])) ? $rectDataArr['accessingOfficerName'] : "-" ?>
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
                                                    <?= (!empty($rectDataArr['officerWardNo'])) ? $rectDataArr['officerWardNo'] : "-" ?>
                                                    <?= (!empty($rectDataArr['officerPlace'])) ? $rectDataArr['officerPlace'] : "-" ?>
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
                                                    <?= (!empty($rectDataArr['inspectorName'])) ? $rectDataArr['inspectorName'] : "-" ?>
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
                                                    <?= (!empty($rectDataArr['taxAssistantName'])) ? $rectDataArr['taxAssistantName'] : "-" ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Date of Filing Rectn Appln : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= (check_valid_date($rectDataArr['rectificationFilingDate'])) ? date('d-m-Y', strtotime($rectDataArr['rectificationFilingDate'])) : "-" ?>
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
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#addHearingModal">
                                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-success float-right mr-2">
                                                        <i class="fa fa-plus"></i>&nbsp;Add
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
                                                            <th class="column-3" nowrap width="5%">Date Of Hearing</th>
                                                            <th class="column-4" nowrap width="5%">Attended On</th>
                                                            <th class="column-6" nowrap width="5%">Attended By</th>
                                                            <th class="column-5">Progress/Update <small>(In short)</small></th>
                                                            <th class="column-7" nowrap width="5%">Next Hearing Date</th>
                                                            <th class="column-1" nowrap width="5%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                    <?php if(!empty($rectHearingArr)): ?>
                                                        <?php foreach($rectHearingArr AS $k_hearing => $e_hearing): ?>
                                                            <tr class="row-1">
                                                                <td class="column-2 text-center"><?= ($k_hearing+1); ?></td>
                                                                <td class="column-3 text-center">
                                                                    <?= (check_valid_date($e_hearing['hearingDate'])) ? date('d-m-Y', strtotime($e_hearing['hearingDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?= (check_valid_date($e_hearing['attendedDate'])) ? date('d-m-Y', strtotime($e_hearing['attendedDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-6 text-center">
                                                                    <?= (!empty($e_hearing['attendedBy'])) ? $e_hearing['attendedBy'] : "-" ?>
                                                                </td>
                                                                <td class="column-5">
                                                                    <?php $hearingProgress=(!empty($e_hearing['hearingProgress'])) ? $e_hearing['hearingProgress'] : "-" ?>
                                                                    <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $hearingProgress; ?>">
                                                                        <?php 
                                                                            if(strlen($hearingProgress)>40)
                                                                            {
                                                                                echo substr($hearingProgress, 0, 40)."..";
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $hearingProgress;
                                                                            }
                                                                        ?>
                                                                    </a>
                                                                </td>
                                                                <td class="column-7 text-center">
                                                                    <?= (check_valid_date($e_hearing['nextHearingDate'])) ? date('d-m-Y', strtotime($e_hearing['nextHearingDate'])) : "-" ?>
                                                                </td>	
                                                                <td class="column-1">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editHearingModal<?= $e_hearing['rectificationHearingId']; ?>">
                                                                                <i class="fa fa-pencil"></i>&nbsp;Edit
                                                                            </a>
                                                                            <a class="dropdown-item delRectHearing" href="javascript:void(0);" data-id="<?= $e_hearing['rectificationHearingId']; ?>">
                                                                                <i class="fa fa-trash"></i>&nbsp;Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr class="row-1">
                                                        <td class="column-2" colspan="7">
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
                            <!--</div>-->
                            <!--<div class="row bg_prjt_format">-->
                                <div class="col-md-12 col-lg-12">
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label class="text-white">Final Outcome/Decision</label>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#editOrderDetailsModal">
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
                                                    <?= (check_valid_date($rectDataArr['dateOfFinalOrder'])) ? date('d-m-Y', strtotime($rectDataArr['dateOfFinalOrder'])) : "-" ?>
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
                                                    <?= (check_valid_date($rectDataArr['dateOfReceiptOrder'])) ? date('d-m-Y', strtotime($rectDataArr['dateOfReceiptOrder'])) : "-" ?>
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
                                                        if(!empty($rectDataArr['whetherAcceptable']))
                                                        {
                                                            if($rectDataArr['whetherAcceptable']==1)
                                                            {
                                                                $whetherAcceptable = "Yes";
                                                            }
                                                            elseif($rectDataArr['whetherAcceptable']==2)
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
                                                        Whether to File Appeal : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php 
                                                        $whetherFileAppeal = "-";
                                                        if(!empty($rectDataArr['whetherFileAppeal']))
                                                        {
                                                            if($rectDataArr['whetherFileAppeal']==1)
                                                            {
                                                                $whetherFileAppeal = "Yes";
                                                            }
                                                            elseif($rectDataArr['whetherFileAppeal']==2)
                                                            {
                                                                $whetherFileAppeal = "No";
                                                            }
                                                        }
                                                        
                                                        echo $whetherFileAppeal;
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
                                                    <?= (!empty($rectDataArr['orderAmountPaid'])) ? amount_format($rectDataArr['orderAmountPaid']) : "-" ?>
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
                                                    <?= (check_valid_date($rectDataArr['pmtOfDemandDate'])) ? date('d-m-Y', strtotime($rectDataArr['pmtOfDemandDate'])) : "-" ?>
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
                                                    <?= (!empty($rectDataArr['finalAmtOfRefund'])) ? amount_format($rectDataArr['finalAmtOfRefund']) : "-" ?>
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
                                                    <?= (check_valid_date($rectDataArr['dateOfReceiptOfRefund'])) ? date('d-m-Y', strtotime($rectDataArr['dateOfReceiptOfRefund'])) : "-" ?>
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
                                    <input type="hidden" id="hiddenRectificationId" value="<?= $rectDataArr['rectificationId']; ?>">
                                    <input type="hidden" id="hiddenWorkId" value="<?= $rectDataArr['workId']; ?>">
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


<!-- -------------------------------------------------------------------- Edit Other Amount Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="editOtherAmtModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="<?= base_url('update-rectification-other-amount'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $otherOtherVal; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Order Type : </label>
                                <select name="orderType" class="form-control">
                                    <option value="">Select</option>
                                    <?php if(!empty($orderTypeArr)): ?>
                                        <?php foreach($orderTypeArr AS $e_notice): ?>
                                            <option value="<?= $e_notice['actOrderTypeId']; ?>" <?php if($rectDataArr['orderType']==$e_notice['actOrderTypeId']): ?> selected <?php endif; ?> ><?= $e_notice['actOrderTypeName']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Total Income : </label>
                                <input type="text" name="rectTotalIncomeAmt" class="form-control" value="<?= $rectTotalIncomeAmt; ?>" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Refund : </label>
                                <input type="text" name="rectRefundAmt" class="form-control" value="<?= $rectRefundAmt; ?>" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Demand : </label>
                                <input type="text" name="rectDemandAmt" class="form-control" value="<?= $rectDemandAmt; ?>" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="workId" value="<?= $rectDataArr['workId']; ?>">
                    <input type="hidden" name="rectificationId" value="<?= $rectDataArr['rectificationId']; ?>">
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
<!-- -------------------------------------------------------------------- Edit Other Amount Modal - Ends --------------------------------------------------------------------- -->



<!-- -------------------------------------------------------------------- Edit Officer Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="editOfficerDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('update-rectification-officer-details'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Details of Order to be Rectified</h4>
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
                                <label>Order Type : </label>
                                <select name="orderType" class="form-control">
                                    <option value="">Select</option>
                                    <?php if(!empty($orderTypeArr)): ?>
                                        <?php foreach($orderTypeArr AS $e_notice): ?>
                                            <option value="<?= $e_notice['actOrderTypeId']; ?>" <?php if($rectDataArr['orderType']==$e_notice['actOrderTypeId']): ?> selected <?php endif; ?> ><?= $e_notice['actOrderTypeName']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Disputed Amount : </label>
                                <input type="text" name="additionalDemandRaised" class="form-control" value="<?= $rectDataArr['additionalDemandRaised']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date Of The Order : </label>
                                <?php $orderDate=(check_valid_date($rectDataArr['orderDate'])) ? date('Y-m-d', strtotime($rectDataArr['orderDate'])) : ""; ?>
                                <input type="date" name="orderDate" class="form-control" value="<?= $orderDate; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date Of Receipt Of Order : </label>
                                <?php $receiptOfOrderDate=(check_valid_date($rectDataArr['receiptOfOrderDate'])) ? date('Y-m-d', strtotime($rectDataArr['receiptOfOrderDate'])) : ""; ?>
                                <input type="date" name="receiptOfOrderDate" class="form-control" value="<?= $receiptOfOrderDate; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Name of the Assessing Officer : </label>
                                <input type="text" name="accessingOfficerName" class="form-control" value="<?= $rectDataArr['accessingOfficerName']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Ward No : </label>
                                <input type="text" name="officerWardNo" class="form-control" value="<?= $rectDataArr['officerWardNo']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Location : </label>
                                <input type="text" name="officerPlace" class="form-control" value="<?= $rectDataArr['officerPlace']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Name of the Inspector : </label>
                                <input type="text" name="inspectorName" class="form-control" value="<?= $rectDataArr['inspectorName']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Name of the Tax Assistant : </label>
                                <input type="text" name="taxAssistantName" class="form-control" value="<?= $rectDataArr['taxAssistantName']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Filing Rectification Application : </label>
                                <?php $rectificationFilingDate=(check_valid_date($rectDataArr['rectificationFilingDate'])) ? date('Y-m-d', strtotime($rectDataArr['rectificationFilingDate'])) : ""; ?>
                                <input type="date" name="rectificationFilingDate" class="form-control" value="<?= $rectificationFilingDate; ?>" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remark : </label>
                                <?php
                                    $officerRemark = $rectDataArr['officerRemark'];
                                    
                                    $officerRemarkVal = (!empty($officerRemark)) ? htmlspecialchars_decode(html_entity_decode($officerRemark)) : "";
                                ?>
                                <textarea name="officerRemark" class="form-control textarea"><?= $officerRemarkVal; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="workId" value="<?= $rectDataArr['workId']; ?>">
                    <input type="hidden" name="rectificationId" value="<?= $rectDataArr['rectificationId']; ?>">
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
<!-- -------------------------------------------------------------------- Edit Officer Modal - Ends --------------------------------------------------------------------- -->




<!-- -------------------------------------------------------------------- Edit Order Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="editOrderDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('update-rectification-order-details'); ?>" method="POST" >
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
                                <?php $dateOfFinalOrder=(check_valid_date($rectDataArr['dateOfFinalOrder'])) ? date('Y-m-d', strtotime($rectDataArr['dateOfFinalOrder'])) : ""; ?>
                                <input type="date" name="dateOfFinalOrder" class="form-control" value="<?= $dateOfFinalOrder; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Receipt of Order : </label>
                                <?php $dateOfReceiptOrder=(check_valid_date($rectDataArr['dateOfReceiptOrder'])) ? date('Y-m-d', strtotime($rectDataArr['dateOfReceiptOrder'])) : ""; ?>
                                <input type="date" name="dateOfReceiptOrder" class="form-control" value="<?= $dateOfReceiptOrder; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Whether Order Acceptable :</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="whetherAcceptable" id="whetherAcceptableYes" class="radio-col-success" value="1" <?php if($rectDataArr['whetherAcceptable']=="1"): ?>checked<?php endif; ?> />
                                <label for="whetherAcceptableYes">Yes</label>
                                <input type="radio" name="whetherAcceptable" id="whetherAcceptableNo" class="radio-col-danger" value="2" <?php if($rectDataArr['whetherAcceptable']=="2"): ?>checked<?php endif; ?> />
                                <label for="whetherAcceptableNo">No</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Whether to File Appeal :</label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="whetherFileAppeal" id="whetherFileAppealYes" class="radio-col-success" value="1" <?php if($rectDataArr['whetherFileAppeal']=="1"): ?>checked<?php endif; ?> />
                                <label for="whetherFileAppealYes">Yes</label>
                                <input type="radio" name="whetherFileAppeal" id="whetherFileAppealNo" class="radio-col-danger" value="2" <?php if($rectDataArr['whetherFileAppeal']=="2"): ?>checked<?php endif; ?> />
                                <label for="whetherFileAppealNo">No</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Final Amount to be Paid : </label>
                                <input type="text" name="orderAmountPaid" class="form-control" value="<?= $rectDataArr['orderAmountPaid']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date Of Payment Of Demand : </label>
                                <?php $pmtOfDemandDate=(check_valid_date($rectDataArr['pmtOfDemandDate'])) ? date('Y-m-d', strtotime($rectDataArr['pmtOfDemandDate'])) : ""; ?>
                                <input type="date" name="pmtOfDemandDate" class="form-control" value="<?= $pmtOfDemandDate; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Final Amount of Refund : </label>
                                <input type="text" name="finalAmtOfRefund" class="form-control" value="<?= $rectDataArr['finalAmtOfRefund']; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date Of Receipt Of Refund : </label>
                                <?php $dateOfReceiptOfRefund=(check_valid_date($rectDataArr['dateOfReceiptOfRefund'])) ? date('Y-m-d', strtotime($rectDataArr['dateOfReceiptOfRefund'])) : ""; ?>
                                <input type="date" name="dateOfReceiptOfRefund" class="form-control" value="<?= $dateOfReceiptOfRefund; ?>" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remark : </label>
                                <?php
                                    $orderRemark = $rectDataArr['orderRemark'];
                                    
                                    $orderRemarkVal = (!empty($orderRemark)) ? htmlspecialchars_decode(html_entity_decode($orderRemark)) : "";
                                ?>
                                <textarea name="orderRemark" class="form-control textarea" rows="80"><?= $orderRemarkVal; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="workId" value="<?= $rectDataArr['workId']; ?>">
                    <input type="hidden" name="rectificationId" value="<?= $rectDataArr['rectificationId']; ?>">
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
<!-- -------------------------------------------------------------------- Edit Order Modal - Ends --------------------------------------------------------------------- -->



<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- --------------------------------------------------------------------  Hearing Modals - Starts --------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->



<!-- -------------------------------------------------------------------- Add Hearing Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="addHearingModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('add-rectification-hearing-details'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Hearing Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <span class="font-weight-bold" >
                                Name of the Client : 
                            </span>
                        </div>
                        <div class="col-md-8">
                            <?= $clientNameVar; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Hearing Date : </label>
                                <input type="date" class="form-control" name="hearingDate" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Attended Date : </label>
                                <input type="date" class="form-control" name="attendedDate" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group ">
                                <label>Progress/Update <small>(In short)</small> : </label>
                                <input type="text" class="form-control" name="hearingProgress" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group ">
                                <label>Details of Proceeding/Submission : </label>
                                <textarea class="form-control" name="proceedingDetails"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group ">
                                <label>Attended By : </label>
                                <input type="text" class="form-control" name="attendedBy" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Next Hearing Date : </label>
                                <input type="date" class="form-control" name="nextHearingDate" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group ">
                                <label>Remark: </label>
                                <textarea class="form-control" name="hearingRemark"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="workId" value="<?= $rectDataArr['workId']; ?>">
                    <input type="hidden" name="rectificationId" value="<?= $rectDataArr['rectificationId']; ?>">
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
<!-- -------------------------------------------------------------------- Add Hearing Details - Ends --------------------------------------------------------------------- -->



<!-- -------------------------------------------------------------------- Edit Hearing Modal - Starts --------------------------------------------------------------------- -->

<?php if(!empty($rectHearingArr)): ?>
    <?php foreach($rectHearingArr AS $k_hearing => $e_hearing): ?>
    
        <!-- Modal -->
        <div id="editHearingModal<?= $e_hearing['rectificationHearingId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('edit-rectification-hearing-details'); ?>" method="POST" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Hearing Details</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span class="font-weight-bold" >
                                        Name of the Client : 
                                    </span>
                                </div>
                                <div class="col-md-8">
                                    <?= $clientNameVar; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Hearing Date : </label>
                                        <?php $hearingDate = (check_valid_date($e_hearing['hearingDate'])) ? date('Y-m-d', strtotime($e_hearing['hearingDate'])) : "" ?>
                                        <input type="date" class="form-control" name="hearingDate" value="<?= $hearingDate; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Attended Date : </label>
                                        <?php $attendedDate = (check_valid_date($e_hearing['attendedDate'])) ? date('Y-m-d', strtotime($e_hearing['attendedDate'])) : "" ?>
                                        <input type="date" class="form-control" name="attendedDate" value="<?= $attendedDate; ?>"  >
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group ">
                                        <label>Progress/Update <small>(In short)</small> : </label>
                                        <input type="text" class="form-control" name="hearingProgress" value="<?= $e_hearing['hearingProgress']; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group ">
                                        <label>Details of Proceeding/Submission : </label>
                                        <textarea class="form-control" name="proceedingDetails"><?= $e_hearing['proceedingDetails']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group ">
                                        <label>Attended By : </label>
                                        <input type="text" class="form-control" name="attendedBy" value="<?= $e_hearing['attendedBy']; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Next Hearing Date : </label>
                                        <?php $nextHearingDate = (check_valid_date($e_hearing['nextHearingDate'])) ? date('Y-m-d', strtotime($e_hearing['nextHearingDate'])) : "" ?>
                                        <input type="date" class="form-control" name="nextHearingDate" value="<?= $nextHearingDate; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group ">
                                        <label>Remark: </label>
                                        <textarea class="form-control" name="hearingRemark"><?= $e_hearing['hearingRemark']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="workId" value="<?= $rectDataArr['workId']; ?>">
                            <input type="hidden" name="rectificationId" value="<?= $rectDataArr['rectificationId']; ?>">
                            <input type="hidden" name="rectificationHearingId" value="<?= $e_hearing['rectificationHearingId']; ?>">
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
<!-- -------------------------------------------------------------------- Edit Hearing Details - Ends --------------------------------------------------------------------- -->


<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- --------------------------------------------------------------------  Hearing Modals - Ends --------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


<script type="text/javascript">
            
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";

        $('.delRectHearing').on('click', function(e){

            e.preventDefault();

            var rectificationHearingId = $(this).data('id');
            var rectificationId = $('#hiddenRectificationId').val();
            var workId = $('#hiddenWorkId').val();

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this hearing ?",
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
                        url : base_url+'/delete-rectification-hearing-details',
                        type : 'POST',
                        data : {
                            'rectificationHearingId':rectificationHearingId,
                            'rectificationId':rectificationId,
                            'workId':workId,
                        },
                        dataType: 'text',
                        success : function(response) {
                            var refreshUrl = base_url+'/rectification-details/'+rectificationId;
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

    });

</script>


<?= $this->endSection(); ?>