<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

    <style>
        .table-responsive table thead tr{
            background: #005495 !important;
            color: #fff !important;
        }
        
        .table-responsive table tbody tr{
            background: #96c7f242 !important;
        }
        
        .table-responsive tr th{
            border: 1px solid #fff !important;
        }
        
        .table-responsive tr td{
            border: 1px solid #015aacab !important;$referncerArr
        }
        
        table.dataTable {
            border-collapse: collapse !important;
            font-size: 16px !important;
        }
        
        .table > tbody > tr > td, .table > tbody > tr > th {
            padding: 0px 14px !important;
        }
        
        .btnPrimClr {
            margin-top: 5px !important;
            height: 30px !important;
            margin-bottom: 5px !important;
        }
        
        .year-color {
            color: #303030 !important;
            font-weight: bold !important;
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
            background-color: #f58b8b !important;
        } 
        .yellow{
            background-color: #f0f58b !important;
        } 
        .violet{
            background-color: #f38bf5 !important;
        } 
        .green{
            background-color: #37fa1f !important;
        } 
        
        .hdClr{
            /*color:#005495 !important;*/
        }
        
        table.dataTable{
            margin-top: 0px !important;
        }
        
        /*.btn-group{*/
        /*    display: block !important;*/
        /*}*/
        
        .select2-container--default .select2-selection--single {
            background-color: #005495 !important;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 41px !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #fff !important;
            line-height: 28px;
            font-weight: 700 !important;
            font-size: 17.2px !important;
        }
        
        .select2-container--default .select2-selection--single {
            background-color: #005495 !important;
            border: 1px solid #aaa;
            border-radius: 4px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 32px !important;
            right: 3px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #fff transparent transparent transparent !important;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 50%;
            margin-left: -4px;
            margin-top: -2px;
            position: absolute;
            top: 50%;
            width: 0;
        }
        
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            margin-top: 0px;
            position: relative;
            vertical-align: middle;
            margin-top: 0px !important;
        }
        
        .select2-container--default .select2-selection--single {
            background-color: #005495 !important;
            border: none !important;
            border-radius: 7px !important;
            height: 41px !important;
        }
        
        #DataTables_Table_0_filter{
            margin-top: -40px !important;
        }
        
        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: -16.5em !important;
            display: inline-block;
            width: auto;
            z-index: 99 !important;
            position: absolute !important;
            height: 40px !important;
            margin-top: -6px !important;
        }
        
        .theme-primary .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #005495 !important;
        }
        
        .btn_rnd{
            border-radius: 7px !important;
            width: 100% !important;
        }
        
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0;
            height: auto;
            margin-top: 0px !important;
            padding-right: 10px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 5px !important;
            right: 1px;
            width: 20px;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box mt-40">
                    <div class="box-header with-border flexbox text-center">
                        <h4 class="box-title font-weight-bold">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            <a href="<?php echo base_url('superadmin/home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group row mb-0">
                                            <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                <a href="<?php echo base_url('superadmin/refGroups'); ?>">
                                                    <button class="btn btn-submit btn-rounded btn_rnd font-weight-bold" data-toggle="tooltip" data-original-title="Create Group">Create Group</button>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                <a href="<?php echo base_url('superadmin/refSubGroups'); ?>">
                                                    <button class="btn btn-submit btn-rounded btn_rnd font-weight-bold" data-toggle="tooltip" data-original-title="Create Sub-Group">Create Sub-Group</button>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#addReferncer">
                                                    <button class="btn btn-submit btn-rounded btn_rnd font-weight-bold" data-toggle="tooltip" data-original-title="Add Referencer">Add Referencer</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group row mb-0">
                                            <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                <select class="form-control select2" name="refGroupId" id="refGroupId" onchange="searchGroup(this);" style="width:100%;margin-top: 4px;" required>
                                                    <option value="">Select Group</option>
                                                    <?php if(!empty($refGrpArr)): ?>
                                                        <?php foreach($refGrpArr AS $e_grp): ?>
                                                            <option value="<?= $e_grp['refGrpId']; ?>" <?php if($queryGroup==$e_grp['refGrpId']): ?>selected<?php endif; ?> ><?= $e_grp['refGrpName']; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select> 
                                            </div>
                                            <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                <select class="form-control select2" name="refSubGroupId" id="refSubGroupId" onchange="serachSubGroup(this);" style="width:100%;margin-top: 4px;" required>
                                                    <option value="">Select Sub-Group</option>
                                                    <?php if(!empty($refSubGrpArr)): ?>
                                                        <?php foreach($refSubGrpArr AS $e_sgrp): ?>
                                                            <?php if($queryGroup==$e_sgrp['fkRefGrpId']): ?>
                                                                <option value="<?= $e_sgrp['refSubGrpId']; ?>" <?php if($querySubGroup==$e_sgrp['refSubGrpId']): ?>selected<?php endif; ?>><?= $e_sgrp['refSubGrpName']; ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select> 
                                            </div>
                                            <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                <!--<input type="text" class="form-control" name="searchName" id="searchName" placeholder="Search Name" >-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="onlyTableWithSearch table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th>Year</th>
                                                <th>Referencer&nbsp;Name</th>
                                                <th>Author</th>
                                                <th width="5%">Uploaded&nbsp;Date</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($referncerArr)): ?>
                                                <?php $i=1; ?>
                                                <?php foreach($referncerArr AS $e_row): ?>
                                                    <tr>
                                            			<td class="text-center"><?php echo $i; ?></td>
                                            			<td nowrap class="text-center"><?php echo $e_row['referncerYear']; ?></td>
                                            			<td nowrap><?php echo $e_row['referncerHeading']; ?></td>
                                            			<td nowrap class="text-center"><?php echo $e_row['referncerAuthor']; ?></td>
                                            			<td class="text-center">
                                            			    <?php
                                            			        if($e_row['referncerUploadDate']!="" && $e_row['referncerUploadDate']!="1970-01-01"  && $e_row['referncerUploadDate']!="0000-00-00")
                                            			            $referncerUploadDate=date('Y-m-d', strtotime($e_row['referncerUploadDate']));
                                            			        else
                                            			            $referncerUploadDate="";
                                            			            
                                            			        if(!empty($referncerUploadDate))
                                            			            echo date('d-m-Y', strtotime($referncerUploadDate));
                                            			        else
                                            			            echo "---";
                                            			    ?>
                                            			</td>
                                            			<td class="text-center">
                                            			    
                                            			    <div class="btn-group">
                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateReferncer<?php echo $e_row['referncerId']; ?>">Edit</a>
                                                                    <a class="dropdown-item" href="<?php echo $docPath.'/'.$e_row['referncerFile']; ?>" target="_blank">View</a>
                                                                    <a class="dropdown-item deleteReferncer" href="javascript:void(0);" data-id="<?php echo $e_row['referncerId']; ?>">Delete</a>
                                                                </div>
                                                            </div>
                                                            
                                            			</td>
                                            		</tr>
                                            		<?php $i++; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6"><center>No records</center></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
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
    <!-- /.content -->
    
    <?php if(!empty($referncerArr)): ?>
        <?php foreach($referncerArr AS $e_row): ?>
        
        <!-- Modal -->
        <div id="updateReferncer<?php echo $e_row['referncerId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="<?php echo base_url('superadmin/updateReferncer'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Referencer</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 ref_group_div">
                                    <div class="form-group">
                                        <label>Group<span class="text-danger">*</span></label>
                                        <select class="custom-select form-control ref_group_id" name="ref_group_id" required>
                                            <option value="">Select Group</option>
                                            <?php if(!empty($refGrpArr)): ?>
                                                <?php foreach($refGrpArr AS $e_grp): ?>
                                                    <option value="<?= $e_grp['refGrpId']; ?>" <?php if($e_row['refGroupId']==$e_grp['refGrpId']): ?>selected<?php endif; ?>><?= $e_grp['refGrpName']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 ref_sub_group_div">
                                    <div class="form-group">
                                        <label for="ref_sub_group_id">Sub Group<span class="text-danger">*</span></label>
                                        <select class="custom-select form-control ref_sub_group_id" name="ref_sub_group_id" required>
                                            <option value="">Select Sub Group</option>
                                            <?php if(!empty($refSubGrpArr)): ?>
                                                <?php foreach($refSubGrpArr AS $e_sgrp): ?>
                                                    <?php if($e_row['refGroupId']==$e_sgrp['fkRefGrpId']): ?>
                                                        <option value="<?= $e_sgrp['refSubGrpId']; ?>" <?php if($e_row['refSubGroupId']==$e_sgrp['refSubGrpId']): ?>selected<?php endif; ?>><?= $e_sgrp['refSubGrpName']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="referncerHeading" id="referncerHeading" placeholder="Enter Heading" value="<?php echo $e_row['referncerHeading']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Year<span class="text-danger">*</span></label>
                                        <select class="custom-select form-control" id="referncerYear" name="referncerYear">
                                            <option value="">Select Year</option>
                                            <?php for($d=(date('Y')+1); $d>=2011; $d--): ?>
                                                <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                                <option value="<?php echo $dueYr; ?>" <?php echo set_select('referncerYear', $dueYr, $e_row['referncerYear']==$dueYr ? TRUE:FALSE); ?> ><?php echo $dueYr; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Author<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="referncerAuthor" id="referncerAuthor" placeholder="Enter Author" value="<?php echo $e_row['referncerAuthor']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Document File<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="referncerFile" id="referncerFile" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="referncerOldFile" id="referncerOldFile" value="<?php echo $e_row['referncerFile']; ?>">
                            <input type="hidden" name="referncerId" id="referncerId" value="<?php echo $e_row['referncerId']; ?>">
                            <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Modal -->
    <div id="addReferncer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo base_url('superadmin/addReferncer'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Referencer</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Group<span class="text-danger">*</span></label>
                                    <select class="custom-select form-control" name="ref_group_id" id="ref_group_id" required>
                                        <option value="">Select Group</option>
                                        <?php if(!empty($refGrpArr)): ?>
                                            <?php foreach($refGrpArr AS $e_grp): ?>
                                                <option value="<?= $e_grp['refGrpId']; ?>"><?= $e_grp['refGrpName']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="ref_sub_group_id">Sub Group<span class="text-danger">*</span></label>
                                    <select class="custom-select form-control" name="ref_sub_group_id" id="ref_sub_group_id" required>
                                        <option value="">Select Sub Group</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="referncerHeading" id="referncerHeading" placeholder="Enter Heading" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Year<span class="text-danger">*</span></label>
                                    <select class="custom-select form-control" id="referncerYear" name="referncerYear">
                                        <option value="">Select Year</option>
                                        <?php for($d=(date('Y')+1); $d>=2011; $d--): ?>
                                            <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                            <option value="<?php echo $dueYr; ?>" <?php echo set_select('referncerYear', $dueYr); ?> ><?php echo $dueYr; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Author<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="referncerAuthor" id="referncerAuthor" placeholder="Enter Author" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Document File<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="referncerFile" id="referncerFile" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
<?php
    $sub_grp_arr=array();
    if(!empty($refSubGrpArr))
    {
        foreach($refSubGrpArr AS $k_sgrp=>$e_sgrp)
        {
            $refSubGrpName = str_replace("'", "", $e_sgrp['refSubGrpName']);
            $sub_grp_arr[$k_sgrp]['refSubGrpId']=$e_sgrp['refSubGrpId'];
            $sub_grp_arr[$k_sgrp]['refSubGrpName']=$refSubGrpName;
            $sub_grp_arr[$k_sgrp]['fkRefGrpId']=$e_sgrp['fkRefGrpId'];
        }
    }
  
?>
    
<script>
    $(document).ready(function(){
        $('.deleteReferncer').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var referncerId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    var postingUrl = base_url+'/superadmin/deleteReferncer';
                    $.post(postingUrl, 
                    {
                        referncerId: referncerId
                    },
                    function(data, status){
                        window.location.href=base_url+"/superadmin/referncer";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
        
        setTimeout(function () {
            $('div.dataTables_filter input').attr('placeholder', "Search Name");
        }, 100);
    });
</script>   

<script type="text/javascript">
    
    var base_url = "<?= base_url(); ?>";
    
    function searchGroup($this)
    {
        var group_id=$this.value;
        
        window.location.href=base_url+"/superadmin/referncer?group="+group_id;
    }
    
    function serachSubGroup($this)
    {
        var group_id=$('#refGroupId').val();
        var sub_group_id=$this.value;
        
        window.location.href=base_url+"/superadmin/referncer?group="+group_id+"&sub_group="+sub_group_id;
    }

</script>


<script type="text/javascript">

    $('#ref_group_id').on('change', function(){
        
        var ref_group_id=$(this).val();
        
        console.log('ref_group_id', ref_group_id);
        
        var sub_grp_arr = '<?php echo json_encode($sub_grp_arr); ?>';
        
        // var selected=null;
        
        $('#ref_sub_group_id').html("");
        $('#ref_sub_group_id').html("<option value=''>Select Sub Group</option>");
        
        var subGrpArr=jQuery.parseJSON(sub_grp_arr);
        
        console.log('subGrpArr', subGrpArr);
        
        $.each(subGrpArr, function( index, value ) {
        
            var refSubGrpId=value['refSubGrpId'];
            var refSubGrpName=value['refSubGrpName'];
            var fkRefGrpId=value['fkRefGrpId'];
            
            if(ref_group_id==fkRefGrpId)
            {
                // if(ldgrId==fk_cont_group_id)
                //     selected="selected";
                // else
                //     selected="";
                
                // $('#contSubGroupId').append("<option value='"+cont_sub_group_id+"' "+selected+" >"+cont_sub_group_name+"</option>");
                $('#ref_sub_group_id').append("<option value='"+refSubGrpId+"' >"+refSubGrpName+"</option>");
            }
        
        });   
    });

</script>

<script type="text/javascript">

    $('.ref_group_id').on('change', function(){
        
        var ref_group_id=$(this).val();
        
        console.log('ref_group_id', ref_group_id);
        
        var sub_grp_arr = '<?php echo json_encode($sub_grp_arr); ?>';
        
        // var selected=null;
        
        var subGroupElem=$(this).parents('.ref_group_div').siblings('.ref_sub_group_div').children().find('.ref_sub_group_id');
        
        console.log('subGroupElem', subGroupElem);
        
        subGroupElem.html("");
        subGroupElem.html("<option value=''>Select Sub Group</option>");
        
        var subGrpArr=jQuery.parseJSON(sub_grp_arr);
        
        console.log('subGrpArr', subGrpArr);
        
        $.each(subGrpArr, function( index, value ) {
        
            var refSubGrpId=value['refSubGrpId'];
            var refSubGrpName=value['refSubGrpName'];
            var fkRefGrpId=value['fkRefGrpId'];
            
            if(ref_group_id==fkRefGrpId)
            {
                subGroupElem.append("<option value='"+refSubGrpId+"' >"+refSubGrpName+"</option>");
            }
        
        }); 
    });

</script>


<?= $this->endSection(); ?>