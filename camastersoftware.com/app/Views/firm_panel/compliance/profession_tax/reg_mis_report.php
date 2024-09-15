
<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .modal-xl {
        max-width: 1295px !important;
    }
    
    #filterLabels div.col-md-6{
        font-size: 15px !important;
        font-weight: bold !important;
    }
    
    .tabcontent-border {
        border: 1px solid #bfbfbf !important;
    }
    
    td.column_date {
        font-size: 15px !important;
    }
    
    .tablepress tbody td, .tablepress tfoot th {
        border: 1px solid #015aacab !important;
        /*color: #000;*/
    }
    
    .nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
        border-color: #015aac #015aac #015aac !important;
    }
    
    .nav-tabs .nav-link {
        position: relative;
        color: #7792b1;
        padding: 0.5rem 1.25rem;
        border-radius: 0;
        -webkit-transition: 0.5s;
        transition: 0.5s;
        border: 1px solid #015aac !important;
            border-top-color: rgb(1, 90, 172);
            border-right-color: rgb(1, 90, 172);
            border-bottom-color: rgb(1, 90, 172);
            border-left-color: rgb(1, 90, 172);
    }
    
    table.dataTable {
      border-collapse: separate !important;
      font-size: 12px !important;
    }
    
    .theme-primary .btn-info {
      height: 25px !important;
    }
    
    .due_date_for_name{
        font-size: 12px !important;
        /*font-weight: 700 !important;*/
        color: #000 !important;
    }
    
    .ddfColTd span{
        font-size: 13px !important;
        color: #000 !important;
    }
    
    thead tr th.mthHead, tbody tr td.mthData {
        min-width: 50px !important;
        max-width: 50px !important;
    }
</style>

    <!-- Main content -->
    <section class="content mt-35">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border flexbox">
                        <h4 class="box-title font-weight-bold">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right get_back">Back</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php $isRecordsExists=false; ?>
                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                            <thead>
                                <tr class="row-1">
                                    <th class="column-1">Client Name</th>
                                    <th class="column-1">P'city</th>
                                    <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                        <?php
                                            if($m_no<=9)
                                                $m=$m_no+3;
                                            else
                                                $m=$m_no-9;
                                        ?>
                                        <?php $mth_nm=date('M', strtotime("2021-".$m."-1")); ?>
                                        <th class="column-1 mthHead"><?= $mth_nm; ?></th>
                                    <?php endfor; ?>
                                </tr>
                                <tr class="row-1">
                                    <th class="column-1"></th>
                                    <th class="column-1"></th>
                                    <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                        <?php
                                            if($m_no<=9)
                                                $m=$m_no+3;
                                            else
                                                $m=$m_no-9;
                                        ?>
                                        <?php
                                            $dueDateArr = array();
                                            if(isset($mthDueDateArr[$m]))
                                            {
                                                $dueDateArr=$mthDueDateArr[$m];
                                            }
                                        ?>
                                        <th class="column-1 mthHead">
                                            <?php
                                                if(!empty($dueDateArr))
                                                {
                                                    $dueDate = "";
                                                    foreach($dueDateArr AS $k_dd => $e_dd)
                                                    {
                                                        if(check_valid_date($e_dd))
                                                        {
                                                            $prdcity = explode('_', $k_dd)[1];
                                                            
                                                            if($prdcity==5)
                                                                $dueDate=date("d.m.y", strtotime($e_dd))."*";
                                                            else
                                                                $dueDate=date("d.m.y", strtotime($e_dd));
                                                        }
                                                        echo $dueDate."<br>";
                                                    }
                                                }
                                            ?>
                                        </th>
                                    <?php endfor; ?>
                                </tr>
                            </thead>
                            <tbody class="row-hover">
                                <?php if(!empty($clientDataArr)): ?>
                                    <?php foreach($clientDataArr AS $k_client_id=>$e_client): ?>
                                        
                                        <?php 
                                            if(in_array($e_client['orgType'], INDIVIDUAL_ARRAY))
                                                $clientNameVar=$e_client['clientName'];
                                            else
                                                $clientNameVar=$e_client['clientBussOrganisation']; 
                                        ?>
                        
                                        <?php $prdCtyName=$e_client['periodcity_short_name']; ?>
                                        
                                        <?php $isRecordsExists=true; ?>
                                        
                                        <tr class="row-2">
                                            <td class="ddfColTd" nowrap>
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $clientNameVar; ?>">
                                                    <?php
                                                        if(strlen($clientNameVar)>20)
                                                        {
                                                            $ddfNameVar=substr($clientNameVar, 0, 20)."..";
                                                        }
                                                        else
                                                        {
                                                            $ddfNameVar=$clientNameVar;
                                                        }
                                                    ?>
                                                    <span class="due_date_for_name">
                                                       <?= $ddfNameVar; ?>
                                                    </span>
                                                </a>
                                            </td>
                                            <td class="text-center"><?= $prdCtyName; ?></td>
                                            <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                <?php
                                                    if($mt_no<=9)
                                                        $mth=$mt_no+3;
                                                    else
                                                        $mth=$mt_no-9;
                                                ?>
                                                <?php
                                                    $filingDate="-";
                                                    if(isset($clientFilingDate[$mth][$k_client_id]))
                                                    {
                                                        $filingDateVal=$clientFilingDate[$mth][$k_client_id];
                                                        
                                                        if(check_valid_date($filingDateVal))
                                                        {
                                                            $filingDate=date("d.m.y", strtotime($filingDateVal));
                                                        }
                                                    }
                                                ?>
                                                <td class="text-center mthData <?php if($filingDate!="-"): ?>hasCompleted<?php endif; ?>">
                                                    <?= $filingDate; ?>
                                                </td>
                                            <?php endfor; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if(!$isRecordsExists): ?>
                                    <tr>
                                        <td colspan="14">
                                            <center>No records found :(</center>
                                        </td>
                                    <tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <h5>* indicates annual periodicity.</h5>
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