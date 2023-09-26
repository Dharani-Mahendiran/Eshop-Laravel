<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontEndController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/',[FrontEndController::class, 'index']);



Route::prefix('/')->group(function(){

    Route::controller(FrontEndController::class)->group(function(){ 
        Route::get('/', 'index');
        Route::get('/category', 'category');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 2fa routes
Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
Route::get('verify', [TwoFactorController::class, 'index'])->name('verify.index');
Route::post('verify', [TwoFactorController::class, 'store'])->name('verify.store');

Route::prefix('admin')->middleware('auth', 'twofactor', 'isAdmin')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index']);

    // Category routes
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/edit/{category}', 'edit');
        Route::put('/category/{category}', 'update');
        Route::get('/category/del-category/{category}', 'destroy');
    });

    // Product routes
    Route::controller(ProductController::class)->group(function(){
        Route::get('/product', 'index');
        Route::get('/product/create', 'create');
        Route::post('/product', 'store');
        Route::get('/product/edit/{product}', 'edit');
        Route::put('/product/{product}', 'update');
        Route::get('/product/del-product/{product}','destroy');
    });

    
});

