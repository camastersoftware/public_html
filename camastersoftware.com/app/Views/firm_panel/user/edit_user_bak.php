<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>
<style>
    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
    }
    
    .box_body_bg {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        /*border-radius: 10px;*/
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        /*margin-top: 20px !important;*/
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
</style>

<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?php echo $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <?php if(empty($masterParam)): ?>
                            <a href="<?php echo base_url('users'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo base_url('getMasterStaffData'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="box-body box_body_bg wizard-content">
                    <form action="" method="post" class="edit_staff_form tab-wizard wizard-circle" enctype="multipart/form-data">
                        <!-- Step 1 -->
                        <h6>PERSONAL DETAILS</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="userFullName" class="col-sm-2 col-md-4 col-form-label">
                                            Full Name of the Staff:<small class="text-danger">*</small>
                                        </label>
                                        <div class="col-sm-6 col-md-8">
                                            <input type="text" class="form-control" name="userFullName" id="userFullName" placeholder="Enter Staff Full Name" value="<?php echo $userDataArr['userFullName']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Upload Image:</label>
                                                <input type="file" class="upload mt-2" name="userImg" id="userImg"> 
                                                <input type="hidden" name="userOldImg" value="<?php echo $userDataArr['userImg']; ?>"> 
                                                <!--<div class="btn btn-info btn-uplod mb-20 col-md-8 ">-->
                                                    
                                                <!--</div>-->
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <!--<h4>Personal Info</h4>-->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userTitle">Title:<small class="text-danger">*</small></label>
                                                <select class="custom-select form-control" id="userTitle" name="userTitle">
                                                    <option value="">Select Title</option>
                                                    <?php if(!empty($salutationList)): ?>
                                                        <?php foreach($salutationList AS $e_sal): ?>
                                                            <option value="<?php echo $e_sal['salutation_name']; ?>" <?php if($userDataArr['userTitle']==$e_sal['salutation_name']): ?>selected<?php endif; ?> ><?php echo $e_sal['salutation_name']; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userShortName">Short Name:<small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" name="userShortName" id="userShortName" placeholder="Enter Short Name" value="<?php echo $userDataArr['userShortName']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userDob']) && $userDataArr['userDob']!="0000-00-00")
                                                        $userDob=date("Y-m-d", strtotime($userDataArr['userDob']));
                                                    else
                                                        $userDob="";
                                                ?>
                                                <label for="userDob">Date of Birth: </label>
                                                <input type="date" class="form-control" name="userDob" id="userDob" value="<?php echo $userDob; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userQualification">Qualification:</label>
                                                <input type="text" class="form-control" name="userQualification" id="userQualification" placeholder="Enter Qualification" value="<?php echo $userDataArr['userQualification']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="userRegNo">Registration Number: </label>
                                                    <input type="text" class="form-control" name="userRegNo" id="userRegNo" placeholder="Enter Registration Number" value="<?php echo $userDataArr['userRegNo']; ?>"> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="userRegDocument">Document: </label>
                                                    <input type="file" name="userRegDocument" id="userRegDocument"> 
                                                    <input type="hidden" name="userRegOldDocument" value="<?php echo $userDataArr['userRegDocument']; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="userAadharNo">Aadhar Number: </label>
                                                    <input type="text" class="form-control" name="userAadharNo" id="userAadharNo" placeholder="Enter Aadhar Number" value="<?php echo $userDataArr['userAadharNo']; ?>" > 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="userAadharDoc">Document:</label>
                                                    <input type="file" name="userAadharDoc" id="userAadharDoc"> 
                                                    <input type="hidden" name="userAadharOldDoc" value="<?php echo $userDataArr['userAadharDoc']; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Contact Details:</h4>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userMobile1">Mobile 1:</label>
                                                <input type="tel" class="form-control" name="userMobile1" id="userMobile1" placeholder="Enter Mobile 1" value="<?php echo $userDataArr['userMobile1']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userMobileWhatsApp">Mobile (WhatsApp):</label>
                                                <input type="tel" class="form-control" name="userMobileWhatsApp" id="userMobileWhatsApp" placeholder="Enter Mobile (WhatsApp)" value="<?php echo $userDataArr['userMobileWhatsApp']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userResidencePhone">Residence Phone:</label>
                                                <input type="tel" class="form-control" name="userResidencePhone" id="userResidencePhone" placeholder="Enter Residence Phone" value="<?php echo $userDataArr['userResidencePhone']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userOfficePhone">Office Phone:</label>
                                                <input type="tel" class="form-control" name="userOfficePhone" id="userOfficePhone" placeholder="Enter Office Phone" value="<?php echo $userDataArr['userOfficePhone']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userEmail1">Email 1:</label>
                                                <input type="email" class="form-control" name="userEmail1" id="userEmail1" placeholder="Enter Email 1" value="<?php echo $userDataArr['userEmail1']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userEmail2">Email 2:</label>
                                                <input type="email" class="form-control" name="userEmail2" id="userEmail2" placeholder="Enter Email 2" value="<?php echo $userDataArr['userEmail2']; ?>"> 
                                            </div>
                                        </div>	
                                    </div>    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userPan">PAN No:</label>
                                                <input type="text" class="form-control" name="userPan" id="userPan" placeholder="Enter PAN No" value="<?php echo $userDataArr['userPan']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userPassportNo">Passport No:</label>
                                                <input type="text" class="form-control" name="userPassportNo" id="userPassportNo" placeholder="Enter Passport No" value="<?php echo $userDataArr['userPassportNo']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userResidenceAddress">Residence Address:</label>
                                                <textarea type="text" class="form-control" name="userResidenceAddress" id="userResidenceAddress" rows="3" placeholder="Enter Residence Address"><?php echo $userDataArr['userResidenceAddress']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userReference">Reference (Introduced by):</label>
                                                <input type="text" class="form-control" name="userReference" id="userReference" placeholder="Enter Reference (Introduced by)" value="<?php echo $userDataArr['userReference']; ?>"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-8"> 
                                            <div class="form-group">
                                                <label for="userRemark">Remark/Notes:</label>
                                                <textarea type="text" class="form-control" name="userRemark" id="userRemark" placeholder="Enter Remark/Notes" rows="3"><?php echo $userDataArr['userRemark']; ?></textarea> 
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label for="userCV">Upload CV:</label>
                                                <input type="file" name="userCV" id="userCV"> 
                                                <input type="hidden" name="userOldCV" value="<?php echo $userDataArr['userCV']; ?>"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h6>Office Allocation</h6>
                        <section>        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group mt-10">
                                                <label for="isCostCenter">Cost Centre:</label>
                                                <select class="custom-select form-control" id="isCostCenter" name="isCostCenter">
                                                    <option value="">Select Cost Center</option>
                                                    <option value="1" <?php if($userDataArr['isCostCenter']=="1"): ?>selected<?php endif; ?> >Yes</option>
                                                    <option value="2" <?php if($userDataArr['isCostCenter']=="2"): ?>selected<?php endif; ?> >No</option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userStaffType">Staff Type:<small class="text-danger">*</small></label>
                                                <select class="custom-select form-control" id="userStaffType" name="userStaffType">
                                                    <option value="">Select Staff Type</option>
                                                    <?php if(!empty($staffTypeList)): ?>
                                                        <?php foreach($staffTypeList AS $e_staff): ?>
                                                            <option value="<?php echo $e_staff['staff_type_id']; ?>" <?php if($userDataArr['userStaffType']==$e_staff['staff_type_id']): ?>selected<?php endif; ?>><?php echo $e_staff['staff_type_name']; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userDesgn">Designation:</label>
                                                <input type="text" class="form-control" name="userDesgn" id="userDesgn" placeholder="Enter Designation" value="<?php echo $userDataArr['userDesgn']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userDOJ']) && $userDataArr['userDOJ']!="0000-00-00")
                                                        $userDOJ=date("Y-m-d", strtotime($userDataArr['userDOJ']));
                                                    else
                                                        $userDOJ="";
                                                ?>
                                                <label for="userDOJ">Date of Joining:</label>
                                                <input type="date" class="form-control" name="userDOJ" id="userDOJ" placeholder="Enter Date of Joining" value="<?php echo $userDOJ; ?>"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group mt-10">
                                                <label for="userLoginName">Login Name:</label>
                                                <input type="text" class="form-control" name="userLoginName" id="userLoginName" placeholder="Enter Login Name" value="<?php echo $userDataArr['userLoginName']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="userPassword">Login Password:</label>
                                                <input type="text" class="form-control" name="userPassword" id="userPassword" placeholder="Enter Login Password"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userDOL']) && $userDataArr['userDOL']!="0000-00-00")
                                                        $userDOL=date("Y-m-d", strtotime($userDataArr['userDOL']));
                                                    else
                                                        $userDOL="";
                                                ?>
                                                <label for="userDOL">Date of Leaving:</label>
                                                <input type="date" class="form-control" name="userDOL" id="userDOL" placeholder="Enter Date of Leaving" value="<?php echo $userDOL; ?>">
                                            </div>
                                        </div>	
                                    </div>    
                                </div>
                            </div>
                        </section>
                        <h6>Articled Assistant</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="compy-form row justify-content-center">
                                                <label for="userArtRegNo" class="col-sm-3 col-form-label" style="font-size:17px;">Registration No:</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" name="userArtRegNo" id="userArtRegNo" placeholder="Enter Registration No" value="<?php echo $userDataArr['userArtRegNo']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userArtStartDate']) && $userDataArr['userArtStartDate']!="0000-00-00")
                                                        $userArtStartDate=date("Y-m-d", strtotime($userDataArr['userArtStartDate']));
                                                    else
                                                        $userArtStartDate="";
                                                ?>
                                                <label for="userArtStartDate">Date of Start of Articleship:</label>
                                                <input type="date" class="form-control" name="userArtStartDate" id="userArtStartDate" placeholder="Enter Start Date of Articleship" value="<?php echo $userArtStartDate; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userArtEndDate']) && $userDataArr['userArtEndDate']!="0000-00-00")
                                                        $userArtEndDate=date("Y-m-d", strtotime($userDataArr['userArtEndDate']));
                                                    else
                                                        $userArtEndDate="";
                                                ?>
                                                <label for="userArtEndDate">Date of End of Articleship:</label>
                                                <input type="date" class="form-control" name="userArtEndDate" id="userArtEndDate" placeholder="Enter End Date of Articleship" value="<?php echo $userArtEndDate; ?>"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userICAICommDate']) && $userDataArr['userICAICommDate']!="0000-00-00")
                                                        $userICAICommDate=date("Y-m-d", strtotime($userDataArr['userICAICommDate']));
                                                    else
                                                        $userICAICommDate="";
                                                ?>
                                                <label for="userICAICommDate">Intimation to ICAI-Commencemene:</label>
                                                <input type="date" class="form-control" name="userICAICommDate" id="userICAICommDate" placeholder="Intimation to ICAI-Commencemene Date" value="<?php echo $userICAICommDate; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userICAIComplDate']) && $userDataArr['userICAIComplDate']!="0000-00-00")
                                                        $userICAIComplDate=date("Y-m-d", strtotime($userDataArr['userICAIComplDate']));
                                                    else
                                                        $userICAIComplDate="";
                                                ?>
                                                <label for="userICAIComplDate">Intimation to ICAI-Completion:</label>
                                                <input type="date" class="form-control" name="userICAIComplDate" id="userICAIComplDate" placeholder="Enter Intimation to ICAI-Completion Date" value="<?php echo $userICAIComplDate; ?>"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h6>Chartered Accountant</h6>
                        <section>    
                            <div class="col-md-12">
                                <div class="col-md-12 text-center">
                                    <div class="compy-form row justify-content-center">
                                        <label for="userCAMemNo" class="col-sm-3 col-form-label" style="font-size:17px;">Membership No:</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="userCAMemNo" id="userCAMemNo" placeholder="Enter Membership No" value="<?php echo $userDataArr['userCAMemNo']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userCADOJ']) && $userDataArr['userCADOJ']!="0000-00-00")
                                                        $userCADOJ=date("Y-m-d", strtotime($userDataArr['userCADOJ']));
                                                    else
                                                        $userCADOJ="";
                                                ?>
                                                <label for="userCADOJ">Date of Joining:</label>
                                                <input type="date" class="form-control" name="userCADOJ" id="userCADOJ" placeholder="Enter Date of Joining" value="<?php echo $userCADOJ; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userCADOL']) && $userDataArr['userCADOL']!="0000-00-00")
                                                        $userCADOL=date("Y-m-d", strtotime($userDataArr['userCADOL']));
                                                    else
                                                        $userCADOL="";
                                                ?>
                                                <label for="userCADOL">Date of Leaving:</label>
                                                <input type="date" class="form-control" name="userCADOL" id="userCADOL" placeholder="Enter Date of Leaving" value="<?php echo $userCADOL; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userICAIJoin']) && $userDataArr['userICAIJoin']!="0000-00-00")
                                                        $userICAIJoin=date("Y-m-d", strtotime($userDataArr['userICAIJoin']));
                                                    else
                                                        $userICAIJoin="";
                                                ?>
                                                <label for="userICAIJoin">Intimation to ICAI-Joining:</label>
                                                <input type="date" class="form-control" name="userICAIJoin" id="userICAIJoin" placeholder="Enter Intimation to ICAI-Joining Date" value="<?php echo $userICAIJoin; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    if(!empty($userDataArr['userICAILeave']) && $userDataArr['userICAILeave']!="0000-00-00")
                                                        $userICAILeave=date("Y-m-d", strtotime($userDataArr['userICAILeave']));
                                                    else
                                                        $userICAILeave="";
                                                ?>
                                                <label for="userICAILeave">Intimation to ICAI-Leaving:</label>
                                                <input type="date" class="form-control" name="userICAILeave" id="userICAILeave" placeholder="Enter Intimation to ICAI-Leaving Date" value="<?php echo $userICAILeave; ?>"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                        </section>                  
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
            
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";

        $('body').on('submit', '.edit_staff_form', function(e){

            e.preventDefault();    
            var userFormData = new FormData(this);

            // var clientFormData = $('.client_form').serialize();

            $.ajax({
                url: base_url+'/update_user',
                type: 'POST',
                data: userFormData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {

                    var resStatus = response['status'];
                    var resMsg = response['message'];
                    var resUserData = response['userdata'];
                    var isExceedLimit = response['isExceedLimit'];
                    
                    if(resStatus==true)
                    {
                        // $('.client_form')[0].reset();
                        window.location.href=base_url+"/users";
                    }
                    else
                    {
                        if(isExceedLimit=="true")
                        {
                            swal("Error!", "You have exceeded the maximum limit of users :(", "error");
                        }
                        else
                        {
                            $.each(resUserData, function(index, value){
                                
                                $("#"+index).siblings('span').remove();
                        
                                if(value!="")
                                    $("#"+index).closest('div').append('<span class="text-danger">'+value+'</span>');
                            });
    
                            swal("Error!", resMsg, "error");
                        }
                    }
                },
                error: function(request, error)
                {
                    // alert("Request: "+JSON.stringify(request));
                }
            });
        });

        $('.wizard-content .wizard > .actions > ul').append('<li><button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button></li>');
        
        $('.wizard-content .wizard > .actions > ul li:nth-child(3)').remove();
        
        $('.steps ul li:not(:first)').removeClass('disabled');
        $('.steps ul li:not(:first)').addClass('done');
        
        $('.wizard-content .wizard > .actions > ul').css('margin-right', '40%');
        
        $('#userStaffType').on('change', function(){
            var userStaffType  = $(this).val();
            
            if(userStaffType==6)
            {
                $('#userLoginName').val("");
                $('#userPassword').val("");
                
                $('#userLoginName').prop('disabled', true);
                $('#userPassword').prop('disabled', true);
            }
            else
            {
                $('#userLoginName').prop('disabled', false);
                $('#userPassword').prop('disabled', false);
            }
        });
        
        $('#userStaffType').trigger('change');

    });

</script>

<?= $this->endSection(); ?>