<?php namespace App\Libraries;

class TableLib
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    
	public function get_tables()
	{
        $this->sessCaFirmId=$this->session->get('caFirmId');

        $superAdminDB=ADMIN_DB_NAME;
        $adminDB=FIRM_DB_NAME.$this->sessCaFirmId;

        //Super Admin
        $tableArr['admin_tbl']=$superAdminDB.".admin_tbl";
        $tableArr['ca_firm_tbl']=$superAdminDB.".ca_firm_tbl";
        $tableArr['cities']=$superAdminDB.".cities";
        $tableArr['client_document_tbl']=$superAdminDB.".client_document_tbl";
        $tableArr['group_category_tbl']=$superAdminDB.".group_category_tbl";
        $tableArr['payment_option_tbl']=$superAdminDB.".payment_option_tbl";
        $tableArr['profession_type_tbl']=$superAdminDB.".profession_type_tbl";
        $tableArr['states']=$superAdminDB.".states";
        $tableArr['salutation_tbl']=$superAdminDB.".salutation_tbl";
        $tableArr['organisation_type_tbl']=$superAdminDB.".organisation_type_tbl";
        $tableArr['act_tbl']=$superAdminDB.".act_tbl";
        $tableArr['staff_types']=$superAdminDB.".staff_types";
        $tableArr['act_option_map_tbl']=$superAdminDB.".act_option_map_tbl";
        $tableArr['periodicity_tbl']=$superAdminDB.".periodicity_tbl";
        $tableArr['due_date_master_tbl']=$superAdminDB.".due_date_master_tbl";
        $tableArr['ext_due_date_master_tbl']=$superAdminDB.".ext_due_date_master_tbl";
        $tableArr['error_reports_tbl']=$superAdminDB.".error_reports_tbl";
        $tableArr['tax_payer_due_date_map_tbl']=$superAdminDB.".tax_payer_due_date_map_tbl";
        $tableArr['demo_requests_tbl']=$superAdminDB.".demo_requests_tbl";
        $tableArr['data_bank_tbl']=$superAdminDB.".data_bank_tbl";
        $tableArr['feedback_tbl']=$superAdminDB.".feedback_tbl";
        $tableArr['return_type_tbl']=$superAdminDB.".return_type_tbl";
        $tableArr['challan_type_tbl']=$superAdminDB.".challan_type_tbl";
        $tableArr['payment_mode_tbl']=$superAdminDB.".payment_mode_tbl";
        $tableArr['gst_account_head_master_tbl']=$superAdminDB.".gst_account_head_master_tbl";
        $tableArr['referencer_groups']=$superAdminDB.".referencer_groups";
        $tableArr['referencer_sub_groups']=$superAdminDB.".referencer_sub_groups";
        $tableArr['bank_account_types']=$superAdminDB.".bank_account_types";
        $tableArr['digital_certificate_class_master_tbl']=$superAdminDB.".digital_certificate_class_master_tbl";
        $tableArr['gst_portal_list_tbl']=$superAdminDB.".gst_portal_list_tbl";
        $tableArr['notice_under_section_tbl']=$superAdminDB.".notice_under_section_tbl";
        $tableArr['act_order_type_master']=$superAdminDB.".act_order_type_master";
        $tableArr['deed_type_tbl']=$superAdminDB.".deed_type_tbl";
        $tableArr['form_number_tbl']=$superAdminDB.".form_number_tbl";
        $tableArr['salary_parameters_tbl']=$superAdminDB.".salary_parameters_tbl";
        $tableArr['cmpy_issue_type_tbl']=$superAdminDB.".cmpy_issue_type_tbl";
        $tableArr['verification_mode_tbl']=$superAdminDB.".verification_mode_tbl";
        $tableArr['due_date_type_tbl']=$superAdminDB.".due_date_type_tbl";
        $tableArr['due_date_for_group_tbl']=$superAdminDB.".due_date_for_group_tbl";
        $tableArr['due_date_for_group_map_tbl']=$superAdminDB.".due_date_for_group_map_tbl";
        $tableArr['menu_tbl']=$superAdminDB.".menu_tbl";
        $tableArr['sub_menu_tbl']=$superAdminDB.".sub_menu_tbl";
        $tableArr['sms_config']=$superAdminDB.".sms_config";
        $tableArr['otp_tbl']=$superAdminDB.".otp_tbl";
        $tableArr['user_category_tbl']=$superAdminDB.".user_category_tbl";

        //Admin
        $tableArr['client_act_map_tbl']=$adminDB.".client_act_map_tbl";
        $tableArr['client_document_map_tbl']=$adminDB.".client_document_map_tbl";
        $tableArr['client_group_tbl']=$adminDB.".client_group_tbl";
        $tableArr['client_tbl']=$adminDB.".client_tbl";
        $tableArr['holiday_tbl']=$adminDB.".holiday_tbl";
        $tableArr['user_tbl']=$adminDB.".user_tbl";
        $tableArr['work_tbl']=$adminDB.".work_tbl";
        $tableArr['work_junior_map_tbl']=$adminDB.".work_junior_map_tbl";
        $tableArr['hearing_tbl']=$adminDB.".hearing_tbl";
        $tableArr['level_tbl']=$adminDB.".level_tbl";
        $tableArr['client_partner_tbl']=$adminDB.".client_partner_tbl";
        $tableArr['reminder_tbl']=$adminDB.".reminder_tbl";
        $tableArr['cashbook_tbl']=$adminDB.".cashbook_tbl";
        $tableArr['to_do_list_tbl']=$adminDB.".to_do_list_tbl";
        $tableArr['announcement_tbl']=$adminDB.".announcement_tbl";
        $tableArr['rectification_tbl']=$adminDB.".rectification_tbl";
        $tableArr['tax_payment_tbl']=$adminDB.".tax_payment_tbl";
        $tableArr['gst_mth_tbl']=$adminDB.".gst_mth_tbl";
        $tableArr['gst_mth_sum_tbl']=$adminDB.".gst_mth_sum_tbl";
        $tableArr['config_tbl']=$adminDB.".config_tbl";
        $tableArr['firm_referencer_groups']=$adminDB.".referencer_groups";
        $tableArr['firm_referencer_sub_groups']=$adminDB.".referencer_sub_groups";
        $tableArr['clients_credetials_administration_tbl']=$adminDB.".clients_credetials_administration_tbl";
        $tableArr['general_password_tbl']=$adminDB.".general_password_tbl";
        $tableArr['refund_tbl']=$adminDB.".refund_tbl";
        $tableArr['demand_tbl']=$adminDB.".demand_tbl";
        $tableArr['rectification_hearing_tbl']=$adminDB.".rectification_hearing_tbl";
        $tableArr['scrutiny_notice_tbl']=$adminDB.".scrutiny_notice_tbl";
        $tableArr['scrutiny_notice_reply_tbl']=$adminDB.".scrutiny_notice_reply_tbl";
        $tableArr['appeal_tbl']=$adminDB.".appeal_tbl";
        $tableArr['appeal_notice_tbl']=$adminDB.".appeal_notice_tbl";
        $tableArr['appeal_notice_reply_tbl']=$adminDB.".appeal_notice_reply_tbl";
        $tableArr['order_analysis_tbl']=$adminDB.".order_analysis_tbl";
        $tableArr['order_analysis_tax_tbl']=$adminDB.".order_analysis_tax_tbl";
        $tableArr['order_analysis_expense_tbl']=$adminDB.".order_analysis_expense_tbl";
        $tableArr['trade_mark_tbl']=$adminDB.".trade_mark_tbl";
        $tableArr['firm_deed_tbl']=$adminDB.".firm_deed_tbl";
        $tableArr['firm_partner_tbl']=$adminDB.".firm_partner_tbl";
        $tableArr['employee_salary_division_tbl']=$adminDB.".employee_salary_division_tbl";
        $tableArr['employee_salary_tbl']=$adminDB.".employee_salary_tbl";
        $tableArr['employee_attendance_tbl']=$adminDB.".employee_attendance_tbl";
        $tableArr['cmpy_auth_cap_tbl']=$adminDB.".cmpy_auth_cap_tbl";
        $tableArr['cmpy_issue_paid_cap_tbl']=$adminDB.".cmpy_issue_paid_cap_tbl";
        $tableArr['cmpy_dividend_paid_tbl']=$adminDB.".cmpy_dividend_paid_tbl";
        $tableArr['cmpy_directors_tbl']=$adminDB.".cmpy_directors_tbl";
        $tableArr['cmpy_shareholder_tbl']=$adminDB.".cmpy_shareholder_tbl";
        $tableArr['bill_tbl']=$adminDB.".bill_tbl";
        $tableArr['bill_description_tbl']=$adminDB.".bill_description_tbl";
        $tableArr['user_chat_connection_tbl']=$adminDB.".user_chat_connection_tbl";
        $tableArr['user_message_tbl']=$adminDB.".user_message_tbl";
		$tableArr['chartered_accuntant_tbl']=$adminDB.".chartered_accuntant_tbl";
        $tableArr['articleship_staff_tbl']=$adminDB.".articleship_staff_tbl";
        $tableArr['expense_voucher_tbl']=$adminDB.".expense_voucher_tbl";
        $tableArr['articleship_leave_tbl']=$adminDB.".articleship_leave_tbl";
		$tableArr['non_regular_due_date_tbl']=$adminDB.".non_regular_due_date_tbl";
        $tableArr['non_regular_due_date_for_tbl']=$adminDB.".non_regular_due_date_for_tbl";
        
        return $tableArr;
	}
}
?>