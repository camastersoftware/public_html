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
                    <div class="row mt-10 m-30">
                        <div class="col-md-12">
                            <div class="row bg_prjt_format">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 text-center">
                                            <h4 class="font-weight-bold" >
                                                <?= $clientNameVar; ?>
                                            </h4>
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
                                                    <span>
                                                        <?= (!empty($ptFirmDeedArr['deedTypeName'])) ? $ptFirmDeedArr['deedTypeName'] : "-"; ?>
                                                    </span>
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
                                                    <span>
                                                        <?= (check_valid_date($ptFirmDeedArr['executionDate'])) ? date("d-m-Y", strtotime($ptFirmDeedArr['executionDate'])) : "-"; ?>
                                                    </span>
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
                                                    <span>
                                                        <?= (check_valid_date($ptFirmDeedArr['effectiveDate'])) ? date("d-m-Y", strtotime($ptFirmDeedArr['effectiveDate'])) : "-"; ?>
                                                    </span>
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
                                                    <span>
                                                        <?= (!empty($ptFirmDeedArr['formNumber'])) ? $ptFirmDeedArr['formNumber'] : "-"; ?>
                                                    </span>
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
                                                    <span>
                                                        <?= (check_valid_date($ptFirmDeedArr['formFiledOn'])) ? date("d-m-Y", strtotime($ptFirmDeedArr['formFiledOn'])) : "-"; ?>
                                                    </span>
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
                                                    <span>
                                                        <?= (!empty($ptFirmDeedArr['amountPaid'])) ? $ptFirmDeedArr['amountPaid'] : "-"; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Registration No : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>
                                                        <?= (!empty($ptFirmDeedArr['registrationNumber'])) ? $ptFirmDeedArr['registrationNumber'] : "-"; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold" >
                                                        Registered On : 
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>
                                                        <?= (check_valid_date($ptFirmDeedArr['registrationOn'])) ? date("d-m-Y", strtotime($ptFirmDeedArr['registrationOn'])) : "-"; ?>
                                                    </span>
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
                                                    <span>
                                                        <?= (check_valid_date($ptFirmDeedArr['extractRecvdOn'])) ? date("d-m-Y", strtotime($ptFirmDeedArr['extractRecvdOn'])) : "-"; ?>
                                                    </span>
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
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover partnerTbody">
                                                        <?php if(!empty($firmPtArr)): ?>
                                                            <?php foreach($firmPtArr AS $e_firm_pt): ?>
                                                            <tr class="row-1 partnerRow">
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_firm_pt['firmPartnerName'])) ? $e_firm_pt['firmPartnerName'] : "-"; ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?php
                                                                        if($e_firm_pt['isWorking']=="1")
                                                                            echo "Yes";
                                                                        elseif($e_firm_pt['isWorking']=="1")
                                                                            echo "No";
                                                                    ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?= (check_valid_date($e_firm_pt['admissionDate'])) ? date("d-m-Y", strtotime($e_firm_pt['admissionDate'])) : "-"; ?>
                                                                </td>
                                                                <td class="column-5 text-center">
                                                                    <?= (check_valid_date($e_firm_pt['retirementDate'])) ? date("d-m-Y", strtotime($e_firm_pt['retirementDate'])) : "-"; ?>
                                                                </td>	
                                                                <td class="column-5 text-center">
                                                                    <?= (!empty($e_firm_pt['salaryPercentage'])) ? $e_firm_pt['salaryPercentage'] : "-"; ?>
                                                                </td>	
                                                                <td class="column-5 text-center">
                                                                    <?= (!empty($e_firm_pt['interestPercentage'])) ? $e_firm_pt['interestPercentage'] : "-"; ?>
                                                                </td>	
                                                                <td class="column-5 text-center">
                                                                    <?= (!empty($e_firm_pt['profitPercentage'])) ? $e_firm_pt['profitPercentage'] : "-"; ?>
                                                                </td>	
                                                                <td class="column-5 text-center">
                                                                    <?= (!empty($e_firm_pt['lossPercentage'])) ? $e_firm_pt['lossPercentage'] : "-"; ?>
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
                                                <div class="col-md-3">
                                                    <span class="font-weight-bold" >
                                                        Registered Address : 
                                                    </span>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>
                                                        <?= (!empty($ptFirmDeedArr['registeredAddress'])) ? $ptFirmDeedArr['registeredAddress'] : "-"; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <span class="font-weight-bold" >
                                                        Administrative Office Address : 
                                                    </span>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>
                                                        <?= (!empty($ptFirmDeedArr['adminOfficeAddress'])) ? $ptFirmDeedArr['adminOfficeAddress'] : "-"; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <span class="font-weight-bold" >
                                                        Factory Address : 
                                                    </span>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>
                                                        <?= (!empty($ptFirmDeedArr['factoryAddress'])) ? $ptFirmDeedArr['factoryAddress'] : "-"; ?>
                                                    </span>
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
                                                <label class="text-white">Remarks (Changes in brief)</label>
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
                                                    <span>
                                                        <?= (!empty($ptFirmDeedArr['remarks'])) ? $ptFirmDeedArr['remarks'] : "-"; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
</section>
<!-- /.content -->


<?= $this->endSection(); ?>