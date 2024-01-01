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
                    <div class="box-body text-center">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Act: <?php echo $actArr['act_name']; ?></h4>
                            </div>
                            <div class="col-md-6">
                                <h4>
                                    Option Type: 
                                    <?php 
                                        if($optionId==1)
                                            echo "Due Date For"; 
                                        elseif($optionId==2)
                                            echo "Tax Payer"; 
                                        elseif($optionId==3)
                                            echo "Under Section"; 
                                        elseif($optionId==4)
                                            echo "Audit"; 
                                        elseif($optionId==5)
                                            echo "Applicable Form"; 
                                        elseif($optionId==6)
                                            echo "Condition"; 
                                        else
                                            echo "N/A"; 
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

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
    					    <button class="btn btn-sm btn-submit" data-toggle="modal" data-target="#addModal">Add <?php echo $pageSection; ?></button>
    					    <a href="<?php echo base_url('superadmin/view_options-'.$actId); ?>">
    					        <button type="button" class="btn btn-sm btn-dark">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <table class="onlyTableId table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="10%">SN</th>
                                                <th><?php echo $pageSection; ?></th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($resultArr)): ?>
                                                <?php $i=1; ?>
                                                <?php foreach($resultArr AS $e_row): ?>
                                                    <tr>
                                                        <td width="10%" class="text-center"><?php echo $i; ?></td>
                                                        <td><?php echo $e_row['act_option_name']; ?></td>
                                                        <td class="text-center" width="5%">
                                                            <div class="btn-group">
                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editModal<?php echo $e_row['act_option_map_id']; ?>">Edit</a>
                                                                    <a class="dropdown-item delClientCategory hide" href="javascript:void(0);" id="<?php echo $e_row['act_option_map_id']; ?>">Delete</a>
                                                                </div>
                                                            </div>
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
            <div id="editModal<?php echo $e_row['act_option_map_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        		<div class="modal-dialog">
        			<div class="modal-content">
        				<form action="<?php echo base_url('superadmin/edit_act_option'); ?>" method="POST">
            				<div class="modal-header">
            					<h4 class="modal-title" id="myModalLabel">Edit <?php echo $pageSection; ?></h4>
            					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            				</div>
            				<div class="modal-body">
            					<div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo $pageSection; ?> Name <small class="text-danger">*</small></label>
                                            <input type="text" name="act_option_name" class="form-control" placeholder="<?php echo $pageSection; ?> Name" value="<?php echo $e_row['act_option_name']; ?>" required>
                                        </div>  
                                    </div>
                                </div>
            				</div>
            				<div class="modal-footer text-right" style="width: 100%;">
            					<input type="hidden" name="act_option_map_id" value="<?php echo $e_row['act_option_map_id']; ?>">
            					<input type="hidden" name="actId" value="<?php echo $actId; ?>">
            					<input type="hidden" name="optionId" value="<?php echo $optionId; ?>">
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
	
	<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="<?php echo base_url('superadmin/add_act_option'); ?>" method="POST" >
    				<div class="modal-header">
    					<h4 class="modal-title" id="myModalLabel">Add <?php echo $pageSection; ?></h4>
    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    				</div>
    				<div class="modal-body">
    					<div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label><?php echo $pageSection; ?> Name <small class="text-danger">*</small></label>
                                    <input type="text" name="act_option_name" class="form-control" placeholder="<?php echo $pageSection; ?> Name" required>
                                </div>
                            </div>
                        </div>
    				</div>
    				<div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="actId" value="<?php echo $actId; ?>">
                        <input type="hidden" name="optionId" value="<?php echo $optionId; ?>">
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

        $('.delClientCategory').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var itemName = "<?php echo $pageSection; ?>";
            var actId = "<?php echo $actId; ?>";
            var optionId = "<?php echo $optionId; ?>";
            var act_option_map_id = $(this).attr('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this "+itemName+" ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    
                    var postingUrl = base_url+'/superadmin/delete_act_option';
                    $.post(postingUrl, 
                    {
                        act_option_map_id: act_option_map_id,
                        "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                    },
                    function(data, status){
                        window.location.href=base_url+"superadmin/act_option-"+actId+"-"+optionId;
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

    });
</script>

<?= $this->endSection(); ?>