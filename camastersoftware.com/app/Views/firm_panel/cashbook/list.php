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
            /*font-size: 16px !important;*/
            font-size: 14px !important;
        }
        
        .table > tbody > tr > td, .table > tbody > tr > th {
            padding: 0px 14px !important;
            height: 40px !important;
        }
        
        .table > thead > tr:not(:first-child) {
            height: 40px !important;
        }
        
        .table > thead > tr:first-child {
            height: 10px !important;
        }
        
        .btnPrimClr {
            margin-top: 5px !important;
            height: 30px !important;
            margin-bottom: 5px !important;
        }
        
        table.dataTable{
            margin-top: -20px !important;
        }
        
        /*Ref: https://codepen.io/Vikaspatel/pen/BawZeag*/
        
        .year-color {
            color: #303030 !important;
            font-weight: bold !important;
        }
        
        .tbl_title{
            font-size: 22px !important;
            padding: 0px !important;
        }
        
        .container-fluid, .container-sm, .container-md, .container-lg, .container-xl {
            width: 100%;
            padding-right: 0px !important;
            padding-left: 0px !important;
            margin-right: auto;
            margin-left: auto;
        }
        
        .receiptTbl tbody tr td:last-child{
            border-right-color: #ffffff !important;
        }
        
        .paidTbl tbody tr td:first-child{
            border-left-color: #ffffff !important;
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
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addTransaction">
                                <button class="btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <?php for($m_no=1;$m_no<13;$m_no++): ?>
                            <?php
                                if($m_no<=9)
                                    $m=$m_no+3;
                                else
                                    $m=$m_no-9;
                            ?>
                            <?php $mth_nm=strtolower(date('M', strtotime("2021-".$m."-1"))); ?>
                            <li class="nav-item"> 
                                <a class="nav-link <?php if($m==$currMth): ?>active<?php endif; ?>" id="<?php echo $mth_nm; ?>-tab" data-toggle="tab" href="#<?php echo $mth_nm; ?>_tab" role="tab" aria-controls="profile">
                                    <span class="hidden-sm-up">
                                        <i class="ion-person"></i>
                                    </span> 
                                    <span class="hidden-xs-down year-color"><?php echo date('F', strtotime("2021-".$m."-1")); ?></span>
                                </a>
                            </li>	
                            <?php endfor; ?>
                        </ul>
                        <?php
                            $opBalAmount=0;
                            $totalRecvdAmount=0;
                            $totalPaidAmount=0;
                        ?>
                        <div class="tab-content tabcontent-border p-15" id="myTabContent">
                            <?php for($mth_no=1;$mth_no<13;$mth_no++): ?>
                            <?php
                                if($mth_no<=9)
                                {
                                    $yrVal = $fisrtYr;
                                    $mth=$mth_no+3;
                                }
                                else
                                {
                                    $yrVal = $secondYr;
                                    $mth=$mth_no-9;
                                }
                            ?>
                            <?php $mth_nm=strtolower(date('M', strtotime($yrVal."-".$mth."-1"))); ?>
                                <?php
                                    // if(isset($cbMthAmt[$mth]))
                                    //     $opBal=$cbMthAmt[$mth];
                                    // else
                                    //     $opBal=0;
                                        
                                    if($mth==4)
                                       $opBal=$totalBalance;
                                    else
                                       $opBal=$opBalAmount; 
                                        
                                    if(isset($mthMaxVal[$mth]))
                                        $mthMax=$mthMaxVal[$mth];
                                    else
                                        $mthMax=0;
                                
                                ?>
                                <div class="tab-pane fade table-responsive <?php if($mth==$currMth): ?>show active<?php endif; ?>" id="<?php echo $mth_nm; ?>_tab" role="tabpanel" aria-labelledby="<?php echo $mth_nm; ?>-tab">
                                    <div class="table-responsive d-flex">
                                        <table class="simpleDtTable receiptTbl table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th colspan="5" class="tbl_title">Receipts (&#8377;)</th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th width="5%">Date</th>
                                                    <th width="5%">Received&nbsp;From</th>
                                                    <th width="5%">Received&nbsp;For</th>
                                                    <th width="5%">Amount</th>
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                        			<td nowrap class="text-center"><?php echo date("01-m-Y", strtotime($yrVal."-".$mth."-1")); ?></td>
                                        			<td nowrap class="font-weight-bold">Opening Balance</td>
                                        			<td class="text-center">-</td>
                                        			<td nowrap class="text-right"><?php echo money_format('%!i', $opBal); ?></td>
                                        			<td class="text-center">
                                        			    <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;"></div>
                                                        </div>
                                        			</td>
                                        		</tr>
                                        		<?php $recvdCount=0; ?>
                                                <?php if(isset($cbArr[$mth][1])): ?>
                                                    <?php $recvdArray=$cbArr[$mth][1]; ?>
                                                    <?php if(!empty($recvdArray)): ?>
                                                        <?php $i=1; ?>
                                                        <?php foreach($recvdArray AS $e_row): ?>
                                                            <?php $totalRecvdAmount+=$e_row['cbAmt']; ?>
                                                            <tr>
                                                    			<td nowrap class="text-center"><?php echo date("d-m-Y", strtotime($e_row['cbDate'])); ?></td>
                                                    			<td nowrap>
                                                    			    <?php $cbFromTo=$e_row['cbFromTo']; ?>
                                                                    <a href="javascript:void(0);" class="txt-black" data-toggle="tooltip" data-original-title="<?php echo $cbFromTo; ?>">
                                                                        <?php 
                                                                            if(strlen($cbFromTo)>15)
                                                                            {
                                                                                echo substr($cbFromTo, 0, 15)."..";
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $cbFromTo;
                                                                            }
                                                                        ?>
                                                                    </a>
                                                    			</td>
                                                    			<td nowrap>
                                                    			    <?php $cbFor=$e_row['cbFor']; ?>
                                                                    <a href="javascript:void(0);" class="txt-black" data-toggle="tooltip" data-original-title="<?php echo $cbFor; ?>">
                                                                        <?php 
                                                                            if(strlen($cbFor)>15)
                                                                            {
                                                                                echo substr($cbFor, 0, 15)."..";
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $cbFor;
                                                                            }
                                                                        ?>
                                                                    </a>
                                                    			</td>
                                                    			<td nowrap class="text-right"><?php echo money_format('%!i', $e_row['cbAmt']); ?></td>
                                                    			<td class="text-center">
                                                    			    
                                                    			    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateTransaction<?php echo $e_row['cbId']; ?>">Edit</a>
                                                                            <a class="dropdown-item deleteTransaction" href="javascript:void(0);" data-id="<?php echo $e_row['cbId']; ?>">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    
                                                    			</td>
                                                    		</tr>
                                                		    <?php $i++; ?>
                                                		    <?php $recvdCount++; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php //$recvdCount=count($recvdArray); ?>
                                                <?php $recvdRowCount=$mthMax-$recvdCount; ?>
                                                <?php for($rv=1; $rv<=$recvdRowCount; $rv++): ?>
                                                    <tr style="background-color:#dbe3dd9e !important;">
                                            			<td nowrap class="text-center">-</td>
                                            			<td nowrap class="text-center">-</td>
                                            			<td nowrap class="text-center">-</td>
                                            			<td nowrap class="text-center">-</td>
                                            			<td nowrap class="text-center">-</td>
                                            		</tr>
                                                <?php endfor; ?>
                                                <tr>
                                        			<td nowrap class="text-center"><?php echo date("t-m-Y", strtotime($yrVal."-".$mth."-1")); ?></td>
                                        			<td nowrap class="font-weight-bold">Total Receipts</td>
                                        			<td class="text-center">-</td>
                                        			<td nowrap class="text-right font-weight-bold"><?php echo money_format('%!i', $totalRecvdAmount); ?></td>
                                        			<td class="text-center">
                                        			    <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;"></div>
                                                        </div>
                                        			</td>
                                        		</tr>
                                        		<tr style="background-color:#dbe3dd9e !important;">
                                        			<td nowrap class="text-center">-</td>
                                        			<td nowrap class="text-center">-</td>
                                        			<td nowrap class="text-center">-</td>
                                        			<td nowrap class="text-center">-</td>
                                        			<td nowrap class="text-center">-</td>
                                        		</tr>
                                        		<?php $totalRecvd=$opBal+$totalRecvdAmount; ?>
                                        		<tr>
                                        			<td nowrap class="text-center"><?php echo date("t-m-Y", strtotime($yrVal."-".$mth."-1")); ?></td>
                                        			<td class="text-center">-</td>
                                        			<td nowrap class="font-weight-bold text-center">Total</td>
                                        			<td nowrap class="font-weight-bold text-right"><?php echo money_format('%!i', $totalRecvd); ?></td>
                                        			<td class="text-center">
                                        			    <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;"></div>
                                                        </div>
                                        			</td>
                                        		</tr>
                                            </tbody>
                                        </table>
                                        <table class="simpleDtTable paidTbl table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th colspan="5" class="tbl_title">Payments (&#8377;)</th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th width="5%">Date</th>
                                                    <th width="5%">Paid&nbsp;To</th>
                                                    <th width="5%">Paid&nbsp;For</th>
                                                    <th width="5%">Amount</th>
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="background-color:#dbe3dd9e !important;">
                                        			<td nowrap class="text-center">-</td>
                                        			<td nowrap class="text-center">-</td>
                                        			<td nowrap class="text-center">-</td>
                                        			<td nowrap class="text-center">-</td>
                                        			<td nowrap class="text-center">-</td>
                                        		</tr>
                                        		<?php $paidCount=0; ?>
                                                <?php if(isset($cbArr[$mth][2])): ?>
                                                    <?php $paidArray=$cbArr[$mth][2]; ?>
                                                    <?php if(!empty($paidArray)): ?>
                                                        <?php $i=1; ?>
                                                        <?php foreach($paidArray AS $e_row): ?>
                                                            <?php $totalPaidAmount+=$e_row['cbAmt']; ?>
                                                            <tr>
                                                    			<td nowrap class="text-center"><?php echo date("d-m-Y", strtotime($e_row['cbDate'])); ?></td>
                                                    			<td nowrap>
                                                    			    <?php $cbFromTo=$e_row['cbFromTo']; ?>
                                                                    <a href="javascript:void(0);" class="txt-black" data-toggle="tooltip" data-original-title="<?php echo $cbFromTo; ?>">
                                                                        <?php 
                                                                            if(strlen($cbFromTo)>15)
                                                                            {
                                                                                echo substr($cbFromTo, 0, 15)."..";
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $cbFromTo;
                                                                            }
                                                                        ?>
                                                                    </a>
                                                    			</td>
                                                    			<td nowrap>
                                                    			    <?php $cbFor=$e_row['cbFor']; ?>
                                                                    <a href="javascript:void(0);" class="txt-black" data-toggle="tooltip" data-original-title="<?php echo $cbFor; ?>">
                                                                        <?php 
                                                                            if(strlen($cbFor)>15)
                                                                            {
                                                                                echo substr($cbFor, 0, 15)."..";
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $cbFor;
                                                                            }
                                                                        ?>
                                                                    </a>
                                                    			</td>
                                                    			<td nowrap class="text-right"><?php echo money_format('%!i', $e_row['cbAmt']); ?></td>
                                                    			<td class="text-center">
                                                    			    
                                                    			    <div class="btn-group">
                                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#updateTransaction<?php echo $e_row['cbId']; ?>">Edit</a>
                                                                            <a class="dropdown-item deleteTransaction" href="javascript:void(0);" data-id="<?php echo $e_row['cbId']; ?>">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    
                                                    			</td>
                                                    		</tr>
                                                		    <?php $i++; ?>
                                                		    <?php $paidCount++; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php //$paidCount=count($paidArray); ?>
                                                <?php $paidRowCount=$mthMax-$paidCount; ?>
                                                <?php for($pd=1; $pd<=$paidRowCount; $pd++): ?>
                                                    <tr style="background-color:#dbe3dd9e !important;">
                                            			<td nowrap class="text-center">-</td>
                                            			<td nowrap class="text-center">-</td>
                                            			<td nowrap class="text-center">-</td>
                                            			<td nowrap class="text-center">-</td>
                                            			<td nowrap class="text-center">-</td>
                                            		</tr>
                                                <?php endfor; ?>
                                                <tr>
                                        			<td nowrap class="text-center"><?php echo date("t-m-Y", strtotime($yrVal."-".$mth."-1")); ?></td>
                                        			<td nowrap class="font-weight-bold">Total Payments</td>
                                        			<td class="text-center">-</td>
                                        			<td nowrap class="text-right font-weight-bold"><?php echo money_format('%!i', $totalPaidAmount); ?></td>
                                        			<td class="text-center">
                                        			    <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;"></div>
                                                        </div>
                                        			</td>
                                        		</tr>
                                        		<?php $totalPaid=$totalRecvd-$totalPaidAmount; ?>
                                                <tr>
                                        			<td nowrap class="text-center"><?php echo date("t-m-Y", strtotime($yrVal."-".$mth."-1")); ?></td>
                                        			<td nowrap class="font-weight-bold">Closing Balance</td>
                                        			<td class="text-center">-</td>
                                        			<td nowrap class="text-right"><?php echo money_format('%!i', $totalPaid); ?></td>
                                        			<td class="text-center">
                                        			    <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;"></div>
                                                        </div>
                                        			</td>
                                        		</tr>
                                        		<tr>
                                        			<td nowrap class="text-center"><?php echo date("t-m-Y", strtotime($yrVal."-".$mth."-1")); ?></td>
                                        			<td nowrap class="text-center">-</td>
                                        			<td class="font-weight-bold text-center">Total</td>
                                        			<td nowrap class="font-weight-bold text-right"><?php echo money_format('%!i', ($totalPaidAmount+$totalPaid)); ?></td>
                                        			<td class="text-center">
                                        			    <div class="btn-group">
                                                            <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" style="will-change: transform;"></div>
                                                        </div>
                                        			</td>
                                        		</tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php
                                    $opBalAmount=$totalPaid;
                                    $totalRecvdAmount=0;
                                    $totalPaidAmount=0;
                                ?>
                            <?php endfor; ?>
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
    
    <?php if(!empty($cashbookArr)): ?>
        <?php foreach($cashbookArr AS $e_row): ?>
        
        <!-- Modal -->
        <div id="updateTransaction<?php echo $e_row['cbId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="<?php echo base_url('updateTransaction'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Transaction</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Date<small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" name="cbDate" id="cbDate" value="<?= $e_row['cbDate']; ?>" min="<?= $fromDate; ?>" max="<?= $toDate; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Transaction Type<small class="text-danger">*</small></label>
                                        <select class="custom-select form-control cbType" name="cbType" data-id="<?= $e_row['cbId']; ?>" required>
                                            <option value="">Select</option>
                                            <option value="1" <?php if($e_row['cbType']=="1"): ?>selected<?php endif; ?>>Receipt</option>
                                            <option value="2" <?php if($e_row['cbType']=="2"): ?>selected<?php endif; ?>>Payment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label><span id="cbFromToLabel<?= $e_row['cbId']; ?>">Received From</span><small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="cbFromTo" id="cbFromTo<?= $e_row['cbId']; ?>" placeholder="Enter Something" value="<?= $e_row['cbFromTo']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label><span id="cbForLabel<?= $e_row['cbId']; ?>">Received For</span><small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="cbFor" id="cbFor<?= $e_row['cbId']; ?>" placeholder="Enter Something" value="<?= $e_row['cbFor']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Amount<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="cbAmt" id="cbAmt" onkeypress='validateNum(event)' value="<?= $e_row['cbAmt']; ?>" placeholder="Enter Amount" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <textarea class="form-control" name="cbRemark" id="cbRemark" ><?= $e_row['cbRemark']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <input type="hidden" name="cbId" id="cbId" value="<?= $e_row['cbId']; ?>">
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
    <div id="addTransaction" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo base_url('addTransaction'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Transaction</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Date<small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="cbDate" id="cbDate" min="<?= $fromDate; ?>" max="<?= $toDate; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Transaction Type<small class="text-danger">*</small></label>
                                    <select class="custom-select form-control" name="cbType" id="cbType" required>
                                        <option value="">Select</option>
                                        <option value="1">Receipt</option>
                                        <option value="2">Payment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label><span id="cbFromToLabel">Received From</span><small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="cbFromTo" id="cbFromTo" placeholder="Enter Something" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label><span id="cbForLabel">Received For</span><small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="cbFor" id="cbFor" placeholder="Enter Something" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Amount<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="cbAmt" id="cbAmt" onkeypress='validateNum(event)' placeholder="Enter Amount" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <textarea class="form-control" name="cbRemark" id="cbRemark" ></textarea>
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
    
<script>

    $(document).ready(function(){
        
        $('#cbType').on('change', function () {
            
            var cbType = $(this).val();
            
            if(cbType=="1")
            {
                $('#cbFromToLabel').text('Received From');
                $('#cbForLabel').text('Received For');
            }
            else
            {
                $('#cbFromToLabel').text('Paid To');
                $('#cbForLabel').text('Paid For');
            }
            
        });
        
        $('.cbType').on('change', function () {
            
            var cbType = $(this).val();
            var cbId = $(this).data('id');
            
            if(cbType=="1")
            {
                $('#cbFromToLabel'+cbId).text('Received From');
                $('#cbForLabel'+cbId).text('Received For');
            }
            else
            {
                $('#cbFromToLabel'+cbId).text('Paid To');
                $('#cbForLabel'+cbId).text('Paid For');
            }
            
        });
        
        $('.deleteTransaction').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var cbId = $(this).data('id');

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

                    var postingUrl = base_url+'/deleteTransaction';
                    $.post(postingUrl, 
                    {
                        cbId: cbId
                    },
                    function(data, status){
                        window.location.href=base_url+"/cashbook";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
    });
</script>   


<?= $this->endSection(); ?>