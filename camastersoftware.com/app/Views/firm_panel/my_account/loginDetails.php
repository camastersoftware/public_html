<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

    <style>
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
            padding: 8px 14px !important;
        }
        
        .btnPrimClr {
            margin-top: 5px !important;
            height: 30px !important;
            margin-bottom: 5px !important;
        }
        
        .simpleDtTable{
            margin-top: 10px !important;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box mt-35">
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
                            <a href="<?php echo base_url('myDetails'); ?>">
                                <button type="button" class="btn btn-sm btn-dark" >Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="table-responsive">
                                    <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th>Staff&nbsp;Name</th>
                                                <th>Staff&nbsp;Type</th>
                                                <th>Designation</th>
                                                <th width="5%">Username</th>
                                                <th width="5%">Password</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($userDataArr)): ?>
                                                <?php $i=1; ?>
                                                <?php foreach($userDataArr AS $e_row): ?>
                                                    <?php if($e_row['userStaffType']!=6): ?>
                                                    <tr>
                                                        <td class="text-center" width="5%"><?php echo $i; ?></td>
                                                        <td nowrap>
                                                            <?php echo $e_row['userFullName']; ?>
                                                        </td>
                                                        <td nowrap class="text-center">
                                                            <?php echo $e_row['staff_type_name']; ?>
                                                        </td>
                                                        <td nowrap class="text-center">
                                                            <?php echo $e_row['userDesgn']; ?>
                                                        </td>
                                                        <td class="text-center" nowrap width="5%">
                                                            <?php 
                                                                if($e_row['userStaffType']!=6)
                                                                {
                                                                    if(!empty($e_row['userLoginName']))
                                                                        echo $e_row['userLoginName']; 
                                                                    else
                                                                        echo "N/A"; 
                                                                }
                                                                else
                                                                {
                                                                    echo "N/A"; 
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="text-center" nowrap width="5%">-</td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6"><center>No records</center></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row staff_tbl">
                            <div class="col-md-8 offset-md-2 text-center">
                                <h3 class="proj_txt_clr">Support Staff (Without Login)</h3>
                            </div>
                            <div class="col-md-8 offset-md-2">
                                <div class="table-responsive">
                                    <table class="simpleDtTable table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th>Staff&nbsp;Name</th>
                                                <th>Staff&nbsp;Type</th>
                                                <th>Designation</th>
                                                <th width="5%">Username</th>
                                                <th width="5%">Password</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($userDataArr)): ?>
                                                <?php $i=1; ?>
                                                <?php foreach($userDataArr AS $e_row): ?>
                                                    <?php if($e_row['userStaffType']==6): ?>
                                                    <tr>
                                                        <td class="text-center" width="5%"><?php echo $i; ?></td>
                                                        <td nowrap>
                                                            <?php echo $e_row['userFullName']; ?>
                                                        </td>
                                                        <td nowrap class="text-center">
                                                            <?php echo $e_row['staff_type_name']; ?>
                                                        </td>
                                                        <td nowrap class="text-center">
                                                            <?php echo $e_row['userDesgn']; ?>
                                                        </td>
                                                        <td class="text-center" nowrap width="5%">N/A</td>
                                                        <td class="text-center" nowrap width="5%">-</td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6"><center>No records</center></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-8 offset-md-2">
                                <br>
                                <p>
                                    <span class="font-weight-bold">Note: </span>
                                    <span>Passwords are encrypted hence they are not visible.</span>
                                </p>
                            </div>
                        </div>

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
    
    <script>
        $(document).ready(function(){
            
            setTimeout(function () {
                $('.staff_tbl .dt-buttons').remove();
                
                var tblCss = $('.simpleDtTable').attr('style');
                $('.simpleDtTable').attr('style', tblCss+";margin-top: 10px !important");
            }, 1000);
            
        });
    </script>

<?= $this->endSection(); ?>