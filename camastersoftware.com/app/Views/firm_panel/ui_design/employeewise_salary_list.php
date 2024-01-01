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
                            <a href="<?php echo base_url('admin/myDetails'); ?>">
                                <button type="button" class="btn btn-sm btn-dark" >Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row staff_tbl">
                            <div class="col-md-8 offset-md-2 text-center">
                                <h3 class="proj_txt_clr">Staff List</h3>
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
                                                <th width="5%">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center" width="5%">1</td>
                                                <td nowrap>Ulhas Agnihotri</td>
                                                <td nowrap class="text-center">Owner</td>
                                                <td nowrap class="text-center">Chartered Accountant</td>
                                                <td class="text-center" nowrap width="5%">
                                                    <div class="btn-group">
                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                            <a class="dropdown-item" href="<?php echo base_url('admin/salary_calculation'); ?>" ><i class="fa fa-eye"></i>&nbsp;Salary Calculation</a>
                                                            <a class="dropdown-item" href="<?php echo base_url('admin/credited_salary'); ?>" ><i class="fa fa-eye"></i>&nbsp;Credited Salary</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" width="5%">2</td>
                                                <td nowrap>Jayashree Agnihotri</td>
                                                <td nowrap class="text-center">Owner</td>
                                                <td nowrap class="text-center">Chartered Accountant</td>
                                                <td class="text-center" nowrap width="5%">
                                                    <div class="btn-group">
                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                            <a class="dropdown-item" href="<?php echo base_url('admin/salary_calculation'); ?>" ><i class="fa fa-eye"></i>&nbsp;Salary Calculation</a>
                                                            <a class="dropdown-item" href="<?php echo base_url('admin/credited_salary'); ?>" ><i class="fa fa-eye"></i>&nbsp;Credited Salary</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- <div class="col-md-8 offset-md-2">
                                <br>
                                <p>
                                    <span class="font-weight-bold">Note: </span>
                                    <span>Passwords are encrypted hence they are not visible.</span>
                                </p>
                            </div> -->
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