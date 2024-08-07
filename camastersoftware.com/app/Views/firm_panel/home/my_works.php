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
        font-size: 16px;
    }
    
    .tablepress tbody {
        font-size: 16px;
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
    
    .second_header_div{
        background:#96c7f242;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }
    
    .second_header{
        font-size: 15px;
        font-weight: bold;
        padding: 2px;
        color: #000;
    }
    
    .tbl_row_clr{
        background:#96c7f242 !important;
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
    
    .hasReturn{
        /*border: 2px solid #f99d27 !important;*/
        /*border-style: dashed !important;*/
        background: #e4f1fc;
    }

    .theme-primary .btnPrimClr {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
    
</style>
<?php $s_time = strtotime("2019-12-01"); ?>
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
                            <a href="<?= base_url('reminder'); ?>">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Reminder">
                                    Reminder
                                </button>
                                <?php if ($isReminderPresent) : ?>
                                    <i class="notify-point-icon-btn"></i>
                                <?php endif; ?>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?= base_url('my_works_filed'); ?>">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Returns Filed">
                                    Filed
                                </button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('my-attendance/'.$sessUserLoginID); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-danger add_client_top">My Attendance</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('chat/0'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-success add_client_top">Chat</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    
                    <div class="row mb-10">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-2" for="due_act_sel">Act :</label>
                                <div class="col-md-6">
                                    <select class="custom-select form-control" id="due_act_sel" name="due_act_sel">
                                        <option value="">Select Act</option>
                                        <?php if(!empty($actArr)): ?>
                                            <?php foreach($actArr AS $e_act): ?>
                                                <option value="<?php echo $e_act['act_id']; ?>" <?= set_select('due_act', $e_act['act_id'], $e_act['act_id']==$myWorkSelActVal ? TRUE:FALSE) ?>><?php echo $e_act['act_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#Modalfilter-intax">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Filter">
                                    <i class="fa fa-filter"></i>&nbsp;Filter
                                </button>
                            </a>
                        </div>
                    </div>
                        
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                        <?php
                            if($m_no<=9)
                                $m=$m_no+3;
                            else
                                $m=$m_no-9;
                        ?>
                        <?php $mth_nm=strtolower(date('M', strtotime("2021-".$m."-1"))); ?>
                        <li class="nav-item"> 
                            <a class="nav-link <?php if($m==$currMth): ?>active<?php endif; ?> <?php if(in_array($m, $retMthArr)): ?>hasReturn<?php endif; ?>" id="<?php echo $mth_nm; ?>-tab" data-toggle="tab" href="#<?php echo $mth_nm; ?>_tab" role="tab" aria-controls="profile">
                                <span class="hidden-sm-up">
                                    <i class="ion-person"></i>
                                </span> 
                                <span class="hidden-xs-down year-color font-weight-bold"><?php echo date('F', strtotime("2021-".$m."-1")); ?></span>
                            </a>
                        </li>	
                        <?php endfor; ?>
                    </ul>
                    <div class="tab-content tabcontent-border p-5" id="myTabContent">
                        <?php $currFinYr=substr($sessDueDateYear,0, 4); ?>
                        <?php for($w=1; $w<13; $w++): ?>    
                            <?php 
                              if($w<=9)
                              {
                                $a=$w+3;
                                $yearVar=$currFinYr;
                              }
                              else
                              {
                                $a=$w-9;
                                $yearVar=$currFinYr+1;
                              }
                              
                            ?>
                            <?php $l_mth=strtolower(date('F', strtotime("+".$a." month", $s_time))); ?>
                            <?php $u_mth=date('F', strtotime("+".$a." month", $s_time)); ?>
                            <?php $mth_nm=strtolower(date('M', strtotime("2021-".$a."-1"))); ?>
                            <!-- Tab panes -->
                            <div class="tab-pane fade table-responsive <?php if($a==$currMth): ?>show active<?php endif; ?>" id="<?php echo $mth_nm; ?>_tab" role="tabpanel" aria-labelledby="<?php echo $mth_nm; ?>-tab">
                                <?php $hasData=false; ?>
                                
                                <?php if(isset($mthDataArr[$a])): ?>
                                
                                    <?php $mthDataArray=$mthDataArr[$a]; ?>
                                    
                                    <?php if(!empty($mthDataArray)): ?>
                                        
                                        <?php if($mthDataArray['act_due_month']==$a): ?>
                                        
                                            <?php if(isset($mthDDFArr[$a])): ?>
                                                
                                                <?php $mthDDFArray=$mthDDFArr[$a]; ?>
                                            
                                                <?php if(!empty($mthDDFArray)): ?>
                                                
                                                    <?php foreach($mthDDFArray AS $k_ddf=>$e_ddf): ?>
                                                    
                                                        <?php $due_date_for=$e_ddf['act_option_name1']; ?>
                                                
                                                        <?php if(isset($mthDDFDueDateArr[$a][$k_ddf])): ?>
                                                        
                                                            <?php $mthDDFDueDateArray=$mthDDFDueDateArr[$a][$k_ddf]; ?>
                                                            
                                                            <?php if(!empty($mthDDFDueDateArray)): ?>
                                                                <?php foreach($mthDDFDueDateArray AS $k_due_date=>$e_due_date): ?>
                                                                
                                                                <?php $due_date=$e_due_date['extended_date']; ?>
                                                                
                                                                <?php $dueDate=date('d-m-Y', strtotime($due_date)); ?>
                                                                
                                                                <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="state due-month">
                                                                                <label>Due Date For : <?php echo $due_date_for; ?></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="state second_header_div">
                                                                                <div class="row">
                                                                                    <div class="col-md-4 text-center second_header">
                                                                                        Due Date : <?php echo $dueDate; ?>
                                                                                    </div>
                                                                                    <div class="col-md-4 text-center second_header">
                                                                                        Periodicity : Yearly
                                                                                    </div>
                                                                                    <div class="col-md-4 text-center second_header">
                                                                                        Period : 
                                                                                        <?php
                                                                                            if($e_due_date['periodicity']=="1")
                                                                                            {
                                                                                                echo date("d-M-Y", strtotime($e_due_date["daily_date"]));
                                                                                            }
                                                                                            elseif($e_due_date['periodicity']=="2")
                                                                                            {
                                                                                                echo date("M", strtotime("2021-".$e_due_date["period_month"]."-01"))."-".$e_due_date["period_year"];
                                                                                            }
                                                                                            elseif($e_due_date['periodicity']>="3")
                                                                                            {
                                                                                                echo date("M", strtotime("2021-".$e_due_date["f_period_month"]."-01"))."-".$e_due_date["f_period_year"]." - ".date("M", strtotime("2021-".$e_due_date["t_period_month"]."-01"))."-".$e_due_date["t_period_year"];
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo "N/A";
                                                                                            }
                                                                                        ?>
                                                                                        <?php
                                                                                            $asmtYear="N/A";
                                                                                            if(!empty($e_due_date['finYear']))
                                                                                            {
                                                                                                $asmtYearVal=$e_due_date['finYear'];
                                                                                                
                                                                                                $asmtYearArr = explode('-', $asmtYearVal);
                                                                                                
                                                                                                $fY=(int)$asmtYearArr[0]+1;
                                                                                                $lY=(int)$asmtYearArr[1]+1;
                                                                                                
                                                                                                $asmtYear=$fY."-".$lY;
                                                                                            }
                                                                                        ?>
                                                                                        (AY : <?php echo $asmtYear; ?>)
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                                                    <thead>
                                                                                        <tr class="row-1">
                                                                                            <th class="column-1">Sr</th>
                                                                                            <th class="column-2">Group</th>
                                                                                            <th class="column-3">Name of the</th>
                                                                                            <th class="column-3">Tax</th>
                                                                                            <th class="column-4">Doc</th>
                                                                                            <th class="column-5" colspan="2">Alloted to</th>
                                                                                            <th class="column-6" colspan="2">Completed</th>
                                                                                            <th class="column-7">E-Verify</th>
                                                                                            <th class="column-8">Set</th>
                                                                                            <th class="column-9">Billing</th>
                                                                                            <th class="column-11">Receipt</th>
                                                                                            <th class="column-11">Action</th>
                                                                                        </tr>
                                                                                        <tr class="row-1">
                                                                                            <th class="column-1">No</th>
                                                                                            <th class="column-2">No</th>
                                                                                            <th class="column-3">Client</th>
                                                                                            <th class="column-3">Payer</th>
                                                                                            <th class="column-4">Recd</th>
                                                                                            <th class="column-5">Junior</th>
                                                                                            <th class="column-6">Senior</th>
                                                                                            <th class="column-7">%</th>
                                                                                            <th class="column-8">On</th>
                                                                                            <th class="column-9">Date</th>
                                                                                            <th class="column-10">By</th>
                                                                                            <th class="column-11">Details</th>
                                                                                            <th class="column-12">Details</th>
                                                                                            <th class="column-11"></th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody class="row-hover">
                                                                                        <?php $sr=1; ?>
                                                                                
                                                                                        <?php if(isset($mthDDFDueDateForClientArr[$a][$k_ddf][$k_due_date])): ?>
                                                                                        
                                                                                            <?php $mthDDFDueDateForClientArray=$mthDDFDueDateForClientArr[$a][$k_ddf][$k_due_date]; ?>
                                                                                            
                                                                                            <?php if(!empty($mthDDFDueDateForClientArray)): ?>
                                                                                                <?php foreach($mthDDFDueDateForClientArray AS $e_inc_row): ?>
                                                                                                
                                                                                                    <?php $hasData=true; ?>
                                                                                                    
                                                                                                    <?php $workDone=$e_inc_row['workDone']; ?>
                                                                                                    <?php $isUrgentWork=$e_inc_row['isUrgentWork']; ?>
                                                                                                    
                                                                                                    <?php 
                                                                                                        $eFillingDate="-";
                                                                                                        if(!empty($e_inc_row['eFillingDate']) && $e_inc_row['eFillingDate']!="0000-00-00" && $e_inc_row['eFillingDate']!="1970-01-01")
                                                                                                            $eFillingDate=date('d-m-Y', strtotime($e_inc_row['eFillingDate'])); 
                                                                                                    ?>
                                                                                                    
                                                                                                    <?php 
                                                                                                        $verificationDate="-";
                                                                                                        if(!empty($e_inc_row['verificationDate']) && $e_inc_row['verificationDate']!="0000-00-00" && $e_inc_row['verificationDate']!="1970-01-01")
                                                                                                            $verificationDate=date('d-m-Y', strtotime($e_inc_row['verificationDate'])); 
                                                                                                    ?>
                                                                                                    
                                                                                                    <?php 
                                                                                                        $set_prepared_by="";
                                                                                                        if(!empty($e_inc_row['setPreparedShortName']))
                                                                                                            $set_prepared_by=$e_inc_row['setPreparedShortName']; 
                                                                                                    ?>
                                                                                                    
                                                                                                     <?php 
                                                                                                        $isBillingDone="-";
                                                                                                        if($e_inc_row['isBillingDone']==1)
                                                                                                            $isBillingDone="Yes";
                                                                                                        elseif($e_inc_row['isBillingDone']==2)
                                                                                                            $isBillingDone="No"; 
                                                                                                        else
                                                                                                            $isBillingDone="-"; 
                                                                                                    ?>
                                                                                                    
                                                                                                    <?php 
                                                                                                        $isReceiptDone="-";
                                                                                                        if($e_inc_row['isReceiptDone']==1)
                                                                                                            $isReceiptDone="Yes";
                                                                                                        elseif($e_inc_row['isReceiptDone']==2)
                                                                                                            $isReceiptDone="No"; 
                                                                                                        else
                                                                                                            $isReceiptDone="-"; 
                                                                                                    ?>
                                                                                                    
                                                                                                    <?php 
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
                                                                                                    ?>
                                                                                                
                                                                                                    <tr class="row-1 tbl_row_clr">
                                                                                                        <td class="column-1 <?= $rowColor; ?>">
                                                                                                            <?php echo $sr; ?>
                                                                                                        </td>
                                                                                                        <td class="column-2 <?= $rowColor; ?>">
                                                                                                            <?php echo $e_inc_row['client_group_number']; ?>
                                                                                                        </td>
                                                                                                        <td class="column-3 <?= $rowColor; ?>" nowrap>
                                                                                                            <?php 
                                                                                                                if($e_inc_row['orgType']==8 || $e_inc_row['orgType']==9)
                                                                                                                    $clientNameVar=$e_inc_row['clientName'];
                                                                                                                else
                                                                                                                    $clientNameVar=$e_inc_row['clientBussOrganisation']; 
                                                                                                            ?>
                                                                                                            <a href="<?php echo base_url('income_tax/work_form/'.$e_inc_row['workId']); ?>" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
                                                                                                                <?php //echo $e_inc_row['clientTitle'].". ".$e_inc_row['clientName']; ?>
                                                                                                                <?php 
                                                                                                                    if(strlen($clientNameVar)>24)
                                                                                                                    {
                                                                                                                        echo substr($clientNameVar, 0, 24)."..";
                                                                                                                    }
                                                                                                                    else
                                                                                                                    {
                                                                                                                        echo $clientNameVar;
                                                                                                                    }
                                                                                                                ?>
                                                                                                            </a>
                                                                                                        </td>
                                                                                                        <td class="column-4 text-center <?= $rowColor; ?>" nowrap>
                                                                                                            <?php echo $e_inc_row['client_org_short_name']; ?>
                                                                                                        </td>
                                                                                                        <td class="column-5 text-center <?= $rowColor; ?>">
                                                                                                            <?php 
                                                                                                                if($e_inc_row['isDocRecvd']==1)
                                                                                                                    echo "Yes";
                                                                                                                elseif($e_inc_row['isDocRecvd']==2)
                                                                                                                    echo "No"; 
                                                                                                                else
                                                                                                                    echo "-"; 
                                                                                                            ?>
                                                                                                        </td>
                                                                                                        <td class="column-6 text-center <?= $rowColor; ?>">
                                                                                                            <?php if($e_inc_row['juniors']!=""): ?>
                                                                                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?php echo $e_inc_row['juniors']; ?>">
                                                                                                                    <?php 
                                                                                                                        if(strlen($e_inc_row['juniors'])>10)
                                                                                                                            echo substr_replace($e_inc_row['juniors'], "...", 10); 
                                                                                                                        else
                                                                                                                            echo $e_inc_row['juniors'];
                                                                                                                    ?>
                                                                                                                </a>
                                                                                                            <?php else: ?>
                                                                                                                -
                                                                                                            <?php endif; ?>
                                                                                                        </td>
                                                                                                        <td class="column-7 text-center <?= $rowColor; ?>">
                                                                                                            <?php echo $e_inc_row['seniorName']; ?>
                                                                                                        </td>
                                                                                                        <td class="column-8 text-center <?php if($eFillingDate!='-'): ?>hasCompleted<?php endif; ?>">
                                                                                                            <?php echo $e_inc_row['workDone']; ?>
                                                                                                        </td>
                                                                                                        <td class="column-9 text-center <?php if($eFillingDate!='-'): ?>hasCompleted<?php endif; ?>">
                                                                                                            <?php echo $eFillingDate; ?>
                                                                                                        </td>
                                                                                                        <td class="column-10 text-center <?php if($verificationDate!='-'): ?>hasCompleted<?php endif; ?>">
                                                                                                            <?php echo $verificationDate; ?>
                                                                                                        </td>
                                                                                                        <td class="column-11 text-center <?php if($set_prepared_by!=''): ?>hasCompleted<?php endif; ?>">
                                                                                                            <?php echo $set_prepared_by; ?>
                                                                                                        </td>
                                                                                                        <td class="column-12 text-center <?php if($isBillingDone=='Yes'): ?>hasCompleted<?php endif; ?>">
                                                                                                            <?php echo $isBillingDone; ?>
                                                                                                        </td>
                                                                                                        <td class="column-13 text-center <?php if($isReceiptDone=='Yes'): ?>hasCompleted<?php endif; ?>">
                                                                                                            <?php echo $isReceiptDone; ?>
                                                                                                        </td>
                                                                                                        <td class="column-13 text-center">
                                                                                                            <div class="btn-group">
                                                                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                                                                    <a class="dropdown-item" href="javascript:void(0);<?php //echo base_url('client/edit_client/'.$e_row['clientId']); ?>" >
                                                                                                                        <i class="fa fa-calendar"></i>&nbsp;Time Sheet
                                                                                                                    </a>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <?php $sr++; ?>
                                                                                                        
                                                                                                <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        <?php endif; ?>
                                                                                
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?> <!-- Check Month -->
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <?php if($hasData==false): ?>
                                    <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="state due-month">
                                                    <label>Due Date For : N/A</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="state second_header_div">
                                                    <div class="row">
                                                        <div class="col-md-4 text-center second_header">
                                                            Due Date : N/A
                                                        </div>
                                                        <div class="col-md-4 text-center second_header">
                                                            Periodicity : N/A
                                                        </div>
                                                        <div class="col-md-4 text-center second_header">
                                                            Period: N/A (AY : N/A)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                <thead>
                                                    <tr class="row-1">
                                                        <th class="column-1">Sr</th>
                                                        <th class="column-2">Group</th>
                                                        <th class="column-3">Name of the</th>
                                                        <th class="column-3">Tax</th>
                                                        <th class="column-4">Doc</th>
                                                        <th class="column-5" colspan="2">Alloted to</th>
                                                        <th class="column-6" colspan="2">Completed</th>
                                                        <th class="column-7">E-Verify</th>
                                                        <th class="column-8">Set</th>
                                                        <th class="column-9">Billing</th>
                                                        <th class="column-11">Receipt</th>
                                                    </tr>
                                                    <tr class="row-1">
                                                        <th class="column-1">No</th>
                                                        <th class="column-2">No</th>
                                                        <th class="column-3">Client</th>
                                                        <th class="column-3">Payer</th>
                                                        <th class="column-4">Recd</th>
                                                        <th class="column-5">Junior</th>
                                                        <th class="column-6">Senior</th>
                                                        <th class="column-7">%</th>
                                                        <th class="column-8">On</th>
                                                        <th class="column-9">Date</th>
                                                        <th class="column-10">By</th>
                                                        <th class="column-11">Details</th>
                                                        <th class="column-12">Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row-hover">
                                                    <tr class="row-1 tbl_row_clr">
                                                        <td colspan="13" class="column-1">
                                                            No records found
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
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

<!-- Modal -->
<div id="Modalfilter-intax" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Client Group : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control" name="ftr_clientgrp" id="ftr_clientgrp">
                                        <option value="">Select Client Group</option>
                                        <?php if(!empty($groupList)): ?>
                                            <?php foreach($groupList AS $e_cl_grp): ?>
                                                <option value="<?php echo $e_cl_grp['client_group_id']; ?>" <?php echo $ftr_clientgrp==$e_cl_grp['client_group_id'] ? "selected":""; ?> ><?php echo $e_cl_grp['client_group']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Client Name : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control select2" name="ftr_client" id="ftr_client" style="width:100%;">
                                        <option value="">Select Client</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Cost Center : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control select2" name="ftr_costcenter" id="ftr_costcenter" style="width:100%;">
                                        <option value="">Select Cost Center</option>
                                        <?php if(!empty($getUserList)): ?>
                                            <?php foreach($getUserList AS $e_usr): ?>
                                                <?php if($e_usr['isCostCenter']==1): ?>
                                                    <option value="<?php echo $e_usr['userId']; ?>" <?php echo $ftr_costcenter==$e_usr['userId'] ? "selected":""; ?>><?php echo $e_usr['userFullName']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Staff Name : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control select2" name="ftr_staff" id="ftr_staff" style="width:100%;">
                                        <option value="">Select Staff</option>
                                        <?php if(!empty($getUserList)): ?>
                                            <?php foreach($getUserList AS $e_usr_val): ?>
                                                <option value="<?php echo $e_usr_val['userId']; ?>" <?php echo $ftr_staff==$e_usr_val['userId'] ? "selected":""; ?>><?php echo $e_usr_val['userFullName']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Due Date For : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control select2" name="ftr_ddf" id="ftr_ddf" style="width:100%;">
                                        <option value="">Select Due Date For</option>
                                        <?php if(!empty($dueDateForList)): ?>
                                            <?php foreach($dueDateForList AS $e_ddf): ?>
                                                <option value="<?php echo $e_ddf['act_option_map_id']; ?>" <?php echo $ftr_ddf==$e_ddf['act_option_map_id'] ? "selected":""; ?>><?php echo $e_ddf['act_option_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Periodicity : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control" name="ftr_period" id="ftr_period">
                                        <option value="">Select Periodicity</option>
                                        <?php if(!empty($periodArr)): ?>
                                            <?php foreach($periodArr AS $e_prd): ?>
                                                <option value="<?php echo $e_prd['periodicity_id']; ?>" <?php echo $ftr_period==$e_prd['periodicity_id'] ? "selected":""; ?>><?php echo $e_prd['periodicity_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Due Date Month : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control" name="ftr_ddm" id="ftr_ddm">
                                        <option value="">Select Month</option>
                                        <?php for($m_t=1; $m_t<13; $m_t++): ?>
                                            <?php 
                                                if($m_t<=9)
                                                    $a_t=$m_t+3;
                                                else
                                                    $a_t=$m_t-9;
                                                    
                                                $u_t=date('F', strtotime("+".$a_t." month", $s_time));
                                            ?>
                                            <option value="<?php echo $a_t; ?>" <?php echo $ftr_ddm==$a_t ? "selected":""; ?>><?php echo $u_t; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <a href="<?php echo base_url('my_works'); ?>">
                        <button type="button" class="btn btn-warning text-left" >Reset</button>
                    </a>
                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
    $client_arr=array();
    if(!empty($getClientList))
    {
        foreach($getClientList AS $k_c=>$e_c)
        {
            $clName = str_replace("'", "", $e_c['clientName']);
            $client_arr[$k_c]['clientId']=$e_c['clientId'];
            $client_arr[$k_c]['clientName']=$clName;
            $client_arr[$k_c]['clientGroup']=$e_c['clientGroup'];
        }
    }
?>

<script>
    
    $(document).ready(function(){
        
        $('#ftr_clientgrp').on('change', function(){
            
            var ftr_clientgrp = $(this).val();
            var client_arr = '<?php echo json_encode($client_arr); ?>';
            var selected=null;
            var selClient="<?php echo $ftr_client; ?>";
            
            $('#ftr_client').html("");
            $('#ftr_client').html("<option value=''>Select Client</option>");
            
            var clientArr=jQuery.parseJSON(client_arr);
            
            $.each(clientArr, function( index, value ) {
            
                var clientId=value['clientId'];
                var clientName=value['clientName'];
                var clientGroup=value['clientGroup'];
                
                if(clientGroup==ftr_clientgrp)
                {
                    if(clientId==selClient)
                        selected="selected";
                    else
                        selected="";
                    
                    $('#ftr_client').append("<option value='"+clientId+"' "+selected+" >"+clientName+"</option>");
                }
            
            }); 
            
        })
        
        $('#ftr_clientgrp').trigger('change');
        
        $('#due_act_sel').on('change', function(){
            
            var base_url="<?php echo base_url(); ?>";
            
            var due_act_sel = $(this).val();
            
            window.location.href=base_url+"/my_works?due_act_sel="+due_act_sel;
        });
        
    });
    
</script>


<?= $this->endSection(); ?>