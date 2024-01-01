<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>

    .err_resolved td{
        background-color: #F0F061B2; /* yellow*/
    }
    
    .err_not_stsfy td{
        background-color: #77EC77B2; /* green */
    }

    /*.data_tbl thead,*/
    /*.data_tbl th {text-align: center;}*/

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
    
    .nav-tabs{
        border-bottom: none !important;
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
    
    .title_p{
        margin-top: -24px !important;
    }

</style>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box mt-35">
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
                            <a href="<?php echo base_url('superadmin/add_error_report'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-submit">Add Query</button>
                            </a>
                            &nbsp;
                            <a href="<?php echo base_url('superadmin/home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
    					<ul class="nav nav-tabs nav-tabs_hd nav-fill" role="tablist">
    						<li class="nav-item nav_tab_1"> 
    						    <a class="nav-link nav-link_hd <?php if($errType==1): ?>active<?php endif; ?>" data-toggle="tab" href="#nav_tab1" role="tab">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title font-weight-bold">
    						               <p class="title_p">Admin</p> 
    						            </span>
    						        </span>
    						    </a> 
    						</li>
    						<li class="nav-item nav_tab_2"> 
    						    <a class="nav-link nav-link_hd <?php if($errType==2): ?>active<?php endif; ?>" data-toggle="tab" href="#nav_tab2" role="tab">
    						        <span class="hidden-xs-down ml-15">
    						            <span class="tabs_title font-weight-bold">
    						                <p class="title_p">Super Admin</p> 
    						            </span>
    						        </span>
    						    </a> 
    					    </li>
    					</ul>
                        <div class="tab-content tabcontent-border">
    						<div class="tab-pane <?php if($errType==1): ?>active<?php endif; ?>" id="nav_tab1" role="tabpanel">
    							<div class="p-15">
                                    <div class="table-responsive">
                                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">SN</th>
                                                    <th width="5%">Code</th>
                                                    <th width="8%">Date</th>
                                                    <!--<th width="8%">Key</th>-->
                                                    <th width="5%">Firm&nbsp;Name</th>
                                                    <!--<th>User&nbsp;Name</th>-->
                                                    <!--<th>Report&nbsp;Title</th>-->
                                                    <th>Menu</th>
                                                    <th>Sub&nbsp;Menu</th>
                                                    <th>Query&nbsp;In&nbsp;Detail</th>
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php if(!empty($errRepData)): ?>
                                                    <?php foreach($errRepData AS $e_rp): ?>
                                                        <?php if($e_rp['errFrom']=='1'): ?>
                                                        <tr class="<?php if($e_rp['errStatus']=="1"): ?>err_resolved<?php elseif($e_rp['errStatus']=="2"): ?>err_not_stsfy<?php endif; ?>" style="background-color: <?php echo $e_rp['errPriorityColor']; ?> !important;">
                                                            <td width="5%" class="text-center"><?php echo $i; ?></td>
                                                            <td width="5%" class="text-center" nowrap><?php echo $e_rp['errCode']; ?></td>
                                                            <td width="8%" nowrap><?php echo date('d-m-Y', strtotime($e_rp['errDate'])); ?></td>
                                                            <!--<td nowrap><?php //echo $e_rp['caFirmCompanyKey']; ?></td>-->
                                                            <td nowrap width="5%">
                                                                <?php 
                                                                    $firmNameVar=$e_rp['caFirmName']!="" ? $e_rp['caFirmName'] : $e_rp['errByUser']; 
                                                                    $firmNameVal=substr($firmNameVar, 0, 30);
                                                                ?>
                                                                <a href="<?= base_url('superadmin/viewSubscriber/'.$e_rp['caFirmId'].'?qryFrom=1'); ?>" target="_blank">
                                                                    <?= $firmNameVal; ?>
                                                                </a>
                                                            </td>
                                                            <!--<td nowrap><?php //echo $e_rp['errByPerson']; ?></td>-->
                                                            <!--<td><?php //echo $e_rp['errReport']; ?></td>-->
                                                            <td width="5%" class="text-center" nowrap><?= (!empty($e_rp['menuName'])) ? $e_rp['menuName'] : "---"; ?></td>
                                                            <td width="5%" class="text-center" nowrap><?= (!empty($e_rp['subMenuName'])) ? $e_rp['subMenuName'] : "---"; ?></td>
                                                            <td><?= substr($e_rp['errUserComment'], 0, 200); ?></td>
                                                            <td width="5%">
                                                                <div class="btn-group">
                                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                                        <?php if($e_rp['errFrom']=='2'): ?>
                                                                            <a class="dropdown-item" href="<?php echo base_url('superadmin/error_report/edit_error_report/'.$e_rp['errId'].'?errType=1'); ?>" >Edit</a>
                                                                            <a class="dropdown-item" href="<?php echo base_url('superadmin/error_report/reply_error_report/'.$e_rp['errId'].'?errType=1'); ?>" >Reply</a>
                                                                        <?php else: ?>
                                                                            <a class="dropdown-item" href="<?php echo base_url('superadmin/error_report/reply_error_report/'.$e_rp['errId'].'?errType=1'); ?>" >Reply</a>
                                                                        <?php endif; ?>
                                                                        <a class="dropdown-item" href="<?php echo base_url('superadmin/error_report/view_error_report/'.$e_rp['errId'].'?errType=1'); ?>" >View</a>
                                                                        <a class="dropdown-item delRep" href="javascript:void(0);" id="<?php echo $e_rp['errId']; ?>" data-type="1" data-toggle="tooltip" data-original-title="Delete">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8"><center>No records found</center></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane <?php if($errType==2): ?>active<?php endif; ?>" id="nav_tab2" role="tabpanel">
    							<div class="p-15">
                                    <div class="table-responsive">
                                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">SN</th>
                                                    <th width="5%">Code</th>
                                                    <th width="8%">Date</th>
                                                    <!--<th>Report&nbsp;Title</th>-->
                                                    <th>Query&nbsp;In&nbsp;Detail</th>
                                                    <th width="1%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; ?>
                                                <?php if(!empty($errRepData)): ?>
                                                    <?php foreach($errRepData AS $e_rp): ?>
                                                        <?php if($e_rp['errFrom']=='2'): ?>
                                                        <tr class="<?php if($e_rp['errStatus']=="1"): ?>err_resolved<?php elseif($e_rp['errStatus']=="2"): ?>err_not_stsfy<?php endif; ?>" style="background-color: <?php echo $e_rp['errPriorityColor']; ?> !important;">
                                                            <td width="5%" class="text-center"><?php echo $i; ?></td>
                                                            <td width="5%" class="text-center" nowrap><?php echo $e_rp['errCode']; ?></td>
                                                            <td width="8%" nowrap><?php echo date('d-m-Y', strtotime($e_rp['errDate'])); ?></td>
                                                            <!--<td><?php //echo $e_rp['errReport']; ?></td>-->
                                                            <td><?= substr($e_rp['errUserComment'], 0, 200); ?></td>
                                                            <td width="1%">
                                                                <div class="btn-group">
                                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                                        <?php if($e_rp['errFrom']=='2'): ?>
                                                                            <a class="dropdown-item" href="<?php echo base_url('superadmin/error_report/edit_error_report/'.$e_rp['errId'].'?errType=2'); ?>" >Edit</a>
                                                                            <a class="dropdown-item" href="<?php echo base_url('superadmin/error_report/reply_error_report/'.$e_rp['errId'].'?errType=2'); ?>" >Reply</a>
                                                                        <?php else: ?>
                                                                            <a class="dropdown-item" href="<?php echo base_url('superadmin/error_report/reply_error_report/'.$e_rp['errId'].'?errType=2'); ?>" >Reply</a>
                                                                        <?php endif; ?>
                                                                        <a class="dropdown-item" href="<?php echo base_url('superadmin/error_report/view_error_report/'.$e_rp['errId'].'?errType=2'); ?>" >View</a>
                                                                        <a class="dropdown-item delRep" href="javascript:void(0);" id="<?php echo $e_rp['errId']; ?>" data-type="2" data-toggle="tooltip" data-original-title="Delete">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5"><center>No records found</center></td>
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


<script>
    $(document).ready(function () {

        $('.delRep').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var errId = $(this).attr('id');
            var errType = $(this).attr('data-type');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this query ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    
                    var postingUrl = base_url+'/superadmin/delete_error_report';
                    $.post(postingUrl, 
                    {
                        errId: errId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/error_reports?errType="+errType;
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

    });
</script>

<?= $this->endSection(); ?>