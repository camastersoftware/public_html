<form action="" method="POST" id="actWiseForm">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $selActName; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row">
            <?php if($clientBussOrganisationTypeId==9): ?>
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Client Name</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <label class="col-lg-6 col-md-6"><?php echo $clientName; ?></label>
                </div>
            </div>
            <?php elseif($clientBussOrganisationTypeId==8 || $clientBussOrganisationTypeId==3 || $clientBussOrganisationTypeId==22 || $clientBussOrganisationTypeId==23): ?>
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Client Name</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <label class="col-lg-6 col-md-6"><?php echo $clientName; ?></label>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Organisation Name</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <label class="col-lg-6 col-md-6"><?php echo $clientBussOrganisation; ?></label>
                </div>
            </div>
            <?php elseif($clientBussOrganisationTypeId!=9 && $clientBussOrganisationTypeId!=8 && $clientBussOrganisationTypeId!=3 && $clientBussOrganisationTypeId!=22 && $clientBussOrganisationTypeId!=23): ?>
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Organisation Name</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <label class="col-lg-6 col-md-6"><?php echo $clientBussOrganisation; ?></label>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Type of Organisation</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <label class="col-lg-6 col-md-6"><?php echo $clientBussOrganisationType; ?></label>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">PAN No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actPan" id="actPan" placeholder="PAN No" value="<?php echo $panNo; ?>">
                    </div>
                </div>
            </div>
            <?php if($selAct==1 || $selAct==2 || $selAct==3): ?>
            <!--<div class="col-md-12 col-lg-12">-->
            <!--    <div class="form-group row">-->
            <!--        <label class="col-lg-4 col-md-4">Ward No</label>-->
            <!--        <label class="col-lg-1 col-md-1">:</label>-->
            <!--        <div class="col-lg-6 col-md-6">-->
            <!--            <input type="text" class="form-control" name="actWard" id="actWard" placeholder="Ward No" value="<?php //echo $wardNo; ?>">-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <?php endif; ?>
            <?php if($selAct==8): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Goods and Services Tax (GST) Registration No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actGst" id="actGst" placeholder="Goods and Services Tax (GST) Registration No" value="<?php echo $gstNo; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($selAct==4): ?> <!-- Done -->
                <?php if($clientBussOrganisationTypeId==1): ?>
                <div class="col-md-12 col-lg-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4">Corporate Identification Number (CIN)</label>
                        <label class="col-lg-1 col-md-1">:</label>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control" name="actCin" id="actCin" placeholder="Corporate Identification Number (CIN)" value="<?php echo $clientRegDocument; ?>">
                        </div>
                    </div>
                </div>
                <?php elseif($clientBussOrganisationTypeId==8 || $clientBussOrganisationTypeId==9 || $clientBussOrganisationTypeId==22 || $clientBussOrganisationTypeId==23): ?>
                <div class="col-md-12 col-lg-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4">Director Identification Number (DIN)</label>
                        <label class="col-lg-1 col-md-1">:</label>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control" name="actDin" id="actDin" placeholder="Director Identification Number (DIN)" value="<?php echo $dinNo; ?>">
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($selAct==6): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Limited Liability Partnership Identification Number (LLPIN)</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actLlpin" id="actLlpin" placeholder="Limited Liability Partnership Identification Number (LLPIN)" value="<?php echo $clientRegDocument; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($selAct==10): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">ROF Registration No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actRofregn" id="actRofregn" placeholder="ROF Registration No" value="<?php echo $clientRegDocument; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($selAct==11): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Society Registration No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actRegn" id="actRegn" placeholder="Society Registration No" value="<?php echo $clientRegDocument; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($selAct==12): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Charity Commissioner Regn No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actRegn" id="actRegn" placeholder="Charity Commissioner Regn No" value="<?php echo $clientRegDocument; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($selAct==12): ?>
            <!--<div class="col-md-12 col-lg-12">-->
            <!--    <div class="form-group row">-->
            <!--        <label class="col-lg-4 col-md-4">Trust Deed No</label>-->
            <!--        <label class="col-lg-1 col-md-1">:</label>-->
            <!--        <div class="col-lg-6 col-md-6">-->
            <!--            <input type="text" class="form-control" name="actTrustDeed" id="actTrustDeed" placeholder="Trust Deed No" value="<?php //echo $clientRegDocument; ?>">-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <?php endif; ?>
            <?php if($selAct==3): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">TAN No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actTan" id="actTan" placeholder="TAN No" value="<?php echo $tanNo; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($selAct==7): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">PT Enrolment No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actPtEnrollNo" id="actPtEnrollNo" placeholder="PT Enrolment No" value="<?php echo $ptEnrollNo; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">PT Registration No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actPtRegNo" id="actPtRegNo" placeholder="PT Registration No" value="<?php echo $ptRegNo; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12" id="ptErrorDiv"></div>
            <?php endif; ?>
            <?php if($selAct==13): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Shops & Establishment Regn No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actShopEstNo" id="actShopEstNo" placeholder="Shops & Establishment Regn No" value="<?php echo $shopEstNo; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($selAct==14): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Udyam Registration No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actUdyamNoVal" id="actUdyamNoVal" placeholder="Udyam Registration No" value="<?php echo $udyamNo; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($selAct==15): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Trade Mark Registration No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actTmNoVal" id="actTmNoVal" placeholder="Trade Mark Registration No" value="<?php echo $tmNo; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($selAct==16): ?> <!-- Done -->
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">TCS Registration No</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control" name="actTcsNoVal" id="actTcsNoVal" placeholder="TCS Registration No" value="<?php echo $tcsNo; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Due Date </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Due Date For</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <select class="form-control" name="actDueDateFor" id="actDueDateFor">
                            <option value="">Select Due Date For</option>
                            <?php if(!empty($dueDateForArr)): ?>
                                <?php foreach($dueDateForArr AS $e_due): ?>
                                    <option value="<?php echo $e_due['act_option_map_id']; ?>"><?php echo $e_due['act_option_name']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <!--
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Periodicity</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <select class="form-control" name="actPeriodicity" id="actPeriodicity">
                            <option value="">Select Periodicity</option>
                            <?php //if(!empty($periodArr)): ?>
                                <?php //foreach($periodArr AS $e_prd): ?>
                                    <option value="<?php //echo $e_prd['periodicity_id']; ?>"><?php //echo $e_prd['periodicity_name']; ?></option>
                                <?php //endforeach; ?>
                            <?php //endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Tax Payer</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <?php //echo $clientBussOrganisationType; ?>
                        <select class="form-control" name="actTaxPayer" id="actTaxPayer">
                            <option value="">Select Tax Payer</option>
                            <?php //if(!empty($taxPayerArr)): ?>
                                <?php //foreach($taxPayerArr AS $e_tax): ?>
                                    <option value="<?php //echo $e_tax['act_option_map_id']; ?>"><?php //echo $e_tax['act_option_name']; ?></option>
                                <?php //endforeach; ?>
                            <?php //endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4">Condition</label>
                    <label class="col-lg-1 col-md-1">:</label>
                    <div class="col-lg-6 col-md-6">
                        <select class="form-control" name="actCondition" id="actCondition">
                            <option value="0">No Condition</option>
                            <?php //if(!empty($conditionArr)): ?>
                                <?php //foreach($conditionArr AS $e_cdn): ?>
                                    <option value="<?php //echo $e_cdn['act_option_map_id']; ?>"><?php //echo $e_cdn['act_option_name']; ?></option>
                                <?php //endforeach; ?>
                            <?php //endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
    <div class="modal-footer text-right" style="width: 100%;">
        <input type="hidden" name="actId" id="selectedActId" value="<?php echo $selAct; ?>">
        <input type="hidden" name="actName" value="<?php echo $selActName; ?>">
        <input type="hidden" name="actTaxPayer" id="actTaxPayer" value=""/>
        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-success text-left submitActData">Submit</button>
    </div>
</form>