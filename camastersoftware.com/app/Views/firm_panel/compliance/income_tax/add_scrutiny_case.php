<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .tablepress thead tr, .tablepress thead th {
        border: 1px solid #ddd;
        color: #fff;
        font-size: 14px !important;
    }
    
    .tablepress tbody {
        font-size: 14px !important;
    }
    
    td.column-1 {
        text-align: center;
        font-weight: normal;
        font-size: 16px;
    }
    
    .tablepress tbody tr:first-child td {
        background: none;
    }
    
    .tablepress tbody tr:nth-child(4) td.column-1 {
        background: none;
    }
    
    .tablepress tbody td, .tablepress tfoot th {
        border: 1px solid #015aacab !important;
        color: #000;
    }
    
    table.dataTable {
        clear: both;
        margin-top: 0px !important; 
    }
    
    .wizard-content .wizard > .content > .body {
        padding: 0px 20px;
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
    
    .due-month{
        background:#F99D27;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }
    
    .due-month label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .tablepress {
        background: #eff8ff !important;
    }
    
    .card_bg_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 0px !important;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }
    
    .form_bg_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px !important;
        border: 1px solid #8c8c8cab !important;
        background: #fdfeff !important;
    }

    .tablepress {
        background: #eff8ff !important;
    }
</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h6>
                    <button type="button" class="waves-effect waves-light btn btn-sm btn-dark get_back" style="">Back</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body card_bg_format">
                    <form action="<?= base_url('insert-scrutiny-case'); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="state due-month">
                                                            <h4 class="text-white font-weight-bold m-0">Basic Details</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Client Name:</label>
                                                            <select class="custom-select form-control" name="fkClientId" id="scrClientId" >
                                                                <option value="">Select Client</option>
                                                                <?php if(!empty($clientListArr)): ?>
                                                                    <?php foreach($clientListArr AS $e_clnt): ?>
                                                                        <option value="<?php echo $e_clnt['clientId']; ?>" data-pan="<?= $e_clnt["clientPanNumber"]; ?>"><?php echo $e_clnt['clientName']; ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="scrClientPan">PAN :</label>
                                                            <input type="text" class="form-control" name="scrClientPan" id="scrClientPan" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="finYear">A.Y :</label>
                                                            <select class="custom-select form-control" name="finYear" id="finYear">
                                                                <option value="">Select Year</option>
                                                                <?php for($d=date("Y"); $d>=2000; $d--): ?>
                                                                    <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                                                    <option value="<?php echo $dueYr; ?>" ><?php echo $dueYr; ?></option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="acknowledgmentNo">Acknowledgment :</label>
                                                            <input type="text" class="form-control" name="acknowledgmentNo" id="acknowledgmentNo">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="eFillingDate">E-Filling Date :</label>
                                                            <input type="date" class="form-control" name="eFillingDate" id="eFillingDate">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mt-0">
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="state due-month">
                                                            <h4 class="text-white font-weight-bold m-0">Intimation Details</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row mb-0">
                                                    <div class="offset-md-4 col-md-4">
                                                        <div class="form-group row">
                                                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                                <thead>
                                                                    <tr class="row-1">
                                                                        <th class="column-2" nowrap="">Particulars (As per)</th>
                                                                        <th class="column-3" nowrap="">Return of Income</th>
                                                                        <th class="column-4" nowrap="">Intimation</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="row-hover">
                                                                    <tr class="row-1">
                                                                        <td class="column-2">Total Income</td>
                                                                        <td class="column-2 text-right">
                                                                            <input type="text" class="form-control" name="totalIncome" id="totalIncome" onkeypress="validateNum(event)" > 
                                                                        </td>
                                                                        <td class="column-2 text-right">
                                                                            <input type="text" class="form-control" name="intiTotalIncome" id="intiTotalIncome" onkeypress="validateNum(event)" >
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="row-1">
                                                                        <td class="column-2">Refund</td>
                                                                        <td class="column-2 text-right">
                                                                            <input type="text" class="form-control" name="refundClaimed" id="refundClaimed" onkeypress="validateNum(event)" >
                                                                        </td>
                                                                        <td class="column-2 text-right">
                                                                            <input type="text" class="form-control" name="refundTotalAmt" id="refundTotalAmt" onkeypress="validateNum(event)" >
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="row-1">
                                                                        <td class="column-2">Demand</td>
                                                                        <td class="column-2 text-right">-</td>
                                                                        <td class="column-2 text-right">
                                                                            <input type="text" class="form-control" name="demandTotalAmt" id="demandTotalAmt" onkeypress="validateNum(event)" >
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mt-0">
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="state due-month">
                                                            <h4 class="text-white font-weight-bold m-0">Details of Notice</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Name of the Assessing Officer : </label>
                                                            <input type="text" name="assessingOfficer" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label>Ward No : </label>
                                                            <input type="text" name="wardNo" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            <label>Location : </label>
                                                            <input type="text" name="placeNo" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Name of the Inspector : </label>
                                                            <input type="text" name="inspectorName" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Name of the Tax Assistant : </label>
                                                            <input type="text" name="taxAssistantName" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label>Remark : </label>
                                                            <textarea name="scRemarks" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mt-0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12 mt-30 text-center">
                                                <button type="button" class="waves-effect waves-light btn btn-dark get_back">Back</button>
                                                <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<script>
    $(document).ready(function(){

        $("#scrClientId").on("change", function(){
            var selectedPan = $('#scrClientId option:selected').data('pan');
            if(selectedPan)
                $("#scrClientPan").val(selectedPan);
            else
                $("#scrClientPan").val("");
        });

    });
</script>

<?= $this->endSection(); ?>