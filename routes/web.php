<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','TemplateController@index');
Route::get('/add_eatim_information','EatimInfoController@index')->middleware('user_login_check:Md Omar faruk');
Route::get('/get_eatim_information','EatimInfoController@getInfo');
Route::post('/eatim_information/save','EatimInfoController@save');
Route::get('/eatim_information/edit/{id}','EatimInfoController@edit');
Route::post('/eatim_information/update','EatimInfoController@update');
Route::get('/eatim_information/delete/{id}','EatimInfoController@delete');


Auth::routes();
Route::get('/home', 'TemplateController@index')->name('home');

Route::get('/designation/List','DesignationCtrl@data_list');
Route::post('/designation/information','DesignationCtrl@save');
Route::get('/designation/delete/{id}','DesignationCtrl@delete_designation');

Route::get('/department/list','DesignationCtrl@department_list');
Route::post('/department/information','DesignationCtrl@department_save');
Route::get('/designation/delete_department/{id}','DesignationCtrl@delete_department');

Route::get('/user_role/list','DesignationCtrl@user_role_list');
Route::post('/user_role/information','DesignationCtrl@user_role_save');
Route::get('/user_role/delete_user_role/{id}','DesignationCtrl@delete_user_role');


Route::get('/staff_info/list','StaffCtrl@getInfo');
Route::post('/staff_info/save','StaffCtrl@save');
Route::post('/staff_info/get_single_staff_info','StaffCtrl@get_single_staff_info');
Route::get('/staff_info/delete_staff_info/{id}','StaffCtrl@delete_staff_info');


Route::get('/bank_info/list','AllSetupCtrl@bank_info_list');
Route::post('/bank_info/bank_save','AllSetupCtrl@bank_save');
Route::get('/bank_info/delete_bank_info/{id}','AllSetupCtrl@delete_bank_info');

Route::get('/donar/list','AllSetupCtrl@donar_info_list');
Route::post('/donar/donar_save','AllSetupCtrl@donar_save');
Route::get('/donar/delete_donar/{id}','AllSetupCtrl@delete_donar_info');


Route::get('/donation_box/list','AllSetupCtrl@donation_box_list');
Route::post('/donation_box/donation_box_save','AllSetupCtrl@donation_box_save');
Route::post('/get_single_box_info','AllSetupCtrl@get_single_box_info');
Route::get('/delete_donation_box/{id}','AllSetupCtrl@delete_donation_box');




// todo::Cash Receipt donar
Route::get('/money_receipt_donar','CashReceipt@money_receipt_donar');
Route::get('/get_money_receipt_donar','CashReceipt@get_money_receipt_donar');
Route::post('/save_money_receipt_donar','CashReceipt@save_money_receipt_donar');
Route::get('/single_receipt_view/{id}','CashReceipt@single_receipt_view');
Route::get('/delete_money_receipt_donar/{id}','CashReceipt@delete_money_receipt_donar');
Route::get('/get_single_box_info/{id}','CashReceipt@delete_money_receipt_donar');

//todo::donation box
Route::get('/get_donation_box_receipt','CashReceipt@get_donation_box_receipt');
Route::get('/ajaxdata/getdata','CashReceipt@get_donation_box_receipt_ajax')->name('ajaxdata.getdata');
Route::post('/save_donation_box_receipt','CashReceipt@save_donation_box_receipt');
Route::get('/donation_box_receipt','CashReceipt@donation_box_receipt');

//todo:: receipt from bank
Route::get('/get_money_receipt_bank','CashReceipt@get_money_receipt_bank');
Route::get('/money_receipt_bank','CashReceipt@money_receipt_bank');
Route::post('/save_money_receipt_bank','CashReceipt@save_money_receipt_bank');
Route::get('/delete_money_receipt_bank/{id}','CashReceipt@delete_money_receipt_bank');


//payment
//todo:: Cash Payment
Route::get('/payment_cash','PaymentCtrl@payment_cash');
Route::get('/get_payment_cash','PaymentCtrl@get_payment_cash');
Route::post('/save_payment_cash','PaymentCtrl@save_payment_cash');
Route::get('/delete_payment_cash/{id}','PaymentCtrl@delete_payment_cash');

//todo:: Bank Payment
Route::get('/get_payment_bank','PaymentCtrl@get_payment_bank');
Route::get('/payment_bank','PaymentCtrl@payment_bank');
Route::post('/save_payment_bank','PaymentCtrl@save_payment_bank');
Route::get('/delete_payment_bank/{id}','PaymentCtrl@delete_payment_bank');


// montly opening setup
Route::get('/get_montly_open','AllSetupCtrl@get_montly_open');
Route::post('/save_montly_open','AllSetupCtrl@save_montly_open');
Route::get('/delete_montly_open/{id}','AllSetupCtrl@delete_montly_open');

// this is for report
Route::get('/get_all_expense_report','ReportCtrl@get_all_expense_report');
Route::get('/get_all_collection_report','ReportCtrl@get_all_collection_report');

Route::post('/sarching_expense_month','ReportCtrl@sarching_expense_month');
Route::post('/sarching_get_all_collection_report','ReportCtrl@sarching_get_all_collection_report');



