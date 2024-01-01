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
    
    .theme-primary .btnPrimClr {
      margin-top: 0px !important;
      height: 30px !important;
      margin-bottom: 0px !important;
    }
    
    
</style>

<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
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
                        <a href="<?php echo base_url('add_gst_payment'); ?> ">
                            <button class="btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button> 
                        </a>
                        &nbsp;&nbsp;
                        <a href="<?php echo base_url('gst_menus'); ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right font-weight-bold">Back</button>
                        </a>
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
                            			<th class="column-3">Name Of The</th>
                            			<th class="column-4">Date</th>
                            			<th class="column-5">Return</th>
                            			<th class="column-6">Type Of</th>
                                        <th class="column-7">Type Of</th>
                                        <th class="column-8">Challan</th>
                            			<th class="column-9" colspan="4">Type Of Payment</th>
                            			<th class="column-10">Mode</th>
                            			<th class="column-10">Action</th>
                            		</tr>
                            		<tr class="row-1">
                            			<th class="column-1">No</th>
                            			<th class="column-2">No</th>
                            			<th class="column-3">Client</th>
                            			<th class="column-4">Payment</th>
                            			<th class="column-5">Period</th>
                            			<th class="column-6">Return</th>
                            			<th class="column-8">Challan</th>
                            			<th class="column-9">Reference</th>
                            			<th class="column-10">CGST</th>
                                        <th class="column-10">SGST</th>
                                        <th class="column-10">IGST</th>
                                        <th class="column-10">Total</th>
                                        <th class="column-10"></th>
                                        <th class="column-10"></th>
                            		</tr>
                            	</thead>
                            	<tbody class="row-hover">
                            	    <?php $i=1; ?>
                            	    <?php if(!empty($gstTaxPmtArr)): ?>
                            	        <?php foreach($gstTaxPmtArr AS $e_work): ?>
                            	            <?php
                                	            $cgstTax=(int)$e_work['cgstTax'];
                                	            $cgstInterest=(int)$e_work['cgstInterest'];
                                	            $cgstPenalty=(int)$e_work['cgstPenalty'];
                                	            $cgstFees=(int)$e_work['cgstFees'];
                                	            
                                	            $sgstTax=(int)$e_work['sgstTax'];
                                	            $sgstInterest=(int)$e_work['sgstInterest'];
                                	            $sgstPenalty=(int)$e_work['sgstPenalty'];
                                	            $sgstFees=(int)$e_work['sgstFees'];
                                	            
                                	            $igstTax=(int)$e_work['igstTax'];
                                	            $igstInterest=(int)$e_work['igstInterest'];
                                	            $igstPenalty=(int)$e_work['igstPenalty'];
                                	            $igstFees=(int)$e_work['igstFees'];
                                	            
                                	            $totalTax=(int)$e_work['totalTax'];
                                	            $totalInterest=(int)$e_work['totalInterest'];
                                	            $totalPenalty=(int)$e_work['totalPenalty'];
                                	            $totalFees=(int)$e_work['totalFees'];
                                	            
                                	            $totalCgst=$cgstTax+$cgstInterest+$cgstPenalty+$cgstFees;
                                	            $totalSgst=$sgstTax+$sgstInterest+$sgstPenalty+$sgstFees;
                                	            $totalIgst=$igstTax+$igstInterest+$igstPenalty+$igstFees;
                                	            $totalGst=$totalTax+$totalInterest+$totalPenalty+$totalFees;
                                	        ?>
                                	        <tr class="row-1" id="pmtId_tr_<?= $e_work['pmtId'] ?>">
                                        	    <td><?php echo $i; ?></td>
                                        	    <td><?php echo $e_work['client_group_number']; ?></td>
                                        	    <td><a href="<?= base_url('gst/edit_tax_payment/'.$e_work['pmtId']); ?>"><?php echo $e_work['clientBussOrganisation']; ?></a></td>
                                        	    <td>
                                        	        <?php 
                                                        $pmtDate="N/A";
                                                        if(!empty($e_work['pmtDate']) && $e_work['pmtDate']!="0000-00-00" && $e_work['pmtDate']!="1970-01-01")
                                                            $pmtDate=date('d-m-Y', strtotime($e_work['pmtDate']));
                                                    ?>
                                                    <?php echo $pmtDate; ?>
                                        	    </td>
                                        	    <td>
                                        	        <?php
                                        	            $retFrom="";
                                        	            $retTo="";
                                                        // if(!empty($e_work['retMthFrom']) && !empty($e_work['retYrFrom']) && !empty($e_work['retMthTo']) && !empty($e_work['retYrTo']))
                                                        if(!empty($e_work['retMthFrom']) && !empty($e_work['retYrFrom']))
                                                        {
                                                            $retYrFrom=substr($e_work['retYrFrom'], 2);
                                                            $retMthFrom=date('M', strtotime($retYrFrom."-".$e_work['retMthFrom']."-01"));
                                                            
                                                            $retFrom=$retMthFrom." ".$retYrFrom;
                                                            
                                                            if(!empty($e_work['retMthTo']) && !empty($e_work['retYrTo']))
                                                            {
                                                                $retYrTo=substr($e_work['retYrTo'], 2);
                                                                $retMthTo=date('M', strtotime($retYrFrom."-".$e_work['retMthTo']."-01"));
                                                                
                                                                $retTo=" - ".$retMthTo." ".$retYrTo;
                                                            }
                                                        }
                                                        
                                                        echo $retFrom.$retTo;
                                                    ?>
                                        	    </td>
                                        	    <td><?php echo $e_work['gst_return_type']; ?></td>
                                        	    <td><?php echo $e_work['gst_challan_type']; ?></td>
                                        	    <td><?php echo $e_work['challanRefNo']; ?></td>
                                        	    <td><?php echo $totalCgst; ?></td>
                                        	    <td><?php echo $totalSgst; ?></td>
                                        	    <td><?php echo $totalIgst; ?></td>
                                        	    <td><?php echo $totalGst; ?></td>
                                        	    <td><?php echo $e_work['payment_mode']; ?></td>
                                        	    <td>
                                        	        <div class="btn-group">
                                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" style="will-change: transform;">
                                                            <a class="dropdown-item delGstTaxPmt" href="javascript:void(0);" data-toggle="tooltip" data-original-title="Delete" data-rowId="<?php echo $e_work['pmtId']; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                                        </div>
                                                    </div>
                                        	    </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                            	    <?php else: ?>
                                	    <tr class="row-1">
                                    	    <td colspan="14">
                                    	        <center>No records found</center>
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

<script>
    $(document).ready(function(){
        
        var base_url = "<?php echo base_url(); ?>";
        
        $('.delGstTaxPmt').on('click', function(e){

            e.preventDefault();

            var pmtId = $(this).data('rowid');

            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this payment ?",
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
                        url : base_url+'/delete_gst_payment',
                        type : 'POST',
                        data : {
                            'pmtId':pmtId,
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

                                $('#pmtId_tr_'+pmtId).remove();
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
    });
</script>


<?= $this->endSection(); ?>