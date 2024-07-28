
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
  font-size: 15px !important;
}

.font_bold{
    font-weight: bold !important;
}

.theme-primary .btnPrimClr {
    margin-top: 0px !important;
    margin-bottom: 0px !important;
}
</style>

<?php

$isFilter=FALSE;

if(!empty($taxCalIsAdminCookie))
	$isFilter=TRUE;
	
?>
    <!-- Main content -->
    <section class="content mt-35">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border text-center">
                        <h4 class="box-title font-weight-bold">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!--<div class="row mb-10" id="filterLabels">-->
                        <!--</div>-->
                        <div class="row mb-10">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-2" for="due_act_sel">Act :</label>
                                    <div class="col-md-6">
                                        <select class="custom-select form-control" id="due_act_sel" name="due_act_sel">
                                            <option value="">Select Act</option>
                                            <?php if(!empty($actArr)): ?>
                                                <?php foreach($actArr AS $e_act): ?>
                                                    <option value="<?php echo $e_act['act_id']; ?>" <?= set_select('due_act', $e_act['act_id'], $e_act['act_id']==$taxCalSelActVal ? TRUE:FALSE) ?>><?php echo $e_act['act_name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#Modalfilter-intax">
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Filter">
                                    <i class="fa fa-filter"></i>&nbsp;Filter</button>
                                </a>
                            </div>
                        </div>
                        
                        <?php if($taxCalTypeAdminCookie!="3"): ?>
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
                                <a class="nav-link <?php if($taxCalFinYearAdminCookie==$dueYear && $m==$currMth && $monthNoVar==""): ?>active<?php elseif($taxCalFinYearAdminCookie!=$dueYear && $m==4 && $monthNoVar==""): ?>active<?php elseif($monthNoVar==$m && $monthNoVar!=""): ?>active<?php endif; ?>" id="<?php echo $mth_nm; ?>-tab" href="<?= base_url('mth_tax_calendar?getCurrMth='.$m); ?>" role="tab" aria-controls="profile">
                                    <span class="hidden-sm-up">
                                        <i class="ion-person"></i>
                                    </span> 
                                    <span class="hidden-xs-down year-color font-weight-bold"><?php echo date('F', strtotime("2021-".$m."-1")); ?></span>
                                </a>
                            </li>	
                            <?php endfor; ?>
                        </ul>
                        <?php endif; ?>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border p-15" id="myTabContent">
                            <?php for($mth=1;$taxCalTypeAdminCookie!="3" ? $mth<13:$mth<2;$mth++): ?>
                            <?php $mth_nm=strtolower(date('M', strtotime("2021-".$mth."-1"))); ?>
                            
                            <?php
                                // echo 'currMth : '.$currMth." mth: ".$mth.', ';
                                // echo 'taxCalFinYearAdminCookie : '.$taxCalFinYearAdminCookie." dueYear: ".$dueYear.', <br>';
                            ?>

                            <?php if($taxCalTypeAdminCookie!="3"): ?>
                            <div class="tab-pane fade table-responsive <?php if($taxCalFinYearAdminCookie==$dueYear && $mth==$currMth && $monthNoVar==""): ?>show active<?php elseif($taxCalFinYearAdminCookie!=$dueYear && $mth==4 && $monthNoVar==""): ?>show active<?php elseif($monthNoVar==$mth && $monthNoVar!=""): ?>show active<?php endif; ?>" id="<?php echo $mth_nm; ?>_tab" role="tabpanel" aria-labelledby="<?php echo $mth_nm; ?>-tab">
                            <?php endif; ?>
                                
                                <?php if($currMth==$mth): ?>
                                
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1">Due Date</th>
                                            <th class="column-7">Form</th>
                                            <th class="column-7">Type</th>
                                            <th class="column-2">Due Date For</th>
                                            <?php if($taxCalTypeAdminCookie!="1"): ?>
                                            <th class="column-3">Act</th>
                                            <?php endif; ?>
                                            <!--<th class="column-4" style="width: 130px;">Tax Payer</th>-->
                                            <th class="column-5">Section</th>
                                            <!--<th class="column-6">Audit</th>-->
                                            <th class="column-8">Periodicity</th>
                                            <th class="column-8">Financial<br/>Year</th>
                                            <th class="column-9">Period</th>
                                            <!--<th class="column-9">Days<br/>Pending</th>-->
                                            <th class="column-9">Extended<br/>Date</th>
                                            <th class="column-10">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">
                                        <?php
                                            $currAct="";
                                            $prevAct="";
                                        ?>
                                        <?php 
                                            if($taxCalTypeAdminCookie!="3")
                                                $mainCond=(!empty($dueDatesArr) && in_array($mth, $dueMthsArr));
                                            else
                                                $mainCond=(!empty($dueDatesArr));
                                        ?>
                                        <?php if($mainCond): ?>
                                            <?php foreach($dueDatesArr AS $k_row=>$e_row): ?>
                                                <?php if(($e_row['act_due_date_month']==$mth && $taxCalTypeAdminCookie!="3") || ($taxCalTypeAdminCookie=="3")): ?>
                                                <?php $currAct=$e_row['act_name']; ?>
                                                
                                                <?php if($taxCalTypeAdminCookie=="1"): ?>
                                                    <?php if($currAct!=$prevAct): ?>
                                                        <tr class="row-2 tax_act_head">
                                                            <td colspan="12" class="column-1"><?php echo $e_row['act_name']; ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php $extended_date=$e_row['extended_date']; ?>
                                                <?php $extended_date_notes=htmlspecialchars_decode(html_entity_decode($e_row['due_notes'])); ?>
                                                <tr class="row-3 <?php if($e_row['is_extended']==1): ?>ext_date_row<?php endif; ?>" style="background-color:<?php if($e_row['is_extended']==2): ?>#96c7f242<?php else: ?><?php echo EXT_DUE_DATE_STYLE; ?><?php endif; ?>;">
                                                    <td class="column-1 column_date" nowrap><?php echo date('d-m-Y', strtotime($e_row['extended_date'])); ?></td>
                                                    <td class="column-7 text-center font_bold" nowrap>
                                                        <?php
                                                            if(!empty($e_row['act_option_name5']))
                                                                echo $e_row['act_option_name5']; 
                                                            else
                                                                echo "N/A"; 
                                                        ?>
                                                    </td>
                                                    <td class="column-7 text-center" nowrap>
                                                        <?php
                                                            if(!empty($e_row['dueDateTypeShortName']))
                                                                echo $e_row['dueDateTypeShortName']; 
                                                            else
                                                                echo "N/A"; 
                                                        ?>
                                                    </td>
                                                    <td class="column-2" nowrap>
                                                        <?php 
                                                            // if(!empty($e_row['act_option_name5']))
                                                            //     $ddForm = $e_row['act_option_name5']; 
                                                            // else
                                                            //     $ddForm = "N/A";
                                                        ?>
                                                        <?php if(!empty($e_row['act_option_name1'])): ?>
                                                            <?php //$dueDateForStr=$ddForm."-".$e_row['act_option_name1']; ?>
                                                            <?php $dueDateForStr=$e_row['act_option_name1']; ?>
                                                                
                                                            <?php if(strlen($dueDateForStr)>50): ?>
                                                            
                                                                <span data-toggle="tooltip" data-original-title="<?= $dueDateForStr; ?>" style="cursor:pointer;"><?= $dueDateForText=substr($dueDateForStr, 0, 50)."..."; ?></span>
                                                                    
                                                            <?php else: ?>
                                                                <?= $dueDateForStr; ?>
                                                            <?php endif; ?>
                                                            
                                                        <?php else: ?>
                                                            <div class="text-center">N/A</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <?php if($taxCalTypeAdminCookie!="1"): ?>
                                                    <td class="column-3 text-center" nowrap><?php echo $e_row['act_name']; ?></td>
                                                    <?php endif; ?>
                                                    <!--<td class="column-4">-->
                                                    <?php
                                                            // if(!empty($e_row['act_option_name2']))
                                                            //     echo $e_row['act_option_name2']; 
                                                            // else
                                                            //     echo "N/A"; 
                                                    ?>
                                                    <!--</td>-->
                                                    <!--<td class="column-4" style="width: 130px;">-->
                                                    <?php
                                                        // if($e_row['is_all_tax_payer']=="1")
                                                        // {
                                                        //     echo "All Assessees";
                                                        // }
                                                        // else
                                                        // {
                                                        //     if(!empty($e_row['tax_payers']))
                                                        //         echo $e_row['tax_payers']; 
                                                        //     else
                                                        //         echo "N/A"; 
                                                        // }
                                                    ?>
                                                    <!--</td>-->
                                                    <td class="column-5 text-center" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['act_option_name3']))
                                                                echo $e_row['act_option_name3']; 
                                                            else
                                                                echo "N/A"; 
                                                        ?>
                                                    </td>
                                                    <!--<td class="column-6">-->
                                                        <?php 
                                                            // if(!empty($e_row['act_option_name4']))
                                                            //     echo $e_row['act_option_name4']; 
                                                            // else
                                                            //     echo "N/A"; 
                                                        ?>
                                                    <!--</td>-->
                                                    <td class="column-8 text-center" nowrap>
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
                                                    <td class="column-3 text-center" nowrap><?php echo $e_row['finYear']; ?></td>
                                                    <td class="column-9 text-center" nowrap>
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
                                                    <!--
                                                    <td class="column-11 text-center" nowrap>
                                                        <?php
                                                            /*
                                                            $now = time(); // or your date as well
                                                            $your_date = strtotime($extended_date);
                                                            $datediff = $now - $your_date;
                                                            
                                                            if($your_date>$now)
                                                                echo abs((float)round($datediff / (60 * 60 * 24)));
                                                            else
                                                                echo "-";
                                                            */
                                                        ?>
                                                    </td>
                                                    -->
                                                    <td class="column-11 text-center" nowrap>
                                                        <?php $nextDueDate=$e_row['next_extended_date']; ?>

                                                        <?php if($nextDueDate!="" && $nextDueDate!="1970-01-01"  && $nextDueDate!="0000-00-00"): ?>
                                                            <?php echo date("d-m-Y", strtotime($nextDueDate)); ?>
                                                        <?php else: ?>
                                                            N/A
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="column-10" nowrap>
                                                        <?php
                                                            $emptyDDFDocs = false;
                                                            if(empty($extended_date_notes) && empty($e_row['ext_doc_file'])){
                                                                $emptyDDFDocs = true;
                                                            }

                                                            $disabledDropdown = $emptyDDFDocs ? 'disabled' : '';
                                                        ?>
                                                        <div class="btn-group mb-5">
                                                            <button type="button" class="waves-effect waves-light btn btn-sm btn-info btnPrimClr dropdown-toggle <?= $disabledDropdown; ?>" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#modal_view<?php echo $k_row; ?>">View Note</a>
                                                                <?php if($e_row['is_extended']==2 && !empty($e_row['ext_doc_file'])): ?>
                                                                    <a class="dropdown-item" href="<?php echo base_url("uploads/admin/due_date/".$e_row['ext_doc_file']); ?>" target="_blank">View Document</a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modal_view<?php echo $k_row; ?>" tabindex="-1">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Note</h5>
                                                                        <button type="button" class="close" data-dismiss="modal">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body" style="width: 100% !important;">
                                                                        <?php if(!empty($extended_date_notes)): ?>
                                                                            <?php echo $extended_date_notes; ?>
                                                                        <?php else: ?>
                                                                            N/A
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="modal-footer text-right">
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
                                                <?php if($taxCalTypeAdminCookie==1): ?>
                                                    <td colspan="10"><center>No Records</center></td>
                                                <?php else: ?>
                                                    <td colspan="11"><center>No Records</center></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                
                                <?php endif; ?>
                            <?php if($taxCalTypeAdminCookie!="3"): ?>
                            </div>
                            <?php endif; ?>
                            <?php endfor; ?>
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

<!-- Modal -->
<div id="Modalfilter-intax" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="<?=base_url('tax_calendar')?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="state form-group row ">
                                <label class="col-sm-4 col-form-label">State:</label>
                                <div class="col-sm-6">
                                    <select class="custom-select form-control" id="due_state" name="due_state">
                                        <option value="">Select State </option>
                                        <?php if(!empty($stateList)): ?>
                                            <?php foreach($stateList AS $e_state): ?>
                                                <option value="<?php echo $e_state['stateId']; ?>" <?= set_select('due_state', $e_state['stateId'], $taxCalStateAdminCookie==$e_state['stateId']) ?>><?php echo $e_state['stateName']; ?></option>
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
                                            <?php for($d=$currentFinancialYear; $d>=2011; $d--): ?>
                                                <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                                <option value="<?php echo $dueYr; ?>" <?php echo set_select('finYear', $dueYr, $taxCalFinYearAdminCookie==$dueYr); ?> ><?php echo $dueYr; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="financial-year">
                                <div class="form-group row ">
                                    <label class="col-sm-4 col-form-label">Financial Year :</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="finYearVal" name="finYearVal">
                                            <option value="">Select Financial Year</option>
                                            <?php for($h=$currentFinancialYear; $h>=2011; $h--): ?>
                                                <?php $fnYr=$h."-".(substr($h+1, 2)); ?>
                                                <option value="<?php echo $fnYr; ?>" <?php echo set_select('finYearVal', $fnYr, $taxCalFinYearValAdminCookie==$fnYr); ?> ><?php echo $fnYr; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-4">
                            <div class="form-group row ">
                                <label class="col-sm-4 col-form-label">Sort By :</label>
                                <div class="col-sm-6 mt-5">
                                    <select class="form-control" id="calenderType" name="calenderType">
                                        <option value="">Select Sort By</option>
                                        <option value="1" <?php if($taxCalTypeAdminCookie=="1"): ?>selected<?php endif; ?>>Actwise</option>
                                        <option value="2" <?php if($taxCalTypeAdminCookie=="2"): ?>selected<?php endif; ?>>Datewise (Monthly)</option>
                                        <option value="3" <?php if($taxCalTypeAdminCookie=="3"): ?>selected<?php endif; ?>>Datewise (Full Year)</option>
                                    </select>
                                    <!-- <div class="demo-radio-button">
                                        <input name="calenderType" type="radio" id="radio_30" class="with-gap radio-col-primary" value="1" <?php if($taxCalTypeAdminCookie=="1"): ?>checked<?php endif; ?> />
                                        <label for="radio_30">Actwise</label>	
                                        <input name="calenderType" type="radio" id="radio_32" class="with-gap radio-col-primary" value="2" <?php if($taxCalTypeAdminCookie=="2"): ?>checked<?php endif; ?> />
                                        <label for="radio_32">Datewise (Monthly)</label>
                                        <input name="calenderType" type="radio" id="radio_33" class="with-gap radio-col-primary" value="3" <?php if($taxCalTypeAdminCookie=="3"): ?>checked<?php endif; ?> />
                                        <label for="radio_33">Datewise (Full Year)</label>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row" id="due_act_div">
                                <label class="col-md-4" for="due_act">Act :</label>
                                <div class="col-md-6">
                                    <select class="custom-select form-control" id="due_act" name="due_act">
                                        <option value="">Select Act</option>
                                        <?php if(!empty($actArr)): ?>
                                            <?php foreach($actArr AS $e_act): ?>
                                                <option value="<?php echo $e_act['act_id']; ?>" <?= set_select('due_act', $e_act['act_id'], $e_act['act_id']==$taxCalActAdminCookie ? TRUE:FALSE) ?>><?php echo $e_act['act_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row" id="due_date_for_div">
                                <label class="col-md-4" for="due_date_for">Due Date For :</label>
                                <div class="col-md-6">
                                    <select class="custom-select form-control" id="due_date_for" name="due_date_for">
                                        <option value="">Select Due Date For</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-4">
                            <div class="form-group row" id="applicable_form_div">
                                <label class="col-md-4" for="applicable_form">Applicable Form :</label>
                                <div class="col-md-6">
                                    <select class="custom-select form-control" id="applicable_form" name="applicable_form">
                                        <option value="">Select Applicable Form</option>
                                    </select>
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row" id="under_section_div">
                                <label class="col-md-4" for="under_section">Under Section :</label>
                                <div class="col-md-6">
                                    <select class="custom-select form-control" id="under_section" name="under_section">
                                        <option value="">Select Under Section</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row" id="periodicity_div">
                                <label class="col-sm-4 col-form-label">Periodicity :</label>
                                <div class="col-sm-6">
                                    <select class="custom-select form-control" id="periodicity" name="periodicity">
                                        <option value="">Select Periodicity</option>
                                        <?php if(!empty($periodArr)): ?>
                                            <?php foreach($periodArr AS $e_prd): ?>
                                                <option value="<?php echo $e_prd['periodicity_id']; ?>" <?= set_select('periodicity', $e_prd['periodicity_id'], $taxCalPeriodicityAdminCookie==$e_prd['periodicity_id'] ? TRUE:FALSE) ?>><?php echo $e_prd['periodicity_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-8">
                            <div class="form-group row" id="period_div">
                                <label class="col-md-2" for="period_label">Period :</label>
                                <div class="col-md-8">
                                    <div id="daily_div">
                                        <input type="date" name="daily_date" id="period_daily" value="<?= $taxCalDailyAdminCookie; ?>">
                                    </div>
                                    <div id="monthly_div">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select class="custom-select form-control" id="period_month" name="period_month">
                                                    <option value="">Select Month</option>
                                                    <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                    <?php
                                                        if($m_no<=9)
                                                            $m=$m_no+3;
                                                        else
                                                            $m=$m_no-9;

                                                        if($m==$taxCalPrdMthAdminCookie)
                                                            $sel="selected";
                                                        else
                                                            $sel="";
                                                    ?>
                                                        <option value="<?php echo $m; ?>" <?= $sel; ?> ><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="custom-select form-control" id="period_year" name="period_year">
                                                    <option value="">Select Year</option>
                                                    <?php for($y=(date('Y')+2);$y>=2011;$y--): ?>
                                                        <?php
                                                            if($y==$taxCalPrdYrAdminCookie)
                                                                $sel="selected";
                                                            else
                                                                $sel="";
                                                        ?>
                                                        <option value="<?php echo $y; ?>" <?= $sel; ?> ><?php echo $y; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="range_div">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <span for="date" class="mt-5">From:</span>
                                                    <select class="custom-select form-control" id="f_period_month" name="f_period_month">
                                                        <option value="">Select Month</option>
                                                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                            <?php
                                                                if($m_no<=9)
                                                                    $m=$m_no+3;
                                                                else
                                                                    $m=$m_no-9;

                                                                if($m==$taxCalFPrdMthAdminCookie)
                                                                    $sel="selected";
                                                                else
                                                                    $sel="";
                                                            ?>
                                                            <option value="<?php echo $m; ?>" <?= $sel; ?> ><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mt-20">
                                                    <select class="custom-select form-control" id="f_period_year" name="f_period_year">
                                                        <option value="">Select Year</option>
                                                        <?php for($y=(date('Y')+2);$y>=2011;$y--): ?>
                                                            <?php
                                                                if($y==$taxCalFPrdYrAdminCookie)
                                                                    $sel="selected";
                                                                else
                                                                    $sel="";
                                                            ?>
                                                            <option value="<?php echo $y; ?>" <?= $sel; ?> ><?php echo $y; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <span for="date" class="mt-5">To:</span>
                                                    <select class="custom-select form-control" id="t_period_month" name="t_period_month">
                                                        <option value="">Select Month</option>
                                                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                            <?php
                                                                if($m_no<=9)
                                                                    $m=$m_no+3;
                                                                else
                                                                    $m=$m_no-9;

                                                                if($m==$taxCalTPrdMthAdminCookie)
                                                                    $sel="selected";
                                                                else
                                                                    $sel="";
                                                            ?>
                                                            <option value="<?php echo $m; ?>" <?= $sel; ?> ><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mt-20">
                                                    <select class="custom-select form-control" id="t_period_year" name="t_period_year">
                                                        <option value="">Select Year</option>
                                                        <?php for($y=(date('Y')+2);$y>=2011;$y--): ?>
                                                            <?php
                                                                if($y==$taxCalTPrdYrAdminCookie)
                                                                    $sel="selected";
                                                                else
                                                                    $sel="";
                                                            ?>
                                                            <option value="<?php echo $y; ?>" <?= $sel; ?> ><?php echo $y; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="type" value="1">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i> Filter
                    </button>
                    <!--<a href="<?php //echo base_url('admin/reset_tax_calendar')?>">-->
                    <!--    <button type="button" class="btn btn-dark">Reset</button>-->
                    <!--</a>-->
                    <a href="<?php echo base_url('tax_calendar')?>">
                        <button type="button" class="btn btn-warning text-left" >Reset</button>
                    </a>
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
    
    <script>
        $(document).ready(function(){
            
            var base_url="<?php echo base_url(); ?>";
            
            // $('#radio_30').on('click', function(){
            //     window.location.href=base_url+"/admin/tax_calendar";
            // });
            
            // $('#radio_32').on('click', function(){
            //     window.location.href=base_url+"/admin/date_wise_tax_calendar";
            // });
            
        });
    </script>

<script>

    function setLabels()
    {
        var due_state=$('#due_state option:selected').val();
        var due_state_val=$('#due_state option:selected').text();

        var finYear=$('#finYear option:selected').val();
        var finYear_val=$('#finYear option:selected').text();

        var finYearVal=$('#finYearVal option:selected').val();
        var finYearVal_val=$('#finYearVal option:selected').text();

        var calenderType=$('#calenderType option:selected').val();
        var calenderType_val=$('#calenderType option:selected').text();

        var due_act=$('#due_act option:selected').val();
        var due_act_val=$('#due_act option:selected').text();

        var due_date_for=$('#due_date_for option:selected').val();
        var due_date_for_val=$('#due_date_for option:selected').text();

        var applicable_form=$('#applicable_form option:selected').val();
        var applicable_form_val=$('#applicable_form option:selected').text();

        var under_section=$('#under_section option:selected').val();
        var under_section_val=$('#under_section option:selected').text();

        var periodicity=$('#periodicity option:selected').val();
        var periodicity_val=$('#periodicity option:selected').text();

        var period_daily=$('#period_daily option:selected').val();

        if(period_daily!="")
        {
            var date1=new Date(period_daily);
            var month1 = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][date1.getMonth()];
            var period_daily_val = date1.getDate() +'-'+ month1 + '-' + date1.getFullYear();
        }
        else
        {
            var period_daily_val = "";
        }

        var period_month=$('#period_month option:selected').val();
        var period_month_val=$('#period_month option:selected').text();

        var period_year=$('#period_year option:selected').val();
        var period_year_val=$('#period_year option:selected').text();

        var f_period_month=$('#f_period_month option:selected').val();
        var f_period_month_val=$('#f_period_month option:selected').text();

        var f_period_year=$('#f_period_year option:selected').val();
        var f_period_year_val=$('#f_period_year option:selected').text();

        var t_period_month=$('#t_period_month option:selected').val();
        var t_period_month_val=$('#t_period_month option:selected').text();

        var t_period_year=$('#t_period_year option:selected').val();
        var t_period_year_val=$('#t_period_year option:selected').text();

        var filterLabels='';

        if(due_state!="")
        {
            filterLabels+='<div class="col-md-4"><div class="form-group row"><label class="col-md-4">State :</label><div class="col-md-6">'+due_state_val+'</div></div></div>';
        }

        if(finYear!="")
        {
            filterLabels+='<div class="col-md-4"><div class="form-group row"><label class="col-md-4">Due Date Year :</label><div class="col-md-6">'+finYear_val+'</div></div></div>';
        }

        if(finYearVal!="")
        {
            filterLabels+='<div class="col-md-4"><div class="form-group row"><label class="col-md-4">Financial Year :</label><div class="col-md-6">'+finYearVal_val+'</div></div></div>';
        }

        if(calenderType!="")
        {
            filterLabels+='<div class="col-md-4"><div class="form-group row"><label class="col-md-4">Sort By :</label><div class="col-md-6">'+calenderType_val+'</div></div></div>';
        }

        if(due_act!="")
        {
            filterLabels+='<div class="col-md-4"><div class="form-group row"><label class="col-md-4">Act :</label><div class="col-md-6">'+due_act_val+'</div></div></div>';
        }

        if(due_date_for!="")
        {
            filterLabels+='<div class="col-md-4"><div class="form-group row"><label class="col-md-4">Due Date For :</label><div class="col-md-6">'+due_date_for_val+'</div></div></div>';
        }

        if(applicable_form!="")
        {
            filterLabels+='<div class="col-md-4"><div class="form-group row"><label class="col-md-4">Applicable Form :</label><div class="col-md-6">'+applicable_form_val+'</div></div></div>';
        }

        if(under_section!="")
        {
            filterLabels+='<div class="col-md-4"><div class="form-group row"><label class="col-md-4">Under Section :</label><div class="col-md-6">'+under_section_val+'</div></div></div>';
        }

        if(periodicity!="")
        {
            filterLabels+='<div class="col-md-4"><div class="form-group row"><label class="col-md-4">Periodicity :</label><div class="col-md-6">'+periodicity_val+'</div></div></div>';

            filterLabels+='<div class="col-md-8"><div class="form-group row"><label class="col-md-2">Periodicity :</label><div class="col-md-8">';

            if(periodicity==1)
            {
                if(period_daily_val!="")
                {
                    filterLabels+=periodicity_val;
                }
            }
            else if(periodicity==2)
            {
                filterLabels+='<div class="form-group row">';

                if(period_year!="")
                {
                    filterLabels+='<div class="col-md-3">'+period_month_val+'</div>';
                }

                if(period_year!="")
                {
                    filterLabels+='<div class="col-md-3">'+period_year_val+'</div>';
                }

                filterLabels+='</div>';
            }
            else
            {
                filterLabels+='<div class="form-group row">';

                if(f_period_month!="")
                {
                    filterLabels+='<div class="col-md-3">'+f_period_month_val+'</div>';
                }

                if(f_period_year!="")
                {
                    filterLabels+='<div class="col-md-3">'+f_period_year_val+'</div>';
                }

                if(t_period_month!="")
                {
                    filterLabels+='<div class="col-md-3">'+t_period_month_val+'</div>';
                }

                if(t_period_year!="")
                {
                    filterLabels+='<div class="col-md-3">'+t_period_year_val+'</div>';
                }

                filterLabels+='</div>';
            }

            filterLabels+='</div></div></div>';
        }

        // filterLabels+='</div>';

        $('#filterLabels').html(filterLabels);
    }

    $(document).ready(function(){
        
        var due_date_for_value = "<?php echo set_value('due_date_for', $taxCalDDFAdminCookie); ?>";
        // var tax_payer_value = "<?php //echo set_value('tax_payer', $dueDatesArr['tax_payer']); ?>";
        var under_section_value = "<?php echo set_value('under_section', $taxCalSectionAdminCookie); ?>";
        // var audit_value = "<?php //echo set_value('audit', $dueDatesArr['audit']); ?>";
        var applicable_form_value = "<?php echo set_value('applicable_form', $taxCalFormAdminCookie); ?>";

        $('#period_div').hide();
        $('#daily_div').hide();
        $('#monthly_div').hide();
        $('#range_div').hide();
        // $('#audit_div').hide();

        // $('#audit_app').on('change', function(){

        //     var audit_app_val = $(this).val();

        //     if(audit_app_val==1)
        //         $('#audit_div').show();
        //     else if(audit_app_val==2)
        //         $('#audit_div').hide();
        // });

        $('#periodicity').on('change', function(){

            var periodicity = $(this).val();

            $('#period_div').hide();
            $('#daily_div').hide();
            $('#monthly_div').hide();
            $('#range_div').hide();

            if(periodicity!="")
            {
                $('#period_div').show();
                if(periodicity==1)
                {
                    $('#daily_div').show();
                }
                else if(periodicity==2)
                {
                    $('#monthly_div').show();
                }
                else
                {
                    $('#range_div').show();
                }

                setLabels();
            }
        });

        $('#due_act').on('change', function(){

            var due_act = $(this).val();

            $('#under_section_div').show();
            // $('#audit_app_div').show();
            // $('#audit_div').show();
            $('#applicable_form_div').show();

            if(due_act!="")
            {
                if(due_act=="2")
                {
                    // $('#audit_app_div').hide();
                    // $('#audit_div').hide();
                }
                else if(due_act=="3")
                {
                    // $('#audit_app_div').hide();
                    // $('#audit_div').hide();
                }
                else if(due_act=="5")
                {
                    $('#under_section_div').hide();
                    $('#applicable_form_div').hide();
                }
                else if(due_act=="6")
                {
                    $('#under_section_div').hide();
                }
                else if(due_act=="7")
                {
                    $('#under_section_div').hide();
                    // $('#audit_app_div').hide();
                    // $('#audit_div').hide();
                }
                else if(due_act=="8")
                {
                    $('#under_section_div').hide();
                }

                var base_url = "<?php echo base_url(); ?>";

                $.ajax({
                    url : base_url+'/getOptions',
                    type : 'POST',
                    data : { 
                        'due_act' : due_act,
                        'option_type' : 1,
                        'set_value' : due_date_for_value,
                        "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                    },
                    dataType: 'html',
                    success : function(data) {

                        $('#due_date_for').html(data);

                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });

                $.ajax({
                    url : base_url+'/getOptions',
                    type : 'POST',
                    data : { 
                        'due_act' : due_act,
                        'option_type' : 3,
                        'set_value' : under_section_value,
                        "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                    },
                    dataType: 'html',
                    success : function(data) {

                        $('#under_section').html(data);

                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });

                $.ajax({
                    url : base_url+'/getOptions',
                    type : 'POST',
                    data : { 
                        'due_act' : due_act,
                        'option_type' : 5,
                        'set_value' : applicable_form_value,
                        "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                    },
                    dataType: 'html',
                    success : function(data) {

                        $('#applicable_form').html(data);

                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });

                setLabels();
            }
        });
        
        $('#due_act').trigger('change');
        $('#periodicity').trigger('change');
        
        $('#due_act_sel').on('change', function(){
            
            var base_url="<?php echo base_url(); ?>";
            
            var due_act_sel = $(this).val();
            
            window.location.href=base_url+"/tax_calendar?due_act_sel="+due_act_sel;
        });
        
        setTimeout(function(){
            setLabels();
        }, 500);

    });

</script>


<?= $this->endSection(); ?>