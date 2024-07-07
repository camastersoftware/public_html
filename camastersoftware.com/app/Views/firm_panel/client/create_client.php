
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
    
    .clientNameLabelVal{
        font-size: 27px !important;
    }
    
    .theme-primary .box-primary {
        background-color: #2b8836 !important;
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
    
    .demo-checkbox .box_head_cl.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
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
    
    .actDivClass .filled-in:checked + label::after{
        border: 2px solid #f99d27 !important;
    }
    
    .btnBorder
    {
        border-radius: 11px !important;
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
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            <a href="<?= base_url('clients'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body tab_body_div card_bg_format">
                        <form action="javascript:void(0);" class="tab-wizard wizard-circle client_form" enctype="multipart/form-data">
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
                                                <span class="hidden-xs-down year-color">Act Applicable</span>
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
                                                                                <label for="clientBussOrganisationType">Select Type of Client :<small class="text-danger">*</small></label>
                                                                                <select class="custom-select form-control" name="clientBussOrganisationType" id="clientBussOrganisationType">
                                                                                    <option value="">Select Type of Client</option>
                                                                                    <?php if(!empty($organisationTypes)): ?>
                                                                                        <?php foreach($organisationTypes AS $e_org): ?>
                                                                                            <option value="<?php echo $e_org['organisation_type_id']; ?>"><?php echo $e_org['organisation_type_name']; ?></option>
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
                                                                                                <label for="clientTitle">Title:</label>
                                                                                                <select class="custom-select form-control" name="clientTitle" id="clientTitle">
                                                                                                    <option value="">Select Title</option>
                                                                                                    <?php if(!empty($salutationList)): ?>
                                                                                                        <?php foreach($salutationList AS $e_sal): ?>
                                                                                                            <option value="<?php echo $e_sal['salutation_name']; ?>"><?php echo $e_sal['salutation_name']; ?></option>
                                                                                                        <?php endforeach; ?>
                                                                                                    <?php endif; ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <div class="form-group">
                                                                                                <label for="clientName">Name of Client:<small class="text-danger">*</small></label>
                                                                                                <input type="text" class="form-control" name="clientName" id="clientName" placeholder="(First Name) (Middle Name) (Last Name) as per PAN" onkeyup="setClientName(this);showClientName();" onkeydown="setClientName(this);showClientName();" onkeypress="setClientName(this);showClientName();" oninput="setClientName(this);showClientName();" onfocus="setClientName(this);showClientName();"> 
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-10">
                                                                                            <div class="form-group">
                                                                                                <label for="clientName">Client Group:<small class="text-danger">*</small></label>
                                                                                                <select class="custom-select form-control" name="clientGroup" id="clientGroup">
                                                                                                    <option value="">Select Client Group</option>
                                                                                                    <?php if(!empty($groupList)): ?>
                                                                                                        <?php foreach($groupList AS $e_grp): ?>
                                                                                                            <option value="<?php echo $e_grp['client_group_id']; ?>"><?php echo $e_grp['client_group']; ?></option>
                                                                                                        <?php endforeach; ?>
                                                                                                    <?php endif; ?>
                                                                                                </select> 
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <button type="button" name="Add" class="waves-effect waves-light btn btn-sm btn-submit text-right mt-30" data-toggle="modal" data-target="#addClientGrpModal">Add</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="clientFatherName">Father Name:</label>
                                                                                        <input type="text" class="form-control" name="clientFatherName" id="clientFatherName" placeholder="Enter Father Name"> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="clientSpouseName">Spouse Name :</label>
                                                                                        <input type="text" class="form-control" name="clientSpouseName" id="clientSpouseName" placeholder="Enter Spouse Name"> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label for="clientDob">Date of Birth :</label>
                                                                                        <input type="date" class="form-control" name="clientDob" id="clientDob" placeholder="Enter Date of Birth"> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label for="clientQualification">Qualification:</label>
                                                                                        <input type="text" class="form-control" name="clientQualification" id="clientQualification" placeholder="Enter Qualification"> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label for="clientOccupation">Occupation:</label>
                                                                                        <input type="text" class="form-control" name="clientOccupation" id="clientOccupation" placeholder="Enter Occupation"> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="clientPersonalRemark">Remark:</label>
                                                                                        <textarea class="form-control" name="clientPersonalRemark" id="clientPersonalRemark" placeholder="Enter Remark" rows="1"></textarea> 
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
                                                                                <label for="clientBussOrganisation">Organisation Name :<small class="text-danger">*</small></label>
                                                                                <input type="text" class="form-control" name="clientBussOrganisation" id="clientBussOrganisation" placeholder="Enter Organisation Name" oninput="showClientName();" onkeyup="showClientName();" onkeydown="showClientName();" onkeypress="showClientName();" onfocus="showClientName();"> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <div class="col-md-10">
                                                                                    <div class="form-group">
                                                                                        <label for="clientName">Client Group:<small class="text-danger">*</small></label>
                                                                                        <select class="custom-select form-control" name="clientGroup" id="clientGroupNew">
                                                                                            <option value="">Select Client Group</option>
                                                                                            <?php if(!empty($groupList)): ?>
                                                                                                <?php foreach($groupList AS $e_grp): ?>
                                                                                                    <option value="<?php echo $e_grp['client_group_id']; ?>"><?php echo $e_grp['client_group']; ?></option>
                                                                                                <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <button type="button" name="Add"  id="clientGroupBtnNew" class="waves-effect waves-light btn btn-sm btn-submit text-right mt-30" data-toggle="modal" data-target="#addClientGrpModal">Add</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="clientTypeText">Client Type:</label>
                                                                                <input type="text" class="form-control" name="clientTypeText" id="clientTypeText" readonly> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="clientBussIncorporationDate">Date of Incorpn/Regn:</label>
                                                                                <input type="date" class="form-control" name="clientBussIncorporationDate" id="clientBussIncorporationDate"> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="clientBussNature">Nature of Business :</label>
                                                                                <input type="text" class="form-control" name="clientBussNature" id="clientBussNature" placeholder="Enter Nature of Business"> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="clientBussWebsite">Website URL :</label>
                                                                                <input type="text" class="form-control" name="clientBussWebsite" id="clientBussWebsite" placeholder="Enter Website URL"> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="clientBussRemark">Remark:</label>
                                                                                <textarea class="form-control" name="clientBussRemark" id="clientBussRemark" placeholder="Enter Remark" rows="1"></textarea> 
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
                                                                                <input type="text" class="form-control" name="clientContactPerson" id="clientContactPerson" placeholder="Enter Contact Person Name"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientContactDesgtn">Contact Person Designation :</label>
                                                                                <input type="text" class="form-control" name="clientContactDesgtn" id="clientContactDesgtn" placeholder="Enter Contact Person Designation"> 
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussMobile1">Mobile 1 :</label>
                                                                                <input type="tel" class="form-control" name="clientBussMobile1" id="clientBussMobile1" placeholder="Enter Mobile 1"> 
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussMobile2">Mobile 2 :</label>
                                                                                <input type="tel" class="form-control" name="clientBussMobile2" id="clientBussMobile2" placeholder="Enter Mobile 2"> 
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussEmail1">Email 1 :</label>
                                                                                <input type="email" class="form-control" name="clientBussEmail1" id="clientBussEmail1" placeholder="Enter Email 1"> 
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussEmail2">Email 2 :</label>
                                                                                <input type="email" class="form-control" name="clientBussEmail2" id="clientBussEmail2" placeholder="Enter Email 2"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientResidentialAddress">Residential Address:</label>
                                                                                <input type="text" class="form-control" name="clientResidentialAddress" id="clientResidentialAddress" placeholder="Enter Residential Address"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussResidencePhone">Residence Phone :</label>
                                                                                <input type="tel" class="form-control" name="clientBussResidencePhone" id="clientBussResidencePhone" placeholder="Enter Residence Phone"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussOfficeAddress">Office Address :</label>
                                                                                <input type="text" class="form-control" name="clientBussOfficeAddress" id="clientBussOfficeAddress" placeholder="Enter Office Address"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussOfficePhone1">Office Phone Number :</label>
                                                                                <input type="tel" class="form-control" name="clientBussOfficePhone1" id="clientBussOfficePhone1" placeholder="Enter Office Phone Number"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussRegisteredAddress">Registered Office Address :</label>
                                                                                <input type="text" class="form-control" name="clientBussRegisteredAddress" id="clientBussRegisteredAddress" placeholder="Enter Registered Address"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussOfficePhone2">Registered Office Phone No :</label>
                                                                                <input type="tel" class="form-control" name="clientBussOfficePhone2" id="clientBussOfficePhone2" placeholder="Enter Registered Office Phone No"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussFactoryAddress">Factory Address :</label>
                                                                                <input type="text" class="form-control" name="clientBussFactoryAddress" id="clientBussFactoryAddress" placeholder="Enter Factory Address"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="clientBussFactoryPhone">Factory Phone Number :</label>
                                                                                <input type="tel" class="form-control" name="clientBussFactoryPhone" id="clientBussFactoryPhone" placeholder="Enter Factory Phone Number"> 
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="clientContactRemark">Remark:</label>
                                                                                <textarea class="form-control" name="clientContactRemark" id="clientContactRemark" placeholder="Enter Remark" rows="1"></textarea> 
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
                                                                <div class="col-md-12 register_div_1 text-center"></div>
                                                                <div class="col-md-12">
                                                                    <div class="row form-group">
                                                                        <div class="col-md-4 register_div">
                                                                            <div class="row doc_row">
                                                                                <div class="col-md-8">
                                                                                    <div class="form-group">
                                                                                        <label for="clientRegDocument" class="register_label font-weight-bold" style="font-size:17px;">N/A</label>
                                                                                        <input type="text" class="form-control" id="clientRegDocumentLabel" placeholder="" readonly>
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
                                                                                                    <h4 class="modal-title" id="myModalLabel">Add <span class="register_label"></span></h4>
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label for="clientRegDocument" class="register_label font-weight-bold" style="font-size:17px;">N/A</label>
                                                                                                                <input type="text" class="form-control clientDocInput" name="clientRegDocument" id="clientRegDocument" placeholder="">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label for="clientRegDocumentFile">Document File :</label>
                                                                                                                <input type="file" name="clientRegDocumentFile" id="clientRegDocumentFile"> 
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label for="clientRegDocumentIssueDate">Issue Date:</label>
                                                                                                                <input type="date" class="form-control" name="clientRegDocumentIssueDate" id="clientRegDocumentIssueDate"> 
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label for="clientRegDocumentEffectiveDate">Effective Date :</label>
                                                                                                                <input type="date" class="form-control" name="clientRegDocumentEffectiveDate" id="clientRegDocumentEffectiveDate">  
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label for="clientRegDocumentMobile">Mobile No :</label>
                                                                                                                <input type="text" class="form-control" name="clientRegDocumentMobile" id="clientRegDocumentMobile" placeholder="Enter Mobile No"> 
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label for="clientRegDocumentEmail">Email Address :</label>
                                                                                                                <input type="text" class="form-control" name="clientRegDocumentEmail" id="clientRegDocumentEmail" placeholder="Enter Email Address">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label for="clientRegDocumentAddress">Address:</label>
                                                                                                                <textarea class="form-control" name="clientRegDocumentAddress" id="clientRegDocumentAddress" placeholder="Enter Address" rows="2"></textarea> 
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label for="clientRegDocumentRemark">Remark:</label>
                                                                                                                <textarea class="form-control" name="clientRegDocumentRemark" id="clientRegDocumentRemark" placeholder="Enter Remark" rows="2"></textarea> 
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
                                                                                            <label for="docName<?php echo $cli_doc_id; ?>"><?php echo $cli_doc_name; ?>:<?php if($cli_doc_id==1): ?><small class="text-danger">*</small><?php endif; ?></label>
                                                                                            <input type="text" class="form-control" id="docName<?php echo $cli_doc_id; ?>Label" placeholder="Enter <?php echo $cli_doc_name; ?>" readonly>
                                                                                            <?php if($cli_doc_id==1): ?>
                                                                                                <input type="hidden" name="actPanValue" id="actPanValue" value="" />
                                                                                            <?php endif; ?>
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
                                                                                                        <h4 class="modal-title" id="myModalLabel">Add <?= $cli_doc_name; ?> Details</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="docName<?php echo $cli_doc_id; ?>"><?php echo $cli_doc_name; ?>:</label>
                                                                                                                    <input type="text" class="form-control clientDocInput" name="client_document_number[]" id="docName<?php echo $cli_doc_id; ?>" data-doc_id="<?php echo $cli_doc_id; ?>" placeholder="Enter <?php echo $cli_doc_name; ?>"> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="docFile<?php echo $cli_doc_id; ?>">Document :</label>
                                                                                                                    <input type="file" name="client_document_file_<?php echo $cli_doc_id; ?>" id="docFile<?php echo $cli_doc_id; ?>">
                                                                                                                    <input type="hidden" name="client_document_id[]" value="<?php echo $cli_doc_id; ?>">  
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="docIssueDate<?php echo $cli_doc_id; ?>">Issue Date :</label>
                                                                                                                    <input type="date" class="form-control" name="client_document_issue_date[]" id="docIssueDate<?php echo $cli_doc_id; ?>"> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="docEffectiveDate<?php echo $cli_doc_id; ?>">Effective Date :</label>
                                                                                                                    <input type="date" class="form-control" name="client_document_effective_date[]" id="docEffectiveDate<?php echo $cli_doc_id; ?>"> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="docMobileNo<?php echo $cli_doc_id; ?>">Mobile No :</label>
                                                                                                                    <input type="text" class="form-control" name="client_document_mobile[]" id="docMobileNo<?php echo $cli_doc_id; ?>" placeholder="Enter Mobile No"> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-6">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="docEmail<?php echo $cli_doc_id; ?>">Email Address :</label>
                                                                                                                    <input type="text" class="form-control" name="client_document_email[]" id="docEmail<?php echo $cli_doc_id; ?>" placeholder="Enter Email Address">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-12">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="docAddress<?php echo $cli_doc_id; ?>">Address:</label>
                                                                                                                    <textarea class="form-control" name="client_document_address[]" id="docAddress<?php echo $cli_doc_id; ?>" placeholder="Enter Address" rows="2"></textarea> 
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-12">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="docRemark<?php echo $cli_doc_id; ?>">Remark:</label>
                                                                                                                    <textarea class="form-control" name="client_document_remark[]" id="docRemark<?php echo $cli_doc_id; ?>" placeholder="Enter Remark" rows="2"></textarea> 
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
                                                                                <h4 class="text-white font-weight-bold m-0">Select Act</h4>
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
                                                                                                <input type="checkbox" name='actId[]' id="actId<?php echo $e_act['act_id']; ?>" class="filled-in acts_checkbox" data-act_name="<?php echo $e_act['act_name']; ?>" value="<?php echo $e_act['act_id']; ?>"/>
                                                                                                <label for="actId<?php echo $e_act['act_id']; ?>" ><?php echo $e_act['act_name']; ?></label>	
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
                                                                        <div class="row text-center selected_acts_div">
                                                                            <div class="col-md-12">
                                                                                <h4>Acts not selected</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row sel_act_due_date"></div>
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
                                                            <div class="row sel_cust_act_due_date"></div>
                                                        </div>
                                                        <!------------------------------------------------ Non-Regular Due Dates - End ------------------------------------------------>
                                                    </div>
                                                </div>
                                                <div class="offset-md-4 offset-lg-4 col-md-4 col-lg-4 text-center">
                                                    <input type="hidden" id="client_active_tab" value="" />
                                                    <button type="button" class="waves-effect waves-light btn btn-submit text-right cliNavBtns" id="cliPrevBtn">Previous</button>
                                                    <button type="button" class="waves-effect waves-light btn btn-submit text-right cliNavBtns" id="cliNextBtn">Next</button>
                                                    <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right" id="cliSubBtn">Submit</button>
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
    

    <div id="addClientGrpModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" id="add_client_group_form">
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
    <!-- /.modal-dialog -->
    
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
            $('#cliSubBtn').prop('disabled', true);
            
            $('.client_form .nav-link').on('click', function(){
                
                var tabName = $(this).attr('href');
                
                if(tabName=="#client_details_tab")
                {
                    $('#cliPrevBtn').prop('disabled', true);
                    $('#cliNextBtn').prop('disabled', false);
                    $('#cliSubBtn').prop('disabled', true);
                    $('#client_active_tab').val(tabName);
                }
                else if(tabName=="#reg_details_tab")
                {
                    $('#cliPrevBtn').prop('disabled', false);
                    $('#cliNextBtn').prop('disabled', false);
                    $('#cliSubBtn').prop('disabled', false);
                    $('#client_active_tab').val(tabName);
                }
                else if(tabName=="#act_applicable_tab")
                {
                    $('#cliPrevBtn').prop('disabled', false);
                    $('#cliNextBtn').prop('disabled', false);
                    $('#cliSubBtn').prop('disabled', false);
                    $('#client_active_tab').val(tabName);
                }
                else if(tabName=="#non_regular_due_date_tab")
                {
                    $('#cliPrevBtn').prop('disabled', false);
                    $('#cliNextBtn').prop('disabled', true);
                    $('#cliSubBtn').prop('disabled', false);
                    $('#client_active_tab').val(tabName);
                }
                else
                {
                    $('#cliPrevBtn').prop('disabled', true);
                    $('#cliNextBtn').prop('disabled', false);
                    $('#cliSubBtn').prop('disabled', true);
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
            
            $('.ind_div input, .ind_div select, .ind_div textarea, .ind_div button').prop('disabled', true);
            $('.buss_div input, .buss_div select, .buss_div textarea').prop('disabled', true);
            $('.photo_div input').prop('disabled', true);
            $('.contact_div input, .contact_div textarea').prop('disabled', true);
            $('#clientGroupNew, #clientGroupBtnNew').prop('disabled', true);
            // $('#client_grp_row input, #client_grp_row select').prop('disabled', true);
    
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
    
                var cli_pt_tbl='<tr class="row-3 cli_pt_row_'+cli_pt+'" style="background-color:#f6fbff;"><td class="column-1">'+client_partner_name+'<input type="hidden" name="client_partner_name[]" value="'+client_partner_name+'" /></td><td class="column-1">'+client_partner_text+'<input type="hidden" name="client_partner_text[]" value="'+client_partner_text+'" /></td><td class="column-1">'+client_partner_pan+'<input type="hidden" name="client_partner_pan[]" value="'+client_partner_pan+'" /></td><td class="column-1">'+client_partner_aadhar+'<input type="hidden" name="client_partner_aadhar[]" value="'+client_partner_aadhar+'" /></td><td class="column-1">'+client_partner_appt_date+'<input type="hidden" name="client_partner_appt_date[]" value="'+client_partner_appt_date+'" /></td><td class="column-1">'+client_partner_date+'<input type="hidden" name="client_partner_date[]" value="'+client_partner_date+'" /></td><td class="column-1"><button type="button" name="button" class="btn btn-danger text-left del_cli_pt" data-id="'+cli_pt+'">Delete</button></td></tr>';
    
                $('#client_partner_tbl').append(cli_pt_tbl);
    
                $('#addClientPartnerModal').modal('hide');
                $('.modal-backdrop').remove();
    
                $('#add_client_partner_form')[0].reset();
    
                cli_pt++;
                
                $('#cli_pt_empty').hide();
            });
    
            $('body').on('click', '.del_cli_pt', function(){
    
                var cli_pt_id = $(this).data('id');
    
                $('.cli_pt_row_'+cli_pt_id).remove();
    
            });
        });
    
    </script>
    
    <script type="text/javascript">
                
        $(document).ready(function(){
    
            var base_url = "<?php echo base_url(); ?>";
    
            var selectedActsText = "";
            var selectedActsArr = [];
            var selectedActIdsArr = [];
            $('.acts_checkbox').on('click', function(){
    
                selectedActsText = "";
                selectedActsArr = [];
                selectedActIdsArr = [];
    
                $(".acts_checkbox:checked").each(function(){
    
                    // var actText=$(this).siblings('label').text();
                    var actText=$(this).data('act_name');
                    var actId=$(this).val();
    
                    selectedActsArr.push(actText);
                    selectedActIdsArr.push(actId);
                });
    
                $(selectedActsArr).each(function(i, val){
    
                    var selActId=selectedActIdsArr[i];
    
                    selectedActsText+='<div class="col-md-4 getActModal" data-actid="'+selActId+'"><div class="box box-inverse box-primary"><div class="box-header box-head with-border"><h4 class="box-title"><strong>'+val+'</strong></h4></div></div></div>';
                });
    
                $('.selected_acts_div').html(selectedActsText);
            });

            var selectedCustActsText = "";
            var selectedCustActsArr = [];
            var selectedCustActIdsArr = [];
            $('.edit_cust_acts_checkbox').on('click', function(){
    
                selectedCustActsText = "";
                selectedCustActsArr = [];
                selectedCustActIdsArr = [];
    
                $(".edit_cust_acts_checkbox:checked").each(function(){
    
                    var actText=$(this).data('act_name');
                    var actId=$(this).val();
    
                    selectedCustActsArr.push(actText);
                    selectedCustActIdsArr.push(actId);
                });
    
                $(selectedCustActsArr).each(function(i, val){
    
                    var selActId=selectedCustActIdsArr[i];
    
                    selectedCustActsText+='<div class="col-md-4 getCustActModal" data-actid="'+selActId+'"><div class="box box-inverse box-primary"><div class="box-header box-head with-border"><h4 class="box-title"><strong>'+val+'</strong></h4></div></div></div>';
                });
    
                $('.edit_selected_cust_acts_div').html(selectedCustActsText);
            });
    
            $('body').on('click', '.getActModal', function(){
    
                var selAct = $(this).data('actid');
                var selActName = $(this).find('h4').text();
                var clientName = $('#clientName').val();
                var clientBussOrganisation = $('#clientBussOrganisation').val();
                var clientBussOrganisationTypeId = $('#clientBussOrganisationType').val();
                
                if($('#clientBussOrganisationType').val()!="")
                    var clientBussOrganisationType = $('#clientBussOrganisationType option:selected').text();
                else
                    var clientBussOrganisationType = "";
                    
                var clientRegDocument = $('#clientRegDocument').val();
                var panNo = $('#docName1').val();
                var tanNo = $('#docName2').val();
                var aadharNo = $('#docName3').val();
                var dinNo = $('#docName4').val();
                var gstNo = $('#docName5').val();
                var ptEnrollNo = $('#docName6').val();
                var ptRegNo = $('#docName7').val();
                var udyamNo = $('#docName8').val();
                var impExpNo = $('#docName9').val();
                var shopEstNo = $('#docName10').val();
                var wardNo = $('#docName11').val();
                var tmNo = $('#docName13').val();
                var tcsNo = $('#docName14').val();
    
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
                    $('#docName1').val(actPanVal);
                    $('#actPanValue').val(actPanVal);
                }
    
                if(actWardVal!="")
                {
                    $('#docName11').val(actWardVal);
                }
    
                if(actGstVal!="")
                {
                    $('#docName5').val(actGstVal);
                }
    
                if(actCinVal!="" || actLlpinVal!="" || actRofregnVal!="" || actRegnVal!="" || actTrustDeedVal!="")
                {
                    $('#clientRegDocument').val(clientRegDocument);
                }
    
                if(actTanVal!="")
                {
                    $('#docName2').val(actTanVal);
                }
    
                if(actPtEnrollNoVal!="")
                {
                    $('#docName6').val(actPtEnrollNoVal);
                }
    
                if(actPtRegNoVal!="")
                {
                    $('#docName7').val(actPtRegNoVal);
                }
    
                if(actShopEstNoVal!="")
                {
                    $('#docName10').val(actShopEstNoVal);
                }
                
                if(actUdyamNoVal!="")
                {
                    $('#docName8').val(actUdyamNoVal);
                }
                
                if(actTmNoVal!="")
                {
                    $('#docName13').val(actTmNoVal);
                }
                
                if(actTcsNoVal!="")
                {
                    $('#docName14').val(actTcsNoVal);
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
                        
                        var actTaxPayer=$('#clientBussOrganisationType').val();
                        
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
    
        });
    
    </script>
    
    <script type="text/javascript">
                
        $(document).ready(function(){
    
            $('.register_div').hide();
            $('.edit_client_section').hide();
            // $('.register_div_1').html('<p class="text-danger text-center">Please Select Type of Organisation from Business Details...</p>');
            $('.register_div_1').html('<p class="text-danger text-center"></p>');
            $('.register_label').text("N/A");
    
            $('#clientBussOrganisationType').on('change', function(){
                
                $('#clientName').val("");
                $('#clientContactPerson').val("");
                
                var orgType = $(this).val();
                
                var clientBussOrganisationType = $('#clientBussOrganisationType option:selected').text();
                
                if(orgType!="")
                    $('#clientTypeText').val(clientBussOrganisationType);
                else
                    $('#clientTypeText').val("");
                
                $('.register_div_1').hide();
                
                if(orgType=="")
                {
                    $('.register_div').hide();
                    $('.register_label').text("N/A");
                }
                else if(orgType=="1")
                {
                    $('.register_div').show();
                    $('#clientRegDocument').attr('placeholder', 'Enter CIN Number');
                    $('.register_label').text("CIN Number:");
                }
                else if(orgType=="2")
                {
                    $('.register_div').show();
                    $('#clientRegDocument').attr('placeholder', 'Enter LLPIN');
                    $('.register_label').text("LLPIN:");
                }
                else if(orgType=="3")
                {
                    $('.register_div').show();
                    $('#clientRegDocument').attr('placeholder', 'Enter OPCIN');
                    $('.register_label').text("OPCIN:");
                }
                else if(orgType=="4")
                {
                    $('.register_div').show();
                    $('#clientRegDocument').attr('placeholder', 'Enter ROF Regn No');
                    $('.register_label').text("ROF Regn No :");
                }
                else if(orgType=="5")
                {
                    $('.register_div').show();
                    $('#clientRegDocument').attr('placeholder', 'Enter Regn No');
                    $('.register_label').text("Regn No:");
                }
                else if(orgType=="6")
                {
                    $('.register_div').show();
                    $('#clientRegDocument').attr('placeholder', 'Enter Regn No');
                    $('.register_label').text("Regn No:");
                }
                else if(orgType=="7")
                {
                    $('.register_div').show();
                    $('#clientRegDocument').attr('placeholder', 'Enter Regn No (if any)');
                    $('.register_label').text("Regn No (if any):");
                    // $('.register_label').text("As per Trust Deed:");
                }
                else if(orgType=="8")
                {
                    $('.register_div').hide();
                    $('.register_label').text("N/A");
                }
                else if(orgType=="9")
                {
                    $('.register_div').hide();
                    $('.register_label').text("N/A");
                    
                    // $('.register_div').show();
                    // $('.register_label').text("As per HUF Deed:");
                }
                else if(orgType=="10")
                {
                    $('.register_div').hide();
                    $('.register_label').text("N/A");
                    
                    // $('.register_div').show();
                    // $('.register_label').text("As per JV Deed:");
                }
                else if(orgType=="11")
                {
                    $('.register_div').show();
                    $('#clientRegDocument').attr('placeholder', 'Enter Regn No (if any)');
                    $('.register_label').text("Regn No (if any):");
                    
                    // $('.register_div').hide();
                    // $('.register_label').text("N/A");
                }
                else if(orgType=="12")
                {
                    $('.register_div').show();
                    $('#clientRegDocument').attr('placeholder', 'Enter Regn No (if any)');
                    $('.register_label').text("Regn No (if any):");
                    
                    // $('.register_div').hide();
                    // $('.register_label').text("N/A");
                }
                else if(orgType=="13")
                {
                    $('.register_div').hide();
                    $('.register_label').text("N/A");
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
                    $('.register_div').hide();
                    $('.register_label').text("N/A");
                }
    
                if(orgType=="9") //Individual
                {
                    // $('.steps ul li:nth-child(2)').removeClass('disabled');
                    // $('.steps ul li:nth-child(2)').addClass('done');
                    // $('.steps ul li:nth-child(2)').show();
                    // $('.business_div input').prop('disabled', true);
                    // $('#client_grp_row').hide();
                    // $('.register_div').hide();
    
                    $(".doc_row").each(function(){
    
                        var docIdVal=$(this).data('id');
    
                        if(docIdVal=="1" || docIdVal=="3" || docIdVal=="4" || docIdVal=="12")
                            $(this).show();
                        else
                            $(this).hide();
                    });
                }
                else if(orgType=="8" || orgType=="3" || orgType=="22" || orgType=="23") //Proprietory
                {
                    // $('.steps ul li:nth-child(2)').removeClass('disabled');
                    // $('.steps ul li:nth-child(2)').addClass('done');
                    // $('.steps ul li:nth-child(2)').show();
                    // $('.business_div input').prop('disabled', false);
                    // $('#client_grp_row').hide();
                    // $('.register_div').show();
    
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
                    // $('.register_div').show();
    
                    $(".doc_row").each(function(){
                        $(this).show();
                    });
                }
                
                if(orgType=="")
                {
                    $('.ind_div input, .ind_div select, .ind_div textarea, .ind_div button').prop('disabled', true);
                    $('.buss_div input, .buss_div select, .buss_div textarea').prop('disabled', true);
                    $('.contact_div input, .contact_div textarea').prop('disabled', true);
                    $('.photo_div input').prop('disabled', true);
                    $('#clientGroupNew, #clientGroupBtnNew').prop('disabled', true);
                    // $('#client_grp_row input, #client_grp_row select').prop('disabled', true);
                }
                else
                {
                    if(orgType=="9" || orgType=="8" || orgType=="3" || orgType=="22" || orgType=="23")
                    {
                        $('#clientContactPerson').prop('readonly', true);
                    }
                    else
                    {
                        $('#clientContactPerson').prop('readonly', false);
                    }
                    
                    if(orgType=="9") // Individual
                    {
                        $('.ind_div input, .ind_div select, .ind_div textarea, .ind_div button').prop('disabled', false);
                        $('.buss_div input, .buss_div select, .buss_div textarea').prop('disabled', true);
                        $('.contact_div input, .contact_div textarea').prop('disabled', false);
                        $('.photo_div input').prop('disabled', false);
                        $('#clientGroupNew, #clientGroupBtnNew').prop('disabled', true);
                        // $('#client_grp_row input, #client_grp_row select').prop('disabled', false);
                    }
                    else if(orgType=="8" || orgType=="3" || orgType=="22" || orgType=="23") // Proprietory, OPC
                    {
                        $('.ind_div input, .ind_div select, .ind_div textarea, .ind_div button').prop('disabled', false);
                        $('.buss_div input, .buss_div select, .buss_div textarea').prop('disabled', false);
                        $('.contact_div input, .contact_div textarea').prop('disabled', false);
                        $('.photo_div input').prop('disabled', false);
                        $('#clientGroupNew, #clientGroupBtnNew').prop('disabled', true);
                        // $('#client_grp_row input, #client_grp_row select').prop('disabled', false);
                    }
                    else if(orgType!="9" && orgType!="8" && orgType!="3" || orgType!="22" || orgType!="23") // Other Than Individual
                    {
                        $('.ind_div input, .ind_div select, .ind_div textarea, .ind_div button').prop('disabled', true);
                        $('.buss_div input, .buss_div select, .buss_div textarea').prop('disabled', false);
                        $('.contact_div input, .contact_div textarea').prop('disabled', false);
                        $('.photo_div input').prop('disabled', false);
                        $('#clientGroupNew, #clientGroupBtnNew').prop('disabled', false);
                        // $('#client_grp_row input, #client_grp_row select').prop('disabled', false);
                    }
                }
            });
            
            // $('.steps ul li:nth-child(2)').removeClass('done');
            // $('.steps ul li:nth-child(2)').addClass('disabled');
            // $('.steps ul li:nth-child(2)').hide();
            // $('.business_div input').prop('disabled', false);
            // $('#client_grp_row').show();
        });
        
        function setClientName($this)
        {
            var clientName = $this.value;
            var clientBussOrgType = $('#clientBussOrganisationType').val();
            
            if(clientBussOrgType=="9" || clientBussOrgType=="8" || clientBussOrgType=="3" || clientBussOrgType=="22" || clientBussOrgType=="23") // Individual, Proprietory, OPC
            {
                $('#clientContactPerson').val(clientName);
            }
            else
            {
                $('#clientContactPerson').va("");
            }
        }
    
    </script>
    
    <script type="text/javascript">
                
        $(document).ready(function(){
            
            $('.client_form_div').hide();
    
            var base_url = "<?php echo base_url(); ?>";
            
            $('.get_client_section').hide();
            // $('.client_form').hide();
            $('.back_page').hide();
    
            $('.search_client_name_btn').on('click', function(){
    
                var search_client_name = $('#search_client_name').val();
    
                $('#search_client_name_err').text("");
    
                if(search_client_name=="")
                {
                    $('#search_client_name_err').text("Please enter client name");
                    return false;
                }
    
                $.ajax({
                    url : base_url+'/getClients',
                    type : 'POST',
                    data : { 
                        'client_name' : search_client_name,
                        "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                    },
                    dataType: 'html',
                    success : function(data) {
    
                        $('#search_client_name').val("");
    
                        $('.get_client_section').html(data);
                        $('.add_client_top').hide();
                        $('.get_client_section').show();
                        $('.add_client_section').hide();
                        $('.client_list_tbl').hide();
    
                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });
            });
            
            $('.add_client_top').on('click', function(){
                $('.add_client_top').hide();
                $('.add_client_section').hide();
                $('.get_client_section').hide();
                $('.client_list_tbl').hide();
                $('.client_form_div').show();
                // $('.client_form').show();
                $('.back_page').show();
            });
    
            $('.back_page').on('click', function(){
                $('.back_page').hide();
                $('.add_client_top').show();
                $('.add_client_section').show();
                $('.client_list_tbl').show();
                // $('.client_form').hide();
            });
    
            $('body').on('submit', '.client_form', function(e){
    
                e.preventDefault();    
                var clientFormData = new FormData(this);

                var cliOrgType = $('#clientBussOrganisationType').val();
    
                $.ajax({
    				url : base_url+'/add_client',
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
    					
                        $(".vErrSpan").remove();
    					if(resStatus==true)
    					{
    					    var clientId=response['clientId'];
    						// $('.client_form')[0].reset();
                            window.location.href=base_url+"/client/edit_client/"+clientId;
                            // swal("Added", resMsg, "success");
    					}
    					else
    					{
                            $.each(resUserData, function(index, value){
                                
                                $("#"+index).siblings('span').remove();
                        
                                if(value!="")
                                {
                                    if(index == "clientGroup")
                                    {
                                        if(cliOrgType!="")
                                        {
                                            let clientGroupFieldID = "";
                                            if(cliOrgType=="9") // Individual
                                            {
                                                clientGroupFieldID="clientGroup";
                                            }
                                            else if(cliOrgType=="8" || cliOrgType=="3" || cliOrgType=="22" || cliOrgType=="23") // Proprietory, OPC
                                            {
                                                clientGroupFieldID="clientGroup";
                                            }
                                            else if(cliOrgType!="9" && cliOrgType!="8" && cliOrgType!="3" || cliOrgType!="22" || cliOrgType!="23") // Other Than Individual
                                            {
                                                clientGroupFieldID="clientGroupNew";
                                            }

                                            $("#"+clientGroupFieldID).closest('div').append('<span class="text-danger vErrSpan">'+value+'</span>');
                                        }
                                        
                                    }
                                    else
                                    {
                                        $("#"+index).closest('div').append('<span class="text-danger vErrSpan">'+value+'</span>');
                                    }
                                }
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
    
            $('#clientGroup').on('click', function(){
    
                var clientGroup = $(this).val();
    
                if(clientGroup=="")
                {
                    $('#clientCostCenter').val("");
                    $('#clientCategory').val("");
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
                            $('#clientCostCenter').val(resUserData['costCenter']);
                            $('#clientCategory').val(resUserData['categoryName']);
    					}
    
                    },
                    error : function(request, error)
                    {
                        // alert("Request: "+JSON.stringify(request));
                    }
                });
            });
    
            $('#add_client_group_form').on('submit', function(e){
    
                e.preventDefault();    
                var clientGroupFormData = new FormData(this);
    
                // var clientFormData = $('#add_client_group_form').serialize();
    
                var clientGroupDataArr = $('#add_client_group_form').serializeArray();
    
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
                            $('#add_client_group_form')[0].reset();
    
                            var new_client_group_id = resUserData['client_group_id'];
                            var new_client_group_name = resUserData['client_group'];
    
                            var newClientGrp="<option value='"+new_client_group_id+"' selected>"+new_client_group_name+"</option>";
    
                            $('#clientGroup').append(newClientGrp);
    
                            $('#addClientGrpModal').modal('toggle');
                            $('.modal-backdrop').remove();
    
                            // $("#addClientGrpModal").modal({backdrop: false});
    
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
    
            $('.delClient').on('click', function(e){
    
                e.preventDefault();
    
                var clientId = $(this).data('rowid');
    
                swal({
                    title: "Are you sure?",
                    text: "Do you really want to delete this client ?",
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
                            url : base_url+'/delete_client',
                            type : 'POST',
                            data : {
                                'clientId':clientId,
                                "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                            },
                            dataType: 'json',
                            success : function(response) {
    
                                var resStatus = response['status'];
                                var resMsg = response['message'];
                                var resUserData = response['userdata'];
    
                                if(resStatus==true)
                                {
                                    swal("Deleted", resMsg, "success");
    
                                    $('#client_id_tr_'+clientId).remove();
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
    
                    } else {
                        swal("Cancelled", "You cancelled :)", "error");
                    }
                });
    
            });
            
            $('.markAsOld').on('click', function(e){
    
                e.preventDefault();
    
                var clientId = $(this).data('rowid');
    
                swal({
                    title: "Are you sure?",
                    text: "Do you really want to mark this client as left ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Mark it as left!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm){
                    if (isConfirm) {
    
                        $.ajax({
                            url : base_url+'/mark_old_client',
                            type : 'POST',
                            data : {
                                'clientId':clientId,
                                "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                            },
                            dataType: 'json',
                            success : function(response) {
    
                                var resStatus = response['status'];
                                var resMsg = response['message'];
                                var resUserData = response['userdata'];
    
                                if(resStatus==true)
                                {
                                    swal("Marked has left", resMsg, "success");
    
                                    $('#client_id_tr_'+clientId).remove();
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
    
                    } else {
                        swal("Cancelled", "You cancelled :)", "error");
                    }
                });
    
            });
    
            $('.wizard-content .wizard > .actions > ul').append('<li><button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn submit_client">Submit</button></li>');
    
            $('.wizard-content .wizard > .actions > ul li:nth-child(3)').remove();
            
            // $('body').on('click', '.steps li', function(){
                
                // if($(this).hasClass('last'))
                // {
                //     $('.extra_sub_btn').hide();
                // }
                // else
                // {
                //     $('.extra_sub_btn').show();
                // }
                
            // });
    
            $('.wizard-content .wizard > .actions > ul li:nth-child(3)').addClass('submit_client');
            
            $('.steps ul li:not(:first)').removeClass('disabled');
            $('.steps ul li:not(:first)').addClass('done');
            
            $('.wizard-content .wizard > .actions > ul').css('margin-right', '40%');
    
        });
    
    </script>
    
    <script type="text/javascript">
                
        $(document).ready(function(){
    
            var base_url = "<?php echo base_url(); ?>";
    
            $('body').on('click', '.submitActData', function(e){
    
                e.preventDefault();    
                var validForm=true;
                // var actFormData = new FormData($('#actWiseForm'));
                var selectedActId = $('#selectedActId').val();
                var actFormData = $('#actWiseForm').serialize();
    
                var actDataArr = $('#actWiseForm').serializeArray();
    
                $.map(actDataArr, function(n, i){
    
                    var fieldName=n['name'];
    
                    if(fieldName=="actPan")
                    {
                        $('#docName1').val($("#actPan").val());
                    }
    
                    if(fieldName=="actWard")
                    {
                        $('#docName11').val($("#actWard").val());
                    }
                    
                    if(fieldName=="actDin")
                    {
                        $('#docName4').val($("#actDin").val());
                    }
    
                    if(fieldName=="actGst")
                    {
                        $('#docName5').val($("#actGst").val());
                    }
    
                    // if(fieldName=="actCin" || fieldName=="actLlpin" || fieldName=="actRofregn" || fieldName=="actRegn" || fieldName=="actTrustDeed")
                    if(fieldName=="actCin" || fieldName=="actLlpin" || fieldName=="actRofregn" || fieldName=="actRegn")
                    {
                        $('#clientRegDocument').val($("#"+fieldName).val());
                    }
    
                    if(fieldName=="actTan")
                    {
                        $('#docName2').val($("#actTan").val());
                    }
    
                    if(fieldName=="actPtEnrollNo")
                    {
                        $('#docName6').val($("#actPtEnrollNo").val());
                    }
    
                    if(fieldName=="actPtRegNo")
                    {
                        $('#docName7').val($("#actPtRegNo").val());
                    }
    
                    if(fieldName=="actShopEstNo")
                    {
                        $('#docName10').val($("#actShopEstNo").val());
                    }
    
                    $("#"+fieldName).siblings('span').remove();
                    
                    if(n['value']=="")
                    {
                        if(n['name']!="actPtEnrollNo" && n['name']!="actPtRegNo")
                        {
                            validForm=false;
                            $("#"+fieldName).closest('div').append('<span class="text-danger">This field is required</span>');
                        }
                    } 
                });

                $("#ptErrorDiv").html("");

                if(selectedActId == 7)
                {
                    if($("#actPtEnrollNo").val().trim() == "" && $("#actPtRegNo").val().trim() == "")
                    {
                        validForm=false;
                        $("#ptErrorDiv").html(`<span class="text-danger">Please enter at least one of PT Enrolment No or PT Registration No.</span>`);
                    }
                }
    
                if(validForm==false)
                    return false;
                    
                // console.log('validForm', validForm);
                // console.log('actFormData', actFormData);
    
                $.ajax({
                    url : base_url+'/search_due_date',
                    type : 'POST',
                    data : actFormData,
                    dataType: 'html',
                    success : function(response) {
                        
                        console.log('response', response);
                        
                        if(response!="")
                        {
                            $('.sel_act_due_date').append(response);
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

                var selectedActId = $('#due_act').val();
                var actFormData = $('#custActWiseForm').serialize();

                var actDataArr = $('#custActWiseForm').serializeArray();

                console.log("actFormData", actFormData);
                console.log("actDataArr", actDataArr);

                $.ajax({
                    url : base_url+'/set_cust_due_date',
                    type : 'POST',
                    data : actFormData,
                    dataType: 'html',
                    success : function(response) {
                        
                        if(response!="")
                        {
                            if($(".sel_cust_act_due_date .act_tbody_"+selectedActId).length!="")
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
                
                swal({
                    title: "Are you sure?",
                    text: "Do you really want to delete this due date ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm){
                    if (isConfirm) {
    
                        $('.row_'+row_id).remove();
                        
                        swal("Deleted!", "", "success");
                
                    } else {
                        swal("Cancelled", "You cancelled :)", "error");
                    }
                });
    
            });

            $('body').on('click', '.delete_event_due_date', function(){
    
                var row_id=$(this).data('id');
                var due_date_id=$(this).data('due');
                var client_id=$(this).data('client');
                var act_id=$(this).data('act');

                swal({
                    title: "Are you sure?",
                    text: "Do you really want to delete this client's event due date ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm){
                    if (isConfirm) {

                        $('.row_'+row_id).remove();

                        swal("Deleted!", "", "success");
                    } else {
                        swal("Cancelled", "You cancelled :)", "error");
                    }
                });
            });
            
            $(".clientDocInput").on("input", function(){
                var clientDocNo = $(this).val();
                var clientDocInputId = $(this).attr("id");
                var clientDocId = $(this).data("doc_id");
                
                if(clientDocId==1)
                {
                    $('#actPanValue').val(clientDocNo);
                }

                $("#"+clientDocInputId+"Label").val(clientDocNo);
            });
    
        });
    
    </script>
    
    <script type="text/javascript">
    
        function showClientName()
        {
            var clientName = $('#clientName').val();
            var clientBussOrganisation = $('#clientBussOrganisation').val();
            
            var clientNameVal = "";
            
            var clientBussOrganisationTypeId = $('#clientBussOrganisationType').val();
            var clientBussOrganisationType = $('#clientBussOrganisationType option:selected').text();
            
            console.log(clientName);
            console.log(clientBussOrganisation);
            console.log(clientBussOrganisationTypeId);
            console.log(clientBussOrganisationType);
            
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
<?= $this->endSection(); ?>