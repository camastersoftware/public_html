<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .sec_heading{
        background:#F99D27;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }

    .card_bg_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 0px !important;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }
    
    .form_bg_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px !important;
        border: 1px solid #8c8c8cab !important;
        background: #fdfeff !important;
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default mt-40">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('superadmin/due_dates'); ?>" >
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body card_bg_format">
                    <form action="<?php echo base_url('superadmin/insert_due_date'); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 mt-3">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="state sec_heading">
                                                            <h4 class="text-white font-weight-bold m-0"><?= $pageTitle; ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="due_act">Act:</label>
                                                                    <select class="custom-select form-control" id="due_act" name="due_act">
                                                                        <option value="">Select Act</option>
                                                                        <?php if(!empty($actArr)): ?>
                                                                            <?php foreach($actArr AS $e_act): ?>
                                                                                <option value="<?php echo $e_act['act_id']; ?>" <?= set_select('due_act', $e_act['act_id']) ?>><?php echo $e_act['act_name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="due_date_for">Due Date For:</label>
                                                                    <select class="custom-select form-control" id="due_date_for" name="due_date_for">
                                                                        <option value="">Select Due Date For</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label for="due_date_for">Tax Payer :</label>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="demo-checkbox mb-20">
                                                                                    <div class="row">
                                                                                        <?php if(!empty($organisationTypes)): ?>
                                                                                            <?php foreach($organisationTypes AS $e_org): ?>
                                                                                                <div class="col-md-3">
                                                                                                    <input type="checkbox" name='tax_payer_id[]' id="tax_payer_id_<?php echo $e_org['organisation_type_id']; ?>" class="filled-in acts_checkbox" value="<?php echo $e_org['organisation_type_id']; ?>"/>
                                                                                                    <label for="tax_payer_id_<?php echo $e_org['organisation_type_id']; ?>" ><?php echo $e_org['organisation_type_name']; ?></label>	
                                                                                                </div>
                                                                                            <?php endforeach; ?>
                                                                                        <?php endif; ?>
                                                                                        <div class="col-md-3">
                                                                                            <input type="checkbox" name='is_all_tax_payer' id="is_all_tax_payer" class="filled-in acts_checkbox" value="1"/>
                                                                                            <label for="is_all_tax_payer" >All Assessees</label>	
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="due_date_for">Applicable Form:</label>
                                                                    <select class="custom-select form-control" id="applicable_form" name="applicable_form">
                                                                        <option value="">Select Applicable Form</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="under_section">Under Section:</label>
                                                                    <select class="custom-select form-control" id="under_section" name="under_section">
                                                                        <option value="">Select Under Section</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="periodicity">Periodicity:</label>
                                                                    <select class="custom-select form-control" id="periodicity" name="periodicity">
                                                                        <option value="">Select Periodicity</option>
                                                                        <?php if(!empty($periodArr)): ?>
                                                                            <?php foreach($periodArr AS $e_prd): ?>
                                                                                <option value="<?php echo $e_prd['periodicity_id']; ?>" <?= set_select('periodicity', $e_prd['periodicity_id']) ?>><?php echo $e_prd['periodicity_name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="period_div">
                                                                <div class="form-group">
                                                                    <label for="period_label">Period:</label>
                                                                    <div id="daily_div">
                                                                        <input type="date" name="daily_date" id="period_daily">
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
                                                                                    ?>
                                                                                        <option value="<?php echo $m; ?>"><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <select class="custom-select form-control" id="period_year" name="period_year">
                                                                                    <option value="">Select Year</option>
                                                                                    <?php for($y=(date('Y')+2);$y>=2011;$y--): ?>
                                                                                        <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
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
                                                                                            ?>
                                                                                            <option value="<?php echo $m; ?>"><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                                                        <?php endfor; ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="form-group mt-20">
                                                                                    <select class="custom-select form-control" id="f_period_year" name="f_period_year">
                                                                                        <option value="">Select Year</option>
                                                                                        <?php for($y=(date('Y')+2);$y>=2011;$y--): ?>
                                                                                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
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
                                                                                            ?>
                                                                                            <option value="<?php echo $m; ?>"><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                                                        <?php endfor; ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="form-group mt-20">
                                                                                    <select class="custom-select form-control" id="t_period_year" name="t_period_year">
                                                                                        <option value="">Select Year</option>
                                                                                        <?php for($y=(date('Y')+2);$y>=2011;$y--): ?>
                                                                                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                                                                        <?php endfor; ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="finYear">Financial Year:</label>
                                                                    <select class="custom-select form-control" id="finYear" name="finYear">
                                                                        <option value="">Select Financial Year</option>
                                                                        <?php for($d=(date('Y')+2); $d>=2011; $d--): ?>
                                                                            <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                                                            <option value="<?php echo $dueYr; ?>" <?php echo set_select('finYear', $dueYr); ?> ><?php echo $dueYr; ?></option>
                                                                        <?php endfor; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="audit_app">Audit Applicable:</label>
                                                                    <select class="custom-select form-control" id="audit_app" name="audit_app">
                                                                        <option value="">Select Audit Applicable</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="2" selected>No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="audit_div">
                                                                <div class="form-group">
                                                                    <label for="audit">Audit:</label>
                                                                    <select class="custom-select form-control" id="audit" name="audit">
                                                                        <option value="">Select Audit</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="due_date">Due Date:</label><br>
                                                                    <input type="date" name="due_date" id="due_date">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="doc_file">Document : <small class="text-danger">(Only pdf is accepted)</small></label><br>
                                                                    <input type="file" name="doc_file" id="doc_file">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="due_notes">Notes:</label>
                                                                    <div id="ckeditor_textarea"></div>
                                                                    <textarea name="due_notes" id="due_notes" class="form-control textarea_input hide" rows="20" placeholder="Enter Notes"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mt-30 text-center">
                                                                <input type="hidden" name="due_state" value="12" />
                                                                <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                                                <a href="<?php echo base_url('superadmin/due_dates'); ?>" >
                                                                    <button type="button" class="btn btn-dark">Back</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<script>

    $(document).ready(function(){
        
        $('#period_div').hide();
        $('#daily_div').hide();
        $('#monthly_div').hide();
        $('#range_div').hide();
        $('#audit_div').hide();
        $('#orgTypesDiv').hide();

        $('#audit_app').on('change', function(){

            var audit_app_val = $(this).val();

            if(audit_app_val==1)
                $('#audit_div').show();
            else if(audit_app_val==2)
                $('#audit_div').hide();
        });
        
        $('#condition').on('change', function(){

            var condition_val = $(this).val();

            if(condition_val==0)
                $('#orgTypesDiv').hide();
            else
                $('#orgTypesDiv').show();
        });

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
            }

        });

        $('#due_act').on('change', function(){

            var due_act = $(this).val();

            $('#under_section_div').show();
            $('#audit_app_div').show();
            $('#audit_div').show();
            $('#applicable_form_div').show();

            if(due_act!="")
            {
                if(due_act=="2")
                {
                    $('#audit_app_div').hide();
                    $('#audit_div').hide();
                }
                else if(due_act=="3")
                {
                    $('#audit_app_div').hide();
                    $('#audit_div').hide();
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
                    $('#audit_app_div').hide();
                    $('#audit_div').hide();
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
                        'option_type' : 4,
                        "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                    },
                    dataType: 'html',
                    success : function(data) {

                        $('#audit').html(data);

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
                
                $.ajax({
                    url : base_url+'/getOptions',
                    type : 'POST',
                    data : { 
                        'due_act' : due_act,
                        'option_type' : 6,
                        "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                    },
                    dataType: 'html',
                    success : function(data) {

                        $('#condition').html(data);

                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });
            }
        });

    });

</script>

<script type="text/javascript">

	$(document).ready(function(){
		$("#is_all_tax_payer").click(function () {
			$('input[name="tax_payer_id[]"]:checkbox').not(this).prop('checked', this.checked);
		});
	});
	
</script>

<?= $this->endSection(); ?>