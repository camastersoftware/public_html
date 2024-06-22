<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>

    .close_btn {
      background-color: #005495 !important;
      border-color: #005495 !important;
      color: #fff !important;
    }
    
    .close_btn:hover {
      background-color: #005495 !important;
      border-color: #005495 !important;
      color: #fff !important;
    }
    
    .theme-primary .btn-danger:hover, .theme-primary .btn-danger:active, .theme-primary .btn-danger:focus, .theme-primary .btn-danger.active {
        background-color: #005495 !important;
        border-color: #005495 !important;
        color: #ffffff !important;
    }
    
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
    
    .clientGrpTable > tbody > tr > td{
        padding: 3px 14px !important;
    }
    
    .clientGrpTable > thead > tr > th {
        padding: 5px 14px !important;
    }
    
    .btnPrimClr {
        margin-top: 5px !important;
        height: 30px !important;
        margin-bottom: 5px !important;
    }
    
    .table > tbody > tr.last_total_tr > td{
        padding: 10px !important;
    }
    
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
    
    .card_bg_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 0px !important;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }
    
    .form_bg_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px !important;
        border: 1px solid #8c8c8cab !important;
        background: #fdfeff !important;
    }
    
    .due-month{
        background:#F99D27;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }
    
</style>

<!-- Main content -->
<section class="content mt-35 client_group_div">
    <div class="row">

        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">Client Group</h4>
                    <div class="text-right flex-grow hide">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_group_btn">Create New Group</button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body box_body_bg card_bg_format">
                    <div class="row">
                        <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                            <div class="form-group form_bg_format">
                                <section class="add_group_section hide">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="search_client_group">Enter Client Group:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="search_client_group" id="search_client_group" placeholder="Enter Client Group">
                                                <label id="search_client_group_err" class="text-danger"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="waves-effect waves-light btn btn-submit search_client_group_btn">Proceed</button>
                                        </div>
                                    </div>
                                </section>
                                <section class="get_group_section"></section>
                                <form action="" method="post" class="group_form">
                                    <section>
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="state due-month">
                                                            <h4 class="text-white font-weight-bold m-0">Create Client Group</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="client_group">Client Group Name:</label>
                                                    <input type="text" class="form-control" name="client_group" id="client_group" placeholder="Enter Client Group Name"> 
                                                    <span id="client_group_err" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="client_group_number">Group Number:</label>
                                                    <input type="text" class="form-control" name="client_group_number" id="client_group_number" placeholder="Enter Group Number"> 
                                                    <span id="client_group_number_err" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <!--
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="client_group_cost">Cost Center:</label>
                                                    <select class="custom-select form-control" name="client_group_cost" id="client_group_cost">
                                                        <option value="">Select Cost Center</option>
                                                        <?php //if(!empty($userList)): ?>
                                                            <?php //foreach($userList AS $e_user): ?>
                                                            <option value="<?php //echo $e_user['userId']; ?>" ><?php //echo $e_user['userFullName']; ?></option>
                                                            <?php //endforeach; ?>
                                                        <?php //endif; ?>
                                                    </select> 
                                                    <span id="client_group_cost_err" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="client_group_category">Category:</label>
                                                    <select class="custom-select form-control" name="client_group_category" id="client_group_category">
                                                        <option value="">Select Category</option>
                                                        <?php //if(!empty($groupCatList)): ?>
                                                            <?php //foreach($groupCatList AS $e_g_cat): ?>
                                                            <option value="<?php //echo $e_g_cat['group_category_id']; ?>" ><?php //echo $e_g_cat['group_category_name']; ?></option>
                                                            <?php //endforeach; ?>
                                                        <?php //endif; ?>
                                                    </select> 
                                                    <span id="client_group_category_err" class="text-danger"></span>
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group text-center">
                                                    <?= csrf_field() ?>
                                                    <button type="button" name="submit" class="waves-effect waves-light btn btn-submit create_client_group_btn">Submit</button>
                                                    <button type="button" class="waves-effect waves-light btn btn-dark back_btn">Back</button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </form>
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
<section class="content mt-35 client_list_tbl">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        Group List
                    </h4>
                    <div class="text-right flex-grow">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-submit add_client_group_btn">Create New Group</button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <table class="sortingOffTable table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%">SN</th>
                                            <th width="5%">Group&nbsp;Number</th>
                                            <th>Client&nbsp;Group</th>
                                            <th width="5%">Present&nbsp;Members</th>
                                            <th width="5%">Members&nbsp;Left</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        <?php $totalClientCount=0; ?>
                                        <?php $totalOldClientCount=0; ?>
                                        <?php if(!empty($groupList)): ?>
                                            <?php foreach($groupList AS $e_grp): ?>
                                                <?php $clientCount=$e_grp['presentClientCount']; ?>
                                                <?php $oldClientCount=$e_grp['oldClientCount']; ?>
                                                <?php $totalClientCount+=$clientCount; ?>
                                                <?php $totalOldClientCount+=$oldClientCount; ?>
                                                <tr id="client_group_id_tr_<?php echo $e_grp['client_group_id']; ?>">
                                                    <td width="5%" class="text-center"><?php echo $i; ?></td>
                                                    <td width="5%" class="text-center"><?php echo $e_grp['client_group_number']; ?></td>
                                                    <td>
                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#client_group_<?php echo $e_grp['client_group_id']; ?>">
                                                            <?php echo $e_grp['client_group']; ?>
                                                        </a>
                                                    </td>
                                                    <td width="5%" class="text-center"><?php echo $clientCount; ?></td>
                                                    <td width="5%" class="text-center"><?php echo $oldClientCount; ?></td>
                                                    <!--
                                                    <td width="5%" class="text-center"><?php echo $e_grp['userShortName']; ?></td>
                                                    <td width="5%" class="text-center"><?php echo $e_grp['group_category_name']; ?></td>
                                                    -->
                                                    <td width="5%" class="text-center">
                                                        <!--
                                                        <a href="javascript:void(0);" class="edit_group" data-rowid="<?php //echo $e_grp['client_group_id']; ?>">
                                                            <button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Edit" >
                                                                <i class="fa fa-pencil"></i>&nbsp;Edit
                                                            </button>
                                                        </a>
                                                        <button class="btn btn-sm btn-danger delClientGroup" data-toggle="tooltip" data-original-title="Delete" data-rowid="<?php //echo $e_grp['client_group_id']; ?>" >
                                                            <i class="fa fa-trash"></i>&nbsp;Delete
                                                        </button>
                                                        -->
                                                        
                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                            <a class="dropdown-item edit_group" href="javascript:void(0);" data-rowid="<?php echo $e_grp['client_group_id']; ?>">
                                                                <i class="fa fa-pencil"></i>&nbsp;Edit
                                                            </a>
                                                            <a class="dropdown-item delClientGroup" href="javascript:void(0);" data-rowId="<?php echo $e_grp['client_group_id']; ?>">
                                                                <i class="fa fa-trash"></i>&nbsp;Delete
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                            <tr class="last_total_tr text-center">
                                                <td></td>
                                                <td></td>
                                                <td><b>Total</b></td>
                                                <td><b><?php echo $totalClientCount; ?></b></td>
                                                <td><b><?php echo $totalOldClientCount; ?></b></td>
                                                <!--<td></td>-->
                                                <!--<td></td>-->
                                                <td></td>
                                            </tr>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5"><center>No records found</center></td>
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

<?php if(!empty($groupList)): ?>
    <?php foreach($groupList AS $e_grp): ?>
        
        <!-- Modal -->
        <div id="client_group_<?php echo $e_grp['client_group_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold" id="myModalLabel">Group Members</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5 class="font-weight-bold">Present Members</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="clientGrpTable" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th width="55%">Name&nbsp;of&nbsp;the&nbsp;Client</th>
                                                <th width="40%">Organization&nbsp;Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($clientListArr[$e_grp['client_group_id']])): ?>
                                                <?php $grpClientListArr=$clientListArr[$e_grp['client_group_id']]; ?>
                                                <?php if(!empty($grpClientListArr)): ?>
                                                    <?php $c=1; ?>
                                                    <?php foreach($grpClientListArr AS $e_cl_grp): ?>
                                                        <tr>
                                                            <td width="5%" class="text-center"><?php echo $c; ?></td>
                                                            <td nowrap width="55%">
                                                                <?php
                                                                    if(in_array($e_cl_grp['orgType'], INDIVIDUAL_ARRAY))
                                                                        $cliName=$e_cl_grp['clientName'];
                                                                    else
                                                                        $cliName=$e_cl_grp['clientBussOrganisation']; 
                                                                ?>
                                                                <?php echo $cliName; ?>
                                                            </td>
                                                            <td nowrap width="40%" class="text-center">
                                                                <?php echo $e_cl_grp['organisation_type_name']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php $c++; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="3"><center>No records found</center></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="3"><center>No records found</center></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <hr>
                                <h5 class="font-weight-bold">Members Left</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="clientGrpTable" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th width="55%">Name&nbsp;of&nbsp;the&nbsp;Client</th>
                                                <th width="40%">Organization&nbsp;Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($oldClientListArr[$e_grp['client_group_id']])): ?>
                                                <?php $grpOldClientListArr=$oldClientListArr[$e_grp['client_group_id']]; ?>
                                                <?php if(!empty($grpOldClientListArr)): ?>
                                                    <?php $c=1; ?>
                                                    <?php foreach($grpOldClientListArr AS $e_cl_grp): ?>
                                                        <tr>
                                                            <td width="5%" class="text-center"><?php echo $c; ?></td>
                                                            <td nowrap width="55%">
                                                                <?php
                                                                    if(in_array($e_cl_grp['orgType'], INDIVIDUAL_ARRAY))
                                                                        $cliName=$e_cl_grp['clientName'];
                                                                    else
                                                                        $cliName=$e_cl_grp['clientBussOrganisation']; 
                                                                ?>
                                                                <?php echo $cliName; ?>
                                                            </td>
                                                            <td nowrap width="5%" class="text-center">
                                                                <?php echo $e_cl_grp['organisation_type_name']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php $c++; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="3"><center>No records found</center></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="3"><center>No records found</center></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <button type="button" class="btn btn-danger text-left close_btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
    <?php endforeach; ?>
<?php endif; ?>

<section class="content mt-35 edit_client_grp_div">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        Edit Group
                    </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body box_body_bg card_bg_format">
                    <div class="row">
                        <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                            <div class="form-group form_bg_format">
                                <?php if(!empty($groupList)): ?>
                                    <?php foreach($groupList AS $e_grp): ?>
                                        <form action="" method="post" class="edit_client_grp_form edit_group_form_<?php echo $e_grp['client_group_id']; ?>">
                                            <section>
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <div class="state due-month">
                                                                    <h4 class="text-white font-weight-bold m-0">Edit Client Group</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="client_group">Client Group Name:</label>
                                                            <input type="text" class="form-control" name="client_group" id="client_group" placeholder="Enter Client Group Name" value="<?php echo $e_grp['client_group']; ?>"> 
                                                            <span id="client_group_err" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="client_group_number">Group Number:</label>
                                                            <input type="text" class="form-control" name="client_group_number" id="client_group_number" placeholder="Enter Group Number" value="<?php echo $e_grp['client_group_number']; ?>"> 
                                                            <span id="client_group_number_err" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <!--
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="client_group_cost">Cost Center:</label>
                                                            <select class="custom-select form-control" name="client_group_cost" id="client_group_cost">
                                                                <option value="">Select Cost Center</option>
                                                                <?php //if(!empty($userList)): ?>
                                                                    <?php //foreach($userList AS $e_user): ?>
                                                                    <option value="<?php //echo $e_user['userId']; ?>" <?php //if($e_grp['client_group_cost']==$e_user['userId']): ?>selected<?php //endif; ?> ><?php //echo $e_user['userFullName']; ?></option>
                                                                    <?php //endforeach; ?>
                                                                <?php //endif; ?>
                                                            </select> 
                                                            <span id="client_group_cost_err" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="client_group_category">Category:</label>
                                                            <select class="custom-select form-control" name="client_group_category" id="client_group_category">
                                                                <option value="">Select Category</option>
                                                                <?php //if(!empty($groupCatList)): ?>
                                                                    <?php //foreach($groupCatList AS $e_g_cat): ?>
                                                                    <option value="<?php //echo $e_g_cat['group_category_id']; ?>" <?php //if($e_grp['client_group_category']==$e_g_cat['group_category_id']): ?>selected<?php //endif; ?> ><?php //echo $e_g_cat['group_category_name']; ?></option>
                                                                    <?php //endforeach; ?>
                                                                <?php //endif; ?>
                                                            </select> 
                                                            <span id="client_group_category_err" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    -->
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group text-center">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="client_group_id" value="<?php echo $e_grp['client_group_id']; ?>">
                                                            <button type="button" name="submit" class="waves-effect waves-light btn btn-submit edit_client_group_btn" data-cli_grp_id="<?php echo $e_grp['client_group_id']; ?>">Submit</button>
                                                            <button type="button" class="waves-effect waves-light btn btn-dark edit_back_btn">Back</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </form>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
            
    $(document).ready(function(){

        var base_url = "<?php echo base_url(); ?>";

        $('.get_group_section').hide();
        $('.group_form').hide();
        $('.edit_client_grp_div').hide();
        $('.edit_client_grp_form').hide();
        $('.client_group_div').hide();

        $('.add_client_group_btn').on('click', function(){
            $('.add_client_group_btn').hide();
            $('.add_group_section').hide();
            $('.client_list_tbl').hide();
            $('.get_group_section').hide();
            $('.group_form').show();
            $('.client_group_div').show();
        });

        $('.search_client_group_btn').on('click', function(){

            var search_client_group = $('#search_client_group').val();

            $('#search_client_group_err').text("");

            if(search_client_group=="")
            {
                $('#search_client_group_err').text("Please enter client group");
                return false;
            }

            $.ajax({
                url : base_url+'/getGroups',
                type : 'POST',
                data : { 
                    'client_group' : search_client_group,
                    "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                },
                dataType: 'html',
                success : function(data) {

                    $('#search_client_group').val("");

                    $('.get_group_section').html(data);
                    $('.get_group_section').show();
                    $('.add_group_section').hide();
                    $('.client_list_tbl').hide();
                    $('.add_client_group_btn').hide();

                },
                error : function(request, error)
                {
                    // alert("Request: "+JSON.stringify(request));
                }
            });
        });

        $('.back_btn').on('click', function(){
            $('.group_form').hide();
            $('.add_group_section').show();
            $('.add_client_group_btn').show();
            $('.client_list_tbl').show();
            $('.client_group_div').hide();
        });

        $('.create_client_group_btn').on('click', function(e){

            e.preventDefault();

            var clientGroupData = $('.group_form').serialize();
		    
		    var clientGroupDataArr = $('.group_form').serializeArray();

            $.ajax({
                url : base_url+'/add_client_group',
                type : 'POST',
                data : clientGroupData,
                dataType: 'json',
                success : function(response) {

                    // console.log(response)

                    var resStatus = response['status'];
                    var resMsg = response['message'];
                    var resUserData = response['userdata'];

                    if(resStatus==true)
                    {
                        // swal("Added!!", resMsg, "success");

                        $('.group_form')[0].reset();

                        $.map(clientGroupDataArr, function(n, i){
                
                            var fieldName=n['name'];

                            $("#"+fieldName+"_err").text("");
                        });

                        $('.group_form').hide();
                        $('.add_group_section').show();
                        $('.add_client_group_btn').show();
                        $('.client_list_tbl').show();

                        window.location.href=base_url+"/groups";
                    }
                    else
                    {
                        $.each(resUserData, function(index, value){
                            $("#"+index+"_err").text(value);
                        });

                        swal("Error!", resMsg, "error");
                    }

                },
                error : function(request, error)
                {
                    // alert("Request: "+JSON.stringify(request));
                }
            });

        });

        $('.delClientGroup').on('click', function(e){

            e.preventDefault();

            var client_group_id = $(this).data('rowid');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this client group ?",
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
                        url : base_url+'/delete_client_group',
                        type : 'POST',
                        data : {
                            'client_group_id':client_group_id,
                            "<?= csrf_token() ?>" : "<?= csrf_hash() ?>"
                        },
                        dataType: 'json',
                        success : function(response) {

                            var resStatus = response['status'];
                            var resMsg = response['message'];
                            var resUserData = response['userdata'];

                            if(resStatus==true)
                            {
                                swal("Deleted", resMsg, "success");

                                $('#client_group_id_tr_'+client_group_id).remove();
                            }
                            else
                            {
                                swal("Error!", resMsg, "error");
                            }

                        },
                        error : function(request, error)
                        {
                            // alert("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });

        $('.edit_group').on('click', function(){

            var cli_grp_id = $(this).data('rowid');

            $('.edit_client_grp_div').show();
            $('.edit_client_grp_form').hide();
            $('.client_list_tbl').hide();
            $('.edit_group_form_'+cli_grp_id).show();

        });

        $('.edit_back_btn').on('click', function(){

            $('.edit_client_grp_div').hide();
            $('.edit_client_grp_form').hide();
            $('.client_list_tbl').show();

        });

        $('.edit_client_group_btn').on('click', function(e){

            e.preventDefault();

            var cli_grp_id = $(this).data('cli_grp_id');

            var edit_cli_grp_form='.edit_group_form_'+cli_grp_id;

            var clientGroupData = $(edit_cli_grp_form).serialize();

            var clientGroupDataArr = $(edit_cli_grp_form).serializeArray();

            $.ajax({
                url : base_url+'/edit_client_group',
                type : 'POST',
                data : clientGroupData,
                dataType: 'json',
                success : function(response) {

                    // console.log(response)

                    var resStatus = response['status'];
                    var resMsg = response['message'];
                    var resUserData = response['userdata'];

                    if(resStatus==true)
                    {
                        // swal("Added!!", resMsg, "success");

                        $.map(clientGroupDataArr, function(n, i){
                
                            var fieldName=n['name'];

                            $(edit_cli_grp_form+" #"+fieldName+"_err").text("");
                        });

                        window.location.href=base_url+"/groups";
                    }
                    else
                    {
                        $.each(resUserData, function(index, value){
                            $(edit_cli_grp_form+" #"+index+"_err").text(value);
                        });

                        swal("Error!", resMsg, "error");
                    }

                },
                error : function(request, error)
                {
                    // alert("Request: "+JSON.stringify(request));
                }
            });

        });
        
        // setTimeout(function () {
        //     $('.last_total_tr td').css('padding', '10px');
        // }, 3000);

    });

</script>

<?= $this->endSection(); ?>