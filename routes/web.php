<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;



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

Route::get('/index', function () {
    return view('index');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('admin:admin')->group(function (){
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
    
});


Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified',
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard')->middleware('auth:admin');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth','admin'])->name('admin.dashboard')->prefix('admin')->group(function(){
});

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::post('/reservation',[AdminController::class,'reservation']);

Route::get('logout', [HomeController::class, 'logout']);


Route::get('/users',[AdminController::class,'user']);
Route::get('/viewreservation',[AdminController::class,'viewreservation']);
Route::get('/adminchef',[AdminController::class,'adminchef']); 
Route::get('orders', [AdminController::class,'orders'])->name('admin.orders');

Route::get('/search-results',[AdminController::class,'search']); 
Route::match(['get', 'post'], '/managecategory', [AdminController::class, 'managecategory'])->name('admin.managecategory');
Route::delete( '/deletecategory', [AdminController::class, 'deletecategory'])->name('admin.category.delete');
Route::post('/updatecategory/{id}',[AdminController::class,'updatecategory'])->name('admin.category.update');    
Route::get('/managecart',[AdminController::class,'managecart'])->name('admin.cart.index'); 



Route::post('/addcart/{id}',[HomeController::class,'addcart']);
Route::post('/orderconfirm',[HomeController::class,'orderconfirm']); 
Route::get('/cart',[OrderController::class,'cart'])->name('cart');
Route::get('/remove/{id}',[HomeController::class,'remove']);

Route::delete('/remove/{id}', [HomeController::class, 'remove'])->name('remove');
Route::get('/order', [OrderController::class, 'order'])->name('order');


Route::post('/uploadfood',[AdminController::class,'uploadfood']);
Route::get('/deletemenu/{id}',[AdminController::class,'deletemenu']);
Route::get('/updateview/{id}',[AdminController::class,'updateview']);
Route::post('/update/{id}',[AdminController::class,'update']); 
Route::get('/deleteuser/{id}',[AdminController::class,'deleteuser']);
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');




Route::get('/product',[ProductController::class,'index'])->name('admin.product');
Route::get('/product/create',[ProductController::class,'insert'])->name('admin.product.insert');
Route::post('/product/create',[ProductController::class,'store'])->name('admin.product.store');
Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit');
Route::post('/product/edit/{id}',[ProductController::class,'update'])->name('admin.product.update');
Route::delete('/product/delete/{id}',[ProductController::class,'removeproduct'])->name('admin.product.remove');

Route::middleware('auth')->group(function(){

        Route::controller(OrderController::class)->group(function(){
        Route::get('/add-to-cart/{pid}','addtoCart')->name('addtoCart');
        Route::get('/remove-from-cart/{pid}','removefromCart')->name('removefromCart');
        Route::get('/cart',[OrderController::class,'cart'])->name('cart');
        Route::get('/viewcart',[OrderController::class,'viewcart'])->name('viewcart');
        Route::get('/myorder','myorder')->name('myorder');
        Route::get('/payment/callback', 'PaymentController@handlePaymentCallback');
        Route::post('/payment', [PaymentController::class, 'Payment'])->name('orderCreate');
        Route::match(['get','post'],'/saveadd',[OrderController::class,'saveadd'])->name('saveadd');
        Route::get('/thank-you', [OrderController::class, 'thankYou'])->name('thank-you');
    });
});





