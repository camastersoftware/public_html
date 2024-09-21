<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>

    .tabcontent-border {
        border: none;
        border-top: 0px;
    }
    
    .due-month{
        background:#F99D27;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }
    
    .due-month label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .heading-act {
        background:#00669d;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
        color:#fff;
    }
    
    .heading-act label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .table.dataTable-act {
        margin-top: 0px !important; 
        font-size: 12px !important;
        clear: both;
        margin-bottom: 6px !important;
        max-width: none !important;
        border-collapse: separate !important;
    }
    
    .tablepress thead tr, .tablepress thead th {
        border: 1px solid #ddd;
        color: #fff;
        font-size: 16px;
    }
    
    .tablepress tbody {
        font-size: 16px;
    }
    
    td.column-1 {
        text-align: center;
        font-weight: normal;
        font-size: 16px;
    }
    
    .tablepress tbody tr:first-child td {
        background: none;
    }
    
    .tablepress tbody tr:nth-child(4) td.column-1 {
        background: none;
    }
    
    .tablepress tbody td, .tablepress tfoot th {
      border: 1px solid #015aacab !important;
      color: #000;
    }
    
    .box-body {
        padding: 0.1rem 0.1rem;
        /* -ms-flex: 1 1 auto; */
        flex: 1 1 auto;
        border-radius: 10px;
    }
    
    .modal-header {
        
        border-bottom-color: #d5dfea;
        background-color: #F99D27;
        padding: 8px 8px;
    }
    
    .theme-primary .btn-success1 {
        background-color: #1e613b !important;
        border-color: #1e613b !important;
        color: #ffffff !important;
        width: 100px;
        font-size: 13px;
    }
    
    .theme-primary a:hover, .theme-primary a:focus {
        color: #303030 !important;
    }
    
    a {
        color: #303030;
    }

    .sub_btn{
        width: 80px !important;
    }
    
    .second_header_div{
        background:#96c7f242;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }
    
    .second_header{
        font-size: 15px;
        font-weight: bold;
        padding: 2px;
        color: #000;
    }
    
    .tbl_row_clr{
        background:#96c7f242 !important;
    }
    
    .hasAbove50Completed{
        background : #e8f219a3 !important;
    }
    
    .hasAbove75Completed{
        background : #f4a047a8 !important;
    } 
    
    .hasCompleted{
        background : #24d724a6 !important;
    }
    
    .urgent_work_clr{
        background : pink !important;
    }
    
    .none{
        background-color: #96c7f242 !important;
    }
    .red{
        background-color: pink !important;
    } 
    .yellow{
        background-color: #f0f58b7d !important;
    } 
    .violet{
        background-color: #f38bf5 !important;
    } 
    .green{
        background-color: #37fa1f !important;
    }
    
    .hasReturn{
        background: #e4f1fc;
    }
    
</style>
<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url('accountFinance'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    
                    <?php $hasData=false; ?>

                    <div class="row mb-10">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-2" for="due_act_sel">Act :</label>
                                <div class="col-md-6">
                                    <select class="custom-select form-control" id="due_act_sel" name="due_act_sel">
                                        <option value="">Select Act</option>
                                        <?php if(!empty($actArr)): ?>
                                            <?php foreach($actArr AS $e_act): ?>
                                                <option value="<?php echo $e_act['act_id']; ?>" <?= ($e_act['act_id']==$actId) ? "selected":"" ?>><?php echo $e_act['act_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php if(!empty($DDFDueDateArr)): ?>
                                <?php foreach($DDFDueDateArr AS $k_due_date=>$e_due_date): ?>
                                
                                <?php $due_date_for_name=$e_due_date['act_option_name1']; ?>
                                
                                <?php $due_date_periodicity=$e_due_date['periodicity_name']; ?>
                                
                                <?php $due_date=$e_due_date['extended_date']; ?>
                                
                                <?php $dueDate=date('d-m-Y', strtotime($due_date)); ?>
                                
                                <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label>Due Date For : <?= $due_date_for_name; ?> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="state second_header_div">
                                                <div class="row">
                                                    <div class="col-md-4 text-center second_header">
                                                        Due Date : <?= $dueDate; ?>
                                                    </div>
                                                    <div class="col-md-4 text-center second_header">
                                                        Periodicity : <?= $due_date_periodicity; ?>
                                                    </div>
                                                    <div class="col-md-4 text-center second_header">
                                                        Period : 
                                                        <?php
                                                            if($e_due_date['periodicity']=="1")
                                                            {
                                                                echo date("d-M-Y", strtotime($e_due_date["daily_date"]));
                                                            }
                                                            elseif($e_due_date['periodicity']=="2")
                                                            {
                                                                echo date("M", strtotime("2021-".$e_due_date["period_month"]."-01"))."-".$e_due_date["period_year"];
                                                            }
                                                            elseif($e_due_date['periodicity']>="3")
                                                            {
                                                                echo date("M", strtotime("2021-".$e_due_date["f_period_month"]."-01"))."-".$e_due_date["f_period_year"]." - ".date("M", strtotime("2021-".$e_due_date["t_period_month"]."-01"))."-".$e_due_date["t_period_year"];
                                                            }
                                                            else
                                                            {
                                                                echo "N/A";
                                                            }
                                                        ?>
                                                        <?php
                                                            $asmtYear="N/A";
                                                            if(!empty($e_due_date['finYear']))
                                                            {
                                                                $asmtYearVal=$e_due_date['finYear'];
                                                                
                                                                $asmtYearArr = explode('-', $asmtYearVal);
                                                                
                                                                $fY=(int)$asmtYearArr[0]+1;
                                                                $lY=(int)$asmtYearArr[1]+1;
                                                                
                                                                $asmtYear=$fY."-".$lY;
                                                            }
                                                        ?>
                                                        (AY : <?= $asmtYear; ?>)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                    <thead>
                                                        <tr class="row-1">
                                                            <th class="column-1" width="1%">Sr</th>
                                                            <th class="column-2" width="5%">Group</th>
                                                            <th class="column-3" width="20%">Name of the</th>
                                                            <th class="column-3" width="10%">Tax</th>
                                                            <th class="column-5" colspan="2" width="20%">Alloted to</th>
                                                            <th class="column-6" width="5%">Completed</th>
                                                            <th class="column-7" width="5%">Cost</th>
                                                            <th class="column-8" colspan="3" width="29%">Bill</th>
                                                            <th class="column-11" width="5%">Action</th>
                                                        </tr>
                                                        <tr class="row-1">
                                                            <th class="column-1" width="1%">No</th>
                                                            <th class="column-2" width="5%">No</th>
                                                            <th class="column-3" width="20%">Client</th>
                                                            <th class="column-3" width="10%">Payer</th>
                                                            <th class="column-5" width="14%">Junior</th>
                                                            <th class="column-6" width="6%">Senior</th>
                                                            <th class="column-8" width="5%">On</th>
                                                            <th class="column-9" width="5%"></th>
                                                            <th class="column-10" width="5%">Date</th>
                                                            <th class="column-11" width="19%">No</th>
                                                            <th class="column-11" width="5%">Amount</th>
                                                            <th class="column-12" width="5%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                        <?php $sr=1; ?>
                                                
                                                        <?php if(isset($DDFDueDateForClientArr[$k_due_date])): ?>
                                                        
                                                            <?php $DDFDueDateForClientArray=$DDFDueDateForClientArr[$k_due_date]; ?>
                                                            
                                                            <?php if(!empty($DDFDueDateForClientArray)): ?>
                                                                <?php foreach($DDFDueDateForClientArray AS $e_inc_row): ?>
                                                                
                                                                    <?php $hasData=true; ?>
                                                                    
                                                                    <?php 
                                                                        $eFillingDate="-";
                                                                        if(check_valid_date($e_inc_row['eFillingDate']))
                                                                            $eFillingDate=date('d-m-Y', strtotime($e_inc_row['eFillingDate'])); 

                                                                        if(!empty($e_inc_row['workTotalCost']))
                                                                            $workTotalCost = $e_inc_row['workTotalCost']; 
                                                                        else
                                                                            $workTotalCost = 0;

                                                                        if(!empty($e_inc_row['totalBillAmt']))
                                                                            $totalBillAmt = $e_inc_row['totalBillAmt']; 
                                                                        else
                                                                            $totalBillAmt = 0;
                                                                    ?>
                                                                
                                                                    <tr class="row-1 tbl_row_clr" >
                                                                        <td class="column-1" width="1%" nowrap>
                                                                            <?= $sr; ?>
                                                                        </td>
                                                                        <td class="column-2" width="5%" nowrap>
                                                                            <?= $e_inc_row['client_group_number']; ?>
                                                                        </td>
                                                                        <td class="column-3" width="20%" nowrap>
                                                                            <?php
                                                                                $cliOrgNameVar = (!empty($e_inc_row['clientBussOrganisation'])) ? $e_inc_row['clientBussOrganisation'] : "";
                                                                            ?>
                                                                            <?= display_client_name($e_inc_row['orgType'], $e_inc_row['clientName'], $cliOrgNameVar); ?>
                                                                        </td>
                                                                        <td class="column-4 text-center" width="10%" nowrap>
                                                                            <?= $e_inc_row['client_org_short_name']; ?>
                                                                        </td>
                                                                        <td class="column-6 text-center" width="14%" nowrap>
                                                                            <?php if($e_inc_row['juniors']!=""): ?>
                                                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $e_inc_row['juniors']; ?>">
                                                                                    <?php 
                                                                                        if(strlen($e_inc_row['juniors'])>10)
                                                                                            echo substr_replace($e_inc_row['juniors'], "...", 10); 
                                                                                        else
                                                                                            echo $e_inc_row['juniors'];
                                                                                    ?>
                                                                                </a>
                                                                            <?php else: ?>
                                                                                -
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td class="column-7 text-center" width="6%">
                                                                            <?= $e_inc_row['seniorName']; ?>
                                                                        </td>
                                                                        <td class="column-9 text-center" width="5%">
                                                                            <?= $eFillingDate; ?>
                                                                        </td>
                                                                        <td class="column-10 text-center" width="5%">
                                                                            <?= amount_format($workTotalCost); ?>
                                                                        </td>
                                                                        <td class="column-11 text-center" width="5%">
                                                                            <?= checkEmpty($e_inc_row['billDate']); ?>
                                                                        </td>
                                                                        <td class="column-12 text-center" width="19%">
                                                                            <?= checkEmpty($e_inc_row['billNo']); ?>
                                                                        </td>
                                                                        <td class="column-13 text-center" width="5%">
                                                                            <?= amount_format($totalBillAmt); ?>
                                                                        </td>
                                                                        <td class="column-13 text-center" width="5%">
                                                                            <a href="<?= base_url('create-bill'); ?>">
                                                                                <button type="button" class="waves-effect waves-light btn btn-sm btn-submit">Create</button>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $sr++; ?>
                                                                        
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <tr class="row-1 tbl_row_clr">
                                                                    <td colspan="13" class="column-1">
                                                                        No records found
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <tr class="row-1 tbl_row_clr">
                                                                <td colspan="13" class="column-1">
                                                                    No records found
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                            <?php if($hasData==false): ?>
                                <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label>Due Date For : N/A</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="state second_header_div">
                                                <div class="row">
                                                    <div class="col-md-4 text-center second_header">
                                                        Due Date : N/A
                                                    </div>
                                                    <div class="col-md-4 text-center second_header">
                                                        Periodicity : N/A
                                                    </div>
                                                    <div class="col-md-4 text-center second_header">
                                                        Period: N/A (AY : N/A)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                            <thead>
                                                <tr class="row-1">
                                                    <th class="column-1">Sr</th>
                                                    <th class="column-2">Group</th>
                                                    <th class="column-3">Name of the</th>
                                                    <th class="column-3">Tax</th>
                                                    <th class="column-4">Doc</th>
                                                    <th class="column-5" colspan="2">Alloted to</th>
                                                    <th class="column-6" colspan="2">Completed</th>
                                                    <th class="column-7">E-Verify</th>
                                                    <th class="column-8">Set</th>
                                                    <th class="column-9">Billing</th>
                                                    <th class="column-11">Receipt</th>
                                                </tr>
                                                <tr class="row-1">
                                                    <th class="column-1">No</th>
                                                    <th class="column-2">No</th>
                                                    <th class="column-3">Client</th>
                                                    <th class="column-3">Payer</th>
                                                    <th class="column-4">Recd</th>
                                                    <th class="column-5">Junior</th>
                                                    <th class="column-6">Senior</th>
                                                    <th class="column-7">%</th>
                                                    <th class="column-8">On</th>
                                                    <th class="column-9">Date</th>
                                                    <th class="column-10">By</th>
                                                    <th class="column-11">Details</th>
                                                    <th class="column-12">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody class="row-hover">
                                                <tr class="row-1 tbl_row_clr">
                                                    <td colspan="13" class="column-1">
                                                        No records found
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    <!-- /.col -->
	</div>
</section>
<!-- /.content -->

<script>
    
    $(document).ready(function(){
        
        $('#due_act_sel').on('change', function(){
            
            var base_url="<?php echo base_url(); ?>";
            
            var due_act_sel = $(this).val();
            
            window.location.href=base_url+"/billing?actId="+due_act_sel;
        });
        
    });
    
</script>

<?= $this->endSection(); ?>