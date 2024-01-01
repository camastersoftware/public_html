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
    
    .none{
        background-color: #96c7f242 !important;
    }
    .red{
        background-color: pink !important;
    } 
    .yellow{
        background-color: #f0f58b7d !important;
    } 
    .violet{
        background-color: #f38bf5 !important;
    } 
    .green{
        background-color: #37fa1f !important;
    }
    
    .hasReturn{
        /*border: 2px solid #f99d27 !important;*/
        /*border-style: dashed !important;*/
        background: #e4f1fc;
    }
    
</style>
<?php $s_time = strtotime("2019-12-01"); ?>
<?php $due_date_for=(!empty($ddfDataArr['act_option_name'])) ? $ddfDataArr['act_option_name']: "N/A"; ?>
<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold"><?= $due_date_for; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#Modalfilter-intax">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Filter">
                                    <i class="fa fa-filter"></i>&nbsp;Filter
                                </button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url($secPrefixUrl.'-ddf/'.$due_date_type); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
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
                            <a class="nav-link <?php if($m==$currMth): ?>active<?php endif; ?> <?php if(in_array($m, $retMthArr)): ?>hasReturn<?php endif; ?>" id="<?php echo $mth_nm; ?>-tab" data-mth="<?php echo $mth_nm; ?>_tab" data-toggle="tab" href="#<?php echo $mth_nm; ?>_tab" role="tab" aria-controls="profile">
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
                                                                
                                                                <?php $due_date_periodicity=$e_due_date['periodicity_name']; ?>
                                                                
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
                                                                                        Periodicity : <?= $due_date_periodicity; ?>
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
                                                                                            <th class="column-1" width="1%">Sr</th>
                                                                                            <th class="column-2" width="5%">Group</th>
                                                                                            <th class="column-3" width="15%">Name of the</th>
                                                                                            <th class="column-3" width="10%">Status</th>
                                                                                            <th class="column-4" width="7%"><?= $pmtDocName; ?></th>
                                                                                            <th class="column-5" width="14%">Alloted</th>
                                                                                            <th class="column-6" width="7%">Type of</th>
                                                                                            <th class="column-7" width="10%">Period</th>
                                                                                            <th class="column-8" width="7%">Amount</th>
                                                                                            <th class="column-9" width="7%">Paid</th>
                                                                                            <th class="column-10" width="7%">Mode</th>
                                                                                        </tr>
                                                                                        <tr class="row-1">
                                                                                            <th class="column-1" width="1%">No</th>
                                                                                            <th class="column-2" width="5%">No</th>
                                                                                            <th class="column-3" width="15%">Client</th>
                                                                                            <th class="column-4" width="10%"></th>
                                                                                            <th class="column-5" width="7%">No</th>
                                                                                            <th class="column-6" width="7%">To</th>
                                                                                            <th class="column-7" width="7%">Payment</th>
                                                                                            <th class="column-8" width="10%"></th>
                                                                                            <th class="column-9" width="7%">Paid</th>
                                                                                            <th class="column-10" width="7%">On</th>
                                                                                            <th class="column-11" width="7%"></th>
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
                                                                                                    <?php $workPriorityColor=$e_inc_row['workPriorityColor']; ?>
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
                                                                                                        
                                                                                                        if(!empty($workPriorityColor) && $eFillingDate=='-')
                                                                                                        {
                                                                                                            if($workPriorityColor!="none")
                                                                                                                $rowColor=$workPriorityColor;
                                                                                                        }
                                                                                                    ?>
                                                                                                
                                                                                                    <tr class="row-1 tbl_row_clr" >
                                                                                                        <td class="column-1 <?= $rowColor; ?>" width="1%" nowrap>
                                                                                                            <?php echo $sr; ?>
                                                                                                        </td>
                                                                                                        <td class="column-2 <?= $rowColor; ?>" width="5%" nowrap>
                                                                                                            <?php echo $e_inc_row['client_group_number']; ?>
                                                                                                        </td>
                                                                                                        <td class="column-3 <?= $rowColor; ?>" width="15%" nowrap>
                                                                                                            <?php
                                                                                                                if(in_array($e_inc_row['orgType'], INDIVIDUAL_ARRAY))
                                                                                                                    $clientNameVar=$e_inc_row['clientName'];
                                                                                                                else
                                                                                                                    $clientNameVar=$e_inc_row['clientBussOrganisation']; 
                                                                                                            ?>
                                                                                                            <div class="tooltip-div">
                                                                                                                <a href="javascript:void(0);" class="has-tooltip" data-original-title="<?= $clientNameVar; ?>">
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
                                                                                                                <span class='tooltipElem tooltipClr'>
                                                                                                        			<span class="small text-bold"><?= $clientNameVar; ?></span>
                                                                                                        			<br>
                                                                                                        			<a href="<?= base_url('client/edit_client/'.$e_inc_row['clientId']); ?>">
                                                                                                                        <button type="button" class="waves-effect waves-light btn btn-sm btn-success">
                                                                                                                            <i class="fa fa-user-circle fa-2x"></i>
                                                                                                                            <span class="fs_14">Info</span>
                                                                                                                        </button>
                                                                                                                    </a>
                                                                                                                    <?php
                                                                                                                        if(!empty($workFormUrl))
                                                                                                                            $workFormUrlVar=base_url($workFormUrl.$e_inc_row['workId']);
                                                                                                                        else
                                                                                                                            $workFormUrlVar="javascript:void(0);";
                                                                                                                    ?>
                                                                                                        			<a href="<?= $workFormUrlVar; ?>">
                                                                                                                        <button type="button" class="waves-effect waves-light btn btn-sm btn-success">
                                                                                                                            <i class="fa fa-file fa-2x"></i>
                                                                                                                            <span class="fs_14">Work</span>
                                                                                                                        </button>
                                                                                                                    </a>
                                                                                                        		</span>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td class="column-4 text-center <?= $rowColor; ?>" width="10%" nowrap>
                                                                                                            <?php echo $e_inc_row['client_org_short_name']; ?>
                                                                                                        </td>
                                                                                                        <td class="column-5 text-center <?= $rowColor; ?>" width="7%">
                                                                                                            <?php 
                                                                                                                if(!empty($e_inc_row['client_document_number']))
                                                                                                                    echo $e_inc_row['client_document_number'];
                                                                                                                else
                                                                                                                    echo "N/A"; 
                                                                                                            ?>
                                                                                                        </td>
                                                                                                        <td class="column-6 text-center <?= $rowColor; ?>" width="7%" nowrap>
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
                                                                                                        <td class="column-7 text-center <?= $rowColor; ?>" width="7%">
                                                                                                            -
                                                                                                        </td>
                                                                                                        <td class="column-8 text-center <?php if($eFillingDate!='-'): ?>hasCompleted<?php endif; ?>" width="5%">
                                                                                                            -
                                                                                                        </td>
                                                                                                        <td class="column-9 text-center <?php if($eFillingDate!='-'): ?>hasCompleted<?php endif; ?>" width="10%">
                                                                                                            -
                                                                                                        </td>
                                                                                                        <td class="column-10 text-center <?php if($verificationDate!='-'): ?>hasCompleted<?php endif; ?>" width="10%">
                                                                                                            -
                                                                                                        </td>
                                                                                                        <td class="column-11 text-center <?php if($set_prepared_by!=''): ?>hasCompleted<?php endif; ?>" width="7%">
                                                                                                            -
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <?php $sr++; ?>
                                                                                                        
                                                                                                <?php endforeach; ?>
                                                                                            <?php else: ?>
                                                                                                <tr class="row-1 tbl_row_clr">
                                                                                                    <td colspan="11" class="column-1">
                                                                                                        No records found
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <?php endif; ?>
                                                                                        <?php else: ?>
                                                                                            <tr class="row-1 tbl_row_clr">
                                                                                                <td colspan="11" class="column-1">
                                                                                                    No records found
                                                                                                </td>
                                                                                            </tr>
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
                                                        <th class="column-1" width="1%">Sr</th>
                                                        <th class="column-2" width="5%">Group</th>
                                                        <th class="column-3" width="15%">Name of the</th>
                                                        <th class="column-3" width="10%">Status</th>
                                                        <th class="column-4" width="7%"><?= $pmtDocName; ?></th>
                                                        <th class="column-5" width="14%">Alloted</th>
                                                        <th class="column-6" width="7%">Type of</th>
                                                        <th class="column-7" width="10%">Period</th>
                                                        <th class="column-8" width="7%">Amount</th>
                                                        <th class="column-9" width="7%">Paid</th>
                                                        <th class="column-10" width="7%">Mode</th>
                                                    </tr>
                                                    <tr class="row-1">
                                                        <th class="column-1" width="1%">No</th>
                                                        <th class="column-2" width="5%">No</th>
                                                        <th class="column-3" width="15%">Client</th>
                                                        <th class="column-4" width="10%"></th>
                                                        <th class="column-5" width="7%">No</th>
                                                        <th class="column-6" width="7%">To</th>
                                                        <th class="column-7" width="7%">Payment</th>
                                                        <th class="column-8" width="10%"></th>
                                                        <th class="column-9" width="7%">Paid</th>
                                                        <th class="column-10" width="7%">On</th>
                                                        <th class="column-11" width="7%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row-hover">
                                                    <tr class="row-1 tbl_row_clr">
                                                        <td colspan="11" class="column-1">
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
            <form action="<?= base_url('search-'.$secPrefixUrl.'-filter'); ?>" method="POST" >
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
                                                <option value="<?= $e_cl_grp['client_group_id']; ?>" <?= $ftr_clientgrp==$e_cl_grp['client_group_id'] ? "selected":""; ?> ><?= $e_cl_grp['client_group']; ?></option>
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
                                <label class="col-lg-4 col-md-4">Alloted To : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control select2" name="ftr_junior" id="ftr_junior" style="width:100%;">
                                        <option value="">Select Junior</option>
                                        <?php if(!empty($getUserList)): ?>
                                            <?php foreach($getUserList AS $e_usr_val): ?>
                                                <option value="<?= $e_usr_val['userId']; ?>" <?= $ftr_junior==$e_usr_val['userId'] ? "selected":""; ?>><?= $e_usr_val['userFullName']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('reset-'.$secPrefixUrl.'-filter?ftr_type=3&ddfId='.$ddfId); ?>">
                        <button type="button" class="btn btn-warning text-left" >Reset</button>
                    </a>
                    <input type="hidden" name="ddfId" id="ddfId" value="<?= $ddfId; ?>" >
                    <input type="hidden" name="ftr_type" id="ftr_type" value="3" >
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
        
        $("body").on("click", '.nav-link', function() {
            var selected_mth_tab = $(this).data("mth");
            console.log('selected_mth_tab', selected_mth_tab);
            $('input[name="selected_mth_tab"]').val(selected_mth_tab);
        });
    });
    
    var sel_mth_tab = $('input[name="selected_mth_tab"]').val();
    
    console.log('sel_mth_tab', sel_mth_tab);
    
    $('.nav-tabs a[href="#'+sel_mth_tab+'"]').tab('show');
    
</script>


<?= $this->endSection(); ?>