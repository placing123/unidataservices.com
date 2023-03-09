<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
//*******************************************************************************************************************************************//
//*******************************************************************************************************************************************//
										//		A			D			M			I			N		//
//*******************************************************************************************************************************************//												
//*******************************************************************************************************************************************//												



	

$route['secure-login'] = 'login';		
$route['onlineplacment-adminLogin'] = 'login';		


$route['secure-logout'] = 'login/logout';												
$route['admin-authenticate'] = 'login/authenticate';												
$route['admin-dashboard'] = 'admin/AdminController/dashboard';												
$route['student-register'] = 'login/student-register';												
$route['Registration'] = 'login/add-student';												

// $route['student-list-insert'] = 'admin/slider/insert';
$route['student-list-show'] = 'admin/student/show';
$route['student-delete/(:num)'] = 'admin/student/delete/$1';
$route['student-status/(:num)/(:num)'] = 'admin/student/status/$1/$2';
$route['student-edit/(:num)'] = 'admin/student/edit/$1';
$route['student-update/(:num)'] = 'admin/student/update/$1';

// jon
$route['login2'] = 'frontent/HomeController/customerlogin';
$route['customer-auth'] = 'frontent/HomeController/customer_auth';


$route['home'] = 'frontent/HomeController/home';
$route['resumetask'] = 'frontent/HomeController/resumetask';
$route['customer-login'] = 'frontent/HomeController/customerlogin';	

//$route['agreement'] = 'frontent/HomeController/agreement';
$route['form_list'] = 'frontent/HomeController/form_list';
$route['query'] = 'frontent/HomeController/query';
$route['profile'] = 'frontent/HomeController/profile';
$route['instructions'] = 'frontent/HomeController/instructions';


$route['get_forms'] = 'frontent/HomeController/get_forms';
$route['store_form'] = 'frontent/HomeController/store_form';
$route['save_for_query'] = 'frontent/HomeController/save_for_query';
$route['update_resume'] = 'frontent/HomeController/update_resume';

$route['agreement'] = 'frontent/HomeController/agreement_view';
$route['upload_signature'] = 'frontent/HomeController/upload_signature';




$route['approval_waiting'] = 'frontent/HomeController/approval_waiting_page';

$route['complete_task'] = 'frontent/HomeController/complete_task';


$route['submit_task'] = 'frontent/HomeController/submit_task';

$route['save_sign_withtranparent'] = 'frontent/HomeController/save_sign_withtranparent';


$route['customer-logout'] = 'frontent/HomeController/customer_logout';	

//adminpanel ////////////////////////////////////////////////////////////////////

$route['franchise-list'] = 'admin/AdminController/franchise_list';
$route['franchise-add'] = 'admin/AdminController/franchise_add';
$route['franchise-store'] = 'admin/AdminController/franchise_store';


$route['caller-add'] = 'admin/AdminController/caller_add';
$route['caller-store'] = 'admin/AdminController/caller_store';
$route['update_caller'] = 'admin/AdminController/update_caller';
$route['caller_list'] = 'admin/AdminController/caller_list';




$route['plan-add'] = 'admin/AdminController/plan_add';

$route['send_mail2'] = 'admin/AdminController/send_mail2';


$route['plan-list'] = 'admin/AdminController/plan_list';
$route['plan-store'] = 'admin/AdminController/plan_store';

$route['register-add'] = 'admin/AdminController/register_add';
$route['register-list'] = 'admin/AdminController/register_add';
$route['register-store'] = 'admin/AdminController/register_store';


$route['get_callers'] = 'admin/AdminController/get_callers';
$route['activate_listing'] = 'admin/AdminController/activate_listing';
$route['activate_agreement'] = 'admin/AdminController/activate_agreement';


$route['new-resume'] = 'admin/AdminController/new_resume';
$route['store_resume'] = 'admin/AdminController/store_resume';

$route['resume-list'] = 'admin/AdminController/resume_list';

$route['help-request'] = 'admin/AdminController/help_request';
$route['delete_records'] = 'admin/AdminController/delete_records';

// pdf


$route['generate_pdf'] = 'admin/AdminController/generate_pdf';

$route['check_dataexit'] = 'admin/AdminController/check_dataexit';

$route['cronjob'] = 'admin/Dashboard/cronjob';



// end pdf 

//edit
$route['edit_franchaise/(:num)'] = 'admin/AdminController/edit_franchaise/$1';
$route['update_franchise'] = 'admin/AdminController/update_franchise';
$route['edit_caller/(:num)'] = 'admin/AdminController/edit_caller/$1';
$route['edit_plan/(:num)'] = 'admin/AdminController/edit_plan/$1';

$route['update_plan'] = 'admin/AdminController/update_plan';


$route['open-customer-request/(:num)'] = 'admin/AdminController/open_customer_request/$1';
$route['update_field_req'] = 'admin/AdminController/update_field_req';

$route['search'] = 'admin/AdminController/search';
$route['check_agreement'] = 'frontent/HomeController/check_agreement';
$route['save_signature'] = 'frontent/HomeController/save_signature';
$route['logoutusers'] = 'frontent/HomeController/logoutusers';
$route['saveforquery'] = 'frontent/HomeController/saveforquery';
$route['query-list'] = 'frontent/HomeController/query_listing';
$route['check_pendingrequestexit'] = 'frontent/HomeController/check_pendingrequestexit';
$route['new-query/(:num)'] = 'frontent/HomeController/new_query/$1';
$route['store-query'] = 'frontent/HomeController/store_query';
$route['update_form'] = 'frontent/HomeController/update_form';
$route['coming_soon'] = 'admin/AdminController/coming_soon';
$route['customer-action'] = 'admin/AdminController/customeractionlist';

$route['delete_customers'] = 'admin/AdminController/delete_customers';
$route['deactivate_customers'] = 'admin/AdminController/deactivate_customers';

$route['query-result/(:num)'] = 'frontent/HomeController/query_result/$1';

$route['edit-resume/(:num)'] = 'frontent/HomeController/edit_resume/$1';

$route['date-extent'] = 'admin/AdminController/date_extent';
$route['get_last_date'] = 'admin/AdminController/get_last_date';


$route['update-date-search'] = 'admin/AdminController/update_date_extent';
$route['edit_profile'] = 'frontent/HomeController/edit_profile';
$route['update_customerdata'] = 'frontent/HomeController/update_customerdata';
$route['terms_con'] = 'frontent/HomeController/terms_con';
$route['create_sign_pdf'] = 'frontent/HomeController/create_sign_pdf';


$route['sendmail'] = 'admin/AdminController/sendmail';
$route['reminder_mail'] = 'admin/AdminController/reminder_mail';

$route['remider_mail_send'] = 'admin/AdminController/remider_mail_send';

$route['resend_mail_send'] = 'admin/AdminController/resend_mail_send';


$route['warning_mail_send'] = 'admin/AdminController/warning_mail_send';



$route['noc_mail'] = 'admin/AdminController/noc_mail';
$route['send_noc'] = 'admin/AdminController/send_noc';
$route['submission_fail'] = 'admin/AdminController/submission_fail';
$route['submission_pass'] = 'admin/AdminController/submission_pass';
$route['submission_notsubmit'] = 'admin/AdminController/submission_notsubmit';
$route['work_space'] = 'admin/AdminController/work_space';
$route['caller_report'] = 'admin/AdminController/caller_report';

$route['caller_month_report'] = 'admin/AdminController/caller_month_report';



$route['customer_qc'] = 'admin/AdminController/customer_qc';
$route['customer_form'] = 'admin/AdminController/customer_form';
$route['customer_formdata'] = 'admin/AdminController/customer_formdata';
$route['form_approve'] = 'admin/AdminController/form_approve';

$route['qc_pass_faild'] = 'admin/AdminController/qc_pass_faild';

$route['activate_list'] = 'admin/AdminController/activate_list';


$route['autoformapproved'] = 'admin/AdminController/autoformapproved';

$route['qc_result'] = 'frontent/HomeController/qc_result';
$route['edit-qc-resume/(:num)'] = 'frontent/HomeController/edit_qc_result/$i';
$route['customer_qcsubmit/(:num)'] = 'admin/AdminController/customer_qcsubmit/$i';

$route['master_setting'] = 'admin/AdminController/master_setting';
$route['master-edit'] = 'admin/AdminController/update_master_setting';
$route['change_password'] = 'admin/AdminController/change_password';
$route['update_change_password'] = 'admin/AdminController/update_change_password';
//$route['change_password1'] = 'frontent/HomeController/change_password';
//$route['update_change_password1'] = 'frontent/HomeController/update_change_password';
$route['get_approve_data'] = 'admin/AdminController/get_approve_data';

$route['update_qc_submission'] = 'admin/AdminController/update_qc_submission';

$route['add-role'] = 'admin/AdminController/add_role';
$route['store_role'] = 'admin/AdminController/store_role';
$route['role_manage'] = 'admin/AdminController/role_manage';
$route['update_permission'] = 'admin/AdminController/update_permission';

$route['check_permission_records'] = 'admin/AdminController/check_permission_records';

$route['resumes_store'] = 'admin/AdminController/resumes_store';
$route['role-list'] = 'admin/AdminController/role_list';


$route['resend_sign'] = 'admin/AdminController/resend_sign';  



// $route['demomail'] = 'admin/AdminController/demomail';

$route['walletbalance'] = 'admin/AdminController/walletbalance';  

$route['customer-log'] = 'admin/AdminController/customerlogbyid';
$route['noclist'] = 'admin/AdminController/noclist';

$route['exceltopdfdemo'] = 'admin/Dashboard/exceltopdfdemo';
$route['resume_create'] = 'admin/AdminController/resume_create';
$route['createresume_list'] = 'admin/AdminController/createresume_list';
$route['exceltopdf'] = 'admin/AdminController/exceltopdf';