<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
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

    .tablepress tbody tr:first-child td {
        background: #ffffff;
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
    
    .table-responsive table thead tr{
        background: #005495 !important;
        color: #fff !important;
    }
    
    .table-responsive table tbody tr{
        background: #96c7f242 !important;
    }
    
    .table-responsive tr th{
        border: 1px solid #fff !important;
    }
    
    .table-responsive tr td{
        border: 1px solid #015aacab !important;
    }
    
    table.dataTable {
        border-collapse: collapse !important;
        font-size: 16px !important;
    }
    
    .table > tbody > tr > td, .table > tbody > tr > th {
        padding: 8px 14px !important;
    }
    
    .theme-primary .btnPrimClr {
        margin-top: 0px !important;
        height: 30px !important;
        margin-bottom: 0px !important;
    }
    
    .box_body_bg {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        /*border-radius: 10px;*/
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
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
    
    .tbl_hd_row th{
        font-size: 14px !important;
        white-space: nowrap !important;
    }

    .scrNoteClass{
        font-size: 16px !important;
        color: #005495 !important;
    }
    
</style>

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?= $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?= base_url('add-scrutiny-case'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit">Add Scrutiny</button>
                        </a>
                        &nbsp;&nbsp;
                        <a href="<?php echo base_url('it-menus'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <label class="font-weight-bold scrNoteClass">For Scrutiny Page :</label>
                            <span class="font-weight-bold scrNoteClass">From AY-17-18 select from Work Page & for earlier years use direct entry form.</span>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr class="text-center tbl_hd_row">
                                            <th>SN</th>
                                            <th>Client Name</th>
                                            <th>Asst Year</th>
                                            <th>Notice u/s</th>
                                            <th>Hearing Date</th>
                                            <th>Attended On</th>
                                            <th>Attended By</th>
                                            <th>Next Date</th>
                                            <th>Order Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        <?php if(!empty($workDataArr)): ?>
                                            <?php foreach($workDataArr AS $e_row): ?>
                                                <tr class="text-center">
                                                    <td><?php echo $i; ?></td>
                                                    <td nowrap class="text-left">
                                                        <?php 
                                                            if(in_array($e_row['orgType'], INDIVIDUAL_ARRAY))
                                                                $clientNameVar=$e_row['clientName'];
                                                            else
                                                                $clientNameVar=$e_row['clientBussOrganisation']; 
                                                        ?>
                                                        <a href="<?php echo base_url('scrutiny-case/'.$e_row['scrutinyId']); ?>" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
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
                                                    <td>
                                                        <?php echo (!empty($e_row['finYear'])) ? $e_row['finYear'] : "<div class='text-center'>-</div>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo (!empty($e_row['noticeUnderSectionTitle'])) ? $e_row['noticeUnderSectionTitle'] : "<div class='text-center'>-</div>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo (!empty($e_row['noticeDueDate'])) ? date('d-m-Y', strtotime($e_row['noticeDueDate'])) : "<div class='text-center'>-</div>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo (!empty($e_row['attendedOn'])) ? date('d-m-Y', strtotime($e_row['attendedOn'])) : "<div class='text-center'>-</div>"; ?>
                                                    </td>
                                                    <td class="text-left">
                                                        <?php echo (!empty($e_row['attendedBy'])) ? $e_row['attendedBy'] : "<div class='text-center'>-</div>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo (!empty($e_row['nextDate'])) ? date('d-m-Y', strtotime($e_row['nextDate'])) : "<div class='text-center'>-</div>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo (!empty($e_row['recptFinalOrderDate'])) ? date('d-m-Y', strtotime($e_row['recptFinalOrderDate'])) : "<div class='text-center'>-</div>"; ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                <a class="dropdown-item" href="<?php echo base_url('scrutiny-case/'.$e_row['scrutinyId']); ?>">Scrutiny Details</a>
                                                                <a class="dropdown-item" href="<?php echo base_url('order-analysis/'.$e_row['scrutinyId']); ?>">Order Analysis</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="10">
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
    </div>
</section>

<?= $this->endSection(); ?>