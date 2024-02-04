<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>
<style>
    .box-card-parent {
        background-color: #005495 !important;
        padding: 4px !important;
        width: fit-content;
        /* border: 3px solid #f99d27 !important; */
    }

    .box-card-child {
        background-color: #6F8FAF !important;
        padding: 4px !important;
        /* border: 3px solid #f99d27 !important; */
    }

    .box-p_new_child p {
        text-align: center !important;
        font-size: 12px !important;
        font-weight: 900;
    }

    .custom-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
    }


    .custom-box {
        margin: 0 auto;
        /* Center the box horizontally */
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .custom-row {
        display: flex;
        justify-content: center;
        gap: 20px;
        /* Adjust the gap between items */
        flex-wrap: wrap;
    }

    .custom-col-md-2 {
        width: calc(20%);
        /* Ensure 5 items fit in one row */
        text-align: center;
    }

    /* Add any additional styles as needed */
</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">

        <div class="col-xl-1 col-lg-1 col-12">
        </div>
        <div class="col-xl-10 col-lg-10 col-12">

            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?php
                        if (isset($pageTitle))
                            echo $pageTitle;
                        else
                            echo "N/A";
                        ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('staff-administration'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="custom-container">
                        <?php if (!empty($getUserData)) : ?>
                            <?php foreach ($getUserData as $type => $ST_Row) : ?>
                                <div class="custom-box">
                                    <div class="box box-inverse box-card-parent p_clr">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p><?= $type; ?></p>
                                        </div>
                                    </div>

                                    <?php if (!empty($ST_Row)) : ?>
                                        <div class="custom-row">
                                            <?php
                                            $count = count($ST_Row);
                                            $colClass = 'custom-col-md-4';

                                            foreach ($ST_Row as $user_Row) :
                                            ?>
                                                <div class="<?= $colClass; ?>">
                                                    <div class="box box-inverse box-card-child p_clr">
                                                        <div class="box-body box-p_new menu_box_new">
                                                            <p><?= $user_Row['userFullName']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>



                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-xl-1 col-lg-1 col-12">
        </div>

        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->


<?= $this->endSection(); ?>