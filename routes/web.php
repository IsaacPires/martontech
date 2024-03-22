<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Authenticator;
use App\Http\Middleware\AuthenticatorPage;
use App\Http\Controllers\SuppliersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');

Route::middleware([Authenticator::class])->group(function () {

    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/register', [UsersController::class, 'create'])->name('users.create');
    Route::post('/register', [UsersController::class, 'store'])->name('users.store');

    Route::view('/', 'dashboard.index');
    Route::view('/dashboard', 'dashboard.index');

    Route::get('/suppliers/report', [SuppliersController::class, 'report']);


    Route::resource('/users', UsersController::class)->middleware(AuthenticatorPage::class);

    Route::resource('/suppliers', SuppliersController::class)->except('show');
    Route::get('/suppliers/{id}/edit', [SuppliersController::class, 'edit']);

});