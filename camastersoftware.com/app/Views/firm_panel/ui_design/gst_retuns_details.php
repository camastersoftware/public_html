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
                <div class="box-header with-border flexbox">
                    <h4 class="box-title">Master Data Client</h4>
                    <a href="<?php echo base_url('admin/inc_tax_returns'); ?>"><button type="button" class="waves-effect waves-light btn btn-dark" style="">Back</button></a>
                </div>
                <!-- /.box-header -->
                <!--<div class="box-body wizard-content">-->
                <div class="box-body">
                    <!--<form action="" class="tab-wizard wizard-circle work_data_form" type="POST">-->
                    <form action="" class="work_data_form" type="POST">
                        <!-- Step 1 -->
                        <h4>GST Returns Details</h4>
                        <section>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientName">Name of Client :</label>
                                                <input type="text" class="form-control" name="clientName" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="isDocRecvd">Document Received :</label>
                                            </div>
                                            <div class="form-group">
                                                <input name="isDocRecvd" type="radio" id="isDocRecvdYes" class="radio-col-primary is_doc_rec" value="1" checked />
                                                <label for="isDocRecvdYes">Yes</label>
                                                <input name="isDocRecvd" type="radio" id="isDocRecvdNo" class="radio-col-success is_doc_rec" value="2" checked />
                                                <label for="isDocRecvdNo">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8" id="doc_date">
                                            
                                            <div class="form-group">
                                                <label for="docRecvdDate">Document Received Date :</label>
                                                <input type="date" class="form-control" name="docRecvdDate" id="docRecvdDate" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="workDone">% Work Done :</label>
                                                <input type="number" class="form-control" name="workDone" id="workDone" value="" onkeypress="validateNum(event)" min="0" max="100"> 
                                            </div>
                                        </div>  
                                    </div> 
                                </div>
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-12 hide">
                                            <div class="col-md-12" id="junior_clone">
                                                <div class="row jnr_div">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <select class="custom-select form-control juniorId" name="juniorId[]" >
                                                                <option value="">Select Staff</option>
                                                                <option value="" data-id="">Staff Name</option>    
                                                            </select> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="waves-effect waves-light btn btn-danger btn-sm text-right  del_jnr" >Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <!--<label>Junior Allocation:</label>-->
                                                <label>Preparatory:</label>
                                                <select class="custom-select form-control juniorId" name="juniorId[]" >
                                                    <option value="">Select Staff</option>             
                                                          
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" name="Add" class="waves-effect waves-light btn btn-submit text-right mt-20 add_jnr" >Add Staff </button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row form-group junior_div">
                                               
                                                        <div class="col-md-12">
                                                            <div class="row jnr_div">
                                                                <div class="col-md-2">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <select class="custom-select form-control juniorId" name="juniorId[]" >
                                                                            <option value="">Select Staff</option>
                                                                           
                                                                                       
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" class="waves-effect waves-light btn btn-danger text-right btn-sm del_jnr" >Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="seniorId">Finalization/Verification:</label>
                                                <select class="custom-select form-control" name="seniorId" id="seniorId" >
                                                    <option value="">Select Staff</option>
                                                   
                                                              
                                                           
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="isUrgentWork">Urgent Work :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" name="isUrgentWork" id="isUrgentWorkYes" class="radio-col-primary" value="1" />
                                                <label for="isUrgentWorkYes">Yes</label>
                                                <input type="radio" name="isUrgentWork" id="isUrgentWorkNo" class="radio-col-success" value="2" />
                                                <label for="isUrgentWorkNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Step 2 -->
                        <h4> Work Completion</h4>
                        <section>
                            <hr>
                            <div class="row">
                                <hr>
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-8" id="">
                                            <div class="form-group">
                                               
                                                <label for="eFillingDate">E-Filling Date :</label>
                                                <input type="date" class="form-control" name="eFillingDate" id="eFillingDate" value="" > 
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="isDefectiveReturn">Defective Return :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" name="isDefectiveReturn" id="isDefectiveReturnYes" class="radio-col-primary" value="1"  />
                                                <label for="isDefectiveReturnYes">Yes</label>
                                                <input type="radio" name="isDefectiveReturn" id="isDefectiveReturnNo" class="radio-col-success" value="2"  />
                                                <label for="isDefectiveReturnNo">No</label>
                                            </div>
                                        </div> -->
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="refundDue">Set Prepare By :</label>
                                                <input type="text" class="form-control" name="refundDue" id="refundDue" value="">
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                
                                <div class="col-md-6 mt-30">
                                    <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="acknowledgmentNo">Acknowledgment No :</label>
                                                <input type="text" class="form-control" name="acknowledgmentNo" id="acknowledgmentNo"  value="">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Comment</label>
                                                <textarea rows="5" class="form-control" name="defectiveReturnComment" placeholder="Enter Comment"></textarea>
                                            </div>
                                        </div>
                                    <!-- <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="verificationDoneBy">Verification Done By :</label>
                                                <input type="text" class="form-control" name="verificationDoneBy" id="verificationDoneBy" value="">
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8" id="">
                                            <div class="form-group">
                                                
                                                <label for="verificationDate">Verification Date :</label>
                                                <input type="date" class="form-control" name="verificationDate" id="verificationDate" value=""> 
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8 dect_return">
                                            <div class="form-group">
                                                <label for="isDefectiveRectified">Defective Rectified :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" name="isDefectiveRectified" id="isDefectiveRectifiedYes" class="radio-col-primary def_rect" value="1" checked />
                                                <label for="isDefectiveRectifiedYes">Yes</label>
                                                <input type="radio" name="isDefectiveRectified" id="isDefectiveRectifiedNo" class="radio-col-success def_rect" value="2" checked />
                                                <label for="isDefectiveRectifiedNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8 dect_return">
                                            <div class="form-group" id="defectiveRectifiedCommentDiv">
                                                <label>Comment</label>
                                                <textarea rows="5" class="form-control" name="defectiveRectifiedComment" placeholder="Enter Comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <hr>
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-3" id="">
                                            <div class="form-group">
                                                <label for="turnOver">Sales / Turn over :</label>
                                                <select class="form-control">
                                                    <option>Interested in</option>
                                                    <option>design</option>
                                                    <option>development</option>
                                                    <option>illustration</option>
                                                    <option>branding</option>
                                                    <option>video</option>
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">Amount :</label>
                                                <input type="text" class="form-control" name="grossTotalIncome" id="grossTotalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">CGST :</label>
                                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">SGST:</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">IGST :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-1">
                                            <button type="button" name="Add" class="waves-effect waves-light btn btn-submit text-right mt-20" >Add Staff </button>
                                        </div>  
                                    </div> 
                                </div>
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-3" id="">
                                            <div class="form-group">
                                                <label for="turnOver">Total</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="grossTotalIncome" id="grossTotalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <hr>
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-3" id="">
                                            <div class="form-group">
                                                <label for="turnOver">Purchase:</label>
                                                <select class="form-control">
                                                    <option></option>
                                                    <option></option>
                                                    <option></option>
                                                    <option></option>
                                                    <option></option>
                                                    <option></option>
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">Amount :</label>
                                                <input type="text" class="form-control" name="grossTotalIncome" id="grossTotalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">CGST :</label>
                                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">SGST:</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">IGST :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-1">
                                            <button type="button" name="Add" class="waves-effect waves-light btn btn-submit text-right mt-20" >Add Staff </button>
                                        </div>  
                                    </div> 
                                </div>
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-3" id="">
                                            <div class="form-group">
                                                <label for="turnOver">Total</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="grossTotalIncome" id="grossTotalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <hr>
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-3" id="">
                                            <div class="form-group">
                                                <label for="turnOver">Reverse Charge:</label>
                                                <select class="form-control">
                                                    <option></option>
                                                    <option></option>
                                                    <option></option>
                                                    <option></option>
                                                    <option></option>
                                                    <option></option>
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">Amount :</label>
                                                <input type="text" class="form-control" name="grossTotalIncome" id="grossTotalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">CGST :</label>
                                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">SGST:</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">IGST :</label>
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-1">
                                            <button type="button" name="Add" class="waves-effect waves-light btn btn-submit text-right mt-20" >Add Staff </button>
                                        </div>  
                                    </div> 
                                </div>
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-3" id="">
                                            <div class="form-group">
                                                <label for="turnOver">Total</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="grossTotalIncome" id="grossTotalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="totalIncome" id="totalIncome" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="selfAssessmentTax" id="selfAssessmentTax" value="">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
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