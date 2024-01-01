<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default mt-40">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">Edit Due Date</h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('superadmin/due_dates'); ?>" >
                            <button type="button" class="btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo base_url('superadmin/update_due_date'); ?>" method="post" enctype="multipart/form-data">
                        <section>
                            <div class="form-group row" id="due_state_div">
                                <label class="col-md-3" for="due_state">State:</label>
                                <div class="col-md-4">
                                    <select class="custom-select form-control" id="due_state" name="due_state">
                                        <option value="">Select State </option>
                                        <?php if(!empty($stateList)): ?>
                                            <?php foreach($stateList AS $e_state): ?>
                                                <option value="<?php echo $e_state['stateId']; ?>" <?= set_select('due_state', $e_state['stateId'], $e_state['stateId']==$dueDatesArr['due_state'] ? TRUE:FALSE) ?>><?php echo $e_state['stateName']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row" id="due_act_div">
                                <label class="col-md-3" for="due_act">Act:</label>
                                <div class="col-md-4">
                                    <select class="custom-select form-control" id="due_act" name="due_act">
                                        <option value="">Select Act</option>
                                        <?php if(!empty($actArr)): ?>
                                            <?php foreach($actArr AS $e_act): ?>
                                                <option value="<?php echo $e_act['act_id']; ?>" <?= set_select('due_act', $e_act['act_id'], $e_act['act_id']==$dueDatesArr['due_act'] ? TRUE:FALSE) ?>><?php echo $e_act['act_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row" id="due_date_for_div">
                                <label class="col-md-3" for="due_date_for">Due Date For:</label>
                                <div class="col-md-4">
                                    <select class="custom-select form-control" id="due_date_for" name="due_date_for">
                                        <option value="">Select Due Date For</option>
                                    </select>
                                </div>
                            </div>  
                            <!--<div class="form-group row" id="tax_payer_div">-->
                            <!--    <label class="col-md-3" for="tax_payer">Tax Payer:</label>-->
                            <!--    <div class="col-md-4">-->
                            <!--        <select class="custom-select form-control" id="tax_payer" name="tax_payer">-->
                            <!--            <option value="">Select Tax Payer</option>-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>  -->
                            <div class="form-group row" id="tax_payer_div">
                                <label class="col-md-3">Tax Payer :</label>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="demo-checkbox mb-20">
                                                <div class="row">
                                                    <?php if(!empty($organisationTypes)): ?>
                                                        <?php foreach($organisationTypes AS $e_org): ?>
                                                            <div class="col-md-3">
                                                                <input type="checkbox" name='tax_payer_id[]' id="tax_payer_id_<?php echo $e_org['organisation_type_id']; ?>" class="filled-in acts_checkbox" value="<?php echo $e_org['organisation_type_id']; ?>" <?php if(in_array($e_org['organisation_type_id'], $taxPayerIDArr)): ?>checked<?php endif; ?> />
                                                                <label for="tax_payer_id_<?php echo $e_org['organisation_type_id']; ?>" ><?php echo $e_org['organisation_type_name']; ?></label>	
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name='is_all_tax_payer' id="is_all_tax_payer" class="filled-in acts_checkbox" value="1" />
                                                        <label for="is_all_tax_payer" >All Assessees</label>	
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="applicable_form_div">
                                <label class="col-md-3" for="applicable_form">Applicable Form:</label>
                                <div class="col-md-4">
                                    <select class="custom-select form-control" id="applicable_form" name="applicable_form">
                                        <option value="">Select Applicable Form</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row" id="under_section_div">
                                <label class="col-md-3" for="under_section">Under Section:</label>
                                <div class="col-md-4">
                                    <select class="custom-select form-control" id="under_section" name="under_section">
                                        <option value="">Select Under Section</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row" id="periodicity_div">
                                <label class="col-md-3" for="periodicity">Periodicity:</label>
                                <div class="col-md-4">
                                    <select class="custom-select form-control" id="periodicity" name="periodicity">
                                        <option value="">Select Periodicity</option>
                                        <?php if(!empty($periodArr)): ?>
                                            <?php foreach($periodArr AS $e_prd): ?>
                                                <option value="<?php echo $e_prd['periodicity_id']; ?>" <?= set_select('periodicity', $e_prd['periodicity_id'], $e_prd['periodicity_id']==$dueDatesArr['periodicity'] ? TRUE:FALSE) ?>><?php echo $e_prd['periodicity_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row" id="period_div">
                                <label class="col-md-3" for="period_label">Period:</label>
                                <div class="col-md-4">
                                    <div id="daily_div">
                                        <input type="date" name="daily_date" id="period_daily" value="<?php echo $dueDatesArr['daily_date']; ?>">
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
                                                        <option value="<?php echo $m; ?>" <?php if($m==$dueDatesArr['period_month']): ?>selected<?php endif; ?>><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="custom-select form-control" id="period_year" name="period_year">
                                                    <option value="">Select Year</option>
                                                    <?php for($y=(date('Y')+2);$y>=2011;$y--): ?>
                                                        <option value="<?php echo $y; ?>" <?php if($y==$dueDatesArr['period_year']): ?>selected<?php endif; ?>><?php echo $y; ?></option>
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
                                                            <option value="<?php echo $m; ?>" <?php if($m==$dueDatesArr['f_period_month']): ?>selected<?php endif; ?>><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mt-20">
                                                    <select class="custom-select form-control" id="f_period_year" name="f_period_year">
                                                        <option value="">Select Year</option>
                                                        <?php for($y=(date('Y')+2);$y>=2011;$y--): ?>
                                                            <option value="<?php echo $y; ?>" <?php if($y==$dueDatesArr['f_period_year']): ?>selected<?php endif; ?>><?php echo $y; ?></option>
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
                                                            <option value="<?php echo $m; ?>" <?php if($m==$dueDatesArr['t_period_month']): ?>selected<?php endif; ?>><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mt-20">
                                                    <select class="custom-select form-control" id="t_period_year" name="t_period_year">
                                                        <option value="">Select Year</option>
                                                        <?php for($y=(date('Y')+2);$y>=2011;$y--): ?>
                                                            <option value="<?php echo $y; ?>" <?php if($y==$dueDatesArr['t_period_year']): ?>selected<?php endif; ?>><?php echo $y; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Financial Year:</label>
                                <div class="col-md-4">
                                    <select class="custom-select form-control" id="finYear" name="finYear">
                                        <option value="">Select Financial Year</option>
                                        <?php for($d=(date('Y')+2); $d>=2011; $d--): ?>
                                            <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                            <option value="<?php echo $dueYr; ?>" <?php echo set_select('finYear', $dueYr, $dueYr==$dueDatesArr['finYear'] ? TRUE:FALSE); ?> ><?php echo $dueYr; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row" id="audit_app_div">
                                <label class="col-md-3" for="audit_app">Audit Applicable:</label>
                                <div class="col-md-4">
                                    <select class="custom-select form-control" id="audit_app" name="audit_app">
                                        <option value="">Select Audit Applicable</option>
                                        <option value="1" <?php if($dueDatesArr['audit_app']=="1"): ?>selected<?php endif; ?>>Yes</option>
                                        <option value="2" <?php if($dueDatesArr['audit_app']=="2"): ?>selected<?php endif; ?>>No</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row" id="audit_div">
                                <label class="col-md-3" for="audit">Audit:</label>
                                <div class="col-md-4">
                                    <select class="custom-select form-control" id="audit" name="audit">
                                        <option value="">Select Audit</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row" id="condition_div">
                                <label class="col-md-3" for="condition">Condition:</label>
                                <div class="col-md-4">
                                    <select class="custom-select form-control" id="condition" name="condition">
                                        <option value="0">No Condition</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-md-3">Type of Organisation :</label>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="demo-checkbox mb-20">
                                                <div class="row">
                                                    <?php if(!empty($organisationTypes)): ?>
                                                        <?php foreach($organisationTypes AS $e_org): ?>
                                                            <div class="col-md-3">
                                                                <input type="checkbox" name='orgTypes[]' id="orgTypes<?php echo $e_org['organisation_type_id']; ?>" class="filled-in acts_checkbox" value="<?php echo $e_org['organisation_type_id']; ?>" <?php if(in_array($e_org['organisation_type_id'], $orgTypesArr)): ?>checked<?php endif; ?>/>
                                                                <label for="orgTypes<?php echo $e_org['organisation_type_id']; ?>" ><?php echo $e_org['organisation_type_name']; ?></label>	
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3">Due Date:</label>
                                <div class="col-md-4">
                                    <input type="date" name="due_date" id="due_date" value="<?php echo $dueDatesArr['due_date']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <?php $old_doc_file = $dueDatesArr['doc_file']; ?>
                                <label class="col-md-3">Document : <small class="text-danger">(Only pdf is accepted)</small></label>
                                <div class="col-md-4">
                                    <input type="file" name="edit_doc_file" id="edit_doc_file">
                                </div>
                                <?php if(!empty($old_doc_file)): ?>
                                    <div class="col-md-2">
                                        <?php $uploadFilePath = base_url("uploads/admin/due_date/".$old_doc_file); ?>
                                        <a href="<?= $uploadFilePath; ?>" target="_blank">
                                            <button type="button" class="waves-effect waves-light btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="View">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                        &nbsp;
                                        <a href="javascript:void(0);" class="deleteUploadedFile">
                                            <button type="button" class="waves-effect waves-light btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>   
                            <div class="form-group row">
                                <label class="col-md-3">Notes:</label>
                                <div class="col-md-9">
                                    <?php $due_notes_data = htmlspecialchars_decode(html_entity_decode($dueDatesArr['due_notes'])) ?>
                                    <textarea name="due_notes" id="due_notes" class="form-control textarea" rows="20" placeholder="Enter Notes" style="height: 700px;"><?= $due_notes_data; ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-group text-right">
                                        <input type="hidden" name="due_date_id" id="due_date_id" value="<?php echo $due_date_id; ?>">
                                        <input type="hidden" name="old_doc_file" value="<?php echo $old_doc_file; ?>">
                                        <input type="hidden" name="due_notes_content" id="due_notes_content" value="<?= $due_notes_data; ?>">
                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                        <a href="<?php echo base_url('superadmin/due_dates'); ?>" >
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

<script>
    
    function isEmptyContent(content) {
        // Remove all HTML tags and check if the remaining text is empty
        var text = content.replace(/<[^>]*>/g, "").trim();
        return text === '';
    }
        
    $(document).ready(function(){
        
        $('body').on('keyup', '.textarea', function() {
            var due_notes_content = (!isEmptyContent($(this).html())) ? $(this).html() : "";
            console.log('due_notes_content', due_notes_content);
            $('#due_notes_content').val(due_notes_content);
        });
        
        var due_date_for_value = "<?php echo set_value('due_date_for', $dueDatesArr['due_date_for']); ?>";
        var tax_payer_value = "<?php echo set_value('tax_payer', $dueDatesArr['tax_payer']); ?>";
        var under_section_value = "<?php echo set_value('under_section', $dueDatesArr['under_section']); ?>";
        var audit_value = "<?php echo set_value('audit', $dueDatesArr['audit']); ?>";
        var applicable_form_value = "<?php echo set_value('applicable_form', $dueDatesArr['applicable_form']); ?>";
        var condition_value = "<?php echo set_value('condition', $dueDatesArr['condtn']); ?>";

        $('#daily_div').hide();
        $('#monthly_div').hide();
        $('#range_div').hide();
        $('#audit_div').hide();

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

            $('#daily_div').hide();
            $('#monthly_div').hide();
            $('#range_div').hide();

            if(periodicity!="")
            {
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

                // $.ajax({
                //     url : base_url+'/getOptions',
                //     type : 'POST',
                //     data : { 
                //         'due_act' : due_act,
                //         'option_type' : 2,
                //         'set_value' : tax_payer_value,
                //         "<?//= csrf_token() ?>" : "<?//= csrf_hash() ?>"
                //     },
                //     dataType: 'html',
                //     success : function(data) {

                //         $('#tax_payer').html(data);

                //     },
                //     error : function(request, error)
                //     {
                //         // alert("Request: "+JSON.stringify(request));
                //     }
                // });

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
                        'option_type' : 4,
                        'set_value' : audit_value,
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
                
                $.ajax({
                    url : base_url+'/getOptions',
                    type : 'POST',
                    data : { 
                        'due_act' : due_act,
                        'option_type' : 6,
                        'set_value' : condition_value,
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
        
        $('#due_act').trigger('change');
        $('#audit_app').trigger('change');
        $('#condition').trigger('change');
        $('#periodicity').trigger('change');

    });

</script>

<script type="text/javascript">

	$(document).ready(function(){
		$("#is_all_tax_payer").click(function () {
			$('input[name="tax_payer_id[]"]:checkbox').not(this).prop('checked', this.checked);
		});
		
		var is_all_tax_payer = "<?= $dueDatesArr['is_all_tax_payer']; ?>";
		
		if(is_all_tax_payer==1)
		{
		    $("#is_all_tax_payer").trigger('click');
		}
		
		$('body').on('click', '.deleteUploadedFile', function(){
            
            var base_url = "<?php echo base_url(); ?>";
            var due_date_id = $('#due_date_id').val();
            
            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this uploaded file ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/superadmin/delete-due-date-doc-file',
                        type : 'POST',
                        data : {
                            'due_date_id':due_date_id
                        },
                        dataType: 'html',
                        success : function(response) {
                            
                            window.location.reload();

                        },
                        error : function(request, error)
                        {
                            alert("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });
            
        });
		
	});
	
</script>

<?= $this->endSection(); ?>