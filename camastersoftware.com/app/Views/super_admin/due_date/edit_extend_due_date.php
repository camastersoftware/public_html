<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default mt-40">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">Extend Due Date</h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('due_dates'); ?>" >
                            <button type="button" class="btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo base_url('update_extend_due_date'); ?>" method="post" >
                        <section>
                            <div class="form-group row" id="due_act_div">
                                <label class="col-md-3 font-weight-bold" for="due_act">Act:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['act_name']))
                                            echo $dueDatesArr['act_name']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="due_state_div">
                                <label class="col-md-3 font-weight-bold" for="due_state">State:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['stateName']))
                                            echo $dueDatesArr['stateName']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="due_date_for_div">
                                <label class="col-md-3 font-weight-bold" for="due_date_for">Due Date For:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['due_date_for_name']))
                                            echo $dueDatesArr['due_date_for_name']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="tax_payer_div">
                                <label class="col-md-3 font-weight-bold" for="tax_payer">Tax Payer:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['tax_payers']))
                                            echo $dueDatesArr['tax_payers']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="under_section_div">
                                <label class="col-md-3" for="under_section">Under Section:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['under_section_name']))
                                            echo $dueDatesArr['under_section_name']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="audit_app_div">
                                <label class="col-md-3" for="audit_app">Audit Applicable:</label>
                                <label class="col-md-4">
                                    <?php 
                                        if($dueDatesArr['audit_app']==1)
                                            echo "Yes"; 
                                        else
                                            echo "No";
                                    ?>
                                </label>
                            </div>  
                            <?php if($dueDatesArr['audit_app']==1): ?>
                            <div class="form-group row" id="audit_div">
                                <label class="col-md-3" for="audit">Audit:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['audit_name']))
                                            echo $dueDatesArr['audit_name']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>
                            <?php endif; ?>  
                            <div class="form-group row" id="applicable_form_div">
                                <label class="col-md-3" for="applicable_form">Applicable Form:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['applicable_form_name']))
                                            echo $dueDatesArr['applicable_form_name']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="periodicity_div">
                                <label class="col-md-3" for="periodicity">Periodicity:</label>
                                <label class="col-md-4"><?php echo $dueDatesArr['periodicity_name']; ?></label>
                            </div>  
                            <div class="form-group row" id="period_div">
                                <label class="col-md-3" for="period_label">Period:</label>
                                <label class="col-md-4">
                                    <?php 
                                        if($dueDatesArr['periodicity']=="1")
                                        {
                                            if(check_valid_date($dueDatesArr["daily_date"]))
                                                echo date("d-M-Y", strtotime($dueDatesArr["daily_date"]));
                                        }
                                        elseif($dueDatesArr['periodicity']=="2")
                                        {
                                            echo date("M", strtotime("2021-".$dueDatesArr["period_month"]."-01"))."-".$dueDatesArr["period_year"];
                                        }
                                        elseif($dueDatesArr['periodicity']>="3")
                                        {
                                            echo date("M", strtotime("2021-".$dueDatesArr["f_period_month"]."-01"))."-".$dueDatesArr["f_period_year"]." - ".date("M", strtotime("2021-".$dueDatesArr["t_period_month"]."-01"))."-".$dueDatesArr["t_period_year"];
                                        }
                                        else
                                        {
                                            echo "N/A";
                                        }
                                    ?>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Financial Year:</label>
                                <label class="col-md-4"><?php echo $dueDatesArr['finYear']; ?></label>
                            </div>   
                            <div class="form-group row">
                                <label class="col-md-3">Due Date:</label>
                                <label class="col-md-4"><?php echo date("d-M-Y", strtotime($dueDatesArr['due_date'])); ?></label>
                            </div> 
                            <?php $e=1; ?>
                            <?php if(!empty($extDateArr)): ?>
                                <?php foreach($extDateArr AS $e_ext): ?>
                                    <div class="form-group row">
                                        <label class="col-md-3">Due Date <?php echo $e; ?>:</label>
                                        <label class="col-md-4">
                                            <?php echo date("d-M-Y", strtotime($e_ext['extended_date'])); ?>
                                        </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3">Note for Due Date <?php echo $e; ?>:</label>
                                        <label class="col-md-4">
                                            <?php 
                                                if(!empty($e_ext['extended_date_notes']))
                                                    echo $e_ext['extended_date_notes']; 
                                                else
                                                    echo "N/A";
                                            ?>
                                        </label>
                                    </div>
                                    <?php $e++; ?> 
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-group row">
                                <label class="col-md-3">New Extended Due Date:</label>
                                <div class="col-md-4">
                                    <input type="date" name="ext_due_date" id="ext_due_date">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3">Notes:</label>
                                <div class="col-md-4">
                                    <textarea name="due_notes" id="due_notes" class="form-control" rows="4" placeholder="Enter Notes"></textarea>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-group text-right">
                                        <input type="hidden" name="due_date_id" value="<?php echo $due_date_id; ?>">
                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                        <a href="<?php echo base_url('due_dates'); ?>" >
                                            <button type="button" class="btn btn-dark">Back</button>
                                        </a>
                                    </div>
                                </div>
                            </div>  
                        </section>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<?= $this->endSection(); ?>