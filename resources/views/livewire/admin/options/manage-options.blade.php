<div>
    <section class="rounded-lg bg-slate-700 shadow-lg;">
        {{-- Header --}}
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-slate-50">
                    Opciones
                </h1>
                <x-button wire:click="$set('newOption.openModal',true)">
                    Nuevo
                </x-button>
            </div>
        </header>

        {{-- Muestra las opciones --}}
        <div class="p-6">
            <div class="space-y-6">
                @foreach ($options as $option)
                    <div class="p-6 rounded-lg border border-slate-200 relative" wire:key="option-{{ $option->id }}">
                        <div class="absolute -top-3 px-2 bg-slate-700">

                            <button class="mr-2" onclick="confirmDelete({{$option->id}}, 'option')">
                                <i class="fa-solid fa-trash-can text-red-400 hover:text-red-600"></i>
                            </button>

                            <span class="text-white">
                                {{ $option->name }}
                            </span>
                        </div>

                        {{-- Valores --}}
                        <div class="flex flex-wrap mb-4">
                            @foreach ($option->features as $feature)
                                @switch($option->type)
                                    {{-- Descripción --}}
                                    @case(1)
                                        <span
                                            class="mb-4 bg-gray-100 text-slate-50 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded dark:bg-gray-700 dark:text-slate-50 border border-gray-500">
                                            {{ $feature->description }}
                                            <button class="ml-0.5" onclick="confirmDelete({{ $feature->id }}, 'feature')">
                                                <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                            </button>

                                        </span>
                                    @break

                                    {{-- Color --}}
                                    @case(2)
                                        <div class="relative">
                                            <span
                                                class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-slate-50 mr-4"
                                                style="background-color:{{ $feature->value }} ">
                                                <button
                                                    class="absolute z-10 left-3 -top-2 rounded-full bg-red-400 hover:bg-red-600 h-4 w-4 flex justify-center items-center"
                                                    onclick="confirmDelete({{ $feature->id }},'feature')">
                                                    <i class="fa-solid fa-xmark text-white text-xs"></i>
                                                </button>
                                            </span>
                                        </div>
                                    @break

                                    @default
                                @endswitch
                            @endforeach
                        </div>
                        <div>
                            @livewire('admin.options.add-new-feature', ['option' => $option], key('add-new-feature-' . $option->id))
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-dialog-modal wire:model="newOption.openModal">
        <x-slot name="title">
            Crear nueva opción
        </x-slot>

        <x-slot name="content">
            <x-validation-errors class="mb-4" />
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-label class="mb-1">
                        Nombre
                    </x-label>
                    <x-input wire:model="newOption.name" class="w-full" placeholder="Ej. Tamaño, Color..." />
                </div>
                <div>
                    <x-label class="mb-1">
                        Tipo
                    </x-label>
                    <x-select wire:model.live="newOption.type" class="w-full">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <hr class="flex-1">
                <span class="mx-4">Valores</span>
                <hr class="flex-1">
            </div>

            <div class="mb-4 space-y-4">
                @foreach ($newOption->features as $index => $feature)
                    <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="features-{{ $index }}">
                        <div class="absolute -top-3 px-4 bg-slate-800">
                            <button wire:click="removeFeature({{ $index }})">
                                <i class="fa-solid fa-trash-can text-red-400 hover:text-red-600"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label class="mb-1">
                                    Valor
                                </x-label>

                                @switch($newOption->type)
                                    @case(1)
                                        <x-input wire:model="newOption.features.{{ $index }}.value" class="w-full"
                                            placeholder="Ingrese valor de la opción" />
                                    @break

                                    @case(2)
                                        <div
                                            class="border border-slate-700 rounded-md h-[42px] flex items-center justify-between px-4">
                                            {{ $newOption->features[$index]['value'] ?: 'Selecciona un color' }}
                                            <x-input class="cursor-pointer" type="color"
                                                wire:model.live="newOption.features.{{ $index }}.value" />
                                        </div>
                                    @break

                                    @default
                                @endswitch
                            </div>
                            <div>
                                <x-label class="mb-1">
                                    Descripción
                                </x-label>
                                <x-input wire:model="newOption.features.{{ $index }}.description" class="w-full"
                                    placeholder="Ingrese descripción" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end">
                <x-button wire:click="addFeature">
                    Agregar valor
                </x-button>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button class="btn btn-teal" wire:click="addOption">Guardar</button>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDelete(id, type) {
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
                        switch (type) {
                            case 'feature':
                                @this.call('deleteFeature', id);
                                break;

                            case 'option':
                                @this.call('deleteOption', id);
                                break;

                            default:
                                break;
                        }

                    }
                });
            }
        </script>
    @endpush

</div>
