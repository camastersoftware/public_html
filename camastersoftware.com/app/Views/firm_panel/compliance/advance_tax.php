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
        font-size: 16px;
    }
    
    .tablepress tbody {
        font-size: 16px;
    }
    
    td.column-1 {
        text-align: center;
        font-weight: normal;
        font-size: 16px;
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
    
    /*
    .theme-primary .btn-success {
        background-color: #1e613b !important;
        border-color: #1e613b !important;
        color: #ffffff !important;
        width: 100px;
        font-size: 13px;
    }
    */
    
    .theme-primary a:hover, .theme-primary a:focus {
        color: #303030 !important;
    }
    
    a {
        color: #303030;
    }
    
    .tablepress tbody tr:nth-child(6) td.column-1 {
        background: none;
    }
    
    .tablepress tbody tr.sub-total-td td:nth-child(n+5) {
      /*border: 1px solid #015aacab !important;*/
      font-weight: 900 !important;
    }
    
    .tablepress tbody td, .tablepress tfoot th {
      border: 1px solid #015aacab !important;
      color: #000;
    }
    
    .tablepress tbody tr {
      background: #96c7f242 !important;
    }
    
    
</style>

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
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#advanceTaxFilter">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Filter">
                                    <i class="fa fa-filter"></i>&nbsp;Filter
                                </button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('inc_tax_payments'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body">
					<!-- Tab panes -->
					<div class="tab-content tabcontent-border p-15" id="myTabContent">
						<div class="row">
                            <div class="col-md-12">
                                <div class="state heading-act">
                                    <label>Advance Tax Payment</label>
                                </div>
                            </div>
						</div>
                        <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                <thead>
                            	    <tr class="row-1">
                            			<th class="column-1">Sr</th>
                            			<th class="column-2">Group</th>
                            			<th class="column-3">Client Name</th>
                            			<th class="column-4">Allocated</th>
                            			<th class="column-5">F.Y.</th>
                            			<th class="column-6">F.Y.</th>
                            			<th class="column-7" colspan="4">Financial Year : <?= $finYearVal ?> (AY : <?= $asmtYear ?>)</th>
                            			<th class="column-8">Total</th>
                            		</tr>
                            		<tr class="row-1">
                            			<th class="column-1">No</th>
                            			<th class="column-2">No</th>
                            			<th class="column-3"></th>
                            			<th class="column-4">TO</th>
                            			<th class="column-5"><?= $prevTwoFinYear; ?></th>
                            			<th class="column-6"><?= $prevOneFinYear; ?></th>
                            			<th class="column-7">Quarter 1</th>
                            			<th class="column-8">Quarter 2</th>
                            			<th class="column-9">Quarter 3</th>
                            			<th class="column-10">Quarter 4</th>
                            			<th class="column-11">Amount</th>
                            		</tr>
                            	</thead>
                            	<tbody class="row-hover">
                            	    <?php $i=1; ?>
                            	    <?php $currGrpId=$prevGrpId=""; ?>
                            	    <?php $prevTwoYrArr=$prevYrArr=$currQtrOneArr=$currQtrTwoArr=$currQtrThreeArr=$currQtrFourArr=$currQtrArr=array(); ?>
                            	    <?php $prevTwoYrAmt=$prevYrAmt=$currQtrOneAmt=$currQtrTwoAmt=$currQtrThreeAmt=$currQtrFourAmt=$currQtrAmt=0; ?>
                            	    <?php if(!empty($workDataArr)): ?>
                            	        <?php $totalRowNo=count($workDataArr); ?>
                            	        <?php $lastRowNo=$totalRowNo-1; ?>
                            	        <?php foreach($workDataArr AS $k_row=>$e_row): ?>
                            	            <?php $currGrpId=$e_row['client_group_id']; ?>
                            	            <?php if($currGrpId!=$prevGrpId && $prevGrpId!=""): ?>
                                    		<tr class="row-1 sub-total-td">
                                    			<td class="column-1"></td>
                                    			<td class="column-2"></td>
                                    		    <td class="column-3 text-right"><span class="font-weight-bold">Sub-Total</span></td>
                                    			<td class="column-4"></td>
                                    			<td class="column-5 text-right">
                                    			    <?php
                                    			        $prevTwoYrArrVal="-";
                                                        if(isset($prevTwoYrArr[$prevGrpId]))
                                                        {
                                                            if(!empty($prevTwoYrArr[$prevGrpId]))
                                                            {
                                                                $prevTwoYrArrVal=amount_format(array_sum($prevTwoYrArr[$prevGrpId]));
                                                                $prevTwoYrAmt+=array_sum($prevTwoYrArr[$prevGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($prevTwoYrArrVal))
                                                            echo $prevTwoYrArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-6 text-right">
                                    			    <?php
                                    			        $prevYrArrVal='-';
                                                        if(isset($prevYrArr[$prevGrpId]))
                                                        {
                                                            if(!empty($prevYrArr[$prevGrpId]))
                                                            {
                                                                $prevYrArrVal=amount_format(array_sum($prevYrArr[$prevGrpId]));
                                                                $prevYrAmt+=array_sum($prevYrArr[$prevGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($prevYrArrVal))
                                                            echo $prevYrArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-7 text-right">
                                    			    <?php
                                    			        $currQtrOneArrVal="-";
                                                        if(isset($currQtrOneArr[$prevGrpId]))
                                                        {
                                                            if(!empty($currQtrOneArr[$prevGrpId]))
                                                            {
                                                                $currQtrOneArrVal=amount_format(array_sum($currQtrOneArr[$prevGrpId]));
                                                                $currQtrOneAmt+=array_sum($currQtrOneArr[$prevGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($currQtrOneArrVal))
                                                            echo $currQtrOneArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-8 text-right">
                                    			    <?php
                                    			        $currQtrTwoArrVal="-";
                                                        if(isset($currQtrTwoArr[$prevGrpId]))
                                                        {
                                                            if(!empty($currQtrTwoArr[$prevGrpId]))
                                                            {
                                                                $currQtrTwoArrVal=amount_format(array_sum($currQtrTwoArr[$prevGrpId]));
                                                                $currQtrTwoAmt+=array_sum($currQtrTwoArr[$prevGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($currQtrTwoArrVal))
                                                            echo $currQtrTwoArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-9 text-right">
                                    			    <?php
                                    			        $currQtrThreeArrVal="-";
                                                        if(isset($currQtrThreeArr[$prevGrpId]))
                                                        {
                                                            if(!empty($currQtrThreeArr[$prevGrpId]))
                                                            {
                                                                $currQtrThreeArrVal=amount_format(array_sum($currQtrThreeArr[$prevGrpId]));
                                                                $currQtrThreeAmt+=array_sum($currQtrThreeArr[$prevGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($currQtrThreeArrVal))
                                                            echo $currQtrThreeArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-10 text-right">
                                    			    <?php
                                    			        $currQtrFourArrVal="-";
                                                        if(isset($currQtrFourArr[$prevGrpId]))
                                                        {
                                                            if(!empty($currQtrFourArr[$prevGrpId]))
                                                            {
                                                                $currQtrFourArrVal=amount_format(array_sum($currQtrFourArr[$prevGrpId]));
                                                                $currQtrFourAmt+=array_sum($currQtrFourArr[$prevGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($currQtrFourArrVal))
                                                            echo $currQtrFourArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-11 text-right">
                                    			    <?php
                                    			        $currQtrArrVal="-";
                                                        if(isset($currQtrArr[$prevGrpId]))
                                                        {
                                                            if(!empty($currQtrArr[$prevGrpId]))
                                                            {
                                                                $currQtrArrVal=amount_format(array_sum($currQtrArr[$prevGrpId]));
                                                                $currQtrAmt+=array_sum($currQtrArr[$prevGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($currQtrArrVal))
                                                            echo $currQtrArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    		</tr>
                                    		<?php endif; ?>
                                    		<tr class="row-1">
                                    			<td class="column-1"><?php echo $i; ?></td>
                                    			<td class="column-2 text-center"><?php echo $e_row['client_group_number']; ?></td>
                                    		    <td class="column-3">
                                    		        <a href="<?php echo base_url('income_tax/payment_work_form/'.$e_row['clientId']); ?>">
                                    		            <?php 
                                                            if(in_array($e_row['orgType'], INDIVIDUAL_ARRAY))
                                                                echo $e_row['clientName'];
                                                            else
                                                                echo $e_row['clientBussOrganisation'];
                                                        ?>
                                    		        </a>
                                    		      </td>
                                    			<td class="column-4 text-center"><?php echo $e_row['userShortName']; ?></td>
                                    			<td class="column-5 text-right">
                                    			    <?php
                                                        if(isset($prevTwoYr[$e_row['clientId']]))
                                                            $prevTwoYrVal=$prevTwoYr[$e_row['clientId']];
                                                        else
                                                            $prevTwoYrVal=0;
                                                        
                                                        $prevTwoYrArr[$currGrpId][]=$prevTwoYrVal;
                                                    ?>
                                                    <?php
                                                        if(!empty($prevTwoYrVal))
                                                            echo amount_format($prevTwoYrVal);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-6 text-right">
                                    			    <?php
                                                        if(isset($prevYr[$e_row['clientId']]))
                                                            $prevYrVal=$prevYr[$e_row['clientId']];
                                                        else
                                                            $prevYrVal=0;
                                                            
                                                        $prevYrArr[$currGrpId][]=$prevYrVal;
                                                    ?>
                                                    <?php
                                                        if(!empty($prevYrVal))
                                                            echo amount_format($prevYrVal);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                                <?php
                                                    $currQtrOnePaid=false;
                                                    if(isset($currQtrOne[$e_row['clientId']]))
                                                    {
                                                        $currQtrOneData=$currQtrOne[$e_row['clientId']];
                                                        
                                                        if($currQtrOneData['amtPaid']==0)
                                                        {
                                                            $currQtrOneVal=$currQtrOneData['amtApproved'];
                                                        }
                                                        elseif($currQtrOneData['amtPaid']>0)
                                                        {
                                                            $currQtrOnePaid=true;
                                                            $currQtrOneVal=$currQtrOneData['amtPaid'];
                                                        }
                                                        else
                                                        {
                                                            $currQtrOneVal=0;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $currQtrOneVal=0;
                                                    }
                                                        
                                                    $currQtrOneArr[$currGrpId][]=$currQtrOneVal;
                                                ?>
                                    			<td class="column-7 text-right <?php if($currQtrOnePaid): ?>hasPaid<?php endif; ?>">
                                                    <?php
                                                        if(!empty($currQtrOneVal))
                                                            echo amount_format($currQtrOneVal);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                                <?php
                                                    $currQtrTwoPaid=false;
                                                    if(isset($currQtrTwo[$e_row['clientId']]))
                                                    {
                                                        $currQtrTwoData=$currQtrTwo[$e_row['clientId']];
                                                        
                                                        if($currQtrTwoData['amtPaid']==0)
                                                        {
                                                            $currQtrTwoVal=$currQtrTwoData['amtApproved'];
                                                        }
                                                        elseif($currQtrTwoData['amtPaid']>0)
                                                        {
                                                            $currQtrTwoPaid=true;
                                                            $currQtrTwoVal=$currQtrTwoData['amtPaid'];
                                                        }
                                                        else
                                                        {
                                                            $currQtrTwoVal=0;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $currQtrTwoVal=0;
                                                    }
                                                        
                                                    $currQtrTwoArr[$currGrpId][]=$currQtrTwoVal;
                                                ?>
                                    			<td class="column-8 text-right <?php if($currQtrTwoPaid): ?>hasPaid<?php endif; ?>">
                                                    <?php
                                                        if(!empty($currQtrTwoVal))
                                                            echo amount_format($currQtrTwoVal);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                                <?php
                                                    $currQtrThreePaid=false;
                                                    if(isset($currQtrThree[$e_row['clientId']]))
                                                    {
                                                        $currQtrThreeData=$currQtrThree[$e_row['clientId']];
                                                        
                                                        if($currQtrThreeData['amtPaid']==0)
                                                        {
                                                            $currQtrThreeVal=$currQtrThreeData['amtApproved'];
                                                        }
                                                        elseif($currQtrThreeData['amtPaid']>0)
                                                        {
                                                            $currQtrThreePaid=true;
                                                            $currQtrThreeVal=$currQtrThreeData['amtPaid'];
                                                        }
                                                        else
                                                        {
                                                            $currQtrThreeVal=0;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $currQtrThreeVal=0;
                                                    }
                                                        
                                                    $currQtrThreeArr[$currGrpId][]=$currQtrThreeVal;
                                                ?>
                                    			<td class="column-9 text-right <?php if($currQtrThreePaid): ?>hasPaid<?php endif; ?>">
                                                    <?php
                                                        if(!empty($currQtrThreeVal))
                                                            echo amount_format($currQtrThreeVal);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                                <?php
                                                    $currQtrFourPaid=false;
                                                    if(isset($currQtrFour[$e_row['clientId']]))
                                                    {
                                                        $currQtrFourData=$currQtrFour[$e_row['clientId']];
                                                        
                                                        if($currQtrFourData['amtPaid']==0)
                                                        {
                                                            $currQtrFourVal=$currQtrFourData['amtApproved'];
                                                        }
                                                        elseif($currQtrFourData['amtPaid']>0)
                                                        {
                                                            $currQtrFourPaid=true;
                                                            $currQtrFourVal=$currQtrFourData['amtPaid'];
                                                        }
                                                        else
                                                        {
                                                            $currQtrFourVal=0;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $currQtrFourVal=0;
                                                    }
                                                        
                                                    $currQtrFourArr[$currGrpId][]=$currQtrFourVal;
                                                ?>
                                    			<td class="column-10 text-right <?php if($currQtrFourPaid): ?>hasPaid<?php endif; ?>">
                                                    <?php
                                                        if(!empty($currQtrFourVal))
                                                            echo amount_format($currQtrFourVal);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-11 text-right">
                                    			    <?php
                                                        if(isset($currQtr[$e_row['clientId']]))
                                                        {
                                                            $currQtrVal=$currQtrOneVal+$currQtrTwoVal+$currQtrThreeVal+$currQtrFourVal;
                                                        }
                                                        else
                                                        {
                                                            $currQtrVal=0;
                                                        }
                                                            
                                                        $currQtrArr[$currGrpId][]=$currQtrVal;
                                                    ?>
                                                    <?php
                                                        if(!empty($currQtrVal))
                                                            echo amount_format($currQtrVal);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    		</tr>
                                    		<?php if($lastRowNo==$k_row): ?>
                                    		<tr class="row-1 sub-total-td">
                                    			<td class="column-1"></td>
                                    			<td class="column-2"></td>
                                    		    <td class="column-3 text-right"><span class="font-weight-bold">Sub-Total</span></td>
                                    			<td class="column-4"></td>
                                    			<td class="column-5 text-right">
                                    			    <?php
                                    			        $prevTwoYrArrVal="-";
                                                        if(isset($prevTwoYrArr[$currGrpId]))
                                                        {
                                                            if(!empty($prevTwoYrArr[$currGrpId]))
                                                            {
                                                                $prevTwoYrArrVal=amount_format(array_sum($prevTwoYrArr[$currGrpId]));
                                                                $prevTwoYrAmt+=array_sum($prevTwoYrArr[$currGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($prevTwoYrArrVal))
                                                            echo $prevTwoYrArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-6 text-right">
                                    			    <?php
                                    			        $prevYrArrVal='-';
                                                        if(isset($prevYrArr[$currGrpId]))
                                                        {
                                                            if(!empty($prevYrArr[$currGrpId]))
                                                            {
                                                                $prevYrArrVal=amount_format(array_sum($prevYrArr[$currGrpId]));
                                                                $prevYrAmt+=array_sum($prevYrArr[$currGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($prevYrArrVal))
                                                            echo $prevYrArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-7 text-right">
                                    			    <?php
                                    			        $currQtrOneArrVal="-";
                                                        if(isset($currQtrOneArr[$currGrpId]))
                                                        {
                                                            if(!empty($currQtrOneArr[$currGrpId]))
                                                            {
                                                                $currQtrOneArrVal=amount_format(array_sum($currQtrOneArr[$currGrpId]));
                                                                $currQtrOneAmt+=array_sum($currQtrOneArr[$currGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($currQtrOneArrVal))
                                                            echo $currQtrOneArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-8 text-right">
                                    			    <?php
                                    			        $currQtrTwoArrVal="-";
                                                        if(isset($currQtrTwoArr[$currGrpId]))
                                                        {
                                                            if(!empty($currQtrTwoArr[$currGrpId]))
                                                            {
                                                                $currQtrTwoArrVal=amount_format(array_sum($currQtrTwoArr[$currGrpId]));
                                                                $currQtrTwoAmt+=array_sum($currQtrTwoArr[$currGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($currQtrTwoArrVal))
                                                            echo $currQtrTwoArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-9 text-right">
                                    			    <?php
                                    			        $currQtrThreeArrVal="-";
                                                        if(isset($currQtrThreeArr[$currGrpId]))
                                                        {
                                                            if(!empty($currQtrThreeArr[$currGrpId]))
                                                            {
                                                                $currQtrThreeArrVal=amount_format(array_sum($currQtrThreeArr[$currGrpId]));
                                                                $currQtrThreeAmt+=array_sum($currQtrThreeArr[$currGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($currQtrThreeArrVal))
                                                            echo $currQtrThreeArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-10 text-right">
                                    			    <?php
                                    			        $currQtrFourArrVal="-";
                                                        if(isset($currQtrFourArr[$currGrpId]))
                                                        {
                                                            if(!empty($currQtrFourArr[$currGrpId]))
                                                            {
                                                                $currQtrFourArrVal=amount_format(array_sum($currQtrFourArr[$currGrpId]));
                                                                $currQtrFourAmt+=array_sum($currQtrFourArr[$currGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($currQtrFourArrVal))
                                                            echo $currQtrFourArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-11 text-right">
                                    			    <?php
                                    			        $currQtrArrVal="-";
                                                        if(isset($currQtrArr[$currGrpId]))
                                                        {
                                                            if(!empty($currQtrArr[$currGrpId]))
                                                            {
                                                                $currQtrArrVal=amount_format(array_sum($currQtrArr[$currGrpId]));
                                                                $currQtrAmt+=array_sum($currQtrArr[$currGrpId]);
                                                            }
                                                        }
                                                        
                                                        if(!empty($currQtrArrVal))
                                                            echo $currQtrArrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    		</tr>
                                    		<?php endif; ?>
                                    		<?php $prevGrpId=$currGrpId; ?>
                                    		<?php $i++; ?>
                                	    <?php endforeach; ?>
                                	    <tr class="row-1 sub-total-td">
                                			<td class="column-1"></td>
                                			<td class="column-2"></td>
                                		    <td class="column-3 text-right"><span class="font-weight-bold">Grand Total</span></td>
                                			<td class="column-4"></td>
                                			<td class="column-5 text-right">
                                			    <?php
                                                    if(!empty($prevTwoYrAmt))
                                                        echo amount_format($prevTwoYrAmt);
                                                    else
                                                        echo "-";
                                                ?>
                                            </td>
                                			<td class="column-6 text-right">
                                			    <?php
                                                    if(!empty($prevYrAmt))
                                                        echo amount_format($prevYrAmt);
                                                    else
                                                        echo "-";
                                                ?>
                                            </td>
                                			<td class="column-7 text-right">
                                			    <?php
                                                    if(!empty($currQtrOneAmt))
                                                        echo amount_format($currQtrOneAmt);
                                                    else
                                                        echo "-";
                                                ?>
                                            </td>
                                			<td class="column-8 text-right">
                                			    <?php
                                                    if(!empty($currQtrTwoAmt))
                                                        echo amount_format($currQtrTwoAmt);
                                                    else
                                                        echo "-";
                                                ?>
                                            </td>
                                			<td class="column-9 text-right">
                                			    <?php
                                                    if(!empty($currQtrThreeAmt))
                                                        echo amount_format($currQtrThreeAmt);
                                                    else
                                                        echo "-";
                                                ?>
                                            </td>
                                			<td class="column-10 text-right">
                                			    <?php
                                                    if(!empty($currQtrFourAmt))
                                                        echo amount_format($currQtrFourAmt);
                                                    else
                                                        echo "-";
                                                ?>
                                            </td>
                                			<td class="column-11 text-right">
                                			    <?php
                                                    if(!empty($currQtrAmt))
                                                        echo amount_format($currQtrAmt);
                                                    else
                                                        echo "-";
                                                ?>
                                            </td>
                                		</tr>
                                	<?php else: ?>
                                	    <tr class="row-1">
                                    	    <td colspan="11">
                                    	        <center>
                                    	            No records found
                                    	        </center>
                                    	    </td>
                                        </tr>
                                	<?php endif; ?>
                            	</tbody>
                            </table>
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
<div id="advanceTaxFilter" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('search_advance_tax'); ?>" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Allocated to : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control select2" name="ftr_allocated_to" id="ftr_allocated_to" style="width:100%;">
                                        <option value="">Select Allocated to</option>
                                        <?php if(!empty($getUserList)): ?>
                                            <?php foreach($getUserList AS $e_usr_val): ?>
                                                <option value="<?php echo $e_usr_val['userId']; ?>" <?php echo $ftr_allocated_to==$e_usr_val['userId'] ? "selected":""; ?>><?php echo $e_usr_val['userFullName']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <a href="<?php echo base_url('reset_advance_tax'); ?>">
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


<?= $this->endSection(); ?>