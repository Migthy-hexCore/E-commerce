<x-container>
    <div class="card">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <figure>
                    <img src="{{ $this->variant->image }}" class="aspect-[1/1] object-cover object-center">
                </figure>
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

                <div class="flex flex-wrap">
                    @foreach ($product->options as $option)
                        <div class="mr-4 mb-4">
                            <p class="font-semibold text-lg mb-2 text-gray-400">
                                {{ $option->name }}
                            </p>
                            <ul class="flex items-center space-x-4">
                                @foreach ($option->pivot->features as $feature)
                                    <li class="text-gray-300">
                                        @switch($option->type)
                                            @case(1)
                                                <button
                                                    wire:click="$set('selectedFeatures.{{ $option->id }}', {{ $feature['id'] }})"
                                                    class="w-20 h-8 font-semibold uppercase text-sm rounded-lg {{ $selectedFeatures[$option->id] == $feature['id'] ? 'bg-indigo-400 text-gray-200' : 'border border-gray-200 text-gray-300' }} ">
                                                    {{ $feature['value'] }}
                                                </button>
                                            @break

                                            @case(2)
                                                <div
                                                    class="p-0.5 border-2 rounded-lg flex items-center -mt-1.5 {{ $selectedFeatures[$option->id] == $feature['id'] ? 'border-indigo-400' : 'border-transparent' }}">
                                                    <button class="w-20 h-8 rounded-lg border border-gray-200"
                                                        wire:click="$set('selectedFeatures.{{ $option->id }}', {{ $feature['id'] }})"
                                                        style="background-color: {{ $feature['value'] }}">
                                                    </button>
                                                </div>
                                            @break

                                            @default
                                        @endswitch

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

                <button class="btn btn-blue w-full mb-6" wire:click="add_to_cart" wire:loading.attr="disabled">
                    Agregar al carrito
                </button>

                <div class="text-sm text-gray-300 mb-4">
                    {{ $product->description }}
                </div>

                <div class="text-gray-400 flex items-center space-x-4">
                    <i class="fa-solid fa-truck-fast text-2xl"></i>
                    <p>Entrega a domicilio </p>
                </div>

            </div>
        </div>
    </div>
</x-container>
