<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h3 class="box-title">Customer Registration Form</h3>
                    <div class="text-right flex-grow">
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="" method="post" >
                        <section>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmNameErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmName">Firm Name: <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="caFirmName" id="caFirmName" placeholder="Enter Firm Name" value="<?php echo set_value('caFirmName'); ?>" onkeypress='validateChar(event)'> 
                                        <span class="help-block"><?php echo $caFirmNameErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmProfessionErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmProfession">Type of Profession: <small class="text-danger">*</small></label>
                                        <select class="custom-select form-control select2" name="caFirmProfession" id="caFirmProfession" style="100%">
                                            <option value="">Select</option>
                                            <?php if(!empty($profTypes)): ?>
                                                <?php foreach($profTypes AS $e_prof): ?>
                                                    <option value="<?php echo $e_prof['profession_type_id']; ?>" <?= set_select('caFirmProfession', $e_prof['profession_type_id']) ?>><?php echo $e_prof['profession_type_name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="help-block"><?php echo $caFirmProfessionErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmTypeErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmType">Firm Type: <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="caFirmType" id="caFirmType" placeholder="Enter Firm Type" value="<?php echo set_value('caFirmType'); ?>" onkeypress='validateChar(event)'> 
                                        <span class="help-block"><?php echo $caFirmTypeErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmPanErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmPan">PAN Number: <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="caFirmPan" id="caFirmPan" placeholder="Enter Pan Number" value="<?php echo set_value('caFirmPan'); ?>"> 
                                        <span class="help-block"><?php echo $caFirmPanErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmContactPersonErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmContactPerson">Name of Contact Person: <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="caFirmContactPerson" id="caFirmContactPerson" placeholder="Enter Name of Contact Person" value="<?php echo set_value('caFirmContactPerson'); ?>" onkeypress='validateChar(event)'> 
                                        <span class="help-block"><?php echo $caFirmContactPersonErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmEmailErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmEmail">Email: <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="caFirmEmail" id="caFirmEmail" placeholder="Enter Email" value="<?php echo set_value('caFirmEmail'); ?>"> 
                                        <span class="help-block"><?php echo $caFirmEmailErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmMobileErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmMobile">Mobile No: <small class="text-danger">*</small></label>
                                        <input type="tel" class="form-control" name="caFirmMobile" id="caFirmMobile" placeholder="Enter Mobile Number" maxlength="10" value="<?php echo set_value('caFirmMobile'); ?>" onkeypress='validateNum(event)'>
                                        <span class="help-block"><?php echo $caFirmMobileErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group <?php if(!empty($caFirmAddressErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmAddress">Address: <small class="text-danger">*</small></label>
                                        <input type="tel" class="form-control" name="caFirmAddress" id="caFirmAddress" placeholder="Enter Address" value="<?php echo set_value('caFirmAddress'); ?>"> 
                                        <span class="help-block"><?php echo $caFirmAddressErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmStateIdErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmStateId">State: <small class="text-danger">*</small></label>
                                        <select class="custom-select form-control" id="caFirmStateId" name="caFirmStateId">
                                            <option value="">Select</option>
                                            <?php if(!empty($stateList)): ?>
                                                <?php foreach($stateList AS $e_state): ?>
                                                    <option value="<?php echo $e_state['stateId']; ?>" <?= set_select('caFirmStateId', $e_state['stateId']) ?>><?php echo $e_state['stateName']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="help-block"><?php echo $caFirmStateIdErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmCityIdErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmCityId">City: <small class="text-danger">*</small></label>
                                        <select class="custom-select form-control" id="caFirmCityId" name="caFirmCityId">
                                            <option value="">Select</option>
                                        </select>
                                        <span class="help-block"><?php echo $caFirmCityIdErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmLandlineErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmLandline">Landline No: <small class="text-danger">*</small></label>
                                        <input type="tel" class="form-control" name="caFirmLandline" id="caFirmLandline" placeholder="Enter Landline Number" maxlength="10" value="<?php echo set_value('caFirmLandline'); ?>" onkeypress='validateNum(event)'> 
                                        <span class="help-block"><?php echo $caFirmLandlineErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmUsersErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmUsers">Number of Users: <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" name="caFirmUsers" id="caFirmUsers" placeholder="Enter Number of Users" value="<?php echo set_value('caFirmUsers'); ?>" onkeypress='validateNum(event)'> 
                                        <span class="help-block"><?php echo $caFirmUsersErr; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?php if(!empty($caFirmPaymentErr)): ?>has-error<?php endif; ?>">
                                        <label for="caFirmPayment">Payment Option: <small class="text-danger">*</small></label>
                                        <select class="custom-select form-control" id="caFirmPayment" name="caFirmPayment">
                                            <option value="">Select</option>
                                            <?php if(!empty($pmtOptions)): ?>
                                                <?php foreach($pmtOptions AS $e_pmt_opt): ?>
                                                    <option value="<?php echo $e_pmt_opt['payment_option_id']; ?>" <?= set_select('caFirmPayment', $e_pmt_opt['payment_option_id']) ?>><?php echo $e_pmt_opt['payment_option_name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="help-block"><?php echo $caFirmPaymentErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h4 class="box-title mb-0 mt-10">Create Owner Login</h4>
                                    <hr>
                                    <div class="form-group row <?php if(!empty($customerUserNameErr)): ?>has-error<?php endif; ?>">
                                        <label class="col-md-2">User Name: <small class="text-danger">*</small></label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="customerUserName" id="customerUserName" placeholder="Enter User Name" value="<?php echo set_value('customerUserName'); ?>"> 
                                            <span class="help-block"><?php echo $customerUserNameErr; ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row <?php if(!empty($customerPasswordErr)): ?>has-error<?php endif; ?>">
                                        <label class="col-md-2">Password: <small class="text-danger">*</small></label>
                                        <div class="col-md-4">
                                            <input type="password" class="form-control" name="customerPassword" id="customerPassword" placeholder="Enter Password" value="<?php echo set_value('customerPassword'); ?>"> 
                                            <span class="help-block"><?php echo $customerPasswordErr; ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row <?php if(!empty($customerConfPasswordErr)): ?>has-error<?php endif; ?>">
                                        <label class="col-md-2">Re-type Password: <small class="text-danger">*</small></label>
                                        <div class="col-md-4">
                                            <input type="password" class="form-control" name="customerConfPassword" id="customerConfPassword" placeholder="Enter Password Again" value="<?php echo set_value('customerConfPassword'); ?>"> 
                                            <span class="help-block"><?php echo $customerConfPasswordErr; ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row <?php if(!empty($customerVerifyErr)): ?>has-error<?php endif; ?>">
                                        <label class="col-md-2">Verification: <small class="text-danger">*</small></label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="customerVerify" id="customerVerify" placeholder="Enter Verification Code" value="<?php echo set_value('customerVerify'); ?>"> 
                                            <span class="help-block"><?php echo $customerVerifyErr; ?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="waves-effect waves-light btn btn-warning btn-sm mt-5">Get OTP</button>
                                        </div>
                                    </div>
                                    <div class="form-group row <?php if(!empty($captchaCodeErr)): ?>has-error<?php endif; ?>">
                                        <label class="col-md-2">Captcha: <small class="text-danger">*</small></label>
                                        <div class="col-md-4">
                                            <img src="<?=esc(base_url('assets/images/CAPTCHA.png'))?>" >
                                        </div>
                                    </div>
                                    <div class="form-group row <?php if(!empty($captchaCodeErr)): ?>has-error<?php endif; ?>">
                                        <label class="col-md-2"></label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="captchaCode" id="captchaCode" placeholder="Enter Captcha" value="<?php echo set_value('captchaCode'); ?>"> 
                                            <span class="help-block"><?php echo $captchaCodeErr; ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row <?php if(!empty($isTermsAgreeErr)): ?>has-error<?php endif; ?>">
                                        <div class="checkbox checkbox-success">
                                            <input id="isTermsAgree" name="isTermsAgree" type="checkbox">
                                            <label for="isTermsAgree"> I agree to the terms of service & company policy </label>
                                        </div>
                                    </div>
                                    <span class="help-block mt-0"><?php echo $isTermsAgreeErr; ?></span>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-right">
                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                    </div>
                                </div>
                            </div>  
                        </section>
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

<script>
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";

        $('#caFirmStateId').on('change', function(){

            var stateId = $('#caFirmStateId option:selected').val();

            var set_val_city="<?php echo set_value('caFirmCityId'); ?>";

            if(stateId=="")
                return false;

            $('#caFirmCityId').html("");
            $('#caFirmCityId').html("<option value=''>Select</option>");

            $.ajax({
                url : base_url+'/remote/getCities',
                type : 'POST',
                data : { 
                    'stateId' : stateId,
                    'set_val_city' : set_val_city
                },
                dataType: 'html',
                success : function(data) {
                    $('#caFirmCityId').html(data);
                },
                error : function(request, error)
                {
                    // alert("Request: "+JSON.stringify(request));
                }
            });
        });

        $('#caFirmStateId').trigger('change');
    });
</script>

<?= $this->endSection(); ?>