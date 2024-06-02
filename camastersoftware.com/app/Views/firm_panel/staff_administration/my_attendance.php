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

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold">
                                <?= $pageTitle." : ".$getUserData['userFullName']; ?>
                            </h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url('my_works'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-danger add_client_top">My Work</button>
                            </a>
                            &nbsp;&nbsp;
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
                                    <option value="<?php echo $m; ?>" <?php if($m==$mth): ?>selected<?php endif; ?> ><?php echo date('F', strtotime("2021-".$m."-1"))."-".$yr; ?></option>
                                <?php endfor; ?>
                            </select>
                            &nbsp;&nbsp;
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addEmpAttendModal">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Add</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <?= view_cell('\App\Libraries\Utility::attendance_list'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view_cell('\App\Libraries\Utility::add_edit_attendance'); ?>

<?= $this->endSection(); ?>

<?= $this->section('javacript'); ?>
<script>
    $(document).ready(function(){
        
        initializeTimepicker(minuteStep=1);
        
        $('#setAddInTime').change(function() {
            if ($(this).is(':checked')) {
                setCurrentTime('.addInTimeInput');
            } else {
                $('.addInTimeInput').val("");
            }
        });

        $('#setAddOutTime').change(function() {
            if ($(this).is(':checked')) {
                setCurrentTime('.addOutTimeInput');
            } else {
                $('.addOutTimeInput').val("");
            }
        });

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

        $('#setAddInTime').trigger("click");
    });

    function initializeTimepicker(minuteStep) {
        if (document.readyState === 'complete') {
            $('.timepicker').timepicker('remove');
        }
        $('.timepicker').timepicker({
            'showInputs': false,
            'minuteStep': minuteStep,
            'defaultTime': 'value'
        });
        
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