<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

    <!-- Main content -->
    <section class="content mt-40">
        <div class="row">

            <div class="col-xl-10 col-lg-10 col-12">

                <div class="box">
                    <div class="box-header with-border flexbox">
                        <h3 class="box-title">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="row"> 
                            <div class="col-xl-12 col-lg-12 col-12">
                                <div class="row">
                                    <marquee>This is basic example of marquee</marquee>
                                </div>
                                <hr class="mt-0 mb-0">
                            </div>
                            <div class="col-md-4 col-12 mt-20 text-justify-center">
                                <a href="<?php echo base_url('superadmin/tax_calendar'); ?>">
                                    <div class="box box-inverse box-primary box-card-home">
                                        <div class="box-body box-p">
                                            <p>Tax Calendar</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-12 mt-20"></div>
                            <div class="col-md-4 col-12 mt-20">
                                <div class="box box-inverse box-primary box-card-home">
                                    <div class="box-body box-p">
                                        <p>Master Data</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12 mt-20"></div>
                            <div class="col-md-4 col-12 mt-20">
                                <div class="box box-inverse box-primary box-card-home">
                                    <div class="box-body box-p">
                                        <p>Client Report</p>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-xl-2 col-lg-2 col-12"> 
                <?= view_cell('\App\Libraries\Utility::sup_admin_menus'); ?>
                
    			<!--<div class="box no-border no-shadow mt">-->
    			<!--	<div class="box-header with-border">-->
    			<!--		<h4 class="box-title">Reports</h4>-->
    			<!--	</div>-->
    			<!--	<div class="box-body p-0">-->
    					<!-- the events -->
    			<!--		<div id="external-events">-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-primary" >-->
       <!--                         <a href="<?php //echo base_url('master_data'); ?>">Master Data</a>-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-warning" >Search Client-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-info" >Wp-Combined-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-success" >New Registration</div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-danger" >Income Tax-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-danger" >Goods & Services-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-danger" >Tax Deducted at Source-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-danger" >Advance Tax-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-danger" >Companies Act-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5 " data-class="bg-danger" >Limited Liability partnership-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-danger" >Profeession Tax-(R)-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5 " data-class="bg-danger" >Profeession Tax-(E)-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-danger" >Partnership Act-->
       <!--                     </div>-->

       <!--                     <div class="external-event1 pt-5 pb-5" data-class="bg-danger" >Accounts-->
       <!--                     </div>-->

       <!--                 </div>-->
    			<!--	</div>-->
    			<!--</div>-->
    		</div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


<?= $this->endSection(); ?>