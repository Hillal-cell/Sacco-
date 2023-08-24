<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});





use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UpdateLoanStatus;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SaccoLoansController;
use App\Http\Controllers\SaccoIssuesController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\SaccoMembersController;
use App\Http\Controllers\SaccoDepositsController; 
use App\Http\Middleware\RevalidateBackHistory;
use App\Http\Controllers\SaccoLoanRequestsController; 
use App\Http\Controllers\ReportController;

   
            

//Route::get('/admin', function () {return redirect('/login');})->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

	Route::get('/members', [SaccoMembersController::class, 'members'])->name('saccomembers');
	Route::get('/deposits', [SaccoDepositsController::class, 'deposits'])->name('deposits');
	Route::get('/loanrequest', [SaccoLoanRequestsController::class, 'LoanRequests'])->name('LoanRequets');
	Route::get('/issues', [SaccoIssuesController::class, 'issues'])->name('issues');
	Route::post('/CSVdepositsupload', [SaccoDepositsController::class, 'upload'])->name('CSVdepositsupload');
	Route::get('/depositsearch', [SaccoDepositsController::class, 'searchDeposit'])->name('searchDeposit');
	Route::post('/CSVmemberupload', [SaccoMembersController::class, 'upload'])->name('CSVmemberupload');
	Route::get('/admin', [HomeController::class, 'index'])->name('home');
	Route::get('/activeloans', [SaccoLoansController::class, 'Loans'])->name('activeloans');

	Route::put('/update-loan-status/{loanId}', [UpdateLoanStatus::class, 'updateLoanStatus'])->name('update loan status');


	Route::get('/search', [SearchController::class, 'search'])->name('search');

	//Route::get('/generate-PDF', [ReportController::class, 'generatePDF']);

	Route::get('/mail',[ReportController::class,'generatePDF'])->name('mail');	

	Route::post('/logout', [LoginController::class,'logout'])->name('logout');
	

});




//routes without middlewares
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');





Route::post('/login', [LoginController::class, 'login'])->name('login.perform');





Route::group(['middleware' => 'guest'], function () {
	
	
	
	Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');
	Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');




});






Route::group(['middleware' => 'auth'], function () {


	
	
	
	
	
	//
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	//Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});