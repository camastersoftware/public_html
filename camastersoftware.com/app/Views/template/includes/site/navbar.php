
    <style>
        .lg_blue{
            background: #96c7f242 !important;
        }
    </style>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="Container-fluid nav-container d-flex">

            <div class="logo mr-auto">
                <!-- <h1 class="text-light"><a href="index.php"><span>Eterna</span></a></h1> -->
                <!-- Uncomment below if you prefer to use an image logo -->
                <a href="index.php"><img src="<?= esc(base_url('assets/images/logo-ca.png')) ?>" alt="" class="img-fluid"></a>
            </div>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="<?php if($uri1==""): ?>active<?php endif; ?>"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="<?php if($uri1=="software"): ?>active<?php endif; ?>"><a href="<?= base_url('software') ?>">Software</a></li>
                    <li class="<?php if($uri1=="tax-calendar"): ?>active<?php endif; ?>"><a href="<?= base_url('tax-calendar') ?>">Tax Calendar</a></li>
                    <li class="<?php if($uri1=="faq"): ?>active<?php endif; ?>"><a href="<?= base_url('faq') ?>">FAQ</a></li>
                    <li class="<?php if($uri1=="pricing"): ?>active<?php endif; ?>"><a href="<?= base_url('pricing') ?>">Pricing</a></li>
                    <li class="<?php if($uri1=="contact"): ?>active<?php endif; ?>"><a href="<?= base_url('contact') ?>">Contact</a></li>
                    <!-- <li><a href="#">Register</a></li>
                    <li><a href="#">Login</a></li> -->
                </ul>
            </nav><!-- .nav-menu -->

            <a href="javascript:void(0);" class="get-started-btn-dan btn-danger scrollto" data-toggle="modal" data-target="#myModaldemo">Request Demo</a>
            <a href="<?= base_url('register-firm') ?>" target="_blank" class="get-started-btn scrollto">Register</a>
            <a href="<?= base_url('login') ?>" target="_blank" class="get-started-btn scrollto">Login</a>
        </div>
    </header><!-- End Header -->
  
  
    <div class="modal fade" id="myModaldemo" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header text-center d-block" style="background-color: #024888; color: #fff;">
                    <h4 class="modal-title">Demo Request</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body lg_blue">
                    <form method="POST" action="<?= base_url('add_request'); ?>" id="demoReqForm" novalidate="novalidate">
                        <div class="form-group">
                            <label for="username" class="control-label">Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="demoReqName" name="demoReqName" value="" required="" title="Please enter you username" placeholder="Enter Name" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">E-mail</label>
                            <input type="email" class="form-control" id="demoReqEmail" name="demoReqEmail" value="" required="" title="Please enter you email id" placeholder="example@gmail.com" >
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="control-label">Mobile Number <span style="color:red;">*</span></label>
                            <input type="mobile" class="form-control" id="demoReqMobile" name="demoReqMobile" value="" required="" title="Please enter your Mobile Number" placeholder="Please enter your Mobile Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>OTP:<span class="req" style="color:red;">*</span></label><br>
                            <div class="form-group row">
                                <div class="col-md-5 col-lg-5">
                                    <input type="text" class="form-control" id="demoMobileOTP" name="demoMobileOTP" value="" required="" title="Enter OTP" placeholder="Enter OTP" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" required>
                                    <input type="hidden" id="sendOtpUrl" value="<?= base_url('send_otp'); ?>" />
                                </div>
                                <div class="col-md-6 col-lg-6 mt-2">
                                    <span id="countdownSpan"></span>
                                    <a href="javascript:void(0);" class="text-primary sendOtpBtn" id="sendOtpBtnID">
                                        <i class='bx bx-refresh'></i>&nbsp;Send OTP
                                    </a>
                                    <a href="javascript:void(0);" class="text-primary sendOtpBtn" id="reSendOtpBtnID">
                                        <i class='bx bx-refresh'></i>&nbsp;Re-send OTP
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Captcha:<span class="req" style="color:red;">*</span></label><br>
                            <div class="form-group row">
                                <div class="col-md-5 col-lg-5">
                                    <div id="drCaptchaDiv">
                                        <canvas id="drCanvas" width="200"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <a href="javascript:void(0);" class="text-primary" onClick="drRefreshCaptcha();">
                                        <i class='bx bx-refresh'></i>&nbsp;Refresh
                                    </a>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="drCaptchaCode" id="drCaptchaCode" placeholder="Captcha" required>
                            <span class="req text-danger" id="drCaptchaCodeErr"></span>
                        </div>
                        <button type="button" class="btn btn-info btn-block sendReqBtn">Send Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>