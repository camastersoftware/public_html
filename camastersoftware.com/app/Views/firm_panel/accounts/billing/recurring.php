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
    
    .second_header_div{
        background:#96c7f242;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }
    
    .second_header{
        font-size: 15px;
        font-weight: bold;
        padding: 2px;
        color: #000;
    }
    
    .tbl_row_clr{
        background:#96c7f242 !important;
    }
    
    .hasAbove50Completed{
        background : #e8f219a3 !important;
    }
    
    .hasAbove75Completed{
        background : #f4a047a8 !important;
    } 
    
    .hasCompleted{
        background : #24d724a6 !important;
    }
    
    .urgent_work_clr{
        background : pink !important;
    }
    
    .none{
        background-color: #96c7f242 !important;
    }
    .red{
        background-color: pink !important;
    } 
    .yellow{
        background-color: #f0f58b7d !important;
    } 
    .violet{
        background-color: #f38bf5 !important;
    } 
    .green{
        background-color: #37fa1f !important;
    }
    
    .hasReturn{
        background: #e4f1fc;
    }

    .theme-primary .btnPrimClr {
        margin-top: 0px !important;
        height: 30px !important;
        margin-bottom: 0px !important;
    }

    tr.billTypeUpdated td:not(:last-child) {
        background: #24d724a6 !important;
    }
    
</style>

<!-- Main content -->
<section class="content mt-35">
	<div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url('accountFinance'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    
                    <?php $hasData=false; ?>

                    <div class="row mb-10">
                        <div class="col-md-12">
                            <form action="<?= base_url('recurring-bills'); ?>" method="POST" >
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <div class="form-group row mx-2">
                                                    <label class="col-lg-12 col-md-12">Select Act:</label>
                                                    <div class="col-lg-12 col-md-12">
                                                        <select class="form-control" name="ftr_act" id="ftr_act">
                                                            <option value="">All</option>
                                                            <?php if(!empty($actArr)): ?>
                                                                <?php foreach($actArr AS $e_act): ?>
                                                                    <option value="<?php echo $e_act['act_id']; ?>" <?= ($e_act['act_id']==$actId) ? "selected":"" ?>><?php echo $e_act['act_name']; ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row mx-2">
                                                    <label class="col-lg-12 col-md-12">Client Group:</label>
                                                    <div class="col-lg-12 col-md-12">
                                                        <select class="form-control" name="ftr_clientgrp" id="ftr_clientgrp">
                                                            <option value="">All</option>
                                                            <?php if(!empty($groupList)): ?>
                                                                <?php foreach($groupList AS $e_cl_grp): ?>
                                                                    <option value="<?php echo $e_cl_grp['client_group_id']; ?>" <?php echo $ftr_clientgrp==$e_cl_grp['client_group_id'] ? "selected":""; ?> ><?php echo $e_cl_grp['client_group']; ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row mx-2">
                                                    <label class="col-lg-12 col-md-12">Client Name:</label>
                                                    <div class="col-lg-12 col-md-12">
                                                        <select class="form-control select2" name="ftr_client" id="ftr_client" style="width:100%;">
                                                            <option value="">All</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" name="submit" class="btn btn-success text-left btn-sm mt-30">Apply</button>
                                                <a href="<?= base_url('recurring-bills'); ?>">             
                                                    <button type="button" name="reset" class="btn btn-secondary btn-sm text-left mt-30">Reset</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <!-- <button type="submit" name="submit" class="btn btn-success btn-sm text-left">Apply</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <?php if(!empty($DDFDueDateArr)): ?>
                                <?php foreach($DDFDueDateArr AS $k_due_date=>$e_due_date): ?>
                                
                                <?php $due_date_for_name=$e_due_date['act_option_name1']; ?>
                                
                                <?php $due_date_periodicity=$e_due_date['periodicity_name']; ?>
                                
                                <?php $due_date=$e_due_date['extended_date']; ?>
                                
                                <?php $dueDate=date('d-m-Y', strtotime($due_date)); ?>
                                
                                <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label>Due Date For : <?= $due_date_for_name; ?> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="state second_header_div">
                                                <div class="row">
                                                    <div class="col-md-4 text-center second_header">
                                                        Due Date : <?= $dueDate; ?>
                                                    </div>
                                                    <div class="col-md-4 text-center second_header">
                                                        Periodicity : <?= $due_date_periodicity; ?>
                                                    </div>
                                                    <div class="col-md-4 text-center second_header">
                                                        Period : 
                                                        <?php
                                                            if($e_due_date['periodicity']=="1")
                                                            {
                                                                echo date("d-M-Y", strtotime($e_due_date["daily_date"]));
                                                            }
                                                            elseif($e_due_date['periodicity']=="2")
                                                            {
                                                                echo date("M", strtotime("2021-".$e_due_date["period_month"]."-01"))."-".$e_due_date["period_year"];
                                                            }
                                                            elseif($e_due_date['periodicity']>="3")
                                                            {
                                                                echo date("M", strtotime("2021-".$e_due_date["f_period_month"]."-01"))."-".$e_due_date["f_period_year"]." - ".date("M", strtotime("2021-".$e_due_date["t_period_month"]."-01"))."-".$e_due_date["t_period_year"];
                                                            }
                                                            else
                                                            {
                                                                echo "N/A";
                                                            }
                                                        ?>
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
                                                        (AY : <?= $asmtYear; ?>)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                    <thead>
                                                        <tr class="row-1">
                                                            <th class="column-1" width="1%">Sr</th>
                                                            <th class="column-2" width="5%">Group</th>
                                                            <th class="column-3" width="20%">Name of the</th>
                                                            <th class="column-3" width="10%">Tax</th>
                                                            <th class="column-5" colspan="2" width="20%">Alloted to</th>
                                                            <th class="column-6" width="5%">Completed</th>
                                                            <th class="column-7" width="5%">Cost</th>
                                                            <th class="column-11" width="5%">Action</th>
                                                        </tr>
                                                        <tr class="row-1">
                                                            <th class="column-1" width="1%">No</th>
                                                            <th class="column-2" width="5%">No</th>
                                                            <th class="column-3" width="20%">Client</th>
                                                            <th class="column-3" width="10%">Payer</th>
                                                            <th class="column-5" width="14%">Junior</th>
                                                            <th class="column-6" width="6%">Senior</th>
                                                            <th class="column-8" width="5%">On</th>
                                                            <th class="column-9" width="5%"></th>
                                                            <th class="column-12" width="5%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                        <?php $sr=1; ?>
                                                
                                                        <?php if(isset($DDFDueDateForClientArr[$k_due_date])): ?>
                                                        
                                                            <?php $DDFDueDateForClientArray=$DDFDueDateForClientArr[$k_due_date]; ?>
                                                            
                                                            <?php if(!empty($DDFDueDateForClientArray)): ?>
                                                                <?php foreach($DDFDueDateForClientArray AS $e_inc_row): ?>
                                                                
                                                                    <?php $hasData=true; ?>
                                                                    
                                                                    <?php 
                                                                        $workId = $e_inc_row['workId'];
                                                                        $billId = $e_inc_row['billId'];

                                                                        $eFillingDate="-";
                                                                        if(check_valid_date($e_inc_row['eFillingDate']))
                                                                            $eFillingDate=date('d-m-Y', strtotime($e_inc_row['eFillingDate'])); 

                                                                        if(!empty($e_inc_row['workTotalCost']))
                                                                            $workTotalCost = $e_inc_row['workTotalCost']; 
                                                                        else
                                                                            $workTotalCost = 0;

                                                                        if(!empty($e_inc_row['billType']))
                                                                            $billType = $e_inc_row['billType']; 
                                                                        else
                                                                            $billType = 0;
                                                                    ?>
                                                                
                                                                    <tr class="row-1 tbl_row_clr <?php if(!empty($billType)): ?>billTypeUpdated<?php endif; ?>" >
                                                                        <td class="column-1" width="1%" nowrap>
                                                                            <?= $sr; ?>
                                                                        </td>
                                                                        <td class="column-2" width="5%" nowrap>
                                                                            <?= $e_inc_row['client_group_number']; ?>
                                                                        </td>
                                                                        <td class="column-3" width="20%" nowrap>
                                                                            <?php
                                                                                $cliOrgNameVar = (!empty($e_inc_row['clientBussOrganisation'])) ? $e_inc_row['clientBussOrganisation'] : "";
                                                                            ?>
                                                                            <?= display_client_name($e_inc_row['orgType'], $e_inc_row['clientName'], $cliOrgNameVar); ?>
                                                                        </td>
                                                                        <td class="column-4 text-center" width="10%" nowrap>
                                                                            <?= $e_inc_row['client_org_short_name']; ?>
                                                                        </td>
                                                                        <td class="column-6 text-center" width="14%" nowrap>
                                                                            <?php if($e_inc_row['juniors']!=""): ?>
                                                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $e_inc_row['juniors']; ?>">
                                                                                    <?php 
                                                                                        if(strlen($e_inc_row['juniors'])>10)
                                                                                            echo substr_replace($e_inc_row['juniors'], "...", 10); 
                                                                                        else
                                                                                            echo $e_inc_row['juniors'];
                                                                                    ?>
                                                                                </a>
                                                                            <?php else: ?>
                                                                                -
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td class="column-7 text-center" width="6%" nowrap>
                                                                            <?= $e_inc_row['seniorName']; ?>
                                                                        </td>
                                                                        <td class="column-9 text-center" width="5%" nowrap>
                                                                            <?= $eFillingDate; ?>
                                                                        </td>
                                                                        <td class="column-10 text-center" width="5%" nowrap>
                                                                            <?= amount_format($workTotalCost); ?>
                                                                        </td>
                                                                        <td class="column-13 text-center" width="5%" nowrap>
                                                                            <div class="btn-group">
                                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                                    <?php if($billType != 1): ?>
                                                                                        <a class="dropdown-item" href="<?= base_url('create-single-ddf-billing/'.$workId); ?>" target="_blank">Create Bill</a>
                                                                                    <?php endif; ?>
                                                                                    <?php if($billType != 2): ?>
                                                                                        <a class="dropdown-item markAsRecurring" href="javascript:void(0);" data-work="<?= $workId; ?>">Mark as Recurring</a>
                                                                                    <?php endif; ?>
                                                                                    <?php if($billType != 3): ?>
                                                                                        <a class="dropdown-item markAsFree" href="javascript:void(0);" data-work="<?= $workId; ?>">Mark as Free</a>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $sr++; ?>
                                                                        
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <tr class="row-1 tbl_row_clr">
                                                                    <td colspan="9" class="column-1">
                                                                        No records found
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <tr class="row-1 tbl_row_clr">
                                                                <td colspan="9" class="column-1">
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
                                
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                            <?php if($hasData==false): ?>
                                <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label>Due Date For : N/A</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="state second_header_div">
                                                <div class="row">
                                                    <div class="col-md-4 text-center second_header">
                                                        Due Date : N/A
                                                    </div>
                                                    <div class="col-md-4 text-center second_header">
                                                        Periodicity : N/A
                                                    </div>
                                                    <div class="col-md-4 text-center second_header">
                                                        Period: N/A (AY : N/A)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                            <thead>
                                                <tr class="row-1">
                                                    <th class="column-1" width="1%">Sr</th>
                                                    <th class="column-2" width="5%">Group</th>
                                                    <th class="column-3" width="20%">Name of the</th>
                                                    <th class="column-3" width="10%">Tax</th>
                                                    <th class="column-5" colspan="2" width="20%">Alloted to</th>
                                                    <th class="column-6" width="5%">Completed</th>
                                                    <th class="column-7" width="5%">Cost</th>
                                                    <th class="column-11" width="5%">Action</th>
                                                </tr>
                                                <tr class="row-1">
                                                    <th class="column-1" width="1%">No</th>
                                                    <th class="column-2" width="5%">No</th>
                                                    <th class="column-3" width="20%">Client</th>
                                                    <th class="column-3" width="10%">Payer</th>
                                                    <th class="column-5" width="14%">Junior</th>
                                                    <th class="column-6" width="6%">Senior</th>
                                                    <th class="column-8" width="5%">On</th>
                                                    <th class="column-9" width="5%"></th>
                                                    <th class="column-12" width="5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="row-hover">
                                                <tr class="row-1 tbl_row_clr">
                                                    <td colspan="9" class="column-1">
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
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    <!-- /.col -->
	</div>
</section>
<!-- /.content -->

<?php
    $client_arr=array();
    if(!empty($getClientList))
    {
        foreach($getClientList AS $k_c=>$e_c)
        {
            $clientNameVal = $e_c['clientName'];
            if(in_array($e_c['orgType'], INDIVIDUAL_ARRAY)){
                $clientNameVal = $e_c['clientName'];
            }else{
                $clientNameVal=$e_c['clientBussOrganisation']; 
            }
            $clName = str_replace("'", "", $clientNameVal);
            $client_arr[$k_c]['clientId']=$e_c['clientId'];
            $client_arr[$k_c]['clientName']=$clName;
            $client_arr[$k_c]['clientGroup']=$e_c['clientGroup'];
        }
    }
?>

<script>
    
    $(document).ready(function(){

        let actId = "<?= $actId; ?>";

        $('#ftr_clientgrp').on('change', function(){
            
            var ftr_clientgrp = $(this).val();
            var client_arr = '<?php echo json_encode($client_arr); ?>';
            var selected=null;
            var selClient="<?php echo $ftr_client; ?>";
            
            $('#ftr_client').html("");
            $('#ftr_client').html("<option value=''>All</option>");
            
            var clientArr=jQuery.parseJSON(client_arr);
            
            $.each(clientArr, function( index, value ) {
            
                var clientId=value['clientId'];
                var clientName=value['clientName'];
                var clientGroup=value['clientGroup'];
                
                if(clientGroup==ftr_clientgrp)
                {
                    if(clientId==selClient)
                        selected="selected";
                    else
                        selected="";
                    
                    $('#ftr_client').append("<option value='"+clientId+"' "+selected+" >"+clientName+"</option>");
                }
            
            }); 
            
        })
        
        $('#ftr_clientgrp').trigger('change');
        
        // $('#due_act_sel').on('change', function(){
            
        //     var base_url="<?php //echo base_url(); ?>";
            
        //     var due_act_sel = $(this).val();
            
        //     window.location.href=base_url+"/billing?actId="+due_act_sel;
        // }); 

        $('.markAsFree').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var workId = $(this).data('work');
            var billType = 3;

            swal({
                title: "Are you sure?",
                text: "Do you really want to mark as free ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, mark it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/update-bill-type';
                    $.post(postingUrl, 
                    {
                        workId: workId,
                        billType: billType,
                    },
                    function(data, status){
                        window.location.href=base_url+"/recurring-bills";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        $('.markAsRecurring').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var workId = $(this).data('work');
            var billType = 2;

            swal({
                title: "Are you sure?",
                text: "Do you really want to mark as recurring ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, mark it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/update-bill-type';
                    $.post(postingUrl, 
                    {
                        workId: workId,
                        billType: billType,
                    },
                    function(data, status){
                        window.location.href=base_url+"/recurring-bills";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
    });
    
</script>

<?= $this->endSection(); ?>