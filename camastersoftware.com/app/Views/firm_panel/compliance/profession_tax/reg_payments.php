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

    .theme-primary .btnPrimClr{
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
                            <a href="<?php echo base_url('pt_reg_menus'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
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
                            <a class="nav-link <?php if($m==$currMth): ?>active<?php endif; ?>" id="<?php echo $mth_nm; ?>-tab" data-mth="<?php echo $mth_nm; ?>_tab" data-toggle="tab" href="#<?php echo $mth_nm; ?>_tab" role="tab" aria-controls="profile">
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
                                                                                            <th class="column-4" width="7%">Registration</th>
                                                                                            <th class="column-5" colspan="2" width="14%">Alloted to</th>
                                                                                            <th class="column-6">Period</th>
                                                                                            <th class="column-7">Amount</th>
                                                                                            <th class="column-8">Paid</th>
                                                                                            <th class="column-9">Mode</th>
                                                                                            <th class="column-11">Action</th>
                                                                                        </tr>
                                                                                        <tr class="row-1">
                                                                                            <th class="column-1" width="1%">No</th>
                                                                                            <th class="column-2" width="5%">No</th>
                                                                                            <th class="column-3" width="15%">Client</th>
                                                                                            <th class="column-3" width="10%"></th>
                                                                                            <th class="column-4" width="7%">Number</th>
                                                                                            <th class="column-5" width="7%">Junior</th>
                                                                                            <th class="column-6" width="7%">Senior</th>
                                                                                            <th class="column-7"></th>
                                                                                            <th class="column-9">Paid</th>
                                                                                            <th class="column-10">On</th>
                                                                                            <th class="column-11"></th>
                                                                                            <th class="column-12"></th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody class="row-hover">
                                                                                        <?php $sr=1; ?>
                                                                                
                                                                                        <?php if(isset($mthDDFDueDateForClientArr[$a][$k_ddf][$k_due_date])): ?>
                                                                                        
                                                                                            <?php $mthDDFDueDateForClientArray=$mthDDFDueDateForClientArr[$a][$k_ddf][$k_due_date]; ?>
                                                                                            
                                                                                            <?php if(!empty($mthDDFDueDateForClientArray)): ?>
                                                                                                <?php foreach($mthDDFDueDateForClientArray AS $e_inc_row): ?>
                                                                                                
                                                                                                    <?php $hasData=true; ?>
                                                                                                    
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
                                                                                                        <td class="column-1" width="1%" nowrap>
                                                                                                            <?= $sr; ?>
                                                                                                        </td>
                                                                                                        <td class="column-2" width="5%" nowrap>
                                                                                                            <?= $e_inc_row['client_group_number']; ?>
                                                                                                        </td>
                                                                                                        <td class="column-3" width="15%" nowrap>
                                                                                                            <?php 
                                                                                                                if(in_array($e_inc_row['orgType'], INDIVIDUAL_ARRAY))
                                                                                                                    $clientNameVar=$e_inc_row['clientName'];
                                                                                                                else
                                                                                                                    $clientNameVar=$e_inc_row['clientBussOrganisation']; 
                                                                                                            ?>
                                                                                                            <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $clientNameVar; ?>">
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
                                                                                                        <td class="column-4 text-center" width="10%" nowrap>
                                                                                                            <?= $e_inc_row['client_org_short_name']; ?>
                                                                                                        </td>
                                                                                                        <td class="column-5 text-center" width="7%">
                                                                                                            <?= (!empty($e_inc_row['client_document_number'])) ? $e_inc_row['client_document_number'] : "-"; ?>
                                                                                                        </td>
                                                                                                        <td class="column-6 text-center" width="7%" nowrap>
                                                                                                            <?php if($e_inc_row['juniors']!=""): ?>
                                                                                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $e_inc_row['juniors']; ?>">
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
                                                                                                        <td class="column-7 text-center" width="7%">
                                                                                                            <?= (!empty($e_inc_row['seniorName'])) ? $e_inc_row['seniorName'] : "-"; ?>
                                                                                                        </td>
                                                                                                        <td class="column-9 text-center" nowrap>
                                                                                                            <?php
                                                                                                                if($e_inc_row['periodicity']=="1")
                                                                                                                {
                                                                                                                    echo date("d-M-Y", strtotime($e_inc_row["daily_date"]));
                                                                                                                }
                                                                                                                elseif($e_inc_row['periodicity']=="2")
                                                                                                                {
                                                                                                                    echo date("M", strtotime("2021-".$e_inc_row["period_month"]."-01"))."-".$e_inc_row["period_year"];
                                                                                                                }
                                                                                                                elseif($e_inc_row['periodicity']>="3")
                                                                                                                {
                                                                                                                    echo date("M", strtotime("2021-".$e_inc_row["f_period_month"]."-01"))."-".$e_inc_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_inc_row["t_period_month"]."-01"))."-".$e_inc_row["t_period_year"];
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                    echo "N/A";
                                                                                                                }
                                                                                                            ?>
                                                                                                        </td>
                                                                                                        <td class="column-10 text-right">
                                                                                                            <?= (!empty($e_inc_row['pt_enrol_amt_paid'])) ? amount_format($e_inc_row['pt_enrol_amt_paid']) : "-"; ?>
                                                                                                        </td>
                                                                                                        <td class="column-11 text-center">
                                                                                                            <?= (check_valid_date($e_inc_row['pt_enrol_paid_on'])) ? date('d-m-Y', strtotime($e_inc_row['pt_enrol_paid_on'])) : "-"; ?>
                                                                                                        </td>
                                                                                                        <td class="column-12 text-center">
                                                                                                            <?= (!empty($e_inc_row['pt_enrol_pmt_mode'])) ? $e_inc_row['pt_enrol_pmt_mode'] : "-"; ?>
                                                                                                        </td>
                                                                                                        <td class="column-13 text-center">
                                                                                                            <div class="btn-group">
                                                                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                                                                    <a class="dropdown-item" href="<?= base_url('manage-pt-reg-payments/'.$e_inc_row['workId']); ?>">View/Edit</a>
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
                                                            Period: N/A
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
                                                        <th class="column-4" width="7%">Registration</th>
                                                        <th class="column-5" colspan="2" width="14%">Alloted to</th>
                                                        <th class="column-6">Period</th>
                                                        <th class="column-7">Amount</th>
                                                        <th class="column-8">Paid</th>
                                                        <th class="column-9">Mode</th>
                                                        <th class="column-11">Action</th>
                                                    </tr>
                                                    <tr class="row-1">
                                                        <th class="column-1" width="1%">No</th>
                                                        <th class="column-2" width="5%">No</th>
                                                        <th class="column-3" width="15%">Client</th>
                                                        <th class="column-3" width="10%"></th>
                                                        <th class="column-4" width="7%">Number</th>
                                                        <th class="column-5" width="7%">Junior</th>
                                                        <th class="column-6" width="7%">Senior</th>
                                                        <th class="column-7"></th>
                                                        <th class="column-9">Paid</th>
                                                        <th class="column-10">On</th>
                                                        <th class="column-11"></th>
                                                        <th class="column-12"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row-hover">
                                                    <tr class="row-1 tbl_row_clr">
                                                        <td colspan="12" class="column-1">
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

<script>
    
    $(document).ready(function(){
        
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