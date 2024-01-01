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
                        <a href="<?php echo base_url('superadmin/feedbackReport'); ?>"><button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="#" class="client_form">
                            <!-- Step 1 -->
                            <section>
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="row bg_prjt_format">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">     
                                                        <div class="form-group">
                                                            <label for="text">License No :</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="text"><?php echo $feedbackData['caFirmCompanyKey']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">     
                                                        <div class="form-group">
                                                            <label for="text">Firm Name :</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="text"><?php echo $feedbackData['caFirmName']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">     
                                                        <div class="form-group">
                                                            <label for="text">Staff Name :</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="text"><?php echo $feedbackData['staffName']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="text">Date :</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="text">
                                                                <?php
                                                                    if($feedbackData['feedbackDate']!="" && $feedbackData['feedbackDate']!="1970-01-01"  && $feedbackData['feedbackDate']!="0000-00-00")
                                                			            echo date('d-m-Y', strtotime($feedbackData['feedbackDate']));
                                                			        else
                                                			            echo "N/A";
                                                                ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">     
                                                        <div class="form-group">
                                                            <label for="text">Do you find this software useful ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="text">
                                                                <?php
                                                                    if($feedbackData['isUseful']==1)
                                                			            echo "Yes";
                                                			        elseif($feedbackData['isUseful']==2)
                                                			            echo "No";
                                                			        else
                                                			            echo "---";
                                                                ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">     
                                                        <div class="form-group">
                                                            <label for="text">Do you find this software Reliable ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="text">
                                                                <?php
                                                                    if($feedbackData['isReliable']==1)
                                                			            echo "Yes";
                                                			        elseif($feedbackData['isReliable']==2)
                                                			            echo "No";
                                                			        else
                                                			            echo "---";
                                                                ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">     
                                                        <div class="form-group">
                                                            <label for="text">Do you use it ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="text">
                                                                <?php
                                                                    if($feedbackData['isUse']==1)
                                                			            echo "Regularly";
                                                			        elseif($feedbackData['isUse']==2)
                                                			            echo "Sometimes";
                                                			        elseif($feedbackData['isUse']==3)
                                                			            echo "Not using it";
                                                			        else
                                                			            echo "---";
                                                                ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">   
                                                        <div class="form-group">
                                                            <label for="text">If not using, Can you tell us reason ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="text">
                                                                <?php
                                                                    if($feedbackData['isUse']==3)
                                                                    {
                                                                        if(!empty($feedbackData['notUseReason']))
                                                                            echo $feedbackData['notUseReason'];
                                                                        else
                                                                            echo "N/A";
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "N/A";
                                                                    }
                                                                ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">   
                                                        <div class="form-group">
                                                            <label for="text">Which part of this software needs improvement ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="text">
                                                                <?php
                                                                    if(!empty($feedbackData['improvementReqd']))
                                                                        echo $feedbackData['improvementReqd'];
                                                                    else
                                                                        echo "N/A";
                                                                ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">   
                                                        <div class="form-group">
                                                            <label for="text">Will you recommend this software to others ?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="text">
                                                                <?php
                                                                    if($feedbackData['recmdToOther']==1)
                                                			            echo "Yes";
                                                			        elseif($feedbackData['recmdToOther']==2)
                                                			            echo "No";
                                                			        else
                                                			            echo "---";
                                                                ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">   
                                                        <div class="form-group">
                                                    <label for="text">Rating : </label>
                                                </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <div id="rateYo"></div>
                                                            <input type="hidden" name="ratingVal" id="ratingVal" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div> 
                                    <?php if($feedbackData['recmdToOther']==1): ?>
                                    <div class="col-md-8 offset-md-2 mt-10">
                                        <div class="row bg_prjt_format">
                                            <div class="col-md-12 recmdToOtherDiv">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row form-group">
                                                            <div class="col-md-5">   
                                                                <div class="form-group">
                                                                    <label for="text">Name : </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <?php
                                                                    if(!empty($feedbackData['otherName']))
                                                			            echo $feedbackData['otherName'];
                                                			        else
                                                			            echo "---";
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-5">   
                                                                <div class="form-group">
                                                                    <label for="text">Profession : </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <?php
                                                                    if(!empty($feedbackData['otherProfession']))
                                                			            echo $feedbackData['otherProfession'];
                                                			        else
                                                			            echo "---";
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-5">   
                                                                <div class="form-group">
                                                                    <label for="text">Location : </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <?php
                                                                    if(!empty($feedbackData['otherLocation']))
                                                			            echo $feedbackData['otherLocation'];
                                                			        else
                                                			            echo "---";
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-5">   
                                                                <div class="form-group">
                                                                    <label for="text">Contact No : </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <?php
                                                                    if(!empty($feedbackData['otherContactNo']))
                                                			            echo $feedbackData['otherContactNo'];
                                                			        else
                                                			            echo "---";
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-5">   
                                                                <div class="form-group">
                                                                    <label for="text">Email Address : </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <?php
                                                                    if(!empty($feedbackData['otherEmailAddress']))
                                                			            echo $feedbackData['otherEmailAddress'];
                                                			        else
                                                			            echo "---";
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div> 
                                    </div>
                                    <?php endif; ?>
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
            
            var ratingVal = parseInt("<?php echo $feedbackData['ratingVal']; ?>");
            
            $(function () {
                $("#rateYo").rateYo({
                    rating: ratingVal,
                    fullStar: true,
                    readOnly: true,
                    starWidth: "25px"
                });
            });
            
        });
    </script>




<?= $this->endSection(); ?>