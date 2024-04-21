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
        $this->MsalaryParameter = new \App\Models\MsalaryParameter();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr = $this->TableLib->get_tables();

        $this->user_tbl = $tableArr['user_tbl'];
        $this->staff_types = $tableArr['staff_types'];
        $this->salary_parameters_tbl = $tableArr['salary_parameters_tbl'];


        $this->section = "Staff Management Payroll";

        $currMth = date('n');

        $this->data['currMth'] = $currMth;
    }

    public function index()
    {
        $uri = service('uri');
        $this->data['uri1'] = $uri1 = $uri->getSegment(1);

        $jsArr = array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr'] = $jsArr;

        $pageTitle = "Staff Management";
        $this->data['pageTitle'] = $pageTitle;

        $navArr = array();

        $navArr[0]['active'] = true;
        $navArr[0]['title'] = "Home";

        $this->data['navArr'] = $navArr;

        return view('firm_panel/payroll/home', $this->data);
    }

}
