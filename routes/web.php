<?php

use App\Http\Controllers\ICS\ICSController;
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

Route::get('/', 'PageController@index');
Route::get('logout', 'LoginController@logout');

//DELETE FROM LIBRARY 
Route::get('/deletecat/{name}','LibraryController@delete');


Route::get('{view}/{id}', 'AdminController@index');

//JSON
Route::get('json/{tbl}/{val}', 'JsonController@library');

//EQUIPMENT
Route::post('equipment/create', 'EquipmentController@create');

//UPDATE PPE
Route::post('update-ppe', 'AdminController@updatePPE');

//Equipment
Route::post('save-equipment', 'EquipmentController@store');
Route::post('update-equipment', 'EquipmentController@updateequipment');
Route::get('ppe/delete-equipment/{id}','EquipmentController@delete');
Route::get('ppe/accept-equipment/{id}','EquipmentController@accept');
Route::get('revert-equipment/{id}','EquipmentController@revert');
Route::post('dispose-equipment','EquipmentController@dispose');
Route::post('transfer-equipment','EquipmentController@transfer');

//ICS
Route::post('save-ics', 'EquipmentController@storeics');
Route::post('save-ics2', 'EquipmentController@storeics2');
Route::post('update-ics', 'EquipmentController@updateics');
Route::get('ics/accept-ics/{id}','EquipmentController@acceptics');
Route::post('transfer-ics','EquipmentController@transferics');
Route::post('dispose-ics','EquipmentController@disposeics');
Route::get('revert-ics/{id}','EquipmentController@revertics');
Route::get('get/icscomponents-components/{set_id}', 'JsonController@requesticscomponent_items_details');
Route::get('get/icscomponents-components-id/{id}', 'JsonController@viewrequesticscomponent_items_details_id');
Route::get('get/viewicscomponents-components/{set_id}', 'JsonController@viewrequesticscomponent_items_details');
Route::get('get/viewppecomponents-components/{set_id}', 'JsonController@viewrequestppecomponent_items_details');
Route::get('get/equipment-set-components/{id}', 'JsonController@requestequipment_set_components');
Route::get('get/icscomponents/{id}', 'JsonController@requesticscomponent_details');
Route::get('get/get_items/{empcode}', 'JsonController@json_icsitems');
Route::get('get/icsitemsbydivision/{division}', 'JsonController@json_icsitems_division');
Route::get('get/icsitems/{empcode}', 'JsonController@json_ics');
Route::get('get/view_history/{set_id}', 'JsonController@view_history');
Route::get('pdf/ics/{id}', 'GenerateICSController@ics');
Route::get('pdf/ics_division/{set_id}/{division}', 'GenerateICSController@ics_division');
Route::get('ics/delete/{id}','ICSController@deleteics');
Route::get('filter/ics/{division}','ICSController@table_ics_filter');


//LIBRARY
//Category
Route::post('save-category', 'CategoryController@store');
Route::post('update-category', 'CategoryController@update');
Route::get('delete-category','CategoryController@delete');

// PPE Category
Route::get('library-category', 'LibraryController@category')->name('library-category');
Route::get('get/library/ppe-category','LibraryController@ppeCategoryLibrary');
Route::post('save/ppe-category', 'LibraryController@save');
Route::post('update/ppe-category', 'LibraryController@update');
Route::get('delete/ppe-category/{id}', 'LibraryController@delete');
Route::get('get/ppe-category/{id}', 'LibraryController@updateShowData');
// 

// PPE Sub-Category
Route::get('library-subcategory', 'LibraryController@subcategory')->name('library-subcategory');
Route::get('get/library/ppe-subcategory','LibraryController@ppeSubCategoryLibrary');
Route::post('save/ppe-subcategory', 'LibraryController@saveSubCategory');
Route::post('update/ppe-subcategory', 'LibraryController@updateSubCategory');
Route::get('delete/ppe-subcategory/{id}', 'LibraryController@deleteSubCategory');
Route::get('get/ppe-subcategory/{id}', 'LibraryController@updateSubCategoryShowData');
// 

// Auto-Fill Sub-Category
Route::get('get/categories/{id}', 'LibraryController@getCategorybySubCategory');
Route::get('get/subcategories/{category}', 'LibraryController@getSubCategorybyCategory');
// 

// Fund Cluster Library
Route::get('library-fund-cluster', 'LibraryController@fundCluster')->name('library-fund-cluster');
Route::get('get/library/fund-cluster','LibraryController@fundClusterLibrary');
Route::post('save/fund-cluster', 'LibraryController@saveFundCluster');
Route::post('update/fund-cluster', 'LibraryController@updateFundCluster');
Route::get('delete/fund-cluster/{id}', 'LibraryController@deleteFundCluster');
Route::get('get/fund-cluster/{id}', 'LibraryController@updateFundClusterShowData');

// ICS Type Library
Route::get('library-ics-type', 'LibraryController@icsType')->name('library-ics-type');
Route::get('get/library/ics-type','LibraryController@icsTypeLibrary');
Route::post('save/ics-type', 'LibraryController@saveICSType');
Route::post('update/ics-type', 'LibraryController@updateICSType');
Route::get('delete/ics-type/{id}', 'LibraryController@deleteICSType');
Route::get('get/ics-type/{id}', 'LibraryController@updateICSTypeShowData');

//FROM ANDROID DEVICE EXCLUDE CSRF TOKEN
Route::get('android/details/{prop_num}', 'AndroidController@index');
Route::post('android/insert', 'AndroidController@create');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//PPE
Route::get('json/equipment/{id}', 'JsonController@requestequipment_details');
Route::get('get/components/{id}', 'JsonController@requestcomponent_details');
Route::get('get/view_history_ppe/{set_id}', 'JsonController@view_history_ppe');
Route::get('get/parcomponents-components/{set_id}', 'JsonController@requestparcomponent_details');
Route::get('get/parcomponents-components-id/{id}', 'JsonController@viewrequestparcomponent_items_details_id');
Route::get('get/get_items2/{empcode}', 'JsonController@json_paritems');
Route::get('get/get_itemspardivision/{division}', 'JsonController@json_pardivisionitems');
Route::get('get/get_itemsparnumber/{par_number}', 'JsonController@json_parnumberitems');
Route::get('get/get_rpcppe/{year}/{ppe_type}', 'JsonController@json_rpcppe');
Route::get('get/users/{empcode}', 'JsonController@requestuser_empcode');
Route::get('get/division/{division_acro}', 'JsonController@requestdivision');
Route::get('get/position/{employee_code}', 'JsonController@requestposition');
Route::get('pdf/par/{id}', 'GeneratePARController@par');
Route::get('ppe/delete/{id}','EquipmentController@deleteppe');
Route::get('pdf/semiexpendablecard/{id}', 'GenerateSemiExpendableCardController@semiexpendablecard');
Route::get('pdf/propcard/{id}', 'GeneratePropertyCardController@propertycard');
Route::get('pdf/rpcppe/{year}/{ppe_type}', 'GenerateRPCPPEController@rpcppe');

// RSPI Report
Route::post('spissued/generate-report', 'ReportsController@pdf_spissued_report_post');
Route::get('spissued-report', 'ReportsController@spissued_report');
Route::get('get/spissued/{start_date}/{end_date}/{fund_cluster}', 'ReportsController@table_spissued_report');
Route::get('pdf/spissued-report/{start_date}/{end_date}/{fund_cluster}', 'ReportsController@pdf_spissued_report');
Route::get('get/generated/spissued', 'ReportsController@table_spissued_generated');
Route::get('get/generated/spissued/{id}', 'ReportsController@table_spissued_generated_by_id');
Route::post('rspi/update','ReportsController@update_rspi');
Route::get('rspi/delete/{id}','ReportsController@delete_rspi');

// DPPMP Report
Route::get('get/dppmp/{division}/{funding}/{charging}/{from}/{to}/{year}', 'ReportsController@pdf_dppmp_report');

// Semi-Expendable Reports
//Property Ledger
Route::get('sp-ledger', 'ReportsController@propertyledger_report');
Route::get('pdf/ledgercard/{set_id}', 'ReportsController@pdf_ledger_card');
Route::get('pdf/semiexpendableledger/', 'ReportsController@pdf_semi_expendable_ledger');
Route::post('generate-ledgercard', 'ReportsController@save_ledgercard_details');

// Users Management
Route::get('users-management-table', 'UsersController@usersList');

// Project Staff Management
Route::get('projectstaff-management-table', 'UsersController@projectStaffList');
Route::get('get/projectstaff/{id}', 'UsersController@getProjectStaff');
Route::post('add/projectstaff', 'UsersController@addProjectStaff');
Route::get('update/projectstaff', 'UsersController@updateProjectStaff');
Route::get('delete/projectstaff/{id}', 'UsersController@deleteProjectStaff');

//PROCUREMENT
Route::get('/annual-procurement-plan', 'ProcurementController@app')->name('app');
Route::get('/divisional-procurement-plan', 'ProcurementController@dppmp')->name('dppmp');
Route::get('report/generateDPPMP/{division}/{charging}', 'ProcurementController@generateDPPMP')->name('generateDPPMP');
Route::post('save/dppmp', 'ProcurementController@saveDPPMP')->name('saveDPPMP');
Route::get('delete/dppmp/{id}', 'ProcurementController@deleteDPPMP')->name('deleteDPPMP');

Route::get('spissued-report', 'ReportsController@spissued_report');

Route::get('documents', function () {
    return view('documents');
});

// Property Number Automation
Route::get('/ics-get-previous-id', 'ICS\ICSController@getPreviousId')->name('ics-getprevious-id');
Route::get('/ppe-get-previous-id', 'PPE\PPEController@getPreviousId')->name('ppe-getprevious-id');


// Disposal Module
Route::get('/ppe-disposal', 'PPE\PPEController@for_disposal_ppe')->name('ppe-disposal');
