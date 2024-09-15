<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
    .modal-header {
        border-bottom-color: #d5dfea;
        background-color:#F99D27;
        padding: 8px 8px;
    }

    .income-tax-head {
        background: #ffc800;
        padding:10px;
        margin-bottom:0px;
        font-weight:bold;
    }

    table.dataTable {
        margin-top: 0px !important; 
    }

    .tablepress td, .tablepress th {
        font-weight: 600;
    }

    td.column-1 {
        font-size:14px;
    }

    .tablepress tbody tr:first-child td {
        background: #ffffff;
    }

    .modal-header h4{
        text-align: center;
    }

    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
    }
    
    .getActModal .box{
        cursor: pointer !important;
    }
    
    .table-responsive table thead tr{
        background: #005495 !important;
        color: #fff !important;
    }
    
    .table-responsive table tbody tr{
        background: #96c7f242 !important;
    }
    
    .table-responsive tr th{
        border: 1px solid #fff !important;
    }
    
    .table-responsive tr td{
        border: 1px solid #015aacab !important;
    }
    
    table.dataTable {
        border-collapse: collapse !important;
        font-size: 16px !important;
    }
    
    .table > tbody > tr > td, .table > tbody > tr > th {
        padding: 0px 14px !important;
    }
    
    .btnPrimClr {
        margin-top: 5px !important;
        height: 30px !important;
        margin-bottom: 5px !important;
    }
    
    .box_body_bg {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        /*border-radius: 10px;*/
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        /*margin-top: 20px !important;*/
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
    
    .tablepress td {
        font-weight: 400 !important;
    }
    
    .tablepress thead th {
        background-color: #005495 !important;
    }
    
    .demo-checkbox .box-header {
        background-color: #005495 !important;
        border-radius: 10px !important;
    }
    
    .demo-checkbox .box-header.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
    }
    
    .dataTables_wrapper .form-control{
        margin: 0px !important;
    }
    
    .discontinueClass td {
      color: #9d9c97 !important;
    }
    
    .todayAttend{
        background: #11589742 !important;
    }
    
</style>

<?php $currentDate = date('Y-m-d'); ?>
<?php $currentTime = date('h:i A'); ?>

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold">
                                <?= $pageTitle; ?>
                            </h4>
                        </div>
                        <div class="col-6 text-right">
                            <select class="custom-select form-control col-md-3" id="selMthAttend">
                                <option value="">Select Month</option>
                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                    <?php
                                        if($m_no<=9)
                                        {
                                            $m=$m_no+3;
                                            $yr=$fromYr;
                                        }
                                        else
                                        {
                                            $m=$m_no-9;
                                            $yr=$toYr;
                                        }
                                    ?>
                                    <option value="<?php echo $m; ?>" <?php if($m==$mth): ?>selected<?php endif; ?> >
                                        <?php echo date('F', strtotime("2021-".$m."-1"))."-".$yr; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                            &nbsp;&nbsp;
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark get_back" style="">Back</button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group mb-2">
                                <div class="col-md-12 col-lg-12 text-center">
                                    <h3 class="font-weight-bold m-0" >
                                        <?php 
                                            if(!empty($staffData['userFullName']))
                                                echo $staffData['userFullName'];
                                            else 
                                                echo "-"; 
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row form-group mb-2">
                                <div class="col-md-12 col-lg-12 text-center">
                                    <h4 class="font-weight-bold m-0" >
                                        <?= date('F', strtotime("2021-".$mth."-1"))."-".$selYr; ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="onlyTableIdNoSortBy table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">SN</th>
                                            <th width="5%">Date</th>
                                            <th width="5%">Client&nbsp;Name</th>
                                            <th width="5%">Due&nbsp;Date</th>
                                            <th width="5%">Due&nbsp;Date&nbsp;For</th>
                                            <th width="5%">Act</th>
                                            <th width="5%">Form</th>
                                            <th width="5%">Period</th>
                                            <th width="5%">Start&nbsp;Time</th>
                                            <th width="5%">End&nbsp;Time</th>
                                            <th width="5%">Hrs</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        <?php $currVal=""; ?>
                                        <?php $nextVal=""; ?>
                                        <?php $sumTotalHrs=0; ?>
                                        <?php if(!empty($timeSheetArr)): ?>
                                            <?php foreach($timeSheetArr AS $k_row => $e_row): ?>
                                                <?php 
                                                    if(check_valid_date($e_row['tsWorkingDate']))
                                                        $tsWorkingDate=date('d-m-Y', strtotime($e_row['tsWorkingDate']));
                                                    else 
                                                        $tsWorkingDate="";
                                                        
                                                    $dayNo=date('N', strtotime($tsWorkingDate));
                                                    $currVal=$tsWorkingDate;
                                                    if(!empty($timeSheetArr[$k_row+1]['tsWorkingDate'])){
                                                        $nextDateVal=$timeSheetArr[$k_row+1]['tsWorkingDate'];
                                                        if(check_valid_date($nextDateVal)){
                                                            $nextVal=date('d-m-Y', strtotime($nextDateVal));
                                                        }
                                                    }
                                                ?>
                                                <?php
                                                    $clientBussOrgType=$e_row['clientBussOrganisationType'];

                                                    if(in_array($clientBussOrgType, INDIVIDUAL_ARRAY))
                                                        $workClientName=(!empty($e_row['clientName'])) ? $e_row['clientName']:"";
                                                    else
                                                        $workClientName=(!empty($e_row['clientBussOrganisation'])) ? $e_row['clientBussOrganisation']:"";

                                                    if(check_valid_date($e_row['extended_date']))
                                                        $dueDate=date('d-m-Y', strtotime($e_row['extended_date']));
                                                    else 
                                                        $dueDate="";

                                                    $periodicity_name=$e_row['periodicity_name'];
                                                    $periodicity=$e_row['periodicity'];

                                                    $DDPeriod = "";

                                                    if(!empty($periodicity))
                                                    {
                                                        if($periodicity==1)
                                                        {
                                                            $DDPeriod = date("d-M-Y", strtotime($e_row["daily_date"]));
                                                        }
                                                        elseif($periodicity==2)
                                                        {
                                                            $DDPeriod = date("M", strtotime("2021-".$e_row["period_month"]."-01"))."-".$e_row["period_year"];
                                                        }
                                                        elseif($periodicity>=3)
                                                        {
                                                            $DDPeriod = date("M", strtotime("2021-".$e_row["f_period_month"]."-01"))."-".$e_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_row["t_period_month"]."-01"))."-".$e_row["t_period_year"];
                                                        }
                                                    }
                                                    $totalHrs = (!empty($e_row['tsTotalHours'])) ? (float)$e_row['tsTotalHours'] : 0;
                                                    $sumTotalHrs+=$totalHrs;
                                                ?>
                                                <tr>
                                                    <td class="text-center" width="5%">
                                                        <?= $i; ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($tsWorkingDate))
                                                                echo $tsWorkingDate;
                                                            else 
                                                                echo "-";
                                                        ?>
                                                    </td>
                                                    <td width="5%" nowrap>
                                                        <span <?php if(!empty($workClientName) && strlen($workClientName)>15): ?> data-toggle="tooltip" data-original-title="<?= $workClientName; ?>" style="cursor: pointer;" <?php endif; ?>>
                                                            <?php 
                                                                if(!empty($workClientName))
                                                                {
                                                                    if(strlen($workClientName)>15)
                                                                    {
                                                                        echo substr($workClientName, 0, 15)."...";
                                                                    }
                                                                    else
                                                                    {
                                                                        echo $workClientName;
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    echo "-";
                                                                }
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($dueDate))
                                                                echo $dueDate;
                                                            else 
                                                                echo "-";
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <span <?php if(!empty($e_row['due_date_for_name']) && strlen($e_row['due_date_for_name'])>45): ?> data-toggle="tooltip" data-original-title="<?= $e_row['due_date_for_name']; ?>" style="cursor: pointer;" <?php endif; ?>>
                                                            <?php 
                                                                if(!empty($e_row['due_date_for_name']))
                                                                {
                                                                    if(strlen($e_row['due_date_for_name'])>45)
                                                                    {
                                                                        echo substr($e_row['due_date_for_name'], 0, 45)."...";
                                                                    }
                                                                    else
                                                                    {
                                                                        echo $e_row['due_date_for_name'];
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    echo "-";
                                                                }
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['act_short_name']))
                                                                echo $e_row['act_short_name'];
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['applicable_form_name']))
                                                                echo $e_row['applicable_form_name'];
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($DDPeriod))
                                                                echo $DDPeriod;
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['tsStartTime']))
                                                                echo date('h:i A', strtotime($e_row['tsStartTime']));
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['tsEndTime']))
                                                                echo date('h:i A', strtotime($e_row['tsEndTime']));
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['tsTotalHours']))
                                                                $totalHoursVal = number_format($e_row['tsTotalHours'], 2, '.', '');
                                                            else 
                                                                $totalHoursVal = " "; 
                                                        ?>
                                                        <?= $totalHoursVal; ?>
                                                    </td>
                                                    <td width="5%" class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editTimeSheetModal<?php echo $k_row; ?>">Edit</a>
                                                                <?php if(isset($e_row['timeSheetId'])): ?>
                                                                    <a class="dropdown-item deleteTimeSheet" href="javascript:void(0);" data-id="<?= $e_row['timeSheetId']; ?>">Delete</a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php if($currVal!=$nextVal || $nextVal==""): ?>
                                                    <tr>
                                                        <td colspan=9></td>
                                                        <td class="text-center" width="5%" nowrap>
                                                            <b>Total</b>
                                                        </td>
                                                        <td class="text-right" width="5%" nowrap>
                                                            <?php
                                                                $sumHoursTotal = getHoursAndMinutesFormat($sumTotalHrs); 
                                                                $sumHoursTotalVal=$sumHoursTotal["hours"].".". $sumHoursTotal["minutes"];
                                                            ?>
                                                            <b><?= number_format($sumHoursTotalVal, 2, '.', ''); ?></b>
                                                        </td>
                                                        <td width="5%" class="text-center">-</td>
                                                    </tr>
                                                    <?php $sumTotalHrs=0; ?>
                                                    <?php $nextVal=""; ?>
                                                <?php endif; ?>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php if(!empty($timeSheetArr)): ?>
    <?php foreach($timeSheetArr AS $k_row => $e_row): ?>
    
    <?php
        $isEndTimeReqd = false;
        
        if($e_row['tsWorkingDate']<$currentDate)
        {
            $isEndTimeReqd = true;
        }

        $tsAddHrs = (!empty($e_row['tsAddHrs'])) ? $e_row['tsAddHrs'] : 1;

        $isReqdHrs = "";
        $isHrsDisabled = "";
        $setHrsOrTimeTitle = "";
        $isReqdStEdTime = "";

        if($tsAddHrs==1)
        {
            $isReqdHrs="required";
            $isHrsDisabled = "";
            $setHrsOrTimeTitle = "Set Start & End Time";
            $isReqdStEdTime = "";
        }
        else
        {
            $isReqdHrs="";
            $isHrsDisabled = "disabled";
            $setHrsOrTimeTitle = "Add Hours";
            $isReqdStEdTime = "required";
        }
    ?>
    
    <!-- Modal -->
    <div id="editTimeSheetModal<?php echo $k_row; ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo base_url('update-time-sheet-data'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Time Sheet</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Date<small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="tsWorkingDate" value="<?= $e_row['tsWorkingDate']; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group mb-0">
                                    <label>Hours<small class="text-danger">*</small></label>
                                    <?php $tsTotalHours = (!empty($e_row['tsTotalHours'])) ? $e_row['tsTotalHours'] : ""; ?>
                                    <input type="number" class="form-control" name="tsTotalHours" id="tsTotalHours<?= $k_row; ?>" value="<?= $tsTotalHours; ?>" step="0.01" min="0" <?= $isReqdHrs; ?> <?= $isHrsDisabled; ?>>
                                    <label>
                                        <span class="font-weight-light proj_primary_clr anchor setEditTSFormat" data-id="<?= $k_row; ?>"><?= $setHrsOrTimeTitle; ?><span>
                                    </label>
                                </div>
                                <input type="hidden" name="tsAddHrs" id="tsAddHrs<?= $k_row; ?>" value="<?= $tsAddHrs; ?>" />
                            </div>
                            <div class="col-md-6 col-lg-6 editTimeInputDiv<?= $k_row; ?>" <?php if($tsAddHrs==1): ?>style="display: none;"<?php endif; ?>>
                                <div class="form-group bootstrap-timepicker">
                                    <div class="form-group mb-0">
                                        <label>In Time<small class="text-danger">*</small></label>
                                        <input type="checkbox" id="setEditInTime<?= $k_row; ?>" class="radio-col-success setEditInTime" data-id="<?= $k_row; ?>" <?= $isReqdStEdTime; ?>>
                                        <label for="setEditInTime<?= $k_row; ?>">
                                            <span class="font-weight-light">Set Current Time<span>
                                        </label>
                                    </div>
                                    <div class="input-group">
                						<div class="input-group-addon">
                						  <i class="fa fa-clock-o"></i>
                						</div>
                                        <?php $inTime = (!empty($e_row['tsStartTime'])) ? date('h:i A', strtotime($e_row['tsStartTime'])) : ""; ?>
                                        <input type="text" class="form-control editTimepicker editInTimeInput<?= $k_row; ?>" name="tsStartTime" id="tsStartTime" placeholder="Enter In Time" value="<?= $inTime; ?>"  <?= $isReqdStEdTime; ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 editTimeInputDiv<?= $k_row; ?>" <?php if($tsAddHrs==1): ?>style="display: none;"<?php endif; ?>>
                                <div class="form-group bootstrap-timepicker">
                                    <div class="form-group mb-0">
                                        <label>Out Time <?php if($isEndTimeReqd): ?><small class="text-danger">*</small><?php endif; ?></label>
                                        <input type="checkbox" id="setEditOutTime<?= $k_row; ?>" class="radio-col-success setEditOutTime" data-id="<?= $k_row; ?>" <?= $isReqdStEdTime; ?>>
                                        <label for="setEditOutTime<?= $k_row; ?>">
                                            <span class="font-weight-light">Set Current Time<span>
                                        </label>
                                    </div>
                                    <div class="input-group">
                						<div class="input-group-addon">
                						  <i class="fa fa-clock-o"></i>
                						</div>
                                        <?php $outTime = (!empty($e_row['tsEndTime'])) ? date('h:i A', strtotime($e_row['tsEndTime'])) : ""; ?>
                                        <input type="text" class="form-control editTimepicker editOutTimeInput<?= $k_row; ?>" name="tsEndTime" id="tsEndTime" placeholder="Enter Out Time" value="<?= $outTime; ?>" <?= $isReqdStEdTime; ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Work Place</label>
                                    <input type="text" class="form-control workPlace" name="tsWorkPlace" value="<?= (isset($e_row['tsWorkPlace'])) ? $e_row['tsWorkPlace'] : ""; ?>" maxlength="18" >
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" name="tsRemarks" rows="2" ><?= (isset($e_row['tsRemarks'])) ? $e_row['tsRemarks'] : ""; ?></textarea>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="workId" value="<?= $e_row["fkWorkId"]; ?>">
                        <input type="hidden" name="userId" value="<?= $userId; ?>">
                        <?php $timeSheetId = (!empty($e_row['timeSheetId'])) ? $e_row['timeSheetId'] : ""; ?>
                        <input type="hidden" name="timeSheetId" id="timeSheetId" value="<?= $timeSheetId; ?>" />
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


<?= $this->endSection(); ?>

<?= $this->section('javacript'); ?>
<script>
    $(document).ready(function(){
        
        $(".timeInputDiv").hide();

        initializeTimepicker(minuteStep=1);

        $('.setEditInTime').change(function() {
            let dataId = $(this).data('id');
            if ($(this).is(':checked')) {
                setCurrentTime('.editInTimeInput'+dataId);
            } else {
                $('.editInTimeInput'+dataId).val("");
            }
        });

        $('.setEditOutTime').change(function() {
            let dataId = $(this).data('id');
            if ($(this).is(':checked')) {
                setCurrentTime('.editOutTimeInput'+dataId);
            } else {
                $('.editOutTimeInput'+dataId).val("");
            }
        });

        $(".setEditTSFormat").on("click", function() {

            var rowId = $(this).data('id');
            console.log("rowId", rowId);
            let tsAddHrs = parseInt($("#tsAddHrs"+rowId).val());
            console.log("tsAddHrs", tsAddHrs);

            if(tsAddHrs == 1) {
                $("#tsAddHrs"+rowId).val(2);
                $(this).html("Add Hours");
                $(".editTimeInputDiv"+rowId).show();
                $("#tsTotalHours"+rowId).val("");
                $("#tsTotalHours"+rowId).prop("disabled", true);
                $("#tsTotalHours"+rowId).prop("required", false);
            } else if(tsAddHrs == 2) {
                $("#tsAddHrs"+rowId).val(1);
                $(this).html("Set Start & End Time");
                $(".editTimeInputDiv"+rowId).hide();
                $(".editTimeInputDiv"+rowId+" input").val("");
                $("#tsTotalHours"+rowId).prop("disabled", false);
                $("#tsTotalHours"+rowId).prop("required", true);
            }

        });

        $('.deleteTimeSheet').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var timeSheetId = $(this).data('id');
            let workId = $('#currentWorkId').val();

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

                    var postingUrl = base_url+'/delete-time-sheet-data';
                    $.post(postingUrl, 
                    {
                        timeSheetId: timeSheetId
                    },
                    function(data, status){
                        window.location.href=base_url+"/work-time-sheet-list/"+workId;
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

        $('#selMthAttend').on('change', function () {
            
            var base_url = "<?php echo base_url(); ?>";
            var mth = $(this).val();

            window.location.href=base_url+"/time-sheet-list?mth="+mth;
        });
    });

    function initializeTimepicker(minuteStep) {
        if (document.readyState === 'complete') {
            $('.timepicker').timepicker('remove');
        }
        
        $('.editTimepicker').timepicker({
            'showInputs': false,
            'minuteStep': minuteStep,
            'defaultTime': false
        });
    }

    function setCurrentTime(selector) {
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var formattedTime = formatTime(hours, minutes);
        $(selector).timepicker('setTime', formattedTime);
    }

    function formatTime(hours, minutes) {
        var period = 'AM';
        if (hours >= 12) {
            period = 'PM';
            if (hours > 12) {
                hours -= 12;
            }
        } else if (hours === 0) {
            hours = 12;
        }
        minutes = minutes < 10 ? '0' + minutes : minutes;
        return hours + ':' + minutes + ' ' + period;
    }
</script>
<?= $this->endSection(); ?>