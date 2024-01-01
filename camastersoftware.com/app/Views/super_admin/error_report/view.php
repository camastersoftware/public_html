<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
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
                <div class="box-body card_bg_format">
                    <form action="" method="post">
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row form-group mb-2">
                                                    <div class="col-md-12 col-lg-12 text-center">
                                                        <h3 class="font-weight-bold m-0">
                                                            <?php 
                                                                if($errType==1)
                                                                    echo $errRepData['caFirmName']!="" ? $errRepData['caFirmName'] : $errRepData['errByUser'];
                                                                else
                                                                    echo "Super Admin";
                                                            ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-left">
                                                <span class="font-weight-bold">Code :&nbsp;</span>
                                                <span class="font-weight-bold"><?= $errRepData['errCode']; ?></span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-center">
                                                <span class="font-weight-bold">Added By :&nbsp;</span>
                                                <span class="font-weight-bold"><?php echo $errRepData['errByPerson']!="" ? $errRepData['errByPerson'] : "Admin"; ?></span>
                                            </div>
                                            <div class="col-md-4 col-lg-4 text-right">
                                                <span class="font-weight-bold">Date :&nbsp;</span>
                                                <span class="font-weight-bold"><?= (check_valid_date($errRepData['errDate'])) ? date("d-m-Y", strtotime($errRepData['errDate'])) : ""; ?></span>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="sec_heading">
                                                            <h4 class="text-white font-weight-bold m-0">Query Details</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="errUserComment">Query in Detail:</label>
                                                    <textarea class="form-control" name="errUserComment" id="errUserComment" placeholder="Enter Query" rows="5" readonly><?= $errRepData['errUserComment']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="errDeveloperComment">Developer Comment:</label>
                                                    <textarea class="form-control" name="errDeveloperComment" id="errDeveloperComment" rows="5" readonly><?= $errRepData['errDeveloperComment']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>Selected Prority<small class="text-danger">*</small></label>
                                                    <div class="grid-Wrapper">
                                                        <button type="button" class="clrBtn none <?php if($errRepData['errPriority']==1): ?>active<?php endif; ?>" data-clr="none" onclick="ColorPicker(1,'none',this);" disabled></button>
                                                        <button type="button" class="clrBtn yellow <?php if($errRepData['errPriority']==2): ?>active<?php endif; ?>" data-clr="#f0f58b7d" onclick="ColorPicker(2,'#f0f58b7d',this);" disabled></button>
                                                        <button type="button" class="clrBtn red <?php if($errRepData['errPriority']==3): ?>active<?php endif; ?>" data-clr="pink" onclick="ColorPicker(3,'pink',this);" disabled></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $img_file=$errRepData['errUploadedImage']; ?>
                                            <?php if(!empty($img_file)): ?>
                                                <?php
                                                    if($errType==1)
                                                        $uploadFilePath = base_url("uploads/ca_firm_".$errRepData['caFirmId']."/query_files/".$img_file);
                                                    else
                                                        $uploadFilePath = base_url("uploads/admin/query_files/".$img_file);
                                                ?>
                                                <div class="col-md-2 col-lg-2">
                                                    <label>Uploaded Photo:</label>
                                                    <a href="<?= $uploadFilePath; ?>" target="_blank">
                                                        <button type="button" class="waves-effect waves-light btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="View">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group text-right">
                                                    <?= csrf_field() ?>
                                                    <?php if($errRepData['errStatus']=="1" && $errRepData['errFrom']=="2"): ?>
                                                    <button type="button" class="waves-effect waves-light btn btn-success not_sts_btn">Satisfied</button>
                                                    <?php endif; ?>
                                                    <input type="hidden" class="form-control" name="errId" id="errId" value="<?= $errRepData['errId']; ?>">
                                                    <a href="<?php echo base_url('superadmin/error_reports?errType='.$errType); ?>">
                                                        <button type="button" class="waves-effect waves-light btn btn-dark">Back</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<script>
    $(document).ready(function () {

        $('.not_sts_btn').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var errType = "<?php echo $errType; ?>";
            var errId = $('#errId').val();

            swal({
                title: "Are you sure?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    
                    var postingUrl = base_url+'/superadmin/not_satisfy';
                    $.post(postingUrl, 
                    {
                        errId: errId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/error_reports?errType="+errType;
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

    });
</script>

<?= $this->endSection(); ?>