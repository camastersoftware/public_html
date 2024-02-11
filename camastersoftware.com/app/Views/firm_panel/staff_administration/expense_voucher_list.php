<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .wizard-content .wizard>.steps>ul>li.current>a {
        color: #ffffff !important;
        cursor: default;
    }

    .table-responsive table thead tr {
        background: #005495 !important;
        color: #fff !important;
    }

    .table-responsive table tbody tr {
        background: #96c7f242 !important;
    }

    .table-responsive tr th {
        border: 1px solid #fff !important;
    }

    .table-responsive tr td {
        border: 1px solid #015aacab !important;
    }

    table.dataTable {
        border-collapse: collapse !important;
        font-size: 16px !important;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th {
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
</style>

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

                        <a href="<?php echo base_url('staff-administration'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right ml-1" style="">Back</button>
                        </a>
                        <a href="<?php echo base_url('expense-vouchers/0'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit float-right ml-1" style="">Add Expense</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row ">
                        <div class="offset-md-2 col-lg-8">
                            <div class="table-responsive">
                                <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr class="">
                                            <th class="text-center" width="5%">SN</th>
                                            <th class="text-center" nowrap>Date</th>
                                            <th class="text-center" nowrap>Bill No</th>
                                            <th class="text-center" nowrap>Head</th>
                                            <th class="text-center" nowrap>Details</th>
                                            <th class="text-center" nowrap>Amount</th>
                                            <th class="text-center" width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 0;
                                        if (!empty($getExpData)) : ?>
                                            <?php foreach ($getExpData as $k_row => $e_row) : ?>
                                                <tr>
                                                    <td class="text-center" width="5%"><?php echo $i + 1; ?></td>
                                                    <td class="text-center" nowrap><?php if (check_valid_date($e_row['exp_date']))
                                                        $exp_date = date('d-m-Y', strtotime($e_row['exp_date']));
                                                    else
                                                        $exp_date = "";

                                                    echo $exp_date; ?></td>
                                                    <td class="text-center" nowrap><?php echo $e_row['exp_bill_no']; ?></td>
                                                    <td class="text-center" nowrap><?php echo $e_row['exp_head']; ?></td>
                                                    <td class="text-center" nowrap><?php echo $e_row['exp_details']; ?></td>
                                                    <td class="text-center" nowrap><?php echo $e_row['exp_amt']; ?></td>
                                                    <td class="text-center" width="5%">
                                                        <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                <a class="dropdown-item" href="<?php echo base_url('expense-vouchers/' . $e_row['exp_id']); ?>">Edit</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="7">
                                                    <center>No Records</center>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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


<script>
    $(document).ready(function() {

        var base_url = "<?php echo base_url(); ?>";

    });
</script>

<?= $this->endSection(); ?>