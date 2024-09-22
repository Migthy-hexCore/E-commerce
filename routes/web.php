<?php

use App\Models\Feature;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::get('prueba', function () {
//     $product = Product::find(150);
    
//     $features = $product->options->pluck('pivot.features');
    
//     $combinaciones = generarCombinaciones($features);
    
//     $product->variants()->delete();
    
//     foreach ($combinaciones as $combinacion) {
//         $variant = Variant::create([
//             'product_id' => $product->id,
//         ]);
//         $variant->features()->attach($combinacion);
//     }
//     return 'Combinaciones generadas';
// });

// function  generarCombinaciones($arrays, $indice = 0, $combinacion = [])
// {
//     if ($indice == count($arrays)) {
//         return [$combinacion];
//     }
//     $resultado = [];
//     foreach ($arrays[$indice] as $item) {
//         $combinacionesTemporal = $combinacion;
//         $combinacionesTemporal[] = $item['id'];
//         $resultado = array_merge($resultado, generarCombinaciones($arrays, $indice + 1, $combinacionesTemporal));
//     }
//     return  $resultado;
// }
