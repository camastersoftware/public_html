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
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addReferncer">
                                <button class="btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('admin/home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
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
                                        <th>Year</th>
                                        <th>Referencer&nbsp;Name</th>
                                        <th>Author</th>
                                        <th width="5%">Uploaded&nbsp;Date</th>
                                        <th width="5%">Uploaded&nbsp;By</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($referncerArr)): ?>
                                        <?php $i=1; ?>
                                        <?php foreach($referncerArr AS $e_row): ?>
                                            <?php 
                                                if(array_key_exists('hasFirm', $e_row))
                                                    $docUrl=$firmDocPath.'/'.$e_row['referncerFile'];
                                                else
                                                    $docUrl=$docPath.'/'.$e_row['referncerFile'];
                                            ?>
                                            <tr>
                                    			<td class="text-center" width="5%"><?php echo $i; ?></td>
                                    			<td nowrap class="text-center" width="5%"><?php echo $e_row['referncerYear']; ?></td>
                                    			<td nowrap><a href="<?= $docUrl; ?>" target="_blank"><?php echo $e_row['referncerHeading']; ?></a></td>
                                    			<td nowrap class="text-center" width="5%"><?php echo $e_row['referncerAuthor']; ?></td>
                                    			<td class="text-center" width="5%">
                                    			    <?php
                                    			        if($e_row['referncerUploadDate']!="" && $e_row['referncerUploadDate']!="1970-01-01"  && $e_row['referncerUploadDate']!="0000-00-00")
                                    			            $referncerUploadDate=date('Y-m-d', strtotime($e_row['referncerUploadDate']));
                                    			        else
                                    			            $referncerUploadDate="";
                                    			            
                                    			        if(!empty($referncerUploadDate))
                                    			            echo date('d-m-Y', strtotime($referncerUploadDate));
                                    			        else
                                    			            echo "---";
                                    			    ?>
                                    			</td>
                                    			<td class="text-center" width="5%">
                                    			    <?php if(array_key_exists('hasFirm', $e_row)): ?>
                                    			        Self
                                    			    <?php else: ?>
                                                        CAMaster
                                                    <?php endif; ?>
                                    			</td>
                                    			<td class="text-center" width="5%">
                                    			    
                                    			    <div class="btn-group">
                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                            <?php if(array_key_exists('hasFirm', $e_row)): ?>
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateReferncer<?php echo $e_row['referncerId']; ?>">Edit</a>
                                                                <a class="dropdown-item" href="<?php echo $firmDocPath.'/'.$e_row['referncerFile']; ?>" target="_blank">View</a>
                                                                <a class="dropdown-item deleteReferncer" href="javascript:void(0);" data-id="<?php echo $e_row['referncerId']; ?>">Delete</a>
                                                            <?php else: ?>
                                                                <a class="dropdown-item" href="<?php echo $docPath.'/'.$e_row['referncerFile']; ?>" target="_blank">View</a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                    			</td>
                                    		</tr>
                                    		<?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7"><center>No records</center></td>
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
    
    <?php if(!empty($referncerArr)): ?>
        <?php foreach($referncerArr AS $e_row): ?>
        
        <?php if(array_key_exists('hasFirm', $e_row)): ?>
        
            <!-- Modal -->
            <div id="updateReferncer<?php echo $e_row['referncerId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="<?php echo base_url('admin/updateReferncer'); ?>" method="POST" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Edit Referencer</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Name<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="referncerHeading" id="referncerHeading" placeholder="Enter Heading" value="<?php echo $e_row['referncerHeading']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Year<small class="text-danger">*</small></label>
                                            <select class="custom-select form-control" id="referncerYear" name="referncerYear">
                                                <option value="">Select Year</option>
                                                <?php for($d=2021; $d>=2011; $d--): ?>
                                                    <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                                    <option value="<?php echo $dueYr; ?>" <?php echo set_select('referncerYear', $dueYr, $e_row['referncerYear']==$dueYr ? TRUE:FALSE); ?> ><?php echo $dueYr; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Author<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="referncerAuthor" id="referncerAuthor" placeholder="Enter Author" value="<?php echo $e_row['referncerAuthor']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Document File</label>
                                            <input type="file" class="form-control" name="referncerFile" id="referncerFile">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-right" style="width: 100%;">
                                <input type="hidden" name="referncerOldFile" id="referncerOldFile" value="<?php echo $e_row['referncerFile']; ?>">
                                <input type="hidden" name="referncerId" id="referncerId" value="<?php echo $e_row['referncerId']; ?>">
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
        
        <?php endif; ?>
        
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Modal -->
    <div id="addReferncer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo base_url('admin/addReferncer'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Referencer</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Name<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="referncerHeading" id="referncerHeading" placeholder="Enter Heading" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Year<small class="text-danger">*</small></label>
                                    <select class="custom-select form-control" id="referncerYear" name="referncerYear">
                                        <option value="">Select Year</option>
                                        <?php for($d=2021; $d>=2011; $d--): ?>
                                            <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                            <option value="<?php echo $dueYr; ?>" <?php echo set_select('referncerYear', $dueYr); ?> ><?php echo $dueYr; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Author<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="referncerAuthor" id="referncerAuthor" placeholder="Enter Author" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Document File<small class="text-danger">*</small></label>
                                    <input type="file" class="form-control" name="referncerFile" id="referncerFile" required>
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
        $('.deleteReferncer').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var referncerId = $(this).data('id');

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

                    var postingUrl = base_url+'/admin/deleteReferncer';
                    $.post(postingUrl, 
                    {
                        referncerId: referncerId
                    },
                    function(data, status){
                        window.location.href=base_url+"/admin/referncer";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
    });
</script> 
  
<?= $this->endSection(); ?>