<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .box-body.bg_pr {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        margin-top: 20px !important;
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
        
    .theme-primary .nav-tabs .nav-link.active {
        border-bottom-color: #E79F34 !important;
        background-color: transparent !important;
        color: #fff !important;
    }
    
    .nav-tabs .nav-link {
        color: #fff !important;
        background-color: transparent !important;
        padding: 0px !important;
        border: none !important;
    }
    
    .tabs_title{
        font-size: 14px !important;
        font-weight: 800 !important;
    }
    
    .nav-tabs{
        border-bottom: none !important;
    }
    
    .nav_tab_1{
        padding-right: 20px !important;
    }
    
    .nav_tab_2{
        border-left: 3px solid #fff !important;
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default mt-40">
                <div class="box-header with-border flexbox">
                    <!--<h4 class="box-title font-weight-bold">Registration Details</h4>-->
                    <ul class="nav nav-tabs nav-fill" role="tablist">
						<li class="nav-item nav_tab_1"> 
						    <a class="nav-link active" data-toggle="tab" href="#reg_details_tab" role="tab">
						        <span class="hidden-xs-down ml-15">
						            <span class="tabs_title font-weight-bold">
						                Registration Details
						            </span>
						        </span>
						    </a> 
						</li>
						<li class="nav-item nav_tab_2"> 
						    <a class="nav-link" data-toggle="tab" href="#user_details_tab" role="tab">
						        <span class="hidden-xs-down ml-15">
						            <span class="tabs_title font-weight-bold">
						                User List
						            </span>
						        </span>
						    </a> 
					    </li>
					</ul>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url($backUrl); ?>" >
                            <button type="button" class="btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                
                <div class="tab-content tabcontent-border">
					<div class="tab-pane active" id="reg_details_tab" role="tabpanel">
					    <div class="box-body bg_pr">
							<div class="p-15">
                                <form action="" method="post" >
                                    <section>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmName">Firm Name: </label>
                                                    <input type="text" class="form-control" name="caFirmName" id="caFirmName" placeholder="Enter Firm Name" value="<?php echo set_value('caFirmName', $firmData['caFirmName']); ?>" onkeypress='validateChar(event)' value="<?php echo $firmData['caFirmName']; ?>" disabled > 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmProfession">Type of Profession: </label>
                                                    <select class="custom-select form-control select2" name="caFirmProfession" id="caFirmProfession" style="100%" disabled>
                                                        <option value="">Choose Type of Profession</option>
                                                        <?php if(!empty($profTypes)): ?>
                                                            <?php foreach($profTypes AS $e_prof): ?>
                                                                <option value="<?php echo $e_prof['profession_type_id']; ?>" <?= set_select('caFirmProfession', $e_prof['profession_type_id'], $e_prof['profession_type_id']==$firmData['caFirmProfession'] ? TRUE:FALSE) ?>><?php echo $e_prof['profession_type_name']; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmType">Firm Type: </label>
                                                    <input type="text" class="form-control" name="caFirmType" id="caFirmType" placeholder="Proprietor, Partnership, LLP etc." value="<?php echo set_value('caFirmType', $firmData['caFirmType']); ?>" onkeypress='validateChar(event)'  disabled> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmPan">PAN No: </label>
                                                    <input type="text" class="form-control" name="caFirmPan" id="caFirmPan" placeholder="Enter PAN No" value="<?php echo set_value('caFirmPan', $firmData['caFirmPan']); ?>"  disabled> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmPan">GSTIN: </label>
                                                    <input type="text" class="form-control" name="caFirmGSTIN" id="caFirmGSTIN" placeholder="Enter GSTIN (Optional)" value="<?php echo set_value('caFirmGSTIN', $firmData['caFirmGSTIN']); ?>"  disabled> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmPan">Firm Registration Number: </label>
                                                    <input type="text" class="form-control" name="caFirmRegNo" id="caFirmRegNo" placeholder="Enter ICAI, ICSI, ICMAI etc. (Registration Number) (Optional)" value="<?php echo set_value('caFirmRegNo', $firmData['caFirmRegNo']); ?>"  disabled> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmPan">Date of Registration: </label>
                                                    <?php
                                                        if($firmData['caFirmRegDate']!="" && $firmData['caFirmRegDate']!="1970-01-01"  && $firmData['caFirmRegDate']!="0000-00-00")
                                    			            $caFirmRegDate=date('Y-m-d', strtotime($firmData['caFirmRegDate']));
                                    			        else
                                    			            $caFirmRegDate="";
                                                    ?>
                                                    <input type="date" class="form-control" name="caFirmRegDate" id="caFirmRegDate" value="<?php echo set_value('caFirmRegDate', $caFirmRegDate); ?>"  disabled> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmEmail">Email Address: </label>
                                                    <input type="text" class="form-control" name="caFirmEmail" id="caFirmEmail" placeholder="Enter Email Address" value="<?php echo set_value('caFirmEmail', $firmData['caFirmEmail']); ?>" disabled> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmMobile">Mobile No: </label>
                                                    <input type="tel" class="form-control" name="caFirmMobile" id="caFirmMobile" placeholder="Enter Mobile No" maxlength="10" value="<?php echo set_value('caFirmMobile', $firmData['caFirmMobile']); ?>" onkeypress='validateNum(event)'  disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmLandline">Landline No: </label>
                                                    <input type="tel" class="form-control" name="caFirmLandline" id="caFirmLandline" placeholder="Enter Landline No" maxlength="10" value="<?php echo set_value('caFirmLandline', $firmData['caFirmLandline']); ?>" onkeypress='validateNum(event)'  disabled> 
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="caFirmAddress">Address: </label>
                                                    <input type="tel" class="form-control" name="caFirmAddress" id="caFirmAddress" placeholder="Enter Address" value="<?php echo set_value('caFirmAddress', $firmData['caFirmAddress']); ?>"  disabled> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmStateId">State: </label>
                                                    <select class="custom-select form-control" id="caFirmStateId" name="caFirmStateId" disabled>
                                                        <option value="">Choose State</option>
                                                        <?php if(!empty($stateList)): ?>
                                                            <?php foreach($stateList AS $e_state): ?>
                                                                <option value="<?php echo $e_state['stateId']; ?>" <?= set_select('caFirmStateId', $e_state['stateId'], $e_state['stateId']==$firmData['caFirmStateId'] ? TRUE:FALSE) ?>><?php echo $e_state['stateName']; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmCityId">City: </label>
                                                    <select class="custom-select form-control" id="caFirmCityId" name="caFirmCityId" disabled>
                                                        <option value="">Choose City</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmContactPerson">Name of Contact Person: </label>
                                                    <input type="text" class="form-control" name="caFirmContactPerson" id="caFirmContactPerson" placeholder="Enter Name of Contact Person" value="<?php echo set_value('caFirmContactPerson', $firmData['caFirmContactPerson']); ?>" onkeypress='validateChar(event)' disabled> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmUsers">Number of Users: </label>
                                                    <input type="number" class="form-control" name="caFirmUsers" id="caFirmUsers" placeholder="Enter Number of Users" value="<?php echo set_value('caFirmUsers', $firmData['caFirmUsers']); ?>" onkeypress='validateNum(event)' disabled > 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="caFirmPayment">Payment Option: </label>
                                                    <select class="custom-select form-control" id="caFirmPayment" name="caFirmPayment" disabled>
                                                        <option value="">Choose Payment Option</option>
                                                        <?php if(!empty($pmtOptions)): ?>
                                                            <?php foreach($pmtOptions AS $e_pmt_opt): ?>
                                                                <option value="<?php echo $e_pmt_opt['payment_option_id']; ?>" <?= set_select('caFirmPayment', $e_pmt_opt['payment_option_id'], $e_pmt_opt['payment_option_id']==$firmData['caFirmPayment'] ? TRUE:FALSE) ?>><?php echo $e_pmt_opt['payment_option_name']; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group text-right">
                                                    <a href="<?php echo base_url($backUrl); ?>" >
                                                        <button type="button" class="btn btn-dark">Back</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>  
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="user_details_tab" role="tabpanel">
                        <div class="box-body">
                            <div class="p-15">
                                <div class="row">
                                    <div class="col-8 offset-2">
                                        <div class="table-responsive">
                                            <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="5%">SN</th>
                                                        <th>Name</th>
                                                        <th width="5%">Staff&nbsp;Type</th>
                                                        <th width="25%">Designation</th>
                                                        <th width="15%">Username</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($getUserList)): ?>
                                                        <?php $i=1; ?>
                                                        <?php foreach($getUserList AS $e_row): ?>
                                                            <tr>
                                                    			<td class="text-center"><?php echo $i; ?></td>
                                                    			<td nowrap><?php echo $e_row['userFullName']; ?></td>
                                                    			<td class="text-center" nowrap><?php echo $e_row['staff_type_name']; ?></td>
                                                    			<td class="text-center" nowrap><?php echo $e_row['userDesgn']; ?></td>
                                                    			<td class="text-center" nowrap><?php echo $e_row['userLoginName']; ?></td>
                                                    		</tr>
                                                		    <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="9"><center>No records</center></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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