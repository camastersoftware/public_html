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
        font-size: 16px !important;
    }
    
    .tablepress tbody {
        font-size: 16px !important;
    }
    
    td.column-1 {
        text-align: center;
        font-weight: normal;
        font-size: 16px !important;
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

    .grp_hd_clr{
        color: #fff !important;
        background-color: #f99d27 !important;
    }
    
    .tablepress tbody tr td {
      background: #96c7f242;
    }
</style>

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
                            <a href="<?php echo base_url('inc_tax_mis_menu'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="font-weight-bold">Assessment Year : <?= $asmtYear; ?></h4>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                        <?php
                            if($m_no<=9)
                                $m=$m_no+3;
                            else
                                $m=$m_no-9;
                        ?>
                        <?php $mth_nm=strtolower(date('M', strtotime("2021-".$m."-1"))); ?>
                        <li class="nav-item"> 
                            <a class="nav-link <?php if($m==$currMth): ?>active<?php endif; ?>" id="<?php echo $mth_nm; ?>-tab" data-toggle="tab" href="#<?php echo $mth_nm; ?>_tab" role="tab" aria-controls="profile">
                                <span class="hidden-sm-up">
                                    <i class="ion-person"></i>
                                </span> 
                                <span class="hidden-xs-down year-color font-weight-bold"><?php echo date('F', strtotime("2021-".$m."-1")); ?></span>
                            </a>
                        </li>	
                        <?php endfor; ?>
                    </ul>
                    <div class="tab-content tabcontent-border p-5" id="myTabContent">
                        <?php $currFinYr=substr($sessDueDateYear,0, 4); ?>
                        <?php for($w=1; $w<13; $w++): ?>
                            <?php 
                                if($w<=9)
                                {
                                    $a=$w+3;
                                }
                                else
                                {
                                    $a=$w-9;
                                }
                            ?>
                            <?php $mth_nm=strtolower(date('M', strtotime("2021-".$a."-1"))); ?>
                            <!-- Tab panes -->
                            <div class="tab-pane fade table-responsive <?php if($a==$currMth): ?>show active<?php endif; ?>" id="<?php echo $mth_nm; ?>_tab" role="tabpanel" aria-labelledby="<?php echo $mth_nm; ?>-tab">
                                <div class="row">
                                    <?php $groupCatListCount=0; ?>
                                    <?php $totalAssignCount=$totalFiledCount=$totalPendingCount=0; ?>
                                    <?php if(!empty($groupCatList)): ?>
                                        <?php $groupCatListCount=count($groupCatList); ?>
                                        <?php foreach($groupCatList AS $k_cat=>$e_cat): ?>
                                            <?php $group_category_id=$e_cat['group_category_id']; ?>
                                            <?php $group_category_name=$e_cat['group_category_name']; ?>
                                            <div class="offset-md-1 col-md-10">
                                                <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                                    <div class="tab-pane fade show active">
                                                        <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                            <thead>
                                                                <tr class="row-1">
                                                                    <th class="column-2 grp_hd_clr" colspan="8">GROUP - <?= $group_category_name; ?></th>
                                                                </tr>
                                                                <tr class="row-1">
                                                                    <th class="column-1" width="50px">SN</th>
                                                                    <th class="column-2" width="100px">Group No</th>
                                                                    <th class="column-2" width="250px">Group Name</th>
                                                                    <th class="column-3" width="100px">Junior</th>
                                                                    <th class="column-3" width="100px">Senior</th>
                                                                    <th class="column-3">Returns<br/>Due</th>
                                                                    <th class="column-3">Returns<br/>Filed</th>
                                                                    <th class="column-3">Returns<br/>Pending</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="row-hover">
                                                                <?php $sr=1; ?>
                                                                <?php if(!empty($groupList)): ?>
                                                                    <?php if(isset($cliGrpArr[$group_category_id])): ?>
                                                                        <?php $cliGrpArray=$cliGrpArr[$group_category_id]; ?>
                                                                        
                                                                        <?php $sumAssignCount=$sumFiledCount=$sumPendingCount=0; ?>
                                                                        
                                                                        <?php if(!empty($cliGrpArray)): ?>
                                                                            <?php foreach($cliGrpArray AS $e_grp): ?>
                                                                                <?php $client_group_id=$e_grp['client_group_id']; ?>
                                                                                <?php
                                                                                    $assignCount=0;
                                                                                    if(isset($misAssignArr[$a][$group_category_id][$client_group_id]))
                                                                                        $assignCount=$misAssignArr[$a][$group_category_id][$client_group_id];
                                                                                    else
                                                                                        $assignCount=0;
                                                                                    
                                                                                    $filedCount=0;
                                                                                    if(isset($misFiledArr[$a][$group_category_id][$client_group_id]))
                                                                                    {
                                                                                        $misFiledArray=$misFiledArr[$a][$group_category_id][$client_group_id];
                                                                                        
                                                                                        if(!empty($misFiledArray))
                                                                                            $filedCount=count($misFiledArray);
                                                                                        else
                                                                                            $filedCount=0;
                                                                                    }
                                                                                    
                                                                                    $pendingCount=$assignCount-$filedCount;
                                                                                    
                                                                                    $sumAssignCount+=$assignCount;
                                                                                    $sumFiledCount+=$filedCount;
                                                                                    $sumPendingCount+=$pendingCount;
                                                                                    
                                                                                    $seniorStr="-";
                                                                                    $seniorStrPlus = '';
                                                                                    if(isset($clientSnrArray[$client_group_id]))
                                                                                    {
                                                                                        $clientSnrArr=$clientSnrArray[$client_group_id];
                                                                                        
                                                                                        if(!empty($clientSnrArr))
                                                                                        {
                                                                                            $cliSnrTotalCount=count($clientSnrArr);
                                                                                            
                                                                                            if($cliSnrTotalCount>1)
                                                                                            {
                                                                                                $cliSnrCount=$cliSnrTotalCount-1;
                                                                                                
                                                                                                $snrValuesArr=array_values($clientSnrArr);
                                                                                                
                                                                                                $firstSnr=array_shift($snrValuesArr);
                                                                                                
                                                                                                $seniorStrPlus = implode(', ', $clientSnrArr);
                                                                                                $seniorStr = $firstSnr."<small>+</small>";
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                $snrValuesArr=array_values($clientSnrArr);
                                                                                                
                                                                                                $firstSnr=array_shift($snrValuesArr);
                                                                                                
                                                                                                $seniorStrPlus = '';
                                                                                                $seniorStr = $firstSnr;
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    
                                                                                    $juniorStr="-";
                                                                                    $juniorStrPlus = '';
                                                                                    if(isset($clientJnrArray[$client_group_id]))
                                                                                    {
                                                                                        $clientJnrArr=$clientJnrArray[$client_group_id];
                                                                                        
                                                                                        if(!empty($clientJnrArr))
                                                                                        {
                                                                                            $cliJnrTotalCount=count($clientJnrArr);
                                                                                            
                                                                                            if($cliJnrTotalCount>1)
                                                                                            {
                                                                                                $cliJnrCount=$cliJnrTotalCount-1;
                                                                                                
                                                                                                $jnrValuesArr=array_values($clientJnrArr);
                                                                                                
                                                                                                $firstJnr=array_shift($jnrValuesArr);
                                                                                                
                                                                                                $juniorStrPlus = implode(', ', $clientJnrArr);
                                                                                                $juniorStr = $firstJnr."<small>+</small>";
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                $jnrValuesArr=array_values($clientJnrArr);
                                                                                                
                                                                                                $firstJnr=array_shift($jnrValuesArr);
                                                                                                
                                                                                                $juniorStrPlus = '';
                                                                                                $juniorStr = $firstJnr;
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                <?php if($assignCount!=0): ?>
                                                                                    <tr class="row-1">
                                                                                        <td class="column-1" width="50px"><?= $sr; ?></td>
                                                                                        <td class="column-2 text-center" width="100px">
                                                                                            <a href="<?php echo base_url('inc_tax_mis_client/'.$e_grp['client_group_id']); ?>" >
                                                                                                <?= $e_grp['client_group_number']; ?>
                                                                                            </a>
                                                                                        </td>
                                                                                        <td class="column-2" width="250px" nowrap>
                                                                                            <a href="<?php echo base_url('inc_tax_mis_client/'.$e_grp['client_group_id']); ?>" >
                                                                                                <?= $e_grp['client_group']; ?>
                                                                                            </a>
                                                                                        </td>
                                                                                        <td class="column-2 text-center" width="100px" <?php if($juniorStrPlus!=''): ?> data-toggle="tooltip" data-original-title="<?php echo $juniorStrPlus; ?>" style="cursor: pointer;" <?php endif; ?>><?= $juniorStr; ?></td>
                                                                                        <td class="column-2 text-center" width="100px" <?php if($seniorStrPlus!=''): ?> data-toggle="tooltip" data-original-title="<?php echo $seniorStrPlus; ?>" style="cursor: pointer;"  <?php endif; ?>><?= $seniorStr; ?></td>
                                                                                        <td class="column-3 text-center"><?= $assignCount; ?></td>
                                                                                        <td class="column-3 text-center"><?= $filedCount; ?></td>
                                                                                        <td class="column-3 text-center"><?= $pendingCount; ?></td>
                                                                                    </tr>
                                                                                    <?php $sr++; ?>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                            <tr class="row-1">
                                                                                <td class="column-1" width="50px"></td>
                                                                                <td class="column-2 text-center" width="100px"></td>
                                                                                <td class="column-2 text-center"></td>
                                                                                <td class="column-2 text-center"></td>
                                                                                <td class="column-2 text-right font-weight-bold" width="125px">Sub-Total</td>
                                                                                <td class="column-3 text-center font-weight-bold"><?= $sumAssignCount; ?></td>
                                                                                <td class="column-3 text-center font-weight-bold"><?= $sumFiledCount; ?></td>
                                                                                <td class="column-3 text-center font-weight-bold"><?= $sumPendingCount; ?></td>
                                                                            </tr>
                                                                            <?php
                                                                                $totalAssignCount+=$sumAssignCount;
                                                                                $totalFiledCount+=$sumFiledCount;
                                                                                $totalPendingCount+=$sumPendingCount;
                                                                            ?>
                                                                        <?php endif; ?>
                                                                        
                                                                        <?php $groupTotalCount=$k_cat+1; ?>
                                                                        <?php if($groupCatListCount==$groupTotalCount): ?>
                                                                        <tr class="row-1">
                                                                            <td class="column-1" width="50px"></td>
                                                                            <td class="column-2 text-center" width="100px"></td>
                                                                            <td class="column-2 text-center"></td>
                                                                            <td class="column-2 text-center"></td>
                                                                            <td class="column-2 text-right font-weight-bold" width="125px">Grand Total</td>
                                                                            <td class="column-3 text-center font-weight-bold"><?= $totalAssignCount; ?></td>
                                                                            <td class="column-3 text-center font-weight-bold"><?= $totalFiledCount; ?></td>
                                                                            <td class="column-3 text-center font-weight-bold"><?= $totalPendingCount; ?></td>
                                                                        </tr>
                                                                        <?php endif; ?>
                                                                        
                                                                    <?php else: ?>
                                                                    <tr class="row-1">
                                                                        <td colspan="8" class="column-1">
                                                                            No records found
                                                                        </td>
                                                                    </tr>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>                    
                                </div>
                            </div>
                        <?php endfor; ?>
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