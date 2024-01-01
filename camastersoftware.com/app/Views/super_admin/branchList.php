<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border flexbox">
                        <h3 class="box-title">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h3>
                        <div class="text-right flex-grow">
    					    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Branch</button>
    					</div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Branch</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($branchList)): ?>
                                        <?php $i=1; ?>
                                        <?php foreach($branchList AS $e_row): ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $e_row['branchName']; ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#editModal<?php echo $e_row['branchId']; ?>"><button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil"></i>&nbsp;Edit</button></a>
                                                    <button class="btn btn-sm btn-danger delBranch" id="<?php echo $e_row['branchId']; ?>" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                    
                                                    <div id="editModal<?php echo $e_row['branchId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                		<div class="modal-dialog">
                                                			<div class="modal-content">
                                                				<form action="<?php echo base_url('edit_branch'); ?>" method="POST">
                                                    				<div class="modal-header">
                                                    					<h4 class="modal-title" id="myModalLabel">Edit Branch</h4>
                                                    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    				</div>
                                                    				<div class="modal-body">
                                                    					<div class="row">
                                                                            <div class="col-md-12 col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>Branch Name <small class="text-danger">*</small></label>
                                                                                    <input type="text" name="branchName" class="form-control" placeholder="Branch Name" value="<?php echo $e_row['branchName']; ?>" required>
                                                                                </div>  
                                                                            </div>
                                                                        </div>
                                                    				</div>
                                                    				<div class="modal-footer text-right" style="width: 100%;">
                                                    					<input type="hidden" name="branchId" value="<?php echo $e_row['branchId']; ?>">
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
                                                    
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3"><center>No records</center></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Branch</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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
	
	<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="<?php echo base_url('add_branch'); ?>" method="POST" >
    				<div class="modal-header">
    					<h4 class="modal-title" id="myModalLabel">Add Branch</h4>
    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    				</div>
    				<div class="modal-body">
    					<div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Branch Name <small class="text-danger">*</small></label>
                                    <input type="text" name="branchName" class="form-control" placeholder="Branch Name" required>
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
    $(document).ready(function () {

        $('.delBranch').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var branchId = $(this).attr('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this branch ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    
                    window.location = base_url+'/delete_branch-'+branchId;

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

    });
</script>

<?= $this->endSection(); ?>