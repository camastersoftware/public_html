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
                </div>
				<div class="box-body">
                    <div class="row">
                        <?php if(!empty($ddTypeArr)): ?>
                            <?php foreach($ddTypeArr AS $e_ddt): ?>
                                <div class="col-md-3 col-12 text-justify-center">
                                    <a href="<?php echo base_url($secPrefixUrl.'-ddf/'.$e_ddt['dueDateTypeId']); ?>">
                                        <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                            <div class="box-body box-p_new menu_box_new">
                                                <p><?= $e_ddt['dueDateTypeName']; ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <!--
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php //echo base_url('company_returns'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>Company Returns</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php //echo base_url('company_audits'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>Statutory Audits</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php //echo base_url('get-dir-three-kyc-clients'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>DIR-3 KYC</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        -->
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="javascript:void(0);"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>Tax Payments</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('company-return-filed-register'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Registers</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('company-master-details'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>Master Details</p>
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