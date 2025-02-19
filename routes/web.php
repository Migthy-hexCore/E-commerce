<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\VerifyStock;
use App\Models\Feature;
use App\Models\Order;
use App\Models\Product;
use App\Models\Variant;
use Barryvdh\DomPDF\Facade\Pdf;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('families/{family}', [FamilyController::class, 'show'])->name('families.show');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('cart', [CartController::class, 'index'])->name('cart.index')->middleware(VerifyStock::class);
Route::get('shipping', [ShippingController::class, 'index'])->middleware('auth')->name('shipping.index');
Route::get('checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout.index');
Route::post('checkout/paid', [CheckoutController::class, 'paid'])->name('checkout.paid');


Route::get('gracias', function () {
    return view('gracias');
})->name('gracias');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('prueba', function () {
    $order = Order::first();
    $pdf = Pdf::loadView('orders.ticket', compact('order'))->setPaper('a5');
    $pdf->save(storage_path('app/public/tickets/ticket-' . $order->id . '.pdf'));

    $order->pdf_path = 'tickets/ticket-' . $order->id . '.pdf';
    $order->save();

    return "Ticket generado";
    return view('orders.ticket', compact('order'));
});
