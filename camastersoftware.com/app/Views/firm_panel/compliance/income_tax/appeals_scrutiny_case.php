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
        font-size: 13px;
    }
    
    .tablepress tbody {
        font-size: 13px;
    }
    
    td.column-1 {
    /*text-align: center;*/
    /*font-weight: bold;*/
    font-size: 13px;
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
<section class="content mt-40">
    <div class="row">

        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title">Scrutiny Case for <?php echo $workDataArr['clientName']; ?> for Assessment <?php echo $workDataArr['finYear']; ?></h4>
                    <a href="<?php echo base_url('income_tax/appeals_scrutiny/'.$workDataArr['levelNo']); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-dark" style="">Back</button>
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body wizard-content">
                    <form action="" class="tab-wizard wizard-circle scrutiny_form">
                        <!-- Step 1 -->
                        <h6>Detail Of Officer</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Name">Name of the assessing Officer :</label>
                                                <input class="form-control" type="text" name="assessingOfficer" value="<?php echo $workDataArr['assessingOfficer']; ?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Name">Name of the Inspector :</label>
                                                    <input class="form-control" name="inspectorName" type="text" value="<?php echo $workDataArr['inspectorName']; ?>" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Name">Name of the Tax Assistant :</label>
                                                    <input class="form-control" name="taxAssistantName" type="text" value="<?php echo $workDataArr['taxAssistantName']; ?>" id="example-text-input">
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Name">Contact No :</label>
                                                    <input class="form-control" type="text" name="assessingOfficerContact" value="<?php echo $workDataArr['assessingOfficerContact']; ?>" id="example-text-input" >
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Name">Contact No :</label>
                                                    <input class="form-control" type="text" name="inspectorContact" value="<?php echo $workDataArr['inspectorContact']; ?>" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Name">Contact No :</label>
                                                    <input class="form-control" name="taxAssistantContact" type="text" value="<?php echo $workDataArr['taxAssistantContact']; ?>" id="example-text-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Name">Ward No:</label>
                                                    <input class="form-control" name="wardNo" type="text" value="<?php echo $workDataArr['wardNo']; ?>" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Name">Place No:</label>
                                                    <input class="form-control" name="placeNo" type="text" value="<?php echo $workDataArr['placeNo']; ?>" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="noticeUs">Notice U/S:</label>
                                                <select class="form-control" id="noticeUs" name="noticeUs">
                                                    <option value="" >Select</option>
                                                    <option value="143(2)" <?php if($workDataArr['noticeUs']=="143(2)"): ?>selected<?php endif; ?> >143(2)</option>
                                                    <option value="142(1)" <?php if($workDataArr['noticeUs']=="142(1)"): ?>selected<?php endif; ?>>142(1)</option>
                                                    <option value="148" <?php if($workDataArr['noticeUs']=="148"): ?>selected<?php endif; ?>>148</option>
                                                    <option value="246A" <?php if($workDataArr['noticeUs']=="246A"): ?>selected<?php endif; ?>>246A</option>
                                                    <option value="271(1)(C)" <?php if($workDataArr['noticeUs']=="271(1)(C)"): ?>selected<?php endif; ?>>271(1)(C)</option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h6> Detail Of Order</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php
                                                    $orderDate="";
                                                    if(!empty($workDataArr['orderDate']) && $workDataArr['orderDate']!="0000-00-00" && $workDataArr['orderDate']!="1970-01-01")
                                                        $orderDate=date('Y-m-d', strtotime($workDataArr['orderDate']));
                                                ?>
                                                <label for="date1">Date Of The Order:</label>
                                                <input class="form-control" name="orderDate" type="date" value="<?php echo $orderDate; ?>" id="example-date-input">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Name">Whether Acceptable :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" name="isAccepted" id="isUrgentWorkYes" class="radio-col-primary" value="1" <?php if($workDataArr['isAccepted']=="1"): ?>checked<?php endif; ?> />
                                                <label for="isUrgentWorkYes">Yes</label>
                                                <input type="radio" name="isAccepted" id="isUrgentWorkNo" class="radio-col-success" value="2" <?php if($workDataArr['isAccepted']=="2"): ?>checked<?php endif; ?> />
                                                <label for="isUrgentWorkNo">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php
                                                    $filingAppealDate="";
                                                    if(!empty($workDataArr['filingAppealDate']) && $workDataArr['filingAppealDate']!="0000-00-00" && $workDataArr['filingAppealDate']!="1970-01-01")
                                                        $filingAppealDate=date('Y-m-d', strtotime($workDataArr['filingAppealDate']));
                                                ?>
                                                <label for="date1">Date of Filing Appeal:</label>
                                                <input type="date" class="form-control" name="filingAppealDate" id="" value="<?php echo $filingAppealDate; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="amount">Amount Paid:</label>
                                                <input type="text" class="form-control" name="amountPaid" id="<?php echo $workDataArr['amountPaid']; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="date1">Remarks:</label>
                                                <input type="text" class="form-control" name="scRemarks" id="<?php echo $workDataArr['scRemarks']; ?>"> 
                                            </div>
                                        </div>
                                            
                                    </div> 
                                </div>
                                <div class="col-md-6 mt-30">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Name">Additional Demand Raised:</label>
                                                <input class="form-control" type="text" name="addtnlDemandRaised" value="<?php echo $workDataArr['addtnlDemandRaised']; ?>" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-8" >
                                            <div class="form-group">
                                                <?php
                                                    $filingRectDate="";
                                                    if(!empty($workDataArr['filingRectDate']) && $workDataArr['filingRectDate']!="0000-00-00" && $workDataArr['filingRectDate']!="1970-01-01")
                                                        $filingRectDate=date('Y-m-d', strtotime($workDataArr['filingRectDate']));
                                                ?>
                                                <label for="date1">Date of Filing Rectification:</label>
                                                <input type="date" class="form-control" name="filingRectDate" id="" value="<?php echo $filingRectDate; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php
                                                    $paymentDemandDate="";
                                                    if(!empty($workDataArr['paymentDemandDate']) && $workDataArr['paymentDemandDate']!="0000-00-00" && $workDataArr['paymentDemandDate']!="1970-01-01")
                                                        $paymentDemandDate=date('Y-m-d', strtotime($workDataArr['paymentDemandDate']));
                                                ?>
                                                <label for="date1">Date Of Payment Of Demand:</label>
                                                <input type="date" class="form-control" name="paymentDemandDate" id="" value="<?php echo $paymentDemandDate; ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php
                                                    $recptOrderDate="";
                                                    if(!empty($workDataArr['recptOrderDate']) && $workDataArr['recptOrderDate']!="0000-00-00" && $workDataArr['recptOrderDate']!="1970-01-01")
                                                        $recptOrderDate=date('Y-m-d', strtotime($workDataArr['recptOrderDate']));
                                                ?>
                                                <label for="date1">Date Of Receipt Of Order:</label>
                                                <input type="date" class="form-control" name="recptOrderDate" id="" value="<?php echo $recptOrderDate; ?>"> 
                                                <input type="hidden" name="workId" id="workId" value="<?php echo $workDataArr['workId']; ?>">
                                                <input type="hidden" name="leveId" id="leveId" value="<?php echo $workDataArr['leveId']; ?>">
                                                <input type="hidden" name="levelNo" id="levelNo" value="<?php echo $workDataArr['levelNo']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </section>
                        <!-- Step 3 -->
                        <h6>Detail Of Hearing</h6>
                        <section class="content">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Step wizard -->
                                    <div class="box box-default">
                                        <div class="text-right flex-grow">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#Modalheardingdate"><button class="btn btn-submit" data-toggle="tooltip" data-original-title="Add">&nbsp;Add New</button></a>
                                            </div>
                                        <div class="box-body">
                                            <!-- Tab panes -->
                                            <div class="tab-content tabcontent-border p-15" id="myTabContent">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="state due-month">
                                                            <label>Scrunity Cases Hearing Dates Already Entered</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                        <thead>
                                                            <tr class="row-1">
                                                                <th class="column-2">Sr .No</th>
                                                                <th class="column-3">Date Of Hearing</th>
                                                                <th class="column-4">Attended On</th>
                                                                <th class="column-5">Details Of Proceeding</th>
                                                                <th class="column-6">Attended By</th>
                                                                <th class="column-7">Next Date Of Hearing</th>
                                                                <th class="column-1">Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="row-hover">
                                                        <?php $i=1; ?>
                                                        <?php if(!empty($hearingArr)): ?>
                                                            <?php foreach($hearingArr AS $e_row): ?>
                                                                <tr class="row-1">
                                                                    <td class="column-2"><?php echo $i; ?></td>
                                                                    <td class="column-3">
                                                                        <?php
                                                                            $hearingDate="N/A";
                                                                            if(!empty($e_row['hearingDate']) && $e_row['hearingDate']!="0000-00-00" && $e_row['hearingDate']!="1970-01-01")
                                                                                $hearingDate=date('d-m-Y', strtotime($e_row['hearingDate']));

                                                                            echo $hearingDate;
                                                                        ?>
                                                                    </td>
                                                                    <td class="column-4">
                                                                        <?php
                                                                            $attendedDate="N/A";
                                                                            if(!empty($e_row['attendedDate']) && $e_row['attendedDate']!="0000-00-00" && $e_row['attendedDate']!="1970-01-01")
                                                                                $hearingDate=date('d-m-Y', strtotime($e_row['attendedDate']));

                                                                            echo $attendedDate;
                                                                        ?>
                                                                    </td>
                                                                    <td class="column-5"><?php echo $e_row['proceedingDetails']; ?></td>
                                                                    <td class="column-6"><?php echo $e_row['attendedBy']; ?></td>
                                                                    <td class="column-7">
                                                                        <?php
                                                                            $nextHearingDate="N/A";
                                                                            if(!empty($e_row['nextHearingDate']) && $e_row['nextHearingDate']!="0000-00-00" && $e_row['nextHearingDate']!="1970-01-01")
                                                                                $hearingDate=date('d-m-Y', strtotime($e_row['nextHearingDate']));

                                                                            echo $nextHearingDate;
                                                                        ?>
                                                                    </td>	
                                                                    <td class="column-1">
                                                                        <button type="button" class="waves-effect waves-light btn btn-danger delHearing" data-id="<?php echo $e_row['hearing_id']; ?>" style="">Delete</button>
                                                                    </td>
                                                                </tr>
                                                                <?php $i++; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    </table>
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


<!-- Modal -->
<div id="Modalheardingdate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" class="hearing_form" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Scrunity Case Hearing Dates For <?php echo $workDataArr['clientName']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Hearing Date : </label>
                                <input class="form-control" type="date" name="hearingDate" value="" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Attended Date : </label>
                                <input class="form-control" type="date" name="attendedDate" value="" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group ">
                                <label>Details Of Proceeding : </label>
                                <textarea rows="5" class="form-control" name="proceedingDetails" placeholder="" spellcheck="false"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group ">
                                <label>Attended By : </label>
                                <input class="form-control" type="text" name="attendedBy" value="" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Next Hearing Date : </label>
                                <input class="form-control" type="date" name="nextHearingDate" value="" >
                                <input type="hidden" name="hrWorkId" id="hrWorkId" value="<?php echo $workDataArr['workId']; ?>">
                                <input type="hidden" name="hrLeveId" id="hrLeveId" value="<?php echo $workDataArr['leveId']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="button" name="submit" class="btn btn-success text-left add_hearing">Submit</button>
                </div>
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

        $('body').on('submit', '.scrutiny_form', function(e){

            e.preventDefault();
            var workFormData = $('.scrutiny_form').serializeArray();

            var workId = $('#workId').val();
            var leveId = $('#leveId').val();
            var levelNo = $('#levelNo').val();
            // $('.work_data_form').submit();

            var indexed_array = {};

            $.map(workFormData, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            var postingUrl = base_url+'/income_tax/appeals_scrutiny_case/'+leveId;
            // var postingUrl = base_url+'/admin/scrutiny';
            var refreshUrl = base_url+'/income_tax/appeals_scrutiny/'+levelNo;

            $.post(postingUrl,indexed_array, function(data, status){
                window.location.href=refreshUrl;
            });

        });

        $('.add_hearing').on('click', function(e){

            e.preventDefault();
            var workFormData = $('.hearing_form').serializeArray();

            // $('.work_data_form').submit();

            var indexed_array = {};

            $.map(workFormData, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            var leveId = $('#leveId').val();

            var postingUrl = base_url+'/add_appeal_hearing';
            var refreshUrl = base_url+'/income_tax/appeals_scrutiny_case/'+leveId;

            $.post(postingUrl,indexed_array, function(data, status){
                window.location.href=refreshUrl;
            });

        });

        $('.delHearing').on('click', function(e){

            e.preventDefault();

            var hearing_id = $(this).data('id');
            var leveId = $('#leveId').val();

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this hearing ?",
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
                        url : base_url+'/delete_appeal_hearing_date',
                        type : 'POST',
                        data : {
                            'hearing_id':hearing_id,
                        },
                        dataType: 'text',
                        success : function(response) {
                            var refreshUrl = base_url+'/income_tax/appeals_scrutiny_case/'+leveId;
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