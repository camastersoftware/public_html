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
                    <a href="<?= base_url('inc_menus'); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                    </a>
                </div>
				<div class="box-body">
                    <div class="row">
                        <?php if(!empty($ddfArr)): ?>
                            <?php foreach($ddfArr AS $e_ddf): ?>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('it-tax-audits/'.$e_ddf['act_option_map_id']); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p class="wh_space_nowrp"><?= $e_ddf['shortName']; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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