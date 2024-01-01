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
        font-size: 13px;
    }
    
    .tablepress tbody {
        font-size: 13px;
    }
    
    td.column-1 {
        text-align: center;
        font-weight: normal;
        font-size: 13px;
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
                            <a href="<?php echo base_url('inc_menus'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="tab-content tabcontent-border p-5" id="myTabContent">
                        <?php $mthDataArray=array(); ?>
                        <?php $currFinYr=substr($sessDueDateYear,0, 4); ?>
                        <?php for($w=1; $w<13; $w++): ?>    
                            <?php 
                              if($w<=9)
                              {
                                $a=$w+3;
                                $yearVar=$currFinYr;
                              }
                              else
                              {
                                $a=$w-9;
                                $yearVar=$currFinYr+1;
                              }
                              
                            ?>
                            <?php $l_mth=strtolower(date('F', strtotime("+".$a." month", $s_time))); ?>
                            <?php $u_mth=date('F', strtotime("+".$a." month", $s_time)); ?>
                            <?php $mth_nm=strtolower(date('M', strtotime("2021-".$a."-1"))); ?>
                            
                            <?php $hasData=false; ?>
                            
                            <?php if(isset($mthDataArr[$a])): ?>
                            
                                <?php $mthDataArray=$mthDataArr[$a]; ?>
                                
                                <?php if(!empty($mthDataArray)): ?>
                                    
                                    <?php if(isset($mthDDFArr[$a])): ?>
                                        
                                        <?php $mthDDFArray=$mthDDFArr[$a]; ?>
                                    
                                        <?php if(!empty($mthDDFArray)): ?>
                                        
                                            <?php foreach($mthDDFArray AS $k_ddf=>$e_ddf): ?>
                                            
                                                <?php $due_date_for=$e_ddf['act_option_name1']; ?>
                                        
                                                <?php if(isset($mthDDFDueDateArr[$a][$k_ddf])): ?>
                                                
                                                    <?php $mthDDFDueDateArray=$mthDDFDueDateArr[$a][$k_ddf]; ?>
                                                    
                                                    <?php if(!empty($mthDDFDueDateArray)): ?>
                                                        <?php foreach($mthDDFDueDateArray AS $k_due_date=>$e_due_date): ?>
                                                        
                                                        <?php $due_date=$e_due_date['extended_date']; ?>
                                                        
                                                        <?php $dueDate=date('d-m-Y', strtotime($due_date)); ?>
                                                        
                                                        <?php
                                                            $asmtYear="N/A";
                                                            if(!empty($e_due_date['finYear']))
                                                            {
                                                                $asmtYearVal=$e_due_date['finYear'];
                                                                
                                                                $asmtYearArr = explode('-', $asmtYearVal);
                                                                
                                                                $fY=(int)$asmtYearArr[0]+1;
                                                                $lY=(int)$asmtYearArr[1]+1;
                                                                
                                                                $asmtYear=$fY."-".$lY;
                                                            }
                                                        ?>
                                                        <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="state due-month">
                                                                        <label>Due Date For : <?php echo $due_date_for; ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                                    <thead>
                                                                        <tr class="row-1">
                                                                            <th class="column-1">Sr</th>
                                                                            <th class="column-2">Group</th>
                                                                            <th class="column-3">Name of the Client</th>
                                                                            <th class="column-3">Tax Payer</th>
                                                                            <th class="column-4">Assessment</th>
                                                                            <th class="column-5" colspan="3">As per Return of Income</th>
                                                                            <th class="column-6" colspan="3">As per Intimation u/s 143(1)</th>
                                                                            <th class="column-8">Letter</th>
                                                                        </tr>
                                                                        <tr class="row-1">
                                                                            <th class="column-1">No</th>
                                                                            <th class="column-2">No</th>
                                                                            <th class="column-3"></th>
                                                                            <th class="column-3"></th>
                                                                            <th class="column-4">Year</th>
                                                                            <th class="column-5">Total Income</th>
                                                                            <th class="column-6">Refund Due</th>
                                                                            <th class="column-7">SA Tax Paid</th>
                                                                            <th class="column-5">Total Income</th>
                                                                            <th class="column-6">Refund Approved</th>
                                                                            <th class="column-7">Additional Tax</th>
                                                                            <th class="column-11">Filed On</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="row-hover">
                                                                        <?php $sr=1; ?>
                                                                
                                                                        <?php if(isset($mthDDFDueDateForClientArr[$a][$k_ddf][$k_due_date])): ?>
                                                                        
                                                                            <?php $mthDDFDueDateForClientArray=$mthDDFDueDateForClientArr[$a][$k_ddf][$k_due_date]; ?>
                                                                            
                                                                            <?php if(!empty($mthDDFDueDateForClientArray)): ?>
                                                                                <?php foreach($mthDDFDueDateForClientArray AS $e_inc_row): ?>
                                                                                
                                                                                    <?php $hasData=true; ?>
                                                                                
                                                                                    <tr class="row-1">
                                                                                        <td class="column-1">
                                                                                            <?php echo $sr; ?>
                                                                                        </td>
                                                                                        <td class="column-2">
                                                                                            <?php echo $e_inc_row['client_group_number']; ?>
                                                                                        </td>
                                                                                        <td class="column-3">
                                                                                            <a href="<?php echo base_url('income_tax/work_form/'.$e_inc_row['workId']); ?>">
                                                                                                <?php //echo $e_inc_row['clientTitle'].". ".$e_inc_row['clientName']; ?>
                                                                                                
                                                                                                <?php 
                                                                                                    if($e_inc_row['orgType']==8 || $e_inc_row['orgType']==9)
                                                                                                        echo $e_inc_row['clientName'];
                                                                                                    else
                                                                                                        echo $e_inc_row['clientBussOrganisation']; 
                                                                                                ?>
                                                                                            </a>
                                                                                        </td>
                                                                                        <td class="column-4 text-center">
                                                                                            <?php echo $e_inc_row['client_org_name']; ?>
                                                                                        </td>
                                                                                        <td class="column-5 text-center">
                                                                                            <?php echo $asmtYear; ?>
                                                                                        </td>
                                                                                        <td class="column-9">
                                                                                            <?php if(!empty($e_inc_row['totalIncome'])): ?>
                                                                                                <div class="text-right"><?= amount_format($e_inc_row['totalIncome']); ?></div>
                                                                                            <?php else: ?>
                                                                                                <div class="text-center">-</div>
                                                                                            <?php endif; ?>
                                                                                        </td>
                                                                                        <td class="column-9">
                                                                                            <?php if(!empty($e_inc_row['refundDueVal'])): ?>
                                                                                                <div class="text-right"><?= amount_format($e_inc_row['refundDueVal']); ?></div>
                                                                                            <?php else: ?>
                                                                                                <div class="text-center">-</div>
                                                                                            <?php endif; ?>
                                                                                        </td>
                                                                                        <td class="column-9">
                                                                                            <?php if(!empty($e_inc_row['selfAssessmentTax'])): ?>
                                                                                                <div class="text-right"><?= amount_format($e_inc_row['selfAssessmentTax']); ?></div>
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
                                                                                            <?php if(!empty($e_inc_row['intiRefundApproved'])): ?>
                                                                                                <div class="text-right"><?= amount_format($e_inc_row['intiRefundApproved']); ?></div>
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
                                                                                        <td class="column-12 text-center">
                                                                                            <?php 
                                                                                                if(!empty($e_inc_row['rectFiledDate']) && $e_inc_row['rectFiledDate']!="1970-01-01" && $e_inc_row['rectFiledDate']!="0000-00-00")
                                                                                                    echo date('d-m-Y', strtotime($e_inc_row['rectFiledDate']));
                                                                                                else
                                                                                                    echo "-"; 
                                                                                            ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php $sr++; ?>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                        
                        <?php if(empty($mthDataArray)): ?>
                            <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="state due-month">
                                            <label>Due Date For : N/A</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                        <thead>
                                            <tr class="row-1">
                                                <th class="column-1">Sr</th>
                                                <th class="column-2">Group</th>
                                                <th class="column-3">Name of the Client</th>
                                                <th class="column-3">Tax Payer</th>
                                                <th class="column-4">Assessment</th>
                                                <th class="column-5" colspan="3">As per Return of Income</th>
                                                <th class="column-6" colspan="3">As per Intimation u/s 143(1)</th>
                                                <th class="column-8">Letter</th>
                                            </tr>
                                            <tr class="row-1">
                                                <th class="column-1">No</th>
                                                <th class="column-2">No</th>
                                                <th class="column-3"></th>
                                                <th class="column-3"></th>
                                                <th class="column-4">Year</th>
                                                <th class="column-5">Total Income</th>
                                                <th class="column-6">Refund Due</th>
                                                <th class="column-7">SA Tax Paid</th>
                                                <th class="column-5">Total Income</th>
                                                <th class="column-6">Refund Approved</th>
                                                <th class="column-7">Additional Tax</th>
                                                <th class="column-11">Filed On</th>
                                            </tr>
                                        </thead>
                                        <tbody class="row-hover">
                                            <tr class="row-1">
                                                <td colspan="12" class="column-1">
                                                    No records found
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
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

<script type="text/javascript">
            
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";

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

    });

</script>

<?= $this->endSection(); ?>