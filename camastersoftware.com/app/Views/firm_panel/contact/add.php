<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    /*.box-body {*/
    /*    padding: 1.1rem 1.1rem;*/
    /*    flex: 1 1 auto;*/
    /*    border-radius: 10px;*/
    /*    border: 1px solid #015aacab !important;*/
    /*    background: #96c7f242 !important;*/
    /*    margin-top: 20px !important;*/
    /*}*/
    
    .form_layout{
        /*padding-top: 20px;*/
        /*padding-bottom: 20px;*/
        padding: 20px 20px !important;
        border: 1px solid #055595 !important;
        background: #96c7f242 !important;
        border-bottom-left-radius: 10px !important;
        border-bottom-right-radius: 10px !important;
    }
    
    .regHeader{
        background-color: #055595 !important;
        color: #fff !important;
        margin-bottom: 0px !important;
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
    }
    
    .regHeader h2{
        color: #fff !important;
        /*padding: 15px 20px !important;*/
    }
    
    .row{
        margin-right: 0px !important;
        margin-left: 0px !important;
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default mt-40">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">Add Contact</h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('contactList'); ?>" >
                            <button type="button" class="btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="section-title" data-aos="fade-up">
                                <div class="row">
                                    <div class="col-md-12 text-center regHeader">
                                        <h3 class="font-weight-bold"><?= $pageTitle; ?></h3>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="post" class="form_layout" >
                                <section>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contGroupId">Group: </label>
                                                <select class="custom-select form-control" name="contGroupId" id="contGroupId" onchange="get_sub_grps(this);" required>
                                                    <option value="">Select Group</option>
                                                    <?php if(!empty($contGrpArr)): ?>
                                                        <?php foreach($contGrpArr AS $e_grp): ?>
                                                            <option value="<?= $e_grp['cont_group_id']; ?>"><?= $e_grp['cont_group_name']; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contSubGroupId">Sub Group: </label>
                                                <select class="custom-select form-control" name="contSubGroupId" id="contSubGroupId">
                                                    <option value="">Select Sub Group</option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contFullName">Full Name: <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" name="contFullName" id="contFullName" placeholder="Enter Full Name" onkeypress='validateChar(event)'>
                                                <span class="vErr"><?php echo $contFullNameErr; ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contOrgName">Organization Name: </label>
                                                <input type="text" class="form-control" name="contOrgName" id="contOrgName" placeholder="Enter Organization Name" onkeypress='validateChar(event)'>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contMob1">Mobile No 1: </label>
                                                <input type="text" class="form-control" name="contMob1" id="contMob1" placeholder="Enter Mobile No 1" onkeypress='validateNum(event)'>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contMob2">Mobile No 2: </label>
                                                <input type="text" class="form-control" name="contMob2" id="contMob2" placeholder="Enter Mobile No 2" onkeypress='validateNum(event)'>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contEmail">Email Address: </label>
                                                <input type="text" class="form-control" name="contEmail" id="contEmail" placeholder="Enter Email Address" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contResiAddress">Residential Address: </label>
                                                <textarea class="form-control" name="contResiAddress" id="contResiAddress" placeholder="Enter Residential Address" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contResiNum">Residential Number: </label>
                                                <input type="text" class="form-control" name="contResiNum" id="contResiNum" placeholder="Enter Residential Number" onkeypress='validateNum(event)'>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contOfficeAddress">Office Address: </label>
                                                <textarea class="form-control" name="contOfficeAddress" id="contOfficeAddress" placeholder="Enter Office Address" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contOfficeNum">Office Number: </label>
                                                <input type="text" class="form-control" name="contOfficeNum" id="contOfficeNum" placeholder="Enter Office Number" onkeypress='validateNum(event)'>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contRegOffice">Registered Address: </label>
                                                <textarea class="form-control" name="contRegOffice" id="contRegOffice" placeholder="Enter Registered Address" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contRegOfficeNum">Office Number: </label>
                                                <input type="text" class="form-control" name="contRegOfficeNum" id="contRegOfficeNum" placeholder="Enter Office Number" onkeypress='validateNum(event)'>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contFactOffice">Factory Address: </label>
                                                <textarea class="form-control" name="contFactOffice" id="contFactOffice" placeholder="Enter Factory Address" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="contFactNum">Factory Number: </label>
                                                <input type="text" class="form-control" name="contFactNum" id="contFactNum" placeholder="Enter Factory Number" onkeypress='validateNum(event)'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group text-right">
                                                <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                                <a href="<?php echo base_url('contactList'); ?>" >
                                                    <button type="button" class="btn btn-dark">Back</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>  
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<?php
  
    $sub_grp_arr=array();
    if(!empty($contSubGrpArr))
    {
        foreach($contSubGrpArr AS $k_sgrp=>$e_sgrp)
        {
            $cont_sub_group_name = str_replace("'", "", $e_sgrp['cont_sub_group_name']);
            $sub_grp_arr[$k_sgrp]['cont_sub_group_id']=$e_sgrp['cont_sub_group_id'];
            $sub_grp_arr[$k_sgrp]['cont_sub_group_name']=$cont_sub_group_name;
            $sub_grp_arr[$k_sgrp]['fk_cont_group_id']=$e_sgrp['fk_cont_group_id'];
        }
    }
  
?>
<script type="text/javascript">

    function get_sub_grps($this)
    {
        var cont_group_id=$this.value;
        
        var sub_grp_arr = '<?php echo json_encode($sub_grp_arr); ?>';
        
        // var selected=null;
        
        $('#contSubGroupId').html("");
        $('#contSubGroupId').html("<option value=''>Select Sub Group</option>");
        
        var subGrpArr=jQuery.parseJSON(sub_grp_arr);
        
        $.each(subGrpArr, function( index, value ) {
        
            var cont_sub_group_id=value['cont_sub_group_id'];
            var cont_sub_group_name=value['cont_sub_group_name'];
            var fk_cont_group_id=value['fk_cont_group_id'];
            
            if(cont_group_id==fk_cont_group_id)
            {
                // if(ldgrId==fk_cont_group_id)
                //     selected="selected";
                // else
                //     selected="";
                
                // $('#contSubGroupId').append("<option value='"+cont_sub_group_id+"' "+selected+" >"+cont_sub_group_name+"</option>");
                $('#contSubGroupId').append("<option value='"+cont_sub_group_id+"' >"+cont_sub_group_name+"</option>");
            }
        
        });   
    }

</script>

<?= $this->endSection(); ?>