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
</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">Work Details</h4>
                    <a href="<?php echo base_url('inc_tax_audits'); ?>"><button type="button" class="waves-effect waves-light btn btn-sm btn-dark" >Back</button></a>
                </div>
                <!-- /.box-header -->
                <!--<div class="box-body wizard-content">-->
                <div class="box-body">
                    <!--<form action="" class="tab-wizard wizard-circle work_data_form" type="POST">-->
                    <form action="" class="work_data_form" type="POST">
                        <!-- Step 1 -->
                        <section>
                            <div class="row">
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientName">Name of Client :</label>
                                                <input type="text" class="form-control" name="clientName" value="<?php echo $workClientName; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="isDocRecvd">Document Received :</label>
                                            </div>
                                            <div class="form-group">
                                                <input name="isDocRecvd" type="radio" id="isDocRecvdYes" class="radio-col-primary is_doc_rec" value="1" <?php if($workArr['isDocRecvd']=="1"): ?>checked<?php endif; ?> />
                                                <label for="isDocRecvdYes">Yes</label>
                                                <input name="isDocRecvd" type="radio" id="isDocRecvdNo" class="radio-col-success is_doc_rec" value="2" <?php if($workArr['isDocRecvd']=="2"): ?>checked<?php endif; ?> />
                                                <label for="isDocRecvdNo">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8" id="doc_date">
                                            <?php
                                                $docRecvdDate="";
                                                if(!empty($workArr['docRecvdDate']) && $workArr['docRecvdDate']!="0000-00-00" && $workArr['docRecvdDate']!="1970-01-01")
                                                    $docRecvdDate=date('Y-m-d', strtotime($workArr['docRecvdDate']));
                                            ?>
                                            <div class="form-group">
                                                <label for="docRecvdDate">Document Received Date :</label>
                                                <input type="date" class="form-control" name="docRecvdDate" id="docRecvdDate" value="<?php echo $docRecvdDate; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="workDone">% Work Done :</label>
                                                <input type="number" class="form-control" name="workDone" id="workDone" value="<?php echo $workArr['workDone']; ?>" onkeypress="validateNum(event)" min="0" max="100"> 
                                            </div>
                                        </div> 	
                                        <div class="col-md-8">
                                            <?php
                                                $signature_date="";
                                                if(!empty($workArr['signature_date']) && $workArr['signature_date']!="0000-00-00" && $workArr['signature_date']!="1970-01-01")
                                                    $signature_date=date('Y-m-d', strtotime($workArr['signature_date']));
                                            ?>
                                            <div class="form-group">
                                                <label for="signature_date">Date Of Signature :</label>
                                                <input type="date" class="form-control" name="signature_date" id="signature_date" value="<?php echo $signature_date; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                                $auditCompletionDate="";
                                                if(!empty($workArr['auditCompletionDate']) && $workArr['auditCompletionDate']!="0000-00-00" && $workArr['auditCompletionDate']!="1970-01-01")
                                                    $auditCompletionDate=date('Y-m-d', strtotime($workArr['auditCompletionDate']));
                                            ?>
                                            <div class="form-group">
                                                <label for="auditCompletionDate">Audit Completion Date :</label>
                                                <input type="date" class="form-control" name="auditCompletionDate" id="auditCompletionDate" value="<?php echo $auditCompletionDate; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Remark</label>
                                                <textarea rows="3" class="form-control" name="remark" id="remark" placeholder="Enter Remark"><?php echo $workArr['remark']; ?></textarea>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-12 hide">
                                            <div class="col-md-12" id="junior_clone">
                                                <div class="row jnr_div">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <select class="custom-select form-control juniorId" name="juniorId[]" >
                                                                <option value="">Select Staff</option>
                                                                <?php if(!empty($getUserList)): ?>
                                                                    <?php foreach($getUserList AS $e_user): ?>
                                                                        <?php //if($e_user['userStaffType']=="6"): ?>
                                                                            <option value="<?php echo $e_user['userId']; ?>" data-id="<?php echo $e_user['userShortName']; ?>"><?php echo $e_user['userFullName']; ?></option>
                                                                        <?php //endif; ?>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="waves-effect waves-light btn btn-danger btn-sm text-right  del_jnr" >Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <!--<label>Junior Allocation:</label>-->
                                                <label>Preparatory:</label>
                                                <select class="custom-select form-control juniorId" name="juniorId[]" >
                                                    <option value="">Select Staff</option>
                                                    <?php if(!empty($getUserList)): ?>
                                                        <?php foreach($getUserList AS $e_user): ?>
                                                            <?php //if($e_user['userStaffType']=="6"): ?>
                                                                <option value="<?php echo $e_user['userId']; ?>" data-id="<?php echo $e_user['userShortName']; ?>"><?php echo $e_user['userFullName']; ?></option>
                                                            <?php //endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" name="Add" class="waves-effect waves-light btn btn-submit text-right mt-20 add_jnr" >Add Staff </button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row form-group junior_div">
                                                <?php if(!empty($jnrList)): ?>
                                                    <?php foreach($jnrList AS $e_jnr): ?>
                                                        <div class="col-md-12">
                                                            <div class="row jnr_div">
                                                                <div class="col-md-2">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <select class="custom-select form-control juniorId" name="juniorId[]" >
                                                                            <option value="">Select Staff</option>
                                                                            <?php if(!empty($getUserList)): ?>
                                                                                <?php foreach($getUserList AS $e_user): ?>
                                                                                    <?php //if($e_user['userStaffType']=="6"): ?>
                                                                                        <?php 
                                                                                            $selJunior="";
                                                                                            if($e_jnr['fkUserId']==$e_user['userId'])
                                                                                                $selJunior="selected";
                                                                                        ?>
                                                                                        <option value="<?php echo $e_user['userId']; ?>"  data-id="<?php echo $e_user['userShortName']; ?>" <?php echo $selJunior; ?> ><?php echo $e_user['userFullName']; ?></option>
                                                                                    <?php //endif; ?>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" class="waves-effect waves-light btn btn-danger text-right btn-sm del_jnr" >Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="seniorId">Finalization/Verification:</label>
                                                <select class="custom-select form-control" name="seniorId" id="seniorId" >
                                                    <option value="">Select Staff</option>
                                                    <?php if(!empty($getUserList)): ?>
                                                        <?php foreach($getUserList AS $e_user): ?>
                                                            <?php //if($e_user['userStaffType']=="5"): ?>
                                                                <?php 
                                                                    $selJunior="";
                                                                    if($workArr['seniorId']==$e_user['userId'])
                                                                        $selJunior="selected";
                                                                ?>
                                                                <option value="<?php echo $e_user['userId']; ?>" <?php echo $selJunior; ?> ><?php echo $e_user['userFullName']; ?></option>
                                                            <?php //endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="udinNo">UDIN No :</label>
                                                <input type="text" class="form-control" name="udinNo" id="udinNo" value="<?php echo $workArr['udinNo']; ?>"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                                $udinDate="";
                                                if(!empty($workArr['udinDate']) && $workArr['udinDate']!="0000-00-00" && $workArr['udinDate']!="1970-01-01")
                                                    $udinDate=date('Y-m-d', strtotime($workArr['udinDate']));
                                            ?>
                                            <div class="form-group">
                                                <label for="udinDate">UDIN Date :</label>
                                                <input type="date" class="form-control" name="udinDate" id="udinDate" value="<?php echo $udinDate; ?>"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="isUrgentWork">Urgent/Important :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" name="isUrgentWork" id="isUrgentWorkYes" class="radio-col-primary" value="1" <?php if($workArr['isUrgentWork']=="1"): ?>checked<?php endif; ?> />
                                                <label for="isUrgentWorkYes">Yes</label>
                                                <input type="radio" name="isUrgentWork" id="isUrgentWorkNo" class="radio-col-success" value="2" <?php if($workArr['isUrgentWork']=="2"): ?>checked<?php endif; ?> />
                                                <label for="isUrgentWorkNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="setPreparedBy">Set Prepared By :</label>
                                                <select class="custom-select form-control" name="setPreparedBy" id="setPreparedBy" >
                                                    <option value="">Select</option>
                                                    <?php if(!empty($getUserList)): ?>
                                                        <?php foreach($getUserList AS $e_user): ?>
                                                                <?php 
                                                                    $selPreparedBy="";
                                                                    if($workArr['set_prepared_by']==$e_user['userId'])
                                                                        $selPreparedBy="selected";
                                                                ?>
                                                                <option value="<?php echo $e_user['userId']; ?>" <?php echo $selPreparedBy; ?> ><?php echo $e_user['userFullName']; ?></option>
                                                            <?php //endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Select Prority<small class="text-danger">*</small></label>
                                                <div class="grid-Wrapper">
                                                    <button type="button" class="clrBtn none <?php if($workArr['workPriority']==1): ?>active<?php endif; ?>" data-clr="none" onclick="ColorPicker(1,'none',this);"></button>
                                                    <button type="button" class="clrBtn yellow <?php if($workArr['workPriority']==2): ?>active<?php endif; ?>" data-clr="yellow" onclick="ColorPicker(2,'yellow',this);"></button>
                                                    <button type="button" class="clrBtn red <?php if($workArr['workPriority']==3): ?>active<?php endif; ?>" data-clr="red" onclick="ColorPicker(3,'red',this);"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-30">
                                    <h4>Billing Details</h4>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="isBillingDone">Billing Done :</label>
                                            </div>
                                            <div class="form-group">
                                                <input name="isBillingDone" type="radio" id="isBillingDoneYes" class="radio-col-primary isBillingDone" value="1" <?php if($workArr['isBillingDone']=="1"): ?>checked<?php endif; ?> />
                                                <label for="isBillingDoneYes">Yes</label>
                                                <input name="isBillingDone" type="radio" id="isBillingDoneNo" class="radio-col-success isBillingDone" value="2" <?php if($workArr['isBillingDone']=="2"): ?>checked<?php endif; ?> />
                                                <label for="isBillingDoneNo">No</label>
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
                                                if(!empty($workArr['billDate']) && $workArr['billDate']!="0000-00-00" && $workArr['billDate']!="1970-01-01")
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
                                                <input type="text" class="form-control" name="billAmt" id="billAmt" placeholder="Enter Bill Amount" value="<?php echo $workArr['billAmt']; ?>">
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
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-30">
                                    <h4>Receipt Details</h4>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="isReceiptDone">Receipt :</label>
                                            </div>
                                            <div class="form-group">
                                                <input name="isReceiptDone" type="radio" id="isReceiptDoneYes" class="radio-col-primary isReceiptDone" value="1" <?php if($workArr['isReceiptDone']=="1"): ?>checked<?php endif; ?> />
                                                <label for="isReceiptDoneYes">Yes</label>
                                                <input name="isReceiptDone" type="radio" id="isReceiptDoneNo" class="radio-col-success isReceiptDone" value="2" <?php if($workArr['isReceiptDone']=="2"): ?>checked<?php endif; ?> />
                                                <label for="isReceiptDoneNo">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 receiptDiv">
                                            <?php
                                                $receiptDate="";
                                                if(!empty($workArr['receiptDate']) && $workArr['receiptDate']!="0000-00-00" && $workArr['receiptDate']!="1970-01-01")
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
                                                <input type="text" class="form-control" name="receiptAmt" id="receiptAmt" placeholder="Enter Receipt Amount" value="<?php echo $workArr['receiptAmt']; ?>">
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
                        </section>
                        <div class="text-right">
                            <hr>
                            <input type="hidden" name="stepData" id="stepData" value="1">
                            <input type="hidden" name="juniors" id="juniors" value="<?php echo $workArr['juniors']; ?>">
                            <input type="hidden" name="juniorIds" id="juniorIds" value="">
                            <input type="hidden" name="workId" id="workId" value="<?php echo $workId; ?>">
                            <input type="hidden" name="workPriority" id="workPriority" value="<?= $workArr['workPriority']; ?>" />
                            <input type="hidden" name="workPriorityColor" id="workPriorityColor" value="<?= $workArr['workPriorityColor']; ?>" />
                            <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button>
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
        
        $('input:radio[name="isDefectiveReturn"]').on('click', function(){
            
            var dect_return = $(this).val();
            
            if(dect_return=="1")
                $('.dect_return').show();
            else if(dect_return=="2")
                $('.dect_return').hide();
            
        });
        
        $('.dect_return').hide();
        $('#defectiveRectifiedCommentDiv').hide();
        
        $('.def_rect').on('click', function(){
            
            var def_rect = $(this).val();
            
            if(def_rect=="1")
                $('#defectiveRectifiedCommentDiv').show();
            else if(def_rect=="2")
                $('#defectiveRectifiedCommentDiv').hide();
            
        });

        var selectedJnrText = "";
        var selectedJnrArr = [];
        var selectedJnrIds = [];

        $('body').on('change', '.juniorId', function(){

            selectedJnrText = "";
            selectedJnrArr = [];
            selectedJnrIds = [];

            $(".juniorId option:selected").each(function(){

                if($(this).val()!="")
                {
                    // var jnrText=$(this).text();
                    var jnrText=$(this).data('id');
                    selectedJnrArr.push(jnrText);
                    selectedJnrIds.push($(this).val());
                }
                
            });
            console.log(selectedJnrArr);
            
            selectedJnrText=selectedJnrArr.join(', ');
            selectedJnrIdsText=selectedJnrIds.join(', ');

            console.log(selectedJnrText);

            $('#juniors').val(selectedJnrText);
            $('#juniorIds').val(selectedJnrIdsText);
        });

        $('.juniorId').trigger('change');

        $('.wizard-content .wizard > .actions > ul').append('<li><button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button></li>');
        
        $('.wizard-content .wizard > .actions > ul li:nth-child(3)').remove();

        // $('.wizard-content .wizard > .actions > ul li:nth-child(3)').addClass('submit_client');
    
        
        // $('body').on('click', '.steps li', function(){
            
        //     if($(this).hasClass('last'))
        //     {
        //         $('.extra_sub_btn').hide();
        //     }
        //     else
        //     {
        //         $('.extra_sub_btn').show();
        //     }
            
        // });

        $('#refundDue').on('keyup', function(){
            $('#refundDueVal').val($(this).val());
        });
        
        $('.add_jnr').on('click', function(){
            var junior_clone = $('#junior_clone').clone();
            $('.junior_div').append(junior_clone);
        });

        $('body').on('click', '.del_jnr', function(){
            $(this).parents('.jnr_div').remove();
        });
        
        $('.steps ul li:not(:first)').removeClass('disabled');
        $('.steps ul li:not(:first)').addClass('done');
        
        // $('.wizard-content .wizard > .actions').hide();
        $('.wizard-content .wizard > .actions > ul').css('margin-right', '40%');

        $('.theme-primary .wizard-content .wizard > .steps > ul > li').on('click', function(){
            $('#stepData').val($(this).find('.step').text());
        });

        // $('body').on('click', '.extra_sub_btn', function(){
        //     alert('das');
        //     $('.work_data_form').submit();
        // });

        $('body').on('submit', '.work_data_form', function(e){

            e.preventDefault();
            var workFormData = $('.work_data_form').serializeArray();

            // $('.work_data_form').submit();

            var indexed_array = {};
        
            $.map(workFormData, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            var postingUrl = base_url+'/income_tax/audit_work_form/'+workId;

            $.post(postingUrl,indexed_array, function(data, status){
                window.location.href=postingUrl;
            });

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
        
        $('.def_rect:checked').trigger('click');
        $('.is_doc_rec:checked').trigger('click');
        $('.isBillingDone:checked').trigger('click');
        $('.isReceiptDone:checked').trigger('click');
    });

</script>
<script>
    var valId,x,y,i;
    
    function ColorPicker(valId,x,y){
        var val= y.innerHTML;
        
        var activeState = document.getElementsByClassName("clrBtn");
        console.log(activeState);
        for(i=0; i<activeState.length; i++){
            // console.log(activeState)+1;
            activeState[i].classList.remove('active');
        }
        y.classList.add('active');
        
        var clr = $(y).data('clr');
        $('#workPriorityColor').val(clr);
        $('#workPriority').val(valId);
       
    }
</script>

<?= $this->endSection(); ?>