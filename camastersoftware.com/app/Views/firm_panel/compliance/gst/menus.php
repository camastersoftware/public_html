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
                            <a href="<?php //echo base_url('gst_tax_payment'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Tax Payments</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        -->
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('gst-return-register'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Returns Register</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('gst-assessee-ledger'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Assessee Ledger</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('processing'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Processing</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="javascript:void(0);"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Rectn-Refunds</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('scrutiny'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p nowrap class="not_in_use">Asst-Scrutiny</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('appeals'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Appeals</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('gst-mis-report'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">MIS Report</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="javascript:void(0);"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Outdoor Works</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="javascript:void(0);"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>-</p>
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