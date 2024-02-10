<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
   .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
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

                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <?php foreach ($tabList as $row) : ?>

                            <!-- <li class="nav-item">
                                <a class="nav-link <?php if ($row['tabId'] == $currTab) : ?>active<?php endif; ?>" id="<?php echo $row['tabId']; ?>-tab" href="<?= base_url('all-staff?getCurrTab=' . $row['tabId']); ?>" aria-controls="profile">
                                    <span class="hidden-sm-up">
                                        <i class="ion-person"></i>
                                    </span>
                                    <span class="hidden-xs-down year-color"><?php echo $row['tabName']; ?></span>
                                </a>
                            </li> -->
                        <?php endforeach; ?>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border p-15" id="myTabContent">

                        <div class="tab-pane fade table-responsive show active" id="<?php echo $row['tabId']; ?>_tab" role="tabpanel" aria-labelledby="<?php echo $row['tabId']; ?>-tab">

                            <?php if ($currTab == 1 || $currTab == 2) :  ?>
                                <div class="table-responsive">
                                    <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                        <!-- <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20"> -->
                                        <thead>
                                            <tr class="row-1">
                                                <th class="column-1">SN</th>
                                                <th class="column-2">Staff Name</th>
                                                <th class="column-3">Type</th>
                                                <th class="column-4">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $i = 0;
                                            if (!empty($staffList)) : ?>
                                                <?php foreach ($staffList as $k_row => $e_row) : ?>
                                                    <tr>
                                                        <td class="column-1 text-center"><?php echo $i + 1; ?></td>
                                                        <td class="column-2 text-center"><?php echo $e_row['userFullName']; ?></td>
                                                        <!-- <td class="column-3 text-center"><?php echo $e_row['staff_type_name']; ?></td> -->
                                                        <td class="column-3 text-center"><?php echo $e_row['Type']; ?></td>
                                                        <td class="column-4 text-center">
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
                            <?php elseif ($currTab == 3) : ?>
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1" width="1%">SN</th>
                                            <th class="column-2" width="15%">Name of the Articled Student</th>
                                            <th class="column-3" width="5%" rowspan="2">REGN. No.</th>
                                            <th class="column-3" width="25%" colspan="3">Period of Training</th>
                                            <th class="column-3" width="25%" colspan="2">Date of Passing</th>
                                            <th class="column-4" width="25%" rowspan="2">Remarks<br />(If Any)</th>
                                        </tr>
                                        <tr class="row-1">
                                            <th class="column-1" width="16%" colspan="2">Articleship Completed / Transfer</th>

                                            <th class="column-3" width="12%">From</th>
                                            <th class="column-3" width="12%">To</th>
                                            <th class="column-3" width="12%">Remark</th>
                                            <th class="column-4" width="7%">Inter CA</th>
                                            <th class="column-4" width="7%">Final CA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($staffList)) : ?>
                                            <?php foreach ($staffList as $k_row => $e_row) : ?>
                                                <tr>
                                                    <td class="column-1 text-center"><?php echo $i + 1; ?></td>
                                                    <td class="column-2 text-center"><?php echo $e_row['userFullName']; ?></td>
                                                    <td class="column-3 text-center"><?php echo $e_row['art_staff_reg_no']; ?></td>
                                                    <td class="column-4 text-center"><?php echo $e_row['art_staff_date_commencement']; ?></td>
                                                    <td class="column-5 text-center"><?php echo $e_row['art_staff_year_completion_inter_ca']; ?></td>
                                                    <td class="column-6 text-center"><?php echo $e_row['art_staff_remark']; ?></td>
                                                    <td class="column-6 text-center"><?php echo $e_row['art_staff_year_completion_inter_ca']; ?></td>
                                                    <td class="column-6 text-center"><?php echo $e_row['art_staff_year_completion_final_ca']; ?></td>
                                                    <td class="column-6 text-center"><?php echo $e_row['art_staff_job_status']; ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="6">
                                                    <center>No Records</center>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            <?php elseif ($currTab == 4) : ?>
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1" width="1%" rowspan="2">SN</th>
                                            <th class="column-2" width="25%" colspan="2">Details of Paid Assistant-CA</th>
                                            <th class="column-3" width="25%" colspan="2">Period of Employment</th>
                                            <th class="column-3" width="25%" colspan="2">Intimation to ICAI</th>
                                            <th class="column-4" width="24%" rowspan="2">Remarks<br />(If Any)</th>
                                        </tr>
                                        <tr class="row-1">
                                            <th class="column-1" width="15%">Name</th>
                                            <th class="column-2" width="10%">Membership No</th>
                                            <th class="column-3" width="12%">From</th>
                                            <th class="column-3" width="12%">To</th>
                                            <th class="column-4" width="7%">Employment</th>
                                            <th class="column-5" width="7%">Termination</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if (!empty($staffList)) : ?>
                                            <?php foreach ($staffList as $k_row => $e_row) : ?>
                                                <tr>
                                                    <td class="column-1 text-center"><?php echo $i + 1; ?></td>
                                                    <td class="column-2 text-center"><?php echo $e_row['userFullName']; ?></td>
                                                    <td class="column-3 text-center"><?php echo $e_row['ca_membership_no']; ?></td>
                                                    <td class="column-4 text-center"><?php echo $e_row['ca_date_commencement']; ?></td>
                                                    <td class="column-5 text-center"><?php echo $e_row['ca_date_termination']; ?></td>
                                                    <td class="column-6 text-center"><?php echo $e_row['ca_date_intimation_icai']; ?></td>
                                                    <td class="column-6 text-center"><?php echo $e_row['ca_date_intimation_icai_termination']; ?></td>
                                                    <td class="column-6 text-center"><?php echo $e_row['ca_remark']; ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="6">
                                                    <center>No Records</center>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
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