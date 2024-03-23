<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>
<style>
    .box-card-parent {
        background-color: #005495 !important;
        padding: 4px !important;
        /* border: 3px solid #f99d27 !important; */
    }

    .box-card-child {
        background-color: #6F8FAF !important;
        padding: 3px !important;
        /* border: 3px solid #f99d27 !important; */
    }
    .box-p_new_child p {
    text-align: center !important;
    font-size: 12px !important;
    font-weight: 900;
}
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
                    <div class="row">

                        <?php if (!empty($getUserData)) : ?>
                            <?php foreach ($getUserData  as $type => $ST_Row) : ?>
                                <div class="col-md-12 col-12 text-justify-center">
                                    <div class="box box-inverse  box-card-parent p_clr ">
                                        <div class="box-body box-p_new menu_box_new">
                                            <p><?= $type;  ?></p>
                                        </div>
                                    </div>

                                    <?php if (!empty($ST_Row)) : ?>
                                        <div class="row">
                                            <?php
                                            $count = count($ST_Row);
                                            $colClass = ($count == 2 || $count == 1) ? 'col-md-4 col-12 text-justify-center' : 'col-md-2 col-12 text-justify-center';

                                            foreach ($ST_Row  as $user_Row) : ?>
                                             <?php if ($count == 1) : ?>
                                                    <div class="col-md-5 col-12 text-justify-center"></div>
                                                <?php endif; ?>
                                                <?php if ($count == 2) : ?>
                                                    <div class="col-md-2 col-12 text-justify-center"></div>
                                                <?php endif; ?>
                                                <?php if ($count == 3) : ?>
                                                    <div class="col-md-1 col-12 text-justify-center"></div>
                                                <?php endif; ?>
                                                <div class="<?php if ($count == 1) : ?>col-md-2<?php elseif ($count == 2) : ?>col-md-3<?php elseif ($count == 3) : ?>col-md-3 <?php elseif ($count >= 4) : ?>col-md-2<?php endif; ?> col-12 text-justify-center">
                                                    <div class="box box-inverse box-card-child p_clr ">
                                                        <div class="box-body box-p_new_child menu_box_new">
                                                            <p><?= $user_Row['userFullName']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($count == 1) : ?>
                                                    <div class="col-md-5 col-12 text-justify-center"></div>
                                                <?php endif; ?>
                                                <?php if ($count == 2 ) : ?>
                                                    <!-- <div class="col-md-3 col-12 text-justify-center"></div> -->
                                                <?php endif; ?>
                                                <?php if ($count == 3 ) : ?>
                                                    <!-- <div class="col-md-1 col-12 text-justify-center"></div> -->
                                                <?php endif; ?>
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