<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    /*.box-body {*/
    /*    padding: 1.1rem 1.1rem;*/
    /*    flex: 1 1 auto;*/
    /*    border-radius: 10px;*/
    /*    border: 1px solid #015aacab !important;*/
    /*    background: #96c7f242 !important;*/
    /*    margin-top: 20px !important;*/
    /*}*/
    
    .sec_heading{
        background:#F99D27;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
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
</style>

<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default mt-40">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('superadmin/firmList'); ?>" >
                            <button type="button" class="btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body card_bg_format">
                    <form action="" method="post" >
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 mt-3">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="sec_heading">
                                                            <h4 class="text-white font-weight-bold m-0">Registration Details</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmNameErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmName">Firm Name: <small class="text-danger">*</small></label>
                                                                    <input type="text" class="form-control" name="caFirmName" id="caFirmName" placeholder="Enter Firm Name" value="<?php echo set_value('caFirmName', $firmData['caFirmName']); ?>" onkeypress='validateChar(event)' value="<?php echo $firmData['caFirmName']; ?>"> 
                                                                    <span class="help-block"><?php echo $caFirmNameErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmProfessionErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmProfession">Type of Profession: <small class="text-danger">*</small></label>
                                                                    <select class="custom-select form-control" name="caFirmProfession" id="caFirmProfession" style="100%">
                                                                        <option value="">Choose Type of Profession</option>
                                                                        <?php if(!empty($profTypes)): ?>
                                                                            <?php foreach($profTypes AS $e_prof): ?>
                                                                                <option value="<?php echo $e_prof['profession_type_id']; ?>" <?= set_select('caFirmProfession', $e_prof['profession_type_id'], $e_prof['profession_type_id']==$firmData['caFirmProfession'] ? TRUE:FALSE) ?>><?php echo $e_prof['profession_type_name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                    <span class="help-block"><?php echo $caFirmProfessionErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmTypeErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmType">Firm Type: <small class="text-danger">*</small></label>
                                                                    <input type="text" class="form-control" name="caFirmType" id="caFirmType" placeholder="Proprietor, Partnership, LLP etc." value="<?php echo set_value('caFirmType', $firmData['caFirmType']); ?>" onkeypress='validateChar(event)' > 
                                                                    <span class="help-block"><?php echo $caFirmTypeErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmPanErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmPan">PAN No: <small class="text-danger">*</small></label>
                                                                    <input type="text" class="form-control" name="caFirmPan" id="caFirmPan" placeholder="Enter PAN No" value="<?php echo set_value('caFirmPan', $firmData['caFirmPan']); ?>" > 
                                                                    <span class="help-block"><?php echo $caFirmPanErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmGSTINErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmPan">GSTIN: </label>
                                                                    <input type="text" class="form-control" name="caFirmGSTIN" id="caFirmGSTIN" placeholder="Enter GSTIN (Optional)" value="<?php echo set_value('caFirmGSTIN', $firmData['caFirmGSTIN']); ?>" > 
                                                                    <span class="help-block"><?php echo $caFirmGSTINErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmRegNoErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmPan">Firm Registration Number: </label>
                                                                    <input type="text" class="form-control" name="caFirmRegNo" id="caFirmRegNo" placeholder="Enter ICAI, ICSI, ICMAI etc. (Registration Number) (Optional)" value="<?php echo set_value('caFirmRegNo', $firmData['caFirmRegNo']); ?>" > 
                                                                    <span class="help-block"><?php echo $caFirmRegNoErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmRegDateErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmPan">Date of Registration: </label>
                                                                    <?php
                                                                        if($firmData['caFirmRegDate']!="" && $firmData['caFirmRegDate']!="1970-01-01"  && $firmData['caFirmRegDate']!="0000-00-00")
                                                    			            $caFirmRegDate=date('Y-m-d', strtotime($firmData['caFirmRegDate']));
                                                    			        else
                                                    			            $caFirmRegDate="";
                                                                    ?>
                                                                    <input type="date" class="form-control" name="caFirmRegDate" id="caFirmRegDate" value="<?php echo set_value('caFirmRegDate', $caFirmRegDate); ?>" > 
                                                                    <span class="help-block"><?php echo $caFirmRegDateErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmEmailErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmEmail">Email Address: <small class="text-danger">*</small></label>
                                                                    <input type="text" class="form-control" name="caFirmEmail" id="caFirmEmail" placeholder="Enter Email Address" value="<?php echo set_value('caFirmEmail', $firmData['caFirmEmail']); ?>"> 
                                                                    <span class="help-block"><?php echo $caFirmEmailErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmMobileErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmMobile">Mobile No: <small class="text-danger">*</small></label>
                                                                    <input type="tel" class="form-control" name="caFirmMobile" id="caFirmMobile" placeholder="Enter Mobile No" maxlength="10" value="<?php echo set_value('caFirmMobile', $firmData['caFirmMobile']); ?>" onkeypress='validateNum(event)' >
                                                                    <span class="help-block"><?php echo $caFirmMobileErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmLandlineErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmLandline">Landline No: <small class="text-danger">*</small></label>
                                                                    <input type="tel" class="form-control" name="caFirmLandline" id="caFirmLandline" placeholder="Enter Landline No" maxlength="10" value="<?php echo set_value('caFirmLandline', $firmData['caFirmLandline']); ?>" onkeypress='validateNum(event)' > 
                                                                    <span class="help-block"><?php echo $caFirmLandlineErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group <?php if(!empty($caFirmAddressErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmAddress">Address: <small class="text-danger">*</small></label>
                                                                    <input type="tel" class="form-control" name="caFirmAddress" id="caFirmAddress" placeholder="Enter Address" value="<?php echo set_value('caFirmAddress', $firmData['caFirmAddress']); ?>" > 
                                                                    <span class="help-block"><?php echo $caFirmAddressErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmStateIdErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmStateId">State: <small class="text-danger">*</small></label>
                                                                    <select class="custom-select form-control" id="caFirmStateId" name="caFirmStateId">
                                                                        <option value="">Choose State</option>
                                                                        <?php if(!empty($stateList)): ?>
                                                                            <?php foreach($stateList AS $e_state): ?>
                                                                                <option value="<?php echo $e_state['stateId']; ?>" <?= set_select('caFirmStateId', $e_state['stateId'], $e_state['stateId']==$firmData['caFirmStateId'] ? TRUE:FALSE) ?>><?php echo $e_state['stateName']; ?></option>
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
                                                                        <option value="">Choose City</option>
                                                                    </select>
                                                                    <span class="help-block"><?php echo $caFirmCityIdErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmContactPersonErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmContactPerson">Name of Contact Person: <small class="text-danger">*</small></label>
                                                                    <input type="text" class="form-control" name="caFirmContactPerson" id="caFirmContactPerson" placeholder="Enter Name of Contact Person" value="<?php echo set_value('caFirmContactPerson', $firmData['caFirmContactPerson']); ?>" onkeypress='validateChar(event)'> 
                                                                    <span class="help-block"><?php echo $caFirmContactPersonErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmUsersErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmUsers">Number of Users: <small class="text-danger">*</small></label>
                                                                    <input type="number" class="form-control" name="caFirmUsers" id="caFirmUsers" placeholder="Enter Number of Users" value="<?php echo set_value('caFirmUsers', $firmData['caFirmUsers']); ?>" onkeypress='validateNum(event)' > 
                                                                    <span class="help-block"><?php echo $caFirmUsersErr; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group <?php if(!empty($caFirmPaymentErr)): ?>has-error<?php endif; ?>">
                                                                    <label for="caFirmPayment">Payment Option: <small class="text-danger">*</small></label>
                                                                    <select class="custom-select form-control" id="caFirmPayment" name="caFirmPayment">
                                                                        <option value="">Choose Payment Option</option>
                                                                        <?php if(!empty($pmtOptions)): ?>
                                                                            <?php foreach($pmtOptions AS $e_pmt_opt): ?>
                                                                                <option value="<?php echo $e_pmt_opt['payment_option_id']; ?>" <?= set_select('caFirmPayment', $e_pmt_opt['payment_option_id'], $e_pmt_opt['payment_option_id']==$firmData['caFirmPayment'] ? TRUE:FALSE) ?>><?php echo $e_pmt_opt['payment_option_name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                    <span class="help-block"><?php echo $caFirmPaymentErr; ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mt-0">
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <div class="form-group">
                                                            <input type="hidden" name="caFirmId" value="<?php echo $firmData['caFirmId']; ?>">
                                                            <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                                            <a href="<?php echo base_url('superadmin/firmList'); ?>" >
                                                                <button type="button" class="btn btn-dark">Back</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
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

<script>
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";

        $('#caFirmStateId').on('change', function(){

            var stateId = $('#caFirmStateId option:selected').val();

            var set_val_city="<?php echo set_value('caFirmCityId', $firmData['caFirmCityId']); ?>";

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