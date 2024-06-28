<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;


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
    // Route::get('/', [AdminController::class, 'index'])->name('index');
    // Route::resource('/categories', CategoryController::class);
    // Route::resource('/menus', MenuController::class);
    // Route::resource('/tables', TableController::class);
    // Route::resource('/reservation', ReservationController::class);

   // Route::resource('categories', App\Http\Controllers\CategoryController::class);
});

Route::get('/',[HomeController::class,'index']);
Route::get('/redirects',[HomeController::class,'redirects']);
Route::post('/reservation',[AdminController::class,'reservation']);



Route::get('/users',[AdminController::class,'user']);
Route::get('/viewreservation',[AdminController::class,'viewreservation']);
Route::get('/viewchef',[AdminController::class,'viewchef']); 
Route::get('/adminchef',[AdminController::class,'adminchef']); 
Route::post('/uploadchef',[AdminController::class,'uploadchef']); 
Route::get('/chefdata',[AdminController::class,'chefdata']);
Route::get('/updatechef/{id}',[AdminController::class,'updatechef']); 
Route::post('/updatefoodchef/{id}',[AdminController::class,'updatefoodchef']); 
Route::get('/deletechef/{id}',[AdminController::class,'deletechef']);
Route::get('/orders',[AdminController::class,'orders']);
Route::get('/search-results',[AdminController::class,'search']); 


Route::post('/addcart/{id}',[HomeController::class,'addcart']);
Route::post('/orderconfirm',[HomeController::class,'orderconfirm']); 
// Route::get('/showcart/{id}',[HomeController::class,'showcart']);
// Route::get('/remove/{id}',[HomeController::class,'remove']);

Route::get('/showcart/{id}', [HomeController::class, 'showcart'])->name('showcart');
Route::delete('/remove/{id}', [HomeController::class, 'remove'])->name('remove');



// Route::post('/orderconfirm', [HomeController::class, 'orderconfirm'])->name('orderconfirm');




Route::get('/foodmenu',[AdminController::class,'foodmenu']);
Route::get('/categories',[AdminController::class,'categories']);
Route::post('/uploadfood',[AdminController::class,'uploadfood']);
Route::get('/deletemenu/{id}',[AdminController::class,'deletemenu']);
Route::get('/updateview/{id}',[AdminController::class,'updateview']);
Route::post('/update/{id}',[AdminController::class,'update']); 
Route::get('/deleteuser/{id}',[AdminController::class,'deleteuser']);


