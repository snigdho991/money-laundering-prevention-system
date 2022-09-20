<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Cms\RoleController;
use App\Http\Controllers\Cms\AdminToolsController;
use App\Http\Controllers\Cms\ThemeController;
use App\Http\Controllers\Ums\AgencyController;
use App\Http\Controllers\Ums\AdministratorController;

use App\Http\Controllers\Cms\AgencyToolsController;
use App\Http\Controllers\Ums\CompanyController;
use App\Http\Controllers\Ums\CustomerController;

use App\Http\Controllers\Cms\TransactionController;
use App\Http\Controllers\Cms\TransactionStatusController;
use App\Http\Controllers\Ums\TransactionHistoryController;


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

Route::middleware(['guest'])->get('/', function () {
    return view('auth.login');
});

//Route::get('/generate-role', [RoleController::class, 'generate_role'])->name('generate.role');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::post('/save-theme', [ThemeController::class, 'select_theme'])->name('select.theme');
		
	Route::group(['prefix' => 'administrator'], function(){
		Route::get('/dashboard', [AdminToolsController::class, 'dashboard'])->name('dashboard');
		Route::resource('agency', AgencyController::class);
		Route::resource('admin', AdministratorController::class);
		Route::get('/change-logo', [AdminToolsController::class, 'apps_settings'])->name('apps.settings');
		Route::post('/upload-logo', [AdminToolsController::class, 'upload_logo'])->name('upload.logo');
        Route::post('/ban/{id}/user/', [AdminToolsController::class, 'ban_user'])->name('ban.user');
        Route::post('/unban/{id}/user/', [AdminToolsController::class, 'unban_user'])->name('unban.user');

        Route::get('/send-email', [AdminToolsController::class, 'send_email'])->name('send.email');
        Route::any('/email-to-agencies', [AdminToolsController::class, 'email_to_agencies'])->name('email.to.agencies');
	});

	Route::group(['prefix' => 'agency'], function(){
		Route::get('/dashboard', [AgencyToolsController::class, 'agency_dashboard'])->name('agency.dashboard');
		Route::resource('company', CompanyController::class);
		Route::resource('customer', CustomerController::class);
        Route::get('/search-customer-phone', [AgencyToolsController::class, 'search_customer_by_phone'])->name('search.customer.by.phone');
        Route::get('/change-agency-logo', [AgencyToolsController::class, 'change_agency_logo'])->name('change.agency.logo');
        Route::post('/upload-agency-logo', [AgencyToolsController::class, 'upload_agency_logo'])->name('upload.agency.logo');

        Route::get('/monthly-limit', [AgencyToolsController::class, 'set_monthly_limit'])->name('set.monthly.limit');
        Route::post('/update-monthly-limit', [AgencyToolsController::class, 'update_monthly_limit'])->name('update.limit');
	});

	Route::group(['prefix' => 'transaction', 'as' => 'transaction.'], function(){

    	Route::get('/get-started/{id}', [TransactionController::class, 'getstarted'])->name('getstarted');
    	Route::get('/{id}/cheque', [TransactionController::class, 'cheque'])->name('cheque');
    	Route::get('/{id}/wire-money', [TransactionController::class, 'wire_money'])->name('wiremoney');
    	Route::post('/send-wiremoney', [TransactionController::class, 'send_wiremoney'])->name('send.wiremoney');
    	Route::post('/send-cheque', [TransactionController::class, 'send_cheque'])->name('send.cheque');
    	Route::get('/manage/{transaction_id}', [TransactionController::class, 'manage_transaction'])->name('manage');
    });

	Route::group(['prefix' => 'transaction-status', 'as' => 'transaction.status.'], function(){
    	Route::get('/cheque', [TransactionStatusController::class, 'my_cheque_transactions'])->name('cheque');
    	Route::get('/wire-money', [TransactionStatusController::class, 'my_wire_transactions'])->name('wire');
    });

    Route::group(['prefix' => 'reports', 'as' => 'report.'], function(){
        Route::get('/this-month', [TransactionHistoryController::class, 'this_month'])->name('this.month');
        Route::get('/this-week', [TransactionHistoryController::class, 'this_week'])->name('this.week');
        Route::get('/this-year', [TransactionHistoryController::class, 'this_year'])->name('this.year');
        Route::get('/advanced-search', [TransactionHistoryController::class, 'advanced_search'])->name('advanced.search');
    });

});
