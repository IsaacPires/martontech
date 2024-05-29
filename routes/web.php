<?php

use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SaleProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RequestController;
use App\Http\Middleware\Authenticator;
use App\Http\Middleware\AuthenticatorPage;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PendingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntryProductsController;
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

Route::middleware([Authenticator::class])->group(function ()
{

    // Rotas para login e cadastro de usuario
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/register', [UsersController::class, 'create'])->name('users.create');
    Route::post('/register', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->middleware(AuthenticatorPage::class);
    Route::resource('/users', UsersController::class)->middleware(AuthenticatorPage::class);

    // Rotas para o dashboard
    Route::resource('/dashboard', DashboardController::class);


    Route::resource('/dashboard', DashboardController::class);
    Route::get('/', [DashboardController::class, 'index']);

    // Rotas para relatório csv
    Route::get('/suppliers/report', [SuppliersController::class, 'report']);
    Route::get('/suppliers/csv/{request?}', [SuppliersController::class, 'csv'])->name('suppliers.csv');

    // Rotas para os fornecedores
    Route::resource('/suppliers', SuppliersController::class)->except('show');
    Route::get('/suppliers/{id}/edit', [SuppliersController::class, 'edit']);

    // Rotas para os produtos
    Route::resource('/products', ProductsController::class)->except('show');
    Route::get('/products/{id}/edit', [ProductsController::class, 'edit']);
    Route::get('/products/report', [ProductsController::class, 'report']);
    Route::get('/products/csv/{request?}', [ProductsController::class, 'csv'])->name('products.csv');
    Route::delete('/products/{id}', 'ProductsController@destroy')->name('ProductsController.destroy');

    // Rotas para as vendas
    Route::resource('/sales_products', SaleProductsController::class)->except('show');

    // Rotas para as NF
    Route::resource('/invoices', InvoicesController::class)->except('show');
    Route::get('/invoices/{id}/edit', [InvoicesController::class, 'edit']);
    Route::get('/invoices/report', [InvoicesController::class, 'report']);
    Route::get('/invoices/csv/{request?}', [InvoicesController::class, 'csv'])->name('invoices.csv');


    // request routes
    Route::resource('/request', RequestController::class);
    Route::get('/products-by-supplier/{id}', [RequestController::class, 'getProductsBySupplier']);
    Route::get('/request/atualizar-preco/{id}', [RequestController::class, 'atualizarPreco']);
    Route::get('/get-request-info/{id}', [RequestController::class, 'getRequestInfo']);
    Route::get('/request/{id}/index', [RequestController::class, 'index'])->name('request.index');


    Route::resource('/order', OrderController::class);
    Route::get('/order/csv/{request?}', [OrderController::class, 'csv'])->name('orders.csv');
    Route::get('/order/accept/{id}', [OrderController::class, 'accept'])->name('order.accept');
    Route::get('/order/deny/{id}', [OrderController::class, 'deny'])->name('order.deny');


    // Rotas para as vendas
    Route::resource('/sale_products', SaleProductsController::class)->except('show');
    Route::get('/sale_products/{id}/edit', [SaleProductsController::class, 'edit']);
    Route::get('/sale_products/report', [SaleProductsController::class, 'report']);
    Route::get('/sale_products/csv/{request?}', [SaleProductsController::class, 'csv'])->name('sale_products.csv');
    Route::get('/sale_products/all', [SaleProductsController::class, 'all'])->name('sale_products.all');
    Route::delete('/sale_products/{id}', 'SaleProductsController@destroy')->name('sale_products.destroy');

    //pending Routes
    Route::resource('/pending', PendingController::class);
    Route::get('/pending/csv/{request?}', [PendingController::class, 'csv'])->name('pending.csv');
    Route::get('/pending/{id}/accept', [PendingController::class, 'accept'])->name('pending.accept');
    Route::get('/pending/{id}/deny', [PendingController::class, 'deny'])->name('pending.deny');

    Route::resource('/entry_products', EntryProductsController::class)->except('show');
    Route::get('/entry_products/{id}/edit', [EntryProductsController::class, 'edit']);
    Route::get('/entry_products/csv/{request?}', [EntryProductsController::class, 'csv'])->name('entry_products.csv');
});
