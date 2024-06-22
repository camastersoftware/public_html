<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
    .modal-header {
        border-bottom-color: #d5dfea;
        background-color:#F99D27;
        padding: 8px 8px;
    }

    .income-tax-head {
        background: #ffc800;
        padding:10px;
        margin-bottom:0px;
        font-weight:bold;
    }

    table.dataTable {
        margin-top: 0px !important; 
    }

    .tablepress td, .tablepress th {
        font-weight: 600;
    }

    td.column-1 {
        font-size:14px;
    }

    .tablepress tbody tr:first-child td {
        background: #ffffff;
    }

    .modal-header h4{
        text-align: center;
    }

    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
    }
    
    .getActModal .box{
        cursor: pointer !important;
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
    
    .box_body_bg {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        /*border-radius: 10px;*/
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        /*margin-top: 20px !important;*/
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
    
    .tablepress td {
        font-weight: 400 !important;
    }
    
    .tablepress thead th {
        background-color: #005495 !important;
    }
    
    .demo-checkbox .box-header {
        background-color: #005495 !important;
        border-radius: 10px !important;
    }
    
    .demo-checkbox .box-header.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
    }
    
</style>

<!-- Main content -->
<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        Client List
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?= base_url('create-client'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Create New Client</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th width="5%">Grp&nbsp;No</th>
                                    <th width="5%">Group&nbsp;Name</th>
                                    <th width="20%">Client&nbsp;Name</th>
                                    <th>Status</th>
                                    <th>DOB/DOI</th>
                                    <th>PAN</th>
                                    <!--<th width="5%">Cost&nbsp;Center</th>-->
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php $currGrp=""; ?>
                                <?php $prevGrp=""; ?>
                                <?php $clrCnt=1; ?>
                                <?php if(!empty($getClientList)): ?>
                                    <?php foreach($getClientList AS $e_row): ?>
                                        <?php $client_group_num=$e_row['client_group_number']; ?>
                                        <?php $currGrp=$client_group_num; ?>
                                        
                                        <?php
                                            if($currGrp!=$prevGrp)
                                                $clrCnt++;
                                            
                                            $clrSeq=($clrCnt%2);
                                            
                                            if($clrSeq==0)
                                                $grpClr="#005495";
                                            else
                                                $grpClr="#f48b04";
                                        ?>
                                        
                                        <tr id="client_id_tr_<?php echo $e_row['clientId']; ?>">
                                            <td class="text-center" width="5%"><?php echo $i; ?></td>
                                            <td class="text-center" width="5%" >
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $e_row['client_group']; ?>" style="color: <?= $grpClr; ?> !important;">
                                                    <?php
                                                        if(!empty($client_group_num))
                                                            echo $client_group_num;
                                                        else 
                                                            echo " "; 
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="text-center" width="5%" nowrap><?= ($currGrp!=$prevGrp) ? $e_row['client_group'] : '--"--'; ?></td>
                                            <td width="20%" nowrap>
                                                <?php
                                                    $cliOrgNameVar = (!empty($e_row['clientBussOrganisation'])) ? $e_row['clientBussOrganisation'] : "";
                                                    
                                                    if($e_row['orgType']==8)
                                                        $cliNameVar = $e_row['clientName'].$cliOrgNameVar;
                                                    elseif($e_row['orgType']==9 || $e_row['orgType']==22 || $e_row['orgType']==23)
                                                        $cliNameVar = $e_row['clientName'];
                                                    else
                                                        $cliNameVar = $e_row['clientBussOrganisation']; 
                                                ?>
                                                <a href="<?php echo base_url('client/edit_client/'.$e_row['clientId']); ?>" >
                                                    <?= display_client_name($e_row['orgType'], $e_row['clientName'], $cliOrgNameVar); ?>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <span data-toggle="tooltip" data-original-title="<?= $e_row['organisation_type_name']; ?>" style="cursor: pointer;">
                                                    <?php 
                                                        if(!empty($e_row['shortName']))
                                                            echo $e_row['shortName'];
                                                        else 
                                                            echo " "; 
                                                    ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(in_array($e_row['orgType'], INDIVIDUAL_ARRAY))
                                                    {
                                                        if(!empty($e_row['clientDob']) && $e_row['clientDob']!="0000-00-00")
                                                            echo date("d-m-Y", strtotime($e_row['clientDob']));
                                                        else 
                                                            echo " "; 
                                                    }
                                                    else
                                                    {
                                                        if(!empty($e_row['clientBussIncorporationDate']) && $e_row['clientBussIncorporationDate']!="0000-00-00")
                                                            echo date("d-m-Y", strtotime($e_row['clientBussIncorporationDate']));
                                                        else 
                                                            echo " "; 
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['clientPanNumber']))
                                                        echo $e_row['clientPanNumber'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <!--<td class="text-center" width="5%"><?php //echo $e_row['userShortName']; ?></td>-->
                                            <td class="text-center" width="5%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="<?php echo base_url('client/edit_client/'.$e_row['clientId']); ?>" ><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                                        <a class="dropdown-item" href="<?php echo base_url('client/view_client/'.$e_row['clientId']); ?>" ><i class="fa fa-file"></i>&nbsp;View Documents</a>
                                                        <a class="dropdown-item markAsOld" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Mark As Left" data-rowId="<?php echo $e_row['clientId']; ?>"><i class="fa fa-ban"></i>&nbsp;Mark As Left</a>
                                                        <a class="dropdown-item delClient" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Delete" data-rowId="<?php echo $e_row['clientId']; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                        <?php $prevGrp=$client_group_num; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="clientLeftReasonModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="clientLeftForm">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Enter Reason for Leaving</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Enter Reason<small class="text-danger">*</small></label>
                                <textarea class="form-control" name="clientLeftReason" id="clientLeftReason" placeholder="Enter Reason" rows="3" required></textarea> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <input type="hidden" id="left_client_id" value="" />
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="button" class="btn btn-success text-left">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


<script type="text/javascript">
            
    $(document).ready(function(){
        
        var base_url = "<?php echo base_url(); ?>";
        
        $('.delClient').on('click', function(e){

            e.preventDefault();

            var clientId = $(this).data('rowid');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this client ?",
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
                        url : base_url+'/delete_client',
                        type : 'POST',
                        data : {
                            'clientId':clientId,
                            "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                        },
                        dataType: 'json',
                        success : function(response) {

                            var resStatus = response['status'];
                            var resMsg = response['message'];
                            var resUserData = response['userdata'];

                            if(resStatus==true)
                            {
                                $('#client_id_tr_'+clientId).remove();
                                // swal("Deleted", resMsg, "success");

                                swal({
                                    title: "Deleted", 
                                    text: resMsg, 
                                    type: "success"},
                                    function(){
                                        location.reload();
                                });
                            }
                            else
                            {
                                swal("Error!", resMsg, "error");
                            }

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
        
        $('.markAsOld').on('click', function(e){

            e.preventDefault();
            
            $("#left_client_id").val("");
            $("#clientLeftReason").val("");

            var clientId = $(this).data('rowid');

            swal({
                title: "Are you sure?",
                text: "Do you really want to mark this client as left ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Mark it as left!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    
                    $("#left_client_id").val(clientId);
                    $('#clientLeftReasonModal').modal('show');
                    
                    swal.close();

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        $('#clientLeftForm').on('submit', function(e){

            e.preventDefault();

            var clientId = $("#left_client_id").val();
            var clientLeftReason = $("#clientLeftReason").val();

            $.ajax({
                url : base_url+'/mark_old_client',
                type : 'POST',
                data : {
                    'clientId':clientId,
                    'clientLeftReason':clientLeftReason,
                    "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                },
                dataType: 'json',
                success : function(response) {

                    var resStatus = response['status'];
                    var resMsg = response['message'];
                    var resUserData = response['userdata'];

                    if(resStatus==true)
                    {
                        swal("Marked has left", resMsg, "success");
                        
                        $('#client_id_tr_'+clientId).remove();
                    }
                    else
                    {
                        swal("Error!", resMsg, "error");
                    }
                    
                    $('#clientLeftReasonModal').modal('hide');

                },
                error : function(request, error)
                {
                    // alert("Request: "+JSON.stringify(request));
                }
            });

        });


    });

</script>


<?= $this->endSection(); ?>