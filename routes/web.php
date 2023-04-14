<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerficationController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Superadmin\EventController;
use App\Http\Controllers\PasswordManagementController;
use App\Http\Controllers\Superadmin\ClassController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\MasterClassController;
use App\Http\Controllers\Superadmin\StudentController;
use App\Http\Controllers\Superadmin\VoucherController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\User\ClassController as UserClassController;
use App\Http\Controllers\User\MasterClassController as UserMasterClassController;

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

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'verified', 'role:mentor|mentee'])->group(function () {
    Route::get('/index', function () {
        return view('dashboard.index');
    })->name('index');
});

Route::name('landing-page.')->group(function () {
    Route::get('/', [LandingPageController::class, 'index'])->name('index');

    Route::middleware(['auth', 'verified', 'role:mentee|user'])->group(function () {
        Route::prefix('transaction')->name('transaction.')->group(function () {
            Route::get('/{id}', [TransactionController::class, 'checkout'])->name('checkout');
            Route::post('create', [TransactionController::class, 'create'])->name('create');
            Route::post('callback', [TransactionController::class, 'callback'])->name('callback');
            Route::get('return', [TransactionController::class, 'return'])->name('return');
            Route::get('check', [TransactionController::class, 'transactionCheck'])->name('check');
            Route::get('history', [TransactionController::class, 'history'])->name('history');
            Route::post('voucher', [TransactionController::class, 'getVoucher'])->name('get-voucher');
        });

        Route::prefix('master-class')->name('master-class.')->group(function () {
            Route::get('/', [UserMasterClassController::class, 'index'])->name('index');
            Route::get('{id}/show', [UserMasterClassController::class, 'show'])->name('show');
        });

        Route::prefix('class')->name('class.')->group(function(){
            Route::get('/', [UserClassController::class, 'index'])->name('index');
        });
    });
});

Route::prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('login', [AuthController::class, 'superadminLogin'])->name('login');
    Route::post('login', [AuthController::class, 'storeLoginSuperadmin'])->name('login.store');

    Route::middleware(['auth', 'verified', 'role:superadmin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('events')->name('events.')->group(function () {
            Route::get('/', [EventController::class, 'index'])->name('index');
            Route::get('create', [EventController::class, 'create'])->name('create');
            Route::post('post', [EventController::class, 'store'])->name('store');
            Route::get('{id}/edit', [EventController::class, 'edit'])->name('edit');
            Route::put('{id}/edit', [EventController::class, 'update'])->name('update');
            Route::put('{id}/status', [EventController::class, 'changeStatus'])->name('status');
            Route::delete('{id}/delete', [EventController::class, 'delete'])->name('delete');
        });

        Route::prefix('master-class')->name('master-class.')->group(function () {
            Route::get('/', [MasterClassController::class, 'index'])->name('index');
            Route::get('create', [MasterClassController::class, 'create'])->name('create');
            Route::post('create', [MasterClassController::class, 'store'])->name('store');
            Route::get('{id}/edit', [MasterClassController::class, 'edit'])->name('edit');
            Route::put('{id}/edit', [MasterClassController::class, 'update'])->name('update');
            Route::put('{id}/status', [MasterClassController::class, 'changeStatus'])->name('status');
            Route::delete('{id}/delete', [MasterClassController::class, 'delete'])->name('delete');
        });

        Route::prefix('class')->name('class.')->group(function () {
            Route::get('/', [ClassController::class, 'index'])->name('index');
            Route::get('create', [ClassController::class, 'create'])->name('create');
            Route::post('create', [ClassController::class, 'store'])->name('store');
            Route::put('{id}/status', [ClassController::class, 'changeStatus'])->name('status');
            Route::delete('{id}/delete', [ClassController::class, 'delete'])->name('delete');
            Route::get('{id}/edit', [ClassController::class, 'edit'])->name('edit');
            Route::put('{id}/edit', [ClassController::class, 'update'])->name('update');
        });

        Route::prefix('students')->name('students.')->group(function () {
            Route::get('{class_id}', [StudentController::class, 'index'])->name('index');
            Route::post('{class_id}/store', [StudentController::class, 'addStudents'])->name('store');
            Route::put('{class_id}/{user_id}/status', [StudentController::class, 'changeStatus'])->name('status');
            Route::delete('{class_id}/{user_id}/delete', [StudentController::class, 'delete'])->name('delete');
        });

        Route::prefix('vouchers')->name('vouchers.')->group(function(){
            Route::get('/', [VoucherController::class, 'index'])->name('index');
            Route::get('create', [VoucherController::class, 'create'])->name('create');
            Route::post('create', [VoucherController::class, 'store'])->name('store');
            Route::get('{id}/edit', [VoucherController::class, 'edit'])->name('edit');
            Route::put('{id}/edit', [VoucherController::class, 'update'])->name('update');
            Route::put('{id}/status', [VoucherController::class, 'updateStatus'])->name('status');
            Route::delete('{id}/delete', [VoucherController::class, 'delete'])->name('delete');
        });
    });
});

Route::get('/email/verify', [EmailVerficationController::class, 'sendVerificationEmail'])->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerficationController::class, 'emailVerification'])->middleware(['signed', 'auth'])->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerficationController::class, 'resendEmail'])->name('verification.send');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'storeLogin'])->name('login.store');

Route::get('test-attach', [TransactionController::class, 'testAttach'])->name('create');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'storeRegister'])->name('register.store');

Route::get('forgot-password', [PasswordManagementController::class, 'requestForm'])->name('forgot-password');
Route::post('forgot-password', [PasswordManagementController::class, 'storeRequest'])->name('forgot-password.store');
Route::get('reset-password/{token}', [PasswordManagementController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('reset-passsword', [PasswordManagementController::class, 'resetPasswordStore'])->name('password.update');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
