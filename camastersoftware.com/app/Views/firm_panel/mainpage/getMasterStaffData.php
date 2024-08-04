<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .table-responsive table thead tr {
        background: #005495 !important;
        color: #fff !important;
    }

    .table-responsive table tbody tr {
        background: #96c7f242 !important;
    }

    .table-responsive tr th {
        border: 1px solid #fff !important;
    }

    .table-responsive tr td {
        border: 1px solid #015aacab !important;
    }

    table.dataTable {
        border-collapse: collapse !important;
        font-size: 16px !important;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th {
        padding: 8px 14px !important;
    }

    .btnPrimClr {
        margin-top: 5px !important;
        height: 30px !important;
        margin-bottom: 5px !important;
    }
</style>

<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-12">

            <div class="box mt-35">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?php
                        if (isset($pageTitle))
                            echo $pageTitle;
                        else
                            echo "N/A";
                        ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('getMasterOldStaffData'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-submit" style="">Staff Left</button>
                        </a>
                        <a href="<?php echo base_url('staff-administration'); ?>">
                            <button type="button" class="btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="table-responsive">
                        <table class="data_tbl table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SN</th>
                                    <th>Staff&nbsp;Name</th>
                                    <th>Designation</th>
                                    <th>DOB</th>
                                    <th>DOJ</th>
                                    <th>Mobile&nbsp;No</th>
                                    <th>Email&nbsp;ID</th>
                                    <th>PAN</th>
                                    <!--
                                        <th width="5%">Login&nbsp;Name</th>
                                        <th width="5%">Status</th>
                                        -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($userDataArr)) : ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($userDataArr as $e_row) : ?>
                                        <tr>
                                            <td class="text-center" width="5%"><?php echo $i; ?></td>
                                            <td nowrap>
                                                <!--<a href="<?php //echo base_url('admin/user/edit_user/'.$e_row['userId'].'?master=1'); 
                                                                ?>">-->
                                                <?php echo $e_row['userFullName']; ?>
                                                <!--</a>-->
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                if (!empty($e_row['userDesgn']))
                                                    echo $e_row['userDesgn'];
                                                else
                                                    echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                $userDob = "N/A";
                                                if (!empty($e_row['userDob']) && $e_row['userDob'] != "0000-00-00" && $e_row['userDob'] != "1970-01-01")
                                                    $userDob = date('d-m-Y', strtotime($e_row['userDob']));
                                                ?>
                                                <?php echo $userDob; ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                $userDOJ = "N/A";
                                                if (!empty($e_row['userDOJ']) && $e_row['userDOJ'] != "0000-00-00" && $e_row['userDOJ'] != "1970-01-01")
                                                    $userDOJ = date('d-m-Y', strtotime($e_row['userDOJ']));
                                                ?>
                                                <?php echo $userDOJ; ?>
                                            </td>
                                            <td class="text-center" nowrap><?php echo $e_row['userMobile1']; ?></td>
                                            <td nowrap width="5%">
                                                <?php
                                                if (!empty($e_row['userEmail1']))
                                                    echo $e_row['userEmail1'];
                                                else
                                                    echo "N/A";
                                                ?>
                                            </td>
                                            <td nowrap width="5%" class="text-center">
                                                <?php
                                                if (!empty($e_row['userPan']))
                                                    echo $e_row['userPan'];
                                                else
                                                    echo "N/A";
                                                ?>
                                            </td>
                                            <!--<td class="text-center" nowrap><?php //echo $e_row['userLoginName']; 
                                                                                ?></td>
                                                <td class="text-center" nowrap>
                                                    <?php
                                                    // $userDOL="";
                                                    // if(!empty($e_row['userDOL']) && $e_row['userDOL']!="0000-00-00" && $e_row['userDOL']!="1970-01-01")
                                                    //     $userDOL=date('d-m-Y', strtotime($e_row['userDOL']));
                                                    ?>
                                                    <?php //if(empty($userDOL)): 
                                                    ?>
                                                        <span>Active</span>
                                                    <?php //else: 
                                                    ?>
                                                        <span style="color: red;">Left</span>
                                                    <?php //endif; 
                                                    ?>
                                                </td>
                                                -->
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7">
                                            <center>No records</center>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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

<?= $this->endSection(); ?>