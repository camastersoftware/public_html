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
    
    $demandPrincipalAmt=$workDataArr['demandPrincipalAmt'];
    $demandInterestAmt=$workDataArr['demandInterestAmt'];
    $demandTotalAmt=$workDataArr['demandTotalAmt'];
    $whetherPayable=$workDataArr['whetherPayable'];
    $demandDecision=$workDataArr['demandDecision'];
    $demandPrincipalAmt1=$demandPrincipalAmt;
    $demandInterestAmt1=$demandInterestAmt;
    $totalDemandAmt1=$demandTotalAmt;
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
                            <a href="<?php echo base_url('income-tax-demands'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body card_bg_format">
                    <form action="<?php echo base_url('update-demand-details'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <div class="row form-group mb-0">
                                                            <div class="col-md-12 col-lg-12 text-center mb-2">
                                                                <span class="font-weight-bold h3" >
                                                                    <?php echo $clientNameVar; ?>
                                                                </span>
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
                                                                            echo amount_format($workDataArr['totalIncome']);
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
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="whetherPayableLabel" class="font-weight-bold h5">Whether demand of Rupees <?= amount_format($demandTotalAmt); ?>/- is payable ?</label>
                                                    
                                                    <input name="whetherPayable" type="radio" id="whetherPayableYes" class="radio-col-success" value="1" <?php if($whetherPayable=="1"): ?>checked<?php endif; ?> />
                                                    <label for="whetherPayableYes">Yes</label>
                                                    
                                                    <input name="whetherPayable" type="radio" id="whetherPayableNo" class="radio-col-danger" value="2" <?php if($whetherPayable=="2"): ?>checked<?php endif; ?> />
                                                    <label for="whetherPayableNo">No</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <span class="font-weight-bold h4" >
                                                    Paid as Under :
                                                </span>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row mt-10">
                                                    <div class="col-md-12 col-lg-12" id="demandDetailsDiv1">
                                                        <div class="row">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span class="font-weight-bold" >
                                                                    Instalments : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2 text-center"></div>
                                                            <div class="col-md-8 col-lg-8 text-center">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-lg-3 text-center">
                                                                        <label class="font-weight-bold h5">I</label>
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 text-center">
                                                                        <label class="font-weight-bold h5">II</label>
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 text-center">
                                                                        <label class="font-weight-bold h5">III</label>
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 text-center">
                                                                        <label class="font-weight-bold h5">Total Paid</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="m-0 mb-10">
                                                        <div class="row mb-20">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span class="font-weight-bold" >
                                                                    Additional Demand Payable: 
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row demandPrincipalAmt">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span>
                                                                   a) Demand (Principal) : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="demandPrincipalAmt1" id="demandPrincipalAmt1" onkeypress="validateNum(event)" value="<?php echo $demandPrincipalAmt1; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="demandPrincipalAmt2" id="demandPrincipalAmt2" onkeypress="validateNum(event)" value="<?php echo $workDataArr['demandPrincipalAmt2']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="demandPrincipalAmt3" id="demandPrincipalAmt3" onkeypress="validateNum(event)" value="<?php echo $workDataArr['demandPrincipalAmt3']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="demandPrincipalAmt4" id="demandPrincipalAmt4" onkeypress="validateNum(event)" value="<?php echo $workDataArr['demandPrincipalAmt4']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="totalDemandPrincipalAmt" id="totalDemandPrincipalAmt" value="<?php echo $workDataArr['totalDemandPrincipalAmt']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row demandInterestAmt">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span>
                                                                    b) Interest Amount : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="demandInterestAmt1" id="demandInterestAmt1" onkeypress="validateNum(event)" value="<?php echo $demandInterestAmt1; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="demandInterestAmt2" id="demandInterestAmt2" onkeypress="validateNum(event)" value="<?php echo $workDataArr['demandInterestAmt2']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="demandInterestAmt3" id="demandInterestAmt3" onkeypress="validateNum(event)" value="<?php echo $workDataArr['demandInterestAmt3']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="demandInterestAmt4" id="demandInterestAmt4" onkeypress="validateNum(event)" value="<?php echo $workDataArr['demandInterestAmt4']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="totalDemandInterestAmt" id="totalDemandInterestAmt" value="<?php echo $workDataArr['totalDemandInterestAmt']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row totalDemandAmt">
                                                            <div class="col-md-2 col-lg-2">
                                                                <span class="font-weight-bold" >
                                                                    Total Demand : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="totalDemandAmt1" id="totalDemandAmt1" onkeypress="validateNum(event)" value="<?php echo $totalDemandAmt1; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="totalDemandAmt2" id="totalDemandAmt2" onkeypress="validateNum(event)" value="<?php echo $workDataArr['totalDemandAmt2']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="totalDemandAmt3" id="totalDemandAmt3" onkeypress="validateNum(event)" value="<?php echo $workDataArr['totalDemandAmt3']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="totalDemandAmt4" id="totalDemandAmt4" onkeypress="validateNum(event)" value="<?php echo $workDataArr['totalDemandAmt4']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputRTL" name="totalDemandPaidAmt" id="totalDemandPaidAmt" value="<?php echo $workDataArr['totalDemandPaidAmt']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <?php
                                                                $demandAmtDate1=$demandAmtDate2=$demandAmtDate3=$demandAmtDate4="";
                                                                
                                                                if(check_valid_date($workDataArr['demandAmtDate1'])){
                                                                    $demandAmtDate1=date('Y-m-d', strtotime($workDataArr['demandAmtDate1']));
                                                                }
                                                                
                                                                if(check_valid_date($workDataArr['demandAmtDate2'])){
                                                                    $demandAmtDate2=date('Y-m-d', strtotime($workDataArr['demandAmtDate2']));
                                                                }
                                                                
                                                                if(check_valid_date($workDataArr['demandAmtDate3'])){
                                                                    $demandAmtDate3=date('Y-m-d', strtotime($workDataArr['demandAmtDate3']));
                                                                }
                                                                
                                                                if(check_valid_date($workDataArr['demandAmtDate4'])){
                                                                    $demandAmtDate4=date('Y-m-d', strtotime($workDataArr['demandAmtDate4']));
                                                                }
                                                            
                                                            ?>
                                                            <div class="col-md-2 col-lg-2">
                                                                <span class="font-weight-bold" >
                                                                    Date of Payment : 
                                                                </span>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control text-center" value="-" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control inputRTL" name="demandAmtDate2" id="demandAmtDate2" value="<?php echo $demandAmtDate2; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control inputRTL" name="demandAmtDate3" id="demandAmtDate3" value="<?php echo $demandAmtDate3; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control inputRTL" name="demandAmtDate4" id="demandAmtDate4" value="<?php echo $demandAmtDate4; ?>" >
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
                                                                    Balance Payable : 
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
                                                                    <input type="text" class="form-control inputRTL" name="balancePayable" id="balancePayable" onkeypress="validateNum(event)" value="<?php echo $workDataArr['balancePayable']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12" id="demandDetailsDiv2">
                                                        <div class="form-group">
                                                            <label for="demandDecisionLabel" class="font-weight-bold h5">Whether to file Rectification or Appeal ?</label>
                                                            
                                                            <input name="demandDecision" type="radio" id="demandDecisionRectftn" class="radio-col-success" value="1" <?php if($demandDecision=="1"): ?>checked<?php endif; ?> />
                                                            <label for="demandDecisionRectftn">Rectification</label>
                                                            
                                                            <input name="demandDecision" type="radio" id="demandDecisionAppeal" class="radio-col-success" value="2" <?php if($demandDecision=="2"): ?>checked<?php endif; ?> />
                                                            <label for="demandDecisionAppeal">Appeal</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label for="demandRemark">Remark:</label>
                                                            <textarea type="text" class="form-control" name="demandRemark" id="demandRemark" placeholder="Enter Remark" rows="3"><?php echo $workDataArr['demandRemark']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 text-center">
                                                        <input type="hidden" name="demandId" id="demandId" value="<?php echo $workDataArr['demandId']; ?>">
                                                        <input type="hidden" name="workId" id="workId" value="<?php echo $workDataArr['workId']; ?>">
                                                        <a href="<?= base_url('income-tax-demands'); ?>">
                                                            <button type="button" class="btn btn-dark text-left">Back</button>
                                                        </a>
                                                        <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                                                    </div>
                                                </div>
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
        
        var demandPrincipalAmt = "<?= $demandPrincipalAmt ?>";
        var demandInterestAmt = "<?= $demandInterestAmt ?>";
        var demandTotalAmt = "<?= $demandTotalAmt ?>";
        
        var demandPrincipalAmt1 = "<?= $demandPrincipalAmt1 ?>";
        var demandInterestAmt1 = "<?= $demandInterestAmt1 ?>";
        var totalDemandAmt1 = "<?= $totalDemandAmt1 ?>";
        
        if(demandPrincipalAmt1!="")
            $('#demandPrincipalAmt1').val(demandPrincipalAmt1);
        else
            $('#demandPrincipalAmt1').val(demandPrincipalAmt);
            
        if(demandInterestAmt1!="")
            $('#demandInterestAmt1').val(demandInterestAmt1);
        else
            $('#demandInterestAmt1').val(demandInterestAmt);
            
        if(totalDemandAmt1!="")
            $('#totalDemandAmt1').val(totalDemandAmt1);
        else
            $('#totalDemandAmt1').val(demandTotalAmt);
        
        $('.demandPrincipalAmt input, .demandInterestAmt input').on('keyup', function(){
            
            if($(this).parents('.demandPrincipalAmt').length){
                var demandPrincipalAmtInput = $(this).attr('id');
                
                if($(this).val()!="")
                    var demandPrincipalAmtVal = parseInt($(this).val());
                else
                    var demandPrincipalAmtVal = 0;
                    
                var demandPrincipalAmtInputNo = demandPrincipalAmtInput[demandPrincipalAmtInput.length-1];
                
                if(demandPrincipalAmtInputNo!=1)
                {
                    var demandInterestAmtInput = "#demandInterestAmt"+demandPrincipalAmtInputNo;
                    var totalDemandAmtInput = "#totalDemandAmt"+demandPrincipalAmtInputNo;
                    
                    if($(demandInterestAmtInput).val()!='')
                        var demandInterestAmtVal = parseInt($(demandInterestAmtInput).val());
                    else
                        var demandInterestAmtVal = 0;
                        
                    var totalDemandPrincipalAmt = demandPrincipalAmtVal+demandInterestAmtVal;
                
                    $(totalDemandAmtInput).val(totalDemandPrincipalAmt);
                }
                
            }else if($(this).parents('.demandInterestAmt').length){
                var demandInterestAmtInput = $(this).attr('id');
                
                if($(this).val()!="")
                    var demandInterestAmtVal = parseInt($(this).val());
                else
                    var demandInterestAmtVal = 0;
                    
                var demandInterestAmtInputNo = demandInterestAmtInput[demandInterestAmtInput.length-1];
                
                if(demandInterestAmtInputNo!=1)
                {
                    var demandPrincipalAmtInput = "#demandPrincipalAmt"+demandInterestAmtInputNo;
                    var totalDemandAmtInput = "#totalDemandAmt"+demandInterestAmtInputNo;
                    
                    if($(demandPrincipalAmtInput).val()!='')
                        var demandPrincipalAmtVal = parseInt($(demandPrincipalAmtInput).val());
                    else
                        var demandPrincipalAmtVal = 0;
                    
                    var totalDemandPrincipalAmt = demandPrincipalAmtVal+demandInterestAmtVal;
                    
                    $(totalDemandAmtInput).val(totalDemandPrincipalAmt);
                }
            }
            
            var sumdemandPrincipalAmt = 0;
            $('.demandPrincipalAmt input').each(function(index, elem) {
                
                if(index!=0)
                {
                    var elemId = $(elem).attr('id');
                    
                    if(elemId!="totalDemandPrincipalAmt")
                        sumdemandPrincipalAmt += Number($(this).val());
                }
            });
            
            $('#totalDemandPrincipalAmt').val(sumdemandPrincipalAmt);
            
            var sumDemandInterestAmt = 0;
            $('.demandInterestAmt input').each(function(index, elem) {
                if(index!=0)
                {
                    var elemId = $(elem).attr('id');
                    
                    if(elemId!="totalDemandInterestAmt")
                        sumDemandInterestAmt += Number($(this).val());
                }
            });
            
            $('#totalDemandInterestAmt').val(sumDemandInterestAmt);
            
            var sumTotalDemandAmt = 0;
            $('.totalDemandAmt input').each(function(index, elem) {
                if(index!=0)
                {
                    var elemId = $(elem).attr('id');
                    
                    if(elemId!="totalDemandPaidAmt")
                        sumTotalDemandAmt += Number($(this).val());
                }
            });
            
            $('#totalDemandPaidAmt').val(sumTotalDemandAmt);
            
            calculateBalPayable();
        });
        
        function calculateBalPayable(){
            var totalDemandPaidAmt = $('#totalDemandPaidAmt').val();
            
            var balancePayable = demandTotalAmt-totalDemandPaidAmt;
            
            $('#balancePayable').val(balancePayable);
        }
        
        $('#demandDetailsDiv1').hide();
        $('#demandDetailsDiv2').hide();
        
        $('input[name="whetherPayable"]').on('click', function(){
            var whetherPayable = $(this).val();
            
            if(whetherPayable==1)
            {
                $('#demandDetailsDiv1').show();
                $('#demandDetailsDiv2').hide();
            }
            else if(whetherPayable==2)
            {
                $('#demandDetailsDiv1').hide();
                $('#demandDetailsDiv2').show();
            }
        });
        
        $('.demandPrincipalAmt input, .demandInterestAmt input').trigger('keyup');
        $('input[name="whetherPayable"]:checked').trigger('click');

    });

</script>

<?= $this->endSection(); ?>