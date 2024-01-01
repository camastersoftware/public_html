<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    
    .modal-header {
        border-bottom-color: #d5dfea;
        background-color:#F99D27;
        padding: 8px 8px;
    }

    .income-tax-head {
        background: #ffc800;
        padding:10px;
        margin-bottom:0px;
        font-weight:bold;
    }

    table.dataTable {
        margin-top: 0px !important; 
    }

    .tablepress td, .tablepress th {
        font-weight: 600;
    }

    td.column-1 {
        font-size:14px;
    }

    .tablepress tbody tr:first-child td {
        background: #ffffff;
    }

    .modal-header h4{
        text-align: center;
    }

    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
    }
    
    .getActModal .box{
        cursor: pointer !important;
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
        font-size: 15px !important;
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
    
    .tablepress td {
        font-weight: 400 !important;
    }
    
    .tablepress thead th {
        background-color: #005495 !important;
    }
    
    .demo-checkbox .box-header {
        background-color: #005495 !important;
        border-radius: 10px !important;
    }
    
    .demo-checkbox .box-header.with-border {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        height: 66px !important;
        line-height: 50px !important;
    }
    
    .dataTables_wrapper .form-control{
        margin: 0px !important;
    }
    
    .discontinueClass td {
      color: #9d9c97 !important;
    }
    
    .divLine td {
        background-color: #005495 !important;
        height: 5px !important;
    }
    
</style>

<section class="content client_list_tbl mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?= $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('company-menus'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="sortingOffWithSearchTable table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th>SN</th>
                                    <th nowrap>GN</th>
                                    <th>Company&nbsp;Name</th>
                                    <th>Registration Number</th>
                                    <th>Date of Incorporation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php $currGrp=""; ?>
                                <?php $prevGrp=""; ?>
                                <?php $clrCnt=1; ?>
                                <?php if(!empty($clientList)): ?>
                                    <?php foreach($clientList AS $k_row => $e_row): ?>
                                        <?php $client_group_num=$e_row['client_group_number']; ?>
                                        <?php $currGrp=$client_group_num; ?>
                                        
                                        <?php
                                            if($currGrp!=$prevGrp)
                                                $clrCnt++;
                                            
                                            $clrSeq=($clrCnt%2);
                                            
                                            if($clrSeq==0)
                                                $grpClr="#005495";
                                            else
                                                $grpClr="#f48b04";
                                        ?>
                                        
                                        <tr id="client_id_tr_<?php echo $e_row['clientId']; ?>">
                                            <td class="text-center" width="5%"><?php echo $i; ?></td>
                                            <td class="text-center" width="5%" nowrap>
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $e_row['client_group']; ?>" style="color: <?= $grpClr; ?> !important;">
                                                    <?php
                                                        if(!empty($client_group_num))
                                                            echo $client_group_num;
                                                        else 
                                                            echo " "; 
                                                    ?>
                                                </a>
                                            </td>
                                            <td width="20%" nowrap>
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $e_row['clientBussOrganisation']; ?>">
                                                    <?= $e_row['clientBussOrganisation']; ?>
                                                </a>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                    if(!empty($e_row['clientRegDocument']))
                                                        echo $e_row['clientRegDocument'];
                                                    else
                                                        echo "N/A";
                                                ?>
                                            </td>
                                            <td class="text-center" nowrap>
                                                <?php
                                                    if(check_valid_date($e_row['clientBussIncorporationDate']))
                                                        echo date("d-m-Y", strtotime($e_row['clientBussIncorporationDate']));
                                                    else 
                                                        echo "N/A"; 
                                                ?>
                                            </td>
                                            <td width="5%">
                                                <div class="btn-group">
                                                    <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                        <a class="dropdown-item" href="<?= base_url('edit-company-master-details/'.$e_row['clientId']); ?>">Edit</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php $i++; ?>
                                        <?php $prevGrp=$client_group_num; ?>
                                        
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