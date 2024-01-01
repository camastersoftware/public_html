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
    
</style>

<!-- Main content -->
<section class="content mt-40">
    <div class="row">
        <div class="col-12">
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title">Client Registration</h4>
                    <div class="text-right flex-grow">
                        <button type="button" class="waves-effect waves-light btn btn-submit add_client_top">Create New Client</button>
                        <button type="button" class="waves-effect waves-light btn btn-dark back_page">Back</button>
                    </div>
                </div>
                <div class="box-body wizard-content">
                    <section class="add_client_section">
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
                        <h6>INDIVIDUAL DETAILS</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Personal Info: Applicable in case of individuals & proprietors only</h4>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientTitle">Title :<small class="text-danger">*</small></label>
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
                                                <label for="clientName">Name of Client :<small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" name="clientName" id="clientName" placeholder="Enter Client Name"> 
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
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientPassport">Passport:</label>
                                                <input type="text" class="form-control" name="clientPassport" id="clientPassport" placeholder="Enter Passport Number"> 
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
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientResidentialAddress">Residential Address:</label>
                                                <input type="text" class="form-control" name="clientResidentialAddress" id="clientResidentialAddress" placeholder="Enter Residential Address"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Upload Photo</label>
                                                <label class="file">
                                                    <input type="file" name="clientProfileImg" id="clientProfileImg">
                                                </label>
                                            </div>
                                        </div>	
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
                                        <select class="custom-select form-control" name="clientGroup" id="clientGroup">
                                            <option value="">Select Client Group</option>
                                            <?php if(!empty($groupList)): ?>
                                                <?php foreach($groupList AS $e_grp): ?>
                                                    <option value="<?php echo $e_grp['client_group_id']; ?>"><?php echo $e_grp['client_group']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
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
                        <h6>BUSINESS DETAILS</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Business Details</h4> 
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussOrganisation">Organisation Name :</label>
                                                <input type="text" class="form-control" name="clientBussOrganisation" id="clientBussOrganisation" placeholder="Enter Organisation Name"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussOrganisationType">Type of Organisation :</label>
                                                <select class="custom-select form-control" name="clientBussOrganisationType" id="clientBussOrganisationType">
                                                    <option value="">Select Type of Organisation</option>
                                                    <?php if(!empty($organisationTypes)): ?>
                                                        <?php foreach($organisationTypes AS $e_org): ?>
                                                            <option value="<?php echo $e_org['organisation_type_id']; ?>"><?php echo $e_org['organisation_type_name']; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussIncorporationDate">Date of Incorporation :</label>
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
                                                <label for="clientBussRegisteredAddress">Registered Address :</label>
                                                <input type="text" class="form-control" name="clientBussRegisteredAddress" id="clientBussRegisteredAddress" placeholder="Enter Registered Address"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussOfficeAddress">Office Address :</label>
                                                <input type="text" class="form-control" name="clientBussOfficeAddress" id="clientBussOfficeAddress" placeholder="Enter Office Address"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussFactoryAddress">Factory Address :</label>
                                                <input type="text" class="form-control" name="clientBussFactoryAddress" id="clientBussFactoryAddress" placeholder="Enter Factory Address"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussWebsite">Website URL :</label>
                                                <input type="text" class="form-control" name="clientBussWebsite" id="clientBussWebsite" placeholder="Enter Website URL"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Contact Details :</h4>
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
                                                <label for="clientBussWhatsApp">Mobile (WhatsApp) :</label>
                                                <input type="tel" class="form-control" name="clientBussWhatsApp" id="clientBussWhatsApp" placeholder="Enter Mobile (WhatsApp)"> 
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
                                                <label for="clientBussOfficePhone1">Office Phone 1 :</label>
                                                <input type="tel" class="form-control" name="clientBussOfficePhone1" id="clientBussOfficePhone1" placeholder="Enter Office Phone 1"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussOfficePhone2">Office Phone 2 :</label>
                                                <input type="tel" class="form-control" name="clientBussOfficePhone2" id="clientBussOfficePhone2" placeholder="Enter Office Phone 2"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientBussFactoryPhone">Factory Phone :</label>
                                                <input type="tel" class="form-control" name="clientBussFactoryPhone" id="clientBussFactoryPhone" placeholder="Enter Factory Phone"> 
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
                                        
                                </div>
                            </div> 
                                
                        </section>
                        <h6>REGISTRATION DETAILS</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-12 register_div">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="compy-form row justify-content-center">
                                                <label for="clientRegDocument" class="col-sm-3 col-form-label register_label" style="font-size:17px;">N/A</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="clientRegDocument" id="clientRegDocument">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mt-20">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="clientRegDocumentIssueDate">Issue Date:</label>
                                                <input type="date" class="form-control" name="clientRegDocumentIssueDate" id="clientRegDocumentIssueDate"> 
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="clientRegDocumentEffectiveDate">Effective Date :</label>
                                                <input type="date" class="form-control" name="clientRegDocumentEffectiveDate" id="clientRegDocumentEffectiveDate"> 
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="clientRegDocumentFile">Document File :</label>
                                                <input type="file" name="clientRegDocumentFile" id="clientRegDocumentFile"> 
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-12 register_div_1 text-center"></div>
                                <div class="col-md-12">
                                    <hr>
                                    <?php if(!empty($documentList)): ?>
                                        <?php foreach($documentList AS $e_doc): ?>
                                        <?php $cli_doc_id=$e_doc['client_document_id']; ?>
                                        <div class="row">
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
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>ACT APPLICABLE</h4>
                                    <div class="demo-checkbox mb-20">
                                        <div class="row">
                                            <?php if(!empty($actList)): ?>
                                                <?php foreach($actList AS $e_act): ?>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name='actId[]' id="actId<?php echo $e_act['act_id']; ?>" class="filled-in acts_checkbox" value="<?php echo $e_act['act_id']; ?>"/>
                                                        <label for="actId<?php echo $e_act['act_id']; ?>" ><?php echo $e_act['act_name']; ?></label>	
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>	     
                        </section>
                        <h6>ACT APPLICABLE</h6>
                        <hr>
                        <section>
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
<section class="content client_list_tbl">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title">
                        Client List
                    </h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Business Name</th>
                                    <th>Client Name</th>
                                    <th>Client Group</th>
                                    <th>Cost Center</th>
                                    <th>Junior Allocated</th>
                                    <th>Senior Allocated</th>
                                    <th>PAN No</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php if(!empty($getClientList)): ?>
                                    <?php foreach($getClientList AS $e_row): ?>
                                        <tr id="client_id_tr_<?php echo $e_row['clientId']; ?>">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $e_row['clientBussOrganisation']; ?></td>
                                            <td><?php echo $e_row['clientTitle'].". ".$e_row['clientName']; ?></td>
                                            <td><?php echo $e_row['client_group']; ?></td>
                                            <td><?php echo $e_row['clientCostCenter']; ?></td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            <td>
                                                <?php
                                                    if(!empty($e_row['clientPanNumber']))
                                                        echo $e_row['clientPanNumber'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/client/edit_client/'.$e_row['clientId']); ?>">
                                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fa fa-pencil"></i>&nbsp;Edit
                                                    </button>
                                                </a>
                                                <a href="<?php echo base_url('admin/client/view_client/'.$e_row['clientId']); ?>">
                                                    <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-original-title="View Documents">
                                                        <i class="fa fa-file"></i>&nbsp;View Documents
                                                    </button>
                                                </a>
                                                <button class="btn btn-sm btn-danger delClient" data-toggle="tooltip" data-original-title="Delete" data-rowId="<?php echo $e_row['clientId']; ?>">
                                                    <i class="fa fa-trash"></i>&nbsp;Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Business Name</th>
                                    <th>Client Name</th>
                                    <th>Client Group</th>
                                    <th>Cost Center</th>
                                    <th>Junier Allocated</th>
                                    <th>Senior Allocated</th>
                                    <th>PAN No</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </tfoot>
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

<div class="modal fade actsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="actFormDiv"></div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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

                var actText=$(this).siblings('label').text();
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

            $.ajax({
                url : base_url+'/admin/getActForm',
                type : 'POST',
                data : {
                    'selAct' : selAct,
                    'selActName' : selActName,
                    'clientName' : clientName,
                    'clientBussOrganisation' : clientBussOrganisation,
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
                    'wardNo' : wardNo
                },
                dataType: 'html',
                success : function(data) {

                    $('.actsModal').modal('show');
                    $('#actFormDiv').html(data);

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
        $('.register_div_1').html('<p class="text-danger text-center">Please Select Type of Organisation from Business Details...</p>');
        $('.register_label').text("N/A");

        $('#clientBussOrganisationType').on('change', function(){

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
                $('.register_label').text("CIN Number:");
            }
            else if(orgType=="2")
            {
                $('.register_div').show();
                $('.register_label').text("LLPIN:");
            }
            else if(orgType=="3")
            {
                $('.register_div').show();
                $('.register_label').text("OPCIN:");
            }
            else if(orgType=="4")
            {
                $('.register_div').show();
                $('.register_label').text("ROF Regn No (optional):");
            }
            else if(orgType=="5")
            {
                $('.register_div').show();
                $('.register_label').text("Regn No:");
            }
            else if(orgType=="6")
            {
                $('.register_div').show();
                $('.register_label').text("Regn No:");
            }
            else if(orgType=="7")
            {
                $('.register_div').show();
                $('.register_label').text("As per Trust Deed:");
            }
            else if(orgType=="8")
            {
                $('.register_div').hide();
                $('.register_label').text("N/A");
            }
            else if(orgType=="9")
            {
                $('.register_div').show();
                $('.register_label').text("As per HUF Deed:");
            }
            else if(orgType=="10")
            {
                $('.register_div').show();
                $('.register_label').text("As per JV Deed:");
            }
            else if(orgType=="11")
            {
                $('.register_div').hide();
                $('.register_label').text("N/A");
            }
            else if(orgType=="12")
            {
                $('.register_div').hide();
                $('.register_label').text("N/A");
            }
            else if(orgType=="13")
            {
                $('.register_div').hide();
                $('.register_label').text("N/A");
            }
            else
            {
                $('.register_div').hide();
                $('.register_label').text("N/A");
            }

        });
    });

</script>

<script type="text/javascript">
            
    $(document).ready(function(){

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
                url : base_url+'/admin/getClients',
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
				url : base_url+'/admin/add_client',
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
                        window.location.href=base_url+"/admin/clients";
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
                url : base_url+'/admin/getClientGroups',
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
                url : base_url+'/admin/add_remote_client_group',
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
                        url : base_url+'/admin/delete_client',
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

                if(fieldName=="actGst")
                {
                    $('#docName5').val($("#actGst").val());
                }

                if(fieldName=="actCin" || fieldName=="actLlpin" || fieldName=="actRofregn" || fieldName=="actRegn" || fieldName=="actTrustDeed")
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

            $.ajax({
                url : base_url+'/admin/search_due_date',
                type : 'POST',
                data : actFormData,
                dataType: 'html',
                success : function(response) {
                    
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

<?= $this->endSection(); ?>