<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/user-login',[LoginController::class,'userlogin'])->name('user.login');
Route::get('/register',[RegisterController::class,'register'])->name('register');
Route::post('/registration',[RegisterController::class,'registration'])->name('registration');
Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::get('/edit-profile/{id}',[ProfileController::class,'editprofile'])->name('profile.edit');
Route::post('/update-profile',[ProfileController::class,'updateprofile'])->name('profile.update');
Route::post('/update-admin',[ProfileController::class,'updateadminprofile'])->name('profile.updateadmin');
Route::post('/update-password',[ProfileController::class,'updatepassword'])->name('profile.updatepassword');
Route::post('/update-security-pin',[ProfileController::class,'updatesecuritypin'])->name('securitypin.update');
Route::get('/deposit',[TransactionController::class,'deposit'])->name('deposit');
Route::post('/amount-deposit',[TransactionController::class,'amountdeposit'])->name('deposit.depositamount');
Route::get('/withdraw',[TransactionController::class,'withdraw'])->name('withdraw');
Route::post('/amount-withdraw',[TransactionController::class,'amountwithdraw'])->name('withdraw.amount');
Route::get('/transfer',[TransactionController::class,'transfer'])->name('transfer');
Route::post('/amount-transfer',[TransactionController::class,'amounttransfer'])->name('transfer.amount');
Route::get('/statements',[TransactionController::class,'statements'])->name('statements');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::get('/users', [ProfileController::class,'users'])->name('users');
Route::get('/reset-security-pin', [ProfileController::class,'resetsecuritypin'])->name('security_pin.reset');
