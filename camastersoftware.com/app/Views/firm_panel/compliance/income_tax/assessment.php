<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .box-p p {
        text-align: center !important;
        font-size: 16px !important;
    }
</style>


<!-- Main content -->
<section class="content mt-40">
    <div class="row"> 
        <div class="col-xl-9 col-lg-8 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="row"> 
                        <div class="col-xl-12 col-lg-12 col-12">
                            <div class="row">
                                <marquee>This is basic example of marquee</marquee>
                            </div>
                            <hr class="mt-0 mb-10">
                            <a href="<?php echo base_url('inc_menus'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-dark float-right">Back</button>
                            </a>
                        </div>
                        <div class="col-md-4 col-12 mt-20 text-justify-center">
                            <a href="<?php echo base_url('processing'); ?>">
                                <div class="box box-inverse box-primary box-card-home">
                                    <div class="box-body box-p">
                                        <p>Processing</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-12 mt-20"></div>
                        <div class="col-md-4 col-12 mt-20">
                            <a href="<?php echo base_url('scrutiny'); ?>"> 
                                <div class="box box-inverse box-primary box-card-home">
                                    <div class="box-body box-p">
                                        <p>Scrutiny</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-12 mt-20"></div>  
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-xl-3 col-lg-4 col-12">
            <?= view_cell('\App\Libraries\Utility::admin_menus'); ?>
		</div>
    </div>
</section>
<!-- /.content -->


<?= $this->endSection(); ?>