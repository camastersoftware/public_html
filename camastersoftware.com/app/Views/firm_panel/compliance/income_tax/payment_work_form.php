<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .theme-primary .wizard-content .wizard > .steps > ul > li.done {
            margin-top: 15px;
            width: 297px;
    }
            
    .tablepress tbody tr:first-child td {
        background: #fff;
        color: #303030;
    } 
    
    .tablepress tbody tr:nth-child(4) td.column-1 {
        background: #fff;
        color: #303030;
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
        font-weight: 400;
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
    
    .tablepress thead tr, .tablepress thead th {
        border: 1px solid #ddd;
        color: #fff;
        font-size: 16px !important;
    }
    
    .tablepress tbody {
        font-size: 16px !important;
    }
    
    td.column-1 {
        /*text-align: center;*/
        /*font-weight: bold;*/
        font-size: 16px !important;
    }
    
    .tabcontent-border {
        border: none;
        border-top: 0px;
    }
    
    tr.column-2{
        width:120px;
    }
    
    .due-month {
        background: #F99D27;
        padding: 7px 0;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    .modal-header {
        border-bottom-color: #d5dfea;
        background-color: #F99D27;
        padding: 8px 8px;
    }
</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">

        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                    <a href="<?php echo base_url('advance_tax'); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <section>
                        <form action="" class="work_data_form" method="post">
                            <div class="row">
                                <div class="col-md-6 d-flex mt-10 px-20">
                                    <h4 id="clientNameLabel" class="font-weight-bold">Client Name:</h4>
                                    &nbsp;&nbsp;
                                    <h4 class="clientNameLabelVal"><?php echo $workClientName; ?></h4>
                                </div>
                                <div class="col-md-6 mt-10 px-20">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="pmtJuniorId">Allocate To:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="pmtJuniorId" id="pmtJuniorId" >
                                                    <option value="">Select Staff</option>
                                                    <?php if(!empty($getUserList)): ?>
                                                        <?php foreach($getUserList AS $e_user): ?>
                                                            <?php
                                                                if($e_user['userId']==$workArr['pmtJuniorId'])
                                                                    $selected="selected";
                                                                else 
                                                                    $selected=""; 
                                                            ?>
                                                            <option value="<?php echo $e_user['userId']; ?>" <?php echo $selected; ?> ><?php echo $e_user['userFullName']; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="hidden" name="clientId" value="<?php echo $workArr['clientId']; ?>">
                                            <button type="submit" class="btn btn-sm btn-success custom_btn ml-20">Submit</button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </form>
                    </section>
                    <!-- Step 2 -->
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="mt-0">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-8 offset-md-2">
                                                <!-- Tab panes -->
                                                <div class="tab-content tabcontent-border" id="myTabContent">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="state due-month">
                                                                <label>Advance Tax Period</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                            <thead>
                                                                <tr class="row-1">
                                                                    <th class="column-1" style="width: 1% !important;">Sr.No</th>
                                                                    <th class="column-4">Period</th>
                                                                    <th class="column-6" style="width: 4% !important;">Amount</th>
                                                                    <th class="column-5">Due Date</th>
                                                                    <th class="column-7">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="row-hover">
                                                            <?php $i=1; ?>
                                                            <?php $pmtActive=FALSE; ?>
                                                            <?php if(!empty($workDataArr)): ?>
                                                                <?php foreach($workDataArr AS $e_row): ?>
                                                                    <?php if($e_row['amtPaid'] == 0): ?>
                                                                        <?php $pmtActive=TRUE; ?>
                                                                        <tr class="row-1">
                                                                            <td class="column-1" style="width: 1% !important;"><?php echo $i; ?></td>
                                                                            <td class="column-4" nowrap>
                                                                                <?php 
                                                                                    if($e_row['periodicity']=="1")
                                                                                    {
                                                                                        echo date("d-M-Y", strtotime($e_row["daily_date"]));
                                                                                    }
                                                                                    elseif($e_row['periodicity']=="2")
                                                                                    {
                                                                                        echo date("M", strtotime("2021-".$e_row["period_month"]."-01"))."-".$e_row["period_year"];
                                                                                    }
                                                                                    elseif($e_row['periodicity']>="3")
                                                                                    {
                                                                                        echo date("M", strtotime("2021-".$e_row["f_period_month"]."-01"))."-".$e_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_row["t_period_month"]."-01"))."-".$e_row["t_period_year"];
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo "N/A";
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                            <td class="column-5 text-right" style="width: 4% !important;">
                                                                                <?php echo amount_format($e_row['amtApproved']); ?>
                                                                            </td>
                                                                            <td class="column-5">
                                                                                <?php echo date('d-m-Y', strtotime($e_row['extended_date'])); ?>
                                                                            </td>
                                                                            <td class="column-6">
                                                                                <div class="btn-group">
                                                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle mt-0 mb-0" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                                                        <a class="dropdown-item payable_modal_btn" href="javascript:void(0);" data-id="<?php echo $e_row['workId']; ?>" data-amt_approved="<?php echo $e_row['amtApproved']; ?>" data-amt_approved_remark="<?php echo $e_row['amtApprovedRemark']; ?>" >Amount Payable</a>
                                                                                        <a class="dropdown-item pmt_modal_btn" href="javascript:void(0);" data-id="<?php echo $e_row['workId']; ?>">Amount Paid</a>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <?php $i++; ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                <?php if($pmtActive==FALSE): ?>
                                                                    <tr class="row-1">
                                                                        <td colspan="5">
                                                                            <center>
                                                                                No records found
                                                                            </center>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <tr class="row-1">
                                                                    <td colspan="5">
                                                                        <center>
                                                                            No records found
                                                                        </center>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>	
                    </section>
                    <!-- Step 3 -->
                    <section class="content">
                        <div class="row">
                            <div class="col-12">
                                <!-- Step wizard -->
                                <div class="box box-default">
                                    <div class="box-body p-0">
                                        <div class="row">
                                            <div class="col-md-8 offset-md-2">
                                                <!-- Tab panes -->
                                                <div class="tab-content tabcontent-border" id="myTabContent">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="state due-month">
                                                                <label>Advance Tax Already Entered</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                            <thead>
                                                                <tr class="row-1">
                                                                    <th class="column-1" style="width: 1% !important;">Sr.No</th>
                                                                    <th class="column-4">Period</th>
                                                                    <th class="column-5" style="width: 4% !important;">Amount</th>
                                                                    <th class="column-7">Paid Date</th>
                                                                    <th class="column-9">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="row-hover">
                                                            <?php $p=1; ?>
                                                            <?php if(!empty($workDataArr) && in_array(1, $pmtActiveArr)): ?>
                                                                <?php foreach($workDataArr AS $e_row): ?>
                                                                    <?php if($e_row['isPmtActive']==1 && $e_row['amtPaid'] > 0): ?>
                                                                    <tr class="row-1">	
                                                                        <td class="column-1" style="width: 1% !important;"><?php echo $p; ?></td>
                                                                        <td class="column-4" nowrap>
                                                                            <?php 
                                                                                if($e_row['periodicity']=="1")
                                                                                {
                                                                                    echo date("d-M-Y", strtotime($e_row["daily_date"]));
                                                                                }
                                                                                elseif($e_row['periodicity']=="2")
                                                                                {
                                                                                    echo date("M", strtotime("2021-".$e_row["period_month"]."-01"))."-".$e_row["period_year"];
                                                                                }
                                                                                elseif($e_row['periodicity']>="3")
                                                                                {
                                                                                    echo date("M", strtotime("2021-".$e_row["f_period_month"]."-01"))."-".$e_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_row["t_period_month"]."-01"))."-".$e_row["t_period_year"];
                                                                                }
                                                                                else
                                                                                {
                                                                                    echo "N/A";
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td class="column-5 text-right" style="width: 4% !important;">
                                                                            <?php echo amount_format($e_row['amtPaid']); ?>
                                                                        </td>
                                                                        <td class="column-7">
                                                                            <?php echo date('d-m-Y', strtotime($e_row['pmtDate'])); ?>
                                                                        </td>
                                                                        <td class="column-9">
                                                                            <div class="btn-group">
                                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle mt-0 mb-0" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editPaymentDataModal<?= $p; ?>" >Edit</a>
                                                                                    <a class="dropdown-item delPayment" href="javascript:void(0);" data-id="<?php echo $e_row['workId']; ?>">Delete</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $p++; ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <tr class="row-1">
                                                                    <td colspan="5">
                                                                        <center>
                                                                            No records found
                                                                        </center>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>	
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
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<?php $m=1; ?>
    <?php if(!empty($workDataArr) && in_array(1, $pmtActiveArr)): ?>
        <?php foreach($workDataArr AS $e_row): ?>
            <?php if($e_row['isPmtActive']==1 && $e_row['amtPaid'] > 0): ?>
            
            <div id="editPaymentDataModal<?= $m; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?= base_url('income_tax/update_payment'); ?>" method="POST" >
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Payment</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Amount Paid : </label>
                                            <input type="text" class="form-control" name="amtPaid" id="amtPaid" placeholder="Enter Amount Paid" onkeypress='validateNum(event)' value="<?= $e_row['amtPaid']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Payment Date : </label>
                                            <input type="date" class="form-control" name="pmtDate" id="pmtDate" value="<?php echo date('Y-m-d', strtotime($e_row['pmtDate'])); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group ">
                                            <label>Payment Type : </label>
                                            <select class="form-control" name="pmtType" id="pmtType" required>
                                                <option value="">Select Payment Type</option>
                                                <option value="1" <?php if($e_row['pmtType']==1): ?>selected<?php endif; ?>>Bank</option>
                                                <option value="2" <?php if($e_row['pmtType']==2): ?>selected<?php endif; ?>>Online</option>
                                                <option value="3" <?php if($e_row['pmtType']==3): ?>selected<?php endif; ?>>Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Remark : </label>
                                            <textarea rows="3" class="form-control" name="pmtRemark" id="pmtRemark" placeholder="Enter Remark" spellcheck="false" required><?= $e_row['pmtRemark']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-right" style="width: 100%;">
                                <input type="hidden" name="pmtWorkId" value="<?php echo $e_row['workId']; ?>">
                                <input type="hidden" name="pmtClientId" value="<?php echo $workArr['clientId']; ?>">
                                <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success text-left add_payment">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php $m++; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Modal -->
<div id="payable_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" class="new_payable_form" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Amount Payable : </label>
                                <input type="text" class="form-control" name="amtApproved" id="amtApproved" placeholder="Enter Amount Payable" onkeypress='validateNum(event)' required>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remark : </label>
                                <textarea rows="3" class="form-control" name="amtApprovedRemark" id="amtApprovedRemark" placeholder="Enter Remark" spellcheck="false" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center" style="width: 100%;">
                    <input type="hidden" name="pmtPayableWorkId" id="pmtPayableWorkId" value="">
                    <input type="hidden" name="pmtPayableClientId" id="pmtPayableClientId" value="<?php echo $workArr['clientId']; ?>">
                    <button type="button" class="btn btn-sm btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal -->
<div id="pmt_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" class="new_payment_form" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Amount Paid : </label>
                                <input type="text" class="form-control" name="amtPaid" id="amtPaid" placeholder="Enter Amount Paid" onkeypress='validateNum(event)' required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Payment Date : </label>
                                <input type="date" class="form-control" name="pmtDate" id="pmtDate" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group ">
                                <label>Payment Type : </label>
                                <select class="form-control" name="pmtType" id="pmtType" required>
                                    <option value="">Select Payment Type</option>
                                    <option value="1">Bank</option>
                                    <option value="2">Online</option>
                                    <option value="3">Cash</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remark : </label>
                                <textarea rows="3" class="form-control" name="pmtRemark" id="pmtRemark" placeholder="Enter Remark" spellcheck="false" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" name="pmtWorkId" id="pmtWorkId" value="">
                    <input type="hidden" name="pmtClientId" id="pmtClientId" value="<?php echo $workArr['clientId']; ?>">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success text-left add_payment">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
            
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";
        var clientId = "<?php echo $clientId; ?>";
        
        $('#doc_date').hide();
        
        $('.is_doc_rec').on('click', function(){
            
            var doc_rec = $(this).val();
            
            if(doc_rec=="yes")
                $('#doc_date').show();
            else if(doc_rec=="no")
                $('#doc_date').hide();
            
        });

        $('.wizard-content .wizard > .actions > ul').append('<li><button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button></li>');
        
        $('body').on('click', '.steps li', function(){
            
            if($(this).hasClass('last'))
            {
                $('.extra_sub_btn').hide();
            }
            else
            {
                $('.extra_sub_btn').show();
            }
            
        });
        
        $('.steps ul li:not(:first)').removeClass('disabled');
        $('.steps ul li:not(:first)').addClass('done');
        
        // $('.wizard-content .wizard > .actions').hide();
        $('.wizard-content .wizard > .actions > ul').css('margin-right', '40%');

        $('input[name="pmtApproved"]').on('click', function(){

            var pmtApproved = $(this).val();

            var pmtAmountSuggested = $('#pmtAmountSuggested').val();

            if(pmtApproved==1)
            {
                $('#pmtNewAmt').val(pmtAmountSuggested);
            }
            else
            {
                $('#pmtNewAmt').val(0);
            }
        });
        
        $('body').on('submit', '.work_data_form', function(e){

            e.preventDefault();
            var workFormData = $('.work_data_form').serializeArray();

            // $('.work_data_form').submit();

            var indexed_array = {};

            $.map(workFormData, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            var postingUrl = base_url+'/income_tax/payment_work_form/'+clientId;

            $.post(postingUrl,indexed_array, function(data, status){
                window.location.href=postingUrl;
            });

        });

        $('.payable_modal_btn').on('click', function(){

            $('#pmtPayableWorkId').val("");

            var pmtPayableWorkId = $(this).data('id');
            var pmtAmtApproved = $(this).data('amt_approved');
            var pmtAmtApprovedRemark = $(this).data('amt_approved_remark');

            $('#pmtPayableWorkId').val(pmtPayableWorkId);
            $('#amtApproved').val(pmtAmtApproved);
            $('#amtApprovedRemark').val(pmtAmtApprovedRemark);

            $('#payable_modal').modal('show');

        });
        
        $('.pmt_modal_btn').on('click', function(){

            $('#pmtWorkId').val("");

            var pmtWorkId = $(this).data('id');

            $('#pmtWorkId').val(pmtWorkId);

            $('#pmt_modal').modal('show');

        });

        // $('.add_payment').on('click', function(e){
        
        $('body').on('submit', '.new_payable_form', function(e){

            // alert('dsd');

            e.preventDefault();
            // return false;
            var pmtFormData = $('.new_payable_form').serializeArray();

            // $('.work_data_form').submit();

            var indexed_array1 = {};

            $.map(pmtFormData, function(n, i){
                indexed_array1[n['name']] = n['value'];
            });

            var postingUrl = base_url+'/income_tax/add_payable_amt';
            var refreshUrl = base_url+'/income_tax/payment_work_form/'+clientId;

            $.post(postingUrl,indexed_array1, function(data, status){
                window.location.href=refreshUrl;
            });

        });

        $('body').on('submit', '.new_payment_form', function(e){

            // alert('dsd');

            e.preventDefault();
            // return false;
            var pmtFormData = $('.new_payment_form').serializeArray();

            // $('.work_data_form').submit();

            var indexed_array1 = {};

            $.map(pmtFormData, function(n, i){
                indexed_array1[n['name']] = n['value'];
            });

            var postingUrl = base_url+'/income_tax/add_payment';
            var refreshUrl = base_url+'/income_tax/payment_work_form/'+clientId;

            $.post(postingUrl,indexed_array1, function(data, status){
                window.location.href=refreshUrl;
            });

        });

        $('.delPayment').on('click', function(e){

            e.preventDefault();

            var workId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this payment ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/income_tax/delete_payment',
                        type : 'POST',
                        data : {
                            'workId':workId,
                            'clientId':clientId
                        },
                        dataType: 'text',
                        success : function(response) {
                            var refreshUrl = base_url+'/income_tax/payment_work_form/'+clientId;
                            window.location.href=refreshUrl;
                        },
                        error : function(request, error)
                        {
                            // alert("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

    });

</script>

<?= $this->endSection(); ?>