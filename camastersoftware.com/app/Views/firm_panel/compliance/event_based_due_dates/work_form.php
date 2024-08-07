<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .theme-primary .wizard-content .wizard > .steps > ul > li.done {
        margin-top: 15px;
        width: 297px;
    }
            
    .tablepress tbody tr:first-child td {
        background: #288651;
        color: #fff;
    } 
    
    .tablepress tbody tr:nth-child(4) td.column-1 {
        background: #fb3d3d;
        color: #fff;
    }
    
    .theme-primary .wizard-content .wizard > .steps > ul > li.current {
        margin-top: 15px;
        width: 297px;
    }
    
    .tablepress{
        width:100%;
    }
    
    .tablepress thead tr, .tablepress thead th {
        text-align: center;
        width: 10%;
    }
    
    .tablepress tbody td {
        text-align: center;
    }
    
    .tablepress td, .tablepress th {
        font-weight: 600;
    }
    
    .tablepress tbody tr:nth-child(6) td.column-1 {
        background: #fff;
    }
    
    table.dataTable {
        clear: both;
         margin-top: 0px !important; 
    }
    
    .wizard-content .wizard > .content > .body {
        padding: 0px 20px;
    }
    
    .clrBtn {
        width: 13.33%;
        padding: 25px;
        color: #ffffff;
        font-size: 30px;
        cursor: pointer;
        border: 0;
        transition: 300ms all linear;
        position: relative;
    }
    
    .clrBtn.active:after {
        content: "";
        height: 20px;
        width: 20px;
        position: absolute;
        background-color: #ffffff;
        top: 14px;
        right: 22px;
        border-radius: 50%;
    }
    
    .clrBtn.active:before {
        content: "";
        height: 7px;
        width: 10px;
        position: absolute;
        top: 20px;
        right: 27px;
        border-radius: 2px;
        position: absolute;
        z-index: 1;
        border-left: 3px solid #333333;
        border-bottom: 3px solid #333333;
        z-index: 11;
        transform: rotate(-45deg);
    }
    
    .none{
        background-color: #96c7f242 !important;
    }
    .red{
        background-color: pink !important;
    } 
    .yellow{
        background-color: #f0f58b7d !important;
    } 
    .violet{
        background-color: #f38bf5 !important;
    } 
    .green{
        background-color: #37fa1f !important;
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
    
    .tablepress {
        background: #eff8ff !important;
    }
    
    .card_bg_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 0px !important;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }
    
    .form_bg_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px !important;
        border: 1px solid #8c8c8cab !important;
        background: #fdfeff !important;
    }
</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h6>
                    <button type="button" class="waves-effect waves-light btn btn-sm btn-dark get_back" style="">Back</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body card_bg_format">
                    <form action="<?= base_url('update-inc-event-based-work'); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row form-group mb-2">
                                                    <div class="col-md-12 col-lg-12 text-center">
                                                        <h3 class="font-weight-bold m-0" >
                                                            <?= $workClientName; ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-left">
                                                <span class="font-weight-bold">PAN :&nbsp;</span>
                                                <span class="font-weight-bold">
                                                    <?= $clientPanNo; ?>
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <span class="font-weight-bold">DOB/DOI :&nbsp;</span>
                                                <span class="font-weight-bold">
                                                    <?= $clientDobDoi; ?>
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-right">
                                                <span class="font-weight-bold">Event Date :&nbsp;</span>
                                                <span class="font-weight-bold">
                                                    <?= $eventDate; ?>
                                                </span>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="state due-month">
                                                            <h4 class="text-white font-weight-bold m-0">Work-In-Progress</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label for="isDocRecvd">Document Received :</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input name="isDocRecvd" type="radio" id="isDocRecvdYes" class="radio-col-success is_doc_rec" value="1" <?php if($workArr['isDocRecvd']=="1"): ?>checked<?php endif; ?> />
                                                                        <label for="isDocRecvdYes">Yes</label>
                                                                        <input name="isDocRecvd" type="radio" id="isDocRecvdNo" class="radio-col-danger is_doc_rec" value="2" <?php if($workArr['isDocRecvd']=="2"): ?>checked<?php endif; ?> />
                                                                        <label for="isDocRecvdNo">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" id="doc_date">
                                                                <?php
                                                                    $docRecvdDate="";
                                                                    if(check_valid_date($workArr['docRecvdDate']))
                                                                        $docRecvdDate=date('Y-m-d', strtotime($workArr['docRecvdDate']));
                                                                ?>
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label for="docRecvdDate">Received Date :</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="date" class="form-control" name="docRecvdDate" id="docRecvdDate" value="<?php echo $docRecvdDate; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label for="isUrgentWork">Urgent/Important :</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="radio" name="isUrgentWork" id="isUrgentWorkYes" class="radio-col-success" value="1" <?php if($workArr['isUrgentWork']=="1"): ?>checked<?php endif; ?> />
                                                                        <label for="isUrgentWorkYes">Yes</label>
                                                                        <input type="radio" name="isUrgentWork" id="isUrgentWorkNo" class="radio-col-danger" value="2" <?php if($workArr['isUrgentWork']=="2"): ?>checked<?php endif; ?> />
                                                                        <label for="isUrgentWorkNo">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label for="workDone">Work Percentage :</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="number" class="form-control checkMinMax" name="workDone" id="workDone" value="<?php echo $workArr['workDone']; ?>" onkeypress="validateNum(event)" min="0" max="100"> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="mb-0">Junior Staff :</label>
                                                                        <small style="white-space: pre;">(Prepared by)</small>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <select class="custom-select form-control" name="juniorId" id="juniorId" >
                                                                            <option value="">Select Staff</option>
                                                                            <?php if(!empty($getUserList)): ?>
                                                                                <?php foreach($getUserList AS $e_user): ?>
                                                                                    <?php 
                                                                                        $selJunior="";
                                                                                        if($workArr['juniorId']==$e_user['userId'])
                                                                                            $selJunior="selected";
                                                                                    ?>
                                                                                    <option value="<?php echo $e_user['userId']; ?>" <?php echo $selJunior; ?> ><?php echo $e_user['userFullName']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </select> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label  class="mb-0">Senior Staff :</label>
                                                                        <small style="white-space: pre;">(Verified by)</small>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <select class="custom-select form-control" name="seniorId" id="seniorId" >
                                                                            <option value="">Select Staff</option>
                                                                            <?php if(!empty($getUserList)): ?>
                                                                                <?php foreach($getUserList AS $e_user): ?>
                                                                                    <?php 
                                                                                        $selJunior="";
                                                                                        if($workArr['seniorId']==$e_user['userId'])
                                                                                            $selJunior="selected";
                                                                                    ?>
                                                                                    <option value="<?php echo $e_user['userId']; ?>" <?php echo $selJunior; ?> ><?php echo $e_user['userFullName']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </select> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mt-0">
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="state due-month">
                                                            <h4 class="text-white font-weight-bold m-0">Work Completed</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php
                                                                    $eFillingDate="";
                                                                    if(check_valid_date($workArr['eFillingDate']))
                                                                        $eFillingDate=date('Y-m-d', strtotime($workArr['eFillingDate']));
                                                                ?>
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label for="eFillingDate">E-Filling Date :</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="date" class="form-control" name="eFillingDate" id="eFillingDate" value="<?php echo $eFillingDate; ?>" > 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label for="verificationDoneBy">Verification By :</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control" name="verificationDoneBy" id="verificationDoneBy" placeholder="Enter Verification By" value="<?php echo $workArr['verificationDoneBy']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label for="verificationMode">Verification Mode :</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <select class="custom-select form-control" name="verificationMode" id="verificationMode" >
                                                                            <option value="">Select</option>
                                                                            <?php if(!empty($verificationModeData)): ?>
                                                                                <?php foreach($verificationModeData AS $e_vrfyMode): ?>
                                                                                    <?php 
                                                                                        $selVrfyMode="";
                                                                                        if($workArr['verificationMode']==$e_vrfyMode['vrfyModeId'])
                                                                                            $selVrfyMode="selected";
                                                                                    ?>
                                                                                    <option value="<?php echo $e_vrfyMode['vrfyModeId']; ?>" <?php echo $selVrfyMode; ?> ><?php echo $e_vrfyMode['vrfyModeName']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label for="acknowledgmentNo">Acknowledgment :</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control" name="acknowledgmentNo" id="acknowledgmentNo" placeholder="Enter Acknowledgment No" value="<?php echo $workArr['acknowledgmentNo']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <?php
                                                                    $verificationDate="";
                                                                    if(check_valid_date($workArr['verificationDate']))
                                                                        $verificationDate=date('Y-m-d', strtotime($workArr['verificationDate']));
                                                                ?>
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label for="verificationDate">Verification Date :</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="date" class="form-control" name="verificationDate" id="verificationDate" value="<?php echo $verificationDate; ?>"> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <?php $ackUploadFile = $workArr['ackUploadFile']; ?>
                                                                    <div class="col-md-4">
                                                                        <label for="verificationDate">Ack. Upload :</label>
                                                                    </div>
                                                                    <div class="<?php if(!empty($ackUploadFile)): ?>col-md-5<?php else: ?>col-md-8<?php endif; ?>">
                                                                        <input type="file" class="form-control" name="ackUploadFile" id="ackUploadFile">
                                                                        <input type="hidden" name="ackUploadFileHidden" value="<?= $ackUploadFile; ?>">
                                                                    </div>
                                                                    <?php if(!empty($ackUploadFile)): ?>
                                                                        <div class="col-md-3">
                                                                            <?php $ackUploadFilePath = base_url("uploads/ca_firm_".$sessCaFirmId."/compliance/income_tax/".$ackUploadFile); ?>
                                                                            <a href="<?= $ackUploadFilePath; ?>" target="_blank">
                                                                                <button type="button" class="waves-effect waves-light btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="View">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </button>
                                                                            </a>
                                                                            &nbsp;
                                                                            <a href="javascript:void(0);" class="deleteUploadedFile">
                                                                                <button type="button" class="waves-effect waves-light btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Remarks or Comments (if any) : </label>
                                                            <textarea rows="2" class="form-control" name="workRemark" placeholder="Enter Remarks or Comments (if any)"><?php echo $workArr['workRemark']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mt-0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="state due-month">
                                                    <h4 class="text-white font-weight-bold m-0">Professional Billing & Receipts</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-4">
                                                                <label for="isBillingDone">Billing Done :</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input name="isBillingDone" type="radio" id="isBillingDoneYes" class="radio-col-success isBillingDone" value="1" <?php if($workArr['isBillingDone']=="1"): ?>checked<?php endif; ?> />
                                                                <label for="isBillingDoneYes">Yes</label>
                                                                <input name="isBillingDone" type="radio" id="isBillingDoneNo" class="radio-col-danger isBillingDone" value="2" <?php if($workArr['isBillingDone']=="2"): ?>checked<?php endif; ?> />
                                                                <label for="isBillingDoneNo">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 billingDiv">
                                                        <div class="form-group">
                                                            <label for="billNo">Bill No:</label>
                                                            <input type="text" class="form-control" name="billNo" id="billNo" placeholder="Enter Bill No" value="<?php echo $workArr['billNo']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 billingDiv">
                                                        <?php
                                                            $billDate="";
                                                            if(!check_valid_date($workArr['billDate']))
                                                                $billDate=date('Y-m-d', strtotime($workArr['billDate']));
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="billDate">Bill Date:</label>
                                                            <input class="form-control" type="date" name="billDate" id="billDate" value="<?php echo $billDate; ?>"> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 billingDiv">
                                                        <div class="form-group">
                                                            <label for="billAmt">Bill Amount:</label>
                                                            <input type="text" class="form-control" name="billAmt" id="billAmt" placeholder="Enter Bill Amount" value="<?php echo $workArr['billAmt']; ?>" onkeypress="validateNum(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 billingDiv">
                                                        <div class="form-group">
                                                            <label>Comment</label>
                                                            <textarea rows="1" class="form-control" name="billingComment" placeholder="Enter Comment"><?php echo $workArr['billingComment']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-4">
                                                                <label for="isReceiptDone">Receipt :</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input name="isReceiptDone" type="radio" id="isReceiptDoneYes" class="radio-col-success isReceiptDone" value="1" <?php if($workArr['isReceiptDone']=="1"): ?>checked<?php endif; ?> />
                                                                <label for="isReceiptDoneYes">Yes</label>
                                                                <input name="isReceiptDone" type="radio" id="isReceiptDoneNo" class="radio-col-danger isReceiptDone" value="2" <?php if($workArr['isReceiptDone']=="2"): ?>checked<?php endif; ?> />
                                                                <label for="isReceiptDoneNo">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 receiptDiv">
                                                        <?php
                                                            $receiptDate="";
                                                            if(check_valid_date($workArr['receiptDate']))
                                                                $receiptDate=date('Y-m-d', strtotime($workArr['receiptDate']));
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="receiptDate">Receipt Date:</label>
                                                            <input class="form-control" type="date" name="receiptDate" id="receiptDate" value="<?php echo $receiptDate; ?>"> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 receiptDiv">
                                                        <div class="form-group">
                                                            <label for="receiptAmt">Receipt Amount:</label>
                                                            <input type="text" class="form-control" name="receiptAmt" id="receiptAmt" placeholder="Enter Receipt Amount" value="<?php echo $workArr['receiptAmt']; ?>" onkeypress="validateNum(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 receiptDiv">
                                                        <div class="form-group">
                                                            <label>Comment</label>
                                                            <textarea rows="1" class="form-control" name="receiptComment" placeholder="Enter Comment"><?php echo $workArr['receiptComment']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12 mt-30 text-center">
                                                <input type="hidden" name="workId" id="workId" value="<?php echo $workId; ?>">
                                                <button type="button" class="waves-effect waves-light btn btn-dark get_back">Back</button>
                                                <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button>
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
    <!-- /.row -->
</section>

<script type="text/javascript">
            
    $(document).ready(function(){
        
        var base_url = "<?php echo base_url(); ?>";
        var workId = $('#workId').val();
        
        $('#doc_date').hide();
        
        $('.is_doc_rec').on('click', function(){
            
            var doc_rec = $(this).val();
            
            if(doc_rec=="1")
                $('#doc_date').show();
            else if(doc_rec=="2")
                $('#doc_date').hide();
            
        });
        
        $('.billingDiv').hide();
        
        $('.isBillingDone').on('click', function(){
            
            var isBillingDone = $(this).val();
            
            if(isBillingDone=="1")
                $('.billingDiv').show();
            else if(isBillingDone=="2")
                $('.billingDiv').hide();
            
        });
        
        $('.receiptDiv').hide();
        
        $('.isReceiptDone').on('click', function(){
            
            var isReceiptDone = $(this).val();
            
            if(isReceiptDone=="1")
                $('.receiptDiv').show();
            else if(isReceiptDone=="2")
                $('.receiptDiv').hide();
            
        });

        $('.is_doc_rec:checked').trigger('click');
        $('.isBillingDone:checked').trigger('click');
        $('.isReceiptDone:checked').trigger('click');
        
        $('body').on('click', '.deleteUploadedFile', function(){
            
            var base_url = "<?php echo base_url(); ?>";
            var workId = $('#workId').val();
            
            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this uploaded file ?",
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
                        url : base_url+'/delete-inc-tax-ack-file',
                        type : 'POST',
                        data : {
                            'workId':workId
                        },
                        dataType: 'html',
                        success : function(response) {
                            
                            window.location.reload();

                        },
                        error : function(request, error)
                        {
                            alert("Request: "+JSON.stringify(request));
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