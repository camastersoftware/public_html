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
                        <a href="<?php echo base_url('master_data'); ?>">
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
                                    <th width="15%">Client&nbsp;Name</th>
                                    <th>DIN</th>
                                    <th>Alloted&nbsp;To</th>
                                    <th>Updated&nbsp;On</th>
                                    <th>SRN&nbsp;No</th>
                                    <th>Approved&nbsp;On</th>
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
                                            <td width="15%" nowrap>
                                                <?php $cliOrgNameVar = (!empty($e_row['clientBussOrganisation'])) ? $e_row['clientBussOrganisation'] : ""; ?>
                                                <a href="<?php echo base_url('client/edit_client/'.$e_row['clientId']); ?>" >
                                                    <?= display_client_name($e_row['orgType'], $e_row['clientName'], $cliOrgNameVar); ?>
                                                </a>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <a href="<?php echo base_url('client/edit_client/'.$e_row['clientId']); ?>" >
                                                    <?php 
                                                        if(!empty($e_row['client_document_number']))
                                                            echo $e_row['client_document_number'];
                                                        else 
                                                            echo "-"; 
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['userShortName']))
                                                        echo $e_row['userShortName'];
                                                    else 
                                                        echo "-"; 
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(check_valid_date($e_row['dirKycUpdatedOn']))
                                                        echo date("d-m-Y", strtotime($e_row['dirKycUpdatedOn']));
                                                    else 
                                                        echo "-"; 
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['dirKycSrnNo']))
                                                        echo $e_row['dirKycSrnNo'];
                                                    else 
                                                        echo "-"; 
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(check_valid_date($e_row['dirKycApprovedOn']))
                                                        echo date("d-m-Y", strtotime($e_row['dirKycApprovedOn']));
                                                    else 
                                                        echo "-"; 
                                                ?>
                                            </td>
                                            <td class="text-center" width="5%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateModal<?php echo $e_row['clientId']; ?>">Edit</a>
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
    <!-- Modal -->
    <div id="updateModal<?php echo $e_row['clientId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo base_url('update-client-dir-three-kyc'); ?>" method="POST" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Alloted To</label>
                                    <select class="custom-select form-control" name="dirKycAllotedTo" id="dirKycAllotedTo" >
                                        <option value="">Select Alloted To</option>
                                        <?php if(!empty($getUserList)): ?>
                                            <?php foreach($getUserList AS $e_user): ?>
                                                <?php 
                                                    $selAllotedTo="";
                                                    if($e_row['dirKycAllotedTo']==$e_user['userId'])
                                                        $selJunior="selected";
                                                ?>
                                                <option value="<?php echo $e_user['userId']; ?>" <?php echo $selAllotedTo; ?> ><?php echo $e_user['userFullName']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Updated On</label>
                                    <input type="date" class="form-control" name="dirKycUpdatedOn" id="dirKycUpdatedOn" value="<?= (check_valid_date($e_row['dirKycUpdatedOn'])) ? date("Y-m-d", strtotime($e_row['dirKycUpdatedOn'])) : ""; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>SRN No</label>
                                    <input type="text" class="form-control" name="dirKycSrnNo" id="dirKycSrnNo" value="<?= $e_row['dirKycSrnNo']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Approved On</label>
                                    <input type="date" class="form-control" name="dirKycApprovedOn" id="dirKycApprovedOn" value="<?= (check_valid_date($e_row['dirKycApprovedOn'])) ? date("Y-m-d", strtotime($e_row['dirKycApprovedOn'])) : ""; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="clientId" id="clientId" value="<?= $e_row['clientId']; ?>">
                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
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