<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .theme-primary .wizard-content .wizard > .steps > ul > li.done {
            margin-top: 15px;
            width: 300px;
    }
            
    /* .tablepress tbody tr:first-child td {
        background: #288651;
        color: #fff;
    }  */
    
    /* .tablepress tbody tr:nth-child(3) td.column-1 {
        background: #fb3d3d;
        color: #fff;
    } */
    
    .theme-primary .wizard-content .wizard > .steps > ul > li.current {
        margin-top: 15px;
        width: 300px;
    }
    
    .tablepress{
        width:100%;
    }
    
    .tablepress thead tr, .tablepress thead th {
        text-align: center;
        width: 10%;
    }
    
    .tablepress tbody td {
        text-align: center;
    }
    
    .tablepress td, .tablepress th {
        font-weight: 600;
    }
    
    .tablepress tbody tr:nth-child(6) td.column-1 {
        background: #fff;
    }
    
    table.dataTable {
        clear: both;
         margin-top: 0px !important; 
    }
    
    .wizard-content .wizard > .content > .body {
        padding: 0px 20px;
    }

    .active-row {
        background: #288651;
        color: #fff !important;
    } 

    .non-active-row {
        background: #fb3d3d;
        color: #fff !important;
    }

    .wizard-content .wizard > .steps > ul > li.current > a {
        color: #ffffff !important;
        cursor: default;
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
        padding: 10px 14px !important;
    }
    
    .select2-container--default .select2-selection--single {
        background-color: #005495 !important;
        border: 1px solid #aaa;
        border-radius: 4px;
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
        margin-top: 4px !important;
    }
    
    .select2-container--default .select2-selection--single {
        background-color: #005495 !important;
        border: 1px solid #aaa;
        border-radius: 12px !important;
    }
</style>

<!-- Main content -->
<section class="content mt-35">
    <div class="row">

        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?php echo $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('master_data'); ?>">
                            <button type="button" class="btn btn-sm btn-dark" >Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body wizard-content">
                    <?php if(!empty($clientMasterData)): ?>
                        <?php foreach($clientMasterData AS $e_cli): ?>
                            <?php if($selActVal==$e_cli['id']): ?>
                            <?php
                                $optionName=$e_cli['name'];    
                                $optionType=$e_cli['type'];    
                            ?>
                            <!-- <h6><?php //echo $optionName; ?></h6> -->
                            <?php
                                $resultArr=array();
    
                                $lastColName="";
                                $clientActId=$e_cli['id'];
    
                                if($e_cli['id']==1)
                                {
                                    $lastColName="Registration No";
    
                                    if(isset($clientOrgArr[1]))
                                        $resultArr=$clientOrgArr[1];
                                }
                                elseif($e_cli['id']==2)
                                {
                                    $lastColName="Registration No";
    
                                    if(isset($clientOrgArr[2]))
                                        $resultArr=$clientOrgArr[2];
                                }
                                elseif($e_cli['id']==3)
                                {
                                    $lastColName="Registration No";
    
                                    if(isset($clientOrgArr[4]))
                                        $resultArr=$clientOrgArr[4];
                                }
                                elseif($e_cli['id']==4)
                                {
                                    $lastColName="Registration No";
    
                                    if(isset($clientOrgArr[5]))
                                        $resultArr=$clientOrgArr[5];
                                }
                                elseif($e_cli['id']==5)
                                {
                                    $lastColName="Registration No";
    
                                    if(isset($clientOrgArr[6]))
                                        $resultArr1=$clientOrgArr[6];
                                    else
                                        $resultArr1=array();
    
                                    if(isset($clientOrgArr[7]))
                                        $resultArr2=$clientOrgArr[7];
                                    else
                                        $resultArr2=array();
    
                                    $resultArr=array_merge($resultArr1, $resultArr2);
                                }
                                elseif($e_cli['id']==6)
                                {
                                    $lastColName="Aadhar";
    
                                    if(isset($clientDocArr[1]))
                                        $resultArr=$clientDocArr[1];
                                }
                                elseif($e_cli['id']==7)
                                {
                                    $lastColName="TAN";
    
                                    if(isset($clientDocArr[2]))
                                        $resultArr=$clientDocArr[2];
                                }
                                elseif($e_cli['id']==8)
                                {
                                    $lastColName="GST No";
    
                                    if(isset($clientDocArr[5]))
                                        $resultArr=$clientDocArr[5];
                                }
                                elseif($e_cli['id']==9)
                                {
                                    $lastColName="PT-Enrolment";
    
                                    if(isset($clientDocArr[6]))
                                        $resultArr=$clientDocArr[6];
                                }
                                elseif($e_cli['id']==10)
                                {
                                    $lastColName="PT-Registration";
    
                                    if(isset($clientDocArr[7]))
                                        $resultArr=$clientDocArr[7];
                                }
                                elseif($e_cli['id']==11)
                                {
                                    $lastColName="Registration No";
    
                                    if(isset($clientDocArr[10]))
                                        $resultArr=$clientDocArr[10];
                                }
                            ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control" name="selAct" id="selAct" style="width:100%;margin-top: 4px;">
                                        <option value="">Select Act</option>
                                        <?php if(!empty($clientMasterData)): ?>
                                            <?php foreach($clientMasterData AS $e_act_val): ?>
                                                <option value="<?php echo $e_act_val['id']; ?>" <?php if($selActVal==$e_act_val['id']): ?>selected<?php endif; ?>>
                                                    <?php echo $e_act_val['name']; ?> Act
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select> 
                                </div>
                            </div>
                            <section>
                                <div class="row">   
                                    <div class="col-md-12 col-12 text-justify-center table-responsive" style="overflow-x:auto;">
                                        <div class="row mb-0"> 
                                            <div class="col-md-12 col-12">
                                                <h2 class="text-center proj_txt_clr text-bold mt-0 mb-10">
                                                    Master list of Old Clients : <?php echo $optionName; ?>
                                                </h2>
                                            </div>
                                            <!--
                                            <div class="col-md-12 col-12 text-right">
                                                <a href="<?php //echo base_url("admin/downloadMasterClientData"); ?>?masterId=<?php //echo $clientActId; ?>" target="_blank">
                                                    <button type="button" class="waves-effect waves-light btn btn-info mb-5">
                                                        <i class="fa fa-download"></i> Download
                                                    </button>
                                                </a>
                                            </div>
                                            -->
                                        </div>
                                        <div class="table-responsive">
                                            <table class="data_tbl table table-bordered table-striped" style="width:100%">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="5%">SN</th>
                                                        <th width="5%">Group&nbsp;No</th>
                                                        <th width="20%">Client&nbsp;Name</th>
                                                        <th>Status</th>
                                                        <th>DOB/DOI</th>
                                                        <th>PAN</th>
                                                        <th><?php echo $lastColName; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $currGrp=""; ?>
                                                    <?php $prevGrp=""; ?>
                                                    <?php $clrCnt=1; ?>
                                                    <?php $i=1; ?>
                                                    <?php if(!empty($resultArr)): ?>
                                                        <?php foreach($resultArr AS $e_data): ?>
                                                        <?php $client_group_num=$e_data['client_group_number']; ?>
                                                        <?php $currGrp=$client_group_num; ?>
                                                        
                                                        <?php
                                                            if($currGrp!=$prevGrp)
                                                                $clrCnt++;
                                                            
                                                            $clrSeq=($clrCnt%2);
                                                            
                                                            if($clrSeq==0)
                                                                $grpClr="#005495";
                                                            else
                                                                $grpClr="#f48b04";
                                                        ?>
                                                            <tr>
                                                                <td class="text-center" width="5%"><?php echo $i; ?></td>
                                                                <td class="text-center" width="5%" nowrap>
                                                                    <a href="javascript:void(0);" data-toggle="tooltip" data-original-title="<?= $e_data['client_group']; ?>" style="color: <?= $grpClr; ?> !important;">
                                                                        <?php 
                                                                            if(!empty($client_group_num))
                                                                                echo $client_group_num;
                                                                            else 
                                                                                echo " "; 
                                                                        ?>
                                                                    </a>
                                                                </td>
                                                                <td width="20%" nowrap>
                                                                    <?php 
                                                                        if($e_data['clientBussOrganisationType']==9)
                                                                            echo $e_data['clientName'];
                                                                        if($e_data['clientBussOrganisationType']==8 && $clientActId==6)
                                                                            echo $e_data['clientName'];
                                                                        else
                                                                            echo $e_data['clientBussOrganisation'];
                                                                    ?>
                                                                </td>
                                                                <td class="text-center" nowrap>
                                                                    <?php 
                                                                        if(!empty($e_data['organisation_type_name']))
                                                                            echo $e_data['organisation_type_name'];
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="text-center" nowrap>
                                                                    <?php 
                                                                        if($e_data['clientBussOrganisationType']==8 || $e_data['clientBussOrganisationType']==9)
                                                                        {
                                                                            if(!empty($e_data['clientDob']) && $e_data['clientDob']!="0000-00-00")
                                                                                echo date("d-m-Y", strtotime($e_data['clientDob']));
                                                                            else 
                                                                                echo " "; 
                                                                        }
                                                                        else
                                                                        {
                                                                            if(!empty($e_data['clientBussIncorporationDate']) && $e_data['clientBussIncorporationDate']!="0000-00-00")
                                                                                echo date("d-m-Y", strtotime($e_data['clientBussIncorporationDate']));
                                                                            else 
                                                                                echo " "; 
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td class="text-center" nowrap>
                                                                    <?php 
                                                                        if(!empty($e_data['clientPanNumber']))
                                                                            echo $e_data['clientPanNumber'];
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="text-center" nowrap>
                                                                    <?php
                                                                        if($optionType=="org")
                                                                        {
                                                                            if(!empty($e_data['clientRegDocument']))
                                                                                echo $e_data['clientRegDocument'];
                                                                            else 
                                                                                echo " "; 
                                                                        }
                                                                        elseif($optionType=="act")
                                                                        {
                                                                            if($clientActId==6)
                                                                            {
                                                                                if(isset($clientDocArr[3][$e_data['clientId']]['client_document_number']))
                                                                                    echo $clientDocArr[3][$e_data['clientId']]['client_document_number'];
                                                                                else 
                                                                                    echo " "; 
                                                                            }
                                                                            else
                                                                            {
                                                                                if(!empty($e_data['client_document_number']))
                                                                                    echo $e_data['client_document_number'];
                                                                                else 
                                                                                    echo " "; 
                                                                            }
                                                                        }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                            <?php $prevGrp=$client_group_num; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="7">
                                                                <center>No records</center>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
            
    $(document).ready(function(){

        $('.wizard-content .wizard > .actions > ul').append('<li><button type="submit" name="submit" class="waves-effect waves-light btn btn-submit text-right extra_sub_btn">Submit</button></li>');
        
        $('body').on('click', '.steps li', function(){
            
            if($(this).hasClass('last'))
            {
                $('.extra_sub_btn').hide();
            }
            else
            {
                $('.extra_sub_btn').show();
            }
            
        });
        
        $('.steps ul li:not(:first)').removeClass('disabled');
        $('.steps ul li:not(:first)').addClass('done');
        
        $('.wizard-content .wizard > .actions').hide();
        $('.wizard-content .wizard > .actions > ul').css('margin-right', '40%');

        var base_url = "<?php echo base_url(); ?>";

        $('#selAct').on('change', function(){

            var selAct = $(this).val();

            window.location.href=base_url+'/getMasterOldClientData?selAct='+selAct;

        });

    });

</script>


<?= $this->endSection(); ?>