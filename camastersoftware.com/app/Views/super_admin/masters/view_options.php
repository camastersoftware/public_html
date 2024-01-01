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
            padding: 0px 14px !important;
        }
        
        .btnPrimClr {
            margin-top: 5px !important;
            height: 30px !important;
            margin-bottom: 5px !important;
        }
        
        .table-responsive {
            overflow-x: hidden !important;
        }
        
        table.dataTable{
            margin-top: 0px !important;
        }
        
        .dt-buttons{
            display: block !important;
        }
    </style>

    <!-- Main content -->
    <section class="content mt-35">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-body text-center">
                        <h4>Act: <?php echo $actArr['act_name']; ?></h4>
                    </div>
                </div>

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
                            <a href="<?php echo base_url('superadmin/acts'); ?>">
    					        <button type="button" class="btn btn-sm btn-dark">Back</button>
                            </a>
    					</div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-4 offset-4">
                                    <table class="onlyTableId table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th><?php echo $pageSection; ?></th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center" width="5%">1</td>
                                                <td>Due Date For</td>
                                                <td class="text-center" width="5%">
                                                    <a href="<?php echo base_url('superadmin/act_options-'.$actId.'-1'); ?>">
                                                        <button class="btn btn-xs btn-success btnPrimClr" data-toggle="tooltip" data-original-title="Manage Options">
                                                            <i class="fa fa-list"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" width="5%">2</td>
                                                <td>Tax Payer</td>
                                                <td class="text-center" width="5%">
                                                    <a href="<?php echo base_url('superadmin/act_options-'.$actId.'-2'); ?>">
                                                        <button class="btn btn-xs btn-success btnPrimClr" data-toggle="tooltip" data-original-title="Manage Options">
                                                            <i class="fa fa-list"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" width="5%">3</td>
                                                <td>Under Section</td>
                                                <td class="text-center" width="5%">
                                                    <a href="<?php echo base_url('superadmin/act_options-'.$actId.'-3'); ?>">
                                                        <button class="btn btn-xs btn-success btnPrimClr" data-toggle="tooltip" data-original-title="Manage Options">
                                                            <i class="fa fa-list"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" width="5%">4</td>
                                                <td>Audit</td>
                                                <td class="text-center" width="5%">
                                                    <a href="<?php echo base_url('superadmin/act_options-'.$actId.'-4'); ?>">
                                                        <button class="btn btn-xs btn-success btnPrimClr" data-toggle="tooltip" data-original-title="Manage Options">
                                                            <i class="fa fa-list"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" width="5%">5</td>
                                                <td>Applicable Form</td>
                                                <td class="text-center" width="5%">
                                                    <a href="<?php echo base_url('superadmin/act_options-'.$actId.'-5'); ?>">
                                                        <button class="btn btn-xs btn-success btnPrimClr" data-toggle="tooltip" data-original-title="Manage Options">
                                                            <i class="fa fa-list"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" width="5%">6</td>
                                                <td>Condition</td>
                                                <td class="text-center" width="5%">
                                                    <a href="<?php echo base_url('superadmin/act_options-'.$actId.'-6'); ?>">
                                                        <button class="btn btn-xs btn-success btnPrimClr" data-toggle="tooltip" data-original-title="Manage Options">
                                                            <i class="fa fa-list"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12">
                                    <p>
                                        <span class="font-weight-bold">Note: </span>
                                        <span>For any changes contact Developer.</span>
                                    </p>
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
        <!-- /.row -->
    </section>
    <!-- /.content -->


<?= $this->endSection(); ?>