<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .theme-primary .wizard-content .wizard > .steps > ul > li.done {
            margin-top: 15px;
            width: 297px;
    }
            
    .tablepress tbody tr:first-child td {
        background: #288651;
        color: #fff;
    } 
    
    .tablepress tbody tr:nth-child(4) td.column-1 {
        background: #fb3d3d;
        color: #fff;
    }
    
    .theme-primary .wizard-content .wizard > .steps > ul > li.current {
        margin-top: 15px;
        width: 297px;
    }

    
    .tablepress{
        width:100%;
    }
    
    .tablepress thead tr, .tablepress thead th {
        text-align: center;
        width: 10%;
    }
    
    .tablepress tbody td {
        text-align: center;
    }
    
    .tablepress td, .tablepress th {
        font-weight: 600;
    }
    
    .tablepress tbody tr:nth-child(6) td.column-1 {
        background: #fff;
    }
    
    table.dataTable {
        clear: both;
         margin-top: 0px !important; 
    }
    
    .wizard-content .wizard > .content > .body {
        padding: 0px 20px;
    }
</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
            <div class="box-header with-border flexbox text-center">
                    <h4 class="box-title font-weight-bold hdClr">
                        <?php
                            if(isset($pageTitle))
                                echo $pageTitle;
                            else
                                echo "N/A";
                        ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('gst_tax_payment'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right font-weight-bold" style="">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?= base_url('insert_gst_payment'); ?>" method="POST">
                        <!-- Step 1 -->
                        <section>
                            <div class="row">
                                <div class="col-md-6 mt-20">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Name of Party :<small class="text-danger">*</small></label>
                                                <select class="form-control select2 select2-hidden-accessible" name="fkClientId" id="fkClientId" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                                    <option value="">Select</option>
                                                    <?php if(!empty($clientList)): ?>
                                                        <?php foreach($clientList AS $e_ret): ?>
                                                            <option value="<?= $e_ret['clientId'] ?>" data-grp="<?= $e_ret['client_group_number'] ?>"><?= $e_ret['clientBussOrganisation'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8" id="">
                                            <div class="form-group">
                                                <label for="">Date Of Payment :</label>
                                                <input type="date" class="form-control" name="pmtDate" id="pmtDate">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Type Of Return :</label>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" name="retType" tabindex="-1" aria-hidden="true">
                                                    <option value="">Select</option>
                                                    <?php if(!empty($retTypesArr)): ?>
                                                        <?php foreach($retTypesArr AS $e_ret): ?>
                                                            <option value="<?= $e_ret['id'] ?>"><?= $e_ret['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="workDone">Challan Reference No</label>
                                                <input type="type" class="form-control" name="challanRefNo" id="challanRefNo" > 
                                            </div>
                                        </div> 
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Mode</label>
                                                <select class="form-control" name="pmtMode">
                                                    <option value="">Select</option>
                                                    <?php if(!empty($pmtModesArr)): ?>
                                                        <?php foreach($pmtModesArr AS $e_ret): ?>
                                                            <option value="<?= $e_ret['id'] ?>"><?= $e_ret['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div> 
                                        </div>  
                                    </div> 
                                </div>
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="clientGrp">Group No :<small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" name="clientGrp" id="clientGrp" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8" id="">
                                            <div class="form-group">
                                                <label for="">Return Period :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-4" id="">
                                            <div class="row form-group mb-0">
                                                <label for="">From</label>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6">
                                                    <select class="custom-select form-control" id="retMthFrom" name="retMthFrom">
                                                        <option value="">Month</option>
                                                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                        <?php
                                                            if($m_no<=9)
                                                                $m=$m_no+3;
                                                            else
                                                                $m=$m_no-9;
                                                        ?>
                                                            <option value="<?php echo $m; ?>"><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="custom-select form-control" id="retYrFrom" name="retYrFrom">
                                                        <option value="">Year</option>
                                                        <?php for($y=(date('Y')+2);$y>=2017;$y--): ?>
                                                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="">
                                            <div class="row form-group mb-0">
                                                <label for="">To</label>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6">
                                                    <select class="custom-select form-control" id="retMthTo" name="retMthTo">
                                                        <option value="">Month</option>
                                                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                        <?php
                                                            if($m_no<=9)
                                                                $m=$m_no+3;
                                                            else
                                                                $m=$m_no-9;
                                                        ?>
                                                            <option value="<?php echo $m; ?>"><?php echo date('F', strtotime("2021-".$m."-1")); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="custom-select form-control" id="retYrTo" name="retYrTo">
                                                        <option value="">Year</option>
                                                        <?php for($y=(date('Y')+2);$y>=2017;$y--): ?>
                                                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Type Of Challan :</label>
                                                <select class="form-control select2 select2-hidden-accessible" name="challanType" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <option selected="selected">Select</option>
                                                    <?php if(!empty($challanTypesArr)): ?>
                                                        <?php foreach($challanTypesArr AS $e_challan): ?>
                                                            <option value="<?= $e_challan['id'] ?>"><?= $e_challan['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <section>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-12" id="">
                                            <div class="form-group">
                                                <label for="turnOver">TYPE OF TAX :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">CGST</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">TAX :</label>
                                                <input type="text" class="form-control" name="cgstTax" id="cgstTax" onkeyup="calculateTotalTax();" onkeydown="calculateTotalTax();" onkeypress="calculateTotalTax();validateNum(event);" oninput="calculateTotalTax();">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">INTEREST:</label>
                                                <input type="text" class="form-control" name="cgstInterest" id="cgstInterest" onkeyup="calculateTotalInterest();" onkeydown="calculateTotalInterest();" onkeypress="calculateTotalInterest();validateNum(event);" oninput="calculateTotalInterest();">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">PENALTY :</label>
                                                <input type="text" class="form-control" name="cgstPenalty" id="cgstPenalty" onkeyup="calculateTotalPenalty();" onkeydown="calculateTotalPenalty();" onkeypress="calculateTotalPenalty();validateNum(event);" oninput="calculateTotalPenalty();">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">FEES :</label>
                                                <input type="text" class="form-control" name="cgstFees" id="cgstFees" onkeyup="calculateTotalFees();" onkeydown="calculateTotalFees();" onkeypress="calculateTotalFees();validateNum(event);" oninput="calculateTotalFees();">
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">SGST</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">TAX :</label>
                                                <input type="text" class="form-control" name="sgstTax" id="sgstTax" onkeyup="calculateTotalTax();" onkeydown="calculateTotalTax();" onkeypress="calculateTotalTax();validateNum(event);" oninput="calculateTotalTax();">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">INTEREST:</label>
                                                <input type="text" class="form-control" name="sgstInterest" id="sgstInterest" onkeyup="calculateTotalInterest();" onkeydown="calculateTotalInterest();" onkeypress="calculateTotalInterest();validateNum(event);" oninput="calculateTotalInterest();">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">PENALTY :</label>
                                                <input type="text" class="form-control" name="sgstPenalty" id="sgstPenalty" onkeyup="calculateTotalPenalty();" onkeydown="calculateTotalPenalty();" onkeypress="calculateTotalPenalty();validateNum(event);" oninput="calculateTotalPenalty();">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">FEES :</label>
                                                <input type="text" class="form-control" name="sgstFees" id="sgstFees" onkeyup="calculateTotalFees();" onkeydown="calculateTotalFees();" onkeypress="calculateTotalFees();validateNum(event);" oninput="calculateTotalFees();">
                                            </div>
                                        </div>  
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <hr>
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">IGST</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">TAX :</label>
                                                <input type="text" class="form-control" name="igstTax" id="igstTax" onkeyup="calculateTotalTax();" onkeydown="calculateTotalTax();" onkeypress="calculateTotalTax();validateNum(event);" oninput="calculateTotalTax();">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">INTEREST:</label>
                                                <input type="text" class="form-control" name="igstInterest" id="igstInterest" onkeyup="calculateTotalInterest();" onkeydown="calculateTotalInterest();" onkeypress="calculateTotalInterest();validateNum(event);" oninput="calculateTotalInterest();">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">PENALTY :</label>
                                                <input type="text" class="form-control" name="igstPenalty" id="igstPenalty" onkeyup="calculateTotalPenalty();" onkeydown="calculateTotalPenalty();" onkeypress="calculateTotalPenalty();validateNum(event);" oninput="calculateTotalPenalty();">
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">FEES :</label>
                                                <input type="text" class="form-control" name="igstFees" id="igstFees" onkeyup="calculateTotalFees();" onkeydown="calculateTotalFees();" onkeypress="calculateTotalFees();validateNum(event);" oninput="calculateTotalFees();">
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div><hr>
                            <div class="row">
                                <div class="col-md-12 mt-30">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="grossTotalIncome">Total</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="totalIncome">TAX :</label>
                                                <input type="text" class="form-control" name="totalTax" id="totalTax" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">INTEREST:</label>
                                                <input type="text" class="form-control" name="totalInterest" id="totalInterest" readonly>
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">PENALTY :</label>
                                                <input type="text" class="form-control" name="totalPenalty" id="totalPenalty" readonly>
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="selfAssessmentTax">FEES :</label>
                                                <input type="text" class="form-control" name="totalFees" id="totalFees" readonly>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <br>
                        <div class="text-right">
                            <hr>
                            <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button>
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
        
        $('#fkClientId').on('change', function(){
            
            var selClient = $(this).val();
            
            var clientGrp = "";
            
            if(selClient!="")
                clientGrp = $('#fkClientId option:selected').data('grp');
                
            $('#clientGrp').val(clientGrp);
            
        });
    });
    
    function calculateTotalTax()
    {
        var cgstTax = $('#cgstTax').val();
        var sgstTax = $('#sgstTax').val();
        var igstTax = $('#igstTax').val();
        
        console.log(cgstTax, sgstTax, igstTax);
        
        var cgstTaxAmt = sgstTaxAmt = igstTaxAmt = 0;
        
        if(cgstTax!="")
            cgstTaxAmt = parseInt(cgstTax);
            
        if(sgstTax!="")
            sgstTaxAmt = parseInt(sgstTax);
            
        if(igstTax!="")
            igstTaxAmt = parseInt(igstTax);
            
        var totalTax = cgstTaxAmt+sgstTaxAmt+igstTaxAmt;
        
        $('#totalTax').val(totalTax);
    }
    
    function calculateTotalInterest()
    {
        var cgstInterest = $('#cgstInterest').val();
        var sgstInterest = $('#sgstInterest').val();
        var igstInterest = $('#igstInterest').val();
        
        var cgstInterestAmt = sgstInterestAmt = igstInterestAmt = 0;
        
        if(cgstInterest!="")
            cgstInterestAmt = parseInt(cgstInterest);
            
        if(sgstInterest!="")
            sgstInterestAmt = parseInt(sgstInterest);
            
        if(igstInterest!="")
            igstInterestAmt = parseInt(igstInterest);
            
        var totalInterest = cgstInterestAmt+sgstInterestAmt+igstInterestAmt;
        
        $('#totalInterest').val(totalInterest);
    }
    
    function calculateTotalPenalty()
    {
        var cgstPenalty = $('#cgstPenalty').val();
        var sgstPenalty = $('#sgstPenalty').val();
        var igstPenalty = $('#igstPenalty').val();
        
        var cgstPenaltyAmt = sgstPenaltyAmt = igstPenaltyAmt = 0;
        
        if(cgstPenalty!="")
            cgstPenaltyAmt = parseInt(cgstPenalty);
            
        if(sgstPenalty!="")
            sgstPenaltyAmt = parseInt(sgstPenalty);
            
        if(igstPenalty!="")
            igstPenaltyAmt = parseInt(igstPenalty);
            
        var totalPenalty = cgstPenaltyAmt+sgstPenaltyAmt+igstPenaltyAmt;
        
        $('#totalPenalty').val(totalPenalty);
    }
    
    function calculateTotalFees()
    {
        var cgstFees = $('#cgstFees').val();
        var sgstFees = $('#sgstFees').val();
        var igstFees = $('#igstFees').val();
        
        var cgstFeesAmt = sgstFeesAmt = igstFeesAmt = 0;
        
        if(cgstFees!="")
            cgstFeesAmt = parseInt(cgstFees);
            
        if(sgstFees!="")
            sgstFeesAmt = parseInt(sgstFees);
            
        if(igstFees!="")
            igstFeesAmt = parseInt(igstFees);
            
        var totalFees = cgstFeesAmt+sgstFeesAmt+igstFeesAmt;
        
        $('#totalFees').val(totalFees);
    }
</script>

<?= $this->endSection(); ?>