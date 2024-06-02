<?php $currentDate = date('Y-m-d'); ?>
<?php $currentTime = date('h:i A'); ?>

<?php if(!empty($empAttendArray)): ?>
    <?php foreach($empAttendArray AS $k_row => $e_row): ?>
    
    <?php
        $isEndTimeReqd = false;
        
        if($e_row['attendanceDate']<$currentDate)
        {
            $isEndTimeReqd = true;
        }
    ?>
    
    <!-- Modal -->
    <div id="editEmpAttendModal<?php echo $k_row; ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo base_url('edit-employee-attendance'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Attendance</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row attendanceForm<?= $k_row; ?>">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Date<small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="attendanceDate" value="<?= $e_row['attendanceDate']; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group mb-0">
                                    <label for="attendanceStatus">Status:</label>
                                </div>
                                <div class="form-group mt-0 attendanceStatusDiv" data-id="<?= $k_row; ?>">
                                    <?php $attendanceStatus = (isset($e_row['attendanceStatus'])) ? $e_row['attendanceStatus'] : "1" ?>
                                    <input type="radio" name="attendanceStatus" id="attendanceStatusPresent<?= $k_row; ?>" class="radio-col-primary attendanceStatus" value="1" <?php if($attendanceStatus=="1"): ?>checked<?php endif; ?> />
                                    <label class="font-weight-normal" for="attendanceStatusPresent<?= $k_row; ?>">Present</label>
                                    <input type="radio" name="attendanceStatus" id="attendanceStatusAbsent<?= $k_row; ?>" class="radio-col-primary attendanceStatus" value="2" <?php if($attendanceStatus=="2"): ?>checked<?php endif; ?> />
                                    <label for="attendanceStatusAbsent<?= $k_row; ?>">Absent</label>
                                    <input type="radio" name="attendanceStatus" id="attendanceStatusLeave<?= $k_row; ?>" class="radio-col-primary attendanceStatus" value="3" <?php if($attendanceStatus=="3"): ?>checked<?php endif; ?> />
                                    <label for="attendanceStatusLeave<?= $k_row; ?>">Leave</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group bootstrap-timepicker">
                                    <div class="form-group mb-0">
                                        <label>In Time<small class="text-danger">*</small></label>
                                        <input type="checkbox" id="setEditInTime<?= $k_row; ?>" class="radio-col-success setEditInTime" data-id="<?= $k_row; ?>" >
                                        <label for="setEditInTime<?= $k_row; ?>">
                                            <span class="font-weight-light">Set Current Time<span>
                                        </label>
                                    </div>
                                    <div class="input-group">
                						<div class="input-group-addon">
                						  <i class="fa fa-clock-o"></i>
                						</div>
                                        <?php $inTime = (!empty($e_row['inTime'])) ? date('h:i A', strtotime($e_row['inTime'])) : ""; ?>
                                        <input type="text" class="form-control editTimepicker editInTimeInput<?= $k_row; ?>" name="inTime" id="inTime" placeholder="Enter In Time" value="<?= $inTime; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group bootstrap-timepicker">
                                    <div class="form-group mb-0">
                                        <label>Out Time <?php if($isEndTimeReqd): ?><small class="text-danger">*</small><?php endif; ?></label>
                                        <input type="checkbox" id="setEditOutTime<?= $k_row; ?>" class="radio-col-success setEditOutTime" data-id="<?= $k_row; ?>">
                                        <label for="setEditOutTime<?= $k_row; ?>">
                                            <span class="font-weight-light">Set Current Time<span>
                                        </label>
                                    </div>
                                    <div class="input-group">
                						<div class="input-group-addon">
                						  <i class="fa fa-clock-o"></i>
                						</div>
                                        <?php $outTime = (!empty($e_row['outTime'])) ? date('h:i A', strtotime($e_row['outTime'])) : ""; ?>
                                        <input type="text" class="form-control editTimepicker editOutTimeInput<?= $k_row; ?>" name="outTime" id="outTime" placeholder="Enter Out Time" value="<?= $outTime; ?>" <?php if($isEndTimeReqd): ?>required<?php endif; ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Work Place</label>
                                    <input type="text" class="form-control workPlace" name="workPlace" value="<?= (isset($e_row['workPlace'])) ? $e_row['workPlace'] : ""; ?>" maxlength="18" >
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" rows="2" ><?= (isset($e_row['remarks'])) ? $e_row['remarks'] : ""; ?></textarea>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="userId" value="<?= $userId; ?>">
                        <?php $employeeAttendanceId = (!empty($e_row['employeeAttendanceId'])) ? $e_row['employeeAttendanceId'] : ""; ?>
                        <input type="hidden" name="employeeAttendanceId" id="employeeAttendanceId" value="<?= $employeeAttendanceId; ?>" />
                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <?php endforeach; ?>
<?php endif; ?>

<!-- Modal -->
<div id="addEmpAttendModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo base_url('add-employee-attendance'); ?>" method="POST" enctype="multipart/form-data" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Attendance</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date<small class="text-danger">*</small></label>
                                <input type="date" class="form-control" name="attendanceDate" value="<?= date('Y-m-d'); ?>" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="attendanceStatus">Status:</label>
                            </div>
                            <div class="form-group mt-0">
                                <?php $attendanceStatus = (isset($e_row['attendanceStatus'])) ? $e_row['attendanceStatus'] : "" ?>
                                <input type="radio" name="attendanceStatus" id="attendanceStatusPresent" class="radio-col-primary" value="1" checked />
                                <label for="attendanceStatusPresent">Present</label>
                                <input type="radio" name="attendanceStatus" id="attendanceStatusAbsent" class="radio-col-primary" value="2" />
                                <label for="attendanceStatusAbsent">Absent</label>
                                <input type="radio" name="attendanceStatus" id="attendanceStatusLeave" class="radio-col-primary" value="3"  />
                                <label for="attendanceStatusLeave">Leave</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group bootstrap-timepicker">
                                <div class="form-group mb-0">
                                    <label>In Time<small class="text-danger">*</small></label>
                                    <input type="checkbox" id="setAddInTime" class="radio-col-success">
                                    <label for="setAddInTime">
                                        <span class="font-weight-light">Set Current Time<span>
                                    </label>
                                </div>
                                <div class="input-group">
            						<div class="input-group-addon">
            						  <i class="fa fa-clock-o"></i>
            						</div>
                                    <input type="text" class="form-control timepicker addInTime addInTimeInput" name="inTime" id="inTime" placeholder="Enter In Time"  value="<?= $currentTime; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group bootstrap-timepicker">
                                <div class="form-group mb-0">
                                    <label>Out Time</label>
                                    <input type="checkbox" id="setAddOutTime" class="radio-col-success">
                                    <label for="setAddOutTime">
                                        <span class="font-weight-light">Set Current Time<span>
                                    </label>
                                </div>
                                <div class="input-group">
            						<div class="input-group-addon">
            						  <i class="fa fa-clock-o"></i>
            						</div>
                                    <input type="text" class="form-control timepicker addOutTime addOutTimeInput" name="outTime" id="outTime" placeholder="Enter Out Time" value="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Work Place</label>
                                <input type="text" class="form-control workPlace" name="workPlace" value="Office" maxlength="18" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" rows="2" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="userId" id="userId" value="<?= $userId; ?>">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(document).ready(function(){
        
        var selMth = "<?= $mth; ?>";
        
        $('.attendanceStatusDiv .attendanceStatus').on('change', function () {
            
            var attendanceStatus = $(this).val();
            
            var attendanceId = $(this).parents('.attendanceStatusDiv').data('id');
            
            var attendanceForm = ".attendanceForm"+attendanceId;
            
            $(attendanceForm+' .editTimepicker').prop('disabled', false);
            var workPlaceVal = $(attendanceForm+' .workPlace').val();
            $(attendanceForm+' .workPlace').val(workPlaceVal);
            $(attendanceForm+' .workPlace').prop('readonly', false);
            
            if(attendanceStatus!=1)
            {
                var attendanceStatusText = "";
                
                if(attendanceStatus==2)
                    attendanceStatusText = "Absent";
                else if(attendanceStatus==3)
                    attendanceStatusText = "Leave";
                    
                $(attendanceForm+' .editTimepicker').prop('disabled', true);
                $(attendanceForm+' .workPlace').val(attendanceStatusText);
                $(attendanceForm+' .workPlace').prop('readonly', true);
            }
        });
        
        $('input:radio[name="attendanceStatus"]').on('change', function () {
            
            var attendanceStatus = $(this).val();
            
            $('.timepicker').prop('disabled', false);
            $('.workPlace').val('Office');
            $('.workPlace').prop('readonly', false);
            
            if(attendanceStatus!=1)
            {
                var attendanceStatusText = "";
                
                if(attendanceStatus==2)
                    attendanceStatusText = "Absent";
                else if(attendanceStatus==3)
                    attendanceStatusText = "Leave";
                    
                $('.timepicker').prop('disabled', true);
                $('.workPlace').val(attendanceStatusText);
                $('.workPlace').prop('readonly', true);
            }
        });
        
        $('#selMthAttend').on('change', function () {
            
            var base_url = "<?php echo base_url(); ?>";
            var userId = $('#userId').val();
            var mth = $(this).val();

            window.location.href=base_url+"/employee-attendance/"+userId+"/"+mth;

        });
        
        $('.deleteEmpAttend').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var employeeAttendanceId = $(this).data('id');
            var userId = $('#userId').val();

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/delete-employee-attendance';
                    $.post(postingUrl, 
                    {
                        employeeAttendanceId: employeeAttendanceId
                    },
                    function(data, status){
                        window.location.href=base_url+"/employee-attendance/"+userId+"/"+selMth;
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        setTimeout(function(){
            $('.addOutTime').val("");
        }, 1000)
        
        $('.attendanceStatusDiv .attendanceStatus:checked').trigger('change');
    });
</script>