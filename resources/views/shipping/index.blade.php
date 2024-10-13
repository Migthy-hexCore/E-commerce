<x-app-layout>
    <x-container class="mt-12">
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2">
                @livewire('shipping-addresses')
            </div>

            <div class="col-span-1">
                <div class="bg-white rounded-lg shadow overflow-hidden mb-4">
                    <div class="bg-teal-700 text-white p-4 flex justify-between items-center">
                        <p class="font-semibold">
                            Resumen de la compra ({{ Cart::instance('shopping')->count() }} productos)
                        </p>
                        <a href="{{ route('cart.index') }}">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </div>

                    <div class="p-4 text-gray-600">
                        <ul>
                            @foreach (Cart::content() as $item)
                                <li class="flex items-center space-x-4 mb-4">
                                    <figure class="shrink-0">
                                        <img class="h-12 aspect-square" src="{{ $item->options->image }}">
                                    </figure>

                                    <div class="flex-1">
                                        <p class="text-sm">
                                            {{ $item->name }}
                                        </p>

                                        <p>
                                            {{ $item->price }} MXN $
                                        </p>

                                    </div>

                                    <div class="shrink-0">
                                        <p>
                                            {{ $item->qty }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <hr class="my-4">

                        <div class="flex justify-between">
                            <p class="text-lg">
                                Total
                            </p>

                            <p>
                                {{ Cart::subtotal() }} MXN $
                            </p>
                        </div>

                    </div>

                </div>

                <a href="{{ route('checkout.index') }}" class="btn btn-teal block text-center w-full">
                    Siguiente
                </a>
            </div>

        </div>
    </x-container>
</x-app-layout>
