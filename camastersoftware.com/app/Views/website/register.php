<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<?php $registerLink=base_url('register_firm'); ?>
        
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
                padding: 15px 20px !important;
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
        
        </style>    
        <div>
            <main id="main">
                <!-- ======= Contact Section ======= -->
                <section id="contact" class="contact">
                    <div class="container">
                        <div class="section-title" data-aos="fade-up">
                            <div class="row">
                                <div class="col-xs-6 offset-xs-3 col-sm-6 offset-sm-3 col-md-6 offset-md-3 col-lg-6 offset-lg-3 text-center regHeader">
                                    <h2>Register Now</h2>
                                </div>
                            </div>
                        </div>
                        <form action="<?php echo $registerLink; ?>" method="POST" id="register_form">
                            <div class="row">
                                <div class="col-md-6 offset-md-3 regi-form reg_form">
                                    <div class="form-group">
                                        <label>Firm Name:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="caFirmName" id="caFirmName" placeholder="Enter Firm Name" >
                                        <span class="req" id="caFirmNameErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Type of Profession:<span class="req">*</span></label><br>
                                        <select class="w-100 py-2" name="caFirmProfession" id="caFirmProfession" required>
                                            <option value="">Choose Type of Profession</option>
                                            <?php if(!empty($professionsArr)): ?>
                                                <?php foreach($professionsArr AS $e_prof): ?>
                                                    <option value="<?php echo $e_prof['profession_type_id']; ?>"><?php echo $e_prof['profession_type_name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="req" id="caFirmProfessionErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Firm Type:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="caFirmType" id="caFirmType" placeholder="Proprietor, Partnership, LLP etc." required>
                                        <span class="req" id="caFirmTypeErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>PAN No:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="caFirmPan" id="caFirmPan" placeholder="Enter PAN No" required>
                                        <span class="req" id="caFirmPanErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>GSTIN:</label>
                                        <input type="text" class="form-control" name="caFirmGSTIN" id="caFirmGSTIN" placeholder="Enter GSTIN (Optional)">
                                        <span class="req" id="caFirmGSTINErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Firm Registration Number:</label>
                                        <input type="text" class="form-control" name="caFirmRegNo" id="caFirmRegNo" placeholder="Enter ICAI, ICSI, ICMAI etc. (Registration Number) (Optional)">
                                        <span class="req" id="caFirmRegNoErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Registration:</label>
                                        <input type="date" class="form-control" name="caFirmRegDate" id="caFirmRegDate" placeholder="Enter Date of Registration (Optional)">
                                        <span class="req" id="caFirmRegDateErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail Address:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="caFirmEmail" id="caFirmEmail" placeholder="Enter E-mail Address" required>
                                        <span class="req" id="caFirmEmailErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile No:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="caFirmMobile" id="caFirmMobile" placeholder="Enter Mobile No" required>
                                        <span class="req" id="caFirmMobileErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Landline No:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="caFirmLandline" id="caFirmLandline" placeholder="Enter Landline No" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Address:<span class="req">*</span></label>
                                        <textarea class="form-control" name="caFirmAddress" id="caFirmAddress" placeholder="Enter Address" required></textarea>
                                        <span class="req" id="caFirmAddressErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>State:<span class="req">*</span></label>
                                        <select class="w-100 py-2" name="caFirmStateId" id="caFirmStateId" onchange="get_cities(this);" required>
                                            <option value="">Choose State</option>
                                            <?php if(!empty($statesArr)): ?>
                                                <?php foreach($statesArr AS $e_st): ?>
                                                    <option value="<?php echo $e_st['stateId']; ?>"><?php echo $e_st['stateName']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="req" id="caFirmStateIdErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>City:<span class="req">*</span></label>
                                        <select class="w-100 py-2" name="caFirmCityId" id="caFirmCityId" required>
                                            <option value="">Choose City</option>
                                        </select>
                                        <span class="req" id="caFirmCityIdErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Name of Contact Person:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="caFirmContactPerson" id="caFirmContactPerson" placeholder="Enter Name of Contact Person" required>
                                        <span class="req" id="caFirmContactPersonErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Number of Users:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="caFirmUsers" id="caFirmUsers" placeholder="Enter Number of Users" required>
                                        <span class="req" id="caFirmUsersErr"></span>
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <label>Payment Option:<span class="req">*</span></label>
                                        <select class="w-100 py-2" name="caFirmPayment" id="caFirmPayment" required>
                                            <option value="">Choose Payment Option</option>
                                            <?php //if(!empty($paymentOptionsArr)): ?>
                                                <?php //foreach($paymentOptionsArr AS $e_pmt): ?>
                                                    <option value="<?php //echo $e_pmt['payment_option_id']; ?>"><?php //echo $e_pmt['payment_option_name']; ?></option>
                                                <?php //endforeach; ?>
                                            <?php //endif; ?>
                                        </select>
                                        <span class="req" id="caFirmPaymentErr"></span>
                                    </div>
                                    -->
                                </div>
                                <div class="col-md-6 offset-md-3 regi-form">
                                    <div class="section-title" data-aos="fade-up">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center regHeader">
                                                <h2>Create Owner Login</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-3 regi-form reg_form">
                                    <div class="form-group">
                                        <label>User Name:<span class="req">*</span></label>
                                        <input type="text" class="form-control" name="customerUserName" id="customerUserName" placeholder="Enter User Name" required>
                                        <span class="req" id="customerUserNameErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Password:<span class="req">*</span></label>
                                        <input type="password" class="form-control" name="customerPassword" id="customerPassword" placeholder="Enter Password" required>
                                        <span class="req" id="customerPasswordErr"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Retype-Password:<span class="req">*</span></label>
                                        <input type="password" class="form-control" name="customerConfPassword" id="customerConfPassword" placeholder="Retype-Password" onkeyup="checkCustomerConfPassword(this);" onkeypress="checkCustomerConfPassword(this);" oninput="checkCustomerConfPassword(this);" required>
                                        <span class="req" id="passErr"></span>
                                        <span class="req" id="customerConfPasswordErr"></span>
                                    </div>
                                    <!--<div class="form-group">-->
                                    <!--    <label>Verification Code:<span class="req">*</span></label>-->
                                    <!--    <input type="text" class="form-control" name="customerVerify" id="customerVerify" placeholder="Verification Code" required>-->
                                    <!--    <span class="req" id="customerVerifyErr"></span>-->
                                    <!--</div>-->
                                    <div class="form-group">
                                        <label>Captcha:<span class="req">*</span></label><br>
                                        <!--<img src="assets/img/captcha.png" class="mb-2"><br>-->
                                        <div class="form-group row">
                                            <div class="col-md-5 col-lg-5">
                                                <div id="captchaDiv">
                                                    <canvas id="canvas" width="200"></canvas>
                                                    <!--<img src="captachaCode/captacha.php" class="mb-2" id="captchaImg">-->
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <a href="javascript:void(0);" class="text-primary" onClick="refreshCaptcha();">
                                                    <i class='bx bx-refresh'></i>&nbsp;Refresh
                                                </a>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="captchaCode" id="captchaCode" placeholder="Captcha" required>
                                        <span class="req" id="captchaCodeErr"></span>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="isTermsAgree" id="isTermsAgree" required>
                                        <label class="form-check-label" for="isTermsAgree">
                                            I agree to the terms of service & company policy.
                                        </label>
                                        <span class="req" id="isTermsAgreeErr"></span>
                                    </div>
                                    <!--<button type="submit" class="btn btn-info btn-block mt-3 registerBtn" onClick="registerBtn(event);">Register</button>-->
                                    <button type="submit" class="btn btn-info btn-block mt-3 registerBtn" >Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section><!-- End Contact Section -->
            </main><!-- End #main -->
        </div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

    <!--<script src="<?php //echo base_url('assets/site/js/jquery-captcha.js'); ?>"></script>-->
    <script>
    
        function refreshCaptcha()
        {
            const captcha=captachFunc();
            
            captcha.refresh();
            $('#captchaCodeErr').text('');
            $('#captchaCode').val('');
        }
        
        function refreshCaptchaObj(captcha)
        {
            captcha.refresh();
            $('#captchaCodeErr').text('');
            $('#captchaCode').val('');
        }
        
        function captachFunc()
        {
            const captcha = new Captcha($('#canvas'),{
                length: 6,
                width: 200
            });
            
            return captcha;
        }
        
        function registerUser(captcha)
        {
            var registerLink = "<?php echo $registerLink; ?>";
                
            var regFormData = $('#register_form').serialize();
            var regFormDataArr = $('#register_form').serializeArray();
            
            $.ajax({
                url : registerLink,
                type : 'POST',
                data : regFormData,
                dataType: 'json',
                success : function(data) {

                    var resStatus = data.status;
                    var resUserData = data.userdata;
                    var resMsg = data.message;
                    
                    if(resStatus==true)
                    {      
                        $('#register_form')[0].reset();
                        // Swal.fire('Success', resMsg, 'success');
                        
                        Swal.fire('Success', resMsg, 'success').then((result) => {
                            // Reload the Page
                            location.reload();
                        });
                    }
                    else
                    {
                        refreshCaptchaObj(captcha);
                        Swal.fire('Error', resMsg, 'error');
                    }
                
                },
                error : function(request, error)
                {
                    refreshCaptchaObj(captcha);
                // alert("Request: "+JSON.stringify(request));
                }
            });
        }
        
    </script>
    
    <?php
        $city_arr=array();
        if(!empty($citiesArr))
        {
            foreach($citiesArr AS $k_ct=>$e_ct)
            {
                $cityName = str_replace("'", "", $e_ct['cityName']);
                $city_arr[$k_ct]['cityId']=$e_ct['cityId'];
                $city_arr[$k_ct]['cityName']=$cityName;
                $city_arr[$k_ct]['fk_state_id']=$e_ct['fk_state_id'];
            }
        }
    ?>

    <script type="text/javascript">
    
        $(document).ready(function(){
            
            const captcha=captachFunc();
            
            $('.registerBtn').on('click', function(e){
                
                e.preventDefault();
                
                const captchaCode = $('#captchaCode').val();
                
                console.log(captchaCode);
                const captchaCodeVal = captcha.valid(captchaCode);
                
                console.log(captchaCodeVal);
                
                if(captchaCode!="") {
                    if(captchaCodeVal==true){
                        registerUser(captcha);
                    }else{
                        
                        $('#captchaCodeErr').text('Captcha does not match');
                        captcha.refresh();
                        return false;
                    }
                }else{
                    $('#captchaCodeErr').text('Please enter captcha code');
                    captcha.refresh();
                    return false;
                }
                
            })
            
        });
    
    </script>
    
    <script type="text/javascript">
    
        function get_cities($this)
        {
            var stateId=$this.value;
            var city_arr = '<?php echo json_encode($city_arr); ?>';
            
            $('#caFirmCityId').html("");
            $('#caFirmCityId').html("<option value=''>Choose City</option>");
            
            var citiesArr=jQuery.parseJSON(city_arr);
            
            $.each(citiesArr, function(index, value){
            
                var cityId=value['cityId'];
                var cityName=value['cityName'];
                var state_id=value['fk_state_id'];
                
                if(state_id==stateId)
                {
                    $('#caFirmCityId').append("<option value='"+cityId+"' >"+cityName+"</option>");
                }
            
            });   
        }
        
        function checkCustomerConfPassword($this)
        {
            var customerConfPassword = $this.value;
            var customerPassword = $('#customerPassword').val();
                
            if(customerPassword!=customerConfPassword)
                $('#passErr').text('Password does not match!');
            else
                $('#passErr').text('');
        }
    
    </script>

<?= $this->endSection(); ?>