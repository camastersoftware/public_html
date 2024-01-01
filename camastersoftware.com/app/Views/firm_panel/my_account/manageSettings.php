<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .card_box_shape {
      border-radius: 10px !important;
    }
</style>

<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
		<div class="col-xl-12 col-lg-12 col-12">
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
                    <a href="<?= base_url('home'); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                    </a>
                </div>
				<div class="box-body">
                    <div class="row">
                        <div class="col-md-2 col-12 text-justify-center">
                            <a href="<?php echo base_url('announcement-settings'); ?>">
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>Announcements</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-12 text-justify-center">
                            <a href="<?php echo base_url('hr-settings'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                    <div class="box-body box-p_new menu_box_new">
                                        <p>HR Related</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
				</div>
			</div> 
		</div>
	</div>
</section>
<!-- /.content -->


<?= $this->endSection(); ?>