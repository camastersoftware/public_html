<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
        .table-responsive1 table thead tr{
            background: #005495 !important;
            color: #fff !important;
        }
        
        .table-responsive1 table tbody tr{
            background: #96c7f242 !important;
        }
        
        .table-responsive1 tr th{
            border: 1px solid #fff !important;
        }
        
        .table-responsive1 tr td{
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
        
        /*.btn-group{*/
        /*    display: block !important;*/
        /*}*/
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
                            <a href="<?php echo base_url('announcements'); ?>">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="My Announcements">
                                    Self
                                </button>
                            </a>
                            &nbsp;&nbsp;
                            <a href="<?php echo base_url('office-administration'); ?>">
                                <button type="button" class="waves-effect waves-light btn btn-sm btn-dark float-right" style="">Back</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive1">
                            <div class="row">
                                <div class="col-12">
                                    <table class="onlyTableId table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">SN</th>
                                                <th>Announcement</th>
                                                <th width="5%">Start&nbsp;Date</th>
                                                <th width="5%">End&nbsp;Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($ancArr)): ?>
                                                <?php $i=1; ?>
                                                <?php foreach($ancArr AS $e_row): ?>
                                                    <?php
                                                        $startDate = (check_valid_date($e_row['startDate'])) ? date('Y-m-d', strtotime($e_row['startDate'])) : "";
                                                        $endDate = (check_valid_date($e_row['endDate'])) ? date('Y-m-d', strtotime($e_row['endDate'])) : "";

                                                        $showAnnc = "yes";
                                                        if($startDate!="" && $endDate!="")
                                                        {
                                                            $periodDates = get_dates_btwn_two($startDate, $endDate);
                                                            
                                                            if(!empty($periodDates)){
                                                                foreach ($periodDates as $key => $value) {
                                                                    $anncDate = $value;
                                                                    
                                                                    if($anncDate >= $ddFromDate && $anncDate<=$ddToDate)
                                                                    {
                                                                        $showAnnc = "yes";
                                                                        break;
                                                                    }
                                                                    else
                                                                    {
                                                                        $showAnnc = "no";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    <?php if($showAnnc=="yes"): ?>
                                                    <tr>
                                                        <td nowrap width="5%" class="text-center"><?php echo $i; ?></td>
                                                        <td ><?php echo $e_row['ancName']; ?></td>
                                                        <td nowrap width="5%"><?php echo date('d-m-Y', strtotime($e_row['startDate'])); ?></td>
                                                        <td nowrap width="5%"><?php echo date('d-m-Y', strtotime($e_row['endDate'])); ?></td>
                                            		</tr>
                                        		    <?php $i++; ?>
                                        		    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6"><center>No records</center></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
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
    
<?= $this->endSection(); ?>