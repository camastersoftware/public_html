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
    
    .theme-primary .btn-success {
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
    
    .tablepress tbody tr:nth-child(6) td.column-1 {
        background: none;
    }
    
    
</style>

<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                    <a href="<?php echo base_url('admin/inc_tax_payments'); ?>">
                        <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                    </a>
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
                            			<th class="column-5">Previous</th>
                            			<th class="column-6">Previous</th>
                            			<th class="column-7" colspan="4">Financial Year : <?= $finYearVal ?> (AY : <?= $asmtYear ?>)</th>
                            			<th class="column-8">Total</th>
                            		</tr>
                            		<tr class="row-1">
                            			<th class="column-1">No</th>
                            			<th class="column-2">No</th>
                            			<th class="column-3"></th>
                            			<th class="column-4">TO</th>
                            			<th class="column-5">F.Y</th>
                            			<th class="column-6">F.Y</th>
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
                            	    <?php if(!empty($workDataArr)): ?>
                            	        <?php foreach($workDataArr AS $e_row): ?>
                            	            <?php $currGrpId=$e_row['client_group_id']; ?>
                            	            <?php if($currGrpId!=$prevGrpId && $prevGrpId!=""): ?>
                                    		    <tr class="row-1">
                                    			<td class="column-1"></td>
                                    			<td class="column-2"></td>
                                    		    <td class="column-3"></td>
                                    			<td class="column-4"></td>
                                    			<td class="column-5 text-center">
                                    			    <?php
                                                        if(isset($prevTwoYrArr[$prevGrpId]))
                                                            echo array_sum($prevTwoYrArr[$prevGrpId]);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-6 text-center">
                                    			    <?php
                                                        if(isset($prevYrArr[$prevGrpId]))
                                                            echo array_sum($prevYrArr[$prevGrpId]);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-7 text-center">
                                    			    <?php
                                                        if(isset($currQtrOneArr[$prevGrpId]))
                                                            echo array_sum($currQtrOneArr[$prevGrpId]);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-8 text-center">
                                    			    <?php
                                                        if(isset($currQtrTwoArr[$prevGrpId]))
                                                            echo array_sum($currQtrTwoArr[$prevGrpId]);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-9 text-center">
                                    			    <?php
                                                        if(isset($currQtrThreeArr[$prevGrpId]))
                                                            echo array_sum($currQtrThreeArr[$prevGrpId]);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-10 text-center">
                                    			    <?php
                                                        if(isset($currQtrFourArr[$prevGrpId]))
                                                            echo array_sum($currQtrFourArr[$prevGrpId]);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-11 text-center">
                                    			    <?php
                                                        if(isset($currQtrArr[$prevGrpId]))
                                                            echo array_sum($currQtrArr[$prevGrpId]);
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    		</tr>
                                    		<?php endif; ?>
                                    		<tr class="row-1">
                                    			<td class="column-1"><?php echo $i; ?></td>
                                    			<td class="column-2"><?php echo $e_row['client_group_number']; ?>-----<?= $currGrpId." ".$prevGrpId; ?></td>
                                    		    <td class="column-3">
                                    		        <a href="<?php echo base_url('admin/income_tax/payment_work_form/'.$e_row['clientId']); ?>">
                                    		            <?php 
                                                            if($e_row['orgType']==9)
                                                                echo $e_row['clientTitle'].". ".$e_row['clientName'];
                                                            else
                                                                echo $e_row['clientBussOrganisation'];
                                                        ?>
                                    		        </a>
                                    		      </td>
                                    			<td class="column-4"><?php echo $e_row['userFullName']; ?></td>
                                    			<td class="column-5 text-center">
                                    			    <?php
                                                        if(isset($prevTwoYr[$e_row['clientId']]))
                                                            $prevTwoYrVal=$prevTwoYr[$e_row['clientId']];
                                                        else
                                                            $prevTwoYrVal=0;
                                                        
                                                        $prevTwoYrArr[$currGrpId]=$prevTwoYrVal;
                                                    ?>
                                                    <?php
                                                        if(!empty($prevTwoYrVal))
                                                            echo $prevTwoYrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-6 text-center">
                                    			    <?php
                                                        if(isset($prevYr[$e_row['clientId']]))
                                                            $prevYrVal=$prevYr[$e_row['clientId']];
                                                        else
                                                            $prevYrVal=0;
                                                            
                                                        $prevYrArr[$currGrpId]=$prevYrVal;
                                                    ?>
                                                    <?php
                                                        if(!empty($prevYrVal))
                                                            echo $prevYrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-7 text-center">
                                    			    <?php
                                                        if(isset($currQtrOne[$e_row['clientId']]))
                                                            $currQtrOneVal=array_sum($currQtrOne[$e_row['clientId']]);
                                                        else
                                                            $currQtrOneVal=0;
                                                            
                                                        $currQtrOneArr[$currGrpId]=$currQtrOneVal;
                                                    ?>
                                                    <?php
                                                        if(!empty($currQtrOneVal))
                                                            echo $currQtrOneVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-8 text-center">
                                    			    <?php
                                                        if(isset($currQtrTwo[$e_row['clientId']]))
                                                            $currQtrTwoVal=array_sum($currQtrTwo[$e_row['clientId']]);
                                                        else
                                                            $currQtrTwoVal=0;
                                                            
                                                        $currQtrTwoArr[$currGrpId]=$currQtrTwoVal;
                                                    ?>
                                                    <?php
                                                        if(!empty($currQtrTwoVal))
                                                            echo $currQtrTwoVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-9 text-center">
                                    			    <?php
                                                        if(isset($currQtrThree[$e_row['clientId']]))
                                                            $currQtrThreeVal=array_sum($currQtrThree[$e_row['clientId']]);
                                                        else
                                                            $currQtrThreeVal=0;
                                                            
                                                        $currQtrThreeArr[$currGrpId]=$currQtrThreeVal;
                                                    ?>
                                                    <?php
                                                        if(!empty($currQtrThreeVal))
                                                            echo $currQtrThreeVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-10 text-center">
                                    			    <?php
                                                        if(isset($currQtrFour[$e_row['clientId']]))
                                                            $currQtrFourVal=array_sum($currQtrFour[$e_row['clientId']]);
                                                        else
                                                            $currQtrFourVal=0;
                                                            
                                                        $currQtrFourArr[$currGrpId]=$currQtrFourVal;
                                                    ?>
                                                    <?php
                                                        if(!empty($currQtrFourVal))
                                                            echo $currQtrFourVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    			<td class="column-11 text-center">
                                    			    <?php
                                                        if(isset($currQtr[$e_row['clientId']]))
                                                            $currQtrVal=array_sum($currQtr[$e_row['clientId']]);
                                                        else
                                                            $currQtrVal=0;
                                                            
                                                        $currQtrArr[$currGrpId]=$currQtrVal;
                                                    ?>
                                                    <?php
                                                        if(!empty($currQtrVal))
                                                            echo $currQtrVal;
                                                        else
                                                            echo "-";
                                                    ?>
                                                </td>
                                    		</tr>
                                    		<?php $prevGrpId=$currGrpId; ?>
                                    		<?php $i++; ?>
                                	    <?php endforeach; ?>
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


<?= $this->endSection(); ?>