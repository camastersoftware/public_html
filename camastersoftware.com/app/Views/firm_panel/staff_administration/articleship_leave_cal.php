<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .tabcontent-border {
        border: none;
        border-top: 0px;
    }

    .due-month {
        background: #F99D27;
        padding: 7px 0;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    .due-month label {
        margin-top: 2px;
        margin-bottom: 2px;
    }

    .heading-act {
        background: #00669d;
        padding: 7px 0;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
    }

    .heading-act label {
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

    .tablepress thead tr,
    .tablepress thead th {
        border: 1px solid #ddd;
        color: #fff;
        font-size: 16px;
    }

    .tablepress tbody {
        font-size: 16px;
    }

    .heading {
        font-size: 16px;
        margin-top: 6px;
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

    .tablepress tbody td,
    .tablepress tfoot th {
        border: 1px solid #015aacab !important;
        color: #000;
    }

    .box-body {
        padding: 0.1rem 0.1rem;
        /* -ms-flex: 1 1 auto; */
        flex: 1 1 auto;
        border-radius: 10px;
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

    .theme-primary a:hover,
    .theme-primary a:focus {
        color: #303030 !important;
    }

    a {
        color: #303030;
    }

    .sub_btn {
        width: 80px !important;
    }

    .theme-primary .btnPrimClr {
        margin-top: 0px !important;
        height: 25px !important;
        margin-bottom: 0px !important;
    }

    .actionText {
        font-size: 11px !important;
    }

    .proj_modal_bg {
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }

    .bg_prjt_format {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px;
        border: 1px solid #8c8c8cab !important;
        background: #fff !important;
    }

    .card_bg_format {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 0px !important;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }
</style>
<?php
if (!empty($leaveCalDataArr)) {
    $art_lev_id = $leaveCalDataArr['art_lev_id'];
    $start_date = $leaveCalDataArr['art_lev_start_date'];
    $completion_date = $leaveCalDataArr['art_lev_completion_date'];
    $tot_no_days = $leaveCalDataArr['art_lev_tot_no_days'];
    $tot_leave_taken = $leaveCalDataArr['art_lev_tot_lev_taken'];
    $ca_exam_leave = $leaveCalDataArr['art_lev_ca_exam_leave'];
    $gmcs_course = $leaveCalDataArr['art_lev_gmcs_course'];
    $itt_training = $leaveCalDataArr['art_lev_itt_training'];
    $seminar = $leaveCalDataArr['art_lev_seminar'];
    $other_leave = $leaveCalDataArr['art_lev_other_leave'];
    $final_leave_amt = $leaveCalDataArr['art_lev_tot_eligible_leave'];
    $weekends = $leaveCalDataArr['art_lev_weekends'];
    $holidays = $leaveCalDataArr['art_lev_holidays'];
    $netLeaveTaken = $leaveCalDataArr['art_lev_tot_extra_leaves'];
    $less_net_leave_taken = $leaveCalDataArr['art_lev_net_leave_taken'];
    $daysActuallyServed = $leaveCalDataArr['art_lev_days_actually_served'];
    $allowableSix = $leaveCalDataArr['art_lev_one_sixth_allowable'];
    $allowableExcessLeaveAMT = $leaveCalDataArr['art_lev_allowable_excess_leave'];


    $totLeaveTaken  = intval($final_leave_amt) + intval($netLeaveTaken);
    $finaltotLeaveTaken = intval($tot_leave_taken) - intval($totLeaveTaken);
} else {
    $art_lev_id = "";
    $start_date = "";
    $completion_date = "";
    $tot_no_days = "";
    $tot_leave_taken = "";
    $ca_exam_leave = "";
    $gmcs_course = "";
    $itt_training = "";
    $seminar = "";
    $other_leave = "";
    $final_leave_amt = "";
    $weekends = "";
    $holidays = "";
    $netLeaveTaken = "";
    $less_net_leave_taken = "";
    $daysActuallyServed = "";
    $allowableSix = "";
    $allowableExcessLeaveAMT = "";
    $totLeaveTaken  = "";
    $finaltotLeaveTaken  = "";
}
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
                        <div class="text-right flex-grow">
                            <a href="<?php echo base_url('staff-administration'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body p-10 card_bg_format">
                    <form action="<?php echo base_url('update-articleship-leave-cal'); ?>" method="POST">
                        <div class="row mt-10 m-30 ">
                            <div class="col-md-6 offset-md-3">
                                <div class="row bg_prjt_format">
                                    <?php
                                    $start_date1 = "";
                                    $completion_date1 = "";
                                    $tot_no_days1 = 0;
                                    if (!empty($userData['userFullName'])) {
                                        if (!empty($userData['userArtStartDate'])) {
                                            // $start_date = date("Y-m-d", strtotime($userData['userArtStartDate']));
                                            $start_date1 = date("d-m-Y", strtotime($userData['userArtStartDate']));
                                        }
                                        if (!empty($userData['userArtEndDate'])) {
                                            // $completion_date = date("Y-m-d", strtotime($userData['userArtEndDate']));
                                            $completion_date1 = date("d-m-Y", strtotime($userData['userArtEndDate']));
                                        }
                                        $date1 = new DateTime($start_date1); // First date
                                        $date2 = new DateTime($completion_date1); // Second date
                                        $interval = $date1->diff($date2);
                                        $tot_no_days1 = abs($interval->days);
                                    }
                                    // print_r($userData);
                                    // die(); 
                                    ?>
                                    <?php if (!empty($userData['userFullName'])) : ?>
                                        <input type="hidden" name="userId" id="userId" value="<?php echo $userId; ?>">
                                        <input type="hidden" name="art_lev_id" id="art_lev_id" value="<?php echo $art_lev_id; ?>">
                                        <div class="offset-lg-1 col-md-10">
                                            <div class="row form-group">
                                                <div class="col-md-12 col-lg-12 text-center mb-3">
                                                    <span class="font-weight-bold h4">
                                                        <?php if (!empty($userData['userFullName'])) echo $userData['userFullName'];
                                                        else echo "N/A"; ?>
                                                    </span>
                                                </div>
                                                <div class="col-md-6 col-lg-6 text-left mb-1 mt-1">
                                                    <span class="font-weight-bold">PAN :&nbsp;</span>
                                                    <span class="font-weight-bold">
                                                        <?php if (!empty($userData['userPan'])) echo $userData['userPan'];
                                                        else echo "N/A"; ?>
                                                    </span>
                                                </div>
                                                <div class="col-md-6 col-lg-6 text-right mb-1 mt-1">
                                                    <span class="font-weight-bold">Designation :&nbsp;</span>
                                                    <span class="font-weight-bold">
                                                        <?php if (!empty($userData['userDesgn'])) echo $userData['userDesgn'];
                                                        else echo "N/A"; ?>
                                                    </span>
                                                </div>

                                                <div class="col-md-6 col-lg-6 text-left">
                                                    <span class="font-weight-bold">Start Date :&nbsp;</span>
                                                    <span class="font-weight-bold">
                                                        <?php echo $start_date; ?>
                                                    </span>
                                                </div>
                                                <div class="col-md-6 col-lg-6 text-right">
                                                    <span class="font-weight-bold">Completion Date :&nbsp;</span>
                                                    <span class="font-weight-bold">
                                                        <?php echo $completion_date; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    <?php endif; ?>

                                    <div class="offset-lg-1 col-md-10">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <h6 class="heading">
                                                    Date Of Starting :&nbsp;
                                                    </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="date" class="form-control start_date inputRTL" name="start_date" id="start_date" onchange="getTotalDays()" value="<?php echo $start_date; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <span class="heading">
                                                    Date Of Completion :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="date" class="form-control completion_date inputRTL" name="completion_date" id="completion_date" value="<?php echo $completion_date; ?>" onchange="getTotalDays()">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <span class="heading">
                                                    Total No Of Days :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control tot_no_days inputRTL" name="tot_no_days" id="tot_no_days" value="<?php echo $tot_no_days; ?>" onkeypress="validateNum(event);getNoOfDays();">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    Total Leave Taken :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control tot_leave_taken inputRTL" name="tot_leave_taken" id="tot_leave_taken" onkeypress="validateNum(event);" value="<?php echo $tot_leave_taken; ?>">
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="font-weight-bold h5">
                                                    Less:Eligible Leave&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    CA Exam Leave :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control eligibleLeaveAmt inputRTL" name="ca_exam_leave" id="ca_exam_leave" onkeypress="validateNum(event);" value="<?php echo $ca_exam_leave; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    GMCS Course :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control eligibleLeaveAmt inputRTL" name="gmcs_course" id="gmcs_course" onkeypress="validateNum(event);" value="<?php echo $gmcs_course; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    ITT Training :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control eligibleLeaveAmt inputRTL" name="itt_training" id="itt_training" onkeypress="validateNum(event);" value="<?php echo $itt_training; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    Seminar :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control eligibleLeaveAmt inputRTL" name="seminar" id="seminar" onkeypress="validateNum(event);" value="<?php echo $seminar; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    Other Leave :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control eligibleLeaveAmt inputRTL" name="other_leave" id="other_leave" onkeypress="validateNum(event);" value="<?php echo $other_leave; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    &nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control final_leave_amt inputRTL" name="final_leave_amt" id="final_leave_amt" onkeypress="validateNum(event);" value="<?php echo $final_leave_amt; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="font-weight-bold h5">
                                                    Less:Extra Days Worked&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    Weekends :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control extraDaysWork inputRTL lessextraDaysWork" name="weekends" id="weekends" onkeypress="validateNum(event);getNetLeaveTaken()" value="<?php echo $weekends; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    Holidays :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control extraDaysWork inputRTL lessextraDaysWork" name="holidays" id="holidays" onkeypress="validateNum(event);getNetLeaveTaken()" value="<?php echo $holidays; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="font-weight-bold h5">

                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control netLeaveTaken inputRTL" name="netLeaveTaken" id="netLeaveTaken" onkeypress="validateNum(event);" value="<?php echo $netLeaveTaken; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="font-weight-bold h5">
                                                    Net Leave Taken&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control totLeaveTaken inputRTL" name="totLeaveTaken" id="totLeaveTaken" onkeypress="validateNum(event);" value="<?php echo $finaltotLeaveTaken; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    No Of Days :&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control no_days  netLeaveTaken inputRTL" name="no_days" id="no_days" onkeypress="validateNum(event);" value="<?php echo $tot_no_days; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    Less : Net Leave Taken&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control less_net_leave_taken netLeaveTaken inputRTL" name="less_net_leave_taken" id="less_net_leave_taken" onkeypress="validateNum(event);" value="<?php echo $less_net_leave_taken; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    Days Actually Served&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control daysActuallyServed inputRTL" name="daysActuallyServed" id="daysActuallyServed" onkeypress="validateNum(event);" value="<?php echo $daysActuallyServed; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    1/6th OfAbove : Allowable&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control allowableSix AllowableExcessLeave inputRTL" name="allowableSix" id="allowableSix" onkeypress="validateNum(event);getAllowableExcessLeave()" value="<?php echo $allowableSix; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    Net Leave Taken&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control net_leave_takenabove   inputRTL" name="net_leave_takenabove" id="net_leave_takenabove" onkeypress="validateNum(event);getAllowableExcessLeave()" value="<?php echo $netLeaveTaken; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mt-2 mb-2">
                                                <span class="heading">
                                                    Allowable / (-)Excess Leave&nbsp;
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-center mt-2 mb-2">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control allowableExcessLeaveAMT inputRTL" name="allowableExcessLeaveAMT" id="allowableExcessLeaveAMT" onkeypress="validateNum(event);" value="<?php echo $allowableExcessLeaveAMT; ?>" readonly>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="col-md-12 text-center">
                                            <div class="row mt-10 m-30">
                                                <div class="col-md-6 offset-md-3 text-center">
                                                    <a href="<?= base_url('staff-administration'); ?>">
                                                        <button type="button" class="btn btn-dark text-left">Back</button>
                                                    </a>
                                                    <?php if ($userId > 0) : ?>
                                                        <button type="submit" name="submit" class="btn btn-success btn-submit text-left">Submit</button>
                                                    <?php endif; ?>
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
    $(document).ready(function() {
        getNoOfDays();
        getNetLeaveTaken();

        $('.eligibleLeaveAmt').on('input', function() {

            var salaryParameterId = $(this).data('id');

            if ($(this).val() != "")
                var mthInputAmt = parseInt($(this).val());
            else
                var mthInputAmt = 0;

            var yrInputAMt = mthInputAmt * 12;

            $('#yrInput' + salaryParameterId).val(yrInputAMt);

            var eligibleLeaveAmt = 0;
            $('.eligibleLeaveAmt').each(function(i, val) {
                eligibleLeaveVal = ($(val).val() != "") ? $(val).val() : 0;
                eligibleLeaveAmt += parseInt(eligibleLeaveVal);
            });
            $('#final_leave_amt').val(eligibleLeaveAmt);
            $('#net_leave_taken').val(eligibleLeaveAmt);
            $('#net_leave_takenabove').val(eligibleLeaveAmt);

            getTotLeaveTaken();
        });

    });

    function getNoOfDays() {
        $('.tot_no_days').on('input', function() {
            var tot_no_days = parseInt($("#tot_no_days").val());
            $("#no_days").val(tot_no_days);
        });
    }

    function getNetLeaveTaken() {
        $('.extraDaysWork').on('input', function() {
            var netLeaveTaken = 0;
            $('.extraDaysWork').each(function(i, val) {
                netLeaveTakenVal = ($(val).val() != "") ? $(val).val() : 0;
                netLeaveTaken += parseInt(netLeaveTakenVal);
            });
            $("#netLeaveTaken").val(netLeaveTaken);
            getTotLeaveTaken();
        });
    }

    function getAllowableExcessLeave() {
        $('.AllowableExcessLeave').on('input', function() {
            var allowableExcessLeave = 0;

            var allowableSix = 0;
            $('.allowableSix').each(function(i, val) {
                allowableSixVal = ($(val).val() != "") ? $(val).val() : 0;
                allowableSix += parseInt(allowableSixVal);
            });

            var net_leave_taken = 0;
            $('.net_leave_taken').each(function(i, val) {
                net_leave_takenVal = ($(val).val() != "") ? $(val).val() : 0;
                net_leave_taken += parseInt(net_leave_takenVal);
            });
        });
    }

    function getTotLeaveTaken() {
        var final_leave_amt = $("#final_leave_amt").val() != "" ? $("#final_leave_amt").val() : 0;
        var netLeaveTaken = $("#netLeaveTaken").val() != "" ? $("#netLeaveTaken").val() : 0;
        var tot_leave_taken = $("#tot_leave_taken").val() != "" ? $("#tot_leave_taken").val() : 0;
        var totLeaveTaken = parseInt(final_leave_amt) + parseInt(netLeaveTaken);
        var finaltotLeaveTaken = parseInt(tot_leave_taken) - parseInt(totLeaveTaken);


        $("#totLeaveTaken").val(finaltotLeaveTaken);
        $("#less_net_leave_taken").val(finaltotLeaveTaken);
        $("#net_leave_takenabove").val(finaltotLeaveTaken);
        $("#daysActuallyServed").val(finaltotLeaveTaken);

        getDaysACtuallyServed();
    }

    function getDaysACtuallyServed() {
        var less_net_leave_taken = $("#less_net_leave_taken").val() != "" ? $("#less_net_leave_taken").val() : 0;
        var no_days = $("#no_days").val() != "" ? $("#no_days").val() : 0;
        var daysActuallyServed = parseInt(no_days) - parseInt(less_net_leave_taken);
        $("#daysActuallyServed").val(daysActuallyServed);
        var allowableSix = daysActuallyServed / 6;
        var roundedValue = Math.round(allowableSix);
        console.log("daysActuallyServed=>", daysActuallyServed)
        console.log("allowableSix=>", allowableSix)
        console.log("roundedValue=>", roundedValue)
        $("#allowableSix").val(roundedValue);

        var net_leave_takenabove = $("#net_leave_takenabove").val() != "" ? $("#net_leave_takenabove").val() : 0;
        allowableExcessLeave = net_leave_takenabove - roundedValue;
        $("#allowableExcessLeaveAMT").val(allowableExcessLeave);
    }

    function getTotalDays() {
        var start_date = new Date($('#start_date').val());
        var completion_date = new Date($('#completion_date').val());
        if (start_date.getTime() > completion_date.getTime()) {
            new Date($('#completion_date').val(""));
            let warningMSG = "Date of Starting cannot be greater than Date Of Completion.";
            swal("Warning!", warningMSG, "warning");
            return;
        }

        var timeDifference = completion_date.getTime() - start_date.getTime();
        var daysDifference = Math.abs(timeDifference / (1000 * 60 * 60 * 24));
        if (isNaN(daysDifference)) {
            daysDifference = 0;
        }
        if (daysDifference > 0) {
            $('#tot_no_days').val(daysDifference);
            $('#no_days').val(daysDifference);
        }
    }
</script>

<?= $this->endSection(); ?>