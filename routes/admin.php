<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Livewire\Admin\UserComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->middleware('can:access dashboard')->name('dashboard');

Route::get('/options', [OptionController::class, 'index'])
    ->middleware('can:manage options')
    ->name('options.index');

Route::resource('families', FamilyController::class)
    ->middleware('can:manage families');

Route::resource('categories', CategoryController::class)
    ->middleware('can:manage categories');

Route::resource('subcategories', SubcategoryController::class)
    ->middleware('can:manage subcategories');

Route::resource('products', ProductController::class)
    ->middleware('can:manage products');

Route::resource('drivers', DriverController::class)
    ->middleware('can:manage drivers');

Route::resource('users', UserController::class);

Route::get('shipments', [ShipmentController::class, 'index'])
    ->middleware('manage shipments')
    ->name('shipments.index');

Route::get('orders', [OrderController::class, 'index'])
    ->middleware('can:manage orders')
    ->name('orders.index');

Route::get('products/{product}/variants/{variant}', [ProductController::class, 'variants'])
    ->middleware('can:manage products')
    ->name('products.variants')
    ->scopeBindings();

Route::put('products/{product}/variants/{variant}', [ProductController::class, 'variantsUpdate'])
    ->middleware('can:manage products')
    ->name('products.variantsUpdate')
    ->scopeBindings();

Route::resource('covers', CoverController::class)
    ->middleware('can:manage covers');
