<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>
<style>
    .box_body_bg {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        /*border-radius: 10px;*/
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        /*margin-top: 20px !important;*/
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
</style>

<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?php echo $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('users'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body box_body_bg">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-6 col-md-6">Profile Photo:</label>
                                <div class="col-lg-6 col-md-6 mt-5">
                                    <?php if(!empty($userDataArr['userImg'])): ?>
                                        <a href="<?php echo $documentsPath."/".$userDataArr['userImg']; ?>" class="btn btn-sm btn-warning" target="_blank">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-6 col-md-6">Registration Document File:</label>
                                <div class="col-lg-6 col-md-6 mt-5">
                                    <?php if(!empty($userDataArr['userRegDocument'])): ?>
                                        <a href="<?php echo $documentsPath."/".$userDataArr['userRegDocument']; ?>" class="btn btn-sm btn-warning" target="_blank">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-6 col-md-6">Aadhar Document File:</label>
                                <div class="col-lg-6 col-md-6 mt-5">
                                    <?php if(!empty($userDataArr['userAadharDoc'])): ?>
                                        <a href="<?php echo $documentsPath."/".$userDataArr['userAadharDoc']; ?>" class="btn btn-sm btn-warning" target="_blank">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>