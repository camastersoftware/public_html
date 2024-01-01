
<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<?php

$isFilter=FALSE;

if(!empty($taxCalStateAdminCookie) || !empty($taxCalFinYearAdminCookie))
	$isFilter=TRUE;
	
?>
    <!-- Main content -->
    <section class="content mt-40">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?=base_url('admin/search_tax_calendar')?>" method="post" >
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="state form-group row ml-100">
                                        <label class="col-sm-3 col-form-label">State :</label>
                                        <div class="col-sm-9">
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
                                                    <?php for($d=2021; $d>=2011; $d--): ?>
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
                                                    <option value="">Select Due Date Year</option>
                                                    <?php for($d=2021; $d>=2011; $d--): ?>
                                                        <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                                        <option value="<?php echo $dueYr; ?>" <?php echo set_select('finYear', $dueYr, $taxCalFinYearAdminCookie==$dueYr); ?> ><?php echo $dueYr; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-10">
                                <div class="col-md-5">
                                    <div class="demo-radio-button">
                                        <input name="calenderType" type="radio" id="radio_30" class="with-gap radio-col-primary" value="1" <?php if($taxCalTypeAdminCookie=="1"): ?>checked<?php endif; ?> />
                                        <label for="radio_30">Actwise</label>	
                                        <input name="calenderType" type="radio" id="radio_32" class="with-gap radio-col-primary" value="2" <?php if($taxCalTypeAdminCookie=="2"): ?>checked<?php endif; ?> />
                                        <label for="radio_32">Datewise (Monthly)</label>
                                        <input name="calenderType" type="radio" id="radio_33" class="with-gap radio-col-primary" value="3" <?php if($taxCalTypeAdminCookie=="3"): ?>checked<?php endif; ?> />
                                        <label for="radio_33">Datewise (Full Year)</label>
                                    </div>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="col-md-2">
                                    <input type="hidden" name="type" value="1">
                                    <button type="submit" class="btn <?php if($isFilter): ?>btn-success<?php else: ?>btn-secondary<?php endif; ?>">
                                        <i class="fa fa-search"></i> Filter <?php if($isFilter): ?>On<?php else: ?>Off<?php endif; ?>
                                    </button>
                                    <a href="<?=base_url('admin/reset_tax_calendar?type=1')?>">
                                        <button type="button" class="btn btn-dark">Reset</button>
                                    </a>
                                </div>
                            </div>
                        </form>
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
                                <a class="nav-link <?php if($taxCalFinYearAdminCookie==$dueYear && $m==$currMth): ?>active<?php elseif($taxCalFinYearAdminCookie!=$dueYear && $m==4): ?>active<?php endif; ?>" id="<?php echo $mth_nm; ?>-tab" data-toggle="tab" href="#<?php echo $mth_nm; ?>_tab" role="tab" aria-controls="profile">
                                    <span class="hidden-sm-up">
                                        <i class="ion-person"></i>
                                    </span> 
                                    <span class="hidden-xs-down year-color"><?php echo date('F', strtotime("2021-".$m."-1")); ?></span>
                                </a>
                            </li>	
                            <?php endfor; ?>
                        </ul>
                        <?php endif; ?>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border p-15" id="myTabContent">
                            <?php for($mth=1;$taxCalTypeAdminCookie!="3" ? $mth<13:$mth<2;$mth++): ?>
                            <?php $mth_nm=strtolower(date('M', strtotime("2021-".$mth."-1"))); ?>

                            <?php if($taxCalTypeAdminCookie!="3"): ?>
                            <div class="tab-pane fade table-responsive <?php if($taxCalFinYearAdminCookie==$dueYear && $mth==$currMth): ?>show active<?php elseif($taxCalFinYearAdminCookie!=$dueYear && $mth==4): ?>show active<?php endif; ?>" id="<?php echo $mth_nm; ?>_tab" role="tabpanel" aria-labelledby="<?php echo $mth_nm; ?>-tab">
                            <?php endif; ?>

                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1">Due Date</th>
                                            <th class="column-2">Due Date For</th>
                                            <th class="column-7">Form</th>
                                            <!--<th class="column-3">Act</th>-->
                                            <!--<th class="column-4">Tax Payer</th>-->
                                            <th class="column-5">Section</th>
                                            <!--<th class="column-6">Audit</th>-->
                                            <th class="column-8">Periodicity</th>
                                            <th class="column-8">Financial<br/>Year</th>
                                            <th class="column-9">Period</th>
                                            <th class="column-9">Days<br/>Remaining</th>
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
                                                            <td colspan="10" class="column-1"><?php echo $e_row['act_name']; ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php $extended_date=$e_row['extended_date']; ?>
                                                <?php $extended_date_notes=$e_row['due_notes']; ?>
                                                <tr class="row-3 <?php if($e_row['is_extended']==1): ?>ext_date_row<?php endif; ?>" style="background-color:<?php if($e_row['is_extended']==2): ?>#f6fbff<?php else: ?><?php echo EXT_DUE_DATE_STYLE; ?><?php endif; ?>;">
                                                    <td class="column-1"><?php echo date('d-m-Y', strtotime($e_row['extended_date'])); ?></td>
                                                    <td class="column-2">
                                                        <?php 
                                                            if(!empty($e_row['act_option_name1']))
                                                                echo $e_row['act_option_name1']; 
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
                                                    <!--<td class="column-3"><?php //echo $e_row['act_name']; ?></td>-->
                                                    <!--<td class="column-4">-->
                                                    <?php
                                                            // if(!empty($e_row['act_option_name2']))
                                                            //     echo $e_row['act_option_name2']; 
                                                            // else
                                                            //     echo "N/A"; 
                                                    ?>
                                                    <!--</td>-->
                                                    <td class="column-5">
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
                                                    <td class="column-11 text-center">
                                                        <?php
                                                            $now = time(); // or your date as well
                                                            $your_date = strtotime($extended_date);
                                                            $datediff = $now - $your_date;
                                                            
                                                            if($your_date>$now)
                                                                echo abs(round($datediff / (60 * 60 * 24)));
                                                            else
                                                                echo "-";
                                                        ?>
                                                    </td>
                                                    <td class="column-10">
                                                        <button type="button" class="waves-effect waves-light btn btn-primary mb-5" data-toggle="modal" data-target="#modal_view<?php echo $k_row; ?>">
                                                            Note
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
                                                                        <?php if(!empty($extended_date_notes)): ?>
                                                                            <p>
                                                                                <?php echo $extended_date_notes; ?>
                                                                            </p>
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
                                                <td colspan="9"><center>No Records</center></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
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


<?= $this->endSection(); ?>