
<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
.modal-xl {
    max-width: 1295px !important;
}

#filterLabels div.col-md-6{
    font-size: 15px !important;
    font-weight: bold !important;
}

.tabcontent-border {
    border: 1px solid #bfbfbf !important;
}

td.column_date {
    font-size: 15px !important;
}

.tablepress tbody td, .tablepress tfoot th {
    border: 1px solid #015aacab !important;
    /*color: #000;*/
}

.nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
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

.theme-primary .btn-info {
  height: 25px !important;
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
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            <a href="<?php echo base_url('add-non-regular-due-date'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Add Non-Regular Due Date</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                        <thead>
                                            <tr class="row-1">
                                                <th class="column-1">Due Date</th>
                                                <th class="column-2">Due Date For</th>
                                                <th class="column-3">Act</th>
                                                <th class="column-4">Periodicity</th>
                                                <th class="column-5">Financial<br/>Year</th>
                                                <th class="column-6">Period</th>
                                                <th class="column-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="row-hover">
                                            <?php if(!empty($dueDatesArr)): ?>
                                                <?php foreach($dueDatesArr AS $k_row=>$e_row): ?>
                                                    <?php $non_rglr_due_date=$e_row['non_rglr_due_date']; ?>
                                                    <?php $non_rglr_due_date_notes=htmlspecialchars_decode(html_entity_decode($e_row['non_rglr_due_notes'])); ?>
                                                    <tr class="row-3" style="background-color:#96c7f242;">
                                                        <td class="column-1 column_date" nowrap><?php echo date('d-m-Y', strtotime($e_row['non_rglr_due_date'])); ?></td>
                                                        <td class="column-2" nowrap>
                                                            <?php if(!empty($e_row['non_regular_due_date_for_name'])): ?>
                                                                <?php $dueDateForStr=$e_row['non_regular_due_date_for_name']; ?>
                                                                    
                                                                <?php if(strlen($dueDateForStr)>50): ?>
                                                                
                                                                    <span data-toggle="tooltip" data-original-title="<?= $dueDateForStr; ?>" style="cursor:pointer;"><?= $dueDateForText=substr($dueDateForStr, 0, 50)."..."; ?></span>
                                                                        
                                                                <?php else: ?>
                                                                    <?= $dueDateForStr; ?>
                                                                <?php endif; ?>
                                                                
                                                            <?php else: ?>
                                                                <div class="text-center">N/A</div>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="column-3 text-center" nowrap><?php echo $e_row['act_short_name']; ?></td>
                                                        <td class="column-8 text-center" nowrap>
                                                            <?php 
                                                                if($e_row['non_rglr_periodicity']=="1")
                                                                {
                                                                    echo "Daily";
                                                                }
                                                                elseif($e_row['non_rglr_periodicity']=="2")
                                                                {
                                                                    echo "Monthly";
                                                                }
                                                                elseif($e_row['non_rglr_periodicity']=="3")
                                                                {
                                                                    echo "Quaterly";
                                                                }
                                                                elseif($e_row['non_rglr_periodicity']=="4")
                                                                {
                                                                    echo "Half Yearly";
                                                                }
                                                                elseif($e_row['non_rglr_periodicity']=="5")
                                                                {
                                                                    echo "Annually";
                                                                }
                                                                else
                                                                {
                                                                    echo "N/A";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="column-3 text-center" nowrap><?php echo $e_row['non_rglr_finYear']; ?></td>
                                                        <td class="column-9 text-center" nowrap>
                                                            <?php 
                                                                if($e_row['non_rglr_periodicity']=="1")
                                                                {
                                                                    echo date("d-M-Y", strtotime($e_row["non_rglr_daily_date"]));
                                                                }
                                                                elseif($e_row['non_rglr_periodicity']=="2")
                                                                {
                                                                    echo date("M", strtotime("2021-".$e_row["non_rglr_period_month"]."-01"))."-".$e_row["non_rglr_period_year"];
                                                                }
                                                                elseif($e_row['non_rglr_periodicity']>="3")
                                                                {
                                                                    echo date("M", strtotime("2021-".$e_row["non_rglr_f_period_month"]."-01"))."-".$e_row["non_rglr_f_period_year"]." - ".date("M", strtotime("2021-".$e_row["non_rglr_t_period_month"]."-01"))."-".$e_row["non_rglr_t_period_year"];
                                                                }
                                                                else
                                                                {
                                                                    echo "N/A";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="column-10" nowrap>
                                                            
                                                            <div class="btn-group mb-5">
                                                                <button type="button" class="waves-effect waves-light btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                    <a class="dropdown-item" href="<?= base_url('edit-non-regular-due-date/'.$e_row['non_rglr_due_date_id']);?>" >Edit</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#modal_view<?php echo $k_row; ?>">View Note</a>
                                                                    <?php if(!empty($e_row['non_rglr_doc_file'])): ?>
                                                                        <?php $non_rglr_doc_file_path = base_url("uploads/ca_firm_".$sessCaFirmId."/non_regular_due_dates/".$e_row['non_rglr_doc_file']); ?>
                                                                        <a class="dropdown-item" href="<?php echo $non_rglr_doc_file_path; ?>" target="_blank">View Document</a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modal_view<?php echo $k_row; ?>" tabindex="-1">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Acts Details</h5>
                                                                            <button type="button" class="close" data-dismiss="modal">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body" style="width: 100% !important;">
                                                                            <?php if(!empty($non_rglr_due_date_notes)): ?>
                                                                                <?php echo $non_rglr_due_date_notes; ?>
                                                                            <?php else: ?>
                                                                                N/A
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="modal-footer text-right">
                                                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal -->
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7"><center>No Records</center></td>
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


<?= $this->endSection(); ?>