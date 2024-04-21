<?php

namespace App\Controllers;

class Payroll extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath'] = "template/includes/css";
        $this->data['navPath'] = "template/includes/nav";
        $this->data['sidebarPath'] = "template/includes/sidebar";
        $this->data['footerPath'] = "template/includes/footer";
        $this->data['scriptPath'] = "template/includes/scripts";
        $this->data['layoutPath'] = "template/layouts/main_layout";

        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->MFirmSalaryParams = new \App\Models\MFirmSalaryParams();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr = $this->TableLib->get_tables();

        $this->user_tbl = $tableArr['user_tbl'];
        $this->firm_salary_parameters_tbl = $tableArr['firm_salary_parameters_tbl'];
        $this->staff_types = $tableArr['staff_types'];
        $this->salary_parameters_tbl = $tableArr['salary_parameters_tbl'];


        $this->section = "Payroll Salary Head";

        $currMth = date('n');

        $this->data['currMth'] = $currMth;
    }

    public function index()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Payroll";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = "Home";

        $this->data['navArr'] = $navArr;

        return view('firm_panel/payroll/home', $this->data);
    }


    public function salary_params()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Salary Parameters";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = "Home";

        $this->data['navArr'] = $navArr;

        $salPramCondtnArr['firm_salary_parameters_tbl.status'] = "1";
        $salPramOrderByArr['firm_salary_parameters_tbl.salaryParameter'] = "ASC";

        $query = $this->Mquery->getRecords($tableName = $this->firm_salary_parameters_tbl, $colNames = "firm_salary_parameters_tbl.salaryParameterId,
        CASE
                WHEN firm_salary_parameters_tbl.salaryParameterType=1 THEN 'Income'
                WHEN firm_salary_parameters_tbl.salaryParameterType=2 THEN 'Deductions'
                ELSE ''
            END AS ParameterType,
            CASE
            WHEN firm_salary_parameters_tbl.salaryParameterEffectBy=1 THEN 'Amount'
            WHEN firm_salary_parameters_tbl.salaryParameterEffectBy=2 THEN 'Percentage'
            ELSE ''
        END AS ParameterEffectBy,
        firm_salary_parameters_tbl.salaryParameter, firm_salary_parameters_tbl.salaryParameterType, firm_salary_parameters_tbl.salaryParameterEffectBy, firm_salary_parameters_tbl.salaryParameterAmount, firm_salary_parameters_tbl.salaryParameterPercentage, firm_salary_parameters_tbl.status, firm_salary_parameters_tbl.createdBy, firm_salary_parameters_tbl.createdDatetime, firm_salary_parameters_tbl.updatedBy, firm_salary_parameters_tbl.updatedDatetime", $salPramCondtnArr, $likeCondtnArr = array(), $salPramJoinArr = array(), $singleRow = FALSE, $salPramOrderByArr, $groupByArr = array(), $whereInArray = array(), $customWhereArray = array(), $orWhereArray = array(), $orWhereDataArr = array());

        $getFirmSalPramList = $query['userData'];

        $this->data['getFirmSalPramList'] = $getFirmSalPramList;

        return view('firm_panel/payroll/salaryParams', $this->data);
    }

    public function add_salary_params()
    {
        $salaryParameterId = $this->request->getPost('salaryParameterId');
        $salaryParameter = $this->request->getPost('salaryParameter');
        $salaryParameterType = $this->request->getPost('salaryParameterType');
        $salaryParameterEffectBy = $this->request->getPost('salaryParameterEffectBy');
        $salaryParameterAmount = $this->request->getPost('salaryParameterAmount');
        $salaryParameterPercentage = $this->request->getPost('salaryParameterPercentage');

        $inserType = "Added";
        $dataArray = [
            'salaryParameter' => $salaryParameter,
            'salaryParameterType' => $salaryParameterType,
            'salaryParameterEffectBy' => $salaryParameterEffectBy,
            'salaryParameterAmount' => $salaryParameterAmount,
            'salaryParameterPercentage' => $salaryParameterPercentage,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
        if ($salaryParameterId > 0) {
            $inserType = "Updated";
            $dataArray['salaryParameterId'] = $salaryParameterId;
        }
        if ($this->MFirmSalaryParams->save($dataArray)) {

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = $this->section . " " . $inserType;
            $insertLogArr['ip'] = $this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', $this->section . " has been " . $inserType . " successfully :)");
        } else {
            $this->session->setFlashdata('errorMsg', $this->section . " has not " . $inserType . " :(");
        }

        return redirect()->route('salary-params');
    }

    public function edit_salary_params()
    {
        $salaryParameterId = $this->request->getPost('salaryParameterId');
        $salaryParameter = $this->request->getPost('salaryParameter');
        $salaryParameterType = $this->request->getPost('salaryParameterType');
        $salaryParameterEffectBy = $this->request->getPost('salaryParameterEffectBy');
        $salaryParameterAmount = $this->request->getPost('salaryParameterAmount');
        $salaryParameterPercentage = $this->request->getPost('salaryParameterPercentage');

        $dataArray = [
            'salaryParameterId' => $salaryParameterId,
            'salaryParameter' => $salaryParameter,
            'salaryParameterType' => $salaryParameterType,
            'salaryParameterEffectBy' => $salaryParameterEffectBy,
            'salaryParameterAmount' => $salaryParameterAmount,
            'salaryParameterPercentage' => $salaryParameterPercentage,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        if ($this->MFirmSalaryParams->save($dataArray)) {

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = $this->section . " Updated";
            $insertLogArr['ip'] = $this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', $this->section . " has been updated successfully :)");
        } else {
            $this->session->setFlashdata('errorMsg', $this->section . " has not updated :(");
        }

        return redirect()->route('salary-params');
    }
    public function delete_salary_params()
    {
        $salaryParameterId = $this->request->getPost('salaryParameterId');

        $dataArray = [
            'salaryParameterId' => $salaryParameterId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        if ($this->MFirmSalaryParams->save($dataArray)) {

            $insertLogArr['section'] = $this->section;
            $insertLogArr['message'] = $this->section . " Deleted";
            $insertLogArr['ip'] = $this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', $this->section . " has been deleted successfully :)");
        } else {
            $this->session->setFlashdata('errorMsg', $this->section . " has not deleted :(");
        }
    }
}
