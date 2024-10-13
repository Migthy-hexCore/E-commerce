<div class="bg-gray-300 py-12">
    <x-container class="md:flex px-4">
        @if (count($options))
            <aside class="md:w-52 md:flex-shrink-0 md:mr-8 mb-8 md:mb-0">
                <ul class="space-y-6">
                    @foreach ($options as $option)
                        <li class="font-bold" x-data="{ open: true }">
                            <button
                                class="px-4 py-2 bg-gray-600 w-full text-left text-white flex justify-between items-center"
                                x-on:click="open = !open">
                                {{ $option['name'] }}
                                <i class="fa-solid fa-angle-down"
                                    x-bind:class="{ 'fa-angle-down': open, 'fa-angle-up': !open }"></i>
                            </button>
                            <ul class="mt-2 space-y-2" x-show="open">
                                @foreach ($option['features'] as $feature)
                                    <li>
                                        <label class="inline-flex items-center select-none">
                                            <x-checkbox class="mr-2" value="{{ $feature['id'] }}"
                                                wire:model.live="selected_features" />
                                            {{ $feature['description'] }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </aside>
        @endif

        <div class="md:flex-1">
            <div class="flex items-center">
                <span class="mr-2">
                    Ordenar por:
                </span>
                <x-select wire:model.live="orderBy">
                    <option value="1">Relevancia</option>
                    <option value="2">Precio (mayor a menor)</option>
                    <option value="3">Precio (menor amayor)</option>
                </x-select>
            </div>
            <hr class="my-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <article class="bg-white shadow rounded overflow-hidden">
                        <img src="{{ $product->image }}" class="w-full h-48 object-cover object-center">
                        <div class="p-4">
                            <h1 class="text-lg font-bold text-gray-700 line-clamp-2 mb-2 min-h-[56px]">
                                {{ $product->name }}
                            </h1>
                            <p class="text-gray-600 mb-4">
                                {{ $product->price }} MXN $
                            </p>
                            <a href="{{ route('products.show', $product) }}"
                                class="btn btn-indigo block w-full text-center">
                                Ver más
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </x-container>
</div>
