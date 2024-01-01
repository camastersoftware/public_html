
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
      font-size: 13px !important;
    }
    
    .theme-primary .btn-info {
      height: 25px !important;
    }
    
    .due_date_for_name{
        font-size: 14px !important;
        /*font-weight: 700 !important;*/
        color: #000 !important;
    }
    
    .ddfColTd{
        height: 50px !important;
    }
    
    .ddfColTd span{
        font-size: 14px !important;
        color: #000 !important;
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
                            <a href="<?= base_url('tax_calendar_menu'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?=base_url('act-wise-mth-tax-calendar')?>" id="filterForm" method="POST" >
                            <div class="row mb-10">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-4" for="actVal">Act :</label>
                                        <div class="col-md-6">
                                            <select class="custom-select form-control" id="actVal" name="actVal">
                                                <option value="">Select Act</option>
                                                <?php if(!empty($actArr)): ?>
                                                    <?php foreach($actArr AS $e_act): ?>
                                                        <option value="<?php echo $e_act['act_id']; ?>" <?= set_select('actVal', $e_act['act_id'], $e_act['act_id']==$actVal ? TRUE:FALSE) ?>><?php echo $e_act['act_name']; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-4" for="finYearVal">Financial Year :</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="finYearVal" name="finYearVal">
                                                <option value="">Select Financial Year</option>
                                                <?php for($h=$currentFinancialYear; $h>=2017; $h--): ?>
                                                    <?php $fnYr=$h."-".(substr($h+1, 2)); ?>
                                                    <option value="<?php echo $fnYr; ?>" <?php echo set_select('finYearVal', $fnYr, $finYearVal==$fnYr); ?> ><?php echo $fnYr; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-4" for="periodicityVal">Periodicity :</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="periodicityVal" name="periodicityVal">
                                                <option value="">Select Periodicity</option>
                                                <option value="2" <?php if($periodicityVal==2): ?> selected <?php endif; ?> >Monthly</option>
                                                <option value="3" <?php if($periodicityVal==3): ?> selected <?php endif; ?> >Quarterly</option>
                                                <option value="4" <?php if($periodicityVal==4): ?> selected <?php endif; ?> >Half Yearly</option>
                                                <option value="5" <?php if($periodicityVal==5): ?> selected <?php endif; ?> >Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <?php if(!empty($actVal)): ?>
                            <?php $isRecordsExists=false; ?>
                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                <thead>
                                    <tr class="row-1">
                                        <th class="column-1">Due Date For</th>
                                        <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                            <?php
                                                if($m_no<=9)
                                                    $m=$m_no+3;
                                                else
                                                    $m=$m_no-9;
                                            ?>
                                            <?php $mth_nm=date('M', strtotime("2021-".$m."-1")); ?>
                                            <th class="column-1"><?= $mth_nm; ?></th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody class="row-hover">
                                    <?php if(!empty($dueDateForArr)): ?>
                                        <?php foreach($dueDateForArr AS $k_row=>$e_row): ?>
                                        
                                            <?php $ddfId=$e_row['act_option_map_id']; ?>
                                            <?php $ddfName=$e_row['act_option_name']; ?>
                                            
                                            <?php if(in_array($ddfId, $ddfIDArr)): ?>
                                                <?php $isRecordsExists=true; ?>
                                                <?php
                                                    $dueDateForDataArray=$dueDateForDataArr[$ddfId];
                                                    
                                                    $ddfForm="";
                                                    $ddfSection="";
                                                    
                                                    if(!empty($dueDateForDataArray['due_date_form'])){
                                                        $ddfForm=$dueDateForDataArray['due_date_form'];
                                                    }
                                                    
                                                    if(!empty($dueDateForDataArray['due_date_section'])){
                                                        $ddfSection=$dueDateForDataArray['due_date_section'];
                                                    }
                                                ?>
                                                <tr class="row-2">
                                                    <td class="ddfColTd" nowrap>
                                                        <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $ddfName; ?>">
                                                            <?php
                                                                if(strlen($ddfName)>20)
                                                                {
                                                                    $ddfNameVar=substr($ddfName, 0, 20)."..";
                                                                }
                                                                else
                                                                {
                                                                    $ddfNameVar=$ddfName;
                                                                }
                                                            ?>
                                                            <span class="due_date_for_name">
                                                               <?= $ddfName; ?>
                                                            </span>
                                                        </a>
                                                        <br>
                                                        <span class="font-weight-bold">Form : </span><span><?= (!empty($ddfForm)) ? $ddfForm:"N/A"; ?></span>
                                                        <span class="font-weight-bold">Section : </span><span><?= (!empty($ddfSection)) ? $ddfSection:"N/A"; ?></span>
                                                    </td>
                                                    <?php for($mt_no=1;$mt_no<13;$mt_no++): ?>
                                                        <?php
                                                            if($mt_no<=9)
                                                                $mth=$mt_no+3;
                                                            else
                                                                $mth=$mt_no-9;
                                                        ?>
                                                        <td class="text-center">
                                                            <?php
                                                                $dueDate="-";
                                                                if(isset($dueDateForMthWiseArr[$ddfId][$mth]))
                                                                {
                                                                    $dueDateDataArr=$dueDateForMthWiseArr[$ddfId][$mth];
                                                                    
                                                                    $dueDateVal=$dueDateDataArr['extended_date'];
                                                                    
                                                                    if(check_valid_date($dueDateVal))
                                                                    {
                                                                        $dueDate=date("d.m.y", strtotime($dueDateVal));
                                                                    }
                                                                }
                                                                
                                                                echo $dueDate;
                                                            ?>
                                                        </td>
                                                    <?php endfor; ?>
                                                </tr>
                                                
                                            <?php endif; ?>
                                            
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php if(!$isRecordsExists): ?>
                                        <tr>
                                            <td colspan="13">
                                                <center>No records found :(</center>
                                            </td>
                                        <tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                                
                        <?php else: ?>
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <h4 class="text-center">
                                        Please select and submit.
                                    </h4>
                                </div>
                            </div>
                        <?php endif; ?>
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
<?= $this->section('javacript'); ?>
    <script src="<?= base_url('assets/js/tax-calendar-periodicity.js'); ?>"></script>
<?= $this->endSection(); ?>