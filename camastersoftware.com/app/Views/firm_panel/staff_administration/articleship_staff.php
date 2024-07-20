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

                        <a href="<?php echo base_url('master_data'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right ml-1" style="">Back</button>
                        </a>
                        <a href="<?php echo base_url('create-articleship/0'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit float-right ml-1" style="">Add Articleship</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border p-15" id="myTabContent">

                        <div class="tab-pane fade table-responsive show active" id="articleship_staff_tab" role="tabpanel" aria-labelledby="articleship_staff-tab">

                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                <thead>
                                    <tr class="row-1">
                                        <th class="" width="1%" rowspan="2">SN</th>
                                        <th class="column-2" width="15%" rowspan="2" nowrap>Name of the Articled Student</th>
                                        <th class="column-3" width="5%" rowspan="2" nowrap>REGN. No.</th>
                                        <th class="column-3" width="25%" colspan="3">Period of Training</th>
                                        <th class="column-3" width="25%" colspan="2">Date of Passing</th>
                                        <th class="column-4" width="25%" rowspan="2">Remarks (If Any)</th>
                                    </tr>
                                    <tr class="row-1">
                                        <!-- <th class="" width="16%" colspan="2">Articleship Completed / Transfer</th> -->

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
                                                <td class=" text-center"><?php echo $i + 1; ?></td>
                                                <td class="column-2 text-center"><?php echo $e_row['userFullName']; ?></td>
                                                <td class="column-3 text-center"><?php echo $e_row['art_staff_reg_no']; ?></td>
                                                <td class="column-4 text-center"><?php 
                                                if(check_valid_date($e_row['art_staff_date_commencement']))
                                                $art_staff_date_commencement=date('d-m-Y', strtotime($e_row['art_staff_date_commencement']));
                                            else 
                                                $art_staff_date_commencement="";
                                                
                                                echo $art_staff_date_commencement ?></td>
                                                <td class="column-5 text-center"><?php 
                                                   if(check_valid_date($e_row['art_staff_year_completion_inter_ca']))
                                                   $art_staff_year_completion_inter_ca=date('d-m-Y', strtotime($e_row['art_staff_year_completion_inter_ca']));
                                               else 
                                                   $art_staff_year_completion_inter_ca="";

                                                   echo $art_staff_year_completion_inter_ca; ?></td>
                                                <td class="column-6 text-center"><?php echo $e_row['art_staff_remark']; ?></td>
                                                <td class="column-6 text-center"><?php 
                                                 if(check_valid_date($e_row['art_staff_year_completion_inter_ca']))
                                                 $art_staff_year_completion_inter_ca=date('d-m-Y', strtotime($e_row['art_staff_year_completion_inter_ca']));
                                                else 
                                                        $art_staff_year_completion_inter_ca="";

                                                        echo  $art_staff_year_completion_inter_ca; ?></td>
                                                <td class="column-6 text-center"><?php 
                                                 if(check_valid_date($e_row['art_staff_year_completion_final_ca']))
                                                 $art_staff_year_completion_final_ca=date('d-m-Y', strtotime($e_row['art_staff_year_completion_final_ca']));
                                                else 
                                                 $art_staff_year_completion_final_ca="";
                                                
                                                 echo  $art_staff_year_completion_final_ca; ?></td>
                                                <td class="column-6 text-center"><?php echo $e_row['art_staff_job_status']; ?></td>
                                            </tr>
                                        <?php $i++;
                                        endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="11">
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