<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
    .clrBtn {
        width: 21.33%;
        padding: 0px;
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

    .clrBtn span{
        color: #000000 !important;
        font-size: 10px !important;
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
                        <a href="<?php echo base_url('error_reports'); ?>">
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
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fkMenuId">Menu:</label>
                                                                    <select class="custom-select form-control" name="fkMenuId" id="fkMenuId" onchange="get_submenus(this);">
                                                                        <option value="">Select Menu</option>
                                                                        <?php if(!empty($menuArr)): ?>
                                                                            <?php foreach($menuArr AS $e_menu): ?>
                                                                                <option value="<?= $e_menu['menuId']; ?>" <?php if($errRepData['fkMenuId']==$e_menu['menuId']): ?>selected<?php endif; ?>><?= $e_menu['menuName']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fkSubMenuId">Sub Menu:</label>
                                                                    <select class="custom-select form-control" name="fkSubMenuId" id="fkSubMenuId" >
                                                                        <option value="">Select Sub Menu</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="errUserComment">Query in Detail:</label>
                                                                    <textarea class="form-control" name="errUserComment" id="errUserComment" placeholder="Enter Query" rows="5" required><?= $errRepData['errUserComment']; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>Select Prority<small class="text-danger">*</small></label>
                                                                    <div class="grid-Wrapper">
                                                                        <button type="button" class="clrBtn none <?php if($errRepData['errPriority']==1): ?>active<?php endif; ?>" data-clr="none" onclick="ColorPicker(1,'none',this);">
                                                                            <span>Low</span>
                                                                        </button>
                                                                        <button type="button" class="clrBtn yellow <?php if($errRepData['errPriority']==2): ?>active<?php endif; ?>" data-clr="#f0f58b7d" onclick="ColorPicker(2,'#f0f58b7d',this);">
                                                                            <span>Medium</span>
                                                                        </button>
                                                                        <button type="button" class="clrBtn red <?php if($errRepData['errPriority']==3): ?>active<?php endif; ?>" data-clr="pink" onclick="ColorPicker(3,'pink',this);">
                                                                            <span>High</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-lg-5">
                                                                <div class="form-group">
                                                                    <label>Upload Photo: <small class="text-danger">(Only image files (jpg, jpeg, png, gif) are accepted)</small></label>
                                                                    <input type="file" class="form-control" name="file" id="file" accept="image/*">
                                                                </div>
                                                            </div>
                                                            <?php $img_file=$errRepData['errUploadedImage']; ?>
                                                            <?php if(!empty($img_file)): ?>
                                                                <div class="col-md-4 col-lg-4">
                                                                    <?php $uploadFilePath = base_url("uploads/ca_firm_".$sessCaFirmId."/query_files/".$img_file); ?>
                                                                    <div class="mt-30">
                                                                        <a href="<?= $uploadFilePath; ?>" target="_blank">
                                                                            <button type="button" class="waves-effect waves-light btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="View">
                                                                                <i class="fa fa-eye"></i>
                                                                            </button>
                                                                        </a>
                                                                        &nbsp;
                                                                        <a href="javascript:void(0);" class="deleteUploadedFile">
                                                                            <button type="button" class="waves-effect waves-light btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group text-right">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="old_file" id="old_file" value="<?= $img_file; ?>">
                                                            <input type="hidden" name="errCode1" id="errCode1" value="<?= $errRepData['errCode']; ?>">
                                                            <input type="hidden" name="errDate" id="errDate" value="<?= $errRepData['errDate']; ?>">
                                                            <input type="hidden" name="errId" id="errId" value="<?= $errRepData['errId']; ?>"> 
                                                            <input type="hidden" name="errPriority" id="errPriority" value="<?= $errRepData['errPriority']; ?>" />
                                                            <input type="hidden" name="errPriorityColor" id="errPriorityColor" value="<?= $errRepData['errPriorityColor']; ?>" />
                                                            <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                                            <a href="<?php echo base_url('error_reports'); ?>">
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

<?php
  
    $sub_menu_arr=array();
    if(!empty($subMenuArr))
    {
        foreach($subMenuArr AS $k_sbmnu=>$e_sbmnu)
        {
            $subMenuName = str_replace("'", "", $e_sbmnu['subMenuName']);
            $sub_menu_arr[$k_sbmnu]['subMenuId']=$e_sbmnu['subMenuId'];
            $sub_menu_arr[$k_sbmnu]['subMenuName']=$subMenuName;
            $sub_menu_arr[$k_sbmnu]['fkMenuId']=$e_sbmnu['fkMenuId'];
        }
    }
  
?>

<script type="text/javascript">

    $(document).ready(function(){

        var fkMenuId=$('#fkMenuId').val();
        
        if(fkMenuId!="")
            $('#fkMenuId').trigger('change');

    });

    function get_submenus($this)
    {
        var selMenu=$this.value;
        var sub_menu_arr = '<?php echo json_encode($sub_menu_arr); ?>';
        var selSubMenu = "<?php echo $errRepData['fkSubMenuId']; ?>";
        
        var selected=null;
        
        $("#fkSubMenuId").html("");
        $("#fkSubMenuId").html("<option value=''>Select Sub Menu</option>");
        
        var subMenuArr=jQuery.parseJSON(sub_menu_arr);
        
        $.each(subMenuArr, function( index, value ) {
        
            var subMenuId=value['subMenuId'];
            var subMenuName=value['subMenuName'];
            var fkMenuId=value['fkMenuId'];
            
            if(fkMenuId==selMenu)
            {
                if(subMenuId==selSubMenu)
                    selected="selected";
                else
                    selected="";
            
                $("#fkSubMenuId").append("<option value='"+subMenuId+"' "+selected+" >"+subMenuName+"</option>");
            }
        
        });   
    }

</script>

<script type="text/javascript">

	$(document).ready(function(){
	    
	    $('body').on('click', '.deleteUploadedFile', function(){
            
            var base_url = "<?php echo base_url(); ?>";
            var errId = $('#errId').val();
            
            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this uploaded file ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/delete-error-report-img-file',
                        type : 'POST',
                        data : {
                            'errId':errId
                        },
                        dataType: 'html',
                        success : function(response) {
                            
                            window.location.reload();

                        },
                        error : function(request, error)
                        {
                            alert("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });
            
        });
		
	});
	
</script>

<?= $this->endSection(); ?>