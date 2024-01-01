<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>

    .tabcontent-border {
        border: none;
        border-top: 0px;
    }
    
    .due-month{
        background:#F99D27;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }
    
    .due-month label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .heading-act {
        background:#00669d;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
        color:#fff;
    }
    
    .heading-act label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .table.dataTable-act {
        margin-top: 0px !important; 
        font-size: 12px !important;
        clear: both;
        margin-bottom: 6px !important;
        max-width: none !important;
        border-collapse: separate !important;
    }
    
    .tablepress thead tr, .tablepress thead th {
        border: 1px solid #ddd;
        color: #fff;
        font-size: 16px;
    }
    
    .tablepress tbody {
        font-size: 16px;
    }
    
    td.column-1 {
        text-align: center;
        font-weight: normal;
        font-size: 16px;
    }
    
    .tablepress tbody tr:first-child td {
        background: none;
    }
    
    .tablepress tbody tr:nth-child(4) td.column-1 {
        background: none;
    }
    
    .tablepress tbody td, .tablepress tfoot th {
      border: 1px solid #015aacab !important;
      color: #000;
    }
    
    .box-body {
        padding: 0.1rem 0.1rem;
        /* -ms-flex: 1 1 auto; */
        flex: 1 1 auto;
        border-radius: 10px;
    }
    
    .modal-header {
        
        border-bottom-color: #d5dfea;
        background-color: #F99D27;
        padding: 8px 8px;
    }
    
    .theme-primary .btn-success1 {
        background-color: #1e613b !important;
        border-color: #1e613b !important;
        color: #ffffff !important;
        width: 100px;
        font-size: 13px;
    }
    
    .theme-primary a:hover, .theme-primary a:focus {
        color: #303030 !important;
    }
    
    a {
        color: #303030;
    }

    .sub_btn{
        width: 80px !important;
    }
    
    .theme-primary .btnPrimClr {
        margin-top: 0px !important;
        height: 25px !important;
        margin-bottom: 0px !important;   
    }
    
    .actionText{
        font-size: 11px !important;
    }
    
    .proj_modal_bg{
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }
    
    .vertical_align_top{
        vertical-align: initial !important;
    }
</style>
<?php $s_time = strtotime("2019-12-01"); ?>
<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url('it-menus'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="tab-content tabcontent-border p-5" id="myTabContent">
                        <div class="tab-content tabcontent-border p-5" id="myTabContent">
                            <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1">Sr</th>
                                            <th class="column-2">Group</th>
                                            <th class="column-3">Name of the</th>
                                            <th class="column-3">PAN</th>
                                            <th class="column-4">Asst</th>
                                            <th class="column-4">Date of</th>
                                            <th class="column-5" colspan="2" nowrap>As per Return of Income</th>
                                            <th class="column-6" colspan="3" nowrap>As per Intimation u/s 143(1)</th>
                                            <th class="column-8">Action</th>
                                        </tr>
                                        <tr class="row-1">
                                            <th class="column-1 vertical_align_top">No</th>
                                            <th class="column-2 vertical_align_top">No</th>
                                            <th class="column-3 vertical_align_top">Client</th>
                                            <th class="column-3 vertical_align_top">NO</th>
                                            <th class="column-4 vertical_align_top">Year</th>
                                            <th class="column-4 vertical_align_top">Filing</th>
                                            <th class="column-5">Total<br>Income</th>
                                            <th class="column-6">Refund<br>Claimed</th>
                                            <th class="column-5">Assessed<br>Income</th>
                                            <th class="column-6">Refund<br>Approved</th>
                                            <th class="column-7">Addl<br>Tax</th>
                                            <th class="column-11"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">
                                        <?php $sr=1; ?>            
                                        <?php if(!empty($workDataArr)): ?>
                                            <?php foreach($workDataArr AS $e_inc_row): ?>
                                            
                                                <?php
                                                    $asmtYear="N/A";
                                                    if(!empty($e_inc_row['finYear']))
                                                    {
                                                        $asmtYearVal=$e_inc_row['finYear'];
                                                        
                                                        $asmtYearArr = explode('-', $asmtYearVal);
                                                        
                                                        $fY=(int)$asmtYearArr[0]+1;
                                                        $lY=(int)$asmtYearArr[1]+1;
                                                        
                                                        $asmtYear=$fY."-".$lY;
                                                    }
                                                ?>
                                            
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        <?php echo $sr; ?>
                                                    </td>
                                                    <td class="column-2">
                                                        <?php echo $e_inc_row['client_group_number']; ?>
                                                    </td>
                                                    <td class="column-3" nowrap>
                                                        <?php 
                                                            if(in_array($e_inc_row['orgType'], INDIVIDUAL_ARRAY))
                                                                $clientNameVar=$e_inc_row['clientName'];
                                                            else
                                                                $clientNameVar=$e_inc_row['clientBussOrganisation']; 
                                                        ?>
                                                        <a href="<?php echo base_url('income_tax/work_form/'.$e_inc_row['workId']); ?>" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
                                                            <?php 
                                                                if(strlen($clientNameVar)>20)
                                                                {
                                                                    echo substr($clientNameVar, 0, 20)."..";
                                                                }
                                                                else
                                                                {
                                                                    echo $clientNameVar;
                                                                }
                                                            ?>
                                                        </a>
                                                    </td>
                                                    <td class="column-4 text-center">
                                                        <?php echo $e_inc_row['clientPanNumber']; ?>
                                                    </td>
                                                    <td class="column-5 text-center">
                                                        <?php echo $asmtYear; ?>
                                                    </td>
                                                    <td class="column-1">
                                                        <?php 
                                                            $eFillingDate="-";
                                                            if(check_valid_date($e_inc_row['eFillingDate']))
                                                                $eFillingDate=date('d-m-Y', strtotime($e_inc_row['eFillingDate'])); 
                                                        ?>
                                                        <?php echo $eFillingDate; ?>
                                                    </td>
                                                    <td class="column-9">
                                                        <?php if(!empty($e_inc_row['totalIncome'])): ?>
                                                            <div class="text-right"><?= amount_format($e_inc_row['totalIncome']); ?></div>
                                                        <?php else: ?>
                                                            <div class="text-center">-</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="column-9">
                                                        <?php if(!empty($e_inc_row['refundClaimed'])): ?>
                                                            <div class="text-right"><?= amount_format($e_inc_row['refundClaimed']); ?></div>
                                                        <?php else: ?>
                                                            <div class="text-center">-</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="column-9">
                                                        <?php if(!empty($e_inc_row['intiTotalIncome'])): ?>
                                                            <div class="text-right"><?= amount_format($e_inc_row['intiTotalIncome']); ?></div>
                                                        <?php else: ?>
                                                            <div class="text-center">-</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="column-9">
                                                        <?php if(!empty($e_inc_row['refundTotalAmt'])): ?>
                                                            <div class="text-right"><?= amount_format($e_inc_row['refundTotalAmt']); ?></div>
                                                        <?php else: ?>
                                                            <div class="text-center">-</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="column-9">
                                                        <?php if(!empty($e_inc_row['intiAddtnlTax'])): ?>
                                                            <div class="text-right"><?= amount_format($e_inc_row['intiAddtnlTax']); ?></div>
                                                        <?php else: ?>
                                                            <div class="text-center">-</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="column-12 text-center" nowrap>
                                                        <!--
                                                        <a href="javascript:void(0);" class="assessmentBtn" data-workid="<?php //echo $e_inc_row['workId']; ?>" data-target="#Modalassessment">
                                                            <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-original-title="Filter">
                                                                <i class="fa fa-check"></i>&nbsp;Assessment
                                                            </button>
                                                        </a>
                                                        -->
                                                        <?php //if($e_inc_row['isScrutiny']==0): ?>
                                                            <div class="btn-group">
                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                    <!--<a class="dropdown-item openIntimationModal" data-id="<?php //echo $e_inc_row['workId']; ?>" href="javascript:void(0);">Intimation</a>-->
                                                                    <a class="dropdown-item" href="<?= base_url('intimation/'.$e_inc_row['workId']); ?>">Intimation</a>
                                                                </div>
                                                            </div>
                                                        <?php //elseif($e_inc_row['isScrutiny']==1): ?>
                                                            <!--<span class="actionText">Scrutiny(Yes)</span>-->
                                                        <?php //elseif($e_inc_row['isScrutiny']==1): ?>
                                                            <!--<span class="actionText">Scrutiny(No)</span>-->
                                                        <?php //endif; ?>
                                                    </td>
                                                </tr>
                                                <?php $sr++; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr class="row-1">
                                                <td colspan="12" class="column-1">
                                                    No records found
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    <!-- /.col -->
	</div>
</section>
<!-- /.content -->

<!-- Modal -->
<div id="assessmentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Assessment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group ">
                                <label class="col-lg-12 col-md-12 text-center">Assessment : </label> 
                            </div>
                            <div class="form-group row text-center">
                                <button type="button" class="btn btn-md btn-success btn-yesno assessment_yes" data-toggle="tooltip" data-original-title="yes">
                                Yes
                                </button>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-md btn-danger btn-yesno assessment_no" data-toggle="tooltip" data-original-title="no">
                                No
                                </button>
                                <input type="hidden" id="assessment_workId" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;"></div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
         
<!-- Modal -->
<div id="scrutinyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Scrutiny</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group ">
                                <label class="col-lg-12 col-md-12 text-center">Scrutiny : </label> 
                            </div>
                            <div class="form-group row text-center">
                                <button type="button" class="btn btn-md btn-success btn-yesno scrutiny_yes" data-toggle="tooltip" data-original-title="yes">
                                Yes
                                </button>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-md btn-danger btn-yesno scrutiny_no" data-toggle="tooltip" data-original-title="no">
                                No
                                </button>
                                <input type="hidden" id="scrutiny_workId" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;"></div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php if(!empty($workDataArr)): ?>
    <?php foreach($workDataArr AS $e_inc_row): ?>
    
        <?php 
            if(in_array($e_inc_row['orgType'], INDIVIDUAL_ARRAY))
                $clientNameVar=$e_inc_row['clientName'];
            else
                $clientNameVar=$e_inc_row['clientBussOrganisation']; 
                
            $asmtYear="N/A";
            if(!empty($e_inc_row['finYear']))
            {
                $asmtYearVal=$e_inc_row['finYear'];
                
                $asmtYearArr = explode('-', $asmtYearVal);
                
                $fY=(int)$asmtYearArr[0]+1;
                $lY=(int)$asmtYearArr[1]+1;
                
                $asmtYear=$fY."-".$lY;
            }
            
            $currWorkID=$e_inc_row['workId'];
        ?>
    
        <!-- Modal -->
        <div id="intimationModal<?= $currWorkID; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content intimationModalDiv" data-work_id="<?= $currWorkID; ?>">
                    <form action="<?php echo base_url('updateIntimation'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Intimation u/s 143(1)</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body proj_modal_bg">
                            <div class="row mt-10 m-30">
                                <div class="col-md-12 col-lg-12">
                                    <div class="row form-group">
                                        <div class="col-md-12 col-lg-12 text-center">
                                            <span class="font-weight-bold h4" >
                                                <?php echo $clientNameVar; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 text-left">
                                            <span class="font-weight-bold">PAN :&nbsp;</span>
                                            <span class="font-weight-bold">
                                                <?php echo $e_inc_row['clientPanNumber']; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 text-right">
                                            <span class="font-weight-bold">A.Y :&nbsp;</span>
                                            <span class="font-weight-bold">
                                                <?php echo $asmtYear; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4"></div>
                                        <div class="col-md-4 col-lg-4 text-center">
                                            <label class="font-weight-bold h5">As per Return of Income</label>
                                        </div>
                                        <div class="col-md-4 col-lg-4 text-center">
                                            <label class="font-weight-bold h5">As per Intimation</label>
                                        </div>
                                    </div>
                                    <hr class="m-0 mb-10">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <span class="font-weight-bold" >
                                                Total Income : 
                                            </span>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control inputRTL" value="<?php echo $e_inc_row['totalIncome']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control inputRTL" name="intiTotalIncome" id="intiTotalIncome" placeholder="Enter Total Income" value="<?php echo $e_inc_row['intiTotalIncome']; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <span class="font-weight-bold" >
                                                Refund Claimed/Approved : 
                                            </span>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control inputRTL" value="<?php echo $e_inc_row['refundDueVal']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control intiRefundApproved inputRTL" name="intiRefundApproved" id="intiRefundApproved<?= $currWorkID; ?>" placeholder="Enter Refund Approved" value="<?php echo $e_inc_row['intiRefundApproved']; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <span class="font-weight-bold" >
                                                Additional Demand :
                                            </span>
                                        </div>
                                        <div class="col-md-4 col-lg-4 text-center">
                                            -
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control inputRTL" name="intiAddtnlTax" id="intiAddtnlTax" placeholder="Enter Additional Tax" value="<?php echo $e_inc_row['intiAddtnlTax']; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="intiRemark">Remark:</label>
                                        <textarea type="text" class="form-control" name="intiRemark" id="intiRemark" placeholder="Enter Remark" rows="3"><?php echo $e_inc_row['intiRemark']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="intiIsRectification">Whether to apply for rectification/refund ?</label>
                                        <input name="intiIsRectification" type="radio" id="intiIsRectificationYes<?= $currWorkID; ?>" class="radio-col-primary" value="1" <?php if($e_inc_row['intiIsRectification']=="1"): ?>checked<?php endif; ?> />
                                        <label for="intiIsRectificationYes<?= $currWorkID; ?>">Yes</label>
                                        <input name="intiIsRectification" type="radio" id="intiIsRectificationNo<?= $currWorkID; ?>" class="radio-col-success" value="2" <?php if($e_inc_row['intiIsRectification']=="2"): ?>checked<?php endif; ?> />
                                        <label for="intiIsRectificationNo<?= $currWorkID; ?>">No</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 text-center">
                                    <input type="hidden" name="workId" id="workId" value="<?php echo $e_inc_row['workId']; ?>">
                                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    
    <?php endforeach; ?>
<?php endif; ?>

<script type="text/javascript">
            
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";
        
        $('.openIntimationModal').on('click', function(){
            var workID = $(this).data('id');
            
            $('#intimationModal'+workID).modal('show');
            
            var intiRefundApproved = $('#intiRefundApproved'+workID).val();
            
            $('#intiRefundApproved'+workID+"New").val(intiRefundApproved);
            
        });
        
        $('.calculateTotalRefundRcvd').on('keyup', function(){
            var workID = $(this).parents('.intimationModalDiv').data('work_id');
            
            console.log('workID', workID);
            
            var refundAmtRecvd = parseInt($('#refundAmtRecvd'+workID).val());
            var refundInterest = parseInt($('#refundInterest'+workID).val());
            
            var totalRefundRecvd = refundAmtRecvd+refundInterest;
            
            $('#totalRefundRecvd'+workID).val(totalRefundRecvd);
        });

        $('.assessmentBtn').on('click', function(){

            var workId=$(this).data('workid');
            $('#assessment_workId').val(workId);

            $('#assessmentModal').modal('show');

        });

        $('.scrutinyBtn').on('click', function(){

            var workId=$(this).data('workid');
            $('#scrutiny_workId').val(workId);

            $('#scrutinyModal').modal('show');

        });

        $('.assessment_yes').on('click', function(){

            var workId=$('#assessment_workId').val();

            var postingUrl = base_url+'/submit_assessment';
            var redirectUrl = base_url+'/processing';

            $.post(postingUrl, 
            {
                "workId": workId,
                "assessment": "1"
            },
            function(data, status){
                window.location.href=redirectUrl;
            });

        });

        $('.assessment_no').on('click', function(){

            var workId=$('#scrutiny_workId').val();

            var postingUrl = base_url+'/submit_assessment';
            var redirectUrl = base_url+'/processing';

            $.post(postingUrl, 
            {
                "workId": workId,
                "assessment": "2"
            },
            function(data, status){
                window.location.href=redirectUrl;
            });

        });

        $('.scrutiny_yes').on('click', function(){

            var workId=$('#scrutiny_workId').val();

            var postingUrl = base_url+'/submit_scrutiny';
            var redirectUrl = base_url+'/processing';

            $.post(postingUrl, 
            {
                "workId": workId,
                "scrutiny": "1"
            },
            function(data, status){
                window.location.href=redirectUrl;
            });

        });

        $('.scrutiny_no').on('click', function(){

            var workId=$('#assessment_workId').val();

            var postingUrl = base_url+'/submit_scrutiny';
            var redirectUrl = base_url+'/processing';

            $.post(postingUrl, 
            {
                "workId": workId,
                "scrutiny": "2"
            },
            function(data, status){
                window.location.href=redirectUrl;
            });

        });
        
        $('.intiRefundApproved').on('keyup', function(){
            var intiRefundApprovedID = $(this).attr('id');
            $('#'+intiRefundApprovedID+'New').val($(this).val());
        });

    });

</script>

<?= $this->endSection(); ?>