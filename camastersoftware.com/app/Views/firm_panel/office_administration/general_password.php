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
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#addGenPassModal">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Add General Password</button>
                        </a>
                        &nbsp;&nbsp;
                        <a href="<?php echo base_url('office-administration'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="1%">SN</th>
                                    <th width="5%">Related&nbsp;To</th>
                                    <th width="5%">Pertaining&nbsp;To</th>
                                    <th width="5%">Login</th>
                                    <th width="5%">Password</th>
                                    <th width="1%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php if(!empty($generalPasswordList)): ?>
                                    <?php foreach($generalPasswordList AS $k_row => $e_row): ?>
                                        <tr>
                                            <td class="text-center" width="1%"><?php echo $i; ?></td>
                                            <td class="text-center" width="5%" nowrap>
                                                <?php 
                                                    if(!empty($e_row['gen_pass_related_to']))
                                                        echo $e_row['gen_pass_related_to'];
                                                    else 
                                                        echo " "; 
                                                ?>
                                            </td>
                                            <td class="text-center" width="5%" nowrap>
                                                <?php 
                                                    if(!empty($e_row['gen_pass_pertaining_to']))
                                                        echo $e_row['gen_pass_pertaining_to'];
                                                    else 
                                                        echo " "; 
                                                ?>
                                            </td>
                                            <td class="text-center" width="5%" nowrap>
                                                <?php 
                                                    if(!empty($e_row['gen_pass_login']))
                                                        echo $e_row['gen_pass_login'];
                                                    else 
                                                        echo " "; 
                                                ?>
                                            </td>
                                            <td class="text-center" width="5%" nowrap>
                                                <?php 
                                                    if(!empty($e_row['gen_pass_password']))
                                                        echo $e_row['gen_pass_password'];
                                                    else 
                                                        echo " "; 
                                                ?>
                                            </td>
                                            <td width="1%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editGenPassModal<?php echo $k_row; ?>">View/Edit</a>
                                                        <a class="dropdown-item deleteGenPass" href="javascript:void(0);" data-id="<?= $e_row['gen_pass_id']; ?>">Delete</a>
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

<?php if(!empty($generalPasswordList)): ?>
    <?php foreach($generalPasswordList AS $k_row => $e_row): ?>
    
    <!-- Modal -->
    <div id="editGenPassModal<?php echo $k_row; ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo base_url('edit-general-password'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit/View General Password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Related To</label>
                                    <input type="text" class="form-control" name="gen_pass_related_to" id="gen_pass_related_to" placeholder="Enter Related To" value="<?= $e_row['gen_pass_related_to']; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Pertaining To</label>
                                    <input type="text" class="form-control" name="gen_pass_pertaining_to" id="gen_pass_pertaining_to" value="<?= $e_row['gen_pass_pertaining_to']; ?>" placeholder="Enter Pertaining To" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Login</label>
                                    <input type="text" class="form-control" name="gen_pass_login" id="gen_pass_login" value="<?= $e_row['gen_pass_login']; ?>" placeholder="Enter Login" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="gen_pass_password" id="gen_pass_password" value="<?= $e_row['gen_pass_password']; ?>" placeholder="Enter Password" >
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <textarea type="text" class="form-control" name="gen_pass_remark" id="gen_pass_remark" placeholder="Enter Remark"><?= $e_row['gen_pass_remark']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="gen_pass_id" id="gen_pass_id" value="<?= $e_row['gen_pass_id']; ?>" />
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
<div id="addGenPassModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo base_url('add-general-password'); ?>" method="POST" enctype="multipart/form-data" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add General Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Related To</label>
                                <input type="text" class="form-control" name="gen_pass_related_to" id="gen_pass_related_to" placeholder="Enter Related To" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Pertaining To</label>
                                <input type="text" class="form-control" name="gen_pass_pertaining_to" id="gen_pass_pertaining_to" placeholder="Enter Pertaining To" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Login</label>
                                <input type="text" class="form-control" name="gen_pass_login" id="gen_pass_login" placeholder="Enter Login" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="gen_pass_password" id="gen_pass_password" placeholder="Enter Password" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remark</label>
                                <textarea type="text" class="form-control" name="gen_pass_remark" id="gen_pass_remark" placeholder="Enter Remark"></textarea>
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
        $('.deleteGenPass').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var gen_pass_id = $(this).data('id');

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

                    var postingUrl = base_url+'/delete-general-password';
                    $.post(postingUrl, 
                    {
                        gen_pass_id: gen_pass_id
                    },
                    function(data, status){
                        window.location.href=base_url+"/general-password-list";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
    });
</script>
<?= $this->endSection(); ?>