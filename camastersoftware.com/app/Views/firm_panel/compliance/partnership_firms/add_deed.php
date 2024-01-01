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
    
    .main_cont_section span, .main_cont_section label, .main_cont_section div, .main_cont_section th, .main_cont_section td{
        font-size: 16px !important;
    }
    
    .tablepress {
        background: #eff8ff !important;
    }
    
    .noticeDivLine{
        border-top-style: double !important;
        border-top-color: #005495 !important;
    }
</style>
<?php
    $clientNameVar="N/A";
    if(!empty($clientDataArr['clientBussOrganisation']))
    {
        $clientNameVar=$clientDataArr['clientBussOrganisation'];
    }
    
    $deedType="";
    $executionDate="";
    $effectiveDate="";
    $formNumber = "";
    $formFiledOn = "";
    $amountPaid = "";
    $registrationNumber = "";
    $registrationOn = "";
    $extractRecvdOn = "";
    $registeredAddress= "";
    $adminOfficeAddress = "";
    $factoryAddress = "";
    $remarks ="";
    
    if(!empty($ptFirmDeedArr['deedType']))
    {
        $deedType=$ptFirmDeedArr['deedType'];
    }
    
    if(!empty($ptFirmDeedArr['executionDate']))
    {
        $executionDate=$ptFirmDeedArr['executionDate'];
    }
    
    if(!empty($ptFirmDeedArr['effectiveDate']))
    {
        $effectiveDate=$ptFirmDeedArr['effectiveDate'];
    }
    
    if(!empty($ptFirmDeedArr['formNumber']))
    {
        $formNumber=$ptFirmDeedArr['formNumber'];
    }
    
    if(!empty($ptFirmDeedArr['formFiledOn']))
    {
        $formFiledOn=$ptFirmDeedArr['formFiledOn'];
    }
    
    if(!empty($ptFirmDeedArr['amountPaid']))
    {
        $amountPaid=$ptFirmDeedArr['amountPaid'];
    }
    
    if(!empty($ptFirmDeedArr['registrationNumber']))
    {
        $registrationNumber=$ptFirmDeedArr['registrationNumber'];
    }
    
    if(!empty($ptFirmDeedArr['registrationOn']))
    {
        $registrationOn=$ptFirmDeedArr['registrationOn'];
    }
    
    if(!empty($ptFirmDeedArr['extractRecvdOn']))
    {
        $extractRecvdOn=$ptFirmDeedArr['extractRecvdOn'];
    }
    
    if(!empty($ptFirmDeedArr['registeredAddress']))
    {
        $registeredAddress=$ptFirmDeedArr['registeredAddress'];
    }
    
    if(!empty($ptFirmDeedArr['adminOfficeAddress']))
    {
        $adminOfficeAddress=$ptFirmDeedArr['adminOfficeAddress'];
    }
    
    if(!empty($ptFirmDeedArr['factoryAddress']))
    {
        $factoryAddress=$ptFirmDeedArr['factoryAddress'];
    }
    
    if(!empty($ptFirmDeedArr['remarks']))
    {
        $remarks=$ptFirmDeedArr['remarks'];
    }
?>
<!-- Main content -->
<section class="content mt-35 main_cont_section">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?= base_url('partnership-firm-deeds/'.$clientId); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <form action="<?php echo base_url('add-partnership-firm-deed'); ?>" method="POST" >
                        <div class="row mt-10 m-30">
                            <div class="col-md-12">
                                <?php if(!empty($ptFirmDeedArr)): ?>
                                <div class="alert alert-warning-light alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    Details copied for convenience, Please Edit.
                                </div>
                                <?php endif; ?>
                                <div class="row bg_prjt_format">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 text-center">
                                                <span class="font-weight-bold" >
                                                    <?= $clientNameVar; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="state due-month">
                                                    <label class="text-white">Details of Deed</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <span class="font-weight-bold" >
                                                            Type of Deed : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="custom-select form-control" name="deedType" >
                                                            <option value="">Select</option>
                                                            <?php if(!empty($deedTypeArr)): ?>
                                                                <?php foreach($deedTypeArr AS $e_deed): ?>
                                                                    <option value="<?php echo $e_deed['deedTypeId']; ?>" <?php if($e_deed['deedTypeId']==$deedType): ?> selected <?php endif; ?>><?php echo $e_deed['deedTypeName']; ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <span class="font-weight-bold" >
                                                            Date of Execution : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="date" class="form-control" name="executionDate" id="executionDate" value="<?= (check_valid_date($executionDate)) ? $executionDate:""; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <span class="font-weight-bold" >
                                                            Effective Date : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="date" class="form-control" name="effectiveDate" id="effectiveDate" value="<?= (check_valid_date($effectiveDate)) ? $effectiveDate:""; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="state due-month">
                                                    <label class="text-white">Details of Registration</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <span class="font-weight-bold" >
                                                            Form No : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="custom-select form-control" name="formNumber" >
                                                            <option value="">Select</option>
                                                            <?php if(!empty($formNoArr)): ?>
                                                                <?php foreach($formNoArr AS $e_formno): ?>
                                                                    <option value="<?php echo $e_formno['formNumberId']; ?>" <?php if($e_formno['formNumberId']==$formNumber): ?> selected <?php endif; ?>><?php echo $e_formno['formNumber']; ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <span class="font-weight-bold" >
                                                            Form Filed On : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="date" class="form-control" name="formFiledOn" id="formFiledOn" value="<?= (check_valid_date($formFiledOn)) ? $formFiledOn:""; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <span class="font-weight-bold" >
                                                            Amount paid : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="amountPaid" id="amountPaid" value="<?= $amountPaid; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <span class="font-weight-bold" >
                                                            Regn no : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="registrationNumber" id="registrationNumber" value="<?= $registrationNumber; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <span class="font-weight-bold" >
                                                            Regd On : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="date" class="form-control" name="registrationOn" id="registrationOn" value="<?= (check_valid_date($registrationOn)) ? $registrationOn:""; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <span class="font-weight-bold" >
                                                            Extract Received : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="date" class="form-control" name="extractRecvdOn" id="extractRecvdOn" value="<?= (check_valid_date($extractRecvdOn)) ? $extractRecvdOn:""; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="state due-month">
                                                    <label class="text-white">Details of Partners</label>
                                                    <a href="javascript:void(0);">
                                                        <button type="button" class="waves-effect waves-light btn btn-sm btn-success float-right mr-2 addPartner">
                                                            <i class="fa fa-plus"></i>&nbsp;Add Partner
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                        <thead>
                                                            <tr class="row-1">
                                                                <th class="column-2" nowrap width="5%">Name of the Partner</th>
                                                                <th class="column-3" nowrap width="5%">Whether</th>
                                                                <th class="column-4" nowrap width="5%" colspan="2">Date of</th>
                                                                <th class="column-4" nowrap width="5%" colspan="2">Percentage</th>
                                                                <th class="column-4" nowrap width="5%" colspan="2">Percentage</th>
                                                                <th class="column-1" nowrap width="5%">Action</th>
                                                            </tr>
                                                            <tr class="row-1">
                                                                <th class="column-2" nowrap width="5%"></th>
                                                                <th class="column-3" nowrap width="5%">Working</th>
                                                                <th class="column-4" nowrap width="5%">Admission</th>
                                                                <th class="column-4" nowrap width="5%">Retirement</th>
                                                                <th class="column-4" nowrap width="5%">Salary</th>
                                                                <th class="column-4" nowrap width="5%">Interest</th>
                                                                <th class="column-4" nowrap width="5%">Profit</th>
                                                                <th class="column-6" nowrap width="5%">Loss</th>
                                                                <th class="column-1" nowrap width="5%">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="row-hover partnerTbody">
                                                            <?php if(!empty($firmPtArr)): ?>
                                                                <?php foreach($firmPtArr AS $e_firm_pt): ?>
                                                                <tr class="row-1 partnerRow">
                                                                    <td class="column-3">
                                                                        <input type="text" class="form-control" name="firmPartnerName[]" value="<?= $e_firm_pt['firmPartnerName']; ?>">
                                                                    </td>
                                                                    <td class="column-4">
                                                                        <select class="custom-select form-control" name="isWorking[]" >
                                                                            <option value="">Select</option>
                                                                            <option value="1"<?php if($e_firm_pt['isWorking']=="1"): ?> selected <?php endif; ?>>Yes</option>
                                                                            <option value="2"<?php if($e_firm_pt['isWorking']=="2"): ?> selected <?php endif; ?>>No</option>
                                                                        </select> 
                                                                    </td>
                                                                    <td class="column-4">
                                                                        <input type="date" class="form-control" name="admissionDate[]" value="<?= (check_valid_date($e_firm_pt['admissionDate'])) ? $e_firm_pt['admissionDate']:""; ?>">
                                                                    </td>
                                                                    <td class="column-5">
                                                                        <input type="date" class="form-control" name="retirementDate[]" value="<?= (check_valid_date($e_firm_pt['retirementDate'])) ? $e_firm_pt['retirementDate']:""; ?>">
                                                                    </td>	
                                                                    <td class="column-5">
                                                                        <input type="text" class="form-control" name="salaryPercentage[]" value="<?= $e_firm_pt['salaryPercentage']; ?>">
                                                                    </td>	
                                                                    <td class="column-5">
                                                                        <input type="text" class="form-control" name="interestPercentage[]" value="<?= $e_firm_pt['interestPercentage']; ?>">
                                                                    </td>	
                                                                    <td class="column-5">
                                                                        <input type="text" class="form-control" name="profitPercentage[]" value="<?= $e_firm_pt['profitPercentage']; ?>">
                                                                    </td>	
                                                                    <td class="column-5">
                                                                        <input type="text" class="form-control" name="lossPercentage[]" value="<?= $e_firm_pt['lossPercentage']; ?>">
                                                                    </td>
                                                                    <td class="column-5 text-center">
                                                                        <input type="hidden" name="firmPartnerId[]" value="<?= $e_firm_pt['firmPartnerId']; ?>">
                                                                        <button type="button" class="waves-effect waves-light btn btn-sm btn-danger deletePartner">
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
                                    <div class="col-md-12 col-lg-12">
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="state due-month">
                                                    <label class="text-white">Address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <span class="font-weight-bold" >
                                                            Registered Address : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <textarea class="form-control" name="registeredAddress" placeholder="Enter Registered Address"><?= $registeredAddress; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <span class="font-weight-bold" >
                                                            Administrative Office Address : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <textarea class="form-control" name="adminOfficeAddress" placeholder="Enter Administrative Office Address"><?= $adminOfficeAddress; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <span class="font-weight-bold" >
                                                            Factory Address : 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <textarea class="form-control" name="factoryAddress" placeholder="Enter Factory Address"><?= $factoryAddress; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="state due-month">
                                                    <label class="text-white">Changes in brief (Remarks)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <textarea class="form-control" name="remarks" placeholder="Enter Changes in brief (Remarks)"><?= $remarks; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-20">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button>
                                        <input type="hidden" name="fkClientId" id="fkClientId" value="<?= $clientId; ?>">
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

<input type="hidden" id="partnerRow" value='
    <tr class="row-1 partnerRow">
        <td class="column-3">
            <input type="text" class="form-control" name="firmPartnerName[]">
        </td>
        <td class="column-4">
            <select class="custom-select form-control" name="isWorking[]" >
                <option value="">Select</option>
                <option value="1">Yes</option>
                <option value="2">No</option>
            </select> 
        </td>
        <td class="column-4">
            <input type="date" class="form-control" name="admissionDate[]">
        </td>
        <td class="column-5">
            <input type="date" class="form-control" name="retirementDate[]">
        </td>	
        <td class="column-5">
            <input type="text" class="form-control" name="salaryPercentage[]">
        </td>	
        <td class="column-5">
            <input type="text" class="form-control" name="interestPercentage[]">
        </td>	
        <td class="column-5">
            <input type="text" class="form-control" name="profitPercentage[]">
        </td>	
        <td class="column-5">
            <input type="text" class="form-control" name="lossPercentage[]">
        </td>
        <td class="column-5 text-center">
            <button type="button" class="waves-effect waves-light btn btn-sm btn-danger deletePartner">
                <i class="fa fa-minus"></i>
            </button>
        </td>
    </tr>
'>

<script>

    $(document).ready(function(){
        
        $('body').on('click', '.addPartner', function(){
            var partnerRow = $('#partnerRow').val();
            $('.partnerTbody').append(partnerRow);
        });
        
        $('body').on('click', '.deletePartner', function(){
            $(this).parents('.partnerRow').remove();
        });
    });
        
</script>

<?= $this->endSection(); ?>