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
    
    .box-body {
        /*padding: 1.1rem 1.1rem;*/
        /*flex: 1 1 auto;*/
        /*border-radius: 10px;*/
        /*border: 1px solid #015aacab !important;*/
        /*background: #96c7f242 !important;*/
        /*margin-top: 20px !important;*/
    }    
    
    .bg_prjt_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }
    
    .form-group label {
        font-weight: 100 !important;
        font-size: 14px !important;
    }
</style>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/rateyo/jquery.rateyo.min.css'); ?>">
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="<?= base_url('assets/rateyo/jquery.rateyo.min.js'); ?>"></script>

    <!-- Main content -->
    <section class="content mt-35">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title font-weight-bold">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <a href="<?php echo base_url('home'); ?>"><button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo base_url('submitFeedBack'); ?>" method="POST" class="client_form">
                            <!-- Step 1 -->
                            <section>
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="row bg_prjt_format">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="text">Date :</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" name="feedbackDateView" id="feedbackDateView" placeholder="Enter Feedback Date" value="<?php echo date('Y-m-d'); ?>" required readonly> 
                                                            <input type="hidden" class="form-control" name="feedbackDate" id="feedbackDate" placeholder="Enter Feedback Date" value="<?php echo date('Y-m-d'); ?>" required> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">     
                                                        <div class="form-group">
                                                            <label for="text">Staff Name :</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="staffNameView" id="staffNameView" placeholder="Enter Staff Name" value="<?php echo $sessUserFullName; ?>" required readonly>
                                                            <input type="hidden" class="form-control" name="staffName" id="staffName" placeholder="Enter Staff Name" value="<?php echo $sessUserFullName; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">     
                                                        <div class="form-group">
                                                            <label for="text">Do you find this software useful ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input name="isUseful" type="radio" id="isUsefulYes" class="radio-col-success" value="1"  />
                                                            <label for="isUsefulYes">Yes</label>
                                                            <input name="isUseful" type="radio" id="isUsefulNo" class="radio-col-danger" value="2"  />
                                                            <label for="isUsefulNo">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">     
                                                        <div class="form-group">
                                                            <label for="text">Do you find this software Reliable ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input name="isReliable" type="radio" id="isReliableYes" class="radio-col-success" value="1"  />
                                                            <label for="isReliableYes">Yes</label>
                                                            <input name="isReliable" type="radio" id="isReliableNo" class="radio-col-danger" value="2"  />
                                                            <label for="isReliableNo">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">     
                                                        <div class="form-group">
                                                            <label for="text">Do you use it ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input name="isUse" type="radio" id="isUseReg" class="radio-col-success" value="1"  />
                                                            <label for="isUseReg">Regularly</label>
                                                            <input name="isUse" type="radio" id="isUseSmthg" class="radio-col-warning" value="2"  />
                                                            <label for="isUseSmthg">Sometimes</label>
                                                            <input name="isUse" type="radio" id="isUseNt" class="radio-col-danger" value="3"  />
                                                            <label for="isUseNt">Not using it</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 notUseReasonDiv">
                                                <div class="row">
                                                    <div class="col-md-4">   
                                                        <div class="form-group">
                                                            <label for="text">Can you tell us reason ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <textarea rows="5" class="form-control" name="notUseReason" id="notUseReason" placeholder="Enter Reason"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">   
                                                        <div class="form-group">
                                                            <label for="text">Which part of this software needs improvement ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <textarea rows="5" class="form-control" name="improvementReqd" id="improvementReqd" placeholder="Enter Something"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">   
                                                        <div class="form-group">
                                                            <label for="text">Will you recommend this software to others ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input name="recmdToOther" type="radio" id="recmdToOtherYes" class="radio-col-success" value="1"  />
                                                            <label for="recmdToOtherYes">Yes</label>
                                                            <input name="recmdToOther" type="radio" id="recmdToOtherNo" class="radio-col-danger" value="2"  />
                                                            <label for="recmdToOtherNo">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-12 recmdToOtherDiv">
                                                <div class="row">
                                                    <!--<div class="col-md-4">   -->
                                                    <!--    <div class="form-group">-->
                                                    <!--        <label for="text">If you are happy with this software, can you refer someone's name ?</label>-->
                                                    <!--    </div>-->
                                                    <!--</div>-->
                                                    <div class="col-md-12">
                                                        <div class="row form-group">
                                                            <div class="col-md-4">   
                                                                <div class="form-group">
                                                                    <label for="text">Name : </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="otherName" id="otherName" placeholder="Enter Name" >
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-4">   
                                                                <div class="form-group">
                                                                    <label for="text">Profession : </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="otherProfession" id="otherProfession" placeholder="Enter Profession" >
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-4">   
                                                                <div class="form-group">
                                                                    <label for="text">Location : </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="otherLocation" id="otherLocation" placeholder="Enter Location" >
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-4">   
                                                                <div class="form-group">
                                                                    <label for="text">Contact No : </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="otherContactNo" id="otherContactNo" placeholder="Enter Contact No" >
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-4">   
                                                                <div class="form-group">
                                                                    <label for="text">Email Address : </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="otherEmailAddress" id="otherEmailAddress" placeholder="Enter Email Address" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 	
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">   
                                                        <div class="form-group">
                                                            <label for="text">Rate Us: </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div id="rateYo"></div>
                                                            <input type="hidden" name="ratingVal" id="ratingVal" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-12 text-right">
                                                <a href="<?php echo base_url('home'); ?>"><button type="button" class="waves-effect waves-light btn btn-sm btn-dark" >Back</button></a>
                                                <button type="submit" name="submit" class="waves-effect waves-light btn btn-sm btn-submit text-right">Submit</button>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            
            $('.notUseReasonDiv').hide();
            $('.recmdToOtherDiv').hide();
            
            $('input[name="isUse"]').on('click', function(){
                
                var isUse = $(this).val();
                
                if(isUse==3)
                {
                    $('.notUseReasonDiv').show();
                }
                else
                {
                    $('.notUseReasonDiv').hide();
                }
                
            });
            
            $('input[name="recmdToOther"]').on('click', function(){
                
                var recmdToOther = $(this).val();
                
                if(recmdToOther==1)
                {
                    $('.recmdToOtherDiv').show();
                }
                else
                {
                    $('.recmdToOtherDiv').hide();
                }
                
            });
            
            $(function () {
                $("#rateYo").rateYo({
                    rating: 0,
                    fullStar: true,
                    starWidth: "25px",
                    onSet: function (rating, rateYoInstance) {
                        console.log("Rating is set to: " + rating);
                        
                        $('#ratingVal').val(rating);
                    }
                });
            });
            
        });
    </script>


<?= $this->endSection(); ?>