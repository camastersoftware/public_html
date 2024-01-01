
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
    
    .ddfColTd{
        height: 50px !important;
    }
    
    .ddfColTd span{
        font-size: 13px !important;
        color: #000 !important;
    }
    
    thead tr th.mthHead, tbody tr td.mthData {
        min-width: 50px !important;
        max-width: 50px !important;
    }
    
    .extDueDateDiv{
        padding: 0px !important;
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
                            <a href="<?= base_url('superadmin/home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?=base_url('superadmin/extended-due-dates')?>" id="filterForm" method="POST" >
                            <div class="row mb-10">
                                <div class="col-md-5">
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
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label class="col-md-4" for="ddYrVal">Due Date Year :</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="ddYrVal" name="ddYrVal">
                                                <option value="">Select Due Date Year</option>
                                                <?php for($h=$currentFinancialYear; $h>=2017; $h--): ?>
                                                    <?php $fnYr=$h."-".(substr($h+1, 2)); ?>
                                                    <option value="<?php echo $fnYr; ?>" <?php echo set_select('ddYrVal', $fnYr, $ddYrVal==$fnYr); ?> ><?php echo $fnYr; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <?php if(!empty($actVal)): ?>
                            <?php $isRecordsExists=false; ?>
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable no-footer mt-20">
                                        <thead>
                                            <tr class="row-1">
                                                <th class="column-1">Due Date For</th>
                                                <th class="column-1">P'city</th>
                                                <?php for($ext_no=0;$ext_no<=12;$ext_no++): ?>
                                                    <th class="column-1 mthHead"><?= ($ext_no==0) ? "Original" : "Extn ".$ext_no; ?></th>
                                                <?php endfor; ?>
                                            </tr>
                                        </thead>
                                        <tbody class="row-hover">
                                            <?php if(!empty($dueDateForDataArr)): ?>
                                                <?php foreach($dueDateForDataArr AS $k_row=>$e_row): ?>
                                                
                                                    <?php $ddfName=$e_row['due_date_for_name']; ?>
                                                    <?php $ddfPrd=$e_row['period']; ?>
                                                    <?php $prdCtyName=$e_row['periodcity_short_name']; ?>
                                                    
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
                                                                <span class="due_date_for_name font-weight-bold">
                                                                   <?= $ddfName; ?>
                                                                </span>
                                                            </a>
                                                            <br>
                                                            <span class="font-weight-bold">Period : </span><span><?= (!empty($ddfPrd)) ? $ddfPrd:"N/A"; ?></span>
                                                        </td>
                                                        <td class="text-center"><?= $prdCtyName; ?></td>
                                                        <?php for($ext=0;$ext<=12;$ext++): ?>
                                                            <?php
                                                                $dueDate="-";
                                                                $dueDateDoc="";
                                                                $dueDateNote="";
                                                                if(isset($dueDateForExtDatesArr[$k_row][$ext]))
                                                                {
                                                                    $dueDateDataArr=$dueDateForExtDatesArr[$k_row][$ext];
                                                                    
                                                                    $dueDateVal=$dueDateDataArr['date'];
                                                                    $dueDateDoc=$dueDateDataArr['file'];
                                                                    $dueDateNote=htmlspecialchars_decode(html_entity_decode($dueDateDataArr['note']));
                                                                    
                                                                    if(check_valid_date($dueDateVal))
                                                                    {
                                                                        $dueDate=date("d.m.y", strtotime($dueDateVal));
                                                                    }
                                                                }
                                                            ?>
                                                            <td class="mthData extDueDateDiv">
                                                                <div class="form-group">
                                                                    <div class="col-md-12 text-center">
                                                                        <?= $dueDate; ?>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <?php if(!empty($dueDateDoc)): ?>
                                                                            <a class="dropdown-item text-danger" href="<?php echo base_url("uploads/admin/due_date/".$dueDateDoc); ?>" target="_blank">
                                                                                <i class="fa fa-file"></i>
                                                                            </a>
                                                                        <?php endif; ?>
                                                                        <?php if(!empty($dueDateNote)): ?>
                                                                            <a class="dropdown-item text-info" href="javascript:void(0);" data-toggle="modal" data-target="#modal_view<?= $k_row; ?>">
                                                                                <i class="fa fa-eye"></i>
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="modal_view<?= $k_row; ?>" tabindex="-1">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Notes</h5>
                                                                                <button type="button" class="close" data-dismiss="modal">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?php if(!empty($dueDateNote)): ?>
                                                                                    <p>
                                                                                        <?php echo $dueDateNote; ?>
                                                                                    </p>
                                                                                <?php else: ?>
                                                                                    N/A
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="modal-footer text-right">
                                                                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal -->
                                                            </td>
                                                        <?php endfor; ?>
                                                    </tr>
                                                    
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="15">
                                                        <center>No records found :(</center>
                                                    </td>
                                                <tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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