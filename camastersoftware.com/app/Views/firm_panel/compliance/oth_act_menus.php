<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
		<div class="col-xl-2 col-lg-2 col-12">
            <?= view_cell('\App\Libraries\Utility::left_side_menu'); ?>
		</div> 
		<div class="col-xl-8 col-lg-8 col-12">
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
                    <!--
                    <a href="<?php //echo base_url('admin/compliance'); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                    </a>
                    -->
                </div>
				<div class="box-body">
                    <div class="row">
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('partnership-firms'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="font-weight-500 not_in_use">Partnership Firms</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('co_op_soc_menus'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="font-weight-500 not_in_use">Co-Op Society</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('trust_menus'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="font-weight-500 not_in_use">Trust Act</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('shop_est_menus'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p_new menu_box_new" style="padding-left: 7px;">
                                        <p class="font-weight-500 not_in_use" nowrap>Shops&nbsp;&&nbsp;Est.</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        <!--
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php //echo base_url('msme_menus'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="font-weight-500 not_in_use">MSME</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                         -->
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('trade-mark'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="font-weight-500 not_in_use">Trade Marks</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('labour_laws_menus'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="font-weight-500 not_in_use">Labour Laws</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        <!--
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php //echo base_url('fema_menus'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="font-weight-500 not_in_use">FEMA</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        -->
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