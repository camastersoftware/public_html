<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
    .modal-header {
        border-bottom-color: #d5dfea;
        background-color:#F99D27;
        padding: 8px 8px;
    }

    .income-tax-head {
        background: #ffc800;
        padding:10px;
        margin-bottom:0px;
        font-weight:bold;
    }

    table.dataTable {
        margin-top: 0px !important; 
    }

    .tablepress td, .tablepress th {
        font-weight: 600;
    }

    td.column-1 {
        font-size:14px;
    }

    .tablepress tbody tr:first-child td {
        background: #ffffff;
    }

    .modal-header h4{
        text-align: center;
    }

    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
    }
    
    .getActModal .box{
        cursor: pointer !important;
    }
    
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
    
    .tablepress td {
        font-weight: 400 !important;
    }
    
    .tablepress thead th {
        background-color: #005495 !important;
    }
    
    .demo-checkbox .box-header {
        background-color: #005495 !important;
        border-radius: 10px !important;
    }
    
    .demo-checkbox .box-header.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
    }
    
    .dataTables_wrapper .form-control{
        margin: 0px !important;
    }
    
    .discontinueClass td {
      color: #9d9c97 !important;
    }
    
</style>

<?php
    
    $bill_work_map_id="";
    $billId="";
    $billDate="";
    $billNo="";
    $billServiceAccCode="";
    $isLumpsum="";
    $lumpsumAmt="";
    $totalAmt="";
    $taxType="";
    $cgst="";
    $sgst="";
    $igst="";
    $cgstAmt="";
    $sgstAmt="";
    $igstAmt="";
    $totalBillAmt="";
    $billNote="";
    
    if(!empty($workDataArr['bill_work_map_id']))
    {
        $bill_work_map_id=$workDataArr['bill_work_map_id'];
    }

    if(!empty($workDataArr['billId']))
    {
        $billId=$workDataArr['billId'];
    }

    if(check_valid_date($workDataArr['billDate']))
    {
        $billDate=date('Y-m-d', strtotime($workDataArr['billDate']));
    }

    if(!empty($workDataArr['billNo']))
    {
        $billNo=$workDataArr['billNo'];
    }

    if(!empty($workDataArr['billServiceAccCode']))
    {
        $billServiceAccCode=$workDataArr['billServiceAccCode'];
    }

    if(!empty($workDataArr['isLumpsum']))
    {
        $isLumpsum=$workDataArr['isLumpsum'];
    }
    
    if(!empty($workDataArr['lumpsumAmt']))
    {
        $lumpsumAmt=$workDataArr['lumpsumAmt'];
    }
    
    if(!empty($workDataArr['totalAmt']))
    {
        $totalAmt=$workDataArr['totalAmt'];
    }
    
    if(!empty($workDataArr['taxType']))
    {
        $taxType=$workDataArr['taxType'];
    }
    
    if(!empty($workDataArr['cgst']))
    {
        $cgst=$workDataArr['cgst'];
    }
    
    if(!empty($workDataArr['sgst']))
    {
        $sgst=$workDataArr['sgst'];
    }
    
    if(!empty($workDataArr['igst']))
    {
        $igst=$workDataArr['igst'];
    }
    
    if(!empty($workDataArr['cgstAmt']))
    {
        $cgstAmt=$workDataArr['cgstAmt'];
    }
    
    if(!empty($workDataArr['sgstAmt']))
    {
        $sgstAmt=$workDataArr['sgstAmt'];
    }
    
    if(!empty($workDataArr['igstAmt']))
    {
        $igstAmt=$workDataArr['igstAmt'];
    }
    
    if(!empty($workDataArr['totalBillAmt']))
    {
        $totalBillAmt=$workDataArr['totalBillAmt'];
    }
    
    if(!empty($workDataArr['billNote']))
    {
        $billNote=$workDataArr['billNote'];
    }
?>

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?= $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url($backUrl); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <form action="<?= base_url('update-single-ddf-bill'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row form-group mb-2">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <h3 class="font-weight-bold m-0" >
                                            <?= $workClientName; ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row form-group mb-2">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <h4 class="font-weight-bold m-0" >
                                            <?= (!empty($DDFName)) ? $DDFName : "N/A"; ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 text-left">
                                <span class="font-weight-bold">Due Date :&nbsp;</span>
                                <span class="font-weight-bold">
                                    <?= $DDdate; ?>
                                </span>
                            </div>
                            <div class="col-md-4 col-lg-4 text-center">
                                <span class="font-weight-bold">Periodicity :&nbsp;</span>
                                <span class="font-weight-bold">
                                    <?= $DDPeriodcity; ?>
                                </span>
                            </div>
                            <div class="col-md-4 col-lg-4 text-right">
                                <span class="font-weight-bold">Period :&nbsp;</span>
                                <span class="font-weight-bold">
                                    <?= $DDPeriod; ?> (AY : <?= $asmtYear; ?>)
                                </span>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <hr>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Bill No<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="billNo" id="billNo" placeholder="Enter Bill No" value="<?= $billNo; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Bill Date<small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="billDate" id="billDate" placeholder="Enter Bill Date" value="<?= $billDate; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Service Accounting Code<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="billServiceAccCode" id="billServiceAccCode" placeholder="Enter Service Accounting Code" value="<?= $billServiceAccCode; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <label>Fees for Professional Services rendered as under : <small class="text-danger">*</small></label>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <button type="button" class="waves-effect waves-light btn btn-sm btn-submit addBillRow">
                                            <i class="fa fa-plus"></i>&nbsp;Add
                                        </button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                <thead>
                                                    <tr class="row-1">
                                                        <th class="column-7" nowrap width="80%">Description</th>
                                                        <th class="column-3" nowrap width="10%">Amount</th>
                                                        <th class="column-2" nowrap width="10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row-hover" id="billBody">
                                                <?php if(!empty($billDescArr)): ?>
                                                        <?php foreach($billDescArr AS $k_row => $e_desc): ?>
                                                        <tr class="row-1 billRow">
                                                            <td class="column-7 text-center" width="80%">
                                                                <?php
                                                                    $billDesc = $e_desc['description'];
                                                                    $billDescVal = (!empty($billDesc)) ? htmlspecialchars_decode(html_entity_decode($billDesc)) : "";
                                                                ?>
                                                                <textarea type="text" class="form-control textarea" name="description[]" rows="3"><?= $billDescVal; ?></textarea>
                                                            </td>
                                                            <td class="column-3 text-center" width="10%">
                                                                <input type="text" class="form-control billAmtInput calBillAmt" name="amount[]" value="<?= (!empty($e_desc['amount'])) ? $e_desc['amount'] : 0; ?>" <?php if($isLumpsum == 1): ?>readonly<?php endif; ?> >
                                                                <input type="hidden" name="billDescptionId[]" value="<?= $e_desc['billDescptionId']; ?>" >
                                                            </td>
                                                            <td class="column-2 text-center" width="10%">
                                                                <button type="button" class="waves-effect waves-light btn btn-sm btn-danger removeBillRow">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
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
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-8 col-lg-7"></div>
                                    <div class="col-md-4 col-lg-5">
                                        <div class="form-group row">
                                            <div class="col-md-8 text-right">
                                                <label>Do you want to charge in lump sum<small class="text-danger">*</small></label>
                                            </div>
                                            <div class="col-md-4">
                                                <input name="isLumpsum" type="radio" id="isLumpsumYes" class="radio-col-success isLumpsum" value="1" <?php if($isLumpsum == 1): ?>checked<?php endif; ?> />
                                                <label for="isLumpsumYes">Yes</label>
                                                <input name="isLumpsum" type="radio" id="isLumpsumNo" class="radio-col-danger isLumpsum" value="2" <?php if($isLumpsum == 2): ?>checked<?php endif; ?> <?php if(empty($isLumpsum)): ?>checked<?php endif; ?> />
                                                <label for="isLumpsumNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-8 col-lg-8"></div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label>All the above charged in lump sum <small class="text-danger">*</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control calBillAmt" name="lumpsumAmt" id="lumpsumAmt" value="<?= $lumpsumAmt; ?>" <?php if($isLumpsum != 1): ?>readonly<?php endif; ?> required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-10 col-lg-10"></div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <label>Total <small class="text-danger">*</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control calBillAmt" name="totalAmt" id="totalAmt" value="<?= $totalAmt; ?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-8 col-lg-8"></div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="isBillingDone">Select :</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input name="taxType" type="radio" id="taxTypeCgstIgst" class="radio-col-success taxType" value="1" <?php if($taxType == 1): ?>checked<?php endif; ?> <?php if(empty($taxType)): ?>checked<?php endif; ?> />
                                                <label for="taxTypeCgstIgst">CGST & SGST</label>
                                                <input name="taxType" type="radio" id="taxTypeIgst" class="radio-col-success taxType" value="2"  <?php if($taxType == 2): ?>checked<?php endif; ?> />
                                                <label for="taxTypeIgst">IGST</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 cgstDiv">
                                <div class="row">
                                    <div class="col-md-8 col-lg-8"></div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <label>CGST (%)<small class="text-danger">*</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control calBillAmt" name="cgst" id="cgstPercentage" value="<?= $cgst; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <label>CGST<small class="text-danger">*</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control calBillAmt" name="cgstAmt" id="cgstAmt" value="<?= $cgstAmt; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 sgstDiv">
                                <div class="row">
                                    <div class="col-md-8 col-lg-8"></div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <label>SGST (%)<small class="text-danger">*</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control calBillAmt" name="sgst" id="sgstPercentage" value="<?= $sgst; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <label>SGST<small class="text-danger">*</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control calBillAmt" name="sgstAmt" id="sgstAmt" value="<?= $sgstAmt; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 igstDiv">
                                <div class="row">
                                    <div class="col-md-8 col-lg-8"></div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <label>IGST (%)<small class="text-danger">*</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control calBillAmt" name="igst" id="igstPercentage" value="<?= $igst; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <label>SGST<small class="text-danger">*</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control calBillAmt" name="igstAmt" id="igstAmt" value="<?= $igstAmt; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-10 col-lg-10"></div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <label>Total<small class="text-danger">*</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="totalBillAmt" id="totalBillAmt" value="<?= $totalBillAmt; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea class="form-control textarea" name="billNote" placeholder="Enter Notes" rows="8"><?= $billNote; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0 text-center">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name='bill_work_map_id' value="<?= $bill_work_map_id; ?>" />
                                    <input type="hidden" name='billId' value="<?= $billId; ?>" />
                                    <input type="hidden" name='actId' value="<?= $actId; ?>" />
                                    <input type="hidden" name='clientId' value="<?= $clientId; ?>" />
                                    <input type="hidden" name='workId' value="<?= $workId; ?>" />
                                    <button type="submit" name="submit" class="waves-effect waves-light btn btn-sm btn-submit">Submit</button>
                                    <a href="<?php echo base_url($backUrl); ?>">
                                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<input type="hidden" id="hiddenBillRow" value='
    <tr class="row-1 billRow">
        <td class="column-7 text-center" width="80%">
            <textarea type="text" class="form-control dynamicTextarea" name="description[]" rows="3"></textarea>
        </td>
        <td class="column-3 text-center" width="10%">
            <input type="text" class="form-control billAmtInput calBillAmt" name="amount[]" value="0" >
            <input type="hidden" name="billDescptionId[]" value="" >
        </td>
        <td class="column-2 text-center" width="10%">
            <button type="button" class="waves-effect waves-light btn btn-sm btn-danger removeBillRow">
                <i class="fa fa-minus"></i>
            </button>
        </td>
    </tr>
' />

<input type="hidden" id="hiddenEmptyBillRow" value='
    <tr class="row-1 emptyBillRow">
        <td class="column-2" colspan="8">
            <center>No records</center>
        </td>
    </tr>
' />

<?php
    $billDescCount = count($billDescArr);
?>

<script type="text/javascript">
            
    $(document).ready(function(){

        var billDescCount = parseInt("<?= $billDescCount; ?>");

        var hiddenEmptyBillRow = $('#hiddenEmptyBillRow').val();
        
        if(billDescCount==0)
            $('#billBody').html(hiddenEmptyBillRow);
        
        $('body').on('click', '.addBillRow', function(){
            
            $('.emptyBillRow').hide();

            var hiddenBillRow = $('#hiddenBillRow').val();
            
            var newEditor = $(hiddenBillRow).appendTo('#billBody').find('.dynamicTextarea');
            
            newEditor.wysihtml5({
                toolbar: {
                    "link": false, //Button to insert a link. Default true
                    "image": false, //Button to insert an image. Default true
                }
            });	

            $('#isEmptyBillRow').val("no");
        });
        
        $('body').on('click', '.removeBillRow', function(){
            
            $(this).parents('.billRow').remove();
            $('.calBillAmt').trigger('keyup');
            
            // var billBody = $('#billBody').html();
            
            // console.log('billBody', billBody.length);
        });
        
        $('.isLumpsum').on('change', function(){
            
            $('.billAmtInput').each(function(){
                $(this).val(0);
                $(this).prop('readonly', true);
            })
            
            $('#lumpsumAmt').val(0);
            $('#lumpsumAmt').prop('readonly', true);
            
            var isLumpsum = $(this).val();
            
            if(isLumpsum==1)
            {
                $('.billAmtInput').each(function(){
                    $(this).val(0);
                    $(this).prop('readonly', true);
                })
            
                $('#lumpsumAmt').val(0);
                $('#lumpsumAmt').prop('readonly', false);
            }
            else if(isLumpsum==2)
            {
                $('.billAmtInput').each(function(){
                    $(this).val(0);
                    $(this).prop('readonly', false);
                })
                
                $('#lumpsumAmt').val(0);
                $('#lumpsumAmt').prop('readonly', true);
            }
        });
        
        $('.taxType').on('change', function(){
            
            $('.cgstDiv').hide();
            $('.sgstDiv').hide();
            $('.igstDiv').hide();
            
            var taxType = $(this).val();
            
            if(taxType==1)
            {
                $('.cgstDiv').show();
                $('.sgstDiv').show();
                $('.igstDiv').hide();
            }
            else if(taxType==2)
            {
                $('.cgstDiv').hide();
                $('.sgstDiv').hide();
                $('.igstDiv').show();
            }
        });
        
        $('body').on('keyup', '.calBillAmt', function(){
            
            var sum_amount = 0;
            $('.billAmtInput').each(function(){
                sum_amount += parseFloat($(this).val());
            })
            
            var totalAmt = 0;
            
            if(sum_amount!=0)
            {
                totalAmt = sum_amount;
            }
            
            var lumpsumAmt = ($('#lumpsumAmt').val()!="") ? parseFloat($('#lumpsumAmt').val()) : 0;
            
            if(lumpsumAmt!=0)
            {
                totalAmt=lumpsumAmt;
            }
            
            $('#totalAmt').val(totalAmt);
            
            var cgstPercentage = parseFloat($('#cgstPercentage').val()); 
            var sgstPercentage = parseFloat($('#sgstPercentage').val());
            var igstPercentage = parseFloat($('#igstPercentage').val());
            
            var cgstAmt = 0; 
            var sgstAmt = 0;
            var igstAmt = 0;
            
            var taxType = $(".taxType").val();
            
            if(!isNaN(cgstPercentage) && !isNaN(sgstPercentage) && !isNaN(igstPercentage))
            {
                if(taxType==1)
                {
                    cgstAmt = parseFloat(((cgstPercentage*totalAmt)/100).toFixed(2));
                    sgstAmt = parseFloat(((sgstPercentage*totalAmt)/100).toFixed(2));
                    igstAmt = 0;
                }
                else if(taxType==2)
                {
                    cgstAmt = 0;
                    sgstAmt = 0;
                    igstAmt = parseFloat(((igstPercentage*totalAmt)/100).toFixed(2));
                }
                
            }

            $('#cgstAmt').val(cgstAmt);
            $('#sgstAmt').val(sgstAmt);
            $('#igstAmt').val(igstAmt);
            
            var totalBillAmt = totalAmt+cgstAmt+sgstAmt+igstAmt;
            
            $('#totalBillAmt').val(totalBillAmt);
            
        });
        
        $('.taxType:checked').trigger('change');
        // $('.isLumpsum:checked').trigger('change');
    });

</script>

<?= $this->endSection(); ?>