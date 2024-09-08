<div>
    <form wire:submit='store'>
        {{-- Imagen --}}
        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-900 text-sm">
                    <i class="fas fa-camera mr-2">
                        Actualizar imagen

                        <input type="file" class="hidden" accept="image/*" wire:model="image">
                    </i>
                </label>
            </div>
            <img class="aspect-[16/9] object-cover object-center w-full rounded-lg"
                src="{{ $image ? $image->temporaryUrl() : Storage::url($productEdit['image_path']) }}" alt="">
        </figure>

        <x-validation-errors class="mb-4" />

        <div class="card">
            {{-- SKU --}}
            <div class="mb-4">
                <x-label class="mb-1">
                    Código SKU
                </x-label>
                <x-input class="w-full" placeholder="Ingresa el código SKU" wire:model="productEdit.sku">
                </x-input>
            </div>

            {{-- Nombre --}}
            <div class="mb-4">
                <x-label class="mb-1">
                    Nombre del producto
                </x-label>
                <x-input class="w-full" placeholder="Ingresa el nombre del producto" wire:model="productEdit.name">
                </x-input>
            </div>

            {{-- Descripcion --}}
            <div class="mb-4">
                <x-label class="mb-1">
                    Descripcion del producto
                </x-label>
                <x-textarea class="w-full" placeholder="Ingresa la descripción del producto"
                    wire:model="productEdit.description">
                </x-textarea>
            </div>

            {{-- Familias --}}
            <div class="mb-4">
                <x-label class="mb-1">
                    Familias
                </x-label>
                <x-select class="w-full" wire:model.live="family_id">
                    <option value="" disabled>Selectione una familia</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            {{-- Categorias --}}
            <div class="mb-4">
                <x-label class="mb-1">
                    Categorias
                </x-label>

                <x-select class="w-full" wire:model.live="category_id">
                    <option value="" disabled>Selectione una categoria</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            {{-- Subcategorias --}}
            <div class="mb-4">
                <x-label class="mb-1">
                    Subcategorias
                </x-label>

                <x-select class="w-full" wire:model.live="productEdit.subcategory_id">
                    <option value="" disabled>Selectione una subcategoria</option>
                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            {{-- Precio --}}
            <div class="mb-4">
                <x-label class="mb-1">
                    Precio
                </x-label>
                <x-input class="w-full" type="number" step="0.01" placeholder="Ingresa el precio del producto"
                    wire:model="productEdit.price">
                </x-input>
            </div>

            {{-- Boton actualizar --}}
            <div class="flex justify-end space-x-2">
                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>

                <x-button>
                    Actualizar
                </x-button>
            </div>
    </form>

    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>
    @push('js')
        <script>
            function confirmDelete() {
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
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush
</div>
