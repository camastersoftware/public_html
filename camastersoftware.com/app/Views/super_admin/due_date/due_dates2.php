<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<?php

$isFilter=FALSE;

if(!empty($dueDateStateCookie) || !empty($dueDateFinYearCookie))
	$isFilter=TRUE;
	
?>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box mt-40">
                    <div class="box-header with-border flexbox">
                        <h3 class="box-title">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h3>
                        <div class="text-right flex-grow">
                            <a href="<?php echo base_url('add_due_date'); ?>" >
                                <button class="btn btn-submit">Add Due Date</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?=base_url('search_due_date')?>" method="post" >
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="state form-group row ml-100">
                                        <label class="col-sm-3 col-form-label">State :</label>
                                        <div class="col-sm-9">
                                            <select class="custom-select form-control" id="due_state" name="due_state">
                                                <option value="">Select State </option>
                                                <?php if(!empty($stateList)): ?>
                                                    <?php foreach($stateList AS $e_state): ?>
                                                        <option value="<?php echo $e_state['stateId']; ?>" <?= set_select('due_state', $e_state['stateId'], $dueDateStateCookie==$e_state['stateId']) ?>><?php echo $e_state['stateName']; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="financial-year">
                                        <div class="form-group row ">
                                            <label class="col-sm-4 col-form-label">Due Date Year :</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" id="finYear" name="finYear">
                                                    <option value="">Select Due Date Year</option>
                                                    <?php for($d=2021; $d>=2011; $d--): ?>
                                                        <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                                        <option value="<?php echo $dueYr; ?>" <?php echo set_select('finYear', $dueYr, $dueDateFinYearCookie==$dueYr); ?> ><?php echo $dueYr; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="demo-radio-button">
                                        <input name="type" type="radio" id="radio_30" value="1" class="with-gap radio-col-primary" <?php if($dueDateTypeCookie==1): ?>checked<?php endif; ?> />
                                        <label for="radio_30">Actwise</label>	
                                        <input name="type" type="radio" id="radio_32" value="2" class="with-gap radio-col-primary" <?php if($dueDateTypeCookie==2): ?>checked<?php endif; ?> />
                                        <label for="radio_32">Datewise</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn <?php if($isFilter): ?>btn-success<?php else: ?>btn-secondary<?php endif; ?>">
                                        <i class="fa fa-search"></i> Filter <?php if($isFilter): ?>On<?php else: ?>Off<?php endif; ?>
                                    </button>
                                    <a href="<?=base_url('reset_due_date')?>">
                                        <button type="button" class="btn btn-dark">Reset</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <?php if($dueDateTypeCookie==1): ?>
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <?php for($m_no=1;$m_no<13;$m_no++): ?>
                            <?php
                                if($m_no<=9)
                                    $m=$m_no+3;
                                else
                                    $m=$m_no-9;
                            ?>
                            <?php $mth_nm=strtolower(date('F', strtotime("2021-".$m."-1"))); ?>
                            <li class="nav-item"> 
                                <a class="nav-link <?php if($dueDateFinYearCookie==$dueYear && $m==$currMth): ?>active<?php elseif($dueDateFinYearCookie!=$dueYear && $m==4): ?>active<?php endif; ?>" id="<?php echo $mth_nm; ?>-tab" data-toggle="tab" href="#<?php echo $mth_nm; ?>_tab" role="tab" aria-controls="profile">
                                    <span class="hidden-sm-up">
                                        <i class="ion-person"></i>
                                    </span> 
                                    <span class="hidden-xs-down year-color"><?php echo date('F', strtotime("2021-".$m."-1")); ?></span>
                                </a>
                            </li>	
                            <?php endfor; ?>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border p-15" id="myTabContent">
                            <?php for($mth=1;$mth<13;$mth++): ?>
                            <?php $mth_nm=strtolower(date('F', strtotime("2021-".$mth."-1"))); ?>
                            <div class="tab-pane fade table-responsive <?php if($dueDateFinYearCookie==$dueYear && $mth==$currMth): ?>show active<?php elseif($dueDateFinYearCookie!=$dueYear && $mth==4): ?>show active<?php endif; ?>" id="<?php echo $mth_nm; ?>_tab" role="tabpanel" aria-labelledby="<?php echo $mth_nm; ?>-tab">
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1">Due Date</th>
                                            <th class="column-2">Due Date For</th>
                                            <!-- <th class="column-3">Act</th> -->
                                            <th class="column-4">Tax Payer</th> 
                                            <th class="column-7">Form</th>
                                            <th class="column-5">Section</th>
                                            <!-- <th class="column-6">Audit</th> -->
                                            <th class="column-8">Periodicity</th>
                                            <th class="column-8">Financial<br/>Year</th>
                                            <th class="column-9">Period</th>
                                            <th class="column-9">Extended<br/>Date</th>
                                            <th class="column-9">Days<br/>Remaining</th>
                                            <th class="column-10">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">
                                        <?php
                                            $currAct="";
                                            $prevAct="";
                                        ?>
                                        <?php if(!empty($dueDatesArr) && in_array($mth, $dueMthsArr)): ?>
                                            <?php foreach($dueDatesArr AS $k_row=>$e_row): ?>
                                                <?php if($e_row['act_due_month']==$mth): ?>
                                                <?php $currAct=$e_row['act_name']; ?>
                                                    <?php if($currAct!=$prevAct): ?>
                                                        <tr class="row-2 tax_act_head">
                                                            <td colspan="11" class="column-1"><?php echo $e_row['act_name']; ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php $extended_date=$e_row['due_date']; ?>
                                                    <?php $extended_date_notes=$e_row['due_notes']; ?>
                                                    <tr class="row-3" style="background-color:<?php if($e_row['isExt']==2): ?>#f6fbff<?php else: ?><?php echo EXT_DUE_DATE_CLR; ?><?php endif; ?>;">
                                                        <td class="column-1"><?php echo date('d-m-Y', strtotime($e_row['due_date'])); ?></td>
                                                        <td class="column-2">
                                                            <?php 
                                                                if(!empty($e_row['act_option_name1']))
                                                                    echo $e_row['act_option_name1']; 
                                                                else
                                                                    echo "N/A"; 
                                                            ?>
                                                        </td>
                                                        <!-- <td class="column-3"><?php //echo $e_row['act_name']; ?></td> -->
                                                        <td class="column-4"> 
                                                            <?php 
                                                                if(!empty($e_row['act_option_name2']))
                                                                    echo $e_row['act_option_name2']; 
                                                                else
                                                                    echo "N/A"; 
                                                            ?>
                                                        </td> 
                                                        <td class="column-7">
                                                            <?php 
                                                                if(!empty($e_row['act_option_name5']))
                                                                    echo $e_row['act_option_name5']; 
                                                                else
                                                                    echo "N/A"; 
                                                            ?>
                                                        </td>
                                                        <td class="column-5">
                                                            <?php 
                                                                if(!empty($e_row['act_option_name3']))
                                                                    echo $e_row['act_option_name3']; 
                                                                else
                                                                    echo "N/A"; 
                                                            ?>
                                                        </td>
                                                        <!-- <td class="column-6"> -->
                                                            <?php 
                                                                // if(!empty($e_row['act_option_name4']))
                                                                //     echo $e_row['act_option_name4']; 
                                                                // else
                                                                //     echo "N/A"; 
                                                            ?>
                                                        <!-- </td> -->
                                                        <td class="column-8">
                                                            <?php 
                                                                if($e_row['periodicity']=="1")
                                                                {
                                                                    echo "Daily";
                                                                }
                                                                elseif($e_row['periodicity']=="2")
                                                                {
                                                                    echo "Monthly";
                                                                }
                                                                elseif($e_row['periodicity']=="3")
                                                                {
                                                                    echo "Quaterly";
                                                                }
                                                                elseif($e_row['periodicity']=="4")
                                                                {
                                                                    echo "Half Yearly";
                                                                }
                                                                elseif($e_row['periodicity']=="5")
                                                                {
                                                                    echo "Annually";
                                                                }
                                                                else
                                                                {
                                                                    echo "N/A";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="column-3"><?php echo $e_row['finYear']; ?></td>
                                                        <td class="column-9">
                                                            <?php 
                                                                if($e_row['periodicity']=="1")
                                                                {
                                                                    echo date("d-M-Y", strtotime($e_row["daily_date"]));
                                                                }
                                                                elseif($e_row['periodicity']=="2")
                                                                {
                                                                    echo date("M", strtotime("2021-".$e_row["period_month"]."-01"))."-".$e_row["period_year"];
                                                                }
                                                                elseif($e_row['periodicity']>="3")
                                                                {
                                                                    echo date("M", strtotime("2021-".$e_row["f_period_month"]."-01"))."-".$e_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_row["t_period_month"]."-01"))."-".$e_row["t_period_year"];
                                                                }
                                                                else
                                                                {
                                                                    echo "N/A";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="column-11">
                                                            <?php $d=1; ?>
                                                            <?php if(isset($extDueDateArr[$e_row["due_date_id"]])): ?>
                                                            <?php $extDueDateArray=$extDueDateArr[$e_row["due_date_id"]]; ?>
                                                            
                                                                <?php if(!empty($extDueDateArray)): ?>
                                                                    <?php foreach($extDueDateArray AS $e_d): ?>
                                                                        <div>
                                                                            <?php echo (date('d-m-Y', strtotime($e_d['extended_date']))); ?>
                                                                            <?php $extended_date=$e_d['extended_date']; ?>
                                                                            <?php $extended_date_notes=$e_d['extended_date_notes']; ?>
                                                                        </div>
                                                                        <?php $d++; ?>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    N/A
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                N/A
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="column-11 text-center">
                                                            <?php
                                                                $now = time(); // or your date as well
                                                                $your_date = strtotime($extended_date);
                                                                $datediff = $now - $your_date;
                                                                
                                                                if($your_date>$now)
                                                                    echo abs((float)round($datediff / (60 * 60 * 24)));
                                                                else
                                                                    echo "-";
                                                            ?>
                                                        </td>
                                                        <td class="column-10">
                                                            <button type="button" class="waves-effect waves-light btn btn-sm btn-primary mb-5" data-toggle="modal" data-target="#modal_view<?php echo $k_row; ?>">
                                                                Note
                                                            </button>
                                                            
                                                            <a href="<?php echo base_url('edit_due_date/'.$e_row['due_date_id']); ?>">
                                                                <button class="btn btn-sm btn-warning mb-5" data-toggle="tooltip" data-original-title="Edit Due Date">
                                                                    <i class="fa fa-pencil"></i>&nbsp;Edit
                                                                </button>
                                                            </a>
                                                            
                                                            <a href="<?php echo base_url('extend_due_date/'.$e_row['due_date_id']); ?>">
                                                                <button class="btn btn-sm btn-success mb-5" data-toggle="tooltip" data-original-title="Extend Due Date">
                                                                    <i class="fa fa-calendar-plus-o"></i>&nbsp;Extend
                                                                </button>
                                                            </a>
                                                            <button class="btn btn-sm btn-danger delDueDate mb-5" data-toggle="tooltip" data-original-title="Delete" id="<?php echo $e_row['due_date_id']; ?>">
                                                                <i class="fa fa-trash"></i>&nbsp;Delete
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal center-modal fade" id="modal_view<?php echo $k_row; ?>" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Acts Details</h5>
                                                                            <button type="button" class="close" data-dismiss="modal">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php $d=1; ?>
                                                                            <?php if(isset($extDueDateArr[$e_row["due_date_id"]])): ?>
                                                                            <?php $extDueDateArray=$extDueDateArr[$e_row["due_date_id"]]; ?>
                                                                                <?php if(!empty($extDueDateArray)): ?>
                                                                                    <?php foreach($extDueDateArray AS $e_d): ?>
                                                                                        <p>
                                                                                            <?php echo (date('d-m-Y', strtotime($e_d['extended_date'])))." - ".$e_d['extended_date_notes']; ?>
                                                                                        </p>
                                                                                        <?php $d++; ?>
                                                                                    <?php endforeach; ?>
                                                                                <?php else: ?>
                                                                                    N/A
                                                                                <?php endif; ?>
                                                                            <?php else: ?>
                                                                                N/A
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="modal-footer modal-footer-uniform text-right">
                                                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal -->
                                                        </td>
                                                    </tr>
                                                    <?php $prevAct=$currAct; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="11"><center>No Records</center></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <?php else: ?>
                            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <?php for($m_no=1;$m_no<13;$m_no++): ?>
                            <?php
                                if($m_no<=9)
                                    $m=$m_no+3;
                                else
                                    $m=$m_no-9;
                            ?>
                            <?php $mth_nm=strtolower(date('F', strtotime("2021-".$m."-1"))); ?>
                            <li class="nav-item"> 
                                <a class="nav-link <?php if($dueDateFinYearCookie==$dueYear && $m==$currMth): ?>active<?php elseif($dueDateFinYearCookie!=$dueYear && $m==4): ?>active<?php endif; ?>" id="<?php echo $mth_nm; ?>-tab" data-toggle="tab" href="#<?php echo $mth_nm; ?>_tab" role="tab" aria-controls="profile">
                                    <span class="hidden-sm-up">
                                        <i class="ion-person"></i>
                                    </span> 
                                    <span class="hidden-xs-down year-color"><?php echo date('F', strtotime("2021-".$m."-1")); ?></span>
                                </a>
                            </li>	
                            <?php endfor; ?>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border p-15" id="myTabContent">
                            <?php for($mth=1;$mth<13;$mth++): ?>
                            <?php $mth_nm=strtolower(date('F', strtotime("2021-".$mth."-1"))); ?>
                            <div class="tab-pane fade table-responsive <?php if($dueDateFinYearCookie==$dueYear && $mth==$currMth): ?>show active<?php elseif($dueDateFinYearCookie!=$dueYear && $mth==4): ?>show active<?php endif; ?>" id="<?php echo $mth_nm; ?>_tab" role="tabpanel" aria-labelledby="<?php echo $mth_nm; ?>-tab">
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1">Due Date</th>
                                            <th class="column-2">Due Date For</th>
                                            <th class="column-3">Act</th>
                                            <th class="column-4">Tax Payer</th> 
                                            <th class="column-7">Form</th>
                                            <th class="column-5">Section</th>
                                            <!-- <th class="column-6">Audit</th> -->
                                            <th class="column-8">Periodicity</th>
                                            <th class="column-8">Financial<br/>Year</th>
                                            <th class="column-9">Period</th>
                                            <th class="column-9">Extended<br/>Date</th>
                                            <th class="column-9">Days<br/>Remaining</th>
                                            <th class="column-10">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">
                                        <?php
                                            $currAct="";
                                            $prevAct="";
                                        ?>
                                        <?php if(!empty($dueDatesArr) && in_array($mth, $dueMthsArr)): ?>
                                            <?php foreach($dueDatesArr AS $k_row=>$e_row): ?>
                                                <?php if($e_row['act_due_month']==$mth): ?>
                                                    <?php $currAct=$e_row['act_name']; ?>
                                                    <?php $extended_date=$e_row['due_date']; ?>
                                                    <?php $extended_date_notes=$e_row['due_notes']; ?>
                                                    <tr class="row-3" style="background-color:<?php if($e_row['isExt']==2): ?>#f6fbff<?php else: ?>#5adf56<?php endif; ?>">
                                                        <td class="column-1"><?php echo date('d-m-Y', strtotime($e_row['due_date'])); ?></td>
                                                        <td class="column-2">
                                                            <?php 
                                                                if(!empty($e_row['act_option_name1']))
                                                                    echo $e_row['act_option_name1']; 
                                                                else
                                                                    echo "N/A";
                                                            ?>
                                                        </td>
                                                        <td class="column-3"><?php echo $e_row['act_name']; ?></td>
                                                        <td class="column-4"> 
                                                            <?php 
                                                                if(!empty($e_row['act_option_name2']))
                                                                    echo $e_row['act_option_name2']; 
                                                                else
                                                                    echo "N/A"; 
                                                            ?>
                                                        </td> 
                                                        <td class="column-7">
                                                            <?php 
                                                                if(!empty($e_row['act_option_name5']))
                                                                    echo $e_row['act_option_name5']; 
                                                                else
                                                                    echo "N/A"; 
                                                            ?>
                                                        </td>
                                                        <td class="column-5">
                                                            <?php 
                                                                if(!empty($e_row['act_option_name3']))
                                                                    echo $e_row['act_option_name3']; 
                                                                else
                                                                    echo "N/A"; 
                                                            ?>
                                                        </td>
                                                        <!-- <td class="column-6"> -->
                                                            <?php 
                                                                // if(!empty($e_row['act_option_name4']))
                                                                //     echo $e_row['act_option_name4']; 
                                                                // else
                                                                //     echo "N/A"; 
                                                            ?>
                                                        <!-- </td> -->
                                                        <td class="column-8">
                                                            <?php 
                                                                if($e_row['periodicity']=="1")
                                                                {
                                                                    echo "Daily";
                                                                }
                                                                elseif($e_row['periodicity']=="2")
                                                                {
                                                                    echo "Monthly";
                                                                }
                                                                elseif($e_row['periodicity']=="3")
                                                                {
                                                                    echo "Quaterly";
                                                                }
                                                                elseif($e_row['periodicity']=="4")
                                                                {
                                                                    echo "Half Yearly";
                                                                }
                                                                elseif($e_row['periodicity']=="5")
                                                                {
                                                                    echo "Annually";
                                                                }
                                                                else
                                                                {
                                                                    echo "N/A";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="column-3"><?php echo $e_row['finYear']; ?></td>
                                                        <td class="column-9">
                                                            <?php 
                                                                if($e_row['periodicity']=="1")
                                                                {
                                                                    echo date("d-M-Y", strtotime($e_row["daily_date"]));
                                                                }
                                                                elseif($e_row['periodicity']=="2")
                                                                {
                                                                    echo date("M", strtotime("2021-".$e_row["period_month"]."-01"))."-".$e_row["period_year"];
                                                                }
                                                                elseif($e_row['periodicity']>="3")
                                                                {
                                                                    echo date("M", strtotime("2021-".$e_row["f_period_month"]."-01"))."-".$e_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_row["t_period_month"]."-01"))."-".$e_row["t_period_year"];
                                                                }
                                                                else
                                                                {
                                                                    echo "N/A";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="column-11">
                                                            <?php $d=1; ?>
                                                            <?php if(isset($extDueDateArr[$e_row["due_date_id"]])): ?>
                                                            <?php $extDueDateArray=$extDueDateArr[$e_row["due_date_id"]]; ?>
                                                            
                                                                <?php if(!empty($extDueDateArray)): ?>
                                                                    <?php foreach($extDueDateArray AS $e_d): ?>
                                                                        <div>
                                                                            <?php echo (date('d-m-Y', strtotime($e_d['extended_date']))); ?>
                                                                            <?php $extended_date=$e_d['extended_date']; ?>
                                                                            <?php $extended_date_notes=$e_d['extended_date_notes']; ?>
                                                                        </div>
                                                                        <?php $d++; ?>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    N/A
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                N/A
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="column-11 text-center">
                                                            <?php
                                                                $now = time(); // or your date as well
                                                                $your_date = strtotime($extended_date);
                                                                $datediff = $now - $your_date;
                                                                
                                                                if($your_date>$now)
                                                                    echo abs((float)round($datediff / (60 * 60 * 24)));
                                                                else
                                                                    echo "-";
                                                            ?>
                                                        </td>
                                                        <td class="column-10">
                                                            <button type="button" class="waves-effect waves-light btn btn-sm btn-primary mb-5" data-toggle="modal" data-target="#modal_view<?php echo $k_row; ?>">
                                                                Note
                                                            </button>
                                                            
                                                            <a href="<?php echo base_url('edit_due_date/'.$e_row['due_date_id']); ?>">
                                                                <button class="btn btn-sm btn-warning mb-5" data-toggle="tooltip" data-original-title="Edit Due Date">
                                                                    <i class="fa fa-pencil"></i>&nbsp;Edit
                                                                </button>
                                                            </a>
                                                            
                                                            <a href="<?php echo base_url('extend_due_date/'.$e_row['due_date_id']); ?>">
                                                                <button class="btn btn-sm btn-success mb-5" data-toggle="tooltip" data-original-title="Extend Due Date">
                                                                    <i class="fa fa-calendar-plus-o"></i>&nbsp;Extend
                                                                </button>
                                                            </a>
                                                            <button class="btn btn-sm btn-danger delDueDate mb-5" data-toggle="tooltip" data-original-title="Delete" id="<?php echo $e_row['due_date_id']; ?>">
                                                                <i class="fa fa-trash"></i>&nbsp;Delete
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal center-modal fade" id="modal_view<?php echo $k_row; ?>" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Acts Details</h5>
                                                                            <button type="button" class="close" data-dismiss="modal">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php $d=1; ?>
                                                                            <?php if(isset($extDueDateArr[$e_row["due_date_id"]])): ?>
                                                                            <?php $extDueDateArray=$extDueDateArr[$e_row["due_date_id"]]; ?>
                                                                                <?php if(!empty($extDueDateArray)): ?>
                                                                                    <?php foreach($extDueDateArray AS $e_d): ?>
                                                                                        <p>
                                                                                            <?php echo (date('d-m-Y', strtotime($e_d['extended_date'])))." - ".$e_d['extended_date_notes']; ?>
                                                                                        </p>
                                                                                        <?php $d++; ?>
                                                                                    <?php endforeach; ?>
                                                                                <?php else: ?>
                                                                                    N/A
                                                                                <?php endif; ?>
                                                                            <?php else: ?>
                                                                                N/A
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="modal-footer modal-footer-uniform text-right">
                                                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal -->
                                                        </td>
                                                    </tr>
                                                    <?php $prevAct=$currAct; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="11"><center>No Records</center></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <?php endif; ?>
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

<script>
    $(document).ready(function(){
        $('.delDueDate').on('click', function () {

        var base_url = "<?php echo base_url(); ?>";
        var due_date_id = $(this).attr('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this due date ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/delete_due_date';
                    $.post(postingUrl, 
                    {
                        due_date_id: due_date_id
                    },
                    function(data, status){
                        window.location.href=base_url+"/due_dates";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
    });
</script>   

<?= $this->endSection(); ?>