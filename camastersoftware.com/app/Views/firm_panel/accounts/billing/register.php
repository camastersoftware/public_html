<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
    .modal-header {
        border-bottom-color: #d5dfea;
        background-color:#F99D27;
        padding: 8px 8px;
    }

    .income-tax-head {
        background: #ffc800;
        padding:10px;
        margin-bottom:0px;
        font-weight:bold;
    }

    table.dataTable {
        margin-top: 0px !important; 
    }

    .tablepress td, .tablepress th {
        font-weight: 600;
    }

    td.column-1 {
        font-size:14px;
    }

    .modal-header h4{
        text-align: center;
    }

    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
    }
    
    .getActModal .box{
        cursor: pointer !important;
    }
    
    .table-responsive table thead tr{
        background: #005495 !important;
        color: #fff !important;
    }
    
    .table-responsive table tbody tr{
        background: #96c7f242 !important;
    }
    
    .table-responsive tr th{
        border: 1px solid #fff !important;
    }
    
    .table-responsive tr td{
        border: 1px solid #015aacab !important;
    }
    
    table.dataTable {
        border-collapse: collapse !important;
        font-size: 16px !important;
    }
    
    .table > tbody > tr > td, .table > tbody > tr > th {
        padding: 8px !important;
    }
    
    .btnPrimClr {
        margin-top: 5px !important;
        height: 30px !important;
        margin-bottom: 5px !important;
    }
    
    .box_body_bg {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        /*border-radius: 10px;*/
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        /*margin-top: 20px !important;*/
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
    
    .tablepress td {
        font-weight: 400 !important;
    }
    
    .tablepress thead th {
        background-color: #005495 !important;
    }
    
    .demo-checkbox .box-header {
        background-color: #005495 !important;
        border-radius: 10px !important;
    }
    
    .demo-checkbox .box-header.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
    }
    
    .dataTables_wrapper .form-control{
        margin: 0px !important;
    }
    
    .discontinueClass td {
      color: #9d9c97 !important;
    }
    
    .todayAttend{
        background: #11589742 !important;
    }

    .theme-primary .btnPrimClr {
        margin-top: 0px !important;
        height: 30px !important;
        margin-bottom: 0px !important;
    }

    .due-month {
        background: #F99D27;
        padding: 7px 0;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }
    
</style>

<?php $currentDate = date('Y-m-d'); ?>
<?php $currentTime = date('h:i A'); ?>

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold">
                                <?= $pageTitle; ?>
                            </h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url('accountFinance'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">SN</th>
                                            <th width="5%">Date</th>
                                            <th width="5%">Bill&nbsp;No</th>
                                            <th width="5%">Name&nbsp;of&nbsp;the&nbsp;Party</th>
                                            <th width="5%">Particulars</th>
                                            <th width="5%">Period</th>
                                            <th width="5%">Fees</th>
                                            <th width="5%">GST</th>
                                            <th width="5%">Total</th>
                                            <th width="5%">Receipt</th>
                                            <th width="5%">Balance</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        <?php if(!empty($billDataArr)): ?>
                                            <?php foreach($billDataArr AS $k_row => $e_row): ?>
                                                <?php 
                                                    $billId = $e_row['billId'];

                                                    $cliOrgNameVar = (!empty($e_row['clientBussOrganisation'])) ? $e_row['clientBussOrganisation'] : "";
                                                    $clientNameVal = display_client_name($e_row['orgType'], $e_row['clientName'], $cliOrgNameVar, false, 11);
                                                    $clientNameModal = display_client_name($e_row['orgType'], $e_row['clientName'], $cliOrgNameVar, true);

                                                    $act_name = "";
                                                    if(!empty($e_row['act_name']))
                                                        $act_name = $e_row['act_name'];

                                                    if(check_valid_date($e_row['billDate']))
                                                        $billDate=date('d-m-Y', strtotime($e_row['billDate']));
                                                    else 
                                                        $billDate="";

                                                    $billNo = "";
                                                    if(!empty($e_row['billNo']))
                                                        $billNo =  $e_row['billNo'];

                                                    $totalAmt = 0;
                                                    if(!empty($e_row['totalAmt']))
                                                        $totalAmt = (float)$e_row['totalAmt'];

                                                    $gstAmt = 0;
                                                    if($e_row['taxType']==1){
                                                        if(!empty($e_row['cgstAmt']))
                                                            $cgstAmt = (float)$e_row['cgstAmt'];
                                                        else 
                                                            $cgstAmt = 0;

                                                        if(!empty($e_row['sgstAmt']))
                                                            $sgstAmt = (float)$e_row['sgstAmt'];
                                                        else 
                                                            $sgstAmt = 0;
                                                        
                                                        $gstAmt = $cgstAmt + $sgstAmt;
                                                    }elseif($e_row['taxType']==2){
                                                        if(!empty($e_row['igstAmt']))
                                                            $igstAmt = (float)$e_row['igstAmt'];
                                                        else 
                                                            $igstAmt = 0;

                                                        $gstAmt = $igstAmt;
                                                    }

                                                    $totalBillAmt = 0;
                                                    if(!empty($e_row['totalBillAmt']))
                                                        $totalBillAmt = (float)$e_row['totalBillAmt'];

                                                    $billReceiptsArray = array();
                                                    if(!empty($billReceiptsArr[$billId])){
                                                        $billReceiptsArray = $billReceiptsArr[$billId];
                                                    }

                                                    $receiptSumAmt = 0;
                                                    $receiptSumGst = 0;
                                                    $receiptSumTotal = 0;

                                                    if(!empty($billReceiptsArray)){
                                                        $receiptSumAmt = array_sum(array_column($billReceiptsArray, "receiptAmt"));
                                                    }
                                                    
                                                    if(!empty($billReceiptsArray)){
                                                        $receiptSumGst = array_sum(array_column($billReceiptsArray, "receiptGst"));
                                                    }
                                                    
                                                    if(!empty($billReceiptsArray)){
                                                        $receiptSumTotal = array_sum(array_column($billReceiptsArray, "receiptTotal"));
                                                    }

                                                    $balanceAmt = $totalAmt - $receiptSumAmt;
                                                    $balanceGstAmt = $gstAmt - $receiptSumGst;
                                                    $balanceTotalAmt = $totalBillAmt - $receiptSumTotal;

                                                    $rowClr = "";
                                                    if($receiptSumTotal > $totalBillAmt){
                                                        $rowClr = "overPmt";
                                                    }

                                                    if($receiptSumTotal == $totalBillAmt){
                                                        $rowClr = "fullRecvd";
                                                    }

                                                    if($receiptSumTotal > 0 && $receiptSumTotal < $totalBillAmt){
                                                        $rowClr = "partialRecvd";
                                                    }
                                                ?>
                                                <tr class="<?= $rowClr; ?>">
                                                    <td class="text-center" width="5%"><?php echo $i; ?></td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?= (!empty($billDate)) ? $billDate : "-"; ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?= (!empty($billNo)) ? $billNo : "-"; ?>
                                                    </td>
                                                    <td class="text-left" width="5%" nowrap>
                                                        <?= $clientNameVal; ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?= (!empty($act_name)) ? $act_name : "-"; ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php
                                                            $DDPeriod = "-";
                                                            $periodicity=$e_row['periodicity'];

                                                            if(!empty($periodicity))
                                                            {
                                                                if($periodicity==1)
                                                                {
                                                                    $DDPeriod = date("d-M-Y", strtotime($e_row["daily_date"]));
                                                                }
                                                                elseif($periodicity==2)
                                                                {
                                                                    $DDPeriod = date("M", strtotime("2021-".$e_row["period_month"]."-01"))."-".$e_row["period_year"];
                                                                }
                                                                elseif($periodicity>=3)
                                                                {
                                                                    $DDPeriod = date("M", strtotime("2021-".$e_row["f_period_month"]."-01"))."-".$e_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_row["t_period_month"]."-01"))."-".$e_row["t_period_year"];
                                                                }
                                                            }

                                                            echo $DDPeriod;
                                                        ?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?= amount_format($totalAmt); ?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?= amount_format($gstAmt);?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?= amount_format($totalBillAmt); ?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?= amount_format($receiptSumTotal); ?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?= amount_format($balanceTotalAmt); ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                <a class="dropdown-item" href="<?= base_url('create-receipt/'.$billId); ?>" target="_blank">Create Receipt</a>
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#viewReceipts<?= $billId; ?>">View Receipts</a>
                                                            </div>
                                                        </div>

                                                        <div id="viewReceipts<?= $billId; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title font-weight-bold" id="myModalLabel">Receipts of <?= $clientNameModal; ?></h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                                                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                                                <thead>
                                                                                    <tr class="row-1">
                                                                                        <th class="column-2" nowrap width="5%">SN</th>
                                                                                        <th class="column-3" nowrap width="5%">Date</th>
                                                                                        <th class="column-4" nowrap width="5%">No</th>
                                                                                        <th class="column-4" nowrap width="5%">Mode</th>
                                                                                        <th class="column-4" nowrap width="5%">Amount</th>
                                                                                        <th class="column-4" nowrap width="5%">GST</th>
                                                                                        <th class="column-4" nowrap width="5%">Total</th>
                                                                                        <th class="column-6" nowrap width="5%">TDS</th>
                                                                                        <th class="column-7" nowrap width="5%">Net</th>
                                                                                        <th class="column-1" nowrap width="5%">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="row-hover">
                                                                                    <?php $sumReceiptAmt = $sumReceiptGst = $sumReceiptTotal = $sumReceiptTds = $sumReceiptNet = 0; ?>
                                                                                    <tr class="row-1">
                                                                                        <td class="column-2 text-center p-0" colspan="10">
                                                                                            <div class="state due-month">
                                                                                                <h4 class="font-weight-bold m-0">Bill Details</h4>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr class="row-1">
                                                                                        <td class="column-2 text-center"></td>
                                                                                        <td class="column-3 text-center" nowrap>
                                                                                            <?= $billDate ?>
                                                                                        </td>
                                                                                        <td class="column-4 text-center" nowrap>
                                                                                            <?= (!empty($billNo)) ? $billNo : "-"; ?>
                                                                                        </td>
                                                                                        <td class="column-4 text-center" nowrap></td>
                                                                                        <td class="column-5 text-right">
                                                                                            <?= amount_format($totalAmt);?>
                                                                                        </td>	
                                                                                        <td class="column-5 text-right">
                                                                                            <?= amount_format($gstAmt);?>
                                                                                        </td>	
                                                                                        <td class="column-5 text-right">
                                                                                            <?= amount_format($totalBillAmt); ?>
                                                                                        </td>
                                                                                        <td class="column-1" colspan=3></td>
                                                                                    </tr>
                                                                                    <tr class="row-1">
                                                                                        <td class="column-2 text-center p-0" colspan="10">
                                                                                            <div class="state due-month">
                                                                                                <h4 class="font-weight-bold m-0">Receipt Details</h4>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php if(!empty($billReceiptsArray)): ?>
                                                                                        <?php foreach($billReceiptsArray AS $k_rcpt => $e_rcpt): ?>
                                                                                            <?php $receiptId = $e_rcpt['receiptId']; ?>
                                                                                            <?php
                                                                                                $receiptAmt = 0;
                                                                                                if(!empty($e_rcpt['receiptAmt']))
                                                                                                    $receiptAmt = $e_rcpt['receiptAmt'];
                                                                                                
                                                                                                $receiptGst = 0;
                                                                                                    if(!empty($e_rcpt['receiptGst']))
                                                                                                        $receiptGst = $e_rcpt['receiptGst'];
                                                                                                
                                                                                                $receiptTotal = 0;
                                                                                                    if(!empty($e_rcpt['receiptTotal']))
                                                                                                        $receiptTotal = $e_rcpt['receiptTotal'];
                                                                                                
                                                                                                $receiptTds = 0;
                                                                                                    if(!empty($e_rcpt['receiptTds']))
                                                                                                        $receiptTds = $e_rcpt['receiptTds'];
                                                                                                
                                                                                                $receiptNet = 0;
                                                                                                    if(!empty($e_rcpt['receiptNet']))
                                                                                                        $receiptNet = $e_rcpt['receiptNet'];

                                                                                                $sumReceiptAmt += $receiptAmt;
                                                                                                $sumReceiptGst += $receiptGst;
                                                                                                $sumReceiptTotal += $receiptTotal;
                                                                                                $sumReceiptTds += $receiptTds;
                                                                                                $sumReceiptNet += $receiptNet;
                                                                                            ?>
                                                                                            <tr class="row-1">
                                                                                                <td class="column-2 text-center"><?= ($k_rcpt+1); ?></td>
                                                                                                <td class="column-3 text-center" nowrap>
                                                                                                    <?= (check_valid_date($e_rcpt['receiptDate'])) ? date('d-m-Y', strtotime($e_rcpt['receiptDate'])) : "-" ?>
                                                                                                </td>
                                                                                                <td class="column-4 text-center" nowrap>
                                                                                                    <?= (!empty($e_rcpt['receiptNo'])) ? $e_rcpt['receiptNo'] : "-" ?>
                                                                                                </td>
                                                                                                <td class="column-4 text-center" nowrap>
                                                                                                    <?= (!empty($e_rcpt['rcptPmtMode'])) ? $e_rcpt['rcptPmtMode'] : "-" ?>
                                                                                                </td>
                                                                                                <td class="column-5 text-right">
                                                                                                    <?= amount_format($receiptAmt); ?>
                                                                                                </td>	
                                                                                                <td class="column-5 text-right">
                                                                                                    <?= amount_format($receiptGst); ?>
                                                                                                </td>	
                                                                                                <td class="column-5 text-right">
                                                                                                    <?= amount_format($receiptTotal); ?>
                                                                                                </td>	
                                                                                                <td class="column-5 text-right">
                                                                                                    <?= amount_format($receiptTds); ?>
                                                                                                </td>	
                                                                                                <td class="column-5 text-right">
                                                                                                    <?= amount_format($receiptNet); ?>
                                                                                                </td>
                                                                                                <td class="column-1">
                                                                                                    <div class="btn-group">
                                                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                                                            <a class="dropdown-item" href="<?= base_url('edit-receipt/'.$receiptId); ?>" target="_blank" >
                                                                                                                Edit Receipt
                                                                                                            </a>
                                                                                                            <a class="dropdown-item" href="<?= base_url('view-receipt-pdf/'.$receiptId); ?>" target="_blank" >
                                                                                                                View Receipt
                                                                                                            </a>
                                                                                                            <a class="dropdown-item delReceipt" href="javascript:void(0);" data-id="<?= $receiptId; ?>">
                                                                                                                Delete Receipt
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php endforeach; ?>
                                                                                            <tr class="row-1">
                                                                                                <td class="column-2 text-right" colspan="4">
                                                                                                    <b>Total</b>
                                                                                                </td>
                                                                                                <td class="column-5 text-right">
                                                                                                    <b><?= amount_format($sumReceiptAmt); ?></b>
                                                                                                </td>	
                                                                                                <td class="column-5 text-right">
                                                                                                    <b><?= amount_format($sumReceiptGst); ?></b>
                                                                                                </td>	
                                                                                                <td class="column-5 text-right">
                                                                                                    <b><?= amount_format($sumReceiptTotal); ?></b>
                                                                                                </td>	
                                                                                                <td class="column-5 text-right">
                                                                                                    <b><?= amount_format($sumReceiptTds); ?></b>
                                                                                                </td>	
                                                                                                <td class="column-5 text-right">
                                                                                                    <b><?= amount_format($sumReceiptNet); ?></b>
                                                                                                </td>
                                                                                                <td class="column-1"></td>
                                                                                            </tr>
                                                                                    <?php else: ?>
                                                                                        <tr class="row-1">
                                                                                            <td class="column-2" colspan="10">
                                                                                                <center>No records found :(</center>
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php endif; ?>
                                                                                    <tr class="row-1">
                                                                                        <td class="column-2 text-right" colspan="4">
                                                                                            <b>Balance</b>
                                                                                        </td>
                                                                                        <td class="column-3 text-right" nowrap>
                                                                                            <b><?= amount_format($balanceAmt); ?></b>
                                                                                        </td>
                                                                                        <td class="column-3 text-right" nowrap>
                                                                                            <b><?= amount_format($balanceGstAmt); ?></b>
                                                                                        </td>
                                                                                        <td class="column-3 text-right" nowrap>
                                                                                            <b><?= amount_format($balanceTotalAmt); ?></b>
                                                                                        </td>
                                                                                        <td class="column-1" colspan=3></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <!-- <div class="row form-group">
                                                                                <div class="offset-md-9 offset-lg-9"></div>
                                                                                <div class="col-md-3 col-lg-3 text-right">
                                                                                    <span class="font-weight-bold">Balance :&nbsp;</span>
                                                                                    <span><?//= amount_format($balanceAmount); ?></span>
                                                                                </div>
                                                                            </div> -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer text-right" style="width: 100%;">
                                                                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    $(document).ready(function() {

        $('.delReceipt').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var receiptId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/delete-receipt';
                    $.post(postingUrl, 
                    {
                        receiptId: receiptId,
                    },
                    function(data, status){
                        window.location.reload();
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });  

    });

</script>

<?= $this->endSection(); ?>