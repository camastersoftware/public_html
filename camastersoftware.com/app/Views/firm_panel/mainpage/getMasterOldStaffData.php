<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

    <style>
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
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box mt-35">
                    <div class="box-header with-border flexbox">
                        <h4 class="box-title font-weight-bold">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            <a href="<?php echo base_url('getMasterStaffData'); ?>">
                                <button type="button" class="btn btn-sm btn-dark" >Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    
                        <div class="table-responsive">
                            <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">SN</th>
                                        <th>Staff&nbsp;Name</th>
                                        <th>Designation</th>
                                        <th>DOB</th>
                                        <th>DOJ</th>
                                        <th>Mobile&nbsp;No</th>
                                        <th>Email&nbsp;ID</th>
                                        <th>PAN</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($userDataArr)): ?>
                                        <?php $i=1; ?>
                                        <?php foreach($userDataArr AS $e_row): ?>
                                            <tr id="user_id_tr_<?php echo $e_row['userId']; ?>">
                                                <td class="text-center" width="5%"><?php echo $i; ?></td>
                                                <td nowrap>
                                                    <!--<a href="<?php //echo base_url('admin/user/edit_user/'.$e_row['userId'].'?master=1'); ?>">-->
                                                        <?php echo $e_row['userFullName']; ?>
                                                    <!--</a>-->
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
                                                        $userDob="N/A";
                                                        if(!empty($e_row['userDob']) && $e_row['userDob']!="0000-00-00" && $e_row['userDob']!="1970-01-01")
                                                            $userDob=date('d-m-Y', strtotime($e_row['userDob']));
                                                    ?>
                                                    <?php echo $userDob; ?>
                                                </td>
                                                <td class="text-center" nowrap>
                                                    <?php
                                                        $userDOJ="N/A";
                                                        if(!empty($e_row['userDOJ']) && $e_row['userDOJ']!="0000-00-00" && $e_row['userDOJ']!="1970-01-01")
                                                            $userDOJ=date('d-m-Y', strtotime($e_row['userDOJ']));
                                                    ?>
                                                    <?php echo $userDOJ; ?>
                                                </td>
                                                <td class="text-center" nowrap><?php echo $e_row['userMobile1']; ?></td>
                                                <td nowrap width="5%">
                                                    <?php 
                                                        if(!empty($e_row['userEmail1']))
                                                            echo $e_row['userEmail1']; 
                                                        else
                                                            echo "N/A"; 
                                                    ?>
                                                </td>
                                                <td nowrap width="5%" class="text-center">
                                                    <?php 
                                                        if(!empty($e_row['userPan']))
                                                            echo $e_row['userPan']; 
                                                        else
                                                            echo "N/A"; 
                                                    ?>
                                                </td>
                                                <td class="text-center" width="5%">
                                                    <div class="btn-group">
                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#userLeftReasonModal<?= $e_row['userId']; ?>" data-toggle="tooltip" data-original-title="Show Reason" data-rowId="<?php echo $e_row['userId']; ?>"><i class="fa fa-info"></i>&nbsp;Show Reason</a>
                                                            <a class="dropdown-item restoreUser" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Restore User" data-rowId="<?php echo $e_row['userId']; ?>"><i class="fa fa-rotate-left"></i>&nbsp;Restore</a>
                                                            <a class="dropdown-item delUser" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Delete" data-rowId="<?php echo $e_row['userId']; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9"><center>No records</center></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    
    <?php if(!empty($userDataArr)): ?>
        <?php foreach($userDataArr AS $e_row): ?>
        <div id="userLeftReasonModal<?= $e_row['userId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Reason for Leaving</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <span><?= (!empty($e_row['userLeftReason'])) ? $e_row['userLeftReason'] : "N/A"; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <?php endforeach; ?>
    <?php endif; ?>
    
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
            
            $('.restoreUser').on('click', function(e){
    
                e.preventDefault();
    
                var userId = $(this).data('rowid');
    
                swal({
                    title: "Are you sure?",
                    text: "Do you really want to restore this user ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Restore it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm){
                    if (isConfirm) {
    
                        $.ajax({
                            url: base_url+'/restore_user',
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
                                    swal("Restored", resMsg, "success");
    
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
            
        });
        
    </script>

<?= $this->endSection(); ?>