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
    
    /*.theme-primary .btn-success {*/
    /*    background-color: #1e613b !important;*/
    /*    border-color: #1e613b !important;*/
    /*    color: #ffffff !important;*/
    /*    width: 100px;*/
    /*    font-size: 13px;*/
    /*}*/
    
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
    
    /*.column-9 {*/
    /*    width:247px;*/
    /*}*/
    
    .btn-yesno{
        width:46%;
    }
    
    .btn-sm {
        font-size: 13px;
        padding: 4px 12px;
    }
    
    
</style>


<!-- Main content -->
<section class="content mt-40">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h4 class="box-title font-weight-bold">Income Tax-Scrutiny</h4>
                    <a href="<?php echo base_url('inc_menus'); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border p-15" id="myTabContent">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="state due-month">
                                    <label>Details Of Scrutiny & Appeals Cases-Income Tax</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                <thead>
                                    <tr class="row-1">
                                        <th class="column-1">Sr</th>
                                        <th class="column-2">Client</th>
                                        <th class="column-3">ASST</th>
                                        <th class="column-3">NOTICE</th>
                                        <th class="column-4">WARD</th>
                                        <th class="column-5">OFFICER</th>
                                        <th class="column-6">HEARING</th>
                                        <th class="column-7">ATTENDED</th>
                                        <th class="column-8">ATTENDED</th>
                                        <th class="column-9">NEXT</th>
                                        <th class="column-10">ORDER</th>
                                        <th class="column-11">RECPT</th>
                                    </tr>
                                    <tr class="row-1">
                                        <th class="column-1">No</th>
                                        <th class="column-2">Name</th>
                                        <th class="column-3">YEAR</th>
                                        <th class="column-3">U/S</th>
                                        <th class="column-4">NO.</th>
                                        <th class="column-5">NAME</th>
                                        <th class="column-6">DATE</th>
                                        <th class="column-7">DATE</th>
                                        <th class="column-8">BY</th>
                                        <th class="column-9">DATE</th>
                                        <th class="column-11">DATE</th>
                                        <th class="column-12">DATE</th>
                                    </tr>
                                </thead>
                                <tbody class="row-hover">
                                    <?php $i=1; ?>
                                    <?php if(!empty($workDataArr)): ?>
                                        <?php foreach($workDataArr AS $e_row): ?>
                                            <tr class="row-1">
                                                <td class="column-1"><?php echo $i; ?></td>
                                                <td class="column-2">
                                                    <?php 
                                                        if(in_array($e_row['orgType'], INDIVIDUAL_ARRAY))
                                                            $clientNameVar=$e_row['clientName'];
                                                        else
                                                            $clientNameVar=$e_row['clientBussOrganisation']; 
                                                    ?>
                                                    <a href="<?php echo base_url('income_tax/scrutiny_case/'.$e_row['workId']); ?>" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
                                                        <?php //echo $e_inc_row['clientTitle'].". ".$e_inc_row['clientName']; ?>
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
                                                <td class="column-3"><?php echo $e_row['finYear']; ?></td>
                                                <td class="column-4"><?php echo $e_row['noticeUs']; ?></td>
                                                <td class="column-5"><?php echo $e_row['wardNo']; ?></td>
                                                <td class="column-6">
                                                    <?php
                                                        $inspectorName="N/A";
                                                        if(!empty($e_row['inspectorName']))
                                                            $inspectorName=$e_row['inspectorName'];
                                                            
                                                        echo $inspectorName;
                                                    ?>
                                                </td>
                                                <td class="column-7">
                                                    <?php 
                                                        $hearingDate="N/A";
                                                        if(isset($hrngArr[$e_row['workId']]['hearingDate']))
                                                        {
                                                            $hearingDateVal=$hrngArr[$e_row['workId']]['hearingDate'];
                                                            if(!empty($hearingDateVal) && $hearingDateVal!="0000-00-00" && $hearingDateVal!="1970-01-01")
                                                                $hearingDate=date('d-m-Y', strtotime($hearingDateVal));
                                                        }
                                                        echo $hearingDate; 
                                                    ?>
                                                </td>
                                                <td class="column-8">
                                                    <?php 
                                                        $attendedDate="N/A";
                                                        if(isset($hrngArr[$e_row['workId']]['attendedDate']))
                                                        {
                                                            $attendedDateVal=$hrngArr[$e_row['workId']]['attendedDate'];
                                                            if(!empty($attendedDateVal) && $attendedDateVal!="0000-00-00" && $attendedDateVal!="1970-01-01")
                                                                $attendedDate=date('d-m-Y', strtotime($attendedDateVal));
                                                        }
                                                        echo $attendedDate; 
                                                    ?>
                                                </td>
                                                <td class="column-9">
                                                    <?php 
                                                        $attendedBy="N/A";
                                                        if(isset($hrngArr[$e_row['workId']]['attendedBy']))
                                                        {
                                                            $attendedByVal=$hrngArr[$e_row['workId']]['attendedBy'];
                                                            if(!empty($attendedByVal))
                                                                $attendedBy=$attendedByVal;
                                                        }
                                                        echo $attendedBy; 
                                                    ?>
                                                </td>
                                                <td class="column-10">
                                                    <?php 
                                                        $nextHearingDate="N/A";
                                                        if(isset($hrngArr[$e_row['workId']]['nextHearingDate']))
                                                        {
                                                            $nextHearingDateVal=$hrngArr[$e_row['workId']]['nextHearingDate'];
                                                            if(!empty($nextHearingDateVal) && $nextHearingDateVal!="0000-00-00" && $nextHearingDateVal!="1970-01-01")
                                                                $nextHearingDate=date('d-m-Y', strtotime($nextHearingDateVal));
                                                        }
                                                        echo $nextHearingDate; 
                                                    ?>
                                                </td>
                                                <td class="column-11">
                                                    <?php
                                                        $orderDate="N/A";
                                                        if(!empty($e_row['orderDate']) && $e_row['orderDate']!="0000-00-00" && $e_row['orderDate']!="1970-01-01")
                                                            $orderDate=date('d-m-Y', strtotime($e_row['orderDate']));
                                                        
                                                        echo $orderDate;
                                                    ?>
                                                </td>
                                                <td class="column-12">
                                                    <?php
                                                        $recptOrderDate="N/A";
                                                        if(!empty($e_row['recptOrderDate']) && $e_row['recptOrderDate']!="0000-00-00" && $e_row['recptOrderDate']!="1970-01-01")
                                                            $recptOrderDate=date('d-m-Y', strtotime($e_row['recptOrderDate']));
                                                            
                                                        echo $recptOrderDate;
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="12" class="column-1">
                                                No records found
                                            </td>
                                        </tr>
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
    <!-- /.row -->
</section>
<!-- /.content -->

<?= $this->endSection(); ?>