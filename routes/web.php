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

Route::get('/a', function () {
$data['title'] = 'Contact Message';
$data['subject'] = "How can i invest";
$data['name'] = "Adolphus Mira";
$data['message'] = "Good day, how are you";
$data['email'] = "excell66@yahoo.com";
$data['password'] = "excell66@yahoo.com";
// $data['email'] = env('MAIL_FROM_ADDRESS');
$data['type'] = "contact";
   $user_referral_id = "Miracle";
   $domain = URL::to('/');
            $url = $domain.'/register?ref='.$user_referral_id;
            $datas['url']  = $url;
            $datas['name'] = $data['name'];
            $datas['email'] = $data['email'];
            $datas['password'] = $data['password'];
            $datas['title'] = 'Testing Details';
            try {
                Mail::send('email.testMail', ['datas' => $datas], function($message) use($datas){
                    $message->to("miraboy13@gmail.com")->subject($datas['title']);
                });
                return 'yes';
            } catch(Exception $e){
                echo 'Message: ' . $e->getMessage();
                return 'no';
            }
    // return view('email.admin', compact('data'));
});
//Route to Update Language
Route::get('lang/change', [Controllers\LangController::class, 'change'])->name('changeLang');
/*Routes For the Admin*/

Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function(){
   Route::get('dashboard', [Controllers\Admin\HomeController::class, 'dashboard'])->name('home');
   Route::get('logout', [Controllers\Admin\AdminController::class, 'logout'])->name('logout');

  Route::get('profile', [Controllers\Admin\AdminController::class, 'profile'])->name('profile');

  Route::post('profile', [Controllers\Admin\AdminController::class, 'profileUpdate'])->name('profile.update');

  Route::post('change/password', [Controllers\Admin\AdminController::class, 'changePassword'])->name('change.password');

  Route::get('search/filter', [Controllers\Admin\AdminController::class, 'tableFilter'])->name('table.filter');

  Route::resource('gateway', Controllers\Admin\DynamicGatewayController::class);
  Route::get('gateway/delete/{id}', [Controllers\Admin\DynamicGatewayController::class, 'deleteGateway'])->name('gateway.deleteGateway');

  // Manage users Investment
     Route::get('users/investment',[Controllers\Admin\ManageInvestmentController::class, 'index'])->name('investment');
     Route::get('users/investment/details/{trx}',[Controllers\Admin\ManageInvestmentController::class, 'investment_details'])->name('investment.details');
     Route::get('investment/payments/accept/{trx}', [Controllers\Admin\ManageInvestmentController::class, 'depositAccept'])->name('investment.accept');
      Route::get('investment/payments/reject/{trx}', [Controllers\Admin\ManageInvestmentController::class, 'depositReject'])->name('investment.reject');

   // To later add another middleware that will restrict anyone who is not admin from modifying
   Route::resource('plan', Controllers\Admin\PlanController::class);
   Route::post('plan/changestatus/{id}', [Controllers\Admin\PlanController::class, 'planStatusChange'])->name('plan.changestatus');
   Route::get('plan/{id}/destroy',[Controllers\Admin\PlanController::class, 'delete'])->name('plan.delete');

   /*Users Manahement*/
   Route::get('users', [Controllers\Admin\ManageUserController::class, 'index'])->name('user');
   Route::get('users/details/{user}', [Controllers\Admin\ManageUserController::class, 'userDetails'])->name('user.details');
   Route::post('users/update/{user}', [Controllers\Admin\ManageUserController::class, 'userUpdate'])->name('user.update');
   Route::post('users/balance/{user}', [Controllers\Admin\ManageUserController::class, 'userBalanceUpdate'])->name('user.balance.update');
   Route::post('users/mail/{user}', [Controllers\Admin\ManageUserController::class, 'sendUserMail'])->name('user.mail');
   Route::get('users/search', [Controllers\Admin\ManageUserController::class, 'index'])->name('user.search');
   Route::get('login/user/{id}', [Controllers\Admin\ManageUserController::class, 'loginAsUser'])->name('login.user');

   /*MAnage Deposit*/
   Route::get('deposit/log/{user?}', [Controllers\Admin\ManageGatewayController::class, 'depositLog'])->name('deposit.log');
   Route::get('deposit/payments/{trx}', [Controllers\Admin\ManageGatewayController::class, 'depositDetails'])->name('deposit.trx');
   Route::post('deposit/payments/accept/{trx}', [Controllers\Admin\ManageGatewayController::class, 'depositAccept'])->name('deposit.accept');
   Route::post('deposit/payments/reject/{trx}', [Controllers\Admin\ManageGatewayController::class, 'depositReject'])->name('deposit.reject');

   /*Withdraw Management*/

      Route::get('viewgateway', [Controllers\Admin\ManageWithdrawController::class, 'index'])->name('withdraw');
      Route::get('withdraw/method/search', [Controllers\Admin\ManageWithdrawController::class, 'index'])->name('withdraw.search');
      Route::post('withdraw/method', [Controllers\Admin\ManageWithdrawController::class, 'withdrawMethodCreate']);
      Route::post('withdraw/edit/{method}', [Controllers\Admin\ManageWithdrawController::class, 'withdrawMethodUpdate'])->name('withdraw.update');
      Route::post('withdraw/delete/{method}', [Controllers\Admin\ManageWithdrawController::class, 'withdrawMethodDelete'])->name('withdraw.delete');
      Route::get('withdraw/pending', [Controllers\Admin\ManageWithdrawController::class, 'pending'])->name('withdraw.pending');
      Route::get('withdraw/accepted', [Controllers\Admin\ManageWithdrawController::class, 'accepted'])->name('withdraw.accepted');
      Route::get('withdraw/rejected', [Controllers\Admin\ManageWithdrawController::class, 'rejected'])->name('withdraw.rejected');
      Route::post('withdraw/accept/{withdraw}', [Controllers\Admin\ManageWithdrawController::class, 'withdrawAccept'])->name('withdraw.accept');
      Route::post('withdraw/reject/{withdraw}', [Controllers\Admin\ManageWithdrawController::class, 'withdrawReject'])->name('withdraw.reject');


   /*Manage Payment Method*/
   Route::get('manual/payments', [Controllers\Admin\ManageGatewayController::class, 'manualPayment'])->name('manual');
   Route::get('manual/payments/{trx}', [Controllers\Admin\ManageGatewayController::class, 'manualPaymentDetails'])->name('manual.trx');
   Route::post('manual/payments/accept/{trx}', [Controllers\Admin\ManageGatewayController::class, 'manualPaymentAccept'])->name('manual.accept');
   Route::post('manual/payments/reject/{trx}', [Controllers\Admin\ManageGatewayController::class, 'manualPaymentReject'])->name('manual.reject');
   Route::get('{status}/payments', [Controllers\Admin\ManageGatewayController::class, 'manualPayment'])->name('manual.status');

   /*Manage Referral*/
   Route::resource('referral', Controllers\Admin\ReferralController::class);
   Route::post('invest/referral', [Controllers\Admin\ReferralController::class, 'investStore'])->name('invest.store');
   Route::post('interest/referral', [Controllers\Admin\ReferralController::class, 'interestStore'])->name('interest.store');
   Route::post('/referral/status/{id}', [Controllers\Admin\ReferralController::class, 'refferalStatusChange'])->name('refferalstatus');

   /* Manage Tickets*/
    Route::get('pendingList', [Controllers\Admin\AdminTicketController::class, 'pendingList'])->name('ticket.pendingList');
   Route::post('ticket/reply', [Controllers\Admin\AdminTicketController::class, 'reply'])->name('ticket.reply');
   Route::resource('ticket', Controllers\Admin\AdminTicketController::class);

   /*Manage Settings*/
   Route::get('general/setting', [Controllers\Admin\GeneralSettingController::class, 'index'])->name('general.setting');
   Route::post('general/setting', [Controllers\Admin\GeneralSettingController::class, 'generalSettingUpdate']);
   Route::get('general/preloader', [Controllers\Admin\GeneralSettingController::class, 'preloader'])->name('general.preloader');
   Route::post('general/preloader', [Controllers\Admin\GeneralSettingController::class, 'preloaderUpdate']);
   Route::get('general/analytics', [Controllers\Admin\GeneralSettingController::class, 'analytics'])->name('general.analytics');
   Route::post('general/analytics', [Controllers\Admin\GeneralSettingController::class, 'analyticsUpdate']);
   Route::get('general/cookie/consent', [Controllers\Admin\GeneralSettingController::class, 'cookieConsent'])->name('general.cookie');
   Route::post('general/cookie/consent', [Controllers\Admin\GeneralSettingController::class, 'cookieConsentUpdate']);
   Route::get('general/google/recaptcha', [Controllers\Admin\GeneralSettingController::class, 'recaptcha'])->name('general.recaptcha');
   Route::post('general/google/recaptcha', [Controllers\Admin\GeneralSettingController::class, 'recaptchaUpdate']);
   Route::get('general/live/chat', [Controllers\Admin\GeneralSettingController::class, 'liveChat'])->name('general.live.chat');
   Route::post('general/live/chat', [Controllers\Admin\GeneralSettingController::class, 'liveChatUpdate']);
   Route::get('cacheclear', [Controllers\Admin\GeneralSettingController::class, 'cacheClear'])->name('general.cacheclear');
   Route::get('general/seo/manage', [Controllers\Admin\GeneralSettingController::class, 'seoManage'])->name('general.seo');
   Route::post('general/seo/manage', [Controllers\Admin\GeneralSettingController::class, 'seoManageUpdate']);
   /*Email Management*/
   // Route::get('email/config', [Controllers\Admin\EmailTemplateController::class, 'emailConfig'])->name('email.config');
   // Route::post('email/config', [Controllers\Admin\EmailTemplateController::class, 'emailConfigUpdate']);
   // Route::get('email/templates', [Controllers\Admin\EmailTemplateController::class, 'emailTemplates'])->name('email.templates');
   // Route::get('email/templates/{template}', [Controllers\Admin\EmailTemplateController::class, 'emailTemplatesEdit'])->name('email.templates.edit');
   // Route::post('email/templates/{template}', [Controllers\Admin\EmailTemplateController::class, 'emailTemplatesUpdate']);

   /*Manage Reports*/
    Route::get('transaction-log/{user?}', [Controllers\Admin\HomeController::class, 'transaction'])->name('transaction');
   Route::get('payment-report/{user?}', [Controllers\Admin\ReportController::class, 'paymentReport'])->name('payment.report');
   Route::get('withdraw-report/{user?}', [Controllers\Admin\ReportController::class, 'withdarawReport'])->name('withdraw.report');

   // Route::get('money/transfer/log', [Controllers\Admin\HomeController::class, 'MoneyTransfer'])->name('money.log');

   /*Logs might not use this*/
   // Route::get('user/interest/log/{user?}', [ManageUserController::class, 'interestLog'])->name('user.interestlog');
   // Route::get('commision/{user?}', [ReferralController::class, 'Commision'])->name('commision');
});


Auth::routes();

Route::get('/user/dashboard', [Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/about', [Controllers\SiteController::class, 'about'])->name('about');
Route::get('investment/plan', [Controllers\SiteController::class, 'allInvestmentPlan'])->name('investmentplan');
Route::get('faq', [Controllers\SiteController::class, 'faq'])->name('faq');
Route::get('terms', [Controllers\SiteController::class, 'terms'])->name('terms');
Route::get('contact', [Controllers\SiteController::class, 'contact'])->name('contact');
Route::post('contact', [Controllers\SiteController::class, 'sendMessage']);

Route::post('contact', [Controllers\SiteController::class, 'sendMessage']);
Route::get('investment/calculate/{id}', [Controllers\SiteController::class, 'investmentCalculate'])->name('investmentcalculate');

Route::prefix('user')->middleware('auth')->group(function ()
{
   Route::resource('settings', Controllers\User\ProfileController::class);

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

   // Route::get('/transactions/log', [Controllers\TransactionController::class, 'index'])->name('transaction_log');

   Route::get('/referral/log', [Controllers\User\ReferralController::class, 'index'])->name('referral_log');

   Route::resource('ticket', Controllers\TicketController::class);
   Route::post('ticket/reply', [Controllers\TicketController::class, 'reply'])->name('ticket.reply');
   Route::get('ticket/reply/status/change/{id}', [Controllers\TicketController::class, 'statusChange'])->name('ticket.status-change');

   Route::get('ticket/status/{status}', [Controllers\TicketController::class, 'ticketStatus'])->name('ticket.status');

   Route::get('ticket/attachement/{id}', [Controllers\TicketController::class, 'ticketDownload'])->name('ticket.download');

});
