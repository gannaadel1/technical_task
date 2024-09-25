<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebhookController;

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
Route::get('/product/{id}', [ProductController::class, 'show'])->middleware('log.request');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});

Route::prefix('product')->controller(ProductController::class)->group(function(){
    Route::get('/' , 'index');
    Route::get('newProduct/create' , 'create')->name('product.create') ; 
    Route::post('newProduct/store' , 'store')->name('product.store') ;  

});

Route::get('/payment', [StripeController::class, 'index'])->name('payment.index');
Route::post('/payment', [StripeController::class, 'processPayment'])->name('payment.process');


Route::post('/webhook', [WebhookController::class, 'handleWebhook']);

require __DIR__.'/auth.php';
