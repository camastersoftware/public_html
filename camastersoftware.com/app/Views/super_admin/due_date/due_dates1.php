<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box mt-40">
                    <div class="box-header with-border flexbox">
                        <h3 class="box-title">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h3>
                        <div class="text-right flex-grow">
                            <a href="<?php echo base_url('add_due_date'); ?>" >
                                <button class="btn btn-submit">Add Due Date</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    
                        <div class="table-responsive">
                            <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Act</th>
                                        <th>Financial Year</th>
                                        <th>Due Date</th>
                                        <th>Extended Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($dueDatesArr)): ?>
                                        <?php $i=1; ?>
                                        <?php foreach($dueDatesArr AS $e_row): ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $e_row['act_name']; ?></td>
                                                <td><?php echo $e_row['finYear']; ?></td>
                                                <td><?php echo date("d-M-Y", strtotime($e_row['due_date'])); ?></td>
                                                <td>
                                                    <?php 
                                                        if(!empty($e_row['ext_due_date']) && $e_row['ext_due_date']!="0000-00-00" && $e_row['ext_due_date']!="1970-01-01")
                                                            echo date("d-M-Y", strtotime($e_row['ext_due_date'])); 
                                                        else
                                                            echo "N/A"; 
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url('extend_due_date/'.$e_row['due_date_id']); ?>">
                                                        <button class="btn btn-sm btn-warning mb-5" data-toggle="tooltip" data-original-title="Extend Due Date">
                                                            <i class="fa fa-pencil"></i>&nbsp;Extend Due Date
                                                        </button>
                                                    </a>
                                                    <button class="btn btn-sm btn-danger delDueDate mb-5" data-toggle="tooltip" data-original-title="Delete" id="<?php echo $e_row['due_date_id']; ?>">
                                                        <i class="fa fa-trash"></i>&nbsp;Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8"><center>No records</center></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Act</th>
                                        <th>Financial Year</th>
                                        <th>Due Date</th>
                                        <th>Extended Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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
    $(document).ready(function(){
        $('.delDueDate').on('click', function () {

        var base_url = "<?php echo base_url(); ?>";
        var due_date_id = $(this).attr('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this due date ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/delete_due_date';
                    $.post(postingUrl, 
                    {
                        due_date_id: due_date_id
                    },
                    function(data, status){
                        window.location.href=base_url+"/due_dates";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
    });
</script>   

<?= $this->endSection(); ?>