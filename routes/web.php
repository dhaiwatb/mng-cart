<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'orders'], function(){
    Route::get('/', [OrderController::class, 'index'])->name('orders.list');
    Route::get('create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('view/{id}', [OrderController::class, 'show'])->name('orders.view');
});

Route::group(['prefix' => 'products'], function(){
    Route::post('get_price', [ProductController::class, 'getPrice']);
});

require __DIR__.'/auth.php';
