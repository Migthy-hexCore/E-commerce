<x-container>
    <div class="card">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <figure class="mb-2">
                    <img src="{{ $product->image }}" class="aspect-[16/9] object-cover object-center">
                </figure>
                <div class="text-sm text-gray-300">
                    {{ $product->description }}
                </div>
            </div>

            <div class="col-span-1">
                <h1 class="text-xl text-gray-200">
                    {{ $product->name }}
                </h1>

                <div class="flex items-center space-x-2 mb-4">
                    <ul class="flex space-x-1 text-sm">
                        <li>
                            <i class="fa-solid fa-star text-yellow-300"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-300"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-300"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-300"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-300"></i>
                        </li>
                    </ul>
                    <p class="text-sm text-gray-400">4.7 (55)</p>
                </div>

                <p class="text-gray-300 font-semibold text-2xl mb-4">
                    {{ $product->price }} MXN$
                </p>

                <div class="flex items-center space-x-6 mb-6" x-data="{
                    qty: @entangle('qty'),
                }">
                    <button class="btn btn-indigo" x-on:click="qty = qty - 1" x-bind:disabled="qty == 1">-</button>

                    <span class="text-gray-300 inline-block w-2 text-center" x-text="qty"></span>

                    <button class="btn btn-indigo" x-on:click="qty = qty + 1">+</button>
                </div>

                <button class="btn btn-blue w-full mb-6" wire:click="add_to_cart" wire:loading.attr="disabled">
                    Agregar al carrito
                </button>

                <div class="text-gray-400 flex items-center space-x-4">
                    <i class="fa-solid fa-truck-fast text-2xl"></i>
                    <p>Entrega a domicilio </p>
                </div>

            </div>
        </div>
    </div>
</x-container>
