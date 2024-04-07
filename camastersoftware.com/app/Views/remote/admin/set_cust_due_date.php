<?php if(empty($isActSel)): ?>
<div class="col-lg-12 col-md-12 act_table_<?php echo $due_act; ?>">
    <h4 class="income-tax-head text-center"><?php echo $due_act_name; ?></h4>
    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer allot_due_date">
        <thead>
            <tr class="row-1">
                <th class="column-1" nowrap>Due Date For</th>
                <th class="column-3">Section</th>
                <th class="column-4">Form</th>
                <th class="column-5 hide">Periodicity</th>
                <th class="column-6 hide">Period</th>
                <th class="column-7" nowrap>Date of Event</th>
                <th class="column-7" nowrap>Due Date</th>
                <th class="column-8">Note</th>
                <th class="column-9">Action</th>
            </tr>
        </thead>
        <tbody class="row-hover act_tbody_<?php echo $due_act; ?>">
<?php endif; ?>
            <tr class="row-3 row_<?php echo $due_act; ?>" style="background-color:#f6fbff;">
                <td class="column-1 text-left pl-25" style="width: 26% !important;">
                    <?php 
                        if(!empty($due_date_for))
                        {
                            $ddfValue=$due_date_for;
                            
                            if(strlen($due_date_for)>30)
                                $ddfVal=substr($due_date_for, 0, 30)."...";
                            else
                                $ddfVal=$due_date_for;
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
                <td class="column-3 text-center" style="width: 10% !important;" nowrap>
                    <?php 
                        if(!empty($under_section))
                            echo $under_section; 
                        else
                            echo "N/A"; 
                    ?>
                </td>
                <td class="column-4 text-center" style="width: 7% !important;" nowrap>
                    <?php 
                        if(!empty($applicable_form))
                            echo $applicable_form; 
                        else
                            echo "N/A"; 
                    ?>
                </td>
                <td class="column-5 text-center hide" style="width: 5% !important;" nowrap>
                    <?php 
                        if($periodicity=="1")
                        {
                            echo "Daily";
                        }
                        elseif($periodicity=="2")
                        {
                            echo "Monthly";
                        }
                        elseif($periodicity=="3")
                        {
                            echo "Quaterly";
                        }
                        elseif($periodicity=="4")
                        {
                            echo "Half Yearly";
                        }
                        elseif($periodicity=="5")
                        {
                            echo "Annually";
                        }
                    ?>
                </td>
                <td class="column-6 text-center hide" style="width: 17% !important;" nowrap>
                    <?php 
                        if($periodicity=="1")
                        {
                            echo date("d-M-Y", strtotime($daily_date));
                        }
                        elseif($periodicity=="2")
                        {
                            echo date("M", strtotime("2021-".$period_month."-01"))."-".$period_year;
                        }
                        elseif($periodicity>="3")
                        {
                            echo date("M", strtotime("2021-".$f_period_month."-01"))."-".$f_period_year." - ".date("M", strtotime("2021-".$t_period_month."-01"))."-".$t_period_year;
                        }
                        else
                        {
                            echo "N/A";
                        }
                    ?>
                </td>
                <td class="column-7 text-center" style="width: 5% !important;" nowrap>
                    <?php echo (check_valid_date($event_date)) ? date('d-m-Y', strtotime($event_date)) : "N/A"; ?>
                </td>
                <td class="column-7 text-center" style="width: 5% !important;" nowrap>
                    <?php echo (check_valid_date($due_date)) ? date('d-m-Y', strtotime($due_date)) : "N/A"; ?>
                </td>
                <td class="column-8 text-center" style="width: 5% !important;" nowrap>
                    <?php $due_date_val=(check_valid_date($due_date)) ? date('Y-m-d', strtotime($due_date)) : ""; ?>
                    <?php $event_date_val=(check_valid_date($event_date)) ? date('Y-m-d', strtotime($event_date)) : ""; ?>
                    <input type="hidden" name="cust_actId[]" value="<?php echo $due_act; ?>">
                    <input type="hidden" name="non_rglr_due_state[]" value="<?php echo $due_state; ?>">
                    <input type="hidden" name="non_rglr_due_act[]" value="<?php echo $due_act; ?>">
                    <input type="hidden" name="non_rglr_due_date_for[]" value="<?php echo $due_date_for; ?>">
                    <input type="hidden" name="non_rglr_applicable_form[]" value="<?php echo $applicable_form; ?>">
                    <input type="hidden" name="non_rglr_under_section[]" value="<?php echo $under_section; ?>">
                    <input type="hidden" name="non_rglr_periodicity[]" value="<?php echo $periodicity; ?>">
                    <input type="hidden" name="non_rglr_daily_date[]" value="<?php echo $daily_date; ?>">
                    <input type="hidden" name="non_rglr_period_month[]" value="<?php echo $period_month; ?>">
                    <input type="hidden" name="non_rglr_period_year[]" value="<?php echo $period_year; ?>">
                    <input type="hidden" name="non_rglr_f_period_month[]" value="<?php echo $f_period_month; ?>">
                    <input type="hidden" name="non_rglr_f_period_year[]" value="<?php echo $f_period_year; ?>">
                    <input type="hidden" name="non_rglr_t_period_month[]" value="<?php echo $t_period_month; ?>">
                    <input type="hidden" name="non_rglr_t_period_year[]" value="<?php echo $t_period_year; ?>">
                    <input type="hidden" name="non_rglr_finYear[]" value="<?php echo $finYear; ?>">
                    <input type="hidden" name="non_rglr_due_date[]" value="<?php echo $due_date_val; ?>">
                    <input type="hidden" name="non_rglr_event_date[]" value="<?php echo $event_date_val; ?>">
                    <input type="hidden" name="non_rglr_due_notes[]" value="<?php echo $due_notes; ?>">
                    
                    <button type="button" class="waves-effect waves-light btn btn-sm btn-submit mb-5" data-toggle="modal" data-target="#modal_view<?php echo $due_act; ?>">
                        Note
                    </button>

                    <!-- Modal -->
                    <div class="modal center-modal fade" id="modal_view<?php echo $due_act; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Acts Details</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><?php echo $due_notes; ?></p>
                                </div>
                                <div class="modal-footer modal-footer-uniform text-right">
                                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->
                </td>
                <td class="column-9 text-center" style="width: 5% !important;" nowrap>
                    <a href="javascript:void(0);" class="delete_due_date" data-id="<?php echo $due_act; ?>" data-due="" data-client="">
                        <i class="fa fa-trash fa-1x text-danger" style="font-size: 20px !important;"></i>
                    </a>
                </td>
            </tr>
<?php if(empty($isActSel)): ?>
        </tbody>
    </table>
</div>
<?php endif; ?>