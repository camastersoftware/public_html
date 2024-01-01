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
    
    .reg_form label, .reg_form span{
        font-size: 16px !important;
    }
    
    .reg_form label{
        padding-left: 20px !important;
    }
    
    /*.font-weight-light {*/
    /*    font-weight: 300 !important;*/
    /*}*/

</style> 

<!-- Main content -->
<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h3 class="box-title font-weight-bold"><?= $pageTitle; ?></h3>
                    <div class="text-right flex-grow">
                        <a href="<?= base_url('home'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark back_page">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="container">
                        <div class="section-title" data-aos="fade-up">
                            <div class="row">
                                <div class="col-xs-8 offset-xs-2 col-sm-8 offset-sm-2 col-md-8 offset-md-2 col-lg-8 offset-lg-2 text-center regHeader">
                                    <h2 class="font-weight-bold"><?= $pageTitle; ?></h2>
                                </div>
                            </div>
                        </div>
                        <form action="<?php //echo $registerLink; ?>" method="POST" id="register_form">
                            <div class="row">
                                <div class="col-md-8 offset-md-2 regi-form reg_form">
                                    <div class="form-group row">
                                        <label class="col-md-4">Company Name</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['companyName']!="" ? $caMasterData['companyName']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Office Address</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['officeAddress']!="" ? $caMasterData['officeAddress']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">CIN Number</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['cinNumber']!="" ? $caMasterData['cinNumber']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">PAN Number</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['panNumber']!="" ? $caMasterData['panNumber']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">TAN Number</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['tanNumber']!="" ? $caMasterData['tanNumber']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">GST Number</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['gstNumber']!="" ? $caMasterData['gstNumber']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Website Address</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['website']!="" ? $caMasterData['website']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Email Address</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['emailAddress']!="" ? $caMasterData['emailAddress']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Landline Number</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['landlineNumber']!="" ? $caMasterData['landlineNumber']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Mobile Number</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['mobileNumber']!="" ? $caMasterData['mobileNumber']:"N/A"; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-8 offset-md-2 regi-form">
                                    <div class="section-title" data-aos="fade-up">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center regHeader">
                                                <h2 class="font-weight-bold">Bank Details</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 offset-md-2 regi-form reg_form">
                                    <div class="form-group row">
                                        <label class="col-md-4">Account Name</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['bankAccountName']!="" ? $caMasterData['bankAccountName']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Bank Name</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['bankName']!="" ? $caMasterData['bankName']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Branch Name</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['bankBranch']!="" ? $caMasterData['bankBranch']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Account Number</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['bankAccountNumber']!="" ? $caMasterData['bankAccountNumber']:"N/A"; ?></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">IFSC Code</label>
                                        <label class="col-md-1">:</label>
                                        <span class="font-weight-light col-md-7"><?= $caMasterData['bankIFSC']!="" ? $caMasterData['bankIFSC']:"N/A"; ?></span>
                                    </div>
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