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
        
        .tabs_title{
            font-size: 14px !important;
            font-weight: 800 !important;
        }
        
        .nav-tabs{
            border-bottom: none !important;
        }
        
        .nav_tab_1{
            padding-right: 20px !important;
        }
        
        .nav_tab_2{
            border-left: 3px solid #fff !important;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box mt-40">
                    <div class="box-header with-border flexbox">
                        <!--<h4 class="box-title font-weight-bold">-->
                            <?php
                                // if(isset($pageTitle))
                                //     echo $pageTitle;
                                // else
                                //     echo "N/A";
                            ?>
                        <!--</h4>-->
                        <ul class="nav nav-tabs nav-fill" role="tablist">
    						<li class="nav-item nav_tab_1"> 
    						    <a class="nav-link active" data-toggle="tab" href="#nav_tab1" role="tab">
    						        <span class="hidden-xs-down ml-15"><span class="tabs_title">Firm List</span></span>
    						    </a> 
    						</li>
    						<li class="nav-item nav_tab_2"> 
    						    <a class="nav-link" data-toggle="tab" href="#nav_tab2" role="tab">
    						        <span class="hidden-xs-down ml-15"><span class="tabs_title">License Holders</span></span>
    						    </a> 
    					    </li>
    					</ul>
                        <div class="text-right flex-grow">
                            <a href="<?php echo base_url('superadmin/add_firm'); ?>" >
                                <button class="btn btn-sm btn-submit">Register Firm</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="tab-content tabcontent-border">
    						<div class="tab-pane active" id="nav_tab1" role="tabpanel">
    							<div class="p-15">
                                    <div class="table-responsive">
                                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="2%">SN</th>
                                                    <th width="15%">Firm&nbsp;Name</th>
                                                    <th width="12%">Contact&nbsp;Person</th>
                                                    <th width="9%">Mobile&nbsp;No</th>
                                                    <th width="9%">Email</th>
                                                    <th width="5%">Users</th>
                                                    <th width="7%">Key</th>
                                                    <!--<th width="10%">State</th>-->
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($firmList)): ?>
                                                    <?php $i=1; ?>
                                                    <?php foreach($firmList AS $e_row): ?>
                                                        <?php if($e_row['caFirmStatus']==0): ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $i; ?></td>
                                                            <td><?php echo str_replace(" ", "&nbsp;", $e_row['caFirmName']); ?></td>
                                                            <td><?php echo $e_row['caFirmContactPerson']; ?></td>
                                                            <td class="text-center"><?php echo $e_row['caFirmMobile']; ?></td>
                                                            <td><?php echo $e_row['caFirmEmail']; ?></td>
                                                            <td class="text-center"><?php echo $e_row['caFirmUsers']; ?></td>
                                                            <td class="text-center"><?php echo $e_row['caFirmCompanyKey']; ?></td>
                                                            <!--<td class="text-center"><?php //echo $e_row['caFirmState']; ?></td>-->
                                                            <td class="text-center">
                                                                <div class="btn-group">
                                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                                        <?php if($e_row['caFirmStatus']==0): ?>
                                                                            <a href="javascript:void(0);" class="dropdown-item approveFirm" id="<?php echo $e_row['caFirmId']; ?>">Approve</a>
                                                                        <?php endif; ?>
                                                                        <?php if($e_row['caFirmStatus']==0): ?>
                                                                            <a href="javascript:void(0);" class="dropdown-item rejectFirm" id="<?php echo $e_row['caFirmId']; ?>">Reject</a>
                                                                        <?php endif; ?>
                                                                        <a href="<?php echo base_url('superadmin/edit_firm/'.$e_row['caFirmId']); ?>" class="dropdown-item" id="<?php echo $e_row['caFirmId']; ?>">View/Edit</a>
                                                                        <a href="javascript:void(0);" class="dropdown-item delFirm" id="<?php echo $e_row['caFirmId']; ?>">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8"><center>No records</center></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav_tab2" role="tabpanel">
    							<div class="p-15">
                                    <div class="table-responsive">
                                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="2%">SN</th>
                                                    <th width="15%">Firm&nbsp;Name</th>
                                                    <th width="12%">Contact&nbsp;Person</th>
                                                    <th width="9%">Mobile&nbsp;No</th>
                                                    <th width="9%">Email</th>
                                                    <th width="5%">Users</th>
                                                    <th width="7%">Key</th>
                                                    <!--<th width="10%">State</th>-->
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($firmLicHolders)): ?>
                                                    <?php $i=1; ?>
                                                    <?php $fCount=0; ?>
                                                    <?php $uCount=0; ?>
                                                    <?php foreach($firmLicHolders AS $e_row): ?>
                                                    <?php if($e_row['caFirmStatus']==1): ?>
                                                        <?php $fCount=((int)$fCount)+1; ?>
                                                        <?php $uCount=((int)$uCount)+$e_row['caFirmUsers']; ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $i; ?></td>
                                                            <td><?php echo str_replace(" ", "&nbsp;", $e_row['caFirmName']); ?></td>
                                                            <td><?php echo $e_row['caFirmContactPerson']; ?></td>
                                                            <td class="text-center"><?php echo $e_row['caFirmMobile']; ?></td>
                                                            <td><?php echo $e_row['caFirmEmail']; ?></td>
                                                            <td class="text-center"><?php echo $e_row['caFirmUsers']; ?></td>
                                                            <td class="text-center"><?php echo $e_row['caFirmCompanyKey']; ?></td>
                                                            <!--<td class="text-center"><?php //echo $e_row['caFirmState']; ?></td>-->
                                                            <td class="text-center">
                                                                <div class="btn-group">
                                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                                        <?php if($e_row['caFirmStatus']==0): ?>
                                                                            <a href="javascript:void(0);" class="dropdown-item approveFirm" id="<?php echo $e_row['caFirmId']; ?>">Approve</a>
                                                                        <?php endif; ?>
                                                                        <?php if($e_row['caFirmStatus']==0): ?>
                                                                            <a href="javascript:void(0);" class="dropdown-item rejectFirm" id="<?php echo $e_row['caFirmId']; ?>">Reject</a>
                                                                        <?php endif; ?>
                                                                        <a href="<?php echo base_url('superadmin/edit_firm/'.$e_row['caFirmId']); ?>" class="dropdown-item" id="<?php echo $e_row['caFirmId']; ?>">View/Edit</a>
                                                                        <a href="javascript:void(0);" class="dropdown-item delFirm" id="<?php echo $e_row['caFirmId']; ?>">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <tr style="height: 42px !important;">
                                                        <td class="text-center font-weight-bold"><?php echo $fCount; ?></td>
                                                        <td class="text-center font-weight-bold">Total</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center font-weight-bold"><?php echo $uCount; ?></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8"><center>No records</center></td>
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

        $('.approveFirm').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var caFirmId = $(this).attr('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to approve this CA Firm request ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, approve it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/superadmin/approve_firm';
                    $.post(postingUrl, 
                    {
                        caFirmId: caFirmId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/firmList";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

        $('.rejectFirm').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var caFirmId = $(this).attr('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to reject this CA Firm request ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, reject it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/superadmin/reject_firm';
                    $.post(postingUrl, 
                    {
                        caFirmId: caFirmId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/firmList";
                    });



                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

        $('.delFirm').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var caFirmId = $(this).attr('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this CA Firm account ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/superadmin/delete_firm';
                    $.post(postingUrl, 
                    {
                        caFirmId: caFirmId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/firmList";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });       

    });
</script>

<?= $this->endSection(); ?>