<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;

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

// Category Web Api Routes
Route::post("/create-category",[CategoryController::class,'CategoryCreate'])->middleware(['auth:sanctum']);
Route::get("/list-category",[CategoryController::class,'CategoryList'])->middleware(['auth:sanctum']);
Route::post("/delete-category",[CategoryController::class,'CategoryDelete'])->middleware(['auth:sanctum']);
Route::post("/update-category",[CategoryController::class,'CategoryUpdate'])->middleware(['auth:sanctum']);
Route::post("/category-by-id",[CategoryController::class,'CategoryByID'])->middleware(['auth:sanctum']);

// Costomer Web Api Routes
Route::post("/create-customer",[CustomerController::class,'CustomerCreate'])->middleware(['auth:sanctum']);
Route::get("/list-customer",[CustomerController::class,'CustomerList'])->middleware(['auth:sanctum']);
Route::post("/delete-customer",[CustomerController::class,'CustomerDelete'])->middleware(['auth:sanctum']);
Route::post("/update-customer",[CustomerController::class,'CustomerUpdate'])->middleware(['auth:sanctum']);
Route::post("/customer-by-id",[CustomerController::class,'CustomerByID'])->middleware(['auth:sanctum']);

// Product Web API Routes
Route::post("/create-product",[ProductController::class,'CreateProduct'])->middleware(['auth:sanctum']);
Route::post("/delete-product",[ProductController::class,'DeleteProduct'])->middleware(['auth:sanctum']);
Route::post("/update-product",[ProductController::class,'UpdateProduct'])->middleware(['auth:sanctum']);
Route::get("/list-product",[ProductController::class,'ProductList'])->middleware(['auth:sanctum']);
Route::post("/product-by-id",[ProductController::class,'ProductByID'])->middleware(['auth:sanctum']);

// Invoice Web Api
Route::post("/create-invoice",[InvoiceController::class,'CreateInvoice'])->middleware(['auth:sanctum']);
Route::post("/select-invoice",[InvoiceController::class,'SelectInvoice'])->middleware(['auth:sanctum']);






/*
|--------------------------------------------------------------------------
|Pages Routes
|--------------------------------------------------------------------------
*/

// Register and Login Pages Routes
Route::view('/', 'pages.home');
Route::view('/userLogin','pages.auth.login-page')->name('login');
Route::view('/userRegistration','pages.auth.registration-page');
Route::view('/sendOtp','pages.auth.send-otp-page');
Route::view('/verifyOtp','pages.auth.verify-otp-page');
Route::view('/resetPassword','pages.auth.reset-pass-page');
Route::view('/userProfile','pages.dashboard.profile-page');
// Category Page
Route::view('/categoryPage', 'pages.dashboard.category-page');
// Customer Page
Route::view('/customerPage','pages.dashboard.customer-page');
// Product Page
Route::view('/productPage','pages.dashboard.product-page');








