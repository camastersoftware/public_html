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
    
    .dataTables_wrapper .form-control{
        margin: 0px !important;
    }
    
    .discontinueClass td {
      color: #9d9c97 !important;
    }
    
    .todayAttend{
        background: #11589742 !important;
    }
    
</style>

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold">
                                <?= $pageTitle; ?>
                            </h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addTimeSheetModal">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Add</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">SN</th>
                                            <th width="5%">Date</th>
                                            <th width="5%">Day</th>
                                            <th width="5%">In&nbsp;Time</th>
                                            <th width="5%">Out&nbsp;Time</th>
                                            <th width="5%">Hours</th>
                                            <th width="5%">Place</th>
                                            <th width="5%">Remarks</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        <?php if(!empty($timeSheetArr)): ?>
                                            <?php foreach($timeSheetArr AS $k_row => $e_row): ?>
                                                <?php 
                                                    if(check_valid_date($e_row['tsWorkingDate']))
                                                        $tsWorkingDate=date('d-m-Y', strtotime($e_row['tsWorkingDate']));
                                                    else 
                                                        $tsWorkingDate="";
                                                        
                                                    $dayNo=date('N', strtotime($tsWorkingDate)); 
                                                ?>
                                                <tr>
                                                    <td class="text-center" width="5%"><?php echo $i; ?></td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($tsWorkingDate))
                                                                echo $tsWorkingDate;
                                                            else 
                                                                echo "-";
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($tsWorkingDate))
                                                                echo date('D', strtotime($tsWorkingDate));
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['tsStartTime']))
                                                                echo date('h:i A', strtotime($e_row['tsStartTime']));
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['tsEndTime']))
                                                                echo date('h:i A', strtotime($e_row['tsEndTime']));
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['totalHours']))
                                                                $totalHoursVal = $e_row['tsTotalHours'];
                                                            else 
                                                                $totalHoursVal = " "; 
                                                        ?>
                                                        <?= $totalHoursVal; ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['tsWorkPlace']))
                                                                echo $e_row['tsWorkPlace'];
                                                            else 
                                                                echo " "; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <span <?php if(!empty($e_row['tsRemarks']) && strlen($e_row['tsRemarks'])>45): ?> data-toggle="tooltip" data-original-title="<?= $e_row['tsRemarks']; ?>" style="cursor: pointer;" <?php endif; ?>>
                                                            <?php 
                                                                if(!empty($e_row['tsRemarks']))
                                                                {
                                                                    if(strlen($e_row['tsRemarks'])>45)
                                                                    {
                                                                        echo substr($e_row['tsRemarks'], 0, 45)."...";
                                                                    }
                                                                    else
                                                                    {
                                                                        echo $e_row['tsRemarks'];
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    echo "-";
                                                                }
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td width="5%" class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editTimeSheetModal<?php echo $k_row; ?>">Edit</a>
                                                                <?php if(isset($e_row['timeSheetId'])): ?>
                                                                    <a class="dropdown-item deleteEmpAttend" href="javascript:void(0);" data-id="<?= $e_row['timeSheetId']; ?>">Delete</a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
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
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>