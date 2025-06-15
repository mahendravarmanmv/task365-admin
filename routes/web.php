<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContactAdminController;
use App\Http\Controllers\WebsiteTypeController;
use Illuminate\Http\Request;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::get('/signup', [RegisteredUserController::class, 'create'])->name('signup');
Route::post('/signup', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Show reset password form
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Handle password reset request
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/blog', function () {
    return view('blogs');
})->name('blog');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about');

Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/shipping', function () {
    return view('shipping');
})->name('shipping');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('throttle:6,1')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');

    /*Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');*/

    Route::post('/update-password', [ProfileController::class, 'updatePassword'])
    ->name('profile.password.update')->middleware('auth');

    Route::resource('categories', CategoryController::class);
	Route::resource('users', UserController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('leads', LeadController::class);

    Route::get('banner/edit', [BannerController::class, 'edit'])->name('banner.edit');
    Route::post('banner/update', [BannerController::class, 'update'])->name('banner.update');
    Route::get('/payments', [PaymentController::class, 'adminIndex'])->name('payments.index');

    Route::resource('website-types', WebsiteTypeController::class);
	Route::get('/get-website-types/{category_id}', [WebsiteTypeController::class, 'getByCategory']);
    Route::get('/contacts', [ContactAdminController::class, 'index'])->name('contacts.index');


});

/*require __DIR__.'/auth.php';*/
