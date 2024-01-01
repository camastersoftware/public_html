<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .table-responsive1 table thead tr{
        background: #005495 !important;
        color: #fff !important;
    }
    
    .table-responsive1 table tbody tr{
        background: #96c7f242 !important;
    }
    
    .table-responsive1 tr th{
        border: 1px solid #fff !important;
    }
    
    .table-responsive1 tr td{
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
    
    /*table.dataTable{*/
    /*    margin-top: -20px !important;*/
    /*}*/
    
    /*Ref: https://codepen.io/Vikaspatel/pen/BawZeag*/
    
    .year-color {
        color: #303030 !important;
        font-weight: bold !important;
    }
    
    .clrBtn {
        width: 13.33%;
        padding: 25px;
        color: #ffffff;
        font-size: 30px;
        cursor: pointer;
        border: 0;
        transition: 300ms all linear;
        position: relative;
    }
    .clrBtn.active:after {
        content: "";
        height: 20px;
        width: 20px;
        position: absolute;
        background-color: #ffffff;
        top: 14px;
        right: 22px;
        border-radius: 50%;
    }
    .clrBtn.active:before {
        content: "";
        height: 7px;
        width: 10px;
        position: absolute;
        top: 20px;
        right: 27px;
        border-radius: 2px;
        position: absolute;
        z-index: 1;
        border-left: 3px solid #333333;
        border-bottom: 3px solid #333333;
        z-index: 11;
        transform: rotate(-45deg);
    }
    
    .none{
        background-color: #96c7f242 !important;
    }
    .red{
        background-color: #f58b8b !important;
    } 
    .yellow{
        background-color: #f0f58b !important;
    } 
    .violet{
        background-color: #f38bf5 !important;
    } 
    .green{
        background-color: #37fa1f !important;
    } 
    
    <?php if(!empty($refSubGrpArr)): ?>
    
    table.dataTable {
        margin-top: -20px !important;
    }
    
    <?php endif; ?>
    
    /*.btn-group{*/
    /*    display: block !important;*/
    /*}*/
</style>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box mt-40">
                    <div class="box-header with-border flexbox text-center">
                        <h4 class="box-title font-weight-bold">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addSubGroup">
                                <button class="btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('superadmin/referncer'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive1">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <table class="onlyTableId table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th>Name</th>
                                                <th>Group</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($refSubGrpArr)): ?>
                                                <?php $i=1; ?>
                                                <?php foreach($refSubGrpArr AS $e_row): ?>
                                                    <tr>
                                                        <td nowrap width="5%" class="text-center"><?php echo $i; ?></td>
                                                        <td nowrap><?php echo $e_row['refSubGrpName']; ?></td>
                                                        <td nowrap><?php echo $e_row['refGrpName']; ?></td>
                                            			<td class="text-center" width="5%">
                                            			    
                                            			    <div class="btn-group">
                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateSubGroup<?php echo $e_row['refSubGrpId']; ?>">Edit</a>
                                                                    <a class="dropdown-item deleteContGroup" href="javascript:void(0);" data-id="<?php echo $e_row['refSubGrpId']; ?>">Delete</a>
                                                                </div>
                                                            </div>
                                                            
                                            			</td>
                                            		</tr>
                                        		    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4"><center>No records</center></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
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
        <!-- /.row -->
    </section>
    <!-- /.content -->
    
    <?php if(!empty($refSubGrpArr)): ?>
        <?php $i=1; ?>
        <?php foreach($refSubGrpArr AS $e_row): ?>                    
        <!-- Modal -->
        <div id="updateSubGroup<?php echo $e_row['refSubGrpId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="<?php echo base_url('superadmin/editRefSubGroups'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Sub Group</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Name<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="sub_group_name" placeholder="Enter Name" value="<?= $e_row['refSubGrpName']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Group<small class="text-danger">*</small></label>
                                        <select class="custom-select form-control" name="fk_group_id" required>
                                            <option value="">Select Group</option>
                                            <?php if(!empty($refGrpArr)): ?>
                                                <?php foreach($refGrpArr AS $e_grp): ?>
                                                    <option value="<?= $e_grp['refGrpId']; ?>" <?php if($e_grp['refGrpId']==$e_row['fkRefGrpId']): ?>selected<?php endif; ?> ><?= $e_grp['refGrpName']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="sub_group_id" value="<?= $e_row['refSubGrpId']; ?>">
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
    <div id="addSubGroup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo base_url('superadmin/addRefSubGroups'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Sub Group</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Name<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="sub_group_name" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Group<small class="text-danger">*</small></label>
                                    <select class="custom-select form-control" name="fk_group_id" required>
                                        <option value="">Select Group</option>
                                        <?php if(!empty($refGrpArr)): ?>
                                            <?php foreach($refGrpArr AS $e_grp): ?>
                                                <option value="<?= $e_grp['refGrpId']; ?>"><?= $e_grp['refGrpName']; ?></option>
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
        $('.deleteContGroup').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var sub_group_id = $(this).data('id');

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

                    var postingUrl = base_url+'/superadmin/deleteRefSubGroups';
                    $.post(postingUrl, 
                    {
                        sub_group_id: sub_group_id
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/refSubGroups";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
    });
</script>  
    
<?= $this->endSection(); ?>