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
                        <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#addClientModal">-->
                        <!--    <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Add Client</button>-->
                        <!--</a>-->
                        <!--&nbsp;&nbsp;-->
                        <a href="<?php echo base_url('password-mgmt'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th width="5%">Group&nbsp;No</th>
                                    <th width="20%">Client&nbsp;Name</th>
                                    <th>GSTIN</th>
                                    <th width="5%">GST&nbsp;Login</th>
                                    <th width="5%">Password</th>
                                    <th width="5%">E-Way&nbsp;Login</th>
                                    <th width="5%">Password</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php $currGrp=""; ?>
                                <?php $prevGrp=""; ?>
                                <?php $clrCnt=1; ?>
                                <?php if(!empty($getClientList)): ?>
                                    <?php foreach($getClientList AS $k_row => $e_row): ?>
                                        <?php $client_group_num=$e_row['client_group_number']; ?>
                                        <?php $currGrp=$client_group_num; ?>
                                        
                                        <?php
                                            if($currGrp!=$prevGrp)
                                                $clrCnt++;
                                            
                                            $clrSeq=($clrCnt%2);
                                            
                                            if($clrSeq==0)
                                                $grpClr="#005495";
                                            else
                                                $grpClr="#f48b04";
                                        ?>
                                        
                                        <tr id="client_id_tr_<?php echo $e_row['clientId']; ?>">
                                            <td class="text-center" width="5%"><?php echo $i; ?></td>
                                            <td class="text-center" width="5%" >
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $e_row['client_group']; ?>" style="color: <?= $grpClr; ?> !important;">
                                                    <?php
                                                        if(!empty($client_group_num))
                                                            echo $client_group_num;
                                                        else 
                                                            echo " "; 
                                                    ?>
                                                </a>
                                            </td>
                                            <td width="20%" nowrap>
                                                <?php $clientNameVar=$e_row['clientBussOrganisation']; ?>
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
                                                    <?php
                                                        if(strlen($clientNameVar)>17)
                                                        {
                                                            echo substr($clientNameVar, 0, 17)."..";
                                                        }
                                                        else
                                                        {
                                                            echo $clientNameVar;
                                                        }
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                    if(!empty($e_row['gstNo']))
                                                        echo $e_row['gstNo'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['login_username']))
                                                        echo $e_row['login_username'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['password']))
                                                        echo $e_row['password'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['e_way_bill_login']))
                                                        echo $e_row['e_way_bill_login'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['e_way_bill_password']))
                                                        echo $e_row['e_way_bill_password'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td width="5%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editClientModal<?php echo $k_row; ?>">View/Edit</a>
                                                        <!--<a class="dropdown-item deleteClientCredetials" href="javascript:void(0);" data-id="<?//= $e_row['clients_credetials_administration_id']; ?>">Delete</a>-->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                        <?php $prevGrp=$client_group_num; ?>
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

<?php if(!empty($getClientList)): ?>
    <?php foreach($getClientList AS $k_row => $e_row): ?>
    
        <!-- Modal -->
        <div id="editClientModal<?php echo $k_row; ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo base_url('edit-client-gst-password'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit/View Client</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Client : </label>
                                        <span><?= $e_row['clientBussOrganisation']; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <span class="font-weight-bold">Status :&nbsp;</span>
                                    <span>
                                        <?php
                                            if(!empty($e_row['organisation_type_name']))
                                                echo $e_row['organisation_type_name'];
                                            else
                                                echo "N/A";
                                        ?>
                                    </span>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Username<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="login_username" id="login_username" placeholder="Enter Username" value="<?= $e_row['login_username']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Login Password<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="login_password" id="login_password" placeholder="Enter Login Password" value="<?= $e_row['password']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>E-Way Bill Login<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="e_way_bill_login" id="e_way_bill_login" placeholder="Enter E-Way Bill Login" value="<?= $e_row['e_way_bill_login']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>E-Way Bill Password<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="e_way_bill_password" id="e_way_bill_password" placeholder="Enter E-Way Bill Password" value="<?= $e_row['e_way_bill_password']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea class="form-control" name="notes" placeholder="Enter Notes"><?= $e_row['notes']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="client_id" value="<?= $e_row['clientId']; ?>" />
                            <input type="hidden" name="clients_credetials_administration_id" id="clients_credetials_administration_id" value="<?= $e_row['clients_credetials_administration_id']; ?>" />
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

<script>
    $(document).ready(function(){
        $('.deleteClientCredetials').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var clients_credetials_administration_id = $(this).data('id');

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

                    var postingUrl = base_url+'/delete-client-gst-password';
                    $.post(postingUrl, 
                    {
                        clients_credetials_administration_id: clients_credetials_administration_id
                    },
                    function(data, status){
                        window.location.href=base_url+"/gst-password";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
    });
</script>
<?= $this->endSection(); ?>