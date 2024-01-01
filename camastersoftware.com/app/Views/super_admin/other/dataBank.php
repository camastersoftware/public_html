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
        border-top: 1px solid;
    }
    .heading-acth3 {
        background:#005aab;
        padding:7px 0;
        text-align:center;
        font-size:12px;
        font-weight: bold;
        color:#fff;
        border-top: 1px solid;
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

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h3>
                        <a href="<?php echo base_url('superadmin/home'); ?>"><button type="button" class="waves-effect waves-light btn btn-dark float-right" style="">Back</button></a>
                    </div>
                    <div class="text-right mt-3 px-20">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#Modalfilter-intax"><button class="btn btn-submit" data-toggle="tooltip" data-original-title="Filter">&nbsp;Add</button></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Tab panes -->
    					<div class="tab-content tabcontent-border p-15" id="myTabContent">
        					<div class="row">
                                <!--<div class="col-md-12">-->
                                <!--    <div class="state due-month">-->
                                <!--        <label>Due Date For The Month Of : July-2021</label>-->
                                <!--    </div>-->
                                <!--</div>-->
							</div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="state heading-act">
                                        <label>Data Bank</label>
                                    </div>
                                </div>
							</div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="state heading-acth3">
                                        <label>Details of Referrals</label>
                                    </div>
                                </div>
							</div>
    						<div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
    							<table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                	<thead>
                                	    <tr class="row-1">
                                			<th class="column-1">Sr</th>
                                			<th class="column-2">Name</th>
                                			<th class="column-3">Profession</th>
                                			<th class="column-4">Location</th>
                                			<th class="column-5">Contact no</th>
                                			<th class="column-6">Email Address</th>
                                			<th class="column-7">Source</th>
                                			<th class="column-8">License No</th>
                                		</tr>
                                	</thead>
                                	<tbody class="row-hover">
                                		<tr class="row-1">
                                			<td class="column-1">1</td>
                                			<td class="column-2">Avinash Poddar</td>
                                		    <td class="column-3"><a href="payment-view.php">CA/TC/Other</a></td>
                                			<td class="column-4">Churchgate</td>
                                			<td class="column-5">9821845581</td>
                                			<td class="column-6">-</td>
                                			<td class="column-7">-</td>
                                			<td class="column-8">-</td>
                                		</tr>
                                		<tr class="row-1">
                                			<td class="column-1">2</td>
                                			<td class="column-2">Saurabh mishra</td>
                                		    <td class="column-3"><a href="payment-view.php">CA/TC/Other</a></td>
                                			<td class="column-4">Churchgate</td>
                                			<td class="column-5">9821845581</td>
                                			<td class="column-6">-</td>
                                			<td class="column-7">-</td>
                                			<td class="column-8">-</td>
                                		</tr>
                                		<tr class="row-1">
                                			<td class="column-1">3</td>
                                			<td class="column-2">Ashish jain</td>
                                		    <td class="column-3"><a href="payment-view.php">CA/TC/Other</a></td>
                                			<td class="column-4">Churchgate</td>
                                			<td class="column-5">9821845581</td>
                                			<td class="column-6">-</td>
                                			<td class="column-7">-</td>
                                			<td class="column-8">-</td>
                                		</tr>
                                		<tr class="row-1">
                                			<td class="column-1">4</td>
                                			<td class="column-2">Karan Kundra</td>
                                		    <td class="column-3"><a href="payment-view.php">CA/TC/Other</a></td>
                                			<td class="column-4">Churchgate</td>
                                			<td class="column-5">9821845581</td>
                                			<td class="column-6">-</td>
                                			<td class="column-7">-</td>
                                			<td class="column-8">-</td>
                                		</tr>
                                	</tbody>
                                </table>
    						</div>
    					</div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div id="Modalfilter-intax" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="" method="POST" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Data Bank</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Name<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Profession<small class="text-danger">*</small></label>
                                    <select class="form-control">
										<option>CT</option>
										<option>TC</option>
										<option>Other</option>
								    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Location<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" placeholder="Location">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Contact Number<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" placeholder="Contact Number">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Email Address<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Source<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" placeholder="Source">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>License no<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" placeholder="License no">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                        <!--<button type="button" class="btn btn-warning text-left" data-dismiss="modal">Reset</button>-->
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