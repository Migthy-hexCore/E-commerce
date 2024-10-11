<?php

namespace App\Livewire\Products;

use Illuminate\Support\Facades\Auth;
use CodersFree\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public $qty = 1;

    public function add_to_cart()
    {
        Cart::instance('shopping');

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->product->image,
                'sku' => $this->product->sku,
                'features' => [],
            ]
        ]);

        if (Auth::check()) {
            Cart::store(Auth::id());
        }

        $this->dispatch('cartUpdated', Cart::count());


        $this->dispatch('swal', [
            'title' => 'Producto agregado al carrito',
            'icon' => 'success',
            'timeout' => 3000,
            'toast' => true,
            'position' => 'center' // top-right, top-left, top-center, top-end, center, center-left, center-right, bottom, bottom-left, bottom-right, bottom-center
        ]);
    }

    public function render()
    {
        return view('livewire.products.add-to-cart');
    }
}
