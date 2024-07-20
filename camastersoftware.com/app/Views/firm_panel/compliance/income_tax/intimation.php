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
        font-size: 16px;
    }
    
    .tablepress tbody {
        font-size: 16px;
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
    
    /*.box-body {*/
    /*    padding: 0.1rem 0.1rem;*/
        /* -ms-flex: 1 1 auto; */
    /*    flex: 1 1 auto;*/
    /*    border-radius: 10px;*/
    /*}*/
    
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
    
    $currWorkID=$workDataArr['workId'];
    $refundPrincipalAmt=$workDataArr['refundPrincipalAmt'];
    $refundInterestAmt=$workDataArr['refundInterestAmt'];
    $refundTotalAmt=$workDataArr['refundTotalAmt'];
    
    $demandPrincipalAmt=$workDataArr['demandPrincipalAmt'];
    $demandInterestAmt=$workDataArr['demandInterestAmt'];
    $demandTotalAmt=$workDataArr['demandTotalAmt'];
?>
<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url('processing'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body card_bg_format">
                    <form action="<?php echo base_url('updateIntimation'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="row mt-10 m-30">
                            <div class="col-md-8 offset-md-2">
                                <div class="row form_bg_format">
                                    <div class="offset-lg-1 col-md-10">
                                        <div class="row form-group mb-0">
                                            <div class="col-md-12 col-lg-12 text-center mb-3">
                                                <span class="font-weight-bold h3" >
                                                    <?php echo $clientNameVar; ?>
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-left">
                                                <span class="font-weight-bold">PAN :&nbsp;</span>
                                                <span class="font-weight-bold">
                                                    <?php echo $workDataArr['clientPanNumber']; ?>
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-right">
                                                <span class="font-weight-bold">A.Y :&nbsp;</span>
                                                <span class="font-weight-bold">
                                                    <?php echo $asmtYear; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="state due-month">
                                                    <h4 class="text-white font-weight-bold m-0"><?php echo $pageTitle; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="offset-lg-1 col-md-10">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4"></div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <label class="font-weight-bold h5">As per Return of Income</label>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <label class="font-weight-bold h5">As per Intimation</label>
                                            </div>
                                        </div>
                                        <hr class="m-0 mb-10">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Total Income : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control inputRTL" value="<?php echo $workDataArr['totalIncome']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control inputRTL" name="intiTotalIncome" id="intiTotalIncome" placeholder="Enter Total Income" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiTotalIncome']; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Refund Claimed : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control refundClaimed inputRTL" value="<?php echo $workDataArr['refundClaimed']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-20">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Refund Approved : 
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="h5" >
                                                    a) Principal : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                -
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <!--<input type="text" class="form-control intiRefundApproved inputRTL" name="intiRefundApproved" id="intiRefundApproved" placeholder="Enter Refund Approved" onkeypress="validateNum(event)" value="<?php //echo $workDataArr['intiRefundApproved']; ?>" >-->
                                                    <input type="text" class="form-control refundPrincipalAmt inputRTL" name="refundPrincipalAmt" id="refundPrincipalAmt" onkeypress="validateNum(event);calculateRefundTotalAmt();" onkeyup="calculateRefundTotalAmt();" onkeydown="calculateRefundTotalAmt();" oninput="calculateRefundTotalAmt();" value="<?php echo $refundPrincipalAmt; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="h5">
                                                    b) Interest : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                -
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control refundInterestAmt inputRTL" name="refundInterestAmt" id="refundInterestAmt" onkeypress="validateNum(event);calculateRefundTotalAmt();" onkeyup="calculateRefundTotalAmt();" onkeydown="calculateRefundTotalAmt();" oninput="calculateRefundTotalAmt();" value="<?php echo $refundInterestAmt; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Total : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                -
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control refundTotalAmt inputRTL" name="refundTotalAmt" id="refundTotalAmt" onkeypress="validateNum(event);" value="<?php echo $refundTotalAmt; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-20">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Additional Demand :
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="h5" >
                                                    a) Principal : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                -
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control demandPrincipalAmt inputRTL" name="demandPrincipalAmt" id="demandPrincipalAmt" onkeypress="validateNum(event);calculateDemandTotalAmt();" onkeyup="calculateDemandTotalAmt();" onkeydown="calculateDemandTotalAmt();" oninput="calculateDemandTotalAmt();" value="<?php echo $demandPrincipalAmt; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="h5">
                                                    b) Interest : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                -
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control demandInterestAmt inputRTL" name="demandInterestAmt" id="demandInterestAmt" onkeypress="validateNum(event);calculateDemandTotalAmt();" onkeyup="calculateDemandTotalAmt();" onkeydown="calculateDemandTotalAmt();" oninput="calculateDemandTotalAmt();" value="<?php echo $demandInterestAmt; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Total : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                -
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control intiAddtnlTax inputRTL" name="intiAddtnlTax" id="intiAddtnlTax" onkeypress="validateNum(event);" value="<?php echo $workDataArr['intiAddtnlTax']; ?>" readonly>
                                                    <input type="hidden" name="demandTotalAmt" id="demandTotalAmt" value="<?php echo $demandTotalAmt; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="intiRemark" class="font-weight-bold h5">Remark:</label>
                                            <textarea type="text" class="form-control" name="intiRemark" id="intiRemark" placeholder="Enter Remark" rows="3"><?php echo $workDataArr['intiRemark']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="intiIsRectification" class="font-weight-bold h5">Whether to apply for rectification ?</label>
                                            <input name="intiIsRectification" type="radio" id="intiIsRectificationYes<?= $currWorkID; ?>" class="radio-col-success" value="1" <?php if($workDataArr['intiIsRectification']=="1"): ?>checked<?php endif; ?> />
                                            <label for="intiIsRectificationYes<?= $currWorkID; ?>">Yes</label>
                                            <input name="intiIsRectification" type="radio" id="intiIsRectificationNo<?= $currWorkID; ?>" class="radio-col-danger" value="2" <?php if($workDataArr['intiIsRectification']=="2"): ?>checked<?php endif; ?> />
                                            <label for="intiIsRectificationNo<?= $currWorkID; ?>">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 text-center">
                                                <input type="hidden" name="refundId" id="refundId" value="<?php echo $workDataArr['refundId']; ?>">
                                                <input type="hidden" name="demandId" id="demandId" value="<?php echo $workDataArr['demandId']; ?>">
                                                <input type="hidden" name="workId" id="workId" value="<?php echo $workDataArr['workId']; ?>">
                                                <input type="hidden" name="isScrutiny" id="isScrutiny" value="<?php echo $workDataArr['isScrutiny']; ?>">
                                                <a href="<?= base_url('processing'); ?>">
                                                    <button type="button" class="btn btn-dark text-left">Back</button>
                                                </a>
                                                <button type="submit" name="submit" class="btn btn-success btn-submit text-left">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    <!-- /.col -->
	</div>
</section>
<!-- /.content -->

<script type="text/javascript">

    function calculateRefundTotalAmt(){
        if($('#refundPrincipalAmt').val()!="")
            var refundPrincipalAmt = parseInt($('#refundPrincipalAmt').val());
        else
            var refundPrincipalAmt = 0;
        
        if($('#refundInterestAmt').val()!="")
            var refundInterestAmt = parseInt($('#refundInterestAmt').val());
        else
            var refundInterestAmt = 0;
        
        var refundTotalAmt = refundPrincipalAmt+refundInterestAmt;
        $('#refundTotalAmt').val(refundTotalAmt);
        $('#intiTotalRefund1').val(refundTotalAmt);
    }    
    
    function calculateDemandTotalAmt()
    {
        if($('#demandPrincipalAmt').val()!="")
            var demandPrincipalAmt = parseInt($('#demandPrincipalAmt').val());
        else
            var demandPrincipalAmt = 0;
        
        if($('#demandInterestAmt').val()!="")
            var demandInterestAmt = parseInt($('#demandInterestAmt').val());
        else
            var demandInterestAmt = 0;
        
        var intiAddtnlTax = demandPrincipalAmt+demandInterestAmt;
        $('#intiAddtnlTax').val(intiAddtnlTax);
        $('#demandTotalAmt').val(intiAddtnlTax);
    }    

</script>

<?= $this->endSection(); ?>