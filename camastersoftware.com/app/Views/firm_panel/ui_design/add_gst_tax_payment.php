<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .theme-primary .wizard-content .wizard > .steps > ul > li.done {
            margin-top: 15px;
            width: 297px;
    }
            
    .tablepress tbody tr:first-child td {
        background: #288651;
        color: #fff;
    } 
    
    .tablepress tbody tr:nth-child(4) td.column-1 {
        background: #fb3d3d;
        color: #fff;
    }
    
    .theme-primary .wizard-content .wizard > .steps > ul > li.current {
        margin-top: 15px;
        width: 297px;
    }

    
    .tablepress{
        width:100%;
    }
    
    .tablepress thead tr, .tablepress thead th {
        text-align: center;
        width: 10%;
    }
    
    .tablepress tbody td {
        text-align: center;
    }
    
    .tablepress td, .tablepress th {
        font-weight: 600;
    }
    
    .tablepress tbody tr:nth-child(6) td.column-1 {
        background: #fff;
    }
    
    table.dataTable {
        clear: both;
         margin-top: 0px !important; 
    }
    
    .wizard-content .wizard > .content > .body {
        padding: 0px 20px;
    }
</style>

<!-- Main content -->
<section class="content mt-40">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox text-center">
                        <h4 class="box-title font-weight-bold hdClr">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            <a href="<?php echo base_url('admin/home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right font-weight-bold" style="">Back</button>
                            </a>
                        </div>
                    </div>
                <!-- /.box-header -->
                <!--<div class="box-body wizard-content">-->
                <div class="box-body">
                    <!--<form action="" class="tab-wizard wizard-circle work_data_form" type="POST">-->
                    <form action="" class="work_data_form" type="POST">
                        <!-- Step 1 -->
                        <section>
                            <div class="row">
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientName">Group No :</label>
                                                <input type="text" class="form-control" name="clientName" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-8" id="">
                                            <div class="form-group">
                                                <label for="">Date Of Payment :</label>
                                                <input type="date" class="form-control" name="" id="" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Type Of Return :</label>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                  <option selected="selected">GSTR-3B</option>
                                                  <option>GSTR-4</option>
                                                  <option>GSTR-5</option>
                                                  <option>GSTR-5A</option>
                                                  <option>GSTR-7</option>
                                                  <option>GSTR-8</option>
                                                  <option>GSTR-9</option>
                                                  <option>GSTR-9C</option>
                                                  <option>GSTR-10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="workDone">Challan Reference No</label>
                                                <input type="type" class="form-control" name="" id="" value=""> 
                                            </div>
                                        </div> 
                                        <div class="col-md-8">
                                            <div class="form-group">
                                              <label>Mode</label>
                                              <select class="form-control">
                                                <option>Online</option>
                                                <option>NEFT/RTGS</option>
                                                <option>Cash</option>
                                              </select>
                                            </div> 
                                        </div>  
                                    </div> 
                                </div>
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Name of Party :</label>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                  <option selected="selected">Alabama</option>
                                                  <option>Alaska</option>
                                                  <option>California</option>
                                                  <option>Delaware</option>
                                                  <option>Tennessee</option>
                                                  <option>Texas</option>
                                                  <option>Washington</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8" id="">
                                            <div class="form-group">
                                                <label for="">Return Period :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-4" id="">
                                            <div class="form-group">
                                                <label for="">From</label>
                                                <input type="date" class="form-control" name="" id="" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="">
                                            <div class="form-group">
                                                <label for="">To</label>
                                                <input type="date" class="form-control" name="" id="" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Type Of Challan :</label>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                  <option selected="selected">Periodic Return Payment</option>
                                                  <option>PMT-06</option>
                                                  <option>CMP-08</option>
                                                  <option>DRC-03 VOLUNTARY</option>
                                                  <option>DRC-03 SCN</option>
                                                  <option>DRC-03 ANNUAL RETURN</option>
                                                  <option>DRC-03 RECONCILIATION RETURN</option>
                                                  <option>DRC-03 LIABILITY MISMATCH IN GSTR-1 & GSTR-3B</option>
                                                  <option>DRC-03 ITC MISMATCH IN GSTR-2B & GSTR-3B</option>
                                                  <option>DRC-03 SCRUTINY</option>
                                                  <option>DRC-03 OTHERS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Step 2 -->
                        <section>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-12" id="">
                                            <div class="form-group">
                                                <label for="turnOver">TYPE OF TAX :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">CGST</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">TAX :</label>
                                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">INTEREST:</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">PENALTY :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">FEES :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">SGST</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">TAX :</label>
                                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">INTEREST:</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">PENALTY :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">FEES :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div>  
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <hr>
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">IGST</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">TAX :</label>
                                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">INTEREST:</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">PENALTY :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">FEES :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div><hr>
                            <div class="row">
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">Total</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">TAX :</label>
                                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">INTEREST:</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">PENALTY :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">FEES :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <br>
                        
                        <div class="text-right">
                            <hr>
                            <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button>
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


<script type="text/javascript">
            
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";
        var workId = $('#workId').val();
        
        $('#doc_date').hide();
        
        $('.is_doc_rec').on('click', function(){
            
            var doc_rec = $(this).val();
            
            if(doc_rec=="1")
                $('#doc_date').show();
            else if(doc_rec=="2")
                $('#doc_date').hide();
            
        });
        
        $('input:radio[name="isDefectiveReturn"]').on('click', function(){
            
            var dect_return = $(this).val();
            
            if(dect_return=="1")
                $('.dect_return').show();
            else if(dect_return=="2")
                $('.dect_return').hide();
            
        });
        
        $('.dect_return').hide();
        $('#defectiveRectifiedCommentDiv').hide();
        
        $('.def_rect').on('click', function(){
            
            var def_rect = $(this).val();
            
            if(def_rect=="1")
                $('#defectiveRectifiedCommentDiv').show();
            else if(def_rect=="2")
                $('#defectiveRectifiedCommentDiv').hide();
            
        });

        var selectedJnrText = "";
        var selectedJnrArr = [];
        var selectedJnrIds = [];

        $('body').on('change', '.juniorId', function(){

            selectedJnrText = "";
            selectedJnrArr = [];
            selectedJnrIds = [];

            $(".juniorId option:selected").each(function(){

                if($(this).val()!="")
                {
                    // var jnrText=$(this).text();
                    var jnrText=$(this).data('id');
                    selectedJnrArr.push(jnrText);
                    selectedJnrIds.push($(this).val());
                }
                
            });
            console.log(selectedJnrArr);
            
            selectedJnrText=selectedJnrArr.join(', ');
            selectedJnrIdsText=selectedJnrIds.join(', ');

            console.log(selectedJnrText);

            $('#juniors').val(selectedJnrText);
            $('#juniorIds').val(selectedJnrIdsText);
        });

        $('.juniorId').trigger('change');

        $('.wizard-content .wizard > .actions > ul').append('<li><button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button></li>');
        
        $('.wizard-content .wizard > .actions > ul li:nth-child(3)').remove();

        // $('.wizard-content .wizard > .actions > ul li:nth-child(3)').addClass('submit_client');
    
        
        // $('body').on('click', '.steps li', function(){
            
        //     if($(this).hasClass('last'))
        //     {
        //         $('.extra_sub_btn').hide();
        //     }
        //     else
        //     {
        //         $('.extra_sub_btn').show();
        //     }
            
        // });

        $('#refundDue').on('keyup', function(){
            $('#refundDueVal').val($(this).val());
        });
        
        $('.add_jnr').on('click', function(){
            var junior_clone = $('#junior_clone').clone();
            $('.junior_div').append(junior_clone);
        });

        $('body').on('click', '.del_jnr', function(){
            $(this).parents('.jnr_div').remove();
        });
        
        $('.steps ul li:not(:first)').removeClass('disabled');
        $('.steps ul li:not(:first)').addClass('done');
        
        // $('.wizard-content .wizard > .actions').hide();
        $('.wizard-content .wizard > .actions > ul').css('margin-right', '40%');

        $('.theme-primary .wizard-content .wizard > .steps > ul > li').on('click', function(){
            $('#stepData').val($(this).find('.step').text());
        });

        // $('body').on('click', '.extra_sub_btn', function(){
        //     alert('das');
        //     $('.work_data_form').submit();
        // });

        $('body').on('submit', '.work_data_form', function(e){

            e.preventDefault();
            var workFormData = $('.work_data_form').serializeArray();

            // $('.work_data_form').submit();

            var indexed_array = {};
        
            $.map(workFormData, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            var postingUrl = base_url+'/admin/income_tax/work_form/'+workId;

            $.post(postingUrl,indexed_array, function(data, status){
                window.location.href=postingUrl;
            });

        });
        
        $('.def_rect:checked').trigger('click');
        $('.is_doc_rec:checked').trigger('click');

    });

</script>

<?= $this->endSection(); ?>