<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .box-body {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        /*margin-top: 20px !important;*/
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
</style>


<!-- Main content -->
<section class="content mt-35">
    <div class="row">

        <div class="col-8 offset-2">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('holidays'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?= base_url('updateScheduleNotes'); ?>" method="post">
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="mb-0">Notes:</label>
                                    <textarea class="form-control" name="scheduleNotes" id="scheduleNotes" placeholder="Enter Notes" rows="10"><?= $settingsArr['scheduleNotes']; ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-10 text-right">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name='configId' value="<?= $settingsArr['configId']; ?>" />
                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-sm btn-submit">Submit</button>
                                    </div>
                                </div>    
                            </div>
                            <!--<div class="row">-->
                                
                            <!--</div>-->
                        </section>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<?= $this->endSection(); ?>