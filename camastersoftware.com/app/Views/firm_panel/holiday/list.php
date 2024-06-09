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
        
        table.dataTable {
            margin-top: 0px !important;
        }
        
        /*.btn-group{*/
        /*    display: block !important;*/
        /*}*/
        
        .select2-container--default .select2-selection--single {
            background-color: #005495 !important;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 41px !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #fff !important;
            line-height: 28px;
            font-weight: 700 !important;
            font-size: 17.2px !important;
        }
        
        .select2-container--default .select2-selection--single {
            background-color: #005495 !important;
            border: 1px solid #aaa;
            border-radius: 4px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 32px !important;
            right: 3px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #fff transparent transparent transparent !important;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 50%;
            margin-left: -4px;
            margin-top: -2px;
            position: absolute;
            top: 50%;
            width: 0;
        }
        
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            margin-top: 0px;
            position: relative;
            vertical-align: middle;
            margin-top: 0px !important;
        }
        
        .select2-container--default .select2-selection--single {
            background-color: #005495 !important;
            border: none !important;
            border-radius: 7px !important;
            height: 41px !important;
        }
        
        #DataTables_Table_0_filter{
            margin-top: -40px !important;
        }
        
        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: -17.5em !important;
            display: inline-block;
            width: auto;
            z-index: 9999999 !important;
            position: absolute !important;
            height: 40px !important;
            margin-top: -6px !important;
        }
        
        .theme-primary .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #005495 !important;
        }
        
        .btn_rnd{
            border-radius: 7px !important;
            width: 100% !important;
        }
        
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0;
            height: auto;
            margin-top: 0px !important;
            padding-right: 10px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 5px !important;
            right: 1px;
            width: 20px;
        }
        
        <?php if(!empty($holidayArr)): ?>
        
            .table-responsive1{
                /*margin-top: -60px !important;*/
            }
            
        <?php endif; ?>
        
        .zInd{
            z-index: 1 !important;
        }
        
        .proj_bg{
            background: #96c7f242 !important;
            font-size: 16px !important;
            margin-top: 10px !important;
            border: 1px solid #015aacab !important;
            margin-left: 5px !important;
            /*border-radius: 10px;*/
            padding-bottom: 20px !important;
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
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addModal">
                                <button class="btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button>
                            </a>
                            &nbsp;&nbsp;
                            <!--
                            <a href="<?php //echo base_url('scheduleNotes'); ?>">
                                <button type="button" class="btn btn-danger btn-sm">Notes</button>
                            </a>
                            &nbsp;&nbsp;
                            -->
                            <a href="<?php echo base_url('office-administration'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-10 offset-1 mb-20">
                                <div class="row">
                                    <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group row mb-0">
                                            <div class="col-3 offset-9 text-center zInd">
                                                <select class="form-control select2" name="holidayYr" id="holidayYr" onchange="serachHoliday(this);" style="width:100%;margin-top: 4px;" required>
                                                    <option value="">Select Year</option>
                                                    <?php for($yr=2017; $yr<=2100; $yr++): ?>
                                                        <option value="<?= $yr; ?>" <?php if($yr==$holidayYr): ?>selected<?php endif; ?> ><?= $yr; ?></option>
                                                    <?php endfor; ?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="offset-md-1 col-md-10 text-center">
                                <h4>
                                    <span class="font-weight-bold">Office Time : </span>
                                    <span>
                                        <?php echo (!empty($settingsArr['officeStartTime'])) ? date('h:i A', strtotime($settingsArr['officeStartTime'])) : "N/A"; ?>
                                        &nbsp;-&nbsp;
                                        <?php echo (!empty($settingsArr['officeEndTime'])) ? date('h:i A', strtotime($settingsArr['officeEndTime'])) : "N/A"; ?>
                                    </span>
                                    &nbsp;/&nbsp;
                                    <span class="font-weight-bold">Half-Day Time : </span>
                                    <span>
                                        <?php echo (!empty($settingsArr['halfDayStartTime'])) ? date('h:i A', strtotime($settingsArr['halfDayStartTime'])) : "N/A"; ?>
                                        &nbsp;-&nbsp;
                                        <?php echo (!empty($settingsArr['halfDayEndTime'])) ? date('h:i A', strtotime($settingsArr['halfDayEndTime'])) : "N/A"; ?>
                                    </span>
                                </h4>
                            </div>
                            <div class="col-10 offset-1">
                                <div class="table-responsive1">
                                    <table class="onlyExportDtTable table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th width="5%">Date</th>
                                                <th width="5%">Day</th>
                                                <th width="25%">On&nbsp;Account&nbsp;of</th>
                                                <th>Remarks</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($holidayArr)): ?>
                                                <?php $i=1; ?>
                                                <?php foreach($holidayArr AS $e_row): ?>
                                                    <tr>
                                                        <td nowrap width="5%" class="text-center"><?php echo $i; ?></td>
                                                        <td nowrap width="5%" ><?php echo date('d-m-Y', strtotime($e_row['holidayDate'])); ?></td>
                                                        <td nowrap width="5%" ><?php echo date('l', strtotime($e_row['holidayDate'])); ?></td>
                                                        <td nowrap width="25%"><?php echo $e_row['holidayName']; ?></td>
                                                        <td ><?php echo (!empty($e_row['holidayRemark'])) ? $e_row['holidayRemark'] : "<div class='text-center'>-</div>"; ?></td>
                                            			<td class="text-center" width="5%">
                                            			    
                                            			    <div class="btn-group">
                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateModal<?php echo $e_row['holidayId']; ?>">Edit</a>
                                                                    <a class="dropdown-item deleteRowData" href="javascript:void(0);" data-id="<?php echo $e_row['holidayId']; ?>">Delete</a>
                                                                </div>
                                                            </div>
                                                            
                                            			</td>
                                            		</tr>
                                        		    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6"><center>No records</center></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if(!empty($settingsArr['scheduleNotes'])): ?>
                                <div class="row proj_bg">
                                    <label class="font-weight-bold col-md-12">Notes : </label>
                                    <div class="col-md-12"><?= nl2br($settingsArr['scheduleNotes']); ?></div>
                                </div>
                                <?php endif; ?>
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
    
    <?php if(!empty($holidayArr)): ?>
        <?php $i=1; ?>
        <?php foreach($holidayArr AS $e_row): ?>                    
        <!-- Modal -->
        <div id="updateModal<?php echo $e_row['holidayId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo base_url('editHoliday'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Sub Group</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>On Account of<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="holidayName" id="holidayName" placeholder="Enter Holiday On Account of" value="<?= $e_row['holidayName']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Date<small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" name="holidayDate" id="holidayDate" value="<?= $e_row['holidayDate']; ?>" min="<?= $holidayYr; ?>-01-01" max="<?= $holidayYr; ?>-12-31" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="holidayRemark" id="holidayRemark" placeholder="Enter Remarks (If any)" rows="3"><?= $e_row['holidayRemark']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="holidayId" id="holidayId" value="<?= $e_row['holidayId']; ?>">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo base_url('addHoliday'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Holiday</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>On Account of<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="holidayName" id="holidayName" placeholder="Enter Holiday On Account of" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Date<small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="holidayDate" id="holidayDate" min="<?= $holidayYr; ?>-01-01" max="<?= $holidayYr; ?>-12-31" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name="holidayRemark" id="holidayRemark" placeholder="Enter Remarks (If any)" rows="3"></textarea>
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
        $('.deleteRowData').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var holidayId = $(this).data('id');

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

                    var postingUrl = base_url+'/deleteHoliday';
                    $.post(postingUrl, 
                    {
                        holidayId: holidayId
                    },
                    function(data, status){
                        window.location.href=base_url+"/holidays";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
    });
</script>  

<script type="text/javascript">
    
    var base_url = "<?= base_url(); ?>";
    
    function serachHoliday($this)
    {
        var holidayYr=$this.value;
        
        window.location.href=base_url+"/holidays?holidayYr="+holidayYr;
    }

</script>
    
<?= $this->endSection(); ?>