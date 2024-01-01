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
        font-size: 13px;
    }
    
    .tablepress tbody {
        font-size: 13px;
    }
    
    td.column-1 {
        text-align: center;
        font-weight: normal;
        font-size: 13px;
    }
    
    .tablepress tbody tr:first-child td {
        background: none;
    }
    
    .tablepress tbody tr:nth-child(4) td.column-1 {
        background: none;
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
        font-size: 16px !important;
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
    
    .row-1 td{
        text-align: center !important;
    }
</style>
<?php $s_time = strtotime("2019-12-01"); ?>
<!-- Main content -->
<section class="content mt-40">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h4 class="box-title"><?php echo $pageTitle; ?></h4>
                    <a href="<?php echo base_url('home'); ?>"><button type="button" class="waves-effect waves-light btn btn-dark float-right" style="">Back</button></a>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body">
                <?php
                    $currFinYr=substr($sessDueDateYear,0, 4);
                ?>
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
                                <span class="hidden-xs-down year-color"><?php echo date('F', strtotime("2021-".$m."-1")); ?></span>
                            </a>
                        </li>	
                        <?php endfor; ?>
                    </ul>
                    <div class="tab-content tabcontent-border p-15" id="myTabContent">
                        <?php for($mth=1;$mth<13;$mth++): ?>
                        <?php $mth_nm=strtolower(date('M', strtotime("2021-".$mth."-1"))); ?>
                        <div class="tab-pane fade table-responsive <?php if($mth==$currMth): ?>show active<?php endif; ?>" id="<?php echo $mth_nm; ?>_tab" role="tabpanel" aria-labelledby="<?php echo $mth_nm; ?>-tab">
                            <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                    <thead>
                                        <tr class="row-1">
                                            <th class="column-1">Sr</th>
                                            <th class="column-2">Due</th>
                                            <th class="column-2">Group</th>
                                            <th class="column-3">Name of the Client</th>
                                            <th class="column-3">Act</th>
                                            <th class="column-3">Due Date</th>
                                            <th class="column-4">DOC</th>
                                            <th class="column-5" colspan="2">ALLOTED TO</th>
                                            <th class="column-6" colspan="2">COMPELTED</th>
                                            <th class="column-7">SET</th>
                                        </tr>
                                        <tr class="row-1">
                                            <th class="column-1">No</th>
                                            <th class="column-2">Date</th>
                                            <th class="column-2">No</th>
                                            <th class="column-3"></th>
                                            <th class="column-3"></th>
                                            <th class="column-3">For</th>
                                            <th class="column-4">RECD</th>
                                            <th class="column-5">JUNIOR</th>
                                            <th class="column-6">SENIOR</th>
                                            <th class="column-7">%</th>
                                            <th class="column-8">ON</th>
                                            <th class="column-9">BY</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-hover">
                                        <tr class="row-1 text-center">
                                            <td class="column-1">
                                                1
                                            </td>
                                            <td class="column-2">
                                                01-11-2021
                                            </td>
                                            <td class="column-2">
                                                ABC
                                            </td>
                                            <td class="column-3">
                                                Test Name
                                            </td>
                                            <td class="column-4">
                                                Test
                                            </td>
                                            <td class="column-4">
                                                Test
                                            </td>
                                            <td class="column-5">
                                                Yes
                                            </td>
                                            <td class="column-6">
                                                juniors
                                            </td>
                                            <td class="column-7">
                                                seniorName
                                            </td>
                                            <td class="column-8">
                                                100
                                            </td>
                                            <td class="column-9"></td>
                                            <td class="column-10"></td>
                                        </tr>
                                    </tbody>
                                </table>
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