<?php

use App\Http\Controllers\AdminController;
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

Route::get('/', [AdminController::class, 'home'])->name('home');
Route::get('/siparisler', [AdminController::class, 'orders'])->name('orders');
Route::get('/musteri-ekle', [AdminController::class, 'addCustomer'])->name('add-customer');
Route::post('/musteri-ekle-form', [AdminController::class, 'addCustomerForm'])->name('form.add-customer');
Route::get('/siparis-ekle', [AdminController::class, 'addOrder'])->name('add-order');
Route::post('/siparis-ekle-form', [AdminController::class, 'addOrderForm'])->name('form.add-order');
Route::get('/kargo-iptal', [AdminController::class, 'orderDelete'])->name('order-delete');
Route::post('/kargo-iptal-form', [AdminController::class, 'orderDeleteForm'])->name('form.order-delete');

Route::prefix("/api")->name("api.")->group(function () {
    Route::get('/sehirler/{ulkeKodu}', [AdminController::class, 'getCities'])->name('getCities');
    Route::get('/posta-kodlari/{sehirKodu}', [AdminController::class, 'getZips'])->name('getZips');
});
