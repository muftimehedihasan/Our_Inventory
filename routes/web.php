<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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

// Web API Routes

// Profile Api Routes

Route::post('/user-registration',[UserController::class,'UserRegistration']);
Route::post('/user-login',[UserController::class,'UserLogin']);
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware('auth:sanctum');
Route::get('/logout',[UserController::class,'UserLogout'])->middleware('auth:sanctum');
// Vew UserProfile's Details Api
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware('auth:sanctum');
Route::post('/user-update',[UserController::class,'UpdateProfile'])->middleware('auth:sanctum');
Route::post('/send-otp',[UserController::class,'SendOTPCode']);
Route::post('/verify-otp',[UserController::class,'VerifyOTP']);
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware('auth:sanctum');

// Category Api Routes
Route::post("/create-category",[CategoryController::class,'CategoryCreate'])->middleware(['auth:sanctum']);
Route::get("/list-category",[CategoryController::class,'CategoryList'])->middleware(['auth:sanctum']);
Route::post("/delete-category",[CategoryController::class,'CategoryDelete'])->middleware(['auth:sanctum']);
Route::post("/update-category",[CategoryController::class,'CategoryUpdate'])->middleware(['auth:sanctum']);
Route::post("/category-by-id",[CategoryController::class,'CategoryByID'])->middleware(['auth:sanctum']);










// Page Routes
Route::view('/', 'pages.home');
Route::view('/userLogin','pages.auth.login-page')->name('login');
Route::view('/userRegistration','pages.auth.registration-page');
Route::view('/sendOtp','pages.auth.send-otp-page');
Route::view('/verifyOtp','pages.auth.verify-otp-page');
Route::view('/resetPassword','pages.auth.reset-pass-page');
Route::view('/userProfile','pages.dashboard.profile-page');
Route::get('/categoryPage',[CategoryController::class,'CategoryPage'])->middleware(['auth:sanctum']);




// Category Page Routes
// Route::post("/create-category",[CategoryController::class,'CategoryCreate']);
// Route::get("/list-category",[CategoryController::class,'CategoryList']);
// Route::post("/delete-category",[CategoryController::class,'CategoryDelete']);
// Route::post("/update-category",[CategoryController::class,'CategoryUpdate']);
// Route::post("/category-by-id",[CategoryController::class,'CategoryByID']);




