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
    
    .theme-primary .filter {
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
    
    .column-9 {
        width:247px;
    }
    
    .btn-yesno{
        width:46%;
    }
    
    .btn-sm {
        font-size: 13px;
        padding: 4px 12px;
    }
</style>
<?php $s_time = strtotime("2019-12-01"); ?>
<!-- Main content -->
<section class="content mt-40">
    <div class="row">

        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h4 class="box-title">Income Tax- Assessment</h4>
                    <a href="<?php echo base_url('admin/inc_menus'); ?>"><button type="button" class="waves-effect waves-light btn btn-dark float-right" style="">Back</button></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <?php
                    $currFinYr=substr($sessDueDateYear,0, 4);
                ?>
                <?php if(!empty($workDataArr)): ?>
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
                        <!-- Tab panes -->
                        
                        <?php if(isset($mthTaxPayArr[$a])): ?>
                            <?php if(!empty($mthTaxPayArr[$a])): ?>
                                <?php foreach($mthTaxPayArr[$a] AS $e_key=>$e_txp): ?>
                                
                                    <?php if(isset($mthTaxPayerArr[$a][$e_txp])): ?>
                                        <?php if(!empty($mthTaxPayerArr[$a][$e_txp])): ?>
                                            
                                            <?php $dueDate=date('t-m-Y', strtotime('01-'.$a.'-'.$yearVar)); ?>
                                            <div class="tab-content tabcontent-border p-15" id="myTabContent">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="state due-month">
                                                            <label>Due Date For The Month Of : <?php echo $u_mth."-".$yearVar; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="state heading-act">
                                                            <label>Income Tax - <?php echo $mthTaxPayerArr[$a][$e_txp]; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                        <thead>
                                                            <tr class="row-0">
                                                                <th class="column-1" colspan="5">Due Date : <?php echo $dueDate; ?></th>
                                                                <th class="column-2" colspan="4">Periodicity : Yearly</th>
                                                                <th class="column-3" colspan="7">Period Apr <?php echo $sessDueDateYear; ?> - Mar <?php echo (int)$sessDueDateYear+1; ?></th>	
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr class="row-1">
                                                                <th class="column-1">Sr</th>
                                                                <th class="column-2">Group</th>
                                                                <th class="column-3">Name of the Client</th>
                                                                <th class="column-3">Due Date</th>
                                                                <th class="column-4">DOC</th>
                                                                <th class="column-5" colspan="2">ALLOTED TO</th>
                                                                <th class="column-6" colspan="2">COMPELTED</th>
                                                                <th class="column-7">SET</th>
                                                                <th class="column-8">BILLING</th>
                                                                <th class="column-9">Action</th>
                                                            </tr>
                                                            <tr class="row-1">
                                                                <th class="column-1">No</th>
                                                                <th class="column-2">No</th>
                                                                <th class="column-3"></th>
                                                                <th class="column-3">For</th>
                                                                <th class="column-4">RECD</th>
                                                                <th class="column-5">JUNIOR</th>
                                                                <th class="column-6">SENIOR</th>
                                                                <th class="column-7">%</th>
                                                                <th class="column-8">ON</th>
                                                                <th class="column-9">BY</th>
                                                                <th class="column-11">TYPE</th>
                                                                <th class="column-12"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="row-hover">
                                                            <?php $sr=1; ?>
                                                            <?php if(isset($mthTaxPayerClientArr[$a][$e_txp])): ?>
                                                                <?php $mthTaxPayerClientArray=$mthTaxPayerClientArr[$a][$e_txp]; ?>
                                                                <?php if(!empty($mthTaxPayerClientArray)): ?>
                                                                    <?php foreach($mthTaxPayerClientArray AS $e_inc_row): ?>
                                                                        <tr class="row-1">
                                                                            <td class="column-1">
                                                                                <?php echo $sr; ?>
                                                                            </td>
                                                                            <td class="column-2">
                                                                                <?php echo $e_inc_row['client_group_number']; ?>
                                                                            </td>
                                                                            <td class="column-3">
                                                                                <a href="<?php echo base_url('admin/income_tax/work_form/'.$e_inc_row['workId']); ?>">
                                                                                    <?php //echo $e_inc_row['clientTitle'].". ".$e_inc_row['clientName']; ?>
                                                                                    
                                                                                    <?php 
                                                                                        if($e_inc_row['orgType']==9)
                                                                                            echo $e_inc_row['clientTitle'].". ".$e_inc_row['clientName'];
                                                                                        else
                                                                                            echo $e_inc_row['clientBussOrganisation']; 
                                                                                    ?>
                                                                                </a>
                                                                            </td>
                                                                            <td class="column-4">
                                                                                <?php echo $e_inc_row['act_option_name1']; ?>
                                                                            </td>
                                                                            <td class="column-5">-</td>
                                                                            <td class="column-6"></td>
                                                                            <td class="column-7"></td>
                                                                            <td class="column-8"></td>
                                                                            <td class="column-9"></td>
                                                                            <td class="column-10"></td>
                                                                            <td class="column-11">Free</td>
                                                                            <td class="column-12">
                                                                                <!--
                                                                                <a href="javascript:void(0);" class="assessmentBtn" data-workid="<?php //echo $e_inc_row['workId']; ?>" data-target="#Modalassessment">
                                                                                    <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-original-title="Filter">
                                                                                        <i class="fa fa-check"></i>&nbsp;Assessment
                                                                                    </button>
                                                                                </a>
                                                                                -->
                                                                                <a href="javascript:void(0);" class="scrutinyBtn" data-workid="<?php echo $e_inc_row['workId']; ?>" data-target="#Modalscrutiny">
                                                                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Filter">
                                                                                        <i class="fa fa-check"></i>&nbsp;Scrutiny
                                                                                    </button>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php $sr++; ?>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
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
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php else: ?>
                    <div class="tab-content tabcontent-border p-15" id="myTabContent">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="state due-month">
                                    <label>Due Date For The Month Of : N/A</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="state heading-act">
                                    <label>Income Tax - N/A</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                <thead>
                                    <tr class="row-0">
                                        <th class="column-1" colspan="5">Due Date : N/A</th>
                                        <th class="column-2" colspan="4">Periodicity : N/A</th>
                                        <th class="column-3" colspan="7">Period: N/A</th>	
                                    </tr>
                                </thead>
                                <thead>
                                    <tr class="row-1">
                                        <th class="column-1">Sr</th>
                                        <th class="column-2">Group</th>
                                        <th class="column-3">Name of the Client</th>
                                        <th class="column-3">Due Date</th>
                                        <th class="column-4">DOC</th>
                                        <th class="column-5" colspan="2">ALLOTED TO</th>
                                        <th class="column-6" colspan="2">COMPELTED</th>
                                        <th class="column-7">SET</th>
                                        <th class="column-8">BILLING</th>
                                        <th class="column-9" colspan="3">Bill Details</th>
                                        <th class="column-11"colspan="2">Recipts</th>
                                    </tr>
                                    <tr class="row-1">
                                        <th class="column-1">No</th>
                                        <th class="column-2">No</th>
                                        <th class="column-3"></th>
                                        <th class="column-3">For</th>
                                        <th class="column-4">RECD</th>
                                        <th class="column-5">JUNIOR</th>
                                        <th class="column-6">SENIOR</th>
                                        <th class="column-7">%</th>
                                        <th class="column-8">ON</th>
                                        <th class="column-9">BY</th>
                                        <th class="column-11">TYPE</th>
                                        <th class="column-12">NO</th>
                                        <th class="column-13">Date</th>
                                        <th class="column-14">Amount</th>
                                        <th class="column-15">Date</th>
                                        <th class="column-16">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="row-hover">
                                    <tr class="row-1">
                                        <td colspan="16" class="column-1">
                                            No records found
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
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

            var postingUrl = base_url+'/admin/submit_assessment';
            var redirectUrl = base_url+'/admin/processing';

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

            var postingUrl = base_url+'/admin/submit_assessment';
            var redirectUrl = base_url+'/admin/processing';

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

            var postingUrl = base_url+'/admin/submit_scrutiny';
            var redirectUrl = base_url+'/admin/processing';

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

            var postingUrl = base_url+'/admin/submit_scrutiny';
            var redirectUrl = base_url+'/admin/processing';

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