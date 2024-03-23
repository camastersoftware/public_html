<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
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
    
    .btnPrimClr {
        margin-top: 5px !important;
        height: 30px !important;
        margin-bottom: 5px !important;
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

</style>

<!-- Main content -->
<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?= $pageTitle ?>
                    </h4>
                    <div class="text-right flex-grow">
                       <a href="<?php echo base_url('staff-administration'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th>User Name</th>
                                    <th>Designation</th>
                                    <th>DOB</th>
                                    <th>DOJ</th>
                                    <th width="5%">Mobile No</th>
                                    <th>Email ID</th>
                                    <th>PAN</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php if(!empty($getUserList)): ?>
                                    <?php foreach($getUserList AS $e_row): ?>
                                        <tr id="user_id_tr_<?php echo $e_row['userId']; ?>">
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td nowrap>
                                                <a href="<?php echo base_url('user/edit_user/'.$e_row['userId']); ?>">
                                                    <?php //echo $e_row['userTitle'].". ".$e_row['userFullName']; ?>
                                                    <?php echo $e_row['userFullName']; ?>
                                                </a>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['userDesgn']))
                                                        echo $e_row['userDesgn']; 
                                                    else
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['userDob']) && $e_row['userDob']!="0000-00-00")
                                                        echo date("d-m-Y", strtotime($e_row['userDob']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                    $userDOJ="N/A";
                                                    if(!empty($e_row['userDOJ']) && $e_row['userDOJ']!="0000-00-00" && $e_row['userDOJ']!="1970-01-01")
                                                        $userDOJ=date('d-m-Y', strtotime($e_row['userDOJ']));
                                                ?>
                                                <?php echo $userDOJ; ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php 
                                                    if(!empty($e_row['userMobile1']))
                                                        echo $e_row['userMobile1']; 
                                                    else
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td nowrap>
                                                <?php 
                                                    if(!empty($e_row['userEmail1']))
                                                        echo $e_row['userEmail1']; 
                                                    else
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td nowrap class="text-center">
                                                <?php 
                                                    if(!empty($e_row['userPan']))
                                                        echo $e_row['userPan']; 
                                                    else
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="<?php echo base_url('employee-salary-payable/'.$e_row['userId']); ?>" >Salary Payable</a>
                                                        <a class="dropdown-item" href="<?php echo base_url('employee-salary-payable-details/'.$e_row['userId']); ?>" >Salary Payable Details</a>
                                                        <a class="dropdown-item" href="<?php echo base_url('payslip/'.$e_row['userId']); ?>" >Payslip</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>     

<?= $this->endSection(); ?>