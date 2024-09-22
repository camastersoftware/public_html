<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Website');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------Website----------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------------------------------------//
$routes->get('/', 'Website::index');
$routes->get('/software', 'Website::software');
$routes->get('/tax-calendar', 'Website::tax_calendar');
$routes->get('/faq', 'Website::faq');
$routes->get('/pricing', 'Website::pricing');
$routes->get('/contact', 'Website::contact');
$routes->get('/register-firm', 'Website::register');

//------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------Super Admin Panel-----------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------------------------------------//
$routes->match(['get', 'post'], '/superadmin/login', 'SuperAdmin/Login::index');
$routes->get('/superadmin/logout', 'SuperAdmin/Login::logout');

// $routes->get('/', 'Home::index');
$routes->get('/superadmin/home', 'SuperAdmin/Home::index');
$routes->post('/superadmin/switchDueDateYearSuperAdmin', 'SuperAdmin/Login::switchDueDateYearSuperAdmin');
$routes->get('/superadmin/firmList', 'SuperAdmin/Firm::index');
$routes->match(['get', 'post'], '/superadmin/add_firm', 'SuperAdmin/Firm::add_firm');
$routes->match(['get', 'post'], '/superadmin/edit_firm/(:any)', 'SuperAdmin\Firm::edit_firm/$1'); //--Done--//
$routes->post('/superadmin/approve_firm', 'SuperAdmin/Firm::approve_firm');
$routes->post('/superadmin/reject_firm', 'SuperAdmin/Firm::reject_firm');
$routes->post('/superadmin/delete_firm', 'SuperAdmin/Firm::delete_firm');
$routes->match(['get', 'post'], '/superadmin/register', 'SuperAdmin/Firm::register');
$routes->post('/register_firm', 'SuperAdmin/Firm::register_firm');

$routes->get('/superadmin/profession_types', 'SuperAdmin/ProfessionTypes::index');
$routes->post('/superadmin/add_profession', 'SuperAdmin/ProfessionTypes::add_profession');
$routes->post('/superadmin/edit_profession', 'SuperAdmin/ProfessionTypes::edit_profession');
$routes->post('/superadmin/delete_profession', 'SuperAdmin/ProfessionTypes::delete_profession');

$routes->get('/superadmin/payment_options', 'SuperAdmin/PaymentOption::index');
$routes->post('/superadmin/add_payment_option', 'SuperAdmin/PaymentOption::add_payment_option');
$routes->post('/superadmin/edit_payment_option', 'SuperAdmin/PaymentOption::edit_payment_option');
$routes->post('/superadmin/delete_payment_option', 'SuperAdmin/PaymentOption::delete_payment_option');

$routes->get('/superadmin/states', 'SuperAdmin/State::index');
$routes->post('/superadmin/add-state', 'SuperAdmin/State::add');
$routes->post('/superadmin/edit-state', 'SuperAdmin/State::edit');
$routes->post('/superadmin/delete-state', 'SuperAdmin/State::delete');

$routes->get('/superadmin/cities', 'SuperAdmin/City::index');
$routes->post('/superadmin/add-city', 'SuperAdmin/City::add');
$routes->post('/superadmin/edit-city', 'SuperAdmin/City::edit');
$routes->post('/superadmin/delete-city', 'SuperAdmin/City::delete');

$routes->get('/superadmin/group_categories', 'SuperAdmin/GroupCategory::index');
$routes->post('/superadmin/add_group_category', 'SuperAdmin/GroupCategory::add');
$routes->post('/superadmin/edit_group_category', 'SuperAdmin/GroupCategory::edit');
$routes->post('/superadmin/delete_group_category', 'SuperAdmin/GroupCategory::delete');

$routes->get('/superadmin/salutation', 'SuperAdmin/Salutation::index');
$routes->post('/superadmin/add_salutation', 'SuperAdmin/Salutation::add');
$routes->post('/superadmin/edit_salutation', 'SuperAdmin/Salutation::edit');
$routes->post('/superadmin/delete_salutation', 'SuperAdmin/Salutation::delete');

$routes->get('/superadmin/org_types', 'SuperAdmin/OrgTypes::index');
$routes->post('/superadmin/add_org_type', 'SuperAdmin/OrgTypes::add');
$routes->post('/superadmin/edit_org_type', 'SuperAdmin/OrgTypes::edit');
$routes->post('/superadmin/delete_org_type', 'SuperAdmin/OrgTypes::delete');

$routes->get('/superadmin/documents', 'SuperAdmin/Documents::index');
$routes->post('/superadmin/add_document', 'SuperAdmin/Documents::add');
$routes->post('/superadmin/edit_document', 'SuperAdmin/Documents::edit');
$routes->post('/superadmin/delete_document', 'SuperAdmin/Documents::delete');

$routes->get('/superadmin/acts', 'SuperAdmin/Act::index');
$routes->post('/superadmin/add_act', 'SuperAdmin/Act::add');
$routes->post('/superadmin/edit_act', 'SuperAdmin/Act::edit');
$routes->post('/superadmin/delete_act', 'SuperAdmin/Act::delete');
$routes->get('/superadmin/view_options-(:any)', 'SuperAdmin\Act::view_options/$1'); //--Done--//

$routes->get('/superadmin/act_options-(:any)-(:any)', 'SuperAdmin\ActOption::options/$1/$2'); //--Done--//
$routes->post('/superadmin/add_act_option', 'SuperAdmin/ActOption::add');
$routes->post('/superadmin/edit_act_option', 'SuperAdmin/ActOption::edit');
$routes->post('/superadmin/delete_act_option', 'SuperAdmin/ActOption::delete');

$routes->get('/superadmin/due_date_for_group-(:any)', 'SuperAdmin\ActOption::due_date_for_group/$1');
$routes->post('/superadmin/add_due_date_for_group', 'SuperAdmin/ActOption::add_due_date_for_group');
$routes->post('/superadmin/edit_due_date_for_group', 'SuperAdmin/ActOption::edit_due_date_for_group');
$routes->post('/superadmin/delete_due_date_for_group', 'SuperAdmin/ActOption::delete_due_date_for_group');

$routes->get('/superadmin/staff_types', 'SuperAdmin/StaffType::index');
$routes->post('/superadmin/add_staff_type', 'SuperAdmin/StaffType::add');
$routes->post('/superadmin/edit_staff_type', 'SuperAdmin/StaffType::edit');
$routes->post('/superadmin/delete_staff_type', 'SuperAdmin/StaffType::delete');

$routes->get('/superadmin/periodicity', 'SuperAdmin/Periodicity::index');
$routes->post('/superadmin/add_periodicity', 'SuperAdmin/Periodicity::add');
$routes->post('/superadmin/edit_periodicity', 'SuperAdmin/Periodicity::edit');
$routes->post('/superadmin/delete_periodicity', 'SuperAdmin/Periodicity::delete');

$routes->post('/remote/getCities', 'Remote/Sync::getCities');
$routes->post('/remote/getAreas', 'Remote/Sync::getAreas');
$routes->post('/getOptions', 'Remote/Extra::getOptions');
$routes->post('/getFirmOptions', 'Remote/Extra::getFirmOptions');

$routes->get('/superadmin/master_data', 'SuperAdmin/Main::master_data');
$routes->match(['get', 'post'], '/superadmin/tax_calendar', 'SuperAdmin/Main::tax_calendar');
$routes->get('/superadmin/date_wise_tax_calendar', 'SuperAdmin/Main::date_wise_tax_calendar');
$routes->post('/superadmin/search_tax_calendar', 'SuperAdmin/Main::search_tax_calendar');
$routes->get('/superadmin/reset_tax_calendar', 'SuperAdmin/Main::reset_tax_calendar');

$routes->get('/superadmin/add_due_date', 'SuperAdmin/Duedate::add_form');
$routes->post('/superadmin/insert_due_date', 'SuperAdmin/Duedate::insert_due_date');
// $routes->get('/superadmin/edit_due_date/(:any)', 'SuperAdmin/Duedate::edit_due_date/$1'); //----//
$routes->get('/superadmin/duedate/edit_due_date/(:any)', 'SuperAdmin\Duedate::edit_due_date/$1');
$routes->post('/superadmin/update_due_date', 'SuperAdmin/Duedate::update_due_date');
$routes->post('/superadmin/delete-due-date-doc-file', 'SuperAdmin/Duedate::delete_due_date_doc_file');
$routes->get('/superadmin/duedate/extend_due_date/(:any)', 'SuperAdmin\Duedate::extend_due_date/$1'); //----//
$routes->post('/superadmin/update_extend_due_date', 'SuperAdmin/Duedate::update_extend_due_date');
$routes->post('/superadmin/edit_extend_due_date', 'SuperAdmin/Duedate::edit_extend_due_date');
$routes->post('/superadmin/edit-doc-extend-due-date', 'SuperAdmin/Duedate::edit_doc_extend_due_date');
$routes->post('/superadmin/delete-ext-due-date-doc-file', 'SuperAdmin/Duedate::delete_ext_due_date_doc_file');
$routes->match(['get', 'post'], '/superadmin/due_dates_new', 'SuperAdmin/Duedate::due_dates_new');
$routes->match(['get', 'post'], '/superadmin/due_dates', 'SuperAdmin/Duedate::due_dates');
$routes->post('/superadmin/search_due_date', 'SuperAdmin/Duedate::search_due_date');
$routes->get('/superadmin/reset_due_date', 'SuperAdmin/Duedate::reset_due_date');
$routes->post('/superadmin/delete_due_date', 'SuperAdmin/Duedate::delete_due_date');
$routes->post('/superadmin/delete_ext_due_date', 'SuperAdmin/Duedate::delete_ext_due_date');
$routes->match(['get', 'post'], '/superadmin/extended-due-dates', 'SuperAdmin/Duedate::extended_due_dates');

$routes->get('/superadmin/getDateActs', 'SuperAdmin/Main::getDateActs');

$routes->get('/superadmin/error_reports', 'SuperAdmin\Error_report::index');
$routes->match(['get', 'post'], '/superadmin/add_error_report', 'SuperAdmin/Error_report::add_error_report');
$routes->post('/superadmin/not_satisfy', 'SuperAdmin/Error_report::not_satisfy');
$routes->post('/superadmin/delete_error_report', 'SuperAdmin/Error_report::delete_error_report');
$routes->match(['get', 'post'], '/superadmin/error_report/edit_error_report/(:any)', 'SuperAdmin\Error_report::edit_error_report/$1');
$routes->match(['get', 'post'], '/superadmin/error_report/reply_error_report/(:any)', 'SuperAdmin\Error_report::reply_error_report/$1');
$routes->get('/superadmin/error_report/view_error_report/(:any)', 'SuperAdmin\Error_report::view_error_report/$1');
$routes->post('/superadmin/delete-error-report-img-file', 'SuperAdmin/Error_report::delete_error_report_img_file');
// $routes->get('/dataBank', 'Component::dataBank');
// $routes->get('/subscribers', 'Component::subscribers');
$routes->get('/superadmin/feedbackReport', 'SuperAdmin/Component::feedbackReport');
$routes->get('/superadmin/feedbackView/(:num)', 'SuperAdmin\Component::feedbackView/$1'); //----//
$routes->post('/superadmin/deleteFeedback', 'SuperAdmin/Component::deleteFeedback');
// $routes->get('/referncer', 'Component::referncer');
// $routes->get('/demo_requests', 'Component::demo_requests');
// $routes->post('/replyDemo', 'Component::replyDemo');
// $routes->post('/deleteDemo', 'Component::deleteDemo');

$routes->get('/superadmin/dataBank', 'SuperAdmin/Databank::index');
$routes->post('/superadmin/dataBank/add', 'SuperAdmin/Databank::add');
$routes->post('/superadmin/dataBank/update', 'SuperAdmin/Databank::updateData');
$routes->post('/superadmin/dataBank/delete', 'SuperAdmin/Databank::deleteData');

$routes->get('/superadmin/demo_requests', 'SuperAdmin/Demo_request::index');
$routes->post('/superadmin/updateDemo', 'SuperAdmin/Demo_request::updateData');
$routes->post('/superadmin/replyDemo', 'SuperAdmin/Demo_request::replyDemo');
$routes->post('/superadmin/deleteDemo', 'SuperAdmin/Demo_request::deleteDemo');

$routes->get('/superadmin/referncer', 'SuperAdmin/Referncer::index');
$routes->post('/superadmin/addReferncer', 'SuperAdmin/Referncer::add');
$routes->post('/superadmin/updateReferncer', 'SuperAdmin/Referncer::updateData');
$routes->post('/superadmin/deleteReferncer', 'SuperAdmin/Referncer::deleteData');

$routes->get('/superadmin/refGroups', 'SuperAdmin/Referncer::refGroups');
$routes->post('/superadmin/addRefGroups', 'SuperAdmin/Referncer::addGroup');
$routes->post('/superadmin/editRefGroups', 'SuperAdmin/Referncer::editGroup');
$routes->post('/superadmin/deleteRefGroups', 'SuperAdmin/Referncer::deleteGroup');

$routes->get('/superadmin/refSubGroups', 'SuperAdmin/Referncer::refSubGroups');
$routes->post('/superadmin/addRefSubGroups', 'SuperAdmin/Referncer::addSubGroup');
$routes->post('/superadmin/editRefSubGroups', 'SuperAdmin/Referncer::editSubGroup');
$routes->post('/superadmin/deleteRefSubGroups', 'SuperAdmin/Referncer::deleteSubGroup');

$routes->get('/superadmin/subscribers', 'SuperAdmin/Subscribers::index');
$routes->match(['get', 'post'], '/superadmin/editSubscriber/(:any)', 'SuperAdmin\Subscribers::editSubscriber/$1'); //----//
$routes->get('/superadmin/viewSubscriber/(:any)', 'SuperAdmin\Subscribers::viewSubscriber/$1'); //----//
$routes->post('/superadmin/deleteSubscriber', 'SuperAdmin/Subscribers::deleteData');
$routes->post('/discontinueFirm', 'SuperAdmin/Subscribers::discontinueFirm');

$routes->get('/superadmin/menus', 'SuperAdmin/Menu::index');
$routes->post('/superadmin/addMenu', 'SuperAdmin/Menu::add');
$routes->post('/superadmin/updateMenu', 'SuperAdmin/Menu::updateData');
$routes->post('/superadmin/deleteMenu', 'SuperAdmin/Menu::deleteData');

$routes->get('/superadmin/submenus/(:any)', 'SuperAdmin\Submenu::home/$1'); //----//
$routes->post('/superadmin/addSubmenu', 'SuperAdmin/Submenu::add');
$routes->post('/superadmin/updateSubmenu', 'SuperAdmin/Submenu::updateData');
$routes->post('/superadmin/deleteSubmenu', 'SuperAdmin/Submenu::deleteData');

$routes->get('/superadmin/myAccountDetails', 'SuperAdmin/Home::myAccountDetails');
$routes->post('/superadmin/updateAccountDetails', 'SuperAdmin/Home::updateAccountDetails');

$routes->get('/superadmin/announcements', 'SuperAdmin/Announcement::index');
$routes->post('/superadmin/addAnnouncement', 'SuperAdmin/Announcement::add');
$routes->post('/superadmin/editAnnouncement', 'SuperAdmin/Announcement::updateData');
$routes->post('/superadmin/stopAnnouncement', 'SuperAdmin/Announcement::stopAnc');
$routes->post('/superadmin/activateAnc', 'SuperAdmin/Announcement::activateAnc');
$routes->post('/superadmin/deactivateAnc', 'SuperAdmin/Announcement::deactivateAnc');
$routes->post('/superadmin/deleteAnnouncement', 'SuperAdmin/Announcement::deleteAnc');

$routes->get('/superadmin/due-date-types', 'SuperAdmin\DueDateType::index');
$routes->post('/superadmin/add-due-date-type', 'SuperAdmin/DueDateType::add');
$routes->post('/superadmin/edit-due-date-type', 'SuperAdmin/DueDateType::edit');
$routes->post('/superadmin/delete-due-date-type', 'SuperAdmin/DueDateType::delete');

$routes->get('/superadmin/everyday_lab', 'SuperAdmin/EverydayLab::index');
$routes->post('/superadmin/add_everyday_lab', 'SuperAdmin/EverydayLab::addData');
$routes->post('/superadmin/edit_everyday_lab', 'SuperAdmin/EverydayLab::updateData');
$routes->post('/superadmin/delete_everyday_lab', 'SuperAdmin/EverydayLab::deleteData');



//------------------------------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------Admin Panel-------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------------------------------//
$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->get('/admin/home', 'Home::index');

$routes->get('/myWork', 'Home::myWork');
$routes->get('/groups', 'Group::index');
$routes->post('/getGroups', 'Remote/Admin::getGroups');
$routes->post('/add_client_group', 'Remote/Admin::add_client_group');
$routes->post('/edit_client_group', 'Remote/Admin::edit_client_group');
$routes->post('/delete_client_group', 'Remote/Admin::delete_client_group');
$routes->post('/getActForm', 'Remote/Admin::getActForm');
$routes->post('/search_due_date', 'Remote/Admin::search_due_date');
$routes->post('/delete_client_due_date', 'Remote/Admin::delete_client_due_date');
$routes->post('/delete_client_event_due_date', 'Remote/Admin::delete_client_event_due_date');
$routes->post('/set_cust_due_date', 'Remote/Admin::set_cust_due_date');
$routes->post('/edit_cust_due_date', 'Remote/Admin::edit_cust_due_date');

$routes->get('/masters-menu', 'Masters::index');
$routes->get('/clients', 'Client::index');
$routes->get('/create-client', 'Client::create_client');
$routes->post('/getClients', 'Remote/Admin::getClients');
$routes->post('/add_client', 'Remote/Admin::add_client');
$routes->post('/update_client', 'Remote/Admin::update_client');
// $routes->get('/admin/edit_client/(:any)', 'Client::edit_client/$1');
$routes->post('/getClientGroups', 'Remote/Admin::getClientGroups');
$routes->post('/add_remote_client_group', 'Remote/Admin::add_remote_client_group');
$routes->post('/delete_client', 'Remote/Admin::delete_client');
$routes->post('/mark_old_client', 'Remote/Admin::mark_old_client');
$routes->post('/restoreClient', 'Remote/Admin::restoreClient');

$routes->get('/users', 'User::index');
$routes->get('/create-user', 'User::create_user');
$routes->post('/getUsers', 'Remote/Admin::getUsers');
$routes->post('/add_user', 'Remote/Admin::add_user');
$routes->post('/update_user', 'Remote/Admin::update_user');
$routes->post('/delete_user', 'Remote/Admin::delete_user');
$routes->post('/mark_old_user', 'Remote/Staff::mark_old_user');
$routes->post('/restore_user', 'Remote/Staff::restore_user');
$routes->post('/delete-user-document-file', 'Remote/Admin::delete_user_document_file');

$routes->get('/master_data', 'MainPage::master_data');
$routes->get('/get_client_report', 'MainPage::getClientReport');
$routes->get('/getClientMonthWiseReport/(:any)', 'MainPage::getClientMonthWiseReport/$1');
$routes->get('/getClientActWiseReport/(:any)', 'MainPage::getClientActWiseReport/$1');
$routes->get('/mis-report-menu', 'MisReport::index');
$routes->get('/mis-report-section-menu', 'MisReport::section_menu');
$routes->get('/accountFinance', 'MainPage::accountFinance');
$routes->get('/tax_calendar_menu', 'MainPage::tax_calendar_menu');
// $routes->get('/act-wise-tax-calendar', 'MainPage::act_wise_tax_calendar');
$routes->match(['get', 'post'], '/act-wise-tax-calendar', 'MainPage::act_wise_tax_calendar');
$routes->match(['get', 'post'], '/act-wise-mth-tax-calendar', 'MainPage::act_wise_mth_tax_calendar');
$routes->match(['get', 'post'], '/act-wise-quarter-tax-calendar', 'MainPage::act_wise_quarter_tax_calendar');
$routes->match(['get', 'post'], '/act-wise-half-tax-calendar', 'MainPage::act_wise_half_tax_calendar');
$routes->match(['get', 'post'], '/act-wise-year-tax-calendar', 'MainPage::act_wise_year_tax_calendar');
$routes->match(['get', 'post'], '/due-date-yr-summary-tax-calendar', 'MainPage::due_date_yr_summary_tax_calendar');
$routes->match(['get', 'post'], '/tax_calendar', 'MainPage::tax_calendar');
$routes->match(['get', 'post'], '/mth_tax_calendar', 'MainPage::mth_tax_calendar');
$routes->get('/date_wise_tax_calendar', 'MainPage::date_wise_tax_calendar');
$routes->post('/search_tax_calendar', 'MainPage::search_tax_calendar');
$routes->get('/reset_tax_calendar', 'MainPage::reset_tax_calendar');
$routes->get('/getDateActs', 'MainPage::getDateActs');
$routes->get('/getMasterClientData', 'MainPage::getMasterClientData');
$routes->get('/getMasterOldClientData', 'MainPage::getMasterOldClientData');
$routes->get('/getMasterStaffData', 'MainPage::getMasterStaffData');
$routes->get('/getMasterOldStaffData', 'MainPage::getMasterOldStaffData');
// $routes->get('/admin/htmlToPDF', 'Report::htmlToPDF');
$routes->get('/downloadMasterClientData', 'Report::getMasterClientData');

//------------------------------Act Menus-----------------------------//
$routes->get('/compliance', 'Compliance::index');
$routes->get('/all_in_one_menus', 'Compliance::all_in_one_menus');
$routes->get('/pt_menus', 'Compliance::pt_menus');
$routes->get('/pt_enrol_menus', 'Compliance::pt_enrol_menus');
$routes->get('/pt_reg_menus', 'Compliance::pt_reg_menus');
$routes->get('/oth_act_menus', 'Compliance::oth_act_menus');
$routes->get('/co_op_soc_menus', 'Compliance::co_op_soc_menus');
$routes->get('/trust_menus', 'Compliance::trust_menus');
$routes->get('/shop_est_menus', 'Compliance::shop_est_menus');
$routes->get('/msme_menus', 'Compliance::msme_menus');
$routes->get('/tm_menus', 'Compliance::tm_menus');
$routes->get('/labour_laws_menus', 'Compliance::labour_laws_menus');
$routes->get('/fema_menus', 'Compliance::fema_menus');

//------------------------------Income Tax Act-----------------------------//
$routes->get('/it-menus', 'ComplianceSection/Income_tax3::menus');
$routes->get('/it-ddf/(:any)', 'ComplianceSection\Income_tax3::due_date_for/$1');
$routes->get('/it-ddf-pending/(:any)', 'ComplianceSection\Income_tax3::pending/$1');
$routes->get('/it-ddf-filed/(:any)', 'ComplianceSection\Income_tax3::filed/$1');
$routes->get('/it-ddf-payments/(:any)', 'ComplianceSection\Income_tax3::payments/$1');
$routes->post('/search-it-filter', 'ComplianceSection/Income_tax3::search_filter');
$routes->get('/reset-it-filter', 'ComplianceSection/Income_tax3::reset_filter');

$routes->get('/inc-tax-returns-ddf', 'ComplianceSection/Income_tax2::returns_ddf'); // removed //
$routes->get('/it-returns/(:any)', 'ComplianceSection\Income_tax2::returns/$1'); // removed //
$routes->get('/it-returns-filed/(:any)', 'ComplianceSection\Income_tax2::returns_filed/$1'); // removed //
$routes->post('/search-it-returns', 'ComplianceSection/Income_tax2::search_returns'); // removed //
$routes->get('/reset-it-returns', 'ComplianceSection/Income_tax2::reset_returns'); // removed //

$routes->get('/inc-tax-audits-ddf', 'ComplianceSection/Income_tax2::tax_audits_ddf'); // removed //
$routes->get('/it-tax-audits/(:any)', 'ComplianceSection\Income_tax2::tax_audits/$1'); // removed //
$routes->get('/it-tax-audits-filed/(:any)', 'ComplianceSection\Income_tax2::tax_audits_filed/$1'); // removed //
$routes->post('/search-it-tax-audits', 'ComplianceSection/Income_tax2::search_tax_audits'); // removed //
$routes->get('/reset-it-tax-audits', 'ComplianceSection/Income_tax2::reset_tax_audits'); // removed //

$routes->get('/inc-tax-statements-ddf', 'ComplianceSection/Income_tax3::statements_ddf'); // removed //
$routes->get('/it-statements/(:any)', 'ComplianceSection\Income_tax3::statements/$1'); // removed //
$routes->get('/it-statements-filed/(:any)', 'ComplianceSection\Income_tax3::statements_filed/$1'); // removed //
$routes->post('/search-it-statements', 'ComplianceSection/Income_tax3::search_statements'); // removed //
$routes->get('/reset-it-statements', 'ComplianceSection/Income_tax3::reset_statements'); // removed //

$routes->get('/inc-tax-forms-ddf', 'ComplianceSection/Income_tax3::forms_ddf'); // removed //
$routes->get('/it-forms/(:any)', 'ComplianceSection\Income_tax3::forms/$1'); // removed //
$routes->get('/it-forms-filed/(:any)', 'ComplianceSection\Income_tax3::forms_filed/$1'); // removed //
$routes->post('/search-it-forms', 'ComplianceSection/Income_tax3::search_forms'); // removed //
$routes->get('/reset-it-forms', 'ComplianceSection/Income_tax3::reset_forms'); // removed //

$routes->match(['get', 'post'], '/inc_tax_returns', 'Compliance::inc_tax_returns'); // removed
$routes->match(['get', 'post'], '/inc_tax_returns_filed', 'Compliance::inc_tax_returns_filed'); // removed
$routes->post('/search-inc-tax', 'Compliance::search_inc_tax'); // removed
$routes->get('/reset-inc-tax', 'Compliance::reset_inc_tax'); // removed
$routes->get('/inc_tax_register_section', 'Income_tax::inc_tax_register_section');
$routes->get('/return_filed_register', 'Income_tax::return_filed_register');
$routes->get('/return_filed_register_filing_wise', 'Income_tax::return_filed_register_filing_wise');
$routes->get('/inc_tax_assessee_ledger', 'Income_tax::inc_tax_assessee_ledger');
$routes->get('/inc_tax_assessee_ledger_client/(:any)', 'Income_tax::inc_tax_assessee_ledger_client/$1');
$routes->get('/income_tax_refunds', 'Income_tax::refunds');
$routes->get('/refund-details/(:any)', 'Income_tax::refund_details/$1');
$routes->post('/update-refund-details', 'Income_tax::update_refund_details');
$routes->get('/income-tax-demands', 'ComplianceSection/Income_tax::income_tax_demands');
$routes->get('/demand-details/(:any)', 'ComplianceSection\Income_tax::demand_details/$1');
$routes->post('/update-demand-details', 'ComplianceSection/Income_tax::update_demand_details');
$routes->get('/inc_tax_mis_menu', 'Compliance::inc_tax_mis_menu');
$routes->get('/inc_tax_mis', 'Compliance::inc_tax_mis');
$routes->get('/inc_tax_mis_client/(:any)/(:any)/(:any)', 'Compliance::inc_tax_mis_client/$1/$2/$3');
$routes->get('/inc_tax_mis_staff', 'Compliance::inc_tax_mis_staff');
$routes->get('/inc-tax-mis-summary', 'ComplianceSection/MisReport::inc_tax_mis_summary');
$routes->get('/inc_tax_mis_client_staff/(:any)', 'Compliance::inc_tax_mis_client_staff/$1');
$routes->get('/inc-tax-mis-staff-summary', 'ComplianceSection/MisReport::inc_tax_mis_staff_summary');
$routes->get('/inc_tax_payments', 'Compliance::inc_tax_payments');
$routes->get('/advance_tax', 'Compliance::advance_tax');
$routes->post('/search_advance_tax', 'Compliance::search_advance_tax');
$routes->get('/reset_advance_tax', 'Compliance::reset_advance_tax');
$routes->post('/income_tax/add_payment', 'Income_tax::add_payment');
$routes->post('/income_tax/update_payment', 'Income_tax::update_payment');
$routes->match(['get', 'post'], '/inc_tax_audits', 'Compliance::inc_tax_audits'); // removed
$routes->match(['get', 'post'], '/inc_tax_audits_filed', 'Compliance::inc_tax_audits_filed'); // removed
// $routes->get('/admin/work_form', 'Income_tax::work_form');
$routes->get('/assessment', 'Income_tax::assessment');
$routes->get('/processing', 'Income_tax::processing');
$routes->get('/intimation/(:any)', 'Income_tax::intimation/$1');
$routes->post('/updateIntimation', 'Income_tax::updateIntimation');
$routes->post('/delete-inc-tax-ack-file', 'ComplianceSection/Income_tax::delete_inc_tax_ack_file');

$routes->match(['get', 'post'], '/inc-tax-certificates', 'ComplianceSection/Income_tax2::inc_tax_certificates');
$routes->match(['get', 'post'], '/inc-tax-certificates-filed', 'ComplianceSection/Income_tax2::inc_tax_certificates_filed');
$routes->post('/search-inc-tax-certificates', 'ComplianceSection/Income_tax2::search_inc_tax_certificates');
$routes->get('/reset-inc-tax-certificates', 'ComplianceSection/Income_tax2::reset_inc_tax_certificates');

$routes->match(['get', 'post'], '/inc-tax-statements', 'ComplianceSection/Income_tax2::inc_tax_statements'); // removed
$routes->match(['get', 'post'], '/inc-tax-statements-filed', 'ComplianceSection/Income_tax2::inc_tax_statements_filed'); // removed
$routes->post('/search-inc-tax-statements', 'ComplianceSection/Income_tax2::search_inc_tax_statements'); // removed
$routes->get('/reset-inc-tax-statements', 'ComplianceSection/Income_tax2::reset_inc_tax_statements'); // removed

$routes->match(['get', 'post'], '/inc-tax-forms', 'ComplianceSection/Income_tax2::inc_tax_forms'); // removed
$routes->match(['get', 'post'], '/inc-tax-forms-filed', 'ComplianceSection/Income_tax2::inc_tax_forms_filed'); // removed
$routes->post('/search-inc-tax-forms', 'ComplianceSection/Income_tax2::search_inc_tax_forms'); // removed
$routes->get('/reset-inc-tax-forms', 'ComplianceSection/Income_tax2::reset_inc_tax_forms'); // removed
$routes->get('/inc-event-based-due-dates', 'ComplianceSection/Income_tax3::event_based_due_dates');
$routes->get('/inc-event-based-work/(:any)', 'ComplianceSection\Income_tax3::event_based_work_form/$1');
$routes->post('/update-inc-event-based-work', 'ComplianceSection/Income_tax3::update_event_based_work_form');
$routes->post('/update-inc-work-juniors', 'ComplianceSection/Income_tax3::update_inc_work_juniors');
$routes->post('/update-inc-work-senior', 'ComplianceSection/Income_tax3::update_inc_work_senior');

//------------------------------Rectification-----------------------------//
$routes->get('/rectification', 'ComplianceSection/Income_tax::rectification');
$routes->get('/rectification-details/(:any)', 'ComplianceSection\Income_tax::rectification_details/$1');
$routes->post('/update-rectification-other-amount', 'ComplianceSection/Income_tax::update_rectification_other_amount');
$routes->post('/update-rectification-officer-details', 'ComplianceSection/Income_tax::update_rectification_officer_details');
$routes->post('/update-rectification-order-details', 'ComplianceSection/Income_tax::update_rectification_order_details');
$routes->post('/add-rectification-hearing-details', 'ComplianceSection/Income_tax::add_rectification_hearing_details');
$routes->post('/edit-rectification-hearing-details', 'ComplianceSection/Income_tax::edit_rectification_hearing_details');
$routes->post('/delete-rectification-hearing-details', 'ComplianceSection/Income_tax::delete_rectification_hearing_details');

$routes->post('/submit_assessment', 'Income_tax::submit_assessment');
$routes->post('/submit_scrutiny', 'Income_tax::submit_scrutiny');
// $routes->get('/admin/scrutiny_case', 'Income_tax::scrutiny_case');
// $routes->get('/appeals', 'Income_tax::appeals');
// $routes->get('/admin/appeals_scrutiny', 'Income_tax::appeals_scrutiny');

//---------------------------Scrutiny---------------------------------//
$routes->get('/it-scrutiny', 'ComplianceSection/Scrutiny::it_scrutiny');
$routes->get('add-scrutiny-case', 'ComplianceSection\Scrutiny::add_scrutiny_case');
$routes->post('insert-scrutiny-case', 'ComplianceSection\Scrutiny::insert_scrutiny_case');
$routes->get('scrutiny-case/(:any)', 'ComplianceSection\Scrutiny::scrutiny_case');
$routes->post('/update-scrutiny-basic-details', 'ComplianceSection/Scrutiny::update_scrutiny_basic_details');
$routes->post('/update-scrutiny-notice-details', 'ComplianceSection/Scrutiny::update_scrutiny_notice_details');
$routes->post('/add-scrutiny-notice', 'ComplianceSection/Scrutiny::add_scrutiny_notice');
$routes->post('/edit-scrutiny-notice', 'ComplianceSection/Scrutiny::edit_scrutiny_notice');
$routes->post('/delete-scrutiny-notice', 'ComplianceSection/Scrutiny::delete_scrutiny_notice');
$routes->post('/add-scrutiny-notice-reply', 'ComplianceSection/Scrutiny::add_scrutiny_notice_reply');
$routes->post('/edit-scrutiny-notice-reply', 'ComplianceSection/Scrutiny::edit_scrutiny_notice_reply');
$routes->post('/delete-scrutiny-notice-reply', 'ComplianceSection/Scrutiny::delete_scrutiny_notice_reply');
$routes->post('/edit-scrutiny-final-outcome', 'ComplianceSection/Scrutiny::edit_scrutiny_final_outcome');
$routes->get('order-analysis/(:any)', 'ComplianceSection\Income_tax::order_analysis');
$routes->get('edit-order-analysis/(:any)', 'ComplianceSection\Income_tax::edit_order_analysis');
$routes->post('update-order-analysis', 'ComplianceSection\Income_tax::update_order_analysis');

//---------------------------Appeal----------------------------------//
$routes->get('/appeal-menu', 'ComplianceSection/Income_tax::appeal_menu');
$routes->get('/appeal-level-(:any)', 'ComplianceSection\Income_tax::appeal_level/$1');
$routes->get('appeal-case/(:any)/(:any)', 'ComplianceSection\Income_tax::appeal_case/$1/$2');
$routes->post('/update-appeal-other-amount', 'ComplianceSection/Income_tax::update_appeal_other_amount');
$routes->post('/update-appeal-order-details', 'ComplianceSection/Income_tax::update_appeal_order_details');
$routes->post('/add-appeal-notice', 'ComplianceSection/Income_tax::add_appeal_notice');
$routes->post('/edit-appeal-notice', 'ComplianceSection/Income_tax::edit_appeal_notice');
$routes->post('/delete-appeal-notice', 'ComplianceSection/Income_tax::delete_appeal_notice');
$routes->post('/add-appeal-notice-reply', 'ComplianceSection/Income_tax::add_appeal_notice_reply');
$routes->post('/edit-appeal-notice-reply', 'ComplianceSection/Income_tax::edit_appeal_notice_reply');
$routes->post('/delete-appeal-notice-reply', 'ComplianceSection/Income_tax::delete_appeal_notice_reply');
$routes->post('/edit-appeal-final-outcome', 'ComplianceSection/Income_tax::edit_appeal_final_outcome');

//---------------------------Trade Mark----------------------------------//
$routes->get('/trade-mark', 'ComplianceSection/TradeMark::index');
$routes->post('/add-trade-mark', 'ComplianceSection/TradeMark::add_trade_mark');
$routes->post('/edit-trade-mark', 'ComplianceSection/TradeMark::edit_trade_mark');
$routes->post('/discontinue-trade-mark', 'ComplianceSection/TradeMark::discontinue_trade_mark');
$routes->post('/continue-trade-mark', 'ComplianceSection/TradeMark::continue_trade_mark');
$routes->post('/reject-trade-mark', 'ComplianceSection/TradeMark::reject_trade_mark');
$routes->post('/delete-trade-mark', 'ComplianceSection/TradeMark::delete_trade_mark');

//---------------------------Partnership Firms----------------------------------//
$routes->get('/partnership-firms', 'ComplianceSection/PartnershipFirms::index');
$routes->get('/partnership-firm-deeds/(:any)', 'ComplianceSection\PartnershipFirms::deeds/$1');
$routes->get('/add-partnership-firm-deed/(:any)', 'ComplianceSection\PartnershipFirms::add_deed/$1');
$routes->post('/add-partnership-firm-deed', 'ComplianceSection\PartnershipFirms::create_deed');
$routes->get('/edit-partnership-firm-deed/(:any)/(:any)', 'ComplianceSection\PartnershipFirms::edit_deed/$1/$2');
$routes->post('/edit-partnership-firm-deed', 'ComplianceSection\PartnershipFirms::update_deed');
$routes->get('/view-partnership-firm-deed/(:any)/(:any)', 'ComplianceSection\PartnershipFirms::view_deed/$1/$2');
$routes->post('/delete-partnership-firm-deed', 'ComplianceSection\PartnershipFirms::delete_deed');

//---------------------------LLP----------------------------------//
$routes->get('/llp_menus', 'Compliance::llp_menus');
$routes->get('/llp-menus', 'ComplianceSection/Llp::menus');
$routes->get('/llp-ddf/(:any)', 'ComplianceSection\Llp::due_date_for/$1');
$routes->get('/llp-ddf-pending/(:any)', 'ComplianceSection\Llp::pending/$1');
$routes->get('/llp-ddf-filed/(:any)', 'ComplianceSection\Llp::filed/$1');
$routes->post('/search-llp-filter', 'ComplianceSection/Llp::search_filter');
$routes->get('/reset-llp-filter', 'ComplianceSection/Llp::reset_filter');

$routes->get('/llp-returns', 'ComplianceSection/Llp::returns');
$routes->match(['get', 'post'], '/llp-work-form/(:any)', 'ComplianceSection\Llp::work_form/$1');
$routes->post('/delete-llp-act-ack-file', 'ComplianceSection/Llp::delete_ack_file');
$routes->get('/llp-audits', 'ComplianceSection/Llp::audits');
$routes->match(['get', 'post'], '/llp-audit-work-form/(:any)', 'ComplianceSection\Llp::audit_work_form/$1');
$routes->get('/llp-register-section', 'ComplianceSection/Llp::register_section');
$routes->get('/llp-return-register', 'ComplianceSection/Llp::return_filed_register');
$routes->get('/llp-assessee-ledger', 'ComplianceSection/Llp::assessee_ledger');
$routes->get('/llp-assessee-ledger-client/(:any)', 'ComplianceSection\Llp::assessee_ledger_client/$1');
$routes->get('/llp-mis-menu', 'ComplianceSection\Llp::mis_menu');
$routes->get('/llp-position-of-returns', 'ComplianceSection\Llp::position_of_returns');
$routes->get('/llp-position-of-returns-client/(:any)/(:any)/(:any)', 'ComplianceSection\Llp::position_of_returns_client/$1/$2/$3');
$routes->get('/llp-staff-wise-position', 'ComplianceSection\Llp::staff_wise_position');
$routes->get('/llp-staff-wise-summary-client-wise/(:any)', 'ComplianceSection\Llp::staff_wise_position_client_wise/$1');
$routes->get('/llp-mis-returns-summary', 'ComplianceSection\Llp::mis_returns_summary');
$routes->get('/llp-mis-staff-summary', 'ComplianceSection\Llp::mis_staff_summary');
$routes->get('/llp-deed-details', 'ComplianceSection/Llp::deed_details');
$routes->get('/llp-firm-deeds/(:any)', 'ComplianceSection\Llp::deeds/$1');
$routes->get('/add-llp-firm-deed/(:any)', 'ComplianceSection\Llp::add_deed/$1');
$routes->post('/add-llp-firm-deed', 'ComplianceSection\Llp::create_deed');
$routes->get('/edit-llp-firm-deed/(:any)/(:any)', 'ComplianceSection\Llp::edit_deed/$1/$2');
$routes->post('/edit-llp-firm-deed', 'ComplianceSection\Llp::update_deed');
$routes->get('/view-llp-firm-deed/(:any)/(:any)', 'ComplianceSection\Llp::view_deed/$1/$2');
$routes->post('/delete-llp-firm-deed', 'ComplianceSection\Llp::delete_deed');

//---------------------------Companies Act----------------------------------//
$routes->get('/company-menus', 'ComplianceSection/Company::menus');
$routes->get('/company-ddf/(:any)', 'ComplianceSection\Company::due_date_for/$1');
$routes->get('/company-ddf-pending/(:any)', 'ComplianceSection\Company::pending/$1');
$routes->get('/company-ddf-filed/(:any)', 'ComplianceSection\Company::filed/$1');
$routes->post('/search-company-filter', 'ComplianceSection/Company::search_filter');
$routes->get('/reset-company-filter', 'ComplianceSection/Company::reset_filter');

// $routes->get('/companies-act', 'ComplianceSection/CompaniesAct::index');
$routes->get('/company_returns', 'ComplianceSection/CompaniesAct::company_returns');
$routes->match(['get', 'post'], '/company-work-form/(:any)', 'ComplianceSection\CompaniesAct::work_form/$1');
$routes->post('/delete-cmpy-act-ack-file', 'ComplianceSection/CompaniesAct::delete_ack_file');
$routes->get('/get-dir-three-kyc-clients', 'ComplianceSection/CompaniesAct::getDirThreeKycClients');
$routes->post('/update-client-dir-three-kyc', 'ComplianceSection/CompaniesAct::updateClientDirThreeKyc');
$routes->get('/company_audits', 'ComplianceSection/CompaniesAct::company_audits');
$routes->match(['get', 'post'], '/company-audit-work-form/(:any)', 'ComplianceSection\CompaniesAct::audit_work_form/$1');
$routes->get('/company-return-filed-register', 'ComplianceSection\CompaniesAct::return_filed_register');
$routes->get('/company-master-details', 'ComplianceSection/CompaniesAct::master_details');
$routes->get('/edit-company-master-details/(:any)', 'ComplianceSection\CompaniesAct::edit_master_details/$1');
$routes->post('/add-company-auth-cap', 'ComplianceSection\CompaniesAct::add_auth_cap');
$routes->post('/edit-company-auth-cap', 'ComplianceSection\CompaniesAct::edit_auth_cap');
$routes->post('/delete-company-auth-cap', 'ComplianceSection\CompaniesAct::delete_auth_cap');
$routes->post('/add-company-issue-paid-cap', 'ComplianceSection\CompaniesAct::add_issue_paid_cap');
$routes->post('/edit-company-issue-paid-cap', 'ComplianceSection\CompaniesAct::edit_issue_paid_cap');
$routes->post('/delete-company-issue-paid-cap', 'ComplianceSection\CompaniesAct::delete_issue_paid_cap');
$routes->post('/add-company-director', 'ComplianceSection\CompaniesAct::add_company_director');
$routes->post('/edit-company-director', 'ComplianceSection\CompaniesAct::edit_company_director');
$routes->post('/delete-company-director', 'ComplianceSection\CompaniesAct::delete_company_director');
$routes->post('/add-company-dividend-paid', 'ComplianceSection\CompaniesAct::add_dividend_paid');
$routes->post('/edit-company-dividend-paid', 'ComplianceSection\CompaniesAct::edit_dividend_paid');
$routes->post('/delete-company-dividend-paid', 'ComplianceSection\CompaniesAct::delete_dividend_paid');

//---------------------------Profession Act----------------------------------//
// PT Enrolment
$routes->get('/pt-enrol-payments', 'ComplianceSection/ProfessionTax::enrol_payments');
$routes->get('/manage-pt-enrol-payments/(:any)', 'ComplianceSection\ProfessionTax::manage_enrol_payments/$1');
$routes->post('update-pt-enrol-payments', 'ComplianceSection/ProfessionTax::update_enrol_payments');
$routes->get('/pt-enrol-ledger', 'ComplianceSection/ProfessionTax::enrol_ledger');
$routes->get('/pt-enrol-ledger-client/(:any)', 'ComplianceSection\ProfessionTax::enrol_ledger_client/$1');

// PT Registration
$routes->get('/pt-reg-tax-returns', 'ComplianceSection/ProfessionTax::reg_returns');
$routes->match(['get', 'post'], '/pt-reg-tax-returns-form/(:any)', 'ComplianceSection\ProfessionTax::reg_work_form/$1');
$routes->get('/pt-reg-tax-payments', 'ComplianceSection/ProfessionTax::reg_payments');
$routes->get('/manage-pt-reg-payments/(:any)', 'ComplianceSection\ProfessionTax::manage_reg_payments/$1');
$routes->post('update-pt-reg-payments', 'ComplianceSection/ProfessionTax::update_reg_payments');
$routes->get('/pt-reg-registers-menu', 'ComplianceSection/ProfessionTax::reg_register_menu');
$routes->get('/pt-reg-register', 'ComplianceSection/ProfessionTax::reg_register');
$routes->get('/pt-reg-ledger', 'ComplianceSection/ProfessionTax::reg_ledger');
$routes->get('/pt-reg-ledger-client/(:any)', 'ComplianceSection\ProfessionTax::reg_ledger_client/$1');
$routes->get('/pt-reg-mis-report', 'ComplianceSection\ProfessionTax::reg_mis_report');

//---------------------------TDS-TCS Act----------------------------------//
$routes->get('/tds-tcs-menus', 'ComplianceSection/TdsTcs::menus');
$routes->get('/tds-tcs-ddf/(:any)', 'ComplianceSection\TdsTcs::due_date_for/$1');
$routes->get('/tds-tcs-ddf-pending/(:any)', 'ComplianceSection\TdsTcs::pending/$1');
$routes->get('/tds-tcs-ddf-filed/(:any)', 'ComplianceSection\TdsTcs::filed/$1');
$routes->get('/tds-tcs-ddf-payments/(:any)', 'ComplianceSection\TdsTcs::payments/$1');
$routes->post('/search-tds-tcs-filter', 'ComplianceSection/TdsTcs::search_filter');
$routes->get('/reset-tds-tcs-filter', 'ComplianceSection/TdsTcs::reset_filter');

$routes->get('/tds-tcs-returns-ddf', 'ComplianceSection/TdsTcs::returns_ddf'); // removed //
$routes->get('/tds-tcs-returns/(:any)', 'ComplianceSection\TdsTcs::returns/$1'); // removed //
$routes->get('/tds-tcs-returns-filed/(:any)', 'ComplianceSection\TdsTcs::returns_filed/$1'); // removed //
$routes->post('/search-tds-tcs-returns', 'ComplianceSection/TdsTcs::search_returns'); // removed //
$routes->get('/reset-tds-tcs-returns', 'ComplianceSection/TdsTcs::reset_returns'); // removed //
$routes->get('/tds-tcs-payments-ddf', 'ComplianceSection/TdsTcs::payments_ddf'); // removed //
$routes->get('/tds-tcs-payments/(:any)', 'ComplianceSection\TdsTcs::payments/$1'); // removed //
$routes->get('/tds-tcs-payments-filed/(:any)', 'ComplianceSection\TdsTcs::payments_filed/$1'); // removed //
$routes->post('/search-tds-tcs-payments', 'ComplianceSection/TdsTcs::search_payments'); // removed //
$routes->get('/reset-tds-tcs-payments', 'ComplianceSection/TdsTcs::reset_payments'); // removed //

$routes->get('/tds-tcs-certificates-ddf', 'ComplianceSection/TdsTcs::certificates_ddf'); // removed //
$routes->get('/tds-tcs-certificates/(:any)', 'ComplianceSection\TdsTcs::certificates/$1'); // removed //
$routes->get('/tds-tcs-certificates-filed/(:any)', 'ComplianceSection\TdsTcs::certificates_filed/$1'); // removed //
$routes->post('/search-tds-tcs-certificates', 'ComplianceSection/TdsTcs::search_certificates'); // removed //
$routes->get('/reset-tds-tcs-certificates', 'ComplianceSection/TdsTcs::reset_certificates'); // removed //

// $routes->get('/tds-tcs-payments', 'ComplianceSection/TdsTcs::payments'); // removed //
// $routes->get('/tds-tcs-certificates', 'ComplianceSection/TdsTcs::certificates'); // removed //
$routes->match(['get', 'post'], '/tds-tcs-work-form/(:any)', 'ComplianceSection\TdsTcs::work_form/$1');
$routes->get('/tds-tcs-register-section', 'ComplianceSection/TdsTcs::register_section');
$routes->get('/tds-tcs-registers', 'ComplianceSection/TdsTcs::registers');
$routes->get('/tds-tcs-filing-wise-registers', 'ComplianceSection/TdsTcs::filing_date_wise_registers');
$routes->get('/tds-tcs-assessee-ledger', 'ComplianceSection/TdsTcs::assessee_ledger');
$routes->get('/tds-tcs-assessee-ledger-client/(:any)', 'ComplianceSection\TdsTcs::assessee_ledger_client/$1');
$routes->get('/tds-tcs-mis-report', 'ComplianceSection\TdsTcs::mis_report_menu');
$routes->get('/tds-tcs-position-of-returns', 'ComplianceSection\TdsTcs::position_of_returns');
$routes->get('/tds-tcs-position-of-returns-client/(:any)/(:any)/(:any)', 'ComplianceSection\TdsTcs::position_of_returns_client/$1/$2/$3');
$routes->get('/tds-tcs-staff-wise-position', 'ComplianceSection\TdsTcs::staff_wise_position');
$routes->get('/tds-tcs-staff-wise-summary-client-wise/(:any)', 'ComplianceSection\TdsTcs::staff_wise_position_client_wise/$1');
$routes->get('/tds-tcs-summary-of-returns', 'ComplianceSection\TdsTcs::summary_of_returns');
$routes->get('/tds-tcs-staff-wise-summary', 'ComplianceSection\TdsTcs::staff_wise_summary');

$routes->get('/tds-income-tax-returns', 'ComplianceSection/TdsIncomeTax::returns');
$routes->get('/tds-income-tax-payments', 'ComplianceSection/TdsIncomeTax::payments');
$routes->get('/tds-income-tax-certificates', 'ComplianceSection/TdsIncomeTax::certificates');
$routes->get('/tcs-income-tax-returns', 'ComplianceSection/TcsIncomeTax::returns');
$routes->get('/tcs-income-tax-payments', 'ComplianceSection/TcsIncomeTax::payments');
$routes->get('/tcs-income-tax-certificates', 'ComplianceSection/TcsIncomeTax::certificates');

//---------------------------GST Act----------------------------------//
$routes->get('/gst-menus', 'ComplianceSection/Gst::menus');
$routes->get('/gst-ddf/(:any)', 'ComplianceSection\Gst::due_date_for/$1');
$routes->get('/gst-ddf-pending/(:any)', 'ComplianceSection\Gst::pending/$1');
$routes->get('/gst-ddf-filed/(:any)', 'ComplianceSection\Gst::filed/$1');
$routes->get('/gst-ddf-payments/(:any)', 'ComplianceSection\Gst::payments/$1');
$routes->post('/search-gst-filter', 'ComplianceSection/Gst::search_filter');
$routes->get('/reset-gst-filter', 'ComplianceSection/Gst::reset_filter');

$routes->match(['get', 'post'], '/gst-work-form/(:any)', 'ComplianceSection\Gst::work_form/$1');
$routes->match(['get', 'post'], '/gst_returns', 'ComplianceSection\Gst::returns'); // removed //
$routes->match(['get', 'post'], '/gst_returns_filed', 'ComplianceSection\Gst::returns_filed'); // removed //
$routes->get('/gst_returns_details', 'ComplianceSection\Gst::returns_details');
$routes->post('/update_return_work', 'ComplianceSection\Gst::update_return_work');
$routes->match(['get', 'post'], '/gst_audits', 'ComplianceSection\Gst::audits'); // removed //
$routes->get('/gst_tax_payment', 'ComplianceSection\Gst::payments'); // removed //
$routes->get('/add_gst_payment', 'ComplianceSection\Gst::add_payment'); // removed //
$routes->post('/insert_gst_payment', 'ComplianceSection\Gst::insert_payment'); // removed //
$routes->post('/update_gst_payment', 'ComplianceSection\Gst::update_payment'); // removed //
$routes->post('/delete_gst_payment', 'ComplianceSection\Gst::delete_payment'); // removed //
$routes->get('/gst-return-register', 'ComplianceSection\Gst::return_register');
$routes->get('/gst-return-register-filing-wise', 'ComplianceSection\Gst::return_register_filing_wise');
$routes->get('/gst-assessee-ledger', 'ComplianceSection\Gst::assessee_ledger');
$routes->get('/gst-assessee-ledger-client/(:any)', 'ComplianceSection\Gst::assessee_ledger_client/$1');
$routes->get('/gst-mis-report', 'ComplianceSection\Gst::mis_report_menu');
$routes->get('/gst-position-of-returns', 'ComplianceSection\Gst::position_of_returns');
$routes->get('/gst-position-of-returns-client/(:any)/(:any)/(:any)', 'ComplianceSection\Gst::position_of_returns_client/$1/$2/$3');
$routes->get('/gst-staff-wise-position', 'ComplianceSection\Gst::staff_wise_position');
$routes->get('/gst-staff-wise-summary-client-wise/(:any)', 'ComplianceSection\Gst::staff_wise_position_client_wise/$1');
$routes->get('/gst-summary-of-returns', 'ComplianceSection\Gst::summary_of_returns');
$routes->get('/gst-staff-wise-summary', 'ComplianceSection\Gst::staff_wise_summary');
$routes->post('/delete-gst-ack-file', 'ComplianceSection/Gst::delete_gst_ack_file');

// $routes->get('/tds-tcs-mis-report', 'ComplianceSection\TdsTcs::mis_report_menu');
// $routes->get('/tds-tcs-position-of-returns', 'ComplianceSection\TdsTcs::position_of_returns');
// $routes->get('/tds-tcs-position-of-returns-client/(:any)/(:any)/(:any)', 'ComplianceSection\TdsTcs::position_of_returns_client/$1/$2/$3');
// $routes->get('/tds-tcs-staff-wise-position', 'ComplianceSection\TdsTcs::staff_wise_position');
// $routes->get('/tds-tcs-staff-wise-summary-client-wise/(:any)', 'ComplianceSection\TdsTcs::staff_wise_position_client_wise/$1');
// $routes->get('/tds-tcs-summary-of-returns', 'ComplianceSection\TdsTcs::summary_of_returns');
// $routes->get('/tds-tcs-staff-wise-summary', 'ComplianceSection\TdsTcs::staff_wise_summary');

$routes->get('/appeals_scrutiny_case', 'Income_tax::appeals_scrutiny_case');
$routes->post('/add_hearing', 'Income_tax::add_hearing');
$routes->post('/delete_hearing_date', 'Income_tax::delete_hearing_date');
$routes->post('/add_appeal_hearing', 'Income_tax::add_appeal_hearing');
$routes->post('/delete_appeal_hearing_date', 'Income_tax::delete_appeal_hearing_date');
$routes->post('/edit_partner', 'Client::edit_partner');
$routes->post('/delete_partner', 'Remote/Client::delete_partner');
$routes->get('/error_reports', 'Error_report::index');
$routes->match(['get', 'post'], '/add_error_report', 'Error_report::add_error_report');
$routes->get('/view_error_report', 'Error_report::view_error_report');
$routes->post('/not_satisfy', 'Error_report::not_satisfy');
$routes->post('/delete_error_report', 'Error_report::delete_error_report');
$routes->post('/delete-error-report-img-file', 'Error_report::delete_error_report_img_file');
$routes->get('/feedback_report', 'MyAccount::feedback_report');
$routes->post('/submitFeedBack', 'MyAccount::submitFeedBack');
$routes->get('/referencer', 'Referencer::index');


//---------------------------MIS Report----------------------------------//
$routes->get('/combined-mis-report', 'ComplianceSection\MisReport::combined_mis_report');


$routes->get('/reminder', 'Reminder::index');
$routes->post('/addReminder', 'Reminder::add');
$routes->post('/updateReminder', 'Reminder::updateData');
$routes->post('/deleteReminder', 'Reminder::deleteData');

$routes->get('/todolist', 'ToDoList::index');
$routes->get('/assignByMeList', 'ToDoList::assignByMeList');
$routes->post('/addTDList', 'ToDoList::add');
$routes->post('/updateTDListByeMe', 'ToDoList::updateTDListByeMe');
$routes->post('/updateTDListToMe', 'ToDoList::updateTDListToMe');
$routes->post('/deleteTDList', 'ToDoList::deleteData');

$routes->get('/myDetails', 'MyAccount::details');
$routes->get('/loginDetails', 'MyAccount::loginDetails');

$routes->get('/menuAccess', 'MyAccount::menuAccess');
$routes->post('/updateMenuAccess', 'MyAccount::updateMenuAccess');

$routes->get('/caMasterDetails', 'MyAccount::caMasterDetails');
$routes->get('/manageSettings', 'MyAccount::manageSettings');
$routes->post('/updateSettings', 'MyAccount::updateSettings');
$routes->get('/announcement-settings', 'MyAccount::announcement_settings');
$routes->post('/update-announcement-settings', 'MyAccount::update_announcement_settings');
$routes->get('/hr-settings', 'MyAccount::hr_settings');
$routes->post('/update-hr-settings', 'MyAccount::update_hr_settings');
$routes->get('/scheduleNotes', 'MyAccount::scheduleNotes');
$routes->post('/updateScheduleNotes', 'MyAccount::updateScheduleNotes');

$routes->get('/contGroups', 'ContGroup::index');
$routes->post('/addContGroup', 'ContGroup::add');
$routes->post('/updateContGroup', 'ContGroup::updateData');
$routes->post('/deleteContGroup', 'ContGroup::deleteData');

$routes->get('/contSubGroups', 'ContSubGroup::index');
$routes->post('/addContSubGroup', 'ContSubGroup::add');
$routes->post('/updateContSubGroup', 'ContSubGroup::updateData');
$routes->post('/deleteContSubGroup', 'ContSubGroup::deleteData');

$routes->get('/contactList', 'Contact::index');
$routes->match(['get', 'post'], '/addContact', 'Contact::add');
$routes->match(['get', 'post'], '/editContact', 'Contact::edit');
$routes->post('/deleteContact', 'Contact::deleteData');

$routes->get('/holidays', 'Holiday::index');
$routes->post('/addHoliday', 'Holiday::add');
$routes->post('/editHoliday', 'Holiday::updateData');
$routes->post('/deleteHoliday', 'Holiday::deleteData');

$routes->get('/announcements', 'Announcement::index');
$routes->get('/superadmin-announcements', 'Announcement::superadmin');
$routes->post('/addAnnouncement', 'Announcement::add');
$routes->post('/editAnnouncement', 'Announcement::updateData');
$routes->post('/stopAnnouncement', 'Announcement::stopAnc');
$routes->post('/activateAnc', 'Announcement::activateAnc');
$routes->post('/deactivateAnc', 'Announcement::deactivateAnc');
$routes->post('/deleteAnnouncement', 'Announcement::deleteAnc');

$routes->post('/delete_rectification', 'Remote/Admin::delete_rectification');

$routes->get('/adminReferncer', 'Referencer::admin');
$routes->get('/referncer', 'Referencer::index');
$routes->post('/addReferncer', 'Referencer::add');
$routes->post('/updateReferncer', 'Referencer::updateData');
$routes->post('/deleteReferncer', 'Referencer::deleteData');

$routes->get('/refGroups', 'Referencer::refGroups');
$routes->post('/addRefGroups', 'Referencer::addGroup');
$routes->post('/editRefGroups', 'Referencer::editGroup');
$routes->post('/deleteRefGroups', 'Referencer::deleteGroup');

$routes->get('/refSubGroups', 'Referencer::refSubGroups');
$routes->post('/addRefSubGroups', 'Referencer::addSubGroup');
$routes->post('/editRefSubGroups', 'Referencer::editSubGroup');
$routes->post('/deleteRefSubGroups', 'Referencer::deleteSubGroup');

$routes->post('/switchDueDateYear', 'Login::switchDueDateYear');
$routes->match(['get', 'post'], '/my_works', 'Home::my_works');
$routes->match(['get', 'post'], '/my_works_filed', 'Home::my_works_filed');
$routes->get('/client-administration', 'ClientAdministration::index');
$routes->get('/din-dsc-client-list', 'ClientAdministration::din_dsc_client_list');
$routes->post('/add-client-din-dsc', 'ClientAdministration::add_client_din_dsc');
$routes->post('/edit-client-din-dsc', 'ClientAdministration::edit_client_din_dsc');
$routes->post('/discontinue-client-din-dsc', 'ClientAdministration::discontinue_client_din_dsc');
$routes->post('/continue-client-din-dsc', 'ClientAdministration::continue_client_din_dsc');
$routes->post('/delete-client-din-dsc', 'ClientAdministration::delete_client_din_dsc');
$routes->get('/password-mgmt', 'ClientAdministration::password_mgmt');

$routes->get('/it-password', 'ClientAdministration::it_password');
$routes->post('/add-client-it-password', 'ClientAdministration::add_it_password');
$routes->post('/edit-client-it-password', 'ClientAdministration::edit_it_password');
$routes->post('/delete-client-it-password', 'ClientAdministration::delete_it_password');

$routes->get('/gst-password', 'ClientAdministration::gst_password');
$routes->post('/add-client-gst-password', 'ClientAdministration::add_gst_password');
$routes->post('/edit-client-gst-password', 'ClientAdministration::edit_gst_password');
$routes->post('/delete-client-gst-password', 'ClientAdministration::delete_gst_password');

$routes->get('/pt-password', 'ClientAdministration::pt_password');
$routes->post('/edit-client-pt-password', 'ClientAdministration::edit_pt_password');

$routes->get('/company-password', 'ClientAdministration::company_password');
$routes->post('/edit-client-company-password', 'ClientAdministration::edit_company_password');

$routes->get('/llp-password', 'ClientAdministration::llp_password');
$routes->post('/edit-client-llp-password', 'ClientAdministration::edit_llp_password');

$routes->get('/se-password', 'ClientAdministration::se_password');
$routes->post('/edit-client-se-password', 'ClientAdministration::edit_se_password');

$routes->get('/partnership-password', 'ClientAdministration::partnership_password');
$routes->post('/edit-client-partnership-password', 'ClientAdministration::edit_partnership_password');

$routes->get('/custom-due-dates', 'ClientAdministration::custom_due_dates');

$routes->get('/dir-pt-password', 'ClientAdministration::dir_pt_password');
$routes->post('/edit-client-dir-pt-password', 'ClientAdministration::edit_dir_pt_password');

// Office Management
$routes->get('/office-administration', 'OfficeAdministration::index');

$routes->get('/letter-reference-list', 'OfficeAdministration::letter_reference_list');
$routes->post('/add-letter-reference', 'OfficeAdministration::add_letter_reference');
$routes->post('/edit-letter-reference', 'OfficeAdministration::edit_letter_reference');
$routes->post('/delete-letter-reference', 'OfficeAdministration::delete_letter_reference');

$routes->get('/certificate-reference-list', 'OfficeAdministration::certificate_reference_list');
$routes->post('/add-certificate-reference', 'OfficeAdministration::add_certificate_reference');
$routes->post('/edit-certificate-reference', 'OfficeAdministration::edit_certificate_reference');
$routes->post('/delete-certificate-reference', 'OfficeAdministration::delete_certificate_reference');

$routes->get('/membership-sub-list', 'OfficeAdministration::membership_list');
$routes->post('/add-membership-sub', 'OfficeAdministration::add_membership');
$routes->post('/edit-membership-sub', 'OfficeAdministration::edit_membership');
$routes->post('/delete-membership-sub', 'OfficeAdministration::delete_membership');

$routes->get('/general-password-list', 'OfficeAdministration::general_password_list');
$routes->post('/add-general-password', 'OfficeAdministration::add_general_password');
$routes->post('/edit-general-password', 'OfficeAdministration::edit_general_password');
$routes->post('/delete-general-password', 'OfficeAdministration::delete_general_password');

// Staff Management
$routes->get('/staff-administration', 'StaffAdministration::index');
$routes->get('/my-attendance/(:any)', 'StaffAdministration::my_attendance/$1');
$routes->get('/emp-attendance', 'StaffAdministration::emp_attendance');


$routes->get('/expense-vouchers-list', 'StaffAdministration::expense_list');
$routes->get('/expense-vouchers', 'StaffAdministration::expense_vouchers');
$routes->get('/expense-vouchers/(:any)', 'StaffAdministration::expense_vouchers/$1');
$routes->post('/save-expense', 'Remote/Staff::save_expense');

$routes->get('/employees', 'StaffAdministration::employees');
$routes->get('/articleship-leave-cal', 'StaffAdministration::articleship_leave_cal');
$routes->get('/articleship-leave-cal/(:any)', 'StaffAdministration::articleship_leave_cal/$1');
$routes->post('/update-articleship-leave-cal', 'StaffAdministration::save_articleship_leave_cal');
$routes->get('/hierarchy-chart', 'StaffAdministration::hierarchy_chart');
$routes->get('/all-staff', 'StaffAdministration::all_staff');
$routes->get('/ca-staff', 'StaffAdministration::ca_staff');
$routes->get('/articleship-staff', 'StaffAdministration::articleship_staff');
// $routes->get('/create-chartered-accountant', 'User::create_chartered_accountant');
$routes->get('/create-chartered-accountant/(:any)', 'StaffAdministration::create_chartered_accountant/$1');
$routes->get('/create-articleship/(:any)', 'StaffAdministration::create_articleship/$1');
$routes->post('/save-ca', 'Remote/Staff::save_ca');
$routes->post('/save-articleship-staff', 'Remote/Staff::save_articleship');
$routes->get('/payslip/(:any)', 'StaffAdministration::payslip/$1');
$routes->get('/employee-salary-payable/(:any)', 'StaffAdministration::employee_salary_payable/$1');
$routes->post('/update-employee-salary-payable', 'StaffAdministration::update_employee_salary_payable');
$routes->get('/employee-salary-payable-details/(:any)', 'StaffAdministration::employee_salary_payable_details/$1');
$routes->get('/employee-attendance/(:any)', 'StaffAdministration::employee_attendance/$1');
$routes->get('/employee-payable-summary', 'StaffAdministration::employee_payable_summary');
$routes->post('/add-employee-attendance', 'StaffAdministration::add_employee_attendance');
$routes->post('/edit-employee-attendance', 'StaffAdministration::edit_employee_attendance');
$routes->post('/delete-employee-attendance', 'StaffAdministration::delete_employee_attendance');
$routes->get('/employee-yearly-attendance/(:any)', 'StaffAdministration::employee_yearly_attendance/$1');
$routes->get('/employee-yearly-attendance-hours/(:any)', 'StaffAdministration::employee_yearly_attendance_hours/$1');
$routes->get('/all-employees-attendance/(:any)', 'StaffAdministration::all_employees_attendance/$1');
$routes->get('/all-employees-attendance-hours/(:any)', 'StaffAdministration::all_employees_attendance_hours/$1');
$routes->get('/all-attendance-timesheet/(:any)', 'StaffAdministration::my_attendance_timesheet/$1');

// Accounts
$routes->get('/cashbook', 'Cashbook::index');
$routes->post('/addTransaction', 'Cashbook::add');
$routes->post('/updateTransaction', 'Cashbook::updateData');
$routes->post('/deleteTransaction', 'Cashbook::deleteData');
$routes->get('/bills', 'Bill::index');
$routes->get('/modify-bill-tax-notes', 'Bill::modify_tax_notes');
$routes->post('/update-bill-tax-notes', 'Bill::update_tax_notes');
$routes->get('/create-bill', 'Bill::create');
$routes->post('/generate-bill', 'Bill::generate');
$routes->get('/edit-bill/(:any)', 'Bill::edit/$1');
$routes->post('/update-bill', 'Bill::update');
$routes->get('/view-bill/(:any)', 'Bill::view/$1');
$routes->post('/delete-bill', 'Bill::delete');
$routes->get('/get-staff-rate', 'Accounts/Staff::getStaffRate');
$routes->post('/edit-staff-rate', 'Accounts/Staff::updateStaffRate');
$routes->get('/cost-sheet', 'Accounts/CostSheet::index');
$routes->get('/client-wise-cost-sheet', 'Accounts/CostSheet::client_wise_cost_sheet');
$routes->get('/client-wise-month-cost-sheet/(:any)', 'Accounts\CostSheet::client_wise_month_cost_sheet/$1');
$routes->get('/client-wise-act-cost-sheet/(:any)', 'Accounts\CostSheet::client_wise_act_cost_sheet/$1');
$routes->get('/staff-wise-cost-sheet', 'Accounts/CostSheet::staff_wise_cost_sheet');
$routes->get('/staff-wise-month-cost-sheet/(:any)', 'Accounts\CostSheet::staff_wise_month_cost_sheet/$1');
$routes->get('/staff-wise-act-cost-sheet/(:any)', 'Accounts\CostSheet::staff_wise_act_cost_sheet/$1');

// Billing
$routes->get('/billing', 'Accounts/Billing::index');
$routes->get('/create-single-ddf-billing/(:any)', 'Accounts\Billing::create_single_ddf/$1');
$routes->post('/generate-single-ddf-bill', 'Accounts\Billing::generate_single_ddf');
$routes->get('/edit-single-ddf-billing/(:any)', 'Accounts\Billing::edit_single_ddf/$1');
$routes->post('/update-single-ddf-bill', 'Accounts\Billing::update_single_ddf');
$routes->get('/view-single-ddf-billing/(:any)', 'Accounts\Billing::view_single_ddf/$1');
$routes->get('/bill-register', 'Accounts\Billing::register');

// Non-Regular Due Date For
$routes->get('non-regular-due-date-for-list', 'NonRegularDueDateFor::index');
$routes->post('/add-non-regular-due-date-for', 'NonRegularDueDateFor::add');
$routes->post('/edit-non-regular-due-date-for', 'NonRegularDueDateFor::updateData');
$routes->post('/delete-non-regular-due-date-for', 'NonRegularDueDateFor::deleteData');

// Non-Regular Due Dates
$routes->get('non-regular-due-dates', 'NonRegularDueDates::index');
$routes->get('/add-non-regular-due-date', 'NonRegularDueDates::add');
$routes->post('/insert-non-regular-due-date', 'NonRegularDueDates::insertData');
$routes->get('/edit-non-regular-due-date/(:any)', 'NonRegularDueDates::edit/$1');
$routes->post('/update-non-regular-due-date', 'NonRegularDueDates::updateData');
$routes->post('/delete-non-regular-due-date', 'NonRegularDueDates::deleteData');

// TimeSheet
$routes->get('/time-sheet-list', 'TimeSheet::index');
$routes->get('/work-time-sheet-list/(:any)', 'TimeSheet::work_time_sheet/$1');
$routes->post('/insert-time-sheet-data', 'TimeSheet::insertData');
$routes->post('/update-time-sheet-data', 'TimeSheet::updateData');
$routes->post('/delete-time-sheet-data', 'TimeSheet::deleteData');

//Utility
$routes->post('/remote/utility/changeTheme', 'Remote/Utility::changeTheme');

//Crons
$routes->get('ShiftDueDateNextYearCron', 'ShiftDueDateNextYearCron::index');
$routes->get('ShiftDueDatePreviousYearCron', 'ShiftDueDatePreviousYearCron::index');
$routes->get('TestCron', 'TestCron::index');

//External API
$routes->post('/add_request', 'Other::add_request');
$routes->post('/send_otp', 'Other::send_otp');
$routes->get('/tax_calendar_view', 'Other::tax_calendar');

//UI
$routes->get('/admin/din_digital_sign', 'Admin/Ui_design::din_digital_sign');
$routes->get('/admin/gst_login_password', 'Admin/Ui_design::gst_login_password');
$routes->get('/admin/clients_administration', 'Admin/Ui_design::clients_administration');
$routes->get('/admin/income_tax_login_password', 'Admin/Ui_design::income_tax_login_password');
$routes->get('/admin/tds_login_password', 'Admin/Ui_design::tds_login_password');
$routes->get('/admin/password_mgmt', 'Admin/Ui_design::password_mgmt');
$routes->get('/admin/company_act_Lp', 'Admin/Ui_design::company_act_Lp');
$routes->get('/admin/llp_act_Lp', 'Admin/Ui_design::llp_act_Lp');
$routes->get('/admin/partnership_act_Lp', 'Admin/Ui_design::partnership_act_Lp');
$routes->get('/admin/profession_tax_lp', 'Admin/Ui_design::profession_tax_lp');
$routes->get('/admin/co_op_society_Lp', 'Admin/Ui_design::co_op_society_Lp');
$routes->get('/admin/trust_act_Lp', 'Admin/Ui_design::trust_act_Lp');
$routes->get('/admin/shop_est_act_Lp', 'Admin/Ui_design::shop_est_act_Lp');
$routes->get('/admin/msme_act_Lp', 'Admin/Ui_design::msme_act_Lp');
$routes->get('/admin/trade_mark_Lp', 'Admin/Ui_design::trade_mark_Lp');
$routes->get('/admin/tcs_act_Lp', 'Admin/Ui_design::tcs_act_Lp');
$routes->get('/admin/others_act_Lp', 'Admin/Ui_design::others_act_Lp');
$routes->get('/admin/staff_administration', 'Admin/Ui_design::staff_administration');
$routes->get('/admin/employeewise_salary_list', 'Admin/Ui_design::employeewise_salary_list');
$routes->get('/admin/salary_calculation', 'Admin/Ui_design::salary_calculation');
$routes->get('/admin/credited_salary', 'Admin/Ui_design::credited_salary');
$routes->get('/admin/staff_attendance_tbl', 'Admin/Ui_design::staff_attendance_tbl');

$routes->get('/admin/gst_retuns', 'Admin/Ui_design::gst_retuns');
// $routes->get('/admin/gst_returns_details', 'Admin/Ui_design::gst_returns_details');
// $routes->get('/admin/gst_tax_payment1', 'Admin/Ui_design::gst_tax_payment');
// $routes->get('/admin/add_gst_tax_payment', 'Admin/Ui_design::add_gst_tax_payment');
// $routes->get('/admin/gst_audit', 'Admin/Ui_design::gst_audit');
$routes->get('/admin/gst_audit_form', 'Admin/Ui_design::gst_audit_form');

// Chat Code Start
$routes->get('chat/(:any)', 'ChatSection::index/$1');
$routes->post('chat-send-msg', 'ChatSection::sendMsg');
$routes->post('chat-get-all-msg', 'ChatSection::getMsg');
$routes->post('chat-get-all-users', 'ChatSection::getUserList');

// Chat Code End

// Payroll Code Start
$routes->get('/staff-mgmt-payroll', 'Payroll::index');
$routes->get('/salary-params', 'Payroll::salary_params');
$routes->post('/add-salary-params', 'Payroll::add_salary_params');
$routes->post('/edit-salary-params', 'Payroll::edit_salary_params');
$routes->post('/delete-salary-params', 'Payroll::delete_salary_params');
// Payroll Code End

// Websocket Code Start
$routes->get('websocket/startserver', 'WebSocketController::startServer');
// Websocket Code End

// DB Patch Work - Start
$routes->get('updateNewDueDateOrganization', 'Utility/DatabasePatch::updateNewDueDateOrganization');
// DB Patch Work - End

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
