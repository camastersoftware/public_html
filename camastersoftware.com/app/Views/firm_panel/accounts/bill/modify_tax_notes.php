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
        padding: 0px 14px !important;
    }
    
    .btnPrimClr {
        margin-top: 5px !important;
        height: 30px !important;
        margin-bottom: 5px !important;
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
    
    .dataTables_wrapper .form-control{
        margin: 0px !important;
    }
    
    .discontinueClass td {
      color: #9d9c97 !important;
    }
    
</style>

<?php
    
    $billServiceAccCode="";
    $cgst="";
    $sgst="";
    $igst="";
    $billNote="";
    
    if(isset($settingsArr['billServiceAccCode']))
    {
        $billServiceAccCode=$settingsArr['billServiceAccCode'];
    }
    
    if(isset($settingsArr['cgst']))
    {
        $cgst=$settingsArr['cgst'];
    }
    
    if(isset($settingsArr['sgst']))
    {
        $sgst=$settingsArr['sgst'];
    }
    
    if(isset($settingsArr['igst']))
    {
        $igst=$settingsArr['igst'];
    }
    
    if(isset($settingsArr['billNote']))
    {
        $billNote=$settingsArr['billNote'];
    }
?>

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?= $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('bills'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <form action="<?= base_url('update-bill-tax-notes'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Service Accounting Code<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="billServiceAccCode" id="billServiceAccCode" placeholder="Enter Service Accounting Code" value="<?= $billServiceAccCode; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>CGST (%)<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="cgst" value="<?= $cgst; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>SGST (%)<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="sgst" value="<?= $cgst; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>IGST (%)<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="igst" value="<?= $igst; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea class="form-control" name="billNote" placeholder="Enter Notes" rows="8"><?= $billNote; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0 text-center">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name='configId' value="<?= $settingsArr['configId']; ?>" />
                                    <button type="submit" name="submit" class="waves-effect waves-light btn btn-sm btn-submit">Submit</button>
                                    <a href="<?php echo base_url('bills'); ?>">
                                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>