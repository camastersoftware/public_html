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
                        <a href="<?php echo base_url('superadmin/error_reports'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body card_bg_format">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 mt-3">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="sec_heading">
                                                            <h4 class="text-white font-weight-bold m-0">Query Details</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="errUserComment">Query in Detail:<small class="text-danger">*</small></label>
                                                                    <textarea class="form-control" name="errUserComment" id="errUserComment" placeholder="Enter Query" rows="5" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>Select Prority:<small class="text-danger">*</small></label>
                                                                    <div class="grid-Wrapper">
                                                                        <button type="button" class="clrBtn none active" data-clr="none" onclick="ColorPicker(1,'none',this);"></button>
                                                                        <button type="button" class="clrBtn yellow" data-clr="#f0f58b7d" onclick="ColorPicker(2,'#f0f58b7d',this);"></button>
                                                                        <button type="button" class="clrBtn red" data-clr="pink" onclick="ColorPicker(3,'pink',this);"></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-lg-5">
                                                                <div class="form-group">
                                                                    <label>Upload Photo: <small class="text-danger">(Only image files (jpg, jpeg, png, gif) are accepted)</small></label>
                                                                    <input type="file" class="form-control" name="file" id="file" accept="image/*">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group text-right">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" class="form-control" name="errDate" id="errDate" value="<?php echo date('Y-m-d'); ?>"> 
                                                            <input type="hidden" class="form-control" name="errCode" id="errCode" value="<?= $errCode; ?>"> 
                                                            <input type="hidden" name="errPriority" id="errPriority" value="1" />
                                                            <input type="hidden" name="errPriorityColor" id="errPriorityColor" value="none" />
                                                            <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                                            <a href="<?php echo base_url('superadmin/error_reports'); ?>">
                                                                <button type="button" class="waves-effect waves-light btn btn-dark">Back</button>
                                                            </a>
                                                        </div>
                                                    </div>
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
    var valId,x,y,i;
    
    function ColorPicker(valId,x,y){
        var val= y.innerHTML;
        
        var activeState = document.getElementsByClassName("clrBtn");
        console.log(activeState);
        for(i=0; i<activeState.length; i++){
            // console.log(activeState)+1;
            activeState[i].classList.remove('active');
        }
        y.classList.add('active');
        
        var clr = $(y).data('clr');
        $('#errPriorityColor').val(clr);
        $('#errPriority').val(valId);
       
    }
</script>

<?= $this->endSection(); ?>