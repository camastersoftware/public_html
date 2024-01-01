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
        text-align: left !important;
        /*font-weight: bold !important;*/
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
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold">
                                <?= $pageTitle; ?>
                            </h4>
                        </div>
                        <div class="col-6 text-right">
                            <select class="custom-select form-control col-md-3" id="selMthAttend">
                                <option value="">Select Month</option>
                                <?php for($m_no=1;$m_no<13;$m_no++): ?>
                                    <?php
                                        if($m_no<=9)
                                        {
                                            $m=$m_no+3;
                                            $yr=$fromYr;
                                        }
                                        else
                                        {
                                            $m=$m_no-9;
                                            $yr=$toYr;
                                        }
                                    ?>
                                    <option value="<?php echo $m; ?>" <?php if($m==$mth): ?>selected<?php endif; ?> ><?php echo date('F', strtotime("2021-".$m."-1"))."-".$yr; ?></option>
                                <?php endfor; ?>
                            </select>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('emp-attendance'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">Employees Attendance</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('all-employees-attendance-hours/'.$mth); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_top">In Hours</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('emp-attendance'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right mt-1" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <div class="row"> 
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1">Employee Name/<br>Day</th>
                                            <th class="column-1"></th>
                                            <?php if(!empty($generatedDateArr)): ?>
                                                <?php foreach($generatedDateArr AS $e_date): ?>
                                                    <?php $dayNo=date('d', strtotime($e_date)); ?>
                                                    <?php $dayName=date('D', strtotime($e_date)); ?>
                                                    <th class="column-1" width="8%"><?= $dayNo."<br>".$dayName; ?></th>	
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">
                                        <?php if(!empty($getUserData)): ?>
                                            <?php foreach($getUserData AS $e_usr): ?>
                                                <?php $userId=$e_usr['userId']; ?>
                                                <?php $userFullName=$e_usr['userShortName']; ?>
                                                <tr class="row-1" width="7%">
                                                    <td class="column-1 text-center">
                                                        <?= $userFullName; ?>
                                                    </td>
                                                    <td class="column-1" width="3%">
                                                        ST<br>
                                                        ET
                                                    </td>
                                                    <?php if(!empty($generatedDateArr)): ?>
                                                        <?php foreach($generatedDateArr AS $e_dt): ?>
                                                            <?php $dayNo=date('N', strtotime($e_dt)); ?>
                                                            <td class="column-1" nowrap width="2.9%" <?php if(in_array($e_dt, $holidayDateArr) || $dayNo==6 || $dayNo==7): ?>style="background: #00549545 !important;"<?php endif; ?>>
                                                                <?php
                                                                    if(isset($empAttendDataArr[$userId][$e_dt]))
                                                                    {
                                                                        $empAttendData=$empAttendDataArr[$userId][$e_dt];
                                                                        
                                                                        if(!empty($empAttendData['inTime']))
                                                                        {
                                                                            echo date('h:i A', strtotime($empAttendData['inTime']));
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "-";
                                                                        }
                                                                        
                                                                        echo "<br>";
                                                                        
                                                                        if(!empty($empAttendData['outTime']))
                                                                        {
                                                                            echo date('h:i A', strtotime($empAttendData['outTime']));
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "-";
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "-<br>-";
                                                                    }
                                                                ?>
                                                            </td>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12">
                                        <span>ST : Start Time</span></br>
                                        <span>ET : End Time</span>
                                    </div>
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

<script>
    $(document).ready(function(){
        
        var selMth = "<?= $mth; ?>";
        
        $('#selMthAttend').on('change', function () {
            
            var base_url = "<?php echo base_url(); ?>";
            var mth = $(this).val();

            window.location.href=base_url+"/all-employees-attendance/"+mth;
        });
    });
</script>
<?= $this->endSection(); ?>