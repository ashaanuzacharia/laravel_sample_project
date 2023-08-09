<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController;

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
Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('/reload-captcha', [AuthController::class, 'reloadCaptcha']);
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/blog/create', [BlogController::class, 'addblog'])->name('blog.create');
Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog/view/{id}', [BlogController::class, 'view'])->name('blog.view');

Route::get('/blog/store/{id}', [BlogController::class, 'edit'])->name('blog.edit');
Route::post('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');

Route::get('/blog/delete/{id}', [BlogController::class,'destroy'])->name('blog.delete');
Route::get('/blog/image-delete/{id}', [BlogController::class,'destroyimage'])->name('blog.imagedelete');

Route::get('/customer/create', [BlogController::class, 'addcustomer'])->name('customer.create');
Route::post('/customer/store', [BlogController::class, 'storecustomer'])->name('customer.store');

Route::get('/product/create', [BlogController::class, 'addproduct'])->name('product.create');
Route::post('/product/store', [BlogController::class, 'storeproduct'])->name('product.store');

Route::get('/invoices', [BlogController::class, 'invoices'])->name('invoice');
Route::post('/invoice/store', [BlogController::class, 'storeinvoice'])->name('invoice.store');

Route::get('/product/{item}/price', [BlogController::class, 'getPrice'])->name('getPrice');
Route::get('/customer/{name}/discount', [BlogController::class, 'getCustomer'])->name('getCustomer');



