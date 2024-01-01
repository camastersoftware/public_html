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
    
    .no_bold{
        font-weight: 400 !important;
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
                <div class="box-header with-border flexbox text-center">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('employees'); ?>">
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
                                                <th class="column-1">Month & Year</th>
                                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                <?php
                                                    if($m_no<=9)
                                                        $m=$m_no+3;
                                                    else
                                                        $m=$m_no-9;
                                                ?>
                                                <?php $mth_nm=date('M', strtotime("2023-".$m."-1")); ?>
                                                <th class="column-1" width="8%"><?= $mth_nm; ?></th>	
                                                <?php endfor; ?>
                                                <th class="column-1">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="row-hover">
                                            <tr class="row-1">
                                                <td class="column-1" nowrap>
                                                    Salary Payment
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
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                            </tr>
                                            
                                            <?php if(!empty($salPmtArr)): ?>
                                                <?php foreach($salPmtArr AS $k_sal => $e_slp): ?>
                                                    <?php
                                                        $salaryParameterId = $e_slp['salaryParameterId'];
                                                        $empSalDivisionMthAmt = 0;
                                                        $empSalDivisionYrAmt = 0;
                                                        if(isset($empSalDivisionDataArr[$salaryParameterId]))
                                                        {
                                                            $empSalData = $empSalDivisionDataArr[$salaryParameterId];
                                                            
                                                            $empSalDivisionMthAmt = $empSalData['empSalDivisionMthAmt'];
                                                            $empSalDivisionYrAmt = $empSalData['empSalDivisionYrAmt'];
                                                        }
                                                    ?>
                                                    <tr class="row-1" >
                                                        <td class="column-1" nowrap>
                                                            <span class="amtSpan no_bold"><?= $e_slp['salaryParameter']; ?></span>
                                                        </td>
                                                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($empSalDivisionMthAmt)) ? amount_format($empSalDivisionMthAmt) : "-"; ?></span>
                                                        </td>
                                                        <?php endfor; ?>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($empSalDivisionYrAmt)) ? amount_format($empSalDivisionYrAmt) : "-"; ?></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <tr class="row-1" >
                                                <td class="column-1" nowrap>
                                                    <span class="amtSpan">Gross Salary (CTC)</span>
                                                </td>
                                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($grossSalaryAmtMth)) ? amount_format($grossSalaryAmtMth) : "-"; ?></span>
                                                </td>
                                                <?php endfor; ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($grossSalaryAmtYr)) ? amount_format($grossSalaryAmtYr) : "-"; ?></span>
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
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                            </tr>
                                            <tr class="row-1">
                                                <td class="column-1" nowrap>
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
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                            </tr>
                                            <?php if(!empty($salDedctnArr)): ?>
                                                <?php foreach($salDedctnArr AS $k_sal => $e_sld): ?>
                                                    <?php
                                                        $salaryParameterId = $e_sld['salaryParameterId'];
                                                        $empSalDivisionMthAmt = 0;
                                                        $empSalDivisionYrAmt = 0;
                                                        if(isset($empSalDivisionDataArr[$salaryParameterId]))
                                                        {
                                                            $empSalData = $empSalDivisionDataArr[$salaryParameterId];
                                                            
                                                            $empSalDivisionMthAmt = $empSalData['empSalDivisionMthAmt'];
                                                            $empSalDivisionYrAmt = $empSalData['empSalDivisionYrAmt'];
                                                        }
                                                    ?>
                                                    <tr class="row-1" >
                                                        <td class="column-1" nowrap>
                                                            <span class="amtSpan no_bold"><?= $e_sld['salaryParameter']; ?></span>
                                                        </td>
                                                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($empSalDivisionMthAmt)) ? amount_format($empSalDivisionMthAmt) : "-"; ?></span>
                                                        </td>
                                                        <?php endfor; ?>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($empSalDivisionYrAmt)) ? amount_format($empSalDivisionYrAmt) : "-"; ?></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <tr class="row-1" >
                                                <td class="column-1" nowrap>
                                                    <span class="amtSpan">Total</span>
                                                </td>
                                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($dedctnSalaryAmtMth)) ? amount_format($dedctnSalaryAmtMth) : "-"; ?></span>
                                                </td>
                                                <?php endfor; ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($dedctnSalaryAmtYr)) ? amount_format($dedctnSalaryAmtYr) : "-"; ?></span>
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
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                            </tr>
                                            <tr class="row-1">
                                                <td class="column-1" nowrap>
                                                    Net Amount Payable
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
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                                <td class="column-1"></td>
                                            </tr>
                                            <tr class="row-1" >
                                                <td class="column-1" nowrap>
                                                    <span class="amtSpan no_bold">Total</span>
                                                </td>
                                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($totalAmtPayableMth)) ? amount_format($totalAmtPayableMth) : "-"; ?></span>
                                                </td>
                                                <?php endfor; ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($totalAmtPayableYr)) ? amount_format($totalAmtPayableYr) : "-"; ?></span>
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