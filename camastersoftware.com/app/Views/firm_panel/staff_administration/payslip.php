<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            align-content: center;
            font-family: sans-serif;
        }

        p {
            font-size: 14px;
        }

        table {
            width: 700px;
            margin-left: auto;
            margin-right: auto;
            height: auto;
            border-collapse: collapse;
        }

        .table-bordered>tbody>tr>td {
            border-width: 2px 2px 2px 2px;
            border-style: solid;
            border-color: #000000;
            border-collapse: collapse;
            padding: 0 !important;
            margin: 0 !important;
        }

        .table-bordered>tbody>tr>td {
            padding: 0px 3px 0px 3px !important;
        }

        .firmHead {
            text-transform: uppercase;
            margin-top: 1px;
            margin-bottom: 0px;
        }

        .no_mrgn {
            margin: 0px;
        }

        .caHead {
            margin: 0px;
        }

        .firmAddress {
            margin: 0px;
        }

        .firmContact {
            margin: 0px;
        }

        .firmEmail {
            margin: 0px;
        }

        .caGSTIN {
            margin: 0px;
        }

        .taxInvHead {
            margin: 0px;
        }

        .billNoDateTr td {
            padding-top: 5px !important;
        }

        .noRightBorder {
            border-right-style: none !important;
        }

        .noLeftBorder {
            border-left-style: none !important;
        }

        .noTopBorder {
            border-top-style: none !important;
        }

        .noBottomBorder {
            border-bottom-style: none !important;
        }

        .billNo {
            margin: 0px;
        }

        .billDate {
            margin: 0px;
        }

        .clientName {
            margin: 0px;
            text-decoration: underline;
        }

        .clientAddress {
            margin: 0px;
        }

        .clientEmail {
            margin: 0px;
        }

        .clientContact {
            margin: 0px;
        }

        .amtHead {
            margin: 0px;
            text-decoration: underline;
        }

        .asstYr {
            margin: 0px;
            text-decoration: underline;
        }

        .accYr {
            margin: 0px;
            text-decoration: underline;
        }

        .overLine {
            text-decoration: overline;
        }

        .underLine {
            text-decoration: underline;
        }

        .moneyWords {
            text-transform: capitalize;
        }

        .txtCenter {
            text-align: center !important;
        }

        .billDescTbl>tbody>tr>td {
            border-top-style: none !important;
            border-bottom-style: none !important;
        }

        .mrgnTop10 {
            margin-top: 10px;
        }

        .mrgnLeft30 {
            margin-left: 30px;
        }

        .rupeesSymbol {
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
    $caFirmGSTIN = $firmDetails['caFirmGSTIN'];
    ?>
    <table class="table-bordered">
        <tbody>
            <tr>
                <td align="center" colspan="2">
                    <h2 class="firmHead"><?= (!empty($firmDetails['caFirmName'])) ? $firmDetails['caFirmName'] : "N/A"; ?></h2>
                    <h4 class="caHead no_mrgn">CHARTERED ACCOUNTANTS</h4>
                    <p class="firmAddress no_mrgn"><?= (!empty($firmDetails['caFirmAddress'])) ? $firmDetails['caFirmAddress'] : "N/A"; ?></p>
                    <p class="firmContact no_mrgn">Phone No. : <?= (!empty($firmDetails['caFirmMobile'])) ? $firmDetails['caFirmMobile'] : "N/A"; ?></p>
                    <p class="firmEmail no_mrgn">E-Mail : <?= (!empty($firmDetails['caFirmEmail'])) ? $firmDetails['caFirmEmail'] : "N/A"; ?></p>
                    <?php if (!empty($caFirmGSTIN)) : ?>
                        <h4 class="caGSTIN no_mrgn">GSTIN : <?= $caFirmGSTIN; ?></h4>
                    <?php endif; ?>
                    <br>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <h4 class="taxInvHead no_mrgn">
                        &nbsp;
                    </h4>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <h4 class="taxInvHead no_mrgn">
                        PAYSLIP FOR THE MONTH OF
                    </h4>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <h4 class="taxInvHead no_mrgn">
                        &nbsp;
                    </h4>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <h4 class="taxInvHead no_mrgn">
                        DETAILS OF EMPLOYEE
                    </h4>
                </td>
            </tr>
            <tr class="billNoDateTr">
                <td align="left" class="noRightBorder">
                    <br>
                    <h4 class="billNo no_mrgn">Employee Name : </h4>
                </td>
                <td align="right" class="noLeftBorder">
                    <br>
                    <h4 class="billDate no_mrgn"></h4>
                </td>
            </tr>
            <tr class="billNoDateTr">
                <td align="left" class="noBottomBorder" width="50%">
                    <h4 class="moneyWords no_mrgn">Designation : </h4>
                </td>
                <td align="right" class="noBottomBorder" width="50%">
                    <h4 class="moneyWords no_mrgn">PAN Number : </h4>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <h4 class="taxInvHead no_mrgn">
                        DETAILS OF LEAVE
                    </h4>
                </td>
            </tr>
            <tr class="billNoDateTr">
                <td align="left" class="noBottomBorder" width="50%">
                    <h4 class="moneyWords no_mrgn">Days in Month : </h4>
                </td>
                <td align="right" class="noBottomBorder" width="50%">
                    <h4 class="moneyWords no_mrgn">Days Worked : </h4>
                </td>
            </tr>
          
        </tbody>
    </table>



    <table class="table-bordered ">
        <tbody>
            <tr>
                <td align="left" class="noBottomBorder">
                    <h4 class="moneyWords no_mrgn">EARNINGS</h4>
                </td>
                <td align="left" class="noBottomBorder" >
                    <h4 class="moneyWords no_mrgn">DEDUCTIONS</h4>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width:230px;">
                        <tbody>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Basic :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">H.R.A :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Conveyance :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Medical Reimbmnt :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td><br />
                                    <h4 class="moneyWords no_mrgn">Gross Salary :</h4><br />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td >
                    <table style="width:230px;">
                        <tbody>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Profession Tax :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Income Tax :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Others :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Total Deductions :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Net Salary :</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-bordered ">
        <tbody>
            <tr>
                <td align="left" class="noBottomBorder">
                    <h4 class="moneyWords no_mrgn">SIGNATURE</h4>
                </td>
                <td align="left" class="noBottomBorder">
                    <h4 class="moneyWords no_mrgn">DETAILS OF PAYMENT</h4>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width:230px;">
                        <tbody>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Authorised By :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Receiver's Signature :</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table style="width:230px;">
                        <tbody>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Bank/Cash/Online :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Cheque No. :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Date :</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="moneyWords no_mrgn">Chq Amount :</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table-bordered">
        <tbody>
            <tr>
                <td align="left">
                    <h4 class="no_mrgn">*Annual CTC : </h4>
                    <br>
                    <p class="no_mrgn">

                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>