<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .modal-xl {
        max-width: 1295px !important;
    }

    #filterLabels div.col-md-6 {
        font-size: 15px !important;
        font-weight: bold !important;
    }

    .tabcontent-border {
        border: 1px solid #bfbfbf !important;
    }

    td.column_date {
        font-size: 15px !important;
    }

    .tablepress tbody td,
    .tablepress tfoot th {
        border: 1px solid #015aacab !important;
        /*color: #000;*/
    }

    .nav-tabs .nav-link:hover,
    .nav-tabs .nav-link:focus {
        border-color: #015aac #015aac #015aac !important;
    }

    .nav-tabs .nav-link {
        position: relative;
        color: #7792b1;
        padding: 0.5rem 1.25rem;
        border-radius: 0;
        -webkit-transition: 0.5s;
        transition: 0.5s;
        border: 1px solid #015aac !important;
        border-top-color: rgb(1, 90, 172);
        border-right-color: rgb(1, 90, 172);
        border-bottom-color: rgb(1, 90, 172);
        border-left-color: rgb(1, 90, 172);
        background: #fff !important;
    }

    table.dataTable {
        border-collapse: separate !important;
        font-size: 13px !important;
    }

    .theme-primary .btn-info {
        height: 25px !important;
    }

    .due_date_for_name {
        font-size: 16px !important;
        /*font-weight: 700 !important;*/
        color: #000 !important;
    }

    #tablepress-2 tr th {
        font-size: 16px !important;
        font-weight: 800 !important;
    }

    .tab_body_div .nav-item .nav-link {
        border-radius: 12px !important;
        display: inline-block !important;
        width: 75% !important;
        font-size: 18px !important;
    }

    .tab_body_div .nav-item .nav-link.active span {
        color: #fff !important;
    }

    .tab_body_div .nav-tabs .nav-link {
        margin-bottom: 20px !important;
    }

    .theme-primary .nav-tabs .nav-link.active {
        border-color: #F99D27 !important;
        background-color: #F99D27 !important;

        /*border: 2px solid #005495 !important;*/
        /*background-color: #005495 !important;*/
    }

    .nav-tabs {
        border: none !important;
    }

    .card_bg_format {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 0px !important;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }

    .form_bg_format {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px !important;
        border: 1px solid #8c8c8cab !important;
        background: #fdfeff !important;
    }

    .tabcontent-border {
        border: none !important;
    }

    .due-month {
        background: #F99D27;
        padding: 7px 0;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    .due-month label {
        margin-top: 2px;
        margin-bottom: 2px;
    }

    .demo-checkbox .box-header {
        background-color: #005495 !important;
        border-radius: 10px !important;
    }

    .demo-checkbox .box-header.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 50px !important;
        line-height: 29px !important;
        border: 2px solid #f99d27 !important;
    }

    .clientNameLabelVal {
        font-size: 27px !important;
    }

    .theme-primary .box-primary {
        background-color: #2b8836 !important;
    }

    .modal-header {
        border-bottom-color: #d5dfea;
        background-color: #F99D27;
        padding: 8px 8px;
    }

    .income-tax-head {
        background: #ffc800;
        padding: 10px;
        margin-bottom: 0px;
        font-weight: bold;
    }

    .tablepress td,
    .tablepress th {
        font-weight: 600;
    }

    td.column-1 {
        font-size: 14px;
    }

    .tablepress tbody tr:first-child td {
        /*background: #ffffff;*/
    }

    .modal-header h4 {
        text-align: center;
    }

    .wizard-content .wizard>.steps>ul>li.current>a {
        color: #ffffff !important;
        cursor: default;
    }

    .getActModal .box {
        cursor: pointer !important;
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

    .tablepress td {
        font-weight: 400 !important;
    }

    .tablepress thead th {
        background-color: #005495 !important;
    }

    .demo-checkbox .box_head_cl.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
    }

    .actDivClass label {
        border-radius: 10px !important;
        border: 2px solid #005495 !important;
        background-color: #f99d27 !important;
        color: #fff !important;
        height: 50px !important;
        padding-top: 10px !important;
        width: 100% !important;
        font-size: 18px !important;
        text-align: left !important;
        padding-left: 39px !important;
    }

    /*[type="checkbox"].filled-in:checked + label::before */
    .actDivClass label::before {
        margin-top: 14px !important;
        margin-left: 9px !important;
    }

    /*.theme-primary [type="checkbox"].filled-in:checked + label::after*/
    .actDivClass label::after {
        border: 2px solid #005495 !important;
        margin-left: 10px !important;
        margin-top: 12px !important;
    }

    /*[type="checkbox"].filled-in:checked + label*/
    .actDivClass .filled-in:checked+label {
        border: 2px solid #f99d27 !important;
        background-color: #005495 !important;
    }

    .actDivClass .filled-in:checked+label::after {
        border: 2px solid #f99d27 !important;
    }

    .btnBorder {
        border-radius: 11px !important;
    }

    .userNameLabelVal {
        font-size: 27px !important;
    }
</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">

        <div class="col-12">

            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?php
                        if (isset($pageTitle))
                            echo $pageTitle;
                        else
                            echo "N/A";
                        ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?= base_url('users'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body tab_body_div card_bg_format">
                    <form action="javascript:void(0);" class="tab-wizard wizard-circle staff_form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" id="user_details_tab_head" href="#user_details_tab" role="tab" aria-controls="profile">
                                            <span class="hidden-xs-down year-color">User (Employee) Details</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" id="office_allocation_tab_head" href="#office_allocation_tab" role="tab" aria-controls="profile">
                                            <span class="hidden-xs-down year-color">Office Allocation</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                        <div class="form-group row form_bg_format">
                                            <div class="col-md-12">
                                                <div class="tab-content tabcontent-border p-5" id="myTabContent">

                                                    <!------------------------------------------------- User Details - Start -------------------------------------------------->
                                                    <div class="tab-pane fade show active" id="user_details_tab" role="tabpanel" aria-labelledby="user_details_tab">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-4 offset-md-4">
                                                                        <div class="form-group">
                                                                            <label for="fkUserCatId">Select Type of User :<small class="text-danger">*</small></label>
                                                                            <select class="custom-select form-control" name="fkUserCatId" id="fkUserCatId">
                                                                                <option value="">Select Type of User</option>
                                                                                <?php if (!empty($userCategoryList)) : ?>
                                                                                    <?php foreach ($userCategoryList as $e_userCat) : ?>
                                                                                        <option value="<?php echo $e_userCat['user_cat_id']; ?>"><?php echo $e_userCat['user_cat_name']; ?></option>
                                                                                    <?php endforeach; ?>
                                                                                <?php endif; ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="state due-month">
                                                                            <h4 class="text-white font-weight-bold m-0">Personal Details</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label for="userTitle">Title:<small class="text-danger">*</small></label>
                                                                                    <select class="custom-select form-control" id="userTitle" name="userTitle">
                                                                                        <option value="">Select Title</option>
                                                                                        <?php if (!empty($salutationList)) : ?>
                                                                                            <?php foreach ($salutationList as $e_sal) : ?>
                                                                                                <option value="<?php echo $e_sal['salutation_name']; ?>"><?php echo $e_sal['salutation_name']; ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        <?php endif; ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-10">
                                                                                <div class="form-group">
                                                                                    <label for="userFullName">Full Name of the Employee:<small class="text-danger">*</small></label>
                                                                                    <input type="text" class="form-control" name="userFullName" id="userFullName" placeholder="Enter Employee Full Name" onkeyup="showUserName();" onkeydown="showUserName();" onkeypress="showUserName();" oninput="showUserName();" onfocus="showUserName();">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userShortName">Short Name:<small class="text-danger">*</small></label>
                                                                            <input type="text" class="form-control" name="userShortName" id="userShortName" placeholder="Enter Short Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userDob">Date of Birth: </label>
                                                                            <input type="date" class="form-control" name="userDob" id="userDob">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userQualification">Qualification:</label>
                                                                            <input type="text" class="form-control" name="userQualification" id="userQualification" placeholder="Enter Qualification">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <div class="col-md-7">
                                                                                <div class="form-group">
                                                                                    <label for="userAadharNo">Aadhar Number: </label>
                                                                                    <input type="text" class="form-control" name="userAadharNo" id="userAadharNo" placeholder="Enter Aadhar Number">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <div class="form-group">
                                                                                    <label for="userAadharDoc">Document:</label>
                                                                                    <input type="file" name="userAadharDoc" id="userAadharDoc">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <div class="col-md-7">
                                                                                <div class="form-group">
                                                                                    <label for="userPan">PAN No:</label>
                                                                                    <input type="text" class="form-control" name="userPan" id="userPan" placeholder="Enter PAN No">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <div class="form-group">
                                                                                    <label for="userPanDoc">Document:</label>
                                                                                    <input type="file" name="userPanDoc" id="userPanDoc">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <div class="col-md-7">
                                                                                <div class="form-group">
                                                                                    <label for="userPassportNo">Passport No:</label>
                                                                                    <input type="text" class="form-control" name="userPassportNo" id="userPassportNo" placeholder="Enter Passport No">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <div class="form-group">
                                                                                    <label for="userPassportDoc">Document:</label>
                                                                                    <input type="file" name="userPassportDoc" id="userPassportDoc">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userImg">Upload Photo:</label><br>
                                                                            <input type="file" class="upload" name="userImg" id="userImg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="userResidenceAddress">Residence Address:</label>
                                                                            <textarea type="text" class="form-control" name="userResidenceAddress" id="userResidenceAddress" rows="3" placeholder="Enter Residence Address"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="userReference">Reference (Introduced by):</label>
                                                                            <input type="text" class="form-control" name="userReference" id="userReference" placeholder="Enter Reference (Introduced by)">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="userPersonalRemark">Remarks:</label>
                                                                            <textarea type="text" class="form-control" name="userPersonalRemark" id="userPersonalRemark" placeholder="Enter Remarks" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr class="mt-0">
                                                            </div>
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="state due-month">
                                                                            <h4 class="text-white font-weight-bold m-0">Contact Details</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userMobile1">Mobile 1:</label>
                                                                            <input type="tel" class="form-control" name="userMobile1" id="userMobile1" placeholder="Enter Mobile 1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userMobileWhatsApp">Mobile 2:</label>
                                                                            <input type="tel" class="form-control" name="userMobileWhatsApp" id="userMobileWhatsApp" placeholder="Enter Mobile 2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userResidencePhone">Residence Phone:</label>
                                                                            <input type="tel" class="form-control" name="userResidencePhone" id="userResidencePhone" placeholder="Enter Residence Phone">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userOfficePhone">Office Phone:</label>
                                                                            <input type="tel" class="form-control" name="userOfficePhone" id="userOfficePhone" placeholder="Enter Office Phone">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userEmail1">Email 1:</label>
                                                                            <input type="email" class="form-control" name="userEmail1" id="userEmail1" placeholder="Enter Email 1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userEmail2">Email 2:</label>
                                                                            <input type="email" class="form-control" name="userEmail2" id="userEmail2" placeholder="Enter Email 2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="userContactRemark">Remark/Notes:</label>
                                                                            <textarea type="text" class="form-control" name="userContactRemark" id="userContactRemark" placeholder="Enter Remark/Notes" rows="3"></textarea>
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
                                                    </div>
                                                    <!------------------------------------------------- User Details - End ---------------------------------------------------->


                                                    <!------------------------------------------------- Office Allocation - Start ----------------------------------------------->
                                                    <div class="tab-pane fade" id="office_allocation_tab" role="tabpanel" aria-labelledby="office_allocation_tab">
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <div class="row userNameLabelDiv">
                                                                    <div class="col-md-12 text-center">
                                                                        <span class="font-weight-bold userNameLabelVal" id=""> </span>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="state due-month">
                                                                            <h4 class="text-white font-weight-bold m-0">Office Allocation</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="userStaffType">Employee Type:<small class="text-danger">*</small></label>
                                                                            <select class="custom-select form-control" id="userStaffType" name="userStaffType">
                                                                                <option value="">Select Employee Type</option>
                                                                                <?php if (!empty($staffTypeList)) : ?>
                                                                                    <?php foreach ($staffTypeList as $e_staff) : ?>
                                                                                        <option value="<?php echo $e_staff['staff_type_id']; ?>"><?php echo $e_staff['staff_type_name']; ?></option>
                                                                                    <?php endforeach; ?>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="userDesgn">Designation:</label>
                                                                            <input type="text" class="form-control" name="userDesgn" id="userDesgn" placeholder="Enter Designation">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="userEmpNo">Employee No:</label>
                                                                            <input type="text" class="form-control" name="userEmpNo" id="userEmpNo" placeholder="Enter Employee No">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userLoginName">Login Name:</label>
                                                                            <input type="text" class="form-control" name="userLoginName" id="userLoginName" placeholder="Enter Login Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userPassword">Login Password:</label>
                                                                            <input type="text" class="form-control" name="userPassword" id="userPassword" placeholder="Enter Login Password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userDOJ">Date of Joining:</label>
                                                                            <input type="date" class="form-control" name="userDOJ" id="userDOJ" placeholder="Enter Date of Joining">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userDOL">Date of Leaving:</label>
                                                                            <input type="date" class="form-control" name="userDOL" id="userDOL" placeholder="Enter Date of Leaving">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="userOffAlloctRemark">Remarks:</label>
                                                                            <textarea type="text" class="form-control" name="userOffAlloctRemark" id="userOffAlloctRemark" placeholder="Enter Remarks" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr class="mt-0">
                                                            </div>
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="state due-month">
                                                                            <h4 class="text-white font-weight-bold m-0">Articled Assistant</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12 articleship_section_div">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userArtRegNo">Registration No:</label>
                                                                            <input class="form-control" type="text" name="userArtRegNo" id="userArtRegNo" placeholder="Enter Registration No">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6"></div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userArtStartDate">Date of Start of Articleship:</label>
                                                                            <input type="date" class="form-control" name="userArtStartDate" id="userArtStartDate" placeholder="Enter Start Date of Articleship">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userICAICommDate">Intimation to ICAI-Commencemene:</label>
                                                                            <input type="date" class="form-control" name="userICAICommDate" id="userICAICommDate" placeholder="Intimation to ICAI-Commencemene Date">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userArtEndDate">Date of End of Articleship:</label>
                                                                            <input type="date" class="form-control" name="userArtEndDate" id="userArtEndDate" placeholder="Enter End Date of Articleship">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userICAIComplDate">Intimation to ICAI-Completion:</label>
                                                                            <input type="date" class="form-control" name="userICAIComplDate" id="userICAIComplDate" placeholder="Enter Intimation to ICAI-Completion Date">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="userArticleAsstRemark">Remarks:</label>
                                                                            <textarea type="text" class="form-control" name="userArticleAsstRemark" id="userArticleAsstRemark" placeholder="Enter Remarks" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr class="mt-0">
                                                            </div>
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <div class="state due-month">
                                                                            <h4 class="text-white font-weight-bold m-0">Chartered Accountant</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-12 ca_section_div">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userCAMemNo">Membership No:</label>
                                                                            <input class="form-control" type="text" name="userCAMemNo" id="userCAMemNo" placeholder="Enter Membership No">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6"></div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userCADOJ">Date of Joining:</label>
                                                                            <input type="date" class="form-control" name="userCADOJ" id="userCADOJ" placeholder="Enter Date of Joining">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userICAIJoin">Intimation to ICAI-Joining:</label>
                                                                            <input type="date" class="form-control" name="userICAIJoin" id="userICAIJoin" placeholder="Enter Intimation to ICAI-Joining Date">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userCADOL">Date of Leaving:</label>
                                                                            <input type="date" class="form-control" name="userCADOL" id="userCADOL" placeholder="Enter Date of Leaving">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="userICAILeave">Intimation to ICAI-Leaving:</label>
                                                                            <input type="date" class="form-control" name="userICAILeave" id="userICAILeave" placeholder="Enter Intimation to ICAI-Leaving Date">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="userCARemark">Remarks:</label>
                                                                            <textarea type="text" class="form-control" name="userCARemark" id="userCARemark" placeholder="Enter Remarks" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!------------------------------------------------- Office Allocation - End -------------------------------------------------->

                                                </div>
                                            </div>
                                            <div class="offset-md-4 offset-lg-4 col-md-4 col-lg-4 text-center">
                                                <input type="hidden" id="user_active_tab" value="" />
                                                <button type="button" class="waves-effect waves-light btn btn-submit text-right usrNavBtns" id="usrPrevBtn">Previous</button>
                                                <button type="button" class="waves-effect waves-light btn btn-submit text-right usrNavBtns" id="usrNextBtn">Next</button>
                                                <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right">Submit</button>
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
<!-- /.content -->

<script type="text/javascript">
    $(document).ready(function() {

        showUserName();

        $('#user_active_tab').val("#user_details_tab");
        $('#usrPrevBtn').prop('disabled', true);
        $('#usrNextBtn').prop('disabled', false);

        $('.staff_form .nav-link').on('click', function() {

            var tabName = $(this).attr('href');

            if (tabName == "#user_details_tab") {
                $('#usrPrevBtn').prop('disabled', true);
                $('#usrNextBtn').prop('disabled', false);
                $('#user_active_tab').val(tabName);
            } else if (tabName == "#office_allocation_tab") {
                $('#usrPrevBtn').prop('disabled', false);
                $('#usrNextBtn').prop('disabled', false);
                $('#user_active_tab').val(tabName);
            } else if (tabName == "#act_applicable_tab") {
                $('#usrPrevBtn').prop('disabled', false);
                $('#usrNextBtn').prop('disabled', true);
                $('#user_active_tab').val(tabName);
            } else {
                $('#usrPrevBtn').prop('disabled', true);
                $('#usrNextBtn').prop('disabled', false);
                $('#user_active_tab').val("#user_details_tab");
            }
        });

        $('.usrNavBtns').on('click', function() {

            var cliBtn = $(this).attr('id');
            var user_active_tab = $("#user_active_tab").val();

            var open_user_tab = "#user_details_tab";

            if (cliBtn == "usrPrevBtn") {
                if (user_active_tab == "#user_details_tab") {
                    open_user_tab = "#user_details_tab";
                } else if (user_active_tab == "#office_allocation_tab") {
                    open_user_tab = "#user_details_tab";
                } else {
                    open_user_tab = "#user_details_tab";
                }
            } else if (cliBtn == "usrNextBtn") {
                if (user_active_tab == "#user_details_tab") {
                    open_user_tab = "#office_allocation_tab";
                } else if (user_active_tab == "#office_allocation_tab") {
                    open_user_tab = "#act_applicable_tab";
                } else {
                    open_user_tab = "#user_details_tab";
                }
            }

            var user_active_tab_head = open_user_tab + "_head";

            $(user_active_tab_head).click();
        });
    });
</script>

<script type="text/javascript">
    function disableArticleship() {
        $('.articleship_section_div input, .articleship_section_div select, .articleship_section_div textarea').prop('disabled', true);
    }

    function disableCA() {
        $('.ca_section_div input, .ca_section_div select, .ca_section_div textarea').prop('disabled', true);
    }

    function disableGeneral() {
        $('.articleship_section_div input, .articleship_section_div select, .articleship_section_div textarea').prop('disabled', false);
        $('.ca_section_div input, .ca_section_div select, .ca_section_div textarea').prop('disabled', false);
    }
    $(document).ready(function() {

        var base_url = "<?php echo base_url(); ?>";

        $('body').on('submit', '.staff_form', function(e) {

            e.preventDefault();
            var userFormData = new FormData(this);

            $.ajax({
                url: base_url + '/add_user',
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

                    if (resStatus == true) {
                        window.location.href = base_url + "/users";
                    } else {
                        if (isExceedLimit == "true") {
                            swal("Error!", "You have exceeded the maximum limit of users :(", "error");
                        } else {
                            $.each(resUserData, function(index, value) {

                                $("#" + index).siblings('span').remove();

                                if (value != "")
                                    $("#" + index).closest('div').append('<span class="text-danger">' + value + '</span>');
                            });

                            swal("Error!", resMsg, "error");
                        }
                    }
                },
                error: function(request, error) {
                    // alert("Request: "+JSON.stringify(request));
                }
            });
        });

        $('#userStaffType').on('change', function() {
            var userStaffType = $(this).val();

            if (userStaffType == 6) {
                $('#userLoginName').val("");
                $('#userPassword').val("");

                $('#userLoginName').prop('disabled', true);
                $('#userPassword').prop('disabled', true);
            } else {
                $('#userLoginName').prop('disabled', false);
                $('#userPassword').prop('disabled', false);
            }
        });

        $('#fkUserCatId').click(function() {
            disableGeneral();
            var selectedVal = $('#fkUserCatId').val();
            if (parseInt(selectedVal) > 0) {
                var selectedText = $('#fkUserCatId option:selected').text();
                $("#fkUserCatIdLabel").text(selectedText);

                if (parseInt(selectedVal) == 1) {
                    disableCA();
                    disableArticleship();
                }
                if (parseInt(selectedVal) == 2) {
                    disableCA();
                }
                if (parseInt(selectedVal) == 3) {
                    disableArticleship();
                }
            }
        });

    });
</script>

<script type="text/javascript">
    function showUserName() {
        var userFullName = $('#userFullName').val();

        if (userFullName != "") {
            $('.userNameLabelDiv').show();
            $('.userNameLabelVal').text(userFullName);
        } else {
            $('.userNameLabelDiv').hide();
            $('.userNameLabelVal').text("");
        }
    }
</script>
<?= $this->endSection(); ?>