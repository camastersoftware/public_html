<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

    <!-- Main content -->
    <section class="content mt-40">
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
    					    <button class="btn btn-submit" data-toggle="modal" data-target="#addModal">Add Payment Option</button>
    					</div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Payment Option</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($resultArr)): ?>
                                        <?php $i=1; ?>
                                        <?php foreach($resultArr AS $e_row): ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $e_row['payment_option_name']; ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#editModal<?php echo $e_row['payment_option_id']; ?>"><button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil"></i>&nbsp;Edit</button></a>
                                                    <button class="btn btn-sm btn-danger delPaymentOption" id="<?php echo $e_row['payment_option_id']; ?>" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                    
                                                    <div id="editModal<?php echo $e_row['payment_option_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                		<div class="modal-dialog">
                                                			<div class="modal-content">
                                                				<form action="<?php echo base_url('superadmin/edit_payment_option'); ?>" method="POST">
                                                    				<div class="modal-header">
                                                    					<h4 class="modal-title" id="myModalLabel">Edit Payment Option</h4>
                                                    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    				</div>
                                                    				<div class="modal-body">
                                                    					<div class="row">
                                                                            <div class="col-md-12 col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>Payment Option<small class="text-danger">*</small></label>
                                                                                    <input type="text" name="payment_option_name" class="form-control" placeholder="Enter Payment Option" value="<?php echo $e_row['payment_option_name']; ?>" required>
                                                                                </div>  
                                                                            </div>
                                                                        </div>
                                                    				</div>
                                                    				<div class="modal-footer text-right" style="width: 100%;">
                                                    					<input type="hidden" name="payment_option_id" value="<?php echo $e_row['payment_option_id']; ?>">
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
                                        <th>Payment Option</th>
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
				<form action="<?php echo base_url('superadmin/add_payment_option'); ?>" method="POST" >
    				<div class="modal-header">
    					<h4 class="modal-title" id="myModalLabel">Add Payment Option</h4>
    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    				</div>
    				<div class="modal-body">
    					<div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Payment Option<small class="text-danger">*</small></label>
                                    <input type="text" name="payment_option_name" class="form-control" placeholder="Enter Payment Option" required>
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

        $('.delPaymentOption').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var payment_option_id = $(this).attr('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this Payment Option ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    
                    var postingUrl = base_url+'/superadmin/delete_payment_option';
                    $.post(postingUrl, 
                    {
                        payment_option_id: payment_option_id
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/payment_options";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

    });
</script>

<?= $this->endSection(); ?>