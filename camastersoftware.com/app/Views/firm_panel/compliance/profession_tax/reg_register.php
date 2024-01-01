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

    .theme-primary .btnPrimClr{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
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
                            <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url('pt_reg_menus'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                            <thead>
                                                <tr class="row-1">
                                                    <th class="column-1">SR</th>
                                                    <th class="column-2" nowrap>CLIENT NAME</th>
                                                    <th class="column-2">REGISTRATION</th>
                                                    <th class="column-2">DUE DATE</th>
                                                    <th class="column-2">FORM</th>
                                                    <th class="column-4">PERIOD</th>
                                                    <th class="column-5" >AMOUNT</th>
                                                    <th class="column-6">PAID/FILED</th>
                                                    <th class="column-6">MODE</th>
                                                    <th class="column-6">ACTION</th>
                                                </tr>
                                                <tr class="row-1">
                                                    <th class="column-1">NO</th>
                                                    <th class="column-2" nowrap></th>
                                                    <th class="column-2">NO</th>
                                                    <th class="column-2"></th>
                                                    <th class="column-2"></th>
                                                    <th class="column-2"></th>
                                                    <th class="column-5">PAID</th>
                                                    <th class="column-6">ON</th>
                                                    <th class="column-6"></th>
                                                    <th class="column-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="row-hover">
                                                <?php $sr=1; ?>
                                        
                                                <?php if(!empty($clientDataArr)): ?>
                                                    <?php foreach($clientDataArr AS $e_row): ?>
                                                    
                                                        <tr class="row-1">
                                                            <td class="column-1">
                                                                <?php echo $sr; ?>
                                                            </td>
                                                            <td class="column-2" nowrap>
                                                                <?php 
                                                                    if(in_array($e_row['orgType'], INDIVIDUAL_ARRAY))
                                                                        $clientNameVar=$e_row['clientName'];
                                                                    else
                                                                        $clientNameVar=$e_row['clientBussOrganisation']; 
                                                                ?>
                                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
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
                                                            <td class="column-2 text-center">
                                                                <?= (!empty($e_row['client_document_number'])) ? $e_row['client_document_number'] : "-"; ?>
                                                            </td>
                                                            <td class="column-2 text-center">
                                                                <?= (check_valid_date($e_row['extended_date'])) ? date('d-m-Y', strtotime($e_row['extended_date'])) : "-"; ?>
                                                            </td>
                                                            <td class="column-9 text-center">
                                                                <?= (!empty($e_row['applicable_form_name'])) ? $e_row['applicable_form_name'] : "-"; ?>
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
                                                            <td class="column-9 text-center">
                                                                <?= (!empty($e_row['pt_enrol_amt_paid'])) ? amount_format($e_row['pt_enrol_amt_paid']) : "-"; ?>
                                                            </td>
                                                            <td class="column-9 text-center">
                                                                <?php if($e_row['applicable_form']==72): ?>
                                                                    <?= (check_valid_date($e_row['eFillingDate'])) ? date('d-m-Y', strtotime($e_row['eFillingDate'])) : "-"; ?>
                                                                <?php elseif($e_row['applicable_form']==73): ?>
                                                                    <?= (check_valid_date($e_row['pt_enrol_paid_on'])) ? date('d-m-Y', strtotime($e_row['pt_enrol_paid_on'])) : "-"; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="column-9 text-center">
                                                                <?= (!empty($e_row['pt_enrol_pmt_mode'])) ? $e_row['pt_enrol_pmt_mode'] : "-"; ?>
                                                            </td>
                                                            <td class="column-9 text-center">
                                                                <div class="btn-group">
                                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editWorkModal<?php echo $e_row['workId']; ?>">View Remark</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $sr++; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="11">
                                                            <center>No records found</center>
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
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    <!-- /.col -->
	</div>
</section>
<!-- /.content -->

<?php if(!empty($clientDataArr)): ?>
    <?php foreach($clientDataArr AS $e_row): ?>
    
    <!-- Modal -->
    <div id="editWorkModal<?php echo $e_row['workId']; ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Remark</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <?= (!empty($e_row['workRemark'])) ? $e_row['workRemark'] : "-"; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection(); ?>