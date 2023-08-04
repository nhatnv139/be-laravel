<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;


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

Route::get('/', function () {
    return view('welcome');
});

//client Routes
Route::prefix('category')->group(function () {
    // Danh sách chuyên mục
    Route::get('/', [ProductController::class, 'index']);

    //Lấy chi tiết 1 muc

    Route::get('/edit/{id}', [ProductController::class, 'getCategory']);

    // Route::post('/edit/{id}', [ProductController::class, 'updateCategory']);

    // Route::get('/add', ProductController::class, 'addCategory');
});
Route::prefix('users')->name('users.')->group(function () {
    // Danh sách chuyên mục
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/add', [UserController::class, 'add'])->name('add'); 
    Route::post('/add', [UserController::class, 'postAdd'])->name('post-add');
    Route::get('/edit/{id}', [UserController::class, 'getEdit'])->name('edit');
    Route::post('/update', [UserController::class, 'postEdit'])->name('post-edit');

    //Lấy chi tiết 1 muc

    // Route::get('/edit/{id}', [ProductController::class, 'getCategory']);

    // Route::post('/edit/{id}', [ProductController::class, 'updateCategory']);

    // Route::get('/add', ProductController::class, 'addCategory');
});

//Admin Routes 
// Route::prefix('admin')->ground(function(){
//     Router::resource('product', )
// })
