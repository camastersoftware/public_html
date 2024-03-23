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

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?= $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#addNonRegularDDF">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Add Due Date For</button>
                        </a>
                        &nbsp;&nbsp;
                        <a href="<?php echo base_url('office-administration'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-8 offset-2">
                            <div class="table-responsive">
                                <table class="data_tbl_fixed_header table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="1%">SN</th>
                                            <th width="5%">Due Date For</th>
                                            <th width="2%">Act</th>
                                            <th width="1%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        <?php if(!empty($nonRegDDFArr)): ?>
                                            <?php foreach($nonRegDDFArr AS $k_row => $e_row): ?>
                                                <tr>
                                                    <td class="text-center" width="1%"><?php echo $i; ?></td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['non_regular_due_date_for_name']))
                                                                echo $e_row['non_regular_due_date_for_name'];
                                                            else 
                                                                echo " "; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="2%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['act_name']))
                                                                echo $e_row['act_name'];
                                                            else 
                                                                echo " "; 
                                                        ?>
                                                    </td>
                                                    <td width="1%" class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editNonRegularDDF<?php echo $k_row; ?>">View/Edit</a>
                                                                <a class="dropdown-item deleteNonRegularDDF" href="javascript:void(0);" data-id="<?= $e_row['non_regular_due_date_for_id']; ?>">Delete</a>
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
        </div>
    </div>
</section>

<?php if(!empty($nonRegDDFArr)): ?>
    <?php foreach($nonRegDDFArr AS $k_row => $e_row): ?>
    
    <!-- Modal -->
    <div id="editNonRegularDDF<?php echo $k_row; ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('edit-non-regular-due-date-for'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit/View Non-Regular Due Date For</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Due Date For<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="non_regular_due_date_for_name" id="non_regular_due_date_for_name" value="<?= $e_row['non_regular_due_date_for_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="fkActId">Act:<small class="text-danger">*</small></label>
                                    <select class="custom-select form-control" id="fkActId" name="fkActId" required>
                                        <option value="">Select Act</option>
                                        <?php if(!empty($actArr)): ?>
                                            <?php foreach($actArr AS $e_act): ?>
                                                <option value="<?php echo $e_act['act_id']; ?>" <?php if($e_row['fkActId']==$e_act['act_id']): ?>selected<?php endif; ?>><?php echo $e_act['act_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="non_regular_due_date_for_id" id="non_regular_due_date_for_id" value="<?= $e_row['non_regular_due_date_for_id']; ?>" />
                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <?php endforeach; ?>
<?php endif; ?>

<!-- Modal -->
<div id="addNonRegularDDF" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url('add-non-regular-due-date-for'); ?>" method="POST" enctype="multipart/form-data" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Non-Regular Due Date For</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Due Date For<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="non_regular_due_date_for_name" id="non_regular_due_date_for_name" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="fkActId">Act:<small class="text-danger">*</small></label>
                                <select class="custom-select form-control" id="fkActId" name="fkActId" required>
                                    <option value="">Select Act</option>
                                    <?php if(!empty($actArr)): ?>
                                        <?php foreach($actArr AS $e_act): ?>
                                            <option value="<?php echo $e_act['act_id']; ?>"><?php echo $e_act['act_name']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(document).ready(function(){
        $('.deleteNonRegularDDF').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var non_regular_due_date_for_id = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/delete-non-regular-due-date-for';
                    $.post(postingUrl, 
                    {
                        non_regular_due_date_for_id: non_regular_due_date_for_id
                    },
                    function(data, status){
                        window.location.href=base_url+"/non-regular-due-date-for-list";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
    });
</script>
<?= $this->endSection(); ?>