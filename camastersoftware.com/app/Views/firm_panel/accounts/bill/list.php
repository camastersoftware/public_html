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

    .marqueeFontSize {
        font-size: 18px !important;
    }
    
</style>

<link rel="stylesheet" href="<?= esc(base_url('assets/css/marquee.css')); ?>">

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?= $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('create-bill'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Create Bill</button>
                        </a>
                        &nbsp;&nbsp;
                        <a href="<?php echo base_url('modify-bill-tax-notes'); ?>" data-toggle="tooltip" data-original-title="Modify Tax Rates & Notes">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-warning add_client_top">Modify</button>
                        </a>
                        &nbsp;&nbsp;
                        <a href="<?php echo base_url('accountFinance'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="marqueeDiv mb-15">
                        <p class="marqueeFontSize">
                            To create other bills, which are not covered in Type A.
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="data_tbl_fixed_header table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th width="5%">Bill&nbsp;No</th>
                                    <th width="5%">Date</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php if(!empty($billArr)): ?>
                                    <?php foreach($billArr AS $k_row => $e_row): ?>
                                        <tr>
                                            <td class="text-center" width="5%"><?php echo $i; ?></td>
                                            <td class="text-center" width="5%" nowrap>
                                                <?php 
                                                    if(!empty($e_row['billNo']))
                                                        echo $e_row['billNo'];
                                                    else 
                                                        echo " "; 
                                                ?>
                                            </td>
                                            <td class="text-center" width="5%" nowrap>
                                                <?php   
                                                    if(!empty($e_row['billDate']) && $e_row['billDate']!="0000-00-00")
                                                        echo date("d-m-Y", strtotime($e_row['billDate']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td width="5%" class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="<?= base_url('edit-bill/'.$e_row['billId']); ?>" >Edit</a>
                                                        <a class="dropdown-item" href="<?= base_url('view-bill/'.$e_row['billId']); ?>" target="_blank">View</a>
                                                        <a class="dropdown-item deleteBill" href="javascript:void(0);" data-id="<?= $e_row['billId']; ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('.deleteBill').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var billId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this bill ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/delete-bill';
                    $.post(postingUrl, 
                    {
                        billId: billId
                    },
                    function(data, status){
                        window.location.href=base_url+"/bills";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
    });
</script>
<?= $this->endSection(); ?>