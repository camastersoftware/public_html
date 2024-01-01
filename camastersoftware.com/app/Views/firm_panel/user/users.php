<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
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

</style>

<!-- Main content -->
<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        User (Employee) List
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?= base_url('create-user'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit">
                                Create New User (Employee)
                            </button>
                        </a>
                        <!--<button type="button" class="waves-effect waves-light btn btn-dark back_page">Back</button>-->
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th>User Name</th>
                                    <th>Designation</th>
                                    <th>DOB</th>
                                    <th>DOJ</th>
                                    <th width="5%">Mobile No</th>
                                    <th>Email ID</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php if(!empty($getUserList)): ?>
                                    <?php foreach($getUserList AS $e_row): ?>
                                        <tr id="user_id_tr_<?php echo $e_row['userId']; ?>">
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td nowrap>
                                                <a href="<?php echo base_url('user/edit_user/'.$e_row['userId']); ?>">
                                                    <?php //echo $e_row['userTitle'].". ".$e_row['userFullName']; ?>
                                                    <?php echo $e_row['userFullName']; ?>
                                                </a>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['userDesgn']))
                                                        echo $e_row['userDesgn']; 
                                                    else
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['userDob']) && $e_row['userDob']!="0000-00-00")
                                                        echo date("d-m-Y", strtotime($e_row['userDob']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                    $userDOJ="N/A";
                                                    if(!empty($e_row['userDOJ']) && $e_row['userDOJ']!="0000-00-00" && $e_row['userDOJ']!="1970-01-01")
                                                        $userDOJ=date('d-m-Y', strtotime($e_row['userDOJ']));
                                                ?>
                                                <?php echo $userDOJ; ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['userMobile1']))
                                                        echo $e_row['userMobile1']; 
                                                    else
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td nowrap>
                                                <?php 
                                                    if(!empty($e_row['userEmail1']))
                                                        echo $e_row['userEmail1']; 
                                                    else
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="<?php echo base_url('user/edit_user/'.$e_row['userId']); ?>" ><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                                        <a class="dropdown-item" href="<?php echo base_url('user/view_user/'.$e_row['userId']); ?>" ><i class="fa fa-file"></i>&nbsp;View Documents</a>
                                                        <a class="dropdown-item markAsOld" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Mark As Left" data-rowId="<?php echo $e_row['userId']; ?>"><i class="fa fa-ban"></i>&nbsp;Mark As Left</a>
                                                        <a class="dropdown-item delUser" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Delete" data-rowId="<?php echo $e_row['userId']; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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

<div id="staffLeftReasonModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="staffLeftForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Enter Reason for Leaving</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Enter Reason<small class="text-danger">*</small></label>
                                <textarea class="form-control" name="userLeftReason" id="userLeftReason" placeholder="Enter Reason" rows="3" required></textarea> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" id="left_user_id" value="" />
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="button" class="btn btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<script type="text/javascript">
            
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";

        $('.delUser').on('click', function(e){

            e.preventDefault();

            var userId = $(this).data('rowid');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this user ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url: base_url+'/delete_user',
                        type: 'POST',
                        data: {
                            'userId':userId,
                            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
                        },
                        dataType: 'json',
                        success: function(response) {

                            var resStatus = response['status'];
                            var resMsg = response['message'];
                            var resUserData = response['userdata'];

                            if(resStatus==true)
                            {
                                swal("Deleted", resMsg, "success");

                                $('#user_id_tr_'+userId).remove();
                            }
                            else
                            {
                                swal("Error!", resMsg, "error");
                            }

                        },
                        error: function(request, error)
                        {
                            // alert("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled:)", "error");
                }
            });

        });
        
        $('.markAsOld').on('click', function(e){

            e.preventDefault();
            
            $("#left_user_id").val("");
            $("#userLeftReason").val("");

            var userId = $(this).data('rowid');

            swal({
                title: "Are you sure?",
                text: "Do you really want to mark this user as left ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Mark it as left!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    
                    $("#left_user_id").val(userId);
                    $('#staffLeftReasonModal').modal('show');
                    
                    swal.close();

                } else {
                    swal("Cancelled", "You cancelled:)", "error");
                }
            });

        });
        
        $('#staffLeftForm').on('submit', function(e){

            e.preventDefault();

            var userId = $("#left_user_id").val();
            var userLeftReason = $("#userLeftReason").val();
            
            $.ajax({
                url: base_url+'/mark_old_user',
                type: 'POST',
                data: {
                    'userId':userId,
                    'userLeftReason':userLeftReason,
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
                },
                dataType: 'json',
                success: function(response) {

                    var resStatus = response['status'];
                    var resMsg = response['message'];
                    var resUserData = response['userdata'];

                    if(resStatus==true)
                    {
                        swal("Marked has left", resMsg, "success");

                        $('#user_id_tr_'+userId).remove();
                    }
                    else
                    {
                        swal("Error!", resMsg, "error");
                    }
                    
                    $('#staffLeftReasonModal').modal('hide');
                },
                error: function(request, error)
                {
                    // alert("Request: "+JSON.stringify(request));
                }
            });

        });


        


    });

</script>

<?= $this->endSection(); ?>