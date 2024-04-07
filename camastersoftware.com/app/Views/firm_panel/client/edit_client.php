
<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
    .modal-xl {
        max-width: 1295px !important;
    }
    
    #filterLabels div.col-md-6{
        font-size: 15px !important;
        font-weight: bold !important;
    }
    
    .tabcontent-border {
        border: 1px solid #bfbfbf !important;
    }
    
    td.column_date {
        font-size: 15px !important;
    }
    
    .tablepress tbody td, .tablepress tfoot th {
        border: 1px solid #015aacab !important;
        /*color: #000;*/
    }
    
    .nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
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
    
    .due_date_for_name{
        font-size: 16px !important;
        /*font-weight: 700 !important;*/
        color: #000 !important;
    }
    
    #tablepress-2 tr th {
        font-size:16px !important; 
        font-weight: 800 !important;
    }
    
    .tab_body_div .nav-item .nav-link{
        border-radius: 12px !important;
        display: inline-block !important;
        width: 80% !important;
        font-size: 18px !important;
    }
    
    .tab_body_div .nav-item .nav-link.active span{
        color: #fff !important;
    }
    
    .tab_body_div .nav-tabs .nav-link{
        margin-bottom: 20px !important;
    }
    
    .theme-primary .nav-tabs .nav-link.active {
         border-color: #F99D27 !important;
         background-color: #F99D27 !important;
         
        /*border: 2px solid #005495 !important;*/
        /*background-color: #005495 !important;*/
    }
    
    .nav-tabs{
        border: none !important;
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
    
    .tabcontent-border{
        border: none !important;
    }
    
    .due-month{
        background:#F99D27;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }
    
    .due-month label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .clientNameLabelVal{
        font-size: 27px !important;
    }

    .modal-header {
        border-bottom-color: #d5dfea;
        background-color:#F99D27;
        padding: 8px 8px;
    }

    .income-tax-head {
        background: #ffc800;
        padding:10px;
        margin-bottom:0px;
        font-weight:bold;
    }

    .tablepress td, .tablepress th {
        font-weight: 600;
    }

    td.column-1 {
        font-size:14px;
    }

    .tablepress tbody tr:first-child td {
        /*background: #ffffff;*/
    }

    .modal-header h4{
        text-align: center;
    }

    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
    }
    
    .getActModal .box{
        cursor: pointer !important;
    }

    .getCustActModal .box{
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
    
    .demo-checkbox .box-header {
        background-color: #005495 !important;
        border-radius: 10px !important;
    }
    
    .demo-checkbox .box-header.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        /*height: 50px !important;*/
        /*line-height: 29px !important;*/
        /*border: 2px solid #f99d27 !important;*/
    }
    
    .theme-primary .box-primary {
        border-radius: 10px !important;
        border: 2px solid #f99d27 !important;
        background-color: #005495 !important;
    }
    
    .demo-checkbox .box_head_cl.with-border {
        /*height: 50px !important;*/
        /*line-height: 29px !important;*/
        /*border: 2px solid #f99d27 !important;*/
        /*background-color: #005495 !important;*/
    }
    
    .actDivClass label{
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
    .actDivClass label::before{
        margin-top: 14px !important;
        margin-left: 9px !important;
    }
    
    /*.theme-primary [type="checkbox"].filled-in:checked + label::after*/
    .actDivClass label::after{
        border: 2px solid #005495 !important;
        margin-left: 10px !important;
        margin-top: 12px !important;
    }
    
    /*[type="checkbox"].filled-in:checked + label*/
    .actDivClass .filled-in:checked + label{
        border: 2px solid #f99d27 !important;
        background-color: #005495 !important;
    }
    
    .btnBorder
    {
        border-radius: 11px !important;
    }
</style>

<?php

    $clientBussOrgType=$clientData['clientBussOrganisationType'];

?>

    <!-- Main content -->
    <section class="content mt-35">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border flexbox">
                        <h4 class="box-title font-weight-bold">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right get_back">Back</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body tab_body_div card_bg_format">
                        <form action="javascript:void(0);" class="tab-wizard wizard-circle edit_client_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                        <li class="nav-item"> 
                                            <a class="nav-link active" data-toggle="tab" id="client_details_tab_head" href="#client_details_tab" role="tab" aria-controls="profile">
                                                <span class="hidden-xs-down year-color">Client Details</span>
                                            </a>
                                        </li>	
                                        <li class="nav-item"> 
                                            <a class="nav-link" data-toggle="tab" id="reg_details_tab_head" href="#reg_details_tab" role="tab" aria-controls="profile">
                                                <span class="hidden-xs-down year-color">Registration Details</span>
                                            </a>
                                        </li>	
                                        <li class="nav-item"> 
                                            <a class="nav-link" data-toggle="tab" id="act_applicable_tab_head" href="#act_applicable_tab" role="tab" aria-controls="profile">
                                                <span class="hidden-xs-down year-color">Regular Due Dates</span>
                                            </a>
                                        </li>	
                                        <li class="nav-item"> 
                                            <a class="nav-link" data-toggle="tab" id="non_regular_due_date_tab_head" href="#non_regular_due_date_tab" role="tab" aria-controls="profile">
                                                <span class="hidden-xs-down year-color">Event Based Due Dates</span>
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
                                                        
                                                        <!------------------------------------------------- Client Details - Start -------------------------------------------------->
                                                        <div class="tab-pane fade show active" id="client_details_tab" role="tabpanel" aria-labelledby="client_details_tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-4 offset-md-4">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussOrganisationType">Type of Organisation :<small class="text-danger">*</small></label>
                                                                                <select class="custom-select form-control" name="edit_clientBussOrganisationType" id="edit_clientBussOrganisationType">
                                                                                    <option value="">Select Type of Organisation</option>
                                                                                    <?php if(!empty($organisationTypes)): ?>
                                                                                        <?php foreach($organisationTypes AS $e_org): ?>
                                                                                            <option value="<?php echo $e_org['organisation_type_id']; ?>" <?php if($clientData['clientBussOrganisationType']==$e_org['organisation_type_id']): ?>selected<?php endif; ?>><?php echo $e_org['organisation_type_name']; ?></option>
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
                                                                    <div class="row business_div">
                                                                        <div class="col-md-12">
                                                                            <div class="row ind_div">
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2">
                                                                                            <div class="form-group">
                                                                                                <label for="edit_clientTitle">Title :</label>
                                                                                                <select class="custom-select form-control" name="edit_clientTitle" id="edit_clientTitle">
                                                                                                    <option value="">Select Title</option>
                                                                                                    <?php if(!empty($salutationList)): ?>
                                                                                                        <?php foreach($salutationList AS $e_sal): ?>
                                                                                                            <option value="<?php echo $e_sal['salutation_name']; ?>" <?php if($clientData['clientTitle']==$e_sal['salutation_name']): ?>selected<?php endif; ?> ><?php echo $e_sal['salutation_name']; ?></option>
                                                                                                        <?php endforeach; ?>
                                                                                                    <?php endif; ?>
                                                                                                </select> 
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <div class="form-group">
                                                                                                <label for="edit_clientName">Name of Client :</label>
                                                                                                <input type="text" class="form-control" name="edit_clientName" id="edit_clientName" placeholder="(First Name) (Middle Name) (Last Name) as per PAN" value="<?php echo $clientData['clientName']; ?>" onkeyup="setClientName(this);showClientName();" onkeydown="setClientName(this);showClientName();" onkeypress="setClientName(this);showClientName();" oninput="setClientName(this);showClientName();" onfocus="setClientName(this);showClientName();"> 
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-10">
                                                                                            <div class="form-group">
                                                                                                <label for="edit_clientGroup">Client Group:</label>
                                                                                                <select class="custom-select form-control" name="edit_clientGroup" id="edit_clientGroup">
                                                                                                    <option value="">Select Client Group</option>
                                                                                                    <?php if(!empty($groupList)): ?>
                                                                                                        <?php foreach($groupList AS $e_grp): ?>
                                                                                                            <option value="<?php echo $e_grp['client_group_id']; ?>" <?php if($clientData['clientGroup']==$e_grp['client_group_id']): ?>selected<?php endif; ?> ><?php echo $e_grp['client_group']; ?></option>
                                                                                                        <?php endforeach; ?>
                                                                                                    <?php endif; ?>
                                                                                                </select> 
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <button type="button" name="Add" class="waves-effect waves-light btn btn-sm btn-submit text-right mt-30" data-toggle="modal" data-target="#edit_addClientGrpModal">Add</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="edit_clientFatherName">Father Name:</label>
                                                                                        <input type="text" class="form-control" name="edit_clientFatherName" id="edit_clientFatherName" placeholder="Enter Father Name" value="<?php echo $clientData['clientFatherName']; ?>"> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="edit_clientSpouseName">Spouse Name :</label>
                                                                                        <input type="text" class="form-control" name="edit_clientSpouseName" id="edit_clientSpouseName" placeholder="Enter Spouse Name" value="<?php echo $clientData['clientSpouseName']; ?>"> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label for="edit_clientDob">Date of Birth :</label>
                                                                                        <?php 
                                                                                            $clientDob="";
                                                                                            if(check_valid_date($clientData['clientDob']))
                                                                                                $clientDob=date("Y-m-d", strtotime($clientData['clientDob']));
                                                                                        ?>
                                                                                        <input type="date" class="form-control" name="edit_clientDob" id="edit_clientDob" placeholder="Enter Date of Birth" value="<?php echo $clientDob; ?>"> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label for="edit_clientQualification">Qualification:</label>
                                                                                        <input type="text" class="form-control" name="edit_clientQualification" id="edit_clientQualification" placeholder="Enter Qualification" value="<?php echo $clientData['clientQualification']; ?>"> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label for="edit_clientOccupation">Occupation:</label>
                                                                                        <input type="text" class="form-control" name="edit_clientOccupation" id="edit_clientOccupation" placeholder="Enter Occupation" value="<?php echo $clientData['clientOccupation']; ?>"> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="edit_clientPersonalRemark">Remark:</label>
                                                                                        <textarea class="form-control" name="edit_clientPersonalRemark" id="edit_clientPersonalRemark" placeholder="Enter Remark" rows="1"><?php echo $clientData['clientPersonalRemark']; ?></textarea> 
                                                                                    </div>
                                                                                </div>
                                                                                <!--
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="clientBussOrganisationEmp">Organisation Name :</label>
                                                                                        <input type="text" class="form-control" name="clientBussOrganisationEmp" id="clientBussOrganisationEmp" placeholder="Enter Organisation Name (Employed With)"> 
                                                                                    </div>
                                                                                </div>
                                                                                -->
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <hr class="mt-0">
                                                                </div>
                                                                <div class="col-md-12 col-lg-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-12">
                                                                            <div class="state due-month">
                                                                                <h4 class="text-white font-weight-bold m-0">Business Details</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row buss_div">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussOrganisation">Organisation Name :</label>
                                                                                <input type="text" class="form-control" name="edit_clientBussOrganisation" id="edit_clientBussOrganisation" placeholder="Enter Organisation Name" value="<?php echo $clientData['clientBussOrganisation']; ?>"  oninput="showClientName();" onkeyup="showClientName();" onkeydown="showClientName();" onkeypress="showClientName();" onfocus="showClientName();"> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <div class="col-md-10">
                                                                                    <div class="form-group">
                                                                                        <label for="edit_clientGroup">Client Group:</label>
                                                                                        <select class="custom-select form-control" name="edit_clientGroup" id="edit_clientGroupNew">
                                                                                            <option value="">Select Client Group</option>
                                                                                            <?php if(!empty($groupList)): ?>
                                                                                                <?php foreach($groupList AS $e_grp): ?>
                                                                                                    <option value="<?php echo $e_grp['client_group_id']; ?>" <?php if($clientData['clientGroup']==$e_grp['client_group_id']): ?>selected<?php endif; ?> ><?php echo $e_grp['client_group']; ?></option>
                                                                                                <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <button type="button" name="Add" class="waves-effect waves-light btn btn-sm btn-submit text-right mt-30" id="clientGroupBtnNew" data-toggle="modal" data-target="#edit_addClientGrpModal">Add</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientTypeText">Client Type:</label>
                                                                                <input type="text" class="form-control" name="edit_clientTypeText" id="edit_clientTypeText" readonly> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <?php 
                                                                                    $clientBussIncorporationDate="";
                                                                                    if(check_valid_date($clientData['clientBussIncorporationDate']))
                                                                                        $clientBussIncorporationDate=date("Y-m-d", strtotime($clientData['clientBussIncorporationDate']));
                                                                                ?>
                                                                                <label for="edit_clientBussIncorporationDate">Date of Incorpn/Regn :</label>
                                                                                <input type="date" class="form-control" name="edit_clientBussIncorporationDate" id="edit_clientBussIncorporationDate" value="<?php echo $clientBussIncorporationDate; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussNature">Nature of Business :</label>
                                                                                <input type="text" class="form-control" name="edit_clientBussNature" id="edit_clientBussNature" placeholder="Enter Nature of Business" value="<?php echo $clientData['clientBussNature']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussWebsite">Website URL :</label>
                                                                                <input type="text" class="form-control" name="edit_clientBussWebsite" id="edit_clientBussWebsite" placeholder="Enter Website URL" value="<?php echo $clientData['clientBussWebsite']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussRemark">Remark:</label>
                                                                                <textarea class="form-control" name="edit_clientBussRemark" id="edit_clientBussRemark" placeholder="Enter Remark" rows="1"><?php echo $clientData['clientBussRemark']; ?></textarea> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--
                                                                    <div class="row photo_div">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Upload Photo/Logo: </label>
                                                                                <label class="file">
                                                                                    <input type="file" name="clientProfileImg" id="clientProfileImg">
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    -->
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
                                                                <div class="col-md-12 contact_div">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientContactPerson">Contact Person Name :</label>
                                                                                <input type="text" class="form-control" name="clientContactPerson" id="clientContactPerson" placeholder="Enter Contact Person Name" value="<?php echo $clientData['clientContactPerson']; ?>" <?php if($clientBussOrgType==9 || $clientBussOrgType==8 || $clientBussOrgType==3): ?>readonly<?php endif; ?>> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientContactDesgtn">Contact Person Designation :</label>
                                                                                <input type="text" class="form-control" name="edit_clientContactDesgtn" id="edit_clientContactDesgtn" placeholder="Enter Contact Person Designation" value="<?php echo $clientData['clientContactDesgtn']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussMobile1">Mobile 1 :</label>
                                                                                <input type="tel" class="form-control" name="edit_clientBussMobile1" id="edit_clientBussMobile1" placeholder="Enter Mobile 1" value="<?php echo $clientData['clientBussMobile1']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussMobile2">Mobile 2 :</label>
                                                                                <input type="tel" class="form-control" name="edit_clientBussMobile2" id="edit_clientBussMobile2" placeholder="Enter Mobile 2" value="<?php echo $clientData['clientBussMobile2']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussEmail1">Email 1 :</label>
                                                                                <input type="email" class="form-control" name="edit_clientBussEmail1" id="edit_clientBussEmail1" placeholder="Enter Email 1" value="<?php echo $clientData['clientBussEmail1']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussEmail2">Email 2 :</label>
                                                                                <input type="email" class="form-control" name="edit_clientBussEmail2" id="edit_clientBussEmail2" placeholder="Enter Email 2" value="<?php echo $clientData['clientBussEmail2']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientResidentialAddress">Residential Address:</label>
                                                                                <input type="text" class="form-control" name="edit_clientResidentialAddress" id="edit_clientResidentialAddress" placeholder="Enter Residential Address" value="<?php echo $clientData['clientResidentialAddress']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussResidencePhone">Residence Phone :</label>
                                                                                <input type="tel" class="form-control" name="edit_clientBussResidencePhone" id="edit_clientBussResidencePhone" placeholder="Enter Residence Phone" value="<?php echo $clientData['clientBussResidencePhone']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussOfficeAddress">Office Address :</label>
                                                                                <input type="text" class="form-control" name="edit_clientBussOfficeAddress" id="edit_clientBussOfficeAddress" placeholder="Enter Office Address" value="<?php echo $clientData['clientBussOfficeAddress']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussOfficePhone1">Office Phone Number :</label>
                                                                                <input type="tel" class="form-control" name="edit_clientBussOfficePhone1" id="edit_clientBussOfficePhone1" placeholder="Enter Office Phone Number" value="<?php echo $clientData['clientBussOfficePhone1']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussRegisteredAddress">Registered Office Address :</label>
                                                                                <input type="text" class="form-control" name="edit_clientBussRegisteredAddress" id="edit_clientBussRegisteredAddress" placeholder="Enter Registered Address" value="<?php echo $clientData['clientBussRegisteredAddress']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussOfficePhone2">Registered Office Phone No :</label>
                                                                                <input type="tel" class="form-control" name="edit_clientBussOfficePhone2" id="edit_clientBussOfficePhone2" placeholder="Enter Registered Office Phone No" value="<?php echo $clientData['clientBussOfficePhone2']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussFactoryAddress">Factory Address :</label>
                                                                                <input type="text" class="form-control" name="edit_clientBussFactoryAddress" id="edit_clientBussFactoryAddress" placeholder="Enter Factory Address" value="<?php echo $clientData['clientBussFactoryAddress']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientBussFactoryPhone">Factory Phone Number :</label>
                                                                                <input type="tel" class="form-control" name="edit_clientBussFactoryPhone" id="edit_clientBussFactoryPhone" placeholder="Enter Factory Phone Number" value="<?php echo $clientData['clientBussFactoryPhone']; ?>"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="edit_clientContactRemark">Remark:</label>
                                                                                <textarea class="form-control" name="edit_clientContactRemark" id="edit_clientContactRemark" placeholder="Enter Remark" rows="1"><?php echo $clientData['clientContactRemark']; ?></textarea> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--
                                                                <div class="col-md-12 hide">
                                                                    <div class="row" id="client_grp_row">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="clientGroup">Client Group:</label>
                                                                                <select class="custom-select form-control" name="clientGroup" id="clientGroup">
                                                                                    <option value="">Select Client Group</option>
                                                                                    <?php //if(!empty($groupList)): ?>
                                                                                        <?php //foreach($groupList AS $e_grp): ?>
                                                                                            <option value="<?php //echo $e_grp['client_group_id']; ?>"><?php //echo $e_grp['client_group']; ?></option>
                                                                                        <?php //endforeach; ?>
                                                                                    <?php //endif; ?>
                                                                                </select> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1"></div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="clientCostCenter">Cost Center:</label>
                                                                                <input type="text" class="form-control" name="clientCostCenter" id="clientCostCenter">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1"></div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label for="clientCategory">Category:</label>
                                                                                <input type="text" class="form-control" name="clientCategory" id="clientCategory"> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 text-right">
                                                                            <button type="button" name="Add" class="waves-effect waves-light btn btn-sm btn-submit text-right mt-30" data-toggle="modal" data-target="#addClientGrpModal">Add Client Group</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                -->
                                                            </div>
                                                        </div>
                                                        <!------------------------------------------------- Client Details - End ---------------------------------------------------->
                                                        
                                                        
                                                        <!------------------------------------------------- Registration Details - Start ----------------------------------------------->
                                                        <div class="tab-pane fade" id="reg_details_tab" role="tabpanel" aria-labelledby="reg_details_tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row clientNameLabelDiv">
                                                                        <div class="col-md-12 text-center">
                                                                            <span class="font-weight-bold clientNameLabelVal"></span>
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
                                                                                <h4 class="text-white font-weight-bold m-0">Registration Details</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                <div class="col-md-12 edit_register_div_1 text-center"></div>
                                                                <div class="col-md-12">
                                                                    <div class="row form-group">
                                                                        <div class="col-md-4 edit_register_div">
                                                                            <div class="row form-group">
                                                                                <div class="col-md-8">
                                                                                    <div class="form-group">
                                                                                        <label class="edit_register_label font-weight-bold" style="font-size:17px;">N/A</label>
                                                                                        <input type="text" class="form-control" id="edit_clientRegDocumentLabel" placeholder="" value="<?php echo $clientData['clientRegDocument']; ?>" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <button type="button" class="waves-effect waves-light btn btn-sm btn-submit text-right mt-30" data-toggle="modal" data-target="#addClientDocModalClientReg">Fill</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div id="addClientDocModalClientReg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h4 class="modal-title" id="myModalLabel">Update <span class="edit_register_label"></span></h4>
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label for="edit_clientRegDocument" class="edit_register_label font-weight-bold" style="font-size:17px;">N/A</label>
                                                                                                                <input type="text" class="form-control clientDocInput" name="edit_clientRegDocument" id="edit_clientRegDocument" placeholder="" value="<?php echo $clientData['clientRegDocument']; ?>">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label for="edit_clientRegDocumentFile">Document File :</label>
                                                                                                                <input type="file" name="edit_clientRegDocumentFile" id="edit_clientRegDocumentFile"> 
                                                                                                                <input type="hidden" name="edit_clientRegDocumentOldFile" value="<?php echo $clientData['clientRegDocument']; ?>" >
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <?php
                                                                                                                    $client_document_issue_date="";
                                                                                                                    if(check_valid_date($clientData['clientRegDocumentIssueDate']))
                                                                                                                        $client_document_issue_date=date("Y-m-d", strtotime($clientData['clientRegDocumentIssueDate']));
                                                                                                                ?>
                                                                                                                <label for="edit_clientRegDocumentIssueDate">Issue Date:</label>
                                                                                                                <input type="date" class="form-control" name="edit_clientRegDocumentIssueDate" id="edit_clientRegDocumentIssueDate" value="<?php echo $client_document_issue_date; ?>"> 
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <?php
                                                                                                                    $client_document_effective_date="";
                                                                                                                    if(check_valid_date($clientData['clientRegDocumentEffectiveDate']))
                                                                                                                        $client_document_effective_date=date("Y-m-d", strtotime($clientData['clientRegDocumentEffectiveDate']));
                                                                                                                ?>
                                                                                                                <label for="edit_clientRegDocumentEffectiveDate">Effective Date :</label>
                                                                                                                <input type="date" class="form-control" name="edit_clientRegDocumentEffectiveDate" id="edit_clientRegDocumentEffectiveDate" value="<?php echo $client_document_effective_date; ?>"> 
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label for="edit_clientRegDocumentMobile">Mobile No :</label>
                                                                                                                <input type="text" class="form-control" name="edit_clientRegDocumentMobile" id="edit_clientRegDocumentMobile" placeholder="Enter Mobile No" value="<?php echo $clientData['clientRegDocumentMobile']; ?>"> 
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label for="edit_clientRegDocumentEmail">Email Address :</label>
                                                                                                                <input type="text" class="form-control" name="edit_clientRegDocumentEmail" id="edit_clientRegDocumentEmail" placeholder="Enter Email Address" value="<?php echo $clientData['clientRegDocumentEmail']; ?>">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label for="edit_clientRegDocumentAddress">Address:</label>
                                                                                                                <textarea class="form-control" name="edit_clientRegDocumentAddress" id="edit_clientRegDocumentAddress" placeholder="Enter Address" rows="2"><?php echo $clientData['clientRegDocumentAddress']; ?></textarea> 
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label for="edit_clientRegDocumentRemark">Remark:</label>
                                                                                                                <textarea class="form-control" name="edit_clientRegDocumentRemark" id="edit_clientRegDocumentRemark" placeholder="Enter Remark" rows="2"><?php echo $clientData['clientRegDocumentRemark']; ?></textarea> 
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="modal-footer text-right" style="width: 100%;">
                                                                                                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                                                                                                    <button type="button" name="button" class="btn btn-success text-left" data-dismiss="modal">Submit</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- /.modal-content -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php if(!empty($documentList)): ?>
                                                                            <?php foreach($documentList AS $e_doc): ?>
                                                                            <?php $cli_doc_id=$e_doc['client_document_id']; ?>
                                                                            <?php $cli_doc_name=$e_doc['client_document_name']; ?>
                                                                            <div class="col-md-4" data-id="<?php echo $cli_doc_id; ?>">
                                                                                <div class="row form-group">
                                                                                    <div class="col-md-8">
                                                                                        <div class="form-group">
                                                                                            <?php
                                                                                                $client_document_number="";
                                                                                                if(isset($clientDocDataArr[$cli_doc_id]['client_document_number']))
                                                                                                    $client_document_number=$clientDocDataArr[$cli_doc_id]['client_document_number'];
                                                                                            ?>
                                                                                            <label><?php echo $e_doc['client_document_name']; ?>:</label>
                                                                                            <input type="text" class="form-control" id="edit_docName<?php echo $cli_doc_id; ?>Label" placeholder="Enter <?php echo $e_doc['client_document_name']; ?>" value="<?php echo $client_document_number; ?>" readonly > 
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit text-right mt-30" data-toggle="modal" data-target="#addClientDocModal<?php echo $cli_doc_id; ?>">Fill</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div id="addClientDocModal<?php echo $cli_doc_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                            <div class="modal-dialog">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h4 class="modal-title" id="myModalLabel">Update <?= $cli_doc_name; ?> Details</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <?php
                                                                                                                        $client_document_number="";
                                                                                                                        if(isset($clientDocDataArr[$cli_doc_id]['client_document_number']))
                                                                                                                            $client_document_number=$clientDocDataArr[$cli_doc_id]['client_document_number'];
                                                                                                                    ?>
                                                                                                                    <label for="edit_docName<?php echo $cli_doc_id; ?>"><?php echo $e_doc['client_document_name']; ?>:</label>
                                                                                                                    <input type="text" class="form-control clientDocInput" name="edit_client_document_number[]" id="edit_docName<?php echo $cli_doc_id; ?>" placeholder="Enter <?php echo $e_doc['client_document_name']; ?>" value="<?php echo $client_document_number; ?>"> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <?php
                                                                                                                        $client_document_file="";
                                                                                                                        if(isset($clientDocDataArr[$cli_doc_id]['client_document_file']))
                                                                                                                            $client_document_file=$clientDocDataArr[$cli_doc_id]['client_document_file'];
                                                                                                                    ?>
                                                                                                                    <label for="edit_docFile<?php echo $cli_doc_id; ?>">Document :</label>
                                                                                                                    <input type="file" name="edit_client_document_file_<?php echo $cli_doc_id; ?>" id="edit_docFile<?php echo $cli_doc_id; ?>">
                                                                                                                    <input type="hidden" name="edit_client_document_old_file_<?php echo $cli_doc_id; ?>" value="<?php echo $client_document_file; ?>">
                                                                                                                    <input type="hidden" name="edit_client_document_id[]" value="<?php echo $cli_doc_id; ?>">  
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <?php
                                                                                                                        $client_document_issue_date="";
                                                                                                                        if(isset($clientDocDataArr[$cli_doc_id]['client_document_issue_date']))
                                                                                                                        {
                                                                                                                            if(check_valid_date($clientDocDataArr[$cli_doc_id]['client_document_issue_date']))
                                                                                                                                $client_document_issue_date=date("Y-m-d", strtotime($clientDocDataArr[$cli_doc_id]['client_document_issue_date']));
                                                                                                                        }
                                                                                                                    ?>
                                                                                                                    <label for="edit_docIssueDate<?php echo $cli_doc_id; ?>">Issue Date :</label>
                                                                                                                    <input type="date" class="form-control" name="edit_client_document_issue_date[]" id="edit_docIssueDate<?php echo $cli_doc_id; ?>" value="<?php echo $client_document_issue_date; ?>"> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <?php
                                                                                                                        $client_document_effective_date="";
                                                                                                                        if(isset($clientDocDataArr[$cli_doc_id]['client_document_effective_date']))
                                                                                                                        {
                                                                                                                            if(check_valid_date($clientDocDataArr[$cli_doc_id]['client_document_effective_date']))
                                                                                                                                $client_document_effective_date=date("Y-m-d", strtotime($clientDocDataArr[$cli_doc_id]['client_document_effective_date']));
                                                                                                                        }
                                                                                                                    ?>
                                                                                                                    <label for="edit_docEffectiveDate<?php echo $cli_doc_id; ?>">Effective Date :</label>
                                                                                                                    <input type="date" class="form-control" name="edit_client_document_effective_date[]" id="edit_docEffectiveDate<?php echo $cli_doc_id; ?>" value="<?php echo $client_document_effective_date; ?>"> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <?php
                                                                                                                        $client_document_mobile="";
                                                                                                                        if(isset($clientDocDataArr[$cli_doc_id]['client_document_mobile']))
                                                                                                                            $client_document_mobile=$clientDocDataArr[$cli_doc_id]['client_document_mobile'];
                                                                                                                    ?>
                                                                                                                    <label for="edit_docMobileNo<?php echo $cli_doc_id; ?>">Mobile No :</label>
                                                                                                                    <input type="text" class="form-control" name="edit_client_document_mobile[]" id="edit_docMobileNo<?php echo $cli_doc_id; ?>" placeholder="Enter Mobile No" value="<?php echo $client_document_mobile; ?>"> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <?php
                                                                                                                        $client_document_email="";
                                                                                                                        if(isset($clientDocDataArr[$cli_doc_id]['client_document_email']))
                                                                                                                            $client_document_email=$clientDocDataArr[$cli_doc_id]['client_document_email'];
                                                                                                                    ?>
                                                                                                                    <label for="edit_docEmail<?php echo $cli_doc_id; ?>">Email Address :</label>
                                                                                                                    <input type="text" class="form-control" name="edit_client_document_email[]" id="edit_docEmail<?php echo $cli_doc_id; ?>" placeholder="Enter Email Address" value="<?php echo $client_document_email; ?>">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-12">
                                                                                                                <div class="form-group">
                                                                                                                    <?php
                                                                                                                        $client_document_address="";
                                                                                                                        if(isset($clientDocDataArr[$cli_doc_id]['client_document_address']))
                                                                                                                            $client_document_address=$clientDocDataArr[$cli_doc_id]['client_document_address'];
                                                                                                                    ?>
                                                                                                                    <label for="edit_docAddress<?php echo $cli_doc_id; ?>">Address:</label>
                                                                                                                    <textarea class="form-control" name="edit_client_document_address[]" id="edit_docAddress<?php echo $cli_doc_id; ?>" placeholder="Enter Address" rows="2"><?php echo $client_document_address; ?></textarea> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-12">
                                                                                                                <div class="form-group">
                                                                                                                    <?php
                                                                                                                        $client_document_remark="";
                                                                                                                        if(isset($clientDocDataArr[$cli_doc_id]['client_document_remark']))
                                                                                                                            $client_document_remark=$clientDocDataArr[$cli_doc_id]['client_document_remark'];
                                                                                                                    ?>
                                                                                                                    <label for="edit_docRemark<?php echo $cli_doc_id; ?>">Remark:</label>
                                                                                                                    <textarea class="form-control" name="edit_client_document_remark[]" id="edit_docRemark<?php echo $cli_doc_id; ?>" placeholder="Enter Remark" rows="2"><?php echo $client_document_remark; ?></textarea> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="modal-footer text-right" style="width: 100%;">
                                                                                                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                                                                                                        <button type="button" name="button" class="btn btn-success text-left" data-dismiss="modal">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- /.modal-content -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>     
                                                        </div>
                                                        <!------------------------------------------------- Registration Details - End -------------------------------------------------->
                                                        
                                                        
                                                        <!--------------------------------------------------- Act Applicable - Start ---------------------------------------------------->
                                                        <div class="tab-pane fade" id="act_applicable_tab" role="tabpanel" aria-labelledby="act_applicable_tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row clientNameLabelDiv">
                                                                        <div class="col-md-12 text-center">
                                                                            <span class="font-weight-bold clientNameLabelVal"></span>
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
                                                                                <h4 class="text-white font-weight-bold m-0">Select Regular Due Dates</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-right mb-10">
                                                                            <a href="<?php echo base_url('mth_tax_calendar'); ?>" target="_blank">
                                                                                <button type="button" class="btn btn-sm btn-submit btnBorder" >Tax Calendar</button>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="demo-checkbox mb-10 actDivClass">
                                                                                <div class="row">
                                                                                    <?php if(!empty($actList)): ?>
                                                                                        <?php foreach($actList AS $e_act): ?>
                                                                                            <div class="col-md-4">
                                                                                                <!-- <input type="checkbox" name='edit_actId[]' id="edit_actId<?php //echo $e_act['act_id']; ?>" class="filled-in edit_acts_checkbox" value="<?php //echo $e_act['act_id']; ?>" <?php //if(in_array($e_act['act_id'], $clientActArr)): ?>checked<?php //endif; ?> <?php //if(in_array($e_act['act_id'], $workActArr)): ?>disabled<?php //endif; ?> /> -->
                                                                                                <input type="checkbox" name='edit_actId[]' id="edit_actId<?php echo $e_act['act_id']; ?>" class="filled-in edit_acts_checkbox" value="<?php echo $e_act['act_id']; ?>" data-act_name="<?php echo $e_act['act_name']; ?>" <?php if(in_array($e_act['act_id'], $workActArr)): ?>checked<?php endif; ?> <?php if(in_array($e_act['act_id'], $workActArr)): ?>disabled<?php endif; ?> />
                                                                                                <label for="edit_actId<?php echo $e_act['act_id']; ?>" ><?php echo $e_act['act_name']; ?></label>	
                                                                                            </div>
                                                                                        <?php endforeach; ?>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-12">
                                                                            <div class="state due-month">
                                                                                <h4 class="text-white font-weight-bold m-0">Allocate/Manage Due Dates</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="demo-checkbox">
                                                                        <div class="row text-center edit_selected_acts_div">
                                                                            <div class="col-md-12">
                                                                                <h4>Acts not selected</h4>
                                                                            </div>	
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row sel_act_due_date">
                                                                <?php if(!empty($workActs)): ?>
                                                                    <?php foreach($workActs AS $k_act_id=>$e_act_name): ?>
                                                                        <div class="col-lg-12 col-md-12">
                                                                            <h4 class="income-tax-head text-center"><?php echo $e_act_name; ?></h4>
                                                                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer allot_due_date">
                                                                                <thead>
                                                                                    <tr class="row-1">
                                                                                        <th class="column-1">Due Date For</th>
                                                                                        <th class="column-2">Tax Payer</th>
                                                                                        <th class="column-3">Section</th>
                                                                                        <th class="column-4">Form</th>
                                                                                        <th class="column-5">Periodicity</th>
                                                                                        <th class="column-6">Period</th>
                                                                                        <th class="column-7">Due Date</th>
                                                                                        <th class="column-8">Note</th>
                                                                                        <th class="column-9">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="row-hover">
                                                                                <?php
                                                                                    if(isset($workActListArr[$k_act_id]))
                                                                                        $actsListArr=$workActListArr[$k_act_id];
                                                                                    else
                                                                                        $actsListArr=array();
                                                                                ?>
                                                                                <?php if(!empty($actsListArr)): ?>
                                                                                    <?php foreach($actsListArr AS $k_row=>$e_row): ?>
                                                                                        <tr class="row-3 row_<?php echo $k_act_id.$k_row.$e_row['due_date_id']; ?>" style="background-color:#f6fbff;">
                                                                                            <td class="column-1 text-left pl-25" style="width: 26% !important;">
                                                                                                <?php 
                                                                                                    if(!empty($e_row['act_option_name1']))
                                                                                                    {
                                                                                                        $ddfValue=$e_row['act_option_name1'];
                                                                                                        
                                                                                                        if(strlen($e_row['act_option_name1'])>30)
                                                                                                            $ddfVal=substr($e_row['act_option_name1'], 0, 30)."...";
                                                                                                        else
                                                                                                            $ddfVal=$e_row['act_option_name1'];
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                        $ddfValue=$ddfVal="N/A";
                                                                                                    }
                                                                                                ?>
                                                                                                <span data-toggle="tooltip" data-original-title="<?= $ddfValue; ?>" style="cursor: pointer;">
                                                                                                    <?= $ddfVal;  ?>
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="column-2 text-center" style="width: 20% !important;">
                                                                                                <?php 
                                                                                                    if(!empty($e_row['tax_payer_val']))
                                                                                                        echo $e_row['tax_payer_val']; 
                                                                                                    else
                                                                                                        echo "N/A"; 
                                                                                                ?>
                                                                                            </td>
                                                                                            <td class="column-3 text-center" style="width: 10% !important;" nowrap>
                                                                                                <?php 
                                                                                                    if(!empty($e_row['act_option_name3']))
                                                                                                        echo $e_row['act_option_name3']; 
                                                                                                    else
                                                                                                        echo "N/A"; 
                                                                                                ?>
                                                                                            </td>
                                                                                            <td class="column-4 text-center" style="width: 7% !important;" nowrap>
                                                                                                <?php 
                                                                                                    if(!empty($e_row['act_option_name5']))
                                                                                                        echo $e_row['act_option_name5']; 
                                                                                                    else
                                                                                                        echo "N/A"; 
                                                                                                ?>
                                                                                            </td>
                                                                                            <td class="column-5 text-center" style="width: 5% !important;" nowrap>
                                                                                                <?php 
                                                                                                    if($e_row['periodicity']=="1")
                                                                                                    {
                                                                                                        echo "Daily";
                                                                                                    }
                                                                                                    elseif($e_row['periodicity']=="2")
                                                                                                    {
                                                                                                        echo "Monthly";
                                                                                                    }
                                                                                                    elseif($e_row['periodicity']=="3")
                                                                                                    {
                                                                                                        echo "Quaterly";
                                                                                                    }
                                                                                                    elseif($e_row['periodicity']=="4")
                                                                                                    {
                                                                                                        echo "Half Yearly";
                                                                                                    }
                                                                                                    elseif($e_row['periodicity']=="5")
                                                                                                    {
                                                                                                        echo "Annually";
                                                                                                    }
                                                                                                ?>
                                                                                            </td>
                                                                                            <td class="column-6 text-center" style="width: 17% !important;" nowrap>
                                                                                                <?php 
                                                                                                    if($e_row['periodicity']=="1")
                                                                                                    {
                                                                                                        echo date("d-M-Y", strtotime($e_row["daily_date"]));
                                                                                                    }
                                                                                                    elseif($e_row['periodicity']=="2")
                                                                                                    {
                                                                                                        echo date("M", strtotime("2021-".$e_row["period_month"]."-01"))."-".$e_row["period_year"];
                                                                                                    }
                                                                                                    elseif($e_row['periodicity']>="3")
                                                                                                    {
                                                                                                        echo date("M", strtotime("2021-".$e_row["f_period_month"]."-01"))."-".$e_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_row["t_period_month"]."-01"))."-".$e_row["t_period_year"];
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                        echo "N/A";
                                                                                                    }
                                                                                                ?>
                                                                                            </td>
                                                                                            <td class="column-7 text-center" style="width: 5% !important;" nowrap><?php echo date('d-m-Y', strtotime($e_row['extended_date'])); ?></td>
                                                                                            <td class="column-8 text-center" style="width: 5% !important;" nowrap>
                                                                                                
                                                                                                <input type="hidden" name="actIdValue[]" value="<?php echo $k_act_id; ?>">
                                                                                                <input type="hidden" name="due_date_for[]" value="<?php echo $e_row['due_date_for']; ?>">
                                                                                                <input type="hidden" name="due_date_id[]" value="<?php echo $e_row['due_date_id']; ?>">
                                                                                                
                                                                                                <?php if($e_row['periodicity']=="2"): ?>
                                                                                                    <input type="hidden" name="actFMth[]" value="<?php echo $e_row["period_month"]; ?>">
                                                                                                    <input type="hidden" name="actFYr[]" value="<?php echo $e_row["period_year"]; ?>">
                                                                                                    <input type="hidden" name="actTMth[]" value="">
                                                                                                    <input type="hidden" name="actTYr[]" value="">
                                                                                                <?php elseif($e_row['periodicity']>="3"): ?>
                                                                                                    <input type="hidden" name="actFMth[]" value="<?php echo $e_row["f_period_month"]; ?>">
                                                                                                    <input type="hidden" name="actFYr[]" value="<?php echo $e_row["f_period_year"]; ?>">
                                                                                                    <input type="hidden" name="actTMth[]" value="<?php echo $e_row["t_period_month"]; ?>">
                                                                                                    <input type="hidden" name="actTYr[]" value="<?php echo $e_row["t_period_year"]; ?>">
                                                                                                <?php else: ?>
                                                                                                    <input type="hidden" name="actFMth[]" value="">
                                                                                                    <input type="hidden" name="actFYr[]" value="">
                                                                                                    <input type="hidden" name="actTMth[]" value="">
                                                                                                    <input type="hidden" name="actTYr[]" value="">
                                                                                                <?php endif; ?>
                                                                                                
                                                                                                <button type="button" class="waves-effect waves-light btn btn-sm btn-submit mb-5" data-toggle="modal" data-target="#modal_view<?php echo $k_act_id.$k_row; ?>">
                                                                                                    Note
                                                                                                </button>
                                
                                                                                                <!-- Modal -->
                                                                                                <div class="modal center-modal fade" id="modal_view<?php echo $k_act_id.$k_row; ?>" tabindex="-1">
                                                                                                    <div class="modal-dialog">
                                                                                                        <div class="modal-content">
                                                                                                            <div class="modal-header">
                                                                                                                <h5 class="modal-title">Acts Details</h5>
                                                                                                                <button type="button" class="close" data-dismiss="modal">
                                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                                </button>
                                                                                                            </div>
                                                                                                            <div class="modal-body">
                                                                                                                <p><?php echo $e_row['due_notes']; ?></p>
                                                                                                            </div>
                                                                                                            <div class="modal-footer modal-footer-uniform text-right">
                                                                                                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- /.modal -->
                                                                                            </td>
                                                                                            <td class="column-9 text-center" style="width: 5% !important;" nowrap>
                                                                                                <a href="javascript:void(0);" class="delete_due_date" data-id="<?php echo $k_act_id.$k_row.$e_row['due_date_id']; ?>" data-due="<?php echo $e_row['due_date_id']; ?>" data-client="<?php echo $clientId; ?>" data-act="<?= $k_act_id; ?>" data-orgtype="<?= $clientBussOrganisationType; ?>">
                                                                                                    <i class="fa fa-trash fa-1x text-danger" style="font-size: 20px !important;"></i>
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php endforeach; ?>
                                                                                    <?php else: ?>
                                                                                        <tr>
                                                                                            <td colspan="9"><center>No Records</center></td>
                                                                                        </tr>
                                                                                    <?php endif; ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <!----------------------------------------------------- Act Applicable - End ---------------------------------------------------->
                                                        
                                                        <!------------------------------------------------ Non-Regular Due Dates - Start ------------------------------------------------>
                                                        <div class="tab-pane fade" id="non_regular_due_date_tab" role="tabpanel" aria-labelledby="non_regular_due_date_tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row clientNameLabelDiv">
                                                                        <div class="col-md-12 text-center">
                                                                            <span class="font-weight-bold clientNameLabelVal"></span>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-lg-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-12">
                                                                            <div class="state sec_heading">
                                                                                <h4 class="text-white font-weight-bold m-0">Create Event Based Due Dates</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                <div class="col-md-12 col-lg-12">
                                                                    <div class="demo-checkbox mb-10 actDivClass">
                                                                        <div class="row">
                                                                            <?php if(!empty($actList)): ?>
                                                                                <?php foreach($actList AS $e_act): ?>
                                                                                    <div class="col-md-4">
                                                                                        <input type="checkbox" name='edit_cust_actId[]' id="edit_cust_actId<?php echo $e_act['act_id']; ?>" class="filled-in edit_cust_acts_checkbox" value="<?php echo $e_act['act_id']; ?>" data-act_name="<?php echo $e_act['act_name']; ?>" />
                                                                                        <label for="edit_cust_actId<?php echo $e_act['act_id']; ?>" ><?php echo $e_act['act_name']; ?></label>	
                                                                                    </div>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-12">
                                                                            <div class="state due-month">
                                                                                <h4 class="text-white font-weight-bold m-0">Allocate/Manage Due Dates</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="demo-checkbox">
                                                                        <div class="row text-center edit_selected_cust_acts_div">
                                                                            <div class="col-md-12">
                                                                                <h4>Acts not selected</h4>
                                                                            </div>	
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row sel_cust_act_due_date">
                                                            </div>
                                                        </div>
                                                        <!------------------------------------------------ Non-Regular Due Dates - End ------------------------------------------------>
                                                    </div>
                                                </div>
                                                <div class="offset-md-4 offset-lg-4 col-md-4 col-lg-4 text-center">
                                                    <input type="hidden" name="clientId" value="<?php echo $clientId; ?>">
                                                    <input type="hidden" id="client_active_tab" value="" />
                                                    <input type="hidden" name="due_state" value="12" />
                                                    <button type="button" class="waves-effect waves-light btn btn-submit text-right cliNavBtns" id="cliPrevBtn">Previous</button>
                                                    <button type="button" class="waves-effect waves-light btn btn-submit text-right cliNavBtns" id="cliNextBtn">Next</button>
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
    

    <div id="edit_addClientGrpModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" id="edit_add_client_group_form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Client Group</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Client Group<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="mclient_group" id="mclient_group" placeholder="Client Group">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Group Number<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" placeholder="Group Number" name="mgroup_number" id="mgroup_number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    
    <div class="modal fade actsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="actFormDiv"></div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade custActsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="POST" id="custActWiseForm">
                    <div class="modal-header">
                        <h4 class="modal-title selectedCustActTitle"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="due_date_for">Due Date For:</label><br>
                                            <input type="text" class="form-control" name="due_date_for" id="due_date_for" placeholder="Enter Due Date For">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="applicable_form">Applicable Form:</label><br>
                                            <input type="text" class="form-control" name="applicable_form" id="applicable_form" placeholder="Enter Applicable Form">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="under_section">Under Section:</label><br>
                                            <input type="text" class="form-control" name="under_section" id="under_section" placeholder="Enter Under Section">
                                        </div>
                                    </div>
                                    <div class="col-md-6 hide">
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
                                    <div class="col-md-6 hide" id="period_div">
                                        <div class="form-group">
                                            <label for="period_label">Period:</label>
                                            <div id="daily_div">
                                                <input type="date" class="form-control" name="daily_date" id="period_daily">
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
                                            <label for="event_date">Date of Event:</label><br>
                                            <input type="date" class="form-control" name="event_date" id="event_date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="due_date">Due Date:</label><br>
                                            <input type="date" class="form-control" name="due_date" id="due_date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="doc_file">Document : <small class="text-danger">(Only pdf is accepted)</small></label><br>
                                            <input type="file" class="form-control" name="doc_file" id="doc_file">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="due_notes">Notes:</label>
                                            <div id="ckeditor_textarea"></div>
                                            <textarea name="due_notes" id="due_notes" class="form-control textarea_input hide" rows="20" placeholder="Enter Notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="due_act" id="due_act" value="" />
                        <input type="hidden" name="due_act_name" id="due_act_name" class="selectedCustActInput" value="" />
                        <input type="hidden" name="due_state" value="12" />
                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-success text-left submitCustActData">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <script type="text/javascript">
            
        var cli_pt=1;
    
        $(document).ready(function(){
            
            $('.clientNameLabelDiv').hide();
            
            $('#client_active_tab').val("#client_details_tab");
            $('#cliPrevBtn').prop('disabled', true);
            $('#cliNextBtn').prop('disabled', false);
            
            $('.edit_client_form .nav-link').on('click', function(){
                
                var tabName = $(this).attr('href');
                
                if(tabName=="#client_details_tab")
                {
                    $('#cliPrevBtn').prop('disabled', true);
                    $('#cliNextBtn').prop('disabled', false);
                    $('#client_active_tab').val(tabName);
                }
                else if(tabName=="#reg_details_tab")
                {
                    $('#cliPrevBtn').prop('disabled', false);
                    $('#cliNextBtn').prop('disabled', false);
                    $('#client_active_tab').val(tabName);
                }
                else if(tabName=="#act_applicable_tab")
                {
                    $('#cliPrevBtn').prop('disabled', false);
                    $('#cliNextBtn').prop('disabled', true);
                    $('#client_active_tab').val(tabName);
                }
                else if(tabName=="#non_regular_due_date_tab")
                {
                    $('#cliPrevBtn').prop('disabled', false);
                    $('#cliNextBtn').prop('disabled', true);
                    $('#client_active_tab').val(tabName);
                }
                else
                {
                    $('#cliPrevBtn').prop('disabled', true);
                    $('#cliNextBtn').prop('disabled', false);
                    $('#client_active_tab').val("#client_details_tab");
                }
            });
            
            $('.cliNavBtns').on('click', function(){
                
                var cliBtn = $(this).attr('id');
                var client_active_tab = $("#client_active_tab").val();
                
                var open_client_tab = "#client_details_tab";
                
                if(cliBtn=="cliPrevBtn")
                {
                    if(client_active_tab=="#client_details_tab")
                    {
                        open_client_tab = "#client_details_tab";
                    }
                    else if(client_active_tab=="#reg_details_tab")
                    {
                        open_client_tab = "#client_details_tab";
                    }
                    else if(client_active_tab=="#act_applicable_tab")
                    {
                        open_client_tab = "#reg_details_tab";
                    }
                    else if(client_active_tab=="#non_regular_due_date_tab")
                    {
                        open_client_tab = "#act_applicable_tab";
                    }
                    else
                    {
                        open_client_tab = "#client_details_tab";
                    }
                }
                else if(cliBtn=="cliNextBtn")
                {
                    if(client_active_tab=="#client_details_tab")
                    {
                        open_client_tab = "#reg_details_tab";
                    }
                    else if(client_active_tab=="#reg_details_tab")
                    {
                        open_client_tab = "#act_applicable_tab";
                    }
                    else if(client_active_tab=="#act_applicable_tab")
                    {
                        open_client_tab = "#non_regular_due_date_tab";
                    }
                    else if(client_active_tab=="#non_regular_due_date_tab")
                    {
                        open_client_tab = "#client_details_tab";
                    }
                    else
                    {
                        open_client_tab = "#client_details_tab";
                    }
                }
                
                var client_active_tab_head = open_client_tab+"_head";
                
                $(client_active_tab_head).click();
            });
            
            var base_url = "<?php echo base_url(); ?>";
    
            $('.add_client_partner').on('click', function(e){
    
                e.preventDefault();
    
                var client_partner_name = $('#client_partner_name').val();
                var client_partner_text = $('#client_partner_text').val();
                var client_partner_pan = $('#client_partner_pan').val();
                var client_partner_aadhar = $('#client_partner_aadhar').val();
                var client_partner_date_val = $('#client_partner_date').val();
                var client_partner_appt_date_val = $('#client_partner_appt_date').val();
                
                if(client_partner_date_val!="")
                {
                    var date1=new Date(client_partner_date_val);
                    var month1 = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][date1.getMonth()];
                    var client_partner_date = date1.getDate() +'-'+ month1 + '-' + date1.getFullYear();
                }
                else
                {
                    var client_partner_date = "";
                }
                
                if(client_partner_appt_date_val!="")
                {
                    var date2=new Date(client_partner_appt_date_val);
                    var month2 = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][date2.getMonth()];
                    var client_partner_appt_date = date2.getDate() +'-'+ month2 + '-' + date2.getFullYear();
                }
                else
                {
                    var client_partner_appt_date = "";
                }
    
                var cli_pt_tbl='<tr class="row-3 cli_pt_row_'+cli_pt+'" style="background-color:#f6fbff;"><td class="column-1 text-left">'+client_partner_name+'<input type="hidden" name="client_partner_name[]" value="'+client_partner_name+'" /></td><td class="column-1">'+client_partner_text+'<input type="hidden" name="client_partner_text[]" value="'+client_partner_text+'" /></td><td class="column-1">'+client_partner_pan+'<input type="hidden" name="client_partner_pan[]" value="'+client_partner_pan+'" /></td><td class="column-1">'+client_partner_aadhar+'<input type="hidden" name="client_partner_aadhar[]" value="'+client_partner_aadhar+'" /></td><td class="column-1">'+client_partner_appt_date+'<input type="hidden" name="client_partner_appt_date[]" value="'+client_partner_appt_date+'" /></td><td class="column-1">'+client_partner_date+'<input type="hidden" name="client_partner_date[]" value="'+client_partner_date+'" /></td><td class="column-1"><button type="button" name="button" class="btn btn-danger text-left del_cli_pt" data-id="'+cli_pt+'" data-client_partner_id="">Delete</button></td></tr>';
    
                $('#client_partner_tbl').append(cli_pt_tbl);
    
                $('#addClientPartnerModal').modal('hide');
                $('.modal-backdrop').remove();
    
                $('#add_client_partner_form')[0].reset();
    
                cli_pt++;
                
                $('#cli_pt_empty').hide();
            });
    
            $('body').on('click', '.del_cli_pt', function(){
    
                var cli_pt_id = $(this).data('id');
                var client_partner_id = $(this).data('client_partner_id');
                var clientId = "<?php echo $clientId; ?>";
                
                swal({
                    title: "Are you sure?",
                    text: "Do you really want to delete this client partner ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm){
                    if (isConfirm) {
                        
                        if(client_partner_id=="")
                        {
                            $('.cli_pt_row_'+cli_pt_id).remove();
                            
                            swal("Deleted!", "Client partner has deleted successfully", "success");
                        }
                        else
                        {
                            $.ajax({
                                url : base_url+'/delete_partner',
                                type : 'POST',
                                data : {
                                    'client_partner_id':client_partner_id,
                                    'clientId':clientId
                                },
                                dataType: 'json',
                                success : function(response) {
    
                                    var resStatus = response['status'];
                                    var resMsg = response['message'];
                                    var resUserData = response['userdata'];
    
                                    if(resStatus==true)
                                    {
                                        $('.cli_pt_row_'+cli_pt_id).remove();
                            
                                        swal("Deleted!", "Client partner has deleted successfully", "success");
                                    }
                                    else
                                    {
                                        swal("Error!", resMsg, "error");
                                    }
                                },
                                error : function(request, error) {
                                    // alert("Request: "+JSON.stringify(request));
                                }
                            });
                        }
                    }
                });
                
            });
        });
    
    </script>
    
    <script type="text/javascript">
    
        var workActIds=<?php echo json_encode($workActArr); ?>;
                
        $(document).ready(function(){
    
            var base_url = "<?php echo base_url(); ?>";
    
            var actClass="";
            var selectedActsText = "";
            var selectedActsArr = [];
            var selectedActIdsArr = [];
            $('.edit_acts_checkbox').on('click', function(){
    
                selectedActsText = "";
                selectedActsArr = [];
                selectedActIdsArr = [];
    
                $(".edit_acts_checkbox:checked").each(function(){
    
                    // var actText=$(this).siblings('label').text();
                    var actText=$(this).data('act_name');
                    var actId=$(this).val();
    
                    selectedActsArr.push(actText);
                    selectedActIdsArr.push(actId);
                });
    
                $(selectedActsArr).each(function(i, val){
    
                    var selActId=selectedActIdsArr[i];
    
                    if(search(selActId, workActIds))
                        actClass="";
                    else
                        actClass="box-header";
    
                    selectedActsText+='<div class="col-md-4 getActModal" data-actid="'+selActId+'"><div class="box box-inverse box-primary"><div class="'+actClass+' box-head with-border"><h4 class="box-title"><strong>'+val+'</strong></h4></div></div></div>';
                });
    
                $('.edit_selected_acts_div').html(selectedActsText);
            });

            var actCustClass="";
            var selectedCustActsText = "";
            var selectedCustActsArr = [];
            var selectedCustActIdsArr = [];
            $('.edit_cust_acts_checkbox').on('click', function(){
    
                selectedCustActsText = "";
                selectedCustActsArr = [];
                selectedCustActIdsArr = [];
    
                $(".edit_cust_acts_checkbox:checked").each(function(){
    
                    // var actText=$(this).siblings('label').text();
                    var actText=$(this).data('act_name');
                    var actId=$(this).val();
    
                    selectedCustActsArr.push(actText);
                    selectedCustActIdsArr.push(actId);
                });
    
                $(selectedCustActsArr).each(function(i, val){
    
                    var selActId=selectedCustActIdsArr[i];
    
                    if(search(selActId, workActIds))
                        actCustClass="";
                    else
                        actCustClass="box-header";
    
                    selectedCustActsText+='<div class="col-md-4 getCustActModal" data-actid="'+selActId+'"><div class="box box-inverse box-primary"><div class="'+actCustClass+' box-head with-border"><h4 class="box-title"><strong>'+val+'</strong></h4></div></div></div>';
                });
    
                $('.edit_selected_cust_acts_div').html(selectedCustActsText);
            });
            
    
            // $('.edit_acts_checkbox:checked').trigger('click');
    
            // $(".tab-wizard").steps({
            //     headerTag: "h6"
            //     , bodyTag: "section"
            //     , transitionEffect: "none"
            //     , titleTemplate: '<span class="step">#index#</span> #title#'
            //     , labels: {
            //         finish: "Submit"
            //     }
            //     , onFinished: function (event, currentIndex) {
            //         // swal("Your Order Submitted!", "Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor.");
                        
            //     }
            // });
    
            $('body').on('click', '.getActModal', function(){
    
                var selAct = $(this).data('actid');
                var selActName = $(this).find('h4').text();
                var clientName = $('#edit_clientName').val();
                var clientBussOrganisation = $('#edit_clientBussOrganisation').val();
                var clientBussOrganisationTypeId = $('#edit_clientBussOrganisationType').val();
    
                if($('#edit_clientBussOrganisationType').val()!="")
                    var clientBussOrganisationType = $('#edit_clientBussOrganisationType option:selected').text();
                else
                    var clientBussOrganisationType = "";
    
                var clientRegDocument = $('#edit_clientRegDocument').val();
                var panNo = $('#edit_docName1').val();
                var tanNo = $('#edit_docName2').val();
                var aadharNo = $('#edit_docName3').val();
                var dinNo = $('#edit_docName4').val();
                var gstNo = $('#edit_docName5').val();
                var ptEnrollNo = $('#edit_docName6').val();
                var ptRegNo = $('#edit_docName7').val();
                var udyamNo = $('#edit_docName8').val();
                var impExpNo = $('#edit_docName9').val();
                var shopEstNo = $('#edit_docName10').val();
                var wardNo = $('#edit_docName11').val();
                var tmNo = $('#edit_docName13').val();
                var tcsNo = $('#edit_docName14').val();
    
                var actPanVal = panNo;
                var actWardVal = wardNo;
                var actGstVal = gstNo;
                var actCinVal = clientRegDocument;
                var actLlpinVal = clientRegDocument;
                var actRofregnVal = clientRegDocument;
                var actRegnVal = clientRegDocument;
                var actTrustDeedVal = clientRegDocument;
                var actTanVal = tanNo;
                var actPtEnrollNoVal = ptEnrollNo;
                var actPtRegNoVal = ptRegNo;
                var actShopEstNoVal = shopEstNo;
                var actUdyamNoVal = udyamNo;
                var actTmNoVal = tmNo;
                var actTcsNoVal = tcsNo;
    
                if($("#actPan").length!="")
                    var actPanVal = $("#actPan").val();
    
                if($("#actWard").length!="")
                    var actWardVal = $("#actWard").val();
    
                if($("#actGst").length!="")
                    var actGstVal = $("#actGst").val();
    
                if($("#actCin").length!="")
                    var actCinVal = $("#actCin").val();
    
                if($("#actLlpin").length!="")
                    var actLlpinVal = $("#actLlpin").val();
    
                if($("#actRofregn").length!="")
                    var actRofregnVal = $("#actRofregn").val();
    
                if($("#actRegn").length!="")
                    var actRegnVal = $("#actRegn").val();
    
                if($("#actTrustDeed").length!="")
                    var actTrustDeedVal = $("#actTrustDeed").val();
    
                if($("#actTan").length!="")
                    var actTanVal = $("#actTan").val();
    
                if($("#actPtEnrollNo").length!="")
                    var actPtEnrollNoVal = $("#actPtEnrollNo").val();
    
                if($("#actPtRegNo").length!="")
                    var actPtRegNoVal = $("#actPtRegNo").val();
    
                if($("#actShopEstNo").length!="")
                    var actShopEstNoVal = $("#actShopEstNo").val();
                
                if($("#actUdyamNoVal").length!="")
                    var actUdyamNoVal = $("#actUdyamNoVal").val();
                    
                if($("#actTmNoVal").length!="")
                    var actTmNoVal = $("#actTmNoVal").val();
                    
                if($("#actTcsNoVal").length!="")
                    var actTcsNoVal = $("#actTcsNoVal").val();
    
                if(actPanVal!="")
                {
                    $('#edit_docName1').val(actPanVal);
                }
    
                if(actWardVal!="")
                {
                    $('#edit_docName11').val(actWardVal);
                }
    
                if(actGstVal!="")
                {
                    $('#edit_docName5').val(actGstVal);
                }
    
                if(actCinVal!="" || actLlpinVal!="" || actRofregnVal!="" || actRegnVal!="" || actTrustDeedVal!="")
                {
                    $('#edit_clientRegDocument').val(clientRegDocument);
                }
    
                if(actTanVal!="")
                {
                    $('#edit_docName2').val(actTanVal);
                }
    
                if(actPtEnrollNoVal!="")
                {
                    $('#edit_docName6').val(actPtEnrollNoVal);
                }
    
                if(actPtRegNoVal!="")
                {
                    $('#edit_docName7').val(actPtRegNoVal);
                }
    
                if(actShopEstNoVal!="")
                {
                    $('#edit_docName10').val(actShopEstNoVal);
                }
                
                if(actUdyamNoVal!="")
                {
                    $('#edit_docName8').val(actUdyamNoVal);
                }
                
                if(actTmNoVal!="")
                {
                    $('#edit_docName13').val(actTmNoVal);
                }
                
                if(actTcsNoVal!="")
                {
                    $('#edit_docName14').val(actTcsNoVal);
                }
    
                $.ajax({
                    url : base_url+'/getActForm',
                    type : 'POST',
                    data : {
                        'selAct' : selAct,
                        'selActName' : selActName,
                        'clientName' : clientName,
                        'clientBussOrganisation' : clientBussOrganisation,
                        'clientBussOrganisationTypeId' : clientBussOrganisationTypeId,
                        'clientBussOrganisationType' : clientBussOrganisationType,
                        'clientRegDocument' : clientRegDocument,
                        'panNo' : panNo,
                        'tanNo' : tanNo,
                        'aadharNo' : aadharNo,
                        'dinNo' : dinNo,
                        'gstNo' : gstNo,
                        'ptEnrollNo' : ptEnrollNo,
                        'ptRegNo' : ptRegNo,
                        'udyamNo' : udyamNo,
                        'impExpNo' : impExpNo,
                        'shopEstNo' : shopEstNo,
                        'wardNo' : wardNo,
                        'tmNo' : tmNo,
                        'tcsNo' : tcsNo
                    },
                    dataType: 'html',
                    success : function(data) {
    
                        $('.actsModal').modal('show');
                        $('#actFormDiv').html(data);
                        // $('#actTaxPayer').val(selAct);
                        
                        var actTaxPayer=$('#edit_clientBussOrganisationType').val();
                        
                        $('#actTaxPayer').val(actTaxPayer);
    
                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });
            });

            $('body').on('click', '.getCustActModal', function(){
    
                var selAct = $(this).data('actid');
                var selActName = $(this).find('strong').text();
                $("#due_act").val(selAct);
                $(".selectedCustActTitle").html(selActName);
                $(".selectedCustActInput").val(selActName);
                $('.custActsModal').modal('show');
            });
            
            checkedSelAct();
        });
    
        function checkedSelAct()
        {
            var actClass="";
            var selectedActsText = "";
            var selectedActsArr = [];
            var selectedActIdsArr = [];
    
            $(".edit_acts_checkbox:checked").each(function(){
    
                // var actText=$(this).siblings('label').text();
                var actText=$(this).data('act_name');
                var actId=$(this).val();
    
                selectedActsArr.push(actText);
                selectedActIdsArr.push(actId);
            });
    
            $(selectedActsArr).each(function(i, val){
    
                var selActId=selectedActIdsArr[i];
    
                // if(jQuery.inArray(selActId, workActIds) !== -1)
                if(search(selActId, workActIds))
                    actClass="";
                else
                    actClass="box-header";
    
                selectedActsText+='<div class="col-md-4 getActModal" data-actid="'+selActId+'"><div class="box box-inverse box-primary"><div class="box_head_cl '+actClass+' box-head with-border"><h4 class="box-title"><strong>'+val+'</strong></h4></div></div></div>';
            });
    
            $('.edit_selected_acts_div').html(selectedActsText);
        }
    
        function search(nameKey, myArray){
            var isResult=false;
            $.each(myArray, function (key, val) {
                if (val === nameKey) {
                    return isResult=true;
                }
            });
            return isResult;
        }
    
    </script>
    
    <script type="text/javascript">
                
        $(document).ready(function(){
    
            $('.edit_register_div').hide();
            // $('.edit_register_div_1').html('<p class="text-danger text-center">Please Select Type of Organisation from Business Details...</p>');
            $('.edit_register_div_1').html('<p class="text-danger text-center"></p>');
            $('.register_label').text("N/A");
    
            $('#edit_clientBussOrganisationType').on('change', function(){
                
                var clientNameVal = "<?php echo $clientData['clientName']; ?>";
                var clientContactPerson = "<?php echo $clientData['clientContactPerson']; ?>";
                
                if(clientNameVal=="")
                {
                    $('#edit_clientName').val("");
                    
                    if(clientContactPerson!="")
                        $('#clientContactPerson').val(clientContactPerson);
                    else
                        $('#clientContactPerson').val("");
                }
    
                var orgType = $(this).val();
                
                var clientBussOrganisationType = $('#edit_clientBussOrganisationType option:selected').text();
                
                if(orgType!="")
                    $('#edit_clientTypeText').val(clientBussOrganisationType);
                else
                    $('#edit_clientTypeText').val("");
                    
                $('.edit_register_div_1').hide();
                
                if(orgType=="")
                {
                    $('.edit_register_div').hide();
                    $('.edit_register_label').text("N/A");
                }
                else if(orgType=="1")
                {
                    $('.edit_register_div').show();
                    $('#edit_clientRegDocument').attr('placeholder', 'Enter CIN Number');
                    $('.edit_register_label').text("CIN Number:");
                }
                else if(orgType=="2")
                {
                    $('.edit_register_div').show();
                    $('#edit_clientRegDocument').attr('placeholder', 'Enter LLPIN');
                    $('.edit_register_label').text("LLPIN:");
                }
                else if(orgType=="3")
                {
                    $('.edit_register_div').show();
                    $('#edit_clientRegDocument').attr('placeholder', 'Enter OPCIN');
                    $('.edit_register_label').text("OPCIN:");
                }
                else if(orgType=="4")
                {
                    $('.edit_register_div').show();
                    $('#edit_clientRegDocument').attr('placeholder', 'Enter ROF Regn No');
                    $('.edit_register_label').text("ROF Regn No:");
                }
                else if(orgType=="5")
                {
                    $('.edit_register_div').show();
                    $('#edit_clientRegDocument').attr('placeholder', 'Enter Regn No');
                    $('.edit_register_label').text("Regn No:");
                }
                else if(orgType=="6")
                {
                    $('.edit_register_div').show();
                    $('#edit_clientRegDocument').attr('placeholder', 'Enter Regn No');
                    $('.edit_register_label').text("Regn No:");
                }
                else if(orgType=="7")
                {
                    $('.edit_register_div').show();
                    $('#edit_clientRegDocument').attr('placeholder', 'Enter Regn No (if any)');
                    $('.edit_register_label').text("Regn No (if any):");
                    
                    // $('.edit_register_div').show();
                    // $('.edit_register_label').text("As per Trust Deed:");
                }
                else if(orgType=="8")
                {
                    $('.edit_register_div').hide();
                    $('.edit_register_label').text("N/A");
                }
                else if(orgType=="9")
                {
                    $('.edit_register_div').hide();
                    $('.edit_register_label').text("N/A");
                    
                    // $('.edit_register_div').show();
                    // $('.edit_register_label').text("As per HUF Deed:");
                }
                else if(orgType=="10")
                {
                    $('.edit_register_div').hide();
                    $('.edit_register_label').text("N/A");
                    
                    // $('.edit_register_div').show();
                    // $('.edit_register_label').text("As per JV Deed:");
                }
                else if(orgType=="11")
                {
                    $('.edit_register_div').show();
                    $('#edit_clientRegDocument').attr('placeholder', 'Enter Regn No (if any)');
                    $('.edit_register_label').text("Regn No (if any):");
                    
                    // $('.edit_register_div').hide();
                    // $('.edit_register_label').text("N/A");
                }
                else if(orgType=="12")
                {
                    $('.edit_register_div').show();
                    $('#edit_clientRegDocument').attr('placeholder', 'Enter Regn No (if any)');
                    $('.edit_register_label').text("Regn No (if any):");
                    
                    // $('.edit_register_div').hide();
                    // $('.edit_register_label').text("N/A");
                }
                else if(orgType=="13")
                {
                    $('.edit_register_div').hide();
                    $('.edit_register_label').text("N/A");
                }
                else if(orgType=="22")
                {
                    $('.register_div').hide();
                    $('.register_label').text("N/A");
                }
                else if(orgType=="23")
                {
                    $('.register_div').hide();
                    $('.register_label').text("N/A");
                }
                else
                {
                    $('.edit_register_div').hide();
                    $('.edit_register_label').text("N/A");
                }
    
                if(orgType=="9")
                {
                    // $('.steps ul li:nth-child(2)').removeClass('disabled');
                    // $('.steps ul li:nth-child(2)').addClass('done');
                    // $('.steps ul li:nth-child(2)').show();
                    // $('.business_div input').prop('disabled', true);
                    // $('#client_grp_row').hide();
                    // $('.edit_register_div').hide();
    
                    $(".doc_row").each(function(){
    
                        var docIdVal=$(this).data('id');
    
                        if(docIdVal=="1" || docIdVal=="3" || docIdVal=="4" || docIdVal=="12")
                            $(this).show();
                        else
                            $(this).hide();
                    });
                }
                else if(orgType=="8" || orgType=="3" || orgType=="22" || orgType=="23")
                {
                    // $('.steps ul li:nth-child(2)').removeClass('disabled');
                    // $('.steps ul li:nth-child(2)').addClass('done');
                    // $('.steps ul li:nth-child(2)').show();
                    // $('.business_div input').prop('disabled', false);
                    // $('#client_grp_row').hide();
                    // $('.edit_register_div').show();
    
                    $(".doc_row").each(function(){
                        $(this).show();
                    });
                }
                else
                {
                    // $('.steps ul li:nth-child(2)').removeClass('done');
                    // $('.steps ul li:nth-child(2)').addClass('disabled');
                    // $('.steps ul li:nth-child(2)').hide();
                    // $('.business_div input').prop('disabled', false);
                    // $('#client_grp_row').show();
                    // $('.edit_register_div').show();
    
                    $(".doc_row").each(function(){
                        $(this).show();
                    });
                }
                
                var clientContactPerson = "<?php echo $clientData['clientContactPerson']; ?>";
                
                if(orgType=="9" || orgType=="8" || orgType=="3" || orgType=="22" || orgType=="23")
                {
                    if(clientContactPerson!="")
                        $('#clientContactPerson').prop('readonly', false);
                    else
                        $('#clientContactPerson').prop('readonly', true);
                }
                else
                {
                    $('#clientContactPerson').prop('readonly', false);
                }
                
                if(orgType=="9") //Individual
                {
                    $('.ind_div input, .ind_div select, .ind_div textarea, .ind_div button').prop('disabled', false);
                    $('.buss_div input, .buss_div select, .buss_div textarea').prop('disabled', true);
                    $('.contact_div input, .contact_div textarea').prop('disabled', false);
                    $('.photo_div input').prop('disabled', false);
                    $('#client_grp_row input, #client_grp_row select').prop('disabled', false);
                    $('#edit_clientGroupNew, #clientGroupBtnNew').prop('disabled', true);
                }
                else if(orgType=="8" || orgType=="3" || orgType=="22" || orgType=="23") //Proprietory, OPC
                {
                    $('.ind_div input, .ind_div select, .ind_div textarea, .ind_div button').prop('disabled', false);
                    $('.buss_div input, .buss_div select, .buss_div textarea').prop('disabled', false);
                    $('.contact_div input, .contact_div textarea').prop('disabled', false);
                    $('.photo_div input').prop('disabled', false);
                    $('#client_grp_row input, #client_grp_row select').prop('disabled', false);
                    $('#edit_clientGroupNew, #clientGroupBtnNew').prop('disabled', true);
                }
                else if(orgType!="9" && orgType!="8" && orgType!="3" || orgType!="22" || orgType!="23") // Other Than Individual
                {
                    $('.ind_div input, .ind_div select, .ind_div textarea, .ind_div button').prop('disabled', true);
                    $('.buss_div input, .buss_div select, .buss_div textarea').prop('disabled', false);
                    $('.contact_div input, .contact_div textarea').prop('disabled', false);
                    $('.photo_div input').prop('disabled', false);
                    $('#client_grp_row input, #client_grp_row select').prop('disabled', false);
                    $('#edit_clientGroupNew, #clientGroupBtnNew').prop('disabled', false);
                }
    
            });
    
            $('#edit_clientBussOrganisationType').trigger('change');
            
            var orgTypeVal = $('#edit_clientBussOrganisationType option:selected').val();
            
            if(orgTypeVal=="")
            {
                $('.steps ul li:nth-child(2)').removeClass('done');
                $('.steps ul li:nth-child(2)').addClass('disabled');
                $('.steps ul li:nth-child(2)').hide();
                $('.business_div input').prop('disabled', false);
                $('#client_grp_row').show();
            }
        });
        
        function setClientName($this)
        {
            var clientName = $this.value;
            var clientBussOrgType = $('#edit_clientBussOrganisationType').val();
            var clientContactPerson = "<?php echo $clientData['clientContactPerson']; ?>";
            
            if(clientBussOrgType=="9" || clientBussOrgType=="8" || clientBussOrgType=="3" || clientBussOrgType=="22" || clientBussOrgType=="23") // Individual, Proprietory, OPC
            {
                if(clientContactPerson!="")
                    $('#clientContactPerson').val(clientContactPerson);
                else
                    $('#clientContactPerson').val(clientName);
            }
            else
            {
                if(clientContactPerson!="")
                    $('#clientContactPerson').val(clientContactPerson);
                else
                    $('#clientContactPerson').va("");
            }
        }
    
    </script>
    
    <script type="text/javascript">
                
        $(document).ready(function(){
    
            var base_url = "<?php echo base_url(); ?>";
    
            $('body').on('submit', '.edit_client_form', function(e){
    
                e.preventDefault();    
                var clientFormData = new FormData(this);
    		    
    		    // var clientFormData = $('.client_form').serialize();
    
                $.ajax({
    				url : base_url+'/update_client',
    				type : 'POST',
    				data : clientFormData,
    				dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
    				success : function(response) {
    
    					var resStatus = response['status'];
                        var resMsg = response['message'];
                        var resUserData = response['userdata'];
    					
    					if(resStatus==true)
    					{
    						// $('.client_form')[0].reset();
                            // window.location.href=base_url+"/admin/clients";
                            
                            // swal("Updated", resMsg, "success");
                            // window.location.reload();
                            
                            swal({
                                    title: "Updated", 
                                    text: resMsg, 
                                    type: "success"},
                                    function(){
                                        location.reload();
                                });
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
    				},
    				error : function(request, error)
    				{
    					// alert("Request: "+JSON.stringify(request));
    				}
    			});
            });
    
            $('#edit_clientGroup').on('change', function(){
    
                var clientGroup = $(this).val();
    
                if(clientGroup=="")
                {
                    $('#edit_clientCostCenter').val("");
                    $('#edit_clientCategory').val("");
                    return false;
                }
    
                $.ajax({
                    url : base_url+'/getClientGroups',
                    type : 'POST',
                    data : { 
                        'client_group' : clientGroup,
                        "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                    },
                    dataType: 'json',
                    success : function(response) {
    
                        var resStatus = response['status'];
                        var resMsg = response['message'];
                        var resUserData = response['userdata'];
    					
    					if(resStatus==true)
    					{
                            $('#edit_clientCostCenter').val(resUserData['costCenter']);
                            $('#edit_clientCategory').val(resUserData['categoryName']);
    					}
    
                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });
            });
    
            $('#edit_add_client_group_form').on('submit', function(e){
    
                e.preventDefault();    
                var clientGroupFormData = new FormData(this);
    
                // var clientFormData = $('#add_client_group_form').serialize();
    
                var clientGroupDataArr = $('#edit_add_client_group_form').serializeArray();
    
                $.map(clientGroupDataArr, function(n, i){
                    
                    var fieldName=n['name'];
    
                    $("#"+fieldName).siblings('span').remove();
                    
                    if(n['value']=="")
                        $("#"+fieldName).closest('div').append('<span class="text-danger">This field is required</span>');
                });
    
                $.ajax({
                    url : base_url+'/add_remote_client_group',
                    type : 'POST',
                    data : clientGroupFormData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success : function(response) {
    
                        var resStatus = response['status'];
                        var resMsg = response['message'];
                        var resUserData = response['userdata'];
                        
                        if(resStatus==true)
                        {
                            $('#edit_add_client_group_form')[0].reset();
    
                            var new_client_group_id = resUserData['client_group_id'];
                            var new_client_group_name = resUserData['client_group'];
    
                            var newClientGrp="<option value='"+new_client_group_id+"' selected>"+new_client_group_name+"</option>";
    
                            $('#edit_clientGroup').append(newClientGrp);
    
                            $('#edit_addClientGrpModal').modal('toggle');
                            $('.modal-backdrop').remove();
    
                            // $("#edit_addClientGrpModal").modal({backdrop: false});
    
                            swal("Added", resMsg, "success");
                        }
                        else
                        {
                            swal("Error!", resMsg, "error");
                        }
                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });
            });
    
            $('.wizard-content .wizard > .actions > ul').append('<li><button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn submit_client">Submit</button></li>');
    
            $('.wizard-content .wizard > .actions > ul li:nth-child(3)').remove();
    
            $('.wizard-content .wizard > .actions > ul li:nth-child(3)').addClass('submit_client');
            
            $('.steps ul li:not(:first)').removeClass('disabled');
            $('.steps ul li:not(:first)').addClass('done');
            
            $('.wizard-content .wizard > .actions > ul').css('margin-right', '40%');
    
        });
    
    </script>
    
    <script type="text/javascript">
    
        function onlyUnique(value, index, self) {
            return self.indexOf(value) === index;
        }
                
        $(document).ready(function(){
    
            var base_url = "<?php echo base_url(); ?>";
    
            $('body').on('click', '.submitActData', function(e){
    
                e.preventDefault();    
                var validForm=true;
                
                prevSelActArr = [];
                prevSelActArray = [];
                var prevActs="";
                
                $('input[name="work_actId[]"]').each(function(ind, actInstance){
                    prevSelActArr.push($(actInstance).val());
                });
                
                prevSelActArray = prevSelActArr.filter(onlyUnique);
                
                if(prevSelActArray.length>0)
                {
                    prevActs=prevSelActArray.join(',');
                }
                
                // console.log(prevSelActArray);
                
                // var actFormData = new FormData($('#actWiseForm'));
                var selectedActId = $('#selectedActId').val();
                var actFormData = $('#actWiseForm').serialize();
                
                var actFormDataVar = actFormData+"&prevActs="+prevActs;
                
                console.log(prevSelActArray);
                console.log(actFormData);
    
                var actDataArr = $('#actWiseForm').serializeArray();
    
                $.map(actDataArr, function(n, i){
    
                    var fieldName=n['name'];
    
                    if(fieldName=="actPan")
                    {
                        $('#edit_docName1').val($("#actPan").val());
                    }
    
                    if(fieldName=="actWard")
                    {
                        $('#edit_docName11').val($("#actWard").val());
                    }
                    
                    if(fieldName=="actDin")
                    {
                        $('#docName4').val($("#actDin").val());
                    }
    
                    if(fieldName=="actGst")
                    {
                        $('#edit_docName5').val($("#actGst").val());
                    }
    
                    if(fieldName=="actCin" || fieldName=="actLlpin" || fieldName=="actRofregn" || fieldName=="actRegn" || fieldName=="actTrustDeed")
                    {
                        $('#edit_clientRegDocument').val($("#"+fieldName).val());
                    }
    
                    if(fieldName=="actTan")
                    {
                        $('#edit_docName2').val($("#actTan").val());
                    }
    
                    if(fieldName=="actPtEnrollNo")
                    {
                        $('#edit_docName6').val($("#actPtEnrollNo").val());
                    }
    
                    if(fieldName=="actPtRegNo")
                    {
                        $('#edit_docName7').val($("#actPtRegNo").val());
                    }
    
                    if(fieldName=="actShopEstNo")
                    {
                        $('#edit_docName10').val($("#actShopEstNo").val());
                    }
    
                    $("#"+fieldName).siblings('span').remove();
                    
                    if(n['value']=="")
                    {
                        validForm=false;
                        $("#"+fieldName).closest('div').append('<span class="text-danger">This field is required</span>');
                    } 
                });
    
                if(validForm==false)
                    return false;
    
                $.ajax({
                    url : base_url+'/search_due_date',
                    type : 'POST',
                    data : actFormDataVar,
                    dataType: 'html',
                    success : function(response) {
                        
                        if(response!="")
                        {
                            if($(".act_tbody_"+selectedActId).length!="")
                            {
                                $('.sel_act_due_date .act_tbody_'+selectedActId).append(response);
                            }
                            else
                            {
                                $('.sel_act_due_date').append(response);
                            }
                        }
                        else
                        {
                            swal("No data found!", "", "info");
                        }
                        
                        $('.actsModal').modal('toggle');
                        $('.modal-backdrop').remove();
                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });
            });

            $('body').on('click', '.submitCustActData', function(e){
    
                e.preventDefault();

                prevSelCustActArr = [];
                prevSelCustActArray = [];
                var prevCustActs="";
                
                $('input[name="cust_actId[]"]').each(function(ind, actInstance){
                    prevSelCustActArr.push($(actInstance).val());
                });
                
                prevSelCustActArray = prevSelCustActArr.filter(onlyUnique);
                
                if(prevSelCustActArray.length>0)
                {
                    prevCustActs=prevSelCustActArray.join(',');
                }

                var selectedActId = $('#due_act').val();
                var actFormData = $('#custActWiseForm').serialize();

                var actFormDataVar = actFormData+"&prevCustActs="+prevCustActs;

                var actDataArr = $('#custActWiseForm').serializeArray();

                console.log("actFormData", actFormData);
                console.log("actDataArr", actDataArr);

                $.ajax({
                    url : base_url+'/set_cust_due_date',
                    type : 'POST',
                    data : actFormDataVar,
                    dataType: 'html',
                    success : function(response) {
                        
                        if(response!="")
                        {
                            if($(".act_tbody_"+selectedActId).length!="")
                            {
                                $('.sel_cust_act_due_date .act_tbody_'+selectedActId).append(response);
                            }
                            else
                            {
                                $('.sel_cust_act_due_date').append(response);
                            }
                        }
                        else
                        {
                            swal("Something went wrong!", "", "error");
                        }
                        
                        $('.custActsModal').modal('toggle');
                        $('.modal-backdrop').remove();

                        $('#custActWiseForm')[0].reset();
                        $('#periodicity').trigger('change');
                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });


            });
    
            $('body').on('click', '.delete_due_date', function(){
    
                var row_id=$(this).data('id');
                var due_date_id=$(this).data('due');
                var client_id=$(this).data('client');
                var act_id=$(this).data('act');
                var orgtype=$(this).data('orgtype');
    
                swal({
                    title: "Are you sure?",
                    text: "Do you really want to delete this client due date ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm){
                    if (isConfirm) {
    
                        if(due_date_id!="")
                        {
                            $.ajax({
                                url : base_url+'/delete_client_due_date',
                                type : 'POST',
                                data : {
                                    'due_date_id':due_date_id,
                                    'client_id':client_id,
                                    'act_id':act_id,
                                    'orgtype':orgtype
                                },
                                dataType: 'json',
                                success : function(response) {
    
                                    var resStatus = response['status'];
                                    var resMsg = response['message'];
                                    var resUserData = response['userdata'];
                                    var resEnableAct = response['enableAct'];
    
                                    if(resStatus==true)
                                    {
                                        $('.row_'+row_id).remove();
                                        
                                        if(resEnableAct==true)
                                        {
                                            $('#edit_actId'+act_id).prop('disabled', false);
                                        }
                                        
                                        swal("Deleted", resMsg, "success");
                                    }
                                    else
                                    {
                                        swal("Error!", resMsg, "error");
                                    }
                                },
                                error : function(request, error) {
                                    // alert("Request: "+JSON.stringify(request));
                                }
                            });
                        }
                        else
                        {
                            $('.row_'+row_id).remove();
    
                            swal("Deleted!", "", "success");
                        }
                    }
                });
            });
            
            $(".clientDocInput").on("input", function(){
                var clientDocNo = $(this).val();
                var clientDocInputId = $(this).attr("id");
                
                $("#"+clientDocInputId+"Label").val(clientDocNo);
            });
            
            showClientName();
    
        });
    
    </script>
    
    <script type="text/javascript">
    
        function showClientName()
        {
            var clientName = $('#edit_clientName').val();
            var clientBussOrganisation = $('#edit_clientBussOrganisation').val();
            
            var clientNameVal = "";
            
            var clientBussOrganisationTypeId = $('#edit_clientBussOrganisationType').val();
            var clientBussOrganisationType = $('#edit_clientBussOrganisationType option:selected').text();
            
            if(clientBussOrganisationTypeId==8 || clientBussOrganisationTypeId==22 || clientBussOrganisationTypeId==23)
            {
                if(clientBussOrganisation!="")
                    clientNameVal=clientName+" ("+clientBussOrganisation+")";
                else
                    clientNameVal=clientName;
            }
            else if(clientBussOrganisationTypeId==9)
            {
                clientNameVal=clientName;
            }
            else
            {
                clientNameVal=clientBussOrganisation;
            }
            
            if(clientNameVal!="")
            {
                $('.clientNameLabelDiv').show();
                $('.clientNameLabelVal').text(clientNameVal);
            }
            else
            {
                $('.clientNameLabelDiv').hide();
                $('.clientNameLabelVal').text("");
            }
        }
    </script>

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
<?= $this->endSection(); ?>