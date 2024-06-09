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
                        <a href="<?php echo base_url('manageSettings'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?= base_url('update-hr-settings'); ?>" method="post">
                        <section>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label class="mb-0">Year:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <select class="form-control" name="year" id="currCalYear" onchange="searchCalYear(this);" required>
                                                <option value="">Select Year</option>
                                                <?php for($yr=2017; $yr<=$currCalYear; $yr++): ?>
                                                    <option value="<?= $yr; ?>" <?php if($yr==$calYear): ?>selected<?php endif; ?> ><?= $yr; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label class="mb-0">Office Timing:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <div class="form-group bootstrap-timepicker">
                                                <label>From<small class="text-danger">*</small></label>
                                                <div class="input-group">
                            						<div class="input-group-addon">
                            						  <i class="fa fa-clock-o"></i>
                            						</div>
                                                    <?php $officeStartTime = (!empty($settingsArr['officeStartTime'])) ? date('h:i A', strtotime($settingsArr['officeStartTime'])) : ""; ?>
                                                    <input type="text" class="form-control editTimepicker" name="officeStartTime" id="officeStartTime" placeholder="Enter From Time" value="<?= $officeStartTime; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <div class="form-group bootstrap-timepicker">
                                                <label>To<small class="text-danger">*</small></label>
                                                <div class="input-group">
                            						<div class="input-group-addon">
                            						  <i class="fa fa-clock-o"></i>
                            						</div>
                                                    <?php $officeEndTime = (!empty($settingsArr['officeEndTime'])) ? date('h:i A', strtotime($settingsArr['officeEndTime'])) : ""; ?>
                                                    <input type="text" class="form-control editTimepicker" name="officeEndTime" id="officeEndTime" placeholder="Enter To Time" value="<?= $officeEndTime; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label class="mb-0">Half-Day Timing:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <div class="form-group bootstrap-timepicker">
                                                <label>From<small class="text-danger">*</small></label>
                                                <div class="input-group">
                            						<div class="input-group-addon">
                            						    <i class="fa fa-clock-o"></i>
                            						</div>
                                                    <?php $halfDayStartTime = (!empty($settingsArr['halfDayStartTime'])) ? date('h:i A', strtotime($settingsArr['halfDayStartTime'])) : ""; ?>
                                                    <input type="text" class="form-control editTimepicker" name="halfDayStartTime" id="halfDayStartTime" placeholder="Enter From Time" value="<?= $halfDayStartTime; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <div class="form-group bootstrap-timepicker">
                                                <label>To<small class="text-danger">*</small></label>
                                                <div class="input-group">
                            						<div class="input-group-addon">
                            						    <i class="fa fa-clock-o"></i>
                            						</div>
                                                    <?php $halfDayEndTime = (!empty($settingsArr['halfDayEndTime'])) ? date('h:i A', strtotime($settingsArr['halfDayEndTime'])) : ""; ?>
                                                    <input type="text" class="form-control editTimepicker" name="halfDayEndTime" id="halfDayEndTime" placeholder="Enter To Time" value="<?= $halfDayEndTime; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label class="mb-0">Notes:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-8">
                                            <?php $scheduleNotes = (!empty($settingsArr['scheduleNotes'])) ? $settingsArr['scheduleNotes'] : ""; ?>
                                            <textarea class="form-control" name="scheduleNotes" id="scheduleNotes" placeholder="Enter Notes" rows="10"><?= $scheduleNotes; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0 text-center">
                                        <?= csrf_field() ?>
                                        <?php $calender_year_config_id = (!empty($settingsArr['calender_year_config_id'])) ? $settingsArr['calender_year_config_id'] : ""; ?>
                                        <input type="hidden" name='configId' value="<?= $calender_year_config_id; ?>" />
                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-sm btn-submit">Submit</button>
                                        <a href="<?php echo base_url('manageSettings'); ?>">
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
        initializeTimepicker(minuteStep=1);
    });
    function initializeTimepicker(minuteStep) {
        $('.editTimepicker').timepicker({
            'showInputs': false,
            'minuteStep': minuteStep,
            'defaultTime': false
        });
    }
</script>

<script type="text/javascript">
    
    var base_url = "<?= base_url(); ?>";
    
    function searchCalYear($this)
    {
        var calYr=$this.value;
        
        window.location.href=base_url+"/hr-settings?calYear="+calYr;
    }

</script>

<?= $this->endSection(); ?>