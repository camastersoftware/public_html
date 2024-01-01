<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
    }
    
    .table-responsive table thead tr{
        background: #005495 !important;
        color: #fff !important;
    }
    
    .table-responsive table tbody tr{
        background: #96c7f242 !important;
    }
    
    .table-responsive tr th{
        border: 1px solid #fff !important;
    }
    
    .table-responsive tr td{
        border: 1px solid #015aacab !important;
    }
    
    table.dataTable {
        border-collapse: collapse !important;
        font-size: 16px !important;
    }
    
    .table > tbody > tr > td, .table > tbody > tr > th {
        padding: 0px 14px !important;
    }
    
    .btnPrimClr {
        margin-top: 5px !important;
        height: 30px !important;
        margin-bottom: 5px !important;
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

<!-- Main content -->
<section class="content mt-35 add_staff_div_sec">
    <div class="col-12">
        <!-- Step wizard -->
        <div class="box box-default">
            <div class="box-header with-border flexbox">
                <h4 class="box-title font-weight-bold">Create User / Staff</h4>
                <div class="text-right flex-grow hide">
                    <button type="button" class="waves-effect waves-light btn btn-submit add_user_top">Create User/Staff</button>
                    <button type="button" class="waves-effect waves-light btn btn-dark back_page">Back</button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body box_body_bg wizard-content">
                <section class="add_staff_section hide">
                    <h4>Add/Modify Existing Staff </h4>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="search_user_name">Enter Staff Name:</label>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search_user_name" id="search_user_name" placeholder="Enter User/Staff Name"> 
                                <label id="search_user_name_err" class="text-danger"></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="waves-effect waves-light btn btn-submit user_submit">Proceed</button>
                        </div>
                    </div>
                </section>
                <section class="get_staff_section"></section>
                <form action="" method="post" class="staff_form tab-wizard wizard-circle" enctype="multipart/form-data">
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
                                        <input type="text" class="form-control" name="userFullName" id="userFullName" placeholder="Enter Staff Full Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-4">Upload Image:</label>
                                            <input type="file" class="upload mt-2" name="userImg" id="userImg"> 
                                            <!--<div class="btn btn-info btn-uplod mb-20 col-md-8 ">-->
                                            <!--    <input type="file" class="upload" name="userImg" id="userImg"> -->
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
                                                        <option value="<?php echo $e_sal['salutation_name']; ?>"><?php echo $e_sal['salutation_name']; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userShortName">Short Name:<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="userShortName" id="userShortName" placeholder="Enter Short Name"> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userDob">Date of Birth: </label>
                                            <input type="date" class="form-control" name="userDob" id="userDob"> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userQualification">Qualification:</label>
                                            <input type="text" class="form-control" name="userQualification" id="userQualification" placeholder="Enter Qualification"> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userRegNo">Registration Number: </label>
                                                <input type="text" class="form-control" name="userRegNo" id="userRegNo" placeholder="Enter Registration Number"> 
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="userRegDocument">Document: </label>
                                                <input type="file" name="userRegDocument" id="userRegDocument"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userAadharNo">Aadhar Number: </label>
                                                <input type="text" class="form-control" name="userAadharNo" id="userAadharNo" placeholder="Enter Aadhar Number" > 
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="userAadharDoc">Document:</label>
                                                <input type="file" name="userAadharDoc" id="userAadharDoc"> 
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
                                            <input type="tel" class="form-control" name="userMobile1" id="userMobile1" placeholder="Enter Mobile 1"> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userMobileWhatsApp">Mobile (WhatsApp):</label>
                                            <input type="tel" class="form-control" name="userMobileWhatsApp" id="userMobileWhatsApp" placeholder="Enter Mobile (WhatsApp)"> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userResidencePhone">Residence Phone:</label>
                                            <input type="tel" class="form-control" name="userResidencePhone" id="userResidencePhone" placeholder="Enter Residence Phone"> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userOfficePhone">Office Phone:</label>
                                            <input type="tel" class="form-control" name="userOfficePhone" id="userOfficePhone" placeholder="Enter Office Phone"> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userEmail1">Email 1:</label>
                                            <input type="email" class="form-control" name="userEmail1" id="userEmail1" placeholder="Enter Email 1"> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userEmail2">Email 2:</label>
                                            <input type="email" class="form-control" name="userEmail2" id="userEmail2" placeholder="Enter Email 2"> 
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
                                            <input type="text" class="form-control" name="userPan" id="userPan" placeholder="Enter PAN No"> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userPassportNo">Passport No:</label>
                                            <input type="text" class="form-control" name="userPassportNo" id="userPassportNo" placeholder="Enter Passport No"> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userResidenceAddress">Residence Address:</label>
                                            <textarea type="text" class="form-control" name="userResidenceAddress" id="userResidenceAddress" rows="3" placeholder="Enter Residence Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userReference">Reference (Introduced by):</label>
                                            <input type="text" class="form-control" name="userReference" id="userReference" placeholder="Enter Reference (Introduced by)"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-8"> 
                                        <div class="form-group">
                                            <label for="userRemark">Remark/Notes:</label>
                                            <textarea type="text" class="form-control" name="userRemark" id="userRemark" placeholder="Enter Remark/Notes" rows="3"></textarea> 
                                        </div>
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="userCV">Upload CV:</label>
                                            <input type="file" name="userCV" id="userCV"> 
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
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
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
                                                        <option value="<?php echo $e_staff['staff_type_id']; ?>"><?php echo $e_staff['staff_type_name']; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userDesgn">Designation:</label>
                                            <input type="text" class="form-control" name="userDesgn" id="userDesgn" placeholder="Enter Designation"> 
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="userDOJ">Date of Joining:</label>
                                            <input type="date" class="form-control" name="userDOJ" id="userDOJ" placeholder="Enter Date of Joining"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mt-10">
                                            <label for="userLoginName">Login Name:</label>
                                            <input type="text" class="form-control" name="userLoginName" id="userLoginName" placeholder="Enter Login Name"> 
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
                                            <label for="userDOL">Date of Leaving:</label>
                                            <input type="date" class="form-control" name="userDOL" id="userDOL" placeholder="Enter Date of Leaving"> 
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
                                                <input class="form-control" type="text" name="userArtRegNo" id="userArtRegNo" placeholder="Enter Registration No">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userArtStartDate">Date of Start of Articleship:</label>
                                            <input type="date" class="form-control" name="userArtStartDate" id="userArtStartDate" placeholder="Enter Start Date of Articleship"> 
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userArtEndDate">Date of End of Articleship:</label>
                                            <input type="date" class="form-control" name="userArtEndDate" id="userArtEndDate" placeholder="Enter End Date of Articleship"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userICAICommDate">Intimation to ICAI-Commencemene:</label>
                                            <input type="date" class="form-control" name="userICAICommDate" id="userICAICommDate" placeholder="Intimation to ICAI-Commencemene Date">
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userICAIComplDate">Intimation to ICAI-Completion:</label>
                                            <input type="date" class="form-control" name="userICAIComplDate" id="userICAIComplDate" placeholder="Enter Intimation to ICAI-Completion Date"> 
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
                                        <input class="form-control" type="text" name="userCAMemNo" id="userCAMemNo" placeholder="Enter Membership No">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userCADOJ">Date of Joining:</label>
                                            <input type="date" class="form-control" name="userCADOJ" id="userCADOJ" placeholder="Enter Date of Joining"> 
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userCADOL">Date of Leaving:</label>
                                            <input type="date" class="form-control" name="userCADOL" id="userCADOL" placeholder="Enter Date of Leaving"> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userICAIJoin">Intimation to ICAI-Joining:</label>
                                            <input type="date" class="form-control" name="userICAIJoin" id="userICAIJoin" placeholder="Enter Intimation to ICAI-Joining Date"> 
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userICAILeave">Intimation to ICAI-Leaving:</label>
                                            <input type="date" class="form-control" name="userICAILeave" id="userICAILeave" placeholder="Enter Intimation to ICAI-Leaving Date"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>                  
                </form>
            </div>
        </div>
    </div>
</section>
<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        Staff List
                    </h4>
                    <div class="text-right flex-grow">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_user_top">Create User/Staff</button>
                        <!--<button type="button" class="waves-effect waves-light btn btn-dark back_page">Back</button>-->
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th>User Name</th>
                                    <th>Designation</th>
                                    <th>DOB</th>
                                    <th>DOJ</th>
                                    <th width="5%">Mobile No</th>
                                    <th>Email ID</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php if(!empty($getUserList)): ?>
                                    <?php foreach($getUserList AS $e_row): ?>
                                        <tr id="user_id_tr_<?php echo $e_row['userId']; ?>">
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td nowrap>
                                                <a href="<?php echo base_url('user/edit_user/'.$e_row['userId']); ?>">
                                                    <?php //echo $e_row['userTitle'].". ".$e_row['userFullName']; ?>
                                                    <?php echo $e_row['userFullName']; ?>
                                                </a>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['userDesgn']))
                                                        echo $e_row['userDesgn']; 
                                                    else
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['userDob']) && $e_row['userDob']!="0000-00-00")
                                                        echo date("d-m-Y", strtotime($e_row['userDob']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                    $userDOJ="N/A";
                                                    if(!empty($e_row['userDOJ']) && $e_row['userDOJ']!="0000-00-00" && $e_row['userDOJ']!="1970-01-01")
                                                        $userDOJ=date('d-m-Y', strtotime($e_row['userDOJ']));
                                                ?>
                                                <?php echo $userDOJ; ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['userMobile1']))
                                                        echo $e_row['userMobile1']; 
                                                    else
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td nowrap>
                                                <?php 
                                                    if(!empty($e_row['userEmail1']))
                                                        echo $e_row['userEmail1']; 
                                                    else
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="<?php echo base_url('user/edit_user/'.$e_row['userId']); ?>" ><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                                        <a class="dropdown-item" href="<?php echo base_url('user/view_user/'.$e_row['userId']); ?>" ><i class="fa fa-file"></i>&nbsp;View Documents</a>
                                                        <a class="dropdown-item markAsOld" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Mark As Left" data-rowId="<?php echo $e_row['userId']; ?>"><i class="fa fa-ban"></i>&nbsp;Mark As Left</a>
                                                        <a class="dropdown-item delUser" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Delete" data-rowId="<?php echo $e_row['userId']; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="staffLeftReasonModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="staffLeftForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Enter Reason for Leaving</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Enter Reason<small class="text-danger">*</small></label>
                                <textarea class="form-control" name="userLeftReason" id="userLeftReason" placeholder="Enter Reason" rows="3" required></textarea> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" id="left_user_id" value="" />
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="button" class="btn btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<script type="text/javascript">
            
    $(document).ready(function(){
        
        $('.add_staff_div_sec').hide();

        var base_url = "<?php echo base_url(); ?>";

        $('.get_staff_section').hide();
        $('.staff_form').hide();
        $('.edit_staff_div').hide();
        $('.back_page').hide();

        $('.user_submit').on('click', function(){

            var search_user_name = $('#search_user_name').val();

            $('#search_user_name_err').text("");

            if(search_user_name=="")
            {
                $('#search_user_name_err').text("Please enter user name");
                return false;
            }

            $.ajax({
                url: base_url+'/getUsers',
                type: 'POST',
                data: { 
                    'user_name': search_user_name,
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
                },
                dataType: 'html',
                success: function(data) {

                    $('#search_user_name').val("");

                    $('.get_staff_section').html(data);
                    $('.get_staff_section').show();
                    $('.add_staff_section').hide();
                    $('.client_list_tbl').hide();
                    $('.add_user_top').hide();
                    $('.back_page').show();

                },
                error: function(request, error)
                {
                    // alert("Request: "+JSON.stringify(request));
                }
            });
        });

        $('body').on('submit', '.staff_form', function(e){

            e.preventDefault();    
            var userFormData = new FormData(this);

            // var clientFormData = $('.client_form').serialize();

            $.ajax({
                url: base_url+'/add_user',
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

        $('.delUser').on('click', function(e){

            e.preventDefault();

            var userId = $(this).data('rowid');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this user ?",
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
                        url: base_url+'/delete_user',
                        type: 'POST',
                        data: {
                            'userId':userId,
                            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
                        },
                        dataType: 'json',
                        success: function(response) {

                            var resStatus = response['status'];
                            var resMsg = response['message'];
                            var resUserData = response['userdata'];

                            if(resStatus==true)
                            {
                                swal("Deleted", resMsg, "success");

                                $('#user_id_tr_'+userId).remove();
                            }
                            else
                            {
                                swal("Error!", resMsg, "error");
                            }

                        },
                        error: function(request, error)
                        {
                            // alert("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled:)", "error");
                }
            });

        });
        
        $('.markAsOld').on('click', function(e){

            e.preventDefault();
            
            $("#left_user_id").val("");
            $("#userLeftReason").val("");

            var userId = $(this).data('rowid');

            swal({
                title: "Are you sure?",
                text: "Do you really want to mark this user as left ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Mark it as left!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    
                    $("#left_user_id").val(userId);
                    $('#staffLeftReasonModal').modal('show');
                    
                    swal.close();

                } else {
                    swal("Cancelled", "You cancelled:)", "error");
                }
            });

        });
        
        $('#staffLeftForm').on('submit', function(e){

            e.preventDefault();

            var userId = $("#left_user_id").val();
            var userLeftReason = $("#userLeftReason").val();
            
            $.ajax({
                url: base_url+'/mark_old_user',
                type: 'POST',
                data: {
                    'userId':userId,
                    'userLeftReason':userLeftReason,
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
                },
                dataType: 'json',
                success: function(response) {

                    var resStatus = response['status'];
                    var resMsg = response['message'];
                    var resUserData = response['userdata'];

                    if(resStatus==true)
                    {
                        swal("Marked has left", resMsg, "success");

                        $('#user_id_tr_'+userId).remove();
                    }
                    else
                    {
                        swal("Error!", resMsg, "error");
                    }
                    
                    $('#staffLeftReasonModal').modal('hide');
                },
                error: function(request, error)
                {
                    // alert("Request: "+JSON.stringify(request));
                }
            });

        });
        
        $('.add_user_top').on('click', function(){
            $('.add_user_top').hide();
            $('.add_staff_section').hide();
            $('.client_list_tbl').hide();
            $('.get_staff_section').hide();
            $('.add_staff_div_sec').show();
            $('.staff_form').show();
            $('.back_page').show();
        }); 

        $('.edit_staff_btn').on('click', function(){
            $('.edit_staff_div').show();
            $('.add_staff_div').hide();
            $('.client_list_tbl').hide();
        });

        $('.go_back_staff').on('click', function(){
            $('.edit_staff_div').hide();
            $('.add_staff_div').show();
            $('.client_list_tbl').show();
        });

        $('.back_page').on('click', function(){
            $('.back_page').hide();
            $('.add_staff_section').show();
            $('.get_staff_section').hide();
            $('.client_list_tbl').show();
            $('.add_user_top').show();
            $('.staff_form').hide();
        });

        $('.wizard-content .wizard > .actions > ul').append('<li><button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button></li>');
        
        $('.wizard-content .wizard > .actions > ul li:nth-child(3)').remove();

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

    });

</script>

<?= $this->endSection(); ?>