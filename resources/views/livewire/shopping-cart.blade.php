<div>
    <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
        <div class="lg:col-span-5">
            <div class="flex justify-between mb-2">
                <h1 class="text-lg text-gray-200">
                    Carrito de compras ({{ Cart::count() }}) productos
                </h1>

                <button class="font-semibold text-gray-300 underline hover:no-underline hover:text-indigo-500"
                    wire:click="destroy()">
                    Limpiar carrito
                </button>
            </div>

            <div class="card">
                <ul class="space-y-4">
                    @forelse (Cart::content() as $item)
                        <li class="lg:flex">
                            <img class="w-full lg:w-36 aspect-square object-cover object-center mr-2"
                                src="{{ $item->options->image }}">

                            <div class="w-80">
                                <p class="text-sm text-gray-300">
                                    <a href="{{ route('products.show', $item->id) }}">
                                        {{ $item->name }}
                                    </a>
                                </p>

                                <button wire:click="remove('{{ $item->rowId }}')"
                                    class="bg-red-400 hover:bg-red-600 text-white text-xs font-semibold rounded px-2.5 py-0-5">
                                    <i class="fa-solid fa-xmark"></i>
                                    Eliminar
                                </button>

                            </div>

                            <p class="text-gray-300">
                                {{ $item->price }} $MXN
                            </p>

                            <div class="ml-auto space-x-3">
                                <button wire:click="decrease('{{ $item->rowId }}')" class="btn btn-indigo">
                                    -
                                </button>

                                <span class="text-gray-300 inline-block w-2 text-center">{{ $item->qty }}</span>

                                <button wire:click="increase('{{ $item->rowId }}')" class="btn btn-indigo">
                                    +
                                </button>
                            </div>

                        </li>
                    @empty
                        <p class="text-center text-gray-300 text-lg font-bold">
                            No hay productos en el carrito
                        </p>
                    @endforelse
                </ul>
            </div>

        </div>

        <div class="lg:col-span-2">

            <div class="card">
                <div class="flex justify-between font-semibold mb-2">
                    <p class="text-gray-300">
                        Total:
                    </p>
                    <p class="text-gray-300">
                        {{ Cart::subtotal() }} $MXN
                    </p>
                </div>
                <a href="" class="btn btn-indigo block w-full text-center">Continuar compra</a>
            </div>
        </div>
    </div>
</div>
