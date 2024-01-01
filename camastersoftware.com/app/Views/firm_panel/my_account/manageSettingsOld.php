<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .box-body {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        /*margin-top: 20px !important;*/
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
</style>


<!-- Main content -->
<section class="content mt-35">
    <div class="row">

        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('home'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?= base_url('updateSettings'); ?>" method="post">
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label class="mb-0">Holidays:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group mb-0">
                                                <div class="demo-checkbox">
                                                    <div class="form-group">
                                                        <input type="checkbox" name='showHolidays' id="showHolidays" class="filled-in acts_checkbox" value="1" <?php if($settingsArr['showHolidays']==1): ?>checked<?php endif; ?> />
                                                        <label for="showHolidays" class="mb-0">Holidays</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label class="mb-0">Clients:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group mb-0">
                                                <div class="demo-checkbox">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="checkbox" name='showClientBirthday' id="showClientBirthday" class="filled-in" value="1" <?php if($settingsArr['showClientBirthday']==1): ?>checked<?php endif; ?> />
                                                            <label for="showClientBirthday" class="mb-0">Clients</label>	
                                                        </div>
                                                        <div class="col-md-12" <?php if($settingsArr['showClientBirthday']==2): ?>style="display:none;"<?php endif; ?> id="clientTypeDiv">
                                                            <div class="form-group">
                                                                <input name="clientType" type="radio" id="clientTypePresent" class="radio-col-primary" value="1" <?php if($settingsArr['clientType']=="1"): ?>checked<?php endif; ?> />
                                                                <label for="clientTypePresent" class="mb-0">Present Clients</label>
                                                                <input name="clientType" type="radio" id="clientTypeAll" class="radio-col-primary" value="2" <?php if($settingsArr['clientType']=="2"): ?>checked<?php endif; ?> />
                                                                <label for="clientTypeAll" class="mb-0">All Clients</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label class="mb-0">Staff:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group mb-0">
                                                <div class="demo-checkbox">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="checkbox" name='showStaffBirthday' id="showStaffBirthday" class="filled-in acts_checkbox" value="1" <?php if($settingsArr['showStaffBirthday']==1): ?>checked<?php endif; ?> />
                                                            <label for="showStaffBirthday" class="mb-0">Staff</label>	
                                                        </div>
                                                        <div class="col-md-12" <?php if($settingsArr['showStaffBirthday']==2): ?>style="display:none;"<?php endif; ?> id="staffTypeDiv">
                                                            <div class="form-group">
                                                                <input name="staffType" type="radio" id="staffTypePresent" class="radio-col-primary" value="1" <?php if($settingsArr['staffType']=="1"): ?>checked<?php endif; ?> />
                                                                <label for="staffTypePresent">Present Staff</label>
                                                                <input name="staffType" type="radio" id="staffTypeAll" class="radio-col-primary" value="2" <?php if($settingsArr['staffType']=="2"): ?>checked<?php endif; ?> />
                                                                <label for="staffTypeAll">All Staff</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0 text-center">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name='configId' value="<?= $settingsArr['configId']; ?>" />
                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-sm btn-submit">Submit</button>
                                        <a href="<?php echo base_url('home'); ?>">
                                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                                        </a>
                                    </div>
                                </div>    
                            </div>
                            <!--<div class="row">-->
                                
                            <!--</div>-->
                        </section>
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

<script>
    
    $(document).ready(function(){
        
        $('#showClientBirthday').on('change', function(){
            
            if($(this).is(':checked')){
                $('#clientTypeDiv').show();
            }else{
                $('#clientTypeDiv').hide();
            }
            
        });
        
        $('#showStaffBirthday').on('change', function(){
            
            if($(this).is(':checked')){
                $('#staffTypeDiv').show();
            }else{
                $('#staffTypeDiv').hide();
            }
            
        });
        
        $('#showClientBirthday:checked').trigger('change');
        $('#showStaffBirthday:checked').trigger('change');
        
    });
    
</script>

<?= $this->endSection(); ?>