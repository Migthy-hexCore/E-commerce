<div>
    <section class="rounded-lg border border-gray-800 bg-slate-700 shadow-lg; mt-6">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-slate-50">
                    Opciones
                </h1>
                <x-button wire:click="$set('openModal',true)">
                    Nuevo
                </x-button>
            </div>
        </header>

        <div class="p-6">
            @if ($product->options->count())
                @foreach ($product->options as $option)
                    <div class="mb-6 p-6 rounded-lg border border-white relative"
                        wire:key = "product-option-{{ $option->index }}">

                        <div class="absolute -top-3 px-4 bg-slate-700">
                            <button onclick="confirmDeleteOption({{ $option->id }})">
                                <i class="fa-solid fa-trash-can text-red-400 hover:text-red-600"></i>
                            </button>

                            <span class="ml-2 text-white">
                                {{ $option->name }}
                            </span>
                        </div>

                        {{-- Valores --}}
                        <div class="flex flex-wrap">

                            @foreach ($option->pivot->features as $feature)
                                @switch($option->type)
                                    {{-- Descripción --}}
                                    @case(1)
                                        <span
                                            class="bg-gray-100 text-slate-50 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded dark:bg-gray-700 dark:text-slate-50 border border-gray-500">
                                            {{ $feature['description'] }}
                                            <button class="ml-0.5"
                                                onclick="confirmDeleteFeature({{ $option->id }}, {{ $feature['id'] }})">
                                                <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                            </button>

                                        </span>
                                    @break

                                    {{-- Color --}}
                                    @case(2)
                                        <div class="relative">
                                            <span
                                                class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-slate-50 mr-4"
                                                style="background-color:{{ $feature['value'] }} ">
                                                <button
                                                    class="absolute z-10 left-3 -top-2 rounded-full bg-red-400 hover:bg-red-600
                                                   h-4 w-4 flex justify-center items-center"
                                                    onclick="confirmDeleteFeature( {{ $option->id }}, {{ $feature['id'] }})">
                                                    <i class="fa-solid fa-xmark text-white text-xs"></i>
                                                </button>
                                            </span>
                                        </div>
                                    @break

                                    @default
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">AVISO!</span> No hay opciones disponibles, cuando agregues una opción se mostrará aquí.
                    </div>
                </div>
            @endif
            <div class="space-y-6">

            </div>
        </div>

    </section>

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">Agregar nueva opción</x-slot>

        <x-slot name="content">
            <x-validation-errors class=""></x-validation-errors>
            <div class="mb-4">
                <x-label class="mb-1">
                    Opción
                </x-label>
                <x-select class="w-full" wire:model.live="variant.option_id">
                    <option value="" disabled>
                        Selecciona una opción
                    </option>
                    @foreach ($options as $option)
                        <option value="{{ $option->id }}">
                            {{ $option->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="flex items-center mb-6">
                <hr class="flex-1">
                <span class="mx-4">Valores</span>
                <hr class="flex-1">
            </div>

            <ul class="mb-4 space-y-6">
                @foreach ($variant['features'] as $index => $feature)
                    <li class="relative border border-white rounded-lg p-6"
                        wire:key="variants-features-{{ $index }}">

                        <div class="absolute -top-3 bg-slate-800 px-4">
                            <button wire:click="removeFeature({{ $index }})">
                                <i class="fa-solid fa-trash-can text-red-400 hover:text-red-600"></i>
                            </button>
                        </div>

                        <div>
                            <x-label class="mb-1">
                                Valores
                            </x-label>

                            <x-select class="w-full" wire:model="variant.features.{{ $index }}.id"
                                wire:change="feature_change({{ $index }})">
                                <option value="" disabled>
                                    Selecciona un valor
                                </option>

                                @foreach ($this->features as $feature)
                                    <option value="{{ $feature->id }}">
                                        {{ $feature->description }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>

                    </li>
                @endforeach
            </ul>

            <div class="flex justify-end">
                <x-button wire:click="addFeature">
                    Agregar valor
                </x-button>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="save">
                Guardar
            </x-button>

            <x-danger-button class="ml-4" wire:click="$set('openModal', false)" secondary>
                Cancelar
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDeleteFeature(option_id, feature_id) {
                Swal.fire({
                    title: "Estás seguro?",
                    text: "No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminarlo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('deleteFeature', option_id, feature_id);
                    }
                });
            }

            function confirmDeleteOption(option_id) {
                Swal.fire({
                    title: "Estás seguro?",
                    text: "No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminarlo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('deleteOption', option_id);
                    }
                });
            }
        </script>
    @endpush

</div>
