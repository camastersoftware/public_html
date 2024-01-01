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
                    <a href="<?php echo base_url('it-menus'); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                    </a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('appeal-level-1'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">CIT (Appeal)</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('appeal-level-2'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Appeal-ITAT</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('appeal-level-3'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Appeal-High Court</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('appeal-level-4'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p nowrap class="not_in_use">Appeal-SC</p>
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