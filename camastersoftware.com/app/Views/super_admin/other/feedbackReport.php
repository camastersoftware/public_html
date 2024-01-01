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
        
        .table > tbody > tr:last-child > td {
            padding: 5px 14px !important;
        }
        
        .btnPrimClr {
            margin-top: 5px !important;
            height: 30px !important;
            margin-bottom: 5px !important;
        }
    </style>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/rateyo/jquery.rateyo.min.css'); ?>">
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="<?= base_url('assets/rateyo/jquery.rateyo.min.js'); ?>"></script>

    <!-- Main content -->
    <section class="content mt-35">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title font-weight-bold">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <a href="<?php echo base_url('superadmin/home'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                        <div class="table-responsive">
                            <table class="sortingOffTable table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">SN</th>
                            			<th width="5%">Date</th>
                            			<th width="5%">License&nbsp;No</th>
                            			<th width="30%">Firm Name</th>
                            			<th>Staff Name</th>
                            			<th width="20%">Rating</th>
                            			<th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($feedbackList)): ?>
                                        <?php $i=1; ?>
                                        <?php foreach($feedbackList AS $e_row): ?>
                                            <tr>
                                                <td class="text-center" width="5%"><?php echo $i; ?></td>
                                                <td class="text-center" nowrap width="5%">
                                                    <?php
                                                        if($e_row['feedbackDate']!="" && $e_row['feedbackDate']!="1970-01-01"  && $e_row['feedbackDate']!="0000-00-00")
                                    			            echo date('d-m-Y', strtotime($e_row['feedbackDate']));
                                    			        else
                                    			            echo "N/A";
                                                    ?>
                                                </td>
                                    		    <td class="text-center" width="5%"><?php echo $e_row['caFirmCompanyKey']; ?></td>
                                    		    <td width="30%"><?php echo $e_row['caFirmName']; ?></td>
                                    		    <td><?php echo $e_row['staffName']; ?></td>
                                    		    <td class="text-center" width="20%">
                                    		        <?php //echo $e_row['ratingVal']; ?>
                                    		        <div id="feedbackId_<?php echo $e_row['feedbackId']; ?>"></div>
                                    		    </td>
                                                <td class="text-center" width="5%">
                                                    
                                                    <div class="btn-group">
                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                            <a class="dropdown-item" href="<?php echo base_url('superadmin/feedbackView/'.$e_row['feedbackId']); ?>">View</a>
                                                            <a class="dropdown-item deleteFeedback" href="javascript:void(0);" data-id="<?php echo $e_row['feedbackId']; ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td class="text-center" width="5%"></td>
                                            <td class="text-center" nowrap width="5%"></td>
                                		    <td class="text-center" width="5%"></td>
                                		    <td width="30%"></td>
                                		    <td><b>Total : </b></td>
                                		    <td class="text-center" width="20%">
                                		        <div id="feedbackAvg"></div>
                                		    </td>
                                            <td class="text-center" width="5%"></td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7"><center>No records</center></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php if(!empty($feedbackList)): ?>
    
        <?php foreach($feedbackList AS $e_row): ?>
    
        <script>
            $(document).ready(function(){
                
                var feedbackId = parseInt("<?php echo $e_row['feedbackId']; ?>");
                var ratingVal = parseInt("<?php echo $e_row['ratingVal']; ?>");
                
                $(function () {
                    $("#feedbackId_"+feedbackId).rateYo({
                        rating: ratingVal,
                        fullStar: true,
                        readOnly: true,
                        starWidth: "25px"
                    });
                });
                
            });
        </script>
        
        <?php endforeach; ?>
        
        <?php $feedbackTotalRating=array_sum(array_column($feedbackList, 'ratingVal')); ?>
        
        <script>
            $(document).ready(function(){
        
                var totalfeedback = parseInt("<?php echo count($feedbackList); ?>");
                var feedbackTotalRating = parseInt("<?php echo $feedbackTotalRating; ?>");
                
                var feedbackAvg = feedbackTotalRating/totalfeedback;
                
                // console.log('totalfeedback', totalfeedback);
                // console.log('feedbackAvg', feedbackTotalRating);
                // console.log('feedbackAvg', feedbackAvg);
                
                $(function () {
                    $("#feedbackAvg").rateYo({
                        rating: feedbackAvg,
                        fullStar: true,
                        readOnly: true,
                        starWidth: "25px"
                    });
                });
        
            });
        </script>
    
    <?php endif; ?>

    <script>
        $(document).ready(function () {

            $('.deleteFeedback').on('click', function () {
    
                var base_url = "<?php echo base_url(); ?>";
                var feedbackId = $(this).data('id');
    
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
    
                        var postingUrl = base_url+'/superadmin/deleteFeedback';
                        $.post(postingUrl, 
                        {
                            feedbackId: feedbackId
                        },
                        function(data, status){
                            window.location.href=base_url+"/superadmin/feedbackReport";
                        });
    
                    } else {
                        swal("Cancelled", "You cancelled :)", "error");
                    }
                });
    
            });       
    
        });
    </script>

<?= $this->endSection(); ?>