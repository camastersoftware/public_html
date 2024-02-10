<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .modal-xl {
        max-width: 1295px !important;
    }

    #filterLabels div.col-md-6 {
        font-size: 15px !important;
        font-weight: bold !important;
    }

    .tabcontent-border {
        border: 1px solid #bfbfbf !important;
    }

    td.column_date {
        font-size: 15px !important;
    }

    .tablepress tbody td,
    .tablepress tfoot th {
        border: 1px solid #015aacab !important;
        /*color: #000;*/
    }

    .nav-tabs .nav-link:hover,
    .nav-tabs .nav-link:focus {
        border-color: #015aac #015aac #015aac !important;
    }

    .nav-tabs .nav-link {
        position: relative;
        color: #7792b1;
        padding: 0.5rem 1.25rem;
        border-radius: 0;
        -webkit-transition: 0.5s;
        transition: 0.5s;
        border: 1px solid #015aac !important;
        border-top-color: rgb(1, 90, 172);
        border-right-color: rgb(1, 90, 172);
        border-bottom-color: rgb(1, 90, 172);
        border-left-color: rgb(1, 90, 172);
        background: #fff !important;
    }

    table.dataTable {
        border-collapse: separate !important;
        font-size: 13px !important;
    }

    .theme-primary .btn-info {
        height: 25px !important;
    }

    .due_date_for_name {
        font-size: 16px !important;
        /*font-weight: 700 !important;*/
        color: #000 !important;
    }

    #tablepress-2 tr th {
        font-size: 16px !important;
        font-weight: 800 !important;
    }

    .tab_body_div .nav-item .nav-link {
        border-radius: 12px !important;
        display: inline-block !important;
        width: 75% !important;
        font-size: 18px !important;
    }

    .tab_body_div .nav-item .nav-link.active span {
        color: #fff !important;
    }

    .tab_body_div .nav-tabs .nav-link {
        margin-bottom: 20px !important;
    }

    .theme-primary .nav-tabs .nav-link.active {
        border-color: #F99D27 !important;
        background-color: #F99D27 !important;

        /*border: 2px solid #005495 !important;*/
        /*background-color: #005495 !important;*/
    }

    .nav-tabs {
        border: none !important;
    }

    .card_bg_format {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 0px !important;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }

    .form_bg_format {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px !important;
        border: 1px solid #8c8c8cab !important;
        background: #fdfeff !important;
    }

    .tabcontent-border {
        border: none !important;
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

    .demo-checkbox .box-header {
        background-color: #005495 !important;
        border-radius: 10px !important;
    }

    .demo-checkbox .box-header.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 50px !important;
        line-height: 29px !important;
        border: 2px solid #f99d27 !important;
    }

    .clientNameLabelVal {
        font-size: 27px !important;
    }

    .theme-primary .box-primary {
        background-color: #2b8836 !important;
    }

    .modal-header {
        border-bottom-color: #d5dfea;
        background-color: #F99D27;
        padding: 8px 8px;
    }

    .income-tax-head {
        background: #ffc800;
        padding: 10px;
        margin-bottom: 0px;
        font-weight: bold;
    }

    .tablepress td,
    .tablepress th {
        font-weight: 600;
    }

    td.column-1 {
        font-size: 14px;
    }

    .tablepress tbody tr:first-child td {
        /*background: #ffffff;*/
    }

    .modal-header h4 {
        text-align: center;
    }

    .wizard-content .wizard>.steps>ul>li.current>a {
        color: #ffffff !important;
        cursor: default;
    }

    .getActModal .box {
        cursor: pointer !important;
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

    .demo-checkbox .box_head_cl.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
    }

    .actDivClass label {
        border-radius: 10px !important;
        border: 2px solid #005495 !important;
        background-color: #f99d27 !important;
        color: #fff !important;
        height: 50px !important;
        padding-top: 10px !important;
        width: 100% !important;
        font-size: 18px !important;
        text-align: left !important;
        padding-left: 39px !important;
    }

    /*[type="checkbox"].filled-in:checked + label::before */
    .actDivClass label::before {
        margin-top: 14px !important;
        margin-left: 9px !important;
    }

    /*.theme-primary [type="checkbox"].filled-in:checked + label::after*/
    .actDivClass label::after {
        border: 2px solid #005495 !important;
        margin-left: 10px !important;
        margin-top: 12px !important;
    }

    /*[type="checkbox"].filled-in:checked + label*/
    .actDivClass .filled-in:checked+label {
        border: 2px solid #f99d27 !important;
        background-color: #005495 !important;
    }

    .actDivClass .filled-in:checked+label::after {
        border: 2px solid #f99d27 !important;
    }

    .btnBorder {
        border-radius: 11px !important;
    }

    .userNameLabelVal {
        font-size: 27px !important;
    }
</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">

        <div class="col-12">

            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?php
                        if (isset($pageTitle))
                            echo $pageTitle;
                        else
                            echo "N/A";
                        ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?= base_url('staff-administration'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body tab_body_div card_bg_format">
                    <form action="javascript:void(0);" class="tab-wizard wizard-circle staff_form" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                        <div class="form-group row form_bg_format">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <div class="state due-month">
                                                                    <h4 class="text-white font-weight-bold m-0">Details Of Paid Assistant</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ca_name"> Name Of Paid Assistant:<small class="text-danger">*</small></label>
                                                                    <input type="text" class="form-control" name="ca_name" id="ca_name" placeholder="Enter Name Of Paid Assistant">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ca_membership_no">Membership Number: </label>
                                                                    <input type="text" class="form-control" name="ca_membership_no" id="ca_membership_no" placeholder="Enter Membership Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ca_date_commencement">Date Of Commenecement Of Employment:</label>
                                                                    <input type="date" class="form-control" name="ca_date_commencement" id="ca_date_commencement" placeholder="Enter Date Of Commenecement Of Employment">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ca_date_intimation_icai">Date Of Intimation to ICAI:</label>
                                                                    <input type="date" class="form-control" name="ca_date_intimation_icai" id="ca_date_intimation_icai" placeholder="Enter Date Of Intimation to ICAI">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ca_date_termination">Date Of Termination Of Employment:</label>
                                                                    <input type="date" class="form-control" name="ca_date_termination" id="ca_date_termination" placeholder="Enter Date Of Termination Of Employment">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ca_date_intimation_icai_termination">Date Of Intimation to ICAI:</label>
                                                                    <input type="text" class="form-control" name="ca_date_intimation_icai_termination" id="ca_date_intimation_icai_termination" placeholder="Enter Date Of Intimation to ICAI">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="ca_remark">Remark:</label>
                                                                    <textarea type="text" class="form-control" name="ca_remark" id="ca_remark" rows="3" placeholder="Enter Remark"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ca_img">Upload Photo:</label><br>
                                                                    <input type="file" class="upload" name="ca_img" id="ca_img">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <hr class="mt-0">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="offset-md-4 offset-lg-4 col-md-4 col-lg-4 text-center">
                                                <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right">Submit</button>
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
<!-- /.content -->


<script type="text/javascript">
    $(document).ready(function() {

        var base_url = "<?php echo base_url(); ?>";

        $('body').on('submit', '.staff_form', function(e) {

            e.preventDefault();
            var userFormData = new FormData(this);

            $.ajax({
                url: base_url + '/save-ca',
                type: 'POST',
                data: userFormData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {

                    var resStatus = response['status'];
                    var resMsg = response['message'];
                    var resUserData = response['userdata'];

                    if (resStatus == true) {
                        window.location.href = base_url + "/all-staff?getCurrTab=4";
                    } else {

                        $.each(resUserData, function(index, value) {

                            $("#" + index).siblings('span').remove();

                            if (value != "")
                                $("#" + index).closest('div').append('<span class="text-danger">' + value + '</span>');
                        });

                        swal("Error!", resMsg, "error");

                    }
                },
                error: function(request, error) {
                    // alert("Request: "+JSON.stringify(request));
                }
            });
        });

    });
</script>

<script type="text/javascript">
</script>
<?= $this->endSection(); ?>