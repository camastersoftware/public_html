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
        
        .table-responsive {
            overflow-x: hidden !important;
        }
        
        table.dataTable{
            margin-top: 0px !important;
        }
        
        .dt-buttons{
            display: block !important;
        }
    </style>

    <!-- Main content -->
    <section class="content mt-35">
        <div class="row">

            <div class="col-12">

                <div class="box">
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
    					    <button class="btn btn-sm btn-submit" data-toggle="modal" data-target="#addEverydayLabModal">Add Everyday Lab</button>
    					</div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <table class="onlyTableId table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th width="5%">Date</th>
                                                <th>Image</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($resultArr)): ?>
                                                <?php $i=1; ?>
                                                <?php foreach($resultArr AS $e_row): ?>
                                                    <tr>
                                                        <td class="text-center" width="5%"><?php echo $i; ?></td>
                                                        <td width="5%"><?= (check_valid_date($e_row['everydayLabDate'])) ? date("d-m-Y", strtotime($e_row['everydayLabDate'])) : "" ?></td>
                                                        <td>
                                                            <?php $uploadFilePath = base_url(EVERYDAYLABPATH.$e_row['everydayLabImage']); ?>
                                                            <a href="<?= $uploadFilePath; ?>" target="_blank">
                                                                <img class="m-3" width="100" src="<?= $uploadFilePath; ?>" />
                                                            </a>
                                                        </td>
                                                        <td width="5%">
                                                            <div class="btn-group">
                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editEverydayLabModal<?php echo $e_row['everydayLabId']; ?>">Edit</a>
                                                                    <a class="dropdown-item delEverydayLab" href="javascript:void(0);" data-id="<?php echo $e_row['everydayLabId']; ?>">Delete</a>
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
                                <div class="col-12">
                                    <p>
                                        <span class="font-weight-bold">Note: </span>
                                        <span>For any changes contact Developer.</span>
                                    </p>
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
    
    <?php if(!empty($resultArr)): ?>
        <?php foreach($resultArr AS $e_row): ?>
        
        <?php $everydayLabDate = (check_valid_date($e_row['everydayLabDate'])) ? date("Y-m-d", strtotime($e_row['everydayLabDate'])) : ""; ?>
        
        <div id="editEverydayLabModal<?php echo $e_row['everydayLabId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    		<div class="modal-dialog">
    			<div class="modal-content">
    				<form action="<?php echo base_url('superadmin/edit_everyday_lab'); ?>" method="POST" enctype="multipart/form-data">
        				<div class="modal-header">
        					<h4 class="modal-title" id="myModalLabel">Edit Everyday Lab</h4>
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        				</div>
        				<div class="modal-body">
        					<div class="row">
        					    <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Date <small class="text-danger">*</small></label>
                                        <input type="date" name="everydayLabDate" class="form-control" value="<?php echo $everydayLabDate; ?>" required>
                                        <input type="hidden" name="everydayLabDateOld" value="<?php echo $everydayLabDate; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-10 col-lg-10">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="everydayLabImage" class="form-control">
                                        <input type="hidden" name="everydayLabImageOld" value="<?php echo $e_row['everydayLabImage']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <div class="form-group mt-30">
                                        <?php $uploadFilePath = base_url(EVERYDAYLABPATH.$e_row['everydayLabImage']); ?>
                                        <a href="<?= $uploadFilePath; ?>" target="_blank">
                                            <button type="button" class="waves-effect waves-light btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="View">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Quotes</label>
                                        <input type="text" name="everydayLabQuotes" class="form-control checkMaxLength" maxLength="170" value="<?php echo $e_row['everydayLabQuotes']; ?>">
                                        <span class="text-danger">Maximun 170 characters allowed.</span>
                                    </div>
                                </div>
                            </div>
        				</div>
        				<div class="modal-footer text-right" style="width: 100%;">
        					<input type="hidden" name="everydayLabId" value="<?php echo $e_row['everydayLabId']; ?>">
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
	
	<div id="addEverydayLabModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="<?php echo base_url('superadmin/add_everyday_lab'); ?>" method="POST" enctype="multipart/form-data">
    				<div class="modal-header">
    					<h4 class="modal-title" id="myModalLabel">Add Everyday Lab</h4>
    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    				</div>
    				<div class="modal-body">
    					<div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Date <small class="text-danger">*</small></label>
                                    <input type="date" name="everydayLabDate" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Image <small class="text-danger">*</small></label>
                                    <input type="file" name="everydayLabImage" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Quotes</label>
                                    <input type="text" name="everydayLabQuotes" class="form-control checkMaxLength" maxLength="170">
                                    <span class="text-danger">Maximun 170 characters allowed.</span>
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

        $('.delEverydayLab').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var everydayLabId = $(this).data('id');
            
            console.log("everydayLabId", everydayLabId);

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this Everyday Lab ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    
                    var postingUrl = base_url+'/superadmin/delete_everyday_lab';
                    $.post(postingUrl, 
                    {
                        "everydayLabId": everydayLabId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/everyday_lab";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

    });
</script>

<?= $this->endSection(); ?>