<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
.tablepress tbody tr:first-child td {
    background: #f6fbff !important;
}
</style>

    <!-- Main content -->
    <section class="content mt-40">
        <div class="row">
            
            <div class="col-xl-10 col-lg-10 col-12">
                <!--<div class="col-12">-->
    
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
                                    			<th class="column-2">Due Date For</th>
                                    			<th class="column-3">Act</th>
                                    			<!--<th class="column-4">Tax Payer</th>-->
                                    			<th class="column-5">Section</th>
                                    			<!--<th class="column-6">Audit</th>-->
                                    			<th class="column-7">Form</th>
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
                                                    <tr class="row-3" style="background-color:#f6fbff;">
                                                        <td class="column-1"><?php echo $actDay; ?></td>
                                                        <td class="column-2">
                                                            <?php 
                                                                if(!empty($e_row['act_option_name1']))
                                                                    echo $e_row['act_option_name1']; 
                                                                else
                                                                    echo "N/A"; 
                                                            ?>
                                                        </td>
                                                        <td class="column-3"><?php echo $e_row['act_name']; ?></td>
                                                        <!--<td class="column-4">-->
                                                            <?php 
                                                                // if(!empty($e_row['act_option_name2']))
                                                                //     echo $e_row['act_option_name2']; 
                                                                // else
                                                                //     echo "N/A"; 
                                                            ?>
                                                        <!--</td>-->
                                                        <td class="column-5">
                                                            <?php 
                                                                if(!empty($e_row['act_option_name3']))
                                                                    echo $e_row['act_option_name3']; 
                                                                else
                                                                    echo "N/A"; 
                                                            ?>
                                                        </td>
                                                        <!--<td class="column-6">-->
                                                            <?php 
                                                                // if(!empty($e_row['act_option_name4']))
                                                                //     echo $e_row['act_option_name4']; 
                                                                // else
                                                                //     echo "N/A"; 
                                                            ?>
                                                        <!--</td>-->
                                                        <td class="column-7">
                                                            <?php 
                                                                if(!empty($e_row['act_option_name5']))
                                                                    echo $e_row['act_option_name5']; 
                                                                else
                                                                    echo "N/A"; 
                                                            ?>
                                                        </td>
                                                        <td class="column-8">
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
                                                        <td class="column-7">
                                                            <?php echo $e_row['finYear']; ?>
                                                        </td>
                                                        <td class="column-9">
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
                                                            <button type="button" class="waves-effect waves-light btn btn-primary mb-5" data-toggle="modal" data-target="#modal_view<?php echo $k_row; ?>">
                                                                Note
                                                            </button>
    
                                                            <!-- Modal -->
                                                            <div class="modal center-modal fade" id="modal_view<?php echo $k_row; ?>" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Acts Details</h5>
                                                                            <button type="button" class="close" data-dismiss="modal">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p><?php echo $e_row['due_notes']; ?></p>
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
            <div class="col-xl-2 col-lg-2 col-12">
                <?= view_cell('\App\Libraries\Utility::admin_menus'); ?>
    		</div> 

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


<?= $this->endSection(); ?>