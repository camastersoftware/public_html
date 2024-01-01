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
                            <a href="<?php echo base_url('superadmin/home'); ?>"><button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button></a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    
                        <div class="table-responsive">
                            <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">SN</th>
                                        <th width="18%">Name</th>
                                        <!--<th>Profession</th>-->
                                        <!--<th>Firm&nbsp;Type</th>-->
                                        <!--<th>PAN&nbsp;No</th>-->
                                        <th>Contact&nbsp;Person</th>
                                        <th>Contact&nbsp;No</th>
                                        <th>Email&nbsp;Address</th>
                                        <!--<th>Address</th>-->
                                        <th>Users</th>
                                        <th>License&nbsp;no</th>
                                        <th>Alloted&nbsp;On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($firmList)): ?>
                                        <?php $i=1; ?>
                                        <?php foreach($firmList AS $e_row): ?>
                                            <tr>
                                    			<td class="text-center"><?php echo $i; ?></td>
                                    			<td nowrap><?php echo $e_row['caFirmName']; ?></td>
                                    		    <!--<td class="text-center" nowrap><?php //echo $e_row['profession_type_name']; ?></td>-->
                                    			<!--<td class="text-center" nowrap><?php //echo $e_row['caFirmType']; ?></td>-->
                                    			<!--<td class="text-center"><?php //echo $e_row['caFirmPan']; ?></td>-->
                                    			<td nowrap><?php echo $e_row['caFirmContactPerson']; ?></td>
                                    			<td class="text-center"><?php echo $e_row['caFirmMobile']; ?></td>
                                    			<td><?php echo $e_row['caFirmEmail']; ?></td>
                                    			<!--<td class="text-center"><?php //echo $e_row['caFirmAddress']; ?></td>-->
                                    			<td class="text-center"><?php echo $e_row['caFirmUsers']; ?></td>
                                    			<td class="text-center"><?php echo $e_row['caFirmCompanyKey']; ?></td>
                                    			<td class="text-center" nowrap>
                                    			    <?php
                                    			        if($e_row['caFirmAllotmentDate']!="" && $e_row['caFirmAllotmentDate']!="1970-01-01"  && $e_row['caFirmAllotmentDate']!="0000-00-00")
                                    			            $caFirmAllotmentDate=date('Y-m-d', strtotime($e_row['caFirmAllotmentDate']));
                                    			        else
                                    			            $caFirmAllotmentDate="";
                                    			            
                                    			        if(!empty($caFirmAllotmentDate))
                                    			            echo date('d-m-Y', strtotime($caFirmAllotmentDate));
                                    			        else
                                    			            echo "---";
                                    			    ?>
                                    			</td>
                                    			<td class="text-center">
                                    			    <div class="btn-group">
                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateDataBank<?php echo $e_row['data_bank_id']; ?>">View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateDataBank<?php echo $e_row['data_bank_id']; ?>">Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateDataBank<?php echo $e_row['data_bank_id']; ?>">Delete</a>
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