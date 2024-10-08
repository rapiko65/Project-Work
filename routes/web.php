<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JumbotronController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
use Faker\Guesser\Name;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[ProductController::class, 'show'])->name('dashboard-awal');
// Route::get('/pesan', function () {
//     return view('dashboard.pesanan');
// });
// Route::get('dashboard-admin', function () {
//     return view('dashboard-admin.dashboard');
// });
Route::get('login', function () {
    return view('layout.login');
})->name('login');

Route::get('register', function () {
    return view('layout.register');
})->name('register');

Route::post('register-process',[HomeController::class,'register'])->name('register-process');

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('admin-dashboard',[DashboardAdminController::class,'index'])->name('admin-dashboard');
    Route::prefix('tambah-barang')->name('tambah-barang.')->group(function () {
        Route::get('barang',[ProductController::class,'index'])->name('barang');
        Route::get('tambah',[ProductController::class,'create'])->name('tambah');
        Route::post('tambah-barang', [ProductController::class,'upload'])->name('uploud-barang');
        Route::get('barang/{id}/edit',[ProductController::class,'edit'])->name('barang-edit');
        Route::put('barang/{id}',[ProductController::class,'update'])->name('prosses-barang');
        Route::delete('barang/{id}',[ProductController::class, 'destroy'])->name('destroy-barang');
    });
    Route::prefix('tambah-jumbotron')->name('tambah-jumbotron.')->group(function () {
        Route::get('jumbotron',[JumbotronController::class,'index'])->name('jumbotron');
        Route::get('jumbotron-create',function () {
            return view('dashboard-admin.jumbotron.create');
        })->name('jumbotron-create');
        Route::post('upload',[JumbotronController::class,'upload'])->name('uploud-jumbotron');
        Route::get('jumbotron/{id}/edit',[JumbotronController::class,'edit'])->name('jumbotron-edit');
        Route::put('jumbotron/{id}',[JumbotronController::class,'update'])->name('jumbotron-update');
        Route::delete('jumbotron/{id}',[JumbotronController::class,'destroy'])->name('delete-jumbotron');
    });
    Route::prefix('tambah-category')->name('tambah-category.')->group(function () {
        Route::get('tambah-category',[CategoryController::class,'create'])->name('tambah-category');
        Route::get('category',[CategoryController::class,'index'])->name('category');
        Route::post('uploud-category',[CategoryController::class, 'store'])->name('uploud-category');
        Route::get('category/{id}/edit',[CategoryController::class, 'edit'])->name('edit-category');
        Route::put('category/{id}',[CategoryController::class,'update'])->name('update-category');
        Route::delete('category/{id}',[CategoryController::class,'destroy'])->name('delete-category');
    });
});

Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('home',[ProductController::class, 'show'])->name('home');
    Route::get('pesanan/{id}',[ProductController::class,'showpesanan'])->name('show-simpanan');
});

Route::get('pesan',function(){
    return view('dashboard.pesanan');
});

Route::post('login-process',[LoginController::class,'login'])->name('login-process');
Route::post('logout-process',[LoginController::class,'logout'])->name('logout-process');

