<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
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

    table.dataTable {
        margin-top: 0px !important; 
    }

    .tablepress td, .tablepress th {
        font-weight: 600;
    }

    td.column-1 {
        font-size:14px;
    }

    .tablepress tbody tr:first-child td {
        background: #ffffff;
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
        height: 66px !important;
        line-height: 50px !important;
    }
    
</style>

<!-- Main content -->
<section class="content mt-35 client_form_div">
    <div class="row">
        <div class="col-12">
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">Client Registration</h4>
                    <div class="text-right flex-grow hide">
                        <button type="button" class="waves-effect waves-light btn btn-submit add_client_top">Create New Client</button>
                        <button type="button" class="waves-effect waves-light btn btn-dark back_page">Back</button>
                    </div>
                </div>
                <div class="box-body box_body_bg wizard-content">
                    <section class="add_client_section hide">
                        <h4>Add/Modify Existing Client</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="client-name">Enter Client Name:</label>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search_client_name" id="search_client_name" placeholder="Enter Client Name"> 
                                    <label id="search_client_name_err" class="text-danger"></label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="waves-effect waves-light btn btn-submit search_client_name_btn">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="get_client_section"></section>
                    <form action="javascript:void(0);" class="tab-wizard wizard-circle client_form" enctype="multipart/form-data">
                        <h6>CLIENT DETAILS</h6>
                        <section>
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
                            <div class="row business_div">
                                <div class="col-md-6">
                                    <h4 class="font-weight-bold">Personal Details : </h4> 
                                    <div class="row ind_div">
                                        <div class="col-md-8">
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
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientName">Name of Client:</label>
                                                <input type="text" class="form-control" name="clientName" id="clientName" placeholder="(First Name) (Middle Name) (Last Name) as per PAN" onkeyup="setClientName(this);showClientName();" onkeydown="setClientName(this);showClientName();" onkeypress="setClientName(this);showClientName();" oninput="setClientName(this);showClientName();" onfocus="setClientName(this);showClientName();"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientFatherName">Father Name:</label>
                                                <input type="text" class="form-control" name="clientFatherName" id="clientFatherName" placeholder="Enter Father Name"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientSpouseName">Spouse Name :</label>
                                                <input type="text" class="form-control" name="clientSpouseName" id="clientSpouseName" placeholder="Enter Spouse Name"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientDob">Date of Birth :</label>
                                                <input type="date" class="form-control" name="clientDob" id="clientDob" placeholder="Enter Date of Birth"> 
                                            </div>
                                        </div>
                                        <!--<div class="col-md-8">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label for="clientPassport">Passport:</label>-->
                                        <!--        <input type="text" class="form-control" name="clientPassport" id="clientPassport" placeholder="Enter Passport Number"> -->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussOrganisationEmp">Organisation Name :</label>
                                                <input type="text" class="form-control" name="clientBussOrganisationEmp" id="clientBussOrganisationEmp" placeholder="Enter Organisation Name (Employed With)"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientQualification">Qualification:</label>
                                                <input type="text" class="form-control" name="clientQualification" id="clientQualification" placeholder="Enter Qualification"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientOccupation">Occupation:</label>
                                                <input type="text" class="form-control" name="clientOccupation" id="clientOccupation" placeholder="Enter Occupation"> 
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="font-weight-bold mt-30">Business Details : </h4> 
                                    <div class="row buss_div">
                                        <!--<div class="col-md-8">-->
                                            
                                        <!--</div>-->
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussOrganisation">Organisation Name :</label>
                                                <input type="text" class="form-control" name="clientBussOrganisation" id="clientBussOrganisation" placeholder="Enter Organisation Name" oninput="showClientName();" onkeyup="showClientName();" onkeydown="showClientName();" onkeypress="showClientName();" onfocus="showClientName();"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussIncorporationDate">Date of Incorporation/Registration:</label>
                                                <input type="date" class="form-control" name="clientBussIncorporationDate" id="clientBussIncorporationDate"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussNature">Nature of Business :</label>
                                                <input type="text" class="form-control" name="clientBussNature" id="clientBussNature" placeholder="Enter Nature of Business"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussWebsite">Website URL :</label>
                                                <input type="text" class="form-control" name="clientBussWebsite" id="clientBussWebsite" placeholder="Enter Website URL"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row photo_div">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Upload Photo/Logo: </label>
                                                <label class="file">
                                                    <input type="file" name="clientProfileImg" id="clientProfileImg">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 contact_div">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <h4 class="font-weight-bold">Contact Details :</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientContactPerson">Contact Person Name :</label>
                                                <input type="text" class="form-control" name="clientContactPerson" id="clientContactPerson" placeholder="Enter Contact Person Name"> 
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussMobile1">Mobile 1 :</label>
                                                <input type="tel" class="form-control" name="clientBussMobile1" id="clientBussMobile1" placeholder="Enter Mobile 1"> 
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussMobile2">Mobile 2 :</label>
                                                <input type="tel" class="form-control" name="clientBussMobile2" id="clientBussMobile2" placeholder="Enter Mobile 2"> 
                                            </div>
                                        </div>
                                    </div>   
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussEmail1">Email 1 :</label>
                                                <input type="email" class="form-control" name="clientBussEmail1" id="clientBussEmail1" placeholder="Enter Email 1"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussEmail2">Email 2 :</label>
                                                <input type="email" class="form-control" name="clientBussEmail2" id="clientBussEmail2" placeholder="Enter Email 2"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientResidentialAddress">Residential Address:</label>
                                                <input type="text" class="form-control" name="clientResidentialAddress" id="clientResidentialAddress" placeholder="Enter Residential Address"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussResidencePhone">Residence Phone :</label>
                                                <input type="tel" class="form-control" name="clientBussResidencePhone" id="clientBussResidencePhone" placeholder="Enter Residence Phone"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussOfficeAddress">Office Address :</label>
                                                <input type="text" class="form-control" name="clientBussOfficeAddress" id="clientBussOfficeAddress" placeholder="Enter Office Address"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussOfficePhone1">Office Phone Number :</label>
                                                <input type="tel" class="form-control" name="clientBussOfficePhone1" id="clientBussOfficePhone1" placeholder="Enter Office Phone Number"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussRegisteredAddress">Registered Office Address :</label>
                                                <input type="text" class="form-control" name="clientBussRegisteredAddress" id="clientBussRegisteredAddress" placeholder="Enter Registered Address"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussOfficePhone2">Registered Office Phone No :</label>
                                                <input type="tel" class="form-control" name="clientBussOfficePhone2" id="clientBussOfficePhone2" placeholder="Enter Registered Office Phone No"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussFactoryAddress">Factory Address :</label>
                                                <input type="text" class="form-control" name="clientBussFactoryAddress" id="clientBussFactoryAddress" placeholder="Enter Factory Address"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussFactoryPhone">Factory Phone Number :</label>
                                                <input type="tel" class="form-control" name="clientBussFactoryPhone" id="clientBussFactoryPhone" placeholder="Enter Factory Phone Number"> 
                                            </div>
                                        </div>
                                    </div>    
                                    
                                    <!--<div class="row">-->
                                    <!--    <div class="col-md-2"></div>-->
                                    <!--    <div class="col-md-8">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <label for="clientBussWhatsApp">Mobile (WhatsApp) :</label>-->
                                    <!--            <input type="tel" class="form-control" name="clientBussWhatsApp" id="clientBussWhatsApp" placeholder="Enter Mobile (WhatsApp)"> -->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div> -->
                                </div>
                            </div> 
                            <div class="row" id="client_grp_row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="clientGroup">Client Group:</label>
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
                            <div class="row mt-10">
                                <div class="col-md-12 text-right">
                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-submit text-right" data-toggle="modal" data-target="#addClientPartnerModal">Add Partner</button>
                                </div>
                                <div class="col-md-12 mt-20">
                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer">
                                        <thead>
                                            <tr class="row-1">
                                                <th class="column-2">Partner</th>
                                                <th class="column-3">DIN</th>
                                                <th class="column-3">PAN</th>
                                                <th class="column-3">Aadhar No</th>
                                                <th class="column-5">Appointment Date</th>
                                                <th class="column-4">Cessation Date</th>
                                                <th class="column-6">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="row-hover" id="client_partner_tbl">
                                            <td class="column-1 text-center" colspan="7" id="cli_pt_empty">No records</td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <!--
                        <h6>INDIVIDUAL DETAILS</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Personal Info: Applicable in case of individuals & proprietors only</h4>
                                    <div class="row">
                                        
                                        
                                        	
                                    </div> 
                                </div>
                                <div class="col-md-6 cont_personal">
                                    <h4>Contact Details :</h4>
                                    <div class="row">
                                        <div class="col-md-2">    
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientMobile1">Mobile 1 :</label>
                                                <input type="tel" class="form-control" name="clientMobile1" id="clientMobile1" placeholder="Enter Mobile 1"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientMobile2">Mobile 2 :</label>
                                                <input type="tel" class="form-control" name="clientMobile2" id="clientMobile2" placeholder="Enter Mobile 2"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientWhatsApp">Mobile (WhatsApp):</label>
                                                <input type="tel" class="form-control" name="clientWhatsApp" id="clientWhatsApp" placeholder="Mobile (WhatsApp)"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientResidencePhone">Residence Phone :</label>
                                                <input type="tel" class="form-control" name="clientResidencePhone" id="clientResidencePhone" placeholder="Enter Residence phone"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientOfficePhone1">Office Phone 1 :</label>
                                                <input type="tel" class="form-control" name="clientOfficePhone1" id="clientOfficePhone1" placeholder="Enter Office Phone 1"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientOfficePhone2">Office Phone 2 :</label>
                                                <input type="tel" class="form-control" name="clientOfficePhone2" id="clientOfficePhone2" placeholder="Enter Office Phone 2"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientFactoryPhone">Factory Phone :</label>
                                                <input type="tel" class="form-control" name="clientFactoryPhone" id="clientFactoryPhone" placeholder="Enter Factory Phone"> 
                                            </div>
                                        </div> 
                                    </div>  
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientEmail1">Email 1 :</label>
                                                <input type="email" class="form-control" name="clientEmail1" id="clientEmail1" placeholder="Enter Email 1"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientEmail2">Email 2 :</label>
                                                <input type="email" class="form-control" name="clientEmail2" id="clientEmail2" placeholder="Enter Email 2"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="clientGroup">Client Group:</label>
                                        <select class="custom-select form-control" name="clientGroupInd" id="clientGroupInd">
                                            <option value="">Select Client Group</option>
                                            <?php //if(!empty($groupList)): ?>
                                                <?php //foreach($groupList AS $e_grp): ?>
                                                    <option value="<?php //echo $e_grp['client_group_id']; ?>"><?php //echo $e_grp['client_group']; ?></option>
                                                <?php //endforeach; ?>
                                            <?php //endif; ?>
                                        </select> 
                                    </div>
                                    <button type="button" name="Add" class="waves-effect waves-light btn btn-submit text-right" data-toggle="modal" data-target="#addClientGrpModal">Add Client Group</button>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="clientCostCenter">Cost Center:</label>
                                        <input type="text" class="form-control" name="clientCostCenter" id="clientCostCenter">
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="clientCategory">Category:</label>
                                        <input type="text" class="form-control" name="clientCategory" id="clientCategory"> 
                                    </div>
                                </div>
                            </div>
                        </section>
                        -->
                        <h6>REGISTRATION DETAILS</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-12 d-flex">
                                    <h4 id="clientNameLabel" class="font-weight-bold">Client Name:</h4>
                                    &nbsp;&nbsp;
                                    <h4 class="font-weight-bold clientNameLabelVal"></h4>
                                </div>
                                <div class="col-md-12 register_div_1 text-center"></div>
                                <div class="col-md-12 register_div">
                                    <div class="row doc_row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="clientRegDocument" class="register_label font-weight-bold" style="font-size:17px;">N/A</label>
                                                <input type="text" class="form-control" name="clientRegDocument" id="clientRegDocument" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="clientRegDocumentIssueDate">Issue Date:</label>
                                                <input type="date" class="form-control" name="clientRegDocumentIssueDate" id="clientRegDocumentIssueDate"> 
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="clientRegDocumentEffectiveDate">Effective Date :</label>
                                                <input type="date" class="form-control" name="clientRegDocumentEffectiveDate" id="clientRegDocumentEffectiveDate">  
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="clientRegDocumentFile">Document File :</label>
                                                <input type="file" name="clientRegDocumentFile" id="clientRegDocumentFile"> 
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-12">
                                    <?php if(!empty($documentList)): ?>
                                        <?php foreach($documentList AS $e_doc): ?>
                                        <?php $cli_doc_id=$e_doc['client_document_id']; ?>
                                        <div class="row doc_row" data-id="<?php echo $cli_doc_id; ?>">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="docName<?php echo $cli_doc_id; ?>"><?php echo $e_doc['client_document_name']; ?>:</label>
                                                    <input type="text" class="form-control" name="client_document_number[]" id="docName<?php echo $cli_doc_id; ?>" placeholder="Enter <?php echo $e_doc['client_document_name']; ?>"> 
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="docIssueDate<?php echo $cli_doc_id; ?>">Issue Date :</label>
                                                    <input type="date" class="form-control" name="client_document_issue_date[]" id="docIssueDate<?php echo $cli_doc_id; ?>"> 
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="docEffectiveDate<?php echo $cli_doc_id; ?>">Effective Date :</label>
                                                    <input type="date" class="form-control" name="client_document_effective_date[]" id="docEffectiveDate<?php echo $cli_doc_id; ?>"> 
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="docFile<?php echo $cli_doc_id; ?>">Document :</label>
                                                    <input type="file" name="client_document_file_<?php echo $cli_doc_id; ?>" id="docFile<?php echo $cli_doc_id; ?>">
                                                    <input type="hidden" name="client_document_id[]" value="<?php echo $cli_doc_id; ?>">  
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>     
                        </section>
                        <h6>ACT APPLICABLE</h6>
                        <hr>
                        <section>
                            <div class="row">
                                <div class="col-md-12 d-flex">
                                    <h4 id="clientNameLabel" class="font-weight-bold">Client Name:</h4>
                                    &nbsp;&nbsp;
                                    <h4 class="font-weight-bold clientNameLabelVal"></h4>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4>ACT APPLICABLE</h4>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <a href="<?php echo base_url('tax_calendar'); ?>" target="_blank">
                                                <button type="button" class="btn btn-sm btn-submit" >Tax Calendar</button>
                                            </a>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="demo-checkbox mb-20">
                                                <div class="row">
                                                    <?php if(!empty($actList)): ?>
                                                        <?php foreach($actList AS $e_act): ?>
                                                            <div class="col-md-3">
                                                                <input type="checkbox" name='actId[]' id="actId<?php echo $e_act['act_id']; ?>" class="filled-in acts_checkbox" data-act_name="<?php echo $e_act['act_short_name']; ?>" value="<?php echo $e_act['act_id']; ?>"/>
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
                                <div class="col-md-12">
                                    <h4>ACT APPLICABLE</h4>
                                    <div class="demo-checkbox">
                                        <div class="row mt-20 text-center selected_acts_div">
                                            <div class="col-md-12">
                                                <h4>Acts not selected</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row sel_act_due_date"></div>
                        </section>                   
                    </form>
                </div>
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
                        Client List
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?= base_url('create-client'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Create New Client</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th width="5%">Grp&nbsp;No</th>
                                    <th width="5%">Group&nbsp;Name</th>
                                    <th width="20%">Client&nbsp;Name</th>
                                    <th>Status</th>
                                    <th>DOB/DOI</th>
                                    <th>PAN</th>
                                    <!--<th width="5%">Cost&nbsp;Center</th>-->
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php $currGrp=""; ?>
                                <?php $prevGrp=""; ?>
                                <?php $clrCnt=1; ?>
                                <?php if(!empty($getClientList)): ?>
                                    <?php foreach($getClientList AS $e_row): ?>
                                        <?php $client_group_num=$e_row['client_group_number']; ?>
                                        <?php $currGrp=$client_group_num; ?>
                                        
                                        <?php
                                            if($currGrp!=$prevGrp)
                                                $clrCnt++;
                                            
                                            $clrSeq=($clrCnt%2);
                                            
                                            if($clrSeq==0)
                                                $grpClr="#005495";
                                            else
                                                $grpClr="#f48b04";
                                        ?>
                                        
                                        <tr id="client_id_tr_<?php echo $e_row['clientId']; ?>">
                                            <td class="text-center" width="5%"><?php echo $i; ?></td>
                                            <td class="text-center" width="5%" >
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $e_row['client_group']; ?>" style="color: <?= $grpClr; ?> !important;">
                                                    <?php
                                                        if(!empty($client_group_num))
                                                            echo $client_group_num;
                                                        else 
                                                            echo " "; 
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="text-center" width="5%" nowrap><?= ($currGrp!=$prevGrp) ? $e_row['client_group'] : '--"--'; ?></td>
                                            <td width="20%" nowrap>
                                                <?php
                                                    $cliOrgNameVar = (!empty($e_row['clientBussOrganisation'])) ? $e_row['clientBussOrganisation'] : "";
                                                    
                                                    if($e_row['orgType']==8)
                                                        $cliNameVar = $e_row['clientName'].$cliOrgNameVar;
                                                    elseif($e_row['orgType']==9 || $e_row['orgType']==22 || $e_row['orgType']==23)
                                                        $cliNameVar = $e_row['clientName'];
                                                    else
                                                        $cliNameVar = $e_row['clientBussOrganisation']; 
                                                ?>
                                                <a href="<?php echo base_url('client/edit_client/'.$e_row['clientId']); ?>" >
                                                    <?= display_client_name($e_row['orgType'], $e_row['clientName'], $cliOrgNameVar); ?>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <span data-toggle="tooltip" data-original-title="<?= $e_row['organisation_type_name']; ?>" style="cursor: pointer;">
                                                    <?php 
                                                        if(!empty($e_row['shortName']))
                                                            echo $e_row['shortName'];
                                                        else 
                                                            echo " "; 
                                                    ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(in_array($e_row['orgType'], INDIVIDUAL_ARRAY))
                                                    {
                                                        if(!empty($e_row['clientDob']) && $e_row['clientDob']!="0000-00-00")
                                                            echo date("d-m-Y", strtotime($e_row['clientDob']));
                                                        else 
                                                            echo " "; 
                                                    }
                                                    else
                                                    {
                                                        if(!empty($e_row['clientBussIncorporationDate']) && $e_row['clientBussIncorporationDate']!="0000-00-00")
                                                            echo date("d-m-Y", strtotime($e_row['clientBussIncorporationDate']));
                                                        else 
                                                            echo " "; 
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['clientPanNumber']))
                                                        echo $e_row['clientPanNumber'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <!--<td class="text-center" width="5%"><?php //echo $e_row['userShortName']; ?></td>-->
                                            <td class="text-center" width="5%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="<?php echo base_url('client/edit_client/'.$e_row['clientId']); ?>" ><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                                        <a class="dropdown-item" href="<?php echo base_url('client/view_client/'.$e_row['clientId']); ?>" ><i class="fa fa-file"></i>&nbsp;View Documents</a>
                                                        <a class="dropdown-item markAsOld" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Mark As Left" data-rowId="<?php echo $e_row['clientId']; ?>"><i class="fa fa-ban"></i>&nbsp;Mark As Left</a>
                                                        <a class="dropdown-item delClient" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Delete" data-rowId="<?php echo $e_row['clientId']; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                        <?php $prevGrp=$client_group_num; ?>
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
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Cost Center <small class="text-danger">*</small></label>
                                <select class="form-control select2" style="width: 100%;" name="mcost_center" id="mcost_center" >
                                    <option value="">Select</option>
                                    <?php if(!empty($userList)): ?>
                                        <?php foreach($userList AS $e_user): ?>
                                        <option value="<?php echo $e_user['userId']; ?>" ><?php echo $e_user['userFullName']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Category<small class="text-danger">*</small></label>
                                <select class="form-control select2" style="width: 100%;" name="mcategory" id="mcategory" >
                                    <option value="">Select</option>
                                    <?php if(!empty($groupCatList)): ?>
                                        <?php foreach($groupCatList AS $e_g_cat): ?>
                                        <option value="<?php echo $e_g_cat['group_category_id']; ?>" ><?php echo $e_g_cat['group_category_name']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
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

<div id="addClientPartnerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="add_client_partner_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Client Partner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Partner Name<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" id="client_partner_name" placeholder="Enter Partner Name" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>DIN<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" id="client_partner_text" placeholder="Enter DIN" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>PAN<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" id="client_partner_pan" placeholder="Enter PAN" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Aadhar No<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" id="client_partner_aadhar" placeholder="Enter Aadhar No" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Appointment Date<small class="text-danger">*</small></label>
                                <input type="date" class="form-control" id="client_partner_appt_date" placeholder="Enter Appointment Date" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Cessation Date<small class="text-danger">*</small></label>
                                <input type="date" class="form-control" id="client_partner_date" placeholder="Enter Cessation Date" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="button" class="btn btn-success text-left add_client_partner">Submit</button>
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

<script type="text/javascript">
            
    var cli_pt=1;

    $(document).ready(function(){
        
        $('.ind_div input, .ind_div select').prop('disabled', true);
        $('.buss_div input').prop('disabled', true);
        $('.photo_div input').prop('disabled', true);
        $('.contact_div input').prop('disabled', true);
        $('#client_grp_row input, #client_grp_row select').prop('disabled', true);

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

                selectedActsText+='<div class="col-md-3 getActModal" data-actid="'+selActId+'"><div class="box box-inverse box-primary"><div class="box-header box-head with-border"><h4 class="box-title"><strong>'+val+'</strong></h4></div></div></div>';
            });

            $('.selected_acts_div').html(selectedActsText);
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
                $('.ind_div input, .ind_div select').prop('disabled', true);
                $('.buss_div input').prop('disabled', true);
                $('.contact_div input').prop('disabled', true);
                $('.photo_div input').prop('disabled', true);
                $('#client_grp_row input, #client_grp_row select').prop('disabled', true);
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
                    $('.ind_div input, .ind_div select').prop('disabled', false);
                    $('.buss_div input').prop('disabled', true);
                    $('.contact_div input').prop('disabled', false);
                    $('.photo_div input').prop('disabled', false);
                    $('#client_grp_row input, #client_grp_row select').prop('disabled', false);
                }
                else if(orgType=="8" || orgType=="3" || orgType=="22" || orgType=="23") // Proprietory, OPC
                {
                    $('.ind_div input, .ind_div select').prop('disabled', false);
                    $('.buss_div input').prop('disabled', false);
                    $('.contact_div input').prop('disabled', false);
                    $('.photo_div input').prop('disabled', false);
                    $('#client_grp_row input, #client_grp_row select').prop('disabled', false);
                }
                else if(orgType!="9" && orgType!="8" && orgType!="3" || orgType!="22" || orgType!="23") // Other Than Individual
                {
                    $('.ind_div input, .ind_div select').prop('disabled', true);
                    $('.buss_div input').prop('disabled', false);
                    $('.contact_div input').prop('disabled', false);
                    $('.photo_div input').prop('disabled', false);
                    $('#client_grp_row input, #client_grp_row select').prop('disabled', false);
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
        $('.client_form').hide();
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
        
        $('.add_client_top1').on('click', function(){
            $('.add_client_top').hide();
            $('.add_client_section').hide();
            $('.get_client_section').hide();
            $('.client_list_tbl').hide();
            $('.client_form_div').show();
            $('.client_form').show();
            $('.back_page').show();
        });

        $('.back_page').on('click', function(){
            $('.back_page').hide();
            $('.add_client_top').show();
            $('.add_client_section').show();
            $('.client_list_tbl').show();
            $('.client_form').hide();
        });

        $('body').on('submit', '.client_form', function(e){

            e.preventDefault();    
            var clientFormData = new FormData(this);
		    
		    // var clientFormData = $('.client_form').serialize();

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
            
            var mcost_center = $('#mcost_center option:selected').text();
            var mcategory = $('#mcategory option:selected').text();

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
                        $('#clientCostCenter').val(mcost_center);
                        $('#clientCategory').val(mcategory);
                        
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
                    validForm=false;
                    $("#"+fieldName).closest('div').append('<span class="text-danger">This field is required</span>');
                } 
            });

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
        
        $('.clientNameLabelVal').text(clientNameVal);
    }
</script>

<?= $this->endSection(); ?>