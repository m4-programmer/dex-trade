<?php
/*I had to make use of the use App\Http\Controllers; only to resolve the error of Target class does not exist*/
use Illuminate\Support\Facades\Route;

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

Route::get('/user/dashboard', [Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/about', [Controllers\SiteController::class, 'about'])->name('about');
Route::get('investment/plan', [Controllers\SiteController::class, 'allInvestmentPlan'])->name('investmentplan');
Route::get('faq', [Controllers\SiteController::class, 'faq'])->name('faq');
Route::get('terms', [Controllers\SiteController::class, 'terms'])->name('terms');
Route::get('contact', [Controllers\SiteController::class, 'contact'])->name('contact');
Route::post('contact', [Controllers\SiteController::class, 'contactSend']);

Route::prefix('user')->middleware('auth')->group(function ()
{
   Route::resource('settings', \[Controllers\User\ProfileController::class);

   Route::get('profile/change/password', [Controllers\SiteController::class, 'changePassword'])->name('change.password');
   Route::post('profile/change/password', [Controllers\SiteController::class, 'updatePassword'])->name('update.password');

   Route::resource('investment', Controllers\User\InvestmentPlanController::class);
    Route::post('investmentplan/invest', [Controllers\User\MyInvestmentController::class, 'investmentUsingBalannce'])->name('investmentUsingBalannce');
    Route::post('investmentplan/invest/{id}/details', [Controllers\User\MyInvestmentController::class, 'paynow'])->name('investDetails');
    Route::get('myinvestment', [Controllers\User\MyInvestmentController::class, 'showInvestLog'])->name('myinvestment');
    
   /*Deposit Routes*/
   Route::get('deposit', [Controllers\User\DepositController::class, 'index'])->name('deposit.index');
   Route::post('deposit/gateway/{id}/details', [Controllers\User\DepositController::class, 'paynow'])->name('deposit.paynow');
   Route::post('deposit/completePayment', [Controllers\User\DepositController::class, 'completePayment'])->name('deposit.complete');
   Route::get('deposit_log', [Controllers\User\MyDepositController::class, 'showDepositLog'])->name('deposit_log');

   
   

   Route::get('/withdraw', [Controllers\User\WithdrawController::class, 'index'])->name('withdraw');
   Route::get('/withdraw/fetch/{id}', [Controllers\User\WithdrawController::class, 'fetch'])->name('fetch_withdraw');
   Route::post('/withdraw', [Controllers\User\WithdrawController::class, 'withdraw']);
   Route::get('/withdraw/all', [Controllers\User\WithdrawController::class, 'all'])->name('withdraw_log');
   
   // Route::get('/withdraw/', [WithdrawController::class, ''])->name('withdraw_all');
   Route::get('/withdraw/pending', [Controllers\User\WithdrawController::class, 'pending'])->name('withdraw_pending');
   Route::get('/withdraw/complete', [Controllers\User\WithdrawController::class, 'complete'])->name('withdraw_complete');

   Route::get('/transactions/log', [Controllers\TransactionController::class, 'index'])->name('transaction_log');

   Route::get('/referral/log', [Controllers\User\ReferralController::class, 'index'])->name('referral_log');

   Route::resource('ticket', Controllers\TicketController::class);
   Route::post('ticket/reply', [Controllers\TicketController::class, 'reply'])->name('ticket.reply');
   Route::get('ticket/reply/status/change/{id}', [Controllers\TicketController::class, 'statusChange'])->name('ticket.status-change');

   Route::get('ticket/status/{status}', [Controllers\TicketController::class, 'ticketStatus'])->name('ticket.status');

   Route::get('ticket/attachement/{id}', [Controllers\TicketController::class, 'ticketDownload'])->name('ticket.download');

});
