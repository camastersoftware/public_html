<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>

    .tabcontent-border {
        border: none;
        border-top: 0px;
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
    
    .heading-act {
        background:#00669d;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
        color:#fff;
    }
    
    .heading-act label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .table.dataTable-act {
        margin-top: 0px !important; 
        font-size: 12px !important;
        clear: both;
        margin-bottom: 6px !important;
        max-width: none !important;
        border-collapse: separate !important;
    }
    
    .tablepress thead tr, .tablepress thead th {
        border: 1px solid #ddd;
        color: #fff;
        font-size: 16px;
    }
    
    .tablepress tbody {
        font-size: 16px;
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
    
    .box-body {
        padding: 0.1rem 0.1rem;
        /* -ms-flex: 1 1 auto; */
        flex: 1 1 auto;
        border-radius: 10px;
    }
    
    .modal-header {
        
        border-bottom-color: #d5dfea;
        background-color: #F99D27;
        padding: 8px 8px;
    }
    
    .theme-primary .btn-success1 {
        background-color: #1e613b !important;
        border-color: #1e613b !important;
        color: #ffffff !important;
        width: 100px;
        font-size: 13px;
    }
    
    .theme-primary a:hover, .theme-primary a:focus {
        color: #303030 !important;
    }
    
    a {
        color: #303030;
    }

    .sub_btn{
        width: 80px !important;
    }
    
    .theme-primary .btnPrimClr {
        margin-top: 0px !important;
        height: 25px !important;
        margin-bottom: 0px !important;   
    }
    
    .actionText{
        font-size: 11px !important;
    }
    
    .proj_modal_bg{
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }
    
    .bg_prjt_format {
      padding: 1.1rem 1.1rem;
      flex: 1 1 auto;
      border-radius: 10px;
      border: 1px solid #015aacab !important;
      background: #96c7f242 !important;
    }
</style>
<?php
    $empSalId = "";
    $grossSalaryAmtMth = 0;
    $grossSalaryAmtYr = 0;
    $dedctnSalaryAmtMth = 0;
    $dedctnSalaryAmtYr = 0;
    $totalAmtPayableMth = 0;
    $totalAmtPayableYr = 0;
    if(!empty($empSalaryArr))
    {
        $empSalId=$empSalaryArr['empSalId'];
        $grossSalaryAmtMth=$empSalaryArr['grossSalaryAmtMth'];
        $grossSalaryAmtYr=$empSalaryArr['grossSalaryAmtYr'];
        $dedctnSalaryAmtMth=$empSalaryArr['dedctnSalaryAmtMth'];
        $dedctnSalaryAmtYr=$empSalaryArr['dedctnSalaryAmtYr'];
        $totalAmtPayableMth=$empSalaryArr['totalAmtPayableMth'];
        $totalAmtPayableYr=$empSalaryArr['totalAmtPayableYr'];
    }
?>
<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url('employees'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <form action="<?php echo base_url('update-employee-salary-payable'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="row mt-10 m-30">
                            <div class="col-md-8 offset-md-2">
                                <div class="row bg_prjt_format">
                                    <div class="offset-lg-1 col-md-10">
                                        <div class="row form-group">
                                            <div class="col-md-12 col-lg-12 text-center">
                                                <span class="font-weight-bold h4" >
                                                    <?php echo $getUserData['userFullName']; ?>
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-left">
                                                <span class="font-weight-bold">PAN :&nbsp;</span>
                                                <span class="font-weight-bold">
                                                    <?php echo $getUserData['userPan']; ?>
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 text-right">
                                                <span class="font-weight-bold">Designation :&nbsp;</span>
                                                <span class="font-weight-bold">
                                                    <?php echo $getUserData['userDesgn']; ?>
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="offset-lg-1 col-md-10">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4"></div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <label class="font-weight-bold h5">Monthly</label>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <label class="font-weight-bold h5">Yearly</label>
                                            </div>
                                        </div>
                                        <hr class="m-0 mb-10">
                                        <div class="row mb-20">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Salary Payment : 
                                                </span>
                                            </div>
                                        </div>
                                        <?php if(!empty($salPmtArr)): ?>
                                            <?php foreach($salPmtArr AS $e_slp): ?>
                                                <?php
                                                    $salaryParameterId = $e_slp['salaryParameterId'];
                                                    $empSalDivisionId = "";
                                                    $empSalDivisionMthAmt = 0;
                                                    $empSalDivisionYrAmt = 0;
                                                    if(isset($empSalDivisionDataArr[$salaryParameterId]))
                                                    {
                                                        $empSalData = $empSalDivisionDataArr[$salaryParameterId];
                                                        
                                                        $empSalDivisionId = $empSalData['empSalDivisionId'];
                                                        $empSalDivisionMthAmt = $empSalData['empSalDivisionMthAmt'];
                                                        $empSalDivisionYrAmt = $empSalData['empSalDivisionYrAmt'];
                                                    }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-4 col-lg-4">
                                                        <span class="h5" >
                                                            <input type="hidden" name="salaryParameterId[]" value="<?= $salaryParameterId; ?>">
                                                            <input type="hidden" name="empSalDivisionId[]" value="<?= $empSalDivisionId; ?>">
                                                            <?= $e_slp['salaryParameter']; ?> : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 text-center">
                                                        <div class="form-group offset-md-3 col-md-7">
                                                            <input type="text" class="form-control mthInput salPmtMth inputRTL" name="empSalDivisionMthAmt[]" data-id="<?= $salaryParameterId; ?>" onkeypress="validateNum(event);" value="<?= $empSalDivisionMthAmt; ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 text-center">
                                                        <div class="form-group offset-md-3 col-md-7">
                                                            <input type="text" class="form-control yrInput salPmtYr inputRTL" id="yrInput<?= $salaryParameterId; ?>" name="empSalDivisionYrAmt[]" onkeypress="validateNum(event);" value="<?= $empSalDivisionYrAmt; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Gross Salary (CTC) : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control grossSalaryAmtMth inputRTL" name="grossSalaryAmtMth" id="grossSalaryAmtMth" value="<?= $grossSalaryAmtMth; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control grossSalaryAmtYr inputRTL" name="grossSalaryAmtYr" id="grossSalaryAmtYr" value="<?= $grossSalaryAmtYr; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-20">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Deductions :
                                                </span>
                                            </div>
                                        </div>
                                        <?php if(!empty($salDedctnArr)): ?>
                                            <?php foreach($salDedctnArr AS $e_sld): ?>
                                                <?php
                                                    $salaryParameterId = $e_sld['salaryParameterId'];
                                                    $empSalDivisionId = "";
                                                    $empSalDivisionMthAmt = 0;
                                                    $empSalDivisionYrAmt = 0;
                                                    if(isset($empSalDivisionDataArr[$salaryParameterId]))
                                                    {
                                                        $empSalData = $empSalDivisionDataArr[$salaryParameterId];
                                                        
                                                        $empSalDivisionId = $empSalData['empSalDivisionId'];
                                                        $empSalDivisionMthAmt = $empSalData['empSalDivisionMthAmt'];
                                                        $empSalDivisionYrAmt = $empSalData['empSalDivisionYrAmt'];
                                                    }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-4 col-lg-4">
                                                        <span class="h5" >
                                                            <input type="hidden" name="salaryParameterId[]" value="<?= $salaryParameterId; ?>">
                                                            <input type="hidden" name="empSalDivisionId[]" value="<?= $empSalDivisionId; ?>">
                                                            <?= $e_sld['salaryParameter']; ?> : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 text-center">
                                                        <div class="form-group offset-md-3 col-md-7">
                                                            <input type="text" class="form-control mthInput salDedMth inputRTL" name="empSalDivisionMthAmt[]" data-id="<?= $salaryParameterId; ?>" onkeypress="validateNum(event);" value="<?= $empSalDivisionMthAmt; ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 text-center">
                                                        <div class="form-group offset-md-3 col-md-7">
                                                            <input type="text" class="form-control yrInput salDedYr inputRTL" id="yrInput<?= $salaryParameterId; ?>" name="empSalDivisionYrAmt[]" onkeypress="validateNum(event);" value="<?= $empSalDivisionYrAmt; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Total : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control dedctnSalaryAmtMth inputRTL" name="dedctnSalaryAmtMth" id="dedctnSalaryAmtMth" value="<?= $dedctnSalaryAmtMth; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control dedctnSalaryAmtYr inputRTL" name="dedctnSalaryAmtYr" id="dedctnSalaryAmtYr" value="<?= $dedctnSalaryAmtYr; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <span class="font-weight-bold h5" >
                                                    Total Amount Payable : 
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control totalAmtPayableMth inputRTL" name="totalAmtPayableMth" id="totalAmtPayableMth" value="<?= $totalAmtPayableMth; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <div class="form-group offset-md-3 col-md-7">
                                                    <input type="text" class="form-control totalAmtPayableYr inputRTL" name="totalAmtPayableYr" id="totalAmtPayableYr" value="<?= $totalAmtPayableYr; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-10 m-30">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <input type="hidden" name="empSalId" id="empSalId" value="<?= $empSalId; ?>">
                                        <input type="hidden" name="userId" id="userId" value="<?= $getUserData['userId']; ?>">
                                        <a href="<?= base_url('employees'); ?>">
                                            <button type="button" class="btn btn-dark text-left">Back</button>
                                        </a>
                                        <button type="submit" name="submit" class="btn btn-success btn-submit text-left">Submit</button>
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
</section>
<!-- /.content -->

<script type="text/javascript">
    
    $(document).ready(function(){
        
        $('.mthInput').on('input', function(){
            
            var salaryParameterId = $(this).data('id');
            
            if($(this).val()!="")
                var mthInputAmt = parseInt($(this).val());
            else
                var mthInputAmt = 0;
                
            var yrInputAMt = mthInputAmt*12;
            
            $('#yrInput'+salaryParameterId).val(yrInputAMt);
            
            var salPmtMthAmt = 0;
            $('.salPmtMth').each(function(i, val){
                salPmtMthVal=($(val).val()!="") ? $(val).val() : 0;
                salPmtMthAmt+=parseInt(salPmtMthVal);
            });
            $('#grossSalaryAmtMth').val(salPmtMthAmt);
            
            var salPmtYrAmt = 0;
            $('.salPmtYr').each(function(i, val){
                salPmtYrVal=($(val).val()!="") ? $(val).val() : 0;
                salPmtYrAmt+=parseInt(salPmtYrVal);
            });
            $('#grossSalaryAmtYr').val(salPmtYrAmt);
            
            var salDedMthAmt = 0;
            $('.salDedMth').each(function(i, val){
                salDedMthVal=($(val).val()!="") ? $(val).val() : 0;
                salDedMthAmt+=parseInt(salDedMthVal);
            });
            $('#dedctnSalaryAmtMth').val(salDedMthAmt);
            
            var salDedYrAmt = 0;
            $('.salDedYr').each(function(i, val){
                salDedYrVal=($(val).val()!="") ? $(val).val() : 0;
                salDedYrAmt+=parseInt(salDedYrVal);
            });
            $('#dedctnSalaryAmtYr').val(salDedYrAmt);
            
            var mthPmt = salPmtMthAmt-salDedMthAmt;
            var yrPmt = salPmtYrAmt-salDedYrAmt;
            
            $('#totalAmtPayableMth').val(mthPmt);
            $('#totalAmtPayableYr').val(yrPmt);
            
        });        
        
    });

</script>

<?= $this->endSection(); ?>