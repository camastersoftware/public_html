<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>

.theme-primary .btnPrimClr {
    margin-top: 0px !important;
    margin-bottom: 0px !important;
}

td.column_date {
    font-size: 15px !important;
}

.font_bold{
    font-weight: bold !important;
}

.tablepress tbody td, .tablepress tfoot th {
    border: 1px solid #015aacab !important;
    /*color: #000;*/
}

</style>

    <!-- Main content -->
    <section class="content mt-40">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-12">
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
                            <a href="<?php echo base_url('home'); ?>">
                                <button type="button" class="btn btn-sm btn-dark" >Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-12 text-justify-center table-responsive">
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1">Due Date</th>
                                            <th class="column-7">Form</th>
                                            <th class="column-7">Type</th>
                                            <th class="column-2">Due Date For</th>
                                            <th class="column-3">Act</th>
                                            <th class="column-5">Section</th>
                                            <th class="column-8">Periodicity</th>
                                            <th class="column-8">Financial<br/>Year</th>
                                            <th class="column-9">Period</th>
                                            <th class="column-10">Action</th>
                                            <th class="column-11">Days Left</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">	
                                        <?php if(!empty($dueDatesArr)): ?>
                                            <?php foreach($dueDatesArr AS $k_row=>$e_row): ?>
                                                <?php $extended_date_notes=htmlspecialchars_decode(html_entity_decode($e_row['due_notes'])); ?>
                                                <tr class="row-3" style="background-color:#96c7f242;">
                                                    <td class="column-1 column_date"><?php echo $actDateFormat; ?></td>
                                                    <td class="column-7 font_bold text-center">
                                                        <?php 
                                                            if(!empty($e_row['act_option_name5']))
                                                                echo $e_row['act_option_name5']; 
                                                            else
                                                                echo "N/A"; 
                                                        ?>
                                                    </td>
                                                    <td class="column-7 text-center" nowrap>
                                                        <?php
                                                            if(!empty($e_row['dueDateTypeShortName']))
                                                                echo $e_row['dueDateTypeShortName']; 
                                                            else
                                                                echo "N/A"; 
                                                        ?>
                                                    </td>
                                                    <td class="column-2">
                                                        <?php if(!empty($e_row['act_option_name1'])): ?>
                                                            <?php $dueDateForStr=$e_row['act_option_name1']; ?>
                                                                
                                                            <?php if(strlen($dueDateForStr)>50): ?>
                                                            
                                                                <span data-toggle="tooltip" data-original-title="<?= $dueDateForStr; ?>" style="cursor:pointer;">
                                                                    <?= $dueDateForText=substr($dueDateForStr, 0, 50)."..."; ?>
                                                                </span>
                                                                    
                                                            <?php else: ?>
                                                                <?= $dueDateForStr; ?>
                                                            <?php endif; ?>
                                                            
                                                        <?php else: ?>
                                                            <div class="text-center">N/A</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="column-3 text-center"><?php echo $e_row['act_short_name']; ?></td>
                                                    <td class="column-5 text-center" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['act_option_name3']))
                                                                echo $e_row['act_option_name3']; 
                                                            else
                                                                echo "N/A"; 
                                                        ?>
                                                    </td>
                                                    <td class="column-8 text-center">
                                                        <?php 
                                                            if($e_row['periodicity']=="1")
                                                            {
                                                                echo "Daily";
                                                            }
                                                            elseif($e_row['periodicity']=="2")
                                                            {
                                                                echo "Monthly";
                                                            }
                                                            elseif($e_row['periodicity']=="3")
                                                            {
                                                                echo "Quaterly";
                                                            }
                                                            elseif($e_row['periodicity']=="4")
                                                            {
                                                                echo "Half Yearly";
                                                            }
                                                            elseif($e_row['periodicity']=="5")
                                                            {
                                                                echo "Annually";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="column-7 text-center">
                                                        <?php echo $e_row['finYear']; ?>
                                                    </td>
                                                    <td class="column-9 text-center">
                                                        <?php 
                                                            if($e_row['periodicity']=="1")
                                                            {
                                                                echo date("d-M-Y", strtotime($e_row["daily_date"]));
                                                            }
                                                            elseif($e_row['periodicity']=="2")
                                                            {
                                                                echo date("M", strtotime("2021-".$e_row["period_month"]."-01"))."-".$e_row["period_year"];
                                                            }
                                                            elseif($e_row['periodicity']>="3")
                                                            {
                                                                echo date("M", strtotime("2021-".$e_row["f_period_month"]."-01"))."-".$e_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_row["t_period_month"]."-01"))."-".$e_row["t_period_year"];
                                                            }
                                                            else
                                                            {
                                                                echo "N/A";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="column-10">
                                                        <div class="d-flex justify-content-center">
                                                            <?php
                                                                $emptyDDFDocs = false;
                                                                if(empty($extended_date_notes) && empty($e_row['ext_doc_file'])){
                                                                    $emptyDDFDocs = true;
                                                                }

                                                                $disabledDropdown = $emptyDDFDocs ? 'disabled' : '';
                                                            ?>
                                                            <div class="btn-group mb-5">
                                                                <button type="button" class="waves-effect waves-light btn btn-sm btn-info btnPrimClr dropdown-toggle <?= $disabledDropdown; ?>" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#modal_view<?php echo $k_row; ?>">View Note</a>
                                                                    <?php if(!empty($e_row['ext_doc_file'])): ?>
                                                                        <a class="dropdown-item" href="<?php echo base_url("uploads/admin/due_date/".$e_row['ext_doc_file']); ?>" target="_blank">View Document</a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modal_view<?php echo $k_row; ?>" tabindex="-1">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Note</h5>
                                                                        <button type="button" class="close" data-dismiss="modal">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p><?php echo $extended_date_notes; ?></p>
                                                                    </div>
                                                                    <div class="modal-footer modal-footer-uniform text-right">
                                                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal -->
                                                    </td>
                                                    <td class="column-11 text-center">
                                                        <?php
                                                            $now = time(); // or your date as well
                                                            $your_date = strtotime($actDate);
                                                            $datediff = $now - $your_date;
                                                            
                                                            if($your_date>$now)
                                                                echo abs((float)round($datediff / (60 * 60 * 24)));
                                                            else
                                                                echo "-";
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="11"><center>No Records</center></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>	
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


<?= $this->endSection(); ?>