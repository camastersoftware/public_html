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
    						    <a class="nav-link active" data-toggle="tab" href="#data_bank_tab" role="tab">
    						        <span class="hidden-xs-down ml-15"><span class="tabs_title">Data Bank</span></span>
    						    </a> 
    						</li>
    						<li class="nav-item nav_tab_2"> 
    						    <a class="nav-link" data-toggle="tab" href="#data_bank_nt_inst_tab" role="tab">
    						        <span class="hidden-xs-down ml-15"><span class="tabs_title">Not Interested</span></span>
    						    </a> 
    					    </li>
    					</ul>
    					-->
                        <div class="text-right flex-grow">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addDataBank">
                                <button class="btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('superadmin/home'); ?>"><button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button></a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs_hd nav-fill" role="tablist">
    						<li class="nav-item nav_tab_1"> 
    						    <a class="nav-link nav-link_hd active" data-toggle="tab" href="#data_bank_tab" role="tab">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title font-weight-bold">
    						               <p class="title_p">Data Bank</p> 
    						            </span>
    						        </span>
    						    </a> 
    						</li>
    						<li class="nav-item nav_tab_2"> 
    						    <a class="nav-link nav-link_hd" data-toggle="tab" href="#data_bank_nt_inst_tab" role="tab">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title font-weight-bold">
    						                <p class="title_p">Not Interested</p> 
    						            </span>
    						        </span>
    						    </a> 
    					    </li>
    					</ul>
    					<!-- Tab panes -->
    					<div class="tab-content tabcontent-border">
    						<div class="tab-pane active" id="data_bank_tab" role="tabpanel">
    							<div class="p-15">
                                    <div class="table-responsive">
                                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">SN</th>
                                                    <th width="20%">Name</th>
                                                    <th>Email&nbsp;Address</th>
                                                    <th>Contact&nbsp;No</th>
                                                    <th width="10%">Contacted&nbsp;On</th>
                                                    <th width="10%">Follow&nbsp;up&nbsp;On</th>
                                                    <!--<th width="10%">Remark</th>-->
                                                    <th width="10%">Demo</th>
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($dataBankArr)): ?>
                                                    <?php $i=1; ?>
                                                    <?php foreach($dataBankArr AS $e_row): ?>
                                                        <?php if($e_row['isDemo']!=1 && $e_row['isDemo']!=3): ?>
                                                            <tr>
                                                    			<td class="text-center"><?php echo $i; ?></td>
                                                    			<td nowrap><?php echo $e_row['data_bank_name']; ?></td>
                                                    		    <td><?php echo $e_row['data_bank_email']; ?></td>
                                                    			<td class="text-center"><?php echo $e_row['data_bank_contact']; ?></td>
                                                    			<td class="text-center">
                                                    			    <?php
                                                    			        if($e_row['data_bank_contacted_on']!="" && $e_row['data_bank_contacted_on']!="1970-01-01"  && $e_row['data_bank_contacted_on']!="0000-00-00")
                                                    			            $data_bank_contacted_on=date('Y-m-d', strtotime($e_row['data_bank_contacted_on']));
                                                    			        else
                                                    			            $data_bank_contacted_on="";
                                                    			            
                                                    			        if(!empty($data_bank_contacted_on))
                                                    			            echo date('d-m-Y', strtotime($data_bank_contacted_on));
                                                    			        else
                                                    			            echo "---";
                                                    			    ?>
                                                    			</td>
                                                    			<td class="text-center">
                                                    			    <?php
                                                    			        if($e_row['data_bank_follow_up_on']!="" && $e_row['data_bank_follow_up_on']!="1970-01-01"  && $e_row['data_bank_follow_up_on']!="0000-00-00")
                                                    			            $data_bank_follow_up_on=date('Y-m-d', strtotime($e_row['data_bank_follow_up_on']));
                                                    			        else
                                                    			            $data_bank_follow_up_on="";
                                                    			            
                                                    			        if(!empty($data_bank_follow_up_on))
                                                    			            echo date('d-m-Y', strtotime($data_bank_follow_up_on));
                                                    			        else
                                                    			            echo "---";
                                                    			    ?>
                                                    			</td>
                                                    			<!--<td class="text-center">-->
                                                    			    <?php 
                                                    			     //   if(!empty($e_row['data_bank_remark']))
                                                    			     //       echo $e_row['data_bank_remark'];
                                                    			     //   else
                                                    			     //       echo "N/A";   
                                                    			    ?>
                                                    			<!--</td>-->
                                                    			<td class="text-center">
                                                    			    <?php
                                                    			        if($e_row['isDemo']==1)
                                                    			            echo "Interested";
                                                    			        elseif($e_row['isDemo']==2)
                                                    			            echo  "Later On";
                                                    			        elseif($e_row['isDemo']==3)
                                                    			            echo "Not Interested";
                                                    			        else
                                                    			            echo "---";
                                                    			    ?>
                                                    			</td>
                                                    			<td class="text-center">
                                                    			    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateDataBank<?php echo $e_row['data_bank_id']; ?>">Edit</a>
                                                                            <a class="dropdown-item deleteDataBank" href="javascript:void(0);" data-id="<?php echo $e_row['data_bank_id']; ?>">Delete</a>
                                                                        </div>
                                                                    </div>
                                                    			</td>
                                                    		</tr>
                                                    		<?php $i++; ?>
                                                		<?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="10"><center>No records</center></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="data_bank_nt_inst_tab" role="tabpanel">
    							<div class="p-15">
                                    <div class="table-responsive">
                                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">SN</th>
                                                    <th width="20%">Name</th>
                                                    <th>Email&nbsp;Address</th>
                                                    <th>Contact&nbsp;No</th>
                                                    <th width="10%">Contacted&nbsp;On</th>
                                                    <th width="10%">Follow&nbsp;up&nbsp;On</th>
                                                    <!--<th width="10%">Remark</th>-->
                                                    <th width="10%">Demo</th>
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($dataBankArr)): ?>
                                                    <?php $i=1; ?>
                                                    <?php foreach($dataBankArr AS $e_row): ?>
                                                        <?php if($e_row['isDemo']==3): ?>
                                                            <tr>
                                                    			<td class="text-center"><?php echo $i; ?></td>
                                                    			<td nowrap><?php echo $e_row['data_bank_name']; ?></td>
                                                    		    <td><?php echo $e_row['data_bank_email']; ?></td>
                                                    			<td class="text-center"><?php echo $e_row['data_bank_contact']; ?></td>
                                                    			<td class="text-center">
                                                    			    <?php
                                                    			        if($e_row['data_bank_contacted_on']!="" && $e_row['data_bank_contacted_on']!="1970-01-01"  && $e_row['data_bank_contacted_on']!="0000-00-00")
                                                    			            $data_bank_contacted_on=date('Y-m-d', strtotime($e_row['data_bank_contacted_on']));
                                                    			        else
                                                    			            $data_bank_contacted_on="";
                                                    			            
                                                    			        if(!empty($data_bank_contacted_on))
                                                    			            echo date('d-m-Y', strtotime($data_bank_contacted_on));
                                                    			        else
                                                    			            echo "---";
                                                    			    ?>
                                                    			</td>
                                                    			<td class="text-center">
                                                    			    <?php
                                                    			        if($e_row['data_bank_follow_up_on']!="" && $e_row['data_bank_follow_up_on']!="1970-01-01"  && $e_row['data_bank_follow_up_on']!="0000-00-00")
                                                    			            $data_bank_follow_up_on=date('Y-m-d', strtotime($e_row['data_bank_follow_up_on']));
                                                    			        else
                                                    			            $data_bank_follow_up_on="";
                                                    			            
                                                    			        if(!empty($data_bank_follow_up_on))
                                                    			            echo date('d-m-Y', strtotime($data_bank_follow_up_on));
                                                    			        else
                                                    			            echo "---";
                                                    			    ?>
                                                    			</td>
                                                    			<!--<td class="text-center">-->
                                                    			    <?php 
                                                    			     //   if(!empty($e_row['data_bank_remark']))
                                                    			     //       echo $e_row['data_bank_remark'];
                                                    			     //   else
                                                    			     //       echo "N/A";   
                                                    			    ?>
                                                    			<!--</td>-->
                                                    			<td class="text-center">
                                                    			    <?php
                                                    			        if($e_row['isDemo']==1)
                                                    			            echo "Interested";
                                                    			        elseif($e_row['isDemo']==2)
                                                    			            echo  "Later On";
                                                    			        elseif($e_row['isDemo']==3)
                                                    			            echo "Not Interested";
                                                    			        else
                                                    			            echo "---";
                                                    			    ?>
                                                    			</td>
                                                    			<td class="text-center">
                                                    			    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateDataBank<?php echo $e_row['data_bank_id']; ?>">Edit</a>
                                                                            <a class="dropdown-item deleteDataBank" href="javascript:void(0);" data-id="<?php echo $e_row['data_bank_id']; ?>">Delete</a>
                                                                        </div>
                                                                    </div>
                                                    			</td>
                                                    		</tr>
                                                    		<?php $i++; ?>
                                                		<?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="10"><center>No records</center></td>
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

    <?php if(!empty($dataBankArr)): ?>
        <?php foreach($dataBankArr AS $e_row): ?>
        
            <?php
                if($e_row['data_bank_contacted_on']!="" && $e_row['data_bank_contacted_on']!="1970-01-01"  && $e_row['data_bank_contacted_on']!="0000-00-00")
		            $data_bank_contacted_on=date('Y-m-d', strtotime($e_row['data_bank_contacted_on']));
		        else
		            $data_bank_contacted_on="";
		            
		        if($e_row['data_bank_follow_up_on']!="" && $e_row['data_bank_follow_up_on']!="1970-01-01"  && $e_row['data_bank_follow_up_on']!="0000-00-00")
		            $data_bank_follow_up_on=date('Y-m-d', strtotime($e_row['data_bank_follow_up_on']));
		        else
		            $data_bank_follow_up_on="";
		            
		        if($e_row['data_bank_demo_req_on']!="" && $e_row['data_bank_demo_req_on']!="1970-01-01"  && $e_row['data_bank_demo_req_on']!="0000-00-00")
		            $data_bank_demo_req_on=date('Y-m-d', strtotime($e_row['data_bank_demo_req_on']));
		        else
		            $data_bank_demo_req_on="";
            ?>
            <!-- Modal -->
            <div id="updateDataBank<?php echo $e_row['data_bank_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="<?php echo base_url('superadmin/dataBank/update'); ?>" method="POST" >
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Edit Data Bank</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Name<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="data_bank_name" id="data_bank_name" placeholder="Name" value="<?php echo $e_row['data_bank_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Contact Number<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="data_bank_contact" id="data_bank_contact" placeholder="Contact Number" value="<?php echo $e_row['data_bank_contact']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Email Address<small class="text-danger">*</small></label>
                                            <input type="email" class="form-control" name="data_bank_email" id="data_bank_email" placeholder="Email Address" value="<?php echo $e_row['data_bank_email']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Contacted On</label>
                                            <input type="date" class="form-control" name="data_bank_contacted_on" id="data_bank_contacted_on" value="<?php echo $data_bank_contacted_on; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Follow-Up No</label>
                                            <input type="date" class="form-control" name="data_bank_follow_up_on" id="data_bank_follow_up_on" value="<?php echo $data_bank_follow_up_on; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Remark</label>
                                            <textarea class="form-control" name="data_bank_remark" id="data_bank_remark" rows="3"><?php echo $e_row['data_bank_remark']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Demo Status <small class="text-danger">*</small></label>
                                                <div class="c-inputs-stacked">
                                                    <input name="isDemo" type="radio" id="isDemo1<?php echo $e_row['data_bank_id']; ?>" value="1" <?php if($e_row['isDemo']==1): ?>checked<?php endif; ?>>
                                                    <label for="isDemo1<?php echo $e_row['data_bank_id']; ?>" class="mr-30">Interested</label>
                                                    <input name="isDemo" type="radio" id="isDemo2<?php echo $e_row['data_bank_id']; ?>" value="2" <?php if($e_row['isDemo']==2): ?>checked<?php endif; ?> >
                                                    <label for="isDemo2<?php echo $e_row['data_bank_id']; ?>" class="mr-30">Later On</label>
                                                    <input name="isDemo" type="radio" id="isDemo3<?php echo $e_row['data_bank_id']; ?>" value="3" <?php if($e_row['isDemo']==3): ?>checked<?php endif; ?> >
                                                    <label for="isDemo3<?php echo $e_row['data_bank_id']; ?>" class="mr-30">Not Interested</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-6 col-lg-6">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label>Demo Request On</label>-->
                                    <!--        <input type="date" class="form-control" name="data_bank_demo_req_on" id="data_bank_demo_req_on" value="<?php //echo $data_bank_demo_req_on; ?>">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                            <div class="modal-footer text-right" style="width: 100%;">
                                <input type="hidden"  name="data_bank_id" id="data_bank_id" value="<?php echo $e_row['data_bank_id']; ?>" >
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

    <!-- Modal -->
    <div id="addDataBank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo base_url('superadmin/dataBank/add'); ?>" method="POST" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Data Bank</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Name<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="data_bank_name" id="data_bank_name" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Contact Number<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="data_bank_contact" id="data_bank_contact" placeholder="Contact Number" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Email Address<small class="text-danger">*</small></label>
                                    <input type="email" class="form-control" name="data_bank_email" id="data_bank_email" placeholder="Email Address" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
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
    
<script>
    $(document).ready(function(){
        $('.deleteDataBank').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var data_bank_id = $(this).data('id');

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

                    var postingUrl = base_url+'/superadmin/dataBank/delete';
                    $.post(postingUrl, 
                    {
                        data_bank_id: data_bank_id
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/dataBank";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
    });
</script>   


<?= $this->endSection(); ?>