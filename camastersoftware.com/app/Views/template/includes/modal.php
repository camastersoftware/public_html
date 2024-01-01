<!-- Modal -->
<div id="switchDueDateYear" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="<?php echo base_url('switchDueDateYear'); ?>" method="POST" enctype="multipart/form-data" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Switch Due Date Year</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="username" class="col-sm-12 col-form-label text-md-left">Due Date Year</label>
                        <div class="col-md-12">
                            <select class="custom-select form-control" id="dueDateYear" name="dueDateYear" required>
                                <option value="">Select Year</option>
                                <?php for($d=$currentFinancialYear; $d>=2017; $d--): ?>
                                    <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                    <option value="<?php echo $dueYr; ?>" <?php echo set_select('dueDateYear', $dueYr, $dueYr==$sessDueDateYear ? TRUE:FALSE); ?> ><?php echo $dueYr; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="currentURL" value="<?= current_url(); ?>">
                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Modal -->
<div id="switchDueDateYearSuperAdmin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="<?php echo base_url('superadmin/switchDueDateYearSuperAdmin'); ?>" method="POST" enctype="multipart/form-data" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Switch Due Date Year</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="username" class="col-sm-12 col-form-label text-md-left">Due Date Year</label>
                        <div class="col-md-12">
                            <select class="custom-select form-control" id="dueDateYear" name="dueDateYear" required>
                                <option value="">Select Year</option>
                                <?php for($d=$currentFinancialYear; $d>=2017; $d--): ?>
                                    <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                    <option value="<?php echo $dueYr; ?>" <?php echo set_select('dueDateYear', $dueYr, $dueYr==$sessDueDateYear ? TRUE:FALSE); ?> ><?php echo $dueYr; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="currentURL" value="<?= current_url(); ?>">
                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->