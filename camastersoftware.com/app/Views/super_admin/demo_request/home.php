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
        
        
        .theme-primary .nav-tabs .nav-link.active {
            border-bottom-color: #E79F34 !important;
            background-color: transparent !important;
            color: #fff !important;
        }
        
        .nav-tabs .nav-link {
            color: #fff !important;
            background-color: transparent !important;
            padding: 0px !important;
            border: none !important;
        }
        
        /*.tabs_title{*/
        /*    font-size: 14px !important;*/
        /*    font-weight: 800 !important;*/
        /*}*/
        
        .nav-tabs{
            border-bottom: none !important;
        }
        
        .nav_tab_1{
            padding-right: 20px !important;
        }
        
        .nav_tab_2{
            border-left: 3px solid #fff !important;
        }
        
        .theme-primary .nav-tabs .nav-link_hd.active {
            border-bottom-color: #f99d27 !important;
            background-color: #f99d27 !important;
            color: #fff !important;
        }
        
        .theme-primary .nav-tabs .nav-link_hd {
            background-color: #005495 !important;
            border: 1px solid #aaa;
            border-radius: 7px !important;
            color: #fff !important;
            height: 40px !important;
        }
        
        .nav-tabs .nav-link_hd {
            color: #fff !important;
            background-color: #005495 !important;
            padding: 0px !important;
            border: none !important;
        }
        
        .tabs_title{
            /*font-size: 14px !important;*/
            /*font-weight: 800 !important;*/
            color: #fff !important;
            line-height: 28px;
            font-weight: 700 !important;
            font-size: 17.2px !important;
        }
        
        .nav-tabs_hd{
            border-bottom: none !important;
            width: 29%;
        }
        
        .nav_tab_1, .nav_tab_2{
            width: 10px !important;
        }
        
        .title_p{
            margin-top: -24px !important;
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
                        <!--
                        <ul class="nav nav-tabs nav-fill" role="tablist">
    						<li class="nav-item nav_tab_1"> 
    						    <a class="nav-link active" data-toggle="tab" href="#demo_req_tab" role="tab">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title">
    						                <?php
                                                // if(isset($pageTitle))
                                                //     echo $pageTitle;
                                                // else
                                                //     echo "N/A";
                                            ?>
    						            </span>
    						        </span>
    						    </a> 
    						</li>
    						<li class="nav-item nav_tab_2"> 
    						    <a class="nav-link" data-toggle="tab" href="#demo_req_not_tab" role="tab">
    						        <span class="hidden-xs-down ml-15"><span class="tabs_title">Not Interested</span></span>
    						    </a> 
    					    </li>
    					</ul>
    					->>
                        <!--<h4 class="box-title font-weight-bold">-->
                            <?php
                                // if(isset($pageTitle))
                                //     echo $pageTitle;
                                // else
                                //     echo "N/A";
                            ?>
                        <!--</h4>-->
                        <div class="text-right flex-grow">
                            <a href="<?php echo base_url('superadmin/home'); ?>"><button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button></a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs_hd nav-fill" role="tablist">
    						<li class="nav-item nav_tab_1"> 
    						    <a class="nav-link nav-link_hd active" data-toggle="tab" href="#demo_req_tab" role="tab">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title font-weight-bold">
    						               <p class="title_p">Demo Requests</p> 
    						            </span>
    						        </span>
    						    </a> 
    						</li>
    						<li class="nav-item nav_tab_2"> 
    						    <a class="nav-link nav-link_hd" data-toggle="tab" href="#demo_req_not_tab" role="tab">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title font-weight-bold">
    						                <p class="title_p">Not Interested</p> 
    						            </span>
    						        </span>
    						    </a> 
    					    </li>
    					</ul>
                        <div class="tab-content tabcontent-border">
    						<div class="tab-pane active" id="demo_req_tab" role="tabpanel">
    							<div class="p-15">
                                    <div class="table-responsive">
                                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">SN</th>
                                                    <th width="15%">Date</th>
                                                    <th width="20%">Name</th>
                                                    <th>Email&nbsp;Address</th>
                                                    <th>Mobile&nbsp;No</th>
                                                    <th width="10%">Demo&nbsp;Date</th>
                                                    <th width="10%">Demo&nbsp;By</th>
                                                    <!--<th width="10%">Remark</th>-->
                                                    <th width="10%">License&nbsp;No</th>
                                                    <!--<th width="7%">Replied</th>-->
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($demoReqList)): ?>
                                                    <?php $i=1; ?>
                                                    <?php foreach($demoReqList AS $e_row): ?>
                                                        <?php if($e_row['demoReqStatus']!=3): ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $i; ?></td>
                                                                <td class="text-center wh_space_nowrp"><?php echo date('d-m-Y', strtotime($e_row['demoReqDateTime'])); ?></td>
                                                                <td nowrap><?php echo $e_row['demoReqName']; ?></td>
                                                                <td><?php echo $e_row['demoReqEmail']!="" ? $e_row['demoReqEmail']:"N/A"; ?></td>
                                                                <td class="text-center"><?php echo $e_row['demoReqMobile']; ?></td>
                                                                <td class="text-center">
                                                                    <?php
                                                    			        if($e_row['demoDate']!="" && $e_row['demoDate']!="1970-01-01"  && $e_row['demoDate']!="0000-00-00")
                                                    			            $demoDate=date('Y-m-d', strtotime($e_row['demoDate']));
                                                    			        else
                                                    			            $demoDate="";
                                                    			            
                                                    			        if(!empty($demoDate))
                                                    			            echo date('d-m-Y', strtotime($demoDate));
                                                    			        else
                                                    			            echo "---";
                                                    			    ?>
                                                                </td>
                                                                <td class="text-center"><?php echo $e_row['demoBy']; ?></td>
                                                                <!--<td class="text-center"><?php //echo $e_row['demoRemark']; ?></td>-->
                                                                <td class="text-center"><?php echo $e_row['demoLicense']; ?></td>
                                                                <!--<td class="text-center"><?php //echo $e_row['isReplied']=="1" ? "Yes":"No"; ?></td>-->
                                                                <td class="text-center">
                                                                    
                                                                    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateDemo<?php echo $e_row['demoReqId']; ?>">Edit</a>
                                                                            <?php //if($e_row['isReplied']==2): ?>
                                                                                <!--<a class="dropdown-item replyDemo" href="javascript:void(0);" data-id="<?php //echo $e_row['demoReqId']; ?>">Reply</a>-->
                                                                            <?php //endif; ?>
                                                                            <a class="dropdown-item deleteDemo" href="javascript:void(0);" data-id="<?php echo $e_row['demoReqId']; ?>">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="9"><center>No records</center></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="demo_req_not_tab" role="tabpanel">
                                <div class="p-15">
                                    <div class="table-responsive">
                                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">SN</th>
                                                    <th width="15%">Date</th>
                                                    <th width="20%">Name</th>
                                                    <th>Email&nbsp;Address</th>
                                                    <th>Mobile&nbsp;No</th>
                                                    <th width="10%">Demo&nbsp;Date</th>
                                                    <th width="10%">Demo&nbsp;By</th>
                                                    <!--<th width="10%">Remark</th>-->
                                                    <th width="10%">License&nbsp;No</th>
                                                    <!--<th width="7%">Replied</th>-->
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($demoReqList)): ?>
                                                    <?php $i=1; ?>
                                                    <?php foreach($demoReqList AS $e_row): ?>
                                                        <?php if($e_row['demoReqStatus']==3): ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $i; ?></td>
                                                                <td class="text-center wh_space_nowrp"><?php echo date('d-m-Y', strtotime($e_row['demoReqDateTime'])); ?></td>
                                                                <td nowrap><?php echo $e_row['demoReqName']; ?></td>
                                                                <td><?php echo $e_row['demoReqEmail']!="" ? $e_row['demoReqEmail']:"N/A"; ?></td>
                                                                <td class="text-center"><?php echo $e_row['demoReqMobile']; ?></td>
                                                                <td class="text-center">
                                                                    <?php
                                                    			        if($e_row['demoDate']!="" && $e_row['demoDate']!="1970-01-01"  && $e_row['demoDate']!="0000-00-00")
                                                    			            $demoDate=date('Y-m-d', strtotime($e_row['demoDate']));
                                                    			        else
                                                    			            $demoDate="";
                                                    			            
                                                    			        if(!empty($demoDate))
                                                    			            echo date('d-m-Y', strtotime($demoDate));
                                                    			        else
                                                    			            echo "---";
                                                    			    ?>
                                                                </td>
                                                                <td class="text-center"><?php echo $e_row['demoBy']; ?></td>
                                                                <!--<td class="text-center"><?php //echo $e_row['demoRemark']; ?></td>-->
                                                                <td class="text-center"><?php echo $e_row['demoLicense']; ?></td>
                                                                <!--<td class="text-center"><?php //echo $e_row['isReplied']=="1" ? "Yes":"No"; ?></td>-->
                                                                <td class="text-center">
                                                                    
                                                                    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateDemo<?php echo $e_row['demoReqId']; ?>">Edit</a>
                                                                            <?php //if($e_row['isReplied']==2): ?>
                                                                                <!--<a class="dropdown-item replyDemo" href="javascript:void(0);" data-id="<?php //echo $e_row['demoReqId']; ?>">Reply</a>-->
                                                                            <?php //endif; ?>
                                                                            <a class="dropdown-item deleteDemo" href="javascript:void(0);" data-id="<?php echo $e_row['demoReqId']; ?>">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="9"><center>No records</center></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
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
    
    <?php if(!empty($demoReqList)): ?>
        <?php foreach($demoReqList AS $e_row): ?>
            
            <?php
		        if($e_row['demoDate']!="" && $e_row['demoDate']!="1970-01-01"  && $e_row['demoDate']!="0000-00-00")
		            $demoDate=date('Y-m-d', strtotime($e_row['demoDate']));
		        else
		            $demoDate="";
		    ?>
            <!-- Modal -->
            <div id="updateDemo<?php echo $e_row['demoReqId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="<?php echo base_url('superadmin/updateDemo'); ?>" method="POST" >
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Edit Demo Request</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Name<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="demoReqName" id="demoReqName" placeholder="Name" value="<?php echo $e_row['demoReqName']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Email Address<small class="text-danger">*</small></label>
                                            <input type="email" class="form-control" name="demoReqEmail" id="demoReqEmail" placeholder="Email Address" value="<?php echo $e_row['demoReqEmail']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Contact No<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="demoReqMobile" id="demoReqMobile" value="<?php echo $e_row['demoReqMobile']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Demo Date</label>
                                            <input type="date" class="form-control" name="demoDate" id="demoDate" value="<?php echo $demoDate; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Demo By<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="demoBy" id="demoBy" value="<?php echo $e_row['demoBy']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>License</label>
                                            <input type="text" class="form-control" name="demoLicense" id="demoLicense" value="<?php echo $e_row['demoLicense']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Demo Request Status <small class="text-danger">*</small></label>
                                                <div class="c-inputs-stacked">
                                                    <input name="demoReqStatus" type="radio" id="demoReqStatus1<?php echo $e_row['demoReqId']; ?>" value="1" <?php if($e_row['demoReqStatus']==1): ?>checked<?php endif; ?>>
                                                    <label for="demoReqStatus1<?php echo $e_row['demoReqId']; ?>" class="mr-30">Interested</label>
                                                    <input name="demoReqStatus" type="radio" id="demoReqStatus2<?php echo $e_row['demoReqId']; ?>" value="2" <?php if($e_row['demoReqStatus']==2): ?>checked<?php endif; ?> >
                                                    <label for="demoReqStatus2<?php echo $e_row['demoReqId']; ?>" class="mr-30">Later On</label>
                                                    <input name="demoReqStatus" type="radio" id="demoReqStatus3<?php echo $e_row['demoReqId']; ?>" value="3" <?php if($e_row['demoReqStatus']==3): ?>checked<?php endif; ?> >
                                                    <label for="demoReqStatus3<?php echo $e_row['demoReqId']; ?>" class="mr-30">Not Interested</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Remark</label>
                                            <textarea class="form-control" name="demoRemark" id="demoRemark" rows="3"><?php echo $e_row['demoRemark']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-right" style="width: 100%;">
                                <input type="hidden"  name="demoReqId" id="demoReqId" value="<?php echo $e_row['demoReqId']; ?>" >
                                <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                                <!--<button type="button" class="btn btn-warning text-left" data-dismiss="modal">Reset</button>-->
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
    
    <script>
        $(document).ready(function () {
    
            $('.replyDemo').on('click', function (){
    
                var base_url = "<?php echo base_url(); ?>";
                var demoReqId = $(this).data('id');
    
                swal({
                    title: "Are you sure?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm){
                    if (isConfirm) {
    
                        var postingUrl = base_url+'/superadmin/replyDemo';
                        $.post(postingUrl, 
                        {
                            demoReqId: demoReqId
                        },
                        function(data, status){
                            window.location.href=base_url+"/superadmin/demo_requests";
                        });
    
                    } else {
                        swal("Cancelled", "You cancelled :)", "error");
                    }
                });
    
            });  
            
            
            $('.deleteDemo').on('click', function () {
    
                var base_url = "<?php echo base_url(); ?>";
                var demoReqId = $(this).data('id');
    
                swal({
                    title: "Are you sure?",
                    text: "Do you really want to delete ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm){
                    if (isConfirm) {
    
                        var postingUrl = base_url+'/superadmin/deleteDemo';
                        $.post(postingUrl, 
                        {
                            demoReqId: demoReqId
                        },
                        function(data, status){
                            window.location.href=base_url+"/superadmin/demo_requests";
                        });
    
                    } else {
                        swal("Cancelled", "You cancelled :)", "error");
                    }
                });
    
            });       
    
        });
    </script>

<?= $this->endSection(); ?>