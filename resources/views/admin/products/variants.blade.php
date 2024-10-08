<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index'),
    ],
    [
        'name' => $product->name,
        'route' => route('admin.products.edit', $product),
    ],
    [
        'name' => $variant->features->pluck('description')->implode(', '),
    ],
]">
    <form action="{{ route('admin.products.variantsUpdate', [$product, $variant]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4" />

        <div class="relative mb-6">
            <figure>
                <img class="aspect-[1/1] w-full object-cover object-center" src="{{ $variant->image }}" id="imgPreview">
            </figure>

            <div class="absolute top-8 right-8">
                <label class="flex items-center bg-slate-600 text-white px-4 py-2 rounded-lg cursor-pointer">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar imagen
                    <input name="image" class="hidden" type="file" accept="image/*"
                        onchange="previewImage(event, '#imgPreview')">
                </label>
            </div>
        </div>
        {{-- SKU --}}
        <div class="card">
            <div class="mb-4">
                <x-label class="mb-1">
                    Código (SKU)
                </x-label>
                <x-input name="sku" value="{{ old('sku', $variant->sku) }}" placeholder="Ingrese código (SKU)" />
            </div>

            {{-- Stock --}}
            <div class="mb-4">
                <x-label class="mb-1">
                    Stock
                </x-label>

                <x-input name="stock" value="{{ old('stock', $variant->stock) }}" placeholder="Ingrese stock" />
            </div>

            <div class="flex justify-end">
                <x-button>
                    Actualizar
                </x-button>
            </div>
        </div>
    </form>

    @push('js')
        <script>
            function previewImage(event, querySelector) {
                const input = event.target;
                $imgPreview = document.querySelector(querySelector);
                if (!input.files.length) return
                file = input.files[0];
                objectURL = URL.createObjectURL(file);
                $imgPreview.src = objectURL;
            }
        </script>
    @endpush

</x-admin-layout>
