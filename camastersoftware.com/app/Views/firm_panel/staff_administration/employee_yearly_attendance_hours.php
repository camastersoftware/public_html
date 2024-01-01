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
        font-size: 12px;
    }
    
    .tablepress tbody {
        font-size: 12px;
    }
    
    td.column-1 {
        font-weight: normal;
        font-size: 12px;
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
    
    .theme-primary .btnPrimClr {
        margin-top: 0px !important;
        height: 25px !important;
        margin-bottom: 0px !important;   
    }
    
    .addExpBtn{
        cursor: pointer !important;
    }
    
    .removeExpBtn{
        cursor: pointer !important;
    }
    
    .ordAnlyInput{
        width: 300px !important;
        font-size: 12px !important;
    }
    
    input:not(.ordAnlyInput){
        width: 100% !important;
        font-size: 11px !important;
        text-align: right !important;
    }
    
    tr.row-1 td:first-child {
        /*text-align: left !important;*/
        font-weight: bold !important;
        font-size: 16px !important;
    }
    
    .divLine td{
        background-color: #005495 !important;
    }
    
    .no_bold{
        font-weight: 400 !important;
    }
    
    .tablepress td, .tablepress th {
        padding: 3px !important;
    }
    
</style>
<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox text-center">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle." : ".$getUserData['userFullName']." (Hours Worked)"; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('employee-yearly-attendance/'.$userId); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">In ST/ET</button>
                        </a>
                        &nbsp;&nbsp;
                        <a href="<?php echo base_url('emp-attendance'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="row"> 
                        <div class="col-12">
                            <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                        <thead>
                                            <tr class="row-1">
                                                <th class="column-1" nowrap>Date & Month</th>
                                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                                    <?php
                                                        if($m_no<=9)
                                                            $m=$m_no+3;
                                                        else
                                                            $m=$m_no-9;
                                                    ?>
                                                    <?php $mth_nm=date('M', strtotime("2023-".$m."-1")); ?>
                                                    <th class="column-1" width="8%"><?= $mth_nm; ?></th>	
                                                <?php endfor; ?>
                                            </tr>
                                        </thead>
                                        <tbody class="row-hover">
                                            <?php for($d_no=1;$d_no<=31;$d_no++): ?>
                                                <tr class="row-1">
                                                    <td class="column-1 text-center">
                                                        <?php $dayVal = add_leading_zero($d_no); ?>
                                                        <?= $dayVal; ?>
                                                    </td>
                                                    <?php for($mth_no=1;$mth_no<13;$mth_no++): ?>
                                                        <?php
                                                            if($mth_no<=9)
                                                            {
                                                                $mth=$mth_no+3;
                                                                $yr=$fromYr;
                                                            }
                                                            else
                                                            {
                                                                $mth=$mth_no-9;
                                                                $yr=$toYr;
                                                            }
                                                            $mthNo = add_leading_zero($mth);
                                                            
                                                            $dateVal = $yr."-".$mthNo."-".$dayVal;
                                                            
                                                            $dayNo="";
                                                            
                                                            if(in_array($dateVal, $generatedDateArr))
                                                            {
                                                                $dayNo=date('N', strtotime($dateVal));
                                                            }
                                                        ?>
                                                        <td class="column-1" width="8%" <?php if(in_array($dateVal, $holidayDateArr) || $dayNo==6 || $dayNo==7): ?>style="background: #00549545 !important;"<?php endif; ?>>
                                                            <?php
                                                                $totalHoursVal = "";
                                                                if(isset($empAttendDataArr[$dateVal]))
                                                                {
                                                                    $empAttendData=$empAttendDataArr[$dateVal];
                                                                    
                                                                    if(!empty($empAttendData['totalHours']))
                                                                    {
                                                                        $totalHoursVal = $empAttendData['totalHours'];
                                                                    }
                                                                    else
                                                                    {
                                                                        $totalHoursVal = "";
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $totalHoursVal = "";
                                                                }
                                                            ?>
                                                            <span class="<?php if(!empty($totalHoursVal) && $totalHoursVal<8): ?>text-danger<?php endif; ?>"><?= (!empty($totalHoursVal)) ? $totalHoursVal:"-"; ?></span>
                                                        </td>
                                                    <?php endfor; ?>
                                                </tr>
                                            <?php endfor; ?>
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