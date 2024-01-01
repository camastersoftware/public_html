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
        
        table.dataTable{
            margin-top: -20px !important;
        }
        
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
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addReminder">
                                <button class="btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <?php for($m_no=1;$m_no<13;$m_no++): ?>
                            <?php
                                if($m_no<=9)
                                    $m=$m_no+3;
                                else
                                    $m=$m_no-9;
                            ?>
                            <?php $mth_nm=strtolower(date('M', strtotime("2021-".$m."-1"))); ?>
                            <li class="nav-item"> 
                                <a class="nav-link <?php if($m==$currMth): ?>active<?php endif; ?>" id="<?php echo $mth_nm; ?>-tab" data-toggle="tab" href="#<?php echo $mth_nm; ?>_tab" role="tab" aria-controls="profile">
                                    <span class="hidden-sm-up">
                                        <i class="ion-person"></i>
                                    </span> 
                                    <span class="hidden-xs-down year-color"><?php echo date('F', strtotime("2021-".$m."-1")); ?></span>
                                </a>
                            </li>	
                            <?php endfor; ?>
                        </ul>
                        <div class="tab-content tabcontent-border p-15" id="myTabContent">
                            <?php for($mth=1;$mth<13;$mth++): ?>
                            <?php $mth_nm=strtolower(date('M', strtotime("2021-".$mth."-1"))); ?>
                                <div class="tab-pane fade table-responsive <?php if($mth==$currMth): ?>show active<?php endif; ?>" id="<?php echo $mth_nm; ?>_tab" role="tabpanel" aria-labelledby="<?php echo $mth_nm; ?>-tab">
                                    <div class="table-responsive">
                                        <table class="onlyTableId table table-bordered table-striped" style="width:100%">
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
                                                <?php if(!empty($reminderArr)): ?>
                                                    <?php $i=1; ?>
                                                    <?php foreach($reminderArr AS $e_row): ?>
                                                        <?php if(date('n', strtotime($e_row['reminderDate']))==$mth): ?>
                                                            <tr style="background-color: <?php echo $e_row['reminderColor']; ?> !important;">
                                                    			<td nowrap class="text-center"><?php echo date("d-m-Y", strtotime($e_row['reminderDate'])); ?></td>
                                                    			<td nowrap class="text-center"><?php echo date("D", strtotime($e_row['reminderDate'])); ?></td>
                                                    			<td nowrap><?php echo $e_row['reminderFor']; ?></td>
                                                    			<td nowrap class="text-center">
                                                    			    <?php 
                                                    			        if(!empty($e_row['reminderFrom']) && $e_row['reminderFrom']!="00:00:00")
                                                    			            echo date("h:i A", strtotime($e_row['reminderFrom'])); 
                                                    			        else
                                                    			            echo "---"; 
                                                    			    ?>
                                                    			</td>
                                                    			<td nowrap class="text-center">
                                                    			    <?php 
                                                    			        if(!empty($e_row['reminderTo']) && $e_row['reminderTo']!="00:00:00")
                                                    			            echo date("h:i A", strtotime($e_row['reminderTo'])); 
                                                    			        else
                                                    			            echo "---"; 
                                                    			    ?>
                                                    			</td>
                                                    			<td class="text-center">
                                                    			    
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
                            <?php endfor; ?>
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
                                        <label>Color<small class="text-danger">*</small></label>
                                        <!--<select class="custom-select form-control" name="reminderColor" id="reminderColor" required>-->
                                        <!--    <option value="">Select</option>-->
                                        <!--    <option value="none" <?php //if($e_row['reminderColor']=="none"): ?>selected<?php //endif; ?> >None</option>-->
                                        <!--    <option value="#f58b8b" <?php //if($e_row['reminderColor']=="#f58b8b"): ?>selected<?php //endif; ?> >Red</option>-->
                                        <!--    <option value="#f0f58b" <?php //if($e_row['reminderColor']=="#f0f58b"): ?>selected<?php //endif; ?> >Yellow</option>-->
                                        <!--    <option value="#f38bf5" <?php //if($e_row['reminderColor']=="#f38bf5"): ?>selected<?php //endif; ?> >Violet</option>-->
                                        <!--    <option value="#37fa1f" <?php //if($e_row['reminderColor']=="#37fa1f"): ?>selected<?php //endif; ?> >Green</option>-->
                                        <!--</select>-->
                                        <div class="grid-Wrapper">
                                            <button type="button" class="clrBtn none <?php if($e_row['reminderColor']=="none"): ?>active<?php endif; ?>" data-clr="none" data-id="<?php echo $e_row['reminderId']; ?>" onclick="EditColorPicker('none',this);"></button>
                                            <button type="button" class="clrBtn red <?php if($e_row['reminderColor']=="#f58b8b"): ?>active<?php endif; ?>" data-clr="#f58b8b" data-id="<?php echo $e_row['reminderId']; ?>" onclick="EditColorPicker('#f58b8b',this);"></button>
                                            <button type="button" class="clrBtn yellow <?php if($e_row['reminderColor']=="#f0f58b"): ?>active<?php endif; ?>" data-clr="#f0f58b" data-id="<?php echo $e_row['reminderId']; ?>" onclick="EditColorPicker('#f0f58b',this);"></button>
                                            <button type="button" class="clrBtn violet <?php if($e_row['reminderColor']=="#f38bf5"): ?>active<?php endif; ?>" data-clr="#f38bf5" data-id="<?php echo $e_row['reminderId']; ?>" onclick="EditColorPicker('#f38bf5',this);"></button>
                                            <button type="button" class="clrBtn green <?php if($e_row['reminderColor']=="#37fa1f"): ?>active<?php endif; ?>" data-clr="#37fa1f" data-id="<?php echo $e_row['reminderId']; ?>" onclick="EditColorPicker('#37fa1f',this);"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="reminderId" id="reminderId" value="<?php echo $e_row['reminderId']; ?>">
                            <input type="hidden" name="reminderColor" id="reminderColor<?php echo $e_row['reminderId']; ?>" value="<?php echo $e_row['reminderColor']; ?>" />
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
                                    <label>Select Color<small class="text-danger">*</small></label>
                                    <!--<select class="custom-select form-control" name="reminderColor" id="reminderColor" required>-->
                                    <!--    <option value="">Select</option>-->
                                    <!--    <option value="none">None</option>-->
                                    <!--    <option value="#f58b8b">Red</option>-->
                                    <!--    <option value="#f0f58b">Yellow</option>-->
                                    <!--    <option value="#f38bf5">Violet</option>-->
                                    <!--    <option value="#37fa1f">Green</option>-->
                                    <!--</select>-->
                                    <div class="grid-Wrapper">
                                        <button type="button" class="clrBtn none" data-clr="none" onclick="ColorPicker('none',this);"></button>
                                        <button type="button" class="clrBtn red active" data-clr="#f58b8b" onclick="ColorPicker('#f58b8b',this);"></button>
                                        <button type="button" class="clrBtn yellow" data-clr="#f0f58b" onclick="ColorPicker('#f0f58b',this);"></button>
                                        <button type="button" class="clrBtn violet" data-clr="#f38bf5" onclick="ColorPicker('#f38bf5',this);"></button>
                                        <button type="button" class="clrBtn green" data-clr="#37fa1f" onclick="ColorPicker('#37fa1f',this);"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="reminderColor" id="reminderColor" value="#f58b8b" />
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
        console.log(activeState);
        for(i=0; i<activeState.length; i++){
            // console.log(activeState)+1;
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
        console.log(activeState);
        for(i=0; i<activeState.length; i++){
            // console.log(activeState)+1;
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