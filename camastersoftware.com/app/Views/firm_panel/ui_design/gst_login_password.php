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
            margin-left: -17.5em !important;
            display: inline-block;
            width: auto;
            z-index: 9999999 !important;
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
                        	<a href="javascript:void(0);" data-toggle="modal" data-target="#addTDList">
                                <button class="btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('admin/home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right font-weight-bold" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                    <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                        <thead>
                                            <tr class="row-1">
                                                <th class="column-1" colspan="7">GST</th>
                                                <th class="column-2" colspan="2">E-way Bill</th>
                                            </tr>
                                            <tr class="row-1">
                                                <th class="column-1">Sr</th>
                                                <th class="column-2">GR No</th>
                                                <th class="column-3">Name of the Client</th>
                                                <th class="column-3">Status</th>
                                                <th class="column-4">GSTIN</th>
                                                <th class="column-5">Username</th>
                                                <th class="column-6">Password</th>
                                                <th class="column-7">E-Way Bill Login</th>
                                                <th class="column-8">Password</th>
                                            </tr>
                                        </thead>
                                        <tbody class="row-hover">
                                            <?php $sr=1; ?>
                                                <?php if(!empty($mthTaxPayerClientArray)): ?>
                                                    <?php foreach($mthTaxPayerClientArray AS $e_inc_row): ?>
                                                        <tr class="row-1">
                                                            <td class="column-1">
                                                                <?php echo $sr; ?>
                                                            </td>
                                                            <td class="column-2">
                                                                <?php echo $e_inc_row['client_group_number']; ?>
                                                            </td>
                                                            <td class="column-3">
                                                                <a href="<?php echo base_url('admin/income_tax/work_form/'.$e_inc_row['workId']); ?>">
                                                                    <?php //echo $e_inc_row['clientTitle'].". ".$e_inc_row['clientName']; ?>
                                                                    
                                                                    <?php 
                                                                        if($e_inc_row['orgType']==8 || $e_inc_row['orgType']==9)
                                                                            echo $e_inc_row['clientName'];
                                                                        else
                                                                            echo $e_inc_row['clientBussOrganisation']; 
                                                                    ?>
                                                                </a>
                                                            </td>
                                                            <td class="column-4">
                                                                <?php echo $e_inc_row['act_option_name1']; ?>
                                                            </td>
                                                            <td class="column-5">
                                                                <?php 
                                                                    if($e_inc_row['isDocRecvd']==1)
                                                                        echo "Yes";
                                                                    elseif($e_inc_row['isDocRecvd']==2)
                                                                        echo "No"; 
                                                                    else
                                                                        echo "-"; 
                                                                ?>
                                                            </td>
                                                            <td class="column-6">
                                                                <?php if($e_inc_row['juniors']!=""): ?>
                                                                    <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?php echo $e_inc_row['juniors']; ?>">
                                                                        <?php 
                                                                            echo substr_replace($e_inc_row['juniors'], "...", 10); 
                                                                        ?>
                                                                    </a>
                                                                <?php else: ?>
                                                                    -
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="column-7">
                                                                <?php echo $e_inc_row['seniorName']; ?>
                                                            </td>
                                                            <td class="column-8">
                                                                <?php echo $e_inc_row['workDone']; ?>
                                                            </td>
                                                            <td class="column-9"></td>
                                                            <td class="column-10"></td>
                                                            <td class="column-11">Free</td>
                                                            <td class="column-12">-</td>
                                                            <td class="column-13">-</td>
                                                            <td class="column-14">-</td>
                                                            <td class="column-15">-</td>
                                                            <td class="column-16">0</td>
                                                        </tr>
                                                        <?php $sr++; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <tr class="row-1">
                                                    <td colspan="16" class="column-1">
                                                        No records found
                                                    </td>
                                                </tr>
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

    <!-- Modal -->
    <div id="addTDList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo base_url('admin/addTDList'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add New</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                        	<div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Name of Client<small class="text-danger">*</small></label>
                                    <select class="custom-select form-control" name="tdAllotedTo" id="tdAllotedTo" required>
                                        <option value="">Select</option>
                                         <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Status<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="DINNo" id="DINNo" placeholder="Enter DIN No." value="autofetch" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>GSTIN<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="GSTIN" id="GSTIN" placeholder="Enter GSTIN" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Username<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="Username" id="Username" placeholder="Enter Username" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Password<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="Password" id="Password" placeholder="Enter Password" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>E-Way Bill Login<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="E-WaybillLogin" id="E-WaybillLogin" placeholder="Enter E-Way Bill Login" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Password<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="Password" id="Password" placeholder="Enter Password" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Remark<small class="text-danger">*</small></label>
                                    <textarea class="form-control" name="Remark" id="Remark" placeholder="Enter Remark" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="tdPriority" id="tdPriority" value="1" />
                        <input type="hidden" name="tdPriorityColor" id="tdPriorityColor" value="none" />
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

                    var postingUrl = base_url+'/admin/deleteContact';
                    $.post(postingUrl, 
                    {
                        contactId: contactId
                    },
                    function(data, status){
                        window.location.href=base_url+"/admin/contactList";
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
        
        window.location.href=base_url+"/admin/contactList?group="+cont_group_id;
    }
    
    function serachSubGroup($this)
    {
        var cont_group_id=$('#contGroupId').val();
        var cont_sub_group_id=$this.value;
        
        window.location.href=base_url+"/admin/contactList?group="+cont_group_id+"&sub_group="+cont_sub_group_id;
    }

</script>
    
<?= $this->endSection(); ?>