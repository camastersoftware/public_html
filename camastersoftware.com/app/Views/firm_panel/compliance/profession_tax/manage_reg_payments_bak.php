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
                    <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h4>
                    <button type="button" class="waves-effect waves-light btn btn-sm btn-dark get_back" style="">Back</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <!--<div class="box-body">-->
                    <form action="<?= base_url('update-pt-reg-payments'); ?>" method="POST">
                        <div class="row form-group">
                            <div class="col-md-12 col-lg-12 text-center">
                                <span class="font-weight-bold h4" >
                                    <?= $workClientName; ?>
                                </span>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
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
                                                                    <option value="<?php echo $e_user['userId']; ?>" data-id="<?php echo $e_user['userShortName']; ?>"><?php echo $e_user['userFullName']; ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="waves-effect waves-light btn btn-danger btn-sm text-right del_jnr" >Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Preparatory:</label>
                                            <select class="custom-select form-control juniorId" name="juniorId[]" >
                                                <option value="">Select Staff</option>
                                                <?php if(!empty($getUserList)): ?>
                                                    <?php foreach($getUserList AS $e_user): ?>
                                                        <option value="<?php echo $e_user['userId']; ?>" data-id="<?php echo $e_user['userShortName']; ?>"><?php echo $e_user['userFullName']; ?></option>
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
                                                                                <?php 
                                                                                    $selJunior="";
                                                                                    if($e_jnr['fkUserId']==$e_user['userId'])
                                                                                        $selJunior="selected";
                                                                                ?>
                                                                                <option value="<?php echo $e_user['userId']; ?>" data-id="<?php echo $e_user['userShortName']; ?>" <?php echo $selJunior; ?> ><?php echo $e_user['userFullName']; ?></option>
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
                            </div>
                            <div class="col-md-6">
                                <div class="row">
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
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="pt_enrol_amt_paid">Amount Paid :</label>
                                            <input type="text" class="form-control" name="pt_enrol_amt_paid" id="pt_enrol_amt_paid" value="<?php echo $workArr['pt_enrol_amt_paid']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="pt_enrol_paid_on">Paid On :</label>
                                            <input type="date" class="form-control" name="pt_enrol_paid_on" id="pt_enrol_paid_on" value="<?php echo $workArr['pt_enrol_paid_on']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="pt_enrol_pmt_mode">Mode :</label>
                                            <select class="custom-select form-control" name="pt_enrol_pmt_mode" id="pt_enrol_pmt_mode" >
                                                <option value="">Select</option>
                                                <?php if(!empty($pmtModes)): ?>
                                                    <?php foreach($pmtModes AS $e_mode): ?>
                                                        <?php 
                                                            $selPmtMode="";
                                                            if($workArr['pt_enrol_pmt_mode']==$e_mode['id'])
                                                                $selPmtMode="selected";
                                                        ?>
                                                        <option value="<?php echo $e_mode['id']; ?>" <?php echo $selPmtMode; ?> ><?php echo $e_mode['name']; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="workRemark">Remark :</label>
                                            <textarea class="form-control" name="workRemark" id="workRemark"><?php echo $workArr['workRemark']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-30 text-center">
                                <input type="hidden" name="juniors" id="juniors" value="<?php echo $workArr['juniors']; ?>">
                                <input type="hidden" name="juniorIds" id="juniorIds" value="">
                                <input type="hidden" name="workId" id="workId" value="<?php echo $workArr['workId']; ?>">
                                <button type="button" class="waves-effect waves-light btn btn-dark get_back">Back</button>
                                <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button>
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

        $('#refundDue').on('keyup', function(){
            $('#refundDueVal').val($(this).val());
        });
        
        $('.add_jnr').on('click', function(){
            var junior_clone = $('#junior_clone').clone();
            $('.junior_div').append(junior_clone);
        });

        $('body').on('click', '.del_jnr', function(){
            $(this).parents('.jnr_div').remove();
            
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
    });

</script>


<?= $this->endSection(); ?>