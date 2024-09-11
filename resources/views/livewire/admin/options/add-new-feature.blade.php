<div>
    <form wire:submit="addFeature" class="flex space-x-4">

        <div class="flex-1">
            <x-label class="mb-1">
                Valor
            </x-label>
            @switch($option->type)
                @case(1)
                    <x-input wire:model="newFeature.value" class="w-full" placeholder="Ingrese valor de la opción" />
                @break

                @case(2)
                    <div class="border border-slate-400 rounded-md h-[42px] flex items-center justify-between px-4">
                        {{ $newFeature['value'] ?: 'Selecciona un color' }}
                        <x-input class="cursor-pointer" type="color" wire:model.live="feature.value" />
                    </div>
                @break

                @default
                    {{-- <x-input wire:model="newFeature.value" class="w-full" placeholder="Ingrese valor de la opción" /> --}}
            @endswitch
        </div>

        <div class="flex-1">
            <x-label class="mb-1">
                Descripción
            </x-label>
            <x-input wire:model="newFeature.description" class="w-full"
                placeholder="Ingrese descripción" />
        </div>

        <div class="pt-7">
            <x-button>
                Agregar nuevo valor
            </x-button>
        </div>


    </form>
</div>
