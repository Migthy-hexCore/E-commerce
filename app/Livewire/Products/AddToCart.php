<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use CodersFree\Shoppingcart\Facades\Cart;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Component
{
    public $product;
    public $qty = 1;
    public $variant;
    public $stock;
    public $selectedFeatures = [];

    public function mount()
    {
        $this->selectedFeatures = $this->product->variants->first()->features->pluck('id', 'option_id')->toArray();
        $this->getVariant();
    }

    public function updatedSelectedFeatures()
    {
        $this->getVariant();
    }

    public function getVariant()
    {
        $this->variant = $this->product->variants->filter(function ($variant) {
            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);
        })->first();

        $this->stock = $this->variant->stock;
        $this->qty = 1;
    }

    public function add_to_cart()
    {
        Cart::instance('shopping');

        $cartItem = Cart::search(function ($cartItem, $rowId) {
            return $cartItem->options->sku === $this->variant->sku;
        })->first();

        if ($cartItem) {
            $stock = $this->stock - $cartItem->qty;
            if ($stock < $this->qty) {
                $this->dispatch('swal', [
                    'title' => 'No hay suficiente stock',
                    'text' => 'Solo quedan ' . $stock . ' unidades',
                    'icon' => 'error',
                    'timeout' => 3000,
                    'toast' => true,
                    'position' => 'center'
                ]);
                return;
            }
        }

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->product->image,
                'sku' => $this->variant->sku,
                'stock' => $this->stock,
                'features' => Feature::whereIn('id', $this->selectedFeatures)->pluck('description', 'id')->toArray(),
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
            'position' => 'center'
        ]);
    }

    public function render()
    {
        return view('livewire.products.add-to-cart');
    }
}
