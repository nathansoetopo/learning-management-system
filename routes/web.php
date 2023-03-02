<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerficationController;
use App\Http\Controllers\PasswordManagementController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::prefix('dashboard')->name('dashboard.')->middleware('auth', 'verified')->group(function () {
    Route::get('/index', function () {
        return view('dashboard.index');
    })->name('index');
});

Route::get('/email/verify', [EmailVerficationController::class, 'sendVerificationEmail'])->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerficationController::class, 'emailVerification'])->middleware(['signed', 'auth'])->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerficationController::class, 'resendEmail'])->name('verification.send');

Route::get('/', function () {
    return view('landing_page.index');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'storeLogin'])->name('login.store');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'storeRegister'])->name('register.store');

Route::get('forgot-password', [PasswordManagementController::class, 'requestForm'])->name('forgot-password');
Route::post('forgot-password', [PasswordManagementController::class, 'storeRequest'])->name('forgot-password.store');
Route::get('reset-password/{token}', [PasswordManagementController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('reset-passsword', [PasswordManagementController::class, 'resetPasswordStore'])->name('password.update');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');