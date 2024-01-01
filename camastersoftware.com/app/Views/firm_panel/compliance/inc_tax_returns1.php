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
    
    .theme-primary .btn-success1 {
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

    .sub_btn{
        width: 80px !important;
    }
    
    
</style>

<!-- Main content -->
<section class="content mt-40">
	<div class="row"> 
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h4 class="box-title"><?php echo $pageTitle; ?></h4>
                    <a href="<?php echo base_url('admin/inc_menus'); ?>"><button type="button" class="waves-effect waves-light btn btn-dark float-right" style="">Back</button></a>
                </div>
                
                <div class="text-right mt-3">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modalfilter-intax"><button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Filter"><i class="fa fa-filter"></i>&nbsp;Filter</button></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border p-15" id="myTabContent">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="state due-month">
                                    <label>Due Date For The Month Of : July-2021</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="state heading-act">
                                    <label>Income Tax-Other-Returns</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                <thead>
                                    <tr class="row-0">
                                        <th class="column-1" colspan="5">Due Date : 31-07-2021</th>
                                        <th class="column-2" colspan="4">Periodicity : Yearly</th>
                                        <th class="column-3" colspan="7">Period Apr 2020 - Mar 2021</th>	
                                    </tr>
                                </thead>
                                <thead>
                                    <tr class="row-1">
                                        <th class="column-1">Sr</th>
                                        <th class="column-2">Group</th>
                                        <th class="column-3">Name of the Client</th>
                                        <th class="column-3">Due Date</th>
                                        <th class="column-4">DOC</th>
                                        <th class="column-5" colspan="2">ALLOTED TO</th>
                                        <th class="column-6" colspan="2">COMPELTED</th>
                                        <th class="column-7">SET</th>
                                        <th class="column-8">BILLING</th>
                                        <th class="column-9" colspan="3">Bill Details</th>
                                        <th class="column-11"colspan="2">Recipts</th>
                                    </tr>
                                    <tr class="row-1">
                                        <th class="column-1">No</th>
                                        <th class="column-2">No</th>
                                        <th class="column-3"></th>
                                        <th class="column-3">For</th>
                                        <th class="column-4">RECD</th>
                                        <th class="column-5">JUNIOR</th>
                                        <th class="column-6">SENIOR</th>
                                        <th class="column-7">%</th>
                                        <th class="column-8">ON</th>
                                        <th class="column-9">BY</th>
                                        <th class="column-11">TYPE</th>
                                        <th class="column-12">NO</th>
                                        <th class="column-13">Date</th>
                                        <th class="column-14">Amount</th>
                                        <th class="column-15">Date</th>
                                        <th class="column-16">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="row-hover">
                                    <tr class="row-1">
                                        <td class="column-1">1</td>
                                        <td class="column-2">A-01</td>
                                        <td class="column-3"><a href="<?php echo base_url('admin/work_form'); ?>">Mayur Shelar</a></td>
                                        <td class="column-4"></td>
                                        <td class="column-5">-</td>
                                        <td class="column-6"></td>
                                        <td class="column-7"></td>
                                        <td class="column-8"></td>
                                        <td class="column-9"></td>
                                        <td class="column-10"></td>
                                        <td class="column-11">Free</td>
                                        <td class="column-12">-</td>
                                        <td class="column-13">-</td>
                                        <td class="column-14">-</td>
                                        <td class="column-15">-</td>
                                        <td class="column-16">0</td>
                                    </tr>
                                    <tr class="row-2">
                                        <td class="column-1">2</td>
                                        <td class="column-2">A-01</td>
                                        <td class="column-3"><a href="javascript:void(0);">Neha Agnihotri</a></td>
                                        <td class="column-4"></td>
                                        <td class="column-5">-</td>
                                        <td class="column-6"></td>
                                        <td class="column-7"></td>
                                        <td class="column-8"></td>
                                        <td class="column-9"></td>
                                        <td class="column-10"></td>
                                        <td class="column-11"></td>
                                        <td class="column-12">-</td>
                                        <td class="column-13">-</td>
                                        <td class="column-14">-</td>
                                        <td class="column-15">-</td>
                                        <td class="column-16">0</td>
                                    </tr>
                                    <tr class="row-3">
                                        <td class="column-1">3</td>
                                        <td class="column-2">A-02</td>
                                        <td class="column-3"><a href="javascript:void(0);">Alagh Family Trust</a></td>
                                        <td class="column-4"></td>
                                        <td class="column-5">-</td>
                                        <td class="column-6"></td>
                                        <td class="column-7"></td>
                                        <td class="column-8"></td>
                                        <td class="column-9"></td>
                                        <td class="column-10"></td>
                                        <td class="column-11">free</td>
                                        <td class="column-12">-</td>
                                        <td class="column-13">-</td>
                                        <td class="column-14">-</td>
                                        <td class="column-15">-</td>
                                        <td class="column-16">0</td>
                                    </tr>
                                    <tr class="row-4">
                                        <td class="column-1">4</td>
                                        <td class="column-2">A-02</td>
                                        <td class="column-3"><a href="javascript:void(0);">Anjori Alagh</a></td>
                                        <td class="column-4"></td>
                                        <td class="column-5">-</td>
                                        <td class="column-6"></td>
                                        <td class="column-7"></td>
                                        <td class="column-8"></td>
                                        <td class="column-9"></td>
                                        <td class="column-10"></td>
                                        <td class="column-11">Monthly</td>
                                        <td class="column-12">-</td>
                                        <td class="column-13">-</td>
                                        <td class="column-14">-</td>
                                        <td class="column-15">-</td>
                                        <td class="column-16">0</td>
                                    </tr>
                                    <tr class="row-5">
                                        <td class="column-1">5</td>
                                        <td class="column-2">A-02</td>
                                        <td class="column-3"><a href="javascript:void(0);">Maya Alagh</a></td>
                                        <td class="column-4"></td>
                                        <td class="column-5">-</td>
                                        <td class="column-6"></td>
                                        <td class="column-7"></td>
                                        <td class="column-8"></td>
                                        <td class="column-9"></td>
                                        <td class="column-10"></td>
                                        <td class="column-11">Monthly</td>
                                        <td class="column-12">-</td>
                                        <td class="column-13">-</td>
                                        <td class="column-14">-</td>
                                        <td class="column-15">-</td>
                                        <td class="column-16">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    
                    <div class="tab-content tabcontent-border p-15" id="myTabContent">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="state due-month">
                                    <label>Due Date For The Month Of : Sep-2021</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="state heading-act">
                                    <label>Income Tax-Cos-Returns</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                            <table id="tablepress-2" class="tablepress tablepress-id-2 custom-table dataTable-act no-footer">
                                <thead>
                                    <tr class="row-0">
                                        <th class="column-1" colspan="5">Due Date : 31-07-2021</th>
                                        <th class="column-2" colspan="4">Periodicity : Yearly</th>
                                        <th class="column-3" colspan="7">Period Apr 2020 - Mar 2021</th>	
                                    </tr>
                                </thead>
                                <thead>
                                    <tr class="row-1">
                                        <th class="column-1">Sr</th>
                                        <th class="column-2">Group</th>
                                        <th class="column-3">Name of the Client</th>
                                        <th class="column-3">Due Date</th>
                                        <th class="column-4">DOC</th>
                                        <th class="column-5" colspan="2">ALLOTED TO</th>
                                        <th class="column-6" colspan="2">COMPELTED</th>
                                        <th class="column-7">SET</th>
                                        <th class="column-8">BILLING</th>
                                        <th class="column-9" colspan="3">Bill Details</th>
                                        <th class="column-11"colspan="2">Recipts</th>
                                    </tr>
                                    <tr class="row-1">
                                        <th class="column-1">No</th>
                                        <th class="column-2">No</th>
                                        <th class="column-3"></th>
                                        <th class="column-3">For</th>
                                        <th class="column-4">RECD</th>
                                        <th class="column-5">JUNIOR</th>
                                        <th class="column-6">SENIOR</th>
                                        <th class="column-7">%</th>
                                        <th class="column-8">ON</th>
                                        <th class="column-9">BY</th>
                                        <th class="column-11">TYPE</th>
                                        <th class="column-12">NO</th>
                                        <th class="column-13">Date</th>
                                        <th class="column-14">Amount</th>
                                        <th class="column-15">Date</th>
                                        <th class="column-16">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="row-hover">
                                    <tr class="row-1">
                                        <td class="column-1">11</td>
                                        <td class="column-2">A-01</td>
                                        <td><a href="javascript:void(0);">Mayur Shelar</a></td>
                                        <td class="column-4"></td>
                                        <td class="column-5">-</td>
                                        <td class="column-6"></td>
                                        <td class="column-7"></td>
                                        <td class="column-8"></td>
                                        <td class="column-9"></td>
                                        <td class="column-10"></td>
                                        <td class="column-11">Free</td>
                                        <td class="column-12">-</td>
                                        <td class="column-13">-</td>
                                        <td class="column-14">-</td>
                                        <td class="column-15">-</td>
                                        <td class="column-16">0</td>
                                    </tr>
                                    <tr class="row-2">
                                        <td class="column-1">2</td>
                                        <td class="column-2">A-01</td>
                                        <td class="column-3"><a href="javascript:void(0);">Neha Agnihotri</a></td>
                                        <td class="column-4"></td>
                                        <td class="column-5">-</td>
                                        <td class="column-6"></td>
                                        <td class="column-7"></td>
                                        <td class="column-8"></td>
                                        <td class="column-9"></td>
                                        <td class="column-10"></td>
                                        <td class="column-11"></td>
                                        <td class="column-12">-</td>
                                        <td class="column-13">-</td>
                                        <td class="column-14">-</td>
                                        <td class="column-15">-</td>
                                        <td class="column-16">0</td>
                                    </tr>
                                    <tr class="row-3">
                                        <td class="column-1">3</td>
                                        <td class="column-2">A-02</td>
                                        <td class="column-3"><a href="javascript:void(0);">Alagh Family Trust</a></td>
                                        <td class="column-4"></td>
                                        <td class="column-5">-</td>
                                        <td class="column-6"></td>
                                        <td class="column-7"></td>
                                        <td class="column-8"></td>
                                        <td class="column-9"></td>
                                        <td class="column-10"></td>
                                        <td class="column-11">free</td>
                                        <td class="column-12">-</td>
                                        <td class="column-13">-</td>
                                        <td class="column-14">-</td>
                                        <td class="column-15">-</td>
                                        <td class="column-16">0</td>
                                    </tr>
                                    <tr class="row-4">
                                        <td class="column-1">4</td>
                                        <td class="column-2">A-02</td>
                                        <td class="column-3"><a href="javascript:void(0);">Anjori Alagh</a></td>
                                        <td class="column-4"></td>
                                        <td class="column-5">-</td>
                                        <td class="column-6"></td>
                                        <td class="column-7"></td>
                                        <td class="column-8"></td>
                                        <td class="column-9"></td>
                                        <td class="column-10"></td>
                                        <td class="column-11">Monthly</td>
                                        <td class="column-12">-</td>
                                        <td class="column-13">-</td>
                                        <td class="column-14">-</td>
                                        <td class="column-15">-</td>
                                        <td class="column-16">0</td>
                                    </tr>
                                    <tr class="row-5">
                                        <td class="column-1">5</td>
                                        <td class="column-2">A-02</td>
                                        <td class="column-3"><a href="javascript:void(0);">Maya Alagh</a></td>
                                        <td class="column-4"></td>
                                        <td class="column-5">-</td>
                                        <td class="column-6"></td>
                                        <td class="column-7"></td>
                                        <td class="column-8"></td>
                                        <td class="column-9"></td>
                                        <td class="column-10"></td>
                                        <td class="column-11">Monthly</td>
                                        <td class="column-12">-</td>
                                        <td class="column-13">-</td>
                                        <td class="column-14">-</td>
                                        <td class="column-15">-</td>
                                        <td class="column-16">0</td>
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

<!-- Modal -->
<div id="Modalfilter-intax" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Client Group : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control">
                                        <option>A-01</option>
                                        <option>A-02</option>
                                        <option>A-03</option>
                                        <option>A-04</option>
                                        <option>A-05</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Client Name : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control">
                                        <option>Mayur Shelar</option>
                                        <option>Neha Agnihotri</option>
                                        <option>Maya Alagh</option>
                                        <option>Alagh Family Trust</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Cost Center : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control">
                                        <option>Mayur Shelar</option>
                                        <option>Partik Shinde</option>
                                        <option>Bill Gates</option>
                                        <option>Elon Musk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Staff Name : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control">
                                        <option>Nishnat Gosavi</option>
                                        <option>Saurabh Gharat</option>
                                        <option>Shivam Dube</option>
                                        <option>Virat Singh</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Due Date For : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control">
                                        <option>Returns</option>
                                        <option>TAR-44AB</option>
                                        <option>Returns-44AB</option>
                                        <option>TP Report-92E</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Periodicity : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control">
                                        <option>Daily</option>
                                        <option>Monthly</option>
                                        <option>Quarterly</option>
                                        <option>Half Yearly</option>
                                        <option>Annually</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4">Due Date Month : </label>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-control">
                                        <option>January</option>
                                        <option>February </option>
                                        <option>March</option>
                                        <option>April</option>
                                        <option>May </option>
                                        <option>June</option>
                                        <option>July</option>
                                        <option>August</option>
                                        <option>September</option>
                                        <option>October</option>
                                        <option>November</option>
                                        <option>December</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right" style="width: 100%;">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning text-left" data-dismiss="modal">Reset</button>
                    <button type="submit" name="submit" class="btn btn-success text-left sub_btn">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?= $this->endSection(); ?>