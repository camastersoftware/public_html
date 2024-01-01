<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>

.err_resolved td{
    background-color: #F0F061B2; /* yellow*/
}

.err_not_stsfy td{
    background-color: #77EC77B2; /* green */
}

.data_tbl thead,
.data_tbl th {text-align: center;}

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

</style>

<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('add_error_report'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit">Add Query</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th width="5%">Code</th>
                                    <th width="5%">Date</th>
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
                                        <tr class="<?php if($e_rp['errStatus']=="1"): ?>err_resolved<?php elseif($e_rp['errStatus']=="2"): ?>err_not_stsfy<?php endif; ?>" style="background-color: <?php echo $e_rp['errPriorityColor']; ?> !important;">
                                            <td width="5%" class="text-center"><?php echo $i; ?></td>
                                            <td width="5%" class="text-center"><?php echo $e_rp['errCode']; ?></td>
                                            <td width="5%" class="text-center" nowrap><?php echo date('d-m-Y', strtotime($e_rp['errDate'])); ?></td>
                                            <td width="5%" class="text-center" nowrap><?= (!empty($e_rp['menuName'])) ? $e_rp['menuName'] : "---"; ?></td>
                                            <td width="5%" class="text-center" nowrap><?= (!empty($e_rp['subMenuName'])) ? $e_rp['subMenuName'] : "---"; ?></td>
                                            <td>
                                                <?= substr($e_rp['errUserComment'], 0, 150); ?>
                                            </td>
                                            <td width="5%" class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="<?php echo base_url('error_report/edit_error_report/'.$e_rp['errId']); ?>" >Edit</a>
                                                        <a class="dropdown-item" href="<?php echo base_url('error_report/view_error_report/'.$e_rp['errId']); ?>" >View</a>
                                                        <a class="dropdown-item delRep" href="javascript:void(0);" id="<?php echo $e_rp['errId']; ?>" data-toggle="tooltip" data-original-title="Delete">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7"><center>No records found</center></td>
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

<script>
    $(document).ready(function () {

        $('.delRep').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var errId = $(this).attr('id');

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
                    
                    var postingUrl = base_url+'/delete_error_report';
                    $.post(postingUrl, 
                    {
                        errId: errId
                    },
                    function(data, status){
                        window.location.href=base_url+"/error_reports";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

    });
</script>


<?= $this->endSection(); ?>