<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>

    .tabcontent-border {
        border: none;
        border-top: 0px;
    }
    
    .due-month{
        background:#F99D27;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }
    
    .due-month label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .heading-act {
        background:#00669d;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
        color:#fff;
    }
    
    .heading-act label{
        margin-top: 2px;
        margin-bottom: 2px;
    }
    
    .table.dataTable-act {
        margin-top: 0px !important; 
        font-size: 12px !important;
        clear: both;
        margin-bottom: 6px !important;
        max-width: none !important;
        border-collapse: separate !important;
    }
    
    .tablepress thead tr, .tablepress thead th {
        border: 1px solid #ddd;
        color: #fff;
        font-size: 13px;
    }
    
    .tablepress tbody {
        font-size: 13px;
    }
    
    td.column-1 {
        text-align: center;
        font-weight: normal;
        font-size: 13px;
    }
    
    .tablepress tbody tr:first-child td {
        background: none;
    }
    
    .tablepress tbody tr:nth-child(4) td.column-1 {
        background: none;
    }
    
    .box-body {
        padding: 0.1rem 0.1rem;
        /* -ms-flex: 1 1 auto; */
        flex: 1 1 auto;
        border-radius: 10px;
    }
    
    .modal-header {
        
        border-bottom-color: #d5dfea;
        background-color: #F99D27;
        padding: 8px 8px;
    }
    
    .theme-primary .btn-success1 {
        background-color: #1e613b !important;
        border-color: #1e613b !important;
        color: #ffffff !important;
        width: 100px;
        font-size: 13px;
    }
    
    .theme-primary a:hover, .theme-primary a:focus {
        color: #303030 !important;
    }
    
    a {
        color: #303030;
    }

    .sub_btn{
        width: 80px !important;
    }
    
    
</style>
<?php $s_time = strtotime("2019-12-01"); ?>
<!-- Main content -->
<section class="content mt-35">
    <div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#Modalfilter-intax">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Filter">
                                    <i class="fa fa-filter"></i>&nbsp;Filter
                                </button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('admin/inc_menus'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body p-10">
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="apr-tab" data-toggle="tab" href="#apr_tab" role="tab" aria-controls="profile" aria-selected="true"> 
                                        <span class="hidden-sm-up">
                                            <i class="ion-person"></i>
                                        </span> 
                                        <span class="hidden-xs-down year-color font-weight-bold">April</span> 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="may-tab" data-toggle="tab" href="#may_tab" role="tab" aria-controls="profile" aria-selected="false"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">May</span> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="jun-tab" data-toggle="tab" href="#jun_tab" role="tab" aria-controls="profile" aria-selected="false"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">June</span> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="jul-tab" data-toggle="tab" href="#jul_tab" role="tab" aria-controls="profile"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">July</span> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="aug-tab" data-toggle="tab" href="#aug_tab" role="tab" aria-controls="profile"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">August</span> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="sep-tab" data-toggle="tab" href="#sep_tab" role="tab" aria-controls="profile"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">September</span> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="oct-tab" data-toggle="tab" href="#oct_tab" role="tab" aria-controls="profile"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">October</span> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="nov-tab" data-toggle="tab" href="#nov_tab" role="tab" aria-controls="profile"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">November</span> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="dec-tab" data-toggle="tab" href="#dec_tab" role="tab" aria-controls="profile"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">December</span> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="jan-tab" data-toggle="tab" href="#jan_tab" role="tab" aria-controls="profile"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">January</span> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="feb-tab" data-toggle="tab" href="#feb_tab" role="tab" aria-controls="profile"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">February</span> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="mar-tab" data-toggle="tab" href="#mar_tab" role="tab" aria-controls="profile"> <span class="hidden-sm-up">
                                                                    <i class="ion-person"></i>
                                                                </span> <span class="hidden-xs-down year-color font-weight-bold">March</span> </a>
                                </li>
                            </ul>
                        <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                <!-- Tab panes -->
                                <div class="tab-pane fade table-responsive show active" id="_tab" role="tabpanel" aria-labelledby="-tab">
                                    <div class="tab-content tabcontent-border p-5" id="myTabContent">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="state due-month">
                                                    <label>Due Date For : 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                                <thead>
                                                    <tr class="row-0">
                                                        <th class="column-1" colspan="5">Due Date :</th>
                                                        <th class="column-2" colspan="4">Periodicity : Yearly</th>
                                                        <th class="column-3" colspan="7">
                                                            Period :     
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr class="row-1">
                                                        <th class="column-1">Sr</th>
                                                        <th class="column-2">Group</th>
                                                        <th class="column-3">Name of the Client</th>
                                                        <th class="column-3">Tax Payer</th>
                                                        <th class="column-4">DOC</th>
                                                        <th class="column-5" colspan="2">ALLOTED TO</th>
                                                        <th class="column-6" colspan="2">COMPELTED</th>
                                                        <th class="column-7">SET</th>
                                                        <th class="column-8">BILLING</th>
                                                        <th class="column-9" colspan="3">Bill Details</th>
                                                        <th class="column-11"colspan="2">Recipts</th>
                                                    </tr>
                                                    <tr class="row-1">
                                                        <th class="column-1">No</th>
                                                        <th class="column-2">No</th>
                                                        <th class="column-3"></th>
                                                        <th class="column-3"></th>
                                                        <th class="column-4">RECD</th>
                                                        <th class="column-5">JUNIOR</th>
                                                        <th class="column-6">SENIOR</th>
                                                        <th class="column-7">%</th>
                                                        <th class="column-8">ON</th>
                                                        <th class="column-9">BY</th>
                                                        <th class="column-11">TYPE</th>
                                                        <th class="column-12">NO</th>
                                                        <th class="column-13">Date</th>
                                                        <th class="column-14">Amount</th>
                                                        <th class="column-15">Date</th>
                                                        <th class="column-16">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row-hover">      
                                                    <tr class="row-1">
                                                        <td class="column-1">
                                                        1 
                                                        </td>
                                                        <td class="column-2">
                                                            A-001
                                                        </td>
                                                        <td class="column-3">
                                                            <a href="<?php echo base_url('admin/gst_audit_form'); ?>"> CAMaster Software Private Limited  
                                                            </a>
                                                        </td>
                                                        <td class="column-4">
                                                           Company 
                                                        </td>
                                                        <td class="column-5">
                                                            -
                                                        </td>
                                                        <td class="column-6">-
                                                        </td>
                                                        <td class="column-7">
                                                            -
                                                        </td>
                                                        <td class="column-8">
                                                            -
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
                                                </tbody>
                                            </table>
                                        </div>
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
</section>
<!-- /.content -->

<!-- Modal -->
<div id="Modalfilter-intax" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Client Group : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control" name="ftr_clientgrp" id="ftr_clientgrp">
                                        <option value="">Select Client Group</option>
                                        <?php if(!empty($groupList)): ?>
                                            <?php foreach($groupList AS $e_cl_grp): ?>
                                                <option value="<?php echo $e_cl_grp['client_group_id']; ?>" <?php echo $ftr_clientgrp==$e_cl_grp['client_group_id'] ? "selected":""; ?> ><?php echo $e_cl_grp['client_group']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Client Name : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control select2" name="ftr_client" id="ftr_client" style="width:100%;">
                                        <option value="">Select Client</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Cost Center : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control select2" name="ftr_costcenter" id="ftr_costcenter" style="width:100%;">
                                        <option value="">Select Cost Center</option>
                                        <?php if(!empty($getUserList)): ?>
                                            <?php foreach($getUserList AS $e_usr): ?>
                                                <?php if($e_usr['isCostCenter']==1): ?>
                                                    <option value="<?php echo $e_usr['userId']; ?>" <?php echo $ftr_costcenter==$e_usr['userId'] ? "selected":""; ?>><?php echo $e_usr['userFullName']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Staff Name : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control select2" name="ftr_staff" id="ftr_staff" style="width:100%;">
                                        <option value="">Select Staff</option>
                                        <?php if(!empty($getUserList)): ?>
                                            <?php foreach($getUserList AS $e_usr_val): ?>
                                                <option value="<?php echo $e_usr_val['userId']; ?>" <?php echo $ftr_staff==$e_usr_val['userId'] ? "selected":""; ?>><?php echo $e_usr_val['userFullName']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Due Date For : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control select2" name="ftr_ddf" id="ftr_ddf" style="width:100%;">
                                        <option value="">Select Due Date For</option>
                                        <?php if(!empty($dueDateForList)): ?>
                                            <?php foreach($dueDateForList AS $e_ddf): ?>
                                                <option value="<?php echo $e_ddf['act_option_map_id']; ?>" <?php echo $ftr_ddf==$e_ddf['act_option_map_id'] ? "selected":""; ?>><?php echo $e_ddf['act_option_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Periodicity : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control" name="ftr_period" id="ftr_period">
                                        <option value="">Select Periodicity</option>
                                        <?php if(!empty($periodArr)): ?>
                                            <?php foreach($periodArr AS $e_prd): ?>
                                                <option value="<?php echo $e_prd['periodicity_id']; ?>" <?php echo $ftr_period==$e_prd['periodicity_id'] ? "selected":""; ?>><?php echo $e_prd['periodicity_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Due Date Month : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control" name="ftr_ddm" id="ftr_ddm">
                                        <option value="">Select Month</option>
                                        <?php for($m_t=1; $m_t<13; $m_t++): ?>
                                            <?php 
                                                if($m_t<=9)
                                                    $a_t=$m_t+3;
                                                else
                                                    $a_t=$m_t-9;
                                                    
                                                $u_t=date('F', strtotime("+".$a_t." month", $s_time));
                                            ?>
                                            <option value=""></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <a href="<?php echo base_url('admin/inc_tax_audits'); ?>">
                        <button type="button" class="btn btn-warning text-left" >Reset</button>
                    </a>
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
    $client_arr=array();
    if(!empty($getClientList))
    {
        foreach($getClientList AS $k_c=>$e_c)
        {
            $clName = str_replace("'", "", $e_c['clientName']);
            $client_arr[$k_c]['clientId']=$e_c['clientId'];
            $client_arr[$k_c]['clientName']=$clName;
            $client_arr[$k_c]['clientGroup']=$e_c['clientGroup'];
        }
    }
?>

<script>
    
    $(document).ready(function(){
        
        $('#ftr_clientgrp').on('change', function(){
            
            var ftr_clientgrp = $(this).val();
            var client_arr = '<?php echo json_encode($client_arr); ?>';
            var selected=null;
            var selClient="";
            
            $('#ftr_client').html("");
            $('#ftr_client').html("<option value=''>Select Client</option>");
            
            var clientArr=jQuery.parseJSON(client_arr);
            
            $.each(clientArr, function( index, value ) {
            
                var clientId=value['clientId'];
                var clientName=value['clientName'];
                var clientGroup=value['clientGroup'];
                
                if(clientGroup==ftr_clientgrp)
                {
                    if(clientId==selClient)
                        selected="selected";
                    else
                        selected="";
                    
                    $('#ftr_client').append("<option value='"+clientId+"' "+selected+" >"+clientName+"</option>");
                }
            
            }); 
            
        })
        
        $('#ftr_clientgrp').trigger('change');
        
    });
    
</script>


<?= $this->endSection(); ?>