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
                        <!-- <a href="<?php echo base_url('create-chartered-accountant/0'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right ml-1" style="">Add CA</button>
                        </a>
                        <a href="<?php echo base_url('create-articleship/0'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right ml-1" style="">Add Articleship</button>
                        </a> -->
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row ">
                        <div class="offset-md-3 col-lg-6">
                            <div class="table-responsive">
                                <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                    <!-- <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20"> -->
                                    <thead>
                                        <tr class="">
                                            <th class="text-center" width="5%">SN</th>
                                            <th class="text-center">Staff Name</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center" width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 0;
                                        if (!empty($staffList)) : ?>
                                            <?php foreach ($staffList as $k_row => $e_row) : ?>
                                                <tr>
                                                    <td class="text-center" width="5%"><?php echo $i + 1; ?></td>
                                                    <td class="text-center" nowrap><?php echo $e_row['userFullName']; ?></td>
                                                    <td class="text-center" nowrap><?php echo $e_row['Type']; ?></td>
                                                    <td class="text-center" width="5%">
                                                        <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                <?php if ($currTab == 4 || $e_row['Type'] == 'CA') : ?>
                                                                    <a class="dropdown-item" href="<?php echo base_url('create-chartered-accountant/' . $e_row['userId']); ?>">Edit</a>
                                                                <?php elseif ($currTab == 3 || $e_row['Type'] == 'Articleship') : ?>
                                                                    <a class="dropdown-item" href="<?php echo base_url('create-articleship/' . $e_row['userId']); ?>">Edit</a>
                                                                <?php elseif ($currTab == 2 || $e_row['Type'] == 'Staff') : ?>
                                                                    <a class="dropdown-item" href="<?php echo base_url('user/edit_user/' . $e_row['userId']); ?>">Edit</a>
                                                                <?php endif; ?>
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

        // $('#radio_30').on('click', function(){
        //     window.location.href=base_url+"/admin/tax_calendar";
        // });

        // $('#radio_32').on('click', function(){
        //     window.location.href=base_url+"/admin/date_wise_tax_calendar";
        // });

    });
</script>

<?= $this->endSection(); ?>