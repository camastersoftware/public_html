<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .box-body {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        margin-top: 20px !important;
    }
    
    .clrBtn {
        width: 13.33%;
        padding: 25px;
        color: #ffffff;
        font-size: 30px;
        cursor: pointer;
        border: 0;
        transition: 300ms all linear;
        position: relative;
    }
    
    .clrBtn.active:after {
        content: "";
        height: 20px;
        width: 20px;
        position: absolute;
        background-color: #ffffff;
        top: 14px;
        right: 22px;
        border-radius: 50%;
    }
    
    .clrBtn.active:before {
        content: "";
        height: 7px;
        width: 10px;
        position: absolute;
        top: 20px;
        right: 27px;
        border-radius: 2px;
        position: absolute;
        z-index: 1;
        border-left: 3px solid #333333;
        border-bottom: 3px solid #333333;
        z-index: 11;
        transform: rotate(-45deg);
    }
    
    .none{
        background-color: #96c7f242 !important;
    }
    .red{
        background-color: pink !important;
    } 
    .yellow{
        background-color: #f0f58b7d !important;
    } 
    .violet{
        background-color: #f38bf5 !important;
    } 
    .green{
        background-color: #37fa1f !important;
    }
</style>



<!-- Main content -->
<section class="content mt-35">
    <div class="row">

        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('superadmin/error_reports?errType='.$errType); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="" method="post">
                        <section>
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <div class="form-group">
                                        <label for="firmName">Firm Name:</label>
                                        <label class="text-danger"><?php echo $errRepData['caFirmName']!="" ? $errRepData['caFirmName'] : $errRepData['errByUser']; ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firmName"> | User Name:</label>
                                        <label class="text-danger"><?php echo $errRepData['errByPerson']; ?></label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="errCode">Code:</label>
                                        <input type="text" class="form-control" name="errCode1" id="errCode1" value="<?= $errRepData['errCode']; ?>" readonly> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="errDate">Date:</label>
                                        <input type="date" class="form-control" name="errDate" id="errDate" value="<?= $errRepData['errDate']; ?>" readonly> 
                                    </div>
                                </div>
                                <!--<div class="col-md-9">-->
                                <!--    <div class="form-group">-->
                                <!--        <label for="errDate">Report Title:</label>-->
                                <!--        <input type="text" class="form-control" name="errReport" id="errReport" placeholder="Enter Report Title" value="<?//= $errRepData['errReport']; ?>" readonly> -->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="errUserComment">Query in Detail:</label>
                                        <textarea class="form-control" name="errUserComment" id="errUserComment" placeholder="Enter Query" rows="5" readonly><?= $errRepData['errUserComment']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="errDeveloperComment">Developer Comment:</label>
                                        <textarea class="form-control" name="errDeveloperComment" id="errDeveloperComment" placeholder="Enter Developer Comment" rows="5"><?= $errRepData['errDeveloperComment']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Select Prority<small class="text-danger">*</small></label>
                                        <div class="grid-Wrapper">
                                            <button type="button" class="clrBtn none <?php if($errRepData['errPriority']==1): ?>active<?php endif; ?>" data-clr="none" onclick="ColorPicker(1,'none',this);" disabled></button>
                                            <button type="button" class="clrBtn yellow <?php if($errRepData['errPriority']==2): ?>active<?php endif; ?>" data-clr="#f0f58b7d" onclick="ColorPicker(2,'#f0f58b7d',this);" disabled></button>
                                            <button type="button" class="clrBtn red <?php if($errRepData['errPriority']==3): ?>active<?php endif; ?>" data-clr="pink" onclick="ColorPicker(3,'pink',this);" disabled></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-right">
                                        <?= csrf_field() ?>
                                        <input type="hidden" class="form-control" name="errType" id="errType" value="<?= $errType; ?>"> 
                                        <input type="hidden" class="form-control" name="errId" id="errId" value="<?= $errRepData['errId']; ?>">
                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                        <a href="<?php echo base_url('superadmin/error_reports?errType='.$errType); ?>">
                                            <button type="button" class="waves-effect waves-light btn btn-dark">Back</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
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