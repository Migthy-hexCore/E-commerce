<div>
    <form wire:submit="save">
        <div class="card">
            <x-validation-errors class="mb-4" />
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre:
                </x-label>

                <x-input class="w-full" placeholder="Ingrese el nombre del usuario">
                </x-input>
            </div>

            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </div>
    </form>
</div>
