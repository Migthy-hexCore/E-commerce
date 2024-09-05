<div>
    <form wire:submit="save">
        <div class="card">
            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">
                    Familias:
                </x-label>

                <x-select class="w-full" wire:model.live="subcategory.family_id">
                    <option value="" disabled>Selecciona una Familia</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Categorías:
                </x-label>

                <x-select class="w-full" name="category_id" wire:model.live="subcategory.category_id">
                    <option value="" disabled>Selecciona una Categoria</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre:
                </x-label>

                <x-input class="w-full" placeholder="Ingrese el nombre de la categoria" wire:model="subcategory.name">
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
