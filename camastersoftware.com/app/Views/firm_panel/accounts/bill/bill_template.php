<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            body{
                align-content: center;
                font-family: sans-serif;
            }
            p{
                font-size: 14px;
            }
            table{
                width: 700px;
                margin-left: auto; 
                margin-right: auto;
                height: auto;
                border-collapse: collapse;
            }
            .table-bordered > tbody > tr > td {
                border-width: 2px 2px 2px 2px;
                border-style: solid;
                border-color: #000000;
                border-collapse: collapse;
                padding: 0 !important;
                margin: 0 !important;
            }
            .table-bordered > tbody > tr > td {
                padding: 0px 3px 0px 3px !important;
            }
            .firmHead{
                text-transform: uppercase;
                margin-top: 1px;
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
            .taxInvHead{
                margin: 0px;
            }
            .billNoDateTr td{
                padding-top: 5px !important;
            }
            .noRightBorder{
                border-right-style: none !important;
            }
            .noLeftBorder{
                border-left-style: none !important;
            }
            .noTopBorder{
                border-top-style: none !important;
            }
            .noBottomBorder{
                border-bottom-style: none !important;
            }
            .billNo{
                margin: 0px;
            }
            .billDate{
                margin: 0px;
            }
            .clientName{
                margin: 0px;
                text-decoration: underline;
            }
            .clientAddress{
                margin: 0px;
            }
            .clientEmail{
                margin: 0px;
            }
            .clientContact{
                margin: 0px;
            }
            .amtHead{
                margin: 0px;
                text-decoration: underline;
            }
            .asstYr{
                margin: 0px;
                text-decoration: underline;
            }
            .accYr{
                margin: 0px;
                text-decoration: underline;
            }
            .overLine{
                text-decoration: overline;
            }
            .underLine{
                text-decoration: underline;
            }
            .moneyWords{
                text-transform: capitalize;
            }
            .txtCenter{
                text-align: center !important;
            }
            .billDescTbl > tbody > tr > td {
                border-top-style: none !important;
                border-bottom-style: none !important;
            }
            .mrgnTop10{
                margin-top: 10px;
            }
            .mrgnLeft30{
                margin-left: 30px;
            }
            .rupeesSymbol{
                font-family: 'DejaVu Sans', sans-serif;
            }
        </style>
        <?php
            $totalRowStyle = "border-width: 2px 2px 2px 2px !important; border-top-style: solid !important; border-color: #000000 !important;";
            $clientTdStyle = "padding: 10px 3px 10px 3px !important;";
            $topBorderStyle = "border-top-style: solid !important;";
            $bottomBorderStyle = "border-bottom-style: solid !important;";
        ?>
    </head>
    <body>
        <?php
            $caFirmGSTIN=$firmDetails['caFirmGSTIN'];
        ?>
        <table class="table-bordered">
            <tbody>
                <tr>
                    <td align="center" colspan="2">
                        <h2 class="firmHead"><?= (!empty($firmDetails['caFirmName'])) ? $firmDetails['caFirmName']:"N/A"; ?></h2>
                        <h4 class="caHead no_mrgn">CHARTERED ACCOUNTANTS</h4>
                        <p class="firmAddress no_mrgn"><?= (!empty($firmDetails['caFirmAddress'])) ? $firmDetails['caFirmAddress']:"N/A"; ?></p>
                        <p class="firmContact no_mrgn">Phone No. : <?= (!empty($firmDetails['caFirmMobile'])) ? $firmDetails['caFirmMobile']:"N/A"; ?></p>
                        <p class="firmEmail no_mrgn">E-Mail : <?= (!empty($firmDetails['caFirmEmail'])) ? $firmDetails['caFirmEmail']:"N/A"; ?></p>
                        <?php if(!empty($caFirmGSTIN)): ?>
                            <h4 class="caGSTIN no_mrgn">GSTIN : <?= $caFirmGSTIN; ?></h4>
                        <?php endif; ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <h4 class="taxInvHead no_mrgn">
                            <?php if(!empty($caFirmGSTIN)): ?>
                                TAX INVOICE
                            <?php else: ?>
                                PROFESSIONAL BILL
                            <?php endif; ?>
                        </h4>
                    </td>
                </tr>
                <tr class="billNoDateTr">
                    <td align="left" class="noRightBorder">
                        <br>
                        <h4 class="billNo no_mrgn">NO. <?= (!empty($billDataArr['billNo'])) ? $billDataArr['billNo']:"N/A"; ?></h4>
                    </td>
                    <td align="right" class="noLeftBorder">
                        <br>
                        <h4 class="billDate no_mrgn">DATE : <?= (check_valid_date($billDataArr['billDate'])) ? date('d-m-Y', strtotime($billDataArr['billDate'])) : "-" ?></h4>
                    </td>
                </tr>
                <tr>
                    <td align="left" class="noRightBorder" style="<?= $clientTdStyle; ?>">
                        <h4 class="clientName no_mrgn"><?= (!empty($clientData['clientName'])) ? $clientData['clientName']:"N/A"; ?></h4>
                        <p class="clientAddress">
                            <?php
                                if(!empty($clientData['clientBussOfficeAddress']))
                                    echo $clientData['clientBussOfficeAddress'];
                                elseif(!empty($clientData['clientResidentialAddress']))
                                    echo $clientData['clientResidentialAddress'];
                                else
                                    echo "N/A";
                            ?>
                        </p>
                        <p class="clientEmail">E-Mail : <?= (!empty($clientData['clientBussEmail1'])) ? $clientData['clientBussEmail1']:"N/A"; ?></p>
                        <p class="clientContact">
                            Phone No. : 
                            <?php
                                if(!empty($clientData['clientBussOfficePhone1']))
                                    echo $clientData['clientBussOfficePhone1'];
                                elseif(!empty($clientData['clientBussResidencePhone']))
                                    echo $clientData['clientBussResidencePhone'];
                                else
                                    echo "N/A";
                            ?>
                        </p>
                    </td>
                    <td class="noLeftBorder"></td>
                </tr>
            </tbody>
        </table>
        <table class="table-bordered billDescTbl">
            <tbody>
                <tr>
                    <td width="70%">
                        <p class="no_mrgn mrgnTop10">Fees for Professional Services rendered as under :</p>
                    </td>
                    <td width="15%" class="txtCenter">
                        <h4 class="amtHead no_mrgn mrgnTop10">AMOUNT</h4>
                        <span class="rupeesSymbol">&#8377;</span>
                    </td>
                    <td width="15%" class="txtCenter">
                        <h4 class="amtHead no_mrgn mrgnTop10">AMOUNT</h4>
                        <span class="rupeesSymbol">&#8377;</span>
                    </td>
                </tr>
                <tr>
                    <td width="70%">
                        <br>
                        <h4 class="asstYr no_mrgn txtCenter">ASSESSMENT YEAR : 2022-2023</h4>
                        <h4 class="accYr no_mrgn txtCenter">ACCOUNTING YEAR : 2021-2022</h4>
                        <br>
                    </td>
                    <td width="15%" align="right"></td>
                    <td width="15%" align="right"></td>
                </tr>
                <?php if(!empty($billDescArr)): ?>
                    <?php foreach($billDescArr AS $k_row => $e_desc): ?>
                        <tr>
                            <td width="70%">
                                <p>
                                    <?= ($k_row+1).") "; ?> <?= nl2br($e_desc['description']); ?>
                                </p>
                            </td>
                            <td width="15%" align="right"></td>
                            <td width="15%" align="right"><?= (!empty($e_desc['amount'])) ? amount_format($e_desc['amount']):""; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php
                    $isLumpsum=$billDataArr['isLumpsum'];
                    $lumpsumAmt=$billDataArr['lumpsumAmt'];
                    $totalAmt=$billDataArr['totalAmt'];
                ?>
                <?php if($isLumpsum==1): ?>
                <tr>
                    <td width="70%">
                        <p class="no_mrgn">All the above charged in lump sum</p>
                    </td>
                    <td width="15%" align="right"></td>
                    <td width="15%" align="right"><?= (!empty($lumpsumAmt)) ? amount_format($lumpsumAmt):"0.00"; ?></td>
                </tr>
                <?php elseif($isLumpsum==2): ?>
                <tr>
                    <td width="70%" align="right">
                        <h4 class="no_mrgn">Total</h4>
                    </td>
                    <td width="15%" align="right"></td>
                    <td width="15%" align="right" style="<?= $topBorderStyle ?>"><?= (!empty($totalAmt)) ? amount_format($totalAmt):"0.00"; ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td width="70%">
                        <p class="no_mrgn">Add:</p>
                    </td>
                    <td width="15%" align="right"></td>
                    <td width="15%" align="right"></td>
                </tr>
                <?php
                    $taxType=$billDataArr['taxType'];
                    
                    $cgstAmt=0;
                    $sgstAmt=0;
                    $igstAmt=0;
                    
                    if($taxType==1)
                    {
                        $cgstAmt=$billDataArr['cgstAmt'];
                        $sgstAmt=$billDataArr['sgstAmt'];
                        $igstAmt=0;
                    }
                    elseif($taxType==2)
                    {
                        $cgstAmt=0;
                        $sgstAmt=0;
                        $igstAmt=$billDataArr['igstAmt'];
                    }
                    
                    $totalBillAmt=(!empty($billDataArr['totalBillAmt'])) ? $billDataArr['totalBillAmt']:0;
                    
                    $taxAmt=$cgstAmt+$sgstAmt+$igstAmt;
                ?>
                <?php if($taxType==1): ?>
                <tr>
                    <td width="70%">
                        <p class="no_mrgn mrgnLeft30">CGST @ <?= (!empty($billDataArr['cgst'])) ? $billDataArr['cgst']:"0.00"; ?>%</p>
                    </td>
                    <td width="15%" align="right"><?= (!empty($cgstAmt)) ? amount_format($cgstAmt):"0.00"; ?></td>
                    <td width="15%" align="right"></td>
                </tr>
                <tr>
                    <td width="70%">
                        <p class="no_mrgn mrgnLeft30">SGST @ <?= (!empty($billDataArr['sgst'])) ? $billDataArr['sgst']:"0.00"; ?>%</p>
                    </td>
                    <td width="15%" align="right" style="<?= $bottomBorderStyle ?>">
                        <?= (!empty($sgstAmt)) ? amount_format($sgstAmt):"0.00"; ?>
                    </td>
                    <td width="15%" align="right"><?= (!empty($taxAmt)) ? amount_format($taxAmt):"0.00"; ?></td>
                </tr>
                <?php elseif($taxType==2): ?>
                <tr>
                    <td width="70%">
                        <p class="no_mrgn mrgnLeft30">IGST @ <?= (!empty($billDataArr['igst'])) ? $billDataArr['igst']:"0.00"; ?>%</p>
                    </td>
                    <td width="15%" align="right" style="<?= $bottomBorderStyle ?>">
                        <?= (!empty($igstAmt)) ? amount_format($igstAmt):"0.00"; ?>
                    </td>
                    <td width="15%" align="right"><?= (!empty($taxAmt)) ? amount_format($taxAmt):"0.00"; ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td width="70%">
                        <br>
                        <p class="no_mrgn">(Service Accounting Code : <?= (!empty($billDataArr['billServiceAccCode'])) ? $billDataArr['billServiceAccCode']:"N/A"; ?>)</p>
                    </td>
                    <td width="15%"></td>
                    <td width="15%"></td>
                </tr>
                <tr class="totalRow">
                    <td width="70%" align="right" style="<?= $totalRowStyle; ?>">
                        <h4 class="no_mrgn">TOTAL : <span class="rupeesSymbol">&#8377;</span> :</h4>
                    </td>
                    <td width="15%" align="right" style="<?= $totalRowStyle; ?>"></td>
                    <td width="15%" align="right" style="<?= $totalRowStyle; ?>">
                        <h4 class="no_mrgn"><?= amount_format($totalBillAmt); ?></h4>
                    </td>
                </tr>
                <!--
                <tr>
                    <td width="70%">
                        <p class="no_mrgn">Fees for Professional Services rendered as under :</p>
                        <br>
                        <br>
                        <h4 class="asstYr no_mrgn txtCenter">ASSESSMENT YEAR : 2022-2023</h4>
                        <h4 class="accYr no_mrgn txtCenter">ACCOUNTING YEAR : 2021-2022</h4>
                        <br>
                        <p>
                            1) Maintaining accounts in Tally & Preparing and finalising your Personal Balance sheet
                        </p>
                        <p>
                            2) Compiling & Filing of Income Tax Return for the above Assessment Year after prepartion of following statements :-<br>
                                a) Computation of Total Income & Tax thereon<br>
                                b) Savings Bank summaries<br>
                                c) Interest on Fixed Deposits with Bank<br>
                                d) Reconcilliation of 26AS and Annual Information Statement with accounts<br>
                                e) Advance Tax Working and payments<br>
                        </p>
                        <br>
                        <p class="no_mrgn">All the above charged in lump sum</p>
                        <br>
                        <p class="no_mrgn">Add:</p>
                        <p class="no_mrgn">CGST @ 9%</p>
                        <p class="no_mrgn">SGST @ 9%</p>
                        <br>
                        <p class="no_mrgn">(Service Accounting Code : 99822)</p>
                    </td>
                    <td width="15%"></td>
                    <td width="15%"></td>
                </tr>
                -->
            </tbody>
        </table>
        <table class="table-bordered">
            <tbody>
                <tr>
                    <td align="left" class="noBottomBorder">
                        <h4 class="moneyWords no_mrgn"><?= moneyInWords($totalBillAmt); ?></h4>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="noTopBorder">
                        <h4 class="no_mrgn">For <span class="firmHead"><?= (!empty($firmDetails['caFirmName'])) ? $firmDetails['caFirmName']:"N/A"; ?></span></h4>
                        <br>
                        <br>
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table-bordered">
            <tbody>
                <tr>
                    <td align="left">
                        <h4 class="no_mrgn">Notes :</h4>
                        <br>
                        <p class="no_mrgn">
                            <?= (!empty($billDataArr['billNote'])) ? nl2br($billDataArr['billNote']):"N/A"; ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>