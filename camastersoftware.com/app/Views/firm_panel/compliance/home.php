<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content mt-35">
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
                            <a href="javascript:void(0);">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p menu_box">
                                        <p class="font-weight-500 not_in_use">Accounts</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('inc_tax_section'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p menu_box">
                                        <p class="font-weight-500">Income Tax</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('gst_menus'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p menu_box">
                                        <p class="font-weight-500">GST</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="javascript:void(0);"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p menu_box">
                                        <p class="font-weight-500 not_in_use">Profession Tax</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="javascript:void(0);"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p menu_box">
                                        <p class="font-weight-500 not_in_use">Companies Act</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="javascript:void(0);">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p menu_box">
                                        <p class="font-weight-500 not_in_use">LLP Act</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="javascript:void(0);"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p menu_box">
                                        <p class="font-weight-500 not_in_use">Partnership Act</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('oth_act_menus'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p menu_box">
                                        <p class="font-weight-500 not_in_use">Other Acts</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
				</div>
			</div> 
		</div>
		<div class="col-xl-2 col-lg-2 col-12">
            <?= view_cell('\App\Libraries\Utility::admin_menus'); ?>
		</div> 
	</div>
</section>
<!-- /.content -->


<?= $this->endSection(); ?>