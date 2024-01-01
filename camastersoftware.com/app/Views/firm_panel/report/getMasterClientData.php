<!DOCTYPE html>
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Report: Master Client Data</title>

        <style>
            .table_class
            {
                border:1px solid black;
                border-collapse: collapse;
                text-align: center;
            }

            .table_class thead tr th{
                font-size: 16px !important;
            } 

            /* .table_class tbody tr:first-child td {
                font-size: 15px !important;
            } */

            .table_width
            {
                width:100%;
            }

            .table_head
            {
                font-weight: 3000;
                font-size: 18px;
            }

            .table_td_amt
            {
                text-align: right;
            }

            .accHeadClass
            {
                font-weight: 100;
            }

            .empty_row
            {
                padding-top: 10px;
                padding-bottom: 10px;
            }

            .left_section
            {
                left: 0px;
                width: 50%;
                position: absolute;
                padding-right: 20px; 
            }

            .right_section
            {
                right: 0px;
                width: 50%;
                position: absolute;
                padding-left: 20px; 
            }

            .text-success
            {
                color: green;
            }

            .text-danger
            {
                color: red;
            }

            .table_td_data
            {
                text-align: left;
            }
            /*.row 
            {
                display: table;
                width: 100%;
                content: "";
                display: table;
                clear: both;
            }*/

            table tr, th, td
            {
                font-size: 15px;
            }

            .main_head{
                display: flex;
            }

            .side1{
                width: 100% !important;
                /*float: left;*/
                text-align: right;
                margin-top: -50px;
            }

            .side2{
                /*width: 20% !important;
                text-align: center;*/
                margin-top: -60px;
            }

            .total_row{
                height: 10px !important;
            }

            .total_row_td{
                border:1px solid black;
                border-collapse: collapse;
                text-align: center;
            }

            .total_row_td h6{
                margin-top: 5px;
                margin-bottom: 5px;
            }

            .logo_img{
                width: 150px;
                padding: 14px;
                padding-right: 0px !important;
                margin-right: -20px !important;
            }

            #footer{
                position: fixed;
                bottom: 12 !important;
            }

            .logo_img1{
                width: 100px;
                margin-left: -20px !important;
            }

            .table_head1 center{
                font-size: 20px !important;
            }

            .table_class tbody tr td{
                font-size: 13px !important;
            } 

            .side2 label{
                font-size: 20px !important;
            }

        </style>
	</head>
    <body>
        <div class="side1">
            <img src="<?= esc(base_url('assets/images/logo-ca.png')); ?>" class="logo_img">
        </div>
        <br>
        <div class="side2">
            <h1 style="margin-bottom: 0px !important;"><center><?php echo $sessCaFirmName; ?></center></h1>
            <p style="margin-top: 0px !important;"><center>CHARTERED ACCOUNTANTS</center></p>
            <label style="margin-bottom: 0px !important;"><center><b>Master Client Data</b></center></label>
            <label style="margin-top: 0px !important;"><center><b><?php echo $optionName; ?></b></center></label>
        </div>
        <br>
        <table class="table_class table_width">
            <thead>
                <tr>
                    <th class="table_class table_head1" colspan='8'><center>Active</center></th>
                </tr>
                <tr>
                    <th class="table_class table_head">Sr.No</th>
                    <th class="table_class table_head">Group No</th>
                    <th class="table_class table_head">Client Name</th>
                    <th class="table_class table_head">Status</th>
                    <th class="table_class table_head">DOB</th>
                    <th class="table_class table_head">DOI</th>
                    <th class="table_class table_head">PAN</th>
                    <th class="table_class table_head"><?php echo $lastColName; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $j=1; ?>
                <?php $isActive=false; ?>
                <?php if(!empty($resultArr)): ?>
                    <?php foreach($resultArr AS $e_data): ?>
                        <?php if($e_data['clientStatus']==1): ?>
                            <?php $isActive=true; ?>
                            <tr>
                                <td class="table_class"><?php echo $j; ?></td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['client_group_number']))
                                            echo $e_data['client_group_number'];
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['clientName']))
                                            echo $e_data['clientName'];
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['organisation_type_name']))
                                            echo $e_data['organisation_type_name'];
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['clientDob']) && $e_data['clientDob']!="0000-00-00")
                                            echo date("d-m-Y", strtotime($e_data['clientDob']));
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['clientBussIncorporationDate']) && $e_data['clientBussIncorporationDate']!="0000-00-00")
                                            echo date("d-m-Y", strtotime($e_data['clientBussIncorporationDate']));
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['clientPanNumber']))
                                            echo $e_data['clientPanNumber'];
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
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
                        <tr>
                            <td class="table_class" colspan='8'><center>No records</center></td>
                        </tr>
                    <?php endif; ?>
                <?php else: ?>
                    <tr>
                        <td class="table_class" colspan='8'><center>No records</center></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <table class="table_class table_width" style="margin-top: 30px;">
            <thead>
                <tr>
                    <th class="table_class table_head1" colspan='8'><center>Non-Active</center></th>
                </tr>
                <tr>
                    <th class="table_class table_head">Sr.No</th>
                    <th class="table_class table_head">Group No</th>
                    <th class="table_class table_head">Client Name</th>
                    <th class="table_class table_head">Status</th>
                    <th class="table_class table_head">DOB</th>
                    <th class="table_class table_head">DOI</th>
                    <th class="table_class table_head">PAN</th>
                    <th class="table_class table_head"><?php echo $lastColName; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $k=1; ?>
                <?php $isNonActive=false; ?>
                <?php if(!empty($resultArr)): ?>
                    <?php foreach($resultArr AS $e_data): ?>
                        <?php if($e_data['clientStatus']==2): ?>
                        <?php $isNonActive=true; ?>
                            <tr>
                                <td class="table_class"><?php echo $k; ?></td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['client_group_number']))
                                            echo $e_data['client_group_number'];
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['clientName']))
                                            echo $e_data['clientName'];
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['organisation_type_name']))
                                            echo $e_data['organisation_type_name'];
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['clientDob']) && $e_data['clientDob']!="0000-00-00")
                                            echo date("d-m-Y", strtotime($e_data['clientDob']));
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['clientBussIncorporationDate']) && $e_data['clientBussIncorporationDate']!="0000-00-00")
                                            echo date("d-m-Y", strtotime($e_data['clientBussIncorporationDate']));
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
                                    <?php 
                                        if(!empty($e_data['clientPanNumber']))
                                            echo $e_data['clientPanNumber'];
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="table_class">
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
                        <tr>
                            <td class="table_class" colspan='8'><center>No records</center></td>
                        </tr>
                    <?php endif; ?>
                <?php else: ?>
                    <tr>
                        <td class="table_class" colspan='8'><center>No records</center></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div id="footer">
            <img src="<?= esc(base_url('assets/images/logo.jpg')); ?>" class="logo_img1">
        </div>
    </body>
</html>