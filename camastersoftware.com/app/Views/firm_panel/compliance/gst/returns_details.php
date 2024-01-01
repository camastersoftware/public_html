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
        font-size: 13px;
    }
    
    .tablepress tbody {
        font-size: 13px;
    }
    
    td.column-1 {
        text-align: center;
        font-weight: normal;
        font-size: 13px;
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
</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h4>
                    <a href="<?php echo base_url('gst_returns'); ?>"><button type="button" class="waves-effect waves-light btn btn-sm btn-dark" style="">Back</button></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo base_url('update_return_work'); ?>" class="work_data_form" method="POST">
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
                                    
                                    <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="isUrgentWork">Urgent Work :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" name="isUrgentWork" id="isUrgentWorkYes" class="radio-col-primary" value="1" <?php if($workArr['isUrgentWork']=="1"): ?>checked<?php endif; ?> />
                                                <label for="isUrgentWorkYes">Yes</label>
                                                <input type="radio" name="isUrgentWork" id="isUrgentWorkNo" class="radio-col-success" value="2" <?php if($workArr['isUrgentWork']=="2"): ?>checked<?php endif; ?> />
                                                <label for="isUrgentWorkNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h4> Work Completion</h4>
                        <section>
                            <hr>
                            <div class="row">
                                <hr>
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-8" id="">
                                            <div class="form-group">
                                                <?php
                                                    $eFillingDate="";
                                                    if(!empty($workArr['eFillingDate']) && $workArr['eFillingDate']!="0000-00-00" && $workArr['eFillingDate']!="1970-01-01")
                                                        $eFillingDate=date('Y-m-d', strtotime($workArr['eFillingDate']));
                                                ?>
                                                <label for="eFillingDate">E-Filling Date :</label>
                                                <input type="date" class="form-control" name="eFillingDate" id="eFillingDate" value="<?php echo $eFillingDate; ?>" > 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="verificationDoneBy">Set Prepared By :</label>
                                                <input type="text" class="form-control" name="setPreparedBy" id="setPreparedBy" value="<?php echo $workArr['set_prepared_by']; ?>">
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="acknowledgmentNo">Acknowledgment No :</label>
                                                <input type="text" class="form-control" name="acknowledgmentNo" id="acknowledgmentNo"  value="<?php echo $workArr['acknowledgmentNo']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Comment</label>
                                                <textarea rows="5" class="form-control" name="defectiveReturnComment" placeholder="Enter Comment"><?php echo $workArr['defectiveReturnComment']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $due_date_id=$workArr['due_date_id']; ?>
                            <?php $periodicity=$workArr['periodicity']; ?>
                            <?php $period_month=$workArr['period_month']; ?>
                            <?php $f_period_month=$workArr['f_period_month']; ?>
                            <?php $f_period_year=$workArr['f_period_year']; ?>
                            <?php $t_period_month=$workArr['t_period_month']; ?>
                            <?php $t_period_year=$workArr['t_period_year']; ?>
                            
                            <input type="hidden" name="due_date_id" value="<?php echo $due_date_id; ?>">
                            <input type="hidden" name="periodicity" value="<?php echo $periodicity; ?>">
                            <input type="hidden" name="period_month" value="<?php echo $period_month; ?>">
                            
                        </section>
                        <!-- Step 3 -->
                        <br>
                        
                        <div class="text-right">
                            <hr>
                            <input type="hidden" name="juniors" id="juniors" value="<?php echo $workArr['juniors']; ?>">
                            <input type="hidden" name="juniorIds" id="juniorIds" value="">
                            <input type="hidden" name="workId" id="workId" value="<?php echo $workId; ?>">
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
        
        $('.add_jnr').on('click', function(){
            var junior_clone = $('#junior_clone').clone();
            $('.junior_div').append(junior_clone);
        });

        $('body').on('click', '.del_jnr', function(){
            $(this).parents('.jnr_div').remove();
        });
        
        $('.is_doc_rec:checked').trigger('click');
    });
    
    function calSumAmt(month, fieldName)
    {
        var field = month+"_"+fieldName;
        var inputField = "."+field;
        var sumField = ".sum_"+field;
        
        var sumVal = 0;
        $(inputField).each(function(){
            sumVal += Number($(this).val());
        });
        
        $(sumField).val(sumVal.toFixed(2));
    }

</script>

<?= $this->endSection(); ?>