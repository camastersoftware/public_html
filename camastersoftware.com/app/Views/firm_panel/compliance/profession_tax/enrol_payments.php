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
    
    .theme-primary .btnPrimClr{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
    
</style>
<?php $s_time = strtotime("2019-12-01"); ?>
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
                            <a href="<?= base_url('pt_enrol_menus'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="tab-content tabcontent-border p-5" id="myTabContent">
                        <!-- Tab panes -->
                        <div class="tab-pane fade table-responsive show active" role="tabpanel">
           
                            <?php $due_date_for = (!empty($workDataArr[0]['act_option_name1'])) ? $workDataArr[0]['act_option_name1'] : ""; ?>
                            
                            <?php $due_date = (!empty($workDataArr[0]['extended_date'])) ? $workDataArr[0]['extended_date'] : ""; ?>
                            
                            <?php $periodicityVal = (!empty($workDataArr[0]['periodicity'])) ? $workDataArr[0]['periodicity'] : ""; ?>
                            
                            <?php $finYearVal = (!empty($workDataArr[0]['finYear'])) ? $workDataArr[0]['finYear'] : ""; ?>
                            
                            <?php $dueDate=(check_valid_date($due_date)) ? date('d-m-Y', strtotime($due_date)) : "-"; ?>
                            
                            <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="state due-month">
                                            <label>Due Date For : <?= (!empty($due_date_for)) ? $due_date_for : "N/A"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="state second_header_div">
                                            <div class="row">
                                                <div class="col-md-4 text-center second_header">
                                                    Due Date : <?= $dueDate; ?>
                                                </div>
                                                <div class="col-md-4 text-center second_header">
                                                    Periodicity : Yearly
                                                </div>
                                                <div class="col-md-4 text-center second_header">
                                                    Period : 
                                                    <?php
                                                        if($periodicityVal=="1")
                                                        {
                                                            $daily_date_val = (!empty($workDataArr[0]['daily_date'])) ? $workDataArr[0]['daily_date'] : "";
                                                            echo (!empty($daily_date_val)) ? date("d-M-Y", strtotime($daily_date_val)) : "N/A";
                                                        }
                                                        elseif($periodicityVal=="2")
                                                        {
                                                            $period_month_val = (!empty($workDataArr[0]['period_month'])) ? $workDataArr[0]['period_month'] : "";
                                                            $period_year_val = (!empty($workDataArr[0]['period_year'])) ? $workDataArr[0]['period_year'] : "";
                                                            
                                                            if(!empty($period_month_val) && !empty($period_year_val))
                                                            {
                                                                echo date("M", strtotime("2021-".$period_month_val."-01"))."-".$period_year_val;
                                                            }
                                                            else
                                                            {
                                                                echo "N/A";
                                                            }
                                                        }
                                                        elseif($periodicityVal>="3")
                                                        {
                                                            $f_period_month_val = (!empty($workDataArr[0]['f_period_month'])) ? $workDataArr[0]['f_period_month'] : "";
                                                            $f_period_year_val = (!empty($workDataArr[0]['f_period_year'])) ? $workDataArr[0]['f_period_year'] : "";
                                                            $t_period_month_val = (!empty($workDataArr[0]['t_period_month'])) ? $workDataArr[0]['t_period_month'] : "";
                                                            $t_period_year_val = (!empty($workDataArr[0]['t_period_year'])) ? $workDataArr[0]['t_period_year'] : "";
                                                            
                                                            if(!empty($f_period_month_val) && !empty($f_period_year_val) && !empty($t_period_month_val) && !empty($t_period_year_val))
                                                            {
                                                                echo date("M", strtotime("2021-".$f_period_month_val."-01"))."-".$f_period_year_val." - ".date("M", strtotime("2021-".$t_period_month_val."-01"))."-".$t_period_year_val;
                                                            }
                                                            else
                                                            {
                                                                echo "N/A";
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo "N/A";
                                                        }
                                                    ?>
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
                                                        <th class="column-3" width="15%">Name of the</th>
                                                        <th class="column-3" width="10%">Status</th>
                                                        <th class="column-4" width="7%">Enrolment</th>
                                                        <th class="column-5" colspan="2" width="14%">Alloted to</th>
                                                        <th class="column-6">Period</th>
                                                        <th class="column-7">Amount</th>
                                                        <th class="column-8">Paid</th>
                                                        <th class="column-9">Mode</th>
                                                        <th class="column-11">Action</th>
                                                    </tr>
                                                    <tr class="row-1">
                                                        <th class="column-1" width="1%">No</th>
                                                        <th class="column-2" width="5%">No</th>
                                                        <th class="column-3" width="15%">Client</th>
                                                        <th class="column-3" width="10%"></th>
                                                        <th class="column-4" width="7%">Number</th>
                                                        <th class="column-5" width="7%">Junior</th>
                                                        <th class="column-6" width="7%">Senior</th>
                                                        <th class="column-7"></th>
                                                        <th class="column-9">Paid</th>
                                                        <th class="column-10">On</th>
                                                        <th class="column-11"></th>
                                                        <th class="column-12"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row-hover">
                                                    <?php $sr=1; ?>
                                            
                                                    <?php if(!empty($workDataArr)): ?>
                                                        <?php foreach($workDataArr AS $e_row): ?>
                                                        
                                                            <tr class="row-1 tbl_row_clr" >
                                                                <td class="column-1" width="1%" nowrap>
                                                                    <?= $sr; ?>
                                                                </td>
                                                                <td class="column-2" width="5%" nowrap>
                                                                    <?= $e_row['client_group_number']; ?>
                                                                </td>
                                                                <td class="column-3" width="15%" nowrap>
                                                                    <?php 
                                                                        if(in_array($e_row['orgType'], INDIVIDUAL_ARRAY))
                                                                            $clientNameVar=$e_row['clientName'];
                                                                        else
                                                                            $clientNameVar=$e_row['clientBussOrganisation']; 
                                                                    ?>
                                                                    <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $clientNameVar; ?>">
                                                                        <?php 
                                                                            if(strlen($clientNameVar)>24)
                                                                            {
                                                                                echo substr($clientNameVar, 0, 24)."..";
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $clientNameVar;
                                                                            }
                                                                        ?>
                                                                    </a>
                                                                </td>
                                                                <td class="column-4 text-center" width="10%" nowrap>
                                                                    <?= $e_row['client_org_short_name']; ?>
                                                                </td>
                                                                <td class="column-5 text-center" width="7%">
                                                                    <?= (!empty($e_row['client_document_number'])) ? $e_row['client_document_number'] : "-"; ?>
                                                                </td>
                                                                <td class="column-6 text-center" width="7%" nowrap>
                                                                    <?php if($e_row['juniors']!=""): ?>
                                                                        <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $e_row['juniors']; ?>">
                                                                            <?php 
                                                                                if(strlen($e_row['juniors'])>10)
                                                                                    echo substr_replace($e_row['juniors'], "...", 10); 
                                                                                else
                                                                                    echo $e_row['juniors'];
                                                                            ?>
                                                                        </a>
                                                                    <?php else: ?>
                                                                        -
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td class="column-7 text-center" width="7%">
                                                                    <?= (!empty($e_row['seniorName'])) ? $e_row['seniorName'] : "-"; ?>
                                                                </td>
                                                                <td class="column-8 text-center" nowrap>
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
                                                                <td class="column-10 text-right">
                                                                    <?= (!empty($e_row['pt_enrol_amt_paid'])) ? amount_format($e_row['pt_enrol_amt_paid']) : "-"; ?>
                                                                </td>
                                                                <td class="column-11 text-center">
                                                                    <?= (check_valid_date($e_row['pt_enrol_paid_on'])) ? date('d-m-Y', strtotime($e_row['pt_enrol_paid_on'])) : "-"; ?>
                                                                </td>
                                                                <td class="column-12 text-center">
                                                                    <?= (!empty($e_row['pt_enrol_pmt_mode'])) ? $e_row['pt_enrol_pmt_mode'] : "-"; ?>
                                                                </td>
                                                                <td class="column-13 text-center">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="<?= base_url('manage-pt-enrol-payments/'.$e_row['workId']); ?>">View/Edit</a>
                                                                        </div>
                                                                    </div>
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
                                            
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
</section>
<!-- /.content -->
<?= $this->endSection(); ?>