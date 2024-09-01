<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .table-responsive table thead tr {
        background: #005495 !important;
        color: #fff !important;
    }

    .table-responsive table tbody tr {
        background: #96c7f242 !important;
    }

    .table-responsive tr th {
        border: 1px solid #fff !important;
    }

    .table-responsive tr td {
        border: 1px solid #015aacab !important;
    }

    table.dataTable {
        border-collapse: collapse !important;
        font-size: 16px !important;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th {
        padding: 8px 14px !important;
    }

    .theme-primary .btnPrimClr {
        margin-top: 0px !important;
        height: 30px !important;
        margin-bottom: 0px !important;
    }
</style>

<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-12">

            <div class="box mt-35">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?php
                        if (isset($pageTitle))
                            echo $pageTitle;
                        else
                            echo "N/A";
                        ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('accountFinance'); ?>">
                            <button type="button" class="btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="offset-md-1 col-md-10">
                            <div class="table-responsive">
                                <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">SN</th>
                                            <th>Staff&nbsp;Name</th>
                                            <th>Designation</th>
                                            <th>Per&nbsp;Hour</th>
                                            <th>Per&nbsp;Day</th>
                                            <th>Per&nbsp;Month</th>
                                            <th>Per&nbsp;Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($userDataArr)) : ?>
                                            <?php foreach ($userDataArr as $k_row => $e_row) : ?>
                                                <?php
                                                    $staffCostPerHour = !empty($e_row['staffCostPerHour']) ? (float)$e_row['staffCostPerHour'] : 0;

                                                    $staffCostPerDay = 0;
                                                    $staffCostPerMonth = 0;
                                                    $staffCostPerYear = 0;

                                                    if(!empty($staffCostPerHour)){
                                                        $staffCostPerDay = $staffCostPerHour*8;
                                                        $staffCostPerMonth = $staffCostPerDay*30;
                                                        $staffCostPerYear = $staffCostPerMonth*12;
                                                    }
                                                ?>  
                                                <tr>
                                                    <td class="text-center" width="5%">
                                                        <?= $k_row+1; ?>
                                                    </td>
                                                    <td nowrap>
                                                        <?php echo $e_row['userFullName']; ?>
                                                    </td>
                                                    <td class="text-center" nowrap>
                                                        <?php
                                                        if (!empty($e_row['userDesgn']))
                                                            echo $e_row['userDesgn'];
                                                        else
                                                            echo "N/A";
                                                        ?>
                                                    </td>
                                                    <td class="text-right" nowrap>
                                                        <?= amount_format($staffCostPerHour); ?>
                                                    </td>
                                                    <td class="text-right" nowrap>
                                                        <?= amount_format($staffCostPerDay); ?>
                                                    </td>
                                                    <td class="text-right" nowrap>
                                                        <?= amount_format($staffCostPerMonth); ?>
                                                    </td>
                                                    <td class="text-right" nowrap>
                                                        <?= amount_format($staffCostPerYear); ?>
                                                    </td>
                                                    <td class="text-center" width="5%">
                                                        <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateModal<?= $k_row; ?>">Edit</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
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

<?php if(!empty($userDataArr)): ?>
    <?php foreach($userDataArr AS $k_row_no => $e_row): ?>
    <?php
        $staffCostPerHour = !empty($e_row['staffCostPerHour']) ? (float)$e_row['staffCostPerHour'] : 0;

        $staffCostPerDay = 0;
        $staffCostPerMonth = 0;
        $staffCostPerYear = 0;

        if(!empty($staffCostPerHour)){
            $staffCostPerDay = $staffCostPerHour*8;
            $staffCostPerMonth = $staffCostPerDay*30;
            $staffCostPerYear = $staffCostPerMonth*12;
        }
    ?>                
    <!-- Modal -->
    <div id="updateModal<?= $k_row_no; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo base_url('edit-staff-rate'); ?>" method="POST" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Update Rate</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <span>Staff Name : </span>
                                    <span class="font-weight-bold">
                                        <?= $e_row['userFullName']; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Per Hour<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control staffCostPerHour" name="staffCostPerHour" id="staffCostPerHour<?= $k_row_no; ?>" data-id="<?= $k_row_no; ?>" placeholder="Enter Rate" value="<?= $staffCostPerHour; ?>" onkeypress="validateNum(event)" required>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Per Day</label>
                                    <input type="text" class="form-control" name="staffCostPerDay" id="staffCostPerDay<?= $k_row_no; ?>" value="<?= $staffCostPerDay; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Per Month</label>
                                    <input type="text" class="form-control" name="staffCostPerMonth" id="staffCostPerMonth<?= $k_row_no; ?>" value="<?= $staffCostPerMonth; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Per Year</label>
                                    <input type="text" class="form-control" name="staffCostPerYear" id="staffCostPerYear<?= $k_row_no; ?>" value="<?= $staffCostPerYear; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="userId" id="userId" value="<?= $e_row['userId']; ?>">
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

<script>

    $(document).ready(function(){

        $('.staffCostPerHour').on('keyup', function(){
            
            var staffCostId = $(this).data('id');
            
            if($(this).val()!="")
                var staffCostPerHour = parseFloat($(this).val());
            else
                var staffCostPerHour = 0;

            var staffCostPerDay = 0;
            var staffCostPerMonth = 0;
            var staffCostPerYear = 0;

            if(staffCostPerHour > 0){
                staffCostPerDay = parseFloat(staffCostPerHour*8);
                staffCostPerMonth = parseFloat(staffCostPerDay*30);
                staffCostPerYear = parseFloat(staffCostPerMonth*12);
            }
            
            $('#staffCostPerDay'+staffCostId).val(staffCostPerDay);
            $('#staffCostPerMonth'+staffCostId).val(staffCostPerMonth);
            $('#staffCostPerYear'+staffCostId).val(staffCostPerYear);
        });

    });

</script>

<?= $this->endSection(); ?>