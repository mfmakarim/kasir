<?php

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('purchase')->group(function(){
    Route::get('create', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('create', [PurchaseController::class, 'store']);
    Route::get('/', [PurchaseController::class, 'index'])->name('purchase');
    Route::get('{purchase:id}/show', [PurchaseController::class, 'show'])->name('purchase.show');
});
Route::get('products/{id}/get', [ProductController::class, 'get']);
