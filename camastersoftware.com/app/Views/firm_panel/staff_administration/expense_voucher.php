<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .tabcontent-border {
        border: 1px solid #bfbfbf !important;
    }

    td.column_date {
        font-size: 15px !important;
        width: 10% !important;
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
    }

    table.dataTable {
        border-collapse: separate !important;
        font-size: 15px !important;
    }

    .due-month {
        background: #F99D27;
        padding: 7px 0;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }
</style>
<?php
if (empty($getExpData)) {
    $getExpData = array(
        "fk_user_id" => "",
        "exp_head" => "",
        "exp_bill_no" => "",
        "exp_date" => "",
        "exp_amt" => "",
        "exp_details" => "",
        "exp_doc" => "",
    );
}
?>
<!-- Main content -->
<section class="content  mt-35">
    <div class="row ">

        <div class="col-xl-12 col-lg-12 col-12">

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

                        <a href="<?php echo base_url('expense-vouchers-list'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right ml-1" style="">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body tab_body_div card_bg_format">
                    <form action="javascript:void(0);" class="tab-wizard wizard-circle exp_form" enctype="multipart/form-data">
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
                                                                    <h4 class="text-white font-weight-bold m-0">Expense Voucher Details</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <hr> -->
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <?php //print_r($getExpData);die(); 
                                                            ?>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exp_head"> Staff Name:<small class="text-danger">*</small></label>
                                                                    <select class="custom-select form-control" id="fk_user_id" name="fk_user_id">
                                                                        <option value="">Select User</option>
                                                                        <?php if (!empty($userList)) : ?>
                                                                            <?php foreach ($userList as $e_user) : ?>
                                                                                <option value="<?php echo $e_user['userId']; ?>" <?php if ($getExpData['fk_user_id'] == $e_user['userId']) echo "selected"; ?>><?php echo $e_user['userFullName']; ?></option>
                                                                            <?php endforeach; ?>

                                                                        <?php endif; ?>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exp_head"> Expense Head:<small class="text-danger">*</small></label>
                                                                    <input type="text" class="form-control" name="exp_head" id="exp_head" value="<?php echo $getExpData['exp_head']; ?>" placeholder="Enter Expense Head">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exp_bill_no">Expense Bill No: </label>
                                                                    <input type="text" class="form-control" name="exp_bill_no" id="exp_bill_no" value="<?php echo $getExpData['exp_bill_no']; ?>" placeholder="Enter Expense Bill No">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exp_date">Expense Date:</label>
                                                                    <input type="date" class="form-control" name="exp_date" id="exp_date" value="<?php echo $getExpData['exp_date']; ?>" placeholder="Enter Date Of Expense">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exp_amt">Expense Amount:</label>
                                                                    <input type="number" class="form-control" name="exp_amt" id="exp_amt" value="<?php echo $getExpData['exp_amt']; ?>" placeholder="Enter Expense Amount">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="exp_details">Expense Details:</label>
                                                                    <textarea id="exp_details" name="exp_details" class="form-control" placeholder="Enter Expense Details"><?php echo $getExpData['exp_details']; ?></textarea>
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exp_doc">Upload Exp DOc:</label><br>
                                                                    <input type="file" class="upload" name="exp_doc" id="exp_doc">
                                                                </div>
                                                            </div> -->

                                                        </div>
                                                        <hr class="mt-0">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="offset-md-4 offset-lg-4 col-md-4 col-lg-4 text-center">
                                                <input type="hidden" id="exp_id" name="exp_id" value="<?php echo $exp_id; ?>" />

                                                <a href="<?php echo base_url('expense-vouchers-list'); ?>"><button type="button" name="submit" class="waves-effect waves-light btn btn-dark text-right">Back</button></a>

                                                <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right">Submit</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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

        $('body').on('submit', '.exp_form', function(e) {

            e.preventDefault();
            var userFormData = new FormData(this);

            $.ajax({
                url: base_url + '/save-expense',
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
                        window.location.href = base_url + "/expense-vouchers-list";
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
<script>
    $(document).ready(function() {

        var base_url = "<?php echo base_url(); ?>";


    });
</script>

<?= $this->endSection(); ?>