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
        /*text-align: left !important;*/
        /*font-weight: bold !important;*/
        /*font-size: 16px !important;*/
    }
    
    .divLine td{
        background-color: #005495 !important;
    }
    
    .no_bold{
        font-weight: 400 !important;
    }
    
    .tablepress td, .tablepress th {
        padding: 3px !important;
        width: 45px !important;
    }
    
    .hasAbove50Completed{
        background : #e8f219a3 !important;
    }
    
    .hasAbove75Completed{
        background : #f4a047a8 !important;
    }    
    
    .hasCompleted{
        background : #24d724a6 !important;
    }
    
    .urgent_work_clr{
        background : pink !important;
    }
    
</style>
<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold">
                                <?= $pageTitle; ?>
                            </h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url('emp-attendance'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right mt-1" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="row"> 
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1" nowrap rowspan="4">SN</th>
                                            <th class="column-2" nowrap rowspan="4">Name of the Assessee</th>
                                            <th class="column-3" rowspan="4">Status</th>
                                            <?php if(!empty($selActArr)): ?>
                                                <?php foreach($selActArr AS $e_act): ?>
                                                
                                                    <?php if($e_act==1): ?>
                                                        <th class="column-4" colspan="4">Income Tax - Tax Audit</th>
                                                    <?php elseif($e_act==4): ?>
                                                        <th class="column-5" colspan="3">ROC - Companies</th>
                                                    <?php elseif($e_act==6): ?>
                                                        <th class="column-6" colspan="3">ROC - LLP</th>
                                                    <?php endif ?>
                                                    
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tr>
                                        <?php for($d=1; $d<=3; $d++): ?>
                                        <tr class="row-1">
                                            <?php if(!empty($selActArr)): ?>
                                                <?php foreach($selActArr AS $e_act): ?>
                                                    <?php
                                                        $dueDateDataVal = "-";
                                                        $ddfHdArray=array();
                                                        if($e_act==1)
                                                            $ddfHdArray = $incDDFArr;
                                                        elseif($e_act==4)
                                                            $ddfHdArray = $compDDFArr;
                                                        elseif($e_act==6)
                                                            $ddfHdArray = $llpDDFArr;
                                                    ?>
                                                    <?php if(!empty($ddfHdArray)): ?>
                                                        <?php foreach($ddfHdArray AS $e_ddf): ?>
                                                            <?php
                                                                $dueDateDataVal = "-";
                                                                if(isset($actDDFDataArr[$e_act][$e_ddf]))
                                                                {
                                                                    $actDueDateData = $actDDFDataArr[$e_act][$e_ddf];
                                                                    
                                                                    if(!empty($actDueDateData))
                                                                    {
                                                                        if($d==1)
                                                                            $dueDateDataVal = (!empty($actDueDateData['ddfShortName'])) ? $actDueDateData['ddfShortName'] : "-";
                                                                        
                                                                        if($d==2)
                                                                            $dueDateDataVal = (!empty($actDueDateData['formName'])) ? $actDueDateData['formName'] : "-";
                                                                        
                                                                        if($d==3)
                                                                            $dueDateDataVal = (check_valid_date($actDueDateData['extended_date'])) ? date("d-m-Y", strtotime($actDueDateData['extended_date'])) : "-";
                                                                    }
                                                                }
                                                            ?>
                                                            <th class="column-4 text-center" nowrap>
                                                                <?= $dueDateDataVal ?>
                                                            </th>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <th class="column-4 text-center" nowrap>
                                                            <?= $dueDateDataVal ?>
                                                        </th>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endfor; ?>
                                    </thead>
                                    <tbody class="row-hover">
                                        <?php $sn=1; ?>
                                        <?php if(!empty($clientArr)): ?>
                                            <?php foreach($clientArr AS $e_client): ?>
                                                <?php $clientId=$e_client['clientId']; ?>
                                                <?php if(isset($clientDDFArr[$clientId])): ?>
                                                    <?php $clientDDFIDArray = $clientDDFArr[$clientId]; ?>
                                                    <?php 
                                                        if(count($clientDDFIDArray) == 1 && in_array(1, $clientDDFIDArray))
                                                            continue;
                                                    ?>
                                                        <tr class="row-1">
                                                            <td class="column-1 text-center" nowrap>
                                                                <?= $sn; ?>
                                                            </td>
                                                            <td class="column-2" nowrap>
                                                                <?= $e_client['clientName']; ?>
                                                            </td>
                                                            <td class="column-3 text-center">
                                                                <?= $e_client['shortName']; ?>
                                                            </td>
                                                            <?php if(!empty($selActArr)): ?>
                                                                <?php foreach($selActArr AS $e_act): ?>
                                                                    
                                                                    <?php
                                                                        $isClientApplied = "-";
                                                                        $ddfArray=array();
                                                                        if($e_act==1)
                                                                            $ddfArray = $incDDFArr;
                                                                        elseif($e_act==4)
                                                                            $ddfArray = $compDDFArr;
                                                                        elseif($e_act==6)
                                                                            $ddfArray = $llpDDFArr;
                                                                    ?>
                                                                    
                                                                    <?php if(!empty($ddfArray)): ?>
                                                                        <?php foreach($ddfArray AS $e_ddf): ?>
                                                                            <?php
                                                                                $rowColor = "";
                                                                                $eFillingDate = "-";
                                                                                $isClientApplied = "-";
                                                                                if(isset($clientActDataArr[$clientId][$e_act][$e_ddf]))
                                                                                {
                                                                                    $clientDueDateData = $clientActDataArr[$clientId][$e_act][$e_ddf];
                                                                                    
                                                                                    if(!empty($clientDueDateData))
                                                                                    {
                                                                                        $isClientApplied = (check_valid_date($clientDueDateData['extended_date'])) ? "Yes" : "-";
                                                                                        $eFillingDate = (check_valid_date($clientDueDateData['eFillingDate'])) ? "Yes" : "-";
                                                                                        $workDone = $clientDueDateData['workDone'];
                                                                                        $isUrgentWork = $clientDueDateData['isUrgentWork'];
                                                                                        
                                                                                        $rowColor="";
                                                                                        if($workDone>=50)
                                                                                        {
                                                                                            $rowColor = 'hasAbove50Completed';
                                                                                        }
                                                                                        
                                                                                        if($workDone>=75)
                                                                                        {
                                                                                            $rowColor = 'hasAbove75Completed';
                                                                                        }
                                                                                        
                                                                                        if($eFillingDate=='-')
                                                                                        {
                                                                                            if($isUrgentWork==1)
                                                                                            {
                                                                                                $rowColor = 'urgent_work_clr';
                                                                                            }
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $rowColor = 'hasCompleted';
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>
                                                                            <td class="column-4 text-center <?= $rowColor; ?>" nowrap>
                                                                                <?= $isClientApplied ?>
                                                                            </td>
                                                                        <?php endforeach; ?>
                                                                    <?php else: ?>
                                                                        <td class="column-4 text-center" >
                                                                            <?= $isClientApplied ?>
                                                                        </td>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </tr>
                                                        <?php $sn++; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
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