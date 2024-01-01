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
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row"> 
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('contactList'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p>Contacts</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('todolist'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p>To Do List</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('reminder'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p>Reminders</p>
                                        </div>
                                    </div>
                                </a>
                            </div> 
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('holidays'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p>Holiday List</p>
                                        </div>
                                    </div>
                                </a>
                            </div> 
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('announcements'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p>Announcements</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('letter-reference-list'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p>Letter Reference</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('certificate-reference-list'); ?>" data-toggle="tooltip" data-title="Certificate Reference">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p>Certificate Ref.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('membership-sub-list'); ?>" data-toggle="tooltip" data-title="Membership & Subscriptions">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p>Membership & Sub.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('general-password-list'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr card_box_shape">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p>General Passwords</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-xl-2 col-lg-2 col-12"> 
                <?= view_cell('\App\Libraries\Utility::admin_menus'); ?>
    		</div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


<?= $this->endSection(); ?>