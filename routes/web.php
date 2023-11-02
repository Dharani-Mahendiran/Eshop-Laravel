<?php


use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontEndController;
use App\Http\Controllers\Frontend\WishlistController;

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
        Route::get('category', 'category');
        Route::get('view-category/{slug}', 'viewcategory');
        Route::get('category/{cate_slug}/{prod_slug}', 'viewproduct');
    });

    // Add-To-Cart routes
    Route::controller(CartController::class)->group(function(){
        Route::post('add-to-cart', 'addProduct');
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(CartController::class)->group(function(){
            Route::get('cart', 'viewCart');
            Route::post('delete-cartItem', 'deleteProduct');
            Route::post('update-cart', 'updateCart');
        });


        Route::controller(WishlistController::class)->group(function(){
            Route::post('add-to-wishlist', 'addProduct');
            Route::get('wishlist', 'viewWishlist');
            Route::post('delete-wishlist', 'deleteProduct');
        });


        Route::controller(CheckoutController::class)->group(function(){
            Route::get('checkout', 'index');
            Route::POST('place-order', 'placeorder');
        });

        Route::controller(UserController::class)->group(function(){
            Route::get('my-orders', 'index');
            Route::get('order-view/{orderitem}', 'view');
        });
        
            

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


    //order routes
      Route::controller(OrderController::class)->group(function(){
        Route::get('/orders', 'index');
        Route::get('/order-packed', 'orderdpacked');
        Route::get('/order-intransit', 'orderintransit');
        Route::get('/order-delivered', 'orderdelivered');

        Route::get('order-view/{orderitem}', 'view');
        Route::post('order-update/{orderitem}', 'updateorder');
        Route::put('order-updateDate/{orderitem}', 'updateDeliveryDate');
    });


    // User routes
        Route::controller( DashboardController::class)->group(function(){
        Route::get('/users', 'users');
        Route::get('/profiles', 'adminProfiles');

        Route::get('/create/user', 'create_user');
        Route::post('/users', 'store_user');
        Route::get('/user/edit/{user}', 'edit_user');
        Route::put('/user/{user}', 'update_user');


    });
    
    




});

