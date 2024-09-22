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
    
    .theme-primary .btnPrimClr{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
    
    tr.isApprovedDirKyc td:not(:last-child) {
        background: #24d724a6 !important;
    }

    tr.isUpdatedDirKyc td:not(:last-child) {
        background: #f0f58b7d !important;
    }
    
</style>
<?php $s_time = strtotime("2019-12-01"); ?>
<?php $hasData=false; ?>
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
                            <a href="<?= base_url('company-menus'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="tab-content tabcontent-border p-5" id="myTabContent">
                        <!-- Tab panes -->
                        <div class="tab-pane fade table-responsive show active" role="tabpanel">
                            <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                <?php if(!empty($DDFArr)): ?>
                                    <?php foreach($DDFArr AS $k_ddf => $e_ddf): ?>
                                        <?php $dueDateArr = $DDFDueDateArr[$k_ddf]; ?>
                                        <?php if(!empty($dueDateArr)): ?>
                                            <?php foreach($dueDateArr AS $k_dd => $e_dd): ?>
                                            
                                                <?php $due_date_for = (!empty($e_dd['act_option_name1'])) ? $e_dd['act_option_name1'] : ""; ?>
                                            
                                                <?php $due_date = (!empty($e_dd['extended_date'])) ? $e_dd['extended_date'] : ""; ?>
                                                
                                                <?php $periodicityVal = (!empty($e_dd['periodicity'])) ? $e_dd['periodicity'] : ""; ?>
                                                
                                                <?php $periodicityName = (!empty($e_dd['periodicity_name'])) ? $e_dd['periodicity_name'] : "N/A"; ?>
                                                
                                                <?php $finYearVal = (!empty($e_dd['finYear'])) ? $e_dd['finYear'] : ""; ?>
                                                
                                                <?php $dueDate=(check_valid_date($due_date)) ? date('d-m-Y', strtotime($due_date)) : "-"; ?>
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="state due-month">
                                                            <label>Due Date For : <?= (!empty($due_date_for)) ? $due_date_for : "N/A"; ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="state second_header_div">
                                                            <div class="row">
                                                                <div class="col-md-4 text-center second_header">
                                                                    Due Date : <?= $dueDate; ?>
                                                                </div>
                                                                <div class="col-md-4 text-center second_header">
                                                                    Periodicity : <?= $periodicityName; ?>
                                                                </div>
                                                                <div class="col-md-4 text-center second_header">
                                                                    Period : 
                                                                    <?php
                                                                        if($periodicityVal=="1")
                                                                        {
                                                                            $daily_date_val = (!empty($e_dd['daily_date'])) ? $e_dd['daily_date'] : "";
                                                                            echo (!empty($daily_date_val)) ? date("d-M-Y", strtotime($daily_date_val)) : "N/A";
                                                                        }
                                                                        elseif($periodicityVal=="2")
                                                                        {
                                                                            $period_month_val = (!empty($e_dd['period_month'])) ? $e_dd['period_month'] : "";
                                                                            $period_year_val = (!empty($e_dd['period_year'])) ? $e_dd['period_year'] : "";
                                                                            
                                                                            if(!empty($period_month_val) && !empty($period_year_val))
                                                                            {
                                                                                echo date("M", strtotime("2021-".$period_month_val."-01"))."-".$period_year_val;
                                                                            }
                                                                            else
                                                                            {
                                                                                echo "N/A";
                                                                            }
                                                                        }
                                                                        elseif($periodicityVal>="3")
                                                                        {
                                                                            $f_period_month_val = (!empty($e_dd['f_period_month'])) ? $e_dd['f_period_month'] : "";
                                                                            $f_period_year_val = (!empty($e_dd['f_period_year'])) ? $e_dd['f_period_year'] : "";
                                                                            $t_period_month_val = (!empty($e_dd['t_period_month'])) ? $e_dd['t_period_month'] : "";
                                                                            $t_period_year_val = (!empty($e_dd['t_period_year'])) ? $e_dd['t_period_year'] : "";
                                                                            
                                                                            if(!empty($f_period_month_val) && !empty($f_period_year_val) && !empty($t_period_month_val) && !empty($t_period_year_val))
                                                                            {
                                                                                echo date("M", strtotime("2021-".$f_period_month_val."-01"))."-".$f_period_year_val." - ".date("M", strtotime("2021-".$t_period_month_val."-01"))."-".$t_period_year_val;
                                                                            }
                                                                            else
                                                                            {
                                                                                echo "N/A";
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "N/A";
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                            <thead>
                                                                <tr class="row-1">
                                                                    <th class="column-1" width="1%" nowrap>SN</th>
                                                                    <th class="column-2" width="10%" nowrap>Group No</th>
                                                                    <th class="column-3" nowrap>Client Name</th>
                                                                    <th class="column-4" width="10%" nowrap>DIN</th>
                                                                    <th class="column-4" width="10%" nowrap>Mobile</th>
                                                                    <th class="column-4" width="10%" nowrap>Email</th>
                                                                    <th class="column-5" width="5%" nowrap>Alloted To</th>
                                                                    <th class="column-6" width="5%" nowrap>Updated On</th>
                                                                    <th class="column-7" width="5%" nowrap>SRN No</th>
                                                                    <th class="column-8" width="5%" nowrap>Approved On</th>
                                                                    <th class="column-9" width="5%" nowrap>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="row-hover">
                                                                <?php $sr=1; ?>
                                                                <?php $clientDDArr = $DDFDueDateForClientArr[$k_ddf][$k_dd]; ?>
                                                                <?php if(!empty($clientDDArr)): ?>
                                                                    <?php foreach($clientDDArr AS $e_row): ?>
                                                                        <?php $hasData=true; ?>
                                                                        <?php $dirKycUpdatedOn = (check_valid_date($e_row['dirKycUpdatedOn'])) ? date('d-m-Y', strtotime($e_row['dirKycUpdatedOn'])) : "-"; ?>
                                                                        <?php $dirKycApprovedOn = (check_valid_date($e_row['dirKycApprovedOn'])) ? date('d-m-Y', strtotime($e_row['dirKycApprovedOn'])) : "-"; ?>

                                                                        <?php
                                                                            $atStage = 0;
                                                                            if($dirKycUpdatedOn!="-"){
                                                                                $atStage = 1;
                                                                                if($dirKycApprovedOn!="-"){
                                                                                    $atStage = 2;
                                                                                }
                                                                            }
                                                                        ?>

                                                                        <tr class="row-1 tbl_row_clr <?php if($atStage==1): ?> isUpdatedDirKyc <?php endif; ?> <?php if($atStage==2): ?> isApprovedDirKyc <?php endif; ?>" >
                                                                            <td class="column-1 text-center" width="1%" nowrap>
                                                                                <?= $sr; ?>
                                                                            </td>
                                                                            <td class="column-2 text-center" width="10%" nowrap>
                                                                                <?= $e_row['client_group_number']; ?>
                                                                            </td>
                                                                            <td class="column-3" nowrap>
                                                                                <?php 
                                                                                    if(in_array($e_row['orgType'], INDIVIDUAL_ARRAY))
                                                                                        $clientNameVar=$e_row['clientName'];
                                                                                    else
                                                                                        $clientNameVar=$e_row['clientBussOrganisation']; 
                                                                                ?>
                                                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $clientNameVar; ?>">
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
                                                                            <td class="column-5 text-center" width="10%">
                                                                                <?= (!empty($e_row['client_document_number'])) ? $e_row['client_document_number'] : "-"; ?>
                                                                            </td>
                                                                            <td class="column-5 text-center" width="10%">
                                                                                <?= (!empty($e_row['dirKycMob'])) ? $e_row['dirKycMob'] : "-"; ?>
                                                                            </td>
                                                                            <td class="column-5 text-center" width="10%" nowrap>
                                                                                <?= (!empty($e_row['dirKycEmail'])) ? $e_row['dirKycEmail'] : "-"; ?>
                                                                            </td>
                                                                            <td class="column-7 text-center" width="10%">
                                                                                <?= (!empty($e_row['userShortName'])) ? $e_row['userShortName'] : "-"; ?>
                                                                            </td>
                                                                            <td class="column-10 text-center" width="10%">
                                                                                <?= (check_valid_date($e_row['dirKycUpdatedOn'])) ? date("d-m-Y", strtotime($e_row['dirKycUpdatedOn'])) : "-"; ?>
                                                                            </td>
                                                                            <td class="column-11 text-center" width="10%">
                                                                                <?= (!empty($e_row['dirKycSrnNo'])) ? $e_row['dirKycSrnNo'] : "-"; ?>
                                                                            </td>
                                                                            <td class="column-12 text-center" width="10%">
                                                                                <?= (check_valid_date($e_row['dirKycApprovedOn'])) ? date('d-m-Y', strtotime($e_row['dirKycApprovedOn'])) : "-"; ?>
                                                                            </td>
                                                                            <td class="column-13 text-center" width="10%">
                                                                                <div class="btn-group">
                                                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-xs btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateModal<?= $e_row['clientId'].$sr; ?>">Edit</a>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <!-- Modal -->
                                                                                <div id="updateModal<?= $e_row['clientId'].$sr; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                                                            <div class="form-group text-left">
                                                                                                                <label>Alloted To</label>
                                                                                                                <select class="custom-select form-control" name="dirKycAllotedTo" id="dirKycAllotedTo" >
                                                                                                                    <option value="">Select Alloted To</option>
                                                                                                                    <?php if(!empty($getUserList)): ?>
                                                                                                                        <?php foreach($getUserList AS $e_user): ?>
                                                                                                                            <?php 
                                                                                                                                $selAllotedTo="";
                                                                                                                                if($e_row['dirKycAllotedTo']==$e_user['userId'])
                                                                                                                                    $selAllotedTo="selected";
                                                                                                                            ?>
                                                                                                                            <option value="<?php echo $e_user['userId']; ?>" <?php echo $selAllotedTo; ?> ><?php echo $e_user['userFullName']; ?></option>
                                                                                                                        <?php endforeach; ?>
                                                                                                                    <?php endif; ?>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6 col-lg-6">
                                                                                                            <div class="form-group text-left">
                                                                                                                <label>Mobile No</label>
                                                                                                                <input type="text" class="form-control" name="dirKycMob" id="dirKycMob" value="<?= $e_row['dirKycMob']; ?>">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6 col-lg-6">
                                                                                                            <div class="form-group text-left">
                                                                                                                <label>Email Address</label>
                                                                                                                <input type="text" class="form-control" name="dirKycEmail" id="dirKycEmail" value="<?= $e_row['dirKycEmail']; ?>">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6 col-lg-6">
                                                                                                            <div class="form-group text-left">
                                                                                                                <label>Updated On</label>
                                                                                                                <input type="date" class="form-control" name="dirKycUpdatedOn" id="dirKycUpdatedOn" value="<?= (check_valid_date($e_row['dirKycUpdatedOn'])) ? date("Y-m-d", strtotime($e_row['dirKycUpdatedOn'])) : ""; ?>" >
                                                                                                            </div>
                                                                                                        </div><div class="col-md-6 col-lg-6">
                                                                                                            <div class="form-group text-left">
                                                                                                                <label>Updated On</label>
                                                                                                                <input type="date" class="form-control" name="dirKycUpdatedOn" id="dirKycUpdatedOn" value="<?= (check_valid_date($e_row['dirKycUpdatedOn'])) ? date("Y-m-d", strtotime($e_row['dirKycUpdatedOn'])) : ""; ?>" >
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6 col-lg-6">
                                                                                                            <div class="form-group text-left">
                                                                                                                <label>SRN No</label>
                                                                                                                <input type="text" class="form-control" name="dirKycSrnNo" id="dirKycSrnNo" value="<?= $e_row['dirKycSrnNo']; ?>">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-6 col-lg-6">
                                                                                                            <div class="form-group text-left">
                                                                                                                <label>Approved On</label>
                                                                                                                <input type="date" class="form-control" name="dirKycApprovedOn" id="dirKycApprovedOn" value="<?= (check_valid_date($e_row['dirKycApprovedOn'])) ? date("Y-m-d", strtotime($e_row['dirKycApprovedOn'])) : ""; ?>">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="modal-footer text-right" style="width: 100%;">
                                                                                                    <input type="hidden" name="clientId" id="clientId" value="<?= $e_row['clientId']; ?>">
                                                                                                    <input type="hidden" name="workId" id="workId" value="<?= $e_row['workId']; ?>">
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
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <?php if($hasData==false): ?>
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
                                                        Period : N/A
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                <thead>
                                                    <tr class="row-1">
                                                        <th class="column-1" width="1%">Sr No</th>
                                                        <th class="column-2" width="10%">Group No</th>
                                                        <th class="column-3" width="15%">Client Name</th>
                                                        <th class="column-4" width="7%">DIN</th>
                                                        <th class="column-4" width="10%" nowrap>Mobile</th>
                                                        <th class="column-4" width="10%" nowrap>Email</th>
                                                        <th class="column-5" width="7%">Alloted To</th>
                                                        <th class="column-6">Updated On</th>
                                                        <th class="column-7">SRN No</th>
                                                        <th class="column-8">Approved On</th>
                                                        <th class="column-11">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row-hover">
                                                    <tr class="row-1 tbl_row_clr" >
                                                        <td colspan="9" class="column-1 text-center">
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
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    <!-- /.col -->
	</div>
</section>
<!-- /.content -->
<?= $this->endSection(); ?>