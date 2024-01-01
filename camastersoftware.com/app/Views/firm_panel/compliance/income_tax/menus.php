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
                    <a href="<?php //echo bas   e_url('admin/inc_tax_section'); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                    </a>
                    -->
                </div>
				<div class="box-body">
                    <div class="row">
                        <?php if(!empty($ddTypeArr)): ?>
                            <?php foreach($ddTypeArr AS $e_ddt): ?>
                                <div class="col-md-3 col-12 text-justify-center">
                                    <a href="<?php echo base_url($secPrefixUrl.'-ddf/'.$e_ddt['dueDateTypeId']); ?>">
                                        <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                            <div class="box-body box-p_new menu_box_new">
                                                <p style="white-space: nowrap;">
                                                    <?= ($e_ddt['dueDateTypeId']==1) ? $section : ""; ?>
                                                    <?= $e_ddt['dueDateTypeName']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <!--
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php //echo base_url('inc-tax-returns-ddf'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="wh_space_nowrp">Income Tax Returns</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php //echo base_url('inc-tax-statements-ddf'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Stmt cum Challan</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php //echo base_url('inc-tax-forms-ddf'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Forms</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php //echo base_url('inc-tax-audits-ddf'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>Tax Audits</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        -->
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('inc_tax_payments'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>Tax Payments</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('return_filed_register'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Returns Register</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('inc_tax_assessee_ledger'); ?>"> 
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
                            <a href="<?php echo base_url('income_tax_refunds'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Refunds</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('income-tax-demands'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Demands</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('rectification'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Rectification</p>
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
                            <a href="<?php echo base_url('appeal-menu'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Appeals</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php echo base_url('inc_tax_mis_menu'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>MIS Report</p>
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
                        <!--
                        <div class="col-md-3 col-12 text-justify-center">
                            <a href="<?php //echo base_url('inc-tax-certificates'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p class="not_in_use">Certificates</p>
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