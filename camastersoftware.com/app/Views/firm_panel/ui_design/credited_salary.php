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
        
        /*table.dataTable{*/
        /*    margin-top: -20px !important;*/
        /*}*/
        
        /*Ref: https://codepen.io/Vikaspatel/pen/BawZeag*/
        
        .year-color {
            color: #303030 !important;
            font-weight: bold !important;
        }
        
        .clrBtn {
            width: 13.33%;
            padding: 25px;
            color: #ffffff;
            font-size: 30px;
            cursor: pointer;
            border: 0;
            transition: 300ms all linear;
            position: relative;
        }
        .clrBtn.active:after {
            content: "";
            height: 20px;
            width: 20px;
            position: absolute;
            background-color: #ffffff;
            top: 14px;
            right: 22px;
            border-radius: 50%;
        }
        .clrBtn.active:before {
            content: "";
            height: 7px;
            width: 10px;
            position: absolute;
            top: 20px;
            right: 27px;
            border-radius: 2px;
            position: absolute;
            z-index: 1;
            border-left: 3px solid #333333;
            border-bottom: 3px solid #333333;
            z-index: 11;
            transform: rotate(-45deg);
        }
        
        .none{
            background-color: #96c7f242 !important;
        }
        .red{
            background-color: #f58b8b !important;
        } 
        .yellow{
            background-color: #f0f58b !important;
        } 
        .violet{
            background-color: #f38bf5 !important;
        } 
        .green{
            background-color: #37fa1f !important;
        } 
        
        .hdClr{
            /*color:#005495 !important;*/
        }
        
        table.dataTable{
            margin-top: 0px !important;
        }
        
        /*.btn-group{*/
        /*    display: block !important;*/
        /*}*/
        
        .select2-container--default .select2-selection--single {
            background-color: #005495 !important;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 41px !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #fff !important;
            line-height: 28px;
            font-weight: 700 !important;
            font-size: 17.2px !important;
        }
        
        .select2-container--default .select2-selection--single {
            background-color: #005495 !important;
            border: 1px solid #aaa;
            border-radius: 4px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 32px !important;
            right: 3px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #fff transparent transparent transparent !important;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 50%;
            margin-left: -4px;
            margin-top: -2px;
            position: absolute;
            top: 50%;
            width: 0;
        }
        
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            margin-top: 0px;
            position: relative;
            vertical-align: middle;
            margin-top: 0px !important;
        }
        
        .select2-container--default .select2-selection--single {
            background-color: #005495 !important;
            border: none !important;
            border-radius: 7px !important;
            height: 41px !important;
        }
        
        #DataTables_Table_0_filter{
            margin-top: -40px !important;
        }
        
        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: -17.5em !important;
            display: inline-block;
            width: auto;
            z-index: 9999999 !important;
            position: absolute !important;
            height: 40px !important;
            margin-top: -6px !important;
        }
        
        .theme-primary .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #005495 !important;
        }
        
        .btn_rnd{
            border-radius: 7px !important;
            width: 100% !important;
        }
        
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0;
            height: auto;
            margin-top: 0px !important;
            padding-right: 10px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 5px !important;
            right: 1px;
            width: 20px;
        }

        .payable-head {
            font-size: 14px !important;
            color: red !important;
            width: 15% !important;
        }

        .payable-head2 {
            font-size: 12px !important;
            text-align: left !important;
        }

        .salary-values td {
            font-size: 12px !important;
            text-align: left !important;    
        }

        /*.w-col {
            width: 7%;
        }*/

        .input-salry {
            width: 100% !important;
        }

        .tablepress {
            background: #e4f1fc;
            color: #000;
        }

        .tablepress tbody td, .tablepress tfoot th {
            border: 1px solid #015aacab;
            color: #000;
        }

        .font-weight-sm {
            font-weight: 400 !important;
        }

    </style>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box mt-40">
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
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('admin/home'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right font-weight-bold" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="tab-content tabcontent-border p-15" id="myTabContent">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="state due-month">
                                                <label>DETAILS OF SALARY PAYABLE (CTC)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="state heading-act">
                                                <label>ACCOUNTING YEAR : 2021-22</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="state heading-act">
                                                <label>NAME OF THE EMPLOYEE : Ulhas Agnihotri</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show active" id="apr_tab" role="tabpanel" aria-labelledby="apr-tab">
                                        <table id="tablepress-2" class="tablepress table-resposnsive tablepress-id-2 custom-table dataTable-act no-footer">
                                            <!-- <thead>
                                                <tr class="row-0">
                                                    <th class="column-1" colspan="5">Due Date : </th>
                                                    <th class="column-2" colspan="4">Periodicity : Yearly</th>
                                                    <th class="column-3" colspan="7">Period : Apr - Mar </th> 
                                                </tr>
                                            </thead> -->
                                            <thead>
                                                <tr class="row-1">
                                                    <th class="column-1">MONTH & YEAR</th>
                                                    <th class="column-2">APR</th>
                                                    <th class="column-3">MAY</th>
                                                    <th class="column-3">JUN</th>
                                                    <th class="column-4">JUL</th>
                                                    <th class="column-5">AUG</th>
                                                    <th class="column-6">SEPT</th>
                                                    <th class="column-7">OCT</th>
                                                    <th class="column-8">NOV</th>
                                                    <th class="column-9">DEC</th>
                                                    <th class="column-11">JAN</th>
                                                    <th class="column-12">FEB</th>
                                                    <th class="column-13">MAR</th>
                                                    <th class="column-14">TOTAL</th>
                                                </tr>
                                                <tr class="row-1">
                                                    <th class="column-1"></th>
                                                    <th class="column-2">2021</th>
                                                    <th class="column-3">2021</th>
                                                    <th class="column-3">2021</th>
                                                    <th class="column-4">2021</th>
                                                    <th class="column-5">2021</th>
                                                    <th class="column-6">2021</th>
                                                    <th class="column-7">2021</th>
                                                    <th class="column-8">2021</th>
                                                    <th class="column-9">2021</th>
                                                    <th class="column-11">2021</th>
                                                    <th class="column-12">2021</th>
                                                    <th class="column-13">2021</th>
                                                    <th class="column-14">2021-22</th>

                                                    <!-- <th class="column-14">Amount</th>
                                                    <th class="column-15">Date</th>
                                                    <th class="column-16">Amount</th> -->
                                                </tr>
                                            </thead>
                                            <tbody class="row-hover">
                                                <tr class="row-1">
                                                    <td class="column-1 payable-head2">Days Present</td>
                                                    <td class="column-2"><input type="text" class="input-salry"></td>
                                                    <td class="column-3"><input type="text" class="input-salry"></td>
                                                    <td class="column-3"><input type="text" class="input-salry"></td>
                                                    <td class="column-4"><input type="text" class="input-salry"></td>
                                                    <td class="column-5"><input type="text" class="input-salry"></td>
                                                    <td class="column-6"><input type="text" class="input-salry"></td>
                                                    <td class="column-7"><input type="text" class="input-salry"></td>
                                                    <td class="column-8"><input type="text" class="input-salry"></td>
                                                    <td class="column-9"><input type="text" class="input-salry"></td>
                                                    <td class="column-11"><input type="text" class="input-salry"></td>
                                                    <td class="column-12"><input type="text" class="input-salry"></td>
                                                    <td class="column-13"><input type="text" class="input-salry"></td>
                                                    <td class="column-14"><input type="text" class="input-salry"></td>

                                                    <!-- <th class="column-14">Amount</th>
                                                    <th class="column-15">Date</th>
                                                    <th class="column-16">Amount</th> -->
                                                </tr>
                                                <tr>    
                                                    <td class="column-1 payable-head">Payable Monthly</td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1 payable-head2">Salary Payment</td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1 font-weight-sm">a) Basic</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1font-weight-sm">HRA</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1font-weight-sm">Conveyance Reimb.</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1font-weight-sm">Medical Reimb</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1">Gross Salary (CTC)</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1 payable-head2">Deductions</td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1 font-weight-sm">a) Profession Tax</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1 font-weight-sm">b) Income Tax</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1 font-weight-sm">c) Provident Fund</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1"></td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1">Net Amount Payable</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1">
                                                    <td class="column-1 payable-head">Payable Annually</td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1">Bonus</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                                <tr class="row-1 salary-values">
                                                    <td class="column-1">Leave Encashment</td>
                                                    <td class="column-2 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-3 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-4 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-5 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-6 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-7 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-8 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-9 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-10 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-11 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-12 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-13 w-col">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                    <td class="column-14">
                                                        <input type="text" class="input-salry">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
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

    <!-- Modal -->
    <div id="addTDList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo base_url('admin/addTDList'); ?>" method="POST" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add New</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                        	<div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Name of Client<small class="text-danger">*</small></label>
                                    <select class="custom-select form-control" name="tdAllotedTo" id="tdAllotedTo" required>
                                        <option value="">Select</option>
                                         <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Status<small class="text-danger">*</small></label>
                                    <select class="custom-select form-control" name="tdAllotedTo" id="tdAllotedTo" required>
                                        <option value="">Select</option>
                                         <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>DIN No.<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="DINNo" id="DINNo" placeholder="Enter DIN No." required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>PAN Number<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="PANNumber" id="PANNumber" placeholder="Enter PAN Number" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>PUR.Form<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="PURForm" id="PURForm" placeholder="Enter PUR.Form" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Class<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="Class" id="Class" placeholder="Enter Class" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Password<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="Password" id="Password" placeholder="Enter Password" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Start Date<small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="tdDate" id="tdDate" min="<?= date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>End Date<small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="tdDate" id="tdDate" min="<?= date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Remark<small class="text-danger">*</small></label>
                                    <textarea class="form-control" name="Remark" id="Remark" placeholder="Enter Remark" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right" style="width: 100%;">
                        <input type="hidden" name="tdPriority" id="tdPriority" value="1" />
                        <input type="hidden" name="tdPriorityColor" id="tdPriorityColor" value="none" />
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
        $('.deleteContact').on('click', function () {

            var base_url = "<?php echo base_url(); ?>";
            var contactId = $(this).data('id');

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

                    var postingUrl = base_url+'/admin/deleteContact';
                    $.post(postingUrl, 
                    {
                        contactId: contactId
                    },
                    function(data, status){
                        window.location.href=base_url+"/admin/contactList";
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });

        });   
        
        setTimeout(function () {
            $('div.dataTables_filter input').attr('placeholder', "Search Name");
        }, 100);
    });
</script> 

<script type="text/javascript">
    
    var base_url = "<?= base_url(); ?>";
    
    function searchGroup($this)
    {
        var cont_group_id=$this.value;
        
        window.location.href=base_url+"/admin/contactList?group="+cont_group_id;
    }
    
    function serachSubGroup($this)
    {
        var cont_group_id=$('#contGroupId').val();
        var cont_sub_group_id=$this.value;
        
        window.location.href=base_url+"/admin/contactList?group="+cont_group_id+"&sub_group="+cont_sub_group_id;
    }

</script>
    
<?= $this->endSection(); ?>