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
                        <a href="<?php echo base_url('non-regular-due-dates'); ?>" >
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body card_bg_format">
                    <form action="<?php echo base_url('insert-non-regular-due-date'); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
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
                                                                <a href="<?php echo base_url('non-regular-due-dates'); ?>" >
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

            if(due_act!="")
            {
                var base_url = "<?php echo base_url(); ?>";

                $.ajax({
                    url : base_url+'/getFirmOptions',
                    type : 'POST',
                    data : { 
                        'due_act' : due_act,
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
            }
        });

    });

</script>

<?= $this->endSection(); ?>