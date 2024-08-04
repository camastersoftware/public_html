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

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?php echo $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('client-administration'); ?>">
                            <button type="button" class="btn btn-sm btn-dark" >Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th width="5%">Group&nbsp;No</th>
                                    <th width="20%">Client&nbsp;Name</th>
                                    <th>Status</th>
                                    <th>DOB/DOI</th>
                                    <th>PAN</th>
                                    <th width="5%">DIN</th>
                                    <th width="5%">Aadhar</th>
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
                                            <td width="20%" nowrap>
                                                <?php
                                                    if(in_array($e_row['orgType'], INDIVIDUAL_ARRAY))
                                                        $clientNameVar=$e_row['clientName'];
                                                    else
                                                        $clientNameVar=$e_row['clientBussOrganisation']; 
                                                ?>
                                                <a href="<?php echo base_url('client/edit_client/'.$e_row['clientId'].'?backTo=oldmaster'); ?>" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
                                                    <?php 
                                                        if(strlen($clientNameVar)>24)
                                                        {
                                                            echo substr($clientNameVar, 0, 24)."..";
                                                        }
                                                        else
                                                        {
                                                            echo $clientNameVar;
                                                        }
                                                    ?>
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
                                            <td class="text-center" width="5%">
                                                <?php 
                                                    $clientDinNoVal="N/A";
                                                    if(isset($clientDocArr[$e_row['clientId']][4]))
                                                    {
                                                        $clientDinNo=$clientDocArr[$e_row['clientId']][4];
                                                        if(!empty($clientDinNo))
                                                        {
                                                            $clientDinNoVal=$clientDinNo;
                                                        }
                                                    }
                                                ?>
                                                <?= $clientDinNoVal; ?>
                                            </td>
                                            <td class="text-center" width="5%">
                                                <?php 
                                                    $clientAadharNoVal="N/A";
                                                    if(isset($clientDocArr[$e_row['clientId']][3]))
                                                    {
                                                        $clientAadharNo=$clientDocArr[$e_row['clientId']][3];
                                                        if(!empty($clientAadharNo))
                                                        {
                                                            $clientAadharNoVal=$clientAadharNo;
                                                        }
                                                    }
                                                ?>
                                                <?= $clientAadharNoVal; ?>
                                            </td>
                                            <td class="text-center" width="5%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="<?php echo base_url('client/view_client/'.$e_row['clientId'].'?backTo=oldmaster'); ?>" ><i class="fa fa-file"></i>&nbsp;View Documents</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#clientLeftReasonModal<?= $e_row['clientId']; ?>" data-toggle="tooltip" data-original-title="Show Reason" data-rowId="<?php echo $e_row['clientId']; ?>"><i class="fa fa-info"></i>&nbsp;Show Reason</a>
                                                        <a class="dropdown-item restoreClient" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Restore Client" data-rowId="<?php echo $e_row['clientId']; ?>"><i class="fa fa-rotate-left"></i>&nbsp;Restore</a>
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

<?php if(!empty($getClientList)): ?>
    <?php foreach($getClientList AS $e_row): ?>
    <div id="clientLeftReasonModal<?= $e_row['clientId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Reason for Leaving</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <span><?= (!empty($e_row['clientLeftReason'])) ? $e_row['clientLeftReason'] : "N/A"; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <?php endforeach; ?>
<?php endif; ?>

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
                                swal("Deleted", resMsg, "success");

                                $('#client_id_tr_'+clientId).remove();
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
        
        $('.restoreClient').on('click', function(e){

            e.preventDefault();

            var clientId = $(this).data('rowid');

            swal({
                title: "Are you sure?",
                text: "Do you really want to restore this client ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Restore it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/restoreClient',
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
                                swal("Restored", resMsg, "success");

                                $('#client_id_tr_'+clientId).remove();
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

    });

</script>


<?= $this->endSection(); ?>