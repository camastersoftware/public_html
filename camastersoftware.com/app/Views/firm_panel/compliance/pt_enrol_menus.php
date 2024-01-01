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
                    <a href="<?php echo base_url('pt_menus'); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                    </a>
                </div>
				<div class="box-body">
                    <div class="row">
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('pt-enrol-payments'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>Payments</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('pt-enrol-ledger'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>Ledger</p>
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