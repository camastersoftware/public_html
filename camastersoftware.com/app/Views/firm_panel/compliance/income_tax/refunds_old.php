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
                            <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="<?php echo base_url('inc_menus'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="tab-content tabcontent-border p-5" id="myTabContent">
                        <div class="tab-content tabcontent-border p-5" id="myTabContent">
                            <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1">Sr</th>
                                            <th class="column-2">NAME OF THE ASSESSEE</th>
                                            <th class="column-3">DOB</th>
                                            <th class="column-3">PAN</th>
                                            <th class="column-4">ASST.</th>
                                            <th class="column-5" colspan="2">DETAILS OF FILING RETURNS</th>
                                            <th class="column-6">TOTAL</th>
                                            <th class="column-8">REFUND</th>
                                            <th class="column-8">ACTION</th>
                                        </tr>
                                        <tr class="row-1">
                                            <th class="column-1">No</th>
                                            <th class="column-2"></th>
                                            <th class="column-3">/DOI</th>
                                            <th class="column-3">NO</th>
                                            <th class="column-4">YEAR</th>
                                            <th class="column-5">DATE</th>
                                            <th class="column-6">ACK. NUMBER</th>
                                            <th class="column-6">INCOME</th>
                                            <th class="column-11">CLAIMED</th>
                                            <th class="column-11"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">
                                        <?php $sr=1; ?>
                                
                                        <?php if(!empty($workDataArr)): ?>
                                            <?php foreach($workDataArr AS $e_inc_row): ?>
                                            
                                                <?php $hasData=true; ?>
                                            
                                                <tr class="row-1">
                                                    <td class="column-1">
                                                        <?php echo $sr; ?>
                                                    </td>
                                                    <td class="column-2">
                                                        <?php 
                                                            if($e_inc_row['orgType']==8 || $e_inc_row['orgType']==9)
                                                                $clientNameVar=$e_inc_row['clientName'];
                                                            else
                                                                $clientNameVar=$e_inc_row['clientBussOrganisation']; 
                                                        ?>
                                                         <a href="<?= base_url('income_tax/work_form/'.$e_inc_row['workId']); ?>" data-toggle="tooltip" data-original-title="<?php echo $clientNameVar; ?>">
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
                                                    <td class="column-3 text-center">
                                                        <?php   
                                                            if($e_inc_row['orgType']==8 || $e_inc_row['orgType']==9)
                                                            {
                                                                if(!empty($e_inc_row['clientDob']) && $e_inc_row['clientDob']!="0000-00-00")
                                                                    echo date("d-m-Y", strtotime($e_inc_row['clientDob']));
                                                                else 
                                                                    echo "-"; 
                                                            }
                                                            else
                                                            {
                                                                if(!empty($e_inc_row['clientBussIncorporationDate']) && $e_inc_row['clientBussIncorporationDate']!="0000-00-00")
                                                                    echo date("d-m-Y", strtotime($e_inc_row['clientBussIncorporationDate']));
                                                                else 
                                                                    echo "-"; 
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="column-4 text-center">
                                                        <?php
                                                            if(!empty($e_inc_row['clientPanNumber']))
                                                                echo $e_inc_row['clientPanNumber'];
                                                            else
                                                                echo "-";
                                                        ?>
                                                    </td>
                                                    <td class="column-5 text-center">
                                                        <?php
                                                            $asmtYear="N/A";
                                                            if(!empty($e_inc_row['finYear']))
                                                            {
                                                                $asmtYearVal=$e_inc_row['finYear'];
                                                                
                                                                $asmtYearArr = explode('-', $asmtYearVal);
                                                                
                                                                $fY=(int)$asmtYearArr[0]+1;
                                                                $lY=(int)$asmtYearArr[1]+1;
                                                                
                                                                $asmtYear=$fY."-".$lY;
                                                            }
                                                        ?>
                                                        <?php echo $asmtYear; ?>
                                                    </td>
                                                    <td class="column-9 text-center">
                                                        <?php 
                                                            $eFillingDate="-";
                                                            if(!empty($e_inc_row['eFillingDate']) && $e_inc_row['eFillingDate']!="0000-00-00" && $e_inc_row['eFillingDate']!="1970-01-01")
                                                                $eFillingDate=date('d-m-Y', strtotime($e_inc_row['eFillingDate'])); 
                                                        ?>
                                                        <?php echo $eFillingDate; ?>
                                                    </td>
                                                    <td class="column-9 text-center">
                                                        <?php
                                                            if(!empty($e_inc_row['acknowledgmentNo']))
                                                                echo $e_inc_row['acknowledgmentNo'];
                                                            else
                                                                echo "-";
                                                        ?>
                                                    </td>
                                                    <td class="column-9">
                                                        <?php if(!empty($e_inc_row['totalIncome'])): ?>
                                                            <div class="text-right">
                                                                <?php if($e_inc_row['totalIncome']>=0): ?>
                                                                    <?= amount_format($e_inc_row['totalIncome']); ?>
                                                                <?php else: ?>
                                                                    <?= "(".amount_format(abs((float)$e_inc_row['totalIncome'])).")"; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="text-center">-</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="column-9">
                                                        <?php if(!empty($e_inc_row['refundDue'])): ?>
                                                            <div class="text-right">
                                                                <?php if($e_inc_row['refundDue']>=0): ?>
                                                                    <?= amount_format($e_inc_row['refundDue']); ?>
                                                                <?php else: ?>
                                                                    <?= "(".amount_format(abs((float)$e_inc_row['refundDue'])).")"; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="text-center">-</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="column-9">
                                                        
                                                    </td>
                                                </tr>
                                                <?php $sr++; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="10">
                                                    <center>No records found</center>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                
                                    </tbody>
                                </table>
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