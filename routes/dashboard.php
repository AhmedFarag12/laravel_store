<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\dashboard\CategoreisController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\dashboard\ProfileController;
use App\Http\Middleware\CheckUserType;

Route::group([
    'middleware' => ['auth' ,'auth.type:super-admin,admin'],
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
], function () {

    Route::get('profile', [ProfileController::class,'edit'])->name(('profile.edit'));
    Route::patch('profile', [ProfileController::class,'update'])->name(('profile.update'));


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/categories/trash', [CategoreisController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore', [CategoreisController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoreisController::class, 'forceDelete'])->name('categories.force-delete');
    Route::resource('/categories', CategoreisController::class);
    Route::resource('/products', ProductsController::class);

});
