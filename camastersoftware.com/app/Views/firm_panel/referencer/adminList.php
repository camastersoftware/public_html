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
            background-color: #f58b8b69 !important;
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
                            <a href="<?php echo base_url('home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="nav nav-tabs nav-tabs_hd nav-fill ml-15" role="tablist">
    						<li class="nav-item nav_tab_1"> 
    						    <a class="nav-link nav-link_hd" href="<?php echo base_url('referncer'); ?>" role="tab">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title font-weight-bold">
    						               <p class="title_p">My Referencer</p> 
    						            </span>
    						        </span>
    						    </a> 
    						</li>
    						<li class="nav-item nav_tab_2"> 
    						    <a class="nav-link nav-link_hd active" href="<?php echo base_url('adminReferncer'); ?>" role="tab">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title font-weight-bold">
    						                <p class="title_p">CAMaster</p> 
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
                                            <div class="col-md-5 col-md-5 col-sm-12 col-xs-12"></div>
                                            <div class="col-md-7 col-md-7 col-sm-12 col-xs-12">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                        <select class="form-control select2" name="refGroupId" id="refGroupId" onchange="searchGroup(this);" style="width:100%;margin-top: 4px;" required>
                                                            <option value="">Select Group</option>
                                                            <?php if(!empty($refGrpArr)): ?>
                                                                <?php foreach($refGrpArr AS $e_grp): ?>
                                                                    <option value="<?= $e_grp['refGrpId']; ?>" <?php if($queryGroup==$e_grp['refGrpId']): ?>selected<?php endif; ?> ><?= $e_grp['refGrpName']; ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select> 
                                                    </div>
                                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                        <select class="form-control select2" name="refSubGroupId" id="refSubGroupId" onchange="serachSubGroup(this);" style="width:100%;margin-top: 4px;" required>
                                                            <option value="">Select Sub-Group</option>
                                                            <?php if(!empty($refSubGrpArr)): ?>
                                                                <?php foreach($refSubGrpArr AS $e_sgrp): ?>
                                                                    <?php if($queryGroup==$e_sgrp['fkRefGrpId']): ?>
                                                                        <option value="<?= $e_sgrp['refSubGrpId']; ?>" <?php if($querySubGroup==$e_sgrp['refSubGrpId']): ?>selected<?php endif; ?>><?= $e_sgrp['refSubGrpName']; ?></option>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select> 
                                                    </div>
                                                    <!--<div class="col-md-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>-->
                                                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="sortingOffWithSearchTable1 table table-bordered table-striped" style="width:100%">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="5%">SN</th>
                                                        <th>Year</th>
                                                        <th>Referencer&nbsp;Name</th>
                                                        <th width="20%">Author</th>
                                                        <th width="5%">Uploaded&nbsp;Date</th>
                                                        <th width="5%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($referncerArr)): ?>
                                                        <?php $i=1; ?>
                                                        <?php foreach($referncerArr AS $e_row): ?>
                                                            <?php 
                                                                $docUrl=$docPath.'/'.$e_row['referncerFile'];
                                                            ?>
                                                            <tr>
                                                    			<td class="text-center" width="5%"><?php echo $i; ?></td>
                                                    			<td nowrap class="text-center" width="5%"><?php echo $e_row['referncerYear']; ?></td>
                                                    			<td nowrap><a href="<?= $docUrl; ?>" target="_blank"><?php echo $e_row['referncerHeading']; ?></a></td>
                                                    			<td nowrap width="20%"><?php echo $e_row['referncerAuthor']; ?></td>
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
                                                    			    
                                                    			    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="<?php echo $docPath.'/'.$e_row['referncerFile']; ?>" target="_blank">View</a>
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

<script>
    $(document).ready(function(){
        
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
    
    function searchGroup($this)
    {
        var group_id=$this.value;
        
        window.location.href=base_url+"/adminReferncer?group="+group_id;
    }
    
    function serachSubGroup($this)
    {
        var group_id=$('#refGroupId').val();
        var sub_group_id=$this.value;
        
        window.location.href=base_url+"/adminReferncer?group="+group_id+"&sub_group="+sub_group_id;
    }

</script>
  
<?= $this->endSection(); ?>