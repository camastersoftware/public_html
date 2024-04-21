<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .wizard-content .wizard>.steps>ul>li.current>a {
        color: #ffffff !important;
        cursor: default;
    }

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
        padding: 0px 14px !important;
    }

    .btnPrimClr {
        margin-top: 5px !important;
        height: 30px !important;
        margin-bottom: 5px !important;
    }

    .box_body_bg {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        /*border-radius: 10px;*/
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        /*margin-top: 20px !important;*/
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
</style>

<!-- Main content -->
<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?= $pageTitle ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('payroll'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                        <div class="text-right flex-grow">
                            <button class="btn btn-sm btn-submit mr-1" data-toggle="modal" data-target="#addModal">Add Salary Head</button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th>Name</th>
                                    <th width="15%" >Type</th>
                                    <th width="15%"  nowrap>Affected By</th>
                                    <th width="10%" >Amount</th>
                                    <th width="10%" >Percentage</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php if (!empty($getFirmSalPramList)) : ?>
                                    <?php foreach ($getFirmSalPramList as $e_row) : ?>
                                        <tr id="user_id_tr_<?php echo $e_row['salaryParameterId']; ?>">
                                            <td class="text-center"  width="5%"><?php echo $i; ?></td>

                                            <td class="text-center" nowrap>
                                                <?php
                                                if (!empty($e_row['salaryParameter']))
                                                    echo $e_row['salaryParameter'];
                                                else
                                                    echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center" width="15%"  nowrap>
                                                <?php
                                                if (!empty($e_row['ParameterType']))
                                                    echo $e_row['ParameterType'];
                                                else
                                                    echo "N/A";
                                                ?>
                                            </td>

                                            <td class="text-center" width="15%"  nowrap>
                                                <?php
                                                if (!empty($e_row['ParameterEffectBy']))
                                                    echo $e_row['ParameterEffectBy'];
                                                else
                                                    echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center" width="10%"  nowrap>
                                                <?php
                                                if (!empty($e_row['salaryParameterAmount']))
                                                    echo $e_row['salaryParameterAmount'];
                                                else
                                                    echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center" width="10%"  nowrap>
                                                <?php
                                                if (!empty($e_row['salaryParameterPercentage']))
                                                    echo $e_row['salaryParameterPercentage'];
                                                else
                                                    echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center" width="5%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal" onclick="getParamDetails('<?php echo htmlspecialchars(json_encode($e_row)); ?>')"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                                        <a class="dropdown-item" href="#" onclick="removeParamDetails('<?php echo $e_row['salaryParameterId']; ?>')"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url('add-salary-params'); ?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span id="title">Add</span> Salary Head</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearParams()">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Salary Head Name <small class="text-danger">*</small></label>
                                <input type="text" id="salaryParameter" name="salaryParameter" class="form-control" placeholder="Salary Head Name" required>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Salary Head Type <small class="text-danger">*</small></label>
                                <select id="salaryParameterType" name="salaryParameterType" class="form-control custom-select" id="salaryParameterType">
                                    <option value="">Select Salary Head Type</option>
                                    <option value="1">Income </option>
                                    <option value="2">Deductions</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Salary Head Affected By <small class="text-danger">*</small></label>
                                <select id="salaryParameterEffectBy" name="salaryParameterEffectBy" class="form-control custom-select" id="salaryParameterEffectBy" onchange="getParamsEffectedBy()">
                                    <option value="">Select Salary Head Affected By</option>
                                    <option value="1">Amount</option>
                                    <option value="2">Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12" id="salaryParameterAmountDiv">
                            <div class="form-group">
                                <label>Salary Head Amount <small class="text-danger">*</small></label>
                                <input type="text" id="salaryParameterAmount" name="salaryParameterAmount" class="form-control" placeholder="Salary Head Amount" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12" id="salaryParameterPercentageDiv">
                            <div class="form-group">
                                <label>Salary Head Percentage <small class="text-danger">*</small></label>
                                <input type="text" id="salaryParameterPercentage" name="salaryParameterPercentage" class="form-control" placeholder="Salary Head Percentage" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" id="salaryParameterId" name="salaryParameterId" value="0" />
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal" onclick="clearParams()">Close</button>
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
    $(document).ready(function() {
        getParamsEffectedBy();
    });

    function removeParamDetails(salaryParameterId) {
        var base_url = "<?php echo base_url(); ?>";
        var itemName = "Salary Head";
        swal({
            title: "Are you sure?",
            text: "Do you really want to delete this " + itemName + " ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {

                var postingUrl = base_url + '/delete-salary-params';
                $.post(postingUrl, {
                        salaryParameterId: salaryParameterId,
                        "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
                    },
                    function(data, status) {
                        window.location.href = base_url + "/salary-params";
                    });

            } else {
                swal("Cancelled", "You cancelled :)", "error");
            }
        });
    }

    function getParamsEffectedBy() {
        
        var salaryParameterEffectBy = $("#salaryParameterEffectBy").val();
        if (salaryParameterEffectBy == 1) {
            $("#salaryParameterAmountDiv").show();
            $("#salaryParameterPercentageDiv").hide();
            $("#salaryParameterPercentage").val(0);
        } else if (salaryParameterEffectBy == 2) {
            $("#salaryParameterPercentageDiv").show();
            $("#salaryParameterAmountDiv").hide();
            $("#salaryParameterAmount").val(0);
        } else {
            $("#salaryParameterPercentageDiv").hide();
            $("#salaryParameterAmountDiv").hide();
        }
    }

    function getParamDetails(item) {
        $("#title").text("Edit");
        
        var ItemDetails = JSON.parse(item);
        $("#salaryParameterId").val(ItemDetails.salaryParameterId);
        $("#salaryParameter").val(ItemDetails.salaryParameter);
        $("#salaryParameterType").val(ItemDetails.salaryParameterType);
        $("#salaryParameterEffectBy").val(ItemDetails.salaryParameterEffectBy);
        $("#salaryParameterAmount").val(ItemDetails.salaryParameterAmount);
        $("#salaryParameterPercentage").val(ItemDetails.salaryParameterPercentage);
        console.log("item=>", ItemDetails.salaryParameterId);
        getParamsEffectedBy();
    }

    function clearParams() {
        $("#title").text("Add");
        $("#salaryParameterId").val(0);
        $("#salaryParameter").val("");
        $("#salaryParameterType").val("");
        $("#salaryParameterEffectBy").val("");
        $("#salaryParameterAmount").val("");
        $("#salaryParameterPercentage").val("");
    }
</script>
<?= $this->endSection(); ?>