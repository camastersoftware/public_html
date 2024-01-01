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
<section class="content mt-40">
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
                            <a href="<?php echo base_url('admin/add_gst_tax_payment'); ?> ">
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
                            		</tr>
                            		<tr class="row-1">
                            			<th class="column-1">No</th>
                            			<th class="column-2">No</th>
                            			<th class="column-3">Party</th>
                            			<th class="column-4">Payment</th>
                            			<th class="column-5">Period</th>
                            			<th class="column-6">Return</th>
                            			<th class="column-8">Challan</th>
                            			<th class="column-9">Reference</th>
                            			<th class="column-10">CGST</th>
                                        <th class="column-10">SGST</th>
                                        <th class="column-10">IGST</th>
                                        <th class="column-10">Total</th>
                            		</tr>
                            	</thead>
                            	<tbody class="row-hover">
                                    		<tr class="row-1">
                                    			<td class="column-1"></td>
                                    			<td class="column-2"></td>
                                    		    <td class="column-3">
                                    		        <a href="">
                                    		        </a>
                                    		      </td>
                                    			<td class="column-4"></td>
                                    			<td class="column-5 text-center">
                                                </td>
                                    			<td class="column-6 text-center">
                                                </td>
                                    			<td class="column-7 text-center">
                                                </td>
                                    			<td class="column-8 text-center">
                                                </td>
                                    			<td class="column-9 text-center">
                                                </td>
                                    			<td class="column-10 text-center">
                                                </td>
                                    			<td class="column-11 text-center">
                                                </td>
                                    		</tr>
                                	    <tr class="row-1">
                                    	    <td colspan="11">
                                    	        <center>
                                    	        </center>
                                    	    </td>
                                        </tr>
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