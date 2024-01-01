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
                        <a href="<?php echo base_url('admin/master_data'); ?>">
                            <button type="button" class="btn btn-sm btn-dark" >Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body wizard-content">
                    <div class="form-group row">
                        <label class="col-form-label col-md-1">Act: </label>
                        <div class="col-md-5">
                            <select class="form-control" name="selAct" id="selAct">
                                <option value="">Select Act</option>
                                <?php if(!empty($clientMasterData)): ?>
                                    <?php foreach($clientMasterData AS $e_act_val): ?>
                                        <option value="<?php echo $e_act_val['id']; ?>" <?php if($selActVal==$e_act_val['id']): ?>selected<?php endif; ?>>
                                            <?php echo $e_act_val['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <form action="#" class="tab-wizard wizard-circle client_form">
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
                                <section>
                                    <div class="row"> 
                                        <div class="col-md-12 col-12 mt-20 text-justify-center table-responsive" style="overflow-x:auto;">
                                            <div class="form-group row mb-0"> 
                                                <div class="col-md-12 col-12">
                                                    <h2 class="text-center text-danger text-bold"><?php echo $optionName; ?></h2>
                                                </div>
                                                <div class="col-md-12 col-12 text-right">
                                                    <a href="<?php echo base_url("admin/downloadMasterClientData"); ?>?masterId=<?php echo $clientActId; ?>" target="_blank">
                                                        <button type="button" class="waves-effect waves-light btn btn-info mb-5">
                                                            <i class="fa fa-download"></i> Download
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            <table id="tablepress-2" class="tablepress table-media tablepress-id-2 custom-table dataTable no-footer mt-20">
                                                <thead>
                                                    <tr class="row-1">
                                                        <th class="column-1">Sr.No</th>
                                                        <th class="column-2">Group No</th>
                                                        <th class="column-3">Client Name</th>
                                                        <th class="column-4">Status</th>
                                                        <th class="column-5">DOB</th>
                                                        <th class="column-6">DOI</th>
                                                        <th class="column-7">PAN</th>
                                                        <th class="column-8"><?php echo $lastColName; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row-hover">
                                                    <tr class="row-2 active-row">
                                                        <td colspan="10" class="column-1 active-row">Active</td>
                                                    </tr>	
                                                    <?php $j=1; ?>
                                                    <?php $isActive=false; ?>
                                                    <?php if(!empty($resultArr)): ?>
                                                        <?php foreach($resultArr AS $e_data): ?>
                                                            <?php if($e_data['clientStatus']==1): ?>
                                                            <?php $isActive=true; ?>
                                                            <tr class="row-5">
                                                                <td class="column-1"><?php echo $j; ?></td>
                                                                <td class="column-2">
                                                                    <?php 
                                                                        if(!empty($e_data['client_group_number']))
                                                                            echo $e_data['client_group_number'];
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-3">
                                                                    <?php 
                                                                        // if(!empty($e_data['clientName']))
                                                                        //     echo $e_data['clientName'];
                                                                        // else 
                                                                        //     echo " "; 

                                                                        if($e_data['clientBussOrganisationType']==9)
                                                                            echo $e_data['clientTitle'].". ".$e_data['clientName'];
                                                                        else
                                                                            echo $e_data['clientBussOrganisation'];
                                                                    ?>
                                                                </td>
                                                                <td class="column-4">
                                                                    <?php 
                                                                        if(!empty($e_data['organisation_type_name']))
                                                                            echo $e_data['organisation_type_name'];
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-5">
                                                                    <?php 
                                                                        if(!empty($e_data['clientDob']) && $e_data['clientDob']!="0000-00-00")
                                                                            echo date("d-m-Y", strtotime($e_data['clientDob']));
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-6">
                                                                    <?php 
                                                                        if(!empty($e_data['clientBussIncorporationDate']) && $e_data['clientBussIncorporationDate']!="0000-00-00")
                                                                            echo date("d-m-Y", strtotime($e_data['clientBussIncorporationDate']));
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-7">
                                                                    <?php 
                                                                        if(!empty($e_data['clientPanNumber']))
                                                                            echo $e_data['clientPanNumber'];
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-8">
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
                                                            <?php $j++; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <?php if(!$isActive): ?>
                                                            <tr class="row-5">
                                                                <td colspan="8">No records</td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <tr class="row-5">
                                                            <td colspan="8">No records</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <tr class="row-4 non-active-row">
                                                        <td colspan="10" class="column-1 non-active-row">Non-Active</td>
                                                    </tr>
                                                    <?php $k=1; ?>
                                                    <?php $isNonActive=false; ?>
                                                    <?php if(!empty($resultArr)): ?>
                                                        <?php foreach($resultArr AS $e_data): ?>
                                                            <?php if($e_data['clientStatus']==2): ?>
                                                            <?php $isNonActive=true; ?>
                                                            <tr class="row-5">
                                                                <td class="column-1"><?php echo $k; ?></td>
                                                                <td class="column-2">
                                                                    <?php 
                                                                        if(!empty($e_data['client_group_number']))
                                                                            echo $e_data['client_group_number'];
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-3">
                                                                    <?php 
                                                                        // if(!empty($e_data['clientName']))
                                                                        //     echo $e_data['clientName'];
                                                                        // else 
                                                                        //     echo " "; 

                                                                        if($e_data['clientBussOrganisationType']==9)
                                                                            echo $e_data['clientTitle'].". ".$e_data['clientName'];
                                                                        else
                                                                            echo $e_data['clientBussOrganisation'];
                                                                    ?>
                                                                </td>
                                                                <td class="column-4">
                                                                    <?php 
                                                                        if(!empty($e_data['organisation_type_name']))
                                                                            echo $e_data['organisation_type_name'];
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-5">
                                                                    <?php 
                                                                        if(!empty($e_data['clientDob']) && $e_data['clientDob']!="0000-00-00")
                                                                            echo date("d-m-Y", strtotime($e_data['clientDob']));
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-6">
                                                                    <?php 
                                                                        if(!empty($e_data['clientBussIncorporationDate']) && $e_data['clientBussIncorporationDate']!="0000-00-00")
                                                                            echo date("d-m-Y", strtotime($e_data['clientBussIncorporationDate']));
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-7">
                                                                    <?php 
                                                                        if(!empty($e_data['clientPanNumber']))
                                                                            echo $e_data['clientPanNumber'];
                                                                        else 
                                                                            echo " "; 
                                                                    ?>
                                                                </td>
                                                                <td class="column-8">
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
                                                            <?php $k++; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <?php if(!$isNonActive): ?>
                                                            <tr class="row-5">
                                                                <td colspan="8">No records</td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <tr class="row-5">
                                                            <td colspan="8">No records</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </form>
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

            window.location.href=base_url+'/admin/getMasterClientData?selAct='+selAct;

        });

    });

</script>


<?= $this->endSection(); ?>