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

    .tablepress tbody tr:first-child td {
        background: #ffffff;
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
        padding: 0px 14px !important;
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
    
</style>

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?= $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url("bill-register"); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body card_bg_format">
                    <form action="<?= base_url('generate-receipt'); ?>" method="post">
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12">
                                        <div class="row form-group mb-2">
                                            <div class="col-md-12 col-lg-12 text-center">
                                                <h3 class="font-weight-bold m-0" >
                                                    <?= $workClientName; ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row form-group mb-2">
                                            <div class="col-md-12 col-lg-12 text-center">
                                                <h4 class="font-weight-bold m-0" >
                                                    <?= (!empty($DDFName)) ? $DDFName : "N/A"; ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 text-left">
                                        <span class="font-weight-bold">Bill No :&nbsp;</span>
                                        <span class="font-weight-bold">
                                            <?= $billNoVal; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-lg-4 text-center">
                                        <span class="font-weight-bold">Bill Date :&nbsp;</span>
                                        <span class="font-weight-bold">
                                            <?= $billDateVal; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-lg-4 text-right">
                                        <span class="font-weight-bold">Period :&nbsp;</span>
                                        <span class="font-weight-bold">
                                            <?= $billPeriod; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-4 col-lg-4 text-left">
                                        <span class="font-weight-bold spanHeader">Fees :&nbsp;</span>
                                        <span class="font-weight-bold spanHeader">
                                            <?= $billAmtVal; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-lg-4 text-center">
                                        <span class="font-weight-bold spanHeader">GST :&nbsp;</span>
                                        <span class="font-weight-bold spanHeader">
                                            <?= $billGstVal; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-lg-4 text-right">
                                        <span class="font-weight-bold spanHeader">Total Bill Amount :&nbsp;</span>
                                        <span class="font-weight-bold spanHeader">
                                            <?= $billTotalAmtVal; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Receipt No<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="receiptNo" id="receiptNo" placeholder="Enter Receipt No" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Receipt Date<small class="text-danger">*</small></label>
                                            <input type="date" class="form-control" name="receiptDate" id="receiptDate" placeholder="Enter Receipt Date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Payment Mode<small class="text-danger">*</small></label>
                                            <select class="custom-select form-control" name="receiptMode" id="receiptMode" >
                                                <option value="">Select</option>
                                                <?php if(!empty($pmtModes)): ?>
                                                    <?php foreach($pmtModes AS $e_mode): ?>
                                                        <option value="<?php echo $e_mode['id']; ?>"><?php echo $e_mode['name']; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 chequeElem">
                                        <div class="form-group">
                                            <label>Cheque No<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="receiptChequeNo" id="receiptChequeNo" placeholder="Enter Cheque No" >
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 chequeElem">
                                        <div class="form-group">
                                            <label>Cheque Dated<small class="text-danger">*</small></label>
                                            <input type="date" class="form-control" name="receiptDated" id="receiptDated" placeholder="Enter Receipt Date" >
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 chequeElem">
                                        <div class="form-group">
                                            <label>Cheque Drawn On<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="receiptDrawnOn" id="receiptDrawnOn" placeholder="Enter Drawn On" >
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Amount<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control calReceiptAmt" name="receiptAmt" id="receiptAmt" placeholder="Enter Receipt Amount" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>GST</label>
                                            <input type="text" class="form-control calReceiptAmt" name="receiptGst" id="receiptGst" placeholder="Enter GST Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Total <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="receiptTotal" id="receiptTotal" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>TDS</label>
                                            <input type="text" class="form-control calReceiptAmt" name="receiptTds" id="receiptTds" placeholder="Enter TDS Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Net <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="receiptNet" id="receiptNet" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Deposited To Account</label>
                                            <input type="text" class="form-control" name="receiptDepositedToAcc" id="receiptDepositedToAcc">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Remark</label>
                                            <textarea class="form-control textarea" name="receiptRemarks" placeholder="Enter Remark" rows="8"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-0 text-center">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name='billId' value="<?= $billId; ?>" />
                                            <input type="hidden" name='clientId' value="<?= $clientId; ?>" />
                                            <button type="submit" name="submit" class="waves-effect waves-light btn btn-sm btn-submit">Submit</button>
                                            <a href="<?php echo base_url("bill-register"); ?>">
                                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
            
    $(document).ready(function(){
        
        $('body').on('change', '#receiptMode', function(){
            var receiptMode = $(this).val();

            if(receiptMode==4){
                $(".chequeElem").show();
                $(".chequeElem input").prop("required", true);
            }else{
                $(".chequeElem").hide();
                $(".chequeElem input").prop("required", false);
            }
        });

        $('body').on('keyup', '.calReceiptAmt', function(){
            
            var receiptAmt = ($('#receiptAmt').val()!="") ? parseFloat($('#receiptAmt').val()) : 0;
            var receiptGst = ($('#receiptGst').val()!="") ? parseFloat($('#receiptGst').val()) : 0;
            var receiptTds = ($('#receiptTds').val()!="") ? parseFloat($('#receiptTds').val()) : 0;

            var receiptTotal = receiptAmt+receiptGst;
            var receiptNet = receiptTotal-receiptTds;
            
            $('#receiptTotal').val(receiptTotal);
            $('#receiptNet').val(receiptNet);
        });

        $(".chequeElem").hide();
    });

</script>

<?= $this->endSection(); ?>