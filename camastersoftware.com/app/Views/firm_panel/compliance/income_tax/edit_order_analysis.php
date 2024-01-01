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
        font-size: 12px;
    }
    
    .tablepress tbody {
        font-size: 12px;
    }
    
    td.column-1 {
        font-weight: normal;
        font-size: 12px;
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
    
    .addExpBtn{
        cursor: pointer !important;
    }
    
    .removeExpBtn{
        cursor: pointer !important;
    }
    
    .ordAnlyInput{
        width: 300px !important;
        font-size: 12px !important;
    }
    
    input:not(.ordAnlyInput){
        width: 100% !important;
        font-size: 11px !important;
        text-align: right !important;
    }
    
    tr.row-1 td:first-child {
        text-align: left !important;
        font-weight: bold !important;
        font-size: 16px !important;
    }
    
    .divLine td{
        background-color: #005495 !important;
    }
    
</style>
<?php $totalIncome = (!empty($orderAnalysisArr['totalIncome'])) ? $orderAnalysisArr['totalIncome'] : 0; ?>
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
                            <a href="<?php echo base_url('order-analysis/'.$workId); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <form action="<?php echo base_url('update-order-analysis'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="row"> 
                            <div class="col-12">
                                <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                            <thead>
                                                <tr class="row-1">
                                                    <th class="column-1" colspan="2">As per Assessment Order</th>
                                                    <th class="column-2" colspan="2" width="16%">Analysis of Asst Order</th>
                                                    <th class="column-2" colspan="2" width="16%">Result of Appeal - CIT(A)</th>
                                                    <th class="column-2" colspan="2" width="16%">Analysis of CIT(A) Order</th>
                                                    <th class="column-2" colspan="2" width="16%">Result of Appeal - ITAT</th>
                                                </tr>
                                                <tr class="row-1">
                                                    <th class="column-1"></th>
                                                    <th class="column-1" width="8%"></th>
                                                    <th class="column-1" width="8%" nowrap>Not To Appeal</th>
                                                    <th class="column-2" width="8%">To Appeal</th>
                                                    <th class="column-3" width="8%">Allowed</th>
                                                    <th class="column-4" width="8%">Rejected</th>
                                                    <th class="column-1" width="8%" nowrap>Not To Appeal</th>
                                                    <th class="column-2" width="8%">To Appeal</th>
                                                    <th class="column-3" width="8%">Allowed</th>
                                                    <th class="column-4" width="8%">Rejected</th>
                                                </tr>
                                            </thead>
                                            <tbody class="row-hover">
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        Returned Income (A)
                                                    </td>
                                                    <td class="column-1 text-right">
                                                        <input type="text" class="form-control" value="<?= amount_format($totalIncome); ?>" readonly>
                                                        <input type="hidden" id="totalIncome" value="<?= $totalIncome; ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                </tr>
                                                <tr class="row-1 addExpHeadRow" <?php if(empty($ordAnlyExpAddData)): ?> id="addExpRow" <?php endif; ?> >
                                                    <td class="column-1">
                                                        Additions
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <span class="text-success mt-2 addExpBtn" data-id="1">
                                                            <i class="fa fa-plus-circle fa-2x"></i>
                                                        </span>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                </tr>
                                                
                                                <?php if(!empty($ordAnlyExpAddData)): ?>
                                                
                                                    <?php $addExpCount = (count($ordAnlyExpAddData)-1); ?>
                                                    
                                                    <?php foreach($ordAnlyExpAddData AS $k_add_exp => $e_add_exp): ?>
                                                        
                                                        <tr class="row-1 expRowTR addExpRow" data-type="addExpRow" <?php if($addExpCount==$k_add_exp): ?> id="addExpRow" <?php endif; ?> >
                                                            <td class="column-1 d-flex">
                                                                <span class="text-danger mt-2 removeExpBtn">
                                                                    <i class="fa fa-minus-circle fa-2x"></i>
                                                                </span>
                                                                &nbsp;
                                                                <input type="hidden" name="ordAnlyExpId[]" value="<?= (!empty($e_add_exp['ordAnlyExpId'])) ? $e_add_exp['ordAnlyExpId']:""; ?>">
                                                                <input type="hidden" name="expType[]" value="<?= (!empty($e_add_exp['expType'])) ? $e_add_exp['expType']:"1"; ?>">
                                                                <input type="text" name="ordAnlyExpName[]" class="form-control ordAnlyInput" value="<?= (!empty($e_add_exp['ordAnlyExpName'])) ? $e_add_exp['ordAnlyExpName']:""; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="scrAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_add_exp['scrAmt'])) ? $e_add_exp['scrAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applCITNotAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_add_exp['applCITNotAmt'])) ? $e_add_exp['applCITNotAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applCITAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_add_exp['applCITAmt'])) ? $e_add_exp['applCITAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applCITAllwdAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_add_exp['applCITAllwdAmt'])) ? $e_add_exp['applCITAllwdAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applCITRejAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_add_exp['applCITRejAmt'])) ? $e_add_exp['applCITRejAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applITATNotAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_add_exp['applITATNotAmt'])) ? $e_add_exp['applITATNotAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applITATAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_add_exp['applITATAmt'])) ? $e_add_exp['applITATAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applITATAllwdAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_add_exp['applITATAllwdAmt'])) ? $e_add_exp['applITATAllwdAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applITATRejAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_add_exp['applITATRejAmt'])) ? $e_add_exp['applITATRejAmt']:0; ?>">
                                                            </td>
                                                        </tr>
                                                            
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                
                                                <tr class="row-1 addExpSubTotalRow">
                                                    <td class="column-1">
                                                        Sub-total (B)
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="scrAmtTotalAdd" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITNotAmtTotalAdd" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITAmtTotalAdd" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITAllwdAmtTotalAdd" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITRejAmtTotalAdd" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATNotAmtTotalAdd" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATAmtTotalAdd" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATAllwdAmtTotalAdd" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATRejAmtTotalAdd" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                                <tr class="row-1 dedctExpHeadRow" <?php if(empty($ordAnlyExpDedData)): ?> id="dedctExpRow" <?php endif; ?> >
                                                    <td class="column-1">
                                                        Deductions
                                                    </td>
                                                    <td class="column-1">
                                                        <span class="text-success mt-2 addExpBtn" data-id="2">
                                                            <i class="fa fa-plus-circle fa-2x"></i>
                                                        </span>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                </tr>
                                                
                                                <?php if(!empty($ordAnlyExpDedData)): ?>
                                                
                                                    <?php $dedExpCount = (count($ordAnlyExpDedData)-1); ?>
                                                    
                                                    <?php foreach($ordAnlyExpDedData AS $k_ded_exp => $e_ded_exp): ?>
                                                    
                                                        <tr class="row-1 expRowTR dedExpRow" data-type="dedExpRow" <?php if($dedExpCount==$k_ded_exp): ?> id="dedctExpRow" <?php endif; ?> >
                                                            <td class="column-1 d-flex">
                                                                <span class="text-danger mt-2 removeExpBtn">
                                                                    <i class="fa fa-minus-circle fa-2x"></i>
                                                                </span>
                                                                &nbsp;
                                                                <input type="hidden" name="ordAnlyExpId[]" value="<?= (!empty($e_ded_exp['ordAnlyExpId'])) ? $e_ded_exp['ordAnlyExpId']:""; ?>">
                                                                <input type="hidden" name="expType[]" value="<?= (!empty($e_ded_exp['expType'])) ? $e_ded_exp['expType']:"2"; ?>">
                                                                <input type="text" name="ordAnlyExpName[]" class="form-control ordAnlyInput" value="<?= (!empty($e_ded_exp['ordAnlyExpName'])) ? $e_ded_exp['ordAnlyExpName']:""; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="scrAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_ded_exp['scrAmt'])) ? $e_ded_exp['scrAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applCITNotAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_ded_exp['applCITNotAmt'])) ? $e_ded_exp['applCITNotAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applCITAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_ded_exp['applCITAmt'])) ? $e_ded_exp['applCITAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applCITAllwdAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_ded_exp['applCITAllwdAmt'])) ? $e_ded_exp['applCITAllwdAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applCITRejAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_ded_exp['applCITRejAmt'])) ? $e_ded_exp['applCITRejAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applITATNotAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_ded_exp['applITATNotAmt'])) ? $e_ded_exp['applITATNotAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applITATAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_ded_exp['applITATAmt'])) ? $e_ded_exp['applITATAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applITATAllwdAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_ded_exp['applITATAllwdAmt'])) ? $e_ded_exp['applITATAllwdAmt']:0; ?>">
                                                            </td>
                                                            <td class="column-1 text-center">
                                                                <input type="text" name="applITATRejAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="<?= (!empty($e_ded_exp['applITATRejAmt'])) ? $e_ded_exp['applITATRejAmt']:0; ?>">
                                                            </td>
                                                        </tr>
                                                            
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                
                                                <tr class="row-1 dedctExpSubTotalRow">
                                                    <td class="column-1">
                                                        Sub-total (C)
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="scrAmtTotalDed" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITNotAmtTotalDed" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITAmtTotalDed" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITAllwdAmtTotalDed" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITRejAmtTotalDed" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATNotAmtTotalDed" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATAmtTotalDed" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATAllwdAmtTotalDed" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATRejAmtTotalDed" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        Assessed Income (A+B-C)
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="scrAmtAssdInc" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITNotAmtAssdInc" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITAmtAssdInc" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITAllwdAmtAssdInc" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applCITRejAmtAssdInc" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATNotAmtAssdInc" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATAmtAssdInc" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATAllwdAmtAssdInc" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1 text-center">
                                                        <input type="text" name="applITATRejAmtAssdInc" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                                <tr class="row-1 divLine">
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                </tr>
                                                <tr class="row-1 incTaxRow">
                                                    <td class="column-1">
                                                        Income Tax on Above (A)
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="scrutinyIncAmt" class="form-control taxInput" onkeypress="validateNum(event)" value="<?= (!empty($orderAnalysisArr['scrutinyIncAmt'])) ? $orderAnalysisArr['scrutinyIncAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="applCITIncAmt" class="form-control taxInput" onkeypress="validateNum(event)" value="<?= (!empty($orderAnalysisArr['applCITIncAmt'])) ? $orderAnalysisArr['applCITIncAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="applITATIncAmt" class="form-control taxInput" onkeypress="validateNum(event)" value="<?= (!empty($orderAnalysisArr['applITATIncAmt'])) ? $orderAnalysisArr['applITATIncAmt'] : 0 ?>">
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        Additions
                                                        <input type="hidden" name="ordAnlyTaxId[]" value="<?= (!empty($ordTaxData[1]['ordAnlyTaxId'])) ? $ordTaxData[1]['ordAnlyTaxId'] : 0 ?>">
                                                        <input type="hidden" name="ordAnlyTaxId[]" value="<?= (!empty($ordTaxData[2]['ordAnlyTaxId'])) ? $ordTaxData[2]['ordAnlyTaxId'] : 0 ?>">
                                                        <input type="hidden" name="ordAnlyTaxId[]" value="<?= (!empty($ordTaxData[3]['ordAnlyTaxId'])) ? $ordTaxData[3]['ordAnlyTaxId'] : 0 ?>">
                                                        
                                                        <input type="hidden" name="taxAnalysisType[]" value="<?= (!empty($ordTaxData[1]['taxAnalysisType'])) ? $ordTaxData[1]['taxAnalysisType'] : 1 ?>">
                                                        <input type="hidden" name="taxAnalysisType[]" value="<?= (!empty($ordTaxData[2]['taxAnalysisType'])) ? $ordTaxData[2]['taxAnalysisType'] : 2 ?>">
                                                        <input type="hidden" name="taxAnalysisType[]" value="<?= (!empty($ordTaxData[3]['taxAnalysisType'])) ? $ordTaxData[3]['taxAnalysisType'] : 3 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                </tr>
                                                <tr class="row-1 addTaxRow">
                                                    <td class="column-1">
                                                        Interest
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="interestAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[1]['interestAmt'])) ? $ordTaxData[1]['interestAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="interestAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[2]['interestAmt'])) ? $ordTaxData[2]['interestAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="interestAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[3]['interestAmt'])) ? $ordTaxData[3]['interestAmt'] : 0 ?>">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 addTaxRow">
                                                    <td class="column-1">
                                                        Penalty
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="penaltyAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[1]['penaltyAmt'])) ? $ordTaxData[1]['penaltyAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="penaltyAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[2]['penaltyAmt'])) ? $ordTaxData[2]['penaltyAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="penaltyAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[3]['penaltyAmt'])) ? $ordTaxData[3]['penaltyAmt'] : 0 ?>">
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        Sub-total (B)
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="taxSubTotalAdd[]" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="taxSubTotalAdd[]" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="taxSubTotalAdd[]" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        Total Tax Payable
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="totalTaxPay[]" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="totalTaxPay[]" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="totalTaxPay[]" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        Deductions
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                </tr>
                                                <tr class="row-1 dedTaxRow">
                                                    <td class="column-1">
                                                        TDS
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="TDSAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[1]['TDSAmt'])) ? $ordTaxData[1]['TDSAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="TDSAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[2]['TDSAmt'])) ? $ordTaxData[2]['TDSAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="TDSAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[3]['TDSAmt'])) ? $ordTaxData[3]['TDSAmt'] : 0 ?>">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 dedTaxRow">
                                                    <td class="column-1">
                                                        Advance Tax
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="advTaxAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[1]['advTaxAmt'])) ? $ordTaxData[1]['advTaxAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="advTaxAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[2]['advTaxAmt'])) ? $ordTaxData[2]['advTaxAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="advTaxAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[3]['advTaxAmt'])) ? $ordTaxData[3]['advTaxAmt'] : 0 ?>">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 dedTaxRow">
                                                    <td class="column-1">
                                                        Self Assessment Tax
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="selfAssmtTaxAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[1]['selfAssmtTaxAmt'])) ? $ordTaxData[1]['selfAssmtTaxAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="selfAssmtTaxAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[2]['selfAssmtTaxAmt'])) ? $ordTaxData[2]['selfAssmtTaxAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="selfAssmtTaxAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[3]['selfAssmtTaxAmt'])) ? $ordTaxData[3]['selfAssmtTaxAmt'] : 0 ?>">
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        Sub-total (C)
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="taxSubTotalDed[]" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="taxSubTotalDed[]" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="taxSubTotalDed[]" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        Additional Tax Payable
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="addtnlTaxPay[]" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="addtnlTaxPay[]" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="addtnlTaxPay[]" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                </tr>
                                                <tr class="row-1 paidApplRow">
                                                    <td class="column-1">
                                                        Paid at the time of Appeal
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="paidAtAppealAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[1]['paidAtAppealAmt'])) ? $ordTaxData[1]['paidAtAppealAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="paidAtAppealAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[2]['paidAtAppealAmt'])) ? $ordTaxData[2]['paidAtAppealAmt'] : 0 ?>">
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="paidAtAppealAmt[]" onkeypress="validateNum(event)" class="form-control taxInput" value="<?= (!empty($ordTaxData[3]['paidAtAppealAmt'])) ? $ordTaxData[3]['paidAtAppealAmt'] : 0 ?>">
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        Balance Amount Stayed
                                                    </td>
                                                    <td class="column-1 text-center scrTD">
                                                        <input type="text" name="balAmtStay[]" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applCITTD">
                                                        <input type="text" name="balAmtStay[]" class="form-control" readonly>
                                                    </td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1"></td>
                                                    <td class="column-1 text-center applITATCIT">
                                                        <input type="text" name="balAmtStay[]" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input type="hidden" name="workId" id="workId" value="<?= $workId; ?>">
                                <input type="hidden" name="ordAnlyId" id="ordAnlyId" value="<?= $orderAnalysisArr['ordAnlyId']; ?>">
                                <a href="<?= base_url('order-analysis/'.$workId); ?>">
                                    <button type="button" class="btn btn-dark text-left">Back</button>
                                </a>
                                <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
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

<input type="hidden" id="expRowTR" value='
    <tr class="row-1 expRowTR">
        <td class="column-1 d-flex">
            <span class="text-danger mt-2 removeExpBtn">
                <i class="fa fa-minus-circle fa-2x"></i>
            </span>
            &nbsp;
            <input type="hidden" name="ordAnlyExpId[]" value="">
            #expTypeInput#
            <input type="text" name="ordAnlyExpName[]" class="form-control ordAnlyInput" value="">
        </td>
        <td class="column-1 text-center">
            <input type="text" name="scrAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="">
        </td>
        <td class="column-1 text-center">
            <input type="text" name="applCITNotAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="">
        </td>
        <td class="column-1 text-center">
            <input type="text" name="applCITAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="">
        </td>
        <td class="column-1 text-center">
            <input type="text" name="applCITAllwdAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="">
        </td>
        <td class="column-1 text-center">
            <input type="text" name="applCITRejAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="">
        </td>
        <td class="column-1 text-center">
            <input type="text" name="applITATNotAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="">
        </td>
        <td class="column-1 text-center">
            <input type="text" name="applITATAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="">
        </td>
        <td class="column-1 text-center">
            <input type="text" name="applITATAllwdAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="">
        </td>
        <td class="column-1 text-center">
            <input type="text" name="applITATRejAmt[]" onkeypress="validateNum(event)" class="form-control expInput" value="">
        </td>
    </tr>
'>

<script>

    $(document).ready(function(){
        
        $('body').on('click', '.addExpBtn', function(){
            
            var expRowTR = $('#expRowTR').val();
            var expType = $(this).data('id');
            
            //  dedctExpRow addExpRow
            //  dedctExpSubTotalRow addExpSubTotalRow
            
            if($('#addExpRow').length==0)
            {
                $('tr.addExpSubTotalRow').prev('tr').attr('id', 'addExpRow');
            }
            
            if($('#dedctExpRow').length==0)
            {
                $('tr.dedctExpSubTotalRow').prev('tr').attr('id', 'dedctExpRow');
            }
            
            if(expType==1)
            {
                var expRowTRNew = expRowTR.replace('<tr class="row-1 expRowTR">', '<tr class="row-1 expRowTR addExpRow" data-type="addExpRow" >');
                var expRowTRNew1 = expRowTRNew.replace('#expTypeInput#', '<input type="hidden" name="expType[]" value="1">');
                $('#addExpRow').after(expRowTRNew1);
            }
            else if(expType==2)
            {
                var expRowTRNew = expRowTR.replace('<tr class="row-1 expRowTR">', '<tr class="row-1 expRowTR dedExpRow" data-type="dedExpRow" >');
                var expRowTRNew1 = expRowTRNew.replace('#expTypeInput#', '<input type="hidden" name="expType[]" value="2">');
                $('#dedctExpRow').after(expRowTRNew1);
            }
        });
        
        
        $('body').on('click', '.removeExpBtn', function(){
            $(this).parents('.expRowTR').remove();
        });
        
        $('body').on('keyup', '.expInput', function(){
            
            var inputName = $(this).attr('name');
            var inputSection = $(this).parents('.expRowTR').data('type');
            
            var inputNameNew= inputName.replace('[]', '');
            
            var sumInputAmt = 0;
            
            $('.'+inputSection+' input[name="'+inputName+'"]').each(function(index, elem) {
                sumInputAmt += Number($(this).val());
            });
            
            var sumInput = "";
            
            var totalAddInputName=inputNameNew+"TotalAdd";
            var totalDedInputName=inputNameNew+"TotalDed";
            var totalAssdIncInputName=inputNameNew+"AssdInc";
            
            if(inputSection=="addExpRow")
            {
                sumInput='input[name="'+totalAddInputName+'"]';
            }
            else if(inputSection=="dedExpRow")
            {
                sumInput='input[name="'+totalDedInputName+'"]';
            }
            
            $(sumInput).val(sumInputAmt);
            
            var totalAddInput='input[name="'+totalAddInputName+'"]';
            var totalDedInput='input[name="'+totalDedInputName+'"]';
            var totalAssdIncInput='input[name="'+totalAssdIncInputName+'"]';
            
            var totalAddInputVal = Number($(totalAddInput).val());
            var totalDedInputVal = Number($(totalDedInput).val());
            
            var totalIncome = 0;
            
            if(inputNameNew=="scrAmt")
            {
                var totalIncome = Number($('#totalIncome').val());
            }
            
            var totalAssdIncAmt = (totalIncome+totalAddInputVal)-totalDedInputVal;
            
            $(totalAssdIncInput).val(totalAssdIncAmt)
            
        });
        
        $('body').on('keyup', '.taxInput', function(){
            
            var parentType = "";
            
            if($(this).parent('td').hasClass('scrTD'))
            {
                parentType="scrTD";
            }
            else if($(this).parent('td').hasClass('applCITTD'))
            {
                parentType="applCITTD";
            }
            else if($(this).parent('td').hasClass('applITATCIT'))
            {
                parentType="applITATCIT";
            }
            
            var incTaxAmt = 0;
            var addTaxAmt = 0;
            var dedTaxAmt = 0;
            var paidApplAmt = 0;
            
            $('.'+parentType+' input').each(function(index, elem) {
                
                if($(this).hasClass('taxInput'))
                {
                    if($(this).parents('tr').hasClass('incTaxRow'))
                    {
                        incTaxAmt += Number($(this).val());
                    }
                    else if($(this).parents('tr').hasClass('addTaxRow'))
                    {
                        addTaxAmt += Number($(this).val());
                    }
                    else if($(this).parents('tr').hasClass('dedTaxRow'))
                    {
                        dedTaxAmt += Number($(this).val());
                    }
                    else if($(this).parents('tr').hasClass('paidApplRow'))
                    {
                        paidApplAmt += Number($(this).val());
                    }
                }
            });
            
            var totalTaxPayAmt = incTaxAmt+addTaxAmt;
            var addtnlTaxPayAmt = totalTaxPayAmt-dedTaxAmt;
            var balAmtStayAmt = addtnlTaxPayAmt-paidApplAmt;
            
            $('.incTaxRow .'+parentType+' input').val(incTaxAmt);
            $('.'+parentType+' input[name="taxSubTotalAdd[]"]').val(addTaxAmt);
            $('.'+parentType+' input[name="totalTaxPay[]"]').val(totalTaxPayAmt);
            $('.'+parentType+' input[name="taxSubTotalDed[]"]').val(dedTaxAmt);
            $('.'+parentType+' input[name="addtnlTaxPay[]"]').val(addtnlTaxPayAmt);
            $('.'+parentType+' input[name="paidAtAppealAmt[]"]').val(paidApplAmt);
            $('.'+parentType+' input[name="balAmtStay[]"]').val(balAmtStayAmt);
            
        });
        
        $('.expInput').trigger('keyup');
        $('.taxInput').trigger('keyup');
        
    });

</script>

<?= $this->endSection(); ?>