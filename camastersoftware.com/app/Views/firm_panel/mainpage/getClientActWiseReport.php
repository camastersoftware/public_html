<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .theme-primary .box-primary {
        background-color: #2b8836 !important;
    }

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
    
    .box_body_bg {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        /*border-radius: 10px;*/
        border: 1px solid #015aacab !important;
        background: #ffffff !important;
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
    
    .demo-checkbox .box_head_cl.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
    }
    
    .tablepress tbody tr {
        background: #96c7f242 !important;
    }
    
    .tablepress tr td {
        border: 1px solid #015aacab !important;
    }
    
    .actionCol .btnPrimClr{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
    
    .tablepress tbody tr.hasCompleted{
        background : #24d724a6 !important;
    }
</style>

<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold text-center"><?php echo $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('getClientMonthWiseReport/'.$clientId); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit" style="">Month-wise</button>
                        </a>
                        <a href="<?php echo base_url('get_client_report'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body box_body_bg wizard-content"> 
                    <form action="javascript:void(0);" class="tab-wizard wizard-circle edit_client_form" enctype="multipart/form-data">
                        <section>
                            <h4 class="text-center font-weight-bold"><?= $clientNameVar; ?></h4>
                            <div class="row sel_act_due_date">
                                <?php if(!empty($actArr)): ?>
                                    <?php foreach($actArr AS $e_act): ?>
                                        <?php
                                            if(isset($workListArr[$e_act["act_id"]]))
                                                $wkListArr=$workListArr[$e_act["act_id"]];
                                            else
                                                $wkListArr=array();
                                        ?>
                                        <?php if(!empty($wkListArr)): ?>
                                            <div class="col-lg-12 col-md-12">
                                                <h4 class="income-tax-head text-center"><?php echo $e_act["act_name"]; ?></h4>
                                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer allot_due_date">
                                                    <thead>
                                                        <tr class="row-1">
                                                            <th class="column-7" style="width: 7% !important;">Due Date</th>
                                                            <th class="column-1" style="width: 32% !important;">Due Date For</th>
                                                            <th class="column-3" style="width: 10% !important;">Section</th>
                                                            <th class="column-4" style="width: 11% !important;">Form</th>
                                                            <th class="column-5" style="width: 10% !important;">Periodicity</th>
                                                            <th class="column-6" style="width: 17% !important;">Period</th>
                                                            <th class="column-8" style="width: 5% !important;">Completion&nbsp;Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="row-hover">
                                                    <?php if(!empty($wkListArr)): ?>
                                                        <?php foreach($wkListArr AS $k_row=>$e_row): ?>
                                                            <?php 
                                                                $eFillingDate="-";
                                                                if(!empty($e_row['eFillingDate']) && $e_row['eFillingDate']!="0000-00-00" && $e_row['eFillingDate']!="1970-01-01")
                                                                    $eFillingDate=date('d-m-Y', strtotime($e_row['eFillingDate'])); 
                                                            ?>
                                                            <tr class="row-3 row_<?php echo $e_act["act_id"].$k_row.$e_row['due_date_id']; ?> <?php if($eFillingDate!="-"): ?>hasCompleted<?php endif; ?>" >
                                                                <td class="column-7 text-center" style="width: 7% !important;" nowrap><?php echo date('d-m-Y', strtotime($e_row['extended_date'])); ?></td>
                                                                <td class="column-1 text-left pl-25" style="width: 32% !important;">
                                                                    <?php 
                                                                        if(!empty($e_row['act_option_name1']))
                                                                        {
                                                                            $ddfValue=$e_row['act_option_name1'];
                                                                            
                                                                            if(strlen($e_row['act_option_name1'])>30)
                                                                                $ddfVal=substr($e_row['act_option_name1'], 0, 30)."...";
                                                                            else
                                                                                $ddfVal=$e_row['act_option_name1'];
                                                                        }
                                                                        else
                                                                        {
                                                                            $ddfValue=$ddfVal="N/A";
                                                                        }
                                                                    ?>
                                                                    <span data-toggle="tooltip" data-original-title="<?= $ddfValue; ?>" style="cursor: pointer;">
                                                                        <?= $ddfVal;  ?>
                                                                    </span>
                                                                </td>
                                                                <td class="column-3 text-center" style="width: 10% !important;" nowrap>
                                                                    <?php 
                                                                        if(!empty($e_row['act_option_name3']))
                                                                            echo $e_row['act_option_name3']; 
                                                                        else
                                                                            echo "N/A"; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-4 text-center" style="width: 11% !important;" nowrap>
                                                                    <?php 
                                                                        if(!empty($e_row['act_option_name5']))
                                                                            echo $e_row['act_option_name5']; 
                                                                        else
                                                                            echo "N/A"; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-5 text-center" style="width: 10% !important;" nowrap>
                                                                    <?php 
                                                                        if($e_row['periodicity']=="1")
                                                                        {
                                                                            echo "Daily";
                                                                        }
                                                                        elseif($e_row['periodicity']=="2")
                                                                        {
                                                                            echo "Monthly";
                                                                        }
                                                                        elseif($e_row['periodicity']=="3")
                                                                        {
                                                                            echo "Quaterly";
                                                                        }
                                                                        elseif($e_row['periodicity']=="4")
                                                                        {
                                                                            echo "Half Yearly";
                                                                        }
                                                                        elseif($e_row['periodicity']=="5")
                                                                        {
                                                                            echo "Annually";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td class="column-6 text-center" style="width: 17% !important;" nowrap>
                                                                    <?php 
                                                                        if($e_row['periodicity']=="1")
                                                                        {
                                                                            echo date("d-M-Y", strtotime($e_row["daily_date"]));
                                                                        }
                                                                        elseif($e_row['periodicity']=="2")
                                                                        {
                                                                            echo date("M", strtotime("2021-".$e_row["period_month"]."-01"))."-".$e_row["period_year"];
                                                                        }
                                                                        elseif($e_row['periodicity']>="3")
                                                                        {
                                                                            echo date("M", strtotime("2021-".$e_row["f_period_month"]."-01"))."-".$e_row["f_period_year"]." - ".date("M", strtotime("2021-".$e_row["t_period_month"]."-01"))."-".$e_row["t_period_year"];
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "N/A";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td class="column-8 text-center actionCol" style="width: 5% !important;" nowrap>
                                                                    <input type="hidden" name="due_date_id[]" value="<?php echo $e_row['due_date_id']; ?>">
                                                                    <?= $eFillingDate; ?>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td colspan="7"><center>No Records</center></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </section>               
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>