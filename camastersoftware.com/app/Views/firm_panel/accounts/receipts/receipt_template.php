<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            @page {
                margin: 25px 25px 0px 25px; /* top, right, bottom, left */
            }
            body{
                font-family: sans-serif;
            }
            table{
                /* width: 700px; */
                margin-top: 0px !important;
                margin-left: auto; 
                margin-right: auto;
                height: auto;
                border-collapse: collapse;
            }
            p{
                font-size: 12px;
            }
            span{
                font-size: 13px;
            }
            .firmHead{
                text-transform: uppercase;
                margin-top: 0px;
                margin-bottom: 0px;
            }
            .no_mrgn{
                margin: 0px;
            }
            .caHead{
                margin: 0px;
            }
            .firmAddress{
                margin: 0px;
            }
            .firmContact{
                margin: 0px;
            }
            .firmEmail{
                margin: 0px;
            }
            .caGSTIN{
                margin: 0px;
            }
            .labelClass{
                font-weight: bold;
            }
            .labelValue{
                text-decoration: underline;
            }
            .receiptTitle{
                font-weight: bold;
                text-decoration: underline;
            }
            .filledValues{
                font-weight: bold;
                text-decoration: underline;
            }
            .boldText{
                font-weight: bold;
            }
            .seperator_line{
                height:0px;
                border-width: 0.1px;
            }
        </style>
    </head>
    <body>
        <?php
            $caFirmName = (!empty($firmDetails['caFirmName'])) ? $firmDetails['caFirmName']:"N/A";
            $caFirmGSTIN = $firmDetails['caFirmGSTIN'];
            $receiptNo = (!empty($billDataArr['receiptNo'])) ? $billDataArr['receiptNo'] : "N/A";
            $receiptDate = (check_valid_date($billDataArr['receiptDate'])) ? date("d-m-Y", strtotime($billDataArr['receiptDate'])) : "";
            $receiptNet = (!empty($billDataArr['receiptNet'])) ? $billDataArr['receiptNet'] : 0;
            $receiptNetFormat = (!empty($receiptNet)) ? amount_format($receiptNet) : 0;
            $receiptAmtInWords = (!empty($receiptNet)) ? moneyInWords($receiptNet) : "";
            $receiptMode = (!empty($billDataArr['receiptMode'])) ? $billDataArr['receiptMode'] : "";
            $reciptModeVal = (!empty($pmtModesArr[$receiptMode])) ? $pmtModesArr[$receiptMode] : "";
            $receiptChequeNo = (!empty($billDataArr['receiptChequeNo'])) ? $billDataArr['receiptChequeNo'] : "";
            $receiptDated = (check_valid_date($billDataArr['receiptDated'])) ? date("d-m-Y", strtotime($billDataArr['receiptDated'])) : "";
            $receiptDrawnOn = (!empty($billDataArr['receiptDrawnOn'])) ? $billDataArr['receiptDrawnOn'] : "";
            
            
        ?>
        <table>
            <tbody>
                <tr>
                    <td align="center" colspan="3">
                        <h3 class="firmHead"><?= $caFirmName; ?></h3>
                        <h5 class="caHead no_mrgn">CHARTERED ACCOUNTANTS</h5>
                        <p class="firmAddress no_mrgn"><?= (!empty($firmDetails['caFirmAddress'])) ? $firmDetails['caFirmAddress']:"N/A"; ?></p>
                        <p class="firmContact no_mrgn">Phone No. : <?= (!empty($firmDetails['caFirmMobile'])) ? $firmDetails['caFirmMobile']:"N/A"; ?></p>
                        <p class="firmEmail no_mrgn">E-Mail : <?= (!empty($firmDetails['caFirmEmail'])) ? $firmDetails['caFirmEmail']:"N/A"; ?></p>
                        <?php if(!empty($caFirmGSTIN)): ?>
                            <p class="caGSTIN no_mrgn">GSTIN : <?= $caFirmGSTIN; ?></p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="3">
                        <hr class="seperator_line">
                    </td>
                </tr>
                <tr>
                    <td align="left"></td>
                    <td align="center">
                        <span class="receiptTitle">RECEIPT</span>
                    </td>
                    <td align="right"></td>
                </tr>
                <tr>
                    <td align="left">
                        <span class="labelClass">No.</span>
                        <span class="labelValue"><?= $receiptNo; ?></span>
                    </td>
                    <td align="center"></td>
                    <td align="right">
                        <span class="labelClass">Date : </span>
                        <span class="labelValue"><?= $receiptDate; ?></span>
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="3">
                        <br>
                        <span class="boldText">RECEIVED </span>
                        <span>with thanks from </span>
                        <span class="filledValues"><?= $workClientName; ?> </span>
                        <span>the sum of </span>
                        <span class="filledValues"><?= $receiptAmtInWords; ?> </span>
                        <?php if($receiptMode==4): ?>
                            <span>by Cheque No. </span>
                            <span class="filledValues"><?= $receiptChequeNo; ?> </span>
                            <span>dated </span>
                            <span class="filledValues"><?= $receiptDated; ?> </span>
                            <span>drawn on </span>
                            <span class="filledValues"><?= $receiptDrawnOn; ?> </span>
                        <?php endif; ?>
                        <?php if($receiptMode!=4): ?>
                            <span>by <?= $reciptModeVal; ?></span>
                        <?php endif; ?>
                        <span> on account of payment of our Bill No. </span>
                        <span class="filledValues"><?= $billNoVal; ?> </span>
                        <span>dated </span>
                        <span class="filledValues"><?= $billDateVal; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2"></td>
                    <td align="center">
                        <span class="labelClass">For <?= $caFirmName; ?></span>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <span class="labelClass">Rs. </span>
                        <span class="filledValues"><?= $receiptNetFormat; ?> </span>
                    </td>
                    <td align="center" colspan="2"></td>
                </tr>
                <tr>
                    <td align="left" colspan="3">
                        <br>
                        <span class="boldText">PS : </span>
                        <span>Please ensure payment of TDS, if deducted.</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>