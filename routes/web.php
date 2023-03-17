<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\SiteController;
use App\HTTP\Controllers\HomeController;
use App\HTTP\Controllers\DashboardController;
use App\HTTP\Controllers\User\ProfileController;
use App\HTTP\Controllers\User\InvestmentPlanController;
use App\HTTP\Controllers\User\MyInvestmentController;
use App\HTTP\Controllers\User\DepositController;
use App\HTTP\Controllers\User\MyDepositController;
use App\HTTP\Controllers\User\WithdrawController;
use App\Http\Controllers\TicketController;

use App\HTTP\Controllers\User\TransactionController;
use App\HTTP\Controllers\User\ReferralController;
// use App\HTTP\Controllers\User\Support; to creae this
use App\Http\Controllers;
use App\Models\InvestmentPlan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $plans = InvestmentPlan::where('status', 'active')->get();
    return view('theme2.home', compact('plans'));
});

// Route::get('/register/{ref_id}', [Controllers\Auth\RegisterController::class, 'register']);

Auth::routes();

Route::get('/user/dashboard', [HomeController::class, 'index'])->name('home');
// Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('investment/plan', [SiteController::class, 'allInvestmentPlan'])->name('investmentplan');
Route::get('faq', [SiteController::class, 'faq'])->name('faq');
Route::get('terms', [SiteController::class, 'terms'])->name('terms');
Route::get('contact', [SiteController::class, 'contact'])->name('contact');
Route::post('contact', [SiteController::class, 'contactSend']);

Route::prefix('user')->middleware('auth')->group(function ()
{
   Route::resource('settings', ProfileController::class);

   Route::get('profile/change/password', [SiteController::class, 'changePassword'])->name('change.password');
   Route::post('profile/change/password', [SiteController::class, 'updatePassword'])->name('update.password');

   Route::resource('investment', InvestmentPlanController::class);
    Route::post('investmentplan/invest', [MyInvestmentController::class, 'investmentUsingBalannce'])->name('investmentUsingBalannce');
    Route::post('investmentplan/invest/{id}/details', [MyInvestmentController::class, 'paynow'])->name('investDetails');
    Route::get('myinvestment', [MyInvestmentController::class, 'showInvestLog'])->name('myinvestment');
    
   /*Deposit Routes*/
   Route::get('deposit', [DepositController::class, 'index'])->name('deposit.index');
   Route::post('deposit/gateway/{id}/details', [DepositController::class, 'paynow'])->name('deposit.paynow');
   Route::post('deposit/completePayment', [DepositController::class, 'completePayment'])->name('deposit.complete');
   Route::get('deposit_log', [MyDepositController::class, 'showDepositLog'])->name('deposit_log');

   
   

   Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw');
   Route::get('/withdraw/fetch/{id}', [WithdrawController::class, 'fetch'])->name('fetch_withdraw');
   Route::post('/withdraw', [WithdrawController::class, 'withdraw']);
   Route::get('/withdraw/all', [WithdrawController::class, 'all'])->name('withdraw_log');
   
   // Route::get('/withdraw/', [WithdrawController::class, ''])->name('withdraw_all');
   Route::get('/withdraw/pending', [WithdrawController::class, 'pending'])->name('withdraw_pending');
   Route::get('/withdraw/complete', [WithdrawController::class, 'complete'])->name('withdraw_complete');

   Route::get('/transactions/log', [TransactionController::class, 'index'])->name('transaction_log');

   Route::get('/referral/log', [ReferralController::class, 'index'])->name('referral_log');

   Route::resource('ticket', TicketController::class);
   Route::post('ticket/reply', [TicketController::class, 'reply'])->name('ticket.reply');
   Route::get('ticket/reply/status/change/{id}', [TicketController::class, 'statusChange'])->name('ticket.status-change');

   Route::get('ticket/status/{status}', [TicketController::class, 'ticketStatus'])->name('ticket.status');

   Route::get('ticket/attachement/{id}', [TicketController::class, 'ticketDownload'])->name('ticket.download');

});


