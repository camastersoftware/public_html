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
                    <a href="<?= base_url($secPrefixUrl.'-menus'); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right">Back</button>
                    </a>
                </div>
				<div class="box-body">
                    <div class="row">
                        <?php if(!empty($ddfArr)): ?>
                            <?php foreach($ddfArr AS $e_ddf): ?>
                            <?php if(!in_array($e_ddf['act_option_map_id'], INC_TAX_UPDATED_RETURN)): ?>
                                <div class="col-md-3 col-12 text-justify-center">
                                    <a href="<?php echo base_url($secPrefixUrl.'-ddf-pending/'.$e_ddf['act_option_map_id']); ?>">
                                        <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                            <div class="box-body box-p_new menu_box_new" data-toggle="tooltip" data-original-title="<?= $e_ddf['shortName']; ?>">
                                                <p class="wh_space_nowrp"><?= substr($e_ddf['shortName'], 0, 20); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if($updatedReturnExists): ?>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url($secPrefixUrl.'-ddf-pending/'.INC_TAX_UPDATED_RETURN[0]); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new" data-toggle="tooltip" data-original-title="Updated">
                                            <p class="wh_space_nowrp">Updated</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
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