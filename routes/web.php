<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Mentor\TaskController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Mentor\ScoreController;
use App\Http\Controllers\Mentor\MenteeController;
use App\Http\Controllers\Mentee\PresenceController;
use App\Http\Controllers\Mentor\MaterialController;
use App\Http\Controllers\Superadmin\BlogController;
use App\Http\Controllers\Superadmin\UserManagement;
use App\Http\Controllers\EmailVerficationController;
use App\Http\Controllers\Mentee\AffiliateController;
use App\Http\Controllers\Mentor\PresensceController;
use App\Http\Controllers\Superadmin\ClassController;
use App\Http\Controllers\Superadmin\EventController;
use App\Http\Controllers\Superadmin\ExportController;
use App\Http\Controllers\PasswordManagementController;
use App\Http\Controllers\Superadmin\StudentController;
use App\Http\Controllers\Superadmin\VoucherController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\MasterClassController;
use App\Http\Controllers\SuperAdmin\MasterClassMaterialController;
use App\Http\Controllers\User\ClassController as UserClassController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\Mentee\TaskController as MenteeTaskController;
use App\Http\Controllers\Mentee\ClassController as MenteeClassController;
use App\Http\Controllers\Mentor\ClassController as MentorClassController;
use App\Http\Controllers\Mentee\DashboardController as MenteeDashboardController;
use App\Http\Controllers\Mentor\DashboardController as MentorDashboardController;
use App\Http\Controllers\User\MasterClassController as UserMasterClassController;
use App\Http\Controllers\Superadmin\AffiliateController as SuperadminAffiliateController;

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

    Route::prefix('affiliate')->name('affiliate.')->group(function () {
        Route::get('/', [AffiliateController::class, 'track'])->name('index');
        Route::get('saldo-track', [AffiliateController::class, 'trackSaldo'])->name('saldo.track');
        Route::get('withdraw', [AffiliateController::class, 'withdraw'])->name('withdraw');
        Route::post('withdraw', [AffiliateController::class, 'storeWithdraw'])->name('withdraw');
    });

    Route::prefix('presence')->name('presence.')->group(function () {
        Route::get('/', [PresenceController::class, 'index'])->name('index');
        Route::put('{presence_id}', [PresenceController::class, 'presence'])->name('submit');
    });

    Route::get('{master_class_id}/{certificate_id}/certificate', [CertificateController::class, 'claim'])->name('certificate');
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

    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/', [MentorClassController::class, 'index'])->name('index');
        Route::get('{id}/show', [MentorClassController::class, 'show'])->name('show');
    });

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

    Route::prefix('presence')->name('presence.')->group(function () {
        Route::get('/', [PresensceController::class, 'index'])->name('index');
        Route::get('{user_id}/{class_id}/recap', [PresensceController::class, 'recap'])->name('recap');
        Route::get('{id}/detail', [PresensceController::class, 'show'])->name('detail');
        Route::get('create', [PresensceController::class, 'create'])->name('create');
        Route::post('create', [PresensceController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PresensceController::class, 'edit'])->name('edit');
        Route::put('{id}/edit', [PresensceController::class, 'update'])->name('update');
        Route::put('{id}/status', [PresensceController::class, 'updateStatus'])->name('update.status');
        Route::delete('{id}/delete', [PresensceController::class, 'delete'])->name('delete');
    });

    Route::prefix('mentee-management')->name('mentee-management.')->group(function () {
        Route::get('/', [MenteeController::class, 'index'])->name('index');
        Route::get('{user_id}', [MenteeController::class, 'activityLog'])->name('activity');
    });

    Route::prefix('scoring')->name('scoring.')->group(function () {
        Route::get('/', [ScoreController::class, 'index'])->name('index');
        Route::post('/', [ScoreController::class, 'store'])->name('store');
        Route::get('{id}', [ScoreController::class, 'mentee'])->name('mentee');
        Route::get('{class_id}/{masterClass_id}/{mente_id}/input', [ScoreController::class, 'input'])->name('mentee.input');
    });

    Route::prefix('certificate')->name('certificate.')->group(function(){
        Route::get('/', [CertificateController::class, 'getAllClass'])->name('index');
        Route::get('{id}', [CertificateController::class, 'getMenteeByClass'])->name('class');
        Route::post('{id}', [CertificateController::class, 'attachDetach'])->name('attach');
    });
});

Route::name('landing-page.')->group(function () {
    Route::get('/', [LandingPageController::class, 'index'])->name('index');

    Route::prefix('blog')->name('blog.')->group(function(){
        Route::get('/', [ArticleController::class, 'index'])->name('index');
        Route::get('{id}', [ArticleController::class, 'show'])->name('show');
    });

    Route::middleware(['auth', 'verified', 'role:mentee|user|mentor'])->group(function () {
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
            Route::get('{id}/rate', [UserMasterClassController::class, 'getRate'])->name('rate');
            Route::get('cart', [TransactionController::class, 'cartList'])->name('cart.list');
            Route::delete('{id}/cart', [TransactionController::class, 'detachCart'])->name('cart.delete');
            Route::post('{id}/cart', [UserMasterClassController::class, 'storeCart'])->name('cart');
            Route::post('{id}/wishlist', [UserMasterClassController::class, 'storeWishlist'])->name('wishlist');
        });

        Route::prefix('class')->name('class.')->group(function () {
            Route::get('/', [UserClassController::class, 'index'])->name('index');
        });

        Route::prefix('profile')->name('profile.')->group(function(){
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::put('/', [ProfileController::class, 'update'])->name('update');
        });

        Route::prefix('users')->name('users.')->group(function(){
            Route::get('/', [LandingPageController::class, 'getUser'])->name('index');
        });

        Route::prefix('reviews')->name('reviews.')->group(function(){
            Route::get('{master_class_id}', [ReviewController::class, 'getByMasterClass'])->name('review.class');
            Route::post('{master_class_id}', [ReviewController::class, 'store'])->name('store');
        });
    });

    Route::prefix('events')->name('events.')->group(function(){
        Route::prefix('galery')->name('galery.')->group(function(){
            Route::get('{event_id}', [UserEventController::class, 'galery'])->name('index');
            Route::get('{event_id}/{galery_id}', [UserEventController::class, 'detailGalery'])->name('detail');
        });
    });
});

Route::prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('login', [AuthController::class, 'superadminLogin'])->name('login');
    Route::post('login', [AuthController::class, 'storeLoginSuperadmin'])->name('login.store');

    Route::middleware(['auth', 'verified', 'role:superadmin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('master-class-chart', [DashboardController::class, 'getTopMasterClass'])->name('chart.master-class-rate');
        Route::get('income-chart', [DashboardController::class, 'getIncomeChart'])->name('chart.income');

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
            Route::post('{class_id}/{master_class_id}/store', [StudentController::class, 'addStudents'])->name('store');
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

        Route::prefix('affiliate')->name('affiliate.')->group(function () {
            Route::get('/', [SuperadminAffiliateController::class, 'index'])->name('index');
            Route::get('{id}/detail', [SuperadminAffiliateController::class, 'detail'])->name('detail');
            Route::get('{user_id}/saldo', [SuperadminAffiliateController::class, 'income'])->name('income');
            Route::get('{user_id}/withdraw', [SuperadminAffiliateController::class, 'withdraw'])->name('withdraw');
            Route::get('withdraw', [SuperadminAffiliateController::class, 'withdrawRequest'])->name('withdraw.request');
            Route::put('withdraw/{withdraw_id}', [SuperadminAffiliateController::class, 'updateStatusWithdraw'])->name('withdraw.update');
        });

        Route::prefix('certificate')->name('certificate.')->group(function(){
            Route::get('/', [CertificateController::class, 'index'])->name('index');
            Route::get('create', [CertificateController::class, 'create'])->name('create');
            Route::post('create', [CertificateController::class, 'store'])->name('store');
            Route::get('{id}/edit', [CertificateController::class, 'edit'])->name('edit');
            Route::put('{id}/edit', [CertificateController::class, 'update'])->name('update');
            Route::delete('{id}/delete', [CertificateController::class, 'delete'])->name('delete');
        });

        Route::prefix('manage')->name('manage.')->group(function(){
            Route::get('users/{role_name}', [UserManagement::class, 'index'])->name('users');
            Route::get('users/{role_name}/create', [UserManagement::class, 'create'])->name('users.create');
            Route::get('users/{user_id}/activity', [UserManagement::class, 'activity_log'])->name('users.activity');
            Route::post('users/{role_name}/create', [UserManagement::class, 'store'])->name('users.store');
            Route::put('users/{role_name}/{user_id}/status', [UserManagement::class, 'changeStatus'])->name('user.status');
            Route::post('users/{role_name}/attach', [UserManagement::class, 'attach'])->name('user.attach');
        });

        Route::prefix('galery')->name('galery.')->group(function(){
            Route::get('/', [GaleryController::class, 'index'])->name('index');
            Route::get('create', [GaleryController::class, 'create'])->name('create');
            Route::post('create', [GaleryController::class, 'store'])->name('store');
            Route::get('{id}/edit', [GaleryController::class, 'edit'])->name('edit');
            Route::put('{id}/edit', [GaleryController::class, 'update'])->name('update');
            Route::put('{id}/status', [GaleryController::class, 'updateStatus'])->name('status');
            Route::delete('{id}/delete', [GaleryController::class, 'delete'])->name('delete');
        });

        Route::prefix('recap')->name('recap.')->group(function(){
            Route::get('transactions', [ExportController::class, 'transactionView'])->name('transaction');
            Route::post('transactions', [ExportController::class, 'transaction'])->name('transaction');
        });

        Route::prefix('blog')->name('blog.')->group(function(){
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('create', [BlogController::class, 'create'])->name('create');
            Route::post('create', [BlogController::class, 'store'])->name('store');
            Route::get('{id}/edit', [BlogController::class, 'edit'])->name('edit');
            Route::put('{id}/edit', [BlogController::class, 'update'])->name('update');
            Route::delete('{id}/delete', [BlogController::class, 'delete'])->name('delete');

            Route::prefix('category')->name('category.')->group(function(){
                Route::get('/', [BlogController::class, 'categoryList'])->name('index');
                Route::post('create', [BlogController::class, 'categoryStore'])->name('create');
                Route::get('{id}/edit', [BlogController::class, 'showCategory'])->name('edit');
                Route::put('{id}/edit', [BlogController::class, 'updateCategory'])->name('update');
                Route::delete('{id}/delete', [BlogController::class, 'deleteCategory'])->name('dekete');
            });
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

Route::get('certificate-tempplate', function(){
    return view('certificate');
});

Route::get('test-email', [CertificateController::class, 'testEmail']);
Route::get('test-top', [DashboardController::class, 'getTopMasterClass']);
