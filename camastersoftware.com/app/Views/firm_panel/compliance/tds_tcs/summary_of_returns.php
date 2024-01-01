
<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
    .modal-xl {
        max-width: 1295px !important;
    }
    
    #filterLabels div.col-md-6{
        font-size: 15px !important;
        font-weight: bold !important;
    }
    
    .tabcontent-border {
        border: 1px solid #bfbfbf !important;
    }
    
    td.column_date {
        font-size: 15px !important;
    }
    
    .tablepress tbody td, .tablepress tfoot th {
        border: 1px solid #015aacab !important;
        /*color: #000;*/
    }
    
    .nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
        border-color: #015aac #015aac #015aac !important;
    }
    
    .nav-tabs .nav-link {
        position: relative;
        color: #7792b1;
        padding: 0.5rem 1.25rem;
        border-radius: 0;
        -webkit-transition: 0.5s;
        transition: 0.5s;
        border: 1px solid #015aac !important;
            border-top-color: rgb(1, 90, 172);
            border-right-color: rgb(1, 90, 172);
            border-bottom-color: rgb(1, 90, 172);
            border-left-color: rgb(1, 90, 172);
    }
    
    table.dataTable {
      border-collapse: separate !important;
      font-size: 13px !important;
    }
    
    .theme-primary .btn-info {
      height: 25px !important;
    }
    
    .due_date_for_name{
        font-size: 16px !important;
        /*font-weight: 700 !important;*/
        color: #000 !important;
    }
    
    .ddfColTd{
        height: 50px !important;
    }
    
    .ddfColTd span{
        font-size: 16px !important;
        color: #000 !important;
    }
    
    .misCount{
        font-size:15px !important; 
        font-weight: 800 !important;
    }
    
    .misTotalCount{
        font-size:16px !important; 
        font-weight: 800 !important;
    }
    
    #tablepress-2 tr th {
        font-size:16px !important; 
        font-weight: 800 !important;
    }
    
    .mis_report_summary .nav-item .nav-link{
        border-radius: 12px !important;
        display: inline-block !important;
        width: 75% !important;
        font-size: 18px !important;
    }
    
    .mis_report_summary .nav-item .nav-link.active span{
        color: #fff !important;
    }
    
    .mis_report_summary .nav-tabs .nav-link{
        margin-bottom: 20px !important;
    }
    
    /*
    .bottom_mis_summary_div .tablepress th, .bottom_mis_summary_div .tablepress td{
        padding: 0px 5px !important;
        height: 30px !important;
    }
    */
    
    .middle_line_mis_summary{
        background-color: #005495 !important;
    }
    
    .theme-primary .nav-tabs .nav-link.active {
         border-color: #F99D27 !important;
         background-color: #F99D27 !important;
    }
</style>

<?php 
    $totalMisMthCountArr=array(); 
    $filedMisMthCountArr=array(); 
    $pendingMisMthCountArr=array(); 
?>

    <!-- Main content -->
    <section class="content mt-35">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border flexbox">
                        <h4 class="box-title font-weight-bold">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            <a href="<?= base_url('tds-tcs-mis-report'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body mis_report_summary">
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <li class="nav-item"> 
                                <a class="nav-link active" id="total_mis_returns" data-toggle="tab" href="#total_mis_returns_tab" role="tab" aria-controls="profile">
                                    <span class="hidden-sm-up">
                                        <i class="ion-person"></i>
                                    </span> 
                                    <span class="hidden-xs-down year-color font-weight-bold">Returns : Due</span>
                                </a>
                            </li>	
                            <li class="nav-item"> 
                                <a class="nav-link" id="filed_mis_returns" data-toggle="tab" href="#filed_mis_returns_tab" role="tab" aria-controls="profile">
                                    <span class="hidden-sm-up">
                                        <i class="ion-person"></i>
                                    </span> 
                                    <span class="hidden-xs-down year-color font-weight-bold">Returns : Filed</span>
                                </a>
                            </li>	
                            <li class="nav-item"> 
                                <a class="nav-link" id="pending_mis_returns" data-toggle="tab" href="#pending_mis_returns_tab" role="tab" aria-controls="profile">
                                    <span class="hidden-sm-up">
                                        <i class="ion-person"></i>
                                    </span> 
                                    <span class="hidden-xs-down year-color font-weight-bold">Returns : Pending</span>
                                </a>
                            </li>	
                        </ul>
                        <div class="tab-content tabcontent-border p-5" id="myTabContent">
                            
                            <div class="tab-pane fade table-responsive show active" id="total_mis_returns_tab" role="tabpanel" aria-labelledby="total_mis_returns_tab">
                                <?php $isRecordsExists=false; ?>
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1" width="24%">Due Date For</th>
                                            <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                <?php
                                                    if($m_no<=9)
                                                        $m=$m_no+3;
                                                    else
                                                        $m=$m_no-9;
                                                ?>
                                                <?php $mth_nm=date('M', strtotime("2021-".$m."-1")); ?>
                                                <th class="column-1" width="5.75%"><?= $mth_nm; ?></th>
                                            <?php endfor; ?>
                                            <th class="column-1" width="7%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">
                                        <?php $totalMisCount=0; ?>
                                        <?php $totalSumMisCount=0; ?>
                                        <?php if(!empty($dueDateForArr)): ?>
                                            <?php foreach($dueDateForArr AS $k_row=>$e_row): ?>
                                                
                                                <?php $totalMisCount=0; ?>
                                                <?php $ddfId=$e_row['act_option_map_id']; ?>
                                                <?php $ddfName=$e_row['act_option_name']; ?>
                                                
                                                <?php if(in_array($ddfId, $ddfIDArr)): ?>
                                                    <?php $isRecordsExists=true; ?>
                                                    <?php
                                                        $dueDateForDataArray=$dueDateForDataArr[$ddfId];
                                                        
                                                        $ddfForm="";
                                                        $ddfSection="";
                                                        
                                                        if(!empty($dueDateForDataArray['due_date_form'])){
                                                            $ddfForm=$dueDateForDataArray['due_date_form'];
                                                        }
                                                        
                                                        if(!empty($dueDateForDataArray['due_date_section'])){
                                                            $ddfSection=$dueDateForDataArray['due_date_section'];
                                                        }
                                                    ?>
                                                    <tr class="row-2">
                                                        <td class="ddfColTd" nowrap width="24%">
                                                            <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $ddfName; ?>">
                                                                <?php
                                                                    if(strlen($ddfName)>20)
                                                                    {
                                                                        $ddfNameVar=substr($ddfName, 0, 20)."..";
                                                                    }
                                                                    else
                                                                    {
                                                                        $ddfNameVar=$ddfName;
                                                                    }
                                                                ?>
                                                                <span class="due_date_for_name">
                                                                   <?= $ddfName; ?>
                                                                </span>
                                                            </a>
                                                            <br>
                                                            <span class="font-weight-bold">Form : </span><span><?= (!empty($ddfForm)) ? $ddfForm:"N/A"; ?></span>
                                                            <span class="font-weight-bold">Section : </span><span><?= (!empty($ddfSection)) ? $ddfSection:"N/A"; ?></span>
                                                        </td>
                                                        <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                            <?php
                                                                if($mt_no<=9)
                                                                    $mth=$mt_no+3;
                                                                else
                                                                    $mth=$mt_no-9;
                                                            ?>
                                                            <td class="text-center" width="5.75%">
                                                                <?php
                                                                    $dueDateCount=0;
                                                                    if(isset($totalReturnsCountArr[$ddfId][$mth]))
                                                                    {
                                                                        $dueDateDataArr=$totalReturnsCountArr[$ddfId][$mth];
                                                                        
                                                                        $dueDateCount=$dueDateDataArr['totalWorkCount'];
                                                                    }
                                                                ?>
                                                                <?php if($dueDateCount!=0): ?>
                                                                    <span class="misCount pull-right"><?= $dueDateCount; ?></span>
                                                                <?php else: ?>
                                                                    <span class="misCount"><?= "-"; ?></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php $totalMisMthCountArr[$mth][]=$dueDateCount; ?>
                                                            <?php $totalMisCount+=$dueDateCount; ?>
                                                        <?php endfor; ?>
                                                        <?php $totalSumMisCount+=$totalMisCount; ?>
                                                        <td nowrap class="text-right" width="7%">
                                                            <span class="misTotalCount"><?= $totalMisCount; ?></span>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if(!$isRecordsExists): ?>
                                            <tr>
                                                <td colspan="14">
                                                    <center>No records found :(</center>
                                                </td>
                                            <tr>
                                        <?php else: ?>
                                            <tr class="row-2">
                                                <td class="ddfColTd" nowrap width="24%">
                                                    <span class="font-weight-bold pull-right">Total : </span>
                                                </td>
                                                <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                    <?php
                                                        if($mt_no<=9)
                                                            $mth=$mt_no+3;
                                                        else
                                                            $mth=$mt_no-9;
                                                    ?>
                                                    <td class="text-center" width="5.75%">
                                                        <?php
                                                            $totalMisMthCount=0;
                                                            if(isset($totalMisMthCountArr[$mth]))
                                                            {
                                                                $totalMisMthCount=array_sum($totalMisMthCountArr[$mth]);
                                                            }
                                                        ?>
                                                        <?php if($totalMisMthCount!=0): ?>
                                                            <span class="misCount pull-right"><?= $totalMisMthCount; ?></span>
                                                        <?php else: ?>
                                                            <span class="misCount"><?= "-"; ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endfor; ?>
                                                <td nowrap class="text-right" width="7%">
                                                    <?php if($totalSumMisCount!=0): ?>
                                                        <span class="misTotalCount pull-right"><?= $totalSumMisCount; ?></span>
                                                    <?php else: ?>
                                                        <span class="misTotalCount"><?= "-"; ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="tab-pane fade table-responsive" id="filed_mis_returns_tab" role="tabpanel" aria-labelledby="filed_mis_returns_tab">
                                <?php $isRecordsExists=false; ?>
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1" width="24%">Due Date For - Filed</th>
                                            <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                <?php
                                                    if($m_no<=9)
                                                        $m=$m_no+3;
                                                    else
                                                        $m=$m_no-9;
                                                ?>
                                                <?php $mth_nm=date('M', strtotime("2021-".$m."-1")); ?>
                                                <th class="column-1" width="5.75%"><?= $mth_nm; ?></th>
                                            <?php endfor; ?>
                                            <th class="column-1" width="7%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">
                                        <?php $filedMisCount=0; ?>
                                        <?php $filedSumMisCount=0; ?>
                                        <?php if(!empty($dueDateForArr)): ?>
                                            <?php foreach($dueDateForArr AS $k_row=>$e_row): ?>
                                                
                                                <?php $filedMisCount=0; ?>
                                                <?php $ddfId=$e_row['act_option_map_id']; ?>
                                                <?php $ddfName=$e_row['act_option_name']; ?>
                                                
                                                <?php if(in_array($ddfId, $ddfIDArr)): ?>
                                                    <?php $isRecordsExists=true; ?>
                                                    <?php
                                                        $dueDateForDataArray=$dueDateForDataArr[$ddfId];
                                                        
                                                        $ddfForm="";
                                                        $ddfSection="";
                                                        
                                                        if(!empty($dueDateForDataArray['due_date_form'])){
                                                            $ddfForm=$dueDateForDataArray['due_date_form'];
                                                        }
                                                        
                                                        if(!empty($dueDateForDataArray['due_date_section'])){
                                                            $ddfSection=$dueDateForDataArray['due_date_section'];
                                                        }
                                                    ?>
                                                    <tr class="row-2">
                                                        <td class="ddfColTd" nowrap width="24%">
                                                            <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $ddfName; ?>">
                                                                <?php
                                                                    if(strlen($ddfName)>20)
                                                                    {
                                                                        $ddfNameVar=substr($ddfName, 0, 20)."..";
                                                                    }
                                                                    else
                                                                    {
                                                                        $ddfNameVar=$ddfName;
                                                                    }
                                                                ?>
                                                                <span class="due_date_for_name">
                                                                   <?= $ddfName; ?>
                                                                </span>
                                                            </a>
                                                            <br>
                                                            <span class="font-weight-bold">Form : </span><span><?= (!empty($ddfForm)) ? $ddfForm:"N/A"; ?></span>
                                                            <span class="font-weight-bold">Section : </span><span><?= (!empty($ddfSection)) ? $ddfSection:"N/A"; ?></span>
                                                        </td>
                                                        <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                            <?php
                                                                if($mt_no<=9)
                                                                    $mth=$mt_no+3;
                                                                else
                                                                    $mth=$mt_no-9;
                                                            ?>
                                                            <td class="text-center" width="5.75%">
                                                                <?php
                                                                    $dueDateCount=0;
                                                                    if(isset($filedReturnsCountArr[$ddfId][$mth]))
                                                                    {
                                                                        $dueDateDataArr=$filedReturnsCountArr[$ddfId][$mth];
                                                                        
                                                                        $dueDateCount=$dueDateDataArr['filedWorkCount'];
                                                                    }
                                                                ?>
                                                                <?php if($dueDateCount!=0): ?>
                                                                    <span class="misCount pull-right"><?= $dueDateCount; ?></span>
                                                                <?php else: ?>
                                                                    <span class="misCount"><?= "-"; ?></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php $filedMisMthCountArr[$mth][]=$dueDateCount; ?>
                                                            <?php $filedMisCount+=$dueDateCount; ?>
                                                        <?php endfor; ?>
                                                        <?php $filedSumMisCount+=$filedMisCount; ?>
                                                        <td nowrap class="text-right" width="7%">
                                                            <span class="misTotalCount"><?= $filedMisCount; ?></span>
                                                        </td>
                                                    </tr>
                                                    
                                                <?php endif; ?>
                                                
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if(!$isRecordsExists): ?>
                                            <tr>
                                                <td colspan="14">
                                                    <center>No records found :(</center>
                                                </td>
                                            <tr>
                                        <?php else: ?>
                                            <tr class="row-2">
                                                <td class="ddfColTd" nowrap width="24%">
                                                    <span class="font-weight-bold pull-right">Total : </span>
                                                </td>
                                                <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                    <?php
                                                        if($mt_no<=9)
                                                            $mth=$mt_no+3;
                                                        else
                                                            $mth=$mt_no-9;
                                                    ?>
                                                    <td class="text-center" width="5.75%">
                                                        <?php
                                                            $filedMisMthCount=0;
                                                            if(isset($filedMisMthCountArr[$mth]))
                                                            {
                                                                $filedMisMthCount=array_sum($filedMisMthCountArr[$mth]);
                                                            }
                                                        ?>
                                                        <?php if($filedMisMthCount!=0): ?>
                                                            <span class="misCount pull-right"><?= $filedMisMthCount; ?></span>
                                                        <?php else: ?>
                                                            <span class="misCount"><?= "-"; ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endfor; ?>
                                                <td nowrap class="text-right" width="7%">
                                                    <?php if($filedSumMisCount!=0): ?>
                                                        <span class="misTotalCount pull-right"><?= $filedSumMisCount; ?></span>
                                                    <?php else: ?>
                                                        <span class="misTotalCount"><?= "-"; ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="tab-pane fade table-responsive" id="pending_mis_returns_tab" role="tabpanel" aria-labelledby="pending_mis_returns_tab">
                                <?php $isRecordsExists=false; ?>
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1" width="24%">Due Date For</th>
                                            <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                <?php
                                                    if($m_no<=9)
                                                        $m=$m_no+3;
                                                    else
                                                        $m=$m_no-9;
                                                ?>
                                                <?php $mth_nm=date('M', strtotime("2021-".$m."-1")); ?>
                                                <th class="column-1" width="5.75%"><?= $mth_nm; ?></th>
                                            <?php endfor; ?>
                                            <th class="column-1" width="7%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">
                                        <?php $pendingMisCount=0; ?>
                                        <?php $pendingSumMisCount=0; ?>
                                        <?php if(!empty($dueDateForArr)): ?>
                                            <?php foreach($dueDateForArr AS $k_row=>$e_row): ?>
                                                
                                                <?php $pendingMisCount=0; ?>
                                                <?php $ddfId=$e_row['act_option_map_id']; ?>
                                                <?php $ddfName=$e_row['act_option_name']; ?>
                                                
                                                <?php if(in_array($ddfId, $ddfIDArr)): ?>
                                                    <?php $isRecordsExists=true; ?>
                                                    <?php
                                                        $dueDateForDataArray=$dueDateForDataArr[$ddfId];
                                                        
                                                        $ddfForm="";
                                                        $ddfSection="";
                                                        
                                                        if(!empty($dueDateForDataArray['due_date_form'])){
                                                            $ddfForm=$dueDateForDataArray['due_date_form'];
                                                        }
                                                        
                                                        if(!empty($dueDateForDataArray['due_date_section'])){
                                                            $ddfSection=$dueDateForDataArray['due_date_section'];
                                                        }
                                                    ?>
                                                    <tr class="row-2">
                                                        <td class="ddfColTd" nowrap width="24%">
                                                            <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $ddfName; ?>">
                                                                <?php
                                                                    if(strlen($ddfName)>20)
                                                                    {
                                                                        $ddfNameVar=substr($ddfName, 0, 20)."..";
                                                                    }
                                                                    else
                                                                    {
                                                                        $ddfNameVar=$ddfName;
                                                                    }
                                                                ?>
                                                                <span class="due_date_for_name">
                                                                   <?= $ddfName; ?>
                                                                </span>
                                                            </a>
                                                            <br>
                                                            <span class="font-weight-bold">Form : </span><span><?= (!empty($ddfForm)) ? $ddfForm:"N/A"; ?></span>
                                                            <span class="font-weight-bold">Section : </span><span><?= (!empty($ddfSection)) ? $ddfSection:"N/A"; ?></span>
                                                        </td>
                                                        <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                            <?php
                                                                if($mt_no<=9)
                                                                    $mth=$mt_no+3;
                                                                else
                                                                    $mth=$mt_no-9;
                                                            ?>
                                                            <td class="text-center" width="5.75%">
                                                                <?php
                                                                    $dueDateCount=$totalWorkCount=$filedWorkCount=0;
                                                                    
                                                                    if(isset($totalReturnsCountArr[$ddfId][$mth]))
                                                                    {
                                                                        $totalDueDateDataArr=$totalReturnsCountArr[$ddfId][$mth];
                                                                        
                                                                        $totalWorkCount=$totalDueDateDataArr['totalWorkCount'];
                                                                    }
                                                                    
                                                                    if(isset($filedReturnsCountArr[$ddfId][$mth]))
                                                                    {
                                                                        $filedDueDateDataArr=$filedReturnsCountArr[$ddfId][$mth];
                                                                        
                                                                        $filedWorkCount=$filedDueDateDataArr['filedWorkCount'];
                                                                    }
                                                                    
                                                                    $dueDateCount = $totalWorkCount-$filedWorkCount;
                                                                ?>
                                                                <?php if($dueDateCount!=0): ?>
                                                                    <span class="misCount pull-right"><?= $dueDateCount; ?></span>
                                                                <?php else: ?>
                                                                    <span class="misCount"><?= "-"; ?></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php $pendingMisMthCountArr[$mth][]=$dueDateCount; ?>
                                                            <?php $pendingMisCount+=$dueDateCount; ?>
                                                        <?php endfor; ?>
                                                        <?php $pendingSumMisCount+=$pendingMisCount; ?>
                                                        <td nowrap class="text-right" width="7%">
                                                            <span class="misTotalCount"><?= $pendingMisCount; ?></span>
                                                        </td>
                                                    </tr>
                                                    
                                                <?php endif; ?>
                                                
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if(!$isRecordsExists): ?>
                                            <tr>
                                                <td colspan="14">
                                                    <center>No records found :(</center>
                                                </td>
                                            <tr>
                                        <?php else: ?>
                                            <tr class="row-2">
                                                <td class="ddfColTd" nowrap width="24%">
                                                    <span class="font-weight-bold pull-right">Total : </span>
                                                </td>
                                                <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                    <?php
                                                        if($mt_no<=9)
                                                            $mth=$mt_no+3;
                                                        else
                                                            $mth=$mt_no-9;
                                                    ?>
                                                    <td class="text-center" width="5.75%">
                                                        <?php
                                                            $pendingMisMthCount=0;
                                                            if(isset($pendingMisMthCountArr[$mth]))
                                                            {
                                                                $pendingMisMthCount=array_sum($pendingMisMthCountArr[$mth]);
                                                            }
                                                        ?>
                                                        <?php if($pendingMisMthCount!=0): ?>
                                                            <span class="misCount pull-right"><?= $pendingMisMthCount; ?></span>
                                                        <?php else: ?>
                                                            <span class="misCount"><?= "-"; ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endfor; ?>
                                                <td nowrap class="text-right" width="7%">
                                                    <?php if($pendingSumMisCount!=0): ?>
                                                        <span class="misTotalCount pull-right"><?= $pendingSumMisCount; ?></span>
                                                    <?php else: ?>
                                                        <span class="misTotalCount"><?= "-"; ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- ------------------------------------------------------Summary Div Starts---------------------------------------------------------- -->
                            
                            <div class="row">
                                <div class="col-md-12 h-20 mb-5 mt-20 middle_line_mis_summary"></div>
                                <div class="col-md-12 bottom_mis_summary_div">
                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                        <thead>
                                            <tr class="row-1">
                                                <th class="column-1" width="28%">Summary</th>
                                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                    <?php
                                                        if($m_no<=9)
                                                            $m=$m_no+3;
                                                        else
                                                            $m=$m_no-9;
                                                    ?>
                                                    <?php $mth_nm=date('M', strtotime("2021-".$m."-1")); ?>
                                                    <th class="column-1" ><?= $mth_nm; ?></th>
                                                <?php endfor; ?>
                                                <th class="column-1" width="7%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="row-hover">
                                            <tr class="row-2">
                                                <td class="ddfColTd" nowrap width="28%">
                                                    <span class="font-weight-bold">Returns : Due </span>
                                                </td>
                                                <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                    <?php
                                                        if($mt_no<=9)
                                                            $mth=$mt_no+3;
                                                        else
                                                            $mth=$mt_no-9;
                                                    ?>
                                                    <td class="text-center">
                                                        <?php
                                                            $totalMisMthCount=0;
                                                            if(isset($totalMisMthCountArr[$mth]))
                                                            {
                                                                $totalMisMthCount=array_sum($totalMisMthCountArr[$mth]);
                                                            }
                                                        ?>
                                                        <?php if($totalMisMthCount!=0): ?>
                                                            <span class="misCount pull-right"><?= $totalMisMthCount; ?></span>
                                                        <?php else: ?>
                                                            <span class="misCount"><?= "-"; ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endfor; ?>
                                                <td nowrap class="text-right" width="7%">
                                                    <?php if($totalSumMisCount!=0): ?>
                                                        <span class="misTotalCount pull-right"><?= $totalSumMisCount; ?></span>
                                                    <?php else: ?>
                                                        <span class="misTotalCount"><?= "-"; ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr class="row-2">
                                                <td class="ddfColTd" nowrap width="28%">
                                                    <span class="font-weight-bold">Returns : Filed </span>
                                                </td>
                                                <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                    <?php
                                                        if($mt_no<=9)
                                                            $mth=$mt_no+3;
                                                        else
                                                            $mth=$mt_no-9;
                                                    ?>
                                                    <td class="text-center" >
                                                        <?php
                                                            $filedMisMthCount=0;
                                                            if(isset($filedMisMthCountArr[$mth]))
                                                            {
                                                                $filedMisMthCount=array_sum($filedMisMthCountArr[$mth]);
                                                            }
                                                        ?>
                                                        <?php if($filedMisMthCount!=0): ?>
                                                            <span class="misCount pull-right"><?= $filedMisMthCount; ?></span>
                                                        <?php else: ?>
                                                            <span class="misCount"><?= "-"; ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endfor; ?>
                                                <td nowrap class="text-right" width="7%">
                                                    <?php if($filedSumMisCount!=0): ?>
                                                        <span class="misTotalCount pull-right"><?= $filedSumMisCount; ?></span>
                                                    <?php else: ?>
                                                        <span class="misTotalCount"><?= "-"; ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr class="row-2">
                                                <td class="ddfColTd" nowrap width="28%">
                                                    <span class="font-weight-bold">Returns : Pending </span>
                                                </td>
                                                <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                    <?php
                                                        if($mt_no<=9)
                                                            $mth=$mt_no+3;
                                                        else
                                                            $mth=$mt_no-9;
                                                    ?>
                                                    <td class="text-center" >
                                                        <?php
                                                            $pendingMisMthCount=0;
                                                            if(isset($pendingMisMthCountArr[$mth]))
                                                            {
                                                                $pendingMisMthCount=array_sum($pendingMisMthCountArr[$mth]);
                                                            }
                                                        ?>
                                                        <?php if($pendingMisMthCount!=0): ?>
                                                            <span class="misCount pull-right"><?= $pendingMisMthCount; ?></span>
                                                        <?php else: ?>
                                                            <span class="misCount"><?= "-"; ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endfor; ?>
                                                <td nowrap class="text-right" width="7%">
                                                    <?php if($pendingSumMisCount!=0): ?>
                                                        <span class="misTotalCount pull-right"><?= $pendingSumMisCount; ?></span>
                                                    <?php else: ?>
                                                        <span class="misTotalCount"><?= "-"; ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- ------------------------------------------------------Summary Div Ends---------------------------------------------------------- -->
                            
                        </div>
                        
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
<?= $this->endSection(); ?>