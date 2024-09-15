<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .theme-primary .box-primary {
        background-color: #2b8836 !important;
    }

    .modal-header {
        border-bottom-color: #d5dfea;
        background-color:#F99D27;
        padding: 8px 8px;
    }

    .income-tax-head {
        background: #ffc800;
        padding:10px;
        margin-bottom:0px;
        font-weight:bold;
    }

    table.dataTable {
        margin-top: 0px !important; 
    }

    .tablepress td, .tablepress th {
        font-weight: 600;
    }

    td.column-1 {
        font-size:14px;
    }

    .modal-header h4{
        text-align: center;
    }

    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
    }
    
    .getActModal .box{
        cursor: pointer !important;
    }
    
    .box_body_bg {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        /*border-radius: 10px;*/
        border: 1px solid #015aacab !important;
        background: #ffffff !important;
        /*margin-top: 20px !important;*/
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
    
    .tablepress td {
        font-weight: 400 !important;
    }
    
    .tablepress thead th {
        background-color: #005495 !important;
    }
    
    .demo-checkbox .box-header {
        background-color: #005495 !important;
        border-radius: 10px !important;
    }
    
    .demo-checkbox .box-header.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
    }
    
    .demo-checkbox .box_head_cl.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
    }
    
    .tablepress tbody tr {
        background: #96c7f242 !important;
    }
    
    .tablepress tr td {
        border: 1px solid #015aacab !important;
    }
    
    .actionCol .btnPrimClr{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
    
    .tablepress tbody tr.hasCompleted{
        background : #24d724a6 !important;
    }
</style>

<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold text-center"><?php echo $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('client-wise-act-cost-sheet/'.$clientId); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit" style="">Act-wise</button>
                        </a>
                        <a href="<?php echo base_url('client-wise-cost-sheet'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body box_body_bg wizard-content">
                    <section>
                        <h4 class="text-center font-weight-bold"><?= $clientNameVar; ?></h4>
                        <div class="row sel_act_due_date">
                            <?php
                                $mthItr=0;
                                $mthCount = count($workMthsArr);
                                $grandTotalWorkTotalCost = 0;
                                $grandTotalBillAmt = 0;
                                $grandTotalReceiptAmt = 0;
                            ?>
                            <?php if(!empty($workMthArr)): ?>
                                <?php foreach($workMthArr AS $k_mth_id=>$e_mth): ?>
                                    <?php
                                        if(isset($workListArr[$k_mth_id]))
                                        {
                                            $wkListArr=$workListArr[$k_mth_id];
                                            $mthItr++;
                                        }
                                        else
                                        {
                                            $wkListArr=array();
                                        }
                                    ?>
                                    <?php if(!empty($wkListArr)): ?>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="income-tax-head text-center"><?php echo $e_mth; ?></h4>
                                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer allot_due_date">
                                                <thead>
                                                    <tr class="row-1">
                                                        <th class="column-7" style="width: 7% !important;">Due Date</th>
                                                        <th class="column-1" style="width: 27% !important;">Due Date For</th>
                                                        <th class="column-1" style="width: 8% !important;">Act</th>
                                                        <th class="column-4" style="width: 11% !important;">Form</th>
                                                        <th class="column-6" style="width: 17% !important;">Period</th>
                                                        <th class="column-8" style="width: 5% !important;">Completion&nbsp;Date</th>
                                                        <th class="column-5" style="width: 5% !important;">Cost</th>
                                                        <th class="column-5" style="width: 5% !important;">Billing</th>
                                                        <th class="column-5" style="width: 5% !important;">Receipts</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row-hover">
                                                    <?php
                                                        $totalWorkTotalCost = 0;
                                                        $totalBillAmt = 0;
                                                        $totalReceiptAmt = 0;
                                                    ?>
                                                    <?php if(!empty($wkListArr)): ?>
                                                        <?php $lastKey = array_key_last($wkListArr); ?>
                                                        <?php foreach($wkListArr AS $k_row=>$e_row): ?>
                                                        <?php 
                                                            if(!empty($e_row['workTotalCost']))
                                                                $workTotalCost = $e_row['workTotalCost']; 
                                                            else
                                                                $workTotalCost = 0; 

                                                            if(!empty($e_row['billAmt']))
                                                                $billAmt = $e_row['billAmt']; 
                                                            else
                                                                $billAmt = 0; 

                                                            if(!empty($e_row['receiptAmt']))
                                                                $receiptAmt = $e_row['receiptAmt']; 
                                                            else
                                                                $receiptAmt = 0; 
                                                            
                                                            $totalWorkTotalCost+=$workTotalCost;
                                                            $totalBillAmt+=$billAmt;
                                                            $totalReceiptAmt+=$receiptAmt;
                                                        ?>
                                                        <?php $uniQId=$k_mth_id.$k_row.$e_row['due_date_id']; ?>
                                                        <?php 
                                                            $eFillingDate="-";
                                                            if(!empty($e_row['eFillingDate']) && $e_row['eFillingDate']!="0000-00-00" && $e_row['eFillingDate']!="1970-01-01")
                                                                $eFillingDate=date('d-m-Y', strtotime($e_row['eFillingDate'])); 
                                                        ?>
                                                        <tr class="row-3 row_<?= $uniQId; ?> <?php if($eFillingDate!="-"): ?>hasCompleted<?php endif; ?>" >
                                                            <td class="column-7 text-center" style="width: 7% !important;" nowrap><?php echo date('d-m-Y', strtotime($e_row['extended_date'])); ?></td>
                                                            <td class="column-1 text-left pl-25" style="width: 27% !important;">
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
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#details_modal<?= $uniQId; ?>">
                                                                    <span data-toggle="tooltip" data-original-title="<?= $ddfValue; ?>" style="cursor: pointer;">
                                                                        <?= $ddfVal;  ?>
                                                                    </span>
                                                                </a>
                                                                <!-- Modal -->
                                                                <div id="details_modal<?= $uniQId; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title font-weight-bold" id="myModalLabel">Staff Members</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="table-responsive">
                                                                                            <table class="clientGrpTable" style="width:100%">
                                                                                                <thead>
                                                                                                    <tr class="text-center">
                                                                                                        <th width="5%">SN</th>
                                                                                                        <th width="55%">Staff&nbsp;Name</th>
                                                                                                        <th width="20%">Hours&nbsp;Worked</th>
                                                                                                        <th width="20%">Cost</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <?php if(isset($staffCostArr[$e_row['workId']])): ?>
                                                                                                        <?php $staffCostArray=$staffCostArr[$e_row['workId']]; ?>
                                                                                                        <?php $tsTotalHoursTotal = 0; ?>
                                                                                                        <?php $tsTotalCostTotal = 0; ?>
                                                                                                        <?php if(!empty($staffCostArray)): ?>
                                                                                                            <?php $c=1; ?>
                                                                                                            <?php foreach($staffCostArray AS $e_staff): ?>
                                                                                                                <?php 
                                                                                                                    if(!empty($e_staff['tsTotalHours']))
                                                                                                                        $tsTotalHours = $e_staff['tsTotalHours']; 
                                                                                                                    else
                                                                                                                        $tsTotalHours = 0;

                                                                                                                    if(!empty($e_staff['tsTotalCost']))
                                                                                                                        $tsTotalCost = $e_staff['tsTotalCost']; 
                                                                                                                    else
                                                                                                                        $tsTotalCost = 0;

                                                                                                                    $tsWorkedHours = getHoursAndMinutesFormat($tsTotalHours); 
                                                                                                                    $tsWorkedHoursVal=$tsWorkedHours["hours"].".". $tsWorkedHours["minutes"];

                                                                                                                    $tsTotalHoursTotal += $tsTotalHours; 
                                                                                                                    $tsTotalCostTotal += $tsTotalCost; 
                                                                                                                ?>
                                                                                                                <tr>
                                                                                                                    <td width="5%" class="text-center"><?php echo $c; ?></td>
                                                                                                                    <td nowrap width="55%">
                                                                                                                        <?php echo $e_staff['userFullName']; ?>
                                                                                                                    </td>
                                                                                                                    <td nowrap width="20%" class="text-right">
                                                                                                                        <?php echo number_format($tsWorkedHoursVal, 2, '.', ''); ?>
                                                                                                                    </td>
                                                                                                                    <td nowrap width="20%" class="text-right">
                                                                                                                        <?php echo amount_format($tsTotalCost); ?>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            <?php $c++; ?>
                                                                                                            <?php endforeach; ?>
                                                                                                            <tr>
                                                                                                                <td></td>
                                                                                                                <td nowrap width="55%" class="text-right">
                                                                                                                    <b>Total</b>
                                                                                                                </td>
                                                                                                                <td nowrap width="20%" class="text-right">
                                                                                                                    <?php
                                                                                                                        $tsWorkedHoursTotal = getHoursAndMinutesFormat($tsTotalHoursTotal); 
                                                                                                                        $tsTotalHoursTotalVal=$tsWorkedHoursTotal["hours"].".". $tsWorkedHoursTotal["minutes"];
                                                                                                                    ?>
                                                                                                                    <b><?php echo $tsTotalHoursTotalVal; ?></b>
                                                                                                                </td>
                                                                                                                <td nowrap width="20%" class="text-right">
                                                                                                                    <b><?php echo amount_format($tsTotalCostTotal); ?></b>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        <?php else: ?>
                                                                                                            <tr>
                                                                                                                <td colspan="4"><center>No records found</center></td>
                                                                                                            </tr>
                                                                                                        <?php endif; ?>
                                                                                                    <?php else: ?>
                                                                                                        <tr>
                                                                                                            <td colspan="4"><center>No records found</center></td>
                                                                                                        </tr>
                                                                                                    <?php endif; ?>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer text-right" style="width: 100%;">
                                                                                <button type="button" class="btn btn-danger text-left close_btn" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- /.modal -->
                                                            </td>
                                                            <td class="column-3 text-center" style="width: 8% !important;" nowrap>
                                                                <span data-toggle="tooltip" data-original-title="<?= $e_row['act_name']; ?>" style="cursor: pointer;">
                                                                    <?php echo $e_row['act_short_name']; ?>
                                                                </span>
                                                            </td>
                                                            <td class="column-4 text-center" style="width: 11% !important;" nowrap>
                                                                <?php 
                                                                    if(!empty($e_row['act_option_name5']))
                                                                        echo $e_row['act_option_name5']; 
                                                                    else
                                                                        echo "N/A"; 
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
                                                            <td class="column-8 text-center actionCol" style="width: 5% !important;" nowrap>
                                                                <input type="hidden" name="due_date_id[]" value="<?php echo $e_row['due_date_id']; ?>">
                                                                <?= $eFillingDate; ?>
                                                            </td>
                                                            <td class="column-4 text-right" style="width: 5% !important;" nowrap>
                                                                <?= amount_format($workTotalCost); ?>
                                                            </td>
                                                            <td class="column-4 text-right" style="width: 5% !important;" nowrap>
                                                                <?= amount_format($billAmt); ?>
                                                            </td>
                                                            <td class="column-4 text-right" style="width: 5% !important;" nowrap>
                                                                <?= amount_format($receiptAmt); ?>
                                                            </td>
                                                        </tr>
                                                        <?php if($k_row == $lastKey): ?>
                                                            <tr class="row-3">
                                                                <td colspan="5"></td>
                                                                <td class="column-8 text-center actionCol" style="width: 5% !important;" nowrap>
                                                                    <b>Total</b>
                                                                </td>
                                                                <td class="column-4 text-right" style="width: 5% !important;" nowrap>
                                                                    <b><?= amount_format($totalWorkTotalCost); ?></b>
                                                                </td>
                                                                <td class="column-4 text-right" style="width: 5% !important;" nowrap>
                                                                    <b><?= amount_format($totalBillAmt); ?></b>
                                                                </td>
                                                                <td class="column-4 text-right" style="width: 5% !important;" nowrap>
                                                                    <b><?= amount_format($totalReceiptAmt); ?></b>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="9"><center>No Records</center></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php
                                                        $grandTotalWorkTotalCost+=$totalWorkTotalCost;
                                                        $grandTotalBillAmt+=$totalBillAmt;
                                                        $grandTotalReceiptAmt+=$totalReceiptAmt;
                                                    ?>
                                                    <?php if($mthItr == $mthCount): ?>
                                                        <tr class="row-3">
                                                            <td colspan="5"></td>
                                                            <td class="column-8 text-center actionCol" style="width: 5% !important;" nowrap>
                                                                <b>Grand Total</b>
                                                            </td>
                                                            <td class="column-4 text-right" style="width: 5% !important;" nowrap>
                                                                <b><?= amount_format($grandTotalWorkTotalCost); ?></b>
                                                            </td>
                                                            <td class="column-4 text-right" style="width: 5% !important;" nowrap>
                                                                <b><?= amount_format($grandTotalBillAmt); ?></b>
                                                            </td>
                                                            <td class="column-4 text-right" style="width: 5% !important;" nowrap>
                                                                <b><?= amount_format($grandTotalReceiptAmt); ?></b>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>