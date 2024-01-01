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
    $intiRefundAmt1=$workDataArr['intiRefundAmt1'];
    $intiInterestAmt1=$workDataArr['intiInterestAmt1'];
    $intiTotalRefund1=$workDataArr['intiTotalRefund1'];
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
                            <a href="<?php echo base_url('income_tax_refunds'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body card_bg_format">
                    <form action="<?php echo base_url('update-refund-details'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <div class="row form-group mb-0">
                                                            <div class="col-md-12 col-lg-12 text-center">
                                                                <span class="font-weight-bold h3" >
                                                                    <?php echo $clientNameVar; ?>
                                                                </span>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 text-left mb-3">
                                                                <span class="font-weight-bold">DOB/DOI :&nbsp;</span>
                                                                <span class="font-weight-bold">
                                                                    <?php   
                                                                        if($workDataArr['orgType']==8 || $workDataArr['orgType']==9)
                                                                        {
                                                                            if(check_valid_date($workDataArr['clientDob']))
                                                                                echo date("d-m-Y", strtotime($workDataArr['clientDob']));
                                                                            else 
                                                                                echo "-"; 
                                                                        }
                                                                        else
                                                                        {
                                                                            if(check_valid_date($workDataArr['clientBussIncorporationDate']))
                                                                                echo date("d-m-Y", strtotime($workDataArr['clientBussIncorporationDate']));
                                                                            else 
                                                                                echo "-"; 
                                                                        }
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 text-center mb-3">
                                                                <span class="font-weight-bold">PAN :&nbsp;</span>
                                                                <span class="font-weight-bold">
                                                                    <?php echo $workDataArr['clientPanNumber']; ?>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 text-right mb-3">
                                                                <span class="font-weight-bold">A.Y :&nbsp;</span>
                                                                <span class="font-weight-bold">
                                                                    <?php echo $asmtYear; ?>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 text-left">
                                                                <span class="font-weight-bold">Filed On :&nbsp;</span>
                                                                <span class="font-weight-bold">
                                                                    <?php 
                                                                        $eFillingDate="-";
                                                                        if(check_valid_date($workDataArr['eFillingDate']))
                                                                            $eFillingDate=date('d-m-Y', strtotime($workDataArr['eFillingDate'])); 
                                                                    ?>
                                                                    <?php echo $eFillingDate; ?>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 text-center">
                                                                <span class="font-weight-bold">Ack No :&nbsp;</span>
                                                                <span class="font-weight-bold">
                                                                    <?php
                                                                        if(!empty($workDataArr['acknowledgmentNo']))
                                                                            echo $workDataArr['acknowledgmentNo'];
                                                                        else
                                                                            echo "-";
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 text-right">
                                                                <span class="font-weight-bold">Total Income :&nbsp;</span>
                                                                <span class="font-weight-bold">
                                                                    <?php
                                                                        if(!empty($workDataArr['totalIncome']))
                                                                            echo $workDataArr['totalIncome'];
                                                                        else
                                                                            echo "-";
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
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
                                            <div class="col-md-12">
                                                <div class="row mt-10">
                                                    <div class="col-md-12 col-lg-12">
                                                        <div class="row">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span class="font-weight-bold" >
                                                                    Instalments : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2 text-center">
                                                                <label class="font-weight-bold h5">I</label>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2 text-center">
                                                                <label class="font-weight-bold h5">II</label>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2 text-center">
                                                                <label class="font-weight-bold h5">III</label>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2 text-center">
                                                                <label class="font-weight-bold h5">IV</label>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2 text-center">
                                                                <label class="font-weight-bold h5">Total</label>
                                                            </div>
                                                        </div>
                                                        <hr class="m-0 mb-10">
                                                        <div class="row">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span class="font-weight-bold" >
                                                                    Refund Claimed : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" value="<?php echo $workDataArr['refundClaimed']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control text-center" value="-" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control text-center" value="-" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control text-center" value="-" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control totalRefundClaimed inputRTL" value="<?php echo $workDataArr['refundClaimed']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-20">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span class="font-weight-bold" >
                                                                    Refund Approved : 
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row intiRefundAmt">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span>
                                                                   a) Refund (Principal) : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiRefundAmt1" id="intiRefundAmt1" onkeypress="validateNum(event)" value="<?php echo $intiRefundAmt1; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiRefundAmt2" id="intiRefundAmt2" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiRefundAmt2']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiRefundAmt3" id="intiRefundAmt3" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiRefundAmt3']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiRefundAmt4" id="intiRefundAmt4" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiRefundAmt4']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiTotalRefundAmt" id="intiTotalRefundAmt" value="<?php echo $workDataArr['intiTotalRefundAmt']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row intiInterestAmt">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span>
                                                                    b) Interest Amount : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiInterestAmt1" id="intiInterestAmt1" onkeypress="validateNum(event)" value="<?php echo $intiInterestAmt1; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiInterestAmt2" id="intiInterestAmt2" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiInterestAmt2']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiInterestAmt3" id="intiInterestAmt3" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiInterestAmt3']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiInterestAmt4" id="intiInterestAmt4" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiInterestAmt4']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiTotalInterestAmt" id="intiTotalInterestAmt" value="<?php echo $workDataArr['intiTotalInterestAmt']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row intiTotalRefund">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span class="font-weight-bold" >
                                                                    Total Refund : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiTotalRefund1" id="intiTotalRefund1" onkeypress="validateNum(event)" value="<?php echo $intiTotalRefund1; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiTotalRefund2" id="intiTotalRefund2" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiTotalRefund2']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiTotalRefund3" id="intiTotalRefund3" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiTotalRefund3']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiTotalRefund4" id="intiTotalRefund4" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiTotalRefund4']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiTotalRefund" id="intiTotalRefund" value="<?php echo $workDataArr['intiTotalRefund']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <?php
                                                                $intiRefundDate1=$intiRefundDate2=$intiRefundDate3=$intiRefundDate4="";
                                                                
                                                                if(check_valid_date($workDataArr['intiRefundDate1'])){
                                                                    $intiRefundDate1=date('Y-m-d', strtotime($workDataArr['intiRefundDate1']));
                                                                }
                                                                
                                                                if(check_valid_date($workDataArr['intiRefundDate2'])){
                                                                    $intiRefundDate2=date('Y-m-d', strtotime($workDataArr['intiRefundDate2']));
                                                                }
                                                                
                                                                if(check_valid_date($workDataArr['intiRefundDate3'])){
                                                                    $intiRefundDate3=date('Y-m-d', strtotime($workDataArr['intiRefundDate3']));
                                                                }
                                                                
                                                                if(check_valid_date($workDataArr['intiRefundDate4'])){
                                                                    $intiRefundDate4=date('Y-m-d', strtotime($workDataArr['intiRefundDate4']));
                                                                }
                                                            
                                                            ?>
                                                            <div class="col-md-2 col-lg-2">
                                                                <span class="font-weight-bold" >
                                                                    Date of Receipt : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control inputRTL" name="intiRefundDate1" id="intiRefundDate1" value="<?php echo $intiRefundDate1; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control inputRTL" name="intiRefundDate2" id="intiRefundDate2" value="<?php echo $intiRefundDate2; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control inputRTL" name="intiRefundDate3" id="intiRefundDate3" value="<?php echo $intiRefundDate3; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control inputRTL" name="intiRefundDate4" id="intiRefundDate4" value="<?php echo $intiRefundDate4; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control text-center" value="-" readonly >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span class="font-weight-bold" >
                                                                    Balance Receivable : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control text-center" value="-" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control text-center" value="-" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control text-center" value="-" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control text-center" value="-" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="intiBalRefundRecvd" id="intiBalRefundRecvd" onkeypress="validateNum(event)" value="<?php echo $workDataArr['intiBalRefundRecvd']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label for="intiRefundRemark">Remark:</label>
                                                            <textarea type="text" class="form-control" name="intiRefundRemark" id="intiRefundRemark" placeholder="Enter Remark" rows="3"><?php echo $workDataArr['intiRefundRemark']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12 text-center">
                                                <input type="hidden" name="refundId" id="refundId" value="<?php echo $workDataArr['refundId']; ?>">
                                                <input type="hidden" name="workId" id="workId" value="<?php echo $workDataArr['workId']; ?>">
                                                <a href="<?= base_url('income_tax_refunds'); ?>">
                                                    <button type="button" class="btn btn-dark text-left">Back</button>
                                                </a>
                                                <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
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

    $(document).ready(function(){
        
        var refundPrincipalAmt = "<?= $refundPrincipalAmt ?>";
        var refundInterestAmt = "<?= $refundInterestAmt ?>";
        var refundTotalAmt = "<?= $refundTotalAmt ?>";
        
        var intiRefundAmt1 = "<?= $intiRefundAmt1 ?>";
        var intiInterestAmt1 = "<?= $intiInterestAmt1 ?>";
        var intiTotalRefund1 = "<?= $intiTotalRefund1 ?>";
        
        if(intiRefundAmt1!="")
            $('#intiRefundAmt1').val(intiRefundAmt1);
        else
            $('#intiRefundAmt1').val(refundPrincipalAmt);
            
        if(intiInterestAmt1!="")
            $('#intiInterestAmt1').val(intiInterestAmt1);
        else
            $('#intiInterestAmt1').val(refundInterestAmt);
            
        if(intiTotalRefund1!="")
            $('#intiTotalRefund1').val(intiTotalRefund1);
        else
            $('#intiTotalRefund1').val(refundTotalAmt);
        
        $('.intiRefundAmt input, .intiInterestAmt input').on('keyup', function(){
            
            if($(this).parents('.intiRefundAmt').length){
                var intiRefundAmtInput = $(this).attr('id');
                
                if($(this).val()!="")
                    var intiRefundAmtVal = parseInt($(this).val());
                else
                    var intiRefundAmtVal = 0;
                    
                var intiRefundAmtInputNo = intiRefundAmtInput[intiRefundAmtInput.length-1];
                var intiInterestAmtInput = "#intiInterestAmt"+intiRefundAmtInputNo;
                var intiTotalRefundInput = "#intiTotalRefund"+intiRefundAmtInputNo;
                
                if($(intiInterestAmtInput).val()!='')
                    var intiInterestAmtVal = parseInt($(intiInterestAmtInput).val());
                else
                    var intiInterestAmtVal = 0;
                    
                var intiTotalRefundAmt = intiRefundAmtVal+intiInterestAmtVal;
            
                $(intiTotalRefundInput).val(intiTotalRefundAmt);
                
            }else if($(this).parents('.intiInterestAmt').length){
                var intiInterestAmtInput = $(this).attr('id');
                
                if($(this).val()!="")
                    var intiInterestAmtVal = parseInt($(this).val());
                else
                    var intiInterestAmtVal = 0;
                    
                var intiInterestAmtInputNo = intiInterestAmtInput[intiInterestAmtInput.length-1];
                var intiRefundAmtInput = "#intiRefundAmt"+intiInterestAmtInputNo;
                var intiTotalRefundInput = "#intiTotalRefund"+intiInterestAmtInputNo;
                
                if($(intiRefundAmtInput).val()!='')
                    var intiRefundAmtVal = parseInt($(intiRefundAmtInput).val());
                else
                    var intiRefundAmtVal = 0;
                
                var intiTotalRefundAmt = intiRefundAmtVal+intiInterestAmtVal;
                
                $(intiTotalRefundInput).val(intiTotalRefundAmt);
            }
            
            var sumIntiRefundAmt = 0;
            $('.intiRefundAmt input').each(function(index, elem) {
                var elemId = $(elem).attr('id');
                
                if(elemId!="intiTotalRefundAmt")
                    sumIntiRefundAmt += Number($(this).val());
            });
            
            $('#intiTotalRefundAmt').val(sumIntiRefundAmt);
            
            var sumIntiInterestAmt = 0;
            $('.intiInterestAmt input').each(function(index, elem) {
                var elemId = $(elem).attr('id');
                
                if(elemId!="intiTotalInterestAmt")
                    sumIntiInterestAmt += Number($(this).val());
            });
            
            $('#intiTotalInterestAmt').val(sumIntiInterestAmt);
            
            var sumIntiTotalRefund = 0;
            $('.intiTotalRefund input').each(function(index, elem) {
                var elemId = $(elem).attr('id');
                
                if(elemId!="intiTotalRefund")
                    sumIntiTotalRefund += Number($(this).val());
            });
            
            $('#intiTotalRefund').val(sumIntiTotalRefund);
            
            calculateBalRefundRecvd();
        });
        
        function calculateBalRefundRecvd(){
            var totalRefundClaimed = $('.totalRefundClaimed').val();
            var intiTotalRefundAmt = $('#intiTotalRefundAmt').val();
            
            var intiBalRefundRecvd = totalRefundClaimed-intiTotalRefundAmt;
            
            $('#intiBalRefundRecvd').val(intiBalRefundRecvd);
        }
        
        $('.intiRefundAmt input, .intiInterestAmt input').trigger('keyup');

    });

</script>

<?= $this->endSection(); ?>