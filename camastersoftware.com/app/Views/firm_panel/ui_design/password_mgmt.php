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
                        <div class="text-right flex-grow">
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('admin/home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right font-weight-bold" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row"> 
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/gst_login_password'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>GST </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/income_tax_login_password'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Income Tax </p>
                                        </div>
                                    </div>
                                </a>
                            </div> 
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/tds_login_password'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>TDS</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/company_act_Lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Company Act</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/llp_act_Lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>LLP Act</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/profession_tax_lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Profession Tax </p>
                                        </div>
                                    </div>
                                </a>
                            </div> 
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/partnership_act_Lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Partnership Act </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/co_op_society_Lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Co-Op Society</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/trust_act_Lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Trust Act </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/shop_est_act_Lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Shop Establishment</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/msme_act_Lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>MSME</p>
                                        </div>
                                    </div>
                                </a>
                            </div> 
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/trade_mark_Lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Trade Mark</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/tcs_act_Lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>TCS Act </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/others_act_Lp'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Others </p>
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