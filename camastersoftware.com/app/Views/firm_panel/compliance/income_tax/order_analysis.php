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
<?php $totalIncome = (!empty($orderAnalysisArr['totalIncome'])) ? $orderAnalysisArr['totalIncome'] : "-"; ?>
<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox text-center">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('edit-order-analysis/'.$workId); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit">Edit</button>
                        </a>
                        &nbsp;
                        <a href="<?php echo base_url('scrutiny'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
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
                                                    <span class="amtSpan totalIncome"><?= amount_format($totalIncome); ?></span>
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
                                                <td class="column-1 text-right"></td>
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
                                                        <td class="column-1">
                                                            <?php $ordAnlyExpName = (!empty($e_add_exp['ordAnlyExpName'])) ? $e_add_exp['ordAnlyExpName']:""; ?>
                                                            <span class="amtSpan ordAnlyExpName"><?= $ordAnlyExpName; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($e_add_exp['scrAmt'])) ? amount_format($e_add_exp['scrAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applCITNotAmt"><?= (!empty($e_add_exp['applCITNotAmt'])) ? amount_format($e_add_exp['applCITNotAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applCITAmt"><?= (!empty($e_add_exp['applCITAmt'])) ? amount_format($e_add_exp['applCITAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applCITAllwdAmt"><?= (!empty($e_add_exp['applCITAllwdAmt'])) ? amount_format($e_add_exp['applCITAllwdAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applCITRejAmt"><?= (!empty($e_add_exp['applCITRejAmt'])) ? amount_format($e_add_exp['applCITRejAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applITATNotAmt"><?= (!empty($e_add_exp['applITATNotAmt'])) ? amount_format($e_add_exp['applITATNotAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applITATAmt"><?= (!empty($e_add_exp['applITATAmt'])) ? amount_format($e_add_exp['applITATAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applITATAllwdAmt"><?= (!empty($e_add_exp['applITATAllwdAmt'])) ? amount_format($e_add_exp['applITATAllwdAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applITATRejAmt"><?= (!empty($e_add_exp['applITATRejAmt'])) ? amount_format($e_add_exp['applITATRejAmt']) : "-"; ?></span>
                                                        </td>
                                                    </tr>
                                                        
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            
                                            <tr class="row-1 addExpSubTotalRow">
                                                <td class="column-1">
                                                    Sub-total (B)
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmtTotalAdd"><?= (!empty($scrAmtTotalAdd)) ? amount_format($scrAmtTotalAdd) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applCITNotAmtTotalAdd"><?= (!empty($applCITNotAmtTotalAdd)) ? amount_format($applCITNotAmtTotalAdd) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applCITAmtTotalAdd"><?= (!empty($applCITAmtTotalAdd)) ? amount_format($applCITAmtTotalAdd) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applCITAllwdAmtTotalAdd"><?= (!empty($applCITAllwdAmtTotalAdd)) ? amount_format($applCITAllwdAmtTotalAdd) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applCITRejAmtTotalAdd"><?= (!empty($applCITRejAmtTotalAdd)) ? amount_format($applCITRejAmtTotalAdd) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applITATNotAmtTotalAdd"><?= (!empty($applITATNotAmtTotalAdd)) ? amount_format($applITATNotAmtTotalAdd) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applITATAmtTotalAdd"><?= (!empty($applITATAmtTotalAdd)) ? amount_format($applITATAmtTotalAdd) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applITATAllwdAmtTotalAdd"><?= (!empty($applITATAllwdAmtTotalAdd)) ? amount_format($applITATAllwdAmtTotalAdd) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applITATRejAmtTotalAdd"><?= (!empty($applITATRejAmtTotalAdd)) ? amount_format($applITATRejAmtTotalAdd) : "-"; ?></span>
                                                </td>
                                            </tr>
                                            <tr class="row-1 dedctExpHeadRow" <?php if(empty($ordAnlyExpDedData)): ?> id="dedctExpRow" <?php endif; ?> >
                                                <td class="column-1">
                                                    Deductions
                                                </td>
                                                <td class="column-1">
                                                    <span class="text-success mt-2 addExpBtn" data-id="2"></td>
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
                                                        <td class="column-1">
                                                            <?php $ordAnlyExpName = (!empty($e_ded_exp['ordAnlyExpName'])) ? $e_ded_exp['ordAnlyExpName']:""; ?>
                                                            <span class="amtSpan ordAnlyExpName"><?= $ordAnlyExpName; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($e_ded_exp['scrAmt'])) ? amount_format($e_ded_exp['scrAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applCITNotAmt"><?= (!empty($e_ded_exp['applCITNotAmt'])) ? amount_format($e_ded_exp['applCITNotAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applCITAmt"><?= (!empty($e_ded_exp['applCITAmt'])) ? amount_format($e_ded_exp['applCITAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applCITAllwdAmt"><?= (!empty($e_ded_exp['applCITAllwdAmt'])) ? amount_format($e_ded_exp['applCITAllwdAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applCITRejAmt"><?= (!empty($e_ded_exp['applCITRejAmt'])) ? amount_format($e_ded_exp['applCITRejAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applITATNotAmt"><?= (!empty($e_ded_exp['applITATNotAmt'])) ? amount_format($e_ded_exp['applITATNotAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applITATAmt"><?= (!empty($e_ded_exp['applITATAmt'])) ? amount_format($e_ded_exp['applITATAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applITATAllwdAmt"><?= (!empty($e_ded_exp['applITATAllwdAmt'])) ? amount_format($e_ded_exp['applITATAllwdAmt']) : "-"; ?></span>
                                                        </td>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan applITATRejAmt"><?= (!empty($e_ded_exp['applITATRejAmt'])) ? amount_format($e_ded_exp['applITATRejAmt']) : "-"; ?></span>
                                                        </td>
                                                    </tr>
                                                        
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            
                                            <tr class="row-1 dedctExpSubTotalRow">
                                                <td class="column-1">
                                                    Sub-total (C)
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmtTotalDed"><?= (!empty($scrAmtTotalDed)) ? amount_format($scrAmtTotalDed) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applCITNotAmtTotalDed"><?= (!empty($applCITNotAmtTotalDed)) ? amount_format($applCITNotAmtTotalDed) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applCITAmtTotalDed"><?= (!empty($applCITAmtTotalDed)) ? amount_format($applCITAmtTotalDed) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applCITAllwdAmtTotalDed"><?= (!empty($applCITAllwdAmtTotalDed)) ? amount_format($applCITAllwdAmtTotalDed) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applCITRejAmtTotalDed"><?= (!empty($applCITRejAmtTotalDed)) ? amount_format($applCITRejAmtTotalDed) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applITATNotAmtTotalDed"><?= (!empty($applITATNotAmtTotalDed)) ? amount_format($applITATNotAmtTotalDed) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applITATAmtTotalDed"><?= (!empty($applITATAmtTotalDed)) ? amount_format($applITATAmtTotalDed) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applITATAllwdAmtTotalDed"><?= (!empty($applITATAllwdAmtTotalDed)) ? amount_format($applITATAllwdAmtTotalDed) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan applITATRejAmtTotalDed"><?= (!empty($applITATRejAmtTotalDed)) ? amount_format($applITATRejAmtTotalDed) : "-"; ?></span>
                                                </td>
                                            </tr>
                                            <tr class="row-1">
                                                <td class="column-1">
                                                    Assessed Income (A+B-C)
                                                </td>
                                                <td class="column-1 text-right">
                                                    <?php $scrAmtAssdInc=($totalIncome+$scrAmtTotalAdd)-$scrAmtTotalDed; ?>
                                                    <span class="amtSpan scrAmtAssdInc"><?= (!empty($scrAmtAssdInc)) ? amount_format($scrAmtAssdInc) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <?php $applCITNotAmtAssdInc=$applCITNotAmtTotalAdd-$applCITNotAmtTotalDed; ?>
                                                    <span class="amtSpan applCITNotAmtAssdInc"><?= (!empty($applCITNotAmtAssdInc)) ? amount_format($applCITNotAmtAssdInc) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <?php $applCITAmtAssdInc=$applCITAmtTotalAdd-$applCITAmtTotalDed; ?>
                                                    <span class="amtSpan applCITAmtAssdInc"><?= (!empty($applCITAmtAssdInc)) ? amount_format($applCITAmtAssdInc) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <?php $applCITAllwdAmtAssdInc=$applCITAllwdAmtTotalAdd-$applCITAllwdAmtTotalDed; ?>
                                                    <span class="amtSpan applCITAllwdAmtAssdInc"><?= (!empty($applCITAllwdAmtAssdInc)) ? amount_format($applCITAllwdAmtAssdInc) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <?php $applCITRejAmtAssdInc=$applCITRejAmtTotalAdd-$applCITRejAmtTotalDed; ?>
                                                    <span class="amtSpan applCITRejAmtAssdInc"><?= (!empty($applCITRejAmtAssdInc)) ? amount_format($applCITRejAmtAssdInc) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <?php $applITATNotAmtAssdInc=$applITATNotAmtTotalAdd-$applITATNotAmtTotalDed; ?>
                                                    <span class="amtSpan applITATNotAmtAssdInc"><?= (!empty($applITATNotAmtAssdInc)) ? amount_format($applITATNotAmtAssdInc) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <?php $applITATAmtAssdInc=$applITATAmtTotalAdd-$applITATAmtTotalDed; ?>
                                                    <span class="amtSpan applITATAmtAssdInc"><?= (!empty($applITATAmtAssdInc)) ? amount_format($applITATAmtAssdInc) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <?php $applITATAllwdAmtAssdInc=$applITATAllwdAmtTotalAdd-$applITATAllwdAmtTotalDed; ?>
                                                    <span class="amtSpan applITATAllwdAmtAssdInc"><?= (!empty($applITATAllwdAmtAssdInc)) ? amount_format($applITATAllwdAmtAssdInc) : "-"; ?></span>
                                                </td>
                                                <td class="column-1 text-right">
                                                    <?php $applITATRejAmtAssdInc=$applITATRejAmtTotalAdd-$applITATRejAmtTotalDed; ?>
                                                    <span class="amtSpan applITATRejAmtAssdInc"><?= (!empty($applITATRejAmtAssdInc)) ? amount_format($applITATRejAmtAssdInc) : "-"; ?></span>
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
                                                <td class="column-1 text-right scrTD">
                                                    <?php $scrutinyIncAmt = (!empty($orderAnalysisArr['scrutinyIncAmt'])) ? $orderAnalysisArr['scrutinyIncAmt'] : "-"; ?>
                                                    <span class="amtSpan scrutinyIncAmt"><?= amount_format($scrutinyIncAmt); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $applCITIncAmt = (!empty($orderAnalysisArr['applCITIncAmt'])) ? $orderAnalysisArr['applCITIncAmt'] : "-"; ?>
                                                    <span class="amtSpan applCITIncAmt"><?= amount_format($applCITIncAmt); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $applITATIncAmt = (!empty($orderAnalysisArr['applITATIncAmt'])) ? $orderAnalysisArr['applITATIncAmt'] : "-"; ?>
                                                    <span class="amtSpan applITATIncAmt"><?= amount_format($applITATIncAmt); ?></span>
                                                </td>
                                            </tr>
                                            <tr class="row-1">
                                                <td class="column-1">
                                                    Additions
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
                                            <?php $interestAmt=array(); ?>
                                            <tr class="row-1 addTaxRow">
                                                <td class="column-1">
                                                    Interest
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $interestAmt[1] = (!empty($ordTaxData[1]['interestAmt'])) ? $ordTaxData[1]['interestAmt'] : "-"; ?>
                                                    <span class="amtSpan interestAmt"><?= amount_format($interestAmt[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $interestAmt[2] = (!empty($ordTaxData[2]['interestAmt'])) ? $ordTaxData[2]['interestAmt'] : "-"; ?>
                                                    <span class="amtSpan interestAmt"><?= amount_format($interestAmt[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $interestAmt[3] = (!empty($ordTaxData[3]['interestAmt'])) ? $ordTaxData[3]['interestAmt'] : "-"; ?>
                                                    <span class="amtSpan interestAmt"><?= amount_format($interestAmt[3]); ?></span>
                                                </td>
                                            </tr>
                                            <?php $penaltyAmt=array(); ?>
                                            <tr class="row-1 addTaxRow">
                                                <td class="column-1">
                                                    Penalty
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $penaltyAmt[1] = (!empty($ordTaxData[1]['penaltyAmt'])) ? $ordTaxData[1]['penaltyAmt'] : "-"; ?>
                                                    <span class="amtSpan penaltyAmt"><?= amount_format($penaltyAmt[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $penaltyAmt[2] = (!empty($ordTaxData[2]['penaltyAmt'])) ? $ordTaxData[2]['penaltyAmt'] : "-"; ?>
                                                    <span class="amtSpan penaltyAmt"><?= amount_format($penaltyAmt[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $penaltyAmt[3] = (!empty($ordTaxData[3]['penaltyAmt'])) ? $ordTaxData[3]['penaltyAmt'] : "-"; ?>
                                                    <span class="amtSpan penaltyAmt"><?= amount_format($penaltyAmt[3]); ?></span>
                                                </td>
                                            </tr>
                                            <?php $taxSubTotalAdd=array(); ?>
                                            <tr class="row-1">
                                                <td class="column-1">
                                                    Sub-total (B)
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $taxSubTotalAdd[1]=$interestAmt[1]+$penaltyAmt[1]; ?>
                                                    <span class="amtSpan taxSubTotalAdd"><?= amount_format($taxSubTotalAdd[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $taxSubTotalAdd[2]=$interestAmt[2]+$penaltyAmt[2]; ?>
                                                    <span class="amtSpan taxSubTotalAdd"><?= amount_format($taxSubTotalAdd[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $taxSubTotalAdd[3]=$interestAmt[3]+$penaltyAmt[3]; ?>
                                                    <span class="amtSpan taxSubTotalAdd"><?= amount_format($taxSubTotalAdd[3]); ?></span>
                                                </td>
                                            </tr>
                                            <?php $totalTaxPay=array(); ?>
                                            <tr class="row-1">
                                                <td class="column-1">
                                                    Total Tax Payable
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $totalTaxPay[1]=$scrutinyIncAmt+$taxSubTotalAdd[1]; ?>
                                                    <span class="amtSpan totalTaxPay"><?= amount_format($totalTaxPay[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $totalTaxPay[2]=$applCITIncAmt+$taxSubTotalAdd[2]; ?>
                                                    <span class="amtSpan totalTaxPay"><?= amount_format($totalTaxPay[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $totalTaxPay[3]=$applITATIncAmt+$taxSubTotalAdd[3]; ?>
                                                    <span class="amtSpan totalTaxPay"><?= amount_format($totalTaxPay[3]); ?></span>
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
                                            <?php $TDSAmt=array(); ?>
                                            <tr class="row-1 dedTaxRow">
                                                <td class="column-1">
                                                    TDS
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $TDSAmt[1] = (!empty($ordTaxData[1]['TDSAmt'])) ? $ordTaxData[1]['TDSAmt'] : "-"; ?>
                                                    <span class="amtSpan TDSAmt"><?= amount_format($TDSAmt[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $TDSAmt[2] = (!empty($ordTaxData[2]['TDSAmt'])) ? $ordTaxData[2]['TDSAmt'] : "-"; ?>
                                                    <span class="amtSpan TDSAmt"><?= amount_format($TDSAmt[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $TDSAmt[3] = (!empty($ordTaxData[3]['TDSAmt'])) ? $ordTaxData[3]['TDSAmt'] : "-"; ?>
                                                    <span class="amtSpan TDSAmt"><?= amount_format($TDSAmt[3]); ?></span>
                                                </td>
                                            </tr>
                                            <?php $advTaxAmt=array(); ?>
                                            <tr class="row-1 dedTaxRow">
                                                <td class="column-1">
                                                    Advance Tax
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $advTaxAmt[1] = (!empty($ordTaxData[1]['advTaxAmt'])) ? $ordTaxData[1]['advTaxAmt'] : "-"; ?>
                                                    <span class="amtSpan advTaxAmt"><?= amount_format($advTaxAmt[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $advTaxAmt[2] = (!empty($ordTaxData[2]['advTaxAmt'])) ? $ordTaxData[2]['advTaxAmt'] : "-"; ?>
                                                    <span class="amtSpan advTaxAmt"><?= amount_format($advTaxAmt[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $advTaxAmt[3] = (!empty($ordTaxData[3]['advTaxAmt'])) ? $ordTaxData[3]['advTaxAmt'] : "-"; ?>
                                                    <span class="amtSpan advTaxAmt"><?= amount_format($advTaxAmt[3]); ?></span>
                                                </td>
                                            </tr>
                                            <?php $selfAssmtTaxAmt=array(); ?>
                                            <tr class="row-1 dedTaxRow">
                                                <td class="column-1">
                                                    Self Assessment Tax
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $selfAssmtTaxAmt[1] = (!empty($ordTaxData[1]['selfAssmtTaxAmt'])) ? $ordTaxData[1]['selfAssmtTaxAmt'] : "-"; ?>
                                                    <span class="amtSpan selfAssmtTaxAmt"><?= amount_format($selfAssmtTaxAmt[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $selfAssmtTaxAmt[2] = (!empty($ordTaxData[2]['selfAssmtTaxAmt'])) ? $ordTaxData[2]['selfAssmtTaxAmt'] : "-"; ?>
                                                    <span class="amtSpan selfAssmtTaxAmt"><?= amount_format($selfAssmtTaxAmt[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $selfAssmtTaxAmt[3] = (!empty($ordTaxData[3]['selfAssmtTaxAmt'])) ? $ordTaxData[3]['selfAssmtTaxAmt'] : "-"; ?>
                                                    <span class="amtSpan selfAssmtTaxAmt"><?= amount_format($selfAssmtTaxAmt[3]); ?></span>
                                                </td>
                                            </tr>
                                            <?php $taxSubTotalDed=array(); ?>
                                            <tr class="row-1">
                                                <td class="column-1">
                                                    Sub-total (C)
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $taxSubTotalDed[1] = $TDSAmt[1]+$advTaxAmt[1]+$selfAssmtTaxAmt[1]; ?>
                                                    <span class="amtSpan taxSubTotalDed"><?= amount_format($taxSubTotalDed[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $taxSubTotalDed[2] = $TDSAmt[2]+$advTaxAmt[2]+$selfAssmtTaxAmt[2]; ?>
                                                    <span class="amtSpan taxSubTotalDed"><?= amount_format($taxSubTotalDed[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $taxSubTotalDed[3] = $TDSAmt[3]+$advTaxAmt[3]+$selfAssmtTaxAmt[3]; ?>
                                                    <span class="amtSpan taxSubTotalDed"><?= amount_format($taxSubTotalDed[3]); ?></span>
                                                </td>
                                            </tr>
                                            <?php $addtnlTaxPay=array(); ?>
                                            <tr class="row-1">
                                                <td class="column-1">
                                                    Additional Tax Payable
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $addtnlTaxPay[1] = $totalTaxPay[1]-$taxSubTotalDed[1]; ?>
                                                    <span class="amtSpan addtnlTaxPay"><?= amount_format($addtnlTaxPay[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $addtnlTaxPay[2] = $totalTaxPay[2]-$taxSubTotalDed[2]; ?>
                                                    <span class="amtSpan addtnlTaxPay"><?= amount_format($addtnlTaxPay[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $addtnlTaxPay[3] = $totalTaxPay[3]-$taxSubTotalDed[3]; ?>
                                                    <span class="amtSpan addtnlTaxPay"><?= amount_format($addtnlTaxPay[3]); ?></span>
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
                                            <?php $paidAtAppealAmt=array(); ?>
                                            <tr class="row-1 paidApplRow">
                                                <td class="column-1">
                                                    Paid at the time of Appeal
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $paidAtAppealAmt[1] = (!empty($ordTaxData[1]['paidAtAppealAmt'])) ? $ordTaxData[1]['paidAtAppealAmt'] : "-"; ?>
                                                    <span class="amtSpan paidAtAppealAmt"><?= amount_format($paidAtAppealAmt[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $paidAtAppealAmt[2] = (!empty($ordTaxData[2]['paidAtAppealAmt'])) ? $ordTaxData[2]['paidAtAppealAmt'] : "-"; ?>
                                                    <span class="amtSpan paidAtAppealAmt"><?= amount_format($paidAtAppealAmt[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $paidAtAppealAmt[3] = (!empty($ordTaxData[3]['paidAtAppealAmt'])) ? $ordTaxData[3]['paidAtAppealAmt'] : "-"; ?>
                                                    <span class="amtSpan paidAtAppealAmt"><?= amount_format($paidAtAppealAmt[3]); ?></span>
                                                </td>
                                            </tr>
                                            <?php $balAmtStay=array(); ?>
                                            <tr class="row-1">
                                                <td class="column-1">
                                                    Balance Amount Stayed
                                                </td>
                                                <td class="column-1 text-right scrTD">
                                                    <?php $balAmtStay[1] = $addtnlTaxPay[1]-$paidAtAppealAmt[1]; ?>
                                                    <span class="amtSpan addtnlTaxPay"><?= amount_format($balAmtStay[1]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applCITTD">
                                                    <?php $balAmtStay[2] = $addtnlTaxPay[2]-$paidAtAppealAmt[2]; ?>
                                                    <span class="amtSpan addtnlTaxPay"><?= amount_format($balAmtStay[2]); ?></span>
                                                </td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1 text-right applITATCIT">
                                                    <?php $balAmtStay[3] = $addtnlTaxPay[3]-$paidAtAppealAmt[3]; ?>
                                                    <span class="amtSpan addtnlTaxPay"><?= amount_format($balAmtStay[3]); ?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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