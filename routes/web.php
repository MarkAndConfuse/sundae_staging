<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Auth\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Dasboard
Route::get('/', 'App\Http\Controllers\Dashboard\DashboardController@login');
Route::get('/dashboard', 'App\Http\Controllers\Dashboard\DashboardController@dashboard');

// Manage Subscriptions
Route::get('/manage_subscription', 'App\Http\Controllers\Dashboard\ManageSubscriptionController@index');
Route::get('/subscription_datatables', 'App\Http\Controllers\Dashboard\ManageSubscriptionController@subscriptionDataTable');

Route::get('/add_subscription', 'App\Http\Controllers\Dashboard\ManageSubscriptionController@addSubscription');
Route::get('/view_and_update_subscription/{sId}', 'App\Http\Controllers\Dashboard\ManageSubscriptionController@viewAndUpdateSubscription');
Route::get('/view_subscription/{sId}', 'App\Http\Controllers\Dashboard\ManageSubscriptionController@viewSubscription');
Route::get('/get_pm_tcd_csd/{subsId}', 'App\Http\Controllers\Dashboard\ManageSubscriptionController@getPmTcdCsd');

Route::post('/create_subscription', 'App\Http\Controllers\Dashboard\ManageSubscriptionController@createSubscription');
Route::post('/update_subscription', 'App\Http\Controllers\Dashboard\ManageSubscriptionController@updateSubscription');

// Manage Customers
Route::get('/manage_customers', 'App\Http\Controllers\Dashboard\ManageCustomersController@index');
Route::get('/customers_datatables', 'App\Http\Controllers\Dashboard\ManageCustomersController@customersDataTable');
Route::get('/customers_for_update_subscription', 'App\Http\Controllers\Dashboard\ManageCustomersController@customersForUpdate');
Route::get('/customers_datatables_for_update_subscription', 'App\Http\Controllers\Dashboard\ManageCustomersController@customersForUpdateDataTable');
Route::post('/create_customer', 'App\Http\Controllers\Dashboard\ManageCustomersController@createCustomer');
Route::post('/update_customer', 'App\Http\Controllers\Dashboard\ManageCustomersController@updateCustomer');

// Manage CDB Accounts
Route::get('/load_cdb_accounts', 'App\Http\Controllers\Dashboard\ManageCDBAccountsController@index');
Route::get('/cdb_accounts_datatables', 'App\Http\Controllers\Dashboard\ManageCDBAccountsController@cdbAccountsDataTable');

Route::get('/load_cdb_accounts_tcd', 'App\Http\Controllers\Dashboard\ManageCDBAccountsController@viewAccountsTcd');
Route::get('/cdb_accounts_tcd_datatables', 'App\Http\Controllers\Dashboard\ManageCDBAccountsController@cdbAccountsTcdDataTable');

Route::get('/load_cdb_accounts_csd', 'App\Http\Controllers\Dashboard\ManageCDBAccountsController@viewAccountsCsd');
Route::get('/cdb_accounts_csd_datatables', 'App\Http\Controllers\Dashboard\ManageCDBAccountsController@cdbAccountsCsdDataTable');

// Assign PM
Route::get('/load_pm/{subsId}', 'App\Http\Controllers\Dashboard\AssignPMController@index');
Route::get('/pm_datatable', 'App\Http\Controllers\Dashboard\AssignPMController@pmDataTable');
Route::get('/get_pm/{subsId}', 'App\Http\Controllers\Dashboard\AssignPMController@getPM');
Route::post('/add_pm', 'App\Http\Controllers\Dashboard\AssignPMController@addPM');
Route::post('/delete_assign_pm', 'App\Http\Controllers\Dashboard\AssignPMController@deletePM');
Route::get('/add_assign_pm/{pmPayload}/{id}', 'App\Http\Controllers\Dashboard\AssignPMController@addAssignPM');
Route::get('/edit_assign_pm/{pmPayload}/{subsId}', 'App\Http\Controllers\Dashboard\AssignPMController@editAssignPM');

// Assign TCD
Route::get('/load_tcd/{subsId}', 'App\Http\Controllers\Dashboard\AssignTCDController@index');
Route::get('/tcd_datatable', 'App\Http\Controllers\Dashboard\AssignTCDController@tcdDataTable');
Route::get('/get_tcd_list/{subsId}', 'App\Http\Controllers\Dashboard\AssignTCDController@getTCDList');
Route::post('/add_tcd', 'App\Http\Controllers\Dashboard\AssignTCDController@addTCD');
Route::post('/delete_assign_tcd', 'App\Http\Controllers\Dashboard\AssignTCDController@deleteTCD');
Route::get('/add_assign_tcd/{tcdPayload}/{id}', 'App\Http\Controllers\Dashboard\AssignTCDController@addAssignTCD');
Route::get('/edit_assign_tcd/{tcdPayload}/{subsId}', 'App\Http\Controllers\Dashboard\AssignTCDController@editAssignTCD');

// Assign CSD
Route::get('/load_csd/{subsId}', 'App\Http\Controllers\Dashboard\AssignCSDController@index');
Route::get('/csd_datatable', 'App\Http\Controllers\Dashboard\AssignCSDController@csdDataTable');
Route::get('/get_csd_list/{subsId}', 'App\Http\Controllers\Dashboard\AssignCSDController@getCSDList');
Route::post('/add_csd', 'App\Http\Controllers\Dashboard\AssignCSDController@addCSD');
Route::post('/delete_assign_csd', 'App\Http\Controllers\Dashboard\AssignCSDController@deleteCSD');
Route::get('/add_assign_csd/{csdPayload}/{id}', 'App\Http\Controllers\Dashboard\AssignCSDController@addAssignCSD');
Route::get('/edit_assign_csd/{csdPayload}/{subsId}', 'App\Http\Controllers\Dashboard\AssignCSDController@editAssignCSD');

// Email Notifications
Route::get('/view_email_notifications/{subsId}', 'App\Http\Controllers\Dashboard\EmailNotificationsController@index');
// Route::get('/load_email_notifs', 'App\Http\Controllers\Dashboard\EmailNotificationsController@index');
Route::get('/email_notifs_datatable', 'App\Http\Controllers\Dashboard\EmailNotificationsController@emailNotifsDataTable');
Route::get('/get_email_notifs_list/{nId}', 'App\Http\Controllers\Dashboard\EmailNotificationsController@getEmailNotifsList');
Route::post('/add_email_notif', 'App\Http\Controllers\Dashboard\EmailNotificationsController@addEmailNotif');

Route::get('/edit_email_notif/{notifId}', 'App\Http\Controllers\Dashboard\EmailNotificationsController@editEmailNotif');
Route::post('/save_updated_email_notif', 'App\Http\Controllers\Dashboard\EmailNotificationsController@saveUpdatedEmailNotif');
Route::post('/delete_email_notif', 'App\Http\Controllers\Dashboard\EmailNotificationsController@deleteEmailNotif');

// Subscription Contacts
Route::get('/get_contacts/{custoId}', 'App\Http\Controllers\Dashboard\SubsContactsController@index');
Route::get('/subs_contacts_datatable/{custoId}', 'App\Http\Controllers\Dashboard\SubsContactsController@subsContactsDataTable');
Route::post('/add_subs_contact', 'App\Http\Controllers\Dashboard\SubsContactsController@addSubsContact');

// Filter AO
Route::post('/filter_ao_by_bu', 'App\Http\Controllers\Dashboard\FilterSelectController@filterAo');
// Filter SO
Route::get('/filter_by_so_number/{soNumber}', 'App\Http\Controllers\Dashboard\FilterSelectController@filterBySoNumber');

// Email Recipients
Route::get('/load_email_recipients', 'App\Http\Controllers\Dashboard\EmailRecipientsController@index');
Route::get('/email_recipients_datatable', 'App\Http\Controllers\Dashboard\EmailRecipientsController@emailRecipientsDataTable');
Route::get('/get_email_recipients_list/{nId}', 'App\Http\Controllers\Dashboard\EmailRecipientsController@getEmailRecipientsList');
Route::post('/add_email_recipient', 'App\Http\Controllers\Dashboard\EmailRecipientsController@addEmailRecipient');
Route::post('/delete_email_recipient', 'App\Http\Controllers\Dashboard\EmailRecipientsController@deleteEmailRecipient');

// Live Search
Route::get('/search_from_crm/{keyWord}', 'App\Http\Controllers\Dashboard\SearchResultsController@index');
Route::get('/live_search_datatable/{keyWord}', 'App\Http\Controllers\Dashboard\SearchResultsController@liveSearchDataTable');

// Import and Export Data Excel File to Database
Route::get('/import_export_data', [UserController::class, 'importView'])->name('import-view');
Route::post('/import', [UserController::class, 'import'])->name('import');
Route::get('/export', [UserController::class, 'exportUsers'])->name('export-users');

// Runner Select
Route::get('/select', 'App\Http\Controllers\Dashboard\ManageSubscriptionController@select');
Route::get('/runner', 'App\Http\Controllers\Dashboard\ManageSubscriptionController@runner');

// Google Auth 
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Assign PM
Route::get('/manage_pm', 'App\Http\Controllers\Dashboard\ManagePMController@index');
Route::get('/pm_datatables', 'App\Http\Controllers\Dashboard\ManagePMController@pmDataTable');

