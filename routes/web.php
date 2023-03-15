<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\SiteController;
use App\HTTP\Controllers\HomeController;
use App\HTTP\Controllers\DashboardController;
use App\HTTP\Controllers\User\ProfileController;
use App\HTTP\Controllers\User\InvestmentPlanController;
use App\HTTP\Controllers\User\MyInvestmentController;
use App\HTTP\Controllers\User\MyDepositController;
use App\HTTP\Controllers\User\WithdrawController;

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
   Route::resource('investment', InvestmentPlanController::class);
   Route::resource('deposit', Controllers\User\DepositController::class);

   Route::get('myinvestment', [MyInvestmentController::class, 'showInvestLog'])->name('myinvestment');
   Route::get('deposit_log', [MyDepositController::class, 'showDepositLog'])->name('deposit_log');

   Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw');
   Route::get('/withdraw/fetch/{id}', [WithdrawController::class, 'fetch'])->name('fetch_withdraw');
   Route::get('/withdraw/log', [WithdrawController::class, 'log'])->name('withdraw_log');
   Route::get('/withdraw/log', [WithdrawController::class, 'log'])->name('withdraw_log');
   Route::get('/withdraw/all', [WithdrawController::class, 'all'])->name('withdraw_all');
   Route::get('/withdraw/pending', [WithdrawController::class, 'pending'])->name('withdraw_pending');
   Route::get('/withdraw/complete', [WithdrawController::class, 'complete'])->name('withdraw_complete');

   Route::get('/transactions/log', [TransactionController::class, 'index'])->name('transaction_log');

   Route::get('/referral/log', [ReferralController::class, 'index'])->name('referral_log');

   // Route::get('/support', [SupportController::class, 'index'])->name('support');

});

//Route::get('/', [SiteController::class, 'index'])->name('home');
//Route::get('changeLang', [SiteController::class, 'changeLang'])->name('user.changeLang');
//Route::get('blogs', [SiteController::class, 'allblog'])->name('allblog');
//Route::get('blog/{id}/{slug}', [SiteController::class, 'blog'])->name('blog');
//Route::post('blog/comment/{id}', [SiteController::class, 'blogComment'])->name('blogcomment');
//Route::get('investment/calculate/{id}', [DashboardController::class, 'investmentCalculate'])->name('user.investmentcalculate');
//Route::post('subscribe', [DashboardController::class, 'subscribe'])->name('subscribe');

//Route::get('{pages}', [SiteController::class, 'page'])->name('pages');
//Route::get('service/{slug}', [SiteController::class, 'service'])->name('service');
//Route::get('return/interest', [UserController::class, 'returnInterest'])->name('returninterest');

//Route::get('privacy/policy', [SiteController::class, 'privacyPolicy'])->name('privacy');
