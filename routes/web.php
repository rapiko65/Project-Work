<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Faker\Guesser\Name;
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

Route::get('/', function () {
    return view('dashboard.index');
});
Route::get('/pesan', function () {
    return view('dashboard.pesanan');
});
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
});

Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('home',[HomeController::class,'index'])->name('home');
});

Route::post('login-process',[LoginController::class,'login'])->name('login-process');
Route::post('logout-process',[LoginController::class,'logout'])->name('logout-process');

