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
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addModal">
                                <button class="btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('superadmin/home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive1">
                            <div class="row">
                                <div class="col-12">
                                    <table class="onlyTableId table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th>Announcement</th>
                                                <th width="5%">Start&nbsp;Date</th>
                                                <th width="5%">End&nbsp;Date</th>
                                                <th width="5%">Status</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($ancArr)): ?>
                                                <?php $i=1; ?>
                                                <?php foreach($ancArr AS $e_row): ?>
                                                    <?php
                                                        $startDate = (check_valid_date($e_row['startDate'])) ? date('Y-m-d', strtotime($e_row['startDate'])) : "";
                                                        $endDate = (check_valid_date($e_row['endDate'])) ? date('Y-m-d', strtotime($e_row['endDate'])) : "";

                                                        $showAnnc = "yes";
                                                        if($startDate!="" && $endDate!="")
                                                        {
                                                            $periodDates = get_dates_btwn_two($startDate, $endDate);
                                                            
                                                            if(!empty($periodDates)){
                                                                foreach ($periodDates as $key => $value) {
                                                                    $anncDate = $value;
                                                                    
                                                                    if($anncDate >= $ddFromDate && $anncDate<=$ddToDate)
                                                                    {
                                                                        $showAnnc = "yes";
                                                                        break;
                                                                    }
                                                                    else
                                                                    {
                                                                        $showAnnc = "no";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    <?php if($showAnnc=="yes"): ?>
                                                    <tr>
                                                        <td nowrap width="5%" class="text-center"><?php echo $i; ?></td>
                                                        <td ><?php echo $e_row['ancName']; ?></td>
                                                        <td nowrap width="5%"><?php echo date('d-m-Y', strtotime($e_row['startDate'])); ?></td>
                                                        <td nowrap width="5%"><?php echo date('d-m-Y', strtotime($e_row['endDate'])); ?></td>
                                                        <td nowrap width="5%" class="text-center">
                                                            <?php 
                                                                if($e_row['stopAnc']==1)
                                                                    echo "Active";
                                                                else
                                                                    echo "Deactive";
                                                            ?>
                                                        </td>
                                            			<td class="text-center" width="5%">
                                            			    
                                            			    <div class="btn-group">
                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateModal<?php echo $e_row['ancId']; ?>">Edit</a>
                                                                    <?php if($e_row['stopAnc']==1): ?>
                                                                        <a class="dropdown-item deactivateAnc" href="javascript:void(0);" data-id="<?php echo $e_row['ancId']; ?>">Deactivate</a>
                                                                    <?php else: ?>
                                                                        <a class="dropdown-item activateAnc" href="javascript:void(0);" data-id="<?php echo $e_row['ancId']; ?>">Activate</a>
                                                                    <?php endif; ?>
                                                                    <a class="dropdown-item deleteAnc" href="javascript:void(0);" data-id="<?php echo $e_row['ancId']; ?>">Delete</a>
                                                                </div>
                                                            </div>
                                                            
                                            			</td>
                                            		</tr>
                                        		    <?php $i++; ?>
                                        		    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6"><center>No records</center></td>
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
    
    <?php if(!empty($ancArr)): ?>
        <?php $i=1; ?>
        <?php foreach($ancArr AS $e_row): ?>
        <!-- Modal -->
        <div id="updateModal<?php echo $e_row['ancId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="<?php echo base_url('superadmin/editAnnouncement'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Announcement</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Announcement<small class="text-danger">*</small></label>
                                        <textarea class="form-control" name="ancName" id="ancName" placeholder="Enter Announcement" required><?= $e_row['ancName']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Start Date<small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" name="startDate" id="startDate" value="<?= $e_row['startDate']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>End Date<small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" name="endDate" id="endDate" value="<?= $e_row['endDate']; ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="ancId" id="ancId" value="<?= $e_row['ancId']; ?>">
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
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo base_url('superadmin/addAnnouncement'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Announcement</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Announcement<small class="text-danger">*</small></label>
                                    <textarea class="form-control" name="ancName" id="ancName" placeholder="Enter Announcement" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Start Date<small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="startDate" id="startDate" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>End Date<small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="endDate" id="endDate" required>
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
        $('.stopAnc').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var ancId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to stop ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, stop it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/superadmin/stopAnnouncement';
                    $.post(postingUrl, 
                    {
                        ancId: ancId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/announcements";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
        
        $('.deactivateAnc').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var ancId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to deactivate ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, deactivate it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/superadmin/deactivateAnc';
                    $.post(postingUrl, 
                    {
                        ancId: ancId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/announcements";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });  
        
        $('.activateAnc').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var ancId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to activate ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, activate it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/superadmin/activateAnc';
                    $.post(postingUrl, 
                    {
                        ancId: ancId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/announcements";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });  
        
        $('.deleteAnc').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var ancId = $(this).data('id');

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

                    var postingUrl = base_url+'/superadmin/deleteAnnouncement';
                    $.post(postingUrl, 
                    {
                        ancId: ancId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/announcements";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
    });
</script>  
    
<?= $this->endSection(); ?>