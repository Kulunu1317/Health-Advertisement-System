<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;

// Public routes
Route::get('/', function () { return view('welcome'); })->name('welcome');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->middleware('throttle:10,1');
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->middleware('throttle:10,1');
});

// Authenticated routes
Route::middleware(['auth', 'approved', 'throttle:120,1'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/mypackages', [PurchaseController::class, 'myPackages'])->name('mypackages');
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::post('/packages/{package}/buy', [PurchaseController::class, 'buy'])->name('packages.buy');
    Route::get('/purchases/{purchase}/create-ad', [AdvertisementController::class, 'create'])->name('advertisements.create');
    Route::post('/purchases/{purchase}/store-ad', [AdvertisementController::class, 'store'])->name('advertisements.store');
    Route::get('/advertisements/{advertisement}/edit-time', [AdvertisementController::class, 'editTime'])->name('advertisements.edit_time');
    Route::post('/advertisements/{advertisement}/request-extension', [AdvertisementController::class, 'requestTimeExtension'])->name('advertisements.request_extension');
    Route::get('/advertisements/{advertisement}', [AdvertisementController::class, 'show'])->name('advertisements.show');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin', 'throttle:120,1'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('packages', AdminPackageController::class);
    Route::post('/users/{user}/approve', [ApprovalController::class, 'approveUser'])->name('users.approve');
    Route::delete('/users/{user}/reject', [ApprovalController::class, 'rejectUser'])->name('users.reject');
    Route::post('/advertisements/{advertisement}/approve', [ApprovalController::class, 'approveAdvertisement'])->name('advertisements.approve');
    Route::delete('/advertisements/{advertisement}/reject', [ApprovalController::class, 'rejectAdvertisement'])->name('advertisements.reject');
    Route::post('/renewals/{renewalRequest}/approve', [RequestController::class, 'approveRenewal'])->name('renewals.approve');
    Route::post('/renewals/{renewalRequest}/reject', [RequestController::class, 'rejectRenewal'])->name('renewals.reject');
    Route::post('/extensions/{timeExtensionRequest}/approve', [RequestController::class, 'approveTimeExtension'])->name('extensions.approve');
    Route::post('/extensions/{timeExtensionRequest}/reject', [RequestController::class, 'rejectTimeExtension'])->name('extensions.reject');
});