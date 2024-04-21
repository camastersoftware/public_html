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
<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox text-center">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('payroll'); ?>">
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
                                    <?php if(!empty($salPmtArr)): ?>
                                        <?php
                                            $userGrossAmtArr = array();
                                            foreach($salPmtArr AS $e_slp)
                                            {
                                                if(!empty($userArr))
                                                {
                                                    foreach($userArr AS $e_user)
                                                    {
                                                        if(isset($paramUserAmtArr[$e_slp['salaryParameterId']][$e_user['userId']]))
                                                        {
                                                            $paramUserAmtArray = $paramUserAmtArr[$e_slp['salaryParameterId']][$e_user['userId']];
                                                            $userGrossAmtArr[$e_user['userId']][] = $paramUserAmtArray;
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                            <thead>
                                                <tr class="row-1">
                                                    <th class="column-1" colspan="14">Gross Salary Payable</th>
                                                </tr>
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
                                                <?php $userGrossMthAmt=0; ?>
                                                <?php $userTotalGrossMthAmt=0; ?>
                                                <?php if(!empty($userArr)): ?>
                                                    <?php foreach($userArr AS $e_user): ?>
                                                    <?php
                                                        $userId = $e_user['userId'];
                                                        $userFullName = $e_user['userFullName'];
                                                        $userGrossAmt = 0;
                                                        $userTotalGrossAmt = 0;
                                                        if(isset($userGrossAmtArr[$userId]))
                                                        {
                                                            $userGrossAmt = array_sum($userGrossAmtArr[$userId]);
                                                        }
                                                    ?>
                                                    <tr class="row-1" >
                                                        <td class="column-1" nowrap>
                                                            <span class="amtSpan no_bold"><?= $userFullName; ?></span>
                                                        </td>
                                                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($userGrossAmt)) ? amount_format($userGrossAmt) : "-"; ?></span>
                                                        </td>
                                                        <?php $userTotalGrossAmt+=$userGrossAmt; ?>
                                                        <?php endfor; ?>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($userTotalGrossAmt)) ? amount_format($userTotalGrossAmt) : "-"; ?></span>
                                                        </td>
                                                    </tr>
                                                    <?php $userGrossMthAmt+=$userGrossAmt; ?>
                                                    <?php $userTotalGrossMthAmt+=$userTotalGrossAmt; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <tr class="row-1" >
                                                    <td class="column-1" nowrap>
                                                        <span class="amtSpan">Total</span>
                                                    </td>
                                                    <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                    <td class="column-1 text-right">
                                                        <span class="amtSpan scrAmt"><?= (!empty($userGrossMthAmt)) ? amount_format($userGrossMthAmt) : "-"; ?></span>
                                                    </td>
                                                    <?php endfor; ?>
                                                    <td class="column-1 text-right">
                                                        <span class="amtSpan scrAmt"><?= (!empty($userTotalGrossMthAmt)) ? amount_format($userTotalGrossMthAmt) : "-"; ?></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                    
                                    <?php $deductionMthAmtArr = array(); ?>
                                    <?php $deductionTotalAmtArr = array(); ?>
                                    <?php if(!empty($salDedctnArr)): ?>
                                        <?php foreach($salDedctnArr AS $e_sld): ?>
                                            <?php $salaryParameterId = $e_sld['salaryParameterId']; ?>
                                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                <thead>
                                                     <tr class="row-1">
                                                        <th class="column-1" colspan="14"><?= $e_sld['salaryParameter']; ?></th>
                                                    </tr>
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
                                                    <?php $userParamMthAmt = 0; ?>
                                                    <?php $userTotalParamMthAmt = 0; ?>
                                                    <?php if(!empty($userArr)): ?>
                                                        <?php foreach($userArr AS $e_user): ?>
                                                        <?php
                                                            $userId = $e_user['userId'];
                                                            $userFullName = $e_user['userFullName'];
                                                            $userParamAmt = 0;
                                                            $userTotalParamAmt = 0;
                                                            if(isset($paramUserAmtArr[$salaryParameterId][$userId]))
                                                            {
                                                                $userParamAmt = $paramUserAmtArr[$salaryParameterId][$userId];
                                                            }
                                                        ?>
                                                        <tr class="row-1" >
                                                            <td class="column-1" nowrap>
                                                                <span class="amtSpan no_bold"><?= $userFullName; ?></span>
                                                            </td>
                                                            <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                            <td class="column-1 text-right">
                                                                <span class="amtSpan scrAmt"><?= (!empty($userParamAmt)) ? amount_format($userParamAmt) : "-"; ?></span>
                                                            </td>
                                                            <?php $userTotalParamAmt+=$userParamAmt; ?>
                                                            <?php endfor; ?>
                                                            <td class="column-1 text-right">
                                                                <span class="amtSpan scrAmt"><?= (!empty($userTotalParamAmt)) ? amount_format($userTotalParamAmt) : "-"; ?></span>
                                                            </td>
                                                        </tr>
                                                        <?php $userParamMthAmt+=$userParamAmt; ?>
                                                        <?php $userTotalParamMthAmt+=$userTotalParamAmt; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <tr class="row-1" >
                                                        <td class="column-1" nowrap>
                                                            <span class="amtSpan">Total</span>
                                                        </td>
                                                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($userParamMthAmt)) ? amount_format($userParamMthAmt) : "-"; ?></span>
                                                        </td>
                                                        <?php endfor; ?>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($userTotalParamMthAmt)) ? amount_format($userTotalParamMthAmt) : "-"; ?></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <?php $deductionMthAmtArr[$salaryParameterId] = $userParamMthAmt; ?>
                                            <?php $deductionTotalAmtArr[$salaryParameterId] = $userTotalParamMthAmt; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    
                                    <?php if(!empty($salDedctnArr)): ?>
                                        <?php
                                            $userNetAmtArr = array();
                                            foreach($salDedctnArr AS $e_sld)
                                            {
                                                if(!empty($userArr))
                                                {
                                                    foreach($userArr AS $e_user)
                                                    {
                                                        if(isset($paramUserAmtArr[$e_sld['salaryParameterId']][$e_user['userId']]))
                                                        {
                                                            $paramUserAmtArray = $paramUserAmtArr[$e_sld['salaryParameterId']][$e_user['userId']];
                                                            $userNetAmtArr[$e_user['userId']][] = $paramUserAmtArray;
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                            <thead>
                                                <tr class="row-1">
                                                    <th class="column-1" colspan="14">Net Salary Payable</th>
                                                </tr>
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
                                                <?php $userNetMthAmt=0; ?>
                                                <?php $userTotalNetMthAmt=0; ?>
                                                <?php if(!empty($userArr)): ?>
                                                    <?php foreach($userArr AS $e_user): ?>
                                                    <?php
                                                        $userId = $e_user['userId'];
                                                        $userFullName = $e_user['userFullName'];
                                                        $userGrossAmt = 0;
                                                        $userNetAmt = 0;
                                                        $userTotalNetAmt = 0;
                                                        if(isset($userGrossAmtArr[$userId]))
                                                        {
                                                            $userGrossAmt = array_sum($userGrossAmtArr[$userId]);
                                                        }
                                                        if(isset($userNetAmtArr[$userId]))
                                                        {
                                                            $netAmt = array_sum($userNetAmtArr[$userId]);
                                                            $userNetAmt = $userGrossAmt-$netAmt;
                                                        }
                                                    ?>
                                                    <tr class="row-1" >
                                                        <td class="column-1" nowrap>
                                                            <span class="amtSpan no_bold"><?= $userFullName; ?></span>
                                                        </td>
                                                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($userNetAmt)) ? amount_format($userNetAmt) : "-"; ?></span>
                                                        </td>
                                                        <?php $userTotalNetAmt+=$userNetAmt; ?>
                                                        <?php endfor; ?>
                                                        <td class="column-1 text-right">
                                                            <span class="amtSpan scrAmt"><?= (!empty($userTotalNetAmt)) ? amount_format($userTotalNetAmt) : "-"; ?></span>
                                                        </td>
                                                    </tr>
                                                    <?php $userNetMthAmt+=$userNetAmt; ?>
                                                    <?php $userTotalNetMthAmt+=$userTotalNetAmt; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <tr class="row-1" >
                                                    <td class="column-1" nowrap>
                                                        <span class="amtSpan">Total</span>
                                                    </td>
                                                    <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                    <td class="column-1 text-right">
                                                        <span class="amtSpan scrAmt"><?= (!empty($userNetMthAmt)) ? amount_format($userNetMthAmt) : "-"; ?></span>
                                                    </td>
                                                    <?php endfor; ?>
                                                    <td class="column-1 text-right">
                                                        <span class="amtSpan scrAmt"><?= (!empty($userTotalNetMthAmt)) ? amount_format($userTotalNetMthAmt) : "-"; ?></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                        <thead>
                                            <tr class="row-1">
                                                <th class="column-1" colspan="14">Summary of Payable</th>
                                            </tr>
                                            <tr class="row-1">
                                                <th class="column-1">Nature of Payment</th>
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
                                            <tr class="row-1" >
                                                <td class="column-1" nowrap>
                                                    <span class="amtSpan no_bold">Net Salary Payable</span>
                                                </td>
                                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($userNetMthAmt)) ? amount_format($userNetMthAmt) : "-"; ?></span>
                                                </td>
                                                <?php endfor; ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($userTotalNetMthAmt)) ? amount_format($userTotalNetMthAmt) : "-"; ?></span>
                                                </td>
                                            </tr>
                                            <?php $totalMthPayable=$userNetMthAmt; ?>
                                            <?php $totalPayable=$userTotalNetMthAmt; ?>
                                            <?php if(!empty($salDedctnArr)): ?>
                                                <?php foreach($salDedctnArr AS $e_sld): ?>
                                                <?php
                                                    $salaryParameterId = $e_sld['salaryParameterId'];
                                                    
                                                    $dedAmtAmt = 0;
                                                    $dedTotalAmtAmt = 0;
                                                    if(isset($deductionMthAmtArr[$salaryParameterId]))
                                                    {
                                                        $dedAmtAmt = $deductionMthAmtArr[$salaryParameterId];
                                                    }
                                                    if(isset($deductionTotalAmtArr[$salaryParameterId]))
                                                    {
                                                        $dedTotalAmtAmt = $deductionTotalAmtArr[$salaryParameterId];
                                                    }
                                                ?>
                                                <tr class="row-1" >
                                                    <td class="column-1" nowrap>
                                                        <span class="amtSpan no_bold"><?= $e_sld['salaryParameter']; ?></span>
                                                    </td>
                                                    <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                    <td class="column-1 text-right">
                                                        <span class="amtSpan scrAmt"><?= (!empty($dedAmtAmt)) ? amount_format($dedAmtAmt) : "-"; ?></span>
                                                    </td>
                                                    <?php endfor; ?>
                                                    <td class="column-1 text-right">
                                                        <span class="amtSpan scrAmt"><?= (!empty($dedTotalAmtAmt)) ? amount_format($dedTotalAmtAmt) : "-"; ?></span>
                                                    </td>
                                                </tr>
                                                <?php $totalMthPayable+=$dedAmtAmt; ?>
                                                <?php $totalPayable+=$dedTotalAmtAmt; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <tr class="row-1" >
                                                <td class="column-1" nowrap>
                                                    <span class="amtSpan">Total</span>
                                                </td>
                                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($totalMthPayable)) ? amount_format($totalMthPayable) : "-"; ?></span>
                                                </td>
                                                <?php endfor; ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($totalPayable)) ? amount_format($totalPayable) : "-"; ?></span>
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
                                            <tr class="row-1" >
                                                <td class="column-1" nowrap>
                                                    <span class="amtSpan">Gross Salary Payable</span>
                                                </td>
                                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($userGrossMthAmt)) ? amount_format($userGrossMthAmt) : "-"; ?></span>
                                                </td>
                                                <?php endfor; ?>
                                                <td class="column-1 text-right">
                                                    <span class="amtSpan scrAmt"><?= (!empty($userTotalGrossMthAmt)) ? amount_format($userTotalGrossMthAmt) : "-"; ?></span>
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