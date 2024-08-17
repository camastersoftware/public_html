<?php if(!empty($dueDatesArr)): ?>
    <?php if(empty($isActSel)): ?>
    <div class="col-lg-12 col-md-12 act_table_<?php echo $actId; ?>">
        <h4 class="income-tax-head text-center"><?php echo $actName; ?></h4>
        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer allot_due_date">
            <thead>
                <tr class="row-1">
                    <th class="column-1">Due Date For</th>
                    <th class="column-2">Tax Payer</th>
                    <th class="column-3">Section</th>
                    <th class="column-4">Form</th>
                    <th class="column-5">Periodicity</th>
                    <th class="column-6">Period</th>
                    <th class="column-7">Due Date</th>
                    <th class="column-8">Junior</th>
                    <th class="column-9">Action</th>
                </tr>
            </thead>
            <tbody class="row-hover act_tbody_<?php echo $actId; ?>">
    <?php endif; ?>
                <?php if(!empty($dueDatesArr)): ?>
                    <?php foreach($dueDatesArr AS $k_row=>$e_row): ?>
                        <?php $uniqueRowId=$actId.$k_row.$e_row['due_date_id']; ?>
                        <tr class="row-3 row_<?php echo $actId.$k_row.$e_row['due_date_id']; ?>" style="background-color:#f6fbff;">
                            <td class="column-1 text-left pl-25" style="width: 26% !important;">
                                <?php 
                                    if(!empty($e_row['act_option_name1']))
                                    {
                                        $ddfValue=$e_row['act_option_name1'];
                                        
                                        if(strlen($e_row['act_option_name1'])>30)
                                            $ddfVal=substr($e_row['act_option_name1'], 0, 30)."...";
                                        else
                                            $ddfVal=$e_row['act_option_name1'];
                                    }
                                    else
                                    {
                                        $ddfValue=$ddfVal="N/A";
                                    }
                                ?>
                                <span data-toggle="tooltip" data-original-title="<?= $ddfValue; ?>" style="cursor: pointer;">
                                    <?= $ddfVal;  ?>
                                </span>
                            </td>
                            <td class="column-2 text-center" style="width: 20% !important;">
                                <?php 
                                    if(!empty($e_row['tax_payer_val']))
                                        echo $e_row['tax_payer_val']; 
                                    else
                                        echo "N/A"; 
                                ?>
                            </td>
                            <td class="column-3 text-center" style="width: 10% !important;" nowrap>
                                <?php 
                                    if(!empty($e_row['act_option_name3']))
                                        echo $e_row['act_option_name3']; 
                                    else
                                        echo "N/A"; 
                                ?>
                            </td>
                            <td class="column-4 text-center" style="width: 7% !important;" nowrap>
                                <?php 
                                    if(!empty($e_row['act_option_name5']))
                                        echo $e_row['act_option_name5']; 
                                    else
                                        echo "N/A"; 
                                ?>
                            </td>
                            <td class="column-5 text-center" style="width: 5% !important;" nowrap>
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
                            <td class="column-6 text-center" style="width: 17% !important;" nowrap>
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
                            <td class="column-7 text-center" style="width: 5% !important;" nowrap><?php echo date('d-m-Y', strtotime($e_row['extended_date'])); ?></td>
                            <td class="column-8 text-center" style="width: 5% !important;" nowrap>
                                
                                <input type="hidden" name="work_actId[]" value="<?php echo $actId; ?>">
                                <input type="hidden" name="actIdValue[]" value="<?php echo $actId; ?>">
                                <input type="hidden" name="due_date_for[]" value="<?php echo $e_row['due_date_for']; ?>">
                                <input type="hidden" name="due_date_id[]" value="<?php echo $e_row['due_date_id']; ?>">
                                
                                <?php if($e_row['periodicity']=="2"): ?>
                                    <input type="hidden" name="actFMth[]" value="<?php echo $e_row["period_month"]; ?>">
                                    <input type="hidden" name="actFYr[]" value="<?php echo $e_row["period_year"]; ?>">
                                    <input type="hidden" name="actTMth[]" value="">
                                    <input type="hidden" name="actTYr[]" value="">
                                <?php elseif($e_row['periodicity']>="3"): ?>
                                    <input type="hidden" name="actFMth[]" value="<?php echo $e_row["f_period_month"]; ?>">
                                    <input type="hidden" name="actFYr[]" value="<?php echo $e_row["f_period_year"]; ?>">
                                    <input type="hidden" name="actTMth[]" value="<?php echo $e_row["t_period_month"]; ?>">
                                    <input type="hidden" name="actTYr[]" value="<?php echo $e_row["t_period_year"]; ?>">
                                <?php else: ?>
                                    <input type="hidden" name="actFMth[]" value="">
                                    <input type="hidden" name="actFYr[]" value="">
                                    <input type="hidden" name="actTMth[]" value="">
                                    <input type="hidden" name="actTYr[]" value="">
                                <?php endif; ?>
                                <span> - </span>
                            </td>
                            <td class="column-9 text-center" style="width: 5% !important;" nowrap>

                                <div class="btn-group">
                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu" style="will-change: transform;">
                                        <?php if(!empty($e_row['due_notes'])): ?>
                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#modal_view<?= $actId.$k_row; ?>">
                                            <i class="fa fa-file"></i>&nbsp;View Note
                                        </a>
                                        <?php endif; ?>
                                        <a class="dropdown-item delete_due_date" href="javascript:void(0);" data-id="<?= $uniqueRowId; ?>" data-due="" data-client="">
                                            <i class="fa fa-trash text-danger"></i>&nbsp;Delete
                                        </a>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal center-modal fade" id="modal_view<?php echo $actId.$k_row; ?>" tabindex="-1">
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
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9"><center>No Records</center></td>
                    </tr>
                <?php endif; ?>
    <?php if(empty($isActSel)): ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
<?php endif; ?>