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
        /*border: 2px solid #f99d27 !important;*/
        /*border-style: dashed !important;*/
        background: #e4f1fc;
    }
    
</style>
<?php $s_time = strtotime("2019-12-01"); ?>
<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold">Event Based Due Dates</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url("it-menus"); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                        
                    <div class="tab-content tabcontent-border p-5" id="myTabContent">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="state due-month">
                                    <label>Event Based Due Dates</label>
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
                                                <th class="column-3" width="15%">Name of the</th>
                                                <th class="column-3" width="15%">Due Date</th>
                                                <th class="column-5" colspan="2" width="14%">Alloted to</th>
                                                <th class="column-6" colspan="2" width="15%">Completed</th>
                                                <th class="column-9" width="5%">Due</th>
                                                <th class="column-7" width="10%">Event</th>
                                                <th class="column-9" width="7%">Billing</th>
                                                <th class="column-11" width="7%">Receipt</th>
                                            </tr>
                                            <tr class="row-1">
                                                <th class="column-1" width="1%">No</th>
                                                <th class="column-2" width="5%">No</th>
                                                <th class="column-3" width="15%">Client</th>
                                                <th class="column-3" width="15%">For</th>
                                                <th class="column-5" width="7%">Junior</th>
                                                <th class="column-6" width="7%">Senior</th>
                                                <th class="column-7" width="5%">%</th>
                                                <th class="column-8" width="10%">On</th>
                                                <th class="column-9" width="5%">Date</th>
                                                <th class="column-9" width="10%">Date</th>
                                                <th class="column-11" width="7%">Details</th>
                                                <th class="column-12" width="7%">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody class="row-hover">
                                            <?php $sr=1; ?>

                                            <?php if(!empty($eventDueDatesArr)): ?>
                                                <?php foreach($eventDueDatesArr AS $e_inc_row): ?>
                                                
                                                    <?php 
                                                        $non_rglr_due_date="-";
                                                        if(check_valid_date($e_inc_row['non_rglr_due_date']))
                                                            $non_rglr_due_date=date('d-m-Y', strtotime($e_inc_row['non_rglr_due_date'])); 
                                                    ?>
                                                    
                                                    <?php 
                                                        $non_rglr_event_date="-";
                                                        if(check_valid_date($e_inc_row['non_rglr_event_date']))
                                                            $non_rglr_event_date=date('d-m-Y', strtotime($e_inc_row['non_rglr_event_date'])); 
                                                    ?>
                                                
                                                    <tr class="row-1 tbl_row_clr" >
                                                        <td class="column-1" width="1%" nowrap>
                                                            <?= $sr; ?>
                                                        </td>
                                                        <td class="column-2" width="5%" nowrap>
                                                            <?= $e_inc_row["client_group_number"]; ?>
                                                        </td>
                                                        <td class="column-3" width="15%" nowrap>
                                                            <?php
                                                                if(in_array($e_inc_row['orgType'], INDIVIDUAL_ARRAY))
                                                                    $clientNameVar=$e_inc_row['clientName'];
                                                                else
                                                                    $clientNameVar=$e_inc_row['clientBussOrganisation']; 
                                                            ?>
                                                            <div class="tooltip-div">
                                                                <a href="javascript:void(0);" class="has-tooltip" data-original-title="<?= $clientNameVar; ?>">
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
                                                                <span class='tooltipElem tooltipClr'>
                                                                    <span class="small text-bold"><?= $clientNameVar; ?></span>
                                                                    <br>
                                                                    <a href="<?= base_url('client/edit_client/'.$e_inc_row['clientId']); ?>">
                                                                        <button type="button" class="waves-effect waves-light btn btn-sm btn-success">
                                                                            <i class="fa fa-user-circle fa-2x"></i>
                                                                            <span class="fs_14">Info</span>
                                                                        </button>
                                                                    </a>
                                                                    <a href="javascript:void(0);">
                                                                        <button type="button" class="waves-effect waves-light btn btn-sm btn-success">
                                                                            <i class="fa fa-file fa-2x"></i>
                                                                            <span class="fs_14">Work</span>
                                                                        </button>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="column-4" width="10%" nowrap>
                                                            <?php 
                                                                if(!empty($e_inc_row['non_rglr_due_date_for']))
                                                                {
                                                                    $ddfValue=$e_inc_row['non_rglr_due_date_for'];
                                                                    
                                                                    if(strlen($e_inc_row['non_rglr_due_date_for'])>20)
                                                                        $ddfVal=substr($e_inc_row['non_rglr_due_date_for'], 0, 20)."...";
                                                                    else
                                                                        $ddfVal=$e_inc_row['non_rglr_due_date_for'];
                                                                }
                                                                else
                                                                {
                                                                    $ddfValue=$ddfVal="N/A";
                                                                }
                                                            ?>
                                                            <span data-toggle="tooltip" class="non_rglr_due_date_for" data-original-title="<?= $ddfValue; ?>" style="cursor: pointer;">
                                                                <?= $ddfVal;  ?>
                                                            </span>
                                                        </td>
                                                        <td class="column-6 text-center" width="7%" nowrap>
                                                            -
                                                        </td>
                                                        <td class="column-7 text-center" width="7%">
                                                            -
                                                        </td>
                                                        <td class="column-8 text-center" width="5%">
                                                            -
                                                        </td>
                                                        <td class="column-8 text-center" width="5%">
                                                            -
                                                        </td>
                                                        <td class="column-2" width="10%" nowrap>
                                                            <?= $non_rglr_due_date; ?>
                                                        </td>
                                                        <td class="column-9 text-center" width="10%">
                                                            <?= $non_rglr_event_date; ?>
                                                        </td>
                                                        <td class="column-10 text-center" width="10%">
                                                            -
                                                        </td>
                                                        <td class="column-11 text-center" width="7%">
                                                            -
                                                        </td>
                                                    </tr>
                                                    <?php $sr++; ?>
                                                        
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr class="row-1 tbl_row_clr">
                                                    <td colspan="13" class="column-1">
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