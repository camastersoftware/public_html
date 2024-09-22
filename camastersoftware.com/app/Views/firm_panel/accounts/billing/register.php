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
        padding: 8px !important;
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

<?php $currentDate = date('Y-m-d'); ?>
<?php $currentTime = date('h:i A'); ?>

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
                            <a href="<?php echo base_url('accountFinance'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
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
                                            <th width="5%">Bill&nbsp;No</th>
                                            <th width="5%">Name&nbsp;of&nbsp;the&nbsp;Party</th>
                                            <th width="5%">Particulars</th>
                                            <th width="5%">Period</th>
                                            <th width="5%">Fees</th>
                                            <th width="5%">CGST</th>
                                            <th width="5%">SGST</th>
                                            <th width="5%">IGST</th>
                                            <th width="5%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        <?php if(!empty($billDataArr)): ?>
                                            <?php foreach($billDataArr AS $k_row => $e_row): ?>
                                                <?php 
                                                    if(check_valid_date($e_row['billDate']))
                                                        $billDate=date('d-m-Y', strtotime($e_row['billDate']));
                                                    else 
                                                        $billDate="";
                                                ?>
                                                <tr>
                                                    <td class="text-center" width="5%"><?php echo $i; ?></td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($billDate))
                                                                echo $billDate;
                                                            else 
                                                                echo "-";
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['billNo']))
                                                                echo $e_row['billNo'];
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-left" width="5%" nowrap>
                                                        <?php
                                                            $cliOrgNameVar = (!empty($e_row['clientBussOrganisation'])) ? $e_row['clientBussOrganisation'] : "";
                                                        ?>
                                                        <?= display_client_name($e_row['orgType'], $e_row['clientName'], $cliOrgNameVar); ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['act_name']))
                                                                echo $e_row['act_name'];
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center" width="5%" nowrap>
                                                        <?php
                                                            $DDPeriod = "-";
                                                            $periodicity=$e_row['periodicity'];

                                                            if(!empty($periodicity))
                                                            {
                                                                if($periodicity==1)
                                                                {
                                                                    $DDPeriod = date("d-M-Y", strtotime($e_row["daily_date"]));
                                                                }
                                                                elseif($periodicity==2)
                                                                {
                                                                    $DDPeriod = date("M", strtotime("2021-".$e_row["period_month"]."-01"))."-".$e_row["period_year"];
                                                                }
                                                                elseif($periodicity>=3)
                                                                {
                                                                    $DDPeriod = date("M", strtotime("2021-".$e_row["f_period_month"]."-01"))."-".$e_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_row["t_period_month"]."-01"))."-".$e_row["t_period_year"];
                                                                }
                                                            }

                                                            echo $DDPeriod;
                                                        ?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['totalAmt']))
                                                                echo amount_format($e_row['totalAmt']);
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['cgstAmt']))
                                                                echo amount_format($e_row['cgstAmt']);
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['sgstAmt']))
                                                                echo amount_format($e_row['sgstAmt']);
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['igstAmt']))
                                                                echo amount_format($e_row['igstAmt']);
                                                            else 
                                                                echo "-"; 
                                                        ?>
                                                    </td>
                                                    <td class="text-right" width="5%" nowrap>
                                                        <?php 
                                                            if(!empty($e_row['totalBillAmt']))
                                                                echo amount_format($e_row['totalBillAmt']);
                                                            else 
                                                                echo "-"; 
                                                        ?>
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