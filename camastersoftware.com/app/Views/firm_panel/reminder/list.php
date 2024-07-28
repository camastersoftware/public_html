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
        
        <?php if(!empty($reminderArr)): ?>
        
        table.dataTable{
            margin-top: -20px !important;
        }
        
        <?php endif; ?>
        
        /*Ref: https://codepen.io/Vikaspatel/pen/BawZeag*/
        
        .year-color {
            color: #303030 !important;
            font-weight: bold !important;
        }
        
        .clrBtn {
            width: 13.33%;
            padding: 0px;
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

        .clrBtn span{
            color: #000000 !important;
            font-size: 10px !important;
        }
        
        .none{
            background-color: #96c7f242 !important;
        }
        .red{
            background-color: pink !important;
        } 
        .yellow{
            background-color: #f0f58b7d !important;
        }
        
        /*.btn-group{*/
        /*    display: block !important;*/
        /*}*/
        
    </style>
    <style>
        tr.borderTopClr td{
            border-top: 10px solid #005495 !important;
            border-right: 1px solid #015aacab !important;
            border-bottom: 1px solid #015aacab !important;
            border-left: 1px solid #015aacab !important;
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
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addReminder">
                                <button class="btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button>
                            </a>
                            &nbsp;&nbsp;
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right get_back" style="">Back</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="onlyTableIdNoSortBy table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">Date</th>
                                        <th width="5%">Day</th>
                                        <th>Reminder</th>
                                        <th width="5%">From&nbsp;Time</th>
                                        <th width="5%">To&nbsp;Time</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $crMth=$prvMth=""; ?>
                                    <?php if(!empty($reminderArr)): ?>
                                        <?php $i=1; ?>
                                        <?php foreach($reminderArr AS $e_row): ?>
                                            <?php $crMth=date("m", strtotime($e_row['reminderDate'])); ?>
                                            <tr style="background-color: <?php echo $e_row['reminderColor']; ?> !important;" class="<?php if($crMth!=$prvMth && $prvMth!=""): ?>borderTopClr<?php endif; ?>">
                                    			<td nowrap class="text-center" width="5%"><?php echo date("d-m-Y", strtotime($e_row['reminderDate'])); ?></td>
                                    			<td nowrap class="text-center" width="5%"><?php echo date("D", strtotime($e_row['reminderDate'])); ?></td>
                                    			<td nowrap>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#updateReminder<?php echo $e_row['reminderId']; ?>">
                                                        <?php echo $e_row['reminderFor']; ?>
                                                    </a>
                                                </td>
                                    			<td nowrap class="text-center" width="5%">
                                    			    <?php 
                                    			        if(!empty($e_row['reminderFrom']) && $e_row['reminderFrom']!="00:00:00")
                                    			            echo date("h:i A", strtotime($e_row['reminderFrom'])); 
                                    			        else
                                    			            echo "---"; 
                                    			    ?>
                                    			</td>
                                    			<td nowrap class="text-center" width="5%">
                                    			    <?php 
                                    			        if(!empty($e_row['reminderTo']) && $e_row['reminderTo']!="00:00:00")
                                    			            echo date("h:i A", strtotime($e_row['reminderTo'])); 
                                    			        else
                                    			            echo "---"; 
                                    			    ?>
                                    			</td>
                                    			<td class="text-center" width="5%">
                                    			    
                                    			    <div class="btn-group">
                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateReminder<?php echo $e_row['reminderId']; ?>">Edit</a>
                                                            <a class="dropdown-item deleteReminder" href="javascript:void(0);" data-id="<?php echo $e_row['reminderId']; ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                    
                                    			</td>
                                    		</tr>
                                    	    <?php $i++; ?>
                                    	    <?php $prvMth=$crMth; ?>
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    
    <?php if(!empty($reminderArr)): ?>
        <?php foreach($reminderArr AS $e_row): ?>

        <?php
            $rmdUserArr = array();
            
            if(!empty($reminderUsers[$e_row['reminderId']]))
            {
                $rmdUserArr = $reminderUsers[$e_row['reminderId']];
            }
        ?>
        
        <!-- Modal -->
        <div id="updateReminder<?php echo $e_row['reminderId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="<?php echo base_url('updateReminder'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Reminder</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Date<small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" name="reminderDate" id="reminderDate" value="<?= $e_row['reminderDate']; ?>" min="<?= date('Y-m-d'); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Reminder<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="reminderFor" id="reminderFor" placeholder="Enter Reminder" value="<?= $e_row['reminderFor']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>From Time</label>
                                        <input type="time" class="form-control" name="reminderFrom" id="reminderFrom" value="<?= date("H:i", strtotime($e_row['reminderFrom'])); ?>" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>To Time</label>
                                        <input type="time" class="form-control" name="reminderTo" id="reminderTo" value="<?= date("H:i", strtotime($e_row['reminderTo'])); ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Reminder To :</label>
                                        <select class="form-control select2" name="reminderToUsers[]" id="reminderToUsers<?php echo $e_row['reminderId']; ?>" multiple="multiple" data-placeholder="Reminder To" style="width:100%;">
                                            <option value="">Select Users</option>
                                            <?php if(!empty($getUserList)): ?>
                                                <?php foreach($getUserList AS $e_usr_val): ?>
                                                    <option value="<?= $e_usr_val['userId']; ?>" <?= (in_array($e_usr_val['userId'], $rmdUserArr)) ? "selected":""; ?> ><?= $e_usr_val['userShortName']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Color<small class="text-danger">*</small></label>
                                        <div class="grid-Wrapper">
                                            <button type="button" class="clrBtn none <?php if($e_row['reminderColor']=="none"): ?>active<?php endif; ?>" data-clr="none" data-id="<?php echo $e_row['reminderId']; ?>" onclick="EditColorPicker('none',this);">
                                                <span>Low</span>
                                            </button>
                                            <button type="button" class="clrBtn yellow <?php if($e_row['reminderColor']=="#f0f58b7d"): ?>active<?php endif; ?>" data-clr="#f0f58b7d" data-id="<?php echo $e_row['reminderId']; ?>" onclick="EditColorPicker('#f0f58b7d',this);">
                                                <span>Medium</span>
                                            </button>
                                            <button type="button" class="clrBtn red <?php if($e_row['reminderColor']=="pink"): ?>active<?php endif; ?>" data-clr="pink" data-id="<?php echo $e_row['reminderId']; ?>" onclick="EditColorPicker('pink',this);">
                                                <span>High</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="reminderId" id="reminderId" value="<?php echo $e_row['reminderId']; ?>">
                            <input type="hidden" name="reminderColor" id="reminderColor<?php echo $e_row['reminderId']; ?>" value="<?php echo $e_row['reminderColor']; ?>" />
                            <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                            <?php if($e_row['isGroupReminder']==1): ?>
                                <?php if($sessUserLoginID==$e_row['reminderAddedBy']): ?>
                                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                                <?php endif; ?>
                            <?php else: ?>
                                <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                            <?php endif; ?>
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
    <div id="addReminder" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo base_url('addReminder'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Reminder</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Date<small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="reminderDate" id="reminderDate" min="<?= date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Reminder<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="reminderFor" id="reminderFor" placeholder="Enter Reminder" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>From Time</label>
                                    <input type="time" class="form-control" name="reminderFrom" id="reminderFrom" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>To Time</label>
                                    <input type="time" class="form-control" name="reminderTo" id="reminderTo" >
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Reminder To :</label>
                                    <select class="form-control select2" name="reminderToUsers[]" id="reminderToUsers" multiple="multiple" data-placeholder="Reminder To" style="width:100%;">
                                        <option value="">Select Users</option>
                                        <?php if(!empty($getUserList)): ?>
                                            <?php foreach($getUserList AS $e_usr_val): ?>
                                                <?php if($sessUserLoginID!=$e_usr_val['userId']): ?>
                                                <option value="<?= $e_usr_val['userId']; ?>" data-short="<?= $e_usr_val['userShortName']; ?>"><?= $e_usr_val['userShortName']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Select Color<small class="text-danger">*</small></label>
                                    <div class="grid-Wrapper">
                                        <button type="button" class="clrBtn none active" data-clr="none" onclick="ColorPicker('none',this);">
                                            <span>Low</span>
                                        </button>
                                        <button type="button" class="clrBtn yellow" data-clr="#f0f58b7d" onclick="ColorPicker('#f0f58b7d',this);">
                                            <span>Medium</span>
                                        </button>
                                        <button type="button" class="clrBtn red" data-clr="pink" onclick="ColorPicker('pink',this);">
                                            <span>High</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="reminderColor" id="reminderColor" value="none" />
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
    var x,y,i;
    
    function ColorPicker(x,y){
        var val= y.innerHTML;
        
        // document.getElementById('selectedBox').style.backgroundColor=x;
        // document.getElementById('selectedBox').innerHTML=val;
        // document.getElementById('textColor').style.color=x;
        // document.getElementById('textColor').innerHTML=x.toUpperCase();

        /**/
        var activeState = document.getElementsByClassName("clrBtn");
        for(i=0; i<activeState.length; i++){
            activeState[i].classList.remove('active');
        }
        y.classList.add('active');
        
        var clr = $(y).data('clr');
        $('#reminderColor').val(clr);
    }
    
    function EditColorPicker(x,y){
        var val= y.innerHTML;
        
        // document.getElementById('selectedBox').style.backgroundColor=x;
        // document.getElementById('selectedBox').innerHTML=val;
        // document.getElementById('textColor').style.color=x;
        // document.getElementById('textColor').innerHTML=x.toUpperCase();

        /**/
        var activeState = document.getElementsByClassName("clrBtn");
        for(i=0; i<activeState.length; i++){
            activeState[i].classList.remove('active');
        }
        y.classList.add('active');
        
        var clr = $(y).data('clr');
        var rmId = $(y).data('id');
        $('#reminderColor'+rmId).val(clr);
    }
        
    $(document).ready(function(){
        $('.deleteReminder').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var reminderId = $(this).data('id');

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

                    var postingUrl = base_url+'/deleteReminder';
                    $.post(postingUrl, 
                    {
                        reminderId: reminderId
                    },
                    function(data, status){
                        window.location.href=base_url+"/reminder";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
    });
</script>   


<?= $this->endSection(); ?>