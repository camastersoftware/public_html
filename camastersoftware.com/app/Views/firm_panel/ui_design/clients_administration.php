<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

    <!-- Main content -->
    <section class="content mt-55">
        <div class="row">

            <div class="col-xl-10 col-lg-10 col-12">

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
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row"> 
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/din_digital_sign'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>DIN-DSC</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/password_mgmt'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Password Mgmt</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-xl-2 col-lg-2 col-12"> 
                <?= view_cell('\App\Libraries\Utility::admin_menus'); ?>
    		</div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


<?= $this->endSection(); ?>