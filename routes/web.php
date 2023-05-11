<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerficationController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Mentee\AffiliateController;
use App\Http\Controllers\Mentee\ClassController as MenteeClassController;
use App\Http\Controllers\Mentee\DashboardController as MenteeDashboardController;
use App\Http\Controllers\Mentee\PresenceController;
use App\Http\Controllers\Mentee\TaskController as MenteeTaskController;
use App\Http\Controllers\Mentor\DashboardController as MentorDashboardController;
use App\Http\Controllers\Mentor\MaterialController;
use App\Http\Controllers\Mentor\PresensceController;
use App\Http\Controllers\Mentor\ScoreController;
use App\Http\Controllers\Mentor\TaskController;
use App\Http\Controllers\Superadmin\EventController;
use App\Http\Controllers\PasswordManagementController;
use App\Http\Controllers\Superadmin\AffiliateController as SuperadminAffiliateController;
use App\Http\Controllers\Superadmin\ClassController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\MasterClassController;
use App\Http\Controllers\SuperAdmin\MasterClassMaterialController;
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

Route::prefix('mentee')->name('mentee.')->middleware(['auth', 'verified', 'role:mentee'])->group(function () {
    Route::get('/', [MenteeDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/', [MenteeClassController::class, 'index'])->name('index');
        Route::get('{id}', [MenteeClassController::class, 'show'])->name('show');
    });

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [MenteeTaskController::class, 'index'])->name('index');
        Route::get('{id}/show', [MenteeTaskController::class, 'show'])->name('show');
        Route::post('{id}/submit', [MenteeTaskController::class, 'submit'])->name('submit');
    });

    Route::prefix('affiliate')->name('affiliate.')->group(function(){
        Route::get('/', [AffiliateController::class, 'track'])->name('index');
        Route::get('saldo-track', [AffiliateController::class, 'trackSaldo'])->name('saldo.track');
        Route::get('withdraw', [AffiliateController::class, 'withdraw'])->name('withdraw');
        Route::post('withdraw', [AffiliateController::class, 'storeWithdraw'])->name('withdraw');
    });

    Route::prefix('presence')->name('presence.')->group(function(){
        Route::get('/', [PresenceController::class, 'index'])->name('index');
        Route::put('{presence_id}', [PresenceController::class, 'presence'])->name('submit');
    });
});

Route::prefix('user')->name('user.')->middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::prefix('affiliate')->name('affiliate.')->group(function () {
        Route::get('/', [AffiliateController::class, 'index'])->name('index');
        Route::post('/', [AffiliateController::class, 'confirm'])->name('confirm');
        Route::get('list', [UserMasterClassController::class, 'forAffiliate'])->name('list');
        Route::post('list', [AffiliateController::class, 'claimClass'])->name('list.confirm');
    });
});

Route::prefix('mentor')->name('mentor.')->middleware(['auth', 'verified', 'role:mentor'])->group(function () {
    Route::get('/', [MentorDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('materials')->name('materials.')->group(function () {
        Route::get('/', [MaterialController::class, 'index'])->name('index');

        Route::prefix('{classId}')->group(function () {
            Route::get('/', [MaterialController::class, 'getListMaterial'])->name('list');

            Route::prefix('{id}')->group(function () {
                Route::get('show', [MaterialController::class, 'show'])->name('show');
                Route::get('create', [MaterialController::class, 'create'])->name('create');
                Route::post('create', [MaterialController::class, 'store'])->name('store');
                Route::get('{material_id}/edit', [MaterialController::class, 'edit'])->name('edit');
                Route::put('{material_id}/edit', [MaterialController::class, 'update'])->name('update');
                Route::delete('{material_id}/delete', [MaterialController::class, 'delete'])->name('delete');
            });
        });
    });

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('create', [TaskController::class, 'create'])->name('create');
        Route::post('create', [TaskController::class, 'store'])->name('store');
        Route::get('{id}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::put('{id}/edit', [TaskController::class, 'update'])->name('update');
        Route::get('{id}/asset', [TaskController::class, 'getAsset'])->name('asset');
        Route::post('{id}/asset/create', [TaskController::class, 'storeAsset'])->name('store.asset');
        Route::delete('{id}/delete', [TaskController::class, 'delete'])->name('delete');
        Route::delete('asset/{asset_id}/delete', [TaskController::class, 'deleteAsset'])->name('delete.asset');
        Route::get('{id}/evaluation', [TaskController::class, 'evaluation'])->name('evaluation');
        Route::put('{id}/evaluation', [TaskController::class, 'scoring'])->name('scoring');
    });

    Route::prefix('presence')->name('presence.')->group(function(){
        Route::get('/', [PresensceController::class, 'index'])->name('index');
        Route::get('{id}/detail', [PresensceController::class, 'show'])->name('detail');
        Route::get('create', [PresensceController::class, 'create'])->name('create');
        Route::post('create', [PresensceController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PresensceController::class, 'edit'])->name('edit');
        Route::put('{id}/edit', [PresensceController::class, 'update'])->name('update');
        Route::put('{id}/status', [PresensceController::class, 'updateStatus'])->name('update.status');
        Route::delete('{id}/delete', [PresensceController::class, 'delete'])->name('delete');
    });

    Route::prefix('scoring')->name('scoring.')->group(function(){
        Route::get('/', [ScoreController::class, 'index'])->name('index');
        Route::get('{id}', [ScoreController::class, 'mentee'])->name('mentee');
        Route::get('{masterClass_id}/{mente_id}/input', [ScoreController::class, 'input'])->name('mentee.input');
    });
});

Route::name('landing-page.')->group(function () {
    Route::get('/', [LandingPageController::class, 'index'])->name('index');

    Route::middleware(['auth', 'verified', 'role:mentee|user'])->group(function () {
        Route::prefix('transaction')->name('transaction.')->group(function () {
            Route::post('create', [TransactionController::class, 'create'])->name('create');
            Route::get('check', [TransactionController::class, 'transactionCheck'])->name('check');
            Route::post('voucher', [TransactionController::class, 'getVoucher'])->name('get-voucher');
            Route::post('{id}', [TransactionController::class, 'checkout'])->name('checkout');
        });

        Route::get('history', [TransactionController::class, 'history'])->name('history');
        Route::post('callback', [TransactionController::class, 'callback'])->name('callback');
        Route::get('return', [TransactionController::class, 'return'])->name('return');

        Route::prefix('master-class')->name('master-class.')->group(function () {
            Route::get('/', [UserMasterClassController::class, 'index'])->name('index');
            Route::get('{id}/show', [UserMasterClassController::class, 'show'])->name('show');
        });

        Route::prefix('class')->name('class.')->group(function () {
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

        Route::prefix('vouchers')->name('vouchers.')->group(function () {
            Route::get('/', [VoucherController::class, 'index'])->name('index');
            Route::get('create', [VoucherController::class, 'create'])->name('create');
            Route::post('create', [VoucherController::class, 'store'])->name('store');
            Route::get('{id}/edit', [VoucherController::class, 'edit'])->name('edit');
            Route::put('{id}/edit', [VoucherController::class, 'update'])->name('update');
            Route::put('{id}/status', [VoucherController::class, 'updateStatus'])->name('status');
            Route::delete('{id}/delete', [VoucherController::class, 'delete'])->name('delete');
        });

        Route::prefix('materials')->name('materials.')->group(function () {
            Route::get('/', [MasterClassMaterialController::class, 'index'])->name('index');
            Route::post('create', [MasterClassMaterialController::class, 'create'])->name('create');
            Route::get('show', [MasterClassMaterialController::class, 'show'])->name('show');
            Route::put('{id}/update', [MasterClassMaterialController::class, 'update'])->name('update');
            Route::delete('{id}/delete', [MasterClassMaterialController::class, 'delete'])->name('delete');
        });

        Route::prefix('affiliate')->name('affiliate.')->group(function(){
            Route::get('/', [SuperadminAffiliateController::class, 'index'])->name('index');
            Route::get('{id}/detail', [SuperadminAffiliateController::class, 'detail'])->name('detail');
            Route::get('{user_id}/saldo', [SuperadminAffiliateController::class, 'income'])->name('income');
            Route::get('{user_id}/withdraw', [SuperadminAffiliateController::class, 'withdraw'])->name('withdraw');
            Route::get('withdraw', [SuperadminAffiliateController::class, 'withdrawRequest'])->name('withdraw.request');
            Route::put('withdraw/{withdraw_id}', [SuperadminAffiliateController::class, 'updateStatusWithdraw'])->name('withdraw.update');
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
