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
            border: 1px solid #015aacab !important;
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
        
        /*table.dataTable{*/
        /*    margin-top: -20px !important;*/
        /*}*/
        
        /*Ref: https://codepen.io/Vikaspatel/pen/BawZeag*/
        
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
                        <h4 class="box-title font-weight-bold hdClr">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right font-weight-bold" style="">Back</button>
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
                                                <a href="<?php echo base_url('contGroups'); ?>">
                                                    <button class="btn btn-submit btn-rounded btn_rnd font-weight-bold" data-toggle="tooltip" data-original-title="Create Group">Create Group</button>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                <a href="<?php echo base_url('contSubGroups'); ?>">
                                                    <button class="btn btn-submit btn-rounded btn_rnd font-weight-bold" data-toggle="tooltip" data-original-title="Create Sub-Group">Create Sub-Group</button>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                <a href="<?php echo base_url('addContact'); ?>">
                                                    <button class="btn btn-submit btn-rounded btn_rnd font-weight-bold" data-toggle="tooltip" data-original-title="Create Contact">Create Contact</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group row mb-0">
                                            <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                <select class="form-control select2" name="contGroupId" id="contGroupId" onchange="searchGroup(this);" style="width:100%;margin-top: 4px;" required>
                                                    <option value="">Select Group</option>
                                                    <?php if(!empty($contGrpArr)): ?>
                                                        <?php foreach($contGrpArr AS $e_grp): ?>
                                                            <option value="<?= $e_grp['cont_group_id']; ?>" <?php if($queryGroup==$e_grp['cont_group_id']): ?>selected<?php endif; ?> ><?= $e_grp['cont_group_name']; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select> 
                                            </div>
                                            <div class="col-md-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                                <select class="form-control select2" name="contSubGroupId" id="contSubGroupId" onchange="serachSubGroup(this);" style="width:100%;margin-top: 4px;" required>
                                                    <option value="">Select Sub-Group</option>
                                                    <?php if(!empty($contSubGrpArr)): ?>
                                                        <?php foreach($contSubGrpArr AS $e_sgrp): ?>
                                                            <?php if($queryGroup==$e_sgrp['fk_cont_group_id']): ?>
                                                                <option value="<?= $e_sgrp['cont_sub_group_id']; ?>" <?php if($querySubGroup==$e_sgrp['cont_sub_group_id']): ?>selected<?php endif; ?>><?= $e_sgrp['cont_sub_group_name']; ?></option>
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
                                                <th>Contact&nbsp;Name</th>
                                                <th width="5%">Mobile&nbsp;1</th>
                                                <th width="5%">Mobile&nbsp;2</th>
                                                <th width="5%">Office</th>
                                                <th width="5%">Residence</th>
                                                <th>Email</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($contactArr)): ?>
                                                <?php $i=1; ?>
                                                <?php foreach($contactArr AS $e_row): ?>
                                                    <tr>
                                            			<td width="5%" nowrap class="text-center"><?php echo $i; ?></td>
                                            			<td nowrap><a href="<?= base_url("editContact?contactId=".$e_row['contactId']); ?>"><?php echo $e_row['contFullName']; ?></a></td>
                                            			<td width="5%" nowrap class="text-center"><?php echo $e_row['contMob1']; ?></td>
                                            			<td width="5%" nowrap class="text-center"><?php echo $e_row['contMob2']; ?></td>
                                            			<td width="5%" nowrap class="text-center"><?php echo $e_row['contOfficeNum']; ?></td>
                                            			<td width="5%" nowrap class="text-center"><?php echo $e_row['contResiNum']; ?></td>
                                            			<td nowrap><?php echo $e_row['contEmail']; ?></td>
                                            			<td width="5%" class="text-center">
                                            			    
                                            			    <div class="btn-group">
                                                                <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu" style="will-change: transform;">
                                                                    <a class="dropdown-item" href="<?= base_url("editContact?contactId=".$e_row['contactId']); ?>">Edit</a>
                                                                    <a class="dropdown-item deleteContact" href="javascript:void(0);" data-id="<?php echo $e_row['contactId']; ?>">Delete</a>
                                                                </div>
                                                            </div>
                                                            
                                            			</td>
                                            		</tr>
                                        		    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8"><center>No records</center></td>
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
    
    
<script>
    $(document).ready(function(){
        $('.deleteContact').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var contactId = $(this).data('id');

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

                    var postingUrl = base_url+'/deleteContact';
                    $.post(postingUrl, 
                    {
                        contactId: contactId
                    },
                    function(data, status){
                        window.location.href=base_url+"/contactList";
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
        var cont_group_id=$this.value;
        
        window.location.href=base_url+"/contactList?group="+cont_group_id;
    }
    
    function serachSubGroup($this)
    {
        var cont_group_id=$('#contGroupId').val();
        var cont_sub_group_id=$this.value;
        
        window.location.href=base_url+"/contactList?group="+cont_group_id+"&sub_group="+cont_sub_group_id;
    }

</script>
    
<?= $this->endSection(); ?>