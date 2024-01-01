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
    $clientNameVar = (!empty($clientData['clientBussOrganisation'])) ? $clientData['clientBussOrganisation'] : "N/A";
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
                            <a href="<?= base_url('company-master-details'); ?>">
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
                                    <div class="row form-group">
                                        <div class="col-md-12 col-lg-12 text-center mb-3">
                                            <span class="font-weight-bold" >
                                                <?= $clientNameVar; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="row form-group mb-3">
                                        <div class="col-md-4 col-lg-4">
                                            <span class="font-weight-bold" >
                                                Registration Number
                                            </span>
                                        </div>
                                        <div class="col-md-1 col-lg-1">:</div>
                                        <div class="col-md-7 col-lg-7">
                                            <?= (!empty($clientData['clientRegDocument'])) ? $clientData['clientRegDocument'] : "N/A"; ?>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-md-4 col-lg-4">
                                            <span class="font-weight-bold" >
                                                Date of Incorporation
                                            </span>
                                        </div>
                                        <div class="col-md-1 col-lg-1">:</div>
                                        <div class="col-md-7 col-lg-7">
                                            <?= (check_valid_date($clientData['clientBussIncorporationDate'])) ? date('d-m-Y', strtotime($clientData['clientBussIncorporationDate'])) : "N/A"; ?>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-md-4 col-lg-4">
                                            <span class="font-weight-bold" >
                                                Date of Commencement of Business
                                            </span>
                                        </div>
                                        <div class="col-md-1 col-lg-1">:</div>
                                        <div class="col-md-7 col-lg-7">
                                            N/A
                                        </div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-md-4 col-lg-4">
                                            <span class="font-weight-bold" >
                                                Registered Office
                                            </span>
                                        </div>
                                        <div class="col-md-1 col-lg-1">:</div>
                                        <div class="col-md-7 col-lg-7">
                                            <?= (!empty($clientData['clientBussRegisteredAddress'])) ? $clientData['clientBussRegisteredAddress'] : "N/A"; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label class="text-white">Details of Authorised Capital</label>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#addAuthCapModal">
                                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-success float-right mr-2">
                                                        <i class="fa fa-plus"></i>&nbsp;Add
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
                                                            <th class="column-2" nowrap width="5%">SN</th>
                                                            <th class="column-3" nowrap width="5%">From</th>
                                                            <th class="column-4" nowrap width="5%">To</th>
                                                            <th class="column-4" nowrap width="5%">Amount</th>
                                                            <th class="column-4" nowrap width="5%">No of Shares</th>
                                                            <th class="column-4" nowrap width="5%">Stamp Duty</th>
                                                            <th class="column-4" nowrap width="5%">Resolution Date</th>
                                                            <th class="column-6" nowrap width="5%">Date of Filing</th>
                                                            <th class="column-1" nowrap width="5%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                    <?php if(!empty($cmpyAuthCapData)): ?>
                                                        <?php foreach($cmpyAuthCapData AS $k_row => $e_row): ?>
                                                            <tr class="row-1">
                                                                <td class="column-2 text-center"><?= ($k_row+1); ?></td>
                                                                <td class="column-3 text-center">
                                                                    <?= (check_valid_date($e_row['fromDate'])) ? date('d-m-Y', strtotime($e_row['fromDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (check_valid_date($e_row['toDate'])) ? date('d-m-Y', strtotime($e_row['toDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['amount'])) ? $e_row['amount'] : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['noOfShares'])) ? $e_row['noOfShares'] : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['stampDuty'])) ? $e_row['stampDuty'] : "-" ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?= (check_valid_date($e_row['reslnDate'])) ? date('d-m-Y', strtotime($e_row['reslnDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?= (check_valid_date($e_row['filingDate'])) ? date('d-m-Y', strtotime($e_row['filingDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-1">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editAuthCapModal<?= $e_row['cmpyAuthCapId']; ?>">
                                                                                <i class="fa fa-pencil"></i>&nbsp;Edit
                                                                            </a>
                                                                            <a class="dropdown-item delCmpyAuthCap" href="javascript:void(0);" data-id="<?= $e_row['cmpyAuthCapId']; ?>">
                                                                                <i class="fa fa-trash"></i>&nbsp;Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr class="row-1">
                                                        <td class="column-2" colspan="9">
                                                            <center>No records found :(</center>
                                                        </td>
                                                    </tr>
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
                                                <label class="text-white">Details of Issued/Paid-Up Capital</label>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#addIssuePaidCapModal">
                                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-success float-right mr-2">
                                                        <i class="fa fa-plus"></i>&nbsp;Add
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
                                                            <th class="column-2" nowrap width="5%">SN</th>
                                                            <th class="column-3" nowrap width="5%">Type of Issue</th>
                                                            <th class="column-4" nowrap width="5%">Date of Allotment</th>
                                                            <th class="column-4" nowrap width="5%">Total No of Shares</th>
                                                            <th class="column-4" nowrap width="5%">Amount</th>
                                                            <th class="column-4" nowrap width="5%">Cumulative Total</th>
                                                            <th class="column-4" nowrap width="5%">Resolution Date</th>
                                                            <th class="column-6" nowrap width="5%">Date of Filing</th>
                                                            <th class="column-1" nowrap width="5%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                    <?php if(!empty($cmpyIssuePaidCapData)): ?>
                                                        <?php foreach($cmpyIssuePaidCapData AS $k_row => $e_row): ?>
                                                            <tr class="row-1">
                                                                <td class="column-2 text-center"><?= ($k_row+1); ?></td>
                                                                <td class="column-3 text-center">
                                                                    <?= (isset($cmpyIssueTypeArr[$e_row['issueType']])) ? $cmpyIssueTypeArr[$e_row['issueType']] : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (check_valid_date($e_row['allotmentDate'])) ? date('d-m-Y', strtotime($e_row['allotmentDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['totalNoOfShares'])) ? $e_row['totalNoOfShares'] : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['amount'])) ? $e_row['amount'] : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['cumulativeTotal'])) ? $e_row['cumulativeTotal'] : "-" ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?= (check_valid_date($e_row['reslnDate'])) ? date('d-m-Y', strtotime($e_row['reslnDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?= (check_valid_date($e_row['filingDate'])) ? date('d-m-Y', strtotime($e_row['filingDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-1">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editIssuePaidCapModal<?= $e_row['cmpyIssuePaidCapId']; ?>">
                                                                                <i class="fa fa-pencil"></i>&nbsp;Edit
                                                                            </a>
                                                                            <a class="dropdown-item delCmpyIssuePaidCap" href="javascript:void(0);" data-id="<?= $e_row['cmpyIssuePaidCapId']; ?>">
                                                                                <i class="fa fa-trash"></i>&nbsp;Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr class="row-1">
                                                        <td class="column-2" colspan="9">
                                                            <center>No records found :(</center>
                                                        </td>
                                                    </tr>
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
                                                <label class="text-white">Details of Dividend Paid</label>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#addDividendPaidModal">
                                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-success float-right mr-2">
                                                        <i class="fa fa-plus"></i>&nbsp;Add
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
                                                            <th class="column-2" nowrap width="5%">SN</th>
                                                            <th class="column-3" nowrap width="5%">Acct. Year</th>
                                                            <th class="column-4" nowrap width="5%">Date of AGM</th>
                                                            <th class="column-6" nowrap width="5%">Share Capital</th>
                                                            <th class="column-6" nowrap width="5%">Rate(%)</th>
                                                            <th class="column-6" nowrap width="5%">Dividend Amount</th>
                                                            <th class="column-6" nowrap width="5%">Payment Date</th>
                                                            <th class="column-1" nowrap width="5%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                    <?php if(!empty($cmpyDividPaidData)): ?>
                                                        <?php foreach($cmpyDividPaidData AS $k_row => $e_row): ?>
                                                            <tr class="row-1">
                                                                <td class="column-2 text-center"><?= ($k_row+1); ?></td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['acctYear'])) ? $e_row['acctYear'] : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (check_valid_date($e_row['agmDate'])) ? date('d-m-Y', strtotime($e_row['agmDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['shareCapital'])) ? $e_row['shareCapital'] : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['rate'])) ? $e_row['rate'] : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['dividendAmt'])) ? $e_row['dividendAmt'] : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (check_valid_date($e_row['pmtDate'])) ? date('d-m-Y', strtotime($e_row['pmtDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-1">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editDividendPaidModal<?= $e_row['cmpyDividPaidId']; ?>">
                                                                                <i class="fa fa-pencil"></i>&nbsp;Edit
                                                                            </a>
                                                                            <a class="dropdown-item delCmpyDividendPaid" href="javascript:void(0);" data-id="<?= $e_row['cmpyDividPaidId']; ?>">
                                                                                <i class="fa fa-trash"></i>&nbsp;Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr class="row-1">
                                                        <td class="column-2" colspan="8">
                                                            <center>No records found :(</center>
                                                        </td>
                                                    </tr>
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
                                                <label class="text-white">Details of Filing of Annual Returns</label>
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
                                                            <th class="column-2" nowrap width="5%">Acct. Year</th>
                                                            <th class="column-3" nowrap width="5%">Due Date</th>
                                                            <th class="column-3" nowrap width="5%">Date of AGM</th>
                                                            <th class="column-4" nowrap width="5%">Date of Filing Returns</th>
                                                            <th class="column-6" nowrap width="5%">Receipt Number</th>
                                                            <th class="column-1" nowrap width="5%">Amount</th>
                                                            <th class="column-1" nowrap width="5%">Date of Receipt</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                    <?php if((!empty($workDataArr)) && (in_array(106, $cmpyDDFIDArr) || in_array(112, $cmpyDDFIDArr))): ?>
                                                        <?php foreach($workDataArr AS $k_row => $e_row): ?>
                                                            <?php if($e_row['due_date_for']==106 || $e_row['due_date_for']==112): ?>
                                                                <tr class="row-1">
                                                                    <td class="column-2 text-center">
                                                                        <?= (!empty($e_row['finYear'])) ? $e_row['finYear'] : "-" ?>
                                                                    </td>
                                                                    <td class="column-3 text-center">
                                                                        <?= (check_valid_date($e_row['due_date'])) ? date('d-m-Y', strtotime($e_row['due_date'])) : "-" ?>
                                                                    </td>
                                                                    <td class="column-3 text-center">
                                                                        <?= (check_valid_date($e_row['cmpyAgmDate'])) ? date('d-m-Y', strtotime($e_row['cmpyAgmDate'])) : "-" ?>
                                                                    </td>
                                                                    <td class="column-3 text-center">
                                                                        <?= (check_valid_date($e_row['eFillingDate'])) ? date('d-m-Y', strtotime($e_row['eFillingDate'])) : "-" ?>
                                                                    </td>
                                                                    <td class="column-2 text-center">
                                                                        <?= (!empty($e_row['cmpyReceiptNo'])) ? $e_row['cmpyReceiptNo'] : "-" ?>
                                                                    </td>
                                                                    <td class="column-2 text-center">
                                                                        <?= (!empty($e_row['cmpyReceiptAmt'])) ? $e_row['cmpyReceiptAmt'] : "-" ?>
                                                                    </td>
                                                                    <td class="column-4 text-center">
                                                                        <?= (check_valid_date($e_row['cmpyReceiptDate'])) ? date('d-m-Y', strtotime($e_row['cmpyReceiptDate'])) : "-" ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr class="row-1">
                                                        <td class="column-2" colspan="7">
                                                            <center>No records found :(</center>
                                                        </td>
                                                    </tr>
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
                                                <label class="text-white">Details of Filing of Annual Accounts</label>
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
                                                            <th class="column-2" nowrap width="5%">Acct. Year</th>
                                                            <th class="column-3" nowrap width="5%">Due Date</th>
                                                            <th class="column-3" nowrap width="5%">Date of AGM</th>
                                                            <th class="column-4" nowrap width="5%">Date of Filing Accounts</th>
                                                            <th class="column-6" nowrap width="5%">Receipt Number</th>
                                                            <th class="column-1" nowrap width="5%">Amount</th>
                                                            <th class="column-1" nowrap width="5%">Date of Receipt</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                    <?php if(!empty($workDataArr) && in_array(113, $cmpyDDFIDArr)): ?>
                                                        <?php foreach($workDataArr AS $k_row => $e_row): ?>
                                                            <?php if($e_row['due_date_for']==113): ?>
                                                                <tr class="row-1">
                                                                    <td class="column-2 text-center">
                                                                        <?= (!empty($e_row['finYear'])) ? $e_row['finYear'] : "-" ?>
                                                                    </td>
                                                                    <td class="column-3 text-center">
                                                                        <?= (check_valid_date($e_row['due_date'])) ? date('d-m-Y', strtotime($e_row['due_date'])) : "-" ?>
                                                                    </td>
                                                                    <td class="column-3 text-center">
                                                                        <?= (check_valid_date($e_row['cmpyAgmDate'])) ? date('d-m-Y', strtotime($e_row['cmpyAgmDate'])) : "-" ?>
                                                                    </td>
                                                                    <td class="column-3 text-center">
                                                                        <?= (check_valid_date($e_row['eFillingDate'])) ? date('d-m-Y', strtotime($e_row['eFillingDate'])) : "-" ?>
                                                                    </td>
                                                                    <td class="column-2 text-center">
                                                                        <?= (!empty($e_row['cmpyReceiptNo'])) ? $e_row['cmpyReceiptNo'] : "-" ?>
                                                                    </td>
                                                                    <td class="column-2 text-center">
                                                                        <?= (!empty($e_row['cmpyReceiptAmt'])) ? $e_row['cmpyReceiptAmt'] : "-" ?>
                                                                    </td>
                                                                    <td class="column-4 text-center">
                                                                        <?= (check_valid_date($e_row['cmpyReceiptDate'])) ? date('d-m-Y', strtotime($e_row['cmpyReceiptDate'])) : "-" ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr class="row-1">
                                                        <td class="column-2" colspan="7">
                                                            <center>No records found :(</center>
                                                        </td>
                                                    </tr>
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
                                                <label class="text-white">Details of Directors</label>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#addDirectorModal">
                                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-success float-right mr-2">
                                                        <i class="fa fa-plus"></i>&nbsp;Add
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
                                                            <th class="column-2" nowrap width="5%">SN</th>
                                                            <th class="column-3" nowrap width="5%">Name of the Director</th>
                                                            <th class="column-4" nowrap width="5%" colspan="3">Date of</th>
                                                            <th class="column-6" nowrap width="5%">Date of Filing</th>
                                                            <th class="column-1" nowrap width="5%">Action</th>
                                                        </tr>
                                                        <tr class="row-1">
                                                            <th class="column-2" nowrap width="5%"></th>
                                                            <th class="column-3" nowrap width="5%"></th>
                                                            <th class="column-4" nowrap width="5%">Appointment</th>
                                                            <th class="column-4" nowrap width="5%">Retirement</th>
                                                            <th class="column-4" nowrap width="5%">Resolution</th>
                                                            <th class="column-6" nowrap width="5%"></th>
                                                            <th class="column-1" nowrap width="5%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                    <?php if(!empty($cmpyDirectorData)): ?>
                                                        <?php foreach($cmpyDirectorData AS $k_row => $e_row): ?>
                                                            <tr class="row-1">
                                                                <td class="column-2 text-center"><?= ($k_row+1); ?></td>
                                                                <td class="column-3 text-center">
                                                                    <?= (!empty($e_row['directorName'])) ? $e_row['directorName'] : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (check_valid_date($e_row['apptDate'])) ? date('d-m-Y', strtotime($e_row['apptDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-3 text-center">
                                                                    <?= (check_valid_date($e_row['retrmtDate'])) ? date('d-m-Y', strtotime($e_row['retrmtDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?= (check_valid_date($e_row['reslnDate'])) ? date('d-m-Y', strtotime($e_row['reslnDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-4 text-center">
                                                                    <?= (check_valid_date($e_row['filingDate'])) ? date('d-m-Y', strtotime($e_row['filingDate'])) : "-" ?>
                                                                </td>
                                                                <td class="column-1">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editDirectorModal<?= $e_row['cmpyDirectorId']; ?>">
                                                                                <i class="fa fa-pencil"></i>&nbsp;Edit
                                                                            </a>
                                                                            <a class="dropdown-item delCmpyDirector" href="javascript:void(0);" data-id="<?= $e_row['cmpyDirectorId']; ?>">
                                                                                <i class="fa fa-trash"></i>&nbsp;Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr class="row-1">
                                                        <td class="column-2" colspan="7">
                                                            <center>No records found :(</center>
                                                        </td>
                                                    </tr>
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
                                                <label class="text-white">Audit Report</label>
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
                                                            <th class="column-2" nowrap width="5%">Acct. Year</th>
                                                            <th class="column-3" nowrap width="5%">Due Date</th>
                                                            <th class="column-3" nowrap width="5%">Date of AGM</th>
                                                            <th class="column-4" nowrap width="5%">Name of the Auditor</th>
                                                            <th class="column-6" nowrap width="5%">Date of Audit</th>
                                                            <th class="column-1" nowrap width="5%">UDIN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                    <?php if((!empty($workDataArr)) && (in_array(49, $cmpyDDFIDArr) || in_array(227, $cmpyDDFIDArr))): ?>
                                                        <?php foreach($workDataArr AS $k_row => $e_row): ?>
                                                            <?php if($e_row['due_date_for']==49 || $e_row['due_date_for']==227): ?>
                                                                <tr class="row-1">
                                                                    <td class="column-2 text-center">
                                                                        <?= (!empty($e_row['finYear'])) ? $e_row['finYear'] : "-" ?>
                                                                    </td>
                                                                    <td class="column-3 text-center">
                                                                        <?= (check_valid_date($e_row['due_date'])) ? date('d-m-Y', strtotime($e_row['due_date'])) : "-" ?>
                                                                    </td>
                                                                    <td class="column-3 text-center">
                                                                        <?= (check_valid_date($e_row['cmpyAuditAgmDate'])) ? date('d-m-Y', strtotime($e_row['cmpyAuditAgmDate'])) : "-" ?>
                                                                    </td>
                                                                    <td class="column-2 text-center">
                                                                        <?= (!empty($e_row['cmpyAuditorName'])) ? $e_row['cmpyAuditorName'] : "-" ?>
                                                                    </td>
                                                                    <td class="column-3 text-center">
                                                                        <?= (check_valid_date($e_row['cmpyAuditDate'])) ? date('d-m-Y', strtotime($e_row['cmpyAuditDate'])) : "-" ?>
                                                                    </td>
                                                                    <td class="column-2 text-center">
                                                                        <?= (!empty($e_row['cmpyAuditUDIN'])) ? $e_row['cmpyAuditUDIN'] : "-" ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr class="row-1">
                                                        <td class="column-2" colspan="6">
                                                            <center>No records found :(</center>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 text-center">
                                    <input type="hidden" id="clientId" value="<?= $clientData['clientId']; ?>">
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


<!-- -------------------------------------------------------------------- Add Authorised Capital Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="addAuthCapModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('add-company-auth-cap'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Details of Authorised Capital</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="font-weight-bold" >
                                Name of the Client : 
                            </span>
                        </div>
                        <div class="col-md-9">
                            <?= $clientNameVar; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>From : </label>
                                <input type="date" name="fromDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>To : </label>
                                <input type="date" name="toDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Amount : </label>
                                <input type="text" name="amount" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>No of Shares : </label>
                                <input type="text" name="noOfShares" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Stamp Duty : </label>
                                <input type="text" name="stampDuty" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Resolution Date : </label>
                                <input type="date" name="reslnDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Filing : </label>
                                <input type="date" name="filingDate" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="clientId" value="<?= $clientData['clientId']; ?>">
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
<!-- -------------------------------------------------------------------- Add Authorised Capital Modal - Ends --------------------------------------------------------------------- -->


<!-- -------------------------------------------------------------------- Add Issued/Paid-Up Capital Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="addIssuePaidCapModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('add-company-issue-paid-cap'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Details of Issued/Paid-Up Capital</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="font-weight-bold" >
                                Name of the Client : 
                            </span>
                        </div>
                        <div class="col-md-9">
                            <?= $clientNameVar; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Type of Issue : </label>
                                <select name="issueType" class="form-control">
                                    <option value="">Select</option>
                                    <?php if(!empty($cmpyIssueType)): ?>
                                        <?php foreach($cmpyIssueType AS $e_data): ?>
                                            <option value="<?= $e_data['cmpyIssueTypeId']; ?>" ><?= $e_data['name']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Allotment : </label>
                                <input type="date" name="allotmentDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Total No of Shares : </label>
                                <input type="text" name="totalNoOfShares" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Amount : </label>
                                <input type="text" name="amount" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Cumulative Total : </label>
                                <input type="text" name="cumulativeTotal" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Resolution Date : </label>
                                <input type="date" name="reslnDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Filing : </label>
                                <input type="date" name="filingDate" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="clientId" value="<?= $clientData['clientId']; ?>">
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
<!-- -------------------------------------------------------------------- Add Issued/Paid-Up Capital Modal - Ends --------------------------------------------------------------------- -->


<!-- -------------------------------------------------------------------- Add Dividend Paid Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="addDividendPaidModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('add-company-dividend-paid'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Details of Dividend Paid</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="font-weight-bold" >
                                Name of the Client : 
                            </span>
                        </div>
                        <div class="col-md-9">
                            <?= $clientNameVar; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Acct. Year : </label>
                                <input type="text" name="acctYear" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of AGM : </label>
                                <input type="date" name="agmDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Share Capital : </label>
                                <input type="text" name="shareCapital" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Rate(%) : </label>
                                <input type="text" name="rate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Dividend Amount : </label>
                                <input type="text" name="dividendAmt" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Payment Date : </label>
                                <input type="date" name="pmtDate" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="clientId" value="<?= $clientData['clientId']; ?>">
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
<!-- -------------------------------------------------------------------- Add Dividend Paid Modal - Ends --------------------------------------------------------------------- -->


<!-- -------------------------------------------------------------------- Add Director Modal - Starts --------------------------------------------------------------------- -->
<!-- Modal -->
<div id="addDirectorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('add-company-director'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Details of Director</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="font-weight-bold" >
                                Name of the Client : 
                            </span>
                        </div>
                        <div class="col-md-9">
                            <?= $clientNameVar; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Name of the Director : </label>
                                <input type="text" name="directorName" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Appointment : </label>
                                <input type="date" name="apptDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Retirement : </label>
                                <input type="date" name="retrmtDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Resolution : </label>
                                <input type="date" name="reslnDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Filing : </label>
                                <input type="date" name="filingDate" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="clientId" value="<?= $clientData['clientId']; ?>">
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
<!-- -------------------------------------------------------------------- Add Director Modal - Ends --------------------------------------------------------------------- -->



<!-- -------------------------------------------------------------------- Edit Authorised Capital Modal - Starts --------------------------------------------------------------------- -->

<?php if(!empty($cmpyAuthCapData)): ?>
    <?php foreach($cmpyAuthCapData AS $k_row => $e_row): ?>
        <!-- Modal -->
        <div id="editAuthCapModal<?= $e_row['cmpyAuthCapId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('edit-company-auth-cap'); ?>" method="POST" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Details of Authorised Capital</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <span class="font-weight-bold" >
                                        Name of the Client : 
                                    </span>
                                </div>
                                <div class="col-md-9">
                                    <?= $clientNameVar; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>From : </label>
                                        <input type="date" name="fromDate" class="form-control" value="<?= (check_valid_date($e_row['fromDate'])) ? date('Y-m-d', strtotime($e_row['fromDate'])) : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>To : </label>
                                        <input type="date" name="toDate" class="form-control" value="<?= (check_valid_date($e_row['toDate'])) ? date('Y-m-d', strtotime($e_row['toDate'])) : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Amount : </label>
                                        <input type="text" name="amount" class="form-control" value="<?= (!empty($e_row['amount'])) ? $e_row['amount'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>No of Shares : </label>
                                        <input type="text" name="noOfShares" class="form-control" value="<?= (!empty($e_row['noOfShares'])) ? $e_row['noOfShares'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Stamp Duty : </label>
                                        <input type="text" name="stampDuty" class="form-control" value="<?= (!empty($e_row['stampDuty'])) ? $e_row['stampDuty'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Resolution Date : </label>
                                        <input type="date" name="reslnDate" class="form-control" value="<?= (check_valid_date($e_row['reslnDate'])) ? date('Y-m-d', strtotime($e_row['reslnDate'])) : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Date of Filing : </label>
                                        <input type="date" name="filingDate" class="form-control" value="<?= (check_valid_date($e_row['filingDate'])) ? date('Y-m-d', strtotime($e_row['filingDate'])) : "" ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="cmpyAuthCapId" value="<?= $e_row['cmpyAuthCapId']; ?>">
                            <input type="hidden" name="clientId" value="<?= $clientData['clientId']; ?>">
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
<!-- -------------------------------------------------------------------- Edit Authorised Capital Modal - Ends --------------------------------------------------------------------- -->



<!-- -------------------------------------------------------------------- Edit Issued/Paid-Up Capital Modal - Starts --------------------------------------------------------------------- -->

<?php if(!empty($cmpyIssuePaidCapData)): ?>
    <?php foreach($cmpyIssuePaidCapData AS $k_row => $e_row): ?>
        <!-- Modal -->
        <div id="editIssuePaidCapModal<?= $e_row['cmpyIssuePaidCapId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('edit-company-issue-paid-cap'); ?>" method="POST" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Details of Issued/Paid-Up Capital</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <span class="font-weight-bold" >
                                        Name of the Client : 
                                    </span>
                                </div>
                                <div class="col-md-9">
                                    <?= $clientNameVar; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Type of Issue : </label>
                                        <select name="issueType" class="form-control">
                                            <option value="">Select</option>
                                            <?php if(!empty($cmpyIssueType)): ?>
                                                <?php foreach($cmpyIssueType AS $e_data): ?>
                                                    <option value="<?= $e_data['cmpyIssueTypeId']; ?>" <?php if($e_data['cmpyIssueTypeId']==$e_row['issueType']): ?> selected <?php endif; ?> ><?= $e_data['name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Date of Allotment : </label>
                                        <input type="date" name="allotmentDate" class="form-control" value="<?= (check_valid_date($e_row['allotmentDate'])) ? date('Y-m-d', strtotime($e_row['allotmentDate'])) : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Total No of Shares : </label>
                                        <input type="text" name="totalNoOfShares" class="form-control" value="<?= (!empty($e_row['totalNoOfShares'])) ? $e_row['totalNoOfShares'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Amount : </label>
                                        <input type="text" name="amount" class="form-control" value="<?= (!empty($e_row['amount'])) ? $e_row['amount'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Cumulative Total : </label>
                                        <input type="text" name="cumulativeTotal" class="form-control" value="<?= (!empty($e_row['cumulativeTotal'])) ? $e_row['cumulativeTotal'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Resolution Date : </label>
                                        <input type="date" name="reslnDate" class="form-control" value="<?= (check_valid_date($e_row['reslnDate'])) ? date('Y-m-d', strtotime($e_row['reslnDate'])) : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Date of Filing : </label>
                                        <input type="date" name="filingDate" class="form-control" value="<?= (check_valid_date($e_row['filingDate'])) ? date('Y-m-d', strtotime($e_row['filingDate'])) : "" ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="cmpyIssuePaidCapId" value="<?= $e_row['cmpyIssuePaidCapId']; ?>">
                            <input type="hidden" name="clientId" value="<?= $clientData['clientId']; ?>">
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
<!-- -------------------------------------------------------------------- Edit Issued/Paid-Up Capital Modal - Ends --------------------------------------------------------------------- -->


<!-- -------------------------------------------------------------------- Edit Dividend Paid Modal - Starts --------------------------------------------------------------------- -->

<?php if(!empty($cmpyDividPaidData)): ?>
    <?php foreach($cmpyDividPaidData AS $k_row => $e_row): ?>
        <!-- Modal -->
        <div id="editDividendPaidModal<?= $e_row['cmpyDividPaidId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('edit-company-dividend-paid'); ?>" method="POST" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Details of Dividend Paid</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <span class="font-weight-bold" >
                                        Name of the Client : 
                                    </span>
                                </div>
                                <div class="col-md-9">
                                    <?= $clientNameVar; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Acct. Year : </label>
                                        <input type="text" name="acctYear" class="form-control" value="<?= (!empty($e_row['acctYear'])) ? $e_row['acctYear'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Date of AGM : </label>
                                        <input type="date" name="agmDate" class="form-control" value="<?= (check_valid_date($e_row['agmDate'])) ? date('Y-m-d', strtotime($e_row['agmDate'])) : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Share Capital : </label>
                                        <input type="text" name="shareCapital" class="form-control" value="<?= (!empty($e_row['shareCapital'])) ? $e_row['shareCapital'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Rate(%) : </label>
                                        <input type="text" name="rate" class="form-control" value="<?= (!empty($e_row['rate'])) ? $e_row['rate'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Dividend Amount : </label>
                                        <input type="text" name="dividendAmt" class="form-control" value="<?= (!empty($e_row['dividendAmt'])) ? $e_row['dividendAmt'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Payment Date : </label>
                                        <input type="date" name="pmtDate" class="form-control" value="<?= (check_valid_date($e_row['pmtDate'])) ? date('Y-m-d', strtotime($e_row['pmtDate'])) : "" ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="cmpyDividPaidId" value="<?= $e_row['cmpyDividPaidId']; ?>">
                            <input type="hidden" name="clientId" value="<?= $clientData['clientId']; ?>">
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
<!-- -------------------------------------------------------------------- Edit Dividend Paid Modal - Ends --------------------------------------------------------------------- -->


<!-- -------------------------------------------------------------------- Edit Director Modal - Starts --------------------------------------------------------------------- -->

<?php if(!empty($cmpyDirectorData)): ?>
    <?php foreach($cmpyDirectorData AS $k_row => $e_row): ?>
        <!-- Modal -->
        <div id="editDirectorModal<?= $e_row['cmpyDirectorId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('edit-company-director'); ?>" method="POST" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Details of Director</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <span class="font-weight-bold" >
                                        Name of the Client : 
                                    </span>
                                </div>
                                <div class="col-md-9">
                                    <?= $clientNameVar; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Name of the Director : </label>
                                        <input type="text" name="directorName" class="form-control" value="<?= (!empty($e_row['directorName'])) ? $e_row['directorName'] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Date of Appointment : </label>
                                        <input type="date" name="apptDate" class="form-control" value="<?= (check_valid_date($e_row['apptDate'])) ? date('Y-m-d', strtotime($e_row['apptDate'])) : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Date of Retirement : </label>
                                        <input type="date" name="retrmtDate" class="form-control" value="<?= (check_valid_date($e_row['retrmtDate'])) ? date('Y-m-d', strtotime($e_row['retrmtDate'])) : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Resolution Date : </label>
                                        <input type="date" name="reslnDate" class="form-control" value="<?= (check_valid_date($e_row['reslnDate'])) ? date('Y-m-d', strtotime($e_row['reslnDate'])) : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Date of Filing : </label>
                                        <input type="date" name="filingDate" class="form-control" value="<?= (check_valid_date($e_row['filingDate'])) ? date('Y-m-d', strtotime($e_row['filingDate'])) : "" ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="cmpyDirectorId" value="<?= $e_row['cmpyDirectorId']; ?>">
                            <input type="hidden" name="clientId" value="<?= $clientData['clientId']; ?>">
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
<!-- -------------------------------------------------------------------- Edit Director Modal - Ends --------------------------------------------------------------------- -->


<script type="text/javascript">
            
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";
        
        $('.delCmpyAuthCap').on('click', function(e){

            e.preventDefault();

            var clientId = $('#clientId').val();
            var cmpyAuthCapId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/delete-company-auth-cap',
                        type : 'POST',
                        data : {
                            'cmpyAuthCapId':cmpyAuthCapId
                        },
                        dataType: 'text',
                        success : function(response) {
                            var refreshUrl = base_url+'/edit-company-master-details/'+clientId;
                            window.location.href=refreshUrl;
                        },
                        error : function(request, error)
                        {
                            console.log("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        $('.delCmpyIssuePaidCap').on('click', function(e){

            e.preventDefault();

            var clientId = $('#clientId').val();
            var cmpyIssuePaidCapId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/delete-company-issue-paid-cap',
                        type : 'POST',
                        data : {
                            'cmpyIssuePaidCapId':cmpyIssuePaidCapId
                        },
                        dataType: 'text',
                        success : function(response) {
                            var refreshUrl = base_url+'/edit-company-master-details/'+clientId;
                            window.location.href=refreshUrl;
                        },
                        error : function(request, error)
                        {
                            console.log("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        
        $('.delCmpyDividendPaid').on('click', function(e){

            e.preventDefault();

            var clientId = $('#clientId').val();
            var cmpyDividPaidId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/delete-company-dividend-paid',
                        type : 'POST',
                        data : {
                            'cmpyDividPaidId':cmpyDividPaidId
                        },
                        dataType: 'text',
                        success : function(response) {
                            var refreshUrl = base_url+'/edit-company-master-details/'+clientId;
                            window.location.href=refreshUrl;
                        },
                        error : function(request, error)
                        {
                            console.log("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        
        $('.delCmpyDirector').on('click', function(e){

            e.preventDefault();

            var clientId = $('#clientId').val();
            var cmpyDirectorId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/delete-company-director',
                        type : 'POST',
                        data : {
                            'cmpyDirectorId':cmpyDirectorId
                        },
                        dataType: 'text',
                        success : function(response) {
                            var refreshUrl = base_url+'/edit-company-master-details/'+clientId;
                            window.location.href=refreshUrl;
                        },
                        error : function(request, error)
                        {
                            console.log("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        

    });

</script>

<?= $this->endSection(); ?>