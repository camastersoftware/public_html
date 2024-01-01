<?php
namespace App\Controllers;

class Compliance extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Compliance";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->Muser = new \App\Models\Muser();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->MDueDateType = new \App\Models\MDueDateType();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->act_tbl=$tableArr['act_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->client_document_tbl=$tableArr['client_document_tbl'];
        $this->group_category_tbl=$tableArr['group_category_tbl'];
        $this->salutation_tbl=$tableArr['salutation_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
        $this->client_act_map_tbl=$tableArr['client_act_map_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->work_junior_map_tbl=$tableArr['work_junior_map_tbl'];
        
        $currMth=date('n');
        $this->currentMth=date('n');
        $this->currentYear=date('Y');
        
        $this->data['currMth']=$currMth;
        
        helper("cookie");
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Compliance Management";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/home', $this->data);
	}

    public function all_in_one_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="All-In-One : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/all_in_one_menus', $this->data);
    }
    
    public function inc_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/inc_menus', $this->data);
    }
    
    public function gst_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="GST : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/gst_menus', $this->data);
    }
    
    public function tds_tcs_menus_old()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS-TCS - Income Tax : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/tds_tcs_menus', $this->data);
    }
    
    public function tds_inc_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS - Income Tax : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/tds_inc_menus', $this->data);
    }
    
    public function tcs_inc_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TCS - Income Tax : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/tcs_inc_menus', $this->data);
    }
    
    public function tds_gst_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TDS - GST : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/tds_gst_menus', $this->data);
    }
    
    public function tcs_gst_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="TCS - GST : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/tcs_gst_menus', $this->data);
    }
    
    public function pt_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/pt_menus', $this->data);
    }
    
    public function pt_enrol_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Enrolment : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/pt_enrol_menus', $this->data);
    }
    
    public function pt_reg_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Profession Tax - Registration : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/pt_reg_menus', $this->data);
    }
    
    public function llp_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="LLP Act : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/llp_menus', $this->data);
    }
    
    public function oth_act_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Other Acts : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/oth_act_menus', $this->data);
    }
    
    public function co_op_soc_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Co-Op Society : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/co_op_soc_menus', $this->data);
    }
    
    public function trust_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Trust Act : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/trust_menus', $this->data);
    }
    
    public function shop_est_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Shops & Est. : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/shop_est_menus', $this->data);
    }
    
    public function msme_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="MSME : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/msme_menus', $this->data);
    }
    
    public function tm_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Trade Marks : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/tm_menus', $this->data);
    }
    
    public function labour_laws_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Labour Laws : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/labour_laws_menus', $this->data);
    }
    
    public function fema_menus()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="FEMA : Work Programme";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/fema_menus', $this->data);
    }
    
    public function search_inc_tax()
    {
        $ftr_type=$this->request->getPost('ftr_type');
        $selected_mth_tab=$this->request->getPost('selected_mth_tab');
        $ftr_clientgrp=$this->request->getPost('ftr_clientgrp');
        $ftr_client=$this->request->getPost('ftr_client');
        $ftr_costcenter=$this->request->getPost('ftr_costcenter');
        $ftr_junior=$this->request->getPost('ftr_junior');
        $ftr_staff=$this->request->getPost('ftr_staff');
        $ftr_ddf=$this->request->getPost('ftr_ddf');
        $ftr_period=$this->request->getPost('ftr_period');
        $ftr_ddm=$this->request->getPost('ftr_ddm');
        $ftr_e_verify=$this->request->getPost('ftr_e_verify');
        $ftr_set_by=$this->request->getPost('ftr_set_by');
        $ftr_billing=$this->request->getPost('ftr_billing');
        $ftr_receipt=$this->request->getPost('ftr_receipt');
        
        $cookieExpirationTime = time()+3600;
        
        if(!empty($selected_mth_tab))
            $this->setMyCookie('inc_tax_selected_mth_tab_cookie', $selected_mth_tab, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_selected_mth_tab_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_clientgrp))
            $this->setMyCookie('inc_tax_clientgrp_cookie', $ftr_clientgrp, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_clientgrp_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_client))
            $this->setMyCookie('inc_tax_client_cookie', $ftr_client, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_client_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_costcenter))
            $this->setMyCookie('inc_tax_costcenter_cookie', $ftr_costcenter, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_costcenter_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_junior))
            $this->setMyCookie('inc_tax_junior_cookie', $ftr_junior, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_junior_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_staff))
            $this->setMyCookie('inc_tax_staff_cookie', $ftr_staff, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_staff_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_ddf))
            $this->setMyCookie('inc_tax_ddf_cookie', $ftr_ddf, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_ddf_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_period))
            $this->setMyCookie('inc_tax_period_cookie', $ftr_period, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_period_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_ddm))
            $this->setMyCookie('inc_tax_ddm_cookie', $ftr_ddm, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_ddm_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_e_verify))
            $this->setMyCookie('inc_tax_e_verify_cookie', $ftr_e_verify, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_e_verify_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_set_by))
            $this->setMyCookie('inc_tax_set_by_cookie', $ftr_set_by, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_set_by_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_billing))
            $this->setMyCookie('inc_tax_billing_cookie', $ftr_billing, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_billing_cookie", '', $cookieExpirationTime);
            
        if(!empty($ftr_receipt))
            $this->setMyCookie('inc_tax_receipt_cookie', $ftr_receipt, $cookieExpirationTime);
        else
            $this->setMyCookie("inc_tax_receipt_cookie", '', $cookieExpirationTime);
            
        if($ftr_type==1)
            return redirect()->to(base_url('inc_tax_returns'));
        elseif($ftr_type==2)
            return redirect()->to(base_url('inc_tax_returns_filed'));
    }
    
    public function reset_inc_tax()
    {
        $cookieExpirationTime = time()+3600;
        
        $ftr_type=$this->request->getGet('ftr_type');
        
        $this->setMyCookie("inc_tax_selected_mth_tab_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_clientgrp_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_client_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_costcenter_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_junior_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_staff_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_ddf_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_period_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_ddm_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_e_verify_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_set_by_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_billing_cookie", '', $cookieExpirationTime);
        $this->setMyCookie("inc_tax_receipt_cookie", '', $cookieExpirationTime);
        
        if($ftr_type==1)
            return redirect()->to(base_url('inc_tax_returns'));
        elseif($ftr_type==2)
            return redirect()->to(base_url('inc_tax_returns_filed'));
    }
    
    public function inc_tax_returns()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        
        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $selected_mth_tab = (!empty(get_cookie("inc_tax_selected_mth_tab_cookie"))) ? get_cookie("inc_tax_selected_mth_tab_cookie") : "";
        $ftr_clientgrp = (!empty(get_cookie("inc_tax_clientgrp_cookie"))) ? get_cookie("inc_tax_clientgrp_cookie") : "";
        $ftr_client = (!empty(get_cookie("inc_tax_client_cookie"))) ? get_cookie("inc_tax_client_cookie") : "";
        $ftr_costcenter = (!empty(get_cookie("inc_tax_costcenter_cookie"))) ? get_cookie("inc_tax_costcenter_cookie") : "";
        $ftr_junior = (!empty(get_cookie("inc_tax_junior_cookie"))) ? get_cookie("inc_tax_junior_cookie") : "";
        $ftr_staff = (!empty(get_cookie("inc_tax_staff_cookie"))) ? get_cookie("inc_tax_staff_cookie") : "";
        $ftr_ddf = (!empty(get_cookie("inc_tax_ddf_cookie"))) ? get_cookie("inc_tax_ddf_cookie") : "";
        $ftr_period = (!empty(get_cookie("inc_tax_period_cookie"))) ? get_cookie("inc_tax_period_cookie") : "";
        $ftr_ddm = (!empty(get_cookie("inc_tax_ddm_cookie"))) ? get_cookie("inc_tax_ddm_cookie") : "";
        $ftr_e_verify = (!empty(get_cookie("inc_tax_e_verify_cookie"))) ? get_cookie("inc_tax_e_verify_cookie") : "";
        $ftr_set_by = (!empty(get_cookie("inc_tax_set_by_cookie"))) ? get_cookie("inc_tax_set_by_cookie") : "";
        $ftr_billing = (!empty(get_cookie("inc_tax_billing_cookie"))) ? get_cookie("inc_tax_billing_cookie") : "";
        $ftr_receipt = (!empty(get_cookie("inc_tax_receipt_cookie"))) ? get_cookie("inc_tax_receipt_cookie") : "";
        
        if(empty($selected_mth_tab))
        {
            $selected_mth_tab=strtolower(date('M', strtotime("2021-".$this->currentMth."-1"))).'_tab';
        }
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_costcenter))
            $workCondtnArr['user_tbl.userId']=$ftr_costcenter;
            
        if(!empty($ftr_junior))
            $workCondtnArr['work_junior_map_tbl.fkUserId']=$ftr_junior;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        if(!empty($ftr_ddf))
            $workCondtnArr['due_date_for_tbl.act_option_map_id']=$ftr_ddf;
        else
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
            
        if(!empty($ftr_period))
            $workCondtnArr['due_date_master_tbl.periodicity']=$ftr_period;
            
        if(!empty($ftr_ddm))
            $workCondtnArr["DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')"]=$ftr_ddm;
            
        $this->data['selected_mth_tab']=$selected_mth_tab;
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_costcenter']=$ftr_costcenter;
        $this->data['ftr_junior']=$ftr_junior;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_ddf']=$ftr_ddf;
        $this->data['ftr_period']=$ftr_period;
        $this->data['ftr_ddm']=$ftr_ddm;
        $this->data['ftr_e_verify']=$ftr_e_verify;
        $this->data['ftr_set_by']=$ftr_set_by;
        $this->data['ftr_billing']=$ftr_billing;
        $this->data['ftr_receipt']=$ftr_receipt;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        $workCustomWhereArray[]=" (work_tbl.eFillingDate IS NULL OR work_tbl.eFillingDate='' OR work_tbl.eFillingDate='0000-00-00' OR work_tbl.eFillingDate='1970-01-01')";
        
        if($ftr_e_verify==1)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate!='' AND work_tbl.verificationDate!='0000-00-00' AND work_tbl.verificationDate!='1970-01-01'";
        }
        elseif($ftr_e_verify==2)
        {
            $workCustomWhereArray[]=" (work_tbl.verificationDate='' OR work_tbl.verificationDate='0000-00-00' OR work_tbl.verificationDate='1970-01-01')";
        }
        
        if($ftr_set_by==1)
        {
            $workCondtnArr['work_tbl.set_prepared_by !=']='';
        }
        elseif($ftr_set_by==2)
        {
            $workCustomWhereArray[]="work_tbl.set_prepared_by=''";
        }
        
        if($ftr_billing==1)
        {
            $workCondtnArr['work_tbl.isBillingDone']='1';
        }
        elseif($ftr_billing==2)
        {
            // $workCondtnArr['work_tbl.isBillingDone !=']='1';
            $workCustomWhereArray[]=" (work_tbl.isBillingDone='' OR work_tbl.isBillingDone IS NULL OR work_tbl.isBillingDone='2')";
        }
        
        if($ftr_receipt==1)
        {
            $workCondtnArr['work_tbl.isReceiptDone']='1';
        }
        elseif($ftr_receipt==2)
        {
            // $workCondtnArr['work_tbl.isReceiptDone !=']='1';
            $workCustomWhereArray[]=" (work_tbl.isReceiptDone='' OR work_tbl.isReceiptDone IS NULL OR work_tbl.isReceiptDone='2')";
        }
        
        if($ftr_e_verify==2 || $ftr_set_by==2 || $ftr_billing==2 || $ftr_receipt==2)
        {
            $workCustomWhereArray[]="work_tbl.eFillingDate!='' AND work_tbl.eFillingDate!='0000-00-00' AND work_tbl.eFillingDate!='1970-01-01'";
        }
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('act_due_month', 'due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl." AS prepared_user_tbl", "condtn"=>"prepared_user_tbl.userId=work_tbl.set_prepared_by AND prepared_user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.isUrgentWork, work_tbl.juniors, work_tbl.isBillingDone, work_tbl.isReceiptDone, work_tbl.billNo, work_tbl.eFillingDate, work_tbl.billDate, work_tbl.billAmt, work_tbl.receiptDate, work_tbl.receiptAmt, work_tbl.billingComment, work_tbl.receiptComment, user_tbl.userShortName AS seniorName, work_tbl.workDone, work_tbl.verificationDate, work_tbl.set_prepared_by, work_tbl.workPriority, work_tbl.workPriorityColor, prepared_user_tbl.userShortName AS setPreparedShortName, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, org_type_tbl.shortName AS client_org_short_name", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $retMthArr=array();
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            $retMthArr = array_unique(array_column($workDataArr, 'act_due_month'));
            
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                // $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx['act_option_name1'];
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['retMthArr']=$retMthArr;
        $this->data['mthDataArr']=$mthDataArr;
        $this->data['mthDDFArr']=$mthDDFArr;
        $this->data['mthDDFDueDateArr']=$mthDDFDueDateArr;
        $this->data['mthDDFDueDateForClientArr']=$mthDDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->orderBy('client_group_tbl.client_group', 'ASC')
                        ->findAll();

        $this->data['groupList']=$groupList;
        
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;
        
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userFullName']="ASC";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        $ddfCondtnArr['act_option_map_tbl.status']="1";
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="1";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        return view('firm_panel/compliance/inc_tax_returns', $this->data);
    }
    
    public function inc_tax_returns_filed()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $cssArr=array('tooltip');
        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        
        $this->data['cssArr']=$cssArr;
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $selected_mth_tab = (!empty(get_cookie("inc_tax_selected_mth_tab_cookie"))) ? get_cookie("inc_tax_selected_mth_tab_cookie") : "";
        $ftr_clientgrp = (!empty(get_cookie("inc_tax_clientgrp_cookie"))) ? get_cookie("inc_tax_clientgrp_cookie") : "";
        $ftr_client = (!empty(get_cookie("inc_tax_client_cookie"))) ? get_cookie("inc_tax_client_cookie") : "";
        $ftr_costcenter = (!empty(get_cookie("inc_tax_costcenter_cookie"))) ? get_cookie("inc_tax_costcenter_cookie") : "";
        $ftr_junior = (!empty(get_cookie("inc_tax_junior_cookie"))) ? get_cookie("inc_tax_junior_cookie") : "";
        $ftr_staff = (!empty(get_cookie("inc_tax_staff_cookie"))) ? get_cookie("inc_tax_staff_cookie") : "";
        $ftr_ddf = (!empty(get_cookie("inc_tax_ddf_cookie"))) ? get_cookie("inc_tax_ddf_cookie") : "";
        $ftr_period = (!empty(get_cookie("inc_tax_period_cookie"))) ? get_cookie("inc_tax_period_cookie") : "";
        $ftr_ddm = (!empty(get_cookie("inc_tax_ddm_cookie"))) ? get_cookie("inc_tax_ddm_cookie") : "";
        $ftr_e_verify = (!empty(get_cookie("inc_tax_e_verify_cookie"))) ? get_cookie("inc_tax_e_verify_cookie") : "";
        $ftr_set_by = (!empty(get_cookie("inc_tax_set_by_cookie"))) ? get_cookie("inc_tax_set_by_cookie") : "";
        $ftr_billing = (!empty(get_cookie("inc_tax_billing_cookie"))) ? get_cookie("inc_tax_billing_cookie") : "";
        $ftr_receipt = (!empty(get_cookie("inc_tax_receipt_cookie"))) ? get_cookie("inc_tax_receipt_cookie") : "";
        
        if(empty($selected_mth_tab))
        {
            $selected_mth_tab=strtolower(date('M', strtotime("2021-".$this->currentMth."-1"))).'_tab';
        }
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_costcenter))
            $workCondtnArr['user_tbl.userId']=$ftr_costcenter;
            
        if(!empty($ftr_junior))
            $workCondtnArr['work_junior_map_tbl.fkUserId']=$ftr_junior;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        if(!empty($ftr_ddf))
            $workCondtnArr['due_date_for_tbl.act_option_map_id']=$ftr_ddf;
        else
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
            
        if(!empty($ftr_period))
            $workCondtnArr['due_date_master_tbl.periodicity']=$ftr_period;
            
        if(!empty($ftr_ddm))
            $workCondtnArr["DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')"]=$ftr_ddm;
            
        $this->data['selected_mth_tab']=$selected_mth_tab;
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_costcenter']=$ftr_costcenter;
        $this->data['ftr_junior']=$ftr_junior;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_ddf']=$ftr_ddf;
        $this->data['ftr_period']=$ftr_period;
        $this->data['ftr_ddm']=$ftr_ddm;
        $this->data['ftr_e_verify']=$ftr_e_verify;
        $this->data['ftr_set_by']=$ftr_set_by;
        $this->data['ftr_billing']=$ftr_billing;
        $this->data['ftr_receipt']=$ftr_receipt;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        $workCondtnArr['work_tbl.eFillingDate != ']="";
        $workCondtnArr['work_tbl.eFillingDate != ']="0000-00-00";
        $workCondtnArr['work_tbl.eFillingDate !=']="1970-01-01";
        
        if($ftr_e_verify==1)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate!='' AND work_tbl.verificationDate!='0000-00-00' AND work_tbl.verificationDate!='1970-01-01'";
        }
        elseif($ftr_e_verify==2)
        {
            $workCustomWhereArray[]=" (work_tbl.verificationDate='' OR work_tbl.verificationDate='0000-00-00' OR work_tbl.verificationDate='1970-01-01')";
        }
        
        if($ftr_set_by==1)
        {
            $workCondtnArr['work_tbl.set_prepared_by !=']='';
        }
        elseif($ftr_set_by==2)
        {
            $workCustomWhereArray[]="work_tbl.set_prepared_by=''";
        }
        
        if($ftr_billing==1)
        {
            $workCondtnArr['work_tbl.isBillingDone']='1';
        }
        elseif($ftr_billing==2)
        {
            // $workCondtnArr['work_tbl.isBillingDone !=']='1';
            $workCustomWhereArray[]=" (work_tbl.isBillingDone='' OR work_tbl.isBillingDone IS NULL OR work_tbl.isBillingDone='2')";
        }
        
        if($ftr_receipt==1)
        {
            $workCondtnArr['work_tbl.isReceiptDone']='1';
        }
        elseif($ftr_receipt==2)
        {
            // $workCondtnArr['work_tbl.isReceiptDone !=']='1';
            $workCustomWhereArray[]=" (work_tbl.isReceiptDone='' OR work_tbl.isReceiptDone IS NULL OR work_tbl.isReceiptDone='2')";
        }
        
        if($ftr_e_verify==2 || $ftr_set_by==2 || $ftr_billing==2 || $ftr_receipt==2)
        {
            $workCustomWhereArray[]="work_tbl.eFillingDate!='' AND work_tbl.eFillingDate!='0000-00-00' AND work_tbl.eFillingDate!='1970-01-01'";
        }
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        
        $workGroupByArr=array('act_due_month', 'due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl." AS prepared_user_tbl", "condtn"=>"prepared_user_tbl.userId=work_tbl.set_prepared_by AND prepared_user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.isUrgentWork, work_tbl.juniors, work_tbl.isBillingDone, work_tbl.isReceiptDone, work_tbl.billNo, work_tbl.eFillingDate, work_tbl.billDate, work_tbl.billAmt, work_tbl.receiptDate, work_tbl.receiptAmt, work_tbl.billingComment, work_tbl.receiptComment, user_tbl.userShortName AS seniorName, work_tbl.workDone, work_tbl.verificationDate, work_tbl.set_prepared_by, work_tbl.workPriority, work_tbl.workPriorityColor, prepared_user_tbl.userShortName AS setPreparedShortName, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, org_type_tbl.shortName AS client_org_short_name", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $retMthArr=array();
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            $retMthArr = array_unique(array_column($workDataArr, 'act_due_month'));
            
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                // $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx['act_option_name1'];
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['retMthArr']=$retMthArr;
        $this->data['mthDataArr']=$mthDataArr;
        $this->data['mthDDFArr']=$mthDDFArr;
        $this->data['mthDDFDueDateArr']=$mthDDFDueDateArr;
        $this->data['mthDDFDueDateForClientArr']=$mthDDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->orderBy('client_group_tbl.client_group', 'ASC')
                        ->findAll();

        $this->data['groupList']=$groupList;
        
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;
        
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userFullName']="ASC";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        $ddfCondtnArr['act_option_map_tbl.status']="1";
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="1";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        return view('firm_panel/compliance/inc_tax_returns_filed', $this->data);
    }

    public function inc_tax_returns_bak_1()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        
        $ftr_clientgrp=$this->request->getPost('ftr_clientgrp');
        $ftr_client=$this->request->getPost('ftr_client');
        $ftr_costcenter=$this->request->getPost('ftr_costcenter');
        $ftr_staff=$this->request->getPost('ftr_staff');
        $ftr_ddf=$this->request->getPost('ftr_ddf');
        $ftr_period=$this->request->getPost('ftr_period');
        $ftr_ddm=$this->request->getPost('ftr_ddm');
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_costcenter))
            $workCondtnArr['user_tbl.userId']=$ftr_costcenter;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        if(!empty($ftr_ddf))
            $workCondtnArr['due_date_for_tbl.act_option_map_id']=$ftr_ddf;
        else
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
            
        if(!empty($ftr_period))
            $workCondtnArr['due_date_master_tbl.periodicity']=$ftr_period;
            
        if(!empty($ftr_ddm))
            $workCondtnArr["DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')"]=$ftr_ddm;
            
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_costcenter']=$ftr_costcenter;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_ddf']=$ftr_ddf;
        $this->data['ftr_period']=$ftr_period;
        $this->data['ftr_ddm']=$ftr_ddm;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workGroupByArr=array('client_tbl.clientBussOrganisationType', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $mthTaxPayArr=array();
        $mthTaxPayerArr=array();
        // $mthTaxPayerClientArr=array();
        // $mthTaxPayerClientDueDateArr=array();
        
        $mthTaxPayerDueDateArr=array();
        $mthTaxPayerDueDateClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $mthTaxPayArr[$e_tx['act_due_month']][$e_tx['orgType']]=$e_tx['orgType'];
                
                $mthTaxPayerArr[$e_tx['act_due_month']][$e_tx['orgType']]=$e_tx['act_option_name2'];
                
                // $mthTaxPayerClientArr[$e_tx['act_due_month']][$e_tx['tax_payer_id']][$e_tx['clientId']]=$e_tx;
                $mthTaxPayerDueDateArr[$e_tx['act_due_month']][$e_tx['orgType']][$e_tx['due_date_id']]=$e_tx;

                // $mthTaxPayerClientDueDateArr[$e_tx['act_due_month']][$e_tx['tax_payer_id']][$e_tx['clientId']][$e_tx['due_date_id']]=$e_tx;
                $mthTaxPayerDueDateClientArr[$e_tx['act_due_month']][$e_tx['orgType']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['mthTaxPayArr']=$mthTaxPayArr;
        $this->data['mthTaxPayerArr']=$mthTaxPayerArr;
        // $this->data['mthTaxPayerClientArr']=$mthTaxPayerClientArr;
        // $this->data['mthTaxPayerClientDueDateArr']=$mthTaxPayerClientDueDateArr;
        
        $this->data['mthTaxPayerDueDateArr']=$mthTaxPayerDueDateArr;
        $this->data['mthTaxPayerDueDateClientArr']=$mthTaxPayerDueDateClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->findAll();

        $this->data['groupList']=$groupList;
        
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;
        
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        $ddfCondtnArr['act_option_map_tbl.status']="1";
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="1";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        return view('firm_panel/compliance/inc_tax_returns', $this->data);
    }

    public function inc_tax_returns_bak()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        
        $ftr_clientgrp=$this->request->getPost('ftr_clientgrp');
        $ftr_client=$this->request->getPost('ftr_client');
        $ftr_costcenter=$this->request->getPost('ftr_costcenter');
        $ftr_staff=$this->request->getPost('ftr_staff');
        $ftr_ddf=$this->request->getPost('ftr_ddf');
        $ftr_period=$this->request->getPost('ftr_period');
        $ftr_ddm=$this->request->getPost('ftr_ddm');
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_costcenter))
            $workCondtnArr['user_tbl.userId']=$ftr_costcenter;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        if(!empty($ftr_ddf))
            $workCondtnArr['due_date_for_tbl.act_option_map_id']=$ftr_ddf;
        else
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
            
        if(!empty($ftr_period))
            $workCondtnArr['due_date_master_tbl.periodicity']=$ftr_period;
            
        if(!empty($ftr_ddm))
            $workCondtnArr["DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')"]=$ftr_ddm;
            
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_costcenter']=$ftr_costcenter;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_ddf']=$ftr_ddf;
        $this->data['ftr_period']=$ftr_period;
        $this->data['ftr_ddm']=$ftr_ddm;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";

        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $mthTaxPayArr=array();
        $mthTaxPayerArr=array();
        $mthTaxPayerClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $mthTaxPayArr[$e_tx['act_due_month']][$e_tx['tax_payer_id']]=$e_tx['tax_payer_id'];
                
                $mthTaxPayerArr[$e_tx['act_due_month']][$e_tx['tax_payer_id']]=$e_tx['act_option_name2'];
                
                $mthTaxPayerClientArr[$e_tx['act_due_month']][$e_tx['tax_payer_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['mthTaxPayArr']=$mthTaxPayArr;
        $this->data['mthTaxPayerArr']=$mthTaxPayerArr;
        $this->data['mthTaxPayerClientArr']=$mthTaxPayerClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->findAll();

        $this->data['groupList']=$groupList;
        
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;
        
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        $ddfCondtnArr['act_option_map_tbl.status']="1";
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="1";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        return view('firm_panel/compliance/inc_tax_returns', $this->data);
    }

    public function inc_tax_payments()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Tax Payments";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/inc_tax_payments', $this->data);
    }
    
    public function advance_tax()
    {
        ini_set('memory_limit', '-1');
        
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Advance Tax";
        $this->data['pageTitle']=$pageTitle;
        
        $ftr_allocated_to = "";
        
        if(!empty(get_cookie("adv_tax_allocated_to_cookie")))
        {
            $ftr_allocated_to=get_cookie("adv_tax_allocated_to_cookie");
        }
        
        $this->data['ftr_allocated_to']=$ftr_allocated_to;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->findAll();

        $this->data['groupList']=$groupList;

        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        if(!empty($ftr_allocated_to))
        {
            $workCondtnArr['work_tbl.pmtJuniorId']=$ftr_allocated_to;
        }
        
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        $workOrderByArr['client_group_tbl.client_group_id']="ASC";
        $workOrderByArr['client_tbl.clientId']="ASC";
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=array(101);

        $workGroupByArr=array('client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.pmtJuniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName, work_tbl.workDone, work_tbl.signature_date, work_tbl.remark, work_tbl.set_prepared_by, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, IF(client_tbl.clientBussOrganisationType = '9', client_tbl.clientName, client_tbl.clientBussOrganisation) as clientNameVal, work_tbl.pmtAmountSuggested, work_tbl.pmtJuniorId, work_tbl.pmtApproved, work_tbl.pmtNewAmt, work_tbl.amtApproved, work_tbl.amtPaid, work_tbl.pmtDate, work_tbl.pmtType, work_tbl.pmtRemark, work_tbl.isPmtActive", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName, user_tbl.userShortName, work_tbl.workDone, work_tbl.signature_date, work_tbl.remark, work_tbl.set_prepared_by, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_id, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, IF(client_tbl.clientBussOrganisationType = '9', client_tbl.clientName, client_tbl.clientBussOrganisation) as clientNameVal, work_tbl.pmtAmountSuggested, work_tbl.pmtJuniorId, work_tbl.pmtApproved, work_tbl.pmtNewAmt, work_tbl.amtApproved, work_tbl.amtPaid, work_tbl.pmtDate, work_tbl.pmtType, work_tbl.pmtRemark, work_tbl.isPmtActive", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $finYearVal = "N/A"; 
        $asmtYear="N/A";
        
        
        if(!empty($workDataArr))
        {
            $finYearVal=$workDataArr[0]['finYear'];
            
            $asmtYearVal=$finYearVal;
            
            $asmtYearArr = explode('-', $asmtYearVal);
            
            $fY=(int)$asmtYearArr[0]+1;
            $lY=(int)$asmtYearArr[1]+1;
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['finYearVal']=$finYearVal;
        $this->data['asmtYear']=$asmtYear;

        $clWkCondtnArr=array();
        $clWkWhereInArray=array();
        $clWkJoinArr=array();

        $prev2F=$fin_year_arr[0]-2;
        $prev2T=$fin_year_arr[1]-2;
        
        $prevTwoFinYear=$prev2F."-".$prev2T;

        $fromDate=date("Y-m-d", strtotime($prev2F."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$prev2T."-03-31"));

        $clWkCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $clWkCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        // $clWkCondtnArr['work_tbl.fkClientId']=$clientId;
        $clWkCondtnArr['work_tbl.status']="1";
        $clWkCondtnArr['due_date_master_tbl.status']=1;
        $clWkCondtnArr['due_date_for_tbl.status']=1;
        
        if(!empty($ftr_allocated_to))
        {
            // $clWkCondtnArr['work_tbl.pmtJuniorId']=$ftr_allocated_to;
        }
        
        $clWkWhereInArray['due_date_for_tbl.act_option_map_id']=array(101);

        $clWkGroupByArr=array('work_tbl.fkClientId');
        
        $clWkJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $clWkJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $clWkJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="SUM(work_tbl.amtPaid) AS sumTotalPaid, work_tbl.fkClientId", $clWkCondtnArr, $likeCondtnArr=array(), $clWkJoinArr, $singleRow=FALSE, $workOrderByArr=array(), $clWkGroupByArr, $clWkWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="SUM(CASE WHEN work_tbl.amtPaid = 0 THEN work_tbl.amtApproved WHEN work_tbl.amtPaid > 0 THEN work_tbl.amtPaid ELSE 0 END) AS sumTotalPaid, work_tbl.fkClientId", $clWkCondtnArr, $likeCondtnArr=array(), $clWkJoinArr, $singleRow=FALSE, $workOrderByArr=array(), $clWkGroupByArr, $clWkWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $prevTwoYrDataArr=$query['userData'];

        $prevTwoYr=array();

        if(!empty($prevTwoYrDataArr))
        {
            foreach($prevTwoYrDataArr AS $e_prev)
            {
                $prevTwoYr[$e_prev['fkClientId']]=$e_prev['sumTotalPaid'];
            }
        }

        $this->data['prevTwoYr']=$prevTwoYr;

        $clWkCondtnArr=array();
        $clWkWhereInArray=array();
        $clWkJoinArr=array();

        $prev1F=$fin_year_arr[0]-1;
        $prev1T=$fin_year_arr[1]-1;
        
        $prevOneFinYear=$prev1F."-".$prev1T;
        
        $fromDate=date("Y-m-d", strtotime($prev1F."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$prev1T."-03-31"));

        $clWkCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $clWkCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        // $clWkCondtnArr['work_tbl.fkClientId']=$clientId;
        $clWkCondtnArr['work_tbl.status']="1";
        $clWkCondtnArr['due_date_master_tbl.status']=1;
        $clWkCondtnArr['due_date_for_tbl.status']=1;
        
        if(!empty($ftr_allocated_to))
        {
            // $clWkCondtnArr['work_tbl.pmtJuniorId']=$ftr_allocated_to;
        }
        
        $clWkWhereInArray['due_date_for_tbl.act_option_map_id']=array(101);

        $clWkGroupByArr=array('work_tbl.fkClientId');
        
        $clWkJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $clWkJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $clWkJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="SUM(work_tbl.amtPaid) AS sumTotalPaid, work_tbl.fkClientId", $clWkCondtnArr, $likeCondtnArr=array(), $clWkJoinArr, $singleRow=FALSE, $workOrderByArr=array(), $clWkGroupByArr, $clWkWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="SUM(CASE WHEN work_tbl.amtPaid = 0 THEN work_tbl.amtApproved WHEN work_tbl.amtPaid > 0 THEN work_tbl.amtPaid ELSE 0 END) AS sumTotalPaid, work_tbl.fkClientId", $clWkCondtnArr, $likeCondtnArr=array(), $clWkJoinArr, $singleRow=FALSE, $workOrderByArr=array(), $clWkGroupByArr, $clWkWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $prevYrDataArr=$query['userData'];

        $prevYr=array();

        if(!empty($prevYrDataArr))
        {
            foreach($prevYrDataArr AS $e_prev)
            {
                $prevYr[$e_prev['fkClientId']]=$e_prev['sumTotalPaid'];
            }
        }

        $this->data['prevYr']=$prevYr;

        $clWkCondtnArr=array();
        $clWkWhereInArray=array();
        $clWkJoinArr=array();
        $clWkOrderByArr=array();

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $clWkCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $clWkCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;

        // $clWkCondtnArr['work_tbl.fkClientId']=$clientId;
        $clWkCondtnArr['work_tbl.status']="1";
        $clWkCondtnArr['due_date_master_tbl.status']=1;
        $clWkCondtnArr['due_date_for_tbl.status']=1;
        
        if(!empty($ftr_allocated_to))
        {
            $clWkCondtnArr['work_tbl.pmtJuniorId']=$ftr_allocated_to;
        }
        
        $clWkWhereInArray['due_date_for_tbl.act_option_map_id']=array(101);

        $clWkOrderByArr['work_tbl.fkClientId']="ASC";
        
        $clWkJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $clWkJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        $clWkJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames=", DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.f_period_month, work_tbl.amtApproved, work_tbl.amtPaid, work_tbl.fkClientId", $clWkCondtnArr, $likeCondtnArr=array(), $clWkJoinArr, $singleRow=FALSE, $clWkOrderByArr=array(), $clWkGroupByArr=array(), $clWkWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $currYrDataArr=$query['userData'];

        $currQtrOne=array();
        $currQtrTwo=array();
        $currQtrThree=array();
        $currQtrFour=array();
        $currQtr=array();

        if(!empty($currYrDataArr))
        {
            foreach($currYrDataArr AS $e_prev)
            {
                if($e_prev['f_period_month']>=4 && $e_prev['f_period_month']<=6)
                {
                    $currQtrOne[$e_prev['fkClientId']]['amtApproved']=$e_prev['amtApproved'];
                    $currQtrOne[$e_prev['fkClientId']]['amtPaid']=$e_prev['amtPaid'];
                }

                if($e_prev['f_period_month']>=7 && $e_prev['f_period_month']<=9)
                {
                    $currQtrTwo[$e_prev['fkClientId']]['amtApproved']=$e_prev['amtApproved'];
                    $currQtrTwo[$e_prev['fkClientId']]['amtPaid']=$e_prev['amtPaid'];
                }

                if($e_prev['f_period_month']>=10 && $e_prev['f_period_month']<=12)
                {
                    $currQtrThree[$e_prev['fkClientId']]['amtApproved']=$e_prev['amtApproved'];
                    $currQtrThree[$e_prev['fkClientId']]['amtPaid']=$e_prev['amtPaid'];
                }

                if($e_prev['f_period_month']>=1 && $e_prev['f_period_month']<=3)
                {
                    $currQtrFour[$e_prev['fkClientId']]['amtApproved']=$e_prev['amtApproved'];
                    $currQtrFour[$e_prev['fkClientId']]['amtPaid']=$e_prev['amtPaid'];
                }

                $currQtr[$e_prev['fkClientId']][]=$e_prev['amtPaid'];
            }
        }

        $this->data['currQtrOne']=$currQtrOne;
        $this->data['currQtrTwo']=$currQtrTwo;
        $this->data['currQtrThree']=$currQtrThree;
        $this->data['currQtrFour']=$currQtrFour;
        $this->data['currQtr']=$currQtr;
        
        $this->data['prevTwoFinYear']=$prevTwoFinYear;
        $this->data['prevOneFinYear']=$prevOneFinYear;
        
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        return view('firm_panel/compliance/advance_tax', $this->data);
    }
    
    public function search_advance_tax()
    {
        $ftr_allocated_to=$this->request->getPost('ftr_allocated_to');
        
        $cookieExpirationTime = time()+3600;
        
        if(!empty($ftr_allocated_to))
            $this->setMyCookie('adv_tax_allocated_to_cookie', $ftr_allocated_to, $cookieExpirationTime);
        else
            $this->setMyCookie("adv_tax_allocated_to_cookie", '', $cookieExpirationTime);
            
        return redirect()->to(base_url('advance_tax'));
    }
    
    public function reset_advance_tax()
    {
        $cookieExpirationTime = time()+3600;
        
        $this->setMyCookie("adv_tax_allocated_to_cookie", '', $cookieExpirationTime);
        
        return redirect()->to(base_url('advance_tax'));
    }
    
    function setMyCookie($name,$value,$time,$params = array()){
        if (empty($params)){
            $config = config('App');
    
            $params = array(
                'expires'   => $time,
                'path'      => $config->cookiePath,
                'domain'    => $config->cookieDomain,
                'secure'    => $config->cookieSecure,
                'httponly'  => $config->cookieHTTPOnly,
                'samesite'  => $config->cookieSameSite,
            );
        }
    
        setcookie($name,$value,$params);
    }

    public function inc_tax_audits()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Tax Audits";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $selected_mth_tab=$this->request->getPost('selected_mth_tab');
        $ftr_clientgrp=$this->request->getPost('ftr_clientgrp');
        $ftr_client=$this->request->getPost('ftr_client');
        $ftr_costcenter=$this->request->getPost('ftr_costcenter');
        $ftr_junior=$this->request->getPost('ftr_junior');
        $ftr_staff=$this->request->getPost('ftr_staff');
        $ftr_ddf=$this->request->getPost('ftr_ddf');
        $ftr_period=$this->request->getPost('ftr_period');
        $ftr_ddm=$this->request->getPost('ftr_ddm');
        $ftr_e_verify=$this->request->getPost('ftr_e_verify');
        $ftr_set_by=$this->request->getPost('ftr_set_by');
        $ftr_billing=$this->request->getPost('ftr_billing');
        $ftr_receipt=$this->request->getPost('ftr_receipt');
        
        if(empty($selected_mth_tab))
        {
            $selected_mth_tab=strtolower(date('M', strtotime("2021-".$this->currentMth."-1"))).'_tab';
        }
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_costcenter))
            $workCondtnArr['user_tbl.userId']=$ftr_costcenter;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        if(!empty($ftr_ddf))
            $workCondtnArr['due_date_for_tbl.act_option_map_id']=$ftr_ddf;
        else
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=array(2, 5);
            
        if(!empty($ftr_period))
            $workCondtnArr['due_date_master_tbl.periodicity']=$ftr_period;
            
        if(!empty($ftr_ddm))
            $workCondtnArr["DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')"]=$ftr_ddm;
            
        $this->data['selected_mth_tab']=$selected_mth_tab;
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_costcenter']=$ftr_costcenter;
        $this->data['ftr_junior']=$ftr_junior;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_ddf']=$ftr_ddf;
        $this->data['ftr_period']=$ftr_period;
        $this->data['ftr_ddm']=$ftr_ddm;
        $this->data['ftr_e_verify']=$ftr_e_verify;
        $this->data['ftr_set_by']=$ftr_set_by;
        $this->data['ftr_billing']=$ftr_billing;
        $this->data['ftr_receipt']=$ftr_receipt;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        $workCustomWhereArray[]=" (work_tbl.signature_date IS NULL OR work_tbl.signature_date='' OR work_tbl.signature_date='0000-00-00' OR work_tbl.signature_date='1970-01-01')";
        
        if($ftr_e_verify==1)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate!='' AND work_tbl.verificationDate!='0000-00-00' AND work_tbl.verificationDate!='1970-01-01'";
        }
        elseif($ftr_e_verify==2)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate='' OR work_tbl.verificationDate='0000-00-00' OR work_tbl.verificationDate='1970-01-01'";
        }
        
        if($ftr_set_by==1)
        {
            $workCondtnArr['work_tbl.set_prepared_by !=']='';
        }
        elseif($ftr_set_by==2)
        {
            $workCustomWhereArray[]="work_tbl.set_prepared_by=''";
        }
        
        if($ftr_billing==1)
        {
            $workCondtnArr['work_tbl.isBillingDone']='1';
        }
        elseif($ftr_billing==2)
        {
            $workCondtnArr['work_tbl.isBillingDone !=']='1';
        }
        
        if($ftr_receipt==1)
        {
            $workCondtnArr['work_tbl.isReceiptDone']='1';
        }
        elseif($ftr_receipt==2)
        {
            $workCondtnArr['work_tbl.isReceiptDone !=']='1';
        }
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workGroupByArr=array('act_due_month', 'due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl." AS prepared_user_tbl", "condtn"=>"prepared_user_tbl.userId=work_tbl.set_prepared_by AND prepared_user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.isUrgentWork, work_tbl.juniors, work_tbl.isBillingDone, work_tbl.isReceiptDone, work_tbl.billNo, work_tbl.eFillingDate, work_tbl.billDate, work_tbl.billAmt, work_tbl.receiptDate, work_tbl.receiptAmt, work_tbl.billingComment, work_tbl.receiptComment, user_tbl.userShortName AS seniorName, work_tbl.workDone, work_tbl.verificationDate, work_tbl.set_prepared_by, work_tbl.workPriority, work_tbl.workPriorityColor, prepared_user_tbl.userShortName AS setPreparedShortName, work_tbl.signature_date, work_tbl.auditCompletionDate, work_tbl.udinDate, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, org_type_tbl.shortName AS client_org_short_name", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $retMthArr=array();
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            $retMthArr = array_unique(array_column($workDataArr, 'act_due_month'));
            
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                // $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx['act_option_name1'];
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['retMthArr']=$retMthArr;
        $this->data['mthDataArr']=$mthDataArr;
        $this->data['mthDDFArr']=$mthDDFArr;
        $this->data['mthDDFDueDateArr']=$mthDDFDueDateArr;
        $this->data['mthDDFDueDateForClientArr']=$mthDDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->findAll();

        $this->data['groupList']=$groupList;
        
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;
        
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        $ddfCondtnArr['act_option_map_tbl.status']="1";
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="1";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=array(2, 5);
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        return view('firm_panel/compliance/inc_tax_audits', $this->data);
    }


    public function inc_tax_audits_filed()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Tax Audits";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        $workCustomWhereArray=array();
        
        $selected_mth_tab=$this->request->getPost('selected_mth_tab');
        $ftr_clientgrp=$this->request->getPost('ftr_clientgrp');
        $ftr_client=$this->request->getPost('ftr_client');
        $ftr_costcenter=$this->request->getPost('ftr_costcenter');
        $ftr_junior=$this->request->getPost('ftr_junior');
        $ftr_staff=$this->request->getPost('ftr_staff');
        $ftr_ddf=$this->request->getPost('ftr_ddf');
        $ftr_period=$this->request->getPost('ftr_period');
        $ftr_ddm=$this->request->getPost('ftr_ddm');
        $ftr_e_verify=$this->request->getPost('ftr_e_verify');
        $ftr_set_by=$this->request->getPost('ftr_set_by');
        $ftr_billing=$this->request->getPost('ftr_billing');
        $ftr_receipt=$this->request->getPost('ftr_receipt');
        
        if(empty($selected_mth_tab))
        {
            $selected_mth_tab=strtolower(date('M', strtotime("2021-".$this->currentMth."-1"))).'_tab';
        }
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_costcenter))
            $workCondtnArr['user_tbl.userId']=$ftr_costcenter;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        if(!empty($ftr_ddf))
            $workCondtnArr['due_date_for_tbl.act_option_map_id']=$ftr_ddf;
        else
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=array(2, 5);
            
        if(!empty($ftr_period))
            $workCondtnArr['due_date_master_tbl.periodicity']=$ftr_period;
            
        if(!empty($ftr_ddm))
            $workCondtnArr["DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')"]=$ftr_ddm;
            
        $this->data['selected_mth_tab']=$selected_mth_tab;
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_costcenter']=$ftr_costcenter;
        $this->data['ftr_junior']=$ftr_junior;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_ddf']=$ftr_ddf;
        $this->data['ftr_period']=$ftr_period;
        $this->data['ftr_ddm']=$ftr_ddm;
        $this->data['ftr_e_verify']=$ftr_e_verify;
        $this->data['ftr_set_by']=$ftr_set_by;
        $this->data['ftr_billing']=$ftr_billing;
        $this->data['ftr_receipt']=$ftr_receipt;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        $workCondtnArr['work_tbl.signature_date != ']="";
        $workCondtnArr['work_tbl.signature_date !=  ']="0000-00-00";
        $workCondtnArr['work_tbl.signature_date !=']="1970-01-01";
        
        if($ftr_e_verify==1)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate!='' AND work_tbl.verificationDate!='0000-00-00' AND work_tbl.verificationDate!='1970-01-01'";
        }
        elseif($ftr_e_verify==2)
        {
            $workCustomWhereArray[]="work_tbl.verificationDate='' OR work_tbl.verificationDate='0000-00-00' OR work_tbl.verificationDate='1970-01-01'";
        }
        
        if($ftr_set_by==1)
        {
            $workCondtnArr['work_tbl.set_prepared_by !=']='';
        }
        elseif($ftr_set_by==2)
        {
            $workCustomWhereArray[]="work_tbl.set_prepared_by=''";
        }
        
        if($ftr_billing==1)
        {
            $workCondtnArr['work_tbl.isBillingDone']='1';
        }
        elseif($ftr_billing==2)
        {
            $workCondtnArr['work_tbl.isBillingDone !=']='1';
        }
        
        if($ftr_receipt==1)
        {
            $workCondtnArr['work_tbl.isReceiptDone']='1';
        }
        elseif($ftr_receipt==2)
        {
            $workCondtnArr['work_tbl.isReceiptDone !=']='1';
        }
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workGroupByArr=array('act_due_month', 'due_date_master_tbl.due_date_for', 'due_date_master_tbl.due_date_id', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl." AS prepared_user_tbl", "condtn"=>"prepared_user_tbl.userId=work_tbl.set_prepared_by AND prepared_user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.isUrgentWork, work_tbl.juniors, work_tbl.isBillingDone, work_tbl.isReceiptDone, work_tbl.billNo, work_tbl.eFillingDate, work_tbl.billDate, work_tbl.billAmt, work_tbl.receiptDate, work_tbl.receiptAmt, work_tbl.billingComment, work_tbl.receiptComment, user_tbl.userShortName AS seniorName, work_tbl.workDone, work_tbl.verificationDate, work_tbl.set_prepared_by, work_tbl.workPriority, work_tbl.workPriorityColor, prepared_user_tbl.userShortName AS setPreparedShortName, work_tbl.signature_date, work_tbl.auditCompletionDate, work_tbl.udinDate, due_date_master_tbl.*, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, ext_due_date_master_tbl.extended_date, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, org_type_tbl.organisation_type_id AS client_org_id, org_type_tbl.organisation_type_name AS client_org_name, org_type_tbl.shortName AS client_org_short_name", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $retMthArr=array();
        $mthDataArr=array();
        $mthDDFArr=array();
        $mthDDFDueDateArr=array();
        $mthDDFDueDateForClientArr=array();
        
        if(!empty($workDataArr))
        {
            $retMthArr = array_unique(array_column($workDataArr, 'act_due_month'));
            
            foreach($workDataArr AS $e_tx)
            {
                $mthDataArr[$e_tx['act_due_month']]=$e_tx;
                
                // $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx['act_option_name1'];
                $mthDDFArr[$e_tx['act_due_month']][$e_tx['due_date_for']]=$e_tx;
                
                $mthDDFDueDateArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']]=$e_tx;
                
                $mthDDFDueDateForClientArr[$e_tx['act_due_month']][$e_tx['due_date_for']][$e_tx['due_date_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['retMthArr']=$retMthArr;
        $this->data['mthDataArr']=$mthDataArr;
        $this->data['mthDDFArr']=$mthDDFArr;
        $this->data['mthDDFDueDateArr']=$mthDDFDueDateArr;
        $this->data['mthDDFDueDateForClientArr']=$mthDDFDueDateForClientArr;
        
        $groupList=$this->Mgroup->where('client_group_tbl.status', 1)
                        ->findAll();

        $this->data['groupList']=$groupList;
        
        $clientCondtnArr['client_tbl.status']="1";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        
        $query=$this->Mquery->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];

        $this->data['getClientList']=$getClientList;
        
        $userCondtnArr['user_tbl.status']="1";
        $userOrderByArr['user_tbl.userSeq']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.isCostCenter", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;
        
        $ddfCondtnArr['act_option_map_tbl.status']="1";
        $ddfCondtnArr['act_option_map_tbl.fk_act_id']="1";
        $ddfCondtnArr['act_option_map_tbl.option_type']="1";
        $ddfOrderByArr['act_option_map_tbl.act_option_name']="ASC";
        
        $ddfWhereInArray['act_option_map_tbl.act_option_map_id']=array(2, 5);
        
        $query=$this->Mcommon->getRecords($tableName=$this->act_option_map_tbl, $colNames="act_option_map_tbl.act_option_map_id, act_option_map_tbl.act_option_name", $ddfCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $ddfOrderByArr, $groupByArr=array(), $ddfWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDateForList=$query['userData'];

        $this->data['dueDateForList']=$dueDateForList;
        
        $periodArr=$this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;

        return view('firm_panel/compliance/inc_tax_audits_filed', $this->data);
    }

    public function inc_tax_audits_bak()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - Audits";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        
        $ftr_clientgrp=$this->request->getPost('ftr_clientgrp');
        $ftr_client=$this->request->getPost('ftr_client');
        $ftr_costcenter=$this->request->getPost('ftr_costcenter');
        $ftr_staff=$this->request->getPost('ftr_staff');
        $ftr_ddf=$this->request->getPost('ftr_ddf');
        $ftr_period=$this->request->getPost('ftr_period');
        $ftr_ddm=$this->request->getPost('ftr_ddm');
        
        if(!empty($ftr_clientgrp))
            $workCondtnArr['client_tbl.clientGroup']=$ftr_clientgrp;
            
        if(!empty($ftr_client))
            $workCondtnArr['client_tbl.clientId']=$ftr_client;
            
        if(!empty($ftr_costcenter))
            $workCondtnArr['user_tbl.userId']=$ftr_costcenter;
            
        if(!empty($ftr_staff))
            $workCondtnArr['user_tbl.userId']=$ftr_staff;
            
        if(!empty($ftr_ddf))
            $workCondtnArr['due_date_for_tbl.act_option_map_id']=$ftr_ddf;
        else
            $workWhereInArray['due_date_for_tbl.act_option_map_id']=array(2, 5);
            
        if(!empty($ftr_period))
            $workCondtnArr['due_date_master_tbl.periodicity']=$ftr_period;
            
        if(!empty($ftr_ddm))
            $workCondtnArr["DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c')"]=$ftr_ddm;
            
        $this->data['ftr_clientgrp']=$ftr_clientgrp;
        $this->data['ftr_client']=$ftr_client;
        $this->data['ftr_costcenter']=$ftr_costcenter;
        $this->data['ftr_staff']=$ftr_staff;
        $this->data['ftr_ddf']=$ftr_ddf;
        $this->data['ftr_period']=$ftr_period;
        $this->data['ftr_ddm']=$ftr_ddm;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $workGroupByArr=array('client_tbl.clientBussOrganisationType', 'client_tbl.clientId');
        
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, work_tbl.signature_date, work_tbl.remark, work_tbl.set_prepared_by, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, work_tbl.signature_date, work_tbl.remark, work_tbl.set_prepared_by, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, organisation_type_tbl.organisation_type_id AS tax_payer_id, organisation_type_tbl.organisation_type_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr, $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $mthTaxPayArr=array();
        $mthTaxPayerArr=array();
        $mthTaxPayerClientArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $mthTaxPayArr[$e_tx['act_due_month']][$e_tx['tax_payer_id']]=$e_tx['tax_payer_id'];
                
                $mthTaxPayerArr[$e_tx['act_due_month']][$e_tx['tax_payer_id']]=$e_tx['act_option_name2'];
                
                $mthTaxPayerClientArr[$e_tx['act_due_month']][$e_tx['tax_payer_id']][$e_tx['clientId']]=$e_tx;
            }
        }
        
        $this->data['mthTaxPayArr']=$mthTaxPayArr;
        $this->data['mthTaxPayerArr']=$mthTaxPayerArr;
        $this->data['mthTaxPayerClientArr']=$mthTaxPayerClientArr;

        return view('firm_panel/compliance/inc_tax_audits', $this->data);
    }
    
    public function inc_tax_mis_menu()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - MIS";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('firm_panel/compliance/inc_tax_mis_menu', $this->data);
    }
    
    public function inc_tax_mis()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        ini_set('memory_limit', '-1');

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - MIS Report - Position of Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $asmtYear="N/A";
        if($this->currentMth>3)
        {
            $fY=$this->currentYear;
            $lY=substr($this->currentYear+1, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        else
        {
            $fY=$this->currentYear-1;
            $lY=substr($this->currentYear, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        $workCondtnArr['work_tbl.workId !=']='';
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['client_group_tbl.client_group_number']="ASC";
        $workOrderByArr['client_group_tbl.client_group']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>"group_category_tbl.group_category_id=client_group_tbl.client_group_category", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.eFillingDate, group_category_tbl.group_category_id, client_group_tbl.client_group_id, client_group_tbl.client_group_number, client_group_tbl.client_group, due_date_for_tbl.act_option_map_id, due_date_for_tbl.act_option_name, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $workIdArr=array();
        $dueDateForArr=array();
        $incRetDDFArr=array();
        
        if(!empty($workDataArr))
        {
            $workIdArr=array_unique(array_column($workDataArr, 'workId'));
            
            foreach($workDataArr AS $e_tx)
            {
                $dueDateForArr[$e_tx['act_option_map_id']]=$e_tx['act_option_name'];
                $cliDueDateForArr[$e_tx['act_option_map_id']][$e_tx['client_group_id']]=$e_tx;
                $incRetDDFArr[$e_tx['act_due_month']][$e_tx['act_option_map_id']][$e_tx['client_group_id']][$e_tx['workId']]=$e_tx;
            }
        }
        
        $this->data['dueDateForArr']=$dueDateForArr;
        $this->data['cliDueDateForArr']=$cliDueDateForArr;
        $this->data['incRetDDFArr']=$incRetDDFArr;
        
        $misAssignArr=array();
        $misFiledArr=array();
        
        if(!empty($workDataArr))
        {
            $cliDDFArr=array_unique(array_column($workDataArr, 'act_option_map_id'));
            $cliGrpWorkAssignArr=array_unique(array_column($workDataArr, 'client_group_id'));
            
            if(!empty($cliDDFArr))
            {
                foreach($cliDDFArr AS $e_wrk_asgn)
                {
                    for($m_no=1;$m_no<13;$m_no++)
                    {
                        if(isset($incRetDDFArr[$m_no][$e_wrk_asgn]))
                        {
                            if(!empty($cliGrpWorkAssignArr))
                            {
                                foreach($cliGrpWorkAssignArr AS $e_wrk_asgn_grp)
                                {
                                    if(isset($incRetDDFArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp]))
                                    {
                                        $incRetDDFArray=$incRetDDFArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp];
                                        
                                        if(!empty($incRetDDFArray))
                                        {
                                            $misAssignArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp]=count($incRetDDFArray);
                                            
                                            foreach($incRetDDFArray AS $e_wrk_file)
                                            {
                                                $eFillingDate=$e_wrk_file['eFillingDate'];
                                                
                                                if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                                {
                                                    $misFiledArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp][]=$eFillingDate;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $this->data['misAssignArr']=$misAssignArr;
        $this->data['misFiledArr']=$misFiledArr;
        
        $allotedWhereInArray=array();
        
        if(!empty($workIdArr))
            $allotedWhereInArray['work_tbl.workId']=$workIdArr;
        
        $allotedCondtnArr['client_group_tbl.status']=1;
        $allotedCondtnArr['client_tbl.status']=1;
        $allotedCondtnArr['work_tbl.status']=1;
        $allotedCondtnArr['work_junior_map_tbl.status']=1;
        
        $allotedJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientGroup=client_group_tbl.client_group_id AND client_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fkClientId=client_tbl.clientId AND work_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->user_tbl." AS jnr_user_tbl", "condtn"=>"jnr_user_tbl.userId=work_junior_map_tbl.fkUserId AND jnr_user_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_group_tbl, $colNames='client_group_tbl.client_group_id, client_tbl.clientId, work_tbl.seniorId, work_junior_map_tbl.fkUserId, user_tbl.userShortName AS seniorName, jnr_user_tbl.userShortName AS juniorName', $allotedCondtnArr, $likeCondtnArr=array(), $allotedJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $allotedWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $allotedList=$query['userData'];
        
        $clientJnrArray=array();
        $clientSnrArray=array();
        
        if(!empty($allotedList))
        {
            foreach($allotedList AS $e_allot)
            {
                if(!empty($e_allot['juniorName']))
                    $clientJnrArray[$e_allot['client_group_id']][$e_allot['fkUserId']]=$e_allot['juniorName'];
                    
                if(!empty($e_allot['seniorName']))
                    $clientSnrArray[$e_allot['client_group_id']][$e_allot['seniorId']]=$e_allot['seniorName'];
            }
        }
        
        $this->data['clientJnrArray']=$clientJnrArray;
        $this->data['clientSnrArray']=$clientSnrArray;
        
        return view('firm_panel/compliance/inc_tax_mis', $this->data);
    }
    
    public function inc_tax_mis_old()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        ini_set('memory_limit', '-1');

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - MIS Report - Position of Returns";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $asmtYear="N/A";
        if($this->currentMth>3)
        {
            $fY=$this->currentYear;
            $lY=substr($this->currentYear+1, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        else
        {
            $fY=$this->currentYear-1;
            $lY=substr($this->currentYear, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        $workCondtnArr['work_tbl.workId !=']='';
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['group_category_tbl.group_category_id']="ASC";
        $workOrderByArr['client_group_tbl.client_group_id']="ASC";
        
        // $workGroupByArr=array('client_group_tbl.client_group_category', 'client_tbl.clientGroup');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>"group_category_tbl.group_category_id=client_group_tbl.client_group_category", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.eFillingDate, group_category_tbl.group_category_id, client_group_tbl.client_group_id, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $incRetDDFArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $incRetDDFArr[$e_tx['act_due_month']][$e_tx['group_category_id']][$e_tx['client_group_id']][$e_tx['workId']]=$e_tx;
            }
        }
        
        $this->data['incRetDDFArr']=$incRetDDFArr;
        
        $misAssignArr=array();
        $misFiledArr=array();
        
        if(!empty($workDataArr))
        {
            $cliCatWorkAssignArr=array_unique(array_column($workDataArr, 'group_category_id'));
            $cliGrpWorkAssignArr=array_unique(array_column($workDataArr, 'client_group_id'));
            
            if(!empty($cliCatWorkAssignArr))
            {
                foreach($cliCatWorkAssignArr AS $e_wrk_asgn)
                {
                    for($m_no=1;$m_no<13;$m_no++)
                    {
                        if(isset($incRetDDFArr[$m_no][$e_wrk_asgn]))
                        {
                            if(!empty($cliGrpWorkAssignArr))
                            {
                                foreach($cliGrpWorkAssignArr AS $e_wrk_asgn_grp)
                                {
                                    if(isset($incRetDDFArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp]))
                                    {
                                        $incRetDDFArray=$incRetDDFArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp];
                                        
                                        if(!empty($incRetDDFArray))
                                        {
                                            $misAssignArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp]=count($incRetDDFArray);
                                            
                                            foreach($incRetDDFArray AS $e_wrk_file)
                                            {
                                                $eFillingDate=$e_wrk_file['eFillingDate'];
                                                
                                                if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                                {
                                                    $misFiledArr[$m_no][$e_wrk_asgn][$e_wrk_asgn_grp][]=$eFillingDate;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $this->data['misAssignArr']=$misAssignArr;
        $this->data['misFiledArr']=$misFiledArr;
        
        $groupCatList=$this->Mgroup_cat->where('group_category_tbl.status', 1)
            ->findAll();

        $this->data['groupCatList']=$groupCatList;
        
        $cliGrpCondtnArr['client_group_tbl.status']=1;
        $cliGrpOrderByArr['client_group_tbl.client_group_number']="ASC";
        // $cliGrpOrderByArr['client_group_tbl.client_group_id']="ASC";

        $query=$this->Mcommon->getRecords($tableName=$this->client_group_tbl, $colNames='client_group_tbl.*', $cliGrpCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $cliGrpOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $groupList=$query['userData'];
        
        $this->data['groupList']=$groupList;
        
        $allotedCondtnArr['client_group_tbl.status']=1;
        $allotedCondtnArr['client_tbl.status']=1;
        $allotedCondtnArr['work_tbl.status']=1;
        $allotedCondtnArr['work_junior_map_tbl.status']=1;
        
        $allotedJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientGroup=client_group_tbl.client_group_id AND client_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fkClientId=client_tbl.clientId AND work_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->user_tbl." AS jnr_user_tbl", "condtn"=>"jnr_user_tbl.userId=work_junior_map_tbl.fkUserId AND jnr_user_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_group_tbl, $colNames='client_group_tbl.client_group_id, client_tbl.clientId, work_tbl.seniorId, work_junior_map_tbl.fkUserId, user_tbl.userShortName AS seniorName, jnr_user_tbl.userShortName AS juniorName', $allotedCondtnArr, $likeCondtnArr=array(), $allotedJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $allotedList=$query['userData'];
        
        $clientJnrArray=array();
        $clientSnrArray=array();
        
        if(!empty($allotedList))
        {
            foreach($allotedList AS $e_allot)
            {
                if(!empty($e_allot['juniorName']))
                    $clientJnrArray[$e_allot['client_group_id']][$e_allot['fkUserId']]=$e_allot['juniorName'];
                    
                if(!empty($e_allot['seniorName']))
                    $clientSnrArray[$e_allot['client_group_id']][$e_allot['seniorId']]=$e_allot['seniorName'];
            }
        }
        
        $this->data['clientJnrArray']=$clientJnrArray;
        $this->data['clientSnrArray']=$clientSnrArray;
        
        $cliGrpArr=array();
        
        if(!empty($groupList))
        {
            foreach($groupList AS $e_cli_grp)
            {
                $cliGrpArr[$e_cli_grp['client_group_category']][]=$e_cli_grp;
            }
        }
        
        $this->data['cliGrpArr']=$cliGrpArr;

        return view('firm_panel/compliance/inc_tax_mis', $this->data);
    }
    
    public function inc_tax_mis_client()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        ini_set('memory_limit', '-1');
        
        $clientGroupId=$uri->getSegment(2);
        $ddfId=$uri->getSegment(3);
        $mth_nm_tab=$uri->getSegment(4);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Income Tax - MIS Report - Position of Returns(Client-Wise)";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        $this->data['mth_nm_tab']=$mth_nm_tab;
        
        $workWhereInArray=array();
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $asmtYear="N/A";
        if($this->currentMth>3)
        {
            $fY=$this->currentYear;
            $lY=substr($this->currentYear+1, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        else
        {
            $fY=$this->currentYear-1;
            $lY=substr($this->currentYear, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['client_group_tbl.client_group_id']=$clientGroupId;
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['group_category_tbl.group_category_id']="ASC";
        $workOrderByArr['client_group_tbl.client_group_id']="ASC";
        
        // $workGroupByArr=array('client_group_tbl.client_group_category', 'client_tbl.clientGroup');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1 AND due_date_for_tbl.act_option_map_id=".$ddfId, "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>"group_category_tbl.group_category_id=client_group_tbl.client_group_category", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.eFillingDate, group_category_tbl.group_category_id, client_group_tbl.client_group_id, client_tbl.clientId, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];
        
        // echo $query['query'];
        // print_r($workDataArr);
        // die();

        $this->data['workDataArr']=$workDataArr;
        
        $workIdArr=array();
        $incRetDDFArr=array();
        
        if(!empty($workDataArr))
        {
            $workIdArr=array_unique(array_column($workDataArr, 'workId'));
            
            foreach($workDataArr AS $e_tx)
            {
                $incRetDDFArr[$e_tx['act_due_month']][$e_tx['clientId']][$e_tx['workId']]=$e_tx;
            }
        }
        
        $this->data['incRetDDFArr']=$incRetDDFArr;
        
        $misAssignArr=array();
        $misFiledArr=array();
        
        if(!empty($workDataArr))
        {
            $cliWorkAssignArr=array_unique(array_column($workDataArr, 'clientId'));
            
            if(!empty($cliWorkAssignArr))
            {
                foreach($cliWorkAssignArr AS $e_wrk_asgn)
                {
                    for($m_no=1;$m_no<13;$m_no++)
                    {
                        if(isset($incRetDDFArr[$m_no][$e_wrk_asgn]))
                        {
                            $incRetDDFArray=$incRetDDFArr[$m_no][$e_wrk_asgn];
                            
                            if(!empty($incRetDDFArray))
                            {
                                $misAssignArr[$m_no][$e_wrk_asgn]=count($incRetDDFArray);
                                
                                foreach($incRetDDFArray AS $e_wrk_file)
                                {
                                    $eFillingDate=$e_wrk_file['eFillingDate'];
                                    
                                    if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                    {
                                        $misFiledArr[$m_no][$e_wrk_asgn][]=$eFillingDate;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $this->data['misAssignArr']=$misAssignArr;
        $this->data['misFiledArr']=$misFiledArr;
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.clientGroup']=$clientGroupId;

        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.clientBussIncorporationDate", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr=array(), $singleRow=FALSE, $clientOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $ctr=0;
        $clientReturnsArr=array();
        
        if(!empty($getClientList))
        {
            foreach($getClientList AS $k_client=>$e_client)
            {
                for($m_no=1;$m_no<13;$m_no++)
                {
                    if($e_client['orgType']==8)
                    {
                        if(!empty($e_client['clientBussOrganisation']))
                            $clientName=$e_client['clientName']." (".$e_client['clientBussOrganisation'].")";
                        else
                            $clientName=$e_client['clientName'];
                    }
                    elseif($e_client['orgType']==9)
                        $clientName=$e_client['clientName'];
                    else
                        $clientName=$e_client['clientBussOrganisation'];
                        
                    $clientId=$e_client['clientId'];
                    
                    $assignCount=0;
                    if(isset($misAssignArr[$m_no][$clientId]))
                        $assignCount=$misAssignArr[$m_no][$clientId];
                    else
                        $assignCount=0;
                    
                    $filedCount=0;
                    if(isset($misFiledArr[$m_no][$clientId]))
                    {
                        $misFiledArray=$misFiledArr[$m_no][$clientId];
                        
                        if(!empty($misFiledArray))
                            $filedCount=count($misFiledArray);
                        else
                            $filedCount=0;
                    }
                    
                    $pendingCount=$assignCount-$filedCount;
                    
                    if($assignCount==0 && $assignCount==0 && $pendingCount==0)
                    {
                        continue;
                    }
                    else
                    {
                        $ctr++;
                        $clientReturnsArr[$m_no][$k_client]['sr']=$ctr;
                        $clientReturnsArr[$m_no][$k_client]['clientId']=$clientId;
                        $clientReturnsArr[$m_no][$k_client]['clientName']=$clientName;
                        $clientReturnsArr[$m_no][$k_client]['assignCount']=$assignCount;
                        $clientReturnsArr[$m_no][$k_client]['filedCount']=$filedCount;
                        $clientReturnsArr[$m_no][$k_client]['pendingCount']=$pendingCount;
                    }
                }
            }
        }
        
        // $clientReturnsArray=array();
        
        // if(!empty($clientReturnsArr))
        // {
        //     $clientReturnsArray = array_column($clientReturnsArr, 'clientName');

        //     array_multisort($clientReturnsArray, SORT_ASC, $clientReturnsArr);
        // }
        
        // print_r($clientReturnsArray);
        // die();
        
        $this->data['clientReturnsArr']=$clientReturnsArr;
        
        $allotedWhereInArray=array();
        
        if(!empty($workIdArr))
            $allotedWhereInArray['work_tbl.workId']=$workIdArr;
        
        $allotedCondtnArr['client_group_tbl.client_group_id']=$clientGroupId;
        $allotedCondtnArr['client_group_tbl.status']=1;
        $allotedCondtnArr['client_tbl.status']=1;
        $allotedCondtnArr['work_tbl.status']=1;
        $allotedCondtnArr['work_junior_map_tbl.status']=1;
        
        $allotedJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientGroup=client_group_tbl.client_group_id AND client_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->work_tbl, "condtn"=>"work_tbl.fkClientId=client_tbl.clientId AND work_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $allotedJoinArr[]=array("tbl"=>$this->user_tbl." AS jnr_user_tbl", "condtn"=>"jnr_user_tbl.userId=work_junior_map_tbl.fkUserId AND jnr_user_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_group_tbl, $colNames='client_group_tbl.client_group_id, client_tbl.clientId, work_tbl.seniorId, work_junior_map_tbl.fkUserId, user_tbl.userShortName AS seniorName, jnr_user_tbl.userShortName AS juniorName', $allotedCondtnArr, $likeCondtnArr=array(), $allotedJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $allotedWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $allotedList=$query['userData'];
        
        $clientJnrArray=array();
        $clientSnrArray=array();
        
        if(!empty($allotedList))
        {
            foreach($allotedList AS $e_allot)
            {
                if(!empty($e_allot['juniorName']))
                    $clientJnrArray[$e_allot['clientId']][$e_allot['fkUserId']]=$e_allot['juniorName'];
                    
                if(!empty($e_allot['seniorName']))
                    $clientSnrArray[$e_allot['clientId']][$e_allot['seniorId']]=$e_allot['seniorName'];
            }
        }
        
        $this->data['clientJnrArray']=$clientJnrArray;
        $this->data['clientSnrArray']=$clientSnrArray;
        
        $ddfCond["act_option_map_id"]=$ddfId;
        $ddfCond["status"]=1;
        
        $dueDateForData=$this->Mact_option->where($ddfCond)->first();

        $this->data['dueDateForData']=$dueDateForData;
        
        return view('firm_panel/compliance/inc_tax_mis_client', $this->data);
    }
    
    public function inc_tax_mis_staff()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        ini_set('memory_limit', '-1');

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Staff-wise Position";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $workWhereInArray=array();
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $asmtYear="N/A";
        if($this->currentMth>3)
        {
            $fY=$this->currentYear;
            $lY=substr($this->currentYear+1, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        else
        {
            $fY=$this->currentYear-1;
            $lY=substr($this->currentYear, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        $workCondtnArr['work_tbl.workId !=']='';
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['group_category_tbl.group_category_id']="ASC";
        $workOrderByArr['client_group_tbl.client_group_id']="ASC";
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>"group_category_tbl.group_category_id=client_group_tbl.client_group_category", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.eFillingDate, group_category_tbl.group_category_id, client_group_tbl.client_group_id, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, work_tbl.seniorId, work_junior_map_tbl.fkUserId AS juniorId, user_tbl.userFullName, user_tbl.userShortName", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $incRetSeniorArr=array();
        $incRetJuniorArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                // $incRetSeniorArr[$e_tx['act_due_month']][$e_tx['seniorId']][$e_tx['workId']]=$e_tx;
                $incRetJuniorArr[$e_tx['act_due_month']][$e_tx['juniorId']][$e_tx['workId']]=$e_tx;
            }
        }
        
        $this->data['incRetSeniorArr']=$incRetSeniorArr;
        $this->data['incRetJuniorArr']=$incRetJuniorArr;
        
        $misSeniorAssignArr=array();
        $misSeniorFiledArr=array();
        
        $misJuniorAssignArr=array();
        $misJuniorFiledArr=array();
        
        $misAssignArray=array();
        $misFiledArray=array();
        
        if(!empty($workDataArr))
        {
            // $seniorWorkAssignArr=array_unique(array_column($workDataArr, 'seniorId'));
            $juniorWorkAssignArr=array_unique(array_column($workDataArr, 'juniorId'));
            
            $userWorkAssignArr=array();
            
            if(!empty($seniorWorkAssignArr) && !empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = array_unique(array_merge($seniorWorkAssignArr, $juniorWorkAssignArr));
            }
            elseif(!empty($seniorWorkAssignArr) && empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = $seniorWorkAssignArr;
            }
            elseif(empty($seniorWorkAssignArr) && !empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = $juniorWorkAssignArr;
            }
            
            for($m_no=1;$m_no<13;$m_no++)
            {
                if(!empty($seniorWorkAssignArr))
                {
                    foreach($seniorWorkAssignArr AS $e_snr)
                    {
                        if(isset($incRetSeniorArr[$m_no][$e_snr]))
                        {
                            $incRetSeniorArray=$incRetSeniorArr[$m_no][$e_snr];
                            
                            if(!empty($incRetSeniorArray))
                            {
                                $misSeniorAssignArr[$m_no][$e_snr]=count($incRetSeniorArray);
                                
                                foreach($incRetSeniorArray AS $e_wrk_file)
                                {
                                    $eFillingDate=$e_wrk_file['eFillingDate'];
                                    
                                    if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                    {
                                        $misSeniorFiledArr[$m_no][$e_snr][]=$eFillingDate;
                                    }
                                }
                            }
                        }
                    }
                }
                
                if(!empty($juniorWorkAssignArr))
                {
                    foreach($juniorWorkAssignArr AS $e_jnr)
                    {
                        if(isset($incRetJuniorArr[$m_no][$e_jnr]))
                        {
                            $incRetJuniorArray=$incRetJuniorArr[$m_no][$e_jnr];
                            
                            if(!empty($incRetJuniorArray))
                            {
                                $misJuniorAssignArr[$m_no][$e_jnr]=count($incRetJuniorArray);
                                
                                foreach($incRetJuniorArray AS $e_wrk_file)
                                {
                                    $eFillingDate=$e_wrk_file['eFillingDate'];
                                    
                                    if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                    {
                                        $misJuniorFiledArr[$m_no][$e_jnr][]=$eFillingDate;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        for($m_no=1;$m_no<13;$m_no++)
        {
            if(!empty($userWorkAssignArr))
            {
                foreach($userWorkAssignArr AS $e_usr)
                {
                    $misSeniorAssignArray=array();
                    $misJuniorAssignArray=array();
                    
                    if(isset($misSeniorAssignArr[$m_no][$e_usr]))
                    {
                        $misSeniorAssignArray=$misSeniorAssignArr[$m_no][$e_usr];
                    }
                    
                    if(isset($misJuniorAssignArr[$m_no][$e_usr]))
                    {
                        $misJuniorAssignArray=$misJuniorAssignArr[$m_no][$e_usr];
                    }
                    
                    if(!empty($misSeniorAssignArray) && !empty($misJuniorAssignArray))
                    {
                        $misAssignArray[$m_no][$e_usr] = $misSeniorAssignArray + $misJuniorAssignArray;
                    }
                    elseif(!empty($misSeniorAssignArray) && empty($misJuniorAssignArray))
                    {
                        $misAssignArray[$m_no][$e_usr] = $misSeniorAssignArray;
                    }
                    elseif(empty($misSeniorAssignArray) && !empty($misJuniorAssignArray))
                    {
                        $misAssignArray[$m_no][$e_usr] = $misJuniorAssignArray;
                    }
                    
                    $misSeniorFiledArray=array();
                    $misJuniorFiledArray=array();
                    
                    if(isset($misSeniorFiledArr[$m_no][$e_usr]))
                    {
                        $misSeniorFiledArray=count($misSeniorFiledArr[$m_no][$e_usr]);
                    }
                    
                    if(isset($misJuniorFiledArr[$m_no][$e_usr]))
                    {
                        $misJuniorFiledArray=count($misJuniorFiledArr[$m_no][$e_usr]);
                    }
                    
                    if(!empty($misSeniorFiledArray) && !empty($misJuniorFiledArray))
                    {
                        $misFiledArray[$m_no][$e_usr] = $misSeniorFiledArray + $misJuniorFiledArray;
                    }
                    elseif(!empty($misSeniorFiledArray) && empty($misJuniorFiledArray))
                    {
                        $misFiledArray[$m_no][$e_usr] = $misSeniorFiledArray;
                    }
                    elseif(empty($misSeniorFiledArray) && !empty($misJuniorFiledArray))
                    {
                        $misFiledArray[$m_no][$e_usr] = $misJuniorFiledArray;
                    }
                }
            }
        }
        
        $this->data['userWorkAssignArr']=$userWorkAssignArr;
        $this->data['misAssignArray']=$misAssignArray;
        $this->data['misFiledArray']=$misFiledArray;
        
        $userCondtnArr['user_tbl.status']=1;
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames='user_tbl.userId, user_tbl.userFullName, user_tbl.userShortName', $userCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userList=$query['userData'];
        
        $this->data['userList']=$userList;

        return view('firm_panel/compliance/inc_tax_mis_staff', $this->data);
    }
    
    public function inc_tax_mis_client_staff()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $retUserId=$uri->getSegment(2);
        $mth_nm_tab=$uri->getSegment(3);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Staff-wise Position(Client-wise)";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        $this->data['mth_nm_tab']=$mth_nm_tab;
        
        $workWhereInArray=array();
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $asmtYear="N/A";
        if($this->currentMth>3)
        {
            $fY=$this->currentYear;
            $lY=substr($this->currentYear+1, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        else
        {
            $fY=$this->currentYear-1;
            $lY=substr($this->currentYear, 2);
            
            $asmtYear=$fY."-".$lY;
        }
        
        $this->data['asmtYear']=$asmtYear;

        $fromDate=date("Y-m-d", strtotime($fin_year_arr[0]."-04-01"));
        $toDate=date("Y-m-d", strtotime("20".$fin_year_arr[1]."-03-31"));
        
        $workWhereInArray['due_date_for_tbl.act_option_map_id']=INC_RET_DDF_ARRAY;

        $workCondtnArr['ext_due_date_master_tbl.extended_date >=']=$fromDate;
        $workCondtnArr['ext_due_date_master_tbl.extended_date <=']=$toDate;
        
        $workCondtnArr['act_tbl.status']="1";
        $workCondtnArr['client_tbl.status']="1";
        // $workCondtnArr['client_tbl.clientStatus']="1";
        $workCondtnArr['work_tbl.status']="1";
        $workCondtnArr['due_date_master_tbl.status']=1;
        // $workCondtnArr['tax_payer_tbl.status']=1;
        $workCondtnArr['tax_payer_due_date_map_tbl.status']=1;
        $workCondtnArr['organisation_type_tbl.status']=1;
        $workCondtnArr['due_date_for_tbl.status']=1;
        $workCondtnArr['act_tbl.act_id']=1;
        
        $workOrderByArr['act_tbl.act_name']="ASC";
        $workOrderByArr['group_category_tbl.group_category_id']="ASC";
        $workOrderByArr['client_group_tbl.client_group_id']="ASC";
        
        $workCustomWhereArray[]="(work_tbl.seniorId='".$retUserId."' || work_junior_map_tbl.fkUserId='".$retUserId."')";
        
        // $workGroupByArr=array('client_group_tbl.client_group_category', 'client_tbl.clientGroup');
        
        $workJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"client_tbl.clientId=work_tbl.fkClientId", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->due_date_master_tbl, "condtn"=>"due_date_master_tbl.due_date_id=work_tbl.fk_due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=due_date_master_tbl.due_date_for AND due_date_for_tbl.option_type=1", "type"=>"left");
        // $workJoinArr[]=array("tbl"=>$this->act_option_map_tbl.' AS tax_payer_tbl', "condtn"=>"tax_payer_tbl.act_option_map_id=due_date_master_tbl.tax_payer", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->tax_payer_due_date_map_tbl, "condtn"=>"tax_payer_due_date_map_tbl.fk_due_date_id=due_date_master_tbl.due_date_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=tax_payer_due_date_map_tbl.fk_org_type_id", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->organisation_type_tbl.' AS org_type_tbl', "condtn"=>"org_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=due_date_master_tbl.due_act", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>"group_category_tbl.group_category_id=client_group_tbl.client_group_category", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->user_tbl, "condtn"=>"user_tbl.userId=work_tbl.seniorId AND user_tbl.status=1", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->ext_due_date_master_tbl, "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1 AND ext_due_date_master_tbl.is_extended=2", "type"=>"left");
        $workJoinArr[]=array("tbl"=>$this->work_junior_map_tbl, "condtn"=>"work_junior_map_tbl.fkWorkId=work_tbl.workId AND work_junior_map_tbl.status=1 AND work_junior_map_tbl.fkUserId='".$retUserId."'", "type"=>"left");
        
        // $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.workCode, work_tbl.fk_due_date_id, work_tbl.isDocRecvd, work_tbl.juniors, user_tbl.userFullName AS seniorName, work_tbl.workDone, due_date_master_tbl.*, DATE_FORMAT(due_date_master_tbl.due_date, '%c') AS act_due_month, due_date_master_tbl.due_date_id, act_tbl.act_name, due_date_for_tbl.act_option_name AS act_option_name1, tax_payer_tbl.act_option_map_id AS tax_payer_id, tax_payer_tbl.act_option_name AS act_option_name2, due_date_master_tbl.due_act, client_group_tbl.client_group_number, client_tbl.clientId, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $groupByArr=array(), $workWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.workId, work_tbl.eFillingDate, group_category_tbl.group_category_id, client_group_tbl.client_group_id, client_tbl.clientId, client_tbl.clientName, client_tbl.clientBussOrganisation, client_tbl.clientBussOrganisationType AS orgType, DATE_FORMAT(ext_due_date_master_tbl.extended_date, '%c') AS act_due_month, work_tbl.seniorId, work_junior_map_tbl.fkUserId AS juniorId, user_tbl.userFullName, user_tbl.userShortName", $workCondtnArr, $likeCondtnArr=array(), $workJoinArr, $singleRow=FALSE, $workOrderByArr, $workGroupByArr=array(), $workWhereInArray, $workCustomWhereArray, $orWhereArray=array(), $orWhereDataArr=array());
        
        $workDataArr=$query['userData'];

        $this->data['workDataArr']=$workDataArr;
        
        $incRetClientArr=array();
        $incRetSeniorArr=array();
        $incRetJuniorArr=array();
        
        if(!empty($workDataArr))
        {
            foreach($workDataArr AS $e_tx)
            {
                $incRetClientArr[$e_tx['clientId']]=$e_tx['clientId'];
                // $incRetSeniorArr[$e_tx['act_due_month']][$e_tx['seniorId']][$e_tx['clientId']][$e_tx['workId']]=$e_tx;
                
                if(!empty($e_tx['juniorId']))
                    $incRetJuniorArr[$e_tx['act_due_month']][$e_tx['juniorId']][$e_tx['clientId']][$e_tx['workId']]=$e_tx;
            }
        }
        
        $this->data['incRetSeniorArr']=$incRetSeniorArr;
        $this->data['incRetJuniorArr']=$incRetJuniorArr;
        
        $userWorkAssignArr=array();
        
        $misSeniorAssignArr=array();
        $misSeniorFiledArr=array();
        
        $misJuniorAssignArr=array();
        $misJuniorFiledArr=array();
        
        $misAssignArray=array();
        $misFiledArray=array();
        
        if(!empty($workDataArr))
        {
            // $seniorWorkAssignArr=array_unique(array_column($workDataArr, 'seniorId'));
            $juniorWorkAssignArr=array_unique(array_column($workDataArr, 'juniorId'));
            
            if(!empty($seniorWorkAssignArr) && !empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = array_unique(array_merge($seniorWorkAssignArr, $juniorWorkAssignArr));
            }
            elseif(!empty($seniorWorkAssignArr) && empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = $seniorWorkAssignArr;
            }
            elseif(empty($seniorWorkAssignArr) && !empty($juniorWorkAssignArr))
            {
                $userWorkAssignArr = $juniorWorkAssignArr;
            }
            
            for($m_no=1;$m_no<13;$m_no++)
            {
                if(!empty($seniorWorkAssignArr))
                {
                    foreach($seniorWorkAssignArr AS $e_snr)
                    {
                        if(!empty($incRetClientArr))
                        {
                            foreach($incRetClientArr AS $e_cli)
                            {
                                if(isset($incRetSeniorArr[$m_no][$e_snr][$e_cli]))
                                {
                                    $incRetSeniorArray=$incRetSeniorArr[$m_no][$e_snr][$e_cli];
                                    
                                    if(!empty($incRetSeniorArray))
                                    {
                                        $misSeniorAssignArr[$m_no][$e_snr][$e_cli]=count($incRetSeniorArray);
                                        
                                        foreach($incRetSeniorArray AS $e_wrk_file)
                                        {
                                            $eFillingDate=$e_wrk_file['eFillingDate'];
                                            
                                            if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                            {
                                                $misSeniorFiledArr[$m_no][$e_snr][$e_cli][]=$eFillingDate;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                
                if(!empty($juniorWorkAssignArr))
                {
                    foreach($juniorWorkAssignArr AS $e_jnr)
                    {
                        if(!empty($incRetClientArr))
                        {
                            foreach($incRetClientArr AS $e_cli)
                            {
                                if(isset($incRetJuniorArr[$m_no][$e_jnr][$e_cli]))
                                {
                                    $incRetJuniorArray=$incRetJuniorArr[$m_no][$e_jnr][$e_cli];
                                    
                                    if(!empty($incRetJuniorArray))
                                    {
                                        $misJuniorAssignArr[$m_no][$e_jnr][$e_cli]=count($incRetJuniorArray);
                                        
                                        foreach($incRetJuniorArray AS $e_wrk_file)
                                        {
                                            $eFillingDate=$e_wrk_file['eFillingDate'];
                                            
                                            if(!empty($eFillingDate) && $eFillingDate!="0000-00-00" && $eFillingDate!="1970-01-01")
                                            {
                                                $misJuniorFiledArr[$m_no][$e_jnr][$e_cli][]=$eFillingDate;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        for($m_no=1;$m_no<13;$m_no++)
        {
            if(!empty($userWorkAssignArr))
            {
                foreach($userWorkAssignArr AS $e_usr)
                {
                    if(!empty($incRetClientArr))
                    {
                        foreach($incRetClientArr AS $e_cli)
                        {
                            $misSeniorAssignArray=array();
                            $misJuniorAssignArray=array();
                            
                            if(isset($misSeniorAssignArr[$m_no][$e_usr][$e_cli]))
                            {
                                $misSeniorAssignArray=$misSeniorAssignArr[$m_no][$e_usr][$e_cli];
                            }
                            
                            if(isset($misJuniorAssignArr[$m_no][$e_usr][$e_cli]))
                            {
                                $misJuniorAssignArray=$misJuniorAssignArr[$m_no][$e_usr][$e_cli];
                            }
                            
                            if(!empty($misSeniorAssignArray) && !empty($misJuniorAssignArray))
                            {
                                $misAssignArray[$m_no][$e_cli] = $misSeniorAssignArray + $misJuniorAssignArray;
                            }
                            elseif(!empty($misSeniorAssignArray) && empty($misJuniorAssignArray))
                            {
                                $misAssignArray[$m_no][$e_cli] = $misSeniorAssignArray;
                            }
                            elseif(empty($misSeniorAssignArray) && !empty($misJuniorAssignArray))
                            {
                                $misAssignArray[$m_no][$e_cli] = $misJuniorAssignArray;
                            }
                            
                            $misSeniorFiledArray=array();
                            $misJuniorFiledArray=array();
                            
                            if(isset($misSeniorFiledArr[$m_no][$e_usr][$e_cli]))
                            {
                                $misSeniorFiledArray=count($misSeniorFiledArr[$m_no][$e_usr][$e_cli]);
                            }
                            
                            if(isset($misJuniorFiledArr[$m_no][$e_usr][$e_cli]))
                            {
                                $misJuniorFiledArray=count($misJuniorFiledArr[$m_no][$e_usr][$e_cli]);
                            }
                            
                            if(!empty($misSeniorFiledArray) && !empty($misJuniorFiledArray))
                            {
                                $misFiledArray[$m_no][$e_cli] = $misSeniorFiledArray + $misJuniorFiledArray;
                            }
                            elseif(!empty($misSeniorFiledArray) && empty($misJuniorFiledArray))
                            {
                                $misFiledArray[$m_no][$e_cli] = $misSeniorFiledArray;
                            }
                            elseif(empty($misSeniorFiledArray) && !empty($misJuniorFiledArray))
                            {
                                $misFiledArray[$m_no][$e_cli] = $misJuniorFiledArray;
                            }
                        }
                    }
                }
            }
        }
        
        $this->data['misAssignArray']=$misAssignArray;
        $this->data['misFiledArray']=$misFiledArray;
        
        $getClientList=array();
        
        if(!empty($incRetClientArr))
        {
            $clientCondtnArr['client_tbl.status']=1;
            $clientWhereInArray['client_tbl.clientId']=$incRetClientArr;
            
            $clientOrderByArr['client_group_tbl.client_group_number']='ASC';
            $clientOrderByArr['client_tbl.clientId']='ASC';
            
            $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_tbl.clientGroup=client_group_tbl.client_group_id AND client_tbl.status=1", "type"=>"left");
    
            $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_group_tbl.client_group_number", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $clientWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
            
            $getClientList=$query['userData'];
        }
        
        $this->data['getClientList']=$getClientList;
        
        $clientReturnsArr=array();
        
        if(!empty($getClientList))
        {
            foreach($getClientList AS $k_client=>$e_client)
            {
                for($m_no=1;$m_no<13;$m_no++)
                {
                    if($e_client['orgType']==8)
                        $clientName=$e_client['clientName']." (".$e_client['clientBussOrganisation'].")";
                    elseif($e_client['orgType']==9 || $e_client['orgType']==22 || $e_client['orgType']==23)
                        $clientName=$e_client['clientName'];
                    else
                        $clientName=$e_client['clientBussOrganisation'];
                        
                    $clientId=$e_client['clientId'];
                    $client_group_number=$e_client['client_group_number'];
                    
                    $assignCount=0;
                    if(isset($misAssignArray[$m_no][$clientId]))
                        $assignCount=$misAssignArray[$m_no][$clientId];
                    else
                        $assignCount=0;
                    
                    $filedCount=0;
                    if(isset($misFiledArray[$m_no][$clientId]))
                        $filedCount=$misFiledArray[$m_no][$clientId];
                    else
                        $filedCount=0;
                    
                    $pendingCount=$assignCount-$filedCount;
                    
                    $clientReturnsArr[$m_no][$k_client]['sr']=$k_client+1;
                    $clientReturnsArr[$m_no][$k_client]['clientId']=$clientId;
                    $clientReturnsArr[$m_no][$k_client]['client_group_number']=$client_group_number;
                    $clientReturnsArr[$m_no][$k_client]['clientName']=$clientName;
                    $clientReturnsArr[$m_no][$k_client]['assignCount']=$assignCount;
                    $clientReturnsArr[$m_no][$k_client]['filedCount']=$filedCount;
                    $clientReturnsArr[$m_no][$k_client]['pendingCount']=$pendingCount;
                }
            }
        }
        
        $this->data['clientReturnsArr']=$clientReturnsArr;
        
        $userCondtnArr['user_tbl.status']=1;
        $userCondtnArr['user_tbl.userId']=$retUserId;
        
        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames='user_tbl.userId, user_tbl.userFullName, user_tbl.userShortName', $userCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userDataArr=$query['userData'];
        
        $this->data['userDataArr']=$userDataArr;
        
        return view('firm_panel/compliance/inc_tax_mis_client_staff', $this->data);
    }
}