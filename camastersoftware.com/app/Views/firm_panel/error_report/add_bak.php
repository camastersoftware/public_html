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
                        <a href="<?php echo base_url('error_reports'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="" method="post">
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="errCode">Code:</label>
                                        <input type="text" class="form-control" name="errCode1" id="errCode1" value="<?= $errCode; ?>" readonly> 
                                        <input type="hidden" class="form-control" name="errCode" id="errCode" value="<?= $errCode; ?>"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="errDate">Date:</label>
                                        <input type="date" class="form-control" name="errDate" id="errDate" value="<?php echo date('Y-m-d'); ?>" required> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fkMenuId">Menu:</label>
                                        <select class="custom-select form-control" name="fkMenuId" id="fkMenuId" onchange="get_submenus(this);">
                                            <option value="">Select Menu</option>
                                            <?php if(!empty($menuArr)): ?>
                                                <?php foreach($menuArr AS $e_menu): ?>
                                                    <option value="<?= $e_menu['menuId']; ?>"><?= $e_menu['menuName']; ?></option>
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
                                <!--<div class="col-md-12">-->
                                <!--    <div class="form-group">-->
                                <!--        <label for="errDate">Report Title:</label>-->
                                <!--        <input type="text" class="form-control" name="errReport" id="errReport" placeholder="Enter Report Title" required> -->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="errUserComment">Query in Detail:</label>
                                        <textarea class="form-control" name="errUserComment" id="errUserComment" placeholder="Enter Query" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Select Prority<small class="text-danger">*</small></label>
                                        <div class="grid-Wrapper">
                                            <button type="button" class="clrBtn none active" data-clr="none" onclick="ColorPicker(1,'none',this);"></button>
                                            <button type="button" class="clrBtn yellow" data-clr="#f0f58b7d" onclick="ColorPicker(2,'#f0f58b7d',this);"></button>
                                            <button type="button" class="clrBtn red" data-clr="pink" onclick="ColorPicker(3,'pink',this);"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-right">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="errPriority" id="errPriority" value="1" />
                                        <input type="hidden" name="errPriorityColor" id="errPriorityColor" value="none" />
                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                        <a href="<?php echo base_url('error_reports'); ?>">
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

    function get_submenus($this)
    {
        var selMenu=$this.value;
        var sub_menu_arr = '<?php echo json_encode($sub_menu_arr); ?>';
        
        $("#fkSubMenuId").html("");
        $("#fkSubMenuId").html("<option value=''>Select Sub Menu</option>");
        
        var subMenuArr=jQuery.parseJSON(sub_menu_arr);
        
        $.each(subMenuArr, function( index, value ) {
        
            var subMenuId=value['subMenuId'];
            var subMenuName=value['subMenuName'];
            var fkMenuId=value['fkMenuId'];
            
            if(fkMenuId==selMenu)
            {
                $("#fkSubMenuId").append("<option value='"+subMenuId+"' >"+subMenuName+"</option>");
            }
        
        });   
    }

</script>

<?= $this->endSection(); ?>