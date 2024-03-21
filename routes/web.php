<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Authenticator;
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

Route::get('/', function ()
{
    return view('suppliers.index');
})->middleware(Authenticator::class);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');
Route::get('/users', [UsersController::class, 'index'])->name('users.index');

Route::view('/', 'dashboard.index');
Route::view('/dashboard', 'dashboard.index');

Route::get('/suppliers/report', [SuppliersController::class, 'report']);

Route::resource('/suppliers', SuppliersController::class)->except('show');
Route::get('/suppliers/{id}/edit', [SuppliersController::class, 'edit']);
