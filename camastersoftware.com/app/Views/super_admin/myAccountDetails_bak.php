<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .form-control.is-valid{
        border-color: 1px solid #ced4da !important;
        padding-right: calc(1.5em+ 0.75rem);
        background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e);
        background-repeat: no-repeat;
        background-position: right calc(0.375em+ 0.1875rem) center;
        background-size: calc(0.75em+ 0.375rem) calc(0.75em+ 0.375rem);
    }

    .owner-login {
       background-color: #f1f1f1;
        padding: 10px 20px;
        color: #015aac;
        font-size: 20px;
        font-weight:600;
    }
    
    .regi-form label{
        font-weight:600;
        color:#000;
    }
    
    .form-control {
        border: 1px solid #393939 !important;
    }
    
    .regHeader{
        background-color: #055595 !important;
        color: #fff !important;
        margin-bottom: 0px !important;
    }
    
    .regHeader h2{
        color: #fff !important;
        /*padding: 15px 20px !important;*/
    }
    
    .reg_form{
        padding-top: 20px;
        padding-bottom: 20px;
        border: 1px solid #055595 !important;
        background: #96c7f242 !important;
    }
    
    .req{
        color: red !important;
    }
    
    select{
        background: #fff !important;
        border-radius: 3px !important;
        border: 1px solid #000 !important;
        color: #6c757d !important;
    }
    
    .btn-info {
        color: #fff !important;
        background-color: #024888 !important;
        border-color: #024888 !important;
    }

</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h3 class="box-title font-weight-bold"><?= $pageTitle; ?></h3>
                    <div class="text-right flex-grow">
                        <a href="<?= base_url('superadmin/home'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark back_page">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="container">
                        <div class="section-title" data-aos="fade-up">
                            <div class="row">
                                <div class="col-md-6 offset-md-3 text-center regHeader">
                                    <h2 class="font-weight-bold"><?= $pageTitle; ?></h2>
                                </div>
                            </div>
                        </div>
                        <form action="<?= base_url('superadmin/updateAccountDetails'); ?>" method="POST" id="register_form">
                            <div class="row">
                                <div class="col-md-6 offset-md-3 regi-form reg_form">
                                    <div class="form-group">
                                        <label>Company Name:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Enter Company Name" value="<?= $accountDataArr['companyName']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Office Address:<span class="req">*</span></label>
                                        <textarea class="form-control" name="officeAddress" id="officeAddress" placeholder="Enter Office Address" required><?= $accountDataArr['officeAddress']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>CIN Number:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="cinNumber" id="cinNumber" placeholder="Enter CIN Number" value="<?= $accountDataArr['cinNumber']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>PAN Number:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="panNumber" id="panNumber" placeholder="Enter PAN Number" value="<?= $accountDataArr['panNumber']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>TAN Number:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="tanNumber" id="tanNumber" placeholder="Enter TAN Number" value="<?= $accountDataArr['tanNumber']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>GST Number:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="gstNumber" id="gstNumber" placeholder="Enter GST Number" value="<?= $accountDataArr['gstNumber']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Website Address:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="website" id="website" placeholder="Enter Website Address" value="<?= $accountDataArr['website']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="emailAddress" id="emailAddress" placeholder="Enter Email Address" value="<?= $accountDataArr['emailAddress']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Landline Number:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="landlineNumber" id="landlineNumber" placeholder="Enter Landline Number" value="<?= $accountDataArr['landlineNumber']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile Number:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="mobileNumber" id="mobileNumber" placeholder="Enter Mobile Number" value="<?= $accountDataArr['mobileNumber']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-3 regi-form">
                                    <div class="section-title" data-aos="fade-up">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center regHeader">
                                                <h2 class="font-weight-bold">Bank Details</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-3 regi-form reg_form">
                                    <div class="form-group">
                                        <label>Account Name:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="bankAccountName" id="bankAccountName" placeholder="Enter Account Name" value="<?= $accountDataArr['bankAccountName']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Bank Name:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="bankName" id="bankName" placeholder="Enter Bank Name" value="<?= $accountDataArr['bankName']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Branch Name:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="bankBranch" id="bankBranch" placeholder="Enter Branch Name" value="<?= $accountDataArr['bankBranch']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Account Number:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="bankAccountNumber" id="bankAccountNumber" placeholder="Enter Account Number" value="<?= $accountDataArr['bankAccountNumber']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>IFSC Code:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="bankIFSC" id="bankIFSC" placeholder="Enter IFSC Code" value="<?= $accountDataArr['bankIFSC']; ?>" required>
                                    </div>
                                    <input type="hidden" name="accountId" id="accountId" value="<?= $accountDataArr['accountId']; ?>" required>
                                    <button type="submit" class="btn btn-info btn-block mt-3 registerBtn" >Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>