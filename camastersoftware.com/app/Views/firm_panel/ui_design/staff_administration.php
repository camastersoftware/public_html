<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

    <!-- Main content -->
    <section class="content mt-55">
        <div class="row">

            <div class="col-xl-10 col-lg-10 col-12">

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
                                <a href="<?php echo base_url('admin/staff_attendance_tbl'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Staff Attendance</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-12 text-justify-center">
                                <a href="<?php echo base_url('admin/employeewise_salary_list'); ?>">
                                    <div class="box box-inverse box-primary box-card-home box-card-clr p_clr">
                                        <div class="box-body box-p menu_box">
                                            <p>Employeewise Salary</p>
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