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
        
        .nav_tab_1{
            padding-right: 20px !important;
        }
        
        .nav_tab_2{
            border-left: 3px solid #fff !important;
        }
        
        .nav_tab_1, .nav_tab_2{
            width: 10px !important;
        }
        
        /*table.dataTable{*/
        /*    margin-top: -20px !important;*/
        /*}*/
        
        .year-color {
            color: #303030 !important;
            font-weight: bold !important;
        }
        
        .title_p{
            margin-top: -24px !important;
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
        .violet{
            background-color: #f38bf5 !important;
        } 
        .green{
            background-color: #37fa1f !important;
        } 
        
        #DataTables_Table_0_filter{
            margin-top: -60px !important;
        }
        
        #DataTables_Table_1_filter{
            margin-top: -60px !important;
        }
        
        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: -17.5em !important;
            display: inline-block;
            width: auto;
            z-index: 99 !important;
            position: absolute !important;
            height: 40px !important;
            margin-top: -6px !important;
        }
        
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
        
        .tabcontent-border {
            border: none !important;
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
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addTDList">
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
                        <ul class="nav nav-tabs nav-tabs_hd nav-fill ml-15">
    						<li class="nav-item nav_tab_1"> 
    						    <a class="nav-link nav-link_hd" href="<?php echo base_url('todolist'); ?>">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title font-weight-bold">
    						                <p class="title_p">My To Do List</p> 
    						            </span>
    						        </span>
    						    </a> 
    						</li>
    						<li class="nav-item nav_tab_2"> 
    						    <a class="nav-link nav-link_hd active" href="<?php echo base_url('assignByMeList'); ?>">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title font-weight-bold">
    						                <p class="title_p">Assigned By Me</p> 
    						            </span>
    						        </span>
    						    </a> 
    					    </li>
    					</ul>
                        <div class="tab-content tabcontent-border pl-15 pr-15 pb-15">
                            <div class="tab-pane fade" id="td_list_for_me" role="tabpanel"></div>
                            <div class="tab-pane fade active show" id="td_list_by_me" role="tabpanel">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 col-md-6 col-sm-12 col-xs-12"></div>
                                            <div class="col-md-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-3 col-md-3 col-sm-3 col-xs-3 text-center"></div>
                                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                        <?php if(!empty($listByMeArr)): ?>
                                                            <select class="form-control select2" name="byMeUserId" id="byMeUserId" onchange="searchStaffByMe(this);" style="width:100%;margin-top: 4px;" required>
                                                                <option value="">Assigned To</option>
                                                                <?php if(!empty($getUserList)): ?>
                                                                    <?php foreach($getUserList AS $e_u): ?>
                                                                        <option value="<?= $e_u['userId']; ?>" <?php if($byMeUserId==$e_u['userId']): ?>selected<?php endif; ?> ><?= $e_u['userFullName']; ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select> 
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-md-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>
                                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <!--
                                            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                                <?php //for($m_no=1;$m_no<13;$m_no++): ?>
                                                <?php
                                                    // if($m_no<=9)
                                                    //     $m=$m_no+3;
                                                    // else
                                                    //     $m=$m_no-9;
                                                ?>
                                                <?php //$mth_nm=strtolower(date('M', strtotime("2021-".$m."-1"))); ?>
                                                <li class="nav-item"> 
                                                    <a class="nav-link <?php //if($m==$currMth): ?>active<?php //endif; ?>" id="<?php //echo $mth_nm; ?>-tab2" data-toggle="tab" href="#<?php //echo $mth_nm; ?>_tab2" role="tab" aria-controls="profile">
                                                        <span class="hidden-sm-up">
                                                            <i class="ion-person"></i>
                                                        </span> 
                                                        <span class="hidden-xs-down year-color"><?php //echo date('F', strtotime("2021-".$m."-1")); ?></span>
                                                    </a>
                                                </li>	
                                                <?php //endfor; ?>
                                            </ul>
                                            -->
                                            <!--
                                            <div class="tab-content tabcontent-border p-15" id="myTabContent">
                                                <?php //for($mth_no=1;$mth_no<13;$mth_no++): ?>
                                                <?php
                                                    // if($mth_no<=9)
                                                    //     $mth=$mth_no+3;
                                                    // else
                                                    //     $mth=$mth_no-9;
                                                ?>
                                                <?php //$mth_nm=strtolower(date('M', strtotime("2021-".$mth."-1"))); ?>
                                                <div class="tab-pane fade table-responsive <?php //if($mth==$currMth): ?>show active<?php //endif; ?>" id="<?php //echo $mth_nm; ?>_tab2" role="tabpanel" aria-labelledby="<?php //echo $mth_nm; ?>-tab">
                                                    -->
                                                    <table class="sortingOffWithSearchTable2 table table-bordered table-striped" style="width:100%">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="5%">Date</th>
                                                                <th width="5%">Day</th>
                                                                <th width="5%">To</th>
                                                                <th>Nature of Work</th>
                                                                <th width="5%">Status</th>
                                                                <th width="5%">Target&nbsp;Date</th>
                                                                <th width="5%">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(!empty($listByMeArr)): ?>
                                                                <?php $i=1; ?>
                                                                <?php foreach($listByMeArr AS $e_row): ?>
                                                                    <?php //if(strtolower(date("M", strtotime($e_row['tdDate']))) == $mth_nm): ?>
                                                                        <tr style="background-color: <?php echo $e_row['tdPriorityColor']; ?> !important;">
                                                                			<td nowrap class="text-center"><?php echo date("d-m-Y", strtotime($e_row['tdDate'])); ?></td>
                                                                			<td nowrap class="text-center"><?php echo date("D", strtotime($e_row['tdDate'])); ?></td>
                                                                			<td nowrap class="text-center"><?php echo $e_row['userFullName']; ?></td>
                                                                			<td nowrap><?php echo $e_row['tdNatureOfWork']; ?></td>
                                                                			<td nowrap class="text-center">
                                                                			    <?php 
                                                                			        if($e_row['tdStatus']==1)
                                                                			            echo "Pending"; 
                                                                			        elseif($e_row['tdStatus']==2)
                                                                			            echo "In Progress"; 
                                                                			        elseif($e_row['tdStatus']==3)
                                                                			            echo "Completed"; 
                                                                			    ?>
                                                                			</td>
                                                                			<td nowrap class="text-center">
                                                                			    <?php
                                                                			        if(!empty($e_row['tdTargetDate']) && $e_row['tdTargetDate']!="1970-01-01" && $e_row['tdTargetDate']!="0000-00-00")
                                                                			            echo date("d-m-Y", strtotime($e_row['tdTargetDate'])); 
                                                                			        else
                                                                			            echo "---";
                                                                			    ?>
                                                                			</td>
                                                                			<td class="text-center">
                                                                			    
                                                                			    <div class="btn-group">
                                                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateTDListByeMe<?php echo $e_row['tdId']; ?>">Edit</a>
                                                                                        <a class="dropdown-item deleteTDList" href="javascript:void(0);" data-id="<?php echo $e_row['tdId']; ?>">Delete</a>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                			</td>
                                                                		</tr>
                                                            		    <?php $i++; ?>
                                                            	    <?php //endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <tr>
                                                                    <td colspan="7"><center>No records</center></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                <!--
                                                </div>
                                                <?php //endfor; ?>
                                            </div>
                                            -->
                                        </div>
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
    
    <?php if(!empty($listToMeArr)): ?>
        <?php foreach($listToMeArr AS $e_row): ?>
        
        <!-- Modal -->
        <div id="updateTDListToMe<?php echo $e_row['tdId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="<?php echo base_url('updateTDListToMe'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Update</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Nature of Work<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="tdNatureOfWork" id="tdNatureOfWork" placeholder="Enter Nature of Work" value="<?= $e_row['tdNatureOfWork']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="tdRemark" id="tdRemark" placeholder="Enter Remarks" disabled><?= $e_row['tdRemark']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Comments</label>
                                        <textarea class="form-control" name="tdComments" id="tdComments" placeholder="Enter Comments"><?php echo $e_row['tdComments']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Status<small class="text-danger">*</small></label>
                                        <select class="custom-select form-control" name="tdStatus" id="tdStatus" required>
                                            <option value="">Select</option>
                                            <option value="1" <?php if($e_row['tdStatus']==1): ?>selected<?php endif; ?>>Pending</option>
                                            <option value="2" <?php if($e_row['tdStatus']==2): ?>selected<?php endif; ?>>In Progress</option>
                                            <option value="3" <?php if($e_row['tdStatus']==3): ?>selected<?php endif; ?>>Completed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Target Date</label>
                                        <input type="date" class="form-control" name="tdTargetDate" id="tdTargetDate" min="<?//= date('Y-m-d'); ?>" value="<?= $e_row['tdTargetDate']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="tdId" value="<?php echo $e_row['tdId']; ?>">
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
    
    <?php if(!empty($listByMeArr)): ?>
        <?php foreach($listByMeArr AS $e_row): ?>
        
        <!-- Modal -->
        <div id="updateTDListByeMe<?php echo $e_row['tdId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="<?php echo base_url('updateTDListByeMe'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Nature of Work<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="tdNatureOfWork" id="tdNatureOfWork" placeholder="Enter Nature of Work" value="<?= $e_row['tdNatureOfWork']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="tdRemark" id="tdRemark" placeholder="Enter Remarks"><?= $e_row['tdRemark']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Comments</label>
                                        <textarea class="form-control" name="tdComments" id="tdComments" placeholder="Enter Comments" disabled><?php echo $e_row['tdComments']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Alloted To<small class="text-danger">*</small></label>
                                        <select class="custom-select form-control" name="tdAllotedTo" id="tdAllotedTo" required>
                                            <option value="">Select</option>
                                            <?php if(!empty($getUserList)): ?>
                                                <?php foreach($getUserList AS $e_user): ?>
                                                    <option value="<?= $e_user['userId']; ?>" <?php if($e_row['tdAllotedTo']==$e_user['userId']): ?>selected<?php endif; ?>><?= $e_user['userFullName']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Select Prority<small class="text-danger">*</small></label>
                                        <div class="grid-Wrapper">
                                            <button type="button" class="clrBtn none <?php if($e_row['tdPriority']==1): ?>active<?php endif; ?>" data-clr="none" data-id="<?php echo $e_row['tdId']; ?>" onclick="EditColorPicker(1,'none',this);">
                                                <span>Low</span>
                                            </button>
                                            <button type="button" class="clrBtn yellow <?php if($e_row['tdPriority']==2): ?>active<?php endif; ?>" data-clr="#f0f58b7d" data-id="<?php echo $e_row['tdId']; ?>" onclick="EditColorPicker(2,'#f0f58b7d',this);">
                                                <span>Medium</span>
                                            </button>
                                            <button type="button" class="clrBtn red <?php if($e_row['tdPriority']==3): ?>active<?php endif; ?>" data-clr="pink" data-id="<?php echo $e_row['tdId']; ?>" onclick="EditColorPicker(3,'pink',this);">
                                                <span>High</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Target Date</label>
                                        <input type="date" class="form-control" name="tdTargetDate" id="tdTargetDate" min="<?//= date('Y-m-d'); ?>" value="<?= $e_row['tdTargetDate']; ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="tdId" value="<?php echo $e_row['tdId']; ?>">
                            <input type="hidden" name="tdPriority" id="tdPriority<?php echo $e_row['tdId']; ?>" value="<?php echo $e_row['tdPriority']; ?>" />
                            <input type="hidden" name="tdPriorityColor" id="tdPriorityColor<?php echo $e_row['tdId']; ?>" value="<?php echo $e_row['tdPriorityColor']; ?>" />
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
    <div id="addTDList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo base_url('addTDList'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add New</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Nature of Work<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="tdNatureOfWork" id="tdNatureOfWork" placeholder="Enter Nature of Work" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name="tdRemark" id="tdRemark" placeholder="Enter Remarks"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Alloted To<small class="text-danger">*</small></label>
                                    <select class="custom-select form-control" name="tdAllotedTo" id="tdAllotedTo" required>
                                        <option value="">Select</option>
                                        <?php if(!empty($getUserList)): ?>
                                            <?php foreach($getUserList AS $e_user): ?>
                                                <option value="<?= $e_user['userId']; ?>" ><?= $e_user['userFullName']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Select Prority<small class="text-danger">*</small></label>
                                    <div class="grid-Wrapper">
                                        <button type="button" class="clrBtn none active" data-clr="none" onclick="ColorPicker(1,'none',this);">
                                            <span>Low</span>
                                        </button>
                                        <button type="button" class="clrBtn yellow" data-clr="#f0f58b7d" onclick="ColorPicker(2,'#f0f58b7d',this);">
                                            <span>Medium</span>
                                        </button>
                                        <button type="button" class="clrBtn red" data-clr="pink" onclick="ColorPicker(3,'pink',this);">
                                            <span>High</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Target Date</label>
                                    <input type="date" class="form-control" name="tdTargetDate" id="tdTargetDate" min="<?= date('Y-m-d'); ?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="tdRedirectTo" value="assignByMe" />
                        <input type="hidden" name="tdPriority" id="tdPriority" value="1" />
                        <input type="hidden" name="tdPriorityColor" id="tdPriorityColor" value="none" />
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
    var valId,x,y,i;
    
    function ColorPicker(valId,x,y){
        var val= y.innerHTML;
        
        var activeState = document.getElementsByClassName("clrBtn");
        console.log(activeState);
        for(i=0; i<activeState.length; i++){
            // console.log(activeState)+1;
            activeState[i].classList.remove('active');
        }
        y.classList.add('active');
        
        var clr = $(y).data('clr');
        $('#tdPriorityColor').val(clr);
        $('#tdPriority').val(valId);
       
    }
    
    function EditColorPicker(valId,x,y){
        var val= y.innerHTML;
        
        var activeState = document.getElementsByClassName("clrBtn");
        console.log(activeState);
        for(i=0; i<activeState.length; i++){
            // console.log(activeState)+1;
            activeState[i].classList.remove('active');
        }
        y.classList.add('active');
        
        var clr = $(y).data('clr');
        var tdId = $(y).data('id');
        $('#tdPriorityColor'+tdId).val(clr);
        $('#tdPriority'+tdId).val(valId);
       
    }
        
    $(document).ready(function(){
        $('.deleteTDList').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var tdId = $(this).data('id');

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

                    var postingUrl = base_url+'/deleteTDList';
                    $.post(postingUrl, 
                    {
                        tdId: tdId
                    },
                    function(data, status){
                        window.location.href=base_url+"/assignByMeList";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
        
        setTimeout(function () {
            $('div.dataTables_filter input').attr('placeholder', "Search Name");
            
            $('.dt-buttons.btn-group').remove();
        }, 100);
        
        if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
            
        }else{
            $('.table-responsive').addClass('mt-20');
        }
    });
</script>

<script type="text/javascript">
    
    var base_url = "<?= base_url(); ?>";
    var toMeUserId = $('#toMeUserId option:selected').val();
    var byMeUserId = $('#byMeUserId option:selected').val();
    
    console.log('toMeUserId', typeof toMeUserId);
    
    if(typeof toMeUserId!="undefined")
        toMeUserId=toMeUserId;
    else
        toMeUserId="";
        
    if(typeof byMeUserId!="undefined")
        byMeUserId=byMeUserId;
    else
        byMeUserId="";
    
    function searchStaffToMe($this)
    {
        var userId=$this.value;
        
        window.location.href=base_url+"/todolist?toMeUserId="+userId;
    }
    
    function searchStaffByMe($this)
    {
        var userId=$this.value;
        
        window.location.href=base_url+"/assignByMeList?byMeUserId="+userId;
    }

</script>


<?= $this->endSection(); ?>