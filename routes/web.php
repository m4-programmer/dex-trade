<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\SiteController;
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
    return view('theme2.home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('investment/plan', [SiteController::class, 'allInvestmentPlan'])->name('investmentplan');
Route::get('faq', [SiteController::class, 'faq'])->name('faq');
Route::get('terms', [SiteController::class, 'terms'])->name('terms');
Route::get('contact', [SiteController::class, 'contact'])->name('contact');
Route::post('contact', [SiteController::class, 'contactSend']);

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
