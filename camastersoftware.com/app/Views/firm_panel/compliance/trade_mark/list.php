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
        font-size: 15px !important;
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
    
    .dataTables_wrapper .form-control{
        margin: 0px !important;
    }
    
    .discontinueClass td {
      color: #9d9c97 !important;
    }
    
    .divLine td {
        background-color: #005495 !important;
        height: 5px !important;
    }
    
</style>

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?= $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#addClientModal">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Add Client</button>
                        </a>
                        &nbsp;&nbsp;
                        <a href="<?php echo base_url('oth_act_menus'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th width="5%">GN</th>
                                    <th width="20%">Client&nbsp;Name</th>
                                    <th>Trade&nbsp;Mark</th>
                                    <th width="5%">Class</th>
                                    <th width="5%">Appln&nbsp;No.</th>
                                    <th width="5%">Appln&nbsp;Date</th>
                                    <th width="5%">Appvd&nbsp;On</th>
                                    <th width="5%">Adv&nbsp;On</th>
                                    <th width="5%">Regd&nbsp;On</th>
                                    <th width="5%">Valid&nbsp;Upto</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php $currGrp=""; ?>
                                <?php $prevGrp=""; ?>
                                <?php $clrCnt=1; ?>
                                <?php if(!empty($getClientList)): ?>
                                    <?php foreach($getClientList AS $k_row => $e_row): ?>
                                        <?php $client_group_num=$e_row['client_group_number']; ?>
                                        <?php $currGrp=$client_group_num; ?>
                                        
                                        <?php
                                        
                                            if(!empty($e_row['tmValidUpto']) && $e_row['tmValidUpto']!="0000-00-00")
                                                $tmValidUpto=date("Y-m-d", strtotime($e_row['tmValidUpto']));
                                            else 
                                                $tmValidUpto="";
                                                
                                            $tmExpired=false;
                                            
                                            if(!empty($tmValidUpto)){
                                                $oneMonthAgoDate = date('Y-m-d', strtotime($tmValidUpto.' -6 month'));
                                                if($oneMonthAgoDate <= $currentDate){
                                                    $tmExpired=true;
                                                }
                                            }
                                        
                                        ?>
                                        
                                        <?php if($tmExpired && $e_row['isDiscontinued']==2 && $e_row['isReject']!=1): ?>
                                        
                                        <?php
                                            if($currGrp!=$prevGrp)
                                                $clrCnt++;
                                            
                                            $clrSeq=($clrCnt%2);
                                            
                                            if($clrSeq==0)
                                                $grpClr="#005495";
                                            else
                                                $grpClr="#f48b04";
                                        ?>
                                        
                                        <tr id="client_id_tr_<?php echo $e_row['clientId']; ?>" <?php if($tmExpired): ?> style="background: #FFCCCB !important;" <?php endif; ?>>
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
                                                    $cliOrgNameVar = (!empty($e_row['clientBussOrganisation'])) ? " (".$e_row['clientBussOrganisation'].")" : "";
                                                
                                                    if($e_row['orgType']==8)
                                                        $clientNameVar = $e_row['clientName'].$cliOrgNameVar;
                                                    elseif($e_row['orgType']==9 || $e_row['orgType']==22 || $e_row['orgType']==23)
                                                        $clientNameVar = $e_row['clientName'];
                                                    else
                                                        $clientNameVar = $e_row['clientBussOrganisation']; 
                                                ?>
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
                                                    <?php
                                                        if(strlen($clientNameVar)>17)
                                                        {
                                                            echo substr($clientNameVar, 0, 17)."..";
                                                        }
                                                        else
                                                        {
                                                            echo $clientNameVar;
                                                        }
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                    if(!empty($e_row['tradeMark']))
                                                        echo $e_row['tradeMark'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['tmClass']))
                                                        echo $e_row['tmClass'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['tmNo']))
                                                        echo $e_row['tmNo'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmDate']))
                                                        echo date("d-m-Y", strtotime($e_row['tmDate']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmApprovedOn']))
                                                        echo date("d-m-Y", strtotime($e_row['tmApprovedOn']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmAdvertisedOn']))
                                                        echo date("d-m-Y", strtotime($e_row['tmAdvertisedOn']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmRegisteredOn']))
                                                        echo date("d-m-Y", strtotime($e_row['tmRegisteredOn']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($tmValidUpto))
                                                        echo date("d-m-Y", strtotime($tmValidUpto));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td width="5%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editClientModal<?php echo $k_row; ?>">View/Edit</a>
                                                        <a class="dropdown-item discontinueTm" href="javascript:void(0);" data-id="<?= $e_row['tmId']; ?>">Discontinue Renewal</a>
                                                        <a class="dropdown-item rejectTm" href="javascript:void(0);" data-id="<?= $e_row['tmId']; ?>">Reject</a>
                                                        <a class="dropdown-item deleteTm" href="javascript:void(0);" data-id="<?= $e_row['tmId']; ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php $i++; ?>
                                        <?php $prevGrp=$client_group_num; ?>
                                        
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php foreach($getClientList AS $k_row => $e_row): ?>
                                        <?php $client_group_num=$e_row['client_group_number']; ?>
                                        <?php $currGrp=$client_group_num; ?>
                                        
                                        <?php
                                        
                                            if(!empty($e_row['tmValidUpto']) && $e_row['tmValidUpto']!="0000-00-00")
                                                $tmValidUpto=date("Y-m-d", strtotime($e_row['tmValidUpto']));
                                            else 
                                                $tmValidUpto="";
                                                
                                            $tmExpired=false;
                                            
                                            if(!empty($tmValidUpto)){
                                                $oneMonthAgoDate = date('Y-m-d', strtotime($tmValidUpto.' -6 month'));
                                                if($oneMonthAgoDate <= $currentDate){
                                                    $tmExpired=true;
                                                }
                                            }
                                        
                                        ?>
                                        
                                        <?php if(!$tmExpired && $e_row['isDiscontinued']==2 && $e_row['isReject']!=1): ?>
                                        
                                        <?php
                                            if($currGrp!=$prevGrp)
                                                $clrCnt++;
                                            
                                            $clrSeq=($clrCnt%2);
                                            
                                            if($clrSeq==0)
                                                $grpClr="#005495";
                                            else
                                                $grpClr="#f48b04";
                                        ?>
                                        
                                        <tr id="client_id_tr_<?php echo $e_row['clientId']; ?>" <?php if($tmExpired): ?> style="background: #FFCCCB !important;" <?php endif; ?>>
                                            <td class="text-center" width="5%"><?php echo $i; ?></td>
                                            <td class="text-center" width="5%" nowrap>
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
                                                    $cliOrgNameVar = (!empty($e_row['clientBussOrganisation'])) ? " (".$e_row['clientBussOrganisation'].")" : "";
                                                
                                                    if($e_row['orgType']==8)
                                                        $clientNameVar = $e_row['clientName'].$cliOrgNameVar;
                                                    elseif($e_row['orgType']==9 || $e_row['orgType']==22 || $e_row['orgType']==23)
                                                        $clientNameVar = $e_row['clientName'];
                                                    else
                                                        $clientNameVar = $e_row['clientBussOrganisation']; 
                                                ?>
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
                                                    <?php
                                                        if(strlen($clientNameVar)>17)
                                                        {
                                                            echo substr($clientNameVar, 0, 17)."..";
                                                        }
                                                        else
                                                        {
                                                            echo $clientNameVar;
                                                        }
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                    if(!empty($e_row['tradeMark']))
                                                        echo $e_row['tradeMark'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['tmClass']))
                                                        echo $e_row['tmClass'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['tmNo']))
                                                        echo $e_row['tmNo'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmDate']))
                                                        echo date("d-m-Y", strtotime($e_row['tmDate']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmApprovedOn']))
                                                        echo date("d-m-Y", strtotime($e_row['tmApprovedOn']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmAdvertisedOn']))
                                                        echo date("d-m-Y", strtotime($e_row['tmAdvertisedOn']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmRegisteredOn']))
                                                        echo date("d-m-Y", strtotime($e_row['tmRegisteredOn']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($tmValidUpto))
                                                        echo date("d-m-Y", strtotime($tmValidUpto));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td width="5%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editClientModal<?php echo $k_row; ?>">View/Edit</a>
                                                        <a class="dropdown-item rejectTm" href="javascript:void(0);" data-id="<?= $e_row['tmId']; ?>">Reject</a>
                                                        <a class="dropdown-item deleteTm" href="javascript:void(0);" data-id="<?= $e_row['tmId']; ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php $i++; ?>
                                        <?php $prevGrp=$client_group_num; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php foreach($getClientList AS $k_row => $e_row): ?>
                                        <?php $client_group_num=$e_row['client_group_number']; ?>
                                        <?php $currGrp=$client_group_num; ?>
                                        
                                        <?php if($e_row['isDiscontinued']==1 || $e_row['isReject']==1): ?>
                                        
                                        <?php
                                            if($currGrp!=$prevGrp)
                                                $clrCnt++;
                                            
                                            $clrSeq=($clrCnt%2);
                                            
                                            if($clrSeq==0)
                                                $grpClr="#005495";
                                            else
                                                $grpClr="#f48b04";
                                            
                                            if(!empty($e_row['tmValidUpto']) && $e_row['tmValidUpto']!="0000-00-00")
                                                $tmValidUpto=date("Y-m-d", strtotime($e_row['tmValidUpto']));
                                            else 
                                                $tmValidUpto="";
                                                
                                            $tmExpired=false;
                                            
                                            if(!empty($tmValidUpto)){
                                                $oneMonthAgoDate = date('Y-m-d', strtotime($tmValidUpto.' -1 month'));
                                                if($oneMonthAgoDate <= $currentDate){
                                                    $tmExpired=true;
                                                }
                                            }
                                        ?>
                                        
                                        <tr id="client_id_tr_<?php echo $e_row['clientId']; ?>" class="discontinueClass" style="background: #dbe3dd9e !important;">
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
                                                    $cliOrgNameVar = (!empty($e_row['clientBussOrganisation'])) ? " (".$e_row['clientBussOrganisation'].")" : "";
                                                
                                                    if($e_row['orgType']==8)
                                                        $clientNameVar = $e_row['clientName'].$cliOrgNameVar;
                                                    elseif($e_row['orgType']==9 || $e_row['orgType']==22 || $e_row['orgType']==23)
                                                        $clientNameVar = $e_row['clientName'];
                                                    else
                                                        $clientNameVar = $e_row['clientBussOrganisation']; 
                                                ?>
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
                                                    <?php
                                                        if(strlen($clientNameVar)>17)
                                                        {
                                                            echo substr($clientNameVar, 0, 17)."..";
                                                        }
                                                        else
                                                        {
                                                            echo $clientNameVar;
                                                        }
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                    if(!empty($e_row['tradeMark']))
                                                        echo $e_row['tradeMark'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['tmClass']))
                                                        echo $e_row['tmClass'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if(!empty($e_row['tmNo']))
                                                        echo $e_row['tmNo'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmDate']))
                                                        echo date("d-m-Y", strtotime($e_row['tmDate']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmApprovedOn']))
                                                        echo date("d-m-Y", strtotime($e_row['tmApprovedOn']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmAdvertisedOn']))
                                                        echo date("d-m-Y", strtotime($e_row['tmAdvertisedOn']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($e_row['tmRegisteredOn']))
                                                        echo date("d-m-Y", strtotime($e_row['tmRegisteredOn']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php   
                                                    if(check_valid_date($tmValidUpto))
                                                        echo date("d-m-Y", strtotime($tmValidUpto));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td width="5%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item continueTm" href="javascript:void(0);" data-id="<?= $e_row['tmId']; ?>">Continue Renewal</a>
                                                        <a class="dropdown-item deleteTm" href="javascript:void(0);" data-id="<?= $e_row['tmId']; ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php $i++; ?>
                                        <?php $prevGrp=$client_group_num; ?>
                                        <?php endif; ?>
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
    <?php foreach($getClientList AS $k_row => $e_row): ?>
    
    <!-- Modal -->
    <div id="editClientModal<?php echo $k_row; ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo base_url('edit-trade-mark'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit/View Client</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Client Name<small class="text-danger">*</small></label>
                                    <select class="custom-select form-control modalSelect2" name="fkClientId" id="fkClientId" required style="width:100%;">
                                        <option value="">Select</option>
                                        <?php if(!empty($clientList)): ?>
                                            <?php foreach($clientList AS $e_class): ?>
                                                <option value="<?= $e_class['clientId']; ?>" <?php if($e_class['clientId']==$e_row['fkClientId']): ?> selected <?php endif; ?>>
                                                    <?php
                                                        $cliOrgNameVar = (!empty($e_class['clientBussOrganisation'])) ? " (".$e_class['clientBussOrganisation'].")" : "";
                                                    
                                                        if($e_class['orgType']==8)
                                                            $cliNameVar = $e_class['clientName'].$cliOrgNameVar;
                                                        elseif($e_class['orgType']==9 || $e_class['orgType']==22 || $e_class['orgType']==23)
                                                            $cliNameVar = $e_class['clientName'];
                                                        else
                                                            $cliNameVar = $e_class['clientBussOrganisation']; 
                                                        
                                                        echo $cliNameVar;
                                                    ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Trade Mark</label>
                                    <input type="text" class="form-control" name="tradeMark" id="tradeMark" placeholder="Enter Trade Mark" value="<?= $e_row['tradeMark']; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Class</label>
                                    <input type="text" class="form-control" name="tmClass" id="tmClass" placeholder="Enter Class" value="<?= $e_row['tmClass']; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Application No.</label>
                                    <input type="text" class="form-control" name="tmNo" id="tmNo" placeholder="Enter Application No" value="<?= $e_row['tmNo']; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Date of Application</label>
                                    <input type="date" class="form-control" name="tmDate" id="tmDate" value="<?= $e_row['tmDate']; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Approved On</label>
                                    <input type="date" class="form-control" name="tmApprovedOn" id="tmApprovedOn" value="<?= $e_row['tmApprovedOn']; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Advertised On</label>
                                    <input type="date" class="form-control" name="tmAdvertisedOn" id="tmAdvertisedOn" value="<?= $e_row['tmAdvertisedOn']; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Registered On</label>
                                    <input type="date" class="form-control" name="tmRegisteredOn" id="tmRegisteredOn" value="<?= $e_row['tmRegisteredOn']; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Valid Upto</label>
                                    <input type="date" class="form-control" name="tmValidUpto" id="tmValidUpto" value="<?= $e_row['tmValidUpto']; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name="tmRemarks" placeholder="Enter Remarks"><?= $e_row['tmRemarks']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="tmId" id="tmId" value="<?= $e_row['tmId']; ?>" />
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

<!-- Modal -->
<div id="addClientModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo base_url('add-trade-mark'); ?>" method="POST" enctype="multipart/form-data" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Client</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Client Name<small class="text-danger">*</small></label>
                                <select class="custom-select form-control modalSelect2" name="fkClientId" id="fkClientId" required style="width:100%;">
                                    <option value="">Select</option>
                                    <?php if(!empty($clientList)): ?>
                                        <?php foreach($clientList AS $e_class): ?>
                                            <option value="<?= $e_class['clientId']; ?>" >
                                                <?php
                                                    $cliOrgNameVar = (!empty($e_class['clientBussOrganisation'])) ? " (".$e_class['clientBussOrganisation'].")" : "";
                                                
                                                    if($e_class['orgType']==8)
                                                        $cliNameVar = $e_class['clientName'].$cliOrgNameVar;
                                                    elseif($e_class['orgType']==9 || $e_class['orgType']==22 || $e_class['orgType']==23)
                                                        $cliNameVar = $e_class['clientName'];
                                                    else
                                                        $cliNameVar = $e_class['clientBussOrganisation']; 
                                                    
                                                    echo $cliNameVar;
                                                ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Trade Mark</label>
                                <input type="text" class="form-control" name="tradeMark" id="tradeMark" placeholder="Enter Trade Mark" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Class</label>
                                <input type="text" class="form-control" name="tmClass" id="tmClass" placeholder="Enter Class" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Application No.</label>
                                <input type="text" class="form-control" name="tmNo" id="tmNo" placeholder="Enter Application No" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Date of Application</label>
                                <input type="date" class="form-control" name="tmDate" id="tmDate" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Approved On</label>
                                <input type="date" class="form-control" name="tmApprovedOn" id="tmApprovedOn" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Advertised On</label>
                                <input type="date" class="form-control" name="tmAdvertisedOn" id="tmAdvertisedOn" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Registered On</label>
                                <input type="date" class="form-control" name="tmRegisteredOn" id="tmRegisteredOn" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Valid Upto</label>
                                <input type="date" class="form-control" name="tmValidUpto" id="tmValidUpto" >
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" name="tmRemarks" placeholder="Enter Remarks"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
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

<script>
    $(document).ready(function(){
        $('.deleteTm').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var tmId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/delete-trade-mark';
                    $.post(postingUrl, 
                    {
                        tmId: tmId
                    },
                    function(data, status){
                        window.location.href=base_url+"/trade-mark";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        $('.discontinueTm').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var tmId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you want to Discontinue Renewal ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Discontinue",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/discontinue-trade-mark';
                    $.post(postingUrl, 
                    {
                        tmId: tmId
                    },
                    function(data, status){
                        window.location.href=base_url+"/trade-mark";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        $('.continueTm').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var tmId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you want to Continue Renewal?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Continue",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/continue-trade-mark';
                    $.post(postingUrl, 
                    {
                        tmId: tmId
                    },
                    function(data, status){
                        window.location.href=base_url+"/trade-mark";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
        
        $('.rejectTm').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var tmId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Trade Mark is Rejected/Abandoned ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Rejected",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/reject-trade-mark';
                    $.post(postingUrl, 
                    {
                        tmId: tmId
                    },
                    function(data, status){
                        window.location.href=base_url+"/trade-mark";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });
    });
</script>
<?= $this->endSection(); ?>